<?php
//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$ChartereID=$_POST['ChartereID'];
	$Customer=$_POST['Customer'];
	$BusID=$_POST['BusID'];
	$BusNumber=$_POST['busCard'];
	$DriverName=$_POST['DriverName'];
	$DriverID=$_POST['DriverID'];
	$CharteredBusDate=$_POST['CharteredBusDate'];
	$CharteredBusDays=$_POST['CharteredBusDays'];
	$From=$_POST['From'];
	$Reach=$_POST['Reach'];
	$Kilometers=$_POST['Kilometers'];
	$Seats=$_POST['Seats'];
	$Peoples=$_POST['Peoples'];
	$CarriageFee=$_POST['CarriageFee'];
	$StagnateFee=$_POST['StagnateFee'];
//	$BillingDate=$_POST['BillingDate'];
	$BillingStation=$userStationName;
	$Remark=$_POST['Remark'];
	$FromReach=$From.'-'.$Reach;
	
	$update="UPDATE tms_bd_CharteredBus SET cb_Customer='{$Customer}',cb_BusID='{$BusID}',cb_BusNumber='{$BusNumber}',
		cb_DriverID='{$DriverID}',cb_DriverName='{$DriverName}',cb_CharteredBusDate='{$CharteredBusDate}',
		cb_CharteredBusDays='{$CharteredBusDays}',cb_FromReach='{$FromReach}',cb_Kilometers='{$Kilometers}',cb_Seats='{$Seats}',
		cb_Peoples='{$Peoples}',cb_CarriageFee='{$CarriageFee}',cb_StagnateFee='{$StagnateFee}',cb_BillingStation='{$BillingStation}',
		cb_BillingerID='{$userID}',cb_BillingerName='{$userName}',cb_State='0',cb_Remark='{$Remark}' WHERE cb_ChartereID='{$ChartereID}'";
	$query=$class_mysql_default->my_query($update);
	if($query){
			echo"<script>alert('修改成功!');window.location.href='tms_v1_basedata_searcharterebus.php'</script>";
		}else{
			echo"<script>alert('修改失败');window.location.href='tms_v1_basedata_searcharterebus.php'</script>";
		}
	
	