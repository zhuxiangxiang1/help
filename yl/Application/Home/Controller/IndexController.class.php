<?php
namespace Home\Controller;
use Home\Controller\InitController;
use Think\Controller;
class IndexController extends InitController
{
    public function index()
    {
       $this->display("Index/index");
    }
    public function top()
    {
        $db = M("site");
        $list=$db->find("1");
        $this->assign("list",$list);
        $this->display("Index/top");
    }
    public function left()
    {
        //获取所有的权限
        $menu=M("menu");
        //获取当前的role_id ，如果是超级管理员则不受影响
        //var_dump($_SESSION['role_auth']);exit;
        $role_id=$_SESSION['list'][0]['role_id'];
        if($role_id==1){
            $where0="menu_lev=1 and menu_view=1";
            $where1="menu_lev=2 and menu_view=1";
        }else{
            //如果不是超级管理员，则仅显示该用户权限中的权限
            $role_auth_ids=$_SESSION['role_auth'];
           
                $where0="menu_lev=1 and id in($role_auth_ids) and menu_view=1";
                $where1="menu_lev=2 and id in($role_auth_ids) and menu_view=1";
           
        }
        //取出顶级权限
        $res=$menu->where($where0)->order("menu_path")->select();
        //取出次级权限
        $res1=$menu->where($where1)->order("menu_path")->select();
        $this->assign('res',$res);
        $this->assign('res1',$res1);
        // var_dump($res1);exit;
        $this->display("Index/left");
    }
    public function main()
    {
        $this->display("Index/main");
    }
    public function bottom()
    {
        $db = M("site");
        $list=$db->find("2");
        $this->assign("list",$list);
        $this->display("Index/bottom");
    }
    public function main_list()
    {
        $this->display("Index/main_list");
    }
   
}