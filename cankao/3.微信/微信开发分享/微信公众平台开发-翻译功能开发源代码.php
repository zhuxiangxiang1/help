<?php
/**
 * 微信公众平台-翻译功能源代码
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

					$str_trans = mb_substr($keyword,0,2,"UTF-8");
					$str_valid = mb_substr($keyword,0,-2,"UTF-8");
					if($str_trans == '翻译' && !empty($str_valid)){
				
						$word = mb_substr($keyword,2,202,"UTF-8");
						//调用有道词典
						//$contentStr = $this->youdaoDic($word);
						//调用百度词典
						$contentStr = $this->baiduDic($word)."【百度】";

					}else {
						$contentStr = "感谢您关注【卓锦苏州】"."\n"."微信号：zhuojinsz"."\n"."卓越锦绣，万代不朽";
					}
					
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

	public function youdaoDic($word){

		$keyfrom = "zhuojin";	//申请APIKEY时所填表的网站名称的内容
		$apikey = "304804921";  //从有道申请的APIKEY
		
		/*/有道翻译-xml格式
		$url_youdao = 'http://fanyi.youdao.com/fanyiapi.do?keyfrom='.$keyfrom.'&key='.$apikey.'&type=data&doctype=xml&version=1.1&q='.$word;
		
		$xmlStyle = simplexml_load_file($url_youdao);
		
		$errorCode = $xmlStyle->errorCode;

		$paras = $xmlStyle->translation->paragraph;

		if($errorCode == 0){
			return $paras;
		}else{
			return "无法进行有效的翻译";
		}
		*/
		
		
		//有道翻译-json格式
		$url_youdao = 'http://fanyi.youdao.com/fanyiapi.do?keyfrom='.$keyfrom.'&key='.$apikey.'&type=data&doctype=json&version=1.1&q='.$word;
		
		$jsonStyle = file_get_contents($url_youdao);

		$result = json_decode($jsonStyle,true);
		
		$errorCode = $result['errorCode'];
		
		$trans = '';

		if(isset($errorCode)){

			switch ($errorCode){
				case 0:
					$trans = $result['translation']['0'];
					break;
				case 20:
					$trans = '要翻译的文本过长';
					break;
				case 30:
					$trans = '无法进行有效的翻译';
					break;
				case 40:
					$trans = '不支持的语言类型';
					break;
				case 50:
					$trans = '无效的key';
					break;
				default:
					$trans = '出现异常';
					break;
			}
		}
		return $trans;
		
	}

	//百度翻译
	public function baiduDic($word,$from="auto",$to="auto"){
		
		//首先对要翻译的文字进行 urlencode 处理
		$word_code=urlencode($word);
		
		//注册的API Key
		$appid="O1IyaDAfnLPAIemNuG9kSdwq";
		
		//生成翻译API的URL GET地址
		$baidu_url = "http://openapi.baidu.com/public/2.0/bmt/translate?client_id=".$appid."&q=".$word_code."&from=".$from."&to=".$to;
		
		$text=json_decode($this->language_text($baidu_url));

		$text = $text->trans_result;

		return $text[0]->dst;
	}
		
	//百度翻译-获取目标URL所打印的内容
	public function language_text($url){

		if(!function_exists('file_get_contents')){

			$file_contents = file_get_contents($url);

		}else{
				
			//初始化一个cURL对象
			$ch = curl_init();

			$timeout = 5;

			//设置需要抓取的URL
			curl_setopt ($ch, CURLOPT_URL, $url);

			//设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

			//在发起连接前等待的时间，如果设置为0，则无限等待
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

			//运行cURL，请求网页
			$file_contents = curl_exec($ch);

			//关闭URL请求
			curl_close($ch);
		}

		return $file_contents;
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