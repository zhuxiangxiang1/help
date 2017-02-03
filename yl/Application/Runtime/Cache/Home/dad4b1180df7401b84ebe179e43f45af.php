<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>遥点平台</title>
	<link href="/yl/Public/Home/css/css.css" type="text/css" rel="stylesheet" />
	<link href="/yl/Public/Home/css/main.css" type="text/css" rel="stylesheet" />
	<!--<script src='/yl/Public/Home/js/jquery.js'></script>-->
	<link rel="stylesheet" href="/yl/Public/Home/js/clock/default.css" id="theme_base">
	<link rel="stylesheet" href="/yl/Public/Home/js/clock/default.date.css" id="theme_date">
	<link rel="stylesheet" href="/yl/Public/Home/js/clock/default.time.css" id="theme_time">
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="/yl/Public/Home/js/clock/picker.js"></script>
	<script src="/yl/Public/Home/js/clock/picker.date.js"></script>
	<script src="/yl/Public/Home/js/clock/picker.time.js"></script>
	<link rel="stylesheet" href="/yl/Public/Home/page.css"/>
	<script>
		function conf(){
			if(confirm('确定要处理订单吗？')){
				return true;
			}else{
				return false;
			}
		}
	</script>
	<style>body {
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
		color: #FFF;
		float: left
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
		background: url(/yl/Public/Home/images/main/add.jpg) no-repeat -3px 7px #548fc9;
		padding: 0 10px 0 26px;
		height: 40px;
		line-height: 40px;
		font-size: 14px;
		font-weight: bold;
		color: #FFF;
		float: right
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
		background: #f9f9f9
	}</style>
</head>
<body>

<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
	<tr>
		<td width="99%" align="left" valign="top">您的位置：订单列表&nbsp;&nbsp;>&nbsp;&nbsp;订单处理</td>
	</tr>
	<tr>
		<td align="left" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
				<tr>
					<td width="90%" align="left" valign="middle">
						<form action="" method='get'>
						<input value="<?php echo ($_GET['chaxun']); ?>" style="margin-left: 20px; width: 150px; height: 25px; margin-right: 20px;" class="form-control"  type='text' name='chaxun' placeholder="搜索">
						<select name='tiaojian' style='height:35px;'>
							<option value="order_no">订单号</option>
							<option value="order_realname">打款人姓名</option>
							<option value="order_phone">打款人手机号</option>
						</select>
						<input type='submit' value='查询' style='height:25px; width: 50px; margin-right: 100px;' class="btn btn-info">
						<input id="datepicker" value="<?php echo ($_GET['time']); ?>" name='time' style="margin-left: 20px; width: 150px; height: 25px;" type="text" id="datepicker"  placeholder="填入下单日期"/>
						<input type='submit' value='搜索'  style='height:25px; width: 50px;' class="btn btn-info">
						</form>
					</td>
					<td width="10%" align="center" valign="middle" style="text-align:right; width:150px;">
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="left" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
				<tr>
					<th align="center" valign="middle" class="borderright">编号</th>
					<th align="center" valign="middle" class="borderright">订单号</th>
					<th align="center" valign="middle" class="borderright">打款人姓名</th>
					<th align="center" valign="middle" class="borderright">打款人手机号</th>
					<th align="center" valign="middle" class="borderright">打款金额</th>
					<th align="center" valign="middle" class="borderright">充值金额</th>
					<th align="center" valign="middle" class="borderright">游戏平台</th>
					<th align="center" valign="middle" class="borderright">游戏名称</th>
					<th align="center" valign="middle" class="borderright">后台账户</th>
					<th align="center" valign="middle" class="borderright">渠道号</th>
					<th align="center" valign="middle" class="borderright">下单时间</th>
					<th align="center" valign="middle" class="borderright">处理人姓名</th>
					<th align="center" valign="middle" class="borderright">处理时间</th>
					<th align="center" valign="middle" class="borderright">操作</th>
				</tr>
				<?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
						<td align="center" valign="middle" class="borderright borderbottom"><?php echo ($k); ?></td>
						<td align="center" valign="middle" class="borderright borderbottom"><?php echo ($v["order_no"]); ?></td>
						<td align="center" valign="middle" class="borderright borderbottom"><?php echo ($v["order_realname"]); ?></td>
						<td align="center" valign="middle" class="borderright borderbottom"><?php echo ($v["order_phone"]); ?></td>
						<td align="center" valign="middle" class="borderright borderbottom"><?php echo ($v["order_money"]); ?></td>
						<td align="center" valign="middle" class="borderright borderbottom"><?php echo ($v["order_recharge"]); ?></td>
						<td align="center" valign="middle" class="borderright borderbottom"><?php echo ($v["order_platform"]); ?></td>
						<td align="center" valign="middle" class="borderright borderbottom"><?php echo ($v["order_gamename"]); ?></td>
						<td align="center" valign="middle" class="borderright borderbottom"><?php echo ($v["order_adminno"]); ?></td>
						<td align="center" valign="middle" class="borderright borderbottom"><?php echo ($v["order_channel"]); ?></td>
						<td align="center" valign="middle" class="borderright borderbottom"><?php echo ($v["order_time"]); ?></td>
						<td align="center" valign="middle" class="borderright borderbottom"><?php echo ($v["order_operaname"]); ?></td>
						<td align="center" valign="middle" class="borderright borderbottom"><?php echo ($v["order_operatime"]); ?></td>
						<td align="center" valign="middle" class="borderright borderbottom">
							<?php if($v["order_status"] == 1 ): ?><a href="<?php echo U('Order/deal');?>?id=<?php echo ($v["order_id"]); ?>">处理订单</a>
							<?php else: ?>
								<label style="color: #00A000">已处理</label><?php endif; ?>
						</td><?php endforeach; endif; else: echo "" ;endif; ?>
			</table>
			<div id="page" class="green-black"><?php echo ($page); ?></div>
		</td>
	</tr>
</table>
<script type="text/javascript">

	var $input = $('#datepicker').pickadate()

</script>
</body>
</html>