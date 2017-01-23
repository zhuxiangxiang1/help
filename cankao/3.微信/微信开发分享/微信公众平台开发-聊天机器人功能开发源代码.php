<?php
/**
 * 微信公众平台-聊天机器人功能源代码
 * ================================
 * Copyright 2013-2014 David Tang
 * http://www.cnblogs.com/mchina/
 * 乐思乐享微信论坛
 * http://www.joythink.net/
 * ================================
 * Author:David|唐超
 * 个人微信：mchina_tang
 * 公众微信：zhuojinsz
 * Date:2013-10-12
 */

//define your token
define("TOKEN", "zhuojinsz");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->responseMsg();
//$wechatObj->valid();

class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				if(!empty( $keyword ))
                {
              		$msgType = "text";
                	//$contentStr = "Welcome to wechat world!";
					//调戏小黄鸡
					//$contentStr = $this->simsim($keyword);
					//调戏小九
					//$contentStr = $this->xiaojo($keyword);
					//双龙戏凤
					$contentStr = $this->chatter($keyword);
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                }else{
                	echo "Input something...";
                }

        }else {
        	echo "";
        	exit;
        }
    }

	//小黄鸡
	public function simsim($keyword){

		$key="41250a68-3cb5-43c8-9aa2-d7b3caf519b1";
		$url_simsimi="http://sandbox.api.simsimi.com/request.p?key=".$key."&lc=ch&ft=0.0&text=".$keyword;
		
		$json=file_get_contents($url_simsimi);

		$result=json_decode($json,true);

		//$errorCode=$result['result'];

		$response=$result['response'];

		if(!empty($response)){
			return $response;
		}else{
			$ran=rand(1,5);
			switch($ran){
				case 1:
					return "小鸡鸡今天累了，明天再陪你聊天吧。";
					break;
				case 2:
					return "小鸡鸡睡觉喽~~";
					break;
				case 3:
					return "呼呼~~呼呼~~";
					break;
				case 4:
					return "你话好多啊，不跟你聊了";
					break;
				case 5:
					return "感谢您关注【卓锦苏州】"."\n"."微信号：zhuojinsz"."\n"."卓越锦绣，万代不朽";
					break;
				default:
					return "感谢您关注【卓锦苏州】"."\n"."微信号：zhuojinsz"."\n"."卓越锦绣，万代不朽";
					break;
			}
		}
	}

	//小九机器人
	public function xiaojo($keyword){

		$curlPost=array("chat"=>$keyword);
		$ch = curl_init();//初始化curl
		curl_setopt($ch, CURLOPT_URL,'http://www.xiaojo.com/bot/chata.php');//抓取指定网页
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
		curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
		$data = curl_exec($ch);//运行curl
		curl_close($ch);
		if(!empty($data)){
			return $data;
		}else{
			$ran=rand(1,5);
			switch($ran){
				case 1:
					return "小鸡鸡今天累了，明天再陪你聊天吧。";
					break;
				case 2:
					return "小鸡鸡睡觉喽~~";
					break;
				case 3:
					return "呼呼~~呼呼~~";
					break;
				case 4:
					return "你话好多啊，不跟你聊了";
					break;
				case 5:
					return "感谢您关注【卓锦苏州】"."\n"."微信号：zhuojinsz"."\n"."卓越锦绣，万代不朽";
					break;
				default:
					return "感谢您关注【卓锦苏州】"."\n"."微信号：zhuojinsz"."\n"."卓越锦绣，万代不朽";
					break;
			}
		}
	}

	//双龙戏凤
	public function chatter($keyword){

		$curlPost=array("chat"=>$keyword);
		$ch = curl_init();	//初始化curl
		curl_setopt($ch, CURLOPT_URL,'http://www.xiaojo.com/bot/chata.php');	//抓取指定网页
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_HEADER, 0);	//设置header
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	//要求结果为字符串且输出到屏幕上
		curl_setopt($ch, CURLOPT_POST, 1);	//post提交方式
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
		$data = curl_exec($ch);	//运行curl
		curl_close($ch);

		if(!empty($data)){
			return $data." [/::)小九]";
		}else{
			return $this->simsim($keyword)." [simsim/::D]";
		}
	}
		
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>