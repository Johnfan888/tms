<?
$UserRegisterName=$_COOKIE["{$config_cookie_head}_WebUserID"];
$Password = $_COOKIE["{$config_cookie_head}_WebUserPassword"];
$UserName = $_COOKIE["{$config_cookie_head}_WebUserName"];
$CertificateType = $_COOKIE["{$config_cookie_head}_WebUserCertificateType"];
$CertificateNumber = $_COOKIE["{$config_cookie_head}_WebUserCertificateNumber"];

$strsql = "select wur_UserRegisterName from tms_bd_WebUserRegister where wur_UserRegisterName = '$UserRegisterName' and 
	wur_Password = '$Password'";
$result = $class_mysql_default ->my_query($strsql);
if(mysqli_num_rows($result) <1)
{
	echo "<script>alert('����Ȩ���ʴ�ҳ��!�����Ƿ���ȷ��¼��');history.back();</script>";
}
?>