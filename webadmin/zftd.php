<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["admin"])){
		header("location:login.php");
		exit;
	}
	if(@$_POST['action']=='chakan'){//查看通道
		if(empty($_POST['id']) or !issz($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=uhtml(check(trim($_POST["id"])));
		$zftd=queryall(co_api,"where id='$id'");
		echo json_encode($zftd,true);
		exit;
	}
	if(@$_POST['action']=='shanchu'){//删除通道
		if(empty($_POST['id']) or !issz($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=uhtml(check(trim($_POST["id"])));
		querys(co_api,"where id='$id'");
		echo json_encode(array("te"=>"删除成功！","ok"=>"ok"),true);
		exit;
	}
	if(@$_POST['action']=='baocun'){//保存设置
		if(empty($_POST['id']) or !issz($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}else if(empty($_POST['apiname']) or strlen($_POST['apiname'])>9){
			echo json_encode(array("te"=>"通道代码不规范"));
			exit;
		}else if(empty($_POST['name']) or strlen($_POST['name'])>9){
			echo json_encode(array("te"=>"通道名称不规范"));
			exit;
		}else if(empty($_POST['uid']) or strlen($_POST['uid'])>30){
			echo json_encode(array("te"=>"接口UID不规范"));
			exit;
		}else if(empty($_POST['zh']) or strlen($_POST['zh'])>30){
			echo json_encode(array("te"=>"接口账户不规范"));
			exit;
		}else if(empty($_POST['key']) or strlen($_POST['key'])>40){
			echo json_encode(array("te"=>"接口KEY不规范"));
			exit;
		}else if(empty($_POST['fl']) or !isszxsd($_POST['fl'])){
			echo json_encode(array("te"=>"通道费率不规范"));
			exit;
		}else if(empty($_POST['img']) or strlen($_POST['img'])>60){
			echo json_encode(array("te"=>"通道图标不规范"));
			exit;
		}else if(empty($_POST['sm']) or strlen($_POST['sm'])>100){
			echo json_encode(array("te"=>"通道说明不规范"));
			exit;
		}
		$apiname=addslashes(trim($_POST['apiname']));
		$name=addslashes(trim($_POST['name']));
		$uid=addslashes(trim($_POST['uid']));
		$zh=addslashes(trim($_POST['zh']));
		$key=addslashes(trim($_POST['key']));
		$zt=addslashes(trim($_POST['zt']));
		$fl=addslashes(trim($_POST['fl']));
		$img=addslashes(trim($_POST['img']));
		$sm=addslashes(trim($_POST['sm']));
		$id=addslashes(trim($_POST['id']));
		queryg(co_api,"apiname='$apiname',name='$name',apiuid='$uid',apizh='$zh',apikey='$key',status='$zt',apifl='$fl',apiimg='$img',apism='$sm' where id='$id'");
		echo json_encode(array("te"=>"保存成功！","ok"=>"ok"),true);
		exit;
	}
	if(@$_POST['action']=='zengjia'){//增加通道
		if(empty($_POST['apiname']) or strlen($_POST['apiname'])>9){
			echo json_encode(array("te"=>"通道代码不规范"));
			exit;
		}else if(empty($_POST['name']) or strlen($_POST['name'])>9){
			echo json_encode(array("te"=>"通道名称不规范"));
			exit;
		}else if(empty($_POST['uid']) or strlen($_POST['uid'])>30){
			echo json_encode(array("te"=>"接口UID不规范"));
			exit;
		}else if(empty($_POST['zh']) or strlen($_POST['zh'])>30){
			echo json_encode(array("te"=>"接口账户不规范"));
			exit;
		}else if(empty($_POST['key']) or strlen($_POST['key'])>40){
			echo json_encode(array("te"=>"接口KEY不规范"));
			exit;
		}else if(empty($_POST['fl']) or !isszxsd($_POST['fl'])){
			echo json_encode(array("te"=>"通道费率不规范"));
			exit;
		}else if(empty($_POST['img']) or strlen($_POST['img'])>60){
			echo json_encode(array("te"=>"通道图标不规范"));
			exit;
		}else if(empty($_POST['sm']) or strlen($_POST['sm'])>60){
			echo json_encode(array("te"=>"通道说明不规范"));
			exit;
		}
		$apiname=addslashes(trim($_POST['apiname']));
		$name=addslashes(trim($_POST['name']));
		$uid=addslashes(trim($_POST['uid']));
		$zh=addslashes(trim($_POST['zh']));
		$key=addslashes(trim($_POST['key']));
		$zt=addslashes(trim($_POST['zt']));
		$fl=addslashes(trim($_POST['fl']));
		$img=addslashes(trim($_POST['img']));
		$sm=addslashes(trim($_POST['sm']));
		queryz(co_api,"apiname,name,apiuid,apizh,apikey,status,apifl,apiimg,apism","'$apiname','$name','$uid','$zh','$key','$zt','$fl','$img','$sm'");
		echo json_encode(array("te"=>"新增成功！","ok"=>"ok"),true);
		exit;
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>支付通道 - 系统后台 -<?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 支付通道 <small>v 2.0</small></div>
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
						<li><a class="am-animation-scale-up" href="javascript:$('#zjtd').modal();"><i class="am-icon-angle-double-right" aria-hidden="true"></i>　增加通道</a></li>
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
                                                <th>编号</th>
                                                <th>图标</th>
                                                <th>通道名称</th>
                                                <th>通道代码</th>
                                                <th>接口UID</th>
                                                <th>接口账号</th>
                                                <th>接口KEY</th>
                                                <th>费率</th>
                                                <th>说明</th>
                                                <th>状态</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											$zs=querydb(co_api);//总条数
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
											$sql=mysql_query("select * from co_api ORDER BY id DESC limit $djt,$my");
											$i=$djt+1;
											while($api=mysql_fetch_assoc($sql)){
												if($api['status']=='yes'){
													$api['status']='<a class="am-badge am-badge-success am-radius">开启</a>';
												}else if($api['status']=='no'){
													$api['status']='<a class="am-badge am-badge-danger am-radius">关闭</a>';
												}
												echo '
											<tr class="gradeX ">
                                                <td class="am-text-middle">'.$i.'</td>
                                                <td class="am-text-middle"><img width="50px;" class="tpl-table-line-img" src="'.$api['apiimg'].'"></td>
                                                <td class="am-text-middle">'.$api['name'].'</td>
                                                <td class="am-text-middle">'.$api['apiname'].'</td>
                                                <td class="am-text-middle">'.$api['apiuid'].'</td>
                                                <td class="am-text-middle">'.$api['apizh'].'</td>
                                                <td class="am-text-middle">'.$api['apikey'].'</td>
                                                <td class="am-text-middle">'.$api['apifl'].'</td>
                                                <td class="am-text-middle">'.$api['apism'].'</td>
                                                <td class="am-text-middle">'.$api['status'].'</td>
                                                <td class="am-text-middle">
                                                    <div class="tpl-table-black-operation">
                                                        <span onclick="bj(this)" val="'.$api['id'].'"><a href="javascript:;" class="tpl-table-black-operation-info">
                                                            <i class="am-icon-pencil"></i> 编辑
                                                        </a></span>
                                                        <span onclick="sc(this)" val="'.$api['id'].'"><a href="javascript:void(0)" class="tpl-table-black-operation-del">
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
                                            <a href="zftd.php">首页</a>
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
<!-----编辑通道----->
<div id="bjtd" class="am-modal am-modal-no-btn" tabindex="-1">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">编辑通道
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
	<hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
<div class="am-g">
  <div class="am-u-md-8 am-u-sm-centered">
    <form class="am-form">
      <fieldset class="am-form-set">
        <input type="text" value="" id="bjtd_apiname" placeholder="通道代码"><br>
        <input type="text" value="" id="bjtd_name" placeholder="通道名称"><br>
        <input type="text" value="" id="bjtd_uid" placeholder="接口UID"><br>
        <input type="text" value="" id="bjtd_zh" placeholder="接口账号"><br>
        <input type="text" value="" id="bjtd_key" placeholder="接口KEY"><br>
        <input type="text" value="" id="bjtd_fl" placeholder="费率"><br>
        <input type="text" value="" id="bjtd_img" placeholder="图标链接"><br>
        <textarea class="" rows="5" value="" id="bjtd_sm" placeholder="接口说明"></textarea><br>
        <input type="radio" value="yes" name="bjtd_zt"> 开启通道
		<input type="radio" value="no" name="bjtd_zt"> 关闭通道
      </fieldset>
      <button id="bjtd_id" onclick="bc(this)" value="" type="button" class="am-btn am-btn-primary am-btn-block">保存</button>
    </form>
  </div>
</div>
	</div>
  </div>
</div>
<!-----编辑通道----->

<!-----增加通道----->
<div id="zjtd" class="am-modal am-modal-no-btn" tabindex="-1">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">增加通道
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
	<hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
<div class="am-g">
  <div class="am-u-md-8 am-u-sm-centered">
    <form class="am-form">
      <fieldset class="am-form-set">
        <input type="text" value="" id="zjtd_apiname" placeholder="通道代码"><br>
        <input type="text" value="" id="zjtd_name" placeholder="通道名称"><br>
        <input type="text" value="" id="zjtd_uid" placeholder="接口UID"><br>
        <input type="text" value="" id="zjtd_zh" placeholder="接口账号"><br>
        <input type="text" value="" id="zjtd_key" placeholder="接口KEY"><br>
        <input type="text" value="" id="zjtd_fl" placeholder="费率"><br>
        <input type="text" value="" id="zjtd_img" placeholder="图标链接"><br>
        <textarea class="" rows="5" value="" id="zjtd_sm" placeholder="接口说明"></textarea><br>
        <input type="radio" value="yes" name="zjtd_zt"> 开启通道
		<input type="radio" value="no" name="zjtd_zt"> 关闭通道
      </fieldset>
      <button onclick="zj()" type="button" class="am-btn am-btn-primary am-btn-block">新增</button>
    </form>
  </div>
</div>
	</div>
  </div>
</div>
<!-----增加通道----->

<!-----删除提示----->
<div class="am-modal am-modal-confirm" tabindex="-1" id="scmodal">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">删除操作</div>
    <div class="am-modal-bd">
      真的要删除这个通道吗？(谨慎执行!)
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
	function bj(obj){//编辑通道
		$('#bjtd').modal();
		$.ajax({
			url:'',
			data:{
				id:$(obj).attr('val'),
				action:'chakan',
			},
			dataType:'JSON',
			type:'POST',
			success:function(data){
				$('#bjtd_apiname').val(data.apiname);
				$('#bjtd_name').val(data.name);
				$('#bjtd_uid').val(data.apiuid);
				$('#bjtd_zh').val(data.apizh);
				$('#bjtd_key').val(data.apikey);
				$('#bjtd_fl').val(data.apifl);
				$('#bjtd_img').val(data.apiimg);
				$('#bjtd_sm').val(data.apism);
				$('#bjtd_id').val(data.id);
				$("input[name=bjtd_zt][value="+data.status+"]").attr("checked",true);
			},
			error:function(){
				$('#ts').modal();
				$('#te').html("获取数据错误");
			},
		})
	}
	
	function zj(){//增加通道
		$.ajax({
			url:'',
			data:{
				apiname:$('#zjtd_apiname').val(),
				name:$('#zjtd_name').val(),
				uid:$('#zjtd_uid').val(),
				zh:$('#zjtd_zh').val(),
				key:$('#zjtd_key').val(),
				zt:$('input:radio[name="zjtd_zt"]:checked').val(),
				fl:$('#zjtd_fl').val(),
				img:$('#zjtd_img').val(),
				sm:$('#zjtd_sm').val(),
				id:$('#zjtd_id').val(),
				action:'zengjia',
			},
			dataType:'JSON',
			type:'POST',
			success:function(data){
				$('#ts').modal();
				$('#te').html(data.te);
				if(data.ok){
					$('#zjtd').modal('close');
					setTimeout(function(){						
						window.location.reload();//刷新页面
					},2000);
				}
			},
			error:function(){
				$('#ts').modal();
				$('#te').html("获取数据错误");
			},
		})
	}
	
	
	function bc(obj){
		$.ajax({
			url:'',
			data:{
				apiname:$('#bjtd_apiname').val(),
				name:$('#bjtd_name').val(),
				uid:$('#bjtd_uid').val(),
				zh:$('#bjtd_zh').val(),
				key:$('#bjtd_key').val(),
				zt:$('input:radio[name="bjtd_zt"]:checked').val(),
				fl:$('#bjtd_fl').val(),
				img:$('#bjtd_img').val(),
				sm:$('#bjtd_sm').val(),
				id:$('#bjtd_id').val(),
				action:'baocun',
			},
			dataType:'JSON',
			type:'POST',
			success:function(data){
				$('#ts').modal();
				$('#te').html(data.te);
				if(data.ok){
					$('#bjtd').modal('close');
					setTimeout(function(){						
						window.location.reload();//刷新页面
					},2000);
				}
			},
			error:function(){
				$('#ts').modal();
				$('#te').html("获取数据错误");
			},
		})
	}
	function sc(obj){
		$('#scmodal').modal({
			onConfirm: function() {//确定
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
							},2000);
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
	$('#jhhxpz').addClass('active');
	$("#jhhxpzlb").css("display","block");
	$('#jhzftd').addClass('sub-active');

})
</script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>