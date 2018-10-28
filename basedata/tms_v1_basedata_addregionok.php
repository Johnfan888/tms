<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$RegionCode = $_POST['RegionCode'];
	$RegionName = $_POST['RegionName'];
	$RegionFullName = $_POST['RegionFullName'];
	$HelpCode=$_POST['HelpCode'];
//	$IdCode=$_POST['IdCode'];
	$Remark=$_POST['Remark'];
	$CurTime=date('Y-m-d H:i:s');
	$select="select * from tms_bd_RegionSet where rs_RegionCode='{$RegionCode}'";
	$sele=$class_mysql_default->my_query($select);
	if(!mysqli_fetch_array($sele)){
		$insert="INSERT INTO `tms_bd_RegionSet` (`rs_RegionCode`,`rs_RegionName`,`rs_RegionFullName`,`rs_HelpCode`,`rs_AdderID`,`rs_Adder`,`rs_AddTime`,
			`rs_Remark` ) VALUES ('{$RegionCode}', '{$RegionName}', '{$RegionFullName}','{$HelpCode}','{$userID}','{$userName}','{$CurTime}','{$Remark}')";
		$query = $class_mysql_default->my_query($insert);
		if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
		if($query){
			echo"<script>alert('恭喜您！添加成功!');window.location.href='tms_v1_basedata_addregion.php'</script>";
		}else{
			echo"<script>alert('添加失败');window.location.href='tms_v1_basedata_addregion.php'</script>";
		}
	}else{
		echo"<script>alert('区域编码已存在，请重新输入！');window.location.href='tms_v1_basedata_addregion.php'</script>";
	}  
?>
