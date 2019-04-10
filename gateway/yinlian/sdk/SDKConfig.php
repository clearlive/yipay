<?php
namespace com\unionpay\acp\sdk;;
include_once 'log.class.php';
include_once 'common.php';

class SDKConfig {
	
	private static $_config = null;
	public static function getSDKConfig(){
		if (SDKConfig::$_config == null ) {
			SDKConfig::$_config = new SDKConfig();
		}
		return SDKConfig::$_config;
	}
	
	private $merId;
	private $frontTransUrl;
	
	private $signMethod;
	private $version;
	private $ifValidateCNName;
	private $ifValidateRemoteCert;
	
	private $signCertPath;
	private $signCertPwd;
	private $encryptCertPath;
	private $rootCertPath;
	private $middleCertPath;
	private $frontUrl;
	private $backUrl;
	private $logFilePath;
	private $logLevel;

	function __construct(){
			
		$yinlian=mysql_fetch_assoc(mysql_query("select * from co_api where apiname='yinlian'"));	
		$this->merId = $yinlian['apiuid'];//商户ID
		$this->frontTransUrl = 'https://gateway.test.95516.com/gateway/api/frontTransReq.do';//网关地址//该地址未测试地址

		$this->signMethod = '01';//签名方式
		$this->version = '5.1.0';//报文版本号，固定5.1.0，请勿改动
		$this->ifValidateCNName = false;//是否验证验签证书的CN
		$this->ifValidateRemoteCert = false;//是否验证https证书
					
		$this->signCertPath = $_SERVER['DOCUMENT_ROOT'].'\gateway\yinlian\certs\acp_test_sign.pfx';//签名证书
		$this->signCertPwd = $yinlian['apikey'];//签名证书密码
		
		$this->encryptCertPath = $_SERVER['DOCUMENT_ROOT'].'\gateway\yinlian\certs\acp_test_enc.cer';//敏感信息加密证书路径
		$this->rootCertPath = $_SERVER['DOCUMENT_ROOT'].'\gateway\yinlian\certs\acp_test_root.cer';//验签根证书
		$this->middleCertPath = $_SERVER['DOCUMENT_ROOT'].'\gateway\yinlian\certs\acp_test_middle.cer';//验签中级证书
		
		$this->frontUrl =  'http://'.$_SERVER['HTTP_HOST'].'/gateway/yinlian/return_url.php';//前台通知地址
		$this->backUrl =  'http://'.$_SERVER['HTTP_HOST'].'/gateway/yinlian/notify_url.php';//后台通知地址
		
		$this->logFilePath =  'D:/logs/';//日志打印路径
		$this->logLevel =  'DEBUG';//日志级别，debug级别会打印密钥，生产请用info或以上级别
		
	}

	public function __get($property_name)
	{
		if(isset($this->$property_name))
		{
			return($this->$property_name);
		}
		else
		{
			return(NULL);
		}
	}

}


