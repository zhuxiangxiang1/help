<?php
namespace Home\Controller;
use Home\Controller\InitController;
use Think\Page;
class OrderController extends InitController 
{
    public function order_amount()
    {
        $this->auth('order_amount');
        $db=M("game_platform");
        $list = $db->select();
        $this->assign('list',$list);
        $this->display("Order/amount");
    }
    //ajax
    public function getAjax()
    {   
        
        $db=M("game");
        
        $paltform=isset($_POST['pt_id'])?$_POST['pt_id']:''; //获取到平台id
        $name=isset($_POST['name'])?$_POST['name']:''; //获取到游戏名
        // echo $paltform;exit;
        $where['pid']=$paltform;
        $where['game_name']=array('like',"%".$name."%");
        $list = $db->where($where)->select();
        //便利获取到的数组 输出其值
        foreach ($list as $key => $value) {
            $value=$value['game_name'];
            echo '<li onClick="fill(\''.$value.'\');">'.$value.'</li>';
        }
        
        //var_dump($list);
        //echo json_encode($list);
        //echo $paltform;
    }
    public function moneyAjax()
    {
        $db=M("game");
        $discount=$_POST['discount'];
        $pt_id=$_POST['pt_id'];
        $where['pid']=$pt_id;
        $where['game_name']=$discount;
        $list = $db->where($where)->select();
        echo json_encode($list);
        //echo $discount;
    }

    //查看订单
    public function order_detail()
    {
        $this->auth('order_detail');
        $role_id = $_SESSION['list'][0]['role_id'];
        $id =  $_SESSION['list'][0]['user_id'];


        $time='';
        $payorder=M("payorder");
        $pay=array();
        //获取到查询条件
        $where=isset($_GET['chaxun'])?$_GET['chaxun']:'';
        //获取到查询的方式
        $tiaojian=isset($_GET['tiaojian'])?$_GET['tiaojian']:'';
        $_SESSION['tiaojian']=$tiaojian;

        //var_dump($where);
        //获取到查询的时间
        $time=isset($_GET[time])?$_GET[time]:"";
        //var_dump($time);
        //对获取到的时间进行判断
        //第一次取得年
        if(!empty($time)){
            $f=explode(',', $time);
            $Y=$f[1];
            //第二次取得月份和天数
            if(strpos($f[0],'+')!==false){
                $s=explode('+',$f[0]);
            }else{
                $s=explode(' ',$f[0]);
            }

            $M=$s[1];
            $d=$s[0];
            //var_dump($s);var_dump($f);
            //取出对应的月份
            switch ($M){
                case 'January': $M='1'; break;
                case 'February': $M='2'; break;
                case 'March': $M='3'; break;
                case 'April': $M='4'; break;
                case 'May': $M='5'; break;
                case 'June': $M='6'; break;
                case 'July': $M='7'; break;
                case 'August': $M='8'; break;
                case 'September': $M='9'; break;
                case 'October': $M='10'; break;
                case 'November': $M='11'; break;
                case 'December': $M='12'; break;
            }
            //如果月份或者日数小于10则补一个0
            if($M<10){
                $M='0'.$M;
            }

            if($d<10){
                $d='0'.$d;
            }
            $y=substr($Y, 3);
            $year="20$y-$M-$d";
        }

        if(!empty($where)){
            if($tiaojian==1){
                $pay['order_payphone']=array('like','%'.$where.'%');
            }else if($tiaojian==2){
                $pay['order_payname']=array('like','%'.$where.'%');
            }else{
                $pay['order_no']=array('like','%'.$where.'%');
            }
        }
        if(!empty($year)){
            $pay['order_time']=array('like','%'.$year.'%');
        }
        //echo $year;
        /*if($_SESSION['list'][0]['role_id'] != 12 AND $_SESSION['list'][0]['role_id'] !=1 ){
            $pay['user_id'] = $id;
        }*/
        //$pay['user_id'] = $_SESSION['list'][0]['user_id'];
        if($_SESSION['list'][0]['role_id'] == 12){
            $pay['user_id'] = $_SESSION['list'][0]['user_id'];
        }elseif($_SESSION['list'][0]['role_id'] == 9){
            $pay['user_id']="";
        }
        //分页
        $db = M('payorder');

        $count = $db->where($pay)->count(); //统计总数
        $page = new page($count,20);
        $paydata = $db->limit($page->firstRow.','.$page->listRows)->where($pay)->order('order_time desc')->select();
        //echo $db->getLastSql();
        $show = $page->show();
        $this->assign('list',$paydata);
        $this->assign('page',$show);
        $this->display("Order/detail");
    }

    //生成订单
    public function checkzhifu()
    {

        $this->auth('checkzhifu');
        //生成$data数据
        $order_recharge=isset($_POST['order_recharge'])?$_POST['order_recharge']:'';//充值金额
        $order_adminNo=isset($_POST['order_adminNo'])?$_POST['order_adminNo']:'';
        $order_channel=isset($_POST['order_channel'])?$_POST['order_channel']:'';
        $platform_name=isset($_POST['platform_name'])?$_POST['platform_name']:'';//游戏平台的ID
        $game_name=isset($_POST['game_name'])?$_POST['game_name']:'';//游戏名称的ID
        //根据平台ID和游戏名查找游戏折扣
        $db=M("game");
        $list=$db->where("pid= '$platform_name' and game_name='$game_name' ")->select();
        //根据平台ID查找平台
        $platform=M("game_platform");
        $platform_list=$platform->find($platform_name);


        $data=array(
            'order_phone'=>$_SESSION['list'][0]['user_phone'],
            'order_no'=>'1479'.time().mt_rand(1000, 9999),
            'order_realname'=>$_SESSION['list'][0]['user_realname'],
            'order_phone'=>$_SESSION['list'][0]['user_phone'],
            'user_id'=>$_SESSION['list'][0]['user_id'],
            'order_money'=>$order_recharge*$list[0]['game_discount']* 100 / 100,//打款金额
            'order_recharge'=>$order_recharge,//充值金额
            'order_adminNo'=>$order_adminNo,
            'order_channel'=>$order_channel,
            'order_time'=>date("Y-m-d H:i:s",time()),
            'order_platform'=>$platform_list['platform_name'],
            'order_gamename'=>$game_name,//游戏名称
        );

        //提交到订单表
        $db=M("payorder");
        $db->create();
        $list =$db->add($data);
        if($list){
            $_SESSION['data']=$data;
            $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")提交了一个订单号为<span style='color: red;' >".$data['order_no']."</span>的单子");
            $this->success("订单提交成功,请扫二维码支付",U("Order/orderlist"));
        }else{
            $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")提交提交订单失败");
            $this->error("订单提交失败，请联系管理员");
        }
    }

    //跳转到支付宝二维码页面
    public function orderlist()
    {
        $this->auth('orderlist');
        $db = M("site");
        $list=$db->find("8");//支付宝二维码
        $alipay=$db->find("3");//支付宝账号
        $bank=$db->find("4");//银行卡卡号
        $this->assign("bank",$bank);
        $this->assign('alipay',$alipay);
        $this->assign("list",$list);
        $this->display("Order/order_list");
    }

    //处理订单
    public function deal()
    {
        //生成要修改的数据
        $data=array(
            'order_status'=>2,
            'order_operaname'=>$_SESSION['list'][0]['user_realname'],
            'order_operatime'=>date("Y-m-d H:i:s",time()),
        );

        $db = M('payorder');
        //接收ID
        $id = I('get.id/d');
        $list=$db->where("order_id=".$id)->setField($data);

        //根据ID查找订单号
        $order=$db->find($id);

        if($list){
            $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")处理了一个订单号为<span style='color: red;' >".$order['order_no']."</span>的单子");
            $this->success("处理成功");
        }else{
            $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")处理了一个订单号为<span style='color: red;' >".$order['order_id']."的单子、失败");
            $this->error("处理失败，请联系管理员");
        }
    }
}