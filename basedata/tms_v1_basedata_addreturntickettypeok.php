<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$ReturnType = $_POST['ReturnType'];
	$ReturnRate = $_POST['ReturnRate'];
	$ReturnTimeBegin = $_POST['ReturnTimeBegin'];
	$ReturnTimeEnd=$_POST['ReturnTimeEnd'];
	$select="select * from tms_sell_ReturnType  where rte_ReturnType='{$ReturnType}'";
	$sele=$class_mysql_default->my_query($select);
	if(!mysqli_fetch_array($sele)){
		$insert="INSERT INTO `tms_sell_ReturnType` (`rte_ReturnType`,`rte_ReturnRate`,`rte_ReturnTimeBegin`,`rte_ReturnTimeEnd`) 
			VALUES ('{$ReturnType}', '{$ReturnRate}', '{$ReturnTimeBegin}','{$ReturnTimeEnd}')";
		$query = $class_mysql_default->my_query($insert);
		if (!$query) echo "SQL错误：".->my_error();
		if($query){
			echo"<script>alert('恭喜您！添加成功!');window.location.href='tms_v1_basedata_addreturntickettype.php'</script>";
		}else{
			echo"<script>alert('添加失败');window.location.href='tms_v1_basedata_addreturntickettype.php'</script>";
		}
	}else{
		echo"<script>alert('退票类型已存在，请重新输入！');window.location.href='tms_v1_basedata_addreturntickettype.php'</script>";
	}
?>

