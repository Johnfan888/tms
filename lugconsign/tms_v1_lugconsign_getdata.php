<?php
	define("AUTH", "TRUE");

//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$op = $_REQUEST['op'];
	switch ($op)
	{
		case  "getlugconsignData":
			$stationName =  trim($_GET['stationName']);
			getlugconsignData($stationName,$class_mysql_default);
		break;
		case "getbusnumber":
			$BusID = trim($_GET['BusID']);
			getbusid($BusID,$class_mysql_default);
		break;
		default:
	} 
	function getlugconsignData($stationName,$class_mysql_default){
		if ($stationName == "")
		$stationName = "%";
		$queryString = "SELECT ui_UserID FROM tms_sys_UsInfor WHERE ui_UserSation LIKE '{$stationName}' AND ui_UserGroup='行包组'";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysqli_fetch_array($result)) {
			$retData[] = array(
				'sellerID' => $row['ui_UserID']);
		}
//	echo "{\"sellers\":" . json_encode($retData) . "}";
		echo json_encode($retData);
	}
	
/*	function getbusid($BusID,$class_mysql_default){
		$queryString = "SELECT ui_UserID FROM tms_sys_UsInfor WHERE ui_UserSation LIKE '{$stationName}' AND ui_UserGroup='行包组'";
		$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			$retData = array('retVal' => 'FAIL', 'retString' => '查询票据数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$row= mysqli_fetch_array($result);
		$retData = array(
			'BusNumber' => $row['bi_BusNumber'],
			'BusTypeID' => $row['bi_BusTypeID'],
			'BusType' => $row['bi_BusType'],
			'SeatS'=> $row['bi_SeatS'],
			'AddSeatS' => $row['bi_AddSeatS'],
			'Tonnage'=> $row['bi_Tonnage'],
			'InStationID' => $row['bi_InStationID'],
			'InStation' => $row['bi_InStation']);
		echo json_encode($retData);
	} */
?>
