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
		$smsj=queryall(co_khsh,"where id='$id'");
		echo json_encode($smsj,true);
		exit;
	}
	
	if(@$_POST['action']=='tongguo'){//通过
		if(empty($_POST['id']) or !issz($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=uhtml(check(trim($_POST["id"])));
		$khshzl=queryall(co_khsh,"where id='$id'");//开户资料
		$shmc=$khshzl["shmc"];//商户名称
		$shmm=md5($khshzl["shmm"]);//商户密码
		$shsj=$khshzl["shsj"];//商户手机
		$shyx=$khshzl["shyx"];//商户邮箱
		$lxqq=$khshzl["lxqq"];//联系QQ
		$shxb=$khshzl["shxb"];//商户性别
		$lxdz=$khshzl["lxdz"];//联系地址
		$sjdl=$khshzl["sjdl"];//上级代理
		$wzwz=$khshzl["wzwz"];//网站URL
		$wzmc=$khshzl["wzmc"];//网站名称
		$wzlx=$khshzl["wzlx"];//网站类型
		$zsxm=$khshzl["zsxm"];//真实姓名
		$txyh=$khshzl["txyh"];//提现银行
		$txzh=$khshzl["txzh"];//提现账号
		$hjdz=$khshzl["hjdz"];//户籍地址
		$sfhm=$khshzl["sfhm"];//身份证号码
		$sfzm=$khshzl['sfzm'];//身份证正面图片
		$sffm=$khshzl['sffm'];//身份证反面图片
		$sfdz=$khshzl["sfdz"];//身份证地址
		$shlx=$khshzl["shlx"];//商户类型
		$sj=$khshzl['sj'];//申请时间
		$apikey=randkey(40);//随机生成40位字符key
		queryz(co_user_sys,"user,pass,mail,shouji,qq,status,api,apikey,shiming,xingbie,dizhi,yue,daili,txzh,feilv,zcsj,txyh,xingming,sfzhm,sfzzm,sfzfm,sfzdz,hjszd,rztime,rzlx","'$shmc','$shmm','$shyx','$shsj','$lxqq','jihuo','yes','$apikey','yes','$shxb','$lxdz','0','$sjdl','$txzh','0.1','$sj','$txyh','$zsxm','$sfhm','$sfzm','$sffm','$sfdz','$hjdz','$sj','$shlx'");//写入商户核心表
		queryz(co_userapi,"username,alipay,weixin,yinlian,weixingz,weixinh5,alipaywap,wzurl,wzname,wzlx,lxfs,zt,sqsj","'$shmc','yes','yes','yes','yes','yes','yes','$wzwz','$wzmc','$wzlx','$shsj','yes','$sj'");//写入商户API表
		queryg(co_khsh,"zt='tongguo' where id='$id'");
		if($_POST['mail']=='yes'){
			$flag = sendMail($shyx,'开户成功提醒！ - '.$web['sitename'],"尊敬的商户，你的开户申请已通过！");//发送邮箱
			echo json_encode(array("te"=>"开户完成，已邮件通知商户！","ok"=>"ok"),true);
			exit;
		}else{
			echo json_encode(array("te"=>"开户完成！","ok"=>"ok"),true);
			exit;
		}
	}
		
	if(@$_POST['action']=='bohui'){//驳回
		if(empty($_POST['id']) or !issz($_POST['id'])){
			echo json_encode(array("te"=>"参数有误"));
			exit;
		}
		$id=uhtml(check(trim($_POST["id"])));
		$khshzl=queryall(co_khsh,"where id='$id'");//开户资料
		$shyx=$khshzl["shyx"];//商户邮箱
		querys(co_khsh,"where id='$id'");
		if($_POST['mail']=='yes'){
			$flag = sendMail($shyx,'开户失败提醒！ - '.$web['sitename'],"抱歉，你的开户申请被驳回，请重新开户!");//发送邮箱
			echo json_encode(array("te"=>"驳回申请，已邮件通知商户！","ok"=>"ok"),true);
			exit;
		}else{
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
    <title>开户审核 - 系统后台 -<?php echo $web["sitename"]; ?></title>
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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 开户审核 <small>v 2.0</small></div>
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
					<hr>
                        <div class="widget am-cf widget-body-lg">

                            <div class="widget-body  am-fr">
                                <div class="am-scrollable-horizontal ">
                                    <table width="100%" class="am-table am-table-compact am-text-nowrap am-table-striped tpl-table-black " id="example-r">
                                        <thead>
                                            <tr>
                                                <th><label class="am-checkbox-inline"><input type="checkbox" name="all" id="all" ></label>编号</th>
                                                <th>开户代理</th>
                                                <th>商户名</th>
                                                <th>真实姓名</th>
                                                <th>开户类型</th>
                                                <th>申请时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											$zs=querydb(co_khsh);//总条数
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
											$sql=mysql_query("select * from co_khsh ORDER BY id DESC limit $djt,$my");
											while($khsh=mysql_fetch_assoc($sql)){
												if($khsh['shlx']=='gr'){
													$khsh['shlx']='个人';
												}else{
													$khsh['shlx']='企业';
												}
												echo '
											<tr class="gradeX">
                                                <td><input type="checkbox" class="a" name="x" value="'.$khsh['id'].'">'.$i.'</td>
                                                <td>'.$khsh['sjdl'].'</td>
                                                <td>'.$khsh['shmc'].'</td>
                                                <td>'.$khsh['zsxm'].'</td>
                                                <td>'.$khsh['shlx'].'</td>
                                                <td>'.$khsh['sj'].'</td>
                                                <td>
                                                    <div class="tpl-table-black-operation">
                                                        <span onclick="ck(this)" val="'.$khsh['id'].'"><a href="javascript:void(0)" class="tpl-table-black-operation-info">
                                                            <i class="am-icon-eye"></i> 查看详细
                                                        </a></span>
                                                        <span onclick="tg(this)" val="'.$khsh['id'].'"><a href="javascript:void(0)" class="tpl-table-black-operation-success">
                                                            <i class="am-icon-check-square-o"></i> 审核通过
                                                        </a></span>
                                                        <span onclick="bh(this)" val="'.$khsh['id'].'"><a href="javascript:void(0)" class="tpl-table-black-operation-del">
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
                                            <a href="khsh.php">首页</a>
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
    <div class="am-modal-hd">开户资料详情
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
  <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
<table class="am-table am-table-bordered">
    <tbody>
        <tr>
            <td style="background-color:#dedede;">商户名称：</td>
            <td id="shmc"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">商户密码：</td>
            <td id="shmm"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">商户手机：</td>
            <td id="shsj"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">商户邮箱：</td>
            <td id="shyx"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">联系ＱＱ：</td>
            <td id="lxqq"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">真实姓名：</td>
            <td id="zsxm"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">商户性别：</td>
            <td id="shxb"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">身份号码：</td>
            <td id="sfhm"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">户籍地址：</td>
            <td id="hjdz"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">身份地址：</td>
            <td id="sfdz"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">正面图片：</td>
            <td><img id="sfzm"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">反面图片：</td>
            <td><img id="sffm"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">认证类型：</td>
            <td id="shlx"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">网站名称：</td>
            <td id="wzmc"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">网站网址：</td>
            <td id="wzwz"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">网站类型：</td>
            <td id="wzlx"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">提现银行：</td>
            <td id="txyh"></td>
        </tr>
        <tr>
            <td style="background-color:#dedede;">提现账号：</td>
            <td id="txzh"></td>
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
	$('#jhdlgn').addClass('active');
	$("#jhdlgnlb").css("display","block");
	$('#jhkhsh').addClass('sub-active');

})
</script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/khsh.js"></script>
</body>
</html>