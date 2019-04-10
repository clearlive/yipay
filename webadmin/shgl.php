<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["admin"])){
		header("location:login.php");
		exit;
	}
	
	if(@$_GET['action']=='mianban'){ //进入商户面板
		if(@$_GET['user']!==null){
			$a=session_id();
			$b=$_GET['user'];
			$cop=queryall(co_session,"where username='$b'");
			if($cop['username']==null){
				queryz(co_session,"sessid,username","'$a','$b'");
			}else{
				queryg(co_session,"sessid='$a' where username='$b'");
			}
			$_SESSION['user']=$_GET['user'];
			header("location:../../user");
			exit;
		}
	}
	
	if(@$_POST['action'] == 'shanchu'){  //删除用户
		if(@$_POST['user']==null or !isszzm($_POST['user'])){
			echo json_encode(array("te"=>"用户名错误！"));
			exit;
		}
		$yh=uhtml(check(trim($_POST['user'])));
		querys(co_user_sys,"where user='$yh'");//删除用户信息表记录
		querys(co_denglu,"where username='$yh'");//删除登陆信息表记录
		querys(co_dingdan,"where username='$yh'");//删除订单表记录
		querys(co_jiesuan,"where username='$yh'");//删除结算表记录
		querys(co_session,"where username='$yh'");//删除标示表记录
		querys(co_shiming,"where username='$yh'");//删除实名认证表记录
		querys(co_userapi,"where username='$yh'");//删除接口表记录
		querys(co_xiaoxi,"where to_user='$yh'");//删除站内消息表记录
		echo json_encode(array("te"=>"删除完成，所有相关记录已清空！","ok"=>"ok"));
		exit;
	}
	if(@$_POST['action']=='chakan'){ //查看商户数据
		if(@$_POST['user']!=null or isszzm($_POST['user'])){
			$yhm=uhtml(check(trim($_POST['user'])));
			$yhsj=queryall(co_user_sys,"where user='$yhm'");
			echo json_encode($yhsj);
			exit;
		}
	}
	
	if(@$_POST['action']=='xiugai'){ //修改商户
		if(@$_POST['user']==null or !isszzm($_POST['user'])){
			echo json_encode(array("te"=>"用户名错误"));
			exit;
		}else if(@$_POST['xgstatus']==null or strlen($_POST['xgstatus'])>5 or !iszm($_POST['xgstatus'])){
			echo json_encode(array("te"=>"商户状态错误"));
			exit;
		}else if(@$_POST['xgsmrz']==null or strlen($_POST['xgsmrz'])>3 or !iszm($_POST['xgsmrz'])){
			echo json_encode(array("te"=>"实名认证状态错误"));
			exit;
		}else if(@$_POST['xgapizt']==null or strlen($_POST['xgapizt'])>3 or !iszm($_POST['xgapizt'])){
			echo json_encode(array("te"=>"接口权限错误"));
			exit;
		}else if(@$_POST['xgjkms']!=null){
			if(!isszzm($_POST['xgjkms']) or strlen($_POST['xgjkms'])>40){
				echo json_encode(array("te"=>"接口密匙错误"));
				exit;
			}
		}else if(@$_POST['xgfeilv']!=null){
			if(!isszxsd($_POST['xgfeilv']) or strlen($_POST['xgfeilv'])>6 or $_POST['xgfeilv']<0.01){
				echo json_encode(array("te"=>"商户个人费率错误"));
				exit;
			}
		}else if(@$_POST['xgmima']!=null){
			if(strlen($_POST['xgmima'])<6){
				echo json_encode(array("te"=>"商户密码错误"));
				exit;
			}
		}else if(@$_POST['xgyouxiang']!=null){
			if(!isyx($_POST['xgyouxiang']) or strlen($_POST['xgyouxiang'])>30){
				echo json_encode(array("te"=>"商户邮箱错误"));
				exit;
			}
		}else if(@$_POST['xgshouji']!=null){
			if(!issz($_POST['xgshouji']) or strlen($_POST['xgshouji'])>11){
				echo json_encode(array("te"=>"商户手机错误"));
				exit;
			}
		}else if(@$_POST['xgyue']!=null){
			if(!isszxsd($_POST['xgyue'])){
				echo json_encode(array("te"=>"商户余额错误"));
				exit;
			}
		}
		$yhm=uhtml(check(trim($_POST['user'])));			
		$xgstatus=uhtml(check(trim($_POST['xgstatus'])));			
		$xgsmrz=uhtml(check(trim($_POST['xgsmrz'])));			
		$xgapizt=uhtml(check(trim($_POST['xgapizt'])));			
		$xgdaili=uhtml(check(trim($_POST['xgdaili'])));			
		$xgjkms=uhtml(check(trim($_POST['xgjkms'])));			
		$xgfeilv=uhtml(check(trim($_POST['xgfeilv'])));			
		$xgmima=uhtml(check(trim($_POST['xgmima'])));			
		$xgyouxiang=uhtml(check(trim($_POST['xgyouxiang'])));			
		$xgshouji=uhtml(check(trim($_POST['xgshouji'])));	
		$xgyue=uhtml(check(trim($_POST['xgyue'])));	
		if($xgmima!=null){
			$xgmima=md5($xgmima);
			queryg(co_user_sys,"status='$xgstatus',shiming='$xgsmrz',api='$xgapizt',apikey='$xgjkms',feilv='$xgfeilv',pass='$xgmima',mail='$xgyouxiang',shouji='$xgshouji',yue='$xgyue' where user='$yhm'");
		}else{
			queryg(co_user_sys,"status='$xgstatus',shiming='$xgsmrz',api='$xgapizt',apikey='$xgjkms',feilv='$xgfeilv',mail='$xgyouxiang',shouji='$xgshouji',yue='$xgyue' where user='$yhm'");
		}
		echo json_encode(array("te"=>"修改成功","ok"=>"ok"));
		exit;
	}
	if(@$_POST['action']=='cksm'){ //查看实名资料
		if(@$_POST['user']==null or !isszzm($_POST['user'])){
			echo json_encode(array("te"=>"用户名错误"));
			exit;
		}
		$yhm=uhtml(check(trim($_POST['user'])));			
		$smxq=queryall(co_user_sys,"where user='$yhm'");
		echo json_encode($smxq);
		exit;
	}
	if(@$_POST['action']=='xgapi'){ //查看修改API
		if(@$_POST['user']==null or !isszzm($_POST['user'])){
			echo json_encode(array("te"=>"用户名错误"));
			exit;
		}
		$yhm=uhtml(check(trim($_POST['user'])));			
		$xgapi=queryall(co_userapi,"where username='$yhm'");
		echo json_encode($xgapi);
		exit;
	}

	if(@$_POST['action']=='bcapi'){ //保存api设置
		if(@$_POST['user']==null or !isszzm($_POST['user'])){
			echo json_encode(array("te"=>"用户名错误"));
			exit;
		}else if(@$_POST['alipay']==null or strlen($_POST['alipay'])>3 or !iszm($_POST['alipay'])){
			echo json_encode(array("te"=>"支付宝设置错误"));
			exit;
		}else if(@$_POST['weixin']==null or strlen($_POST['weixin'])>3 or !iszm($_POST['weixin'])){
			echo json_encode(array("te"=>"微信设置错误"));
			exit;
		}else if(@$_POST['yinlian']==null or strlen($_POST['yinlian'])>3 or !iszm($_POST['yinlian'])){
			echo json_encode(array("te"=>"银联设置错误"));
			exit;
		}else if(@$_POST['weixingz']==null or strlen($_POST['weixingz'])>3 or !iszm($_POST['weixingz'])){
			echo json_encode(array("te"=>"微信公众号设置错误"));
			exit;
		}else if(@$_POST['weixinh5']==null or strlen($_POST['weixinh5'])>3 or !iszm($_POST['weixinh5'])){
			echo json_encode(array("te"=>"微信H5设置错误"));
			exit;
		}else if(@$_POST['alipaywap']==null or strlen($_POST['alipaywap'])>3 or !iszm($_POST['alipaywap'])){
			echo json_encode(array("te"=>"支付宝WAP设置错误"));
			exit;
		}
		$yhm=uhtml(check(trim($_POST['user'])));			
		$alipay=uhtml(check(trim($_POST['alipay'])));			
		$weixin=uhtml(check(trim($_POST['weixin'])));			
		$yinlian=uhtml(check(trim($_POST['yinlian'])));	
		$weixingz=uhtml(check(trim($_POST['weixingz'])));	
		$weixinh5=uhtml(check(trim($_POST['weixinh5'])));	
		$alipaywap=uhtml(check(trim($_POST['alipaywap'])));	
		queryg(co_userapi,"alipay='$alipay',weixin='$weixin',yinlian='$yinlian',weixingz='$weixingz',weixinh5='$weixinh5',alipaywap='$alipaywap' where username='$yhm'");
		echo json_encode(array("te"=>"修改成功！","ok"=>"ok"));
		exit;
	}
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>商户管理 - 系统后台 -<?php echo $web["sitename"]; ?></title>
    <meta name="description" content="聚合支付V2.0">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <script src="assets/js/echarts.min.js"></script>
    <link rel="stylesheet" href="assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="assets/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" href="assets/css/app.css">
    <script src="assets/js/jquery.min.js"></script>

</head>

<body data-type="widgets">
    <script src="assets/js/theme.js"></script>
    <div class="am-g tpl-g">
	<?php require_once "header.php"; ?>



        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">

            <div class="container-fluid am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 商户管理 <small>v 2.0</small></div>
                        <p class="page-header-description"></p>
                    </div>
                </div>

            </div>

            <div class="row-content am-cf">
                <div class="row am-cf">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12 widget-margin-bottom-lg">
                    <div class="am-btn-group">
						<button onclick="javascript:window.location.reload();" class="am-btn am-btn-default"><i class="am-icon-spinner am-icon-pulse"></i>　数据刷新</button>
					</div>
						<button onclick="plsc()" type="button" class="am-btn am-btn-default"><i class="am-icon-trash"></i> 批量删除</button>
					<hr>
                        <div class="widget am-cf widget-body-lg">

                            <div class="widget-body  am-fr">
                                <div class="am-scrollable-horizontal ">
                                    <table width="100%" class="am-table am-table-compact am-text-nowrap am-table-striped tpl-table-black " id="example-r">
                                        <thead>
                                            <tr>
                                                <th><label class="am-checkbox-inline"><input type="checkbox" name="all" id="all" ></label>编号</th>
                                                <th>用户名</th>
                                                <th>实名认证</th>
                                                <th>认证类型</th>
                                                <th>API权限</th>
                                                <th>上级</th>
                                                <th>账户余额</th>
                                                <th>账户状态</th>
                                                <th>注册时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											$zs=querydb(co_user_sys);//总条数
											$my=6;//每页显示多少条
											$zys=ceil($zs/$my);//总页数
											if(@$_GET['page']<1)$_GET['page']=1;//如果的页数小于1赋值1
											if(@$_GET['page']>$zys)$_GET['page']=$zys;//如果的页数大于总页数，赋值为总页数
											$s=$_GET['page']-1;//上一页
											$x=$_GET['page']+1;//上一页
											if($s<=1)$s=1;//如果的页数小于1赋值1
											if($x>=$zys)$x=$zys;//如果的页数大于总页数，赋值为总页数
											$t=uhtml(check(trim($_GET['page'])));
											$djt=($t-1)*$my;//第几条开始
											$sql=mysql_query("select * from co_user_sys ORDER BY id DESC limit $djt,$my");
											$i=$djt+1;
											while($user_sys=mysql_fetch_assoc($sql)){
												if($user_sys['shiming']=='yes'){//实名认证
													$user_sys['shiming']='<a onclick="cksm(this)" val="'.$user_sys['user'].'" class="am-badge am-badge-success am-radius">已实名</a>';
												}else{
													$user_sys['shiming']='<a onclick="smts()" class="am-badge am-badge-danger am-radius">未实名</a>';
												}
												if($user_sys['rzlx']=='gr'){//认证类型
													$user_sys['rzlx']='个人';
												}else if($user_sys['rzlx']=='qy'){
													$user_sys['rzlx']='企业';
												}else{
													$user_sys['rzlx']='无';
												}
												if($user_sys['api']=='yes'){//API权限
													$user_sys['api']='<a onclick="xgapi(this)" val="'.$user_sys['user'].'" class="am-badge am-badge-success am-radius">已开通</a>';
												}else{
													$user_sys['api']='<a onclick="apits()" class="am-badge am-badge-danger am-radius">未开通</a>';
												}
												if($user_sys['daili']==''){//上级代理
													$user_sys['daili']='无';
												}
												if($user_sys['status']=='jihuo'){//用户状态
													$user_sys['status']='正常';
												}else{
													$user_sys['status']='锁定';
												}
												echo '
											<tr class="gradeX">
                                                <td><input type="checkbox" class="a" name="x" value="'.$user_sys['id'].'">'.$i.'</td>
                                                <td>'.$user_sys['user'].'</td>
                                                <td>'.$user_sys['shiming'].'</td>
                                                <td>'.$user_sys['rzlx'].'</td>
                                                <td>'.$user_sys['api'].'</td>
                                                <td>'.$user_sys['daili'].'</td>
                                                <td>'.$user_sys['yue'].'</td>
                                                <td>'.$user_sys['status'].'</td>
                                                <td>'.$user_sys['zcsj'].'</td>
                                                <td>
                                                    <div class="tpl-table-black-operation">
                                                        <span onclick="xg(this)" val="'.$user_sys['user'].'"><a href="javascript:void(0)" class="tpl-table-black-operation-success">
                                                            <i class="am-icon-pencil"></i> 修改
                                                        </a></span>
                                                        <span><a target="_blank" href="?action=mianban&user='.$user_sys['user'].'" class="tpl-table-black-operation-info">
                                                            <i class="am-icon-eye"></i> 面板
                                                        </a></span>
                                                        <span onclick="sc(this)" val="'.$user_sys['user'].'" ><a href="javascript:void(0)" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-exclamation-triangle"></i> 删除
                                                        </a></span>
                                                    </div>
                                                </td>
                                            </tr>
												';
												$i++;
											}
										?>
                                            <!-- more data -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                                      <ul data-am-widget="pagination" class="am-pagination am-pagination-default">
                                          <li class="tpl-table-black-operation">
                                            <a href="shgl.php">首页</a>
                                          </li>
                                          <li class="tpl-table-black-operation">
                                            <a href="?page=<?php echo $s; ?>" class="">上一页</a>
                                          </li>
                                          <li class="tpl-table-black-operation">
                                            <a href="?page=<?php echo $x; ?>" class="">下一页</a>
                                          </li>
                                          <li class="tpl-table-black-operation">
                                            <a href="?page=<?php echo $zys; ?>" class="">末页</a>
                                          </li>
                                          <li class="tpl-table-black-operation">
                                            <a class="">共 <?php echo $zs."条记录 / ".$zys."页"; ?></a>
                                          </li>
                                      </ul>
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
	
<!-----删除提示----->
<div class="am-modal am-modal-confirm" tabindex="-1" id="scmodal">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">删除用户</div>
    <div class="am-modal-bd">
      删除用户可能会造成数据混乱！（慎重操作!）
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>确定</span>
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!-----删除提示----->

<!-----实名详情----->
<div id="smxq" class="am-modal am-modal-no-btn" tabindex="-1">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">实名资料详情
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
  <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
<table class="am-table am-table-bordered">
    <tbody>
        <tr>
            <td style="background-color:#dedede;">用户名：</td>
            <td id="yh"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">姓名：</td>
            <td id="xm"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">性别：</td>
            <td id="xb"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">身份证号码：</td>
            <td id="hm"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">户籍地址：</td>
            <td id="hj"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">身份证地址：</td>
            <td id="dz"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">正面图片：</td>
            <td><a id="zmlj" href="" target="_blank"><img width="440px" height="300px" id="zm"></a></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">反面图片：</td>
            <td><a id="fmlj" href="" target="_blank"><img width="440px" height="300px" id="fm"></a></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">认证类型：</td>
            <td id="rz"></td>
        </tr>
    </tbody>
</table>
    </div>
  </div>
</div>
<!-----实名详情----->


<!-----修改用户----->
<div id="xgyh" class="am-modal" tabindex="-1">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">修改用户
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
		<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
			<div class="widget am-cf">
				<div class="widget-body am-fr">
					<form class="tpl-form-border-form">
						<div class="am-form-group">
						<label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">商户名称：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
							<div class="am-u-sm-9">
								<select data-am-selected="" disabled="disabled">
								<option id="xgshm" selected="selected"></option>
								</select>
							</div>
						</div> 
						<div class="am-form-group">
							<label for="user-phone" class="am-u-sm-3 am-form-label">激活状态：</label>
							<div class="am-u-sm-9">
								<select id="xgstatus" data-am-selected required>
								<option value="jihuo">是</option>
								<option value="no">否</option>
								</select>
							</div>
						</div>
						<div class="am-form-group">
							<label for="user-phone" class="am-u-sm-3 am-form-label">实名认证：</label>
							<div class="am-u-sm-9">
								<select id="xgsmrz" data-am-selected required>
								<option value="yes" >已认证</option>
								<option value="no" >未认证</option>
								</select>
							</div>
						</div>
						<div class="am-form-group">
							<label for="user-phone" class="am-u-sm-3 am-form-label">接口权限：</label>
							<div class="am-u-sm-9">
								<select id="xgapizt" data-am-selected required>
								<option value="yes">已开通</option>
								<option value="no">未开通</option>
								</select>
							</div>
						</div>
						<div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">接口密匙：</label>
							<div class="am-u-sm-2">
								<a onclick="randkey(false,40)" class="am-badge">生成</a>
							</div>
							<div class="am-u-sm-7">
								<input type="text" class="tpl-form-input" id="xgjkms" placeholder="未开通API权限请勿填写！" value="">
							</div>
						</div> 
						<div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">个人费率：</label>
							<div class="am-u-sm-2">
							</div>
							<div class="am-u-sm-7">
								<input type="text" class="tpl-form-input" id="xgfeilv" placeholder="个人费率优先于默认接口费率" value="">
							</div>
						</div> 
						<div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">修改密码：</label>
							<div class="am-u-sm-2">
								<a onclick="randmm(false,8)" class="am-badge">随机</a>
							</div>
							<div class="am-u-sm-7">
								<input type="text" class="tpl-form-input" id="xgmima" placeholder="无特殊情况请勿随意修改！" value="">
							</div>
						</div> 
						<div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">商户邮箱：</label>
							<div class="am-u-sm-2">
							</div>
							<div class="am-u-sm-7">
								<input type="text" class="tpl-form-input" id="xgyouxiang" placeholder="无特殊情况请勿随意修改！" value="">
							</div>
						</div> 
						<div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">手机号码：</label>
							<div class="am-u-sm-2">
							</div>
							<div class="am-u-sm-7">
								<input type="text" class="tpl-form-input" id="xgshouji" placeholder="无特殊情况请勿随意修改！" value="">
							</div>
						</div> 
						<div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">账户余额：</label>
							<div class="am-u-sm-2">
							</div>
							<div class="am-u-sm-7">
								<input type="text" class="tpl-form-input" id="xgyue" placeholder="无特殊情况请勿随意修改！" value="">
							</div>
						</div> 
					
						<div id="ssssss" class="am-u-sm-6 am-u-sm-push-3">
							<button type="button" onclick="bc(this)" id="xgyhm" val="" class="am-btn am-btn-primary tpl-btn-bg-color-success ">保存设置</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
  </div>
</div>
<!-----修改用户----->

<!-----修改用户----->
<div id="xgapi" class="am-modal" tabindex="-1">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">通道权限
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
		<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
			<div class="widget am-cf">
				<div class="widget-body am-fr">
					<form class="tpl-form-border-form">
						<div class="am-form-group">
							<label for="user-phone" class="am-u-sm-3 am-form-label">支付宝：</label>
							<div class="am-u-sm-9">
								<select id="xgzhifubao" data-am-selected required>
								<option value="yes">开启</option>
								<option value="no">关闭</option>
								</select>
							</div>
						</div>
						<div class="am-form-group">
							<label for="user-phone" class="am-u-sm-3 am-form-label">微信：</label>
							<div class="am-u-sm-9">
								<select id="xgweixin" data-am-selected required>
								<option value="yes">开启</option>
								<option value="no">关闭</option>
								</select>
							</div>
						</div>
						<div class="am-form-group">
							<label for="user-phone" class="am-u-sm-3 am-form-label">银联：</label>
							<div class="am-u-sm-9">
								<select id="xgyinlian" data-am-selected required>
								<option value="yes">开启</option>
								<option value="no">关闭</option>
								</select>
							</div>
						</div>
						<div class="am-form-group">
							<label for="user-phone" class="am-u-sm-3 am-form-label">微信公众号：</label>
							<div class="am-u-sm-9">
								<select id="xgweixingz" data-am-selected required>
								<option value="yes">开启</option>
								<option value="no">关闭</option>
								</select>
							</div>
						</div>
						<div class="am-form-group">
							<label for="user-phone" class="am-u-sm-3 am-form-label">微信H5：</label>
							<div class="am-u-sm-9">
								<select id="xgweixinh5" data-am-selected required>
								<option value="yes">开启</option>
								<option value="no">关闭</option>
								</select>
							</div>
						</div>
						<div class="am-form-group">
							<label for="user-phone" class="am-u-sm-3 am-form-label">支付宝WAP：</label>
							<div class="am-u-sm-9">
								<select id="xgalipaywap" data-am-selected required>
								<option value="yes">开启</option>
								<option value="no">关闭</option>
								</select>
							</div>
						</div>
					
						<div id="szapi" class="am-u-sm-6 am-u-sm-push-3">
							<button type="button" onclick="bcapi(this)" id="xgapiyh" val="" class="am-btn am-btn-primary tpl-btn-bg-color-success ">保存设置</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
  </div>
</div>
<!-----修改用户----->
<script type="text/javascript">
$(function(){
	$('#jhshgn').addClass('active');
	$("#jhshgnlb").css("display","block");
	$('#jhshgl').addClass('sub-active');

})
</script>

    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/shgl.js"></script>
</body>
</html>