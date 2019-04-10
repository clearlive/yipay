<?php
	if(!$weblock){//防止访问单文件
		header("location:../");
		exit;
	}
	$hz_js=querydb(co_jiesuan,"where jszt='no'");//结算未处理数量
	$hz_sm=querydb(co_shiming);//实名未处理数量
	$hz_jk=querydb(co_userapi,"where zt='no'");//接口审核未处理数量
	$hz_fk=querydb(co_fankui,"where yd='no'");//反馈未处理数量
	$hz_kh=querydb(co_khsh,"where zt='dengdai'");//代理开户未审核数量
	$hz_dljs=querydb(co_agenttx,"where txzt='no'");//代理提现未处理数量
	$hz_all=$hz_js+$hz_sm+$hz_jk+$hz_fk+$hz_kh+$hz_dljs;//总数量
?>
<?php
	$k=$_SESSION["admin"];
	$kk=queryall(co_admin,"where adminuser='$k'");
	if($kk["sessid"] != session_id()){
		unset($_SESSION['admin']);
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
						<span class="am-icon-shield"></span> 超级管理员 <span class="am-icon-caret-down"></span>
					</a>
					<ul class="am-dropdown-content" style="background-color:#424b4f">
						<!-- <li><a href="javascript:$('#head_tjgl').modal();" style="padding:0px 56px;"><span class="am-icon-key"></span> 修改密码</a></li>-->
						<li><a href="gllb.php" style="padding:0px 56px;"><span class="am-icon-server"></span> 管理列表</a></li>
					</ul>
				</li>
                        <!-- 新邮件 -->
                        <li class="am-dropdown tpl-dropdown" data-am-dropdown>
                            <a href="javascript:;" class="am-dropdown-toggle tpl-dropdown-toggle" data-am-dropdown-toggle>
                                <i class="am-icon-volume-up"></i>
                                <span class="am-badge am-badge-success am-round item-feed-badge">0</span>
                            </a>
                            <!-- 弹出列表 -->

                        </li>

                        <!-- 新提示 -->
                        <li class="am-dropdown" data-am-dropdown>
                            <a href="javascript:;" class="am-dropdown-toggle" data-am-dropdown-toggle>
                                <i class="am-icon-bell"></i>
								<?php
									if($hz_all>=1){
										echo '<span class="am-badge am-badge-warning am-round item-feed-badge">'.$hz_all.'</span>';
									}
								?>
                            </a>

                            <!-- 弹出列表 -->
                            <ul class="am-dropdown-content tpl-dropdown-content">
                                
									<?php
										if($hz_js>=1){
											echo '<li class="tpl-dropdown-menu-notifications"><a href="shjs.php" class="tpl-dropdown-menu-notifications-item am-cf"><div class="tpl-dropdown-menu-notifications-title"><i class="am-icon-cny"></i><span>　有未处理的结算申请!</span></div></a></li>';
										}
										if($hz_sm>=1){
											echo '<li class="tpl-dropdown-menu-notifications"><a href="smrz.php" class="tpl-dropdown-menu-notifications-item am-cf"><div class="tpl-dropdown-menu-notifications-title"><i class="am-icon-credit-card"></i><span>　有未处理的实名申请!</span></div></a></li>';
										}
										if($hz_jk>=1){
											echo '<li class="tpl-dropdown-menu-notifications"><a href="jksh.php" class="tpl-dropdown-menu-notifications-item am-cf"><div class="tpl-dropdown-menu-notifications-title"><i class="am-icon-share-alt"></i><span>　有未处理的接口申请!</span></div></a></li>';
										}
										if($hz_fk>=1){
											echo '<li class="tpl-dropdown-menu-notifications"><a href="wtfk.php" class="tpl-dropdown-menu-notifications-item am-cf"><div class="tpl-dropdown-menu-notifications-title"><i class="am-icon-share-alt"></i><span>　有未处理问题反馈!</span></div></a></li>';
										}
										if($hz_kh>=1){
											echo '<li class="tpl-dropdown-menu-notifications"><a href="khsh.php" class="tpl-dropdown-menu-notifications-item am-cf"><div class="tpl-dropdown-menu-notifications-title"><i class="am-icon-share-alt"></i><span>　有代理开户审核未处理!</span></div></a></li>';
										}
										if($hz_dljs>=1){
											echo '<li class="tpl-dropdown-menu-notifications"><a href="dljs.php" class="tpl-dropdown-menu-notifications-item am-cf"><div class="tpl-dropdown-menu-notifications-title"><i class="am-icon-cny"></i><span>　有代理结算未处理!   </span></div></a></li>';
										}
										if($hz_all<=0){
											echo '<li class="tpl-dropdown-menu-notifications"><a href="javascript:;" class="tpl-dropdown-menu-notifications-item am-cf"><div class="tpl-dropdown-menu-notifications-title"><center><i class="am-icon-check-square-o"></i><span>　暂无事务!</span></span></div></a></li>';
										}
									?>
                                
                            </ul>
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
              超级管理员
          </span>
                </div>
            </div>

            <!-- 菜单 -->
            <ul class="sidebar-nav">
                <li class="sidebar-nav-heading"><i class="am-icon-cog am-icon-spin"></i> 功能导航<span class="sidebar-nav-heading-info"> 核心</span></li>
                <li class="sidebar-nav-link">
                    <a href="index.php" id="jhindex">
                        <i class="am-icon-home sidebar-nav-link-logo"></i> 首页
                    </a>
                </li>
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title" id="jhhxpz">
                        <i class="am-icon-sliders sidebar-nav-link-logo"></i> 核心配置
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub" id="jhhxpzlb">
                        <li class="sidebar-nav-link">
                            <a href="xtpz.php" id="jhxtpz">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 系统配置
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="zftd.php" id="jhzftd">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 支付通道
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="yxsz.php" id="jhyxsz">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 邮箱设置
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="dxsz.php" id="jhdxsz">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 短信设置
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="ddsz.php" id="jhddsz">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 掉单设置
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title" id="jhxgjl">
                        <i class="am-icon-wpforms sidebar-nav-link-logo"></i> 相关记录
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul id="jhxgjllb" class="sidebar-nav sidebar-nav-sub">
                        <li class="sidebar-nav-link">
                            <a href="ddjl.php" id="jhddjl">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 订单记录
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="jsjl.php" id="jhjsjl">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 结算记录
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="hdjl.php" id="jhhdjl">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 黑单记录
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title" id="jhdlgn">
                        <i class="am-icon-slideshare sidebar-nav-link-logo"></i> 代理功能
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul id="jhdlgnlb" class="sidebar-nav sidebar-nav-sub">
                        <li class="sidebar-nav-link">
                            <a href="tjdl.php" id="jhtjdl">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 添加代理
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="dlgl.php" id="jhdlgl">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 代理管理
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="khsh.php" id="jhkhsh">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 开户审核
							<?php
								if($hz_kh>=1){
									echo '<span class="am-badge am-badge-secondary sidebar-nav-link-logo-ico am-round am-fr am-margin-right-sm">'.$hz_kh.'</span>';
								}
							?>
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="dljs.php" id="jhdljs">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 代理结算
							<?php
								if($hz_dljs>=1){
									echo '<span class="am-badge am-badge-secondary sidebar-nav-link-logo-ico am-round am-fr am-margin-right-sm">'.$hz_dljs.'</span>';
								}
							?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title" id="jhshgn">
                        <i class="am-icon-user sidebar-nav-link-logo"></i> 商户功能
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul id="jhshgnlb" class="sidebar-nav sidebar-nav-sub">
                        <li class="sidebar-nav-link">
                            <a href="tjsh.php" id="jhtjsh">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 添加商户
                            </a>
                        </li>
						
                        <li class="sidebar-nav-link">
                            <a href="shgl.php" id="jhshgl">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 商户管理
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="shjs.php" id="jhshjs">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 商户结算
							<?php
								if($hz_js>=1){
									echo '<span class="am-badge am-badge-secondary sidebar-nav-link-logo-ico am-round am-fr am-margin-right-sm">'.$hz_js.'</span>';
								}
							?>
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="smrz.php" id="jhsmrz">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 实名认证
							<?php
								if($hz_sm>=1){
									echo '<span class="am-badge am-badge-secondary sidebar-nav-link-logo-ico am-round am-fr am-margin-right-sm">'.$hz_sm.'</span>';
								}
							?>
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="jksh.php" id="jhjksh">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 接口审核
							<?php
								if($hz_jk>=1){
									echo '<span class="am-badge am-badge-secondary sidebar-nav-link-logo-ico am-round am-fr am-margin-right-sm">'.$hz_jk.'</span>';
								}
							?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-nav-heading"><i class="am-icon-cog am-icon-spin"></i> 安全相关<span class="sidebar-nav-heading-info"> 敏感</span></li>
                <li class="sidebar-nav-link">
                    <a href="gllb.php" id="jhgllb">
                        <i class="am-icon-user-secret sidebar-nav-link-logo"></i> 管理列表
                    </a>
                </li>
                <li class="sidebar-nav-heading"><i class="am-icon-cog am-icon-spin"></i> 站务其他<span class="sidebar-nav-heading-info"> 通知</span></li>
                <li class="sidebar-nav-link">
                    <a href="wzgg.php" id="jhwzgg">
                        <i class="am-icon-volume-up sidebar-nav-link-logo"></i> 网站公告
                    </a>
                </li>
                <li class="sidebar-nav-link">
                    <a href="znxx.php" id="jhznxx">
                        <i class="am-icon-envelope-square sidebar-nav-link-logo"></i> 站内消息
                    </a>
                </li>
                <li class="sidebar-nav-link">
                    <a href="wtfk.php" id="jhwtfk">
                        <i class="am-icon-envelope-square sidebar-nav-link-logo"></i> 问题反馈
						<?php
							if($hz_fk>=1){
								echo '<span class="am-badge am-badge-secondary sidebar-nav-link-logo-ico am-round am-fr am-margin-right-sm">'.$hz_fk.'</span>';
							}
						?>
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
   				   <button onclick="head_tjgl(this)" value="<?php echo $_SESSION['admin']; ?>" type="button" class="am-btn am-btn-primary am-btn-block">确认修改</button>
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