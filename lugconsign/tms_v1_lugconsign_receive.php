<?php
/*
 * 行包收件页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("tms_v1_lugconsign_lugprintdata.php");
require_once("../ui/inc/init.inc.php");
if(isset($_POST['DeliveryDate'])){
	$DeliveryDate=$_POST['DeliveryDate'];
	$FromStation=$_POST['lc_FromStation'];
	$ReachStation=$_POST['lc_Destination'];
	$NoOfRunsdate=$_POST['DeliveryDate'];
	$lc_CargoName=$_POST['lc_CargoName'];
	$lc_Numbers=$_POST['lc_Numbers'];
	$lc_Weight=$_POST['lc_Weight'];
	$lc_CargoDescription=$_POST['lc_CargoDescription'];
	$lc_ConsignName=$_POST['lc_ConsignName'];
	$lc_ConsignTel=$_POST['lc_ConsignTel'];
	$lc_ConsignPaperID=$_POST['lc_ConsignPaperID'];
	$lc_ConsignAdd=$_POST['lc_ConsignAdd'];
	$lc_UnloadName=$_POST['lc_UnloadName'];
	$lc_UnloadTel=$_POST['lc_UnloadTel'];
	$lc_UnloadPaperID=$_POST['lc_UnloadPaperID'];
	$lc_UnloadAdd=$_POST['lc_UnloadAdd'];
	$Isvalueinsured=$_POST['Isvalueinsured'];
	$lc_InsureMoney=$_POST['lc_InsureMoney'];
	$lc_InsureFee=$_POST['lc_InsureFee'];
	$PayStyle=$_POST['PayStyle'];
	$lc_ConsignMoney=$_POST['lc_ConsignMoney'];
	$lc_PackingMoney=$_POST['lc_PackingMoney'];
	$lc_LabelMoney=$_POST['lc_LabelMoney'];
	$lc_HandlingMoney=$_POST['lc_HandlingMoney'];
	$getticketmoney=$_POST['getticketmoney'];
	$realticketmoney=$_POST['realticketmoney'];
	$reticketmoney=$_POST['reticketmoney'];
	$lc_Remark=$_POST['lc_Remark'];
	$lc_BusNumber=$_POST['lc_BusNumber'];
	$lc_BusID=$_POST['lc_BusID'];
	$lc_NoOfRunsID=$_POST['lc_NoOfRunsID'];
}

/*
$lc_DeliveryUserID = $_POST['lc_DeliveryUserID'];
$lc_DeliveryUser = $_POST['lc_DeliveryUser'];
$lc_StationID = $_POST['lc_StationID'];
$lc_Station = $_POST['lc_Station'];

if(isset($_POST['sureReceive'])) {
	$lc_Destination = $_POST['lc_Destination'];
	$lc_BusID = $_POST['lc_BusID'];
	$lc_BusNumber = $_POST['lc_BusNumber'];
	$lc_NoOfRunsID = $_POST['lc_NoOfRunsID'];
	$lc_CargoName = $_POST['lc_CargoName'];
	$lc_CargoDescription = $_POST['lc_CargoDescription'];
	$lc_ConsignName = $_POST['lc_ConsignName'];
	$lc_ConsignTel = $_POST['lc_ConsignTel'];
	$lc_ConsignAdd = $_POST['lc_ConsignAdd'];
	$lc_ConsignMoney = $_POST['lc_ConsignMoney'];
	$lc_UnloadName = $_POST['lc_UnloadName'];
	$lc_UnloadTel = $_POST['lc_UnloadTel'];
	$lc_UnloadAdd = $_POST['lc_UnloadAdd'];
	$lc_UnloadPapers = $_POST['lc_UnloadPapers'];
	$lc_Remark = $_POST['lc_Remark'];
	$lc_DeliveryDate = $_POST['lc_DeliveryDate'];
	$lc_DeliveryUserID = $_POST['lc_DeliveryUserID'];
	$lc_DeliveryUser = $_POST['lc_DeliveryUser'];
	$lc_StationID = $_POST['lc_StationID'];
	$lc_Station = $_POST['lc_Station'];
	$lc_Status = "托运中";
	$lc_AcceptDateTime = date('Y-m-d H:i:s');
	$lc_TicketNumber = $_POST['lc_TicketNumber'];
	$EndTicketNumber = $_POST['EndTicketNumber'];
	if($lc_TicketNumber == $EndTicketNumber) $tp_CurrentTicket = $lc_TicketNumber;
	else $tp_CurrentTicket = $lc_TicketNumber + 1;
	 
	$queryString1 = "INSERT INTO tms_lug_LuggageCons (lc_Destination, lc_BusID, lc_BusNumber, lc_NoOfRunsID, lc_CargoName, lc_CargoDescription, 
				lc_ConsignName, lc_ConsignTel, lc_ConsignAdd, lc_ConsignMoney, lc_UnloadName, lc_UnloadTel, lc_UnloadAdd, lc_UnloadPapers,
				lc_Remark, lc_DeliveryDate, lc_DeliveryUserID, lc_DeliveryUser, lc_StationID, lc_Station, lc_Status, lc_AcceptDateTime, lc_TicketNumber) 
				VALUES ('{$lc_Destination}', '{$lc_BusID}', '{$lc_BusNumber}', '{$lc_NoOfRunsID}', '{$lc_CargoName}', '{$lc_CargoDescription}', 
				'{$lc_ConsignName}', '{$lc_ConsignTel}', '{$lc_ConsignAdd}', '{$lc_ConsignMoney}', '{$lc_UnloadName}', '{$lc_UnloadTel}', 
				'{$lc_UnloadAdd}', '{$lc_UnloadPapers}', '{$lc_Remark}', '{$lc_DeliveryDate}', '{$lc_DeliveryUserID}', '{$lc_DeliveryUser}',
				'{$lc_StationID}',	'{$lc_Station}', '{$lc_Status}', '{$lc_AcceptDateTime}', '{$lc_TicketNumber}')"; 
	$queryString2 = "Update tms_bd_TicketProvide SET tp_CurrentTicket='{$tp_CurrentTicket}',tp_InceptTicketNum=tp_InceptTicketNum-1 
				WHERE tp_InceptUserID='{$userID}' AND tp_Type='托运单' AND tp_CurrentTicket='{$lc_TicketNumber}'";
	$class_mysql_default->my_query("BEGIN");
	$result1 = $class_mysql_default->my_query("$queryString1");
	$result2 = $class_mysql_default->my_query("$queryString2");
	if($result1 && $result2) {
		$class_mysql_default->my_query("COMMIT");
		echo "<script>alert('行包收件成功!');location.assign('tms_v1_lugconsign_query.php?RECVDONE=1');</script>";
	}
	else {
		$class_mysql_default->my_query("ROLLBACK");
		echo "<script>alert('行包收件失败!请重试。');location.assign('tms_v1_lugconsign_query.php?RECVDONE=1');</script>";
	}
	$class_mysql_default->my_query("END");  
}
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>行包收件</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/tms_v1_print.js"></script>				
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script type="text/javascript" src="../basedata/tms_v1_screen2.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			$("#table1").tablesorter();
			$("#table1 tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
			$("#table1 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$("#table1 tr").click(function(){
				$("#table1 tr:not(this)").css("background-color","#CCCCCC");
				$("#table1 tr:not(this)").mouseover(function(){$(this).css("background-color","#FFCC00");});
				$("#table1 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
				$(this).css("background-color","#FFCC00");
				$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
				$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
				$("#lc_BusID").val($(this).children().eq(0).text());
				$("#lc_BusNumber").val($(this).children().eq(1).text());
				$("#lc_NoOfRunsID").val($(this).children().eq(7).text());
			});
		});
		function businfor(url) {
			if(document.getElementById("lc_FromStation").value=='' || document.getElementById("lc_Destination").value=='' ){
				alert('出发站和目的站均不能为空！');
				return false;
			}
			var FromStation = document.getElementById("lc_FromStation").value;
			var Destination = document.getElementById("lc_Destination").value;
			var NoofRunDate = document.getElementById("DeliveryDate").value;
			url = url+'?FS='+FromStation+'&dest='+Destination+'&date='+NoofRunDate+'&time'+Math.random();
			//alert(url);
			window.open(url,'','width=900,height=400,top=100,left=100,toolbar=no,menubar=no,scrobars=yes,resizable=yes,location=no,status=no');
		}
		function searticketmodel(){
			if(document.getElementById("lc_FromStation").value=='' || document.getElementById("lc_Destination").value=='' ){
				alert('出发站和目的站均不能为空！');
				return false;
			} 
			var noofrun=document.getElementById("AddRuns").value;
			url='tms_v1_schedule_searaddrunmodel.php?op=sear&clnumber='+noofrun+'&time'+Math.random();
			window.open(url,'','width=900,height=520,top=100,left=100,toolbar=no,menubar=no,scrollbars=yes, resizable=yes,location=no,status=no');
		}
		function doPrintXB(printData) {
			var Wsh = new ActiveXObject("WScript.Shell");
			printPageSetup(Wsh);
			document.body.innerHTML = printData;
			document.body.insertAdjacentHTML("beforeEnd","<object id=\"WebBrowser\" width=0 height=0 classid=\"clsid:8856F961-340A-11D0-A96B-00C04FD705A2\">");
			WebBrowser.ExecWB(6,2); 
		} 
		function printTicket(objData)
		{
			
			var printData = "";
			var stleftPayStyle="";
			var stleftIsvalueinsure="";
			var strleftPayStyle=document.getElementById("leftPayStyle").value;
			var sstrleftPayStyle= strleftPayStyle.split('|');
			if(document.getElementById("PayStyle").value=='发货人付款'){
				stleftPayStyle=sstrleftPayStyle[0];	
			}else{
				if(document.getElementById("PayStyle").value=='收货人付款'){
					stleftPayStyle=sstrleftPayStyle[1];
				}else{
					stleftPayStyle=sstrleftPayStyle[2];
				}
			}
			var strleftIsvalueinsure=document.getElementById("leftIsvalueinsure").value;
			var sstrleftIsvalueinsure=strleftIsvalueinsure.split('|');
			if(document.getElementById("PayStyle").value=='1'){
				stleftIsvalueinsure=sstrleftIsvalueinsure[0];
			}else{
				stleftIsvalueinsure=sstrleftIsvalueinsure[1];
			}
			var str1 = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" /></head><body>';
			var str2 = '<table style="width:'+document.getElementById("width").value+'px;height:'+document.getElementById("height").value+'px;margin-left:'+document.getElementById("left").value+'px;margin-top:'+document.getElementById("top").value+'px;font-size:'+document.getElementById("fontsize").value+'px;border:1"><tr><td>';
			var str3 = '<div style="margin-top:'+document.getElementById("topStation").value+'px;"><div style="margin-left:'+document.getElementById("leftStation").value+'px;">'+objData.Station+'</div></div>';
			var str4 = '<div style="margin-top:'+document.getElementById("topTicketNumber").value+'px;"><div style="margin-left:'+document.getElementById("leftTicketNumber").value+'px;">'+objData.TicketNumber+'</div></div>';
			var str5 = '<div style="margin-top:'+document.getElementById("topBusID").value+'px;"><div style="margin-left:'+document.getElementById("leftBusID").value+'px;">' + objData.BusID + '</div></div>';
			var str6 = '<div style="margin-top:'+document.getElementById("topCargoName").value+'px;"><div style="margin-left:'+document.getElementById("leftCargoName").value+'px;float:left">' + objData.CargoName +'<span style="margin-left:'+document.getElementById("leftFromStation").value+'px;">' + objData.Station +' </span></div><div style="margin-left:'+document.getElementById("leftDestination").value+'px;">'+ objData.Destination +'<span style="margin-left:'+document.getElementById("leftDeliveryDate").value+'px;">'+objData.DeliveryDate+'</span></div></div>';
			var str7 = '<div style="margin-top:'+document.getElementById("topWeight").value+'px;"><div style="margin-left:'+document.getElementById("leftWeight").value+'px;float:left">'+objData.Weight+'</div><div style="margin-left:'+document.getElementById("leftNumbers").value+'px;">'+objData.Numbers+'</div></div>';
			var str8 = '<div style="margin-top:'+document.getElementById("topPayStyle").value+'px;"><div style="margin-left:'+stleftPayStyle+'px;float:left">√</div><div style="margin-left:'+stleftIsvalueinsure+'px;">√<span style="margin-left:'+document.getElementById("leftInsureMoney").value+'px;">'+objData.InsureMoney+'</span></div></div>';
			var str9 = '<div style="margin-top:'+document.getElementById("topConsignName").value+'px;"><div style="margin-left:'+document.getElementById("leftConsignName").value+'px;float:left"> '+ objData.ConsignName + '</div><div style="margin-left:'+document.getElementById("leftUnloadName").value+'px;">'+ objData.UnloadName + '</div></div>';
			var str10 = '<div style="margin-top:'+document.getElementById("topConsignTel").value+'px;"><div style="margin-left:'+document.getElementById("leftConsignTel").value+'px;float:left">' + objData.ConsignTel + '</div><div style="margin-left:'+document.getElementById("leftUnloadTel").value+'px;">' + objData.UnloadTel + '</div></div>';
			var str11 = '<div style="margin-top:'+document.getElementById("topConsignPapersID").value+'px;"><div style="margin-left:'+document.getElementById("leftConsignPapersID").value+'px;float:left">'+objData.ConsignPapersID+'</div><div style="margin-left:'+document.getElementById("leftUnloadPapersID").value+'px;">'+objData.UnloadPapersID+'</div></div>';
			var str12 = '<div style="margin-top:'+document.getElementById("topblank1").value+'px;"><div style="margin-left:'+document.getElementById("leftblank1").value+'px;float:left">&nbsp;</div><div style="margin-left:'+document.getElementById("leftblank2").value+'px;">&nbsp;</div></div>';
			var str13 = '<div style="margin-top:'+document.getElementById("topConsignMoney").value+'px;"><div style="margin-left:'+document.getElementById("leftConsignMoney").value+'px;float:left">'+ objData.ConsignMoney +'<span style="margin-left:'+document.getElementById("leftPackingMoney").value+'px;">'+objData.PackingMoney+'<span style="margin-left:'+document.getElementById("leftLabelMoney").value+'px;">'+objData.LabelMoney+'<span style="margin-left:'+document.getElementById("leftInsureFee").value+'px;">'+objData.InsureFee+'<span style="margin-left:'+document.getElementById("leftHandlingMoney").value+'px;">'+objData.HandlingMoney+'</span></span></span></span></div><div style="margin-left:'+document.getElementById("leftgetticketmoney").value+'px;">'+objData.Allmoney + '</div></div>';
			var str14 = '<div style="margin-top:'+document.getElementById("topblank1").value+'px;"><div style="margin-left:'+document.getElementById("leftblank1").value+'px;float:left">&nbsp;</div><div style="margin-left:'+document.getElementById("leftblank2").value+'px;">&nbsp;</div></div>';
			var str15 = '<div style="margin-top:'+document.getElementById("topblank1").value+'px;"><div style="margin-left:'+document.getElementById("leftblank1").value+'px;float:left">&nbsp;</div><div style="margin-left:'+document.getElementById("leftblank2").value+'px;">&nbsp;</div></div>';
			var str16 = '<div style="margin-top:'+document.getElementById("topDeliveryUserID").value+'px;"><div style="margin-left:'+document.getElementById("leftDeliveryUserID").value+'px;float:left">'+ objData.DeliveryUserID +'</div><div style="margin-left:'+document.getElementById("leftblank2").value+'px;">&nbsp;</div></div>';
			var str17 = '</td></tr></table></body></html>';
			printData = str1 + str2 + str3 + str4 + str5 + str6 + str7 + str8 + str9 + str10 + str11 + str12 + str13 + str14 + str15 + str16 + str17;		
			doPrintXB(printData);
			window.location.href='tms_v1_lugconsign_query.php';			
		}
		
	/*		$(document).ready(function(){
				$("#lc_BusID").blur(function(){
					jQuery.get(
						'tms_v1_lugconsign_getdata.php',
						{'op': 'getbusnumber', 'BusID': $("lc_BusID").val(),'time': Math.random()},
						function(data){
							var objData = eval('(' + data + ')');
							if(objData.retVal == "FAIL"){ 
								alert(objData.retString);
							}
							else{
								document.getElementById("lc_BusNumber").value = objData.BusNumber;
								document.getElementById("lc_NoOfRunsID").value = objData.NoOfRunsID;
							}	
					});
				});
			}); */
		
			$(document).ready(function(){
				$("#sureReceive").click(function(){
				//	var ss=document.getElementById("PayStyle").value;
				//	alert(ss);
					if(document.form1.lc_CargoName.value==""||document.form1.lc_Numbers.value==""||document.form1.lc_Weight.value==""){
						alert("货物名称、件数和重量均不能为空！");
						document.form1.lc_CargoName.focus();
						return;
						}
					if(document.form1.lc_ConsignName.value==""||document.form1.lc_ConsignTel.value==""){
						alert("托运人的姓名及电话均不能为空！");
						document.form1.lc_CargoName.focus();
						return;
						}
					if(document.form1.lc_UnloadName.value==""||document.form1.lc_UnloadTel.value==""){
						alert("收货人的姓名及电话均不能为空！");
						document.form1.lc_UnloadName.focus();
						return;
						}
					if(document.form1.lc_UnloadAdd.value==""){
						alert("收货人的地址不能为空！");
						document.form1.lc_UnloadAdd.focus();
						return; 
						}					
					if (document.form1.lc_NoOfRunsID.value=="" || document.form1.lc_BusNumber.value==""){
						alert("班次编号和车牌号不能为空！");
						document.form1.lc_BusID.focus();
						return;	
					}
					if (document.getElementById("PayStyle").value=='请选择付款方式' ||document.getElementById("PayStyle").value==''){
						alert("请选择付款方式！");
						document.getElementById("PayStyle").focus();
						return;	
					}
					if(document.getElementById("PayStyle").value=='发货人付款'){
						if (document.getElementById("realticketmoney").value - document.getElementById("getticketmoney").value< 0) {
							alert("实收款金额不足！");
							document.getElementById("realticketmoney1").focus();
							return;	
						}
					} 
					if (confirm('提交后将无法修改！确认提交?')){
						jQuery.get(
							'tms_v1_lugconsign_printok.php',
							{'op': 'confirmprint', 'TicketNumber': $("#lc_TicketNumber").val(), 'Destination': $("#lc_Destination").val(), 'NoOfRunsID': $("#lc_NoOfRunsID").val(),
						 	'BusID': $("#lc_BusID").val(), 'BusNumber': $("#lc_BusNumber").val(), 'DeliveryDate': $("#DeliveryDate").val(), 'CargoName': $("#lc_CargoName").val(),
						 	'Numbers': $("#lc_Numbers").val(), 'Weight': $("#lc_Weight").val(), 'CargoDescription': $("#lc_CargoDescription").val(),'ConsignName': $("#lc_ConsignName").val(),
						 	'ConsignTel': $("#lc_ConsignTel").val(), 'ConsignPaperID': $("#lc_ConsignPaperID").val(), 'ConsignAdd': $("#lc_ConsignAdd").val(),
							'ConsignMoney': $("#lc_ConsignMoney").val(),'PackingMoney': $("#lc_PackingMoney").val(),'LabelMoney': $("#lc_LabelMoney").val(), 'HandlingMoney': $("#lc_HandlingMoney").val(),
							'UnloadName': $("#lc_UnloadName").val(),'UnloadTel': $("#lc_UnloadTel").val(), 'UnloadPaperID': $('#lc_UnloadPaperID').val(),
							'UnloadAdd': $("#lc_UnloadAdd").val(),'Remark': $("#lc_Remark").val(),'tpID': $("#tpID").val(),'Isvalueinsured':$("#Isvalueinsured").val(),'InsureMoney':$("#lc_InsureMoney").val(),
							'InsureFee':$("#lc_InsureFee").val(),'PayStyle':$("#PayStyle").val(),'Allmoney': $("#getticketmoney").val(),'time': Math.random()},
							 function(data){																 								 
								var objData = eval('(' + data + ')');
								if(objData.retVal == "FAIL"){ 
									alert(objData.retString);
								}
								else{
									if(document.getElementById("PayStyle").value=='发货人付款'){
										document.getElementById("reticketmoney").value = document.getElementById("realticketmoney").value - document.getElementById("getticketmoney").value;
										document.getElementById("reticketmoney").focus();																	
										alert("找零后点击确定打票！");
									}
									printTicket(objData);
								}
						});
					}
				});
			}); 
		$(document).ready(function(){
			$("#getticketmoney").click(function(){
				document.getElementById("getticketmoney").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
																+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
																+document.getElementById("lc_HandlingMoney").value*1;
				document.getElementById("getticketmoney1").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
																+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
																+document.getElementById("lc_HandlingMoney").value*1;
			});
		});
		/*$(document).ready(function(){
			$("#querybus").click(function(){
				if(document.getElementById("lc_FromStation").value==""){
					alert('出发地不能为空！');
					return false;
				}
				if(document.getElementById("lc_Destination").value==""){
					alert('目的地不能为空！');
					return false;
				}			
				document.form1.submit();
				document.getElementById("disorno").style.display='';
				
				
			});
		}); */
		$(document).ready(function(){
			
			$("#realticketmoney1").keyup(function(e){
				var number = document.getElementById("realticketmoney1").value;
				if(isNaN(number)){
					alert(number+"不是数字！");
					document.getElementById("realticketmoney1").value='';
					document.getElementById("realticketmoney").value='';
					document.getElementById("realticketmoney1").focus();
				}else{
					document.getElementById("realticketmoney").value=document.getElementById("realticketmoney1").value;
				}
			});
			$("#lc_ConsignMoney").keyup(function(e){				
				var number = document.getElementById("lc_ConsignMoney").value;
					if(isNaN(number)){
						alert(number+"不是数字！");
						document.getElementById("lc_ConsignMoney").value='';
						document.getElementById("getticketmoney").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1; 
						document.getElementById("getticketmoney1").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1; 						
						return false;
						}				
				if ($.browser.msie) {  // 判断浏览器
                    if ( ((event.keyCode > 47) && (event.keyCode < 58)) || (event.keyCode == 8) ) {                       
                    	document.getElementById("getticketmoney").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1; 
                    	document.getElementById("getticketmoney1").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;
                           return true;  
                     } else {  
                           return false;  
                    }
              } else {  
                 if ( ((e.which > 47) && (e.which < 58)) || (e.which == 8) || (event.keyCode == 17) ) {
                	 document.getElementById("getticketmoney").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1; 
                	 document.getElementById("getticketmoney1").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;  
                          return true;  
                  } else {  
                          return false;  
                  }  
              }				
			});		
		});
		
		
		
		$(document).ready(function(){
			$("#lc_PackingMoney").keyup(function(e){
				var number = document.getElementById("lc_PackingMoney").value;
					if(isNaN(number)){
						alert(number+"不是数字！");
						document.getElementById("lc_PackingMoney").value='';
						document.getElementById("getticketmoney").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;
						document.getElementById("getticketmoney1").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;
						return false;
						}				
				if ($.browser.msie) {  // 判断浏览器
                    if ( ((event.keyCode > 47) && (event.keyCode < 58)) || (event.keyCode == 8) ) {               
                    	document.getElementById("getticketmoney").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;
                    	document.getElementById("getticketmoney1").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;  
                           return true;  
                     } else {  
                           return false;  
                    }
              } else {  
                 if ( ((e.which > 47) && (e.which < 58)) || (e.which == 8) || (event.keyCode == 17) ) {
                	 document.getElementById("getticketmoney").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;
                	 document.getElementById("getticketmoney1").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;  
                          return true;  
                  } else {  
                          return false;  
                  }  
              }				
			});		
		});
		$(document).ready(function(){
			$("#lc_LabelMoney").keyup(function(e){
				var number = document.getElementById("lc_LabelMoney").value;
					if(isNaN(number)){
						alert(number+"不是数字！");
						document.getElementById("lc_LabelMoney").value='';
						document.getElementById("getticketmoney").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;
						document.getElementById("lc_LabelMoney").value='';
						document.getElementById("getticketmoney1").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;
						return false;
						}				
				if ($.browser.msie) {  // 判断浏览器
                    if ( ((event.keyCode > 47) && (event.keyCode < 58)) || (event.keyCode == 8) ) {                        
                    	document.getElementById("getticketmoney").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1; 
                    	document.getElementById("getticketmoney1").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;
                           return true;  
                     } else {  
                           return false;  
                    }
              } else {  
                 if ( ((e.which > 47) && (e.which < 58)) || (e.which == 8) || (event.keyCode == 17) ) {
                	 document.getElementById("getticketmoney").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;
                	 document.getElementById("getticketmoney1").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;  
                          return true;  
                  } else {  
                          return false;  
                  }  
              }				
			});		
		});
		
		$(document).ready(function(){
			$("#lc_InsureMoney").keyup(function(e){
				var number = document.getElementById("lc_InsureMoney").value;
				if(isNaN(number)){
					alert(number+"不是数字！");
					document.getElementById("lc_InsureMoney").value='';
				}
			});
			$("#lc_InsureFee").keyup(function(e){
				var number = document.getElementById("lc_InsureFee").value;
					if(isNaN(number)){
						alert(number+"不是数字！");
						document.getElementById("lc_InsureFee").value='';
						document.getElementById("getticketmoney").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;
						document.getElementById("getticketmoney1").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;
						return false;
						}				
				if ($.browser.msie) {  // 判断浏览器
                    if ( ((event.keyCode > 47) && (event.keyCode < 58)) || (event.keyCode == 8) ) {                    
                    	document.getElementById("getticketmoney").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;
                    	document.getElementById("getticketmoney1").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;  
                           return true;  
                     } else {  
                           return false;  
                    }
              } else {  
                 if ( ((e.which > 47) && (e.which < 58)) || (e.which == 8) || (event.keyCode == 17) ) {
                	 document.getElementById("getticketmoney").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;
                	 document.getElementById("getticketmoney1").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;  
                          return true;  
                  } else {  
                          return false;  
                  }  
              }				
			});		
			$("#lc_HandlingMoney").keyup(function(e){
				var number = document.getElementById("lc_HandlingMoney").value;
					if(isNaN(number)){
						alert(number+"不是数字！");
						document.getElementById("lc_HandlingMoney").value='';
						document.getElementById("getticketmoney").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;
						document.getElementById("getticketmoney1").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;
						return false;
						}				
				if ($.browser.msie) {  // 判断浏览器
                    if ( ((event.keyCode > 47) && (event.keyCode < 58)) || (event.keyCode == 8) ) {                    
                    	document.getElementById("getticketmoney").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;
                    	document.getElementById("getticketmoney1").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;  
                           return true;  
                     } else {  
                           return false;  
                    }
              } else {  
                 if ( ((e.which > 47) && (e.which < 58)) || (e.which == 8) || (event.keyCode == 17) ) {
                	 document.getElementById("getticketmoney").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;
                	 document.getElementById("getticketmoney1").value=document.getElementById("lc_ConsignMoney").value*1+document.getElementById("lc_InsureFee").value*1
						+document.getElementById("lc_PackingMoney").value*1+document.getElementById("lc_LabelMoney").value*1
						+document.getElementById("lc_HandlingMoney").value*1;  
                          return true;  
                  } else {  
                          return false;  
                  }  
              }				
			});		
		});
		
		$(document).ready(function(){
			$("#lc_FromStation").keyup(function(){
				document.getElementById("EndStationselect").style.display="none";
				$("#BeginStationselect").empty();
				document.getElementById("BeginStationselect").style.display=""; 
				var fromstation = $("#lc_FromStation").val();
				jQuery.get(
					'../lugconsign/tms_v1_lugconsign_ops.php',
					{'op': 'getstation', 'fromstation': fromstation, 'time': Math.random()},
					function(data){						
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].from + ">" + objData[i].from + "</option>").appendTo($("#BeginStationselect"));
						}
						if(fromstation==''){
							document.getElementById("BeginStationselect").style.display="none";
						}
				});
			    document.onkeydown = function (event){
			  		var e = event || window.event || arguments.callee.caller.arguments[0];
			    	if (e && e.keyCode == 13) {
			     		$("#BeginStationselect").focus();
			     		$("#BeginStationselect option:eq(0)").attr({selected:"selected"});
			        }
			   };
			});
			$("#lc_Destination").keyup(function(){
				document.getElementById("BeginStationselect").style.display="none";
				$("#EndStationselect").empty();
				document.getElementById("EndStationselect").style.display=""; 
				var fromstation = $("#lc_Destination").val();
				jQuery.get(
					'../lugconsign/tms_v1_lugconsign_ops.php',
					{'op': 'getstation', 'fromstation': fromstation, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].from + ">" + objData[i].from + "</option>").appendTo($("#EndStationselect"));
											}
						if(fromstation==''){
							document.getElementById("EndStationselect").style.display="none";
						}
				});
			   	document.onkeydown = function (event) {
			  		var e = event || window.event || arguments.callee.caller.arguments[0];
			     	if (e && e.keyCode == 13) {
			     		$("#EndStationselect").focus();
			     		$("#EndStationselect option:eq(0)").attr({selected:"selected"});
			     	}
			   	};
			});
			$(document).click(function(){
				document.getElementById("BeginStationselect").style.display="none";
				document.getElementById("EndStationselect").style.display="none";
			});
			document.getElementById("BeginStationselect").onkeydown = function (event) {
	            var e = event || window.event || arguments.callee.caller.arguments[0];
	            if (e && e.keyCode == 13) {
	            	document.getElementById("lc_FromStation").value=document.getElementById("BeginStationselect").value;
	           		document.getElementById("BeginStationselect").style.display="none";
	           		document.getElementById("lc_Destination").focus();
	            } 
			};
			document.getElementById("BeginStationselect").onclick = function (event){
				document.getElementById("lc_FromStation").value=document.getElementById("BeginStationselect").value;
				document.getElementById("BeginStationselect").style.display="none";
			};
			document.getElementById("EndStationselect").onkeydown = function (event) {
	            var e = event || window.event || arguments.callee.caller.arguments[0];
	            if (e && e.keyCode == 13) {
	            	document.getElementById("lc_Destination").value=document.getElementById("EndStationselect").value;
	           		document.getElementById("EndStationselect").style.display="none";
	           	//	document.getElementById("LineID").focus();
	            } 
			};
			document.getElementById("EndStationselect").onclick = function (event){
				document.getElementById("lc_Destination").value=document.getElementById("EndStationselect").value;
				document.getElementById("EndStationselect").style.display="none";
			}; 
		});
		
		function getvalueanddis(){
			if (document.getElementById("Isvalueinsure").checked){
				document.getElementById("Isvalueinsured").value=1;
				document.getElementById("Fees").style.display="";
			}else{
				document.getElementById("Isvalueinsured").value=0;
				document.getElementById("lc_InsureMoney").value=0;
				document.getElementById("lc_InsureFee").value=0;
				document.getElementById("Fees").style.display="none";
			}	
		}
		function disAboutMoney(){
			if (document.getElementById("PayStyle").value=='发货人付款' || document.getElementById("PayStyle").value=='收货人付款' ){
				document.getElementById("AboutMoney").style.display="";
			}else{
				document.getElementById("AboutMoney").style.display="none";
				document.getElementById("realticketmoney").value='';
				document.getElementById("realticketmoney1").value='';
				};
				if (document.getElementById("PayStyle").value=='收货人付款' ){
					document.getElementById("realticketmoney1").value = '0';
					document.getElementById("realticketmoney").value = '0';
					document.getElementById("realticketmoney1").disabled = true;
				}
				if (document.getElementById("PayStyle").value=='发货人付款' ){
					document.getElementById("realticketmoney").value = '';
					document.getElementById("realticketmoney1").value = '';
					document.getElementById("realticketmoney1").disabled = false;
				}
								
		}
</script>
<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
<link href="../css/tms.css" rel="stylesheet" type="text/css" />		
</head>
	<body style="scrollin:auto;">
		<form  method="post" action=""  name="form1" >		
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span  style="margin-left:8px;"> 行 包 收 件 信 息</span></td>
			</tr>
		</table>		
		<table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">	
  		
  			<tr>
    			<td colspan="8" bgcolor="#d4d1d1"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 发 货 信 息</td>
  			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发货日期：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" id="DeliveryDate" size="12" class="Wdate" value="<?php if($DeliveryDate=='') echo date('Y-m-d'); else echo $DeliveryDate;?>" name="DeliveryDate" onclick="WdatePicker({onpicked:function(dp){$dp.$('lc_DeliveryDate').value=dp.cal.getDateStr();}});" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 货物名称：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_CargoName" id="lc_CargoName" value="<?php echo $lc_CargoName;?>" /><span style="color:red">*</span></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 件数：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_Numbers" id="lc_Numbers" value="<?php echo $lc_Numbers;?>" /><span style="color:red">*</span></td>
			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 重量：</span></td>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="lc_Weight" id="lc_Weight" value="<?php echo $lc_Weight;?>" />kg <span style="color:red">*</span></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 货物描述：</span></td>
				<td  colspan="6" bgcolor="#FFFFFF"><input style="width:90%" type="text" name="lc_CargoDescription" id="lc_CargoDescription" value="<?php echo $lc_CargoDescription;?>" /></td>
			</tr>
 			<tr>
    			<td colspan="8" bgcolor="#d4d1d1""><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 托 运 人 信 息</td>
  			</tr>
			<tr>	
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 托运人姓名：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_ConsignName" id="lc_ConsignName" value="<?php echo $lc_ConsignName;?>" /><span style="color:red">*</span></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 托运人电话：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_ConsignTel" id="lc_ConsignTel" value="<?php echo $lc_ConsignTel;?>" /><span style="color:red">*</span></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 托运人证件号码：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_ConsignPaperID" id="lc_ConsignPaperID" value="<?php echo $lc_ConsignPaperID;?>" /></td>
				</tr>
				<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 托运人地址：</span></td>
				<td bgcolor="#FFFFFF" colspan="5"><input type="text" name="lc_ConsignAdd" id="lc_ConsignAdd" value="<?php echo $lc_ConsignAdd;?>" /></td>
			</tr>
  			<tr>
    			<td colspan="8" bgcolor="#d4d1d1""><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 收 货 人 信 息</td>
  			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收货人姓名：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_UnloadName" id="lc_UnloadName" value="<?php echo $lc_UnloadName;?>" /><span style="color:red">*</span></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收货人电话：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_UnloadTel" id="lc_UnloadTel" value="<?php echo $lc_UnloadTel;?>" /><span style="color:red">*</span></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收货人证件号码：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_UnloadPaperID" id="lc_UnloadPaperID" value="<?php echo $lc_UnloadPaperID;?>" /></td>
				</tr>
				<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收货人地址：</span></td>
				<td nowrap="nowrap" bgcolor="#FFFFFF" colspan="5"><input type="text" name="lc_UnloadAdd" id="lc_UnloadAdd" value="<?php echo $lc_UnloadAdd;?>" /><span style="color:red">*</span></td>
			</tr>
			<tr>
    			<td colspan="8" bgcolor="#d4d1d1""><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 收 费 信 息</td>
  			</tr>
  			<tr>
  				<td colspan="8" nowrap="nowrap" bgcolor="FFFFFF"><input type="hidden" name="Isvalueinsured" id="Isvalueinsured" value="<?php echo $Isvalueinsured;?>"/>
    				<input type="checkbox" name="Isvalueinsure" id="Isvalueinsure" <?php if($Isvalueinsured==1) echo 'checked'; ?> onclick="getvalueanddis(this.id,'Isvalueinsured')" />是否保价</td>
    		</tr>
    	<tbody id="Fees" style="DISPLAY: <?php if ($Isvalueinsured==1) echo ''; else echo 'none';?>">
    		<tr >
    				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保价金额：</span></td>
					<td bgcolor="#FFFFFF"><input type="text" name="lc_InsureMoney" id="lc_InsureMoney" value="<?php echo $lc_InsureMoney;?>" /></td>
					<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保价费用：</span></td>
					<td colspan="5" bgcolor="#FFFFFF"><input type="text" name="lc_InsureFee" id="lc_InsureFee" value="<?php echo $lc_InsureFee;?>" /></td>
				<!-- 	<td colspan="4"  bgcolor="#FFFFFF"></td>  -->										
			</tr>	
		</tbody>
			<tr>
				<td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />付款方式：</span></td>
				<td colspan="7"  bgcolor="#FFFFFF">
					<select name="PayStyle" id="PayStyle" onchange="return disAboutMoney()">
					<?php 
						if($PayStyle=='') echo "<option selected=\"selected\">请选择付款方式</option>";
						else echo "<option>请选择付款方式</option>";
						if($PayStyle=='发货人付款') echo "<option selected=\"selected\" value=\"发货人付款\">发货人付款</option>";
						else echo "<option  value=\"发货人付款\">发货人付款</option>";
						if($PayStyle=='收货人付款') echo "<option selected=\"selected\" value=\"收货人付款\">收货人付款</option>";
						else echo "<option  value=\"收货人付款\">收货人付款</option>";
						//if($PayStyle=='其他') echo "<option selected=\"selected\" value=\"其他\">其他</option>";
						//else echo "<option  value=\"其他\">其他</option>";
					?>
        			</select><span style="color:red">*</span>
				</td>
			</tr>
			 
			<tbody id="AboutMoney" style="DISPLAY: <?php if($PayStyle=='发货人付款'||$PayStyle=='收货人付款') echo ''; else echo 'none';?> ">
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 托运费：</span></td>
				<td bgcolor="#FFFFFF"><input  type="text" name="lc_ConsignMoney" id="lc_ConsignMoney" value="<?php echo $lc_ConsignMoney;?>" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 包装费：</span></td>
				<td bgcolor="#FFFFFF"><input  type="text" name="lc_PackingMoney" id="lc_PackingMoney" value="<?php echo $lc_PackingMoney;?>" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 标签费：</span></td>
				<td bgcolor="#FFFFFF"><input  type="text" name="lc_LabelMoney" id="lc_LabelMoney" value="<?php echo $lc_LabelMoney;?>" /></td>
			</tr>
			<tr>	
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 装卸费：</span></td>
				<td bgcolor="#FFFFFF"><input  type="text" name="lc_HandlingMoney" id="lc_HandlingMoney" value="<?php echo $lc_HandlingMoney;?>" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 应收款：</span></td>
				<td bgcolor="#FFFFFF">
					<input type="text" name="getticketmoney1" id="getticketmoney1" value="<?php echo $getticketmoney;?>" disabled="disabled"/>
					<input type="hidden" name="getticketmoney" id="getticketmoney" value="<?php echo $getticketmoney;?>" />
				</td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 实收款：</span></td>
				<td  bgcolor="#FFFFFF">
					<input type="text" name="realticketmoney1" id="realticketmoney1" value="<?php if($PayStyle=='收货人付款') echo '0' ?>" />
					<input type="hidden" name="realticketmoney" id="realticketmoney" value="<?php if($PayStyle=='收货人付款') echo '0' ?>" />	
				</td>
  			</tr>
  		</tbody>
  			<tr>
  				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 找零：</span></td>
				<td bgcolor="#FFFFFF"><input  type="text" name="reticketmoney" id="reticketmoney" value="<?php echo $reticketmoney;?>" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 当前托运单号：</span></td>
				<?php 
					$queryString = "SELECT tp_ID, tp_BeginTicket,tp_CurrentTicket,tp_EndTicket FROM tms_bd_TicketProvide WHERE tp_InceptUserID='{$userID}' 
								AND tp_Type='托运单' AND tp_InceptTicketNum>0 ORDER BY tp_ProvideData ASC";
					$result = $class_mysql_default->my_query("$queryString");
					if ($row = mysql_fetch_array($result)) {
						$lc_TicketNumber = $row['tp_CurrentTicket'];
						$EndTicketNumber = $row['tp_EndTicket'];
					}else {
						echo "<script>if (!confirm('没有可用的托运单票据！是否继续？')) location.assign('tms_v1_lugconsign_query.php');</script>";
					}
				?>
				<td bgcolor="#FFFFFF">
				<input type="text" id="lc_TicketNumber" name="lc_TicketNumber" id="lc_TicketNumber" value="<?php echo $lc_TicketNumber;?>"  disabled="disabled"/>
				<input type="hidden" id="tpID" name="tpID" id="lc_TicketNumber" value="<?php echo $row['tp_ID'];?>"  /></td>
				
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 备注：</span></td>
				<td colspan='5' bgcolor="#FFFFFF"><input style="width:90%" type="text" name="lc_Remark" id="lc_Remark" value="<?php echo $lc_Remark;?>" /></td>
			</tr>
			<tr>
    			<td colspan="8" bgcolor="#d4d1d1""><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 车 辆 信 息</td>
  			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 出发站：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_FromStation" id="lc_FromStation" value="<?php if($ReachStation=='') echo $userStationName; else echo $FromStation;?>" />
					<br/>
	    			<select id="BeginStationselect" name="BeginStationselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
				</td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 目的站：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_Destination" id="lc_Destination" value="<?php  echo $ReachStation;?>" />
					<br/>
	    			<select id="EndStationselect" name="EndStationselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
				</td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_BusNumber" id="lc_BusNumber" value="<?php echo $lc_BusNumber;?>" />
					<input type="hidden" name="lc_BusID" id="lc_BusID" value="<?php echo $lc_BusID;?>" />
				</td>
				</tr>
				<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：</span></td>
				<td bgcolor="#FFFFFF" colspan="5"><input type="text" name="lc_NoOfRunsID" id="lc_NoOfRunsID" value="<?php echo $lc_NoOfRunsID;?>" /></td>
			</tr>
			<tr>
				<td colspan='8' align="center" bgcolor="#FFFFFF">
					<input type="button" id="querybus" name="querybus" value="查询车辆信息"  onclick = "businfor('tms_v1_lugconsign_businfor.php')" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;					
					<input type="button" id="sureReceive" name="sureReceive" value="确认收件" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" value="返回" onclick="location.assign('tms_v1_lugconsign_query.php?RECVDONE=1');" />
				</td>
			</tr>
		</table>
					
					<input type="hidden" id="lc_DeliveryDate" value="<?php echo date('Y-m-d');?>" name="lc_DeliveryDate" />
					<input type="hidden" id="lc_DeliveryUserID" value="<?php echo $lc_DeliveryUserID?>" name="lc_DeliveryUserID" />
					<input type="hidden" id="lc_DeliveryUser" value="<?php echo $lc_DeliveryUser?>" name="lc_DeliveryUser" />
					<input type="hidden" id="lc_StationID" value="<?php echo $lc_StationID?>" name="lc_StationID" />
					<input type="hidden" id="lc_Station" value="<?php echo $lc_Station?>" name="lc_Station" />
					<input type="hidden" id="EndTicketNumber" value="<?php echo $EndTicketNumber?>" name="EndTicketNumber" />
					<input type="hidden" id="width" value="<?php echo $width?>" name="width" />
					<input type="hidden" id="height" value="<?php echo $height?>" name="height" />
					<input type="hidden" id="left" value="<?php echo $left?>" name="left" />
					<input type="hidden" id="top" value="<?php echo $top?>" name="top" />
					<input type="hidden" id="fontsize" value="<?php echo $fontsize?>" name="fontsize" />
					<input type="hidden" id="leftStation" value="<?php echo $leftStation?>" name="leftStation" />
					<input type="hidden" id="topStation" value="<?php echo $topStation?>" name="topStation" />
					<input type="hidden" id="leftTicketNumber" value="<?php echo $leftTicketNumber?>" name="leftTicketNumber" />
					<input type="hidden" id="topTicketNumber" value="<?php echo $topTicketNumber?>" name="topTicketNumber" />
					<input type="hidden" id="leftBusID" value="<?php echo $leftBusID?>" name="leftBusID" />
					<input type="hidden" id="topBusID" value="<?php echo $topBusID?>" name="topBusID" />
					<input type="hidden" id="leftSicheng" value="<?php echo $leftSicheng?>" name="leftSicheng" />
					<input type="hidden" id="topSicheng" value="<?php echo $topSicheng?>" name="topSicheng" />
					<input type="hidden" id="leftCargoName" value="<?php echo $leftCargoName?>" name="leftCargoName" />
					<input type="hidden" id="topCargoName" value="<?php echo $topCargoName?>" name="topCargoName" />
					<input type="hidden" id="leftFromStation" value="<?php echo $leftFromStation?>" name="leftFromStation" />
					<input type="hidden" id="topFromStation" value="<?php echo $topFromStation?>" name="topFromStation" />
					<input type="hidden" id="leftDestination" value="<?php echo $leftDestination?>" name="leftDestination" />
					<input type="hidden" id="topDestination" value="<?php echo $topDestination?>" name="topDestination" />
					<input type="hidden" id="leftDeliveryDate" value="<?php echo $leftDeliveryDate?>" name="leftDeliveryDate" />
					<input type="hidden" id="topDeliveryDate" value="<?php echo $topDeliveryDate?>" name="topDeliveryDate" />
					<input type="hidden" id="leftWeight" value="<?php echo $leftWeight?>" name="leftWeight" />
					<input type="hidden" id="topWeight" value="<?php echo $topWeight?>" name="topWeight" />
					<input type="hidden" id="leftNumbers" value="<?php echo $leftNumbers?>" name="leftNumbers" />
					<input type="hidden" id="topNumbers" value="<?php echo $topNumbers?>" name="topNumbers" />
					<input type="hidden" id="leftPayStyle" value="<?php echo $leftPayStyle?>" name="leftPayStyle" />
					<input type="hidden" id="topPayStyle" value="<?php echo $topPayStyle?>" name="topPayStyle" />
					<input type="hidden" id="leftIsvalueinsure" value="<?php echo $leftIsvalueinsure?>" name="leftIsvalueinsure" />
					<input type="hidden" id="topIsvalueinsure" value="<?php echo $topIsvalueinsure?>" name="topIsvalueinsure" />
					<input type="hidden" id="leftInsureMoney" value="<?php echo $leftInsureMoney?>" name="leftInsureMoney" />
					<input type="hidden" id="topInsureMoney" value="<?php echo $topInsureMoney?>" name="topInsureMoney" />
					<input type="hidden" id="leftConsignName" value="<?php echo $leftConsignName?>" name="leftConsignName" />
					<input type="hidden" id="topConsignName" value="<?php echo $topConsignName?>" name="topConsignName" />
					<input type="hidden" id="leftUnloadName" value="<?php echo $leftUnloadName?>" name="leftUnloadName" />
					<input type="hidden" id="topUnloadName" value="<?php echo $topUnloadName?>" name="topUnloadName" />
					<input type="hidden" id="leftConsignTel" value="<?php echo $leftConsignTel?>" name="leftConsignTel" />
					<input type="hidden" id="topConsignTel" value="<?php echo $topConsignTel?>" name="topConsignTel" />
					<input type="hidden" id="leftUnloadTel" value="<?php echo $leftUnloadTel?>" name="leftUnloadTel" />
					<input type="hidden" id="topUnloadTel" value="<?php echo $topUnloadTel?>" name="topUnloadTel" />
					<input type="hidden" id="leftConsignPapersID" value="<?php echo $leftConsignPapersID?>" name="leftConsignPapersID" />
					<input type="hidden" id="topConsignPapersID" value="<?php echo $topConsignPapersID?>" name="topConsignPapersID" />
					<input type="hidden" id="leftUnloadPapersID" value="<?php echo $leftUnloadPapersID?>" name="leftUnloadPapersID" />
					<input type="hidden" id="topUnloadPapersID" value="<?php echo $topUnloadPapersID?>" name="topUnloadPapersID" />
					<input type="hidden" id="leftConsignMoney" value="<?php echo $leftConsignMoney?>" name="leftConsignMoney" />
					<input type="hidden" id="topConsignMoney" value="<?php echo $topConsignMoney?>" name="topConsignMoney" />
					<input type="hidden" id="leftPackingMoney" value="<?php echo $leftPackingMoney?>" name="leftPackingMoney" />
					<input type="hidden" id="topPackingMoney" value="<?php echo $topPackingMoney?>" name="topPackingMoney" />
					<input type="hidden" id="leftLabelMoney" value="<?php echo $leftLabelMoney?>" name="leftLabelMoney" />
					<input type="hidden" id="topLabelMoney" value="<?php echo $topLabelMoney?>" name="topLabelMoney" />
					<input type="hidden" id="leftInsureFee" value="<?php echo $leftInsureFee?>" name="leftInsureFee" />
					<input type="hidden" id="topInsureFee" value="<?php echo $topInsureFee?>" name="topInsureFee" />
					<input type="hidden" id="leftHandlingMoney" value="<?php echo $leftHandlingMoney?>" name="leftHandlingMoney" />
					<input type="hidden" id="topHandlingMoney" value="<?php echo $topHandlingMoney?>" name="topHandlingMoney" />
					<input type="hidden" id="leftgetticketmoney" value="<?php echo $leftgetticketmoney?>" name="leftgetticketmoney" />
					<input type="hidden" id="topgetticketmoney" value="<?php echo $topgetticketmoney?>" name="topgetticketmoney" />
					<input type="hidden" id="leftDeliveryUserID" value="<?php echo $leftDeliveryUserID?>" name="leftDeliveryUserID" />
					<input type="hidden" id="topDeliveryUserID" value="<?php echo $topDeliveryUserID?>" name="topDeliveryUserID" />
					<input type="hidden" id="leftblank1" value="<?php echo $leftblank1?>" name="leftblank1" />
					<input type="hidden" id="topblank1" value="<?php echo $topblank1?>" name="topblank1" />
					<input type="hidden" id="leftblank2" value="<?php echo $leftblank2?>" name="leftblank2" />
					<input type="hidden" id="topblank2" value="<?php echo $topblank2?>" name="topblank2" />
	
</form>
</body>
</html>
