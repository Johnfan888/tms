<?php
/*
 * 车辆运量统计表
 * 	
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$CheckBeginDate = "";
$CheckEndDate = "";
$StationName = "";
if(isset($_POST['resultquery']) || isset($_POST['exceldoc'])) {
	$CheckBeginDate = $_POST['date1Value'];
	$CheckEndDate = $_POST['date2Value'];
	if (($StationName = $_POST['stationselect']) == "")
		$StationName = "%";
	
	if(isset($_POST['exceldoc'])) {
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");
		
		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '车辆运量汇总表', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$CheckBeginDate" . "至" . "$CheckEndDate";
		$out = array($qrydate, '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('车辆编号', '车牌号', '车属单位', '车型', '车站名称', '核定运量', '实际运量', '实载率(%)');
		fputcsv($fp, $head);

		$cnt = 0; 
		$limit = 100000; 
		$outputRow = "";
		$ratio = 0;
		$queryString = "SELECT bh_BusID, bh_BusNumber, bh_BusUnit, bh_BusModelID, bh_Station AS Station, IFNULL(SUM(bh_CheckTotal),0) AS CheckTotal, 
			SUM(IFNULL((SELECT bi_SeatS FROM tms_bd_BusInfo WHERE (bi_BusID = tms_acct_BalanceInHand.bh_BusID)),0)) AS SeatS 
			FROM tms_acct_BalanceInHand	WHERE (bh_NoOfRunsdate >= '{$CheckBeginDate}') AND (bh_NoOfRunsdate <= '{$CheckEndDate}') 
			AND (bh_Station LIKE '{$StationName}') GROUP BY bh_BusID, bh_Station ORDER BY bh_BusID ASC";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysqli_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			$ratio = $row['CheckTotal'] / $row['SeatS'] * 100;
			$outputRow = array($row['bh_BusID'], $row['bh_BusNumber'], $row['bh_BusUnit'], $row['bh_BusModelID'], $row['Station'], 
							$row['SeatS'], $row['CheckTotal'], number_format("$ratio",2)); 
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
		<title>车辆运量统计</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script>
		$(document).ready(function(){
			$("#table1 tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
			$("#table1 tr").mouseout(function(){$(this).css("background-color","#cccccc");});
			$("#table1 tr").click(function(){
				$("#table1 tr:not(this)").css("background-color","#cccccc");
				$("#table1 tr:not(this)").mouseover(function(){$(this).css("background-color","#F1E6C2");});
				$("#table1 tr:not(this)").mouseout(function(){$(this).css("background-color","#cccccc");});
				$(this).css("background-color","#FFCC00");
				$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
				$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
			});
		});
		</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 车 辆 运 量 统 计</span></td>
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
					<input type="text" id="checkdate1" size="12" class="Wdate" value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>"  name="checkdate1" onclick="WdatePicker({onpicked:function(dp){$dp.$('date1Value').value=dp.cal.getDateStr();}});" />&nbsp;&nbsp;至&nbsp;&nbsp;
					<input type="text" id="checkdate2" size="12" class="Wdate" value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="checkdate2" onclick="WdatePicker({onpicked:function(dp){$dp.$('date2Value').value=dp.cal.getDateStr();}});" />
				</td>
				<td bgcolor="#FFFFFF">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" id="resultquery" value="确定" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="submit" name="exceldoc" id="exceldoc" value="导出报表" />&nbsp;&nbsp;&nbsp;&nbsp;
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
		
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main_tableborder" style="margin-top:-20px;">
  			<tr>
  				<td align="center" bgcolor="#FFFFFF"><span style="font-weight:bold;font-size:14;color:black;">车辆运量汇总表</span></td>
  			</tr>
		</table>
		<div id="tableContainer" class="tableContainer" > 
		<table class="main_tableboder" id="table1" > 
		<thead class="fixedHeader">
			<tr align="center">
				<th nowrap="nowrap" bgcolor="#006699">车辆编号</th>
				<th nowrap="nowrap" bgcolor="#006699">车牌号</th>
				<th nowrap="nowrap" bgcolor="#006699">车属单位</th>
				<th nowrap="nowrap" bgcolor="#006699">车型</th>
				<th nowrap="nowrap" bgcolor="#006699">车站名称</th>
				<th nowrap="nowrap" bgcolor="#006699">核定运量</th>
				<th nowrap="nowrap" bgcolor="#006699">实际运量</th>
				<th nowrap="nowrap" bgcolor="#006699">实载率(%)</th>
			</tr>
			</thead>
				<tbody class="scrollContent"> 
			<?php
				if(isset($_POST['resultquery'])) {
					$ratio = 0;
					$queryString = "SELECT bh_BusID, bh_BusNumber, bh_BusUnit, bh_BusModelID, bh_Station AS Station, IFNULL(SUM(bh_CheckTotal),0) AS CheckTotal, 
						SUM(IFNULL((SELECT bi_SeatS FROM tms_bd_BusInfo WHERE (bi_BusID = tms_acct_BalanceInHand.bh_BusID)),0)) AS SeatS 
						FROM tms_acct_BalanceInHand	WHERE (bh_NoOfRunsdate >= '{$CheckBeginDate}') AND (bh_NoOfRunsdate <= '{$CheckEndDate}') 
						AND (bh_Station LIKE '{$StationName}') GROUP BY bh_BusID, bh_Station ORDER BY bh_BusID ASC";
					$result = $class_mysql_default->my_query("$queryString");
					while ($row = mysqli_fetch_array($result)) {
						$ratio = $row['CheckTotal'] / $row['SeatS'] * 100;
			?>
			<tr align="center">
				<td nowrap="nowrap"><?php echo $row['bh_BusID'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_BusNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_BusUnit'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_BusModelID'];?></td>
				<td nowrap="nowrap"><?php echo $row['Station'];?></td>
				<td nowrap="nowrap"><?php echo $row['SeatS'];?></td>
				<td nowrap="nowrap"><?php echo $row['CheckTotal'];?></td>
				<td nowrap="nowrap"><?php echo number_format("$ratio",2);?></td>
			</tr>
			<?php
					}
			?>
			<?php 
				}
			?>
			</tbody>
		</table>
		</div>
	</body>
</html>
