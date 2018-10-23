<?php
/*
 * 行李提取页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

if(isset($_POST['sureExtract'])) {
	$cr_ID = $_POST['cr_ID'];
	$cr_KeepMoney = $_POST['cr_KeepMoney'];
	$cr_Remark = $_POST['cr_Remark'];
	$cr_ExtractionUserID = $_POST['cr_ExtractionUserID'];
	$cr_ExtractionUser = $_POST['cr_ExtractionUser'];
	$cr_Type = "已提取";
	$cr_ExtractionTime = date('Y-m-d H:i:s');
	$queryString = "Update tms_lug_CloakRoom SET cr_KeepMoney='{$cr_KeepMoney}', cr_Remark='{$cr_Remark}', 
				cr_ExtractionUserID='{$cr_ExtractionUserID}', cr_ExtractionUser='{$cr_ExtractionUser}', 
				cr_Type='{$cr_Type}', cr_ExtractionTime='{$cr_ExtractionTime}' WHERE cr_ID='{$cr_ID}'";
	$result = $class_mysql_default->my_query("$queryString"); 
	if($result) {
		echo "<script>alert('行李提取成功!');location.assign('tms_v1_lugdeposit_query.php');;</script>";
	}
	else {
		echo "<script>alert('行李提取失败!请重试。');location.assign('tms_v1_lugdeposit_query.php');</script>";
	}
}
else {
	if($_POST['cr_ID'] == "") {
		echo "<script>alert('没有选择要提取的寄存行李！');location.assign('tms_v1_lugdeposit_query.php');</script>";
	}
	if($_POST['cr_Type'] == "已提取") {
		echo "<script>alert('该寄存行李已经提取！');location.assign('tms_v1_lugdeposit_query.php');</script>";
	}
	$cr_ID = $_POST['cr_ID'];
	$cr_CustodyID = $_POST['cr_CustodyID'];
	$cr_PasserName = $_POST['cr_PasserName'];
	$cr_PasserTel = $_POST['cr_PasserTel'];
	$cr_BaggageNo = $_POST['cr_BaggageNo'];
	$cr_KeepMoney = $_POST['cr_KeepMoney'];
	$cr_Station = $_POST['cr_Station'];
	$cr_Remark = $_POST['cr_Remark'];
	$cr_ExtractionUserID = $_POST['cr_ExtractionUserID'];
	$cr_ExtractionUser = $_POST['cr_ExtractionUser'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>行李提取</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../css/style_main.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<form action="" method="post" name="form1" onsubmit="return confirm('提交后将无法修改！确认提交?');">
		<table width="60%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
  			<tr>
    			<td colspan="5" bgcolor="#0083B5"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 行 李 提 取 信 息</td>
  			</tr>
		</table>
		<table width="60%" align="center" class="main_tableborder" border="0" cellpadding="3" cellspacing="1">
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保管牌号：</span></td>
				<td><input type="text" name="cr_CustodyID" value="<?php echo $cr_CustodyID;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 旅客姓名：</span></td>
				<td><input type="text" name="cr_PasserName" value="<?php echo $cr_PasserName;?>" readonly="readonly" /></td>
			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 旅客电话：</span></td>
				<td><input type="text" name="cr_PasserTel" value="<?php echo $cr_PasserTel;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 行李件数：</span></td>
				<td><input type="text" name="cr_BaggageNo" value="<?php echo $cr_BaggageNo;?>" readonly="readonly" /></td>
			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保管费：</span></td>
				<td><input style="background-color:#F1E6C2" type="text" name="cr_KeepMoney" value="<?php echo $cr_KeepMoney;?>" /></td>
			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 备注：</span></td>
				<td colspan='4'><input style="width:100%" type="text" name="cr_Remark" value="<?php echo $cr_Remark;?>" size="90"/></td>
			</tr>
			<tr>
				<td colspan='6' align="center" bgcolor="#FFFFFF">
					<input type="submit" name="sureExtract" value="确认提取" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" value="取消" onclick="location.assign('tms_v1_lugdeposit_query.php');" />
				</td>
			</tr>
			<tr>
				<td>
					<input type="hidden" id="cr_ID" value="<?php echo $cr_ID?>" name="cr_ID" />
					<input type="hidden" id="cr_ExtractionUserID" value="<?php echo $cr_ExtractionUserID?>" name="cr_ExtractionUserID" />
					<input type="hidden" id="cr_ExtractionUser" value="<?php echo $cr_ExtractionUser?>" name="cr_ExtractionUser" />
				</td>
			</tr>
		</table>
		</form>
	</body>
</html>
