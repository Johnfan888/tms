<?php
	
//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber=$_GET['clnumber'];
	$CurDate=date('Y-m-d');
	$CurTime=date('H:i');
	$select="SELECT ta_EndTicket, ta_CurrentTicket,ta_LostNum,ta_Type FROM tms_bd_TicketAdd WHERE ta_ID='{$clnumber}'";
	$queryselect=$class_mysql_default->my_query($select);
	$row = mysql_fetch_array($queryselect);
	if($row['ta_LostNum']==0){
		echo "<script>alert('该票据已退');location.assign('tms_v1_basedata_searticketadd.php');</script>";
		return;
	}
	$class_mysql_default->my_query("START TRANSACTION");
	$insert="INSERT INTO tms_bd_TicketAdd (ta_Data,ta_Time,ta_BeginTicket,ta_EndTicket,ta_CurrentTicket,ta_AddNum,ta_LostNum,ta_Type,ta_UserID,ta_User,ta_UserSation,ta_Remark) 
		VALUES('{$CurDate}','{$CurTime}','{$row['ta_CurrentTicket']}','{$row['ta_EndTicket']}','{$row['ta_CurrentTicket']}','{$row['ta_LostNum']}','{$row['ta_LostNum']}','{$row['ta_Type']}',
		'{$userID}','{$userName}','{$userStationName}','车站退领')";
	$queryinsert =  $class_mysql_default->my_query($insert);
	$update = "UPDATE tms_bd_TicketAdd SET ta_CurrentTicket= ta_EndTicket+1,ta_LostNum=0,ta_Remark='已退领' WHERE ta_ID='{$clnumber}'";
	$queryupdate =  $class_mysql_default->my_query($update);
	if ($queryinsert && $queryupdate) {
		$class_mysql_default->my_query("COMMIT");
		echo "<script>alert('退领成功！ 请返回。');location.assign('tms_v1_basedata_searticketadd.php');</script>";
	}else{
		$class_mysql_default->my_query("ROLLBACK");
		echo "<script>alert('退领失败！');location.assign('tms_v1_basedata_searticketadd.php');</script>";
	}
	$class_mysql_default->my_query("END TRANSACTION");
?>
