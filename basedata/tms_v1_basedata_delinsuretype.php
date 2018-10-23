<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$op = $_REQUEST['op'];
	if ($op=='del'){
		$INSUREPRODUCTNAME=trim($_GET['INSUREPRODUCTNAME']);
		$sql = "DELETE FROM tms_bd_InsureType WHERE it_InsureProductName='{$INSUREPRODUCTNAME}'";
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