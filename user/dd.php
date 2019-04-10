<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["user"])){
		header("location:../login");
		exit;
	}
	if(!empty($_POST["ddh"])){
		$xq_ddh=uhtml(check(trim($_POST["ddh"])));
		if(!isszzm($xq_ddh)){
			exit;
		}
		$ddxq=queryall(co_dingdan,"where ddh='$xq_ddh'");
		echo json_encode($ddxq,true);
		exit;
	}
	//被动执行订单状态更改
	$dqxtsj=time();
	queryg(co_dingdan,"ddzt='fail',ddtzzt='订单已失效' where ddzt='wait' and ddsxsj < '$dqxtsj'");

?>
<!DOCTYPE html>
<html lang="ch">
    <head>        
        <!-- META SECTION -->
        <title>订单记录 - 商户中心 - <?php echo $web["sitename"]; ?></title>            
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
                    <li class="active">订单记录</li>
                </ul>
                <!-- END BREADCRUMB -->

                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-building-o"></span> 订单记录</h2>
                </div>
                <!-- END PAGE TITLE -->                

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">                
                
                    <div class="row">
                        <div class="col-md-12">

                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title">所有交易订单</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body">
                                    <table class="table datatable table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>订单号</th>
                                                <th>处理时间</th>
                                                <th>通道</th>
                                                <th>金额</th>
                                                <th>所得金额</th>
                                                <th>状态</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
											<?php
												$ur=$_SESSION["user"];
												$sql=mysql_query("select * from co_dingdan where username='$ur' ORDER BY id DESC");
												while($dd=mysql_fetch_assoc($sql)){
													if($dd['ddzt'] == 'success'){
														$ddzt="<span class='btn btn-success btn-xs'>成功</span>";
													}else if($dd['ddzt'] == 'fail'){
														$ddzt="<span class='btn btn-danger btn-xs'>待付</span>";
													}else if($dd['ddzt'] == 'wait'){
														$ddzt="<span class='btn btn-warning btn-xs'>等待</span>";
													}
													echo '<tr><td>'.$dd['ddh'].'</td>
														<td>'.$dd['ddsj'].'</td>
														<td>'.$dd['ddtdmc'].'</td>
														<td>'.$dd['ddje'].'</td>
														<td>'.$dd['sdje'].'</td>
														<td>'.$ddzt.'</td>
														<td><a id="ddh"href="javascript:;" class="btn btn-default btn-xs" title="订单详情" onclick="xq('; ?><?php echo "'".$dd['ddh']."'"; ?><?php echo ')">详情</a>&nbsp;<a href="javascript:;" class="btn btn-default btn-xs" title="订单通知" onclick="tz('; ?><?php echo "'".$dd['ddh']."'"; ?><?php echo ')">通知</a></td></tr>';
												}
											?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END DEFAULT DATATABLE -->


                        </div>
                    </div>                                
                    
                </div>
                <!-- PAGE CONTENT WRAPPER -->                                
            </div>    
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->       
<!-- Modal -->
<div class="modal fade" id="xq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">订单详情</h4>
      </div>
      <div class="modal-body">
		<table class="table table-bordered table-striped">
			<tbody>
			<tr>
			<td class="col-md-2 title">平台订单号</td><td class="col-md-10" id="ddxq_ddh"></td>
			</tr>
			<tr>
			<td>商户订单号</td><td id="ddxq_shddh"></td>
			</tr>
			<tr>
			<td>提交时间</td><td id="ddxq_ddsj"></td>
			</tr>
			<tr>
			<td>订单金额</td><td id="ddxq_ddje"></td>
			</tr>
			<tr>
			<td>所得金额</td><td id="ddxq_sdje"></td>
			</tr>
			<tr>
			<td>支付通道</td><td id="ddxq_ddtdmc"></td>
			</tr>
			<tr>
			<td>支付状态</td><td id="ddxq_ddzt"></td>
			</tr>
			<tr>
			<td>订单名称</td><td id="ddxq_shddmc"></td>
			</tr>
			<tr>
			<td>订单备注</td><td id="ddxq_shddbz"></td>
			</tr>
			<tr>
			<td>跳转地址</td><td id="ddxq_ddtbtz"></td>
			</tr>
			<tr>
			<td>通知地址</td><td id="ddxq_ddybtz"></td>
			</tr>
			<tr>
			<td>订单通知状态</td><td id="ddxq_ddtzzt"></td>
			</tr>
			</tbody>
		</table>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="tz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">订单通知详情</h4>
      </div>
      <div class="modal-body">
		<pre><b>通知状态:</b><span id="ddxq_tzzt"></span></pre>
		<pre><b>通知地址:</b><span id="ddxq_tzdz"></span></pre>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
		<?php require "foot.php"; ?>
        <script type="text/javascript" src="js/dd.js"></script>    
        
    </body>
</html>



