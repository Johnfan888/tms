<?php
/*
 * 售票操作页面
 */
//客票状态：8-不同票号重打,9-并班
//保险票状态：8-不同票号重打
//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$Seller = $userName;
$SellerID = $userID;
$SellerStation = $userStationName;
$SellerStationID = $userStationID;

$op = $_REQUEST['op'];
switch ($op)
{
	case "confirmprint":
		$WebSellID = $_REQUEST['WebSellID'];
		$curTicketID = $_REQUEST['TicketID'];
		$TicketID = $_REQUEST['TicketID'];
		$NoOfRunsID = $_REQUEST['NoOfRunsID'];
		$NoOfRunsdate = $_REQUEST['NoOfRunsdate'];
		$FromStation = $_REQUEST['FromStation'];
		$ReachStation = $_REQUEST['ReachStation'];
		$FullTicketNum = $_REQUEST['FullTicketNum'];
		$HalfTicketNum = $_REQUEST['HalfTicketNum'];
		$FreeSeats = 0;
		$seatnos = $_REQUEST['seatnos'];
		$curDate = date('Y-m-d');
		$curTime = date('H:i:s');
		$curDateTime = date('Y-m-d H:i:s');
		
		$queryString = "SELECT tml_BusModelID,tml_BusModel,tml_BeginstationID,tml_Beginstation,tml_EndstationID,
			tml_Endstation,tml_LineID FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$NoOfRunsID')	AND (tml_NoOfRunsdate = '$NoOfRunsdate')";
		$result = $class_mysql_default->my_query("$queryString"); 
		if(!$result) {
			$retData = array('retVal' => 'FAIL', 'retString' => '查询票版数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$rows = mysqli_fetch_array($result);
		$BusModelID = $rows[0];
		$BusModel = $rows[1];
		$BeginstationID = $rows[2];
		$Beginstation = $rows[3];
		$EndstationID = $rows[4];
		$Endstation = $rows[5];
		$LineID = $rows[6];
		
		$queryString = "SELECT pd_BeginStationTime,pd_StopStationTime,pd_Distance,pd_FromStationID,pd_ReachStationID,pd_FullPrice,
			pd_StandardPrice,pd_BalancePrice,pd_ServiceFee,pd_otherFee1,pd_otherFee2,pd_otherFee3,pd_otherFee4,pd_otherFee5,pd_otherFee6 
			FROM tms_bd_PriceDetail WHERE (pd_FromStation = '$FromStation') AND (pd_ReachStation = '$ReachStation') AND 
			(pd_NoOfRunsID = '$NoOfRunsID')	AND (pd_NoOfRunsdate = '$NoOfRunsdate')";
		$result = $class_mysql_default->my_query("$queryString"); 
		if(!$result) {
			$retData = array('retVal' => 'FAIL', 'retString' => '查询票价数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$rows = mysqli_fetch_array($result);
		$BeginStationTime = $rows[0];
		$StopStationTime = $rows[1];
		$Distance = $rows[2];
		$FromStationID = $rows[3];
		$ReachStationID = $rows[4];
		$FullPrice = $rows[5];
		$HalfPrice = $FullPrice/2;
		$StandardPrice = $rows[6];
		$BalancePrice = $rows[7];
		$ServiceFee = $rows[8];
		$otherFee1 = $rows[9];
		$otherFee2 = $rows[10];
		$otherFee3 = $rows[11];
		$otherFee4 = $rows[12];
		$otherFee5 = $rows[13];
		$otherFee6 = $rows[14];
		
		$class_mysql_default->my_query("BEGIN");

		//锁定票版数据
		//$queryString1 = "LOCK TABLES tms_bd_TicketMode WRITE";
	  	//$queryString1 = "SELECT tml_SeatStatus, tml_LeaveSeats FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$noofrunsID') AND (tml_NoOfRunsdate = '$norunsdate') LOCK IN SHARE MODE";
	  	$queryString = "SELECT tml_SeatStatus, tml_LeaveSeats, tml_CheckTicketWindow, tml_Allticket FROM tms_bd_TicketMode 
	  				WHERE (tml_NoOfRunsID = '$NoOfRunsID') AND (tml_NoOfRunsdate = '$NoOfRunsdate') FOR UPDATE";
	  	$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '锁定票版数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		
	  	//插入售票表
		$rows = mysqli_fetch_array($result);
		$checkTicketWindow = $rows['tml_CheckTicketWindow'];
		$isAllTicket = $rows['tml_Allticket'];
		$seatStatus = $rows['tml_SeatStatus'];
	  	$seatArray = explode(",", trim($seatnos));
	  	for($i = 0; $i < $FullTicketNum; $i++) {
			$SellPrice = $FullPrice;
			$SellPriceType = "全票";
			$SeatID = $seatArray[$i] - 1;
			$queryString = "INSERT INTO `tms_sell_SellTicket` (`st_TicketID`, `st_NoOfRunsID`, `st_LineID`, `st_NoOfRunsdate`, 
				`st_BeginStationTime`, `st_StopStationTime`, `st_Distance`, `st_BeginStationID`, `st_BeginStation`, `st_FromStationID`, 
				`st_FromStation`, `st_ReachStationID`, `st_ReachStation`, `st_EndStationID`, `st_EndStation`, `st_SellPrice`, `st_SellPriceType`, 
				`st_ColleSellPriceType`, `st_TotalMan`, `st_FullPrice`, `st_HalfPrice`, `st_StandardPrice`, `st_BalancePrice`, `st_ServiceFee`, 
				`st_otherFee1`, `st_otherFee2`, `st_otherFee3`, `st_otherFee4`, `st_otherFee5`, `st_otherFee6`, `st_StationID`, `st_Station`, 
				`st_SellDate`, `st_SellTime`, `st_BusModelID`, `st_BusModel`, `st_SeatID`, `st_SellID`, `st_SellName`, `st_FreeSeats`, 
				`st_SafetyTicketID`, `st_SafetyTicketNumber`, `st_SafetyTicketMoney`, `st_SafetyTicketPassengerID`, `st_TicketState`, `st_IsBalance`, 
				`st_BalanceDateTime`, `st_AlterTicket`,`st_StationBalance`) VALUES ('$TicketID', '$NoOfRunsID', '$LineID', '$NoOfRunsdate', '$BeginStationTime', 
		  		'$StopStationTime', '$Distance', '$BeginstationID', '$Beginstation', '$FromStationID', '$FromStation', '$ReachStationID', 
		  		'$ReachStation', '$EndstationID', '$Endstation', '$SellPrice', '$SellPriceType', NULL, '1', '$FullPrice', '$HalfPrice', 
		  		'$StandardPrice', '$BalancePrice', '$ServiceFee', '$otherFee1', '$otherFee2', '$otherFee3', '$otherFee4', '$otherFee5', 
		  		'$otherFee6', '$SellerStationID', '$SellerStation', '$curDate', '$curTime', '$BusModelID', '$BusModel', '$SeatID'+1,
		  		'$SellerID', '$Seller', '$FreeSeats', NULL, '0', '0', NULL, '5', '0', NULL, '0','0')";
	  		$result = $class_mysql_default->my_query("$queryString");
			if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '插入售票表失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
			$seatStatus = substr_replace($seatStatus, '3', $SeatID, 1);
			$printData[] = array('TicketID' => $TicketID, 'FromStation' => $FromStation, 'ReachStation' => $ReachStation, 
				'SellPrice' => $SellPrice, 'SeatID' => ($SeatID + 1), 'NoOfRunsID' => $NoOfRunsID, 'BeginStationTime' => $BeginStationTime, 
				'NoOfRunsdate' => $NoOfRunsdate, 'SellerID' => $SellerID, 'isAllTicket' => $isAllTicket, 'CheckTicketWindow' => $checkTicketWindow);
			$TicketID = $TicketID + 1;
	  	}
	  	for($i = $FullTicketNum; $i < $FullTicketNum + $HalfTicketNum; $i++) {
	  		$SellPrice = $FullPrice/2;
			$SellPriceType = "半票";
			$SeatID = $seatArray[$i];
			$queryString = "INSERT INTO `tms_sell_SellTicket` (`st_TicketID`, `st_NoOfRunsID`, `st_LineID`, `st_NoOfRunsdate`, 
				`st_BeginStationTime`, `st_StopStationTime`, `st_Distance`, `st_BeginStationID`, `st_BeginStation`, `st_FromStationID`, 
				`st_FromStation`, `st_ReachStationID`, `st_ReachStation`, `st_EndStationID`, `st_EndStation`, `st_SellPrice`, `st_SellPriceType`, 
				`st_ColleSellPriceType`, `st_TotalMan`, `st_FullPrice`, `st_HalfPrice`, `st_StandardPrice`, `st_BalancePrice`, `st_ServiceFee`, 
				`st_otherFee1`, `st_otherFee2`, `st_otherFee3`, `st_otherFee4`, `st_otherFee5`, `st_otherFee6`, `st_StationID`, `st_Station`, 
				`st_SellDate`, `st_SellTime`, `st_BusModelID`, `st_BusModel`, `st_SeatID`, `st_SellID`, `st_SellName`, `st_FreeSeats`, 
				`st_SafetyTicketID`, `st_SafetyTicketNumber`, `st_SafetyTicketMoney`, `st_SafetyTicketPassengerID`, `st_TicketState`, `st_IsBalance`, 
				`st_BalanceDateTime`, `st_AlterTicket`,`st_StationBalance`) VALUES ('$TicketID', '$NoOfRunsID', '$LineID', '$NoOfRunsdate', '$BeginStationTime', 
		  		'$StopStationTime', '$Distance', '$BeginstationID', '$Beginstation', '$FromStationID', '$FromStation', '$ReachStationID', 
		  		'$ReachStation', '$EndstationID', '$Endstation', '$SellPrice', '$SellPriceType', NULL, '1', '$FullPrice', '$HalfPrice', 
		  		'$StandardPrice', '$BalancePrice', '$ServiceFee', '$otherFee1', '$otherFee2', '$otherFee3', '$otherFee4', '$otherFee5', 
		  		'$otherFee6', '$SellerStationID', '$SellerStation', '$curDate', '$curTime', '$BusModelID', '$BusModel', '$SeatID'+1, 
		  		'$SellerID', '$Seller', '$FreeSeats', NULL, '0', '0', NULL, '5', '0', NULL, '0','0')";
			$result = $class_mysql_default->my_query("$queryString");
			if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '插入售票表失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
			$seatStatus = substr_replace($seatStatus, '3', $SeatID, 1);
			$printData[] = array('TicketID' => $TicketID, 'FromStation' => $FromStation, 'ReachStation' => $ReachStation, 
				'SellPrice' => $SellPrice, 'SeatID' => ($SeatID + 1), 'NoOfRunsID' => $NoOfRunsID, 'BeginStationTime' => $BeginStationTime, 
				'NoOfRunsdate' => $NoOfRunsdate, 'SellerID' => $SellerID, 'isAllTicket' => $isAllTicket, 'CheckTicketWindow' => $checkTicketWindow);
			$TicketID = $TicketID + 1;
	  	}
		
	  	//更新票版数据(这里不需要）
	  	/* $queryString = "UPDATE tms_bd_TicketMode SET tml_SeatStatus = '$seatStatus' WHERE (tml_NoOfRunsID = '$NoOfRunsID') 
	  			AND (tml_NoOfRunsdate = '$NoOfRunsdate')";	  	
	  	$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新票版数据表失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		} */		
			  	
	  	//更新客票票据表
	  	$queryString = "Update tms_bd_TicketProvide SET tp_CurrentTicket = '{$TicketID}', 
	  				tp_InceptTicketNum = tp_InceptTicketNum - ('$FullTicketNum' + '$HalfTicketNum') WHERE tp_InceptUserID = '{$userID}' 
	  				AND tp_Type = '客票' AND tp_InceptTicketNum > 0 AND tp_CurrentTicket = '{$curTicketID}'";
	  	$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新客票票据表失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}

		//窗口打票：更新网上和电话订票表
		if(substr($WebSellID,0,1) == 'D') $wst_TicketState = '5'; //网上支付已打票(2->5)
		$queryString = "UPDATE tms_websell_WebSellTicket SET wst_TicketState = '$wst_TicketState' WHERE wst_WebSellID = '{$WebSellID}'";
		$result = $class_mysql_default->my_query($queryString);
		if(!$result) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新订票表失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}		

		$class_mysql_default->my_query("COMMIT");
		echo json_encode($printData);
		exit();
	case "confirmsell":
		$subop = $_REQUEST['subop'];
		$WebSellID = $_REQUEST['WebSellID'];
		$TicketID = $_REQUEST['newTicketID'];
		$curTicketID = $_REQUEST['curTicketID'];
		$NoOfRunsID = $_REQUEST['NoOfRunsID'];
		$NoOfRunsdate = $_REQUEST['NoOfRunsdate'];
		$FromStation = $_REQUEST['FromStation'];
		$ReachStation = $_REQUEST['ReachStation'];
		$FullTicketNum = $_REQUEST['FullTicketNum'];
		$HalfTicketNum = $_REQUEST['HalfTicketNum'];
		$FreeSeats = 0;
		$seatnos = $_REQUEST['seatnos'];
		$safetyTicketID = $_REQUEST['SafetyTicketID'];
		$SafetyTicketMoney = $_REQUEST['SafetyMoney'];
		$safetyTicketID = $_REQUEST['newSafetyTicketID'];
		$curSafetyTicketID = $_REQUEST['curSafetyTicketID'];
		$SafetyUserID = $_REQUEST['SafetyID'];
		$safeUser = $_REQUEST['safeUser'];
		$safeUserAddress = $_REQUEST['safeUserAddress'];
		$curDate = date('Y-m-d');
		$curTime = date('H:i:s');
		$curDateTime = date('Y-m-d H:i:s');
		
		$queryString = "SELECT tml_BusModelID,tml_BusModel,tml_BeginstationID,tml_Beginstation,tml_EndstationID,
			tml_Endstation,tml_LineID FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$NoOfRunsID')	AND (tml_NoOfRunsdate = '$NoOfRunsdate')";
		$result = $class_mysql_default->my_query("$queryString"); 
		if(!$result) {
			$retData = array('retVal' => 'FAIL', 'retString' => '查询票版数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$rows = mysqli_fetch_array($result);
		$BusModelID = $rows[0];
		$BusModel = $rows[1];
		$BeginstationID = $rows[2];
		$Beginstation = $rows[3];
		$EndstationID = $rows[4];
		$Endstation = $rows[5];
		$LineID = $rows[6];
		
		if($SafetyTicketMoney != 0){
			$querySafety="SELECT it_InsureProductName,it_RiskCode,it_MakeCode,it_RationType,it_AgentCode,it_VisaCode,it_Perfix,
				it_AInsuranceValue,it_BInsuranceValue,it_ComCode,it_HandlerCode,it_Handler1Code,it_OperatorCode,it_ApporverCode FROM 
				tms_bd_InsureType WHERE it_Price='{$SafetyTicketMoney}'";
			$resultSafety= $class_mysql_default->my_query("$querySafety");
			if(!$resultSafety) {
				$retData = array('retVal' => 'FAIL', 'retString' => '查询保险类型数据失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
			$rowsSafety = mysqli_fetch_array($resultSafety);
		}
								
		$queryString = "SELECT pd_BeginStationTime,pd_StopStationTime,pd_Distance,pd_FromStationID,pd_ReachStationID,pd_FullPrice,
			pd_StandardPrice,pd_BalancePrice,pd_ServiceFee,pd_otherFee1,pd_otherFee2,pd_otherFee3,pd_otherFee4,pd_otherFee5,pd_otherFee6 
			FROM tms_bd_PriceDetail WHERE (pd_FromStation = '$FromStation') AND (pd_ReachStation = '$ReachStation') AND 
			(pd_NoOfRunsID = '$NoOfRunsID')	AND (pd_NoOfRunsdate = '$NoOfRunsdate')";
		$result = $class_mysql_default->my_query("$queryString"); 
		if(!$result) {
			$retData = array('retVal' => 'FAIL', 'retString' => '查询票价数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$rows = mysqli_fetch_array($result);
		$BeginStationTime = $rows[0];
		$StopStationTime = $rows[1];
		$Distance = $rows[2];
		$FromStationID = $rows[3];
		$ReachStationID = $rows[4];
		$FullPrice = $rows[5];
		$HalfPrice = $FullPrice/2;
		$StandardPrice = $rows[6];
		$BalancePrice = $rows[7];
		$ServiceFee = $rows[8];
		$otherFee1 = $rows[9];
		$otherFee2 = $rows[10];
		$otherFee3 = $rows[11];
		$otherFee4 = $rows[12];
		$otherFee5 = $rows[13];
		$otherFee6 = $rows[14];
		
		$class_mysql_default->my_query("BEGIN");

		//锁定票版数据
		//$queryString1 = "LOCK TABLES tms_bd_TicketMode WRITE";
	  	//$queryString1 = "SELECT tml_SeatStatus, tml_LeaveSeats FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$noofrunsID') AND (tml_NoOfRunsdate = '$norunsdate') LOCK IN SHARE MODE";
	  	$queryString = "SELECT tml_SeatStatus, tml_LeaveSeats, tml_CheckTicketWindow, tml_Allticket FROM tms_bd_TicketMode 
	  				WHERE (tml_NoOfRunsID = '$NoOfRunsID') AND (tml_NoOfRunsdate = '$NoOfRunsdate') FOR UPDATE";
	  	$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '锁定票版数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		
	  	//插入售票表
		$rows = mysqli_fetch_array($result);
		$checkTicketWindow = $rows['tml_CheckTicketWindow'];
		$isAllTicket = $rows['tml_Allticket'];
		$seatStatus = $rows['tml_SeatStatus'];
	  	$seatArray = explode(",", trim($seatnos));
	  	$SafetyUserIDArray = explode(";", trim($SafetyUserID,";"));
		$safeUserArray = explode(";", trim($safeUser,";"));
		$safeUserAddressArray = explode(";", trim($safeUserAddress,";"));
	  	for($i = 0; $i < $FullTicketNum; $i++) {
			$SellPrice = $FullPrice;
			$SellPriceType = "全票";
			$SeatID = $seatArray[$i];
			$SafetyUserID = $SafetyUserIDArray[$i];
			$safeUser = $safeUserArray[$i];
			$safeUserAddress = $safeUserAddressArray[$i];
			if($SafetyTicketMoney != 0)
				$queryString = "INSERT INTO `tms_sell_SellTicket` (`st_TicketID`, `st_NoOfRunsID`, `st_LineID`, `st_NoOfRunsdate`, 
					`st_BeginStationTime`, `st_StopStationTime`, `st_Distance`, `st_BeginStationID`, `st_BeginStation`, `st_FromStationID`, 
					`st_FromStation`, `st_ReachStationID`, `st_ReachStation`, `st_EndStationID`, `st_EndStation`, `st_SellPrice`, `st_SellPriceType`, 
					`st_ColleSellPriceType`, `st_TotalMan`, `st_FullPrice`, `st_HalfPrice`, `st_StandardPrice`, `st_BalancePrice`, `st_ServiceFee`, 
					`st_otherFee1`, `st_otherFee2`, `st_otherFee3`, `st_otherFee4`, `st_otherFee5`, `st_otherFee6`, `st_StationID`, `st_Station`, 
					`st_SellDate`, `st_SellTime`, `st_BusModelID`, `st_BusModel`, `st_SeatID`, `st_SellID`, `st_SellName`, `st_FreeSeats`, 
					`st_SafetyTicketID`, `st_SafetyTicketNumber`, `st_SafetyTicketMoney`, `st_SafetyTicketPassengerID`, `st_TicketState`, `st_IsBalance`, 
					`st_BalanceDateTime`, `st_AlterTicket`,`st_StationBalance`) VALUES ('$TicketID', '$NoOfRunsID', '$LineID', '$NoOfRunsdate', '$BeginStationTime', 
			  		'$StopStationTime', '$Distance', '$BeginstationID', '$Beginstation', '$FromStationID', '$FromStation', '$ReachStationID', 
			  		'$ReachStation', '$EndstationID', '$Endstation', '$SellPrice', '$SellPriceType', NULL, '1', '$FullPrice', '$HalfPrice', 
			  		'$StandardPrice', '$BalancePrice', '$ServiceFee', '$otherFee1', '$otherFee2', '$otherFee3', '$otherFee4', '$otherFee5', 
			  		'$otherFee6', '$SellerStationID', '$SellerStation', '$curDate', '$curTime', '$BusModelID', '$BusModel', '$SeatID'+1,
			  		'$SellerID', '$Seller', '$FreeSeats', '$safetyTicketID', '1', '$SafetyTicketMoney', '$SafetyUserID', '0', '0', NULL, '0','0')";
			else 
				$queryString = "INSERT INTO `tms_sell_SellTicket` (`st_TicketID`, `st_NoOfRunsID`, `st_LineID`, `st_NoOfRunsdate`, 
					`st_BeginStationTime`, `st_StopStationTime`, `st_Distance`, `st_BeginStationID`, `st_BeginStation`, `st_FromStationID`, 
					`st_FromStation`, `st_ReachStationID`, `st_ReachStation`, `st_EndStationID`, `st_EndStation`, `st_SellPrice`, `st_SellPriceType`, 
					`st_ColleSellPriceType`, `st_TotalMan`, `st_FullPrice`, `st_HalfPrice`, `st_StandardPrice`, `st_BalancePrice`, `st_ServiceFee`, 
					`st_otherFee1`, `st_otherFee2`, `st_otherFee3`, `st_otherFee4`, `st_otherFee5`, `st_otherFee6`, `st_StationID`, `st_Station`, 
					`st_SellDate`, `st_SellTime`, `st_BusModelID`, `st_BusModel`, `st_SeatID`, `st_SellID`, `st_SellName`, `st_FreeSeats`, 
					`st_SafetyTicketID`, `st_SafetyTicketNumber`, `st_SafetyTicketMoney`, `st_SafetyTicketPassengerID`, `st_TicketState`, `st_IsBalance`, 
					`st_BalanceDateTime`, `st_AlterTicket`,`st_StationBalance`) VALUES ('$TicketID', '$NoOfRunsID', '$LineID', '$NoOfRunsdate', '$BeginStationTime', 
			  		'$StopStationTime', '$Distance', '$BeginstationID', '$Beginstation', '$FromStationID', '$FromStation', '$ReachStationID', 
			  		'$ReachStation', '$EndstationID', '$Endstation', '$SellPrice', '$SellPriceType', NULL, '1', '$FullPrice', '$HalfPrice', 
			  		'$StandardPrice', '$BalancePrice', '$ServiceFee', '$otherFee1', '$otherFee2', '$otherFee3', '$otherFee4', '$otherFee5', 
			  		'$otherFee6', '$SellerStationID', '$SellerStation', '$curDate', '$curTime', '$BusModelID', '$BusModel', '$SeatID'+1,
			  		'$SellerID', '$Seller', '$FreeSeats', NULL, '0', '$SafetyTicketMoney', NULL, '0', '0', NULL, '0','0')";
			
	  		$result = $class_mysql_default->my_query("$queryString");
			if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '插入售票表失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
			$seatStatus = substr_replace($seatStatus, '3', $SeatID, 1);
			
			//插入保险表
			if($SafetyTicketMoney!=0){
				$SyncCode=$rowsSafety['it_ComCode'].$rowsSafety['it_Perfix'].$safetyTicketID;
				$queryInsertSafety="INSERT INTO tms_sell_InsureTicket (itt_SyncCode, itt_InsureTicketNo, itt_TicketNo, itt_CreatedType, itt_Status, itt_IdCard,
					itt_Name, itt_Beneficiary, itt_TbInsureProductID, itt_InsureProductName, itt_Price, itt_AinsuranceValue, itt_BinsuranceValue, itt_CinsuranceValue,
					itt_DinsuranceValue, itt_IsUpMoney, itt_UpMoneyID, itt_Saler, itt_PtrReserveID, itt_SaleComputer, itt_SaleTime, itt_RiskCode, itt_PationType,
					itt_AgentCode, itt_VisaCode, itt_PolicyNo, itt_UploadStatus,itt_UploadDate, itt_ReturnUploadStatus, itt_ReturnUploadDate, itt_IDCardType, itt_MakeCode,
					itt_ComCode, itt_HandlerCode, itt_Handler1Code, itt_OperatorCode, itt_ApporverCode, itt_TotalSum, itt_ReserveName, itt_ADOrgCode, itt_ADOrgName,itt_ADOrgValue,
					itt_SeatNo, itt_RideDate,itt_ScheduleID, itt_ScheduleValue, itt_FormName, itt_FormValue, itt_ReachName, itt_ReachValue, itt_IsActive, itt_AdClientID, itt_AdOrgID, itt_Created,
					itt_CreatedBY, itt_UpdateBY, itt_Update, itt_SalerName, itt_IdAdderss, itt_SaverResult, itt_SendCount, itt_NextSendTime, itt_ReturnSendCount, itt_ReturnNextSendTime,
					itt_ReturnSaveResult, itt_RowID) VALUES ('{$SyncCode}', '{$safetyTicketID}', '{$TicketID}', '0', '0', '{$SafetyUserID}', '{$safeUser}', NULL, NULL, '{$rowsSafety[0]}', 
					'{$SafetyTicketMoney}', '{$rowsSafety[7]}', '{$rowsSafety[8]}', '0', '0', 'N', '0', '{$SellerID}', NULL, NULL, '{$curDateTime}', '{$rowsSafety[1]}', '{$rowsSafety[3]}',
					'{$rowsSafety[4]}', '{$rowsSafety[5]}', NULL, '1', NULL, '0', NULL, NULL, '{$rowsSafety[2]}', '{$rowsSafety[9]}', '{$rowsSafety[10]}', '{$rowsSafety[11]}',
					'{$rowsSafety[12]}', '{$rowsSafety[13]}','{$rowsSafety[7]}','{$SellerStation}', NULL, '{$Beginstation}', '{$BeginstationID}','{$SeatID}'+1, '{$curDateTime}', NULL, NULL,
					'{$FromStation}', '{$FromStationID}', '{$ReachStation}', '{$ReachStationID}', 'Y', '0', '0', '{$curDateTime}', '{$SellerID}', '{$SellerID}', '{$curDateTime}', '{$Seller}','{$safeUserAddress}',
					NULL, '0', NULL, '0', NULL, NULL, NULL)";
				$resultInsertSafety = $class_mysql_default->my_query("$queryInsertSafety");
		  		if(!$resultInsertSafety) {
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '插入保险票表失败！', 'sql' => $queryString);
					echo json_encode($retData);
					exit();
				}
				$printData[] = array('TicketID' => $TicketID, 'FromStation' => $FromStation, 'ReachStation' => $ReachStation, 
					'SellPrice' => $SellPrice, 'SeatID' => ($SeatID + 1), 'NoOfRunsID' => $NoOfRunsID, 'BeginStationTime' => $BeginStationTime, 
					'NoOfRunsdate' => $NoOfRunsdate, 'safetyTicketID' => $safetyTicketID, 'SafetyTicketMoney' => $SafetyTicketMoney, 
					'CheckTicketWindow' => $checkTicketWindow, 'SellerID' => $SellerID, 'isAllTicket' => $isAllTicket, 'SafetyTicketMoney' => $SafetyTicketMoney, 
					'VisaCode' => $rowsSafety[5], 'InsureTicketNo' => $safetyTicketID, 'Name' => $safeUser, 'IdCard' => $SafetyUserID, 'Beneficiary' => $Beneficiary,
					'AInsuranceValue' => $rowsSafety[7], 'BInsuranceValue' => $rowsSafety[8], 'SaleTime'=> $curDateTime, 'AgentCode' => $rowsSafety[4], 
					'HandlerCode' => $rowsSafety[10], 'SyncCode'=>$SyncCode);
				
				$safetyTicketID = $safetyTicketID + 1;
			}else{
				$printData[] = array('TicketID' => $TicketID, 'FromStation' => $FromStation, 'ReachStation' => $ReachStation, 
					'SellPrice' => $SellPrice, 'SeatID' => ($SeatID + 1), 'NoOfRunsID' => $NoOfRunsID, 'BeginStationTime' => $BeginStationTime, 
					'NoOfRunsdate' => $NoOfRunsdate, 'safetyTicketID' => $safetyTicketID, 'SafetyTicketMoney' => $SafetyTicketMoney, 
					'CheckTicketWindow' => $checkTicketWindow, 'SellerID' => $SellerID, 'isAllTicket' => $isAllTicket, 'SafetyTicketMoney' => $SafetyTicketMoney);
			}
			$TicketID = $TicketID + 1;
	  	}
	  	for($i = $FullTicketNum; $i < $FullTicketNum + $HalfTicketNum; $i++) {
	  		$SellPrice = $FullPrice/2;
			$SellPriceType = "半票";
			$SeatID = $seatArray[$i];
			$SafetyUserID = $SafetyUserIDArray[$i];
			$safeUser = $safeUserArray[$i];
			$safeUserAddress = $safeUserAddressArray[$i];
			if($SafetyTicketMoney != 0)
				$queryString = "INSERT INTO `tms_sell_SellTicket` (`st_TicketID`, `st_NoOfRunsID`, `st_LineID`, `st_NoOfRunsdate`, 
					`st_BeginStationTime`, `st_StopStationTime`, `st_Distance`, `st_BeginStationID`, `st_BeginStation`, `st_FromStationID`, 
					`st_FromStation`, `st_ReachStationID`, `st_ReachStation`, `st_EndStationID`, `st_EndStation`, `st_SellPrice`, `st_SellPriceType`, 
					`st_ColleSellPriceType`, `st_TotalMan`, `st_FullPrice`, `st_HalfPrice`, `st_StandardPrice`, `st_BalancePrice`, `st_ServiceFee`, 
					`st_otherFee1`, `st_otherFee2`, `st_otherFee3`, `st_otherFee4`, `st_otherFee5`, `st_otherFee6`, `st_StationID`, `st_Station`, 
					`st_SellDate`, `st_SellTime`, `st_BusModelID`, `st_BusModel`, `st_SeatID`, `st_SellID`, `st_SellName`, `st_FreeSeats`, 
					`st_SafetyTicketID`, `st_SafetyTicketNumber`, `st_SafetyTicketMoney`, `st_SafetyTicketPassengerID`, `st_TicketState`, `st_IsBalance`, 
					`st_BalanceDateTime`, `st_AlterTicket`,`st_StationBalance`) VALUES ('$TicketID', '$NoOfRunsID', '$LineID', '$NoOfRunsdate', '$BeginStationTime', 
			  		'$StopStationTime', '$Distance', '$BeginstationID', '$Beginstation', '$FromStationID', '$FromStation', '$ReachStationID', 
			  		'$ReachStation', '$EndstationID', '$Endstation', '$SellPrice', '$SellPriceType', NULL, '1', '$FullPrice', '$HalfPrice', 
			  		'$StandardPrice', '$BalancePrice', '$ServiceFee', '$otherFee1', '$otherFee2', '$otherFee3', '$otherFee4', '$otherFee5', 
			  		'$otherFee6', '$SellerStationID', '$SellerStation', '$curDate', '$curTime', '$BusModelID', '$BusModel', '$SeatID'+1, 
			  		'$SellerID', '$Seller', '$FreeSeats', '$safetyTicketID', '1', '$SafetyTicketMoney', '$SafetyUserID', '0', '0', NULL, '0','0')";
			else 
				$queryString = "INSERT INTO `tms_sell_SellTicket` (`st_TicketID`, `st_NoOfRunsID`, `st_LineID`, `st_NoOfRunsdate`, 
					`st_BeginStationTime`, `st_StopStationTime`, `st_Distance`, `st_BeginStationID`, `st_BeginStation`, `st_FromStationID`, 
					`st_FromStation`, `st_ReachStationID`, `st_ReachStation`, `st_EndStationID`, `st_EndStation`, `st_SellPrice`, `st_SellPriceType`, 
					`st_ColleSellPriceType`, `st_TotalMan`, `st_FullPrice`, `st_HalfPrice`, `st_StandardPrice`, `st_BalancePrice`, `st_ServiceFee`, 
					`st_otherFee1`, `st_otherFee2`, `st_otherFee3`, `st_otherFee4`, `st_otherFee5`, `st_otherFee6`, `st_StationID`, `st_Station`, 
					`st_SellDate`, `st_SellTime`, `st_BusModelID`, `st_BusModel`, `st_SeatID`, `st_SellID`, `st_SellName`, `st_FreeSeats`, 
					`st_SafetyTicketID`, `st_SafetyTicketNumber`, `st_SafetyTicketMoney`, `st_SafetyTicketPassengerID`, `st_TicketState`, `st_IsBalance`, 
					`st_BalanceDateTime`, `st_AlterTicket`,`st_StationBalance`) VALUES ('$TicketID', '$NoOfRunsID', '$LineID', '$NoOfRunsdate', '$BeginStationTime', 
			  		'$StopStationTime', '$Distance', '$BeginstationID', '$Beginstation', '$FromStationID', '$FromStation', '$ReachStationID', 
			  		'$ReachStation', '$EndstationID', '$Endstation', '$SellPrice', '$SellPriceType', NULL, '1', '$FullPrice', '$HalfPrice', 
			  		'$StandardPrice', '$BalancePrice', '$ServiceFee', '$otherFee1', '$otherFee2', '$otherFee3', '$otherFee4', '$otherFee5', 
			  		'$otherFee6', '$SellerStationID', '$SellerStation', '$curDate', '$curTime', '$BusModelID', '$BusModel', '$SeatID'+1, 
			  		'$SellerID', '$Seller', '$FreeSeats', NULL, '0', '$SafetyTicketMoney', NULL, '0', '0', NULL, '0','0')";
			
			$result = $class_mysql_default->my_query("$queryString");
			if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '插入售票表失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
			$seatStatus = substr_replace($seatStatus, '3', $SeatID, 1);
		
	  		if($SafetyTicketMoney!=0){
				$SyncCode=$rowsSafety['it_ComCode'].$rowsSafety['it_Perfix'].$safetyTicketID;
	  			$queryInsertSafety="INSERT INTO tms_sell_InsureTicket (itt_SyncCode, itt_InsureTicketNo, itt_TicketNo, itt_CreatedType, itt_Status, itt_IdCard,
					itt_Name, itt_Beneficiary, itt_TbInsureProductID, itt_InsureProductName, itt_Price, itt_AinsuranceValue, itt_BinsuranceValue, itt_CinsuranceValue,
					itt_DinsuranceValue, itt_IsUpMoney, itt_UpMoneyID, itt_Saler, itt_PtrReserveID, itt_SaleComputer, itt_SaleTime, itt_RiskCode, itt_PationType,
					itt_AgentCode, itt_VisaCode, itt_PolicyNo, itt_UploadStatus,itt_UploadDate, itt_ReturnUploadStatus, itt_ReturnUploadDate, itt_IDCardType, itt_MakeCode,
					itt_ComCode, itt_HandlerCode, itt_Handler1Code, itt_OperatorCode, itt_ApporverCode, itt_TotalSum, itt_ReserveName, itt_ADOrgCode, itt_ADOrgName,itt_ADOrgValue,
					itt_SeatNo, itt_RideDate,itt_ScheduleID, itt_ScheduleValue, itt_FormName, itt_FormValue, itt_ReachName, itt_ReachValue, itt_IsActive, itt_AdClientID, itt_AdOrgID, itt_Created,
					itt_CreatedBY, itt_UpdateBY, itt_Update, itt_SalerName, itt_IdAdderss, itt_SaverResult, itt_SendCount, itt_NextSendTime, itt_ReturnSendCount, itt_ReturnNextSendTime,
					itt_ReturnSaveResult, itt_RowID) VALUES ('{$SyncCode}', '{$safetyTicketID}', '{$TicketID}', '1', '0', '{$SafetyUserID}','{$safeUser}', NULL, NULL, '{$rowsSafety[0]}', 
					'{$SafetyTicketMoney}', '{$rowsSafety[7]}', '{$rowsSafety[8]}', '0', '0', 'N', '0', '{$SellerID}', NULL, NULL, '{$curDateTime}', '{$rowsSafety[1]}', '{$rowsSafety[3]}',
					'{$rowsSafety[4]}', '{$rowsSafety[5]}', NULL, '1', NULL, '0', NULL, NULL, '{$rowsSafety[2]}', '{$rowsSafety[9]}', '{$rowsSafety[10]}', '{$rowsSafety[11]}',
					'{$rowsSafety[12]}', '{$rowsSafety[13]}','{$rowsSafety[7]}','{$SellerStation}', NULL, '{$Beginstation}', '{$BeginstationID}','{$SeatID}'+1, '{$curDateTime}', NULL, NULL,
					'{$FromStation}', '{$FromStationID}', '{$ReachStation}', '{$ReachStationID}', 'Y', '0', '0', '{$curDateTime}', '{$SellerID}', '{$SellerID}', '{$curDateTime}', '{$Seller}','{$safeUserAddress}',
					NULL, '0', NULL, '0', NULL, NULL, NULL)";
				$resultInsertSafety = $class_mysql_default->my_query("$queryInsertSafety");
		  		if(!$resultInsertSafety) {
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '插入保险票表失败！', 'sql' => $queryString);
					echo json_encode($retData);
					exit();
				}
				$printData[] = array('TicketID' => $TicketID, 'FromStation' => $FromStation, 'ReachStation' => $ReachStation, 
					'SellPrice' => $SellPrice, 'SeatID' => ($SeatID + 1), 'NoOfRunsID' => $NoOfRunsID, 'BeginStationTime' => $BeginStationTime, 
					'NoOfRunsdate' => $NoOfRunsdate, 'safetyTicketID' => $safetyTicketID, 'SafetyTicketMoney' => $SafetyTicketMoney, 
					'CheckTicketWindow' => $checkTicketWindow, 'SellerID' => $SellerID, 'isAllTicket' => $isAllTicket, 'SafetyTicketMoney' => $SafetyTicketMoney, 
					'VisaCode' => $rowsSafety[5], 'InsureTicketNo' => $safetyTicketID, 'Name' => $safeUser, 'IdCard' => $SafetyUserID, 'Beneficiary' => $Beneficiary,
					'AInsuranceValue' => $rowsSafety[7], 'BInsuranceValue' => $rowsSafety[8], 'SaleTime'=> $curDateTime, 'AgentCode' => $rowsSafety[4], 
					'HandlerCode' => $rowsSafety[10], 'SyncCode'=>'tongbu');
				$safetyTicketID = $safetyTicketID + 1;
			}else{
				$printData[] = array('TicketID' => $TicketID, 'FromStation' => $FromStation, 'ReachStation' => $ReachStation, 
					'SellPrice' => $SellPrice, 'SeatID' => ($SeatID + 1), 'NoOfRunsID' => $NoOfRunsID, 'BeginStationTime' => $BeginStationTime, 
					'NoOfRunsdate' => $NoOfRunsdate, 'safetyTicketID' => $safetyTicketID, 'SafetyTicketMoney' => $SafetyTicketMoney, 
					'CheckTicketWindow' => $checkTicketWindow, 'SellerID' => $SellerID, 'isAllTicket' => $isAllTicket, 'SafetyTicketMoney' => $SafetyTicketMoney);
			}
			$TicketID = $TicketID + 1;
	  	}
	  	
		
	  	//更新票版数据
	  	$queryString = "UPDATE tms_bd_TicketMode SET tml_SeatStatus = '$seatStatus' WHERE (tml_NoOfRunsID = '$NoOfRunsID') 
	  			AND (tml_NoOfRunsdate = '$NoOfRunsdate')";	  	
	  	$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新票版数据表失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}		
			  	
	  	//更新客票票据表
	  	$queryString = "Update tms_bd_TicketProvide SET tp_CurrentTicket = '{$TicketID}', 
	  				tp_InceptTicketNum = tp_InceptTicketNum - ('$FullTicketNum' + '$HalfTicketNum') WHERE tp_InceptUserID = '{$userID}' 
	  				AND tp_Type = '客票' AND tp_InceptTicketNum > 0 AND tp_CurrentTicket = '{$curTicketID}'";
	  	$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新客票票据表失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}

	  	//更新保险票票据表
	  	$queryString = "Update tms_bd_TicketProvide SET tp_CurrentTicket = '{$safetyTicketID}',
	  			tp_InceptTicketNum = tp_InceptTicketNum - ('$FullTicketNum' + '$HalfTicketNum')	WHERE tp_InceptUserID = '{$userID}' 
	  			AND tp_Type = '保险票' AND tp_InceptTicketNum > 0 AND tp_CurrentTicket = '{$curSafetyTicketID}'";
	  	$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新保险票票据表失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}		

		//窗口取票：更新网上和电话订票表
		if($subop == "windowtake") {
			if(substr($WebSellID,0,1) == 'D') $wst_TicketState = '1'; //网上预订支付完成 (0->1)
			if(substr($WebSellID,0,1) == 'R') $wst_TicketState = '4'; //电话预订支付完成 (3->4)					
			$queryString = "UPDATE tms_websell_WebSellTicket SET wst_TicketState = '$wst_TicketState' WHERE wst_WebSellID = '{$WebSellID}'";
			$result = $class_mysql_default->my_query($queryString);
			if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '更新订票表失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}		
		}		
		
		$class_mysql_default->my_query("COMMIT");
		
		//$retData = array('retVal' => 'SUCC', 'totalNum' => ($FullTicketNum + $HalfTicketNum));
		echo json_encode($printData);
		exit();
	case "confirmsupsafeticket";
		$st_TicketID=$_REQUEST['st_TicketID'];
		$curSafeTicketID=$_REQUEST['curSafeTicketID'];
		$safetyTicketID=$_REQUEST['curSafeTicketID'];
		$SafetyTicketMoney=$_REQUEST['SafetyTicketMoney'];
		$SafetyID=$_REQUEST['SafetyID'];
		$safeUser=$_REQUEST['safeUser'];
		$safeUserAddress=$_REQUEST['safeUserAddress'];
		$i=0;
		$SafetyUserIDArray = explode(";", trim($SafetyID,";"));
		$safeUserArray = explode(";", trim($safeUser,";"));
		$safeUserAddressArray = explode(";", trim($safeUserAddress,";"));
		$curDate = date('Y-m-d');
		$curTime = date('H:i:s');
		$curDateTime = date('Y-m-d H:i:s');
		$querySafety="SELECT it_InsureProductName,it_RiskCode,it_MakeCode,it_RationType,it_AgentCode,it_VisaCode,it_Perfix,
				it_AInsuranceValue,it_BInsuranceValue,it_ComCode,it_HandlerCode,it_Handler1Code,it_OperatorCode,it_ApporverCode,it_Price FROM 
				tms_bd_InsureType WHERE it_Price='{$SafetyTicketMoney}'";
		$resultSafety= $class_mysql_default->my_query("$querySafety");
		if(!$resultSafety) {
			$retData = array('retVal' => 'FAIL', 'retString' => '查询保险类型数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$rowsSafety = @mysqli_fetch_array($resultSafety);
		$class_mysql_default->my_query("BEGIN");
		foreach (explode("\n",$st_TicketID) as $key =>$ticketIDs){
			if($ticketIDs!=''){
				$i=$i+1;
				$SafetyUserID = $SafetyUserIDArray[$i-1];
				$safeUser = $safeUserArray[$i-1];
				$safeUserAddress = $safeUserAddressArray[$i-1];
				$ticketIDs=trim($ticketIDs);
				$selectSellTicket="SELECT st_BeginStationID,st_BeginStation,st_FromStationID,st_FromStation,st_ReachStationID,st_ReachStation,
					st_SellPrice,st_SeatID,st_NoOfRunsID,st_BeginStationTime,st_NoOfRunsdate,
					st_SellID,tml_Allticket,tml_CheckTicketWindow FROM tms_sell_SellTicket LEFT OUTER JOIN tms_bd_TicketMode ON 
					tml_NoOfRunsID=st_NoOfRunsID AND tml_NoOfRunsdate=st_NoOfRunsdate WHERE st_TicketID='{$ticketIDs}'";
				$queryselect=$class_mysql_default->my_query("$selectSellTicket");
				if(!$queryselect){
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '查询售票表失败！', 'sql' => $queryString);
					echo json_encode($retData);
					exit();
				}
				$rows = @mysqli_fetch_array($queryselect);
				$SyncCode=$rowsSafety['it_ComCode'].$rowsSafety['it_Perfix'].$safetyTicketID;
				$insertInsureTicket="INSERT tms_sell_InsureTicket (itt_SyncCode, itt_InsureTicketNo, itt_TicketNo, itt_CreatedType, itt_Status, itt_IdCard,
						itt_Name, itt_Beneficiary, itt_TbInsureProductID, itt_InsureProductName, itt_Price, itt_AinsuranceValue, itt_BinsuranceValue, itt_CinsuranceValue,
						itt_DinsuranceValue, itt_IsUpMoney, itt_UpMoneyID, itt_Saler, itt_PtrReserveID, itt_SaleComputer, itt_SaleTime, itt_RiskCode, itt_PationType,
						itt_AgentCode, itt_VisaCode, itt_PolicyNo, itt_UploadStatus,itt_UploadDate, itt_ReturnUploadStatus, itt_ReturnUploadDate, itt_IDCardType, itt_MakeCode,
						itt_ComCode, itt_HandlerCode, itt_Handler1Code, itt_OperatorCode, itt_ApporverCode, itt_TotalSum, itt_ReserveName, itt_ADOrgCode, itt_ADOrgName,itt_ADOrgValue,
						itt_SeatNo, itt_RideDate,itt_ScheduleID, itt_ScheduleValue, itt_FormName, itt_FormValue, itt_ReachName, itt_ReachValue, itt_IsActive, itt_AdClientID, itt_AdOrgID, itt_Created,
						itt_CreatedBY, itt_UpdateBY, itt_Update, itt_SalerName, itt_IdAdderss, itt_SaverResult, itt_SendCount, itt_NextSendTime, itt_ReturnSendCount, itt_ReturnNextSendTime,
						itt_ReturnSaveResult, itt_RowID) VALUES ('{$SyncCode}','{$safetyTicketID}','{$ticketIDs}','1', '0','{$SafetyUserID}','{$safeUser}',NULL, NULL, '{$rowsSafety[0]}', 
						'{$SafetyTicketMoney}', '{$rowsSafety[7]}', '{$rowsSafety[8]}', '0', '0', 'N', '0', '{$SellerID}', NULL, NULL, '{$curDateTime}', '{$rowsSafety[1]}', '{$rowsSafety[3]}',
						'{$rowsSafety[4]}', '{$rowsSafety[5]}', NULL, '1', NULL, '0', NULL, NULL, '{$rowsSafety[2]}', '{$rowsSafety[9]}', '{$rowsSafety[10]}', '{$rowsSafety[11]}',
						'{$rowsSafety[12]}', '{$rowsSafety[13]}','{$rowsSafety[7]}','{$SellerStation}', NULL, '{$rows[1]}','{$rows[0]}','{$rows[7]}'+1, 
						'{$curDateTime}', NULL, NULL,'{$rows[3]}', '{$rows[2]}', '{$rows[5]}', '{$rows[4]}', 'Y', '0', '0', '{$curDateTime}', 
						'{$SellerID}', '{$SellerID}', '{$curDateTime}', '{$Seller}','{$safeUserAddress}',NULL, '0', NULL, '0', NULL, NULL, NULL)";
				$queryInsureTicket=$class_mysql_default->my_query("$insertInsureTicket");
				if(!$queryInsureTicket) {
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '插入保险票表失败！'.->my_error(), 'sql' => $queryString);
					echo json_encode($retData);
					exit();
				}
				$updateSellTicket="UPDATE tms_sell_SellTicket SET st_SafetyTicketID='{$safetyTicketID}',st_SafetyTicketNumber='1',st_SafetyTicketMoney='{$SafetyTicketMoney}' WHERE st_TicketID='{$ticketIDs}'";
				$querySellTicket=$class_mysql_default->my_query("$updateSellTicket");
				if(!$querySellTicket){
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '更新售票表失败！', 'sql' => $queryString);
					echo json_encode($retData);
					exit();
				} 
				$printData[] = array('TicketID' => '', 'FromStation' => '', 'ReachStation' => '', 
						'SellPrice' => '0', 'SeatID' => '', 'NoOfRunsID' =>$rows['st_NoOfRunsID'], 'BeginStationTime' =>$rows['st_BeginStationTime'], 
						'NoOfRunsdate' => $rows['st_NoOfRunsdate'], 'safetyTicketID' => $safetyTicketID, 'SafetyTicketMoney' => $rowsSafety['it_Price'], 
						'CheckTicketWindow' =>'', 'SellerID' => $userID, 'isAllTicket' =>'', 
						'VisaCode' => $rowsSafety['it_VisaCode'], 'InsureTicketNo' => $safetyTicketID, 'Name' =>$safeUser, 'IdCard' => $SafetyUserID, 
						'Beneficiary' => $Beneficiary,'AInsuranceValue' =>$rowsSafety['it_AInsuranceValue'], 'BInsuranceValue' => $rowsSafety['it_BInsuranceValue'], 
						'SaleTime'=> $curDateTime, 'AgentCode' => $rowsSafety['it_AgentCode'], 'HandlerCode' => $rowsSafety['it_HandlerCode'], 'SyncCode'=> $SyncCode);
		//		$SafetyTicketID = $SafetyTicketID + 1;
				$nozeroSafetyTicketID=preg_replace('/^0+/','',$safetyTicketID);
				$nozeroSafetyTicketID=$nozeroSafetyTicketID+1;
				$zero='';
				for($j=0;$j<strlen($safetyTicketID)-strlen($nozeroSafetyTicketID);$j++){
					$zeros=$zero.'0';
				}
				$safetyTicketID=$zeros.$nozeroSafetyTicketID; 
			}		
		}
		$queryString = "Update tms_bd_TicketProvide SET tp_CurrentTicket = '{$safetyTicketID}',
	  			tp_InceptTicketNum = tp_InceptTicketNum - '$i' WHERE tp_InceptUserID = '{$userID}' 
	  			AND tp_Type = '保险票' AND tp_InceptTicketNum > 0 AND tp_CurrentTicket = '{$curSafeTicketID}'";
	  	$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新保险票票据表失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}		
		$class_mysql_default->my_query("COMMIT");
		echo json_encode($printData);
		break;
	case "confirmreprint":
		$newTicketID=$_REQUEST['newTicketID'];
		$curTicketID=$_REQUEST['curTicketID'];
	//	$ticketnum=$_REQUEST['ticketnum'];
		$newSafetyTicketID=$_REQUEST['newSafetyTicketID'];
		$curSafetyTicketID=$_REQUEST['curSafetyTicketID'];
	//	$safeticketnum=$_REQUEST['safeticketnum'];
		$st_TicketID=$_REQUEST['st_TicketID'];
		$safeticketnum=$_REQUEST['safeticketnum'];
		$IsSameticketNumbe=$_REQUEST['IsSameTN'];
		$IsSameInsureNumbe=$_REQUEST['IsSameIN'];
		$IsContinuousticke=$_REQUEST['IsContT'];
		$IsContinuousinsur=$_REQUEST['IsContI'];
		$i=0;
		$j=0;
		$class_mysql_default->my_query("BEGIN");
		if($IsSameticketNumbe=='1'){
			foreach (explode("\n",$st_TicketID) as $key =>$ticketIDs){
				if($ticketIDs!=''){
					$i=i+1;
					$ticketIDs=trim($ticketIDs);
					$selectSellTicket="SELECT st_FromStation,st_ReachStation,st_SellPrice,st_SeatID,st_NoOfRunsID,st_BeginStationTime,st_NoOfRunsdate,
						st_SellID,tml_Allticket,tml_CheckTicketWindow FROM tms_sell_SellTicket LEFT OUTER JOIN tms_bd_TicketMode ON 
						tml_NoOfRunsID=st_NoOfRunsID AND tml_NoOfRunsdate=st_NoOfRunsdate WHERE st_TicketID='{$ticketIDs}'";
					$queryselect=$class_mysql_default->my_query("$selectSellTicket");
					if(!$queryselect){
						$class_mysql_default->my_query("ROLLBACK");
						$retData = array('retVal' => 'FAIL', 'retString' => '查询售票表失败！', 'sql' => $queryString);
						echo json_encode($retData);
						exit();
					}
					$rows = @mysqli_fetch_array($queryselect);
					$printData[] = array('TicketID' => $ticketIDs, 'FromStation' => $rows['st_FromStation'], 'ReachStation' => $rows['st_ReachStation'], 
							'SellPrice' => $rows['st_SellPrice'], 'SeatID' => ($rows['st_SeatID'] + 1), 'NoOfRunsID' => $rows['st_NoOfRunsID'], 'BeginStationTime' => $rows['st_BeginStationTime'], 
							'NoOfRunsdate' => $rows['st_NoOfRunsdate'], 'safetyTicketID' =>'', 'SafetyTicketMoney' => '0', 
							'CheckTicketWindow' => $rows['tml_CheckTicketWindow'], 'SellerID' => $rows['st_SellID'], 'isAllTicket' => $rows['tml_Allticket'], 
							'VisaCode' => '', 'InsureTicketNo' => '', 'Name' => '', 'IdCard' => '', 'Beneficiary' => '',
							'AInsuranceValue' =>'', 'BInsuranceValue' => '', 'SaleTime'=> '', 'AgentCode' => '', 'HandlerCode' => '', 'SyncCode'=>'');
				}		
			}
		}else{
			foreach (explode("\n",$st_TicketID) as $key =>$ticketIDs){
				if($ticketIDs!=''){
					$i=i+1;
					$ticketIDs=trim($ticketIDs);
					$selectSellTicket="SELECT st_FromStation,st_ReachStation,st_SellPrice,st_SeatID,st_NoOfRunsID,st_BeginStationTime,st_NoOfRunsdate,
						st_SellID,tml_Allticket,tml_CheckTicketWindow FROM tms_sell_SellTicket LEFT OUTER JOIN tms_bd_TicketMode ON 
						tml_NoOfRunsID=st_NoOfRunsID AND tml_NoOfRunsdate=st_NoOfRunsdate WHERE st_TicketID='{$ticketIDs}'";
					$queryselect=$class_mysql_default->my_query("$selectSellTicket");
					if(!$queryselect){
						$class_mysql_default->my_query("ROLLBACK");
						$retData = array('retVal' => 'FAIL', 'retString' => '查询售票表失败！', 'sql' => $queryString);
						echo json_encode($retData);
						exit();
					}
					$rows = @mysqli_fetch_array($queryselect);
					$insertSellTicket="INSERT `tms_sell_SellTicket` (`st_TicketID`, `st_NoOfRunsID`, `st_LineID`, `st_NoOfRunsdate`, 
						`st_BeginStationTime`, `st_StopStationTime`, `st_Distance`, `st_BeginStationID`, `st_BeginStation`, `st_FromStationID`, 
						`st_FromStation`, `st_ReachStationID`, `st_ReachStation`, `st_EndStationID`, `st_EndStation`, `st_SellPrice`, `st_SellPriceType`, 
						`st_ColleSellPriceType`, `st_TotalMan`, `st_FullPrice`, `st_HalfPrice`, `st_StandardPrice`, `st_BalancePrice`, `st_ServiceFee`, 
						`st_otherFee1`, `st_otherFee2`, `st_otherFee3`, `st_otherFee4`, `st_otherFee5`, `st_otherFee6`, `st_StationID`, `st_Station`, 
						`st_SellDate`, `st_SellTime`, `st_BusModelID`, `st_BusModel`, `st_SeatID`, `st_SellID`, `st_SellName`, `st_FreeSeats`, 
						`st_SafetyTicketID`, `st_SafetyTicketNumber`, `st_SafetyTicketMoney`, `st_SafetyTicketPassengerID`, `st_TicketState`, `st_IsBalance`, 
						`st_BalanceDateTime`, `st_AlterTicket`,`st_StationBalance`) SELECT '{$curTicketID}',st_NoOfRunsID,st_LineID,st_NoOfRunsdate,st_BeginStationTime,st_StopStationTime,
						st_Distance,st_BeginStationID,st_BeginStation,st_FromStationID,st_FromStation,st_ReachStationID,st_ReachStation,st_EndStationID,st_EndStation,
						st_SellPrice,st_SellPriceType,st_ColleSellPriceType,st_TotalMan,st_FullPrice,st_HalfPrice,st_StandardPrice,st_BalancePrice,st_ServiceFee,
						st_otherFee1,st_otherFee2,st_otherFee3,st_otherFee4,st_otherFee5,st_otherFee6,st_StationID,st_Station,st_SellDate,st_SellTime,st_BusModelID,
						st_BusModel,st_SeatID,st_SellID,st_SellName,st_FreeSeats,st_SafetyTicketID,st_SafetyTicketNumber,st_SafetyTicketMoney,st_SafetyTicketPassengerID,
						st_TicketState,st_IsBalance,st_BalanceDateTime,st_AlterTicket,st_StationBalance FROM tms_sell_SellTicket WHERE st_TicketID='{$ticketIDs}'";
					$querySellTicket=$class_mysql_default->my_query("$insertSellTicket");
					if(!$querySellTicket) {
						$class_mysql_default->my_query("ROLLBACK");
						$retData = array('retVal' => 'FAIL', 'retString' => '插入售票表失败！', 'sql' => $queryString);
						echo json_encode($retData);
						exit();
					}
					$updateSell="UPDATE tms_sell_SellTicket SET st_TicketState='8' WHERE st_TicketID='{$ticketIDs}'";
					$querySell=$class_mysql_default->my_query("$updateSell");
					if(!$querySell){
						$class_mysql_default->my_query("ROLLBACK");
						$retData = array('retVal' => 'FAIL', 'retString' => '更新售票表失败！', 'sql' => $updateSell);
						echo json_encode($retData);
						exit();
					}
					$updateInsureTicket="UPDATE tms_sell_InsureTicket SET itt_TicketNo='{$curTicketID}' WHERE itt_InsureTicketNo=(SELECT st_SafetyTicketID FROM tms_sell_SellTicket
						WHERE st_TicketID='{$curTicketID}')";
					$queryInsureTicket=$class_mysql_default->my_query("$updateInsureTicket");
					if(!$queryInsureTicket){
						$class_mysql_default->my_query("ROLLBACK");
						$retData = array('retVal' => 'FAIL', 'retString' => '更新保险票表失败！', 'sql' => $queryString);
						echo json_encode($retData);
						exit();
					}
					$printData[] = array('TicketID' => $curTicketID, 'FromStation' => $rows['st_FromStation'], 'ReachStation' => $rows['st_ReachStation'], 
							'SellPrice' => $rows['st_SellPrice'], 'SeatID' => ($rows['st_SeatID'] + 1), 'NoOfRunsID' => $rows['st_NoOfRunsID'], 'BeginStationTime' => $rows['st_BeginStationTime'], 
							'NoOfRunsdate' => $rows['st_NoOfRunsdate'], 'safetyTicketID' =>'', 'SafetyTicketMoney' => '0', 
							'CheckTicketWindow' => $rows['tml_CheckTicketWindow'], 'SellerID' => $rows['st_SellID'], 'isAllTicket' => $rows['tml_Allticket'], 
							'VisaCode' => '', 'InsureTicketNo' => '', 'Name' => '', 'IdCard' => '', 'Beneficiary' => '',
							'AInsuranceValue' =>'', 'BInsuranceValue' => '', 'SaleTime'=> '', 'AgentCode' => '', 'HandlerCode' => '', 'SyncCode'=>'');
					$nozeroTicketID=preg_replace('/^0+/','',$curTicketID);
					$nozeroTicketID=$nozeroTicketID+1;
					$zero='';
					for($j=0;$j<strlen($curTicketID)-strlen($nozeroTicketID);$j++){
						$zeros=$zero.'0';
					}
					$curTicketID=$zeros.$nozeroTicketID;
				//	$curTicketID = $curTicketID + 1;
				}		
			}
			$queryString = "Update tms_bd_TicketProvide SET tp_CurrentTicket = '{$curTicketID}', 
		  				tp_InceptTicketNum = tp_InceptTicketNum - '$i' WHERE tp_InceptUserID = '{$userID}' 
		  				AND tp_Type = '客票' AND tp_InceptTicketNum > 0 AND tp_CurrentTicket = '{$newTicketID}'";
		  	$result = $class_mysql_default->my_query("$queryString");
			if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '更新客票票据表失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
		}
		if($IsSameInsureNumbe=='1'){
			foreach (explode("\n",$safeticketnum) as $key =>$safeticketIDs){
				if($safeticketIDs!=''){
					$j=$j+1;
					$selectInsure="SELECT itt_InsureTicketNo,itt_SyncCode,itt_Price,itt_VisaCode,itt_Name,itt_IdCard,itt_Beneficiary,itt_AinsuranceValue,
						itt_BinsuranceValue,itt_AgentCode,itt_HandlerCode,itt_SaleTime,st_NoOfRunsID,st_NoOfRunsdate,st_BeginStationTime 
						FROM tms_sell_InsureTicket LEFT OUTER JOIN tms_sell_SellTicket ON st_TicketID=itt_TicketNo WHERE itt_InsureTicketNo='{$safeticketIDs}'";
					$queryInsure=$class_mysql_default->my_query("$selectInsure");
					if(!$queryInsure){
						$class_mysql_default->my_query("ROLLBACK");
						$retData = array('retVal' => 'FAIL', 'retString' => '查询保险票表失败！', 'sql' => $queryString);
						echo json_encode($retData);
						exit();
					}
					$rows = @mysqli_fetch_array($queryInsure);
					$printData[] = array('TicketID' => '', 'FromStation' => '', 'ReachStation' => '', 
							'SellPrice' => '0', 'SeatID' => '', 'NoOfRunsID' =>$rows['st_NoOfRunsID'], 'BeginStationTime' =>$rows['st_BeginStationTime'], 
							'NoOfRunsdate' => $rows['st_NoOfRunsdate'], 'safetyTicketID' => $safeticketIDs, 'SafetyTicketMoney' => $rows['itt_Price'], 
							'CheckTicketWindow' =>'', 'SellerID' => $rows['st_SellID'], 'isAllTicket' =>'', 
							'VisaCode' => $rows['itt_VisaCode'], 'InsureTicketNo' => $safeticketIDs, 'Name' =>$rows['itt_Name'], 'IdCard' => $rows['itt_IdCard'], 
							'Beneficiary' => $rows['itt_Beneficiary'],'AInsuranceValue' =>$rows['itt_AinsuranceValue'], 'BInsuranceValue' => $rows['itt_BinsuranceValue'], 
							'SaleTime'=> $rows['itt_SaleTime'], 'AgentCode' => $rows['itt_AgentCode'], 'HandlerCode' => $rows['itt_HandlerCode'], 'SyncCode'=> $rows['itt_SyncCode']);
				}		
			}
		}else{
			foreach (explode("\n",$safeticketnum) as $key =>$safeticketIDs){
				if($safeticketIDs!=''){
					$j=$j+1;
				//	$SyncCode=$rowsSafety['it_ComCode'].$rowsSafety['it_Perfix'].$safeticketIDs;
					$selectInsure="SELECT itt_InsureTicketNo,itt_SyncCode,itt_Price,itt_VisaCode,itt_Name,itt_IdCard,itt_Beneficiary,itt_AinsuranceValue,
						itt_BinsuranceValue,itt_AgentCode,itt_HandlerCode,itt_SaleTime,st_NoOfRunsID,st_NoOfRunsdate,st_BeginStationTime 
						FROM tms_sell_InsureTicket LEFT OUTER JOIN tms_sell_SellTicket ON st_TicketID=itt_TicketNo WHERE itt_InsureTicketNo='{$safeticketIDs}'";
					$queryInsure=$class_mysql_default->my_query("$selectInsure");
					if(!$queryInsure){
						$class_mysql_default->my_query("ROLLBACK");
						$retData = array('retVal' => 'FAIL', 'retString' => '查询保险票表失败！', 'sql' => $queryString);
						echo json_encode($retData);
						exit();
					}
					$rows = @mysqli_fetch_array($queryInsure);
					$SyncCode=substr($rows['itt_SyncCode'],0,strlen($rows['itt_SyncCode'])-strlen($rows['itt_InsureTicketNo'])).$curSafetyTicketID;
					$insertInsureTicket="INSERT tms_sell_InsureTicket (itt_SyncCode, itt_InsureTicketNo, itt_TicketNo, itt_CreatedType, itt_Status, itt_IdCard,
							itt_Name, itt_Beneficiary, itt_TbInsureProductID, itt_InsureProductName, itt_Price, itt_AinsuranceValue, itt_BinsuranceValue, itt_CinsuranceValue,
							itt_DinsuranceValue, itt_IsUpMoney, itt_UpMoneyID, itt_Saler, itt_PtrReserveID, itt_SaleComputer, itt_SaleTime, itt_RiskCode, itt_PationType,
							itt_AgentCode, itt_VisaCode, itt_PolicyNo, itt_UploadStatus,itt_UploadDate, itt_ReturnUploadStatus, itt_ReturnUploadDate, itt_IDCardType, itt_MakeCode,
							itt_ComCode, itt_HandlerCode, itt_Handler1Code, itt_OperatorCode, itt_ApporverCode, itt_TotalSum, itt_ReserveName, itt_ADOrgCode, itt_ADOrgName,itt_ADOrgValue,
							itt_SeatNo, itt_RideDate,itt_ScheduleID, itt_ScheduleValue, itt_FormName, itt_FormValue, itt_ReachName, itt_ReachValue, itt_IsActive, itt_AdClientID, itt_AdOrgID, itt_Created,
							itt_CreatedBY, itt_UpdateBY, itt_Update, itt_SalerName, itt_IdAdderss, itt_SaverResult, itt_SendCount, itt_NextSendTime, itt_ReturnSendCount, itt_ReturnNextSendTime,
							itt_ReturnSaveResult, itt_RowID) SELECT '{$SyncCode}','{$curSafetyTicketID}',itt_TicketNo,itt_CreatedType, itt_Status, itt_IdCard,
							itt_Name, itt_Beneficiary, itt_TbInsureProductID, itt_InsureProductName, itt_Price, itt_AinsuranceValue, itt_BinsuranceValue, itt_CinsuranceValue,
							itt_DinsuranceValue, itt_IsUpMoney, itt_UpMoneyID, itt_Saler, itt_PtrReserveID, itt_SaleComputer, itt_SaleTime, itt_RiskCode, itt_PationType,
							itt_AgentCode, itt_VisaCode, itt_PolicyNo, itt_UploadStatus,itt_UploadDate, itt_ReturnUploadStatus, itt_ReturnUploadDate, itt_IDCardType, itt_MakeCode,
							itt_ComCode, itt_HandlerCode, itt_Handler1Code, itt_OperatorCode, itt_ApporverCode, itt_TotalSum, itt_ReserveName, itt_ADOrgCode, itt_ADOrgName,itt_ADOrgValue,
							itt_SeatNo, itt_RideDate,itt_ScheduleID, itt_ScheduleValue, itt_FormName, itt_FormValue, itt_ReachName, itt_ReachValue, itt_IsActive, itt_AdClientID, itt_AdOrgID, itt_Created,
							itt_CreatedBY, itt_UpdateBY, itt_Update, itt_SalerName, itt_IdAdderss, itt_SaverResult, itt_SendCount, itt_NextSendTime, itt_ReturnSendCount, itt_ReturnNextSendTime,
							itt_ReturnSaveResult, itt_RowID FROM tms_sell_InsureTicket WHERE itt_InsureTicketNo='{$safeticketIDs}'";
					$queryInsureTicket=$class_mysql_default->my_query("$insertInsureTicket");
					if(!$queryInsureTicket) {
						$class_mysql_default->my_query("ROLLBACK");
						$retData = array('retVal' => 'FAIL', 'retString' => '插入保险票表失败！', 'sql' => $queryString);
						echo json_encode($retData);
						exit();
					}
					$updateSafe="UPDATE tms_sell_InsureTicket SET itt_Status='8' WHERE itt_InsureTicketNo='{$safeticketIDs}'";
					$querySell=$class_mysql_default->my_query("$updateSafe");
					if(!$querySell){
						$class_mysql_default->my_query("ROLLBACK");
						$retData = array('retVal' => 'FAIL', 'retString' => '更新保险票表失败！', 'sql' => $updateSell);
						echo json_encode($retData);
						exit();
					}
					$updateSellTicket="UPDATE tms_sell_SellTicket SET st_SafetyTicketID='{$curSafetyTicketID}' WHERE st_TicketID=(SELECT itt_TicketNo FROM tms_sell_InsureTicket
						WHERE itt_InsureTicketNo='{$curSafetyTicketID}')";
					$querySellTicket=$class_mysql_default->my_query("$updateSellTicket");
					if(!$querySellTicket){
						$class_mysql_default->my_query("ROLLBACK");
						$retData = array('retVal' => 'FAIL', 'retString' => '更新售票表失败！', 'sql' => $queryString);
						echo json_encode($retData);
						exit();
					}
					$printData[] = array('TicketID' => '', 'FromStation' => '', 'ReachStation' => '', 
							'SellPrice' => '0', 'SeatID' => '', 'NoOfRunsID' =>$rows['st_NoOfRunsID'], 'BeginStationTime' =>$rows['st_BeginStationTime'], 
							'NoOfRunsdate' => $rows['st_NoOfRunsdate'], 'safetyTicketID' => $curSafetyTicketID, 'SafetyTicketMoney' => $rows['itt_Price'], 
							'CheckTicketWindow' =>'', 'SellerID' => $rows['st_SellID'], 'isAllTicket' =>'', 
							'VisaCode' => $rows['itt_VisaCode'], 'InsureTicketNo' => $curSafetyTicketID, 'Name' =>$rows['itt_Name'], 'IdCard' => $rows['itt_IdCard'], 
							'Beneficiary' => $rows['itt_Beneficiary'],'AInsuranceValue' =>$rows['itt_AinsuranceValue'], 'BInsuranceValue' => $rows['itt_BinsuranceValue'], 
							'SaleTime'=> $rows['itt_SaleTime'], 'AgentCode' => $rows['itt_AgentCode'], 'HandlerCode' => $rows['itt_HandlerCode'], 'SyncCode'=>$SyncCode);
					$nozeroTicketID=preg_replace('/^0+/','',$curSafetyTicketID);
					$nozeroTicketID=$nozeroTicketID+1;
					$zero='';
					for($j=0;$j<strlen($curSafetyTicketID)-strlen($nozeroTicketID);$j++){
						$zeros=$zero.'0';
					}
					$curSafetyTicketID=$zeros.$nozeroTicketID;
				//	$curSafetyTicketID = $curSafetyTicketID + 1;
				}		
			}
			$queryString = "Update tms_bd_TicketProvide SET tp_CurrentTicket = '{$curSafetyTicketID}',
		  			tp_InceptTicketNum = tp_InceptTicketNum - '$j'	WHERE tp_InceptUserID = '{$userID}' 
		  			AND tp_Type = '保险票' AND tp_InceptTicketNum > 0 AND tp_CurrentTicket = '{$newSafetyTicketID}'";
		  	$result = $class_mysql_default->my_query("$queryString");
			if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '更新保险票票据表失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}		
		}
		$class_mysql_default->my_query("COMMIT");
		echo json_encode($printData);
		break;
	case "cancelsell":
		$noofrunsID = $_REQUEST['noofrunsID'];
		$norunsdate = $_REQUEST['norunsdate'];
		$tnum = $_REQUEST['tnum'];
		$htnum = $_REQUEST['htnum'];
		$seatnos = $_REQUEST['seatnos'];
		
	  	//取消座位号
		//$strsqlselet = "LOCK TABLES tms_bd_TicketMode WRITE";
	  	//$strsqlselet = "SELECT tml_SeatStatus, tml_LeaveSeats FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$noofrunsID') AND (tml_NoOfRunsdate = '$norunsdate') LOCK IN SHARE MODE";
	  	$strsqlselet = "SELECT tml_SeatStatus, tml_LeaveSeats, tml_LeaveHalfSeats FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$noofrunsID') 
	  				AND (tml_NoOfRunsdate = '$norunsdate') FOR UPDATE";
	  	$class_mysql_default->my_query("BEGIN");
	  	$resultselet = $class_mysql_default->my_query("$strsqlselet");
	  	$rows = @mysqli_fetch_array($resultselet);
	  	foreach(explode(",", trim($seatnos)) as $seatno) {
	  		$rows[0] = substr_replace($rows[0], '0', $seatno, 1);
	  	} 
		$rows[1] = $rows[1] + ($tnum + $htnum); 
		$rows[2] = $rows[2] + $htnum; 
		$strsqlselet = "UPDATE tms_bd_TicketMode SET tml_SeatStatus = '$rows[0]', tml_LeaveSeats = '$rows[1]', tml_LeaveHalfSeats = '$rows[2]' 
					WHERE (tml_NoOfRunsID = '$noofrunsID') AND (tml_NoOfRunsdate = '$norunsdate')";
	  	$resultselet = $class_mysql_default->my_query("$strsqlselet");
		if($resultselet) {
			$class_mysql_default->my_query("COMMIT");
			$retData = array('retVal' => 'SUCC', 'totalNum' => ($tnum + $htnum), 'halfNum' => $htnum);
			echo json_encode($retData);
			exit();
		}
		else {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '取消座位号失败！');
			echo json_encode($retData);
			exit();
		}
/*	case "GETRETURNTICKETINFO":
		$st_TicketID = $_REQUEST['st_TicketID'];
		$queryString = "SELECT rtk_TicketID FROM tms_sell_ReturnTicket WHERE rtk_TicketID = '{$st_TicketID}'";
		$result = $class_mysql_default->my_query("$queryString");
		if(mysqli_num_rows($result) == 1) {
			$retData = array('retVal' => 'FAIL', 'retString' => '此票已签！');
			echo json_encode($retData);
			exit();
		}
		$queryString = "SELECT ct_TicketID FROM tms_chk_CheckTicket WHERE ct_TicketID = '{$st_TicketID}'";
		$result = $class_mysql_default->my_query("$queryString");
		if(mysqli_num_rows($result) == 1) {
			$retData = array('retVal' => 'FAIL', 'retString' => '此票已检！');
			echo json_encode($retData);
			exit();
		}
		$queryString = "SELECT st_TicketID,st_SellPrice FROM tms_sell_SellTicket WHERE st_TicketID = '{$st_TicketID}'";
		$result = $class_mysql_default->my_query("$queryString");
		if(mysqli_num_rows($result) == 0) {
			$retData = array('retVal' => 'FAIL', 'retString' => '此票未售出！');
			echo json_encode($retData);
			exit();
		}
		else {
			$row = mysqli_fetch_array($result);
			$retData = array('retVal' => 'SUCC', 'st_TicketID' => $row['st_TicketID'], 'st_SellPrice' => $row['st_SellPrice']);
			echo json_encode($retData);
			exit();
		} */
	case "GETRETURNTICKETINFO":
		$signed='';
		$checked='';
		$unsell='';
		$selled='';
		$price='';
		$errored='';
		$allprice=0;
		$st_TicketID = $_REQUEST['st_TicketID'];
		$IsContinuou = $_REQUEST['IsContinuou'];
		$ticketnum = $_REQUEST['ticketnum'];
		$tnum=$_REQUEST['tnum'];
		$i=0;
	//	foreach (explode("\n",$st_TicketID) as $key =>$ticketIDs){
		foreach (explode("\n",$ticketnum) as $key =>$ticketIDs){
			$queryString = "SELECT rtk_TicketID FROM tms_sell_ReturnTicket WHERE rtk_TicketID = '{$ticketIDs}'";
			$result = $class_mysql_default->my_query("$queryString");
			if(mysqli_num_rows($result) == 1) {
				if($signed==''){
					$signed=$signed.$ticketIDs;
				}else{
					$signed=$signed.",".$ticketIDs;
				}
			}else{
				$queryString = "SELECT ct_TicketID FROM tms_chk_CheckTicket WHERE ct_TicketID = '{$ticketIDs}'";
				$result = $class_mysql_default->my_query("$queryString");
				if(mysqli_num_rows($result) == 1) {
					if($checked==''){
						$checked=$checked.$ticketIDs;
					}else{
						$checked=$checked.",".$ticketIDs;
					}
				}else{
					$queryString="SELECT et_TicketID FROM tms_sell_ErrTicket WHERE et_TicketID='{$ticketIDs}'";
					$result = $class_mysql_default->my_query("$queryString");
					if(mysqli_num_rows($result) == 1){
						if($errored==''){
							$errored=$errored.$ticketIDs;
						}else{
							$errored=$errored.",".$ticketIDs;
						}
					}else{
						$queryString = "SELECT st_TicketID,st_SellPrice FROM tms_sell_SellTicket WHERE st_TicketID = '{$ticketIDs}'";
						$result = $class_mysql_default->my_query("$queryString");
						if(mysqli_num_rows($result) == 0){
							if($unsell==''){
								$unsell=$unsell.$ticketIDs;
							}else{
								$unsell=$unsell.",".$ticketIDs;
							}
						}else{
							$row = mysqli_fetch_array($result);
							if($selled==''){
								$i=$i+1;
								$selled=$selled.$ticketIDs;
								$price=$price.$row['st_SellPrice'];
								$allprice=$allprice+$row['st_SellPrice'];
							}else{
								$i=$i+1;
								$selled=$selled."\n".$ticketIDs;
								$price=$price."\n".$row['st_SellPrice'];
								$allprice=$allprice+$row['st_SellPrice'];
							}
						}
					}
				}
			}
		}
		$retData = array('signed' =>'票号：'.$signed.'已签！', 'checked' =>'票号：'.$checked.'已检！','errored' =>'票号：'.$errored.'已废！',
			'unsell' =>'票号：'.$unsell.'未售出！', 'selled'=>$selled,'price'=>$price,'allprice'=>$allprice,'num'=>$i);
		echo json_encode($retData);
		exit();
/*		$queryString = "SELECT rtk_TicketID FROM tms_sell_ReturnTicket WHERE rtk_TicketID = '{$st_TicketID}'";
		$result = $class_mysql_default->my_query("$queryString");
		if(mysqli_num_rows($result) == 1) {
			$retData = array('retVal' => 'FAIL', 'retString' => '此票已签！');
			echo json_encode($retData);
			exit();
		}
		$queryString = "SELECT ct_TicketID FROM tms_chk_CheckTicket WHERE ct_TicketID = '{$st_TicketID}'";
		$result = $class_mysql_default->my_query("$queryString");
		if(mysqli_num_rows($result) == 1) {
			$retData = array('retVal' => 'FAIL', 'retString' => '此票已检！');
			echo json_encode($retData);
			exit();
		}
		$queryString = "SELECT st_TicketID,st_SellPrice FROM tms_sell_SellTicket WHERE st_TicketID = '{$st_TicketID}'";
		$result = $class_mysql_default->my_query("$queryString");
		if(mysqli_num_rows($result) == 0) {
			$retData = array('retVal' => 'FAIL', 'retString' => '此票未售出！');
			echo json_encode($retData);
			exit();
		}
		else {
			$row = mysqli_fetch_array($result);
			$retData = array('retVal' => 'SUCC', 'st_TicketID' => $row['st_TicketID'], 'st_SellPrice' => $row['st_SellPrice']);
			echo json_encode($retData);
			exit();
		}	*/
	case "getstation":
		$fromstation=$_GET['fromstation'];
		if($fromstation!=""){
			$queryString="SELECT sset_SiteName FROM tms_bd_SiteSet WHERE sset_HelpCode LIKE '{$fromstation}%' OR 
					sset_SiteName LIKE '{$fromstation}%'";
			$result = $class_mysql_default->my_query("$queryString");
			while ($row = mysqli_fetch_array($result)) {
				$retData[] = array(
					'from' => $row['sset_SiteName']);
			}
			echo json_encode($retData);
		}else{
			$retData[] = array(
					'from' => '');
			echo json_encode($retData);
		}
		break;
	case "GETERRORTICKETINFO":
		$signed='';
		$checked='';
		$selled='';
		$unexist='';
		$errored='';
		$selledsafe='';
		$erroredsafe='';
		$unselledsafe='';
		$ticketnum = $_REQUEST['ticketnum'];
		$safeticketnum=$_REQUEST['safeticketnum'];
	//	if($IsContinuou=='0'){
		if($ticketnum){
			foreach (explode("\n",$ticketnum) as $key => $ticketIDs){
			/*	$queryTicketProvide="SELECT tp_ID FROM tms_bd_TicketProvide WHERE tp_BeginTicket+0<='{$ticketIDs}'+0 AND tp_CurrentTicket+0>'{$ticketIDs}'+0 AND tp_Type='客票'
					AND tp_UserSation='$userStationName'";
				$resultTicketProvide = $class_mysql_default->my_query("$queryTicketProvide");
				if(mysqli_num_rows($resultTicketProvide) == 0){
					if($unexist==''){
						$unexist=$unexist.$ticketIDs;
					}else{
						$unexist=$unexist.",".$ticketIDs;
					} */
			$queryString = "SELECT st_TicketID,st_SellPrice FROM tms_sell_SellTicket WHERE st_TicketID = '{$ticketIDs}'";
			$result = $class_mysql_default->my_query("$queryString");
			if(mysqli_num_rows($result) == 0){
				if($unsell==''){
					$unexist=$unexist.$ticketIDs;
				}else{
					$unexist=$unexist.",".$ticketIDs;
				}
				}else{
					$queryString = "SELECT rtk_TicketID FROM tms_sell_ReturnTicket WHERE rtk_TicketID = '{$ticketIDs}'";
					$result = $class_mysql_default->my_query("$queryString");
					if(mysqli_num_rows($result) == 1) {
						if($signed==''){
							$signed=$signed.$ticketIDs;
						}else{
							$signed=$signed.",".$ticketIDs;
						}
					}else{
						$queryString="SELECT et_TicketID FROM tms_sell_ErrTicket WHERE et_TicketID='{$ticketIDs}'";
						$result = $class_mysql_default->my_query("$queryString");
						if(mysqli_num_rows($result) == 1){
							if($errored==''){
								$errored=$errored.$ticketIDs;
							}else{
								$errored=$errored.",".$ticketIDs;
							}
						}else{
							$queryString = "SELECT ct_TicketID FROM tms_chk_CheckTicket WHERE ct_TicketID = '{$ticketIDs}'";
							$result = $class_mysql_default->my_query("$queryString");
							if(mysqli_num_rows($result) == 1) {
								if($checked==''){
									$checked=$checked.$ticketIDs;
								}else{
									$checked=$checked.",".$ticketIDs;
								}
							}else{
								if($selled==''){
									$selled=$selled.$ticketIDs;
								}else{
									$selled=$selled."\n".$ticketIDs;
								}
							}
						}
					}
				}
			}
		}
		if($safeticketnum){
			foreach (explode("\n",$safeticketnum) as $key =>$safeticketIDs){
				$queryString="SELECT eitt_InsureTicketNo FROM tms_sell_ErrInsureTicket WHERE eitt_InsureTicketNo='{$safeticketIDs}'";
				$result = $class_mysql_default->my_query("$queryString");
				if(mysqli_num_rows($result) == 1){
					if($erroredsafe == ''){
							$erroredsafe=$erroredsafe.$safeticketIDs;
						}else{
							$erroredsafe=$erroredsafe.','.$safeticketIDs;
						}
				}else{
					$queryString = "SELECT itt_InsureTicketNo,itt_Status FROM tms_sell_InsureTicket WHERE itt_InsureTicketNo = '{$safeticketIDs}'";
					$result = $class_mysql_default->my_query("$queryString");
					if(mysqli_num_rows($result) == 1){
						if($selledsafe == ''){
							$selledsafe=$selledsafe.$safeticketIDs;
						}else{
							$selledsafe=$selledsafe."\n".$safeticketIDs;
						}
					}else{
						if($unselledsafe==''){
							$unselledsafe=$unselledsafe.$safeticketIDs;
						}else{
							$unselledsafe=$unselledsafe.','.$safeticketIDs;
						}
					}
				}
			}
		}
		$retData = array('signed'=>'票号：'.$signed.'已签！', 'checked'=>'票号：'.$checked.'已检！','errored'=>'票号：'.$errored.'已废！',
			'unexist'=>'客票号：'.$unexist.'不存在或未售出！', 'unselledsafe'=>'保险票号：'.$unselledsafe.'未售出！','erroredsafe'=>'保险票号：'.$erroredsafe.'已废！',
			'selled'=>$selled,'selledsafe'=>$selledsafe);
		echo json_encode($retData);
		break;
	case "GETDELETETICKETINFO":
		$signed='';
		$checked='';
		$selled='';
		$unexist='';
		$IsContinuou=$_REQUEST['IsContinuou'];
		$ticketnum=$_REQUEST['ticketnum'];
		$tnum=$_REQUEST['tnum'];
		$st_TicketID = $_REQUEST['st_TicketID'];
		if($IsContinuou=='0'){
			foreach (explode("\n",$ticketnum) as $key => $ticketIDs){
				$queryTicketProvide="SELECT tp_ID FROM tms_bd_TicketProvide WHERE tp_CurrentTicket+0<='{$ticketIDs}'+0 AND tp_EndTicket+0>='{$ticketIDs}'+0 AND tp_Type='客票'
					AND tp_UserSation='$userStationName'";
				$resultTicketProvide = $class_mysql_default->my_query("$queryTicketProvide");
				if(mysqli_num_rows($resultTicketProvide) == 0){
					if($unexist==''){
						$unexist=$unexist.$ticketIDs;
					}else{
						$unexist=$unexist.",".$ticketIDs;
					}
				}else{
					$queryString = "SELECT rtk_TicketID FROM tms_sell_ReturnTicket WHERE rtk_TicketID = '{$ticketIDs}'";
					$result = $class_mysql_default->my_query("$queryString");
					if(mysqli_num_rows($result) == 1) {
						if($signed==''){
							$signed=$signed.$ticketIDs;
						}else{
							$signed=$signed.",".$ticketIDs;
						}
					}else{
						$queryString = "SELECT ct_TicketID FROM tms_chk_CheckTicket WHERE ct_TicketID = '{$ticketIDs}'";
						$result = $class_mysql_default->my_query("$queryString");
						if(mysqli_num_rows($result) == 1) {
							if($checked==''){
								$checked=$checked.$ticketIDs;
							}else{
								$checked=$checked.",".$ticketIDs;
							}
						}else{
								if($selled==''){
									$selled=$selled.$ticketIDs;
								}else{
									$selled=$selled."\n".$ticketIDs;
								}
						}
					}
				}
			}
		}else{
			for($i=0;$i<$tnum;$i++){
				$ticketIDs=$st_TicketID;
				$queryTicketProvide="SELECT tp_ID FROM tms_bd_TicketProvide WHERE tp_CurrentTicket+0<='{$ticketIDs}'+0 AND tp_EndTicket+0>='{$ticketIDs}'+0 AND tp_Type='客票'
					AND tp_UserSation='$userStationName'";
				$resultTicketProvide = $class_mysql_default->my_query("$queryTicketProvide");
				if(mysqli_num_rows($resultTicketProvide) == 0){
					if($unexist==''){
						$unexist=$unexist.$ticketIDs;
					}else{
						$unexist=$unexist.",".$ticketIDs;
					}
				}else{
					$queryString = "SELECT rtk_TicketID FROM tms_sell_ReturnTicket WHERE rtk_TicketID = '{$ticketIDs}'";
					$result = $class_mysql_default->my_query("$queryString");
					if(mysqli_num_rows($result) == 1) {
						if($signed==''){
							$signed=$signed.$ticketIDs;
						}else{
							$signed=$signed.",".$ticketIDs;
						}
					}else{
						$queryString = "SELECT ct_TicketID FROM tms_chk_CheckTicket WHERE ct_TicketID = '{$ticketIDs}'";
						$result = $class_mysql_default->my_query("$queryString");
						if(mysqli_num_rows($result) == 1) {
							if($checked==''){
								$checked=$checked.$ticketIDs;
							}else{
								$checked=$checked.",".$ticketIDs;
							}
						}else{
								if($selled==''){
									$selled=$selled.$ticketIDs;
								}else{
									$selled=$selled."\n".$ticketIDs;
								}
						}
					}
				}
				$nozeroTicketID=preg_replace('/^0+/','',$st_TicketID);
				$nozeroTicketID=$nozeroTicketID+1;
				$zero='';
				for($j=0;$j<strlen($st_TicketID)-strlen($nozeroTicketID);$j++){
					$zeros=$zero.'0';
				}
				$st_TicketID=$zeros.$nozeroTicketID;
			}
		}
		$retData = array('signed'=>'票号：'.$signed.'已签！', 'checked'=>'票号：'.$checked.'已检！','unexist'=>'客票号：'.$unexist.'不存在或已售出！', 'selled'=>$selled);
		echo json_encode($retData);
		break;
	case "GETRETURNTICKETINFO1":
		$checked='';
		$unsell='';
		$unsign='';
		$returned='';
		$returntype='';
		$returnrate='';
		$sxprice='';
		$sellprice='';
		$returnticket='';
		$signtime='';
		$signdate='';
		$signuser='';
		$errored='';
		$returnprice=0;
		$i=0;
		$st_TicketID = $_REQUEST['st_TicketID'];
		$tnum=$_REQUEST['tnum'];
		$IsContinuou=$_REQUEST['IsContinuou'];
		$ticketnum=$_REQUEST['ticketnum'];
		foreach (explode("\n",$ticketnum) as $key => $ticketIDs){
			$queryString = "SELECT st_TicketID,st_SellPrice FROM tms_sell_SellTicket WHERE st_TicketID = '{$ticketIDs}'";
			$result = $class_mysql_default->my_query("$queryString");
			if(mysqli_num_rows($result) == 0){
				if($unsell==''){
					$unsell=$unsell.$ticketIDs;
				}else{
					$unsell=$unsell.",".$ticketIDs;
				}
			}else{
				$queryString="SELECT et_TicketID FROM tms_sell_ErrTicket WHERE et_TicketID='{$ticketIDs}'";
				$result = $class_mysql_default->my_query("$queryString");
				if(mysqli_num_rows($result) == 1){
					if($errored==''){
						$errored=$errored.$ticketIDs;
					}else{
						$errored=$errored.",".$ticketIDs;
					}
				}else{
					$queryString = "SELECT ct_TicketID FROM tms_chk_CheckTicket WHERE ct_TicketID = '{$ticketIDs}'";
					$result = $class_mysql_default->my_query("$queryString");
					if(mysqli_num_rows($result) == 1) {
						if($checked==''){
							$checked=$checked.$ticketIDs;
						}else{
							$checked=$checked.",".$ticketIDs;
						}
					}else{
						$Selectreturnticket="SELECT rtk_ReturnType,rtk_ReturnPrice,rtk_ReturnRate,rtk_SXPrice,rtk_SellPrice, rtk_TicketID,rtk_IsBalance,rtk_SignTime,rtk_SignDate,rtk_SignUser 
							FROM tms_sell_ReturnTicket WHERE rtk_TicketID='{$ticketIDs}'";
						$resultreturnticket = $class_mysql_default->my_query("$Selectreturnticket");
						if (!$resultreturnticket){
							$retData = array('retVal' => 'FAIL', 'retString' => '查询退票表失败！', 'sql' => $queryString);
							echo json_encode($retData);
							exit();
						}
						if(mysqli_num_rows($resultreturnticket) == 0) {
							if($unsign==''){
								$unsign=$unsign.$ticketIDs;
							}else{
								$unsign=$unsign.",".$ticketIDs;
							}
						}else{
							$rowreturnticket = mysqli_fetch_array($resultreturnticket);
							if($rowreturnticket['rtk_IsBalance']=='2' || $rowreturnticket['rtk_IsBalance']=='1'){
								if($returned==''){
									$returned=$returned.$ticketIDs;
								}else{
									$returned=$returned.",".$ticketIDs;
								}
							}else{
								$i=$i+1;
								if($returntype==''){
									$returntype=$returntype.$rowreturnticket['rtk_ReturnType'];
								}else{
									$returntype=$returntype."\n".$rowreturnticket['rtk_ReturnType'];
								}
								if($returnrate==''){
									$returnrate=$returnrate.$rowreturnticket['rtk_ReturnRate'];
								}else{
									$returnrate=$returnrate."\n".$rowreturnticket['rtk_ReturnRate'];
								}
								if($sxprice==''){
									$sxprice=$sxprice.$rowreturnticket['rtk_SXPrice'];
								}else{
									$sxprice=$sxprice."\n".$rowreturnticket['rtk_SXPrice'];
								}
								if($sellprice==''){
									$sellprice=$sellprice.$rowreturnticket['rtk_SellPrice'];
								}else{
									$sellprice=$sellprice."\n".$rowreturnticket['rtk_SellPrice'];
								}
								if($returnticket==''){
									$returnticket=$returnticket.$rowreturnticket['rtk_TicketID'];
								}else{
									$returnticket=$returnticket."\n".$rowreturnticket['rtk_TicketID'];
								}
								if($signtime==''){
									$signtime=$signtime.$rowreturnticket['rtk_SignTime'];
								}else{
									$signtime=$signtime."\n".$rowreturnticket['rtk_SignTime'];
								}
								if($signdate==''){
									$signdate=$signdate.$rowreturnticket['rtk_SignDate'];
								}else{
									$signdate=$signdate."\n".$rowreturnticket['rtk_SignDate'];
								}
								if($signuser==''){
									$signuser=$signuser.$rowreturnticket['rtk_SignUser'];
								}else{
									$signuser=$signuser."\n".$rowreturnticket['rtk_SignUser'];
								}
								$returnprice=$returnprice+$rowreturnticket['rtk_ReturnPrice'];
							}
						}
					}
				}
			}
		}
		$retData = array('unsign' =>'票号：'.$unsign.'未签！', 'checked' =>'票号：'.$checked.'已检！','errored' =>'票号：'.$errored.'已废！',
			'unsell' =>'票号：'.$unsell.'未售出！', 'returned'=>'票号：'.$returned.'已退！','returnprice'=>$returnprice,
			'returntype'=>$returntype,'returnrate'=>$returnrate,'sxprice'=>$sxprice,'sellprice'=>$sellprice,
			'returnticket'=>$returnticket,'signtime'=>$signtime,'signdate'=>$signdate,'signuser'=>$signuser,'num'=>$i);
		echo json_encode($retData);
		break;
	case "changeSeatNo":
		$noofrunsID = $_REQUEST['NoOfRunsID'];
		$norunsdate = $_REQUEST['NoOfRunsdate'];
		$curSeatno = $_REQUEST['curSeatno'];
		$newSeatno = $_REQUEST['newSeatno'];
		
	  	//改变座位号
	  	$strsqlselet = "SELECT tml_SeatStatus,tml_TotalSeats FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$noofrunsID')	AND (tml_NoOfRunsdate = '$norunsdate') FOR UPDATE";
	  	$class_mysql_default->my_query("BEGIN");
	  	$resultselet = $class_mysql_default->my_query("$strsqlselet");
	  	$rows = mysqli_fetch_array($resultselet);
	  	if(intval($newSeatno,10) > intval($rows[1],10)) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'newSeatno' => $newSeatno, '$rows' => $rows[1], 'retString' => '座位号超出范围！');
				echo json_encode($retData);
				exit();
	  	}
	  	if(substr($rows[0], $newSeatno - 1, 1) == "0") {
	  		$rows[0] = substr_replace($rows[0], '1', $newSeatno - 1, 1);
	  		$rows[0] = substr_replace($rows[0], '0', $curSeatno - 1, 1);
			$strsqlselet = "UPDATE tms_bd_TicketMode SET tml_SeatStatus = '$rows[0]' WHERE (tml_NoOfRunsID = '$noofrunsID') AND (tml_NoOfRunsdate = '$norunsdate')";
		  	$resultselet = $class_mysql_default->my_query("$strsqlselet");
			if($resultselet) {
				$class_mysql_default->my_query("COMMIT");
				$retData = array('retVal' => 'SUCC', 'newSeatno' => $newSeatno, 'SeatStatus' => $rows[0]);
				echo json_encode($retData);
			}
			else {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '更新票版失败！');
				echo json_encode($retData);
			}
	  	}
		else {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '该座位号已用！请重新选择。');
			echo json_encode($retData);
		}
		break;
	case "GETREPRINTTICKETINFO":
		$signed='';
		$checked='';
		$unsell='';
		$selled='';
		$reprinted='';
		$selledsafe='';
		$unselledsafe='';
		$reprintedsafe='';
		$price='';
		$samereprintt='';
		$samereprinti='';
		$it=0;
		$is=0;
		$IsSameTN=$_REQUEST['IsSameTN'];
		$IsSameIN=$_REQUEST['IsSameIN'];
		$st_TicketID=$_REQUEST['st_TicketID'];
	//	$tnum=$_REQUEST['tnum'];
		$safeticketnum=$_REQUEST['safeticketnum'];
	//	$snum=$_REQUEST['snum'];
		foreach (explode("\n",$st_TicketID) as $key =>$ticketIDs){
	//	for($i=0;$i<$tnum;$i++){
		//	$ticketIDs=$st_TicketID;
		/*	if($IsSameTN=='1'){
				$selecterror="SELECT et_TicketID FROM tms_sell_ErrTicket WHERE et_TicketID='{$ticketIDs}'";
				$queryerror=$class_mysql_default->my_query("$selecterror");
				if(mysqli_num_rows($queryerror) == 1){
					if($samereprintt==''){
						$samereprintt=$samereprintt.$ticketIDs;
					}else{
						$samereprintt=$samereprintt.",".$ticketIDs;
					}
				}
			} */
			$queryString = "SELECT rtk_TicketID FROM tms_sell_ReturnTicket WHERE rtk_TicketID = '{$ticketIDs}'";
			$result = $class_mysql_default->my_query("$queryString");
			if(mysqli_num_rows($result) == 1) {
				if($signed==''){
					$signed=$signed.$ticketIDs;
				}else{
					$signed=$signed.",".$ticketIDs;
				}
			}else{
				$queryString = "SELECT ct_TicketID FROM tms_chk_CheckTicket WHERE ct_TicketID = '{$ticketIDs}'";
				$result = $class_mysql_default->my_query("$queryString");
				if(mysqli_num_rows($result) == 1) {
					if($checked==''){
						$checked=$checked.$ticketIDs;
					}else{
						$checked=$checked.",".$ticketIDs;
					}
				}else{
					$queryString = "SELECT st_TicketID,st_SellPrice,st_TicketState FROM tms_sell_SellTicket WHERE st_TicketID = '{$ticketIDs}'";
					$result = $class_mysql_default->my_query("$queryString");
					if(mysqli_num_rows($result) == 0){
						if($unsell==''){
							$unsell=$unsell.$ticketIDs;
						}else{
							$unsell=$unsell.",".$ticketIDs;
						}
					}else{
						$row = mysqli_fetch_array($result);
						if($row['st_TicketState']=='8'){
							if($reprinted==''){
									$reprinted=$reprinted.$ticketIDs;
								}else{
									$reprinted=$reprinted."\n".$ticketIDs;
								}
						}else{
							if($IsSameTN=='1'){
								$selecterror="SELECT et_TicketID FROM tms_sell_ErrTicket WHERE et_TicketID='{$ticketIDs}'";
								$queryerror=$class_mysql_default->my_query("$selecterror");
								if(mysqli_num_rows($queryerror) == 1){
									if($samereprintt==''){
										$samereprintt=$samereprintt.$ticketIDs;
									}else{
										$samereprintt=$samereprintt.",".$ticketIDs;
									}
								}else{
									$it=$it+1;
									if($selled==''){
										$selled=$selled.$ticketIDs;
									}else{
										$selled=$selled."\n".$ticketIDs;
									}
								}
							}else{
								$it=$it+1;
								if($selled==''){
									$selled=$selled.$ticketIDs;
								}else{
									$selled=$selled."\n".$ticketIDs;
								}
							}
						}
					}
				}
			}
	/*		$nozeroTicketID=preg_replace('/^0+/','',$st_TicketID);
			$nozeroTicketID=$nozeroTicketID+1;
			$zero='';
			for($j=0;$j<strlen($st_TicketID)-strlen($nozeroTicketID);$j++){
				$zeros=$zero.'0';
			}
			$st_TicketID=$zeros.$nozeroTicketID; */
		}
		foreach (explode("\n",$safeticketnum) as $key =>$safeticketIDs){
	//	for($i=0;$i<$snum;$i++){
		//	$safeticketIDs=$safeticketnum;
	/*		if($IsSameIN=='1'){
				$selecterrori="SELECT eitt_InsureTicketNo FROM tms_sell_ErrInsureTicket WHERE eitt_InsureTicketNo='{$safeticketIDs}'";
				$queryerrori=$class_mysql_default->my_query("$selecterrori");
				if(mysqli_num_rows($queryerrori) == 1){
					if($samereprinti==''){
						$samereprinti=$samereprinti.$safeticketIDs;
					}else{
						$samereprinti=$samereprinti.','.$safeticketIDs;
					}
				}
			} */
			$queryString = "SELECT itt_InsureTicketNo,itt_Status FROM tms_sell_InsureTicket WHERE itt_InsureTicketNo = '{$safeticketIDs}'";
			$result = $class_mysql_default->my_query("$queryString");
			if(mysqli_num_rows($result) == 1){
				$row = mysqli_fetch_array($result);
				if($row['itt_Status']=='8'){
					if($reprintedsafe == ''){
						$reprintedsafe=$reprintedsafe.$safeticketIDs;
					}else{
						$reprintedsafe=$reprintedsafe."\n".$safeticketIDs;
					}
				}else{
					if($IsSameIN=='1'){
						$selecterrori="SELECT eitt_InsureTicketNo FROM tms_sell_ErrInsureTicket WHERE eitt_InsureTicketNo='{$safeticketIDs}'";
						$queryerrori=$class_mysql_default->my_query("$selecterrori");
						if(mysqli_num_rows($queryerrori) == 1){
							if($samereprinti==''){
								$samereprinti=$samereprinti.$safeticketIDs;
							}else{
								$samereprinti=$samereprinti.','.$safeticketIDs;
							}
						}else{
							$is=$is+1;
							if($selledsafe == ''){
								$selledsafe=$selledsafe.$safeticketIDs;
							}else{
								$selledsafe=$selledsafe."\n".$safeticketIDs;
							}
						}
					}else{
						$is=$is+1;
						if($selledsafe == ''){
							$selledsafe=$selledsafe.$safeticketIDs;
						}else{
							$selledsafe=$selledsafe."\n".$safeticketIDs;
						}
					}
				}
			}else{
				if($unselledsafe==''){
					$unselledsafe=$unselledsafe.$safeticketIDs;
				}else{
					$unselledsafe=$unselledsafe.','.$safeticketIDs;
				}
			}
	/*		$nozerosafeTicketID=preg_replace('/^0+/','',$safeticketnum);
			$nozerosafeTicketID=$nozerosafeTicketID+1;
			$zero='';
			for($j=0;$j<strlen($safeticketnum)-strlen($nozerosafeTicketID);$j++){
				$zeros=$zero.'0';
			}
			$safeticketnum=$zeros.$nozerosafeTicketID; */
		}
		$retData = array('signed' =>'票号：'.$signed.'已签！', 'checked' =>'票号：'.$checked.'已检！','unsell' =>'票号：'.$unsell.'未售出！', 'selled'=>$selled,
			'unselledsafe'=>'保险票号：'.$unselledsafe.'未售出！','reprinted'=>'票号：'.$reprinted.'已重打！', 'reprintedsafe'=>'保险票号：'.$reprintedsafe.'已重打！',
			'selledsafe'=>$selledsafe,'errort'=>'票号：'.$samereprintt.'已废！', 'errori'=>'保险票号：'.$samereprinti.'已废！','numt'=>$it,'nums'=>$is);
		echo json_encode($retData);
		break;
	case "GETRITICKETINFO":
		$IsContinuou=$_REQUEST['IsContinuou'];
		$ticketnum1=$_REQUEST['ticketnum1'];
		$st_TicketID=$_REQUEST['st_TicketID'];
		$tnum=$_REQUEST['tnum'];
		$i=0;
		foreach (explode("\n",$st_TicketID) as $key => $ticketIDs){
			$queryTicketProvide="SELECT tp_ID FROM tms_bd_TicketProvide WHERE tp_BeginTicket+0<='{$ticketIDs}'+0 AND tp_CurrentTicket+0>'{$ticketIDs}'+0 AND tp_Type='客票'
				AND tp_UserSation='$userStationName'";
			$resultTicketProvide = $class_mysql_default->my_query("$queryTicketProvide");
			if(mysqli_num_rows($resultTicketProvide) == 0){
				if($unexist==''){
					$unexist=$unexist.$ticketIDs;
				}else{
					$unexist=$unexist.",".$ticketIDs;
				}
			}else{
				$queryString = "SELECT st_TicketID,st_SellPrice,st_TicketState FROM tms_sell_SellTicket WHERE st_TicketID = '{$ticketIDs}'";
				$result = $class_mysql_default->my_query("$queryString");
				if(mysqli_num_rows($result) == 0){
					if($unexist==''){
						$unexist=$unexist.$ticketIDs;
					}else{
						$unexist=$unexist.",".$ticketIDs;
					}
				}else{
					$queryString = "SELECT rtk_TicketID FROM tms_sell_ReturnTicket WHERE rtk_TicketID = '{$ticketIDs}'";
					$result = $class_mysql_default->my_query("$queryString");
					if(mysqli_num_rows($result) == 1) {
						if($signed==''){
							$signed=$signed.$ticketIDs;
						}else{
							$signed=$signed.",".$ticketIDs;
						}
					}else{
						$queryString="SELECT et_TicketID FROM tms_sell_ErrTicket WHERE et_TicketID='{$ticketIDs}'";
						$result = $class_mysql_default->my_query("$queryString");
						if(mysqli_num_rows($result) == 1){
							if($errored==''){
								$errored=$errored.$ticketIDs;
							}else{
								$errored=$errored.",".$ticketIDs;
							}
						}else{
							if($selled==''){
								$i=$i+1;
								$selled=$selled.$ticketIDs;
							}else{
								$i=$i+1;
								$selled=$selled."\n".$ticketIDs;
							}
						}
					}
				}
			}
		}
		$retData = array('errored' =>'票号：'.$errored.'已废！','unsell' =>'票号：'.$unexist.'不存在或未售出！', 'returned'=>'票号：'.$signed.'已退！','selled'=>$selled,'num'=>$i);
		echo json_encode($retData);
	default:
}
