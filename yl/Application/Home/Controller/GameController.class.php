<?php
namespace Home\Controller;
use Home\Controller\InitController;
use Think\Page;
class GameController extends InitController
{
   protected $whereid;
   public function Game_index()
   {
       $this->auth('Game_index');
        //获取到查询条件
        $game_name=isset($_GET['game_name'])?$_GET['game_name']:'';
        if(!empty($game_name)){
            $where = " game_name like '%".$game_name."%'";
        }

        $db=M("game");
        $count = $db->where($where)->count(); //统计总数
        $page = new page($count,20);

        $list = $db->limit($page->firstRow.','.$page->listRows)
            ->order("c_game.game_time desc")->where($where)
            ->join('c_game_platform ON c_game_platform.id = c_game.pid')->select();

       for($i=0;$i<count($list);$i++){
           $list[$i]['game_discount']=$list[$i]['game_discount']*10;
       }
        $show = $page->show();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display("Game/index");
   }


    //跳转到添加游戏页面
    public function addGame()
    {
        $this->display("Game/addGame");
    }
    //执行添加游戏操作
    public function add()
    {
        if(empty($_GET['pid'])){
            $this->error("错误的参数，请重新选择");
            exit;
        }
        $id=$_GET['pid'];
        $game_name=isset($_POST['game_name'])?$_POST['game_name']:'';
        $game_remark=isset($_POST['game_remark'])?$_POST['game_remark']:'';
        $game_discount=isset($_POST['game_discount'])?$_POST['game_discount']:'';
        $data=array(
            'pid'=>$id,
            'game_name'=>$game_name,
            'game_discount'=>$game_discount,
            'create_time'=>date("Y-m-d H:i:s",time()),
            'game_remark'=>$game_remark,
            'game_realname'=>$_SESSION['list'][0]['user_realname'],
        );
        $db=M("game");
        $db->create();
        $list = $db->add($data);
        if($list){
            $this->success("添加成功",U("Game/Game_index"));
        }else{
            $this->error("添加失败");
        }
    }


    //跳转到游戏平台详情
    public function detail()
    {

        //获取到查询条件

        $id = I('get.id/d');
        $db=M("game");
        $count = $db->where(" pid= ".$id)->count(); //统计总数
        $page = new page($count,20);
        $list = $db->limit($page->firstRow.','.$page->listRows)->order("c_game.game_time desc")
            ->join('c_game_platform ON c_game_platform.id = c_game.pid')
            ->where(" pid=".$id)->select();
        //echo $db->getLastSql();
        for($i=0;$i<count($list);$i++){
            $list[$i]['game_discount']=$list[$i]['game_discount']*10;
        }
        $show = $page->show();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display("Game/Game");
    }


    //ajax
    public function getAjax()
    {

        $db=M("game_platform");
        $paltform=$_POST['paltform'];
        $list = $db->where("path=$paltform")->select();
        echo json_encode($list);
    }

    //跳转到编辑游戏折扣页面
    public function edit()
    {
        $db=M("game");
        $platform=M("game_platform");
        //接收ID
        $id = I('get.id/d');
        $list = $db->find($id);
        //$list['pid'];获取到了它的Pid
        $data =$platform->find($list['pid']);
        $list['platform_name']=$data['platform_name'];

        $list['game_discount']=$list['game_discount']*10;


        $this->assign('list',$list);
        $this->display("Game/edit");
    }
    //执行修改折扣操作
    public function update()
    {
        $game_discount=isset($_POST['game_discount'])?$_POST['game_discount']:'';
        $game_remark=isset($_POST['game_remark'])?$_POST['game_remark']:'';
        $data=array(
            'game_discount'=>$game_discount/10,
            'game_remark'=>$game_remark,
        );

        $db=M("game");
        //接收ID
        $id = I('get.id/d');
        $db->create();
        $list = $db->where("game_id= '$id' ")->setField($data);
        if($list){
            $this->success("修改成功",U('Game/Game_index'));
        }else{
            $this->error("修改失败，请联系管理员");
        }
    }
    //执行删除操作
    public function del()
    {
        $db=M("game");
        //接收ID
        $id = I('get.id/d');
        $list = $db->delete($id);
        if($list){
            $this->success("删除成功",U('Game/Game_index'));
        }else{
            $this->error("删除失败，请联系管理员");
        }
    }
}