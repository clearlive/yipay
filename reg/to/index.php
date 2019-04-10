<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	
?>
<?php
	if(empty($_GET['token'])){
		header("location:/");
		exit;
	}else if(strlen($_GET['token']) != 32){
		header("location:/");
		exit;
	}
	$token=check(uhtml($_GET['token']));
	$tk=queryall(co_user_sys,"where token='$token'");
	$yhm=$tk['user'];
	$xtsj=date("Y-m-d H:i:s",time());
	if($tk['token'] == $token and $tk['status'] == 'no'){
		if($tk['tokentime']>=time()){
			if(queryg(co_user_sys,"status='jihuo',token='',tokentime='' WHERE token='$token'")){
				queryz(co_xiaoxi,"to_user,msg_title,msg_text,msg_time,msg_yd","'$yhm','欢迎注册聚合支付商户','尊敬的商户，为了保证您的商户权限正常，请尽快进行实名认证！','$xtsj','no'");//站内消息通知
				$ok_msg="激活成功!";
			}else{
				$msg="处理出错!";
			}
		}else{
			if(querys(co_user_sys,"WHERE token='$token'")){
				$msg="激活链接已失效,请重新注册!";
			}
		}
	}else{
		$msg="激活链接无效!";
	}
?>
<?php if(isset($msg)){echo @$msg;} ?>
<?php if(isset($ok_msg)){echo @$ok_msg;} ?>