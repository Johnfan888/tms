<?php

//定义页面必须验证是否登录
define("AUTH", "TRUE");

require_once("inc/init.inc.php");

if (isset($_GET['conf'])) {
	$conf = $_GET['conf'];
	$conf = "user/" . $conf . ".inc.php";
	require_once($conf);
}
if (isset($_GET['left'])) {
	$left = $_GET['left'];
	$left = "user/" . $left . ".inc.php";
	require_once($left);
}
if (isset($_GET['main'])) {
	$main = $_GET['main'];
	$main = "user/" . $main . ".inc.php";
	require_once($main);
}
?>
