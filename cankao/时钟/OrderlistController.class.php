<?php
namespace Home\Controller;
use Home\Controller\InitController;
use Home\Model\PayorderModel;
use Home\Model\UserModel;
use Think\Model;
use Think\Page;
class OrderlistController extends InitController 
{
    
    public function listmsg()
    {
    	
    	$role_id = $_SESSION['role_id'];
    	$id = $_SESSION['id'];
    	
    	$time='';
        $payorder=new PayorderModel();
        $pay=array();
        //获取到查询条件
        $where=isset($_GET['chaxun'])?$_GET['chaxun']:'';
        $_SESSION['where'] = $where;
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
        $year="$y-$M-$d";
        $_SESSION['year']=$year;
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
      
        //分页
        $db = M('payorder');
        
        if ($role_id == 2) {
        	$count = $db->where($pay)->count(); //统计总数
        } else {
        	$count = $db->where(" user_id = ".$id)->count(); //统计总数
        }
        
		
		$page = new page($count,6);
		if($role_id == 2 ){
			$paydata = $db->limit($page->firstRow.','.$page->listRows)->where($pay)->order('order_time desc')->select();
			//echo $db->getLastSql();
			//echo $db->getLastSql();
		} else {//
			$where = " user_id = ".$id;
			$paydata = $db->limit($page->firstRow.','.$page->listRows)->where($where)->order('order_time desc')->select();
			//echo $db->getLastSql();
		}
		
		$show = $page->show();
		//var_dump($show);
		$this->assign('list',$paydata);
		$this->assign('page',$show);
		
        $this->display();
    }
    
    
    public function chuli()
    {
        //获取要处理的订单的id
        $id=isset($_GET['id'])? $_GET['id'] : "";
        if(empty($id)){
            $this->error('非法操作，没有要处理的订单');
        }
        $payorder=new PayorderModel();
        //要修改的数据
        $time=date('y-m-d H:i:s');
        $name=$_SESSION['name'];
        $data=array('order_id'=>$id,'order_opera'=>'已处理','order_opera_time'=>$time,'order_opera_name'=>$name);
        if($payorder->save($data)){
            $this->success('处理成功');exit;
        }else{
            $this->success('处理成功');
        }
    }
}