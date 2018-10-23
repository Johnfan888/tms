﻿<?
/*
 *  	
 * 票版座位状态：0-可售；1-锁定待售；2-预留（电话订票；班次预留现在不用）；3-已售；4-已检；5-网上预订（未支付）；6-网上订票已支付；
 *  
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

require_once("tms_v1_sell_sellprintdata.php");
require_once("tms_v1_sell_insureprintdata.php");
require_once("tms_v1_sell_getPrinterName.php");

//if($userGroupID == "2")	require_once("../ui/user/topnoleft.inc.php");	//for seller

$seller = $userName;
$sellerID = $userID;
$sellerStation = $userStationName;

$tnum = 1;
$htnum = 0;
$safeTicketMoney = 0;
$safeUserIDCard = "";
$safeUserIDCards = "";
$safeUsers = "";
$safeUserAddresses = "";
$readonly = "";
$viewenable = "";
$subcancelenable = "disabled";

if (isset($_POST['fromstation'])) {
	$noofrunsID = $_POST['noofrun'];
	$norunsdate = $_POST['departuredate'];
	$fromplace = $_POST['fromstation'];
	$reachplace = $_POST['reachstation'];
	$norunstime = $_POST['departuretime'];
	$tnum = $_POST['fullTicketNumIn'];
	$htnum = $_POST['halfTicketNumIn'];
	$curTicketID = $_POST['curTicketID'];
	$newTicketID = $_POST['newTicketID'];
	$curSafeTicketID = $_POST['curSafeTicketID'];
	$newSafeTicketID = $_POST['newSafeTicketID'];
	$safeTicketMoney = $_POST['safeTicketMoney'];
	$safeUserIDCard = $_POST['safeUserIDCardIn'];
	$safeUserIDCards = $_POST['safeUserIDCards'];
	$safeUsers = $_POST['safeUsers'];
	$safeUserAddresses = $_POST['safeUserAddresses'];
	$leftTicketNum = $_POST['leftTicketIDNum'];
	$leftSafeTicketNum = $_POST['leftSafeTicketIDNum'];
	$fullPrice = $_POST['fullPrice'];
	$busModel = $_POST['busModel'];
	$isAllTicket = $_POST['isAllTicket'];
	$remainMoney = $_POST['remainMoney'];
	if(($tnum + $htnum) == 0) { // cancel selling
		$leftseats = $_POST['leftseats'];
		$lefthalfseats = $_POST['lefthalfseats'];
	}	
	else {	// sell viewing
		//set element attribute
		$readonly = "readonly";
		$viewenable = "disabled";
		$subcancelenable = "";
		
	  	//取得座位号
		//$strsqlselet = "LOCK TABLES tms_bd_TicketMode WRITE";
	  	//$strsqlselet = "SELECT tml_SeatStatus, tml_LeaveSeats FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$noofrunsID') AND (tml_NoOfRunsdate = '$norunsdate') LOCK IN SHARE MODE";
	  	$strsqlselet = "SELECT tml_SeatStatus, tml_LeaveSeats, tml_LeaveHalfSeats FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$noofrunsID') 
	  				AND (tml_NoOfRunsdate = '$norunsdate') FOR UPDATE";
	  	$class_mysql_default->my_query("BEGIN");
	  	$resultselet = $class_mysql_default->my_query("$strsqlselet");
	  	$rows = @mysql_fetch_array($resultselet);
	  	for($i = 0; $i < $tnum + $htnum; $i++) {
	  		$array[$i] = strpos($rows[0], '0');
	  		$rows[0] = substr_replace($rows[0], '1', $array[$i], 1);
			if ($i == 0) {
	  			$seatno = $seatno . $array[$i];
	  		} else {
	  			$seatno = $seatno . ',' . $array[$i];
	  		}
	  	} 
		$rows[1] = $rows[1] - ($tnum + $htnum); 
		$rows[2] = $rows[2] - $htnum;
		$strsqlselet = "UPDATE tms_bd_TicketMode SET tml_SeatStatus = '$rows[0]', tml_LeaveSeats = '$rows[1]', tml_LeaveHalfSeats = '$rows[2]' 
					 WHERE (tml_NoOfRunsID = '$noofrunsID') AND (tml_NoOfRunsdate = '$norunsdate')";
	  	$resultselet = $class_mysql_default->my_query("$strsqlselet");
		if($resultselet) {
			$class_mysql_default->my_query("COMMIT");
			$leftseats = $rows[1];
			$lefthalfseats = $rows[2];
		}
		else {
			$class_mysql_default->my_query("ROLLBACK");
			echo "<script>alert('获取座位失败！');history.back();</script>";
		}
		//$class_mysql_default->my_query("UNLOCK TABLES");
	}
}
else {
	$noofrunsID = $_GET['i'];
	$norunsdate = $_GET['d'];
	$fromplace = $_GET['f'];
	$reachplace = $_GET['r'];
	$norunstime = $_GET['t'];
	$leftseats = $_GET['l'];
	$lefthalfseats = $_GET['h'];
	$fullPrice = $_GET['p'];
	$busModel = $_GET['m'];
	$isAllTicket = $_GET['a'];
	$remainMoney = $_GET['rm'];
	if(empty($noofrunsID) || empty($norunsdate) || empty($fromplace) || empty($reachplace)) 
		echo "<script>alert('班次、日期、发车站和到达站不能为空！');history.back();</script>";
		
	//取得客票号
	$strsqlselet = "SELECT `tp_CurrentTicket`,`tp_InceptTicketNum` FROM `tms_bd_TicketProvide` WHERE `tp_InceptUserID` = '$sellerID'
				AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '客票' ORDER BY tp_ProvideData ASC";
	$resultselet = $class_mysql_default->my_query("$strsqlselet");
	$rows = @mysql_fetch_array($resultselet);
	if (empty($rows[0])) {
		echo "<script>if (!confirm('没有可用的客票票据！是否继续？')) location.assign('tms_v1_sell_query.php');</script>";
		$curTicketID = "";
		$newTicketID = "";
		$leftTicketNum = 0;
	} else {
		$curTicketID = $rows[0];
		$newTicketID = $rows[0];
		$leftTicketNum = $rows[1];
	}
	
	//取得保险票号
	$strsqlselet = "SELECT `tp_CurrentTicket`,`tp_InceptTicketNum` FROM `tms_bd_TicketProvide` WHERE `tp_InceptUserID` = '$sellerID'
				AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '保险票' ORDER BY tp_ProvideData ASC";
	$resultselet = $class_mysql_default->my_query("$strsqlselet");
	$rows = @mysql_fetch_array($resultselet);
	if (empty($rows[0])) {
		echo "<script>if (!confirm('没有可用的保险票据！是否继续？')) location.assign('tms_v1_sell_query.php');</script>";
		$curSafeTicketID = "";
		$newSafeTicketID = "";
		$leftSafeTicketNum = 0;
	} else {
		$curSafeTicketID = $rows[0];	
		$newSafeTicketID = $rows[0];
		$leftSafeTicketNum = $rows[1];
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>售票预览</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<object id="CardReader1" codebase="FirstActivex.cab#version=1,0,3,1" classid="CLSID:F225795B-A882-4FBA-934C-805E1B2FBD1B">
		<param name="_Version" value="65536"/>
		<param name="_ExtentX" value="2646"/>
		<param name="_ExtentY" value="1323"/>
		<param name="_StockProps" value="0"/>
		<param name="port" value="USB"/>
		<param name="PhotoPath" value=""/>
		<param name="ActivityLFrom" value=""/>
		<param name="ActivityLTo" value="" />
	</object>
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/tms_v1_print.js"></script>
	<script language="javascript">
	function Init()
	{
		var obj = document.getElementById("CardReader1");
	//设置端口号，1表示串口1，2表示串口2，依此类推；1001表示USB，依此类推。
		obj.setPortNum(1001);
	}
	function readCard()
	{
		var obj = document.getElementById("CardReader1");
	//读卡
		var rst = obj.ReadCard();
	//获取各项信息
		document.getElementById("safeUserIDCardIn").value  = obj.CardNo();
		document.getElementById("safeUser").value  = obj.NameL();
		document.getElementById("safeUserAddress").value = obj.Address();
	}
	
	function isnumber(number){
		if(isNaN(number)){
			alert(number+"不是数字！");
			document.getElementById("fullTicketNumIn").value="";
			return false;
		}
		if(document.getElementById("fullTicketNumIn").value!=""){
			if(parseInt(number)!=number){
				alert("请输入整数");
				document.getElementById("fullTicketNumIn").value="";
			}
			return false;
		}
	}
	function isnumber1(number){
		if(isNaN(number)){
			alert(number+"不是数字！");
			document.getElementById("halfTicketNumIn").value="";
			return false;
		}
		if(document.getElementById("halfTicketNumIn").value!=""){
			if(parseInt(number)!=number){
				alert("请输入整数");
				document.getElementById("halfTicketNumIn").value="";
			}
			return false;
		}
	}

	function checkcertificatenumber(certificatenumber){
		var str=certificatenumber;
		var Expression=/^(\d{18,18}|\d{15,15}|\d{17,17}[xX])$/;
		if(Expression.test(str)==true){
			return true;
		}else {
			return false;
		}
	}
	
	function selectSeat(thisTD)
	{
		if(document.getElementById("newSeatno") == null) {
			var curSeatno = $(thisTD).text();
			$(thisTD).html("<input type='text' id='newSeatno' size='2' value='" + curSeatno + "' style='text-align:center;height:18;border:none' onfocus='this.select()'/>");
			document.getElementById("newSeatno").focus();
			document.getElementById("newSeatno").onkeyup = function(event) {
	            var e = event || window.event || arguments.callee.caller.arguments[0];
	            if (e && e.keyCode == 13) {
					$.ajax({
						type : "get",
						url : "tms_v1_sell_sell.php",
						data : {'op': 'changeSeatNo', 'NoOfRunsID': $("#noofrun").val(), 'NoOfRunsdate': $("#departuredate").val(), 
							'curSeatno': curSeatno, 'newSeatno': $("#newSeatno").val(), 'time': Math.random()},
						async : false,
						success : function(data){
							var objData = eval('(' + data + ')');
							if(objData.retVal == "FAIL"){ 
								alert(objData.retString);
								$("#newSeatno").focus();
							}
							else{
								$("#newSeatno").css("display","none");
								//$(thisTD).html("");
								$(thisTD).text(objData.newSeatno);
								var seatArray = $("#seatNo").val().split(",");
								for(var i = 0; i <  seatArray.length; i++) {
									if(seatArray[i] == (curSeatno - 1)) {
										seatArray[i] = (objData.newSeatno - 1);
										i = seatArray.length;
									}
								}
								$("#seatNo").val(seatArray.join(","));
								window.frames("seatview").location.reload();
								$("#getticketmoney").focus();
							}
						}
					}); 
	            }
	            if (e && e.keyCode == 27) {	//ESC
					$("#newSeatno").css("display","none");
					//$(thisTD).html("");
					$(thisTD).text(curSeatno);
					$("#getticketmoney").focus();
	            }	            
	        };
        }
		else {
			document.getElementById("newSeatno").focus();
		}
	}
	
	function printTicket(objData, PrintTicket)
	{
		var allKPData = "";
		var allBXData = "";
		
		for (var i = 0; i < objData.length; i++) {
			if(objData[i].isAllTicket == "1")	objData[i].SeatID = "XX";
			var str1;
			if(i == objData.length - 1)	str1 = '<div>'; 
			else	str1 = '<div class="PageNext">';
			var str2 = '<table style="width:'+PrintTicket[0]+'px;height:'+PrintTicket[1]+'px;margin-left:'+PrintTicket[2]+'px;margin-top:'+PrintTicket[3]+'px;font-size:'+PrintTicket[4]+'px;border:0"><tr><td>';
			var str3 = '<div style="margin-top:'+PrintTicket[5]+'px;"><div style="margin-left:'+PrintTicket[6]+'px;float:left;">'+objData[i].TicketID+'</div><div style="margin-left:'+PrintTicket[7]+'px;">'+objData[i].TicketID+'</div></div>';
			var str4 = '<div style="margin-top:'+PrintTicket[8]+'px;"><div style="margin-left:'+PrintTicket[9]+'px;float:left">' + objData[i].FromStation + '<span style="margin-left:'+PrintTicket[10]+'px;">' + objData[i].ReachStation + '</span></div><div style="margin-left:'+PrintTicket[11]+'px;">' + objData[i].FromStation + '<span style="margin-left:'+PrintTicket[12]+'px;">' + objData[i].ReachStation + '</span></div></div>';
			var str5 = '<div style="margin-top:'+PrintTicket[13]+'px;"><div style="margin-left:'+PrintTicket[14]+'px;float:left">' + objData[i].SellPrice + '<span style="margin-left:'+PrintTicket[15]+'px;">' + objData[i].SeatID + '</span></div><div style="margin-left:'+PrintTicket[16]+'px;">' + objData[i].SellPrice + '</div></div>';
			var str6 = '<div style="margin-top:'+PrintTicket[17]+'px;"><div style="margin-left:'+PrintTicket[18]+'px;float:left">' + objData[i].NoOfRunsID + '<span style="margin-left:'+PrintTicket[19]+'px;">' + objData[i].BeginStationTime + '</span></div><div style="margin-left:'+PrintTicket[20]+'px;">' + objData[i].NoOfRunsID + '</div></div>';
			var str7 = '<div style="margin-top:'+PrintTicket[21]+'px;"><div style="margin-left:'+PrintTicket[22]+'px;float:left">' + objData[i].NoOfRunsdate + '</div><div style="margin-left:'+PrintTicket[23]+'px;">' + objData[i].NoOfRunsdate + '</div></div>';
			var str8 = '<div style="margin-top:'+PrintTicket[24]+'px;"><div style="margin-left:'+PrintTicket[25]+'px;float:left">' + objData[i].SeatID + '</div></div>';
			var str9 = '<div style="margin-top:'+PrintTicket[26]+'px;"><div style="margin-left:'+PrintTicket[27]+'px;float:left">' + objData[i].SellerID + '</div></div>';
			var str10 = '</td></tr></table></div>';
			oneKPData = str1 + str2 + str3 + str4 + str5 + str6 + str7 + str8 + str9 + str10;
			allKPData = allKPData + oneKPData;		
			//alert(oneKPData);
			if (objData[i].SafetyTicketMoney != "0"){
				if(i == objData.length - 1)	str1 = '<div>'; 
				else	str1 = '<div class="PageNext">';
				var str2 = '<table style="width:'+PrintTicket[28]+'px;height:'+PrintTicket[29]+'px;margin-left:'+PrintTicket[30]+'px;margin-top:'+PrintTicket[31]+'px;font-size:'+PrintTicket[32]+'px;border:0"><tr><td>';
				var str3 = '<div style="margin-top:'+PrintTicket[34]+'px;"><div style="margin-left:'+PrintTicket[33]+'px;float:left;">'+objData[i].SyncCode+'</div><div style="margin-left:'+PrintTicket[35]+'px;">&nbsp;</div></div>';
				var str4 = '<div style="margin-top:'+PrintTicket[38]+'px;"><div style="margin-left:'+PrintTicket[37]+'px;float:left">' + objData[i].Name + '</div><div style="margin-left:'+PrintTicket[39]+'px;">&nbsp;</div></div>';
				var str5 = '<div style="margin-top:'+PrintTicket[42]+'px;"><div style="margin-left:'+PrintTicket[41]+'px;float:left">' + objData[i].IdCard + '</div><div style="margin-left:'+PrintTicket[39]+'px;">&nbsp;</div></div>';
				var str6 = '<div style="margin-top:'+PrintTicket[44]+'px;"><div style="margin-left:'+PrintTicket[43]+'px;float:left">' + objData[i].Beneficiary + '</div><div style="margin-left:'+PrintTicket[39]+'px;">&nbsp;</div></div>';
				var str7 = '<div style="margin-top:'+PrintTicket[46]+'px;"><div style="margin-left:'+PrintTicket[45]+'px;float:left">' + objData[i].AInsuranceValue + '</div><div style="margin-left:'+PrintTicket[47]+'px;">&nbsp;</div></div>';
				var str8 = '<div style="margin-top:'+PrintTicket[50]+'px;"><div style="margin-left:'+PrintTicket[49]+'px;float:left">' + objData[i].BInsuranceValue + '</div><div style="margin-left:'+PrintTicket[47]+'px;">&nbsp;</div></div>';
				var str9 = '<div style="margin-top:'+PrintTicket[52]+'px;"><div style="margin-left:'+PrintTicket[51]+'px;float:left">' + objData[i].SafetyTicketMoney + '</div><div style="margin-left:'+PrintTicket[53]+'px;">' + objData[i].NoOfRunsID + '</div></div>';
				var str10 = '<div style="margin-top:'+PrintTicket[56]+'px;"><div style="margin-left:'+PrintTicket[55]+'px;float:left">' + objData[i].NoOfRunsdate +'&nbsp;'+ objData[i].BeginStationTime+'</div><div style="margin-left:'+PrintTicket[57]+'px;">' + objData[i].SaleTime + '</div></div>';
				var str11 = '<div style="margin-top:'+PrintTicket[60]+'px;"><div style="margin-left:'+PrintTicket[59]+'px;float:left">' + objData[i].AgentCode + '</div><div style="margin-left:'+PrintTicket[61]+'px;">' + objData[i].HandlerCode + '</div></div>';
				var str12 = '</td></tr></table></div>';
				oneBXData = str1 + str2 + str3 + str4 + str5 + str6 + str7 + str8 + str9 + str10 + str11 + str12;
				allBXData = allBXData + oneBXData;		
				//alert(oneBXData);
			}  
		}
		
		function printKP() {
			kpWin.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n');
			kpWin.document.write('<html xmlns="http://www.w3.org/1999/xhtml">\n<head>\n');
			kpWin.document.write('<title>客票打印</title>\n');
			kpWin.document.write('<style media="print" type="text/css">\n');
			kpWin.document.write('.Noprint{display:none;}\n');
			kpWin.document.write('.PageNext{page-break-after:always;}\n');
			kpWin.document.write('</style>\n');
			kpWin.document.write('<object id="printWB" width=0 height=0 classid="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></object>\n');
			kpWin.document.write('<script>\n');
		//	kpWin.document.write('window.onbeforeprint = function() {alert("Before printing KP");};\n');
		//	kpWin.document.write('window.onafterprint = function() {alert("After printing KP");};\n');
			kpWin.document.write('\<\/script>\n</head>\n');
			kpWin.document.write('<body>\n');
			kpWin.document.write(allKPData);
			kpWin.document.write('\n<script>\n');
			kpWin.document.write('printWB.ExecWB(6,2);');
			kpWin.document.write('\n\<\/script>');
			kpWin.document.write('\n</body>\n</html>');
			kpWin.close();
		}

		function printBX() {
			bxWin.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n');
			bxWin.document.write('<html xmlns="http://www.w3.org/1999/xhtml">\n<head>\n');
			bxWin.document.write('<title>保险票打印</title>\n');
			bxWin.document.write('<style media="print" type="text/css">\n');
			bxWin.document.write('.Noprint{display:none;}\n');
			bxWin.document.write('.PageNext{page-break-after:always;}\n');
			bxWin.document.write('</style>\n');
			bxWin.document.write('<object id="printWB" width=0 height=0 classid="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></object>\n');
			bxWin.document.write('<script>\n');
		//	bxWin.document.write('window.onbeforeprint = function() {alert("Before printing BX");};\n');
		//	bxWin.document.write('window.onafterprint = function() {alert("After printing BX");};\n');
			bxWin.document.write('\<\/script>\n</head>\n');
			bxWin.document.write('<body>\n');
			bxWin.document.write(allBXData);
			bxWin.document.write('\n<script>\n');
			bxWin.document.write('printWB.ExecWB(6,2);');
			bxWin.document.write('\n\<\/script>');
			bxWin.document.write('\n</body>\n</html>');
			bxWin.close();
		}

		var cmd = 'C:\\Windows\\System32\\rundll32.exe'; 
		var para1 = 'printui.dll,PrintUIEntry'; 
		var para2 = '/y'; 
		var para3 = '/n';
		var para4 = '"' + $("#kpPrinterName").val() + '"'; 
		var para5 = '"' + $("#bxPrinterName").val() + '"';
		var Wsh = new ActiveXObject("WScript.Shell");
		printPageSetup(Wsh);

		var kpWin,bxWin;
		if(allKPData != "" && para4 != '"none"') {
			Wsh.Run(cmd + ' ' + para1 + ' ' + para2 + ' ' + para3 + ' ' + para4);
			var windowFeatures = "width="+PrintTicket[0]+",height="+PrintTicket[1]+",top=0,left=0,directories=no,toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no";
			kpWin = window.open('','kpWin',windowFeatures); 
			printKP();
			while (!kpWin.closed);
		}
		if(allBXData != "" && para5 != '"none"') {
			Wsh.Run(cmd + ' ' + para1 + ' ' + para2 + ' ' + para3 + ' ' + para5);
			var windowFeatures = "width="+PrintTicket[28]+",height="+PrintTicket[29]+",top=0,left=0,directories=no,toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no";
			bxWin = window.open('','bxWin',windowFeatures); 
			printBX();
		}
		
		if($("#multiTicket").is(":checked")) {
			if(confirm("是否继续购票?")) {
				window.location.href = "tms_v1_sell_query.php?op=mTicket&remainMoney=" + $("#reticketmoney").val();
			}
			else
				window.location.assign('tms_v1_sell_query.php');
		}
		else 
			window.location.assign('tms_v1_sell_query.php');
	}
	
	$(document).ready(function(){
		Init();
		window.status = '【售保险票】：左shift键（售票预览前选择）    【售多地票】：左Ctrl键（确认出票前选择）    【取消】：ESC键    【确认输入】：回车键';
		if($("#totalticketnum").val() == 0) {
			$("#fullTicketNumIn").focus();
		}
		else {
			$("#getticketmoney").focus();
		}
		$("#fullTicketNumIn").keydown(function(event) {
			var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 13) {	//enter key
        		document.getElementById("halfTicketNumIn").focus();
            }
        });
		$("#halfTicketNumIn").keydown(function(event) {
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 13) {
            	if($("#sellInsureTicket").is(":checked"))
                	document.getElementById("safeUserIDCardIn").focus();
            	else
					document.getElementById("sellview").focus();
            }
        });
		$("#safeUserIDCardIn").keydown(function(event) {
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 13) {
                if($("#safeUserIDCardIn").val() == "") {
                    readCard();
                    if($("#safeUserIDCardIn").val() == "") {
						alert("身份证号为空！请检查。");
						return false;
                    }    
                }
                if(!checkcertificatenumber($("#safeUserIDCardIn").val())) {
					alert("身份证号输入不对！请检查。");
					return false;
                }
                if($("#safeUserIDCards").val() == "") {
	                $("#safeUserIDCards").val($("#safeUserIDCardIn").val() + ";");
	                $("#safeUsers").val($("#safeUser").val() + ";");
	                $("#safeUserAddresses").val($("#safeUserAddress").val() + ";");
                }
                else {
                    $("#safeUserIDCards").val($("#safeUserIDCards").val() + $("#safeUserIDCardIn").val() + ";");
                    $("#safeUsers").val($("#safeUsers").val() + $("#safeUser").val() + ";");
                    $("#safeUserAddresses").val($("#safeUserAddresses").val() + $("#safeUserAddress").val() + ";");
                }
				//alert($("#safeUserIDCards").val().split(";").length - 1);
				if($("#safeUserIDCards").val().split(";").length > ($("#fullTicketNumIn").val() * 1  + $("#halfTicketNumIn").val() * 1)) {
					document.getElementById("sellview").focus();
				}
				else {
					$("#safeUserIDCardIn").val("");
                	document.getElementById("safeUserIDCardIn").focus();
				}
	        }
        });
		$("#getticketmoney").keydown(function(event) {
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 13) {
            	document.getElementById("confirmsell").focus();
            }
        });
		document.onkeyup = function (event) {
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 27) {	//ESC
        		if($("#totalticketnum").val() > 0) {	//cancel view
        			jQuery.get(
        				'tms_v1_sell_sell.php',
        				{'op': 'cancelsell', 'noofrunsID': $("#noofrun").val(), 'norunsdate': $("#departuredate").val(), 
        				'tnum': $("#fullTicketNumIn").val(), 'htnum': $("#halfTicketNumIn").val(), 'seatnos': $("#seatNo").val(), 'time': Math.random()},
        				function(data){
        					var objData = eval('(' + data + ')');
        					if(objData.retVal == "FAIL"){ 
        						alert(objData.retString);
        					}
        					else{
        						$("#leftseats").val($("#leftseats").val() * 1 + objData.totalNum * 1);
        						$("#lefthalfseats").val($("#lefthalfseats").val() * 1 + objData.halfNum * 1);
        						document.getElementById("newTicketID").value = document.getElementById("curTicketID").value;
        						document.getElementById("newSafeTicketID").value = document.getElementById("curSafeTicketID").value;
            					document.getElementById("fullTicketNumIn").value = 0;
            					document.getElementById("halfTicketNumIn").value = 0;
            					document.getElementById("totalticketnum").value = 0;
        						$("#safeUserIDCardIn").val("");
        						$("#safeUserIDCards").val("");
        						$("#safeUsers").val("");
        						$("#safeUserAddresses").val("");
         						document.form1.submit();
        					}
       		 		});
	       		}
        		else {	// return query page
            		document.location.href = "tms_v1_sell_query.php";
            		return false;
				}
            }
            if (e && e.keyCode == 16) {	//左Shift
            	if($("#sellInsureTicket").is(":checked"))
					$("#sellInsureTicket").attr("checked","");
            	else{
					$("#sellInsureTicket").attr("checked","checked");
					if(document.getElementById("newSafeTicketID").value==''){
						alert('没有可用的保险票！');
						$("#sellInsureTicket").attr("checked","");
					}
            	}
			}
            if (e && e.keyCode == 17) {	//左Ctrl
            	if($("#multiTicket").is(":checked"))
					$("#multiTicket").attr("checked","");
            	else
					$("#multiTicket").attr("checked","checked");
			}
		};
	});
	
	$(document).ready(function(){
		$("#sellInsureTicket").click(function(){
			if($("#sellInsureTicket").is(":checked")){
				if(document.getElementById("newSafeTicketID").value==''){
					alert('没有可用的保险票！');
					$("#sellInsureTicket").attr("checked","");
				}
			}
        	else{
				$("#sellInsureTicket").attr("checked","");
        	} 
		});
		$("#sellview").click(function(){
			if ((document.getElementById("fullTicketNumIn").value * 1 + document.getElementById("halfTicketNumIn").value * 1) == 0){
				alert("售票数为零！");
				document.getElementById("fullTicketNumIn").focus();
				return false;
			}
			else if (document.getElementById("lefthalfseats").value < document.getElementById("halfTicketNumIn").value * 1){
				var val = document.getElementById("lefthalfseats").value; 
				alert("半票数量不够！剩余半票数："+ val);
				document.getElementById("halfTicketNumIn").focus();
				return false;
			}
			else if (document.getElementById("leftseats").value < (document.getElementById("fullTicketNumIn").value * 1 + document.getElementById("halfTicketNumIn").value * 1)){
				var val = document.getElementById("leftseats").value;
				alert("余票数量不够！余票数："+ val);
				document.getElementById("fullTicketNumIn").focus();
				return false;
			}
			else if (document.getElementById("leftTicketIDNum").value < (document.getElementById("fullTicketNumIn").value * 1 + document.getElementById("halfTicketNumIn").value * 1)){
				var val = document.getElementById("leftTicketIDNum").value; 
				alert("本次客票票据数量不够！余票数："+ val);
				document.getElementById("fullTicketNumIn").focus();
				return false;
			}
			else if(!$("#sellInsureTicket").is(":checked")) {
				document.getElementById("safeTicketMoney").value = 0;
				document.form1.submit();
			}
			else {
				if (document.form1.leftSafeTicketIDNum.value < (document.form1.fullTicketNumIn.value * 1 + document.form1.halfTicketNumIn.value * 1)){
					var val = document.form1.leftSafeTicketIDNum.value; 
					alert("本次保险票据数量不够！余票数："+ val);
					document.form1.fullTicketNumIn.focus();
					return false;
				}
				else if (($("#safeUserIDCards").val().split(";").length - 1) < ($("#fullTicketNumIn").val() * 1 + $("#halfTicketNumIn").val() * 1)) {
					var total = $("#fullTicketNumIn").val() * 1 + $("#halfTicketNumIn").val() * 1;
					alert("身份证信息数量 " + ($("#safeUserIDCards").val().split(";").length - 1) + " 小于售票数量 " + total + "，请补入！");
                	document.getElementById("safeUserIDCardIn").focus();
					return false;
				}
				else {
					document.getElementById("safeTicketMoney").value = document.getElementById("safeticketmoneyselect").value;
					document.form1.submit();
				}
			}
		});
		$("#confirmsell").click(function(){
			if (document.getElementById("getticketmoney").value - document.getElementById("realticketmoney").value < 0) {
				alert("实收款金额不足！");
				document.getElementById("getticketmoney").focus();
			}
			else {
				document.getElementById("reticketmoney").value = document.getElementById("getticketmoney").value - document.getElementById("realticketmoney").value;
				document.getElementById("reticketmoney").focus();
				if(!confirm("找零并确认出票?")) {
					document.getElementById("getticketmoney").focus();
				}
				else {
					var objData,PrintTicket;
					var printThis = false;
					$.ajax({
						type : "get",
						url : "tms_v1_sell_sell.php",
						data : {'op': 'confirmsell', 'subop': 'windowsell', 'WebSellID': "", 'newTicketID': $("#newTicketID").val(), 'curTicketID': $("#curTicketID").val(), 'NoOfRunsID': $("#noofrun").val(), 
							'NoOfRunsdate': $("#departuredate").val(), 'FromStation': $("#fromstation").val(), 'ReachStation': $("#reachstation").val(), 
							'FullTicketNum': $("#fullTicketNumIn").val(), 'HalfTicketNum': $("#halfTicketNumIn").val(), 'seatnos': $("#seatNo").val(), 
							'newSafetyTicketID': $("#newSafeTicketID").val(), 'curSafetyTicketID': $("#curSafeTicketID").val(), 'SafetyMoney': $("#safeTicketMoney").val(), 
							'SafetyID': $("#safeUserIDCards").val(),'safeUser':$("#safeUsers").val(),'safeUserAddress':$("#safeUserAddresses").val(), 'time': Math.random()},
						async : false,
						success : function(data){
							objData = eval('(' + data + ')');
							if(objData.retVal == "FAIL"){ 
								alert(objData.retString);
							}
							else{
								document.getElementById("totalticketnum").value = 0;
								PrintTicket = new Array(
									document.getElementById("width").value,document.getElementById("height").value, document.getElementById("left").value, 
									document.getElementById("top").value, document.getElementById("fontsize").value, document.getElementById("topTicketIDL").value,
									document.getElementById("leftTicketIDL").value,document.getElementById("leftTicketIDR").value, document.getElementById("topFromStationL").value,
									document.getElementById("leftFromStationL").value, document.getElementById("leftReachStationL").value, document.getElementById("leftFromStationR").value,
									document.getElementById("leftReachStationR").value, document.getElementById("topSellPriceL").value, document.getElementById("leftSellPriceL").value,
									document.getElementById("leftSeatIDL").value, document.getElementById("leftSellPriceR").value, document.getElementById("topNoOfRunsIDL").value,
									document.getElementById("leftNoOfRunsIDL").value, document.getElementById("leftBeginStationTime").value, document.getElementById("leftNoOfRunsIDR").value,
									document.getElementById("topNoOfRunsdateL").value, document.getElementById("leftNoOfRunsdateL").value, document.getElementById("leftNoOfRunsdateR").value,
									document.getElementById("topSeatIDR").value, document.getElementById("leftSeatIDR").value, document.getElementById("topSellerID").value, 
									document.getElementById("leftSellerID").value, document.getElementById("insurewidth").value,document.getElementById("insureheight").value,
									document.getElementById("insureleft").value, document.getElementById("insuretop").value, document.getElementById("insurefontsize").value, 
									document.getElementById("leftSyncCode").value, document.getElementById("topSyncCode").value, document.getElementById("leftinsureSpace1").value,
									document.getElementById("topinsureSpace1").value, document.getElementById("leftName").value, document.getElementById("topName").value,
									document.getElementById("leftinsureSpace2").value, document.getElementById("topinsureSpace2").value, document.getElementById("leftIdCard").value,
									document.getElementById("topIdCard").value, document.getElementById("leftBeneficiary").value, document.getElementById("topBeneficiary").value,
									document.getElementById("leftAinsuranceValue").value, document.getElementById("topAinsuranceValue").value, document.getElementById("leftinsureSpace3").value,
									document.getElementById("topinsureSpace3").value, document.getElementById("leftBinsuranceValue").value, document.getElementById("topBinsuranceValue").value,
									document.getElementById("leftPrice").value, document.getElementById("topPrice").value, document.getElementById("leftNoOfRunsID").value,
									document.getElementById("topNoOfRunsID").value, document.getElementById("leftNoOfRunsdate").value,  document.getElementById("topNoOfRunsdate").value,
									document.getElementById("leftSaleTime").value, document.getElementById("topSaleTime").value, document.getElementById("leftAgentCode").value, 
									document.getElementById("topAgentCode").value, document.getElementById("leftHandlerCode").value, document.getElementById("topHandlerCode").value
								);
								printThis = true;
							}
						}
					}); 
					if(printThis) printTicket(objData, PrintTicket);
				}
			}
		});		
		$("#cancelsell").click(function(){
			jQuery.get(
					'tms_v1_sell_sell.php',
					{'op': 'cancelsell', 'noofrunsID': $("#noofrun").val(), 'norunsdate': $("#departuredate").val(), 
					'tnum': $("#fullTicketNumIn").val(), 'htnum': $("#halfTicketNumIn").val(), 'seatnos': $("#seatNo").val(), 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL"){ 
							alert(objData.retString);
						}
						else{
							$("#leftseats").val($("#leftseats").val() * 1 + objData.totalNum * 1);
							$("#lefthalfseats").val($("#lefthalfseats").val() * 1 + objData.halfNum * 1);
							document.getElementById("newTicketID").value = document.getElementById("curTicketID").value;
							document.getElementById("newSafeTicketID").value = document.getElementById("curSafeTicketID").value;
	    					document.getElementById("fullTicketNumIn").value = 0;
	    					document.getElementById("halfTicketNumIn").value = 0;
	    					document.getElementById("totalticketnum").value = 0;
							$("#safeUserIDCardIn").val("");
							$("#safeUserIDCards").val("");
							$("#safeUsers").val("");
							$("#safeUserAddresses").val("");
	 						document.form1.submit();
						}
			});
		});	
	});
	function stopLeave(event){
		if($("#totalticketnum").val() > 0) {
			var msg = " ！！！ 售票锁定中，请选择留在此页上并完成售票，否则会带来错误 ！！！ ";
			event = event || window.event;
			event.cancelBubbler = true;
			event.returnValue = msg;
			if(event.stopPropagation){
				event.stopPropagation();
				event.preventDefault();
			}
			return msg;
		}
		else
			window.status = "";
	}
	window.onbeforeunload = stopLeave;
	</script>
</head>
<body style="overflow-x:hidden;">
<form action="" method="post" name="form1">
<br/>
<div style="margin-left:5px;">
<img src="../ui/images/sj.gif" width="6" height="7" />&nbsp;乘车日期：
<input type="text" name="departuredate" id="departuredate" size="10" value="<?=$norunsdate?>" readonly="readonly" style="height:18;border:none"/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../ui/images/sj.gif" width="6" height="7" />&nbsp;发车时间：
<input type="text" name="departuretime" id="departuretime" size="5" value="<?=$norunstime?>" readonly="readonly" style="height:18;border:none"/>
<span style="font-size:16">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$fromplace?>&nbsp;&nbsp;&nbsp;<img src="../ui/images/sellarrow.gif" width="24" height="7" /></span>
<input type="hidden" name="fromstation" id="fromstation" value="<?=$fromplace?>" readonly="readonly" />
<span style="font-size:16">&nbsp;&nbsp;&nbsp;<?=$reachplace?></span>
<input type="hidden" name="reachstation" id="reachstation" size="10" value="<?=$reachplace?>" readonly="readonly" />
<span style="font-size:14">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;票价：<?=$fullPrice?></span>
<input type="hidden" name="fullPrice" id="fullPrice" size="7" value="<?=$fullPrice?>" readonly="readonly" />
<input type="hidden" name="busModel" id="busModel" size="10" value="<?=$busModel?>" readonly="readonly" />
<input type="hidden" name="isAllTicket" id="isAllTicket" size="2" value="<?=$isAllTicket?>" readonly="readonly" />
<input type="hidden" name="noofrun" id="noofrun" value="<?=$noofrunsID?>" readonly="readonly" />
</div>
<br/>
<div style="margin-left:5px;">
	<img src="../ui/images/sj.gif" width="6" height="7"/>&nbsp;全票数：
	<input type="text" name="fullTicketNumIn" id="fullTicketNumIn" size="2" value="<?php echo $tnum;?>" <?=$readonly?> style="height:20;" onkeyup="return isnumber(this.value)" onfocus="this.select()"/>
	&nbsp;&nbsp;&nbsp;<img src="../ui/images/sj.gif" width="6" height="7" />&nbsp;半票数：
	<input type="text" name="halfTicketNumIn" id="halfTicketNumIn" size="2" value="<?php echo $htnum;?>" <?=$readonly?> style="height:20;" onkeyup="return isnumber1(this.value)" onfocus="this.select()"/>
	&nbsp;&nbsp;&nbsp;<img src="../ui/images/sj.gif" width="6" height="7" />&nbsp;保险金额：
	<select name="safeticketmoneyselect" id="safeticketmoneyselect" style="height:20;">
		<?php
			$sql="SELECT it_InsureProductName,it_Price FROM tms_bd_InsureType"; 
      		$query =$class_mysql_default->my_query($sql);
			while($result=mysql_fetch_array($query)){ 
		?>
		<!-- 
			<option value="<?php echo $result['it_Price'];?>"><?php echo $result['it_InsureProductName'].'('.$result['it_Price'].'元)';?></option>
		-->	
		<option value="<?php echo $result['it_Price'];?>"><?php echo $result['it_Price'].'元';?></option>
		<?php 
			}
		?>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../ui/images/sj.gif" width="6" height="7" />&nbsp;身份证号：
	<input type="text" name="safeUserIDCardIn" id="safeUserIDCardIn" size="18" value="<?php echo $safeUserIDCard?>" <?=$readonly?> style="height:20;"/>
<!-- 
	&nbsp;<input type="button" name="readIDCard" id="readIDCard" style="font-size:13px;"value="读卡" onclick="readCard();document.getElementById('safeUserIDCardIn').focus();" <?=$viewenable?> />
-->
	<input type="hidden" id="safeUser" name="safeUser" value="unknown" />
	<input type="hidden" id="safeUserAddress" name="safeUserAddress" value="unknown" />
</div>
<br/>
<div style="margin-left:5px;">
<?
	if (isset($_POST['fromstation'])) {
		$totalticketnum = $tnum + $htnum;
		$totalticketmoney = $fullPrice * $tnum + ($fullPrice/2) * $htnum;
		if($safeTicketMoney == 0) {
			$totalinsureticketnum = 0; 
			$totalinsureticketmoney = 0;
		}
		else {
			$totalinsureticketnum = $totalticketnum; 
			$totalinsureticketmoney = $safeTicketMoney * $totalinsureticketnum;
		}
		$totalmoney = $totalticketmoney + $totalinsureticketmoney;
	}
?>
	<input type="hidden" name="remainMoney" id="remainMoney" value="<?php echo $remainMoney?>" />
	<input type="hidden" name="totalticketnum" id="totalticketnum" size="3" value="<?=$totalticketnum?>" readonly="readonly" />
	<input type="hidden" name="totalsafenum" id="totalsafenum" size="3" value="<?=$totalinsureticketnum?>" readonly="readonly" />
	<input type="hidden" name="totalticketmoney" size="7" id="totalticketmoney" value="<?=$totalticketmoney?>" readonly="readonly" />
	<input type="hidden" name="totalsafemoney" id="totalsafemoney" size="3" value="<?=$totalinsureticketmoney?>" readonly="readonly" />
	<img src="../ui/images/sj.gif" width="6" height="7" />&nbsp;实收款(元)：
	<input type="text" name="getticketmoney" id="getticketmoney" size="7" style="background-color:#f3f3f3;height:20;" onfocus='this.select()'/>
	&nbsp;&nbsp;&nbsp;<img src="../ui/images/sj.gif" width="6" height="7" />&nbsp;应收款(元)：
	<input type="text" name="realticketmoney" id="realticketmoney" size="5" value="<?=($totalmoney-$remainMoney)?>" readonly="readonly" style="height:22;border:none;color:RED;font-size:22"/>
	<br/><br/>
	<img src="../ui/images/sj.gif" width="6" height="7" />&nbsp;找补(元)：
	<input type="text" name="reticketmoney" id="reticketmoney" size="5" readonly="readonly" style="height:22;border:none;color:BLUE;font-size:22"/>
	&nbsp;&nbsp;<input type="button" name="confirmsell" id="confirmsell" style="height:18;text-align:center;font-size:12px;" value="确 认 出 票" <?=$subcancelenable?> />&nbsp;&nbsp;&nbsp;&nbsp;
   	&nbsp;&nbsp;<input type="button" name="cancelsell" id="cancelsell" style="height:18;text-align:center;font-size:12px;" value="取 消" <?=$subcancelenable?> />
</div>
<br/><br/>
<table style="width:100%;align:left;border:0;cellpadding:1;cellspacing:1">
	<tr style="background-color:#F1E6C2">
		<td nowrap="nowrap" align="center">序号</td>
		<td nowrap="nowrap" align="center">发车日期</td>
		<td nowrap="nowrap" align="center">发车时间</td>
		<td nowrap="nowrap" align="center">出发站</td>
		<td nowrap="nowrap" align="center">到达站</td>
		<td nowrap="nowrap" align="center">班次</td>
		<td nowrap="nowrap" align="center">票型</td>
		<td nowrap="nowrap" align="center">座位</td>
		<td nowrap="nowrap" align="center">车型</td>
	</tr>
<?php
	if (isset($_POST['fromstation'])) {
		$seatArray = explode(",", $seatno);
		for ($i = 0; $i < $tnum; $i++) {
?>
	<tr style="background-color:#CCCCCC">
		<td align="center"><?=$i+1?></td>
		<td align="center"><?=$norunsdate?></td>
		<td align="center"><?=$norunstime?></td>
		<td align="center"><?=$fromplace?></td>
		<td align="center"><?=$reachplace?></td>
		<td align="center"><?=$noofrunsID?></td>
		<td align="center">全票</td>
	<?php if ($isAllTicket == "0") {?>
		<td align="center" onclick="selectSeat(this);" ondblclick="selectSeat(this);"><?=$seatArray[$i]+1?></td>
	<?php } else {?>	
		<td align="center"><?=XX?></td>
	<?php }?>	
		<td align="center"><?=$busModel?></td>
	</tr>
<?php	}
		for ($i = 0; $i < $htnum; $i++) {
?>
	<tr style="background-color:#CCCCCC">
		<td align="center"><?=$i+$tnum+1?></td>
		<td align="center"><?=$norunsdate?></td>
		<td align="center"><?=$norunstime?></td>
		<td align="center"><?=$fromplace?></td>
		<td align="center"><?=$reachplace?></td>
		<td align="center"><?=$noofrunsID?></td>
		<td align="center">半票</td>
	<?php if ($isAllTicket == "0") {?>
		<td align="center" onclick="selectSeat(this);" ondblclick="selectSeat(this);"><?=$seatArray[$i+$tnum]+1?></td>
	<?php } else {?>	
		<td align="center"><?=XX?></td>
	<?php }?>	
		<td align="center"><?=$busModel?></td>
	</tr>
<?php	}
	}
?>  		
</table>
<?php if ($isAllTicket == "0") {?>
<iframe id="seatview" name="seatview" width="100%" height="100" frameborder="1" scrolling="yes" src="tms_v1_sell_seatview.php?nrID=<?=$noofrunsID?>&nrDate=<?=$norunsdate?>"></iframe>
<?php }?>
<input type="hidden" id="leftseats" name="leftseats" value="<?php echo $leftseats?>" />
<input type="hidden" id="lefthalfseats" name="lefthalfseats" value="<?php echo $lefthalfseats?>" />
<input type="hidden" id="curTicketID" name="curTicketID" value="<?php echo $curTicketID?>" />
<input type="hidden" id="curSafeTicketID" name="curSafeTicketID" value="<?php echo $curSafeTicketID?>" />
<input type="hidden" id="safeTicketMoney" name="safeTicketMoney" value="<?php echo $safeTicketMoney?>" />
<input type="hidden" id="seatNo" name="seatNo" value="<?php echo $seatno?>" />
<input type="hidden" id="leftTicketIDNum" name="leftTicketIDNum" value="<?php echo $leftTicketNum?>" />
<input type="hidden" id="leftSafeTicketIDNum" name="leftSafeTicketIDNum" value="<?php echo $leftSafeTicketNum?>" />

<input type="hidden" name="kpPrinterName" id="kpPrinterName" value="<?php echo $kpName;?>"/>
<input type="hidden" name="bxPrinterName" id="bxPrinterName" value="<?php echo $bxName;?>"/>
<input type="hidden" name="width" id="width" value="<?php echo $width;?>"/>
<input type="hidden" name="height" id="height" value="<?php echo $height;?>"/>
<input type="hidden" name="left" id="left" value="<?php echo $left;?>"/>
<input type="hidden" name="top" id="top" value="<?php echo $top;?>"/>
<input type="hidden" name="fontsize" id="fontsize" value="<?php echo $fontsize;?>"/>
<input type="hidden" name="leftTicketIDL" id="leftTicketIDL" value="<?php echo $leftTicketIDL;?>"/>
<input type="hidden" name="topTicketIDL" id="topTicketIDL" value="<?php echo $topTicketIDL;?>"/>
<input type="hidden" name="leftTicketIDR" id="leftTicketIDR" value="<?php echo $leftTicketIDR;?>"/>
<input type="hidden" name="topTicketIDR" id="topTicketIDR" value="<?php echo $topTicketIDR;?>"/>
<input type="hidden" name="leftFromStationL" id="leftFromStationL" value="<?php echo $leftFromStationL;?>"/>
<input type="hidden" name="topFromStationL" id="topFromStationL" value="<?php echo $topFromStationL;?>"/>
<input type="hidden" name="leftReachStationL" id="leftReachStationL" value="<?php echo $leftReachStationL;?>"/>
<input type="hidden" name="topReachStationL" id="topReachStationL" value="<?php echo $topReachStationL;?>"/>
<input type="hidden" name="leftFromStationR" id="leftFromStationR" value="<?php echo $leftFromStationR;?>"/>
<input type="hidden" name="topFromStationR" id="topFromStationR" value="<?php echo $topFromStationR;?>"/>
<input type="hidden" name="leftReachStationR" id="leftReachStationR" value="<?php echo $leftReachStationR;?>"/>
<input type="hidden" name="topReachStationR" id="topReachStationR" value="<?php echo $topReachStationR;?>"/>
<input type="hidden" name="leftSellPriceL" id="leftSellPriceL" value="<?php echo $leftSellPriceL;?>"/>
<input type="hidden" name="topSellPriceL" id="topSellPriceL" value="<?php echo $topSellPriceL;?>"/>
<input type="hidden" name="leftSeatIDL" id="leftSeatIDL" value="<?php echo $leftSeatIDL;?>"/>
<input type="hidden" name="topSeatIDL" id="topSeatIDL" value="<?php echo $topSeatIDL;?>"/>
<input type="hidden" name="leftSellPriceR" id="leftSellPriceR" value="<?php echo $leftSellPriceR;?>"/>
<input type="hidden" name="topSellPriceR" id="topSellPriceR" value="<?php echo $topSellPriceR;?>"/>
<input type="hidden" name="leftNoOfRunsIDL" id="leftNoOfRunsIDL" value="<?php echo $leftNoOfRunsIDL;?>"/>
<input type="hidden" name="topNoOfRunsIDL" id="topNoOfRunsIDL" value="<?php echo $topNoOfRunsIDL;?>"/>
<input type="hidden" name="leftBeginStationTime" id="leftBeginStationTime" value="<?php echo $leftBeginStationTime;?>"/>
<input type="hidden" name="topBeginStationTime" id="topBeginStationTime" value="<?php echo $topBeginStationTime;?>"/>
<input type="hidden" name="leftNoOfRunsIDR" id="leftNoOfRunsIDR" value="<?php echo $leftNoOfRunsIDR;?>"/>
<input type="hidden" name="topNoOfRunsIDR" id="topNoOfRunsIDR" value="<?php echo $topNoOfRunsIDR;?>"/>
<input type="hidden" name="leftNoOfRunsdateL" id="leftNoOfRunsdateL" value="<?php echo $leftNoOfRunsdateL;?>"/>
<input type="hidden" name="topNoOfRunsdateL" id="topNoOfRunsdateL" value="<?php echo $topNoOfRunsdateL;?>"/>
<input type="hidden" name="leftNoOfRunsdateR" id="leftNoOfRunsdateR" value="<?php echo $leftNoOfRunsdateR;?>"/>
<input type="hidden" name="topNoOfRunsdateR" id="topNoOfRunsdateR" value="<?php echo $topNoOfRunsdateR;?>"/>
<input type="hidden" name="leftSeatIDR" id="leftSeatIDR" value="<?php echo $leftSeatIDR;?>"/>
<input type="hidden" name="topSeatIDR" id="topSeatIDR" value="<?php echo $topSeatIDR;?>"/>
<input type="hidden" name="leftSellerID" id="leftSellerID" value="<?php echo $leftSellerID;?>"/>
<input type="hidden" name="topSellerID" id="topSellerID" value="<?php echo $topSellerID;?>"/>
<input type="hidden" name="insurewidth" id="insurewidth" value="<?php echo $insurewidth;?>"/>
<input type="hidden" name="insureheight" id="insureheight" value="<?php echo $insureheight;?>"/>
<input type="hidden" name="insureleft" id="insureleft" value="<?php echo $insureleft;?>"/>
<input type="hidden" name="insuretop" id="insuretop" value="<?php echo $insuretop;?>"/>
<input type="hidden" name="insurefontsize" id="insurefontsize" value="<?php echo $insurefontsize;?>"/>
<input type="hidden" name="leftSyncCode" id="leftSyncCode" value="<?php echo $leftSyncCode;?>"/>
<input type="hidden" name="topSyncCode" id="topSyncCode" value="<?php echo $topSyncCode;?>"/>
<input type="hidden" name="leftinsureSpace1" id="leftinsureSpace1" value="<?php echo $lleftinsureSpace1;?>"/>
<input type="hidden" name="topinsureSpace1" id="topinsureSpace1" value="<?php echo $topinsureSpace1;?>"/>
<input type="hidden" name="leftName" id="leftName" value="<?php echo $leftName;?>"/>
<input type="hidden" name="topName" id="topName" value="<?php echo $topName;?>"/>
<input type="hidden" name="leftinsureSpace2" id="leftinsureSpace2" value="<?php echo $leftinsureSpace2;?>"/>
<input type="hidden" name="topinsureSpace2" id="topinsureSpace2" value="<?php echo $topinsureSpace2;?>"/>
<input type="hidden" name="leftIdCard" id="leftIdCard" value="<?php echo $leftIdCard;?>"/>
<input type="hidden" name="topIdCard" id="topIdCard" value="<?php echo $topIdCard;?>"/>
<input type="hidden" name="leftBeneficiary" id="leftBeneficiary" value="<?php echo $leftBeneficiary;?>"/>
<input type="hidden" name="topBeneficiary" id="topBeneficiary" value="<?php echo $topBeneficiary;?>"/>
<input type="hidden" name="leftAinsuranceValue" id="leftAinsuranceValue" value="<?php echo $leftAinsuranceValue;?>"/>
<input type="hidden" name="topAinsuranceValue" id="topAinsuranceValue" value="<?php echo $topAinsuranceValue;?>"/>
<input type="hidden" name="leftinsureSpace3" id="leftinsureSpace3" value="<?php echo $leftinsureSpace3;?>"/>
<input type="hidden" name="topinsureSpace3" id="topinsureSpace3" value="<?php echo $topinsureSpace3;?>"/>
<input type="hidden" name="leftBinsuranceValue" id="leftBinsuranceValue" value="<?php echo $leftBinsuranceValue;?>"/>
<input type="hidden" name="topBinsuranceValue" id="topBinsuranceValue" value="<?php echo $topBinsuranceValue;?>"/>
<input type="hidden" name="leftPrice" id="leftPrice" value="<?php echo $leftPrice;?>"/>
<input type="hidden" name="topPrice" id="topPrice" value="<?php echo $topPrice;?>"/>
<input type="hidden" name="leftNoOfRunsID" id="leftNoOfRunsID" value="<?php echo $leftNoOfRunsID;?>"/>
<input type="hidden" name="topNoOfRunsID" id="topNoOfRunsID" value="<?php echo $topNoOfRunsID;?>"/>
<input type="hidden" name="leftNoOfRunsdate" id="leftNoOfRunsdate" value="<?php echo $leftNoOfRunsdate;?>"/>
<input type="hidden" name="topNoOfRunsdate" id="topNoOfRunsdate" value="<?php echo $topNoOfRunsdate;?>"/>
<input type="hidden" name="leftSaleTime" id="leftSaleTime" value="<?php echo $leftSaleTime;?>"/>
<input type="hidden" name="topSaleTime" id="topSaleTime" value="<?php echo $topSaleTime;?>"/>
<input type="hidden" name="leftAgentCode" id="leftAgentCode" value="<?php echo $leftAgentCode;?>"/>
<input type="hidden" name="topAgentCode" id="topAgentCode" value="<?php echo $topAgentCode;?>"/>
<input type="hidden" name="leftHandlerCode" id="leftHandlerCode" value="<?php echo $leftHandlerCode;?>"/>
<input type="hidden" name="topHandlerCode" id="topHandlerCode" value="<?php echo $topHandlerCode;?>"/>
<br/><br/>
<div style="margin-left:5px;">
	<img src="../ui/images/sj.gif" width="6" height="7" />&nbsp;当前票号：
	<input type="text" name="newTicketID" id="newTicketID" size="10" value="<?=$newTicketID?>" readonly="readonly" style="height:18;border:none"/>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../ui/images/sj.gif" width="6" height="7" />&nbsp;保险票号：
	<input type="text" name="newSafeTicketID" id="newSafeTicketID" size="10" value="<?=$newSafeTicketID?>" readonly="readonly" style="height:18;border:none"/>
&nbsp;&nbsp;&nbsp;<input id="sellInsureTicket" name="sellInsureTicket" type="checkbox"/>售保险票
&nbsp;&nbsp;<input id="multiTicket" name="multiTicket" type="checkbox"/>售多地票
&nbsp;&nbsp;&nbsp;<input type="button" name="sellview" id="sellview" style="height:18;text-align:center;font-size:12px;" value="售 票 预 览" <?=$viewenable?> />
</div>
<br/>
<div id="showIDs" style="margin-left:5px;">
	<img src="../ui/images/sj.gif" width="6" height="7" />&nbsp;所有身份证号：
	<input type="text" name="safeUserIDCards" id="safeUserIDCards" size="200" value="<?=$safeUserIDCards?>" style="height:18;border:none" />
	<input type="hidden" name="safeUsers" id="safeUsers" size="200" value="<?=$safeUsers?>" style="height:18;" />
	<input type="hidden" name="safeUserAddresses" id="safeUserAddresses" size="200" value="<?=$safeUserAddresses?>" style="height:18;" />
</div>
</form>
</body>
</html>
