<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$LineID=$_POST['LineID'];
	$LineName=$_POST['LineName'];
	$BeginSiteID=$_POST['BeginSiteID'];
	$BeginSite=$_POST['BeginSite'];
	$EndSiteID=$_POST['EndSiteID'];
	$EndSite=$_POST['EndSite'];
	$DepartureTime=$_POST['DepartureTime'];
	$RunHours=$_POST['RunHours'];
	$RunMinuts=$_POST['RunMinuts'];
	$DealCategory=$_POST['DealCategory'];
	$DealStyle=$_POST['DealStyle'];
	$SeverFeeRate=$_POST['SeverFeeRate'];
	$TempAddFee=$_POST['TempAddFee'];
	$CheckTicketWindow=$_POST['CheckTicketWindow'];
	$BalanceModel=$_POST['BalanceModel'];
	$RunRegion=$_POST['RunRegion'];
	$LoopDate=$_POST['LoopDate'];
	$IsStopOrCreat=$_POST['IsStopOrCreat'];
	$Allticket=$_POST['Allticket'];
	$StationDeal=$_POST['StationDeal'];
	$IsNightAddition=$_POST['IsNightAddition'];
	$IsSucceedLine=$_POST['IsSucceedLine'];
	$IsThroughAddition=$_POST['IsThroughAddition'];
	$IsExclusive=$_POST['IsExclusive'];
	$IsReturn=$_POST['IsReturn'];
	$AllowSell=$_POST['AllowSell'];
	$AddNoRuns=$_POST['AddNoRuns']; 
	$NoOfRunsID=$_POST['NoOfRunsID'];
	$Remark=$_POST['Remark']; 
	$CurTime=date('Y-m-d H:i:s');
	$OperateCode=$_POST['OperateCode'];
	$Type=$_POST['Type'];
	$Runtimes='';
	$allRunminutes=0;
	$GettoTime='';
	if($RunHours==''){
		$RunHours=0;
	}
	if($RunMinuts==''){
		$RunMinuts=0;
	}
	if($RunHours!=0 || $RunMinuts!=0){
		$Runtimes=$RunHours.':'.$RunMinuts;
		$allRunminutes=$RunHours*60+$RunMinuts;
		if($DepartureTime){
			$GettoTime=date('H:i', strtotime ('+'.$allRunminutes.' minute', strtotime($DepartureTime)));
		}
	}
	$select="SELECT nri_NoOfRunsID FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID='{$NoOfRunsID}'";
	$sele=$class_mysql_default->my_query($select);
	if(!mysql_fetch_array($sele)){
		$class_mysql_default->my_query("BEGIN");
		$insert="insert into tms_bd_NoRunsInfo (nri_NoOfRunsID,nri_LineID,nri_LineName,nri_BeginSiteID,
			nri_BeginSite,nri_EndSiteID,nri_EndSite,nri_DepartureTime,nri_DealCategory,nri_DealStyle,
			nri_RunHours,nri_SeverFeeRate,nri_TempAddFee,nri_BalanceModel,nri_CheckTicketWindow,nri_RunRegion,
			nri_LoopDate,nri_IsStopOrCreat,nri_Allticket,nri_StationDeal,nri_IsNightAddition,nri_IsSucceedLine,
			nri_IsThroughAddition,nri_IsExclusive,nri_IsReturn,nri_AllowSell,nri_AddNoRuns,nri_AdderID,nri_Adder,nri_AddTime,
			nri_OperateCode,nri_Type,nri_Remark) 
			values('{$NoOfRunsID}','{$LineID}','{$LineName}','{$BeginSiteID}','{$BeginSite}','{$EndSiteID}','{$EndSite}',
			'{$DepartureTime}','{$DealCategory}','{$DealStyle}','{$Runtimes}','{$SeverFeeRate}','{$TempAddFee}',
			'{$BalanceModel}','{$CheckTicketWindow}','{$RunRegion}','{$LoopDate}','{$IsStopOrCreat}','{$Allticket}','{$StationDeal}',
			'{$IsNightAddition}','{$IsSucceedLine}','{$IsThroughAddition}','{$IsExclusive}','{$IsReturn}','{$AllowSell}',
			'{$AddNoRuns}','{$userID}','{$userName}','{$CurTime}','{$OperateCode}','{$Type}','{$Remark}')";
		$query = $class_mysql_default->my_query($insert);
		if ($IsSucceedLine==1){
			$insert1="INSERT INTO tms_bd_NoRunsDockSite (nds_NoOfRunsID,nds_CheckTicketWindow,nds_DepartureTime,nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,
				nds_GetOnSite,nds_CheckInSite,nds_RunHours,nds_IsServiceFee,nds_ServiceFee,nds_otherFee1,nds_otherFee2,nds_otherFee3,nds_otherFee4,nds_otherFee5,
				nds_otherFee6,nds_Remark) SELECT '{$NoOfRunsID}','{$CheckTicketWindow}','{$DepartureTime}',si_SectionID,si_SiteName,si_SiteNameID,'0',
				'1','1','0:0',si_IsServiceFee,si_ServiceFee,si_otherFee1,si_otherFee2,si_otherFee3,si_otherFee4,si_otherFee5,si_otherFee6,
				'起点站' FROM tms_bd_SectionInfo WHERE si_LineID='{$LineID}' AND si_SectionID='1'";
			$query1 = $class_mysql_default->my_query($insert1);
			$insert2="INSERT INTO tms_bd_NoRunsDockSite (nds_NoOfRunsID,nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,nds_GetOnSite,nds_CheckInSite,
				nds_IsServiceFee,nds_ServiceFee,nds_otherFee1,nds_otherFee2,nds_otherFee3,nds_otherFee4,nds_otherFee5,nds_otherFee6,nds_Remark) 
				SELECT '{$NoOfRunsID}', si_SectionID,si_SiteName,si_SiteNameID,'1',si_IsGetOnSite,si_IsCheckInSite,si_IsServiceFee,si_ServiceFee,
				si_otherFee1,si_otherFee2,si_otherFee3,si_otherFee4,si_otherFee5,si_otherFee6,si_Remark FROM tms_bd_SectionInfo WHERE si_LineID='{$LineID}' 
				AND si_SectionID>1 AND si_SectionID<(SELECT MAX(si_SectionID) FROM tms_bd_SectionInfo WHERE si_LineID='{$LineID}')";
			$query2 = $class_mysql_default->my_query($insert2);
			$insert5="INSERT INTO tms_bd_NoRunsDockSite (nds_NoOfRunsID,nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,nds_GetOnSite,nds_CheckInSite,
				nds_DepartureTime,nds_RunHours,nds_IsServiceFee,nds_ServiceFee,nds_otherFee1,nds_otherFee2,nds_otherFee3,nds_otherFee4,nds_otherFee5,
				nds_otherFee6,nds_Remark) SELECT '{$NoOfRunsID}', si_SectionID,si_SiteName,si_SiteNameID,'1','0','0','{$GettoTime}','{$Runtimes}',
				si_IsServiceFee,si_ServiceFee,si_otherFee1,si_otherFee2,si_otherFee3,si_otherFee4,si_otherFee5,si_otherFee6,'终点站' 
				FROM tms_bd_SectionInfo WHERE si_LineID='{$LineID}' AND si_SectionID=(SELECT MAX(si_SectionID) FROM tms_bd_SectionInfo 
				WHERE si_LineID='{$LineID}')";
			$query5 = $class_mysql_default->my_query($insert5);
		}else{
			$insert3="INSERT INTO tms_bd_NoRunsDockSite (nds_NoOfRunsID,nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,nds_GetOnSite,nds_CheckInSite,
				nds_CheckTicketWindow,nds_DepartureTime,nds_RunHours,nds_Remark) VALUES ('{$NoOfRunsID}','1','{$BeginSite}','{$BeginSiteID}',
				'0','1','1','{$CheckTicketWindow}','{$DepartureTime}','0:0','起点站')";
			$query3= $class_mysql_default->my_query($insert3);
			$insert4="INSERT INTO tms_bd_NoRunsDockSite (nds_NoOfRunsID,nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,nds_GetOnSite,nds_CheckInSite,
				nds_DepartureTime,nds_RunHours,nds_Remark) VALUES('{$NoOfRunsID}','2','{$EndSite}','{$EndSiteID}','1','0','0','{$GettoTime}',
				'{$Runtimes}','终点站')";
			$query4= $class_mysql_default->my_query($insert4);
		} 
		if($query &&(($query1 && $query2 && $query5) || ($query3 && $query4))){
			$class_mysql_default->my_query("COMMIT");
			echo"<script>alert('恭喜您！添加成功!');window.location.href='tms_v1_basedata_addnoruns.php'</script>";
		}else{
			$class_mysql_default->my_query("ROLLBACK");
			echo"<script>alert('添加失败');window.location.href='tms_v1_basedata_addnoruns.php'</script>";
		}
		$class_mysql_default->my_query("END TRANSACTION");
	}else{
			echo"<script>alert('班次编号已存在，请重新输入！');window.location.href='tms_v1_basedata_addnoruns.php'</script>";
		} 
?>
