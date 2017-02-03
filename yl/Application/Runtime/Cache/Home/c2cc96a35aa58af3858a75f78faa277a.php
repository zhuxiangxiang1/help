<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>遥点平台</title>
    <link href="/yl0203/yl/Public/Home/css/css.css" type="text/css" rel="stylesheet" />
    <link href="/yl0203/yl/Public/Home/css/main.css" type="text/css" rel="stylesheet" />
    <script src="/yl0203/yl/Public/Home/js/jquery.js"></script>
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
            background: url(/yl0203/yl/Public/Home/images/main/list_input.jpg) no-repeat left top;
            border: none;
            cursor: pointer;
            font-family: "Microsoft YaHei", "Tahoma", "Arial", '宋体';
            color: #666;
            float: left;
            margin: 8px 0 0 6px;
            display: inline;
        }

        #search a.add {
            background: url(/yl0203/yl/Public/Home/images/main/add.jpg) no-repeat 0px 6px;
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
            background: url(/yl0203/yl/Public/Home/images/main/list_bg.jpg) repeat-x;
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
        <td width="49%" align="left" valign="top">
            您的位置：用户管理 > 个人中心<br><br>
            <?php if(is_array($notice_list)): $k = 0; $__LIST__ = $notice_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><span style=" color: red; font-size: 15px;">公告：<a href="<?php echo U('Notice/detail');?>?id=<?php echo ($v["notice_id"]); ?>"><?php echo ($v["notice_title"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?>
        </td>
        <td></td>
    </tr>
    <tr>
        <td align="left" valign="top">
            <form method="POST" action="<?php echo U('User/editUser');?>">
                <table width="80%" border="0" cellspacing="0" cellpadding="0" id="main-tab" align="center" style="margin-left: 40px; margin-top: 40px;">
                    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align="right" valign="middle" class="borderright borderbottom bggray">真实姓名：</td>
                        <td align="left" valign="middle" class="borderright borderbottom main-for"><?php echo ($user_list["user_realname"]); ?></td>
                    </tr>
                    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align="right" valign="middle" class="borderright borderbottom bggray">身份证号码：</td>
                        <td align="left" valign="middle" class="borderright borderbottom main-for"><?php echo ($user_list["user_idcard"]); ?></td>
                    </tr>
                    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align="right" valign="middle" class="borderright borderbottom bggray">手机号码：</td>
                        <td align="left" valign="middle" class="borderright borderbottom main-for"><?php echo ($user_list["user_phone"]); ?></td>
                    </tr>
                    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align="right" valign="middle" class="borderright borderbottom bggray">邮箱：</td>
                        <td align="left" valign="middle" class="borderright borderbottom main-for">
                            <input type="text" name="user_email" class="text-word" value="<?php echo ($user_list["user_email"]); ?>" >
                        </td>
                    </tr>
                    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align="right" valign="middle" class="borderright borderbottom bggray">用户余额(元)：</td>
                        <td align="left" valign="middle" class="borderright borderbottom main-for"><?php echo ($user_list["user_money"]); ?></td>
                    </tr>
                    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align="right" valign="middle" class="borderright borderbottom bggray">银行卡卡号：</td>
                        <td align="left" valign="middle" class="borderright borderbottom main-for">
                            <input type="text" name="bankid" id="bankid" class="text-word" value="<?php echo ($user_list["bankid"]); ?>" >
                        </td>
                    </tr>
                    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align="right" valign="middle" class="borderright borderbottom bggray">所属银行：</td>
                        <td align="left" valign="middle" class="borderright borderbottom main-for">
                            <label id="bank" ><?php echo ($user_list["bank"]); ?></label>
                            <script>
                                $(function(){
                                    //ajax触发事件
                                    $("#bankid").mouseout(function(){
                                        $.ajax({
                                            type:"POST",
                                            url:"<?php echo U('User/getAjax');?>",
                                            data:{"bankid":$('#bankid').val()},
                                            success:function(msg){
                                                //$("#bank").empty();
                                                json = eval(msg);
                                                //alert(json);
                                                $("#bank").text(json);
                                            }
                                        })
                                    })
                                })
                            </script>
                        </td>
                    </tr>

                    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align="right" valign="middle" class="borderright borderbottom bggray">支付宝账号：</td>
                        <td align="left" valign="middle" class="borderright borderbottom main-for">
                            <input type="text" name="alipay" class="text-word" value="<?php echo ($user_list["alipay"]); ?>" >
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
        <td align="left" valign="top">
            <?php if($_SESSION['list'][0]['role_id'] != 2): ?><table width="80%" border="0" cellspacing="0" cellpadding="0" id="main-tab" style="margin-left: 40px; margin-top: 40px;">

                 
                <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                    <td align="right" valign="middle" class="borderright borderbottom bggray">订单总金额(元)：</td>
                    <td align="left" valign="middle" class="borderright borderbottom main-for"><?php echo ($all); ?></td>
                </tr>
                <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                    <td align="right" valign="middle" class="borderright borderbottom bggray" style="width: 200px;">已处理的订单总金额(元)：</td>
                    <td align="left" valign="middle" class="borderright borderbottom main-for"><?php echo ($yes); ?></td>
                </tr>
                <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                    <td align="right" valign="middle" class="borderright borderbottom bggray">未处理的订单总金额(元)：</td>
                    <td align="left" valign="middle" class="borderright borderbottom main-for"><?php echo ($no); ?></td>
                </tr>
            </table><?php endif; ?>
        </td>
    </tr>

</table>
</body>
</html>