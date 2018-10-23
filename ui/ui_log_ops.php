<?php
	//定义页面必须验证是否登录
	//define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	
	$userid=trim($_GET['userid']);
	$newip=trim($_GET['newip']);
	$groupid = trim($_GET['groupid']);
	$ops = trim($_GET['ops']);
	$LoginTime = date("Y-m-d   H:i:s");
   // echo "<script>  alert('$LoginTime');	</script>";	 
	//UPDATE Person SET FirstName = 'Fred' WHERE LastName = 'Wilson'
	$sql = "UPDATE tms_sys_OnlineUser SET ui_LoginTime = '$LoginTime', ui_UserIP = '$newip' WHERE ui_UserID = '$userid'";	
	  
	$query=$class_mysql_default->my_query($sql);
	//echo "<script>  alert('$ops');	</script>";	
	if($ops == "login")
	{
	        $str = "Location:main.php?groupid=".$groupid;
	        header($str);	
	}	
	
	exit();
	
	
	
?>
