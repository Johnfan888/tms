<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$op = $_REQUEST['op'];
	if($op=='read'){
		$queryString = "SELECT it_ComCode,it_HandlerCode,it_Handler1Code,it_OperatorCode,it_ApporverCode FROM tms_bd_InsureType ";
		$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			$retData = array('retVal' => 'FAIL', 'retString' => '查询保险数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$row = mysql_fetch_array($result);
		$retData = array(
			'COMCODE' => $row['it_ComCode'],
			'HANDLERCODE' => $row['it_HandlerCode'],
			'HANDLER1CODE' => $row['it_Handler1Code'],
			'OPERATORCODE'=> $row['it_OperatorCode'],
			'APPORVERCODE' => $row['it_ApporverCode']);
		echo json_encode($retData);
	} 
	if ($op=='write'){
		$COMCODE=trim($_GET['COMCODE']);
		$HANDLERCODE=trim($_GET['HANDLERCODE']);
		$HANDLER1CODE=trim($_GET['HANDLER1CODE']);
		$OPERATORCODE=trim($_GET['OPERATORCODE']);
		$APPORVERCODE=trim($_GET['APPORVERCODE']);
	/*	$retData = array(
			'COMCODE' => $COMCODE,
			'HANDLERCODE' => $HANDLERCODE,
			'HANDLER1CODE' => $HANDLER1CODE,
			'OPERATORCODE'=> $OPERATORCODE,
			'APPORVERCODE' => $APPORVERCODE );
		echo json_encode($retData); */
		$queryString = "UPDATE tms_bd_InsureType SET it_ComCode='{$COMCODE}',it_HandlerCode='{$HANDLERCODE}',
			it_Handler1Code='{$HANDLER1CODE}',it_OperatorCode='{$OPERATORCODE}',it_ApporverCode='{$APPORVERCODE}'";
		$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			// echo "SQL错误：".mysql_error()
			$retData = array('retVal' => 'FAIL', 'retString' =>  '更新保险数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}else{
			$retData = array('retVal' => 'FAIL', 'retString' => '更新保险数据成功！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		} 
		
	}
?>