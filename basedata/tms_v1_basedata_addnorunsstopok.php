<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");	
	$NoOfRunsID=$_POST['NoOfRunsID'];
	$BeginDate=$_POST['BeginDate'];
	$EndDate=$_POST['EndDate'];
	$StopCause=$_POST['StopCause'];
	$Remark=$_POST['Remark'];
	$insert="insert into tms_bd_ScheduleLong (sl_NoOfRunsID,sl_BeginDate,sl_EndDate,sl_StopCause,sl_Remark) values('{$NoOfRunsID}',
				'{$BeginDate}','{$EndDate}','{$StopCause}','{$Remark}')";
	$query = $class_mysql_default->my_query($insert);
	if($query){
		echo"<script>alert('恭喜您！添加成功!');window.location.href='tms_v1_basedata_addnorunsstop.php?NoOfRunsID=$NoOfRunsID'</script>";
	}else{
		echo"<script>alert('添加失败');window.location.href='tms_v1_basedata_addnorunsstop.php?NoOfRunsID=$NoOfRunsID'</script>";
	}
?>