<?
//结算单打印页面

//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

require_once("tms_v1_checkin_balanceprintdata.php");
require_once("../sell/tms_v1_sell_getPrinterName.php");

$ConsignMoney=0;
$error=0; 
$BalanceNo='';
$op=$_GET['op'];
if($op == 'reprint'){
	$ReportDateTime=$_GET['RDT'];
	$cbNo=$_GET['cbNo'];
	if($cbNo=='nonumber'){//重打正常结算单
		$curBalanceNo=$_GET['BNO'];
		$BalanceNo=$_GET['BNO'];
	}else{//重打作废结算单
		$error=1;
		$curBalanceNo=$cbNo;
		$BalanceNo=$_GET['BNO'];
	}
	$select="SELECT bht_NoOfRunsID,bht_BusUnit,bht_BusID,bht_BusNumber,bht_BusModelID,bht_BusModel,bht_NoOfRunsdate,bht_ServiceFee,bht_otherFee1,bht_otherFee2,bht_otherFee3,bht_otherFee4,
		bht_otherFee5,bht_otherFee6,bht_CheckTotal,bht_PriceTotal,bht_EndStation,bht_ConsignMoney,bht_BalanceMoney FROM tms_acct_BalanceInHandTemp WHERE bht_BalanceNO='{$BalanceNo}'";
	$query=$class_mysql_default->my_query("$select");
	if(!$query)
		echo "<script>alert('读取客凭数据失败！');history.back();</script>";
	$rows = mysql_fetch_array($query);
	$NoOfRunsID=$rows['bht_NoOfRunsID'];
	$NoOfRunsdate=$rows['bht_NoOfRunsdate'];
	$EndStation=$rows['bht_EndStation'];
	$BusUnit=$rows['bht_BusUnit'];
	$BusID=$rows['bht_BusID'];
	$BusNumber=$rows['bht_BusNumber'];
	$passengerNum=$rows['bht_CheckTotal'];
	$BusModelID=$rows['bht_BusModelID'];
	$BusModel=$rows['bht_BusModel'];
	$ConsignMoney=$rows['bht_ConsignMoney'];
	$sumMoney=$rows['bht_PriceTotal'];
	$sumServiceFee=$rows['bht_ServiceFee'];
	$sumOtherFee1=$rows['bht_otherFee1'];
	$sumOtherFee2=$rows['bht_otherFee1'];
	$sumOtherFee3=$rows['bht_otherFee3'];
	$sumOtherFee4=$rows['bht_otherFee4'];
	$sumOtherFee5=$rows['bht_otherFee5'];
	$sumOtherFee6=$rows['bht_otherFee6'];
	$BalanceMoney=$rows['bht_BalanceMoney'];
} else {
	$NoOfRunsID = $_GET['nrID'];
	$NoOfRunsdate = $_GET['nrDate'];
	$BusID = $_GET['bID'];
	$ReportDateTime=$_GET['RDT'];
	$EndStation = $_GET['eStat'];
	$curBalanceNo = $_GET['cbNo'];
	$ConsignMoney=0;
	//取得所需车辆信息
//	echo $NoOfRunsID.','.$NoOfRunsdate.','.$BusID.$EndStation.$curBalanceNo.','.$_GET['BNO'];
	$queryString = "SELECT `bi_BusNumber`, `bi_BusTypeID`, `bi_BusType`, `bi_BusUnit` FROM tms_bd_BusInfo WHERE bi_BusID = '$BusID'";
	$result = $class_mysql_default->my_query("$queryString");
	$rowsbus = mysql_fetch_array($result);
	$BusUnit = $rowsbus['bi_BusUnit'];
	$BusNumber = $rowsbus['bi_BusNumber'];
	$BusModelID=$rowsbus['bi_BusTypeID'];
	$BusModel=$rowsbus['bi_BusType'];
	
	//取得结算金额 （结算价是否区分半价和全价车票？如果区分，这里需要取出每条记录，单独处理）
/*	$queryString1 = "SELECT IFNULL(SUM(ct_TotalMan),0) AS ct_sumPerson, IFNULL(SUM(ct_SellPrice),0) AS ct_sumMoney, 
			IFNULL(SUM(ct_BalancePrice),0) AS ct_sumBalancePrice, IFNULL(SUM(ct_ServiceFee),0) AS ct_sumServiceFee, 
			IFNULL(SUM(ct_otherFee1),0) AS ct_sumOtherFee1, IFNULL(SUM(ct_otherFee2),0) AS ct_sumOtherFee2, ct_otherFee3, 
			IFNULL(SUM(ct_otherFee4),0) AS ct_sumOtherFee4, IFNULL(SUM(ct_otherFee5),0) AS ct_sumOtherFee5, 
			IFNULL(SUM(ct_otherFee6),0) AS ct_sumOtherFee6 FROM tms_chk_CheckTicket WHERE (ct_NoOfRunsID = '$NoOfRunsID') 
			AND (ct_NoOfRunsdate = '$NoOfRunsdate') AND (ct_BusID = '$BusID') ";*/
	if($_GET['BNO']=='none'){
		$selectLuggageCons="SELECT IFNULL(SUM(lc_ConsignMoney),0) AS ConsignMoney FROM tms_lug_LuggageCons WHERE lc_NoOfRunsID='{$NoOfRunsID}' AND lc_DeliveryDate='{$NoOfRunsdate}' AND lc_BusID='{$BusID}'
			AND lc_Status='已收货' AND lc_StationID='{$userStationID}' GROUP BY lc_NoOfRunsID,lc_DeliveryDate,lc_BusID,lc_Status,lc_StationID";
		$resultLuggageCons = $class_mysql_default->my_query("$selectLuggageCons");
		$rowLuggageCons = mysql_fetch_array($resultLuggageCons);
		$ConsignMoney=$rowLuggageCons['ConsignMoney'];
		$queryString1 = "SELECT IFNULL(SUM(ct_TotalMan),0) AS ct_sumPerson, IFNULL(SUM(ct_SellPrice),0) AS ct_sumMoney, 
			IFNULL(SUM(ct_BalancePrice),0) AS ct_sumBalancePrice, IFNULL(SUM(ct_ServiceFee),0) AS ct_sumServiceFee, 
			IFNULL(SUM(ct_otherFee1),0) AS ct_sumOtherFee1, IFNULL(SUM(ct_otherFee2),0) AS ct_sumOtherFee2, ct_otherFee3, 
			IFNULL(SUM(ct_otherFee4),0) AS ct_sumOtherFee4, IFNULL(SUM(ct_otherFee5),0) AS ct_sumOtherFee5, 
			IFNULL(SUM(ct_otherFee6),0) AS ct_sumOtherFee6 FROM tms_chk_CheckTicket WHERE (ct_NoOfRunsID = '$NoOfRunsID') 
			AND (ct_NoOfRunsdate = '$NoOfRunsdate') AND (ct_BusID = '$BusID') AND ct_FromStationID='{$userStationID}' AND (ct_BalanceNO is NULL)";
		$queryString2=" GROUP BY ct_NoOfRunsID,ct_NoOfRunsdate,ct_BusID"; 
		$queryString=$queryString1.$queryString2;
	}else{
		$BalanceNo=$_GET['BNO'];
		$slectBalanceInHandTemp="SELECT bht_ConsignMoney FROM tms_acct_BalanceInHandTemp WHERE bht_BalanceNO='{$BalanceNo}'";
		$resultBalanceInHandTemp = $class_mysql_default->my_query("$slectBalanceInHandTemp");
		$rowBalanceInHandTemp = mysql_fetch_array($resultBalanceInHandTemp);
		if($rowBalanceInHandTemp['bht_ConsignMoney']){
			$ConsignMoney=$rowBalanceInHandTemp['bht_ConsignMoney'];
		}else{
			$ConsignMoney=0;
		}
		$queryString = "SELECT IFNULL(SUM(ct_TotalMan),0) AS ct_sumPerson, IFNULL(SUM(ct_SellPrice),0) AS ct_sumMoney, 
			IFNULL(SUM(ct_BalancePrice),0) AS ct_sumBalancePrice, IFNULL(SUM(ct_ServiceFee),0) AS ct_sumServiceFee, 
			IFNULL(SUM(ct_otherFee1),0) AS ct_sumOtherFee1, IFNULL(SUM(ct_otherFee2),0) AS ct_sumOtherFee2, ct_otherFee3, 
			IFNULL(SUM(ct_otherFee4),0) AS ct_sumOtherFee4, IFNULL(SUM(ct_otherFee5),0) AS ct_sumOtherFee5, 
			IFNULL(SUM(ct_otherFee6),0) AS ct_sumOtherFee6 FROM tms_chk_CheckTicket WHERE ct_BalanceNO='{$BalanceNo}' GROUP BY ct_BalanceNO";
	}
	$result = $class_mysql_default->my_query("$queryString");
	if(!$result) echo mysql_error();
	$rows = mysql_fetch_array($result);
	$passengerNum = $rows['ct_sumPerson'];
	$sumServiceFee=$rows['ct_sumServiceFee'];
	$sumOtherFee1=$rows['ct_sumOtherFee1'];
	$sumOtherFee2=$rows['ct_sumOtherFee2'];
	$sumOtherFee3=$rows['ct_otherFee3'];
	$sumOtherFee4=$rows['ct_sumOtherFee4'];
	$sumOtherFee5=$rows['ct_sumOtherFee5'];
	$sumOtherFee6=$rows['ct_sumOtherFee6'];
	$sumMoney=$rows['ct_sumMoney'];
	
	/* 检票时已经求得结算价，这里不需重复计算 
	if($rows['ct_sumBalancePrice'] == 0) 
		$BalanceMoney = $rows['ct_sumMoney'] - $rows['ct_sumServiceFee'] - $rows['ct_sumOtherFee1'] - $rows['ct_sumOtherFee2']
			- ($row['ct_sumMoney'] - $row['ct_sumServiceFee']) * $row['ct_otherFee3'] - $rows['ct_sumOtherFee4'] - $rows['ct_sumOtherFee5'] - $rows['ct_sumOtherFee6'];
	else
		$BalanceMoney = $rows['ct_sumBalancePrice'];
	*/
	
	$BalanceMoney = $rows['ct_sumBalancePrice'];
/*	if($_GET['BNO']=='none'){
	//取得行包费
		$selectLuggageCons="SELECT IFNULL(SUM(lc_ConsignMoney),0) AS ConsignMoney FROM tms_lug_LuggageCons WHERE lc_NoOfRunsID='{$NoOfRunsID}' AND lc_DeliveryDate='{$NoOfRunsdate}' AND lc_BusID='{$BusID}'
			AND lc_Status='已收货' AND lc_StationID='{$userStationID}' GROUP BY lc_NoOfRunsID,lc_DeliveryDate,lc_BusID,lc_Status,lc_StationID";
		$resultLuggageCons = $class_mysql_default->my_query("$selectLuggageCons");
		$rowLuggageCons = mysql_fetch_array($resultLuggageCons);
		$ConsignMoney=$rowLuggageCons['ConsignMoney']; 
	}else{
		//若是注销后再打，行包费在注销的客凭中取(有可能在通票班次中没法处理)
		$BalanceNo1=$_GET['BNO'];
		$slectBalanceInHandTemp="SELECT bht_ConsignMoney FROM tms_acct_BalanceInHandTemp WHERE bht_BalanceNO='{$BalanceNo1}'";
		$resultBalanceInHandTemp = $class_mysql_default->my_query("$slectBalanceInHandTemp");
		$rowBalanceInHandTemp = mysql_fetch_array($resultBalanceInHandTemp);
	//	echo $rowBalanceInHandTemp['bht_ConsignMoney'].'ee'; 
		if($rowBalanceInHandTemp['bht_ConsignMoney']){
			$ConsignMoney=$rowBalanceInHandTemp['bht_ConsignMoney'];
		}else{
			$ConsignMoney=0;
		}
	} */	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>结算单打印</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/tms_v1_print.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript">
	function doPrintQD(printData) {
		var Wsh = new ActiveXObject("WScript.Shell");
		printPageSetup(Wsh);
		document.body.innerHTML = printData;
		document.body.insertAdjacentHTML("beforeEnd","<object id=\"WebBrowser\" width=0 height=0 classid=\"clsid:8856F961-340A-11D0-A96B-00C04FD705A2\">");
		WebBrowser.ExecWB(6,1); 
	} 

	function printBalanceSheet(objData, PrintTicket)
	{
		var printData = "";
		if(objData.length > 0) {//检票数不为零
			var NumberPeoples = 0;
			var AllMoney = 0;
			var iAllMoney = 0;
			var AllMoneyB = "";
			var numberB="";
			var numberA="";
			var BalanceMoneyB="";
			var PeopleDistance = 0;
			var str1 = '';
			var str2 = '<table style="width:'+ PrintTicket[0] + 'px;height:'+ PrintTicket[1] + 'px;margin-left:' + PrintTicket[2] + 'px;margin-top:' + PrintTicket[3] + 'px;font-size:'+ PrintTicket[4] +'px;border:0"><tr><td>';
			var str3 = '<div style="margin-top:'+PrintTicket[5]+'px;"><div style="margin-left:'+PrintTicket[6]+'px;float:left;">'+objData[0].stationName+'</div><div style="margin-left:'+PrintTicket[7]+'px;">&nbsp;</div></div>';
			var str4 = '<div style="margin-top:'+PrintTicket[8]+'px;"><div style="margin-left:'+PrintTicket[9]+'px;float:left;">&nbsp;</div><div style="margin-left:'+PrintTicket[10]+'px;">&nbsp;</div></div>';
			var str5 = '<div style="margin-top:'+PrintTicket[11]+'px;"><div style="margin-left:'+PrintTicket[12]+'px;float:left">' + objData[0].NoOfRunsdate + '&nbsp;&nbsp;' + objData[0].NoOfRunstime + '</div><div style="margin-left:'+PrintTicket[13]+'px;">' + objData[0].BalanceNo + '</div></div>';
			var str6 = '<div style="margin-top:'+PrintTicket[14]+'px;"><div style="margin-left:'+PrintTicket[15]+'px;float:left">' + objData[0].BusUnit + '<span style="margin-left:'+PrintTicket[16]+'px;">' + objData[0].BusNumber + '</span></div><div style="margin-left:'+PrintTicket[17]+'px;">' + objData[0].NoOfRunsID + '</div></div>';
			var str7 = '<div style="margin-top:'+PrintTicket[8]+'px;"><div style="margin-left:'+PrintTicket[9]+'px;float:left;"&nbsp;></div><div style="margin-left:'+PrintTicket[10]+'px;">&nbsp;</div></div>';
			printData= str1 + str2 + str3 + str4 + str5 + str6 + str7; 
			for(var i=0; i<5; i++){
				if(2*(i+1)<=objData.length){
					var str = '<div style="margin-top:'+PrintTicket[18]+'px;"><div style="margin-left:'+PrintTicket[19]+'px;float:left">' + objData[i].ReachStation + '<span style="margin-left:'+PrintTicket[20]+'px;">' + objData[i].Distance + '<span style="margin-left:'+PrintTicket[21]+'px;">' + objData[i].FullNumbers + '<span style="margin-left:'+PrintTicket[22]+'px;">' + objData[i].HalfNumbers + '<span style="margin-left:'+PrintTicket[23]+'px;">' + objData[i].FullPrice + '<span style="margin-left:'+PrintTicket[24]+'px;">' + objData[i].AllPrice + '</span></span></span></span></span></div><div style="margin-left:'+PrintTicket[25]+'px;">' + objData[i+1].ReachStation + '<span style="margin-left:'+PrintTicket[20]+'px;">' + objData[i+1].Distance + '<span style="margin-left:'+PrintTicket[21]+'px;">' + objData[i+1].FullNumbers + '<span style="margin-left:'+PrintTicket[22]+'px;">' + objData[i+1].HalfNumbers + '<span style="margin-left:'+PrintTicket[23]+'px;">' + objData[i+1].FullPrice + '<span style="margin-left:'+PrintTicket[24]+'px;">' + objData[i+1].AllPrice + '</span></span></span></span></span></div></div>';
					NumberPeoples = NumberPeoples*1 + objData[i].FullNumbers*1 + objData[i].HalfNumbers*1 + objData[i+1].FullNumbers*1 + objData[i+1].HalfNumbers*1;
					AllMoney = AllMoney*1 + objData[i].AllPrice*1 + objData[i+1].AllPrice*1;
					PeopleDistance = PeopleDistance*1 + (objData[i].FullNumbers  + objData[i].HalfNumbers) * objData[i].Distance + (objData[i+1].FullNumbers  + objData[i+1].HalfNumbers) * objData[i+1].Distance;
					printData = printData + str;
				}
				if(2*(i+1)-1>objData.length){
					var str = '<div style="margin-top:'+PrintTicket[8]+'px;"><div style="margin-left:'+PrintTicket[9]+'px;float:left;">&nbsp;</div><div style="margin-left:'+PrintTicket[10]+'px;">&nbsp;</div></div>';
					printData = printData + str;
				}
				if(2*(i+1)-1==objData.length){
					var str = '<div style="margin-top:'+PrintTicket[18]+'px;"><div style="margin-left:'+PrintTicket[19]+'px;float:left">' + objData[i].ReachStation + '<span style="margin-left:'+PrintTicket[20]+'px;">' + objData[i].Distance + '<span style="margin-left:'+PrintTicket[21]+'px;">' + objData[i].FullNumbers + '<span style="margin-left:'+PrintTicket[22]+'px;">' + objData[i].HalfNumbers + '<span style="margin-left:'+PrintTicket[23]+'px;">' + objData[i].FullPrice + '<span style="margin-left:'+PrintTicket[24]+'px;">' + objData[i].AllPrice + '</span></span></span></span></span></div><div style="margin-left:'+PrintTicket[10]+'px;">&nbsp;</div></div>';
					NumberPeoples = NumberPeoples*1 + objData[i].FullNumbers*1 + objData[i].HalfNumbers*1;
					AllMoney = AllMoney*1 + objData[i].AllPrice*1 ;
					PeopleDistance = PeopleDistance*1 + (objData[i].FullNumbers  + objData[i].HalfNumbers) * objData[i].Distance;
					printData = printData + str;
				}
			}  
			var str8 = '<div style="margin-top:'+PrintTicket[26]+'px;"><div style="margin-left:'+PrintTicket[27]+'px;float:left">' + NumberPeoples + '<span style="margin-left:'+PrintTicket[33]+'px;">' + PeopleDistance + '</span></div><div style="margin-left:'+PrintTicket[28]+'px;">' + AllMoney + '<span style="margin-left:'+PrintTicket[34]+'px;">' + objData[0].ConsignMoney + '</span></div></div>';
		//	var AllMoneyi = AllMoney * 100;
			var AllMoneyi = (AllMoney*1+objData[0].ConsignMoney*1)* 100;
			for(var i=6; i>=0; i--){
				iAllMoney = parseInt (AllMoneyi/Math.pow(10,i));
				AllMoneyi = AllMoneyi - (iAllMoney * Math.pow(10,i));
				switch(iAllMoney){
					case 0:
						numberB = "零";
						break;
					case 1:
						numberB = "壹";
						break;
					case 2:
						numberB = "贰";
						break;
					case 3:
						numberB = "叁";
						break;
					case 4:
						numberB = "肆";
						break;
					case 5:
						numberB = "伍";
						break;
					case 6:
						numberB = "陆";
						break;
					case 7:
						numberB = "柒";
						break;
					case 8:
						numberB = "捌";
						break;
					case 9:
						numberB = "玖";
						break;
					default: 
				}
				switch(i){
					case 6:
						numberA = "万";
						break;
					case 5:
						numberA = "仟";
						break;
					case 4:
						numberA = "佰";
						break;
					case 3:
						numberA = "拾";
						break;
					case 2:
						numberA = "元";
						break;
					case 1:
						numberA = "角";
						break;
					case 0:
						numberA = "分";
						break;
					default:
				} 
				BalanceMoneyB = BalanceMoneyB + numberB + numberA;
			}  
			var str9 = '<div style="margin-top:'+PrintTicket[29]+'px;"><div style="margin-left:'+PrintTicket[30]+'px;float:left">'+ BalanceMoneyB +'</div><div style="margin-left:'+PrintTicket[31]+'px;">' + objData[0].NoOfRunsdate + '&nbsp;' + objData[0].NoOfRunstime + '</div></div>';
			var str10 = '<div style="margin-top:'+PrintTicket[8]+'px;"><div style="margin-left:'+PrintTicket[9]+'px;float:left">&nbsp;</div><div style="margin-left:'+PrintTicket[32]+'px;float:left">' + objData[0].Balancer + '</div></div>';
			var str11 = '</td></tr></table>';
			printData = printData  + str8 + str9  + str10 + str11;
		}

		var cmd = 'C:\\Windows\\System32\\rundll32.exe'; 
		var para1 = 'printui.dll,PrintUIEntry'; 
		var para2 = '/y'; 
		var para3 = '/n'; 
		var para4 = '"' + $("#qdPrinterName").val() + '"';
		var Wsh = new ActiveXObject("WScript.Shell");
		printPageSetup(Wsh);
		if(printData != "" && para4 != '"none"') {
			Wsh.Run(cmd + ' ' + para1 + ' ' + para2 + ' ' + para3 + ' ' + para4);
			var windowFeatures = "width="+PrintTicket[0]+",height="+PrintTicket[1]+",top=0,left=0,directories=no,toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no";
			var printWin = window.open('','printWin',windowFeatures); 
			printSheet(printWin,printData);
		}
		//doPrintQD(printData);
		window.location.assign('tms_v1_checkin_checkticket.php?op=refresh');
	}
	function confirmPrint_stage1()
	{
		jQuery.get(
			'tms_v1_checkin_dataops.php',
			{'op': 'CONFIRMPRINT', 'NoOfRunsID': $("#NoOfRunsID").val(), 'NoOfRunsdate': $("#NoOfRunsdate").val(),	
				'EndStation': $("#EndStation").val(), 'BusUnit': $("#BusUnit").val(), 'BusID': $("#BusID").val(), 
				'BusNumber': $("#BusNumber").val(), 'passengerNum': $("#passengerNum").val(), 'BalanceMoney': $("#BalanceMoney").val(), 
				'BalanceNo': $("#curBalanceNo").val(),'sumServiceFee':$("#sumServiceFee").val(),'sumOtherFee1':$("#sumOtherFee1").val(),
				'sumOtherFee2':$("#sumOtherFee2").val(),'sumOtherFee3':$("#sumOtherFee3").val(),'sumOtherFee4':$("#sumOtherFee4").val(),
				'sumOtherFee5':$("#sumOtherFee5").val(),'sumOtherFee6':$("#sumOtherFee6").val(),'sumMoney':$("#sumMoney").val(),'ReportDateTime':$("#ReportDateTime").val(),
				'Number':$("#Number").val(),'BusModelID':$("#BusModelID").val(),'BusModel':$("#BusModel").val(),'ConsignMoney':$("#ConsignMoney").val(),
				'opp':$("#opp").val(),'error':$("#error").val(),'oldBalanceNo':$("#oldBalanceNo").val(),'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if(objData.retVal == "FAIL") { 
					if(confirm(objData.retString+"重试？"))
						location.reload();
					else
						location.assign('tms_v1_checkin_checkticket.php?op=refresh');
				}
				else {
					// stage1 succeed
					$("#data").val(data);
				}
		});
	}
	function confirmPrint_stage2()
	{
		if(confirm("打印结算单?")) {
			var data =  $("#data").val();
			var objData = eval('(' + data + ')');
			var PrintTicket=new Array(document.getElementById("width").value,document.getElementById("height").value, document.getElementById("left").value,
				document.getElementById("top").value, document.getElementById("fontsize").value, document.getElementById("topstationName").value,
				document.getElementById("leftstationName").value,document.getElementById("leftSpace1").value, document.getElementById("topSpace2").value,
				document.getElementById("leftSpace2").value, document.getElementById("leftSpace3").value, document.getElementById("topNoOfRunsdate").value,
				document.getElementById("leftNoOfRunsdate").value, document.getElementById("leftBalanceNo").value, document.getElementById("topBusUnit").value,
				document.getElementById("leftBusUnit").value, document.getElementById("leftBusNumber").value, document.getElementById("leftNoOfRunsID").value,
				document.getElementById("topReachStationL").value, document.getElementById("leftReachStationL").value,  document.getElementById("leftDistance").value,
				document.getElementById("leftFullNumbers").value, document.getElementById("leftHalfNumbers").value, document.getElementById("leftFullPrice").value,
				document.getElementById("leftAllPrice").value, document.getElementById("leftReachStationR").value, document.getElementById("toppassengerNum").value,
				document.getElementById("leftpassengerNum").value, document.getElementById("leftBalanceMoney").value, document.getElementById("topBalanceMoneyB").value,
				document.getElementById("leftBalanceMoneyB").value, document.getElementById("leftnowtime").value, document.getElementById("leftBalancer").value,
				document.getElementById("leftPeopleDistance").value,document.getElementById("leftConsignMoney").value);
			printBalanceSheet(objData, PrintTicket);
		}
		else 
			location.assign('tms_v1_checkin_checkticket.php?op=refresh');
	}
	$(document).ready(function(){
		confirmPrint_stage1();
		$("#confirmPrint").click(function(){
			confirmPrint_stage2();
		});
	});
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
		<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
		<span class="graytext" style="margin-left:8px;">结算单打印</span></td>
	</tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="1">
	<tr>
		<td colspan="6" bgcolor="#0083B5"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 结算单信息：</td>
	</tr>
	<tr>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 班次:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input type="text" name="NoOfRunsID" id="NoOfRunsID" value="<?=$NoOfRunsID?>" disabled="disabled" /></td>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 日期:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input type="text" name="NoOfRunsdate" id="NoOfRunsdate" value="<?=$NoOfRunsdate?>" disabled="disabled"/></td>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 终点站:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input type="text" name="EndStation" id="EndStation" value="<?=$EndStation?>" disabled="disabled" /></td>
	</tr>
	<tr>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input type="text" name="BusUnit" id="BusUnit" value="<?=$BusUnit?>" disabled="disabled" /></td>
<!-- 
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆编号:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input type="text" name="BusID" id="BusID" value="<?=$BusID?>" disabled="disabled" /></td>
 -->
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input type="text" name="BusNumber" id="BusNumber" value="<?=$BusNumber?>" disabled="disabled" /></td>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 人数:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input type="text" name="passengerNum" id="passengerNum" value="<?=$passengerNum?>" disabled="disabled"/></td>
	</tr>
	<tr>
<!--  
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 人数:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input type="text" name="passengerNum" id="passengerNum" value="<?=$passengerNum?>" disabled="disabled"/></td>
-->
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 结算金额:</span></td>
		<td width="10%" bgcolor="#FFFFFF">
			<input type="text" name="BalanceMoney" id="BalanceMoney" value="<?=$BalanceMoney?>" disabled="disabled" />
		</td>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 行包托运费:</span></td>
		<td width="10%" bgcolor="#FFFFFF">
			<input type="text" name="ConsignMoney" id="ConsignMoney" value="<?=$ConsignMoney?>" disabled="disabled"/></td>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 结算单号:</span></td>
		<td width="10%" bgcolor="#FFFFFF">
			<input style="background-color:#F1E6C2" type="text" name="curBalanceNo" id="curBalanceNo" value="<?=$curBalanceNo?>" disabled="disabled"/>
		</td>
	</tr>
	<tr>
		<td align="center" colspan="6">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="confirmPrint" name="confirmPrint" type="button" value="打印确认"/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="cancelPrint" name="cancelPrint" type="button" value="取消退出" onclick="window.location.href='tms_v1_checkin_checkticket.php';" />
		</td>
	</tr>
</table>
<input type="hidden" name="ReportDateTime" id="ReportDateTime" value="<?=$ReportDateTime?>"/>
<input type="hidden" name="sumServiceFee" id="sumServiceFee" value="<?=$sumServiceFee?>"/>
<input type="hidden" name="sumOtherFee1" id="sumOtherFee1" value="<?=$sumOtherFee1?>"/>
<input type="hidden" name="sumOtherFee2" id="sumOtherFee2" value="<?=$sumOtherFee2?>"/>
<input type="hidden" name="sumOtherFee3" id="sumOtherFee3" value="<?=$sumOtherFee3?>"/>
<input type="hidden" name="sumOtherFee4" id="sumOtherFee4" value="<?=$sumOtherFee4?>"/>
<input type="hidden" name="sumOtherFee5" id="sumOtherFee5" value="<?=$sumOtherFee5?>"/>
<input type="hidden" name="sumOtherFee6" id="sumOtherFee6" value="<?=$sumOtherFee6?>"/>
<input type="hidden" name="sumMoney" id="sumMoney" value="<?php echo $sumMoney;?>"/>
<input type="hidden" name="Number" id="Number" value="<?=$passengerNum?>"/>
<input type="hidden" name="BusModelID" id="BusModelID" value="<?=$BusModelID?>"/>
<input type="hidden" name="BusModel" id="BusModel" value="<?=$BusModel?>"/>
<input type="hidden" name="opp" id="opp" value="<?=$op?>"/>
<input type="hidden" name="BusID" id="BusID" value="<?=$BusID?>"/>
<input type="hidden" name="error" id="error" value="<?=$error?>"/>
<input type="hidden" name="oldBalanceNo" id="oldBalanceNo" value="<?=$BalanceNo?>"/>

<input type="hidden" name="qdPrinterName" id="qdPrinterName" value="<?php echo $qdName;?>"/>
<input type="hidden" name="data" id="data" value=""/>
<input type="hidden" name="width" id="width" value="<?=$width?>"/>
<input type="hidden" name="height" id="height" value="<?=$height?>" />
<input type="hidden" name="left" id="left" value="<?=$left?>" />
<input type="hidden" name="top" id="top" value="<?=$top?>" />
<input type="hidden" name="fontsize" id="fontsize" value="<?=$fontsize?>"/>
<input type="hidden" name="leftstationName" id="leftstationName" value="<?=$leftstationName?>" />
<input type="hidden" name="topstationName" id="topstationName" value="<?=$topstationName?>" />
<input type="hidden" name="leftSpace1" id="leftSpace1" value="<?=$leftSpace1?>" />
<input type="hidden" name="topSpace1" id="topSpace1" value="<?=$topSpace1?>" />
<input type="hidden" name="leftSpace2" id="leftSpace2" value="<?=$leftSpace2?>"/>
<input type="hidden" name="topSpace2" id="topSpace2" value="<?=$topSpace2?>" />
<input type="hidden" name="leftSpace3" id="leftSpace3" value="<?=$leftSpace3?>" />
<input type="hidden" name="topSpace3" id="topSpace3" value="<?=$topSpace3?>" />
<input type="hidden" name="leftNoOfRunsdate" id="leftNoOfRunsdate" value="<?=$leftNoOfRunsdate?>" />
<input type="hidden" name="topNoOfRunsdate" id="topNoOfRunsdate" value="<?=$topNoOfRunsdate?>" />
<input type="hidden" name="leftBalanceNo" id="leftBalanceNo" value="<?=$leftBalanceNo?>" />
<input type="hidden" name="topBalanceNo" id="topBalanceNo" value="<?=$topBalanceNo?>" />
<input type="hidden" name="leftBusUnit" id="leftBusUnit" value="<?=$leftBusUnit?>" />
<input type="hidden" name="topBusUnit" id="topBusUnit" value="<?=$topBusUnit?>" />
<input type="hidden" name="leftBusNumber" id="leftBusNumber" value="<?=$leftBusNumber?>" />
<input type="hidden" name="topBusNumber" id="topBusNumber" value="<?=$topBusNumber?>" />
<input type="hidden" name="leftNoOfRunsID" id="leftNoOfRunsID" value="<?=$leftNoOfRunsID?>" />
<input type="hidden" name="topNoOfRunsID" id="topNoOfRunsID" value="<?=$topNoOfRunsID?>" />
<input type="hidden" name="leftReachStationL" id="leftReachStationL" value="<?=$leftReachStationL?>" />
<input type="hidden" name="topReachStationL" id="topReachStationL" value="<?=$topReachStationL?>" />
<input type="hidden" name="leftDistance" id="leftDistance" value="<?=$leftDistance?>" />
<input type="hidden" name="topDistance" id="topDistance" value="<?=$topDistance?>" />
<input type="hidden" name="leftFullNumbers" id="leftFullNumbers" value="<?=$leftFullNumbers?>" />
<input type="hidden" name="topFullNumbers" id="topFullNumbers" value="<?=$topFullNumbers?>" />
<input type="hidden" name="leftHalfNumbers" id="leftHalfNumbers" value="<?=$leftHalfNumbers?>" />
<input type="hidden" name="topHalfNumbers" id="topHalfNumbers" value="<?=$topHalfNumbers?>" />
<input type="hidden" name="leftFullPrice" id="leftFullPrice" value="<?=$leftFullPrice?>" />
<input type="hidden" name="topFullPrice" id="topFullPrice" value="<?=$topFullPrice?>" />
<input type="hidden" name="leftAllPrice" id="leftAllPrice" value="<?=$leftAllPrice?>" />
<input type="hidden" name="topAllPrice" id="topAllPrice" value="<?=$topAllPrice?>" />
<input type="hidden" name="leftReachStationR" id="leftReachStationR" value="<?=$leftReachStationR?>" />
<input type="hidden" name="topReachStationR" id="topReachStationR" value="<?=$topReachStationR?>" />
<input type="hidden" name="leftpassengerNum" id="leftpassengerNum" value="<?=$leftpassengerNum?>" />
<input type="hidden" name="toppassengerNum" id="toppassengerNum" value="<?=$toppassengerNum?>" />
<input type="hidden" name="leftPeopleDistance" id="leftPeopleDistance" value="<?=$leftPeopleDistance?>" />
<input type="hidden" name="topPeopleDistance" id="topPeopleDistance" value="<?=$topPeopleDistance?>" />
<input type="hidden" name="leftBalanceMoney" id="leftBalanceMoney" value="<?=$leftBalanceMoney?>" />
<input type="hidden" name="topBalanceMoney" id="topBalanceMoney" value="<?=$topBalanceMoney?>" />
<input type="hidden" name="leftConsignMoney" id="leftConsignMoney" value="<?=$leftConsignMoney?>" />
<input type="hidden" name="topConsignMoney" id="topConsignMoney" value="<?=$topConsignMoney?>" />
<input type="hidden" name="leftBalanceMoneyB" id="leftBalanceMoneyB" value="<?=$leftBalanceMoneyB?>" />
<input type="hidden" name="topBalanceMoneyB" id="topBalanceMoneyB" value="<?=$topBalanceMoneyB?>" />
<input type="hidden" name="leftnowtime" id="leftnowtime" value="<?=$leftnowtime?>" />
<input type="hidden" name="topnowtime" id="topnowtime" value="<?=$topnowtime?>" />
<input type="hidden" name="leftBalancer" id="leftBalancer" value="<?=$leftBalancer?>" />
<input type="hidden" name="topBalancer" id="topBalancer" value="<?=$topBalancer?>" />
</form>
</body>
</html>
