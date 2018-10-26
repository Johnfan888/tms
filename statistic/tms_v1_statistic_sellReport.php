<?php
/*
 * 售票汇总表
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
		$out = array('', '', '', '', '', '', '', '售票员售票收入汇总表', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$CheckBeginDate" . "至" . "$CheckEndDate";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('售票员ID', '售票员', '售票金额', '售票张数', '废票金额', '废票张数', '退还金额', '退票张数', '退票手续费', 
					'保险票金额', '保险票张数', '应交票张数', '应缴款金额', '实缴款金额', '欠款金额', '所属车站');
		fputcsv($fp, $head);
		
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = "";
		$totalsellMoney = 0;
		$totalsellNumber = 0;
		$totalerrMoney = 0;
		$totalerrNumber = 0;
		$totalreturnMoney = 0;
		$totalreturnNumber = 0;
		$totalreturnFees = 0;
		$totalinsurMoney = 0;
		$totalinsurNumber = 0;
		$totalupCount = 0;
		$totalupMoney = 0;
		$totalpayMoney = 0;
		$totalremainMoney = 0;
		$totalMoney = 0; 
		$queryString = "SELECT sp_SellUserID AS sellerID, sp_SellUser AS sellerName, 
			IFNULL(SUM(sp_SellMoney),0) AS sellMoney, SUM(sp_SellCount) AS sellNumber, 
			IFNULL(SUM(sp_ErrMoney),0) AS errMoney, SUM(sp_ErrCount) AS errNumber, 
			IFNULL(SUM(sp_ReturnMoney),0) AS returnMoney, SUM(sp_ReturnCount) AS returnNumber, IFNULL(SUM(sp_ReturnRate),0) AS returnFees, 
			IFNULL(SUM(sp_SafetyMoney),0) AS insurMoney, IFNULL(SUM(sp_SafetyCount),0) AS insurNumber, 
			IFNULL(SUM(sp_UpCount),0) AS upCount, IFNULL(SUM(sp_UpMoney),0) AS upMoney, IFNULL(SUM(sp_PayMoney),0) AS payMoney, 
			IFNULL(SUM(sp_RemainMoney),0) AS remainMoney, sp_Station AS sellerStation	FROM tms_acct_SellPay 
			WHERE (sp_SellDate >= '{$CheckBeginDate}') AND (sp_SellDate <= '{$CheckEndDate}') AND (sp_Station LIKE '{$StationName}') 
			GROUP BY sp_SellUserID ORDER BY sp_SellUserID ASC";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysqli_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			$outputRow = array($row['sellerID'], $row['sellerName'], $row['sellMoney'], $row['sellNumber'], $row['errMoney'], 
				$row['errNumber'], $row['returnMoney'], $row['returnNumber'], $row['returnFees'], $row['insurMoney'], $row['insurNumber'], 
				$row['upCount'], $row['upMoney'], $row['payMoney'], $row['remainMoney'], $row['sellerStation']); 
			fputcsv($fp, $outputRow); 
			$totalsellMoney += $row['sellMoney'];
			$totalsellNumber += $row['sellNumber'];
			$totalerrMoney += $row['errMoney'];
			$totalerrNumber += $row['errNumber'];
			$totalreturnMoney += $row['returnMoney'];
			$totalreturnNumber += $row['returnNumber'];
			$totalreturnFees += $row['returnFees'];
			$totalinsurMoney += $row['insurMoney'];
			$totalinsurNumber += $row['insurNumber'];
			$totalupCount += $row['upCount'];
			$totalupMoney += $row['upMoney'];
			$totalpayMoney += $row['payMoney'];
			$totalremainMoney += $row['remainMoney'];
		}
		
		$out = array('合计', '', $totalsellMoney, $totalsellNumber, $totalerrMoney, $totalerrNumber, $totalreturnMoney, $totalreturnNumber, 
				$totalreturnFees, $totalinsurMoney, $totalinsurNumber, $totalupCount, $totalupMoney, $totalpayMoney, $totalremainMoney, '');
		fputcsv($fp, $out);
		//总金额=总实缴票款+总退票手续费+总保险票金额 
		$totalMoney = $totalpayMoney + $totalreturnFees + $totalinsurMoney;
		$sum = "总计:" . "$totalMoney";
		$out = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', $sum);
		fputcsv($fp, $out);
		
		fclose($fp);
		exit();
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>售票员售票统计</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script>
	
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
	
		</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 售 票 统 计</span></td>
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
    			<td align="center" bgcolor="#FFFFFF"><span style="font-weight:bold;font-size:14;color:black;">售票员售票收入汇总表</span></td>
  			</tr>
		</table>
		<div id="tableContainer" class="tableContainer" > 
		<table class="main_tableboder" id="table1" > 
		<thead class="fixedHeader"> 
			<tr align="center">
				<th nowrap="nowrap" bgcolor="#006699">售票员ID</th>
				<th nowrap="nowrap" bgcolor="#006699">售票员</th>
				<th nowrap="nowrap" bgcolor="#006699">售票金额</th>
				<th nowrap="nowrap" bgcolor="#006699">售票张数</th>
				<th nowrap="nowrap" bgcolor="#006699">废票金额</th>
				<th nowrap="nowrap" bgcolor="#006699">废票张数</th>
				<th nowrap="nowrap" bgcolor="#006699">退还金额</th>
				<th nowrap="nowrap" bgcolor="#006699">退票张数</th>
				<th nowrap="nowrap" bgcolor="#006699">退票手续费</th>
				<th nowrap="nowrap" bgcolor="#006699">保险票金额</th>
				<th nowrap="nowrap" bgcolor="#006699">保险票张数</th>
				<th nowrap="nowrap" bgcolor="#006699">应交票张数</th>
				<th nowrap="nowrap" bgcolor="#006699">应缴票款</th>
				<th nowrap="nowrap" bgcolor="#006699">实缴票款</th>
				<th nowrap="nowrap" bgcolor="#006699">欠款金额</th>
				<th nowrap="nowrap" bgcolor="#006699">所属车站</th>
			</tr>
			</thead>
			<tbody class="scrollContent"> 
			<?php
				if(isset($_POST['resultquery'])) {
					$totalsellMoney = 0;
					$totalsellNumber = 0;
					$totalerrMoney = 0;
					$totalerrNumber = 0;
					$totalreturnMoney = 0;
					$totalreturnNumber = 0;
					$totalreturnFees = 0;
					$totalinsurMoney = 0;
					$totalinsurNumber = 0;
					$totalupCount = 0;
					$totalupMoney = 0;
					$totalpayMoney = 0;
					$totalremainMoney = 0;
					$totalMoney = 0;
					$queryString = "SELECT sp_SellUserID AS sellerID, sp_SellUser AS sellerName, 
						IFNULL(SUM(sp_SellMoney),0) AS sellMoney, SUM(sp_SellCount) AS sellNumber, 
						IFNULL(SUM(sp_ErrMoney),0) AS errMoney, SUM(sp_ErrCount) AS errNumber, 
						IFNULL(SUM(sp_ReturnMoney),0) AS returnMoney, SUM(sp_ReturnCount) AS returnNumber, IFNULL(SUM(sp_ReturnRate),0) AS returnFees, 
						IFNULL(SUM(sp_SafetyMoney),0) AS insurMoney, IFNULL(SUM(sp_SafetyCount),0) AS insurNumber, 
						IFNULL(SUM(sp_UpCount),0) AS upCount, IFNULL(SUM(sp_UpMoney),0) AS upMoney, IFNULL(SUM(sp_PayMoney),0) AS payMoney, 
						IFNULL(SUM(sp_RemainMoney),0) AS remainMoney, sp_Station AS sellerStation	FROM tms_acct_SellPay 
						WHERE (sp_SellDate >= '{$CheckBeginDate}') AND (sp_SellDate <= '{$CheckEndDate}') AND (sp_Station LIKE '{$StationName}') 
						GROUP BY sp_SellUserID ORDER BY sp_SellUserID ASC";
					$result = $class_mysql_default->my_query("$queryString");
					while ($row = mysqli_fetch_array($result)) {
						$totalsellMoney += $row['sellMoney'];
						$totalsellNumber += $row['sellNumber'];
						$totalerrMoney += $row['errMoney'];
						$totalerrNumber += $row['errNumber'];
						$totalreturnMoney += $row['returnMoney'];
						$totalreturnNumber += $row['returnNumber'];
						$totalreturnFees += $row['returnFees'];
						$totalinsurMoney += $row['insurMoney'];
						$totalinsurNumber += $row['insurNumber'];
						$totalupCount += $row['upCount'];
						$totalupMoney += $row['upMoney'];
						$totalpayMoney += $row['payMoney'];
						$totalremainMoney += $row['remainMoney'];
			?>
			<tr>
				<td nowrap="nowrap"><?php echo $row['sellerID'];?></td>
				<td nowrap="nowrap"><?php echo $row['sellerName'];?></td>
				<td nowrap="nowrap"><?php echo $row['sellMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['sellNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['errMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['errNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['returnMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['returnNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['returnFees'];?></td>
				<td nowrap="nowrap"><?php echo $row['insurMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['insurNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['upCount'];?></td>
				<td nowrap="nowrap"><?php echo $row['upMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['payMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['remainMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['sellerStation'];?></td>
			</tr>
			<?php
					}
					//总金额=总实缴票款+总退票手续费+总保险票金额 
					$totalMoney = $totalpayMoney + $totalreturnFees + $totalinsurMoney;
			?>
			<tr bgcolor="#FFFFFF">
				<td colspan="2" align="center"><?php echo "合计：";?></td>
				<td nowrap="nowrap"><?php echo $totalsellMoney;?></td>
				<td nowrap="nowrap"><?php echo $totalsellNumber;?></td>
				<td nowrap="nowrap"><?php echo $totalerrMoney;?></td>
				<td nowrap="nowrap"><?php echo $totalerrNumber;?></td>
				<td nowrap="nowrap"><?php echo $totalreturnMoney;?></td>
				<td nowrap="nowrap"><?php echo $totalreturnNumber;?></td>
				<td nowrap="nowrap"><?php echo $totalreturnFees;?></td>
				<td nowrap="nowrap"><?php echo $totalinsurMoney;?></td>
				<td nowrap="nowrap"><?php echo $totalinsurNumber;?></td>
				<td nowrap="nowrap"><?php echo $totalupCount;?></td>
				<td nowrap="nowrap"><?php echo $totalupMoney;?></td>
				<td nowrap="nowrap"><?php echo $totalpayMoney;?></td>
				<td nowrap="nowrap"><?php echo $totalremainMoney;;?></td>
				<td nowrap="nowrap"></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td colspan="2" align="center">总计</td>
				<td colspan="14" align="center"><?php echo $totalMoney;?></td>
			</tr>
			<?php 
				}
			?>
			</tbody>
		</table>
		</div>
	</body>
</html>
