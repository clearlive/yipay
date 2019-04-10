<?php
/* * 
 * 功能：支付宝页面跳转同步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyReturn
 */

require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");
require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";

?>
<!DOCTYPE HTML>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码
	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

	//商户订单号
	$out_trade_no = uhtml(check(trim($_GET['out_trade_no'])));

	$je = uhtml(check(trim($_GET['total_fee'])));
		$dd=queryall(co_dingdan,"where ddh='$out_trade_no' and ddje='$je'");
		$yhm=$dd['username'];
		$user=queryall(co_user_sys,"where user='$yhm'");
		$sign=md5('status=success&shid='.$dd['userid'].'&bb='.$dd['jkbb'].'&zftd='.$dd['ddtd'].'&ddh='.$dd['apiddh'].'&je='.$dd['ddje'].'&ddmc='.$dd['apiddmc'].'&ddbz='.$dd['apiddbz'].'&ybtz='.$dd['ddybtz'].'&tbtz='.$dd['ddtbtz'].'&'.$user['apikey']);
		$url=$dd['ddtbtz']."?status=success&shid=".$dd['userid']."&bb=".$dd['jkbb']."&zftd=".$dd['ddtd']."&ddh=".$dd['apiddh']."&je=".$dd['ddje']."&ddmc=".$dd['apiddmc']."&ddbz=".$dd['apiddbz']."&ybtz=".$dd['ddybtz']."&tbtz=".$dd['ddtbtz']."&sign=".$sign;
		if($dd['ddzt'] != 'success' and $dd['ddzt'] != 'fail'){
			queryg(co_dingdan,"ddzt='success' where ddh='$out_trade_no' and ddje='$je'");//查看该订单状态（如果状态不是success就改为success）
			queryg(co_diaodan,"ddzt='success' where ddh='$out_trade_no' and ddje='$je'");//查看该黑单状态（如果状态不是success就改为success）
			$yhm=$dd['username'];
			if($dd['agentje']!=null){//如果代理利润不为空
				$agentje=$dd['agentje'];//代理所得金额
				$agentuser=$dd['agent'];//代理名称
				queryg(co_agent_sys,"yue=yue+$agentje where agentuser='$agentuser'");//代理原有账户金额增加所得金额
			}
			$sdje=$dd['sdje'];//所得金额
			queryg(co_user_sys,"yue=yue+$sdje where user='$yhm'");//原有账户金额增加所得金额
			queryg(co_dingdan,"ddtzzt='通知成功' where ddh='$out_trade_no' and ddje='$je'");
			header("location:$url");
		}
		header("location:$url");//如果异步已经做了处理，跳转到商户同步通知地址
		echo "验证成功<br />";

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的verifyReturn函数
    echo "验证失败";
}
?>
<title>处理中...</title>
