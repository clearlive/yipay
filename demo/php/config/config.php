<?php
	/******************/
	/*	核心配置文件	*/
	/*	版本：V1.0	*/
	/*  By:聚合支付	*/
	/******************/
	
	header('Content-Type:text/html;charset=utf8');
	date_default_timezone_set('Asia/Shanghai');

	$userid='10050';//商户ID

	$userkey='aej16vr9jeysfuqug7vnxxi5kq9ugk5gd2j0ehzs';//商户KEY

	$apiurl='http://www.h537v.cn/pay/api.php';//网关地址
	
	$checkurl='http://www.h537v.cn/pay/order.php';//查单地址

	$notify='http://'.$_SERVER['HTTP_HOST'].'/demo/php/notify.php';//异步通知地址

	$return='http://'.$_SERVER['HTTP_HOST'].'/demo/php/return.php';//同步跳转地址
	
	/******************/


?>
