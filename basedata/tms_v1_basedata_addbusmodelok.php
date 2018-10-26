<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$ModelID=$_POST['ModelID'];
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
	if(!mysqli_fetch_array($sele)){
			$insert="insert into tms_bd_BusModel (bm_ModelID,bm_ModelName,bm_Rank,bm_Category,bm_Seating,bm_AddSeating,
				bm_AllowHalfSeats,bm_Weight,bm_AdderID,bm_Adder,bm_AddTime,bm_Closing,bm_Remark) values('{$ModelID}',
				'{$ModelName}','{$Rank}','{$Category}','{$Seating}','{$AddSeating}','{$AllowHalfSeats}','{$Weight}',
				'{$userID}','{$userName}','{$CurTime}','{$Closing}','{$Remark}')";
			$query = $class_mysql_default->my_query($insert);
		//	if (!$query) echo "SQL错误：".->my_error();
			if($query){
				echo"<script>alert('恭喜您！添加成功!');window.location.href='tms_v1_basedata_addbusmodel.php'</script>";
			}else{
				echo"<script>alert('添加失败');window.location.href='tms_v1_basedata_addbusmodel.php'</script>";
			}
	}else{
			echo"<script>alert('车型编号已存在，请重新输入！');window.location.href='tms_v1_basedata_addbusmodel.php'</script>";
		}
?>
