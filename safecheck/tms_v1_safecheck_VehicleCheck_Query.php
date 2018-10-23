<?php
/*
 * 安检查询页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$CheckBeginDate = "";
$CheckEndDate = "";
$StationName = "";
$sc_Result = "";
$sc_BusID = "";
if(isset($_POST['resultquery']) || isset($_POST['exceldoc'])) {
	$CheckBeginDate = $_POST['date1Value'];
	$CheckEndDate = $_POST['date2Value'];
	$StationName = $_POST['stationselect'];
	$sc_Result = $_POST['resultselect'];
	$sc_BusCard = $_POST['BusCard'];
	$LineName = $_POST['LineName'];
	$BusUnit = $_POST['BusUnit'];

    $CheckItem0="";
	$selected0="SELECT ci_CheckItem FROM tms_sf_CheckItem GROUP BY ci_CheckItem";
	$queryed0=$class_mysql_default->my_query($selected0);
	while($rowed0=mysql_fetch_array($queryed0)){
		if($CheckItem0!=$rowed0['ci_CheckItem']){
				$checkitem[]=$rowed0['ci_CheckItem'];
		}
    	$CheckItem0=$rowed0['ci_CheckItem'];
	} 
	    	//echo $checkitem[1];

	
	if(isset($_POST['exceldoc'])) {
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");
		
		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '', '', '安检信息表', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$CheckBeginDate" . "至" . "$CheckEndDate";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('检验日期', '车辆编号', '车牌号', '车型', '检验结果', '安检站', '安检员', $checkitem[0], $checkitem[1], $checkitem[2], 
				$checkitem[3],$checkitem[4], $checkitem[5],$checkitem[6], $checkitem[7],$checkitem[8], $checkitem[9]);
		fputcsv($fp, $head);
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = ""; 
		$queryString = "SELECT * FROM tms_sf_SafetyCheck WHERE sc_CheckDate >= '{$CheckBeginDate}' AND sc_CheckDate <= '{$CheckEndDate}' 
			AND sc_StationName LIKE '{$StationName}%' AND sc_Result LIKE '{$sc_Result}%' AND sc_BusCard LIKE '{$sc_BusCard}%' 
			AND sc_BusCard IN (SELECT bi_BusNumber FROM tms_bd_BusInfo WHERE bi_BusUnit LIKE '{$BusUnit}%' AND bi_ManagementLine LIKE '{$LineName}%')
			ORDER BY sc_CheckDate ASC";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysql_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			$outputRow = array($row['sc_CheckDate'], $row['sc_BusID'], $row['sc_BusCard'], $row['sc_BusType'], $row['sc_Result'], $row['sc_StationName'], 
					$row['sc_UserID'], $row['sc_Item1'], $row['sc_Item2'], $row['sc_Item3'], $row['sc_Item4'], $row['sc_Item5'], 
					$row['sc_Item6'], $row['sc_Item7'], $row['sc_Item8'], $row['sc_Item9'], $row['sc_Item10']); 
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
		<title>安检信息查询</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
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
			
			$("#BusCard").keyup(function(){
				$("#BusNumberselect").empty();
				document.getElementById("BusNumberselect").style.display=""; 
				var BusNumber = $("#BusCard").val();
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
				document.getElementById("BusCard").value=document.getElementById("BusNumberselect").value;
				document.getElementById("BusNumberselect").style.display="none";
			};

			$("#LineName").keyup(function(){
				$("#LineNameselect").empty();
				document.getElementById("LineNameselect").style.display=""; 
				var LineName = $("#LineName").val();
				var station = $("#stationselect").val();
				jQuery.get(
					'../schedule/tms_v1_schedule_dataops.php',
					{'op': 'GETLINE', 'LineName': LineName,'station':station ,'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].LineName + ">" + objData[i].LineName + "</option>").appendTo($("#LineNameselect"));
						}
						if(LineName==''){
							document.getElementById("LineNameselect").style.display="none";
						}
				});
			});
			document.getElementById("LineNameselect").onclick = function (event){
				document.getElementById("LineName").value=document.getElementById("LineNameselect").value;
				document.getElementById("LineNameselect").style.display="none";
			};
		});
		</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span  style="margin-left:8px;"> 安  检  查  询</span></td>
			</tr>
		</table>
		<form action="" method="post" name="form1" onsubmit="">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1" style="margin-top:-20px;">
			<tr>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 安检站：</span></td>
				<td bgcolor="#FFFFFF">
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
				<td bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 经营线路：</span></td>
				<td bgcolor="#FFFFFF" nowrap="nowrap">
					<input name="LineName" id="LineName" value="<?php echo $LineName;?>"/>
					<br/>
					<select id="LineNameselect" name="LineNameselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
				</td>
				<td bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位：</span></td>
				<td bgcolor="#FFFFFF" nowrap="nowrap">
					<select id="BusUnit" name="BusUnit" size="1">
						<?php if ($BusUnit == "") { ?>
							<option value="" selected="selected">请选择车属单位</option>
						<?php } else { ?>
							<option value="<?php echo $BusUnit?>" selected="selected"><?php echo $BusUnit?></option>
						<?php 
							}
							if($BusUnit != ""){
						 ?>
							<option value="" >请选择车属单位</option>
						<?php
							}
							$selectbusunit="SELECT bu_UnitName FROM tms_bd_BusUnit";
							$resultbusunit = $class_mysql_default->my_query("$selectbusunit");
							while($rowbusunit = mysql_fetch_array($resultbusunit)) { 
								if($rowbusunit['bu_UnitName'] != $BusUnit) {
						?>
								<option value="<?php echo $rowbusunit['bu_UnitName'];?>"><?php echo $rowbusunit['bu_UnitName'];?></option>
						<?php 
								}
							}
		            ?>
					</select>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
				<td bgcolor="#FFFFFF">
					<input type="text" name="BusCard" id="BusCard" size="10" value="<?php echo $sc_BusCard?>" />
					<br/>
	    			<select id="BusNumberselect" name="BusNumberselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
	    		</td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 检验日期：</span></td>
				<td bgcolor="#FFFFFF">
					<input type="text" id="checkdate1" size="12" class="Wdate" value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>"  name="checkdate1" onclick="WdatePicker({onpicked:function(dp){$dp.$('date1Value').value=dp.cal.getDateStr();}});" />&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;
					<input type="text" id="checkdate2" size="12" class="Wdate" value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="checkdate2" onclick="WdatePicker({onpicked:function(dp){$dp.$('date2Value').value=dp.cal.getDateStr();}});" />
				</td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 检验结果：</span></td>
				<td bgcolor="#FFFFFF">
					<select id="resultselect" name="resultselect" size="1">
					<?php 
						if($sc_Result == ""){
					?>
						<option value="" selected="selected">请选择检验结果</option>
						<option value="检验合格">检验合格</option>
						<option value="复检合格">复检合格</option>
						<option value="检验不合格">检验不合格</option>
					<?php 
						}
						if($sc_Result == "检验合格"){
					?>
					<option value="">请选择检验结果</option>
						<option value="检验合格"  selected="selected">检验合格</option>
						<option value="复检合格">复检合格</option>
						<option value="检验不合格">检验不合格</option>
					<?php 
						}
						if($sc_Result == "复检合格"){
					?>
						<option value="">请选择检验结果</option>
						<option value="检验合格">检验合格</option>
						<option value="复检合格" selected="selected">复检合格</option>
						<option value="检验不合格">检验不合格</option>
					<?php 
						}
						if($sc_Result == "检验不合格"){
					?>
						<option value="">请选择检验结果</option>
						<option value="检验合格">检验合格</option>
						<option value="复检合格">复检合格</option>
						<option value="检验不合格"  selected="selected">检验不合格</option>
					<?php 
						}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="8" align="center" bgcolor="#FFFFFF">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" id="resultquery" value="查询" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="exceldoc" id="exceldoc" value="导出Excel" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="tomain" id="tomain" value="返回" onclick="location.assign('tms_v1_safecheck_VehicleCheck.php')"/>
				</td>
			</tr>
		</table>
		<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">检验日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车型</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699" >检验结果</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">安检站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">安检员</th>
				<?php 
    				$i=0;
    				$CheckItem="";
					$selected="SELECT ci_CheckItem FROM tms_sf_CheckItem GROUP BY ci_CheckItem";
					$queryed=$class_mysql_default->my_query($selected);
					while($rowed=mysql_fetch_array($queryed)){
						if($CheckItem!=$rowed['ci_CheckItem']){
				?>
   				 <th nowrap="nowrap" align="center" bgcolor="#006699"><?php echo $rowed['ci_CheckItem'];?></th>
    			<?php 
						}
    				$CheckItem=$rowed['ci_CheckItem'];
    				$i=$i+1;
					}
    			?>
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">检验项目一</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">检验项目二</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">检验项目三</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">检验项目四</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">检验项目五</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">检验项目六</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">检验项目七</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">检验项目八</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">检验项目九</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">检验项目十</th>-->
			</tr>
		</thead>
		<tbody class="scrollContent">
			<?php
				if(isset($_POST['resultquery'])) {
					$queryString = "SELECT * FROM tms_sf_SafetyCheck WHERE sc_CheckDate >= '{$CheckBeginDate}' AND sc_CheckDate <= '{$CheckEndDate}' 
						AND sc_StationName LIKE '{$StationName}%' AND sc_Result LIKE '{$sc_Result}%' AND sc_BusCard LIKE '{$sc_BusCard}%' 
						AND sc_BusCard IN (SELECT bi_BusNumber FROM tms_bd_BusInfo WHERE bi_BusUnit LIKE '{$BusUnit}%' AND bi_ManagementLine LIKE '{$LineName}%')
						ORDER BY sc_CheckDate ASC";
					$result = $class_mysql_default->my_query("$queryString");
					while ($row = mysql_fetch_array($result)) {
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row['sc_CheckDate'];?></td>
				<td nowrap="nowrap"><?php echo $row['sc_BusID'];?></td>
				<td nowrap="nowrap"><?php echo $row['sc_BusCard'];?></td>
				<td nowrap="nowrap"><?php echo $row['sc_BusType'];?></td>
				<td nowrap="nowrap"><?php echo $row['sc_Result'];?></td>
				<td nowrap="nowrap"><?php echo $row['sc_StationName'];?></td>
				<td nowrap="nowrap"><?php echo $row['sc_UserID'];?></td>
				<td><?php echo $row['sc_Item1'];?></td>
				<td><?php echo $row['sc_Item2'];?></td>
				<td><?php echo $row['sc_Item3'];?></td>
				<td><?php echo $row['sc_Item4'];?></td>
				<td><?php echo $row['sc_Item5'];?></td>
				<td><?php echo $row['sc_Item6'];?></td>
				<td><?php echo $row['sc_Item7'];?></td>
				<td><?php echo $row['sc_Item8'];?></td>
				<td><?php echo $row['sc_Item9'];?></td>
				<td><?php echo $row['sc_Item10'];?></td>
			</tr>
			<?php
					}
				}
			?>   
		</tbody>
		</table>
		</div>
		<input type="hidden" id="date1Value" value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>" name="date1Value" />
		<input type="hidden" id="date2Value" value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="date2Value" />
		</form>
	</body>
</html>
