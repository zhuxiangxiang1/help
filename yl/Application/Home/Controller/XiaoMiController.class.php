<?php
namespace Home\Controller;
use Home\Controller\InitController;
use Think\Page;
class XiaoMiController extends InitController
{
    private function fz()
    {
        /*$url="http://app.migc.xiaomi.com/cms/interface/v5/subjectgamelist2.php?subId=508";
        $filepath=file_get_contents($url);
        echo json_encode($filepath);*/

        $db = M("xmgame");
        //获取到查询条件
        $game_name=isset($_GET['game_name'])?$_GET['game_name']:'';

        if(!empty($game_name)){
            $where = " displayName like '%".$game_name."%'";
        }
        //分页
        $count = $db->where($where)->count(); //统计总数
        $page = new page($count,200);

        $list=$db->limit($page->firstRow.','.$page->listRows)->where($where)->select();
        $show = $page->show();
        $this->assign("list",$list);
        $this->assign('page',$show);
    }
    public function qudao1()
    {
        $this->fz();
        $this->display("XiaoMi/qudao1");
    }
    public function qudao2()
    {
        $this->fz();
        $this->display("XiaoMi/qudao2");
    }
    public function qudao3()
    {
        $this->fz();
        $this->display("XiaoMi/qudao3");
    }
    public function qudao4()
    {
        $this->fz();
        $this->display("XiaoMi/qudao4");
    }


    public function qudao5()
    {
        $this->fz();
        $this->display("XiaoMi/qudao5");
    }
    public function qudao6()
    {
        $this->fz();
        $this->display("XiaoMi/qudao6");
    }
    public function qudao7()
    {
        $this->fz();
        $this->display("XiaoMi/qudao7");
    }
    public function qudao8()
    {
        $this->fz();
        $this->display("XiaoMi/qudao8");
    }


    public function qudao9()
    {
        $this->fz();
        $this->display("XiaoMi/qudao9");
    }
    public function qudao10()
    {
        $this->fz();
        $this->display("XiaoMi/qudao10");
    }

    //小米游戏汇总
    public function xm_index()
    {
        $db = M("xm");
        //获取到查询条件
        $game_name=isset($_GET['game_name'])?$_GET['game_name']:'';

        if(!empty($game_name)){
            $where = " displayName like '%".$game_name."%'";
        }
        //分页
        $count = $db->where($where)->count(); //统计总数
        $page = new page($count,200);

        $list1=$db->limit($page->firstRow.','.$page->listRows)->where($where)->select();
        $show = $page->show();
        $this->assign("list1",$list1);
        $this->assign('page',$show);
        $this->display("XiaoMi/xm_index");
    }



    //把excel的内容以数组的形式，读取出来
    public function xm()
    {

        $data=array();
        $fielPath="C:/Users/Administrator/Desktop/2.xls";
        import("Org.Util.PHPExcel");
        $excel = new \PHPExcel();

        $PHPReader = new \PHPExcel_Reader_Excel5();
        $reader = \PHPExcel_IOFactory::createReader('Excel5'); //设置以Excel5格式(Excel97-2003工作簿)
        $PHPExcel = $reader->load($fielPath); // 载入excel文件
        $sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumm = $sheet->getHighestColumn(); // 取得总列数

        $row=1;
            for ($column = 'A'; $column <= $highestColumm; $column++) {
               $xb[$column] = $sheet->getCell($column.$row)->getValue();
            }

        //echo ($highestRow-1)."<br>";
        /** 循环读取每个单元格的数据 */
            for ($row = 2; $row <= $highestRow; $row++){//行数是以第2行开始
                for ($column = 'A'; $column <= $highestColumm; $column++) {//列数是以A列开始
                    $dataset[$row-2][$xb[$column]] = $sheet->getCell($column.$row)->getValue();
                }
            }
        for($i=0;$i<count($dataset);$i++){
            for($j=0;$j<=$i;$j++){
                $dataset[$i]['game_time']=date("Y-m-d H:i:s",time());
                $dataset[$i]['game_realname']='admin';
                $dataset[$i]['pid']=2;
            }
        }
        $db=M("game");
        $db->create();
        for($i=0;$i<count($dataset);$i++){
            $db->add($dataset[$i]);
        }

    }

}