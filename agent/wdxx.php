<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["agent"])){
		header("location:login.php");
		exit;
	}
	$agentuser=$_SESSION["agent"];
	$agent=queryall(co_agent_sys,"where agentuser='$agentuser'");
	$dljezs=queryall(co_dingdan,"where agent='$agentuser' and ddzt='success'","sum(agentje) as agentje");//代理利润总金额
	if($dljezs["agentje"] ==""){
		$dljezs["agentje"]="0.00";
	}	
	$dlddzs=querydb(co_dingdan,"where agent='$agentuser'");//代理订单总数
	if($dlddzs==""){
		$dlddzs="0";
	}
	
	/****************************/
	
	if(@$_POST['action']=='xgmm'){//修改密码
		if($_POST['ymm']==null){
			echo json_encode(array("te"=>"请输入原密码"));
			exit;
		}else if($_POST['xmm']==null){
			echo json_encode(array("te"=>"请输入新密码"));
			exit;
		}else if($_POST['qrmm']==null){
			echo json_encode(array("te"=>"请确认新密码"));
			exit;
		}else if($_POST['xmm']!=$_POST['qrmm']){
			echo json_encode(array("te"=>"两次密码输入不一致"));
			exit;
		}
		$ymm=md5($_POST['ymm']);
		if($ymm!=$agent['agentpass']){
			echo json_encode(array("te"=>"原密码错误"));
			exit;
		}
		$xmm=md5($_POST['xmm']);
		queryg(co_agent_sys,"agentpass='$xmm',sessid='' where agentuser='$agentuser'");
		echo json_encode(array("te"=>"修改成功,请重新登录！","ok"=>"ok"));
		exit;
	}
	
	if($agent['zsxm']!=null or $agent['txyh']!=null or $agent['txzh']!=null){//禁用提现信息操作
		$jinyong="disabled";
	}else{
		$jinyong="";
	}
	
	if(@$_POST['action']=='xgtx'){//修改提现信息
		if($agent['zsxm']!=null or $agent['txyh']!=null or $agent['txzh']!=null){
			echo json_encode(array("te"=>"你已设置提现信息不能再修改!",));
			exit;
		}else if($_POST['zsxm']==null or !ishz($_POST['zsxm']) or strlen($_POST['zsxm'])>12){
			echo json_encode(array("te"=>"姓名错误"));
			exit;
		}else if($_POST['txyh']==null or !ishz($_POST['txyh']) or strlen($_POST['txyh'])>12){
			echo json_encode(array("te"=>"银行错误"));
			exit;
		}else if($_POST['txzh']==null or !isszzm($_POST['txzh']) or strlen($_POST['txzh'])>21){
			echo json_encode(array("te"=>"账号错误!",));
			exit;
		}
		$zsxm=uhtml(check(trim($_POST["zsxm"])));
		$txyh=uhtml(check(trim($_POST["txyh"])));
		$txzh=uhtml(check(trim($_POST["txzh"])));
		queryg(co_agent_sys,"zsxm='$zsxm',txyh='$txyh',txzh='$txzh' where agentuser='$agentuser'");
		echo json_encode(array("te"=>"修改成功","ok"=>"ok"));
		exit;
	}
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>我的信息 - <?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 我的信息 <small>v 2.0</small></div>
                    </div>
                </div>

            </div>

            <div class="row-content am-cf">
                <div class="row  am-cf">
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-8">
						<div data-am-widget="tabs" class="am-tabs am-tabs-d2">
							<ul class="am-tabs-nav am-cf">
								<li class="am-active"><a href="[data-tab-panel-0]">基本信息</a></li>
								<li class=""><a href="[data-tab-panel-1]">修改密码</a></li>
								<li class=""><a href="[data-tab-panel-2]">提现信息</a></li>
							</ul>
							<div class="am-tabs-bd" style="border:0px;">
							<div data-tab-panel-1 class="am-tab-panel am-active">
								<div class="am-panel am-panel-default">
									<div class="am-panel-bd">
										<div class="am-alert am-alert-secondary" data-am-alert>
											<button type="button" class="am-close">&times;</button>
											<p>Te：代理商不支持在线修改资料，如需修改请联系管理员！</p>
										</div>
										<form class="am-form">
 										 <fieldset>
  										  <div class="am-form-group">
    										  <label><u>代理名称：</u></label>　<?php echo $agentuser; ?>
 										   </div>
											<hr>
  										  <div class="am-form-group">
  										    <label><u>代理类型：</u></label>　<?php if($agent['dllx']==null){echo "无";}else{echo $agent['dllx'];} ?>
   										 </div>
											<hr>
  										  <div class="am-form-group">
  										    <label><u>利润类型：</u></label>　<?php if($agent['lrlx']==null){echo "无";}else{echo $agent['lrlx'];} ?>
   										 </div>
											<hr>
  										  <div class="am-form-group">
  										    <label><u>手机号码：</u></label>　<?php if($agent['mobile']==null){echo "无";}else{echo $agent['mobile'];} ?>
   										 </div>
											<hr>
  										  <div class="am-form-group">
  										    <label><u>联系邮箱：</u></label>　<?php if($agent['email']==null){echo "无";}else{echo $agent['email'];} ?>
   										 </div>
 										 </fieldset>
										</form>
										</div>
								</div>
							</div>
							<div data-tab-panel-2 class="am-tab-panel ">
								<div class="am-panel am-panel-default">
									<div class="am-panel-bd">
										<form class="am-form">
 										 <fieldset>
  										  <div class="am-form-group">
    										  <label for="doc-ipt-email-1">原密码：</label>
  										    <input type="password" class="" id="ymm" placeholder="请输入原密码验证">
 										  </div>

  										  <div class="am-form-group">
  										    <label for="doc-ipt-pwd-1">新密码：</label>
  										    <input type="password" class="" id="xmm" placeholder="请输入新的密码">
										  </div>

  										  <div class="am-form-group">
  										    <label for="doc-ipt-pwd-1">新密码：</label>
  										    <input type="password" class="" id="qrmm" placeholder="请再次确认密码">
   										 </div>

  										  <p><button onclick="tjxgmm()" type="button" class="am-btn am-btn-default">修改</button></p>
 										 </fieldset>
										</form>
									</div>
								</div>
							</div>
							<div data-tab-panel-3 class="am-tab-panel ">
								<div class="am-panel am-panel-default">
									<div class="am-panel-bd">
										<div class="am-alert am-alert-secondary" data-am-alert>
											<button type="button" class="am-close">&times;</button>
											<p>Te：只允许设置一次，请认真填写，如需修改请联系管理员！</p>
										</div>
										<form class="am-form">
 										 <fieldset>
  										  <div class="am-form-group">
    										  <label for="doc-ipt-email-1">真实姓名：</label>
  										    <input type="text" class="" id="zhenshixingming" value="<?php echo $agent['zsxm']; ?>" placeholder="" <?php echo $jinyong; ?>>
 										  </div>

										<div class="am-form-group am-form-select">
											<label>提现银行</label>
											<select id="tixianyinhang" <?php echo $jinyong; ?>>
											<option value="支付宝" <?php if($agent['txyh'] =="支付宝"){echo "selected=selected";} ?>>支付宝</option>
											<option value="财付通" <?php if($agent['txyh'] =="财付通"){echo "selected=selected";} ?>>财付通</option>
											<option value="建设银行" <?php if($agent['txyh'] =="建设银行"){echo "selected=selected";} ?>>建设银行</option>
											<option value="工商银行" <?php if($agent['txyh'] =="工商银行"){echo "selected=selected";} ?>>工商银行</option>
											<option value="邮政储蓄" <?php if($agent['txyh'] =="邮政储蓄"){echo "selected=selected";} ?>>邮政储蓄</option>
											<option value="浦发银行" <?php if($agent['txyh'] =="浦发银行"){echo "selected=selected";} ?>>浦发银行</option>
											<option value="农业银行" <?php if($agent['txyh'] =="农业银行"){echo "selected=selected";} ?>>农业银行</option>
											<option value="广发银行" <?php if($agent['txyh'] =="广发银行"){echo "selected=selected";} ?>>广发银行</option>
											</select>
											<span class="am-form-caret"></span>
										</div>
  										  <div class="am-form-group">
  										    <label for="doc-ipt-pwd-1">提现账号：</label>
  										    <input type="text" class="" id="tixianzhanghao" placeholder="" value="<?php echo $agent['txzh']; ?>" <?php echo $jinyong; ?>>
   										 </div>

  										  <p <?php if($jinyong!=null){echo 'style="display:none"';} ?>><button onclick="tjxgtx()" type="button" class="am-btn am-btn-default" >确认修改</button></p>
 										 </fieldset>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
        </div>
    </div>
    </div>
<!---------提示框---------->
<div class="am-modal am-modal-alert" tabindex="-1" id="ts">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">提示：</div>
    <div class="am-modal-bd" id="te">
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn">确定</span>
    </div>
  </div>
</div>
<!---------提示框---------->
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
<script type="text/javascript">
$(function(){
	$('#jhwdxx').addClass('active');

})
</script>
<script>
	function tjxgmm(){
		$.ajax({
			url:'',
			data:{
				ymm:$('#ymm').val(),
				xmm:$('#xmm').val(),
				qrmm:$('#qrmm').val(),
				action:'xgmm',
			},
			type:'POST',
			dataType:'JSON',
			success:function(data){
				$('#ts').modal();
				$('#te').html(data.te);
				if(data.ok){
					setTimeout(function(){
						window.location.reload();//刷新
					},1000);
				}
			},
			error:function(){
				$('#ts').modal();
				$('#te').html("获取数据错误");
			}
		})
	}
	
	function tjxgtx(){
		$.ajax({
			url:'',
			data:{
				zsxm:$('#zhenshixingming').val(),
				txyh:$('#tixianyinhang').val(),
				txzh:$('#tixianzhanghao').val(),
				action:'xgtx',
			},
			type:'POST',
			dataType:'JSON',
			success:function(data){
				$('#ts').modal();
				$('#te').html(data.te);
				if(data.ok){
					setTimeout(function(){
						window.location.reload();//刷新
					},1000);
				}
			},
			error:function(){
				$('#ts').modal();
				$('#te').html("获取数据错误");
			}
		})
	}
</script>

</body>

</html>