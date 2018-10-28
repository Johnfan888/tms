<?php
	define("AUTH", "TRUE");

//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$op = $_REQUEST['op'];
	switch ($op)
	{
		case "getbusnumber":
			$busid = trim($_GET['busid']);
			getBusData($busid,$class_mysql_default);
			break;
		case "getdriver":
			$driverid = trim($_GET['driverid']);
			getCheckersData($driverid,$class_mysql_default);
			break;
		case  "getchartereData":
			$stationName =  trim($_GET['stationName']);
			getChartereData($stationName,$class_mysql_default);
		case "drivername": //获取驾驶员姓名
			$dcard = trim($_GET['dcard']);
			$str="SELECT di_Name FROM tms_bd_DriverInfo WHERE di_DriverCard = '$dcard'"; //获取驾驶员姓名
			$result1= $class_mysql_default->my_query("$str");
			$rows=mysqli_fetch_array($result1);
			if($rows['di_Name'] == null) {
				$retData = array('retVal' => 'FAIL', 'DriverName' => '');
				echo json_encode($retData);
				//exit();
			}
			else{
		    	$retData = array('retVal' => 'SUCC','DriverName' => $rows['di_Name']);
		    	echo json_encode($retData);
			}
			break;
		case "getdriver1":
		    $dcard = trim($_GET['dcard']);
		    $queryString = "SELECT di_Name,di_DriverCard FROM tms_bd_DriverInfo WHERE di_DriverCard LIKE '%{$dcard}%'";
			$result = $class_mysql_default->my_query("$queryString");
		  	if(!mysqli_num_rows($result)) {
				$retData = array('retVal' => 'FAIL', 'retString' => '查询驾驶员数据失败！'.$class_mysql_default->my_error(), 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
			else{
				while($row = mysqli_fetch_array($result)){
					$retData[] = array('DriverCard' => $row['di_DriverCard'],'DriverName' => $row['di_Name']);
				}
				echo json_encode($retData);
		}
		break;
		default:
	} 
	function getBusData($busid,$class_mysql_default)
	{
		$busid = trim($_GET['busid']);
		$queryString = "SELECT bi_BusNumber FROM tms_bd_BusInfo WHERE bi_BusID='{$busid}'";
		$result = $class_mysql_default->my_query("$queryString");
		if (!$result) echo "SQL错误：".$class_mysql_default->my_error();
		if(!$result) {
			$retData = array('retVal' => 'FAIL', 'retString' => '查询车辆数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}else{
			$row = mysqli_fetch_array($result);
				$retData = array( 'BusNumber' => $row['bi_BusNumber']);
		}
		
		echo json_encode($retData);
	}
	function getCheckersData($driverid,$class_mysql_default){
		$queryString = "SELECT di_Name FROM tms_bd_DriverInfo WHERE di_DriverCard='{$driverid}'";
		$result = $class_mysql_default->my_query("$queryString");
	if(!$result) {
			$retData = array('retVal' => 'FAIL', 'retString' => '查询驾驶员数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}else{
			$row = mysqli_fetch_array($result);
				$retData = array('DriverName' => $row['di_Name']);
		}
		echo json_encode($retData);
	} 
	function getChartereData($stationName,$class_mysql_default){
		if ($stationName == "")
		$stationName = "%";
		$queryString = "SELECT ui_UserID FROM tms_sys_UsInfor WHERE ui_UserSation LIKE '{$stationName}' AND ui_UserGroup='包车组'";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysqli_fetch_array($result)) {
			$retData[] = array(
				'sellerID' => $row['ui_UserID']);
		}
//	echo "{\"sellers\":" . json_encode($retData) . "}";
		echo json_encode($retData);
	}
?>