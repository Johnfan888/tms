<?php
//修改运行小时数
//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$NoOfRunsID = $_GET['nrID'];
$NoOfRunsdate = $_GET['nrDate'];
$Departuretime= $_GET['dtime'];
//$RunHours=$_GET['rhours'];
$selectline="SELECT li_LineName FROM tms_bd_LineInfo WHERE li_LineID=(SELECT tml_LineID FROM tms_bd_TicketMode WHERE 
	tml_NoOfRunsID = '{$NoOfRunsID}' AND tml_NoOfRunsdate = '{$NoOfRunsdate}')";
$queryline= $class_mysql_default->my_query($selectline);
$rowline= mysql_fetch_array($queryline);
$selectID="SELECT ndst_ID FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID}' AND ndst_NoOfRunsdate='{$NoOfRunsdate}'
	AND ndst_SiteID='{$userStationID}'";
$queryID=$class_mysql_default->my_query($selectID);
if(!$queryID) echo mysql_error();
$rowID=mysql_fetch_array($queryID);
//$del="DELETE FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsdate<'{$NoOfRunsdate}'";
//$querydel=$class_mysql_default->my_query($del);
/*$selectdocktemp="SELECT ndst_NoOfRunsID FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID}' AND ndst_NoOfRunsdate='{$NoOfRunsdate}'";
$querydocktemp=$class_mysql_default->my_query($selectdocktemp);
if(mysql_num_rows($querydocktemp)==0){
	$insertdocktemp="INSERT INTO tms_bd_NoRunsDockSiteTemp (ndst_NoOfRunsID,ndst_NoOfRunsdate,ndst_ID,ndst_SiteName,ndst_SiteID,ndst_IsDock,ndst_GetOnSite,ndst_CheckInSite,
		ndst_DepartureTime,ndst_RunHours,ndst_StintSell,ndst_StintTime) SELECT nds_NoOfRunsID,'{$NoOfRunsdate}',nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,nds_GetOnSite,
		nds_CheckInSite,nds_DepartureTime,nds_RunHours,nds_StintSell,nds_StintTime FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsID}'";
	$queryinsert=$class_mysql_default->my_query($insertdocktemp);
	if(!$queryinsert) echo mysql_error();
}*/
//$selectticketmode="SELECT li_LineName,tml_NoOfRunstime,tml_BeginstationID FROM tms_bd_TicketMode  LEFT OUTER JOIN tms_bd_LineInfo 
//	ON tml_LineID = li_LineID WHERE tml_NoOfRunsID = '$NoOfRunsID' AND tml_NoOfRunsdate = '$NoOfRunsdate'";
//$queryticketmode = $class_mysql_default->my_query($selectticketmode);
//$rowticketmode = mysql_fetch_array($queryticketmode);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>修改运行小时数</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<link href="../js/ui/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript">
		function modetime(){
			var str=false;
			var num=document.getElementById("num").value;
			for(var i=2;i<=num*1;i++){
				var Hours='newHours'+i;
				var Minutes='newHMinutes'+i;
				if(document.getElementById(Hours).value!='' || document.getElementById(Minutes).value!=''){
					str=true;
				}
			} 
			if(!str){
				alert('没有修改运行小时数！');
				return false;
			} 
			for(var i=2;i<=num*1;i++){
				var Hours='newHours'+i;
				var Minutes='newHMinutes'+i;
				var Site='SiteName'+i;
				for(var j=2;j<=num*1;j++){
					if(i!=j){
						var Hour='newHours'+j;
						var Minute='newHMinutes'+j;
						var OHour='oldHours'+j;
						var OMinute='oldHMinutes'+j;
						var Sit='SiteName'+j;
						var Hoursi=document.getElementById(Hours).value;
						var Minutesi=document.getElementById(Minutes).value;
						var Hourj=document.getElementById(Hour).value;
						var Minutej=document.getElementById(Minute).value;
						var OHourj=document.getElementById(OHour).value;
						var OMinutej=document.getElementById(OMinute).value;
						if((Hoursi!='' || Minutesi!='') && (Hourj!='' || Minutej!='')){
							if(Hoursi==''){
								Hoursi=0;
							}
							if(Minutesi==''){
								Minutesi=0;
							}
							var alltimei=Hoursi*60+Minutesi*1;
							if(Hourj==''){
								Hourj=0;
							}
							if(Minutej==''){
								Minutej=0;
							}
							var alltimej=Hourj*60+Minutej*1;
							if(j>i){
								if (alltimei*1>=alltimej*1){
									alert('站点'+document.getElementById(Site).value+'的运行时间不能大于站点'+document.getElementById(Sit).value+'的运行时间！');
									return false;
								}
							}
							if(j<i){
								if (alltimei*1<=alltimej*1){
									alert('站点'+document.getElementById(Sit).value+'的运行时间不能大于站点'+document.getElementById(Site).value+'的运行时间！');
									return false;
								}
							}
						}else{
							if((Hoursi!='' || Minutesi!='') && (OHourj!='' || OMinutej!='')){
								if(Hoursi==''){
									Hoursi=0;
								}
								if(Minutesi==''){
									Minutesi=0;
								}
								var alltimei=Hoursi*60+Minutesi*1;
								if(OHourj==''){
									Hourj=0;
								}
								if(OMinutej==''){
									OMinutej=0;
								}
								var alltimej=OHourj*60+OMinutej*1;
								if(j>i){
									if (alltimei*1>=alltimej*1){
										alert('站点'+document.getElementById(Site).value+'的运行时间不能大于站点'+document.getElementById(Sit).value+'的运行时间！');
										return false;
									}
								}
								if(j<i){
									if (alltimei*1<=alltimej*1){
										alert('站点'+document.getElementById(Sit).value+'的运行时间不能大于站点'+document.getElementById(Site).value+'的运行时间！');
										return false;
									}
								}
							}
						}
					}
				}
			} 
			document.form1.submit();
		}
		function isnumber(number,id){
			if(number!=''){
				if (!number.match(/^[1-9]+[0-9]*$/)){
					alert("请输入整数！");
					document.getElementById(id).value="";
					return false;
				}
			}
		}
		function isnumbers(number,id){
			if(number!=''){
				if (!number.match(/^[1-9]+[0-9]*$/)){
					alert("请输入整数！");
					document.getElementById(id).value="";
					return false;
				}
				if(document.getElementById(id).value>=60){
					alert("该值不能大于59！");
					document.getElementById(id).value="";
					return false;
				}
			}		
		}
/*		function getreach(){
			var str=document.getElementById("from").value.split(',');
			document.getElementById("FromStationID").value=str[0];
			document.getElementById("BeginStationTime").value=str[1];
			document.getElementById("BeginStationTim").value=str[1];
			$("#reach").empty();
			jQuery.get(
				'tms_v1_schedule_dataops.php',
				{'op': 'appendreach', 'FromStationID':$("#FromStationID").val(),'NoOfRunsID':$("#NoOfRunsID").val(),'NoOfRunsdate':$("#NoOfRunsdate").val(),
					'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if(objData.retVal=='FAIL'){
						alert(objData.retString);
					}else{
						$("<option></option>").appendTo($("#reach"));
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].ReachStationID + "," + objData[i].StopStationTime +"," +objData[i].RunHours + ">" + objData[i].ReachStation + "</option>").appendTo($("#reach"));
						}
					}
			});
		}
		function getreachid(){
			var str=document.getElementById("reach").value.split(',');
			document.getElementById("ReachStationID").value=str[0];
			document.getElementById("StopStationTime").value=str[1];
			document.getElementById("StopStationTime").value=str[1];
			if(str[2] && str[2]!='null'){
				var Runhours=str[2].split(':');
				document.getElementById("Hours").value=Runhours[0];
				document.getElementById("Minutes").value=Runhours[1];
				document.getElementById("Hour").value=Runhours[0];
				document.getElementById("Minute").value=Runhours[1];
			}
		} */
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
		<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
		<span class="graytext" style="margin-left:8px;">修改运行小时数</span></td>
	</tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路：</span></td>
		<td nowrap="nowrap"><input type="text" id="Linename" name="Linename" disabled="disabled" value="<?php echo $rowline['li_LineName'];?>"/></td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：</span></td>
		<td nowrap="nowrap">
			<input type="text" id="NoOfRunsI" name="NoOfRunsI"  disabled="disabled" value="<?php echo $NoOfRunsID;?>"/>
			<input type="hidden" id="NoOfRunsID" name="NoOfRunsID" value="<?php echo $NoOfRunsID;?>"/>
			<input type="hidden" id="Departuretime" name="Departuretime" value="<?php echo $Departuretime;?>"/>
		</td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车日期：</span></td>
		<td nowrap="nowrap">
			<input type="hidden" id="NoOfRunsdate" name="NoOfRunsdate" value="<?php echo $NoOfRunsdate;?>"/>
			<input type="text" id="NoOfRunsdat" name="NoOfRunsdat"  disabled="disabled" value="<?php echo $NoOfRunsdate;?>"/>
		</td>
	</tr>
</table>
<table width="100%" align="center" class="main_tableboder" id="table1" border="1" cellpadding="3" cellspacing="1"> 
  <tr>
    <td nowrap="nowrap" align="center" bgcolor="#006699"><font color="white">站点序号</font></td>
    <td nowrap="nowrap" align="center" bgcolor="#006699"><font color="white">站点名</font></td>
    <td nowrap="nowrap" align="center" bgcolor="#006699"><font color="white">发车时间</font></td>
    <td nowrap="nowrap" align="center" bgcolor="#006699"><font color="white">原运行时间</font></td>
    <td nowrap="nowrap" align="center" bgcolor="#006699"><font color="white">新运行时间</font></td>
  </tr> 
	<?php
		$i=0;
		$selectdocktemp1="SELECT ndst_ID,ndst_SiteName,ndst_SiteID,ndst_DepartureTime,ndst_RunHours FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID}' AND
			ndst_NoOfRunsdate='{$NoOfRunsdate}' AND ndst_ID>='{$rowID['ndst_ID']}'";
		$querydocktemp1=$class_mysql_default->my_query($selectdocktemp1);
		while($rowdocktemp1=mysql_fetch_array($querydocktemp1)){
			$i++;
	?>
	<tr  bgcolor="#FFFFFF">
		<td nowrap="nowrap" align="center" bgcolor="#FFFFFF"><?php echo $rowdocktemp1['ndst_ID'];?></td>
		<td nowrap="nowrap" align="center" bgcolor="#FFFFFF"><?php echo $rowdocktemp1['ndst_SiteName'];?></td>
		<td nowrap="nowrap" align="center" bgcolor="#FFFFFF">
			<input type="hidden" name="oldDepartureTime<?php echo $i;?>" id="oldDepartureTime<?php echo $i;?>" value="<?php echo $rowdocktemp1['ndst_DepartureTime'];?>"/>
			<?php echo $rowdocktemp1['ndst_DepartureTime'];?>
		</td>
		<td nowrap="nowrap" align="center" bgcolor="#FFFFFF">
		<?php 
			$Hours='';
        	$Minutes=''; 
        	$RunHours=explode(":", $rowdocktemp1['ndst_RunHours']);
        	if($RunHours[0]) $Hours=$RunHours[0].'小时';
        	if($RunHours[1]) $Minutes=$RunHours[1].'分钟';    
        	echo $Hours.$Minutes;
		?>
		<input type="hidden" name="SiteID<?php echo $i;?>" id="SiteID<?php echo $i;?>" value="<?php echo $rowdocktemp1['ndst_SiteID'];?>"/>
		<input type="hidden" name="ID<?php echo $i;?>" id="ID<?php echo $i;?>" value="<?php echo $rowdocktemp1['ndst_ID'];?>"/>
		<input type="hidden" name="SiteName<?php echo $i;?>" id="SiteName<?php echo $i;?>" value="<?php echo $rowdocktemp1['ndst_SiteName'];?>"/>
		<input type="hidden" name="oldHours<?php echo $i;?>" id="oldHours<?php echo $i;?>" value="<?php if($RunHours[0]) echo $RunHours[0];?>"/>
		<input type="hidden" name="oldHMinutes<?php echo $i;?>" id="oldHMinutes<?php echo $i;?>" value="<?php if($RunHours[1]) echo $RunHours[1];?>"/>
		</td>
		<td nowrap="nowrap" align="center" bgcolor="#FFFFFF">
			<?php 
				if($rowdocktemp1['ndst_ID']>$rowID['ndst_ID']){
			?>
				<input type="text" size="8" name="newHours<?php echo $i;?>" id="newHours<?php echo $i;?>" onkeyup="isnumber(this.value,this.id)"/>小时
				<input type="text" size="8" name="newHMinutes<?php echo $i;?>" id="newHMinutes<?php echo $i;?>" onkeyup="isnumbers(this.value,this.id)"/>分钟
			<?php }?>
		</td>
	</tr>
	<?php
		} 
	?>
<!--  	
	<tr  bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 出发站：</span></td>
		<td bgcolor="#FFFFFF">
    		<select name="from" id="from" onchange="getreach()">
    			<option></option>
    			<?php
    				$selectfrom="SELECT DISTINCT pd_FromStationID,pd_FromStation,pd_BeginStationTime FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID='{$NoOfRunsID}' AND
    					pd_NoOfRunsdate='{$NoOfRunsdate}'";
    				$queryfrom=$class_mysql_default->my_query($selectfrom);
    				while($rowfrom=mysql_fetch_array($queryfrom)){
    			?>
    			<option value="<?php echo $rowfrom['pd_FromStationID'].','.$rowfrom['pd_BeginStationTime'];?>"><?php echo $rowfrom['pd_FromStation'];?></option>
    			<?php
					}
    			?>
    		</select>
    			<input type="hidden" name="FromStationID" id="FromStationID"/>
    			<span style="color:red">*</span>
    	</td> 
	</tr>
	<tr  bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 出发时间：</span></td>
		<td nowrap="nowrap">
			<input type="hidden" name="BeginStationTime" id="BeginStationTime" />
			<input type="text" name="BeginStationTim" id="BeginStationTim"  disabled="disabled"/>
		</td>
	</tr>
	<tr  bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 到达站：</span></td>
		<td bgcolor="#FFFFFF">
    		<select name="reach" id="reach" onchange="getreachid()">
    			<option></option>
    		</select>&nbsp;&nbsp;&nbsp;&nbsp;
    		&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red">*</span>
    		<input type="hidden" name="ReachStationID" id="ReachStationID"/>
    		
    	</td> 
	</tr>
	<tr  bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 到达时间：</span></td>
		<td nowrap="nowrap">
			<input type="hidden" name="StopStationTime" id="StopStationTime" />
			<input type="text" name="StopStationTim" id="StopStationTim"  disabled="disabled"/>
		</td>
	</tr>
	<tr  bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 原运行时间：</span></td>
		<td nowrap="nowrap">
			<input type="hidden" name="Hours" id="Hours" />
			<input type="hidden" name="Minutes" id="Minutes"/>
			<input type="text" name="Hour" id="Hour" disabled="disabled"/>小时
			<input type="text" name="Minute" id="Minute" disabled="disabled"/>分钟
		</td>
	</tr>
	<tr  bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 新运行时间：</span></td>
		<td nowrap="nowrap">
			<input type="text" name="newHours" id="newHours" />小时
			<input type="text" name="newMinutes" id="newMinutes"/>分钟
			<span style="color:red">*</span>
		</td>
	</tr>
-->
	<tr>
		<td colspan="5" align="center" bgcolor="#FFFFFF">
			<input type="hidden" name="num" id="num" value="<?php echo $i;?>"/>
			<input type="button" name="modtime" id="modtime" value="修改" onclick="return modetime()"/>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button" name="back" id="back" value="返回" onclick="location.assign('tms_v1_schedule_noofrun.php')"/>&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?php 
	if(isset($_POST['NoOfRunsID'])){
		$NoOfRunsID=$_POST['NoOfRunsID'];
		$NoOfRunsdate=$_POST['NoOfRunsdate'];
		$Departuretime=$_POST['Departuretime'];
		$num=$_POST['num'];
		$difftime=0;
		$class_mysql_default->my_query("START TRANSACTION");
		$queryString = "SELECT tml_BeginstationID, tml_Beginstation FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$NoOfRunsID') AND (tml_NoOfRunsdate = '$NoOfRunsdate') FOR UPDATE";
	  	$result = $class_mysql_default->my_query("$queryString");
		if(!$result){
			$class_mysql_default->my_query("ROLLBACK");
			echo "<script>alert('锁定票版失败！');window.location.href='tms_v1_schedule_modrunhours.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$Departuretime'</script>";
			exit();
		}  
		for($i=1;$i<=$num;$i++){
			$IDs='ID'.$i;
			$newHourss='newHours'.$i;
			$newHMinutess='newHMinutes'.$i;
			$oldHourss='$oldHours'.$i;
			$oldHMinutess='odlHMinutes'.$i;
			$oldDepartureTimeT='oldDepartureTime'.$i;
			$ID=$_POST[$IDs];
			$newHours=$_POST[$newHourss];
			$newHMinutes=$_POST[$newHMinutess];
			$oldHours=$_POST[$oldHourss];
			$oldHMinutes=$_POST[$oldHMinutess];
			$oldDepartureTime=$_POST[$oldDepartureTimeT];
			$allRunminutes=0;
			$Runtimes='';
			if($newHours==''){
				$newHours=0;
			}
			if($newHMinutes==''){
				$newHMinutes=0;
			}
			if($ID>1){
				if($newHours!=0 || $newHMinutes!=0){
					if($Departuretime){
						$Runtimes=$newHours.':'.$newHMinutes;
						$allRunminutes=$newHours*60+$newHMinutes;
						$GettoTime=date('H:i', strtotime ('+'.$allRunminutes.' minute', strtotime($Departuretime)));
						$updatedocktemp="UPDATE tms_bd_NoRunsDockSiteTemp SET ndst_RunHours='{$Runtimes}',ndst_DepartureTime='{$GettoTime}' WHERE ndst_NoOfRunsID='{$NoOfRunsID}' AND 
							ndst_NoOfRunsdate='{$NoOfRunsdate}' AND ndst_ID='{$ID}'";
					}else{
						if($oldDepartureTime && ($oldHours!=0 || $oldHMinutes!=0)){
							$Runtimes=$newHours.':'.$newHMinutes;
							$diffminutes=$newHours*60+$newHMinutes-$oldHours*60+$oldHMinutes;
							$GettoTime=date('H:i', strtotime ('+'.$diffminutes.' minute', strtotime($oldDepartureTime)));
							$updatedocktemp="UPDATE tms_bd_NoRunsDockSiteTemp SET ndst_RunHours='{$Runtimes}',ndst_DepartureTime='{$GettoTime}' WHERE ndst_NoOfRunsID='{$NoOfRunsID}' AND 
								ndst_NoOfRunsdate='{$NoOfRunsdate}' AND ndst_ID='{$ID}'";
						}else{
							$Runtimes=$newHours.':'.$newHMinutes;
							$updatedocktemp="UPDATE tms_bd_NoRunsDockSiteTemp SET ndst_RunHours='{$Runtimes}'WHERE ndst_NoOfRunsID='{$NoOfRunsID}' AND 
								ndst_NoOfRunsdate='{$NoOfRunsdate}' AND ndst_ID='{$ID}'";
						}
					}
					$querydocktemp=$class_mysql_default->my_query($updatedocktemp);
					if(!$querydocktemp) echo mysql_error();
					if(!$querydocktemp){
						$class_mysql_default->my_query("ROLLBACK");
						echo "<script>alert('更新临时停靠点数据失败！');window.location.href='tms_v1_schedule_modrunhours.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$Departuretime'</script>";
						exit();
					}
					if($i==$num){
						$updateticketmode="UPDATE tms_bd_TicketMode SET tml_RunHours='{$Runtimes}' WHERE tml_NoOfRunsID='{$NoOfRunsID}' AND tml_NoOfRunsdate='{$NoOfRunsdate}'";
						$queryupdatemode=$class_mysql_default->my_query($updateticketmode);
						if(!$queryupdatemode){
							$class_mysql_default->my_query("ROLLBACK");
							echo "<script>alert('更新票版数据失败！');window.location.href='tms_v1_schedule_modrunhours.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$Departuretime'</script>";
							exit();
						}
					} 
				}
			}
		}
		$selectdocksitetemp="SELECT ndst_ID,ndst_SiteName,ndst_SiteID,ndst_DepartureTime,ndst_RunHours FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID}' AND 
			ndst_NoOfRunsdate='{$NoOfRunsdate}' AND ndst_GetOnSite=1";
		$querydocksitetemp=$class_mysql_default->my_query($selectdocksitetemp);
		if(!$querydocksitetemp){
			$class_mysql_default->my_query("ROLLBACK");
			echo "<script>alert('查询临时停靠点1数据失败！');window.location.href='tms_v1_schedule_modrunhours.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$Departuretime'</script>";
			exit();
		}
		while($rowdocksitetemp=mysql_fetch_array($querydocksitetemp)){
			$IDtemp=$rowdocksitetemp['ndst_ID'];
			$FromStationID=$rowdocksitetemp['ndst_SiteID'];
			$BeginStationTime=$rowdocksitetemp['ndst_DepartureTime'];
			$ndsRunHours1=$rowdocksitetemp['ndst_RunHours'];
			$selectdocksitetemp1="SELECT ndst_SiteID,ndst_DepartureTime,ndst_RunHours FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID}' AND ndst_NoOfRunsdate='{$NoOfRunsdate}' AND 
				ndst_ID>'{$IDtemp}' AND ndst_IsDock=1";
			$querydocksitetemp1=$class_mysql_default->my_query($selectdocksitetemp1);
			if(!$querydocksitetemp1){
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('查询临时停靠点2数据失败！');window.location.href='tms_v1_schedule_modrunhours.php?nrID=$NoOfRunsID&nrDate=$NoOfRunsdate&dtime=$Departuretime'</script>";
				exit();
			}
			while($rowdocksitetemp1=mysql_fetch_array($querydocksitetemp1)){
				$ReachStationID=$rowdocksitetemp1['ndst_SiteID'];
				$StopStationTime=$rowdocksitetemp1['ndst_DepartureTime'];
				$ndsRunHours2=$rowdocksitetemp1['ndst_RunHours'];
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
	  	echo "<script>alert('修改运行小时数成功！');window.location.href='tms_v1_schedule_noofrun.php?op=none'</script>";  
	}
?>