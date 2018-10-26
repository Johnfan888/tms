<?php
/*
 * 包车缴款收款页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

if (isset($_POST['subPay'])) {
	$BillingDate = $_POST['BillingDate1'];
	$BillingerID = $_POST['BillingerID1'];
	$BillingerName = $_POST['BillingerName1'];
	$beginTicketID = $_POST['beginTicketID1'];
	$endTicketID = $_POST['endTicketID1'];
	$CharteredMoney = $_POST['CharteredMoney1'];
	$Number = $_POST['Number1'];
	$turnMoney = $_POST['turnMoney1'];
	$BillingStation = $_POST['BillingStation1'];
	$sp_UserID = $_POST['UserID1'];
	$sp_User = $_POST['User'];
	$sp_Date = date('Y-m-d');
//	$sp_PayMoney = $_POST['PayMoney'];;
//	$sp_RemainMoney = $_POST['RemainMoney'];
	$sp_Remark = $_POST['Remark'];;
	$sp_Pc = $_POST['Pc'];;
//	$sp_allRemainMoney = $_POST['allRemainMoney']; //不存入表中
	$subDateTime = date('Y-m-d H:i:s');
	
	$queryString = "SELECT cpm_ID FROM tms_bd_CharteredPayMoney WHERE cpm_BillingerID='{$BillingerID}' AND cpm_BillingDate='{$BillingDate}'";
	$result = $class_mysql_default->my_query("$queryString");
	if(!mysqli_fetch_array($result)){
		$queryString1 = "INSERT INTO tms_bd_CharteredPayMoney (cpm_BillingerID, cpm_BillingerName, cpm_BillingDate, cpm_beginTicketID, 
				cpm_endTicketID, cpm_Number, cpm_PayMoney, cpm_BillingStation, cpm_UserID,cpm_User,cpm_SubDateTime,cpm_PC,cpm_Remark) 
				VALUES ('{$BillingerID}', '{$BillingerName}', '{$BillingDate}', '{$beginTicketID}', '{$endTicketID}', '{$Number}', '{$turnMoney}',  
				'{$BillingStation}', '{$sp_UserID}', '{$sp_User}', '{$subDateTime}', '{$sp_Pc}', '{$sp_Remark}')";
		$queryString2 = "Update tms_bd_CharteredBus SET cb_IsBalance=1, cb_BalanceDateTime='{$subDateTime}' WHERE cb_BillingDate='{$sp_Date}' AND cb_BillingerID='{$sp_UserID}'";
	//	$queryString3 = "Update tms_sell_ReturnTicket SET rtk_IsBalance=1, rtk_BalanceDateTime='{$subDateTime}' WHERE rtk_ReturnDate='{$sp_SellDate}' AND rtk_ReturnUserID='{$sp_SellUserID}'";
	//	$queryString4 = "Update tms_sell_ErrTicket SET et_IsBalance=1, et_BalanceDateTime='{$subDateTime}' WHERE et_ErrDate='{$sp_SellDate}' AND et_ErrUserID='{$sp_SellUserID}'";
		$class_mysql_default->my_query("BEGIN");
		$result1 = $class_mysql_default->my_query("$queryString1"); 
		$result2 = $class_mysql_default->my_query("$queryString2"); 
	//	$result3 = $class_mysql_default->my_query("$queryString3"); 
	//	$result4 = $class_mysql_default->my_query("$queryString4"); 
	//	if($result1 && $result2 && $result3 && $result4) {
		if($result1 && $result2) {
			$class_mysql_default->my_query("COMMIT");
			echo "<script>alert('包车缴款信息提交成功!');location.assign('tms_v1_basedata_charterebussellQuery.php');</script>";
		}
		else {
			$class_mysql_default->my_query("ROLLBACK");
			echo "<script>alert('缴款信息提交失败!请重试。');</script>";
		}
		$class_mysql_default->my_query("END"); 
	}
	else {
		echo "<script>alert('包车缴款信息已提交，无需再次提交！');location.assign('tms_v1_basedata_charterebussellQuery.php');</script>";
	}
}
else {
	$BillingDate = $_POST['BillingDate'];
	$BillingerID = $_POST['BillingerID'];
	$BillingerName = $_POST['BillingerName'];
	$beginTicketID = $_POST['beginTicketID'];
	$endTicketID = $_POST['endTicketID'];
	$CharteredMoney = $_POST['CharteredMoney'];
	$Number = $_POST['Number'];
	$turnMoney = $_POST['turnMoney'];
	$BillingStation = $_POST['BillingStation'];
	$sp_UserID = $_POST['userID'];
	$sp_User = $_POST['userName'];
	$sp_Date = date('Y-m-d');
	$sp_Pc = "Dell";
	
//	$queryString = "SELECT SUM(sp_RemainMoney) FROM tms_acct_SellPay WHERE sp_SellUserID='{$sp_SellUserID}'";
//	$result = $class_mysql_default->my_query("$queryString"); 
//	$res=mysqli_fetch_array($result);
//	$sp_allRemainMoney = $res[0];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>包车营收缴款</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script>
		function check(){
			if(document.getElementById("payMoney1").value-document.getElementById("turnMoney1").value<0){
				alert('实际缴款金额不足！');
				return false;
			}else{
				var value1 = $("#payMoney1").val()-$("#turnMoney1").val();
				$("#changeMoney1").val(value1);
			}	
		}
		$(document).ready(function(){
			$("#payMoney1").focus();
		//	$("#payMoney1").blur(function(){
			$("#changeMoney1").click(function(){
				var value1 = $("#payMoney1").val()-$("#turnMoney1").val();
			    if (value1<0){
					alert('实际缴款金额不足！');
					return false;
				}else{
					$("#changeMoney1").val(value1);
				}
			});
		});
		</script>
	</head>
	<body>
		<form action="" method="post" name="form1" onsubmit="return confirm('提交后将无法修改！确认提交?');">
		<table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
  			<tr>
    			<td colspan="5" bgcolor="#f0f8ff"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span>包 车 缴 款 信 息</td>
  			</tr>
		</table>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开单员ID：</span></td>
				<td nowrap="nowrap"><input type="text" name="BillingerID1" value="<?php echo $BillingerID;?>" readonly="readonly" /></td>
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开单员：</span></td>
				<td nowrap="nowrap"><input type="text" name="BillingerName1" value="<?php echo $BillingerName;?>" readonly="readonly" /></td>
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所缴款日期：</span></td>
				<td nowrap="nowrap"><input type="text" name="BillingDate1" value="<?php echo $BillingDate;?>" readonly="readonly" /></td>
			</tr>
			<tr>
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开始包车单号：</span></td>
				<td nowrap="nowrap"><input type="text" name="beginTicketID1" value="<?php echo $beginTicketID;?>" readonly="readonly" /></td>
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结束包车单号：</span></td>
				<td nowrap="nowrap"><input type="text" name="endTicketID1" value="<?php echo $endTicketID;?>" readonly="readonly" /></td>
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />包车单金额：</span></td>
				<td nowrap="nowrap"><input type="text" name="CharteredMoney1" value="<?php echo $CharteredMoney;?>" readonly="readonly" /></td>
			</tr>
			<tr>
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 包车单张数：</span></td>
				<td nowrap="nowrap"><input type="text" name="Number1" value="<?php echo $Number;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 应缴款金额：</span></td>
				<td nowrap="nowrap"><input type="text" name="turnMoney1" id="turnMoney1" value="<?php echo $turnMoney;?>" readonly="readonly" /></td>
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 实际缴款金额：</span></td>
				<td nowrap="nowrap"><input style="background-color:#F1E6C2"  type="text" name="payMoney1" id="payMoney1" value="" /></td>
			</tr>
			<tr>
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />找零：</span></td>
				<td nowrap="nowrap"><input style="background-color:#F1E6C2"  type="text" name="changeMoney1" id="changeMoney1" value="" readonly="readonly"/></td>
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开单员所属车站：</span></td>
				<td nowrap="nowrap"><input type="text" name="BillingStation1" value="<?php echo $BillingStation?>" readonly="readonly" /></td>
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收款员ID：</span></td>
				<td nowrap="nowrap"><input type="text" name="UserID1" value="<?php echo $sp_UserID?>" readonly="readonly" /></td>
			</tr>
			<tr>
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 备注：</span></td>
				<td nowrap="nowrap" colspan='5'><input style="width:100%" type="text" name="Remark" value="" size="90"/></td>
			</tr>
			<tr>
				<td nowrap="nowrap" colspan='6' align="center" bgcolor="#FFFFFF">
					<input type="submit" name="subPay" value="确认缴款"  onclick="return check()"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" value="取消" onclick="location.assign('tms_v1_basedata_charterebussellQuery.php');" />
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
