<?php
/* *
 * 功能：支付宝服务器异步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。


 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 该页面调试工具请使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyNotify
 * 如果没有收到该页面返回的 success 信息，支付宝会在24小时内按一定的时间策略重发通知
 */

require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");
require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();

if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代

	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
	
    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
	
	//商户订单号
	$out_trade_no = uhtml(check(trim($_POST['out_trade_no'])));

	//订单金额
	$je = uhtml(check(trim($_POST['total_fee'])));
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

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
        
	echo "success";		//请不要修改或删除
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    echo "fail";

    //调试用，写文本函数记录程序运行情况是否正常
    //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
}
?>