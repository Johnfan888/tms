<?php
/*
 * 缴款收款页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
//echo $_POST['SellUserID'];
if (isset($_POST['subPay'])) {
	$sp_SellUserID = $_POST['SellUserID'];
	$sp_SellUser = $_POST['SellUser'];
	$sp_SellDate = $_POST['SellDate'];
	$sp_BeginTicket = $_POST['BeginTicket'];
	$sp_EndTicket = $_POST['EndTicket'];
	$sp_SellMoney = $_POST['SellMoney'];
	$sp_SellCount = $_POST['SellCount'];
	$sp_ErrMoney = $_POST['ErrMoney'];
	$sp_ErrCount = $_POST['ErrCount'];
	$sp_ReturnMoney = $_POST['ReturnMoney'];
	$sp_ReturnCount = $_POST['ReturnCount'];
	$sp_ReturnRate = $_POST['ReturnRate'];
	$sp_SafetyMoney = $_POST['SafetyMoney'];
	$sp_SafetyCount = $_POST['SafetyCount'];
	$sp_UpCount = $_POST['UpCount'];
	$sp_UpMoney = $_POST['UpMoney'];
	$sp_Station = $_POST['Station'];
	$sp_UserID = $_POST['UserID'];
	$sp_User = $_POST['User'];
	$sp_Date = date('Y-m-d');
	$sp_PayMoney = $_POST['PayMoney'];;
	$sp_RemainMoney = $_POST['RemainMoney'];;
	$sp_Remark = $_POST['Remark'];;
	$sp_Pc = $_POST['Pc'];;
	$sp_allRemainMoney = $_POST['allRemainMoney']; //不存入表中
	$subDateTime = date('Y-m-d H:i:s');
	
	$queryString = "SELECT * FROM tms_acct_SellPay WHERE sp_SellUserID='{$sp_SellUserID}' AND sp_SellDate='{$sp_SellDate}'";
	$result = $class_mysql_default->my_query("$queryString");
	if(!mysqli_fetch_array($result)){
		$queryString1 = "INSERT INTO tms_acct_SellPay (sp_SellUserID, sp_SellUser, sp_SellDate, sp_BeginTicket, sp_EndTicket, sp_SellMoney, 
				sp_SellCount, sp_ErrMoney, sp_ErrCount, sp_ReturnMoney, sp_ReturnCount, sp_ReturnRate, sp_SafetyMoney, sp_SafetyCount, 
				sp_UpCount, sp_UpMoney, sp_Station, sp_UserID, sp_User, sp_Date, sp_PayMoney, sp_RemainMoney, sp_Remark, sp_Pc) VALUES ('{$sp_SellUserID}', 
				'{$sp_SellUser}', '{$sp_SellDate}', '{$sp_BeginTicket}', '{$sp_EndTicket}', '{$sp_SellMoney}', '{$sp_SellCount}', '{$sp_ErrMoney}', 
				'{$sp_ErrCount}', '{$sp_ReturnMoney}', '{$sp_ReturnCount}', '{$sp_ReturnRate}', '{$sp_SafetyMoney}', '{$sp_SafetyCount}', 
				'{$sp_UpCount}', '{$sp_UpMoney}', '{$sp_Station}', '{$sp_UserID}', '{$sp_User}', '{$sp_Date}', '{$sp_PayMoney}', '{$sp_RemainMoney}', 
				'{$sp_Remark}', '{$sp_Pc}')";
		$queryString2 = "Update tms_sell_SellTicket SET st_IsBalance=1, st_BalanceDateTime='{$subDateTime}' WHERE st_SellDate='{$sp_SellDate}' AND st_SellID='{$sp_SellUserID}'";
		$queryString3 = "Update tms_sell_ReturnTicket SET rtk_IsBalance=1, rtk_BalanceDateTime='{$subDateTime}' WHERE rtk_ReturnDate='{$sp_SellDate}' AND rtk_ReturnUserID='{$sp_SellUserID}'";
		$queryString4 = "Update tms_sell_ErrTicket SET et_IsBalance=1, et_BalanceDateTime='{$subDateTime}' WHERE et_ErrDate='{$sp_SellDate}' AND et_ErrUserID='{$sp_SellUserID}'";
		$class_mysql_default->my_query("BEGIN");
		$result1 = $class_mysql_default->my_query("$queryString1"); 
		$result2 = $class_mysql_default->my_query("$queryString2"); 
		$result3 = $class_mysql_default->my_query("$queryString3"); 
		$result4 = $class_mysql_default->my_query("$queryString4"); 
		if($result1 && $result2 && $result3 && $result4) {
			$class_mysql_default->my_query("COMMIT");
			echo "<script>alert('缴款信息提交成功!');location.assign('tms_v1_accounting_sellQuery.php');</script>";
		}
		else {
			$class_mysql_default->my_query("ROLLBACK");
			echo "<script>alert('缴款信息提交失败!请重试。');</script>";
		}
		$class_mysql_default->my_query("END"); 
	}
	else {
		echo "<script>alert('缴款信息已提交，无需再次提交！');location.assign('tms_v1_accounting_sellQuery.php');</script>";
	}
}
else {
	$sp_SellUserID = $_POST['sellerID1'];
	$sp_SellUser = $_POST['sellerName'];
	$sp_SellDate = $_POST['sellDate'];
	$sp_BeginTicket = $_POST['beginTicketID'];
	$sp_EndTicket = $_POST['endTicketID'];
	$sp_SellMoney = $_POST['sellMoney'];
	$sp_SellCount = $_POST['sellNumber'];
	$sp_ErrMoney = $_POST['errMoney'];
	$sp_ErrCount = $_POST['errNumber'];
	$sp_ReturnMoney = $_POST['returnMoney'];
	$sp_ReturnCount = $_POST['returnNumber'];
	$sp_ReturnRate = $_POST['returnFees'];
	$sp_SafetyMoney = $_POST['insurMoney'];
	$sp_SafetyCount = $_POST['insurNumber'];
	$sp_UpCount = $_POST['subNumber'];
	$sp_UpMoney = $_POST['subMoney'];
	$sp_Station = $_POST['sellerStation'];
	$sp_UserID = $_POST['userID'];
	$sp_User = $_POST['userName'];
	$sp_Date = date('Y-m-d');
	$sp_Pc = "Dell";
	
	$queryString = "SELECT SUM(sp_RemainMoney) FROM tms_acct_SellPay WHERE sp_SellUserID='{$sp_SellUserID}'";
	$result = $class_mysql_default->my_query("$queryString"); 
	$res=mysqli_fetch_array($result);
	$sp_allRemainMoney = $res[0];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>营收缴款</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script>
		$(document).ready(function(){
			$("#PayMoney").focus();
			$("#PayMoney").blur(function(){
				var value1 = $("#UpMoney").val()-$("#PayMoney").val();
				var value2 = $("#allRemainMoney").val()*1+value1;
				$("#RemainMoney").val(value1);
				$("#allRemainMoney").val(value2);
			});
		});
		</script>
	</head>
	<body>
		<form action="" method="post" name="form1" onsubmit="return confirm('提交后将无法修改！确认提交?');">
		<table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
  			<tr>
    			<td colspan="5" bgcolor="#f0f8ff"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 缴 款 信 息</td>
  			</tr>
		</table>
		<table width="100%" align="center" border="1" class="main_tableborder" cellpadding="3" cellspacing="1">
			<tr>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 售票员ID：</span></td>
				<td nowrap="nowrap"><input type="text" name="SellUserID" value="<?php echo $sp_SellUserID;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 售票员：</span></td>
				<td nowrap="nowrap"><input type="text" name="SellUser" value="<?php echo $sp_SellUser;?>" readonly="readonly" /></td>
				<td  nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所缴款日期：</span></td>
				<td nowrap="nowrap" ><input type="text" name="SellDate" value="<?php echo $sp_SellDate;?>" readonly="readonly" /></td>
			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开始票号：</span></td>
				<td nowrap="nowrap" ><input type="text" name="BeginTicket" value="<?php echo $sp_BeginTicket;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结束票号：</span></td>
				<td nowrap="nowrap" ><input type="text" name="EndTicket" value="<?php echo $sp_EndTicket;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 售票金额：</span></td>
				<td nowrap="nowrap" ><input type="text" name="SellMoney" value="<?php echo $sp_SellMoney;?>" readonly="readonly" /></td>
			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 售票张数：</span></td>
				<td nowrap="nowrap" ><input type="text" name="SellCount" value="<?php echo $sp_SellCount;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 废票金额：</span></td>
				<td nowrap="nowrap" ><input type="text" name="ErrMoney" value="<?php echo $sp_ErrMoney;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 废票张数：</span></td>
				<td nowrap="nowrap" ><input type="text" name="ErrCount" value="<?php echo $sp_ErrCount;?>" readonly="readonly" /></td>
			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 退还金额：</span></td>
				<td nowrap="nowrap" ><input type="text" name="ReturnMoney" value="<?php echo $sp_ReturnMoney;?>" readonly="readonly" /></td>
				<td  nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 退票张数：</span></td>
				<td nowrap="nowrap" ><input type="text" name="ReturnCount" value="<?php echo $sp_ReturnCount;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 退票手续费：</span></td>
				<td nowrap="nowrap" ><input type="text" name="ReturnRate" value="<?php echo $sp_ReturnRate;?>" readonly="readonly" /></td>
			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保险票金额：</span></td>
				<td nowrap="nowrap"><input type="text" name="SafetyMoney" value="<?php echo $sp_SafetyMoney;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保险票张数：</span></td>
				<td nowrap="nowrap" ><input type="text" name="SafetyCount" value="<?php echo $sp_SafetyCount;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 应交票张数：</span></td>
				<td nowrap="nowrap" ><input type="text" name="UpCount" value="<?php echo $sp_UpCount;?>" readonly="readonly" /></td>
			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 应缴金额：</span></td>
				<td nowrap="nowrap"><input type="text" id="UpMoney" name="UpMoney" value="<?php echo $sp_UpMoney;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 实缴金额：</span></td>
				<td nowrap="nowrap"><input style="background-color:#F1E6C2" type="text" id="PayMoney" name="PayMoney" value="<?php echo $sp_UpMoney?>" /></td>
				<td  nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 本次欠款：</span></td>
				<td nowrap="nowrap"><input type="text" id="RemainMoney" name="RemainMoney" value="0" readonly="readonly" /></td>
			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 累计欠款：</span></td>
				<td nowrap="nowrap"><input type="text" id="allRemainMoney" name="allRemainMoney" value="<?php echo $sp_allRemainMoney;?>" readonly="readonly" /></td>
				<td  nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 售票员所属车站：</span></td>
				<td nowrap="nowrap"><input type="text" name="Station" value="<?php echo $sp_Station?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收款员ID：</span></td>
				<td nowrap="nowrap" ><input type="text" name="UserID" value="<?php echo $sp_UserID?>" readonly="readonly" /></td>
			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 备注：</span></td>
				<td nowrap="nowrap" colspan='5'><input style="width:100%" type="text" name="Remark" value="" size="90"/></td>
			</tr>
			<tr>
				<td nowrap="nowrap" colspan='6' align="center" bgcolor="#FFFFFF">
					<input type="submit" name="subPay" value="确认缴款" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" value="取消" onclick="location.assign('tms_v1_accounting_sellQuery.php');" />
				</td>
			</tr>
			<tr>
				<td style="border:0px;">
					<input type="hidden" id="User" value="<?php echo $sp_User?>" name="User" />
					<input type="hidden" id="Pc" value="<?php echo $sp_Pc?>" name="Pc" />
				</td>
			</tr>
			
		</table>
		</form>
	</body>
</html>
