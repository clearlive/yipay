
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>金易付，让支付更简单</title>
<link rel="stylesheet" type="text/css" href="css/pay.css">

<link type="text/css" href="css/keyPay.css" rel="stylesheet" />

<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">


<link href="css/common.css" rel="stylesheet">
<link href="css/polyPay.css" rel="stylesheet">
</head>

<body>

 <script type="text/javascript">

        if (!window.jQuery) {
            document.write('<script type="text/javascript" src="/script/jquery.js"><' + '/script>');
        }
        if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
            window.location.href = "Mobile.php";
        }

 </script>


<div style="border-bottom: #0590da solid 0px;" class="header pinned">
	<div class="header-main clearfix">
		<h1 id="logo"><a href="/"><img src="/images/logo.png"></a></h1>
		<div class="nav-box">
			<ul class="nav" id="nav">
				<li class="more"><a href="#nogo">产品与服务</a>
				<div class="nav-line">
				</div>
				<div class="sub-nav product-list">
					<ul>
						<li><a href="javascript:void(0);">网银支付</a></li>
						<li><a href="javascript:void(0);" onclick="sa.track(&quot;activityClicks&quot;,{name:&quot;扫码支付&quot;,platformType:&quot;pc&quot;})">扫码支付</a></li>
						<li><a href="javascript:void(0);" onclick="sa.track(&quot;activityClicks&quot;,{name:&quot;现金罗盘&quot;,platformType:&quot;pc&quot;})">快捷支付</a></li>
						<li><a href="javascript:void(0);">QQ钱包</a></li>
					</ul>
				</div>
				</li>
				<li> <a target="_blank" href="/demo">在线体验</a> <div class="nav-line"></div> </li>
				<li> <a target="_blank" href="javascript:void(0);">帮助中心</a> <div class="nav-line"></div> </li>

				<li><a target="_blank" href="javascript:void(0);"></a>
				<div class="nav-line">
				</div>
				</li>
			</ul>
		</div>
		<div class="login-box">
			<div class="phone-400">
				7X24 在线客服
			</div>
			<div class="no_login" style="display: block;">
				<a class="login-btn" href="/login">登录</a><a class="reg-btn" href="/register" onclick="sa.track(&quot;registerBtnClicks&quot;,{platformType:&quot;pc&quot;,position:&quot;头部右上角&quot;,pageUrl:location.href})">注册</a>
			</div>
			<div class="has_login clearfix" style="display: none;">
				<a class="app-btn" alt="应用中心" href="/appcenter">应用中心</a><a id="quit" class="quit-btn" alt="退出" href="javascript:void(0)">退出</a>
			</div>
		</div>
	</div>
</div>







<form name='type' method="post" action="pay.php" target="_blank">
<input size="50" type="hidden" name="pd_Order" value="201603061147305643" />
<!-- 内容 begin  -->

<div style="margin-top:70px" id="content">



<div class="sb">



<div class="centersb" id="orderDetails">

<ul>

	<li style="font-size: 18px;"><strong>商品金额：</strong><span id="orderId" style="color:#F00">1元</span></li>

	<li><strong>商品名称：</strong><span id="goodsName"><a href="http://www.1yytd.com" title="pay">在线体验</a></span></li>

	<li><strong>商户信息：</strong>金易付 在线体验</li>



</ul>
</div>

<div class="rightsb">
<p><font color="#FF6600" size="+2" style="font-weight: bold;"
	id="countNum">&yen; 1.00</font>元</p>
<div style="background: #0590da; text-align: center; width: 90px; height: 26px; position: relative; top: 25px; left: 30px; color:#f5f5f5;"
	onClick="showMoreDetails();">订单详情</div>
</div>

</div>



<div class="	">


<style type="text/css">
	  .credit-icon{background: url(images/credit.png) no-repeat; display:inline-block; width:13px; height:18px;position:absolute;  cursor:pointer;}
</style>
<div class="zhifu"><span id="payTitle" style="font-size: 17px;">快捷支付：</span>



    
    
    <!-- 支付类型 -->
    
    <div id="payTypeList" class="bankWrap" style="margin-top:20px">
    
    <ul>
    
    	<li>
            <label>
                <input type="radio" checked name="pd_FrpId" value="alipay" style="margin-top:10px;float:left; height:13px;" />
                <div class="iw" style=" padding-top:3px; padding-bottom:3px;background:url(images/alipay.png) no-repeat center center; margin-left:10px" title="支付宝"></div>
           </label>
        </li>
    	<li>
            <label>
                <input type="radio"  name="pd_FrpId" value="weixin" style="margin-top:10px;float:left; height:13px;" />
                <div class="iw" style=" padding-top:3px; padding-bottom:3px;background:url(images/logo_wxpay.png) no-repeat center center; margin-left:10px" title="微信扫码支付"></div>
           </label>
        </li>
        <li>
            <label>
                <input type="radio"  name="pd_FrpId" value="kuaijie" style="margin-top:10px;float:left; height:13px;" />
                <div class="iw" style=" padding-top:3px; padding-bottom:3px;background:url(images/ylzx.png) no-repeat center center; margin-left:10px" title="银联支付"></div>
           </label>
        </li>
    </ul>
    </div>
</div>
<div style="height:30px; width:100%"></div>
<div class="zhifu"><span id="payTitle" style="font-size: 17px;">网银支付OR信用卡支付：</span>





<!-- 支付类型 -->

<div id="payTypeList" class="bankWrap" style="margin-top:20px">

<ul>

    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="ICBC"  style="margin-top:10px;float:left; height:13px;" />
            <div class="iw ICBC" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="工商银行"></div>
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="CCB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw CCB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="建设银行"></div>
	   </label>
       
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="ABC" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw ABC" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="农业银行"></div>
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="CMB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw CMBCHINA" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="招商银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="BOCB2C" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw BOC" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="中国银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="COMM" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw BOCO" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="交通银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="PSBC-DEBIT" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw POST" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="中国邮政储蓄"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="CEBBANK" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw CEB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="光大银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="GDB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw GDB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="广东发展银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="CIB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw CIB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="兴业银行"></div>
	   </label>
	</li>
    
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="SPDB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw SPDB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="上海浦东发展银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="CMBC" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw CMBC" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="民生银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="CITIC" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw ECITIC" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="中信银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="SPABANK" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw PINGANBANK" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="平安银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="SPABANK" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw SDB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="深圳发展银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="SHBANK" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw SHB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="上海银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="SRCB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw SRCB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="上海农村商业银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="BJRCB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw BJRCB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="北京农商银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="HZCB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw HZBANK" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="杭州银行"></div
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="NBCB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw NBCB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="宁波银行"></div>
            
	   </label>
	</li>
    
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="CBHB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw CBHB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="渤海银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="NJCB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw NJCB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="南京银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="HKBEA" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw HKBEA" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="东亚银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="HXB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw HXB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="华夏银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="SCCB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw SCCB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="河北银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="SDE" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw SDE" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="顺德信用社"></div>
            
	   </label>
	</li>
</ul>

</div>

</div>
<table
	style="width: 900px; height: 50px; border: 0; margin-right: 10px; margin-left: 50px;">

	<tr style="background-color: #fff;border:0">

		<td style="background-color: #fff;border:0" align="right"><input type="image" id="btn_pay" src="images/pay.png" onClick="return pay();" /></td>

	</tr>

</table>

</div>

</div>






</form>


<!-- 内容 end -->

<div style="height:100px;padding-top:35px" id="footer">

<div style="background-color: #464646;" class="footer margin">

<p>(c)2017~2018 聚合支付 版权所有 Copyright <a href="http://dev.123.com/" target="_blank">dev.123.com.cn</a>, All Rights Reserved | <a href="http://www.miitbeian.gov.cn/" target="_blank">粤ICP备12345678号</a> 投诉电话     | <a href="/">123456</a></p>

</div>

</div>

</body>
</html>