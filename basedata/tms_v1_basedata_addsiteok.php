<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$SiteId=$_POST['SiteId'];
	$SiteName=$_POST['SiteName'];
	$SiteType=$_POST['SiteType'];
	$SiteRank=$_POST['SiteRank'];
	$OperateCode=$_POST['OperateCode'];
	$HelpCode=$_POST['HelpCode'];
//	$IdCode=$_POST['IdCode'];
	$Region=$_POST['Region'];
	$IsStation=$_POST['IsStation'];
	$IsTollSite=$_POST['IsTollSite'];
	$StationAdOrg=$_POST['StationAdOrg'];
	if($StationAdOrg == "请选择所属机构"){
		$StationAdOrg = "";
	}
	$Remark=$_POST['Remark'];
	$CurTime=date('Y-m-d H:i:s');
	$select="select * from tms_bd_SiteSet where sset_SiteID='{$SiteId}'";
	$sele=$class_mysql_default->my_query($select);
	if(!mysql_fetch_array($sele)){
		$insert="insert into tms_bd_SiteSet (sset_SiteID,sset_SiteName,sset_SiteType,sset_SiteRank,sset_OperateCode,
			sset_HelpCode,sset_Region,sset_IsStation,sset_IsTollSite, sset_StationAdOrg,sset_AdderID,sset_Adder,sset_AddTime,
			sset_Remark) values('{$SiteId}','{$SiteName}','{$SiteType}','{$SiteRank}','{$OperateCode}','{$HelpCode}',
			'{$Region}','{$IsStation}','{$IsTollSite}','{$StationAdOrg}','{$userID}','{$userName}','{$CurTime}','{$Remark}')";
		$query = $class_mysql_default->my_query($insert);
		echo mysql_error();
		if($query){
			echo"<script>alert('恭喜您！添加成功!');window.location.href='tms_v1_basedata_addsite.php'</script>";
		}else{
			echo"<script>alert('添加失败');window.location.href='tms_v1_basedata_addsite.php'</script>";
		}
	}else{
			echo"<script>alert('站点编号已存在，请重新输入！');window.location.href='tms_v1_basedata_addsite.php'</script>";
		} 
?>
