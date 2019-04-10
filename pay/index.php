<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>收银台 - <?php echo $web['sitename']; ?></title>
<link href="css/payorder.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
</head>
<body>


 <div class="header_wrap">
    <div class="header">
        <div class="fl">
                  <a target="_blank" class="logo_unionPay"><img src="img/index-logo.png" width="200" height="50" border="0"></a>          
        </div>
        <div class="fr">
         <a><img src="img/kefu.jpg" width="50" height="40" border="0"></a>
         <p><?php echo $web['sitephone']; ?></p>
        </div>
    </div>
</div>
<div class="main"> <!--main--> 
    <div class="content">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tb_style">
    
        <tr>
          <td width="31%" height="43"  class="td_border"><strong>订单金额：<font style="font-size:20px; color:#F60;">0.10</font>&nbsp;&nbsp;元</strong></td>
          <td width="36%"  class="td_border"><strong>商品名称：</strong>测试支付</td>
          
          <td width="33%"  class="td_border"><strong>订单编号：</strong><?php echo "PAY".date("YmdHis",time())."M"; ?></td>
      </tr>
        <tr>
          <td height="43"    class="td_border"><strong>交易币种：</strong>人民币</td>
          <td  class="td_border"><strong>交易时间：</strong><?php echo date("Y-m-d H:i:s",time()); ?></td>
          <td  class="td_border"><strong>商户名称：</strong>聚合支付</td>
      </tr>
    </table>
    </div>
</div><!--main--> 

<div class="main"> <!--main--> 

<div class="content"><!--content-->
<div style="width:100%;border-bottom:2px solid #0590da;float:right;">
<div style="float:right; background: #0590da;folat:right;text-align: center; width: 90px; height: 26px;color:#f5f5f5;">快捷支付</div>
<br>
</div>
      <div class="bank-wrap" style="height:418px"><!--bank-wrap-->
    
    <ul>
    
    	<li style="display: inline; *zoom: 1;">
            <label>
                <input type="radio" checked name="zftd" value="alipay" style="margin-top:20px;margin-left:66px;float:left; height:13px;" />
                <img src="img/alipay.png" style="float:left; margin-top:10px;">
           </label>
        </li>
    	<li style="display: inline; *zoom: 1;">
            <label>
                <input type="radio"  name="zftd" value="weixin" style="margin-top:20px;margin-left:66px;float:left; height:13px;" />
                <img src="img/weixin.png" style="float:left; margin-top:10px;">
           </label>
        </li>
        <li style="display: inline; *zoom: 1;margin-  :20px;">
            <label>
                <input type="radio"  name="zftd" value="yinlian" style="margin-top:20px;margin-left:66px;float:left; height:13px;" />
                <img src="img/yinlian.png" style="float:left; margin-top:10px;">
           </label>
        </li>
    </ul>
        </div><!--bank-wrap-->    
    </div><!--content-->
  
</div><!--main--> 



<div class="izl-rmenu" >
    <a class="consult" target="_blank"><div class="phone" style="display:none;">400-052-9958</div></a>    
    <a class="cart"><div class="pic" style="background-image: url(img/xxx.jpg);background-size:100%;"></div></a>    <a href="javascript:void(0)" class="btn_top" style="display: block;"></a>
</div>
<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=123456&amp;site=qq&amp;menu=yes" id="udesk-feedback-tab"  class="udesk-feedback-tab-left" style="display: block; background-color: black;">
  <div class="qq" style="display:none;">123456</div>
</a>

<script>
   $(function() {
      $(".btn_top").hide();
    $(".btn_top").click(function(){
      $('html, body').animate({scrollTop: 0},300);return false;
    })
    $(window).bind('scroll resize',function(){
      if($(window).scrollTop()<=300){
        $(".btn_top").hide();
      }else{
        $(".btn_top").show();
      }
    })
   })
</script>


<div class="main"> 
<div class="footer">
    <?php echo $web['sitename']; ?>&nbsp;&nbsp;&nbsp;&nbsp;版权所有&nbsp; (c) 2017-2018 <em>&nbsp;&nbsp;&nbsp;网站备案号：<?php echo $web['sitebeian']; ?><br>
    <strong>该商户由 <a href="<?php echo $web['siteurl']; ?>" target="_blank"><?php echo $web['sitename']; ?></a> 提供技术服务支持，谨防诈骗，举报热线：<?php echo $web['sitephone']; ?>  &nbsp; &nbsp;QQ:<?php echo $web['siteqq']; ?></strong> 
    <div>
    
    </div>
</div>
</div>
</body>
</html>