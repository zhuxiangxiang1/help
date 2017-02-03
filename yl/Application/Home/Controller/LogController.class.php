<?php
namespace Home\Controller;
use Think\Page;
use Home\Controller\InitController;
class LogController extends InitController
{
    //跳转到主页
    public function log_index()
    {
        $this->auth("log_index");
        $db=M("log");
        //获取到查询条件
        $user_realname=isset($_GET['user_realname'])?$_GET['user_realname']:'';

        if(!empty($user_realname)){
            $where = " realname like '%".$user_realname."%'";
        }


        //分页
        $count = $db->where($where)->count(); //统计总数
        $page = new page($count,20);
        $list=$db->limit($page->firstRow.','.$page->listRows)->order("time desc")->join('c_user ON c_user.user_id = c_log.uid')->where($where)->select();
        $show = $page->show();
        $this->assign('page',$show);
        $this->assign("list",$list);
        $this->display("Log/index");
	}
}