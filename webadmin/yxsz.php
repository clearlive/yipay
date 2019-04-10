<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["admin"])){
		header("location:login.php");
		exit;
	}
	if(@$_POST['action']=='xgyx'){//修改邮箱
		if(empty($_POST['yxfwq']) or strlen($_POST['yxfwq'])>20){
			echo json_encode(array("te"=>"邮箱服务器错误"));
			exit;
		}else if(empty($_POST['yxdk']) or strlen($_POST['yxdk'])>6){
			echo json_encode(array("te"=>"邮箱端口错误"));
			exit;
		}else if(empty($_POST['yxbm']) or strlen($_POST['yxbm'])>6){
			echo json_encode(array("te"=>"邮箱编码错误"));
			exit;
		}else if(empty($_POST['yxdz']) or strlen($_POST['yxdz'])>30){
			echo json_encode(array("te"=>"邮箱地址错误"));
			exit;
		}else if(empty($_POST['yxnc']) or strlen($_POST['yxnc'])>20){
			echo json_encode(array("te"=>"邮箱昵称错误"));
			exit;
		}else if(empty($_POST['yxyhm']) or strlen($_POST['yxyhm'])>30){
			echo json_encode(array("te"=>"邮箱用户名错误"));
			exit;
		}else if(empty($_POST['yxmm']) or strlen($_POST['yxmm'])>30){
			echo json_encode(array("te"=>"邮箱密码错误"));
			exit;
		}
		$yxfwq=uhtml(check(trim($_POST["yxfwq"])));
		$yxdk=uhtml(check(trim($_POST["yxdk"])));
		$yxbm=uhtml(check(trim($_POST["yxbm"])));
		$yxdz=uhtml(check(trim($_POST["yxdz"])));
		$yxnc=uhtml(check(trim($_POST["yxnc"])));
		$yxyhm=uhtml(check(trim($_POST["yxyhm"])));
		$yxmm=uhtml(check(trim($_POST["yxmm"])));
		queryg(co_system,"yxfwq='$yxfwq',yxdk='$yxdk',yxbm='$yxbm',yxdz='$yxdz',yxnc='$yxnc',yxyhm='$yxyhm',yxmm='$yxmm'");
		echo json_encode(array("te"=>"修改成功！","ok"=>"ok"),true);
		exit;
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>邮箱设置 - 系统后台 -<?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 邮箱设置 <small>v 2.0</small></div>
                        <p class="page-header-description"></p>
                    </div>
                </div>

            </div>

            <div class="row-content am-cf">
                <div class="row am-cf">
<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">配置邮箱</font></font></div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">
                                <form class="am-form tpl-form-border-form">
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">邮箱服务器：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="yxfwq" placeholder="如：smtp.qq.com" value="<?php echo $web['yxfwq']; ?>">
                                        </div>
                                    </div> 
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">端口：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="yxdk" placeholder="25或465" value="<?php echo $web['yxdk']; ?>">
                                        </div>
                                    </div>
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">发送编码：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="yxbm" placeholder="UTF-8或GBK" value="<?php echo $web['yxbm']; ?>">
                                        </div>
                                    </div>
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">发件人地址：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="yxdz" placeholder="你的邮箱" value="<?php echo $web['yxdz']; ?>">
                                        </div>
                                    </div>
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">发件人昵称：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="yxnc" placeholder="发件人姓名" value="<?php echo $web['yxnc']; ?>">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">验证用户名：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="yxyhm" placeholder="登陆的用户名" value="<?php echo $web['yxyhm']; ?>">
                                        </div>
                                    </div>
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">验证密码：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="password" class="tpl-form-input" id="yxmm" placeholder="邮箱密码">
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
<div class="am-modal am-modal-confirm" tabindex="-1" id="xgyxmodal">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">修改邮箱</div>
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
		$('#xgyxmodal').modal({
			onConfirm:function(){
				$.ajax({
					url:'',
					data:{
						yxfwq:$('#yxfwq').val(),
						yxdk:$('#yxdk').val(),
						yxbm:$('#yxbm').val(),
						yxdz:$('#yxdz').val(),
						yxnc:$('#yxnc').val(),
						yxyhm:$('#yxyhm').val(),
						yxmm:$('#yxmm').val(),
						action:'xgyx',
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
	$('#jhyxsz').addClass('sub-active');

})
</script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>