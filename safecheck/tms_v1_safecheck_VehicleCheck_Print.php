<?php

// 纸张大小191(左右纸孔宽均为12)*93mm (1英寸=2.54cm=25.4mm=96px)

define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$sc_BusID = trim($_GET['busid']);
$sc_CheckDate = trim($_GET['chkDate']);
$queryString = "SELECT sc_BusCard,sc_StationName,sc_UserID,sc_Result,sc_CheckDate,sc_Item1,sc_Item2,sc_Item3,sc_Item4,sc_Item5,sc_Item6,sc_Item7,sc_Item8,
	sc_Item9,sc_Item10,bi_ManagementLine FROM tms_sf_SafetyCheck LEFT OUTER JOIN tms_bd_BusInfo ON sc_BusID=bi_BusID WHERE sc_BusID='{$sc_BusID}' AND sc_CheckDate='{$sc_CheckDate}'";
$result = $class_mysql_default->my_query("$queryString");
$row = mysqli_fetch_array($result);
$selectTicketProvide="SELECT tp_CurrentTicket,tp_Type FROM tms_bd_TicketProvide WHERE tp_InceptUserID='{$row['sc_UserID']}' AND tp_Type='安检单' AND tp_InceptTicketNum>'0'";
$resultTicketProvide = $class_mysql_default->my_query("$selectTicketProvide");
$rowTicketProvide= mysqli_fetch_array($resultTicketProvide);
if (empty($rowTicketProvide[0])) {
	echo "<script>if (!confirm('没有可用的安检单票据！是否继续？')) location.assign('tms_v1_safecheck_VehicleCheck.php');</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/tms_v1_print.js"></script>
		<script language="Javascript">
		function printResult()
		{
			var Wsh = new ActiveXObject("WScript.Shell");
			printPageSetup(Wsh);
			document.body.insertAdjacentHTML("beforeEnd","<object id=\"printWB\" width=0 height=0 classid=\"clsid:8856F961-340A-11D0-A96B-00C04FD705A2\">");
			printWB.ExecWB(6,2);
			location.assign("tms_v1_safecheck_VehicleCheck.php");
		}
		</script>
	</head>
	<body>
		<table style="width:600px;height:351px;margin-left:75px;margin-top:-25px;font-size:16px;" align="center" border="0">
			<tr>
				<td>
					<div style="margin-top:0px;">
						<div style="margin-left:75px;float:left;"><?php echo $row['sc_StationName'].'.';?></div>	
						<div style="margin-left:500px;"><?php echo $rowTicketProvide['tp_CurrentTicket'].'.';?></div>	
					</div>
					<div style="margin-top:15px;">
						<div style="margin-left:120px;float:left"><?php echo $row['sc_BusCard'].'.';?></div>	
						<div style="margin-left:440px;"><?php echo $row['bi_ManagementLine'].'.';?></div>	
					</div>
					<div style="margin-top:20px;">
						<div style="margin-left:120px;float:left"><?php echo $row['sc_UserID'].'.';?></div>	
						<div style="margin-left:440px;"><?php echo $row['sc_CheckDate'].'.';?></div>
					</div>
					<div style="margin-top:20px;">
						<div style="margin-left:120px;float:left">
							<?php 
								if($row['sc_Result']=='检验合格'){
									echo $row['sc_Result'].'.';
								}else{
									echo $row['sc_Item1'].$row['sc_Item2'].$row['sc_Item3'].$row['sc_Item4'].$row['sc_Item5'].$row['sc_Item6'].$row['sc_Item7'].$row['sc_Item8'].$row['sc_Item9'].$row['sc_Item10'].'.';
								}
							?>
						</div>	
						<div style="margin-left:240px;">&nbsp;</div>	
					</div>
					<div style="margin-top:10px;">
						<div style="margin-left:80px;float:left">&nbsp;</div>	
						<div style="margin-left:240px;">&nbsp;</div>	
					</div>
					<div style="margin-top:30px;">
						<div style="margin-left:80px;float:left">&nbsp;</div>	
						<div style="margin-left:240px;">&nbsp;</div>	
					</div>
				</td>
			</tr>
		</table>
		<script>
			printResult();
		</script>
	</body>
</html>
