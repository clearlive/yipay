<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["user"])){
		header("location:../login");
		exit;
	}
	$yh=$_SESSION["user"];
	if(!empty($_POST["xxid"])){
		$xxid=uhtml(check(trim($_POST["xxid"])));
		queryg(co_xiaoxi,"msg_yd='yes' where id='$xxid'");
		$xtxxx=queryall(co_xiaoxi,"where id='$xxid'");
		echo json_encode($xtxxx,true);
		exit;
	}
	if(@$_POST['action']=='qbyd'){
		queryg(co_xiaoxi,"msg_yd='yes' where to_user='$yh'");
		echo json_encode(array("ok"=>"ok"),true);
		exit;
	}
	if(!empty($_POST["id"])){
		$gg_id=uhtml(check(trim($_POST["id"])));
		$gg=queryall(co_gonggao,"where id='$gg_id'");
		echo json_encode($gg,true);
		exit;
	}
	$user=queryall(co_user_sys,"where user='$yh'");
	$dlips=queryall(co_denglu,"where username='$yh'");
	$jrsj=date("Y-m-d",time());//今日时间如：2018-01-21
	$jrje=queryall(co_dingdan,"where username='$yh' and ddzt='success' and ddsj like '%$jrsj%'","sum(ddje) as jrje");//今日成功金额
	if($jrje["jrje"] ==""){
		$jrje["jrje"]="0.00";
	}
	$jrdd=querydb(co_dingdan,"where username='$yh' and ddsj like '%$jrsj%'");//金额订单总数
	if($jrdd==""){
		$jrdd="0";
	}
	$jrcgdd=querydb(co_dingdan,"where username='$yh' and ddzt='success' and ddsj like '%$jrsj%'");//今日成功订单
	if($jrcgdd==""){
		$jrcgdd="0";
	}
	$yjsje=queryall(co_jiesuan,"where username='$yh' and jszt='yes'","sum(jsje) as yjsje");//提现成功金额
	if($yjsje["yjsje"] ==""){
		$yjsje["yjsje"]="0.00";
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>商户中心 - <?php echo $web["sitename"]; ?></title>            
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
                    <li class="active">主页</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    <!-- START WIDGETS -->                    
<div class="page-content-wrap">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<div class="row clearfix">
				<div class="col-md-8 column">
					<div class="row clearfix">
						<div class="col-md-12 column">
							<div class="alert alert-info">
								<a href="#" class="close" data-dismiss="alert">&times;</a><span class="fa fa-user"></span> 商户编号：<?php echo $user["id"]; ?>   上次登录时间：<?php echo $dlips["scdlsj"]; ?>  上次登录IP：<?php echo $dlips["scdlip"]; ?>  <a href="zl.php">查看详细</a>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-md-4 column">
                            <!-- START WIDGET SLIDER -->
                            <div class="widget widget-default widget-carousel">
                                <div class="owl-carousel" id="owl-example">
                                    <div>                                    
                                        <div class="widget-title">今日订单总数</div>
                                        <div class="widget-subtitle">------------------------------------------</div>
                                        <div class="widget-int"><?php echo $jrdd; ?> 单</div>
                                    </div>
                                    <div>                                    
                                        <div class="widget-title">今日成功订单</div>                                                                        
                                        <div class="widget-subtitle">------------------------------------------</div>
                                        <div class="widget-int"><?php echo $jrcgdd; ?> 单</div>
                                    </div>
                                    <div>                                    
                                        <div class="widget-title">今日成功金额</div>
                                        <div class="widget-subtitle">------------------------------------------</div>
                                        <div class="widget-int"><?php echo $jrje["jrje"]; ?> 元</div>
                                    </div>
                                </div>                            
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top"><span class="fa fa-times"></span></a>
                                </div>                             
                            </div>         
                            <!-- END WIDGET SLIDER -->
						</div>
						<div class="col-md-4 column">
                            <!-- START WIDGET MESSAGES -->
                            <div class="widget widget-default widget-item-icon" onclick="location.href='#';">
                                <div class="widget-item-left">
                                    <span class="fa fa-rmb"></span>
                                </div>                             
                                <div class="widget-data">
                                    <div class="widget-int">余额</div>
                                    <div class="widget-title"> <?php echo number_format($user["yue"],2,'.',''); ?> 元 </div>
                                    <div class="widget-subtitle">(未包括已申请提现金额)</div>
                                </div>      
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top"><span class="fa fa-times"></span></a>
                                </div>
                            </div>                            
                            <!-- END WIDGET MESSAGES -->
						</div>
						<div class="col-md-4 column">
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-default widget-item-icon" onclick="location.href='#';">
                                <div class="widget-item-left">
                                    <span class="fa fa-user"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int">提现</div>
                                    <div class="widget-title"><?php echo $yjsje["yjsje"]; ?> 元</div>
                                    <div class="widget-subtitle">(结算成功的金额)</div>
                                </div>
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top"><span class="fa fa-times"></span></a>
                                </div>                            
                            </div>                            
                            <!-- END WIDGET REGISTRED -->
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-md-12 column">
							<div class="list-group">
								 <a href="#" class="list-group-item active">功能快速通道</a>
								<div class="list-group-item">
									功能
								</div>
								<div class="list-group-item">
										<a class="list-group-item" data-toggle="tooltip" title="<?php echo $user["shiming"]=='yes'?"已实名":"未实名"; ?>" href="sm.php">
										<span class="glyphicon glyphicon-cog">
										</span>
										&nbsp;商户实名认证
										<span class="badge">
										<span class="glyphicon glyphicon-ok">
										</span>
										</span>
										</a>
								</div>
								<div class="list-group-item">
										<a class="list-group-item" data-toggle="tooltip" title="<?php echo $user["api"]=='yes'?"已开通":"未开通"; ?>" href="api.php">
										<span class="glyphicon glyphicon-cog">
										</span>
										&nbsp;商户 API 接入
										<span class="badge">
										<span class="glyphicon glyphicon-ok">
										</span>
										</span>
										</a>
								</div>
								<div class="list-group-item">
										<a class="list-group-item" data-toggle="tooltip" title="暂未开放">
										<span class="glyphicon glyphicon-cog">
										</span>
										&nbsp;代理商户模式
										<span class="badge">
										<span class="glyphicon glyphicon-ok">
										</span>
										</span>
										</a>
								</div>
								<div class="list-group-item">
								</div> <a class="list-group-item active"></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 column">
					<div class="row clearfix">
						<div class="col-md-12 column">
							<div class="list-group">
								 <a href="#" class="list-group-item active">网站公告</a>
								 <?php
									$ggsql=mysql_query("select * from co_gonggao");
									$i=0;
									while($gg=mysql_fetch_array($ggsql)){
										$i++;
										echo '<div onclick="gg('.$gg['id'].')" class="list-group-item"><a href="#" class="list-group-item">'.$i.' . '.$gg["title"].'</a></div>';
									}
								 ?>
								<a class="list-group-item active"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>                    <!-- END WIDGETS -->                    
                    
<div id="gg" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="bt"></h4>
      </div>
      <div class="modal-body" style="height:266px;" id="nr">      
      </div>
      <div class="modal-footer">
        <span style="float:left;" id="sj"></span>
        <button type="button" data-dismiss="modal" class="btn btn-primary">关闭</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->                        
                    <!-- START DASHBOARD CHART -->
					<div class="chart-holder" id="dashboard-area-1" style="height: 200px;"></div>
					<div class="block-full-width">
                                                                       
                    </div>                    
                    <!-- END DASHBOARD CHART -->

                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
		<script>
		function gg(id){
			$.ajax({
				type:"POST",
				dataType:"JSON",
				data:{
					id:id
				},
				url:"",
				success:function(data){
					$('#bt').html(data.title);
					$('#nr').html(data.content);
					$('#sj').html("发布时间："+data.time);
					$('#gg').modal();	
				},
				error:function(){
					alert("获取数据错误!");
				}
			})
		}
		</script>
		<?php require "foot.php"; ?>
    </body>
</html>






