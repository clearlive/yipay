<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/sms/sendSms.php";
?>
<?php
	if(isset($_SESSION["user"])){
		header("location:../user");
		exit;
	}
	if(@$_GET['tgdl']!=null or isszzm($_GET['tgdl'])){//代理推广链接
		$_SESSION['tgdl']=trim($_GET['tgdl']);
		$tgdl=$_SESSION['tgdl'];
	}else{
		$tgdl="";
	}
	
	if($_POST['action']=='hqsjyzm'){
		if(strlen($_POST['sjh'])!==11 or !issz($_POST['sjh'])){
			echo json_encode(array("te"=>"手机号错误"));
			exit;
		}
		$_SESSION['dxyz']=rand(100000,999999);//短信验证码
		$rand=$_SESSION['dxyz'];
		if(sendSms($_POST['sjh'],$rand)){//发送短信息
			echo json_encode(array("ok"=>"ok"));
			exit;
		}
	}
	
if(isset($_POST["sub"])){
	if($web['regstatus']=="yes"){//是否开启注册		
		$yzm=trim($_POST["yzm"]);
		$yhm=uhtml(check(trim($_POST["yhm"])));
		if(empty($_POST["yhm"])){
			$msg="请输入用户名!";
		}else if(strlen($_POST["yhm"])<6 or strlen($_POST["yhm"])>10 or !isszzm($_POST["yhm"]) or $_POST["yhm"]=='codiaodan'){
			$msg="用户名不符合规则!";
		}else if(empty($_POST["yx"])){
			$msg="请输入邮箱!";
		}else if(!isyx($_POST["yx"]) or strlen($_POST["yx"]) > 28){
			$msg="邮箱不符合规则!";
		}else if(empty($_POST["mm"])){
			$msg="请输入密码!";
		}else if(strlen($_POST["mm"])<8){
			$msg="密码不符合规则!";
		}else if(empty($_POST["qrmm"])){
			$msg="请再次输入密码!";
		}else if($_POST["qrmm"] != $_POST["mm"]){
			$msg="两次输入密码不一致!";
		}else if(empty($_POST["lx"])){
			$msg="请输入联系方式!";
		}else if(strlen($_POST["lx"])<5 or strlen($_POST["lx"])>16 or !isszzm($_POST["lx"])){
			$msg="联系方式不符合规则!";
		}else if(empty($_POST["sjh"])){
			$msg="请输入手机号!";
		}else if(strlen($_POST["sjh"]) != 11 or !issz($_POST["sjh"])){
			$msg="手机号码不符合规则!";
		}else if($mm !== $qrmm){
			$msg="两次密码输入不一致!";
		}else if(queryall(co_user_sys,"where user='$yhm'")){
			$ybzc="<b style='color:red'> 用户名已被注册! </b>";
		}else if(queryall(co_user_sys,"where mail='$mail'")){
			$ybzc="<b style='color:red'> 邮箱已被注册! </b>";
		}else if(queryall(co_user_sys,"where shouji='$sjh'")){
			$ybzc="<b style='color:red'> 手机号已被注册! </b>";
		}else if(empty($yzm)){
			$msg="请输入验证码!";
		}
		$mail=uhtml(check(trim($_POST["yx"])));
		$mm=md5(trim($_POST["mm"]));
		$token=md5($name.$password.$email.time());
		$tokentime=time()+60*60*2;
		$lx=uhtml(check(trim($_POST["lx"])));
		$sjh=uhtml(check(trim($_POST["sjh"])));
		$zcsj = date('Y-m-d H:i:s');
		
		if($web['regfs']=='sjzc'){//手机注册
			if($yzm != $_SESSION["dxyz"]){//短信验证码
				$msg="短信验证码错误!".$_SESSION["dxyz"].$yzm;
			}else{
				$_SESSION["dxyz"]=null;//短信验证码清空
				$_SESSION["yzm"]=null;//普通验证码清空
				$zc=queryz(co_user_sys,"user,pass,mail,qq,shouji,zcsj,token,tokentime,api,shiming,yue,status,daili","'$yhm','$mm','$mail','$lx','$sjh','$zcsj','$token','$tokentime','no','no','0','no','$tgdl'");
				queryz(co_userapi,"username,alipay,weixin,yinlian,weixingz,weixinh5,alipaywap","'$yhm','no','no','no','no','no','no'");
				if($zc){
					header("refresh:3;url=../login");
					$ok_msg="注册成功，正在跳转！";
				}else{
					$msg="系统错误(未知)!";
				}
			}
		}else if($web['regfs']=='ptzc'){//普通注册
			if($yzm != $_SESSION["yzm"]){//普通验证码
				$msg="验证码错误!";
			}else{
				$_SESSION["dxyz"]=null;//短信验证码清空
				$_SESSION["yzm"]=null;//普通验证码清空
				$zc=queryz(co_user_sys,"user,pass,mail,qq,shouji,zcsj,token,tokentime,api,shiming,yue,status,daili","'$yhm','$mm','$mail','$lx','$sjh','$zcsj','$token','$tokentime','no','no','0','no','$tgdl'");
				queryz(co_userapi,"username,alipay,weixin,yinlian,weixingz,weixinh5,alipaywap","'$yhm','no','no','no','no','no','no'");
				if($zc){
					header("refresh:3;url=../login");
					$ok_msg="注册成功，正在跳转！";
				}else{
					$msg="系统错误(未知)!";
				}
			}
		}else if($web['regfs']=='yxzc'){//邮箱注册
			if($yzm != $_SESSION["yzm"]){//普通验证码
				$msg="验证码错误!";
			}else{
				$_SESSION["dxyz"]=null;//短信验证码清空
				$_SESSION["yzm"]=null;//普通验证码清空
				$content='<div style="width:600px;margin:auto;line-height:2;font-size:12px;overflow:hidden;border-radius:3px;background:#FFF;box-shadow:0 0 10px rgba(0, 0, 0, 0.2);"><div style="height:69px;border-radius:3px 3px 0 0;background:#DDD;border: solid #C5C5C5;border-width:1px;"><span style="float:left;width:200px;height:33px;padding:5px 16px 0 10px;"><a href="'.$web['siteurl'].'" target="_blank"><img style="margin-top:15px;" src="'.$web['siteurl'].'/static/images/unique/logoBlack.png" border="0" width="150px"></a></span><span style="display:block;width:325px;padding-top:15px;line-height:39px;font-size:14px;font-weight:bold;color:#FFF;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"></span></div><div style="padding:15px 30px;word-wrap:break-word;border:solid #C5C5C5;border-width:0 1px;"><br><div style="line-height:28px;font-size:14px;font-weight:bold;">'.$yhm.'，你好！</div><br><p>欢迎你注册本站,请点击以下链接完成激活,2小时有效!.</p><br><p>链接:<font color="#f60"><a href='.$web['siteurl'].'/reg/to/?token='.$token.'>'.$web['siteurl'].'/reg/to/?token='.$token.'</a></font></p><br><p style="color:#999;">此信是由 <a href="'.$web['siteurl'].'" target="_blank">'.$web['sitename'].'</a> 发出，系统不接收回信，请勿直接回复。如有任何疑问请联系我们</p></div><div style="height:10px;overflow:hidden;border:1px solid #C5C5C5;border-top:0 none;border-radius:0 0 3px 3px;background: #EC0C0C;"></div></div>';
				$flag = sendMail($mail,'注册激活验证 - '.$web['sitename'],$content);
				if($flag){
					$zc=queryz(co_user_sys,"user,pass,mail,qq,shouji,zcsj,token,tokentime,api,shiming,yue,status,daili","'$yhm','$mm','$mail','$lx','$sjh','$zcsj','$token','$tokentime','no','no','0','no','$tgdl'");
					queryz(co_userapi,"username,alipay,weixin,yinlian,weixingz,weixinh5,alipaywap","'$yhm','no','no','no','no','no','no'");
					if($zc){
						header("refresh:10;url=../login");
						$ok_msg="注册成功，请登录邮箱点击激活链接完成注册！";
					}else{
						$msg="系统错误(未知)!";
					}
				}else{
					$msg="注册失败(未能发送激活邮件),请联系管理员！";
				}
			}
		}
		
	}else{
		$msg="系统暂时关闭注册！";
	}
}
?>
<!DOCTYPE html>
<html ng-app="moduleApp" class="ng-scope"><head><style type="text/css">
@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}</style>
    <meta charset="UTF-8">
    <title>注册 - <?php echo $web["sitename"]; ?></title>
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
	<!-- uiView: -->
	<div ui-view="" class="outer-content ng-scope" id="main_content" style="">
	<div class="container-fluid padding-none ng-scope">
	<?php require "../head.php";?>
	
    <div class="container container-style container-style1 w1120">
        <div class="row register-bg">
            <div class="col-md-6 clo-sm-7 clo-sm-8">
                <div class="login-box ">
                    <div class="login-t  col-md-11 clearfix">
                        <span class="pull-left">注册</span>
                        <a ui-sref="login" class="pull-right" href="/login">已有账户</a>
                    </div>
                    <div class="btn-group btn-group-type" role="group">
                        <button type="button" class="btn change">第一步</button>
                        <button type="button" class="btn">注册完成</button>
                        <label class="btn-active"></label>
                    </div>
					<hr>
					<?php if(isset($ok_msg)){echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>'.@$ok_msg.'</div>';} ?>
					<?php if(isset($msg)){echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>'.@$msg.'</div>';} ?>
					<?php if(isset($ybzc)){echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>'.@$ybzc.'</div>';} ?>
					<?php if($web['regstatus']=="no"){echo '<blockquote><p>提示：系统已关闭注册功能！</p><footer>System has been closed for registration</footer></blockquote>';} ?>
                    <form method="POST" action="" class="form-horizontal login-form ng-pristine ng-valid-email ng-invalid ng-invalid-required ng-valid-pattern ng-valid-minlength ng-valid-maxlength">
                        <div class="col-md-11 login-item clearfix">
                            <input name="yhm" type="text" maxlength="16" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" value="<?php echo $_POST["yhm"]; ?>" class="form-control common-input" placeholder="用户名：6~16位英文字母">
                        </div>
                        <div class="col-md-11 login-item clearfix">
                            <input name="yx" type="mail" value="<?php echo $_POST["yx"]; ?>" class="form-control common-input" placeholder="邮箱：可正常使用">
                        </div>
                        <div class="col-md-11 login-item clearfix">
                            <input name="mm" type="password" maxlength="16" value="<?php echo $_POST["mm"]; ?>" placeholder="密码：8~16位数字、英文或符号" class="form-control common-input ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern ng-valid-minlength ng-valid-maxlength">
                        </div>
                        <div class="col-md-11 login-item clearfix">
                            <input name="qrmm" type="password" maxlength="16" placeholder="确认密码" class="form-control common-input ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required">
                        </div>
                        <div class="col-md-11 login-item clearfix">
                            <input name="lx" type="text" maxlength="16" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" value="<?php echo $_POST["lx"]; ?>" class="form-control common-input" placeholder="联系QQ/微信">
                        </div>
                        <div class="col-md-11 login-item clearfix">
                            <input name="sjh" id="sjh" type="text" maxlength="11" onkeyup="this.value=this.value.replace(/\D/g,'')" value="<?php echo $_POST["sjh"]; ?>" class="form-control common-input" placeholder="11位手机号码">
							<?php
								if($web['regfs']=="sjzc"){
									echo '<button type="button" onclick="fsyzm()" id="sjyz" class="login-code-ph btn btn-default btn-sm">获取验证码</button>';
								}
							?>
							
						</div>
						<div class="col-md-11 login-item clearfix">
                            <input name="yzm" type="text" maxlength="6" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" placeholder="验证码" class="form-control common-input ng-pristine ng-empty ng-invalid ng-invalid-required ng-touched">
							<?php 
								if($web['regfs']!="sjzc"){
							?>
									<a href="javascript:void(0)" class="login-code-ph" onclick="document.getElementById('verifyimg').src='/Config/Verify.php?r='+Math.random()"><img id="verifyimg" class="codeimg verifyimg reloadverify" alt="点击切换" src="/Config/Verify.php?r=<?php echo rand(); ?>"></a>
							<?php 
								}
							?>
						</div>
                        <button  name="sub" type="submit" class="btn btn-black ng-binding" <?php if($web['regstatus']=="no"){echo 'disabled="disabled"';} ?>>点击注册</button>
                        <p class="tip-news">提交信息即代表同意<a class="tip-news" href="#">《<?php echo $web["sitename"]; ?>协议条款》</a></p>
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
<script type="text/javascript"> 
var countdown=60; 
function fsyzm(){
	$("#sjyz").html("发送中...");
	$.ajax({
		url:'',
		data:{
			action:'hqsjyzm',
			sjh:$("#sjh").val(),
		},
		type:'POST',
		dataType:'JSON',
		success:function(data){
			$("#sjyz").html(data.te);
			setTimeout(function(){
				$("#sjyz").html("获取验证码");
			},1000)
			if(data.ok){
				var obj = $("#sjyz");
				settime(obj);
			}
		},
		error:function(){
			$("#sjyz").html("出现错误");
			setTimeout(function(){
				$("#sjyz").html("获取验证码");
			},1000)
		}
	})    
}
function settime(obj) { //发送验证码倒计时
    if (countdown == 0) { 
        obj.attr('disabled',false); 
        obj.html("获取验证码");
        countdown = 60; 
        return;
    } else { 
        obj.attr('disabled',true);
        obj.html("已发送(" + countdown + ")");
        countdown--; 
    } 
setTimeout(function() { 
    settime(obj) }
    ,1000) 
}
</script>
</body>
</html>