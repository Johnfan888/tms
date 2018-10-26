<?php
/*
 * 加班票版信息查询页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
require_once("../ui/inc/auth.php");
$FromStation=$_GET['FS'];
$Destination=$_GET['dest'];
$NoOfRunsdate=$_GET['date'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>车辆信息查询</title>
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

		function doubleclick(target,str){  //双击事件			
			var sTable = document.getElementById("table1");
			for(var i=1;i<sTable.rows.length;i++){
				if (sTable.rows[i]==target){
					//alert(target+sTable.rows[i].cells[1].innerText);
					opener.document.getElementById("lc_BusID").value=sTable.rows[i].cells[0].innerText;	 				
					opener.document.getElementById("lc_BusNumber").value=sTable.rows[i].cells[1].innerText;
					opener.document.getElementById("lc_NoOfRunsID").value=sTable.rows[i].cells[7].innerText;
					
					window.close();
				}
			}  
		}	

		</script>
	</head>
	<body style="overflow-x:hidden;">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 车辆信息查询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		
		<div id="tableContainer" class="tableContainer" > 
		<table class="main_tableboder" id="table1" > 
		<thead class="fixedHeader"> 
				<tr>
					<th nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</th>
					<th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>				
					<th nowrap="nowrap" align="center" bgcolor="#006699">报到时间</th>
					<th nowrap="nowrap" align="center" bgcolor="#006699">线路编号</th>
					<th nowrap="nowrap" align="center" bgcolor="#006699">出发站</th>
					<th nowrap="nowrap" align="center" bgcolor="#006699">到达站</th>
					<th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
					<th nowrap="nowrap" align="center" bgcolor="#006699">班次编号</th>					
					<th nowrap="nowrap" align="center" bgcolor="#006699">线路名称</th>					
					<th nowrap="nowrap" align="center" bgcolor="#006699">车属单位</th>
				</tr>
</thead> 
<tbody class="scrollContent">
	<?php 
		$selectbus = "SELECT DISTINCT rt_BusID, rt_BusCard, rt_ReportDateTime, rt_LineID, rt_BeginStation, rt_EndStation,  pd_BeginStationTime, rt_NoOfRunsID, bi_BusUnit, li_LineName
			FROM tms_sch_Report	
			LEFT OUTER JOIN tms_bd_PriceDetail ON pd_NoOfRunsID = rt_NoOfRunsID AND  pd_NoOFRunsdate=rt_NoOfRunsdate 
			LEFT OUTER JOIN tms_bd_BusInfo ON rt_BusCard=bi_BusNumber 
			LEFT OUTER JOIN tms_bd_LineInfo ON rt_LineID=li_LineID
			WHERE rt_NoOfRunsdate='{$NoOfRunsdate}' AND rt_Register='未发车' AND pd_FromStation='{$FromStation}' AND pd_ReachStation='{$Destination}' AND pd_FromStation = '{$userStationName}'
			AND rt_AttemperStationID='{$userStationID}'";
		$querybus=$class_mysql_default ->my_query($selectbus);
		if(!$querybus) echo ->my_error();
		while($rowbus=mysqli_fetch_array($querybus)){
	?>
	<tr align="center" bgcolor="#CCCCCC" ondblclick="doubleclick(this,'RegionCode1')">
					<td><?=$rowbus['rt_BusID']?></td>
					<td><?=$rowbus['rt_BusCard']?></td>
					<td><?=$rowbus['rt_ReportDateTime']?></td>
					<td><?=$rowbus['rt_LineID']?></td>
					<td><?=$FromStation?></td>
					<td><?=$Destination?></td>
					<td><?=$rowbus['pd_BeginStationTime']?></td>
					<td><?=$rowbus['rt_NoOfRunsID']?></td>
					<td><?=$rowbus['li_LineName']?></td>
					<td><?=$rowbus['bi_BusUnit']?></td>					
		</tr>
	<?php 
			} 
		
	?>
</tbody> 
</table>
</div>
</form>
</body>
</html>