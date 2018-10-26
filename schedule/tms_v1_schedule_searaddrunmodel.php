<?php
/*
 * 加班票版信息查询页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
require_once("../ui/inc/auth.php");
$op=$_GET['op'];
if($op=='sear'){
	$NoOfRunsID=$_GET['clnumber'];
	$curdate=date('Y-m-d');
	$startdate=$curdate;
	$enddate=$curdate;
	$queryString = "SELECT li_LineName,tml_NoOfRunsID,tml_LineID,tml_NoOfRunsdate,tml_NoOfRunstime,tml_BeginstationID,
						tml_Beginstation,tml_EndstationID,tml_Endstation,tml_RunHours,tml_CheckTicketWindow,tml_Loads,tml_SeatStatus,
						tml_TotalSeats,tml_LeaveSeats,tml_HalfSeats,tml_LeaveHalfSeats,tml_ReserveSeats,tml_StopRun,tml_Allticket,
						tml_AllowSell,tml_Orderno,tml_StationID,tml_Station,tml_Created,tml_Createdby,tml_Updated,tml_Updatedby,
						tml_BusModelID,tml_BusModel,tml_BusID,tml_BusCard,tml_StationDeal,tml_RunRegion,tml_DealCategory,
						tml_DealStyle,tml_BusUnit FROM tms_bd_TicketMode LEFT OUTER JOIN tms_bd_LineInfo ON li_LineID=tml_LineID 
						WHERE tml_NoOfRunsID='{$NoOfRunsID}' and tml_NoOfRunsdate >= '$curdate' and tml_NoOfRunsdate <= '$curdate'";
	$result = $class_mysql_default->my_query("$queryString");
}
if(isset($_POST['NoOfRunsID'])){
	$NoOfRunsID=$_POST['NoOfRunsID'];
	$startdate=$_POST['startdate'];
	$enddate=$_POST['enddate'];
	if($startdate == "" && $enddate == ""){
 			$strDate = '';
 	}
	if ($startdate != "" && $enddate == ""){ //发车日期处理
 		$strDate="AND tml_NoOfRunsdate >='{$startdate}'";
 	}
 	if ($startdate == "" && $enddate != ""){
 		$strDate="AND tml_NoOfRunsdate <='{$enddate}'";
 	}
 	if ($startdate != "" && $enddate != ""){
 		$strDate="AND tml_NoOfRunsdate >='{$startdate}' AND tml_NoOfRunsdate <='{$enddate}'";
 	}
	$queryString = "SELECT li_LineName,tml_NoOfRunsID,tml_LineID,tml_NoOfRunsdate,tml_NoOfRunstime,tml_BeginstationID,
						tml_Beginstation,tml_EndstationID,tml_Endstation,tml_RunHours,tml_CheckTicketWindow,tml_Loads,tml_SeatStatus,
						tml_TotalSeats,tml_LeaveSeats,tml_HalfSeats,tml_LeaveHalfSeats,tml_ReserveSeats,tml_StopRun,tml_Allticket,
						tml_AllowSell,tml_Orderno,tml_StationID,tml_Station,tml_Created,tml_Createdby,tml_Updated,tml_Updatedby,
						tml_BusModelID,tml_BusModel,tml_BusID,tml_BusCard,tml_StationDeal,tml_RunRegion,tml_DealCategory,
						tml_DealStyle,tml_BusUnit FROM tms_bd_TicketMode LEFT OUTER JOIN tms_bd_LineInfo ON li_LineID=tml_LineID 
						WHERE tml_NoOfRunsID='{$NoOfRunsID}'".$strDate;
	$result = $class_mysql_default->my_query("$queryString");
}		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>加班票版查询</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>		
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script language="javascript">
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
			$("#close").click(function(){
				window.close();
			});
		});		
	//	document.oncontextmenu = function(ev){return false;};
		</script>
	</head>
	<body style="overflow-x:hidden;">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 票版信息查询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		<table width="100%" align="center"  border="1" cellpadding="3" cellspacing="1">
			<tr bgcolor="#FFFFFF">
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />票版日期：</span></td>
				<td>
					<input type="text" id="startdate" size="12"  name="startdate"  class="Wdate" value="<?php echo $startdate;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>&nbsp;&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;
					<input type="text" id="enddate" size="12" name="enddate" class="Wdate" value="<?php echo $enddate;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
				</td>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：&nbsp;&nbsp;&nbsp;</span></td>
				<td>
					<input type="hidden" name="NoOfRunsID" id="NoOfRunsID" value="<?php echo $NoOfRunsID;?> "/>
					<input type="text" name="NoOfRunsID1" id="NoOfRunsID1" disabled="disabled" value="<?php echo $NoOfRunsID;?> "/>
				</td>
				<td>
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" id="resultquery" value="查询" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="close" id="close" value="关闭" />
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
			/*	if(isset($_POST['resultquery'])) {
			 		$station=$_POST['stationselect'];
			 		$startdate=$_POST['startdate1'];
			 		$enddate=$_POST['enddate1'];
					$queryString = "SELECT li_LineName,tml_NoOfRunsID,tml_LineID,tml_NoOfRunsdate,tml_NoOfRunstime,tml_BeginstationID,
						tml_Beginstation,tml_EndstationID,tml_Endstation,tml_RunHours,tml_CheckTicketWindow,tml_Loads,tml_SeatStatus,
						tml_TotalSeats,tml_LeaveSeats,tml_HalfSeats,tml_LeaveHalfSeats,tml_ReserveSeats,tml_StopRun,tml_Allticket,
						tml_AllowSell,tml_Orderno,tml_StationID,tml_Station,tml_Created,tml_Createdby,tml_Updated,tml_Updatedby,
						tml_BusModelID,tml_BusModel,tml_BusID,tml_BusCard,tml_StationDeal,tml_RunRegion,tml_DealCategory,
						tml_DealStyle,tml_BusUnit FROM tms_bd_TicketMode LEFT OUTER JOIN tms_bd_LineInfo ON li_LineID=tml_LineID 
						WHERE tml_Station like '{$station}%' 
						and tml_NoOfRunsdate >= '$startdate'
					    and tml_NoOfRunsdate <= '$enddate'";
					$result = $class_mysql_default->my_query("$queryString");*/
					while ($row1 = mysqli_fetch_array($result)) {
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
			//	}
		?>
		</tbody>
		</table>
		</div>
		</form>
	</body>
</html>