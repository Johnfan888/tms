<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber = $_GET['clnumber'];
	$section=$_GET['section'];
	if ($_GET['op'] == "dellinesite" ){
		$class_mysql_default->my_query("START TRANSACTION");
		$sql = "DELETE FROM `tms_bd_SectionInfo` WHERE si_LineID='{$clnumber}' and si_SectionID='{$section}'";
		$query =  $class_mysql_default$class_mysql_default->my_query($sql);
		$update="UPDATE tms_bd_SectionInfo SET si_SectionID=si_SectionID-1 WHERE si_LineID='{$clnumber}'and si_SectionID>'{$section}' ";
		$query1 =  $class_mysql_default$class_mysql_default->my_query($update);
		if ($query && $query1) {
			$class_mysql_default->my_query("COMMIT");
			//exit("<div style=\"padding:100px;\"><h2 align=\"center\">
			//删除成功,!请<a href=\"./tms_v1_basedata_Linesite.php?op=see&clnumber=$clnumber\"> 返回</a>
			//</h2></div>");
			echo "<script>alert('删除成功！ 请返回。');location.assign('tms_v1_basedata_linesite.php?op=see&clnumber=$clnumber');</script>";
		}else{
			$class_mysql_default->my_query("ROLLBACK");
		//	exit("<div style=\"padding:100px;\"><h2 align=\"center\">
		//	删除失败,!请<a href=\"./tms_v1_basedata_Linesite.php?op=see&clnumber=$clnumber\"> 返回</a>
		//	</h2></div>");
			echo "<script>alert('删除失败！');location.assign('tms_v1_basedata_Linesite.php?op=see&clnumber=$clnumber');</script>";
		}
		$class_mysql_default->my_query("END TRANSACTION");
	}
?>
