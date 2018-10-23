<?php
//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$RegionC=$_POST['RegionC'];
$RegionCode = $_POST['RegionCode'];
$RegionName = $_POST['RegionName'];
$RegionFullName = $_POST['RegionFullName'];
$HelpCode=$_POST['HelpCode'];
//$IdCode=$_POST['IdCode'];
$Remark=$_POST['Remark'];
$CurTime=date('Y-m-d H:i:s');
if(isset($RegionCode)){
	if($RegionCode!=null){
		$select="select * from tms_bd_RegionSet where rs_RegionCode='{$RegionCode}'";
		$sele= $class_mysql_default->my_query($select);
		$result=mysql_fetch_array($sele);
		if($result==false ||$RegionC==$RegionCode){
			$update="update tms_bd_RegionSet set rs_RegionCode='{$RegionCode}', rs_RegionName='{$RegionName}', rs_RegionFullName='{$RegionFullName}', 
				rs_ModerID='{$userID}', rs_Moder='{$userName}', rs_ModTime='{$CurTime}', rs_HelpCode='{$HelpCode}', rs_Remark='{$Remark}' where rs_RegionCode='{$RegionC}'";
			$query =$class_mysql_default->my_query($update);
			if($query){
				echo"<script>alert('恭喜您！修改成功!');window.location.href='tms_v1_basedata_searregion.php'</script>";
			}else{
				echo"<script>alert('修改失败');window.location.href='tms_v1_basedata_searregion.php'</script>";
			}
		}else{
			echo"<script>alert('区域编码已存在，请重新输入！');window.location.href='tms_v1_basedata_modregion.php?clnumber=$RegionC'</script>";
		}
	}else{
		echo"<script>alert('请填写完整的信息');window.location.href='tms_v1_basedata_modregion.php?clnumber=$RegionC'</script>";
	}
}
?>
