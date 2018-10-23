<?php
	define("AUTH", "TRUE");
	require_once("../ui/inc/init.inc.php");
	$op = $_REQUEST['op'];
	if($op='delnotice'){
	$RegionCode=trim($_GET['RegionCode']);
	$query="DELETE FROM tms_sch_NoticeInfo WHERE ni_id='$RegionCode'";
	$result=mysql_query($query);
	if ($result) {
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