<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$NoOfRunsID = $_GET['nrID'];
	$NoOfRunsdate = $_GET['nrDate'];
	$isAllTicket = $_GET['allt'];
?>
	
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>查询班次售票情况</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<link href="../css/tms.css" rel="stylesheet" type="text/css" />
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
		<td><input disabled="disabled" type="text" id="NoOfRunsID" name="NoOfRunsID" readonly="readonly" value="<?php echo $NoOfRunsID;?>"/></td>
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车日期：</span></td>
		<td><input disabled="disabled" type="text" id="NoOfRunsdate" name="NoOfRunsdate" readonly="readonly" value="<?php echo $NoOfRunsdate;?>"/></td>
		<td><input type="button" name="back" id="back" value="返回" onclick="history.back()"/></td>
	</tr>
</table>
<?php if ($isAllTicket == "否") {?>
<iframe frameborder="1" id="heads" width="100%" scrolling="auto" src="tms_v1_schedule_seatview.php?nrID=<?=$NoOfRunsID?>&nrDate=<?=$NoOfRunsdate?>"></iframe>
<?php }?>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
	<tr>
		<th nowrap="nowrap" align="center" bgcolor="#006699">到达站</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">售票数</th>
	</tr>
	</thead>
	<tbody class="scrollContent"> 
<?php 
	$select="SELECT st_ReachStation, SUM( st_TotalMan ) AS Numbers FROM tms_sell_SellTicket WHERE st_NoOfRunsID='{$NoOfRunsID}' AND st_NoOfRunsdate='{$NoOfRunsdate}' GROUP BY st_ReachStationID";
	$query=$class_mysql_default->my_query($select);
	$all=0;
	//if(!$query) echo ->my_error();
	while($rows = mysqli_fetch_array($query)){
		$all=$all+$rows['Numbers'];
?>
	<tr align="center" bgcolor="#CCCCCC">
		<td nowrap="nowrap"><?=$rows['st_ReachStation']?></td>
		<td nowrap="nowrap"><?=$rows['Numbers']?></td>
	</tr>
	<?php }?>
	<tr align="center" bgcolor="#CCCCCC">
		<td nowrap="nowrap"><?php echo '总计';?></td>
		<td nowrap="nowrap"><?php echo $all;?></td>
	</tr>
	</tbody>
</table>
</div>

</form>
</body>
</html>