<?php

define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$q=$_GET['q'];
$strsqlselet = "SELECT `sset_SiteID`  FROM `tms_bd_SiteSet` WHERE `sset_SiteName`='$q'";
$resultselet = $class_mysql_default->my_query("$strsqlselet");
$rows = @mysqli_fetch_array($resultselet);
echo $rows['sset_SiteID'];
?>
