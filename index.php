<?php 

require_once("./ui/inc/init.inc.php");

$userID = $_COOKIE["{$config_cookie_head}_UserID"];
$userName = $_COOKIE["{$config_cookie_head}_UserName"];
$userPass = $_COOKIE["{$config_cookie_head}_UserPassword"];
$userGroupID = $_COOKIE["{$config_cookie_head}_UserGroupID"];
$userGroupName = $_COOKIE["{$config_cookie_head}_UserGroupName"];
$userStationID = $_COOKIE["{$config_cookie_head}_UserStationID"];
$userStationName = $_COOKIE["{$config_cookie_head}_UserStationName"];

$userIP = $_SERVER['REMOTE_ADDR'];
$userState = "在线";
$str = "select * from tms_sys_OnlineUser where ui_UserID = '$userID' and ui_UserState = '$userState' and ui_UserIP = '$userIP'";
$query = $class_mysql_default->my_query($str);
if(mysqli_num_rows($query)==1)
{
       $str1 = "Location:ui/main.php?groupid=".$userGroupID;
       header($str1);      
}
else
{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>运输管理系统</title>
<style type="text/css">
.alpha{filter:alpha(opacity=90);}
.STYLE1 {
	font-size: 19px;
	font-weight: bold;
	color: #000000;
}
</style>
<script type="text/javascript" src="./js/jquery.js"></script>
	<script language="javascript">
	$(document).ready(function(){
		$("#login").click(function(){
			document.cookie="UserGuest=guest";
			document.formlogin.submit();
		});
		$("#login1").click(function(){
			document.cookie="UserGuest=user";
			window.location.href='./ui/login.php?action=login';
		});
	});
	</script>
</head>
<body>
<div id="background" style="position:absolute;z-index:-1;width:100%;height:100%;top:0px;left:0px;"><img src="ui/images/login_main.jpg" class="alpha" width="100%" height="100%" /></div>
<div id="content">
<p>&nbsp;</p>
<p class="STYLE1" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;运输管理系统包括车队相关数据查询统计管理、售退改票管理、客运加班包车调度、检票管理、行包管理、票据管理、财务结算、综合查询（可导出文本、网页、pdf、电子表格等多种文件格式）、系统管理、IC卡进出站、IC卡安检管理、IC卡报班管理、信息发布、导乘、保险管理、广播系统、网上售票网站、统计合并各类上报报表等功能，满足如下要求： </p>
<p class="STYLE1" >&nbsp;&nbsp;&nbsp;<img src="ui/images/sj.gif" width="12" height="14" /> 支持多种联网方式，可以是专线或ADSL，也可以是局域网或互联网； </p>
<p class="STYLE1" >&nbsp;&nbsp;&nbsp;<img src="ui/images/sj.gif" width="12" height="14" /> 支持对客运站使用的客票、货票等票据范围的监督和管理； </p>
<p class="STYLE1" >&nbsp;&nbsp;&nbsp;<img src="ui/images/sj.gif" width="12" height="14" /> 支持对客运站场的售票数量、营业收入、班次数量等相关数据的实时统计和查询； </p>
<p class="STYLE1" >&nbsp;&nbsp;&nbsp;<img src="ui/images/sj.gif" width="12" height="14" /> 支持站与站之间的联网售票； </p>
<p class="STYLE1" >&nbsp;&nbsp;&nbsp;<img src="ui/images/sj.gif" width="12" height="14" /> 支持多站配客，同一班次可在多个车站进行售、检票，跨区单可分站打印； </p>
<p class="STYLE1" >&nbsp;&nbsp;&nbsp;<img src="ui/images/sj.gif" width="12" height="14" /> 支持联网查询，对企业站场的营收进行实时查询和监控； </p>
<p class="STYLE1" >&nbsp;&nbsp;&nbsp;<img src="ui/images/sj.gif" width="12" height="14" /> 支持联网结算，可以生成互联互售统计报表及站间费用自动结算； </p>
<p class="STYLE1" >&nbsp;&nbsp;&nbsp;<img src="ui/images/sj.gif" width="12" height="14" /> 支持各种报表的准确生成和综合统计； </p>
<p class="STYLE1" >&nbsp;&nbsp;&nbsp;<img src="ui/images/sj.gif" width="12" height="14" /> 支持旅客上车的广播提醒和导乘； </p>
<p class="STYLE1" >&nbsp;&nbsp;&nbsp;<img src="ui/images/sj.gif" width="12" height="14" /> 支持自动售票机售票、LED屏显示； </p>
<p class="STYLE1" >&nbsp;&nbsp;&nbsp;<img src="ui/images/sj.gif" width="12" height="14" /> 支持网上售票； </p>
<p class="STYLE1" >&nbsp;&nbsp;&nbsp;<img src="ui/images/sj.gif" width="12" height="14" /> 支持对各类上报报表进行统计合并。 </p>
<form id="formlogin" name="formlogin" method="post" action="./ui/group.php?action=login">
<input type="hidden" name="username" id="username" value="guest" />
<input type="hidden" name="pass" id="pass" value="123" />
<div style="margin-left:25%; margin-top:10px;"><input type="button" style="background:transparent;font-size:30px;font-weight:bold;font-family:Kaiti;color:#33FFFF;" value="开始体验" name="login" id="login" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" style="background:transparent;font-size:30px;font-weight:bold;font-family:Kaiti;color:#33FFFF;" value="用户登录" name="login1" id="login1" /></div>
</form>
</div>
</body>
</html>
<?php
//	header('Location:ui/login.php?action=login');     
}
?>

