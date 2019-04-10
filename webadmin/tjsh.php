<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["admin"])){
		header("location:login.php");
		exit;
	}
	if(@$_POST['action']=='tjsh'){//通过
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
		$shmm=md5($_POST["shmm"]);//商户密码
		$shsj=$_POST["shsj"];//商户手机
		$shyx=$_POST["shyx"];//商户邮箱
		$lxqq=$_POST["lxqq"];//联系QQ
		$shxb=$_POST["shxb"];//商户性别
		$lxdz=$_POST["lxdz"];//联系地址
		$sjdl=$_POST["sjdl"];//上级代理
		$wzwz=$_POST["wzwz"];//网站URL
		$wzmc=$_POST["wzmc"];//网站名称
		$wzlx=$_POST["wzlx"];//网站类型
		$zsxm=$_POST["zsxm"];//真实姓名
		$txyh=$_POST["txyh"];//提现银行
		$txzh=$_POST["txzh"];//提现账号
		$hjdz=$_POST["hjdz"];//户籍地址
		$sfhm=$_POST["sfhm"];//身份证号码
		$sfzm=$_POST['sfzm'];//身份证正面图片
		$sffm=$_POST['sffm'];//身份证反面图片
		$sfdz=$_POST["sfdz"];//身份证地址
		$shlx=$_POST["shlx"];//商户类型
		$sj=date("Y-m-d H:i:s",time());;//注册时间
		$apikey=randkey(40);//随机生成40位字符key
		queryz(co_user_sys,"user,pass,mail,shouji,qq,status,api,apikey,shiming,xingbie,dizhi,yue,daili,txzh,feilv,zcsj,txyh,xingming,sfzhm,sfzzm,sfzfm,sfzdz,hjszd,rztime,rzlx","'$shmc','$shmm','$shyx','$shsj','$lxqq','jihuo','yes','$apikey','yes','$shxb','$lxdz','0','$sjdl','$txzh','0.1','$sj','$txyh','$zsxm','$sfhm','$sfzm','$sffm','$sfdz','$hjdz','$sj','$shlx'");//写入商户核心表
		queryz(co_userapi,"username,alipay,weixin,yinlian,weixingz,weixinh5,alipaywap,wzurl,wzname,wzlx,lxfs,zt,sqsj","'$shmc','yes','yes','yes','yes','yes','yes','$wzwz','$wzmc','$wzlx','$shsj','yes','$sj'");//写入商户API表
		if($_POST['mail']=='yes'){
			$flag = sendMail($shyx,'开户成功提醒！ - '.$web['sitename'],"尊敬的商户，你的开户申请已通过！");//发送邮箱
			echo json_encode(array("te"=>"开户完成，已邮件通知商户！","ok"=>"ok"),true);
			exit;
		}else{
			echo json_encode(array("te"=>"开户完成！","ok"=>"ok"),true);
			exit;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>添加商户 - 系统后台 -<?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 添加商户 <small>v 2.0</small></div>
                        <p class="page-header-description"></p>
                    </div>
                </div>

            </div>

            <div class="row-content am-cf">
                <div class="row  am-cf">
					<div class="am-u-sm-12 am-u-md-12 am-u-lg-10">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">添加商户</div>
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
                                            <input type="text" id="shmc" placeholder="由16位字母或与数字组成">
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
                                            <input type="text" id="sjdl" placeholder="留空为没有上级代理" value="">
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
                                            <button onclick="javascript:tjxj();" type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success ">添加商户（同时会实名与开通API权限）</button>
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
<script type="text/javascript">
$(function(){
	$('#jhshgn').addClass('active');
	$("#jhshgnlb").css("display","block");
	$('#jhtjsh').addClass('sub-active');

})
</script>
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
		tjForm.append("action","tjsh"); 
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
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>