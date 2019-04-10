<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["agent"])){
		header("location:login.php");
		exit;
	}
	$agentuser=$_SESSION["agent"];

	/****************************/

	if(@$_POST['action']=='tjxjsh'){
		if($_POST['shmc']==null or strlen($_POST['shmc'])>16 or strlen($_POST['shmc'])<6 or !isszzm($_POST['shmc'])){
			echo json_encode(array("te"=>"商户名称错误"));
			exit;
		}else if($_POST['shmm']==null or strlen($_POST['shmm'])>12 or !isszzm($_POST['shmm'])){
			echo json_encode(array("te"=>"商户密码错误"));
			exit;
		}else if($_POST['shsj']==null or strlen($_POST['shsj'])!=11 or !isszzm($_POST['shsj'])){
			echo json_encode(array("te"=>"手机号码错误"));
			exit;
		}else if($_POST['shyx']==null or strlen($_POST['shyx'])>28 or !isyx($_POST['shyx'])){
			echo json_encode(array("te"=>"商户邮箱错误"));
			exit;
		}else if($_POST['lxqq']==null or strlen($_POST['lxqq'])>28 or !isszzm($_POST['lxqq'])){
			echo json_encode(array("te"=>"联系QQ或微信错误"));
			exit;
		}else if($_POST['shxb']==null or strlen($_POST['shxb'])>3 or !ishz($_POST['shxb'])){
			echo json_encode(array("te"=>"商户性别错误"));
			exit;
		}else if($_POST['lxdz']==null or strlen($_POST['lxdz'])>88 or !ishzszzm($_POST['lxdz'])){
			echo json_encode(array("te"=>"联系地址错误"));
			exit;
		}else if($_POST['sjdl']==null or strlen($_POST['sjdl'])>16 or !isszzm($_POST['sjdl'])){
			echo json_encode(array("te"=>"上级代理错误"));
			exit;
		}else if($_POST['wzwz']==null or strlen($_POST['wzwz'])>66 or !iswz($_POST['wzwz'])){
			echo json_encode(array("te"=>"网站URL错误"));
			exit;
		}else if($_POST['wzmc']==null or strlen($_POST['wzmc'])>12 or !ishzszzm($_POST['wzmc'])){
			echo json_encode(array("te"=>"网站名称错误"));
			exit;
		}else if($_POST['wzlx']==null or strlen($_POST['wzlx'])>12 or !ishz($_POST['wzlx'])){
			echo json_encode(array("te"=>"网站类型错误"));
			exit;
		}else if($_POST['zsxm']==null or strlen($_POST['zsxm'])>12 or !ishz($_POST['zsxm'])){
			echo json_encode(array("te"=>"真实姓名错误"));
			exit;
		}else if($_POST['txyh']==null or strlen($_POST['txyh'])>12 or !ishz($_POST['txyh'])){
			echo json_encode(array("te"=>"提现银行错误"));
			exit;
		}else if($_POST['txzh']==null or strlen($_POST['txzh'])>21 or !isszzm($_POST['txzh'])){
			echo json_encode(array("te"=>"提现账号错误"));
			exit;
		}else if($_POST['hjdz']==null or strlen($_POST['hjdz'])>33 or !ishzszzm($_POST['hjdz'])){
			echo json_encode(array("te"=>"户籍地址错误"));
			exit;
		}else if($_POST['sfhm']==null or strlen($_POST['sfhm'])<16 or strlen($_POST['sfhm'])>18 or !isszzm($_POST['sfhm'])){
			echo json_encode(array("te"=>"身份证号码错误"));
			exit;
		}else if(empty($_FILES['sfzm']['tmp_name'])){
			echo json_encode(array("te"=>"请上传身份证正面图片"),true);
			exit;
		}else if(empty($_FILES['sffm']['tmp_name'])){
			echo json_encode(array("te"=>"请上传身份证反面图片"),true);
			exit;
		}else if($_POST['sfdz']==null or strlen($_POST['sfdz'])>88 or !ishzszzm($_POST['sfdz'])){
			echo json_encode(array("te"=>"身份证地址错误"));
			exit;
		}else if($_POST['shlx']==null or strlen($_POST['shlx'])>2 or !iszm($_POST['shlx'])){
			echo json_encode(array("te"=>"商户类型错误"));
			exit;
		}
		$shmc=$_POST["shmc"];//商户名称
		$shmccz=querydb(co_user_sys,"where user='$shmc'");
		if($shmccz>=1){
			echo json_encode(array("te"=>"商户名称已存在"));
			exit;
		}
		$shmm=uhtml(check(trim($_POST["shmm"])));//商户密码
		$shsj=uhtml(check(trim($_POST["shsj"])));//商户手机
		$shyx=uhtml(check(trim($_POST["shyx"])));//商户邮箱
		$lxqq=uhtml(check(trim($_POST["lxqq"])));//联系QQ
		$shxb=uhtml(check(trim($_POST["shxb"])));//商户性别
		$lxdz=uhtml(check(trim($_POST["lxdz"])));//联系地址
		$sjdl=uhtml(check(trim($_POST["sjdl"])));//上级代理
		$wzwz=uhtml(check(trim($_POST["wzwz"])));//网站URL
		$wzmc=uhtml(check(trim($_POST["wzmc"])));//网站名称
		$wzlx=uhtml(check(trim($_POST["wzlx"])));//网站类型
		$zsxm=uhtml(check(trim($_POST["zsxm"])));//真实姓名
		$txyh=uhtml(check(trim($_POST["txyh"])));//提现银行
		$txzh=uhtml(check(trim($_POST["txzh"])));//提现账号
		$hjdz=uhtml(check(trim($_POST["hjdz"])));//户籍地址
		$sfhm=uhtml(check(trim($_POST["sfhm"])));//身份证号码
		$sfzm=uploadtj($_FILES['sfzm']);//身份证正面图片
		$sffm=uploadtj($_FILES['sffm']);//身份证反面图片
		$sfdz=uhtml(check(trim($_POST["sfdz"])));//身份证地址
		$shlx=uhtml(check(trim($_POST["shlx"])));//商户类型
		$sj=date("Y-m-d H:i:s",time());//申请时间
		if(queryz(co_khsh,"shmc,shmm,shsj,shyx,lxqq,shxb,lxdz,sjdl,wzwz,wzmc,wzlx,zsxm,txyh,txzh,hjdz,sfhm,sfzm,sffm,sfdz,shlx,sj,zt","'$shmc','$shmm','$shsj','$shyx','$lxqq','$shxb','$lxdz','$sjdl','$wzwz','$wzmc','$wzlx','$zsxm','$txyh','$txzh','$hjdz','$sfhm','$sfzm','$sffm','$sfdz','$shlx','$sj','dengdai'")){
			echo json_encode(array("te"=>"提交成功，审核结果将通过邮箱通知，请注意查收邮箱！","ok"=>"ok"));
			exit;
		}else{
			echo json_encode(array("te"=>"写入错误！"));
			exit;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>添加下级 - <?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 添加下级 <small>v 2.0</small></div>
                    </div>
                </div>

            </div>

            <div class="row-content am-cf">
                <div class="row  am-cf">
					<div class="am-u-sm-12 am-u-md-12 am-u-lg-10">
						<div class="am-alert am-alert-secondary" data-am-alert>
							<button type="button" class="am-close">&times;</button>
							<p>温馨提示：填写错误将不予通过！（<b style="color:red;">所有项必填</b>）</p>
						</div>
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">添加下级</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">

                                <form class="am-form tpl-form-line-form">
									<div class="am-u-md-6">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">商户名称：<span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" id="shmc" placeholder="不超过16位字母或与数字组成">
                                        </div>
                                    </div>
                                    </div>

									<div class="am-u-md-6">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">商户密码：<span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" id="shmm" placeholder="初始密码只能数字或字母（不超过12位数）">
                                        </div>
                                    </div>
                                    </div>

									<div class="am-u-md-6">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">商户手机：<span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" id="shsj" placeholder="11位数手机号码">
                                        </div>
                                    </div>
                                    </div>

									<div class="am-u-md-6">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">商户邮箱：<span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" id="shyx" placeholder="如：admin@qq.com">
                                        </div>
                                    </div>
                                    </div>
									
									<div class="am-u-md-6">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">联系ＱＱ：<span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" id="lxqq" placeholder="联系QQ或者微信">
                                        </div>
                                    </div>
                                    </div>

									<div class="am-u-md-6">
									<div class="am-form-group">
										<label for="user-phone" class="am-u-sm-3 am-form-label">商户性别：</label>
										<div class="am-u-sm-9">
											<select id="shxb" data-am-selected required>
											<option value="男">男</option>
											<option value="女">女</option>
											</select>
										</div>
									</div>
									</div>

									<div class="am-u-md-6">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">联系地址：<span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" id="lxdz" placeholder="现居住地联系地址">
                                        </div>
                                    </div>
                                    </div>

									<div class="am-u-md-6">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">上级代理：<span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" id="sjdl" placeholder="" value="<?php echo $agentuser; ?>" disabled >
                                        </div>
                                    </div>
                                    </div>

									<div class="am-u-md-6">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">接入网址：<span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" id="wzwz" placeholder="商户接入网站的URL" >
                                        </div>
                                    </div>
                                    </div>
									
									<div class="am-u-md-6">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">网站名称：<span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" id="wzmc" placeholder="商户接入网站的名称（4个中文字符）" >
                                        </div>
                                    </div>
                                    </div>

									<div class="am-u-md-6">
									<div class="am-form-group">
										<label for="user-phone" class="am-u-sm-3 am-form-label">网站类型：</label>
										<div class="am-u-sm-9">
											<select id="wzlx" data-am-selected required>
												<option value="综合社区">综合社区</option>
												<option value="网上购物">网上购物</option>
												<option value="游戏充值">游戏充值</option>
												<option value="其他类型">其他类型</option>
											</select>
										</div>
									</div>
									</div>
									
									<div class="am-u-md-6">
									<div class="am-form-group">
										<label for="user-phone" class="am-u-sm-3 am-form-label">提现银行：</label>
										<div class="am-u-sm-9">
											<select id="txyh" data-am-selected required>
											<option value="支付宝">支付宝</option>
											<option value="财付通">财付通</option>
											<option value="建设银行">建设银行</option>
											<option value="工商银行">工商银行</option>
											<option value="邮政储蓄">邮政储蓄</option>
											<option value="浦发银行">浦发银行</option>
											<option value="农业银行">农业银行</option>
											<option value="广发银行">广发银行</option>
											</select>
										</div>
									</div>
									</div>

									<div class="am-u-md-6">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">提现账号：<span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" id="txzh" placeholder="输入不超过21为字符的账号" >
                                        </div>
                                    </div>
                                    </div>

									<div class="am-u-md-6">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">户籍地址：<span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" id="hjdz" placeholder="身份证上的户籍地址" >
                                        </div>
                                    </div>
                                    </div>

									<div class="am-u-md-6">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">真实姓名：<span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" id="zsxm" placeholder="身份证上的真实姓名" >
                                        </div>
                                    </div>
                                    </div>

									<div class="am-u-md-6">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">身份号码：<span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" id="sfhm" placeholder="身份证上的身份号码" >
                                        </div>
                                    </div>
                                    </div>

									<div class="am-u-md-6">
										<div class="am-form-group">
                                        <label for="user-weibo" class="am-u-sm-3 am-form-label">身份正面：<span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <div class="am-form-group am-form-file">
                                                <button type="button" class="am-btn am-btn-danger am-btn-sm"><i class="am-icon-cloud-upload"></i> <span id="z-list">添加身份证正面图片</span></button>
                                                <input id="sfzm" type="file" multiple>
                                            </div>
											
                                        </div>
                                    </div>
                                    </div>

									<div class="am-u-md-6">
										<div class="am-form-group">
                                        <label for="user-weibo" class="am-u-sm-3 am-form-label">身份反面：<span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <div class="am-form-group am-form-file">
                                                <button type="button" class="am-btn am-btn-danger am-btn-sm"><i class="am-icon-cloud-upload"></i> <span id="f-list">添加身份证反面图片</span></button>
                                                <input id="sffm" type="file" multiple>
                                            </div>
											
                                        </div>
                                    </div>
                                    </div>

									<div class="am-u-md-6">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">身份地址：<span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" id="sfdz" placeholder="身份证上的地址" >
                                        </div>
                                    </div>
                                    </div>

									<div class="am-u-md-6">
									<div class="am-form-group">
										<label for="user-phone" class="am-u-sm-3 am-form-label">商户类型：</label>
										<div class="am-u-sm-9">
											<select id="shlx" data-am-selected required>
											<option value="gr">个人</option>
											<option value="qy">企业</option>
											</select>
										</div>
									</div>
									</div>

                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button onclick="javascript:tjxj();" type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交至管理员审核</button>
                                        </div>
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
	$('#jhtjxj').addClass('active');

})

  $(function() {
    $('#sfzm').on('change', function() {
      var fileNames = '';
      $.each(this.files, function() {
        fileNames += '<span class="am-badge">' + this.name + '</span> ';
      });
      $('#z-list').html(fileNames);
    });
  });

  $(function() {
    $('#sffm').on('change', function() {
      var fileNames = '';
      $.each(this.files, function() {
        fileNames += '<span class="am-badge">' + this.name + '</span> ';
      });
      $('#f-list').html(fileNames);
    });
  });

 </script>
<script>  
	function tjxj(){
		var tjForm = new FormData(); 
		tjForm.append("action","tjxjsh"); 
		tjForm.append("shmc",$('#shmc').val()); 
		tjForm.append("shmm",$('#shmm').val()); 
		tjForm.append("shsj",$('#shsj').val()); 
		tjForm.append("shyx",$('#shyx').val()); 
		tjForm.append("lxqq",$('#lxqq').val()); 
		tjForm.append("shxb",$('#shxb').val()); 
		tjForm.append("lxdz",$('#lxdz').val()); 
		tjForm.append("sjdl",$('#sjdl').val()); 
		tjForm.append("wzwz",$('#wzwz').val()); 
		tjForm.append("wzmc",$('#wzmc').val()); 
		tjForm.append("wzlx",$('#wzlx').val()); 
		tjForm.append("zsxm",$('#zsxm').val()); 
		tjForm.append("txyh",$('#txyh').val()); 
		tjForm.append("txzh",$('#txzh').val()); 
		tjForm.append("hjdz",$('#hjdz').val()); 
		tjForm.append("sfhm",$('#sfhm').val()); 
		tjForm.append("sfzm",$('#sfzm')[0].files[0]); 
		tjForm.append("sffm",$('#sffm')[0].files[0]); 
		tjForm.append("sfdz",$('#sfdz').val()); 
		tjForm.append("shlx",$('#shlx').val()); 
		$.ajax({
			url  : "",
			type : "POST",
			dataType : 'JSON', 
			data : tjForm,
			cache: false,
			processData: false,
			contentType: false,
			success:function(data){
						$('#ts').modal();
						$('#te').html(data.te);
						if(data.ok){
							setTimeout(function(){
								window.location.reload();//页面刷新
							},2000);
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