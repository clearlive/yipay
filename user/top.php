<?php
	if(!$weblock){//防止访问单文件
		header("location:../");
		exit;
	}
?>
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
                    </li> 
                    <!-- END SIGN OUT -->
                    <!-- MESSAGES -->
					<?php
						$num=querydb(co_xiaoxi,"where to_user='$k' and msg_yd='no'");
					?>
                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-comments"></span></a>
                        <?php if($num !=""){echo '<div class="informer informer-danger">'.$num.'</div>';} ?>
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-comments"></span>系统消息</h3>                                
                            </div>
                            <div class="panel-body list-group list-group-contacts scroll" style="height: 186px;">
								<?php
									$sql=mysql_query("select * from co_xiaoxi where to_user='$k' and msg_yd='no' ORDER BY id DESC");
									while($msg=mysql_fetch_array($sql)){
										echo '
											<a title="点击标记已读" data-toggle="tooltip" onclick="xtxx('; ?><?php echo $msg["id"]; ?><?php echo ')" href="javascript:;" class="list-group-item">
											<img src="assets/images/users/msg.png" class="pull-left"/>
											<span class="contacts-title">系统消息</span>-'.$msg["msg_time"].'
											<p>
											';
										echo "<span>".$msg["msg_text"]."</span>";
										echo '</p></a>';
									}
									if($num ==""){
										echo "<center><a class='list-group-item'>暂无新消息!</a></center>";
									}
									
								?>
                            </div> 
							<div class="modal-footer">
							<button id="qbbjyd" onclick="javascript:qbyd();" style="margin-top:5px;" class="btn btn-default">全部标记已读</button>
							</div>
                        </div>                        
                    </li>
                    <!-- END MESSAGES -->
                    <li class="pull-right">
                        <a href="/" class="mb-control"><span class="fa fa-user"></span><?php echo $_SESSION["user"]; ?> 已登录</a>                        
                    </li> 
                    <!-- HOME -->
                    <li class="xn-icon-button pull-right">
                        <a href="/"><span class="fa fa-home"></span></a>                        
                    </li> 
                    <!-- END HOME -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                     
<script>
	function qbyd(){//全部已读
		$.ajax({
			url:'index.php',
			data:{
				action:'qbyd',
			},
			type:'POST',
			dataType:'JSON',
			success:function(data){
				if(data.ok){
					$("#qbbjyd").html("标记成功");
					setTimeout(function(){
						window.location.reload();//刷新页面
					},1000)
				}
			}
		})
	}
</script>