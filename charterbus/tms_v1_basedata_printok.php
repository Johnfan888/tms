<?php
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$op = $_REQUEST['op'];
switch ($op)
{
	case "confirmprint":
		$TicketID=$_REQUEST['TicketID'];
		$ChartereID=$_REQUEST['ChartereID'];
		$tpID=$_REQUEST['tpID'];
		$Customer=$_REQUEST['Customer'];
		$BusNumber=$_REQUEST['BusNumber'];
		$DriverName=$_REQUEST['DriverName'];
		$CharteredBusDate=$_REQUEST['CharteredBusDate'];
		$From=$_REQUEST['From'];
		$Reach=$_REQUEST['Reach'];
		$Kilometers=$_REQUEST['Kilometers'];
		$Seats=$_REQUEST['Seats'];
		$Peoples=$_REQUEST['Peoples'];
		$CarriageFee=$_REQUEST['CarriageFee'];
		$StagnateFee=$_REQUEST['StagnateFee'];
		$realticketmoney=$_REQUEST['realticketmoney'];
		$CharteredBusDays=$_REQUEST['CharteredBusDays'];
		$BillingDate=date('Y-m-d');
		$BillingStation=$userStationName;
		$BillingerID=$userID;
		$BillingerName=$userName;
		
		$CharteredBusDateF=date('Y-m-d',strtotime("$CharteredBusDate+1 day"));
		
		$class_mysql_default->my_query("START TRANSACTION");
		
		$update1="UPDATE tms_bd_CharteredBus SET cb_TicketID='{$TicketID}',cb_BillingDate='{$BillingDate}',cb_BillingStation='{$BillingStation}',
			cb_BillingerID='{$BillingerID}',cb_BillingerName='{$BillingerName}',cb_State='1' WHERE cb_ChartereID='{$ChartereID}'";
		$query1=$class_mysql_default->my_query($update1);
		if(!$query1) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新包车数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		
		$update2="UPDATE tms_bd_TicketProvide SET tp_CurrentTicket=tp_CurrentTicket+1, tp_InceptTicketNum=tp_InceptTicketNum-1
			WHERE tp_ID='{$tpID}'";
		$query2=$class_mysql_default->my_query($update2);
		if(!$query2) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新票据数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		//用完之后不更新状态
	/*	$select3="SELECT tp_InceptTicketNum FROM tms_bd_TicketProvide WHERE tp_ID='{$tpID}'";
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
		
		$printData = array('TicketID' => $TicketID, 'Customer' => $Customer, 'BusNumber' => $BusNumber, 'DriverName' => $DriverName,
				'CharteredBusDate' => $CharteredBusDate, 'CharteredBusDateF' => $CharteredBusDateF, 'From' => $From, 'Reach' => $Reach,
				'Kilometers' => $Kilometers, 'Seats' => $Seats, 'Peoples' => $Peoples, 'CarriageFee' => $CarriageFee, 'StagnateFee' => $StagnateFee,
				'realticketmoney' => $realticketmoney, 'BillingDate' => $BillingDate, 'BillingStation' => $BillingStation, 'BillingerID' => $BillingerID);
		echo json_encode($printData);
		
	 	$class_mysql_default->my_query("COMMIT");
		$class_mysql_default->my_query("END TRANSACTION"); 
		
	default:
}

?>