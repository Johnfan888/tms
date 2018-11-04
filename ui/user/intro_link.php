<?php 
define("AUTH", "TRUE");

//载入初始化文件
require_once("../inc/init.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="../images/style_main.css" rel="stylesheet" type="text/css">

<title>无标题文档</title>
<style type="text/css">
<!--
.STYLE1 {
	font-size: 20px;
	font-weight: bold;
}
-->
</style>

</head>

<body bgcolor="#F5F5F5">

<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1" >
  <tr>
    <td bgcolor="#F0F8FF"><img src="../images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">常 用 功 能 链 接</span></td>
  </tr>
</table>

<?php 
foreach(str_split($userGroupID) as $gid) {
	if($gid=="0"){
?>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../basedata/tms_v1_basedata_searnoruns.php" target="_parent">班次查询</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../basedata/tms_v1_basedata_ticketmodel.php" target="_parent">票版管理</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../basedata/tms_v1_basedata_searticketadd.php" target="_parent">票据管理</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../basedata/tms_v1_basedata_searbus.php" target="_parent">车辆管理</a></span><br>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../sell/tms_v1_sell_query.php" target="_parent">售票</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../sell/tms_v1_sell_sellquery.php" target="_parent">售票统计查询</a></span><br>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../checkin/tms_v1_checkin_checkticket.php" target="_parent">多班检票</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../checkin/tms_v1_checkin_querybalance.php" target="_parent">客凭处理</a></span><br>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../schedule/tms_v1_schedule_noofrun.php" target="_parent">调度日志</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../basedata/tms_v1_basedata_searbus.php" target="_parent">车辆管理</a></span><br>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../accounting/tms_v1_accounting_sellQuery.php" target="_parent">售票营收缴款</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../accounting/tms_v1_accounting_busorunitQuery.php" target="_parent">车辆结账</a></span><br>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../safecheck/tms_v1_safecheck_VehicleCheck.php" target="_parent">车辆安检</a></span><br>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../lugconsign/tms_v1_lugconsign_query.php" target="_parent">行包查询</a></span><br>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../query/tms_v1_query_sellticketquery.php" target="_parent">售票查询</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../query/tms_v1_query_sellsubquery.php" target="_parent">营收查询</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../statistic/tms_v1_statistic_sellReport.php" target="_parent">售票汇总表</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../charterbus/tms_v1_basedata_searcharterebus.php" target="_parent">包车查询</a></span><br>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../sell/tms_v1_service_querynoofruns.php" target="_parent">班次查询</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../servicecenter/tms_v1_servicecenter_broadcastcenter.php" target="_parent">语音播报</a></span><br>
<?php 	}
	if($gid=="1"){
?>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../basedata/tms_v1_basedata_searnoruns.php" target="_parent">班次查询</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../basedata/tms_v1_basedata_ticketmodel.php" target="_parent">票版管理</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../basedata/tms_v1_basedata_searticketadd.php" target="_parent">票据管理</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../basedata/tms_v1_basedata_searbus.php" target="_parent">车辆管理</a></span><br>
<?php 
	}else if($gid=="2"){
?>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../sell/tms_v1_sell_query.php" target="_parent">售票</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../sell/tms_v1_sell_sellquery.php" target="_parent">售票统计查询</a></span><br>
<?php 
	}else if($gid=="3"){
?>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../checkin/tms_v1_checkin_checkticket.php" target="_parent">多班检票</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../checkin/tms_v1_checkin_querybalance.php" target="_parent">客凭处理</a></span><br>
<?php 
	}else if($gid=="4"){
?>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../schedule/tms_v1_schedule_noofrun.php" target="_parent">调度日志</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../basedata/tms_v1_basedata_searbus.php" target="_parent">车辆管理</a></span><br>
<?php 
	}else if($gid=="5"){
?>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../accounting/tms_v1_accounting_sellQuery.php" target="_parent">售票营收缴款</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../accounting/tms_v1_accounting_busorunitQuery.php" target="_parent">车辆结账</a></span><br>
<?php 
	}else if($gid=="6"){
?>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../safecheck/tms_v1_safecheck_VehicleCheck.php" target="_parent">车辆安检</a></span><br>
<?php 
	}else if($gid=="7"){
?>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../lugconsign/tms_v1_lugconsign_query.php" target="_parent">行包查询</a></span><br>
<?php 
	}else if($gid=="8"){
?>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../query/tms_v1_query_sellticketquery.php" target="_parent">售票查询</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../query/tms_v1_query_sellsubquery.php" target="_parent">营收查询</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../statistic/tms_v1_statistic_sellReport.php" target="_parent">售票汇总表</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
	}else if($gid=="9"){
?>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../charterbus/tms_v1_basedata_searcharterebus.php" target="_parent">包车查询</a></span><br>
<?php 
	}else if($gid=="A"){
?>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../sell/tms_v1_service_querynoofruns.php" target="_parent">班次查询</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../servicecenter/tms_v1_servicecenter_broadcastcenter.php" target="_parent">语音播报</a></span><br>
<?php
	} else if($gid=="E"){
?>
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../basedata/tms_v1_basedata_searticketadd.php" target="_parent">票据管理</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sj.gif" width="6" height="7" />&nbsp;<a href="../../basedata/tms_v1_basedata_searticketprovide.php" target="_parent">票据领用查询</a></span>
<?php 
	}
}?>
</body>
</html>
