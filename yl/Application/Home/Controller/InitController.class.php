<?php
namespace Home\Controller;
use Think\Controller;
class InitController extends Controller
{
    //自动判断是否已经登录
    public function _initialize()
    {
        if(!$_SESSION['list'][0]){
            $this->error('非法操作，请先登录',__MODULE__."/Login/login");
        }
    }

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

    //增加一个方法用来控制权限
    public function auth($priv){
        //取出登录用户的id
        $user_id = $_SESSION['list'][0]['role_id'];
        if($user_id==1){
            //超级管理员
            return true;
        }else{
            //普通的管理员,获取到所以的权限
            $auth_ac = $_SESSION['role_auth_ac'];
            $priv = ','.$priv.',';
            $auth_ac=','.$auth_ac.',';
            //,addrole,       ,o,
            //,addauth,authlist,addrole,rolelist,fenpei,addadmin,adminlist,
            if(strpos($auth_ac,$priv)!==false){
                return true;
            }else{
               // var_dump($_SESSION['list']);exit;
                $this->error("你没有权限操作");
            }

        }
    }

    //插入日志
    public function setLog($contents)
    {
        $db=M("log");
        $data=array(
            'uid'=>$_SESSION['list'][0]['user_id'],
            'time'=>date('Y-m-d H:i:s', time()),
            'contents'=>$contents,
            'ip'=>$_SERVER["REMOTE_ADDR"],
            'realname'=>$_SESSION['list'][0]['user_realname'],
        );
        $db->create();
        $db->add($data);
    }


}