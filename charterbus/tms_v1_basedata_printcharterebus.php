<?php
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("tms_v1_basedata_chartereprintdata.php");
	require_once("../ui/inc/init.inc.php");
	$clnumber=$_GET['clnumber'];
	$select="SELECT * FROM tms_bd_CharteredBus WHERE cb_ChartereID='{$clnumber}'";
	$query =$class_mysql_default->my_query($select);
	$result=mysql_fetch_array($query);
	$string=explode('-',$result['cb_FromReach']);
	$selects="SELECT min(tp_ID),tp_CurrentTicket FROM tms_bd_TicketProvide WHERE tp_Type='包车单' AND tp_InceptUserID='{$userID}' 
		AND tp_InceptTicketNum>0 AND  tp_UseState='当前' GROUP BY tp_Type"; //需要修改用户ID
	$querys=$class_mysql_default->my_query($selects);
	$results=mysql_fetch_array($querys);
	if (empty($results[0])) echo "<script>if (!confirm('没有可用的包车单票据！是否继续？')) location.assign('tms_v1_basedata_searcharterebus.php');</script>";
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>包车单打印</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/tms_v1_print.js"></script>
	<script type="text/javascript">
	function isnumber(number){
		if(isNaN(number)){
			alert(number+"不是数字！");
			return false;
			}
	}
	function sear(){
		window.location.href='tms_v1_basedata_searcharterebus.php';
	}
	function doPrintBC(printData) {
		var Wsh = new ActiveXObject("WScript.Shell");
		printPageSetup(Wsh);
		document.body.innerHTML = printData;
		document.body.insertAdjacentHTML("beforeEnd","<object id=\"WebBrowser\" width=0 height=0 classid=\"clsid:8856F961-340A-11D0-A96B-00C04FD705A2\">");
		WebBrowser.ExecWB(6,2); 
	} 
	function printTicket(objData)
	{
		var printData = "";
		var str1 = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" /></head><body>';
		var str2 = '<table style="width:'+document.getElementById("width").value+'px;height:'+document.getElementById("height").value+'px;margin-left:'+document.getElementById("left").value+'px;margin-top:'+document.getElementById("top").value+'px;font-size:'+document.getElementById("fontsize").value+'px;border:1"><tr><td>';
		var str3 = '<div style="margin-top:'+document.getElementById("topStation").value+'px;"><div style="margin-left:'+document.getElementById("leftStation").value+'px;float:left">'+objData.BillingStation+'</div><div style="margin-left:'+document.getElementById("leftTicketID").value+'px;">'+objData.TicketID+'</div></div>';
		var str4 = '<div style="margin-top:'+document.getElementById("topblank1").value+'px;"><div style="margin-left:'+document.getElementById("leftblank1").value+'px;float:left">&nbsp;</div><div style="margin-left:'+document.getElementById("leftblank2").value+'px;">&nbsp;</div></div>';
		var str5 = '<div style="margin-top:'+document.getElementById("topCustomer").value+'px;"><div style="margin-left:'+document.getElementById("leftCustomer").value+'px;float:left">' + objData.Customer + '<span style="margin-left:'+document.getElementById("leftBusNumber").value+'px;">' + objData.BusNumber + '</span></div><div style="margin-left:'+document.getElementById("leftDriverName").value+'px;">' + objData.DriverName + '</div></div>';
		var str6 = '<div style="margin-top:'+document.getElementById("topCharteredBusDate").value+'px;"><div style="margin-left:'+document.getElementById("leftCharteredBusDate").value+'px;float:left">' + objData.CharteredBusDate +'--' + objData.CharteredBusDateF + '</div><div style="margin-left:'+document.getElementById("leftDriverName").value+'px;">&nbsp;</div></div>';
		var str7 = '<div style="margin-top:'+document.getElementById("topFrom").value+'px;"><div style="margin-left:'+document.getElementById("leftFrom").value+'px;float:left">' + objData.From + '<span style="margin-left:'+document.getElementById("leftReach").value+'px;">' + objData.Reach + '</span></div><div style="margin-left:'+document.getElementById("leftCarriageFee").value+'px;">' + objData.CarriageFee + '</div></div>';
		var str8 = '<div style="margin-top:'+document.getElementById("topKilometers").value+'px;"><div style="margin-left:'+document.getElementById("leftKilometers").value+'px;float:left"> '+ objData.Kilometers + '</div><div style="margin-left:'+document.getElementById("leftStagnateFee").value+'px;">'+ objData.StagnateFee + '</div></div>';
		var str9 = '<div style="margin-top:'+document.getElementById("topSeats").value+'px;"><div style="margin-left:'+document.getElementById("leftSeats").value+'px;float:left">' + objData.Seats + '</div><div style="margin-left:'+document.getElementById("leftrealticketmoney").value+'px;">' + objData.realticketmoney + '</div></div>';
		var str10 = '<div style="margin-top:'+document.getElementById("topPeoples").value+'px;"><div style="margin-left:'+document.getElementById("leftPeoples").value+'px;float:left">' + objData.Peoples + '</div><div style="margin-left:'+document.getElementById("leftBillingDate").value+'px;">' + objData.BillingDate + '</div></div>';
		var str11 = '<div style="margin-top:'+document.getElementById("toprealticketmoney1").value+'px;"><div style="margin-left:'+document.getElementById("leftrealticketmoney1").value+'px;float:left">' + objData.realticketmoney + '</div><div style="margin-left:'+document.getElementById("leftBillingerID").value+'px;">' + objData.BillingerID + '</div></div>';
		var str12 = '</td></tr></table></body></html>';
		printData = str1 + str2+ str3 + str4 + str5 + str6 + str7 + str8 + str9 + str10 + str11+ str12;		
		doPrintBC(printData);
		window.location.href='tms_v1_basedata_searcharterebus.php';			
	}
	
	$(document).ready(function(){
		$("#print").click(function(){
			if (document.getElementById("getticketmoney").value - document.getElementById("realticketmoney").value < 0) {
				alert("实收款金额不足！");
				document.getElementById("getticketmoney").focus();
			}else {
				jQuery.get(
						'tms_v1_basedata_printok.php',
						{'op': 'confirmprint', 'TicketID': $("#TicketID").val(), 'tpID': $("#tpID").val(), 'ChartereID': $("#ChartereID").val(),
						 'Customer': $("#Customer").val(), 'BusNumber': $("#BusNumber").val(), 'DriverName': $("#DriverName").val(),
						'CharteredBusDate': $("#CharteredBusDate").val(),'From': $("#From").val(),'Reach': $("#Reach").val(),'Kilometers': $("#Kilometers").val(),
						'Seats': $("#Seats").val(),'Peoples': $("#Peoples").val(),'CarriageFee': $("#CarriageFee").val(),'StagnateFee': $("#StagnateFee").val(),
						'realticketmoney': $("#realticketmoney").val(),'CharteredBusDays': $("#CharteredBusDays").val(),'time': Math.random()},
						 function(data){
								var objData = eval('(' + data + ')');
								if(objData.retVal == "FAIL"){ 
									alert(objData.retString);
								}
								else{
								//	alert('ss');
								//	alert(objData.BillingStation);
								//	alert(objData.TicketID);
									document.getElementById("reticketmoney").value = document.getElementById("getticketmoney").value - document.getElementById("realticketmoney").value;
									document.getElementById("reticketmoney").focus();
									alert("找零后点击确定打票！");
									printTicket(objData);
								}
						});
			}
			
		});
	});
	window.onload = PageSetup_Null();
	window.onunload = PageSetup_Reset();
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">打印包车单 </span></td>
  </tr>
</table>
<form action="" >
<table width="50%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 包车单号:</span></td>
        <td bgcolor="#FFFFFF"><input name="TicketID" id="TicketID" type="text"  value="<?php echo $results['tp_CurrentTicket'];?>"/>
        					<input name="tpID" id="tpID" type="hidden"  value="<?php echo $results[0];?>"/>
        					<input name="leftStation" id="leftStation" type="hidden"  value="<?php echo $leftStation;?>"/>
        					<input name="topStation" id="topStation" type="hidden"  value="<?php echo $topStation;?>"/>
        					<input name="width" id="width" type="hidden"  value="<?php echo $width;?>"/>
        					<input name="height" id="height" type="hidden"  value="<?php echo $height;?>"/>
        					<input name="left" id="left" type="hidden"  value="<?php echo $left;?>"/>
        					<input name="top" id="top" type="hidden"  value="<?php echo $top;?>"/>
        					<input name="fontsize" id="fontsize" type="hidden"  value="<?php echo $fontsize;?>"/>
        					</td>
	</tr>
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 订单号:</span></td>
        <td bgcolor="#FFFFFF"><input name="ChartereID" id="ChartereID" type="text" readonly="readonly" value="<?php echo $result['cb_ChartereID'];?>"/>
        					 <input name="leftTicketID" id="leftTicketID" type="hidden"  value="<?php echo $leftTicketID;?>"/>
        					 <input name="topTicketID" id="topTicketID" type="hidden"  value="<?php echo $topTicketID;?>"/></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />包车客户：</span></td>
		<td bgcolor="#FFFFFF"><input name="Customer" id="Customer" type="text" readonly="readonly" value="<?php echo $result['cb_Customer'];?>"/>
							<input name="leftCustomer" id="leftCustomer" type="hidden" value="<?php echo $leftCustomer;?>"/>
							<input name="topCustomer" id="topCustomer" type="hidden" value="<?php echo $topCustomer;?>"/></td>
	</tr>
	<!--
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车辆编号：</span></td>
    	<td  bgcolor="#FFFFFF"><input type="text" name="BusID" id="BusID" readonly="readonly" value="<?php echo $result['cb_BusID'];?>"/></td>
	</tr> 
	-->
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车牌号：</span></td>
    	<td bgcolor="#FFFFFF"><input name="BusNumber" id="BusNumber" type="text" readonly="readonly" value="<?php echo $result['cb_BusNumber'];?>"/>
    						<input name="leftBusNumber" id="leftBusNumber" type="hidden"  value="<?php echo $leftBusNumber;?>"/>
    						<input name="topBusNumber" id="topBusNumber" type="hidden"  value="<?php echo $topBusNumber;?>"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />驾驶员编号：</span></td>
    	<td bgcolor="#FFFFFF"><input name="DriverID" id="DriverID" type="text" readonly="readonly" value="<?php echo $result['cb_DriverID'];?>"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />驾驶员：</span></td>
    	<td  bgcolor="#FFFFFF"><input type="text" name="DriverName" id="DriverName" readonly="readonly" value="<?php echo $result['cb_DriverName'];?>"/>
    						 <input type="hidden" name="leftDriverName" id="leftDriverName" value="<?php echo $leftDriverName;?>" />
    						 <input type="hidden" name="topDriverName" id="topDriverName" value="<?php echo $topDriverName;?>" /></td>
	</tr> 
	
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />包车日期：</span></td>
    	<td bgcolor="#FFFFFF"><input name="CharteredBusDate" id="CharteredBusDate" type="text" readonly="readonly" value="<?php echo $result['cb_CharteredBusDate'];?>" />
    						<input name="leftCharteredBusDate" id="leftCharteredBusDate" type="hidden" value="<?php echo $leftCharteredBusDate;?>" />
    						<input name="topCharteredBusDate" id="topCharteredBusDate" type="hidden" value="<?php echo $topCharteredBusDate;?>" /></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />包车天数：</span></td>
    	<td bgcolor="#FFFFFF"><input name="CharteredBusDays" id="CharteredBusDays" readonly="readonly" type="text" value="<?php echo $result['cb_CharteredBusDays'];?>" onkeyup="return isnumber(this.value)"/></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />起屹地点：</span></td>
    	<td bgcolor="#FFFFFF"><input name="From" id="From" type="text" readonly="readonly" value="<?php echo $string[0];?>" />到
    						<input name="Reach" id="Reach" type="text" value="<?php echo $string[1];?>" />
    						<input name="leftFrom" id="leftFrom" type="hidden" value="<?php echo $leftFrom;?>" />
    						<input name="topFrom" id="topFrom" type="hidden" value="<?php echo $topFrom;?>" />
    						<input name="leftReach" id="leftReach" type="hidden" value="<?php echo $leftReach;?>" />
    						<input name="topReach" id="topReach" type="hidden" value="<?php echo $topReach;?>" /></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />计费里程：</span></td>
    	<td bgcolor="#FFFFFF"><input name="Kilometers" id="Kilometers" readonly="readonly" type="text" value="<?php echo $result['cb_Kilometers'];?>" />公里
    						<input name="leftKilometers" id="leftKilometers" type="hidden" value="<?php echo $leftKilometers;?>" />
    						<input name="topKilometers" id="topKilometers" type="hidden" value="<?php echo $topKilometers;?>" /></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />核定座位数：</span></td>
    	<td bgcolor="#FFFFFF"><input name="Seats" id="Seats" type="text" readonly="readonly" value="<?php echo $result['cb_Seats'];?>" />
    						<input name="leftSeats" id="leftSeats" type="hidden" value="<?php echo $leftSeats;?>" />
    						<input name="topSeats" id="topSeats" type="hidden" value="<?php echo $topSeats;?>" /></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />实载人数：</span></td>
    	<td bgcolor="#FFFFFF"><input name="Peoples" id="Peoples" type="text" readonly="readonly" value="<?php echo $result['cb_Peoples'];?>"/>
    						<input name="leftPeoples" id="leftPeoples" type="hidden" value="<?php echo $leftPeoples;?>" />
    						<input name="topPeoples" id="topPeoples" type="hidden" value="<?php echo $topPeoples;?>" /></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />客运费：</span></td>
    	<td bgcolor="#FFFFFF"><input name="CarriageFee" id="CarriageFee" readonly="readonly" type="text" value="<?php echo $result['cb_CarriageFee'];?>"/>
    						<input name="leftCarriageFee" id="leftCarriageFee" type="hidden" value="<?php echo $leftCarriageFee;?>"/>
    						<input name="topCarriageFee" id="topCarriageFee" type="hidden" value="<?php $topCarriageFee;?>"/></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />停滞费：</span></td>
    	<td bgcolor="#FFFFFF"><input name="StagnateFee" id="StagnateFee" type="text" readonly="readonly" value="<?php echo $result['cb_StagnateFee'];?>"/>
    						<input name="leftStagnateFee" id="leftStagnateFee" type="hidden" value="<?php echo $leftStagnateFee;?>"/>
    						<input name="topStagnateFee" id="topStagnateFee" type="hidden" value="<?php echo $topStagnateFee;?>"/></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />应收款：</span></td>
    	<td bgcolor="#FFFFFF"><input name="realticketmoney" id="realticketmoney" type="text" readonly="readonly" value="<?php echo $result['cb_CarriageFee']+$result['cb_StagnateFee'];?>" />
    						<input name="leftrealticketmoney" id="leftrealticketmoney" type="hidden" value="<?php echo $leftrealticketmoney;?>"/>
    						<input name="toprealticketmoney" id="toprealticketmoney" type="hidden" value="<?php echo $toprealticketmoney;?>"/>
    						<input name="leftrealticketmoney1" id="leftrealticketmoney1" type="hidden" value="<?php echo $leftrealticketmoney1;?>"/>
    						<input name="toprealticketmoney1" id="toprealticketmoney1" type="hidden" value="<?php echo $toprealticketmoney1;?>"/>
    						<input name="leftBillingDate" id="leftBillingDate" type="hidden" value="<?php echo $leftBillingDate;?>"/>
    						<input name="topBillingDate" id="topBillingDate" type="hidden" value="<?php echo $topBillingDate;?>"/>
    						<input name="leftBillingerID" id="leftBillingerID" type="hidden" value="<?php echo $leftBillingerID;?>"/>
    						<input name="topBillingerID" id="topBillingerID" type="hidden" value="<?php echo $topBillingerID;?>"/>
    						<input name="leftblank1" id="leftblank1" type="hidden" value="<?php echo $leftblank1;?>"/>
    						<input name="topblank1" id="topblank1" type="hidden" value="<?php echo $topblank1;?>"/>
    						<input name="leftblank2" id="leftblank2" type="hidden" value="<?php echo leftblank2;?>"/>
    						<input name="topblank2" id="topblank2" type="hidden" value="<?php echo $topblank2;?>"/></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />实收款：</span></td>
    	<td bgcolor="#FFFFFF"><input name="getticketmoney" id="getticketmoney" type="text"  onkeyup="return isnumber(this.value)"/></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />找零：</span></td>
    	<td bgcolor="#FFFFFF"><input name="reticketmoney" id="reticketmoney" type="text"  /></td>
	</tr>
 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="print" id="print" type="button" value="确认" />
     	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return sear()" /></td>
  </tr>
</table>
</form>
</body>
</html>
