<?php
/*
 * 检票查询页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$CheckBeginDate = "";
$CheckEndDate = "";
$StationName = "";
$checkerID = "";
$ct_TicketID = "";
$ct_NoOfRunsID = "";
$ct_FromStation = "";
$ct_ReachStation = "";
$ct_EndStation = "";
$conducter=$_POST['checkerselect'];
$LineID=$_POST['LineID'];
//$sql = "select li_LineName from tms_bd_LineInfo where li_LineID = '$LineID'";
$LineName=$_POST['LineName'];
$checkdate3=date('Y-m-d');
$checkdate4=date('Y-m-d');
if($userStationName == "全部车站"){ //用户只能查看起点站属于本站的班次信息
		$str1="";
		}	
		else{
		$str1="AND  li_Station = '$userStationName'";
		}
if(isset($_POST['resultquery']) || isset($_POST['exceldoc'])) {
	$checkdate1=$_POST['startdate'];
	$checkdate2=$_POST['enddate'];
	if (($StationName = $_POST['stationselect']) == "")
		$StationName = "%";
	if (($checkerID = $_POST['checkerselect']) == "")
		$checkerID = "%";
	if (($ct_TicketID = $_POST['ct_TicketID']) == "")
		$ct_TicketID = "%";
	if (($ct_NoOfRunsID = $_POST['ct_NoOfRunsID']) == "")
		$ct_NoOfRunsID = "%";
	if (($ct_FromStation = $_POST['ct_FromStation']) == "")
		$ct_FromStation = "%";
	if (($ct_ReachStation = $_POST['ct_ReachStation']) == "")
		$ct_ReachStation = "%";
	if (($ct_EndStation = $_POST['ct_EndStation']) == "")
		$ct_EndStation = "%";
	if($_POST['ct_TicketID']==""){
		if($checkdate1 == "" && $checkdate2 == ""){
 			$strDate = '';
 		}
 		else{
		$checkdate1=$_POST['startdate'];
		$checkdate2=$_POST['enddate'];
		if ($checkdate1 != "" && $checkdate2 == ""){ //发车日期处理
 			$strDate=" and ct_CheckDate >='{$checkdate1}'";
 			
 		}
 		if ($checkdate1 == "" && $checkdate2 != ""){
 			$strDate=" and ct_CheckDate <='{$checkdate2}'";
 		}
 		if ($checkdate1 != "" && $checkdate2 != ""){
 			$strDate=" and ct_CheckDate >='{$checkdate1}' and ct_CheckDate <='{$checkdate2}'";
 		}
	}
		}
		else{
			$strDate = '';
		}			
	if(isset($_POST['exceldoc'])) {
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");

		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '检票信息表', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$checkdate1" . "至" . "$checkdate2";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		/*$head = array('票号', '班次', '线路名', '发车日期', '发车时间', '检票窗口', '检票日期', '检票时间', '检票车站', '检票员ID', '检票员', 
			'结算单号',	'始发站', '上车站', '到达站', '终点站', '售价', '票型', '人数', '结算价', '站务费', '微机费', '发班费', '代理费', '费用4', 
			'费用5', '费用6', '保险票号', '保险票数', '保险金额', '售票车型', '座位号', '售票日期',	'售票时间', '售票员ID', '售票员', 
			'是否结算',	'结算时间', '原班次', '原发车日期', '原票价', '原座号', '改签时间', '改签车站', '改签员ID', '改签员', '改签备注');*/
	$head = array('票号', '班次', '线路名', '发车日期', '发车时间', '检票窗口', '检票日期', '检票时间', '检票车站', '检票员ID', '检票员', 
			'结算单号',	'始发站', '上车站', '到达站', '终点站', '售价', '票型', '人数', '结算价', '站务费','劳务费（%）', '保险票号', '保险票数', '保险金额', '售票车型', '座位号', '售票日期',	'售票时间', '售票员ID', '售票员', 
			'是否结算',	'结算时间', '原班次', '原发车日期', '原票价', '原座号', '改签时间', '改签车站', '改签员ID', '改签员', '改签备注');
		
		fputcsv($fp, $head);

		$cnt = 0; 
		$limit = 100000; 
		$outputRow = ""; 
			$queryString1 = "SELECT * FROM 
									tms_chk_CheckTicket 
									WHERE 
									ct_Station LIKE '{$StationName}' 
									AND ct_CheckerID LIKE '{$checkerID}%' 
									AND ct_TicketID LIKE '{$ct_TicketID}%' 
									AND ct_NoOfRunsID LIKE '{$ct_NoOfRunsID}%' 
									AND ct_FromStation LIKE '{$ct_FromStation}%' 
									AND ct_ReachStation LIKE '{$ct_ReachStation}%' 
									AND ct_LineID LIKE '{$LineID}%' $strDate 
									ORDER BY ct_TicketID ASC";
			echo $LineID;
		//echo $queryString1;
		$result1 = $class_mysql_default->my_query("$queryString1");
		while ($row1 = mysqli_fetch_array($result1)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			$row1['ct_IsBalance'] ? $ct_IsBalance = "是" : $bh_IsAccount = "否";
			$row1['ct_TicketID']=$row1['ct_TicketID']."\t";
			$row1['ct_BalanceNO']=$row1['ct_BalanceNO']."\t";
			$row1['ct_SafetyTicketID']=$row1['ct_SafetyTicketID']."\t";
			$queryString2 = "SELECT 
							at_NoOfRunsID, 
							at_NoOfRunsdate, 
							at_SellPrice,
							at_SeatID, 
							at_AlterDateTime, 
							at_AlterStation, 
							at_AlterSellID, 
							at_AlterSellName, 
							at_Remark 
							FROM tms_sell_AlterTicket 
							WHERE 
							at_TicketID = '{$row1['ct_TicketID']}'";
			$result2 = $class_mysql_default->my_query("$queryString2");
			$row2 = mysqli_fetch_array($result2);
			$sql3="select 
					li_LineName 
					from tms_bd_LineInfo 
					where li_LineID = '{$row1['ct_LineID']}'";
				//	echo $sql;
					$result3 = $class_mysql_default->my_query("$sql3");
					$row3 = mysqli_fetch_array($result3);
			/*$outputRow = array($row1['ct_TicketID'], $row1['ct_NoOfRunsID'], $row3['li_LineName'], $row1['ct_NoOfRunsdate'], $row1['ct_BeginStationTime'], 
				$row1['ct_CheckTicketWindow'], $row1['ct_CheckDate'], $row1['ct_CheckTime'], $row1['ct_Station'], $row1['ct_CheckerID'], 
				$row1['ct_Checker'], $row1['ct_BalanceNO'],	$row1['ct_BeginStation'], $row1['ct_FromStation'], $row1['ct_ReachStation'], 
				$row1['ct_EndStation'],	$row1['ct_SellPrice'], $row1['ct_SellPriceType'], $row1['ct_TotalMan'], $row1['ct_BalancePrice'], 
				$row1['ct_ServiceFee'], $row1['ct_otherFee1'], $row1['ct_otherFee2'], $row1['ct_otherFee3'], $row1['ct_otherFee4'], 
				$row1['ct_otherFee5'], $row1['ct_otherFee6'], $row1['ct_SafetyTicketID'], $row1['ct_SafetyTicketNumber'], 
				$row1['ct_SafetyTicketMoney'],	$row1['ct_BusModel'], $row1['ct_SeatID'], 
				$row1['ct_SellDate'], $row1['ct_SellTime'], $row1['ct_SellID'], $row1['ct_SellName'], $ct_IsBalance, $row1['ct_BalanceDateTime'], 
				$row2['at_NoOfRunsdate'], $row2['at_SellPrice'], $row2['at_SeatID'], $row2['at_AlterDateTime'], $row2['at_AlterStation'], 
				$row2['at_AlterSellID'], $row2['at_AlterSellName'], $row2['at_Remark']);*/
			$outputRow = array($row1['ct_TicketID'], $row1['ct_NoOfRunsID'], $row3['li_LineName'], $row1['ct_NoOfRunsdate'], $row1['ct_BeginStationTime'], 
				$row1['ct_CheckTicketWindow'], $row1['ct_CheckDate'], $row1['ct_CheckTime'], $row1['ct_Station'], $row1['ct_CheckerID'], 
				$row1['ct_Checker'], $row1['ct_BalanceNO'],	$row1['ct_BeginStation'], $row1['ct_FromStation'], $row1['ct_ReachStation'], 
				$row1['ct_EndStation'],	$row1['ct_SellPrice'], $row1['ct_SellPriceType'], $row1['ct_TotalMan'], $row1['ct_BalancePrice'], 
				$row1['ct_ServiceFee'],$row1['ct_otherFee3']*100, $row1['ct_SafetyTicketID'], $row1['ct_SafetyTicketNumber'], $row1['ct_SafetyTicketMoney'],
				$row1['ct_BusModel'], $row1['ct_SeatID'], $row1['ct_SellDate'], $row1['ct_SellTime'], $row1['ct_SellID'], 
				$row1['ct_SellName'], $ct_IsBalance, $row1['ct_BalanceDateTime'], $row2['at_NoOfRunsdate'], $row2['at_SellPrice'], 
				$row2['at_SeatID'], $row2['at_AlterDateTime'], $row2['at_AlterStation'], 
				$row2['at_AlterSellID'], $row2['at_AlterSellName'], $row2['at_Remark']);  
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
		<title>检票查询</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>		
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script>
		$(document).ready(function(){
			$("#table1").tablesorter();
			$("#stationselect").focus();
			$("#stationselect").blur(function(){
				var stationName = $("#stationselect").val();
				jQuery.get(
					'../accounting/tms_v1_accounting_dataProcess.php',
					{'op': 'getCheckersData', 'stationName': stationName, 'time': Math.random()},
					function(data){
						$("#checkerselect option:gt(0)").remove();
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].checkerID + ">" + objData[i].checkerID + "</option>").appendTo($("#checkerselect"));
						}
				});
			});
		});
		$(document).ready(function(){
			
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
		});
		$(document).ready(function(){ //线路名按照终点站匹配
			$("#LineName").keyup(function(){
			if(document.getElementById("LineName").value==""){
					document.getElementById("LineID").value="";
					}
				$("#LineNameselect").empty();
				document.getElementById("LineNameselect").style.display=""; 
				var LineName = $("#LineName").val();
				var station = $("#stationselect1").val();
				jQuery.get(
					'../schedule/tms_v1_schedule_dataops.php',
					{'op': 'GETLINEEND', 'LineName': LineName,'station':station ,'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].LineName + ',' + objData[i].LineID +  ">" + objData[i].LineName + "</option>").appendTo($("#LineNameselect"));
							}
						if(LineName==''){
							document.getElementById("LineNameselect").style.display="none";
						}
				});
			});
			document.getElementById("LineNameselect").onclick = function (event){
				var sb=document.getElementById("LineNameselect").value.split(',');
				document.getElementById("LineName").value=sb[0];
				document.getElementById("LineID").value=sb[1];
				document.getElementById("LineNameselect").style.display="none";
				};
		});
		$(document).ready(function(){
			$("#ct_FromStation").keyup(function(){
				$("#ct_FromStation1").empty();
				document.getElementById("ct_FromStation1").style.display="";
				var Site = $("#ct_FromStation").val();
				jQuery.get(
					'../basedata/tms_v1_bsaedata_dataProcess.php',
					{'op': 'getsite', 'Site': Site, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value =" + objData[i].SiteName + ">" + objData[i].SiteName + "</option>").appendTo($("#ct_FromStation1"));
						}
						if(Site==''){
							document.getElementById("ct_FromStation1").style.display="none";
						}
					});	
			});
				document.getElementById("ct_FromStation1").onclick = function (event){
				document.getElementById("ct_FromStation").value=document.getElementById("ct_FromStation1").value;
				document.getElementById("ct_FromStation1").style.display="none";
				};
		});
		$(document).ready(function(){
			$("#ct_ReachStation").keyup(function(){
				$("#ct_ReachStation1").empty();
				document.getElementById("ct_ReachStation1").style.display="";
				var Site = $("#ct_ReachStation").val();
				jQuery.get(
					'../basedata/tms_v1_bsaedata_dataProcess.php',
					{'op': 'getsite', 'Site': Site, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value =" + objData[i].SiteName + ">" + objData[i].SiteName + "</option>").appendTo($("#ct_ReachStation1"));
						}
						if(Site==''){
							document.getElementById("ct_ReachStation1").style.display="none";
						}
					});	
			});
				document.getElementById("ct_ReachStation1").onclick = function (event){
				document.getElementById("ct_ReachStation").value=document.getElementById("ct_ReachStation1").value;
				document.getElementById("ct_ReachStation1").style.display="none";
				};
		});
		</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 检 票  信 息 查 询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr bgcolor="#FFFFFF">
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 检票车站：</span></td>
				<td>
					<select id="stationselect" name="stationselect" size="1">
		            <?php
		            	if($userStationID == "all") {
		            ?>
						<?php if ($StationName == "" || $StationName == "%") { ?>
							<option value="" selected="selected">请选择车站</option>
						<?php } else { ?>
							<option value="<?php echo $StationName?>" selected="selected"><?php echo $StationName?></option>
						<?php } ?>
					<?php 
							$queryString = "SELECT DISTINCT sset_SiteName FROM tms_bd_SiteSet WHERE sset_IsStation=1";
							$result = $class_mysql_default->my_query("$queryString");
					        while($res = mysqli_fetch_array($result)) {
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
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 检票日期：</span></td>
				<td bgcolor="#FFFFFF">
				<input type="text" name="startdate" id="startdate" class="Wdate" value="<?php if(isset($_POST['resultquery'])){if($_POST['ct_TicketID']==""){echo $_POST['startdate'];}} else{ echo $checkdate3;} ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    					至
    			<input type="text" name="enddate" id="enddate" class="Wdate" value="<?php if(isset($_POST['resultquery'])){if($_POST['ct_TicketID']==""){echo $_POST['enddate'];}} else{ echo $checkdate4;}?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 检票员：</span></td>
				<td>
					<select id="checkerselect" name="checkerselect" size="1" style="width:131px;">
					<?php if($conducter=="") {?>
						<option value="" selected="selected">请选择检票员</option>
						<?php } else {?>
						<option></option>
						<option value="<?php echo $conducter?>" selected="selected"><?php echo $conducter?></option>
						<?php } ?>
					</select>
				</td>
				</tr>
				<tr>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 票号：&nbsp;&nbsp;&nbsp;</span></td>
				<td ><input type="text" name="ct_TicketID" id="ct_TicketID" value="<?php ($ct_TicketID == "" || $ct_TicketID == "%")? print "" : print $ct_TicketID;?>"/></td>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：&nbsp;&nbsp;&nbsp;</span></td>
				<td><input type="text" name="ct_NoOfRunsID" id="ct_NoOfRunsID" value="<?php ($ct_NoOfRunsID == "" || $ct_NoOfRunsID == "%")? print "" : print $ct_NoOfRunsID;?>" /></td>
				
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 上车站：&nbsp;&nbsp;&nbsp;</span></td>
				<td colspan="2"><input type="text" name="ct_FromStation" id="ct_FromStation" value="<?php ($ct_FromStation == "" || $ct_FromStation == "%")? print "" : print $ct_FromStation;?>" />
						<br />
        		<select id="ct_FromStation1" name="ct_FromStation1"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="form1.BeginSite.value=this.value; this.style.display='none';"   >
				</select>
				</td>
				</tr>
				<tr>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 到达站：&nbsp;&nbsp;&nbsp;</span></td>
				<td ><input type="text" name="ct_ReachStation" id="ct_ReachStation" value="<?php ($ct_ReachStation == "" || $ct_ReachStation == "%")? print "" : print $ct_ReachStation;?>" />
				<br />
    				<select id="ct_ReachStation1" name="ct_ReachStation1"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="form1.EndSite.value=this.value; this.style.display='none';"   >
					</select>
					</td>
				
				<td nowrap="nowrap" bgcolor="#FFFFFF" style="display:none"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路名：&nbsp;&nbsp;&nbsp;</span></td>
				<td nowrap="nowrap" style="display:none">
					<input type="text" name="LineName" id="LineName" value="<?php echo $LineName;?>" />
					<br />
	    			<select id="LineNameselect" name="LineNameselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" onchange="showsome(this.value); this.style.display='none';"></select>
					<input type="hidden" name="LineID" id="LineID" value="<?php echo $LineID ?>" />
					</td>
					<td align="left" colspan="5">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" id="resultquery" value="查询" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="exceldoc" id="exceldoc" value="导出Excel" />
				</td>
			</tr>
		</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">票号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">线路名</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">检票窗口</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">检票日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">检票时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">检票车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">检票员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">检票员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算单号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">始发站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">上车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">到达站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">终点站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售价</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">票型</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">人数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算价</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">站务费</th>
				<!--
				<th nowrap="nowrap" align="center" bgcolor="#006699">微机费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发班费</th>
				-->
				<th nowrap="nowrap" align="center" bgcolor="#006699">劳务费(%)</th>
				<!--
				<th nowrap="nowrap" align="center" bgcolor="#006699">费用4</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">费用5</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">费用6</th>
				-->
				<th nowrap="nowrap" align="center" bgcolor="#006699">保险票号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保险票数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保险金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票车型</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">座位号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">是否结算</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">原班次</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">原发车日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">原票价</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">原座号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">改签时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">改签车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">改签员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">改签员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">改签备注</th>
			</tr>
		</thead>
			<tbody class="scrollContent">
			<?php
				if(isset($_POST['resultquery'])) {
					$queryString1 = "SELECT * FROM 
									tms_chk_CheckTicket 
									WHERE 
									ct_Station LIKE '{$StationName}' 
									AND ct_CheckerID LIKE '{$checkerID}%' 
									AND ct_TicketID LIKE '{$ct_TicketID}%' 
									AND ct_NoOfRunsID LIKE '{$ct_NoOfRunsID}%' 
									AND ct_FromStation LIKE '{$ct_FromStation}%' 
									AND ct_ReachStation LIKE '{$ct_ReachStation}%' 
									AND ct_LineID LIKE '{$LineID}%' $strDate 
									ORDER BY ct_TicketID ASC";
					//echo $queryString1;
					$result1 = $class_mysql_default->my_query("$queryString1");
					while ($row1 = mysqli_fetch_array($result1)) {
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row1['ct_TicketID'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_NoOfRunsID'];?></td>
				<?php 
					$sql="select li_LineName from tms_bd_LineInfo where li_LineID = '{$row1['ct_LineID']}'";
				//	echo $sql;
					$result = $class_mysql_default->my_query("$sql");
					$row = mysqli_fetch_array($result);
				?>
				<td nowrap="nowrap"><?php echo $row['li_LineName'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_NoOfRunsdate'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_BeginStationTime'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_CheckTicketWindow'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_CheckDate'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_CheckTime'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_Station'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_CheckerID'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_Checker'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_BalanceNO'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_BeginStation'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_FromStation'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_ReachStation'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_EndStation'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_SellPrice'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_SellPriceType'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_TotalMan'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_BalancePrice'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_ServiceFee'];?></td>
				<!--
				<td nowrap="nowrap"><?php echo $row1['ct_otherFee1'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_otherFee2'];?></td>
				-->
				<td nowrap="nowrap"><?php echo $row1['ct_otherFee3']*100;?></td>
				<!--
				<td nowrap="nowrap"><?php echo $row1['ct_otherFee4'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_otherFee5'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_otherFee6'];?></td>
				-->
				<td nowrap="nowrap"><?php echo $row1['ct_SafetyTicketID'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_SafetyTicketNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_SafetyTicketMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_BusModel'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_SeatID'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_SellDate'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_SellTime'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_SellID'];?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_SellName'];?></td>
				<td nowrap="nowrap"><?php if ($row1['ct_IsBalance']) echo "是"; else echo "否";?></td>
				<td nowrap="nowrap"><?php echo $row1['ct_BalanceDateTime'];?></td>
			<?php 
						$queryString2 = "SELECT at_NoOfRunsID, at_NoOfRunsdate, at_SellPrice, at_SeatID, at_AlterDateTime, 
									at_AlterStation, at_AlterSellID, at_AlterSellName, at_Remark FROM tms_sell_AlterTicket 
									WHERE at_TicketID = '{$row1['ct_TicketID']}'";
						//echo $queryString2;
						$result2 = $class_mysql_default->my_query("$queryString2");
						$row2 = mysqli_fetch_array($result2);						
			?>	
				<td nowrap="nowrap"><?php echo $row2['at_NoOfRunsID'];?></td>
				<td nowrap="nowrap"><?php echo $row2['at_NoOfRunsdate'];?></td>
				<td nowrap="nowrap"><?php echo $row2['at_SellPrice'];?></td>
				<td nowrap="nowrap"><?php echo $row2['at_SeatID'];?></td>
				<td nowrap="nowrap"><?php echo $row2['at_AlterDateTime'];?></td>
				<td nowrap="nowrap"><?php echo $row2['at_AlterStation'];?></td>
				<td nowrap="nowrap"><?php echo $row2['at_AlterSellID'];?></td>
				<td nowrap="nowrap"><?php echo $row2['at_AlterSellName'];?></td>
				<td nowrap="nowrap"><?php echo $row2['at_Remark'];?></td>
			</tr>
			<?php 
					}
				}
			?>
			<tr>
				<td><input type="hidden" name="stationselect1" id="stationselect1" value="<?php echo $str1;?>" /></td>
			</tr>
		</tbody>
		</table>
		</div>
		</form>
	</body>
</html>
