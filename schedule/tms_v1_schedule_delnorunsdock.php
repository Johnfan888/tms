
<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$NoOfRunsID = $_GET['NoOfRunsID'];
	$noid=$_GET['noid'];
	if ($_GET['op'] == "del" ){
		$class_mysql_default->my_query("START TRANSACTION");
		$sql = "DELETE FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsID}' and nds_ID='{$noid}'";
		$query =$class_mysql_default->my_query($sql);
		$update="UPDATE tms_bd_NoRunsDockSite SET nds_ID=nds_ID-1 WHERE nds_NoOfRunsID='{$NoOfRunsID}'and nds_ID>'{$noid}' ";
		$query1 =  $class_mysql_default->my_query($update);
		if ($query && $query1) {
			$class_mysql_default->my_query("COMMIT");
		//	exit("<div style=\"padding:100px;\"><h2 align=\"center\">
		//	删除成功,!请<a href=\"./tms_v1_basedata_searrunsdock.php?op=see&clnumber=$NoOfRunsID\"> 返回</a>
		//	</h2></div>");
			echo "<script>alert('删除成功！ 请返回。');location.assign('tms_v1_schedule_moddock.php?op=see&clnumber=$NoOfRunsID');</script>";
		}else{
			$class_mysql_default->my_query("ROLLBACK");
			echo "<script>alert('删除失败！');location.assign('tms_v1_basedata_moddock.php?op=see&clnumber=$NoOfRunsID');</script>";
		}
		$class_mysql_default->my_query("END TRANSACTION");
	}
?>
