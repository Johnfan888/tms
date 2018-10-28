<?
//车辆报班页面

//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$NoOfRunsdat = $_GET['NoOfRunsdate'];//发车日期
$NoOfRunsI = $_GET['NoOfRunsID'];//班次
//echo $NoOfRunsI;
$LineNam = $_GET['LineName'];//线路
$reportCheckWindow = $_GET['reportCheckWindow'];//检票口
$busmodel = $_GET['busmodel'];
$NoOfRunsID = $_GET['nrID'];
$LineName = $_GET['ln'];
$BusID = $_GET['bID'];
$BusCard = $_GET['bCard'];
$NoOfRunsdate = $_GET['nrDate'];
$CheckWindow = $_GET['qCW'];
$thisStation=$_GET['tSt'];
$BeginStation=$_GET['bSt'];
$BusNumber = $_GET['BusNumber']; //车牌号
if($NoOfRunsI == "" && $NoOfRunsdat == ""){
	$selectticketmode="SELECT  tml_TotalSeats,tml_HalfSeats ,tml_Allticket FROM tms_bd_TicketMode 
				   WHERE tml_NoOfRunsID = '$NoOfRunsID' AND tml_NoOfRunsdate = '$NoOfRunsdate'";
}
else{
	$selectticketmode="SELECT  tml_TotalSeats,tml_HalfSeats ,tml_Allticket FROM tms_bd_TicketMode 
				   WHERE tml_NoOfRunsID = '$NoOfRunsI' AND tml_NoOfRunsdate = '$NoOfRunsdat'";
}
	$queryticketmode = $class_mysql_default->my_query($selectticketmode);
	$rowticketmode = mysqli_fetch_array($queryticketmode);
//echo $rowticketmode['tml_TotalSeats']; 原总座位数
//echo $rowticketmode['tml_HalfSeats']; 原半票座位数

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>车辆报班</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript">
	function checkInfo(objData){
		var LineName = document.getElementById("LineName").value; //线路
		var busmodel = document.getElementById("busmodel").value; //售票车型
		var Seatnum=document.getElementById("Seatnum").value; //原总座位数
		var HalfSeatnum=document.getElementById("HalfSeatnum").value; //原半票总座位数
		var Allticket=document.getElementById('Allticket').value;//是否通票
		var ticketstate = objData.ticketstate; //通票
		var NoOfRunsID1 = objData.NoOfRunsID; //班次信息
		var curStatus = objData.curStatus; //车辆状态
		var BusType = objData.bi_BusType;
		var ManagementLine = objData.bi_ManagementLine;
		var Seatnum1 =  objData.bi_SeatS; //报到车总座位数
		var HalfSeatnum1 = objData.bi_AllowHalfSeats; //现半票总座位数
		var nextReport = objData.nextReport;
		var nextbus = objData.nextbus;
		if(document.getElementById("BegionStation").value!=document.getElementById("thisStation").value){
			if(nextReport=='0'){
				alert('前一站没发车，该站不能报班');
				window.location.href='tms_v1_schedule_noofrun.php';
				return false;	
			}
			if(nextbus=='0'){
				if(!confirm('报班车辆与前一站报班车辆不符，是否继续？')){
					$("#reportBusID").val("");
					$("#reportBusCard").val("");
					return false;	
				}
			}
		}else{
			if(NoOfRunsID1 != ""){
				alert('此车辆已报班，已报班班次信息：\r班次：['+NoOfRunsID1+'];\r状态：['+curStatus+'];\r通票：['+ticketstate+']\r该车辆可在已报班班次发班或者撤销报班后继续报班！');
					$("#reportBusID").val("");
					$("#reportBusCard").val("");
					return false;	
				
			}
			if(BusType != busmodel){
				if(!confirm('售票车型('+busmodel+'):与报班车型('+BusType+'):不符，是否继续？')){
					$("#reportBusID").val("");
					$("#reportBusCard").val("");
					return false;	
				}
			}
			if(ManagementLine != LineName && ManagementLine == ""){
				if(!confirm('班次线路('+LineName+'):与车辆经营线路(不存在):不符，是否继续？')){
					$("#reportBusID").val("");
					$("#reportBusCard").val("");
					return false;	
				}
			}
			if(ManagementLine != LineName && ManagementLine != ""){
				if(!confirm('班次线路('+LineName+'):与车辆经营线路('+ManagementLine+'):不符，是否继续？')){
					$("#reportBusID").val("");
					$("#reportBusCard").val("");
					return false;	
				}
			}
			if(Allticket == 0){ //非通票判断座位数
				if(Seatnum1 < Seatnum && HalfSeatnum1 >= HalfSeatnum){
					//alert('1');
					if(!confirm('报到车辆总座位数['+Seatnum1+']小于原总座位数['+Seatnum+'],是否继续？')){
						$("#reportBusID").val("");
						$("#reportBusCard").val("");
						return false;
					}
				}
				if(Seatnum1 >= Seatnum && HalfSeatnum1 < HalfSeatnum){
					//alert('2');
					if(!confirm('报到车辆半票座位数['+HalfSeatnum1+']小于原半票座位数['+HalfSeatnum+'],是否继续？')){
						$("#reportBusID").val("");
						$("#reportBusCard").val("");
						return false;
					}
				}
				if(Seatnum1 < Seatnum && HalfSeatnum1 < HalfSeatnum){
					//alert('3');
					if(!confirm('报到车辆总座位数['+Seatnum1+']小于原总座位数['+Seatnum+'];\r报到车辆半票座位数['+HalfSeatnum1+']小于原半票座位数['+HalfSeatnum+'],\r是否继续？')){
						$("#reportBusID").val("");
						$("#reportBusCard").val("");
						return false;
					}
				}
			}
		}

		$("#reportBusID").val(objData.bi_BusID);
		if(objData.bi_BusNumber != null || objData.bi_BusNumber != "") $("#reportBusCard").val(objData.bi_BusNumber);
		if(objData.bi_IsSafetyCheck == "检验不合格" || objData.bi_IsSafetyCheck == "" || objData.bi_IsSafetyCheck == null){
			document.getElementById("confirmReport").disabled=false;
			if (!confirm('安检不合格或没有安检，是否继续?')){
				$("#reportBusID").val("");
				$("#reportBusCard").val("");
				document.getElementById("confirmReport").disabled=true;
				return false;
			}
		}
		document.getElementById("reportBusIDI").value = document.getElementById("reportBusID").value;  //车辆编号
		document.getElementById("reportBusCardI").value = document.getElementById("reportBusCard").value; //车牌号
		return true;
	}
		
	$(document).ready(function(){
		$("#BusNumberselect").blur(function(){  //车辆编号是否一致
			var reportBusCard=document.getElementById("reportBusCard").value;
			var reportBusID=document.getElementById("reportBusID").value;
			var reportBusIDI=document.getElementById("reportBusIDI").value;
		    var reportBusCardI=document.getElementById("reportBusCardI").value;
			//$("#reportBusCard").val("");
			if(reportBusID != reportBusIDI || reportBusID == "" || reportBusCard == "" || reportBusCard != reportBusCardI){
				document.getElementById("confirmReport").disabled=true;	
			}
			if(reportBusID == reportBusIDI && reportBusID != "" && reportBusCard != "" && reportBusCard == reportBusCardI){
				document.getElementById("confirmReport").disabled=false;	
			}
		});
	});
	function gray2(){
		var reportBusCardI=document.getElementById("reportBusCardI").value;
		var reportBusID=document.getElementById("reportBusID").value;
		var reportBusCard=document.getElementById("reportBusCard").value;
		var BusNumberselect=document.getElementById("BusNumberselect").value; 
		if(BusNumberselect != reportBusCardI || reportBusID == "" || reportBusCard == "" || reportBusCardI != reportBusID){
			document.getElementById("confirmReport").disabled=true;	
		}
		if(BusNumberselect == reportBusCardI && reportBusID != "" && reportBusCard != "" && reportBusCardI == reportBusID){
			document.getElementById("confirmReport").disabled=false;	
		}
	}
	function gray(){
		document.getElementById("confirmReport").disabled=true;
	}
	$(document).ready(function(){
		var reportBusID = document.getElementById("reportBusID").value;  //车辆编号
		var reportBusCard = document.getElementById("reportBusCard").value; //车牌号
		if(reportBusID != "" && reportBusCard != ""){
		document.getElementById("confirmReport").disabled=false;
		}
	});
	$(document).ready(function(){  //通票类型处理
		if(document.getElementById("AllTicket").value=='1'){
			document.getElementById("disorno").style.display='';
			document.getElementById("cancelall").style.display='';
		}else{
			document.getElementById("disorno").style.display='none';
			document.getElementById("cancelall").style.display='none';
		}
		$("#table1").tablesorter();
		$("#table1 tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
		$("#table1 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
		$("#table1 tr").click(function(){
			$("#table1 tr:not(this)").css("background-color","#CCCCCC");
			$("#table1 tr:not(this)").mouseover(function(){$(this).css("background-color","#F1E6C2");});
			$("#table1 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$(this).css("background-color","#FFCC00");
			$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
			$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
			$("#busnumber").val($(this).children().eq(0).text());
			$("#state").val($(this).children().eq(3).text());
			$("#rtID").val($(this).children().eq(6).text());
			$("#ctID").val($(this).children().eq(7).text());
			//alert($("#rtID").val());
		});
		$("#reportBusID").focus();
		$("#reportBusID").keyup(function(e){ //修改车辆编号触发的消息
			var reportBusCard=document.getElementById("reportBusCard").value;
			var reportBusID=document.getElementById("reportBusID").value;
			var reportBusIDI=document.getElementById("reportBusIDI").value;
		    var reportBusCardI=document.getElementById("reportBusCardI").value;
			//$("#reportBusCard").val("");
			if(reportBusID != reportBusIDI || reportBusID == "" || reportBusCard == "" || reportBusCard != reportBusCardI){
				document.getElementById("confirmReport").disabled=true;	
			}
			if(reportBusID == reportBusIDI && reportBusID != "" && reportBusCard != "" && reportBusCard == reportBusCardI){
				document.getElementById("confirmReport").disabled=false;	
			}
			if(e.keyCode == 13){
				//alert($("#reportBusID").val());
				var NoOfRunsdate = document.getElementById("NoOfRunsdate").value; //发车日期
				jQuery.get(
					'../ui/inc/manageIC.php',
					{'op': 'GETBUSINFO', 'busIC': $("#reportBusID").val(), 'time': Math.random()},
					function(data){
						//alert(data);
						var objData = eval('(' + data + ')');
						if(objData.bc_BusID == null || objData.bc_BusID == ""){
							jQuery.get(
								'tms_v1_schedule_dataops.php',
								{'op': 'GETBUSINFOBYBUSID', 'busID': $("#reportBusID").val(), 'NoOfRunsdate' : NoOfRunsdate, 'time': Math.random()},
								function(data){
									//alert(data);
									var objData = eval('(' + data + ')');
									if(objData.bi_BusID == null || objData.bi_BusID == ""){ 
										/*if(confirm("此车辆编号的车不存在！是否录入该车辆信息？")){
										location.assign('../basedata/tms_v1_basedata_addbusrun.php?reportBusID='+reportBusID+'&reportBusCard='+reportBusCard);
										}*/
										alert("系统中无此车信息！请检查。");
										$("#reportBusID").val("");
										$("#reportBusCard").val("");
										$("#reportBusID").focus();
									}
									else{
										if(!checkInfo(objData)) {
											$("#reportBusID").focus();
											return false;
										}
										$("#reportBusID").val(objData.bc_BusID);
										if(objData.bc_BusNumber != null || objData.bc_BusNumber != "") $("#reportBusCard").val(objData.bc_BusNumber);
										document.form1.submit();
									}
							});
						}
						else{
							$("#reportBusID").val(objData.bc_BusID);
							if(objData.bc_BusNumber != null || objData.bc_BusNumber != "") $("#reportBusCard").val(objData.bc_BusNumber);
						}
				});
			}
			else {
				$("#reportBusID").val(e.value);
			}
		});
		$("#reportBusCard").keyup(function(){
			var reportBusCard=document.getElementById("reportBusCard").value;
			var reportBusCardI=document.getElementById("reportBusCardI").value;
			var reportBusIDI=document.getElementById("reportBusIDI").value;
			var reportBusID=document.getElementById("reportBusID").value;
			if(reportBusCard != reportBusCardI || reportBusCard == "" && reportBusID == "" && reportBusID != reportBusIDI){
				document.getElementById("confirmReport").disabled=true;	
			}
			if(reportBusCard == reportBusCardI && reportBusCard != "" && reportBusID != "" && reportBusID == reportBusIDI){
				document.getElementById("confirmReport").disabled=false;	
			}
			$("#BusNumberselect").empty();  //选择车辆信息
			document.getElementById("BusNumberselect").style.display=""; 
			var BusNumber = $("#reportBusCard").val();
			jQuery.get(
				'../basedata/tms_v1_basedata_getbusdata.php',
				{'op': 'getbus', 'BusNumber': BusNumber, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						document.getElementById("BusNumberselect").style.display="none";
					}
					for (var i = 0; i < objData.length; i++) {
						$("<option value = " + objData[i].BusNumber + ">" + objData[i].BusNumber + "</option>").appendTo($("#BusNumberselect"));
					}
					if(BusNumber==''){
						document.getElementById("BusNumberselect").style.display="none";
					}
			});
		});
		document.getElementById("BusNumberselect").onclick = function (event){
			document.getElementById("reportBusCard").value=document.getElementById("BusNumberselect").value;
			document.getElementById("BusNumberselect").style.display="none";
		};

		$("#getBusInfo").click(function(){  //车辆信息确认
			var reportBusID = document.getElementById("reportBusID").value;  //车辆编号
			var reportBusCard = document.getElementById("reportBusCard").value; //车牌号
			var LineName = document.getElementById("LineName").value; //线路
			var busmodel = document.getElementById("busmodel").value; //售票车型
			var NoOfRunsdate = document.getElementById("NoOfRunsdate").value; //发车日期
			var NoOfRunsID = document.getElementById("NoOfRunsID").value; //班次修改
			var NoOfRunsdate = document.getElementById("NoOfRunsdate").value;//班次日期
			var reportCheckWindow = document.getElementById("reportCheckWindow").value; //检票口
			if (document.form1.reportBusID.value == "" && document.form1.reportBusCard.value == "") {
				alert("请输入报班车辆编号或车牌号！");
				document.form1.reportBusID.focus();
			}
			else if (document.form1.reportBusID.value != "") { //报班车编号
				jQuery.get(
					'tms_v1_schedule_dataops.php',
					{'op': 'GETBUSINFOBYBUSID', 'busID': $("#reportBusID").val(), 'NoOfRunsdate' : NoOfRunsdate,'BegionStation':$("#BegionStation").val(),
						'thisStation':$("#thisStation").val(),'NoOfRunsID':$("#NoOfRunsID").val(),'time': Math.random()},
					function(data){
						//alert(data);
						var objData = eval('(' + data + ')');
						if(objData.bi_BusID == null || objData.bi_BusID == ""){ 
							/*if(confirm("此车辆编号的车不存在！是否录入该车辆信息？")){
							location.assign('../basedata/tms_v1_basedata_addbusrun.php?reportBusID='+reportBusID+'&reportBusCard='+reportBusCard);
							}*/
							alert("此车辆编号的车不存在！查看编号是否正确？");
							$("#reportBusID").val("");
							$("#reportBusCard").val("");
							$("#reportBusID").focus();
						}
						else{
							if(!checkInfo(objData)) {
								$("#reportBusID").focus();
								return false;
							}
							document.form1.submit();
						}
				});
			}
			else {  //只输入车牌号
				jQuery.get(
					'tms_v1_schedule_dataops.php',
					{'op': 'GETBUSINFOBYBUSNUMBER', 'bi_BusNumber': $("#reportBusCard").val(), 'NoOfRunsdate' : NoOfRunsdate,'BegionStation':$("#BegionStation").val(),
						'thisStation':$("#thisStation").val(),'NoOfRunsID':$("#NoOfRunsID").val(), 'time': Math.random()},
					function(data){
						//alert(data);
						var objData = eval('(' + data + ')');
				//		alert(objData.ss);
				//		if(objData.er=='error'){
				//			aler(objData.ss);	
				//		}
						if(objData.bi_BusID == null || objData.bi_BusID == ""){
							//var NoOfRunsID=document.getElementById("NoOfRunsID").value;
							if(confirm("此车牌号的车不存在！是否录入该车辆信息？")){
								
								location.assign('../basedata/tms_v1_basedata_addbusrun.php?reportBusID='+reportBusID+'&reportBusCard='+reportBusCard+'&NoOfRunsdate='+NoOfRunsdate+'&NoOfRunsID='+NoOfRunsID+'&reportCheckWindow='+reportCheckWindow+'&LineName='+LineName+'&busmodel='+busmodel);
							}
							else {
								$("#reportBusCard").val("");
								$("#reportBusCard").focus();
							}	
						}
						else{
							if(!checkInfo(objData)) {
								$("#reportBusCard").focus();
								return false;
							}
							document.form1.submit();
						}
				});
			}
		});
		$("#confirmReport").click(function(){
			if (document.form1.reportBusID.value == "" || document.form1.reportBusCard.value == ""){
				alert("车辆编号和车牌号不能为空！");
				document.form1.reportBusID.focus();
				return;
			}
			jQuery.get(
				'tms_v1_schedule_dataops.php',
				{'op': 'CONFIRMREPORT', 'NoOfRunsID': $("#NoOfRunsID").val(), 'NoOfRunsdate': $("#NoOfRunsdate").val(),	
					'reportBusID': $("#reportBusID").val(), 'reportBusCard': $("#reportBusCard").val(), 
					'reportCheckWindow': $("#reportCheckWindow").val(), 'time': Math.random()},
				function(data){
					//alert(data);
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL") { 
						alert(objData.retString);
					}
					else {
						var Allticket1=document.getElementById('Allticket').value;//是否通票
						alert("报班成功！");
						if(Allticket1 == 0){
							window.location.href='tms_v1_schedule_noofrun.php?op=none';
						}
						else{
							document.getElementById('form1').action='';
							document.form1.submit();
						}
					}
			});
		});
		$("#cancelallruns").click(function(){
			var state=document.getElementById("state").value;
			var rtID=document.getElementById("rtID").value;
			var ctID=document.getElementById("ctID").value;
			if (document.getElementById("busnumber").value == "" ){
				alert("请选择撤销报班车辆！");
				return;
			}
			if(document.getElementById("state").value == "检票"){
				alert('该班次已检票，不能撤销！');
				return false;
				}
			if(document.getElementById("state").value == "发班"){
				alert('该班次已发班，不能撤销！');
				return false;
				}
			jQuery.get(
					'tms_v1_schedule_dataops.php',
					{'op': 'CANCELALLREPORT', 'NoOfRunsID': $("#NoOfRunsID").val(), 'NoOfRunsdate': $("#NoOfRunsdate").val(),	
						'reportBusNumber': $("#busnumber").val(), 'ctID':ctID, 'rtID':rtID,  'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL") { 
							alert(objData.retString);
						}
						else {
							alert(objData.retString);
						//	window.location.href='tms_v1_schedule_noofrun.php?op=none';
							document.getElementById('form1').action='';
							document.form1.submit();
						}
			});
		});
	});
	
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
		<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
		<span class="graytext" style="margin-left:8px;">车辆报班</span></td>
	</tr>
</table>
<form action="tms_v1_schedule_VehicleInfo.php" method="post" name="form1" id="form1">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="1">
	<tr>
		<td colspan="6" bgcolor="#f0f8ff"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 报班信息：</td>
	</tr>
	<tr>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 发车日期:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input name="NoOfRunsdate" id="NoOfRunsdate" value="<?php if($NoOfRunsdate == ""){echo $NoOfRunsdat;} else{echo $NoOfRunsdate;}?>" readonly="readonly"/></td>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 报班车编号:</span></td>
		<td width="10%" bgcolor="#FFFFFF">
			<input type="text" name="reportBusID" id="reportBusID" value="" onchange="gray()"/>
			<input type="hidden" name="reportBusIDI" id="reportBusIDI" value=""/>
		</td>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 报班车牌号:</span></td>
		<td width="10%" bgcolor="#FFFFFF">
			<input  type="text" name="reportBusCard" id="reportBusCard"  onchange="gray()" value="<?php echo $BusNumber;?>"/>
			<br/>
	    	<select id="BusNumberselect" name="BusNumberselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" onchange="gray2()"></select>
	    	<input  type="hidden" name="reportBusCardI" id="reportBusCardI" value=""/>
	    </td>
	</tr>
	<tr>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 班次:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input type="text" name="NoOfRunsID" id="NoOfRunsID"  value="<?php if($NoOfRunsID == ""){echo $NoOfRunsI;} else{echo $NoOfRunsID;}?>" readonly="readonly"/>
		</td>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 线路:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input type="text" name="LineName" id="LineName"  value="<?php if($LineName == ""){echo $LineNam;} else{echo $LineName;}?>" readonly="readonly" /></td>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 检票口:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input  type="text" name="reportCheckWindow" id="reportCheckWindow"  value="<?php if($CheckWindow == ""){echo $reportCheckWindow;} else{echo $CheckWindow;}?>"/></td>
	</tr>
<!-- 
	<tr>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 待班车编号:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input type="text" name="scheduleBusID" id="scheduleBusID" value="<?=$BusID?>" readonly="readonly" /></td>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 待班车牌号:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input type="text" name="scheduleBusCard" id="scheduleBusCard" value="<?=$BusCard?>" readonly="readonly" /></td>
	</tr>
 -->	
	<tr>
		<td align="center" colspan="6">
			<input id="getBusInfo" name="getBusInfo" type="button" value="报班车辆信息检查" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="confirmReport" name="confirmReport" type="button" value="报班确认" disabled="disabled"/>
			<span id="cancelall" style="display :none">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="cancelallruns" name="cancelallruns" type="button" value="撤销报班" /></span>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="cancelReport" name="cancelReport" type="button" value="取消退出" onclick="window.location.href='tms_v1_schedule_noofrun.php?op=none>';" />
		</td>
	</tr>
</table>
<div id="disorno" style="display :none">
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder" id="table1">
		<thead>
		<tr>
			<th nowrap="nowrap" align="center" bgcolor="#006699" >车牌</th>
			<th nowrap="nowrap" align="center" bgcolor="#006699">报到时间</th>
			<th nowrap="nowrap" align="center" bgcolor="#006699">车属单位</th>
			<th nowrap="nowrap" align="center" bgcolor="#006699">状态</th>
			<th nowrap="nowrap" align="center" bgcolor="#006699">座位数</th>
			<th nowrap="nowrap" align="center" bgcolor="#006699">加座数</th>
			<th nowrap="nowrap" align="center" bgcolor="#006699" style="display :none">调度编号</th>
			<th nowrap="nowrap" align="center" bgcolor="#006699" style="display:none">检票编号</th>
			
		</tr></thead>
		<tbody>
		<?php 
			$selectreport="SELECT ct_ID,tml_AllowSell,tml_StopRun,ct_Flag,rt_BusCard,rt_ReportDateTime,bi_BusUnit,bi_SeatS,bi_AddSeatS,rt_ID FROM tms_sch_Report 
						   LEFT OUTER JOIN tms_bd_BusInfo ON rt_BusCard=bi_BusNumber
						   LEFT OUTER JOIN tms_chk_CheckTemp on ct_NoOfRunsID=rt_NoOfRunsID AND ct_NoOfRunsdate=rt_NoOfRunsdate AND ct_BusNumber=rt_BusCard AND ct_ReportDateTime=rt_ReportDateTime
						   LEFT OUTER JOIN tms_bd_TicketMode ON tml_NoOfRunsID = rt_NoOfRunsID AND tml_NoOfRunsdate = rt_NoOfRunsdate
						   WHERE rt_NoOfRunsID='{$NoOfRunsID}' AND rt_NoOfRunsdate='{$NoOfRunsdate}' AND rt_AttemperStationID='{$userStationID}'";
			$queryreport=$class_mysql_default->my_query($selectreport);
			if(!$queryreport) echo $class_mysql_default->my_error();
			while($rows=mysqli_fetch_array($queryreport)){
			if($rows['bht_BalanceNO']!='' || $rows['bh_BalanceNO']!=''){
			$allbalancenum=$allbalancenum+1;
			}
				if($rows['ct_Flag'] == '0'){
					if($rows['ct_Flag'] == '0' && $rows['tml_AllowSell']==0 && $rows['tml_StopRun']==0) $curStatus='暂停';
					elseif($rows['ct_Flag'] == '0' && $rows['tml_StopRun']==3){
						$curStatus='并班';
					}
					else{
					 $curStatus='在售';
					}
				}
				else{
					if($rows['ct_Flag'] == '1') $curStatus='检票'; 
					if($rows['ct_Flag'] == '2' || $rows['ct_Flag'] == '3') $curStatus='发班'; 
				}
		?>
		<tr align="center" bgcolor="#CCCCCC">
			<td><?=$rows['rt_BusCard']?></td>
			<td><?=$rows['rt_ReportDateTime']?></td>
			<td><?=$rows['bi_BusUnit']?></td>
			<?php 
			if($curStatus == '暂停'){  //蓝色
			?>
			<td nowrap="nowrap"><span style="color:#0000FF"><?=$curStatus?></span></td>
			<?php 
			}
			if($curStatus == '在售'){  //绿色
			?>
			<td nowrap="nowrap"><span style="color:#009900"><?=$curStatus?></span></td>
			<?php 
			}
			if($curStatus == '发班'){  //红色
			?>
			<td nowrap="nowrap"><span style="color:#FF0000"><?=$curStatus?></span></td>
			<?php 
			}
			if($curStatus == '检票'){  //黄色
			?>
			<td nowrap="nowrap"><span style="color:#FFFF00"><?=$curStatus?></span></td>
			<?php 
			}
			if($curStatus == '并班'){  //紫色
			?>
			<td nowrap="nowrap"><span style="color:#6633FF"><?=$curStatus?></span></td>
			<?php 
			}
			?>
				<td><?=$rows['bi_SeatS']?></td>
				<td><?=$rows['bi_AddSeatS']?></td>
				<td style="display:none"><?=$rows['rt_ID']?></td>
				<td  style="display:none"><?=$rows['ct_ID']?></td>
			</tr>
			<?php }?>
	</tbody></table>
</div>
	<input type="hidden" id="busnumber" name="busnumber" value="" />
	<input type="hidden" id="BegionStation" name="BegionStation" value="<?php echo $BeginStation;?>" />
	<input type="hidden" id="thisStation" name="thisStation" value="<?php echo $thisStation;?>" />
	<input type="hidden" id="busmodel" name="busmodel" value="<?php print $busmodel?>"/>
	<input type="hidden" id="Seatnum" name="Seatnum" value="<?php echo $rowticketmode['tml_TotalSeats'];?>"/>
	<input type="hidden" id="HalfSeatnum" name="HalfSeatnum" value="<?php echo $rowticketmode['tml_HalfSeats'];?>"/>
	<input type="hidden" id="Allticket" name="Allticket" value="<?php echo $rowticketmode['tml_Allticket']?>"></input>
	<input type="hidden" id="state" name="state" value=""></input>
	<input type="hidden" id="ctID" name="ctID" value="" ></input>
	<input type="hidden" id="rtID" name="rtID" value=""></input>
</form>
</body>
</html>
