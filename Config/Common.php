<?php
	require_once "conn.php";
	session_start();
	date_default_timezone_set('PRC');
	error_reporting(0);
	//判断手机/PC访问
	function is_mobile(){ 
		$user_agent = $_SERVER['HTTP_USER_AGENT']; 
		$mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte"); 
		$is_mobile = false; 
		foreach ($mobile_agents as $device) { 
			if (stristr($user_agent, $device)) { 
				$is_mobile = true; 
				break; 
			} 
		} 
		return $is_mobile; 
	}
/*	if(is_mobile()){ 
		header( "HTTP/1.1 301 Moved Permanently"); 
		header("Location:/M");
	}*/
	//mysql查询表数据
	function queryall($table,$type,$zd="*") {
		$sql=mysql_query("SELECT $zd FROM $table $type");
		$row=mysql_fetch_assoc($sql);
		return $row;
	}

	//mysql返回查询行数
	function querydb($type,$sql,$zd="*") {
		if(!isset($sql)){
			$num = mysql_query("SELECT $zd FROM $type");
			$rows = mysql_num_rows($num);
			return $rows;
		}
		$num = mysql_query("SELECT $zd FROM $type $sql");
		$rows = mysql_num_rows($num);
		return $rows;
	}
	
	//mysql增加操作
	function queryz($tab,$key,$val){
		$sql="INSERT INTO ".$tab." (".$key.") VALUES (".$val.")";
		mysql_query($sql);
		if(mysql_affected_rows() >= 1){
			return true;
		}else{
			return false;
		}
	}
	
	//mysql修改操作
	function queryg($b,$s){
		mysql_query("UPDATE $b SET $s ");
		if(mysql_affected_rows() >= 1){
			return true;
		}else{
			return false;
		}
	}
	
	//mysql删除操作
	function querys($b,$s){
		mysql_query("DELETE FROM $b $s");
		if(mysql_affected_rows() >= 1){
			return true;
		}else{
			return false;
		}
	}
	
/*	//被动执行订单状态更改
	$dqxtsj=time();
	queryg(co_dingdan,"ddzt='fail' where ddzt='wait' and ddsxsj < '$dqxtsj'");
*/	
	//随机生成字符串
	function randStr($len){ 
		$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
		$string=''; 
		for(;$len>=1;$len--){ 
		$position=rand()%strlen($chars); 
		$string.=substr($chars,$position,1); 
		} 
		return $string; 
	} 
	
	//随机商户key
	function randkey($len){ 
		$chars='0123456789abcdefghijklmnopqrstuvwxyz';
		$string=''; 
		for(;$len>=1;$len--){ 
		$position=rand()%strlen($chars); 
		$string.=substr($chars,$position,1); 
		} 
		return $string; 
	} 

	//随机生成订单号
	function randddh($len){ 
		$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$string=''; 
		for(;$len>=1;$len--){ 
		$position=rand()%strlen($chars); 
		$string.=substr($chars,$position,1); 
		} 
		return $string; 
	} 
	
	//随机生成数字
	function randnumnum($len){ 
		$chars='0123456789';
		$string=''; 
		for(;$len>=1;$len--){ 
		$position=rand()%strlen($chars); 
		$string.="CO".$substr($chars,$position,1); 
		} 
		return $string; 
	} 
	
	//script过滤
	function uhtml($str){     
		$farr = array("/\s+/","/<(\/?)(script|i?frame|style|html|body|title|link|meta|\?|\%)([^>]*?)>/isU","/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",);     
		$tarr = array(" ","＜\1\2\3＞", "\1\2",);     
		$str = trim(preg_replace( $farr,$tarr,$str));     
		return $str;     
	} 
	
	//分页函数
	$page = isset($_GET["page"])?$_GET["page"]:0; 
	$page = uhtml(check(trim(check($page))));
	function Page($rows,$page_size){ 
		global $page,$select_from,$select_limit,$pagenav; 
		$page_count = ceil($rows/$page_size); 
		if($page <= 1 || $page == '') $page = 1; 
		if($page >= $page_count) $page = $page_count; 
		$select_limit = $page_size; 
		$select_from = ($page - 1) * $page_size.','; 
		$pre_page = ($page == 1)? 1 : $page - 1; 
		$next_page= ($page == $page_count)? $page_count : $page + 1 ; 
		$pagenav .= "<div class='layui-btn-group'><a href='?page=1' class='layui-btn layui-btn-mini layui-btn-normal'>首页</a>"; 
		$pagenav .= "<a href='?page=$pre_page' class='layui-btn layui-btn-mini layui-btn-normal'><i class='layui-icon'>&#xe603;</i></a>"; 
		$pagenav .= "<a href='?page=$next_page' class='layui-btn layui-btn-mini layui-btn-normal'><i class='layui-icon'>&#xe602;</i></a>"; 
		$pagenav .= "<a href='?page=$page_count' class='layui-btn layui-btn-mini layui-btn-normal'>末页</a></div>"; 
	}
	
	//系统配置信息
	$web=queryall(co_system);
	if($web['sitestatus']=='no'){
		if(basename(getcwd())!=="admcn"){		//当前目录是否位管理员后台目录
			exit("
			<html>
			<head>
			<meta charset='utf-8'>
			<title>Web Lock</title>
			<head>
			<body>
			<center>
			<h1>Web Lock!</h1>
			</center>
			</body>
			</html>
			");
		}
	}

	//发送邮件
	function sendMail($to,$title,$content){
		require_once("phpmailer/class.phpmailer.php"); 	//引入PHPMailer的核心文件
		require_once("phpmailer/class.smtp.php");
		Global $web;
		$mail = new PHPMailer();	//实例化PHPMailer核心类
		$mail->SMTPDebug = false;	//是否启用smtp的debug进行调试
		$mail->isSMTP();	//使用smtp鉴权方式发送邮件
		$mail->SMTPAuth=true;	//smtp需要鉴权 这个必须是true
		$mail->Host = $web['yxfwq'];	//链接qq域名邮箱的服务器地址
		$mail->Port = $web['yxdk'];	//设置smtp服务器端口号
		if($web['yxdk']=='465'){
			$mail->SMTPSecure = 'ssl';
		}
		$mail->Hostname = 'localhost';	//设置发件人的主机
		$mail->CharSet = $web['yxbm'];	//设置发送的邮件的编码
		$mail->FromName = $web['yxnc'];	//设置发件人昵称
		$mail->Username = $web['yxyhm'];	//smtp登录的账号
		$mail->Password = $web['yxmm'];	//smtp登录的密码
		$mail->From = $web['yxdz'];	//设置发件人邮箱地址
		$mail->isHTML(true); //邮件正文是否为html编码
		$mail->addAddress($to,'系统通知');	//设置收件人邮箱地址
		$mail->Subject = $title;	//添加该邮件的主题
		$mail->Body = $content;		//添加邮件正文
		$status = $mail->send();	
		if($status) {	//简单的判断与提示信息
			return true;
		}else{
			return false;
		}
	}
	
	
	//自定义alert弹出层函数
	function json($msg='未定义',$iconnum="0",$jump="no",$jumpurl="0"){
		$data["data"]=$msg;
		$data["icon"]=$iconnum;
		$data["jump"]=$jump;
		$data["jumpurl"]=$jumpurl;
		echo json_encode($data);
	}
/*	
	function json($msg='未定义',$iconnum="0",$jump="no"){
		if($jump == "no"){
		$data["data"]=$msg;
		$data["icon"]=$iconnum;
		$data["jump"]='?';
		echo json_encode($data);			
		}else{
		$data["data"]=$msg;
		$data["icon"]=$iconnum;
		$data["jump"]=$jump;
		echo json_encode($data);			
		}
	}
*/
	//防SQL注入
	function check($sql_str){  
		$check=eregi('select|inert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|UNION|into|load_file|outfile', $sql_str);   
		if($check){  
			exit("<meta charset='utf8'><title>非法</title><b style='color:red'>请勿尝试SQL注入,IP[".$_SERVER['REMOTE_ADDR']."]已记录！</b>");  
		}else{  
			return strip_tags($sql_str);  
		}  
	}  
	
	//检测域名格式
	function CheckUrl($C_url){  
		$str="/^(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?$/";  
		if (!preg_match($str,$C_url)){  
			return false;  
		}else{  
			return true;  
		}  
	}
	
	//用于订单异步通知
	function curlPost($url,$data=''){  
		$ch = curl_init ();  
		curl_setopt($ch, CURLOPT_URL,$url);  
		curl_setopt($ch, CURLOPT_TIMEOUT, 200);  
		curl_setopt($ch, CURLOPT_HEADER, FALSE);  
		curl_setopt($ch, CURLOPT_NOBODY, FALSE);  
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data);   
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);  
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);  
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');  
		curl_exec($ch);  
		$httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
		if($httpCode == 200){
			return true;
		}else{
			return false;
		}
	}
	
	//正则判断数字字母
	function isszzm($str){
		$a=preg_match('/^[0-9a-zA-Z]+$/',$str);
		if($a){
			return true;
		}else{
			return false;
		}
	}
	
	//正则判断网址
	function iswz($str){
		$a=preg_match('/^[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+$/',$str);
		if($a){
			return true;
		}else{
			return false;
		}
	}
	
	//正则判断字母
	function iszm($str){
		$a=preg_match('/^[a-zA-Z]+$/',$str);
		if($a){
			return true;
		}else{
			return false;
		}
	}	
	//正则判断数字
	function issz($str){
		$a=preg_match('/^[0-9]+$/',$str);
		if($a){
			return true;
		}else{
			return false;
		}
	}

	//正则判断邮箱
	function isyx($str){
		$a=preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/',$str);
		if($a){
			return true;
		}else{
			return false;
		}
	}

	//正则判断数字or小数点
	function isszxsd($str){
		$a=preg_match('/^[0-9]+(.[0-9]{0,3})?$/',$str);
		if($a){
			return true;
		}else{
			return false;
		}
	}

	//正则判断汉字
	function ishz($str){
		$a=preg_match('/^[\x7f-\xff]+$/',$str);
		if($a){
			return true;
		}else{
			return false;
		}
	}

	//正则判断汉字字母
	function ishzzm($str){
		$a=preg_match('/^[\x7f-\xffa-zA-Z_]+$/',$str);
		if($a){
			return true;
		}else{
			return false;
		}
	}

	//正则判断汉字数字字母
	function ishzszzm($str){
		$a=preg_match('/^[\x7f-\xffa-zA-Z0-9_-]+$/',$str);
		if($a){
			return true;
		}else{
			return false;
		}
	}
	
	//正则判断数字字母下划线
	function isszzmxhx($str){
		$a=preg_match('/^[0-9a-zA-Z_]+$/',$str);
		if($a){
			return true;
		}else{
			return false;
		}
	}
	
	
	//图片上传
	function uploadtp($file){
		$tmp_filename = $file['tmp_name'];
		if(is_uploaded_file($tmp_filename)){ 
			$allow_mimes = array(
				'image/png' => '.png',
				'image/x-png' => '.png',
				'image/gif' => '.gif',
				'image/jpeg' => '.jpg',
				'image/pjpeg' => '.jpg'
			);        
			if(!array_key_exists($file['type'], $allow_mimes )) {
				return false;
				exit;
			}
			$filexname = 'upload/sm/'.md5(rand()).'.jpg';
			if (move_uploaded_file($tmp_filename, $filexname)) { 
				$lj="//".$_SERVER['HTTP_HOST']."/user/".$filexname;
				return $lj;
			}else{
				return false;
			}
		}
	}

	//图片上传路径
	function uploadtj($file){
		$tmp_filename = $file['tmp_name'];
		if(is_uploaded_file($tmp_filename)){ 
			$allow_mimes = array(
				'image/png' => '.png',
				'image/x-png' => '.png',
				'image/gif' => '.gif',
				'image/jpeg' => '.jpg',
				'image/pjpeg' => '.jpg'
			);        
			if(!array_key_exists($file['type'], $allow_mimes )) {
				return false;
				exit;
			}
			$filexname = '../user/upload/sm/'.md5(rand()).'.jpg';
			if (move_uploaded_file($tmp_filename, $filexname)) { 
				$lj="//".$_SERVER['HTTP_HOST']."/user/".$filexname;
				return $lj;
			}else{
				return false;
			}
		}
	}
	
	//检测图片
	function istp($file){
		$tmp_filename = $file['tmp_name'];
		if(is_uploaded_file($tmp_filename)){ 
			// 是一个上传的文件. 
			$allow_mimes = array(
				'image/png' => '.png',
				'image/x-png' => '.png',
				'image/gif' => '.gif',
				'image/jpeg' => '.jpg',
				'image/pjpeg' => '.jpg'
			);        
			if(!array_key_exists($file['type'], $allow_mimes )) {
				return false;
			}else{
				return true;
			}
		}
	}

	//防止访问单文件
	$weblock="yes";

?>