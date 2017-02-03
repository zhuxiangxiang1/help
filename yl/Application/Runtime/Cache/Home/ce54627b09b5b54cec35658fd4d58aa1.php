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
		<script>
			function aa(){
				if(confirm("您确定要添加吗")){
					return true;
				}else{
					return false;
				}
			}

		</script>
	</head>
	<body>
		<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
			<tr>
				<td height="20px" width="99%" align="left" valign="top">您的位置：权限管理&nbsp;&nbsp;>&nbsp;&nbsp;角色添加</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<form method="post" action="<?php echo U('Menu/checkRoleadd');?>">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">角色名称：</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for">
									<input id='role_name' placeholder="请输入角色名称" type="text" name="role_name" value="" class="text-word">
								</td>
							</tr>
							
							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">分配权限：</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for">
									
								</td>
							</tr>
							
							<!-- 将顶级权限设为标题 -->
							<?php if(is_array($res_par)): foreach($res_par as $key=>$vo): ?><tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								
								<td align="right" valign="middle" class="borderright borderbottom bggray">
									<span style='font-size:10px'><?php echo ($vo["name"]); ?></span>&nbsp;&nbsp;&nbsp;<input  class='menus' type="checkbox" name="role_auth_ids[]" value="<?php echo ($vo["id"]); ?>" style='height:15px;width:15px'>
								</td>
								
								<td align="left" class="borderright borderbottom main-for">
								<!-- 将次级权限设为内容 -->
									<?php if(is_array($res_son)): foreach($res_son as $key=>$v): if($v['menu_p'] == $vo['id']): ?><input  class='submenus' type="checkbox" name="role_auth_ids[]" value="<?php echo ($v["id"]); ?>" style='height:15px;width:15px'>&nbsp;<span style='font-size:10px'><?php echo ($v["name"]); ?></span><span class="gray">&nbsp;&nbsp;|&nbsp;&nbsp;</span><?php endif; endforeach; endif; ?>
								</td>
								
								
							</tr><?php endforeach; endif; ?>

							
							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">备注信息：</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for">
									<textarea style='width:320px; height:150px;resize: none;resize: none;' name='role_beizhu'>
	           						备注信息
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
<!-- 当点击复选框时，选出后面td中的所以选项 -->
<script>
$(".menus").click(function(){
    //选择自己的状态，
    var attrs = $(this).attr("checked");
    //要选择该权限对应的子权限对应的复选框。
    //alert(typeof(attrs));
    
    if(attrs==undefined){
    	//alert(1);
    	$(this).parent().parent().find(".submenus").removeAttr("checked");
    }else{
    	$(this).parent().parent().find(".submenus").attr("checked",attrs);
    }
    
    
  //  $(".submenus").attr("checked",attrs);
});

$(".submenus").click(function(){
    if($(this).attr('checked')){
    //只有当前复选框被选中时，才执行如下代码
        $(this).parent().parent().find("input:first").attr('checked','checked');
    }
    $(this).parent().parent().find(".submenus").each(function(){
        if($(this).attr('checked')){
            var flag=true;
           // break;
        }});
        if(!flag){
            $(this).parent().parent().find("input:first").removeAttr('checked');
        }
});

</script>