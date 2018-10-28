<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$op=$_REQUEST['op'];
	if($op=="addbusloop"){
		$NoOfRunsID=$_REQUEST['NoOfRunsID'];
		$LoopID=$_REQUEST['LoopID'];
		$Unit=$_REQUEST['BusUnit'];
		$ModelName=$_REQUEST['ModelName'];
		$ModelID=$_REQUEST['ModelID'];
		$Seating=$_REQUEST['Seating'];
		$AddSeating=$_REQUEST['AddSeating'];
		$AllowHalfSeats=$_REQUEST['AllowHalfSeats'];
		$Loads=$_REQUEST['Loads'];
		$Remark=$_REQUEST['Remark'];
		$select="SELECT nrl_LoopID FROM tms_bd_NoRunsLoop WHERE nrl_NoOfRunsID='{$NoOfRunsID}' and nrl_LoopID='{$LoopID}'";
		$query=$class_mysql_default->my_query($select);
		if(!$query){
			$retData = array('retVal' => 'FAIL', 'retString' => '查询班次车辆循环数据失败！', 'sql' => $select);
			echo json_encode($retData);
			exit();
		}
		if(mysqli_num_rows($query) == 1){
			$retData = array('retVal' => 'FAIL1', 'retString' => '循环编号已存在，请重新输入！', 'sql' => $select);
			echo json_encode($retData);
			exit();
		}
		$selectprice="SELECT nrap_ID FROM tms_bd_NoRunsAdjustPrice WHERE nrap_NoRunsAdjust='{$NoOfRunsID}' AND nrap_ModelID='{$ModelID}'
			AND nrap_ISLineAdjust='0'";
		$queryprice = $class_mysql_default->my_query($selectprice);
		if(!$queryprice){
			$retData = array('retVal' => 'FAIL', 'retString' => '查询班次票价数据失败！', 'sql' => $selectprice);
			echo json_encode($retData);
			exit();
		}
		$insert="INSERT INTO tms_bd_NoRunsLoop (nrl_NoOfRunsID,nrl_LoopID,nrl_ModelID,nrl_ModelName,
				nrl_Seating,nrl_AddSeating,nrl_AllowHalfSeats,nrl_Loads,nrl_Unit,nrl_Remark) VALUES('{$NoOfRunsID}','{$LoopID}',
				'{$ModelID}','{$ModelName}','{$Seating}','{$AddSeating}','{$AllowHalfSeats}','{$Loads}','{$Unit}','{$Remark}')";
		$queryinsert = $class_mysql_default->my_query($insert);
		if(!$queryinsert){
			$retData = array('retVal' => 'FAIL', 'retString' => '插入班次车辆循环数据失败！', 'sql' => $insert);
			echo json_encode($retData);
			exit();
		}
		if(mysqli_num_rows($queryprice) == 0){
			$retData = array('retVal' => 'SUCC1', 'retString' => '添加成功，但在班次票价表中无该车型票价信息，请添加！', 'sql' => $selectprice);
			echo json_encode($retData);
		}else{
			$retData = array('retVal' => 'SUCC2', 'retString' => '添加成功！', 'sql' => $selectprice);
			echo json_encode($retData);
		}
	}
/*	$NoOfRunsID=$_POST['NoOfRunsID'];
	$LoopID=$_POST['LoopID'];
	$ModelID=$_POST['ModelID'];
	$ModelName=$_POST['ModelName'];
//	$BusID=$_POST['BusID'];
//	$BusCard=$_POST['BusCard'];
	$Seating=$_POST['Seating'];
	$AddSeating=$_POST['AddSeating'];
	$AllowHalfSeats=$_POST['AllowHalfSeats'];
	$Loads=$_POST['Loads'];
	$Unit=$_POST['BusUnit'];
//	$StationID=$_POST['StationID'];
//	$Station=$_POST['Station'];
	$Remark=$_POST['Remark'];
	$select="select * from tms_bd_NoRunsLoop where nrl_NoOfRunsID='{$NoOfRunsID}' and nrl_LoopID='{$LoopID}'";
	$sele= $class_mysql_default->my_query($select);
	if(!mysqli_fetch_array($sele)){
		$insert="insert into tms_bd_NoRunsLoop (nrl_NoOfRunsID,nrl_LoopID,nrl_ModelID,nrl_ModelName,
				nrl_Seating,nrl_AddSeating,nrl_AllowHalfSeats,nrl_Loads,nrl_Unit,nrl_Remark) values('{$NoOfRunsID}','{$LoopID}',
				'{$ModelID}','{$ModelName}','{$Seating}','{$AddSeating}','{$AllowHalfSeats}','{$Loads}','{$Unit}','{$Remark}')";
		$query = $class_mysql_default->my_query($insert); 
		if($query){
			echo"<script>alert('恭喜您！添加成功!');window.location.href='tms_v1_basedata_searbusloop.php?op=see&clnumber=$NoOfRunsID'</script>";
		}else{
			echo $class_mysql_default->my_error();
			echo"<script>alert('添加失败');window.location.href='tms_v1_basedata_searbusloop.php?op=see&clnumber=$NoOfRunsID'</script>";
		}
	}else{
		echo"<script>alert('循环编号已存在，请重新输入！');window.location.href='tms_v1_basedata_addbusloop.php?op=see&NoOfRunsID=$NoOfRunsID'</script>";
	}  */
 