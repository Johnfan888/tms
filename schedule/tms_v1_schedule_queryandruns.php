<?php
//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$NoOfRunsID=$_GET['nrID'];
$NoOfRunsdate=$_GET['nrDate'];
$LineName=$_GET['line'];
$thisStation=$_GET['tSt'];
$select="SELECT tml_NoOfRunstime,tml_TotalSeats,tml_LeaveSeats,tml_StopRun,tml_AllowSell,tml_HalfSeats,tml_Beginstation FROM tms_bd_TicketMode 
	WHERE tml_NoOfRunsID='{$NoOfRunsID}' AND tml_NoOfRunsdate='{$NoOfRunsdate}'";
$query=$class_mysql_default->my_query($select);
$row=mysqli_fetch_array($query);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head>
	<title>并班查询</title>
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
			});
			$("#cancelandruns").click(function(){
				if(document.getElementById("NoOfRunsID1").value=='' ){
					alert('请选择班次！');
					return false;
				} 
				if(document.getElementById("BeginStation").value!=document.getElementById("thisStation").value){
					alert('该站不是该班次的起点站，不能撤销并班！');
					return false;
				}
				if (confirm('是否真的要撤销班次合并?')){
					jQuery.get(
							'tms_v1_schedule_dataops.php',
							{'op': 'CANCELANDRUN', 'NoOfRunsID': $("#NoOfRunsID").val(),'NoOfRunsID1': $("#NoOfRunsID1").val(), 'NoOfRunsdate':$("#NoOfRunsdate").val(),'time': Math.random()},
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
		<span class="graytext" style="margin-left:8px;">并  班 查 询</span></td>
	</tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr bgcolor="#FFFFFF">
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />线路名称：</span></td>
		<td>
			<input type="text" name="Linename" id="Linename" value="<?php echo $LineName;?>"  readonly="readonly"/>
			<input type="hidden" name="BeginStation" id="BeginStation" value="<?php echo $row['tml_Beginstation'];?>"/>
			<input type="hidden" name="thisStation" id="thisStation" value="<?php echo $thisStation;?>"/>
		</td>
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
			<input type="button" name="cancelandruns" id="cancelandruns" value="撤销并班" />&nbsp;&nbsp;&nbsp;&nbsp;
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
	$i=0;
	//	if(isset($_POST['BeginStation'])){
			$selectand="SELECT anr_AndNoOfRunsID,anr_AndNoOfRunsdate,nri_OperateCode,nri_State,nri_DepartureTime,nri_RunRegion,nri_AddNoRuns,nri_CheckTicketWindow,tml_AllowSell,tml_BusModel,tml_BusUnit, 
				tml_LeaveSeats,tml_LeaveHalfSeats FROM tms_sch_AndNoOfRuns LEFT OUTER JOIN tms_bd_NoRunsInfo ON nri_NoOfRunsID=anr_AndNoOfRunsID LEFT OUTER JOIN tms_bd_TicketMode ON tml_NoOfRunsID=anr_AndNoOfRunsID 
				AND tml_NoOfRunsdate=anr_AndNoOfRunsdate WHERE anr_NoOfRunsID='{$NoOfRunsID}' AND anr_NoOfRunsdate='{$NoOfRunsdate}'";
			$queryand=$class_mysql_default->my_query($selectand);
			if (!$queryand) echo $class_mysql_default->my_error();
			while($rowadd=mysqli_fetch_array($queryand)){
				$i++;
		/*	$selectadd="SELECT nri_NoOfRunsID, nri_OperateCode, nri_State,nri_DepartureTime, nri_RunRegion,nri_AddNoRuns,nri_CheckTicketWindow,tml_AllowSell,tml_BusModel,tml_BusUnit, 
				tml_LeaveSeats,tml_LeaveHalfSeats FROM tms_bd_NoRunsInfo LEFT OUTER JOIN tms_bd_TicketMode ON tml_NoOfRunsID=nri_NoOfRunsID AND tml_NoOfRunsdate='{$NoOfRunsdate}' 
				WHERE nri_LineName='{$LineName}' AND tml_AllowSell='1' AND tml_StopRun='0' AND nri_NoOfRunsID!='{$NoOfRunsID}'";
			$queryadd=$class_mysql_default->my_query($selectadd);
			while($rowadd=mysqli_fetch_array($queryadd)){ */
	?>
	<tbody class="scrollContent"> 
	<tr align="center" bgcolor="#CCCCCC">
		<td><?php echo $i?></td>	
		<td><?php if ($rowadd['nri_AddNoRuns']==1) echo '是'; else echo '否';?></td>
		<td><?php echo $rowadd['nri_OperateCode']?></td>
		<td><?php if ($rowadd['tml_AllowSell']=='1') echo '在售'; else echo $rowadd['nri_State'];?></td>
		<td><?php echo $LineName?></td>
		<td><?php echo $rowadd['nri_DepartureTime']?></td>
		<td><?php echo $rowadd['nri_RunRegion']?></td>
		<td><?php echo $rowadd['tml_LeaveSeats']?></td>
		<td><?php echo $rowadd['tml_LeaveHalfSeats']?></td>
		<td><?php echo $rowadd['tml_BusModel']?></td>
		<td><?php echo $rowadd['tml_BusUnit']?></td>
		<td><?php echo $rowadd['nri_CheckTicketWindow']?></td>
		<td><?php echo $rowadd['anr_AndNoOfRunsID']?></td>
	</tr>
	<?php
			}
//		}
	?>
	</tbody>
</table>
	<input type="hidden" name="NoOfRunsID1" id="NoOfRunsID1"/>
	</div>
</form>
</body>
</html>
