<?php
namespace Home\Controller;
use Home\Controller\BaseController;

class LoginController extends BaseController
{

    /* 空操作 */
    public function _empty()
    {
        header("HTTP/1.0 404 Not Found");
        //获取title信息
        $pageTitle = '404错误';
        $this->assign('pageTitle', $pageTitle);
        //模板设置
        $this->display('Public/Static/index.htm');
    }

    public function login()
    {
        $db = M("site");
        $list = $db->where(" site_id between 5 and 6")->select();
        $this->assign('list',$list);
        $this->display("Login/login");
    }
    public function zhuce()
    {
        //echo phpinfo();exit;
        $this->display();
    }
    public function msg()
    {
        //接受获取到的信息
        //实例化user类
        $user=M("user");
        $use_realname=isset($_POST['user_realname'])?$_POST['user_realname']:'';
        $password=isset($_POST['password'])?$_POST['password']:'';
        $email=isset($_POST['email'])?$_POST['email']:'';
        $captcha=isset($_POST['captcha'])?$_POST['captcha']:'';
        $phone=isset($_POST['phone'])?$_POST['phone']:'';
        if($captcha!=$_SESSION['captcha']){
            $this->error('验证码错误，请检查',zhuce);
        }


        $data=array(
            'user_pwd'=>$password,
            'user_email'=>$email,
            'user_phone'=>$phone,
            'user_realname'=>$use_realname,
            'create_time'=>date("Y-m-d H:i:s", time()),
            'user_IDCard'=>$_POST['user_IDCard'],
            'role_id'=>4,
        );
        $addUser=$user->add($data);
        if($addUser){
            $this->success('注册成功',login);
        }else{
            $this->error('注册失败，请检查注册信息',Login);
        }
        //var_dump($name);
    }
    public function sendmsg()
    {

        $phone=isset($_GET['phone'])?$_GET['phone']:'';
        $name=isset($_GET['name'])?$_GET['name']:'';
        $title="尊敬的用户您好，欢迎注册禹乐科技账户";
        $captcha=mt_rand(1000,9999);
        $_SESSION['captcha']=$captcha;
        $content="您的验证码是".$captcha."请注意查收";


        Vendor('Alidayu.TopSdk','','.php');
        $code=$captcha;
        $mobile=$phone;
        $appkey = '23552822';
        $secret = 'b6fc544ddefa6963c347dc664707e553';
        $c = new \TopClient;
        $c->appkey = $appkey;
        $c->secretKey = $secret;
        $c->format = 'json';


        $req = new \AlibabaAliqinFcSmsNumSendRequest;
        $req->setExtend($code);
        $req->setSmsType('normal');
        $req->setSmsFreeSignName('欢迎注册禹乐科技'); //发送的签名
        $req->setSmsParam('{"captcha":"'.$code.'","name":"'.$name.'"}');//根据模板进行填写
        //$req->setRecNum('13328076946');//接收着的手机号码
        $req->setRecNum($mobile);//接收着的手机号码
        $req->setSmsTemplateCode('SMS_34690225');
        $resp = $c->execute($req);
        $resp=json_encode($resp);
        //var_dump($resp);
        if(strpos($resp,'success')>0){
            echo "发送成功，请注意查收";
        }else if(strpos($resp,'isv.BUSINESS_LIMIT_CONTROL')>0){
            echo "发送频率过高，请稍后发送";
        }else{
            echo "发送失败";
        }

    }

    //判断登陆
    public function checklogin()
    {
        $phone=isset($_POST['user_phone'])?$_POST['user_phone']:'';
        $password=md5(isset($_POST['password'])?$_POST['password']:'');
        if(empty($phone) || empty($password)){
            //var_dump($password);exit;
            $this->error('用户名或者密码不能为空');
        }

        //判断登陆
        $db = M("user");
        $role=M('role');
        $list = $db->where("user_phone='$phone' and user_pwd='$password'")->select();
        if($list){
            $_SESSION['list'] = $list;
            //登陆成功，获取到role_id,通过role_id获取到权限
            $role_id=$_SESSION['list'][0]['role_id'];
            $role_auth_ids=$role->where("id='$role_id'")->find();
            //保存到session中
            $_SESSION['role_auth']=$role_auth_ids['role_auth_ids'];
            $_SESSION['role_auth_ac']=$role_auth_ids['role_auth_ac'];
            $_SESSION['role_name']=$role_auth_ids['role_name'];
            //var_dump($role_auth_ids);exit;
            $this->success("登陆成功",__MODULE__."/Index/index");
            //插入日志
            $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")登陆成功");
        }else{
            $this->error('用户名或者密码错误',__MODULE__."/Login/login");
        }

    }

    public function logout()
    {
        //插入日志
        $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")已注销");
        session_destroy();
        $this->success('退出成功，欢迎下次再来',__MODULE__."/Login/login");
    }

    public function getajax(){
        //获取到手机的数据，检查数据库中是否存在该字段
        $phone=isset($_GET['phone'])?$_GET['phone']:"";
        // echo $phone;
        $user=M("user");
        $row=$user->where("user_phone='$phone'")->select();//var_dump($row);exit;
        if(count($row)>0 ) {
            echo "yes";
        }else{
            echo "no";
        }
    }

    public function juhecurl($url,$params=false,$ispost=0){
        $httpInfo = array();
        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }
}