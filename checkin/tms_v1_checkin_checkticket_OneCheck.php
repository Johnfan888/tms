<?
//检票界面

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$willcheck="style='display:'";
$checking="style='display:none'";
$checked="style='display:none'";
$printed="style='display:none'";

if (isset($_GET['op']))
{
	$oper=$_GET['op'];
	
	//开始检票
	if($oper=="addbus")
	{
		$NoOfRunsID = $_GET['nrID'];
		$NoOfRunsdate = $_GET['nrDate'];
		$CheckWindow = $_GET['cwID'];
		$isAllTicket = $_GET['allTkt'];
		$BusID = $_GET['busID'];
		$willcheck="style='display:none'";
		$checking="style='display:'";
		$queryString = "SELECT ct_NoOfRunsID FROM tms_chk_CheckTemp WHERE ct_CheckTicketWindow = $CheckWindow AND ct_Flag = '1'";
		$result = $class_mysql_default->my_query("$queryString"); 
		if(mysqli_num_rows($result) == 0) {
			if($isAllTicket == '1')	$strsqlselet = "UPDATE tms_chk_CheckTemp SET ct_Flag = '1' WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID'";
			else					$strsqlselet = "UPDATE tms_chk_CheckTemp SET ct_Flag = '1' WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate'";
			$resultselet = $class_mysql_default->my_query("$strsqlselet");
		}
		else {
			echo "<script>alert('本检票口已有班次在检，完成或撤销后才能开始本班次检票！');</script>";
		}
	}
	
	//取消检票
	if($oper=="cancelbus")
	{
		$NoOfRunsID = $_GET['nrID'];
		$NoOfRunsdate = $_GET['nrDate'];
		$isAllTicket = $_GET['allTkt'];
		$BusID = $_GET['busID'];
		$willcheck="style='display:'";
		$checking="style='display:none'";
		if($isAllTicket == '1') $queryString = "SELECT ctt_TicketID FROM tms_chk_CheckTicketTemp WHERE ctt_NoOfRunsID = '$NoOfRunsID' AND ctt_NoOfRunsdate = '$NoOfRunsdate' AND ctt_BusID = '$BusID'";
		else					$queryString = "SELECT ctt_TicketID FROM tms_chk_CheckTicketTemp WHERE ctt_NoOfRunsID = '$NoOfRunsID' AND ctt_NoOfRunsdate = '$NoOfRunsdate'";
		$result = $class_mysql_default->my_query("$queryString"); 
		if(mysqli_num_rows($result) == 0) {
			if($isAllTicket == '1')	$strsqlselet = "UPDATE tms_chk_CheckTemp SET ct_Flag='0' WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID'";
			else					$strsqlselet = "UPDATE tms_chk_CheckTemp SET ct_Flag='0' WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate'";
			$resultselet = $class_mysql_default->my_query("$strsqlselet");
		}
		else {
			echo "<script>alert('本班次已有检票，不能撤销！');</script>";
			$willcheck="style='display:none'";
			$checking="style='display:'";
		}
	}
	
	//发班
	if($oper=="letgo")
	{
		$NoOfRunsID = $_GET['nrID'];
		$NoOfRunsdate = $_GET['nrDate'];
		$isAllTicket = $_GET['allTkt'];
		$BusID = $_GET['busID'];
		$EndStation=$_GET['eStat'];
		$willcheck="style='display:'";
		$checking="style='display:none'";
		$class_mysql_default->my_query("BEGIN");
		if($isAllTicket == '1') $queryString = "UPDATE tms_sch_Report SET rt_Register='已发车' WHERE rt_NoOfRunsID = '$NoOfRunsID' AND rt_NoOfRunsdate = '$NoOfRunsdate' AND rt_BusID = '$BusID'";
		else 					$queryString = "UPDATE tms_sch_Report SET rt_Register='已发车' WHERE rt_NoOfRunsID = '$NoOfRunsID' AND rt_NoOfRunsdate = '$NoOfRunsdate'";
  		$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			$class_mysql_default->my_query("ROLLBACK");
			echo "<script>alert('更新调度数据失败！');</script>";
		}
		else {
		  	if($isAllTicket == '1') $queryString = "UPDATE tms_chk_CheckTemp SET ct_Flag='2' WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID'";
		  	else					$queryString = "UPDATE tms_chk_CheckTemp SET ct_Flag='2' WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate'";	  	
		  	$result = $class_mysql_default->my_query("$queryString");
			if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('更新检票数据失败！');</script>";
			}
			else {
				$queryString = "UPDATE tms_bd_TicketMode SET tml_AllowSell = '0' WHERE (tml_NoOfRunsID = '$NoOfRunsID')	AND (tml_NoOfRunsdate = '$NoOfRunsdate')";	  	
			  	$result = $class_mysql_default->my_query("$queryString");
				if(!$result) {
					$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('更新票版信息失败！');</script>";
				}
				else {
					$queryString = "INSERT `tms_chk_CheckTicket` (`ct_TicketID`, `ct_NoOfRunsID`, `ct_LineID`, `ct_NoOfRunsdate`, 
						`ct_BeginStationTime`, `ct_StopStationTime`, `ct_Distance`, `ct_BeginStationID`, `ct_BeginStation`, `ct_FromStationID`, 
						`ct_FromStation`, `ct_ReachStationID`, `ct_ReachStation`, `ct_EndStationID`, `ct_EndStation`, `ct_SellPrice`, 
						`ct_SellPriceType`, `ct_ColleSellPriceType`, `ct_TotalMan`, `ct_FullPrice`, `ct_HalfPrice`, `ct_StandardPrice`, 
						`ct_BalancePrice`, `ct_ServiceFee`, `ct_otherFee1`, `ct_otherFee2`, `ct_otherFee3`, `ct_otherFee4`, `ct_otherFee5`, 
						`ct_otherFee6`, `ct_StationID`, `ct_Station`, `ct_SellDate`, `ct_SellTime`, `ct_BusModelID`, `ct_BusModel`, 
						`ct_BusID`,`ct_BusNumber`, `ct_SeatID`, `ct_SellID`, `ct_SellName`, `ct_FreeSeats`, `ct_SafetyTicketID`, 
						`ct_SafetyTicketNumber`,`ct_SafetyTicketMoney`, `ct_SafetyTicketPassengerID`, `ct_CheckTicketWindow`, `ct_CheckerID`, 
						`ct_Checker`, `ct_CheckDate`,`ct_CheckTime`,`ct_BalanceNO`,`ct_IsBalance`,`ct_BalanceDateTime`) 
						SELECT `ctt_TicketID`, `ctt_NoOfRunsID`, `ctt_LineID`, `ctt_NoOfRunsdate`, `ctt_BeginStationTime`, `ctt_StopStationTime`, 
						`ctt_Distance`, `ctt_BeginStationID`, `ctt_BeginStation`, `ctt_FromStationID`, `ctt_FromStation`, `ctt_ReachStationID`, 
						`ctt_ReachStation`, `ctt_EndStationID`, `ctt_EndStation`, `ctt_SellPrice`, `ctt_SellPriceType`, `ctt_ColleSellPriceType`, 
						`ctt_TotalMan`, `ctt_FullPrice`, `ctt_HalfPrice`, `ctt_StandardPrice`, `ctt_BalancePrice`, `ctt_ServiceFee`, 
						`ctt_otherFee1`, `ctt_otherFee2`, `ctt_otherFee3`, `ctt_otherFee4`, `ctt_otherFee5`, `ctt_otherFee6`, `ctt_StationID`, 
						`ctt_Station`, `ctt_SellDate`, `ctt_SellTime`, `ctt_BusModelID`, `ctt_BusModel`, `ctt_BusID`,`ctt_BusNumber`, 
						`ctt_SeatID`, `ctt_SellID`, `ctt_SellName`, `ctt_FreeSeats`, `ctt_SafetyTicketID`, `ctt_SafetyTicketNumber`, 
						`ctt_SafetyTicketMoney`, `ctt_SafetyTicketPassengerID`, `ctt_CheckTicketWindow`, `ctt_CheckerID`, `ctt_Checker`, 
						`ctt_CheckDate`,`ctt_CheckTime`,NULL,0,NULL FROM tms_chk_CheckTicketTemp WHERE (ctt_NoOfRunsID = '$NoOfRunsID') 
						AND (ctt_NoOfRunsdate = '$NoOfRunsdate')";	  	
				  	$result = $class_mysql_default->my_query("$queryString");
					if(!$result) {
						$class_mysql_default->my_query("ROLLBACK");
						echo "<script>alert('添加检票信息失败！');</script>";
					}
					else {
						if($isAllTicket == '1') {
							$queryString = "UPDATE tms_sell_SellTicket SET st_TicketState = '1' WHERE st_TicketID IN (SELECT ctt_TicketID 
										FROM tms_chk_CheckTicketTemp)";	
						  	$result = $class_mysql_default->my_query("$queryString");
							if(!$result) {
								$class_mysql_default->my_query("ROLLBACK");
								echo "<script>alert('更新售票信息失败！');</script>";
							}
							else {
								$queryString = "DELETE FROM tms_chk_CheckTicketTemp";	  	
							  	$result = $class_mysql_default->my_query("$queryString");
								if(!$result) {
									$class_mysql_default->my_query("ROLLBACK");
									echo "<script>alert('删除检票信息失败！');</script>";
								}
								else {
									$class_mysql_default->my_query("COMMIT");
									echo "<script>alert('发车成功！');</script>";
								}
							}							
						}
						else {
							$queryString = "DELETE FROM tms_chk_CheckTicketTemp";	  	
						  	$result = $class_mysql_default->my_query("$queryString");
							if(!$result) {
								$class_mysql_default->my_query("ROLLBACK");
								echo "<script>alert('删除检票信息失败！');</script>";
							}
							else {
								$class_mysql_default->my_query("COMMIT");
								echo "<script>alert('发车成功！');</script>";
							}
						}
					}
				}
			}
		}
		header('Location: tms_v1_checkin_printsheet.php?nrID='.$NoOfRunsID.'&nrDate='.$NoOfRunsdate.'&bID='.$BusID.'&eStat='.$EndStation);
	}
	
	//退检
	if($oper=="cancelcheck")
	{
		$NoOfRunsID = $_GET['nrID'];
		$NoOfRunsdate = $_GET['nrDate'];
		$TicketID=$_GET['tID'];
		$SeatID=$_GET['sID'];
		$isAllTicket = $_GET['allTkt'];
		$willcheck="style='display:none'";
		$checking="style='display:'";
		$BusID = $_GET['busID'];
		
		$class_mysql_default->my_query("BEGIN");
		if($isAllTicket == '1') $queryString = "UPDATE tms_chk_CheckTemp SET ct_CheckedTicketNum = (ct_CheckedTicketNum - 1) WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID'";
		else					$queryString = "UPDATE tms_chk_CheckTemp SET ct_CheckedTicketNum = (ct_CheckedTicketNum - 1) WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate'";
		$result = $class_mysql_default->my_query("$queryString");
	  	if(!$result) {
			$class_mysql_default->my_query("ROLLBACK");
			echo "<script>alert('检票数据更新失败！');</script>";
		}
		else {
			$queryString = "DELETE FROM tms_chk_CheckTicketTemp WHERE ctt_TicketID = '$TicketID'";	  	
			$result = $class_mysql_default->my_query("$queryString");
			if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('删除数据失败！');</script>";
			}
			else {
				if($isAllTicket == '1') {
					$class_mysql_default->my_query("COMMIT");
					//echo "<script>alert('通票退检成功！');</script>";
				}
				else {
					$queryString = "SELECT tml_SeatStatus FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$NoOfRunsID') 
							AND (tml_NoOfRunsdate = '$NoOfRunsdate') FOR UPDATE";
			  		$result = $class_mysql_default->my_query("$queryString");
					if(!$result) {
						$class_mysql_default->my_query("ROLLBACK");
						echo "<script>alert('锁定票版数据表失败！');</script>";
					}
					else {
						$rows = mysqli_fetch_array($result);
						$seatStatus = $rows['tml_SeatStatus'];
						$seatStatus = substr_replace($seatStatus, '3', $SeatID - 1, 1);
					  	$queryString = "UPDATE tms_bd_TicketMode SET tml_SeatStatus = '$seatStatus' WHERE (tml_NoOfRunsID = '$NoOfRunsID') AND (tml_NoOfRunsdate = '$NoOfRunsdate')";
					  	$result = $class_mysql_default->my_query("$queryString");
						if(!$result) {
							$class_mysql_default->my_query("ROLLBACK");
							echo "<script>alert('更新票版数据表失败！');</script>";
						}
						else {
							$class_mysql_default->my_query("COMMIT");
							//echo "<script>alert('退检成功！');</script>";
						}
					}
				}
			}
		}
	}
	
	//删除已打单班次车辆信息
	if($oper=="delbus")
	{
		$NoOfRunsID = $_GET['nrID'];
		$NoOfRunsdate = $_GET['nrDate'];
		$BusID = $_GET['bID'];
		$queryString = "DELETE FROM tms_chk_CheckTemp WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID'";
		$result = $class_mysql_default->my_query("$queryString"); 
		if(!$result) echo "<script>alert('删除失败！');</script>";
	}
	
	//检票后刷新页面
	if($oper=="refresh"){
		$willcheck="style='display:none'";
		$checking="style='display:'";
	}
	
	//查询已检页面
	if($oper=="refreshChecked"){
		$willcheck="style='display:none'";
		$checking="style='display:none'";
		$checked="style='display:'";
	}
}

// auto refresh may not be needed for checkin
$configFileName = "config" . $userID . ".php";
if(!file_exists($configFileName)) {
	$fp = fopen($configFileName, 'w');
	if(!$fp) {
		fclose($fp);
		echo "打开文件\"$configFileName\"失败！";
		exit();
	}
	$retVal = fwrite($fp, "<?\r\n\$checkWindow='';\r\n");
	$retVal = fwrite($fp, "\$checkboxStatus='';\r\n?>");
	if(!$retVal) {
		fclose($fp);
		echo "写入文件\"$configFileName\"失败！";
		exit();
	}
	fclose($fp);
}

require_once("$configFileName");

if($checkboxStatus == "checked")
	$refreshInterval = "300";
else
	$refreshInterval = "72000";

if(isset($_POST['resultquery']))
{
	$checkWindow = $_POST['checkWindow'];
}	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>检票管理</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
<!--  	
	<meta http-equiv="refresh" content="<?php echo $refreshInterval?>;url=tms_v1_checkin_checkticket.php" />
-->
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="../js/tms_v1_tts.js"></script>
	<script type="text/javascript">
		SetVoice();
		SetAudioOutput();
	</script>	
	<script type="text/javascript">
	$(document).ready(function(){
		$("#table1").tablesorter();
		$("#table2").tablesorter();
		$("#table3").tablesorter();
		$("#table1 tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
		$("#table1 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
		$("#table1 tr").click(function(){
			$("#table1 tr:not(this)").css("background-color","#CCCCCC");
			$("#table1 tr:not(this)").mouseover(function(){$(this).css("background-color","#F1E6C2");});
			$("#table1 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$(this).css("background-color","#FFCC00");
			$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
			$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
		});
		$("#table2 tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
		$("#table2 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
		$("#table2 tr").click(function(){
			$("#table2 tr:not(this)").css("background-color","#CCCCCC");
			$("#table2 tr:not(this)").mouseover(function(){$(this).css("background-color","#F1E6C2");});
			$("#table2 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$(this).css("background-color","#FFCC00");
			$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
			$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
		});
		$("#table3 tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
		$("#table3 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
		$("#table3 tr").click(function(){
			$("#table3 tr:not(this)").css("background-color","#CCCCCC");
			$("#table3 tr:not(this)").mouseover(function(){$(this).css("background-color","#F1E6C2");});
			$("#table3 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$(this).css("background-color","#FFCC00");
			$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
			$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
		});
		$("#resultquery").click(function(){
			if (document.getElementById("checkWindowIn").value == "") {
				alert("请输入检票口！");
				$("#checkWindowIn").focus();
				return;
			}
			document.getElementById("checkWindow").value = document.getElementById("checkWindowIn").value;

			// generate configuration file for refresh
			jQuery.get(
				'tms_v1_checkin_dataops.php',
				{'op': 'REFRESH', 'checkWindow': $("#checkWindow").val(), 'checkboxStatus': '',	'configFileName': $("#configFileName").val(), 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						alert(objData.retString);
					}
			});
			/* if($("#isrefresh").attr("checked")) {
				jQuery.get(
					'tms_v1_checkin_dataops.php',
					{'op': 'REFRESH', 'checkWindow': $("#checkWindow").val(), 'checkboxStatus': 'checked', 'configFileName': $("#configFileName").val(), 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL"){ 
							alert(objData.retString);
						}
				});
			}
			else {
				jQuery.get(
					'tms_v1_checkin_dataops.php',
					{'op': 'REFRESH', 'checkWindow': $("#checkWindow").val(), 'checkboxStatus': '',	'configFileName': $("#configFileName").val(), 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL"){ 
							alert(objData.retString);
						}
				});
			}*/
			window.location.href='tms_v1_checkin_checkticket.php?op=norefresh';
		});
		$("#resultquery1").click(function(){
			if (document.getElementById("checkWindowIn").value == "") {
				alert("请输入检票口！");
				$("#checkWindowIn").focus();
				return;
			}
			window.location.href='tms_v1_checkin_checkticket.php?op=refresh';
		});
		$("#resultquery2").click(function(){
			if (document.getElementById("checkWindowIn").value == "") {
				alert("请输入检票口！");
				$("#checkWindowIn").focus();
				return;
			}
			window.location.href='tms_v1_checkin_checkticket.php?op=refreshChecked';
		});
				
		$("#ticketID").focus();
		$("#ticketID").keyup(function(e){
			if(e.keyCode == 13){
				// do nothing at this moment
			}
			else {
				$("#ticketID").val(e.value);
			}
		});
		$("#checkticketconfirm").click(function(){
			if (document.getElementById("ticketID").value == "") {
				alert("票号不能为空！");
				$("#ticketID").focus();
			}
			else {
				jQuery.get(
					'tms_v1_checkin_dataops.php',
					{'op': 'CONFIRMCHECK', 'ticketID': $("#ticketID").val(), 'checkWindow': $("#checkWindow").val(), 'time': Math.random()},
					function(data){
						//alert(data);
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL"){ 
							alert(objData.retString);
						}
						else{
							window.location.href='tms_v1_checkin_checkticket.php?&op=refresh';
						}
				});
			}
		});		
		$("#checkALLconfirm").click(function(){
			if(!confirm("确认全部检票?")) return;
			jQuery.get(
				'tms_v1_checkin_dataops.php',
				{'op': 'CONFIRMCHECKALL', 'checkWindow': $("#checkWindow").val(), 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						alert(objData.retString);
					}
					else{
						alert("全检成功！");
						window.location.href='tms_v1_checkin_checkticket.php?&op=refresh';
					}
			});
		});		
		$("#idbSpeakText").click(function(){
			var str1 = "旅客们请注意：请乘坐";
			var str2 = "     班次开往";
			var str3 = "方向座位号是          ";
			var str4 = "的旅客，赶快到";
			var str5 = "号检票口检票进站，发车时间快到了，请抓紧时间上车！谢谢！";
			jQuery.get(
				'tms_v1_checkin_dataops.php',
				{'op': 'GETPASSENGERINFO', 'checkWindow': $("#checkWindow").val(), 'time': Math.random()},
				function(data){
					//alert(data);
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						alert(objData.retString);
					}
					else{
						var charNoOfRunsID = objData.NoOfRunsID.split("");
						var str = str1 + charNoOfRunsID + str2 + objData.EndStation + str3 + objData.seatStr + str4 + objData.CheckTicketWindow + str5;
						for(var i = 0; i < 3; i++) {
							BeginSpeakText(str);
						}
					}
			});
		});		
		$("#idbStopSpeakText").click(function(){
			StopSpeakText();
		});		
	});
	function openShutManager(oSourceObj,oTargetObj,shutAble,oOpenTip,oShutTip)
	{
		var sourceObj = typeof oSourceObj == "string" ? document.getElementById(oSourceObj) : oSourceObj;
		var targetObj = typeof oTargetObj == "string" ? document.getElementById(oTargetObj) : oTargetObj;
		var openTip = oOpenTip || "";
		var shutTip = oShutTip || "";
		if(targetObj.style.display != "none") {
			if(shutAble) return;
			targetObj.style.display = "none";
			if(openTip  &&  shutTip){
				sourceObj.innerHTML = shutTip;
			}
		} else {
			targetObj.style.display="block";
			if(openTip && shutTip){
				sourceObj.innerHTML = openTip;
			}
		}
	}
	function CleanVoiceObj() {
		delete VoiceObj;
	}
	function dischecking(){
		document.getElementById("willcheck").style.display="none";
		document.getElementById("checking").style.display="";
	}
	</script>
</head>
<body onunload="CleanVoiceObj()">

<!-- 		 
<h1 align="center">  
<textarea id="idTextBox" cols="50" rows="10">Enter text you wish spoken here</textarea>
</h1>

<p align="center">
<strong>Rate&nbsp;</strong>
<strong><input id="idbIncRate" name="button1" type="button" onclick="IncRate()" value="    +    " /></strong>&nbsp;
<strong><input id="idbDecRate" name="button2" type="button" onclick="DecRate()" value="    -    " style="LEFT: 237px; TOP: 292px" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;
		
<strong>Volume&nbsp;</strong> 
<strong><input id="idbIncVol" name="button3" type="button" onclick="IncVol()" value="    +    " style="LEFT:67px; TOP:318px" />&nbsp;</strong>
<strong><input id="idbDecVol" name="button4" type="button" onclick="DecVol()" value="    -    " style="LEFT:134px; TOP:377px" /></strong>
</p>
 
<p align=center>
<strong><input type="button" id="idbSpeakText" onclick="BeginSpeakText('测试字符串');" value="语音广播" style="HEIGHT: 24px; LEFT: 363px; TOP: 332px; WIDTH: 178px" /></strong>
</p>

<p align=center>
<strong><input type="button" id="idbStopSpeakText" onclick="StopSpeakText();" value="停止广播" style="HEIGHT: 24px; LEFT: 363px; TOP: 332px; WIDTH: 178px" /></strong>
</p>
 -->
 
<table width="100%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
	<tr>
		<td bgcolor="#4C4C4C"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
		<span class="graytext" style="margin-left:8px;">检 票 界 面</span></td>
	</tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
	<tr bgcolor="#FFFFFF">
		<td>
			<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 检票口：</span>&nbsp;&nbsp;
			<input type="text" name="checkWindowIn" id="checkWindowIn" value="<?=$checkWindow?>" size="6"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<!--<input id="isrefresh" name="isrefresh" type="checkbox" <?=$checkboxStatus?> /> 自动刷新 -->
			<input type="button" name="resultquery" id="resultquery" value="查询待检班次" />
			<input type="button" name="resultquery1" id="resultquery1" value="查询在检班次" />
			<input type="button" name="resultquery2" id="resultquery2" value="查询已检班次" />
			<input type="hidden" id="checkWindow" name="checkWindow" value="<?php echo $checkWindow?>" />
			<input type="hidden" id="configFileName" name="configFileName" value="<?php echo $configFileName?>" />
		</td>
	</tr>
<?php 
	$nowdate = date("Y-m-d");
	$queryString = "DELETE FROM tms_chk_CheckTemp WHERE ct_Flag = '0'";	//For case of re-reporting after canceling report with bus change 
	$result = $class_mysql_default->my_query("$queryString");
	$queryString = "INSERT IGNORE `tms_chk_CheckTemp` (`ct_NoOfRunsID`, `ct_LineID`, `ct_NoOfRunsdate`, `ct_NoOfRunsTime`, `ct_BusID`, `ct_BusNumber`, 
	 		`ct_EndStation`, `ct_TotalSeats`, `ct_SoldTicketNum`, `ct_Allticket`, `ct_CheckTicketWindow`, `ct_UserID`, `ct_User`,`ct_Flag`) 
	 		SELECT rt_NoOfRunsID, rt_LineID, rt_NoOfRunsdate, tml_NoOfRunstime, rt_BusID, rt_BusCard, tml_Endstation, rt_SeatNum, 
	 		tml_TotalSeats - tml_LeaveSeats - IFNULL(tml_ReserveSeats,0), tml_Allticket, rt_CheckTicketWindow, '$userID', '$userName', '0' 
	 		FROM tms_sch_Report LEFT OUTER JOIN tms_bd_TicketMode ON rt_NoOfRunsID = tml_NoOfRunsID AND rt_NoOfRunsdate = tml_NoOfRunsdate 
	 		WHERE rt_NoOfRunsdate = '$nowdate' AND rt_Register LIKE '未发车'";
	//echo $queryString;
	$result = $class_mysql_default->my_query("$queryString");
	if(!$result) echo "<script>alert('获取待检班次失败！');</script>";
?>	
</table>
</form>
<div id="willcheck" <?php echo $willcheck;?>>		
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder">
		
		<tr>
			<td colspan="11" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 待检班次信息：</td>
		</tr>
	</table>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder" id="table1">
		<thead>
		<tr>
			<td nowrap="nowrap" align="center" bgcolor="#006699">班次</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">线路</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">时间</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">车牌号</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">终点站</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">座位数</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">已售票数</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">是否通票</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">检票口</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">操作</td>
		</tr>
		</thead>
		<tbody>
	<?
		$queryString = "SELECT `ct_NoOfRunsID`, `ct_LineID`, `ct_NoOfRunsdate`, `ct_NoOfRunsTime`, `ct_BusID`, `ct_BusNumber`, 
				`ct_EndStation`, `ct_TotalSeats`, `ct_SoldTicketNum`, `ct_Allticket`, `ct_CheckTicketWindow`, `ct_UserID`, `ct_User`, `ct_Flag`, 
				`li_LineName` FROM tms_chk_CheckTemp LEFT OUTER JOIN tms_bd_LineInfo ON ct_LineID = li_LineID WHERE ct_Flag = '0' AND 
				ct_CheckTicketWindow = '$checkWindow' ORDER BY ct_NoOfRunsTime ASC";
		$result = $class_mysql_default->my_query("$queryString");
	    while($rows = @mysqli_fetch_array($result))
	    {
	?>
		<tr align="center" bgcolor="#CCCCCC">
			<td><?=$rows['ct_NoOfRunsID']?></td>
			<td><?=$rows['li_LineName']?></td>
			<td><?=$rows['ct_NoOfRunsTime']?></td>
			<td><?=$rows['ct_BusID']?></td>
			<td><?=$rows['ct_BusNumber']?></td>
			<td><?=$rows['ct_EndStation']?></td>
			<td><?=$rows['ct_TotalSeats']?></td>
			<td><?=$rows['ct_SoldTicketNum']?></td>
			<td><?($rows['ct_Allticket'] == "1")? print "是" : print "否";?></td>
			<td><?=$rows['ct_CheckTicketWindow']?>
				<input type="hidden" id="NoOfRunsID" value="<?php echo $rows['ct_NoOfRunsID'];?>"/>
				<input type="hidden" id="NoOfRunsdate" value="<?php echo $rows['ct_NoOfRunsdate'];?>"/>
				<input type="hidden" id="ID" value="<?php echo $checkWindow;?>"/>
				<input type="hidden" id="BusID" value="<?php echo $rows['ct_BusID'];?>"/>
				<input type="hidden" id="Allticket" value="<?php echo $rows['ct_Allticket'];?>"/>
			</td>
			<td align="center">[<a href="tms_v1_checkin_checkticket.php?nrID=<?=$rows['ct_NoOfRunsID']?>&nrDate=<?=$rows['ct_NoOfRunsdate']?>&cwID=<?=$checkWindow?>&allTkt=<?=$rows['ct_Allticket']?>&busID=<?=$rows['ct_BusID']?>&op=addbus"]">开始检票</a>]</td>
		</tr>
	<?
		}
	?>
		</tbody>
	</table>
</div>
<div id="checking"  <?php echo $checking;?>>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder">
	  <tr>
	    <td colspan="12" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 在检班次信息：</td>
	  </tr>
	</table>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder" id="table2">
		<thead>
		<tr>
			<td nowrap="nowrap" align="center" bgcolor="#006699">班次</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">线路</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">时间</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">车牌号</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">终点站</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">座位数</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">已售票数</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">已检票数</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">是否通票</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">检票口</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">操作</td>
		</tr>
		</thead>
		<tbody>
	<?
		$queryString = "SELECT `ct_NoOfRunsID`, `ct_LineID`, `ct_NoOfRunsdate`, `ct_NoOfRunsTime`, `ct_BusID`, `ct_BusNumber`, `ct_EndStation`, 
				`ct_TotalSeats`, `ct_SoldTicketNum`, `ct_CheckedTicketNum`, `ct_Allticket`, `ct_CheckTicketWindow`, `ct_UserID`, `ct_User`, 
				`ct_Flag`, `li_LineName` FROM tms_chk_CheckTemp LEFT OUTER JOIN tms_bd_LineInfo ON ct_LineID = li_LineID WHERE ct_Flag = '1' AND 
				ct_CheckTicketWindow = '$checkWindow' ORDER BY ct_NoOfRunsTime ASC";
		$result = $class_mysql_default->my_query("$queryString");
	    if($rows = mysqli_fetch_array($result)) {
	?>
		<tr align="center" bgcolor="#CCCCCC">
			<td><?=$rows['ct_NoOfRunsID']?></td>
			<td><?=$rows['li_LineName']?></td>
			<td><?=$rows['ct_NoOfRunsTime']?></td>
			<td><?=$rows['ct_BusID']?></td>
			<td><?=$rows['ct_BusNumber']?></td>
			<td><?=$rows['ct_EndStation']?></td>
			<td><?=$rows['ct_TotalSeats']?></td>
			<td><?=$rows['ct_SoldTicketNum']?></td>
			<td><?=$rows['ct_CheckedTicketNum']?></td>
			<td><?($rows['ct_Allticket'] == "1")? print "是" : print "否";?></td>
			<td><?=$rows['ct_CheckTicketWindow']?></td>
			<td align="center">
		<?
			$frameID = $rows['ct_NoOfRunsID'];
			if ($rows['ct_Allticket'] == "0"){
		?>
		<!-- 
				[<a href="#" onclick="openShutManager(this,'<?=$frameID?>',false,'座位预览关闭','座位预览展开')"]">座位预览展开</a>]
		-->
		<?php }?>	
		    	[<a href="tms_v1_checkin_checkticket.php?nrID=<?=$rows['ct_NoOfRunsID']?>&nrDate=<?=$rows['ct_NoOfRunsdate']?>&allTkt=<?=$rows['ct_Allticket']?>&busID=<?=$rows['ct_BusID']?>&op=cancelbus">取消检票</a>]
		    	[<a href="tms_v1_checkin_checkticket.php?nrID=<?=$rows['ct_NoOfRunsID']?>&nrDate=<?=$rows['ct_NoOfRunsdate']?>&allTkt=<?=$rows['ct_Allticket']?>&busID=<?=$rows['ct_BusID']?>&eStat=<?=$rows['ct_EndStation']?>&op=letgo">发班</a>]
		    </td>
		</tr>
	<!--  	  	
		<tr bgcolor="#CCCCCC">
			<td colspan="12">
				<div id="<?=$frameID?>" style="display:none">
					<iframe frameborder="1" id="heads" width="100%" src="../sell/tms_v1_sell_seatview.php?nrID=<?=$rows['ct_NoOfRunsID']?>&nrDate=<?=$rows['ct_NoOfRunsdate']?>"></iframe>
				</div>
			</td>
		</tr>
	-->
	<?php }?>
		</tbody>
	</table>
	<table width="100%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
		<tr bgcolor="#FFFFFF">
			<td>
				<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 票号：</span>&nbsp;&nbsp;
				<input type="text" name="ticketID" id="ticketID" value="" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="checkticketconfirm" id="checkticketconfirm" value="票号检票确认" />
		<!-- 		
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="checkALLconfirm" id="checkALLconfirm" value="全检确认" />
		 -->
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="idbSpeakText" value="语音广播" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="idbStopSpeakText" value="停止广播" />
			</td>
		</tr>
		<tr bgcolor="#CCCCCC">
			<td colspan="12">
				<div id="<?=$frameID?>">
					<iframe frameborder="1" id="heads" width="100%" src="../sell/tms_v1_sell_seatview.php?nrID=<?=$rows['ct_NoOfRunsID']?>&nrDate=<?=$rows['ct_NoOfRunsdate']?>"></iframe>
				</div>
			</td>
		</tr>
	</table>

	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder" id="table3">
	<tr>
		<td width="5%" align="center" bgcolor="#006699">票号</td>
		<td width="10%" align="center" bgcolor="#006699">到站</td>
		<td width="10%" align="center" bgcolor="#006699">售价</td>
		<td width="10%" align="center" bgcolor="#006699">票型</td>
		<td width="5%" align="center" bgcolor="#006699">座号</td>
		<td width="15%" align="center" bgcolor="#006699">售票车站</td>
		<td width="15%" align="center" bgcolor="#006699">检票时间</td>
		<td width="10%" align="center" bgcolor="#006699">检票员</td>
		<td width="15%" align="center" bgcolor="#006699">操作</td>
	</tr>
	<?
		$strsqlselet = "SELECT tms_chk_CheckTicketTemp.ctt_TicketID,tms_chk_CheckTicketTemp.ctt_ReachStation,tms_chk_CheckTicketTemp.ctt_SellPrice,
					tms_chk_CheckTicketTemp.ctt_SellPriceType,tms_chk_CheckTicketTemp.ctt_SeatID,tms_chk_CheckTicketTemp.ctt_NoOfRunsID,
					tms_chk_CheckTicketTemp.ctt_NoOfRunsdate,tms_chk_CheckTicketTemp.ctt_BusID,tms_chk_CheckTicketTemp.ctt_CheckDate,
					tms_chk_CheckTicketTemp.ctt_CheckTime,tms_sell_SellTicket.st_Station FROM tms_chk_CheckTicketTemp,
					tms_sell_SellTicket WHERE tms_chk_CheckTicketTemp.ctt_TicketID=tms_sell_SellTicket.st_TicketID 
					AND tms_chk_CheckTicketTemp.ctt_CheckTicketWindow = '$checkWindow'";
		$resultselet = $class_mysql_default->my_query("$strsqlselet");
		while($rows2 = mysqli_fetch_array($resultselet)) {
	?>
	<tr align="center" bgcolor="#CCCCCC">
		<td><?=$rows2['ctt_TicketID']?></td>
		<td><?=$rows2['ctt_ReachStation']?></td>
		<td><?=$rows2['ctt_SellPrice']?></td>
		<td><?=$rows2['ctt_SellPriceType']?></td>
		<td><?($rows['ct_Allticket'] == "1")? print "XX" : print $rows2['ctt_SeatID'];?></td>
		<td><?=$rows2['st_Station']?></td>
		<td><?=$rows2['ctt_CheckDate']."  ".$rows2['ctt_CheckTime']?></td>
		<td><?=$userID?></td>
		<td align="center">[<a href="tms_v1_checkin_checkticket.php?nrID=<?=$rows2['ctt_NoOfRunsID']?>&nrDate=<?=$rows2['ctt_NoOfRunsdate']?>&tID=<?=$rows2['ctt_TicketID']?>&sID=<?=$rows2['ctt_SeatID']?>&allTkt=<?=$rows['ct_Allticket']?>&busID=<?=$rows2['ctt_BusID']?>&op=cancelcheck">退检</a>]</td>
	</tr>
	<?
		}
	?>
	</table>
</div>
<div id="checked" <?php echo $checked;?>>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder">
	<tr>
		<td colspan="13" bgcolor="#FF821C"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 已检班次信息：</td>
	</tr>
	</table>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder" id="table4">
		<thead>
		<tr>
			<td nowrap="nowrap" align="center" bgcolor="#006699">班次</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">线路</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">日期</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">时间</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">车牌号</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">终点站</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">座位数</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">已售票数</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">已检票数</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">是否通票</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">检票口</td>
		<!-- <td nowrap="nowrap" align="center" bgcolor="#006699">操作</td>  -->	
		</tr>
		</thead>
		<tbody>
	<?
		$queryString = "SELECT `ct_NoOfRunsID`, `ct_LineID`, `ct_NoOfRunsdate`, `ct_NoOfRunsTime`, `ct_BusID`, `ct_BusNumber`, `ct_EndStation`, 
				`ct_TotalSeats`, `ct_SoldTicketNum`, `ct_CheckedTicketNum`, `ct_Allticket`, `ct_CheckTicketWindow`, `ct_UserID`, `ct_User`, 
				`ct_Flag`, `li_LineName` FROM tms_chk_CheckTemp LEFT OUTER JOIN tms_bd_LineInfo ON ct_LineID = li_LineID WHERE ct_Flag = '2' AND 
				ct_CheckTicketWindow = '$checkWindow' ORDER BY ct_NoOfRunsTime ASC";
		$result = $class_mysql_default->my_query("$queryString");
	    while($rows = @mysqli_fetch_array($result)) {
	?>
		<tr align="center" bgcolor="#CCCCCC">
			<td><?=$rows['ct_NoOfRunsID']?></td>
			<td><?=$rows['li_LineName']?></td>
			<td><?=$rows['ct_NoOfRunsdate']?></td>
			<td><?=$rows['ct_NoOfRunsTime']?></td>
			<td><?=$rows['ct_BusID']?></td>
			<td><?=$rows['ct_BusNumber']?></td>
			<td><?=$rows['ct_EndStation']?></td>
			<td><?=$rows['ct_TotalSeats']?></td>
			<td><?=$rows['ct_SoldTicketNum']?></td>
			<td><?=$rows['ct_CheckedTicketNum']?></td>
			<td><?($rows['ct_Allticket'] == "1")? print "是" : print "否";?></td>
			<td><?=$rows['ct_CheckTicketWindow']?></td>
		<!--  
			<td align="center">
		<?
			$frameID = $rows['ct_NoOfRunsID'];
			if ($rows['ct_Allticket'] == "0"){
		?>
				[<a href="#" onclick="openShutManager(this,'<?=$frameID?>',false,'座位预览关闭','座位预览展开')"]">座位预览展开</a>]
		<?php }?>	
		    	[<a href="tms_v1_checkin_printsheet.php?nrID=<?=$rows['ct_NoOfRunsID']?>&nrDate=<?=$rows['ct_NoOfRunsdate']?>&bID=<?=$rows['ct_BusID']?>&eStat=<?=$rows['ct_EndStation']?>">打印结算单</a>]
		    </td>
		-->
		</tr>
		<tr bgcolor="#CCCCCC">
			<td colspan="13">
				<div id="<?=$frameID?>" style="display:none">
					<iframe frameborder="1" id="heads" width="100% "src="../sell/tms_v1_sell_seatview.php?nrID=<?=$rows['ct_NoOfRunsID']?>&nrDate=<?=$rows['ct_NoOfRunsdate']?>"></iframe>
				</div>
			</td>
		</tr>
	<?php 
	    }
	?>
		</tbody>
	</table>
</div>
<br />
<div id="printed" <?php echo $printed;?>>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder">
	<tr>
		<td colspan="13" bgcolor="#F1E6C2"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 已打结算单班次信息：</td>
	</tr>
	</table>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder" id="table5">
		<thead>
		<tr>
			<td nowrap="nowrap" align="center" bgcolor="#006699">班次</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">线路</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">日期</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">时间</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">车牌号</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">终点站</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">座位数</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">已售票数</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">已检票数</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">是否通票</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">检票口</td>
			<td nowrap="nowrap" align="center" bgcolor="#006699">操作</td>
		</tr>
		</thead>
		<tbody>
	<?
		$queryString = "SELECT `ct_NoOfRunsID`, `ct_LineID`, `ct_NoOfRunsdate`, `ct_NoOfRunsTime`, `ct_BusID`, `ct_BusNumber`, `ct_EndStation`, 
				`ct_TotalSeats`, `ct_SoldTicketNum`, `ct_CheckedTicketNum`, `ct_Allticket`, `ct_CheckTicketWindow`, `ct_UserID`, `ct_User`, 
				`ct_Flag`, `li_LineName` FROM tms_chk_CheckTemp LEFT OUTER JOIN tms_bd_LineInfo ON ct_LineID = li_LineID WHERE ct_Flag = '3' AND 
				ct_CheckTicketWindow = '$checkWindow' ORDER BY ct_NoOfRunsTime ASC";
		$result = $class_mysql_default->my_query("$queryString");
	    while($rows = @mysqli_fetch_array($result)) {
	?>
		<tr align="center" bgcolor="#CCCCCC">
			<td><?=$rows['ct_NoOfRunsID']?></td>
			<td><?=$rows['li_LineName']?></td>
			<td><?=$rows['ct_NoOfRunsdate']?></td>
			<td><?=$rows['ct_NoOfRunsTime']?></td>
			<td><?=$rows['ct_BusID']?></td>
			<td><?=$rows['ct_BusNumber']?></td>
			<td><?=$rows['ct_EndStation']?></td>
			<td><?=$rows['ct_TotalSeats']?></td>
			<td><?=$rows['ct_SoldTicketNum']?></td>
			<td><?=$rows['ct_CheckedTicketNum']?></td>
			<td><?($rows['ct_Allticket'] == "1")? print "是" : print "否";?></td>
			<td><?=$rows['ct_CheckTicketWindow']?></td>
			<td align="center">
		<?
			$frameID = $rows['ct_NoOfRunsID'];
			if ($rows['ct_Allticket'] == "0"){
		?>
				[<a href="#" onclick="openShutManager(this,'<?=$frameID?>',false,'座位预览关闭','座位预览展开')"]">座位预览展开</a>]
		<?php }?>	
		    	[<a href="tms_v1_checkin_printsheet.php?nrID=<?=$rows['ct_NoOfRunsID']?>&nrDate=<?=$rows['ct_NoOfRunsdate']?>&bID=<?=$rows['ct_BusID']?>&eStat=<?=$rows['ct_EndStation']?>">重打结算单</a>]
		    	[<a href="tms_v1_checkin_checkticket.php?nrID=<?=$rows['ct_NoOfRunsID']?>&nrDate=<?=$rows['ct_NoOfRunsdate']?>&bID=<?=$rows['ct_BusID']?>&op=delbus">删除</a>]
		    </td>
		</tr>
		<tr bgcolor="#CCCCCC">
			<td colspan="13">
				<div id="<?=$frameID?>" style="display:none">
					<iframe frameborder="1" id="heads" width="100% "src="../sell/tms_v1_sell_seatview.php?nrID=<?=$rows['ct_NoOfRunsID']?>&nrDate=<?=$rows['ct_NoOfRunsdate']?>"></iframe>
				</div>
			</td>
		</tr>
	<?php 
	    }
	?>
		</tbody>
	</table>
</div>
</body>
</html>