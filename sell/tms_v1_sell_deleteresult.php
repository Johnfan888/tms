<?php
	require_once("../ui/inc/init.inc.php");
	$op = $_REQUEST['op'];
	if ($op=='del'){
		$result=trim($_GET['result']);
		$sql = "DELETE FROM tms_ticket_ErrDelResult WHERE er_Desp='{$result}'";
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