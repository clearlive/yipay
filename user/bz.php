<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["user"])){
		header("location:../login");
		exit;
	}
	$yhm=$_SESSION["user"];
	if(@$_POST['action']=='tijiao'){//问题反馈
		if(empty($_POST['biaoti']) or strlen($_POST['biaoti'])>36){
			echo json_encode(array("te"=>"标题错误"));
			exit;
		}else if(empty($_POST['neirong']) or strlen($_POST['neirong'])>300){
			echo json_encode(array("te"=>"内容错误"));
			exit;
		}else if($_POST['fkyzm']!=$_SESSION["yzm"]){
			$_SESSION["yzm"]=null;
			echo json_encode(array("te"=>"验证码错误"));
			exit;
		}
		$_SESSION["yzm"]=null;
		if(querydb(co_fankui,"where fkyh='$yhm' and yd='no'")>=2){
			echo json_encode(array("te"=>"你前面还有2反馈未处理，过段时间再提交吧！"),true);
			exit;
		}
		$biaoti=addslashes(uhtml(check(trim($_POST["biaoti"]))));
		$neirong=addslashes(uhtml(check(trim($_POST["neirong"]))));
		$fksj=date("Y-m-d H:i:s",time());
		queryz(co_fankui,"fkyh,fkbt,fkxq,fksj,yd","'$yhm','$biaoti','$neirong','$fksj','no'");
		echo json_encode(array("te"=>"提交成功,我们会尽快回复您！","ok"=>"ok"),true);
		exit;
	}
?>
<!DOCTYPE html>
<html lang="ch">
    <head>        
        <!-- META SECTION -->
        <title>帮助中心 - 商户中心 - <?php echo $web["sitename"]; ?></title>            
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
                    <li class="active">帮助中心</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-group"></span> 帮助中心</h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<div class="row clearfix">
				<div class="col-md-7 column">
					<div class="row clearfix">
						<div class="col-md-12 column">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">服务端SDK下载</h3>                               
                                </div>
                                <div class="panel-body">
									<div class="row">
										<div class="col-sm-4 col-md-3">
											<div class="thumbnail" style="border:0px">
												<img width="128px" class="img-thumbnail" src="/user/img/php.png" alt="...">
												<br>
												<center><a href="/sdkdownload/php.rar" class="btn btn-info">下载SDK</a></center>
											</div>
										</div>
										<div class="col-sm-4 col-md-3">
											<div class="thumbnail" style="border:0px">
												<img width="128px" class="img-thumbnail" src="/user/img/asp.png" alt="...">
												<br>
												<center><a href="/sdkdownload/asp.rar" class="btn btn-info">下载SDK</a></center>
											</div>
										</div>
										<div class="col-sm-4 col-md-3">
											<div class="thumbnail" style="border:0px">
												<img width="128px" class="img-thumbnail" src="/user/img/aspx.png" alt="...">
												<br>
												<center><a onclick="javaScript:alert('暂未提供');" class="btn btn-info">下载SDK</a></center>
											</div>
										</div>
										<div class="col-sm-4 col-md-3">
											<div class="thumbnail" style="border:0px">
												<img width="128px" class="img-thumbnail" src="/user/img/jsp.png" alt="...">
												<br>
												<center><a onclick="javaScript:alert('暂未提供');" class="btn btn-info">下载SDK</a></center>
											</div>
										</div>
									</div>
								</div>
                            </div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-md-6 column">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">其他SDK下载</h3>                               
                                </div>
                                <div class="panel-body">
									<div class="row">
										<div class="col-sm-4 col-md-6">
											<div class="thumbnail" style="border:0px">
												<img width="128px" class="img-thumbnail" src="/user/img/anzhuo.png" alt="...">
												<br>
												<center><a onclick="javaScript:alert('暂未提供');" class="btn btn-info">下载SDK</a></center>
											</div>
										</div>
										<div class="col-sm-4 col-md-6">
											<div class="thumbnail" style="border:0px">
												<img width="128px" class="img-thumbnail" src="/user/img/IOS.png" alt="...">
												<br>
												<center><a onclick="javaScript:alert('暂未提供');" class="btn btn-info">下载SDK</a></center>
											</div>
										</div>
									</div>
								</div>
                            </div>
						</div>
						<div class="col-md-6 column">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">联系客服</h3>                               
                                </div>
                                <div class="panel-body">
									<div class="row">
										<div class="col-sm-6 col-md-6">
											<div class="thumbnail">
												<img width="128px" src="/user/img/kefu.png" alt="...">
												<center>
													<div class="caption">
													<h3>在线客服</h3>
													</div>
												</center>
											</div>
										</div>
										<div class="col-md-6">
											<a href="#" class="btn btn-default" role="button">ＱＱ:</a><?php echo $web['siteqq']; ?>
											<br>
											<hr>
											<a href="#" class="btn btn-default" role="button">微信:</a><?php echo $web['siteweixin']; ?>
											<br>
											<hr>
											<a href="#" class="btn btn-default" role="button">电话:</a><?php echo $web['sitephone']; ?>
											<br>
											<hr>
										</div>
									</div>
								</div>
                            </div>
						</div>
					</div>
				</div>
				<div class="col-md-5 column">
					<div class="row clearfix">
						<div class="col-md-12 column">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">问题反馈</h3>                               
                                </div>
                                <div class="panel-body">
									<div class="alert alert-success" role="alert">如果你在使用本平台服务过程中遇到问题，请反馈给我们！</div>
									<form class="col-md-8">
										<div class="form-group">
											<label>提交用户：</label>
											<input type="text" class="form-control" id="yonghu" value="<?php echo $_SESSION['user']; ?>" disabled>
											<span class="help-block">--我们将第一时间回复您</span>
										</div>
										<div class="form-group">
											<label>标题：</label>
											<input type="text" class="form-control" id="biaoti" placeholder="请输入12字内标题">
											<span class="help-block">--简单标题</span>
										</div>
										<div class="form-group">
											<label>问题详情：</label>
											<textarea class="form-control" id="neirong" rows="6" placeholder="请输入100字内问题详情"></textarea>
											<span class="help-block">--请尽量精简明了说明问题</span>
										</div>
										<div class="input-group">
											<a style="background-color:white;border:0px;" class="input-group-addon" href="javascript:void(0)" onclick="document.getElementById('verifyimg').src='/Config/Verify.php?r='+Math.random()"><img id="verifyimg" alt="点击切换" src="/Config/Verify.php?r=<?php echo rand(); ?>"></a>
											<input type="text" id="fkyzm" class="form-control" placeholder="验证码" aria-describedby="basic-addon1">
										</div>
										<hr>
										<button onclick="tijiao()" type="button" class="btn btn-default">提交</button>（系统最多同时处理单个用户2条反馈！）
									</form> 
                               </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>                    <!-- END WIDGETS -->                    
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
			function tijiao(){//提交反馈
				$.ajax({
					url:'',
					data:{
						biaoti:$('#biaoti').val(),
						neirong:$('#neirong').val(),
						fkyzm:$('#fkyzm').val(),
						action:'tijiao',
					},
					type:'POST',
					dataType:'JSON',
					success:function(data){
						$('#te').html(data.te);
						$('#tishikuang').modal();
						if(data.ok){
							setTimeout(function(){
								window.location.reload();//刷新页面
							},1000);
						}
					},
					error:function(){
						$('#te').html("获取数据失败");
						$('#tishikuang').modal();
					}
				})
			}
		</script>
        
    </body>
</html>






