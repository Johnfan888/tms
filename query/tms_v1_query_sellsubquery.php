<?php
/*
 * 营收查询页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$CheckBeginDate = "";
$CheckEndDate = "";
$StationName = "";
$sellerID = "";
$sellerID=$_POST['sellerselect'];
$sellerID1=$_POST['sellerselect'];
$DataBeginDate1=date('Y-m-d');
$DataEndDate1=date('Y-m-d');
if(isset($_POST['resultquery']) || isset($_POST['exceldoc'])) {
		$DataBeginDate = $_POST['DataBeginDate'];
		$DataEndDate = $_POST['DataEndDate'];
		$DataBeginDate1 = $_POST['DataBeginDate'];
		$DataEndDate1 = $_POST['DataEndDate'];
		if($DataBeginDate == "" && $DataEndDate == ""){
 			$strDate = '';
 			}
 		else{
 			//$DataBeginDate=$DataBeginDate.' 00:00:00';
 			//$DataEndDate=$DataEndDate.' 23:59:59';
			if ($DataBeginDate != "" && $DataEndDate == ""){ //发车日期处理
 			$strDate=" AND sp_Date >='{$DataBeginDate}'";
 			}
 			if ($DataBeginDate == "" && $DataEndDate != ""){
 			$strDate=" AND sp_Date <='{$DataEndDate}'";
 			}
 			if ($DataBeginDate != "" && $DataEndDate != ""){
 			$strDate=" AND sp_Date >='{$DataBeginDate}' AND sp_Date <='{$DataEndDate}'";
 			}
	//echo $strDate;
}
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
		$out = array('', '', '', '', '', '', '', '', '', '', '', '营收信息表', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$DataBeginDate1" . "至" . "$DataEndDate1";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('售票员ID', '售票员', '售票日期', '开始票号', '结束票号', '售票金额', '售票张数', '废票金额', '废票张数', '退还金额', 
					'退票张数', '退票手续费', '保险票金额', '保险票张数', '应交票张数', '应缴金额', '实缴金额', '本次欠款', '收款人ID', 
					'收款人', '收款日期', '备注', '售票员所属车站');
		fputcsv($fp, $head);
		
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = "";
			$queryString = "SELECT * FROM 
							tms_acct_SellPay 
							WHERE 
							sp_Station LIKE '{$StationName}' 
							AND sp_SellUserID LIKE '{$sellerID}' $strDate
							GROUP BY sp_SellUserID, sp_SellDate 
							ORDER BY sp_SellUserID ASC, sp_SellDate ASC";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysql_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			$row['sp_BeginTicket']=$row['sp_BeginTicket']."\t";
			$row['sp_EndTicket']=$row['sp_EndTicket']."\t";
			$outputRow = array($row['sp_SellUserID'], $row['sp_SellUser'], $row['sp_SellDate'], $row['sp_BeginTicket'], $row['sp_EndTicket'], 
				$row['sp_SellMoney'], $row['sp_SellCount'], $row['sp_ErrMoney'], $row['sp_ErrCount'], $row['sp_ReturnMoney'], $row['sp_ReturnCount'], 
				$row['sp_ReturnRate'], $row['sp_SafetyMoney'], $row['sp_SafetyCount'], $row['sp_UpCount'], $row['sp_UpMoney'], $row['sp_PayMoney'], 
				$row['sp_RemainMoney'], $row['sp_UserID'], $row['sp_User'], $row['sp_Date'], $row['sp_Remark'], $row['sp_Station']); 
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
		<title>营收查询</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script>
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
		</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 营 收 查 询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr bgcolor="#FFFFFF">
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车站：</span></td>
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
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 缴款日期：</span></td>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="DataBeginDate" id="DataBeginDate" class="Wdate" value="<?php echo $DataBeginDate1;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" />
		    		&nbsp;&nbsp;至&nbsp;&nbsp;<input type="text" name="DataEndDate" id="DataEndDate" class="Wdate" value="<?php echo $DataEndDate1;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
		    	</tr>
		    	<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 售票员：</span></td>
				<td>
					<select id="sellerselect" name="sellerselect" size="1" style="width:131px;">
						<?php if($sellerID1=="") {?>
						<option value="" selected="selected">请选择售票员</option>
						<?php } else {?>
						<option></option>
						<option value="<?php echo $sellerID1?>" selected="selected"><?php echo $sellerID1?></option>
						<?php } ?>
					</select>
				</td>
				<td colspan="2">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" id="resultquery" value="查询" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="exceldoc" id="exceldoc" value="导出Excel" />
				</td>
			</tr>
		</table>
		</form>
		<form action="tms_v1_accounting_sellSub.php" method="post" name="form2" style="margin-top:-20px;">
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票日期</th>
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
				<th nowrap="nowrap" align="center" bgcolor="#006699">应缴金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">实缴金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">本次欠款</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">收款人ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">收款人</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">收款日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票员所属车站</th>
			</tr>
			</thead>
		<tbody class="scrollContent">
			<?php
				if(isset($_POST['resultquery'])) {
					$queryString = "SELECT * FROM 
					tms_acct_SellPay 
					WHERE 
					sp_Station LIKE '{$StationName}' 
					AND sp_SellUserID LIKE '{$sellerID}' $strDate
					GROUP BY sp_SellUserID, sp_SellDate 
					ORDER BY sp_SellUserID ASC, sp_SellDate ASC";
					//echo $queryString;
					$result = $class_mysql_default->my_query("$queryString");
					while ($row = mysql_fetch_array($result)) {
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row['sp_SellUserID'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_SellUser'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_SellDate'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_BeginTicket'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_EndTicket'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_SellMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_SellCount'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_ErrMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_ErrCount'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_ReturnMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_ReturnCount'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_ReturnRate'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_SafetyMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_SafetyCount'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_UpCount'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_UpMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_PayMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_RemainMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_UserID'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_User'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_Date'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_Remark'];?></td>
				<td nowrap="nowrap"><?php echo $row['sp_Station'];?></td>
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
