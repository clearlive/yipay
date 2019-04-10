<?php
	if(!$weblock){//防止访问单文件
		header("location:../");
		exit;
	}
	//调用支付宝核心文件
	require_once($_SERVER['DOCUMENT_ROOT']."/gateway/alipay/alipay.config.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/gateway/alipay/lib/alipay_submit.class.php");
	
	//生成请求数组
	$parameter = array(
	"service"       => $alipay_config['service'],
	"partner"       => $alipay_config['partner'],
	"seller_id"  => $alipay_config['seller_id'],
	"payment_type"	=> $alipay_config['payment_type'],
	"notify_url"	=> $alipay_config['notify_url'],
	"return_url"	=> $alipay_config['return_url'],		
	"anti_phishing_key"=>$alipay_config['anti_phishing_key'],
	"exter_invoke_ip"=>$alipay_config['exter_invoke_ip'],
	"out_trade_no"	=> $out_trade_no,
	"subject"	=> $subject,
	"total_fee"	=> $je,
	"body"	=> $body,
	"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
	);

	//建立请求
	$alipaySubmit = new AlipaySubmit($alipay_config);
	$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
	echo $html_text;

?>