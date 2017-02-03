<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>U玩平台 - 禹乐网络科技</title>
<meta name="keywords" content="vu联盟,u兔游戏,数据结算" />
<meta name="description" content="vu联盟,u兔游戏,数据结算" />
<link type="text/css" href="/yl0203/yl/Public/Home/css/login/reset.css" rel="stylesheet">
<link type="text/css" href="/yl0203/yl/Public/Home/css/login/public.css" rel="stylesheet">
<link type="text/css" href="/yl0203/yl/Public/Home/css/login/register.css" rel="stylesheet">
<style>
	.loginad{
		width:580px;
		height:595px;
		position: absolute;
	}
	.loginad .loginadtitle{
		width:100%;
		text-align:center;
		line-height:60px;
		font-size:32px;
		font-family:"幼圆",Microsoft Yahei;
		margin-top:70px;
		color:#FFF;
	}
	.loginad .loginaddes{
		line-height:30px;
		color:#FFF;
		font-family:Microsoft Yahei;
		font-size:16px;
		text-align:center
	}
	.loginad .loginadimg{
		width:100%; 
		height:320px;
		margin-top:40px;
		
	}
	.loginad .loginadbtn{ width:100%; height:40px; margin-top:30px; }
	.loginad .loginadbtn a{ display:block; width:190px; height:40px; margin:0 auto; text-align:center; line-height:40px; font-size:16px; color:#009fe3; font-weight:bold; background:url(/themes/images/v3/btn.png) center center no-repeat;
		-moz-border-radius:6px;
		-khtml-border-radius:6px;
		-webkit-border-radius:6px;
		border-radius:6px;
	}
</style>
</head>
<body>
	<div id="header">
		<div class="header">
			<h1 class="png_bg">VU联盟</h1>
			<a href="#">禹乐科技</a>
		</div>
	</div>	
	
	<div class="login_bg">
		<div class="form">
        	<div class="loginad">
            	<div class="loginadtitle">禹乐科技旗下综合数据管理平台</div>
                <div class="loginaddes">专注、极致、用心，我们致力于打造最专业便捷的游戏数据分发平台</div>
                <div class="loginadbtn"><a  href="#" target="_blank">马上查看</a></div>
            </div>
			
			<form name="loginForm" id="login_form" method="post" action="/yl0203/yl/index.php/Home/Login/checklogin">
				<h2>登录VU联盟平台</h2>
				<input type="hidden" name="action" value="login"/>
				<div class="div_user"><span></span><input  name="user_phone" class="username" type="text" placeholder="用户名" /></div>
				<div class="div_pw"><span></span><input class="pw" name="password" type="password" placeholder="密码" /></div>
				<div class="div_box">
					<label><input type="checkbox" class="" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;下次自动登录</label>
					<!--<a class="forgetPw" href="#">忘记密码？</a>-->
				</div>
				<div><input class="login_btn" id="loginBtn" type="submit" value="登录" /></div>
                <div style="line-height:30px; text-indent:5px;color:#F30" id="loginTips">&nbsp;</div>
				<h4>还没有VU账号？请--><a class="#" href="<?php echo U('Login/zhuce');?>">立即注册</a></h4>
				<a href="#"><img src="/yl0203/yl/Public/Home/images/qq.png" alt="" /></a>
			</form>
		</div>
	</div>
	
	
<!-- footer start -->
<div id="footer" class="clear">
    <h1 class="png_bg">禹乐科技</h1>
    <div class="friendLink clear">
		<?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><a  href="<?php echo ($v["site_url"]); ?>" title="<?php echo ($v["site_name"]); ?>" target="_blank"><?php echo ($v["site_name"]); ?></a>
        <!--<a  href="http://www.ttbbss.com/" title="手游天堂" target="_blank">手游天堂</a>
        <a href="http://sdk.utoozs.com/html/" target="_blank">U兔游戏</a>
        <a href="#" rel="nofollow">手游智库</a>
        <a href="#" rel="nofollow">VU联盟</a>
        <a href="#" rel="nofollow">企业官网</a>
        <a href="#" rel="nofollow">联系我们</a>--><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <p><?php echo ($list["bottom"]); ?></p>
    <div class="weixin">
        <!--<img src="http://pay.ttbbss.com/skin/images/v3/weixin.jpg" alt="" />
        <h3>扫码关注我们</h3>-->
    </div>
</div>
</body>
</html>