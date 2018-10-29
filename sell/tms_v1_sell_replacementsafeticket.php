<?php 
//补保险票界面
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

require_once("tms_v1_sell_sellprintdata.php");
require_once("tms_v1_sell_insureprintdata.php");
require_once("tms_v1_sell_getPrinterName.php");

if(isset($_POST['ticketnum'])){
	$ticketnum=$_POST['ticketnum'];
	$ticketnum1=$_POST['ticketnum1'];
	$tnum=$_POST['tnum'];
	$safemoney=$_POST['safeticketmoneyselect'];
	$IsContinuou=$_POST['IsContinuou'];
	$curTicketID=$_POST['curTicketID'];
	$newTicketID=$_POST['newTicketID'];
	$leftTicketNum=$_POST['leftTicketNum'];
	$curSafeTicketID=$_POST['curSafeTicketID'];
	$newSafeTicketID=$_POST['newSafeTicketID'];
	$leftSafeTicketNum=$_POST['leftSafeTicketNum'];	
}else{
//取得客票号
	$strsqlselet = "SELECT `tp_CurrentTicket`,`tp_InceptTicketNum` FROM `tms_bd_TicketProvide` WHERE `tp_InceptUserID` = '$userID'
				AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '客票' ORDER BY tp_ProvideData ASC";
	$resultselet = $class_mysql_default->my_query("$strsqlselet");
	$rows = @mysqli_fetch_array($resultselet);
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
	$strsqlselet = "SELECT `tp_CurrentTicket`,`tp_InceptTicketNum` FROM `tms_bd_TicketProvide` WHERE `tp_InceptUserID` = '$userID'
				AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '保险票' ORDER BY tp_ProvideData ASC";
	$resultselet = $class_mysql_default->my_query("$strsqlselet");
	$rows = @mysqli_fetch_array($resultselet);
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
	<title>补保险票界面</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
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
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script>
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
    //	document.getElementById("sellview").focus();
	}
	function printTicket(objData, PrintTicket)
	{
		var allKPData = "";
		var allBXData = "";
		var tickets=0;
		var safetickets=0;
		//alert(objData.length);
		for(var i=0; i< objData.length; i++){
			if(objData[i].SellPrice!="0"){
				tickets=tickets+1;
			}
			if(objData[i].SafetyTicketMoney != "0"){
				safetickets=safetickets+1;
			}
		}
		for (var i = 0; i < objData.length; i++) {
		//	alert(objData[i].SellPrice)
		//	alert(objData[i].SafetyTicketMoney)
			if(objData[i].SellPrice != "0"){
				if(objData[i].isAllTicket == "1")	objData[i].SeatID = "XX";
				var str1;
			//	if(i == objData.length - 1)	str1 = '<div>';
				if(i==tickets-1) str1 = '<div>';
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
			}		
			if (objData[i].SafetyTicketMoney != "0"){
			//	alert(objData[i].SyncCode+','+objData[i].Name+','+objData[i].IdCard+','+objData[i].Beneficiary+','+objData[i].AInsuranceValue+','+objData[i].BInsuranceValue+','+objData[i].SafetyTicketMoney+','+objData[i].NoOfRunsID+','+objData[i].NoOfRunsdate+','+objData[i].BeginStationTime+','+objData[i].SaleTime+','+objData[i].HandlerCode+','+objData[i].AgentCode+',');
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
		
		window.location.assign('tms_v1_sell_replacementsafeticket.php');
	}
	$(document).ready(function(){
		Init();
	//	document.getElementById("ticketnum").focus();
		$("#ticketnum").keydown(function(event) {
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 16) {	//shift key
        		document.getElementById("safeticketnum").focus();
            }
        });
		$("#safeticketnum").keydown(function(event) {
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 16) {	//shift key
        		document.getElementById("getTicketInfo").focus();
            }
        });
		$("#getTicketInfo").keydown(function(event) {
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 13) {	//enter key
                getticketinfo();
        	//	document.getElementById("reprintConfirm").focus();
            }
        });
        
		$("#getTicketInfo").click(function(){
			 getticketinfor();
		});
		$("#reprintConfirm").click(function(){
			var objData,PrintTicket;
			var printThis = false;
			if(document.form1.ticketnum1.value=="" && document.form1.safeticketnum1.value==""){
				alert("请确认客票或保险票信息！");
				return false;
			}
			var ticketID=document.form1.ticketnum.value.split("\r\n");
	//		var safeticketID=document.form1.safeticketnum1.value.split("\r\n");
			var nticketID = ticketID.sort();
	//		var nsafeticketID=safeticketID.sort();
	//		if (document.getElementById("leftTicketNum").value < nticketID.length){
	//			var val = document.getElementById("leftTicketNum").value; 
	//			alert("本次客票票据数量不够！余票数："+ val);
	//			document.getElementById("ticketnum").focus();
	//			return false;
	//		} 
			if (document.form1.leftSafeTicketNum.value <nticketID.length){
				var val = document.form1.leftSafeTicketNum.value; 
				alert("本次保险票据数量不够！余票数："+ val);
			//	document.form1.safeticketnum.focus();
				return false;
			}
			 if (($("#safeUserIDCards").val().split(";").length - 1) < $("#tnum").val() * 1) {
					var total = $("#tnum").val() * 1;
					alert("身份证信息数量 " + ($("#safeUserIDCards").val().split(";").length - 1) + " 小于补保险售数量 " + total + "，请补入！");
             		document.getElementById("safeUserIDCardIn").focus();
					return false;
				}
			 if (document.getElementById("getticketmoney").value - document.getElementById("realticketmoney").value < 0) {
					alert("实收款金额不足！");
					document.getElementById("getticketmoney").focus();
					return false;
				}
		//	alert($("#safeticketmoneyselect").val());
			$.ajax({
				type : "get",
				url : "tms_v1_sell_sell.php",
				data : {'op': 'confirmsupsafeticket', 'st_TicketID': $("#ticketnum").val(),'curSafeTicketID':$("#curSafeTicketID").val(),'SafetyTicketMoney':$("#safeticketmoneyselect").val(),
				'SafetyID': $("#safeUserIDCards").val(),'safeUser':$("#safeUsers").val(),'safeUserAddress':$("#safeUserAddresses").val(),'time': Math.random()},
				async : false,
				success : function(data){
					objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						alert(objData.retString);
					}
					else{
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
			if(printThis){
				document.getElementById("reticketmoney").value = document.getElementById("getticketmoney").value - document.getElementById("realticketmoney").value;
				alert("找零后点击确定打票！");
				printTicket(objData, PrintTicket);
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
				if($("#safeUserIDCards").val().split(";").length > $("#tnum").val() * 1) {
					document.getElementById("getticketmoney").focus();
					//document.getElementById("reprintConfirm").focus();
				}
				else {
					$("#safeUserIDCardIn").val("");
                	document.getElementById("safeUserIDCardIn").focus();
				}
	        }
        });
	});
	function checkcertificatenumber(certificatenumber){
		var str=certificatenumber;
		var Expression=/^(\d{18,18}|\d{15,15}|\d{17,17}[xX])$/;
		if(Expression.test(str)==true){
			return true;
		}else {
			return false;
		}
	}
	function getticketinfor(){
		var strticket='';
		if (document.getElementById("IsContinuou").value=='1'){
			if (document.form1.ticketnum1.value == "") {
				alert("请输入客票号！");
			//	document.form1.ticketnum1.focus();
			}else {
				if(document.form1.tnum.value=="" || document.form1.tnum.value=='0'){
					document.form1.tnum.value=1;
				}
				if(document.getElementById("IsContinuou").value==1 && document.getElementById("ticketnum1").value!=''){
					for(var i=0; i<document.getElementById("tnum").value;i++){
			            var newstr='';
						var newvalue=document.getElementById("ticketnum1").value*1+i;
						for(var j=0;j<document.getElementById("ticketnum1").value.length-String(newvalue).lenght;j++){
							 newstr=newstr+'0';
						}
						newstr=newstr+String(newvalue);
						strticket=strticket+newstr+'\r\n';
					}
					document.getElementById("ticketnum").value=strticket;
				} 
			}
		}else{
			if (document.form1.ticketnum.value == "") {
				alert("请输入客票号！");
				document.form1.ticketnum.focus();
			}else{
				var ticketID=document.form1.ticketnum.value.split("\r\n");
				var nticketID = ticketID.sort();
				document.getElementById("tnum").value=nticketID.length;
				for(var i = 0; i < nticketID.length - 1; i++){
				    if (nticketID[i] == nticketID[i+1]){
				        alert("重复票号：" + nticketID[i] +"将被删除");
				        document.getElementById("ticketnum").value=document.getElementById("ticketnum").value.replace(nticketID[i+1]+"\r\n",'');
				        document.getElementById("tnum").value=document.getElementById("tnum").value-1;
				     //   document.form1.ticketnum.focus();
				        return;
				    }
				}
			}
		}  
		jQuery.get(
			'tms_v1_sell_sell.php',
			{'op': 'GETRITICKETINFO','IsContinuou':$("#IsContinuou").val(),'ticketnum1':$("#ticketnum1").val(), 'st_TicketID': $("#ticketnum").val(),
				'tnum': $("#tnum").val(), 'time': Math.random()},
			function(data){
				//alert(data);
				var objData = eval('(' + data + ')');
				if(objData.unsell!='票号：不存在或未售出！'){
					alert(objData.unsell);
				}
				if(objData.errored!='票号：已废！'){
					alert(objData.errored);
				}
				if(objData.returned!='票号：已退！'){
					alert(objData.returned);
				}
				if(objData.selled){
					document.getElementById("ticketnum").value=objData.selled;
				}else{
					document.getElementById("ticketnum").value='';
				}
				document.getElementById("tnum").value=objData.num;
				if(document.getElementById("tnum").value==0){
					document.getElementById("tnum").value='';
				}
				if(document.getElementById("IsContinuou").value==1){
					var str=document.getElementById("ticketnum").value.split("\r\n");
					document.getElementById("ticketnum1").value=str[0];
				}
				if(document.getElementById("ticketnum").value!=''){
					document.form1.submit();
				}
		}); 
	}
	function changecontinous(){
		if(document.getElementById("IsContinuous").checked){
			document.getElementById("IsContinuou").value='1';
			document.getElementById("Continuousname").style.display='';
			document.getElementById("Continuous").style.display='';
			document.getElementById("Uncontinuousname").style.display='none';
			document.getElementById("Uncontinuous").style.display='none';
		}else{
			document.getElementById("IsContinuou").value='0';
			document.getElementById("Continuousname").style.display='none';
			document.getElementById("Continuous").style.display='none';
			document.getElementById("Uncontinuousname").style.display='';
			document.getElementById("Uncontinuous").style.display='';
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
	$(document).ready(function(){
		if(document.getElementById("ticketnum").value!=""){
			document.getElementById("reprintConfirm").disabled=false;
		}
		else{
			document.getElementById("reprintConfirm").disabled=true;
		}
		$("#safeticketmoneyselect").change(function(){
			if(document.getElementById("ticketnum").value){
				var ticketID=document.form1.ticketnum.value.split("\r\n");
				var nticketID = ticketID.sort();
				document.getElementById("tnum").value=nticketID.length;
			} 
			if(document.getElementById("tnum").value){
				document.getElementById("realticketmoney").value=document.getElementById("safeticketmoneyselect").value*1*document.getElementById("tnum").value;
				document.getElementById("realticketmoneys").value=document.getElementById("safeticketmoneyselect").value*1*document.getElementById("tnum").value;
			}
		});
	});
	$(document).ready(function(){
		$("#ticketnum").keyup(function(){
			document.getElementById("reprintConfirm").disabled=true;
		});
	});
	$(document).ready(function(){
		$("#ticketnum1").keyup(function(){
			document.getElementById("reprintConfirm").disabled=true;
		});
		$("#tnum").keyup(function(){
			document.getElementById("reprintConfirm").disabled=true;
		});
	});
	function isnumber(number,id){
		if(isNaN(number)){
			alert(number+"不是数字！");
			document.getElementById(id).value='';
			return false;
		}
		if(document.getElementById(id).value!=""){
			if(parseInt(number)!=number){
				alert("请输入整数");
				document.getElementById(id).value="";
				}
			return false;
			}
	}
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff" width="100%" ><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">补 保 险 票 界 面</span></td>
  </tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
   <td nowrap="nowrap" bgcolor="#FFFFFF">
    	<input type="hidden" name="IsContinuou" id="IsContinuou" value="<?php if($IsContinuou==1 || $IsContinuou=='') echo '1'; else echo '0';?>"/>
    	<input type="checkbox" name="IsContinuous" id="IsContinuous" <?php if($IsContinuou==1 || $IsContinuou=='') echo 'checked';?> onclick="changecontinous()"/>是否连续票号
    </td>	     
  	<td nowrap="nowrap" id="Uncontinuousname" style="display:<?php if($IsContinuou==1 || $IsContinuou=='') echo 'none'; else echo '';?>" bgcolor="#FFFFFF">
  		<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 票号：</span>
  	</td>
	<td nowrap="nowrap" id="Uncontinuous" style="display:<?php if($IsContinuou==1 || $IsContinuou=='') echo 'none'; else echo '';?>" bgcolor="#FFFFFF">
		<textarea name="ticketnum" id="ticketnum" cols="" rows=""><?php echo $ticketnum; ?></textarea>
	</td>
    <td nowrap="nowrap" id="Continuousname" bgcolor="#FFFFFF" style="display:<?php if($IsContinuou==1 || $IsContinuou=='') echo ''; else echo 'none';?>">
    	<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开始票号：</span>
    </td>
    <td nowrap="nowrap" id="Continuous" bgcolor="#FFFFFF" style="display:<?php if($IsContinuou==1 || $IsContinuou=='') echo ''; else echo 'none';?>">
    	<input type="text" name="ticketnum1" id="ticketnum1" value="<?php echo $ticketnum1;?>"/><input type="text" name="tnum" id="tnum" style="width:50px;" value="<?php if($ticketnum1) echo $tnum;?>" onkeyup="return isnumber(this.value,this.id)" />张
    </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保险金额：</span></td>
	<td nowrap="nowrap" bgcolor="#FFFFFF">
		<select name="safeticketmoneyselect" id="safeticketmoneyselect">
		<?php 
			$sql1="SELECT it_InsureProductName,it_Price FROM tms_bd_InsureType WHERE it_Price='{$safemoney}'"; 
      		$query1 =$class_mysql_default->my_query($sql1);
      		$result1=mysqli_fetch_array($query1);
      		if($result1['it_Price']){
		?>
		<option value="<?php echo $safemoney;?>"><?php echo $result1['it_InsureProductName'].'('.$result1['it_Price'].'元)';?></option>
			<?php
      		}
				$sql="SELECT it_InsureProductName,it_Price FROM tms_bd_InsureType"; 
      			$query =$class_mysql_default->my_query($sql);
				while($result=mysqli_fetch_array($query)){
					if($result['it_Price']!=$safemoney){ 
			?>
			<option value="<?php echo $result['it_Price'];?>"><?php echo $result['it_InsureProductName'].'('.$result['it_Price'].'元)';?></option>
			<?php
					} 
				}
			?>
		</select>&nbsp;
	</td>
  </tr>
  <tr>
	<td nowrap="nowrap" bgcolor="#FFFFFF">
		<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 身份证号：</span>
		<input type="hidden" id="safeUser" name="safeUser" value="unknown" />
		<input type="hidden" id="safeUserAddress" name="safeUserAddress" value="unknown" />
	</td>
	<td  nowrap="nowrap" bgcolor="#FFFFFF">
		<input type="text" name="safeUserIDCardIn" id="safeUserIDCardIn" value="<?php echo $safeUserIDCard?>" <?php echo $readonly?> />
		<input type="button" name="readIDCard" id="readIDCard" style="font-size:13px;"value="读卡" onclick="readCard()" <?php echo $viewenable?> />
	</td>
	<td colspan="3" nowrap="nowrap" bgcolor="#FFFFFF">
		<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 实收金额：</span>
		<input name="getticketmoney" id="getticketmoney" size="10" type="text" onkeyup="return isnumber(number,id)"/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 应收金额：</span>
		<input name="realticketmoney" id="realticketmoney" type="hidden" value="<?php if($safemoney!=0) echo $safemoney*$tnum;?>"/>
		<input name="realticketmoneys" id="realticketmoneys" type="text" size="5" readonly="readonly" value="<?php if($safemoney!=0) echo $safemoney*$tnum;?>" style="height:22;border:none;color:RED;font-size:22;"/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 找零：</span>
		<input name="reticketmoney" id="reticketmoney" type="text" size="5" readonly="readonly" style="height:22;border:none;color:BLUE;font-size:22"/>
	</td>
</tr>
<tr>
	<td align="center" colspan="3" bgcolor="#FFFFFF">
    	<input id="getTicketInfo" name="getTicketInfo" type="button" value="客票信息确认" />&nbsp;&nbsp;&nbsp;
    	<input id="reprintConfirm" name="reprintConfirm" type="button" value="补保险票" />&nbsp;&nbsp;&nbsp;
    	<input type="button" name="back" id="back" value="返回"  onclick="location.assign('tms_v1_sell_query.php')"/>
	</td>
	<td align="center" colspan="2" bgcolor="#FFFFFF" nowrap="nowrap">
    	当前客票号：<?php echo $curTicketID;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	当前保险票号：<?php echo $curSafeTicketID;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</td>
  </tr>
</table>
<?php
	if(isset($_POST['ticketnum1'])){ 
		if($ticketnum){
	?>
			<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder">
				<tr>
					<td colspan="11" bgcolor="#FFFFFF" style="font-size:11pt;font-family:黑体;"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 客票信息：</td>
				</tr>
			</table>
			<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder">
			  <tr>
			   	<th nowrap="nowrap" align="center" bgcolor="#006699">票号</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
			    <th nowrap="nowrap"" align="center" bgcolor="#006699">上车站</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">到达站</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">票价</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">票型</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">座位号</th>
			  </tr>
	<?php 
			foreach (explode("\n",$ticketnum) as $key =>$ticketIDs){
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
	?>
			<tr>
				<td nowrap="nowrap" align="center"><?php echo $rows['st_TicketID'];?></td>
		        <td nowrap="nowrap" align="center"><?php echo $rows['st_NoOfRunsID'];?></td>
		        <td nowrap="nowrap" align="center"><?php echo $rows['st_NoOfRunsdate'];?></td>
		        <td nowrap="nowrap" align="center"><?php echo $rows['st_BeginStationTime'];?></td>
		        <td nowrap="nowrap" align="center"><?php echo $rows['st_FromStation'];?></td>
		        <td nowrap="nowrap" align="center"><?php echo $rows['st_ReachStation'];?></td>
		        <td nowrap="nowrap" align="center"><?php echo $rows['st_SellPrice'];?></td>
		        <td nowrap="nowrap" align="center"><?php echo $rows['st_SellPriceType'];?></td>
		        <td nowrap="nowrap" align="center"><?php echo $rows['st_SeatID'];?></td>
		   </tr>
    <?php
				}
			}
	?>
		</table>
	<?php 
		}
	}
	?>	
	<input type="hidden" name="curTicketID" id="curTicketID" value="<?php echo $curTicketID;?>"/>
	<input type="hidden" name="newTicketID" id="newTicketID" value="<?php echo $newTicketID;?>"/>
	<input type="hidden" name="leftTicketNum" id="leftTicketNum" value="<?php echo $leftTicketNum;?>"/>
	<input type="hidden" name="curSafeTicketID" id="curSafeTicketID" value="<?php echo $curSafeTicketID;?>"/>
	<input type="hidden" name="newSafeTicketID" id="newSafeTicketID" value="<?php echo $newSafeTicketID;?>"/>
	<input type="hidden" name="leftSafeTicketNum" id="leftSafeTicketNum" value="<?php echo $leftSafeTicketNum;?>"/>
	
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
<div id="showIDs" style="margin-left:5px;">
	<img src="../ui/images/sj.gif" width="6" height="7" />&nbsp;所有身份证号：
	<input type="text" name="safeUserIDCards" id="safeUserIDCards" size="100" value="<?php echo $safeUserIDCards?>" style="height:18;border:none" />
	<input type="hidden" name="safeUsers" id="safeUsers" size="100" value="<?php echo $safeUsers?>" style="height:18;" />
	<input type="hidden" name="safeUserAddresses" id="safeUserAddresses" size="100" value="<?php echo $safeUserAddresses?>" style="height:18;" />
</div>
</form>
</body>
</html>

