<?php
//	$clnumber = $_GET['clnumber'];
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$op = $_REQUEST['op'];
	$CurTime=date('Y-m-d H:i:s');
	if ($op=='del'){
		$LineID=trim($_GET['LineID']);
		$Linestate=trim($_GET['Linestate']);
		if ($Linestate=='注销'){
			$Linestate='正常';
		}else{
			$Linestate='注销';
		}
		$sql="UPDATE tms_bd_LineInfo SET li_Linestate='{$Linestate}',li_ModerID='{$userID}',li_Moder='{$userName}',li_ModTime='{$CurTime}' 
			WHERE li_LineID='{$LineID}'";
		$query=$class_mysql_default->my_query($sql);
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
		
/*		$class_mysql_default->my_query("START TRANSACTION");
		$sql1 = "DELETE FROM `tms_bd_LineInfo` WHERE li_LineID='{$LineID}'";
		$query1= $class_mysql_default->my_query($sql1);
	//	if (!$query1) echo "SQL错误：".mysql_error();
		$sql2 = "DELETE FROM `tms_bd_SectionInfo` WHERE si_LineID='{$LineID}'";
		$query2= $class_mysql_default->my_query($sql2);
	//	if (!$query2) echo "SQL错误：".mysql_error();
		$sql3 = "DELETE FROM `tms_bd_NoRunsAdjustPrice` WHERE nrap_LineAdjust='{$LineID}'";
		$query3= $class_mysql_default->my_query($sql3);
//		if (!$query3) echo "SQL错误：".mysql_error();
		$sql4 = "DELETE FROM `tms_bd_ServiceFeeAdjust` WHERE sfa_LineAdjust ='{$LineID}'";
		$query4= $class_mysql_default->my_query($sql4);
//		if (!$query4) echo "SQL错误：".mysql_error();
		if ($query1 && $query2 && $query3 && $query4) {
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
	} */
?>