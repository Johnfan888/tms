﻿
<?php
	define("AUTH", "TRUE");
	require_once("../inc/init.inc.php");
	require_once("../inc/auth.php");
	$DataBeginDate=date('Y-m-d');
	$DataEndDate=date('Y-m-d');
		$state = $_REQUEST['state'];	//班次类别
		$noofrunStatus = $_REQUEST['statusselect']; //班次状态
		$carstate = $_REQUEST['carstate']; //报道状况
		$schStation = $_REQUEST['stationselect']; //发车站
//		$DataBeginDate = $_REQUEST['DataBeginDate']; //开始日期
//		$DataEndDate = $_REQUEST['DataEndDate']; //结束日期
		$strStatus = "";
		$strRun="";
   	 	$strRuned="";
    	$strChecked="";
		if($noofrunStatus=='1'){ //全部
			$strStatus="";
		}
		if($noofrunStatus=='2'){ //在售
		//	$strStatus=" AND tml_AllowSell='1' AND tml_StopRun='0'";
			$strStatus=" AND tml_AllowSell='1'";
			$strRun=" AND rt_Register!='已发车'";
		}
		if($noofrunStatus=='3'){ //暂停
		//	$strStatus=" AND tml_AllowSell='0' AND tml_StopRun='0'";
			$strStatus=" AND tml_AllowSell='0'";
		//	$strRuned=" AND rt_Register!='已发车'";
		}
		if($noofrunStatus=='4'){//发班
		//	$strStatus=" AND tml_StopRun='1'";
			$strRuned=" AND rt_Register='已发车'";
		}
		if($noofrunStatus=='5'){//检票
		//	$strStatus=" AND tml_StopRun='2'";
			$strChecked=" AND ct_Flag='1'";
		}
		if($noofrunStatus=='6'){//并班
			$strStatus=" AND tml_StopRun='3'";
		}
		
		
		if ($DataBeginDate != "" && $DataEndDate == ""){ //发车日期处理
 			$strDate="AND tml_NoOfRunsdate >='{$DataBeginDate}'";
 		}
 		if ($DataBeginDate == "" && $DataEndDate != ""){
 			$strDate="AND tml_NoOfRunsdate <='{$DataEndDate}'";
 		}
 		if ($DataBeginDate != "" && $DataEndDate != ""){
 			$strDate="AND tml_NoOfRunsdate >='{$DataBeginDate}' AND tml_NoOfRunsdate <='{$DataEndDate}'";
 		}
 		if($DataBeginDate == "" && $DataEndDate == ""){
 			$strDate = '';
 		}
 		
		$strsta=''; //班次类别处理
  		if($state == "" || $state == "普通班次"){
  			$strsta=" AND tml_NoOfRunsID not like '%加%'";
  		}
  		if($state == "加班班次"){
  		$strsta=" AND tml_NoOfRunsID  like '%加%'";	
  		}
  		if($state == "全部班次"){
  		$strsta == '';	
  		}
  		$strstate = "";
  		{
  			if($carstate == "全部"){
  				$strstate="";
  			}
  			if($carstate == "未报到"){
  			   $strstate="AND ((tml_NoOfRunsID) NOT IN (SELECT rt_NoOfRunsID FROM tms_sch_Report WHERE rt_NoOfRunsdate=tml_NoOfRunsdate) OR bi_BusUnit != tml_BusUnit)";
  			}
  			if($carstate == "已报到"){
  			  // $strstate="AND bi_BusUnit = tml_BusUnit";
  			  $strstate="AND ((tml_NoOfRunsID)  IN (SELECT rt_NoOfRunsID FROM tms_sch_Report WHERE rt_NoOfRunsdate=tml_NoOfRunsdate) AND  bi_BusUnit = tml_BusUnit)";
  			}
  		}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
	<head> 
	<script type="text/javascript" src="../../js/jquery.js"></script>
	<script type="text/javascript" src="../../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script language="javascript" type="text/javascript" src="../../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="tms_v1_rightclick.js"></script>
	<link href="../images/style_main.css" rel="stylesheet" type="text/css">
	<link href="../../css/tms.css" rel="stylesheet" type="text/css">
	<script>
	$(document).ready(function(){
		$("#table1").tablesorter();
	});
	</script>
	</head>
	<body bgcolor=#F5F5F5>
	<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  	<tr>
    	<td bgcolor="#F0F8FF"><img src="../images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    	<span class="graytext" style="margin-left:8px;"> 今 日 班 次</span></td>
  	</tr>
	</table>
	<form method="post" name="form1" action="">
	<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1" style="display: none">
	 <tr>
	    <td  bgcolor="#FFFFFF"><span class="form_title"><img src="../images/sj.gif" width="6" height="7" />班次类别：</span></td>
	    <td bgcolor="#FFFFFF">
		    <select name="state" id="state" style="width:100px">
	 			<?php 
	 			if($state == "普通班次"){
	 			?>
	 			<option value="普通班次" selected="selected">普通班次</option>
	 			<option value="加班班次" >加班班次</option>
	 			<option value="全部班次">全部班次</option>
	 			<?php 
	 			}
	 			if($state == "加班班次"){
	 			?>
	 			<option value="普通班次">普通班次</option>
	 			<option value="加班班次"  selected="selected">加班班次</option>
	 			<option value="全部班次">全部班次</option>
	 			<?php 
	 			}
	 			if($state == "全部班次"){
	 			?>
	 			<option value="普通班次">普通班次</option>
	 			<option value="加班班次" >加班班次</option>
	 			<option value="全部班次"  selected="selected">全部班次</option>
	 			<?php 
	 			}
	 			if($state == ""){
	 			?>
	 			<option value="普通班次">普通班次</option>
	 			<option value="加班班次" >加班班次</option>
	 			<option value="全部班次"  selected="selected">全部班次</option>
	 			<?php 
	 			}
	 			?>
	 		</select>
	    </td>
	    <td  bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次状态：</span></td>
	    <td bgcolor="#FFFFFF">
	    	<select name="statusselect" id="statusselect" style="width:100px">
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
	  
	    <td  bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车辆报到状况：</span></td>
	    <td  bgcolor="#FFFFFF">
		     <select name="carstate" id="state" style="width:100px">
		 			<?php 
		 			if($carstate == "未报到"){
		 			?>
		 			<option value="未报到" selected="selected">未报到</option>
		 			<option value="已报到" >已报到</option>
		 			<option value="全部">全部</option>
		 			<?php 
		 			}
		 			if($carstate == "已报到"){
		 			?>
		 			<option value="未报到">未报到</option>
		 			<option value="已报到"  selected="selected">已报到</option>
		 			<option value="全部">全部</option>
		 			<?php 
		 			}
		 			if($carstate == "全部"){
		 			?>
		 			<option value="未报到">未报到</option>
		 			<option value="已报到">已报到</option>
		 			<option value="全部"  selected="selected">全部</option>
		 			<?php 
		 			}
		 			if($carstate == ""){
		 			?>
		 			<option value="未报到">未报到</option>
		 			<option value="已报到">已报到</option>
		 			<option value="全部"  selected="selected">全部</option>
		 			<?php 
		 			}
		 			?>
		 		</select>
	    </td>
	 </tr>
	 <tr> 
	 	<td  bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />发车站：</span></td> 
		<td  bgcolor="#FFFFFF"> 	
		 	<select id="stationselect" name="stationselect" size="1" style="width:100px">
	            <?php
	            	if($userStationName == "全部车站") {
	            ?>
					<?php if ($schStation == "") { ?>
						<option value="" selected="selected">请选择车站</option>
					<?php } else { ?>
						<option value="<?php echo $schStation?>" selected="selected"><?php echo $schStation?></option>
					<?php } ?>
				<?php 
						$queryString = "SELECT DISTINCT sset_SiteName FROM tms_bd_SiteSet WHERE sset_IsStation=1";
						$result = $class_mysql_default->my_query("$queryString");
				        while($res = mysql_fetch_array($result)) {
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
		    <td  bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />发车日期：</span></td>
		    <td colspan="2" nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="DataBeginDate" id="DataBeginDate" class="Wdate" value="<?php echo $DataBeginDate;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" />
		    		&nbsp;&nbsp;至&nbsp;&nbsp;<input type="text" name="DataEndDate" id="DataEndDate" class="Wdate" value="<?php echo $DataEndDate;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
		    <td  bgcolor="#FFFFFF">
		    	<input type="submit" name="resultquery" id="resultquery" value="查询" />&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="submit" name="exceldoc" id="exceldoc" value="导出Excel" />
		    </td>	
		 </tr>
		</table>
<div id="tableContainer" class="tableContainer" > 
	<table class="main_tableboder" id="table1" > 
		<thead class="fixedHeader">
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">序号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">线路名称</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">运行小时数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">座位数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">已售</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">状态</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">检票口</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">通票</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">加班</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">始发</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">途经站</th>
			</tr>
		</thead>
		<tbody class="scrollContent">
		<?php 
			//$strsqlselet = "SELECT * FROM tms_bd_TicketMode where tml_Beginstation like '$schStation'".$strDate.$strsta.$strStatus;
			$strsqlselet = "SELECT tml_AllowSell,tml_StopRun,tml_NoOfRunsID,tml_BusUnit,tml_Endstation,tml_NoOfRunsdate,tml_TotalSeats,tml_LeaveSeats,tml_BusModel,tml_Allticket,tml_Beginstation,
							rt_ReportDateTime,rt_BusCard,rt_BusModel,rt_SeatNum,rt_Driver,rt_Driver1,bi_BusUnit,nri_LineName,nri_OperateCode,nri_AddNoRuns,rt_Register,ct_Flag,pd_FromStation,pd_FromStationID,
							tml_RunHours,pd_BeginStationTime,pd_BeginStationTime  FROM tms_bd_TicketMode  
						    LEFT OUTER JOIN tms_sch_Report ON tml_NoOfRunsID = rt_NoOfRunsID AND rt_ReportDateTime=(SELECT max(rt_ReportDateTime) FROM tms_sch_Report WHERE 
							rt_NoOfRunsID=tml_NoOfRunsID AND rt_NoOfRunsdate=tml_NoOfRunsdate AND rt_AttemperStation LIKE '{$schStation}%') AND tml_NoOfRunsdate = rt_NoOfRunsdate AND rt_AttemperStation LIKE '{$schStation}%'".$strRun."
							LEFT OUTER JOIN tms_bd_BusInfo ON rt_BusCard=bi_BusNumber
							LEFT OUTER JOIN tms_bd_PriceDetail ON tml_NoOfRunsID=pd_NoOfRunsID AND tml_NoOfRunsdate=pd_NoOfRunsdate
							LEFT OUTER JOIN tms_bd_NoRunsInfo ON tml_NoOfRunsID=nri_NoOfRunsID 
							LEFT OUTER JOIN tms_chk_CheckTemp ON ct_NoOfRunsID=rt_NoOfRunsID AND ct_NoOfRunsdate=rt_NoOfRunsdate AND ct_BusID=rt_BusID AND ct_ReportDateTime=rt_ReportDateTime
							WHERE pd_FromStation like '$schStation%'".$strDate.$strsta.$strStatus.$strstate.$strRuned.$strChecked."GROUP BY pd_NoOfRunsID,pd_NoOfRunsdate";	
			$resultselet = $class_mysql_default ->my_query("$strsqlselet");
			if(!$resultselet) echo mysql_error();
			$i = 0;
			while($rows = @mysql_fetch_array($resultselet))	{
				$i++;
				$str="SELECT GROUP_CONCAT(DISTINCT ndst_SiteName ORDER BY ndst_ID ASC) AS SiteName from tms_bd_NoRunsDockSiteTemp 
					  WHERE ndst_NoOfRunsID='{$rows['tml_NoOfRunsID']}' AND ndst_NoOfRunsdate='{$rows['tml_NoOfRunsdate']}' AND 
					  ndst_ID>=(SELECT ndst_ID FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$rows['tml_NoOfRunsID']}' 
					  AND ndst_NoOfRunsdate='{$rows['tml_NoOfRunsdate']}' AND ndst_SiteID='{$rows['pd_FromStationID']}') AND (ndst_SiteID IN (SELECT 
					  pd_FromStationID FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID='{$rows['tml_NoOfRunsID']}' AND
					  pd_NoOfRunsdate='{$rows['tml_NoOfRunsdate']}') OR ndst_SiteID IN (SELECT 
					  pd_ReachStationID FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID='{$rows['tml_NoOfRunsID']}' AND
					  pd_NoOfRunsdate='{$rows['tml_NoOfRunsdate']}'))
					  GROUP BY ndst_NoOfRunsID,ndst_NoOfRunsdate";
				$result2 = $class_mysql_default ->my_query("$str");
				$rows2=mysql_fetch_array($result2);
				if($rows['tml_AllowSell']==0 && $rows['tml_StopRun']==0) $curStatus = '暂停';  //蓝色
				if(!$rows['rt_Register']){
					if($rows['tml_AllowSell']==1) $curStatus = '在售';  //绿色
				}else{
					if($rows['tml_AllowSell']==1 && $rows['rt_Register']=='未发车') $curStatus = '在售';  //绿色
				}	
				if($rows['rt_Register']=='已发车'){
					if($rows['tml_Allticket']==1) $curStatus = '在售';  //绿色
					else $curStatus = '发班'; //红色
				}
				if($rows['ct_Flag']=='1'){
					if($rows['tml_Allticket']==1) $curStatus = '在售';  //绿色 
					else $curStatus = '检票'; //黄色
				}
				if($rows['tml_StopRun']==3) $curStatus = '并班'; //褐色
				if($rows['rt_CheckTicketWindow']) $RealCheckTicketWindow = $rows['rt_CheckTicketWindow']; 
					else $RealCheckTicketWindow = $rows['tml_CheckTicketWindow'];
		?>
			<tr align="center" bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?=$i?></td>
				<td nowrap="nowrap"><?=$rows['tml_NoOfRunsID']?></td>
				<td nowrap="nowrap"><?=$rows['nri_LineName']?></td>
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
				<td nowrap="nowrap"><?=$RealCheckTicketWindow?></td>
				<td nowrap="nowrap"><? if($rows['tml_Allticket']==0) echo '否'; else echo '是';?></td>
				<td nowrap="nowrap"><? if($rows['nri_AddNoRuns']==0) echo '否'; else echo '是';?></td>
				<td nowrap="nowrap"><? if($userStationName==$rows['tml_Beginstation'] || $userID=='admin') echo '是'; else echo '否';?></td>
				<td nowrap="nowrap"><?=$rows2['SiteName']?></td>
				<?php 
					}
				?>
			</tr>
		</tbody>
	</table>
</div>
		</form>
	</body>
</html>
	
