<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$ModelID=$_POST['ModelID'];
	$ModelName=$_POST['ModelName'];
	$PriceProject=$_POST['PriceProject'];
	$PriceProjec=$_POST['PriceProjec'];
	$BeginDate=$_POST['BeginDate'];
	$EndDate=$_POST['EndDate'];
	$MoneyRenKil=$_POST['MoneyRenKil'];
	$Remark=$_POST['Remark'];
	$select="select * from tms_bd_TicketPriceFactor where tpf_ModelID='{$ModelID}' and tpf_PriceProject='{$PriceProject}'";
	$sele=$class_mysql_default->my_query($select);
	if(!mysql_fetch_array($sele) || $PriceProjec==$PriceProject){
		$update="update tms_bd_TicketPriceFactor set tpf_PriceProject='{$PriceProject}',tpf_BeginDate='{$BeginDate}',
			tpf_EndDate='{$EndDate}',tpf_MoneyRenKil='{$MoneyRenKil}',tpf_Remark='{$Remark}' where tpf_ModelID='{$ModelID}' and
			tpf_PriceProject='{$PriceProjec}' ";	
			$query = $class_mysql_default->my_query($update);
			if($query){
				echo"<script>alert('恭喜您！修改成功!');window.location.href='tms_v1_basedata_searticketpricefactor.php?clnumber=$ModelID'</script>";
			}else{
				echo"<script>alert('修改失败');window.location.href='tms_v1_basedata_searticketpricefactor.php?clnumber=$ModelID'</script>";
			}
	}else{
			echo"<script>alert('票价因素已存在，请重新输入！');window.location.href='tms_v1_basedata_searticketpricefactor.php?clnumber=$ModelID'</script>";
		}
?>
