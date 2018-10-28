<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$NoOfRunsID=$_POST['NoOfRunsID'];
	$LoopDate=$_POST['LoopDate'];
	$StartDay=$_POST['StartDay'];
	$RunDay=$_POST['RunDay'];
	$StopDay=$_POST['StopDay'];
	$WeekLoop=$_POST['WeekLoop'];
	$MonthLoop=$_POST['MonthLoop']; 
	
	//$select="select * from tms_bd_NoRunsInfo where nri_NoOfRunsID='{$NoOfRunsID}'";
	//$sele=$class_mysql_default->my_query($select);
	//$result=mysqli_fetch_array($sele);
	$updata="update tms_bd_NoRunsInfo set nri_LoopDate='{$LoopDate}',nri_StartDay='{$StartDay}',nri_RunDay='{$RunDay}',
			nri_StopDay='{$StopDay}',nri_WeekLoop='{$WeekLoop}',nri_MonthLoop='{$MonthLoop}' where nri_NoOfRunsID='{$NoOfRunsID}'";
	$query =$class_mysql_default->my_query($updata);
//	if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
	if($query){
//			echo"<script>alert('恭喜您！循环设置成功!');window.location.href='tms_v1_basedata_norunsloop.php?op=see&clnumber=$NoOfRunsID'</script>";
			echo"<script>alert('恭喜您！循环设置成功!');window.location.href='tms_v1_basedata_searnoruns.php'</script>";
		}else{
			echo"<script>alert('设置失败');window.location.href='tms_v1_basedata_norunsloop.php?op=see&clnumber=$NoOfRunsID'</script>";
		} 
?>