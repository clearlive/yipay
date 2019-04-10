<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["admin"])){
		header("location:login.php");
		exit;
	}
	
	if(@$_GET['action']=='mianban'){ //进入代理面板
		if(@$_GET['agent']!==null){
			$a=session_id();
			$b=$_GET['agent'];
			queryg(co_agent_sys,"sessid='$a' where agentuser='$b'");
			$_SESSION['agent']=$_GET['agent'];
			header("location:../../agent");
			exit;
		}
	}
	
	if(@$_POST['action'] == 'shanchu'){  //删除代理
		if($_POST['agentuser']==null or !isszzm($_POST['agentuser'])){
			echo json_encode(array("te"=>"代理名错误！"));
			exit;
		}
		$agentuser=uhtml(check(trim($_POST['agentuser'])));
		querys(co_agent_sys,"where agentuser='$agentuser'");//删除代理核心表记录
		querys(co_agenttx,"where agentuser='$agentuser'");//删除代理结算表记录
		queryg(co_user_sys,"daili='' where daili='$agentuser'");//更改商户表代理记录
		echo json_encode(array("te"=>"删除完成，所有相关记录已清空！","ok"=>"ok"));
		exit;
	}
	
	if(@$_POST['action']=='chakan'){ //查看代理数据
		if(@$_POST['agentuser']!=null or isszzm($_POST['agentuser'])){
			$agentuser=uhtml(check(trim($_POST['agentuser'])));
			$dlsj=queryall(co_agent_sys,"where agentuser='$agentuser'");
			echo json_encode($dlsj);
			exit;
		}
	}
	
	if(@$_POST['action']=='xiugai'){ //修改代理
		if(@$_POST['agentuser']==null or !isszzm($_POST['agentuser']) or strlen($_POST['agentuser'])>16){
			echo json_encode(array("te"=>"代理名错误"));
			exit;
		}else if(@$_POST['xgstatus']==null or strlen($_POST['xgstatus'])>6 or !ishz($_POST['xgstatus'])){
			echo json_encode(array("te"=>"账户状态错误"));
			exit;
		}else if(@$_POST['xgmima']!=null){
			if(strlen($_POST['xgmima'])<6){
				echo json_encode(array("te"=>"代理密码错误"));
				exit;
			}
		}else if(!isyx($_POST['xgemail']) or strlen($_POST['xgemail'])>60){
			echo json_encode(array("te"=>"代理邮箱错误"));
			exit;
		}else if(!issz($_POST['xgmobile']) or strlen($_POST['xgmobile'])>11){
			echo json_encode(array("te"=>"代理手机错误"));
			exit;
		}else if(!isszxsd($_POST['xgyue']) or strlen($_POST['xgyue'])>11){
			echo json_encode(array("te"=>"账户余额错误"));
			exit;
		}else if(!ishz($_POST['xgzsxm']) or strlen($_POST['xgzsxm'])>12){
			echo json_encode(array("te"=>"真实姓名错误"));
			exit;
		}else if(!ishz($_POST['xgtxyh']) or strlen($_POST['xgtxyh'])>12){
			echo json_encode(array("te"=>"提现银行错误"));
			exit;
		}else if(!isszzm($_POST['xgtxzh']) or strlen($_POST['xgtxzh'])>21){
			echo json_encode(array("te"=>"提现账号错误"));
			exit;
		}
		
		$agentuser=uhtml(check(trim($_POST['agentuser'])));			
		$xgstatus=uhtml(check(trim($_POST['xgstatus'])));			
		$xgmima=uhtml(check(trim($_POST['xgmima'])));			
		$xgemail=uhtml(check(trim($_POST['xgemail'])));			
		$xgmobile=uhtml(check(trim($_POST['xgmobile'])));	
		$xgyue=uhtml(check(trim($_POST['xgyue'])));	
		$xgzsxm=uhtml(check(trim($_POST['xgzsxm'])));	
		$xgtxyh=uhtml(check(trim($_POST['xgtxyh'])));	
		$xgtxzh=uhtml(check(trim($_POST['xgtxzh'])));	
		if($xgmima!=null){
			$xgmima=md5($xgmima);
			queryg(co_agent_sys,"status='$xgstatus',agentpass='$xgmima',email='$xgemail',mobile='$xgmobile',yue='$xgyue',zsxm='$xgzsxm',txyh='$xgtxyh',txzh='$xgtxzh' where agentuser='$agentuser'");
		}else{
			queryg(co_agent_sys,"status='$xgstatus',email='$xgemail',mobile='$xgmobile',yue='$xgyue',zsxm='$xgzsxm',txyh='$xgtxyh',txzh='$xgtxzh' where agentuser='$agentuser'");
		}
		echo json_encode(array("te"=>"修改成功","ok"=>"ok"));
		exit;
	}

	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>代理管理 - 系统后台 -<?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 代理管理 <small>v 2.0</small></div>
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
					<hr>
                        <div class="widget am-cf widget-body-lg">

                            <div class="widget-body  am-fr">
                                <div class="am-scrollable-horizontal ">
                                    <table width="100%" class="am-table am-table-compact am-text-nowrap am-table-striped tpl-table-black " id="example-r">
                                        <thead>
                                            <tr>
                                                <th><label class="am-checkbox-inline"><input type="checkbox" name="all" id="all" ></label>编号</th>
                                                <th>姓名</th>
                                                <th>代理名</th>
                                                <th>代理类型</th>
                                                <th>下级数量</th>
                                                <th>账户余额</th>
                                                <th>账户状态</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											$zs=querydb(co_agent_sys);//总条数
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
											$sql=mysql_query("select * from co_agent_sys ORDER BY id DESC limit $djt,$my");
											$i=$djt+1;
											while($agent_sys=mysql_fetch_assoc($sql)){
												$xjshsl=querydb(co_user_sys,"where daili='$agent_sys[agentuser]'");//下级商户数量
												echo '
											<tr class="gradeX">
                                                <td><input type="checkbox" class="a" name="x" value="'.$agent_sys['id'].'">'.$i.'</td>
                                                <td>'.$agent_sys['zsxm'].'</td>
                                                <td>'.$agent_sys['agentuser'].'</td>
                                                <td>'.$agent_sys['dllx'].'</td>
                                                <td>'.$xjshsl.'</td>
                                                <td>'.$agent_sys['yue'].'</td>
                                                <td>'.$agent_sys['status'].'</td>
                                                <td>
                                                    <div class="tpl-table-black-operation">
                                                        <span onclick="xg(this)" val="'.$agent_sys['agentuser'].'"><a href="javascript:void(0)" class="tpl-table-black-operation-success">
                                                            <i class="am-icon-pencil"></i> 修改
                                                        </a></span>
                                                        <span><a target="_blank" href="?action=mianban&agent='.$agent_sys['agentuser'].'" class="tpl-table-black-operation-info">
                                                            <i class="am-icon-eye"></i> 面板
                                                        </a></span>
                                                        <span onclick="sc(this)" val="'.$agent_sys['agentuser'].'" ><a href="javascript:void(0)" class="tpl-table-black-operation-del">
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
                                            <a href="dlgl.php">首页</a>
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
    <div class="am-modal-hd">删除代理</div>
    <div class="am-modal-bd">
      删除代理可能会造成数据混乱！（慎重操作!）
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>确定</span>
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!-----删除提示----->

<!-----修改代理----->
<div id="xgdl" class="am-modal" tabindex="-1">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">修改代理
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
		<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
			<div class="widget am-cf">
				<div class="widget-body am-fr">
					<form class="tpl-form-border-form">
						<div class="am-form-group">
						<label for="user-name" class="am-u-sm-3 am-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">代理名称：</font></font><span class="tpl-form-line-small-title"><font style="vertical-align: inherit;"></font></span></label>
							<div class="am-u-sm-9">
								<select data-am-selected="" disabled="disabled">
								<option id="xgdlmc" selected="selected"></option>
								</select>
							</div>
						</div> 
						<div class="am-form-group">
							<label for="user-phone" class="am-u-sm-3 am-form-label">账户状态：</label>
							<div class="am-u-sm-9">
								<select id="xgstatus" data-am-selected required>
								<option value="正常">正常</option>
								<option value="禁用">禁用</option>
								</select>
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
								<input type="text" class="tpl-form-input" id="xgemail" placeholder="无特殊情况请勿随意修改！" value="">
							</div>
						</div> 
						<div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">手机号码：</label>
							<div class="am-u-sm-2">
							</div>
							<div class="am-u-sm-7">
								<input type="text" class="tpl-form-input" id="xgmobile" placeholder="无特殊情况请勿随意修改！" value="">
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
						<!--div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">代理类型：</label>
							<div class="am-u-sm-2">
							</div>
							<div class="am-u-sm-7">
								<input type="text" class="tpl-form-input" id="xgdllx" placeholder="无特殊情况请勿随意修改！" value="">
							</div>
						</div> 
						<div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">利润类型：</label>
							<div class="am-u-sm-2">
							</div>
							<div class="am-u-sm-7">
								<input type="text" class="tpl-form-input" id="xglrlx" placeholder="无特殊情况请勿随意修改！" value="">
							</div>
						</div--> 
						<div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">真实姓名：</label>
							<div class="am-u-sm-2">
							</div>
							<div class="am-u-sm-7">
								<input type="text" class="tpl-form-input" id="xgzsxm" placeholder="无特殊情况请勿随意修改！" value="">
							</div>
						</div> 
						<div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">提现银行：</label>
							<div class="am-u-sm-2">
							</div>
							<div class="am-u-sm-7">
								<input type="text" class="tpl-form-input" id="xgtxyh" placeholder="无特殊情况请勿随意修改！" value="">
							</div>
						</div> 
						<div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">提现账户：</label>
							<div class="am-u-sm-2">
							</div>
							<div class="am-u-sm-7">
								<input type="text" class="tpl-form-input" id="xgtxzh" placeholder="无特殊情况请勿随意修改！" value="">
							</div>
						</div> 
					
						<div id="ssssss" class="am-u-sm-6 am-u-sm-push-3">
							<button type="button" onclick="bc(this)" id="xgdlm" val="" class="am-btn am-btn-primary tpl-btn-bg-color-success ">保存设置</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
  </div>
</div>
<!-----修改代理----->

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
	$('#jhdlgn').addClass('active');
	$("#jhdlgnlb").css("display","block");
	$('#jhdlgl').addClass('sub-active');

})
</script>

    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/dlgl.js"></script>
</body>
</html>