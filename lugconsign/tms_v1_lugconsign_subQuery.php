<?php
/*
 * 行包已缴款查询页面
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
	if($CheckBeginDate == "" && $CheckEndDate == ""){
		$strDate1 = '';
	}
	if($CheckBeginDate != "" && $CheckEndDate == ""){
		$strDate1=" AND (DATE_FORMAT(lpm_SubDateTime,'%Y-%m-%d') >= '{$CheckBeginDate}')";
	}
	if ($CheckBeginDate == "" && $CheckEndDate != ""){
 		$strDate1=" AND (DATE_FORMAT(lpm_SubDateTime,'%Y-%m-%d') <= '{$CheckEndDate}')";
 	}
	if ($CheckBeginDate != "" && $CheckEndDate != ""){
 		$strDate1=" AND (DATE_FORMAT(lpm_SubDateTime,'%Y-%m-%d') >= '{$CheckBeginDate}') AND (DATE_FORMAT(lpm_SubDateTime,'%Y-%m-%d') <= '{$CheckEndDate}')";
 	}			
	if(isset($_POST['exceldoc'])) {
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");
		
		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '', '', '', '', '', '行包已缴款信息表', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$CheckBeginDate" . "至" . "$CheckEndDate";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('行包员ID', '行包员', '所缴款日期', '发行包单金额', '发行包单张数', '收行包单金额', '收行包单张数', '实缴款金额',  
					'收款人ID', '收款人', '收款时间',  '备注', '行包员所属车站');
		fputcsv($fp, $head);
		
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = "";
		$queryString = "SELECT * FROM tms_lug_LuggagePayMoney WHERE (lpm_lugconsigntation LIKE '{$StationName}') AND 
					(lpm_DeliveryUserID LIKE '{$sellerID}')".$strDate1."GROUP BY lpm_DeliveryUserID,DATE_FORMAT(lpm_SubDateTime,'%Y-%m-%d') ORDER BY 
					lpm_DeliveryUserID ASC, DATE_FORMAT(lpm_SubDateTime,'%Y-%m-%d') ASC";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysqli_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			$outputRow = array( $row['lpm_DeliveryUserID'], $row['lpm_DeliveryUser'], $row['lpm_DeliveryDate'], $row['lpm_DeliveryMoney'], 
				$row['lpm_DeliveryNumber'], $row['lpm_ExtractionMoney'], $row['lpm_ExtractionNumber'], $row['lpm_LuggageConsMoney'],
				$row['lpm_UserID'], $row['lpm_User'], $row['lpm_SubDateTime'], $row['lpm_Remark'],$row['lpm_lugconsigntation']); 
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
		<title>行包已缴款查询</title>
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
			});
		});
		</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;">行 包 已 缴 款 查 询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr bgcolor="#FFFFFF">
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车站：</span></td>
				<td nowrap="nowrap">
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
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 缴款日期：</span></td>
				<td nowrap="nowrap">
					<input type="text" id="checkdate1" size="12" class="Wdate" value="<?php if(isset($_POST['resultquery'])){echo $_POST['checkdate1'];} else{ echo date('Y-m-d');}?>"  name="checkdate1" onclick="WdatePicker({onpicked:function(dp){$dp.$('date1Value').value=dp.cal.getDateStr();}});" />&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;
					<input type="text" id="checkdate2" size="12" class="Wdate" value="<?php if(isset($_POST['resultquery'])){echo $_POST['checkdate2'];} else{ echo date('Y-m-d');}?>" name="checkdate2" onclick="WdatePicker({onpicked:function(dp){$dp.$('date2Value').value=dp.cal.getDateStr();}});" />
				</td>
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 行包员：</span></td>
				<td nowrap="nowrap">
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
				<td nowrap="nowrap" bgcolor="#FFFFFF">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" value="查询" />
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
		
		<form action="tms_v1_accounting_sellSub.php" method="post" name="form2">
		<div id="tableContainer" class="tableContainer" style="margin-top:-20px;"> 
		<table class="main_tableboder" id="table1" > 
		<thead class="fixedHeader">
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">行包员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">行包员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">所缴款日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发行包单金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发行包单张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">收行包单金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">收行包单张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">实缴款金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">收款人ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">收款人</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">收款时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
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
						$strDate=" AND (DATE_FORMAT(lpm_SubDateTime,'%Y-%m-%d') >= '{$CheckBeginDate}')";
					}
					if ($CheckBeginDate == "" && $CheckEndDate != ""){
 						$strDate=" AND (DATE_FORMAT(lpm_SubDateTime,'%Y-%m-%d') <= '{$CheckEndDate}')";
 					}
					if ($CheckBeginDate != "" && $CheckEndDate != ""){
 						$strDate=" AND (DATE_FORMAT(lpm_SubDateTime,'%Y-%m-%d') >= '{$CheckBeginDate}') AND (DATE_FORMAT(lpm_SubDateTime,'%Y-%m-%d') <= '{$CheckEndDate}')";
 					}
					$queryString = "SELECT * FROM tms_lug_LuggagePayMoney WHERE (lpm_lugconsigntation LIKE '{$StationName}') AND 
						(lpm_DeliveryUserID LIKE '{$sellerID}')".$strDate." GROUP BY lpm_DeliveryUserID,DATE_FORMAT(lpm_SubDateTime,'%Y-%m-%d') ORDER BY 
						lpm_DeliveryUserID ASC, DATE_FORMAT(lpm_SubDateTime,'%Y-%m-%d') ASC";
					//echo "'$queryString'";
					//exit();
					$result = $class_mysql_default->my_query("$queryString");
					if(!$result) echo $class_mysql_default->my_error();
					while ($row = mysqli_fetch_array($result)) {
					//	$SumUpMoney += $row['sp_UpMoney'];
					//	$SumPayMoney += $row['sp_PayMoney'];
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap" align="center"><?php echo $row['lpm_DeliveryUserID'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['lpm_DeliveryUser'];?></td>				
				<td nowrap="nowrap" align="center"><?php echo $row['lpm_DeliveryDate'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['lpm_DeliveryMoney'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['lpm_DeliveryNumber'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['lpm_ExtractionMoney'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['lpm_ExtractionNumber'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['lpm_LuggageConsMoney'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['lpm_UserID'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['lpm_User'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['lpm_SubDateTime'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['lpm_Remark'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['lpm_lugconsigntation'];?></td>
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

