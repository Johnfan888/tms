<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$ID=$_POST['ID'];
	$InceptUserID=$_POST['InceptUserID'];
	$InceptUser=$_POST['InceptUser'];
	$InceptUserSation=$_POST['InceptUserSation'];
	$InceptTicketNum=$_POST['InceptTicketNum'];
	$showtime=date("Y-m-d");
	$Curtime=date("H:i");
	$BeginTicket=$_POST['BeginTicket'];
	$EndTicket=$_POST['EndTicket'];
	$CurrentTicket=$_POST['CurrentTicket'];
//	$ACurrentTicket=$_POST['ACurrentTicket'];
	$LostNum=$_POST['LostNum'];
	$Type=$_POST['Type'];
	$Remark=$_POST['Remark'];
	$ProvideUser=$userName;
	$UseState='当前';
	$LostNum=$LostNum-$InceptTicketNum;
	
	$nozeroCurrentTicket=preg_replace('/^0+/','',$CurrentTicket);
	$nozeroCurrentTicket=$nozeroCurrentTicket+$InceptTicketNum;
	$zeros='';
	for($j=0;$j<strlen($CurrentTicket)-strlen($nozeroCurrentTicket);$j++){
		$zeros=$zeros.'0';
	}
	$ACurrentTicket=$zeros.$nozeroCurrentTicket; 
//	$ACurrentTicket=$CurrentTicket+$InceptTicketNum;
	$class_mysql_default->my_query("START TRANSACTION");
	$update="UPDATE  tms_bd_TicketAdd SET ta_CurrentTicket='{$ACurrentTicket}',ta_LostNum='{$LostNum}' WHERE ta_ID='{$ID}'";
	$query1 =$class_mysql_default->my_query($update);
	$insert="insert into tms_bd_TicketProvide (tp_InceptUserID,tp_InceptUser,tp_UserSation,tp_ProvideData,tp_ProvideTime,tp_BeginTicket,tp_CurrentTicket,
		tp_EndTicket,tp_InceptTicketNum,tp_UseState,tp_Type,tp_ProvideUserID,tp_ProvideUser,tp_Remark) values('{$InceptUserID}','{$InceptUser}','{$InceptUserSation}',
		'{$showtime}','{$Curtime}','{$BeginTicket}','{$CurrentTicket}','{$EndTicket}','{$InceptTicketNum}','{$UseState}','{$Type}',
		'{$userID}','{$ProvideUser}','{$Remark}')";
	$query2 =$class_mysql_default->my_query($insert); 
	if($query1 && $query2){
		$class_mysql_default->my_query("COMMIT");
		echo"<script>alert('恭喜您！领用成功!');window.location.href='tms_v1_basedata_searticketadd.php?'</script>";
	}else{
		$class_mysql_default->my_query("ROLLBACK");
		echo"<script>alert('领用失败');window.location.href='tms_v1_basedata_searticketadd.php?'</script>";
	}
	$class_mysql_default->my_query("END TRANSACTION");
?>
