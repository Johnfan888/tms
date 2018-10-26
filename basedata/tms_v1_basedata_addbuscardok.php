<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$CardID = $_POST['CardID'];
	$CardI=$_POST['CardI'];
	$BusID = $_POST['BusID'];
	$BusNumber = $_POST['BusNumber'];
	$RegDate=$_POST['RegDate'];
	$StationID=$_POST['StationID'];
	$Station=$_POST['Station'];
	$Remark=$_POST['Remark'];
	$select="select * from tms_bd_BusCard where bc_CardID='{$CardID}'";
	$sele=$class_mysql_default->my_query($select);
	if(!mysqli_fetch_array($sele) || $CardID==$CardI ){
		if(!$CardI){
			$insert="INSERT INTO `tms_bd_BusCard` (`bc_CardID`,`bc_BusID`,`bc_BusNumber`,`bc_RegDate`,`bc_StationID`,`bc_Station`,`bc_Remark`) 
				VALUES ('{$CardID}', '{$BusID}', '{$BusNumber}','{$RegDate}','{$StationID}','{$Station}','{$Remark}');";
			$query = $class_mysql_default->my_query($insert);
			if($query){
				echo "<script>alert('恭喜您！提交成功!');window.history.go(-2);</script>";
			}else{
				echo "<script>alert('提交失败');window.history.go(-2);</script>";
			}
		}else{
			$update="UPDATE tms_bd_BusCard  SET bc_CardID='{$CardID}',bc_RegDate='{$RegDate}',bc_Remark='{$Remark}' WHERE bc_CardID='{$CardI}'";
			$querys = $class_mysql_default->my_query($update);
			if($querys){
				echo "<script>alert('恭喜您！更新成功!');window.history.go(-2);</script>";
			}else{
				echo "<script>alert('更新失败');window.history.go(-2);</script>";
			}
		}
	}else{
		echo"<script>alert('卡号已存在，请重新输入！');window.history.go(-1);</script>";
	}
?>

