<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
?>
<html ng-app="moduleApp" class="ng-scope">
<head>
<style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}</style>
    <meta charset="UTF-8">
    <title>ＳＤＫ下载 - <?php echo $web["sitename"]; ?></title>
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <link rel="stylesheet" href="/static/public/components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/static/public/components/bootstrap/dist/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="/static/css/jquery.datetimepicker.css">
    <link rel="stylesheet" href="/static/css/common.min.css">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
</head>
<body ng-controller="myApp" class="ng-scope">
<div ui-view="" class="outer-content ng-scope" id="main_content" style="">
<div class="container-fluid padding-none ng-scope">
	<?php require "../head.php";?>
    <div class="container container-style container-style3 container-large-height">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="thumbnail sdk-type  sdk-type2">
                    <div class="identifying">
                        <p>Android</p>
                        <p>文档+SDK</p>
                    </div>
                    <div class="caption">
                        <p><a href="#">暂不提供</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="thumbnail sdk-type sdk-type1">
                    <div class="identifying">
                        <p>IOS</p>
                        <p>文档+SDK</p>
                    </div>
                    <div class="caption">
                        <p><a href="#">暂不提供</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="thumbnail sdk-type sdk-type3">
                    <div class="identifying">
                        <p>服务器端</p>
                        <p>文档+SDK</p>
                    </div>
                    <div class="caption">
                        <p><a href="Php.rar">服务端SDK下载</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require "../foot.php"; ?>
</div>
</div>
	<script src="/static/public/components/jquery/dist/jquery.min.js"></script>
    <script src="/static/public/components/jquery/dist/jquery.jqprint-0.3.js"></script>
    <script src="/static/public/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/static/public/components/bootstrap/dist/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript">
        var browser=navigator.appName

        var b_version=navigator.appVersion

        var version=b_version.split(";");

        var trim_Version=version[1].replace(/[ ]/g,"");

        if(browser=="Microsoft Internet Explorer" && (trim_Version=="MSIE7.0"||trim_Version=="MSIE6.0"||trim_Version=="MSIE8.0"))
        {
            alert("浏览器版本过低,建议升级到IE8以上版本浏览器")
        }
    </script>

