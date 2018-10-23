<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$NoOfRunsID=$_POST['NoOfRunsID'];
	$ID=$_POST['ID'];
	$BeginDate=$_POST['BeginDate'];
	$EndDate=$_POST['EndDate'];
	$StopCause=$_POST['StopCause'];
	$Remark=$_POST['Remark'];
	$updata="update tms_bd_ScheduleLong set sl_BeginDate='{$BeginDate}',sl_EndDate='{$EndDate}',sl_StopCause='{$StopCause}',
		sl_Remark='{$Remark}' where sl_NoOfRunsID='{$NoOfRunsID}' and sl_ID='{$ID}'";
	$query =$class_mysql_default->my_query($updata); 
		if($query){
			echo"<script>alert('恭喜您！修改成功!');window.location.href='tms_v1_basedata_searnorunsstop.php?op=see&clnumber=$NoOfRunsID'</script>";
		}else{
			echo"<script>alert('修改失败');window.location.href='tms_v1_basedata_searnorunsstop.php?op=see&clnumber=$NoOfRunsID'</script>";
		}
?>