<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["admin"])){
		header("location:login.php");
		exit;
	}	
	
	if(@$_POST['action']=='chakan'){//查看
		if(empty($_POST['id']) or !issz($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=uhtml(check(trim($_POST["id"])));
		$smsj=queryall(co_shiming,"where id='$id'");
		echo json_encode($smsj,true);
		exit;
	}
	
	if(@$_POST['action']=='tongguo'){//通过
		if(empty($_POST['id']) or !issz($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=uhtml(check(trim($_POST["id"])));
		$smsj=queryall(co_shiming,"where id='$id'");
		$xingming=$smsj['sfzxm'];//姓名
		$xingbie=$smsj['xingbie'];//姓名
		$sfzhm=$smsj['sfzhm'];//身份证号码
		$sfzdz=$smsj['sfzdz'];//身份证号码
		$sfzzm=$smsj['sfzzmtp'];//正面图片
		$sfzfm=$smsj['sfzfmtp'];//反面图片
		$hjszd=$smsj['hjszd'];//户籍所在地
		$rzlx=$smsj['sqlx'];//认证类型
		$rztime=$smsj['time'];//认证时间
		$dqtime=date("Y-m-d H:i:s",time());
		$yhm=$smsj['username'];
		queryz(co_xiaoxi,"to_user,msg_title,msg_text,msg_time,msg_yd","'$yhm','实名认证审核结果','尊敬的商户，您的实名认证已审核通过，相关功能已开通！','$dqtime','no'");//站内消息通知
		queryg(co_user_sys,"shiming='yes',xingming='$xingming',sfzhm='$sfzhm',sfzdz='$sfzdz',sfzzm='$sfzzm',sfzfm='$sfzfm',hjszd='$hjszd',rzlx='$rzlx',rztime='$rztime',xingbie='$xingbie' where user='$yhm'");//修改实名资料
		querys(co_shiming,"where username='$yhm'");//删除认证申请记录
		if($_POST['mail']=='yes'){
			$mail=queryall(co_user_sys,"where user='$yhm'");//取商户邮箱
			$mail=$mail['mail'];
			$flag = sendMail($mail,'实名认证审核结果 - '.$web['sitename'],"尊敬的商户，你的实名认证申请已通过，功能已开通！");//发送邮箱
			echo json_encode(array("te"=>"审核完成，已邮件通知商户！","ok"=>"ok"),true);
			exit;
		}else{
			echo json_encode(array("te"=>"已审核完成！","ok"=>"ok"),true);
			exit;
		}
	}
	
	if(@$_POST['action']=='pltg'){//批量通过
		if(empty($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=$_POST['id'];
		if($_POST['mail']=='yes'){
			for($i=0;count($id);$i++){
				$id[$i]=uhtml(check(trim($id[$i])));
				$smsj=queryall(co_shiming,"where id='$id[$i]'");
				$xingming=$smsj['sfzxm'];//姓名
				$xingbie=$smsj['xingbie'];//姓名
				$sfzhm=$smsj['sfzhm'];//身份证号码
				$sfzdz=$smsj['sfzdz'];//身份证号码
				$sfzzm=$smsj['sfzzmtp'];//正面图片
				$sfzfm=$smsj['sfzfmtp'];//反面图片
				$hjszd=$smsj['hjszd'];//户籍所在地
				$rzlx=$smsj['sqlx'];//认证类型
				$rztime=$smsj['time'];//认证时间
				$dqtime=date("Y-m-d H:i:s",time());
				$yhm=$smsj['username'];
				queryz(co_xiaoxi,"to_user,msg_title,msg_text,msg_time,msg_yd","'$yhm','实名认证审核结果','尊敬的商户，您的实名认证已审核通过，相关功能已开通！','$dqtime','no'");//站内消息通知
				queryg(co_user_sys,"shiming='yes',xingming='$xingming',sfzhm='$sfzhm',sfzdz='$sfzdz',sfzzm='$sfzzm',sfzfm='$sfzfm',hjszd='$hjszd',rzlx='$rzlx',rztime='$rztime',xingbie='$xingbie' where user='$yhm'");//修改实名资料
				querys(co_shiming,"where username='$yhm'");//删除认证申请记录
				$mail=queryall(co_user_sys,"where user='$yhm'");//取商户邮箱
				$mail=$mail['mail'];
				$flag = sendMail($mail,'实名认证审核结果 - '.$web['sitename'],"尊敬的商户，你的实名认证申请已通过，功能已开通！");//发送邮箱
			}
			echo json_encode(array("te"=>"审核完成，已邮件通知商户！","ok"=>"ok"),true);
			exit;
		}else{
			for($i=0;count($id);$i++){
				$id[$i]=uhtml(check(trim($id[$i])));
				$smsj=queryall(co_shiming,"where id='$id[$i]'");
				$xingming=$smsj['sfzxm'];//姓名
				$xingbie=$smsj['xingbie'];//姓名
				$sfzhm=$smsj['sfzhm'];//身份证号码
				$sfzdz=$smsj['sfzdz'];//身份证号码
				$sfzzm=$smsj['sfzzmtp'];//正面图片
				$sfzfm=$smsj['sfzfmtp'];//反面图片
				$hjszd=$smsj['hjszd'];//户籍所在地
				$rzlx=$smsj['sqlx'];//认证类型
				$rztime=$smsj['time'];//认证时间
				$dqtime=date("Y-m-d H:i:s",time());
				$yhm=$smsj['username'];
				queryz(co_xiaoxi,"to_user,msg_title,msg_text,msg_time,msg_yd","'$yhm','实名认证审核结果','尊敬的商户，您的实名认证已审核通过，相关功能已开通！','$dqtime','no'");//站内消息通知
				queryg(co_user_sys,"shiming='yes',xingming='$xingming',sfzhm='$sfzhm',sfzdz='$sfzdz',sfzzm='$sfzzm',sfzfm='$sfzfm',hjszd='$hjszd',rzlx='$rzlx',rztime='$rztime',xingbie='$xingbie' where user='$yhm'");//修改实名资料
				querys(co_shiming,"where username='$yhm'");//删除认证申请记录
			}
			echo json_encode(array("te"=>"已审核完成！","ok"=>"ok"),true);
			exit;
		}
	}
	
	if(@$_POST['action']=='bohui'){//驳回
		if(empty($_POST['id']) or !issz($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=uhtml(check(trim($_POST["id"])));
		$smsj=queryall(co_shiming,"where id='$id'");
		$yhm=$smsj['username'];
		$dqtime=date("Y-m-d H:i:s",time());
		queryz(co_xiaoxi,"to_user,msg_title,msg_text,msg_time,msg_yd","'$yhm','实名认证审核结果','尊敬的商户，由于您的实名认证资料不完整或不正确，申请被驳回！','$dqtime','no'");//站内消息通知
		querys(co_shiming,"where username='$yhm'");
		if($_POST['mail']=='yes'){
			$mail=queryall(co_user_sys,"where user='$yhm'");//取商户邮箱
			$mail=$mail['mail'];
			$flag = sendMail($mail,'实名认证审核结果 - '.$web['sitename'],"尊敬的商户，您的实名认证申请被驳回，请重新申请!");//发送邮箱
			echo json_encode(array("te"=>"驳回申请，已邮件通知商户！","ok"=>"ok"),true);
			exit;
		}else{
			echo json_encode(array("te"=>"已驳回申请！","ok"=>"ok"),true);
			exit;
		}
	}
	
	if(@$_POST['action']=='plbh'){//批量驳回
		if(empty($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=$_POST['id'];
		if($_POST['mail']=='yes'){
			for($i=0;$i<count($id);$i++){
				$id[$i]=uhtml(check(trim($id[$i])));
				$smsj=queryall(co_shiming,"where id='$id[$i]'");
				$yhm=$smsj['username'];
				$dqtime=date("Y-m-d H:i:s",time());
				queryz(co_xiaoxi,"to_user,msg_title,msg_text,msg_time,msg_yd","'$yhm','实名认证审核结果','尊敬的商户，由于您的实名认证资料不完整或不正确，申请被驳回！','$dqtime','no'");//站内消息通知
				querys(co_shiming,"where username='$yhm'");
				$mail=queryall(co_user_sys,"where user='$yhm'");//取商户邮箱
				$mail=$mail['mail'];
				$flag = sendMail($mail,'实名认证审核结果 - '.$web['sitename'],"尊敬的商户，您的实名认证申请被驳回，请重新申请!");//发送邮箱
			}
			echo json_encode(array("te"=>"驳回申请，已邮件通知商户！","ok"=>"ok"),true);
			exit;
		}else{
			for($i=0;$i<count($id);$i++){
				$id[$i]=uhtml(check(trim($id[$i])));
				$smsj=queryall(co_shiming,"where id='$id[$i]'");
				$yhm=$smsj['username'];
				$dqtime=date("Y-m-d H:i:s",time());
				queryz(co_xiaoxi,"to_user,msg_title,msg_text,msg_time,msg_yd","'$yhm','实名认证审核结果','尊敬的商户，由于您的实名认证资料不完整或不正确，申请被驳回！','$dqtime','no'");//站内消息通知
				querys(co_shiming,"where username='$yhm'");
			}
			echo json_encode(array("te"=>"已驳回申请！","ok"=>"ok"),true);
			exit;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>实名认证 - 系统后台 -<?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 实名审核 <small>v 2.0</small></div>
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
						<button onclick="pltg()" type="button" class="am-btn am-btn-default"><i class="am-icon-check-circle-o" aria-hidden="true"></i> 批量通过</button>
						<button onclick="plbh()" type="button" class="am-btn am-btn-default"><i class="am-icon-ban" aria-hidden="true"></i> 批量驳回</button>
					<hr>
                        <div class="widget am-cf widget-body-lg">

                            <div class="widget-body  am-fr">
                                <div class="am-scrollable-horizontal ">
                                    <table width="100%" class="am-table am-table-compact am-text-nowrap am-table-striped tpl-table-black " id="example-r">
                                        <thead>
                                            <tr>
                                                <th><label class="am-checkbox-inline"><input type="checkbox" name="all" id="all" ></label>编号</th>
                                                <th>用户名</th>
                                                <th>姓名</th>
                                                <th>户籍地址</th>
                                                <th>申请类型</th>
                                                <th>申请时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											$zs=querydb(co_shiming);//总条数
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
											$i=$djt+1;
											$sql=mysql_query("select * from co_shiming ORDER BY id DESC limit $djt,$my");
											while($shiming=mysql_fetch_assoc($sql)){
												if($shiming['sqlx']=='gr'){
													$shiming['sqlx']='个人认证';
												}else{
													$shiming['sqlx']='企业认证';
												}
												echo '
											<tr class="gradeX">
                                                <td><input type="checkbox" class="a" name="x" value="'.$shiming['id'].'">'.$i.'</td>
                                                <td>'.$shiming['username'].'</td>
                                                <td>'.$shiming['sfzxm'].'</td>
                                                <td>'.$shiming['hjszd'].'</td>
                                                <td>'.$shiming['sqlx'].'</td>
                                                <td>'.$shiming['time'].'</td>
                                                <td>
                                                    <div class="tpl-table-black-operation">
                                                        <span onclick="ck(this)" val="'.$shiming['id'].'"><a href="javascript:void(0)" class="tpl-table-black-operation-info">
                                                            <i class="am-icon-eye"></i> 查看详细
                                                        </a></span>
                                                        <span onclick="tg(this)" val="'.$shiming['id'].'"><a href="javascript:void(0)" class="tpl-table-black-operation-success">
                                                            <i class="am-icon-check-square-o"></i> 审核通过
                                                        </a></span>
                                                        <span onclick="bh(this)" val="'.$shiming['id'].'"><a href="javascript:void(0)" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-exclamation-triangle"></i> 驳回申请
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
                                            <a href="smrz.php">首页</a>
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
<div id="xq" class="am-modal am-modal-no-btn" tabindex="-1">
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
            <td><img id="zm"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">反面图片：</td>
            <td><img id="fm"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">认证类型：</td>
            <td id="rz"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">申请时间：</td>
            <td id="sj"></td>
        </tr>
    </tbody>
</table>
    </div>
  </div>
</div>
<!-----详情框----->

<!-----通过----->
<div class="am-modal am-modal-confirm" tabindex="-1" id="tgmodal">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">审核通过</div>
    <div class="am-modal-bd">
      需要发送邮件通知商户吗？
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>发送</span>
      <span class="am-modal-btn" data-am-modal-cancel>不发送</span>
    </div>
  </div>
</div>
<!-----通过----->

<!-----驳回----->
<div class="am-modal am-modal-confirm" tabindex="-1" id="bhmodal">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">驳回申请</div>
    <div class="am-modal-bd">
      需要发送邮件通知商户吗？
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>发送</span>
      <span class="am-modal-btn" data-am-modal-cancel>不发送</span>
    </div>
  </div>
</div>
<!-----驳回----->

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
<script type="text/javascript">
$(function(){
	$('#jhshgn').addClass('active');
	$("#jhshgnlb").css("display","block");
	$('#jhsmrz').addClass('sub-active');

})
</script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/smrz.js"></script>
</body>
</html>