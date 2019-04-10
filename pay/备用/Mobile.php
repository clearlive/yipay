<!DOCTYPE html>
<html>
<head>
<title>虎付在线支付</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="data-spm" content="a2h1u">
<meta name="author" content="" />
<meta name="copyright" content="" />
<meta name="keywords" content=""/>
<meta name="description" content=""/>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<meta name="format-detection" content="email=no" />
<!-- 启用360浏览器的极速模式(webkit) -->
<meta name="renderer" content="webkit">
<!-- 避免IE使用兼容模式 -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- 针对手持设备优化，主要是针对一些老的不识别viewport的浏览器，比如黑莓 -->
<meta name="HandheldFriendly" content="true">
<!-- 微软的老式浏览器 -->
<meta name="MobileOptimized" content="320">
<!-- uc强制竖屏 -->
<meta name="screen-orientation" content="portrait">
<!-- QQ强制竖屏 -->
<meta name="x5-orientation" content="portrait">
<!-- UC强制全屏 -->
<meta name="full-screen" content="yes">
<!-- QQ强制全屏 -->
<meta name="x5-fullscreen" content="true">
<!-- UC应用模式 -->
<meta name="browsermode" content="application">
<!-- QQ应用模式 -->
<meta name="x5-page-mode" content="app">
<!--这meta的作用就是删除默认的苹果工具栏和菜单栏-->
<meta name="apple-mobile-web-app-capable" content="yes">
<!--网站开启对web app程序的支持-->
<meta name="apple-touch-fullscreen" content="yes">
<!--在web app应用下状态条（屏幕顶部条）的颜色-->
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<!-- windows phone 点击无高光 -->
<meta name="msapplication-tap-highlight" content="no">
<!--移动web页面是否自动探测电话号码-->
<meta http-equiv="x-rim-auto-match" content="none">
<!--移动端版本兼容 start -->
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0" name="viewport" />
<!--移动端版本兼容 end -->
<link rel="stylesheet" type="text/css" href="tu/wap.css" tppabs="http://pay.g448.net/demo/tu/wap.css" />
<script type="text/javascript" src="tu/js/jquery.min.js-201705162128.js" tppabs="http://pay.g448.net/demo/tu/js/jquery.min.js?201705162128"></script>
<script src="../../account.youku.com/static-resources/js/loadFrame.js" tppabs="https://account.youku.com/static-resources/js/loadFrame.js"></script>


<link rel="stylesheet" type="text/css" href="layer_mobile/need/layer.css" tppabs="http://pay.g448.net/demo/layer_mobile/need/layer.css" />
<script async src="layer_mobile/layer.js" tppabs="http://pay.g448.net/demo/layer_mobile/layer.js"></script>

</head>



<script type="text/javascript">



        if (!window.jQuery) {
            document.write('<script type="text/javascript" src="../script/jquery.js"/*tpa=http://pay.g448.net/script/jquery.js*/><' + '/script>');
        }
        if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
           
        }else{
			window.location.href = "index-1.htm"/*tpa=http://pay.g448.net/demo/index.htm*/;
		}


	function tijiao(str){


		if(str=='gzhpay'){


			url="pay.php-pd_FrpId=gzhpay.htm"/*tpa=http://pay.g448.net/demo/pay.php?pd_FrpId=gzhpay*/;
			window.location.href = url;
		
		
		}else{
		
			alert('通道维护中');
		}


			
	}



	function tijiao2(str){


		 $.get("get.php?",{amt:"1.00.htm"/*tpa=http://pay.g448.net/demo/1.00*/,uid:"888",type:3,bankcode:str},function(data,status){

			 if (data.code==1)
			 {
					window.location.href = data.url;
			 }
	
		},"json");

			
	}

 function xuanze(){

		//底部对话框
		layer.open({
		title: [
		'选择银行',
		'background-color:#8DCE16; color:#fff;'
		]
		,anim: 'up'
		,content: $("#yinhang").html()
		,btn: []
	});


  }


</script>


<body>


<div id="yinhang" style="display:none">


	    <dl class="order-pay-way" id="other-pay">
        <!--


		<dd class="other-pay-link"><a href="javascript:;" authorizedpayflag="N" dataname="tenpay" dataway="中国银行" onclick="tijiao2('1052')" datacode="00600110" datatoptips="" datasectips="" class="block-link">
		<b class="bank-icon icon-alipay"></b>中国银行<b class="to-right"></b></a>
		</dd>


		<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="农业银行" onclick="tijiao2('1022')" datatoptips="" datasectips="" datacode="00903218" class="block-link">
		<b class="bank-icon icon-tenpay"></b>广大银行<b class="to-right"></b></a>
		</dd>



		<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="浦发银行" onclick="tijiao2('1004')" datatoptips="" datasectips="" datacode="00903218" class="block-link">
		<b class="bank-icon icon-tenpay"></b>浦发银行<b class="to-right"></b></a>
		</dd>

       
		<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="工商银行" onclick="tijiao2('1002')" datatoptips="" datasectips="" datacode="00903218" class="block-link">
		<b class="bank-icon icon-tenpay"></b>工商银行<b class="to-right"></b></a>
		</dd>


		-->
		<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="建设银行" onclick="tijiao2('1004')" id="wePay" datatoptips="" datasectips="" datacode="02802006" class="block-link">
		<b style="background: url(images/jianshe.png)/*tpa=http://pay.g448.net/demo/images/jianshe.png*/ no-repeat;" class="bank-icon icon-wechat"></b>建设银行<em class="otherTips"></em><b class="to-right"></b></a>
		</dd>
        
       
		<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="兴业银行" onclick="tijiao2('1010')" datatoptips="" datasectips="" datacode="00903218" class="block-link">
		<b style="background: url(images/xingye.ico)/*tpa=http://pay.g448.net/demo/images/xingye.ico*/ no-repeat;" class="bank-icon icon-tenpay"></b>兴业银行<b class="to-right"></b></a>
		</dd>


		
		<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="农业银行" onclick="tijiao2('1005')" datatoptips="" datasectips="" datacode="00903218" class="block-link">
		<b style="background: url(images/nongye.png)/*tpa=http://pay.g448.net/demo/images/nongye.png*/ no-repeat;" class="bank-icon icon-tenpay"></b>农业银行<b class="to-right"></b></a>
		</dd>



		

		<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="邮政银行" onclick="tijiao2('1006')" datatoptips="" datasectips="" datacode="00903218" class="block-link">
		<b style="background: url(images/youzheng.jpg.png)/*tpa=http://pay.g448.net/demo/images/youzheng.jpg*/ no-repeat;" class="bank-icon icon-tenpay"></b>邮政银行<b class="to-right"></b></a>
		</dd>

		<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="招商银行" onclick="tijiao2('1007')" datatoptips="" datasectips="" datacode="00903218" class="block-link">
		<b style="background: url(images/zhaoshang.png)/*tpa=http://pay.g448.net/demo/images/zhaoshang.png*/ no-repeat;" class="bank-icon icon-tenpay"></b>招商银行<b class="to-right"></b></a>
		</dd>
                                   
         </dl>

</div>



<div class="pb-wrap">
                        <div class="order-content">
                            <div class="order-name t-e">会员充值</div>
                            <div class="order-amount"><strong id="amount">1.00</strong><em>元</em></div>
                        </div>
                        <dl class="order-details" id="order-details">
                            <dt>商品名称：手机支付体验</dt>
                             
                        </dl>
                            <dl class="order-pay-way" id="other-pay">
        
		<dd class="other-pay-link"><a href="javascript:;" authorizedpayflag="N" dataname="alipayWap" dataway="支付宝" onclick="tijiao('alipay')" datacode="00600110" datatoptips="" datasectips="" class="block-link">
		<b class="bank-icon icon-alipay"></b>支付宝<b class="to-right"></b></a>
		</dd>
       
		<dd class="other-pay-link"><a href="javascript:;" dataname="wePay" dataway="公众号支付" onclick="tijiao('gzhpay')" id="wePay" datatoptips="" datasectips="" datacode="02802006" class="block-link">
		<b class="bank-icon icon-wechat"></b>公众号支付<em class="otherTips"></em><b class="to-right"></b></a>
		</dd>

		<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="快捷支付" onclick="tijiao('kuaijie')" id="wePay" datatoptips="" datasectips="" datacode="02802006" class="block-link">
		<b class="bank-icon icon-tenpay"></b>快捷支付<em class="otherTips"></em><b class="to-right"></b></a>
		</dd>
        
       <!--
		<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="网银支付" onclick="xuanze()" datatoptips="" datasectips="" datacode="00903218" class="block-link">
		<b class="bank-icon icon-tenpay"></b>网银支付<b class="to-right"></b></a>
		</dd>
       -->                          
                            </dl>
                                
                    <div class="wap-footer">版权所有  2015-2017 兔尔宝</div>
                </div>


</body>
</html>
