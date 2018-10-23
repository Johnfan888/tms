<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$NoOfRunsID=$_POST['NoOfRunsID'];
	$ModelID=$_POST['ModelID'];
	$ModelIDD=$_POST['ModelIDD'];
	$ModelName=$_POST['ModelName'];
	$ReserveSeatNO=$_POST['ReserveSeatNO'];
	$ReserveSeatS=$_POST['ReserveSeatS'];
	$SellerID=$userID;
	$Seller=$userName;
	$Remark=$_POST['Remark'];
	
	$select="select * from tms_bd_ScheduleReserve where sr_NoOfRunsID='{$NoOfRunsID}' and sr_ModelID='{$ModelID}'";
	$sele=$class_mysql_default->my_query($select);
	if(!mysql_fetch_array($sele) || $ModelIDD==$ModelID ){
		$updata="UPDATE tms_bd_ScheduleReserve SET sr_NoOfRunsID='{$NoOfRunsID}',sr_ModelID='{$ModelID}',sr_ModelName='{$ModelName}', 
			sr_ReserveSeatNO='{$ReserveSeatNO}',sr_ReserveSeatS='{$ReserveSeatS}',sr_SellerID='{$SellerID}',sr_Seller='{$Seller}',
			sr_Remark='{$Remark}' WHERE  sr_NoOfRunsID='{$NoOfRunsID}' and sr_ModelID='{$ModelIDD}'";
		$query = $class_mysql_default->my_query($updata);
		if (!$query) echo "SQL错误：".mysql_error();
		if($query){
			echo"<script>alert('恭喜您！修改成功!');window.location.href='tms_v1_basedata_searnorunsreserve.php?op=see&clnumber=$NoOfRunsID'</script>";
		}else{
			echo"<script>alert('修改失败');window.location.href='tms_v1_basedata_searnorunsreserve.php?op=see&clnumber=$NoOfRunsID'</script>";
		}
	}else{
		echo"<script>alert('预留车型编号已存在，请重新输入！');window.location.href='tms_v1_basedata_searnorunsreserve.php?op=see&clnumber=$NoOfRunsID'</script>";
	} 
?>
