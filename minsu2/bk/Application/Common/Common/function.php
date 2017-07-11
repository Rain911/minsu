<?php 
	/**
	 * 打印输出数据|show的别名
	 * @param void $var
	 */
	function p($var) {
	    if (is_bool($var)) {
	        var_dump($var);
	    } else if (is_null($var)) {
	        var_dump(NULL);
	    } else {
	        echo "<pre style='position:relative;z-index:1000;padding:10px;border-radius:5px;background:#F5F5F5;border:1px solid #aaa;font-size:14px;line-height:18px;opacity:0.9;'>" . print_r($var, true) . "</pre>";
	    }
	}

	/**
	 * 发送post请求
	 * @param string $url 请求地址
	 * @param array $post_data post键值对数据
	 * @return string
	 */
	function send_post($url, $post_data) {
	  $options = array(
	    'http' => array(
	      'method' => 'POST',
	      'header' => 'Content-type:application/x-www-form-urlencoded',
	      'content' => $post_data,
	      'timeout' => 15 * 60 // 超时时间（单位:s）
	    )
	  );
	  $context = stream_context_create($options);
	  $result = file_get_contents($url, false, $context);
	  return $result;
	}
	
	//数组转XML
    function arrayToXml($arr) {
        $xml = "<xml>";
        foreach ($arr as $key=>$val) {
            if (strpos($val,'{')){
            	$xml.="<".$key."><![CDATA[".$val."]]></".$key.">"; 
            }else{
               $xml.="<".$key.">".$val."</".$key.">";
            }
        }
        $xml.="</xml>";
        return $xml;
    }

	function getIP() { 
		global $ip; 
		if (getenv("HTTP_CLIENT_IP")) 
			$ip = getenv("HTTP_CLIENT_IP"); 
		else if(getenv("HTTP_X_FORWARDED_FOR")) 
			$ip = getenv("HTTP_X_FORWARDED_FOR"); 
		else if(getenv("REMOTE_ADDR")) 
			$ip = getenv("REMOTE_ADDR"); 
		else 
			$ip = "Unknow"; 
		return $ip; 
	} 
	
	function randomStr() {
		$arr=range(1,10);
		shuffle($arr);
		$str="";
		foreach($arr as $values){
		  	$str.=$values;
		}
		return $str;
	}

	function randomStr6() {
		$arr=range(1,6);
		shuffle($arr);
		$str="";
		foreach($arr as $values){
		  	$str.=$values;
		}
		return $str;
	}
		
	function sendText($mobile,$text) {
		$ch = curl_init();
		$apikey = "d4a4d01a6c34c06de56c3700801806f6"; //修改为您的apikey(https://www.yunpian.com)登录官网后获取
		
		// 发送短信
		$data=array('text'=>$text,'apikey'=>$apikey,'mobile'=>$mobile);
		curl_setopt ($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/sms/single_send.json');
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		$json_data = curl_exec($ch);
		//解析返回结果（json格式字符串）
		$array = json_decode($json_data,true);
	}
 ?>