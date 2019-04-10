<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>接入文档 - <?php echo $web["sitename"]; ?></title>
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <script type="text/javascript" media="" src="/static/js/jquery.min.js"></script>
  <script type="text/javascript" media="" src="/static/js/scroll.js"></script>
  <script type="text/javascript" media="" src="/static/js/headerAnchor.js"></script>
  <link rel="stylesheet" type="text/css" href="/static/bootstrap/css/bootstrap.css">
  <script type="text/javascript" media="" src="/static/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/static/css/plugins/modules.css">
  <link rel="stylesheet" type="text/css" href="/static/css/plugins.css">
  <link rel="stylesheet" type="text/css" href="/static/css/font.css">
  <link rel="stylesheet" type="text/css" href="/static/css/reset.css">

</head>

<style media="screen">
body,html{
  padding: 0;
  margin: 0;
}
.header{
  height: 200px;
  background: rgba(0, 1, 17, 0.85);
  /*background-size: cover;*/
}
.header-homeImg{
  background: url("/static/images/withUs/son-home-redWhite.png") no-repeat center;
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
.son-header-menu{
  color:#fff;
}
.son-header-menu>a{
  color:#fff;
}
.menu-login-btn>span>a:visited {
  color: #fff;
}
.menu-login-btn>span>a {
  color: #fff;
}

.pay-left{
  position: absolute;
  width: 290px;
  background: #FFFFFF;

  border-radius: 4px;
  padding-top: 79px;
  text-align: center;

  /*-webkit-transition: all .1s ease-out;
  transition: all .1s ease-out;*/
}
.pay-left a{
  color:#000;
}
.pay-left a:hover{
  color: #FF5B68;
}
.pay-right-title：active{
  color:#000;
}

.pay-right{
  padding-left: 290px;
  font-size: 16px;
  color: #333333;
}

.pay-right-title{
  height: 35px;
  margin:30px 80px 0 80px;
  background-color: #FFF;
  border-color: #FFF;
  width: 85%;
  text-align: left;
  /*border: 1px solid;*/
}
.title-first{
  margin-top: 80px;
}
.pay-right-title：active{
  background-color: #FFF;
  border-color: #FFF;
  color: #FF5B68;
}
.pay-right-title:hover{
  background-color: #FFF;
  border-color: #FFF;
  color: #FF5B68;
  text-decoration: none;
}

.pay-right-content{
  width: 100%;
  /*height: 300px;*/
  background: #FFF;


}
.helpContent{
  width: 100%;
  background: #FFF;
  box-shadow: 0 2px 15px 0 rgba(160,165,178,0.30);
  border-radius: 4px;

  margin: -54px 0 0 0;
}

.pay-matter-list{
  font-size: 14px;
  color: #868686;
  font-weight: 550;

}
.pay-matter-list>dt{
  margin-top: 10px;
  /*cursor: pointer;*/
  border-left: 5px solid #FFF;
  line-height: 40px;
}
.pay-matter-list>dt:hover{
  color: #FF5B68;
  border-left: 5px solid #FF5B68;
}
.pay-matter-list>dt:nth-of-type(1){
  margin-top: 0;
  font-size: 16px;
  font-weight: 600;
  /*color: #FF5B68;
  border-left: 5px solid #FF5B68;*/
}
.helpPay-right-inner{
  padding-bottom: 50px;
  border-left:  1px solid #DCE2E8;
}
.helpPay-right-inner>div>p{
  font-size: 16px;
  color: #333333;
  cursor: pointer;
}
.helpPay-right-inner>div>div{
  font-size: 14px;
  color: #333333;
  letter-spacing: 0.51px;
  line-height: 30px;
  /*cursor: pointer;*/
  padding: 0;
  margin: 0;
}
.well{
  margin: 27px 0 0 0;
  padding: 30px 85px;
  border-radius: 0;
}
.helpPay-right-inner>div>p>span:last-of-type{
  float: right;
  height: 15px;
  width: 20px;
  background: url("/static/images/withUs/help/helpShowImg.png") no-repeat center;
  background-size: cover;
}
.helpPay-right-inner>div>p>span:nth-of-type(1){
  position: absolute;
  font-size: 40px;
  line-height: 18px;
  margin:  0 0 0 -40px;
}
#first-matterA{
  color: #FF5B68;
}

@media (min-width:1190px) and (max-width: 1400px) {
  .pay-right{
    padding-left: 180px;
    font-size: 16px;
    color: #333333;
  }
  .pay-left{
    position: absolute;
    width: 180px;
  }

}
@media (max-width: 768px) {
  .pay-left{
    display: none;
  }
  .pay-right{
    padding-left: 0;
  }
  .pay-right-title{
    margin:30px 5px 0 6px;
    white-space:normal; width:96%;
  }
  .well{
    margin: 27px 10px 0 5px;
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
        <span class="header-location">接入文档</span>
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

</div>

<div class="helpPay-content col-lg-8 col-lg-offset-2">
  <div class="helpContent">
    <div class="pay-left">
      <dl class="pay-matter-list">
        <dt>目录</dt>
        <dt><a class="matterA" href="#wdyt">文档用途</a></dt>
        <dt><a class="matterA" href="#jkwg">接口网关</a></dt>
        <dt><a class="matterA" href="#tjcs">提交参数</a></dt>
        <dt><a class="matterA" href="#xym">响应码</a></dt>
        <dt><a class="matterA" href="#ybtz">异步通知</a></dt>
        <dt><a class="matterA" href="#ddxx">订单信息</a></dt>
      </dl>
    </div>
    <div class="pay-right">
      <div class="helpPay-right-inner">

        <div class="qu-payment">
          <p class="pay-right-title title-first  btn btn-link"
          role="button" data-toggle="collapse" href="#collapseExample" name="wdyt"
          aria-expanded="false" aria-controls="collapseExample"><span>·</span>文档用途<span></span></p>
          <div class="collapse  pay-right-content" id="collapseExample">
            <div class="well">
            1：为方便使用商户集成所需接口支付，特编写此文档以作参考！
			<br>
			2：请认真阅读每一步流程所需参数及验证方法！
            </div>
          </div>
        </div>
      <div class="qu-payment">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample3"  name="jkwg"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>接口网关<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample3">
          <div class="well">
	<table class="table table-bordered">
      <thead>
        <tr>
          <th>通道名称</th>
          <th>通道代码</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>支付宝扫码</td>
          <td>alipay</td>
        </tr>
        <tr>
          <td>微信扫码</td>
          <td>weixin</td>
        </tr>
        <tr>
          <td>银联</td>
          <td>yinlian</td>
        </tr>
      </tbody>
    </table>	
          </div>
        </div>
      </div>

      <div class="qu-payment">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample4"  name="tjcs"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>提交参数<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample4">

          <div class="well">
1.请求方式：
 POST
<br>
2.提交网址：
http:///pay/api.php
<br>
3.参数说明：
	<table class="table table-bordered">
      <thead>
        <tr>
          <th>参数名称</th>
          <th>变量名</th>
          <th>类型长度</th>
          <th>是否可空</th>
          <th>说明</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>版本号</td>
          <td>bb</td>
          <td>varchar(5)</td>
          <td>no</td>
          <td>默认1.0</td>
        </tr>
        <tr>
          <td>商户编号</td>
          <td>shid</td>
          <td>int(8)</td>
          <td>no</td>
          <td>商户后台获取</td>
        </tr>
        <tr>
          <td>商户订单号</td>
          <td>ddh</td>
          <td>varchar(20)</td>
          <td>no</td>
          <td>商户自定义组成</td>
        </tr>
        <tr>
          <td>订单金额</td>
          <td>je</td>
          <td>decimal(18,2)</td>
          <td>no</td>
          <td>精确到小数点后两位，例如8.88</td>
        </tr>
        <tr>
          <td>支付通道</td>
          <td>zftd</td>
          <td>varchar(10)</td>
          <td>no</td>
          <td>详见附录1</td>
        </tr>
        <tr>
          <td>异步通知URL</td>
          <td>ybtz</td>
          <td>varchar(50)</td>
          <td>no</td>
          <td>不能带有任何参数</td>
        </tr>
        <tr>
          <td>同步跳转URL</td>
          <td>tbdz</td>
          <td>varchar(50)</td>
          <td>no</td>
          <td>不能带有任何参数</td>
        </tr>
        <tr>
          <td>订单名称</td>
          <td>ddmc</td>
          <td>varchar(50)</td>
          <td>no</td>
          <td>自定义</td>
        </tr>
        <tr>
          <td>订单备注</td>
          <td>ddbz</td>
          <td>varchar(50)</td>
          <td>no</td>
          <td>自定义</td>
        </tr>
        <tr>
          <td>md5签名串</td>
          <td>sign</td>
          <td>varchar(32)</td>
          <td>no</td>
          <td>参照订单MD5签名</td>
        </tr>
      </tbody>
    </table>	
备注：系统返回MD5的签名方法：注意需要把括号包括内容替换成真实参数MD5加密          </div>
        </div>
      </div>
      <div class="qu-payment">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample5"  name="xym"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>响应码<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample5">
          <div class="well">
           参照API接口文档
          </div>
        </div>
      </div>
      <div class="qu-payment">
        <p class="pay-right-title btn btn-link" 
        role="button" data-toggle="collapse" href="#collapseExample6"  name="ybtz"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>异步通知<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample6">

          <div class="well">
异通知回调：<br>
1.通知方式：<br>
POST<br>


2.收到通知回复：<br>
收到通知后请回复  success<br>

3.参数说明：<br>
	<table class="table table-bordered">
      <thead>
        <tr>
          <th>参数名称</th>
          <th>变量名</th>
          <th>类型长度</th>
          <th>说明</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>状态</td>
          <td>status</td>
          <td>varchar(10)</td>
          <td>success:成功，fail失败</td>
        </tr>
        <tr>
          <td>商户编号</td>
          <td>shid</td>
          <td>int(8)</td>
          <td>订单对应的商户ID</td>
        </tr>
        <tr>
          <td>商户订单号</td>
          <td>ddh</td>
          <td>varchar(20)</td>
          <td>商户网站上的订单号</td>
        </tr>
        <tr>
          <td>订单金额</td>
          <td>je</td>
          <td>decimal(18,2)</td>
          <td>支付金额</td>
        </tr>
        <tr>
          <td>支付通道</td>
          <td>zftd</td>
          <td>varchar(10)</td>
          <td>渠道代码</td>
        </tr>
        <tr>
          <td>异步通知URL</td>
          <td>ybtz</td>
          <td>varchar(50)</td>
          <td>POST异步通知</td>
        </tr>
        <tr>
          <td>同步跳转URL</td>
          <td>tbdz</td>
          <td>varchar(50)</td>
          <td>GET同步跳转</td>
        </tr>
        <tr>
          <td>订单名称</td>
          <td>ddmc</td>
          <td>varchar(50)</td>
          <td>支付订单的名称</td>
        </tr>
        <tr>
          <td>订单备注</td>
          <td>ddbz</td>
          <td>varchar(50)</td>
          <td>支付订单的备注</td>
        </tr>
        <tr>
          <td>md5签名串</td>
          <td>sign</td>
          <td>varchar(32)</td>
          <td>参照通知MD5签名</td>
        </tr>
      </tbody>
    </table>	
4.通知MD5签名方法：<br><br>

$sign=md5(status=(支付状态)&shid=(商户ID)&bb=(接口版本号)&zftd=(支付通道)&ddh=(商户订单号)&je=(订单金额)&ddmc=(订单名称)&ddbz=(订单备注)&ybtz=(异步通知地址)&tbtz=(同步跳转地址)&(商户KEY密匙));<br>

备注：系统返回MD5的签名方法：注意需要把括号包括内容替换成真实参数MD5加密
          </div>
        </div>
      </div>
      <div class="qu-payment">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample7"  name="ddxx"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>订单查询接口<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample7">

          <div class="well">
            参照API接口文档
          </div>
        </div>
      </div>


    </div>
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
            <span class="footer-content-content"><a  href="#">常见问题</a><br></span>
            <span class="footer-content-content"><a  href="#">技术问题</a><br></span>
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
</div>
</body>

<script type="text/javascript">
var $root = $('html, body');
$(document).ready(function(){

  readyLoad();
  helpComm();
  scrollListener();
})

function helpComm(){
  $('.matterA').click(function() {
    $root.animate({
      scrollTop: $('[name="' + $.attr(this, 'href').substr(1) + '"]').offset().top
    }, 200);
    return false;
  });
}
function scrollListener(){
  window.onscroll = function (e) {

    if(window.scrollY >= 80){
      $('.pay-left').css({
        'position':'fixed',
        'padding-top': '0'
      })
    }else{
      $('.pay-left').css({
        'position':'absolute',
        'padding-top': '79px'
      })
    }


    var matterAList = $(".matterA");
    for (var i = 0; i <matterAList.length; i++){

      if(i == 0){
        if(window.scrollY <= $('[name="' + matterAList.eq(i).attr('href').substr(1) + '"]').offset().top){
          matterAList.eq(i).css({'color':'#EF5660'});
        }
      }
      //最后一个 eq(i+1) undefined
      if(i== matterAList.length-1){
        if(window.scrollY >= $('[name="' +   matterAList.eq(i).attr('href').substr(1) + '"]').offset().top){
          matterAList.eq(i).css({'color':'#EF5660'});
        }else{
          for (var j = 0; j <matterAList.length; j++){
            if(i != j){
              matterAList.eq(i).css({'color':'#000'});
            }
          }
        }
        //其他
      }else{
        if(window.scrollY >= $('[name="' +   matterAList.eq(i).attr('href').substr(1) + '"]').offset().top
        &&
        window.scrollY < $('[name="' +   matterAList.eq(i+1).attr('href').substr(1) + '"]').offset().top
      ){
        matterAList.eq(i).css({'color':'#EF5660'});
        // matterAList.eq(i).siblings().css({'color':'#000'});
      }else{
        for (var j = 0; j <matterAList.length; j++){
          if(i != j){
            matterAList.eq(i).css({'color':'#000'});
          }
        }
      }
    }
  }
}
}






</script>

</html>