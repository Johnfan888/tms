<?php
//	$clnumber=$_GET['clnumber'];
//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$op = $_REQUEST['op'];
	if ($op=='del'){
		$BusID=trim($_GET['BusID']);
		$class_mysql_default->my_query("START TRANSACTION");
		$sql1= "DELETE FROM tms_bd_BusInfo WHERE bi_BusID='{$BusID}'";
		$query1 = $class_mysql_default->my_query($sql1);
		if (!$query1) echo "SQL错误：".mysql_error();
		$sql2="DELETE FROM tms_bd_BusCard WHERE bc_BusID='{$BusID}'";
		$query2 = $class_mysql_default->my_query($sql2);
		if (!$query2) echo "SQL错误：".mysql_error();
		if ($query1 && $query2) {
			$class_mysql_default->my_query("COMMIT");
			$retData = array(
				'sucess' => '1');
			echo json_encode($retData);
		}else{
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array(
				'sucess' => '0');
			echo json_encode($retData);
		}
		$class_mysql_default->my_query("END TRANSACTION");
	}
?>
