<?php
//	$clnumber = $_GET['clnumber'];
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$op = $_REQUEST['op'];
	if ($op=='del'){
		$ID=trim($_GET['ID']);
		$IDi=trim($_GET['IDi']);
		$class_mysql_default->my_query("START TRANSACTION");
		$sql = "DELETE FROM `tms_bd_FeeType` WHERE ft_ID='{$ID}'";
		$query = $class_mysql_default->my_query($sql);		
		for($i=$IDi;$i<15;$i++){
			$j=$i+1;
		$update="UPDATE tms_acct_BusRate SET br_Rate".$i."=br_Rate".$j." where br_BusID!='' ";
		$query1 =  $class_mysql_default->my_query($update);
		if (!$query1) echo "SQL错误：".mysql_error();
		}
		$sele=$class_mysql_default->my_query($select);
		if ($query&&$query1) {
			$class_mysql_default->my_query("COMMIT");
			$retData = array(
				'sucess' => '1');
			echo json_encode($retData);
		}else{
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array(
				'sucess' => '0');
			echo json_encode($retData);
		}
		$class_mysql_default->my_query("END TRANSACTION");
	}
?>
