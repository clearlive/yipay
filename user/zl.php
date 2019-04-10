<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["user"])){
		header("location:../login");
		exit;
	}
	$yhm=$_SESSION["user"];
	$user=queryall(co_user_sys,"where user='$yhm'");
	$dl=queryall(co_denglu,"where username='$yhm'");
	$smtj=queryall(co_shiming,"where username='$yhm'");
	if(!empty($_POST["xgxzl"])){
		if($_POST['qq'] ==null){
			echo json_encode(array("te"=>"联系方式不能为空！"));
			exit;
		}else if($_POST['sj'] ==null){
			echo json_encode(array("te"=>"手机号不能为空！"));
			exit;
		}else if($_POST['yx'] ==null){
			echo json_encode(array("te"=>"邮箱不能为空！"));
			exit;
		}else if($_POST['dz'] ==null){
			echo json_encode(array("te"=>"地址不能为空！"));
			exit;
		}else if(!isszzm($_POST['qq']) or strlen($_POST['qq']) > '16'){
			echo json_encode(array("te"=>"联系方式格式错误！"));
			exit;
		}else if(!issz($_POST['sj']) or strlen($_POST['sj']) != '11'){
			echo json_encode(array("te"=>"手机号格式错误！"));
			exit;
		}else if(!isyx($_POST['yx']) or strlen($_POST['yx']) > '28'){
			echo json_encode(array("te"=>"邮箱格式错误！"));
			exit;
		}else if(strlen($_POST['dz']) > '66'){
			echo json_encode(array("te"=>"地址过长！"));
			exit;
		}
		$qq=uhtml(check(trim($_POST["qq"])));
		$sj=uhtml(check(trim($_POST["sj"])));
		$yx=uhtml(check(trim($_POST["yx"])));
		$dz=uhtml(check(trim($_POST["dz"])));
		if(queryg(co_user_sys,"qq='$qq',shouji='$sj',mail='$yx',dizhi='$dz' where user='$yhm'")){
			echo json_encode(array("te"=>"修改成功！","ok"=>"ok"));
			exit;
		}else{
			echo json_encode(array("te"=>"修改成功！","ok"=>"ok"));
			exit;
		}
	}
	
	if(!empty($_POST["xgxmm"])){
		if($_POST['xgmmyzm'] !==$_SESSION["yzm"]){
			echo json_encode(array("te"=>"验证码错误！"));
			exit;
		}else if($_POST['ymm'] ==null){
			echo json_encode(array("te"=>"请输入原密码！"));
			exit;
		}else if($_POST['xmm'] ==null){
			echo json_encode(array("te"=>"请输入新密码！"));
			exit;
		}else if($_POST['qrxmm'] ==null){
			echo json_encode(array("te"=>"请再次确认密码！"));
			exit;
		}else if($_POST['qrxmm'] !=$_POST['xmm']){
			echo json_encode(array("te"=>"两次密码输入不一致！"));
			exit;
		}
		if($user["pass"] != md5(trim($_POST["ymm"]))){
			echo json_encode(array("te"=>"原密码错误！"));
			exit;
		}
		if($user["pass"] == md5(trim($_POST["qrxmm"]))){
			echo json_encode(array("te"=>"新旧密码不能相同！"));
			exit;
		}
		$xmm=md5(trim($_POST["qrxmm"]));
		if(queryg(co_user_sys,"pass='$xmm' where user='$yhm'")){
			echo json_encode(array("te"=>"修改成功,请重新登录！","ok"=>"ok"));
			exit;
		}else{
			echo json_encode(array("te"=>"修改失败","ok"=>"ok"));
			exit;
		}
	}
?>
<!DOCTYPE html>
<html lang="ch">
    <head>        
        <!-- META SECTION -->
        <title>账户信息 - 商户中心 - <?php echo $web["sitename"]; ?></title>            
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
                    <li class="active">账户信息</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-user"></span> 账户信息</h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">                
                
                    <div class="row">
                        <div class="col-md-8">

                                <div class="panel-body">
								

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist" style="margin-top:-15px;background-color:#ffffff;">
    <li role="presentation" class="active"><a href="#jbxx" aria-controls="home" role="tab" data-toggle="tab">基本信息</a></li>
    <li role="presentation" ><a href="#dlxgxx" aria-controls="dlxgxx" role="tab" data-toggle="tab">登录信息</a></li>
    <li role="presentation"><a href="#xgzl" aria-controls="xgzl" role="tab" data-toggle="tab">修改资料</a></li>
    <li role="presentation"><a href="#xgmm" aria-controls="xgmm" role="tab" data-toggle="tab">修改密码</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="jbxx">
		<div class="panel panel-default">
			<div class="panel-body">
			<hr>
				<table class="table table-bordered">
					<tbody>
						<tr>
						<td class="col-md-2" style="background-color:#eee;"><b class="title">用户名：</b></td>
						<td class="col-md-10"><?php echo $user["user"]; ?></td>
						</tr>
						<tr>
						<td class="col-md-2" style="background-color:#eee;"><b class="title">API功能：</b></td>
						<td class="col-md-10"><?php if($user['api'] =='yes'){echo "<button type='button' class='btn btn-success btn-xs'>已开通</button>";}else{echo "<button type='button' class='btn btn-danger btn-xs'>未开通</button>";} ?></td>
						</tr>
						<tr>
						<tr style="<?php if($sh['api'] =='no'){echo 'display:none';} ?>">
						<td class="col-md-2" style="background-color:#eee;"><b class="title">费率：</b></td>
						<td class="col-md-10"><?php if($user['feilv']==null){ echo "默认费率 （<a href='td.php'>点此查看</a>）";}else{echo $user['feilv'];} ?></td>
						</tr>
						<tr>
						<td class="col-md-2" style="background-color:#eee;"><b class="title">姓名：</b></td>
						<td class="col-md-10"><?php echo $user["xingming"]=$user["xingming"]==null?'未设置':$user["xingming"]; ?></td>
						</tr>
						<tr>
						<td class="col-md-2" style="background-color:#eee;"><b class="title">性别：</b></td>
						<td class="col-md-10"><?php echo $user["xingbie"]=$user["xingbie"]==null?'未设置':$user["xingbie"]; ?></td>
						</tr>
						<tr>
						<td class="col-md-2" style="background-color:#eee;"><b class="title">地址：</b></td>
						<td class="col-md-10"><?php echo $user["dizhi"]=$user["dizhi"]==null?'未设置':$user["dizhi"]; ?></td>
						</tr>
						<tr>
						<td class="col-md-2" style="background-color:#eee;"><b class="title">手机：</b></td>
						<td class="col-md-10"><?php echo $user["shouji"]; ?></td>
						</tr>
						<tr>
						<td class="col-md-2" style="background-color:#eee;"><b class="title">联系QQ/微信：</b></td>
						<td class="col-md-10"><?php echo $user["qq"]; ?></td>
						</tr>
						<tr>
						<td class="col-md-2" style="background-color:#eee;"><b class="title">邮箱：</b></td>
						<td class="col-md-10"><?php echo $user["mail"]; ?></td>
						</tr>
						<tr>
						<td class="col-md-2" style="background-color:#eee;"><b class="title">注册时间：</b></td>
						<td class="col-md-10"><?php echo $user["zcsj"]; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
    <div role="tabpanel" class="tab-pane" id="dlxgxx">
		<div class="panel panel-default">
			<div class="panel-body">
				<hr>
				<blockquote>上次登陆ＩＰ: <span style="color:green"><?php echo $dl["scdlip"]; ?></span> - 上次登陆时间: <span style="color:green"><?php echo $dl["scdlsj"]; ?></span></blockquote><blockquote>本次登陆ＩＰ: <span style="color:red"><?php echo $dl["dlip"]; ?></span> - 本次登陆时间: <span style="color:red"><?php echo $dl["dlsj"]; ?></span></blockquote></pre>
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>注意!</strong> 请务必关注登陆信息,以防账号被盗损失.
</div>
			</div>
		</div>
	</div>
    <div role="tabpanel" class="tab-pane" id="xgzl">
		<div class="panel panel-default">
			<div class="panel-body">
			<hr>
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">联系QQ/微信</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-flickr"></span></span>
                                                        <input id="xgqq" type="text" class="form-control" value="<?php echo $user["qq"]; ?>"/>
                                                    </div>            
                                                    <span class="help-block">（修改）</span>
                                                </div>
                                            </div>
											
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">手机号</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
                                                        <input id="xgsj" type="text" class="form-control" value="<?php echo $user["shouji"]; ?>"/>
                                                    </div>            
                                                    <span class="help-block">（修改）</span>
                                                </div>
                                            </div>
											
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">邮箱</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">@</span>
                                                        <input id="xgyx" type="mail" class="form-control" value="<?php echo $user["mail"]; ?>"/>
                                                    </div>            
                                                    <span class="help-block">（重要）</span>
                                                </div>
                                            </div>
											
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">联系地址</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                                        <input id="xgdz" type="text" class="form-control" value="<?php echo $user["dizhi"]; ?>"/>
                                                    </div>            
                                                    <span class="help-block">（修改）</span>
                                                </div>
                                            </div>
                                            
											<div class="panel-footer">
                               			    	<button id="xgxzl" value="xg" onclick="xgzl()" class="btn btn-primary pull-right">确认修改</button>
                            			    </div>
			</div>
		</div>
	</div>
	
	
    <div role="tabpanel" class="tab-pane" id="xgmm">
		<div class="panel panel-default">
			<div class="panel-body">
			<hr>
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">原密码</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                                        <input id="ymm" type="password" class="form-control"/>
                                                    </div>            
                                                    <span class="help-block">（不修改请留空）</span>
                                                </div>
                                            </div>
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">新密码</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                                        <input id="xmm" type="password" class="form-control"/>
                                                    </div>            
                                                    <span class="help-block">（请注意密码的复杂程度）</span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">确认新密码</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                                        <input id="qrxmm" type="password" class="form-control"/>
                                                    </div>            
                                                    <span class="help-block">（再次输入）</span>
                                                </div>
                                            </div>
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">验证码</label>
                                                <div class="col-md-7 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-info-sign"></span></span>
                                                        <input id="xgmmyzm" type="text" class="form-control"/>
                                                    </div>            
                                                    <span class="help-block">请输入验证码</span>
                                                </div>
                                                <div class="col-md-2 col-xs-12">
													<a href="javascript:void(0)" onclick="document.getElementById('verifyimg').src='/Config/Verify.php?r='+Math.random()"><img id="verifyimg" alt="点击切换" src="/Config/Verify.php?r=<?php echo rand(); ?>"></a>
                                                </div>
                                            </div>
											<div class="panel-footer">
                               			    	<button id="xgxmm" value="xg" onclick="xgxmm()" class="btn btn-primary pull-right">确认修改</button>
                            			    </div>
			</div>
		</div>
	</div>
  </div>

                                </div>

                        </div>
						
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">实名认证状态</h3>                               
                                </div>
                                <div class="panel-body">
								<?php
									if($user["shiming"] =="yes"){
										echo '<div class="col-md-6"><img src="img/yishiming.png" class="center-block"></div><div class="col-md-6"><h1><button class="btn btn-success" >已实名认证,所有功能开放！</button></h1></div>';
									}else{
										if($smtj['username'] == $yhm){
											echo '<div class="col-md-6"><img src="img/weishiming.png" class="center-block"></div><div class="col-md-6"><h1><a class="btn btn-warning">实名认证审核中！</a></</h1></div>';
										}else{
											echo '<div class="col-md-6"><img src="img/weishiming.png" class="center-block"></div><div class="col-md-6"><h1><a href="sm.php" class="btn btn-danger">未实名认证,请先实名认证！</a></</h1></div>';
										}
									}
								?>
									
                                </div>
                            </div>
                        </div>                   
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-body">
									<blockquote><p>注意：为保证商户功能正常使用,请及时进行实名认证.</p><p>如不认证核心功能将关闭.</p></blockquote>
                                </div>
                            </div>
                        </div>                   
                    </div>
                
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
<div id="xgte" class="modal fade bs-example-modal-sm in" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<center><br><p id="te"></p></center>
		</div>
	</div>
</div>
        
		<?php require "foot.php"; ?>
        <script type="text/javascript" src="js/xgzl.js"></script>
    </body>
</html>






