<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$NoOfRunsID=$_POST['NoOfRunsID'];
	$ModelID=$_POST['ModelID'];
	$ModelName=$_POST['ModelName'];
	$ReserveSeatNO=$_POST['ReserveSeatNO'];
	$ReserveSeatS=$_POST['ReserveSeatS'];
	$SellerID=$userID;
	$Seller=$userName;
	$Remark=$_POST['Remark'];
	
	$select="select sr_NoOfRunsID from tms_bd_ScheduleReserve where sr_NoOfRunsID='{$NoOfRunsID}' and sr_ModelID='{$ModelID}'";
	$sele=$class_mysql_default->my_query($select);
	if(!mysqli_fetch_array($sele)){
		$insert="INSERT INTO tms_bd_ScheduleReserve (sr_NoOfRunsID, sr_ModelID, sr_ModelName, sr_ReserveSeatNO,sr_ReserveSeatS,
			sr_SellerID,sr_Seller,sr_Remark) VALUES ('{$NoOfRunsID}', '{$ModelID}','{$ModelName}','{$ReserveSeatNO}','{$ReserveSeatS}',
			'{$SellerID}','{$Seller}','{$Remark}')";
		$query = $class_mysql_default->my_query($insert);
		if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
		if($query){
			echo"<script>alert('恭喜您！添加成功!');window.location.href='tms_v1_basedata_addnorunsreserve.php?NoOfRunsID=$NoOfRunsID'</script>";
		}else{
			echo"<script>alert('添加失败');window.location.href='tms_v1_basedata_addnorunsreserve.php?NoOfRunsID=$NoOfRunsID'</script>";
		}
	}else{
		echo"<script>alert('预留车型编号已存在，请重新输入！');window.location.href='tms_v1_basedata_addnorunsreserve.php?NoOfRunsID=$NoOfRunsID'</script>";
	} 
	