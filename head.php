<?php
	if(!$weblock){//防止访问单文件
		header("location:../");
		exit;
	}
?>
	<!-- uiView: developerTopMenu -->
	<div ui-view="developerTopMenu" class="ng-scope">
	<link rel="stylesheet" href="/static/css/develop/doc.css" class="ng-scope">
	<div class="header clearfix navbar-product-white navbar_box_wrap ng-scope" ng-class="{'navbar-product-def': isProductDef, 'navbar-product-dark': isProductDark,'header-large':isMenuHeight}">
    <div class="header-logoDiv container">
        <div class="logo-div">
            <a onclick="jump(this)" href="javascript:void(0)" data="/">
                <div class="header-homeImg">
                </div>
                <div class="header-logoImg">
                </div>
            </a>
            <div class="header-logoIcon">
            </div>
            <span class="header-location ng-binding">专业支付服务商</span>
        </div>
        <div class="son-header-menu header-menu-links">
            <div class="menu-product">
                <span class="h5">
                    产品
                     <div class="triangle"></div>
                </span>
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
                <span class="h5">
                    开发者中心
                    <div class="triangle"></div>
                </span>
                <p class="header-menu-borderP">
                </p>
                <div class="menu-exploit-content menu-hidd">

                    <div class="menu-exploit-list menu-list">
                        <dl class="develop-center-menu">
                            <dt><a href="/doc">API文档</a></dt>
                            <dt><a href="/sdkDownload">SDK下载</a></dt>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="menu-help">
                <span class="h5"><a onclick="jump(this)" href="javascript:void(0)" data="/cha">订单查询</a></span>
                <p class="header-menu-borderP">
                </p>
            </div>
			<?php
				if(@$_SESSION['user']!=null){
					echo '            <div class="menu-login-btn menu-login-btn-first">
                 <span class="h5"><a href="/user">商户中心</a></span>
                <p class="header-menu-borderP header-menu-borderP-register">
                </p>
            </div>';
				}else{
					echo '            <div class="menu-login-btn menu-login-btn-first">
                 <span class="h5"><a href="/reg">注册</a></span>
                <p class="header-menu-borderP header-menu-borderP-register">
                </p>
            </div>
            <div class="menu-login-btn margin-left-none">
                <span class="h5"><a href="/login">登录</a></span>
                <p class="header-menu-borderP header-menu-borderP-login">
                </p>
            </div>
';
				}
			?>
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
                            <!--<li><a href="#">卡+服务</a></li>-->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            开发者中心 <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/doc">API文档</a></li>
                            <li><a href="/sdkDownload">SDK下载</a></li>
                            <!--<li><a ui-sref="demoExperience">Demo体验</a></li>-->
                        </ul>
                    </li>
                    <li><a onclick="jump(this)" href="javascript:void(0)" data="/cha">订单查询</a></li>
			<?php
				if(@$_SESSION['user']!=null){
					echo '<li><a href="/user">商户中心</a></li>';
				}else{
					echo '<li><a href="/reg">注册</a></li><li><a ui-sref="login" href="/login">登录</a></li>';
				}
			?>
					
                </ul>
            </div>
        </div>
    </div>
    <div class="coop-menu col-lg-8 col-lg-offset-2 col-sm-12 col-xs-12 ng-hide">
        <a class="subMenu-link" href="#">在线支付</a>
        <a class="subMenu-link" href="#">APP支付</a>
    </div>
</div>
        <script class="ng-scope">
            function jump(e){
                window.location.href= $(e).attr('data');
            }
        </script>
	</div>