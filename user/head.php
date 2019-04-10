<?php
	$k=$_SESSION["user"];
	$kk=queryall(co_session,"where username='$k'");
	if($kk["sessid"] != session_id()){
		unset($_SESSION['user']);
		header("location:/");
	}
?>
<?php
	if(!$weblock){//防止访问单文件
		header("location:../");
		exit;
	}
?>
            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a style="background:#33414e" href="">商户管理中心</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img style="border:0px" src="assets/images/users/user.png"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img style="border:0px" src="assets/images/users/user.png"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><?php echo $_SESSION['yhm']; ?></div>
                                <div class="profile-data-title">
								<b>账户类型：</b>
								普通商户		
								</div>
                            </div>
                        </div>                                                                        
                    </li>
                    <li class="xn-title">功能导航</li>
                    <li>
                        <a href="/user"><span class="glyphicon glyphicon-home"></span><span class="xn-text">商户主页</span></a>                        
                    </li>                    
                    <li><a href="zl.php"><span class="fa fa-user"></span>账户信息</a></li>
                    <li><a href="sm.php"><span class="fa fa-credit-card"></span>实名认证</a></li>
                    <li><a href="dd.php"><span class="fa fa-building-o"></span>订单记录</a></li>
                    <li><a href="td.php"><span class="fa fa-fire"></span>支付通道</a></li>
                    <li><a href="api.php"><span class="glyphicon glyphicon-indent-left"></span>接入信息</a></li>
                    <li><a href="js.php"><span class="fa fa-cny"></span>账户结算</a></li>
                    <li><a href="bz.php"><span class="fa fa-group"></span>帮助中心</a></li>
                        </ul>
                    </li>                    
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->
