<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link rel="stylesheet" type="text/css" href="images/style_admin.css"/>
	<title><?php =$config_web_title ?></title>
	<script language="javascript">
	function Clock()
	{
		var date = new Date();
		this.year = date.getFullYear();
		this.month = date.getMonth() + 1;
		this.date = date.getDate();
		this.day = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六")[date.getDay()];
		this.hour = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
		this.minute = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
		this.second = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
		
		this.toString = function() {
		return "" + this.year + "年" + this.month + "月" + this.date + "日 " + this.hour + ":" + this.minute + ":" + this.second + " " + this.day; 
		};
		
		this.toSimpleDate = function() {
		return this.year + "-" + this.month + "-" + this.date;
		};
		
		this.toDetailDate = function() {
		return this.year + "-" + this.month + "-" + this.date + " " + this.hour + ":" + this.minute + ":" + this.second;
		};
		
		this.display = function(ele) {
			var clock = new Clock();
			ele.innerHTML = clock.toString();
			window.setTimeout(function() {clock.display(ele);}, 1000);
		};
	}
	</script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr valign="middle" style="background-image: url(images/main_03.gif);">
		<td width="80" height="30"><img src="images/top_title-2_01.png" width="80" height="30" /></td>	 
		<td align="right">
			<a href="userpass.php" target="_parent"><img border="0" src="images/pass.gif" width="69" height="17" /></a>&nbsp;&nbsp;&nbsp;
			<a href="group.php?action=exit" target="_parent"><img border="0" src="images/quit.gif" width="69" height="17" /></a>
		</td>
		<td width="5">&nbsp;&nbsp;&nbsp;</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr valign="middle" style="background-image: url(images/main_06.gif);">
		<td width="80" height="30"><img src="images/top_title-2_02.png" width="80" height="30" /></td>
		<td>
			&nbsp;&nbsp;&nbsp;<img src="images/sj.gif" width="6" height="7" /><strong>当前用户：</strong><?php =$userID ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<img src="images/sj.gif" width="6" height="7" /><strong>用户属组：</strong><?php =$userGroupName ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<img src="images/sj.gif" width="6" height="7" /><strong>所属车站：</strong><?php =$userStationName ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
		<td><strong>单位：</strong><?php =$config_company_name ?>	</td>
		<td align="right">
			<div id="clock" align="right"></div>
			<script type="text/javascript">
				var clock = new Clock();
				clock.display(document.getElementById("clock"));
			</script>
			<?php //=date("Y-m-d H:i:s",time()) ?>
		</td>
		<td width="5">&nbsp;&nbsp;&nbsp;</td>
	</tr>
</table>
</body>
</html>
