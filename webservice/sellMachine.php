<?php
//定义页面必须验证是否登录
//define("AUTH", "TRUE");

//载入初始化文件
//require_once("../ui/inc/init.inc.php");
class test   
{ 
	function GetSysTime(){
		$systemtime=date('Y-m-d H:i:s');
		if($systemtime!=''){
			$retData = array('Result' => '0' ,'Msg' =>urlencode('成功获取系统时间'), 'SysTime'=>$systemtime);
		}else{
			$retData = array('Result' => '1001' ,'Msg' =>urlencode('获取系统时间失败'));
		}
		return json_encode($retData);
	}
	function GetTicketNo($Opercode){
		require_once("../ui/inc/init.inc.php");
		$selectTicketProvide="SELECT tp_CurrentTicket,tp_EndTicket FROM tms_bd_TicketProvide WHERE tp_InceptUserID='{$Opercode}'
			AND tp_InceptTicketNum>0 AND tp_UseState='当前'";
		$queryTicketProvide=$class_mysql_default->my_query("$selectTicketProvide");
	//	$rowTicketProvide=mysqli_fetch_array($queryTicketProvide);
		if ($queryTicketProvide){
			if(mysqli_num_rows($queryTicketProvide) == 0){
				$retData = array('Result' => '1002' ,'Msg' =>'取票号失败');
			}else{
				$rowTicketProvide=mysqli_fetch_array($queryTicketProvide);
				$retData = array('Result' => '0' ,'Msg' =>urlencode('取票号成功'), 'curTicketNo'=>$rowTicketProvide['tp_CurrentTicket'], 
					'endTicketNO'=>$rowTicketProvide['tp_EndTicket']);
			}
		}else{
			$retData = array('Result' => '1002' ,'Msg' =>'取票号失败');
		}
		return json_encode($retData);
	}
	
	function GetTicketParam($Opercode){
		
	}
	
	function GetNode($StationCode){
		require_once("../ui/inc/init.inc.php");
		$selectSiteSet="SELECT sset_SiteName,sset_HelpCode,sset_Region FROM tms_bd_SiteSet WHERE sset_SiteID='{$StationCode}'";
		$querySiteSet=$class_mysql_default->my_query("$selectSiteSet");
		if(!$querySiteSet){
			$retData = array('Result' => '1003' ,'Msg' =>'取站点失败');
			return json_encode($retData);
		}
		$rowSiteSet=mysqli_fetch_array($querySiteSet);
		$retData = array('Result' => '0' ,'Msg' =>urlencode('取站点成功'),'NodeCode'=>$StationCode,'NodeName'=>urlencode($rowSiteSet['sset_SiteName']),
			'NodeSC'=>$rowSiteSet['sset_HelpCode'],'provinceCode'=>'','NodeProvince'=>'','NodeCity'=>'','NodeDistrict'=>urlencode($rowSiteSet['sset_Region']));
		return json_encode($retData);
	}
	
	function GetSchema($StationCode,$NodeCode, $SchDate){
		require_once("../ui/inc/init.inc.php");
	//	$selectusinfor="SELECT ui_UserSationID FROM tms_sys_UsInfor WHERE ui_UserID='{$Opercode}'";
	//	$queryusinfor=$class_mysql_default->my_query("$selectusinfor");
	//	$rowusifor=mysqli_fetch_array($queryusinfor);
		$selectruns="SELECT pd_NoOfRunsID,pd_LineID,pd_NoOfRunsdate,pd_BeginStationTime,pd_Distance,pd_StopStationTime,
			pd_BeginStation,pd_EndStation,tml_LeaveSeats,tml_BusModel,tml_CheckTicketWindow,pd_FullPrice,pd_HalfPrice,tml_Allticket,
			li_LineID,li_LineName,li_LineType,li_BeginSite,li_EndSite,GROUP_CONCAT( nds_SiteName ORDER BY nds_ID ASC) AS SiteName 
			FROM tms_bd_PriceDetail LEFT OUTER JOIN tms_bd_TicketMode ON tml_NoOfRunsID=pd_NoOfRunsID AND tml_NoOfRunsdate=pd_NoOfRunsdate 
			LEFT OUTER JOIN tms_bd_LineInfo ON li_LineID=pd_LineID LEFT OUTER JOIN tms_bd_NoRunsDockSite ON tml_NoOfRunsID = nds_NoOfRunsID WHERE 
			pd_FromStationID='{$StationCode}' AND pd_ReachStationID='{$NodeCode}' AND pd_NoOfRunsdate='{$SchDate}' GROUP BY nds_NoOfRunsID";
		$queryruns=$class_mysql_default->my_query("$selectruns");
		if(!$queryruns){
			$retData = array('Result' => '1004' ,'Msg' =>'取班次失败');
			return json_encode($retData);
		}
		while($rowruns=mysqli_fetch_array($queryruns)){
			if($rowruns['tml_Allticket']==0){
				$SchType='定时班';
			}else{
				$SchType='非定时班';
			}
			$retData[] = array('Result' => '0','Msg' =>urlencode('取班次成功'),'SchCode'=>$rowruns['pd_NoOfRunsID'],'SchTyp'=>urlencode($SchType),
				'SchDate'=>$rowruns['pd_NoOfRunsdate'],'SchTime'=>$rowruns['pd_BeginStationTime'],'RTicketQty'=>$rowruns['tml_LeaveSeats'],
				'Fare'=>$rowruns['pd_FullPrice'],'HalfFare'=>$rowruns['pd_HalfPrice'],'LineCode'=>$rowruns['pd_LineID'],'LineType'=>urlencode($rowruns['li_LineType']),
				'LineName'=>urlencode($rowruns['li_LineName']),'LineNodes'=>urlencode($rowruns['SiteName']),'StartStation'=>urlencode($rowruns['li_BeginSite']),'EndStation'=>urlencode($rowruns['li_EndSite']),
				'BusType'=>urlencode($rowruns['tml_BusModel']),'BusPark'=>'','Wicket'=>$rowruns['tml_CheckTicketWindow'],'Distance'=>$rowruns['pd_Distance'],'TravelTime'=>'');
		}
		return json_encode($retData);
	}
	function TicketLock($StationCode,$NodeCode,$SchCode,$SchDate,$LockInfo,$TicketQty,$CTicketNo,$Opercod){
		require_once("../ui/inc/init.inc.php");
		$LockID=time(); //暂时
		$selectprice="SELECT pd_FullPrice,pd_HalfPrice,pd_FromStation,pd_ReachStation FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID='{$SchCode}' AND pd_NoOfRunsdate='{$SchDate}' AND pd_FromStationID='{$StationCode}' 
			AND pd_ReachStationID='{$NodeCode}'";
		$queryprice=$class_mysql_default->my_query("$selectprice");
		$rowprice=@mysqli_fetch_array($queryprice);
		$class_mysql_default->my_query("BEGIN");
		$selectticketmodel="SELECT tml_SeatStatus,tml_LeaveSeats,tml_LeaveHalfSeats FROM tms_bd_TicketMode WHERE tml_NoOfRunsID='{$SchCode}' AND tml_NoOfRunsdate='{$SchDate}'
			FOR UPDATE";
		$queryticketmodel=$class_mysql_default->my_query("$selectticketmodel");
		if(!$queryticketmodel){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('Result' => '1005' ,'Msg' =>'锁座位失败1');
			return json_encode($retData);
		}
		$rowsticketmodel = @mysqli_fetch_array($queryticketmodel);
		$SeatStatus=$rowsticketmodel['tml_SeatStatus'];
		$LeaveSeats=$rowsticketmodel['tml_LeaveSeats'];
		$LeaveHalfSeats=$rowsticketmodel['tml_LeaveHalfSeats'];
		$TicketNo=$CTicketNo; //暂时
		for ($i=0;$i<$TicketQty;$i++){
			 $str = substr($LockInfo,$i,1);
		//	 $TicketNo=$CTicketNo+$i;
			 $seatID=strpos($SeatStatus, '0');
			 $SeatStatus=substr_replace($SeatStatus, '1', $seatID, 1);
			 $LeaveSeats=$LeaveSeats-1;
			 if($str!=1){
			 	$LeaveHalfSeats=$LeaveHalfSeats-1;
			 	$price=$rowprice['pd_HalfPrice'];
			 }else{
			 	$price=$rowprice['pd_FullPrice'];
			 }
			$insertlockseat="INSERT INTO tms_sell_LockSeat (ls_LockID,ls_NoOfRunsID,ls_NoOfRunsdate,ls_FromStationID,ls_ReachStationID,ls_SeatID,ls_sellID,ls_Price,
				ls_Type,ls_FromStation,ls_ReachStation,ls_TicketID) VALUES('{$LockID}','{$SchCode}','{$SchDate}','{$StationCode}','{$NodeCode}','{$seatID}','{$Opercod}',
				'{$price}','{$str}','{$rowprice['pd_FromStation']}','{$rowprice['pd_ReachStation']}','{$TicketNo}')";
			$querylockseat=$class_mysql_default->my_query("$insertlockseat");
			if(!$querylockseat){
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('Result' => '1005' ,'Msg' =>'锁位失败');
				return json_encode($retData);
			}else{
				$retData[]=array('Result'=>'0','Msg'=>'锁位成功', 'LockID'=>$LockID, 'TicketNo'=>$TicketNo,'Seat'=>$seatID);		
			}
		}
		$updateticketmodel="UPDATE tms_bd_TicketMode SET tml_SeatStatus='{$SeatStatus}',tml_LeaveSeats='{$LeaveSeats}', tml_LeaveHalfSeats='{$LeaveHalfSeats}' WHERE 
			tml_NoOfRunsID='{$SchCode}' AND tml_NoOfRunsdate='{$SchDate}'";
		$queryupdate=$class_mysql_default->my_query("$updateticketmodel");
		if(!$queryupdate){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('Result' => '1005' ,'Msg' =>'锁位失败3');
			return json_encode($retData);
		} 
	/*	$updateTicketProvide="UPDATE tms_bd_TicketProvide SET tp_CurrentTicket='{$TicketNo}' WHERE tp_InceptUserID='{$Opercod}' AND tp_CurrentTicket='{$CTicketNo}'";
		if(!$updateTicketProvide){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('Result' => '1005' ,'Msg' =>'锁位失败');
			return json_encode($retData);
		} */
		$class_mysql_default->my_query("COMMIT");
		return json_encode($retData); 
	}
	function TicketUnlock($LockID){
		require_once("../ui/inc/init.inc.php");
		$selectlockID1="SELECT ls_TicketID,ls_NoOfRunsID,ls_NoOfRunsdate,ls_sellID FROM tms_sell_LockSeat WHERE ls_LockID='{$LockID}' AND 
			ls_ID=(SELECT MIN(ls_ID) FROM tms_sell_LockSeat WHERE ls_LockID='{$LockID}')";
		$querylockID1=$class_mysql_default->my_query("$selectlockID1");
		if(!$querylockID1){
			$retData = array('Result' => '1006' ,'Msg' =>'取消锁位失败');
			return json_encode($retData);
		}
		$rowlockID1=mysqli_fetch_array($querylockID1);
		$class_mysql_default->my_query("BEGIN");
		$selectticketmodel="SELECT tml_SeatStatus,tml_LeaveSeats,tml_LeaveHalfSeats FROM tms_bd_TicketMode WHERE tml_NoOfRunsID='{$rowlockID1['ls_NoOfRunsID']}' AND 
		 tml_NoOfRunsdate='{$rowlockID1['ls_NoOfRunsdate']}' FOR UPDATE";
		$queryticketmodel=$class_mysql_default->my_query("$selectticketmodel");
		if(!$queryticketmodel){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('Result' => '1006' ,'Msg' =>'取消锁位失败');
			return json_encode($retData);
		}
		$rowsticketmodel = @mysqli_fetch_array($queryticketmodel);
		$SeatStatus=$rowsticketmodel['tml_SeatStatus'];
		$LeaveSeats=$rowsticketmodel['tml_LeaveSeats'];
		$LeaveHalfSeats=$rowsticketmodel['tml_LeaveHalfSeats'];
	//	$i=0;
		$selectlockID="SELECT ls_TicketID, ls_SeatID, ls_Type FROM tms_sell_LockSeat WHERE ls_LockID='{$LockID}'";
		$querylockID=$class_mysql_default->my_query("$selectlockID");
		if(!$querylockID){
			$retData = array('Result' => '1006' ,'Msg' =>'取消锁位失败');
			return json_encode($retData);
		}
		while($rowlockID=mysqli_fetch_array($querylockID)){
	//		$i=$i+1;
			$seatID=$rowlockID['ls_SeatID'];
			$SeatStatus=substr_replace($SeatStatus, '0', $seatID, 1);
			$LeaveSeats=$LeaveSeats+1;
			if($rowlockID['ls_Type']!=1){
				$LeaveHalfSeats=$LeaveHalfSeats+1;
			}
		}
		$updateticketmodel="UPDATE tms_bd_TicketMode SET tml_SeatStatus='{$SeatStatus}',tml_LeaveSeats='{$LeaveSeats}', tml_LeaveHalfSeats='{$LeaveHalfSeats}' WHERE 
			tml_NoOfRunsID='{$rowlockID1['ls_NoOfRunsID']}' AND tml_NoOfRunsdate='{$rowlockID1['ls_NoOfRunsdate']}'";
		$queryupdate=$class_mysql_default->my_query("$updateticketmodel");
		if(!$queryupdate){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('Result' => '1006' ,'Msg' =>'取消锁位失败');
			return json_encode($retData);
		}
	/*	$tickID=$rowlockID1['ls_TicketID']+$i;
		$updateTicketProvide="UPDATE tms_bd_TicketProvide SET tp_CurrentTicket='{$rowlockID1['ls_TicketID']}' WHERE tp_InceptUserID='{$rowlockID1['ls_sellID']}' AND 
			tp_CurrentTicket='{$tickID}'";
		if(!$updateTicketProvide){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('Result' => '1006' ,'Msg' =>'取消锁位失败');
			return json_encode($retData);
		} */
		$dellock="DELETE FROM tms_sell_LockSeat WHERE ls_LockID='{$LockID}'";
		$querylock=$class_mysql_default->my_query("$dellock");
		if(!$querylock){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('Result' => '1006' ,'Msg' =>'取消锁位失败');
			return json_encode($retData);
		}
		$class_mysql_default->my_query("COMMIT");
		$retData = array('Result' => '0' ,'Msg' =>'取消锁位成功');
		return json_encode($retData);
	}
	function TicketUpdate($LockID,$CTicketNo){
		require_once("../ui/inc/init.inc.php");
		$selectlockseat="SELECT ls_ID, ls_NoOfRunsID,ls_NoOfRunsdate,ls_FromStationID,ls_FromStation,ls_ReachStationID,ls_ReachStation,ls_TicketID,ls_SeatID,
			ls_Type,ls_Price,ls_sellID,tml_BusModelID,tml_BusModel,tml_CheckTicketWindow,pd_BeginStationTime,pd_StopStationTime,pd_Distance,pd_BeginStationID,pd_BeginStation,
			pd_EndStationID,pd_EndStation,pd_FullPrice,pd_HalfPrice,pd_StandardPrice,pd_BalancePrice,pd_ServiceFee,pd_otherFee1,pd_otherFee2,pd_otherFee3,pd_otherFee4,
			pd_otherFee5,pd_otherFee6,pd_StationID,pd_Station,tml_LineID,ui_UserName,ui_UserSationID,ui_UserSation FROM tms_sell_LockSeat LEFT OUTER JOIN tms_bd_TicketMode ON 
			tml_NoOfRunsID=ls_NoOfRunsID AND tml_NoOfRunsdate=ls_NoOfRunsdate LEFT OUTER JOIN tms_bd_PriceDetail ON pd_NoOfRunsID= ls_NoOfRunsID AND 
			pd_NoOfRunsdate=ls_NoOfRunsdate AND pd_FromStationID=ls_FromStationID AND pd_ReachStationID=ls_ReachStationID LEFT OUTER JOIN tms_sys_UsInfor ON ui_UserID=ls_sellID 
			WHERE ls_LockID='{$LockID}' AND ls_ID=(SELECT min(ls_ID) FROM tms_sell_LockSeat WHERE ls_LockID='{$LockID}')";
		$querylockseat=$class_mysql_default->my_query("$selectlockseat");
		if(!$querylockseat){
			$retData = array('Result' => '10071' ,'Msg' =>'售票更新失败');
			return json_encode($retData);
		}
		$rowlockseat=mysqli_fetch_array($querylockseat);
		if ($rowlockseat['ls_Type']==1){
			$SellPriceType = "全票";
		}else{
			$SellPriceType = "半票";
		}
		$curdate=date('Y-m-d');
		$curtime=date('H:i:s');
		$class_mysql_default->my_query("BEGIN");
		$insertsellticket="INSERT INTO tms_sell_SellTicket (st_TicketID,st_NoOfRunsID,st_LineID,st_NoOfRunsdate,st_BeginStationTime,st_StopStationTime,st_Distance,
			st_BeginStationID,st_BeginStation,st_FromStationID,st_FromStation,st_ReachStationID,st_ReachStation,st_EndStationID,st_EndStation,st_SellPrice,st_SellPriceType,
			st_TotalMan,st_FullPrice,st_HalfPrice,st_StandardPrice,st_BalancePrice,st_ServiceFee,st_otherFee1,st_otherFee2,st_otherFee3,st_otherFee4,st_otherFee5,st_otherFee6,
			st_StationID,st_Station,st_SellDate,st_SellTime,st_BusModelID,st_BusModel,st_SeatID,st_SellID,st_SellName,st_FreeSeats,st_SafetyTicketID,st_SafetyTicketNumber,
			st_SafetyTicketMoney,st_SafetyTicketPassengerID,st_TicketState,st_IsBalance,st_BalanceDateTime,st_AlterTicket) VALUES ('{$CTicketNo}','{$rowlockseat['ls_NoOfRunsID']}',
			'{$rowlockseat['tml_LineID']}','{$rowlockseat['ls_NoOfRunsdate']}','{$rowlockseat['pd_BeginStationTime']}','{$rowlockseat['pd_StopStationTime']}','{$rowlockseat['pd_Distance']}',
			'{$rowlockseat['pd_BeginStationID']}','{$rowlockseat['pd_BeginStation']}','{$rowlockseat['ls_FromStationID']}','{$rowlockseat['ls_FromStation']}','{$rowlockseat['ls_ReachStationID']}',
			'{$rowlockseat['ls_ReachStation']}','{$rowlockseat['pd_EndStationID']}','{$rowlockseat['pd_EndStation']}','{$rowlockseat['ls_Price']}','{$SellPriceType}','1','{$rowlockseat['pd_FullPrice']}',
			'{$rowlockseat['pd_HalfPrice']}','{$rowlockseat['pd_StandardPrice']}','{$rowlockseat['pd_BalancePrice']}','{$rowlockseat['pd_ServiceFee']}','{$rowlockseat['pd_otherFee1']}',
			'{$rowlockseat['pd_otherFee2']}','{$rowlockseat['pd_otherFee3']}','{$rowlockseat['pd_otherFee4']}','{$rowlockseat['pd_otherFee5']}','{$rowlockseat['pd_otherFee6']}','{$rowlockseat['ui_UserSationID']}',
			'{$rowlockseat['ui_UserSation']}','{$curdate}','{$curtime}','{$rowlockseat['tml_BusModelID']}','{$rowlockseat['tml_BusModel']}','{$rowlockseat['ls_SeatID']}','{$rowlockseat['ls_sellID']}',
			'{$rowlockseat['ui_UserName']}','0',NULL,NULL,NULL,NULL,'0','0',NULL,'0')";
		$queryinsert=$class_mysql_default->my_query("$insertsellticket");
		if(!$queryinsert){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('Result' => '10072' ,'Msg' =>'售票更新失败'.$class_mysql_default->my_error());
			return json_encode($retData);
		}
		$TicketNo=$CTicketNo+1;
		$updateticketprovide="UPDATE tms_bd_TicketProvide SET tp_CurrentTicket='{$TicketNo}',tp_InceptTicketNum=tp_InceptTicketNum-1 WHERE tp_InceptUserID='{$rowlockseat['ls_sellID']}' AND 
			tp_CurrentTicket='{$CTicketNo}'";
		$queryupdate=$class_mysql_default->my_query("$updateticketprovide");
		if(!$queryupdate){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('Result' => '10073' ,'Msg' =>'售票更新失败');
			return json_encode($retData);
		}
		$deletelockseat="DELETE FROM tms_sell_LockSeat WHERE ls_ID='{$rowlockseat['ls_ID']}'";
		$querydelete=$class_mysql_default->my_query("$deletelockseat");
		if(!$querydelete){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('Result' => '10074' ,'Msg' =>'售票更新失败');
			return json_encode($retData);
		}
		$class_mysql_default->my_query("COMMIT");
		$retData = array('Result' => '0' ,'Msg' =>'售票更新成功','StationCode'=>$rowlockseat['ls_FromStationID'],'StationName'=>$rowlockseat['ls_FromStation'],'NodeCode'=>$rowlockseat['ls_ReachStationID'],
			'NodeName'=>$rowlockseat['ls_ReachStation'],'LineCode'=>$rowlockseat['tml_LineID'],'LineName'=>'','LineType'=>'','SchCode'=>$rowlockseat['ls_NoOfRunsID'],'SchName'=>'','SchType'=>'',
			'SchDate'=>$rowlockseat['ls_NoOfRunsdate'],'SchTime'=>$rowlockseat['pd_BeginStationTime'],'TicketType'=>$SellPriceType,'Fare'=>$rowlockseat['ls_Price'],'BAFare'=>'','TopFare'=>'',
			'Seat'=>$rowlockseat['ls_SeatID'],'BusType'=>$rowlockseat['tml_BusModel'],'BusPark'=>'','Wicket'=>$rowlockseat['tml_CheckTicketWindow'],'TicketNo'=>$CTicketNo,'Barcode'=>'','CustPin'=>'',
			'OpTime'=>$curdate.' '.$curtime,'OperCode'=>$rowlockseat['ls_sellID']);
		return json_encode($retData);
	}
	function Ticketconfirm($TicketNo){
		if($TicketNo){
			$retData = array('Result' => '0' ,'Msg' =>'车票打印确认成功');
			return json_encode($retData);
		}else{
			$retData = array('Result' => '1008' ,'Msg' =>'车票打印确认失败');
			return json_encode($retData);
		}
	}
	
	function TicketList($CustType,$CustNo){  //多加了工号
		require_once("../ui/inc/init.inc.php");
	//	$selecticketProvide="SELECT tp_CurrentTicket FROM tms_bd_TicketProvide WHERE tp_InceptUserID='{$Opercode}' AND tp_UseState='当前'";
		if($CustType=='身份证'){
			$str="wst_CertificateNumber='{$CustNo}'";
		}
		if($CustType=='订单号'){
			$str="wst_WebSellID='{$CustNo}'";
		}
		if($CustType=='手机号'){
			$selectWebSellTicket="SELECT wst_WebSellID, wst_FromStation,wst_ReachStation,wst_NoOfRunsID,wst_NoOfRunsdate,wst_BeginStationTime,wst_SellPrice,wst_SeatID FROM tms_websell_WebSellTicket LEFT OUTER JOIN tms_bd_WebUserRegister 
				ON wur_UserName=wst_UserName AND wur_CertificateNumber=wst_CertificateNumber WHERE wur_Phone='{$CustNo}'";
		}else{
			$selectWebSellTicket="SELECT wst_WebSellID,wst_FromStation,wst_ReachStation,wst_NoOfRunsID,wst_NoOfRunsdate,wst_BeginStationTime,wst_SellPrice,wst_SeatID FROM tms_websell_WebSellTicket WHERE wst_TicketState='0'
		 		AND ".$str;
		}
		$queryWebSellTicket=$class_mysql_default->my_query("$selectWebSellTicket");
		if(!$queryWebSellTicket){
			$retData = array('Result' => '1009' ,'Msg' =>'取票查询失败');
			return json_encode($retData);
		}
		while($rowWebSellTicket=mysqli_fetch_array($queryWebSellTicket)){
			foreach (explode(",",$rowWebSellTicket['wst_SeatID']) as $key =>$SeatID){
				$TicketID=time().'D'.$SeatID;
				$retData[]=array('Result' => '0','TicketID'=>$TicketID, 'OrderNo'=>$rowWebSellTicket['wst_WebSellID'],'StationName'=>$rowWebSellTicket['wst_FromStation'],'NodeName'=>$rowWebSellTicket['wst_ReachStation'],
					'SchCode'=>$rowWebSellTicket['wst_NoOfRunsID'], 'SchDate'=>$rowWebSellTicket['wst_NoOfRunsdate'],'SchTime'=>$rowWebSellTicket['wst_BeginStationTime'],'Fare'=>$rowWebSellTicket['wst_SellPrice'],
					'Seat'=>$SeatID,'PrintFlag'=>'0');
			}
		}
		return json_encode($retData);
	}
	function TicketPrint($OrderNo,$TicketID,$CTicketNo){
		require_once("../ui/inc/init.inc.php");
		$selectWebSellTicket="SELECT wst_NoOfRunsID,wst_LineID,wst_NoOfRunsdate,wst_BeginStationTime,wst_StopStationTime,wst_Distance,wst_BeginStationID,wst_BeginStation,wst_FromStationID,wst_FromStation,wst_ReachStationID,wst_ReachStation,
			wst_EndStationID,wst_EndStation,wst_SellPrice,wst_FullNumber,wst_HalfNumber,wst_TotalMan,wst_SellPriceType,wst_ColleSellPriceType,wst_FullPrice,wst_HalfPrice,wst_StandardPrice,wst_BalancePrice,wst_ServiceFee,wst_otherFee1,wst_otherFee2,
			wst_otherFee3,wst_otherFee4,wst_otherFee5,wst_otherFee6,wst_BusModelID,wst_BusModel,wst_SeatID FROM tms_websell_WebSellTicket WHERE wst_WebSellID='{$OrderNo}'";
		$queryWebSellTicket=$class_mysql_default->my_query("$selectWebSellTicket");
		if(!$queryWebSellTicket){
			$retData = array('Result' => '10101','Msg' =>'取票打印失败');
			return json_encode($retData);
		}
		$rowWebSellTicket=mysqli_fetch_array($queryWebSellTicket);
		//座位号
		$str=explode('D',$TicketID);
		$SeatID=$str[1];
		$curdate=date('Y-m-d');
		$curtime=date('H:i:s');
		$selectTicketProvide="SELECT tp_InceptUserID,tp_InceptUser,tp_UserSation,ui_UserSationID FROM tms_bd_TicketProvide LEFT OUTER JOIN tms_sys_UsInfor ON ui_UserID=tp_InceptUserID WHERE 
			tp_CurrentTicket='{$CTicketNo}' AND tp_Type='客票' AND tp_InceptTicketNum>0";
		$queryTicketProvide=$class_mysql_default->my_query("$selectTicketProvide");
		if(!$queryTicketProvide){
			$retData = array('Result' => '10102' ,'Msg' =>'取票打印失败');
			return json_encode($retData);
		}
		$rowTicketProvide=mysqli_fetch_array($queryTicketProvide);
		$class_mysql_default->my_query("BEGIN");
		$insertsellticket="INSERT INTO tms_sell_SellTicket (st_TicketID,st_NoOfRunsID,st_LineID,st_NoOfRunsdate,st_BeginStationTime,st_StopStationTime,st_Distance,
			st_BeginStationID,st_BeginStation,st_FromStationID,st_FromStation,st_ReachStationID,st_ReachStation,st_EndStationID,st_EndStation,st_SellPrice,st_SellPriceType,
			st_TotalMan,st_FullPrice,st_HalfPrice,st_StandardPrice,st_BalancePrice,st_ServiceFee,st_otherFee1,st_otherFee2,st_otherFee3,st_otherFee4,st_otherFee5,st_otherFee6,
			st_StationID,st_Station,st_SellDate,st_SellTime,st_BusModelID,st_BusModel,st_SeatID,st_SellID,st_SellName,st_FreeSeats,st_SafetyTicketID,st_SafetyTicketNumber,
			st_SafetyTicketMoney,st_SafetyTicketPassengerID,st_TicketState,st_IsBalance,st_BalanceDateTime,st_AlterTicket) VALUES ('{$CTicketNo}', '{$rowWebSellTicket['wst_NoOfRunsID']}',
			'{$rowWebSellTicket['wst_LineID']}','{$rowWebSellTicket['wst_NoOfRunsdate']}','{$rowWebSellTicket['wst_BeginStationTime']}','{$rowWebSellTicket['wst_StopStationTime']}','{$rowWebSellTicket['wst_Distance']}',
			'{$rowWebSellTicket['wst_BeginStationID']}','{$rowWebSellTicket['wst_BeginStation']}','{$rowWebSellTicket['wst_FromStationID']}','{$rowWebSellTicket['wst_FromStation']}','{$rowWebSellTicket['wst_ReachStationID']}',
			'{$rowWebSellTicket['wst_ReachStation']}','{$rowWebSellTicket['wst_EndStationID']}','{$rowWebSellTicket['wst_EndStation']}','{$rowWebSellTicket['wst_SellPrice']}','{$rowWebSellTicket['wst_SellPriceType']}','1',
			'{$rowWebSellTicket['wst_FullPrice']}',
			'{$rowWebSellTicket['wst_HalfPrice']}','{$rowWebSellTicket['wst_StandardPrice']}','{$rowWebSellTicket['wst_BalancePrice']}','{$rowWebSellTicket['wst_ServiceFee']}','{$rowWebSellTicket['wst_otherFee1']}',
			'{$rowWebSellTicket['wst_otherFee2']}','{$rowWebSellTicket['wst_otherFee3']}','{$rowWebSellTicket['wst_otherFee4']}','{$rowWebSellTicket['wst_otherFee5']}','{$rowWebSellTicket['wst_otherFee6']}','{$rowTicketProvide['ui_UserSationID']}',
			'{$rowTicketProvide['tp_UserSation']}','{$curdate}','{$curtime}','{$rowWebSellTicket['wst_BusModelID']}','{$rowWebSellTicket['wst_BusModel']}','{$SeatID}','{$rowTicketProvide['tp_InceptUserID']}',
			'{$rowTicketProvide['tp_InceptUser']}','0',NULL,NULL,NULL,NULL,'0','0',NULL,'0')";
		$queryinsert=$class_mysql_default->my_query("$insertsellticket");
		if(!$queryinsert){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('Result' => '10103' ,'Msg' =>'取票打印失败');
			return json_encode($retData);
		}
		$TicketNo=$CTicketNo+1;
		$updateticketprovide="UPDATE tms_bd_TicketProvide SET tp_CurrentTicket='{$TicketNo}',tp_InceptTicketNum=tp_InceptTicketNum-1 WHERE tp_InceptUserID='{$rowlockseat['ls_sellID']}' AND 
			tp_CurrentTicket='{$CTicketNo}'";
		$queryupdate=$class_mysql_default->my_query("$updateticketprovide");
		if(!$queryupdate){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('Result' => '10104' ,'Msg' =>'取票打印失败');
			return json_encode($retData);
		}
		$updateWebSellTicket="UPDATE tms_websell_WebSellTicket SET wst_TicketState='1' WHERE  wst_WebSellID='{$OrderNo}'";
		$queryupdateWebSellTicket=$class_mysql_default->my_query("$updateWebSellTicket");
		if(!$queryupdateWebSellTicket){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('Result' => '10105' ,'Msg' =>'取票打印失败');
			return json_encode($retData);
		}
		$class_mysql_default->my_query("COMMIT");
		$retData = array('Result' => '0' ,'Msg' =>'取票打印成功','StationCode'=>$rowWebSellTicket['wst_FromStationID'],'StationName'=>$rowWebSellTicket['wst_FromStation'],'NodeCode'=>$rowWebSellTicket['wst_ReachStationID'],
			'NodeName'=>$rowWebSellTicket['wst_ReachStation'],'LineCode'=>$rowWebSellTicket['wst_LineID'],'LineName'=>'','LineType'=>'','SchCode'=>$rowWebSellTicket['wst_NoOfRunsID'],'SchName'=>'','SchType'=>'',
			'SchDate'=>$rowWebSellTicket['wst_NoOfRunsdate'],'SchTime'=>$rowWebSellTicket['wst_BeginStationTime'],'TicketType'=>$rowWebSellTicket['wst_SellPriceType'],'Fare'=>$rowWebSellTicket['wst_SellPrice'],'BAFare'=>'','TopFare'=>'',
			'Seat'=>$SeatID,'BusType'=>$rowWebSellTicket['wst_BusModel'],'BusPark'=>'','Wicket'=>'','TicketNo'=>$CTicketNo,'Barcode'=>'','CustPin'=>'',
			'OpTime'=>$curdate.' '.$curtime,'OperCode'=>$rowTicketProvide['tp_InceptUserID']);
		return json_encode($retData);
	}
}

$server = new SoapServer(null, array('uri'=>'http://61.187.190.148:27777/','location'=>'http://61.187.190.148:27777/tms/webservice/sellMachine.php'));   
$server->setClass('test');     
$server->handle();
?>
