<?php
/*
 * 用户删除页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

if(isset($_POST['sureDel'])) {
	$ui_UserID = $_POST['ui_UserID'];
	$queryString = "DELETE FROM tms_sys_UsInfor WHERE ui_UserID = '{$ui_UserID}'"; 
	if($class_mysql_default->my_query("$queryString")) {
		echo "<script>alert('用户信息删除成功!');location.assign('tms_v1_system_userquery.php?DELDONE=1');;</script>";
	}
	else {
		echo "<script>alert('用户信息删除失败!请重试。');location.assign('tms_v1_system_userquery.php?DELDONE=1');</script>";
	}
}
else {
	$ui_UserID = $_POST['ui_delUserID'];
	$queryString = "SELECT ui_UserName, ui_UserGroup, ui_UserSation, ui_Remark FROM tms_sys_UsInfor WHERE ui_UserID = '{$ui_UserID}'";
	$result = $class_mysql_default->my_query("$queryString");
	$row = mysqli_fetch_array($result);
	$ui_UserName = $row['ui_UserName'];
	$ui_UserGroup = $row['ui_UserGroup'];
	$ui_UserSation = $row['ui_UserSation'];
	$ui_Remark = $row['ui_Remark'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>用户信息删除</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<form action="" method="post" name="form1" onsubmit="return confirm('确认删除?');">
		<table width="40%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
  			<tr>
    			<td bgcolor="#0083B5"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> <font color="white">删 除 用 户 信 息</font></td>
  			</tr>
		</table>
		<table width="40%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td nowrap="nowrap" style="width:20%" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 用户ID：</span></td>
				<td><input style="width:100%" type="text" id="ui_UserID" name="ui_UserID" value="<?php echo $ui_UserID;?>" /></td>
			</tr>
			<tr>
				<td align="left" nowrap="nowrap"  bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 用户姓名：</span></td>
				<td><input style="width:100%" type="text" id="ui_UserName" name="ui_UserName" value="<?php echo $ui_UserName;?>" /></td>
			</tr>
			<tr>
				<td align="left" nowrap="nowrap"  bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 用户属组：</span></td>
				<td><input style="width:100%" type="text" id="ui_UserGroup" name="ui_UserGroup" value="<?php echo $ui_UserGroup;?>" /></td>
			</tr>
			<tr>
				<td align="left"  nowrap="nowrap"  bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站：</span></td>
				<td><input style="width:100%" type="text" id="ui_UserSation" name="ui_UserSation" value="<?php echo $ui_UserSation;?>" /></td>
			</tr>
			<tr>
				<td align="left" nowrap="nowrap"  bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 备注：</span></td>
				<td><input style="width:100%" type="text" id="ui_Remark" name="ui_Remark" value="<?php echo $ui_Remark;?>" /></td>
			</tr>
			<tr>
				<td colspan='2' align="center" bgcolor="#FFFFFF">
					<input type="submit" name="sureDel" value="删除" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" value="取消" onclick="location.assign('tms_v1_system_userquery.php?DELDONE=1');" />
				</td>
			</tr>
		</table>
		</form>
	</body>
</html>
