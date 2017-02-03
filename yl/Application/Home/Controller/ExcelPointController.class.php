<?php
namespace Home\Controller;
use Home\Controller\InitController;
use Think\Page;
use Think\Upload;
class ExcelPointController extends InitController
{
    //上传点位表
    public function point_index()
    {
        $this->auth('point_index');
        $this->display('Excel/pointindex');
    }
    //上传点位表
    public function upload_point()
    {
        $res=$_FILES['file1'];


        $this->auth("upload_point");
        $remark=isset($_POST['remark'])?$_POST['remark']:'';
        //上传表格==============================
        $filepath="./Public/Home/upload/excels/type_point/";
        $upload = new Upload(); //实例化上传类
        $upload->maxSize = 104857600; //最大上传excel文件，最大为100M
        $upload->rootPath =$filepath; //表格保存根路径
        $upload->saveName = time().mt_rand(1000,9999);; //保存文件名
        $upload->exts = array('xls','xlsx'); //允许上传文件后缀名
        $upload->autoSub = true; //自动使用子目录保存上传文件 默认为true
        $upload->subName =''; //子目录名称
        $info = $upload->upload(); // 上传文件
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else {// 上传成功
            foreach ($info as $file) {
                $picPath = $file['savename'];//获取了上传文件的文件名
            }
        }
        $data=array(
            'old_name'=>$res['name'],
            'remark'=>$remark,
            'user_realname'=>$_SESSION['list'][0]['user_realname'],
            'create_time'=>date("Y-m-d H:i:s",time()),
            'path'=>"/yl".substr($upload->rootPath.$picPath,1),
        );
        $db=M("excels_point");
        $list = $db->add($data);
        if($list){
            $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")上传了点位表");
            $this->success("上传成功",U("ExcelPoint/showPoint"));
        }else{
            $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")上传点位表失败");
            $this->error("上传失败，请联系管理员");
        }
    }

    //显示点位表
    public function showPoint()
    {
        $this->auth('showPoint');

        $db = M('excels_point');

        //获取到查询条件
        $old_name=isset($_GET['old_name'])?$_GET['old_name']:'';

        if(!empty($old_name)){
            $where = " old_name like '%".$old_name."%'";
        }

        //分页
        $count = $db->where($where)->count(); //统计总数
        $page = new page($count,20);
        $list = $db->limit($page->firstRow.','.$page->listRows)->order('create_time desc')->where($where)->select();
        $show = $page->show();
        //echo $db->getLastSql();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display("Excel/pointExcel");
    }

    //删除点位表
    public function delPoint()
    {
        $this->auth('delPoint');
        //判断有无参数ID
        if (empty($_GET['id'])) {
            $this->error('错误的参数！');
            exit;
        }
        //接收ID
        $id = I('get.id/d');

        $db = M('excels_point');
        $excelDown = $db->find($id);
        $fielPath = ".".substr($excelDown['path'],3);//是用来拼凑路径的
        if ($db->delete($id) > 0) {
            unlink($fielPath);
            $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")删除了表名为<span style='color: red;' >".$excelDown['old_name']."</span>的点位表");
            $this->success('恭喜您!删除成功!');

        } else {
            $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")删除点位表失败");
            $this->error('删除失败!');
        }
    }
}