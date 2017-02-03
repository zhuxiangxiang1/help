<?php
namespace Home\Controller;
use Home\Controller\InitController;
use Think\Page;
use Think\Upload;
class ExcelController extends InitController
{
    public function excel_index()
    {
        $this->auth('excel_index');
        $this->display("Excel/index");
    }



    //上传xls文件
    public function upload()
    {

        //上传表格==============================
        $filepath="./Public/Home/upload/excels/type_account/";
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
        }else{// 上传成功
            foreach($info as $file){
                $picPath = $file['savename'];//获取了上传文件的文件名
            }

            //把表格内容提交到数据库===================
            $file = $filepath.$picPath;//拼凑路径，获取了上传文件的路径
            import("Org.Util.PHPExcel");
            $excel = new \PHPExcel();
            /**默认用excel2007读取excel，若格式不对，则用之前的版本进行读取*/
            $PHPReader = new \PHPExcel_Reader_Excel2007();
            if(!$PHPReader->canRead($file)){
                $PHPReader = new \PHPExcel_Reader_Excel5();
                if(!$PHPReader->canRead($file)){
                    $this->error("这张表不存在，请重新选择");
                }
            }

            $PHPExcel = $PHPReader->load($file);

            $sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
            $highestRow = $sheet->getHighestRow(); // 取得总行数  6行
            $highestColumm = $sheet->getHighestColumn(); // 取得总列数  C

            //$a=array('username','password');
            $a=array(
                'excels_time','excels_port','excels_channel',
                'excels_game','excels_salesman','excels_payway',
                'excels_caption','excels_money', 'excels_zhichu',
                'excels_money_zc','excels_remark','excels_alipay',
                'user_phone','user_realname',
            );


            //以二维数组的形式获取表格内容，并且把数组的下标替换成$a的值
            for ($row = 2; $row <= $highestRow; $row++){//行数是以第2行开始
                for ($column = 'A';$column <= 'N'; $column++) {//列数是以A列开始
                    $content[$row-2][$column] = $sheet->getCell($column.$row)->getValue();
                }
            }

            for($i=0;$i<count($content);$i++){
                for($j=0;$j<=$i;$j++) {
                    $c[$j] = array_combine($a, $content[$j]);
                    $c[$j]['excels_money_zc']=$c[$j]['excels_money']*$c[$j]['excels_zhichu'];
                    $c[$j]['excels_uid']=$_SESSION['list'][0]['user_id'];
                }
            }

            $db=M("excels");
            $db->create();
            //把表格内容提交到数据库
            for($i=0;$i<count($c);$i++){
                $list = $db->add($c[$i]);
            }
            if($list){
                $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")上传了结算表");
                $this->success("上传成功",U("Excel/accountExcel"));
            }else{
                $this->setLog($_SESSION['list'][0]['user_phone']."(".$_SESSION['list'][0]['user_realname'].")上传结算表失败");
                $this->error("上传失败");
            }

        }


    }

    //结算表
    public function accountExcel()
    {
        $this->auth('accountExcel');
        $role = $_SESSION['list'][0]['role_id'];
        $excels_salesman=isset($_GET['excels_salesman'])?$_GET['excels_salesman']:'';
        $where=array();
        $db=M("excels");
        if(!empty($excels_salesman)){
            $where['excels_salesman']=array('like','%'.$excels_salesman.'%');
        }
        if($role==12){
            $where['excels_uid']=$_SESSION['list'][0]['user_id'];
        }elseif($role == 9 or $role == 1){
            $a=1;//瞎编的、、、、主要是用来结束if语句的，真的没啥用处！
        }else{
            $where['user_phone']=$_SESSION['list'][0]['user_phone'];
        }

        $count = $db->where($where)->count(); //统计总数
        $page = new page($count,20);
        $list = $db->limit($page->firstRow.','.$page->listRows)->where($where)->select();
        //echo $db->getLastSql();
        $show = $page->show();
        $this->assign('page',$show);
        $this->assign("list",$list);
        $this->display("Excel/accountExcel");
    }

    //测试
    public function test()
    {
        $this->auth('test');
        $this->auth("test");
        $this->display("Excel/testAccount");
    }
    public function testAction()
    {
        $this->auth('testAction');
        //上传表格==============================
        $filepath="./Public/Home/upload/excels/test/";
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
        }else{// 上传成功
            foreach($info as $file){
                $picPath = $file['savename'];//获取了上传文件的文件名
            }

            //把表格内容提交到数据库===================
            $file = $filepath.$picPath;//拼凑路径，获取了上传文件的路径
            import("Org.Util.PHPExcel");
            $excel = new \PHPExcel();
            /**默认用excel2007读取excel，若格式不对，则用之前的版本进行读取*/
            $PHPReader = new \PHPExcel_Reader_Excel2007();
            if(!$PHPReader->canRead($file)){
                $PHPReader = new \PHPExcel_Reader_Excel5();
                if(!$PHPReader->canRead($file)){
                    $this->error("这张表不存在，请重新选择");
                }
            }

            $PHPExcel = $PHPReader->load($file);

            $sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
            $highestRow = $sheet->getHighestRow(); // 取得总行数  6行

            //以二维数组的形式获取表格内容
            for ($row = 2; $row <= $highestRow; $row++){//行数是以第2行开始
                for ($column = 'A';$column <= 'N'; $column++) {//列数是以A列开始
                    $content[$row-2][$column] = $sheet->getCell($column.$row)->getValue();
                }
            }
            echo "<pre>";
            print_r($content);
        }
    }

}