<?php
//	$clnumber = $_GET['clnumber'];
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$op = $_REQUEST['op'];
	if ($op=='del'){
		$BusID=trim($_GET['BusID']);
		$sql = "DELETE FROM `tms_acct_BusRate` WHERE br_BusID='{$BusID}'";
		$query = $class_mysql_default->my_query($sql);
		if ($query) {
			$retData = array(
				'sucess' => '1');
			echo json_encode($retData);
		}else{
			$retData = array(
				'sucess' => '0');
			echo json_encode($retData);
		}
	}
?>

