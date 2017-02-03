<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>遥点平台</title>
		<link href="/yl0203/yl/Public/Home/css/css.css" type="text/css" rel="stylesheet" />
		<link rel="Shortcut Icon" href="/yl0203/yl/Public/Home/images/favicon.ico" type="image/x-icon"/>

	</head>
	<frameset rows="95,*,30" cols="*" frameborder="no" border="0" framespacing="0" onunload="alert('The onunload event was triggered')">
		<frame src="<?php echo U('Index/top');?>" name="topframe" scrolling="no" noresize id="topframe" title="topframe" />
		<frameset id="attachucp" framespacing="0" border="0" frameborder="no" cols="194,12,*" rows="*">
			<frame scrolling="auto" noresize="" frameborder="no" name="leftFrame" src="<?php echo U('Index/left');?>"></frame>
			<frame id="leftbar" scrolling="no" noresize="" name="switchFrame" src="<?php echo U('Index/main_list');?>"></frame>
			<frame scrolling="auto" noresize="" border="0" name="mainFrame" src="<?php echo U('User/Information');?>"></frame>
			<frame scrolling="auto" noresize="" border="0" name="mainFrame" src="<?php echo U('Index/main');?>"></frame>
		</frameset>
		<frame src="<?php echo U('Index/bottom');?>" name="bottomFrame" scrolling="No" noresize="noresize" id="bottomFrame" title="bottomFrame" />
	</frameset>
</html>