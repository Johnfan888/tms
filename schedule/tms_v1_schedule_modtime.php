<?php
//修改座位数
//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$NoOfRunsID = $_GET['nrID'];
$NoOfRunsdate = $_GET['nrDate'];
$departuretime= $_GET['dtime'];
$selectticketmode="SELECT li_LineName,tml_NoOfRunstime,tml_BeginstationID FROM tms_bd_TicketMode  LEFT OUTER JOIN tms_bd_LineInfo 
	ON tml_LineID = li_LineID WHERE tml_NoOfRunsID = '$NoOfRunsID' AND tml_NoOfRunsdate = '$NoOfRunsdate'";
$queryticketmode = $class_mysql_default->my_query($selectticketmode);
$rowticketmode = mysqli_fetch_array($queryticketmode);
/*$selectdocktemp="SELECT ndst_NoOfRunsID FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID}' AND ndst_NoOfRunsdate='{$NoOfRunsdate}'";
$querydocktemp=$class_mysql_default->my_query($selectdocktemp);
if(mysqli_num_rows($querydocktemp) == 0){
	$insertdoktemp="INSERT INTO tms_bd_NoRunsDockSiteTemp (ndst_NoOfRunsID,ndst_NoOfRunsdate,ndst_ID,ndst_SiteName,ndst_SiteID,ndst_IsDock,ndst_GetOnSite,
		ndst_CheckInSite,ndst_DepartureTime,ndst_RunHours,ndst_StintSell,ndst_StintTime) SELECT nds_NoOfRunsID,'$NoOfRunsdate',nds_ID,nds_SiteName,nds_SiteID,
		nds_IsDock,nds_GetOnSite,nds_CheckInSite,nds_DepartureTime,nds_RunHours,nds_StintSell,nds_StintTime FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsID}'";
	$queryinsert=$class_mysql_default->my_query($insertdoktemp);
} */
//$selectbus="SELECT bi_SeatS,bi_AllowHalfSeats FROM tms_bd_BusInfo WHERE bi_BusNumber='{$reportBusCard}'";
//$querybus = $class_mysql_default->my_query($selectbus);
//$rowbus = mysqli_fetch_array($querybus);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>修改发车时间</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<link href="../js/ui/jquery-ui.css" rel="stylesheet" type="text/css" />
	<link href="../js/jQuery-Timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css" />
 	<script type="text/javascript" src="../js/jquery-1.8.2.js"></script>
	<script type="text/javascript" src="../js/ui/jquery-ui.js"></script>
	<script type="text/javascript" src="../js/jQuery-Timepicker/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="../js/jQuery-Timepicker/jquery-ui-sliderAccess.js"></script>
	<script type="text/javascript" src="../js/jQuery-Timepicker/i18n/jquery-ui-timepicker-zh-CN.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#NoOfRunstime1').timepicker();
		});
		function modetime(){
			if(document.getElementById("NoOfRunstime1").value==''){
				alert('请输入新的发车时间！');
				return false;
			}
		}
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
		<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
		<span class="graytext" style="margin-left:8px;">修改发车时间</span></td>
	</tr>
</table>
<form action="" method="post" name="form1">
<table width="50%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr><td colspan="2">班次信息</td></tr>
	<tr bgcolor="#FFFFFF">
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路：</span></td>
		<td>
			<input type="text" id="Linenam" name="Linenam" disabled="disabled" value="<?php echo $rowticketmode['li_LineName'];?>"/>
			<input type="hidden" id="Linename" name="Linename" value="<?php echo $rowticketmode['li_LineName'];?>"/>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车日期：</span></td>
		<td>
			<input type="hidden" id="NoOfRunsdate" name="NoOfRunsdate" value="<?php echo $NoOfRunsdate;?>"/>
			<input type="text" id="NoOfRunsdat" name="NoOfRunsdat" disabled="disabled" value="<?php echo $NoOfRunsdate;?>"/>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 原发车时间：</span></td>
		<td>
			<input type="hidden" id="NoOfRunstime" name="NoOfRunstime" value="<?php echo $departuretime;?>"/>
			<input type="text" id="NoOfRunstim" name="NoOfRunstim" disabled="disabled" value="<?php echo $departuretime;?>"/>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />新发车时间：</span></td>
		<td><input type="text" id="NoOfRunstime1" name="NoOfRunstime1" /></td>
	</tr>
	<tr>
		<td colspan="2" align="center" bgcolor="#FFFFFF">
			<input type="submit" name="modtime" id="modtime" value="修改" onclick="return modetime()"/>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button" name="back" id="back" value="返回" onclick="location.assign('tms_v1_schedule_noofrun.php')"/>&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?php 
	if(isset($_POST['modtime'])){
		$NoOfRunstime1=$_POST['NoOfRunstime1'];
		$NoOfRunstime=$_POST['NoOfRunstime'];
		if($NoOfRunstime==''){
			$NoOfRunstime2=$NoOfRunstime1;
		}else{
			$NoOfRunstime2=$NoOfRunstime;
		}
		$diftime=strtotime($NoOfRunstime1) - strtotime($NoOfRunstime2);
		if ($rowticketmode['tml_BeginstationID']==$userStationID || $userStationID=='all'){
			$class_mysql_default->my_query("START TRANSACTION");
			$queryString = "SELECT tml_BeginstationID, tml_Beginstation FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$NoOfRunsID') AND (tml_NoOfRunsdate = '$NoOfRunsdate') FOR UPDATE";
	  		$result = $class_mysql_default->my_query("$queryString");
			if(!$result){
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('锁定票版失败！');window.location.href='tms_v1_schedule_modtime.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$departuretime'</script>";
				exit();
			}
			$updatemodel="UPDATE tms_bd_TicketMode SET tml_NoOfRunstime='{$NoOfRunstime1}' WHERE tml_NoOfRunsID = '{$NoOfRunsID}' AND tml_NoOfRunsdate = '{$NoOfRunsdate}'";
			$resultmodel = $class_mysql_default->my_query("$updatemodel");
			if(!$resultmodel){
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('更新票版失败！');window.location.href='tms_v1_schedule_modtime.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$departuretime'</script>";
				exit();
			}
			$selectdocktemp1="SELECT ndst_ID,ndst_SiteName,ndst_SiteID,ndst_DepartureTime,ndst_RunHours FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='$NoOfRunsID' AND 
				ndst_NoOfRunsdate='$NoOfRunsdate'";
			$querydocktemp1=$class_mysql_default->my_query("$selectdocktemp1");
			if(!$querydocktemp1){
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('查询临时停靠点1数据失败！');window.location.href='tms_v1_schedule_modtime.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$departuretime'</script>";
				exit();
			} 
			while($rowdocktemp1=mysqli_fetch_array($querydocktemp1)){
				if($NoOfRunstime==''){
					if($rowdocktemp1['ndst_RunHours']){
						$Runhuor=$rowdocktemp1['ndst_RunHours'];
						$RunHours=explode(":", $rowdocktemp1['ndst_RunHours']);
						$Dtime=date('H:i', strtotime ('+'.($RunHours[0]*3600+$RunHours[1]*60).' second', strtotime($NoOfRunstime1)));
					}else{
						if($rowdocktemp1['ndst_DepartureTime']){
							$Dtime=date('H:i', strtotime ('+'.$diftime.' second', strtotime($rowdocktemp1['ndst_DepartureTime'])));
							$Runsecond=strtotime($Dtime) - strtotime($NoOfRunstime1);
							$RunH=(int)($Runsecond/3600);
							$RunM=(int)(($Runsecond-$RunH*3600)/60);
							$Runhour=$RunH.':'.$RunM;
						}
						$Dtime='';
						$Runhour='';
					}
				}else{
					if($rowdocktemp1['ndst_DepartureTime']){
						$Dtime=date('H:i', strtotime ('+'.$diftime.' second', strtotime($rowdocktemp1['ndst_DepartureTime'])));
					}else{
						$Dtime='';
					}
					$Runhuor=$rowdocktemp1['ndst_RunHours'];
				}
				$updatedocktemp="UPDATE tms_bd_NoRunsDockSiteTemp SET ndst_DepartureTime='{$Dtime}',ndst_RunHours='{$Runhuor}' WHERE ndst_NoOfRunsID='{$NoOfRunsID}' AND 
					ndst_NoOfRunsdate='{$NoOfRunsdate}' AND ndst_ID='{$rowdocktemp1['ndst_ID']}'";
				$resultdocktemp = $class_mysql_default->my_query("$updatedocktemp");
				if(!$resultdocktemp){
					$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('更新临时停靠点数据失败！');window.location.href='tms_v1_schedule_modtime.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$departuretime'</script>";
					exit();
				}
			}
			$selectdocktemp2="SELECT ndst_ID,ndst_SiteID,ndst_DepartureTime,ndst_RunHours FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID}' AND 
				ndst_NoOfRunsdate='{$NoOfRunsdate}' AND ndst_GetOnSite='1'";
			$querydocktemp2=$class_mysql_default->my_query("$selectdocktemp2");
			if(!$querydocktemp2){
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('查询临时停靠点2数据失败！');window.location.href='tms_v1_schedule_modtime.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$departuretime'</script>";
				exit();
			}
			while($rowdocktemp2=mysqli_fetch_array($querydocktemp2)){
				$IDtemp=$rowdocktemp2['ndst_ID'];
				$FromStationID=$rowdocktemp2['ndst_SiteID'];
				$BeginStationTime=$rowdocktemp2['ndst_DepartureTime'];
				$ndsRunHours1=$rowdocktemp2['ndst_RunHours'];
				$selectdocktemp3="SELECT ndst_ID,ndst_SiteID,ndst_DepartureTime,ndst_RunHours FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID}' AND 
					ndst_NoOfRunsdate='{$NoOfRunsdate}' AND ndst_IsDock='1' AND ndst_ID>'{$IDtemp}'";
				$querydocktemp3=$class_mysql_default->my_query("$selectdocktemp3");
				if(!$querydocktemp3){
					$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('查询临时停靠点3数据失败！');window.location.href='tms_v1_schedule_modtime.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$departuretime'</script>";
					exit();
				}
				while($rowdocktemp3=mysqli_fetch_array($querydocktemp3)){
					$ReachStationID=$rowdocktemp3['ndst_SiteID'];
					$StopStationTime=$rowdocktemp3['ndst_DepartureTime'];
					$ndsRunHours2=$rowdocktemp3['ndst_RunHours'];
					if($IDtemp==1){
						$ndsRunHours1='0:0';
					}
					if($ndsRunHours1 && $ndsRunHours2){
						$RunHours1=explode(":", $ndsRunHours1);
						$RunHours2=explode(":", $ndsRunHours2);
						$allRunHours1=$RunHours1[0]*60+$RunHours1[1];
						$allRunHours2=$RunHours2[0]*60+$RunHours2[1];
						$allRunHours=$allRunHours2-$allRunHours1;
						$allhours=(int)($allRunHours/60);
						$allminutes=$allRunHours%60; 
						$lastRunHours=$allhours.':'.$allminutes;
					}else{
						$lastRunHours='';
					}
					$updateprice="UPDATE tms_bd_PriceDetail SET pd_BeginStationTime='{$BeginStationTime}',pd_StopStationTime='{$StopStationTime}',pd_RunHours='{$lastRunHours}' WHERE pd_NoOfRunsID='{$NoOfRunsID}' AND
						pd_NoOfRunsdate='{$NoOfRunsdate}' AND pd_FromStationID='{$FromStationID}' AND pd_ReachStationID='{$ReachStationID}'";
					$queryupdate=$class_mysql_default->my_query($updateprice);
					if(!$queryupdate){
						$class_mysql_default->my_query("ROLLBACK");
						echo "<script>alert('更新票价数据失败！');window.location.href='tms_v1_schedule_modrunhours.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$Departuretime'</script>";
						exit();
					}
				}
			}
			$class_mysql_default->my_query("COMMIT");
			echo "<script>alert('修改发车时间成功!');window.location.href='tms_v1_schedule_noofrun.php?op=none'</script>";
		}else{
			$class_mysql_default->my_query("START TRANSACTION");
			$queryString = "SELECT tml_NoOfRunstime, tml_RunHours FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$NoOfRunsID') AND (tml_NoOfRunsdate = '$NoOfRunsdate') FOR UPDATE";
	  		$result = $class_mysql_default->my_query("$queryString");
			if(!$result){
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('锁定票版失败！');window.location.href='tms_v1_schedule_modtime.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$departuretime'</script>";
				exit();
			}
			$row=mysqli_fetch_array($result);
			$selectdocktemp1="SELECT ndst_ID,ndst_SiteID,ndst_DepartureTime,ndst_RunHours FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID}' AND ndst_NoOfRunsdate='{$NoOfRunsdate}'
				AND ndst_ID>=(SELECT nds_ID FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsID}' AND nds_SiteID='{$userStationID}')";
			$querydocktemp1=$class_mysql_default->my_query("$selectdocktemp1");
			if(!$querydocktemp1){
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('查询临时停靠点1数据失败！');window.location.href='tms_v1_schedule_modtime.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$departuretime'</script>";
				exit();
			}
			while($rowdocktemp1=mysqli_fetch_array($querydocktemp1)){
				if($rowdocktemp1['ndst_DepartureTime']){
					$Dtime=date('H:i', strtotime ('+'.$diftime.' second', strtotime($rowdocktemp1['ndst_DepartureTime'])));
					if($rowdocktemp1['ndst_RunHours']){
						$Runtime=explode(":", $rowdocktemp1['ndst_RunHours']);
						$alltime=$Runtime[0]*3600+$Runtime[1]*60+$diftime;
						$allhour=(int)($alltime/3600);
						$allminutes=(int)(($alltime%3600)/60);
						$Runhour=$allhour.':'.$allminutes;
					}else{
						$Runhour='';
					}
				}else{
					if($rowdock['nds_SiteID']==$userStationID){
						$Dtime=$NoOfRunstime1;
						if($row['tml_NoOfRunstime']){
							$ditime=strtotime($NoOfRunstime1) - strtotime($row['tml_NoOfRunstime']);
							$allhour=(int)($ditime/3600);
							$allminutes=(int)(($ditime%3600)/60);
							$Runhour=$allhour.':'.$allminutes;
						}else{
							$Runhour='';
						}
					}else{
						$Dtime='';
						$Runhour='';
					}
				}
				$updatedocktemp1="UPDATE tms_bd_NoRunsDockSiteTemp SET ndst_DepartureTime='{$Dtime}',ndst_RunHours='{$Runhour}' WHERE ndst_NoOfRunsID='$NoOfRunsID' AND 
					ndst_NoOfRunsdate='$NoOfRunsdate' AND ndst_SiteID='{$rowdocktemp1['ndst_SiteID']}'";
				$querydocktemp1=$class_mysql_default->my_query("$updatedocktemp1");
				if(!$querydocktemp1){
					$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('更新临时停靠点数据失败！');window.location.href='tms_v1_schedule_modtime.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$departuretime'</script>";
					exit();
				}
			}
			if($row['tml_RunHours']){
				$Runtime=explode(":", $row['tml_RunHours']);
				$alltime=$Runtime[0]*3600+$Runtime[1]*60+$diftime;
				$allhour=(int)($alltime/3600);
				$allminutes=(int)(($alltime%3600)/60);
				$Runhour=$allhour.':'.$allminutes;
			}else{
				$Runhour=$row['tml_RunHours'];
			}
			$updatemodel="UPDATE tms_bd_TicketMode SET tml_RunHours='{$Runhour}' WHERE (tml_NoOfRunsID = '$NoOfRunsID') AND (tml_NoOfRunsdate = '$NoOfRunsdate')";
			$queryupmodel=$class_mysql_default->my_query("$updatemodel");
			if(!$queryupmodel){
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('更新票版数据失败！');window.location.href='tms_v1_schedule_modtime.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$departuretime'</script>";
				exit();
			}
			$selectdocksitetemp2="SELECT ndst_ID,ndst_SiteName,ndst_SiteID,ndst_DepartureTime,ndst_RunHours FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID}' AND 
				ndst_NoOfRunsdate='{$NoOfRunsdate}' AND ndst_GetOnSite=1";
			$querydocksitetemp2=$class_mysql_default->my_query($selectdocksitetemp2);
			if(!$querydocksitetemp2){
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('查询临时停靠点2数据失败！');window.location.href='tms_v1_schedule_modtime.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$departuretime'</script>";
				exit();
			}
			while($rowdocksitetemp2=mysqli_fetch_array($querydocksitetemp2)){
				$IDtemp=$rowdocksitetemp2['ndst_ID'];
				$FromStationID=$rowdocksitetemp2['ndst_SiteID'];
				$BeginStationTime=$rowdocksitetemp2['ndst_DepartureTime'];
				$ndsRunHours1=$rowdocksitetemp2['ndst_RunHours'];
				$selectdocksitetemp3="SELECT ndst_SiteID,ndst_DepartureTime,ndst_RunHours FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID}' AND ndst_NoOfRunsdate='{$NoOfRunsdate}' AND 
					ndst_ID>'{$IDtemp}' AND ndst_IsDock=1";
				$querydocksitetemp3=$class_mysql_default->my_query($selectdocksitetemp3);
				if(!$querydocksitetemp3){
					$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('查询临时停靠点2数据失败！');window.location.href='tms_v1_schedule_modtime.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$departuretime'</script>";
					exit();
				}
				while($rowdocksitetemp3=mysqli_fetch_array($querydocksitetemp3)){
					$ReachStationID=$rowdocksitetemp3['ndst_SiteID'];
					$StopStationTime=$rowdocksitetemp3['ndst_DepartureTime'];
					$ndsRunHours2=$rowdocksitetemp3['ndst_RunHours'];
					//处理运行小时数
					if($IDtemp==1){
						$ndsRunHours1='0:0';
					}
					if($ndsRunHours1 && $ndsRunHours2){
						$RunHours1=explode(":", $ndsRunHours1);
						$RunHours2=explode(":", $ndsRunHours2);
						$allRunHours1=$RunHours1[0]*60+$RunHours1[1];
						$allRunHours2=$RunHours2[0]*60+$RunHours2[1];
						$allRunHours=$allRunHours2-$allRunHours1;
						$allhours=(int)($allRunHours/60);
						$allminutes=$allRunHours%60; 
						$lastRunHours=$allhours.':'.$allminutes;
					}else{
						$lastRunHours='';
					}
					$updateprice="UPDATE tms_bd_PriceDetail SET pd_BeginStationTime='{$BeginStationTime}',pd_StopStationTime='{$StopStationTime}',pd_RunHours='{$lastRunHours}' WHERE pd_NoOfRunsID='{$NoOfRunsID}' AND
						pd_NoOfRunsdate='{$NoOfRunsdate}' AND pd_FromStationID='{$FromStationID}' AND pd_ReachStationID='{$ReachStationID}'";
					$queryupdate=$class_mysql_default->my_query($updateprice);
					if(!$queryupdate){
						$class_mysql_default->my_query("ROLLBACK");
						echo "<script>alert('更新票价数据失败！');window.location.href='tms_v1_schedule_modrunhours.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$Departuretime'</script>";
						exit();
					}
				}
			}
			$class_mysql_default->my_query("COMMIT");
			echo "<script>alert('修改发车时间成功!');window.location.href='tms_v1_schedule_noofrun.php?op=none'</script>";
		}
	}
/*	if(isset($_POST['modtime'])){
		$NoOfRunstime1=$_POST['NoOfRunstime1'];
		if ($rowticketmode['tml_BeginstationID']==$userStationID || $userStationID=='all'){
			$class_mysql_default->my_query("START TRANSACTION");
			$queryString = "SELECT tml_BeginstationID, tml_Beginstation FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$NoOfRunsID') AND (tml_NoOfRunsdate = '$NoOfRunsdate') FOR UPDATE";
	  		$result = $class_mysql_default->my_query("$queryString");
			if(!$result){
				$class_mysql_default->my_query("ROLLBACK");
				echo "锁定票版失败";
				exit();
			}
			$updatemodel="UPDATE tms_bd_TicketMode SET tml_NoOfRunstime='{$NoOfRunstime1}' WHERE tml_NoOfRunsID = '{$NoOfRunsID}' AND tml_NoOfRunsdate = '{$NoOfRunsdate}'";
			$resultmodel = $class_mysql_default->my_query("$updatemodel");
			$updateprice="UPDATE tms_bd_PriceDetail SET pd_BeginStationTime='{$NoOfRunstime1}' WHERE pd_NoOfRunsID='{$NoOfRunsID}' AND pd_NoOfRunsdate='{$NoOfRunsdate}' AND pd_FromStationID='{$userStationID}'";
			$resultprice = $class_mysql_default->my_query("$updateprice");
			if($resultmodel && $resultprice) {
				$class_mysql_default->my_query("COMMIT");
				echo "<script>alert('修改发车时间成功!');window.location.href='tms_v1_schedule_noofrun.php?op=none'</script>";
			}else{
				$class_mysql_default->my_query("ROLLBACK"); 
				echo "<script>alert('修改发车时间失败!');window.location.href='tms_v1_schedule_noofrun.php?op=none'</script>";
			}
		}else{
			$update="UPDATE tms_bd_PriceDetail SET pd_BeginStationTime='{$NoOfRunstime1}' WHERE pd_NoOfRunsID='{$NoOfRunsID}' AND pd_NoOfRunsdate='{$NoOfRunsdate}' AND pd_FromStationID='{$userStationID}'";
			$result = $class_mysql_default->my_query("$update");
			if($result) {
				echo "<script>alert('修改发车时间成功!');window.location.href='tms_v1_schedule_noofrun.php?op=none'</script>";
			}else{
				echo "<script>alert('修改发车时间失败!');window.location.href='tms_v1_schedule_noofrun.php?op=none'</script>";
			}
		}
	} */
	/*	$selectprice="SELECT pd_FromStationID,pd_ReachStationID,pd_BeginStationTime,pd_StopStationTime FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID='{$NoOfRunsID}' 
					AND pd_NoOfRunsdate='{$NoOfRunsdate}' AND pd_FromStationID='{$rowdock['nds_SiteID']}'";
				$queryprice=$class_mysql_default->my_query("$selectprice");
				if(!$queryprice){
					$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('查询票价数据失败！');window.location.href='tms_v1_schedule_modtime.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$departuretime'</script>";
					exit();
				}
				while($rowprice=mysqli_fetch_array($queryprice)){
					if($rowprice['pd_BeginStationTime']){
						$Begintime=date('H:i', strtotime ('+'.$diftime.' second', strtotime($rowprice['pd_BeginStationTime'])));
					}else{
						$Begintime='';
					}
					if($rowprice['pd_StopStationTime']){
						$Stoptime=date('H:i', strtotime ('+'.$diftime.' minute', strtotime($rowprice['pd_StopStationTime'])));
					}else{
						$Stoptime='';
					}
					$updateprice="UPDATE tms_bd_PriceDetail SET pd_BeginStationTime='{$Begintime}', pd_StopStationTime='{$Stoptime}' WHERE pd_NoOfRunsID='{$NoOfRunsID}' AND 
						pd_NoOfRunsdate='{$NoOfRunsdate}' AND pd_FromStationID='{$rowprice['pd_FromStationID']}' AND pd_ReachStationID='{$rowprice['pd_ReachStationID']}'";
					$resultprice = $class_mysql_default->my_query("$updateprice");
					if(!$resultprice){
						$class_mysql_default->my_query("ROLLBACK");
						echo "<script>alert('更新票价数据失败！');window.location.href='tms_v1_schedule_modtime.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$departuretime'</script>";
						exit();
					}
				} */
	/*		$selectprice="SELECT pd_FromStationID,pd_ReachStationID,pd_BeginStationTime,pd_StopStationTime,pd_RunHours FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID='{$NoOfRunsID}' 
				AND pd_NoOfRunsdate='{$NoOfRunsdate}'";
			$queryprice=$class_mysql_default->my_query("$selectprice");
			if(!$queryprice){
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('查询票价数据失败！');window.location.href='tms_v1_schedule_modtime.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$departuretime'</script>";
				exit();
			}
			while($rowprice=mysqli_fetch_array($queryprice)){
				if($rowprice['pd_BeginStationTime']){
					$Begintime=date('H:i', strtotime ('+'.$diftime.' second', strtotime($rowprice['pd_BeginStationTime'])));
				}else{
					$Begintime='';
				}
				if($rowprice['pd_StopStationTime']){
					$Stoptime=date('H:i', strtotime ('+'.$diftime.' minute', strtotime($rowprice['pd_StopStationTime'])));
				}else{
					$Stoptime='';
				}
				$updateprice="UPDATE tms_bd_PriceDetail SET pd_BeginStationTime='{$Begintime}', pd_StopStationTime='{$Stoptime}' WHERE pd_NoOfRunsID='{$NoOfRunsID}' AND 
					pd_NoOfRunsdate='{$NoOfRunsdate}' AND pd_FromStationID='{$rowprice['pd_FromStationID']}' AND pd_ReachStationID='{$rowprice['pd_ReachStationID']}'";
				$resultprice = $class_mysql_default->my_query("$updateprice");
				if(!$resultprice){
					$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('更新票价数据失败！');window.location.href='tms_v1_schedule_modtime.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$departuretime'</script>";
					exit();
				}
			} */
?>
