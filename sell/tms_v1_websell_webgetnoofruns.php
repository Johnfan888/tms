<?php 
//取票界面
	
//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$op = $_REQUEST['op'];
switch ($op){
	case "getnoofruns":
		$WebSellID = $_REQUEST['WebSellID'];
		$CertificateNumber=$_REQUEST['CertificateNumber'];
		$selectwebsell="SELECT wst_WebSellID, wst_CertificateNumber,wst_NoOfRunsID,wst_NoOfRunsdate,wst_BeginStationTime,wst_FromStation,
			wst_ReachStation,wst_TotalMan FROM tms_websell_WebSellTicket WHERE wst_WebSellID='{$WebSellID}' OR wst_CertificateNumber='{$CertificateNumber}'";
		$querywebsell = $class_mysql_default->my_query("$selectwebsell");
		$rowwebsell=mysqli_fetch_array($querywebsell);
		$result[]= array(
			'WebSellID'=>$rowwebsell[0],
			'CertificateNumber' =>$rowwebsell[1],
			'NoOfRunsID' =>$rowwebsell[2],
			'NoOfRunsdate'=>$rowwebsell[3],
			'BeginStationTime'=>$rowwebsell[4],
			'FromStation'=>$rowwebsell[5],
			'ReachStation'=>$rowwebsell[6],
			'TotalMan'=>$rowwebsell[7]
			);
		echo json_encode($result); 
		exit();
	default:
}
?>

