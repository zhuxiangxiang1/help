<?php
return array(
	//'配置项'=>'配置值'
	//
    'TMPL_PARSE_STRING' => array(
        '__JS__' => __ROOT__ . '/Public/Home/js',
        '__CSS__' => __ROOT__ . '/Public/Home/css',
        '__IMAGE__' => __ROOT__ . '/Public/Home/images',
        '__UPLOAD__' => __ROOT__ . '/Public/Home/upload',
    ),

    /*'MAIL_SMTP'            =>  TRUE,
    'MAIL_HOST'            =>  'smtp.163.com',          //邮件发送SMTP服务器
    'MAIL_SMTPAUTH'   =>  TRUE,
    'MAIL_USERNAME'   =>  '18368765808@163.com',       //SMTP服务器登陆用户名
    'MAIL_PASSWORD'   =>  'applezxx123',              //SMTP服务器登陆密码
    'MAIL_SECURE'         =>  'tls',
    'MAIL_CHARSET'       =>  'utf-8',
    'MAIL_ISHTML'         =>  TRUE,
    'MAIL_FROMNAME' =>  '禹乐科技',

    //支付宝配置参数
    'alipay_config'=>array(
        'partner' =>'2088521139824685',   //这里是你在成功申请支付宝接口后获取到的PID；
        'key'=>'5e1l9eo803fuftaom0z2cadis8mr1jig',//这里是你在成功申请支付宝接口后获取到的Key
        'sign_type'=>strtoupper('MD5'),
        'input_charset'=> strtolower('utf-8'),
        'cacert'=> getcwd().'\\cacert.pem',
        'transport'=> 'http',
    ),
    //以上配置项，是从接口包中alipay.config.php 文件中复制过来，进行配置；

    'alipay'   =>array(
        //这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号
        'seller_email'=>'zxn@hzylwl.com',
        //这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
        'notify_url'=>'http://127.0.0.1/yl/index.php/Home/Index/index',
        //这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
        'return_url'=>'http://127.0.0.1/yl/index.php/Home/Index/index',
        //支付成功跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参payed（已支付列表）
        'successpage'=>'Pay/returnurl?ordtype=payed',
        //支付失败跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参unpay（未支付列表）
        'errorpage'=>'Pay/returnurl?ordtype=unpay',
    ),*/

    'TMPL_ACTION_SUCCESS'=>'Public:dispatch_jump',
    'TMPL_ACTION_ERROR'=>'Public:dispatch_jump',

);