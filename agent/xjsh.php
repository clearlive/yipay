<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["agent"])){
		header("location:login.php");
		exit;
	}
	$agentuser=$_SESSION["agent"];
	
	if(@$_POST['action']=='agentszfl'){//代理商修改商户费率
		if(@$_POST['user']!=null or isszzm($_POST['user'])){
			$yhm=uhtml(check(trim($_POST['user'])));
			$yhsj=queryall(co_user_sys,"where user='$yhm'");
			echo json_encode(array("feilv"=>$yhsj['feilv']));
			exit;
		}
	}

	if(@$_POST['action']=='bcszfl'){//保存商户费率
		if(@$_POST['user']==null or !isszzm($_POST['user'])){
			echo json_encode(array("te"=>"商户错误"));
			exit;
		}else if(@$_POST['userfeilv']==null or !isszxsd($_POST['userfeilv']) or $_POST['userfeilv']<0.01){
			echo json_encode(array("te"=>"费率填写错误"));
			exit;
		}
		$yhm=uhtml(check(trim($_POST['user'])));
		$userfeilv=uhtml(check(trim($_POST['userfeilv'])));
		queryg(co_user_sys,"feilv='$userfeilv' where user='$yhm'");
		echo json_encode(array("te"=>"修改成功","ok"=>"ok"));
		exit;
	}
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>下级商户 - <?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 下级商户 <small>v 2.0</small></div>
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
                                                <th>编号</th>
                                                <th>用户名</th>
                                                <th>实名认证</th>
                                                <th>认证类型</th>
                                                <th>API权限</th>
                                                <th>费率</th>
                                                <th>上级</th>
                                                <th>账户状态</th>
                                                <th>注册时间</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											$zs=querydb(co_user_sys,"where daili='$agentuser'");//总条数
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
											$sql=mysql_query("select * from co_user_sys where daili='$agentuser' ORDER BY id DESC limit $djt,$my");
											$i=$djt+1;
											while($agent_user=mysql_fetch_assoc($sql)){
												if($agent_user['shiming']=='yes'){//实名认证
													$agent_user['shiming']='已实名';
												}else{
													$agent_user['shiming']='未实名';
												}
												if($agent_user['rzlx']=='gr'){//认证类型
													$agent_user['rzlx']='个人';
												}else if($agent_user['rzlx']=='qy'){
													$agent_user['rzlx']='企业';
												}else{
													$agent_user['rzlx']='无';
												}
												if($agent_user['api']=='yes'){//API权限
													$agent_user['api']='已开通';
												}else{
													$agent_user['api']='未开通';
												}
												if($agent_user['feilv']==null){//API权限
													$agent_user['feilv']='<a onclick="agentszfl(this)" val="'.$agent_user['user'].'" class="am-badge am-badge-danger am-radius">暂无</a>';
												}else{
													$agent_user['feilv']='<a onclick="agentszfl(this)" val="'.$agent_user['user'].'" class="am-badge am-badge-success am-radius">'.$agent_user['feilv'].'</a>';
												}
												if($agent_user['daili']==''){//上级代理
													$agent_user['daili']='无';
												}
												if($agent_user['status']=='jihuo'){//用户状态
													$agent_user['status']='正常';
												}else{
													$agent_user['status']='锁定';
												}
												echo '
											<tr class="gradeX">
                                                <td>'.$i.'</td>
                                                <td>'.$agent_user['user'].'</td>
                                                <td>'.$agent_user['shiming'].'</td>
                                                <td>'.$agent_user['rzlx'].'</td>
                                                <td>'.$agent_user['api'].'</td>
                                                <td>'.$agent_user['feilv'].'</td>
                                                <td>'.$agent_user['daili'].'</td>
                                                <td>'.$agent_user['status'].'</td>
                                                <td>'.$agent_user['zcsj'].'</td>
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
                                            <a href="xjsh.php">首页</a>
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
<!--div id="szuserfl" class="am-modal" tabindex="-1">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">设置费率
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
		<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
			<div class="widget am-cf">
				<div class="widget-body am-fr">
					<div class="am-alert am-alert-success" data-am-alert>
						<button type="button" class="am-close">&times;</button>
						<p>当前系统费率：<br>
						<?php
							$sql=mysql_query("select * from co_api");
							while($apimrfl=mysql_fetch_assoc($sql)){
								echo '<a class="am-badge am-badge-danger am-radius">'.$apimrfl['name'].'：'.$apimrfl['apifl'].'</a><br>';
							}
						?>
						</p>
					</div>
					<form class="tpl-form-border-form">
						<div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">设置费率：</label>
							<div class="am-u-sm-2">
							</div>
							<div class="am-u-sm-7">
								<input type="text" class="tpl-form-input" id="xgfeilv" placeholder="请勿低于系统费率(低于系统费率将失效)" value="">
							</div>
						</div> 					
						<div id="szapi" class="am-u-sm-6 am-u-sm-push-3">
							<button type="button" onclick="szfl(this)" id="bcszfl" val="" class="am-btn am-btn-primary tpl-btn-bg-color-success ">保存设置</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
  </div>
</div-->
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
	$('#jhxjsh').addClass('active');

})

	function agentszfl(obj){
		$('#szuserfl').modal();
		$.ajax({
			url:'',
			data:{
				user:$(obj).attr("val"),
				action:'agentszfl',
			},
			type:'POST',
			dataType:'JSON',
			success:function(data){
				$('#xgfeilv').val(data.feilv);
				$('#bcszfl').attr("val",$(obj).attr("val"));
			},
			error:function(){
				$('#ts').modal();
				$('#te').html("获取数据错误");
			}
		});
	}
	
	function szfl(obj){
		$.ajax({
			url:'',
			data:{
				user:$(obj).attr("val"),
				userfeilv:$('#xgfeilv').val(),
				action:'bcszfl',
			},
			type:'POST',
			dataType:'JSON',
			success:function(data){
				$('#ts').modal();
				$('#te').html(data.te);
				if(data.ok){
					$('#szuserfl').modal('close');
					setTimeout(function(){
						window.location.reload();//刷新
					},1000);
				}
			},
			error:function(){
				$('#ts').modal();
				$('#te').html("获取数据错误");
			}
		});
	}
</script>
</body>
</html>