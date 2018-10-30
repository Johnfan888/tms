<?php
//已售车票信息页面

//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$ticketID = $_POST['ticketnum'];
//print_r (explode("\n",$ticketID));
//foreach (explode("\n",$ticketID) as $key =>$ticketIDs){
//	if($ticketIDs!=''){}
//}
/* $strsqlselet="SELECT `st_TicketID`, `st_NoOfRunsID`, `st_LineID`, `st_NoOfRunsdate`, 
		`st_BeginStationTime`, `st_StopStationTime`, `st_Distance`, `st_BeginStationID`, `st_BeginStation`, `st_FromStationID`, 
		`st_FromStation`, `st_ReachStationID`, `st_ReachStation`, `st_EndStationID`, `st_EndStation`, `st_SellPrice`, `st_SellPriceType`, 
		`st_ColleSellPriceType`, `st_TotalMan`, `st_FullPrice`, `st_HalfPrice`, `st_StandardPrice`, `st_BalancePrice`, `st_ServiceFee`, 
		`st_otherFee1`, `st_otherFee2`, `st_otherFee3`, `st_otherFee4`, `st_otherFee5`, `st_otherFee6`, `st_StationID`, `st_Station`, 
		`st_SellDate`, `st_SellTime`, `st_BusModelID`, `st_BusModel`, `st_SeatID`, `st_SellID`, `st_SellName`, `st_FreeSeats`, 
		`st_SafetyTicketID`, `st_SafetyTicketNumber`, `st_SafetyTicketMoney`, `st_SafetyTicketPassengerID`, `st_TicketState`, `st_IsBalance`, 
		`st_BalanceDateTime`, `st_AlterTicket` FROM `tms_sell_SellTicket` WHERE `st_TicketID`='$ticketID'";
$resultselet = $class_mysql_default->my_query("$strsqlselet");
$rows = @mysqli_fetch_array($resultselet); */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>客票信息</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
	<tr>
		<td bgcolor="#4C4C4C"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
		<span class="graytext" style="margin-left:8px;">客票信息</span></td>
	</tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="1">
	<?php 
		$i=0;
		foreach (explode("\n",$ticketID) as $key =>$ticketIDs){
			$i=$i+1;
			if($ticketIDs!=''){
				$ticketIDs=trim($ticketIDs);
				$strsqlselet="SELECT `st_TicketID`, `st_NoOfRunsID`, `st_LineID`, `st_NoOfRunsdate`, 
					`st_BeginStationTime`, `st_StopStationTime`, `st_Distance`, `st_BeginStationID`, `st_BeginStation`, `st_FromStationID`, 
					`st_FromStation`, `st_ReachStationID`, `st_ReachStation`, `st_EndStationID`, `st_EndStation`, `st_SellPrice`, `st_SellPriceType`, 
					`st_ColleSellPriceType`, `st_TotalMan`, `st_FullPrice`, `st_HalfPrice`, `st_StandardPrice`, `st_BalancePrice`, `st_ServiceFee`, 
					`st_otherFee1`, `st_otherFee2`, `st_otherFee3`, `st_otherFee4`, `st_otherFee5`, `st_otherFee6`, `st_StationID`, `st_Station`, 
					`st_SellDate`, `st_SellTime`, `st_BusModelID`, `st_BusModel`, `st_SeatID`, `st_SellID`, `st_SellName`, `st_FreeSeats`, 
					`st_SafetyTicketID`, `st_SafetyTicketNumber`, `st_SafetyTicketMoney`, `st_SafetyTicketPassengerID`, `st_TicketState`, `st_IsBalance`, 
					`st_BalanceDateTime`, `st_AlterTicket` FROM `tms_sell_SellTicket` WHERE `st_TicketID`='$ticketIDs'";
				$resultselet = $class_mysql_default->my_query("$strsqlselet");
				$rows = @mysqli_fetch_array($resultselet);
			}
	?>
	<tr>
		<td colspan="8" bgcolor="#0083B5"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 客票<?php echo $i;?>信息：</td>
	</tr>
	<tr>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 客票号:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="st_TicketID" id="st_TicketID" value="<?php echo $ticketIDs //$rows['st_TicketID']?>" readonly="readonly"/></td>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 班次:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="st_NoOfRunsID" id="st_NoOfRunsID" value="<?php echo $rows['st_NoOfRunsID']?>" readonly="readonly"/></td>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 发车日期:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="st_NoOfRunsdate" id="st_NoOfRunsdate" value="<?php echo $rows['st_NoOfRunsdate']?>" readonly="readonly"/></td>
	</tr>
	<tr>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 发车时间:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="st_BeginStationTime" id="st_BeginStationTime" value="<?php echo $rows['st_BeginStationTime']?>" readonly="readonly"/></td>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 上车站:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="st_FromStation" id="st_FromStation" value="<?php echo $rows['st_FromStation']?>" readonly="readonly"/></td>
    	<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 到达站:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="st_ReachStation" id="st_ReachStation" value="<?php echo $rows['st_ReachStation']?>" readonly="readonly"/></td>
    </tr>
	<tr>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 票价:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="st_SellPrice" id="st_SellPrice" value="<?php echo $rows['st_SellPrice']?>" readonly="readonly"/></td>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 票型:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="st_SellPriceType" id="st_SellPriceType" value="<?php echo $rows['st_SellPriceType']?>" readonly="readonly"/></td>
    	<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 座位号:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="st_SeatID" id="st_SeatID" value="<?php echo $rows['st_SeatID']?>" readonly="readonly"/></td>
    </tr>
    <?php }?>
    <tr>
	    <td colspan="8" align="center" bgcolor="#FFFFFF">
				&nbsp;&nbsp;&nbsp;&nbsp;<input name="returnback" id="returnback" type="button" value="返回" onclick="history.back()" />
	   </td>
	</tr>
</table> 
</form>
</body>
</html>
