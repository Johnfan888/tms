<?php
/*
 * IC卡管理页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("./init.inc.php");

$op = $_REQUEST['op'];
switch ($op)
{
	case "READ":
		$retData = "100001";
		echo json_encode($retData);
		//getCardNo();
		break;
	case "GETBUSINFO":
		$bc_CardID = $_REQUEST['busIC'];
		$queryString = "SELECT bc_BusID,bc_BusNumber FROM tms_bd_BusCard WHERE bc_CardID LIKE '{$bc_CardID}'";
		$result = $class_mysql_default->my_query("$queryString");
		$row = mysql_fetch_array($result);
		$retData = array('bc_BusID' => $row['bc_BusID'], 'bc_BusNumber' => $row['bc_BusNumber']);
		echo json_encode($retData);
		break;
   case "add":
		$bc_CardID = $_REQUEST['cardid'];
		$queryString = "SELECT bc_BusID FROM tms_bd_BusCard WHERE bc_CardID LIKE '{$bc_CardID}'";
		$result = $class_mysql_default->my_query("$queryString");
		$row = mysql_fetch_array($result);
		$retData = array('bc_BusID' => $row['bc_BusID']);
		echo json_encode($retData);
		break;
	case "mod":
		$bc_CardID = $_REQUEST['cardid'];
		$queryString = "SELECT bc_BusID FROM tms_bd_BusCard WHERE bc_CardID LIKE '{$bc_CardID}'";
		$result = $class_mysql_default->my_query("$queryString");
		$row = mysql_fetch_array($result);
		$retData = array('bc_BusID' => $row['bc_BusID']);
		echo json_encode($retData);
		break;
	default:
}

function getCardNo()
{
	$module = 'win_serial';
	 
	if (extension_loaded($module)) {
	     $str = "Module loaded";
	} 
	else 
	{
	     $str = "Module $module is not compiled into PHP";
	     die("Module $module is not compiled into PHP");
	}
	
	echo "$str<br>";
	 
	$functions = get_extension_funcs($module);
	echo "Functions available in the $module extension:<br>\n";
	foreach($functions as $func) {
	    echo $func."<br>";
	}
	echo "<br>";
	
	echo "Version ".ser_version();
	echo "<br>";
	echo "<br>";
	
	echo "test rfid card";echo "<br>";
	
	$str = "\x02\x04\xA0\x59\x57\xAA\x03";
	
	//echo $str;echo "<br>";
	
	ser_open( "COM1", 19200, 8, "None", "1", "None" );
	
	if (ser_isopen())
	   echo "Port is open!.";
	echo "<br>";
	ser_write("$str");
	
	sleep(1);
	
	$str = ser_read();
	$str = bin2hex($str);
	echo "Received1: $str";
	echo "<br>";
	
	$str = "\x02\x10\x02\xA1\xA3\x03";
	ser_write("$str");
	
	sleep(1);
	for($i = 1; $i <= 10; $i++)
	{
		$b = ser_readbyte();
		$b = dechex($b);
		if (strlen($b) < 2)
		   echo "0" . $b;
		else
		   echo substr($b, -2);
		echo "&nbsp";
	 }   
	echo "<br>";
	ser_close();
}
?>
