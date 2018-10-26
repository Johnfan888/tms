
<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$op=$_REQUEST['op'];
	if($op=="modrunprice"){
		$ID=$_REQUEST['ID'];
		$LineAdjust=$_REQUEST['LineAdjust'];
		$ISUnitAdjust=$_REQUEST['ISUnitAdjust'];
		$ISNoRunsAdjust=$_REQUEST['ISNoRunsAdjust'];
		$NoRunsAdjust=$_REQUEST['NoRunsAdjust'];
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
		$ReferPrice=$_REQUEST['ReferPrice'];
		$RunPrice=$_REQUEST['RunPrice'];
		$HalfPrice=$_REQUEST['HalfPrice'];
		$BalancePrice=$_REQUEST['BalancePrice'];
		$Remark=$_REQUEST['Remark'];
		$selects="SELECT nrap_BeginDate,nrap_EndDate FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ISUnitAdjust='{$ISUnitAdjust}' AND nrap_Unit='{$Unit}' AND 
			nrap_ISNoRunsAdjust='{$ISNoRunsAdjust}' AND nrap_NoRunsAdjust='{$NoRunsAdjust}' AND nrap_LineAdjust='{$LineAdjust}' AND nrap_ISLineAdjust='0' AND 
			nrap_DepartureSiteID='{$DepartureSiteID}' AND nrap_GetToSiteID='{$GetToSiteID}' AND nrap_ModelID='{$ModelID}' AND nrap_ID!='{$ID}'";
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
		$update="UPDATE tms_bd_NoRunsAdjustPrice SET nrap_BeginDate='{$BeginDate}',nrap_EndDate='{$EndDate}',nrap_ReferPrice='{$ReferPrice}',nrap_RunPrice='{$RunPrice}',
			nrap_HalfPrice='{$HalfPrice}',nrap_BalancePrice='{$BalancePrice}',nrap_Remark='{$Remark}' WHERE nrap_ID='{$ID}'";
		$queryupdate=$class_mysql_default->my_query($update);
		if(!$queryupdate){
			$retData = array('retVal' => 'FAIL', 'retString' => '修改票价数据失败！', 'sql' => $update);
			echo json_encode($retData);
			exit();
		}else{
			$retData = array('retVal' => 'SUCCE', 'retString' => '修改成功！', 'sql' => $update);
			echo json_encode($retData);
		} 
	}
/*	$ID=$_POST['ID'];
	$LineAdjust=$_POST['LineAdjust'];
	$Unit=$_POST['Unit'];
	$ISUnitAdjust=$_POST['ISUnitAdjust'];
	$ISNoRunsAdjust=$_POST['ISNoRunsAdjust'];
//	$ISLineAdjust=$_POST['ISLineAdjust'];
	$NoRunsAdjust=$_POST['NoRunsAdjust'];
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
	$selects="select * from tms_bd_NoRunsAdjustPrice where nrap_ISUnitAdjust='{$ISUnitAdjust}'and nrap_Unit='{$Unit}' and nrap_ISLineAdjust='0' 
		and nrap_LineAdjust='{$LineAdjust}' and nrap_ISNoRunsAdjust='{$ISNoRunsAdjust}' and nrap_NoRunsAdjust='{$NoRunsAdjust}' and 
		nrap_DepartureSiteID='{$DepartureSiteID}' and nrap_GetToSiteID='{$GetToSiteID}' and nrap_ModelID='{$ModelID}' and nrap_BeginDate='{$BeginDate}' 
		and nrap_EndDate='{$EndDate}' and nrap_ID!='{$ID}'";
	$seles=$class_mysql_default->my_query($selects);
	$result=mysqli_fetch_array($seles);
	if(!$result){
		$update="update tms_bd_NoRunsAdjustPrice set nrap_ISUnitAdjust='{$ISUnitAdjust}',nrap_Unit='{$Unit}',nrap_ISLineAdjust='0',
			nrap_LineAdjust='{$LineAdjust}',nrap_ISNoRunsAdjust='{$ISNoRunsAdjust}',nrap_NoRunsAdjust='{$NoRunsAdjust}',nrap_DepartureSiteID='{$DepartureSiteID}',
			nrap_DepartureSite='{$DepartureSite}',nrap_GetToSiteID='{$GetToSiteID}',nrap_GetToSite='{$GetToSite}',nrap_ModelID='{$ModelID}',nrap_ModelName='{$ModelName}',
			nrap_BeginDate='{$BeginDate}',nrap_EndDate='{$EndDate}',nrap_BeginTime='{$BeginTime}',nrap_EndTime='{$EndTime}',nrap_ReferPrice='{$ReferPrice}',
			nrap_PriceUpPercent='{$PriceUpPercent}',nrap_RunPrice='{$RunPrice}',nrap_HalfPrice='{$HalfPrice}',nrap_BalancePrice='{$BalancePrice}',nrap_Remark='{$Remark}' 
			where nrap_ID='{$ID}'";
		$query = $class_mysql_default->my_query($update); 
	//	if (!$query) echo "SQL错误：".->my_error();
		if($query){
			echo"<script>alert('恭喜您！修改成功!');window.location.href='tms_v1_basedata_searnorunsadjustprice.php?clnumber=$NoRunsAdjust'</script>";
		}else{
			echo"<script>alert('修改失败');window.location.href='tms_v1_basedata_searnorunsadjustprice.php?clnumber=$NoRunsAdjust'</script>";
		}
	}else{
		echo"<script>alert('所填的信息已存在，请重新选择！');window.location.href='tms_v1_basedata_searnorunsadjustprice.php?clnumber=$NoRunsAdjust'</script>";	
	} */
?>
