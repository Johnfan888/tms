<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$op=$_REQUEST['op'];
	if($op=='add'){
		$BeginTicket=trim($_GET['BeginTicket']);
		$length=strlen($BeginTicket);
		$EndTicket=trim($_GET['EndTicket']);
		$CurrentTicket=trim($_GET['BeginTicket']);
		$AddNum=trim($_GET['AddNum']);
		$Type=trim($_GET['Type']);
		$Remark=trim($_GET['Remark']);
		$user=$userName;
		$showtime=date("Y-m-d");
		$Curtime=date("H:i");
	/*	$select="SELECT ta_BeginTicket,ta_EndTicket FROM tms_bd_TicketAdd WHERE ta_Type='{$Type}' AND
			((ta_BeginTicket+0<='{$BeginTicket}' AND ta_EndTicket+0>='{$BeginTicket}') OR 
			(ta_BeginTicket+0>='{$BeginTicket}' AND ta_BeginTicket+0<='{$EndTicket}'))"; */
		$select="SELECT ta_BeginTicket,ta_EndTicket FROM tms_bd_TicketAdd WHERE ta_Type='{$Type}' AND
			((ta_BeginTicket+0<='{$BeginTicket}' AND ta_EndTicket+0>='{$BeginTicket}' AND LENGTH(ta_BeginTicket)='{$length}') OR 
			(ta_BeginTicket+0>='{$BeginTicket}' AND ta_BeginTicket+0<='{$EndTicket}') AND LENGTH(ta_BeginTicket)='{$length}')";
		$query1=$class_mysql_default->my_query($select);
		if (!$query1) echo json_encode("SQL错误：".->my_error());
		if(mysqli_fetch_array($query1)){
			$retData = array('sucess' => '2');
			echo json_encode($retData);
		} 
		else{
			$retData = array('sucess' => '1');
			echo json_encode($retData);
		}
	}
	
	if($op=='add1'){
		$BeginTicket=trim($_GET['BeginTicket']);
		$EndTicket=trim($_GET['EndTicket']);
		$CurrentTicket=trim($_GET['BeginTicket']);
		$AddNum=trim($_GET['AddNum']);
		$Type=trim($_GET['Type']);
		$Remark=trim($_GET['Remark']);
		$user=$userName;
		$showtime=date("Y-m-d");
		$Curtime=date("H:i");
			$insert="insert into tms_bd_TicketAdd (ta_Data,ta_Time,ta_BeginTicket,ta_EndTicket,ta_CurrentTicket,ta_AddNum,ta_LostNum,ta_Type,
				ta_UserID,ta_User,ta_UserSation,ta_Remark) values('{$showtime}','{$Curtime}','{$BeginTicket}','{$EndTicket}','{$CurrentTicket}','{$AddNum}','{$AddNum}',
				'{$Type}','{$userID}','{$user}','{$userStationName}','{$Remark}')";
			$query2 =$class_mysql_default->my_query($insert);
			if($query2){
				$retData = array('sucess' => '1');
				echo json_encode($retData);
			}else{
				$retData = array('sucess' => '0');
				echo json_encode($retData);
			}
		}
	//}
?>