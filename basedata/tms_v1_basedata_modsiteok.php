<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$SiteI=$_POST['SiteI'];
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
	$CurTime=date('Y-m-d H:i:s');
	$Remark=$_POST['Remark'];
	$select="select * from tms_bd_SiteSet where sset_SiteID='{$SiteId}'";
	$sele= $class_mysql_default->my_query($select);
	$result=mysql_fetch_array($sele);
	if(!$result||$SiteI==$SiteId){
		$update="UPDATE tms_bd_SiteSet set sset_SiteID='{$SiteId}', sset_SiteName='{$SiteName}', sset_SiteType='{$SiteType}', sset_SiteRank='{$SiteRank}',
			sset_OperateCode='{$OperateCode}',sset_HelpCode='{$HelpCode}', sset_Region='{$Region}', sset_IsStation='{$IsStation}', sset_IsTollSite='{$IsTollSite}',
			sset_StationAdOrg='{$StationAdOrg}',sset_ModerID='{$userID}', sset_Moder='{$userName}',sset_ModTime='{$CurTime}', sset_Remark='{$Remark}' 
			WHERE sset_SiteID='{$SiteI}'";
		$query = $class_mysql_default->my_query($update);
		if($query){
			echo"<script>alert('恭喜您！修改成功!');window.location.href='tms_v1_basedata_searsite.php'</script>";
		}else{
			echo"<script>alert('修改失败');window.location.href='tms_v1_basedata_searsite.php'</script>";
		}
	}else{
			echo"<script>alert('站点编号已存在，请重新输入！');window.location.href='tms_v1_basedata_modsite.php?op=mod&clnumber=$SiteI'</script>";
		}
	
?>
