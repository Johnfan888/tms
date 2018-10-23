<?php
//定义页面必须验证是否登录
//define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$UserRegisterName=$_POST['UserRegisterName'];
$Password1=md5($_POST['Password1']);
$UserName=$_POST['UserName'];
$CertificateType=$_POST['CertificateType'];
$CertificateNumber=$_POST['CertificateNumber'];
$Emaile=$_POST['Emaile'];
$Phone=$_POST['Phone'];

$insert="INSERT INTO tms_bd_WebUserRegister (wur_UserRegisterName,wur_Password,wur_UserName,wur_CertificateType,
	wur_CertificateNumber,wur_Emaile,wur_Phone) VALUES ('{$UserRegisterName}','{$Password1}','{$UserName}','{$CertificateType}',
	'{$CertificateNumber}','{$Emaile}','{$Phone}')";
$query = $class_mysql_default->my_query($insert);
if($query){
	echo"<script>alert('注册成功！');window.location.href='tms_v1_websell_group.php?action=login&UserRegisterName=$UserRegisterName'</script>";
}else{
	echo"<script>alert('注册失败');window.location.href='tms_v1_websell_register.php'</script>";
}
?>