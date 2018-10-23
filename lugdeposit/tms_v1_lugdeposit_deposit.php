<?php
/*
 * 行李寄存页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$cr_KeepUserID = $_POST['cr_KeepUserID'];
$cr_KeepUser = $_POST['cr_KeepUser'];
$cr_StationID = $_POST['cr_StationID'];
$cr_Station = $_POST['cr_Station'];

if(isset($_POST['sureDeposit'])) {
	$cr_CustodyID = $_POST['cr_CustodyID'];
	$cr_PasserName = $_POST['cr_PasserName'];
	$cr_PasserTel = $_POST['cr_PasserTel'];
	$cr_BaggageNo = $_POST['cr_BaggageNo'];
	$cr_KeepMoney = $_POST['cr_KeepMoney'];
	$cr_Remark = $_POST['cr_Remark'];
	$cr_KeepUserID = $_POST['cr_KeepUserID'];
	$cr_KeepUser = $_POST['cr_KeepUser'];
	$cr_StationID = $_POST['cr_StationID'];
	$cr_Station = $_POST['cr_Station'];
	$cr_Type = "存放中";
	$cr_DepositTime = date('Y-m-d H:i:s');
	$queryString = "INSERT INTO tms_lug_CloakRoom (cr_CustodyID, cr_PasserName, cr_PasserTel, cr_BaggageNo, cr_KeepMoney, cr_KeepUserID, 
				cr_KeepUser, cr_StationID, cr_Station, cr_Type, cr_DepositTime, cr_Remark) VALUES ('{$cr_CustodyID}', '{$cr_PasserName}', 
				'{$cr_PasserTel}', '{$cr_BaggageNo}', '{$cr_KeepMoney}', '{$cr_KeepUserID}', '{$cr_KeepUser}', '{$cr_StationID}', 
				'{$cr_Station}', '{$cr_Type}', '{$cr_DepositTime}', '{$cr_Remark}')"; 
	$result = $class_mysql_default->my_query("$queryString"); 
	if($result) {
		echo "<script>alert('行李寄存成功!');location.assign('tms_v1_lugdeposit_query.php');;</script>";
	}
	else {
		echo "<script>alert('行李寄存失败!请重试。');location.assign('tms_v1_lugdeposit_query.php');</script>";
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>行李寄存</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../css/style_main.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<form action="" method="post" name="form1" onsubmit="return confirm('提交后将无法修改！确认提交?');">
		<table width="60%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
  			<tr>
    			<td colspan="5" bgcolor="#0083B5"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 行 李 寄 存 信 息</td>
  			</tr>
		</table>
		<table width="60%" align="center" class="main_tableborder" border="0" cellpadding="3" cellspacing="1">
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保管牌号：</span></td>
				<td><input type="text" name="cr_CustodyID" value="" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 旅客姓名：</span></td>
				<td><input type="text" name="cr_PasserName" value="" /></td>
			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 旅客电话：</span></td>
				<td><input type="text" name="cr_PasserTel" value="" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 行李件数：</span></td>
				<td><input type="text" name="cr_BaggageNo" value="" /></td>
			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保管费：</span></td>
				<td><input style="background-color:#F1E6C2" type="text" name="cr_KeepMoney" value="" /></td>
			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 备注：</span></td>
				<td colspan='4'><input style="width:100%" type="text" name="cr_Remark" value="" size="90"/></td>
			</tr>
			<tr>
				<td colspan='4' align="center" bgcolor="#FFFFFF">
					<input type="submit" name="sureDeposit" value="确认寄存" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" value="取消" onclick="location.assign('tms_v1_lugdeposit_query.php');" />
				</td>
			</tr>
			<tr>
				<td>
					<input type="hidden" id="cr_KeepUserID" value="<?php echo $cr_KeepUserID?>" name="cr_KeepUserID" />
					<input type="hidden" id="cr_KeepUser" value="<?php echo $cr_KeepUser?>" name="cr_KeepUser" />
					<input type="hidden" id="cr_StationID" value="<?php echo $cr_StationID?>" name="cr_StationID" />
					<input type="hidden" id="cr_Station" value="<?php echo $cr_Station?>" name="cr_Station" />
				</td>
			</tr>
		</table>
		</form>
	</body>
</html>
