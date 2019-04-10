<?php

/*
 * @Description API支付B2C在线支付接口范例 
 */
 
include 'payCommon.php';	
	
#	只有支付成功时API支付才会通知商户.
##支付成功回调有两次，都会通知到在线支付请求参数中的p8_Url上：浏览器重定向;服务器点对点通讯.

#	解析返回参数.
$return = getCallBackValue($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);

#	判断返回签名是否正确（True/False）
$bRet = CheckHmac($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);
#	以上代码和变量不需要修改.
	 	
#	校验码正确.
if($bRet){
	if($r1_Code=="1"){
		
	#	需要比较返回的金额与商家数据库中订单的金额是否相等，只有相等的情况下才认为是交易成功.
	#	并且需要对返回的处理进行事务控制，进行记录的排它性处理，在接收到支付结果通知后，判断是否进行过业务逻辑处理，不要重复进行业务逻辑处理，防止对同一条交易重复发货的情况发生.
		if($r9_BType=="1"){
            handle($r6_Order,$r3_Amt);
			echo "交易成功";
			echo  "<br />在线支付页面返回";
		}elseif($r9_BType=="2"){
			#如果需要应答机制则必须回写流,以success开头,大小写不敏感.
            handle($r6_Order,$r3_Amt);
			echo "success";
			echo "<br />交易成功";
			echo  "<br />在线支付服务器返回";      			 
		}
	}
	
}else{
	echo "交易信息被篡改";
}

function handle($order_no,$jes){
    $out_trade_no = uhtml(check(trim($order_no))); //订单号

    //订单金额
    $je = uhtml(check(trim($jes)));
    $dd=queryall(co_dingdan,"where ddh='$out_trade_no' and ddje='$je'"); //校验通过，查找订单号
    if($dd['ddzt'] != 'success' or $dd['ddzt'] != 'fail'){
        $yhm=$dd['username'];
        queryg(co_dingdan,"ddzt='success' where ddh='$out_trade_no' and ddje='$je'");//查看该订单状态（如果状态不是success就改为success）
        queryg(co_diaodan,"ddzt='success' where ddh='$out_trade_no' and ddje='$je'");//查看该黑单状态（如果状态不是success就改为success）
        $url=$dd['ddybtz'];
        $user=queryall(co_user_sys,"where user='$yhm'");
        $sign=md5('status=success&shid='.$dd['userid'].'&bb='.$dd['jkbb'].'&zftd='.$dd['ddtd'].'&ddh='.$dd['apiddh'].'&je='.$dd['ddje'].'&ddmc='.$dd['apiddmc'].'&ddbz='.$dd['apiddbz'].'&ybtz='.$dd['ddybtz'].'&tbtz='.$dd['ddtbtz'].'&'.$user['apikey']);
        $data=array(
            "status"=>'success',
            "shid"=>$dd['userid'],
            "bb"=>$dd['jkbb'],
            "zftd"=>$dd['ddtd'],
            "ddh"=>$dd['apiddh'],
            "je"=>$dd['ddje'],
            "ddmc"=>$dd['apiddmc'],
            "ddbz"=>$dd['apiddbz'],
            "ybtz"=>$dd['ddybtz'],
            "tbtz"=>$dd['ddtbtz'],
            "sign"=>$sign
        );
        if($dd['agentje']!=null){//如果代理利润不为空
            $agentje=$dd['agentje'];//代理所得金额
            $agentuser=$dd['agent'];//代理名称
            queryg(co_agent_sys,"yue=yue+$agentje where agentuser='$agentuser'");//代理原有账户金额增加所得金额
        }
        $sdje=$dd['sdje'];//商户所得金额
        queryg(co_user_sys,"yue=yue+$sdje where user='$yhm'");//原有账户金额增加所得金额
        if(curlPost($url,$data)){
            queryg(co_dingdan,"ddtzzt='通知成功' where ddh='$out_trade_no' and ddje='$je'");
        }else{
            queryg(co_dingdan,"ddtzzt='通知失败' where ddh='$out_trade_no' and ddje='$je'");
            header("location:$url");
        }
    }
}

?>
<html>
<head>
<title>Return from API Page</title>
</head>
<body>
</body>
</html>