<?php
	//定义页面必须验证是否登录
//	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$ID=$_POST['ID'];
	$InsureType=$_POST['InsureType'];
	$InsureTyp=$_POST['InsureTyp'];
	$InsureFee = $_POST['InsureFee'];
	$userID=$userNameID;
	$user =$userName;
	$Remark=$_POST['Remark'];
	$select="select * from tms_bd_InsureType  where it_InsureType='{$InsureType}'";
	$sele=$class_mysql_default->my_query($select);
	if(!mysql_fetch_array($sele)|| $InsureType==$InsureTyp){
		$update="UPDATE tms_bd_InsureType SET it_InsureType='{$InsureType}',it_InsureFee='{$InsureFee}',it_UserID='{$userID}',
			it_User='{$user}',it_Remark='{$Remark}' WHERE it_ID='{$ID}'";
		$query = $class_mysql_default->my_query($update);
		if($query){
			echo"<script>alert('恭喜您！修改成功!');window.location.href='tms_v1_basedata_searinsuretype.php'</script>";
		}else{
			echo"<script>alert('修改失败');window.location.href='tms_v1_basedata_modinsuretype.php?clnumber=$ID'</script>";
		}
	}else{
		echo"<script>alert('保险类型已存在，请重新输入！');window.location.href='tms_v1_basedata_modinsuretype.php?clnumber=$ID'</script>";
	}
?>
