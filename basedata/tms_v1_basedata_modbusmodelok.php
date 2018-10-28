<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$ModelID=$_POST['ModelID'];
	$ModelI=$_POST['ModelI'];
	$ModelName=$_POST['ModelName'];
	$Rank=$_POST['Rank'];
	$Category=$_POST['Category'];
	$Seating=$_POST['Seating'];
	$AddSeating=$_POST['AddSeating'];
	$AllowHalfSeats=$_POST['AllowHalfSeats'];
	$Weight=$_POST['Weight'];
	$Closing=$_POST['Closing'];
	$Remark=$_POST['Remark'];
	$CurTime=date('Y-m-d H:i:s');
	$select="select * from tms_bd_BusModel where bm_ModelID='{$ModelID}'";
	$sele= $class_mysql_default->my_query($select);
	if(!mysqli_fetch_array($sele) || $ModelI==$ModelID){
		$update="UPDATE tms_bd_BusModel SET bm_ModelID='{$ModelID}', bm_ModelName='{$ModelName}',bm_Rank='{$Rank}',
			bm_Category='{$Category}',bm_Seating='{$Seating}',bm_AddSeating='{$AddSeating}',bm_AllowHalfSeats='{$AllowHalfSeats}',
			bm_Weight='{$Weight}',bm_ModerID='{$userID}',bm_Moder='{$userName}',bm_ModTime='{$CurTime}',bm_Closing='{$Closing}',
			bm_Remark='{$Remark}' WHERE  bm_ModelID='{$ModelI}'";	
		$query =$class_mysql_default->my_query($update);
	//	if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
		if($query){
			echo"<script>alert('恭喜您！修改成功!');window.location.href='tms_v1_basedata_searbusmodel.php'</script>";
		}else{
			echo"<script>alert('修改失败');window.location.href='tms_v1_basedata_searbusmodel.php</script>";
		}
	}else{
			echo"<script>alert('车型编号已存在，请重新输入！');window.location.href='tms_v1_basedata_searbusmodel.php'</script>";
		}
?>

