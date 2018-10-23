<?php
//	$clnumber = $_GET['clnumber'];
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$op = $_REQUEST['op'];
	if ($op=='del'){
		$CheckItem=trim($_GET['CheckItem']);
		$CheckContent=trim($_GET['CheckContent']);
		$sql = "DELETE FROM `tms_sf_CheckItem` WHERE ci_CheckItem='{$CheckItem}' AND ci_CheckContent='{$CheckContent}'";
		$query = $class_mysql_default->my_query($sql);
		if ($query) {
			$retData = array(
				'sucess' => '1');
			echo json_encode($retData);
		}else{
			$retData = array(
				'sucess' => '0', 'error'=>"SQL错误：".mysql_error());
			echo json_encode($retData);
		}
	}
?>

