<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["admin"])){
		header("location:login.php");
		exit;
	}
			/*	dlmc:$('#dlmc').val(),
				zhzt:$('#zhzt').val(),
				zhmm:$('#zhmm').val(),
				zsxm:$('#zsxm').val(),
				zhyue:$('#zhyue').val(),
				lxyx:$('#lxyx').val(),
				txyh:$('#txyh').val(),
				txzh:$('#txzh').val(),
				sjhm:$('#sjhm').val(),*/

	if(@$_POST['action']=='tjdl'){//添加代理
		if($_POST['dlmc']==null or strlen($_POST['dlmc'])>16 or !isszzm($_POST['dlmc'])){
			echo json_encode(array("te"=>"代理名称错误"));
			exit;
		}else if($_POST['zhzt']==null or strlen($_POST['zhzt'])>6 or !ishz($_POST['zhzt'])){
			echo json_encode(array("te"=>"账户状态错误"));
			exit;
		}else if($_POST['zhmm']==null or strlen($_POST['zhmm'])<6){
			echo json_encode(array("te"=>"账户密码错误"));
			exit;
		}else if($_POST['zsxm']==null or strlen($_POST['zsxm'])>12 or !ishz($_POST['zsxm'])){
			echo json_encode(array("te"=>"真实姓名错误"));
			exit;
		}else if($_POST['zhyue']==null or strlen($_POST['zhyue'])>12 or !isszxsd($_POST['zhyue'])){
			echo json_encode(array("te"=>"账户余额错误"));
			exit;
		}else if($_POST['lxyx']==null or strlen($_POST['lxyx'])>20 or !isyx($_POST['lxyx'])){
			echo json_encode(array("te"=>"联系邮箱错误"));
			exit;
		}else if($_POST['txyh']==null or strlen($_POST['txyh'])>12 or !ishz($_POST['txyh'])){
			echo json_encode(array("te"=>"提现银行错误"));
			exit;
		}else if($_POST['txzh']==null or strlen($_POST['txzh'])>21 or !isszzm($_POST['txzh'])){
			echo json_encode(array("te"=>"提现账号错误"));
			exit;
		}else if($_POST['sjhm']==null or strlen($_POST['sjhm'])!=11 or !issz($_POST['sjhm'])){
			echo json_encode(array("te"=>"手机号码错误"));
			exit;
		}		
		if(querydb(co_agent_sys,"where agentuser='$dlmc'")>=1){
			echo json_encode(array("te"=>"代理名已存在"));
			exit;
		}
		$dlmc=uhtml(check(trim($_POST["dlmc"])));
		$zhzt=uhtml(check(trim($_POST["zhzt"])));
		$zhmm=md5($_POST["zhmm"]);
		$zsxm=uhtml(check(trim($_POST["zsxm"])));
		$zhyue=uhtml(check(trim($_POST["zhyue"])));
		$lxyx=uhtml(check(trim($_POST["lxyx"])));
		$txyh=uhtml(check(trim($_POST["txyh"])));
		$txzh=uhtml(check(trim($_POST["txzh"])));
		$sjhm=uhtml(check(trim($_POST["sjhm"])));
		if(queryz(co_agent_sys,"agentuser,agentpass,status,yue,dllx,lrlx,mobile,email,zsxm,txyh,txzh","'$dlmc','$zhmm','$zhzt','$zhyue','1级代理','费率差','$sjhm','$lxyx','$zsxm','$txyh','$txzh'")){
			echo json_encode(array("te"=>"添加成功！","ok"=>"ok"),true);
			exit;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>添加代理 - 系统后台 -<?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 添加代理 <small>v 2.0</small></div>
                        <p class="page-header-description"></p>
                    </div>
                </div>

            </div>

            <div class="row-content am-cf">
                <div class="row am-cf">
					<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">基本信息</font></font></div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">
                                <form class="am-form tpl-form-border-form">
									<div class="am-u-md-6">
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">代理名称：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="dlmc" placeholder="英文或数字组成，不超16个字符" value="">
                                        </div>
                                    </div>
									</div>

									<div class="am-u-md-6">
                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-u-sm-3 am-form-label">账户状态：</label>
                                        <div class="am-u-sm-9">
                                            <select id="zhzt" data-am-selected >
                                            <option value="正常">正常</option>
                                            <option value="禁用">禁用</option>
                                            </select>
                                        </div>
                                    </div>
									</div>

									<div class="am-u-md-6">
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">账户密码：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="password" class="tpl-form-input" id="zhmm" placeholder="6个字符以上" value="">
                                        </div>
                                    </div>
									</div>

									<div class="am-u-md-6">
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">真实姓名：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="zsxm" placeholder="真实中文姓名，最多4个中文" value="">
                                        </div>
                                    </div>
									</div>

									<div class="am-u-md-6">
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">账户余额：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="zhyue" placeholder="一般为0，只能输入数字或小数点" value="">
                                        </div>
                                    </div>
									</div>

									<div class="am-u-md-6">
                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-u-sm-3 am-form-label">提现银行：</label>
                                        <div class="am-u-sm-9">
                                            <select id="txyh" data-am-selected >
												<option value="支付宝" >支付宝</option>
												<option value="财付通" >财付通</option>
												<option value="建设银行" >建设银行</option>
												<option value="工商银行" >工商银行</option>
												<option value="邮政储蓄" >邮政储蓄</option>
												<option value="浦发银行" >浦发银行</option>
												<option value="农业银行" >农业银行</option>
												<option value="广发银行" >广发银行</option>
                                            </select>
                                        </div>
                                    </div>
									</div>

									<div class="am-u-md-6">
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">联系邮箱：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="lxyx" placeholder="如：mail@123.com" value="">
                                        </div>
                                    </div>
									</div>

									<div class="am-u-md-6">
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">提现账号：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="txzh" placeholder="不超过21个字符" value="">
                                        </div>
                                    </div>
									</div>

									<div class="am-u-md-6">
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">手机号码：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="sjhm" placeholder="只能输入11位数手机号" value="">
                                        </div>
                                    </div>
									</div>

									<div class="am-u-sm-9 am-u-sm-push-3">
										<button type="button" onclick="tjdl()" class="am-btn am-btn-primary tpl-btn-bg-color-success ">确认添加</button>
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
	function tjdl(){//添加代理
		$.ajax({
			url:'',
			data:{
				dlmc:$('#dlmc').val(),
				zhzt:$('#zhzt').val(),
				zhmm:$('#zhmm').val(),
				zsxm:$('#zsxm').val(),
				zhyue:$('#zhyue').val(),
				lxyx:$('#lxyx').val(),
				txyh:$('#txyh').val(),
				txzh:$('#txzh').val(),
				sjhm:$('#sjhm').val(),
				action:'tjdl',
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
</script>
<script type="text/javascript">
$(function(){
	$('#jhdlgn').addClass('active');
	$("#jhdlgnlb").css("display","block");
	$('#jhtjdl').addClass('sub-active');

})
</script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>