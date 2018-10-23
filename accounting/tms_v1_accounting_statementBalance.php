<?php
/*
 * 结算提交页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$statFileName = $_POST['statfile'];
$statData = file_get_contents("$statFileName");
// file may not ready, so wait a while here
while($statData == "") {
	sleep(1);
	$statData = file_get_contents("$statFileName");
}
$statArray=json_decode($statData,true);
//print_r($statArray);
$busID = $statArray[0]['ct_BusID'];
$queryString = "SELECT bi_BusNumber,bi_BusUnit,bi_BusTypeID FROM tms_bd_BusInfo WHERE bi_BusID = '{$busID}'";
$result = $class_mysql_default->my_query("$queryString");
if(!($res=mysql_fetch_array($result))) {
	echo "<script>alert('没有此编号车辆的信息!');</script>";
	exit();
}
else {
	$busNumber = $res['bi_BusNumber'];
	$busUnit = $res['bi_BusUnit'];
	$busTypeID = $res['bi_BusTypeID'];
}

if (isset($_POST['subBalance'])) {
	$ba_BusID = $_POST['ba_BusID'];
	$ba_AccountID = $ba_BusID.time(); 
	$ba_BusNumber = $_POST['ba_BusNumber'];
	$ba_BusType = $_POST['ba_BusType'];
	$ba_BusUnit = $_POST['ba_BusUnit'];
	$ba_BalanceCount = $_POST['ba_BalanceCount'];
	$ba_CheckTotal = $_POST['ba_CheckTotal'];
	$ba_Income = $_POST['ba_Income'];
	$ba_Paid = $_POST['ba_Paid'];
	$ba_ServiceFee = $_POST['ba_ServiceFee'];
	$ba_OtherFee1 = $_POST['ba_OtherFee1'];
	$ba_OtherFee2 = $_POST['ba_OtherFee2'];
	$ba_OtherFee3 = $_POST['ba_OtherFee3'];
	$ba_OtherFee4 = $_POST['ba_OtherFee4'];
	$ba_OtherFee5 = $_POST['ba_OtherFee5'];
	$ba_OtherFee6 = $_POST['ba_OtherFee6'];
	$ba_DateTime = date('Y-m-d H:i:s');
	$ba_UserID = $userID;
	$ba_User = $userName;
	$ba_InStationID = $userStationID;
	$ba_InStation = $userStationName;
	$ba_Remark = $_POST['ba_Remark'];
	
	$class_mysql_default->my_query("BEGIN");
	foreach($statArray as $row) {
		$queryString1 = "INSERT INTO tms_acct_BalanceInHand (bh_BalanceNO, bh_BusID, bh_BusNumber, bh_BusModelID, bh_BusUnit, bh_NoOfRunsID, 
				bh_LineID, bh_NoOfRunsdate, bh_BeginStation, bh_EndStation, bh_ServiceFee, bh_otherFee1, bh_otherFee2, bh_otherFee3, bh_otherFee4, 
				bh_otherFee5, bh_otherFee6, bh_CheckTotal, bh_TicketTotal, bh_PriceTotal, bh_UserID, bh_User, bh_StationID, bh_Station, bh_Date, bh_AccountID, bh_IsAccount) 
				VALUES ('{$row['ct_BalanceNO']}', '{$ba_BusID}', '{$ba_BusNumber}', '{$ba_BusType}', '{$ba_BusUnit}', 
				'{$row['ct_NoOfRunsID']}', '{$row['ct_LineID']}', '{$row['ct_NoOfRunsdate']}', '{$row['ct_BeginStation']}', '{$row['ct_EndStation']}', 
				'{$row['ct_sumServiceFee']}', '{$row['ct_sumOtherFee1']}', '{$row['ct_sumOtherFee2']}', '{$row['ct_sumOtherFee3']}', 
				'{$row['ct_sumOtherFee4']}', '{$row['ct_sumOtherFee5']}', '{$row['ct_sumOtherFee6']}', '{$row['ct_sumPerson']}', 
				'{$row['ct_sumTicket']}', '{$row['ct_sumMoney']}', '{$row['ct_CheckerID']}', '{$row['ct_Checker']}', 
				'{$row['ct_StationID']}', '{$row['ct_Station']}', '{$row['ct_CheckDate']}', '{$ba_AccountID}', '1')";
		$queryString2 = "Update tms_chk_CheckTicket SET ct_IsBalance=1, ct_BalanceDateTime='{$ba_DateTime}' WHERE ct_BalanceNO='{$row['ct_BalanceNO']}'";
		$result1 = $class_mysql_default->my_query("$queryString1");
		$result2 = $class_mysql_default->my_query("$queryString2"); 
		if(!$result1 || !$result2) break;
	} 
	if(!$result1 || !$result2) {
		$class_mysql_default->my_query("ROLLBACK");
		echo "<script>alert('结算单信息提交失败!请重试。');location.assign('tms_v1_accounting_statementQuery.php');</script>";
	}
	$queryString3 = "INSERT INTO tms_acct_BusAccount (ba_AccountID, ba_BusID, ba_BusNumber, ba_BusType, ba_BusUnit, ba_InStationID, ba_InStation, 
				ba_BalanceCount, ba_CheckTotal, ba_Income, ba_Paid, ba_ServiceFee, ba_OtherFee1, ba_OtherFee2, ba_OtherFee3, ba_OtherFee4, 
				ba_OtherFee5, ba_OtherFee6, ba_DateTime, ba_UserID, ba_User, ba_Remark) VALUES ('{$ba_AccountID}', 
				'{$ba_BusID}', '{$ba_BusNumber}', '{$ba_BusType}', '{$ba_BusUnit}', '{$ba_InStationID}', '{$ba_InStation}', '{$ba_BalanceCount}', 
				'{$ba_CheckTotal}', '{$ba_Income}', '{$ba_Paid}', '{$ba_ServiceFee}', '{$ba_OtherFee1}', '{$ba_OtherFee2}', '{$ba_OtherFee3}', 
				'{$ba_OtherFee4}', '{$ba_OtherFee5}', '{$ba_OtherFee6}', '{$ba_DateTime}', '{$ba_UserID}', '{$ba_User}', '{$ba_Remark}')";
	$result3 = $class_mysql_default->my_query("$queryString3"); 
	if($result3) {
		$class_mysql_default->my_query("COMMIT");
		echo "<script>alert('结算信息提交成功!');location.assign('tms_v1_accounting_statementQuery.php');</script>";
	}
	else {
		$class_mysql_default->my_query("ROLLBACK");
		echo "<script>alert('结账单信息提交失败!请重试。');location.assign('tms_v1_accounting_statementQuery.php');</script>";
	}
	$class_mysql_default->my_query("END"); 
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>车辆结算</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../css/style_main.css" type="text/css" rel="stylesheet" />
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
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 结 算 提 交</span></td>
			</tr>
		</table>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
  			<tr>
    			<td colspan="8" bgcolor="#0083B5"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 车 辆 信 息</td>
  			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆编号：</span></td>
				<td><input type="text" name="ba_BusID" value="<?php echo $busID;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
				<td><input type="text" name="ba_BusNumber" value="<?php echo $busNumber;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型：</span></td>
				<td><input type="text" name="ba_BusType" value="<?php echo $busTypeID;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位：</span></td>
				<td><input type="text" name="ba_BusUnit" value="<?php echo $busUnit;?>" readonly="readonly" /></td>
			</tr>
  			<tr>
    			<td colspan="8" bgcolor="#0083B5"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 结 算 信 息</td>
  			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 营收金额：</span></td>
				<td><input type="text" name="ba_Income" value="" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结算金额：</span></td>
				<td><input style="background-color:#F1E6C2" type="text" name="ba_Paid" value="" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结算单数量：</span></td>
				<td ><input type="text" name="ba_BalanceCount" value="<?php echo count($statArray);?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结算员ID：</span></td>
				<td><input type="text" name="ba_UserID" value="<?php echo $userID;?>" readonly="readonly" /></td>
			</tr>
  			<tr>
    			<td colspan="8" bgcolor="#0083B5"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 扣 除 信 息</td>
  			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站务费：</span></td>
				<td><input type="text" name="ba_ServiceFee" value="" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 微机费：</span></td>
				<td><input type="text" name="ba_OtherFee1" value="" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发班费：</span></td>
				<td><input type="text" name="ba_OtherFee2" value="" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 代理费：</span></td>
				<td><input type="text" name="ba_OtherFee3" value="" readonly="readonly" /></td>
			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 费用4：</span></td>
				<td><input type="text" name="ba_OtherFee4" value="" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 费用5：</span></td>
				<td><input type="text" name="ba_OtherFee5" value="" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 费用6：</span></td>
				<td><input type="text" name="ba_OtherFee6" value="" readonly="readonly" /></td>
				<td><input type="hidden" name="ba_CheckTotal" value="" readonly="readonly" /></td>
			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 备注：</span></td>
				<td colspan='7'><input style="width:100%" type="text" name="ba_Remark" value="" size="90"/></td>
			</tr>
  			<tr>
    			<td colspan="8" bgcolor="#0083B5"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 结 算 单 信 息</td>
  			</tr>
 		</table> 
 		<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">			
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算单号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开单员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开单员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车站ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开单时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">线路编号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">始发站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">终点站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">人数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">营收金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">站务费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">微机费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发班费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">代理费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">费用4</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">费用5</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">费用6</th>
			</tr>
			</thead>
		<tbody class="scrollContent">
			<?php
				$ba_Income = 0;
				$ba_ServiceFee = 0; 
				$ba_OtherFee1 = 0; 
				$ba_OtherFee2 = 0;
				$ba_OtherFee3 = 0;
				$ba_OtherFee4 = 0;
				$ba_OtherFee5 = 0;
				$ba_OtherFee6 = 0;
				$ba_CheckTotal = 0;
				$totalBalanceMoney = 0;
				foreach($statArray as $row) {
					$totalBalanceMoney += $row['ct_sumBalancePrice'];
					$ba_Income += $row['ct_sumMoney'];
					$ba_ServiceFee += $row['ct_sumServiceFee']; 
					$ba_OtherFee1 += $row['ct_sumOtherFee1']; 
					$ba_OtherFee2 += $row['ct_sumOtherFee2'];
					$ba_OtherFee3 += $row['ct_sumOtherFee3'];
					$ba_OtherFee4 += $row['ct_sumOtherFee4'];
					$ba_OtherFee5 += $row['ct_sumOtherFee5'];
					$ba_OtherFee6 += $row['ct_sumOtherFee6'];
					$ba_CheckTotal += $row['ct_sumPerson'];
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row['ct_BalanceNO'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_BusID'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_BusNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_CheckerID'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_Checker'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_StationID'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_Station'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_CheckDate'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_NoOfRunsID'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_LineID'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_NoOfRunsdate'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_BeginStation'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_EndStation'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumPerson'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumTicket'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumServiceFee'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumOtherFee1'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumOtherFee2'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumOtherFee3'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumOtherFee4'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumOtherFee5'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumOtherFee6'];?></td>
			</tr>
			<?php
				}
				if($totalBalanceMoney > 0)
					$ba_Paid = $totalBalanceMoney;
				else
					$ba_Paid = $ba_Income - $ba_ServiceFee - $ba_OtherFee1 - $ba_OtherFee2 -$ba_OtherFee3 -$ba_OtherFee4 -$ba_OtherFee5 -$ba_OtherFee6;
			?>
			</tbody>
		</table>
		</div>
		<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
			<tr>
				<td align="center" bgcolor="#FFFFFF">
					<input type="submit" name="subBalance" value="确认结算" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" value="取消" onclick="location.assign('tms_v1_accounting_statementQuery.php');" />
				</td>
			</tr>
		</table>
		<input type="hidden" id="statfile" value="<?php echo $statFileName;?>" name="statfile" />
		</form>
		<script>
			document.form1.ba_Income.value="<?php echo $ba_Income;?>";
			document.form1.ba_Paid.value="<?php echo $ba_Paid;?>";
			document.form1.ba_ServiceFee.value="<?php echo $ba_ServiceFee;?>";
			document.form1.ba_OtherFee1.value="<?php echo $ba_OtherFee1;?>";
			document.form1.ba_OtherFee2.value="<?php echo $ba_OtherFee2;?>";
			document.form1.ba_OtherFee3.value="<?php echo $ba_OtherFee3;?>";
			document.form1.ba_OtherFee4.value="<?php echo $ba_OtherFee4;?>";
			document.form1.ba_OtherFee5.value="<?php echo $ba_OtherFee5;?>";
			document.form1.ba_OtherFee6.value="<?php echo $ba_OtherFee6;?>";
			document.form1.ba_CheckTotal.value="<?php echo $ba_CheckTotal;?>";
		</script>
	</body>
</html>
