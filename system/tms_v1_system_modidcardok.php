<?php
//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$CardID=$_POST['CardID'];
$CardID1=$_POST['CardID1'];
$BusI = $_POST['BusI1'];
$BusNumber = $_POST['BusNumber1'];
$StationID = $_POST['StationID'];
$Station=$_POST['Station'];
$Remark=$_POST['Remark'];
$state=$_POST['state'];
$CurTime=date('Y-m-d H:i:s');
//echo $CardID;
if(isset($CardID)){
	if($CardID!=null){
		$select="select * from tms_bd_BusCard where bc_CardID='{$CardID}'";
		//echo $select;
		$sele= $class_mysql_default->my_query($select);
		//echo $result;
		if(!mysqli_fetch_array($sele)|| $CardID!==$CardID1 ){
			if($CardID1==""){
			$update="update tms_bd_BusCard set 
			bc_CardID='{$CardID}', 
			bc_BusID='{$BusI}', 
			bc_BusNumber='{$BusNumber}',
			bc_state='{$state}', 
			bc_StationID='{$StationID}', 
			bc_Station='{$Station}', 
			bc_Remark='{$Remark}',
			bc_moddate='{$CurTime}',
			bc_modpeople='{$userName}',
			bc_modderID='{$userID}' 
			where bc_CardID='{$CardID}';";
			}
			else{
			$update="update tms_bd_BusCard set 
			bc_CardID='{$CardID1}', 
			bc_BusID='{$BusI}', 
			bc_BusNumber='{$BusNumber}',
			bc_state='{$state}', 
			bc_StationID='{$StationID}', 
			bc_Station='{$Station}', 
			bc_Remark='{$Remark}',
			bc_moddate='{$CurTime}',
			bc_modpeople='{$userName}',
			bc_modderID='{$userID}' 
			where bc_CardID='{$CardID}';";
			}
			$query =$class_mysql_default->my_query($update);
			//echo $update;
			if($query){
				echo"<script>alert('恭喜您！修改成功!');window.location.href='tms_v1_system_searidcard.php'</script>";
			}else{
				echo"<script>alert('卡号已存在,请重新操作');window.history.go(-1)</script>";
			}
		}
		else{
			echo"<script>alert('卡号已存在，请重新操作！');window.history.go(-1)</script>";
		}
	}
}
?>