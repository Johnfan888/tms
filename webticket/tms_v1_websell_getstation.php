<?php
/*
 * 查询售票员页面
 */

//定义页面必须验证是否登录
define("WEBAUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$op = $_REQUEST['op'];
$fromstation=$_REQUEST['fromstation'];
if($op=="getstation"){
	if($fromstation!=""){
		$queryString="SELECT sset_SiteName FROM tms_bd_SiteSet WHERE sset_HelpCode LIKE '{$fromstation}%' or sset_SiteName  LIKE '{$fromstation}%'";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysql_fetch_array($result)) {
			$retData[] = array(
				'from' => $row['sset_SiteName']);
		}
		echo json_encode($retData);
	}else{
		$retData[] = array(
				'from' => '');
		echo json_encode($retData);
	}
}
/*switch ($op)
{
	case "getSellersData":
		$stationName = trim($_GET['stationName']);
		getSellersData($stationName,$class_mysql_default);
		break;
	case "getCheckersData":
		$stationName = trim($_GET['stationName']);
		getCheckersData($stationName,$class_mysql_default);
		break;
	case "setStatData":
		$statFileName = $_POST['statfile'];
		$statData = trim($_POST['statdata']);
		file_put_contents("$statFileName",$statData);
		break;
	default:
}

function getSellersData($stationName,$class_mysql_default)
{
	if ($stationName == "")
		$stationName = "%";
	$queryString = "SELECT * FROM tms_sys_UsInfor WHERE ui_UserSation LIKE '{$stationName}' AND ui_UserGroup='售票组'";
	$result = $class_mysql_default->my_query("$queryString");
	while ($row = mysql_fetch_array($result)) {
		$retData[] = array(
			'sellerID' => $row['ui_UserID']);
	}
//	echo "{\"sellers\":" . json_encode($retData) . "}";
	echo json_encode($retData);
}

function getCheckersData($stationName,$class_mysql_default)
{
	if ($stationName == "")
		$stationName = "%";
	$queryString = "SELECT * FROM tms_sys_UsInfor WHERE ui_UserSation LIKE '{$stationName}' AND ui_UserGroup='检票组'";
	$result = $class_mysql_default->my_query("$queryString");
	while ($row = mysql_fetch_array($result)) {
		$retData[] = array(
			'checkerID' => $row['ui_UserID']);
	}
//	echo "{\"checkers\":" . json_encode($retData) . "}";
	echo json_encode($retData);
} */
?>

