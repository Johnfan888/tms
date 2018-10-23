
<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$NoOfRunsID=$_POST['NoOfRunsID'];
	$ID=$_POST['ID'];
	$SiteName=$_POST['SiteName'];
	$SiteID=$_POST['SiteID'];
	$SiteIDD=$_POST['SiteID'];
	$IsDock=$_POST['IsDock'];
	$GetOnSite=$_POST['GetOnSite'];
	$CheckInSite=$_POST['CheckInSite'];
	$DepartureTime=$_POST['DepartureTime'];
	$RunHours=$_POST['RunHours'];
	$RunMinuts=$_POST['RunMinuts'];
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
	$selects="select nds_ID from tms_bd_NoRunsDockSite where nds_NoOfRunsID='{$NoOfRunsID}' and nds_SiteName='{$SiteName}'";
	$seles= $class_mysql_default->my_query($selects);
	if(!mysql_fetch_array($seles)||$SiteID==$SiteIDD){
		$updata="update tms_bd_NoRunsDockSite set nds_NoOfRunsID='{$NoOfRunsID}',nds_ID='{$ID}',nds_SiteName='{$SiteName}',
			nds_SiteID='{$SiteID}',nds_IsDock='{$IsDock}',nds_GetOnSite='{$GetOnSite}',nds_CheckInSite='{$CheckInSite}',
			nds_DepartureTime='{$DepartureTime}',nds_RunHours='{$Runtimes}',nds_CheckTicketWindow='{$CheckTicketWindow}',nds_IsServiceFee='{$IsServiceFee}',
			nds_ServiceFee='{$ServiceFee}',nds_otherFee1='{$otherFee1}',nds_otherFee2='{$otherFee2}',nds_otherFee3='{$otherFee3}',
			nds_otherFee4='{$otherFee4}',nds_otherFee5='{$otherFee5}',nds_otherFee6='{$otherFee6}',nds_StintSell='{$StintSell}',
			nds_StintTime='{$StintTime}',nds_Remark='{$Remark}'where nds_NoOfRunsID='{$NoOfRunsID}' and nds_ID='{$ID}'";
		$query = $class_mysql_default->my_query($updata); 
		//	if (!$query) echo "SQL错误：".mysql_error();
		if($query){
			echo"<script>alert('恭喜您！修改成功!');window.location.href='tms_v1_schedule_moddock.php?op=see&clnumber=$NoOfRunsID'</script>";
		}else{
			echo"<script>alert('修改失败');window.location.href='tms_v1_schedule_moddock.php?op=see&clnumber=$NoOfRunsID'</script>";
		}
	}else{
		echo"<script>alert('所选站点已存在，请重新选择！');window.location.href='tms_v1_schedule_moddock.php?op=see&clnumber=$NoOfRunsID'</script>";	
	}
		
?>

