<?

require_once('../ui/inc/init.inc.php');
require_once('../ui/inc/templates.lang.php');
require_once('../ui/inc/fun.inc.php');

$action = $_GET["action"];

//安全退出
if($action == "exit")
{
	setcookie("{$config_cookie_head}_WebUserID", "");
	setcookie("{$config_cookie_head}_WebUserPassword", "");
	setcookie("{$config_cookie_head}_WebUserName", "");
	setcookie("{$config_cookie_head}_WebUserCertificateType", "");
	setcookie("{$config_cookie_head}_WebUserCertificateNumber", "");
	setcookie("{$config_cookie_head}_WebUserEmail", "");
	setcookie("{$config_cookie_head}_WebUserPhone", "");
	funmessage("tms_v1_websell_login.php?action=login", $templang['exitsucess'], $backtime);
	exit();
}

//登陆
if($action == "login")
{
	//清除COOKIE
	setcookie("{$config_cookie_head}_WebUserID", "");
	setcookie("{$config_cookie_head}_WebUserPassword", "");
	setcookie("{$config_cookie_head}_WebUserName", "");
	setcookie("{$config_cookie_head}_WebUserCertificateType", "");
	setcookie("{$config_cookie_head}_WebUserCertificateNumber", "");
	setcookie("{$config_cookie_head}_WebUserEmail", "");
	setcookie("{$config_cookie_head}_WebUserPhone", "");
				
//	$userid = trim($_POST["username"]);
//	$pass = trim($_POST["userpass"]);
//	if(strlen($userid) < 1 || strlen($pass) < 1)
//	{
//		funmessage("javascript:history.go(-1)", $templang['emptytype'], $backtime);
//		exit();
//	}
//	$userpass = md5($pass);
//	$userpass =$pass;

	$UserRegisterName=$_GET['UserRegisterName'];
//	echo $UserRegisterName;
	$strsql = "select wur_UserRegisterName,wur_Password,wur_UserName,wur_CertificateType,wur_CertificateNumber from tms_bd_WebUserRegister 
		where wur_UserRegisterName = '$UserRegisterName'";
	$result = $class_mysql_default ->my_query($strsql);
	if(mysqli_num_rows($result) < 1)
	{
		funmessage("tms_v1_websell_login.php?action=login", $templang['namepasserror'], $backtime);
		exit();
	}
	else
	{
		$rows = mysqli_fetch_array($result);
		$UserRegisterName= $rows['wur_UserRegisterName'];
		$Password=$rows['wur_Password'];
		$UserName = $rows['wur_UserName'];
		$CertificateType = $rows['wur_CertificateType'];
		$CertificateNumber = $rows['wur_CertificateNumber'];
		setcookie("{$config_cookie_head}_WebUserID", "$UserRegisterName", "0", "/");
		setcookie("{$config_cookie_head}_WebUserPassword", "$Password", "0", "/");
		setcookie("{$config_cookie_head}_WebUserName", "$UserName", "0", "/");
		setcookie("{$config_cookie_head}_WebUserCertificateType", "$CertificateType", "0", "/");
		setcookie("{$config_cookie_head}_WebUserCertificateNumber", "$CertificateNumber", "0", "/");
		funmessage("tms_v1_websell_websell.php", $templang['loginsucess'], $backtime);
		exit();
	}
}
?>