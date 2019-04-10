<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["user"])){
		header("location:../login");
		exit;
	}
	$yhm=$_SESSION["user"];
	$zhye=queryall(co_user_sys,"where user='$yhm'");
	if($_POST['action'] =='xg'){
		if($zhye['shiming']=='no'){
			echo json_encode(array("te"=>"您未实名认证,不能使用提现功能!",));
			exit;
		}
		if($_POST['jsyh']==null or !ishz($_POST['jsyh']) or strlen($_POST['jsyh'])>20){
			echo json_encode(array("te"=>"结算银行有误,请修改后提交!",));
			exit;
		}else if($_POST['jszh']==null or !isszzm($_POST['jszh']) or strlen($_POST['jszh'])>21){
			echo json_encode(array("te"=>"结算账号有误,请修改后提交!",));
			exit;
		}else{
			$txyh=trim($_POST['jsyh']);
			$txzh=trim($_POST['jszh']);
			queryg(co_user_sys,"txyh='$txyh',txzh='$txzh' where user='$yhm'");
			echo json_encode(array("te"=>"修改成功!","ok"=>"ok"));
			exit;
			
		}
	}
	if($_POST['action'] =='tx'){
		if($zhye['shiming']=='no'){
			echo json_encode(array("te"=>"您未实名认证,不能使用提现功能!",));
			exit;
		}
		if($_POST['txje']==null or !issz($_POST['txje']) or strlen($_POST['txje'])>8){
			echo json_encode(array("te"=>"结算金额错误,请重新输入!",));
			exit;
		}else if($_POST['txje'] <$web['zdtxje']){
			echo json_encode(array("te"=>"提现金额最低".$web['zdtxje']."元！",));
			exit;
		}else if($zhye['yue']<$_POST['txje']){
			echo json_encode(array("te"=>"账户可用余额不足,无法结算！",));
			exit;
		}else{
			$txfl=$web['txsxf'];//提现手续费费率
			$jsje=trim($_POST['txje']);//结算金额
			$sxf=$_POST['txje']*$txfl;//手续费
			if($sxf<$web['txbdsxf']){//如果手续费小于保底手续费
				$sxf=$web['txbdsxf'];//使用保底手续费
			}
			$sjje=$_POST['txje']-$sxf;//结算金额
			$txyh=$zhye['txyh'];
			$txzh=$zhye['txzh'];
			$xingming=$zhye['xingming'];
			$jstime=date("Y-m-d H:i:s",time());
			queryz(co_jiesuan,"username,jsje,sxf,sjje,xingming,jszt,jsyh,jszh,jssj","'$yhm','$jsje','$sxf','$sjje','$xingming','no','$txyh','$txzh','$jstime'");//写入订单结算表
			queryg(co_user_sys,"yue=yue-$jsje where user='$yhm'");//商户余额处理（减去提现金额），修改余额
			echo json_encode(array("te"=>"申请成功,财务人员将会尽快处理!","ok"=>"ok"));
			exit;
			
		}
	}
	
	
?>
<!DOCTYPE html>
<html lang="ch">
    <head>        
        <!-- META SECTION -->
        <title>账户结算 - 商户中心 - <?php echo $web["sitename"]; ?></title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="/favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                   
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <?php require "head.php"; ?>
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <?php require "top.php"; ?>
                
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">商户中心</a></li>
                    <li class="active">账户结算</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-cny"></span> 账户结算</h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">                
                
                    <div class="row">
                        <div class="col-md-12">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">操作</h3>                               
                                </div>
                                <div class="panel-body">
			<blockquote>
			
				<p>
					<b style="font-size:20px;"><span class="glyphicon glyphicon-bookmark"></span> 账户可提现余额：
					<b style="color:green"><?php echo $zhye['yue']=$zhye['yue']==null?'0':$zhye['yue']; ?></b> 元 </b>　　
			<?php
				if($zhye['txyh']!=null and $zhye['txzh']!=null){
					echo '<button id="sqjs" type="button" class="btn btn-success btn-small">申请结算</button>';
				}
			?>
					
				</p>
				<hr>
			<?php
				if($zhye['shiming']=='yes'){
					if($zhye['txyh']==null or $zhye['txzh']==null){
						echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><span class="glyphicon glyphicon-exclamation-sign"></span> 提示：</strong> 当前提现信息不完整,无法使用提现功能,请<a href="#" id="ws"> 点此 </a>完善!</div>';
					}
				}else{
						echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><span class="glyphicon glyphicon-exclamation-sign"></span> 提示：</strong> 您还未进行实名认证,请<a href="sm.php"> 点此 </a>认证!</div>';
				}
			?>
				<p>
					需知：
				</p> <small><cite>金额需要大于<b style="color:red"> <?php echo $web['zdtxje']; ?> </b>元才能结算！</cite></small>
				<hr>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>提现银行</th>
                      <th>提现账号</th>
                      <th>姓名</th>
                      <th>操作</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php if($zhye['txyh']==null){echo "未设置";}else{echo $zhye['txyh'];} ?></td>
                      <td><?php if($zhye['txzh']==null){echo "未设置";}else{echo $zhye['txzh'];} ?></td>
                      <td><?php if($zhye['xingming']==null){echo "未设置";}else{echo $zhye['xingming'];} ?></td>
                      <td><button id="gg" type="button" class="btn btn-xs">更改</button></td>
                    </tr>
                  </tbody>
                </table>
			</blockquote>
				
                                </div>
                            </div>

                        </div>                   
                        <div class="col-md-12">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">结算列表</h3>                               
                                </div>
                                <div class="panel-body">
			<blockquote>
				<p>
					提示：
				</p> <small><cite>在提交结算申请后,财务人员会在3天之内为您结算！</cite></small>
			</blockquote>
                <table class="table datatable table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>编号</th>
                      <th>申请用户</th>
                      <th>提现金额</th>
                      <th>手续费</th>
                      <th>实际金额</th>
                      <th>收款姓名</th>
                      <th>收款银行</th>
                      <th>收款账号</th>
                      <th>申请时间</th>
                      <th>状态</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
					$a=mysql_query("select * from co_jiesuan where username='$yhm'");
					$i='0';
					while($yjs=mysql_fetch_array($a)){
						if($yjs["jszt"] =='yes'){
							$yjs["jszt"]='<button type="button" class="btn btn-success btn-xs">已结算</button>';
						}else{
							$yjs["jszt"]='<button type="button" class="btn btn-danger btn-xs">未结算</button>';
						}
						$i++;
						echo '
                    <tr>
                      <td>'.$i.'</td>
                      <td>'.$yjs["username"].'</td>
                      <td>'.$yjs["jsje"].'</td>
                      <td>'.$yjs["sxf"].'</td>
                      <td>'.$yjs["sjje"].'</td>
                      <td>'.$yjs["xingming"].'</td>
                      <td>'.$yjs["jsyh"].'</td>
                      <td>'.$yjs["jszh"].'</td>
                      <td>'.$yjs["jssj"].'</td>
                      <td>'.$yjs["jszt"].'</td>
                    </tr>
';
					}
				  ?>
                  </tbody>
                </table>
				
                                </div>
                            </div>

                        </div>                   
                    </div>
                
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
<div id="txxxsz" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">提现信息设置</h4>
      </div>
      <div class="modal-body">
	<div class="form-group">                                        
		<label class="control-label">姓名</label>
		<input class="form-control input" value="<?php echo $zhye['xingming'];?>" disabled="disabled"/>
	</div>
	<div class="form-group">
		<label class="control-label">结算银行</label>
				<select id="jsyh" name="jsyh" class="form-control select" <?php if($smtj['username'] == $yhm){echo 'disabled="disabled"';} ?>>
				<option value="支付宝" <?php if($zhye['txyh'] =="支付宝"){echo "selected=selected";} ?>>支付宝</option>
				<option value="财付通" <?php if($zhye['txyh'] =="财付通"){echo "selected=selected";} ?>>财付通</option>
				<option value="建设银行" <?php if($zhye['txyh'] =="建设银行"){echo "selected=selected";} ?>>建设银行</option>
				<option value="工商银行" <?php if($zhye['txyh'] =="工商银行"){echo "selected=selected";} ?>>工商银行</option>
				<option value="邮政储蓄" <?php if($zhye['txyh'] =="邮政储蓄"){echo "selected=selected";} ?>>邮政储蓄</option>
				<option value="浦发银行" <?php if($zhye['txyh'] =="浦发银行"){echo "selected=selected";} ?>>浦发银行</option>
				<option value="农业银行" <?php if($zhye['txyh'] =="农业银行"){echo "selected=selected";} ?>>农业银行</option>
				<option value="广发银行" <?php if($zhye['txyh'] =="广发银行"){echo "selected=selected";} ?>>广发银行</option>
				</select>
	</div>
	<div class="form-group">                                        
		<label class="control-label">银行账号</label>
		<input id="jszh" class="form-control input" value="<?php echo $zhye['txzh'];?>"/>
	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">放弃设置</button>
        <button id="qrbc" type="button" class="btn btn-primary">确认保存</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->        
<div id="zhtx" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">账户提现</h4>
      </div>
      <div class="modal-body">
	<div class="form-group">                                        
		<label class="control-label">姓名</label>
		<input class="form-control input" value="<?php echo $zhye['xingming'];?>" disabled="disabled"/>
	</div>
	<div class="form-group">                                        
		<label class="control-label">银行银行</label>
		<input class="form-control input" value="<?php echo $zhye['txyh'];?>" disabled="disabled"/>
	</div>
	<div class="form-group">                                        
		<label class="control-label">银行账号</label>
		<input class="form-control input" value="<?php echo $zhye['txzh'];?>" disabled="disabled"/>
	</div>
  <div class="form-group">
		<label class="control-label">提现金额（手续费率：<b style="color:red"><?php echo 1000*$web['txsxf'].'%'; ?></b>）</label>
    <div class="input-group">
      <div class="input-group-addon">￥</div>
      <input id="txje" type="text" class="form-control" onkeyup="this.value=this.value.replace(/\D/g, '')" placeholder="只能输入整数并大于<?php echo $web['zdtxje']; ?>元">
      <div class="input-group-addon">.00</div>
    </div>
  </div>
  </div>
      <div class="modal-footer">
        <button id="tjsq" type="button" class="btn btn-primary">提交申请</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->        
<div id="tishikuang" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">提示</h4>
      </div>
      <div class="modal-body">
        <p id="te"></p>
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->	
		<?php require "foot.php"; ?>
<script>
	$("#ws").click(function(){
		$('#txxxsz').modal();
	})
	$("#qrbc").click(function(){
		$.ajax({
			url:'',
			data:{
				jsyh:$('#jsyh').val(),
				jszh:$('#jszh').val(),
				action:'xg',
				
			},
			dataType:'JSON',
			type:'POST',
			success:function(data){
				$('#txxxsz').modal('hide');
				$('#tishikuang').modal();
				$('#te').html(data.te);
				if(data.ok){
					setTimeout(function(){
						window.location.reload();
					},1000);
				}
			},
			error:function(){
				$('#txxxsz').modal('hide');
				$('#tishikuang').modal();
				$('#te').html('获取数据错误');
				
			}
		})
	})
	
	$("#gg").click(function(){
		$('#txxxsz').modal();
	})
	
	$('#sqjs').click(function(){
		$('#zhtx').modal();
	})
	$('#tjsq').click(function(){
		$.ajax({
			url:'',
			data:{
				txje:$('#txje').val(),
				action:'tx',
			},
			dataType:'JSON',
			type:'POST',
			success:function(data){
				$('#tishikuang').modal();
				$('#te').html(data.te);
				if(data.ok){
					setTimeout(function(){
						window.location.reload();
					},1000);
				}
			},
			error:function(){
				$('#tishikuang').modal();
				$('#te').html('获取数据错误');
			}
		})
	})
	
</script>
        
    </body>
</html>






