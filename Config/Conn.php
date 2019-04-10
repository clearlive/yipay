<?php
	/*数据库连接*/
	$localhost = "127.0.0.1";       //服务器地址，一般为localhost
	$root = "root";                 //服务器MYSQL登陆用户名
	$password = "root";                 //服务器的MYsQL登陆密码
	$database = "video";      //你使用的数据库
	
	$conn = @mysql_connect("$localhost","$root","$password") or die ("数据库连接出错，请检查!");
	@mysql_select_db("$database",$conn) or die ("数据库表不存在或者未连接");
	mysql_query("set names utf8"); //使用utf8中文件编码，防止出错
	
?>