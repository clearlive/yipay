<?php
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);

require_once "lib/WxPay.Api.php";
require_once 'lib/WxPay.Notify.php';
require_once 'log.php';

//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

class PayNotifyCallBack extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		Log::DEBUG("query:" . json_encode($result));
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		Log::DEBUG("call back:" . json_encode($data));
		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
		$ddh=$data["out_trade_no"];
		$je=$data["total_fee"]/100;
		$dd=queryall(co_dingdan,"where ddh='$ddh' and ddje='$je'"); //校验通过，查找订单号
		if($dd['ddzt'] != 'success' or $dd['ddzt'] != 'fail'){
			$yhm=$dd['username'];
			queryg(co_dingdan,"ddzt='success' where ddh='$ddh' and ddje='$je'");//查看该订单状态（如果状态不是success就改为success）
			queryg(co_diaodan,"ddzt='success' where ddh='$ddh' and ddje='$je'");//查看该黑单状态（如果状态不是success就改为success）
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
			$sdje=$dd['sdje'];//所得金额
			queryg(co_user_sys,"yue=yue+$sdje where user='$yhm'");//原有账户金额增加所得金额
			if(curlPost($url,$data)){
				queryg(co_dingdan,"ddtzzt='通知成功' where ddh='$ddh' and ddje='$je'");
			}else{
				queryg(co_dingdan,"ddtzzt='通知失败' where ddh='$ddh' and ddje='$je'");
				header("location:$url");
			}
		}
		return true;
	}
}

Log::DEBUG("begin notify");
$notify = new PayNotifyCallBack();
$notify->Handle(false);
