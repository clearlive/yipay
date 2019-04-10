<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["admin"])){
		header("location:login.php");
		exit;
	}
	
	if(@$_POST['action']=='bianji'){//编辑管理
		if(empty($_POST['user']) or !isszzm($_POST['user'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$adminuser=uhtml(check(trim($_POST["user"])));
		$adminuser=queryall(co_admin,"where adminuser='$adminuser'");
		echo json_encode($adminuser);
		exit;
	}
	
	if(@$_POST['action']=='bcbianji'){//保存编辑
		if(empty($_POST['user']) or !isszzm($_POST['user'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		if(empty($_POST['qx']) or !isszzm($_POST['qx'])){
			echo json_encode(array("te"=>"权限错误"));
			exit;
		}
		if(empty($_POST['zt']) or !ishz($_POST['zt'])){
			echo json_encode(array("te"=>"权限错误"));
			exit;
		}
		$adminuser=uhtml(check(trim($_POST["user"])));
		$qx=uhtml(check(trim($_POST["qx"])));
		$zt=uhtml(check(trim($_POST["zt"])));
		if(trim($_POST["mm"])!=null){
			$mm=md5($_POST["mm"]);
			queryg(co_admin,"quanxian='$qx',status='$zt',adminpass='$mm' where adminuser='$adminuser'");
		}else{
			queryg(co_admin,"quanxian='$qx',status='$zt' where adminuser='$adminuser'");
		}
		echo json_encode(array("te"=>"保存成功！","ok"=>"ok"),true);
		exit;
	}
	
	if(@$_POST['action']=='shanchu'){//删除管理
		if(empty($_POST['user']) or !isszzm($_POST['user'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$adminuser=uhtml(check(trim($_POST["user"])));
		querys(co_admin,"where adminuser='$adminuser'");
		echo json_encode(array("te"=>"删除完成！","ok"=>"ok"),true);
		exit;
	}
	
	
	if(@$_POST['action']=='tianjia'){//添加管理
		if(empty($_POST['user']) or !isszzm($_POST['user'])){
			echo json_encode(array("te"=>"用户名错误"));
			exit;
		}
		if(empty($_POST['pass'])){
			echo json_encode(array("te"=>"密码错误"));
			exit;
		}
		if(empty($_POST['quanxian']) or !iszm($_POST['quanxian'])){
			echo json_encode(array("te"=>"权限错误"));
			exit;
		}
		if(empty($_POST['status']) or !ishz($_POST['status'])){
			echo json_encode(array("te"=>"状态错误"));
			exit;
		}
		$adminuser=uhtml(check(trim($_POST["user"])));
		$mm=md5($_POST["pass"]);
		$qx=uhtml(check(trim($_POST["quanxian"])));
		$zt=uhtml(check(trim($_POST["status"])));
		queryz(co_admin,"adminuser,adminpass,quanxian,status","'$adminuser','$mm','$qx','$zt'");
		
		echo json_encode(array("te"=>"添加成功！","ok"=>"ok"),true);
		exit;
	}

	if(@$_POST['action']=='xiugaimima'){//修改密码
		if(empty($_POST['user']) or !isszzm($_POST['user'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		if(empty($_POST['ypass'])){
			echo json_encode(array("te"=>"请输入原密码"));
			exit;
		}
		if(empty($_POST['xpass'])){
			echo json_encode(array("te"=>"请输入新密码"));
			exit;
		}
		if(empty($_POST['qrpass'])){
			echo json_encode(array("te"=>"请再次确认密码"));
			exit;
		}if($_POST['qrpass']!=$_POST['xpass']){
			echo json_encode(array("te"=>"两次密码输入不一致"));
			exit;
		}
		$adminuser=uhtml(check(trim($_POST["user"])));
		$ymm=uhtml(check(trim($_POST["ypass"])));
		$ymm=md5($ymm);
		$xmm=uhtml(check(trim($_POST["xpass"])));
		$qrmm=uhtml(check(trim($_POST["qrpass"])));
		$qrmm=md5($qrmm);
		$sxgmm=queryall(co_admin,"where adminuser='$adminuser' and adminpass='$ymm'");
		if($sxgmm['adminuser']==null){
			echo json_encode(array("te"=>"原密码错误！"),true);
			exit;
		}
		queryg(co_admin,"adminpass='$qrmm' where adminuser='$adminuser'");
		echo json_encode(array("te"=>"修改成功,请重新登录管理系统！","ok"=>"ok"),true);
		exit;
	}
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>管理列表 - 系统后台 -<?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 管理列表 <small>v 2.0</small></div>
                        <p class="page-header-description"></p>
                    </div>
                </div>

            </div>

            <div class="row-content am-cf">
                <div class="row am-cf">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12 widget-margin-bottom-lg">
                    <div class="am-btn-group">
						<button onclick="javascript:window.location.reload();" class="am-btn am-btn-default"><i class="am-icon-spinner am-icon-pulse"></i>　数据刷新</button>
						<div class="am-dropdown" data-am-dropdown>
						<button class="am-btn am-btn-default am-dropdown-toggle" data-am-dropdown-toggle> <span class="am-icon-caret-down"></span></button>
						<ul class="am-dropdown-content">
						<li><a class="am-animation-scale-up" href="javascript:$('#tjgl').modal();"><i class="am-icon-angle-double-right" aria-hidden="true"></i>　添加管理</a></li>
						</ul>
						</div>
					</div>
					<hr>
                        <div class="widget am-cf widget-body-lg">
                            <div class="widget-body  am-fr">
                                <div class="am-scrollable-horizontal ">
                                    <table width="100%" class="am-table am-table-compact am-text-nowrap am-table-striped tpl-table-black " id="example-r">
                                        <thead>
                                            <tr>
                                                <th><label class="am-checkbox-inline"><input type="checkbox" name="all" id="all" ></label>编号</th>
                                                <th>管理名</th>
                                                <th>权限</th>
                                                <th>状态</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											$zs=querydb(co_admin);//总条数
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
											$sql=mysql_query("select * from co_admin ORDER BY id DESC limit $djt,$my");
											$i=$djt+1;
											while($gllb=mysql_fetch_assoc($sql)){
												echo '
											<tr class="gradeX">
                                                <td><input type="checkbox" class="a" name="x" value="'.$gllb['id'].'">'.$i.'</td>
                                                <td>'.substr($gllb['adminuser'],0,60).'</td>
                                                <td>'.substr($gllb['quanxian'],0,60).'</td>
                                                <td>'.$gllb['status'].'</td>
                                                <td>
                                                    <div class="tpl-table-black-operation">
                                                        <span onclick="bj(this)" val="'.$gllb['adminuser'].'"><a href="javascript:;" class="tpl-table-black-operation-info">
                                                            <i class="am-icon-check-square"></i> 编辑
                                                        </a></span>
                                                        <span onclick="sc(this)" val="'.$gllb['adminuser'].'"><a href="javascript:void(0)" class="tpl-table-black-operation-del">
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
                                            <a href="gllb.php">首页</a>
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

<!-----删除提示----->
<div class="am-modal am-modal-confirm" tabindex="-1" id="scmodal">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">删除操作</div>
    <div class="am-modal-bd">
      真的要删除这个账号吗？
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>确定</span>
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!-----删除提示----->

<!-----编辑公告----->
<div id="bjzh" class="am-modal am-modal-no-btn" tabindex="-1">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">编辑管理账号
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
		<hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
<div class="am-g">
  <div class="am-u-md-8 am-u-sm-centered">
    <form class="am-form">
      <fieldset class="am-form-set">
        <input type="text" value="" id="bjgl_glyhm" placeholder="管理名" disabled><br>
        <input type="password" value="" id="bjgl_glmm" placeholder="密码"><br>
        <input type="text" value="" id="bjgl_glqx" placeholder="权限"><br>
		<b>管理账户状态：</b>
		<select id="bjgl_glzt" data-am-selected>
			<option value="正常">正常</option>
			<option value="禁用">禁用</option>
		</select>
      </fieldset>
     <!-- <button id="bjgl_user" onclick="bcbianji(this)" val="" type="button" class="am-btn am-btn-primary am-btn-block">保存</button>-->
    </form>
  </div>
</div>
	</div>
  </div>
</div>
<!-----编辑公告----->

<!-----添加管理账号----->
<div id="tjgl" class="am-modal am-modal-no-btn" tabindex="-1">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">添加管理
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
		<hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
<div class="am-g">
  <div class="am-u-md-8 am-u-sm-centered">
    <form class="am-form">
      <fieldset class="am-form-set">
        <input type="text" value="" id="tjgl_user" placeholder="管理账号"><br>
        <input type="password" value="" id="tjgl_pass" placeholder="密码"><br>
        <input type="text" value="" id="tjgl_quanxian" placeholder="权限"><br>
		<b>管理账户状态：</b>
		<select id="tjgl_status" data-am-selected>
			<option value="正常">正常</option>
			<option value="禁用">禁用</option>
		</select>
      </fieldset>
      <button onclick="tjgl(this)" value="" type="button" class="am-btn am-btn-primary am-btn-block">确认添加</button>
    </form>
  </div>
</div>
	</div>
  </div>
</div>
<!-----添加管理账号----->

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
	$("#all").click(function(){	//全选
		//判断全选框是不是checked效果
		if (this.checked){
			//为所有的复选框加选中效果
			$("input[name='x']").prop("checked", true);
			//$("input[name='radio']").attr("checked", true);会出现第一次能选中，再次全选中不好使的现象，可以亲身试验，我的印象很深刻
			}else{
				//取消所有复选框的选中效果
				$("input[name='x']").removeAttr("checked", false);
			}
	});
	
	function bj(obj){//编辑管理
		$.ajax({
			url:'',
			data:{
				user:$(obj).attr('val'),
				action:'bianji',
			},
			dataType:'JSON',
			type:'POST',
			success:function(data){
				$('#bjgl_glyhm').val(data.adminuser);
				$('#bjgl_glqx').val(data.quanxian);
				$('#bjgl_glzt').val(data.status);
				$('#bjgl_user').attr("val",data.adminuser);
				$("#bjgl_glzt option[value='"+data.status+"']").attr("selected",true);
				$('#bjgl_glzt').selected('destroy');
				$('#bjgl_glzt').selected();
				$('#bjzh').modal();
			},
			error:function(){
				$('#ts').modal();
				$('#te').html("获取数据错误");
			},
		})
	}
	
	function bcbianji(obj){//保存
		$.ajax({
			url:'',
			data:{
				user:$('#bjgl_glyhm').val(),
				qx:$('#bjgl_glqx').val(),
				zt:$('#bjgl_glzt').val(),
				mm:$('#bjgl_glmm').val(),
				action:'bcbianji',
			},
			dataType:'JSON',
			type:'POST',
			success:function(data){
				$('#ts').modal();
				$('#te').html(data.te);
				if(data.ok){
					$('#bjzh').modal('close');
					setTimeout(function(){
						window.location.reload();//刷新页面
					},1000);
				}
			},
			error:function(){
				$('#ts').modal();
				$('#te').html("获取数据错误");
			},
		})
	}
	
	
	function tjgl(obj){//添加管理
		$.ajax({
			url:'',
			data:{
				user:$('#tjgl_user').val(),
				pass:$('#tjgl_pass').val(),
				quanxian:$('#tjgl_quanxian').val(),
				status:$('#tjgl_status').val(),
				action:'tianjia',
			},
			dataType:'JSON',
			type:'POST',
			success:function(data){
				$('#ts').modal();
				$('#te').html(data.te);
				if(data.ok){
					$('#tjgl').modal('close');
					setTimeout(function(){
						window.location.reload();//刷新页面
					},1000);
				}
			},
			error:function(){
				$('#ts').modal();
				$('#te').html("获取数据错误");
			},
		})
	}
	
	
	function sc(obj){//删除管理
		$('#scmodal').modal({
			onConfirm: function() {
				$.ajax({
					url:'',
					data:{
						action:'shanchu',
						user:$(obj).attr('val'),
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
						$('#te').html("获取数据错误");
					}
				})
			},
			onCancel: function() {   //取消
				return
			}
		})
	}
</script>
<script type="text/javascript">
$(function(){
	$('#jhgllb').addClass('active');

})
</script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>