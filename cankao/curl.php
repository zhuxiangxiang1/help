<?php
//echo 1;exit;
header("content-type:text/html;charset=utf-8");
function curlPost($url,$data='',$method){
    $ch=curl_init(); //初始化
    curl_setopt($ch,CURLOPT_URL,$url); //请求地址
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method); //请求方式
    
    /*参数如下*/
    /*
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzip解压内容
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
    */
    if($method=="POST"){//5.post方式的时候添加数据
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $tmpInfo = curl_exec($ch);//6.执行
    
    if (curl_errno($ch)) {//7.如果出错
        return curl_error($ch);
    }
    curl_close($ch);//8.关闭
    return $tmpInfo;
}

    //$url中的网址是我们post或get所要传值的php
    $url="http://cga.yeeyk.com/cga-app/advanceCharge/charge";
    
    $merchantOrderNo=isset($_GET['merchantOrderNo'])?$_GET['merchantOrderNo']:"456789124";
    //echo $merchantOrderNo;exit;
    //$option中是我们所传的值
    $hmac="amount=30.00&chargeaccount=18368765808&merchantNo=50004&merchantOrderNo=".$merchantOrderNo."&productcardNumber=1&productcardParvalue=30&producttypeId=210008&key=6glJ29JA92y3C76SU775tS305yssB1";
    $hmac=md5($hmac);
    $hmac=strtoupper($hmac);
    
    $a="http://cga.yeeyk.com/cga-app/advanceCharge/charge?merchantNo=50004&merchantOrderNo=".$merchantOrderNo."&producttypeId=210008&amount=30.00&productcardNumber=1&productcardParvalue=30&chargeaccount=18368765808&hmac=".$hmac."&noticeSysaddress=http://192.168.140.1/yiyouku/index2.php";

    //echo $hmac;exit;
    $options=array(
        'merchantNo'=>'50013', //商户编号
        'merchantOrderNo'=>'100000527', //商户订单号
        'producttypeId'=>'210008', //产品编码
        'amount'=>'30.00', //订单金额
        'productcardNumber'=>'1', //支付数量
        'productcardParvalue'=>'1', //产品面值
        'productareaId'=>'', //服ID
        'productserverId'=>'', //区ID
        'savemoneymodeId'=>'', //充值方式
        'chargeaccount'=>'18368765808', //充值账号
        'noticeSysaddress'=>'', //系统通知地址
        'hmac'=>$hmac //签名数据
    );
    
//获取到数据   
$b=file_get_contents($a);
var_dump($b);exit;
$b=explode('&', $b);
if($b[0]=='errCode=000000'){
    echo "充值成功";
}else{
    echo $b[1];
}
exit;
//var_dump($b);exit;
    
    //echo "<pre/>";
    //var_dump($options);exit;
    //最后引用curlPost这个类（网址，数据，传值方式）；
    $result=curlPost($url,$options,'GET');
    echo $result;