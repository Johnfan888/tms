<?php 
//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$op = $_REQUEST['op'];
switch ($op)
{
	case "getbus":
		$BusNumber = trim($_GET['BusNumber']);
		if($BusNumber!=""){
			$queryString="SELECT bi_BusNumber,bi_SeatS FROM tms_bd_BusInfo WHERE bi_BusNumber LIKE '%$BusNumber%'";
			$result = $class_mysql_default->my_query("$queryString");
			if(!mysqli_num_rows($result)) {
				$retData = array('retVal' => 'FAIL', 'retString' => '查询驾驶员数据失败！'.->my_error(), 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
			else{
			while ($row = mysqli_fetch_array($result)) {
				$retData[] = array('retVal' => 'SUCC',
					'BusNumber' => $row['bi_BusNumber'],'Seats' => $row['bi_SeatS']);
			}
			echo json_encode($retData);
			}
		}
		else{
			$retData[] = array(
					'BusNumber' => '','Seats' => '');
			echo json_encode($retData);
		}
		break;
	case "getbus1":
		$BusNumber = trim($_GET['BusNumber']);
		if($BusNumber!=""){
			$queryString="SELECT bi_BusNumber,bi_BusID FROM tms_bd_BusInfo WHERE bi_BusNumber LIKE '%$BusNumber%'";
			$result = $class_mysql_default->my_query("$queryString");
			while ($row = mysqli_fetch_array($result)) {
				$retData[] = array(
					'BusNumber' => $row['bi_BusNumber'],'BusID' => $row['bi_BusID']);
			}
			echo json_encode($retData);
		}else{
			$retData[] = array(
					'BusNumber' => '','BusID' => '');
			echo json_encode($retData);
		}
		break;
	case "getbusdata":
		$BusNumber = trim($_GET['BusNumber']);
		if($BusNumber!=""){
			$queryString="SELECT bi_BusID,bi_BusType,bi_BusUnit,bi_InStationID,bi_InStation,bi_ManagementLine FROM tms_bd_BusInfo WHERE bi_BusNumber='{$BusNumber}'";
			$result = $class_mysql_default->my_query("$queryString");
			if(!$result) {
				$retData = array('retVal' => 'FAIL', 'retString' => '查询车辆数据失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
			$row = mysqli_fetch_array($result);
			$retData = array(
				'BusID' => $row['bi_BusID'],
				'BusType' => $row['bi_BusType'],
				'BusUnit'=> $row['bi_BusUnit'],
				'InStationID' => $row['bi_InStationID'],
				'InStation'=> $row['bi_InStation'],
				'ManagementLine' =>$row['bi_ManagementLine']);
			echo json_encode($retData);
		}
		break;
	default:
}

?>