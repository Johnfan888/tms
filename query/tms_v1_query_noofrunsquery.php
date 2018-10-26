<?php
/*
 * 班次查询页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$CheckBeginDate = "";
$CheckEndDate = "";
$StationName = "";
$tml_NoOfRunsID = "";
$tml_LineID = "";
$tml_BusID = "";
$tml_LineName=$_POST['tml_LineName'];
$tml_LineID=$_POST['tml_LineID'];
$DataBeginDate1=date('Y-m-d');
$DataEndDate1=date('Y-m-d');
if($userStationName == "全部车站"){ //用户只能查看起点站属于本站的班次信息
		$str1="";
		}	
		else{
		$str1="AND  li_Station = '$userStationName'";
		}
if(isset($_POST['resultquery']) || isset($_POST['exceldoc'])) {
	$DataBeginDate = $_POST['DataBeginDate'];
	$DataEndDate = $_POST['DataEndDate'];
	$DataBeginDate1 = $_POST['DataBeginDate'];
	$DataEndDate1 = $_POST['DataEndDate'];
	if (($StationName = $_POST['stationselect']) == "")
		$StationName = "%";
	if (($tml_NoOfRunsID = $_POST['tml_NoOfRunsID']) == "")
		$tml_NoOfRunsID = "%";
	if (($tml_LineID = $_POST['tml_LineID']) == "")
		$tml_LineID = "%";		
	if($DataBeginDate == "" && $DataEndDate == ""){
 			$strDate = '';
 			}
 		else{
 			//$DataBeginDate=$DataBeginDate.' 00:00:00';
 			//$DataEndDate=$DataEndDate.' 23:59:59';
			if ($DataBeginDate != "" && $DataEndDate == ""){ //发车日期处理
 			$strDate="AND tml_NoOfRunsdate >='{$DataBeginDate}'";
 			}
 			if ($DataBeginDate == "" && $DataEndDate != ""){
 			$strDate="AND tml_NoOfRunsdate <='{$DataEndDate}'";
 			}
 			if ($DataBeginDate != "" && $DataEndDate != ""){
 			$strDate="AND tml_NoOfRunsdate >='{$DataBeginDate}' AND tml_NoOfRunsdate <='{$DataEndDate}'";
 			}
	//echo $strDate;
}
	if(isset($_POST['exceldoc'])) {
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");
		
		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '班次信息表', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$DataBeginDate1" . "至" . "$DataEndDate1";
		$out = array($qrydate, '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('班次', '线路名', '发车日期', '发车时间', '发车站', '终到站','车型');
		fputcsv($fp, $head);
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = ""; 
		$queryString = "SELECT * 
						FROM tms_bd_TicketMode 
						WHERE 
						tml_Beginstation LIKE '{$StationName}' 
						AND tml_NoOfRunsID LIKE '{$tml_NoOfRunsID}%' 
						AND tml_LineID LIKE '{$tml_LineID}%' 
						AND tml_BusID LIKE '{$tml_BusID}%' $strDate 
						ORDER BY tml_NoOfRunsID ASC";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysqli_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			$sql2="select li_LineName from tms_bd_LineInfo where li_LineID = '{$row['tml_LineID']}'";
				//	echo $sql;
					$result2 = $class_mysql_default->my_query("$sql2");
					$row2 = mysqli_fetch_array($result2);
			$outputRow = array($row['tml_NoOfRunsID'], $row2['li_LineName'], $row['tml_NoOfRunsdate'], $row['tml_NoOfRunstime'], 
							 $row['tml_Beginstation'], $row['tml_Endstation'],$row['tml_BusModel']); 
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
		<title>班次查询</title>
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
		});
		$(document).ready(function(){ //线路名按照终点站匹配
			$("#tml_LineName").keyup(function(){
				if(document.getElementById("tml_LineName").value==""){
					document.getElementById("tml_LineID").value="";
					}
				$("#LineNameselect").empty();
				document.getElementById("LineNameselect").style.display=""; 
				var LineName = $("#tml_LineName").val();
				var station = $("#stationselect1").val();
				jQuery.get(
					'../schedule/tms_v1_schedule_dataops.php',
					{'op': 'GETLINEEND', 'LineName': LineName,'station':station ,'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].LineName + ',' + objData[i].LineID + ">" + objData[i].LineName + "</option>").appendTo($("#LineNameselect"));
							}
						if(LineName==''){
							document.getElementById("LineNameselect").style.display="none";
						}
				});
			});
			document.getElementById("LineNameselect").onclick = function (event){
					var sb=document.getElementById("LineNameselect").value.split(',');
					document.getElementById("tml_LineName").value=sb[0];
					document.getElementById("tml_LineID").value=sb[1];
					document.getElementById("LineNameselect").style.display="none";
				};
		});
		</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 班 次 信 息 查 询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr bgcolor="#FFFFFF">
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车站：</span></td>
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
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发班日期：</span></td>
		   		<td colspan="2" nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="DataBeginDate" id="DataBeginDate" class="Wdate" value="<?php echo $DataBeginDate1;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" />
		    		&nbsp;&nbsp;至&nbsp;&nbsp;<input type="text" name="DataEndDate" id="DataEndDate" class="Wdate" value="<?php echo $DataEndDate1;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
		    	</tr>
		    <tr>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：&nbsp;&nbsp;&nbsp;</span></td>
				<td><input type="text" name="tml_NoOfRunsID" id="tml_NoOfRunsID" value="<?php ($tml_NoOfRunsID == "" || $tml_NoOfRunsID == "%")? print "" : print $tml_NoOfRunsID;?>" /></td>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路名：&nbsp;&nbsp;&nbsp;</span></td>
				<td><input type="text" name="tml_LineName" id="tml_LineName" value="<?php ($tml_LineName == "" || $tml_LineName == "%")? print "" : print $tml_LineName;?>" />
				<br />
	    			<select id="LineNameselect" name="LineNameselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" onchange="showsome(this.value); this.style.display='none';"></select>
					<input type=hidden name="tml_LineID" id="tml_LineID" value="<?php echo $tml_LineID; ?>"/>
				</td>
				<td>
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" id="resultquery" value="查询" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="exceldoc" id="exceldoc" value="导出Excel" />
				</td>
			</tr>
		</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">线路名</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">终到站</th>
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>-->
				<th nowrap="nowrap" align="center" bgcolor="#006699">车型</th>
			</tr>
		</thead>
		<tbody class="scrollContent">
			<?php
				if(isset($_POST['resultquery'])) {
					$queryString = "SELECT * 
									FROM tms_bd_TicketMode 
									WHERE 
									tml_Beginstation LIKE '{$StationName}' 
									AND tml_NoOfRunsID LIKE '{$tml_NoOfRunsID}%' 
									AND tml_LineID LIKE '{$tml_LineID}%' 
									AND tml_BusID LIKE '{$tml_BusID}%' $strDate 
									ORDER BY tml_NoOfRunsID ASC";
					//echo $queryString;
					$result = $class_mysql_default->my_query("$queryString");
					while ($row = mysqli_fetch_array($result)) {
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap" align="center"><?php echo $row['tml_NoOfRunsID'];?></td>
				<?php 
					$sql1="select li_LineName from tms_bd_LineInfo where li_LineID = '{$row['tml_LineID']}'";
				//	echo $sql;
					$result1 = $class_mysql_default->my_query("$sql1");
					$row1 = mysqli_fetch_array($result1);
				?>
				<td nowrap="nowrap" align="center"><?php echo $row1['li_LineName'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['tml_NoOfRunsdate'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['tml_NoOfRunstime'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['tml_Beginstation'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['tml_Endstation'];?></td>
<!--				<td nowrap="nowrap" align="center"><?php echo $row['tml_BusID'];?></td>-->
<!--				<td nowrap="nowrap" align="center"><?php echo $row['tml_BusCard'];?></td>-->
				<td nowrap="nowrap" align="center"><?php echo $row['tml_BusModel'];?></td>
			</tr>
			<?php 
					}
				}
			?>
			<tr>
				<td><input type="hidden" name="stationselect1" id="stationselect1" value="<?php echo $str1;?>" /></td>
			</tr>
		</tbody>
		</table>
		</div>
		</form>
	</body>
</html>
