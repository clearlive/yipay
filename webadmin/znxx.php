<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["admin"])){
		header("location:login.php");
		exit;
	}
	if(@$_POST['action']=='fasong'){//发送消息
		if(empty($_POST['user'])){
			echo json_encode(array("te"=>"接收用户不能为空"));
			exit;
		}else if(empty($_POST['title'])){
			echo json_encode(array("te"=>"消息标题不能为空"));
			exit;
		}else if(empty($_POST['content'])){
			echo json_encode(array("te"=>"消息内容不能为空"));
			exit;
		}else if(empty($_POST['time'])){
			echo json_encode(array("te"=>"发送时间不能为空"));
			exit;
		}
		$user=addslashes(trim($_POST["user"]));
		$title=addslashes(trim($_POST["title"]));
		$content=addslashes(trim($_POST["content"]));
		$time=addslashes(trim($_POST["time"]));
		queryz(co_xiaoxi,"to_user,msg_title,msg_text,msg_time,msg_yd","'$user','$title','$content','$time','no'");
		echo json_encode(array("te"=>"发送成功","ok"=>"ok"),true);
		exit;
	}
	if(@$_POST['action']=='shanchu'){//删除消息
		if(empty($_POST['id']) or !issz($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=uhtml(check(trim($_POST["id"])));
		querys(co_xiaoxi,"where id='$id'");
		echo json_encode(array("te"=>"删除完成！","ok"=>"ok"),true);
		exit;
	}
	if(@$_POST['action']=='plsc'){//批量删除
		if(empty($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=$_POST["id"];
		for($i=0;$i<count($id);$i++){
			$id[$i]=uhtml(check(trim($id[$i])));
			querys(co_xiaoxi,"where id='$id[$i]'");
		}
		echo json_encode(array("te"=>"删除完成！","ok"=>"ok"),true);
		exit;
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>站内消息 - 系统后台 -<?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 站内消息 <small>v 2.0</small></div>
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
						<li><a class="am-animation-scale-up" href="javascript:$('#fsxx').modal();"><i class="am-icon-angle-double-right" aria-hidden="true"></i>　发送消息</a></li>
						</ul>
						</div>
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
                                                <th>消息标题</th>
                                                <th>消息内容</th>
                                                <th>发送时间</th>
                                                <th>接收用户</th>
                                                <th>查看</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											$zs=querydb(co_xiaoxi);//总条数
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
											$sql=mysql_query("select * from co_xiaoxi ORDER BY id DESC limit $djt,$my");
											$i=$djt+1;
											while($xx=mysql_fetch_assoc($sql)){
												if($xx['msg_yd']=='no'){
													$xx['msg_yd']='<span class="am-badge am-badge-warning">未查看</span>';
												}else{
													$xx['msg_yd']='<span class="am-badge am-badge-secondary">已查看</span>';
												}
												echo '
											<tr class="gradeX">
                                                <td><input type="checkbox" class="a" name="x" value="'.$xx['id'].'">'.$i.'</td>
                                                <td>'.$xx['msg_title'].'</td>
                                                <td>'.$xx['msg_text'].'</td>
                                                <td>'.$xx['msg_time'].'</td>
                                                <td>'.$xx['to_user'].'</td>
                                                <td>'.$xx['msg_yd'].'</td>
                                                <td>
                                                    <div class="tpl-table-black-operation">
                                                        <span onclick="sc(this)" val="'.$xx['id'].'"><a href="javascript:void(0)" class="tpl-table-black-operation-del">
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
                                            <a href="znxx.php">首页</a>
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
      真的要删除这条消息吗？
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>确定</span>
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!-----删除提示----->

<!-----发送消息----->
<div id="fsxx" class="am-modal am-modal-no-btn" tabindex="-1">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">发送消息
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
		<hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
<div class="am-g">
  <div class="am-u-md-8 am-u-sm-centered">
    <form class="am-form">
      <fieldset class="am-form-set">
        <input type="text" value="" id="fsxx_user" placeholder="接收用户"><br>
        <input type="text" value="" id="fsxx_title" placeholder="消息标题"><br>
		<textarea rows="5" value="" id="fsxx_content" placeholder="消息内容"></textarea><br>
		<input type="text" value="<?php echo date("Y-m-d H:i:s",time()); ?>" id="fsxx_time" placeholder="发送时间"><br>
      </fieldset>
      <!--<button onclick="fs(this)" value="" type="button" class="am-btn am-btn-primary am-btn-block">发送</button>-->
    </form>
  </div>
</div>
	</div>
  </div>
</div>
<!-----发送消息----->

<!-----批量删除----->
<div class="am-modal am-modal-confirm" tabindex="-1" id="plscmodal">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">批量删除</div>
    <div class="am-modal-bd">
      删除所有选中消息吗？
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>确定</span>
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!-----批量删除----->

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
	
	function plsc(){//批量删除
		id=new Array();
		for(var i=0;i<$("input[name='x']").length;i++){
			if($("input[name='x']")[i].checked){
				id.push($("input[name='x']")[i].value);
			}
		}
		if(!id[0]){
			$('#ts').modal();
			$('#te').html("请先选择需要删除的消息");
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

	function fs(obj){//发送消息
		$.ajax({
			url:'',
			data:{
				user:$('#fsxx_user').val(),
				title:$('#fsxx_title').val(),
				content:$('#fsxx_content').val(),
				time:$('#fsxx_time').val(),
				action:'fasong',
			},
			dataType:'JSON',
			type:'POST',
			success:function(data){
				$('#ts').modal();
				$('#te').html(data.te);
				if(data.ok){
					$('#fsxx').modal('close');
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

	function sc(obj){//删除消息
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
	$('#jhznxx').addClass('active');

})
</script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>