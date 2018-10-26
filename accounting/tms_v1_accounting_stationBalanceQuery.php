<?php
/*
 * 站间结算查询页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$CheckBeginDate = date('Y-m-d');
$CheckEndDate = date('Y-m-d');
$StationName1 = "";
$StationName2 = "";
if(isset($_POST['resultquery']) || isset($_POST['exceldoc'])) {
	$CheckBeginDate = $_POST['checkdate1'];
	$CheckEndDate = $_POST['checkdate2'];
	if (($StationName1 = $_POST['stationselect1']) == "")
		$StationName1 = "%";
	if (($StationName2 = $_POST['stationselect2']) == "")
		$StationName2 = "%";
	if ($CheckBeginDate && !$CheckEndDate){
 			$str=" AND sb_BalanceDate>='{$CheckBeginDate}'";
 		}
 	if (!$CheckBeginDate && $CheckEndDate){
 			$str=" AND sb_BalanceDate<='{$CheckEndDate}'";
 		}
 	if ($CheckBeginDate && $CheckEndDate){
 			$str=" AND sb_BalanceDate>='{$CheckBeginDate}' AND sb_BalanceDate<='{$CheckEndDate}'";
 		}
	if (!$CheckBeginDate && !$CheckEndDate){
 			$str="";
 		}			
	if(isset($_POST['exceldoc'])) {
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");
		
		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '', '站间结算信息表', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$CheckBeginDate" . "至" . "$CheckEndDate";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('结算车站1', '客票张数', '客票金额', '行包票张数', '行包金额', '结算车站2', '客票张数', '客票金额', 
			'行包票张数', '行包金额', '开始日期', '结束日期', '结算金额', '结算日期', '结算时间');
		fputcsv($fp, $head);
		
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = "";
		$queryString = "SELECT sb_FStation, sb_FTicketNum,sb_FTicketMoney,sb_FLuggageNum,sb_FLuggageMoney,sb_SStation,sb_STicketNum,
						sb_STicketMoney,sb_SLuggageNum,sb_SLuggageMoney,sb_BeginDate,sb_EndDate,sb_Money,sb_BalanceDate,sb_BalanceTime FROM 
						tms_acct_StationBalance WHERE (sb_FStation LIKE '{$StationName1}') AND (sb_SStation LIKE '{$StationName2}')".$str." ORDER BY sb_BalanceDate ASC";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysqli_fetch_array($result)) {
			$row['sb_FTicketMoney']=$row['sb_FTicketMoney']."\t";
			$row['sb_FLuggageMoney']=$row['sb_FLuggageMoney']."\t";
			$row['sb_STicketMoney']=$row['sb_STicketMoney']."\t";
			$row['sb_SLuggageMoney']=$row['sb_SLuggageMoney']."\t";
			$row['sb_Money']=$row['sb_Money']."\t";
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			$outputRow = array($row['sb_FStation'], $row['sb_FTicketNum'], $row['sb_FTicketMoney'], $row['sb_FLuggageNum'], $row['sb_FLuggageMoney'], 
				$row['sb_SStation'], $row['sb_STicketNum'], $row['sb_STicketMoney'], $row['sb_SLuggageNum'], $row['sb_SLuggageMoney'], $row['sb_BeginDate'], 
				$row['sb_EndDate'], $row['sb_Money'], $row['sb_BalanceDate'], $row['sb_BalanceTime']); 
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
		<title>站间结算查询</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
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
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 站 间 结 算 查 询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		<table width="100%" align="center" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车站1：</span></td>
				<td bgcolor="#FFFFFF">
					<select id="stationselect1" name="stationselect1" size="1">
		            <?php
		            	if($userStationID == "all") {
		            ?>
						<?php if ($StationName1 == "" || $StationName1 == "%") { ?>
							<option value="" selected="selected">请选择车站</option>
						<?php } else { ?>
							<option value="<?php echo $StationName1?>" selected="selected"><?php echo $StationName1?></option>
						<?php } ?>
					<?php 
							$queryString = "SELECT DISTINCT sset_SiteName FROM tms_bd_SiteSet WHERE sset_IsStation=1";
							$result = $class_mysql_default->my_query("$queryString");
					        while($res = mysqli_fetch_array($result)) {
			            		if($res['sset_SiteName'] != $StationName1) {
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
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车站2：</span></td>
				<td bgcolor="#FFFFFF">
					<select id="stationselect2" name="stationselect2" size="1">
						<?php
							if ($StationName2 == "" || $StationName2 == "%"){ 
						?>
								<option value="" selected="selected">请选择车站</option>
						<?php 
							} else { 
						?>
							<option value="<?php echo $StationName2?>" selected="selected"><?php echo $StationName2?></option>
						<?php
						 	}  
							$select="SELECT DISTINCT sset_SiteName FROM tms_bd_SiteSet WHERE sset_IsStation=1 AND sset_SiteID!='$userStationID'";
							$query=$class_mysql_default->my_query("$select");
							while($rows = mysqli_fetch_array($query)) {
								if($rows['sset_SiteName'] != $StationName2) {
						?>
									<option value="<?php echo $rows['sset_SiteName'];?>"><?php echo $rows['sset_SiteName'];?></option>
						<?php 
							 	}
							 }
						?>
					</select>
				</td>
				<td align="left" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 结算日期：</span></td>
				<td bgcolor="#FFFFFF">
					<input type="text" id="checkdate1" size="12" class="Wdate" value="<?php echo $CheckBeginDate;?>" name="checkdate1"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" />&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;
					<input type="text" id="checkdate2" size="12" class="Wdate" value="<?php echo $CheckEndDate;?>" name="checkdate2"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" />
				</td>
				<td bgcolor="#FFFFFF">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" value="查询" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="exceldoc" id="exceldoc" value="导出Excel" />
				</td>
			</tr>
		</table>
		</form>
		
		<form action="tms_v1_accounting_stationBalanceQuery.php" method="post" name="form2">
<div id="tableContainer" class="tableContainer" style="margin-top:-20px;"> 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算车站1</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">客票张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">客票金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">行包票张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">行包金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算车站2</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">客票张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">客票金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">行包票张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">行包金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开始日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结束日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算时间</th>
			</tr>
			</thead>
<tbody class="scrollContent">
			<?php
				if(isset($_POST['resultquery'])) {
					$queryString = "SELECT sb_FStation, sb_FTicketNum,sb_FTicketMoney,sb_FLuggageNum,sb_FLuggageMoney,sb_SStation,sb_STicketNum,
						sb_STicketMoney,sb_SLuggageNum,sb_SLuggageMoney,sb_BeginDate,sb_EndDate,sb_Money,sb_BalanceDate,sb_BalanceTime FROM 
						tms_acct_StationBalance WHERE (sb_FStation LIKE '{$StationName1}') AND (sb_SStation LIKE '{$StationName2}')".$str." ORDER BY sb_BalanceDate ASC";
					$result = $class_mysql_default->my_query("$queryString");
					while ($row = mysqli_fetch_array($result)) {
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row['sb_FStation'];?></td>
				<td nowrap="nowrap"><?php echo $row['sb_FTicketNum'];?></td>
				<td nowrap="nowrap"><?php echo $row['sb_FTicketMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['sb_FLuggageNum'];?></td>
				<td nowrap="nowrap"><?php echo $row['sb_FLuggageMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['sb_SStation'];?></td>
				<td nowrap="nowrap"><?php echo $row['sb_STicketNum'];?></td>
				<td nowrap="nowrap"><?php echo $row['sb_STicketMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['sb_SLuggageNum'];?></td>
				<td nowrap="nowrap"><?php echo $row['sb_SLuggageMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['sb_BeginDate'];?></td>
				<td nowrap="nowrap"><?php echo $row['sb_EndDate'];?></td>
				<td nowrap="nowrap"><?php echo $row['sb_Money'];?></td>
				<td nowrap="nowrap"><?php echo $row['sb_BalanceDate'];?></td>
				<td nowrap="nowrap"><?php echo $row['sb_BalanceTime'];?></td>
			</tr>
			<?php
					}
				}
			?>
			</tbody>
		</table>
		</div>
		</form>
	</body>
</html>

