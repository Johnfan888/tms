<?php
//车辆报班页面

//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$NoOfRunsID = $_GET['nrID'];
$LineName = $_GET['ln'];
$NoOfRunsdate = $_GET['nrDate'];
$CheckWindow = $_GET['qCW'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>车辆报班</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#reportBusID").focus();
		$("#reportBusID").keyup(function(e){
			if(e.keyCode == 13){
				//alert($("#reportBusID").val());
				jQuery.get(
					'../ui/inc/manageIC.php',
					{'op': 'GETBUSINFO', 'busIC': $("#reportBusID").val(), 'time': Math.random()},
					function(data){
						//alert(data);
						var objData = eval('(' + data + ')');
						if(objData.bc_BusID == null || objData.bc_BusID == ""){ 
							alert("此卡车辆不存在！请检查。");
							$("#reportBusID").val("");
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
		$("#getBusInfo").click(function(){
			if (document.form1.reportBusID.value == "" && document.form1.reportBusCard.value == "") {
				alert("请输入报班车辆编号或车牌号！");
				document.form1.reportBusID.focus();
			}
			else if (document.form1.reportBusID.value != "") {
				jQuery.get(
					'tms_v1_schedule_dataops.php',
					{'op': 'GETBUSINFOBYBUSID', 'busID': $("#reportBusID").val(), 'time': Math.random()},
					function(data){
						//alert(data);
						var objData = eval('(' + data + ')');
						if(objData.bi_BusID == null || objData.bi_BusID == ""){ 
							alert("此车辆编号的车不存在！请检查。");
							$("#reportBusID").val("");
							$("#reportBusCard").val("");
						}
						else{
							$("#reportBusID").val(objData.bi_BusID);
							if(objData.bi_BusNumber != null || objData.bi_BusNumber != "") $("#reportBusCard").val(objData.bi_BusNumber);
							if(objData.bi_IsSafetyCheck == "检验不合格" || objData.bi_IsSafetyCheck == ""){
								if (!confirm('安检不合格或没有安检，是否继续?')){
									document.form1.reportBusID.focus();
									return;
								}
							} 
							document.form1.submit();
						}
				});
			}
			else {
				jQuery.get(
					'tms_v1_schedule_dataops.php',
					{'op': 'GETBUSINFOBYBUSNUMBER', 'bi_BusNumber': $("#reportBusCard").val(), 'time': Math.random()},
					function(data){
						//alert(data);
						var objData = eval('(' + data + ')');
						if(objData.bi_BusID == null || objData.bi_BusID == ""){ 
							alert("此车牌号的车不存在！请检查。");
							$("#reportBusID").val("");
							$("#reportBusCard").val("");
						}
						else{
							$("#reportBusID").val(objData.bi_BusID);
							if(objData.bi_BusNumber != null || objData.bi_BusNumber != "") $("#reportBusCard").val(objData.bi_BusNumber);
							if(objData.bi_IsSafetyCheck == "检验不合格" || objData.bi_IsSafetyCheck == ""){
								if (!confirm('安检不合格或没有安检，是否继续?')){
									document.form1.reportBusID.focus();
									return;
								}
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
			/*if ($("#reportBusID").val() != $("#scheduleBusID").val()){
				if (!confirm('报班车辆与待班车辆不一致，是否继续报班?')){
					document.form1.reportBusID.focus();
					return;
				}
			}*/
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
						alert("报班成功！");
						window.location.href='tms_v1_schedule_noofrunall.php?op=none>';
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
<form action="tms_v1_schedule_VehicleInfo.php" method="post" name="form1">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="1">
	<tr>
		<td colspan="6" bgcolor="#0083B5"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 报班信息：</td>
	</tr>
	<tr>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 发车日期:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input name="NoOfRunsdate" id="NoOfRunsdate" value="<?php echo $NoOfRunsdate?>" readonly="readonly"/></td>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 报班车编号:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input style="background-color:#F1E6C2" type="text" name="reportBusID" id="reportBusID" value=""/></td>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 报班车牌号:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input style="background-color:#F1E6C2" type="text" name="reportBusCard" id="reportBusCard" value="" /></td>
	</tr>
	<tr>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 班次:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input type="text" name="NoOfRunsID" id="NoOfRunsID" value="<?php echo $NoOfRunsID?>" readonly="readonly"/></td>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 线路:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input type="text" name="LineName" id="LineName" value="<?php echo $LineName?>" readonly="readonly" /></td>
		<td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 检票口:</span></td>
		<td width="10%" bgcolor="#FFFFFF"><input style="background-color:#F1E6C2" type="text" name="reportCheckWindow" id="reportCheckWindow" value="<?php echo $CheckWindow?>" /></td>
	</tr>
	<tr>
		<td align="center" colspan="6">
			<input id="getBusInfo" name="getBusInfo" type="button" value="报班车辆信息检查" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="confirmReport" name="confirmReport" type="button" value="报班确认" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="cancelReport" name="cancelReport" type="button" value="取消退出" onclick="window.location.href='tms_v1_schedule_noofrunall.php?op=none>';" />
		</td>
	</tr>
</table>
</form>
</body>
</html>
