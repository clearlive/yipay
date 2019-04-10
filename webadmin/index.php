<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["admin"])){
		header("location:login.php");
		exit;
	}
	if(!empty($_GET['action'])){
		if($_GET["action"] == "out"){
			if(isset($_SESSION['admin'])){
				unset($_SESSION['admin']);
				header("location:/");
				exit;
			}else{	
				header("location:/");
				exit;
		}
		}
	}
	$jrsj=date("Y-m-d",time());//今日时间如：2018-01-21
	$jrje=queryall(co_dingdan,"where ddzt='success' and ddsj like '%$jrsj%'","sum(ddje) as jrje");//今日成功金额
	if($jrje["jrje"] ==""){
		$jrje["jrje"]="0.00";
	}
	$jezs=queryall(co_dingdan,"","sum(ddje) as jrje");//金额总数
	if($jezs["jrje"] ==""){
		$jezs["jrje"]="0.00";
	}	
	$jrdd=querydb(co_dingdan,"where ddsj like '%$jrsj%'");//今日订单总数
	if($jrdd==""){
		$jrdd="0";
	}
	$ddzs=querydb(co_dingdan);//平台订单总数
	if($jrdd==""){
		$jrdd="0";
	}
	$jrcgdd=querydb(co_dingdan,"where ddzt='success' and ddsj like '%$jrsj%'");//今日成功订单
	if($jrcgdd==""){
		$jrcgdd="0";
	}
	$yjsje=queryall(co_jiesuan,"where and jszt='yes'","sum(jsje) as yjsje");//提现成功金额
	if($yjsje["yjsje"] ==""){
		$yjsje["yjsje"]="0.00";
	}
	
	/****************************/
	
	$cgztdd=querydb(co_dingdan,"where ddzt='success'");//成功状态订单
	if($cgztdd==""){
		$cgztdd="0";
	}else{
		$cgztdd=round($cgztdd/$ddzs*100,2);
	}
	$ddztdd=querydb(co_dingdan,"where ddzt='wait'");//等待状态订单
	if($ddztdd==""){
		$ddztdd="0";
	}else{
		$ddztdd=round($ddztdd/$ddzs*100,2);
	}
	$sbztdd=querydb(co_dingdan,"where ddzt='fail'");//失败状态订单
	if($sbztdd==""){
		$sbztdd="0";
	}else{
		$sbztdd=round($sbztdd/$ddzs*100,2);
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>系统后台 - <?php echo $web["sitename"]; ?></title>
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="/favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="/favicon.ico">
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 系统管理首页 <small></small></div>
                        <p class="page-header-description">欢迎使用聚合支付系统</p>
                    </div>
                    <div class="am-u-lg-3 tpl-index-settings-button">
                        <button onclick="javascript:window.location.reload();" type="button" class="page-header-button"><i class="am-icon-refresh am-icon-spin"></i> 刷新数据</button>
                    </div>
                </div>

            </div>

            <div class="row-content am-cf">
                <div class="row  am-cf">
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="widget widget-primary am-cf">
                            <div class="widget-statistic-header">
                                平台订单总数
                            </div>
                            <div class="widget-statistic-body">
                                <div class="widget-statistic-value">
                                    <i class="am-icon-bookmark"></i> 共 <?php echo $ddzs; ?> 份订单
                                </div>
                                <span class="widget-statistic-icon am-icon-credit-card-alt"></span>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="widget widget-primary am-cf" style="background-color:#6cd06c;border:0px">
                            <div class="widget-statistic-header">
							<br>
                            </div>
                            <div class="widget-statistic-body">
                                <div class="widget-statistic-value">
								<center>订单数据统计</center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="widget widget-purple am-cf">
                            <div class="widget-statistic-header">
                                平台订单总额
                            </div>
                            <div class="widget-statistic-body">
                                <div class="widget-statistic-value">
                                    <i class="am-icon-money"></i> ￥ <?php echo $jezs["jrje"]; ?> 元
                                </div>
                                <span class="widget-statistic-icon am-icon-support"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row  am-cf">
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="widget widget-primary am-cf">
                            <div class="widget-statistic-header">
                                今日订单总数
                            </div>
                            <div class="widget-statistic-body">
                                <div class="widget-statistic-value">
                                     <?php echo $jrdd; ?> 份
                                </div>
                                <span class="widget-statistic-icon am-icon-check-circle"></span>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="widget widget-primary am-cf">
                            <div class="widget-statistic-header">
                                今日成功订单
                            </div>
                            <div class="widget-statistic-body">
                                <div class="widget-statistic-value">
                                     <?php echo $jrcgdd; ?> 份
                                </div>
                                <span class="widget-statistic-icon am-icon-check-circle"></span>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="widget widget-purple am-cf">
                            <div class="widget-statistic-header">
                                今日成功金额
                            </div>
                            <div class="widget-statistic-body">
                                <div class="widget-statistic-value">
                                     <?php echo $jrje["jrje"]; ?> 元
                                </div>
                                <span class="widget-statistic-icon am-icon-check-circle"></span>
                            </div>
                        </div>
                    </div>
                </div>

				
                <div class="row am-cf">

                    <div class="am-u-sm-12 am-u-md-4">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">订单支付比例分析</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body widget-body-md am-fr">

                                <div class="am-progress-title">支付成功<span class="am-fr am-progress-title-more"><?php echo $cgztdd; ?>%</span></div>
                                <div class="am-progress">
                                    <div class="am-progress-bar" style="width: <?php echo $cgztdd; ?>%"></div>
                                </div>
                                <div class="am-progress-title">支付等待<span class="am-fr am-progress-title-more"><?php echo $ddztdd; ?>%</span></div>
                                <div class="am-progress">
                                    <div class="am-progress-bar  am-progress-bar-warning" style="width: <?php echo $ddztdd; ?>%"></div>
                                </div>
                                <div class="am-progress-title">支付失败<span class="am-fr am-progress-title-more"><?php echo $sbztdd; ?>%</span></div>
                                <div class="am-progress">
                                    <div class="am-progress-bar am-progress-bar-danger" style="width: <?php echo $sbztdd; ?>%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="am-u-sm-12 am-u-md-8">
                        <div class="tpl-user-card am-text-center widget-body-lg" style="min-height:258px">
                            <div class="tpl-user-card-title">
                                尊敬的超级管理员
                            </div>
                            <div class="achievement-subheading">
                                欢迎使用聚合支付系统
                            </div>
                            <div class="achievement-description">
                                <b>官方网址：</b><strong>WWW.123.COM</strong>
                                <b>技术支持：</b><strong>123456</strong>
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
	$('#jhindex').addClass('active');

})
</script>

</body>

</html>