<?php
/*
 * 行包营收缴款页面
 * 	应交票张数 = 退票张数 + 废票张数
 *  应交款金额 = 售票金额 - 废票金额 - 退还金额
 */

//定义页面必须验证是否登录
 define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$CheckBeginDate = "";
$CheckEndDate = "";
$StationName = "";
$sellerID = "";
if($userStationName == '全部车站'){
	$userStationName='';
}
if(isset($_POST['resultquery']) || isset($_POST['exceldoc'])) {
	$CheckBeginDate = $_POST['checkdate1'];
	$CheckEndDate = $_POST['checkdate2'];
	if (($StationName = $_POST['stationselect']) == "")
		$StationName = "%";
	if (($sellerID = $_POST['sellerselect']) == "")
		$sellerID = "%";
			
	if(isset($_POST['exceldoc'])) {
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");
		
		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '', '', '行包应缴款信息表', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$CheckBeginDate" . "至" . "$CheckEndDate";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('发货日期', '行包员ID', '行包员', '发行包单金额', '发行包单张数', '收行包单金额', '收行包单张数', '应缴款金额',  
					 '行包员所属车站');
		fputcsv($fp, $head);
		
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = "";
		if($CheckBeginDate == "" && $CheckEndDate == ""){
			$strDate = '';
		}
		if($CheckBeginDate != "" && $CheckEndDate == ""){
			$strDate=" AND lc_AcceptDateTime >= '{$CheckBeginDate}'";
		}
		if ($CheckBeginDate == "" && $CheckEndDate != ""){
 			$strDate=" AND lc_AcceptDateTime < DATE_ADD('{$CheckEndDate}', INTERVAL 1 DAY)";
 		}
		if ($CheckBeginDate != "" && $CheckEndDate != ""){
 			$strDate="AND lc_AcceptDateTime >= '{$CheckBeginDate}' AND lc_AcceptDateTime < DATE_ADD('{$CheckEndDate}', INTERVAL 1 DAY)";
 		}
		$queryString1="SELECT lc_DeliveryDate,lc_DeliveryUserID,lc_TicketNumber,lc_AcceptDateTime,lc_DeliveryUser, IFNULL(SUM(lc_Allmoney),0) AS Allmoney, 
						COUNT(lc_TicketNumber) AS Number,lc_Station FROM tms_lug_LuggageCons WHERE (lc_Station LIKE '{$StationName}') AND (lc_DeliveryUserID LIKE '{$sellerID}')
						AND (lc_PayStyle='发货人付款') AND (IFNULL(lc_IsBalance,0)!=1) AND lc_DeliveryUserID IN (SELECT ui_UserID FROM tms_sys_UsInfor WHERE ui_UserSation LIKE '{$StationName}')".$strDate.
						" GROUP BY lc_DeliveryUserID, lc_DeliveryDate ORDER BY lc_DeliveryUserID ASC, lc_DeliveryDate ASC";
		$result1 = $class_mysql_default->my_query("$queryString1");
		while ($row1 = mysql_fetch_array($result1)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			$queryString2="SELECT IFNULL(SUM(lc_Allmoney),0) AS Allmoneys, COUNT(lc_TicketNumber) AS Numbers FROM tms_lug_LuggageCons WHERE (lc_ExtractionUserID='{$row1['lc_DeliveryUserID']}') AND 
							(DATE_FORMAT(lc_ExtractionTime,'%y-%m-%d')= DATE_FORMAT('{$row1['lc_AcceptDateTime']}','%y-%m-%d'))  AND (lc_PayStyle='收货人付款') AND (IFNULL(lc_IsBalance,0)!=1) 
							AND lc_ExtractionUserID IN (SELECT ui_UserID FROM tms_sys_UsInfor WHERE ui_UserSation LIKE '{$StationName}') GROUP BY lc_ExtractionUserID";
			$result2 = $class_mysql_default->my_query("$queryString2");
			$row2 = mysql_fetch_array($result2);
			$sendmoney=$row1['Allmoney'];
			$takemoney=$row2['Allmoneys'];
			$allmoney=$row1['Allmoney']+$row2['Allmoneys'];
			$outputRow = array($row1['lc_DeliveryDate'], $row1['lc_DeliveryUserID'], $row1['lc_DeliveryUser'], $sendmoney, $row1['Number'], 
				$takemoney, $row2['Numbers'], $allmoney, $row1['lc_Station']); 
			fputcsv($fp, $outputRow); 
		}
		if($CheckBeginDate == "" && $CheckEndDate == ""){
			$strDate1 = '';
		}
		if($CheckBeginDate != "" && $CheckEndDate == ""){
			$strDate1=" AND lc_ExtractionTime >= '{$CheckBeginDate}'";
		}
		if ($CheckBeginDate == "" && $CheckEndDate != ""){
 			$strDate1=" AND lc_ExtractionTime < DATE_ADD('{$CheckEndDate}', INTERVAL 1 DAY)";
 		}
		if ($CheckBeginDate != "" && $CheckEndDate != ""){
 			$strDate1="AND lc_ExtractionTime >= '{$CheckBeginDate}' AND lc_ExtractionTime < DATE_ADD('{$CheckEndDate}', INTERVAL 1 DAY)";
 		}
		$queryString3="SELECT DATE_FORMAT(lc_ExtractionTime,'%Y-%m-%d') AS ExtractionTime,lc_ExtractionUserID,lc_ExtractionUser ,IFNULL(SUM(lc_Allmoney),0) AS Allmoneyt,
						COUNT(lc_TicketNumber) AS Number,lc_Destination FROM tms_lug_LuggageCons WHERE (lc_ExtractionUserID  LIKE '{$sellerID}') AND (lc_PayStyle='收货人付款') 
						AND (IFNULL(lc_IsBalance,0)!=1) AND lc_ExtractionUserID IN (SELECT ui_UserID FROM tms_sys_UsInfor WHERE ui_UserSation LIKE '{$StationName}')".$strDate1.
						" GROUP BY lc_ExtractionUserID,ExtractionTime ORDER BY lc_ExtractionUserID ASC, ExtractionTime ASC";
		$result3 = $class_mysql_default->my_query("$queryString3");
		while ($row3 = mysql_fetch_array($result3)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 	
			$queryString4="SELECT lc_DeliveryUserID FROM tms_lug_LuggageCons WHERE (lc_DeliveryUserID='{$row3['lc_ExtractionUserID']}') AND 
							(DATE_FORMAT(lc_AcceptDateTime,'%y-%m-%d')=DATE_FORMAT('{$row3['ExtractionTime']}','%y-%m-%d')) AND (lc_PayStyle='发货人付款') AND (IFNULL(lc_IsBalance,0)!=1)";
			$result4 = $class_mysql_default->my_query("$queryString4");
			$row4 = mysql_fetch_array($result4);
			if(mysql_num_rows($result4)==0){
				$nonumber="";
				$takemoney=$row3['Allmoneyt'];
				$outputRow = array($row3['ExtractionTime'],  $row3['lc_ExtractionUserID'], $row3['lc_ExtractionUser'], $nonumber, $nonumber, 
					$takemoney, $row3['Number'], $takemoney, $row3['lc_Destination']); 
				fputcsv($fp, $outputRow); 
			}
		}
	//	$queryString = "SELECT cb_BillingDate,cb_BillingerID,cb_BillingerName, MIN(cb_TicketID) AS beginTicketID, MAX(cb_TicketID) AS endTicketID,
	//					IFNULL(SUM(cb_CarriageFee),0) AS CarriageFee,IFNULL(SUM(cb_StagnateFee),0) AS StagnateFee,COUNT(cb_TicketID) AS Number,cb_BillingStation 
	//					FROM tms_bd_CharteredBus WHERE (cb_BillingDate >= '{$CheckBeginDate}') AND (cb_BillingDate <= '{$CheckEndDate}') AND (cb_State = 1)  
	//					AND (cb_BillingStation LIKE '{$StationName}') AND (cb_BillingerID LIKE '{$sellerID}') GROUP BY cb_BillingerID, cb_BillingDate 
	//					ORDER BY cb_BillingDate ASC, cb_BillingerID ASC";
	//	$result = $class_mysql_default->my_query("$queryString");
	//	while ($row = mysql_fetch_array($result)) {
	//		$cnt++; 
	//		if ($limit == $cnt) { //刷新输出buffer
	//			ob_flush(); 
	//			flush(); 
	//			$cnt = 0; 
	//		} 
		//	$UpCount = $row['errNumber'] + $row['returnNumber'];
	//		$UpMoney = $row['CarriageFee'] + $row['StagnateFee'];
	//		$outputRow = array($row['cb_BillingDate'], $row['cb_BillingerID'], $row['cb_BillingerName'], $row['beginTicketID'], $row['endTicketID'], 
	//			$UpMoney, $row['Number'], $UpMoney, $row['cb_BillingStation']); 
	//		fputcsv($fp, $outputRow); 
	//	}
		
		fclose($fp);
		exit();
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>行包营收缴款</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script>
		/*$(document).ready(function(){
			$("#stationselect").focus();
			$("#stationselect").blur(function(){
				var stationName = $("#stationselect").val();
				jQuery.get(
					'tms_v1_lugconsign_getdata.php',
					{'op': 'getlugconsignData', 'stationName': stationName, 'time': Math.random()},
					function(data){
						$("#sellerselect option:gt(0)").remove();
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].sellerID + ">" + objData[i].sellerID + "</option>").appendTo($("#sellerselect"));
						}
				});
			});
		});*/
		$(document).ready(function(){
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
				$("#DeliveryDate").val($(this).children().eq(0).text());
				$("#DeliveryUserID").val($(this).children().eq(1).text());
				$("#DeliveryUser").val($(this).children().eq(2).text());
			//	$("#TicketNumber").val($(this).children().eq(3).text());
				$("#DeliveryMoney").val($(this).children().eq(3).text());
				$("#DeliveryNumber").val($(this).children().eq(4).text());
				$("#ExtractionMoney").val($(this).children().eq(5).text());
				$("#ExtractionNumber").val($(this).children().eq(6).text());
				$("#LuggageConsMoney").val($(this).children().eq(7).text());
				$("#lugconsigntation").val($(this).children().eq(8).text());
			}); 
		});
		function op(){
			if(document.getElementById("DeliveryUserID").value==""){
				alert('请选择缴费单')
				return false;
			}
			else{
				document.form2.submit();	
			}
				}
		</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;">行 包 营 收  应  缴  款  查  询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车站：</span>
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
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 日期：</span>
					<input type="text" id="checkdate1" size="12" class="Wdate" value="<?php if(isset($_POST['resultquery'])){echo $_POST['checkdate1'];} else{ echo date('Y-m-d');}?>"  name="checkdate1" onclick="WdatePicker({onpicked:function(dp){$dp.$('date1Value').value=dp.cal.getDateStr();}});" />&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;
					<input type="text" id="checkdate2" size="12" class="Wdate" value="<?php if(isset($_POST['resultquery'])){echo $_POST['checkdate2'];} else{ echo date('Y-m-d');}?>" name="checkdate2" onclick="WdatePicker({onpicked:function(dp){$dp.$('date2Value').value=dp.cal.getDateStr();}});" />
				</td>
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 行包员：</span>
					<select id="sellerselect" name="sellerselect" size="1">
						<?php 
						if($sellerID == "" || $sellerID == "%"){
						?>
							<option value="" selected="selected">请选择行包员</option>
						<?php } else{ ?>
							<option value="">请选择行包员</option>
							<option value="<?php echo $sellerID?>" selected="selected"><?=$sellerID?></option>
						<?php 
						}
						?>
						<?php 
						$query="SELECT ui_UserID FROM tms_sys_UsInfor  WHERE  ui_UserGroup LIKE '%行包组%' AND ui_UserSation like '$userStationName%'";
						$result = $class_mysql_default->my_query("$query");
						while ($row = mysql_fetch_array($result)) {
							if($sellerID != $row['ui_UserID']){
						?>
							<option value="<?php echo $row['ui_UserID']?>"><?=$row['ui_UserID']?></option>
						<?php 
							}
						}
						?>
					</select>
				</td>
				<td  nowrap="nowrap" bgcolor="#FFFFFF">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" value="查询" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="sellsub" value="缴款" onclick="op()"/>
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="exceldoc" id="exceldoc" value="导出Excel" />
				</td>
			</tr>
		<!--  
			<tr>
				<td style="border:0px;">
					<input type="hidden" id="date1Value" value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>" name="date1Value" />
					<input type="hidden" id="date2Value" value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="date2Value" />
				</td>
			</tr>
		-->
		</table>
		</form>
		
		<form action="tms_v1_lugconsign_sellSub.php" method="post" name="form2">
		<div id="tableContainer" class="tableContainer" style="margin-top:-20px;"> 
		<table class="main_tableboder" id="table1" > 
		<thead class="fixedHeader">
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发货日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">行包员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">行包员</th>
			<!--
				<th nowrap="nowrap" align="center" bgcolor="#006699">行包单号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开始包车单号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结束包车单号</th>
			 -->
				<th nowrap="nowrap" align="center" bgcolor="#006699">发行包单金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发行包单张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">收行包单金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">收行包单张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">应缴款金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">行包员所属车站</th>
			</tr>
			</thead>
			<tbody class="scrollContent">
			<?php
				if(isset($_POST['resultquery'])) {
					$CheckBeginDate = $_POST['checkdate1'];
					$CheckEndDate = $_POST['checkdate2'];
					if($CheckBeginDate == "" && $CheckEndDate == ""){
						$strDate = '';
					}
					if($CheckBeginDate != "" && $CheckEndDate == ""){
						$strDate=" AND lc_AcceptDateTime >= '{$CheckBeginDate}'";
					}
					if ($CheckBeginDate == "" && $CheckEndDate != ""){
 						$strDate=" AND lc_AcceptDateTime < DATE_ADD('{$CheckEndDate}', INTERVAL 1 DAY)";
 					}
					if ($CheckBeginDate != "" && $CheckEndDate != ""){
 						$strDate=" AND lc_AcceptDateTime >= '{$CheckBeginDate}' AND lc_AcceptDateTime < DATE_ADD('{$CheckEndDate}', INTERVAL 1 DAY)";
 					}
					$select1="SELECT lc_DeliveryDate,lc_DeliveryUserID,lc_TicketNumber,lc_AcceptDateTime,lc_DeliveryUser, IFNULL(SUM(lc_Allmoney),0) AS Allmoney, 
						COUNT(lc_TicketNumber) AS Number,lc_Station FROM tms_lug_LuggageCons WHERE (lc_Station LIKE '{$StationName}') AND (lc_DeliveryUserID LIKE '{$sellerID}')
						AND (lc_PayStyle='发货人付款') AND (IFNULL(lc_IsBalance,0)!=1) AND lc_DeliveryUserID IN (SELECT ui_UserID FROM tms_sys_UsInfor WHERE ui_UserSation LIKE '{$StationName}')".$strDate.
						" GROUP BY lc_DeliveryUserID, lc_DeliveryDate ORDER BY lc_DeliveryUserID ASC, lc_DeliveryDate ASC";
					$result1 = $class_mysql_default->my_query("$select1");
					while ($row1 = mysql_fetch_array($result1)) {					        
						$select2="SELECT IFNULL(SUM(lc_Allmoney),0) AS Allmoneys, COUNT(lc_TicketNumber) AS Numbers FROM tms_lug_LuggageCons WHERE (lc_ExtractionUserID='{$row1['lc_DeliveryUserID']}') AND 
							(DATE_FORMAT(lc_ExtractionTime,'%y-%m-%d')= DATE_FORMAT('{$row1['lc_AcceptDateTime']}','%y-%m-%d'))  AND (lc_PayStyle='收货人付款') AND (IFNULL(lc_IsBalance,0)!=1) 
							AND lc_ExtractionUserID IN (SELECT ui_UserID FROM tms_sys_UsInfor WHERE ui_UserSation LIKE '{$StationName}') GROUP BY lc_ExtractionUserID";
					$result2 = $class_mysql_default->my_query("$select2");
					$row2 = mysql_fetch_array($result2);
					
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap" align="center"><?php echo $row1['lc_DeliveryDate'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['lc_DeliveryUserID'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['lc_DeliveryUser'];?></td>
			<!-- 
				<td nowrap="nowrap" align="center"><?php echo $row1['lc_TicketNumber'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['beginTicketID'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['endTicketID'];?></td>
			-->
				<td nowrap="nowrap" align="center"><?php echo $row1['Allmoney'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['Number'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row2['Allmoneys'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row2['Numbers'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['Allmoney']+$row2['Allmoneys'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['lc_Station'];?></td>
			</tr>
			<?php
					}
					if($CheckBeginDate == "" && $CheckEndDate == ""){
						$strDate1 = '';
					}
					if($CheckBeginDate != "" && $CheckEndDate == ""){
						$strDate1=" AND lc_ExtractionTime >= '{$CheckBeginDate}'";
					}
					if ($CheckBeginDate == "" && $CheckEndDate != ""){
 						$strDate1=" AND lc_ExtractionTime < DATE_ADD('{$CheckEndDate}', INTERVAL 1 DAY)";
 					}
					if ($CheckBeginDate != "" && $CheckEndDate != ""){
 						$strDate1="AND lc_ExtractionTime >= '{$CheckBeginDate}' AND lc_ExtractionTime < DATE_ADD('{$CheckEndDate}', INTERVAL 1 DAY)";
 					}
					$select3="SELECT DATE_FORMAT(lc_ExtractionTime,'%Y-%m-%d') AS ExtractionTime,lc_ExtractionUserID,lc_ExtractionUser ,IFNULL(SUM(lc_Allmoney),0) AS Allmoneyt,
						COUNT(lc_TicketNumber) AS Number,lc_Destination FROM tms_lug_LuggageCons WHERE (lc_ExtractionUserID  LIKE '{$sellerID}') AND (lc_PayStyle='收货人付款') 
						AND (IFNULL(lc_IsBalance,0)!=1) AND lc_ExtractionUserID IN (SELECT ui_UserID FROM tms_sys_UsInfor WHERE ui_UserSation LIKE '{$StationName}')".$strDate1.
						" GROUP BY lc_ExtractionUserID,ExtractionTime ORDER BY lc_ExtractionUserID ASC, ExtractionTime ASC";
					$result3 = $class_mysql_default->my_query("$select3");
					while ($row3 = mysql_fetch_array($result3)) {
						$select4="SELECT lc_DeliveryUserID FROM tms_lug_LuggageCons WHERE (lc_DeliveryUserID='{$row3['lc_ExtractionUserID']}') AND 
							(DATE_FORMAT(lc_AcceptDateTime,'%y-%m-%d')=DATE_FORMAT('{$row3['ExtractionTime']}','%y-%m-%d')) AND (lc_PayStyle='发货人付款') AND (IFNULL(lc_IsBalance,0)!=1)";
						$result4 = $class_mysql_default->my_query("$select4");
					//	$row4 = mysql_fetch_array($result4);
					//	if(!$row4){
					if(mysql_num_rows($result4)==0){
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap" align="center"><?php echo $row3['ExtractionTime'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row3['lc_ExtractionUserID'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row3['lc_ExtractionUser'];?></td>
			<!--  
				<td nowrap="nowrap" align="center"><?php echo $row1['beginTicketID'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['endTicketID'];?></td>
			-->
				<td nowrap="nowrap" align="center"></td>
				<td nowrap="nowrap" align="center"></td>
				<td nowrap="nowrap" align="center"><?php echo $row3['Allmoneyt'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row3['Number'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row3['Allmoneyt'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row3['lc_Destination'];?></td>
			</tr>
			<?php 			
						}
					}
				}
				
			?>
			<tr>
				<td style="border:0px;">
					<input type="hidden" id="DeliveryDate" value="" name="DeliveryDate" />
					<input type="hidden" id="DeliveryUserID" value="" name="DeliveryUserID" />
					<input type="hidden" id="DeliveryUser" value="" name="DeliveryUser" />
					<input type="hidden" id="TicketNumber" value="" name="TicketNumber" />					
					<input type="hidden" id="DeliveryMoney" value="" name="DeliveryMoney" />
					<input type="hidden" id="DeliveryNumber" value="" name="DeliveryNumber" />
					<input type="hidden" id="ExtractionMoney" value="" name="ExtractionMoney" />
					<input type="hidden" id="ExtractionNumber" value="" name="ExtractionNumber" />
					<input type="hidden" id="LuggageConsMoney" value="" name="LuggageConsMoney" />
					<input type="hidden" id="lugconsigntation" value="" name="lugconsigntation" />
					<input type="hidden" id="userID" value="<?php echo $userID?>" name="userID" />
					<input type="hidden" id="userName" value="<?php echo $userName?>" name="userName" />
				</td>
			</tr>
			</tbody>
		</table>
		</div>
		</form>
	</body>
</html>
