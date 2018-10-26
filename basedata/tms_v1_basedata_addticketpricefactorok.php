<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$ModelID=$_POST['ModelID'];
	$ModelName=$_POST['ModelName'];
	$PriceProject=$_POST['PriceProject'];
	$BeginDate=$_POST['BeginDate'];
	$EndDate=$_POST['EndDate'];
	$MoneyRenKil=$_POST['MoneyRenKil'];
	$Remark=$_POST['Remark'];
	$select="select * from tms_bd_TicketPriceFactor where tpf_ModelID='{$ModelID}' and tpf_PriceProject='{$PriceProject}'";
	$sele=$query = $class_mysql_default->my_query($select);
	if(!mysqli_fetch_array($sele)){
			$insert="insert into tms_bd_TicketPriceFactor (tpf_ModelID,tpf_ModelName,tpf_PriceProject,tpf_BeginDate,tpf_EndDate,
				tpf_MoneyRenKil,tpf_Remark) values('{$ModelID}','{$ModelName}','{$PriceProject}','{$BeginDate}','{$EndDate}',
				'{$MoneyRenKil}','{$Remark}')";
			$query = $query = $class_mysql_default->my_query($insert);
			if($query){
				echo"<script>alert('恭喜您！添加成功!');window.location.href='tms_v1_basedata_searticketpricefactor.php?clnumber=$ModelID'</script>";
			}else{
				echo"<script>alert('添加失败');window.location.href='tms_v1_basedata_searticketpricefactor.php?clnumber=$ModelID'</script>";
			}
	}else{
			echo"<script>alert('票价因素已存在，请重新输入！');window.location.href='tms_v1_basedata_searticketpricefactor.php?clnumber=$ModelID'</script>";
		}
?>
