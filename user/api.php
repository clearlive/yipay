<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["user"])){
		header("location:../login");
		exit;
	}
	$yhm=$_SESSION["user"];
	$yhapi=queryall(co_user_sys,"where user='$yhm'");
	if(!empty($_POST["pw"])){
		$mm=md5(uhtml(check(trim($_POST["pw"]))));
		if($yhapi['pass'] == $mm){
			$xkey=randkey('40');
			queryg(co_user_sys,"apikey='$xkey' where user='$yhm'");
			echo json_encode($yhapi);
			exit;
		}else{
			echo json_encode(array("te"=>"密码错误！"));
			exit;
		}
	}
	if(@$_POST['action']=='shenqing'){
		if($_POST["yzm"] ==null or strlen($_POST["yzm"])>4 or !isszzm($_POST["yzm"]) or $_POST["yzm"] !==$_SESSION["yzm"]){
			echo json_encode(array("te"=>"验证码错误！"));
			exit;
		}
		if($_POST["sqwz"] ==null or strlen($_POST["sqwz"])>40){
			echo json_encode(array("te"=>"申请网址格式错误！"));
			exit;
		}
		if($_POST["wzmc"] ==null or strlen($_POST["wzmc"])>18){
			echo json_encode(array("te"=>"网站名称格式错误！"));
			exit;
		}
		if($_POST["wzlx"] ==null or strlen($_POST["wzlx"])>20 or !ishz($_POST["wzlx"])){
			echo json_encode(array("te"=>"网站类型格式错误！"));
			exit;
		}
		if($_POST["lxfs"] ==null or strlen($_POST["lxfs"])>16 or !isszzm($_POST["lxfs"])){
			echo json_encode(array("te"=>"联系方式格式错误！"));
			exit;
		}
		$kkk=queryall(co_userapi,"where username='$yhm'");
		if($yhapi['api'] =='yes' or $kkk['zt']=='no'){
			echo json_encode(array("te"=>"请勿重复申请！"));
			exit;
		}
		if($yhapi['shiming'] =='no'){
			echo json_encode(array("te"=>"您未实名认证，不能申请！"));
			exit;
		}
		$sqsj=date("Y-m-d H:i:s",time());//当前时间
		$sqwz=uhtml(check(trim($_POST["sqwz"])));//申请网址
		$wzmc=uhtml(check(trim($_POST["wzmc"])));//网站名称
		$wzlx=uhtml(check(trim($_POST["wzlx"])));//网站类型
		$lxfs=uhtml(check(trim($_POST["lxfs"])));//联系方式
		if(queryg(co_userapi,"wzurl='$sqwz',wzname='$wzmc',wzlx='$wzlx',lxfs='$lxfs',sqsj='$sqsj',zt='no' where username='$yhm'")){    //写入数据库表
			echo json_encode(array("te"=>"申请提交成功,等待管理员审核！","ok"=>"ok"));
			exit;
		}
	}
?>
<!DOCTYPE html>
<html lang="ch">
    <head>        
        <!-- META SECTION -->
        <title>接入信息 - 商户中心 - <?php echo $web["sitename"]; ?></title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />        
        <link rel="icon" href="/favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                   
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <?php require "head.php"; ?>
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <?php require "top.php"; ?>
                
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">商户中心</a></li>
                    <li class="active">接入信息</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="glyphicon glyphicon-indent-left"></span> 接入信息</h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">                
                
                    <div class="row">
					<?php
						if($yhapi['api']=='yes'){
							
					?>
                        <div class="col-md-12">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">API相关</h3>                               
                                </div>
                                <div class="panel-body">
								<p>接入ＩＤ：</p>
								<blockquote data-toggle="tooltip" data-placement="top" title="商户API功能唯一标识"><p><?php echo $yhapi['id']; ?></p></blockquote>
								<p>密匙ＫＥＹ：</p>
								<blockquote data-toggle="tooltip" data-placement="top" title="用于API接口功能验证"><p id="key"><?php echo $yhapi['apikey']; ?></p></blockquote>
								<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong>注意!</strong> 操作不可逆,请谨慎操作.
								</div>
								<hr>
								<button id="gh" class="btn btn-danger btn-sm">重新生成密匙</button>
                                
                                </div>
                            </div>

                        </div>  
						<?php }else{ ?>
                        <div class="col-md-12">
						<?php $kkk=queryall(co_userapi,"where username='$yhm'"); ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">暂未开通</h3>                               
                                </div>
                                <div class="panel-body">
							<?php if($kkk['zt']=='no'){echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>温馨提示： </strong> 你已经提交了API接口功能申请，请耐心等待管理员审核！.</div><br><hr>';} ?>
								<blockquote data-toggle="tooltip" data-placement="top" title="提示">
								<p>
									需知：
								</p> <small><cite>使用API接口请先提交申请信息!</cite></small>
								</blockquote>
								<hr>                                
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">申请网址</label>
                                                <div class="col-md-7 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></span>
                                                        <input id="sqwz" type="text" class="form-control" <?php if($kkk['zt']=='no'){echo 'disabled="disabled" value="'.$kkk['wzurl'].'"';} ?>/>
                                                    </div>            
                                                    <span class="help-block">如：www.gov.cn</span>
                                                </div>
                                            </div>
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">网站名称</label>
                                                <div class="col-md-7 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-send"></span></span>
                                                        <input id="wzmc" type="text" class="form-control" <?php if($kkk['zt']=='no'){echo 'disabled="disabled" value="'.$kkk['wzname'].'"';} ?>/>
                                                    </div>            
                                                    <span class="help-block">网站名称简写(6个字符以内)</span>
                                                </div>
                                            </div>
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">网站类型</label>
                                                <div class="col-md-7 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-stats"></span></span>
															<select id="sqlx" class="form-control" <?php if($kkk['zt']=='no'){echo 'disabled="disabled" value="'.$kkk['wzlx'].'"';} ?>>
															<option value="综合社区">综合社区</option>
															<option value="网上购物">网上购物</option>
															<option value="游戏充值">游戏充值</option>
															<option value="其他类型">其他类型</option>
															</select>
                                                    </div>            
                                                    <span class="help-block">请选择准确类型</span>
                                                </div>
                                            </div>
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">联系方式</label>
                                                <div class="col-md-7 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-credit-card"></span></span>
                                                        <input id="lxfs" type="text" class="form-control" <?php if($kkk['zt']=='no'){echo 'disabled="disabled" value="'.$kkk['lxfs'].'"';} ?>/>
                                                    </div>            
                                                    <span class="help-block">申请人联系方式（不超过16个字符）</span>
                                                </div>
                                            </div>
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">验证码</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-info-sign"></span></span>
                                                        <input id="yzm" type="text" class="form-control" <?php if($kkk['zt']=='no'){echo 'disabled="disabled"';} ?>/>
                                                    </div>            
                                                    <span class="help-block">请输入验证码</span>
                                                </div>
                                                <div class="col-md-2 col-xs-12">
													<a href="javascript:void(0)" class="login-code-ph" onclick="document.getElementById('verifyimg').src='/Config/Verify.php?r='+Math.random()"><img id="verifyimg" alt="点击切换" src="/Config/Verify.php?r=<?php echo rand(); ?>"></a>
                                                </div>
                                            </div>
                                </div>
                            </div>
							<div class="modal-footer">
							<button id="sqkt" type="button" class="btn btn-primary" <?php if($kkk['zt']=='no'){echo 'disabled="disabled"';} ?>>申请开通</button>
							</div>
                        </div>  
						<?php } ?>
                    </div>
                
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
<div id="yz" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">重新生成商户密匙</h4>
      </div>
      <div class="modal-body">
  <div class="form-group">
    <input id="pw" type="password" class="form-control" placeholder="请输入登录密码验证">
  </div>
  <pre style="color:red" id="te"></pre>
  <pre>
  <span class="fa fa-exclamation-circle"></span>温馨提示：
	   重新生成后原KEY密匙就会失效，记得及时更新配置文件！
  </pre>
	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">算了</button>
        <button id="cxsc" type="button" class="btn btn-primary">重新生成</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="apiscok" class="modal fade bs-example-modal-sm in" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<center><br><p>已重新生成</p></center>
		</div>
	</div>
</div>
<div id="jkte" class="modal fade bs-example-modal-sm in" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<center><br><p id="ate"></p></center>
		</div>
	</div>
</div>
        
		<?php require "foot.php"; ?>
		<script>
			$("#gh").click(function(){
				$("#te").hide();
				$('#yz').modal();	
			})
			$("#cxsc").click(function(){
				if($("#pw").val() == ""){
					$("#te").show();
					$("#te").html("请输入密码！");
					return false;
					}
				$.ajax({
					url:"",
					data:{
						pw:$("#pw").val()
					},
					dataType:"json",
					type:"post",
					success:function(data){
						if(data.te == null){
							$("#key").html(data.apikey);
							$('#yz').modal('hide')
							$('#apiscok').modal();	
							setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
								window.location.reload();//页面刷新
							},1000);							

						}else{
							$("#te").show();
							$("#te").html(data.te);
						}
					},
					error:function(){
							$("#te").show();
							$("#te").html('获取数据错误');
					}
				})
			})
		</script>
		<script>
			$("#sqkt").click(function(){
				if($("#sqwz").val() == ""){
					$("#jkte").modal();
					$("#ate").html("请输入申请的网址！");
					return false;
					}
				if($("#wzmc").val() == ""){
					$("#jkte").modal();
					$("#ate").html("请输入网站名称！");
					return false;
					}
				if($("#wzlx").val() == ""){
					$("#jkte").modal();
					$("#ate").html("请输入网站类型！");
					return false;
					}
				if($("#lxfs").val() == ""){
					$("#jkte").modal();
					$("#ate").html("请输入联系方式！");
					return false;
					}
				if($("#yzm").val() == ""){
					$("#jkte").modal();
					$("#ate").html("请输入验证码！");
					return false;
					}
				$.ajax({
					url:"",
					data:{
						action:'shenqing',
						sqwz:$("#sqwz").val(),
						wzmc:$("#wzmc").val(),
						wzlx:$("#sqlx").val(),
						lxfs:$("#lxfs").val(),
						yzm:$("#yzm").val(),
					},
					dataType:"JSON",
					type:"POST",
					success:function(data){
						$("#jkte").modal();
						$("#ate").html(data.te);
						if(data.ok){
							setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
								window.location.reload();//页面刷新
							},1000);							
						}
					},
					error:function(){
						$("#jkte").modal();
						$("#ate").html('获取数据错误');
					}
				})
			})
		</script>
        
    </body>
</html>






