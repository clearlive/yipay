<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["user"])){
		header("location:../login");
		exit;
	}
	$user=$_SESSION["user"];
	$userjk=queryall(co_user_sys,"where user='$user'");
?>
<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>接口费率 - 商户中心 - <?php echo $web["sitename"]; ?></title>            
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
                    <li><a href="#" class="active">支付通道</a></li>
                </ul>
                <!-- END BREADCRUMB -->                                                
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-fire"></span> 支付通道</h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    <div class="row">
                        <div class="col-md-12">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">支付通道</h3>                               
                                </div>
                                <div class="panel-body">
						<?php
							$sql=mysql_query("select * from co_api where status='yes'");
							while($td=mysql_fetch_array($sql)){
								if($td["status"] == 'yes'){
									$tdstatus="<span class='btn btn-info btn-xs'>已开启</span>";
								}else if($td["status"] == 'no'){
									$tdstatus="<span class='btn btn-danger btn-xs'>已关闭</span>";
								}
								echo '                        <div class="col-md-3">
                            <!-- CONTACT ITEM -->
                            <div class="panel panel-default">
                                <div class="panel-body profile">
                                    <div class="profile-image">
                                        <img src="'.$td["apiimg"].'" alt="'.$td["name"].'"/>
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name">'.$td["name"].'</div>
                                        <div class="profile-data-title">通道状态：<button type="button" class="btn btn-primary btn-xs">'.$tdstatus.'</button></div>
                                    </div>
                                    <div class="profile-controls">
                                        <a href="#" class="profile-control-left" data-toggle="tooltip" data-placement="right" title="'.$td["name"].'"><span class="fa fa-info"></span></a>
                                    </div>
                                </div>                                
                                <div class="panel-body">                                    
                                    <div class="contact-info">
									<div class="well">
                                        <p><small>通道信息：</small><br/></p><hr>
                                        <p><button type="button" class="btn">接口费率：'.$userjk['feilv'].'</button> | <button type="button" class="btn">接口代码：'.$td["apiname"].'</button> </p>                                        
                                        <p><div class="text-danger"><b>注意事项</b>：<i>'.$td["apism"].'</i></div></p>  
									</div>
                                    </div>
                                </div>                                
                            </div>
                            <!-- END CONTACT ITEM -->
                        </div>
';
							}
						?>		
                        <!--div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-body profile">
                                    <div class="profile-image">
                                        <img src="/static/images/qita.png" alt="其他"/>
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name">其他通道</div>
                                        <div class="profile-data-title">通道状态：<button type="button" class="btn btn-primary btn-xs"><span class='btn btn-danger btn-xs'>待添加</span></button></div>
                                    </div>
                                    <div class="profile-controls">
                                        <a href="#" class="profile-control-left"><span class="fa fa-info"></span></a>
                                    </div>
                                </div>                                
                                <div class="panel-body">                                    
                                    <div class="contact-info">
									<div class="well">
                                        <p><small>通道说明：</small><br/></p><hr>
                                        <p>接口费率： 无</p>                                       
                                        <p><div class="text-danger"><b>注意事项</b>：<i>无</i></div></p>  
									</div>
                                    </div>
                                </div>                                
                            </div>
                        </div-->
                                
                                </div>
                            </div>

                        </div>                   
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="pagination pagination-sm pull-right push-down-10 push-up-10">
                                <li class="disabled"><a href="#">«</a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">»</a></li>
                            </ul>                            
                        </div>
                    </div>

                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                                 
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

		<?php require "foot.php"; ?>
    </body>
</html>






