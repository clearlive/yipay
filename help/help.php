<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>常见问题 - <?php echo $web["sitename"]; ?></title>
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
        <span class="header-location">常见问题</span>
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

</div>

<div class="helpPay-content col-lg-8 col-lg-offset-2">
  <div class="helpContent">
    <div class="pay-left">
      <dl class="pay-matter-list">
        <dt>常见问题</dt>
        <dt><a class="matterA" href="#paymentHref">聚合</a></dt>
        <dt><a class="matterA" href="#productHref">产品</a></dt>
        <dt><a class="matterA" href="#flowHref">流程</a></dt>
      </dl>
    </div>
    <div class="pay-right">
      <div class="helpPay-right-inner">

        <div class="qu-payment">
          <p class="pay-right-title title-first  btn btn-link"
          role="button" data-toggle="collapse" href="#collapseExample"
          aria-expanded="false" aria-controls="collapseExample"> <a href="#" name="paymentHref"></a><span>·</span>聚合后台为什么总是需要重新登录？<span></span></p>
          <div class="collapse  pay-right-content" id="collapseExample">
            <div class="well">
              我们的系统为保障商户信息的安全性，一段时间未操作会默认为放弃操作需要重新登录，这是防止商户信息被他人盗用的措施。
            </div>
          </div>
        </div>
        <div class="qu-payment">
          <p class="pay-right-title btn btn-link" role="button" data-toggle="collapse" href="#collapseExample2"
            aria-expanded="false" aria-controls="collapseExample"><span>·</span>后台注册为什么会被驳回？<span></span>
          </p>
        <div class="collapse  pay-right-content" id="collapseExample2">
          <div class="well">
            常见驳回原因有：<br>
            1.结算账户不能有空格。<br>
            2.五证要上传复印件盖公司红章的扫描件，如果原件会被驳回。<br>
            3.复印件不清晰，（如身份证，必须证件上的所有字都能显示出来，包括“姓名”、“民族”等模版的字体也要显示）<br>
            4.微信进件需要文网文。行业如下：游戏、小说、直播。
          </div>
        </div>
      </div>
      <div class="qu-payment">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample3"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>注册后台提交的五证信息为什么不能是原件，非要是复印件呢？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample3">
          <div class="well">
            原件容易被盗用，复印件盖公章（也可以写上仅现在支付使用）会更安全。
          </div>
        </div>
      </div>

      <div class="qu-payment">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample4"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>注册聚合后台时上传原件可以吗？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample4">

          <div class="well">
            企业注册需要提供企业五证的复印件加盖公章拍照上传（营业执照、组织机构代码、税务登记证、开户许可证、法人身份证）。
          </div>
        </div>
      </div>
      <div class="qu-payment">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample5"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>三证合一在填写时如何进行填写？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample5">
          <div class="well">
            如果是新版“三证合一”，请提供营业执照、开户许可证、法人身份证复印件加盖公章。组织机构代码、税务登记证重复上传“营业执照”即可。
            “三证合一”三证编号统一填写“统一社会信用代码”。
          </div>
        </div>
      </div>
      <div class="qu-payment">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample6"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>结算账户我可以填写个人卡吗？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample6">

          <div class="well">
            结算账户必须填写对公户，选择“基本户”则不用上传“开户回执单”，如果结算选择“一般户”，则需上传“开户回执单”或“印鉴卡”。
          </div>
        </div>
      </div>
      <div class="qu-payment">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample7"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>注册是支行信息如何进行填写？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample7">

          <div class="well">
            结算账户的填写，需要选择下拉菜单中的开户行及支行全称，不可手填，否则无法成功提交。
          </div>
        </div>
      </div>
      <div class="qu-payment">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample8"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>商户推荐码是什么？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample8">

          <div class="well">
            商户推荐码请填写：（对应商务经理工号，是为了方便风控进行统计）
          </div>
        </div>
      </div>
      <div class="qu-payment">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample9"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>合同xxx位置是否可以更改？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample9">
          <div class="well">
            我们的主协议是不能有任何更改的，这个是我司的一个严格要求，也是为了保障双方的权益，如果贵司法务对合同的细节有疑问可以标记给我，我会单独和我司法务沟通，如果有补充项可以尝试看看能否在补签协议中给添加上。
          </div>
        </div>
      </div>




      <div class="qu-product"> <a href="#" name="productHref"></a>
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample10"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>我们是大量级游戏（APP）公司你们能给多少费率呢？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample10">

          <div class="well">
            我们和游戏类商户的合作首先必须是有文网文，其次我们这边的费率报价是阶梯报价，我们会给您一个初始费率，然后根据您的交易量再给您做实时调整。同时我们公司是坚决不做有提现和兑换的游戏的，所以需要先看一下咱们的产品。
          </div>
        </div>
      </div>
      <div class="qu-product">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample11"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>我司法人已变更但是对公账户的法人尚未变更，能完成实名认证吗？
        <span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample11">

          <div class="well">
            为了不耽误您的进程我们可以走特批，需要您提供咱们去变更对公账户法人的银行证明就可以，后期变成完成以后重新补交一下资料就可以。这样可以提高我们的工作效率。
          </div>
        </div>
      </div>
      <div class="qu-product">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample12"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>贵司微信H5和市面上微信WAP有什么区别呢？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample12">

          <div class="well">
            我司H5是WAP的升级版，跳转速度快，支付成功率高。
          </div>
        </div>
      </div>
      <div class="qu-product">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample13"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>电子账户是以现在支付名义申请还是我司资质申请呢？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample13">

          <div class="well">
            以贵司名义资质去申请电子账户。
          </div>
        </div>
      </div>
      <div class="qu-product">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample14"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>电子账户是在哪银行名下开通的？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample14">

          <div class="well">
            民生银行。
          </div>
        </div>
      </div>
      <div class="qu-product">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample16"
        aria-expanded="false" aria-controls="collapseExample"> <span>·</span>你们的渠道是与官方合作的吗？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample16">

          <div class="well">
            我们就是直接与官方合作的渠道，结算款都是渠道通过银行给您结算，我们是不能触碰资金的，另外我们都是一户一入的模式，直连微信，调起速度不会有任何影响。
          </div>
        </div>
      </div>
      <div class="qu-product">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample17"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>其他家都可以T0或T1结算，你们为什么还是10日结算？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample17">

          <div class="well">
            我们的结算周期是比较灵活的，10日，5日，T2，T1都有，现在咱们的产品性质在官方申请应该是7日结算，刚开始合作，双方磨合一下，我们公司规定刚入网商户只能给到10日结算，后期合作下来，您的交易量稳步提升，同时对我们服务满意，我会主动和领导给您申请短期结算。
          </div>
        </div>
      </div>
      <div class="qu-product">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample18"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>微信H5的费率为什么这么高？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample18">
          <div class="well">
            我们是官方一手通道，效率稳定，现在走的是阶梯报价<br>
            微信H5一般都是刚接入2%<br>
            月交易200w可以1.8%<br>
            月交易500w可以1.6%<br>
            月交易800w可以1.4%<br>
            月交易1000w可以1.2%<br>
            达到额度切稳定就回降的。
          </div>
        </div>
      </div>
      <div class="qu-product">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample19"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>你们公司没有支付牌照？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample19">
          <div class="well">
            我们公司的清结算都是由银行来做的，所以不需要。
          </div>
        </div>
      </div>
      <div class="qu-product">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample20"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>鉴权为什么没有卡bin？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample20">

          <div class="well">
            首先现在银行很少给我们卡bin，其次我们有表格版的卡bin库，因为这个业务客户需求少，所以半年更新一次。
          </div>
        </div>
      </div>
      <div class="qu-product">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample21"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>你们能否对私结算？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample21">

          <div class="well">
            我们是直连微信官方的，由官方直接进行结算到您的对公户，目前暂不支持对私结算的，也是对您的资金安全的一种保证。
          </div>
        </div>
      </div>
      <div class="qu-product">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample22"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>d+0结算你们可否支持？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample22">

          <div class="well">
            我们的结算周期一般是T+1 ,官方结算周期T+7,相比于官方缩短很多时间，d+0结算都是我们的一些代理，如果您有d+0的需要，需要额外承担万五的保理垫资费用。
          </div>
        </div>
      </div>
      <div class="qu-product">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample23"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>你们微信App和H5的支付支持返回？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample23">

          <div class="well">
            安卓端支持微信和支付宝返回，苹果端由于手机本身系统的原因都暂不支持。
          </div>
        </div>
      </div>


      <div class="qu-flow"><a href="#" name="flowHref"></a>
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample24"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>请问咱们公司的申请流程是什么样的呢？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample24">

          <div class="well">
            您好 首先需要您在我公司的后台进行注册，通过审核后进行协议流程，之后会帮您进行通道的审核，审核通过后进行技术对接，对接完成咱们就可以调额上线了。
          </div>
        </div>
      </div>
      <div class="qu-flow">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample25"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>接入微信需要多长时间？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample25">

          <div class="well">
            现在微信审核需要微信官方的风控来操作，提交后大约15个工作日会返回结果，这个时间不用催促您的商户经理，因为官方风控不对外，所有进件都是接口上传，接触不到风控内部审核人员。
          </div>
        </div>
      </div>
      <div class="qu-flow">
        <p class="pay-right-title btn btn-link"
        role="button" data-toggle="collapse" href="#collapseExample26"
        aria-expanded="false" aria-controls="collapseExample"><span>·</span>请问您这边的审核周期需要多久？<span></span></p>
        <div class="collapse  pay-right-content" id="collapseExample26">

          <div class="well">
            微信方面，需要两周做为审核周期，支付宝1-3天左右。
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
            <!-- <span class="footer-content-content"><a href="#">帮助问答</a><br></span> -->
            <span class="footer-content-content"><a  href="/doc">API文档</a><br></span>
            <span class="footer-content-content"><a  href="/sdkDownload">SDK下载</a><br></span>
            <!-- <span class="footer-content-content"><a  href="https://mch.ipaynow.cn/demoExperience">Demo体验</a><br></span> -->
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
          <!-- <div class="englishChanger">
        </div> -->
        <!-- <img class="englishChangerImg" src="" alt="change to english">
        <span class="h6">English<br></span> -->
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

// $(window).on('beforeunload', function(){
//   $('html,body').animate({scrollTop:'0'},0,'swing');
// });

function helpComm(){
  $('.matterA').click(function() {
    // $(".matterA").css({'color':'#000'});
    // $(this).css({ 'color':'#EF5660'});
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
