<?php
namespace Home\Controller;
use Home\Controller\InitController;
use Think\Page;
class PlatformController extends InitController
{
    //跳转到添加游戏平台
    public function addPlatform()
    {
        $this->auth("addPlatform");
        $this->auth('addPlatform');
        $this->display("Platform/addPlatform");
    }
    //执行游戏平台添加
    public function add()
    {
        $db=M("game_platform");

        $platform_name=isset($_POST['platform_name'])?$_POST['platform_name']:'';
        $platform_remark=isset($_POST['platform_remark'])?$_POST['platform_remark']:'';
        $list=$db->where("platform_name = '$platform_name'")->select();
        if($list){
            $this->error("这个平台已添加，无法重复添加");
        }

        $data=array(
            'platform_name'=>$platform_name,
            'platform_remark'=>$platform_remark,
            'create_time'=>date('Y-m-d H:i:s', time()),
            'platform_realname'=>$_SESSION['list'][0]['user_realname'],
        );
        $db->create();
        $list = $db->add($data);
        if($list){
            $this->success("添加成功",U("Platform/Platform"));
        }else{
            $this->error("添加失败");
        }
    }

    //跳转到游戏平台页面
    public function Platform()
    {
        $this->auth("Platform");
        //获取到查询条件
        $game_name=isset($_GET['game_name'])?$_GET['game_name']:'';

        if(!empty($game_name)){
            $where = " and platform_name like '%".$game_name."%'";
        }
        $this->auth('Platform');
        $db=M("game_platform");
        $count = $db->where($where)->count(); //统计总数
        $page = new page($count,20);
        $list = $db->limit($page->firstRow.','.$page->listRows)->order("create_time desc")->where($where)->select();
        //echo $db->getLastSql();
        $show = $page->show();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display("Platform/Platform");
    }

    //跳转到编辑游戏平台
    public function Platform_edit()
    {
        $this->auth('Game_edit');
        $db = M('game_platform');

        //接收ID
        $id = I('get.id/d');
        $list =$db->find($id);
        $this->assign("list",$list);
        $this->display("Platform/editPlatform");
    }
    //执行修改平台操作
    public function edit()
    {
        if (empty($_GET['id'])) {
            $this->error('错误的参数，请重新选择');
        }
        $id=$_GET['id'];
        $platform_name=isset($_POST['platform_name'])?$_POST['platform_name']:'';
        $platform_remark=isset($_POST['platform_remark'])?$_POST['platform_remark']:'';
        $data=array(
            'platform_name'=>$platform_name,
            'platform_remark'=>$platform_remark,
        );
        $db=M("game_platform");
        $list = $db->where("id = '$id' ")->setField($data);

        if($list){
            $this->success("修改成功",U("Platform/Platform"));
        }else{
            $this->error("修改失败");
        }
    }

    //执行删除平台操作
    public function delPlatform()
    {
        if (empty($_GET['id'])) {
            $this->error('错误的参数，请重新选择');
        }
        $id=$_GET['id'];

        $game_db=M("game");
        $game_list=$game_db->where("pid = '$id' ")->select();
        if($game_list){
            $this->error("该平台下有游戏折扣，无法删除！ ");
            exit;
        }

        $db=M("game_platform");
        $list = $db->delete($id);
        if($list>0){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }
}