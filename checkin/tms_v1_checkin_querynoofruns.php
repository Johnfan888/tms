<?
//调度界面

//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$i=0;
if(isset($_POST['stationselect']))
{
	$i=$_POST['num']+1;
	$schStation = $_POST['stationselect'];
	$LineName =$_POST['LineName'];
	$schDate = $_POST['schDateIn'];
	$BusUnit = $_POST['BusUnit'];
	$BeginTime = $_POST['BeginTime'];
	$EndTime = $_POST['EndTime'];
	$noofrunStatus = $_POST['statusselect'];
	$checkWindow=$_POST['checkWindow'];
}else{
	$schStation =$userStationName;
	if($schStation == '全部车站'){ //admin登录时查询的是最后一次报班
	   $schStation = '郴州总站';
	}
	$LineName ='';
	$schDate = date('Y-m-d');
	$BusUnit = '';
	$BeginTime = '';
	$EndTime ='';
	$noofrunStatus = '';
	$checkWindow=$_GET['chw'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>调度日志</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../css/tms.css" rel="stylesheet" type="text/css" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<link href="../js/ui/jquery-ui.css" rel="stylesheet" type="text/css" />
	<link href="../js/jQuery-Timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css" />
 	<script type="text/javascript" src="../js/jquery-1.8.2.js"></script>
 	<script type="text/javascript" src="../basedata/tms_v1_screen1.js"></script>
	<script type="text/javascript" src="../js/ui/jquery-ui.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="../js/jQuery-Timepicker/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="../js/jQuery-Timepicker/jquery-ui-sliderAccess.js"></script>
	<script type="text/javascript" src="../js/jQuery-Timepicker/i18n/jquery-ui-timepicker-zh-CN.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#LineName").keyup(function(){
			$("#LineNameselect").empty();
			document.getElementById("LineNameselect").style.display=""; 
			var LineName = $("#LineName").val();
			var station = $("#stationselect").val();
			var $noofrunsdate=$("#schDateIn").val();
		//	alert(station);
			jQuery.get(
				'../schedule/tms_v1_schedule_dataops.php',
				{'op': 'GETLINE1', 'LineName': LineName,'station':station ,'noofrunsdate' :$noofrunsdate,'time': Math.random()},
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
	$(document).ready(function(){
		$('#BeginTime').timepicker();
		$('#EndTime').timepicker();
		$("#table1 tbody tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
		$("#table1 tbody tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
		$("#table1 tbody tr").click(function(){
			$("#table1 tbody tr:not(this)").css("background-color","#CCCCCC");
			$("#table1 tbody tr:not(this)").mouseover(function(){$(this).css("background-color","#F1E6C2");});
			$("#table1 tbody tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$(this).css("background-color","#FFCC00");
			$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
			$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
		});
	});
	</script>
</head>
<body style="scrolling:auto;">  
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车站：</span></td>
		<td nowrap="nowrap">
			<select id="stationselect" name="stationselect" size="1">
            <?php
            	if($userStationID == "all") {
            ?>
				<?php if ($schStation == "" || $schStation == "%" || $schStation == '郴州总站') { ?>
					<option value="郴州总站" selected="selected">郴州总站</option>
				<?php } else { ?>
					<option value="<?php echo $schStation?>" selected="selected"><?php echo $schStation?></option>
				<?php } ?>
			<?php 
					$queryString = "SELECT DISTINCT sset_SiteName FROM tms_bd_SiteSet WHERE sset_IsStation=1";
					$result = $class_mysql_default->my_query("$queryString");
			        while($res = mysqli_fetch_array($result)) {
	            		if($res['sset_SiteName'] != $schStation) {
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
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路：</span></td>
		<td nowrap="nowrap"><input name="LineName" id="LineName" value="<?php echo $LineName;?>"/>
							<input type="hidden" name="checkWindow" id="checkWindow" value="<?php echo $checkWindow;?>"/>
			<br/>
	    	<select id="LineNameselect" name="LineNameselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
		</td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车属单位：</span></td>
		<td nowrap="nowrap">
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
					 while($rowbusunit = mysqli_fetch_array($resultbusunit)) { 
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
	<tr bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车日期：</span></td>
		<td nowrap="nowrap"><input name="schDateIn" id="schDateIn" class="Wdate" value="<?php  print $schDate;?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车时间：</span></td>
		<td nowrap="nowrap">
			<input type="text" name="BeginTime" id="BeginTime" size="5" value="<?=$BeginTime?>" />
			&nbsp;&nbsp;至&nbsp;&nbsp;<input type="text" name="EndTime" id="EndTime" size="5" value="<?=$EndTime?>" />
		</td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 状态：</span></td>
		<td nowrap="nowrap">
			<select name="statusselect" id="statusselect">
			<?
				if ($noofrunStatus == "1")	echo "<option selected=\"selected\" value=\"1\">全部</option>";
				else						echo "<option  value=\"1\">全部</option>";
				if ($noofrunStatus == "2")	echo "<option selected=\"selected\" value=\"2\">在售</option>";
				else						echo "<option  value=\"2\">在售</option>";
				if ($noofrunStatus == "3")	echo "<option selected=\"selected\" value=\"3\">暂停</option>";
				else						echo "<option  value=\"3\">暂停</option>";
				if ($noofrunStatus == "4")	echo "<option selected=\"selected\" value=\"4\">发班</option>";
				else						echo "<option  value=\"4\">发班</option>";
				if ($noofrunStatus == "5")	echo "<option selected=\"selected\" value=\"5\">检票</option>";
				else						echo "<option  value=\"5\">检票</option>";
				if ($noofrunStatus == "6")	echo "<option selected=\"selected\" value=\"6\">并班</option>";
				else						echo "<option  value=\"6\">并班</option>";
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td  colspan="6" align="center" nowrap="nowrap" bgcolor="#FFFFFF">
			<input type="button" name="resultquery" id="resultquery" value="查询班次" onclick="document.form1.submit()"/>
			<input type="button" name="back" id="back" value="返回" onclick="history.go(<?php echo -($i+1);?>)"/>
		</td>
	</tr>
</table>
<div id="tableContainer" class="tableContainer"  style="width:100%;">
<table class="main_tableboder" id="table1">
<thead class="fixedHeader">
	<tr bgcolor="#006699">
		<th nowrap="nowrap" align="center">经营单位</th>
		<th nowrap="nowrap" align="center">线路名称</th>
		<th nowrap="nowrap" align="center">终点站</th>
		<th nowrap="nowrap" align="center">本站</th>
		<th nowrap="nowrap" align="center">车次</th>
		<th nowrap="nowrap" align="center">发车时间</th>
		<th nowrap="nowrap" align="center">运行小时数</th>
		<th nowrap="nowrap" align="center">报班时间</th>
		<th nowrap="nowrap" align="center">车牌号</th>
		<th nowrap="nowrap" align="center">座位数</th>
		<th nowrap="nowrap" align="center">已售</th>
		<th nowrap="nowrap" align="center">状态</th>
		<th nowrap="nowrap" align="center">售票车型</th>
		<th nowrap="nowrap" align="center">报到车型</th>
		<th nowrap="nowrap" align="center">报到车座</th>
		<th nowrap="nowrap" align="center">通票</th>
		<th nowrap="nowrap" align="center">加班</th>
<!--  
		<th nowrap="nowrap" align="center">直达</th>
-->
		<th nowrap="nowrap" align="center">检票口</th>
<!-- 
		<th nowrap="nowrap" align="center">上车位</th>
 -->
		<th nowrap="nowrap" align="center">正驾驶</th>
		<th nowrap="nowrap" align="center">副驾驶</th>
		<th nowrap="nowrap" align="center">始发</th>
		<th nowrap="nowrap" align="center">起点站</th>
		<th nowrap="nowrap" align="center">调度站</th>
		<th nowrap="nowrap" align="center">途经站</th>
		<th nowrap="nowrap" align="center">班次</th>
		<th nowrap="nowrap" align="center" style="display: none">允许售票</th>
<!-- 		
		<th nowrap="nowrap" align="center">操作</th>
-->
	</tr>
</thead>
<tbody class="scrollContent">
<?	
	$strStatus = "";
	if($noofrunStatus=='1'){ //班次状态的判断,全部
		$strStatus="";
	}
	if($noofrunStatus=='2'){ //在售
		$strStatus=" AND ct_Flag = '0' AND (tml_StopRun,tml_AllowSell) not in  (SELECT tml_StopRun,tml_AllowSell FROM tms_bd_TicketMode where tml_StopRun='0' AND tml_AllowSell = '0') and (tml_StopRun) not in  (SELECT tml_StopRun FROM tms_bd_TicketMode where tml_StopRun='3')";
	}
	if($noofrunStatus=='3'){//暂停
		$strStatus=" AND tml_AllowSell='0' AND tml_StopRun='0' AND ct_Flag = '0'";
	}
	if($noofrunStatus=='4'){//发班
		$strStatus=" AND (ct_Flag ='3' OR ct_Flag ='2')";
	}
	if($noofrunStatus=='5'){//检票
		$strStatus=" AND ct_Flag ='1'";
	}
	if($noofrunStatus=='6'){//并班
		$strStatus=" AND tml_StopRun='3' AND ct_Flag = '0'";
	}
	if($BeginTime=='' && $EndTime==''){
	 $strdate="";
	} 
	if($BeginTime!='' && $EndTime==''){
	 $strdate=" AND STR_TO_DATE( tml_NoOfRunstime, '%H:%i' )>='{$BeginTime}'";
	} 
	if($BeginTime=='' && $EndTime!=''){
	 $strdate=" AND STR_TO_DATE( tml_NoOfRunstime, '%H:%i' )<='{$EndTime}'";
	} 
	if($BeginTime!='' && $EndTime!=''){
	 $strdate=" AND STR_TO_DATE( tml_NoOfRunstime, '%H:%i' )>='{$BeginTime}' AND STR_TO_DATE( tml_NoOfRunstime, '%H:%i' )<='{$EndTime}'";
	} 
/*	$strsqlselet = "SELECT tml_NoOfRunsID, tml_LineID,tml_BusModel,tml_NoOfRunsdate, tml_NoOfRunstime, rt_ReportDateTime,tml_Allticket,nri_LineName,nri_OperateCode,nri_AddNoRuns, 
		rt_Register, tml_StopRun, tml_Beginstation, tml_Endstation, tml_TotalSeats, tml_LeaveSeats, tml_ReserveSeats,tml_AllowSell, tml_BusUnit,rt_BusModel, rt_BusCard, 
		rt_SeatNum, tml_CheckTicketWindow, rt_CheckTicketWindow,rt_Driver,rt_Driver1,bi_SeatS,bi_BusUnit,nri_DepartureTime,GROUP_CONCAT(nds_SiteName ORDER BY nds_ID) AS SiteName 
		FROM tms_bd_TicketMode LEFT OUTER JOIN tms_sch_Report ON tml_NoOfRunsID = rt_NoOfRunsID AND rt_ReportDateTime=(SELECT max(rt_ReportDateTime) FROM tms_sch_Report WHERE 
		rt_NoOfRunsID=tml_NoOfRunsID AND rt_NoOfRunsdate=tml_NoOfRunsdate) AND tml_NoOfRunsdate = rt_NoOfRunsdate LEFT OUTER JOIN 
		tms_bd_BusInfo ON rt_BusCard=bi_BusNumber LEFT OUTER JOIN tms_bd_NoRunsDockSite ON tml_NoOfRunsID=nds_NoOfRunsID  LEFT OUTER JOIN tms_bd_NoRunsInfo ON 
		tml_NoOfRunsID=nri_NoOfRunsID WHERE tml_Beginstation LIKE '{$schStation}%' AND tml_NoOfRunsdate = '$schDate' AND tml_BusUnit LIKE '{$BusUnit}%'   
		AND nri_LineName LIKE '{$LineName}%'".$strdate.$strStatus." GROUP BY nds_NoOfRunsID ORDER BY STR_TO_DATE(tml_NoOfRunstime,'%H:%i') ASC"; */
	$strsqlselet = "SELECT tml_NoOfRunsID, tml_LineID,tml_BusModel,tml_NoOfRunsdate, tml_NoOfRunstime, rt_ReportDateTime,tml_Allticket,nri_LineName,nri_OperateCode,nri_AddNoRuns,nri_RunHours, 
		rt_Register, tml_StopRun, tml_Beginstation, tml_Endstation, tml_TotalSeats, tml_LeaveSeats, tml_ReserveSeats,tml_AllowSell, tml_BusUnit,rt_BusModel, rt_BusCard, ct_Flag,pd_FromStation,rt_AttemperStation,
		rt_SeatNum, tml_CheckTicketWindow, rt_CheckTicketWindow,rt_Driver,rt_Driver1,bi_SeatS,bi_BusUnit,pd_FromStationID 
		FROM tms_bd_TicketMode 
		LEFT OUTER JOIN tms_sch_Report ON tml_NoOfRunsID = rt_NoOfRunsID AND rt_ReportDateTime=(SELECT max(rt_ReportDateTime) FROM tms_sch_Report WHERE 
		rt_NoOfRunsID=tml_NoOfRunsID AND rt_NoOfRunsdate=tml_NoOfRunsdate AND rt_AttemperStation LIKE '{$schStation}%') AND tml_NoOfRunsdate = rt_NoOfRunsdate AND rt_AttemperStation LIKE '{$schStation}%'
		LEFT OUTER JOIN tms_bd_BusInfo ON rt_BusCard=bi_BusNumber 
		LEFT OUTER JOIN tms_bd_NoRunsDockSite ON tml_NoOfRunsID=nds_NoOfRunsID 
		LEFT OUTER JOIN tms_bd_PriceDetail ON tml_NoOfRunsID=pd_NoOfRunsID AND tml_NoOfRunsdate=pd_NoOfRunsdate 
		LEFT OUTER JOIN tms_bd_NoRunsInfo ON tml_NoOfRunsID=nri_NoOfRunsID 
		LEFT OUTER JOIN tms_chk_CheckTemp ON ct_NoOfRunsID=rt_NoOfRunsID AND ct_NoOfRunsdate=rt_NoOfRunsdate AND ct_BusID=rt_BusID AND ct_ReportDateTime=rt_ReportDateTime
		WHERE rt_AttemperStation LIKE '{$schStation}%' AND pd_FromStation LIKE '{$schStation}%' AND tml_NoOfRunsdate like '$schDate%' 
		AND tml_BusUnit LIKE '{$BusUnit}%' AND nri_LineName LIKE '{$LineName}%' AND nds_SiteID=pd_ReachStationID AND (IFNULL(rt_CheckTicketWindow,tml_CheckTicketWindow)='{$checkWindow}')".$strdate.$strStatus." GROUP BY pd_NoOfRunsID,pd_NoOfRunsdate 
		ORDER BY STR_TO_DATE(tml_NoOfRunstime,'%H:%i') ASC ";
	$resultselet = $class_mysql_default->my_query("$strsqlselet");
	if(!$resultselet) echo ->my_error();
	while($rows = @mysqli_fetch_array($resultselet))	{
		//查询停靠点
		$str="SELECT GROUP_CONCAT(DISTINCT ndst_SiteName ORDER BY ndst_ID ASC) AS SiteName from tms_bd_NoRunsDockSiteTemp 
			  WHERE ndst_NoOfRunsID='{$rows['tml_NoOfRunsID']}' AND ndst_NoOfRunsdate='{$rows['tml_NoOfRunsdate']}' AND 
			  ndst_ID>=(SELECT ndst_ID FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$rows['tml_NoOfRunsID']}' 
			  AND ndst_NoOfRunsdate='{$rows['tml_NoOfRunsdate']}' AND ndst_SiteID='{$rows['pd_FromStationID']}') AND (ndst_SiteID IN (SELECT 
			  pd_FromStationID FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID='{$rows['tml_NoOfRunsID']}' AND
			  pd_NoOfRunsdate='{$rows['tml_NoOfRunsdate']}') OR ndst_SiteID IN (SELECT 
			  pd_ReachStationID FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID='{$rows['tml_NoOfRunsID']}' AND
			  pd_NoOfRunsdate='{$rows['tml_NoOfRunsdate']}'))
			  GROUP BY ndst_NoOfRunsID,ndst_NoOfRunsdate";   
		$result1 = $class_mysql_default ->my_query("$str"); 
		if(!$result1) echo ->my_error();
		$rows1=mysqli_fetch_array($result1);
		if (!$rows['bi_BusUnit']) $RealBusUnit = $rows['tml_BusUnit']; 
		else $RealBusUnit = $rows['bi_BusUnit'];
		if($rows['ct_Flag'] == '0'){
			if($rows['ct_Flag'] == '0' && $rows['tml_AllowSell']==0 && $rows['tml_StopRun']==0) $curStatus='暂停';
			elseif($rows['ct_Flag'] == '0' && $rows['tml_StopRun']==3){
				$curStatus='并班';
			}
			else{
			 $curStatus='在售';
			}
		}
		else{
			if($rows['ct_Flag'] == '1') $curStatus='检票'; 
			if($rows['ct_Flag'] == '2' || $rows['ct_Flag'] == '3') $curStatus='发班'; 
		}
		
		if($rows['rt_CheckTicketWindow']) $RealCheckTicketWindow = $rows['rt_CheckTicketWindow']; 
		else $RealCheckTicketWindow = $rows['tml_CheckTicketWindow'];
?>
	<tr align="center" bgcolor="#CCCCCC">
		<td nowrap="nowrap"><?=$RealBusUnit?></td>
		<td nowrap="nowrap"><?=$rows['nri_LineName']?></td>
		<td nowrap="nowrap"><?=$rows['tml_Endstation']?></td>
		<td nowrap="nowrap"><?=$userStationName?></td>
		<td nowrap="nowrap"><?=$rows['nri_OperateCode']?></td>
		<td nowrap="nowrap"><?=$rows['tml_NoOfRunstime']?></td>
		<td nowrap="nowrap"><?=$rows['nri_RunHours']?></td>
		<td nowrap="nowrap"><?=$rows['rt_ReportDateTime']?></td>
		<td nowrap="nowrap"><?=$rows['rt_BusCard']?></td>
		<td nowrap="nowrap"><?=$rows['tml_TotalSeats']?></td>
		<td nowrap="nowrap"><?=$rows['tml_TotalSeats']-$rows['tml_LeaveSeats']?></td>
		<?php 
		if($curStatus == '暂停'){  //蓝色
		?>
		<td nowrap="nowrap"><span style="color:#0000FF"><?=$curStatus?></span></td>
		<?php 
		}
		if($curStatus == '在售'){  //绿色
		?>
		<td nowrap="nowrap"><span style="color:#009900"><?=$curStatus?></span></td>
		<?php 
		}
		if($curStatus == '发班'){  //红色
		?>
		<td nowrap="nowrap"><span style="color:#FF0000"><?=$curStatus?></span></td>
		<?php 
		}
		if($curStatus == '检票'){  //黄色
		?>
		<td nowrap="nowrap"><span style="color:#FFFF00"><?=$curStatus?></span></td>
		<?php 
		}
		if($curStatus == '并班'){  //紫色
		?>
		<td nowrap="nowrap"><span style="color:#6633FF"><?=$curStatus?></span></td>
		<?php 
		}
		?>
		<td nowrap="nowrap"><?=$rows['tml_BusModel']?></td>
		<td nowrap="nowrap"><?=$rows['rt_BusModel']?></td>
		<td nowrap="nowrap"><?=$rows['rt_SeatNum']?></td>
		<td nowrap="nowrap"><? if($rows['tml_Allticket']==0) echo '否'; else echo '是';?></td>
		<td nowrap="nowrap"><? if($rows['nri_AddNoRuns']==0) echo '否'; else echo '是';?></td>
<!--  
		<td nowrap="nowrap"><??></td>
-->
		<td nowrap="nowrap"><?=$RealCheckTicketWindow?></td>
<!-- 		
		<td nowrap="nowrap"><??></td>
-->
		<td nowrap="nowrap"><?=$rows['rt_Driver']?></td>
		<td nowrap="nowrap"><?=$rows['rt_Driver1']?></td>
		<td nowrap="nowrap"><? if($userStationName==$rows['tml_Beginstation']) echo '是'; else echo '否';?></td>
		<td nowrap="nowrap"><?=$rows['tml_Beginstation']?></td>
		<td nowrap="nowrap"><?=$rows['rt_AttemperStation']?></td>
		<td nowrap="nowrap"><?=$rows1['SiteName']?></td>
		<td nowrap="nowrap"><?=$rows['tml_NoOfRunsID']?></td>
 		<td nowrap="nowrap" style="display: none"><?=$rows['tml_AllowSell']?></td>
	</tr>
	<?php
	}
	?>
</tbody>
</table>
</div>
	<input type="hidden" id="num" name="num" value="<?php echo $i;?>" />
</form>
</body>
</html>
