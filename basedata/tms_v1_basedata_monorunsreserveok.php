<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$NoOfRunsID=$_POST['NoOfRunsID'];
	$LineID=$_POST['LineID'];
	$NoOfRunsdate=$_POST['NoOfRunsdate'];
	$ReserveSeatNO=$_POST['ReserveSeatNO'];
	$ReserveSeatS=$_POST['ReserveSeatS'];
	$OnStationID=$_POST['OnStationID'];
	$OnStationI=$_POST[OnStationI];
	$OnStation=$_POST['OnStation'];
	$ReserveUserID=$_POST['ReserveUserID'];
	$ReserveUser=$_POST['ReserveUser'];
	$DateTime=strtotime(date("Y-m-d H:i:s"));
	$Remark=$_POST['Remark'];
	
	$select="select * from tms_tms_bd_Reserve where re_NoOfRunsID='{$NoOfRunsID}' and re_OnStationID='{$OnStationID}'";
	$sele=$class_mysql_default->my_query($select);
	if(!mysqli_fetch_array($sele)||$OnStationID==$OnStationI ){
		$updata="UPDATE tms_tms_bd_Reserve SET re_NoOfRunsdate='{$NoOfRunsID}', re_ReserveSeatNO='{$ReserveSeatNO}',re_ReserveSeatS='{$ReserveSeatS}',
			re_OnStationID='{$OnStationID}',re_OnStation='{$OnStation}',re_ReserveUserID='{$ReserveUserID}', re_ReserveUser='{$ReserveUser}',
			re_DateTime='{$DateTime}',re_Remark='{$Remark}'WHERE  re_NoOfRunsID='{$NoOfRunsID}' and re_OnStationID='{$OnStationI}'";
		$query =$class_mysql_default->my_query($updata);
		//if (!$query) echo "SQL错误：".->my_error();
		if($query){
			echo"<script>alert('恭喜您！修改成功!');window.location.href='tms_v1_basedata_searnorunsreserve.php?op=see&clnumber=$NoOfRunsID'</script>";
		}else{
			echo"<script>alert('修改失败');window.location.href='tms_v1_basedata_searnorunsreserve.php?op=see&clnumber=$NoOfRunsID'</script>";
		}
	}else{
		echo"<script>alert('预留车站编号已存在，请重新输入！');window.location.href='tms_v1_basedata_addnorunsreserve.php?NoOfRunsID=$NoOfRunsID'</script>";
	} 
?>