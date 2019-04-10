<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	$alipaywapapi=queryall(co_api,"where apiname='alipaywap'");
	
	//商户私钥，填写对应签名算法类型的私钥，如何生成密钥参考：https://docs.open.alipay.com/291/105971和https://docs.open.alipay.com/200/105310
	$rsaPrivateKey=$alipaywapapi['apikey'];

	//支付宝公钥，账户中心->密钥管理->开放平台密钥，找到添加了支付功能的应用，根据你的加密类型，查看支付宝公钥
	$alipayPublicKey=$alipaywapapi['apizh'];
	
	//账户中心->密钥管理->开放平台密钥，填写添加了电脑网站支付的应用的APPID
	$appid = $alipaywapapi['apiuid'];  
	
	//付款成功后的同步回调地址
	$returnUrl = 'http://'.$_SERVER['SERVER_NAME'].'/gateway/alipay_wap/return.php';    
	
	//付款成功后的异步回调地址
	$notifyUrl = 'http://'.$_SERVER['SERVER_NAME'].'/gateway/alipay_wap/notify.php';     
	
?>