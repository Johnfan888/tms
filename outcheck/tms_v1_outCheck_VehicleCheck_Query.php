<?php
/*
 * 稽查查询页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$CheckBeginDate = "";
$CheckEndDate = "";
$StationName = "";
$oc_Result = "";
$oc_BusID = "";
if(isset($_POST['resultquery']) || isset($_POST['exceldoc'])) {
	$CheckBeginDate = $_POST['date1Value'];
	$CheckEndDate = $_POST['date2Value'];
	$CheckBeginDatetime = $_POST['date1Value'] . " 00:00:00";
	$CheckEndDatetime = $_POST['date2Value'] . " 23:59:59";
	if (($StationName = $_POST['stationselect']) == "")
		$StationName = "%";
	if (($oc_Result = $_POST['resultselect']) == "")
		$oc_Result = "%";
	if (($oc_BusID = $_POST['busID']) == "")
		$oc_BusID = "%";
	
	if(isset($_POST['exceldoc'])) {
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");
		
		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '', '', '稽查信息表', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$CheckBeginDate" . "至" . "$CheckEndDate";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('稽查日期', '车辆编号', '车牌号', '稽查结果', '稽查站', '稽查员', '班次', '乘客数', '免票儿童数',	'稽查项目一', '稽查项目二', 
				'稽查项目三', '稽查项目四', '稽查项目五', '稽查项目六', '稽查项目七', '稽查项目八', '稽查项目九', '稽查项目十');
		fputcsv($fp, $head);
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = ""; 
		$queryString = "SELECT * FROM tms_sf_OutCheck WHERE oc_CheckDate >= '{$CheckBeginDatetime}' AND oc_CheckDate <= '{$CheckEndDatetime}' 
				AND oc_OutCheck_Station LIKE '{$StationName}' AND oc_Result LIKE '{$oc_Result}' AND oc_BusID LIKE '{$oc_BusID}' 
				ORDER BY oc_CheckDate ASC";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysqli_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			$outputRow = array($row['oc_CheckDate'], $row['oc_BusID'], $row['oc_BusCard'], $row['oc_Result'], $row['oc_OutCheck_Station'], 
					$row['oc_PcUserID'], $row['oc_NoOfRunsID'], $row['oc_RenNo'], $row['oc_FreeSeats'], $row['oc_Item1'], $row['oc_Item2'], 
					$row['oc_Item2'], $row['oc_Item4'], $row['oc_Item5'], $row['oc_Item6'], $row['oc_Item7'], $row['oc_Item8'], 
					$row['oc_Item9'], $row['oc_Item10']); 
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
		<title>稽查信息查询</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../css/style_main.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>		
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script>
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
			});
		});
		</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableborder" border="0" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#4C4C4C"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 稽 查 信 息 查 询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1" onsubmit="">
		<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
  			<tr>
    			<td colspan="5" bgcolor="#0083B5"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 查询结果</td>
  			</tr>
		</table>
		<table width="100%" align="center" class="main_tableborder" border="0" cellpadding="3" cellspacing="1">
			<tr>
				<td align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 稽查站：</span>
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
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 稽查日期：</span>
					<input type="text" id="checkdate1" size="12" class="Wdate" value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>"  name="checkdate1" onclick="WdatePicker({onpicked:function(dp){$dp.$('date1Value').value=dp.cal.getDateStr();}});" />&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;
					<input type="text" id="checkdate2" size="12" class="Wdate" value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="checkdate2" onclick="WdatePicker({onpicked:function(dp){$dp.$('date2Value').value=dp.cal.getDateStr();}});" />
				</td>
				<td align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 稽查结果：</span>
					<select id="resultselect" name="resultselect" size="1">
						<option value="" selected="selected">请选择稽查结果</option>
						<option value="稽查合格">稽查合格</option>
						<option value="稽查不合格">稽查不合格</option>
					</select>
				</td>
				<td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆编号：</span>
					<input type="text" name="busID" id="busID" value="<?php ($oc_BusID == "" || $oc_BusID == "%")? print "" : print $oc_BusID;?>" />
				</td>
				<td bgcolor="#FFFFFF">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" id="resultquery" value="查询" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="exceldoc" id="exceldoc" value="导出Excel" />
				</td>
			</tr>
			<tr>
				<td>
					<input type="hidden" id="date1Value" value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>" name="date1Value" />
					<input type="hidden" id="date2Value" value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="date2Value" />
				</td>
			</tr>
		</table>
		<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableborder" id="table1">
		<thead>
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">稽查日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">稽查结果</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">稽查站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">稽查员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">乘客数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">免票儿童数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">稽查项目一</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">稽查项目二</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">稽查项目三</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">稽查项目四</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">稽查项目五</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">稽查项目六</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">稽查项目七</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">稽查项目八</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">稽查项目九</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">稽查项目十</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if(isset($_POST['resultquery'])) {
					$queryString = "SELECT * FROM tms_sf_OutCheck WHERE oc_CheckDate >= '{$CheckBeginDatetime}' AND oc_CheckDate <= '{$CheckEndDatetime}' 
							AND oc_OutCheck_Station LIKE '{$StationName}' AND oc_Result LIKE '{$oc_Result}' AND oc_BusID LIKE '{$oc_BusID}' 
							ORDER BY oc_CheckDate ASC";
					$result = $class_mysql_default->my_query("$queryString");
					while ($row = mysqli_fetch_array($result)) {
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row['oc_CheckDate'];?></td>
				<td nowrap="nowrap"><?php echo $row['oc_BusID'];?></td>
				<td nowrap="nowrap"><?php echo $row['oc_BusCard'];?></td>
				<td nowrap="nowrap"><?php echo $row['oc_Result'];?></td>
				<td nowrap="nowrap"><?php echo $row['oc_OutCheck_Station'];?></td>
				<td nowrap="nowrap"><?php echo $row['oc_PcUserID'];?></td>
				<td nowrap="nowrap"><?php echo $row['oc_NoOfRunsID'];?></td>
				<td nowrap="nowrap"><?php echo $row['oc_RenNo'];?></td>
				<td nowrap="nowrap"><?php echo $row['oc_FreeSeats'];?></td>
				<td><?php echo $row['oc_Item1'];?></td>
				<td><?php echo $row['oc_Item2'];?></td>
				<td><?php echo $row['oc_Item3'];?></td>
				<td><?php echo $row['oc_Item4'];?></td>
				<td><?php echo $row['oc_Item5'];?></td>
				<td><?php echo $row['oc_Item6'];?></td>
				<td><?php echo $row['oc_Item7'];?></td>
				<td><?php echo $row['oc_Item8'];?></td>
				<td><?php echo $row['oc_Item9'];?></td>
				<td><?php echo $row['oc_Item10'];?></td>
			</tr>
			<?php
					}
				}
			?>   
		</tbody>
		</table>
		</form>
	</body>
</html>
