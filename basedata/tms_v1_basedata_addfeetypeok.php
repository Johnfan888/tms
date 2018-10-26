<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	
	if(isset($_POST['FeeTypeName'])){
		$num=$_POST['num'];
		$FeeTypeName = $_POST['FeeTypeName'];
		$FeeTypeComputer=$_POST['FeeTypeComputer'];
		$Feepercent=$_POST['Feepercent'];
		$Feefix=$_POST['Feefix'];
		$HelpCode=$_POST['HelpCode'];
		$Remark=$_POST['Remark'];
		$IsDock=$_POST['IsDock'];
		$IsDock0=$_POST['IsDock0'];
		$CurTime=date('Y-m-d H:i:s');
		$class_mysql_default->my_query("START TRANSACTION");
		$state=0;
		if($FeeTypeComputer=="按百分比收费"&&$Feepercent!=''&&$IsDock==1){
			$state=1;
			$update="UPDATE tms_acct_BusRate SET br_Rate".$num."='{$Feepercent}' where br_BusID!='' ";
			$query1 =  $class_mysql_default->my_query($update);
		}
		if($FeeTypeComputer=="固定金额收费"&&$Feefix!=''&&$IsDock0==1){
			$state=1;
			$update="UPDATE tms_acct_BusRate SET br_Rate".$num."='{$Feefix}' where br_BusID!='' ";
			$query1 =  $class_mysql_default->my_query($update);
		}
		$select="select ft_FeeTypeName from tms_bd_FeeType where ft_FeeTypeName='{$FeeTypeName}'";
		$sele=$class_mysql_default->my_query($select);
		if(!mysqli_fetch_array($sele)){
			$insert="INSERT INTO `tms_bd_FeeType` (`ft_FeeTypeName`,`ft_FeeTypeComputer`,`ft_FeePercent`,`ft_FeeFix`,`ft_HelpCode`,`ft_AdderID`,`ft_Adder`,`ft_AddTime`,`ft_Remark`) VALUES 
				('{$FeeTypeName}', '{$FeeTypeComputer}','{$Feepercent}','{$Feefix}','{$HelpCode}','{$userID}','{$userName}','{$CurTime}','{$Remark}')";
			$query = $class_mysql_default->my_query($insert);
			if($state==0){
				if($query){
					$num=$num+1;
//					echo $num;
					$class_mysql_default->my_query("COMMIT");
					echo"<script>alert('添加成功！');window.location.href='tms_v1_basedata_addfeetype.php?num=$num'</script>";					
				}else{
					$class_mysql_default->my_query("ROLLBACK");
					echo"<script>alert('添加失败！');window.location.href='tms_v1_basedata_addfeetype.php?num=$num'</script>";
				}
			}else{
				if($query&&$query1){
					$num=$num+1;
//					echo $num;
					$class_mysql_default->my_query("COMMIT");
					echo"<script>alert('添加成功！');window.location.href='tms_v1_basedata_addfeetype.php?num=$num'</script>";
				}else{
//					if (!$query) echo "SQL错误1：".->my_error();
//					if (!$query1) echo "SQL错误2：".->my_error();
					echo ->my_error();
					$class_mysql_default->my_query("ROLLBACK");
					echo"<script>alert('添加失败！');window.location.href='tms_v1_basedata_addfeetype.php?num=$num'</script>";
				}
			}
		}else{
			echo"<script>alert('收费类型已存在，请重新输入！');window.location.href='tms_v1_basedata_addfeetype.php?num=$num'</script>";
			$class_mysql_default->my_query("END TRANSACTION");
		}
	}
?>