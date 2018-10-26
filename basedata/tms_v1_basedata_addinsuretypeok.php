<?php
	//定义页面必须验证是否登录
//	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$InsureType = $_POST['InsureType'];
	$InsureFee = $_POST['InsureFee'];
	$userID=$userNameID;
	$user =$userName;
	$Remark=$_POST['Remark'];
	$select="select * from tms_bd_InsureType  where it_InsureType='{$InsureType}'";
	$sele=$class_mysql_default->my_query($select);
	if(!mysqli_fetch_array($sele)){
		$insert="INSERT INTO `tms_bd_InsureType` (`it_InsureType`,`it_InsureFee`,`it_UserID` ,`it_User`,`it_Remark`) 
			VALUES ('{$InsureType}', '{$InsureFee}','{$userID}','{$user}','{$Remark}');";
		$query = $class_mysql_default->my_query($insert);
		if($query){
			echo"<script>alert('恭喜您！添加成功!');window.location.href='tms_v1_basedata_addinsuretype.php'</script>";
		}else{
			echo"<script>alert('添加失败');window.location.href='tms_v1_basedata_addinsuretype.php'</script>";
		}
	}else{
		echo"<script>alert('保险类型已存在，请重新输入！');window.location.href='tms_v1_basedata_addinsuretype.php'</script>";
	}
?>
