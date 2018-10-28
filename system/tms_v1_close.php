<?php
 
     define("AUTH", "TRUE");
        //载入初始化文件
     require_once("../ui/inc/init.inc.php");
        $uiState = "下线";
        $LogoutTime = date("Y-m-d   H:i:s");
        //UPDATE Person SET Address = 'Zhongshan 23', City = 'Nanjing'WHERE LastName = 'Wilson'                 
        $strsql = "update tms_sys_OnlineUser set ui_UserState = '$uiState', ui_LoginTime = NULL, ui_LogoutTime = '$LogoutTime' where ui_UserID = '$userID'";
        $query = $class_mysql_default->my_query($strsql);                

		if ($query) {
			$retData = array(
				'sucess' => '1','sq' => $strsql);
			echo json_encode($retData);
		}else{
			$retData = array(
				'sucess' => '0');
			echo json_encode($retData);
		}

?>
