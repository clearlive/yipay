<?php
require_once "config/config.php";
header('Content-type:text/html; Charset=utf-8');
$aliPay = new AlipayService($alipayPublicKey);
//验证签名
$result = $aliPay->rsaCheck($_GET,$_GET['sign_type']);
if($result===true){
    //同步回调一般不处理业务逻辑，显示一个付款成功的页面，或者跳转到用户的财务记录页面即可。
	//商户订单号

	$out_trade_no = uhtml(check(trim($_GET['out_trade_no'])));

	$je = uhtml(check(trim($_GET['total_amount'])));
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
    echo '<h1>付款成功</h1>';
}
echo '不合法的请求';exit();
class AlipayService
{
    //支付宝公钥
    protected $alipayPublicKey;
    protected $charset;
    public function __construct($alipayPublicKey)
    {
        $this->charset = 'utf8';
        $this->alipayPublicKey=$alipayPublicKey;
    }
    /**
     *  验证签名
     **/
    public function rsaCheck($params) {
        $sign = $params['sign'];
        $signType = $params['sign_type'];
        unset($params['sign_type']);
        unset($params['sign']);
        return $this->verify($this->getSignContent($params), $sign, $signType);
    }
    function verify($data, $sign, $signType = 'RSA') {
        $pubKey= $this->alipayPublicKey;
        $res = "-----BEGIN PUBLIC KEY-----\n" .
            wordwrap($pubKey, 64, "\n", true) .
            "\n-----END PUBLIC KEY-----";
        ($res) or die('支付宝RSA公钥错误。请检查公钥文件格式是否正确');
        //调用openssl内置方法验签，返回bool值
        if ("RSA2" == $signType) {
            $result = (bool)openssl_verify($data, base64_decode($sign), $res, version_compare(PHP_VERSION,'5.4.0', '<') ? SHA256 : OPENSSL_ALGO_SHA256);
        } else {
            $result = (bool)openssl_verify($data, base64_decode($sign), $res);
        }
//        if(!$this->checkEmpty($this->alipayPublicKey)) {
//            //释放资源
//            openssl_free_key($res);
//        }
        return $result;
    }
    /**
     * 校验$value是否非空
     *  if not set ,return true;
     *    if is null , return true;
     **/
    protected function checkEmpty($value) {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }
    public function getSignContent($params) {
        ksort($params);
        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {
                // 转换成目标字符集
                $v = $this->characet($v, $this->charset);
                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;
            }
        }
        unset ($k, $v);
        return $stringToBeSigned;
    }
    /**
     * 转换字符集编码
     * @param $data
     * @param $targetCharset
     * @return string
     */
    function characet($data, $targetCharset) {
        if (!empty($data)) {
            $fileType = $this->charset;
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
                //$data = iconv($fileType, $targetCharset.'//IGNORE', $data);
            }
        }
        return $data;
    }
}
?>	