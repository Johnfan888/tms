<?php
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$op = $_REQUEST['op'];
$TicketID = $_REQUEST['TicketID'];
$FromStation = $_REQUEST['FromStation'];
$ReachStation = $_REQUEST['ReachStation'];
$SellPrice = $_REQUEST['SellPrice'];
$SeatID = $_REQUEST['SeatID'];
$NoOfRunsID = $_REQUEST['NoOfRunsID'];
$BeginStationTime = $_REQUEST['BeginStationTime'];		
$NoOfRunsdate = $_REQUEST['NoOfRunsdate'];
$safetyTicketID = $_REQUEST['safetyTicketID'];
$SafetyTicketMoney = $_REQUEST['SafetyTicketMoney'];
$CheckTicketWindow = $_REQUEST['CheckTicketWindow'];
$SellerID = $_REQUEST['SellerID'];
//通票处理
$isAllTicket = $_REQUEST['isAllTicket'];
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	</head>
	<body>
		<table style="width:492px;height:266px;margin-left:0px;margin-top:0px;font-size:13px;" border="1">
			<tr>
				<td>
					<div style="margin-top:80px;">
						<div style="margin-left:100px;float:left;">票号:<?php echo "234567"?></div>	
						<div style="margin-left:340px;">票号:<?php echo "234567"?></div>	
					</div>
					<div style="margin-top:25px;">
						<div style="margin-left:110px;float:left"><?php echo "郴州"?>&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "长沙"?></div>	
						<div style="margin-left:340px;"><?php echo "郴州"?>&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;<?php echo "长沙"?></div>	
					</div>
					<div style="margin-top:10px;">
						<div style="margin-left:90px;float:left">票价:&nbsp;&nbsp;&nbsp;<?php echo "18"?><span style="margin-left:40px;">座位:&nbsp;&nbsp;&nbsp;<?php echo "12"?></span></div>	
						<div style="margin-left:340px;">票价:&nbsp;&nbsp;&nbsp;<?php echo "18"?></div>
					</div>
					<div style="margin-top:6px;">
						<div style="margin-left:90px;float:left">车次:<?php echo "1011021"?><span style="margin-left:30px;">时间:&nbsp;&nbsp;&nbsp;<?php echo "8:00"?></span></div>	
						<div style="margin-left:340px;">车次:&nbsp;&nbsp;&nbsp;<?php echo "1011021"?></div>
					</div>
					<div style="margin-top:6px;">
						<div style="margin-left:80px;float:left">乘车日期:&nbsp;&nbsp;&nbsp;<?php echo "2013-11-10"?></div>	
						<div style="margin-left:340px;">日期:&nbsp;&nbsp;&nbsp;<?php echo "2013-11-10"?></div>	
					</div>
					<div style="margin-top:4px;">
						<div style="margin-left:340px;float:left">座位:&nbsp;&nbsp;&nbsp;<?php echo "12"?></div>	
					</div>
					<div style="margin-top:4px;">
						<div style="margin-left:340px;float:left">工号:&nbsp;&nbsp;&nbsp;<?php echo "admin"?></div>	
					</div>
				</td>
			</tr>
		</table>
	</body>
</html>