<?php
/*
 * 稽查结果处理页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

if (isset($_POST['checksubmit'])) {
	$oc_PcUserID = $_GET['userID'];
	$oc_PcUser = $_GET['userName'];
	$oc_Result = $_POST['checkresult'];
	$oc_BusID = $_POST['busidname'];
	$oc_BusCard = $_POST['buscardname'];
	$oc_OutCheck_StationID = $_POST['stationselect'];
	$oc_OutCheck_Station = $_POST['stationname'];
	$oc_NoOfRunsID = $_POST['noOfRunsID'];
	$oc_RenNo = $_POST['personnum'];
	$oc_FreeSeats = $_POST['freeseats'];
	$oc_OutCheck_User = "";//$_POST['OutCheck_User'];
	$oc_CheckDate = date('Y-m-d H:i:s');
	$oc_Item1 = $_POST['item0'];
	$oc_Item2 = $_POST['item1'];
	$oc_Item3 = $_POST['item2'];
	$oc_Item4 = $_POST['item3'];
	$oc_Item5 = $_POST['item4'];
	$oc_Item6 = $_POST['item5'];
	$oc_Item7 = $_POST['item6'];
	$oc_Item8 = $_POST['item7'];
	$oc_Item9 = $_POST['item8'];
	$oc_Item10 = $_POST['item9'];

	$queryString = "SELECT * FROM tms_sf_OutCheck WHERE oc_BusID='{$oc_BusID}' AND oc_CheckDate='{$oc_CheckDate}'";
	$result = $class_mysql_default->my_query("$queryString");
	if(!mysqli_fetch_array($result)){
		$queryString = "INSERT INTO tms_sf_OutCheck (oc_PcUserID, oc_PcUser, oc_Result, oc_BusID, oc_BusCard, 
			oc_OutCheck_StationID, oc_OutCheck_Station, oc_OutCheck_User, oc_CheckDate, oc_NoOfRunsID, oc_RenNo, 
			oc_FreeSeats, oc_Item1, oc_Item2, oc_Item3,	oc_Item4, oc_Item5, oc_Item6, oc_Item7, oc_Item8, 
			oc_Item9, oc_Item10) VALUES ('{$oc_PcUserID}', '{$oc_PcUser}', '{$oc_Result}', '{$oc_BusID}', '{$oc_BusCard}', 
			'{$oc_OutCheck_StationID}', '{$oc_OutCheck_Station}', '{$oc_OutCheck_User}', '{$oc_CheckDate}', '{$oc_NoOfRunsID}', 
			'{$oc_RenNo}', '{$oc_FreeSeats}', '{$oc_Item1}', '{$oc_Item2}', '{$oc_Item3}', 
			'{$oc_Item4}', '{$oc_Item5}', '{$oc_Item6}', '{$oc_Item7}', '{$oc_Item8}', '{$oc_Item9}', '{$oc_Item10}')";
		$result = $class_mysql_default->my_query("$queryString"); 
		if($result){
			// add excel here
			echo "<script>alert('稽查结果提交成功!');javascript:history.back();</script>";
		}
		else {
			echo "<script>alert('稽查结果提交失败!请重试。');javascript:history.back();</script>";
		}
	}
	else {
			echo "<script>alert('稽查结果已提交!');javascript:history.back();</script>";
	}
}
?>
