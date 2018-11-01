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
<link href="../css/tms.css" rel="stylesheet" type="text/css">
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
    <span class="graytext" style="margin-left:8px;">当 前 票 据 状 态</span></td>
  </tr>
</table>
<p></p>
<table width="270" border="0" align="center" cellpadding="3" cellspacing="1" >
  <tr >
    <th width="62" height="31" scope="col" align="center">&nbsp;</th>
    <th width="110" scope="col" align="center"><span class="form_title" style="color:black;font-size: 14px;">当前票号</span></th>
    <th width="60" scope="col" align="center"><span class="form_title" style="color:black;font-size: 14px;">余票数</span></th>
  </tr>
  <tr>
    <th height="26" scope="row" align="center"><span class="form_title" style="color:black;font-size: 14px;">客票</span></th>
    <td align="center"><span class="form_title" style="color:black;font-size: 14px;">
    <?php 
		$strsqlselet = "SELECT `tp_CurrentTicket` FROM `tms_bd_TicketProvide` WHERE `tp_InceptUserID` = '$userID'
			AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '客票' ORDER BY tp_ProvideData ASC";
		$resultselet = $class_mysql_default->my_query("$strsqlselet");
		$rowsticket = @mysql_fetch_array($resultselet);
    	echo $rowsticket['tp_CurrentTicket'];
    ?>
    </span></td>
    <td align="center"><span class="form_title" style="color:black;font-size: 14px;">
    <?php 
      	$sql1="SELECT SUM(tp_InceptTicketNum) AS number FROM tms_bd_TicketProvide WHERE `tp_InceptUserID` = '$userID'
			AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '客票'";
		$query1 =$class_mysql_default->my_query($sql1);
		$rows = mysql_fetch_array($query1);
		echo $rows['number'];
    ?>
    </span></td>
  </tr>
  <tr>
    <th height="26" scope="row" align="center"><span class="form_title" style="color:black;font-size: 14px;">保险票</span></th>
    <td align="center"><span class="form_title" style="color:black;font-size: 14px;">
    <?php 
		$strsqlselet = "SELECT `tp_CurrentTicket` FROM `tms_bd_TicketProvide` WHERE `tp_InceptUserID` = '$userID'
			AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '保险票' ORDER BY tp_ProvideData ASC";
		$resultselet = $class_mysql_default->my_query("$strsqlselet");
		$rowsticket = @mysql_fetch_array($resultselet);
    	echo $rowsticket['tp_CurrentTicket'];
    ?>
    </span></td>
    <td align="center"><span class="form_title" style="color:black;font-size: 14px;">
    <?php 
      	$sql1="SELECT SUM(tp_InceptTicketNum) AS number FROM tms_bd_TicketProvide WHERE `tp_InceptUserID` = '$userID'
			AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '保险票'";
		$query1 =$class_mysql_default->my_query($sql1);
		$rows = mysql_fetch_array($query1);
		echo $rows['number'];
    ?>
    </span></td>
  </tr>
  <tr align="center">
    <th height="26" scope="row"><span class="form_title" style="color:black;font-size: 14px;">结算单</span></th>
    <td><span class="form_title" style="color:black;font-size: 14px;">
    <?php 
		$strsqlselet = "SELECT `tp_CurrentTicket` FROM `tms_bd_TicketProvide` WHERE `tp_InceptUserID` = '$userID'
			AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '结算单' ORDER BY tp_ProvideData ASC";
		$resultselet = $class_mysql_default->my_query("$strsqlselet");
		$rowsticket = @mysql_fetch_array($resultselet);
    	echo $rowsticket['tp_CurrentTicket'];
    ?>
    </span></td>
    <td><span class="form_title" style="color:black;font-size: 14px;">
    <?php 
      	$sql1="SELECT SUM(tp_InceptTicketNum) AS number FROM tms_bd_TicketProvide WHERE `tp_InceptUserID` = '$userID'
			AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '结算单'";
		$query1 =$class_mysql_default->my_query($sql1);
		$rows = mysql_fetch_array($query1);
		echo $rows['number'];
    ?>
    </span></td>
  </tr>
  <tr align="center"> 
    <th height="26" scope="row"><span class="form_title" style="color:black;font-size: 14px;">安检单</span></th>
    <td><span class="form_title" style="color:black;font-size: 14px;">
    <?php 
		$strsqlselet = "SELECT `tp_CurrentTicket` FROM `tms_bd_TicketProvide` WHERE `tp_InceptUserID` = '$userID'
			AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '安检单' ORDER BY tp_ProvideData ASC";
		$resultselet = $class_mysql_default->my_query("$strsqlselet");
		$rowsticket = @mysql_fetch_array($resultselet);
    	echo $rowsticket['tp_CurrentTicket'];
    ?>
    </span></td>
    <td><span class="form_title" style="color:black;font-size: 14px;">
    <?php 
      	$sql1="SELECT SUM(tp_InceptTicketNum) AS number FROM tms_bd_TicketProvide WHERE `tp_InceptUserID` = '$userID'
			AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '安检单'";
		$query1 =$class_mysql_default->my_query($sql1);
		$rows = mysql_fetch_array($query1);
		echo $rows['number'];
    ?>
    </span></td>
  </tr>
  <tr align="center">
    <th height="26" scope="row"><span class="form_title" style="color:black;font-size: 14px;">行包单</span></th>
    <td><span class="form_title" style="color:black;font-size: 14px;">
    <?php 
		$strsqlselet = "SELECT `tp_CurrentTicket` FROM `tms_bd_TicketProvide` WHERE `tp_InceptUserID` = '$userID'
			AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '托运单' ORDER BY tp_ProvideData ASC";
		$resultselet = $class_mysql_default->my_query("$strsqlselet");
		$rowsticket = @mysql_fetch_array($resultselet);
    	echo $rowsticket['tp_CurrentTicket'];
    ?>
    </span></td>
    <td><span class="form_title" style="color:black;font-size: 14px;">
    <?php 
      	$sql1="SELECT SUM(tp_InceptTicketNum) AS number FROM tms_bd_TicketProvide WHERE `tp_InceptUserID` = '$userID'
			AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '托运单'";
		$query1 =$class_mysql_default->my_query($sql1);
		$rows = mysql_fetch_array($query1);
		echo $rows['number'];
    ?>
    </span></td>
  </tr>
  <tr align="center">
    <th height="26" scope="row"><span class="form_title" style="color:black;font-size: 14px;">包车单</span></th>
    <td><span class="form_title" style="color:black;font-size: 14px;">
    <?php 
		$strsqlselet = "SELECT `tp_CurrentTicket` FROM `tms_bd_TicketProvide` WHERE `tp_InceptUserID` = '$userID'
			AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '包车单' ORDER BY tp_ProvideData ASC";
		$resultselet = $class_mysql_default->my_query("$strsqlselet");
		$rowsticket = @mysql_fetch_array($resultselet);
    	echo $rowsticket['tp_CurrentTicket'];
    ?>
    </span></td>
    <td><span class="form_title" style="color:black;font-size: 14px;">
    <?php 
      	$sql1="SELECT SUM(tp_InceptTicketNum) AS number FROM tms_bd_TicketProvide WHERE `tp_InceptUserID` = '$userID'
			AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '包车单'";
		$query1 =$class_mysql_default->my_query($sql1);
		$rows = mysql_fetch_array($query1);
		echo $rows['number'];
    ?>
    </span></td>
  </tr>
</table>
</body>
</html>
