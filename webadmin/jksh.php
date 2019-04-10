<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["admin"])){
		header("location:login.php");
		exit;
	}
	if(@$_POST['action']=='tongguo'){//审核通过
		if(empty($_POST['id']) or !issz($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=uhtml(check(trim($_POST["id"])));
		$jksj=queryall(co_userapi,"where id='$id'");//申请接口商户的数据
		$yhm=$jksj['username'];//获取商户的用户名
		$dqtime=date("Y-m-d H:i:s",time());//当前时间
		$apikey=randkey(40);//随机生成40位字符key
		queryz(co_xiaoxi,"to_user,msg_title,msg_text,msg_time,msg_yd","'$yhm','接口申请审核结果','尊敬的商户，您的接口申请已审核通过，相关功能已开通！','$dqtime','no'");//站内消息通知
		queryg(co_userapi,"zt='yes',alipay='yes',weixin='yes',yinlian='yes',weixingz='yes',weixinh5='yes',alipaywap='yes' where username='$yhm'");//修改审核状态,并开通接口
		queryg(co_user_sys,"api='yes',apikey='$apikey' where user='$yhm'");//修改API开通状态状态并生成40位字符apikey
		if($_POST['mail']=='yes'){
			$mail=queryall(co_user_sys,"where user='$yhm'");//取商户的邮箱
			$mail=$mail['mail'];
			$flag = sendMail($mail,'接口审核结果 - '.$web['sitename'],"尊敬的商户，你的接口申请已通过，功能已开通！");//发送邮件
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
		$id=$_POST["id"];
		if($_POST['mail']=='yes'){
			for($i=0;$i<count($id);$i++){
				$id[$i]=uhtml(check(trim($id[$i])));
				$jksj=queryall(co_userapi,"where id='$id[$i]'");//申请接口商户的数据
				$yhm=$jksj['username'];//获取商户的用户名
				$dqtime=date("Y-m-d H:i:s",time());//当前时间
				$apikey=randkey(40);//随机生成40位字符key
				queryz(co_xiaoxi,"to_user,msg_title,msg_text,msg_time,msg_yd","'$yhm','接口申请审核结果','尊敬的商户，您的接口申请已审核通过，相关功能已开通！','$dqtime','no'");//站内消息通知
				queryg(co_userapi,"zt='yes',alipay='yes',weixin='yes',yinlian='yes',weixingz='yes',weixinh5='yes',alipaywap='yes' where username='$yhm'");//修改审核状态,并开通接口
				queryg(co_user_sys,"api='yes',apikey='$apikey' where user='$yhm'");//修改API开通状态状态并生成40位字符apikey
				$mail=queryall(co_user_sys,"where user='$yhm'");//取商户的邮箱
				$mail=$mail['mail'];
				$flag = sendMail($mail,'接口审核结果 - '.$web['sitename'],"尊敬的商户，你的接口申请已通过，功能已开通！");//发送邮件
			}
			echo json_encode(array("te"=>"审核完成，已邮件通知商户！","ok"=>"ok"),true);
			exit;
		}else{
			for($i=0;$i<count($id);$i++){
				$id[$i]=uhtml(check(trim($id[$i])));
				$jksj=queryall(co_userapi,"where id='$id[$i]'");//申请接口商户的数据
				$yhm=$jksj['username'];//获取商户的用户名
				$dqtime=date("Y-m-d H:i:s",time());//当前时间
				$apikey=randkey(40);//随机生成40位字符key
				queryz(co_xiaoxi,"to_user,msg_title,msg_text,msg_time,msg_yd","'$yhm','接口申请审核结果','尊敬的商户，您的接口申请已审核通过，相关功能已开通！','$dqtime','no'");//站内消息通知
				queryg(co_userapi,"zt='yes',alipay='yes',weixin='yes',yinlian='yes',weixingz='yes',weixinh5='yes',alipaywap='yes' where username='$yhm'");//修改审核状态,并开通接口
				queryg(co_user_sys,"api='yes',apikey='$apikey' where user='$yhm'");//修改API开通状态状态并生成40位字符apikey
			}
			echo json_encode(array("te"=>"已审核完成！","ok"=>"ok"),true);
			exit;
		}			

	}

	
	if(@$_POST['action']=='bohui'){//审核驳回
		if(empty($_POST['id']) or !issz($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=uhtml(check(trim($_POST["id"])));
		$jksj=queryall(co_userapi,"where id='$id'");//申请接口商户的数据
		$yhm=$jksj['username'];//获取商户的用户名
		$dqtime=date("Y-m-d H:i:s",time());//当前时间
		queryz(co_xiaoxi,"to_user,msg_title,msg_text,msg_time,msg_yd","'$yhm','接口审核结果','尊敬的商户，由于您的接口申请资料不完整或不正确，申请被驳回！','$dqtime','no'");//站内消息通知
		queryg(co_userapi,"wzurl='',wzname='',wzlx='',lxfs='',zt='',sqsj='' where username='$yhm'");//修改审核状态清空申请信息
		if($_POST['mail']=='yes'){
			$mail=queryall(co_user_sys,"where user='$yhm'");//取商户邮箱
			$mail=$mail['mail'];
			$flag = sendMail($mail,'接口审核结果 - '.$web['sitename'],"尊敬的商户，您的接口申请被驳回，请重新申请!");//发送邮箱
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
		$id=$_POST["id"];
		if($_POST['mail']=='yes'){
			for($i=0;$i<count($id);$i++){
				$id[$i]=uhtml(check(trim($id[$i])));
				$jksj=queryall(co_userapi,"where id='$id[$i]'");//申请接口商户的数据
				$yhm=$jksj['username'];//获取商户的用户名
				$dqtime=date("Y-m-d H:i:s",time());//当前时间
				queryz(co_xiaoxi,"to_user,msg_title,msg_text,msg_time,msg_yd","'$yhm','接口审核结果','尊敬的商户，由于您的接口申请资料不完整或不正确，申请被驳回！','$dqtime','no'");//站内消息通知
				queryg(co_userapi,"wzurl='',wzname='',wzlx='',lxfs='',zt='',sqsj='' where username='$yhm'");//修改审核状态清空申请信息
				$mail=queryall(co_user_sys,"where user='$yhm'");//取商户邮箱
				$mail=$mail['mail'];
				$flag = sendMail($mail,'接口审核结果 - '.$web['sitename'],"尊敬的商户，您的接口申请被驳回，请重新申请!");//发送邮箱
			}
			echo json_encode(array("te"=>"驳回申请，已邮件通知商户！","ok"=>"ok"),true);
			exit;
		}else{
			for($i=0;$i<count($id);$i++){
				$id[$i]=uhtml(check(trim($id[$i])));
				$jksj=queryall(co_userapi,"where id='$id[$i]'");//申请接口商户的数据
				$yhm=$jksj['username'];//获取商户的用户名
				$dqtime=date("Y-m-d H:i:s",time());//当前时间
				queryz(co_xiaoxi,"to_user,msg_title,msg_text,msg_time,msg_yd","'$yhm','接口审核结果','尊敬的商户，由于您的接口申请资料不完整或不正确，申请被驳回！','$dqtime','no'");//站内消息通知
				queryg(co_userapi,"wzurl='',wzname='',wzlx='',lxfs='',zt='',sqsj='' where username='$yhm'");//修改审核状态清空申请信息
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
    <title>接口审核 - 系统后台 -<?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 接口审核 <small>v 2.0</small></div>
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
                                                <th>申请网址</th>
                                                <th>网站名称</th>
                                                <th>网站类型</th>
                                                <th>联系方式</th>
                                                <th>申请时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											$zs=querydb(co_userapi,"where zt='no'");//总条数
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
											$sql=mysql_query("select * from co_userapi where zt='no' ORDER BY id DESC limit $djt,$my");
											while($jksh=mysql_fetch_assoc($sql)){
												echo '
											<tr class="gradeX">
                                                <td><input type="checkbox" class="a" name="x" value="'.$jksh['id'].'">'.$i.'</td>
                                                <td>'.$jksh['username'].'</td>
                                                <td>'.$jksh['wzurl'].'</td>
                                                <td>'.$jksh['wzname'].'</td>
                                                <td>'.$jksh['wzlx'].'</td>
                                                <td>'.$jksh['lxfs'].'</td>
                                                <td>'.$jksh['sqsj'].'</td>
                                                <td>
                                                    <div class="tpl-table-black-operation">
                                                        <span onclick="tg(this)" val="'.$jksh['id'].'"><a href="javascript:void(0)" class="tpl-table-black-operation-success">
                                                            <i class="am-icon-check-square-o"></i> 通过
                                                        </a></span>
                                                        <span onclick="bh(this)" val="'.$jksh['id'].'"><a href="javascript:void(0)" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-exclamation-triangle"></i> 驳回
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
                                            <a href="jksh.php">首页</a>
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
	$('#jhjksh').addClass('sub-active');

})
</script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/jksh.js"></script>
</body>
</html>