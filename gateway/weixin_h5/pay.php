<?php
	if(!$weblock){//防止访问单文件
		header("location:../");
		exit;
	}
require_once 'config.php';
$money= $je; //充值金额，分为单位
$userip = get_client_ip();          //获得用户设备IP
$rand = rand(00000,99999);
$out_trade_no = $out_trade_no;//平台内部订单号
$nonce_str = createNoncestr();//随机字符串
$body = $subject;//内容
$total_fee = $money*100; //金额
$spbill_create_ip = $userip; //IP
$notify_url = "http://".$_SERVER['HTTP_HOST']."/gateway/weixin_h5/notify.php"; //回调地址
$trade_type = 'MWEB';//交易类型 因为是h5支付所以交易类型必须是MWEB
$scene_info ='{"h5_info":{"type":"Wap","wap_url":"http://www.baidu.com","wap_name":"支付"}}';//场景信息 必要参数

//以下信息可以不改
$signA ="appid=$appid&attach=$out_trade_no&body=$body&mch_id=$mchid&nonce_str=$nonce_str&notify_url=$notify_url&out_trade_no=$out_trade_no&scene_info=$scene_info&spbill_create_ip=$spbill_create_ip&total_fee=$total_fee&trade_type=$trade_type";
$strSignTmp = $signA."&key=$apiKey"; //拼接字符串  注意顺序微信有个测试网址 顺序按照他的来 直接点下面的校正测试 包括下面XML  是否正确

$sign = strtoupper(MD5($strSignTmp)); // MD5 后转换成大写

$post_data = "<xml>
                   <appid>$appid</appid>
                   <mch_id>$mchid</mch_id>
                   <body>$body</body>
                   <out_trade_no>$out_trade_no</out_trade_no>
                   <total_fee>$total_fee</total_fee>
                   <spbill_create_ip>$spbill_create_ip</spbill_create_ip>
                   <notify_url>$notify_url</notify_url>
                   <trade_type>$trade_type</trade_type>
                   <scene_info>$scene_info</scene_info>
                   <attach>$out_trade_no</attach>
                   <nonce_str>$nonce_str</nonce_str>
                   <sign>$sign</sign>
               </xml>";//拼接成XML 格式

$url = "https://api.mch.weixin.qq.com/pay/unifiedorder";//微信传参地址
$dataxml = postXmlCurl($post_data,$url); //后台POST微信传参地址  同时取得微信返回的参数    POST 方法我写下面了
$objectxml = (array)simplexml_load_string($dataxml, 'SimpleXMLElement', LIBXML_NOCDATA); //将微信返回的XML 转换成数组

function createNoncestr( $length = 32 ){
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    $str ="";
    for ( $i = 0; $i < $length; $i++ )  {
        $str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);
    }
    return $str;
}
function postXmlCurl($xml,$url,$second = 30){
    $ch = curl_init();
    //设置超时
    curl_setopt($ch, CURLOPT_TIMEOUT, $second);
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
    //设置header
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    //要求结果为字符串且输出到屏幕上
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    //post提交方式
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    //运行curl
    $data = curl_exec($ch);
    //返回结果
    if($data){
        curl_close($ch);
        return $data;
    }else{
        $error = curl_errno($ch);
        curl_close($ch);
        echo "curl出错，错误码:$error"."<br>";
    }
}
function get_client_ip() {
    static $realip;
    if (isset($_SERVER)) {
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")) {
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
    return $realip;
}
?>
<meta http-equiv="Refresh" content="0; url=<?php echo $objectxml['mweb_url'] ?>" /> 