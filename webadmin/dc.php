<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Conn.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Config/Common.php";
	if(!isset($_SESSION["admin"])){
		header("location:login.php");
		exit;
	}
	Header("Content-Type:application/vnd.ms-excel;charset=GBK");
	Header("Accept-Ranges:bytes");
	Header("Content-Disposition:attachment;filename=".date('YmdHis')."商户结算.xls");
	Header("Pragma:no-cache");
	Header("Expires:0");
	if($_GET['lx']=='shjs'){//如果是商户结算
	if($_GET['id']==null){
		header("location:/");
		exit;
	}
	echo "<table border='1'>";
	echo "<tr>";
	echo "<th>序号</th>";
	echo "<th>申请用户</th>";
	echo "<th>结算金额</th>";
	echo "<th>手续费</th>";
	echo "<th>实际金额</th>";
	echo "<th>收款姓名</th>";
	echo "<th>收款银行</th>";
	echo "<th>收款账号</th>";
	echo "<th>申请时间</th>";
	echo "</tr>";
	if($_GET['action']=='js'){
		$id=uhtml(check(trim($_GET['id'])));
		$sql=mysql_query("select * from co_jiesuan where id='$id' and jszt='yes'");
		$i=1;
		while($js=mysql_fetch_assoc($sql)){
			echo "<tr>";
			echo "<th>".$i."</th>";
			echo "<th>".$js["username"]."</th>";
			echo "<th>".$js["jsje"]."</th>";
			echo "<th>".$js["sxf"]."</th>";
			echo "<th>".$js["sjje"]."</th>";
			echo "<th>".$js["xingming"]."</th>";
			echo "<th>".$js["jsyh"]."</th>";
			echo "<th>".$js["jszh"]."</th>";
			echo "<th>".$js["jssj"]."</th>";
			echo "</tr>";
			$i++;
		}
	}else if($_GET['action']=='pljs'){
		$id=explode(",",$_GET['id']);
		for($i=0;$i<count($id);$i++){
			$id[$i]=uhtml(check(trim($id[$i])));
			$sql=mysql_query("select * from co_jiesuan where id='$id[$i]'");
			$s=$i+1;
			while($js=mysql_fetch_assoc($sql)){
				echo "<tr>";
				echo "<th>".$s."</th>";
				echo "<th>".$js["username"]."</th>";
				echo "<th>".$js["jsje"]."</th>";
				echo "<th>".$js["sxf"]."</th>";
				echo "<th>".$js["sjje"]."</th>";
				echo "<th>".$js["xingming"]."</th>";
				echo "<th>".$js["jsyh"]."</th>";
				echo "<th>".$js["jszh"]."</th>";
				echo "<th>".$js["jssj"]."</th>";
				echo "</tr>";
			}			
		}

	}
	echo "</table>";
	}else{				//否者代理结算
	if($_GET['id']==null){
		header("location:/");
		exit;
	}
	echo "<table border='1'>";
	echo "<tr>";
	echo "<th>序号</th>";
	echo "<th>申请代理</th>";
	echo "<th>结算金额</th>";
	echo "<th>手续费</th>";
	echo "<th>实际金额</th>";
	echo "<th>收款姓名</th>";
	echo "<th>收款银行</th>";
	echo "<th>收款账号</th>";
	echo "<th>申请时间</th>";
	echo "</tr>";
	if($_GET['action']=='js'){
		$id=uhtml(check(trim($_GET['id'])));
		$sql=mysql_query("select * from co_agenttx where id='$id'");
		$i=1;
		while($js=mysql_fetch_assoc($sql)){
			echo "<tr>";
			echo "<th>".$i."</th>";
			echo "<th>".$js["agentuser"]."</th>";
			echo "<th>".$js["txje"]."</th>";
			echo "<th>".$js["sxf"]."</th>";
			echo "<th>".$js["sjje"]."</th>";
			echo "<th>".$js["zsxm"]."</th>";
			echo "<th>".$js["txyh"]."</th>";
			echo "<th>".$js["txzh"]."</th>";
			echo "<th>".$js["txsj"]."</th>";
			echo "</tr>";
			$i++;
		}
	}else if($_GET['action']=='pljs'){
		$id=explode(",",$_GET['id']);
		for($i=0;$i<count($id);$i++){
			$id[$i]=uhtml(check(trim($id[$i])));
			$sql=mysql_query("select * from co_agenttx where id='$id[$i]'");
			$s=$i+1;
			while($js=mysql_fetch_assoc($sql)){
				echo "<tr>";
				echo "<th>".$s."</th>";
			echo "<th>".$js["agentuser"]."</th>";
			echo "<th>".$js["txje"]."</th>";
			echo "<th>".$js["sxf"]."</th>";
			echo "<th>".$js["sjje"]."</th>";
			echo "<th>".$js["zsxm"]."</th>";
			echo "<th>".$js["txyh"]."</th>";
			echo "<th>".$js["txzh"]."</th>";
			echo "<th>".$js["txsj"]."</th>";
			echo "</tr>";
			}			
		}

	}
	echo "</table>";
	}
?>
