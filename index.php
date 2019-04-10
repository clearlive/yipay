<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
?>
<!DOCTYPE html>
<html class="mdl-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <title><?php echo $web["sitename"]; ?> - 专业的支付服务提供商</title>
  <meta name="title" content="聚合支付" />
  <meta name="subject" content="移动支付、在线支付、网银支付、线下聚合、智能pos、跨境支付、线上聚合、代收代付、B2B业务、外卡业务" />
  <meta name="description" content="提供多种创新支付方式，为个人和企业提供多种主流支付方式，实现轻松快捷收款对账" />
  <meta name="keywords" content="聚合支付，微信、支付宝、银联、一键支付、应用内支付、移动支付、pos支付 " />
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="/static/bootstrap\css\bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/static/css\style.css">
  <link rel="stylesheet" type="text/css" href="/static/css\font.css">
  <link rel="stylesheet" type="text/css" href="/static/css\plugins.css">
  <link rel="stylesheet" type="text/css" href="/static/css\media.css">
  <link rel="stylesheet" type="text/css" href="/static/css\swiper\swiper-3.4.2.min.css">
  <script type="text/javascript" media="" src="/static/js\jquery.min.js"></script>
  <script type="text/javascript" media="" src="/static/js\swiper-3.4.2.min.js"></script>
  <script type="text/javascript" media="" src="/static/bootstrap\js\bootstrap.min.js"></script>
  <script type="text/javascript" media="" src="/static/js\index.js"></script>
  <script type="text/javascript" media="" src="/static/js\plugins.js"></script>
  <link rel="stylesheet" href="/static/mdl/material.min.css">
  <script src="/static/mdl/material.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/static/css\reset.css">
  <style media="screen">
  .modalFade{
    min-width: 30px;
  }	
  .modal-btn{
    display: inline-block;
    height: 30px;
    width: 90px;
    padding: 8px 0 0 0;
  }
  .modal-btn:hover{
    color: #fff;
  }
  .first-contet>div{
    padding: 0;
  }
  .mch-swiper{
    position: relative;
    height: 370px;
    width: 36%;
    padding: 0;
    border: none;
    z-index: 60;
    margin-top: 80px;

    box-shadow: 0 0 40px 0 #D7D7D7;
    border-radius: 5px;
  }

  #pagination1>span:hover{
    opacity: 1;
  }
  </style>


</head>

<body>
<div id="to-top" class="to-top-hidd"></div>
  <div class="header base col-lg-12 row">
    <div class="header-menu col-lg-8 col-md-12 col-lg-offset-2">
      <p class="header-menu-logo">
        <img src="/static/images/unique/logoBlack.png" alt="">
      </p>
      <div class="header-menu-links">
        <div id="jumphome" style="display: inline;">
          <a href="/" style="margin-top:10px;margin-buttom:10px;color:black;font-size:16px;">首页</a>
        </div>
		</a>
        <div class="menu-product">
          <span class="h5">产品</span>
          <p class="header-menu-borderP">
          </p>

          <div class="menu-product-content menu-hidd">
            <div class="menu-product-list menu-list">
              <div class="">
                <dl class="">
                  <dt>支付服务</dt>
                  <dt><a href="#">支付宝扫码</a></dt>
                  <dt><a href="#">支付宝WAP</a></dt>
                  <dt><a href="#">蚂蚁花呗</a></dt>
                  <dt><a href="#">微信扫码</a></dt>
                  <dt><a href="#">微信WAP</a></dt>
                  <dt><a href="#">微信H5</a></dt>
                  <dt><a href="#">银联快捷</a></dt>
                  <dt><a href="#">网银支付</a></dt>
                </dl>
              </div>
              <div class="">
                <dl class="">
                  <dt>增值服务</dt>
                  <dt><a href="#">鉴权服务</a></dt>
                  <dt><a href="#">短信服务</a></dt>
                  <dt><a href="#">银行合作</a></dt>
                  <dt><a href="#">跨境支付</a></dt>
                  <dt><a href="#">支付定制</a></dt>
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
                <dt><a href="/doc">API文档</a></dt>
                <dt><a href="/sdkDownload">SDK下载</a></dt>
              </dl>
            </div>
          </div>
        </div>

        <div class="menu-help">
          <span class="h5">订单查询</span>
          <p class="header-menu-borderP">
          </p>

        </div>
        <div class="menu-login-btn h4">
		
		<?php
			if(@$_SESSION['user']!=null){
				echo '<a href="/user" class="h5""><b>商户中心</b></a> ';
			}else{
				echo '<a class="h5" href="/reg">注册</a> / <a class="h5" href="/login">登录</a> <p class="header-menu-borderP"> </p>';
			}
		?>
          <p class="header-menu-borderP" onclick="javascript:window.location.href='/user'" id="shzx">
          </p>
        </div>
      </div>
    </div>
  </div>
  <!--  -->
  <div class="firstBack backScroll base">
  </div>

  <div class="navbar navbar-default  navbar-inverse" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse"
        data-target="#example-navbar-collapse">
        <span class="sr-only">切换导航</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="color:#000" href="#">
        <img src="/static/images/unique/logoWt.png" alt="">
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
            <li><a  href="#">支付宝扫码</a></li>
            <li><a  href="#">支付宝WAP</a></li>
            <li><a  href="#">蚂蚁花呗</a></li>
            <li><a  href="#">微信扫码</a></li>
            <li><a  href="#">微信WAP</a></li>
            <li><a  href="#">微信H5</a></li>
            <li><a  href="#">银联快捷</a></li>
            <li><a  href="#">网银支付</a></li>

            <li>增值服务</li>
            <li><a  href="#">鉴权服务</a></li>
            <li><a  href="#">短信服务</a></li>
            <li><a  href="#">银行合作</a></li>
            <li><a  href="#">跨境支付</a></li>
            <li><a  href="#">支付定制</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            开发者中心 <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            <li><a href="/doc">API文档</a></li>
            <li><a ui-sref="sdkdownload">SDK下载</a></li>
          </ul>
        </li>

        <li><a href="/cha">订单查询</a></li>
		<?php
			if(@$_SESSION['user']!=null){
				echo '<li><a class="h5" href="/user">商户中心</a></li>';
			}else{
				echo '<li><a class="h5" href="/reg">注册</a></li><li><a class="h5" href="/login">登录</a></li>';
			}
		?>
      </ul>
    </div>
  </div>
</div>

<div class="first-contet base">
  <div class="col-xs-12 col-sm-8 col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
    <div class="first-contet-left col-md-6 col-sm-8 col-xs-10">
      <div class="channelPanel 3dRotateEle" id="channelPanel">

        <div class="wapPay">
          <p></p>
          <span>网页支付</span>
        </div>

        <div class="mbWapPay">
          <p></p>
          <span>手机网页支付</span>
        </div>

        <div class="posPay">
          <p></p>
          <span>智能POS支付</span>
        </div>


        <div class="cNitiative">
          <p></p>
          <span>用户扫码支付</span>
        </div>
        <div class="more">
          <p></p>
          <span>即将上线更多产品</span>
        </div>
        <div class="bPassivity">
          <p></p>
          <span>商户扫码</span>
        </div>

        <div class="mbApp">
          <p></p>
          <span>手机APP支付</span>
        </div>
        <div class="wx">
          <p></p>
          <span>公众号支付</span>
        </div>
        <div class="cardPay" >
          <p></p>
          <span>卡牌支付</span>
        </div>

      </div>
    </div>

    <div class="first-contet-right col-lg-4 col-lg-offset-2 col-md-4 col-md-offset-2">
      <div class="first-contet-right-inner">
        <span id="gridShowTitle" class="first-contet-title h0">你需要的支付<br>都在这里<br></span>
        <!-- 3dRotateEle-inner -->
        <p id="gridShowContent" class="first-contet-p h5">
          全渠道支付方式、高效对接、
          简洁而强大的交易账务管理，专业为你服务。
          <!-- <p class="first-contet-line">
        </p> -->
      </p>
      <div class="first-contet-btn-div">
        <p class="first-contet-btn  point-btn-back">
          <a href="/demo" class="myButton-black point-btn mobile-btn-blc" title="体验支付DEMO">体验支付DEMO</a>
          <!-- FAB button with ripple -->
        </p>
      </div>
    </div>
  </div>
</div>
</div>

<div class="first-footer base col-lg-12 row">
  <div class="first-footer-content col-md-12 col-lg-8  col-lg-offset-2 col-xs-12">
    <div class="speedDiv" id="speedDiv">

      <div class="first-footer-img">
        <span class="first-footerImgBigBack ">
          <span class="first-footerImgBack">
            <span class="speedImg"></span>
          </span>
        </span>
      </div>

      <div class="inlineBlock">
        <span class="first-footer-title">快速<br></span>
        <span class="first-footer-text">
          10分钟超快速响应<br>
          1V1专业客服服务<br>
          7*24小时技术支持
        </span>
      </div>

    </div>
    <div class="stabilityDiv" id="stabilityDiv">
      <div class="first-footer-img">
        <span class="first-footerImgBigBack">
          <span class="first-footerImgBack">
            <span class="stabilityImg"></span>
          </span>
        </span>
      </div>
      <div class="inlineBlock">
        <span class="first-footer-title">稳定<br></span>
        <span class="first-footer-text">多机房异地容灾系统<br>
          服务器可用性99.9%<br>
          专业运维团队值守
        </span>
      </div>
    </div>
    <div class="" id="saveDiv">
      <div class="first-footer-img">
        <span class="first-footerImgBigBack">
          <span class="first-footerImgBack">
            <span class="saveImg"></span>
          </span>
        </span>
      </div>
      <div class="inlineBlock">
        <span class="first-footer-title">安全<br></span>
        <span class="first-footer-text"><a  href="#"  title="点击查看PCI">PCI DSS 权威认证</a><br>
          <span>严密而专业的风险控制<br></span>
          <span>不明交易实时监控</span>
        </span>
      </div>
    </div>
  </div>
</div>


<div class="second base col-md-12 row">
  <div class="second-content  col-md-12 col-lg-8  col-lg-offset-2  col-xs-12">
    <div class="second-content-header">
      <span class="h1">依托于强大的支付体系，我们做了更多的事</span>
    </div>
    <div class="second-content-content">
      <div class="second-block" id="second-block_1"  title="点击查看">
        <div class="second-block-img_1" id="second-block-img_1">

        </div>
        <span class="h20">银行合作</span>
        <span class="blue-line-med"></span>
        <p class="second-content-p h6">
          为城商行伙伴推出的聚合支付标准化输出服务统一收款渠道、统一账单管理、统一手续费，降低接入成本。
        </p>
        <!-- <a class="second-block-a_1" id="second-block-a_1" href="javascript:void(0)" >查看详情>></a> -->
      </div>

      <div class="second-block" id="second-block_2"  title="点击查看">
        <div class="second-block-img_2" id="second-block-img_2">

        </div>
        <span class="h20">二类账户</span>

        <span class="green-line-med"></span>
        <p class="second-content-p h6">
          代付、分账、托管基于数百家银行的深度合作<br>
          为银行与商户间搭建更多支付场景的桥梁。
        </p>
        <!-- <a class="second-block-a_2" id="second-block-a_2" href="javascript:void(0)" >查看详情>></a> -->
      </div>

      <div class="second-block"  id="second-block_3"  title="点击查看">
        <div class="second-block-img_3" id="second-block-img_3">
        </div>
        <span class="h20">跨境合作</span>
        <span class="red-line-med"></span>
        <p class="second-content-p h6">三大支付方式的跨境业务，在这里聚合为一。
        </p>
        <!-- <a class="second-block-a_3" id="second-block-a_3" href="javascript:void(0)">查看详情>></a> -->
      </div>
    </div>
  </div>
</div>


<div class="third base col-md-12 col-md-12  col-xs-12 ">
  <span class="thirdTitle h1">融付通和他的朋友们</span>
  <div class="backLogos">
    <div class=""></div>
    <div class=""></div>
    <div class=""></div>
    <div class=""></div>
    <div class=""></div>
    <div class=""></div>
  </div>
  <div class="swiper-container mch-swiper">
    <div class="swiper-wrapper melissa">
      <div class="swiper-slide mch-slide mch-slide5">
        <div class="">
          <span class="glass-symbol">”</span>
          <span  class="mchGlass-logo"></span>
          <p class="glass-title">
            <span class="h-glass">37游戏<br></span>
            <span class="h6">解决方案：微信H5支付<br></span>
          </p>
          <p class="ass">
            与融付通合作微信长达2年，能一直保持微信支付通道的支付稳定，支付成功率值得肯定，服务没得说。<br>
          </p>
        </div>
      </div>
      <div class="swiper-slide mch-slide mch-slide2">
        <div class="">
          <span class="glass-symbol">”</span>
          <span  class="mchGlass-logo"></span>
          <p class="glass-title">
            <span class="h-glass">魅族<br></span>
            <span class="h6">解决方案：微信APP<br></span>
          </p>
          <p class="ass">
            魅族钱包是魅族金融业务的核心，融付通为魅族钱包提供了完善高效的支付解决方案，而因为优质服务而建立起的彼此信任，成为双方长期合作的坚固基石，相信魅族与融付通未来会有更广泛更深入的合作。<br>
          </p>
        </div>
      </div>
      <div class="swiper-slide mch-slide mch-slide3">
        <div class="">
          <span class="glass-symbol">”</span>
          <span  class="mchGlass-logo"></span>
          <p class="glass-title">
            <span class="h-glass">OPPO<br></span>
            <span class="h6">解决方案：微信H5支付<br></span>
          </p>
          <p class="ass">
            使用融付通的微信插件3年以来，融付通为我们提供了最专业的支付服务，通道稳定，服务到位，处理问题响应快速，合作很愉快。<br>
          </p>
        </div>
      </div>
      <div class="swiper-slide mch-slide mch-slide4">
        <div class="">
          <span class="glass-symbol">”</span>
          <span  class="mchGlass-logo"></span>
          <p class="glass-title">
            <span class="h-glass">唱吧<br></span>
            <span class="h6">解决方案：微信公众号内支付<br></span>
          </p>
          <p class="ass">
            唱吧与融付通合作了2年，可以说是相互见证了对方的成长。融付通为我们提供了完善、全面的支付解决方案，支付成功率高，产品覆盖面广，有完整、专业的技术和运营团队，为我们保驾护航。<br>
          </p>
        </div>
      </div>


    </div>
  </div>

  <!-- 分页器 -->
  <div class="third-menue col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-xs-12">
    <div id ="pagination1">
      <!--<span class="swiper-pagination-bullet"></span>-->
      <span class="swiper-pagination-bullet"></span>
      <span class="swiper-pagination-bullet"></span>
      <span class="swiper-pagination-bullet"></span>
      <span class="swiper-pagination-bullet"></span>
    </div>
    <div class="mchMoreDiv">
      <span class="mchMore  page1Btn" title="查看更多">查看更多</span>
    </div>
  </div>
</div>



<div class="third-handle-mch-back">
  <span class="thirdTitle h1">融付通和他的朋友们</span>
  <div class="swiper-container-handle-mch third-handle-mch">
    <div class="swiper-wrapper">

      <!--<div class="swiper-slide">-->
        <!--<span  class="handle-mch-img1"></span>-->
        <!--<p class="glass-title">-->
          <!--<span class="h-glass">小蓝单车<br></span>-->
          <!--<span class="h6">解决方案：Apple Pay<br></span>-->
        <!--</p>-->
        <!--<span class="glass-content h6">现在支付拥有非常专业的团队和稳定优质的产品，他们的服务非常靠谱，这是一次非常愉快的合作。<br></span>-->
        <!--<div class="mchGlass-btnDiv">-->
          <!--&lt;!&ndash; <a href="#" class="myButton-white handle-mch-glass-btn" id="glass-btn"-->
          <!--data-toggle="modal" data-target="#myModal">查看详情</a> &ndash;&gt;-->
          <!--<span class="glass-symbol-mob">”</span>-->
        <!--</div>-->
      <!--</div>-->

      <div class="swiper-slide">
        <span  class="handle-mch-img2"></span>
        <p class="glass-title">
          <span class="h-glass">魅族<br></span>
          <span class="h6">解决方案：微信APP<br></span>
        </p>
        <span class="glass-content h6">而因为优质服务而建立起的彼此信任，成为双方长期合作的坚固基石，相信魅族与融付通未来会有更广泛更深入的合作。<br></span>

        <div class="mchGlass-btnDiv">
          <!-- <a href="#" class="myButton-white handle-mch-glass-btn" id="glass-btn"
          data-toggle="modal" data-target="#myModal">查看详情</a> -->
          <span class="glass-symbol-mob">”</span>
        </div>
      </div>

      <div class="swiper-slide">
        <span  class="handle-mch-img3"></span>
        <p class="glass-title">
          <span class="h-glass">OPPO<br></span>
          <span class="h6">解决方案：微信H5支付<br></span>
        </p>
        <span class="glass-content h6">使用微信插件3年以来，通道稳定，服务到位，处理问题响应快速，合作很愉快。<br></span>

        <div class="mchGlass-btnDiv">
          <!-- <a href="#" class="myButton-white handle-mch-glass-btn " id="glass-btn"
          data-toggle="modal" data-target="#myModal">查看详情</a> -->
          <span class="glass-symbol-mob">”</span>
        </div>
      </div>
      <div class="swiper-slide">
        <span  class="handle-mch-img4"></span>
        <p class="glass-title">
          <span class="h-glass">唱吧<br></span>
          <span class="h6">解决方案：微信公众号内支付唱吧<br></span>
        </p>
        <span class="glass-content h6">融付通为我们提供了完善、全面的支付解决方案，支付成功率高，产品覆盖面广，有完整、专业的技术和运营团队，为我们保驾护航。<br></span>

        <div class="mchGlass-btnDiv">
          <!-- <a href="#" class="myButton-white handle-mch-glass-btn " id="glass-btn"
          data-toggle="modal" data-target="#myModal">查看详情</a> -->
          <span class="glass-symbol-mob">”</span>
        </div>
      </div>
      <div class="swiper-slide">
        <span  class="handle-mch-img5"></span>
        <p class="glass-title">
          <span class="h-glass">37游戏<br></span>
          <span class="h6">解决方案：微信H5支付<br></span>
        </p>
        <span class="glass-content h6">与融付通合作微信长达2年，能一直保持微信支付通道的支付稳定，支付成功率值得肯定，服务没得说。<br></span>

        <div class="mchGlass-btnDiv">
          <!-- <a href="#" class="myButton-white handle-mch-glass-btn " id="glass-btn"
          data-toggle="modal" data-target="#myModal">查看详情</a> -->
          <span class="glass-symbol-mob">”</span>
        </div>
      </div>
    </div>
    <div class="handle-menu">
      <div id="pagination3" class="swiper-pagination-help swiper-pagination-clickable  swiper-pagination-bullets">
        <!--<span class="swiper-pagination-bullet"></span>-->
        <span class="swiper-pagination-bullet"></span>
        <span class="swiper-pagination-bullet"></span>
        <span class="swiper-pagination-bullet"></span>+
        <span class="swiper-pagination-bullet"></span>
      </div>
    </div>
  </div>
</div>


<div class="forth base col-md-12">
  <div class="col-md-12 col-lg-8  col-lg-offset-2 rwo">
    <div class="forth-header col-md-12 row">
      <span class="h1">增值服务</span>
      <span class="h4">支付之外，我们还提供专业的增值服务</span>
    </div>
  </div>
  <div class="forth-content col-md-12 col-lg-8  col-lg-offset-2">

    <div class="forth-content-right"  title="点击查看">
      <div class="forth-content-right-net">
        <span class="h3">鉴权服务</span>
        <span class="black-line-med black-line-med-right"></span>
      </div>
      <p class="h6">身份认证、银行卡认证，准确而快速
        300ms快速响应，拒绝死库，用专业给你安心。</p>
        <div class="forth-appService-Div">
          <p class="wbImg"><span></span></p>
        </div>
      </div>

      <div class="forth-content-left"  title="点击查看">
        <div class="forth-content-left-fin">
          <span class="h3">短信服务</span>
          <span class="black-line-med black-line-med-left"></span>
        </div>
        <p class="h6">聚合国内众多优质通道，稳定而高效。
          3s内信息抵达，拉近你与用户的距离。</p>
          <div class="forth-appService-Div">
            <p class="jyImg"><span></span></p>
          </div>
        </div>

      </div>
    </div>

    <div class="fifth base col-md-12 row">
      <span class="thirdTitle h1">融付通-值得信赖的支付专家！</span>
      <div class="fifth-left">
        <div class="fifth-content">
          <div class="fifth-content-left">
            <p class="fifth-title-left">
              <span class="h1">体验一下吧！</span>
              <span class="h5">你可以点击下方按钮注册体验我们的服务  </span>
              <span class="h6">有任何问题，联系我们或者留下信息，我们将拜访你。</span>
              <a style="color:white" href='http://www.h537v.cn/reg/'">
              <div class="fifth-title-left-experience">
                <span>点击注册</span>
                <span class="fifth-title-left-img"></span>
              </div>
              </a>
            </p>
          </div>

          <div class="fifth-content-right">
            <p class="fifth-title-right">
              <span class="h1">我们如何联系你</span>
            </p>
            <!-- Simple Textfield -->
            <form class="" action="" method="post" id="joinUsForm">

              <input type="hidden" name="inbox" value="ipaynow@ipaynow.cn">
              <!--  -->
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="sample3" name="name">
                <label class="mdl-textfield__label" for="sample3">我们要如何称呼你</label>
              </div>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="sample3" name="companyName">
                <label class="mdl-textfield__label" for="sample3">公司名称</label>
              </div>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="sample3" name="phone">
                <label class="mdl-textfield__label" for="sample3">联系方式</label>
              </div>

              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <textarea class="mdl-textfield__input" type="text" id="sample3" name="mailContent"></textarea>
                <label class="mdl-textfield__label" for="sample3">合作方向，意见建议，备注等。</label>
              </div>

              <div class="fifth-content-right-btnDiv">
                <p class="fifth-contet-btn">
                  <a href="javascript:void(0)" id="sendJoinUsBtn" class="myButton-black  fifth-right-btn mobile-btn-blc"  title="点击发送邮件">发送</a>
                </p>
              </div>

            </form>

          </div>
        </div>
      </div>
      <span class="fifth-content-bottom-sd">
      </span>
    </div>

    <div class="sixth base col-md-12 row">
      <div class="sixth-help col-md-8 col-md-offset-2">
        <p class="sixth-help-content" >
          <div class="help-title-img"> </div>
          <span class="h1">需要帮助？<br></span>

          <div class="swiper-container-help swiper-help">
            <div class="swiper-wrapper">

              <div class="swiper-slide">
                <ul class="sixth-help-ul h5">
                  <li><span>你们的渠道是与官方合作的吗？</span></li>
                  <li><span>后台注册为什么会被驳回？</span></li>
                  <li><span>注册后台提交的五证信息为什么不能是原件，非要是复印件呢？</span></li>
                </ul>
              </div>

              <div class="swiper-slide">
                <ul class="sixth-help-ul h5">
                  <li><span>三证合一在填写时如何进行填写？</span></li>
                  <li><span>结算账户我可以填写个人卡吗？</span></li>
                  <li><span>注册是支行信息如何进行填写？</span></li>
                </ul>
              </div>
              <div class="swiper-slide">
                <ul class="sixth-help-ul h5">
                  <li><span>合同xxx位置是否可以更改？</span></li>
                  <li><span>我司法人已变更但是对公账户的法人尚未变更，能完成实名认证吗？</span></li>
                  <li><span>电子账户是以融付通名义申请还是我司资质申请呢？</span></li>
                </ul>
              </div>
            </div>
          </div>
        </p>
        <div class="sixth-contet-btn-div">
          <p class="sixth-contet-btn-back">
            <a href="help" class="sixth-help-btn myButton-black mobile-btn-blc"  title="前往帮助中心">查看更多</a>
          </p>
        </div>
        <div class="sixth-help-right">
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
              邮箱：<a href="mailto:<?php echo $web['sitemail']; ?>"  title="点击进入邮箱"><?php echo $web['sitemail']; ?></a><br>
            </span>
            <span class="footer-content-content">电话：<?php echo $web['sitephone']; ?><br></span>
          </div>

        </div>
        <div class="footer-ICP">
        <span class=" h8">Copyright © 2018&nbsp;<?php echo $web["sitecom"]; ?>&nbsp;<?php echo $web["sitebeian"]; ?></span>
      </div>
    </div>
  </div>
  <script>
	$("#jumphome").click(function(){
		window.open="http://www.yuncoo.com/";
	})
  </script>
	</body>
</html>