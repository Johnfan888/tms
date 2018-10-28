<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$op=$_REQUEST['op'];
	if($op=="modlineservice"){
		$ID=$_REQUEST['ID'];
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
		$ModelName=$_REQUEST['Model'];
		$BeginDate=$_REQUEST['BeginDate'];
		$EndDate=$_REQUEST['EndDate'];
		$RunPrice=$_REQUEST['RunPrice'];
		$Remark=$_REQUEST['Remark'];
		$select="SELECT sfa_BeginDate,sfa_EndDate FROM tms_bd_ServiceFeeAdjust WHERE sfa_ISUnitAdjust='{$ISUnitAdjust}' AND sfa_Unit='{$Unit}' AND 
			sfa_ISLineAdjust='{$ISLineAdjust}' AND sfa_LineAdjust='{$LineAdjust}' AND sfa_ISNoRunsAdjust='0' AND sfa_DepartureSiteID='{$DepartureSiteID}' AND 
			sfa_GetToSiteID='{$GetToSiteID}' AND sfa_ModelID='{$ModelID}' AND sfa_ID!='{$ID}' AND (sfa_NoRunsAdjust is NULL)";
		$query=$class_mysql_default->my_query($select);
		if(!$query){
			$retData = array('retVal' => 'FAIL', 'retString' => '查询站务费数据失败！'.$class_mysql_default->my_error(), 'sql' => $selects);
			echo json_encode($retData);
			exit();
		}
		while($row=mysqli_fetch_array($query)){
			if($BeginDate==$row['sfa_BeginDate'] && $EndDate==$row['sfa_EndDate']){
				$retData = array('retVal' => 'FAIL1', 'retString' => '该记录已存在！', 'sql' => $selects);
				echo json_encode($retData);
				exit();
			}
			if(($BeginDate>$row['sfa_BeginDate'] && $BeginDate<=$row['sfa_EndDate'] && $EndDate>$row['sfa_EndDate']) || ($BeginDate<$row['sfa_BeginDate'] && $EndDate>=$row['sfa_BeginDate'] && $EndDate<$row['sfa_EndDate'])){
				$retData = array('retVal' => 'FAIL1', 'retString' => '和开始时间'.$row['sfa_BeginDate'].'结束时间'.$row['sfa_EndDate'].'有时间交叉！', 'sql' => $selects);
				echo json_encode($retData);
				exit();
			}	
		}
		$update="UPDATE tms_bd_ServiceFeeAdjust SET sfa_BeginDate='{$BeginDate}',sfa_EndDate='{$EndDate}',sfa_RunPrice='{$RunPrice}',
			sfa_Remark='{$Remark}' WHERE  sfa_ID='{$ID}'";
		$queryupdate=$class_mysql_default->my_query($update);
		if(!$queryupdate){
			$retData = array('retVal' => 'FAIL', 'retString' => '修改站务费数据失败！', 'sql' => $update);
			echo json_encode($retData);
			exit();
		}else{
			$retData = array('retVal' => 'SUCCE', 'retString' => '修改成功！', 'sql' => $update);
			echo json_encode($retData);
		} 
	}
/*	$ID=$_POST['ID'];
	$LineAdjust=$_POST['LineAdjust'];
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
	$RunPrice=$_POST['RunPrice'];
	$Remark=$_POST['Remark'];

	$selects="select * from tms_bd_ServiceFeeAdjust where sfa_ISUnitAdjust='{$ISUnitAdjust}' and sfa_Unit='{$Unit}' and sfa_ISLineAdjust='{$ISLineAdjust}' 
		and sfa_LineAdjust='{$LineAdjust}' and sfa_ISNoRunsAdjust='0' and sfa_DepartureSiteID='{$DepartureSiteID}' and sfa_GetToSiteID='{$GetToSiteID}' and 
		sfa_ModelID='{$ModelID}' and sfa_BeginDate='{$BeginDate}' and sfa_EndDate='{$EndDate}'and sfa_ID!='{$ID}'";
	$seles=$class_mysql_default->my_query($selects);
	$result=mysqli_fetch_array($seles);
//	echo $result;
	if(!$result || $result['sfa_ID']==$ID){
		$update="UPDATE tms_bd_ServiceFeeAdjust SET sfa_ISUnitAdjust='{$ISUnitAdjust}',sfa_Unit='{$Unit}',sfa_ISLineAdjust='{$ISLineAdjust}',sfa_LineAdjust='{$LineAdjust}',
			sfa_ISNoRunsAdjust='0',sfa_NoRunsAdjust='NULL',sfa_DepartureSiteID='{$DepartureSiteID}',sfa_DepartureSite='{$DepartureSite}',sfa_GetToSiteID='{$GetToSiteID}',
			sfa_GetToSite='{$GetToSite}',sfa_ModelID='{$ModelID}',sfa_ModelName='{$ModelName}',sfa_BeginDate='{$BeginDate}',sfa_EndDate='{$EndDate}',
			sfa_BeginTime='{$BeginTime}',sfa_EndTime='{$EndTime}',sfa_RunPrice='{$RunPrice}',sfa_Remark='{$Remark}' WHERE sfa_ID='{$ID}'";
		$query = $class_mysql_default->my_query($update); 
		//if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
		if($query){
			echo"<script>alert('恭喜您！修改成功!');window.location.href='tms_v1_basedata_searlineservicefeeadjust.php?clnumber=$LineAdjust'</script>";
		}else{
			echo"<script>alert('修改失败');window.location.href='tms_v1_basedata_searlineservicefeeadjust.php?clnumber=$LineAdjust'</script>";
		}
	}else{
		echo"<script>alert('所填的信息已存在，请重新选择！');window.location.href='tms_v1_basedata_searlineservicefeeadjust.php?clnumber=$LineAdjust'</script>";	
	} */
?>