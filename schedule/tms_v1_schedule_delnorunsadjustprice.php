
<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$op=$_REQUEST['op'];
	if($op=="del"){
		$NoOfRunsID=$_REQUEST['NoOfRunsID'];
		$ID=$_REQUEST['ID'];
		$del = "DELETE FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ID='{$ID}'";
		$querydel =$class_mysql_default->my_query($del);
		if(!$querydel){
			$retData = array('retVal' => 'FAIL', 'retString' => '删除班次票价数据失败！'.->my_error(), 'sql' => $del);
			echo json_encode($retData);
			exit();	
		}
		$retData = array('retVal' => 'SUCC', 'retString' => '删除成功！', 'sql' => $delbusloop,'query'=>$querydelbusloop);
		echo json_encode($retData);
	}
?>
