<?
//调度操作界面

//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$op = $_REQUEST['op'];
switch ($op)
{
	case "REFRESH":
		$schStation = $_REQUEST['schStation'];
		$schDate = $_REQUEST['schDate'];
		$BusUnit = $_REQUEST['BusUnit'];
		$LineName=$_REQUEST['LineName'];
		$BeginTime = $_REQUEST['BeginTime'];
		$EndTime = $_REQUEST['EndTime'];
		$noofrunStatus = $_REQUEST['noofrunStatus'];
		$checkboxStatus = $_REQUEST['checkboxStatus'];
		$configFileName = $_REQUEST['configFileName'];
		
		$fp = fopen($configFileName, 'w');
		if(!$fp) {
			fclose($fp);
			$retData = array('retVal' => 'FAIL', 'retString' => '打开文件失败！');
			echo json_encode($retData);
			exit();
		}
		$retVal = fwrite($fp, "<?\r\n\$schStation='$schStation';\r\n");
		$retVal = fwrite($fp, "\$schDate='$schDate';\r\n");
		$retVal = fwrite($fp, "\$LineName='$LineName';\r\n");
		$retVal = fwrite($fp, "\$BusUnit='$BusUnit';\r\n");
		$retVal = fwrite($fp, "\$BeginTime='$BeginTime';\r\n");
		$retVal = fwrite($fp, "\$EndTime='$EndTime';\r\n");
		$retVal = fwrite($fp, "\$noofrunStatus='$noofrunStatus';\r\n");
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
	case "GETLINE";
		$LineName=$_REQUEST['LineName'];
		$Station=$_REQUEST['station']; //起点是本站
		$selectlinename="SELECT li_LineName,sset_SiteName FROM tms_bd_LineInfo LEFT OUTER JOIN tms_bd_SiteSet ON sset_HelpCode LIKE '{$LineName}%' WHERE li_LineName LIKE CONCAT('%','{$Station}','--',sset_SiteName) and li_Linestate='正常'";
		$resultlinename = $class_mysql_default->my_query("$selectlinename");
		while($rowlinename=mysqli_fetch_array($resultlinename)){
		$retData[] = array(
			'LineName' => $rowlinename['li_LineName']);
		}
		echo json_encode($retData);
		break;	
	case "GETLINE1"; //支持中间站点查询问题
		$LineName=$_REQUEST['LineName'];
		$Station=$_REQUEST['station']; //起点是本站
		$noofrunsdate=$_REQUEST['noofrunsdate'];
		$selectlinename="SELECT li_LineName,sset_SiteName FROM tms_bd_LineInfo 
		LEFT OUTER JOIN tms_bd_SiteSet ON sset_HelpCode LIKE '{$LineName}%' 
		LEFT OUTER JOIN tms_bd_TicketMode ON li_LineID=tml_LineID AND tml_NoOfRunsdate='$noofrunsdate'
		LEFT OUTER JOIN tms_bd_PriceDetail ON tml_NoOfRunsID=pd_NoOfRunsID AND tml_NoOfRunsdate=pd_NoOfRunsdate AND pd_FromStation LIKE '{$Station}%'
		WHERE li_LineName LIKE CONCAT('%','--',sset_SiteName) AND pd_FromStation LIKE '{$Station}%' AND  li_Linestate='正常' AND tml_NoOfRunsdate='$noofrunsdate'
		GROUP BY li_LineID";
		$resultlinename = $class_mysql_default->my_query("$selectlinename");
		while($rowlinename=mysqli_fetch_array($resultlinename)){
		$retData[] = array(
			'LineName' => $rowlinename['li_LineName']);
		}
		echo json_encode($retData);
		break;
		case "GETLINE2"; //客评线路查询处理
		$LineName=$_REQUEST['LineName'];
		$Station=$_REQUEST['station']; //起点是本站
		$checkinerID=$_REQUEST['checkinerID'];//检票员
		$noofrunsdate=$_REQUEST['noofrunsdate'];
		$selectlinename="SELECT li_LineName,sset_SiteName FROM tms_bd_LineInfo 
		LEFT OUTER JOIN tms_bd_SiteSet ON sset_HelpCode LIKE '{$LineName}%' 
		LEFT OUTER JOIN tms_acct_BalanceInHandTemp on li_LineID=bht_LineID AND bht_UserID like '$checkinerID%'
		WHERE  li_LineName LIKE CONCAT('%','--',sset_SiteName) AND bht_Station like '$Station' AND li_Linestate='正常'  GROUP BY bht_LineID";
		$resultlinename = $class_mysql_default->my_query("$selectlinename");
		while($rowlinename=mysqli_fetch_array($resultlinename)){
		$retData[] = array(
			'LineName' => $rowlinename['li_LineName']);
		}
		echo json_encode($retData);
		break;
	case "GETLINEEND"; //
		$LineName=$_REQUEST['LineName'];
		$Station=$_REQUEST['station'];
		$selectlinename="SELECT li_LineName,li_LineID,li_BeginSiteID,li_BeginSite,li_EndSiteID,li_EndSite, sset_SiteName FROM tms_bd_LineInfo LEFT OUTER JOIN tms_bd_SiteSet ON sset_HelpCode LIKE '{$LineName}%' WHERE li_LineName LIKE CONCAT('%','--',sset_SiteName) and li_Linestate='正常'".$Station;
		$resultlinename = $class_mysql_default->my_query("$selectlinename");
		while($rowlinename=mysqli_fetch_array($resultlinename)){
		$retData[] = array(
			'LineName' => $rowlinename['li_LineName'],'LineID' => $rowlinename['li_LineID'],'BeginSiteID' => $rowlinename['li_BeginSiteID'],
		    'BeginSite' => $rowlinename['li_BeginSite'],'EndSiteID' => $rowlinename['li_EndSiteID'],'EndSite' => $rowlinename['li_EndSite']);
		}
		echo json_encode($retData);
		break;	
	case "GETBUSINFOBYBUSID":
		$bi_BusID = $_REQUEST['busID'];
		$NoOfRunsdate = $_REQUEST['NoOfRunsdate'];
		$sc_CheckDate = date('Y-m-d');
		$BegionStation=$_REQUEST['BegionStation'];
		$thisStation=$_REQUEST['thisStation'];
		$NoOfRunsID1=$_REQUEST['NoOfRunsID'];
		$nextReport=1;
		$nextbus=1;
		$queryString = "SELECT bi_BusID,bi_BusNumber,bi_BusType,bi_ManagementLine,bi_SeatS,bi_AllowHalfSeats FROM tms_bd_BusInfo WHERE bi_BusID = '{$bi_BusID}'";
		$result = $class_mysql_default->my_query("$queryString");
		$row = mysqli_fetch_array($result);
		
		$queryString = "SELECT sc_Result FROM tms_sf_SafetyCheck WHERE sc_BusCard='{$row['bi_BusNumber']}' AND sc_CheckDate='{$sc_CheckDate}'";
		$result = $class_mysql_default->my_query("$queryString");
		$row1 = mysqli_fetch_array($result);
		if($BegionStation!=$thisStation){
		/*	$Select="SELECT rt_BusID,rt_Register FROM tms_sch_Report WHERE rt_NoOfRunsID='{$NoOfRunsID1}' AND rt_NoOfRunsdate='{$NoOfRunsdate}' AND 
				rt_BusID='{$bi_BusID}' AND rt_AttemperStationID=(SELECT ndst_SiteID FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID1}' AND 
				ndst_NoOfRunsdate='{$NoOfRunsdate}' AND ndst_ID=(SELECT MAX(ndst_ID) FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID1}' AND
				ndst_NoOfRunsdate='{$NoOfRunsdate}' AND ndst_CheckInSite=1 AND ndst_ID<(SELECT ndst_ID FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID1}' AND
				ndst_NoOfRunsdate='{$NoOfRunsdate}' AND ndst_SiteName='{$thisStation}') GROUP BY ndst_NoOfRunsID,ndst_NoOfRunsdate))"; */
			$Select="SELECT rt_BusID,rt_Register FROM tms_sch_Report WHERE rt_NoOfRunsID='{$NoOfRunsID1}' AND rt_NoOfRunsdate='{$NoOfRunsdate}' AND 
				rt_BusID='{$bi_BusID}' AND rt_AttemperStationID=(SELECT ndst_SiteID FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID1}' AND 
				ndst_NoOfRunsdate='{$NoOfRunsdate}' AND ndst_ID=(SELECT MAX(ndst_ID) FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID1}' AND
				ndst_NoOfRunsdate='{$NoOfRunsdate}' AND ndst_CheckInSite=1 AND ndst_ID<(SELECT ndst_ID FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID1}' AND
				ndst_NoOfRunsdate='{$NoOfRunsdate}' AND ndst_SiteName='{$thisStation}') GROUP BY ndst_NoOfRunsID,ndst_NoOfRunsdate))";
			$querySelect=$class_mysql_default->my_query("$Select");
			$rowSelect=mysqli_fetch_array($querySelect);
			if($rowSelect['rt_Register']!='已发车'){
				$nextReport=0;
			}else{
				$nextReport=1;
			}
			if($rowSelect['rt_BusID']!=$bi_BusID){
				$nextbus=0;
			}else{
				$nextbus=1;
			}
		}
		//一辆车不能报相同的班
	/*	$query ="SELECT tml_AllowSell,tml_StopRun,rt_NoOfRunsID,tml_Allticket,rt_Register FROM tms_sch_Report LEFT OUTER JOIN tms_bd_TicketMode 
			    ON tml_NoOfRunsID = rt_NoOfRunsID AND tml_NoOfRunsdate = rt_NoOfRunsdate 
			    WHERE tml_NoOfRunsdate = '$NoOfRunsdate' AND     
			    tml_StopRun !='1' AND rt_BusID='$bi_BusID' ORDER BY rt_Register DESC"; */
		$query ="SELECT tml_AllowSell,tml_StopRun,rt_NoOfRunsID,tml_Allticket,rt_Register,ct_Flag FROM tms_sch_Report 
				LEFT OUTER JOIN tms_bd_TicketMode ON tml_NoOfRunsID = rt_NoOfRunsID AND tml_NoOfRunsdate = rt_NoOfRunsdate
				LEFT OUTER JOIN tms_chk_CheckTemp ON ct_NoOfRunsID=rt_NoOfRunsID AND ct_NoOfRunsdate=rt_NoOfRunsdate AND ct_BusID=rt_BusID AND ct_ReportDateTime=rt_ReportDateTime
			    WHERE tml_NoOfRunsdate = '$NoOfRunsdate' AND rt_BusID='$bi_BusID' AND rt_AttemperStation='{$thisStation}' ORDER BY rt_Register DESC";
		$result1 = $class_mysql_default->my_query("$query");
		if(!mysqli_num_rows($result1)) {
			$NoOfRunsID = '';
		}
		else{
			$row2 = mysqli_fetch_array($result1);
			if($row2['rt_Register'] == '已发车'){
				$NoOfRunsID = '';
			}
			else{
				$NoOfRunsID = $row2['rt_NoOfRunsID'];
			/*	if($row2['tml_AllowSell']==0 && $row2['tml_StopRun']==0) $curStatus = '暂停'; 
				if($row2['tml_AllowSell']==1 && $row2['tml_StopRun']==0) $curStatus = '在售';  
				if($row2['tml_StopRun']==2) $curStatus = '检票'; 
				if($row2['tml_StopRun']==3) $curStatus = '并班'; */
				if($row2['tml_AllowSell']==0 && $row2['tml_StopRun']==0)  $curStatus = '暂停'; 
				if(!$row2['rt_Register']){
					if($row2['tml_AllowSell']==1) $curStatus = '在售'; 
				}else{
					if($row2['tml_AllowSell']==1 && $row2['rt_Register']=='未发车') $curStatus = '在售';  
				}
				if($row2['ct_Flag']=='1') $curStatus = '检票'; 
				if($row2['tml_StopRun']==3) $curStatus = '并班'; 
				$tml_Allticket = $row2['tml_Allticket'];
				if($tml_Allticket == '0'){
					$ticketstate='否';
				}
				if($tml_Allticket == '1'){
					$ticketstate='是';	
				}
			}
		}
		$retData = array('bi_BusID' => $row['bi_BusID'], 'bi_BusNumber' => $row['bi_BusNumber'], 'bi_IsSafetyCheck' => $row1['sc_Result'], 'bi_BusType' => $row['bi_BusType'], 'bi_ManagementLine' => $row['bi_ManagementLine'],'bi_SeatS' => $row['bi_SeatS'],'bi_AllowHalfSeats' => $row['bi_AllowHalfSeats'],
						 'NoOfRunsID' => $NoOfRunsID, 'curStatus' => $curStatus,'ticketstate' => $ticketstate,'nextReport'=>$nextReport,'nextbus'=>$nextbus,'bi'=>$rowSelect['rt_BusID']);
		echo json_encode($retData);
		break;
	case "GETBUSINFOBYBUSNUMBER":
		$bi_BusNumber = $_REQUEST['bi_BusNumber'];
		$NoOfRunsdate = $_REQUEST['NoOfRunsdate'];
		$sc_CheckDate = date('Y-m-d');
		$BegionStation=$_REQUEST['BegionStation'];
		$thisStation=$_REQUEST['thisStation'];
		$NoOfRunsID1=$_REQUEST['NoOfRunsID'];
		$nextReport=1;
		$nextbus=1;
		$queryString = "SELECT bi_BusID,bi_BusNumber,bi_BusType,bi_ManagementLine,bi_SeatS,bi_AllowHalfSeats FROM tms_bd_BusInfo WHERE bi_BusNumber = '{$bi_BusNumber}'";
		$result = $class_mysql_default->my_query("$queryString");
		$row = mysqli_fetch_array($result);
		$queryString = "SELECT sc_Result FROM tms_sf_SafetyCheck WHERE sc_BusCard='{$row['bi_BusNumber']}' AND sc_CheckDate='{$sc_CheckDate}'";
		$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
				$retData=array('er'=>'error','ss'=>'11111'.mysql.error());
				echo json_encode($retData);
				exit();
			}
		$row1 = mysqli_fetch_array($result);
		if($BegionStation!=$thisStation){
			$Select="SELECT rt_BusCard,rt_Register FROM tms_sch_Report WHERE rt_NoOfRunsID='{$NoOfRunsID1}' AND rt_NoOfRunsdate='{$NoOfRunsdate}' AND 
				rt_BusCard='{$bi_BusNumber}' AND rt_AttemperStationID=(SELECT ndst_SiteID FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID1}' AND 
				ndst_NoOfRunsdate='{$NoOfRunsdate}' AND ndst_ID=(SELECT MAX(ndst_ID) FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID1}' AND
				ndst_NoOfRunsdate='{$NoOfRunsdate}' AND ndst_CheckInSite=1 AND ndst_ID<(SELECT ndst_ID FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID1}' AND
				ndst_NoOfRunsdate='{$NoOfRunsdate}' AND ndst_SiteName='{$thisStation}') GROUP BY ndst_NoOfRunsID,ndst_NoOfRunsdate))";
			$querySelect=$class_mysql_default->my_query("$Select");
			if(!$querySelect) {
				$retData=array('er'=>'error','ss'=>'11111'.mysql.error());
				echo json_encode($retData);
				exit();
			}
			$rowSelect=mysqli_fetch_array($querySelect);
			if($rowSelect['rt_Register']!='已发车'){
				$nextReport=0;
			}else{
				$nextReport=1;
			}
			if($rowSelect['rt_BusCard']!=$bi_BusNumber){
				$nextbus=0;
			}else{
				$nextbus=1;
			}
		}
	/*	$query ="SELECT tml_AllowSell,tml_StopRun,rt_NoOfRunsID,tml_Allticket,rt_Register FROM tms_sch_Report LEFT OUTER JOIN tms_bd_TicketMode 
					    ON tml_NoOfRunsID = rt_NoOfRunsID AND tml_NoOfRunsdate = rt_NoOfRunsdate 
					    WHERE tml_NoOfRunsdate = '$NoOfRunsdate'  AND   
					    tml_StopRun !='1' AND rt_BusCard='$bi_BusNumber' ORDER BY rt_Register DESC"; */
		$query ="SELECT tml_AllowSell,tml_StopRun,rt_NoOfRunsID,tml_Allticket,rt_Register,ct_Flag FROM tms_sch_Report 
				LEFT OUTER JOIN tms_bd_TicketMode ON tml_NoOfRunsID = rt_NoOfRunsID AND tml_NoOfRunsdate = rt_NoOfRunsdate
				LEFT OUTER JOIN tms_chk_CheckTemp ON ct_NoOfRunsID=rt_NoOfRunsID AND ct_NoOfRunsdate=rt_NoOfRunsdate AND ct_BusID=rt_BusID AND ct_ReportDateTime=rt_ReportDateTime
			    WHERE tml_NoOfRunsdate = '$NoOfRunsdate' AND  rt_BusCard='$bi_BusNumber' AND rt_AttemperStation='{$thisStation}' ORDER BY rt_Register DESC";
				$result1 = $class_mysql_default->my_query("$query");
		if(!mysqli_num_rows($result1)) {
			$NoOfRunsID = '';
		}
		else{
			$row2 = mysqli_fetch_array($result1);
			if($row2['rt_Register'] == '已发车'){
				$NoOfRunsID = '';
			}
            else{
				$NoOfRunsID = $row2['rt_NoOfRunsID'];
			/*	if($row2['tml_AllowSell']==0 && $row2['tml_StopRun']==0) $curStatus = '暂停'; 
				if($row2['tml_AllowSell']==1 && $row2['tml_StopRun']==0) $curStatus = '在售';  
				if($row2['tml_StopRun']==2) $curStatus = '检票'; 
				if($row2['tml_StopRun']==3) $curStatus = '并班'; */
				if($row2['tml_AllowSell']==0 && $row2['tml_StopRun']==0)  $curStatus = '暂停'; 
				if(!$row2['rt_Register']){
					if($row2['tml_AllowSell']==1) $curStatus = '在售'; 
				}else{
					if($row2['tml_AllowSell']==1 && $row2['rt_Register']=='未发车') $curStatus = '在售';  
				}
				if($row2['ct_Flag']=='1') $curStatus = '检票'; 
				if($row2['tml_StopRun']==3) $curStatus = '并班'; 
				$tml_Allticket = $row2['tml_Allticket'];
				if($tml_Allticket == '0'){
					$ticketstate='否';
				}
				if($tml_Allticket == '1'){
					$ticketstate='是';	
				}
            }
       }
				
			
		$retData = array('bi_BusID' => $row['bi_BusID'], 'bi_BusNumber' => $row['bi_BusNumber'], 'bi_IsSafetyCheck' => $row1['sc_Result'], 'bi_BusType' => $row['bi_BusType'], 'bi_ManagementLine' => $row['bi_ManagementLine'],'bi_SeatS' => $row['bi_SeatS'],'bi_AllowHalfSeats' => $row['bi_AllowHalfSeats'],
						 'NoOfRunsID' => $NoOfRunsID, 'curStatus' => $curStatus,'ticketstate' => $ticketstate,'nextReport'=>$nextReport,'nextbus'=>$nextbus,'bi'=>$rowSelect['rt_BusCard']);
		echo json_encode($retData);
		break;
	case "CANCELALLREPORT":
		$NoOfRunsID=$_REQUEST['NoOfRunsID'];
		$NoOfRunsdate=$_REQUEST['NoOfRunsdate'];
		$reportBusNumber=$_REQUEST['reportBusNumber'];
		$ctID=$_REQUEST['ctID'];
		$rtID=$_REQUEST['rtID'];
		//$strsqlselet="DELETE FROM tms_sch_Report WHERE rt_NoOfRunsID='$NoOfRunsID' AND rt_NoOfRunsdate='$NoOfRunsdate' AND rt_BusCard='$reportBusNumber'";
		$strsqlselet="DELETE FROM tms_sch_Report WHERE rt_ID='$rtID'";
		$resultselet = $class_mysql_default ->my_query("$strsqlselet");
		$str1="DELETE FROM tms_chk_CheckTemp where ct_ID='$ctID'";
		$result2=$class_mysql_default ->my_query("$str1");
		if (!$resultselet || !$result2){
			$retData = array('retVal' => 'FAIL', 'retString' => '撤销报班失败！'.->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}else{
			$retData = array('retVal' => 'SUCCESS', 'retString' => '撤销报班成功！', 'sql' => $queryString);
			echo json_encode($retData);
		}
		break;
	case "CONFIRMREPORT":
		$NoOfRunsID = $_REQUEST['NoOfRunsID'];
		$NoOfRunsdate = $_REQUEST['NoOfRunsdate'];
		$reportBusID = $_REQUEST['reportBusID'];
		$reportBusCard = $_REQUEST['reportBusCard'];
		$reportCheckWindow = $_REQUEST['reportCheckWindow'];
		$reportDatatime = date("Y-m-d H:i:m");
		$remark='';
		
		$selectSafetyCheck="SELECT sc_Result FROM tms_sf_SafetyCheck WHERE sc_BusCard='{$reportBusCard}' AND  period_diff(curdate(),sc_CheckDate)<=1 ";
		$resultSafetyCheck = $class_mysql_default ->my_query("$selectSafetyCheck");
		$rowSafetyCheck= @mysqli_fetch_array($resultSafetyCheck);
		if($rowSafetyCheck['sc_Result']==''){
			$remark=$remark.'没安检；';
		}
		if($rowSafetyCheck['sc_Result']=='检验不合格'){
			$remark=$remark.'安检不合格；';
		}
		
		$strsqlselet="SELECT bi_DriverID,bi_Driver,bi_Driver1ID,bi_Driver1,bi_Driver2ID,bi_Driver2,bi_SeatS,bi_AllowHalfSeats,bi_BusTypeID,bi_BusType,
			bi_BusUnit,bi_BusNumber,bi_RoadTransport,bi_RoadTransportEndDate,bi_LineLicense,bi_LineLicenseAttached,bi_AttachedEndDate,
			bi_VehicleDriving,bi_VehicleDrivingEndDate FROM `tms_bd_BusInfo` WHERE `bi_BusID`='$reportBusID'";
		$resultselet = $class_mysql_default ->my_query("$strsqlselet");
		$bi_rows = @mysqli_fetch_array($resultselet);
		if($bi_rows['bi_RoadTransport']==''){
			$remark=$remark.'无道路运输证；';
		}else{
			if((strtotime( $bi_rows['bi_RoadTransportEndDate'])-strtotime(date('Y-m-d')))/3600/24<0){
				$remark=$remark.'道路运输证过期；'.$bi_rows['bi_TransportationEndDate'];
			}
		}
		if($bi_rows['bi_LineLicense']=='' && $bi_rows['bi_LineLicenseAttached']==''){
			$remark=$remark.'无线路牌；';
		}else{
			if((strtotime( $bi_rows['bi_AttachedEndDate'])-strtotime(date('Y-m-d')))/3600/24<0){
				$remark=$remark.'线路牌过期；';
			}
		}
		if($bi_rows['bi_VehicleDriving']==''){
			$remark=$remark.'无车辆行驶证；';
		}else{
			if((strtotime( $bi_rows['bi_VehicleDrivingEndDate'])-strtotime(date('Y-m-d')))/3600/24<0){
				$remark=$remark.'车辆行驶证过期；';
			}
		}
		if(!$bi_rows['bi_DriverID'] && !$bi_rows['bi_Driver1ID'] && !$bi_rows['bi_Driver2ID']){
			$remark=$remark.'无驾驶员；';	
		}else{
		// 主驾驶员信息
			$driver = $bi_rows['bi_DriverID'];
			$strsqlselet="SELECT di_DriverID, di_Name,di_CYZGZNumber,di_DriverCard,di_DriverCheckDate,di_CYZGZCheckDate FROM tms_bd_DriverInfo WHERE di_DriverID='$driver'";
			$resultselet = $class_mysql_default ->my_query("$strsqlselet");
			if(mysqli_num_rows($resultselet) == 1){
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
			}
			
			// 副驾驶员1信息
			$driver = $bi_rows['bi_Driver1ID'];
			$strsqlselet="SELECT di_DriverID, di_Name,di_CYZGZNumber,di_DriverCard,di_DriverCheckDate,di_CYZGZCheckDate FROM tms_bd_DriverInfo WHERE di_DriverID='$driver'";
			$resultselet = $class_mysql_default ->my_query("$strsqlselet");
			if(mysqli_num_rows($resultselet) == 1){
				$rowsd1 = @mysqli_fetch_array($resultselet);
				$remarkdriver1=$rowsd1['di_Name'].'('.$rowsd1['di_DriverID'].')';
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
				if($remarkdriver1!=$rowsd1['di_Name'].'('.$rowsd1['di_DriverID'].')'){
					$remark=$remark.$remarkdriver1;
				}
			}		
			// 副驾驶员2信息
			$driver = $bi_rows['bi_Driver2ID'];
			$strsqlselet="SELECT di_DriverID, di_Name,di_CYZGZNumber,di_DriverCard,di_DriverCheckDate,di_CYZGZCheckDate FROM tms_bd_DriverInfo WHERE di_DriverID='$driver'";
			$resultselet = $class_mysql_default ->my_query("$strsqlselet");
			if(mysqli_num_rows($resultselet) == 1){
				$rowsd2 = @mysqli_fetch_array($resultselet);
				$remarkdriver2=$rowsd2['di_Name'].'('.$rowsd2['di_DriverID'].')';
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
				if($remarkdriver2!=$rowsd2['di_Name'].'('.$rowsd2['di_DriverID'].')'){
					$remark=$remark.$remarkdriver2;
				}
			}			
		}
		$class_mysql_default->my_query("BEGIN");
				
		//锁定票版数据
		//$queryString1 = "LOCK TABLES tms_bd_TicketMode WRITE";
	  	$queryString = "SELECT tml_Allticket, tml_TotalSeats, tml_LeaveSeats,tml_HalfSeats,tml_ReserveSeats,tml_LeaveHalfSeats,tml_SeatStatus, tml_LineID, tml_EndstationID, tml_Endstation, 
	  		tml_BusModelID, tml_BusModel, tml_BeginstationID, tml_Beginstation FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$NoOfRunsID') 
	  		AND (tml_NoOfRunsdate = '$NoOfRunsdate') FOR UPDATE";
	  	$result = $class_mysql_default->my_query("$queryString");
		if(!$result) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '锁定票版数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$tml_rows = @mysqli_fetch_array($result);
		
		// 非通票报班处理
		if($tml_rows['tml_Allticket'] == '0') {
			$queryString = "SELECT rt_NoOfRunsID,rt_NoOfRunsdate,rt_BusID FROM tms_sch_Report WHERE rt_NoOfRunsID='$NoOfRunsID' 
						AND rt_NoOfRunsdate='$NoOfRunsdate'";
			$result = $class_mysql_default->my_query("$queryString"); 
		}else{
			$queryString = "SELECT rt_NoOfRunsID,rt_NoOfRunsdate,rt_BusID FROM tms_sch_Report WHERE rt_NoOfRunsID='$NoOfRunsID' 
						AND rt_NoOfRunsdate='$NoOfRunsdate' AND rt_BusID='$reportBusID'";
			$result = $class_mysql_default->my_query("$queryString"); 
		}
		//if(mysqli_num_rows($result) == 0) {
			
		/*	if(($tml_rows['tml_ReserveSeats'] + $tml_rows['tml_LeaveSeats']) == $tml_rows['tml_TotalSeats']) { //只要未售票就允许更新票版
			//if($tml_rows['tml_AllowSell'] == '0') {	//只允许报班时首次更新票版
				$queryString = "CALL tms_bd_updatenotallticket('$NoOfRunsID','$NoOfRunsdate','$reportBusID','$userName',@intRetVal);";
			  	$result = $class_mysql_default->my_query("$queryString");
				if(!$result) {
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '创建数据失败！', 'sql' => $queryString);
					echo json_encode($retData);
					exit();
				}
				$queryString="UPDATE tms_bd_TicketMode SET tml_AllowSell='1' WHERE tml_NoOfRunsID='{$NoOfRunsID}' 
						AND tml_NoOfRunsdate='$NoOfRunsdate' AND tml_Allticket='0'";
			  	$result = $class_mysql_default->my_query("$queryString");
				if(!$result) {
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '更新票版数据失败！', 'sql' => $queryString);
					echo json_encode($retData);
					exit();
				}  */
/*			$diffseats=$bi_rows['bi_SeatS']-$tml_rows['tml_TotalSeats'];
			$LeaveHalfSeats=$bi_rows['bi_AllowHalfSeats']-$tml_rows['tml_HalfSeats'];
			$LeaveSeats=$bi_rows['bi_SeatS']-$tml_rows['tml_TotalSeats']+$tml_rows['tml_LeaveSeats'];
			$SeatStatus=$tml_rows['tml_SeatStatus'];
			if ($diffseats>=0){
				for ($i=1;$i<=$diffseats;$i++){
					$SeatStatus=$SeatStatus.'0';
				}
			}else{
				for($i=1;$i<=abs($diffseats);$i++){
					$SeatStatus=substr($SeatStatus,0,strlen($SeatStatus)-1);	
				}
			}  */
			$queryString="UPDATE tms_bd_TicketMode SET tml_AllowSell='1', tml_Updated='{$reportDatatime}', tml_Updatedby='{$userName}' WHERE tml_NoOfRunsID='{$NoOfRunsID}' AND tml_NoOfRunsdate='{$NoOfRunsdate}'";
				//tml_BusModelID='{$bi_rows['bi_BusTypeID']}', tml_BusModel='{$bi_rows['bi_BusType']}', tml_BusID='{$reportBusID}',tml_BusCard='{$bi_rows['bi_BusNumber']}',
				//tml_TotalSeats='{$bi_rows['bi_SeatS']}',tml_LeaveSeats='{$LeaveSeats}',tml_LeaveHalfSeats='{$LeaveHalfSeats}',tml_SeatStatus='{$SeatStatus}', 
				//AND tml_Allticket='0'";
			$result = $class_mysql_default->my_query("$queryString");
			if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '更新票版数据失败！'.->my_error(), 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}  
			
			//查询班次停靠点
			$selectnorunsdocksite="SELECT nds_ID,nds_SiteName,nds_SiteID,nds_DepartureTime,nds_CheckTicketWindow FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsID}' AND nds_GetOnSite=1";
			$querynorunsdocksite=$class_mysql_default->my_query($selectnorunsdocksite);
			while($rownorunsdocksite=mysqli_fetch_array($querynorunsdocksite)){
				$ID=$rownorunsdocksite['nds_ID'];
				$FromStationID=$rownorunsdocksite['nds_SiteID'];
				$FromStation=$rownorunsdocksite['nds_SiteName'];
				//查询班次停靠点1
				$selectnorunsdocksite1="SELECT nds_ID,nds_SiteName,nds_SiteID,nds_DepartureTime FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID ='{$NoOfRunsID}' AND nds_ID >'{$ID}' AND nds_IsDock = 1";
				$querynorunsdocksite1=$class_mysql_default->my_query($selectnorunsdocksite1);
			//	if(!$querynorunsdocksite1) echo "查询班次停靠点1失败！";
				while($rownorunsdocksite1=mysqli_fetch_array($querynorunsdocksite1)){
					$ReachStationID=$rownorunsdocksite1['nds_SiteID'];
					$ReachStation=$rownorunsdocksite1['nds_SiteName'];
					$RunPrice=0;
					$selectservicefeeadjust1="SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID='{$FromStationID}' AND sfa_GetToSiteID='{$ReachStationID}' AND sfa_BeginDate<='{$NoOfRunsdate}' AND 
						sfa_EndDate>='{$NoOfRunsdate}' AND sfa_NoRunsAdjust='{$NoOfRunsID}' AND sfa_ISNoRunsAdjust=0 AND sfa_ISLineAdjust=0 AND sfa_ModelID='{$bi_rows['bi_BusTypeID']}' AND 
						sfa_Unit='{$bi_rows['bi_BusUnit']}'";
					$queryservicefeeadjust1=$class_mysql_default->my_query($selectservicefeeadjust1);
					if(mysqli_num_rows($queryservicefeeadjust1) == 1){
						$rowservicefeeadjust1=mysqli_fetch_array($queryservicefeeadjust1);
						$RunPrice=$rowservicefeeadjust1['sfa_RunPrice'];
						if($RunPrice=='' || $RunPrice=='NULL') $RunPrice=0;
					}else{
						$selectservicefeeadjust2="SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID='{$FromStationID}' AND sfa_GetToSiteID='{$ReachStationID}' AND sfa_BeginDate<='{$NoOfRunsdate}' AND 
							sfa_EndDate>='{$NoOfRunsdate}' AND sfa_NoRunsAdjust='{$NoOfRunsID}' AND sfa_ISNoRunsAdjust=1 AND sfa_ISLineAdjust=0 AND sfa_ModelID='{$bi_rows['bi_BusTypeID']}'";
						$queryservicefeeadjust2=$class_mysql_default->my_query($selectservicefeeadjust2);
						if(mysqli_num_rows($queryservicefeeadjust2) == 1){
							$rowservicefeeadjust2=mysqli_fetch_array($queryservicefeeadjust2);
							$RunPrice=$rowservicefeeadjust2['sfa_RunPrice'];
							if($RunPrice=='' || $RunPrice=='NULL') $RunPrice=0;
						}else{
							$selectservicefeeadjust3="SELECT sfa_RunPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_DepartureSiteID='{$FromStationID}' AND sfa_GetToSiteID='{$ReachStationID}' AND sfa_BeginDate<='{$NoOfRunsdate}' AND 
								sfa_EndDate>='{$NoOfRunsdate}' AND sfa_NoRunsAdjust='{$NoOfRunsID}' AND sfa_ISNoRunsAdjust=0 AND sfa_ISLineAdjust=1 AND sfa_ModelID='{$bi_rows['bi_BusTypeID']}' AND sfa_LineAdjust='{$tml_rows['tml_LineID']}'";
							$queryservicefeeadjust3=$class_mysql_default->my_query($selectservicefeeadjust3);
							if(mysqli_num_rows($queryservicefeeadjust3) == 1){
								$rowservicefeeadjust3=mysqli_fetch_array($queryservicefeeadjust3);
								$RunPrice=$rowservicefeeadjust3['sfa_RunPrice'];
								if($RunPrice=='' || $RunPrice=='NULL') $RunPrice=0;
							}
						}
					}
					if($RunPrice!=0){
						$updatepricedetail="UPDATE tms_bd_PriceDetail SET pd_ServiceFee='{$RunPrice}', pd_Updated='{$reportDatatime}',pd_UpdatedBY='{$userName}' WHERE pd_NoOfRunsID='{$NoOfRunsID}' AND pd_NoOfRunsdate='{$NoOfRunsdate}' 
							AND pd_FromStationID='{$FromStationID}' AND pd_ReachStationID='{$ReachStationID}'";
						$result = $class_mysql_default->my_query("$updatepricedetail");
						if(!$result) {
							$class_mysql_default->my_query("ROLLBACK");
							$retData = array('retVal' => 'FAIL', 'retString' => '更新票价数据失败！', 'sql' => $queryString);
							echo json_encode($retData);
							exit();
						}
					}
				}
			//}
				
			}
			/*else {
				if($bi_rows['bi_SeatS'] < $tml_rows['tml_TotalSeats']) { //报班车座位数小于已售票班次座位数
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '报班车座位数小于已售票班次座位数！', 'sql' => $queryString);
					echo json_encode($retData);
					exit();
				}
			}*/
				
			$queryString = "INSERT INTO tms_sch_Report(rt_NoOfRunsID,rt_LineID,rt_NoOfRunsdate,rt_AttemperStationID,rt_AttemperStation,
				rt_ReportDateTime,rt_BusID,rt_BusCard,rt_BusModelID,rt_BusModel,rt_BeginStationID,rt_BeginStation,rt_FromStationID,
				rt_FromStation,rt_EndStationID,rt_EndStation,rt_DriverID,rt_Driver,rt_Driver1ID,rt_Driver1,rt_Driver2ID,rt_Driver2,
				rt_ReportCircs,rt_ReportUser,rt_Allticket,rt_Register,rt_SupTicketRen,rt_Remark,rt_SeatNum,rt_CheckTicketWindow) VALUES ('$NoOfRunsID',
				'{$tml_rows['tml_LineID']}','$NoOfRunsdate','$userStationID','$userStationName','$reportDatatime','$reportBusID','$reportBusCard',
				'{$bi_rows['bi_BusTypeID']}','{$bi_rows['bi_BusType']}','{$tml_rows['tml_BeginstationID']}','{$tml_rows['tml_Beginstation']}',
				NULL,NULL,'{$tml_rows['tml_EndstationID']}','{$tml_rows['tml_Endstation']}','{$rowsd['di_DriverID']}','{$rowsd['di_Name']}',
				'{$rowsd1['di_DriverID']}','{$rowsd1['di_Name']}','{$rowsd2['di_DriverID']}','{$rowsd2['di_Name']}',NULL,'$userName',
				'{$tml_rows['tml_Allticket']}','未发车',NULL,'{$remark}','{$bi_rows['bi_SeatS']}','$reportCheckWindow')";
			$result = $class_mysql_default->my_query("$queryString"); 
			if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '报班失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
			$queryString = "INSERT IGNORE `tms_chk_CheckTemp` (ct_ReportDateTime,`ct_NoOfRunsID`, `ct_LineID`, `ct_NoOfRunsdate`, `ct_NoOfRunsTime`, `ct_BusID`, `ct_BusNumber`, 
		 		`ct_EndStation`, `ct_TotalSeats`, `ct_SoldTicketNum`, `ct_Allticket`, `ct_CheckTicketWindow`, `ct_UserID`, `ct_User`,`ct_Flag`) 
		 		SELECT rt_ReportDateTime,rt_NoOfRunsID, rt_LineID, rt_NoOfRunsdate, tml_NoOfRunstime, rt_BusID, rt_BusCard, tml_Endstation, rt_SeatNum, 
		 		tml_TotalSeats - tml_LeaveSeats - IFNULL(tml_ReserveSeats,0), tml_Allticket, rt_CheckTicketWindow, '$userID', '$userName', '0' 
		 		FROM tms_sch_Report LEFT OUTER JOIN tms_bd_TicketMode ON rt_NoOfRunsID = tml_NoOfRunsID AND rt_NoOfRunsdate = tml_NoOfRunsdate 		 		
				WHERE rt_NoOfRunsdate = '$NoOfRunsdate' AND rt_NoOfRunsID ='$NoOfRunsID' AND rt_BusID = '$reportBusID' AND rt_Register LIKE '未发车'";
			$result = $class_mysql_default->my_query("$queryString"); 
			if(!$result) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '插入班次检票表失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
			$retData = array('retVal' => 'SUCC', 'sql' => $queryString);
		//}
		/*else {
			if($tml_rows['tml_Allticket'] == '0'){
				$retData = array('retVal' => 'FAIL', 'retString' => '该班次已报班！', 'sql' => $queryString);
			}else{
				$retData = array('retVal' => 'FAIL', 'retString' => '该车辆已报此班！', 'sql' => $queryString);
			}
		}*/
//		}
		// 通票报班处理
/*		else {
			$queryString = "SELECT rt_NoOfRunsID,rt_NoOfRunsdate,rt_BusID FROM tms_sch_Report WHERE rt_NoOfRunsID='$NoOfRunsID' 
						AND rt_NoOfRunsdate='$NoOfRunsdate' AND rt_BusID='$reportBusID'";
			$result = $class_mysql_default->my_query("$queryString"); 
			if(mysqli_num_rows($result) == 0) {
				$queryString = "CALL tms_bd_creatallticket('$NoOfRunsID','$NoOfRunsdate','$reportBusID','$userName',@intRetVal);";
			  	$result = $class_mysql_default->my_query("$queryString");
				if(!$result) {
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '创建数据失败！', 'sql' => $queryString);
					echo json_encode($retData);
					exit();
				} 
				$queryString="UPDATE tms_bd_TicketMode SET tml_AllowSell='1' WHERE tml_NoOfRunsID='{$NoOfRunsID}' 
						AND tml_NoOfRunsdate='$NoOfRunsdate' AND tml_Allticket='1' AND tml_BusID='######'";
			  	$result = $class_mysql_default->my_query("$queryString");
				if(!$result) {
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '更新数据失败！', 'sql' => $queryString);
					echo json_encode($retData);
					exit();
				}
				$queryString = "INSERT INTO tms_sch_Report(rt_NoOfRunsID,rt_LineID,rt_NoOfRunsdate,rt_AttemperStationID,rt_AttemperStation,
					rt_ReportDateTime,rt_BusID,rt_BusCard,rt_BusModelID,rt_BusModel,rt_BeginStationID,rt_BeginStation,rt_FromStationID,
					rt_FromStation,rt_EndStationID,rt_EndStation,rt_DriverID,rt_Driver,rt_Driver1ID,rt_Driver1,rt_Driver2ID,rt_Driver2,
					rt_ReportCircs,rt_ReportUser,rt_Allticket,rt_Register,rt_SupTicketRen,rt_Remark,rt_SeatNum,rt_CheckTicketWindow) VALUES ('$NoOfRunsID',
					'{$tml_rows['tml_LineID']}','$NoOfRunsdate','$userStationID','$userStationName','$reportDatatime','$reportBusID','$reportBusCard',
					'{$bi_rows['bi_BusTypeID']}','{$bi_rows['bi_BusType']}','{$tml_rows['tml_BeginstationID']}','{$tml_rows['tml_Beginstation']}',
					NULL,NULL,'{$tml_rows['tml_EndstationID']}','{$tml_rows['tml_Endstation']}','{$rowsd['di_DriverID']}','{$rowsd['di_Name']}',
					'{$rowsd1['di_DriverID']}','{$rowsd1['di_Name']}','{$rowsd2['di_DriverID']}','{$rowsd2['di_Name']}',NULL,'$userName','1','在售',
					NULL,NULL,'{$bi_rows['bi_SeatS']}','$reportCheckWindow')";	//需要获取报班车辆座位数
				$result = $class_mysql_default->my_query("$queryString"); 
				if(!$result) {
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '报班失败！', 'sql' => $queryString);
					echo json_encode($retData);
					exit();
				}
				$retData = array('retVal' => 'SUCC', 'sql' => $queryString);
			}
			else {
				$retData = array('retVal' => 'FAIL', 'retString' => '该车辆已报此班！', 'sql' => $queryString);
			}
		}  */
		
		$class_mysql_default->my_query("COMMIT");
		echo json_encode($retData); 
		break;
	case "GETLINE2":
		$BeginStation = $_REQUEST['BeginStation'];
		$EndStation = $_REQUEST['EndStation'];
		$selectline="SELECT li_LineID,li_LineName FROM tms_bd_LineInfo WHERE li_BeginSite='{$BeginStation}' AND li_EndSite='{$EndStation}'";
		$resultline = $class_mysql_default->my_query("$selectline");
		if(!$resultline) {
			$retData = array('retVal' => 'FAIL', 'retString' => '查询线路数据失败！'.->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$rowline=mysqli_fetch_array($resultline);
		$retData = array('LineID' => $rowline['li_LineID'], 'LineName' =>  $rowline['li_LineName']);
		echo json_encode($retData); 
		break;
	case "ADDRUN":
		$NoOfRunsID1=$_REQUEST['NoOfRunsID'];
	//	$LineID=$_REQUEST['LineID'];
	//	$LineName=$_REQUEST['LineName'];
		$BeginDate=$_REQUEST['BeginDate'];
		$EndDate=$_REQUEST['EndDate'];
		$DepartureTime=$_REQUEST['DepartureTime'];
	//	$CheckTicketWindow=$_REQUEST['CheckTicketWindow'];
	//	$BeginStation=$_REQUEST['BeginStation'];
	//	$EndStation=$_REQUEST['EndStation'];
		$BusModel=$_REQUEST['BusModel'];
		$ModelID=$_REQUEST['ModelID'];
	//	$AllowHalfSeats=$_REQUEST['AllowHalfSeats'];
	//	$Weight=$_REQUEST['Weight'];
	//	$Seats=$_REQUEST['Seats'];
		$BusUnit=$_REQUEST['BusUnit'];
	//	$OperateCode=$_REQUEST['OperateCode'];
		$Laborfee=$_REQUEST['Laborfee'];
		$Laborfee1=$Laborfee/100;
		$CurTime=date('Y-m-d H:i:s');
		$timediff='';
		$selectrun="SELECT nri_NoOfRunsID AS NoOfRunsID,nri_BeginSiteID,nri_LineID,nri_LineName,nri_BeginSite,nri_EndSiteID,nri_EndSite,nri_DepartureTime,nri_CheckTicketWindow,
			nri_DealCategory,nri_DealStyle,nri_RunHours,nri_SeverFeeRate,nri_TempAddFee,nri_BalanceModel,nri_RunRegion,nri_IsStopOrCreat,nri_Allticket,nri_StationDeal,
			nri_IsNightAddition,nri_IsSucceedLine,nri_IsThroughAddition,nri_IsExclusive,nri_IsReturn FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID='{$NoOfRunsID1}'";
		$resultrun = $class_mysql_default->my_query("$selectrun");
		if(!$resultrun) {
			$retData = array('retVal' => 'FAIL', 'retString' => '查询班次数据失败！'.->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$rowrun=mysqli_fetch_array($resultrun);
		$NoOfRunsIDADD=$rowrun['NoOfRunsID'].'加';
	//	$selectnorun="SELECT nri_NoOfRunsID FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID LIKE '{$NoOfRunsIDADD}%' ORDER BY nri_NoOfRunsID DESC LIMIT 1";
		$selectnorun="SELECT nri_NoOfRunsID FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID LIKE '{$NoOfRunsIDADD}%' AND LENGTH(nri_NoOfRunsID)=(SELECT MAX(LENGTH(nri_NoOfRunsID)) 
			FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID LIKE '{$NoOfRunsIDADD}%') ORDER BY nri_NoOfRunsID DESC LIMIT 1";
		$resultnorun= $class_mysql_default->my_query("$selectnorun");
		if(!$resultnorun) {
			$retData = array('retVal' => 'FAIL', 'retString' => '查询班次1数据失败！'.->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		if(mysqli_num_rows($resultnorun) == 0){
			$NoOfRunsID=$rowrun['NoOfRunsID'].'加1';
		}else{
			$rownorun=mysqli_fetch_array($resultnorun);
			$NoOfR=$rownorun['nri_NoOfRunsID'];
			$num=substr($NoOfR, strlen($NoOfRunsIDADD));
			$NoOfRunsID=$rowrun['NoOfRunsID'].'加'.($num+1);
		}
		if($rowrun['nri_DepartureTime']){
			$timediff=strtotime($DepartureTime)-strtotime($rowrun['nri_DepartureTime']);
		}
		$class_mysql_default->my_query("BEGIN");
		$insert="INSERT INTO tms_bd_NoRunsInfo (nri_NoOfRunsID,nri_LineID,nri_LineName,nri_BeginSiteID,
			nri_BeginSite,nri_EndSiteID,nri_EndSite,nri_DepartureTime,nri_DealCategory,nri_DealStyle,
			nri_RunHours,nri_SeverFeeRate,nri_TempAddFee,nri_BalanceModel,nri_CheckTicketWindow,nri_RunRegion,
			nri_LoopDate,nri_IsStopOrCreat,nri_Allticket,nri_StationDeal,nri_IsNightAddition,nri_IsSucceedLine,
			nri_IsThroughAddition,nri_IsExclusive,nri_IsReturn,nri_AllowSell,nri_AddNoRuns,nri_AdderID,nri_Adder,nri_AddTime,nri_Type) 
			VALUES('{$NoOfRunsID}','{$rowrun['nri_LineID']}','{$rowrun['nri_LineName']}','{$rowrun['nri_BeginSiteID']}',
			'{$rowrun['nri_BeginSite']}','{$rowrun['nri_EndSiteID']}','{$rowrun['nri_EndSite']}','{$DepartureTime}','{$rowrun['nri_DealCategory']}',
			'{$rowrun['nri_DealStyle']}','{$rowrun['nri_RunHours']}','{$rowrun['nri_SeverFeeRate']}','{{$rowrun['nri_TempAddFee']}',
			'{$rowrun['nri_BalanceModel']}','{$rowrun['nri_CheckTicketWindow']}','{$rowrun['nri_RunRegion']}','{$BeginDate}','1','{$rowrun['nri_Allticket']}','{$rowrun['nri_StationDeal']}',
			'{$rowrun['nri_IsNightAddition']}','{$rowrun['nri_IsSucceedLine']}','{$rowrun['nri_IsThroughAddition']}','{$rowrun['nri_IsExclusive']}',
			'{$rowrun['nri_IsReturn']}','1','1','{$userID}','{$userName}','{$CurTime}','{$rowrun['nri_Type']}')"; 
		$query=$class_mysql_default->my_query("$insert");
		if(!$query) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '插入班次数据失败！'.->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$selectdock="SELECT nds_ID,nds_DepartureTime FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsID1}'";
		$querydock=$class_mysql_default->my_query($selectdock);
		if(!$querydock) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '查询班次停靠点数据失败！'.->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		while ($rowdock=mysqli_fetch_array($querydock)){
			if($timediff!='' && $rowdock['nds_DepartureTime']){
				$DTime=date('H:i',strtotime('+'.$timediff.'second',strtotime($rowdock['nds_DepartureTime'])));
			}else{
				if($rowdock['nds_ID']==1){
					$DTime=$DepartureTime;
				}else{
					$DTime='';
				}
			}
			$insertdock="INSERT INTO tms_bd_NoRunsDockSite (nds_NoOfRunsID,nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,nds_GetOnSite,nds_CheckInSite,nds_DepartureTime,
					nds_RunHours,nds_IsServiceFee,nds_ServiceFee,nds_otherFee1,nds_otherFee2,nds_otherFee3,nds_otherFee4,nds_otherFee5,nds_otherFee6,nds_Remark) 
					SELECT '{$NoOfRunsID}',nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,nds_GetOnSite,nds_CheckInSite,'{$DTime}',nds_RunHours,
					nds_IsServiceFee,nds_ServiceFee,nds_otherFee1,nds_otherFee2,IF(nds_ID=1,'{$Laborfee1}',IF(nds_IsServiceFee,'{$Laborfee1}',nds_otherFee3)),nds_otherFee4,nds_otherFee5,
					nds_otherFee6,nds_Remark FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsID1}' AND nds_ID='{$rowdock['nds_ID']}'";
			$querydock1=$class_mysql_default->my_query("$insertdock");
			if(!$querydock1) {
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '插入班次停靠点数据失败！'.->my_error(), 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
		}
		$insertloop="INSERT INTO tms_bd_NoRunsLoop (nrl_NoOfRunsID,nrl_LoopID,nrl_ModelID,nrl_ModelName,nrl_Seating,nrl_AddSeating,nrl_AllowHalfSeats,nrl_Loads,nrl_Unit,
			nrl_StationID,nrl_Station) SELECT '{$NoOfRunsID}','1',bm_ModelID,bm_ModelName,bm_Seating,bm_AddSeating,bm_AllowHalfSeats,bm_Weight,'{$BusUnit}',
			'{$userStationID}','{$userStationName}' FROM tms_bd_BusModel WHERE bm_ModelID='{$ModelID}'";
		$queryloop=$class_mysql_default->my_query($insertloop);
		if (!$queryloop){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '插入班次车辆循环数据失败！'.->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$insertadjustprice1="INSERT INTO tms_bd_NoRunsAdjustPrice (nrap_ISLineAdjust,nrap_LineAdjust,nrap_ISNoRunsAdjust,nrap_NoRunsAdjust,nrap_ISUnitAdjust,nrap_Unit,nrap_DepartureSiteID,
			nrap_DepartureSite,nrap_GetToSiteID,nrap_GetToSite,nrap_ModelID,nrap_ModelName,nrap_BeginDate,nrap_EndDate,nrap_ReferPrice,nrap_RunPrice,nrap_HalfPrice,nrap_BalancePrice,
			nrap_LinkAdjustPrice) SELECT nrap_ISLineAdjust,nrap_LineAdjust,nrap_ISNoRunsAdjust,'{$NoOfRunsID}',nrap_ISUnitAdjust,nrap_Unit,nrap_DepartureSiteID,
			nrap_DepartureSite,nrap_GetToSiteID,nrap_GetToSite,nrap_ModelID,nrap_ModelName,nrap_BeginDate,nrap_EndDate,nrap_ReferPrice,nrap_RunPrice,nrap_HalfPrice,nrap_BalancePrice,
			nrap_LinkAdjustPrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_NoRunsAdjust='{$NoOfRunsID1}' AND nrap_ModelID='{$ModelID}' AND nrap_BeginDate<='{$BeginDate}' 
			AND nrap_EndDate>='{$BeginDate}' AND nrap_ISUnitAdjust='1' AND nrap_Unit='{$BusUnit}'";
		$queryadjustprice1=$class_mysql_default->my_query($insertadjustprice1);
		if (!$queryadjustprice1){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '插入班次票价调整数据1失败！'.->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$insertadjustprice2="INSERT INTO tms_bd_NoRunsAdjustPrice (nrap_ISLineAdjust,nrap_LineAdjust,nrap_ISNoRunsAdjust,nrap_NoRunsAdjust,nrap_ISUnitAdjust,nrap_Unit,nrap_DepartureSiteID,
			nrap_DepartureSite,nrap_GetToSiteID,nrap_GetToSite,nrap_ModelID,nrap_ModelName,nrap_BeginDate,nrap_EndDate,nrap_ReferPrice,nrap_RunPrice,nrap_HalfPrice,nrap_BalancePrice,
			nrap_LinkAdjustPrice) SELECT nrap_ISLineAdjust,nrap_LineAdjust,nrap_ISNoRunsAdjust,'{$NoOfRunsID}',nrap_ISUnitAdjust,nrap_Unit,nrap_DepartureSiteID,
			nrap_DepartureSite,nrap_GetToSiteID,nrap_GetToSite,nrap_ModelID,nrap_ModelName,nrap_BeginDate,nrap_EndDate,nrap_ReferPrice,nrap_RunPrice,nrap_HalfPrice,nrap_BalancePrice,
			nrap_LinkAdjustPrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_NoRunsAdjust='{$NoOfRunsID1}' AND nrap_ModelID='{$ModelID}' AND nrap_BeginDate<='{$BeginDate}' 
			AND nrap_EndDate>='{$BeginDate}' AND nrap_ISNoRunsAdjust='1'";
		$queryadjustprice2=$class_mysql_default->my_query($insertadjustprice2);
		if (!$queryadjustprice2){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '插入班次票价调整数据2失败！'.->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$insertserverfeeadjust1="INSERT INTO tms_bd_ServiceFeeAdjust (sfa_ISLineAdjust,sfa_LineAdjust,sfa_ISNoRunsAdjust,sfa_NoRunsAdjust,sfa_ISUnitAdjust,sfa_Unit,sfa_DepartureSiteID,
			sfa_DepartureSite,sfa_GetToSiteID,sfa_GetToSite,sfa_ModelID,sfa_ModelName,sfa_BeginDate,sfa_EndDate,sfa_RunPrice,sfa_LinkAdjustPrice) SELECT sfa_ISLineAdjust,sfa_LineAdjust,
			sfa_ISNoRunsAdjust,'{$NoOfRunsID}',sfa_ISUnitAdjust,sfa_Unit,sfa_DepartureSiteID,sfa_DepartureSite,sfa_GetToSiteID,sfa_GetToSite,sfa_ModelID,sfa_ModelName,sfa_BeginDate,
			sfa_EndDate,sfa_RunPrice,sfa_LinkAdjustPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_NoRunsAdjust='{$NoOfRunsID1}' AND sfa_BeginDate<='{$BeginDate}' AND 
			sfa_EndDate >='{$BeginDate}' AND sfa_ISUnitAdjust='1' AND sfa_Unit='{$BusUnit}' AND sfa_ModelID='{$ModelID}'";
		$queryserverfeeadjust1=$class_mysql_default->my_query($insertserverfeeadjust1);
		if (!$queryserverfeeadjust1){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '插入班次站务费调整数据1失败！'.->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$insertserverfeeadjust2="INSERT INTO tms_bd_ServiceFeeAdjust (sfa_ISLineAdjust,sfa_LineAdjust,sfa_ISNoRunsAdjust,sfa_NoRunsAdjust,sfa_ISUnitAdjust,sfa_Unit,sfa_DepartureSiteID,
			sfa_DepartureSite,sfa_GetToSiteID,sfa_GetToSite,sfa_ModelID,sfa_ModelName,sfa_BeginDate,sfa_EndDate,sfa_RunPrice,sfa_LinkAdjustPrice) SELECT sfa_ISLineAdjust,sfa_LineAdjust,
			sfa_ISNoRunsAdjust,'{$NoOfRunsID}',sfa_ISUnitAdjust,sfa_Unit,sfa_DepartureSiteID,sfa_DepartureSite,sfa_GetToSiteID,sfa_GetToSite,sfa_ModelID,sfa_ModelName,sfa_BeginDate,
			sfa_EndDate,sfa_RunPrice,sfa_LinkAdjustPrice FROM tms_bd_ServiceFeeAdjust WHERE sfa_NoRunsAdjust='{$NoOfRunsID1}' AND sfa_BeginDate<='{$BeginDate}' AND 
			sfa_EndDate >='{$BeginDate}' AND sfa_ISNoRunsAdjust='1' AND sfa_ModelID='{$ModelID}'";
		$queryserverfeeadjust2=$class_mysql_default->my_query($insertserverfeeadjust2);
		if (!$queryserverfeeadjust2){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '插入班次站务费调整数据2失败！'.->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}  
		$class_mysql_default->my_query("COMMIT");
		$retData = array('retVal' => 'SUCCESS', 'retString' => '加班成功！', 'sql' => $queryString);
		echo json_encode($retData);
		exit();
	//	$class_mysql_default->my_query("END TRANSACTION");
		break;
	case  "DELRUN":
		$NoOfRunsID=$_REQUEST['AddRuns'];
		$class_mysql_default->my_query("BEGIN");
		$delrun="DELETE FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID='{$NoOfRunsID}'";
		$queryrun=$class_mysql_default->my_query($delrun);
		$delrundock="DELETE FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsID}'";
		$queryrundock=$class_mysql_default->my_query($delrundock);
		$delloop="DELETE FROM tms_bd_NoRunsLoop WHERE nrl_NoOfRunsID='{$NoOfRunsID}'";
		$queryloop=$class_mysql_default->my_query($delloop);
		$delajustprice="DELETE FROM tms_bd_NoRunsAdjustPrice WHERE nrap_NoRunsAdjust='{$NoOfRunsID}'";
		$queryajustprice=$class_mysql_default->my_query($delajustprice);
		$delserverfeeadjust="DELETE FROM tms_bd_ServiceFeeAdjust WHERE sfa_NoRunsAdjust='{$NoOfRunsID}'";
		$queryserverfeeadjust=$class_mysql_default->my_query($delserverfeeadjust);
		if($queryrun &&$queryrundock && $queryloop && $queryajustprice && $queryserverfeeadjust){
			$class_mysql_default->my_query("COMMIT");
			$retData = array('retVal' => 'SUCCESS', 'retString' => '删除成功！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}else{
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '删除失败！'.->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$class_mysql_default->my_query("END TRANSACTION");
		break;
	case "MAKEMODEL":
		$NoOfRunsID=$_REQUEST['NoOfRunsID'];
		$BeginDate=$_REQUEST['BeginDate'];
		$EndDate=$_REQUEST['EndDate'];
		$LineID=$_REQUEST['LineID'];
		$User=$userName;
		$strs='';
		$strf='';
	//	$Laborfee=$_REQUEST['Laborfee'];
	//	$Laborfee=$Laborfee/100;
	//	$DepartureTime=$_REQUEST['DepartureTime'];
		$date=strtotime($BeginDate);
		$days=abs(strtotime($BeginDate) - strtotime($EndDate))/60/60/24;
		for($i=0;$i<=$days;$i++){
			$RunDate=date('Y-m-d',$date+$i*24*60*60);
		//	$strs=$strs." ".$RunDate;
		//	$strf=$strf." ".$RunDate;
			$creat=Creatticketmodel($NoOfRunsID,$RunDate,$User,$LineID,$class_mysql_default);
			if($creat==1){
				$strs=$strs." ".$RunDate." ".$NoOfRunsID." ".'票版制作成功！'."\n";
			}else{
				$strf=$strf." ".$RunDate." ".$NoOfRunsID." ".$creat."\n";
			}
		}
		$retData = array('retVal' => 'SUCC', 'retStrings' => $strs,'retStringf' => $strf);
		echo json_encode($retData);
		break;
	case "DELMODEL":
		$NoOfRunsID=$_REQUEST['NoOfRunsID'];
		$BeginDate=$_REQUEST['BeginDate'];
		$EndDate=$_REQUEST['EndDate'];
		$date=strtotime($BeginDate);
		$days=abs(strtotime($BeginDate) - strtotime($EndDate))/60/60/24;
		$strings='';
		$stringf='';
		for($i=0;$i<=$days;$i++){
			$RunDate=date('Y-m-d',$date+$i*24*60*60);
			$select="SELECT tml_SeatStatus FROM tms_bd_TicketMode WHERE tml_NoOfRunsdate='{$RunDate}' AND tml_NoOfRunsID='{$NoOfRunsID}'";
			$query3=$class_mysql_default->my_query($select);
			$row=mysqli_fetch_array($query3);
			if(!strstr($row[0],'1') && !strstr($row[0],'2') && !strstr($row[0],'3') && !strstr($row[0],'4') && !strstr($row[0],'5') && !strstr($row[0],'6')){
				$class_mysql_default->my_query("START TRANSACTION");
				$del1="DELETE FROM tms_bd_TicketMode WHERE tml_NoOfRunsdate='{$RunDate}' AND tml_NoOfRunsID='{$NoOfRunsID}' ";
				$query1=$class_mysql_default->my_query($del1);
				$del2="DELETE FROM tms_bd_PriceDetail WHERE pd_NoOfRunsdate='{$RunDate}' AND pd_NoOfRunsID='{$NoOfRunsID}' ";
				$query2=$class_mysql_default->my_query($del2);
				$del4="DELETE FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$NoOfRunsID}' AND ndst_NoOfRunsdate='{$RunDate}'";
				$query4=$class_mysql_default->my_query($del4);
				if($query1 && $query2 && $query4){
					$class_mysql_default->my_query("COMMIT");
					$strings=$strings.$RunDate.'班次'.$NoOfRunsID.'票版删除成功！'."\n";
				//	return $strings;
				}else{
					$class_mysql_default->my_query("ROLLBACK");
					$stringf=$stringf.$RunDate.'班次'.$NoOfRunsID.'删除票版表或票价表失败！'."\n";
				//	return $stringf;
				}
				$class_mysql_default->my_query("END TRANSACTION");
			}else{
				$stringf=$stringf.$RunDate.'班次'.$NoOfRunsID.'已经售票，不能删除票版！'."\n";
			//	return $stringf;
			}
		}
		$retData = array('retVal' => 'SUCC', 'retStrings' => $strings,'retStringf' => $stringf);
		echo json_encode($retData);
		break;
	case "ANDRUN":
		$NoOfRunsID=$_REQUEST['NoOfRunsID'];//被并的班次
		$NoOfRunsID1=$_REQUEST['NoOfRunsID1'];//并入的班次
		$NoOfRunsdate=$_REQUEST['NoOfRunsdate'];
		$CurTime=date('Y-m-d H:i:s');;
		$class_mysql_default->my_query("START TRANSACTION");
		//锁定票版数据
		$selectmodel="SELECT tml_TotalSeats,tml_LeaveSeats,tml_HalfSeats,tml_SeatStatus FROM tms_bd_TicketMode WHERE tml_NoOfRunsID = '{$NoOfRunsID}' AND tml_NoOfRunsdate = '{$NoOfRunsdate}' FOR UPDATE";
	  	$resultmodel = $class_mysql_default->my_query("$selectmodel");
		if(!$resultmodel) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '锁定票版数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$rowsmodel = @mysqli_fetch_array($resultmodel);
		//锁定票版数据
		$selectmodel1="SELECT tml_TotalSeats,tml_LeaveSeats,tml_HalfSeats,tml_LeaveHalfSeats,tml_SeatStatus FROM tms_bd_TicketMode WHERE tml_NoOfRunsID = '{$NoOfRunsID1}' AND tml_NoOfRunsdate = '{$NoOfRunsdate}' FOR UPDATE";
	  	$resultmodel1 = $class_mysql_default->my_query("$selectmodel1");
		if(!$resultmodel1) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '锁定票版1数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$rowsmodel1 = @mysqli_fetch_array($resultmodel1);
		//更新票版
		$updatemodel="UPDATE tms_bd_TicketMode SET tml_AllowSell='0',tml_StopRun='3' WHERE tml_NoOfRunsID = '{$NoOfRunsID}' AND tml_NoOfRunsdate = '{$NoOfRunsdate}'";
		$querymodel=$class_mysql_default->my_query("$updatemodel");
		if(!$querymodel) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新票版数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$seatnum=$rowsmodel['tml_TotalSeats']-$rowsmodel['tml_LeaveSeats'];
		$halseatnum=$rowsmodel['tml_HalfSeats'];
		$LeaveSeats=$rowsmodel1['tml_LeaveSeats']-$seatnum;
		if($LeaveSeats<0){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '班次'.$NoOfRunsID1.'的剩余座位数小于班次'.$NoOfRunsID.'的已售票数，请修改班次'.$NoOfRunsID1.'的座位数！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$LeaveHalfSeats=$rowsmodel1['tml_LeaveHalfSeats']-$rowsmodel['tml_HalfSeats'];
		$HalfSeats=$rowsmodel1['tml_HalfSeats']+$rowsmodel['tml_HalfSeats'];
	//	$seatstring=preg_replace('|[0/]+|','',$rowsmodel['tml_SeatStatus']);
		$seatID='';
		$SeatStatus=$rowsmodel1['tml_SeatStatus'];
		for($i=0;$i<$seatnum;$i++){
		//	$cha=substr($seatstring,0,1);
		//	$seatstring=substr($seatstring,1,strlen($seatstring)-1);
			$pos=stripos($SeatStatus,'0');
			if($seatID==''){
				$seatID=$seatID.$pos;
			}else{
				$seatID=$seatID.','.$pos;
			}
			$SeatStatus=substr_replace($SeatStatus, '7',$pos,1);
		}
		
		//更新票版
		$updatemodel1="UPDATE tms_bd_TicketMode SET tml_LeaveSeats='{$LeaveSeats}',tml_HalfSeats='{$HalfSeats}',tml_LeaveHalfSeats='{$LeaveHalfSeats}',tml_SeatStatus='{$SeatStatus}' 
			WHERE tml_NoOfRunsID = '{$NoOfRunsID1}' AND tml_NoOfRunsdate = '{$NoOfRunsdate}'";
		$querymodel1=$class_mysql_default->my_query("$updatemodel1");
		if(!$querymodel1) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新票版1数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$insert="INSERT INTO tms_sch_AndNoOfRuns (anr_NoOfRunsID,anr_NoOfRunsdate,anr_AndNoOfRunsID,anr_AndNoOfRunsdate,anr_AndTime,anr_AnderID,anr_Ander,anr_Seats,anr_HalfSeats,anr_AndSeatID) 
			VALUES ('{$NoOfRunsID}','{$NoOfRunsdate}','{$NoOfRunsID1}','{$NoOfRunsdate}','{$CurTime}','{$userID}','{$userName}','{$seatnum}','{$halseatnum}','{$seatID}')";
		$queryinsert=$class_mysql_default->my_query("$insert");
		if(!$queryinsert){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '插入并班数据失败！'.->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$updateticket="UPDATE tms_sell_SellTicket SET st_TicketState='9' WHERE st_NoOfRunsID='{$NoOfRunsID}' AND st_NoOfRunsdate='{$NoOfRunsdate}' AND 
				st_TicketID NOT IN (SELECT rtk_TicketID FROM tms_sell_ReturnTicket WHERE rtk_NoOfRunsID='$NoOfRunsID' AND 
				rtk_NoOfRunsdate='$NoOfRunsdate' AND rtk_FromStationID='{$userStationID}') AND st_TicketID NOT IN (SELECT et_TicketID 
				FROM tms_sell_ErrTicket WHERE  et_NoOfRunsID='$NoOfRunsID' AND et_NoOfRunsdate='$NoOfRunsdate' AND 
				et_FromStationID='{$userStationID}')";
		$queryticket=$class_mysql_default->my_query("$updateticket");
		if(!$queryticket) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新售票数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
	/*	$updatewebticket="UPDATE tms_websell_WebSellTicket SET wst_NoOfRunsID='{$NoOfRunsID1}' WHERE wst_NoOfRunsID='{$NoOfRunsID}' AND wst_NoOfRunsdate='{$NoOfRunsdate}'";
		$querywebticket=$class_mysql_default->my_query("$updatewebticket");
		if(!$querywebticket) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新订票数据失败！'.->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		} */
		$class_mysql_default->my_query("COMMIT");
		$retData = array('retVal' => 'SUCCESS', 'retString' => '并班成功！', 'sql' => $queryString);
		echo json_encode($retData);
		break;
	case "CANCELANDRUN":
		$NoOfRunsID=$_REQUEST['NoOfRunsID'];
		$NoOfRunsID1=$_REQUEST['NoOfRunsID1'];
		$NoOfRunsdate=$_REQUEST['NoOfRunsdate'];
		$selectandrun="SELECT anr_AndNoOfRunsID,anr_AndNoOfRunsdate,anr_Seats,anr_AndSeatID FROM tms_sch_AndNoOfRuns WHERE anr_NoOfRunsID='{$NoOfRunsID}' AND 
			anr_NoOfRunsdate='{$NoOfRunsdate}'";
		$queryandrun=$class_mysql_default->my_query("$selectandrun");
		if(!$queryandrun){
			$retData = array('retVal' => 'FAIL', 'retString' => '查询并班数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$rowandrun=@mysqli_fetch_array($queryandrun);
		$class_mysql_default->my_query("START TRANSACTION");
		$selectmodel="SELECT tml_TotalSeats,tml_LeaveSeats,tml_HalfSeats,tml_LeaveHalfSeats,tml_SeatStatus FROM tms_bd_TicketMode WHERE tml_NoOfRunsID = '{$rowandrun['anr_AndNoOfRunsID']}' AND tml_NoOfRunsdate = '{$rowandrun['anr_AndNoOfRunsdate']}' FOR UPDATE";
	  	$resultmodel = $class_mysql_default->my_query("$selectmodel");
		if(!$resultmodel) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '锁定票版数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$rowsmodel = @mysqli_fetch_array($resultmodel);
		$LeaveSeats=$rowsmodel['tml_LeaveSeats']+$rowandrun['anr_Seats'];
		$LeaveHalfSeats=$rowsmodel['tml_LeaveHalfSeats']+$rowandrun['anr_HalfSeats'];
		$HalfSeats=$rowsmodel['tml_HalfSeats']-$rowandrun['anr_HalfSeats'];
		$SeatStatus=$rowsmodel['tml_SeatStatus'];
		for($i=0;$i<$rowandrun['anr_Seats'];$i++){
		//	$cha=substr($seatstring,0,1);
		//	$seatstring=substr($seatstring,1,strlen($seatstring)-1);
		//	$pos=stripos($SeatStatus,'0');
		//	$seatID=$seatID.$pos;
			$SeatStatus=substr_replace($SeatStatus, '0',stripos($SeatStatus,'7'),1);
		}
		$updatemodel="UPDATE tms_bd_TicketMode SET tml_AllowSell='1',tml_StopRun='0' WHERE tml_NoOfRunsID = '{$NoOfRunsID}' AND tml_NoOfRunsdate = '{$NoOfRunsdate}'";
		$querymodel=$class_mysql_default->my_query("$updatemodel");
		if(!$querymodel) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新票版数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$updatemodel1="UPDATE tms_bd_TicketMode SET tml_LeaveSeats='{$LeaveSeats}',tml_HalfSeats='{$HalfSeats}',tml_LeaveHalfSeats='{$LeaveHalfSeats}',tml_SeatStatus='{$SeatStatus}' 
			WHERE tml_NoOfRunsID = '{$rowandrun['anr_AndNoOfRunsID']}' AND tml_NoOfRunsdate = '{$rowandrun['anr_AndNoOfRunsdate']}'";
		$querymodel1=$class_mysql_default->my_query("$updatemodel1");
		if(!$querymodel1) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新票版1数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$deleteandrun="DELETE FROM tms_sch_AndNoOfRuns WHERE anr_NoOfRunsID='{$NoOfRunsID}' AND anr_NoOfRunsdate='{$NoOfRunsdate}'";
		$querydeleteandrun=$class_mysql_default->my_query("$deleteandrun");
		if(!$querydeleteandrun){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '删除并班数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$updateticket="UPDATE tms_sell_SellTicket SET st_TicketState='0' WHERE st_NoOfRunsID='{$NoOfRunsID}' AND st_NoOfRunsdate='{$NoOfRunsdate}' AND  
				st_TicketID NOT IN (SELECT rtk_TicketID FROM tms_sell_ReturnTicket WHERE rtk_NoOfRunsID='$NoOfRunsID' AND 
				rtk_NoOfRunsdate='$NoOfRunsdate' AND rtk_FromStationID='{$userStationID}') AND st_TicketID NOT IN (SELECT et_TicketID 
				FROM tms_sell_ErrTicket WHERE  et_NoOfRunsID='$NoOfRunsID' AND et_NoOfRunsdate='$NoOfRunsdate' AND 
				et_FromStationID='{$userStationID}')";
		$queryticket=$class_mysql_default->my_query("$updateticket");
		if(!$queryticket) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新售票数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$class_mysql_default->my_query("COMMIT");
		$retData = array('retVal' => 'SUCCESS', 'retString' => '撤销并班成功！', 'sql' => $queryString);
		echo json_encode($retData);
		break;
	case "deldock":
		$NoOfRunsID = $_REQUEST['NoOfRunsID'];
		$ID = $_REQUEST['ID'];
		$class_mysql_default->my_query("BEGIN");
		$del="DELETE FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsID}' AND nds_ID='{$ID}'";
		$querydel=$class_mysql_default->my_query("$del");
		$update="UPDATE tms_bd_NoRunsDockSite SET nds_ID=nds_ID-1 WHERE nds_NoOfRunsID='{$NoOfRunsID}'and nds_ID>'{$ID}' ";
		$query1 =  $class_mysql_default->my_query($update);
		if(!$querydel || !$query1){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '删除停靠点失败！'.->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$class_mysql_default->my_query("COMMIT");
		$retData = array('retVal' => 'SUCCESS', 'retString' => '删除停靠点成功！', 'sql' => $queryString);
		echo json_encode($retData);
		break;
	case "delprice":
		$NoOfRunsID = $_REQUEST['NoOfRunsID'];
		$ID = $_REQUEST['ID'];
		$del="DELETE FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ID='{$ID}'";
		$querydel=$class_mysql_default->my_query("$del");
		if(!$querydel){
			$retData = array('retVal' => 'FAIL', 'retString' => '删除票价失败！'.->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$retData = array('retVal' => 'SUCCESS', 'retString' => '删除票价成功！', 'sql' => $queryString);
		echo json_encode($retData);
		break;
	case "delservicefee":
		$NoOfRunsID = $_REQUEST['NoOfRunsID'];
		$ID = $_REQUEST['ID'];
		$del="DELETE FROM tms_bd_ServiceFeeAdjust WHERE sfa_ID='{$ID}'";
		$querydel=$class_mysql_default->my_query("$del");
		if(!$querydel){
			$retData = array('retVal' => 'FAIL', 'retString' => '删除站务费失败！'.->my_error(), 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		$retData = array('retVal' => 'SUCCESS', 'retString' => '删除站务费成功！', 'sql' => $queryString);
		echo json_encode($retData);
		break;
	case "appendreach":
		$FromStationID=$_REQUEST['FromStationID'];
		$NoOfRunsID=$_REQUEST['NoOfRunsID'];
		$NoOfRunsdate=$_REQUEST['NoOfRunsdate'];
		$selectprice="SELECT pd_ReachStationID,pd_ReachStation,pd_StopStationTime,pd_RunHours FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID='{$NoOfRunsID}' AND
			pd_NoOfRunsdate='{$NoOfRunsdate}' AND pd_FromStationID='{$FromStationID}'";
		$queryprice=$class_mysql_default->my_query("$selectprice");
		if(!$queryprice){
			$retData = array('retVal' => 'FAIL', 'retString' => '查询票价数据失败！'.->my_error(), 'sql' => $selectprice);
			echo json_encode($retData);
			exit();
		}
		while($rowprice=mysqli_fetch_array($queryprice)){
			$reachArray[]=array('ReachStationID'=>$rowprice['pd_ReachStationID'],'ReachStation'=>$rowprice['pd_ReachStation'],
				'StopStationTime'=>$rowprice['pd_StopStationTime'],'RunHours'=>$rowprice['pd_RunHours']);
		}
		echo json_encode($reachArray);
		break;
}
function Creatticketmodel($NoOfRunsID,$RunDate,$User,$LineID,$class_mysql_default){
	$strings='';
	$stringf='';
	$string='';
	$queryprice=1;
	$selectline="SELECT li_StationID, li_Station FROM tms_bd_LineInfo WHERE li_LineID='{$LineID}'";
	$queryline=$class_mysql_default->my_query($selectline);
	if (!$queryline){
	//	$retData = array('retVal' => 'FAIL', 'retString' => '查询线路失败！'.->my_error(), 'sql' => $queryString);
	//	echo json_encode($retData);
	//	exit();
		$stringf=$stringf.'查询线路数据失败！';
		$string=$string.$NoOfRunsID.$stringf.->my_error();
		writelog($string);
		return $stringf;
	}
	$rowline=mysqli_fetch_array($queryline);
//	$StationID=$rowline['li_StationID'];
//	$Station=$rowline['li_Station'];
	$selectnoofruns="SELECT nri_BeginSiteID,nri_BeginSite,nri_EndSiteID,nri_EndSite,nri_DepartureTime,nri_CheckTicketWindow,nri_Allticket,nri_AllowSell,
		nri_LoopDate,nri_StartDay,nri_RunDay,nri_StopDay,nri_IsStopOrCreat,nri_LineID,nri_StationDeal,nri_RunRegion,nri_DealCategory,nri_DealStyle,nri_RunHours 
		FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID='{$NoOfRunsID}'";
	$querynoofruns=$class_mysql_default->my_query($selectnoofruns);
	if (!$querynoofruns){
	//	$retData = array('retVal' => 'FAIL', 'retString' => '查询班次失败！'.->my_error(), 'sql' => $queryString);
	//	echo json_encode($retData);
	//	exit();
		$stringf=$stringf.'查询班次数据失败！';
		$string=$string.$NoOfRunsID.$stringf.->my_error();
		writelog($string);
		return $stringf;
	}
	$rownoofruns=mysqli_fetch_array($querynoofruns);
	$selectnorunsloop="SELECT nrl_ModelID,nrl_ModelName,nrl_Seating,nrl_AddSeating,nrl_AllowHalfSeats,nrl_Loads,nrl_Unit FROM tms_bd_NoRunsLoop WHERE nrl_NoOfRunsID='{$NoOfRunsID}'";
	$querynorunsloop=$class_mysql_default->my_query($selectnorunsloop);
	if (!$querynorunsloop){
	//	$retData = array('retVal' => 'FAIL', 'retString' => '查询班循环次失败！'.->my_error(), 'sql' => $queryString);
	//	echo json_encode($retData);
	//	exit();
		$stringf=$stringf.'查询班次循环失败！';
		$string=$string.$NoOfRunsID.$stringf.->my_error();
		writelog($string);
		return $stringf;
	}
	$rownorunsloop=mysqli_fetch_array($querynorunsloop);
	$SeatStatus='';
	for($j=0;$j<$rownorunsloop['nrl_Seating'];$j++){
		$SeatStatus=$SeatStatus.'0';
	}
	$Created=date('Y-m-d H:i:s');
	$Createdby=$User;
	$class_mysql_default->my_query("BEGIN");
	$insertticketmode="INSERT INTO tms_bd_TicketMode (tml_NoOfRunsID,tml_LineID,tml_NoOfRunsdate,tml_NoOfRunstime,tml_BeginstationID,tml_Beginstation,tml_EndstationID,tml_Endstation,tml_RunHours,
		tml_CheckTicketWindow,tml_Loads,tml_SeatStatus,tml_TotalSeats,tml_LeaveSeats,tml_HalfSeats,tml_LeaveHalfSeats,tml_ReserveSeats,tml_StopRun,tml_Allticket,tml_AllowSell,tml_Orderno,
		tml_StationID,tml_Station,tml_Created,tml_Createdby,tml_Updated,tml_Updatedby,tml_BusModelID,tml_BusModel,tml_BusID,tml_BusCard,tml_StationDeal,tml_RunRegion,tml_DealCategory,
		tml_DealStyle,tml_BusUnit) VALUES ('{$NoOfRunsID}','{$LineID}','{$RunDate}','{$rownoofruns['nri_DepartureTime']}','{$rownoofruns['nri_BeginSiteID']}','{$rownoofruns['nri_BeginSite']}',
		'{$rownoofruns['nri_EndSiteID']}','{$rownoofruns['nri_EndSite']}','{$rownoofruns['nri_RunHours']}','{$rownoofruns['nri_CheckTicketWindow']}','{$rownorunsloop['nrl_Loads']}','{$SeatStatus}','{$rownorunsloop['nrl_Seating']}',
		'{$rownorunsloop['nrl_Seating']}','0','{$rownorunsloop['nrl_AllowHalfSeats']}','0','0','{$rownoofruns['nri_Allticket']}','1','1','{$rowline['li_StationID']}',
		'{$rowline['li_Station']}','{$Created}','{$Createdby}','{$Created}','{$Createdby}','{$rownorunsloop['nrl_ModelID']}','{$rownorunsloop['nrl_ModelName']}','######','######',
		'{$rownoofruns['nri_StationDeal']}','{$rownoofruns['nri_RunRegion']}','{$rownoofruns['nri_DealCategory']}','{$rownoofruns['nri_DealStyle']}','{$rownorunsloop['nrl_Unit']}')";
	$queryinsertticketmode=$class_mysql_default->my_query($insertticketmode);
	if (!$queryinsertticketmode){
	//	$class_mysql_default->my_query("ROLLBACK");
	//	$retData = array('retVal' => 'FAIL', 'retString' => '插入票版失败！'.->my_error(), 'sql' => $queryString);
	//	echo json_encode($retData);
	//	exit();
		$stringf=$stringf.'插入票版失败！';
		$string=$string.$NoOfRunsID.$stringf.->my_error();
		writelog($string);
		$class_mysql_default->my_query("ROLLBACK");
		return $stringf;
	}
	//插入临时停靠点
	$insertdoktemp="INSERT INTO tms_bd_NoRunsDockSiteTemp (ndst_NoOfRunsID,ndst_NoOfRunsdate,ndst_ID,ndst_SiteName,ndst_SiteID,ndst_IsDock,ndst_GetOnSite,
		ndst_CheckInSite,ndst_DepartureTime,ndst_RunHours,ndst_StintSell,ndst_StintTime) SELECT nds_NoOfRunsID,'$RunDate',nds_ID,nds_SiteName,nds_SiteID,
		nds_IsDock,nds_GetOnSite,nds_CheckInSite,nds_DepartureTime,nds_RunHours,nds_StintSell,nds_StintTime FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsID}'";
	$queryinsert=$class_mysql_default->my_query($insertdoktemp);
	if(!$queryinsert){
	//	$class_mysql_default->my_query("ROLLBACK");
	//	$retData = array('retVal' => 'FAIL', 'retString' => '插入临时停靠点失败！'.->my_error(), 'sql' => $queryString);
	//	echo json_encode($retData);
	//	exit();
		$stringf=$stringf.'插入临时停靠点失败！'.->my_error();
		$string=$string.$NoOfRunsID.$stringf.->my_error();
		writelog($string);
		$class_mysql_default->my_query("ROLLBACK");
		return $stringf;
	}
	$selectnorunsdocksite="SELECT nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,nds_GetOnSite,nds_CheckInSite,nds_DepartureTime,nds_RunHours,nds_CheckTicketWindow,nds_IsServiceFee,nds_ServiceFee,nds_otherFee1,
		nds_otherFee2,nds_otherFee3,nds_otherFee4,nds_otherFee5,nds_otherFee6,nds_StintSell,nds_StintTime FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsID}' AND nds_GetOnSite=1";
	$querynorunsdocksite=$class_mysql_default->my_query($selectnorunsdocksite);
	if (!$querynorunsdocksite){
	//	$class_mysql_default->my_query("ROLLBACK");
	//	$retData = array('retVal' => 'FAIL', 'retString' => '查询班次停靠点失败！'.->my_error(), 'sql' => $queryString);
	//	echo json_encode($retData);
	//	exit();
		$stringf=$stringf.'查询班次停靠点失败！';
		$string=$string.$NoOfRunsID.$stringf.->my_error();
		writelog($string);
		$class_mysql_default->my_query("ROLLBACK");
		return $stringf;
	}
	$found=false; //该变量最后验证票价表是否有一条记录
	$founddate=false;
	$noprice=false;
	$noprice1=false;
	$noprice2=false;
	$noprice3=false;
	while($rownorunsdocksite=mysqli_fetch_array($querynorunsdocksite)){
		$ndsRunHours1=$rownorunsdocksite['nds_RunHours'];
		$ID=$rownorunsdocksite['nds_ID'];
		if($rownorunsdocksite['nds_SiteID']==$rownoofruns['nri_BeginSiteID']) $IsFromSite=1;
		else $IsFromSite=0;
		$Selectsectioninfor="SELECT si_Kilometer FROM tms_bd_SectionInfo WHERE si_SiteNameID='{$rownorunsdocksite['nds_SiteID']}' AND si_LineID='{$LineID}'";
		$querysectioninfor=$class_mysql_default->my_query($Selectsectioninfor);
		if (!$querysectioninfor){
		//	$class_mysql_default->my_query("ROLLBACK");
		//	$retData = array('retVal' => 'FAIL', 'retString' => '查询线路站点失败！'.->my_error(), 'sql' => $queryString);
		//	echo json_encode($retData);
		//	exit();
			$stringf=$stringf.'查询线路站点失败！';
			$string=$string.$NoOfRunsID.$stringf.->my_error();
			writelog($string);
			$class_mysql_default->my_query("ROLLBACK");
			return $stringf;
		}
		$rowsectioninfor=mysqli_fetch_array($querysectioninfor);
		$selectnorunsdocksite1="SELECT nds_ID,nds_SiteName,nds_SiteID,nds_DepartureTime,nds_RunHours FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID ='{$NoOfRunsID}' AND nds_ID >'{$rownorunsdocksite['nds_ID']}' AND nds_IsDock = 1";
		$querynorunsdocksite1=$class_mysql_default->my_query($selectnorunsdocksite1);
		if (!$querynorunsdocksite1){
		//	$class_mysql_default->my_query("ROLLBACK");
		//	$retData = array('retVal' => 'FAIL', 'retString' => '查询班次停靠点1失败！'.->my_error(), 'sql' => $queryString);
		//	echo json_encode($retData);
		//	exit();
			$stringf=$stringf.'查询班次停靠点1失败！';
			$string=$string.$NoOfRunsID.$stringf.->my_error();
			writelog($string);
			$class_mysql_default->my_query("ROLLBACK");
			return $stringf;
		}
		while($rownorunsdocksite1=mysqli_fetch_array($querynorunsdocksite1)){
			$ndsRunHours2=$rownorunsdocksite1['nds_RunHours'];
			$FullPrice=0;
			$HalfPrice=0;
			$ReferPrice=0;
			$BalancePrice=0;
			$Selectsectioninfor1="SELECT si_Kilometer FROM tms_bd_SectionInfo WHERE si_SiteNameID='{$rownorunsdocksite1['nds_SiteID']}' AND si_LineID='{$LineID}'";
			$querysectioninfor1=$class_mysql_default->my_query($Selectsectioninfor1);
			if (!$querysectioninfor1){
			//	$class_mysql_default->my_query("ROLLBACK");
			//	$retData = array('retVal' => 'FAIL', 'retString' => '查询线路站点1失败！'.->my_error(), 'sql' => $queryString);
			//	echo json_encode($retData);
			//	exit();
				$stringf=$stringf.'查询线路站点1失败！';
				$string=$string.$NoOfRunsID.$stringf.->my_error();
				writelog($string);
				$class_mysql_default->my_query("ROLLBACK");
				return $stringf;
			}
			$rowsectioninfor1=mysqli_fetch_array($querysectioninfor1);
			$Distance=$rowsectioninfor1['si_Kilometer']-$rowsectioninfor['si_Kilometer'];
			if($Distance<0) $Distance=0;
			//处理运行小时
			if($ID==1){
				$ndsRunHours1='0:0';
			}
			if($ndsRunHours1 && $ndsRunHours2){
				$RunHours1=explode(":", $ndsRunHours1);
				$RunHours2=explode(":", $ndsRunHours2);
				$allRunHours1=$RunHours1[0]*60+$RunHours1[1];
				$allRunHours2=$RunHours2[0]*60+$RunHours2[1];
				$allRunHours=$allRunHours2-$allRunHours1;
				$allhours=(int)($allRunHours/60);
				$allminutes=$allRunHours%60;
				$lastRunHours=$allhours.':'.$allminutes;
			}else{
				$lastRunHours='';
			}
			//查询票价是否过期
			$selectpricedate1="SELECT nrap_BeginDate,nrap_EndDate FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rownorunsdocksite['nds_SiteID']}' AND 
				nrap_GetToSiteID='{$rownorunsdocksite1['nds_SiteID']}' AND nrap_NoRunsAdjust='{$NoOfRunsID}' AND nrap_ModelID='{$rownorunsloop['nrl_ModelID']}' AND 
				nrap_ISNoRunsAdjust=0 AND nrap_ISLineAdjust=0 AND nrap_Unit='{$rownorunsloop['nrl_Unit']}'";
			$querypricedate1=$class_mysql_default->my_query($selectpricedate1);
			if(!$querypricedate1){
				$stringf=$stringf.'查询班次价格日期1失败！';
				$string=$string.$NoOfRunsID.$stringf.->my_error();
				writelog($string);
				$class_mysql_default->my_query("ROLLBACK");
				return $stringf;
			}
			if(mysqli_num_rows($querypricedate1) > 0){
				while($rowpricedate1=mysqli_fetch_array($querypricedate1)){
					if($rowpricedate1['nrap_BeginDate']<=$RunDate && $rowpricedate1['nrap_EndDate']>=$RunDate){
						$founddate=true;
					}
				}
			}else{
				$noprice1=true;
			}
			$selectpricedate2="SELECT nrap_BeginDate,nrap_EndDate FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rownorunsdocksite['nds_SiteID']}' AND 
				nrap_GetToSiteID='{$rownorunsdocksite1['nds_SiteID']}' AND nrap_NoRunsAdjust='{$NoOfRunsID}' AND nrap_ModelID='{$rownorunsloop['nrl_ModelID']}' AND 
				nrap_ISNoRunsAdjust=1 AND nrap_ISLineAdjust=0";
			$querypricedate2=$class_mysql_default->my_query($selectpricedate2);
			if(!$querypricedate2){
				$stringf=$stringf.'查询班次价格日期2失败！';
				$string=$string.$NoOfRunsID.$stringf.->my_error();
				writelog($string);
				$class_mysql_default->my_query("ROLLBACK");
				return $stringf;
			}
			if(mysqli_num_rows($querypricedate2) > 0){
				while($rowpricedate2=mysqli_fetch_array($querypricedate2)){
					if($rowpricedate2['nrap_BeginDate']<=$RunDate && $rowpricedate2['nrap_EndDate']>=$RunDate){
						$founddate=true;
					}
				}
			}else{
				$noprice2=true;
			}
			$selectpricedate3="SELECT nrap_BeginDate,nrap_EndDate FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rownorunsdocksite['nds_SiteID']}' AND 
				nrap_GetToSiteID='{$rownorunsdocksite1['nds_SiteID']}' AND nrap_LineAdjust='{$LineID}' AND nrap_ModelID='{$rownorunsloop['nrl_ModelID']}' AND 
				nrap_ISNoRunsAdjust=0 AND nrap_ISLineAdjust=1";
			$querypricedate3=$class_mysql_default->my_query($selectpricedate3);
			if(!$querypricedate3){
				$stringf=$stringf.'查询班次价格日期3失败！';
				$string=$string.$NoOfRunsID.$stringf.->my_error();
				writelog($string);
				$class_mysql_default->my_query("ROLLBACK");
				return $stringf;
			}
			if(mysqli_num_rows($querypricedate3) > 0){
				while($rowpricedate3=mysqli_fetch_array($querypricedate3)){
					if($rowpricedate3['nrap_BeginDate']<=$RunDate && $rowpricedate3['nrap_EndDate']>=$RunDate){
						$founddate=true;
					}
				}
			}else{
				$noprice3=true;
			} 
			$noprice=$noprice1 & $noprice2 & $noprice3;
			$selectnorunsadjustPrice1="SELECT nrap_RunPrice,nrap_HalfPrice,nrap_ReferPrice,nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rownorunsdocksite['nds_SiteID']}' 
				AND nrap_GetToSiteID='{$rownorunsdocksite1['nds_SiteID']}' AND nrap_BeginDate<='{$RunDate}' AND nrap_EndDate>='{$RunDate}' AND nrap_NoRunsAdjust='{$NoOfRunsID}' AND nrap_ISUnitAdjust=1 
				AND nrap_ModelID='{$rownorunsloop['nrl_ModelID']}' AND nrap_Unit='{$rownorunsloop['nrl_Unit']}' AND DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))=(SELECT 
				MIN(DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))) FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rownorunsdocksite['nds_SiteID']}' AND 
				nrap_GetToSiteID='{$rownorunsdocksite1['nds_SiteID']}' AND nrap_BeginDate<='{$RunDate}' AND nrap_EndDate>='{$RunDate}' AND nrap_NoRunsAdjust='{$NoOfRunsID}' AND nrap_ISUnitAdjust=1 AND 
				nrap_ModelID='{$rownorunsloop['nrl_ModelID']}' AND nrap_Unit='{$rownorunsloop['nrl_Unit']}' GROUP BY nrap_DepartureSiteID,nrap_GetToSiteID,nrap_NoRunsAdjust,nrap_ModelID,nrap_Unit,
				nrap_ISUnitAdjust)";
			$querynorunsadjustPrice1=$class_mysql_default->my_query($selectnorunsadjustPrice1);
			if(!$querynorunsadjustPrice1){
			//	$class_mysql_default->my_query("ROLLBACK");
			//	$retData = array('retVal' => 'FAIL', 'retString' => '查询班次价格数据1失败！'.->my_error(), 'sql' => $queryString);
			//	echo json_encode($retData);
			//	exit();
				$stringf=$stringf.'查询班次价格数据1失败！';
				$string=$string.$NoOfRunsID.$stringf.->my_error();
				writelog($string);
				$class_mysql_default->my_query("ROLLBACK");
				return $stringf;
			}
			if(mysqli_num_rows($querynorunsadjustPrice1) == 1){
				$rownorunsadjustPrice1=mysqli_fetch_array($querynorunsadjustPrice1);
				$FullPrice=$rownorunsadjustPrice1['nrap_RunPrice'];
				$HalfPrice=$rownorunsadjustPrice1['nrap_HalfPrice'];
				$ReferPrice=$rownorunsadjustPrice1['nrap_ReferPrice'];
				$BalancePrice=$rownorunsadjustPrice1['nrap_BalancePrice'];
				if($FullPrice=='' || $FullPrice=='NULL') $FullPrice=0;
				if($HalfPrice=='' || $HalfPrice=='NULL') $HalfPrice=0;
				if($ReferPrice=='' || $ReferPrice=='NULL') $ReferPrice=0;
				if($BalancePrice=='' || $BalancePrice=='NULL') $BalancePrice=0;
			}else{
				$selectnorunsadjustPrice2="SELECT nrap_RunPrice,nrap_HalfPrice,nrap_ReferPrice,nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rownorunsdocksite['nds_SiteID']}' AND 
					nrap_GetToSiteID='{$rownorunsdocksite1['nds_SiteID']}' AND nrap_BeginDate<='{$RunDate}' AND nrap_EndDate>='{$RunDate}' AND nrap_NoRunsAdjust='{$NoOfRunsID}' AND nrap_ISNoRunsAdjust=1 AND 
					nrap_ISLineAdjust=0 AND nrap_ModelID='{$rownorunsloop['nrl_ModelID']}' AND DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))=(SELECT 
					MIN(DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))) FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rownorunsdocksite['nds_SiteID']}' AND 
					nrap_GetToSiteID='{$rownorunsdocksite1['nds_SiteID']}' AND nrap_BeginDate<='{$RunDate}' AND nrap_EndDate>='{$RunDate}' AND nrap_NoRunsAdjust='{$NoOfRunsID}' AND nrap_ISNoRunsAdjust=1 AND 
					nrap_ModelID='{$rownorunsloop['nrl_ModelID']}' GROUP BY nrap_DepartureSiteID,nrap_GetToSiteID,nrap_NoRunsAdjust,nrap_ModelID,nrap_ISNoRunsAdjust)";
				$querynorunsadjustPrice2=$class_mysql_default->my_query($selectnorunsadjustPrice2);
				if(!$querynorunsadjustPrice2){
				//	$class_mysql_default->my_query("ROLLBACK");
				//	$retData = array('retVal' => 'FAIL', 'retString' => '查询班次价格数据2失败！'.->my_error(), 'sql' => $queryString);
				//	echo json_encode($retData);
				//	exit();
					$stringf=$stringf.'查询班次价格数据2失败！';
					$string=$string.$NoOfRunsID.$stringf.->my_error();
					writelog($string);
					$class_mysql_default->my_query("ROLLBACK");
					return $stringf;
				}
				if(mysqli_num_rows($querynorunsadjustPrice2) == 1){
					$rownorunsadjustPrice2=mysqli_fetch_array($querynorunsadjustPrice2);
					$FullPrice=$rownorunsadjustPrice2['nrap_RunPrice'];
					$HalfPrice=$rownorunsadjustPrice2['nrap_HalfPrice'];
					$ReferPrice=$rownorunsadjustPrice2['nrap_ReferPrice'];
					$BalancePrice=$rownorunsadjustPrice2['nrap_BalancePrice'];
					if($FullPrice=='' || $FullPrice=='NULL') $FullPrice=0;
					if($HalfPrice=='' || $HalfPrice=='NULL') $HalfPrice=0;
					if($ReferPrice=='' || $ReferPrice=='NULL') $ReferPrice=0;
					if($BalancePrice=='' || $BalancePrice=='NULL') $BalancePrice=0;
				}else{
					$selectnorunsadjustPrice3="SELECT nrap_RunPrice,nrap_HalfPrice,nrap_ReferPrice,nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rownorunsdocksite['nds_SiteID']}' AND 
						nrap_GetToSiteID='{$rownorunsdocksite1['nds_SiteID']}' AND nrap_BeginDate<='{$RunDate}' AND nrap_EndDate>='{$RunDate}' AND nrap_ISNoRunsAdjust=0 AND nrap_ISLineAdjust=1 AND 
						nrap_ModelID='{$rownorunsloop['nrl_ModelID']}' AND nrap_LineAdjust='{$LineID}' AND DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))=(SELECT 
						MIN(DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))) FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$rownorunsdocksite['nds_SiteID']}' AND 
						nrap_GetToSiteID='{$rownorunsdocksite1['nds_SiteID']}' AND nrap_BeginDate<='{$RunDate}' AND nrap_EndDate>='{$RunDate}' AND nrap_LineAdjust='{$LineID}' AND nrap_ISLineAdjust=1 AND 
						nrap_ModelID='{$rownorunsloop['nrl_ModelID']}' GROUP BY nrap_DepartureSiteID,nrap_GetToSiteID,nrap_NoRunsAdjust,nrap_ModelID,nrap_ISLineAdjust)";
					$querynorunsadjustPrice3=$class_mysql_default->my_query($selectnorunsadjustPrice3);
					if(!$querynorunsadjustPrice3){
					//	$class_mysql_default->my_query("ROLLBACK");
					//	$retData = array('retVal' => 'FAIL', 'retString' => '查询班次价格数据3失败！'.->my_error(), 'sql' => $queryString);
					//	echo json_encode($retData);
					//	exit();
						$stringf=$stringf.'查询班次价格数据3失败！';
						$string=$string.$NoOfRunsID.$stringf.->my_error();
						writelog($string);
						$class_mysql_default->my_query("ROLLBACK");
						return $stringf;
					}
					if(mysqli_num_rows($querynorunsadjustPrice3) == 1){
						$rownorunsadjustPrice3=mysqli_fetch_array($querynorunsadjustPrice3);
						$FullPrice=$rownorunsadjustPrice3['nrap_RunPrice'];
						$HalfPrice=$rownorunsadjustPrice3['nrap_HalfPrice'];
						$ReferPrice=$rownorunsadjustPrice3['nrap_ReferPrice'];
						$BalancePrice=$rownorunsadjustPrice2['nrap_BalancePrice'];
						if($FullPrice=='' || $FullPrice=='NULL') $FullPrice=0;
						if($HalfPrice=='' || $HalfPrice=='NULL') $HalfPrice=0;
						if($ReferPrice=='' || $ReferPrice=='NULL') $ReferPrice=0;
						if($BalancePrice=='' || $BalancePrice=='NULL') $BalancePrice=0;
					}
				}
			}
			if($FullPrice!=0){
				$insertpricedetail="INSERT INTO tms_bd_PriceDetail (pd_NoOfRunsID,pd_LineID,pd_NoOfRunsdate,pd_BeginStationTime,pd_StopStationTime,pd_RunHours,pd_Distance,pd_BeginStationID,pd_BeginStation,
					pd_FromStationID,pd_FromStation,pd_ReachStationID,pd_ReachStation,pd_EndStationID,pd_EndStation,pd_FullPrice,pd_HalfPrice,pd_StandardPrice,pd_BalancePrice,pd_ServiceFee,
					pd_otherFee1,pd_otherFee2,pd_otherFee3,pd_otherFee4,pd_otherFee5,pd_otherFee6,pd_StationID,pd_Station,pd_Created,pd_CreatedBY,pd_Updated,pd_UpdatedBY,pd_IsPass,pd_CheckInSite,
					pd_IsFromSite,pd_StintSell,pd_StintTime) VALUES ('{$NoOfRunsID}','{$LineID}','{$RunDate}','{$rownorunsdocksite['nds_DepartureTime']}','{$rownorunsdocksite1['nds_DepartureTime']}',
					'{$lastRunHours}','{$Distance}','{$rownoofruns['nri_BeginSiteID']}','{$rownoofruns['nri_BeginSite']}','{$rownorunsdocksite['nds_SiteID']}','{$rownorunsdocksite['nds_SiteName']}',
					'{$rownorunsdocksite1['nds_SiteID']}','{$rownorunsdocksite1['nds_SiteName']}','{$rownoofruns['nri_EndSiteID']}','{$rownoofruns['nri_EndSite']}','{$FullPrice}','{$HalfPrice}','{$ReferPrice}',
					'{$BalancePrice}','{$rownorunsdocksite['nds_ServiceFee']}','{$rownorunsdocksite['nds_otherFee1']}','{$rownorunsdocksite['nds_otherFee2']}','{$rownorunsdocksite['nds_otherFee3']}',
					'{$rownorunsdocksite['nds_otherFee4']}','{$rownorunsdocksite['nds_otherFee5']}','{$rownorunsdocksite['nds_otherFee6']}','{$rowline['li_StationID']}','{$rowline['li_Station']}',
					'{$Created}','{$Createdby}','{$Created}','{$Createdby}','1','{$rownorunsdocksite['nds_CheckInSite']}','{$IsFromSite}','{$rownorunsdocksite['nds_StintSell']}',
					'{$rownorunsdocksite['nds_StintTime']}')";
				$querypricedetail=$class_mysql_default->my_query($insertpricedetail);
				if (!$querypricedetail){
				//	$class_mysql_default->my_query("ROLLBACK");
				//	$retData = array('retVal' => 'FAIL', 'retString' => '插入票价失败！'.$insertpricedetail.->my_error(), 'sql' => $queryString);
				//	echo json_encode($retData);
				//	exit();
					$stringf=$stringf.'插入票价数据失败！';
					$string=$string.$NoOfRunsID.$stringf.->my_error();
					writelog($string);
					$class_mysql_default->my_query("ROLLBACK");
					return $stringf;
				}else{
					$found=true;
				}
				$queryprice=$queryprice & $querypricedetail;
			}
		}
	}
	if($founddate==false && $noprice==false){
	//	$class_mysql_default->my_query("ROLLBACK");
	//	$retData = array('retVal' => 'FAIL', 'retString' => '车型'.$rownorunsloop['nrl_ModelName'].'输入的票价已过期！', 'sql' => $queryString);
	//	echo json_encode($retData);
	//	exit();
		$stringf=$stringf.'车型'.$rownorunsloop['nrl_ModelName'].'输入的票价已过期！';
		$string=$string.$RunID.$stringf;
		writelog($string);
		$class_mysql_default->my_query("ROLLBACK");
		return $stringf;	
	}
	if($found==false){
	//	$class_mysql_default->my_query("ROLLBACK");
	//	$retData = array('retVal' => 'FAIL', 'retString' => '车型'.$rownorunsloop['nrl_ModelName'].'没输入票价！', 'sql' => $queryString);
	//	echo json_encode($retData);
	//	exit();	
		$stringf=$stringf.'车型'.$rownorunsloop['nrl_ModelName'].'没输入票价！';
		$string=$string.$RunID.$stringf;
		writelog($string);
		$class_mysql_default->my_query("ROLLBACK");
		return $stringf;
	}
	if($queryinsertticketmode && $queryprice){
		$strings=1;
		$class_mysql_default->my_query("COMMIT");
		return $strings;
	}else{
		$class_mysql_default->my_query("ROLLBACK");
		return $stringf;
	}
}
?>
