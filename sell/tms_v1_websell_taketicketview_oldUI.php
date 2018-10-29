<?
/*
 * 售票预览页面
 * 	
 * 票版座位状态：0-可售；1-锁定待售；2-预留（电话订票；班次预留现在不用）；3-已售；4-已检；5-网上预订（未支付）；6-网上订票已支付；
 *  
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("tms_v1_sell_sellprintdata.php");
require_once("tms_v1_sell_insureprintdata.php");
require_once("../ui/inc/init.inc.php");

$seller = $userName;
$sellerID = $userID;
$sellerStation = $userStationName;

$safeTicketMoney = 0;
$readonly = "";
$viewenable = "";
$subcancelenable = "disabled";

//取得客票号
$strsqlselet = "SELECT `tp_CurrentTicket`,`tp_InceptTicketNum` FROM `tms_bd_TicketProvide` WHERE `tp_InceptUserID` = '$sellerID'
			AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '客票' ORDER BY tp_ProvideData ASC";
$resultselet = $class_mysql_default->my_query("$strsqlselet");
$rows = @mysqli_fetch_array($resultselet);
if (empty($rows[0])) echo "<script>if (!confirm('没有可用的客票票据！是否继续？')) location.assign('tms_v1_sell_query.php');</script>";
$curTicketID = $rows[0];
$leftTicketNum = $rows[1];

//取得保险票号
$strsqlselet = "SELECT `tp_CurrentTicket`,`tp_InceptTicketNum` FROM `tms_bd_TicketProvide` WHERE `tp_InceptUserID` = '$sellerID'
			AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '保险票' ORDER BY tp_ProvideData ASC";
$resultselet = $class_mysql_default->my_query("$strsqlselet");
$rows = @mysqli_fetch_array($resultselet);
if (empty($rows[0])) echo "<script>if (!confirm('没有可用的保险票据！是否继续？')) location.assign('tms_v1_sell_query.php');</script>";
$curSafeTicketID = $rows[0];
$leftSafeTicketNum = $rows[1];
	
if (isset($_POST['sellview'])) {
	$noofrunsID = $_POST['noofrun'];
	$norunsdate = $_POST['departuredate'];
	$fromplace = $_POST['fromstation'];
	$reachplace = $_POST['reachstation'];
	$norunstime = $_POST['departuretime'];
	$tnum = $_POST['fullTicketNum'];
  	$htnum = $_POST['halfTicketNum'];
  	$curTicketID = $_POST['ticketID'];
  	$curSafeTicketID = $_POST['safeTicketID'];
  	$safeTicketMoney = $_POST['safeTicketMoney'];
  	$safeUserIDCard = $_POST['safeUserIDCard'];
  	$leftseats=$_POST['leftseats'];
  	$seatno=$_POST['seatNo'];
  	$WebSellID=$_POST['WebSellID'];
  	
  	$readonly = "readonly";
	$viewenable = "disabled";
	$subcancelenable = "";  	
	
	//取得票价
  	$strsqlselet = "SELECT pd_FullPrice FROM tms_bd_PriceDetail WHERE (pd_FromStation = '$fromplace') 
  			AND (pd_ReachStation = '$reachplace') AND (pd_NoOfRunsID = '$noofrunsID') AND (pd_NoOfRunsdate = '$norunsdate')";
  	//echo $strsqlselet;
  	$resultselet = $class_mysql_default->my_query("$strsqlselet");
  	$rows = @mysqli_fetch_array($resultselet);
  	$fullPrice = $rows[0];
  	
  	//取得车型
  	$strsqlselet = "SELECT tml_BusModel, tml_Allticket FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$noofrunsID') AND (tml_NoOfRunsdate = '$norunsdate')";
  	$resultselet = $class_mysql_default->my_query("$strsqlselet");
  	$rows = @mysqli_fetch_array($resultselet);
	$busModel = $rows[0];
	$isAllTicket = $rows[1];
	
/*  	//取得座位号
	//$strsqlselet = "LOCK TABLES tms_bd_TicketMode WRITE";
  	//$strsqlselet = "SELECT tml_SeatStatus, tml_LeaveSeats FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$noofrunsID') AND (tml_NoOfRunsdate = '$norunsdate') LOCK IN SHARE MODE";
  	$strsqlselet = "SELECT tml_SeatStatus, tml_LeaveSeats FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$noofrunsID') 
  				AND (tml_NoOfRunsdate = '$norunsdate') FOR UPDATE";
  	$class_mysql_default->my_query("BEGIN");
  	$resultselet = $class_mysql_default->my_query("$strsqlselet");
  	$rows = @mysqli_fetch_array($resultselet);
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
	$strsqlselet = "UPDATE tms_bd_TicketMode SET tml_SeatStatus = '$rows[0]', tml_LeaveSeats = '$rows[1]' 
				 WHERE (tml_NoOfRunsID = '$noofrunsID') AND (tml_NoOfRunsdate = '$norunsdate')";
  	$resultselet = $class_mysql_default->my_query("$strsqlselet");
	if($resultselet) {
		$class_mysql_default->my_query("COMMIT");
		$leftseats = $rows[1];
	}
	else {
		$class_mysql_default->my_query("ROLLBACK");
		echo "<script>alert('获取座位失败！');history.back();</script>"; 
	} */
	//$class_mysql_default->my_query("UNLOCK TABLES");
}
else {
	$WebSellID=$_GET['WebSellID'];
	$safeUser=$_GET['safeUser'];
	$safeUserAddress=$_GET['safeUserAddress'];
	
	//取得班次、发车日期、时间、出发站、到达站、总人数、售票金额、全票人数、半票人数
	$selectweb="SELECT wst_BeginStationTime,wst_NoOfRunsdate,wst_FromStation,wst_ReachStation,wst_TotalMan,wst_SellPrice,wst_FullNumber,wst_HalfNumber,
		wst_NoOfRunsID,wst_SeatID,wst_CertificateNumber FROM tms_websell_WebSellTicket WHERE wst_WebSellID='{$WebSellID}'";
	$queryweb =$class_mysql_default->my_query($selectweb);
	//if (!$queryweb) echo "SQL错误：".$class_mysql_default->my_error();
	$rowweb=@mysqli_fetch_array($queryweb);
	//取得剩余座位数
	$selectmode="SELECT tml_LeaveSeats FROM tms_bd_TicketMode WHERE tml_NoOfRunsID ='{$rowweb['wst_NoOfRunsID']}' AND 
		tml_NoOfRunsdate ='{$rowweb['wst_NoOfRunsdate']}' ";
	$querymode =$class_mysql_default->my_query($selectmode);
	$rowmode=@mysqli_fetch_array($querymode);
	
	$tnum = $rowweb['wst_FullNumber'];
	$htnum = $rowweb['wst_HalfNumber'];
	$seatno =  $rowweb['wst_SeatID'];
	$noofrunsID = $rowweb['wst_NoOfRunsID'];
	$norunsdate = $rowweb['wst_NoOfRunsdate'];
	$fromplace = $rowweb['wst_FromStation'];
	$reachplace = $rowweb['wst_ReachStation'];
	$norunstime = $rowweb['wst_BeginStationTime'];
	$safeUserIDCard=$rowweb['wst_CertificateNumber'];
	if (isset($_POST['leftseats'])) {
		$leftseats = $_POST['leftseats'];
	} else {
		$leftseats = $rowmode['tml_LeaveSeats'];
	}
	if(empty($noofrunsID) || empty($norunsdate) || empty($fromplace) || empty($reachplace)) 
		echo "<script>alert('班次、日期、发车站和到达站不能为空！');location.assign('tms_v1_websell_taketicket.php');</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>售票预览</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/tms_v1_print.js"></script>
	<script type="text/javascript">
	function printTicket(objData, PrintTicket, returnurl)
	{
		var printData = "";
		var printDataAll = "";
		for (var i = 0; i < objData.length; i++) {
			if(objData[i].isAllTicket == "1")	objData[i].SeatID = "XX";
			var str1 = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" /></head><body>';
			var str2 = '<table style="width:'+PrintTicket[0]+'px;height:'+PrintTicket[1]+'px;margin-left:'+PrintTicket[2]+'px;margin-top:'+PrintTicket[3]+'px;font-size:'+PrintTicket[4]+'px;border:1"><tr><td>';
			var str3 = '<div style="margin-top:'+PrintTicket[5]+'px;"><div style="margin-left:'+PrintTicket[6]+'px;float:left;">'+objData[i].TicketID+'</div><div style="margin-left:'+PrintTicket[7]+'px;">'+objData[i].TicketID+'</div></div>';
			var str4 = '<div style="margin-top:'+PrintTicket[8]+'px;"><div style="margin-left:'+PrintTicket[9]+'px;float:left">' + objData[i].FromStation + '<span style="margin-left:'+PrintTicket[10]+'px;">' + objData[i].ReachStation + '</span></div><div style="margin-left:'+PrintTicket[11]+'px;">' + objData[i].FromStation + '<span style="margin-left:'+PrintTicket[12]+'px;">' + objData[i].ReachStation + '</span></div></div>';
			var str5 = '<div style="margin-top:'+PrintTicket[13]+'px;"><div style="margin-left:'+PrintTicket[14]+'px;float:left">' + objData[i].SellPrice + '<span style="margin-left:'+PrintTicket[15]+'px;">' + objData[i].SeatID + '</span></div><div style="margin-left:'+PrintTicket[16]+'px;">' + objData[i].SellPrice + '</div></div>';
			var str6 = '<div style="margin-top:'+PrintTicket[17]+'px;"><div style="margin-left:'+PrintTicket[18]+'px;float:left">' + objData[i].NoOfRunsID + '<span style="margin-left:'+PrintTicket[19]+'px;">' + objData[i].BeginStationTime + '</span></div><div style="margin-left:'+PrintTicket[20]+'px;">' + objData[i].NoOfRunsID + '</div></div>';
			var str7 = '<div style="margin-top:'+PrintTicket[21]+'px;"><div style="margin-left:'+PrintTicket[22]+'px;float:left">' + objData[i].NoOfRunsdate + '</div><div style="margin-left:'+PrintTicket[23]+'px;">' + objData[i].NoOfRunsdate + '</div></div>';
			var str8 = '<div style="margin-top:'+PrintTicket[24]+'px;"><div style="margin-left:'+PrintTicket[25]+'px;float:left">' + objData[i].SeatID + '</div></div>';
			var str9 = '<div style="margin-top:'+PrintTicket[26]+'px;"><div style="margin-left:'+PrintTicket[27]+'px;float:left">' + objData[i].SellerID + '</div></div>';
			var str10 = '</td></tr></table></body></html>';
			printData = str1 + str2 + str3 + str4 + str5 + str6 + str7 + str8 + str9 + str10;		
			printDataAll = printDataAll + printData;
			//alert(printData);
			window.document.body.innerHTML = printData;
			window.print();
			if (objData[i].SafetyTicketMoney != "0"){
				var str1 = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" /></head><body>';
				var str2 = '<table style="width:'+PrintTicket[28]+'px;height:'+PrintTicket[29]+'px;margin-left:'+PrintTicket[30]+'px;margin-top:'+PrintTicket[31]+'px;font-size:'+PrintTicket[32]+'px;border:1"><tr><td>';
				var str3 = '<div style="margin-top:'+PrintTicket[34]+'px;"><div style="margin-left:'+PrintTicket[33]+'px;float:left;">'+objData[i].SyncCode+'</div><div style="margin-left:'+PrintTicket[35]+'px;">&nbsp;</div></div>';
				var str4 = '<div style="margin-top:'+PrintTicket[38]+'px;"><div style="margin-left:'+PrintTicket[37]+'px;float:left">' + objData[i].Name + '</div><div style="margin-left:'+PrintTicket[39]+'px;">&nbsp;</div></div>';
				var str5 = '<div style="margin-top:'+PrintTicket[42]+'px;"><div style="margin-left:'+PrintTicket[41]+'px;float:left">' + objData[i].IdCard + '</div><div style="margin-left:'+PrintTicket[39]+'px;">&nbsp;</div></div>';
				var str6 = '<div style="margin-top:'+PrintTicket[44]+'px;"><div style="margin-left:'+PrintTicket[43]+'px;float:left">' + objData[i].Beneficiary + '</div><div style="margin-left:'+PrintTicket[39]+'px;">&nbsp;</div></div>';
				var str7 = '<div style="margin-top:'+PrintTicket[46]+'px;"><div style="margin-left:'+PrintTicket[45]+'px;float:left">' + objData[i].AInsuranceValue + '</div><div style="margin-left:'+PrintTicket[47]+'px;">&nbsp;</div></div>';
				var str8 = '<div style="margin-top:'+PrintTicket[50]+'px;"><div style="margin-left:'+PrintTicket[49]+'px;float:left">' + objData[i].BInsuranceValue + '</div><div style="margin-left:'+PrintTicket[47]+'px;">&nbsp;</div></div>';
				var str9 = '<div style="margin-top:'+PrintTicket[52]+'px;"><div style="margin-left:'+PrintTicket[51]+'px;float:left">' + objData[i].SafetyTicketMoney + '</div><div style="margin-left:'+PrintTicket[53]+'px;">' + objData[i].NoOfRunsID + '</div></div>';
				var str10 = '<div style="margin-top:'+PrintTicket[56]+'px;"><div style="margin-left:'+PrintTicket[55]+'px;float:left">' + objData[i].NoOfRunsdate +'&nbsp;'+ objData[i].BeginStationTime+'</div><div style="margin-left:'+PrintTicket[57]+'px;">' + objData[i].SaleTime + '</div></div>';
				var str11 = '<div style="margin-top:'+PrintTicket[60]+'px;"><div style="margin-left:'+PrintTicket[59]+'px;float:left">' + objData[i].AgentCode + '</div><div style="margin-left:'+PrintTicket[61]+'px;">' + objData[i].HandlerCode + '</div></div>';
				var str12 = '</td></tr></table></body></html>';
				printData = str1 + str2 + str3 + str4 + str5 + str6 + str7 + str8 + str9 + str10 + str11 + str12;	
				printDataAll = printDataAll + printData;
				//alert(printData);
				window.document.body.innerHTML = printData;
				window.print();
			}  
		}
		//window.location.href='tms_v1_websell_taketicket.php';
		window.location.href=returnurl;
	}
	$(document).ready(function(){
		$("#safeUserIDCardIn").keyup(function(e){
			if(e.keyCode == 13){
				// do nothing at this moment
			}
			else {
				$("#safeUserIDCardIn").val(e.value);
			}
		});
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
		$("#sellview").click(function(){
/*			if ((document.form1.fullTicketNumIn.value * 1 + document.form1.halfTicketNumIn.value * 1) == 0){
				alert("售票数为零！");
				document.form1.fullTicketNumIn.focus();
				return false;
			}
			else if (document.form1.leftseats.value < (document.form1.fullTicketNumIn.value * 1 + document.form1.halfTicketNumIn.value * 1)){
				var val = document.form1.leftseats.value; 
				alert("余票数量不够！余票数："+ val);
				document.form1.fullTicketNumIn.focus();
				return false;
			}
			else */
			if (document.form1.leftTicketIDNum.value < (document.form1.fullTicketNumIn.value * 1 + document.form1.halfTicketNumIn.value * 1)){
				var val = document.form1.leftTicketIDNum.value; 
				alert("本次客票票据数量不够！余票数："+ val);
				document.form1.fullTicketNumIn.focus();
				return false;
			}
			else if(!$("#sellInsureTicket").attr("checked")) {
				document.getElementById("safeTicketMoney").value = 0;
				document.getElementById("fullTicketNum").value = document.getElementById("fullTicketNumIn").value;
				document.getElementById("halfTicketNum").value = document.getElementById("halfTicketNumIn").value;
				document.getElementById("ticketID").value = document.getElementById("curTicketID").value;
				document.getElementById("safeTicketID").value = "";
				document.getElementById("safeUserIDCard").value = "";
				document.form1.submit();
			}
			else {
				if (document.form1.leftSafeTicketIDNum.value < (document.form1.fullTicketNumIn.value * 1 + document.form1.halfTicketNumIn.value * 1)) {
					var val = document.form1.leftSafeTicketIDNum.value; 
					alert("本次保险票据数量不够！余票数："+ val);
					document.form1.fullTicketNumIn.focus();
					return false;
				}
				else if (document.form1.safeUserIDCardIn.value == "") {
					alert("身份证号不能为空！");
					document.form1.safeUserIDCardIn.focus();
					return false;
				}
				else {
					document.getElementById("safeTicketMoney").value = document.getElementById("safeticketmoneyselect").value;
					document.getElementById("fullTicketNum").value = document.getElementById("fullTicketNumIn").value;
					document.getElementById("halfTicketNum").value = document.getElementById("halfTicketNumIn").value;
					document.getElementById("ticketID").value = document.getElementById("curTicketID").value;
					document.getElementById("safeTicketID").value = document.getElementById("curSafeTicketID").value;
					document.getElementById("safeUserIDCard").value = document.getElementById("safeUserIDCardIn").value;
					document.form1.submit();
				}
			}
		});
		$("#confirmsell").click(function(){
			var str=document.getElementById("seatNo").value;
			ss=str.split(',');
			var stri='';
			for(var i=0; i<ss.length; i++){
				ss[i]=ss[i]-1;
				if(i+1<ss.length){
					stri=stri+ss[i]+',';
				}else{
					stri=stri+ss[i];
				}
			}
			document.getElementById("seatNo").value=stri;
			if (document.getElementById("getticketmoney").value - document.getElementById("realticketmoney").value < 0) {
				alert("实收款金额不足！");
				document.getElementById("getticketmoney").focus();
			}
			else {
				jQuery.get(
						'tms_v1_sell_sell.php',
						{'op': 'confirmsell', 'TicketID': $("#curTicketID").val(), 'NoOfRunsID': $("#noofrun").val(), 
						'NoOfRunsdate': $("#departuredate").val(), 'FromStation': $("#fromstation").val(), 'ReachStation': $("#reachstation").val(), 
						'FullTicketNum': $("#fullTicketNumIn").val(), 'HalfTicketNum': $("#halfTicketNumIn").val(), 'seatnos': $("#seatNo").val(), 
						'SafetyTicketID': $("#curSafeTicketID").val(), 'SafetyMoney': $("#safeTicketMoney").val(), 
						'SafetyID': $("#safeUserIDCardIn").val(), 'time': Math.random()},
						function(data){
							var objData = eval('(' + data + ')');
							if(objData.retVal == "FAIL"){ 
								alert(objData.retString);
							}
							else{
								document.getElementById("reticketmoney").value = document.getElementById("getticketmoney").value - document.getElementById("realticketmoney").value;
								document.getElementById("reticketmoney").focus();
								alert("找零后点击确定打票！");
								//alert(data);
								var url='tms_v1_websell_taketicket.php?op=update&WebSellID='+document.getElementById("WebSellID").value;
								var PrintTicket=new Array(document.getElementById("width").value,document.getElementById("height").value, document.getElementById("left").value, 
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
										document.getElementById("topAgentCode").value, document.getElementById("leftHandlerCode").value, document.getElementById("topHandlerCode").value);
								printTicket(objData, PrintTicket, url);
								/*for (var i = 0; i < objData.length; i++) {
									jQuery.get(
											'tms_v1_sell_print.php',
											{'op': 'printTicket', 'TicketID': objData[i].TicketID, 'FromStation': objData[i].FromStation, 
											'ReachStation': objData[i].ReachStation, 'SellPrice': objData[i].SellPrice, 'SeatID': objData[i].SeatID, 
											'NoOfRunsID': objData[i].NoOfRunsID, 'BeginStationTime': objData[i].BeginStationTime, 
											'NoOfRunsdate': objData[i].NoOfRunsdate, 'safetyTicketID': objData[i].safetyTicketID, 
											'SafetyTicketMoney': objData[i].SafetyTicketMoney, 'CheckTicketWindow': objData[i].CheckTicketWindow, 
											'SellerID': objData[i].SellerID, 'isAllTicket': objData[i].isAllTicket, 'time': Math.random()},
											function(data){
												//alert(data);
												window.document.body.innerHTML = data;
												window.print();
									});
								}*/
							//	window.location.href='tms_v1_websell_taketicket.php?op='update'&WebSellID='$WebSellID'';
							}
				});
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
							document.form1.submit();
						}
			});
		});		
	}); 
	window.onload = PageSetup_Null();
	window.onunload = PageSetup_Reset();
	</script>
</head>
<body>
<object id="wb" height=0 width=0 classid="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2" name="wb"></object>
<table width="100%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
	<tr>
		<td bgcolor="#4C4C4C">
			<img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
			<span class="graytext" style="margin-left:8px;">售 票 界 面</span>
		</td>
	</tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 乘车日期：</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="departuredate" id="departuredate" size="12" value="<?php echo $norunsdate?>" readonly="readonly" /></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车时间：</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="departuretime" id="departuretime" size="8"value="<?php echo $norunstime?>" readonly="readonly" /></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 乘车站：</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="fromstation" id="fromstation" value="<?php echo $fromplace?>" readonly="readonly" /></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 到达站：</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="reachstation" id="reachstation" value="<?php echo $reachplace?>" readonly="readonly" /></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 全票张数：</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="fullTicketNumIn" id="fullTicketNumIn" value="<?php echo $tnum?>" <?php echo $readonly?> /></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 半票张数：</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="halfTicketNumIn" id="halfTicketNumIn" size="12" value="<?php echo $htnum?>" <?php echo $readonly?> /></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="noofrun" id="noofrun" value="<?php echo $noofrunsID?>" readonly="readonly" /></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 当前票号：</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="curTicketID" id="curTicketID" value="<?php echo $curTicketID?>" /></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 当前保险票号：</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="curSafeTicketID" id="curSafeTicketID" value="<?php echo $curSafeTicketID?>" /></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保险类型及金额：</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF">
			<select name="safeticketmoneyselect" id="safeticketmoneyselect">
				<?php
					$sql="SELECT it_InsureProductName,it_Price FROM tms_bd_InsureType"; 
      				$query =$class_mysql_default->my_query($sql);
					while($result=mysqli_fetch_array($query)){ 
				?>
				<option value="<?php echo $result['it_Price'];?>"><?php echo $result['it_InsureProductName'].'('.$result['it_Price'].'元)';?></option>
				<?php 
					}
				?>
			</select>&nbsp;元 
		</td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 身份证号：</span>
		</td>
		<td nowrap="nowrap" bgcolor="#FFFFFF">
			<input type="text" name="safeUserIDCardIn" id="safeUserIDCardIn" value="<?php echo $safeUserIDCard?>" readonly="readonly" />
			<input type="hidden" id="safeUser" name="safeUser" value="<?php echo $safeUser?>" />
			<input type="hidden" id="safeUserAddress" name="safeUserAddress" value="<?php echo $safeUserAddress?>" />
		</td>
		<td bgcolor="#FFFFFF">
			<input id="sellInsureTicket" name="sellInsureTicket" type="checkbox" checked="checked"/>售保险票
		</td>
		<td colspan="2" align="center" bgcolor="#FFFFFF"><input type="submit" name="sellview" id="sellview" value="售 票 预 览" <?php echo $viewenable?> /></td>
	</tr>
</table>
<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder" id="table1">
	<tr>
		<td nowrap="nowrap" align="center" bgcolor="#006699">发车日期</td>
		<td nowrap="nowrap" align="center" bgcolor="#006699">发车时间</td>
		<td nowrap="nowrap" align="center" bgcolor="#006699">出发站</td>
		<td nowrap="nowrap" align="center" bgcolor="#006699">到达站</td>
		<td nowrap="nowrap" align="center" bgcolor="#006699">班次</td>
		<td nowrap="nowrap" align="center" bgcolor="#006699">票型</td>
		<td nowrap="nowrap" align="center" bgcolor="#006699">张数</td>
		<td nowrap="nowrap" align="center" bgcolor="#006699">票价</td>
		<td nowrap="nowrap" align="center" bgcolor="#006699">车型</td>
	<!--
		<td width="5%" align="center" bgcolor="#006699">座位号</td>
		<td width="15%" align="center" bgcolor="#006699">操作</td> 
	-->
	</tr>
<?
	if (isset($_POST['sellview'])) {
		if ($tnum > 0) {
?>
	<tr bgcolor="#CCCCCC">
		<td align="center"><?php echo $norunsdate?></td>
		<td align="center"><?php echo $norunstime?></td>
		<td align="center"><?php echo $fromplace?></td>
		<td align="center"><?php echo $reachplace?></td>
		<td align="center"><?php echo $noofrunsID?></td>
		<td align="center">全票</td>
		<td align="center"><?php echo $tnum?></td>
		<td align="center"><?php echo $fullPrice?></td>
		<td align="center"><?php echo $busModel?></td>
	<!--
		<td align="center">&nbsp;</td>
		<td align="center">[<a href=""]">修改座号</a>]</td> 
	-->	
	</tr>
<?php	}
		if ($htnum > 0) {
?>
	<tr bgcolor="#CCCCCC">
		<td align="center"><?php echo $norunsdate?></td>
		<td align="center"><?php echo $norunstime?></td>
		<td align="center"><?php echo $fromplace?></td>
		<td align="center"><?php echo $reachplace?></td>
		<td align="center"><?php echo $noofrunsID?></td>
		<td align="center">半票</td>
		<td align="center"><?php echo $htnum?></td>
		<td align="center"><?php echo $fullPrice/2?></td>
		<td align="center"><?php echo $busModel?></td>
	<!--
		<td align="center">&nbsp;</td>
		<td align="center">[<a href=""]">修改座号</a>]</td> 
	-->	
	</tr>
<?php	}
	}
?>  		
</table>
	<input type="hidden" id="WebSellID" name="WebSellID" value="<?php echo $WebSellID?>" />
	<input type="hidden" id="leftseats" name="leftseats" value="<?php echo $leftseats?>" />
	<input type="hidden" id="fullTicketNum" name="fullTicketNum" value="<?php echo $tnum?>" />
	<input type="hidden" id="halfTicketNum" name="halfTicketNum" value="<?php echo $htnum?>" />
	<input type="hidden" id="ticketID" name="ticketID" value="" />
	<input type="hidden" id="safeTicketID" name="safeTicketID" value="" />
	<input type="hidden" id="safeTicketMoney" name="safeTicketMoney" value="<?php echo $safeTicketMoney?>" />
	<input type="hidden" id="safeUserIDCard" name="safeUserIDCard" value="<?php echo $safeUserIDCard;?>" />
	<input type="hidden" id="seatNo" name="seatNo" value="<?php echo $seatno?>" />
	<input type="hidden" id="leftTicketIDNum" name="leftTicketIDNum" value="<?php echo $leftTicketNum?>" />
	<input type="hidden" id="leftSafeTicketIDNum" name="leftSafeTicketIDNum" value="<?php echo $leftSafeTicketNum?>" />
</form>
<?php if ($isAllTicket == "0") {?>
<iframe frameborder="1" id="heads" width="100%" scrolling="auto" src="tms_v1_sell_seatview.php?nrID=<?php echo $noofrunsID?>&nrDate=<?php echo $norunsdate?>"></iframe>
<?php }?>
<table width="100%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
	<tr>
		<?
			$totalticketnum = $tnum + $htnum;
			$totalticketmoney = $fullPrice * $tnum + ($fullPrice/2) * $htnum;
			$totalinsureticketmoney = $safeTicketMoney * $totalticketnum;
			$totalmoney = $totalticketmoney + $totalinsureticketmoney;
		?>
	    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 总售票张数：</span></td>
	    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="totalticketnum" id="totalticketnum" value="<?php echo $totalticketnum?>" readonly="readonly" /></td>
	    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 总保险张数：</span></td>
	    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="totalsafenum" id="totalsafenum" value="<?php echo $totalticketnum?>" readonly="readonly" /></td>
	    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 总客票金额：</span></td>
	    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="totalticketmoney" id="totalticketmoney" value="<?php echo $totalticketmoney?>" readonly="readonly" /></td>
	    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 总保险金额：</span></td>
	    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="totalsafemoney" id="totalsafemoney" value="<?php echo $totalinsureticketmoney?>" readonly="readonly" /></td>
    </tr>
    <tr>
	    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 应收款(元)：</span></td>
	    <td nowrap="nowrap" bgcolor="#FFFFFF"><input style="background-color:#F1E6C2" type="text" name="realticketmoney" id="realticketmoney" value="<?php echo $totalmoney?>" readonly="readonly" /></td>
	    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 实收款(元)：</span></td>
	    <td nowrap="nowrap" bgcolor="#FFFFFF"><input style="background-color:#F1E6C2" type="text" name="getticketmoney" id="getticketmoney" /></td>
	    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 找补(元)：</span></td>
	    <td nowrap="nowrap" bgcolor="#FFFFFF"><input style="background-color:#F1E6C2" type="text" name="reticketmoney" id="reticketmoney" readonly="readonly" />
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
	    									</td>
	    <td colspan="2" align="center" bgcolor="#FFFFFF">
	    	<input type="button" name="confirmsell" id="confirmsell" value="确 认 出 票" <?php echo $subcancelenable?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--     	
	    	<input type="button" name="cancelsell" id="cancelsell" value="取 消 " <?php echo $subcancelenable?> />
 -->	
	    </td>
	</tr>
</table>
</body>
</html>
