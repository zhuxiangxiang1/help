<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>遥点平台</title>
		<link href="/yl/Public/Home/css/css.css" type="text/css" rel="stylesheet" />
		<link href="/yl/Public/Home/css/main.css" type="text/css" rel="stylesheet" />
		<script src='/yl/Public/Home/js/jquery.js'></script>
		<style>
body {
	overflow-x: hidden;
	background: #f2f0f5;
	padding: 15px 0px 10px 5px;
}

#searchmain {
	font-size: 12px;
}

#search {
	font-size: 12px;
	background: #548fc9;
	margin: 10px 10px 0 0;
	display: inline;
	width: 100%;
	color: #FFF
}

#search form span {
	height: 40px;
	line-height: 40px;
	padding: 0 0px 0 10px;
	float: left;
}

#search form input.text-word {
	height: 24px;
	line-height: 24px;
	width: 180px;
	margin: 8px 0 6px 0;
	padding: 0 0px 0 10px;
	float: left;
	border: 1px solid #FFF;
}

#search form input.text-but {
	height: 24px;
	line-height: 24px;
	width: 55px;
	background: url(/yl/Public/Home/images/main/list_input.jpg) no-repeat left top;
	border: none;
	cursor: pointer;
	font-family: "Microsoft YaHei", "Tahoma", "Arial", '宋体';
	color: #666;
	float: left;
	margin: 8px 0 0 6px;
	display: inline;
}

#search a.add {
	background: url(/yl/Public/Home/images/main/add.jpg) no-repeat 0px 6px;
	padding: 0 10px 0 26px;
	height: 40px;
	line-height: 40px;
	font-size: 14px;
	font-weight: bold;
	color: #FFF
}

#search a:hover.add {
	text-decoration: underline;
	color: #d2e9ff;
}

#main-tab {
	border: 1px solid #eaeaea;
	background: #FFF;
	font-size: 12px;
}

#main-tab th {
	font-size: 12px;
	background: url(/yl/Public/Home/images/main/list_bg.jpg) repeat-x;
	height: 32px;
	line-height: 32px;
}

#main-tab td {
	font-size: 12px;
	line-height: 40px;
}

#main-tab td a {
	font-size: 12px;
	color: #548fc9;
}

#main-tab td a:hover {
	color: #565656;
	text-decoration: underline;
}

.bordertop {
	border-top: 1px solid #ebebeb
}

.borderright {
	border-right: 1px solid #ebebeb
}

.borderbottom {
	border-bottom: 1px solid #ebebeb
}

.borderleft {
	border-left: 1px solid #ebebeb
}

.gray {
	color: #dbdbdb;
}

td.fenye {
	padding: 10px 0 0 0;
	text-align: right;
}

.bggray {
	background: #f9f9f9;
	font-size: 14px;
	font-weight: bold;
	padding: 10px 10px 10px 0;
	width: 120px;
}

.main-for {
	padding: 10px;
}

.main-for input.text-word {
	width: 310px;
	height: 36px;
	line-height: 36px;
	border: #ebebeb 1px solid;
	background: #FFF;
	font-family: "Microsoft YaHei", "Tahoma", "Arial", '宋体';
	padding: 0 10px;
}

.main-for select {
	width: 310px;
	height: 36px;
	line-height: 36px;
	border: #ebebeb 1px solid;
	background: #FFF;
	font-family: "Microsoft YaHei", "Tahoma", "Arial", '宋体';
	color: #666;
}

.main-for input.text-but {
	width: 100px;
	height: 40px;
	line-height: 30px;
	border: 1px solid #cdcdcd;
	background: #e6e6e6;
	font-family: "Microsoft YaHei", "Tahoma", "Arial", '宋体';
	color: #969696;
	float: left;
	margin: 0 10px 0 0;
	display: inline;
	cursor: pointer;
	font-size: 14px;
	font-weight: bold;
}

</style>

	</head>
	<body>
		<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
			<tr>
				<td height="20px" width="99%" align="left" valign="top">您的位置：权限管理&nbsp;&nbsp;>&nbsp;&nbsp;添加菜单</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<form method="post" action="<?php echo U('Menu/checkadd');?>">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">上级菜单：</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for">
							<select style='width:150px;height:30px' name='menu_p'>
	           						
	           					<?php if(is_array($res)): foreach($res as $key=>$vo): ?><option value='<?php echo ($vo["id"]); ?>' name='menu_p'><?php echo str_repeat('--',$vo['menu_lev']);?>&nbsp;&nbsp;&nbsp;<?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
	           				</select>
								</td>
							</tr>
							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">菜单名称：</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for">
									<input id='menu_name' placeholder="请输入菜单名称" type="text" name="name" value="" class="text-word">
								</td>
							</tr>
							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">控制器名称：</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for">
									<input placeholder="请输入控制器名称" type="text" name="menu_c" value="" class="text-word">
								</td>
							</tr>
							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">动作名称：</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for">
									<input placeholder="请输入动作" type="text" name="menu_a" value="<?php echo ($list["notice_title"]); ?>" class="text-word">
								</td>
							</tr>

							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">是否显示菜单：</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for">
									<select name='menu_view'>
										<option value='1'>显示</option>
										<option value='2'>隐藏</option>
									</select>
								</td>
							</tr>
							
							
							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">备注信息：</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for">
									<textarea style='width:320px; height:150px;resize: none;' name='menu_beizhu'>
	           						</textarea>
								</td>
							</tr>
							

							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">&nbsp;</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for">
									<input id='bt1' name="" type="submit" value="添加" class="text-but">
									
								</td>
							</tr>

						</table>
					</form>
				</td>
			</tr>
			
		</table>
	</body>
</html>
<script>
	$().ready(function(){
		fn1()
	});
	//判断后台菜单是否存在
	$('#menu_name').blur(function(){
		var str=$('#menu_name').val();
		//alert(str);
		//进行ajax传递
		var data={str:str};
		$.post('/yl/index.php/Home/Menu/getajax',"str="+str,function(msg){
			if(msg){
				alert('该菜单已经存在');
				$('#bt1').attr('disabled','disabled');
			}else{
				
				$('#bt1').removeAttr('disabled');
			}
		});
	});
</script>