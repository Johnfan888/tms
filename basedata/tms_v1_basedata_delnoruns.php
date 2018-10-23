<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$op = $_REQUEST['op'];
	if ($op=='del'){
		$NoOfRunsID=trim($_GET['NoOfRunsID']);
		$class_mysql_default->my_query("START TRANSACTION");
		$sql1= "DELETE FROM `tms_bd_NoRunsInfo` WHERE nri_NoOfRunsID='{$NoOfRunsID}'";
		$query1 = $class_mysql_default->my_query($sql1);
		$sql2= "DELETE FROM `tms_bd_NoRunsDockSite` WHERE nds_NoOfRunsID='{$NoOfRunsID}'";
		$query2 = $class_mysql_default->my_query($sql2);
		$sql3= "DELETE FROM `tms_bd_NoRunsLoop` WHERE nrl_NoOfRunsID='{$NoOfRunsID}'";
		$query3=$class_mysql_default->my_query($sql3);
		$sql4= "DELETE FROM `tms_bd_ScheduleLong` WHERE sl_NoOfRunsID='{$NoOfRunsID}'";
		$query4=$class_mysql_default->my_query($sql4);
		$sql5= "DELETE FROM `tms_bd_ScheduleReserve` WHERE sr_NoOfRunsID='{$NoOfRunsID}'";
		$query5=$class_mysql_default->my_query($sql5);
		$sql6= "DELETE FROM `tms_bd_NoRunsAdjustPrice` WHERE nrap_NoRunsAdjust='{$NoOfRunsID}'";
		$query6=$class_mysql_default->my_query($sql6);
		$sql7= "DELETE FROM `tms_bd_ServiceFeeAdjust` WHERE sfa_NoRunsAdjust='{$NoOfRunsID}'";
		$query7=$class_mysql_default->my_query($sql7);
		if ($query1 && $query2 && $query3 && $query4 && $query5 && $query6 && $query7) {
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
