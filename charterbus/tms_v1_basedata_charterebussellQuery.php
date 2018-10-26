<?php
/*
 * 包车营收缴款页面
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
		$out = array('', '', '', '', '', '', '', '', '包车应缴款信息表', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$CheckBeginDate" . "至" . "$CheckEndDate";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('开单日期', '开单员ID', '开单员', '开始包车单号', '结束包车单号', '包车单金额', '包车单张数', '应缴款金额',  
					 '开单员所属车站');
		fputcsv($fp, $head);
		
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = "";
		$queryString = "SELECT cb_BillingDate,cb_BillingerID,cb_BillingerName, MIN(cb_TicketID) AS beginTicketID, MAX(cb_TicketID) AS endTicketID,
						IFNULL(SUM(cb_CarriageFee),0) AS CarriageFee,IFNULL(SUM(cb_StagnateFee),0) AS StagnateFee,COUNT(cb_TicketID) AS Number,cb_BillingStation 
						FROM tms_bd_CharteredBus WHERE (cb_BillingDate >= '{$CheckBeginDate}') AND (cb_BillingDate <= '{$CheckEndDate}') AND (cb_State = 1) AND (IFNULL(cb_IsBalance,0)!=1)  
						AND (cb_BillingStation LIKE '{$StationName}') AND (cb_BillingerID LIKE '{$sellerID}') GROUP BY cb_BillingerID, cb_BillingDate 
						ORDER BY cb_BillingDate ASC, cb_BillingerID ASC";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysqli_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
		//	$UpCount = $row['errNumber'] + $row['returnNumber'];
			$UpMoney = $row['CarriageFee'] + $row['StagnateFee'];
			$outputRow = array($row['cb_BillingDate'], $row['cb_BillingerID'], $row['cb_BillingerName'], $row['beginTicketID'], $row['endTicketID'], 
				$UpMoney, $row['Number'], $UpMoney, $row['cb_BillingStation']); 
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
		<title>包车营收缴款</title>
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
					'tms_v1_basedata_getdata.php',
					{'op': 'getchartereData', 'stationName': stationName, 'time': Math.random()},
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
				$("#BillingDate").val($(this).children().eq(0).text());
				$("#BillingerID").val($(this).children().eq(1).text());
				$("#BillingerName").val($(this).children().eq(2).text());
				$("#beginTicketID").val($(this).children().eq(3).text());
				$("#endTicketID").val($(this).children().eq(4).text());
				$("#CharteredMoney").val($(this).children().eq(5).text());
				$("#Number").val($(this).children().eq(6).text());
				$("#turnMoney").val($(this).children().eq(7).text());
				$("#BillingStation").val($(this).children().eq(8).text());
			});
		});
		function op(){
			if(document.getElementById("BillingerID").value==""){
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
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;">包 车 营 收  应  缴  款  查  询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
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
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开单员：</span>
					<select id="sellerselect" name="sellerselect" size="1">
						<?php 
						if($sellerID == "" || $sellerID == "%"){
						?>
							<option value="" selected="selected">请选择开单员</option>
						<?php } else{ ?>
							<option value="">请选择开单员</option>
							<option value="<?php echo $sellerID?>" selected="selected"><?=$sellerID?></option>
						<?php 
						}
						?>
						<?php 
						$query="SELECT ui_UserID FROM tms_sys_UsInfor  WHERE  ui_UserGroup LIKE '%包车组%' AND ui_UserSation like '$userStationName%'";
						$result = $class_mysql_default->my_query("$query");
						while ($row = mysqli_fetch_array($result)) {
							if($sellerID != $row['ui_UserID']){
						?>
							<option value="<?php echo $row['ui_UserID']?>"><?=$row['ui_UserID']?></option>
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
					<input type="hidden" id="date1Value" value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>" name="date1Value" />
					<input type="hidden" id="date2Value" value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="date2Value" />
				</td>
			</tr>
		</table>
		</form>
		
		<form action="tms_v1_basedata_charterbussellSub.php" method="post" name="form2">
		<div id="tableContainer" class="tableContainer" style="margin-top:-20px;"> 
		<table class="main_tableboder" id="table1" > 
		<thead class="fixedHeader">
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开单日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开单员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开单员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开始包车单号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结束包车单号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">包车单金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">包车单张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">应缴款金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开单员所属车站</th>
			</tr>
			</thead>
			<tbody class="scrollContent">
			<?php
				if(isset($_POST['resultquery'])) {
					$select="SELECT cb_BillingDate,cb_BillingerID,cb_BillingerName, MIN(cb_TicketID) AS beginTicketID, MAX(cb_TicketID) AS endTicketID,
						IFNULL(SUM(cb_CarriageFee),0) AS CarriageFee,IFNULL(SUM(cb_StagnateFee),0) AS StagnateFee,COUNT(cb_TicketID) AS Number,cb_BillingStation 
						FROM tms_bd_CharteredBus WHERE (cb_BillingDate >= '{$CheckBeginDate}') AND (cb_BillingDate <= '{$CheckEndDate}') AND (cb_State = 1) AND (IFNULL(cb_IsBalance,0)!=1)  
						AND (cb_BillingStation LIKE '{$StationName}') AND (cb_BillingerID LIKE '{$sellerID}') GROUP BY cb_BillingerID, cb_BillingDate 
						ORDER BY cb_BillingDate ASC, cb_BillingerID ASC"; 
						//GROUP BY　cb_BillingerID, cb_BillingDate ORDER BY cb_BillingerID ASC, cb_BillingDate ASC";
					$results = $class_mysql_default->my_query("$select");
					while ($rows = mysqli_fetch_array($results)) {
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $rows['cb_BillingDate'];?></td>
				<td nowrap="nowrap"><?php echo $rows['cb_BillingerID'];?></td>
				<td nowrap="nowrap"><?php echo $rows['cb_BillingerName'];?></td>
				<td nowrap="nowrap"><?php echo $rows['beginTicketID'];?></td>
				<td nowrap="nowrap"><?php echo $rows['endTicketID'];?></td>
				<td nowrap="nowrap"><?php echo $rows['CarriageFee']+$rows['StagnateFee'];?></td>
				<td nowrap="nowrap"><?php echo $rows['Number'];?></td>
				<td nowrap="nowrap"><?php echo $rows['CarriageFee']+$rows['StagnateFee'];?></td>
				<td nowrap="nowrap"><?php echo $rows['cb_BillingStation'];?></td>
			</tr>
			<?php
					}
				}
			?>
			<tr>
				<td style="border:0px;">
					<input type="hidden" id="BillingDate" value="" name="BillingDate" />
					<input type="hidden" id="BillingerID" value="" name="BillingerID" />
					<input type="hidden" id="BillingerName" value="" name="BillingerName" />
					<input type="hidden" id="beginTicketID" value="" name="beginTicketID" />
					<input type="hidden" id="endTicketID" value="" name="endTicketID" />
					<input type="hidden" id="CharteredMoney" value="" name="CharteredMoney" />
					<input type="hidden" id="Number" value="" name="Number" />
					<input type="hidden" id="turnMoney" value="" name="turnMoney" />
					<input type="hidden" id="BillingStation" value="" name="BillingStation" />
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
