<?php
	if(!$weblock){//防止访问单文件
		header("location:../");
		exit;
	}
?>
    <div class="footer-wrap">
        <!-- uiView: frontFooter -->
	<div ui-view="frontFooter" class="ng-scope"><div class="footer ng-scope">
    <div class="container">
        <div class="footer-content clearfix">
            <div>
                <span class="footer-content-title">关于我们<br></span>
                <span class="footer-content-content"><a onclick="jump(this)" href="javascript:void(0)" data="#">团队介绍</a><br></span>
                <span class="footer-content-content"><a onclick="jump(this)" href="javascript:void(0)" data="#">新闻动态</a><br></span>
            </div>
            <div>
                <p>
                    <span class="footer-content-title">产品<br></span>
                    <span class="footer-content-content"><a href="#">在线支付</a><br></span>
                    <span class="footer-content-content"><a href="#">APP支付</a><br></span>
                </p>
                <p>
                    <span class="footer-content-content"><a href="#">二次开发</a><br></span>
                    <span class="footer-content-content"><a href="#">商户对接</a><br></span>
                </p>


            </div>
            <div>
                <span class="footer-content-title">开发者中心<br></span>
                <span class="footer-content-content"><a href="/doc">API文档</a><br></span>
                <span class="footer-content-content"><a href="/sdkDownload">SDK下载</a><br></span>

            </div>
            <div>
                <span class="footer-content-title">帮助<br></span>
                <span class="footer-content-content"><a onclick="jump(this)" href="javascript:void(0)" data="/help">常见问题</a><br></span>
                <span class="footer-content-content"><a onclick="jump(this)" href="javascript:void(0)" data="/doc">技术问题</a><br></span>
            </div>
            <div>
                <span class="footer-content-title">咨询方式<br></span>
                <span class="footer-content-content">邮箱：<a href="mailto:<?php echo $web["sitemail"]; ?>"><?php echo $web["sitemail"]; ?></a><br></span>
                <span class="footer-content-content">电话：<?php echo $web["sitephone"]; ?><br></span>
            </div>
        </div>
        <div class="footer-ICP">
        <span class=" h6">Copyright © 2018&nbsp;<?php echo $web["sitecom"]; ?>&nbsp;<?php echo $web["sitebeian"]; ?></span>
        </div>

    </div>
</div>
<style type="text/css" class="ng-scope">
    .footer-content{
        display: block;
        margin:0px auto;
    }
    .footer-content>div{
        float: left;
        margin-left: 4%;
        margin-right: 3.6%;
    }
    .footer-content>div:last-of-type{
        margin-right: 0%;
    }
    .footer-content>div:first-of-type{
        margin-left: 5%;
    }
</style>
</div>
