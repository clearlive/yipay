<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["agent"])){
		header("location:login.php");
		exit;
	}
	$agentuser=$_SESSION["agent"];	
	/****************************/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>推广链接 - <?php echo $web["sitename"]; ?></title>
    <meta name="description" content="聚合支付V2.0">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="/favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="聚合支付V2.0" />
    <script src="assets/js/echarts.min.js"></script>
    <link rel="stylesheet" href="assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="assets/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" href="assets/css/app.css">
    <script src="assets/js/jquery.min.js"></script>

</head>

<body data-type="index">
    <script src="assets/js/theme.js"></script>
    <div class="am-g tpl-g">
	<?php require_once "header.php"; ?>
        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">

            <div class="container-fluid am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 推广链接 <small>v 2.0</small></div>
                    </div>
                </div>

            </div>

            <div class="row-content am-cf">
                <div class="row  am-cf">
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-8">
						<div class="am-alert am-alert-secondary" data-am-alert>
							<button type="button" class="am-close">&times;</button>
							<p>温馨提示：通过此链接注册成功的商户自动划分为你的下级商户！</p>
						</div>
                        <div class="widget widget-purple am-cf" style="background-color:rgba(0, 0, 0, 0.14);border:0px;">
                            <div class="widget-statistic-header">
                                我的推广链接
                            </div>
                            <div class="widget-statistic-body">
                                <div class="widget-statistic-value">
                                     <a href='http://<?php echo $_SERVER['HTTP_HOST']; ?>/reg/?tgdl=<?php echo $agentuser; ?>' target="_blank"><u style="font-size:28px;">http://<?php echo $_SERVER['HTTP_HOST']; ?>/reg/?tgdl=<?php echo $agentuser; ?></u></a>
                                </div>
                                <span class="widget-statistic-icon am-icon-link" style="color:#1f2224;"></span>
                            </div>
                        </div>
                    </div>
                </div>

			</div>
        </div>
    </div>
    </div>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
<script type="text/javascript">
$(function(){
	$('#jhtglj').addClass('active');

})
</script>

</body>

</html>