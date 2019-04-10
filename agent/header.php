<?php
	if(!$weblock){//防止访问单文件
		header("location:../");
		exit;
	}
?>
<?php
	$k=$_SESSION["agent"];
	$kk=queryall(co_agent_sys,"where agentuser='$k'");
	if($kk["sessid"] != session_id()){
		unset($_SESSION['agent']);
		header("location:/");
	}
?>        <!-- 头部 -->
        <header>
            <!-- logo -->
            <div class="am-fl tpl-header-logo">
                <a href="javascript:;"><img src="assets/img/logo.png" alt=""></a>
            </div>
            <!-- 右侧内容 -->
            <div class="tpl-header-fluid">
                <!-- 侧边切换 -->
                <div class="am-fl tpl-header-switch-button am-icon-list">
                    <span>

                </span>
                </div>
                <!-- 其它功能-->
                <div class="am-fr tpl-header-navbar">
                    <ul>
                        <!-- 欢迎语 -->
				<li class="am-dropdown" data-am-dropdown="">
					<a class="am-dropdown-toggle" data-am-dropdown-toggle="" href="javascript:;">
						<span class="am-icon-shield"></span>　<?php echo $_SESSION['agent']; ?> 
					</a>
				</li>

                        <!-- 退出 -->
                        <li class="am-text-sm">
                            <a href="javascript:window.location.href='index.php?action=out';">
                                <span class="am-icon-sign-out"></span> 退出
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </header>
        <!-- 风格切换 -->
        <div class="tpl-skiner">
            <div class="tpl-skiner-toggle am-icon-cog">
            </div>
            <div class="tpl-skiner-content">
                <div class="tpl-skiner-content-title">
                    选择主题
                </div>
                <div class="tpl-skiner-content-bar">
                    <span class="skiner-color skiner-white" data-color="theme-white"></span>
                    <span class="skiner-color skiner-black" data-color="theme-black"></span>
                </div>
            </div>
        </div>
        <!-- 侧边导航栏 -->
        <div class="left-sidebar">
            <!-- 用户信息 -->
            <div class="tpl-sidebar-user-panel">
                <div class="tpl-user-panel-slide-toggleable">
                    <span class="user-panel-logged-in-text">
              <i class="am-icon-circle-o am-text-success tpl-user-panel-status-icon"></i>
              代理商：<?php echo $_SESSION['agent']; ?>
          </span>
                </div>
            </div>

            <!-- 菜单 -->
            <ul class="sidebar-nav">
                <li class="sidebar-nav-heading"><i class="am-icon-cog am-icon-spin"></i> 代理功能<span class="sidebar-nav-heading-info"> </span></li>
                <li class="sidebar-nav-link">
                    <a href="index.php" id="jhindex">
                        <i class="am-icon-home sidebar-nav-link-logo"></i> 首页
                    </a>
                </li>
                <li class="sidebar-nav-link">
                    <a href="wdxx.php" id="jhwdxx">
                        <i class="am-icon-user sidebar-nav-link-logo"></i> 我的信息
                    </a>
                </li>
                <li class="sidebar-nav-link">
                    <a href="tjxj.php" id="jhtjxj">
                        <i class="am-icon-user-plus sidebar-nav-link-logo"></i> 添加下级
                    </a>
                </li>
                <li class="sidebar-nav-link">
                    <a href="xjsh.php" id="jhxjsh">
                        <i class="am-icon-slideshare sidebar-nav-link-logo"></i> 下级商户
                    </a>
                </li>
                <li class="sidebar-nav-link">
                    <a href="xjdd.php" id="jhxjdd">
                        <i class="am-icon-file-text-o sidebar-nav-link-logo"></i> 下级订单
                    </a>
                </li>
                <li class="sidebar-nav-link">
                    <a href="sqtx.php" id="jhsqtx">
                         <i class="am-icon-jpy sidebar-nav-link-logo"></i> 申请提现
                    </a>
                </li>
                <li class="sidebar-nav-link">
                    <a href="tglj.php" id="jhtglj">
                         <i class="am-icon-link sidebar-nav-link-logo"></i> 推广链接
                    </a>
                </li>
            </ul>
        </div>
				<!-----修改密码----->
				<div id="head_tjgl" class="am-modal am-modal-no-btn" tabindex="-1">
 				 <div class="am-modal-dialog">
  				  <div class="am-modal-hd">修改密码
   				   <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
  				  </div>
  				  <div class="am-modal-bd">
						<hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
				<div class="am-g">
 				 <div class="am-u-md-8 am-u-sm-centered">
  				  <form class="am-form">
  				    <fieldset class="am-form-set">
     				   <input type="password" value="" id="head_tjgl_ypass" placeholder="原密码"><br>
     				   <input type="password" value="" id="head_tjgl_xpass" placeholder="新密码"><br>
     				   <input type="password" value="" id="head_tjgl_qrpass" placeholder="确认密码"><br>
   				   </fieldset>
   				   <button onclick="head_tjgl(this)" value="<?php echo $_SESSION['agent']; ?>" type="button" class="am-btn am-btn-primary am-btn-block">确认修改</button>
  				  </form>
 				 </div>
				</div>
					</div>
 				 </div>
				</div>
				<!-----修改密码----->


				<script>
	function head_tjgl(obj){//修改密码
		$.ajax({
			url:'gllb.php',
			data:{
				ypass:$('#head_tjgl_ypass').val(),
				xpass:$('#head_tjgl_xpass').val(),
				qrpass:$('#head_tjgl_qrpass').val(),
				user:$(obj).val(),
				action:'xiugaimima',
			},
			dataType:'JSON',
			type:'POST',
			success:function(data){
				$('#ts').modal();
				$('#te').html(data.te);
				if(data.ok){
					$('#head_tjgl').modal('close');
					setTimeout(function(){
						window.location.href="index.php?action=out";//注销
					},1000);
				}
			},
			error:function(){
				$('#ts').modal();
				$('#te').html("获取数据错误");
			},
		})
	}
	</script>