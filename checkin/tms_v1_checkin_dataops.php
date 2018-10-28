<?
//检票操作界面

//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
if($userStationName  == '全部车站'){
	   $userStationName == '';
	}
$op = $_REQUEST['op'];
switch ($op)
{
	case "REFRESH":
		$checkWindow = $_REQUEST['checkWindow'];
		$checkboxStatus = $_REQUEST['checkboxStatus'];
		$configFileName = $_REQUEST['configFileName'];
		
		$fp = fopen($configFileName, 'w');
		if(!$fp) {
			fclose($fp);
			$retData = array('retVal' => 'FAIL', 'retString' => '打开文件失败！');
			echo json_encode($retData);
			exit();
		}
		$retVal = fwrite($fp, "<?\r\n\$checkWindow='$checkWindow';\r\n");
		$retVal = fwrite($fp, "\$checkboxStatus='$checkboxStatus';\r\n?>");
		if(!$retVal) {
			fclose($fp);
			$retData = array('retVal' => 'FAIL', 'retString' => '写入数据失败！');
			echo json_encode($retData);
			exit();
		}
		fclose($fp);
		$retData = array('retVal' => 'SUCC', 'retString' => '写入数据成功！');
		echo json_encode($retData);
		break;
	case "CONFIRMCHECK":
		$ticketID = $_REQUEST['ticketID'];
		$checkWindow = $_REQUEST['checkWindow'];
		$nowdate = date('Y-m-d');
		$nowtime = date('H:i:s');
		$queryString = "SELECT ct_ReportDateTime,ct_NoOfRunsID, ct_NoOfRunsdate, ct_BusID, ct_BusNumber, ct_CheckTicketWindow, ct_Allticket, ct_TotalSeats, 
				ct_SoldTicketNum, ct_CheckedTicketNum FROM tms_chk_CheckTemp WHERE ct_CheckTicketWindow = '$checkWindow' AND ct_Flag='1'";
	  	$result = $class_mysql_default->my_query("$queryString");
	  	if(mysqli_num_rows($result) == 0) {
			$retData = array('retVal' => 'FAIL', 'retString' => '没有在检班次！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		//判断是否已签或已退
		$selectReturn="SELECT rtk_TicketID,rtk_IsBalance FROM tms_sell_ReturnTicket WHERE rtk_TicketID='{$ticketID}'";
		$queryReturn=$class_mysql_default->my_query("$selectReturn");
		if(!$queryReturn){
			$retData = array('retVal' => 'FAIL', 'retString' => '查询退票数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		if(mysqli_num_rows($queryReturn) == 1){
			$rowReturn=mysqli_fetch_array($queryReturn);
			if($rowReturn['rtk_IsBalance']=='0'){
				$retData = array('retVal' => 'FAIL', 'retString' => '此票已签，不能再检！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}else{
				$retData = array('retVal' => 'FAIL', 'retString' => '此票已退，不能再检！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
		}
		//判断是否废票
		$selecterror="SELECT et_TicketID FROM tms_sell_ErrTicket WHERE et_TicketID='{$ticketID}'";
		$queryerror=$class_mysql_default->my_query("$selecterror");
		if(!$queryerror){
			$retData = array('retVal' => 'FAIL', 'retString' => '查询废票数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		if(mysqli_num_rows($queryerror) == 1){
			$retData = array('retVal' => 'FAIL', 'retString' => '此票已废，不能再检！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		// 查找票号所在班次
		$found = "";
		while($rows = mysqli_fetch_array($result)) {
			$NoOfRunsID = $rows['ct_NoOfRunsID'];
			$NoOfRunsdate = $rows['ct_NoOfRunsdate'];
			$busID=$rows['ct_BusID'];
			$thisnoofruns=0;//0并班情况，1本班次
			$queryString = "SELECT `st_TicketID`,`st_FromStationID` FROM tms_sell_SellTicket WHERE (st_NoOfRunsID = '$NoOfRunsID') AND 
						(st_NoOfRunsdate = '$NoOfRunsdate') AND (st_TicketID = '$ticketID')";
			$result1 = $class_mysql_default->my_query("$queryString");
			if(mysqli_num_rows($result1) == 1) {
				$rowsell=mysqli_fetch_array($result1);
				if($rowsell['st_FromStationID']!=$userStationID && $userStationID!='all'){
					$retData = array('retVal' => 'FAIL', 'retString' => '此票不在本站上车！请检查。', 'found' => $found, 'sql' => $queryString);
					echo json_encode($retData);
					exit();
				}else{
					$found = "found";
					$thisnoofruns=1;
					break;
				}
			}else{ //如果班次被并
				$querysellticket = "SELECT `st_TicketID`,`st_FromStationID`  FROM tms_sell_SellTicket LEFT OUTER JOIN tms_sch_AndNoOfRuns ON 
						anr_NoOfRunsID=st_NoOfRunsID AND anr_NoOfRunsdate=st_NoOfRunsdate WHERE (anr_AndNoOfRunsID = '$NoOfRunsID') AND 
						(anr_AndNoOfRunsdate = '$NoOfRunsdate') AND (st_TicketID = '$ticketID')";
				$resultsellticket = $class_mysql_default->my_query("$querysellticket");
				if(mysqli_num_rows($resultsellticket) == 1) {
					$rowsellticket=mysqli_fetch_array($resultsellticket);
					if($rowsellticket['st_FromStationID']!=$userStationID  && $userStationID!='all'){
						$retData = array('retVal' => 'FAIL', 'retString' => '此票不在本站上车！请检查。', 'found' => $found, 'sql' => $queryString);
						echo json_encode($retData);
						exit();
					}else{
						$found = "found";
						$thisnoofruns=0;
						break;
					}
				}
			}
		}
		if($found == "") {
			$retData = array('retVal' => 'FAIL', 'retString' => '此票对应班次不对！请检查。', 'found' => $found, 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
			
		if($rows['ct_Allticket'] == "1" && $rows['ct_CheckedTicketNum'] == $rows['ct_TotalSeats']) {
			$retData = array('retVal' => 'FAIL', 'retString' => '检票数'.$rows['ct_CheckedTicketNum'].'已达车辆座位数！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		
		//验证是否已检票并发车
		$queryString = "SELECT `ct_TicketID` FROM tms_chk_CheckTicket WHERE (ct_NoOfRunsID = '$NoOfRunsID') AND 
				(ct_NoOfRunsdate = '$NoOfRunsdate') AND (ct_TicketID = '$ticketID')";
		$result = $class_mysql_default->my_query("$queryString");
		if(mysqli_num_rows($result) == 1) {
			$retData = array('retVal' => 'FAIL', 'retString' => '此票已检票并发车！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		
		// 取得即时结算价和服务费（因为车辆在调度和检票时可能会发生改变）：首先读取售票表数据；再检查班次调价表和服务费调价表（按协议调价、
		// 班次调价、线路调价的优先级顺序），如有记录，则更新从售票表取得的数据；如无，则取售票表中的数据。
		// 如果没有输入结算价，则用售票价减去站务费做为结算价
		$queryString = "SELECT `st_NoOfRunsID`, `st_LineID`, `st_NoOfRunsdate`, `st_FromStationID`, `st_FromStation`, `st_ReachStationID`, 
			`st_ReachStation`, `st_SellPrice`, `st_BalancePrice`, `st_ServiceFee`, `bi_BusTypeID`, `bi_BusType`, `bi_BusUnit` 
			FROM tms_sell_SellTicket, tms_bd_BusInfo WHERE st_TicketID = '$ticketID' AND bi_BusID = '{$rows['ct_BusID']}'";
		$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			$retData = array('retVal' => 'FAIL', 'retString' => '读取售票和车辆信息失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$rows2 = mysqli_fetch_array($result);
		$SellPrice = $rows2['st_SellPrice'];
	//	$BalancePrice = $rows2['st_BalancePrice'];
	//	$BalancePrice=0;  //这里先赋值为0？
		$ServiceFee = $rows2['st_ServiceFee'];
		
		//检查报班车辆是否与票版中车辆一致
		$selectmodel="SELECT tml_BusModelID,tml_BusUnit FROM tms_bd_TicketMode WHERE tml_NoOfRunsID='{$NoOfRunsID}' AND tml_NoOfRunsdate='{$NoOfRunsdate}'";
		$querymode=$class_mysql_default->my_query("$selectmodel");
		$rowmode= mysqli_fetch_array($querymode);
		if($rowmode['tml_BusModelID']==$rows2['bi_BusTypeID'] && $rowmode['tml_BusUnit']==$rows2['bi_BusUnit']){
			$BalancePrice = $rows2['st_BalancePrice'];
		}else{
			$BalancePrice=0;
		/*	$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['st_FromStationID']}' 
					AND	nrap_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= nrap_BeginDate 
					AND '{$rows2['st_NoOfRunsdate']}' <= nrap_EndDate AND nrap_NoRunsAdjust = '{$rows2['st_NoOfRunsID']}' 
					AND	nrap_ISNoRunsAdjust = 0 AND nrap_ISLineAdjust = 0 AND nrap_ModelID = '{$rows2['bi_BusTypeID']}' 
					AND nrap_Unit = '{$rows2['bi_BusUnit']}'"; */
			$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['st_FromStationID']}' 
					AND	nrap_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= nrap_BeginDate 
					AND '{$rows2['st_NoOfRunsdate']}' <= nrap_EndDate AND nrap_NoRunsAdjust = '{$NoOfRunsID}' 
					AND	nrap_ISNoRunsAdjust = 0 AND nrap_ISLineAdjust = 0 AND nrap_ModelID = '{$rows2['bi_BusTypeID']}' 
					AND nrap_Unit = '{$rows2['bi_BusUnit']}' AND DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),
					STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))=(SELECT MIN(DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))) 
					FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rows2['st_FromStationID']}' AND nrap_GetToSiteID='{$rows2['st_ReachStationID']}' 
					AND nrap_BeginDate<='{$rows2['st_NoOfRunsdate']}' AND nrap_EndDate>='{$rows2['st_NoOfRunsdate']}' AND nrap_NoRunsAdjust='{$NoOfRunsID}' 
					AND nrap_ISUnitAdjust=1 AND nrap_ModelID='{$rows2['bi_BusTypeID']}' AND nrap_Unit='{$rows2['bi_BusUnit']}' GROUP BY 
					nrap_DepartureSiteID,nrap_GetToSiteID,nrap_NoRunsAdjust,nrap_ModelID,nrap_Unit,nrap_ISUnitAdjust)";
			$result = $class_mysql_default->my_query("$queryString");
			if(mysqli_num_rows($result) == 1) {
				$rows3 = mysqli_fetch_array($result);
				$BalancePrice = $rows3['nrap_BalancePrice'];
			}
			else {
			/*	$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['st_FromStationID']}' 
						AND	nrap_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= nrap_BeginDate 
						AND '{$rows2['st_NoOfRunsdate']}' <= nrap_EndDate AND nrap_NoRunsAdjust = '{$rows2['st_NoOfRunsID']}' 
						AND	nrap_ISNoRunsAdjust = 1 AND nrap_ISLineAdjust = 0 AND nrap_ModelID = '{$rows2['bi_BusTypeID']}'"; */
				$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['st_FromStationID']}' 
						AND	nrap_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= nrap_BeginDate 
						AND '{$rows2['st_NoOfRunsdate']}' <= nrap_EndDate AND nrap_NoRunsAdjust = '{$NoOfRunsID}' 
						AND	nrap_ISNoRunsAdjust = 1 AND nrap_ISLineAdjust = 0 AND nrap_ModelID = '{$rows2['bi_BusTypeID']}' AND 
						DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))=(SELECT 
						MIN(DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))) FROM 
						tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rows2['st_FromStationID']}' AND nrap_GetToSiteID='{$rows2['st_ReachStationID']}' 
						AND nrap_BeginDate<='{$rows2['st_NoOfRunsdate']}' AND nrap_EndDate>='{$rows2['st_NoOfRunsdate']}' AND nrap_NoRunsAdjust='{$NoOfRunsID}' 
						AND nrap_ISNoRunsAdjust=1 AND nrap_ModelID='{$rows2['bi_BusTypeID']}' 
						GROUP BY nrap_DepartureSiteID,nrap_GetToSiteID,nrap_NoRunsAdjust,nrap_ModelID,nrap_ISNoRunsAdjust)";
				$result = $class_mysql_default->my_query("$queryString");
				if(mysqli_num_rows($result) == 1) {
					$rows3 = mysqli_fetch_array($result);
					$BalancePrice = $rows3['nrap_BalancePrice'];
				}
				else {
				/*	$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['st_FromStationID']}' 
							AND	nrap_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= nrap_BeginDate 
							AND '{$rows2['st_NoOfRunsdate']}' <= nrap_EndDate AND nrap_LineAdjust = '{$rows2['st_LineID']}' 
							AND nrap_ISNoRunsAdjust = 0 AND nrap_ISLineAdjust = 1 AND nrap_ModelID = '{$rows2['bi_BusTypeID']}'"; */
					$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['st_FromStationID']}' 
							AND	nrap_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= nrap_BeginDate 
							AND '{$rows2['st_NoOfRunsdate']}' <= nrap_EndDate AND nrap_LineAdjust = '{$rows2['st_LineID']}' 
							AND nrap_ISNoRunsAdjust = 0 AND nrap_ISLineAdjust = 1 AND nrap_ModelID = '{$rows2['bi_BusTypeID']}' AND 
							DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))=(SELECT 
							MIN(DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))) 
							FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rows2['st_FromStationID']}' AND nrap_GetToSiteID='{$rows2['st_ReachStationID']}' 
							AND nrap_BeginDate<='{$rows2['st_NoOfRunsdate']}' AND nrap_EndDate>='{$rows2['st_NoOfRunsdate']}' AND nrap_LineAdjust='{$rows2['st_LineID']}' 
							AND nrap_ISLineAdjust=1 AND nrap_ModelID='{$rows2['bi_BusTypeID']}' 
							GROUP BY nrap_DepartureSiteID,nrap_GetToSiteID,nrap_NoRunsAdjust,nrap_ModelID,nrap_ISLineAdjust)"; 
					$result = $class_mysql_default->my_query("$queryString");
					if(mysqli_num_rows($result) == 1) {
						$rows3 = mysqli_fetch_array($result);
						$BalancePrice = $rows3['nrap_BalancePrice'];
					}
				}
			}
		}

	/*	$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['st_FromStationID']}' 
				AND	sfa_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= sfa_BeginDate 
				AND '{$rows2['st_NoOfRunsdate']}' <= sfa_EndDate AND sfa_NoRunsAdjust = '{$rows2['st_NoOfRunsID']}' 
				AND	sfa_ISNoRunsAdjust = 0 AND sfa_ISLineAdjust = 0 AND sfa_ModelID = '{$rows2['bi_BusTypeID']}' 
				AND sfa_Unit = '{$rows2['bi_BusUnit']}'"; */
		$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['st_FromStationID']}' 
				AND	sfa_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= sfa_BeginDate 
				AND '{$rows2['st_NoOfRunsdate']}' <= sfa_EndDate AND sfa_NoRunsAdjust = '{$NoOfRunsID}' 
				AND	sfa_ISNoRunsAdjust = 0 AND sfa_ISLineAdjust = 0 AND sfa_ModelID = '{$rows2['bi_BusTypeID']}' 
				AND sfa_Unit = '{$rows2['bi_BusUnit']}' AND DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),
				STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))=(SELECT MIN(DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))) 
				FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID='{$rows2['st_FromStationID']}' AND sfa_GetToSiteID='{$rows2['st_ReachStationID']}' 
				AND sfa_BeginDate<='{$rows2['st_NoOfRunsdate']}' AND sfa_EndDate>='{$rows2['st_NoOfRunsdate']}' AND sfa_NoRunsAdjust='{$NoOfRunsID}' 
				AND sfa_ISUnitAdjust=1 AND sfa_ModelID='{$rows2['bi_BusTypeID']}' AND sfa_Unit='{$rows2['bi_BusUnit']}' GROUP BY 
				sfa_DepartureSiteID,sfa_GetToSiteID,sfa_NoRunsAdjust,sfa_ModelID,sfa_Unit,sfa_ISUnitAdjust)";
		$result = $class_mysql_default->my_query("$queryString");
		if(mysqli_num_rows($result) == 1) {
			$rows3 = mysqli_fetch_array($result);
			$ServiceFee = $rows3['sfa_RunPrice'];
		}
		else {
		/*	$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['st_FromStationID']}' 
					AND	sfa_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= sfa_BeginDate 
					AND '{$rows2['st_NoOfRunsdate']}' <= sfa_EndDate AND sfa_NoRunsAdjust = '{$rows2['st_NoOfRunsID']}' 
					AND	sfa_ISNoRunsAdjust = 1 AND sfa_ISLineAdjust = 0 AND sfa_ModelID = '{$rows2['bi_BusTypeID']}'"; */
			$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['st_FromStationID']}' 
					AND	sfa_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= sfa_BeginDate 
					AND '{$rows2['st_NoOfRunsdate']}' <= sfa_EndDate AND sfa_NoRunsAdjust = '{$NoOfRunsID}' 
					AND	sfa_ISNoRunsAdjust = 1 AND sfa_ISLineAdjust = 0 AND sfa_ModelID = '{$rows2['bi_BusTypeID']}' AND 
					DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))=(SELECT 
					MIN(DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))) FROM 
					tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID='{$rows2['st_FromStationID']}' AND sfa_GetToSiteID='{$rows2['st_ReachStationID']}' 
					AND sfa_BeginDate<='{$rows2['st_NoOfRunsdate']}' AND sfa_EndDate>='{$rows2['st_NoOfRunsdate']}' AND sfa_NoRunsAdjust='{$NoOfRunsID}' 
					AND sfa_ISNoRunsAdjust=1 AND sfa_ModelID='{$rows2['bi_BusTypeID']}' 
					GROUP BY sfa_DepartureSiteID,sfa_GetToSiteID,sfa_NoRunsAdjust,sfa_ModelID,sfa_ISNoRunsAdjust)";
			$result = $class_mysql_default->my_query("$queryString");
			if(mysqli_num_rows($result) == 1) {
				$rows3 = mysqli_fetch_array($result);
				$ServiceFee = $rows3['sfa_RunPrice'];
			}
			else {
			/*	$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['st_FromStationID']}' 
						AND	sfa_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= sfa_BeginDate 
						AND '{$rows2['st_NoOfRunsdate']}' <= sfa_EndDate AND sfa_LineAdjust = '{$rows2['st_LineID']}' 
						AND sfa_ISNoRunsAdjust = 0 AND sfa_ISLineAdjust = 1 AND sfa_ModelID = '{$rows2['bi_BusTypeID']}'"; */
				$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['st_FromStationID']}' 
						AND	sfa_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= sfa_BeginDate 
						AND '{$rows2['st_NoOfRunsdate']}' <= sfa_EndDate AND sfa_LineAdjust = '{$rows2['st_LineID']}' 
						AND sfa_ISNoRunsAdjust = 0 AND sfa_ISLineAdjust = 1 AND sfa_ModelID = '{$rows2['bi_BusTypeID']}' AND 
						DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))=(SELECT 
						MIN(DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))) 
						FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID='{$rows2['st_FromStationID']}' AND sfa_GetToSiteID='{$rows2['st_ReachStationID']}' 
						AND sfa_BeginDate<='{$rows2['st_NoOfRunsdate']}' AND sfa_EndDate>='{$rows2['st_NoOfRunsdate']}' AND sfa_LineAdjust='{$rows2['st_LineID']}' 
						AND sfa_ISLineAdjust=1 AND sfa_ModelID='{$rows2['bi_BusTypeID']}' 
						GROUP BY sfa_DepartureSiteID,sfa_GetToSiteID,sfa_NoRunsAdjust,sfa_ModelID,sfa_ISLineAdjust)";
				$result = $class_mysql_default->my_query("$queryString");
				if(mysqli_num_rows($result) == 1) {
					$rows3 = mysqli_fetch_array($result);
					$ServiceFee = $rows3['sfa_RunPrice'];
				}
			}
		}
		
		if($BalancePrice == 0 || $BalancePrice == NULL) {
			$BalancePrice = $SellPrice - $ServiceFee;
		}
		
		$class_mysql_default->my_query("BEGIN");
		
	/*	$queryString = "INSERT `tms_chk_CheckTicketTemp` (`ctt_TicketID`, `ctt_NoOfRunsID`, `ctt_LineID`, `ctt_NoOfRunsdate`, 
			`ctt_BeginStationTime`, `ctt_StopStationTime`, `ctt_Distance`, `ctt_BeginStationID`, `ctt_BeginStation`, `ctt_FromStationID`, 
			`ctt_FromStation`, `ctt_ReachStationID`, `ctt_ReachStation`, `ctt_EndStationID`, `ctt_EndStation`, `ctt_SellPrice`, 
			`ctt_SellPriceType`, `ctt_ColleSellPriceType`, `ctt_TotalMan`, `ctt_FullPrice`, `ctt_HalfPrice`, `ctt_StandardPrice`, 
			`ctt_BalancePrice`, `ctt_ServiceFee`, `ctt_otherFee1`, `ctt_otherFee2`, `ctt_otherFee3`, `ctt_otherFee4`, `ctt_otherFee5`, 
			`ctt_otherFee6`, `ctt_StationID`, `ctt_Station`, `ctt_SellDate`, `ctt_SellTime`, `ctt_BusModelID`, `ctt_BusModel`, 
			`ctt_BusID`,`ctt_BusNumber`, `ctt_SeatID`, `ctt_SellID`, `ctt_SellName`, `ctt_FreeSeats`, `ctt_SafetyTicketID`, 
			`ctt_SafetyTicketNumber`,`ctt_SafetyTicketMoney`, `ctt_SafetyTicketPassengerID`, `ctt_CheckTicketWindow`, `ctt_CheckerID`, 
			`ctt_Checker`, `ctt_CheckDate`,`ctt_CheckTime`) SELECT `st_TicketID`, `st_NoOfRunsID`, `st_LineID`, `st_NoOfRunsdate`, 
			`st_BeginStationTime`,`st_StopStationTime`, `st_Distance`, `st_BeginStationID`, `st_BeginStation`, `st_FromStationID`, 
			`st_FromStation`, `st_ReachStationID`, `st_ReachStation`, `st_EndStationID`, `st_EndStation`, `st_SellPrice`, 
			`st_SellPriceType`,`st_ColleSellPriceType`, `st_TotalMan`, `st_FullPrice`, `st_HalfPrice`, `st_StandardPrice`, 
			'$BalancePrice', '$ServiceFee', `st_otherFee1`, `st_otherFee2`, `st_otherFee3`,`st_otherFee4`, `st_otherFee5`, 
			`st_otherFee6`, '$userStationID','$userStationName', `st_SellDate`, `st_SellTime`, `st_BusModelID`, `st_BusModel`, 
			'{$rows['ct_BusID']}', '{$rows['ct_BusNumber']}', `st_SeatID`, `st_SellID`, `st_SellName`, `st_FreeSeats`, 
			`st_SafetyTicketID`, `st_SafetyTicketNumber`, `st_SafetyTicketMoney`, `st_SafetyTicketPassengerID`, 
			'$checkWindow', '$userID', '$userName', '$nowdate', '$nowtime' FROM tms_sell_SellTicket WHERE (st_TicketID = '$ticketID')"; */
		//ctt_AllCheck,0-不是全检，1-全检
		$queryString = "INSERT `tms_chk_CheckTicketTemp` (`ctt_TicketID`, `ctt_NoOfRunsID`, `ctt_LineID`, `ctt_NoOfRunsdate`, 
			`ctt_BeginStationTime`, `ctt_StopStationTime`, `ctt_Distance`, `ctt_BeginStationID`, `ctt_BeginStation`, `ctt_FromStationID`, 
			`ctt_FromStation`, `ctt_ReachStationID`, `ctt_ReachStation`, `ctt_EndStationID`, `ctt_EndStation`, `ctt_SellPrice`, 
			`ctt_SellPriceType`, `ctt_ColleSellPriceType`, `ctt_TotalMan`, `ctt_FullPrice`, `ctt_HalfPrice`, `ctt_StandardPrice`, 
			`ctt_BalancePrice`, `ctt_ServiceFee`, `ctt_otherFee1`, `ctt_otherFee2`, `ctt_otherFee3`, `ctt_otherFee4`, `ctt_otherFee5`, 
			`ctt_otherFee6`, `ctt_StationID`, `ctt_Station`, `ctt_SellDate`, `ctt_SellTime`, `ctt_BusModelID`, `ctt_BusModel`, 
			`ctt_BusID`,`ctt_BusNumber`, `ctt_SeatID`, `ctt_SellID`, `ctt_SellName`, `ctt_FreeSeats`, `ctt_SafetyTicketID`, 
			`ctt_SafetyTicketNumber`,`ctt_SafetyTicketMoney`, `ctt_SafetyTicketPassengerID`, `ctt_CheckTicketWindow`,`ctt_TicketState`,
			`ctt_AllCheck`,`ctt_CheckerID`, 
			`ctt_Checker`, `ctt_CheckDate`,`ctt_CheckTime`) SELECT `st_TicketID`, '$NoOfRunsID', `st_LineID`, '$NoOfRunsdate', 
			`st_BeginStationTime`,`st_StopStationTime`, `st_Distance`, `st_BeginStationID`, `st_BeginStation`, `st_FromStationID`, 
			`st_FromStation`, `st_ReachStationID`, `st_ReachStation`, `st_EndStationID`, `st_EndStation`, `st_SellPrice`, 
			`st_SellPriceType`,`st_ColleSellPriceType`, `st_TotalMan`, `st_FullPrice`, `st_HalfPrice`, `st_StandardPrice`, 
			'$BalancePrice', '$ServiceFee', `st_otherFee1`, `st_otherFee2`, `st_otherFee3`,`st_otherFee4`, `st_otherFee5`, 
			`st_otherFee6`, '$userStationID','$userStationName', `st_SellDate`, `st_SellTime`, `st_BusModelID`, `st_BusModel`, 
			'{$rows['ct_BusID']}', '{$rows['ct_BusNumber']}', `st_SeatID`, `st_SellID`, `st_SellName`, `st_FreeSeats`, 
			`st_SafetyTicketID`, `st_SafetyTicketNumber`, `st_SafetyTicketMoney`, `st_SafetyTicketPassengerID`, 
			'$checkWindow',`st_TicketState`,'0','$userID', '$userName', '$nowdate', '$nowtime' FROM tms_sell_SellTicket 
			WHERE (st_TicketID = '$ticketID')";
		$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '检票数据添加失败！'.$class_mysql_default->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		
		if($rows['ct_Allticket'] == "1") {
			$queryString = "UPDATE tms_chk_CheckTemp SET ct_CheckedTicketNum = ct_CheckedTicketNum + 1 
						WHERE ct_NoOfRunsID = '$NoOfRunsID'	AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '{$rows['ct_BusID']}' 
						AND ct_ReportDateTime='{$rows['ct_ReportDateTime']}'";
			$result = $class_mysql_default->my_query("$queryString");
		  	if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '检票数据更新失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
			else {
				$class_mysql_default->my_query("COMMIT");
				$retData = array('retVal' => 'SUCC', 'retString' => '检票成功！', 'NoOfRunsID' => $NoOfRunsID);
			}
		}
		else {
			$queryString = "SELECT ctt_SeatID FROM tms_chk_CheckTicketTemp WHERE (ctt_TicketID = '$ticketID') 
						AND (ctt_NoOfRunsID = '$NoOfRunsID') AND (ctt_NoOfRunsdate = '$NoOfRunsdate')";
	  		$result = $class_mysql_default->my_query("$queryString");
	  		if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '读取座位号数据失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			} 				
			$rows = mysqli_fetch_array($result);
			$seatNo = $rows['ctt_SeatID'];
			$queryString = "UPDATE tms_chk_CheckTemp SET ct_CheckedTicketNum = ct_CheckedTicketNum + 1 WHERE ct_NoOfRunsID = '$NoOfRunsID'	
							AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID='{$busID}' AND 
							ct_ReportDateTime=(SELECT rt_ReportDateTime FROM tms_sch_Report WHERE rt_NoOfRunsID='{$NoOfRunsID}' AND 
							rt_NoOfRunsdate='{$NoOfRunsdate}' AND rt_BusID='{$busID}' AND rt_AttemperStationID='{$userStationID}' 
							ORDER BY rt_ReportDateTime DESC LIMIT 1)";
			$result = $class_mysql_default->my_query("$queryString");
		  	if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '检票数据更新失败！', 'sql' => $queryString);
			}
			else {
				$queryString = "SELECT tml_SeatStatus FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$NoOfRunsID') 
							AND (tml_NoOfRunsdate = '$NoOfRunsdate') FOR UPDATE";
		  		$result = $class_mysql_default->my_query("$queryString");
				if(!$result) {
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '锁定票版数据表失败！', 'sql' => $queryString);
				}
				else {
					$rows = mysqli_fetch_array($result);
					$seatStatus = $rows['tml_SeatStatus'];
					if($thisnoofruns==1){
						$seatStatus = substr_replace($seatStatus, '4', $seatNo - 1, 1);
					}else{
						$seatI=stripos($seatStatus, '7')+1;
						$seatStatus = substr_replace($seatStatus, '4', stripos($seatStatus, '7'), 1);
						$updatechecktemp="UPDATE tms_chk_CheckTicketTemp SET ctt_SeatID='{$seatI}' WHERE ctt_TicketID='$ticketID'";
						$querychecktemp=$class_mysql_default->my_query("$updatechecktemp");
						if(!$querychecktemp){
							$class_mysql_default->my_query("ROLLBACK");
							$retData = array('retVal' => 'FAIL', 'retString' => '更新临时检票数据表失败！', 'sql' => $queryString);
						}
					}
				  	$queryString = "UPDATE tms_bd_TicketMode SET tml_SeatStatus = '$seatStatus' WHERE (tml_NoOfRunsID = '$NoOfRunsID') 
				  			AND (tml_NoOfRunsdate = '$NoOfRunsdate')";	  	
				  	$result = $class_mysql_default->my_query("$queryString");
					if(!$result) {
						$class_mysql_default->my_query("ROLLBACK");
						$retData = array('retVal' => 'FAIL', 'retString' => '更新票版数据表失败！', 'sql' => $queryString);
					}
					else {
						$class_mysql_default->my_query("COMMIT");
						$retData = array('retVal' => 'SUCC', 'retString' => '检票成功！', 'NoOfRunsID' => $NoOfRunsID);
					}
				}
			}
		}
		echo json_encode($retData);
		break;
	case "CONFIRMCHECKALL":
		$checkWindow = $_REQUEST['checkWindow'];
		$nowdate = date('Y-m-d');
		$nowtime = date('H:i:s');
		$SeatIDstr='';
		$count=0;
		$queryString = "SELECT ct_NoOfRunsID, ct_NoOfRunsdate, ct_BusID, ct_BusNumber, ct_CheckTicketWindow, ct_Allticket, ct_TotalSeats, 
				ct_SoldTicketNum, ct_CheckedTicketNum FROM tms_chk_CheckTemp 
				LEFT OUTER JOIN tms_sys_UsInfor ON ui_UserID=ct_UserID
				WHERE ct_CheckTicketWindow = '$checkWindow' AND ct_Flag='1' AND ct_NoOfRunsdate = '$nowdate' AND ui_UserSationID='{$userStationID}'";
	  	$result = $class_mysql_default->my_query("$queryString");
	  	if(mysqli_num_rows($result) == 0) {
			$retData = array('retVal' => 'FAIL', 'retString' => '没有在检班次！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
	  	}
	  	if(mysqli_num_rows($result) > 1) {
			$retData = array('retVal' => 'FAIL', 'retString' => '有多个在检班次，不能全检！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
	  	}
	  	
	  	$rows = mysqli_fetch_array($result);
		$NoOfRunsID = $rows['ct_NoOfRunsID'];
		$NoOfRunsdate = $rows['ct_NoOfRunsdate'];
		$BusID=$rows['ct_BusID'];
		
		if($rows['ct_Allticket'] == "1") {
			//目前不允许通票班次全检
			$retData = array('retVal' => 'FAIL', 'retString' => '通票班次不能全检！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
			
			$queryString = "SELECT SUM(ct_CheckedTicketNum) AS hasCheckedTicketNum FROM tms_chk_CheckTemp WHERE 
						ct_NoOfRunsID = '$NoOfRunsID' AND ct_NoOfRunsdate='$NoOfRunsdate' AND ct_Flag='2'";
	  		$result = $class_mysql_default->my_query("$queryString");
	  		$rows2 = mysqli_fetch_array($result);
	  		$waitingCheckTicketNum = $rows['ct_SoldTicketNum'] - $rows2['hasCheckedTicketNum'];
	  		if($waitingCheckTicketNum > $rows['ct_TotalSeats']) {
		  		$retData = array('retVal' => 'FAIL', 'retString' => '待检票数'.$waitingCheckTicketNum.'超过车辆座位数！不能全检。', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
	  		}
		}
	  	
		$class_mysql_default->my_query("BEGIN");
		
		if($rows['ct_Allticket'] == "1") 
			$queryString = "INSERT IGNORE `tms_chk_CheckTicketTemp` (`ctt_TicketID`, `ctt_NoOfRunsID`, `ctt_LineID`, `ctt_NoOfRunsdate`, 
				`ctt_BeginStationTime`, `ctt_StopStationTime`, `ctt_Distance`, `ctt_BeginStationID`, `ctt_BeginStation`, `ctt_FromStationID`, 
				`ctt_FromStation`, `ctt_ReachStationID`, `ctt_ReachStation`, `ctt_EndStationID`, `ctt_EndStation`, `ctt_SellPrice`, 
				`ctt_SellPriceType`, `ctt_ColleSellPriceType`, `ctt_TotalMan`, `ctt_FullPrice`, `ctt_HalfPrice`, `ctt_StandardPrice`, 
				`ctt_BalancePrice`, `ctt_ServiceFee`, `ctt_otherFee1`, `ctt_otherFee2`, `ctt_otherFee3`, `ctt_otherFee4`, `ctt_otherFee5`, 
				`ctt_otherFee6`, `ctt_StationID`, `ctt_Station`, `ctt_SellDate`, `ctt_SellTime`, `ctt_BusModelID`, `ctt_BusModel`, 
				`ctt_BusID`,`ctt_BusNumber`, `ctt_SeatID`, `ctt_SellID`, `ctt_SellName`, `ctt_FreeSeats`, `ctt_SafetyTicketID`, 
				`ctt_SafetyTicketNumber`,`ctt_SafetyTicketMoney`, `ctt_SafetyTicketPassengerID`, `ctt_CheckTicketWindow`, `ctt_CheckerID`, 
				`ctt_Checker`, `ctt_CheckDate`,`ctt_CheckTime`) SELECT `st_TicketID`, `st_NoOfRunsID`, `st_LineID`, `st_NoOfRunsdate`, 
				`st_BeginStationTime`,`st_StopStationTime`, `st_Distance`, `st_BeginStationID`, `st_BeginStation`, `st_FromStationID`, 
				`st_FromStation`, `st_ReachStationID`, `st_ReachStation`, `st_EndStationID`, `st_EndStation`, `st_SellPrice`, 
				`st_SellPriceType`,`st_ColleSellPriceType`, `st_TotalMan`, `st_FullPrice`, `st_HalfPrice`, `st_StandardPrice`, 
				`st_BalancePrice`, `st_ServiceFee`, `st_otherFee1`, `st_otherFee2`, `st_otherFee3`,`st_otherFee4`, `st_otherFee5`, 
				`st_otherFee6`, '$userStationID','$userStationName', `st_SellDate`, `st_SellTime`, `st_BusModelID`, `st_BusModel`, 
				'{$rows['ct_BusID']}', '{$rows['ct_BusNumber']}', `st_SeatID`, `st_SellID`, `st_SellName`, `st_FreeSeats`, 
				`st_SafetyTicketID`, `st_SafetyTicketNumber`, `st_SafetyTicketMoney`, `st_SafetyTicketPassengerID`, 
				'$checkWindow', '$userID', '$userName', '$nowdate', '$nowtime' FROM tms_sell_SellTicket 
				WHERE (st_NoOfRunsID = '$NoOfRunsID') AND (st_NoOfRunsdate = '$NoOfRunsdate') AND st_FromStationID='{$userStationID}' AND (st_TicketState = '0')";
		else
			//ctt_AllCheck,0-不是全检，1-全检
			$queryString = "INSERT IGNORE `tms_chk_CheckTicketTemp` (`ctt_TicketID`, `ctt_NoOfRunsID`, `ctt_LineID`, `ctt_NoOfRunsdate`, 
				`ctt_BeginStationTime`, `ctt_StopStationTime`, `ctt_Distance`, `ctt_BeginStationID`, `ctt_BeginStation`, `ctt_FromStationID`, 
				`ctt_FromStation`, `ctt_ReachStationID`, `ctt_ReachStation`, `ctt_EndStationID`, `ctt_EndStation`, `ctt_SellPrice`, 
				`ctt_SellPriceType`, `ctt_ColleSellPriceType`, `ctt_TotalMan`, `ctt_FullPrice`, `ctt_HalfPrice`, `ctt_StandardPrice`, 
				`ctt_BalancePrice`, `ctt_ServiceFee`, `ctt_otherFee1`, `ctt_otherFee2`, `ctt_otherFee3`, `ctt_otherFee4`, `ctt_otherFee5`, 
				`ctt_otherFee6`, `ctt_StationID`, `ctt_Station`, `ctt_SellDate`, `ctt_SellTime`, `ctt_BusModelID`, `ctt_BusModel`, 
				`ctt_BusID`,`ctt_BusNumber`, `ctt_SeatID`, `ctt_SellID`, `ctt_SellName`, `ctt_FreeSeats`, `ctt_SafetyTicketID`, 
				`ctt_SafetyTicketNumber`,`ctt_SafetyTicketMoney`, `ctt_SafetyTicketPassengerID`, `ctt_CheckTicketWindow`,`ctt_TicketState`,
				`ctt_AllCheck`,`ctt_CheckerID`, 
				`ctt_Checker`, `ctt_CheckDate`,`ctt_CheckTime`) SELECT `st_TicketID`, `st_NoOfRunsID`, `st_LineID`, `st_NoOfRunsdate`, 
				`st_BeginStationTime`,`st_StopStationTime`, `st_Distance`, `st_BeginStationID`, `st_BeginStation`, `st_FromStationID`, 
				`st_FromStation`, `st_ReachStationID`, `st_ReachStation`, `st_EndStationID`, `st_EndStation`, `st_SellPrice`, 
				`st_SellPriceType`,`st_ColleSellPriceType`, `st_TotalMan`, `st_FullPrice`, `st_HalfPrice`, `st_StandardPrice`, 
				`st_BalancePrice`, `st_ServiceFee`, `st_otherFee1`, `st_otherFee2`, `st_otherFee3`,`st_otherFee4`, `st_otherFee5`, 
				`st_otherFee6`, '$userStationID','$userStationName', `st_SellDate`, `st_SellTime`, `st_BusModelID`, `st_BusModel`, 
				'{$rows['ct_BusID']}', '{$rows['ct_BusNumber']}', `st_SeatID`, `st_SellID`, `st_SellName`, `st_FreeSeats`, 
				`st_SafetyTicketID`, `st_SafetyTicketNumber`, `st_SafetyTicketMoney`, `st_SafetyTicketPassengerID`, 
				'$checkWindow',`st_TicketState`,'1','$userID', '$userName', '$nowdate', '$nowtime' FROM tms_sell_SellTicket 
				WHERE (st_NoOfRunsID = '$NoOfRunsID') AND (st_NoOfRunsdate = '$NoOfRunsdate') AND st_FromStationID='{$userStationID}'
				AND st_TicketID NOT IN (SELECT rtk_TicketID FROM tms_sell_ReturnTicket WHERE rtk_NoOfRunsID='$NoOfRunsID' AND 
				rtk_NoOfRunsdate='$NoOfRunsdate' AND rtk_FromStationID='{$userStationID}') AND  st_TicketID NOT IN (SELECT et_TicketID 
				FROM tms_sell_ErrTicket WHERE  et_NoOfRunsID='$NoOfRunsID' AND et_NoOfRunsdate='$NoOfRunsdate' AND 
				et_FromStationID='{$userStationID}')";
		$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '检票数据添加失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		//并班的情况
		$queryString = "INSERT IGNORE `tms_chk_CheckTicketTemp` (`ctt_TicketID`, `ctt_NoOfRunsID`, `ctt_LineID`, `ctt_NoOfRunsdate`, 
				`ctt_BeginStationTime`, `ctt_StopStationTime`, `ctt_Distance`, `ctt_BeginStationID`, `ctt_BeginStation`, `ctt_FromStationID`, 
				`ctt_FromStation`, `ctt_ReachStationID`, `ctt_ReachStation`, `ctt_EndStationID`, `ctt_EndStation`, `ctt_SellPrice`, 
				`ctt_SellPriceType`, `ctt_ColleSellPriceType`, `ctt_TotalMan`, `ctt_FullPrice`, `ctt_HalfPrice`, `ctt_StandardPrice`, 
				`ctt_BalancePrice`, `ctt_ServiceFee`, `ctt_otherFee1`, `ctt_otherFee2`, `ctt_otherFee3`, `ctt_otherFee4`, `ctt_otherFee5`, 
				`ctt_otherFee6`, `ctt_StationID`, `ctt_Station`, `ctt_SellDate`, `ctt_SellTime`, `ctt_BusModelID`, `ctt_BusModel`, 
				`ctt_BusID`,`ctt_BusNumber`, `ctt_SeatID`, `ctt_SellID`, `ctt_SellName`, `ctt_FreeSeats`, `ctt_SafetyTicketID`, 
				`ctt_SafetyTicketNumber`,`ctt_SafetyTicketMoney`, `ctt_SafetyTicketPassengerID`, `ctt_CheckTicketWindow`,`ctt_TicketState`,
				`ctt_AllCheck`,`ctt_CheckerID`, 
				`ctt_Checker`, `ctt_CheckDate`,`ctt_CheckTime`) SELECT `st_TicketID`,'$NoOfRunsID',`st_LineID`,  '$NoOfRunsdate', 
				`st_BeginStationTime`,`st_StopStationTime`, `st_Distance`, `st_BeginStationID`, `st_BeginStation`, `st_FromStationID`, 
				`st_FromStation`, `st_ReachStationID`, `st_ReachStation`, `st_EndStationID`, `st_EndStation`, `st_SellPrice`, 
				`st_SellPriceType`,`st_ColleSellPriceType`, `st_TotalMan`, `st_FullPrice`, `st_HalfPrice`, `st_StandardPrice`, 
				`st_BalancePrice`, `st_ServiceFee`, `st_otherFee1`, `st_otherFee2`, `st_otherFee3`,`st_otherFee4`, `st_otherFee5`, 
				`st_otherFee6`, '$userStationID','$userStationName', `st_SellDate`, `st_SellTime`, `st_BusModelID`, `st_BusModel`, 
				'{$rows['ct_BusID']}', '{$rows['ct_BusNumber']}', `st_SeatID`, `st_SellID`, `st_SellName`, `st_FreeSeats`, 
				`st_SafetyTicketID`, `st_SafetyTicketNumber`, `st_SafetyTicketMoney`, `st_SafetyTicketPassengerID`, 
				'$checkWindow',`st_TicketState`,'1', '$userID', '$userName', '$nowdate', '$nowtime' FROM tms_sell_SellTicket 
				LEFT OUTER JOIN tms_sch_AndNoOfRuns ON anr_NoOfRunsID=st_NoOfRunsID AND anr_NoOfRunsdate=st_NoOfRunsdate
				WHERE (anr_AndNoOfRunsID = '$NoOfRunsID') AND (anr_AndNoOfRunsdate = '$NoOfRunsdate') AND st_FromStationID='{$userStationID}'
				AND st_TicketID NOT IN (SELECT rtk_TicketID FROM tms_sell_ReturnTicket
				LEFT OUTER JOIN tms_sch_AndNoOfRuns ON anr_NoOfRunsID=rtk_NoOfRunsID AND anr_NoOfRunsdate=rtk_NoOfRunsdate 
				WHERE anr_AndNoOfRunsID = '$NoOfRunsID' AND anr_AndNoOfRunsdate = '$NoOfRunsdate' AND rtk_FromStationID='{$userStationID}') 
				AND  st_TicketID NOT IN (SELECT et_TicketID FROM tms_sell_ErrTicket 
				LEFT OUTER JOIN tms_sch_AndNoOfRuns ON anr_NoOfRunsID=et_NoOfRunsID AND anr_NoOfRunsdate=et_NoOfRunsdate 
				WHERE anr_AndNoOfRunsID='$NoOfRunsID' AND anr_AndNoOfRunsdate='$NoOfRunsdate' AND et_FromStationID='{$userStationID}')";
		$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '检票数据添加失败1！'.$class_mysql_default->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		//检查报班车辆是否与票版中车辆一致
		$selectmodel="SELECT tml_BusModelID,tml_BusUnit FROM tms_bd_TicketMode WHERE tml_NoOfRunsID='{$NoOfRunsID}' AND tml_NoOfRunsdate='{$NoOfRunsdate}'";
		$querymode=$class_mysql_default->my_query("$selectmodel");
		$rowmode= mysqli_fetch_array($querymode);

		// 取得即时结算价和服务费（因为车辆在调度和检票时可能会发生改变）：首先读取售票表数据；再检查班次调价表和服务费调价表（按协议调价、
		// 班次调价、线路调价的优先级顺序），如有记录，则更新从售票表取得的数据；如无，则取售票表中的数据。
		// 如果没有输入结算价，则用售票价减去站务费做为结算价
	/*	$queryString = "SELECT `ctt_TicketID`, `ctt_NoOfRunsID`, `ctt_LineID`, `ctt_NoOfRunsdate`, `ctt_FromStationID`, `ctt_FromStation`, 
			`ctt_ReachStationID`, `ctt_ReachStation`, `ctt_BalancePrice`, `ctt_ServiceFee`,`ctt_SeatID`, `bi_BusTypeID`, `bi_BusType`, `bi_BusUnit` 
			FROM tms_chk_CheckTicketTemp, tms_bd_BusInfo WHERE bi_BusID = '{$rows['ct_BusID']}'"; */
		$queryString = "SELECT `ctt_TicketID`, `ctt_NoOfRunsID`, `ctt_LineID`, `ctt_NoOfRunsdate`, `ctt_FromStationID`, `ctt_FromStation`, 
			`ctt_ReachStationID`, `ctt_ReachStation`, `ctt_BalancePrice`, `ctt_ServiceFee`,`ctt_SeatID`,`ctt_TicketState`, `bi_BusTypeID`, 
			`bi_BusType`, `bi_BusUnit` FROM tms_chk_CheckTicketTemp, tms_bd_BusInfo WHERE bi_BusID = '{$rows['ct_BusID']}' AND 
			ctt_NoOfRunsID='$NoOfRunsID' AND ctt_NoOfRunsdate='$NoOfRunsdate'";
		$result_ctt = $class_mysql_default->my_query("$queryString");
		if(!$result_ctt) {
			$retData = array('retVal' => 'FAIL', 'retString' => '读取临时检票和车辆信息失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		
		while ($rows2 = mysqli_fetch_array($result_ctt)) {
			if($SeatIDstr==''){
				if($rows2['ctt_TicketState']=='9'){
					$SeatIDstr=$SeatIDstr.'and';
				}else{
					$SeatIDstr=$SeatIDstr.$rows2['ctt_SeatID'];
				}
			}else{
				if($rows2['ctt_TicketState']=='9'){
					$SeatIDstr=$SeatIDstr.','.'and';
				}else{
					$SeatIDstr=$SeatIDstr.','.$rows2['ctt_SeatID'];
				}
			}
			$count=$count+1;
			$queryString = "SELECT `st_NoOfRunsID`, `st_LineID`, `st_NoOfRunsdate`, `st_FromStationID`, `st_FromStation`, `st_ReachStationID`, 
					`st_ReachStation`, `st_SellPrice`, `st_BalancePrice`, `st_ServiceFee` FROM tms_sell_SellTicket 
					WHERE st_TicketID = '{$rows2['ctt_TicketID']}'";
			$result = $class_mysql_default->my_query("$queryString");
			if(!$result) {
				$retData = array('retVal' => 'FAIL', 'retString' => '读取售票信息失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
			$rows3 = mysqli_fetch_array($result);
			$SellPrice = $rows3['st_SellPrice'];
		//	$BalancePrice = $rows3['st_BalancePrice'];
			$ServiceFee = $rows3['st_ServiceFee'];
			//检查报班车辆是否与票版中车辆一致
			if($rowmode['tml_BusModelID']==$rows2['bi_BusTypeID'] && $rowmode['tml_BusUnit']==$rows2['bi_BusUnit']){
				$BalancePrice = $rows3['st_BalancePrice'];
			}else{
				$BalancePrice=0;
			/*	$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['ctt_FromStationID']}' 
						AND	nrap_GetToSiteID = '{$rows2['ctt_ReachStationID']}' AND '{$rows2['ctt_NoOfRunsdate']}' >= nrap_BeginDate 
						AND '{$rows2['ctt_NoOfRunsdate']}' <= nrap_EndDate AND nrap_NoRunsAdjust = '{$rows2['ctt_NoOfRunsID']}' 
						AND	nrap_ISNoRunsAdjust = 0 AND nrap_ISLineAdjust = 0 AND nrap_ModelID = '{$rows2['bi_BusTypeID']}' 
						AND nrap_Unit = '{$rows2['bi_BusUnit']}'"; */
				$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['ctt_FromStationID']}' 
						AND	nrap_GetToSiteID = '{$rows2['ctt_ReachStationID']}' AND '{$rows2['ctt_NoOfRunsdate']}' >= nrap_BeginDate 
						AND '{$rows2['ctt_NoOfRunsdate']}' <= nrap_EndDate AND nrap_NoRunsAdjust = '{$rows2['ctt_NoOfRunsID']}' 
						AND	nrap_ISNoRunsAdjust = 0 AND nrap_ISLineAdjust = 0 AND nrap_ModelID = '{$rows2['bi_BusTypeID']}' 
						AND nrap_Unit = '{$rows2['bi_BusUnit']}' AND DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),
						STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))=(SELECT MIN(DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))) 
						FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rows2['ctt_FromStationID']}' AND nrap_GetToSiteID='{$rows2['ctt_ReachStationID']}' 
						AND nrap_BeginDate<='{$rows2['ctt_NoOfRunsdate']}' AND nrap_EndDate>='{$rows2['ctt_NoOfRunsdate']}' AND nrap_NoRunsAdjust='{$rows2['ctt_NoOfRunsID']}' 
						AND nrap_ISUnitAdjust=1 AND nrap_ModelID='{$rows2['bi_BusTypeID']}' AND nrap_Unit='{$rows2['bi_BusUnit']}' GROUP BY 
						nrap_DepartureSiteID,nrap_GetToSiteID,nrap_NoRunsAdjust,nrap_ModelID,nrap_Unit,nrap_ISUnitAdjust)";
				$result = $class_mysql_default->my_query("$queryString");
				if(mysqli_num_rows($result) == 1) {
					$rows3 = mysqli_fetch_array($result);
					$BalancePrice = $rows3['nrap_BalancePrice'];
				}
				else {
				/*	$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['ctt_FromStationID']}' 
							AND	nrap_GetToSiteID = '{$rows2['ctt_ReachStationID']}' AND '{$rows2['ctt_NoOfRunsdate']}' >= nrap_BeginDate 
							AND '{$rows2['ctt_NoOfRunsdate']}' <= nrap_EndDate AND nrap_NoRunsAdjust = '{$rows2['ctt_NoOfRunsID']}' 
							AND	nrap_ISNoRunsAdjust = 1 AND nrap_ISLineAdjust = 0 AND nrap_ModelID = '{$rows2['bi_BusTypeID']}'"; */
					$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['ctt_FromStationID']}' 
							AND	nrap_GetToSiteID = '{$rows2['ctt_ReachStationID']}' AND '{$rows2['ctt_NoOfRunsdate']}' >= nrap_BeginDate 
							AND '{$rows2['ctt_NoOfRunsdate']}' <= nrap_EndDate AND nrap_NoRunsAdjust = '{$rows2['ctt_NoOfRunsID']}' 
							AND	nrap_ISNoRunsAdjust = 1 AND nrap_ISLineAdjust = 0 AND nrap_ModelID = '{$rows2['bi_BusTypeID']}' AND 
							DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))=(SELECT 
							MIN(DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))) FROM 
							tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rows2['ctt_FromStationID']}' AND nrap_GetToSiteID='{$rows2['ctt_ReachStationID']}' 
							AND nrap_BeginDate<='{$rows2['ctt_NoOfRunsdate']}' AND nrap_EndDate>='{$rows2['ctt_NoOfRunsdate']}' AND 
							nrap_NoRunsAdjust='{$rows2['ctt_NoOfRunsID']}' AND nrap_ISNoRunsAdjust=1 AND nrap_ModelID='{$rows2['bi_BusTypeID']}' 
							GROUP BY nrap_DepartureSiteID,nrap_GetToSiteID,nrap_NoRunsAdjust,nrap_ModelID,nrap_ISNoRunsAdjust)";
					
					$result = $class_mysql_default->my_query("$queryString");
					if(mysqli_num_rows($result) == 1) {
						$rows3 = mysqli_fetch_array($result);
						$BalancePrice = $rows3['nrap_BalancePrice'];
					}
					else {
					/*	$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['ctt_FromStationID']}' 
								AND	nrap_GetToSiteID = '{$rows2['ctt_ReachStationID']}' AND '{$rows2['ctt_NoOfRunsdate']}' >= nrap_BeginDate 
								AND '{$rows2['ctt_NoOfRunsdate']}' <= nrap_EndDate AND nrap_LineAdjust = '{$rows2['ctt_LineID']}' 
								AND nrap_ISNoRunsAdjust = 0 AND nrap_ISLineAdjust = 1 AND nrap_ModelID = '{$rows2['bi_BusTypeID']}'"; */
						$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['ctt_FromStationID']}' 
								AND	nrap_GetToSiteID = '{$rows2['ctt_ReachStationID']}' AND '{$rows2['ctt_NoOfRunsdate']}' >= nrap_BeginDate 
								AND '{$rows2['ctt_NoOfRunsdate']}' <= nrap_EndDate AND nrap_LineAdjust = '{$rows2['ctt_LineID']}' 
								AND nrap_ISNoRunsAdjust = 0 AND nrap_ISLineAdjust = 1 AND nrap_ModelID = '{$rows2['bi_BusTypeID']}' AND 
								DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))=(SELECT 
								MIN(DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))) 
								FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rows2['ctt_FromStationID']}' AND 
								nrap_GetToSiteID='{$rows2['ctt_ReachStationID']}' AND nrap_BeginDate<='{$rows2['ctt_NoOfRunsdate']}' AND 
								nrap_EndDate>='{$rows2['ctt_NoOfRunsdate']}' AND nrap_LineAdjust='{$rows2['ctt_LineID']}' 
								AND nrap_ISLineAdjust=1 AND nrap_ModelID='{$rows2['bi_BusTypeID']}' 
								GROUP BY nrap_DepartureSiteID,nrap_GetToSiteID,nrap_NoRunsAdjust,nrap_ModelID,nrap_ISLineAdjust)";
						
						$result = $class_mysql_default->my_query("$queryString");
						if(mysqli_num_rows($result) == 1) {
							$rows3 = mysqli_fetch_array($result);
							$BalancePrice = $rows3['nrap_BalancePrice'];
						}
					}
				}
			}
		/*	$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['ctt_FromStationID']}' 
					AND	sfa_GetToSiteID = '{$rows2['ctt_ReachStationID']}' AND '{$rows2['ctt_NoOfRunsdate']}' >= sfa_BeginDate 
					AND '{$rows2['ctt_NoOfRunsdate']}' <= sfa_EndDate AND sfa_NoRunsAdjust = '{$rows2['ctt_NoOfRunsID']}' 
					AND	sfa_ISNoRunsAdjust = 0 AND sfa_ISLineAdjust = 0 AND sfa_ModelID = '{$rows2['bi_BusTypeID']}' 
					AND sfa_Unit = '{$rows2['bi_BusUnit']}'"; */
			$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['ctt_FromStationID']}' 
					AND	sfa_GetToSiteID = '{$rows2['ctt_ReachStationID']}' AND '{$rows2['ctt_NoOfRunsdate']}' >= sfa_BeginDate 
					AND '{$rows2['ctt_NoOfRunsdate']}' <= sfa_EndDate AND sfa_NoRunsAdjust = '{$rows2['ctt_NoOfRunsID']}' 
					AND	sfa_ISNoRunsAdjust = 0 AND sfa_ISLineAdjust = 0 AND sfa_ModelID = '{$rows2['bi_BusTypeID']}' 
					AND sfa_Unit = '{$rows2['bi_BusUnit']}' AND DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),
					STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))=(SELECT MIN(DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))) 
					FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID='{$rows2['ctt_FromStationID']}' AND sfa_GetToSiteID='{$rows2['ctt_ReachStationID']}' 
					AND sfa_BeginDate<='{$rows2['ctt_NoOfRunsdate']}' AND sfa_EndDate>='{$rows2['ctt_NoOfRunsdate']}' AND sfa_NoRunsAdjust='{$rows2['ctt_NoOfRunsID']}' 
					AND sfa_ISUnitAdjust=1 AND sfa_ModelID='{$rows2['bi_BusTypeID']}' AND sfa_Unit='{$rows2['bi_BusUnit']}' GROUP BY 
					sfa_DepartureSiteID,sfa_GetToSiteID,sfa_NoRunsAdjust,sfa_ModelID,sfa_Unit,sfa_ISUnitAdjust)";
			$result = $class_mysql_default->my_query("$queryString");
			if(mysqli_num_rows($result) == 1) {
				$rows3 = mysqli_fetch_array($result);
				$ServiceFee = $rows3['sfa_RunPrice'];
			}
			else {
			/*	$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['ctt_FromStationID']}' 
						AND	sfa_GetToSiteID = '{$rows2['ctt_ReachStationID']}' AND '{$rows2['ctt_NoOfRunsdate']}' >= sfa_BeginDate 
						AND '{$rows2['ctt_NoOfRunsdate']}' <= sfa_EndDate AND sfa_NoRunsAdjust = '{$rows2['ctt_NoOfRunsID']}' 
						AND	sfa_ISNoRunsAdjust = 1 AND sfa_ISLineAdjust = 0 AND sfa_ModelID = '{$rows2['bi_BusTypeID']}'"; */
				$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['ctt_FromStationID']}' 
						AND	sfa_GetToSiteID = '{$rows2['ctt_ReachStationID']}' AND '{$rows2['ctt_NoOfRunsdate']}' >= sfa_BeginDate 
						AND '{$rows2['ctt_NoOfRunsdate']}' <= sfa_EndDate AND sfa_NoRunsAdjust = '{$rows2['ctt_NoOfRunsID']}' 
						AND	sfa_ISNoRunsAdjust = 1 AND sfa_ISLineAdjust = 0 AND sfa_ModelID = '{$rows2['bi_BusTypeID']}' AND 
						DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))=(SELECT 
						MIN(DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))) FROM 
						tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID='{$rows2['ctt_FromStationID']}' AND sfa_GetToSiteID='{$rows2['ctt_ReachStationID']}' 
						AND sfa_BeginDate<='{$rows2['ctt_NoOfRunsdate']}' AND sfa_EndDate>='{$rows2['ctt_NoOfRunsdate']}' AND 
						sfa_NoRunsAdjust='{$rows2['ctt_NoOfRunsID']}' AND sfa_ISNoRunsAdjust=1 AND sfa_ModelID='{$rows2['bi_BusTypeID']}' 
						GROUP BY sfa_DepartureSiteID,sfa_GetToSiteID,sfa_NoRunsAdjust,sfa_ModelID,sfa_ISNoRunsAdjust)";
				$result = $class_mysql_default->my_query("$queryString");
				if(mysqli_num_rows($result) == 1) {
					$rows3 = mysqli_fetch_array($result);
					$ServiceFee = $rows3['sfa_RunPrice'];
				}
				else {
				/*	$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['ctt_FromStationID']}' 
							AND	sfa_GetToSiteID = '{$rows2['ctt_ReachStationID']}' AND '{$rows2['ctt_NoOfRunsdate']}' >= sfa_BeginDate 
							AND '{$rows2['ctt_NoOfRunsdate']}' <= sfa_EndDate AND sfa_LineAdjust = '{$rows2['ctt_LineID']}' 
							AND sfa_ISNoRunsAdjust = 0 AND sfa_ISLineAdjust = 1 AND sfa_ModelID = '{$rows2['bi_BusTypeID']}'"; */
					$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['ctt_FromStationID']}' 
							AND	sfa_GetToSiteID = '{$rows2['ctt_ReachStationID']}' AND '{$rows2['ctt_NoOfRunsdate']}' >= sfa_BeginDate 
							AND '{$rows2['ctt_NoOfRunsdate']}' <= sfa_EndDate AND sfa_LineAdjust = '{$rows2['ctt_LineID']}' 
							AND sfa_ISNoRunsAdjust = 0 AND sfa_ISLineAdjust = 1 AND sfa_ModelID = '{$rows2['bi_BusTypeID']}'AND 
							DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))=(SELECT 
							MIN(DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))) 
							FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID='{$rows2['ctt_FromStationID']}' AND sfa_GetToSiteID='{$rows2['ctt_ReachStationID']}' 
							AND sfa_BeginDate<='{$rows2['ctt_NoOfRunsdate']}' AND sfa_EndDate>='{$rows2['ctt_NoOfRunsdate']}' AND sfa_LineAdjust='{$rows2['ctt_LineID']}' 
							AND sfa_ISLineAdjust=1 AND sfa_ModelID='{$rows2['bi_BusTypeID']}' 
							GROUP BY sfa_DepartureSiteID,sfa_GetToSiteID,sfa_NoRunsAdjust,sfa_ModelID,sfa_ISLineAdjust)";
					$result = $class_mysql_default->my_query("$queryString");
					if(mysqli_num_rows($result) == 1) {
						$rows3 = mysqli_fetch_array($result);
						$ServiceFee = $rows3['sfa_RunPrice'];
						$queryString = "UPDATE tms_chk_CheckTicketTemp SET ctt_ServiceFee = '{$rows3['sfa_RunPrice']}' 
									WHERE ctt_TicketID = '{$rows2['ctt_TicketID']}'";
						$result = $class_mysql_default->my_query("$queryString");
					  	if(!$result) {
							$class_mysql_default->my_query("ROLLBACK");
							$retData = array('retVal' => 'FAIL', 'retString' => '服务费数据更新失败！', 'sql' => $queryString);
							echo json_encode($retData);
							exit();
					  	}
					}
				}
			}
			
			if($BalancePrice == 0 || $BalancePrice == NULL) {
				$BalancePrice = $SellPrice - $ServiceFee;
			}
			$queryString = "UPDATE tms_chk_CheckTicketTemp SET ctt_BalancePrice = '$BalancePrice', ctt_ServiceFee = '$ServiceFee' 
					WHERE ctt_TicketID = '{$rows2['ctt_TicketID']}'";
			$result = $class_mysql_default->my_query("$queryString");
		  	if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '结算价服务费数据更新失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
		  	}
		}
		
		if($rows['ct_Allticket'] == "1") {
			$queryString = "UPDATE tms_chk_CheckTemp SET ct_CheckedTicketNum = '$waitingCheckTicketNum'
						WHERE ct_NoOfRunsID = '$NoOfRunsID'	AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '{$rows['ct_BusID']}'";
			$result = $class_mysql_default->my_query("$queryString");
		  	if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '检票数据更新失败！', 'sql' => $queryString);
			}
			else {
				$class_mysql_default->my_query("COMMIT");
				$retData = array('retVal' => 'SUCC', 'retString' => '检票成功！', 'sql' => $queryString);
			}
		}
		else {
			$queryString = "SELECT tml_SeatStatus FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$NoOfRunsID') 
						AND (tml_NoOfRunsdate = '$NoOfRunsdate') FOR UPDATE";
	  		$result = $class_mysql_default->my_query("$queryString");
			if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '锁定票版数据表失败！', 'sql' => $queryString);
			}
			else {
				$rows = mysqli_fetch_array($result);
				$seatStatus = $rows['tml_SeatStatus'];
			//	$seatStatus = str_replace('3', '4', $seatStatus, $count);
				foreach (explode(",",$SeatIDstr) as $key =>$SeatID){
					if($SeatID=='and'){
						$seatI=stripos($seatStatus, '7')+1;
						$seatStatus = substr_replace($seatStatus, '4', stripos($seatStatus, '7'), 1);
						$updatechecktemp="UPDATE tms_chk_CheckTicketTemp SET ctt_SeatID='{$seatI}',ctt_AllCheck='0' WHERE ctt_NoOfRunsID='{$NoOfRunsID}'
							AND ctt_NoOfRunsdate='{$NoOfRunsdate}' AND ctt_FromStationID='{$userStationID}' AND ctt_TicketState='9' AND ctt_AllCheck='1'  
							ORDER BY ctt_SeatID ASC LIMIT 1";
						$querychecktemp=$class_mysql_default->my_query("$updatechecktemp");
						if(!$querychecktemp){
							$class_mysql_default->my_query("ROLLBACK");
							$retData = array('retVal' => 'FAIL', 'retString' => '更新临时检票数据表失败2！', 'sql' => $queryString);
						} 
					}else{
						$seatStatus=substr_replace($seatStatus, '4', $SeatID-1, 1);
					}
				}
			  	$queryString = "UPDATE tms_bd_TicketMode SET tml_SeatStatus = '$seatStatus' WHERE (tml_NoOfRunsID = '$NoOfRunsID') 
			  			AND (tml_NoOfRunsdate = '$NoOfRunsdate')";	  	
			  	$result = $class_mysql_default->my_query("$queryString");
				if(!$result) {
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '更新票版数据表失败！', 'sql' => $queryString);
				}
				else {
				/*	$queryString = "UPDATE tms_chk_CheckTemp SET ct_CheckedTicketNum = ct_CheckedTicketNum + '$count' 
							WHERE ct_NoOfRunsID = '$NoOfRunsID'	AND ct_NoOfRunsdate = '$NoOfRunsdate'"; */
					$queryString = "UPDATE tms_chk_CheckTemp SET ct_CheckedTicketNum ='$count' 
							WHERE ct_NoOfRunsID = '$NoOfRunsID'	AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID='{$BusID}' AND 
							ct_ReportDateTime=(SELECT rt_ReportDateTime FROM tms_sch_Report WHERE rt_NoOfRunsID='{$NoOfRunsID}' AND 
							rt_NoOfRunsdate='{$NoOfRunsdate}' AND rt_BusID='{$BusID}' AND rt_AttemperStationID='{$userStationID}' 
							ORDER BY rt_ReportDateTime DESC LIMIT 1)";
					$result = $class_mysql_default->my_query("$queryString");
				  	if(!$result) {
						$class_mysql_default->my_query("ROLLBACK");
						$retData = array('retVal' => 'FAIL', 'retString' => '检票班次数据更新失败！', 'sql' => $queryString);
					}
					else {
						$class_mysql_default->my_query("COMMIT");
						$retData = array('retVal' => 'SUCC', 'retString' => '全检成功！', 'sql' => $queryString, 
									'seatStatus' => $seatStatus, 'count' => $count);
					}
				}
			}
		}
		echo json_encode($retData);
		break;
	case "CONFIRMCHECKw":
		$ticketID=$_REQUEST['ticketID'];
		$BalanceNO=$_REQUEST['BalanceNO'];
		$NoOfRunsID=$_REQUEST['NoOfRunsID'];
		$NoOfRunsdate=$_REQUEST['NoOfRunsdate'];
		$ReportDateTime=$_REQUEST['ReportDateTime'];
		$BusID=$_REQUEST['BusID'];
		$nowdate = date('Y-m-d');
		$nowtime = date('H:i:s');
		
	/*	$selectbus="SELECT bi_BusID,bi_BusNumber,bi_BusTypeID,bi_BusType FROM tms_bd_BusInfo WHERE bi_BusID='{$BusID}'";
		$querybus=$class_mysql_default->my_query("$selectbus");
		if(!$querybus){
			$retData = array('retVal' => 'FAIL', 'retString' => '查询车辆数据失败！', 'found' => $found, 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$rowbus=mysqli_fetch_array($querybus); */
		// 查找票号所在班次
		$thisnoofruns=0;//0并班情况，1本班次
		$queryString = "SELECT `st_TicketID`,`st_FromStationID` FROM tms_sell_SellTicket WHERE (st_NoOfRunsID = '$NoOfRunsID') AND 
					(st_NoOfRunsdate = '$NoOfRunsdate') AND (st_TicketID = '$ticketID')";
		$result1 = $class_mysql_default->my_query("$queryString");
		if(mysqli_num_rows($result1) == 1) {
			$rowsell=mysqli_fetch_array($result1);
			if($rowsell['st_FromStationID']!=$userStationID && $userStationID!='all'){
				$retData = array('retVal' => 'FAIL', 'retString' => '此票不在本站上车！请检查。', 'found' => $found, 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}else{
				$thisnoofruns=1;
			}
		}else{ //如果班次被并
			$querysellticket = "SELECT `st_TicketID`,`st_FromStationID` FROM tms_sell_SellTicket LEFT OUTER JOIN tms_sch_AndNoOfRuns ON 
					anr_NoOfRunsID=st_NoOfRunsID AND anr_NoOfRunsdate=st_NoOfRunsdate WHERE (anr_AndNoOfRunsID = '$NoOfRunsID') AND 
					(anr_AndNoOfRunsdate = '$NoOfRunsdate') AND (st_TicketID = '$ticketID')";
			$resultsellticket = $class_mysql_default->my_query("$querysellticket");
			if(mysqli_num_rows($resultsellticket) == 1) {
				$rowsellticket=mysqli_fetch_array($resultsellticket);
				if($rowsellticket['st_FromStationID']!=$userStationID  && $userStationID!='all'){
					$retData = array('retVal' => 'FAIL', 'retString' => '此票不在本站上车！请检查。', 'found' => $found, 'sql' => $queryString);
					echo json_encode($retData);
					exit();
				}else{
					$thisnoofruns=0;
				}
			}else{
				$retData = array('retVal' => 'FAIL', 'retString' => '此票不对请检查！', 'found' => $found, 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
		}
		//判断是否已签或已退
		$selectReturn="SELECT rtk_TicketID,rtk_IsBalance FROM tms_sell_ReturnTicket WHERE rtk_TicketID='{$ticketID}'";
		$queryReturn=$class_mysql_default->my_query("$selectReturn");
		if(!$queryReturn){
			$retData = array('retVal' => 'FAIL', 'retString' => '查询退票数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		if(mysqli_num_rows($queryReturn) == 1){
			$rowReturn=mysqli_fetch_array($queryReturn);
			if($rowReturn['rtk_IsBalance']=='0'){
				$retData = array('retVal' => 'FAIL', 'retString' => '此票已签，不能再检！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}else{
				$retData = array('retVal' => 'FAIL', 'retString' => '此票已退，不能再检！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
		}
		//判断是否废票
		$selecterror="SELECT et_TicketID FROM tms_sell_ErrTicket WHERE et_TicketID='{$ticketID}'";
		$queryerror=$class_mysql_default->my_query("$selecterror");
		if(!$queryerror){
			$retData = array('retVal' => 'FAIL', 'retString' => '查询废票数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		if(mysqli_num_rows($queryerror) == 1){
			$retData = array('retVal' => 'FAIL', 'retString' => '此票已废，不能再检！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		// 取得即时结算价和服务费（因为车辆在调度和检票时可能会发生改变）：首先读取售票表数据；再检查班次调价表和服务费调价表（按协议调价、
		// 班次调价、线路调价的优先级顺序），如有记录，则更新从售票表取得的数据；如无，则取售票表中的数据。
		// 如果没有输入结算价，则用售票价减去站务费做为结算价
		$queryString = "SELECT `st_NoOfRunsID`, `st_LineID`, `st_NoOfRunsdate`, `st_FromStationID`, `st_FromStation`, `st_ReachStationID`, 
			`st_ReachStation`, `st_SellPrice`, `st_BalancePrice`, `st_ServiceFee`, `bi_BusTypeID`, `bi_BusType`, `bi_BusUnit`,`bi_BusNumber`  
			FROM tms_sell_SellTicket, tms_bd_BusInfo WHERE st_TicketID = '$ticketID' AND bi_BusID = '$BusID'";
		$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			$retData = array('retVal' => 'FAIL', 'retString' => '读取售票和车辆信息失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$rows2 = mysqli_fetch_array($result);
		$SellPrice = $rows2['st_SellPrice'];
	//	$BalancePrice = $rows2['st_BalancePrice'];
		$ServiceFee = $rows2['st_ServiceFee'];
		//检查报班车辆是否与票版中车辆一致
		$selectmodel="SELECT tml_BusModelID,tml_BusUnit,tml_Allticket FROM tms_bd_TicketMode WHERE tml_NoOfRunsID='{$NoOfRunsID}' AND tml_NoOfRunsdate='{$NoOfRunsdate}'";
		$querymode=$class_mysql_default->my_query("$selectmodel");
		$rowmode= mysqli_fetch_array($querymode);
		if($rowmode['tml_BusModelID']==$rows2['bi_BusTypeID'] && $rowmode['tml_BusUnit']==$rows2['bi_BusUnit']){
			$BalancePrice = $rows2['st_BalancePrice'];
		}else{
			$BalancePrice=0;
		/*	$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['st_FromStationID']}' 
					AND	nrap_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= nrap_BeginDate 
					AND '{$rows2['st_NoOfRunsdate']}' <= nrap_EndDate AND nrap_NoRunsAdjust = '{$NoOfRunsID}' 
					AND	nrap_ISNoRunsAdjust = 0 AND nrap_ISLineAdjust = 0 AND nrap_ModelID = '{$rows2['bi_BusTypeID']}' 
					AND nrap_Unit = '{$rows2['bi_BusUnit']}'"; */
			$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['st_FromStationID']}' 
					AND	nrap_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= nrap_BeginDate 
					AND '{$rows2['st_NoOfRunsdate']}' <= nrap_EndDate AND nrap_NoRunsAdjust = '{$NoOfRunsID}' 
					AND	nrap_ISNoRunsAdjust = 0 AND nrap_ISLineAdjust = 0 AND nrap_ModelID = '{$rows2['bi_BusTypeID']}' 
					AND nrap_Unit = '{$rows2['bi_BusUnit']}' AND DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),
					STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))=(SELECT MIN(DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))) 
					FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rows2['st_FromStationID']}' AND nrap_GetToSiteID='{$rows2['st_ReachStationID']}' 
					AND nrap_BeginDate<='{$rows2['st_NoOfRunsdate']}' AND nrap_EndDate>='{$rows2['st_NoOfRunsdate']}' AND nrap_NoRunsAdjust='{$NoOfRunsID}' 
					AND nrap_ISUnitAdjust=1 AND nrap_ModelID='{$rows2['bi_BusTypeID']}' AND nrap_Unit='{$rows2['bi_BusUnit']}' GROUP BY 
					nrap_DepartureSiteID,nrap_GetToSiteID,nrap_NoRunsAdjust,nrap_ModelID,nrap_Unit,nrap_ISUnitAdjust)";
			$result = $class_mysql_default->my_query("$queryString");
			if(mysqli_num_rows($result) == 1) {
				$rows3 = mysqli_fetch_array($result);
				$BalancePrice = $rows3['nrap_BalancePrice'];
			}
			else {
			/*	$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['st_FromStationID']}' 
						AND	nrap_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= nrap_BeginDate 
						AND '{$rows2['st_NoOfRunsdate']}' <= nrap_EndDate AND nrap_NoRunsAdjust = '{$NoOfRunsID}' 
						AND	nrap_ISNoRunsAdjust = 1 AND nrap_ISLineAdjust = 0 AND nrap_ModelID = '{$rows2['bi_BusTypeID']}'"; */
				$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['st_FromStationID']}' 
						AND	nrap_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= nrap_BeginDate 
						AND '{$rows2['st_NoOfRunsdate']}' <= nrap_EndDate AND nrap_NoRunsAdjust = '{$NoOfRunsID}' 
						AND	nrap_ISNoRunsAdjust = 1 AND nrap_ISLineAdjust = 0 AND nrap_ModelID = '{$rows2['bi_BusTypeID']}' AND 
						DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))=(SELECT 
						MIN(DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))) FROM 
						tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rows2['st_FromStationID']}' AND nrap_GetToSiteID='{$rows2['st_ReachStationID']}' 
						AND nrap_BeginDate<='{$rows2['st_NoOfRunsdate']}' AND nrap_EndDate>='{$rows2['st_NoOfRunsdate']}' AND nrap_NoRunsAdjust='{$NoOfRunsID}' 
						AND nrap_ISNoRunsAdjust=1 AND nrap_ModelID='{$rows2['bi_BusTypeID']}' 
						GROUP BY nrap_DepartureSiteID,nrap_GetToSiteID,nrap_NoRunsAdjust,nrap_ModelID,nrap_ISNoRunsAdjust)";
				$result = $class_mysql_default->my_query("$queryString");
				if(mysqli_num_rows($result) == 1) {
					$rows3 = mysqli_fetch_array($result);
					$BalancePrice = $rows3['nrap_BalancePrice'];
				}
				else {
				/*	$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['st_FromStationID']}' 
							AND	nrap_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= nrap_BeginDate 
							AND '{$rows2['st_NoOfRunsdate']}' <= nrap_EndDate AND nrap_LineAdjust = '{$rows2['st_LineID']}' 
							AND nrap_ISNoRunsAdjust = 0 AND nrap_ISLineAdjust = 1 AND nrap_ModelID = '{$rows2['bi_BusTypeID']}'"; */
					$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['st_FromStationID']}' 
							AND	nrap_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= nrap_BeginDate 
							AND '{$rows2['st_NoOfRunsdate']}' <= nrap_EndDate AND nrap_LineAdjust = '{$rows2['st_LineID']}' 
							AND nrap_ISNoRunsAdjust = 0 AND nrap_ISLineAdjust = 1 AND nrap_ModelID = '{$rows2['bi_BusTypeID']}' AND 
							DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))=(SELECT 
							MIN(DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))) 
							FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rows2['st_FromStationID']}' AND nrap_GetToSiteID='{$rows2['st_ReachStationID']}' 
							AND nrap_BeginDate<='{$rows2['st_NoOfRunsdate']}' AND nrap_EndDate>='{$rows2['st_NoOfRunsdate']}' AND nrap_LineAdjust='{$rows2['st_LineID']}' 
							AND nrap_ISLineAdjust=1 AND nrap_ModelID='{$rows2['bi_BusTypeID']}' 
							GROUP BY nrap_DepartureSiteID,nrap_GetToSiteID,nrap_NoRunsAdjust,nrap_ModelID,nrap_ISLineAdjust)";
					$result = $class_mysql_default->my_query("$queryString");
					if(mysqli_num_rows($result) == 1) {
						$rows3 = mysqli_fetch_array($result);
						$BalancePrice = $rows3['nrap_BalancePrice'];
					}
				}
			}
		}
	/*	$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['st_FromStationID']}' 
				AND	sfa_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= sfa_BeginDate 
				AND '{$rows2['st_NoOfRunsdate']}' <= sfa_EndDate AND sfa_NoRunsAdjust = '{$NoOfRunsID}' 
				AND	sfa_ISNoRunsAdjust = 0 AND sfa_ISLineAdjust = 0 AND sfa_ModelID = '{$rows2['bi_BusTypeID']}' 
				AND sfa_Unit = '{$rows2['bi_BusUnit']}'"; */
		$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['st_FromStationID']}' 
				AND	sfa_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= sfa_BeginDate 
				AND '{$rows2['st_NoOfRunsdate']}' <= sfa_EndDate AND sfa_NoRunsAdjust = '{$NoOfRunsID}' 
				AND	sfa_ISNoRunsAdjust = 0 AND sfa_ISLineAdjust = 0 AND sfa_ModelID = '{$rows2['bi_BusTypeID']}' 
				AND sfa_Unit = '{$rows2['bi_BusUnit']}' AND DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),
				STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))=(SELECT MIN(DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))) 
				FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID='{$rows2['st_FromStationID']}' AND sfa_GetToSiteID='{$rows2['st_ReachStationID']}' 
				AND sfa_BeginDate<='{$rows2['st_NoOfRunsdate']}' AND sfa_EndDate>='{$rows2['st_NoOfRunsdate']}' AND sfa_NoRunsAdjust='{$NoOfRunsID}' 
				AND sfa_ISUnitAdjust=1 AND sfa_ModelID='{$rows2['bi_BusTypeID']}' AND sfa_Unit='{$rows2['bi_BusUnit']}' GROUP BY 
				sfa_DepartureSiteID,sfa_GetToSiteID,sfa_NoRunsAdjust,sfa_ModelID,sfa_Unit,sfa_ISUnitAdjust)";
		$result = $class_mysql_default->my_query("$queryString");
		if(mysqli_num_rows($result) == 1) {
			$rows3 = mysqli_fetch_array($result);
			$ServiceFee = $rows3['sfa_RunPrice'];
		}
		else {
		/*	$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['st_FromStationID']}' 
					AND	sfa_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= sfa_BeginDate 
					AND '{$rows2['st_NoOfRunsdate']}' <= sfa_EndDate AND sfa_NoRunsAdjust = '{$NoOfRunsID}' 
					AND	sfa_ISNoRunsAdjust = 1 AND sfa_ISLineAdjust = 0 AND sfa_ModelID = '{$rows2['bi_BusTypeID']}'"; */
			$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['st_FromStationID']}' 
					AND	sfa_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= sfa_BeginDate 
					AND '{$rows2['st_NoOfRunsdate']}' <= sfa_EndDate AND sfa_NoRunsAdjust = '{$NoOfRunsID}' 
					AND	sfa_ISNoRunsAdjust = 1 AND sfa_ISLineAdjust = 0 AND sfa_ModelID = '{$rows2['bi_BusTypeID']}' AND 
					DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))=(SELECT 
					MIN(DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))) FROM 
					tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID='{$rows2['st_FromStationID']}' AND sfa_GetToSiteID='{$rows2['st_ReachStationID']}' 
					AND sfa_BeginDate<='{$rows2['st_NoOfRunsdate']}' AND sfa_EndDate>='{$rows2['st_NoOfRunsdate']}' AND sfa_NoRunsAdjust='{$NoOfRunsID}' 
					AND sfa_ISNoRunsAdjust=1 AND sfa_ModelID='{$rows2['bi_BusTypeID']}' 
					GROUP BY sfa_DepartureSiteID,sfa_GetToSiteID,sfa_NoRunsAdjust,sfa_ModelID,sfa_ISNoRunsAdjust)";
			$result = $class_mysql_default->my_query("$queryString");
			if(mysqli_num_rows($result) == 1) {
				$rows3 = mysqli_fetch_array($result);
				$ServiceFee = $rows3['sfa_RunPrice'];
			}
			else {
			/*	$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['st_FromStationID']}' 
						AND	sfa_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= sfa_BeginDate 
						AND '{$rows2['st_NoOfRunsdate']}' <= sfa_EndDate AND sfa_LineAdjust = '{$rows2['st_LineID']}' 
						AND sfa_ISNoRunsAdjust = 0 AND sfa_ISLineAdjust = 1 AND sfa_ModelID = '{$rows2['bi_BusTypeID']}'"; */
				$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['st_FromStationID']}' 
						AND	sfa_GetToSiteID = '{$rows2['st_ReachStationID']}' AND '{$rows2['st_NoOfRunsdate']}' >= sfa_BeginDate 
						AND '{$rows2['st_NoOfRunsdate']}' <= sfa_EndDate AND sfa_LineAdjust = '{$rows2['st_LineID']}' 
						AND sfa_ISNoRunsAdjust = 0 AND sfa_ISLineAdjust = 1 AND sfa_ModelID = '{$rows2['bi_BusTypeID']}' AND 
						DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))=(SELECT 
						MIN(DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))) 
						FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID='{$rows2['st_FromStationID']}' AND sfa_GetToSiteID='{$rows2['st_ReachStationID']}' 
						AND sfa_BeginDate<='{$rows2['st_NoOfRunsdate']}' AND sfa_EndDate>='{$rows2['st_NoOfRunsdate']}' AND sfa_LineAdjust='{$rows2['st_LineID']}' 
						AND sfa_ISLineAdjust=1 AND sfa_ModelID='{$rows2['bi_BusTypeID']}' 
						GROUP BY sfa_DepartureSiteID,sfa_GetToSiteID,sfa_NoRunsAdjust,sfa_ModelID,sfa_ISLineAdjust)";
				$result = $class_mysql_default->my_query("$queryString");
				if(mysqli_num_rows($result) == 1) {
					$rows3 = mysqli_fetch_array($result);
					$ServiceFee = $rows3['sfa_RunPrice'];
				}
			}
		}
		
		if($BalancePrice == 0 || $BalancePrice == NULL) {
			$BalancePrice = $SellPrice - $ServiceFee;
		}
		$class_mysql_default->my_query("BEGIN");
		$queryString = "INSERT `tms_chk_CheckTicket` (`ct_TicketID`, `ct_NoOfRunsID`, `ct_LineID`, `ct_NoOfRunsdate`, 
			`ct_BeginStationTime`, `ct_StopStationTime`, `ct_Distance`, `ct_BeginStationID`, `ct_BeginStation`, `ct_FromStationID`, 
			`ct_FromStation`, `ct_ReachStationID`, `ct_ReachStation`, `ct_EndStationID`, `ct_EndStation`, `ct_SellPrice`, 
			`ct_SellPriceType`, `ct_ColleSellPriceType`, `ct_TotalMan`, `ct_FullPrice`, `ct_HalfPrice`, `ct_StandardPrice`, 
			`ct_BalancePrice`, `ct_ServiceFee`, `ct_otherFee1`, `ct_otherFee2`, `ct_otherFee3`, `ct_otherFee4`, `ct_otherFee5`, 
			`ct_otherFee6`, `ct_StationID`, `ct_Station`, `ct_SellDate`, `ct_SellTime`, `ct_BusModelID`, `ct_BusModel`, 
			`ct_BusID`,`ct_BusNumber`, `ct_SeatID`, `ct_SellID`, `ct_SellName`, `ct_FreeSeats`, `ct_SafetyTicketID`, 
			`ct_SafetyTicketNumber`,`ct_SafetyTicketMoney`, `ct_SafetyTicketPassengerID`, `ct_CheckTicketWindow`, `ct_CheckerID`, 
			`ct_Checker`, `ct_CheckDate`,`ct_CheckTime`,`ct_BalanceNO`,`ct_IsBalance`) SELECT `st_TicketID`, '$NoOfRunsID', `st_LineID`, '$NoOfRunsdate', 
			`st_BeginStationTime`,`st_StopStationTime`, `st_Distance`, `st_BeginStationID`, `st_BeginStation`, `st_FromStationID`, 
			`st_FromStation`, `st_ReachStationID`, `st_ReachStation`, `st_EndStationID`, `st_EndStation`, `st_SellPrice`, 
			`st_SellPriceType`,`st_ColleSellPriceType`, `st_TotalMan`, `st_FullPrice`, `st_HalfPrice`, `st_StandardPrice`, 
			'$BalancePrice', '$ServiceFee', `st_otherFee1`, `st_otherFee2`, `st_otherFee3`,`st_otherFee4`, `st_otherFee5`, 
			`st_otherFee6`, '$userStationID','$userStationName', `st_SellDate`, `st_SellTime`, '{$rows2['bi_BusTypeID']}', '{$rows2['bi_BusType']}', 
			'{$BusID}', '{$rows2['bi_BusNumber']}', `st_SeatID`, `st_SellID`, `st_SellName`, `st_FreeSeats`, 
			`st_SafetyTicketID`, `st_SafetyTicketNumber`, `st_SafetyTicketMoney`, `st_SafetyTicketPassengerID`, 
			'$checkWindow', '$userID', '$userName', '$nowdate', '$nowtime','$BalanceNO','0' FROM tms_sell_SellTicket WHERE (st_TicketID = '$ticketID')";
		//这里需要BusID、BusNumber、BusModelID、BusModel
		$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '检票数据添加失败！'.$class_mysql_default->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		
		if($rowmode['tml_Allticket'] == "1") {
			$queryString = "UPDATE tms_chk_CheckTemp SET ct_CheckedTicketNum = ct_CheckedTicketNum + 1 
						WHERE ct_NoOfRunsID = '$NoOfRunsID'	AND ct_NoOfRunsdate = '$NoOfRunsdate' AND 
						ct_BusID = '{$BusID}' AND ct_ReportDateTime='{$ReportDateTime}'";
			$result = $class_mysql_default->my_query("$queryString");
		  	if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '检票数据更新失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
			else {
				$class_mysql_default->my_query("COMMIT");
				$retData = array('retVal' => 'SUCC', 'retString' => '检票成功！', 'NoOfRunsID' => $NoOfRunsID);
			}
		}
		else {
			$queryString = "SELECT ct_SeatID FROM tms_chk_CheckTicket WHERE (ct_TicketID = '$ticketID') 
						AND (ct_NoOfRunsID = '$NoOfRunsID') AND (ct_NoOfRunsdate = '$NoOfRunsdate')";
	  		$result = $class_mysql_default->my_query("$queryString");
	  		if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '读取座位号数据失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			} 				
			$rows = mysqli_fetch_array($result);
			$seatNo = $rows['ct_SeatID'];
			$queryString = "UPDATE tms_chk_CheckTemp SET ct_CheckedTicketNum = ct_CheckedTicketNum + 1 WHERE ct_NoOfRunsID = '$NoOfRunsID'	
							AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID='{$BusID}' AND 
							ct_ReportDateTime=(SELECT rt_ReportDateTime FROM tms_sch_Report WHERE rt_NoOfRunsID='{$NoOfRunsID}' AND 
							rt_NoOfRunsdate='{$NoOfRunsdate}' AND rt_BusID='{$BusID}' AND rt_AttemperStationID='{$userStationID}' 
							ORDER BY rt_ReportDateTime DESC LIMIT 1)";
			$result = $class_mysql_default->my_query("$queryString");
		  	if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '检票数据更新失败！', 'sql' => $queryString);
			}
			else {
				$queryString = "SELECT tml_SeatStatus FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$NoOfRunsID') 
							AND (tml_NoOfRunsdate = '$NoOfRunsdate') FOR UPDATE";
		  		$result = $class_mysql_default->my_query("$queryString");
				if(!$result) {
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '锁定票版数据表失败！', 'sql' => $queryString);
				}
				else {
					$rows = mysqli_fetch_array($result);
					$seatStatus = $rows['tml_SeatStatus'];
					if($thisnoofruns==1){
						$seatStatus = substr_replace($seatStatus, '4', $seatNo - 1, 1);
					}else{
						$seatI=stripos($seatStatus, '7')+1;
						$seatStatus = substr_replace($seatStatus, '4', stripos($seatStatus, '7'), 1);
						$updatecheck="UPDATE tms_chk_CheckTicket SET ct_SeatID='{$seatI}' WHERE ct_TicketID='$ticketID'";
						$querycheck=$class_mysql_default->my_query("$updatecheck");
						if(!$querycheck){
							$class_mysql_default->my_query("ROLLBACK");
							$retData = array('retVal' => 'FAIL', 'retString' => '更新检票数据表失败！', 'sql' => $queryString);
						}
					}
				  	$queryString = "UPDATE tms_bd_TicketMode SET tml_SeatStatus = '$seatStatus' WHERE (tml_NoOfRunsID = '$NoOfRunsID') 
				  			AND (tml_NoOfRunsdate = '$NoOfRunsdate')";	  	
				  	$result = $class_mysql_default->my_query("$queryString");
					if(!$result) {
						$class_mysql_default->my_query("ROLLBACK");
						$retData = array('retVal' => 'FAIL', 'retString' => '更新票版数据表失败！', 'sql' => $queryString);
					}
					else {
						$class_mysql_default->my_query("COMMIT");
						$retData = array('retVal' => 'SUCC', 'retString' => '检票成功！', 'NoOfRunsID' => $NoOfRunsID);
					}
				}
			}
		}
		echo json_encode($retData);
		break;
/*	case "CONFIRMPRINT":
		$NoOfRunsID = $_REQUEST['NoOfRunsID'];
		$NoOfRunsdate = $_REQUEST['NoOfRunsdate'];
		$BusID = $_REQUEST['BusID'];
		$BalanceNo = $_REQUEST['BalanceNo'];
		$EndStation = $_REQUEST['EndStation'];
		$BusUnit = $_REQUEST['BusUnit'];
		$BusNumber = $_REQUEST['BusNumber'];
		$passengerNum = $_REQUEST['passengerNum'];
		$BalanceMoney = $_REQUEST['BalanceMoney'];
		$nowtime = date('H:i:s');
		
		$class_mysql_default->my_query("BEGIN");

		$queryString = "UPDATE tms_chk_CheckTicket SET ct_BalanceNO = '$BalanceNo' WHERE (ct_NoOfRunsID = '$NoOfRunsID') 
					AND (ct_NoOfRunsdate = '$NoOfRunsdate') AND (ct_BusID = '$BusID')";
		$result = $class_mysql_default->my_query("$queryString");
	  	if(!$result) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '结算单数据更新失败！', 'sql' => $queryString);
			echo json_encode($retData);
		}
		else {
		  	$queryString = "Update tms_bd_TicketProvide SET tp_CurrentTicket = tp_CurrentTicket + 1, 
	  				tp_InceptTicketNum = tp_InceptTicketNum - 1 WHERE tp_InceptUserID = '{$userID}' 
	  				AND tp_Type = '结算单' AND tp_InceptTicketNum > 0 AND tp_CurrentTicket = '{$BalanceNo}'";
			$result = $class_mysql_default->my_query("$queryString");
		  	if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '票据更新失败！', 'sql' => $queryString);
				echo json_encode($retData);
			}
			else {
				$queryString = "UPDATE tms_chk_CheckTemp SET ct_Flag='3' WHERE ct_NoOfRunsID = '$NoOfRunsID' 
						AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID'";
				$result = $class_mysql_default->my_query("$queryString");
			  	if(!$result) {
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '检票数据更新失败！', 'sql' => $queryString);
					echo json_encode($retData);
				}
				else {
					$class_mysql_default->my_query("COMMIT");
					$query="SELECT ct_ReachStation, ct_Distance, SUM( if( ct_SellPriceType = '全票', 1, 0 ) ) AS FullNumbers, 
						SUM( if( ct_SellPriceType = '全票', 0, 1 ) ) AS HalfNumbers, ct_FullPrice, SUM(ct_SellPrice) AS AllPrice 
						FROM tms_chk_CheckTicket WHERE ct_NoOfRunsID='{$NoOfRunsID}' AND ct_NoOfRunsdate='{$NoOfRunsdate}' AND 
						ct_BusID='{ct_BusID}' AND ct_BalanceNO='{$BalanceNo}' GROUP BY ct_ReachStation";
					$result = $class_mysql_default->my_query("$query");
					if(!$result) {
						$retData = array('retVal' => 'FAIL', 'retString' => '查询检票数据失败！', 'sql' => $queryString);
						echo json_encode($retData);
					}
					while($rows4 = mysqli_fetch_array($result)){
						$retData[] = array('stationName' => $userStationName, 'NoOfRunsdate' => $NoOfRunsdate, 'NoOfRunstime' => $nowtime, 
							'BalanceNo' => $BalanceNo, 'BusUnit' => $BusUnit, 'BusNumber' => $BusNumber, 'NoOfRunsID' => $NoOfRunsID, 
							'ReachStation' => $rows4['ct_ReachStation'], 'Distance' => $rows4['ct_Distance'], 'FullNumbers' => $rows4['FullNumbers'], 
							'HalfNumbers' => $rows4['HalfNumbers'], 'FullPrice' => $rows4['ct_FullPrice'], 'AllPrice' => $rows4['AllPrice'], 'Balancer' => $userID);
					}
					echo json_encode($retData[]); 
				}
			}
		}
	//	echo json_encode($retData);		 
		break;  */
		
	case "CONFIRMPRINT":
		$opp=$_REQUEST['opp'];
		$NoOfRunsID = $_REQUEST['NoOfRunsID'];
		$NoOfRunsdate = $_REQUEST['NoOfRunsdate'];
		$BusID = $_REQUEST['BusID'];
		$BalanceNo = $_REQUEST['BalanceNo'];
		$EndStation = $_REQUEST['EndStation'];
		$BusUnit = $_REQUEST['BusUnit'];
		$BusNumber = $_REQUEST['BusNumber'];
		$passengerNum = $_REQUEST['passengerNum'];
		$BalanceMoney = $_REQUEST['BalanceMoney'];
		$sumServiceFee=$_REQUEST['sumServiceFee'];
		$sumOtherFee1=$_REQUEST['sumOtherFee1'];
		$sumOtherFee2=$_REQUEST['sumOtherFee2'];
		$sumOtherFee3=$_REQUEST['sumOtherFee3'];
		$sumOtherFee4=$_REQUEST['sumOtherFee4'];
		$sumOtherFee5=$_REQUEST['sumOtherFee5'];
		$sumOtherFee6=$_REQUEST['sumOtherFee6'];
		$sumMoney=$_REQUEST['sumMoney'];
		$Number=$_REQUEST['Number'];
		$BusModelID=$_REQUEST['BusModelID'];
		$BusModel=$_REQUEST['BusModel'];
		$ReportDateTime=$_REQUEST['ReportDateTime'];
		$ConsignMoney=$_REQUEST['ConsignMoney'];
		$error=$_REQUEST['error'];
		$oldBalanceNo=$_REQUEST['oldBalanceNo'];
		$nowtime = date('H:i:s');
		$nowdate= date('Y-m-d');
		if($opp!='reprint' || $error=='1'){
			$selectticketmodel="SELECT tml_LineID,tml_NoOfRunstime,tml_BeginstationID,tml_Beginstation,tml_EndstationID,tml_Endstation FROM tms_bd_TicketMode
				WHERE tml_NoOfRunsID='{$NoOfRunsID}' AND tml_NoOfRunsdate='{$NoOfRunsdate}'";
			$queryticketmodel=$class_mysql_default->my_query("$selectticketmodel");
			if(!$queryticketmodel) {
				$retData = array('retVal' => 'FAIL', 'retString' => '查询票版数据表失败！', 'sql' => $queryString);
				echo json_encode($retData);	
			}
			$rowticketmodel= mysqli_fetch_array($queryticketmodel);
			$class_mysql_default->my_query("BEGIN");
			if($oldBalanceNo!=''){
				if($error==1){
					$updateBalanceInHandTemp="UPDATE tms_acct_BalanceInHandTemp SET bht_State='作废已重打' WHERE bht_BalanceNO='{$oldBalanceNo}'";
				}else{
					$updateBalanceInHandTemp="UPDATE tms_acct_BalanceInHandTemp SET bht_State='注销已重打' WHERE bht_BalanceNO='{$oldBalanceNo}'";
				}
				$queryupdate=$class_mysql_default->my_query("$updateBalanceInHandTemp");
				if(!$queryupdate) {
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '结算单数据更新失败！', 'sql' => $queryString);
					echo json_encode($retData);	
				}
			}
			//正常发班的处理
			if($oldBalanceNo==''){
				$queryString = "UPDATE tms_chk_CheckTicket SET ct_BalanceNO = '$BalanceNo' WHERE (ct_NoOfRunsID = '$NoOfRunsID') 
							AND (ct_NoOfRunsdate = '$NoOfRunsdate') AND (ct_BusID = '$BusID') AND (ct_BalanceNO is NULL)";
			}else{ //处理作废和注销
				$queryString = "UPDATE tms_chk_CheckTicket SET ct_BalanceNO = '$BalanceNo' WHERE ct_BalanceNO='{$oldBalanceNo}'";
			}
			$result = $class_mysql_default->my_query("$queryString");
		  	if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '结算单数据更新失败1！', 'sql' => $queryString);
				echo json_encode($retData);	
			}
			else {
			  	$queryString = "Update tms_bd_TicketProvide SET tp_CurrentTicket = tp_CurrentTicket + 1, 
		  				tp_InceptTicketNum = tp_InceptTicketNum - 1 WHERE tp_InceptUserID = '{$userID}' 
		  				AND tp_Type = '结算单' AND tp_InceptTicketNum > 0 AND tp_CurrentTicket = '{$BalanceNo}'";
				$result = $class_mysql_default->my_query("$queryString");
			  	if(!$result) {
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '票据更新失败！', 'sql' => $queryString);
					echo json_encode($retData);	
				}
				else {
					$queryString = "UPDATE tms_chk_CheckTemp SET ct_Flag='3' WHERE ct_NoOfRunsID = '$NoOfRunsID' 
							AND ct_NoOfRunsdate = '$NoOfRunsdate' AND ct_BusID = '$BusID' AND ct_ReportDateTime='$ReportDateTime'";
					$result = $class_mysql_default->my_query("$queryString");
				  	if(!$result) {
						$class_mysql_default->my_query("ROLLBACK");
						$retData = array('retVal' => 'FAIL', 'retString' => '检票数据更新失败！', 'sql' => $queryString);
						echo json_encode($retData);	
					}
					else{
						//更新行包信息
						$updateLuggageCons="UPDATE tms_lug_LuggageCons SET lc_Status='托运中' WHERE lc_NoOfRunsID='{$NoOfRunsID}' AND lc_BusID='{$BusID}' AND 
							lc_DeliveryDate='{$NoOfRunsdate}' AND lc_Status='已收货' AND lc_StationID='{$userStationID}'";
						$resultLuggageCons = $class_mysql_default->my_query("$updateLuggageCons");
						if(!$resultLuggageCons ){
							$class_mysql_default->my_query("ROLLBACK");
							$retData = array('retVal' => 'FAIL', 'retString' => '行包数据更新失败！', 'sql' => $updateLuggageCons);
							echo json_encode($retData);
						}				
						else {
							//插入临时结算表
							$queryString="INSERT INTO tms_acct_BalanceInHandTemp (bht_BalanceNO,bht_BusID,bht_BusNumber,bht_BusUnit,bht_BusModelID,bht_BusModel,
								bht_NoOfRunsID,bht_LineID,bht_NoOfRunsdate,bht_ReportDateTime,bht_BeginStationTime,bht_StopStationTime,bht_BeginStationID,bht_BeginStation,bht_FromStationID,
								bht_FromStation,bht_EndStationID,bht_EndStation,bht_ServiceFee,bht_otherFee1,bht_otherFee2,bht_otherFee3,bht_otherFee4,bht_otherFee5,
								bht_otherFee6,bht_CheckTotal,bht_TicketTotal,bht_PriceTotal,bht_BalanceMoney,bht_ConsignMoney,bht_SupTicketRen,bht_StationID,bht_Station,bht_UserID,bht_User,bht_Date,bht_Time,bht_State) 
								VALUES('{$BalanceNo}','{$BusID}','{$BusNumber}','{$BusUnit}','{$BusModelID}','{$BusModel}','{$NoOfRunsID}','{$rowticketmodel['tml_LineID']}',
								'{$NoOfRunsdate}','{$ReportDateTime}','{$rowticketmodel['tml_NoOfRunstime']}',NULL,'{$rowticketmodel['tml_BeginstationID']}','{$rowticketmodel['tml_Beginstation']}',
								'{$userStationID}','{$userStationName}','{$rowticketmodel['tml_EndstationID']}','{$rowticketmodel['tml_Endstation']}','{$sumServiceFee}','{$sumOtherFee1}',
								'{$sumOtherFee2}','{$sumOtherFee3}','{$sumOtherFee4}','{$sumOtherFee5}','{$sumOtherFee6}','{$Number}','{$Number}','{$sumMoney}','{$BalanceMoney}','{$ConsignMoney}','{$passengerNum}',
								'{$userStationID}','{$userStationName}','{$userID}','{$userName}','{$nowdate}','{$nowtime}','正常')";
							$result = $class_mysql_default->my_query("$queryString");
							if(!$result){
								$class_mysql_default->my_query("ROLLBACK");
								$retData = array('retVal' => 'FAIL', 'retString' => '插入结算数据失败！', 'sql' => $queryString);
								echo json_encode($retData);	
							}else{
								$class_mysql_default->my_query("COMMIT");
								$querys="SELECT ct_ReachStation, ct_Distance, SUM( if( ct_SellPriceType = '全票', 1, 0 ) ) AS FullNumbers, 
									SUM( if( ct_SellPriceType = '全票', 0, 1 ) ) AS HalfNumbers, ct_FullPrice, SUM(ct_SellPrice) AS AllPrice 
									FROM tms_chk_CheckTicket WHERE ct_NoOfRunsID='{$NoOfRunsID}' AND ct_NoOfRunsdate='{$NoOfRunsdate}' AND 
									ct_BusID='{$BusID}' AND ct_BalanceNO='{$BalanceNo}' GROUP BY ct_ReachStation";
								$results = $class_mysql_default->my_query("$querys");
								if(!$results) {
									$retData = array('retVal' => 'FAIL', 'retString' => '查询检票数据失败！', 'sql' => $queryString);
									echo json_encode($retData);
								}
								$printData = "";
								while($rows4 = mysqli_fetch_array($results)){
									$printData[] = array('stationName' => $userStationName, 'NoOfRunsdate' => $NoOfRunsdate, 'NoOfRunstime' => $nowtime, 
										'BalanceNo' => $BalanceNo, 'BusUnit' => $BusUnit, 'BusNumber' => $BusNumber, 'NoOfRunsID' => $NoOfRunsID, 
										'ReachStation' => $rows4['ct_ReachStation'], 'Distance' => $rows4['ct_Distance'], 'FullNumbers' => $rows4['FullNumbers'], 
										'HalfNumbers' => $rows4['HalfNumbers'], 'FullPrice' => $rows4['ct_FullPrice'], 'AllPrice' => $rows4['AllPrice'], 
										'ConsignMoney' => $ConsignMoney, 'Balancer' => $userID);
								}
//								if(count($printData) == 0) {
//									$retData = array('retVal' => 'SUCC', 'checkedNum' => '0', 'sql' => $querys);
//									echo json_encode($retData);
//								}
//								else 
									echo json_encode($printData);
							}
						}	
					}
				}
			}
		}else{
			$querys="SELECT ct_ReachStation, ct_Distance, SUM( if( ct_SellPriceType = '全票', 1, 0 ) ) AS FullNumbers, 
				SUM( if( ct_SellPriceType = '全票', 0, 1 ) ) AS HalfNumbers, ct_FullPrice, SUM(ct_SellPrice) AS AllPrice 
				FROM tms_chk_CheckTicket WHERE ct_NoOfRunsID='{$NoOfRunsID}' AND ct_NoOfRunsdate='{$NoOfRunsdate}' AND 
				ct_BusID='{$BusID}' AND ct_BalanceNO='{$BalanceNo}' GROUP BY ct_ReachStation";
			$results = $class_mysql_default->my_query("$querys");
			if(!$results) {
				$retData = array('retVal' => 'FAIL', 'retString' => '查询检票数据失败！', 'sql' => $queryString);
				echo json_encode($retData);
			}
			$printData = "";
			while($rows4 = mysqli_fetch_array($results)){
				$printData[] = array('stationName' => $userStationName, 'NoOfRunsdate' => $NoOfRunsdate, 'NoOfRunstime' => $nowtime, 
					'BalanceNo' => $BalanceNo, 'BusUnit' => $BusUnit, 'BusNumber' => $BusNumber, 'NoOfRunsID' => $NoOfRunsID, 
					'ReachStation' => $rows4['ct_ReachStation'], 'Distance' => $rows4['ct_Distance'], 'FullNumbers' => $rows4['FullNumbers'], 
					'HalfNumbers' => $rows4['HalfNumbers'], 'FullPrice' => $rows4['ct_FullPrice'], 'AllPrice' => $rows4['AllPrice'], 
					'ConsignMoney' => $ConsignMoney, 'Balancer' => $userID);
			}
			echo json_encode($printData);
		}
	//	echo json_encode($retData);		
		break;
		
	case "GETPASSENGERINFO":
		$checkWindow = $_REQUEST['checkWindow']; //获取要检票的窗口
		$nowdate = date('Y-m-d'); //获取当前日期
		$nowtime = date('H:i:s'); //获取当前时间点
		$str1 = "旅客们请注意：请乘坐";
	    $str2 = "班次开往";
		$str3 = "方向座位号是";
		$str4 = "的旅客，赶快到";
		$str5 = "号检票口检票进站，谢谢！";
		
		$queryString = "SELECT ct_NoOfRunsID, ct_NoOfRunsdate, ct_BusID, ct_BusNumber, ct_EndStation, ct_CheckTicketWindow, ct_Allticket, ct_TotalSeats, 
				       ct_SoldTicketNum, ct_CheckedTicketNum FROM tms_chk_CheckTemp WHERE ct_CheckTicketWindow = '$checkWindow' AND ct_Flag='1' AND ct_NoOfRunsdate='$nowdate'";  //查询某检票口是否有在检车辆
	  	$result = $class_mysql_default->my_query("$queryString");
	  	if(mysqli_num_rows($result) == 0) {
			$retData = array('retVal' => 'FAIL', 'retString' => '没有在检班次！', 'sql' => $queryString); 
			echo json_encode($retData);
			exit();
		}
		while($rows = mysqli_fetch_array($result)) {
			$NoOfRunsID = $rows['ct_NoOfRunsID']; //获取班次
			$arr1 =str_split($NoOfRunsID);
			$arr1=join(",",$arr1);
			$NoOfRunsdate = $rows['ct_NoOfRunsdate'];//获取班次日期
			$EndStation = $rows['ct_EndStation']; //终点站
			$CheckTicketWindow = $rows['ct_CheckTicketWindow'];//检票口
			$queryString = "SELECT `st_TicketID`,`st_SeatID` FROM tms_sell_SellTicket 
							WHERE (st_NoOfRunsID = '$NoOfRunsID') AND (st_NoOfRunsdate = '$NoOfRunsdate')  
							AND (st_FromStation='$userStationName')
							AND st_TicketID NOT IN (SELECT ctt_TicketID FROM tms_chk_CheckTicketTemp)";
			$result2 = $class_mysql_default->my_query("$queryString");
			$seatStr = "";
			while($rows2 = mysqli_fetch_array($result2)) {
				$seatStr = $seatStr . $rows2['st_SeatID'] . ","; //拼接未检座位号
			}
			$seatStr = trim($seatStr, ","); //删除，
			//拼接字符串并将拼接的数据存入数据库表结构中
			$str = $str1 .$arr1 .$str2 .$EndStation .$str3 .$seatStr .$str4 .$CheckTicketWindow .$str5;
			$querystr="INSERT INTO tms_sch_ReportInfo(ri_info,ri_FromStation,ri_FromStationID) VALUES('$str','$userStationName','$userStationID')";
			$resultstr=$class_mysql_default->my_query($querystr);
			if(!$resultstr){
			$retData = array('retVal' => 'FAIL1', 'retString' => '插入播报信息失败！', 'sql' => $querystr); 
			echo json_encode($retData);
			exit();	
			}
		}
	
		break;
	case "withdraw":
		$BalanceNO=$_REQUEST['BalanceNO'];
		$NoOfRunsID=$_REQUEST['NoOfRunsID'];
		$NoOfRunsdate=$_REQUEST['NoOfRunsdate'];
		$BusID=$_REQUEST['BusID'];
		$update="UPDATE tms_acct_BalanceInHandTemp SET bht_State='注销未重打' WHERE bht_BalanceNO='{$BalanceNO}'";
		$query = $class_mysql_default->my_query("$update");
		if(!$query) {
			$retData = array('retVal' => 'FAIL', 'retString' => '注销结算单失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();	
		}
		$retData = array('retVal' => 'SUCC', 'retString' => '注销结算单成功！');
		echo json_encode($retData);	
		break;
	case "nullify":
		$BalanceNO=$_REQUEST['BalanceNO'];
		$NoOfRunsID=$_REQUEST['NoOfRunsID'];
		$NoOfRunsdate=$_REQUEST['NoOfRunsdate'];
		$BusID=$_REQUEST['BusID'];
		$update="UPDATE tms_acct_BalanceInHandTemp SET bht_State='作废未重打' WHERE bht_BalanceNO='{$BalanceNO}'";
		$query = $class_mysql_default->my_query("$update");
		if(!$query) {
			$retData = array('retVal' => 'FAIL', 'retString' => '作废结算单失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();	
		}
		$retData = array('retVal' => 'SUCC', 'retString' => '作废结算单成功！');
		echo json_encode($retData);	
		break;
	case "reprinte":
		$BalanceNO=$_REQUEST['BalanceNO'];
		$select="SELECT ct_BalanceNO FROM tms_chk_CheckTicket WHERE ct_BalanceNO='{$BalanceNO}'";
		$query = $class_mysql_default->my_query("$select");
		if(!$query) {
			$retData = array('retVal' => 'FAIL', 'retString' => '查询检票数据表失败！', 'sql' => $queryString);
			echo json_encode($retData);	
			exit();
		}
		if(mysqli_num_rows($query) == 0){
			$retData = array('retVal' => 'FAIL', 'retString' => '该结算单已经被重打！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();	
		} 
		$retData = array('retVal' => 'SUCC');
		echo json_encode($retData);
		break;
	case "changebus";
		$newBusNumber=$_REQUEST['newBusNumber'];
		$newBusID=$_REQUEST['newBusID'];
		$BusID=$_REQUEST['BusID'];
		$BusNumber=$_REQUEST['BusNumber'];
		$BalanceNO=$_REQUEST['BalanceNO'];
		$NoOfRunsID=$_REQUEST['NoOfRunsID'];
		$NoOfRunsdate=$_REQUEST['NoOfRunsdate'];
		$ReportDateTime=$_REQUEST['ReportDateTime'];
		$remark='报班时车辆出错，原车牌号：'.$BusNumber.'更换为车牌号：'.$newBusNumber.'；';
		$selectSafetyCheck="SELECT sc_Result FROM tms_sf_SafetyCheck WHERE sc_BusID='{$newBusID}' AND period_diff('$NoOfRunsdate',sc_CheckDate)<=1 AND 
		 	period_diff('$NoOfRunsdate',sc_CheckDate)>=0";
		$resultSafetyCheck = $class_mysql_default->my_query("$selectSafetyCheck");
		if(!$resultSafetyCheck) {
			$retData = array('retVal' => 'FAIL', 'retString' => '读取车辆安检信息失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		if(mysqli_num_rows($resultSafetyCheck)==0){
			$remark=$remark.'没安检；';
		}else{
			$rowSafetyCheck= @mysqli_fetch_array($resultSafetyCheck);
			if($rowSafetyCheck['sc_Result']=='检验不合格'){
				$remark=$remark.'安检不合格；';
			}
		}
		$selectbus="SELECT bi_BusUnit,bi_BusTypeID,bi_BusType,bi_DriverID,bi_Driver,bi_Driver1ID,bi_Driver1,bi_Driver2ID,bi_Driver2,
			bi_RoadTransport,bi_TransportationEndDate,bi_LineLicense,bi_LineLicenseAttached,bi_AttachedEndDate,
			bi_VehicleDriving,bi_VehicleDrivingEndDate FROM tms_bd_BusInfo WHERE bi_BusID='{$newBusID}'";
		$querybus=$class_mysql_default->my_query("$selectbus");
		if(!$querybus) {
			$retData = array('retVal' => 'FAIL', 'retString' => '读取车辆信息失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$rowbus=mysqli_fetch_array($querybus);
		if($rowbus['bi_RoadTransport']==''){
			$remark=$remark.'无道路运输证；';
		}else{
			if((strtotime( $rowbus['bi_TransportationEndDate'])-strtotime(date('Y-m-d')))/3600/24<0){
				$remark=$remark.'道路运输证过期；';
			}
		}
		if($rowbus['bi_LineLicense']=='' && $rowbus['bi_LineLicenseAttached']==''){
			$remark=$remark.'无线路牌；';
		}else{
			if((strtotime( $rowbus['bi_AttachedEndDate'])-strtotime(date('Y-m-d')))/3600/24<0){
				$remark=$remark.'线路牌过期；';
			}
		}
		if($rowbus['bi_VehicleDriving']==''){
			$remark=$remark.'无车辆行驶证；';
		}else{
			if((strtotime( $rowbus['bi_VehicleDrivingEndDate'])-strtotime(date('Y-m-d')))/3600/24<0){
				$remark=$remark.'车辆行驶证过期；';
			}
		}
		$driver = $rowbus['bi_DriverID'];
		$strsqlselet="SELECT di_DriverID, di_Name,di_CYZGZNumber,di_DriverCard,di_DriverCheckDate,di_CYZGZCheckDate FROM tms_bd_DriverInfo WHERE di_DriverID='$driver'";
		$resultselet = $class_mysql_default->my_query("$strsqlselet");
		$rowsd = @mysqli_fetch_array($resultselet);
		$remarkdriver=$rowsd['di_Name'].'('.$rowsd['di_DriverID'].')';
		if($rowsd['di_CYZGZNumber']==''){
			$remarkdriver=$remarkdriver.'无从业资格证；';
		}else{
			if((strtotime( $rowsd['di_CYZGZCheckDate'])-strtotime(date('Y-m-d')))/3600/24<0){
				$remarkdriver=$remarkdriver.'从业资格证过期；';
			}
		}
		if($rowsd['di_DriverCard']==''){
			$remarkdriver=$remarkdriver.'无驾照；';
		}else{
			if((strtotime( $rowsd['di_DriverCheckDate'])-strtotime(date('Y-m-d')))/3600/24<0){
				$remarkdriver=$remarkdriver.'驾照过期；';
			}
		}
		if($remarkdriver!=$rowsd['di_Name'].'('.$rowsd['di_DriverID'].')'){
			$remark=$remark.$remarkdriver;
		}
		// 副驾驶员1信息
		$driver = $rowbus['bi_Driver1ID'];
		$strsqlselet="SELECT di_DriverID, di_Name,di_CYZGZNumber,di_DriverCard,di_DriverCheckDate,di_CYZGZCheckDate FROM tms_bd_DriverInfo WHERE di_DriverID='$driver'";
		$resultselet = $class_mysql_default->my_query("$strsqlselet");
		$rowsd1 = @mysqli_fetch_array($resultselet);
		$remarkdriver1=$rowsd1['di_Name'].'('.$rowsd1['di_DriverID'].')';
		if($driver!=''){
			if($rowsd1['di_CYZGZNumber']==''){
				$remarkdriver1=$remarkdriver1.'无从业资格证；';
			}else{
				if((strtotime( $rowsd1['di_CYZGZCheckDate'])-strtotime(date('Y-m-d')))/3600/24<0){
					$remarkdriver1=$remarkdriver1.'从业资格证过期；';
				}
			}
			if($rowsd1['di_DriverCard']==''){
				$remarkdriver1=$remarkdriver1.'无驾照；';
			}else{
				if((strtotime( $rowsd1['di_DriverCheckDate'])-strtotime(date('Y-m-d')))/3600/24<0){
					$remarkdriver1=$remarkdriver1.'驾照过期；';
				}
			}
		}
		if($remarkdriver1!=$rowsd1['di_Name'].'('.$rowsd1['di_DriverID'].')'){
			$remark=$remark.$remarkdriver1;
		}		
		// 副驾驶员2信息
		$driver = $rowbus['bi_Driver2ID'];
		$strsqlselet="SELECT di_DriverID, di_Name,di_CYZGZNumber,di_DriverCard,di_DriverCheckDate,di_CYZGZCheckDate FROM tms_bd_DriverInfo WHERE di_DriverID='$driver'";
		$resultselet = $class_mysql_default->my_query("$strsqlselet");
		$rowsd2 = @mysqli_fetch_array($resultselet);
		$remarkdriver2=$rowsd2['di_Name'].'('.$rowsd2['di_DriverID'].')';
		if($driver!=''){
			if($rowsd2['di_CYZGZNumber']==''){
				$remarkdriver2=$remarkdriver2.'无从业资格证；';
			}else{
				if((strtotime( $rowsd2['di_CYZGZCheckDate'])-strtotime(date('Y-m-d')))/3600/24<0){
					$remarkdriver2=$remarkdriver2.'从业资格证过期；';
				}
			}
			if($rowsd2['di_DriverCard']==''){
				$remarkdriver2=$remarkdriver2.'无驾照；';
			}else{
				if((strtotime( $rowsd2['di_DriverCheckDate'])-strtotime(date('Y-m-d')))/3600/24<0){
					$remarkdriver2=$remarkdriver2.'驾照过期；';
				}
			}
		}
		if($remarkdriver2!=$rowsd2['di_Name'].'('.$rowsd2['di_DriverID'].')'){
			$remark=$remark.$remarkdriver2;
		}	
		//检查报班车辆是否与票版中车辆一致
	//	$selectmodel="SELECT tml_BusModelID,tml_BusUnit FROM tms_bd_TicketMode WHERE tml_NoOfRunsID='{$NoOfRunsID}' AND tml_NoOfRunsdate='{$NoOfRunsdate}'";
	//	$querymode=$class_mysql_default->my_query("$selectmodel");
	//	$rowmode= mysqli_fetch_array($querymode);		
		$class_mysql_default->my_query("BEGIN");
		// 取得即时结算价和服务费（因为车辆在调度和检票时可能会发生改变）：首先读取售票表数据；再检查班次调价表和服务费调价表（按协议调价、
		// 班次调价、线路调价的优先级顺序），如有记录，则更新从售票表取得的数据；如无，则取售票表中的数据。
		// 如果没有输入结算价，则用售票价减去站务费做为结算价
		$queryString = "SELECT `ct_TicketID`, `ct_LineID`, `ct_NoOfRunsdate`, `ct_FromStationID`, `ct_FromStation`, `ct_ReachStationID`, 
			`ct_ReachStation`, `ct_SellPrice`, `ct_BalancePrice`, `ct_ServiceFee`, `ct_BusModelID`,`ct_BusModel`,`ct_BusID`,`ct_BusNumber`,
			`bi_BusUnit` FROM tms_chk_CheckTicket LEFT OUTER JOIN tms_bd_BusInfo ON bi_BusID=ct_BusID WHERE ct_BalanceNO= '$BalanceNO'";
		$resultck = $class_mysql_default->my_query("$queryString");
		if(!$resultck) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '读取检票信息失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		while($rows2 = mysqli_fetch_array($resultck)){
			$SellPrice = $rows2['ct_SellPrice'];
		//	$BalancePrice = $rows2['ct_BalancePrice'];
			$ServiceFee = $rows2['ct_ServiceFee'];
			$TicketID=$rows2['ct_TicketID'];
			//检查报班车辆是否与票版中车辆一致
			if($rows2['ct_BusModelID']==$rowbus['bi_BusTypeID'] && $rows2['bi_BusUnit']==$rowbus['bi_BusUnit']){
				$BalancePrice = $rows2['ct_BalancePrice'];
			}else{
				$BalancePrice=0;
			/*	$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['ct_FromStationID']}' 
						AND	nrap_GetToSiteID = '{$rows2['ct_ReachStationID']}' AND '{$rows2['ct_NoOfRunsdate']}' >= nrap_BeginDate 
						AND '{$rows2['ct_NoOfRunsdate']}' <= nrap_EndDate AND nrap_NoRunsAdjust = '{$NoOfRunsID}' 
						AND	nrap_ISNoRunsAdjust = 0 AND nrap_ISLineAdjust = 0 AND nrap_ModelID = '{$rowbus['bi_BusTypeID']}' 
						AND nrap_Unit = '{$rowbus['bi_BusUnit']}'"; */
				$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['ct_FromStationID']}' 
					AND	nrap_GetToSiteID = '{$rows2['ct_ReachStationID']}' AND '{$rows2['ct_NoOfRunsdate']}' >= nrap_BeginDate 
					AND '{$rows2['ct_NoOfRunsdate']}' <= nrap_EndDate AND nrap_NoRunsAdjust = '{$NoOfRunsID}' 
					AND	nrap_ISNoRunsAdjust = 0 AND nrap_ISLineAdjust = 0 AND nrap_ModelID = '{$rowbus['bi_BusTypeID']}' 
					AND nrap_Unit = '{$rowbus['bi_BusUnit']}' AND DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),
					STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))=(SELECT MIN(DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))) 
					FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rows2['ct_FromStationID']}' AND nrap_GetToSiteID='{$rows2['ct_ReachStationID']}' 
					AND nrap_BeginDate<='{$rows2['ct_NoOfRunsdate']}' AND nrap_EndDate>='{$rows2['ct_NoOfRunsdate']}' AND nrap_NoRunsAdjust='{$NoOfRunsID}' 
					AND nrap_ISUnitAdjust=1 AND nrap_ModelID='{$rowbus['bi_BusTypeID']}' AND nrap_Unit='{$rowbus['bi_BusUnit']}' GROUP BY 
					nrap_DepartureSiteID,nrap_GetToSiteID,nrap_NoRunsAdjust,nrap_ModelID,nrap_Unit,nrap_ISUnitAdjust)";
				$result = $class_mysql_default->my_query("$queryString");
				if(mysqli_num_rows($result) == 1) {
					$rows3 = mysqli_fetch_array($result);
					$BalancePrice = $rows3['nrap_BalancePrice'];
				}
				else {
				/*	$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['ct_FromStationID']}' 
							AND	nrap_GetToSiteID = '{$rows2['ct_ReachStationID']}' AND '{$rows2['ct_NoOfRunsdate']}' >= nrap_BeginDate 
							AND '{$rows2['ct_NoOfRunsdate']}' <= nrap_EndDate AND nrap_NoRunsAdjust = '{$NoOfRunsID}' 
							AND	nrap_ISNoRunsAdjust = 1 AND nrap_ISLineAdjust = 0 AND nrap_ModelID = '{$rowbus['bi_BusTypeID']}'"; */
					$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['ct_FromStationID']}' 
						AND	nrap_GetToSiteID = '{$rows2['ct_ReachStationID']}' AND '{$rows2['ct_NoOfRunsdate']}' >= nrap_BeginDate 
						AND '{$rows2['ct_NoOfRunsdate']}' <= nrap_EndDate AND nrap_NoRunsAdjust = '{$NoOfRunsID}' 
						AND	nrap_ISNoRunsAdjust = 1 AND nrap_ISLineAdjust = 0 AND nrap_ModelID = '{$rowbus['bi_BusTypeID']}' AND 
						DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))=(SELECT 
						MIN(DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))) FROM 
						tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rows2['ct_FromStationID']}' AND nrap_GetToSiteID='{$rows2['ct_ReachStationID']}' 
						AND nrap_BeginDate<='{$rows2['ct_NoOfRunsdate']}' AND nrap_EndDate>='{$rows2['ct_NoOfRunsdate']}' AND nrap_NoRunsAdjust='{$NoOfRunsID}' 
						AND nrap_ISNoRunsAdjust=1 AND nrap_ModelID='{$rowbus['bi_BusTypeID']}' 
						GROUP BY nrap_DepartureSiteID,nrap_GetToSiteID,nrap_NoRunsAdjust,nrap_ModelID,nrap_ISNoRunsAdjust)";
					$result = $class_mysql_default->my_query("$queryString");
					if(mysqli_num_rows($result) == 1) {
						$rows3 = mysqli_fetch_array($result);
						$BalancePrice = $rows3['nrap_BalancePrice'];
					}
					else {
					/*	$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['ct_FromStationID']}' 
								AND	nrap_GetToSiteID = '{$rows2['ct_ReachStationID']}' AND '{$rows2['ct_NoOfRunsdate']}' >= nrap_BeginDate 
								AND '{$rows2['ct_NoOfRunsdate']}' <= nrap_EndDate AND nrap_LineAdjust = '{$rows2['ct_LineID']}' 
								AND nrap_ISNoRunsAdjust = 0 AND nrap_ISLineAdjust = 1 AND nrap_ModelID = '{$rowbus['bi_BusTypeID']}'";  */
						$queryString = "SELECT nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID = '{$rows2['ct_FromStationID']}' 
							AND	nrap_GetToSiteID = '{$rows2['ct_ReachStationID']}' AND '{$rows2['ct_NoOfRunsdate']}' >= nrap_BeginDate 
							AND '{$rows2['ct_NoOfRunsdate']}' <= nrap_EndDate AND nrap_LineAdjust = '{$rows2['ct_LineID']}' 
							AND nrap_ISNoRunsAdjust = 0 AND nrap_ISLineAdjust = 1 AND nrap_ModelID = '{$rowbus['bi_BusTypeID']}' AND 
							DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))=(SELECT 
							MIN(DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))) 
							FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rows2['ct_FromStationID']}' AND nrap_GetToSiteID='{$rows2['ct_ReachStationID']}' 
							AND nrap_BeginDate<='{$rows2['ct_NoOfRunsdate']}' AND nrap_EndDate>='{$rows2['ct_NoOfRunsdate']}' AND nrap_LineAdjust='{$rows2['ct_LineID']}' 
							AND nrap_ISLineAdjust=1 AND nrap_ModelID='{$rowbus['bi_BusTypeID']}' 
							GROUP BY nrap_DepartureSiteID,nrap_GetToSiteID,nrap_NoRunsAdjust,nrap_ModelID,nrap_ISLineAdjust)";
						$result = $class_mysql_default->my_query("$queryString");
						if(mysqli_num_rows($result) == 1) {
							$rows3 = mysqli_fetch_array($result);
							$BalancePrice = $rows3['nrap_BalancePrice'];
						}
					}
				}
			}
		/*	$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['ct_FromStationID']}' 
					AND	sfa_GetToSiteID = '{$rows2['ct_ReachStationID']}' AND '{$rows2['ct_NoOfRunsdate']}' >= sfa_BeginDate 
					AND '{$rows2['ct_NoOfRunsdate']}' <= sfa_EndDate AND sfa_NoRunsAdjust = '{$NoOfRunsID}' 
					AND	sfa_ISNoRunsAdjust = 0 AND sfa_ISLineAdjust = 0 AND sfa_ModelID = '{$rowbus['bi_BusTypeID']}' 
					AND sfa_Unit = '{$rowbus['bi_BusUnit']}'"; */
			$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['ct_FromStationID']}' 
				AND	sfa_GetToSiteID = '{$rows2['ct_ReachStationID']}' AND '{$rows2['ct_NoOfRunsdate']}' >= sfa_BeginDate 
				AND '{$rows2['ct_NoOfRunsdate']}' <= sfa_EndDate AND sfa_NoRunsAdjust = '{$NoOfRunsID}' 
				AND	sfa_ISNoRunsAdjust = 0 AND sfa_ISLineAdjust = 0 AND sfa_ModelID = '{$rowbus['bi_BusTypeID']}' 
				AND sfa_Unit = '{$rowbus['bi_BusUnit']}' AND DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),
				STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))=(SELECT MIN(DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))) 
				FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID='{$rows2['ct_FromStationID']}' AND sfa_GetToSiteID='{$rows2['ct_ReachStationID']}' 
				AND sfa_BeginDate<='{$rows2['ct_NoOfRunsdate']}' AND sfa_EndDate>='{$rows2['ct_NoOfRunsdate']}' AND sfa_NoRunsAdjust='{$NoOfRunsID}' 
				AND sfa_ISUnitAdjust=1 AND sfa_ModelID='{$rowbus['bi_BusTypeID']}' AND sfa_Unit='{$rowbus['bi_BusUnit']}' GROUP BY 
				sfa_DepartureSiteID,sfa_GetToSiteID,sfa_NoRunsAdjust,sfa_ModelID,sfa_Unit,sfa_ISUnitAdjust)";
			$result = $class_mysql_default->my_query("$queryString");
			if(mysqli_num_rows($result) == 1) {
				$rows3 = mysqli_fetch_array($result);
				$ServiceFee = $rows3['sfa_RunPrice'];
			}
			else {
			/*	$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['ct_FromStationID']}' 
						AND	sfa_GetToSiteID = '{$rows2['ct_ReachStationID']}' AND '{$rows2['ct_NoOfRunsdate']}' >= sfa_BeginDate 
						AND '{$rows2['ct_NoOfRunsdate']}' <= sfa_EndDate AND sfa_NoRunsAdjust = '{$NoOfRunsID}' 
						AND	sfa_ISNoRunsAdjust = 1 AND sfa_ISLineAdjust = 0 AND sfa_ModelID = '{$rowbus['bi_BusTypeID']}'"; */
				$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['ct_FromStationID']}' 
					AND	sfa_GetToSiteID = '{$rows2['ct_ReachStationID']}' AND '{$rows2['ct_NoOfRunsdate']}' >= sfa_BeginDate 
					AND '{$rows2['ct_NoOfRunsdate']}' <= sfa_EndDate AND sfa_NoRunsAdjust = '{$NoOfRunsID}' 
					AND	sfa_ISNoRunsAdjust = 1 AND sfa_ISLineAdjust = 0 AND sfa_ModelID = '{$rowbus['bi_BusTypeID']}' AND 
					DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))=(SELECT 
					MIN(DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))) FROM 
					tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID='{$rows2['ct_FromStationID']}' AND sfa_GetToSiteID='{$rows2['ct_ReachStationID']}' 
					AND sfa_BeginDate<='{$rows2['ct_NoOfRunsdate']}' AND sfa_EndDate>='{$rows2['ct_NoOfRunsdate']}' AND sfa_NoRunsAdjust='{$NoOfRunsID}' 
					AND sfa_ISNoRunsAdjust=1 AND sfa_ModelID='{$rowbus['bi_BusTypeID']}' 
					GROUP BY sfa_DepartureSiteID,sfa_GetToSiteID,sfa_NoRunsAdjust,sfa_ModelID,sfa_ISNoRunsAdjust)";
				$result = $class_mysql_default->my_query("$queryString");
				if(mysqli_num_rows($result) == 1) {
					$rows3 = mysqli_fetch_array($result);
					$ServiceFee = $rows3['sfa_RunPrice'];
				}
				else {
				/*	$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['ct_FromStationID']}' 
							AND	sfa_GetToSiteID = '{$rows2['ct_ReachStationID']}' AND '{$rows2['ct_NoOfRunsdate']}' >= sfa_BeginDate 
							AND '{$rows2['ct_NoOfRunsdate']}' <= sfa_EndDate AND sfa_LineAdjust = '{$rows2['ct_LineID']}' 
							AND sfa_ISNoRunsAdjust = 0 AND sfa_ISLineAdjust = 1 AND sfa_ModelID = '{$rowbus['bi_BusTypeID']}'"; */
					$queryString = "SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID = '{$rows2['ct_FromStationID']}' 
						AND	sfa_GetToSiteID = '{$rows2['ct_ReachStationID']}' AND '{$rows2['ct_NoOfRunsdate']}' >= sfa_BeginDate 
						AND '{$rows2['ct_NoOfRunsdate']}' <= sfa_EndDate AND sfa_LineAdjust = '{$rows2['ct_LineID']}' 
						AND sfa_ISNoRunsAdjust = 0 AND sfa_ISLineAdjust = 1 AND sfa_ModelID = '{$rowbus['bi_BusTypeID']}' AND 
						DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))=(SELECT 
						MIN(DATEDIFF(STR_TO_DATE(sfa_EndDate,'%Y-%c-%d'),STR_TO_DATE(sfa_BeginDate,'%Y-%c-%d'))) 
						FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID='{$rows2['ct_FromStationID']}' AND sfa_GetToSiteID='{$rows2['ct_ReachStationID']}' 
						AND sfa_BeginDate<='{$rows2['st_NoOfRunsdate']}' AND sfa_EndDate>='{$rows2['st_NoOfRunsdate']}' AND sfa_LineAdjust='{$rows2['ct_LineID']}' 
						AND sfa_ISLineAdjust=1 AND sfa_ModelID='{$rowbus['bi_BusTypeID']}' 
						GROUP BY sfa_DepartureSiteID,sfa_GetToSiteID,sfa_NoRunsAdjust,sfa_ModelID,sfa_ISLineAdjust)";
					$result = $class_mysql_default->my_query("$queryString");
					if(mysqli_num_rows($result) == 1) {
						$rows3 = mysqli_fetch_array($result);
						$ServiceFee = $rows3['sfa_RunPrice'];
					}
				}
			}
			
			if($BalancePrice == 0 || $BalancePrice == NULL) {
				$BalancePrice = $SellPrice - $ServiceFee;
			} 
			$updatecheckt="UPDATE tms_chk_CheckTicket SET ct_BalancePrice='{$BalancePrice}',ct_ServiceFee='{$ServiceFee}',ct_BusModelID='{$rowbus['bi_BusTypeID']}',
				ct_BusModel='{$rowbus['bi_BusType']}',ct_BusID='{$newBusID}',ct_BusNumber='{$newBusNumber}' WHERE ct_TicketID='{$TicketID}'";
			$queryupdatecheckt=$class_mysql_default->my_query("$updatecheckt"); 
		//	$ss=$ss.$TicketID;
			if(!$queryupdatecheckt){
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '更新检票信息失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			} 
		}
		$updatert="UPDATE tms_sch_Report SET rt_BusID='{$newBusID}',rt_BusCard='{$newBusNumber}',rt_BusModelID='{$rowbus['bi_BusTypeID']}',rt_BusModel='{$rowbus['bi_BusType']}',
			rt_DriverID='{$rowbus['bi_DriverID']}',rt_Driver='{$rowbus['bi_Driver']}',rt_Driver1ID='{$rowbus['bi_Driver1ID']}',rt_Driver1='{$rowbus['bi_Driver1']}',
			rt_Driver2ID='{$rowbus['bi_Driver2ID']}',rt_Driver2='{$rowbus['bi_Driver2']}',rt_Remark='{$remark}' WHERE rt_NoOfRunsID='{$NoOfRunsID}' AND 
			rt_NoOfRunsdate='{$NoOfRunsdate}' AND rt_BusID='{$BusID}' AND rt_ReportDateTime='{$ReportDateTime}' AND 
			(rt_AttemperStationID='{$userStationID}' OR rt_AttemperStationID='all')";
		$queryrt=$class_mysql_default->my_query($updatert);
		if(!$queryrt){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新调度信息失败！'.$class_mysql_default->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$updatect="UPDATE tms_chk_CheckTemp SET ct_BusID='{$newBusID}',ct_BusNumber='{$newBusNumber}'
			WHERE ct_NoOfRunsID='{$NoOfRunsID}' AND ct_NoOfRunsdate='{$NoOfRunsdate}' AND ct_BusID='{$BusID}' AND ct_ReportDateTime='{$ReportDateTime}' AND 
			ct_UserID IN (SELECT ui_UserID FROM tms_sys_UsInfor WHERE ui_UserSationID='{$userStationID}'OR ui_UserSationID='all')";
		$queryct=$class_mysql_default->my_query("$updatect");
		if(!$queryct){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新车辆检票信息失败！'.$class_mysql_default->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}   
		$class_mysql_default->my_query("COMMIT");
		$retData = array('retVal' => 'SUCC', 'retString' => '更新车辆成功！','newBusNumber'=>$newBusNumber,'newBusID'=>$newBusID);
		echo json_encode($retData);
		break;
	default:
}
?>
