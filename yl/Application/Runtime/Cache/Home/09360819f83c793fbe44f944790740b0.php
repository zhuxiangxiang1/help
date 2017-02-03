<?php if (!defined('THINK_PATH')) exit(); session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>遥点平台</title>
    <link href="/yl0203/yl/Public/Home/css/css.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="/yl0203/yl/Public/Home/js/sdmenu.js"></script>
    <script type="text/javascript">
        // <![CDATA[
        var myMenu;
        window.onload = function() {
            myMenu = new SDMenu("my_menu");
            myMenu.init();
        };
        // ]]>
    </script>
    <style type=text/css>
        html{ SCROLLBAR-FACE-COLOR: #538ec6; SCROLLBAR-HIGHLIGHT-COLOR: #dce5f0; SCROLLBAR-SHADOW-COLOR: #2c6daa; SCROLLBAR-3DLIGHT-COLOR: #dce5f0; SCROLLBAR-ARROW-COLOR: #2c6daa;  SCROLLBAR-TRACK-COLOR: #dce5f0;  SCROLLBAR-DARKSHADOW-COLOR: #dce5f0; overflow-x:hidden;}
        body{overflow-x:hidden; background:url(/yl0203/yl/Public/Home/images/main/leftbg.jpg) left top repeat-y #f2f0f5; width:194px;}
    </style>
</head>
<body onselectstart="return false;" ondragstart="return false;" oncontextmenu="return false;">
<div id="left-top">
    <span>用户：<?php echo ($_SESSION['list'][0]['user_phone']); ?>
    	<br>角色：
         <?php echo ($_SESSION['role_name']); ?>
    </span>
</div>
<div style="float: left" id="my_menu" class="sdmenu">
    <?php if(is_array($res)): $k = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="collapsed">
            <span><?php echo ($v["name"]); ?></span>
            <?php if(is_array($res1)): $k = 0; $__LIST__ = $res1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k; if($vo['menu_p']==$v['id']){ echo "<a target='mainFrame' onFocus='this.blur()'". "href='/yl0203/yl/index.php/Home/".$vo['menu_c']."/".$vo['menu_a']."'" .">".$vo['name']."</a>"; } endforeach; endif; else: echo "" ;endif; ?>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>



</div>
</body>
</html>