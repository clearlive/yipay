<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>帮助中心 - <?php echo $web["sitename"]; ?></title>
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <script type="text/javascript" media="" src="/static/js/jquery.min.js"></script>
  <script type="text/javascript" media="" src="/static/js/headerAnchor.js"></script>
  <link rel="stylesheet" type="text/css" href="/static/bootstrap/css/bootstrap.css">
  <script type="text/javascript" media="" src="/static/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/static/css/plugins/modules.css">
  <link rel="stylesheet" type="text/css" href="/static/css/plugins.css">
  <link rel="stylesheet" type="text/css" href="/static/css/font.css" >
  <link rel="stylesheet" type="text/css" href="/static/css/reset.css">

</head>

<style media="screen">
body,html{
  padding: 0;
  margin: 0;
}
.header{
  height: 300px;
  background: url("/static/images/withUs/help/helpbase.png");
  background-size: cover;
  border: none;
  color: #fff;
}
.header-homeImg{
  background: url("/static/images/withUs/son-home.png") no-repeat center;
  background-size: cover;
}

.header-logoImg{
  background: url("/static/images/withUs/son-logo.png") no-repeat center;
  background-size: cover;
}
.header-logoIcon{
  background: url("/static/images/withUs/logoIcon.png") no-repeat center;
}
.header-location{
  color: #fff;
}
.header-menu-links>div:hover .header-menu-borderP{
  border-bottom:  10px solid #fff;
}

.header-corpCulture{
  height: 74px;
  margin-top: 30px;
  text-align: left;
  padding: 0 0 0 45px;

}
.header-corpCulture-content{
  font-size: 20px;
  color: #FFFFFF;
  line-height: 40px;
  padding: 0 0 0 50px;

}
.header-corpCulture-content>p{
  font-size: 48px;
  font-weight: 100;
  letter-spacing: -2.75px;
  padding : 20px 0;
}

.help-content{
  padding: 0;
  margin-top: -35px;
}
.help-content-first{
  display: flex;
  justify-content: space-around;
  height:230px;
  padding: 0;
}
.help-content-first>div{
  width: 43%;
  height:230px;
  background: #FFFFFF;
  box-shadow: 0 1px 6px 0 rgba(155,155,155,0.50);
  border-radius: 5px;
  cursor: pointer;
  padding: 90px 0 0 4%;

  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
  -webkit-transition: all .3s ease-out;
  transition: all .3s ease-out;
}
.help-content-first>div:hover{
  background: #FFFFFF;
  /*box-shadow: 0 0 24px 0 rgba(155,155,155,0.50);*/
  box-shadow:0 16px 33px 0px rgba(215, 215, 215, 0.5);
  border-radius: 5px;
}

.help-content-second{
  /*display: inline-block;*/
  height: 200px;
  margin-top: 85px;
  text-align: center;
  font-size: 20px;
  color: #595959;
}
.help-content-second>span{
  line-height: 55px;
  font-weight: 550;
}
.first-contet-btn{
  margin-top: 50px;
}
.first-contet-btn{
  display: inline-block;
  margin-top: 20px;
  width: 300px;
  height: 130px;
  padding: 30px;
  text-align: center;
}
.point-btn-backDiv{
  width: 100%;
}
.help-content-first>div>p{
  float: left;
}
.help-content-first>div>p:nth-of-type(1){
  height: 50px;
  width: 50px;
}
.help-content-first>div>p:nth-of-type(2){
  margin-left: 8%;
  font-size: 14px;
  color: #595959;
}
.help-content-first>div>p>span:nth-of-type(1){
  display: block;
  font-size: 18px;
  font-weight: 600;
  color: #23242D;
  padding-bottom: 20px;
}
.help-base-arrow{
  position: absolute;
  height: 52px;
  width: 52px;

}
.help-content-left>p:nth-of-type(3){
  background: url("/static/images/withUs/help/help-ct-btn.png");
  background-size: cover;
}
.help-content-right>p:nth-of-type(3){
  background: url("/static/images/withUs/help/help-ct-right-btn.png");
  background-size: cover;
}

.help-content-left>p:nth-of-type(1){
  background: url("/static/images/withUs/help/help-ct-left.png");
  background-size: cover;
}
.help-content-right>p:nth-of-type(1){
  background: url("/static/images/withUs/help/help-ct-right.png");
  background-size: cover;
}
.footer{
  height: 400px;
  margin: 120px 0 0 0;
}
.header-homeImg{
  background: url("/static/images/withUs/son-home-white.png") no-repeat center;
  background-size: cover;
}

.menu-login-btn>span>a{
  color: #FFF;
}
.menu-login-btn>span>a:visited {
  color: #FFF;
}
.menu-login-btn>span>a:hover{
  color: #FFF;
}

@media (min-width:1000px) and (max-width: 1200px) {

  .header-corpCulture-content{
    margin: 100px 0 0 0;
  }
}
@media (max-width: 768px) {
  .help-content-first{
    display: flex;
    justify-content: center;
    flex-wrap:  wrap;
    height:230px;
    padding: 0;
  }

  .header-corpCulture-content{
    padding:  80px 60px 0 60px;
    font-size: 16px;
    color: #FFFFFF;
    line-height: 30px;
  }
  .header-corpCulture-content>p{
    font-size: 32px;
  }
  .help-content-first>div{
    width: 80%;
    padding: 90px 0 0 50px;
  }
  .help-content-first>div:nth-of-type(2){
    margin-top: 50px;
  }
  .help-content-second{
    margin-top: 300px;
  }
}
</style>

<body>

  <div class="header col-lg-12">
    <div class="header-logoDiv col-lg-8 col-lg-offset-2 col-md-12 col-sm-12">

      <div class="logo-div">
        <a href="/">
          <div class="header-homeImg">
          </div>
          <div class="header-logoImg">
          </div>
        </a>
        <div class="header-logoIcon">
        </div>
        <span class="header-location">帮助中心</span>
      </div>


      <div class=" son-header-menu header-menu-links">
        <div class="menu-product">
          <span class="h5">产品</span>
          <p class="header-menu-borderP">
          </p>
          <div class="menu-product-content menu-hidd">
            <div class="menu-product-list menu-list">
              <div class="">
                <dl class="">
                  <dt>支付服务</dt>
                  <dt><a href="#">在线支付</a></dt>
                  <dt><a href="#">APP支付</a></dt>
                </dl>
              </div>
              <div class="">
                <dl class="">
                  <dt>增值服务</dt>
                  <dt><a href="#">二次开发</a></dt>
                  <dt><a href="#">商户对接</a></dt>
                </dl>
              </div>
            </div>
          </div>
        </div>

        <div class="menu-exploit">
          <span class="h5">开发者中心</span>
          <p class="header-menu-borderP">
          </p>
          <div class="menu-exploit-content menu-hidd">
            <div class="menu-exploit-list menu-list">
              <dl class="">
                <dt><a  href="/doc">API文档</a></dt>
                <dt><a  href="/sdkDownload">SDK下载</a></dt>
              </dl>
            </div>
          </div>
        </div>

        <div class="menu-help">
          <span class="h5">订单查询</span>
          <p class="header-menu-borderP">
          </p>

        </div>

        <div class="menu-login-btn">
          <span>
		<?php
			if(@$_SESSION['user']!=null){
				echo '<a href="/user">商户中心</a>';
			}else{
				echo '<a href="/reg">注册</a> / <a href="/login">登录</a>';
			}
		?>
          
          </span>
          <p class="header-menu-borderP">
          </p>
        </div>
      </div>
    </div>

    <div class="phone_nav navbar navbar-default  navbar-inverse" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
                    <span class="sr-only">切换导航</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="color:#000" onclick="jump(this)" href="javascript:void(0)" data="/">
                    <!--<img src="image/front/logoWt.png" alt="">-->
                </a>
            </div>
            <div class="collapse navbar-collapse" id="example-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            产品 <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>支付服务</li>
                            <li><a href="#">在线支付</a></li>
                            <li><a href="#">APP支付</a></li>
                            <li>增值服务</li>
                            <li><a href="#">二次开发</a></li>
                            <li><a href="#">商户对接</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            开发者中心 <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/doc">API文档</a></li>
                            <li><a href="/sdkDownload">SDK下载</a></li>
                        </ul>
                    </li>
                    <li><a onclick="jump(this)" href="javascript:void(0)" data="/cha">订单查询</a></li>
					<?php
						if(@$_SESSION['user']!=null){
							echo '<li><a href="/user">商户中心</a></li>';
						}else{
							echo '<li><a href="/reg">注册</a></li><li><a href="/login">登录</a></li>';
						}
					?>
                    
                </ul>
            </div>
        </div>
    </div>

  <div class="header-corpCulture-content col-lg-8 col-lg-offset-2">
    <p>有问题，解决它。</p>
    这里的内容每天都在变得更加丰富，希望可以帮助你更加方便的接入我们的服务。
  </div>

</div>



<div class="help-content col-lg-10 col-lg-offset-1">

  <div class="help-content-first col-lg-10 col-lg-offset-1">

    <div class="help-content-left">
      <p></p>
      <p>
        <span>「常见问题」<br></span>
        <span>聚合、产品、流程</span>
      </p>
      <p class="help-base-arrow"></p>
    </div>

    <div class="help-content-right">
      <p></p>
      <p>
        <span>「技术问题」<br></span>
        <span>技术问题、入网流程</span>
      </p>
      <p class="help-base-arrow"></p>
    </div>

  </div>

  <div class="help-content-second col-lg-12">
    <span>查看API文档<br></span>
    可前往开发者中心查看相关信息
    <div class="point-btn-backDiv">
      <p class="first-contet-btn  point-btn-back">
        <a  href="/doc" class="myButton-black point-btn mobile-btn-blc" >前往开发者中心</a>
      </p>
    </div>
  </div>

</div>

    <div class="footer base col-md-12 row">
      <div class="col-md-8 col-md-offset-2">
        <div class="footer-content">
          <div>
            <span class="footer-content-title">关于我们<br></span>
            <span class="footer-content-content"><a  href="#">团队介绍</a><br></span>
            <span class="footer-content-content"><a  href="#">新闻动态</a><br></span>
          </div>
          <div>
            <p class="">
              <span class="footer-content-title">产品<br></span>
              <span class="footer-content-content"><a href="#">在线支付</a><br></span>
              <span class="footer-content-content"><a href="#">APP支付</a><br></span>

            </p>
            <p class="">
              <span class="footer-content-content"><a href="#">二次开发</a><br></span>
              <span class="footer-content-content"><a href="#">商户对接</a><br></span>
            </p>
          </div>

          <div>
            <span class="footer-content-title">开发者中心<br></span>
            <span class="footer-content-content"><a  href="/doc">API文档</a><br></span>
            <span class="footer-content-content"><a  href="/sdkDownload">SDK下载</a><br></span>
          </div>

          <div>
            <span class="footer-content-title">帮助<br></span>
            <span class="footer-content-content"><a  href="/help">常见问题</a><br></span>
            <span class="footer-content-content"><a  href="/help">技术问题</a><br></span>
          </div>
          <div>
            <span class="footer-content-title">咨询方式<br></span>
            <span class="footer-content-content">
              邮箱：<a href="mailto:<?php echo $web["sitemail"]; ?>"  title="点击进入邮箱"><?php echo $web["sitemail"]; ?></a><br>
            </span>
            <span class="footer-content-content">电话：<?php echo $web["sitephone"]; ?><br></span>

            <span class="footerContact footerWay1"  title="关注公众号">
              <div class="wxQrCodeShow"> </div>
            </span>
            <a  title="查看微博" href="#"><span class="footerContact footerWay2"></span></a>
          </div>

        </div>
        <div class="footer-ICP">
        <span class=" h8">Copyright © 2018&nbsp;<?php echo $web["sitecom"]; ?>&nbsp;<?php echo $web["sitebeian"]; ?></span>
      </div>
    </div>
  </div>
</body>

<script type="text/javascript">
$(".point-btn").hover(function(){
  $(".point-btn-back").attr("class","first-contet-btn point-btn-back point-btn-back-show")
})
$(".point-btn").mouseleave(function(){
  $(".point-btn-back-show").attr("class","first-contet-btn point-btn-back")
})

$(".help-content-left").click(function(){
  window.location.href="help.php";

})
$(".help-content-right").click(function(){
  window.location.href="/doc";
})

$(document).ready(function(){
  IEbrowser();
})

function IEbrowser(){
  if(isIE()){
    $(".help-base-arrow").css({
       'margin-left': '37%'
    })

  }else{
    $(".help-base-arrow").css({
      'right': '-23px'
    })
  }
}


function isIE() { //ie?
  if (!!window.ActiveXObject || "ActiveXObject" in window)
  return true;
  else
  return false;
}



</script>

</html>
