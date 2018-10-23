<?php
/*
 * 结算汇总表
 * 	
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$CheckBeginDate = "";
$CheckEndDate = "";
$StationName = "";
$ba_BusUnit = "";
$ba_BusNumber = "";
if(isset($_POST['resultquery']) || isset($_POST['exceldoc'])) {
	$ba_BusUnit = $_POST['BusUnit'];
	$ba_BusNumber = $_POST['busCard'];
	//echo h.$ba_BusUnit;
	$CheckBeginDate = $_POST['date1Value'];
	$CheckEndDate = $_POST['date2Value'];
	$CheckBeginDatetime = $_POST['date1Value'] . " 00:00:00";
	$CheckEndDatetime = $_POST['date2Value'] . " 23:59:59";
	$busnum="";
	if($ba_BusNumber == ""){
		$busnum="AND (ba_BusNumber like '$ba_BusNumber%' OR ba_BusNumber IS NULL)";	
	}
	else{
		$busnum="AND (ba_BusNumber like '$ba_BusNumber%')";
	}
	if (($StationName = $_POST['stationselect']) == "")
		$StationName = "%";
	
	if(isset($_POST['exceldoc'])) {
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");
		
		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '车辆结算汇总表', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$CheckBeginDate" . "至" . "$CheckEndDate";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('车辆编号', '车牌号', '车型', '车属单位', '营收金额', '结算金额', '站务费', 
					'劳务费','行包托运费',  '结算车站');
		fputcsv($fp, $head);

		$cnt = 0; 
		$limit = 100000; 
		$outputRow = "";
		$totalIncome = 0;
		$totalPaid = 0;
		$totalServiceFee = 0;
		$totalOtherFee1 = 0;
		$totalOtherFee2 = 0;
		$totalOtherFee3 = 0;
		$totalOtherFee4 = 0;
		$totalOtherFee5 = 0;
		$totalOtherFee6 = 0;
		$totalMoney1 = 0;
		$queryString = "SELECT ba_BusID, ba_BusNumber,ba_BusType,ba_BusUnit,IFNULL(SUM(ba_Income),0) AS ba_Income,
									IFNULL(SUM(ba_Paid),0) AS ba_Paid, IFNULL(SUM(ba_ServiceFee),0) AS ba_ServiceFee, 
									IFNULL(SUM(ba_OtherFee3),0) AS ba_OtherFee3,IFNULL(SUM(ba_Money1),0) AS ba_Money1,ba_InStation
									FROM tms_acct_BusAccount WHERE (ba_DateTime >= '{$CheckBeginDatetime}') AND (ba_DateTime <= '{$CheckEndDatetime}') 
									AND (ba_InStation LIKE '{$StationName}') AND (ba_BusUnit like '$ba_BusUnit%')".$busnum. "GROUP BY ba_BusID, ba_InStation,ba_BusUnit ORDER BY ba_BusID ASC";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysql_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			$outputRow = array($row['ba_BusID'], $row['ba_BusNumber'], $row['ba_BusType'], $row['ba_BusUnit'], $row['ba_Income'], 
				$row['ba_Paid'], $row['ba_ServiceFee'],  $row['ba_OtherFee3'], $row['ba_Money1'],$row['ba_InStation']); 
			fputcsv($fp, $outputRow); 
			$totalIncome += $row['ba_Income'];
			$totalPaid += $row['ba_Paid'];
			$totalServiceFee += $row['ba_ServiceFee'];
			$totalOtherFee1 += $row['ba_OtherFee1'];
			$totalOtherFee2 += $row['ba_OtherFee2'];
			$totalOtherFee3 += $row['ba_OtherFee3'];
			$totalOtherFee4 += $row['ba_OtherFee4'];
			$totalOtherFee5 += $row['ba_OtherFee5'];
			$totalOtherFee6 += $row['ba_OtherFee6'];
			$totalMoney1 += $row['ba_Money1'];
		}
		
		$out = array('合计', '', '', '', $totalIncome, $totalPaid, $totalServiceFee, $totalOtherFee3, $totalMoney1, '');
		fputcsv($fp, $out);
		
		fclose($fp);
		exit();
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>车辆结算统计</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
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
			$("#busCard").keyup(function(){
				$("#BusNumberselect").empty();
				document.getElementById("BusNumberselect").style.display=""; 
				var BusNumber = $("#busCard").val();
				jQuery.get(
					'../basedata/tms_v1_basedata_getbusdata.php',
					{'op': 'getbus', 'BusNumber': BusNumber, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].BusNumber + ">" + objData[i].BusNumber + "</option>").appendTo($("#BusNumberselect"));
						}
						if(BusNumber==''){
							document.getElementById("BusNumberselect").style.display="none";
						}
				});
			});
			document.getElementById("BusNumberselect").onclick = function (event){
				document.getElementById("busCard").value=document.getElementById("BusNumberselect").value;
				document.getElementById("BusNumberselect").style.display="none";
			};
		});
		</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 结 算 统 计</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车站：</span>
				</td>
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
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
				<td nowrap="nowrap">
					<input  type="text" name="busCard" id="busCard"  value="<?php ($ba_BusNumber == "" || $ba_BusNumber == "%")? print "" : print $ba_BusNumber?>"/>
					<br/>
    				<select id="BusNumberselect" name="BusNumberselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF" nowrap="nowrap">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位：</span></td>
					<td nowrap="nowrap"><select name="BusUnit" id="BusUnit" >
						<option value="<?php echo $ba_BusUnit;?>"><?php if($ba_BusUnit=='') echo '请选择车属单位'; else echo $ba_BusUnit; ?></option>
		      				<?php
		      					if($ba_BusUnit!=''){
			      					echo "<option value=''>请选择车属单位</option>";
    								echo"<br>";	
		      					}
    							$select="SELECT bu_UnitName FROM tms_bd_BusUnit";
    							$sel =$class_mysql_default->my_query($select);
								while($results=mysql_fetch_array($sel)){ 
									if($ba_BusUnit!=$results['bu_UnitName']){
    						?>
    					<option value="<?php echo $results['bu_UnitName'];?>"><?php echo $results['bu_UnitName'];?></option>
    						<?php
									} 
								}
    						?>
		     	 	</select>
				</td>
			</tr>	
			<tr>
				<td align="left" bgcolor="#FFFFFF" >
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 日期：</span>
				</td>
				<td>
					<input type="text" id="checkdate1" size="12" class="Wdate" value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>"  name="checkdate1" onclick="WdatePicker({onpicked:function(dp){$dp.$('date1Value').value=dp.cal.getDateStr();}});" />&nbsp;&nbsp;至&nbsp;&nbsp;
					<input type="text" id="checkdate2" size="12" class="Wdate" value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="checkdate2" onclick="WdatePicker({onpicked:function(dp){$dp.$('date2Value').value=dp.cal.getDateStr();}});" />
				</td>
				<td bgcolor="#FFFFFF" colspan="4">
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
  				<td align="center" bgcolor="#FFFFFF"><span style="font-weight:bold;font-size:14;color:black;">车辆结算汇总表</span></td>
  			</tr>
		</table>
		<div id="tableContainer" class="tableContainer" > 
		<table class="main_tableboder" id="table1" > 
		<thead class="fixedHeader"> 
			<tr align="center">
				<th nowrap="nowrap" bgcolor="#006699">车辆编号</th>
				<th nowrap="nowrap" bgcolor="#006699">车牌号</th>
				<th nowrap="nowrap" bgcolor="#006699">车型</th>
				<th nowrap="nowrap" bgcolor="#006699">车属单位</th>
				<th nowrap="nowrap" bgcolor="#006699">营收金额</th>
				<th nowrap="nowrap" bgcolor="#006699">结算金额</th>
				<th nowrap="nowrap" bgcolor="#006699">站务费</th>
				<th nowrap="nowrap" bgcolor="#006699" style="display:none">微机费</th>
				<th nowrap="nowrap" bgcolor="#006699" style="display:none">发班费</th>
				<th nowrap="nowrap" bgcolor="#006699">劳务费</th>
				<th nowrap="nowrap" bgcolor="#006699" style="display:none">费用4</th>
				<th nowrap="nowrap" bgcolor="#006699" style="display:none">费用5</th>
				<th nowrap="nowrap" bgcolor="#006699" style="display:none">费用6</th>
				<th nowrap="nowrap" bgcolor="#006699">行包托运费</th>
				<th nowrap="nowrap" bgcolor="#006699">结算车站</th>
			</tr>
			</thead>
			<tbody class="scrollContent"> 
			<?php
				if(isset($_POST['resultquery'])) {
					$totalIncome = 0;
					$totalPaid = 0;
					$totalServiceFee = 0;
					$totalOtherFee1 = 0;
					$totalOtherFee2 = 0;
					$totalOtherFee3 = 0;
					$totalOtherFee4 = 0;
					$totalOtherFee5 = 0;
					$totalOtherFee6 = 0;
					$queryString = "SELECT ba_BusID, ba_BusNumber,ba_BusType,ba_BusUnit,IFNULL(SUM(ba_Income),0) AS ba_Income,
									IFNULL(SUM(ba_Paid),0) AS ba_Paid, IFNULL(SUM(ba_ServiceFee),0) AS ba_ServiceFee, 
									IFNULL(SUM(ba_OtherFee3),0) AS ba_OtherFee3,IFNULL(SUM(ba_Money1),0) AS ba_Money1,ba_InStation
									FROM tms_acct_BusAccount WHERE (ba_DateTime >= '{$CheckBeginDatetime}') AND (ba_DateTime <= '{$CheckEndDatetime}') 
									AND (ba_InStation LIKE '{$StationName}') AND (ba_BusUnit like '$ba_BusUnit%')".$busnum. "GROUP BY ba_BusID, ba_InStation,ba_BusUnit ORDER BY ba_BusID ASC";
					$result = $class_mysql_default->my_query("$queryString");
					while ($row = mysql_fetch_array($result)) {
						$totalIncome += $row['ba_Income'];
						$totalPaid += $row['ba_Paid'];
						$totalServiceFee += $row['ba_ServiceFee'];
						$totalOtherFee1 += $row['ba_OtherFee1'];
						$totalOtherFee2 += $row['ba_OtherFee2'];
						$totalOtherFee3 += $row['ba_OtherFee3'];
						$totalOtherFee4 += $row['ba_OtherFee4'];
						$totalOtherFee5 += $row['ba_OtherFee5'];
						$totalOtherFee6 += $row['ba_OtherFee6'];
						$totalMoney1 += $row['ba_Money1'];
			?>
			<tr align="center">
				<td nowrap="nowrap"><?php echo $row['ba_BusID'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_BusNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_BusType'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_BusUnit'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_Income'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_Paid'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_ServiceFee'];?></td>
				<td nowrap="nowrap" style="display:none"><?php echo $row['ba_OtherFee1'];?></td>
				<td nowrap="nowrap" style="display:none"><?php echo $row['ba_OtherFee2'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_OtherFee3'];?></td>
				<td nowrap="nowrap" style="display:none"><?php echo $row['ba_OtherFee4'];?></td>
				<td nowrap="nowrap" style="display:none"><?php echo $row['ba_OtherFee5'];?></td>
				<td nowrap="nowrap" style="display:none"><?php echo $row['ba_OtherFee6'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_Money1'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_InStation'];?></td>
			</tr>
			<?php
					}
			?>
			<tr align="center">
				<td colspan="4" align="center"><?php echo "合计：";?></td>
				<td nowrap="nowrap"><?php echo $totalIncome;?></td>
				<td nowrap="nowrap"><?php echo $totalPaid;?></td>
				<td nowrap="nowrap"><?php echo $totalServiceFee;?></td>
				<td nowrap="nowrap" style="display:none"><?php echo $totalOtherFee1;?></td>
				<td nowrap="nowrap" style="display:none"><?php echo $totalOtherFee2;?></td>
				<td nowrap="nowrap"><?php echo $totalOtherFee3;?></td>
				<td nowrap="nowrap" style="display:none"><?php echo $totalOtherFee4;?></td>
				<td nowrap="nowrap" style="display:none"><?php echo $totalOtherFee5;?></td>
				<td nowrap="nowrap" style="display:none"><?php echo $totalOtherFee6;?></td>
				<td nowrap="nowrap"><?php echo $totalMoney1;?></td>
				<td nowrap="nowrap"></td>
			</tr>
			<?php 
				}
			?>
			</tbody>
		</table>
		</div>
	</body>
</html>
