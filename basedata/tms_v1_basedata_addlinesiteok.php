<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$LineID=$_POST['LineID'];
	$LineName=$_POST['LineName'];
	$SectionID=$_POST['SectionID'];
	$SiteID=$_POST['SiteID'];
	$SiteName=$_POST['SiteName'];
	$Kilometer=$_POST['Kilometer'];
	$IsDock=$_POST['IsDock'];
	$IsGetOnSite=$_POST['IsGetOnSite'];
	$IsCheckInSite=$_POST['IsCheckInSite'];
	$IsTollInSite=$_POST['IsTollInSite'];
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
	$selects="select si_LineID from tms_bd_SectionInfo where si_LineID='{$LineID}' and si_SiteNameID='{$SiteID}'";
	$seles=$class_mysql_default->my_query($selects);
	if(!mysqli_fetch_array($seles)){
		$class_mysql_default->my_query("START TRANSACTION");
			$update="UPDATE tms_bd_SectionInfo SET si_SectionID=si_SectionID+1 WHERE si_LineID='{$LineID}' AND si_SectionID>='{$SectionID}' ORDER BY si_SectionID DESC";
			$query11=$class_mysql_default->my_query($update);
			if(!$query11){
				$class_mysql_default->my_query("ROLLBACK");
				echo"<script>alert('更新序号失败');window.location.href='tms_v1_basedata_addlinesite.php?op=see&LineID=$LineID&LineName=$LineName'</script>";
				exit();
			}
		//	if (!$query1) echo "SQL错误：".->my_error();
		$insert="insert into tms_bd_SectionInfo (si_LineID,si_LineName,si_SectionID,si_SiteNameID,si_SiteName,si_Kilometer,
			si_IsDock,si_IsGetOnSite,si_IsCheckInSite,si_IsTollInSite,si_IsServiceFee,si_ServiceFee,si_otherFee1,
			si_otherFee2,si_otherFee3,si_otherFee4,si_otherFee5,si_otherFee6,si_Remark) values('{$LineID}',
			'{$LineName}','{$SectionID}','{$SiteID}','{$SiteName}','{$Kilometer}','{$IsDock}','{$IsGetOnSite}','{$IsCheckInSite}',
			'{$IsTollInSite}','{$IsServiceFee}','{$ServiceFee}','{$otherFee1}','{$otherFee2}','{$otherFee3}',
			'{$otherFee4}','{$otherFee5}','{$otherFee6}','{$Remark}')";
		$query =$class_mysql_default->my_query($insert);
		if(!$query){
			$class_mysql_default->my_query("ROLLBACK");
			echo"<script>alert('插入数据失败');window.location.href='tms_v1_basedata_addlinesite.php?op=see&LineID=$LineID&LineName=$LineName'</script>";
			exit();
		}
		$class_mysql_default->my_query("COMMIT");
		echo"<script>alert('恭喜您！添加成功!');window.location.href='tms_v1_basedata_addlinesite.php?op=see&LineID=$LineID&LineName=$LineName'</script>";
		$class_mysql_default->my_query("END TRANSACTION");
	}else{
		echo"<script>alert('所选站点已存在，请重新选择！');window.location.href='tms_v1_basedata_addlinesite.php?op=see&LineID=$LineID&LineName=$LineName'</script>";			
	}
	
?>
