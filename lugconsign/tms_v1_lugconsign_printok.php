<?php
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$op = $_REQUEST['op'];
switch ($op)
{
	case "confirmprint":
	  
		$TicketNumber=$_REQUEST['TicketNumber'];
		$Destination=$_REQUEST['Destination'];
		$NoOfRunsID=$_REQUEST['NoOfRunsID'];
		$BusID=$_REQUEST['BusID'];
		$BusNumber=$_REQUEST['BusNumber'];
		$DeliveryDate=$_REQUEST['DeliveryDate'];
		$ConsignName=$_REQUEST['ConsignName'];
		$ConsignTel=$_REQUEST['ConsignTel'];
		$ConsignPaperID=$_REQUEST['ConsignPaperID'];
		$ConsignAdd=$_REQUEST['ConsignAdd'];
		$ConsignMoney=$_REQUEST['ConsignMoney'];
		$PackingMoney=$_REQUEST['PackingMoney'];
		$LabelMoney=$_REQUEST['LabelMoney'];
		$HandlingMoney=$_REQUEST['HandlingMoney'];
		$UnloadName=$_REQUEST['UnloadName'];
		$UnloadTel=$_REQUEST['UnloadTel'];
		$UnloadPaperID=$_REQUEST['UnloadPaperID'];
		$UnloadAdd=$_REQUEST['UnloadAdd'];
	//	$UnloadPapers=$_REQUEST['UnloadPapers'];
		$CargoName=$_REQUEST['CargoName'];
		$Numbers=$_REQUEST['Numbers'];
		$Weight=$_REQUEST['Weight'];
		$CargoDescription=$_REQUEST['CargoDescription'];
		$Remark=$_REQUEST['Remark'];
		$Isvalueinsure=$_REQUEST['Isvalueinsured'];
		$InsureMoney=$_REQUEST['InsureMoney'];
		$InsureFee=$_REQUEST['InsureFee'];
		$PayStyle=$_REQUEST['PayStyle'];
		$Allmoney=$_REQUEST['Allmoney'];
		$StationID=$userStationID;
		$Station=$userStationName;
		$DeliveryUserID=$userID;
		$DeliveryUser=$userName;
		$AcceptDateTime=date("Y-m-d H:i:s");
		$Status = "已收货";
		$tpID=$_REQUEST['tpID'];
		$BalanceDateTime="";
		$IsBalance='0';
		
		if($PayStyle=='其他'){
			$IsBalance='1';
			$BalanceDateTime=$AcceptDateTime;
		}
		
		$str = "select sset_SiteID from tms_bd_SiteSet where sset_SiteName = '{$Destination}'";	
		$result = $class_mysql_default->my_query("$str");
		$row = mysql_fetch_array($result);
		$DestinationID = $row['sset_SiteID'];
		$IsStationBalance = "0";
		
		
		$class_mysql_default->my_query("START TRANSACTION");
		
		$queryString1 = "INSERT INTO tms_lug_LuggageCons (lc_Destination, lc_BusID, lc_BusNumber, lc_NoOfRunsID, lc_CargoName,lc_Numbers,lc_Weight, lc_CargoDescription, 
				lc_ConsignName, lc_ConsignTel, lc_ConsignPaperID, lc_ConsignAdd, lc_ConsignMoney, lc_PackingMoney, lc_LabelMoney, lc_HandlingMoney, lc_UnloadName, 
				lc_UnloadTel, lc_UnloadPaperID, lc_UnloadAdd, lc_Remark, lc_DeliveryDate, lc_DeliveryUserID, lc_DeliveryUser, lc_StationID, lc_Station, lc_Status, 
				lc_AcceptDateTime, lc_TicketNumber, lc_Isvalueinsure, lc_InsureMoney, lc_InsureFee, lc_PayStyle, lc_Allmoney,lc_IsBalance, lc_BalanceDateTime, lc_DestinationID, lc_StationBalance) VALUES ('{$Destination}', '{$BusID}', '{$BusNumber}', 
				'{$NoOfRunsID}', '{$CargoName}','{$Numbers}', '{$Weight}','{$CargoDescription}', '{$ConsignName}', '{$ConsignTel}', '{$ConsignPaperID}', '{$ConsignAdd}', 
				'{$ConsignMoney}', '{$PackingMoney}', '{$LabelMoney}', '{$HandlingMoney}',' {$UnloadName}', '{$UnloadTel}', '{$UnloadPaperID}', '{$UnloadAdd}', '{$Remark}', 
				'{$DeliveryDate}', '{$DeliveryUserID}', '{$DeliveryUser}', '{$StationID}',	'{$Station}', '{$Status}', '{$AcceptDateTime}', '{$TicketNumber}','{$Isvalueinsure}',
				'{$InsureMoney}', '{$InsureFee}','{$PayStyle}', '{$Allmoney}', '{$IsBalance}', '{$BalanceDateTime}','{$DestinationID}','{$IsStationBalance}')";
	//	$retData = array('retVal' => 'FAIL', 'retString' => $queryString1, 'sql' => $queryString);
	//		echo json_encode($retData);
	//		exit();
			    
		$result1 = $class_mysql_default->my_query("$queryString1");
		if(!$result1) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '插入托运数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		
		$queryString2="UPDATE tms_bd_TicketProvide SET tp_CurrentTicket=tp_CurrentTicket+1, tp_InceptTicketNum=tp_InceptTicketNum-1
			WHERE tp_ID='{$tpID}'";
		$result2=$class_mysql_default->my_query($queryString2);
		if(!$result2) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新票据数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		//不更新票据
		/*$select3="SELECT tp_InceptTicketNum FROM tms_bd_TicketProvide WHERE tp_ID='{$tpID}'";
		$query3=$class_mysql_default->my_query($select3);
		if(!$query3) {
			$retData = array('retVal' => 'FAIL', 'retString' => '查询票据数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$result3=mysql_fetch_array($query3);
		if ($result3[0]==0){
			$update4="UPDATE tms_bd_TicketProvide SET tp_UseState='用完' WHERE tp_ID='{$tpID}'";
			$query4=$class_mysql_default->my_query($update4);
			if(!$query4) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '更新票据数据失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
		}*/
		
		$printData = array('TicketNumber' => $TicketNumber, 'Station' => $Station, 'Destination' => $Destination, 'DeliveryDate' => $DeliveryDate,
				'ConsignName' => $ConsignName, 'ConsignTel' => $ConsignTel, 'ConsignPaperID' => $ConsignPaperID, 'UnloadName' => $UnloadName, 
				'UnloadTel' => $UnloadTel, 'UnloadPaperID' => $UnloadPaperID, 'Numbers' => $Numbers, 'Weight' => $Weight, 'PayStyle' => $PayStyle,
				'Isvalueinsure' => $Isvalueinsure, 'InsureMoney' => $InsureMoney, 'InsureFee' => $InsureFee, 'ConsignMoney' => $ConsignMoney, 
				'PackingMoney' => $PackingMoney, 'LabelMoney' => $LabelMoney, 'HandlingMoney' =>$HandlingMoney, 'DeliveryUserID' => $DeliveryUserID, 
				'BusID' => $BusID, 'CargoName' => $CargoName, 'Allmoney' => $Allmoney);
		echo json_encode($printData);
		
	 	$class_mysql_default->my_query("COMMIT");
		$class_mysql_default->my_query("END TRANSACTION");
		break;
	case "modbus":
		$TicketNumber=$_REQUEST['TicketNumber'];
		$NoOfRunsID=$_REQUEST['NoOfRunsID'];
		$BusID=$_REQUEST['BusID'];
		$BusNumber=$_REQUEST['BusNumber'];
		$CurDate=date('Y-m-d');
		$updatelug="UPDATE tms_lug_LuggageCons SET lc_NoOfRunsID='{$NoOfRunsID}', lc_BusID='{$BusID}', lc_BusNumber='{$BusNumber}',lc_DeliveryDate='{$CurDate}' 
			WHERE lc_TicketNumber='{$TicketNumber}'";
		$querylug=$class_mysql_default->my_query($updatelug);
		if(!$querylug) {
			$retData = array('retVal' => 'FAIL', 'retString' => '更改车辆失败！', 'sql' => $querylug);
			echo json_encode($retData);
			exit();
		}else{
			$retData = array('retVal' => 'SUCCESS', 'retString' => '更改车辆成功！', 'sql' => $querylug);
			echo json_encode($retData);
		}
		break; 
		
	default:
}
?>