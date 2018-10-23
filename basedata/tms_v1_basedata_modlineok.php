<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$LineID=$_POST['LineID'];
	$LineI=$_POST['LineI'];
//	$LineName=$_POST['LineName'];
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
	$sele= $class_mysql_default->my_query($select);
	if(!mysql_fetch_array($sele)||$LineI==$LineID){
		mysql_query("START TRANSACTION");
		$update="update tms_bd_LineInfo set li_LineID='{$LineID}', li_LineKind='{$LineKind}', 
		 	 li_LineDegree='{$LineDegree}',li_LineType='{$LineType}', li_Direction='{$Direction}', li_Kilometer='{$Kilometer}', 
		 	 li_StationID='{$StationID}', li_Station='{$Station}', li_Linestate='{$Linestate}', li_InRegion='{$InRegion}', 
		 	 li_ModerID='{$userID}',li_Moder='{$userName}',li_ModTime='{$CurTime}',li_Remark='{$Remark}' where Li_LineID='{$LineI}'";
		$query = $class_mysql_default->my_query($update);
		$update1="UPDATE tms_bd_SectionInfo SET  si_LineID='{$LineID}',si_LineName='{$LineName}'  WHERE si_LineID='{$LineI}'";
		$query1 = $class_mysql_default->my_query($update1);
		$update2="UPDATE tms_bd_SectionInfo SET  si_SiteNameID='{$BeginSiteID}',si_SiteName='{$BeginSite}' WHERE si_LineID='{$LineID}' and si_SectionID='1'";
		$query2=$class_mysql_default->my_query($update2);
		$sqls="select count(*) from tms_bd_SectionInfo where si_LineID='{$LineID}'";
		$querys = $class_mysql_default->my_query($sqls);
		$results=mysql_fetch_array($querys); 
		$update3="UPDATE tms_bd_SectionInfo SET  si_SiteNameID='{$EndSiteID}',si_SiteName='{$EndSite}', si_Kilometer='{$Kilometer}' WHERE si_LineID='{$LineID}' and 
			si_SectionID='{$results[0]}'";
		$query3=$class_mysql_default->my_query($update3);
		if (!$query3) echo "SQL错误：".mysql_error();
		if($query && $query1 && $query2 && $query3){
			mysql_query("COMMIT");
			echo"<script>alert('恭喜您！修改成功!');window.location.href='tms_v1_basedata_searline.php'</script>";
		}else{
			mysql_query("ROLLBACK");
			echo"<script>alert('修改失败');window.location.href='tms_v1_basedata_searline.php'</script>";
		}
		mysql_query("END TRANSACTION");
	}else{
			echo"<script>alert('线路编号已存在，请重新输入！!');window.location.href='tms_v1_basedata_modline.php?op=mod&clnumber=$LineID'</script>";
		}
?> 
