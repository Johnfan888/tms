<?php
	$NoOfRunsID=$_GET['NoOfRunsID'];
	$LoopID=$_GET['noid'];
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$class_mysql_default->my_query("BEGIN");
	$sql = "DELETE FROM tms_bd_NoRunsLoop WHERE nrl_NoOfRunsID='{$NoOfRunsID}' and nrl_LoopID='{$LoopID}'";
	$query = $class_mysql_default->my_query($sql);
	if(!$query){
		$class_mysql_default->my_query("ROLLBACK");
		echo "<script>alert('删除失败！');location.assign('tms_v1_basedata_searbusloop.php?op=see&clnumber=$NoOfRunsID');</script>";
	}
	$update="UPDATE tms_bd_NoRunsLoop SET nrl_LoopID=nrl_LoopID-1 WHERE nrl_NoOfRunsID='{$NoOfRunsID}' AND nrl_LoopID>'{$LoopID}'";
	$queryupdate=$class_mysql_default->my_query($update);
	if(!$queryupdate){
		$class_mysql_default->my_query("ROLLBACK");
		echo "<script>alert('删除失败！');location.assign('tms_v1_basedata_searbusloop.php?op=see&clnumber=$NoOfRunsID');</script>";
	}
	$class_mysql_default->my_query("COMMIT");
	echo "<script>alert('删除成功！ 请返回。');location.assign('tms_v1_basedata_searbusloop.php?op=see&clnumber=$NoOfRunsID');</script>";
/*	if ($query) {
		echo "<script>alert('删除成功！ 请返回。');location.assign('tms_v1_basedata_searbusloop.php?op=see&clnumber=$NoOfRunsID');</script>";
	//	exit("<div style=\"padding:100px;\"><h2 align=\"center\">
	//	删除成功,!请<a href=\"./tms_v1_basedata_searbusloop.php?op=see&clnumber=$NoOfRunsID\"> 返回</a>
	//	</h2></div>");
	}else{
		echo "<script>alert('删除失败！');location.assign('tms_v1_basedata_searbusloop.php?op=see&clnumber=$NoOfRunsID');</script>";
	} */
?>
