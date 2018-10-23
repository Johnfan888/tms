<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$NoOfRunsID = $_GET['nrID'];
	$NoOfRunsdate = $_GET['nrDate'];
	$isAllTicket = $_GET['allt'];
	$schStation=$_GET['schS'];
?>
	
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>查询班次售票情况</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
		<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
		<span class="graytext" style="margin-left:8px;">查询班次售票情况</span></td>
	</tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr><td colspan="5">班次信息</td></tr>
	<tr bgcolor="#FFFFFF">
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：</span></td>
		<td><input type="text" id="NoOfRunsID" name="NoOfRunsID" readonly="readonly" value="<?php echo $NoOfRunsID;?>"/></td>
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车日期：</span></td>
		<td><input type="text" id="NoOfRunsdate" name="NoOfRunsdate" readonly="readonly" value="<?php echo $NoOfRunsdate;?>"/></td>
		<td><input type="button" name="back" id="back" value="返回"  onclick="history.back()"/>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	</tr>
</table>
<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder" id="table1">
	<tr bgcolor="#F1E6C2" style="border:1;">
		<td nowrap="nowrap" align="center" bgcolor="#006699"><font color="white">票号</font></td>
		<td nowrap="nowrap" align="center" bgcolor="#006699"><font color="white">座位号</font></td>
		<td nowrap="nowrap" align="center" bgcolor="#006699"><font color="white">售票时间</font></td>
	<!-- 
		<td nowrap="nowrap" align="center" bgcolor="#F1E6C2">签票时间</td>
		<td nowrap="nowrap" align="center" bgcolor="#F1E6C2">退票时间</td>
	 -->
		<td nowrap="nowrap" align="center" bgcolor="#006699"><font color="white">检票时间</font></td>
		<td nowrap="nowrap" align="center" bgcolor="#006699"><font color="white">售票车站</font></td>
		<td nowrap="nowrap" align="center" bgcolor="#006699"><font color="white">到达站</font></td>
	</tr>
<?php 
/*	$select="SELECT st_TicketID,st_SeatID,st_SellDate,st_SellTime,st_Station,st_ReachStation,rtk_SignDate,rtk_SignTime,rtk_ReturnDate,
		rtk_ReturnTime,ctt_CheckDate,ctt_CheckTime,ct_CheckDate,ct_CheckTime,wst_WebSellID,wst_SeatID,wst_PayTradeNo FROM tms_sell_SellTicket LEFT OUTER JOIN 
		tms_sell_ReturnTicket ON rtk_TicketID=st_TicketID LEFT OUTER JOIN tms_chk_CheckTicketTemp ON ctt_TicketID=st_TicketID LEFT OUTER JOIN 
		tms_chk_CheckTicket ON ct_TicketID=st_TicketID LEFT OUTER JOIN tms_websell_WebSellTicket ON wst_NoOfRunsID=st_NoOfRunsID AND 
		wst_NoOfRunsdate=st_NoOfRunsdate AND FIND_IN_SET(st_SeatID,wst_SeatID) WHERE st_NoOfRunsID='{$NoOfRunsID}' AND st_NoOfRunsdate='{$NoOfRunsdate}'"; */
	$select="SELECT st_TicketID,st_SeatID,st_SellDate,st_SellTime,st_Station,st_ReachStation,ctt_CheckDate,ctt_CheckTime,ct_CheckDate,ct_CheckTime,
		wst_WebSellID,wst_SeatID,wst_PayTradeNo 
		FROM tms_sell_SellTicket 
		LEFT OUTER JOIN tms_chk_CheckTicketTemp ON ctt_TicketID=st_TicketID 
		LEFT OUTER JOIN tms_chk_CheckTicket ON ct_TicketID=st_TicketID 
		LEFT OUTER JOIN tms_websell_WebSellTicket ON wst_NoOfRunsID=st_NoOfRunsID AND wst_NoOfRunsdate=st_NoOfRunsdate AND FIND_IN_SET(st_SeatID,wst_SeatID) 
		WHERE st_NoOfRunsID='{$NoOfRunsID}' AND st_NoOfRunsdate='{$NoOfRunsdate}' AND st_FromStation='{$schStation}' 
		AND st_TicketID NOT IN(SELECT rtk_TicketID FROM tms_sell_ReturnTicket WHERE rtk_NoOfRunsID='{$NoOfRunsID}' AND rtk_NoOfRunsdate='{$NoOfRunsdate}') 
		AND st_TicketID NOT IN(SELECT et_TicketID FROM tms_sell_ErrTicket WHERE et_NoOfRunsID='{$NoOfRunsID}' AND et_NoOfRunsdate='{$NoOfRunsdate}')";
	$query=$class_mysql_default->my_query($select);
	$all=0;
	$checknum=0;
	//if(!$query) echo mysql_error();
	while($rows = mysql_fetch_array($query)){
		$all=$all+1;
		if($rows['ctt_CheckDate'] || $rows['ct_CheckDate']){
			$checknum=$checknum+1;
		}
?>
	<tr align="center" bgcolor="#CCCCCC">
		<td nowrap="nowrap"><?=$rows['st_TicketID']?></td>
		<td nowrap="nowrap"><?=$rows['st_SeatID']?></td>	
		<td nowrap="nowrap"><?=$rows['st_SellDate'].' '.$rows['st_SellTime']?></td>
	<!-- 
		<td nowrap="nowrap"><?=$rows['rtk_SignDate'].' '.$rows['rtk_SignTime']?></td>
		<td nowrap="nowrap"><?=$rows['rtk_ReturnDate'].' '.$rows['rtk_ReturnTime']?></td>
	 -->
		<td nowrap="nowrap">
			<?php 
				if($rows['ct_CheckDate']) 
					echo $rows['ct_CheckDate'].' '.$rows['ct_CheckTime'];
				if($rows['ctt_CheckDate'])
					echo $rows['ctt_CheckDate'].' '.$rows['ctt_CheckTime'];
			?>
		</td>
		<td nowrap="nowrap">
			<?php 
				if($rows['wst_WebSellID']=='') 
					echo $rows['st_Station']; 
				else{ 
					if(!strpos($rows['wst_WebSellID'], 'D'))
						echo '留票'.','.$rows['st_Station'].'取';
					else{
						if($rows['wst_PayTradeNo']=='')
							echo '网订'.','.$rows['st_Station'].'取';
						else 
							echo '网售'.','.$rows['st_Station'].'取';
					}
				}	
					
			?>
		</td>
		<td nowrap="nowrap"><?=$rows['st_ReachStation']?></td>
	</tr>
	<?php 
		}
	/*	$selectand="SELECT st_TicketID,st_SeatID,st_SellDate,st_SellTime,st_Station,st_ReachStation,rtk_SignDate,rtk_SignTime,rtk_ReturnDate,
			rtk_ReturnTime,ctt_CheckDate,ctt_CheckTime,wst_WebSellID,wst_SeatID,wst_PayTradeNo FROM tms_sch_AndNoOfRuns LEFT OUTER JOIN 
			tms_sell_SellTicket ON st_NoOfRunsID=anr_NoOfRunsID AND st_NoOfRunsdate=anr_NoOfRunsdate LEFT OUTER JOIN tms_sell_ReturnTicket ON 
			rtk_TicketID=st_TicketID LEFT OUTER JOIN tms_chk_CheckTicketTemp ON ctt_TicketID=st_TicketID LEFT OUTER JOIN tms_chk_CheckTicket ON 
			ct_TicketID=st_TicketID LEFT OUTER JOIN tms_websell_WebSellTicket ON wst_NoOfRunsID=st_NoOfRunsID AND wst_NoOfRunsdate=st_NoOfRunsdate 
			AND FIND_IN_SET(st_SeatID,wst_SeatID) WHERE anr_AndNoOfRunsID='{$NoOfRunsID}' AND anr_AndNoOfRunsdate='{$NoOfRunsdate}'"; */
		$selectand="SELECT st_TicketID,st_SeatID,st_SellDate,st_SellTime,st_Station,st_ReachStation,ctt_CheckDate,ctt_CheckTime,
			wst_WebSellID,wst_SeatID,wst_PayTradeNo
			FROM tms_sell_SellTicket  
			LEFT OUTER JOIN tms_sch_AndNoOfRuns ON st_NoOfRunsID=anr_NoOfRunsID AND st_NoOfRunsdate=anr_NoOfRunsdate 
			LEFT OUTER JOIN tms_sell_ReturnTicket ON rtk_TicketID=st_TicketID 
			LEFT OUTER JOIN tms_chk_CheckTicketTemp ON ctt_TicketID=st_TicketID 
			LEFT OUTER JOIN tms_chk_CheckTicket ON ct_TicketID=st_TicketID 
			LEFT OUTER JOIN tms_websell_WebSellTicket ON wst_NoOfRunsID=st_NoOfRunsID AND wst_NoOfRunsdate=st_NoOfRunsdate AND FIND_IN_SET(st_SeatID,wst_SeatID) 
			WHERE anr_AndNoOfRunsID='{$NoOfRunsID}' AND anr_AndNoOfRunsdate='{$NoOfRunsdate}' AND st_FromStation='{$schStation}'
			AND st_TicketID NOT IN(SELECT rtk_TicketID FROM tms_sell_ReturnTicket) 
			AND st_TicketID NOT IN(SELECT et_TicketID FROM tms_sell_ErrTicket)";
		$queryand=$class_mysql_default->my_query($selectand);
		while($rowsand = mysql_fetch_array($queryand)){
		$all=$all+1;
		if($rowsand['ctt_CheckDate'] || $rowsand['ct_CheckDate']){
			$checknum=$checknum+1;
		}
?>
	<tr align="center" bgcolor="#CCCCCC">
		<td nowrap="nowrap"><?=$rowsand['st_TicketID']?></td>
		<td nowrap="nowrap"></td>
		<td nowrap="nowrap"><?=$rowsand['st_SellDate'].' '.$rowsand['st_SellTime']?></td>
	<!--  
		<td nowrap="nowrap"><?=$rowsand['rtk_SignDate'].' '.$rowsand['rtk_SignTime']?></td>
		<td nowrap="nowrap"><?=$rowsand['rtk_ReturnDate'].' '.$rowsand['rtk_ReturnTime']?></td>
	-->
		<td nowrap="nowrap">
			<?php 
				if($rowsand['ct_CheckDate']) 
					echo $rowsand['ct_CheckDate'].' '.$rowsand['ct_CheckTime'];
				if($rowsand['ctt_CheckDate']) 
					echo $rowsand['ctt_CheckDate'].' '.$rowsand['ctt_CheckTime'];
			?>
		</td>
		<td nowrap="nowrap">
			<?php 
				if($rowsand['wst_WebSellID']=='') 
					echo $rowsand['st_Station']; 
				else{ 
					if(!strpos($rowsand['wst_WebSellID'], 'D'))
						echo '留票'.','.$rowsand['st_Station'].'取';
					else{
						if($rowsand['wst_PayTradeNo']=='')
							echo '网订'.','.$rowsand['st_Station'].'取';
						else 
							echo '网售'.','.$rowsand['st_Station'].'取';
					}
				}	
					
			?>
		</td>
		<td nowrap="nowrap"><?=$rowsand['st_ReachStation']?></td>
	</tr>
	<?php 
		}
	?>
	<tr align="center" bgcolor="#CCCCCC">
		<td nowrap="nowrap"><?php echo '总计'?></td>
		<td colspan="8" align="left" nowrap="nowrap">
			&nbsp;&nbsp;&nbsp;<?php echo "已售：".$all?>&nbsp;&nbsp;&nbsp;<?php echo "已检：".$checknum?>&nbsp;&nbsp;&nbsp;<?php echo "漏检：".($all-$checknum)?>
		</td>
	</tr>
</table>
<?php if ($isAllTicket == "否") {?>
<iframe frameborder="1" id="heads" width="100%" scrolling="auto" src="../schedule/tms_v1_schedule_seatview.php?nrID=<?=$NoOfRunsID?>&nrDate=<?=$NoOfRunsdate?>"></iframe>
<?php }?>
</form>
</body>
</html>
