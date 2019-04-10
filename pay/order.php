<meta charset="utf-8">
<title>Check</title>
<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	$shid=@uhtml(check(trim($_POST['shid'])));//商户ID
	$ddh=@uhtml(check(trim($_POST['ddh'])));//订单号
	$sign=@uhtml(check(trim($_POST['sign'])));//MD5加密串
	
	if($shid == null || $ddh == null || $sign == null ){
		echo json_encode(array("code"=>"err001","msg"=>"参数有误"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	/*******参数判断拦截开始******/
	if(!issz($shid)){
		echo json_encode(array("code"=>"err002","msg"=>"商户号错误"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	if(!isszzm($ddh)){
		echo json_encode(array("code"=>"err003","msg"=>"订单号错误"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	if(!isszzm($sign)){
		echo json_encode(array("code"=>"err004","msg"=>"MD5密文错误"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	/*******参数判断拦截结束******/
	$shkey=queryall(co_user_sys,"where id='$shid'");//商户ID
	$shkey=$shkey['apikey'];//商户KEY
	$yanzheng=md5('shid='.$shid.'&ddh='.$ddh.'&'.$shkey);//验证MD5加密串
	if($sign != $yanzheng){
		echo json_encode(array("code"=>"err005","msg"=>"数据验签失败"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	$shxx=queryall(co_user_sys,"where id='$shid'");
	$yhm=$shxx['user'];
	if($shxx['id'] != $shid or $shxx['apikey'] != $shkey){
		echo json_encode(array("code"=>"err006","msg"=>"商户验证错误"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	$ddxx=queryall(co_dingdan,"where apiddh='$ddh'");
	if($ddxx['apiddh']==null){
		echo json_encode(array("status"=>"fail","msg"=>"订单号错误或不存在"),JSON_UNESCAPED_UNICODE);
		exit;
	}else{
		if($ddxx['ddzt']=='success'){//如果是成功订单
			$ddxx_shddh=$ddxx['apiddh'];//商户订单号
			$ddxx_je=$ddxx['ddje'];//订单金额
			$ddxx_ptddh=$ddxx['ddh'];//平台订单号
			$ddxx_checktime=date("Y-m-d H:i:s",time());//查询时间
			echo json_encode(array("status"=>"success","msg"=>"成功","shddh"=>$ddxx_shddh,"je"=>$ddxx_je,"ptddh"=>$ddxx_ptddh,"time"=>$ddxx_checktime),JSON_UNESCAPED_UNICODE);
			exit;
		}else{//否则是失败订单
			echo json_encode(array("status"=>"fail","msg"=>"失败或等待"),JSON_UNESCAPED_UNICODE);
			exit;
		}
	}
	

?>