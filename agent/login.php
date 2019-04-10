<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(isset($_SESSION["agent"])){
		header("location:index.php");
		exit;
	}
	if(!empty($_GET['action'])){
		if($_GET["action"] == "out"){
			if(isset($_SESSION['agent'])){
				unset($_SESSION['agent']);
				$o=session_id();
				queryg(co_agent_sys,"sessid='' where sessid='$o'");
				header("location:/");
				exit;
			}else{	
				header("location:/");
				exit;
		}
		}
	}
	if(!empty($_POST)){
		if(@$_POST["zh"] ==null){
			echo json_encode(array("te"=>"账户不能为空,请输入后重试！"));
			exit;
		}
		if(@$_POST["mm"] ==null){
			echo json_encode(array("te"=>"密码不能为空,请输入后重试！"));
			exit;
		}
		$zh=uhtml(check(trim($_POST["zh"])));
		$mm=md5(uhtml(check(trim($_POST["mm"]))));
		$agentdl=queryall(co_agent_sys,"where agentuser='$zh'and agentpass='$mm'");
		if($agentdl["agentuser"] !== null){
			if($agentdl["sessid"] != session_id()){
				$d=session_id();
				queryg(co_agent_sys,"sessid='$d' where agentuser='$zh'");
			}
			if($agentdl["status"]=='禁用'){
				echo json_encode(array("te"=>"该代理已被禁用,无法登陆！"));
				exit;
			}
			$_SESSION["agent"]=$zh;
			echo json_encode(array("te"=>"登陆成功,正在跳转！","ok"=>"ok"));
			exit;
		}else{
			echo json_encode(array("te"=>"登陆失败,请重试！"));
			exit;
		}
	}
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>代理后台登陆 - <?php echo $web["sitename"]; ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="assets/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" href="assets/css/app.css">
    <script src="assets/js/jquery.min.js"></script>

</head>

<body data-type="login">
    <script src="assets/js/theme.js"></script>
    <div class="am-g tpl-g">
        <!-- 风格切换 -->
        <div class="tpl-skiner">
            <div class="tpl-skiner-toggle am-icon-cog">
            </div>
            <div class="tpl-skiner-content">
                <div class="tpl-skiner-content-title">
                    选择主题
                </div>
                <div class="tpl-skiner-content-bar">
                    <span class="skiner-color skiner-white" data-color="theme-white"></span>
                    <span class="skiner-color skiner-black" data-color="theme-black"></span>
                </div>
            </div>
        </div>
        <div class="tpl-login">
            <div class="tpl-login-content">
                <div class="tpl-login-logo">

                </div>



                <form class="am-form tpl-form-line-form">
                    <div class="am-form-group">
                        <input type="text" class="tpl-form-input" id="zh" placeholder=" 账号">

                    </div>

                    <div class="am-form-group">
                        <input type="password" class="tpl-form-input" id="mm" placeholder=" 密码">

                    </div>
                    <div class="am-form-group tpl-login-remember-me">
                        <input id="remember-me" type="checkbox" checked>
                        <label for="remember-me">
       
                        记住密码
                         </label>

                    </div>






                    <div class="am-form-group">

                        <button id="dl" name="dl" type="button" class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn"><i class='am-icon-user-secret'></i>　登录代理后台</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/dl.js"></script>
<script type="text/javascript">
	document.onkeydown=function(e){
		var a=e||window.event;
		if (a.keyCode == 13){
			$("#dl").click();
		}
	}
</script>
</body>

</html>