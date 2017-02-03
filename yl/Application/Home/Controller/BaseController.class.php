<?php
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller
{
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