<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>遥点平台</title>
		<link href="/yl/Public/Home/css/css.css" type="text/css" rel="stylesheet" />
		<link href="/yl/Public/Home/css/main.css" type="text/css" rel="stylesheet" />
		<script src="/yl/Public/Home/js/jquery.js"></script>
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
				if(confirm("您确定要支付吗")){
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
				<td height="20px" width="99%" align="left" valign="top">您的位置：订单列表&nbsp;&nbsp;>&nbsp;&nbsp;打款</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					
					<form method="post" action="<?php echo U('Order/checkzhifu');?>">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">打款人姓名：</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for"><?php echo ($_SESSION['list'][0]['user_realname']); ?></td>
							</tr>
							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">打款人手机号码：</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for"><?php echo ($_SESSION['list'][0]['user_phone']); ?></td>
							</tr>
							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">充值金额：</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for">
									<input id="charge" placeholder="请输入充值金额" type="text" name="order_recharge" class="text-word">
									<script>
										$(function(){
											$('#charge').focusout(function(){
												var charge=$("#charge").val();
											})
										})
									</script>
								</td>
							</tr>

							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">游戏平台：</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for">
									<select name="platform_name" class='recharge-int01 fl' id="platform">
										<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["platform_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									</select>
								</td>
							</tr>
							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">游戏名称：</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for">
									<div>
										<input name="game_name" type="text" size="30" value="" id="game_name" placeholder="请输入游戏名称" class="text-word" onkeyup="lookup(this.value);" onblur="fill();" />
									</div>
									<div class="suggestionsBox" id="suggestions" style="display: none;">
										<div class="suggestionList" id="autoSuggestionsList"></div>
									</div>
									<script type="text/javascript">
										function lookup(inputString) {
											//获取到平台的id来进行筛选
											var pt_id=$('#platform').val();
											if(inputString.length == 0) {
												$('#suggestions').hide();
											} else {
												$.post("/yl/index.php/Home/Order/getAjax", {name: ""+inputString+"",pt_id:""+pt_id+""}, function(data){
													if(data.length >0) {
														$('#suggestions').show();
														$('#autoSuggestionsList').html(data);
													}

												});
											}
										} // lookup
										function fill(thisValue) {
											$('#game_name').val(thisValue);
											setTimeout("$('#suggestions').hide();", 200);
										}
									</script>
									<style type="text/css">

										.suggestionsBox {
										position: relative;
										left: 30px;
										margin: 10px 0px 0px 0px;
										width: 200px;
										background-color: #212427;
										-moz-border-radius: 7px;
										-webkit-border-radius: 7px;
										border: 2px solid #000;
										color: #fff;
										}
										.suggestionList {
										margin: 0px;
										padding: 0px;
										}
										.suggestionList li {
										margin: 0px 0px 3px 0px;
										padding: 3px;
										cursor: pointer;
										}
										.suggestionList li:hover {
										background-color: #659CD8;
										}
									</style>
								</td>
							</tr>
							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">打款金额：</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for">
									<label id="money"></label>
									<script>
										$(function(){
											//ajax触发事件
											$("#autoSuggestionsList").click(function(){
												//获取平台名
												var pt_id=$('#platform').val();
												var game_name=$('#game_name').val();
												//alert(game_name);
												$.ajax({
													type:"POST",
													url:"<?php echo U('Order/moneyAjax');?>",
													data:{"discount":$('#game_name').val(),'pt_id':pt_id},
													success:function(msg){
														json = eval(msg);
														//alert(json[0].game_discount);//获取到了游戏所对应的折扣
														$("#money").text(($("#charge").val()*(json[0].game_discount))* 100 / 100);//把充值金额的值放到了打款金额中
													}
												})
											})
										})


									</script>
								</td>
							</tr>

							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">请输入后台账户&nbsp</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for">
									<input placeholder="请输入后台账户" class="text-word" type="text" name="order_adminNo">
								</td>
							</tr>

							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">请输入渠道号&nbsp</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for">
									<input placeholder="请输入渠道号" class="text-word" type="text" name="order_channel">
								</td>
							</tr>
							<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
								<td align="right" valign="middle" class="borderright borderbottom bggray">&nbsp;</td>
								<td align="left" valign="middle" class="borderright borderbottom main-for">
									<input name="" type="submit" value="提交" class="text-but">
									<input name="" type="reset" value="重置" class="text-but">
								</td>
							</tr>

						</table>
					</form>
					
				</td>
			</tr>
			
		</table>
	</body>
</html>