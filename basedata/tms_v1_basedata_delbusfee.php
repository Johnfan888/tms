<?php
//	$clnumber = $_GET['clnumber'];
	//����ҳ�������֤�Ƿ��¼
	define("AUTH", "TRUE");

	//�����ʼ���ļ�
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

