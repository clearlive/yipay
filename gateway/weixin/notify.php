<?php
require_once "config.php";
/**
 * 原生支付（扫码支付）及公众号支付的异步回调通知
 * 说明：需要在native.php或者jsapi.php中的填写回调地址。例如：http://www.xxx.com/wx/notify.php
 * 付款成功后，微信服务器会将付款结果通知到该页面
 */
header('Content-type:text/html; Charset=utf-8');
$wxPay = new WxpayService($mchid,$appid,$apiKey);
$result = $wxPay->notify();
if($result){
    //完成你的逻辑
    //例如连接数据库，获取付款金额$result['cash_fee']，获取订单号$result['out_trade_no']，修改数据库中的订单状态等;
	$ddh=$result['out_trade_no'];//订单号	
	$je = uhtml(check(trim($result['cash_fee']/100)));//订单金额
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
	echo "success";		//请不要修改或删除
/***************************************/	
}else{
    echo 'pay error';
}
class WxpayService
{
    protected $mchid;
    protected $appid;
    protected $apiKey;
    public function __construct($mchid, $appid, $key)
    {
        $this->mchid = $mchid;
        $this->appid = $appid;
        $this->apiKey = $key;
    }
    public function notify()
    {
        $config = array(
            'mch_id' => $this->mchid,
            'appid' => $this->appid,
            'key' => $this->apiKey,
        );
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        if ($postObj === false) {
            die('parse xml error');
        }
        if ($postObj->return_code != 'SUCCESS') {
            die($postObj->return_msg);
        }
        if ($postObj->result_code != 'SUCCESS') {
            die($postObj->err_code);
        }
        $arr = (array)$postObj;
        unset($arr['sign']);
        if (self::getSign($arr, $config['key']) == $postObj->sign) {
            echo '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
            return $arr;
        }
    }
    /**
     * 获取签名
     */
    public static function getSign($params, $key)
    {
        ksort($params, SORT_STRING);
        $unSignParaString = self::formatQueryParaMap($params, false);
        $signStr = strtoupper(md5($unSignParaString . "&key=" . $key));
        return $signStr;
    }
    protected static function formatQueryParaMap($paraMap, $urlEncode = false)
    {
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v) {
            if (null != $v && "null" != $v) {
                if ($urlEncode) {
                    $v = urlencode($v);
                }
                $buff .= $k . "=" . $v . "&";
            }
        }
        $reqPar = '';
        if (strlen($buff) > 0) {
            $reqPar = substr($buff, 0, strlen($buff) - 1);
        }
        return $reqPar;
    }
}
?>