<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["agent"])){
		header("location:login.php");
		exit;
	}
	$agentuser=$_SESSION["agent"];
	$agent=queryall(co_agent_sys,"where agentuser='$agentuser'");
	if(!empty($_GET['action'])){
		if($_GET["action"] == "out"){
			if(isset($_SESSION['agent'])){
				unset($_SESSION['agent']);
				header("location:/");
				exit;
			}else{	
				header("location:/");
				exit;
		}
		}
	}
	$dljezs=queryall(co_dingdan,"where agent='$agentuser' and ddzt='success'","sum(agentje) as agentje");//代理利润总金额
	if($dljezs["agentje"] ==""){
		$dljezs["agentje"]="0.00";
	}	
	$dlddzs=querydb(co_dingdan,"where agent='$agentuser'");//代理订单总数
	if($dlddzs==""){
		$dlddzs="0";
	}
	$dlytx=queryall(co_agenttx,"where agentuser='$agentuser' and txzt='yes'","sum(txje) as txje");//已提现金额
	if($dlytx['txje']==""){
		$dlytx['txje']="0";
	}
	
	/****************************/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>代理后台 - <?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 代理后台首页 <small>v 2.0</small></div>
                    </div>
                </div>

            </div>

            <div class="row-content am-cf">
                <div class="row  am-cf">
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="widget widget-primary am-cf">
                            <div class="widget-statistic-header">
                                下级订单总数
                            </div>
                            <div class="widget-statistic-body">
                                <div class="widget-statistic-value">
                                    <i class="am-icon-bookmark"></i> 共 <?php echo $dlddzs; ?> 份订单
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
								<center>数据概览</center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="widget widget-purple am-cf">
                            <div class="widget-statistic-header">
                                我的代理利润
                            </div>
                            <div class="widget-statistic-body">
                                <div class="widget-statistic-value">
                                    <i class="am-icon-money"></i> ￥ <?php echo $dljezs["agentje"]; ?> 元
                                </div>
                                <span class="widget-statistic-icon am-icon-support"></span>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                        <div class="widget widget-primary am-cf">
                            <div class="widget-statistic-header">
                                账户可用余额
                            </div>
                            <div class="widget-statistic-body">
                                <div class="widget-statistic-value">
                                    <i class="am-icon-cny"></i> <?php echo $agent['yue']; ?> 元
                                </div>
                                <span class="widget-statistic-icon am-icon-cny"></span>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                        <div class="widget widget-purple am-cf">
                            <div class="widget-statistic-header">
                                已提现金额
                            </div>
                            <div class="widget-statistic-body">
                                <div class="widget-statistic-value">
                                    <i class="am-icon-cny"></i> <?php echo $dlytx['txje']; ?> 元
                                </div>
                                <span class="widget-statistic-icon am-icon-cny"></span>
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