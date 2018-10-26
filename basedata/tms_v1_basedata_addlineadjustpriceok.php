﻿<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$op=$_REQUEST['op'];
	if($op=='addlineprice'){
		$LineAdjust=$_REQUEST['LineAdjust'];
		$ISUnitAdjust=$_REQUEST['ISUnitAdjust'];
		$ISLineAdjust=$_REQUEST['ISLineAdjust'];
		$Unit=$_REQUEST['Unit'];
		if($ISUnitAdjust=='0'){
			$Unit='';
		}
		$DepartureSite=$_REQUEST['DepartureSite'];
		$DepartureSiteID=$_REQUEST['DepartureSiteID'];
		$GetToSite=$_REQUEST['GetToSite'];
		$GetToSiteID=$_REQUEST['GetToSiteID'];
		$ModelID=$_REQUEST['ModelID'];
		$Model=$_REQUEST['Model'];
		$BeginDate=$_REQUEST['BeginDate'];
		$EndDate=$_REQUEST['EndDate'];
		$ReferPrice=$_REQUEST['ReferPrice'];
		$RunPrice=$_REQUEST['RunPrice'];
		$HalfPrice=$_REQUEST['HalfPrice'];
		$BalancePrice=$_REQUEST['BalancePrice'];
		$Remark=$_REQUEST['Remark'];
		$selects="SELECT nrap_BeginDate,nrap_EndDate FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ISUnitAdjust='{$ISUnitAdjust}' AND nrap_Unit='{$Unit}' AND 
			nrap_ISLineAdjust='{$ISLineAdjust}' AND nrap_LineAdjust='{$LineAdjust}' AND nrap_ISNoRunsAdjust='0' AND nrap_DepartureSiteID='{$DepartureSiteID}' AND 
			nrap_GetToSiteID='{$GetToSiteID}' AND nrap_ModelID='{$ModelID}' AND (nrap_NoRunsAdjust is NULL)";
		$query=$class_mysql_default->my_query($selects);
		if(!$query){
			$retData = array('retVal' => 'FAIL', 'retString' => '查询票价数据失败！'.->my_error(), 'sql' => $selects);
			echo json_encode($retData);
			exit();
		}
		while($row=mysqli_fetch_array($query)){
			if($BeginDate==$row['nrap_BeginDate'] && $EndDate==$row['nrap_EndDate']){
				$retData = array('retVal' => 'FAIL1', 'retString' => '该记录已存在！', 'sql' => $selects);
				echo json_encode($retData);
				exit();
			}
			if(($BeginDate>$row['nrap_BeginDate'] && $BeginDate<=$row['nrap_EndDate'] && $EndDate>$row['nrap_EndDate']) || ($BeginDate<$row['nrap_BeginDate'] && $EndDate>=$row['nrap_BeginDate'] && $EndDate<$row['nrap_EndDate'])){
				$retData = array('retVal' => 'FAIL1', 'retString' => '和开始时间'.$row['nrap_BeginDate'].'结束时间'.$row['nrap_EndDate'].'有时间交叉！', 'sql' => $selects);
				echo json_encode($retData);
				exit();
			}	
		}
		$insert="INSERT INTO tms_bd_NoRunsAdjustPrice (nrap_ISUnitAdjust,nrap_Unit,nrap_ISLineAdjust,nrap_LineAdjust,nrap_ISNoRunsAdjust,nrap_NoRunsAdjust,nrap_DepartureSiteID,
			nrap_DepartureSite,nrap_GetToSiteID,nrap_GetToSite,nrap_ModelID,nrap_ModelName,nrap_BeginDate,nrap_EndDate,nrap_ReferPrice,nrap_RunPrice,nrap_HalfPrice,
			nrap_BalancePrice,nrap_Remark) VALUES ('{$ISUnitAdjust}','{$Unit}','{$ISLineAdjust}','{$LineAdjust}','0',NULL,'{$DepartureSiteID}','{$DepartureSite}',
			'{$GetToSiteID}','{$GetToSite}','{$ModelID}','{$Model}','{$BeginDate}','{$EndDate}','{$ReferPrice}','{$RunPrice}','{$HalfPrice}','{$BalancePrice}','{$Remark}')";
		$queryinsert = $class_mysql_default->my_query($insert);
		if(!$queryinsert){
			$retData = array('retVal' => 'FAIL', 'retString' => '插入票价数据失败！', 'sql' => $insert);
			echo json_encode($retData);
			exit();
		}else{
			$retData = array('retVal' => 'SUCCE', 'retString' => '添加成功！', 'sql' => $insert);
			echo json_encode($retData);
		} 
	}
/*	$LineAdjust=$_POST['LineAdjust'];
//	$NoRunsAdjust=$_POST['NoRunsAdjust'];
	$Unit=$_POST['Unit'];
	$ISUnitAdjust=$_POST['ISUnitAdjust'];
//	$ISNoRunsAdjust=$_POST['ISNoRunsAdjust'];
	$ISLineAdjust=$_POST['ISLineAdjust'];
	$DepartureSiteID=$_POST['DepartureSiteID'];
	$DepartureSite=$_POST['DepartureSite'];
	$GetToSiteID=$_POST['GetToSiteID'];
	$GetToSite=$_POST['GetToSite'];
	$ModelName=$_POST['Model'];
	$ModelID=$_POST['ModelID'];
	$BeginDate=$_POST['BeginDate'];
	$EndDate=$_POST['EndDate'];
	$BeginTime=$_POST['BeginTime'];
	$EndTime=$_POST['EndTime'];
	$ReferPrice=$_POST['ReferPrice'];
	$PriceUpPercent=$_POST['PriceUpPercent'];
	$RunPrice=$_POST['RunPrice'];
	$HalfPrice=$_POST['HalfPrice'];
	$BalancePrice=$_POST['BalancePrice'];
	$Remark=$_POST['Remark'];
	$selects="select nrap_ISUnitAdjust from tms_bd_NoRunsAdjustPrice where nrap_ISUnitAdjust='{$ISUnitAdjust}'and nrap_Unit='{$Unit}' and nrap_ISLineAdjust='{$ISLineAdjust}' 
		and nrap_LineAdjust='{$LineAdjust}' and nrap_ISNoRunsAdjust='0' and nrap_DepartureSiteID='{$DepartureSiteID}' and nrap_GetToSiteID='{$GetToSiteID}' 
		and nrap_ModelID='{$ModelID}' and nrap_BeginDate='{$BeginDate}' and nrap_EndDate='{$EndDate}'";
	$seles=$class_mysql_default->my_query($selects);
	if(!mysqli_fetch_array($seles)){
		$insert="insert into tms_bd_NoRunsAdjustPrice (nrap_ISUnitAdjust,nrap_Unit,nrap_ISLineAdjust,nrap_LineAdjust,nrap_ISNoRunsAdjust,nrap_NoRunsAdjust,nrap_DepartureSiteID,
			nrap_DepartureSite,nrap_GetToSiteID,nrap_GetToSite,nrap_ModelID,nrap_ModelName,nrap_BeginDate,nrap_EndDate,nrap_BeginTime,nrap_EndTime,
			nrap_ReferPrice,nrap_PriceUpPercent,nrap_RunPrice,nrap_HalfPrice,nrap_BalancePrice,nrap_Remark) values('{$ISUnitAdjust}','{$Unit}','{$ISLineAdjust}','{$LineAdjust}','0',
			'NULL','{$DepartureSiteID}','{$DepartureSite}','{$GetToSiteID}','{$GetToSite}','{$ModelID}','{$ModelName}','{$BeginDate}',
			'{$EndDate}','{$BeginTime}','{$EndTime}','{$ReferPrice}','{$PriceUpPercent}','{$RunPrice}','{$HalfPrice}','{$BalancePrice}','{$Remark}')";
		$query =$class_mysql_default->my_query($insert); 
		//if (!$query) echo "SQL错误：".->my_error();
		if($query){
			echo"<script>alert('恭喜您！添加成功!');window.location.href='tms_v1_basedata_addlineadjustprice.php?clnumber=$LineAdjust'</script>";
		}else{
			echo"<script>alert('添加失败');window.location.href='tms_v1_basedata_addlineadjustprice.php?clnumber=$LineAdjust'</script>";
		}
	}else{
		echo"<script>alert('所填的信息已存在，请重新选择！');window.location.href='tms_v1_basedata_addlineadjustprice.php?clnumber=$LineAdjust'</script>";	
	} */
?>

