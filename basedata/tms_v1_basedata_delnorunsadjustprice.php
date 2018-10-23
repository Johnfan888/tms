<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$op=$_REQUEST['op'];
	if($op=="del"){
		$NoOfRunsID=$_REQUEST['NoOfRunsID'];
		$ID=$_REQUEST['ID'];
		$select="SELECT nrap_NoRunsAdjust,nrap_ModelID FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ID='{$ID}'";
		$queryselect=$class_mysql_default->my_query($select);
		if(!$queryselect){
			$retData = array('retVal' => 'FAIL', 'retString' => '查询班次票价数据失败！', 'sql' => $select);
			echo json_encode($retData);
			exit();	
		}
		$rowselect=mysql_fetch_array($queryselect);
		$class_mysql_default->my_query("BEGIN");
		$del = "DELETE FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ID='{$ID}'";
		$querydel =$class_mysql_default->my_query($del);
		if(!$querydel){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '删除班次票价数据失败！', 'sql' => $del);
			echo json_encode($retData);
			exit();	
		}
		$selectmodel="SELECT nrap_ModelID FROM tms_bd_NoRunsAdjustPrice WHERE nrap_NoRunsAdjust='{$NoOfRunsID}' AND nrap_ModelID='{$rowselect['nrap_ModelID']}'";
		$querymodel =$class_mysql_default->my_query($selectmodel);
		if(!$querymodel){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '查询班次票价数据失败1！', 'sql' => $selectmodel);
			echo json_encode($retData);
			exit();
		}
		if(mysql_num_rows($querymodel) == 0){
			$delbusloop="DELETE FROM tms_bd_NoRunsLoop WHERE nrl_NoOfRunsID='{$NoOfRunsID}' AND nrl_ModelID='{$rowselect['nrap_ModelID']}'";
			$querydelbusloop=$class_mysql_default->my_query($delbusloop);
			if(!$querydelbusloop){
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '删除班次车辆循环数据失败！', 'sql' => $delbusloop);
				echo json_encode($retData);
				exit();
			}
		}
		$class_mysql_default->my_query("COMMIT");
		$retData = array('retVal' => 'SUCC', 'retString' => '删除成功！', 'sql' => $delbusloop,'query'=>$querydelbusloop);
		echo json_encode($retData);
	}
/*	$clnumber=$_GET['clnumber'];
	$clnumber1=$_GET['clnumber1'];
	if ($_GET['op']=="del" ){
		$sql = "DELETE FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ID='{$clnumber}'";
		$query =$class_mysql_default->my_query($sql);
		if ($query) {
			echo "<script>alert('删除成功！ 请返回。');location.assign('tms_v1_basedata_searnorunsadjustprice.php?clnumber=$clnumber1');</script>";
		}else{
			echo "<script>alert('删除失败！');location.assign('tms_v1_basedata_searnorunsadjustprice.php?clnumber=$clnumber1');</script>";
		}
	} */
?>

