<?php
/*
 * 营收缴款页面
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
	$CheckBeginDate = $_POST['date1Value'];
	$CheckEndDate = $_POST['date2Value'];
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
		$out = array('', '', '', '', '', '', '', '', '售票应缴款信息表', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$CheckBeginDate" . "至" . "$CheckEndDate";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('售票日期', '售票员ID', '售票员', '开始票号', '结束票号', '售票金额', '售票张数', '废票金额', '废票张数', '退还金额', 
					'退票张数', '退票手续费', '保险票金额', '保险票张数', '应交票张数', '应缴金额', '售票员所属车站');
		fputcsv($fp, $head);
		
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = "";
		$queryString = "SELECT st_SellDate AS sellDate, st_SellID AS sellerID, st_SellName AS sellerName, 
			MIN(st_TicketID) AS beginTicketID, MAX(st_TicketID) AS endTicketID, IFNULL(SUM(st_SellPrice),0) AS sellMoney, COUNT(st_TicketID) AS sellNumber, 
			IFNULL((SELECT SUM(et_SellPrice) FROM tms_sell_ErrTicket WHERE (et_ErrUserID = tms_sell_SellTicket.st_SellID) AND (et_ErrDate = tms_sell_SellTicket.st_SellDate) AND (et_IsBalance = 0)),0) AS errMoney, 
			(SELECT COUNT(et_TicketID) FROM tms_sell_ErrTicket WHERE (et_ErrUserID = tms_sell_SellTicket.st_SellID) AND (et_ErrDate = tms_sell_SellTicket.st_SellDate) AND (et_IsBalance = 0)) AS errNumber, 
			IFNULL((SELECT SUM(rtk_ReturnPrice) FROM tms_sell_ReturnTicket WHERE (rtk_ReturnUserID = tms_sell_SellTicket.st_SellID) AND (rtk_ReturnDate = tms_sell_SellTicket.st_SellDate) AND (rtk_IsBalance = 2)),0) AS returnMoney, 
			(SELECT COUNT(rtk_TicketID) FROM tms_sell_ReturnTicket WHERE (rtk_ReturnUserID = tms_sell_SellTicket.st_SellID) AND (rtk_ReturnDate = tms_sell_SellTicket.st_SellDate) AND (rtk_IsBalance = 2)) AS returnNumber, 
			IFNULL((SELECT SUM(rtk_SXPrice) FROM tms_sell_ReturnTicket WHERE (rtk_ReturnUserID = tms_sell_SellTicket.st_SellID) AND (rtk_ReturnDate = tms_sell_SellTicket.st_SellDate) AND (rtk_IsBalance = 2)),0) AS returnFees, 
			IFNULL(SUM(st_SafetyTicketMoney),0) AS insurMoney, IFNULL(SUM(st_SafetyTicketNumber),0) AS insurNumber, st_Station AS sellerStation	FROM tms_sell_SellTicket 
			WHERE (st_SellDate >= '{$CheckBeginDate}') AND (st_SellDate <= '{$CheckEndDate}') AND (st_IsBalance = 0) AND (st_Station LIKE '{$StationName}') AND (st_SellID LIKE '{$sellerID}') 
			GROUP BY st_SellID, st_SellDate	ORDER BY st_SellDate ASC, st_SellID ASC";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysqli_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			$UpCount = $row['errNumber'] + $row['returnNumber'];
			$UpMoney = $row['sellMoney'] - $row['errMoney'] - $row['returnMoney']+$row['insurMoney'];
			$outputRow = array($row['sellDate'], $row['sellerID'], $row['sellerName'], $row['beginTicketID'], $row['endTicketID'], 
				$row['sellMoney'], $row['sellNumber'], $row['errMoney'], $row['errNumber'], $row['returnMoney'], $row['returnNumber'], 
				$row['returnFees'], $row['insurMoney'], $row['insurNumber'], $UpCount, $UpMoney, $row['sellerStation']); 
			fputcsv($fp, $outputRow); 
		}
		
		fclose($fp);
		exit();
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head> 
		<title>营收缴款</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../css/tms.css" rel="stylesheet" type="text/css">
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script>
		/*$(document).ready(function(){
			$("#stationselect").focus();
			$("#stationselect").blur(function(){
				var stationName = $("#stationselect").val();
				var sellerID = $("#sellerID").val();
				jQuery.get(
					'tms_v1_accounting_dataProcess.php',
					{'op': 'getSellersData', 'stationName': stationName, 'time': Math.random()},
					function(data){
						$("#sellerselect option:gt(0)").remove();
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							if(sellerID == objData[i].sellerID){
							$("<option value = " + objData[i].sellerID +  "selected='selected' >" + objData[i].sellerID + "</option>").appendTo($("#sellerselect"));
							}
							else{
							$("<option value = " + objData[i].sellerID +  ">" + objData[i].sellerID + "</option>").appendTo($("#sellerselect"));
							}
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
				$("#sellDate").val($(this).children().eq(0).text());
				$("#sellerID1").val($(this).children().eq(1).text());
				$("#sellerName").val($(this).children().eq(2).text());
				$("#beginTicketID").val($(this).children().eq(3).text());
				$("#endTicketID").val($(this).children().eq(4).text());
				$("#sellMoney").val($(this).children().eq(5).text());
				$("#sellNumber").val($(this).children().eq(6).text());
				$("#errMoney").val($(this).children().eq(7).text());
				$("#errNumber").val($(this).children().eq(8).text());
				$("#returnMoney").val($(this).children().eq(9).text());
				$("#returnNumber").val($(this).children().eq(10).text());
				$("#returnFees").val($(this).children().eq(11).text());
				$("#insurMoney").val($(this).children().eq(12).text());
				$("#insurNumber").val($(this).children().eq(13).text());
				$("#subNumber").val($(this).children().eq(14).text());
				$("#subMoney").val($(this).children().eq(15).text());
				$("#sellerStation").val($(this).children().eq(16).text());
			});
		});
function op(){
if(document.getElementById("sellerID1").value==""){
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
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 营 收  应  缴  款  查  询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
	
		<table width="100%" align="center"  border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td align="left" bgcolor="#FFFFFF">
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
				<td align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 日期：</span>
					<input type="text" id="checkdate1" size="12" class="Wdate" value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>"  name="checkdate1" onclick="WdatePicker({onpicked:function(dp){$dp.$('date1Value').value=dp.cal.getDateStr();}});" />&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;
					<input type="text" id="checkdate2" size="12" class="Wdate" value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="checkdate2" onclick="WdatePicker({onpicked:function(dp){$dp.$('date2Value').value=dp.cal.getDateStr();}});" />
				</td>
				<td align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 售票员：</span>
					<select id="sellerselect" name="sellerselect" size="1">
					<?php 
					if($sellerID == "" || $sellerID == "%"){
					?>
						<option value="" selected="selected">请选择售票员</option>
					<?php } else{ ?>
						<option value="">请选择售票员</option>
						<option value="<?php echo $sellerID?>" selected="selected"><?php echo $sellerID?></option>
					<?php 
					}
					?>
					<?php 
					$query="SELECT ui_UserID FROM tms_sys_UsInfor  WHERE  ui_UserGroup LIKE '%售票组%' AND ui_UserSation like '$userStationName%'";
					$result = $class_mysql_default->my_query("$query");
					while ($row = mysqli_fetch_array($result)) {
						if($sellerID != $row['ui_UserID']){
					?>
						<option value="<?php echo $row['ui_UserID']?>"><?php echo $row['ui_UserID']?></option>
					<?php 
						}
					}
					?>
					</select>
				</td>
				<td bgcolor="#FFFFFF">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" value="查询" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="sellsub" value="缴款" onclick="op()"/>
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="exceldoc" id="exceldoc" value="导出Excel" />
				</td>
			</tr>
			<tr>
				<td style="border:0px;">
					<input type="hidden" id="date1Value"   value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>" name="date1Value" />
					<input type="hidden" id="date2Value"  value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="date2Value" />
				</td>
			</tr>
		</table>
		</form>
		
<form action="tms_v1_accounting_sellSub.php" method="post" name="form2">
<div id="tableContainer" class="tableContainer" style="margin-top:-20px;"> 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开始票号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结束票号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">废票金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">废票张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">退还金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">退票张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">退票手续费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保险票金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保险票张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">应交票张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">应缴款金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票员所属车站</th>
			</tr>
			</thead>
<tbody class="scrollContent">
			<?php
				if(isset($_POST['resultquery'])) {
					$queryString = "SELECT st_SellDate AS sellDate, st_SellID AS sellerID, st_SellName AS sellerName, 
						MIN(st_TicketID) AS beginTicketID, MAX(st_TicketID) AS endTicketID, IFNULL(SUM(st_SellPrice),0) AS sellMoney, COUNT(st_TicketID) AS sellNumber, 
						IFNULL((SELECT SUM(et_SellPrice) FROM tms_sell_ErrTicket WHERE (et_ErrUserID = tms_sell_SellTicket.st_SellID) AND (et_ErrDate = tms_sell_SellTicket.st_SellDate) AND (et_IsBalance = 0)),0) AS errMoney, 
						(SELECT COUNT(et_TicketID) FROM tms_sell_ErrTicket WHERE (et_ErrUserID = tms_sell_SellTicket.st_SellID) AND (et_ErrDate = tms_sell_SellTicket.st_SellDate) AND (et_IsBalance = 0)) AS errNumber, 
						IFNULL((SELECT SUM(rtk_ReturnPrice) FROM tms_sell_ReturnTicket WHERE (rtk_ReturnUserID = tms_sell_SellTicket.st_SellID) AND (rtk_ReturnDate = tms_sell_SellTicket.st_SellDate) AND (rtk_IsBalance = 2)),0) AS returnMoney, 
						(SELECT COUNT(rtk_TicketID) FROM tms_sell_ReturnTicket WHERE (rtk_ReturnUserID = tms_sell_SellTicket.st_SellID) AND (rtk_ReturnDate = tms_sell_SellTicket.st_SellDate) AND (rtk_IsBalance = 2)) AS returnNumber, 
						IFNULL((SELECT SUM(rtk_SXPrice) FROM tms_sell_ReturnTicket WHERE (rtk_ReturnUserID = tms_sell_SellTicket.st_SellID) AND (rtk_ReturnDate = tms_sell_SellTicket.st_SellDate) AND (rtk_IsBalance = 2)),0) AS returnFees, 
						IFNULL(SUM(st_SafetyTicketMoney),0) AS insurMoney, IFNULL(SUM(st_SafetyTicketNumber),0) AS insurNumber, st_Station AS sellerStation	FROM tms_sell_SellTicket 
						WHERE (st_SellDate >= '{$CheckBeginDate}') AND (st_SellDate <= '{$CheckEndDate}') AND (st_IsBalance = 0) AND (st_Station LIKE '{$StationName}') AND (st_SellID LIKE '{$sellerID}') 
						GROUP BY st_SellID, st_SellDate ORDER BY st_SellDate ASC, st_SellID ASC";
					$result = $class_mysql_default->my_query("$queryString");
					while ($row = mysqli_fetch_array($result)) {
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row['sellDate'];?></td>
				<td nowrap="nowrap"><?php echo $row['sellerID'];?></td>
				<td nowrap="nowrap"><?php echo $row['sellerName'];?></td>
				<td nowrap="nowrap"><?php echo $row['beginTicketID'];?></td>
				<td nowrap="nowrap"><?php echo $row['endTicketID'];?></td>
				<td nowrap="nowrap"><?php echo $row['sellMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['sellNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['errMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['errNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['returnMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['returnNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['returnFees'];?></td>
				<td nowrap="nowrap"><?php echo $row['insurMoney'];?></td><!-- 保险票金额 -->
				<td nowrap="nowrap"><?php echo $row['insurNumber'];?></td>
				<td nowrap="nowrap"><?php echo ($row['errNumber']+$row['returnNumber']);?></td>
				<td nowrap="nowrap"><?php echo ($row['sellMoney']-$row['errMoney']-$row['returnMoney'])+$row['insurMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['sellerStation'];?></td>
			</tr>
			<?php
					}
				}
			?>
			<tr>
				<td style="border:0px;">
					<input type="hidden" id="sellDate" value="" name="sellDate" />
					<input type="hidden" id="sellerID1" value="" name="sellerID1" />
					<input type="hidden" id="sellerName" value="" name="sellerName" />
					<input type="hidden" id="beginTicketID" value="" name="beginTicketID" />
					<input type="hidden" id="endTicketID" value="" name="endTicketID" />
					<input type="hidden" id="sellMoney" value="" name="sellMoney" />
					<input type="hidden" id="sellNumber" value="" name="sellNumber" />
					<input type="hidden" id="errMoney" value="" name="errMoney" />
					<input type="hidden" id="errNumber" value="" name="errNumber" />
					<input type="hidden" id="returnMoney" value="" name="returnMoney" />
					<input type="hidden" id="returnNumber" value="" name="returnNumber" />
					<input type="hidden" id="returnFees" value="" name="returnFees" />
					<input type="hidden" id="insurMoney" value="" name="insurMoney" />
					<input type="hidden" id="insurNumber" value="" name="insurNumber" />
					<input type="hidden" id="subNumber" value="" name="subNumber" />
					<input type="hidden" id="subMoney" value="" name="subMoney" />
					<input type="hidden" id="sellerStation" value="" name="sellerStation" />
					<input type="hidden" id="userID" value="<?php echo $userID?>" name="userID" />
					<input type="hidden" id="userName" value="<?php echo $userName?>" name="userName" />
					<input type="hidden" id="sellerID" value="<?php echo $sellerID?>" name="sellerID" />
				</td>
			</tr>
			</tbody>
		</table>
		</div>
		</form>
	</body>
</html>
