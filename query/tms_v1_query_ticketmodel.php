<?php
/*
 * 票版信息查询页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
require_once("../ui/inc/auth.php");
$station1=$_POST['stationselect'];
$date1=$_POST['date'];
$noofrunsid=$_POST['noofruns'];
$tml_LineName=$_POST['tml_LineName'];
$tml_LineID=$_POST['tml_LineID'];

if($userStationName != "全部车站"){
	$Station=$userStationName;
}else{
	$Station=$_POST['stationselect'];
}
if($userStationName == "全部车站"){ //用户只能查看起点站属于本站的班次信息
		$str1="";
		}	
		else{
		$str1="AND  li_Station = '$userStationName'";
		}
$DataBeginDate1=date('Y-m-d');
$DataEndDate1=date('Y-m-d');	
if(isset($_REQUEST['resultquery']) || isset($_POST['exceldoc'])){
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
}
		if(isset($_POST['exceldoc'])){
		$station=$_POST['stationselect'];
		$startdate=$_POST['startdate1'];
		$enddate=$_POST['enddate1'];
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");

		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '', '', '', '', '', '', '票版信息表', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$DataBeginDate1" . "至" . "$DataEndDate1";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		
		$head = array('线路编号', '线路名称', '班次编号', '班次日期', '发车时间', '始发站', '终点站', '运行时间', '总座位数', '余座位数', '总半票数', '余半票数',  '检票口', '运行状态', '通票班次',
					   '允许售票', '所属车站', '创建时间', '创建人', '循环号', '运营车型', '运营单位', '运行区域');
		fputcsv($fp, $head);
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = ""; 
			$queryString = "SELECT 
					li_LineName,
					tml_NoOfRunsID,
					tml_LineID,
					tml_NoOfRunsdate,
					tml_NoOfRunstime,
					tml_BeginstationID,
					tml_Beginstation,
					tml_EndstationID,
					tml_Endstation,
					tml_RunHours,
					tml_CheckTicketWindow,
					tml_Loads,
					tml_SeatStatus,
					tml_TotalSeats,
					tml_LeaveSeats,
					tml_HalfSeats,
					tml_LeaveHalfSeats,
					tml_ReserveSeats,
					tml_StopRun,
					tml_Allticket,
					tml_AllowSell,
					tml_Orderno,
					tml_StationID,
					tml_Station,
					tml_Created,
					tml_Createdby,
					tml_Updated,
					tml_Updatedby,
					tml_BusModelID,
					tml_BusModel,
					tml_BusID,
					tml_BusCard,
					tml_StationDeal,
					tml_RunRegion,
					tml_DealCategory,
					tml_DealStyle,
					tml_BusUnit 
					FROM tms_bd_TicketMode 
					LEFT OUTER JOIN tms_bd_LineInfo 
					ON li_LineID=tml_LineID 
					WHERE tml_Station like '{$station}%' 
					AND tml_NoOfRunsID LIKE '$noofrunsid%' 
					AND tml_LineID LIKE '$tml_LineID%' ".$strDate;
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysql_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			}
			$Hours='';
		    $Minutes='';
		    $RunHours=explode(":", $row['tml_RunHours']);
		    if($RunHours[0]) $Hours=$RunHours[0].'小时';
		    if($RunHours[1]) $Minutes=$RunHours[1].'分钟';
		    //echo $Hours.$Minutes;
			if($row['tml_StopRun']==0){
				$row['tml_StopRun'] = '正常';
			}
			else{
				$row['tml_StopRun'] ='停运';
			}
			if($row['tml_Allticket']==0){
				$row['tml_Allticket']='否'; 
			}
			else{
				$row['tml_Allticket']='是';
			}
			if($row['tml_AllowSell']==0) {
				$row['tml_AllowSell']='否';
			}
			else{
				$row['tml_AllowSell']='是';
			}
	
			$outputRow = array($row['tml_LineID'], $row['li_LineName'], $row['tml_NoOfRunsID'], $row['tml_NoOfRunsdate'], $row['tml_NoOfRunstime'], 
				$row['tml_Beginstation'], $row['tml_Endstation'], $row['$Hours.$Minutes'], $row['tml_TotalSeats'], $row['tml_LeaveSeats'], $row['tml_HalfSeats'], 
				$row['tml_LeaveHalfSeats'],  $row['tml_CheckTicketWindow'], $row['tml_StopRun'], $row['tml_Allticket'], 
				$row['tml_AllowSell'], $row['tml_Station'], $row['tml_Created'], $row['tml_Createdby'], $row['tml_Orderno'], 
				$row['tml_BusModel'], $row['tml_BusUnit'],  $row['tml_RunRegion']); 
			fputcsv($fp, $outputRow); 
		}
		fclose($fp);
		exit();
	}
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>票版查询</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>		
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script language="javascript">
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
		document.oncontextmenu = function(ev){return false;};

		$(document).ready(function(){
			$("#table1").tablesorter();
			$("#stationselect").focus();
			$("#stationselect").keyup(function(){
				$("#Sit").empty();
				document.getElementById("Sit").style.display="";
				var Site = $("#stationselect").val();
				jQuery.get(
					'../basedata/tms_v1_bsaedata_dataProcess.php',
					{'op': 'Station', 'Site': Site, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].SiteName + ">" + objData[i].SiteName + "</option>").appendTo($("#Sit"));
						}
						if(Site==''){
							document.getElementById("Sit").style.display="none";
						}
					});	
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
					{'op': 'GETLINEEND', 'LineName': LineName,'station':station,'time': Math.random()},
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
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 票  版  信  息  查  询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		<table width="100%" align="center"  border="1" cellpadding="3" cellspacing="1">
			<tr bgcolor="#FFFFFF">
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站：</span></td>
				<td>
				<?php 
			     	if($userStationName == "全部车站"){
		     	?>
				        <input type="text" name="stationselect" id="stationselect" value="<?php echo $Station;?>" />
				        <br />
				    	<select id="Sit" name="Sit"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="form1.stationselect.value=this.value; this.style.display='none';"  >
						</select>
				<?php 
			     	}else{
				?>
						<input type="text" name="stationselect" id="stationselect" value="<?php echo $userStationName;?>" readonly="readonly" />
				<?php 
 			    	}
				?>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />票版日期：</span></td>
		   		<td colspan="2" nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="DataBeginDate" id="DataBeginDate" class="Wdate" value="<?php echo $DataBeginDate1;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" />
		    		&nbsp;&nbsp;至&nbsp;&nbsp;<input type="text" name="DataEndDate" id="DataEndDate" class="Wdate" value="<?php echo $DataEndDate1;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
<!--				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次编号：&nbsp;&nbsp;&nbsp;</span></td>-->
<!--				<td><input type="text" name="noofrunsid" id="noofrunsid" value="<?php echo $noofrunsid1 ?> "/></td>-->
				</tr>
				<tr>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路名：&nbsp;&nbsp;&nbsp;</span></td>
				<td><input type="text" name="tml_LineName" id="tml_LineName" value="<?php echo $tml_LineName;?>" />
				<br />
	    			<select id="LineNameselect" name="LineNameselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" onchange="showsome(this.value); this.style.display='none';"></select>
					<input type=hidden name="tml_LineID" id="tml_LineID" value="<?php echo $tml_LineID; ?>" />
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：</span></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><input type="text" name="noofruns" id="noofruns" value="<?php echo $noofrunsid; ?>"/></td>
				<td>
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" id="resultquery" value="查询" />&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="submit" name="exceldoc" id="exceldoc" value="导出Excel" />
				</td>
			</tr>
		</table>
		<div id="tableContainer" class="tableContainer" > 
		<table class="main_tableboder" id="table1" > 
		<thead class="fixedHeader"> 
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">线路编号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">线路名称</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">班次编号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">始发站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">终点站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">运行时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">总座位数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">余座位数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">总半票数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">余半票数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">座位状态</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">检票口</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">运行状态</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">通票班次</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">允许售票</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">所属车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">创建时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">创建人</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">循环号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">运营车型</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">运营单位</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">运行区域</th>
				
			</tr>
		</thead>
		<tbody class="scrollContent"> 
			<?php
				if(isset($_POST['resultquery'])) {
			 		$station=$_POST['stationselect'];
			 		$startdate=$_POST['startdate1'];
			 		$enddate=$_POST['enddate1'];
			 		$noofrunsid=$_POST['noofruns'];
					$queryString = "SELECT 
					li_LineName,
					tml_NoOfRunsID,
					tml_LineID,
					tml_NoOfRunsdate,
					tml_NoOfRunstime,
					tml_BeginstationID,
					tml_Beginstation,
					tml_EndstationID,
					tml_Endstation,
					tml_RunHours,
					tml_CheckTicketWindow,
					tml_Loads,
					tml_SeatStatus,
					tml_TotalSeats,
					tml_LeaveSeats,
					tml_HalfSeats,
					tml_LeaveHalfSeats,
					tml_ReserveSeats,
					tml_StopRun,
					tml_Allticket,
					tml_AllowSell,
					tml_Orderno,
					tml_StationID,
					tml_Station,
					tml_Created,
					tml_Createdby,
					tml_Updated,
					tml_Updatedby,
					tml_BusModelID,
					tml_BusModel,
					tml_BusID,
					tml_BusCard,
					tml_StationDeal,
					tml_RunRegion,
					tml_DealCategory,
					tml_DealStyle,
					tml_BusUnit 
					FROM tms_bd_TicketMode 
					LEFT OUTER JOIN tms_bd_LineInfo 
					ON li_LineID=tml_LineID 
					WHERE tml_Station like '{$station}%' 
					AND tml_NoOfRunsID LIKE '$noofrunsid%' 
					AND tml_LineID LIKE '$tml_LineID%' ".$strDate;
					//echo $queryString;
					$result = $class_mysql_default->my_query("$queryString");
					while ($row1 = mysql_fetch_array($result)) {
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row1['tml_LineID'];?></td>
				<td nowrap="nowrap"><?php echo $row1['li_LineName'];?></td>
				<td nowrap="nowrap"><?php echo $row1['tml_NoOfRunsID'];?></td>
				<td nowrap="nowrap"><?php echo $row1['tml_NoOfRunsdate'];?></td>
				<td nowrap="nowrap"><?php echo $row1['tml_NoOfRunstime'];?></td>
				<td nowrap="nowrap"><?php echo $row1['tml_Beginstation'];?></td>
				<td nowrap="nowrap"><?php echo $row1['tml_Endstation'];?></td>
				<td nowrap="nowrap">
		        	<?php 
		        		$Hours='';
		        		$Minutes='';
		        		$RunHours=explode(":", $row1['tml_RunHours']);
		        		if($RunHours[0]) $Hours=$RunHours[0].'小时';
		        		if($RunHours[1]) $Minutes=$RunHours[1].'分钟';
		        		echo $Hours.$Minutes;
		        	?>
        		</td>
				<td nowrap="nowrap" align="center"><?php echo $row1['tml_TotalSeats'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['tml_LeaveSeats'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['tml_HalfSeats'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['tml_LeaveHalfSeats'];?></td>
				<td nowrap="nowrap"><?php if($row1['tml_Allticket']==0) echo $row1['tml_SeatStatus'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['tml_CheckTicketWindow'];?></td>
				<td nowrap="nowrap" align="center"><?php if($row1['tml_StopRun']==0) echo '正常'; else echo '停运';?></td>
				<td nowrap="nowrap" align="center"><?php if($row1['tml_Allticket']==0) echo '否'; else echo '是';?></td>
				<td nowrap="nowrap" align="center"><?php if($row1['tml_AllowSell']==0) echo '否'; else echo '是';?></td>
				<td nowrap="nowrap"><?php echo $row1['tml_Station'];?></td>
				<td nowrap="nowrap"><?php echo $row1['tml_Created'];?></td>
				<td nowrap="nowrap"><?php echo $row1['tml_Createdby'];?></td>
				<td nowrap="nowrap"align="center"><?php echo $row1['tml_Orderno'];?></td>
				<td nowrap="nowrap"><?php echo $row1['tml_BusModel'];?></td>
				<td nowrap="nowrap"><?php echo $row1['tml_BusUnit'];?></td>
				<td nowrap="nowrap"><?php echo $row1['tml_RunRegion'];?></td>
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