<?php
/*
 * 售票查询页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$startdate=$_GET['CheckBeginDate'];
$enddate=$_GET['CheckEndDate'];
$selldate=$_GET['selldate'];
$sellerid=$_GET['sellerid'];
$StationName = "";
$sellerID = "";
$st_TicketID = "";
$st_NoOfRunsID = "";
$st_FromStation = "";
$st_ReachStation = "";
$st_EndStation = "";
$station=$_POST['stationselect'];
$conducter=$_POST['sellerselect'];
$LineName=$_POST['LineName'];
$LineID=$_POST['LineID'];
$checkdate3=date('Y-m-d');
$checkdate4=date('Y-m-d');
if($selldate!=""){
	$strDate="and st_SellDate ='{$selldate}' ";
}
else{
	$strDate="and st_SellDate >='{$startdate}' and st_SellDate <='{$enddate}'";
}
if($userStationName == "全部车站"){ //用户只能查看起点站属于本站的班次信息
		$str1="";
		}	
		else{
		$str1="AND  li_Station = '$userStationName'";
		}
if(isset($_POST['resultquery']) || isset($_POST['exceldoc'])) {
	$checkdate1=$_POST['startdate'];
	$checkdate3=$_POST['startdate'];
	$checkdate2=$_POST['enddate'];
	$checkdate4=$checkdate2;
	if (($StationName = $_POST['stationselect']) == "")
		$StationName = "%";
	if (($sellerID = $_POST['sellerselect']) == "")
		$sellerID = "%";
	if (($st_TicketID = $_POST['st_TicketID']) == "")
		$st_TicketID = "%";
	if (($st_NoOfRunsID = $_POST['st_NoOfRunsID']) == "")
		$st_NoOfRunsID = "%";
	if (($st_FromStation = $_POST['st_FromStation']) == "")
		$st_FromStation = "%";
	if (($st_ReachStation = $_POST['st_ReachStation']) == "")
		$st_ReachStation = "%";
	if (($st_EndStation = $_POST['st_EndStation']) == "")
		$st_EndStation = "%";
	if($startdate=="" || $enddate==""){
	if($_POST['st_TicketID']==""){
		if($checkdate1 == "" && $checkdate2 == ""){
 			$strDate = '';
 		}
 		else{
		$checkdate1=$_POST['startdate'];
		$checkdate2=$_POST['enddate'];
		if ($checkdate1 != "" && $checkdate2 == ""){ //发车日期处理
 			$strDate="and st_SellDate >='{$checkdate1}'";
 			
 		}
 		if ($checkdate1 == "" && $checkdate2 != ""){
 			$strDate="and st_SellDate <='{$checkdate2}'";
 		}
 		if ($checkdate1 != "" && $checkdate2 != ""){
 			$strDate="and st_SellDate >='{$checkdate1}' and st_SellDate <='{$checkdate2}'";
 		}
	}
		}
		else{
			$strDate = '';
		}
	}
	else{
		$checkdate1=$_POST['startdate'];
		$checkdate2=$_POST['enddate'];
		if ($checkdate1 != "" && $checkdate2 == ""){ //发车日期处理
 			$strDate="and st_SellDate >='{$checkdate1}'";
 			
 		}
 		if ($checkdate1 == "" && $checkdate2 != ""){
 			$strDate="and st_SellDate <='{$checkdate2}'";
 		}
 		if ($checkdate1 != "" && $checkdate2 != ""){
 			$strDate="and st_SellDate >='{$checkdate1}' and st_SellDate <='{$checkdate2}'";
 		}
		else{
			$strDate = '';
		}
	}
	
	
	if(isset($_POST['exceldoc'])) {
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");

		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '售票信息表', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$checkdate3" . "至" . "$checkdate4";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		/*$head = array('票号', '班次', '线路名', '发车日期', '发车时间', '始发站', '上车站', '到达站', '终点站', '距离', '售价',
			 '票型', '人数', '执行价', '半价', '标准价', '结算价', '站务费', '微机费', '发班费', '代理费', '费用4', '费用5', '费用6', '保险票号', 
			 '保险票数',	'保险金额', '售票车型', '座位号', '售票日期', '售票时间', '售票车站', '售票员ID', '售票员', '票状态', '是否缴款', 
			 '缴款时间', '原班次', '原发车日期', '原票价', '原座号', '改签时间', '改签车站', '改签员ID', '改签员', '改签备注');
		*/
		$head = array('票号', '班次', '线路名', '发车日期', '发车时间', '始发站', '上车站', '到达站', '终点站', '距离', '售价',
			 '票型', '人数', '执行价', '半价', '标准价', '结算价', '站务费', '劳务费(%)','保险票号', 
			 '保险票数',	'保险金额', '售票车型', '座位号', '售票日期', '售票时间', '售票车站', '售票员ID', '售票员', '票状态', '是否缴款', 
			 '缴款时间', '原班次', '原发车日期', '原票价', '原座号', '改签时间', '改签车站', '改签员ID', '改签员', '改签备注');
		fputcsv($fp, $head);

		$cnt = 0; 
		$limit = 100000; 
		$outputRow = ""; 
		$queryString1 = "SELECT * FROM 
					tms_sell_SellTicket 
					WHERE 
					st_Station LIKE '{$StationName}%' 
					AND st_SellID LIKE '{$sellerID}%' 
					AND st_TicketID LIKE '{$st_TicketID}%' 
					AND st_NoOfRunsID LIKE '{$st_NoOfRunsID}%' 
					AND st_FromStation LIKE '{$st_FromStation}%'
					AND st_ReachStation LIKE '{$st_ReachStation}%' 
					AND st_LineID like '{$LineID}%'".$strDate; 
		$result1 = $class_mysql_default->my_query("$queryString1");
		while ($row1 = mysqli_fetch_array($result1)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			$row1['st_IsBalance'] ? $st_IsBalance = "是" : $bh_IsAccount = "否";
			
			$queryString2 = "SELECT at_NoOfRunsID, at_NoOfRunsdate, at_SellPrice, at_SeatID, at_AlterDateTime, at_AlterStation, 
					at_AlterSellID, at_AlterSellName, at_Remark FROM tms_sell_AlterTicket WHERE at_TicketID = '{$row1['st_TicketID']}'";
			$result2 = $class_mysql_default->my_query("$queryString2");
			$row2 = mysqli_fetch_array($result2);	
			
			$sql3="select li_LineName from tms_bd_LineInfo where li_LineID = '{$row1['st_LineID']}'";
			$result3=$class_mysql_default->my_query("$sql3");
			$row3=mysqli_fetch_array($result3);					
			/*$outputRow = array($row1['st_TicketID'], $row1['st_NoOfRunsID'], $row3['li_LineName'], $row1['st_NoOfRunsdate'], $row1['st_BeginStationTime'], 
				$row1['st_BeginStation'], $row1['st_FromStation'], $row1['st_ReachStation'], $row1['st_EndStation'], $row1['st_Distance'], $row1['st_SellPrice'], 
				$row1['st_SellPriceType'], $row1['st_TotalMan'], $row1['st_FullPrice'], $row1['st_HalfPrice'], $row1['st_StandardPrice'], 
				$row1['st_BalancePrice'], $row1['st_ServiceFee'], $row1['st_otherFee1'], $row1['st_otherFee2'], $row1['st_otherFee3'], 
				$row1['st_otherFee4'], $row1['st_otherFee5'], $row1['st_otherFee6'], $row1['st_SafetyTicketID'], $row1['st_SafetyTicketNumber'], 
				$row1['st_SafetyTicketMoney'], $row1['st_BusModel'], $row1['st_SeatID'], $row1['st_SellDate'], $row1['st_SellTime'], $row1['st_Station'], 
				$row1['st_SellID'],	$row1['st_SellName'], $row1['st_TicketState'], $st_IsBalance, $row1['st_BalanceDateTime'], $row2['at_NoOfRunsID'], 
				$row2['at_NoOfRunsdate'], $row2['at_SellPrice'], $row2['at_SeatID'], $row2['at_AlterDateTime'], $row2['at_AlterStation'], 
				$row2['at_AlterSellID'], $row2['at_AlterSellName'], $row2['at_Remark']); */
				$outputRow = array($row1['st_TicketID'], $row1['st_NoOfRunsID'], $row3['li_LineName'], $row1['st_NoOfRunsdate'], $row1['st_BeginStationTime'], 
				$row1['st_BeginStation'], $row1['st_FromStation'], $row1['st_ReachStation'], $row1['st_EndStation'], $row1['st_Distance'], $row1['st_SellPrice'], 
				$row1['st_SellPriceType'], $row1['st_TotalMan'], $row1['st_FullPrice'], $row1['st_HalfPrice'], $row1['st_StandardPrice'], 
				$row1['st_BalancePrice'], $row1['st_ServiceFee'],$row1['st_otherFee3']*100, $row1['st_SafetyTicketID'], $row1['st_SafetyTicketNumber'], 
				$row1['st_SafetyTicketMoney'], $row1['st_BusModel'], $row1['st_SeatID'], $row1['st_SellDate'], $row1['st_SellTime'], $row1['st_Station'], 
				$row1['st_SellID'],	$row1['st_SellName'], $row1['st_TicketState'], $st_IsBalance, $row1['st_BalanceDateTime'], $row2['at_NoOfRunsID'], 
				$row2['at_NoOfRunsdate'], $row2['at_SellPrice'], $row2['at_SeatID'], $row2['at_AlterDateTime'], $row2['at_AlterStation'], 
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
		<title>售票查询</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>		
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script>
		function return1(){
			window.location.href='../sell/tms_v1_sell_sellquery.php';	
		}
		$(document).ready(function(){
			$("#table1").tablesorter();
			$("#stationselect").focus();
			$("#stationselect").blur(function(){
				var stationName = $("#stationselect").val();
				jQuery.get(
					'../accounting/tms_v1_accounting_dataProcess.php',
					{'op': 'getSellersData', 'stationName': stationName, 'time': Math.random()},
					function(data){
						$("#sellerselect option:gt(0)").remove();
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].sellerID + ">" + objData[i].sellerID + "</option>").appendTo($("#sellerselect"));
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
							$("<option value = " + objData[i].LineName + ',' + objData[i].LineID +  ">" + objData[i].LineName +  "</option>").appendTo($("#LineNameselect"));
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
			$("#st_FromStation").keyup(function(){
				$("#st_FromStation1").empty();
				document.getElementById("st_FromStation1").style.display="";
				var Site = $("#st_FromStation").val();
				jQuery.get(
					'../basedata/tms_v1_bsaedata_dataProcess.php',
					{'op': 'getsite', 'Site': Site, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value =" + objData[i].SiteName + ">" + objData[i].SiteName + "</option>").appendTo($("#st_FromStation1"));
						}
						if(Site==''){
							document.getElementById("st_FromStation1").style.display="none";
						}
					});	
			});
				document.getElementById("st_FromStation1").onclick = function (event){
				document.getElementById("st_FromStation").value=document.getElementById("st_FromStation1").value;
				document.getElementById("st_FromStation1").style.display="none";
				};
		});

		$(document).ready(function(){
			$("#st_ReachStation").keyup(function(){
				$("#st_ReachStation1").empty();
				document.getElementById("st_ReachStation1").style.display="";
				var Site = $("#st_ReachStation").val();
				jQuery.get(
					'../basedata/tms_v1_bsaedata_dataProcess.php',
					{'op': 'getsite', 'Site': Site, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value =" + objData[i].SiteName + ">" + objData[i].SiteName + "</option>").appendTo($("#st_ReachStation1"));
						}
						if(Site==''){
							document.getElementById("st_ReachStation1").style.display="none";
						}
					});	
			});
				document.getElementById("st_ReachStation1").onclick = function (event){
				document.getElementById("st_ReachStation").value=document.getElementById("st_ReachStation1").value;
				document.getElementById("st_ReachStation1").style.display="none";
				};
		});
		</script>
		
	</head>
	<body>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 售 票  信 息 查 询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1" >
			<tr bgcolor="#FFFFFF">
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 售票车站：</span></td>
				<td colspan="2">
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
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 售票日期：</span>
				</td>
				<td>
				<?php if($startdate=="" && $enddate==""){ ?>		
				<input type="text" name="startdate" id="startdate" class="Wdate" value="<?php if(isset($_POST['resultquery'])){if($_POST['st_TicketID']==""){echo $_POST['startdate'];} }  else{ echo $checkdate3;} ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    			至
    			<input type="text" name="enddate" id="enddate" class="Wdate" value="<?php if(isset($_POST['resultquery'])){if($_POST['st_TicketID']==""){echo $_POST['enddate'];}} else{ echo $checkdate4;}?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
				<?php } else { ?>
				<input type="text" name="startdate2" id="startdate2" class="Wdate" value="<?php if($selldate!=""){ echo $selldate; }else{ echo $startdate; }  ?>" disabled="disabled" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
				<input type="hidden" name="startdate" id="startdate" class="Wdate" value="<?php if($selldate!=""){ echo $selldate; }else{ echo $startdate; }  ?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    			至
    			<input type="text" name="enddate2" id="enddate2" class="Wdate" disabled="disabled" value="<?php if($selldate!=""){ echo $selldate; }else{ echo $enddate; }  ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    			<input type="hidden" name="enddate" id="enddate" class="Wdate" value="<?php if($selldate!=""){ echo $selldate; }else{ echo $enddate; }  ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
				<?php } ?>
				</td>
			
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 售票员：</span></td>
				<td>
				<?php if($startdate=="" && $enddate==""){ ?>
					<select id="sellerselect" name="sellerselect" size="1" style="width:131px;">
					<?php if($conducter=="") {?>
						<option value="" selected="selected">请选择售票员</option>
						<?php } else {?>
						<option value="<?php echo $conducter?>" selected="selected"><?php echo $conducter?></option>
						<?php } ?>
					</select>
					<?php } else {?>
					<input type="hidden" name="sellerselect" id="sellerselect" value="<?php echo $userID; ?>"/>
					<input type="text" disabled="disabled" name="sellerselect1" id="sellerselect1" value="<?php echo $userID; ?>"/>
					<?php } ?>
				</td>
				</tr>
				<tr>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 票号：&nbsp;&nbsp;&nbsp;</span></td>
				<td colspan="2"><input type="text" name="st_TicketID" id="st_TicketID" value="<?php ($st_TicketID == "" || $st_TicketID == "%")? print "" : print $st_TicketID;?>"/></td>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：&nbsp;&nbsp;&nbsp;</span></td>
				<td><input type="text" name="st_NoOfRunsID" id="st_NoOfRunsID" value="<?php ($st_NoOfRunsID == "" || $st_NoOfRunsID == "%")? print "" : print $st_NoOfRunsID;?>" /></td>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 上车站：&nbsp;&nbsp;&nbsp;</span></td>
				<td><input type="text" name="st_FromStation" id="st_FromStation" value="<?php ($st_FromStation == "" || $st_FromStation == "%")? print "" : print $st_FromStation;?>" />
    	 		<br />
        		<select id="st_FromStation1" name="st_FromStation1"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="form1.BeginSite.value=this.value; this.style.display='none';"   >
		</select>
				</td>
			</tr>
				<tr>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 到达站：&nbsp;&nbsp;&nbsp;</span></td>
				<td colspan="2"><input type="text" name="st_ReachStation" id="st_ReachStation" value="<?php ($st_ReachStation == "" || $st_ReachStation == "%")? print "" : print $st_ReachStation;?>" />
    				<br />
    				<select id="st_ReachStation1" name="st_ReachStation1"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="form1.EndSite.value=this.value; this.style.display='none';"   >
					</select>
					</td>
				<td nowrap="nowrap" bgcolor="#FFFFFF"  style="display:none"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路名：&nbsp;&nbsp;&nbsp;</span></td>
				<td nowrap="nowrap" style="display:none">
					<input type="text" name="LineName" id="LineName" value="<?php echo $LineName;?>" />
					<br />
	    			<select id="LineNameselect" name="LineNameselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" onchange="showsome(this.value); this.style.display='none';"></select>
					<input type="hidden" name="LineID" id="LineID" value="<?php echo $LineID; ?>"/>
					</td>
					<td colspan="4">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" id="resultquery" value="查询" />
					<?php if($startdate!="" || $enddate!=""){  ?>
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="return" id="return" value="返回" onclick="return1()"/>
					<?php } ?>
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
				<th nowrap="nowrap" align="center" bgcolor="#006699">始发站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">上车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">到达站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">终点站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">距离</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售价</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">票型</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">人数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">执行价</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">半价</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">标准价</th>
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
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">票状态</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">是否缴款</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">缴款时间</th>
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
				if($startdate!="" || $enddate!=""){
					$queryString1 = "SELECT * FROM 
					tms_sell_SellTicket 
					WHERE 
					st_Station LIKE '{$userStationName}%' 
					AND st_SellID LIKE '{$sellerid}%' 
					AND st_TicketID LIKE '{$st_TicketID}%' 
					AND st_NoOfRunsID LIKE '{$st_NoOfRunsID}%' 
					AND st_FromStation LIKE '{$st_FromStation}%'
					AND st_ReachStation LIKE '{$st_ReachStation}%' 
					AND st_LineID like '{$LineID}%'".$strDate; 
				}
			else{
				if(isset($_POST['resultquery'])) {
					$queryString1 = "SELECT * FROM 
					tms_sell_SellTicket 
					WHERE 
					st_Station LIKE '{$StationName}%' 
					AND st_SellID LIKE '{$sellerID}%' 
					AND st_TicketID LIKE '{$st_TicketID}%' 
					AND st_NoOfRunsID LIKE '{$st_NoOfRunsID}%' 
					AND st_FromStation LIKE '{$st_FromStation}%'
					AND st_ReachStation LIKE '{$st_ReachStation}%' 
					AND st_LineID like '{$LineID}%'".$strDate; 
				}
			}
					//echo $queryString1;
					$result1 = $class_mysql_default->my_query("$queryString1");
					while ($row1 = mysqli_fetch_array($result1)) {
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row1['st_TicketID'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_NoOfRunsID'];?></td>
				<?php 
					$sql="select li_LineName from tms_bd_LineInfo where li_LineID = '{$row1['st_LineID']}'";
				//	echo $sql;
					$result = $class_mysql_default->my_query("$sql");
					$row = mysqli_fetch_array($result);
				?>
				<td nowrap="nowrap"><?php echo $row['li_LineName'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_NoOfRunsdate'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_BeginStationTime'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_BeginStation'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_FromStation'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_ReachStation'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_EndStation'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_Distance'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_SellPrice'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_SellPriceType'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_TotalMan'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_FullPrice'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_HalfPrice'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_StandardPrice'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_BalancePrice'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_ServiceFee'];?></td>
				
				<!--
				<td nowrap="nowrap"><?php echo $row1['st_otherFee1'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_otherFee2'];?></td>
				-->
				<td nowrap="nowrap"><?php echo $row1['st_otherFee3']*100;?></td>
				<!--
				<td nowrap="nowrap"><?php echo $row1['st_otherFee4'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_otherFee5'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_otherFee6'];?></td>
				-->
				<td nowrap="nowrap"><?php echo $row1['st_SafetyTicketID'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_SafetyTicketNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_SafetyTicketMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_BusModel'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_SeatID'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_SellDate'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_SellTime'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_Station'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_SellID'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_SellName'];?></td>
				<td nowrap="nowrap"><?php echo $row1['st_TicketState'];?></td>
				<td nowrap="nowrap"><?php if ($row1['st_IsBalance']) echo "是"; else echo "否";?></td>
				<td nowrap="nowrap"><?php echo $row1['st_BalanceDateTime'];?></td>
			<?php 
						//if ($row1['st_AlterTicket'] == 1) {
							$queryString2 = "SELECT at_NoOfRunsID, at_NoOfRunsdate, at_SellPrice, at_SeatID, at_AlterDateTime, 
									at_AlterStation, at_AlterSellID, at_AlterSellName, at_Remark FROM tms_sell_AlterTicket 
									WHERE at_TicketID = '{$row1['st_TicketID']}'";
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
						//}
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
