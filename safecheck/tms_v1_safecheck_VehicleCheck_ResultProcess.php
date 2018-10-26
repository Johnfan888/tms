<?php
/*
 * 车辆检验结果处理页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$sc_UserID = $_GET['userID'];
$sc_UserName = $_GET['userName'];
$sc_Result = $_POST['checkresult'];
$sc_BusID = $_POST['busidname'];
$sc_BusCard = $_POST['buscardname'];
$sc_BusType = $_POST['bustypename'];
$sc_StationID = $_POST['stationselect'];
$sc_StationName = $_POST['stationname'];
$sc_InspectorName = "";//$_POST['InspectorName'];
$sc_CheckDate = date('Y-m-d');
$sc_CheckExpiredDate = "";//$_POST['CheckExpiredDate'];
$sc_Item1 = $_POST['item0'];
$sc_Item2 = $_POST['item1'];
$sc_Item3 = $_POST['item2'];
$sc_Item4 = $_POST['item3'];
$sc_Item5 = $_POST['item4'];
$sc_Item6 = $_POST['item5'];
$sc_Item7 = $_POST['item6'];
$sc_Item8 = $_POST['item7'];
$sc_Item9 = $_POST['item8'];
$sc_Item10 = $_POST['item9'];
$sc_IsNoOfRunsID = 1;//$_POST['NoOfRunsID'];

$queryString = "SELECT * FROM tms_sf_SafetyCheck WHERE sc_BusID='{$sc_BusID}' AND sc_CheckDate='{$sc_CheckDate}'";
$result = $class_mysql_default->my_query("$queryString");
if(!mysqli_fetch_array($result)){
	$queryString1 = "INSERT INTO tms_sf_SafetyCheck (sc_UserID, sc_UserName, sc_Result, sc_BusID, sc_BusCard, sc_BusType, 
		sc_StationID, sc_StationName, sc_InspectorName, sc_CheckDate, sc_CheckExpiredDate, sc_Item1, sc_Item2, sc_Item3, 
		sc_Item4, sc_Item5, sc_Item6, sc_Item7, sc_Item8, sc_Item9, sc_Item10, sc_IsNoOfRunsID) VALUES ('{$sc_UserID}', 
		'{$sc_UserName}', '{$sc_Result}', '{$sc_BusID}', '{$sc_BusCard}', '{$sc_BusType}', '{$sc_StationID}', '{$sc_StationName}', 
		'{$sc_InspectorName}', '{$sc_CheckDate}', '{$sc_CheckExpiredDate}', '{$sc_Item1}', '{$sc_Item2}', '{$sc_Item3}', 
		'{$sc_Item4}', '{$sc_Item5}', '{$sc_Item6}', '{$sc_Item7}', '{$sc_Item8}', '{$sc_Item9}', '{$sc_Item10}', '{$sc_IsNoOfRunsID}')";
	$queryString2 = "Update tms_bd_BusInfo SET bi_IsSafetyCheck='{$sc_Result}' WHERE bi_BusID='{$sc_BusID}'";
	$class_mysql_default->my_query("BEGIN");
	$result1 = $class_mysql_default->my_query("$queryString1"); 
	$result2 = $class_mysql_default->my_query("$queryString2"); 
	if($result1 && $result2) {
		$class_mysql_default->my_query("COMMIT");
		echo "<script>confirm('安检结果提交成功!打印安检单?')?location.assign('tms_v1_safecheck_VehicleCheck_Print.php?busid=$sc_BusID&chkDate=$sc_CheckDate'):history.back();</script>";
	}
	else {
		$class_mysql_default->my_query("ROLLBACK");
		echo "<script>alert('安检结果提交失败!请重试。');history.back();</script>";
	}
}
else {
	$queryString1 = "UPDATE tms_sf_SafetyCheck SET sc_UserID='{$sc_UserID}', sc_UserName='{$sc_UserName}', sc_Result='{$sc_Result}', 
		sc_BusType='{$sc_BusType}', sc_StationID='{$sc_StationID}', sc_StationName='{$sc_StationName}', 
		sc_InspectorName='{$sc_InspectorName}',	sc_CheckExpiredDate='{$sc_CheckExpiredDate}', sc_Item1='{$sc_Item1}', 
		sc_Item2='{$sc_Item2}', sc_Item3='{$sc_Item3}',	sc_Item4='{$sc_Item4}', sc_Item5='{$sc_Item5}', sc_Item6='{$sc_Item6}', 
		sc_Item7='{$sc_Item7}',	sc_Item8='{$sc_Item8}', sc_Item9='{$sc_Item9}', sc_Item10='{$sc_Item10}', sc_IsNoOfRunsID='{$sc_IsNoOfRunsID}' 
		WHERE sc_BusID='{$sc_BusID}' AND sc_CheckDate='{$sc_CheckDate}'";
	$queryString2 = "Update tms_bd_BusInfo SET bi_IsSafetyCheck='{$sc_Result}' WHERE bi_BusID='{$sc_BusID}'";
	$class_mysql_default->my_query("BEGIN");
	$result1 = $class_mysql_default->my_query("$queryString1"); 
	$result2 = $class_mysql_default->my_query("$queryString2"); 
	if($result1 && $result2) {
		$class_mysql_default->my_query("COMMIT");
		echo "<script>confirm('安检结果更新成功!打印安检单?')?location.assign('tms_v1_safecheck_VehicleCheck_Print.php?busid=$sc_BusID&chkDate=$sc_CheckDate'):history.back();</script>";
			}
	else {
		$class_mysql_default->my_query("ROLLBACK");
		echo "<script>alert('安检结果更新失败!请重试。');history.back();</script>";
	}
}
?>
