<?php
/*
 * 托运提取页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$lc_TicketNumber1=$_POST['lc_TicketNumber1'];
$query="SELECT lc_NoOfRunsID,lc_BusID,lc_BusNumber,lc_Destination,lc_Station,bi_BusUnit FROM tms_lug_LuggageCons LEFT OUTER JOIN tms_bd_BusInfo ON lc_BusNumber=bi_BusNumber WHERE lc_TicketNumber='{$lc_TicketNumber1}'";
$result = $class_mysql_default->my_query("$query");
$row = mysql_fetch_array($result);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>托运货物更改车辆</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>	
		<script type="text/javascript">
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
					$("#lc_BusID").val($(this).children().eq(0).text());
					$("#lc_BusNumber").val($(this).children().eq(1).text());
					$("#lc_Busunit").val($(this).children().eq(2).text());
					$("#lc_NoOfRunsID").val($(this).children().eq(5).text());
				});
				$("#sureModbus").click(function(){
					if(document.getElementById("lc_BusID").value==''){
						alert('请选择车辆！');
						return false;
					}
					if(document.getElementById("lc_BusID").value==document.getElementById("BusID").value){
						alert('更换的车辆与原车辆不能一样!');
						return false;
					}
					jQuery.get(
							'tms_v1_lugconsign_printok.php',
							{'op': 'modbus', 'TicketNumber': $("#lc_TicketNumber").val(),'NoOfRunsID': $("#lc_NoOfRunsID").val(),'BusID': $("#lc_BusID").val(), 
								'BusNumber': $("#lc_BusNumber").val(), 'time': Math.random()},
							 function(data){
								var objData = eval('(' + data + ')');
								if(objData.retVal == "FAIL"){ 
									alert(objData.retString);
								}
								else{
									alert(objData.retString);
								}
						});
				});
			});
		</script>
	</head>
	<body>
		
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">		
			<tr>
				<td colspan="5" bgcolor="#f0f8ff"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 托 运 货 物 更 改 车 辆</td>
			</tr>
		</table>
		<form action="" method="post" name="form1" >
		<table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">		
			<tr>
    			<td colspan="8" bgcolor="#d4d1d1"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 原 车 辆 信 息</td>
  			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆编号：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="BusID" id="BusID" value="<?php echo $row['lc_BusID'];?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="BusNumber" id="BusNumber" value="<?php echo $row['lc_BusNumber'];?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="Busunit" id="Busunit" value="<?php echo $row['bi_BusUnit'];?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="NoOfRunsID" id="NoOfRunsID" value="<?php echo $row['lc_NoOfRunsID'];?>" readonly="readonly" /></td>
			</tr>
			<tr>
    			<td colspan="8" bgcolor="#d4d1d1"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 新 车 辆 信 息</td>
  			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆编号：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_BusID" id="lc_BusID" value="" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_BusNumber" id="lc_BusNumber" value="" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_Busunit" id="lc_Busunit" value="" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_NoOfRunsID" id="lc_NoOfRunsID" value="" readonly="readonly" /></td>
			</tr>
			<tr>
				<td colspan='8' align="center" bgcolor="#FFFFFF">
					<input type="button" name="sureModbus" id="sureModbus" value="确认更换" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" value="取消" onclick="location.assign('tms_v1_lugconsign_query.php?EXDONE=1');" />
				</td>
			</tr>
			
		</table>
		
		<input type="hidden" id="lc_TicketNumber" value="<?php echo $lc_TicketNumber1;?>" name="lc_ExtractionUserID" />
		<input type="hidden" id="lc_ExtractionUserID" value="<?php echo $lc_ExtractionUserID?>" name="lc_ExtractionUserID" />
		<input type="hidden" id="lc_ExtractionUser" value="<?php echo $lc_ExtractionUser?>" name="lc_ExtractionUser" />
		</form>
		<div id="tableContainer" class="tableContainer" > 
		<table class="main_tableboder" id="table1" > 
		<thead class="fixedHeader">
	
				<tr>
					<th nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</th>
					<th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>
					<th nowrap="nowrap" align="center" bgcolor="#006699">车属单位</th>
					<th nowrap="nowrap" align="center" bgcolor="#006699">报到时间</th>
					<th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
					<th nowrap="nowrap" align="center" bgcolor="#006699">班次编号</th>
					<th nowrap="nowrap" align="center" bgcolor="#006699">线路编号</th>
				</tr>
		</thead>
		<tbody class="scrollContent"> 
				<?php 
					$CurDate=date('Y-m-d');
					$selectbus="SELECT rt_NoOfRunsID, rt_LineID, rt_NoOfRunsdate,rt_BusID,rt_BusCard,rt_CheckTicketWindow,rt_ReportDateTime,pd_BeginStationTime,bi_BusUnit 
						FROM tms_sch_Report 
						LEFT OUTER JOIN tms_bd_PriceDetail ON pd_NoOfRunsID=rt_NoOfRunsID AND pd_NoOfRunsdate=rt_NoOfRunsdate 
						LEFT OUTER JOIN tms_bd_BusInfo ON rt_BusCard=bi_BusNumber
						WHERE rt_NoOfRunsdate='{$CurDate}' AND rt_Register='未发车' AND pd_FromStation='{$row['lc_Station']}'AND pd_ReachStation='{$row['lc_Destination']}' 
						AND rt_AttemperStationID='{$userStationID}' AND rt_BusID!='{$row['lc_BusID']}'";
					$querybus=$class_mysql_default ->my_query($selectbus);
					if(!$querybus) echo mysql_error();
					while($rowbus=mysql_fetch_array($querybus)){
				?>
				<tr align="center" bgcolor="#CCCCCC">
					<td><?=$rowbus['rt_BusID']?></td>
					<td><?=$rowbus['rt_BusCard']?></td>
					<td><?=$rowbus['bi_BusUnit']?></td>
					<td><?=$rowbus['rt_ReportDateTime']?></td>
					<td><?=$rowbus['pd_BeginStationTime']?></td>
					<td><?=$rowbus['rt_NoOfRunsID']?></td>
					<td><?=$rowbus['rt_LineID']?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		</div>
			
		
	</body>
</html>
