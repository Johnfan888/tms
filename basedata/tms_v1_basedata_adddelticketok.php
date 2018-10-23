<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$ID=$_POST['ID'];
	$InceptUserID=$_POST['InceptUserID'];
	$InceptUser=$_POST['InceptUser'];
	$UserSation=$_POST['UserSation'];
	$InceptTicketNum=$_POST['InceptTicketNum'];
	$showtime=date("Y-m-d h:m:s");
	$BeginTicket=$_POST['BeginTicket'];
	$EndTicket=$_POST['EndTicket'];
	$ProvideData=$_POST['ProvideData'];
	$LostNum=$_POST['LostNum'];
	$Type=$_POST['Type'];
	$delreason=$_POST['delreason'];
	$ACurrentTicket=$_POST['ACurrentTicket'];
	$LostNum=$LostNum-$InceptTicketNum;

	$class_mysql_default->my_query("START TRANSACTION");
	$update="UPDATE tms_bd_TicketProvide SET tp_CurrentTicket='{$ACurrentTicket}',tp_InceptTicketNum='{$LostNum}' WHERE tp_ID='{$ID}'";
	$query1 =$class_mysql_default->my_query($update);
	$insert="insert into tms_bd_DelTicket(dt_ID,dt_InceptUserID,dt_InceptUser,dt_UserSation,dt_ProvideDate,dt_BeginTicket,
		dt_EndTicket,dt_DelTicketNum,dt_Type,dt_DeleteTime,dt_DeletorID,dt_DeletorName,dt_DeletorSation,dt_DeletorSationID,dt_DelReason)
		 values('','{$InceptUserID}','{$InceptUser}','{$UserSation}','{$ProvideData}','{$BeginTicket}',
		'{$EndTicket}','{$InceptTicketNum}','{$Type}','{$showtime}','{$userID}','{$userName}','{$userStationName}','{$userStationID}','{$delreason}')";
	$query2 =$class_mysql_default->my_query($insert); 
	if($query1 && $query2){
		$class_mysql_default->my_query("COMMIT");
		echo"<script>alert('销票成功!');window.location.href='tms_v1_basedata_seardelticket.php'</script>";
	}else{
		$class_mysql_default->my_query("ROLLBACK");
		echo"<script>alert('销票失败');history.back();</script>";
	}
	$class_mysql_default->my_query("END TRANSACTION");
?>
