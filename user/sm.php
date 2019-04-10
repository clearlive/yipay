<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["user"])){
		header("location:../login");
		exit;
	}
	$yhm=$_SESSION["user"];
	$smzt=queryall(co_user_sys,"where user='$yhm'");
	$smtj=queryall(co_shiming,"where username='$yhm'");
	if(!empty($_POST["tjrz"])){
		if($smzt['shiming'] == "yes"){
			echo json_encode(array('te'=>' 您已是实名认证商户,不可再进行认证,如有疑问请联系管理员!'),true);
			exit;
		}else if($smtj['username'] == $yhm){
			echo json_encode(array('te'=>' 您已是提交实名认证,请勿重复提交,请耐心等待!'),true);
			exit;
		}else if(strlen($_POST["sfzxm"]) >12 or strlen($_POST["sfzxm"]) <6 or !ishz($_POST["sfzxm"])){
			echo json_encode(array('te'=>' 身份证姓名为空或不符合规则!'),true);
			exit;
		}else if(strlen($_POST["sfzhm"]) !=18 or !isszzm($_POST["sfzhm"])){
			echo json_encode(array('te'=>' 身份证号码为空或不符合规则!'),true);
			exit;
		}else if(strlen($_POST["sfzdz"]) >88 or strlen($_POST["sfzdz"]) <18){
			echo json_encode(array('te'=>' 身份证地址为空或不符合规则!'),true);
			exit;
		}else if(strlen(trim($_POST["xingbie"]) >3 or !ishz(trim($_POST["xingbie"])))){
			echo json_encode(array('te'=>' 性别设置错误!'),true);
			exit;
		}else if(empty($_FILES['sfzzmtp']['tmp_name'])){
			echo json_encode(array('te'=>' 未选择正面图片!'),true);
			exit;
		}else if(empty($_FILES['sfzfmtp']['tmp_name'])){
			echo json_encode(array('te'=>' 未选择反面图片!'),true);
			exit;
		}else if(strlen($_POST["hjszd"]) >18 or !ishz($_POST["sfzxm"])){
			echo json_encode(array('te'=>' 户籍所在地为空或不符合规则!'),true);
			exit;
		}else if(!iszm($_POST["sqlx"])){
			echo json_encode(array('te'=>' 申请类型错误!'),true);
			exit;
		}else if(!istp($_FILES['sfzzmtp'])){
			echo json_encode(array('te'=>' 身份证正面图片错误!'),true);
			exit;
		}else if(!istp($_FILES['sfzfmtp'])){
			echo json_encode(array('te'=>' 身份证反面图片错误!'),true);
			exit;
		}else{
			$sfzxm=$_POST["sfzxm"];//身份证姓名
			$xingbie=$_POST["xingbie"];//身份证号码
			$sfzhm=$_POST["sfzhm"];//身份证号码
			$sfzdz=$_POST["sfzdz"];//身份证地址
			$sfzzmtp=uploadtp($_FILES['sfzzmtp']);//身份证正面图片
			$sfzfmtp=uploadtp($_FILES['sfzfmtp']);//身份证反面图片
			$hjszd=$_POST["hjszd"];//户籍所在地址
			$sqlx=$_POST["sqlx"];//申请认证类型
			$sqsj=date("Y-m-d H:i:s",time());//申请时间
			if(queryz(co_shiming,"username,sfzxm,sfzhm,sfzdz,sfzzmtp,sfzfmtp,hjszd,sqlx,time,xingbie","'$yhm','$sfzxm','$sfzhm','$sfzdz','$sfzzmtp','$sfzfmtp','$hjszd','$sqlx','$sqsj','$xingbie'")){
				echo json_encode(array('te'=>' 提交成功,管理员将会尽快审核!','ok'=>'ok'),true);
				exit;
			}
		}
		
	}
	
?>
<!DOCTYPE html>
<html lang="ch">
    <head>        
        <!-- META SECTION -->
        <title>实名认证 - 商户中心 - <?php echo $web["sitename"]; ?></title>            
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
                    <li class="active">实名认证</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-credit-card"></span> 实名认证</h2>
                </div>
                <!-- END PAGE TITLE -->                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
					<?php
						if($smzt['shiming'] == "yes"){
					?>
                        <div class="col-md-12" >
                            
                            <form id="hiddenForm" class="form-horizontal" >
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">认证状态</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>
								<div class="panel-body">
									<div class="col-md-2">
										<img src="img/yishiming.png" class="center-block">
									</div>
									<div class="col-md-4">
									<table class="table table-bordered">
							      <thead>
									<tr>
    							      <th colspan=3><center>认证信息</center></th>
     							   </tr>
    							  </thead>
    							  <tbody>
    							    <tr>
    							      <th scope="row">姓名：</th>
    							      <td><?php echo $smzt['xingming']; ?></td>
    							      <th scope="row"><span style="color:green" class="glyphicon glyphicon-check"></span></th>
    							    </tr>
    							    <tr>
     							     <th scope="row">性别：</th>
      							    <td><?php echo $smzt['xingbie']; ?></td>
    							      <th scope="row"><span style="color:green" class="glyphicon glyphicon-check"></span></th>
      							  </tr>
     							   <tr>
     							     <th scope="row">证件：</th>
     							     <td><?php echo $smzt['sfzhm']; ?></td>
    							      <th scope="row"><span style="color:green" class="glyphicon glyphicon-check"></span></th>
    							    </tr>
     							   <tr>
     							     <th scope="row">籍贯：</th>
     							     <td><?php echo $smzt['hjszd']; ?></td>
    							      <th scope="row"><span style="color:green" class="glyphicon glyphicon-check"></span></th>
    							    </tr>
    							  </tbody>
								</table>
								</div>
									<div class="col-md-4">
										<blockquote>
											<p>为什么要实名认证？</p>
											<p>　　1.应国家工信部要求</p>
											<p>　　2.解锁平台更多功能</p>
											<p>　　3.防范洗钱诈骗贿赂</p>
											<p>　　4.验证账号是否本人</p>
											<p>　　5.绿化我国网络环境</p>
											<p>　　6.商户体验更加个性</p>
											<p>　　7.技术处理更加迅速</p>
											<p>　　8.问题洽谈明确了当</p>
										</blockquote>
									</div>									
                                </div>
							</div>
                            </form>
                            
                        </div>
					
					<?php
						}else{
					?>
                        <div class="col-md-12" >
                            
                            <form id="hiddenForm" class="form-horizontal" >
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">认证信息</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">                                                                        
                                    
                                    <div class="row">
												<?php if($smtj['username'] == $yhm){echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>温馨提示： </strong> 你已经提交了实名认证申请，请耐心等待管理员审核！.</div>';} ?>                                  <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">身份证姓名</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                                        <input id="sfzxm" name="sfzxm" type="text" class="form-control" value="<?php echo $_POST["sfzxm"];?>" <?php if($smtj['username'] == $yhm){echo 'disabled="disabled"';} ?>/>
                                                    </div>                                            
                                                    <span class="help-block">（审核通过不予修改）</span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">性别</label>
                                                <div class="col-md-9">												
                                                    <div class="input-group">
													<span class="input-group-addon"><span class="glyphicon glyphicon-tint"></span></span>
                                                    <select id="xingbie" name="xingbie" class="form-control select" <?php if($smtj['username'] == $yhm){echo 'disabled="disabled"';} ?>>
                                                        <option value="男">男</option>
                                                        <option value="女">女</option>
                                                    </select>
													</div>
                                                    <span class="help-block">下拉选择</span>
                                                </div>
                                            </div>
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">身份证号码</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-info-sign"></span></span>
                                                        <input id="sfzhm" name="sfzhm" type="text" class="form-control" value="<?php echo $_POST["sfzhm"];?>" <?php if($smtj['username'] == $yhm){echo 'disabled="disabled"';} ?>/>
                                                    </div>            
                                                    <span class="help-block">（18位二代身份证号码）</span>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">身份证地址</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-crosshairs"></span></span>
                                                        <input id="sfzdz" name="sfzdz" type="text" class="form-control" value="<?php echo $_POST["sfzdz"];?>" <?php if($smtj['username'] == $yhm){echo 'disabled="disabled"';} ?>/>
                                                    </div>                                            
                                                    <span class="help-block">（审核通过不予修改）</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">身份证图片</label>
                                                <div class="col-md-9">                                                                                                                                        
                                                    <input type="file" class="fileinput btn-primary" name="sfzzmtp" id="sfzzmtp" title="浏览文件" <?php if($smtj['username'] == $yhm){echo 'disabled="disabled"';} ?>/>
                                                    <span class="help-block">人像面（正面）</span>
                                                </div>
                                            </div>
											
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"></label>
                                                <div class="col-md-9">                                                                                                                                        
                                                    <input type="file" class="fileinput btn-primary" name="sfzfmtp" id="sfzfmtp" title="浏览文件" <?php if($smtj['username'] == $yhm){echo 'disabled="disabled"';} ?>/>
                                                    <span class="help-block">国徽面（反面）</span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">户籍所在地</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                                        <input id="hjszd" name="hjszd" type="text" class="form-control" value="<?php echo $_POST["hjszd"];?>" <?php if($smtj['username'] == $yhm){echo 'disabled="disabled"';} ?>/>
                                                    </div>                                            
                                                    <span class="help-block">（审核通过不予修改）</span>
                                                </div>
                                            </div>
                                                                                        
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">申请认证类型</label>
                                                <div class="col-md-9">                                                                                            
                                                    <div class="input-group">
													<span class="input-group-addon"><span class="glyphicon glyphicon-send"></span></span>
                                                    <select id="sqlx" name="sqlx" class="form-control select" <?php if($smtj['username'] == $yhm){echo 'disabled="disabled"';} ?>>
                                                        <option value="gr">个人商户</option>
                                                        <option value="qy">企业商户</option>
                                                    </select>
													</div>
                                                    <span class="help-block">下拉选择</span>
                                                </div>
                                            </div>
											
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">认证说明</label>
                                                <div class="col-md-9 col-xs-12">                                            
                                                    <textarea class="form-control" rows="5" disabled>
1、实名认证审核要多久？
	-提交审核后，运营人员会尽快进行审核，在1-3个工作日内会有审核结果。
2、提交资料后想修改资料可以吗？若提交认证失败会怎么样？
	-提交资料实名认证经审核后，若因资料错误或不符合要求等原因被拒绝后，可以再次提交认证。
3、实名审核过程中无法提现?
	-审核通过前或审核失败后，暂时无法提现。</textarea>
                                                    <span class="help-block">实名认证说明</span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"></label>
                                                <div class="col-md-9">                                                                                                                                        
                                                    <label class="check"><input type="checkbox" class="icheckbox" checked="checked"/> 我同意实名认证条款</label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>

                                </div>
                                <div class="panel-footer">
                                    <a name="tjrz" value="tjrz" id="go" onclick="tjrz()" class="btn btn-primary pull-right" <?php if($smtj['username'] == $yhm){echo 'disabled="disabled"';} ?>>提交认证</a>
                                </div>
                            </div>
                            </form>
                            
                        </div>
					
					<?php
						}
					?>
						</div>                    
                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
<div id="tishikuang" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">提示</h4>
      </div>
      <div class="modal-body">
        <p id="te"></p>
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->	
	<?php require "foot.php"; ?>
<script>  
	function tjrz(){
		var rzForm = new FormData(); 
		rzForm.append("tjrz","tjrz"); 
		rzForm.append("sfzxm",$('#sfzxm').val()); 
		rzForm.append("xingbie",$('#xingbie').val()); 
		rzForm.append("sfzhm",$('#sfzhm').val()); 
		rzForm.append("sfzdz",$('#sfzdz').val()); 
		rzForm.append("sfzzmtp",$('#sfzzmtp')[0].files[0]); 
		rzForm.append("sfzfmtp",$('#sfzfmtp')[0].files[0]); 
		rzForm.append("hjszd",$('#hjszd').val()); 
		rzForm.append("sqlx",$('#sqlx').val()); 
		$.ajax({
			url  : "",
			type : "POST",
			dataType : 'JSON', 
			data : rzForm,
			cache: false,
			processData: false,
			contentType: false,
			success:function(data){
						$('#tishikuang').modal();
						$('#te').html(data.te);
						if(data.ok){
							setTimeout(function(){
								window.location.reload();//页面刷新
							},2000);
						}
					},
			error:function(){
						alert("Err");
					}
        })
	}		
</script>  
</body>
</html>