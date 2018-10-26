<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$LineID=$_POST['LineID'];
	$LineName=$_POST['LineName'];
	$LineKind=$_POST['LineKind'];
	$LineDegree=$_POST['LineDegree'];
	$LineType=$_POST['LineType'];
	$Direction=$_POST['Direction'];
	$Kilometer=$_POST['Kilometer'];
	$BeginSite=$_POST['BeginSite'];
	$BeginSiteID=$_POST['BeginSiteID'];
	$EndSite=$_POST['EndSite'];
	$EndSiteID=$_POST['EndSiteID'];
	$StationID=$_POST['StationID'];
	$Station=$_POST['Station'];
	$Linestate=$_POST['Linestate'];
	$InRegion=$_POST['InRegion'];
	$Remark=$_POST['Remark'];
	$CurTime=date('Y-m-d H:i:s');
	$select="select * from tms_bd_LineInfo where li_LineID='{$LineID}'";
	$sele=$class_mysql_default$class_mysql_default->my_query($select);
	if(!mysqli_fetch_array($sele)){
		$class_mysql_default->my_query("START TRANSACTION");
		$insert="INSERT INTO `tms_bd_LineInfo` (`li_LineID`,`li_LineName`,`li_LineKind`,`li_LineDegree`,
			li_LineType,li_Direction,li_Kilometer, li_BeginSite,li_BeginSiteID,li_EndSite,
			li_EndSiteID,li_StationID,li_Station,li_Linestate,li_InRegion,li_AdderID,li_Adder,li_AddTime,li_Remark) VALUES ('{$LineID}', 
			'{$LineName}', '{$LineKind}','{$LineDegree}','{$LineType}','{$Direction}','{$Kilometer}',
			'{$BeginSite}','{$BeginSiteID}','{$EndSite}','{$EndSiteID}','{$StationID}','{$Station}', 
			'{$Linestate}','{$InRegion}', '{$userID}','{$userName}','{$CurTime}' ,'{$Remark}');";
		$query = $class_mysql_default$class_mysql_default->my_query($insert);
		$insert1="INSERT INTO tms_bd_SectionInfo (si_LineID,si_LineName,si_SectionID,si_SiteNameID,si_SiteName,si_Kilometer,
				si_IsDock,si_IsGetOnSite,si_IsCheckInSite,si_IsTollInSite,si_IsServiceFee,si_ServiceFee,si_otherFee1,
				si_otherFee2,si_otherFee3,si_otherFee4,si_otherFee5,si_otherFee6,si_Remark) values('{$LineID}',
				'{$LineName}','1','{$BeginSiteID}','{$BeginSite}','0','0','1','1',NULL,NULL,NULL,NULL,NULL,NULL,
				NULL,NULL,NULL,'起点站')";
		$query1= $class_mysql_default$class_mysql_default->my_query($insert1);
		$insert2="INSERT INTO tms_bd_SectionInfo (si_LineID,si_LineName,si_SectionID,si_SiteNameID,si_SiteName,si_Kilometer,
				si_IsDock,si_IsGetOnSite,si_IsCheckInSite,si_IsTollInSite,si_IsServiceFee,si_ServiceFee,si_otherFee1,
				si_otherFee2,si_otherFee3,si_otherFee4,si_otherFee5,si_otherFee6,si_Remark) values('{$LineID}',
				'{$LineName}','2','{$EndSiteID}','{$EndSite}','{$Kilometer}','1','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,
				NULL,NULL,NULL,'终点站')";
		$query2= $class_mysql_default$class_mysql_default->my_query($insert2);
		//if (!$query) echo "SQL错误：".->my_error();
		if($query && $query1 && $query2 ){
			$class_mysql_default->my_query("COMMIT");
			echo"<script>alert('恭喜您！添加成功!');window.location.href='tms_v1_basedata_addline.php'</script>";
		}else{
			$class_mysql_default->my_query("ROLLBACK");
			echo"<script>alert('添加失败');window.location.href='tms_v1_basedata_addline.php'</script>";
		}
		$class_mysql_default->my_query("END TRANSACTION");
	}else{
		echo"<script>alert('线路编号已存在，请重新输入！');window.location.href='tms_v1_basedata_addline.php'</script>";
	} 

?>
