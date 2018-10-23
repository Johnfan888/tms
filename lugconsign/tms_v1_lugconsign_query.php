<?php
/*
 * 行包托运页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$CheckBeginDate = "";
$CheckEndDate = "";
$StationName = "";
$Result = "";
$ticketNo = "";
$senderName = "";



if(isset($_POST['resultquery']) || isset($_POST['exceldoc']) || isset($_GET['RECVDONE']) || isset($_GET['EXDONE'])) {
	if(isset($_POST['resultquery']) || isset($_POST['exceldoc'])) {
		$CheckBeginDate = $_POST['date1Value'];
		$CheckEndDate = $_POST['date2Value'];
	}
	else if(isset($_GET['RECVDONE'])) {
		$CheckBeginDate = date('Y-m-d');
		$CheckEndDate = date('Y-m-d');		
	}
	else {
		$CheckBeginDate = date('Y-m-d', mktime(0,0,0,date("m"),date("d")-10,date("Y"))); // day number maybe changed based on the actual limitation of keeping days
		$CheckEndDate = date('Y-m-d');
	}
	$CheckBeginDatetime = $CheckBeginDate . " 00:00:00";
	$CheckEndDatetime = $CheckEndDate . " 23:59:59";
	if (($StationName = $_POST['stationselect']) == "")
		$StationName = "%";		
	if (($Result = $_POST['resultselect']) == '请选择托运状态')
		$Result = "%";			
	if (($ticketNo = $_POST['ticketNo']) == "")
		$ticketNo = "%";
	if (($senderName = $_POST['senderName']) == "")
		$senderName = "%";
	if(isset($_POST['exceldoc'])) {
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");
		
		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '', '', '', '', '', '', '行包信息表', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$CheckBeginDate" . "至" . "$CheckEndDate";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('托运单号', '目的地', '班次', '车辆编号', '车牌号', '发货日期', '收件人ID', '收件人', '收件时间', '托运人姓名', '托运人电话', 
				'托运人证件号码','托运人地址', '收货人姓名', '收货人电话', '收货人证件号码', '收货人地址', '货物名称', '货物件数', '货物重量', 
				'货物描述', '托运状态', '托运费', '包装费', '标签费', '装卸费', '提取人ID', '提取人', '提取时间', '备注', '收件车站', '是否保价','保价金额',
				'保价费', '付款方式','合计费用');
		fputcsv($fp, $head);
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = ""; 
		
		/*$queryString = "SELECT * FROM tms_lug_LuggageCons WHERE lc_AcceptDateTime >= '{$CheckBeginDatetime}' AND lc_AcceptDateTime <= '{$CheckEndDatetime}' 
					AND lc_Station LIKE '{$StationName}' AND lc_Status LIKE '{$Result}' AND lc_TicketNumber LIKE '{$ticketNo}' 
					AND lc_ConsignName LIKE '{$senderName}' ORDER BY lc_TicketNumber ASC";
		*/
		$queryString = "SELECT * FROM tms_lug_LuggageCons WHERE lc_AcceptDateTime >= '{$CheckBeginDatetime}' AND lc_AcceptDateTime <= '{$CheckEndDatetime}'  
								AND lc_Status LIKE '{$Result}' AND lc_TicketNumber LIKE '{$ticketNo}' 	AND lc_ConsignName LIKE '{$senderName}' 
								AND (lc_Station LIKE '{$StationName}'  OR lc_Destination LIKE '{$StationName}') 	ORDER BY lc_TicketNumber ASC";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysql_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			if($row['lc_Isvalueinsure']==1){
				$row['lc_Isvalueinsure']='是';
			}else{
				$row['lc_Isvalueinsure']='否';
			}
			$outputRow = array($row['lc_TicketNumber'], $row['lc_Destination'], $row['lc_NoOfRunsID'], $row['lc_BusID'], $row['lc_BusNumber'], 
					$row['lc_DeliveryDate'], $row['lc_DeliveryUserID'], $row['lc_DeliveryUser'], $row['lc_AcceptDateTime'],	
					$row['lc_ConsignName'], $row['lc_ConsignTel'], $row['lc_ConsignPaperID'], $row['lc_ConsignAdd'], $row['lc_UnloadName'], $row['lc_UnloadTel'], 
					$row['lc_UnloadPaperID'], $row['lc_UnloadAdd'], $row['lc_CargoName'],$row['lc_Numbers'],$row['lc_Weight'], $row['lc_CargoDescription'], 
					$row['lc_Status'], $row['lc_ConsignMoney'], $row['lc_PackingMoney'],$row['lc_LabelMoney'], $row['lc_HandlingMoney'],
					$row['lc_ExtractionUserID'], $row['lc_ExtractionUser'], $row['lc_ExtractionTime'], $row['lc_Remark'], $row['lc_Station'], $row['lc_Isvalueinsure'], 
					$row['lc_InsureMoney'], $row['lc_InsureFee'], $row['lc_PayStyle'], $row['lc_Allmoney']); 
			fputcsv($fp, $outputRow); 
		}
		fclose($fp);
		exit();
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>行包托运</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>		
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script>
		function disSelect(){
			if (document.getElementById("resultselect").value=='已收货'){
				document.getElementById("modbbus").disabled="";
			}else{
				document.getElementById("modbbus").disabled="disabled";
				}
		}
		$(document).ready(function(){
			$("#receive").click(function(){
				form3.lc_Station.value = form1.stationselect.value;
				form3.lc_StationID.value = "";
				document.form3.submit();
			});
			$("#extract").click(function(){
				if(document.getElementById("lc_Userstation").value== document.getElementById("lc_Destination").value||document.getElementById("lc_Userstation").value=="全部车站")
				{
				document.form2.submit();
				}
			else
			{
				alert('本站不是行包目的站，无法提取！');
				return false;
				}
				
			});
			$("#modbbus").click(function(){
				if(document.getElementById("lc_TicketNumber1").value==''){
					alert('请选择要更改车辆的行包！');
					return false;
				}
				document.form4.submit();
			});
			$("#table1").tablesorter();
			$("#table1 tr").mouseover(function(){$(this).css("background-color","#f1e6c2");});
			$("#table1 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$("#table1 tr").click(function(){				
				$("#table1 tr:not(this)").css("background-color","#CCCCCC");
				$("#table1 tr:not(this)").mouseover(function(){$(this).css("background-color","#f1e6c2");});
				$("#table1 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
				$(this).css("background-color","#FFCC00");
				$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
				$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
				$("#lc_TicketNumber").val($(this).children().eq(0).text());
				$("#lc_TicketNumber1").val($(this).children().eq(0).text());
				$("#lc_Destination").val($(this).children().eq(1).text());
				//$("#lc_DestinationID").val($(this).children().eq(2).text());
				$("#lc_NoOfRunsID").val($(this).children().eq(2).text());
				$("#lc_BusID").val($(this).children().eq(3).text());
				$("#lc_BusNumber").val($(this).children().eq(4).text());
				$("#lc_DeliveryDate").val($(this).children().eq(5).text());
				$("#lc_DeliveryUserID").val($(this).children().eq(6).text());
				$("#lc_DeliveryUser").val($(this).children().eq(7).text());
				$("#lc_AcceptDateTime").val($(this).children().eq(8).text());
				$("#lc_ConsignName").val($(this).children().eq(9).text());
				$("#lc_ConsignTel").val($(this).children().eq(10).text());
				$("#lc_ConsignPaperID").val($(this).children().eq(11).text());
				$("#lc_ConsignAdd").val($(this).children().eq(12).text());
				$("#lc_UnloadName").val($(this).children().eq(13).text());
				$("#lc_UnloadTel").val($(this).children().eq(14).text());
				$("#lc_UnloadPaperID").val($(this).children().eq(15).text());
				$("#lc_UnloadAdd").val($(this).children().eq(16).text());
				$("#lc_CargoName").val($(this).children().eq(17).text());
				$("#lc_Numbers").val($(this).children().eq(18).text());
				$("#lc_Weight").val($(this).children().eq(19).text());
				$("#lc_CargoDescription").val($(this).children().eq(20).text());
				$("#lc_Status").val($(this).children().eq(21).text());
				$("#lc_ConsignMoney").val($(this).children().eq(22).text());
				$("#lc_PackingMoney").val($(this).children().eq(23).text());
				$("#lc_LabelMoney").val($(this).children().eq(24).text());
				$("#lc_HandlingMoney").val($(this).children().eq(25).text());
				$("#lc_ExtractionUserID").val($(this).children().eq(26).text());
				$("#lc_ExtractionUser").val($(this).children().eq(27).text());
				$("#lc_ExtractionTime").val($(this).children().eq(28).text());
				$("#lc_Remark").val($(this).children().eq(29).text());
				$("#lc_Station").val($(this).children().eq(30).text());
				$("#lc_Isvalueinsure").val($(this).children().eq(31).text());
				$("#lc_InsureMoney").val($(this).children().eq(32).text());
				$("#lc_InsureFee").val($(this).children().eq(33).text());
				$("#lc_PayStyle").val($(this).children().eq(34).text());
				$("#lc_Allmoney").val($(this).children().eq(35).text());
				$("#lc_IsBalance").val($(this).children().eq(36).text());
				$("#lc_BalanceDateTime").val($(this).children().eq(37).text());
			});
			$("#table1 tr").click(function(){					
				var s = $(this).children().eq(21).text();
				//alert((document.getElementById("lc_Station").value)+(document.getElementById("lc_Destination").value));
				if(s=="已收货"&&(document.getElementById("lc_Userstation").value== document.getElementById("lc_Station").value))
				{
					document.getElementById("modbbus").disabled="";
					}
				else
				{
					document.getElementById("modbbus").disabled="disabled";
					};

				if((s=="托运中")&&(document.getElementById("lc_Userstation").value== document.getElementById("lc_Destination").value))
				{
					//alert((document.getElementById("lc_Userstation").value)+(document.getElementById("lc_Destination").value));
										
					document.getElementById("extract").disabled=""; 
					
				}
				else
				{
					document.getElementById("extract").disabled="disabled";
					};

				
			});

			
		});
		</script>
	</head>
	<body style="overflow-x:hidden;">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 行 包  信 息 查 询</span></td>
			</tr>
		</table>
	 	<form action="" method="post" name="form1"> 
				
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr bgcolor="#FFFFFF">
				<td nowrap="nowrap"  align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收/取件站：</span></td>
				<td>
					<select id="stationselect" name="stationselect" size="1">
		            <?php
		                
		            	if($userStationID == "all") {
		            ?>
						<?php if ($StationName == "" || $StationName == "%") { ?>
							<option value="" selected="selected">请选择车站</option>
						<?php } else { ?>
							<option value="" >请选择车站</option>
							<option value="<?php echo $StationName?>" selected="selected"><?php echo $StationName?></option>
						<?php } ?>
					<?php 
							$queryString = "SELECT DISTINCT sset_SiteName FROM tms_bd_SiteSet WHERE sset_IsStation=1";
							$result = $class_mysql_default->my_query("$queryString");
					        while($res = mysql_fetch_array($result)) {
			            		if($res['sset_SiteName'] != $StationName) {
					?>
		            		<option value="<?php echo $res['sset_SiteName'];?>"><?php echo $res['sset_SiteName'];?></option>
		            <?php 
								}
							}
		            	}
		            	else {
		            ?>
						<option value="<?php echo $userStationName;?>" selected="selected"><?php echo $userStationName;?></option>
					<?php
		            	}
					?>
					</select>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收件日期：</span></td>
				<td>
					<input type="text" id="checkdate1" size="12" class="Wdate" value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>"  name="checkdate1" onclick="WdatePicker({onpicked:function(dp){$dp.$('date1Value').value=dp.cal.getDateStr();}});" />&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;
					<input type="text" id="checkdate2" size="12" class="Wdate" value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="checkdate2" onclick="WdatePicker({onpicked:function(dp){$dp.$('date2Value').value=dp.cal.getDateStr();}});" />
				</td>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 托运单号查询：&nbsp;&nbsp;&nbsp;</span></td>
				<td><input type="text" name="ticketNo" id="ticketNo" value="<?php ($ticketNo == "" || $ticketNo == "%")? print "" : print $ticketNo;?>"/></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 托运人姓名：&nbsp;&nbsp;&nbsp;</span></td>
				<td><input type="text" name="senderName" id="senderName" value="<?php ($senderName == "" || $senderName == "%")? print "" : print $senderName;?>" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 托运状态：</span></td>
				<td>
					<select id="resultselect" name="resultselect" size="1" >  <!-- onchange="return disSelect()" -->
					
					<?php 
						if($Result=='') echo "<option selected=\"selected\">请选择托运状态</option>";
						else echo "<option>请选择托运状态</option>";
						if($Result=='已收货') echo "<option selected=\"selected\" value=\"已收货\">已收货</option>";
						else echo "<option  value=\"已收货\">已收货</option>";
						if($Result=='托运中') echo "<option selected=\"selected\" value=\"托运中\">托运中</option>";
						else echo "<option  value=\"托运中\">托运中</option>";
						if($Result=='已提取') echo "<option selected=\"selected\" value=\"已提取\">已提取</option>";
						else echo "<option  value=\"已提取\">已提取</option>";
						?>		
										
					</select>
					
				</td>
				<td colspan="2" bgcolor="#FFFFFF">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" id="resultquery" value="查询" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="exceldoc" id="exceldoc" value="导出Excel" />
				<!--  
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="button1"  value="行包营收缴款" onclick="location.assign('tms_v1_lugconsign_sellQuery.php');"/>
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="button2"  value="行包缴款查询" onclick="location.assign('tms_v1_lugconsign_subQuery.php');"/>
				-->
				</td>
			</tr>
			
		</table>
		<input type="hidden" id="date1Value" value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>" name="date1Value" />
		<input type="hidden" id="date2Value" value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="date2Value" />
		</form> 
		<form action="tms_v1_lugconsign_extract.php" method="post" name="form2">
		<input type="hidden" id="lc_Userstation" value="<?php echo $userStationName;?>" name="lc_Userstation" />
		<table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
			<tr>
				<td align="center" bgcolor="#FFFFFF">
					<input type="button" id="receive" name="receive" value="收件"/>
			<!-- 		<tbody id="AboutMoney" style="DISPLAY: <?php if($PayStyle=='发货人付款') echo ''; else echo 'none';?>">  -->
					<input type="button" id="modbbus" name="modbbus"  value="更换车辆"/> 
					<input type="button" id="extract" name="extract" value="提取确认" />
				</td>
			</tr>			
		</table>
		<input type="hidden" id="lc_TicketNumber" value="" name="lc_TicketNumber" />
					<input type="hidden" id="lc_Destination" value="" name="lc_Destination" />
					<input type="hidden" id="lc_DestinationID" value="" name="lc_DestinationID" />
					<input type="hidden" id="lc_NoOfRunsID" value="" name="lc_NoOfRunsID" />
					<input type="hidden" id="lc_BusID" value="" name="lc_BusID" />
					<input type="hidden" id="lc_BusNumber" value="" name="lc_BusNumber" />
					<input type="hidden" id="lc_DeliveryDate" value="" name="lc_DeliveryDate" />
					<input type="hidden" id="lc_DeliveryUserID" value="" name="lc_DeliveryUserID" />
					<input type="hidden" id="lc_DeliveryUser" value="" name="lc_DeliveryUser" />
					<input type="hidden" id="lc_AcceptDateTime" value="" name="lc_AcceptDateTime" />
					<input type="hidden" id="lc_ConsignName" value="" name="lc_ConsignName" />
					<input type="hidden" id="lc_ConsignTel" value="" name="lc_ConsignTel" />
					<input type="hidden" id="lc_ConsignPaperID" value="" name="lc_ConsignPaperID" />
					<input type="hidden" id="lc_ConsignAdd" value="" name="lc_ConsignAdd" />
					<input type="hidden" id="lc_UnloadName" value="" name="lc_UnloadName" />
					<input type="hidden" id="lc_UnloadTel" value="" name="lc_UnloadTel" />
					<input type="hidden" id="lc_UnloadPaperID" value="" name="lc_UnloadPaperID" />
					<input type="hidden" id="lc_UnloadAdd" value="" name="lc_UnloadAdd" />
					<input type="hidden" id="lc_CargoName" value="" name="lc_CargoName" />
					<input type="hidden" id="lc_Numbers" value="" name="lc_Numbers" />
					<input type="hidden" id="lc_Weight" value="" name="lc_Weight" />
					<input type="hidden" id="lc_CargoDescription" value="" name="lc_CargoDescription" />
					<input type="hidden" id="lc_Status" value="" name="lc_Status" />
					<input type="hidden" id="lc_ConsignMoney" value="" name="lc_ConsignMoney" />
					<input type="hidden" id="lc_PackingMoney" value="" name="lc_PackingMoney" />
					<input type="hidden" id="lc_LabelMoney" value="" name="lc_LabelMoney" />
					<input type="hidden" id="lc_HandlingMoney" value="" name="lc_HandlingMoney" />
					<input type="hidden" id="lc_ExtractionUserID" value="<?php echo $userID;?>" name="lc_ExtractionUserID" />
					<input type="hidden" id="lc_ExtractionUser" value="<?php echo $userName;?>" name="lc_ExtractionUser" />
					<input type="hidden" id="lc_ExtractionTime" value="" name="lc_ExtractionTime" />
					<input type="hidden" id="lc_Remark" value="" name="lc_Remark" />
					<input type="hidden" id="lc_Station" value="" name="lc_Station" />
					<input type="hidden" id="lc_Isvalueinsure" value="" name="lc_Isvalueinsure" />
					<input type="hidden" id="lc_InsureMoney" value="" name="lc_InsureMoney" />
					<input type="hidden" id="lc_InsureFee" value="" name="lc_InsureFee" />
					<input type="hidden" id="lc_PayStyle" value="" name="lc_PayStyle" />
					<input type="hidden" id="lc_Allmoney" value="" name="lc_Allmoney" />
					<input type="hidden" id="lc_IsBalance" value="" name="lc_IsBalance" />
					<input type="hidden" id="lc_BalanceDateTime" value="" name="lc_BalanceDateTime" />
		</form>
		<form action="tms_v1_lugconsign_receive.php" method="post" name="form3" >
			<input type="hidden" id="lc_DeliveryUserID" value="<?php echo $userID;?>" name="lc_DeliveryUserID" />
			<input type="hidden" id="lc_DeliveryUser" value="<?php echo $userName;?>" name="lc_DeliveryUser" />
			<input type="hidden" id="lc_StationID" value="" name="lc_StationID" />
			<input type="hidden" id="lc_Station" value="" name="lc_Station" />
		</form>
		<form action="tms_v1_lugconsign_modbus.php" method="post" name="form4">
			<input type="hidden" id="lc_TicketNumber1" value="" name="lc_TicketNumber1" />
		</form>
		<div id="tableContainer" class="tableContainer" style="margin-top:-20px;"> 
		<table class="main_tableboder" id="table1" > 
		<thead class="fixedHeader"> 
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">托运单号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">目的地</th>
			<!-- 	<th nowrap="nowrap" align="center" bgcolor="#006699">目的地ID</th>  -->
				<th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发货日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">收件人ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">收件人</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">收件时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">托运人姓名</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">托运人电话</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">托运人证件号码</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">托运人地址</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">收货人姓名</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">收货人电话</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">收货人证件号码</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">收货人地址</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">货物名称</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">货物件数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">货物重量</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">货物描述</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">托运状态</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">托运费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">包装费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">标签费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">装卸费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">提取人ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">提取人</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">提取时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">收件车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">是否保价</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保价金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保价费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">付款方式</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">合计费用</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">是否结算</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算时间</th>
			</tr>
		</thead>
		<tbody class="scrollContent"> 
			<?php	
			       // echo "'hello'";
			       //exit();//		   AND lc_DeliveryUserID = '{$userID}' AND lc_DeliveryUser = '{$userName}'     
				if(isset($_POST['resultquery']) || isset($_GET['RECVDONE']) || isset($_GET['EXDONE'])) {
					$queryString = "SELECT * FROM tms_lug_LuggageCons WHERE lc_AcceptDateTime >= '{$CheckBeginDatetime}' AND lc_AcceptDateTime <= '{$CheckEndDatetime}'  
								AND lc_Status LIKE '{$Result}' AND lc_TicketNumber LIKE '{$ticketNo}' 	AND lc_ConsignName LIKE '{$senderName}' 
								AND (lc_Station LIKE '{$StationName}'  OR lc_Destination LIKE '{$StationName}') 	ORDER BY lc_TicketNumber ASC";
				//	 echo "$queryString";
			     //  exit();//
					$result = $class_mysql_default->my_query("$queryString");
					while ($row = mysql_fetch_array($result)) {
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row['lc_TicketNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_Destination'];?></td>
				<!-- <td nowrap="nowrap"><?php echo $row['lc_DestinationID'];?></td>  -->
				<td nowrap="nowrap"><?php echo $row['lc_NoOfRunsID'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_BusID'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_BusNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_DeliveryDate'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_DeliveryUserID'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_DeliveryUser'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_AcceptDateTime'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_ConsignName'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_ConsignTel'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_ConsignPaperID'];?></td>
				<td><?php echo $row['lc_ConsignAdd'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_UnloadName'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_UnloadTel'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_UnloadPaperID'];?></td>
				<td><?php echo $row['lc_UnloadAdd'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_CargoName'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_Numbers'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_Weight'];?></td>
				<td><?php echo $row['lc_CargoDescription'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_Status'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_ConsignMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_PackingMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_LabelMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_HandlingMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_ExtractionUserID'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_ExtractionUser'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_ExtractionTime'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_Remark'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_Station'];?></td>
				<td nowrap="nowrap"><?php if($row['lc_Isvalueinsure']==1) echo "是"; else echo "否";?></td>
				<td nowrap="nowrap"><?php echo $row['lc_InsureMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_InsureFee'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_PayStyle'];?></td>
				<td nowrap="nowrap"><?php echo $row['lc_Allmoney'];?></td>
				<td nowrap="nowrap"><?php if($row['lc_IsBalance']=='1') echo '是'; else echo '否'; ?></td>
				<td nowrap="nowrap"><?php echo $row['lc_BalanceDateTime'];?></td>
			</tr>
			<?php
					}
				}
			?>   
		</tbody>
		</table>
		</div>
	</body>
</html>
