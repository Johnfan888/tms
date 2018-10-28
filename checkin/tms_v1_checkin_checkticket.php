<?
//检票界面

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

if($userGroupID == "3")	require_once("../ui/user/topnoleft.inc.php");

$selectTicketProvide="SELECT tp_CurrentTicket FROM tms_bd_TicketProvide WHERE tp_InceptUserID='{$userID}' AND tp_InceptTicketNum>0 AND tp_Type='结算单' ORDER BY tp_ProvideData ASC";
$queryTicketProvide=$class_mysql_default->my_query("$selectTicketProvide");
if(!$queryTicketProvide) echo $class_mysql_default->my_error();
$rowTicketProvide=mysqli_fetch_array($queryTicketProvide);
$willcheck="style='display:'";
$checking="style='display:none'";
$checked="style='display:none'";
$printed="style='display:none'";
$nowdate = date("Y-m-d");

if (isset($_GET['op']))
{
	$oper=$_GET['op'];
	
	//开始检票
	if($oper=="addbus")
	{
		$NoOfRunsID = $_GET['nrID']; //班次
		$NoOfRunsdate = $_GET['nrDate'];//日期
		$CheckWindow = $_GET['cwID'];//检票口
		$isAllTicket = $_GET['allTkt'];
		$BusID = $_GET['busID'];
		$reporttime =$_GET['reporttime'];
		$willcheck="style='display:'";
		$checking="style='display:'";

		$queryString = "SELECT ct_CheckTicketWindow FROM tms_chk_CheckTemp WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_Flag = '1' AND ct_NoOfRunsdate='$NoOfRunsdate'";
		$result1 = $class_mysql_default->my_query("$queryString"); 
		//$row4=mysqli_fetch_array($result1);
		//$row4['ct_CheckTicketWindow']=$CheckTicketWindow;
		//echo h.$row4['ct_CheckTicketWindow'];
		if(mysqli_num_rows($result1) == 0) {
		$class_mysql_default->my_query("BEGIN");
		if($isAllTicket == '0')	{
			$selectprice="SELECT pd_IsPass FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID='{$NoOfRunsID}' AND pd_NoOfRunsdate='{$NoOfRunsdate}' AND pd_FromStationID='{$userStationID}' FOR UPDATE";
			$queryprice=$class_mysql_default->my_query("$selectprice");
			if(!$queryprice){
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('锁定票价数据失败');</script>";
			}
		}
		
		/* 允许一个检票口有多个在检班次  */
		$strsql = "UPDATE tms_chk_CheckTemp SET ct_Flag = '1' WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID' AND 
			ct_ReportDateTime=(SELECT rt_ReportDateTime FROM tms_sch_Report WHERE rt_NoOfRunsID='{$NoOfRunsID}' AND rt_NoOfRunsdate='{$NoOfRunsdate}' AND 
			rt_BusID='{$BusID}' AND rt_AttemperStationID='{$userStationID}')";
	/*	if($isAllTicket == '1')	$strsql = "UPDATE tms_chk_CheckTemp SET ct_Flag = '1' WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID' AND 
									ct_ReportDateTime=(SELECT rt_ReportDateTime FROM tms_sch_Report WHERE rt_NoOfRunsID='{$NoOfRunsID}' AND rt_NoOfRunsdate='{$NoOfRunsdate}' AND 
									rt_BusID='{$BusID}' AND rt_AttemperStationID='{$userStationID}')";
		else					$strsql = "UPDATE tms_chk_CheckTemp SET ct_Flag = '1' WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID= '$BusID' AND
									ct_ReportDateTime=(SELECT rt_ReportDateTime FROM tms_sch_Report WHERE rt_NoOfRunsID='{$NoOfRunsID}' AND rt_NoOfRunsdate='{$NoOfRunsdate}' AND 
									rt_BusID='{$BusID}' AND rt_AttemperStationID='{$userStationID}')"; */
		$result = $class_mysql_default->my_query("$strsql");
		if(!$result){
			$class_mysql_default->my_query("ROLLBACK");
			echo "<script>alert('更新检票数据失败');</script>";
		}
		if($isAllTicket == '0')	{
			$updateprice="UPDATE tms_bd_PriceDetail SET pd_IsPass='2' WHERE pd_NoOfRunsID='{$NoOfRunsID}' AND pd_NoOfRunsdate='{$NoOfRunsdate}' AND pd_FromStationID='{$userStationID}'";
			$resutprice=$class_mysql_default->my_query("$updateprice");
			if(!$resutprice){
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('更新票价数据失败');</script>";
			}
		}
		$class_mysql_default->my_query("COMMIT");
		}
		else {
			$row4=mysqli_fetch_array($result1);
			$CheckTicketWindow = $row4['ct_CheckTicketWindow'] ;
			echo "<script>alert('本班次已在['+$CheckTicketWindow+']号检票口进行检票，取消或发班后才能检票！');</script>";
		}
		/* 一个检票口只能有一个在检班次 
		$queryString = "SELECT ct_NoOfRunsID FROM tms_chk_CheckTemp WHERE ct_CheckTicketWindow = $CheckWindow AND ct_Flag = '1'";
		$result = $class_mysql_default->my_query("$queryString"); 
		if(mysqli_num_rows($result) == 0) {
			if($isAllTicket == '1')	$strsql = "UPDATE tms_chk_CheckTemp SET ct_Flag = '1' WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID'";
			else					$strsql = "UPDATE tms_chk_CheckTemp SET ct_Flag = '1' WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate'";
			$result = $class_mysql_default->my_query("$strsql");
		}
		else {
			echo "<script>alert('本检票口已有班次在检，完成或撤销后才能开始本班次检票！');</script>";
		} 
		if(!$result){
			echo "<script>alert('更新票版信息失败');</script>";
		}
		if($result) {
			if($isAllTicket == '0') {
				$strsql = "UPDATE tms_bd_TicketMode SET tml_AllowSell = '0', tml_StopRun = '2' WHERE tml_NoOfRunsID = '$NoOfRunsID' AND tml_NoOfRunsdate = '$NoOfRunsdate'";
				$result = $class_mysql_default->my_query("$strsql");
				if($result) {
					$class_mysql_default->my_query("COMMIT");
				}
				else {
					$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('更新票版信息失败');</script>";
				}
			}
			else {	//通票班次不更新票版
				$class_mysql_default->my_query("COMMIT");
			}
		}
		else {
			$class_mysql_default->my_query("ROLLBACK");
			echo "<script>alert('更新检票班次信息失败！');</script>";
		}  */
	}
	
	//取消检票
	if($oper=="cancelbus")
	{
		$NoOfRunsID = $_GET['nrID'];
		$NoOfRunsdate = $_GET['nrDate'];
		$isAllTicket = $_GET['allTkt'];
		$BusID = $_GET['busID'];
		$willcheck="style='display:'";
		$checking="style='display:'";
		$queryString = "SELECT ctt_TicketID FROM tms_chk_CheckTicketTemp WHERE ctt_NoOfRunsID = '$NoOfRunsID' AND ctt_NoOfRunsdate = '$NoOfRunsdate' AND ctt_BusID = '$BusID' 
			AND ctt_FromStationID='{$userStationID}'";
	/*	if($isAllTicket == '1') $queryString = "SELECT ctt_TicketID FROM tms_chk_CheckTicketTemp WHERE ctt_NoOfRunsID = '$NoOfRunsID' AND ctt_NoOfRunsdate = '$NoOfRunsdate' AND ctt_BusID = '$BusID' 
									AND ctt_FromStationID='{$userStationID}'";
		else					$queryString = "SELECT ctt_TicketID FROM tms_chk_CheckTicketTemp WHERE ctt_NoOfRunsID = '$NoOfRunsID' AND ctt_NoOfRunsdate = '$NoOfRunsdate' AND ctt_BusID = '$BusID' 
									AND ctt_FromStationID='{$userStationID}'"; */
		$result = $class_mysql_default->my_query("$queryString"); 
		if(mysqli_num_rows($result) == 0) {
			$class_mysql_default->my_query("BEGIN");
			if($isAllTicket == '0')	{
				$selectprice="SELECT pd_IsPass FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID='{$NoOfRunsID}' AND pd_NoOfRunsdate='{$NoOfRunsdate}' AND pd_FromStationID='{$userStationID}' FOR UPDATE";
				$queryprice=$class_mysql_default->my_query("$selectprice");
				if(!$queryprice){
					$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('锁定票价数据失败');</script>";
				}
			}
			$strsql = "UPDATE tms_chk_CheckTemp SET ct_Flag='0' WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID' AND 
				ct_ReportDateTime=(SELECT rt_ReportDateTime FROM tms_sch_Report WHERE rt_NoOfRunsID='{$NoOfRunsID}' AND rt_NoOfRunsdate='{$NoOfRunsdate}' AND 
				rt_BusID='{$BusID}' AND rt_AttemperStationID='{$userStationID}')";
		/*	if($isAllTicket == '1')	$strsql = "UPDATE tms_chk_CheckTemp SET ct_Flag='0' WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID' AND 
										ct_ReportDateTime=(SELECT rt_ReportDateTime FROM tms_sch_Report WHERE rt_NoOfRunsID='{$NoOfRunsID}' AND rt_NoOfRunsdate='{$NoOfRunsdate}' AND 
										rt_BusID='{$BusID}' AND rt_AttemperStationID='{$userStationID}')";
			else					$strsql = "UPDATE tms_chk_CheckTemp SET ct_Flag='0' WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID' AND
										ct_ReportDateTime=(SELECT rt_ReportDateTime FROM tms_sch_Report WHERE rt_NoOfRunsID='{$NoOfRunsID}' AND rt_NoOfRunsdate='{$NoOfRunsdate}' AND 
										rt_BusID='{$BusID}' AND rt_AttemperStationID='{$userStationID}')"; */
			$result = $class_mysql_default->my_query("$strsql");
			if($result) {
				if($isAllTicket == '0') {
				//	$strsql = "UPDATE tms_bd_TicketMode SET tml_AllowSell = '1', tml_StopRun = '0' WHERE tml_NoOfRunsID = '$NoOfRunsID' AND tml_NoOfRunsdate = '$NoOfRunsdate'";
					$strsql = "UPDATE tms_bd_PriceDetail SET pd_IsPass = '1' WHERE pd_NoOfRunsID = '$NoOfRunsID' AND pd_NoOfRunsdate = '$NoOfRunsdate' AND pd_FromStationID='{$userStationID}'";
					$result = $class_mysql_default->my_query("$strsql");
					if($result) {
						$class_mysql_default->my_query("COMMIT");
					}
					else {
						$class_mysql_default->my_query("ROLLBACK");
						echo "<script>alert('更新票价信息失败');</script>";
					}
				}
				else {	//通票班次不更新票版
					$class_mysql_default->my_query("COMMIT");
				}
			}
			else {
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('更新检票班次信息失败！');</script>";
			}  
		}
		else {
			echo "<script>alert('本班次已有检票，不能撤销！');</script>";
			$willcheck="style='display:none'";
			$checking="style='display:'";
		}
	}
	
	//发班
	if($oper=="letgo")
	{
		$NoOfRunsID = $_GET['nrID'];
		$NoOfRunsdate = $_GET['nrDate'];
		$isAllTicket = $_GET['allTkt'];
		$BusID = $_GET['busID'];
		$ReportDateTime=$_GET['RDT'];
		$EndStation=$_GET['eStat'];
		$willcheck="style='display:'";
		$checking="style='display:none'";
		
		//取得结算单号
		$queryString = "SELECT `tp_CurrentTicket`,`tp_InceptTicketNum` FROM `tms_bd_TicketProvide` WHERE `tp_InceptUserID` = '$userID'
					AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '结算单' ORDER BY tp_ProvideData ASC";
		$result = $class_mysql_default->my_query("$queryString");
		$rows = mysqli_fetch_array($result);
		if (empty($rows[0])) {
			echo "<script>alert('没有可用的结算单！');location.assign('tms_v1_checkin_checkticket.php?op=refresh');</script>";
		}
		else { 
			$curBalanceNo = $rows[0];
		
			$class_mysql_default->my_query("BEGIN");
			if($isAllTicket == '0')	{
					$selectprice="SELECT pd_IsPass FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID='{$NoOfRunsID}' AND pd_NoOfRunsdate='{$NoOfRunsdate}' AND pd_FromStationID='{$userStationID}' FOR UPDATE";
					$queryprice=$class_mysql_default->my_query("$selectprice");
					if(!$queryprice){
						$class_mysql_default->my_query("ROLLBACK");
						echo "<script>alert('锁定票价数据失败');</script>";
					}
				}
			$queryString = "UPDATE tms_sch_Report SET rt_Register='已发车' WHERE rt_NoOfRunsID = '$NoOfRunsID' AND rt_NoOfRunsdate = '$NoOfRunsdate' AND rt_BusID = '$BusID' 
				AND rt_AttemperStationID='{$userStationID}'";
		/*	if($isAllTicket == '1') $queryString = "UPDATE tms_sch_Report SET rt_Register='已发车' WHERE rt_NoOfRunsID = '$NoOfRunsID' AND rt_NoOfRunsdate = '$NoOfRunsdate' AND rt_BusID = '$BusID' 
										AND rt_AttemperStationID='{$userStationID}'";
			else 					$queryString = "UPDATE tms_sch_Report SET rt_Register='已发车' WHERE rt_NoOfRunsID = '$NoOfRunsID' AND rt_NoOfRunsdate = '$NoOfRunsdate' AND rt_BusID = '$BusID' 
										AND rt_AttemperStationID='{$userStationID}'";*/
	  		$result = $class_mysql_default->my_query("$queryString");
			if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('更新调度数据失败！');location.assign('tms_v1_checkin_checkticket.php?op=refresh');</script>";
			}
			else {
				$queryString = "UPDATE tms_chk_CheckTemp SET ct_Flag='2' WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID' AND 
					ct_ReportDateTime=(SELECT rt_ReportDateTime FROM tms_sch_Report WHERE rt_NoOfRunsID='{$NoOfRunsID}' AND rt_NoOfRunsdate='{$NoOfRunsdate}' AND 
					rt_BusID='{$BusID}' AND rt_AttemperStationID='{$userStationID}')";
		/*		if($isAllTicket == '1') $queryString = "UPDATE tms_chk_CheckTemp SET ct_Flag='2' WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID' AND 
											ct_ReportDateTime=(SELECT rt_ReportDateTime FROM tms_sch_Report WHERE rt_NoOfRunsID='{$NoOfRunsID}' AND rt_NoOfRunsdate='{$NoOfRunsdate}' AND 
											rt_BusID='{$BusID}' AND rt_AttemperStationID='{$userStationID}')";
				else					$queryString = "UPDATE tms_chk_CheckTemp SET ct_Flag='2' WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID' AND
											ct_ReportDateTime=(SELECT rt_ReportDateTime FROM tms_sch_Report WHERE rt_NoOfRunsID='{$NoOfRunsID}' AND rt_NoOfRunsdate='{$NoOfRunsdate}' AND 
											rt_BusID='{$BusID}' AND rt_AttemperStationID='{$userStationID}')";	 */ 	
				$result = $class_mysql_default->my_query("$queryString");
				if(!$result) {
					$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('更新检票数据失败！');location.assign('tms_v1_checkin_checkticket.php?op=refresh');</script>";
				}
				else {		
					$queryString = "INSERT `tms_chk_CheckTicket` (`ct_TicketID`, `ct_NoOfRunsID`, `ct_LineID`, `ct_NoOfRunsdate`, 
						`ct_BeginStationTime`, `ct_StopStationTime`, `ct_Distance`, `ct_BeginStationID`, `ct_BeginStation`, `ct_FromStationID`, 
						`ct_FromStation`, `ct_ReachStationID`, `ct_ReachStation`, `ct_EndStationID`, `ct_EndStation`, `ct_SellPrice`, 
						`ct_SellPriceType`, `ct_ColleSellPriceType`, `ct_TotalMan`, `ct_FullPrice`, `ct_HalfPrice`, `ct_StandardPrice`, 
						`ct_BalancePrice`, `ct_ServiceFee`, `ct_otherFee1`, `ct_otherFee2`, `ct_otherFee3`, `ct_otherFee4`, `ct_otherFee5`, 
						`ct_otherFee6`, `ct_StationID`, `ct_Station`, `ct_SellDate`, `ct_SellTime`, `ct_BusModelID`, `ct_BusModel`, 
						`ct_BusID`,`ct_BusNumber`, `ct_SeatID`, `ct_SellID`, `ct_SellName`, `ct_FreeSeats`, `ct_SafetyTicketID`, 
						`ct_SafetyTicketNumber`,`ct_SafetyTicketMoney`, `ct_SafetyTicketPassengerID`, `ct_CheckTicketWindow`, `ct_CheckerID`, 
						`ct_Checker`, `ct_CheckDate`,`ct_CheckTime`,`ct_BalanceNO`,`ct_IsBalance`,`ct_BalanceDateTime`) 
						SELECT `ctt_TicketID`, `ctt_NoOfRunsID`, `ctt_LineID`, `ctt_NoOfRunsdate`, `ctt_BeginStationTime`, `ctt_StopStationTime`, 
						`ctt_Distance`, `ctt_BeginStationID`, `ctt_BeginStation`, `ctt_FromStationID`, `ctt_FromStation`, `ctt_ReachStationID`, 
						`ctt_ReachStation`, `ctt_EndStationID`, `ctt_EndStation`, `ctt_SellPrice`, `ctt_SellPriceType`, `ctt_ColleSellPriceType`, 
						`ctt_TotalMan`, `ctt_FullPrice`, `ctt_HalfPrice`, `ctt_StandardPrice`, `ctt_BalancePrice`, `ctt_ServiceFee`, 
						`ctt_otherFee1`, `ctt_otherFee2`, `ctt_otherFee3`, `ctt_otherFee4`, `ctt_otherFee5`, `ctt_otherFee6`, `ctt_StationID`, 
						`ctt_Station`, `ctt_SellDate`, `ctt_SellTime`, `ctt_BusModelID`, `ctt_BusModel`, `ctt_BusID`,`ctt_BusNumber`, 
						`ctt_SeatID`, `ctt_SellID`, `ctt_SellName`, `ctt_FreeSeats`, `ctt_SafetyTicketID`, `ctt_SafetyTicketNumber`, 
						`ctt_SafetyTicketMoney`, `ctt_SafetyTicketPassengerID`, `ctt_CheckTicketWindow`, `ctt_CheckerID`, `ctt_Checker`, 
						`ctt_CheckDate`,`ctt_CheckTime`,NULL,0,NULL FROM tms_chk_CheckTicketTemp WHERE (ctt_NoOfRunsID = '$NoOfRunsID') 
						AND (ctt_NoOfRunsdate = '$NoOfRunsdate') AND (ctt_BusID = '$BusID')";	  	
				  	$result = $class_mysql_default->my_query("$queryString");
					if(!$result) {
						$class_mysql_default->my_query("ROLLBACK");
						echo "<script>alert('添加检票信息失败！');location.assign('tms_v1_checkin_checkticket.php?op=refresh');</script>";
					}
					else {
						if($isAllTicket == '1') {	//通票班次不更新票版
							/*** 全检时需修改状态，以查询所有车票 。 ***/
							$queryString = "UPDATE tms_sell_SellTicket SET st_TicketState = '1' WHERE st_TicketID IN (SELECT ctt_TicketID 
										FROM tms_chk_CheckTicketTemp)";	
						  	$result = $class_mysql_default->my_query("$queryString");
							if(!$result) {
								$class_mysql_default->my_query("ROLLBACK");
								echo "<script>alert('更新售票信息失败！');location.assign('tms_v1_checkin_checkticket.php?op=refresh');</script>";
							}
							else {
								$queryString = "DELETE FROM tms_chk_CheckTicketTemp WHERE (ctt_NoOfRunsID = '$NoOfRunsID') 
									AND (ctt_NoOfRunsdate = '$NoOfRunsdate') AND (ctt_BusID = '$BusID')";	  	
							  	$result = $class_mysql_default->my_query("$queryString");
								if(!$result) {
									$class_mysql_default->my_query("ROLLBACK");
									echo "<script>alert('删除检票信息失败！');location.assign('tms_v1_checkin_checkticket.php?op=refresh');</script>";
								}
								else {
									$class_mysql_default->my_query("COMMIT");
									//echo "<script>alert('发车成功！');</script>";
									header('Location: tms_v1_checkin_printsheet.php?nrID='.$NoOfRunsID.'&nrDate='.$NoOfRunsdate.'&bID='.$BusID.'&eStat='.$EndStation.'&cbNo='.$curBalanceNo.'&RDT='.$ReportDateTime.'&BNO=none&op=print');
									if(!$result) {
										$class_mysql_default->my_query("ROLLBACK");
										echo "<script>alert('删除检票信息失败！');location.assign('tms_v1_checkin_checkticket.php?op=refresh');</script>";
									}
									else {
										$class_mysql_default->my_query("COMMIT");
										//echo "<script>alert('发车成功！');</script>";
										header('Location: tms_v1_checkin_printsheet.php?nrID='.$NoOfRunsID.'&nrDate='.$NoOfRunsdate.'&bID='.$BusID.'&eStat='.$EndStation.'&cbNo='.$curBalanceNo.'&RDT='.$ReportDateTime.'&BNO=none&op=print');
									}
								}
							}
						}
						else {
							$queryString = "DELETE FROM tms_chk_CheckTicketTemp WHERE (ctt_NoOfRunsID = '$NoOfRunsID') 
									AND (ctt_NoOfRunsdate = '$NoOfRunsdate') AND (ctt_BusID = '$BusID')";	  	
						  	$result = $class_mysql_default->my_query("$queryString");
							if(!$result) {
								$class_mysql_default->my_query("ROLLBACK");
								echo "<script>alert('删除检票信息失败！');location.assign('tms_v1_checkin_checkticket.php?op=refresh');</script>";
							}
							else {
								$updateprice="UPDATE tms_bd_PriceDetail SET pd_IsPass='3' WHERE pd_NoOfRunsID='{$NoOfRunsID}' AND pd_NoOfRunsdate='{$NoOfRunsdate}' 
									AND pd_FromStationID='{$userStationID}'";	  	
								$resutprice=$class_mysql_default->my_query("$updateprice");
								if(!$resutprice) {
									$class_mysql_default->my_query("ROLLBACK");
									echo "<script>alert('更新票价信息失败！');location.assign('tms_v1_checkin_checkticket.php?op=refresh');</script>";
								} 
								else {
									$class_mysql_default->my_query("COMMIT");
									//echo "<script>alert('发车成功！');</script>";
									header('Location: tms_v1_checkin_printsheet.php?nrID='.$NoOfRunsID.'&nrDate='.$NoOfRunsdate.'&bID='.$BusID.'&eStat='.$EndStation.'&cbNo='.$curBalanceNo.'&RDT='.$ReportDateTime.'&BNO=none&op=print');
								}
							}
						}
					}
				}
			}
		}
	}
	
	//退检
	if($oper=="cancelcheck")
	{
		$NoOfRunsID = $_GET['nrID'];
		$NoOfRunsdate = $_GET['nrDate'];
		$TicketID=$_GET['tID'];
		$SeatID=$_GET['sID'];
		$isAllTicket = $_GET['allTkt'];
		$willcheck="style='display:none'";
		$checking="style='display:'";
		$BusID = $_GET['busID'];
		$selectchecktickettemp="SELECT ctt_TicketState FROM tms_chk_CheckTicketTemp WHERE ctt_TicketID='$TicketID'";
		$querychecktickettemp=$class_mysql_default->my_query("$selectchecktickettemp");
		$rowchecktickettemp = mysqli_fetch_array($querychecktickettemp);
		$class_mysql_default->my_query("BEGIN");
		if($isAllTicket == '1') $queryString = "UPDATE tms_chk_CheckTemp SET ct_CheckedTicketNum = (ct_CheckedTicketNum - 1) WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID' AND ct_Flag=1";
		else					$queryString = "UPDATE tms_chk_CheckTemp SET ct_CheckedTicketNum = (ct_CheckedTicketNum - 1) WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID' AND ct_Flag=1";
		$result = $class_mysql_default->my_query("$queryString");
	  	if(!$result) {
			$class_mysql_default->my_query("ROLLBACK");
			echo "<script>alert('检票数据更新失败！');</script>";
		}
		else {
			$queryString = "DELETE FROM tms_chk_CheckTicketTemp WHERE ctt_TicketID = '$TicketID'";	  	
			$result = $class_mysql_default->my_query("$queryString");
			if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('删除数据失败！');</script>";
			}
			else {
				if($isAllTicket == '1') {
					$class_mysql_default->my_query("COMMIT");
					//echo "<script>alert('通票退检成功！');</script>";
				}
				else {
					$queryString = "SELECT tml_SeatStatus FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$NoOfRunsID') 
							AND (tml_NoOfRunsdate = '$NoOfRunsdate') FOR UPDATE";
			  		$result = $class_mysql_default->my_query("$queryString");
					if(!$result) {
						$class_mysql_default->my_query("ROLLBACK");
						echo "<script>alert('锁定票版数据表失败！');</script>";
					}
					else {
						$rows = mysqli_fetch_array($result);
						$seatStatus = $rows['tml_SeatStatus'];
						if($rowchecktickettemp['ctt_TicketState']=='9'){
							$seatStatus = substr_replace($seatStatus, '7', $SeatID - 1, 1);
						}else{
							$seatStatus = substr_replace($seatStatus, '3', $SeatID - 1, 1);
						}
					  	$queryString = "UPDATE tms_bd_TicketMode SET tml_SeatStatus = '$seatStatus' WHERE (tml_NoOfRunsID = '$NoOfRunsID') AND (tml_NoOfRunsdate = '$NoOfRunsdate')";
					  	$result = $class_mysql_default->my_query("$queryString");
						if(!$result) {
							$class_mysql_default->my_query("ROLLBACK");
							echo "<script>alert('更新票版数据表失败！');</script>";
						}
						else {
							$class_mysql_default->my_query("COMMIT");
							//echo "<script>alert('退检成功！');</script>";
						}
					}
				}
			}
		}
	}
	
	//删除已打单班次车辆信息
	if($oper=="delbus")
	{
		$NoOfRunsID = $_GET['nrID'];
		$NoOfRunsdate = $_GET['nrDate'];
		$BusID = $_GET['bID'];
		$queryString = "DELETE FROM tms_chk_CheckTemp WHERE ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID'";
		$result = $class_mysql_default->my_query("$queryString"); 
		if(!$result) echo "<script>alert('删除失败！');</script>";
	}
	
	//检票后刷新页面
	if($oper=="refresh"){
		$NoOfRunsID = $_GET['NoOfRunsID'];
		$willcheck="style='display:none'";
		$checking="style='display:'";
	}
	
	//查询已检页面
	if($oper=="refreshChecked"){
		$willcheck="style='display:none'";
		$checking="style='display:none'";
		$checked="style='display:'";
		$printed="style='display:none'";
	}
}

// auto refresh may not be needed for checkin
$configFileName = "config" . $userID . ".php";
if(!file_exists($configFileName)) {
	$fp = fopen($configFileName, 'w');
	if(!$fp) {
		fclose($fp);
		echo "打开文件\"$configFileName\"失败！";
		exit();
	}
	$retVal = fwrite($fp, "<?\r\n\$checkWindow='';\r\n");
	$retVal = fwrite($fp, "\$checkboxStatus='';\r\n?>");
	if(!$retVal) {
		fclose($fp);
		echo "写入文件\"$configFileName\"失败！";
		exit();
	}
	fclose($fp);
}

require_once("$configFileName");

if($checkboxStatus == "checked")
	$refreshInterval = "300";
else
	$refreshInterval = "72000";

if(isset($_POST['resultquery']))
{
	$checkWindow = $_POST['checkWindow'];
}	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>检票管理</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
<!--  	
	<meta http-equiv="refresh" content="<?php echo $refreshInterval?>;url=tms_v1_checkin_checkticket.php" />
-->
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript">
	function updateConfigFile() {
		document.getElementById("checkWindow").value = document.getElementById("checkWindowIn").value;
		// generate configuration file for refresh
		jQuery.get(
			'tms_v1_checkin_dataops.php',
			{'op': 'REFRESH', 'checkWindow': $("#checkWindow").val(), 'checkboxStatus': '',	'configFileName': $("#configFileName").val(), 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if(objData.retVal == "FAIL"){ 
					alert(objData.retString);
				}
		});
		/* if($("#isrefresh").attr("checked")) {
			jQuery.get(
				'tms_v1_checkin_dataops.php',
				{'op': 'REFRESH', 'checkWindow': $("#checkWindow").val(), 'checkboxStatus': 'checked', 'configFileName': $("#configFileName").val(), 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						alert(objData.retString);
					}
			});
		}
		else {
			jQuery.get(
				'tms_v1_checkin_dataops.php',
				{'op': 'REFRESH', 'checkWindow': $("#checkWindow").val(), 'checkboxStatus': '',	'configFileName': $("#configFileName").val(), 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						alert(objData.retString);
					}
			});
		}*/
	}
	$(document).ready(function(){
	//	$("#table2").tablesorter();
		$("#table3").tablesorter();
		$("#table4").tablesorter();
		$("#table5").tablesorter();
		$("#resultquery").click(function(){ //查询在检班次
			if (document.getElementById("checkWindowIn").value == "") {
				alert("请输入检票口！");
				$("#checkWindowIn").focus();
				return false;
			}
			updateConfigFile();
			window.location.href='tms_v1_checkin_checkticket.php?op=norefresh';
		});
		$("#resultquery1").click(function(){
			if (document.getElementById("checkWindowIn").value == "") {
				alert("请输入检票口！");
				$("#checkWindowIn").focus();
				return false;
			}
			updateConfigFile();
			window.location.href='tms_v1_checkin_checkticket.php?op=refresh';
		});
		$("#resultquery2").click(function(){
			if (document.getElementById("checkWindowIn").value == "") {
				alert("请输入检票口！");
				$("#checkWindowIn").focus();
				return false;
			}
			updateConfigFile();
			window.location.href='tms_v1_checkin_checkticket.php?op=refreshChecked';
		});
		$("#resultquery3").click(function(){
			window.location.href='tms_v1_checkin_querynoofruns.php?chw='+document.getElementById("checkWindowIn").value;
		});
		$("#resultquery4").click(function(){
			window.location.href='tms_v1_checkin_querybalance.php';
		});
				
		$("#ticketID").focus();
		$("#ticketID").keyup(function(e){
			if(e.keyCode == 13){
				jQuery.get(
						'tms_v1_checkin_dataops.php',
						{'op': 'CONFIRMCHECK', 'ticketID': $("#ticketID").val(), 'checkWindow': $("#checkWindow").val(), 'time': Math.random()},
						function(data){
							//alert(data);
							var objData = eval('(' + data + ')');
							if(objData.retVal == "FAIL"){ 
								alert(objData.retString);
								$("#ticketID").val("");
								document.getElementById("ticketID").focus();
							}
							else{
								window.location.href='tms_v1_checkin_checkticket.php?op=refresh&NoOfRunsID=' + objData.NoOfRunsID;;
							}
					});
				// do nothing at this moment
			}
			else {
				$("#ticketID").val(e.value);
			}
		});
		$("#checkticketconfirm").click(function(){
			if (document.getElementById("ticketID").value == "") {
				alert("票号不能为空！");
				$("#ticketID").focus();
			}
			else {
				jQuery.get(
					'tms_v1_checkin_dataops.php',
					{'op': 'CONFIRMCHECK', 'ticketID': $("#ticketID").val(), 'checkWindow': $("#checkWindow").val(), 'time': Math.random()},
					function(data){
						//alert(data);
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL"){ 
							alert(objData.retString);
							$("#ticketID").val("");
							document.getElementById("ticketID").focus();
						}
						else{
							window.location.href='tms_v1_checkin_checkticket.php?op=refresh&NoOfRunsID=' + objData.NoOfRunsID;
						}
				});
			}
		});		
		$("#checkALLconfirm").click(function(){
			if(!confirm("确认全部检票?")) return;
			jQuery.get(
				'tms_v1_checkin_dataops.php',
				{'op': 'CONFIRMCHECKALL', 'checkWindow': $("#checkWindow").val(), 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						alert(objData.retString);
					}
					else{
						alert("全检成功！");
						window.location.href='tms_v1_checkin_checkticket.php?&op=refresh';
					}
			});
		});	
        //检票管理
		$("#idbSpeakText").click(function(){
			//alert('hi');
			var str1 = "旅客们请注意：请乘坐";
			var str2 = "     班次开往";
			var str3 = "方向座位号是          ";
			var str4 = "的旅客，赶快到";
			var str5 = "号检票口检票进站，发车时间快到了，请抓紧时间上车！谢谢！";
			jQuery.get(
				'tms_v1_checkin_dataops.php',
				{'op': 'GETPASSENGERINFO', 'checkWindow': $("#checkWindow").val(), 'time': Math.random()},
				function(data){
					//alert(data);
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						alert(objData.retString);
					}
					if(objData.retVal == "FAIL1"){ 
						alert(objData.retString);
					}
			});
		});			
	});
	function openShutManager(oSourceObj,oTargetObj,shutAble,oOpenTip,oShutTip)
	{
		var sourceObj = typeof oSourceObj == "string" ? document.getElementById(oSourceObj) : oSourceObj;
		var targetObj = typeof oTargetObj == "string" ? document.getElementById(oTargetObj) : oTargetObj;
		var openTip = oOpenTip || "";
		var shutTip = oShutTip || "";
		if(targetObj.style.display != "none") {
			if(shutAble) return;
			targetObj.style.display = "none";
			if(openTip  &&  shutTip){
				sourceObj.innerHTML = shutTip;
			}
		} else {
			targetObj.style.display="block";
			if(openTip && shutTip){
				sourceObj.innerHTML = openTip;
			}
		}
	}
	function dischecking(){
		document.getElementById("willcheck").style.display="none";
		document.getElementById("checking").style.display="";
	}
	</script>
</head>
<body>
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr bgcolor="#FFFFFF">
		<td>
			<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 检票口：</span>&nbsp;&nbsp;
			<input type="text" name="checkWindowIn" id="checkWindowIn" value="<?=$checkWindow?>" size="6"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<!--<input id="isrefresh" name="isrefresh" type="checkbox" <?=$checkboxStatus?> /> 自动刷新 -->
			<input type="button" name="resultquery" id="resultquery" value="查询待检班次" />
			<input type="button" name="resultquery1" id="resultquery1" value="查询在检班次" />
			<input type="button" name="resultquery2" id="resultquery2" value="查询已检班次" />
			<input type="button" name="resultquery3" id="resultquery3" value="查询班次" />
			<input type="button" name="resultquery4" id="resultquery4" value="客凭处理" />
			<input type="hidden" id="checkWindow" name="checkWindow" value="<?php echo $checkWindow?>" />
			<input type="hidden" id="configFileName" name="configFileName" value="<?php echo $configFileName?>" />
			<span class="form_title"  style="color:red"> 结算单号：<?php echo $rowTicketProvide['tp_CurrentTicket'];?></span>&nbsp;&nbsp;
		</td>
	</tr>
<?php 
//将检票状态和售票状态都会存入数据表中
/*	$queryString = "DELETE FROM tms_chk_CheckTemp WHERE ct_Flag = '0'";	//For case of re-reporting after canceling report with bus change 
	$result = $class_mysql_default->my_query("$queryString");
	$queryString = "INSERT IGNORE `tms_chk_CheckTemp` (ct_ReportDateTime,`ct_NoOfRunsID`, `ct_LineID`, `ct_NoOfRunsdate`, `ct_NoOfRunsTime`, `ct_BusID`, `ct_BusNumber`, 
	 		`ct_EndStation`, `ct_TotalSeats`, `ct_SoldTicketNum`, `ct_Allticket`, `ct_CheckTicketWindow`, `ct_UserID`, `ct_User`,`ct_Flag`) 
	 		SELECT rt_ReportDateTime,rt_NoOfRunsID, rt_LineID, rt_NoOfRunsdate, tml_NoOfRunstime, rt_BusID, rt_BusCard, tml_Endstation, rt_SeatNum, 
	 		tml_TotalSeats - tml_LeaveSeats - IFNULL(tml_ReserveSeats,0), tml_Allticket, rt_CheckTicketWindow, '$userID', '$userName', '0' 
	 		FROM tms_sch_Report LEFT OUTER JOIN tms_bd_TicketMode ON rt_NoOfRunsID = tml_NoOfRunsID AND rt_NoOfRunsdate = tml_NoOfRunsdate 
	 		WHERE rt_NoOfRunsdate = '$nowdate' AND rt_Register LIKE '未发车'";
	//echo $queryString;
	$result = $class_mysql_default->my_query("$queryString");
	if(!$result) echo "<script>alert('获取待检班次失败！');</script>";*/
?>	
</table>
</form>
<div id="willcheck" <?php echo $willcheck;?>>		
	<table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableboder">
		<tr>
			<td colspan="11" bgcolor="#FFFFFF" style="font-size:11pt;font-family:黑体;"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 待检班次：</td>
		</tr>
	</table>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder" id="table1">
	<thead>
		<tr bgcolor="#006699">
			<th nowrap="nowrap" align="center">班次</th>
			<th nowrap="nowrap" align="center">线路</th>
			<th nowrap="nowrap" align="center">时间</th>
			<!--<th nowrap="nowrap" align="center">车辆编号</th>
			--><th nowrap="nowrap" align="center">车牌号</th>
			<th nowrap="nowrap" align="center">终点站</th>
			<th nowrap="nowrap" align="center">座位数</th>
			<th nowrap="nowrap" align="center">已售票数</th>
			<th nowrap="nowrap" align="center">是否通票</th>
			<th nowrap="nowrap" align="center">检票口</th>
			<th nowrap="nowrap" align="center">操作</th>
		</tr>
	</thead>
	<tbody>
	<?

		$queryString = "SELECT `ct_NoOfRunsID`, `ct_LineID`, `ct_NoOfRunsdate`, `ct_NoOfRunsTime`, `ct_BusID`, `ct_BusNumber`,tml_TotalSeats, tml_LeaveSeats,
				`ct_EndStation`, `ct_TotalSeats`, `ct_SoldTicketNum`, `ct_Allticket`, `ct_CheckTicketWindow`, `ct_UserID`, `ct_User`, `ct_Flag`, ct_ReportDateTime,
				`li_LineName` FROM tms_chk_CheckTemp 
				LEFT OUTER JOIN tms_bd_LineInfo ON ct_LineID = li_LineID 
				LEFT OUTER JOIN tms_sch_Report ON rt_NoOfRunsID=ct_NoOfRunsID AND rt_NoOfRunsdate=ct_NoOfRunsdate AND rt_BusID=ct_BusID AND rt_ReportDateTime=ct_ReportDateTime
				
				LEFT OUTER JOIN tms_bd_TicketMode ON ct_NoOfRunsID=tml_NoOfRunsID AND ct_NoOfRunsdate=tml_NoOfRunsdate 
				WHERE ct_Flag = '0' AND ct_CheckTicketWindow = '$checkWindow' AND ct_NoOfRunsdate = '$nowdate' AND rt_AttemperStationID='{$userStationID}' AND tml_StopRun!='3'
				ORDER BY STR_TO_DATE(ct_NoOfRunsTime,'%H:%i') ASC";
		$result = $class_mysql_default->my_query("$queryString");
	    while($rows = @mysqli_fetch_array($result))
	    {
	?>
		<tr align="center" bgcolor="#CCCCCC">
			<td nowrap="nowrap"><?=$rows['ct_NoOfRunsID']?></td>
			<td nowrap="nowrap"><?=$rows['li_LineName']?></td>
			<td nowrap="nowrap"><?=$rows['ct_NoOfRunsTime']?></td>
			<!--<td><?=$rows['ct_BusID']?></td>
			--><td nowrap="nowrap"><?=$rows['ct_BusNumber']?></td>
			<td nowrap="nowrap"><?=$rows['ct_EndStation']?></td>
			<td nowrap="nowrap"><?=$rows['ct_TotalSeats']?></td>
			<!-- 
			<td nowrap="nowrap"><?=$rows['ct_SoldTicketNum']?></td>
			-->
			<td nowrap="nowrap"><?=$rows['tml_TotalSeats']-$rows['tml_LeaveSeats']?></td>
			<td nowrap="nowrap"><?($rows['ct_Allticket'] == "1")? print "是" : print "否";?></td>
			<td nowrap="nowrap"><?=$rows['ct_CheckTicketWindow']?>
				<input type="hidden" id="NoOfRunsID" value="<?php echo $rows['ct_NoOfRunsID'];?>"/>
				<input type="hidden" id="NoOfRunsdate" value="<?php echo $rows['ct_NoOfRunsdate'];?>"/>
				<input type="hidden" id="ID" value="<?php echo $checkWindow;?>"/>
				<input type="hidden" id="BusID" value="<?php echo $rows['ct_BusID'];?>"/>
				<input type="hidden" id="Allticket" value="<?php echo $rows['ct_Allticket'];?>"/>
			</td>
			<td align="center">[<a href="tms_v1_checkin_checkticket.php?nrID=<?=$rows['ct_NoOfRunsID']?>&nrDate=<?=$rows['ct_NoOfRunsdate']?>&cwID=<?=$checkWindow?>&allTkt=<?=$rows['ct_Allticket']?>&busID=<?=$rows['ct_BusID']?>&reporttime=<?=$rows['ct_ReportDateTime']?>&op=addbus"]>开始检票</a>]</td>
		</tr>
	<?
		}
	?>
	</tbody>
	</table>
</div>
<br/> 
<div id="checking"  <?php echo $checking;?>>
	<table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableboder">
	  <tr>
	    <td colspan="12" bgcolor="#FFFFFF" style="font-size:11pt;font-family:黑体;"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 在检班次：</td>
	  </tr>
	</table>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder" id="table2">
	<thead>
		<tr bgcolor="#006699">
			<th nowrap="nowrap" align="center">班次</th>
			<th nowrap="nowrap" align="center">线路</th>
			<th nowrap="nowrap" align="center">时间</th>
			<!--<th nowrap="nowrap" align="center">车辆编号</th>
			--><th nowrap="nowrap" align="center">车牌号</th>
			<th nowrap="nowrap" align="center">终点站</th>
			<th nowrap="nowrap" align="center">座位数</th>
			<th nowrap="nowrap" align="center">已售票数</th>
			<th nowrap="nowrap" align="center">已检票数</th>
			<th nowrap="nowrap" align="center">是否通票</th>
			<th nowrap="nowrap" align="center">检票口</th>
			<th nowrap="nowrap" align="center">操作</th>
		</tr>
	</thead>
	<tbody>
	<?
		$queryString = "SELECT `ct_NoOfRunsID`, `ct_LineID`, `ct_NoOfRunsdate`, `ct_NoOfRunsTime`, `ct_BusID`, `ct_BusNumber`,`ct_ReportDateTime`,`ct_EndStation`, 
				`ct_TotalSeats`, `ct_SoldTicketNum`, `ct_CheckedTicketNum`, `ct_Allticket`, `ct_CheckTicketWindow`, `ct_UserID`, `ct_User`, tml_TotalSeats, tml_LeaveSeats,
				`ct_Flag`, `li_LineName` FROM tms_chk_CheckTemp 
				LEFT OUTER JOIN tms_bd_TicketMode ON ct_NoOfRunsID=tml_NoOfRunsID AND ct_NoOfRunsdate=tml_NoOfRunsdate
				LEFT OUTER JOIN tms_sch_Report ON rt_NoOfRunsID=ct_NoOfRunsID AND rt_NoOfRunsdate=ct_NoOfRunsdate AND rt_BusID=ct_BusID AND rt_ReportDateTime=ct_ReportDateTime 
				LEFT OUTER JOIN tms_bd_LineInfo ON ct_LineID = li_LineID 
				WHERE ct_Flag = '1' AND ct_CheckTicketWindow = '$checkWindow' AND ct_NoOfRunsdate = '$nowdate' AND rt_AttemperStationID='{$userStationID}' 
				ORDER BY STR_TO_DATE(ct_NoOfRunsTime,'%H:%i') ASC";
		$result = $class_mysql_default->my_query("$queryString");
		while($rows = mysqli_fetch_array($result)) {
			$str="SELECT  SUM(ct_CheckedTicketNum) AS ct_CheckedTicketNum FROM tms_chk_CheckTemp WHERE  ct_NoOfRunsdate = '$nowdate' AND ct_NoOfRunsID='{$rows['ct_NoOfRunsID']}'";
			$result2=$class_mysql_default->my_query("$str");
			$rows1=mysqli_fetch_array($result2);
	?>
		<tr align="center" bgcolor="#CCCCCC">
			<td nowrap="nowrap"><?=$rows['ct_NoOfRunsID']?></td>
			<td nowrap="nowrap"><?=$rows['li_LineName']?></td>
			<td nowrap="nowrap"><?=$rows['ct_NoOfRunsTime']?></td>
			<!--<td><?=$rows['ct_BusID']?></td>
			--><td nowrap="nowrap"><?=$rows['ct_BusNumber']?></td>
			<td nowrap="nowrap"><?=$rows['ct_EndStation']?></td>
			<td nowrap="nowrap"><?=$rows['ct_TotalSeats']?></td>
			<!--  
			<td nowrap="nowrap"><?=$rows['ct_SoldTicketNum']?></td>
			-->
			<td nowrap="nowrap"><?=$rows['tml_TotalSeats']-$rows['tml_LeaveSeats']?></td>
			<td nowrap="nowrap"><?=$rows1['ct_CheckedTicketNum']?></td>
			<td nowrap="nowrap"><?($rows['ct_Allticket'] == "1")? print "是" : print "否";?></td>
			<td nowrap="nowrap"><?=$rows['ct_CheckTicketWindow']?></td>
			<td align="center">
		    	[<a href="tms_v1_checkin_checkticket.php?nrID=<?=$rows['ct_NoOfRunsID']?>&nrDate=<?=$rows['ct_NoOfRunsdate']?>&allTkt=<?=$rows['ct_Allticket']?>&busID=<?=$rows['ct_BusID']?>&op=cancelbus">取消检票</a>]
		    	[<a href="tms_v1_checkin_checkticket.php?nrID=<?=$rows['ct_NoOfRunsID']?>&nrDate=<?=$rows['ct_NoOfRunsdate']?>&RDT=<?=$rows['ct_ReportDateTime']?>&allTkt=<?=$rows['ct_Allticket']?>&busID=<?=$rows['ct_BusID']?>&eStat=<?=$rows['ct_EndStation']?>&op=letgo" onclick="if(!confirm('是否发班?')) return false;">发班</a>]
		    </td>
		</tr>
		<tr bgcolor="#CCCCCC">
			<td colspan="12">
		<?php if ($rows['ct_Allticket'] == "0") {?>
				<div id="<?=$rows['ct_NoOfRunsID']?>" style="display:">
					<iframe frameborder="1" id="heads" width="100%" src="tms_v1_checkin_seatview.php?nrID=<?=$rows['ct_NoOfRunsID']?>&nrDate=<?=$rows['ct_NoOfRunsdate']?>"></iframe>
				</div>
		<?php } else {?>
				<div id="<?=$rows['ct_NoOfRunsID']?>" style="display:none">
					<iframe frameborder="1" id="heads" width="100%" src="tms_v1_checkin_seatview.php?nrID=<?=$rows['ct_NoOfRunsID']?>&nrDate=<?=$rows['ct_NoOfRunsdate']?>"></iframe>
				</div>
		<?php }?>
			</td>
		</tr>
	<?
		}
	?>	
	</tbody>
	</table>
	<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
		<tr bgcolor="#FFFFFF">
			<td>
				<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 票号：</span>&nbsp;&nbsp;
				<input type="text" name="ticketID" id="ticketID" value="" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="checkticketconfirm" id="checkticketconfirm" value="票号检票确认" /> 		
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="checkALLconfirm" id="checkALLconfirm" value="全检确认" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="idbSpeakText" value="语音广播" />
				
			</td>
		</tr>
	</table>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder" id="table3">
	<thead>
		<tr bgcolor="#006699">
			<th align="center" nowrap="nowrap">班次</th>
			<th align="center">票号</th>
			<th align="center">到站</th>
			<th align="center">售价</th>
			<th align="center">票型</th>
			<th align="center">座号</th>
			<th align="center">售票车站</th>
			<th align="center">检票时间</th>
			<th align="center">检票员</th>
			<th align="center">操作</th>
		</tr>
	</thead>
	<tbody>
	<?
		$strsqlselet = "SELECT ctt_NoOfRunsID,ctt_TicketID,ctt_ReachStation,ctt_SellPrice,ctt_SellPriceType,ctt_SeatID,ctt_NoOfRunsID,
					ctt_NoOfRunsdate,ctt_BusID,ctt_CheckDate,ctt_CheckTime,tms_sell_SellTicket.st_Station 
					FROM tms_chk_CheckTicketTemp,tms_sell_SellTicket
					WHERE tms_chk_CheckTicketTemp.ctt_TicketID=tms_sell_SellTicket.st_TicketID 
					AND tms_chk_CheckTicketTemp.ctt_CheckTicketWindow = '$checkWindow' AND ctt_CheckDate = '$nowdate' AND ctt_FromStationID='{$userStationID}'"; 
		$resultselet = $class_mysql_default->my_query("$strsqlselet");
		while($rows2 = mysqli_fetch_array($resultselet)) {
			$strsqlselet3 = "SELECT tml_Allticket from tms_bd_TicketMode WHERE (tml_NoOfRunsID = '{$rows2['ctt_NoOfRunsID']}') 
						AND (tml_NoOfRunsdate = '{$rows2['ctt_NoOfRunsdate']}')";
			$resultselet3 = $class_mysql_default->my_query("$strsqlselet3");
			$rows3 = mysqli_fetch_array($resultselet3);			
	?>
		<tr align="center" bgcolor="#CCCCCC">
			<td nowrap="nowrap"><?=$rows2['ctt_NoOfRunsID']?></td>
			<td nowrap="nowrap"><?=$rows2['ctt_TicketID']?></td>
			<td nowrap="nowrap"><?=$rows2['ctt_ReachStation']?></td>
			<td nowrap="nowrap"><?=$rows2['ctt_SellPrice']?></td>
			<td nowrap="nowrap"><?=$rows2['ctt_SellPriceType']?></td>
			<td nowrap="nowrap"><?($rows3['tml_Allticket'] == "1")? print "XX" : print $rows2['ctt_SeatID'];?></td>
			<td nowrap="nowrap"><?=$rows2['st_Station']?></td>
			<td nowrap="nowrap"><?=$rows2['ctt_CheckDate']."  ".$rows2['ctt_CheckTime']?></td>
			<td nowrap="nowrap"><?=$userID?></td>
			<td align="center" nowrap="nowrap">[<a href="tms_v1_checkin_checkticket.php?nrID=<?=$rows2['ctt_NoOfRunsID']?>&nrDate=<?=$rows2['ctt_NoOfRunsdate']?>&tID=<?=$rows2['ctt_TicketID']?>&sID=<?=$rows2['ctt_SeatID']?>&allTkt=<?=$rows['ct_Allticket']?>&busID=<?=$rows2['ctt_BusID']?>&op=cancelcheck">退检</a>]</td>
		</tr>
	<?
		}
	?>
	</tbody>
	</table>
</div>
<div id="checked" <?php echo $checked;?>>
	<table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableboder">
	<tr>
		<td colspan="13" bgcolor="#FFFFFF" style="font-size:11pt;font-family:黑体;"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 已检班次：</td>
	</tr>
	</table>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder" id="table4">
	<thead>
		<tr bgcolor="#006699">
			<th nowrap="nowrap" align="center">班次</th>
			<th nowrap="nowrap" align="center">线路</th>
			<th nowrap="nowrap" align="center">日期</th>
			<th nowrap="nowrap" align="center">时间</th>
			<th nowrap="nowrap" align="center">车辆编号</th>
			<th nowrap="nowrap" align="center">车牌号</th>
			<th nowrap="nowrap" align="center">终点站</th>
			<th nowrap="nowrap" align="center">座位数</th>
			<th nowrap="nowrap" align="center">已售票数</th>
			<th nowrap="nowrap" align="center">已检票数</th>
			<th nowrap="nowrap" align="center">是否通票</th>
			<th nowrap="nowrap" align="center">检票口</th>
<!--			<th nowrap="nowrap" align="center">状态</th>-->
<!--			<th nowrap="nowrap" align="center">操作</th>	-->
		</tr>
	</thead>
	<tbody>
	<?
		$queryString = "SELECT `ct_NoOfRunsID`, `ct_LineID`, `ct_NoOfRunsdate`, `ct_NoOfRunsTime`, `ct_BusID`, `ct_BusNumber`, `ct_EndStation`, 
				`ct_TotalSeats`, `ct_SoldTicketNum`, `ct_CheckedTicketNum`, `ct_Allticket`, `ct_CheckTicketWindow`, `ct_UserID`, `ct_User`, tml_TotalSeats, tml_LeaveSeats,
				`ct_Flag`, `li_LineName` 
				 FROM tms_chk_CheckTemp 
				LEFT OUTER JOIN tms_bd_TicketMode ON ct_NoOfRunsID=tml_NoOfRunsID AND ct_NoOfRunsdate=tml_NoOfRunsdate
				LEFT OUTER JOIN tms_bd_LineInfo ON ct_LineID = li_LineID 
				LEFT OUTER JOIN tms_sch_Report ON rt_NoOfRunsID=ct_NoOfRunsID AND rt_NoOfRunsdate=ct_NoOfRunsdate AND rt_BusID=ct_BusID AND rt_ReportDateTime=ct_ReportDateTime  
				WHERE (ct_Flag = '2' || ct_Flag = '3') AND ct_CheckTicketWindow = '$checkWindow' AND ct_NoOfRunsdate = '$nowdate' AND  rt_AttemperStationID='{$userStationID}'
				ORDER BY STR_TO_DATE(ct_NoOfRunsTime,'%H:%i') ASC";
		$result = $class_mysql_default->my_query("$queryString");
	    while($rows = @mysqli_fetch_array($result)) {
	?>
		<tr align="center" bgcolor="#CCCCCC">
			<td nowrap="nowrap"><?=$rows['ct_NoOfRunsID']?></td>
			<td nowrap="nowrap"><?=$rows['li_LineName']?></td>
			<td nowrap="nowrap"><?=$rows['ct_NoOfRunsdate']?></td>
			<td nowrap="nowrap"><?=$rows['ct_NoOfRunsTime']?></td>
			<td nowrap="nowrap"><?=$rows['ct_BusID']?></td>
			<td nowrap="nowrap"><?=$rows['ct_BusNumber']?></td>
			<td nowrap="nowrap"><?=$rows['ct_EndStation']?></td>
			<td nowrap="nowrap"><?=$rows['ct_TotalSeats']?></td>
			<!-- 
			<td nowrap="nowrap"><?=$rows['ct_SoldTicketNum']?></td>
			-->
			<td nowrap="nowrap" rowspan="<?php print $row['num']?>"><?=$rows['tml_TotalSeats']-$rows['tml_LeaveSeats']?></td>
			<td nowrap="nowrap"><?=$rows['ct_CheckedTicketNum']?></td>
			<td nowrap="nowrap"><?($rows['ct_Allticket'] == "1")? print "是" : print "否";?></td>
			<td nowrap="nowrap"><?=$rows['ct_CheckTicketWindow']?></td><!--
<!--			<td><?($rows['ct_Flag'] == "2")? print "已发班" : print "已打单";?></td>-->
<!--			<td>-->
<!--			   	[<a href="tms_v1_checkin_checkticket.php?nrID=<?=$rows['ct_NoOfRunsID']?>&nrDate=<?=$rows['ct_NoOfRunsdate']?>&bID=<?=$rows['ct_BusID']?>&op=delbus">删除</a>]-->
<!--			</td>-->
		</tr>
	<?php 
	    }
	?>
	</tbody>
	</table>
</div>
<br />
<div id="printed" <?php echo $printed;?>>
	<table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableboder">
	<tr>
		<td colspan="13" bgcolor="#FFFFFF" style="font-size:11pt;font-family:黑体;"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 已打结算单班次：</td>
	</tr>
	</table>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder" id="table5">
	<thead>
		<tr bgcolor="#006699">
			<th nowrap="nowrap" align="center">班次</th>
			<th nowrap="nowrap" align="center">线路</th>
			<th nowrap="nowrap" align="center">日期</th>
			<th nowrap="nowrap" align="center">时间</th>
			<th nowrap="nowrap" align="center">车辆编号</th>
			<th nowrap="nowrap" align="center">车牌号</th>
			<th nowrap="nowrap" align="center">终点站</th>
			<th nowrap="nowrap" align="center">座位数</th>
			<th nowrap="nowrap" align="center">已售票数</th>
			<th nowrap="nowrap" align="center">已检票数</th>
			<th nowrap="nowrap" align="center">是否通票</th>
			<th nowrap="nowrap" align="center">检票口</th>
		<!-- <th nowrap="nowrap" align="center">操作</th> -->
		</tr>
	</thead>
	<tbody>
	<?
		$queryString = "SELECT `ct_NoOfRunsID`, `ct_LineID`, `ct_NoOfRunsdate`, `ct_NoOfRunsTime`, `ct_BusID`, `ct_BusNumber`, `ct_EndStation`, 
				`ct_TotalSeats`, `ct_SoldTicketNum`, `ct_CheckedTicketNum`, `ct_Allticket`, `ct_CheckTicketWindow`, `ct_UserID`, `ct_User`, tml_TotalSeats, tml_LeaveSeats,
				`ct_Flag`, `li_LineName` FROM tms_chk_CheckTemp 
				LEFT OUTER JOIN tms_bd_TicketMode ON ct_NoOfRunsID=tml_NoOfRunsID AND ct_NoOfRunsdate=tml_NoOfRunsdate
				LEFT OUTER JOIN tms_bd_LineInfo ON ct_LineID = li_LineID 				
				LEFT OUTER JOIN tms_sch_Report ON rt_NoOfRunsID=ct_NoOfRunsID AND rt_NoOfRunsdate=ct_NoOfRunsdate AND rt_BusID=ct_BusID AND rt_ReportDateTime=ct_ReportDateTime   
				WHERE ct_Flag = '3' AND ct_CheckTicketWindow = '$checkWindow' AND rt_AttemperStationID='{$userStationID}'
				ORDER BY STR_TO_DATE(ct_NoOfRunsTime,'%H:%i') ASC";
		$result = $class_mysql_default->my_query("$queryString");
	    while($rows = @mysqli_fetch_array($result)) {
	?>
		<tr align="center" bgcolor="#CCCCCC">
			<td nowrap="nowrap"><?=$rows['ct_NoOfRunsID']?></td>
			<td nowrap="nowrap"><?=$rows['li_LineName']?></td>
			<td nowrap="nowrap"><?=$rows['ct_NoOfRunsdate']?></td>
			<td nowrap="nowrap"><?=$rows['ct_NoOfRunsTime']?></td>
			<td nowrap="nowrap"><?=$rows['ct_BusID']?></td>
			<td nowrap="nowrap"><?=$rows['ct_BusNumber']?></td>
			<td nowrap="nowrap"><?=$rows['ct_EndStation']?></td>
			<td nowrap="nowrap"><?=$rows['ct_TotalSeats']?></td>
			<!-- 
			<td nowrap="nowrap"><?=$rows['ct_SoldTicketNum']?></td>
			 -->
			<td nowrap="nowrap"><?=$rows['tml_TotalSeats']-$rows['tml_LeaveSeats']?></td>
			<td nowrap="nowrap"><?=$rows['ct_CheckedTicketNum']?></td>
			<td nowrap="nowrap"><?($rows['ct_Allticket'] == "1")? print "是" : print "否";?></td>
			<td nowrap="nowrap"><?=$rows['ct_CheckTicketWindow']?></td>
		</tr>
	<?php 
	    }
	?>
	</tbody>
	<tr>
		<td><input name="checkwindow1" id="checkwindow1" value="<?php echo $row4['ct_CheckTicketWindow']?>" type="hidden"></input> </td>
	</tr>
	</table>
</div>
</body>
</html>
