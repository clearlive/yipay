<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["admin"])){
		header("location:login.php");
		exit;
	}
	if(@$_POST['action']=='jbpz'){//修改基本配置
		if(empty($_POST['sitename']) or strlen($_POST['sitename'])>50){
			echo json_encode(array("te"=>"网站名称不规范"));
			exit;
		}else if(empty($_POST['siteurl']) or strlen($_POST['siteurl'])>20){
			echo json_encode(array("te"=>"网站地址不规范"));
			exit;
		}else if(empty($_POST['sitemail']) or strlen($_POST['sitemail'])>20){
			echo json_encode(array("te"=>"网站邮箱不规范"));
			exit;
		}else if(empty($_POST['sitecom']) or strlen($_POST['sitecom'])>60){
			echo json_encode(array("te"=>"公司名称不规范"));
			exit;
		}else if(empty($_POST['sitephone']) or strlen($_POST['sitephone'])>15){
			echo json_encode(array("te"=>"联系电话不规范"));
			exit;
		}else if(empty($_POST['siteqq']) or !issz($_POST['siteqq'])){
			echo json_encode(array("te"=>"联系QQ不规范"));
			exit;
		}else if(empty($_POST['siteweixin']) or !isszzmxhx($_POST['siteweixin'])){
			echo json_encode(array("te"=>"联系微信不规范"));
			exit;
		}else if(empty($_POST['sitebeian']) or strlen($_POST['sitebeian'])>30){
			echo json_encode(array("te"=>"备案号不规范"));
			exit;
		}else if(empty($_POST['sitestatus']) or strlen($_POST['sitestatus'])>3 or !iszm($_POST['sitestatus'])){
			echo json_encode(array("te"=>"网站状态错误"));
			exit;
		}
		$sitename=uhtml(check(trim($_POST["sitename"])));
		$siteurl=uhtml(check(trim($_POST["siteurl"])));
		$sitemail=uhtml(check(trim($_POST["sitemail"])));
		$sitecom=uhtml(check(trim($_POST["sitecom"])));
		$sitephone=uhtml(check(trim($_POST["sitephone"])));
		$siteqq=uhtml(check(trim($_POST["siteqq"])));
		$siteweixin=uhtml(check(trim($_POST["siteweixin"])));
		$sitebeian=uhtml(check(trim($_POST["sitebeian"])));
		$sitestatus=uhtml(check(trim($_POST["sitestatus"])));
		queryg(co_system,"sitename='$sitename',siteurl='$siteurl',sitemail='$sitemail',sitecom='$sitecom',sitephone='$sitephone',siteqq='$siteqq',siteweixin='$siteweixin',sitebeian='$sitebeian',sitestatus='$sitestatus'");
		echo json_encode(array("te"=>"修改成功！","ok"=>"ok"),true);
		exit;
	}
	
	if(@$_POST['action']=='hxpz'){//修改核心配置
		if(empty($_POST['regstatus']) or strlen($_POST['regstatus'])>3 or !iszm($_POST['regstatus'])){
			echo json_encode(array("te"=>"注册状态不规范"));
			exit;
		}else if(empty($_POST['regfs']) or strlen($_POST['regfs'])!==4 or !iszm($_POST['regfs'])){
			echo json_encode(array("te"=>"注册方式不规范"));
			exit;
		}else if(empty($_POST['apistatus']) or strlen($_POST['apistatus'])>3 or !iszm($_POST['apistatus'])){
			echo json_encode(array("te"=>"接口状态不规范"));
			exit;
		}else if(empty($_POST['ddyxq']) or strlen($_POST['ddyxq'])>5 or !issz($_POST['ddyxq'])){
			echo json_encode(array("te"=>"订单有效期错误"));
			exit;
		}else if(empty($_POST['zdje']) or strlen($_POST['zdje'])>5 or !isszxsd($_POST['zdje'])){
			echo json_encode(array("te"=>"订单最低金额错误"));
			exit;
		}else if(empty($_POST['zgje']) or strlen($_POST['zgje'])>8 or !isszxsd($_POST['zgje'])){
			echo json_encode(array("te"=>"订单最高金额错误"));
			exit;
		}else if(empty($_POST['ptddmc']) or strlen($_POST['ptddmc'])>30 or !ishzzm($_POST['ptddmc'])){
			echo json_encode(array("te"=>"平台订单名称错误"));
			exit;
		}else if(empty($_POST['zdtxje']) or strlen($_POST['zdtxje'])>10 or !isszxsd($_POST['zdtxje'])){
			echo json_encode(array("te"=>"最低提现金额错误"));
			exit;
		}else if(empty($_POST['txsxf']) or strlen($_POST['txsxf'])>7 or !isszxsd($_POST['txsxf'])){
			echo json_encode(array("te"=>"提现手续费率错误"));
			exit;
		}else if($_POST['txbdsxf']!=null){
			if(empty($_POST['txbdsxf']) or strlen($_POST['txbdsxf'])>7 or !isszxsd($_POST['txbdsxf'])){
				echo json_encode(array("te"=>"保底提现金额错误"));
				exit;
			}
		}else{
			$_POST['txbdsxf']='0';
		}
		$regstatus=uhtml(check(trim($_POST["regstatus"])));
		$regfs=uhtml(check(trim($_POST["regfs"])));
		$apistatus=uhtml(check(trim($_POST["apistatus"])));
		$ddyxq=uhtml(check(trim($_POST["ddyxq"])));
		$zdje=uhtml(check(trim($_POST["zdje"])));
		$zgje=uhtml(check(trim($_POST["zgje"])));
		$ptddmc=uhtml(check(trim($_POST["ptddmc"])));
		$zdtxje=uhtml(check(trim($_POST["zdtxje"])));
		$txsxf=uhtml(check(trim($_POST["txsxf"])));
		$txbdsxf=uhtml(check(trim($_POST["txbdsxf"])));
		queryg(co_system,"regstatus='$regstatus',regfs='$regfs',apistatus='$apistatus',ddyxq='$ddyxq',zdje='$zdje',ptddmc='$ptddmc',zgje='$zgje',zdtxje='$zdtxje',txsxf='$txsxf',txbdsxf='$txbdsxf'");
		echo json_encode(array("te"=>"修改成功！","ok"=>"ok"),true);
		exit;
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>系统配置 - 系统后台 -<?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 系统配置 <small>v 2.0</small></div>
                        <p class="page-header-description"></p>
                    </div>
                </div>

            </div>

            <div class="row-content am-cf">
                <div class="row am-cf">
					<div class="am-u-sm-12 am-u-md-12 am-u-lg-6">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">基本配置</font></font></div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">
                                <form class="am-form tpl-form-border-form">
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网站名称：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="sitename" placeholder="如：聚合支付" value="<?php echo $web['sitename']; ?>">
                                        </div>
                                    </div> 
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网站URL：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="siteurl" placeholder="如：http://www.123.com 最后不带/" value="<?php echo $web['siteurl']; ?>">
                                        </div>
                                    </div>
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网站邮箱：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="sitemail" placeholder="如：admin@qq.com" value="<?php echo $web['sitemail']; ?>">
                                        </div>
                                    </div>
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">公司名称：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="sitecom" placeholder="如：天亿网络科技有限公司" value="<?php echo $web['sitecom']; ?>">
                                        </div>
                                    </div>
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">联系电话：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="sitephone" placeholder="网站联系电话（帮助中心/首页）" value="<?php echo $web['sitephone']; ?>">
                                        </div>
                                    </div>
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">联系ＱＱ：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="siteqq" placeholder="网站联系QQ（帮助中心）" value="<?php echo $web['siteqq']; ?>">
                                        </div>
                                    </div>
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">联系微信：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="siteweixin" placeholder="网站联系微信（帮助中心）" value="<?php echo $web['siteweixin']; ?>">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">备案编号：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="sitebeian" placeholder="网站的备案号" value="<?php echo $web['sitebeian']; ?>">
                                        </div>
                                    </div>
									<div class="am-form-group">
                                        <label for="user-intro" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网站开关：</font></font></label>
                                        <div class="am-u-sm-9">
                                            <div class="tpl-switch">
                                                <input type="checkbox" id="sitestatus" value="" class="ios-switch bigswitch tpl-switch-btn" <?php if($web['sitestatus']=="yes"){echo "checked";}?>>
                                                <div class="tpl-switch-btn-view">
                                                    <div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
									 <div class="am-u-sm-9 am-u-sm-push-3">
										<button type="button" onclick="xgjbpz()" class="am-btn am-btn-primary tpl-btn-bg-color-success ">保存设置</button>
									</div>

								</form>
                            </div>
                        </div>
                    </div>
					<div class="am-u-sm-12 am-u-md-12 am-u-lg-6">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">核心配置</font></font></div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">
                                <form class="am-form tpl-form-border-form">
									<div class="am-form-group">
                                        <label for="user-intro" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">注册开关：</font></font></label>
                                        <div class="am-u-sm-9">
                                            <div class="tpl-switch">
                                                <input type="checkbox" onclick="javascript:if(this.checked){$('#zcfs').show();}else{$('#zcfs').hide();};" id="regstatus" value="" class="ios-switch bigswitch tpl-switch-btn" <?php if($web['regstatus']=="yes"){echo "checked";}?>>
                                                <div class="tpl-switch-btn-view">
                                                    <div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="am-form-group" id="zcfs" <?php if($web['regstatus']=="no"){echo "hidden";}?>>
                                        <label for="user-phone" class="am-u-sm-3 am-form-label">注册方式：</label>
                                        <div class="am-u-sm-9">
                                            <select id="regfs" data-am-selected style="display: none;">
                                            <option value="ptzc" <?php if($web['regfs']=='ptzc'){echo 'selected="selected"';} ?>>普通注册</option>
                                            <option value="yxzc" <?php if($web['regfs']=='yxzc'){echo 'selected="selected"';} ?>>邮箱验证</option>
                                            <option value="sjzc" <?php if($web['regfs']=='sjzc'){echo 'selected="selected"';} ?>>手机验证</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-intro" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">接口开关：</font></font></label>
                                        <div class="am-u-sm-9">
                                            <div class="tpl-switch">
                                                <input type="checkbox" id="apistatus" value="" class="ios-switch bigswitch tpl-switch-btn" <?php if($web['apistatus']=="yes"){echo "checked";}?>>
                                                <div class="tpl-switch-btn-view">
                                                    <div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">订单名称：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="ptddmc" placeholder="提交到上级平台的订单名称（只能汉子或者字母）" value="<?php echo $web['ptddmc']; ?>">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">订单时效：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="ddyxq" placeholder="订单的有效时间（单位为分钟），如：10" value="<?php echo $web['ddyxq']; ?>">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">金额上限：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="zgje" placeholder="每笔订单最高提交的金额，如：10000.00（保留两位小数）" value="<?php echo $web['zgje']; ?>">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">金额下限：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="zdje" placeholder="每笔订单最低提交的金额，如：1.00（保留两位小数）" value="<?php echo $web['zdje']; ?>">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">最低提现：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="zdtxje" placeholder="最低多少金额才能提现（只能输入整数）" value="<?php echo $web['zdtxje']; ?>">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">提现费率：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="txsxf" placeholder="提现的手续费率（金额的百分比）" value="<?php echo $web['txsxf']; ?>">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">保底提现：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="txbdsxf" placeholder="如果手续费不超过此金额则以此金额为手续费(留空不设置)" value="<?php echo $web['txbdsxf']; ?>">
                                        </div>
                                    </div>
									<div class="am-u-sm-9 am-u-sm-push-3">
										<button type="button" onclick="xghxpz()" class="am-btn am-btn-primary tpl-btn-bg-color-success ">保存设置</button>
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
    <div class="am-modal-hd">保存配置</div>
    <div class="am-modal-bd">
      保存这次的配置吗？
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
	function xgjbpz(){//修改基本配置
		if($("#sitestatus").is(":checked")){
			$("#sitestatus").val("yes");
		}else{
			$("#sitestatus").val("no");
		}
		$('#xgyxmodal').modal({
			onConfirm:function(){
				$.ajax({
					url:'',
					data:{
						sitename:$('#sitename').val(),
						siteurl:$('#siteurl').val(),
						sitemail:$('#sitemail').val(),
						sitecom:$('#sitecom').val(),
						sitephone:$('#sitephone').val(),
						siteweixin:$('#siteweixin').val(),
						siteqq:$('#siteqq').val(),
						sitebeian:$('#sitebeian').val(),
						sitestatus:$('#sitestatus').val(),
						action:'jbpz',
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
	function xghxpz(){//修改核心配置
		if($("#regstatus").is(":checked")){//注册开关
			$("#regstatus").val("yes");
		}else{
			$("#regstatus").val("no");
		}
		if($("#apistatus").is(":checked")){//接口开关
			$("#apistatus").val("yes");
		}else{
			$("#apistatus").val("no");
		}
		$('#xgyxmodal').modal({
			onConfirm:function(){
				$.ajax({
					url:'',
					data:{
						regstatus:$('#regstatus').val(),
						apistatus:$('#apistatus').val(),
						regfs:$('#regfs').val(),
						ddyxq:$('#ddyxq').val(),
						zgje:$('#zgje').val(),
						zdje:$('#zdje').val(),
						ptddmc:$('#ptddmc').val(),
						zdtxje:$('#zdtxje').val(),
						txsxf:$('#txsxf').val(),
						txbdsxf:$('#txbdsxf').val(),
						action:'hxpz',
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
	$('#jhxtpz').addClass('sub-active');

})
</script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>