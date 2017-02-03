<?php
namespace Home\Controller;
use Home\Controller\InitController;
use Think\Upload;
class SiteController extends InitController
{
    //站点信息主页
    public function site_index()
    {
        $this->auth('site_index');
        $db = M("site");
        $list = $db->select();
        $this->assign("list",$list);
        $this->display("Site/index");
    }
    //跳转到站点信息
    public function site_edit()
    {
        //接收ID
        $id = I('get.id/d');
        $db=M("site");
        $list=$db->find($id);
        //echo $id;die;
        $this->assign('id',$id);
        $this->assign('list',$list);
        $this->display('Site/edit');
    }

    //执行修改操作
    public function editAction()
    {
        $id = I('get.id/d');
        $site_name=isset($_POST['site_name'])?$_POST['site_name']:'';
        $site_remark=isset($_POST['site_remark'])?$_POST['site_remark']:'';
        $site_url=isset($_POST['site_url'])?$_POST['site_url']:'';
        //连接数据库
        $db=M("site");
        $site_list=$db->find($id);


        if($site_list['site_status']  == 1){
            $upload = new Upload(); //实例化上传类
            $upload->maxSize = 104857600; //最大上传excel文件，最大为100M
            $upload->rootPath = './Public/Home/upload/site/'; //图片保存根路径
            $upload->saveName = time() . mt_rand(1000, 9999);; //保存文件名
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg'); //允许上传文件后缀名
            $upload->autoSub = true; //自动使用子目录保存上传文件 默认为true
            $upload->subName = ''; //子目录名称
            $info = $upload->upload(); // 上传文件
            if (!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            } else {// 上传成功
                //删除原来的图片
                unlink("./Public/Home/upload/site/".$site_list['site_url']);
                $site_url=$info['file1']['savename'];
            }
        }

        $data=array(
            'site_name'=>$site_name,
            'site_remark'=>$site_remark,
            'site_url'=>$site_url,
        );
        $list=$db->where("site_id = ".$id)->setField($data);
        if($list){
            $this->success("修改成功",U("Site/site_index"));
        }else{
            $this->error("修改失败");
        }

    }

}