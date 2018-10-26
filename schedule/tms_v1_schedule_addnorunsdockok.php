
<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$NoOfRunsID=$_POST['NoOfRunsID'];
	$LineID=$_POST['LineID'];
	$ID=$_POST['ID'];
	$SiteName=$_POST['SiteName'];
	$SiteID=$_POST['SiteID'];
	$IsDock=$_POST['IsDock'];
	$GetOnSite=$_POST['GetOnSite'];
	$CheckInSite=$_POST['CheckInSite'];
	$RunHours=$_POST['RunHours'];
	$RunMinuts=$_POST['RunMinuts'];
	$DepartureTime=$_POST['DepartureTime'];
	$CheckTicketWindow=$_POST['CheckTicketWindow'];
	$IsServiceFee=$_POST['IsServiceFee'];
	$ServiceFee=$_POST['ServiceFee'];
	$otherFee1=$_POST['otherFee1'];
	$otherFee2=$_POST['otherFee2'];
	$otherFee3=$_POST['otherFee3'];
	$otherFee3=$otherFee3/100;
	$otherFee4=$_POST['otherFee4'];
	$otherFee5=$_POST['otherFee5'];
	$otherFee6=$_POST['otherFee6'];
	$StintSell=$_POST['StintSell'];
	$StintTime=$_POST['StintTime'];
	$Remark=$_POST['Remark'];
	if($RunHours==''){
		$RunHours=0;
	}
	if($RunMinuts==''){
		$RunMinuts=0;
	}
	if($RunHours!=0 || $RunMinuts!=0){
		$Runtimes=$RunHours.':'.$RunMinuts;
	}
	$selects="select nds_NoOfRunsID from tms_bd_NoRunsDockSite where nds_NoOfRunsID='{$NoOfRunsID}' and nds_SiteID='{$SiteID}'";
	$seles=$class_mysql_default->my_query($selects);
	if(!mysqli_fetch_array($seles)){
		$class_mysql_default->my_query("START TRANSACTION");
		$update="UPDATE tms_bd_NoRunsDockSite SET nds_ID=nds_ID+1 WHERE nds_NoOfRunsID='{$NoOfRunsID}' AND nds_ID>='{$ID}'ORDER BY nds_ID DESC";
		$query1=$class_mysql_default->my_query($update);
		$insert="INSERT INTO tms_bd_NoRunsDockSite (nds_NoOfRunsID,nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,nds_GetOnSite,
			nds_CheckInSite,nds_DepartureTime,nds_RunHours,nds_CheckTicketWindow,nds_IsServiceFee,nds_ServiceFee,nds_otherFee1,
			nds_otherFee2,nds_otherFee3,nds_otherFee4,nds_otherFee5,nds_otherFee6,nds_StintSell,nds_StintTime,nds_Remark) VALUES ('{$NoOfRunsID}',
			'{$ID}','{$SiteName}','{$SiteID}','{$IsDock}','{$GetOnSite}','{$CheckInSite}','{$DepartureTime}','{$Runtimes}','{$CheckTicketWindow}',
			'{$IsServiceFee}','{$ServiceFee}','{$otherFee1}','{$otherFee2}','{$otherFee3}','{$otherFee4}','{$otherFee5}','{$otherFee6}',
			'{$StintSell}','{$StintTime}','{$Remark}')";
		$query = $class_mysql_default->my_query($insert); 
			//if (!$query) echo "SQL错误：".->my_error();
		if($query1 && $query){
			$class_mysql_default->my_query("COMMIT");
			echo"<script>alert('恭喜您！添加成功!');window.location.href='tms_v1_schedule_addnorunsdock.php?NoOfRunsID=$NoOfRunsID&LineID=$LineID'</script>";
		}else{
			$class_mysql_default->my_query("ROLLBACK");
			echo"<script>alert('添加失败');window.location.href='tms_v1_schedule_addnorunsdock.php?NoOfRunsID=$NoOfRunsID&LineID=$LineID'</script>";
		}
		$class_mysql_default->my_query("END TRANSACTION");
	}else{
		echo"<script>alert('所选站点已存在，请重新选择！');window.location.href='tms_v1_schedule_addnorunsdock.php?NoOfRunsID=$NoOfRunsID&LineID=$LineID'</script>";	
	}
?>

