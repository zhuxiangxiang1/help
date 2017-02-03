<?php
namespace Home\Controller;
use Think\Page;
use Home\Controller\InitController;
class NoticeController extends InitController 
{
    //跳转到公告的主页
    public function notice_index()
    {
        $this->auth('notice_index');

        $db = M('notice');

        //获取到查询条件
        $notice_title=isset($_GET['notice_title'])?$_GET['notice_title']:'';

        if(!empty($notice_title)){
            $where = " notice_title like '%".$notice_title."%'";
        }


		//分页
		$count = $db->where($where)->count(); //统计总数
		$page = new page($count,20);
		$notedata = $db->limit($page->firstRow.','.$page->listRows)->order('notice_time desc')->where($where)->select();
		$show = $page->show();
        //echo $db->getLastSql();
		$this->assign('list',$notedata);
		$this->assign('page',$show);
		$this->display("Notice/index");
	}
	
	//跳转到编辑页面
	public function notice_edit()
	{
	    $this->auth('notice_edit');
		$db = M('notice');
		
		//接收ID
        $id = I('get.id/d');
		
		$datafind =$db->find($id);
		//var_dump($datafind);exit;
		$this->assign('list',$datafind);
		$this->display("Notice/edit");
	}
	
	//执行公告的修改
	public function update()
	{
        $notice_title=isset($_POST['notice_title'])?$_POST['notice_title']:'';
        $notice_content=isset($_POST['notice_content'])?$_POST['notice_content']:'';
        $notice_remark=isset($_POST['notice_remark'])?$_POST['notice_remark']:'';
	    $data=array(
	        'notice_title'=>$notice_title,
            'notice_content'=>$notice_content,
            'notice_remark'=>$notice_remark,
        );
		$db = M('notice');
        //接收ID
        $id = I('get.id/d');
        
        if (empty($_GET['id'])) {
            $this->error('没有要修改的公告',U('Notice/notice_index'));
            exit;
        }
		$db->create();
        $result = $db->where('notice_id='.$id)->setField($data);
		//echo $db->getLastSql();
		
		if ( $result) {
            $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")修改了一条标题为<span style='color: red;' >".$notice_title."</span>的公告");
            $this->success('修改成功',U('Notice/notice_index'));
        } else {
            $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")修改公告失败");
            $this->error('修改失败');
        }
        
	}
	
	//执行公告的删除
	public function notice_del()
	{
	   $this->auth('notice_del');
	   $db=M('notice');
		//判断有无参数ID
        if (empty($_GET['id'])) {
            $this->error('没有要删除的公告',U('Notice/notice_index'));
            exit;
        }
        //接收ID
        $id = I('get.id/d');
        $list=$db->find($id);
        
        if ($db->delete($id) > 0) {
            $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")删除了一条标题为<span style='color: red;' >".$list['notice_title']."</span>的公告");
            $this->success('恭喜您!删除成功!',U('Notice/notice_index'));
        } else {
            $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")删除<span style='color: red;' >".$list['notice_title']."</span>公告失败");
            $this->error('删除失败!',U('Notice/notice_index'));
        }
	}
	
	//跳转到发布公告
	public function addNotice()
	{ 
	    $this->auth('addNotice');
		$this->display("Notice/addNotice");
	}
	
	//添加公告
	public function add()
	{
        $notice_title=isset($_POST['notice_title'])?$_POST['notice_title']:'';
        $notice_content=isset($_POST['notice_content'])?$_POST['notice_content']:'';
        $notice_remark=isset($_POST['notice_remark'])?$_POST['notice_remark']:'';
		$db = M('notice');
        $data=array(
            "notice_publisher"=>$_SESSION['list'][0]['user_realname'],
            'notice_title'=>$notice_title,
            'notice_content'=>$notice_content,
            'notice_remark'=>$notice_remark,
            'notice_time'=>date('Y-m-d H:i:s', time()),
        );

		$db->create();
		$result = $db->add($data);
		//$id = $db->getLastInsID();//得到了新添加记录的Id
		if ( $result) {
            $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")添加了一条标题为<span style='color: red;' >".$notice_title."</span>的公告");
            $this->success('添加成功',U('Notice/notice_index'));
        } else {
            $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")添加公告失败");
            $this->error('添加失败');
        }
	}
	
	//公告详情
	public function detail()
	{
	    $this->auth('detail');
		$db = M('notice');
		//判断有无参数ID
        //接收ID
        $id = I('get.id/d');
		$list = $db->find($id);
        $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")查看了一条标题为<span style='color: red;' >".$list['notice_title']."</span>的公告");
        $this->assign('list',$list);
		$this->display("Notice/noticeDetail");
		
	}
}