<?php
/*
 * 用户密码修改页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("inc/init.inc.php");

$ui_UserID = $_COOKIE["{$config_cookie_head}_UserID"];
$ui_UserPassword = $_COOKIE["{$config_cookie_head}_UserPassword"];
if(isset($_POST['sureMod'])) {
	$oldPass = md5($_POST['oldPassword']);
	$newPass = md5($_POST['newPassword1']);
	if($oldPass != $ui_UserPassword) {
		echo "<script>alert('输入的旧密码不正确，请重新输入!');</script>";
	}
	else {
		$queryString = "UPDATE tms_sys_UsInfor SET ui_UserPassword = '{$newPass}' WHERE ui_UserID = '{$ui_UserID}'"; 
		if($class_mysql_default->my_query("$queryString")) {
			echo "<script>alert('用户密码修改成功!');location.assign('login2.php?action=login');</script>";
		}
		else {
			echo "<script>alert('用户密码修改失败!请重试。');history.go(-1);</script>";
		}
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>用户密码修改</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<form action="" method="post" name="form1" onsubmit="return checkInfo()">
		<table width="60%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
  			<tr>
    			<td bgcolor="#f0f8ff"><span class="form_title"><img src="images/sj.gif" width="6" height="7" /></span> 修 改 用 户 密 码</td>
  			</tr>
		</table>
		<table width="60%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td style="width:20%" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="images/sj.gif" width="6" height="7" /> 请输入旧密码：</span>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input size="50" type="password" id="oldPassword" name="oldPassword" value="" /></td>
			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="images/sj.gif" width="6" height="7" /> 请输入新密码：</span>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input size="50" type="password" id="newPassword1" name="newPassword1" value="" /></td>
			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="images/sj.gif" width="6" height="7" /> 请再次输入新密码：</span>
				<input  size="50" type="password" id="newPassword2" name="newPassword2" value="" /></td>
			</tr>
			<tr>
				<td colspan='2' align="center" bgcolor="#FFFFFF">
					<input type="submit" name="sureMod" value="确认修改" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" value="取消" onclick="javascript:history.go(-1);" />
				</td>
			</tr>
		</table>
		</form>
		<script>
		function checkInfo()
		{
			if (document.form1.oldPassword.value == ""){
				alert("请输入旧密码!");
				document.form1.oldPassword.focus();
				return false;
			}
			if (document.form1.newPassword1.value == ""){
				alert("请输入新密码!");
				document.form1.newPassword1.focus();
				return false;
			}
			if (document.form1.newPassword2.value == ""){
				alert("请再次输入新密码!");
				document.form1.newPassword2.focus();
				return false;
			}
			if (document.form1.newPassword1.value != document.form1.newPassword2.value){
				alert("两次输入的密码不一致，请重新输入!");
				document.form1.newPassword1.focus();
				return false;
			}
		}
		</script>
	</body>
</html>
