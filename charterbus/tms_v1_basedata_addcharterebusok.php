<?php
//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$ChartereID=$_POST['ChartereID'];
	$Customer=$_POST['Customer'];
	//$BusID=$_POST['BusID'];
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
	
	$insert="INSERT INTO tms_bd_CharteredBus (cb_ChartereID,cb_Customer,cb_BusID,cb_BusNumber,cb_DriverID,cb_DriverName,cb_CharteredBusDate,
		cb_CharteredBusDays,cb_FromReach,cb_Kilometers,cb_Seats,cb_Peoples,cb_CarriageFee,cb_StagnateFee,cb_BillingDate,cb_BillingStation,
		cb_BillingerID,cb_BillingerName,cb_State,cb_Remark) VALUES ('{$ChartereID}','{$Customer}','{$BusID}','{$BusNumber}','{$DriverID}',
		'{$DriverName}','{$CharteredBusDate}','{$CharteredBusDays}','{$FromReach}','{$Kilometers}','{$Seats}','{$Peoples}','{$CarriageFee}',
		'{$StagnateFee}','{$BillingDate}','{$BillingStation}','{$userID}','{$userName}','0','{$Remark}')";
	$query=$class_mysql_default->my_query($insert);
	if($query){
			echo"<script>alert('确认成功!');window.location.href='tms_v1_basedata_searcharterebus.php'</script>";
		}else{
			echo"<script>alert('确认失败');window.location.href='tms_v1_basedata_searcharterebus.php'</script>";
		}
	
	