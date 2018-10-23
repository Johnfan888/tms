<?php 
require_once("../ui/inc/init.inc.php");		
$op = $_REQUEST['op'];
if($op=='LOGINCHK'){
	$UserName=$_REQUEST['UserName'];
	$UserPass=md5($_REQUEST['UserPass']);
	$select="SELECT wur_UserRegisterName FROM tms_bd_WebUserRegister WHERE wur_UserRegisterName='$UserName' AND wur_Password='$UserPass'";
	$result = $class_mysql_default ->my_query($select);
	if (mysql_num_rows($result) < 1){
		$retData = array('retVal' => 'FAIL', 'retString' => '查询票价数据失败！', 'sql' => $queryString);
		echo json_encode($retData);
		exit();
	}
	$retData = array('retVal' => 'SUCC');
	echo json_encode($retData);
} 
if($op=='REGISTERCHK'){
	$UserRegisterName=$_REQUEST['UserRegisterName'];
	$select="SELECT wur_UserRegisterName FROM tms_bd_WebUserRegister WHERE wur_UserRegisterName='$UserRegisterName'";
	$result = $class_mysql_default ->my_query($select);
	if (mysql_num_rows($result)>0){
		$retData = array('retVal' => 'FAIL1');
		echo json_encode($retData);
		exit();
	}
	
	$CertificateNumber=$_REQUEST['CertificateNumber'];
	$select="SELECT wur_UserRegisterName FROM tms_bd_WebUserRegister WHERE wur_CertificateNumber='$CertificateNumber'";
	$result = $class_mysql_default ->my_query($select);
	if (mysql_num_rows($result)>0){
		$retData = array('retVal' => 'FAIL2');
		echo json_encode($retData);
		exit();
	}
	$retData = array('retVal' => 'SUCC');
	echo json_encode($retData);
}

?>
