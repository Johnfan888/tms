<?php
//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$NoOfRunsID=$_GET['nrID'];
$NoOfRunsdate=$_GET['nrDate'];
$LineName=$_GET['line'];
$select="SELECT tml_NoOfRunstime,tml_TotalSeats,tml_LeaveSeats,tml_StopRun,tml_AllowSell,tml_HalfSeats FROM tms_bd_TicketMode WHERE tml_NoOfRunsID='{$NoOfRunsID}' 
	AND tml_NoOfRunsdate='{$NoOfRunsdate}'";
$query=$class_mysql_default ->my_query($select);
$row=mysqli_fetch_array($query);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head> 
	<title>并班</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<link href="../css/tms.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#table1").tablesorter();
			$("#table1 tr").mouseover(function(){$(this).css("background-color","#f1e6c2");});
			$("#table1 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$("#table1 tr").click(function(){
				$("#table1 tr:not(this)").css("background-color","#CCCCCC");
				$("#table1 tr:not(this)").mouseover(function(){$(this).css("background-color","#f1e6c2");});
				$("#table1 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
				$(this).css("background-color","#FFCC00");
				$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
				$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
				$("#NoOfRunsID1").val($(this).children().eq(12).text());
				$("#LeaveSeats").val($(this).children().eq(7).text());
			});
			$("#andruns").click(function(){
				if(document.getElementById("NoOfRunsID1").value=='' ){
					alert('请选择要并入的班次！');
					return false;
				}
				if(document.getElementById("LeaveSeats").value*1<document.getElementById("SellNumber").value*1 ){
					alert('班次'+document.getElementById("NoOfRunsID1").value+'的剩余座位数小于班次'+document.getElementById("NoOfRunsID").value+'的已售票数，请修改班次'+document.getElementById("NoOfRunsID1").value+'的座位数！');
					return false;
				}
				if (confirm('是否真的要进行班次合并?')){
					jQuery.get(
							'tms_v1_schedule_dataops.php',
							{'op': 'ANDRUN', 'NoOfRunsID': $("#NoOfRunsID").val(),'NoOfRunsID1': $("#NoOfRunsID1").val(), 'NoOfRunsdate':$("#NoOfRunsdate").val(),'time': Math.random()},
							function(data){
								var objData = eval('(' + data + ')');
								if(objData.retVal == "FAIL"){ 
									alert(objData.retString);
								}else{
									alert(objData.retString);
									document.form1.submit();
									location.assign('tms_v1_schedule_noofrun.php');
										//document.getElementById("NorunsID").value=objData.NoOfRunsID;
								}
					});   
				}
			});
		});
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
		<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
		<span class="graytext" style="margin-left:8px;">并  班</span></td>
	</tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr bgcolor="#FFFFFF">
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />线路名称：</span></td>
		<td><input type="text" name="Linename" id="Linename" value="<?php echo $LineName;?>"  readonly="readonly"/></td>
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />发车日期：</span></td>
		<td><input type="text" name="NoOfRunsdate" id="NoOfRunsdate" value="<?php echo $NoOfRunsdate;?>"  readonly="readonly"/></td>
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />发车时间：</span></td>
		<td><input type="text" name="NoOfRunstime" id="NoOfRunstime" value="<?php echo $row['tml_NoOfRunstime'];?>"  readonly="readonly"/></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7"  />已售数量：</span></td>
		<td><input type="text" name="SellNumber" id="SellNumber" value="<?php echo $row['tml_TotalSeats']-$row['tml_LeaveSeats'];?>"  readonly="readonly"/></td>
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7"  />已售半票数：</span></td>
		<td><input type="text" name="SellHalf" id="SellHalf" value="<?php echo $row['tml_HalfSeats'];?>"  readonly="readonly"/></td>
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />班次编号：</span></td>
		<td><input type="text" name="NoOfRunsID" id="NoOfRunsID" readonly="readonly" value="<?php echo $NoOfRunsID;?>"/></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td colspan="8" align="center" bgcolor="#FFFFFF">
			<input type="button" name="andruns" id="andruns" value="并班" />&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button" name="back" id="back" value="返回" onclick="location.assign('tms_v1_schedule_noofrun.php')"/>
		</td>
	</tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
	<tr>
		<th nowrap="nowrap" align="center" bgcolor="#006699">序号</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">加班</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">操作码</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">班次状态</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">线路名称</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">运行区域</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">剩余座位位数</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">剩余半票数</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">车型</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">车属单位</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">检票口</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">班次编码</th>
	</tr>
	</thead>
	<?php 
	//	if(isset($_POST['BeginStation'])){
			$selectadd="SELECT nri_NoOfRunsID, nri_OperateCode, nri_State,nri_DepartureTime, nri_RunRegion,nri_AddNoRuns,nri_CheckTicketWindow,tml_AllowSell,tml_BusModel,tml_BusUnit, 
				tml_LeaveSeats,tml_LeaveHalfSeats,rt_Register FROM tms_bd_NoRunsInfo 
				LEFT OUTER JOIN tms_bd_TicketMode ON tml_NoOfRunsID=nri_NoOfRunsID AND tml_NoOfRunsdate='{$NoOfRunsdate}'
				LEFT OUTER JOIN tms_sch_Report ON rt_NoOfRunsID=tml_NoOfRunsID AND rt_NoOfRunsdate=tml_NoOfRunsdate AND rt_AttemperStationID='{$userStationID}'  
				WHERE nri_LineName='{$LineName}' AND tml_AllowSell='1' AND tml_StopRun!='3' AND nri_NoOfRunsID!='{$NoOfRunsID}'";
			$queryadd=$class_mysql_default ->my_query($selectadd);
			$i=0;
			while($rowadd=mysqli_fetch_array($queryadd)){
				$i++;
			//	echo $rowadd['rt_Register'];
				if($rowadd['rt_Register']!='已发车'){
	?>
	<tbody class="scrollContent">
	<tr align="center" bgcolor="#CCCCCC">
	    <td><?=$i?></td>
		<td><?php if ($rowadd['nri_AddNoRuns']==1) echo '是'; else echo '否';?></td>
		<td><?=$rowadd['nri_OperateCsode']?></td>
		<td><?php if ($rowadd['tml_AllowSell']=='1') echo '在售'; else echo $rowadd['nri_State'];?></td>
		<td><?=$LineName?></td>
		<td><?=$rowadd['nri_DepartureTime']?></td>
		<td><?=$rowadd['nri_RunRegion']?></td>
		<td><?=$rowadd['tml_LeaveSeats']?></td>
		<td><?=$rowadd['tml_LeaveHalfSeats']?></td>
		<td><?=$rowadd['tml_BusModel']?></td>
		<td><?=$rowadd['tml_BusUnit']?></td>
		<td><?=$rowadd['nri_CheckTicketWindow']?></td>
		<td><?=$rowadd['nri_NoOfRunsID']?></td>
	</tr>
	<?php
				}
			}
//		}
	?>
	</tbody>
</table>
	<input type="hidden" name="NoOfRunsID1" id="NoOfRunsID1"/>
	<input type="hidden" name="LeaveSeats" id="LeaveSeats"/>
	</div>
</form>
</body>
</html>
