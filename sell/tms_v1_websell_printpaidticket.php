<?
/*
 * 打票预览页面
 * 	
 * 票版座位状态：0-可售；1-锁定待售；2-预留（电话订票；班次预留现在不用）；3-已售；4-已检；5-网上预订（未支付）；6-网上订票已支付；
 *  
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

require_once("tms_v1_sell_sellprintdata.php");
require_once("tms_v1_sell_getPrinterName.php");

$seller = $userName;
$sellerID = $userID;
$sellerStation = $userStationName;

$WebSellID=$_GET['WebSellID'];

//取得班次、发车日期、时间、出发站、到达站、总人数、售票金额、全票人数、半票人数
$selectweb="SELECT wst_BeginStationTime,wst_NoOfRunsdate,wst_FromStation,wst_ReachStation,wst_TotalMan,wst_SellPrice,wst_FullNumber,wst_HalfNumber,
	wst_NoOfRunsID,wst_SeatID,wst_CertificateNumber FROM tms_websell_WebSellTicket WHERE wst_WebSellID='{$WebSellID}'";
$queryweb =$class_mysql_default->my_query($selectweb);
$rowweb = mysql_fetch_array($queryweb);
$tnum = $rowweb['wst_FullNumber'];
$htnum = $rowweb['wst_HalfNumber'];
$seatno = $rowweb['wst_SeatID'];
$noofrunsID = $rowweb['wst_NoOfRunsID'];
$norunsdate = $rowweb['wst_NoOfRunsdate'];
$fromplace = $rowweb['wst_FromStation'];
$reachplace = $rowweb['wst_ReachStation'];
$norunstime = $rowweb['wst_BeginStationTime'];
$sellprice=$rowweb['wst_SellPrice'];

//取得车型
$strsqlselet = "SELECT tml_BusModel, tml_Allticket FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$noofrunsID') AND (tml_NoOfRunsdate = '$norunsdate')";
$resultselet = $class_mysql_default->my_query("$strsqlselet");
$rows = mysql_fetch_array($resultselet);
$busModel = $rows[0];
$isAllTicket = $rows[1];
	
//取得客票号
$strsqlselet = "SELECT `tp_CurrentTicket`,`tp_InceptTicketNum` FROM `tms_bd_TicketProvide` WHERE `tp_InceptUserID` = '$sellerID'
			AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '客票' ORDER BY tp_ProvideData ASC";
$resultselet = $class_mysql_default->my_query("$strsqlselet");
$rows = mysql_fetch_array($resultselet);
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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>打票预览</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/tms_v1_print.js"></script>
	<script type="text/javascript">
	function printTicket(objData, PrintTicket, returnurl)
	{
		var allKPData = "";
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
			kpWin.document.write('\<\/script>\n</head>\n');
			kpWin.document.write('<body>\n');
			kpWin.document.write(allKPData);
			kpWin.document.write('\n<script>\n');
			kpWin.document.write('printWB.ExecWB(6,2);');
			kpWin.document.write('\n\<\/script>');
			kpWin.document.write('\n</body>\n</html>');
			kpWin.close();
		}
	
		var cmd = 'C:\\Windows\\System32\\rundll32.exe'; 
		var para1 = 'printui.dll,PrintUIEntry'; 
		var para2 = '/y'; 
		var para3 = '/n'; 
		var para4 = '"' + $("#kpPrinterName").val() + '"'; 
		var Wsh = new ActiveXObject("WScript.Shell");
		printPageSetup(Wsh);

		var kpWin;
		if(allKPData != "" && para4 != '"none"') {
			Wsh.Run(cmd + ' ' + para1 + ' ' + para2 + ' ' + para3 + ' ' + para4);
			var windowFeatures = "width="+PrintTicket[0]+"height="+PrintTicket[1]+"top=0,left=0,directories=no,toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no";
			kpWin = window.open('','kpWin',windowFeatures); 
			printKP();
			while (!kpWin.closed);
		}
		window.location.href = returnurl;
	}
	
	$(document).ready(function(){
		$("#confirmprint").focus();
		$("#confirmprint").click(function(){
			if (document.form1.leftTicketIDNum.value < (document.form1.fullTicketNumIn.value * 1 + document.form1.halfTicketNumIn.value * 1)){
				var val = document.form1.leftTicketIDNum.value; 
				alert("本次客票票据数量不够！余票数："+ val);
				document.form1.fullTicketNumIn.focus();
				return false;
			}
			
			var objData,PrintTicket;
			var printThis = false;
			$.ajax({
				type : "get",
				url : "tms_v1_sell_sell.php",
				data : {'op': 'confirmprint', 'TicketID': $("#curTicketID").val(), 'WebSellID': $("#WebSellID").val(), 'NoOfRunsID': $("#noofrun").val(), 
					'NoOfRunsdate': $("#departuredate").val(), 'FromStation': $("#fromstation").val(), 'ReachStation': $("#reachstation").val(), 
					'FullTicketNum': $("#fullTicketNumIn").val(), 'HalfTicketNum': $("#halfTicketNumIn").val(), 'seatnos': $("#seatno").val(), 
					'time': Math.random()},
				async : false,
				success : function(data){
					objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						alert(objData.retString);
					}
					else {
						PrintTicket = new Array(
								document.getElementById("width").value,document.getElementById("height").value,document.getElementById("left").value,document.getElementById("top").value,document.getElementById("fontsize").value,
								document.getElementById("topTicketIDL").value,document.getElementById("leftTicketIDL").value,document.getElementById("leftTicketIDR").value,
								document.getElementById("topFromStationL").value,document.getElementById("leftFromStationL").value,document.getElementById("leftReachStationL").value,document.getElementById("leftFromStationR").value,document.getElementById("leftReachStationR").value,
								document.getElementById("topSellPriceL").value, document.getElementById("leftSellPriceL").value,document.getElementById("leftSeatIDL").value,document.getElementById("leftSellPriceR").value,
								document.getElementById("topNoOfRunsIDL").value,document.getElementById("leftNoOfRunsIDL").value,document.getElementById("leftBeginStationTime").value,document.getElementById("leftNoOfRunsIDR").value,
								document.getElementById("topNoOfRunsdateL").value,document.getElementById("leftNoOfRunsdateL").value,document.getElementById("leftNoOfRunsdateR").value,
								document.getElementById("topSeatIDR").value,document.getElementById("leftSeatIDR").value,
								document.getElementById("topSellerID").value,document.getElementById("leftSellerID").value);
						printThis = true;
					}
				}
			}); 
			if(printThis) {
				var url="tms_v1_websell_taketicket.php";
				printTicket(objData, PrintTicket, url);
			}
		});
		document.onkeyup = function (event) {
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 27) {	//ESC
	        	document.location.href = "tms_v1_websell_taketicket.php";
           		return false;
            }
		};
	}); 
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
	<tr>
		<td bgcolor="#4C4C4C">
			<img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
			<span class="graytext" style="margin-left:8px;">打 票 界 面</span>
		</td>
	</tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 乘车日期：</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="departuredate" id="departuredate" size="12" value="<?=$norunsdate?>" readonly="readonly" /></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车时间：</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="departuretime" id="departuretime" size="8"value="<?=$norunstime?>" readonly="readonly" /></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 乘车站：</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="fromstation" id="fromstation" value="<?=$fromplace?>" readonly="readonly" /></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 到达站：</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="reachstation" id="reachstation" value="<?=$reachplace?>" readonly="readonly" /></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 全票张数：</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="fullTicketNumIn" id="fullTicketNumIn" value="<?=$tnum?>" readonly="readonly" /></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 半票张数：</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="halfTicketNumIn" id="halfTicketNumIn" size="12" value="<?=$htnum?>" readonly="readonly" /></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="noofrun" id="noofrun" value="<?=$noofrunsID?>" readonly="readonly" /></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 座位号：</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="seatno" id="seatno" value="<?=$seatno?>" readonly="readonly" /></td>
	</tr>
</table>
	<input type="hidden" id="WebSellID" name="WebSellID" value="<?php echo $WebSellID?>" />
	<input type="hidden" id="leftTicketIDNum" name="leftTicketIDNum" value="<?php echo $leftTicketNum?>" />
</form>
<?php if ($isAllTicket == "0") {?>
<iframe frameborder="1" id="heads" width="100%" scrolling="auto" src="tms_v1_sell_seatview.php?nrID=<?=$noofrunsID?>&nrDate=<?=$norunsdate?>"></iframe>
<?php }?>
<br/><br/>
<div style="margin-left:5px;">
	<img src="../ui/images/sj.gif" width="6" height="7" />&nbsp;当前票号：
	<input type="text" name="curTicketID" id="curTicketID" size="10" value="<?=$curTicketID?>" readonly="readonly" style="height:18;border:none"/>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="confirmprint" id="confirmprint" style="height:18;text-align:center;font-size:12px;" value="确 认 打 票" />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="back" id="back" style="height:18;text-align:center;font-size:12px;" value="返 回" onclick="location.assign('tms_v1_websell_taketicket.php')" />
</div>
<br/>
<input type="hidden" name="kpPrinterName" id="kpPrinterName" value="<?php echo $kpName;?>"/>
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
</body>
</html>
