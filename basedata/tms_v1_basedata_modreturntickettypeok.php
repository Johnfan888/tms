<?php
//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$ReturnType = $_POST['ReturnType'];
$ReturnTyp=$_POST['ReturnTyp'];
$ReturnRate = $_POST['ReturnRate'];
$ReturnTimeBegin = $_POST['ReturnTimeBegin'];
$ReturnTimeEnd=$_POST['ReturnTimeEnd'];
$select="select * from tms_sell_ReturnType where rte_ReturnType='{$ReturnType}'";
$sele= $class_mysql_default->my_query($select);
$result=mysqli_fetch_array($sele);
if($result==false ||$ReturnType==$ReturnTyp){
	$update="update tms_sell_ReturnType set rte_ReturnType='{$ReturnType}', rte_ReturnRate='{$ReturnRate}', rte_ReturnTimeBegin='{$ReturnTimeBegin}', 
		rte_ReturnTimeEnd='{$ReturnTimeEnd}' where rte_ReturnType='{$ReturnTyp}'";
	$query =$class_mysql_default->my_query($update);
	if($query){
		echo"<script>alert('恭喜您！修改成功!');window.location.href='tms_v1_basedata_searreturntickettype.php'</script>";
	}else{
		echo"<script>alert('修改失败');window.location.href='tms_v1_basedata_searreturntickettype.php'</script>";
	}
}else{
	echo"<script>alert('退票类型已存在，请重新输入！');window.location.href='tms_v1_basedata_modreturntickettype.php?clnumber=$ReturnTyp'</script>";
}
?>
