<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["admin"])){
		header("location:login.php");
		exit;
	}
	if(@$_POST['action']=='chakan'){//查看订单详情
		if(empty($_POST['id']) or !issz($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=uhtml(check(trim($_POST["id"])));
		$ddxq=queryall(co_diaodan,"where id='$id'");
		echo json_encode($ddxq,true);
		exit;
	}
	if(@$_POST['action']=='shanchu'){//删除订单
		if(empty($_POST['id']) or !issz($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=uhtml(check(trim($_POST["id"])));
		querys(co_diaodan,"where id='$id'");
		echo json_encode(array("te"=>"删除完成！","ok"=>"ok"),true);
		exit;
	}
	if(@$_POST['action']=='plsc'){//批量删除订单
		if(empty($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=$_POST['id'];
		for($i=0;$i<count($id);$i++){
			$id[$i]=uhtml(check(trim($id[$i])));
			querys(co_diaodan,"where id='$id[$i]'");
		}
		echo json_encode(array("te"=>"删除完成！","ok"=>"ok"),true);
		exit;
	}
	//被动执行订单状态更改
	$dqxtsj=time();
	queryg(co_dingdan,"ddzt='fail',ddtzzt='订单已失效' where ddzt='wait' and ddsxsj < '$dqxtsj'");
	queryg(co_diaodan,"ddzt='fail',ddtzzt='订单已失效' where ddzt='wait' and ddsxsj < '$dqxtsj'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>黑单记录 - 系统后台 -<?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 黑单记录 <small>v 2.0</small></div>
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
                                                <th>商户名</th>
                                                <th>类型</th>
                                                <th>订单号</th>
                                                <th>处理时间</th>
                                                <th>支付通道</th>
                                                <th>金额</th>
                                                <th>状态</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											$zs=querydb(co_diaodan);//总条数
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
											$sql=mysql_query("select * from co_diaodan ORDER BY id DESC limit $djt,$my");
											$i=$djt+1;
											while($hdjl=mysql_fetch_assoc($sql)){
												if($hdjl['ddzt']=='success'){
													$hdjl['ddzt']='<a class="am-badge am-badge-success am-radius">成功</a>';
												}else if($hdjl['ddzt']=='fail'){
													$hdjl['ddzt']='<a class="am-badge am-badge-danger am-radius">失败</a>';
												}else if($hdjl['ddzt']=='wait'){
													$hdjl['ddzt']='<a class="am-badge am-badge-warning am-radius">等待</a>';
												}
												echo '
											<tr class="gradeX">
                                                <td><input type="checkbox" class="a" name="x" value="'.$hdjl['id'].'">'.$i.'</td>
                                                <td>'.$hdjl['username'].'</td>
                                                <td><b style="color:red">'.$hdjl['hdlx'].'</b></td>
                                                <td>'.$hdjl['ddh'].'</td>
                                                <td>'.$hdjl['ddsj'].'</td>
                                                <td>'.$hdjl['ddtdmc'].'</td>
                                                <td>'.$hdjl['ddje'].'</td>
                                                <td>'.$hdjl['ddzt'].'</td>
                                                <td>
                                                    <div class="tpl-table-black-operation">
                                                        <span onclick="ck(this)" val="'.$hdjl['id'].'"><a href="javascript:;" class="tpl-table-black-operation-info">
                                                            <i class="am-icon-eye"></i> 查看
                                                        </a></span>
                                                        <span onclick="sc(this)" val="'.$hdjl['id'].'"><a href="javascript:void(0)" class="tpl-table-black-operation-del">
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
                                            <a href="hdjl.php">首页</a>
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
<!-----详情框----->
<div id="ddxq" class="am-modal" tabindex="-1">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">订单详情
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
  <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
<table class="am-table am-table-bordered">
    <tbody>
        <tr>
            <td style="background-color:#dedede;">平台订单号：</td>
            <td id="ddxq_ddh"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">商户订单号：</td>
            <td id="ddxq_shddh"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">提交时间：</td>
            <td id="ddxq_ddsj"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">订单金额：</td>
            <td id="ddxq_ddje"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">所得金额：</td>
            <td id="ddxq_sdje"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">支付通道：</td>
            <td id="ddxq_ddtdmc"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">订单状态：</td>
            <td id="ddxq_ddzt"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">订单名称：</td>
            <td id="ddxq_shddmc"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">订单备注：</td>
            <td id="ddxq_shddbz"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">跳转地址：</td>
            <td id="ddxq_ddtbtz"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">通知地址：</td>
            <td id="ddxq_ddybtz"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">订单通知状态：</td>
            <td id="ddxq_ddtzzt"></td>
        </tr>
    </tbody>
</table>
    </div>
  </div>
</div>
<!-----详情框----->

<!-----批量删除----->
<div class="am-modal am-modal-confirm" tabindex="-1" id="plscmodal">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">批量删除</div>
    <div class="am-modal-bd">
      删除所有选中记录吗？
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>确定</span>
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!-----批量删除----->

<!-----删除提示----->
<div class="am-modal am-modal-confirm" tabindex="-1" id="scmodal">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">删除操作</div>
    <div class="am-modal-bd">
      真的要删除这条记录吗？
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>确定</span>
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!-----删除提示----->

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
	
	function plsc(){//批量删除记录
		id=new Array();
		for(var i=0;i<$("input[name='x']").length;i++){
			if($("input[name='x']")[i].checked){
				id.push($("input[name='x']")[i].value);
			}
		}
		if(!id[0]){
			$('#ts').modal();
			$('#te').html("请先选择需要删除的记录");
			return
		}
		$('#plscmodal').modal({
			onConfirm:function(){
				$.ajax({
					url:'',
					data:{
						id:id,
						action:'plsc',
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
		});
	}
	
	function ck(obj){//查看黑单详情
		$.ajax({
			url:'',
			data:{
				id:$(obj).attr('val'),
				action:'chakan',
			},
			dataType:'JSON',
			type:'POST',
			success:function(data){
				$('#ddxq_ddh').html(data.ddh);
				$('#ddxq_ddsj').html(data.ddsj);
				$('#ddxq_ddje').html(data.ddje);
				$('#ddxq_sdje').html(data.sdje);
				$('#ddxq_ddtdmc').html(data.ddtdmc);
				$('#ddxq_ddzt').html(data.ddzt);
				$('#ddxq_ddtbtz').html(data.ddtbtz);
				$('#ddxq_ddybtz').html(data.ddybtz);
				$('#ddxq_shddh').html(data.apiddh);
				$('#ddxq_shddmc').html(data.apiddmc);
				$('#ddxq_shddbz').html(data.apiddbz);
				$('#ddxq_ddtzzt').html(data.ddtzzt);
				$('#ddxq').modal();
			},
			error:function(){
				$('#ts').modal();
				$('#te').html("获取数据错误");
			},
		})
	}
	function sc(obj){//删除记录
		$('#scmodal').modal({
			onConfirm: function() {
				$.ajax({
					url:'',
					data:{
						action:'shanchu',
						id:$(obj).attr('val'),
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
			},
			onCancel: function() {   //取消
				return
			}
		})
	}
</script>
<script type="text/javascript">
$(function(){
	$('#jhxgjl').addClass('active');
	$("#jhxgjllb").css("display","block");
	$('#jhhdjl').addClass('sub-active');

})
</script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>