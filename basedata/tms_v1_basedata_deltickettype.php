<?php
	//����ҳ�������֤�Ƿ��¼
	define("AUTH", "TRUE");

	//�����ʼ���ļ�
	require_once("../ui/inc/init.inc.php");
	$op = $_REQUEST['op'];
	if ($op=='del'){
		$ID=trim($_GET['ID']);
		$sql = "DELETE FROM `tms_bd_TicketType` WHERE tt_ID='{$ID}'";
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
