<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["admin"])){
		header("location:login.php");
		exit;
	}
	if(@$_POST['action']=='xgddpz'){//修改掉单配置
		if(empty($_POST['ddstatus']) or strlen($_POST['ddstatus'])>3 or !iszm($_POST['ddstatus'])){//掉单状态
			echo json_encode(array("te"=>"掉单状态错误"));
			exit;
		}else if($_POST['ddkssj']>=24 or strlen($_POST['ddkssj'])>2 or !issz($_POST['ddkssj'])){//掉单开始时间
			echo json_encode(array("te"=>"掉单开始时间错误"));
			exit;
		}else if($_POST['ddjssj']>=24 or strlen($_POST['ddjssj'])>2 or !issz($_POST['ddjssj'])){//掉单结束时间
			echo json_encode(array("te"=>"掉单结束时间错误"));
			exit;
		}else if(empty($_POST['ddsksje']) or strlen($_POST['ddsksje'])>5 or !issz($_POST['ddsksje'])){//掉单最低金额
			echo json_encode(array("te"=>"掉单最低金额错误"));
			exit;
		}else if(empty($_POST['ddsjsje']) or strlen($_POST['ddsjsje'])>5 or !issz($_POST['ddsjsje'])){//掉单最高金额
			echo json_encode(array("te"=>"掉单最高金额错误"));
			exit;
		}else if(empty($_POST['ddbfbjl']) or $_POST['ddbfbjl']>100 or strlen($_POST['ddbfbjl'])>3 or !issz($_POST['ddbfbjl'])){//掉单几率
			echo json_encode(array("te"=>"掉单率错误"));
			exit;
		}
		$ddstatus=uhtml(check(trim($_POST["ddstatus"])));//掉单状态
		$ddkssj=uhtml(check(trim($_POST["ddkssj"])));//掉单开始时间
		$ddjssj=uhtml(check(trim($_POST["ddjssj"])));//掉单结束时间
		$ddsksje=uhtml(check(trim($_POST["ddsksje"])));//掉单最低金额
		$ddsjsje=uhtml(check(trim($_POST["ddsjsje"])));//掉单最高金额
		$ddbfbjl=uhtml(check(trim($_POST["ddbfbjl"])));//掉单几率
		queryg(co_system,"ddstatus='$ddstatus',ddkssj='$ddkssj',ddjssj='$ddjssj',ddsksje='$ddsksje',ddsjsje='$ddsjsje',ddbfbjl='$ddbfbjl'");
		echo json_encode(array("te"=>"修改成功！","ok"=>"ok"),true);
		exit;
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>掉单设置 - 系统后台 -<?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 掉单设置 <small>v 2.0</small></div>
                        <p class="page-header-description"></p>
                    </div>
                </div>

            </div>

            <div class="row-content am-cf">
                <div class="row am-cf">
<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">掉单规则</font></font></div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">
                                <form class="am-form tpl-form-border-form">
									<div class="am-form-group">
                                        <label for="user-intro" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">掉单开关：</font></font></label>
                                        <div class="am-u-sm-9">
                                            <div class="tpl-switch">
                                                <input type="checkbox" id="ddstatus" onclick="qiehuan(this)" value="" class="ios-switch bigswitch tpl-switch-btn" <?php if($web['ddstatus']=="yes"){echo "checked";}?>>
                                                <div class="tpl-switch-btn-view">
                                                    <div>
                                                    </div>
                                                </div>
                                            </div>
											<small><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">俗称“黑单”：当商户提交订单并付款时不记录该订单，金额归平台所有！(慎重)</font></font></small>
                                        </div>
                                    </div>
									<div class="am-form-group"  id="qhddkssj" <?php if($web['ddstatus']=="no"){echo "hidden";}?>>
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">开始时间：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="ddkssj" placeholder="掉单时间段开始时间（开始掉单）" value="<?php echo $web['ddkssj']; ?>">
                                        </div>
                                    </div>
									<div class="am-form-group" id="qhddjssj" <?php if($web['ddstatus']=="no"){echo "hidden";}?>>
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">结束时间：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="ddjssj" placeholder="掉单时间段结束时间（超过不掉单）" value="<?php echo $web['ddjssj']; ?>">
                                        </div>
                                    </div>
									<div class="am-form-group" id="qhddsksje" <?php if($web['ddstatus']=="no"){echo "hidden";}?>>
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">起始金额：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="ddsksje" placeholder="最低从此金额开始掉单" value="<?php echo $web['ddsksje']; ?>">
                                        </div>
                                    </div>
									<div class="am-form-group" id="qhddsjsje" <?php if($web['ddstatus']=="no"){echo "hidden";}?>>
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">结束金额：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="ddsjsje" placeholder="最高达到此金额时不掉单" value="<?php echo $web['ddsjsje']; ?>">
                                        </div>
                                    </div>
									<div class="am-form-group" id="qhddbfbjl" <?php if($web['ddstatus']=="no"){echo "hidden";}?>>
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">掉单几率：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="ddbfbjl" placeholder="输入1-100的整数几率（百分比）" value="<?php echo $web['ddbfbjl']; ?>">
                                        </div>
                                    </div>
									<div class="am-u-sm-9 am-u-sm-push-3">
										<button type="button" onclick="xgddgz()" class="am-btn am-btn-primary tpl-btn-bg-color-success ">保存设置</button>
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
<div class="am-modal am-modal-confirm" tabindex="-1" id="xgddgzmodal">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">掉单规则（黑单）</div>
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
	function xgddgz(){//更改掉单配置
		if($("#ddstatus").is(":checked")){//注册开关
			$("#ddstatus").val("yes");
		}else{
			$("#ddstatus").val("no");
		}
		if($("#ddstatus").is(":checked")){//接口开关
			$("#ddstatus").val("yes");
		}else{
			$("#apistatus").val("no");
		}
		$('#xgddgzmodal').modal({
			onConfirm:function(){
				$.ajax({
					url:'',
					data:{
						ddstatus:$('#ddstatus').val(),
						ddkssj:$('#ddkssj').val(),
						ddjssj:$('#ddjssj').val(),
						ddsksje:$('#ddsksje').val(),
						ddsjsje:$('#ddsjsje').val(),
						ddbfbjl:$('#ddbfbjl').val(),
						action:'xgddpz',
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
	function qiehuan(obj){//检测掉单选择按钮
		if(obj.checked){
			$('#qhddkssj').show();
			$('#qhddjssj').show();
			$('#qhddsksje').show();
			$('#qhddsjsje').show();
			$('#qhddbfbjl').show();
		}else{
			$('#qhddkssj').hide();
			$('#qhddjssj').hide();
			$('#qhddsksje').hide();
			$('#qhddsjsje').hide();
			$('#qhddbfbjl').hide();
		};
	}
</script>
<script type="text/javascript">
$(function(){
	$('#jhhxpz').addClass('active');
	$("#jhhxpzlb").css("display","block");
	$('#jhddsz').addClass('sub-active');

})
</script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>