<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["agent"])){
		header("location:login.php");
		exit;
	}
	$agentuser=$_SESSION["agent"];
	$agent=queryall(co_agent_sys,"where agentuser='$agentuser'");
	
	/****************************/
	if(@$_POST['action']=='dltxsq'){//提现申请
		if($_POST['dltxje']==null or !issz($_POST['dltxje']) or strlen($_POST['dltxje'])>8){
			echo json_encode(array("te"=>"结算金额错误,请重新输入!",));
			exit;
		}else if($_POST['dltxje'] <$web['zdtxje']){
			echo json_encode(array("te"=>"提现金额最低".$web['zdtxje']."元！",));
			exit;
		}else if($agent['yue']<$_POST['dltxje']){
			echo json_encode(array("te"=>"账户可用余额不足,无法结算！",));
			exit;
		}else{
			$txfl=$web['txsxf'];//提现手续费费率
			$txje=trim($_POST['dltxje']);//结算金额
			$sxf=$_POST['dltxje']*$txfl;//手续费
			if($sxf<$web['txbdsxf']){//如果手续费小于保底手续费
				$sxf=$web['txbdsxf'];//使用保底手续费
			}
			$sjje=$_POST['dltxje']-$sxf;//实际金额
			$txyh=$agent['txyh'];
			$txzh=$agent['txzh'];
			$zsxm=$agent['zsxm'];
			$jstime=date("Y-m-d H:i:s",time());
			queryz(co_agenttx,"agentuser,txje,sxf,sjje,zsxm,txzt,txyh,txzh,txsj","'$agentuser','$txje','$sxf','$sjje','$zsxm','no','$txyh','$txzh','$jstime'");//写入代理结算表
			queryg(co_agent_sys,"yue=yue-$txje where agentuser='$agentuser'");//商户余额处理（减去提现金额），修改余额
			echo json_encode(array("te"=>"申请成功,财务人员将会尽快处理!","ok"=>"ok"));
			exit;
			
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>申请提现 - <?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 申请提现 <small>v 2.0</small></div>
                    </div>
                </div>

            </div>

            <div class="row-content am-cf">
                <div class="row  am-cf">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12 widget-margin-bottom-lg">
					<?php
						if($agent['zsxm']!=null and $agent['txyh']!=null and $agent['txzh']!=null){
							echo '<div class="am-alert am-alert-secondary" data-am-alert>
						<button type="button" class="am-close">&times;</button>
						<p>姓名：'.$agent['zsxm'].'；银行：'.$agent['txyh'].'；账号：'.$agent['txzh'].'；<button onclick="javascript:lq()" type="button" class="am-btn am-btn-xs am-btn-secondary am-round"><i class="am-icon-jpy"></i> 申请提现</button></p>
					</div>';
						}else{
							echo '<div class="am-alert am-alert-danger" data-am-alert>
						<button type="button" class="am-close">&times;</button>
						<p>提示：当前代理账户提现信息未设置或不完整无法提现，请修改或联系管理员！</p>
					</div>';
						}
					?>
					
					<hr>
                        <div class="widget am-cf widget-body-lg">

                            <div class="widget-body  am-fr">
                                <div class="am-scrollable-horizontal ">
                                    <table width="100%" class="am-table am-table-compact am-text-nowrap am-table-striped tpl-table-black " id="example-r">
                                        <thead>
                                            <tr>
                                                <th>编号</th>
                                                <th>姓名</th>
                                                <th>提现银行</th>
                                                <th>提现账号</th>
                                                <th>提现金额</th>
                                                <th>手续费</th>
                                                <th>实际金额</th>
                                                <th>提现时间</th>
                                                <th>状态</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											$zs=querydb(co_agenttx,"where agentuser='$agentuser'");//总条数
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
											$sql=mysql_query("select * from co_agenttx where agentuser='$agentuser' ORDER BY id DESC limit $djt,$my");
											$i=$djt+1;
											while($sqtx=mysql_fetch_assoc($sql)){
												if($sqtx['txzt']=='yes'){
													$sqtx['txzt']='<a class="am-badge am-badge-success am-radius">已结算</a>';
												}else if($sqtx['txzt']=='no'){
													$sqtx['txzt']='<a class="am-badge am-badge-danger am-radius">未结算</a>';
												}
												echo '
											<tr class="gradeX">
                                                <td>'.$i.'</td>
                                                <td>'.$sqtx['zsxm'].'</td>
                                                <td>'.$sqtx['txyh'].'</td>
                                                <td>'.$sqtx['txzh'].'</td>
                                                <td>'.$sqtx['txje'].'</td>
                                                <td>'.$sqtx['sxf'].'</td>
                                                <td>'.$sqtx['sjje'].'</td>
                                                <td>'.$sqtx['txsj'].'</td>
                                                <td>'.$sqtx['txzt'].'</td>
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
                                            <a href="sqtx.php">首页</a>
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
<!-----申请提现----->
<div id="dltx" class="am-modal" tabindex="-1">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">申请提现
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
		<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
			<div class="widget am-cf">
				<div class="widget-body am-fr">
					<form class="tpl-form-border-form">
						<div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">提现代理：</label>
							<div class="am-u-sm-2">
							</div>
							<div class="am-u-sm-7">
								<input type="text" class="tpl-form-input" placeholder="默认" value="<?php echo $agentuser; ?>" disabled>
							</div>
						</div> 
					
						<div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">提现姓名：</label>
							<div class="am-u-sm-2">
							</div>
							<div class="am-u-sm-7">
								<input type="text" class="tpl-form-input" placeholder="" value="<?php echo $agent['zsxm']; ?>" disabled>
							</div>
						</div> 

						<div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">提现银行：</label>
							<div class="am-u-sm-2">
							</div>
							<div class="am-u-sm-7">
								<input type="text" class="tpl-form-input" placeholder="" value="<?php echo $agent['txyh']; ?>" disabled>
							</div>
						</div> 

						<div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">提现账号：</label>
							<div class="am-u-sm-2">
							</div>
							<div class="am-u-sm-7">
								<input type="text" class="tpl-form-input" placeholder="" value="<?php echo $agent['txzh']; ?>" disabled>
							</div>
						</div> 

						<div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">可用余额：</label>
							<div class="am-u-sm-2">
							</div>
							<div class="am-u-sm-7">
								<input type="text" class="tpl-form-input" placeholder="当前账户可提现余额" value="<?php echo $agent['yue']; ?>" disabled>
							</div>
						</div> 
						
						<div class="am-form-group">
							<label for="user-name" class="am-u-sm-3 am-form-label">提现金额：</label>
							<div class="am-u-sm-2">
							</div>
							<div class="am-u-sm-7">
								<input type="text" id="dltxje" class="tpl-form-input" placeholder="手续费率：<?php echo 100*$web['txsxf'].'%'; ?>" value="" >
							</div>
						</div> 
					
						<div id="ssssss" class="am-u-sm-6 am-u-sm-push-3">
							<button type="button" onclick="tjsq()" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交申请</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
  </div>
</div>
<!-----申请提现----->
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
<script type="text/javascript">
$(function(){
	$('#jhsqtx').addClass('active');

})

	function lq(){
		$("#dltx").modal();
	}
	
	function tjsq(){
		$.ajax({
			url:'',
			data:{
				dltxje:$('#dltxje').val(),
				action:'dltxsq',
			},
			type:'POST',
			dataType:'JSON',
			success:function(data){
				if(data.ok){
					$('#ssssss').before('<div id="t1"><div class="am-alert am-alert-success" data-am-alert><button type="button" class="am-close">&times;</button><p>'+data.te+'</p></div></div>');
					setTimeout(function(){
						$("#t1").remove();
						window.location.reload();//刷新
					},1500);
				}else{
					$('#ssssss').before('<div id="t2"><div class="am-alert am-alert-warning" data-am-alert><button type="button" class="am-close">&times;</button><p>'+data.te+'</p></div></div>');
					setTimeout(function(){$("#t2").remove();
					},1500)
				}
			},
			error:function(){
				$('#ssssss').before('<div id="t3"><div class="am-alert am-alert-danger" data-am-alert><button type="button" class="am-close">&times;</button><p>获取数据失败</p></div></div>');
				setTimeout(function(){$("div#t3").remove();
				},1500)
			}
		})
	}
</script>

</body>

</html>