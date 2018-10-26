<?php
/*
 * 售票操作页面
 */
//客票状态：8-不同票号重打
//保险票状态：8-不同票号重打
//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$Seller = $userName;
$SellerID = $userID;
$SellerStation = $userStationName;
$SellerStationID = $userStationID;

$op = $_REQUEST['op'];
switch ($op)
{
	case "getstation":
		$fromstation=$_GET['fromstation'];
		if($fromstation!=""){
			$queryString="SELECT sset_SiteName FROM tms_bd_SiteSet WHERE sset_SiteType = '车站' and (sset_HelpCode LIKE '{$fromstation}%' OR 
					sset_SiteName LIKE '{$fromstation}%') ";
			$result = $class_mysql_default->my_query("$queryString");
			while ($row = mysqli_fetch_array($result)) {
				$retData[] = array(
					'from' => $row['sset_SiteName']);
			}
			echo json_encode($retData);
		}else{
			$retData[] = array(
					'from' => '');
			echo json_encode($retData);
		}
		break;	
	default:
}
