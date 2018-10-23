<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$LineID=$_POST['LineID'];
	$LineName=$_POST['LineName'];
	$SectionID=$_POST['SectionID'];
//	$SectionI=$_POST['SectionI'];
	$SiteID=$_POST['SiteID'];
	$SiteIDD=$_POST['SiteIDD'];
	$SiteName=$_POST['SiteName'];
	$Kilometer=$_POST['Kilometer'];
	$IsDock=$_POST['IsDock'];
	$IsGetOnSite=$_POST['IsGetOnSite'];
	$IsCheckInSite=$_POST['IsCheckInSite'];
//	$IsTollInSite=$_POST['IsTollInSite'];
	$IsServiceFee=$_POST['IsServiceFee'];
	$ServiceFee=$_POST['ServiceFee'];
	$otherFee1=$_POST['otherFee1'];
	$otherFee2=$_POST['otherFee2'];
	$otherFee3=$_POST['otherFee3'];
	$otherFee3=$otherFee3/100;
	$otherFee4=$_POST['otherFee4'];
	$otherFee5=$_POST['otherFee5'];
	$otherFee6=$_POST['otherFee6'];
	$Remark=$_POST['Remark'];
//	echo $Kilometer;
//	echo $Remark;
	$selects="select * from tms_bd_SectionInfo where si_LineID='{$LineID}' and si_SiteNameID='{$SiteID}'";
	$seles=$class_mysql_default->my_query($selects);
	if(!mysql_fetch_array($seles) || $SiteID==$SiteIDD){
		$updata="update tms_bd_SectionInfo set si_LineID='{$LineID}',si_LineName='{$LineName}',si_SectionID='{$SectionID}',
			si_SiteNameID='{$SiteID}',si_SiteName='{$SiteName}',si_Kilometer='{$Kilometer}',si_IsDock='{$IsDock}',
			si_IsGetOnSite='{$IsGetOnSite}',si_IsCheckInSite='{$IsCheckInSite}',si_IsTollInSite='{$IsTollInSite}',
			si_IsServiceFee='{$IsServiceFee}',si_ServiceFee='{$ServiceFee}',si_otherFee1='{$otherFee1}',si_otherFee2='{$otherFee2}',
			si_otherFee3='{$otherFee3}',si_otherFee4='{$otherFee4}',si_otherFee5='{$otherFee5}',si_otherFee6='{$otherFee6}',si_Remark='{$Remark}'
			where si_LineID='{$LineID}' and si_SectionID='{$SectionID}' ";
		$query =$class_mysql_default->my_query($updata);
	//	if (!$query) echo "SQL错误：".mysql_error();
		if($query){
			echo"<script>alert('恭喜您！修改成功!');window.location.href='tms_v1_basedata_linesite.php?op=see&clnumber=$LineID'</script>";
		}else{
			echo"<script>alert('修改失败');window.location.href='tms_v1_basedata_linesite.php?op=see&clnumber=$LineID'</script>";
		}
	}else{
		echo"<script>alert('所选站点已存在，请重新选择！');window.location.href='tms_v1_basedata_linesite.php?op=see&clnumber=$LineID'</script>";	
	}
?>

