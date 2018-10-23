<?php
/* *
 * 功能：支付宝即时到账交易接口页面
 */
define("WEBAUTH", "TRUE");

//载入初始化文件
require_once("../../ui/inc/init.inc.php");

$bookID = $_GET['bID'];
$NoOfRunsdate = $_GET['d'];
$BeginStationTime = $_GET['t'];
$FromStation = $_GET['f'];
$ReachStation = $_GET['r'];
$FullNumber = $_GET['fNum'];
$HalfNumber = $_GET['hNum'];
$SellPrice = $_GET['price'];

$WIDout_trade_no = $bookID;
$WIDsubject = "汽车票";
$WIDtotal_fee = $SellPrice;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>网上支付</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../../js/jquery.js"></script>
</head>
<body>
<form name=alipayment action=alipayapi.php method=post target="_blank">
<table width="40%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../../ui/images/sj.gif" width="6" height="7" /> 订单号：</span></td>
    	<td bgcolor="#FFFFFF"><input name="WIDout_trade_no" type="text" value="<?php echo $WIDout_trade_no?>" readonly="readonly" /></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../../ui/images/sj.gif" width="6" height="7" /> 订单名称：</span></td>
    	<td bgcolor="#FFFFFF"><input name="WIDsubject" type="text" value="<?php echo $WIDsubject?>" readonly="readonly" /></td>
    </tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../../ui/images/sj.gif" width="6" height="7" /> 付款金额：</span></td>
    	<td bgcolor="#FFFFFF"><input name="WIDtotal_fee" type="text" value="<?php echo $WIDtotal_fee?>" />元</td>
    </tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../../ui/images/sj.gif" width="6" height="7" />订单描述：</span></td>
    	<td align="left" bgcolor="#FFFFFF">
    		<ol>
				<li><?php echo $NoOfRunsdate?>：<?php echo $FromStation?>&nbsp;&nbsp;至&nbsp;&nbsp;<?php echo $ReachStation?></li>
				<li>全票：<?php echo $FullNumber?>张&nbsp;&nbsp;&nbsp;&nbsp;半票：<?php echo $HalfNumber?>张</li>
				<li>始发站时间：<?php echo $BeginStationTime?></li>
    		</ol>
    	</td>
	</tr> 
	<tr>
		<td colspan="2" bgcolor="#FFFFFF"><input name="WIDseller_email" type="hidden" value="<?php echo $bookID?>" readonly="readonly" /></td>
    </tr>
    <tr>
    	<td colspan="2" align="center" bgcolor="#FFFFFF">
    		<input name="submit" type="submit" value="确定" />&nbsp;&nbsp;&nbsp;&nbsp;
    		<input name="button" type="button" value="取消" onclick = "history.back()" />
    	</td>
    </tr>
</table>
</form>
</body>
</html>
