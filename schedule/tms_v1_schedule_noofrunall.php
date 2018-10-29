<?php
//通票调度界面

//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

if (isset($_GET['op']))
{
	$oper=$_GET['op'];
	if($oper=="cancel")
	{
		$NoOfRunsID = $_GET['nrID'];
		$NoOfRunsdate = $_GET['nrDate'];
		$BusID = $_GET['bID'];
		$reportBusSeatNum = $_GET['busSeats'];
		$allowed = $_GET['allowed'];
		
		if ($allowed == 0){
			echo "<script>alert('余票数量不足，不能撤销!');</script>";
		}
		else {
			$class_mysql_default->my_query("BEGIN");
			//锁定票版数据
			//$queryString1 = "LOCK TABLES tms_bd_TicketMode WRITE";
		  	//$queryString1 = "SELECT tml_SeatStatus, tml_LeaveSeats FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$noofrunsID') AND (tml_NoOfRunsdate = '$norunsdate') LOCK IN SHARE MODE";
		  	$queryString = "SELECT tml_NoOfRunsID, tml_NoOfRunsdate, tml_BusID, tml_Allticket FROM tms_bd_TicketMode 
	  					WHERE (tml_NoOfRunsID = '$NoOfRunsID') AND (tml_NoOfRunsdate = '$NoOfRunsdate') FOR UPDATE";
			$result = $class_mysql_default->my_query("$queryString");
			if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('锁定票版数据失败！');</script>";
			}
			else {
				$queryString="UPDATE tms_bd_TicketMode SET tml_TotalSeats=tml_TotalSeats-'$reportBusSeatNum',
						tml_LeaveSeats=tml_LeaveSeats-'$reportBusSeatNum' WHERE tml_NoOfRunsID='{$NoOfRunsID}' AND 
						tml_NoOfRunsdate='$NoOfRunsdate' AND tml_Allticket='1' AND tml_BusID='######'";
				$result = $class_mysql_default->my_query("$queryString");
				if(!$result) {
					$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('更新票版数据失败！');</script>";
				}
				else {
					$queryString="DELETE FROM tms_sch_Report WHERE rt_NoOfRunsID='$NoOfRunsID' AND rt_NoOfRunsdate='$NoOfRunsdate' AND rt_BusID='$BusID'";
					$result = $class_mysql_default->my_query("$queryString");
					if(!$result) {
						$class_mysql_default->my_query("ROLLBACK");
						echo "<script>alert('撤销报班失败！');</script>";
					}
					else {
						$class_mysql_default->my_query("COMMIT");
					}
				}
			}
		}
	}
	if($oper=="stop")
	{
		$NoOfRunsID = $_GET['nrID'];
		$NoOfRunsdate = $_GET['nrDate'];
		$allowed = $_GET['allowed'];
		if ($allowed == 0){
			echo "<script>alert('本班次已售票，不能停班!');</script>";
		}
		else
		{
			$strsqlselet = "UPDATE tms_bd_TicketMode SET tml_StopRun='0',tml_AllowSell='0' WHERE tml_NoOfRunsID='$NoOfRunsID' AND tml_NoOfRunsdate='$NoOfRunsdate'";
			$resultselet = $class_mysql_default->my_query("$strsqlselet");
		}	
	}
	if($oper=="run")
	{
		$NoOfRunsID = $_GET['nrID'];
		$NoOfRunsdate = $_GET['nrDate'];
		$strsqlselet = " UPDATE tms_bd_TicketMode SET tml_StopRun='1',tml_AllowSell='1' WHERE tml_NoOfRunsID='$NoOfRunsID' AND tml_NoOfRunsdate='$NoOfRunsdate'";
		$resultselet = $class_mysql_default->my_query("$strsqlselet");
	}
}

$configFileName = "config" . $userID . ".php";
if(!file_exists($configFileName)) {
	$fp = fopen($configFileName, 'w');
	if(!$fp) {
		fclose($fp);
		echo "打开文件\"$configFileName\"失败！";
		exit();
	}
	$retVal = fwrite($fp, "<?php\r\n\$schStation='';\r\n");
	$retVal = fwrite($fp, "\$schDate='';\r\n");
	$retVal = fwrite($fp, "\$noofrunsID='';\r\n");
	$retVal = fwrite($fp, "\$busID='';\r\n");
	$retVal = fwrite($fp, "\$endStation='';\r\n");
	$retVal = fwrite($fp, "\$noofrunStatus='1';\r\n");
	$retVal = fwrite($fp, "\$checkboxStatus='';\r\n?>");
	if(!$retVal) {
		fclose($fp);
		echo "写入文件\"$configFileName\"失败！";
		exit();
	}
	fclose($fp);
}

require_once("$configFileName");

if($checkboxStatus == "checked")
	$refreshInterval = "10";
else
	$refreshInterval = "36000";

if(isset($_POST['resultquery']))
{
	$schStation = $_POST['schStation'];
	$schDate = $_POST['schDate'];
	$noofrunsID = $_POST['noofrun'];
	$busID = $_POST['busID'];
	$endStation = $_POST['endStation'];
	$noofrunStatus = $_POST['noofrunStatus'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>通票调度报班</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<meta http-equiv="refresh" content="<?php echo $refreshInterval?>;url=tms_v1_schedule_noofrunall.php" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<link href="../css/tms.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
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
		});
		$("#resultquery").click(function(){
			document.getElementById("schStation").value = document.getElementById("stationselect").value;
			document.getElementById("schDate").value = document.getElementById("schDateIn").value;
			document.getElementById("noofrun").value = document.getElementById("noofrunIn").value;
			document.getElementById("busID").value = document.getElementById("busIDIn").value;
			document.getElementById("endStation").value = document.getElementById("endStationIn").value;
			document.getElementById("noofrunStatus").value = document.getElementById("statusselect").value;

			// generate configuration file for refresh
			if($("#isrefresh").attr("checked")) {
				jQuery.get(
					'tms_v1_schedule_dataops.php',
					{'op': 'REFRESH', 'schStation': $("#schStation").val(), 'schDate': $("#schDate").val(), 'noofrunsID': $("#noofrun").val(), 
					'busID': $("#busID").val(), 'endStation': $("#endStation").val(), 'noofrunStatus': $("#noofrunStatus").val(), 
					'checkboxStatus': 'checked', 'configFileName': $("#configFileName").val(), 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL"){ 
							alert(objData.retString);
						}
				});
			}
			else {
				jQuery.get(
					'tms_v1_schedule_dataops.php',
					{'op': 'REFRESH', 'schStation': $("#schStation").val(), 'schDate': $("#schDate").val(), 'noofrunsID': $("#noofrun").val(), 
					'busID': $("#busID").val(), 'endStation': $("#endStation").val(), 'noofrunStatus': $("#noofrunStatus").val(), 
					'checkboxStatus': '', 'configFileName': $("#configFileName").val(), 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL"){ 
							alert(objData.retString);
						}
				});
			}
			window.location.href='tms_v1_schedule_noofrunall.php?op=none';
		});		
	});
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
		<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
		<span class="graytext" style="margin-left:8px;">通 票 调 度 报 班</span></td>
	</tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr bgcolor="#FFFFFF">
		<td width="10%"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车站：</span></td>
		<td>
			<select id="stationselect" name="stationselect" size="1">
            <?php
            	if($userStationID == "all") {
            ?>
				<?php if ($schStation == "" || $schStation == "%") { ?>
					<option value="" selected="selected">请选择车站</option>
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
		<td width="10%"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车日期：</span></td>
		<td width="10%"><input name="schDateIn" id="schDateIn" class="Wdate" value="<?php ($schDate == "")? print date('Y-m-d') : print $schDate;?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
		<td width="10%"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：</span></td>
		<td width="15%"><input type="text" name="noofrunIn" id="noofrunIn" value="<?php echo $noofrunsID?>" /></td>
		<td colspan="2"><input id="isrefresh" name="isrefresh" type="checkbox" <?php echo $checkboxStatus?> /> 自动刷新</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td width="10%"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆编号：</span></td>
		<td width="15%"><input type="text" name="busIDIn" id="busIDIn" value="<?php echo $busID?>"/></td>
		<td width="10%"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 终点站：</span></td>
		<td width="15%"><input type="text" name="endStationIn" id="endStationIn"  value="<?php echo $endStation?>"/></td>
		<td width="10%"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 状态：</span></td>
		<td width="10%">
			<select name="statusselect" id="statusselect">
			<?php
				if ($noofrunStatus == "1")	echo "<option selected=\"selected\" value=\"1\">全部</option>";
				else						echo "<option  value=\"1\">全部</option>";
				if ($noofrunStatus == "2")	echo "<option selected=\"selected\" value=\"2\">开班</option>";
				else						echo "<option  value=\"2\">开班</option>";
				if ($noofrunStatus == "3")	echo "<option selected=\"selected\" value=\"3\">停班</option>";
				else						echo "<option  value=\"3\">停班</option>";
			?>
			</select>
		</td>
		<td colspan="2" bgcolor="#FFFFFF"><input type="button" name="resultquery" id="resultquery" value="查询可报班次" /></td>
	</tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
	<tr>
		<th nowrap="nowrap" align="center" bgcolor="#006699">序号</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">线路编号</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">线路名</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">时间</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">报班时间</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">发车情况</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">状态</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">发车站</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">终点站</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">座位</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">总可售座位</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">总余座</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">检票口</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">操作</th>
	</tr>
	</thead>
	<tbody class="scrollContent">
<?php
    $i=0;
	if ($noofrunStatus == "2") 		$StopRun = "1";
	else if ($noofrunStatus == "3") $StopRun = "0";
	else 							$StopRun = "%";
	$strsqlselet = "SELECT tml_NoOfRunsID, tml_LineID, tml_BusID, tml_BusCard, tml_NoOfRunsdate, tml_NoOfRunstime, rt_ReportDateTime, 
		rt_Register, tml_StopRun, tml_Beginstation, tml_Endstation, tml_TotalSeats, tml_LeaveSeats, tml_ReserveSeats, rt_BusID, rt_BusCard, 
		rt_SeatNum, tml_CheckTicketWindow, rt_CheckTicketWindow FROM tms_bd_TicketMode LEFT OUTER JOIN tms_sch_Report ON 
		tml_NoOfRunsID = rt_NoOfRunsID AND tml_NoOfRunsdate = rt_NoOfRunsdate WHERE tml_Beginstation LIKE '{$schStation}%' 
		AND tml_NoOfRunsdate = '$schDate' AND tml_NoOfRunsID LIKE '{$noofrunsID}%' AND tml_BusID LIKE '{$busID}%' AND 
		tml_Endstation LIKE '{$endStation}%' AND tml_StopRun LIKE '$StopRun' AND tml_Allticket = '1'";
		$resultselet = $class_mysql_default->my_query("$strsqlselet");
	while($rows = @mysqli_fetch_array($resultselet))	{
		$i++;
		$LineName = $rows['tml_Beginstation'].'--'.$rows['tml_Endstation'];
		if($rows['rt_BusID'] != NULL || $rows['rt_BusID'] != "")  $qryBusID = $rows['rt_BusID'];
		else $qryBusID = $rows['tml_BusID'];
		if($rows['rt_BusCard'] != "")  $qryBusCard = $rows['rt_BusCard'];
		else $qryBusCard = $rows['tml_BusCard'];
		if(($rows['tml_ReserveSeats'] + $rows['tml_LeaveSeats']) < $rows['tml_TotalSeats'])  $isStopAllowed = 0;
		else $isStopAllowed = 1;
		if($rows['tml_LeaveSeats'] < $rows['rt_SeatNum'])  $isCancelAllowed = 0;
		else $isCancelAllowed = 1;
		if($rows['rt_CheckTicketWindow'] != "")  $qryCheckWindow = $rows['rt_CheckTicketWindow'];
		else $qryCheckWindow = $rows['tml_CheckTicketWindow'];
?>
	<tr align="center" bgcolor="#CCCCCC">
		<td><?php echo $i?></td>
		<td><?php echo $rows['tml_NoOfRunsID']?></td>
		<td><?php echo $rows['tml_LineID']?></td>
		<td><?php echo $LineName?></td>
		<td><?php echo $qryBusID?></td>
		<td><?php echo $qryBusCard?></td>
		<td><?php echo $rows['tml_NoOfRunsdate']?></td>
		<td><?php echo $rows['tml_NoOfRunstime']?></td>
		<td><?php echo $rows['rt_ReportDateTime']?></td>
		<td><?php echo $rows['rt_Register']?></td>
		<td><?php ($rows['tml_StopRun'] == "1")? print "开" : print "停";?></td>
		<td><?php echo $rows['tml_Beginstation']?></td>
		<td><?php echo $rows['tml_Endstation']?></td>
		<td><?php echo $rows['rt_SeatNum']?></td>
		<td><?php echo $rows['tml_TotalSeats']?></td>
		<td><?php echo $rows['tml_LeaveSeats']?></td>
		<td><?php echo $qryCheckWindow?></td>
		
	<?php
		if($rows['rt_Register'] != "已发车") {
			if($rows['tml_StopRun'] == "1") {
	?>
		<td align="center">
			[<a href="tms_v1_schedule_noofrunsreportall.php?nrID=<?php echo $rows['tml_NoOfRunsID']?>&ln=<?php echo $LineName?>&nrDate=<?php echo $rows['tml_NoOfRunsdate']?>&qCW=<?php echo $qryCheckWindow?>"]>报班</a>]
			[<a href="tms_v1_schedule_noofrunall.php?nrID=<?php echo $rows['tml_NoOfRunsID']?>&bID=<?php echo $qryBusID?>&nrDate=<?php echo $rows['tml_NoOfRunsdate']?>&busSeats=<?php echo $rows['rt_SeatNum']?>&allowed=<?php echo $isCancelAllowed?>&op=cancel"]>撤销报班</a>]
			[<a href="tms_v1_schedule_noofrunall.php?nrID=<?php echo $rows['tml_NoOfRunsID']?>&nrDate=<?php echo $rows['tml_NoOfRunsdate']?>&op=run"]>开班</a>]
			[<a href="tms_v1_schedule_noofrunall.php?nrID=<?php echo $rows['tml_NoOfRunsID']?>&nrDate=<?php echo $rows['tml_NoOfRunsdate']?>&allowed=<?php echo $isStopAllowed?>&op=stop"]>停班</a>]
		<!--
			[<a href="tms_v1_schedule_noofrunall.php?NoOfRunsID=<?php echo $rows['tml_NoOfRunsID']?>&NoOfRunstime=<?php echo $rows['tml_NoOfRunstime']?>&op=delay"]>延时</a>]
			[<a href="tms_v1_schedule_noofrunall.php?NoOfRunsID=<?php echo $rows['tml_NoOfRunsID']?>&op=combine"]">并班</a>]
		-->
		</td>
	<?php } else {?>
		<td align="center">
			[<a href="tms_v1_schedule_noofrunall.php?nrID=<?php echo $rows['tml_NoOfRunsID']?>&bID=<?php echo $qryBusID?>&nrDate=<?php echo $rows['tml_NoOfRunsdate']?>&busSeats=<?php echo $rows['rt_SeatNum']?>&allowed=<?php echo $isCancelAllowed?>&op=cancel"]>撤销报班</a>]
			[<a href="tms_v1_schedule_noofrunall.php?nrID=<?php echo $rows['tml_NoOfRunsID']?>&nrDate=<?php echo $rows['tml_NoOfRunsdate']?>&op=run"]>开班</a>]
			[<a href="tms_v1_schedule_noofrunall.php?nrID=<?php echo $rows['tml_NoOfRunsID']?>&nrDate=<?php echo $rows['tml_NoOfRunsdate']?>&allowed=<?php echo $isStopAllowed?>&op=stop"]>停班</a>]
		</td>
	<?php	}
		} else {
	?>	
		<td>&nbsp;</td>
	<?php }?>
	</tr>
<?php 
	}
?>
	</tbody>
</table>
</div>
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
