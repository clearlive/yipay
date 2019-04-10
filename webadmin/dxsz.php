<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["admin"])){
		header("location:login.php");
		exit;
	}
	if(@$_POST['action']=='xgdx'){//修改邮箱
		if(empty($_POST['smsid']) or strlen($_POST['smsid'])>16 or !isszzm($_POST['smsid'])){
			echo json_encode(array("te"=>"AccessKeyId错误"));
			exit;
		}else if(empty($_POST['smskey']) or strlen($_POST['smskey'])>30 or !isszzm($_POST['smskey'])){
			echo json_encode(array("te"=>"AccessKeySecret错误"));
			exit;
		}else if(empty($_POST['smsqm']) or strlen($_POST['smsqm'])>30){
			echo json_encode(array("te"=>"签名名称错误"));
			exit;
		}else if(empty($_POST['smsmb']) or strlen($_POST['smsmb'])>30 or !isszzmxhx($_POST['smsmb'])){
			echo json_encode(array("te"=>"短信模板错误"));
			exit;
		}
		$smsid=uhtml(check(trim($_POST["smsid"])));
		$smskey=uhtml(check(trim($_POST["smskey"])));
		$smsqm=uhtml(check(trim($_POST["smsqm"])));
		$smsmb=uhtml(check(trim($_POST["smsmb"])));
		queryg(co_system,"smsid='$smsid',smskey='$smskey',smsqm='$smsqm',smsmb='$smsmb'");
		echo json_encode(array("te"=>"修改成功！","ok"=>"ok"),true);
		exit;
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>短信设置 - 系统后台 -<?php echo $web["sitename"]; ?></title>
    <meta name="description" content="聚合支付V2.0">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="/favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="聚合支付V2.0" />
    <script src="assets/js/echarts.min.js"></script>
    <link rel="stylesheet" href="assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="assets/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" href="assets/css/app.css">
    <script src="assets/js/jquery.min.js"></script>

</head>

<body data-type="index">
    <script src="assets/js/theme.js"></script>
    <div class="am-g tpl-g">
	<?php require_once "header.php"; ?>
        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">

            <div class="container-fluid am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 短信设置 <small>v 2.0</small></div>
                        <p class="page-header-description"></p>
                    </div>
                </div>

            </div>

            <div class="row-content am-cf">
                <div class="row am-cf">
<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">阿里云短信</font></font></div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">
                                <form class="am-form tpl-form-border-form">
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">接口ＩＤ：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="smsid" placeholder="accessKeyId" value="<?php echo $web['smsid']; ?>">
                                        </div>
                                    </div> 
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">接口密匙：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="smskey" placeholder="accessKeySecret" value="<?php echo $web['smskey']; ?>">
                                        </div>
                                    </div>
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">短信签名：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="smsqm" placeholder="签名名称" value="<?php echo $web['smsqm']; ?>">
                                        </div>
                                    </div>
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">短信模板：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="smsmb" placeholder="模板代码" value="<?php echo $web['smsmb']; ?>">
                                        </div>
                                    </div>
									<div class="am-u-sm-9 am-u-sm-push-3">
										<button type="button" onclick="xgyx()" class="am-btn am-btn-primary tpl-btn-bg-color-success ">保存设置</button>
									</div>
								</form>
                            </div>
                        </div>
                    </div>
				</div>
            </div>
        </div>
    </div>
    </div>

<!-----修改邮箱----->
<div class="am-modal am-modal-confirm" tabindex="-1" id="dxmodal">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">短信配置</div>
    <div class="am-modal-bd">
      保存这次的设置吗？
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>确定</span>
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!-----修改邮箱----->

<!-----提示框----->
<div id="ts" class="am-modal am-modal-alert" tabindex="-1">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">提示</div>
    <div class="am-modal-bd" id="te">
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn">确定</span>
    </div>
  </div>
</div>

<!-----提示框OUT----->
<script>	
	function xgyx(){//更改
		$('#dxmodal').modal({
			onConfirm:function(){
				$.ajax({
					url:'',
					data:{
						smsid:$('#smsid').val(),
						smskey:$('#smskey').val(),
						smsqm:$('#smsqm').val(),
						smsmb:$('#smsmb').val(),
						action:'xgdx',
					},
					type:'POST',
					dataType:'JSON',
					success:function(data){
						$('#ts').modal();
						$('#te').html(data.te);
						if(data.ok){
							setTimeout(function(){
								window.location.reload();//刷新页面
							},1000);
						}
					},
					error:function(){
						$('#ts').modal();
						$('#te').html('获取数据错误');
					}
				})
			}
		});
	}	
</script>
<script type="text/javascript">
$(function(){
	$('#jhhxpz').addClass('active');
	$("#jhhxpzlb").css("display","block");
	$('#jhdxsz').addClass('sub-active');

})
</script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>