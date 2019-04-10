<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/gateway/yinlian/sdk/acp_service.php';
require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
/**
 * 交易说明：	前台类交易成功才会发送后台通知。后台类交易（有后台通知的接口）交易结束之后成功失败都会发通知。
 *              为保证安全，涉及资金类的交易，收到通知后请再发起查询接口确认交易成功。不涉及资金的交易可以以通知接口respCode=00判断成功。
 *              未收到通知时，查询接口调用时间点请参照此FAQ：https://open.unionpay.com/ajweb/help/faq/list?id=77&level=0&from=0
 */

$logger = com\unionpay\acp\sdk\LogUtil::getLogger();
$logger->LogInfo("receive front notify: " . com\unionpay\acp\sdk\createLinkString ( $_POST, false, true ));

?>
<title>同步通知</title>
<?php 
	if(com\unionpay\acp\sdk\AcpService::validate ( $_POST )){
		$orderId = $_POST ['orderId']; //订单号
		$settleAmt = number_format($_POST ['settleAmt']/100, 2, '.', '');//金额
		$respCode = $_POST ['respMsg'];//支付状态
		if($respCode="success"){
			$dd=queryall(co_dingdan,"where ddh='$orderId' and ddje='$settleAmt'");
			$yhm=$dd['username'];
			$user=queryall(co_user_sys,"where user='$yhm'");
			$sign=md5('status=success&shid='.$dd['userid'].'&bb='.$dd['jkbb'].'&zftd='.$dd['ddtd'].'&ddh='.$dd['apiddh'].'&je='.$dd['ddje'].'&ddmc='.$dd['apiddmc'].'&ddbz='.$dd['apiddbz'].'&ybtz='.$dd['ddybtz'].'&tbtz='.$dd['ddtbtz'].'&'.$user['apikey']);
			$url=$dd['ddtbtz']."?status=success&shid=".$dd['userid']."&bb=".$dd['jkbb']."&zftd=".$dd['ddtd']."&ddh=".$dd['apiddh']."&je=".$dd['ddje']."&ddmc=".$dd['apiddmc']."&ddbz=".$dd['apiddbz']."&ybtz=".$dd['ddybtz']."&tbtz=".$dd['ddtbtz']."&sign=".$sign;
			if($dd['ddzt'] != 'success' and $dd['ddzt'] != 'fail'){
				queryg(co_dingdan,"ddzt='success' where ddh='$orderId' and ddje='$settleAmt'");//查看该订单状态（如果状态不是success就改为success）
				queryg(co_diaodan,"ddzt='success' where ddh='$orderId' and ddje='$settleAmt'");//查看该黑单状态（如果状态不是success就改为success）
				$yhm=$dd['username'];
				if($dd['agentje']!=null){//如果代理利润不为空
					$agentje=$dd['agentje'];//代理所得金额
					$agentuser=$dd['agent'];//代理名称
					queryg(co_agent_sys,"yue=yue+$agentje where agentuser='$agentuser'");//代理原有账户金额增加所得金额
				}
				$sdje=$dd['sdje'];//所得金额
				queryg(co_user_sys,"yue=yue+$sdje where user='$yhm'");//原有账户金额增加所得金额
				queryg(co_dingdan,"ddtzzt='通知成功' where ddh='$orderId' and ddje='$settleAmt'");
				header("location:$url");
			}
			header("location:$url");//如果异步已经做了处理，跳转到商户同步通知地址
			echo "支付成功<br />";
		}else{
			echo "支付失败<br />";
		}
	}else{
		echo '验签失败';
	}

?>
