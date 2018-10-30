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
		<table style="width:492px;height:266px;margin-left:20px;margin-top:20px;font-size:13px;" border="1">
			<tr>
				<td>
					<div style="margin-top:80px;">
						<div style="margin-left:100px;float:left;"><?php echo "234567"?></div>	
						<div style="margin-left:340px;"><?php echo "234567"?></div>	
					</div>
					<div style="margin-top:25px;">
						<div style="margin-left:110px;float:left"><?php echo "郴州"?><span style="margin-left:20px;"><?php echo "长沙"?></span></div>	
						<div style="margin-left:340px;"><?php echo "郴州"?><span style="margin-left:20px;"><?php echo "长沙"?></span></div>	
					</div>
					<div style="margin-top:10px;">
						<div style="margin-left:110px;float:left"><?php echo "18"?><span style="margin-left:90px;"><?php echo "12"?></span></div>	
						<div style="margin-left:350px;"><?php echo "18"?></div>
					</div>
					<div style="margin-top:6px;">
						<div style="margin-left:110px;float:left"><?php echo "1011021"?><span style="margin-left:60px;"><?php echo "8:00"?></span></div>	
						<div style="margin-left:350px;"><?php echo "1011021"?></div>
					</div>
					<div style="margin-top:6px;">
						<div style="margin-left:130px;float:left"><?php echo "2013-11-10"?></div>	
						<div style="margin-left:350px;"><?php echo "2013-11-10"?></div>	
					</div>
					<div style="margin-top:4px;">
						<div style="margin-left:350px;float:left"><?php echo "12"?></div>	
					</div>
					<div style="margin-top:4px;">
						<div style="margin-left:350px;float:left"><?php echo "admin"?></div>	
					</div>
				</td>
			</tr>
		</table>
	</body>
</html>