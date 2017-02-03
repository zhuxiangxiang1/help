<?php
namespace Home\Controller;
use Home\Controller\InitController;
use Think\Page;
use Think\Model;

class MenuController extends InitController{
    //菜单功能
    public function menu_index(){
        //显示菜单页
        $this->auth('menu_index');
       //href='__URL__/'".$vo['menu_a']."/".$vo['menu_a']."
        //实例化模型
        $menu=M("menu");
        
        //分页
        $count = $menu->count(); //统计总数
       // var_dump($count);exit;
        $page = new page($count,20);
        //$paydata = $count->limit($page->firstRow.','.$page->listRows)->order('menu_path desc')->select();
        $show = $page->show();
        //echo $menu->getLastSql();exit;
        $this->assign('page',$show);
        //$this->assign('list',$paydata);
        //获取数据库中的数据
        $res=$menu->join("c_menu as b on b.id=c_menu.menu_p")->field("b.name as names,c_menu.id,c_menu.menu_lev,c_menu.name,c_menu.menu_c,c_menu.menu_a,c_menu.menu_path")->limit($page->firstRow.','.$page->listRows)->order('menu_path')->select();

        //var_dump($res);exit;
        $this->assign('res',$res);
        $this->display('index');
    }
    //增加菜单
    public function add(){
    //获取所有的数据
        $this->auth('add');
        $menu=M("menu");
        
        $res=$menu->field('id,name,menu_lev')->order("menu_path")->select();
        //var_dump($res);exit;
        //分配模板
        $this->assign('res',$res);
        $this->display();
    }
    
    //修改菜单
    public function edit(){
        //获取到当前的id
        $this->auth('edit');
        $id=isset($_GET['id'])?$_GET['id']:"";
        if(empty($id)){
            //要删除的id为空
            $this->error('没有要修改的数据',menu_index);
            exit;
        }
         
        //实例化
        $menu=M("menu");
        //将获取到的数据显示出来
        
        //菜单项
        //上级菜单不能出现他自己和他的子选项
        $res1=$menu->field('id,name,menu_lev,menu_p')->where("id!=$id and menu_p!=$id")->order("menu_path")->select();
        //var_dump($res1);exit;
        //分配模板
        
        $res=$menu->where("id='$id'")->find();
        
        $this->assign('id',$id);
        $this->assign('res',$res);
        $this->assign('res1',$res1);
        $this->display();
    }
    //获取到要添加的菜单并写入数据库
    public function checkadd(){
        //var_dump($_POST);exit;
        //实例化模型
        $menu=M("menu");
        //获取到数据库中的全部数据
        //$res=$menu->select();
        //获取到数据
        $menu_p=isset($_POST['menu_p'])?$_POST['menu_p']:"";
        $menu_c=isset($_POST['menu_c'])?$_POST['menu_c']:"";
        $name=isset($_POST['name'])?$_POST['name']:"";
        $menu_a=isset($_POST['menu_a'])?$_POST['menu_a']:"";
        $menu_beizhu=isset($_POST['menu_beizhu'])?$_POST['menu_beizhu']:"";
        
        if(empty($name)){
            var_dump($name);exit;
            $this->error('菜单名称不能为空',menu_index);
        }
        //var_dump($_POST['name']);exit;
       // var_dump($_POST);exit;
        if($menu->create()){
            //如果添加成功
            if($id=$menu->add()){
                
                //添加权限成功
                //添加权限的全路径（auth_path）和权限级别（auth_level）
                //如果权限是顶级权限（顶级菜单）auth_path=自己的id，auth_level=0
                if($menu_p==1){
                   // var_dump($menu_p) ;exit;
                    $menu_path=$id;
                    $menu_lev=1;
                    //var_dump($menu_path);exit;
                }else{
                   // var_dump($menu_p);exit;
                    //如果权限不是顶级权限则，全路径，是上级权限的全路径加"-"加自己id.
                    $menu_path=$menu->where("id=".$menu_p)->field("menu_path")->find();
                    $menu_path=$menu_path['menu_path'].'-'.$id;
                    $menu_lev=count(explode("-",$menu_path));
                }
                //要修改auth_path和auth_level字段
                $data = array(
                    'id'=>$id,
                    'menu_path'=>$menu_path,
                    'menu_lev'=>$menu_lev
                );
                
                
                if($menu->save($data)!==false){
                    
                 // var_dump($data);exit;
                    $this->success("添加菜单成功",menu_index);exit;
                }else{
                    $this->error("添加全路径和级别权限失败",menu_index);
                }
     
            }else{
                $this->error('菜单添加失败',menu_index);
            }
        }
    }
    
    //获取到要修改的数据并处理
   public function checkedit(){
   
   //获取到要编辑的id
        $id=isset($_POST['id'])?$_POST['id']:"";
        //echo $id;exit;
        
        $menu=M("menu");
        //获取到数据库中的全部数据
        //$res=$menu->select();
        //获取到数据
        $menu_p=isset($_POST['menu_p'])?$_POST['menu_p']:"";
        $menu_c=isset($_POST['menu_c'])?$_POST['menu_c']:"";
        $name=isset($_POST['name'])?$_POST['name']:"";
        $menu_a=isset($_POST['menu_a'])?$_POST['menu_a']:"";
        $menu_beizhu=isset($_POST['menu_beizhu'])?$_POST['menu_beizhu']:"";
        //将id放入数组
        $_POST['id']=$id;
        if(empty($name)){
            var_dump($name);exit;
            $this->error('菜单名称不能为空',menu_index);
        }
       
        if($menu->create()){
            //如果添加成功
            if($menu->save()){
                
                //添加权限成功
                //添加权限的全路径（auth_path）和权限级别（auth_level）
                //如果权限是顶级权限（顶级菜单）auth_path=自己的id，auth_level=0
                if($menu_p==1){
                   // var_dump($menu_p) ;exit;
                    $menu_path=$id;
                    $menu_lev=1;
                    //var_dump($menu_path);exit;
                }else{
                   // var_dump($menu_p);exit;
                    //如果权限不是顶级权限则，全路径，是上级权限的全路径加"-"加自己id.
                    $menu_path=$menu->where("id=".$menu_p)->field("menu_path")->find();
                    $menu_path=$menu_path['menu_path'].'-'.$id;
                    $menu_lev=count(explode("-",$menu_path));
                }
                //要修改auth_path和auth_level字段
                $data = array(
                    'id'=>$id,
                    'menu_path'=>$menu_path,
                    'menu_lev'=>$menu_lev
                );
                
                
                if($menu->save($data)!==false){
                    
                 // var_dump($data);exit;
                    $this->success("修改菜单成功",menu_index);exit;
                }else{
                    $this->error("修改全路径和级别权限失败",menu_index);
                }
     
            }else{
                $this->error('菜单修改失败',menu_index);
            }
        }
   }
   
    //删除菜单
   public function delete(){
       $this->auth('delete');
       $id=isset($_GET['id'])?$_GET['id']:"";
       if(empty($id)){
           //要删除的id为空
           $this->error('没有要删除的数据',menu_index);
           exit;
       }
       
       //实例化
       $menu=M("menu");
       //删除前，先判断是否还有子菜单
       $res=$menu->where("menu_p='$id'")->select();
       if(count($res)>0){
           $this->error('清先删除其子菜单',menu_index);exit;
       }
       
       
      // echo $menu->getLastSql();
      
       if($res1=$menu->where("id='$id'")->delete()){
           //删除成功
           $this->success('删除成功',menu_index);exit;
       }else{
           $menu->delete($id);
           //var_dump($menu->getLastSql());
           $this->error('删除失败',menu_index);
       }
       
      // echo 1;
   }
   
   //获取ajax请求，并进行判断
   public function getajax(){
        $str=isset($_POST['str'])?$_POST['str']:'';
        
        //实例化
        $menu=M("menu");
        if(($res=count($menu->where("name='$str'")->find()))>0){
            echo true;exit;
        }else{
            echo false;exit;
        }
   }
   
   
   //角色列表
   public function rolelist(){
       $this->auth('rolelist');
       //显示模板
       //实例化 
       $role=D('role');
       $count = $role->count(); //统计总数
       $page = new page($count,20);
       //获取数据库中的角色信息
       $res=$role->limit($page->firstRow.','.$page->listRows)->select();
       $show = $page->show();

       $this->assign('res',$res);
       $this->assign('page',$show);
       $this->display();
   }
   
   //添加角色
   public function roleadd(){
       $this->auth('roleadd');
       //实例化，并获取到所以的菜单
       $menu=M("menu");
       
      //一级菜单
      $res_par=$menu->where("menu_lev=1")->select();
      //二级菜单
      $res_son=$menu->where("menu_lev=2")->select();
      
      //分配变量，显示模板
      $this->assign('res_par',$res_par);
      $this->assign('res_son',$res_son);
      
      //显示模板
      $this->display();
   }
   
   //处理添加角色
   public function checkRoleadd(){
       //获取到所有传递过来的数据
      // var_dump($_POST);
      
       
       //取出所有的权限：
       $rolemodel = D("role");
       $menu=D('menu');
        if(empty($_POST['role_auth_ids'])){
            $this->error('至少要给角色添加一个权限',roleadd);
        }
        
        if(empty($_POST['role_name'])){
            $this->error('角色名不能为空',roleadd);
        }
           if($rolemodel->create()){
               $ids  = implode(',',$_POST['role_auth_ids']);
               
               //根据ids在menu表中找出对应的方法名称。
               $menu_c = $menu->where("id in($ids)")->field("menu_a")->select();//返回的是二维数组
               $a="";
               foreach($menu_c as $v){
                   if(!empty($v['menu_a'])){
                       $a.=$v['menu_a'].',';
                   }
               }
               
               $rolemodel->role_auth_ids=$ids;//对输入的数据进行处理，满足数据库的要求，
               $rolemodel->role_auth_ac=trim($a,',');
               //var_dump($rolemodel->role_auth_ac);exit;
               
               if($rolemodel->add()){
                   $this->success("添加角色成功",rolelist);exit;
               }else{
                   $this->error("添加角色失败",rolelist);
               }
           }else{
               //$this->error();
               $this->error("获取数据失败",rolelist);;
          } 
   }
   
    //角色编辑
    public function roleedit(){
        
        $this->auth('roleedit');
        //实例化
        $rolemodel = D("role");
        //获取当前id的角色信息
        $id=isset($_GET['id'])?$_GET['id']:"";
       
        if(empty($id)){
            //要修改的id为空
            $this->error('没有要修改的角色',rolelist);
            exit;
        }
        
        //实例化，并获取到所以的菜单
        $menu=M("menu");
         
        //一级菜单
        $res_par=$menu->where("menu_lev=1")->select();
        //二级菜单
        $res_son=$menu->where("menu_lev=2")->select();
        
        $res=$rolemodel->where("id=$id")->find();
        
        //分配变量，显示模板
        $this->assign('res_par',$res_par);
        $this->assign('res_son',$res_son);
        $this->assign('res',$res);
        $this->assign('id',$id);
        $this->display();
    }
    
    //角色删除
    public function roledelete(){
        $this->auth('roledelete');
        $id=isset($_GET['id'])?$_GET['id']:"";
        
        if(empty($id)){
            //要删除的id为空
            $this->error('没有要删除的角色',rolelist);
            exit;
        }

        //实例化
        $rolemodel = D("role");
        //删除前，先判断该角色下面是否还有用户
        $user=D('user');
        if($res=$user->where("role_id=$id")->select()){
            $this->error('该角色下还有用户，不能删除',rolelist);
            exit;
        }



        //实例化
        $rolemodel = D("role");
        //删除前，先判断是否还有子菜单
        
        // echo $menu->getLastSql();
        
        if($res1=$rolemodel->where("id='$id'")->delete()){
            //删除成功
            $this->success('删除成功',rolelist);exit;
        }else{
            
            //var_dump($menu->getLastSql());
            $this->error('删除失败',rolelist);
        }
         
        
    }
    
    //处理修改角色
    public function checkRoleedit(){
        //获取到所有传递过来的数据
        // var_dump($_POST);
    
        $id=isset($_POST['id'])?$_POST['id']:"";
        //取出所有的权限：
        $rolemodel = D("role");
        $menu=D('menu');
         //将id放入变量
        $_POST['id']=$id;
        if(empty($_POST['role_name'])){
            
            $this->error('菜单名称不能为空',rolelist);
        }
        
        if($rolemodel->create()){
            $ids  = implode(',',$_POST['role_auth_ids']);
             
            //根据ids在menu表中找出对应的方法名称。
            $menu_c = $menu->where("id in($ids)")->field("menu_a")->select();//返回的是二维数组
            $a="";
            foreach($menu_c as $v){
                if(!empty($v['menu_a'])){
                    $a.=$v['menu_a'].',';
                }
            }
             
            $rolemodel->role_auth_ids=$ids;//对输入的数据进行处理，满足数据库的要求，
            $rolemodel->role_auth_ac=trim($a,',');
            //var_dump($_POST);exit;
             
            if($rolemodel->save()){
                $this->success("修改角色成功",rolelist);exit;
            }else{
                $this->error("修改角色失败",rolelist);
            }
        }else{
            //$this->error();
            $this->error("获取数据失败",rolelist);;
        }
    }
    
}










