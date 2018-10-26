<?
//班次查询界面

//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

//if($userGroupID == "A")	require_once("../ui/user/topnoleft.inc.php");	//for seller
if(isset($_POST['schStation']))
{
	$schStation = $_POST['stationselect'];
	$LineName =$_POST['LineName'];
	$schDate = $_POST['schDateIn'];
	$BusUnit = $_POST['BusUnit'];
	$BeginTime = $_POST['BeginTime'];
	$EndTime = $_POST['EndTime'];
	$noofrunStatus = $_POST['noofrunStatus'];
}
if($schStation == '全部车站'){ //admin登录时查询的是最后一次报班
	$schStation = '郴州总站';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>班次查询</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<link href="../css/tms.css" rel="stylesheet" type="text/css" />
	<link href="../js/ui/jquery-ui.css" rel="stylesheet" type="text/css" />
	<link href="../js/jQuery-Timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css" />
 	<script type="text/javascript" src="../js/jquery-1.8.2.js"></script>
	<script type="text/javascript" src="../js/ui/jquery-ui.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="../js/jQuery-Timepicker/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="../js/jQuery-Timepicker/jquery-ui-sliderAccess.js"></script>
	<script type="text/javascript" src="../js/jQuery-Timepicker/i18n/jquery-ui-timepicker-zh-CN.js"></script>
	<script type="text/javascript" src="../basedata/tms_v1_rightclick.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#BeginTime').timepicker();
		$('#EndTime').timepicker();
		$("#table1").tablesorter();
		$("#table1 tr").mouseover(function(){$(this).css("background-color","#f1e6c2");});
		$("#table1 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
		$("#table1 tr").click(function(){
			 	var menu=document.getElementById("menu");   
			    menu.style.display="none";  
			$("#table1 tr:not(this)").css("background-color","#CCCCCC");
			$("#table1 tr:not(this)").mouseover(function(){$(this).css("background-color","#f1e6c2");});
			$("#table1 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$(this).css("background-color","#FFCC00");
			$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
			$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
			$("#linename1").val($(this).children().eq(1).text());
			$("#allticket").val($(this).children().eq(15).text());
			$("#noofrun1").val($(this).children().eq(24).text());
			$("#departuretime").val($(this).children().eq(5).text());
			$("#checkwindow").val($(this).children().eq(17).text());
			$("#busnumber1").val($(this).children().eq(8).text());
			$("#state").val($(this).children().eq(11).text());
			$("#isallow").val($(this).children().eq(25).text());
			$("#schStation").val($(this).children().eq(3).text());
		});
		$("#resultquery").click(function(){
			document.getElementById("noofrunStatus").value = document.getElementById("statusselect").value;
			document.form1.submit();
		});
	});
	$(document).ready(function(){
		$("#LineName").keyup(function(){
			$("#LineNameselect").empty();
			document.getElementById("LineNameselect").style.display=""; 
			var LineName = $("#LineName").val();
			var station = $("#stationselect").val();
		//	alert(station);
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
	function sellticket(){
		var noofrun=document.getElementById("noofrun1").value;
		var noofrundate=document.getElementById("noofrundate").value;
		var allticket=document.getElementById("allticket").value;
		var schStation=document.getElementById("schStation").value;
	//	alert(schStation);
		if(noofrun==''){
			alert('请选择班次！');
			return false;
		}
		location.assign('tms_v1_service_searsellticket.php?nrID='+noofrun+'&nrDate='+noofrundate+'&allt='+allticket+'&schS='+schStation+'&op=search');
	}
	</script>
</head>
<body>
<div id="menu" style="display: none">   
	<ul>    
        <li><a href="#" onclick="sellticket()">班次售票情况</a></li>   
    </ul>   
</div>   
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 调度站：</span></td>
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
	<!-- <td nowrap="nowrap"><input id="isrefresh" name="isrefresh" type="checkbox" <?=$checkboxStatus?> /> 自动刷新</td> -->
	</tr>
	<tr bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车日期：</span></td>
		<td nowrap="nowrap"><input name="schDateIn" id="schDateIn" class="Wdate" value="<?php ($schDate == "")? print date('Y-m-d') : print $schDate;?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
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
		<td colspan="6" align="left" bgcolor="#FFFFFF">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="resultquery" id="resultquery" value="查询班次" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="searsellticket" id="searsellticket" value="班次售票情况"  onclick="sellticket()"/>&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="signticket" id="signticket" value="签票"  onclick="location.assign('tms_v1_sell_sign.php')"/>&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="alterticket" id="alterticket" value="改签"  onclick="location.assign('tms_v1_sell_alter.php')"/>&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="reserveticket" id="reserveticket" value="留票"  onclick="location.assign('tms_v1_sell_sellreserve.php')"/>&nbsp;&nbsp;
		</td>
	</tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
	<tr>
		<th nowrap="nowrap" align="center" bgcolor="#006699">经营单位</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">线路名称</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">终点站</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">本站</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">车次</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">运行小时数</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">报班时间</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">座位数</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">已售</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">状态</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">售票车型</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">报到车型</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">报到车座</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">通票</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">加班</th>
<!-- h
		<td nowrap="nowrap" align="center" bgcolor="#006699">直达</td>
-->
		<th nowrap="nowrap" align="center" bgcolor="#006699">检票口</th>
<!-- 
		<td nowrap="nowrap" align="center" bgcolor="#006699">上车位</td>
 -->
		<th nowrap="nowrap" align="center" bgcolor="#006699">正驾驶</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">副驾驶</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">始发</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">起点站</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">调度站</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">途经站</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699" style="display: none">允许售票</th>
<!-- 		
		<td nowrap="nowrap" align="center" bgcolor="#006699">操作</td>
-->
	</tr>
	</thead>
<tbody class="scrollContent"> 
<?	
    $strRun="";
    $strRuned="";
    $strChecked="";
    if($noofrunStatus=='1'){
		$strStatus="";
	}
	if($noofrunStatus=='2'){
	//	$strStatus=" AND tml_AllowSell='1' AND tml_StopRun='0'";
		$strStatus=" AND tml_AllowSell='1'";
		$strRun=" AND rt_Register!='已发车'";
	}
	if($noofrunStatus=='3'){
	//	$strStatus=" AND tml_AllowSell='0' AND tml_StopRun='0'";
		$strStatus=" AND tml_AllowSell='0'";
	//	$strRuned=" AND rt_Register!='已发车'";
	}
	if($noofrunStatus=='4'){
	//	$strStatus=" AND tml_StopRun='1'";
		$strRuned=" AND rt_Register='已发车'";
	}
	if($noofrunStatus=='5'){
	//	$strStatus=" AND tml_StopRun='2'";
		$strChecked=" AND ct_Flag='1'";
	}
	if($noofrunStatus=='6'){
		$strStatus=" AND tml_StopRun='3'";
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
/*	$strsqlselet = "SELECT tml_NoOfRunsID, tml_LineID,tml_BusModel,tml_NoOfRunsdate, tml_NoOfRunstime, rt_ReportDateTime,tml_Allticket,nri_LineName,nri_OperateCode,nri_AddNoRuns,nri_RunHours, 
		rt_Register, tml_StopRun, tml_Beginstation, tml_Endstation, tml_TotalSeats, tml_LeaveSeats, tml_ReserveSeats,tml_AllowSell, tml_BusUnit,rt_BusModel, rt_BusCard,tml_RunHours, rt_ReportUser,
		rt_SeatNum, tml_CheckTicketWindow, rt_CheckTicketWindow,rt_Driver,rt_Driver1,bi_SeatS,bi_BusUnit,GROUP_CONCAT(DISTINCT pd_ReachStation ORDER BY nds_ID ASC) AS SiteName 
		FROM tms_bd_TicketMode LEFT OUTER JOIN tms_sch_Report ON tml_NoOfRunsID = rt_NoOfRunsID AND rt_ReportDateTime=(SELECT max(rt_ReportDateTime) FROM tms_sch_Report WHERE 
		rt_NoOfRunsID=tml_NoOfRunsID AND rt_NoOfRunsdate=tml_NoOfRunsdate) AND tml_NoOfRunsdate = rt_NoOfRunsdate LEFT OUTER JOIN 
		tms_bd_BusInfo ON rt_BusCard=bi_BusNumber LEFT OUTER JOIN tms_bd_NoRunsDockSite ON tml_NoOfRunsID=nds_NoOfRunsID LEFT OUTER JOIN tms_bd_PriceDetail ON tml_NoOfRunsID=pd_NoOfRunsID 
		AND tml_NoOfRunsdate=pd_NoOfRunsdate LEFT OUTER JOIN tms_bd_NoRunsInfo ON tml_NoOfRunsID=nri_NoOfRunsID WHERE tml_Beginstation LIKE '{$schStation}%' AND tml_NoOfRunsdate = '$schDate' 
		AND tml_BusUnit LIKE '{$BusUnit}%' AND nri_LineName LIKE '{$LineName}%' AND nds_SiteID=pd_ReachStationID".$strdate.$strStatus." GROUP BY pd_NoOfRunsID,pd_NoOfRunsdate 
		ORDER BY STR_TO_DATE(tml_NoOfRunstime,'%H:%i') ASC"; */
/*	$strsqlselet = "SELECT tml_NoOfRunsID, tml_LineID,tml_BusModel,tml_NoOfRunsdate, tml_NoOfRunstime, rt_ReportDateTime,tml_Allticket,nri_LineName,nri_OperateCode,nri_AddNoRuns,nri_RunHours, 
		rt_Register, tml_StopRun, tml_Beginstation, tml_Endstation, tml_TotalSeats, tml_LeaveSeats, tml_ReserveSeats,tml_AllowSell, tml_BusUnit,rt_BusModel, rt_BusCard,tml_RunHours, rt_ReportUser,
		rt_SeatNum, tml_CheckTicketWindow, rt_CheckTicketWindow,rt_Driver,rt_Driver1,bi_SeatS,bi_BusUnit 
		FROM tms_bd_TicketMode LEFT OUTER JOIN tms_sch_Report ON tml_NoOfRunsID = rt_NoOfRunsID AND rt_ReportDateTime=(SELECT max(rt_ReportDateTime) FROM tms_sch_Report WHERE 
		rt_NoOfRunsID=tml_NoOfRunsID AND rt_NoOfRunsdate=tml_NoOfRunsdate) AND tml_NoOfRunsdate = rt_NoOfRunsdate LEFT OUTER JOIN 
		tms_bd_BusInfo ON rt_BusCard=bi_BusNumber LEFT OUTER JOIN tms_bd_NoRunsDockSite ON tml_NoOfRunsID=nds_NoOfRunsID LEFT OUTER JOIN tms_bd_PriceDetail ON tml_NoOfRunsID=pd_NoOfRunsID 
		AND tml_NoOfRunsdate=pd_NoOfRunsdate LEFT OUTER JOIN tms_bd_NoRunsInfo ON tml_NoOfRunsID=nri_NoOfRunsID WHERE tml_Beginstation LIKE '{$schStation}%' AND tml_NoOfRunsdate = '$schDate' 
		AND ((tml_BusUnit LIKE '{$BusUnit}%' AND tml_NoOfRunsID NOT IN(SELECT rt_NoOfRunsID FROM tms_sch_Report LEFT OUTER JOIN tms_bd_BusInfo ON rt_BusCard=bi_BusNumber WHERE 
		rt_NoOfRunsID=tml_NoOfRunsID AND rt_NoOfRunsdate=tml_NoOfRunsdate AND bi_BusUnit NOT LIKE '{$BusUnit}%' AND rt_ReportDateTime=(SELECT max(rt_ReportDateTime) FROM tms_sch_Report 
		WHERE rt_NoOfRunsID=tml_NoOfRunsID AND rt_NoOfRunsdate=tml_NoOfRunsdate))) OR bi_BusUnit LIKE '{$BusUnit}%') AND nri_LineName LIKE '{$LineName}%'  
		".$strdate.$strStatus." GROUP BY pd_NoOfRunsID,pd_NoOfRunsdate 
		ORDER BY STR_TO_DATE(tml_NoOfRunstime,'%H:%i') ASC"; */
/*	$strsqlselet = "SELECT tml_NoOfRunsID, tml_LineID,tml_BusModel,tml_NoOfRunsdate, tml_NoOfRunstime, rt_ReportDateTime,tml_Allticket,nri_LineName,nri_OperateCode,nri_AddNoRuns,nri_RunHours, 
		rt_Register, tml_StopRun, tml_Beginstation, tml_Endstation, tml_TotalSeats, tml_LeaveSeats, tml_ReserveSeats,tml_AllowSell, tml_BusUnit,rt_BusModel, rt_BusCard,tml_RunHours, rt_ReportUser,
		rt_SeatNum, tml_CheckTicketWindow, rt_CheckTicketWindow,rt_Driver,rt_Driver1,bi_SeatS,bi_BusUnit,pd_BeginStationTime 
		FROM tms_bd_TicketMode LEFT OUTER JOIN tms_sch_Report ON tml_NoOfRunsID = rt_NoOfRunsID AND rt_ReportDateTime=(SELECT max(rt_ReportDateTime) FROM tms_sch_Report WHERE 
		rt_NoOfRunsID=tml_NoOfRunsID AND rt_NoOfRunsdate=tml_NoOfRunsdate) AND tml_NoOfRunsdate = rt_NoOfRunsdate LEFT OUTER JOIN 
		tms_bd_BusInfo ON rt_BusCard=bi_BusNumber LEFT OUTER JOIN tms_bd_NoRunsDockSite ON tml_NoOfRunsID=nds_NoOfRunsID LEFT OUTER JOIN tms_bd_PriceDetail ON tml_NoOfRunsID=pd_NoOfRunsID 
		AND tml_NoOfRunsdate=pd_NoOfRunsdate LEFT OUTER JOIN tms_bd_NoRunsInfo ON tml_NoOfRunsID=nri_NoOfRunsID WHERE pd_FromStation LIKE '{$schStation}%' AND tml_NoOfRunsdate = '$schDate' 
		AND ((tml_BusUnit LIKE '{$BusUnit}%' AND tml_NoOfRunsID NOT IN(SELECT rt_NoOfRunsID FROM tms_sch_Report LEFT OUTER JOIN tms_bd_BusInfo ON rt_BusCard=bi_BusNumber WHERE 
		rt_NoOfRunsID=tml_NoOfRunsID AND rt_NoOfRunsdate=tml_NoOfRunsdate AND bi_BusUnit NOT LIKE '{$BusUnit}%' AND rt_ReportDateTime=(SELECT max(rt_ReportDateTime) FROM tms_sch_Report 
		WHERE rt_NoOfRunsID=tml_NoOfRunsID AND rt_NoOfRunsdate=tml_NoOfRunsdate))) OR bi_BusUnit LIKE '{$BusUnit}%') AND nri_LineName LIKE '{$LineName}%'  
		".$strdate.$strStatus." GROUP BY pd_NoOfRunsID,pd_NoOfRunsdate 
		ORDER BY STR_TO_DATE(tml_NoOfRunstime,'%H:%i') ASC"; */
/*	$strsqlselet = "SELECT tml_NoOfRunsID, tml_LineID,tml_BusModel,tml_NoOfRunsdate, tml_NoOfRunstime, rt_ReportDateTime,tml_Allticket,nri_LineName,nri_OperateCode,nri_AddNoRuns,nri_RunHours, 
		rt_Register, tml_StopRun, tml_Beginstation, tml_Endstation, tml_TotalSeats, tml_LeaveSeats, tml_ReserveSeats,tml_AllowSell, tml_BusUnit,rt_BusModel, rt_BusCard,tml_RunHours, rt_ReportUser,
		rt_SeatNum, tml_CheckTicketWindow, rt_CheckTicketWindow,rt_Driver,rt_Driver1,bi_SeatS,bi_BusUnit,pd_BeginStationTime,pd_FromStation,pd_FromStationID,rt_Register,ct_Flag FROM tms_bd_TicketMode 
		LEFT OUTER JOIN tms_sch_Report ON tml_NoOfRunsID = rt_NoOfRunsID AND rt_ReportDateTime=(SELECT max(rt_ReportDateTime) FROM tms_sch_Report WHERE 
		rt_NoOfRunsID=tml_NoOfRunsID AND rt_NoOfRunsdate=tml_NoOfRunsdate AND rt_AttemperStation LIKE '{$schStation}%') AND tml_NoOfRunsdate = rt_NoOfRunsdate AND rt_AttemperStation LIKE '{$schStation}%'".$strRun.
		"LEFT OUTER JOIN tms_bd_BusInfo ON rt_BusCard=bi_BusNumber 
		LEFT OUTER JOIN tms_bd_PriceDetail ON tml_NoOfRunsID=pd_NoOfRunsID AND tml_NoOfRunsdate=pd_NoOfRunsdate 
		LEFT OUTER JOIN tms_bd_NoRunsInfo ON tml_NoOfRunsID=nri_NoOfRunsID
		LEFT OUTER JOIN tms_chk_CheckTemp ON ct_NoOfRunsID=rt_NoOfRunsID AND ct_NoOfRunsdate=rt_NoOfRunsdate AND ct_BusID=rt_BusID AND ct_ReportDateTime=rt_ReportDateTime
		WHERE pd_FromStation LIKE '{$schStation}%' AND tml_NoOfRunsdate = '$schDate' 
		AND ((tml_BusUnit LIKE '{$BusUnit}%' AND tml_NoOfRunsID NOT IN(SELECT rt_NoOfRunsID FROM tms_sch_Report LEFT OUTER JOIN tms_bd_BusInfo ON rt_BusCard=bi_BusNumber WHERE 
		rt_NoOfRunsID=tml_NoOfRunsID AND rt_NoOfRunsdate=tml_NoOfRunsdate AND bi_BusUnit NOT LIKE '{$BusUnit}%' AND rt_ReportDateTime=(SELECT max(rt_ReportDateTime) FROM tms_sch_Report 
		WHERE rt_NoOfRunsID=tml_NoOfRunsID AND rt_NoOfRunsdate=tml_NoOfRunsdate AND rt_AttemperStation LIKE '{$schStation}%'))) OR bi_BusUnit LIKE '{$BusUnit}%') AND nri_LineName LIKE '{$LineName}%'  
		".$strdate.$strStatus.$strRuned.$strChecked." GROUP BY pd_NoOfRunsID,pd_NoOfRunsdate,pd_FromStation 
		ORDER BY STR_TO_DATE(tml_NoOfRunstime,'%H:%i') ASC"; */
	$strsqlselet = "SELECT tml_NoOfRunsID, tml_LineID,tml_BusModel,tml_NoOfRunsdate, tml_NoOfRunstime, rt_ReportDateTime,tml_Allticket,nri_LineName,nri_OperateCode,nri_AddNoRuns,nri_RunHours, 
		rt_Register, tml_StopRun, tml_Beginstation, tml_Endstation, tml_TotalSeats, tml_LeaveSeats, tml_ReserveSeats,tml_AllowSell, tml_BusUnit,rt_BusModel, rt_BusCard,tml_RunHours, rt_ReportUser,
		rt_SeatNum, tml_CheckTicketWindow, rt_CheckTicketWindow,rt_Driver,rt_Driver1,bi_SeatS,bi_BusUnit,pd_BeginStationTime,pd_FromStation,pd_FromStationID,rt_Register,ct_Flag FROM tms_bd_TicketMode 
		LEFT OUTER JOIN tms_sch_Report ON tml_NoOfRunsID = rt_NoOfRunsID  AND tml_NoOfRunsdate = rt_NoOfRunsdate AND rt_AttemperStation LIKE '{$schStation}%'".$strRun.
		"LEFT OUTER JOIN tms_bd_BusInfo ON rt_BusCard=bi_BusNumber 
		LEFT OUTER JOIN tms_bd_PriceDetail ON tml_NoOfRunsID=pd_NoOfRunsID AND tml_NoOfRunsdate=pd_NoOfRunsdate 
		LEFT OUTER JOIN tms_bd_NoRunsInfo ON tml_NoOfRunsID=nri_NoOfRunsID
		LEFT OUTER JOIN tms_chk_CheckTemp ON ct_NoOfRunsID=rt_NoOfRunsID AND ct_NoOfRunsdate=rt_NoOfRunsdate AND ct_BusID=rt_BusID AND ct_ReportDateTime=rt_ReportDateTime
		WHERE pd_FromStation LIKE '{$schStation}%' AND tml_NoOfRunsdate = '$schDate' 
		AND ((tml_BusUnit LIKE '{$BusUnit}%' AND tml_NoOfRunsID NOT IN(SELECT rt_NoOfRunsID FROM tms_sch_Report LEFT OUTER JOIN tms_bd_BusInfo ON rt_BusCard=bi_BusNumber WHERE 
		rt_NoOfRunsID=tml_NoOfRunsID AND rt_NoOfRunsdate=tml_NoOfRunsdate AND bi_BusUnit NOT LIKE '{$BusUnit}%')) OR bi_BusUnit LIKE '{$BusUnit}%') AND nri_LineName LIKE '{$LineName}%'  
		".$strdate.$strStatus.$strRuned.$strChecked." GROUP BY pd_NoOfRunsID,pd_NoOfRunsdate 
		ORDER BY STR_TO_DATE(tml_NoOfRunstime,'%H:%i') ASC";
	$resultselet = $class_mysql_default ->my_query("$strsqlselet");
	if(!$resultselet) echo ->my_error();
	while($rows = @mysqli_fetch_array($resultselet))	{
	/*	$str="select GROUP_CONCAT(DISTINCT pd_ReachStation ORDER BY nds_ID) AS SiteName from tms_bd_PriceDetail LEFT OUTER JOIN 
			  tms_bd_NoRunsDockSite ON  pd_NoOfRunsID=nds_NoOfRunsID  
			  WHERE pd_ReachStation=nds_SiteName AND pd_NoOfRunsID='{$rows['tml_NoOfRunsID']}' AND pd_NoOfRunsdate='{$rows['tml_NoOfRunsdate']}'
			  group by pd_NoOfRunsID";  */
	/*	$str="select GROUP_CONCAT(DISTINCT pd_ReachStation ORDER BY ndst_ID ASC) AS SiteName from tms_bd_PriceDetail LEFT OUTER JOIN 
			  tms_bd_NoRunsDockSiteTemp ON  pd_NoOfRunsID=ndst_NoOfRunsID AND pd_NoOfRunsdate=ndst_NoOfRunsdate 
			  WHERE pd_ReachStationID=ndst_SiteID AND pd_NoOfRunsID='{$rows['tml_NoOfRunsID']}' AND pd_NoOfRunsdate='{$rows['tml_NoOfRunsdate']}'
			  group by pd_NoOfRunsID"; */
	/*	$str="SELECT GROUP_CONCAT(DISTINCT ndst_SiteName ORDER BY ndst_ID ASC) AS SiteName from tms_bd_NoRunsDockSiteTemp 
			  WHERE ndst_NoOfRunsID='{$rows['tml_NoOfRunsID']}' AND ndst_NoOfRunsdate='{$rows['tml_NoOfRunsdate']}' AND 
			  ndst_ID>=(SELECT ndst_ID FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$rows['tml_NoOfRunsID']}' 
			  AND ndst_NoOfRunsdate='{$rows['tml_NoOfRunsdate']}' AND ndst_SiteID='$userStationID') AND (ndst_SiteID IN (SELECT 
			  pd_FromStationID FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID='{$rows['tml_NoOfRunsID']}' AND
			  pd_NoOfRunsdate='{$rows['tml_NoOfRunsdate']}') OR ndst_SiteID IN (SELECT 
			  pd_ReachStationID FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID='{$rows['tml_NoOfRunsID']}' AND
			  pd_NoOfRunsdate='{$rows['tml_NoOfRunsdate']}'))
			  GROUP BY ndst_NoOfRunsID,ndst_NoOfRunsdate";   */
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
		if($rows['tml_AllowSell']==0 && $rows['tml_StopRun']==0) $curStatus = '暂停';  //蓝色
		if(!$rows['rt_Register']){
			if($rows['tml_AllowSell']==1) $curStatus = '在售';  //绿色
		}else{
			if($rows['tml_AllowSell']==1 && $rows['rt_Register']=='未发车') $curStatus = '在售';  //绿色
		}
	//	if($rows['tml_AllowSell']==1 && $rows['tml_StopRun']==0) $curStatus = '在售';  //绿色
	//	if($rows['tml_StopRun']==1) $curStatus = '发班'; //红色
	
		if($rows['rt_Register']=='已发车'){
			if($rows['tml_Allticket']==1) $curStatus = '在售';  //绿色
			else $curStatus = '发班'; //红色
		}
		if($rows['ct_Flag']=='1'){
			if($rows['tml_Allticket']==1) $curStatus = '在售';  //绿色 
			else $curStatus = '检票'; //黄色
		}
		if($rows['tml_StopRun']==3) $curStatus = '并班'; //褐色
	//	echo $rows['tml_StopRun'];
		if($rows['rt_CheckTicketWindow']) $RealCheckTicketWindow = $rows['rt_CheckTicketWindow']; 
		else $RealCheckTicketWindow = $rows['tml_CheckTicketWindow'];
		$selectprice="SELECT pd_StopStationTime FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID='{$rows['tml_NoOfRunsID']}' AND pd_NoOfRunsdate='{$rows['tml_NoOfRunsdate']}' AND pd_ReachStationID=pd_EndStationID";
		$resultprice = $class_mysql_default ->my_query("$selectprice");
		$rowprice=@mysqli_fetch_array($resultprice);
?>
	<tr align="center" bgcolor="#CCCCCC">
		<td nowrap="nowrap"><?=$RealBusUnit?></td>
		<td nowrap="nowrap"><?=$rows['nri_LineName']?></td>
		<td nowrap="nowrap"><?=$rows['tml_Endstation']?></td>
	<!--  
		<td nowrap="nowrap"><?=$userStationName?></td>
	-->
		<td nowrap="nowrap"><?=$rows['pd_FromStation']?></td>
		<td nowrap="nowrap"><?=$rows['nri_OperateCode']?></td>
	<!--  	
		<td nowrap="nowrap"><?=$rows['tml_NoOfRunstime']?></td>
	-->
		<td nowrap="nowrap"><?=$rows['pd_BeginStationTime']?></td>
		<td nowrap="nowrap">
			<?php 
				$Hours='';
	        	$Minutes=''; 
	        	$RunHours=explode(":", $rows['tml_RunHours']);
	        	if($RunHours[0]) $Hours=$RunHours[0].'小时';
	        	if($RunHours[1]) $Minutes=$RunHours[1].'分钟';    
	        	echo $Hours.$Minutes;
			?>
		</td>
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
		<td nowrap="nowrap"><? if($rows['tml_Allticket']==0){echo '否';} else {echo '是';}?></td>
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
		<td nowrap="nowrap"><? if($userStationName==$rows['tml_Beginstation'] || $userID=='admin') echo '是'; else echo '否';?></td>
		<td nowrap="nowrap"><?=$rows['tml_Beginstation']?></td>
	<!-- 	
		<td nowrap="nowrap"><?=$rows['tml_Beginstation']?></td>
	 -->
		<td nowrap="nowrap"><?=$rows['pd_FromStation']?></td> 
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
	<input type="hidden" id="allticket" name="allticket" value="" />
	<input type="hidden" id="departuretime" name="departuretime" value="" />
	<input type="hidden" id="linename1" name="linename1" value="" />
	<input type="hidden" id="busnumber1" name="busnumber1" value="" />
	<input type="hidden" id="isallow" name="isallow" value="" />
	<input type="hidden" id="state" name="state" value="" />
	<input type="hidden" id="checkwindow" name="checkwindow" value="" />
	<input type="hidden" id="noofrundate" name="noofrundate" value="<?php echo $schDate;?>" />
	<input type="hidden" id="noofrun1" name="noofrun1" value="" />
	<input type="hidden" id="linename" name="linename" value="" />
	<input type="hidden" id="schStation" name="schStation" value="" />
	<input type="hidden" id="schDate" name="schDate" value="<?php echo $schDate?>" />
	<input type="hidden" id="noofrun" name="noofrun" value="" />
	<input type="hidden" id="busID" name="busID" value="" />
	<input type="hidden" id="endStation" name="endStation" value="" />
	<input type="hidden" id="noofrunStatus" name="noofrunStatus" value="" />
	<input type="hidden" id="configFileName" name="configFileName" value="<?php echo $configFileName?>" />
</form>
</body>
</html>
