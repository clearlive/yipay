<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	$weixinapi=queryall(co_api,"where apiname='weixin'");
	$mchid = $weixinapi['apiuid'];          //微信支付商户号 PartnerID 通过微信支付商户资料审核后邮件发送
	$appid = $weixinapi['apizh'];  //公众号APPID 通过微信支付商户资料审核后邮件发送
	$apiKey = $weixinapi['apikey'];   //https://pay.weixin.qq.com 帐户设置-安全设置-API安全-API密钥-设置API密钥

?>