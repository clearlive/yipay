<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport"
  content="width=device-width,initial-scale=1,
  maximum-scale=1,user-scalable=no">
  <title>体验支付 - <?php echo $web["sitename"]; ?></title>
  <link rel="stylesheet" type="text/css" href="css\toPay.css">
  <link rel="stylesheet" type="text/css" href="css\media.css">
  <script type="text/javascript" media="" src="js\jquery.min.js"></script>
  <script type="text/javascript" media="" src="js\toPay.js"></script>
  <script type="text/javascript" media="" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
  <script type="text/javascript" media="" src="js\share.js"></script>
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="css\reset.css">
  <script type="text/javascript">
  // alert(Math.random().toString(36).substr(2));
  wx.config({
      debug:false,
      appId:"wxf3167b8d0a7132ca",
      timestamp:new Date().getTime(),
      nonceStr:"5a9948e15caba8a3",
      signature:"b493399864c2e059171ea25dbf83d2ee507ab6a7",
      jsApiList:['onMenuShareTimeline','onMenuShareAppMessage']
  });
  wx.error(function(res){
      console.log(res);
  });
  wx.ready(function(){
      wx.onMenuShareTimeline({
          title:"nowpay-demo",
          link:"/demo/",
          imgUrl:"/paydemo/images/logo.png",
          success:function(){
          },
          cancel:function(){
          }
      });
      wx.onMenuShareAppMessage({
          title:"nowpay-demo",
          link:"/demo/",
          imgUrl:"/paydemo/images/logo.png",
          success:function(){
          },
          cancel:function(){
          }
      });
  });
  </script>
</head>

<body>

  <div class="father" id="particles-js">
    <!-- 外层动画 -->
    <div class="crust">
        <div id="begin-effect">
        </div>
    </div>

   <!-- 以下为内层 -->
    <header>
      <!-- <div class="headerBgImg">
      </div> -->
      <div class="logoDiv" >
        <img src="images\logo.png">
      </div>
      <div class="thankWords" >
      <p style="display: inline-block;">嘿，你好~   </p>   <!-- id="wordA"   id="wordB"-->
        <p style="display: inline-block;">感谢体验<?php echo $web["sitename"]; ?></p>
        <span id="typed" style="display: inline-block;"></span>
      </div>
    </header><div style="clear:both;"></div>

    <div class="contant">
      <p class="overimage"></p>
      <p class="overimageShadowA"></p>
      <p class="overimageShadowB"></p>
      <div class="printOuterDiv">
        <p class="printOuterWay"></p>
      </div>
      <div class="printPaperDiv" >
        <span>1.00</span><span id="cc">元</span>
        <p><br>体验专业的支付服务</p>
      </div>
    </div>

    <div class="footer">
      <a href="#" class="myButton" id="myButton"><span></span>立即体验</a>
    </div>

    <div class="bg"></div>
    <div class="loadingBg">
      <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
      </div>
    </div>

    <div class="payChannelDiv" id="payChannelDiv">
      <ul class="ul1">
        <li id="wxBtn"><dl><dt id="wxImg" ></dt><dd>微信</dd></dl></li><span class="channelPoint">|</span>
        <li id="aliBtn"><dl><dt id="aliImg"></dt><dd>支付宝</dd></dl></li><dd class="channelPoint">|</dd>
        <li id="unBtn" ><dl><dt id="unImg"></dt><dd>银联</dd></dl></li>
      </ul>
      <div class="bottom-div">
        <span class="bottom-content">支持以上支付方式</span>
      </div>
    </div>
  </div>






  <script type="text/javascript"  src='js\particles.min.js'></script>
  <script type="text/javascript"  src='js\stats.js'></script>
  <script type="text/javascript" media="" src="js\line.js"></script>

</body>
</html>
