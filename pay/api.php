<meta charset="utf-8">
<title>支付</title>
<?php

	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";


	if($_POST['bb'] == null || $_POST['shid'] == null || $_POST['ddh'] == null || $_POST['je'] == null || $_POST['zftd'] == null || $_POST['ybtz'] == null || $_POST['tbtz'] == null || $_POST['ddmc'] == null || $_POST['ddbz'] == null || $_POST['sign'] == null ){
		if($_POST['bb'] == null && $_POST['shid'] == null && $_POST['ddh'] == null && $_POST['je'] == null && $_POST['zftd'] == null && $_POST['ybtz'] == null && $_POST['tbtz'] == null && $_POST['ddmc'] == null && $_POST['ddbz'] == null && $_POST['sign'] == null){
			require_once($_SERVER['DOCUMENT_ROOT']."/index.php");
		}else{
			echo json_encode(array("code"=>"err001","msg"=>"参数有误"),JSON_UNESCAPED_UNICODE);
			exit;
		}
	}
	
	$bb=@uhtml(check(trim($_POST['bb'])));//版本
	$shid=@uhtml(check(trim($_POST['shid'])));//商户ID
	$ddh=@uhtml(check(trim($_POST['ddh'])));//订单号
	$je=@number_format(uhtml(check(trim($_POST['je']))),2,'.','');//金额
	$zftd=@uhtml(check(trim($_POST['zftd'])));//支付类型
	$ybtz=@uhtml(check(trim($_POST['ybtz'])));//异步通知地址
	$tbtz=@uhtml(check(trim($_POST['tbtz'])));//同步通知地址
	$ddmc=@uhtml(check(trim($_POST['ddmc'])));//订单名称
	$ddbz=@uhtml(check(trim($_POST['ddbz'])));//订单备注
	$sign=@uhtml(check(trim($_POST['sign'])));//版本+订单号+商户KEY验签

	/*******参数判断拦截开始******/
	if(!isszxsd($bb)){
		echo json_encode(array("code"=>"err002","msg"=>"版本号错误"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	if(!issz($shid)){
		echo json_encode(array("code"=>"err003","msg"=>"商户号错误"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	if(!isszzm($ddh)){
		echo json_encode(array("code"=>"err004","msg"=>"订单号错误"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	if(!isszzm($zftd)){
		echo json_encode(array("code"=>"err005","msg"=>"支付类型错误"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	if(!isszzm($sign)){
		echo json_encode(array("code"=>"err006","msg"=>"MD5密文错误"),JSON_UNESCAPED_UNICODE);
		exit;
	}

	/*******参数判断拦截结束******/
	$shkey=queryall(co_user_sys,"where id='$shid'");//商户ID

	$shkey=$shkey['apikey'];//商户KEY

	$yanzheng=md5('shid='.$shid.'&bb='.$bb.'&zftd='.$zftd.'&ddh='.$ddh.'&je='.$je.'&ddmc='.$ddmc.'&ddbz='.$ddbz.'&ybtz='.$ybtz.'&tbtz='.$tbtz.'&'.$shkey);//验证参数串


	if($sign != $yanzheng){
		echo json_encode(array("code"=>"err007","msg"=>"数据验签失败"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	$shxx=queryall(co_user_sys,"where id='$shid'");
	$yhm=$shxx['user'];
	if($shxx['id'] != $shid or $shxx['apikey'] != $shkey){
		echo json_encode(array("code"=>"err008","msg"=>"商户验证错误"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	if($shxx['status']!= 'jihuo'){
		echo json_encode(array("code"=>"err009","msg"=>"该商户已被锁定"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	if($web['apistatus'] == 'no'){
		echo json_encode(array("code"=>"err010","msg"=>"所有通道已关闭"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	$sys=queryall(co_api,"where apiname='$zftd'");
	if($sys['status'] == null){
		echo json_encode(array("code"=>"err011","msg"=>"通道不存在"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	if($sys['status'] == 'no'){
		echo json_encode(array("code"=>"err012","msg"=>"此通道已关闭"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	if($shxx['api'] == 'no'){
		echo json_encode(array("code"=>"err013","msg"=>"商户无API权限"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	$userapi=queryall(co_userapi,"where username='$yhm'");
	if($userapi["$zftd"] == 'no'){
		echo json_encode(array("code"=>"err014","msg"=>"商户无此通道权限"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	if($je < $web['zdje']){
		echo json_encode(array("code"=>"err015","msg"=>"订单金额低于限制金额"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	if($je > $web['zgje']){
		echo json_encode(array("code"=>"err016","msg"=>"订单金额高于限制金额"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	if(querydb(co_dingdan,"where apiddh='$ddh'")>=1){
		echo json_encode(array("code"=>"err017","msg"=>"订单号重复"),JSON_UNESCAPED_UNICODE);
		exit;
	}

	//订单所需参数
	$ddtime = date("Y-m-d H:i:s",time()); //订单提交时间[聚合支付]
	$ddsxsj = time()+60*$web['ddyxq']; //订单失效时间[聚合支付]
	$subject = $web['ptddmc'];//订单名称，必填[聚合支付]
	$out_trade_no = "YIPAY".date("YmdHis",time())."M";//聚合平台订单号，必填[聚合支付]
	$ddtdmc=queryall(co_api,"where apiname='$zftd'");	
	$ddtdmc=$ddtdmc['name'];	//订单通道名称
	
	/**************费率处理**************/
	$feilv=queryall(co_user_sys,"where user='$yhm'"); //查询商户费率
	if($feilv['feilv']==null){//如果商户单独费率未设置
		$feilv=queryall(co_api,"where apiname='$zftd'"); //查询API接口默认费率
		$sdje=$je-$feilv['apifl']*$je;//计算扣除费率所的金额
	}else{//如果商户已单独设置费率
		$sdje=$je-$feilv['feilv']*$je;//计算扣除费率所的金额
	}
	
	$feilv=queryall(co_user_sys,"where user='$yhm'"); //查询商户费率
	$mrjkfl=queryall(co_api,"where apiname='$zftd'"); //API接口默认费率
	if($feilv['feilv']>$mrjkfl['apifl']){//如果个人费率大于系统费率，多出的费率为代理的利润
		$dllr=($feilv['feilv']-$mrjkfl['apifl'])*$je;//得出代理利润
	}
	/*************费率处理***************/

	
	/***************掉单时间段**************/

	if($web['ddstatus']=='yes'){
		$dqsj=date("G",time());
		$cs=array();//空数组
		if($web['ddkssj']>$web['ddjssj']){//开始时间大于结束结束时间
			for($i=(int)$web['ddkssj'];$i<24;$i++){
					array_push($cs,$i);
			}
			for($i=0;$i<$web['ddjssj'];$i++){
					array_push($cs,$i);
			}
		}else{//开始时间小于结束时间
			for($i=(int)$web['ddkssj'];$i<24;$i++){
				if($i<=(int)$web['ddjssj']){
					array_push($cs,$i);
				}
			}
		}
	
		if(in_array($dqsj,$cs)){//如果当前时间符合掉单设置，开始掉单
			if($je>=$web['ddsksje'] or $je<=$web['ddsjsje']){//如果当掉单金额符合掉单设置
				$bfl=rand(1,100);//开始计算概率
				$bflarr=array();//空数组
				for($i=1;$i<=$web['ddbfbjl'];$i++){//循环写入几率
					array_push($bflarr,$i);//得出概率bflarr数组
				}
				if(in_array($bfl,$bflarr)){//判断概率数组里面是否有1-100的随机数
					$yyhm=$yhm;//原用户名
					$yhm="codiaodan";//如果概率得出该掉单，用户名变更为“codiaodan”（平台系统掉单代码）
					
				}
			}
		}
	}	
		
	/***************掉单时间段**************/	
	
	/***************订单写入**************/
	if($yhm=="codiaodan"){
		if(!queryz(co_diaodan,"userid,username,ddh,ddsj,ddje,apiddh,apiddmc,apiddbz,ddtbtz,ddybtz,ddtd,ddtdmc,ddzt,ddtzzt,jkbb,ddsxsj,sdje,hdlx","'$shid','$yyhm','$out_trade_no','$ddtime','$je','$ddh','$ddmc','$ddbz','$tbtz','$ybtz','$zftd','$ddtdmc','wait','等待通知','$bb','$ddsxsj','$sdje','概率掉单'")){
			echo json_encode(array("code"=>"err000","msg"=>"HD系统出错"),JSON_UNESCAPED_UNICODE);
			exit;
		}
	}
	if($shxx['daili']!=null and $feilv['feilv']>$mrjkfl['apifl']){//如果此商户有代理并且个人费率大于系统费率
		$agent=$shxx['daili'];
		if(!queryz(co_dingdan,"userid,username,ddh,ddsj,ddje,apiddh,apiddmc,apiddbz,ddtbtz,ddybtz,ddtd,ddtdmc,ddzt,ddtzzt,jkbb,ddsxsj,sdje,agent,agentje","'$shid','$yhm','$out_trade_no','$ddtime','$je','$ddh','$ddmc','$ddbz','$tbtz','$ybtz','$zftd','$ddtdmc','wait','等待通知','$bb','$ddsxsj','$sdje','$agent','$dllr'")){
			echo json_encode(array("code"=>"err000","msg"=>"YDLDD系统出错"),JSON_UNESCAPED_UNICODE);
			exit;
		}
	}else{
		if(!queryz(co_dingdan,"userid,username,ddh,ddsj,ddje,apiddh,apiddmc,apiddbz,ddtbtz,ddybtz,ddtd,ddtdmc,ddzt,ddtzzt,jkbb,ddsxsj,sdje","'$shid','$yhm','$out_trade_no','$ddtime','$je','$ddh','$ddmc','$ddbz','$tbtz','$ybtz','$zftd','$ddtdmc','wait','等待通知','$bb','$ddsxsj','$sdje'")){
			echo json_encode(array("code"=>"err000","msg"=>"WDLDD系统出错"),JSON_UNESCAPED_UNICODE);
			exit;
		}
	}

	/***************订单写入**************/	


	/***************匹配通道**************/	
	
	switch($zftd){
		case 'alipay':		//支付宝支付
			require_once($_SERVER['DOCUMENT_ROOT']."/gateway/alipay/pay.php");
		break;
		
		case 'alipaywap':		//支付宝WAP支付
			require_once($_SERVER['DOCUMENT_ROOT']."/gateway/alipay_wap/pay.php");
		break;
		
		case 'weixin':		//微信支付
			require_once($_SERVER['DOCUMENT_ROOT']."/gateway/weixin/pay.php");
		break;

		case 'yinlian':		//银联支付
			require_once($_SERVER['DOCUMENT_ROOT']."/gateway/yinlian/yl/req.php");
		break;
		
		case 'weixingz':	//微信公众号支付
			require_once($_SERVER['DOCUMENT_ROOT']."/gateway/weixin_gz/pay.php");
		break;
		case 'weixinh5':	//微信H5支付
			require_once($_SERVER['DOCUMENT_ROOT']."/gateway/weixin_h5/pay.php");
		break;
		default:
		echo json_encode(array("code"=>"err888","msg"=>"通道错误或不存在"),JSON_UNESCAPED_UNICODE);
		exit;
	}
	/***************匹配通道**************/	
		
	


?>
