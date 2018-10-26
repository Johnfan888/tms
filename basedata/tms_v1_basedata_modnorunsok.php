<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$LineID=$_POST['LineID'];
	//echo $LineID;
	$LineName=$_POST['LineName'];
	$BeginSiteID=$_POST['BeginSiteID'];
	$BeginSite=$_POST['BeginSite'];
	$EndSiteID=$_POST['EndSiteID'];
	$EndSite=$_POST['EndSite'];
	$DepartureTime=$_POST['DepartureTime']; //发车时间
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
	$IsSucceedLin=$_POST['IsSucceedLin']; //是否继承
	$IsSucceedLine=$_POST['IsSucceedLine'];
	$IsSucceedLine1=$_POST['IsSucceedLine1'];
	$IsThroughAddition=$_POST['IsThroughAddition'];
	$IsExclusive=$_POST['IsExclusive'];
	$IsReturn=$_POST['IsReturn'];
	$AllowSell=$_POST['AllowSell'];
	$AddNoRuns=$_POST['AddNoRuns']; 
	$NoOfRunsID=$_POST['NoOfRunsID']; //班次编号
	$NoOfRunsI=$_POST['NoOfRunsI'];
	$Remark=$_POST['Remark'];
	$CurTime=date('Y-m-d H:i:s');
	$OperateCode=$_POST['OperateCode'];
	$Type=$_POST['Type'];
	$Runtimes='';
	$GettoTime='';
	$allRunminutes=0;
	if($RunHours==''){
		$RunHours=0;
	}
	if($RunMinuts==''){
		$RunMinuts=0;
	}
	if($RunHours!=0 || $RunMinuts!=0){
		$Runtimes=$RunHours.':'.$RunMinuts; //运行时间
		$allRunminutes=$RunHours*60+$RunMinuts;
		if($DepartureTime){
			$GettoTime=date('H:i', strtotime ('+'.$allRunminutes.' minute', strtotime($DepartureTime))); //到达时间
		}
	}
	$select="select nri_NoOfRunsID from tms_bd_NoRunsInfo where nri_NoOfRunsID='{$NoOfRunsID}'";
	$sele= $class_mysql_default->my_query($select);
	if(!mysqli_fetch_array($sele)||$NoOfRunsI==$NoOfRunsID){
		$class_mysql_default->my_query("BEGIN"); //事物操作的开始
		$update="update tms_bd_NoRunsInfo set nri_NoOfRunsID='{$NoOfRunsID}',nri_LineID='{$LineID}',nri_LineName='{$LineName}',
			nri_BeginSiteID='{$BeginSiteID}',nri_BeginSite='{$BeginSite}',nri_EndSiteID='{$EndSiteID}',nri_EndSite='{$EndSite}',
			nri_DepartureTime='{$DepartureTime}',nri_DealCategory='{$DealCategory}',nri_DealStyle='{$DealStyle}',nri_RunHours='{$Runtimes}',
			nri_SeverFeeRate='{$SeverFeeRate}',nri_TempAddFee='{$TempAddFee}',nri_BalanceModel='{$BalanceModel}',nri_CheckTicketWindow='{$CheckTicketWindow}',
			nri_RunRegion='{$RunRegion}',nri_LoopDate='{$LoopDate}',nri_IsStopOrCreat='{$IsStopOrCreat}',nri_Allticket='{$Allticket}',nri_StationDeal='{$StationDeal}',
			nri_IsNightAddition='{$IsNightAddition}',nri_IsSucceedLine='{$IsSucceedLine}',nri_IsThroughAddition='{$IsThroughAddition}',
			nri_IsExclusive='{$IsExclusive}',nri_IsReturn='{$IsReturn}',nri_AllowSell='{$AllowSell}',nri_AddNoRuns='{$AddNoRuns}',nri_ModerID='{$userID}',
			nri_Moder='{$userName}',nri_ModTime='{$CurTime}',nri_OperateCode='{$OperateCode}',nri_Type='{$Type}',nri_Remark='{$Remark}' where nri_NoOfRunsID='{$NoOfRunsI}'";
			$query=$class_mysql_default->my_query($update);
			if(!$query){
				echo "<script>alert('更新班次数据失败！');</script>";
				$class_mysql_default->my_query("ROLLBACK");
				exit();
			}
		//if($IsSucceedLine==$IsSucceedLine1){ //继承关系未改变
			$update11="UPDATE tms_bd_NoRunsDockSite SET nds_NoOfRunsID='{$NoOfRunsID}',nds_CheckTicketWindow='{$CheckTicketWindow}',nds_DepartureTime='{$DepartureTime}' 
				WHERE nds_NoOfRunsID='{$NoOfRunsI}' AND nds_ID='1'";  //修改起点站的检票口，发车时间，班次ID
			$query11 = $class_mysql_default->my_query($update11);
			if(!$query11) {
				echo "<script>alert('更新停靠点1据失败！');</script>";
				$class_mysql_default->my_query("ROLLBACK");
				exit();
			}
			$update13="UPDATE tms_bd_NoRunsDockSite SET nds_NoOfRunsID='{$NoOfRunsID}',nds_DepartureTime='{$GettoTime}',nds_RunHours='{$Runtimes}' WHERE nds_NoOfRunsID='{$NoOfRunsI}' 
				AND nds_SiteID=(SELECT nri_EndSiteID FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID='{$NoOfRunsID}')"; //更新终点信息
			$query13 = $class_mysql_default->my_query($update13);
			if(!$query13){
				echo "<script>alert('更新停靠点3数据失败！');</script>";
				$class_mysql_default->my_query("ROLLBACK");
				exit();
			}
		//}
		if($IsSucceedLine==1){
			$query2="SELECT * from tms_bd_SectionInfo WHERE si_LineID='{$LineID}' AND (si_SiteName) not in (SELECT nds_SiteName FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsID}')
					ORDER BY si_LineID";
			$result = $class_mysql_default->my_query($query2);
			if(!$result){
				echo "<script>alert('查询线路停靠点失败！');</script>";
				$class_mysql_default->my_query("ROLLBACK");
				exit();
			}
			if(mysqli_num_rows($result) != 0){
				while($row=mysqli_fetch_array($result)){
				$SectionID=$row['si_SectionID'];
				//echo $SectionID; 	
				$update1="UPDATE tms_bd_NoRunsDockSite SET nds_ID=nds_ID+1 WHERE nds_NoOfRunsID='{$NoOfRunsID}'and nds_ID >='{$SectionID}' ORDER BY nds_ID DESC";
				$query12 = $class_mysql_default->my_query($update1);
				if(!$query12){
				echo "<script>alert('更新班次停靠点序号失败！');</script>";
				$class_mysql_default->my_query("ROLLBACK");
				exit();
				}
				else{
					$insert1="INSERT INTO tms_bd_NoRunsDockSite (nds_NoOfRunsID,nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,nds_GetOnSite,nds_CheckInSite,
					nds_IsServiceFee,nds_ServiceFee,nds_otherFee1,nds_otherFee2,nds_otherFee3,nds_otherFee4,nds_otherFee5,nds_otherFee6,nds_Remark) 
					SELECT '{$NoOfRunsID}', '$SectionID',si_SiteName,si_SiteNameID,si_IsDock,si_IsGetOnSite,si_IsCheckInSite,si_IsServiceFee,si_ServiceFee,
					si_otherFee1,si_otherFee2,si_otherFee3,si_otherFee4,si_otherFee5,si_otherFee6,si_Remark FROM tms_bd_SectionInfo WHERE si_LineID='{$LineID}' 
				    AND si_SectionID='{$SectionID}' AND (si_SiteName) not in (SELECT nds_SiteName FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsID}')";
			$query1 = $class_mysql_default->my_query($insert1);
			if(!$query1){
				echo "<script>alert('继承线路中停靠点失败！');</script>";
				$class_mysql_default->my_query("ROLLBACK");
				exit();
				}
			}
		}
	}//else结束
}	
	/*	else{
			if($IsSucceedLine==1){ //继承信息
				$del21="DELETE FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsI}'"; //删除所有停靠点
				$query21=$class_mysql_default->my_query($del21);
				if(!$query21){
					echo "<script>alert('删除停靠点数据失败！');</script>";
					$class_mysql_default->my_query("ROLLBACK"); //回退
					exit();
				}
				$insert22="INSERT INTO tms_bd_NoRunsDockSite (nds_NoOfRunsID,nds_CheckTicketWindow,nds_DepartureTime,nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,
					nds_GetOnSite,nds_CheckInSite,nds_RunHours,nds_IsServiceFee,nds_ServiceFee,nds_otherFee1,nds_otherFee2,nds_otherFee3,nds_otherFee4,nds_otherFee5,
					nds_otherFee6,nds_Remark) SELECT '{$NoOfRunsID}','{$CheckTicketWindow}','{$DepartureTime}',si_SectionID,si_SiteName,si_SiteNameID,'1',
					'1','1','0:0',si_IsServiceFee,si_ServiceFee,si_otherFee1,si_otherFee2,si_otherFee3,si_otherFee4,si_otherFee5,si_otherFee6,
					'起点站' FROM tms_bd_SectionInfo WHERE si_LineID='{$LineID}' AND si_SectionID='1'"; //更新已有的信息
				$query22 = $class_mysql_default->my_query($insert22);
				if(!$query22){
					echo "<script>alert('插入停靠点22数据失败！');</script>";
					$class_mysql_default->my_query("ROLLBACK");
					exit();
				}
				$insert23="INSERT INTO tms_bd_NoRunsDockSite (nds_NoOfRunsID,nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,nds_GetOnSite,nds_CheckInSite,
					nds_IsServiceFee,nds_ServiceFee,nds_otherFee1,nds_otherFee2,nds_otherFee3,nds_otherFee4,nds_otherFee5,nds_otherFee6,nds_Remark) 
					SELECT '{$NoOfRunsID}', si_SectionID,si_SiteName,si_SiteNameID,'1',si_IsGetOnSite,si_IsCheckInSite,si_IsServiceFee,si_ServiceFee,
					si_otherFee1,si_otherFee2,si_otherFee3,si_otherFee4,si_otherFee5,si_otherFee6,si_Remark FROM tms_bd_SectionInfo WHERE si_LineID='{$LineID}' 
					AND si_SectionID>1 AND si_SectionID<(SELECT MAX(si_SectionID) FROM tms_bd_SectionInfo WHERE si_LineID='{$LineID}')";
				$query23 = $class_mysql_default->my_query($insert23);
				if(!$query23){
					echo "<script>alert('插入停靠点23数据失败！');</script>";
					$class_mysql_default->my_query("ROLLBACK");
					exit();
				}
				$insert24="INSERT INTO tms_bd_NoRunsDockSite (nds_NoOfRunsID,nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,nds_GetOnSite,nds_CheckInSite,
					nds_DepartureTime,nds_RunHours,nds_IsServiceFee,nds_ServiceFee,nds_otherFee1,nds_otherFee2,nds_otherFee3,nds_otherFee4,nds_otherFee5,
					nds_otherFee6,nds_Remark) SELECT '{$NoOfRunsID}', si_SectionID,si_SiteName,si_SiteNameID,'1','0','0','{$GettoTime}','{$Runtimes}',
					si_IsServiceFee,si_ServiceFee,si_otherFee1,si_otherFee2,si_otherFee3,si_otherFee4,si_otherFee5,si_otherFee6,'终点站' 
					FROM tms_bd_SectionInfo WHERE si_LineID='{$LineID}' AND si_SectionID=(SELECT MAX(si_SectionID) FROM tms_bd_SectionInfo 
					WHERE si_LineID='{$LineID}')";
				$query24 = $class_mysql_default->my_query($insert24);
				if(!$query24){
					echo "<script>alert('插入停靠点23数据失败！');</script>";
					$class_mysql_default->my_query("ROLLBACK");
					exit();
				}
			}
			else{
				$update31="UPDATE tms_bd_NoRunsDockSite SET nds_NoOfRunsID='{$NoOfRunsID}',nds_CheckTicketWindow='{$CheckTicketWindow}',nds_DepartureTime='{$DepartureTime}' 
					WHERE nds_NoOfRunsID='{$NoOfRunsI}' AND nds_ID='1'";
				$query31=$class_mysql_default->my_query($update31);
				if(!$query31){
					echo "<script>alert('更新停靠点31数据失败！');</script>";
					$class_mysql_default->my_query("ROLLBACK");
					exit();
				}
				$del32="DELETE FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsI}' AND nds_ID>1"; //删除终点
				$query32=$class_mysql_default->my_query($del32);
				if(!$query32){
					echo "<script>alert('删除停靠点32数据失败！');</script>";
					$class_mysql_default->my_query("ROLLBACK");
					exit();
				}
				$insert33="INSERT INTO tms_bd_NoRunsDockSite (nds_NoOfRunsID,nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,nds_GetOnSite,nds_CheckInSite,
					nds_DepartureTime,nds_RunHours,nds_Remark) VALUES('{$NoOfRunsID}','2','{$EndSite}','{$EndSiteID}','1','0','0','{$GettoTime}',
					'{$Runtimes}','终点站')";
				$query33=$class_mysql_default->my_query($insert33);
				if(!$query33){
					echo "<script>alert('插入停靠点33数据失败！');</script>";
					$class_mysql_default->my_query("ROLLBACK");
					exit();
				}
			}
		} */
		$class_mysql_default->my_query("COMMIT");
		echo"<script>alert('恭喜您！修改成功!');window.location.href='tms_v1_basedata_searnoruns.php'</script>";
	}
	else{
		echo"<script>alert('班次编码已存在，请重新输入！');window.location.href='tms_v1_basedata_modnoruns.php?op=mod&clnumber&clnumber=$NoOfRunsI'</script>";
	} 
?>
	