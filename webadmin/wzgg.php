<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["admin"])){
		header("location:login.php");
		exit;
	}
	if(@$_POST['action']=='chakan'){//查看公告详情
		if(empty($_POST['id']) or !issz($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=uhtml(check(trim($_POST["id"])));
		$ggxq=queryall(co_gonggao,"where id='$id'");
		echo json_encode($ggxq,true);
		exit;
	}
	if(@$_POST['action']=='bianji'){//编辑公告详情
		if(empty($_POST['id']) or !issz($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=uhtml(check(trim($_POST["id"])));
		$title=addslashes(trim($_POST["title"]));
		$content=addslashes(trim($_POST["content"]));
		$time=addslashes(trim($_POST["time"]));
		queryg(co_gonggao,"title='$title',content='$content',time='$time' where id='$id'");
		echo json_encode(array("te"=>"已保存！","ok"=>"ok"),true);
		exit;
	}
	if(@$_POST['action']=='fabu'){//发布公告
		if(empty($_POST['title'])){
			echo json_encode(array("te"=>"标题不能为空"));
			exit;
		}else if(empty($_POST['content'])){
			echo json_encode(array("te"=>"内容不能为空"));
			exit;
		}else if(empty($_POST['time'])){
			echo json_encode(array("te"=>"时间不能为空"));
			exit;
		}
		$title=addslashes(trim($_POST["title"]));
		$content=addslashes(trim($_POST["content"]));
		$time=addslashes(trim($_POST["time"]));
		queryz(co_gonggao,"title,content,time","'$title','$content','$time'");
		echo json_encode(array("te"=>"发布成功","ok"=>"ok"),true);
		exit;
	}
	if(@$_POST['action']=='shanchu'){//删除公告
		if(empty($_POST['id']) or !issz($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=uhtml(check(trim($_POST["id"])));
		querys(co_gonggao,"where id='$id'");
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
			querys(co_gonggao,"where id='$id[$i]'");
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
    <title>网站公告 - 系统后台 -<?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 网站公告 <small>v 2.0</small></div>
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
						<!--<ul class="am-dropdown-content">
						<li><a class="am-animation-scale-up" href="javascript:$('#fbgg').modal();"><i class="am-icon-angle-double-right" aria-hidden="true"></i>　发布公告</a></li>
						</ul>-->
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
                                                <th>公告标题</th>
                                                <th>公告内容</th>
                                                <th>发布时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											$zs=querydb(co_gonggao);//总条数
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
											$sql=mysql_query("select * from co_gonggao ORDER BY id DESC limit $djt,$my");
											$i=$djt+1;
											while($wzgg=mysql_fetch_assoc($sql)){
												echo '
											<tr class="gradeX">
                                                <td><input type="checkbox" class="a" name="x" value="'.$wzgg['id'].'">'.$i.'</td>
                                                <td>'.substr($wzgg['title'],0,60).'</td>
                                                <td>'.substr($wzgg['content'],0,60).'</td>
                                                <td>'.$wzgg['time'].'</td>
                                                <td>
                                                    <div class="tpl-table-black-operation">
                                                        <span onclick="ck(this)" val="'.$wzgg['id'].'"><a href="javascript:;" class="tpl-table-black-operation">
                                                            <i class="am-icon-eye"></i> 查看
                                                        </a></span>
                                                        <span onclick="bj(this)" val="'.$wzgg['id'].'"><a href="javascript:;" class="tpl-table-black-operation-info">
                                                            <i class="am-icon-check-square"></i> 编辑
                                                        </a></span>
                                                        <span onclick="sc(this)" val="'.$wzgg['id'].'"><a href="javascript:void(0)" class="tpl-table-black-operation-del">
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
                                            <a href="wzgg.php">首页</a>
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
<div id="ggxq" class="am-modal am-modal-no-btn" tabindex="-1">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">公告详情
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
  <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
<table class="am-table am-table-bordered am-table-radius am-table-striped">
    <tbody>
        <tr>
            <td style="background-color:#dedede;width:20%">标题：</td>
            <td id="ggxq_title"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">内容：</td>
            <td id="ggxq_content"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">时间：</td>
            <td id="ggxq_time"></td>
        </tr>
    </tbody>
</table>
    </div>
  </div>
</div>
<!-----详情框----->

<!-----删除提示----->
<div class="am-modal am-modal-confirm" tabindex="-1" id="scmodal">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">删除操作</div>
    <div class="am-modal-bd">
      真的要删除这条公告吗？
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>确定</span>
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!-----删除提示----->

<!-----编辑公告----->
<div id="bjgg" class="am-modal am-modal-no-btn" tabindex="-1">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">编辑公告
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
		<hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
<div class="am-g">
  <div class="am-u-md-8 am-u-sm-centered">
    <form class="am-form">
      <fieldset class="am-form-set">
        <input type="text" value="" id="ggbj_title" placeholder="公告标题"><br>
		<textarea rows="5" value="" id="ggbj_content" placeholder="发布内容"></textarea><br>
        <input type="text" value="" id="ggbj_time" placeholder="发布时间"><br>
      </fieldset>
      <!--<button id="ggbj_id" onclick="bc(this)" value="" type="button" class="am-btn am-btn-primary am-btn-block">保存</button>-->
    </form>
  </div>
</div>
	</div>
  </div>
</div>
<!-----编辑公告----->

<!-----发布公告----->
<div id="fbgg" class="am-modal am-modal-no-btn" tabindex="-1">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">发布公告
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
		<hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
<div class="am-g">
  <div class="am-u-md-8 am-u-sm-centered">
    <form class="am-form">
      <fieldset class="am-form-set">
        <input type="text" value="" id="ggfb_title" placeholder="公告标题"><br>
		<textarea rows="5" value="" id="ggfb_content" placeholder="发布内容"></textarea><br>
        <input type="text" value="<?php echo date("Y-m-d H:i:s",time()); ?>" id="ggfb_time" placeholder="发布时间"><br>
      </fieldset>
      <button onclick="fb(this)" value="" type="button" class="am-btn am-btn-primary am-btn-block">保存</button>
    </form>
  </div>
</div>
	</div>
  </div>
</div>
<!-----发布公告----->

<!-----批量删除----->
<div class="am-modal am-modal-confirm" tabindex="-1" id="plscmodal">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">批量删除</div>
    <div class="am-modal-bd">
      删除所有选中公告吗？
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
			$('#te').html("请先选择需要删除的公告");
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

	function ck(obj){//查看公告详情
		$.ajax({
			url:'',
			data:{
				id:$(obj).attr('val'),
				action:'chakan',
			},
			dataType:'JSON',
			type:'POST',
			success:function(data){
				$('#ggxq_title').html(data.title);
				$('#ggxq_content').html(data.content);
				$('#ggxq_time').html(data.time);
				$('#ggxq_id').html(data.id);
				$('#ggxq').modal();
			},
			error:function(){
				$('#ts').modal();
				$('#te').html("获取数据错误");
			},
		})
	}
	function bj(obj){//编辑公告
		$('#bjgg').modal();
		$.ajax({
			url:'',
			data:{
				id:$(obj).attr('val'),
				action:'chakan',
			},
			dataType:'JSON',
			type:'POST',
			success:function(data){
				$('#ggbj_title').val(data.title);
				$('#ggbj_content').val(data.content);
				$('#ggbj_time').val(data.time);
				$('#ggbj_id').val(data.id);
				$('#ggbj').modal();
			},
			error:function(){
				$('#ts').modal();
				$('#te').html("获取数据错误");
			},
		})
	}
	function bc(obj){//保存编辑
		$.ajax({
			url:'',
			data:{
				id:$(obj).val(),
				title:$('#ggbj_title').val(),
				content:$('#ggbj_content').val(),
				time:$('#ggbj_time').val(),
				action:'bianji',
			},
			dataType:'JSON',
			type:'POST',
			success:function(data){
				$('#ts').modal();
				$('#te').html(data.te);
				if(data.ok){
					$('#bjgg').modal('close');
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
	function fb(obj){//发布公告
		$.ajax({
			url:'',
			data:{
				title:$('#ggfb_title').val(),
				content:$('#ggfb_content').val(),
				time:$('#ggfb_time').val(),
				action:'fabu',
			},
			dataType:'JSON',
			type:'POST',
			success:function(data){
				$('#ts').modal();
				$('#te').html(data.te);
				if(data.ok){
					$('#fbgg').modal('close');
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
	function sc(obj){//删除公告
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
	$('#jhwzgg').addClass('active');

})
</script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>