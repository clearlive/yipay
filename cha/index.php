<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
?>
<?php
	//被动执行订单状态更改
	$dqxtsj=time();
	queryg(co_dingdan,"ddzt='fail',ddtzzt='订单已失效' where ddzt='wait' and ddsxsj < '$dqxtsj'");

	if(isset($_POST["sub"])){
		$yzm=trim($_POST["yzm"]);
		if(empty($_POST["ddh"])){
			$msg="请输入订单号!";
		}else if(strlen($_POST["ddh"]) !=20 or !isszzm($_POST["ddh"])){
			$msg="订单号格式错误!";
		}else if(empty($yzm)){
			$msg="请输入验证码!";
		}else if($yzm !== $_SESSION["yzm"]){
			$msg="验证码错误!";
		}else{
			$ddh=uhtml(check(trim($_POST["ddh"])));
			$dl=queryall(co_dingdan,"where ddh='$ddh'");
			if($dl['ddh']!= null){
				if($dl['ddzt'] =='success'){
					$ddzt="<b style='color:green'>成功</b>";
				}else if($dl['ddzt'] =='fail'){
					$ddzt="<b style='color:red'>失败</b>";
				}else if($dl['ddzt'] =='wait'){
					$ddzt="<b style='color:yellow'>待支付</b>";
				}
				$dd_msg="<table class='table table-bordered'><thead><tr><th>订单号</th><th>交易时间</th><th>金额</th><th>状态</th></tr></thead><tbody><tr><td>".$dl['ddh']."</td><td>".$dl['ddsj']."</td><td>".$dl['ddje']."</td><td>".$ddzt."</td></tr></tbody></table>";
			}else{
				$msg='查不到订单 [ '.$ddh.' ] 的记录!';
			}
		}
		
	}
	//微信支付轮询
	if($_POST["action"]=="lunxun"){
		if(isszzm($_POST["ddh"])){
			$wxddh=$_POST["ddh"];
			$wxzfzt=queryall(co_dingdan,"where ddh='$wxddh'");
			$wxzfzt=$wxzfzt["ddzt"];
			echo json_encode(array("zt"=>"$wxzfzt"));
			exit;
		}
	}
?>
<!DOCTYPE html>
<html ng-app="moduleApp" class="ng-scope"><head><style type="text/css">
@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}</style>
    <meta charset="UTF-8">
    <title>订单查询 - <?php echo $web["sitename"]; ?></title>
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
<!-- uiView: -->
<div ui-view="" class="outer-content ng-scope" id="main_content" style="">
<div class="container-fluid padding-none ng-scope">
	<?php require "../head.php";?>
    <div class="container container-style w1120 container-style-login">
        <div class="row">
                <div class="login-box ">
                    <div class="clearfix col-md-11 login-t">
                        <span class="pull-left">订单查询</span>
                    </div>
					<hr>
					<?php if(isset($dd_msg)){echo $dd_msg;} ?>
					<?php if(isset($msg)){echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>'.@$msg.'</div>';} ?>
					<form method="POST" action="" class="form-horizontal login-form ng-pristine ng-invalid ng-invalid-required">
                        <div class="col-md-11 login-item clearfix">
                            <input name="ddh" type="text" maxlength="20" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" placeholder="输入20位数的订单号" class="form-control common-input">
                        </div>
                        <div class="col-md-11 login-item clearfix">
                            <input type="text" maxlength="4" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" name="yzm" placeholder="验证码" class="form-control common-input ng-pristine ng-empty ng-invalid ng-invalid-required ng-touched">
                            <a href="javascript:void(0)" class="login-code-ph" onclick="document.getElementById('verifyimg').src='/Config/Verify.php?r='+Math.random()"><img id="verifyimg" class="codeimg verifyimg reloadverify" alt="点击切换" src="/Config/Verify.php?r=<?php echo rand(); ?>"></a>
                        </div>
                        <button name="sub" type="submit" class="btn btn-black ng-binding">查询</button>
                    </form>
                </div>
        </div>
    </div>
<?php require "../foot.php"; ?>
</div>
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

</body>
</html>