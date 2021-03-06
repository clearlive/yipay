<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["admin"])){
		header("location:login.php");
		exit;
	}
	if(@$_POST['action']=='jiesuan'){//结算
		if(empty($_POST['id']) or !issz($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=uhtml(check(trim($_POST["id"])));
		$shjs=queryall(co_jiesuan,"where id='$id'");//商户的数据
		$yhm=$shjs['username'];//获取商户的用户名
		$dqtime=date("Y-m-d H:i:s",time());//当前时间
		queryz(co_xiaoxi,"to_user,msg_title,msg_text,msg_time,msg_yd","'$yhm','结算成功','尊敬的商户，你的提现申请已经处理,注意查账！','$dqtime','no'");//站内消息通知
		queryg(co_jiesuan,"jszt='yes' where id='$id'");//修改结算状态
		echo json_encode(array("te"=>"结算处理完成！","ok"=>"ok"),true);
		exit;
	}
	if(@$_POST['action']=='pljs'){//批量结算
		if(empty($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=$_POST["id"];
		$shjs=queryall(co_jiesuan,"where id='$id[0]'");//商户的数据
		$yhm=$shjs['username'];//获取商户的用户名
		$dqtime=date("Y-m-d H:i:s",time());//当前时间
		for($i=0;$i<count($id);$i++){
			$id[$i]=uhtml(check(trim($id[$i])));
			queryz(co_xiaoxi,"to_user,msg_title,msg_text,msg_time,msg_yd","'$yhm','结算成功','尊敬的商户，你的提现申请已经处理,注意查账！','$dqtime','no'");//站内消息通知
			queryg(co_jiesuan,"jszt='yes' where id='$id[$i]'");//修改结算状态
		}
		echo json_encode(array("te"=>"结算处理完成！","ok"=>"ok"),true);
		exit;
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>商户结算 - <?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 商户结算 <small>v 2.0</small></div>
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
						<li><a class="am-animation-scale-up" href="javascript:;"><i class="am-icon-angle-double-right" aria-hidden="true"></i></a></li>
						</ul>
						</div>
					</div>
						<button onclick="pljs()" type="button" class="am-btn am-btn-default"><i class="am-icon-money" aria-hidden="true"></i> 批量结算</button>
					<hr>
                        <div class="widget am-cf widget-body-lg">

                            <div class="widget-body  am-fr">
                                <div class="am-scrollable-horizontal ">
                                    <table width="100%" class="am-table am-table-compact am-text-nowrap am-table-striped tpl-table-black " id="example-r">
                                        <thead>
                                            <tr>
                                                <th><label class="am-checkbox-inline"><input type="checkbox" name="all" id="all" ></label>编号</th>
                                                <th>申请用户</th>
                                                <th>提现金额</th>
                                                <th>手续费</th>
                                                <th>实际金额</th>
                                                <th>收款姓名</th>
                                                <th>收款银行</th>
                                                <th>收款账号</th>
                                                <th>申请时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											$zs=querydb(co_jiesuan,"where jszt='no'");//总条数
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
											$sql=mysql_query("select * from co_jiesuan where jszt='no' ORDER BY id DESC limit $djt,$my");
											$i=$djt+1;
											while($shjs=mysql_fetch_assoc($sql)){
												echo '
											<tr class="gradeX">
                                                <td><input type="checkbox" class="a" name="x" value="'.$shjs['id'].'">'.$i.'</td>
                                                <td>'.$shjs['username'].'</td>
                                                <td>'.$shjs['jsje'].'</td>
                                                <td>'.$shjs['sxf'].'</td>
                                                <td>'.$shjs['sjje'].'</td>
                                                <td>'.$shjs['xingming'].'</td>
                                                <td>'.$shjs['jsyh'].'</td>
                                                <td>'.$shjs['jszh'].'</td>
                                                <td>'.$shjs['jssj'].'</td>
                                                <td>
                                                    <div class="tpl-table-black-operation">
                                                        <span onclick="js(this)" val="'.$shjs['id'].'"><a href="javascript:void(0)" class="tpl-table-black-operation-success">
                                                            <i class="am-icon-check-square-o"></i> 结算
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
                                            <a href="shjs.php">首页</a>
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
<!-----结算导出----->
<div class="am-modal am-modal-confirm" tabindex="-1" id="jsmodal">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">结算操作</div>
    <div class="am-modal-bd">
      给商户结算并导出结算信息XLS吗？
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>确定</span>
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!-----结算导出----->

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
	
	function pljs(){//批量结算
		id=new Array();
		for(var i=0;i<$("input[name='x']").length;i++){
			if($("input[name='x']")[i].checked){
				id.push($("input[name='x']")[i].value);
			}
		}
		if(!id[0]){
			$('#ts').modal();
			$('#te').html("请先选择需要结算的申请");
			return
		}
		$('#jsmodal').modal({
			onConfirm:function(){
				$.ajax({
					url:'',
					data:{
						id:id,
						action:'pljs',
					},
					type:'POST',
					dataType:'JSON',
					success:function(data){
						$('#ts').modal();
						$('#te').html(data.te);
						if(data.ok){
							setTimeout(function(){
								window.location='dc.php?lx=shjs&action=pljs&id='+id;
							},1000);
							setTimeout(function(){
								window.location.reload();
							},3000);
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
	
	function js(obj){//结算
		$('#jsmodal').modal({
			onConfirm:function(){
				$.ajax({
					url:'',
					data:{
						id:$(obj).attr("val"),
						action:'jiesuan',
					},
					type:'POST',
					dataType:'JSON',
					success:function(data){
						$('#ts').modal();
						$('#te').html(data.te);
						if(data.ok){
							setTimeout(function(){
								window.location='dc.php?lx=shjs&action=js&id='+$(obj).attr("val");
							},1000);
							setTimeout(function(){
								window.location.reload();
							},3000);
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
	$('#jhshgn').addClass('active');
	$("#jhshgnlb").css("display","block");
	$('#jhshjs').addClass('sub-active');

})
</script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>