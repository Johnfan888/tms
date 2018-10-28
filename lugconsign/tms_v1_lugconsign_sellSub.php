<?php
/*
 * 行包缴款收款页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

if (isset($_POST['subPay'])) {   
	$DeliveryDate = $_POST['DeliveryDate1'];
	$DeliveryUserID = $_POST['DeliveryUserID1'];
	$TicketNumber = $_POST['TicketNumber1'];
	$DeliveryUser = $_POST['DeliveryUser1'];
	$DeliveryMoney = $_POST['DeliveryMoney1'];
	$DeliveryNumber = $_POST['DeliveryNumber1'];
	$ExtractionMoney = $_POST['ExtractionMoney1'];
	$ExtractionNumber = $_POST['ExtractionNumber1'];
	$LuggageConsMoney = $_POST['LuggageConsMoney1'];
	$lugconsigntation = $_POST['lugconsigntation1'];
	$sp_UserID = $_POST['UserID1'];
	$sp_User = $_POST['User'];
	$sp_Date = date('Y-m-d');
//	$sp_PayMoney = $_POST['PayMoney'];;
//	$sp_RemainMoney = $_POST['RemainMoney'];
	$sp_Remark = $_POST['Remark'];;
	$sp_Pc = $_POST['Pc'];;
//	$sp_allRemainMoney = $_POST['allRemainMoney']; //不存入表中
	$subDateTime = date('Y-m-d H:i:s');
	
	$queryString1 = "INSERT INTO tms_lug_LuggagePayMoney (lpm_DeliveryUserID, lpm_DeliveryUser, lpm_DeliveryDate, lpm_DeliveryMoney, 
			lpm_DeliveryNumber, lpm_ExtractionMoney, lpm_ExtractionNumber, lpm_LuggageConsMoney, lpm_lugconsigntation,lpm_UserID,
			lpm_User,lpm_SubDateTime,lpm_Remark) VALUES ('{$DeliveryUserID}', '{$DeliveryUser}', '{$DeliveryDate}', '{$DeliveryMoney}', 
			'{$DeliveryNumber}', '{$ExtractionMoney}', '{$ExtractionNumber}','{$LuggageConsMoney}',  
			'{$lugconsigntation}', '{$sp_UserID}', '{$sp_User}', '{$subDateTime}', '{$sp_Remark}')";
	$queryString2 = "Update tms_lug_LuggageCons SET lc_IsBalance=1, lc_BalanceDateTime='{$subDateTime}' WHERE (DATE_FORMAT(lc_AcceptDateTime,'%Y-%m-%d')='{$DeliveryDate}' AND lc_DeliveryUserID='{$sp_UserID}' AND lc_PayStyle='发货人付款') 
			or (DATE_FORMAT(lc_ExtractionTime,'%Y-%m-%d')='{$DeliveryDate}' AND lc_ExtractionUserID='{$sp_UserID}'  AND lc_PayStyle='收货人付款')";
//	$queryString2 = "Update tms_lug_LuggageCons SET lc_IsBalance=1, lc_BalanceDateTime='{$subDateTime}' WHERE lc_TicketNumber = '{$TicketNumber}'";
	$class_mysql_default->my_query("BEGIN");
	$result1 = $class_mysql_default->my_query("$queryString1"); 
	$result2 = $class_mysql_default->my_query("$queryString2");
	if(!$result1) echo "SQL错误：".$class_mysql_default->my_error(); 
	if(!$result2) echo "SQL错误：".$class_mysql_default->my_error(); 
	//	$result3 = $class_mysql_default->my_query("$queryString3"); 
	//	$result4 = $class_mysql_default->my_query("$queryString4"); 
	//	if($result1 && $result2 && $result3 && $result4) {
	if($result1 && $result2) {
		$class_mysql_default->my_query("COMMIT");
		echo "<script>alert('行包缴款信息提交成功!');location.assign('tms_v1_lugconsign_sellQuery.php');</script>";
	}else {
		$class_mysql_default->my_query("ROLLBACK");
		echo "<script>alert('缴款信息提交失败!请重试。');</script>";
	}
	$class_mysql_default->my_query("END"); 
	
}else {
	$DeliveryDate = $_POST['DeliveryDate'];
	$DeliveryUserID = $_POST['DeliveryUserID'];
//	$TicketNumber = $_POST['TicketNumber'];
	$DeliveryUser = $_POST['DeliveryUser'];
	$DeliveryMoney = $_POST['DeliveryMoney'];
	$DeliveryNumber = $_POST['DeliveryNumber'];
	$ExtractionMoney = $_POST['ExtractionMoney'];
	$ExtractionNumber = $_POST['ExtractionNumber'];
	$LuggageConsMoney = $_POST['LuggageConsMoney'];
	$lugconsigntation = $_POST['lugconsigntation'];
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
		<title>行包营收缴款</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script>
		function check(){
			if(document.getElementById("payMoney1").value-document.getElementById("LuggageConsMoney1").value<0){
				alert('实际缴款金额不足！');
				return false;
			}else{
				var value1 = $("#payMoney1").val()-$("#LuggageConsMoney1").val();
				$("#changeMoney1").val(value1);
			}		
		}
		$(document).ready(function(){
			$("#payMoney1").focus();
		//	$("#payMoney1").blur(function(){
			$("#changeMoney1").click(function(){
				var value1 = $("#payMoney1").val()-$("#LuggageConsMoney1").val();
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
		<form action="" method="post" name="form1" onsubmit="return confirm('请首先完成找零，提交后将无法修改！确认提交?');">
		<table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
  			<tr>
    			<td colspan="5" bgcolor="#f0f8ff"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span>行 包 缴 款 信 息</td>
  			</tr>
		</table>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 行包员ID：</span></td>
				<td><input type="text" name="DeliveryUserID1" value="<?php echo $DeliveryUserID;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 行包员：</span></td>
				<td><input type="text" name="DeliveryUser1" value="<?php echo $DeliveryUser;?>" readonly="readonly" /></td>
			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发行包单金额：</span></td>
				<td><input type="text" name="DeliveryMoney1" id="DeliveryMoney1" value="<?php echo $DeliveryMoney;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发行包单张数：</span></td>
				<td ><input type="text" name="DeliveryNumber1"  value="<?php echo $DeliveryNumber;?>" readonly="readonly" /></td>
			<!-- 
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 行包单号：</span></td>
				<td ><input type="text" name="TicketNumber1"  value="<?php echo $TicketNumber;?>" readonly="readonly" /></td>
			 -->
			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收行包单金额：</span></td>
				<td><input type="text" name="ExtractionMoney1" id="ExtractionMoney1" value="<?php echo $ExtractionMoney;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收行包单张数：</span></td>
				<td colspan="3"><input type="text" name="ExtractionNumber1"  value="<?php echo $ExtractionNumber;?>" readonly="readonly" /></td>
			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 应缴款金额：</span></td>
				<td><input style="background-color:#F1E6C2"  type="text" name="LuggageConsMoney1" id="LuggageConsMoney1" value="<?php echo $LuggageConsMoney;?>" readonly="readonly"/></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />实际缴款金额：</span></td>
				<td><input style="background-color:#F1E6C2"  type="text" name="payMoney1" id="payMoney1" value="" /></td>
			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />找零：</span></td>
				<td><input style="background-color:#F1E6C2"  type="text" name="changeMoney1" id="changeMoney1" value="" readonly="readonly"/></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所缴款日期：</span></td>
				<td><input type="text" name="DeliveryDate1" value="<?php echo $DeliveryDate;?>" readonly="readonly" /></td>
			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 行包员所属车站：</span></td>
				<td><input type="text" name="lugconsigntation1" value="<?php echo $lugconsigntation?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收款员ID：</span></td>
				<td colspan="3"><input type="text" name="UserID1" value="<?php echo $sp_UserID?>" readonly="readonly" /></td>
			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 备注：</span></td>
				<td colspan='5'><input style="width:100%" type="text" name="Remark" value="" size="90"/></td>
			</tr>
			<tr>
				<td colspan='6' align="center" bgcolor="#FFFFFF">
					<input type="submit" name="subPay" value="确认缴款"  onclick="return check()"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" value="取消" onclick="location.assign('tms_v1_lugconsign_sellQuery.php');" />
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

