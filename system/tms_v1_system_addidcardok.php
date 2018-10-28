<?php 
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
 	$CardID = $_POST['CardID'];
	$BusI = $_POST['BusI'];
	$BusNumber = $_POST['busCard'];
	//echo $BusNumber;
	$StationID=$_POST['StationID'];
	$Station=$_POST['Station'];
	$Remark=$_POST['Remark'];
	$CurTime=date('Y-m-d H:i:s');
	$select="select * from tms_bd_BusCard where bc_CardID ='{$CardID}'";
	$sele=$class_mysql_default->my_query($select);
	if(!mysqli_fetch_array($sele)){
			$insert="INSERT INTO tms_bd_BusCard VALUES('{$CardID}','{$BusI}','{$BusNumber}','{$CurTime}','注册','{$StationID}','{$Station}','{$Remark}','$userName','','','','$userID');";
		//	echo $insert;
			$query = $class_mysql_default->my_query($insert);
			
	if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
		if($query){
			echo"<script>alert('恭喜您！添加成功!');window.location.href='tms_v1_system_addidcard.php'</script>";
		}else{
			echo"<script>alert('添加失败');window.location.href='tms_v1_system_addidcard.php'</script>";
		}
			}
	else{
		echo"<script>alert('卡号已存在，请重新输入！');window.location.href='tms_v1_system_addidcard.php'</script>";
	}  
	
?>
