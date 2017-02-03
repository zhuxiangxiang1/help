<?php if (!defined('THINK_PATH')) exit();?><html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>遥点平台</title>
        <link href="/yl0203/yl/Public/Home/css/css.css" type="text/css" rel="stylesheet" />
        <link rel="Shortcut Icon" href="/yl0203/yl/Public/Home/images/favicon.ico" type="image/x-icon"/>

    </head>
    <body onselectstart="return false" oncontextmenu=return(false) style="overflow-x:hidden;">
        <!--禁止网页另存为-->
        <noscript><iframe scr="*.htm"></iframe></noscript>
        <!--禁止网页另存为-->
        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="header">
            <tr>
                <td rowspan="2" align="left" valign="top" id="logo"><!--<img src="/yl0203/yl/Public/Home/images/main/logo.jpg" width="74" height="64">--></td>
                <td align="left" valign="bottom">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="left" valign="bottom" id="header-name"><?php echo ($list["site_name"]); ?></td>
                        <td align="right" valign="top" id="header-right">
                            <a href="<?php echo U('Login/logout');?>" target="_top" onFocus="this.blur()" class="admin-out">注销</a>
                            <a href="<?php echo U('Index/index');?>" target="_blank" onFocus="this.blur()" class="admin-index">网站首页</a>
                            <span>
                                <!-- 日历 -->
                                <SCRIPT type=text/javascript src="/yl0203/yl/Public/Home/js/clock.js"></SCRIPT>
                                <SCRIPT type=text/javascript>showcal();</SCRIPT>
                            </span>
                        </td>
                      </tr>
                    </table>
                </td>
          </tr>
          <tr>
            <td align="left" valign="bottom">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="left" valign="top" id="header-admin">后台管理系统</td>
                    <td align="left" valign="bottom" id="header-menu">
                        <a href="<?php echo U('User/information');?>" target='mainFrame' onFocus="this.blur()" id="menuon">后台首页</a>
                        <!--<a href="http://118.178.191.2:8080/YL_XM/" target='mainFrame' onFocus="this.blur()">小米游戏</a>
                        <a href="<?php echo U('XiaoMi/index');?>" target='mainFrame' onFocus="this.blur()">小米游戏</a>
                        <a href="<?php echo U('XiaoMi/qudao9');?>" target='mainFrame' onFocus="this.blur()">渠道9</a>
                        <a href="<?php echo U('XiaoMi/qudao10');?>" target='mainFrame' onFocus="this.blur()">渠道10</a>-->
                    </td>
                  </tr>
                </table>
             </td>
          </tr>
        </table>
    </body>
</html>