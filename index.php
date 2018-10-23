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
$str = "select * from tms_sys_OnlineUser where ui_UserID = '$userID' and ui_UserState = '$userState' and ui_UserIP = '$userIP'" ;//";//'$userID'";
//echo "'$str'";
//exit();
$query = $class_mysql_default ->my_query($str);
if(mysql_num_rows($query)==1)
{
       $str1 = "Location:ui/main.php?groupid=".$userGroupID;
       header($str1);      
}
else{
   	header('Location:ui/login.php?action=login');     
}
?>

