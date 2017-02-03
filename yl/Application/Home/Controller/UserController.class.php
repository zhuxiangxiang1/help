<?php
namespace Home\Controller;
use Think\Page;
use Home\Controller\InitController;
use Home\Model\BankListModel;
class UserController extends InitController
{
    //跳转到添加管理员页面
    public function addUser()
    {

        $this->auth('addUser');
        $db = M("user");

        //获取到查询条件
        $user_phone=isset($_GET['user_phone'])?$_GET['user_phone']:'';

        if(!empty($user_phone)){
            $where = " user_phone like '%".$user_phone."%'";
        }

        $count = $db->count(); //统计总数
        $page = new page($count,10);
        $list = $db->join("c_role as r on r.id=c_user.role_id")->field("r.role_name,c_user.*")->limit($page->firstRow.','.$page->listRows)->order(" role_id")->where($where)->select();
        //echo $db->getLastSql();
        //var_dump($list);exit;
        $show = $page->show();

        $this->assign('page',$show);
        $this->assign("list",$list);
        $this->display("User/addUser");
    }
    
    //修改用户界面
    public function  editMember(){
        $this->auth('editMember');
        //接收id
        $id = I('get.id/d');
        //判断有无参数ID
        if (empty($_GET['id'])) {
            $this->error("没有要编辑的用户",addUser);
            exit;
        }
        //实例化
        $role=D('role');
        $res=$role->select();
        
        //获取到当前id用户的信息
        $user=D('user');
        $res_user=$user->where("user_id=$id")->find();
        //将role_id转为int
        //$res_user['role_id']=(int)$res_user['role_id'];
        //分配变量
       //var_dump($res);exit;
        $this->assign('res_user',$res_user);
        $this->assign('id',$id);
        $this->assign('res',$res);
        $this->display('edit');
    }
    
    //处理修改界面
    public function getedit(){
        $id = I('get.id/d');
        $user_pwd=$_POST['user_pwd'];
        $user_email=isset($_POST['user_email'])?$_POST['user_email']:'';
        $role_id=isset($_POST['role_id'])?$_POST['role_id']:'';
        $data=array(
            'user_email'=>$user_email,
            'role_id'=>$role_id,
        );
        if(empty($_POST['user_pwd'])){
            //如果不存在则不需要改变密码
            unset($_POST['user_pwd']);
        }else{
            $data['user_pwd']=md5($user_pwd);
        }
        $db=M("user");
        $list=$db->where("user_id= '$id' ")->setField($data);
        //echo $db->getLastSql();die;
        if($list){
            $this->success("修改成功",U("User/addUser"));
        }else{
            $this->error("修改失败");
        }
        
    }
    //删除用户
    public function delUser()
    {
        $this->auth('delUser');
        //判断有无参数ID
        if (empty($_GET['id'])) {
            $this->error('没有要删除的管理员');
            exit;
        }
        //接收ID
        $id = I('get.id/d');
        $db = M("user");
        if ($db->delete($id) > 0) {
            $this->success('恭喜您!删除成功!',U('User/addUser'));
        } else {
            $this->error('删除失败!',U('User/addUser'));
        }
    }

    //个人中心
    public function Information()
    {
        //连接数据库，获取id
        $id=$_SESSION['list'][0]['user_id'];
        $pay=M("payorder");
        $user=M("user");
        $notice=M("notice");

        //发送个人信息
        $user_list = $user->find($id);

        //查找最近发布的一条新闻
        $notice_list=$notice->limit(1)->order("notice_time desc")->select();

        //订单总金额
        $order_list_sum=$pay->sum(order_money);
        //未处理的订单总金额
        $order_list_no=$pay->where("order_status=1")->sum(order_money);
        //已处理的订单总金额
        $order_list_yes=$pay->where("order_status=2")->sum(order_money);


        $this->assign('yes',$order_list_yes);
        $this->assign('no',$order_list_no);
        $this->assign('all',$order_list_sum);
        $this->assign("notice_list",$notice_list);
        $this->assign('user_list',$user_list);
        $this->display('User/Information');
    }

    //修改个人信息
    public function editUser()
    {
        //根据银行卡号自动识别所属的银行
        $bankdb=new BankListModel();
        if(!empty($_POST['bankid'])){
            $bank= $this->bankInfo($_POST['bankid'],$bankdb->bankList);
        }

        $db = M('user');
        $id=$_SESSION['list'][0]['user_id'];
        $this->auth('editUser');

        $user_email=isset($_POST['user_email'])?$_POST['user_email']:'';
        $bankid=isset($_POST['bankid'])?$_POST['bankid']:'';
        $alipay=isset($_POST['alipay'])?$_POST['alipay']:'';
        $data=array(
            'user_email'=>$user_email,
            'bankid'=>$bankid,
            'bank'=>$bank,
            'alipay'=>$alipay,
        );
        /*echo "<pre>";
        print_r($data);die;*/
        $list = $db->where("user_id = $id")->setField($data);
        //echo $db->getLastSql();
        if($list){
            $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")修改了自己的个人信息");
            $this->success("修改成功");
        }else{
            $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")修改自己的个人信息失败");
            $this->error("修改失败");
        }
    }

    //ajax
    public function getAjax()
    {
        $bankdb=new BankListModel();
        if(!empty($_POST['bankid'])){
            $bank= $this->bankInfo($_POST['bankid'],$bankdb->bankList);
        }
        echo json_encode($bank);
    }

    //封装、根据银行卡号，自动识别银行
    public function bankInfo($card,$bankList)
    {
        $card_8 = substr($card, 0, 8);
        if (isset($bankList[$card_8])) {
            return $bankList[$card_8];
        }
        $card_6 = substr($card, 0, 6);
        if (isset($bankList[$card_6])) {
            return $bankList[$card_6];
        }
        $card_5 = substr($card, 0, 5);
        if (isset($bankList[$card_5])) {
            return $bankList[$card_5];
        }
        $card_4 = substr($card, 0, 4);
        if (isset($bankList[$card_4])) {
            return $bankList[$card_4];
        }
        echo '该卡号信息暂未录入';
    }
    //修改密码
    public function editPwd()
    {
        $this->display("User/editPwd");
    }
    //执行修改密码操作
    public function pwdAction()
    {
        $user_pwd=md5(isset($_POST['user_pwd'])?$_POST['user_pwd']:'');
        $new_pwd=md5(isset($_POST['new_pwd'])?$_POST['new_pwd']:'');
        $db=M("user");
        $list=$db->where("user_pwd='$user_pwd' and user_id = ".$_SESSION['list'][0]['user_id'])->select();
        if($list){
            $data=array('user_pwd'=>$new_pwd);
            $list_pwd=$db->where("user_id = ".$_SESSION['list'][0]['user_id'])->setField($data);
            if($list_pwd){
                $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")修改了自己的登陆密码");
                $this->success("密码修改成功");
            }else{
                $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")修改登陆密码失败");
                $this->error("密码修改失败，请联系管理员");
            }
        }else{
            $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")修改登陆密码失败");
            $this->error("密码修改失败！");
        }
    }

}