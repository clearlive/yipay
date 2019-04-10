<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
?>
<?php
	if(!empty($_GET['action'])){
		if($_GET["action"] == "out"){
			if(isset($_SESSION['user'])){
				unset($_SESSION['user']);
				$o=session_id();
				querys(co_session,"where sessid='$o'");
				header("location:/");
				exit;
			}else{	
				header("location:/");
				exit;
		}
		}
	}
	if(isset($_SESSION["user"])){
		header("location:../user");
		exit;
	}
	if(isset($_POST["sub"])){
		$yzm=trim($_POST["yzm"]);
		if(empty($_POST["yhm"])){
			$msg="请输入用户名!";
		}else if(!isszzm($_POST["yhm"])){
			$msg="用户名输入错误!";
		}else if(empty($_POST["mm"])){
			$msg="请输入密码!";
		}else if(empty($yzm)){
			$msg="请输入验证码!";
		}else if($yzm !== $_SESSION["yzm"]){
			$msg="验证码错误!";
		}else{
			$yhm=uhtml(check(trim($_POST["yhm"])));
			$mm=md5(trim($_POST["mm"]));
			$dl=queryall(co_user_sys,"where user='$yhm' and pass='$mm'");
			if($dl['user']!= null){//用户验证通过
				if($dl['status']=='jihuo'){//如果用户已激活
					$sessid=queryall(co_session,"where username='$yhm'");
					if($sessid["username"] != session_id()){
						$d=session_id();
						querys(co_session,"where username='$yhm'");
						queryz(co_session,"username,sessid","'$yhm','$d'");
					}
					$_SESSION["user"] = $dl['user'];
					$dlip = $_SERVER["REMOTE_ADDR"];//登陆IP
					$dlsj = date("Y-m-d H:i",time());//登陆时间
					$dlxx = queryall(co_denglu,"where username='$yhm'");
					if($dlxx["username"] != null){
						$a=$dlxx["dlip"];
						$b=$dlxx["dlsj"];
						queryg(co_denglu,"dlip='$dlip',dlsj='$dlsj',scdlip='$a',scdlsj='$b' where username='$yhm'");
					}else{
						queryz(co_denglu,"username,dlip,dlsj","'$yhm','$dlip','$dlsj'");
					}
					header("location:../user");
					//header("refresh:0;url=../user"); 
					//$msg="登陆成功,3秒后跳转！<hr>";
				}else{//如果用户未激活
					$msg="用户未激活，无法登陆！";
				}
			}else{//用户验证失败
				$msg="用户名或密码错误!";
			}
		}
		
	}
?>
<!DOCTYPE html>
<html ng-app="moduleApp" class="ng-scope"><head><style type="text/css">
@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}</style>
    <meta charset="UTF-8">
    <title>登陆 - <?php echo $web["sitename"]; ?></title>
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
    <div class="loading ng-hide" ng-show="busy">
         <img src="/static/image/loading.gif" class="loading-img">
    </div>

<!-- uiView: --><div ui-view="" class="outer-content ng-scope" id="main_content" style=""><div class="container-fluid padding-none ng-scope">
	<?php require "../head.php";?>
    <div class="container container-style w1120 container-style-login">
        <div class="row login-bg">
            <div class="col-md-6 clo-sm-7 clo-sm-8">
                <div class="login-box ">
                    <div class="clearfix col-md-11 login-t">
                        <span class="pull-left">登录</span>
                        <a class="pull-right" href="/reg">注册账户</a>
                    </div>
                    <div class="btn-group btn-group-type" role="group">
                        <button type="button" class="btn change">输入信息</button>
                        <button type="button" class="btn">验证登陆</button>
                        <label class="btn-active"></label>
                    </div>
					<hr>
					<?php if(isset($msg)){echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>'.@$msg.'</div>';} ?>
                    <form class="form-horizontal login-form ng-pristine ng-invalid ng-invalid-required" action="" method="POST">
                        <div class="col-md-11 login-item clearfix">
                            <input type="text" maxlength="16" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" name="yhm" value="<?php echo @$_POST["yhm"]; ?>" class="form-control common-input" placeholder="用户名">
                        </div>
                        <div class="col-md-11 login-item clearfix">
                            <input type="password" name="mm" value="<?php echo $_POST["mm"]; ?>" placeholder="密码" class="form-control common-input ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern ng-valid-minlength ng-valid-maxlength">
                            <a class="forget-pass" tabindex="-1" href="javascript:alert('请联系客服');">忘记密码</a>
                        </div>
                        <div class="col-md-11 login-item clearfix">
                            <input type="text" maxlength="4" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" name="yzm" placeholder="验证码" class="form-control common-input ng-pristine ng-empty ng-invalid ng-invalid-required ng-touched">
                            <a href="javascript:void(0)" class="login-code-ph" onclick="document.getElementById('verifyimg').src='/Config/Verify.php?r='+Math.random()"><img id="verifyimg" class="codeimg verifyimg reloadverify" alt="点击切换" src="/Config/Verify.php?r=<?php echo rand(); ?>"></a>
                        </div>
                        <button name="sub" type="submit" class="btn btn-black ng-binding">点击登录</button>
                    </form>
                </div>
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