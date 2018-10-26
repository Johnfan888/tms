<?php

/*
 * 票状态：0-网订（未支付）；1-网订取票（窗口支付并打票）；2-网售（网上支付未打票）；3-预留（电话订票）；4-预留取票（窗口支付并打票）；5-网售已打票（窗口或自动售票机）
 * 		 
 */

define("AUTH", "TRUE");
//define("WEBAUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

require_once("tms_v1_sell_cancelticket.php");

if($canclehourwr<10){
	$canclehourwr='0'.$canclehourwr;
}
if ($cancleminutewr<10){
	$cancleminutewr='0'.$cancleminutewr;
}
$canceltime=$canclehourwr.':'.$cancleminutewr.':'.'00';

if($canclehourw<10){
	$canclehourw='0'.$canclehourw;
}
if ($cancleminutew<10){
	$cancleminutew='0'.$cancleminutew;
}
$canceltimew=$canclehourw.':'.$cancleminutew.':'.'00';

//需要班次
$op = $_REQUEST['op'];
if($op=='dellticket'){
	$FromStation=$_REQUEST['FromStation'];
	$currdate=date('Y-m-d');
	$curtime=date('H:i:s');
/*	$SelectNoOfRuns="SELECT tms_bd_TicketMode.tml_NoOfRunsID FROM tms_bd_TicketMode,tms_bd_PriceDetail WHERE tml_NoOfRunsdate='{$currdate}' AND  
		tml_NoOfRunsdate=pd_NoOfRunsdate AND pd_NoOfRunsID=tml_NoOfRunsID AND pd_FromStation='{$FromStation}' AND timediff('{$curtime}',pd_BeginStationTime)<='01:00:00' 
		GROUP BY tml_NoOfRunsID"; */
	$SelectNoOfRuns="SELECT tml_NoOfRunsID FROM tms_bd_TicketMode,tms_bd_PriceDetail WHERE tml_NoOfRunsdate='{$currdate}' 
			AND	tml_NoOfRunsdate=pd_NoOfRunsdate AND pd_NoOfRunsID=tml_NoOfRunsID AND pd_FromStation='{$FromStation}' 
			AND timediff(STR_TO_DATE(pd_BeginStationTime,'%H:%i:%s'),'{$curtime}')<='{$canceltime}'	GROUP BY tml_NoOfRunsID";
	$queryNoOfRuns =$class_mysql_default->my_query($SelectNoOfRuns);
	if(!$queryNoOfRuns) {
			$retData = array('retVal' => 'FAIL', 'retString' => '查询票版和票价数据失败！', 'sql' => $SelectNoOfRuns);
			echo json_encode($retData);
			exit();
	}
	
	while($rowNoOfRuns=mysqli_fetch_array($queryNoOfRuns)) { 
		$SeatI='';
		$FullNumber=0;
		$HalfNumber=0;
		$selectweb="SELECT GROUP_CONCAT(wst_SeatID) AS SeatID,wst_NoOfRunsID,wst_NoOfRunsdate,SUM(wst_FullNumber) AS FullNumber,SUM(wst_HalfNumber) AS HalfNumber 
			FROM tms_websell_WebSellTicket WHERE wst_NoOfRunsID='{$rowNoOfRuns[0]}' AND wst_NoOfRunsdate='{$currdate}' AND wst_FromStation='{$FromStation}' 
			AND (wst_TicketState='0' || wst_TicketState='3') GROUP BY wst_NoOfRunsID";	// 0-网订（未支付）; 3-预留（电话订票）
		$queryweb =$class_mysql_default->my_query($selectweb);
		if(!$queryweb) {
			$retData = array('retVal' => 'FAIL', 'retString' => '查询预留和订票数据失败', 'sql' => $selectweb);
			echo json_encode($retData);
			exit();
		}
		$rowweb=mysqli_fetch_array($queryweb);
		$SeatI=$rowweb['SeatID'];
		$FullNumber=$rowweb['FullNumber'];
		$HalfNumber=$rowweb['HalfNumber'];

		//这里需要锁表或锁记录
		$class_mysql_default->my_query("BEGIN");
		
		$selectmode="SELECT tml_SeatStatus,tml_LeaveSeats, tml_LeaveHalfSeats FROM tms_bd_TicketMode WHERE tml_NoOfRunsID='{$rowweb[1]}' AND tml_NoOfRunsdate='{$rowweb[2]}' FOR UPDATE";
		$querymode =$class_mysql_default->my_query($selectmode);
		if(!$querymode) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '查询票版数据失败！', 'sql' => $selectmode);
			echo json_encode($retData);
			exit();
		}
		
		$rowmode=mysqli_fetch_array($querymode);
		foreach (explode(",",$SeatI) as $key =>$SeatID){
			$rowmode[1]=$rowmode[1]+1;
			$rowmode[0]=substr_replace($rowmode[0], '0',$SeatID-1,1);
		}
		$rowmode[2]=$rowmode[2]+$rowweb['HalfNumber'];
		$update="UPDATE tms_bd_TicketMode SET tml_SeatStatus='{$rowmode[0]}',tml_LeaveSeats='{$rowmode[1]}',tml_LeaveHalfSeats='{$rowmode[2]}' 
			WHERE  tml_NoOfRunsID='{$rowweb[1]}' AND tml_NoOfRunsdate='{$rowweb[2]}'";
		$queryupdate =$class_mysql_default->my_query($update);
		if(!$queryupdate) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新票版失败！', 'sql' => $update);
			echo json_encode($retData);
			exit();
		}
		
		$del="DELETE FROM tms_websell_WebSellTicket WHERE wst_NoOfRunsID='{$rowweb[1]}' AND
			wst_NoOfRunsdate='{$currdate}' AND wst_FromStation='{$FromStation}' AND (wst_TicketState='0' || wst_TicketState='3')";
		$querydel =$class_mysql_default->my_query($del);
		if(!$querydel) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '取消留和订票失败！', 'sql' => $del);
			echo json_encode($retData);
			exit();
		}

		$class_mysql_default->my_query("COMMIT");
	}
	
	//取消网上支付未打票(以后如需要，可打开注释）
/*	$SelectNoOfRuns="SELECT tms_bd_TicketMode.tml_NoOfRunsID FROM tms_bd_TicketMode,tms_bd_PriceDetail WHERE tml_NoOfRunsdate='{$currdate}' AND  
		tml_NoOfRunsdate=pd_NoOfRunsdate AND pd_NoOfRunsID=tml_NoOfRunsID AND pd_FromStation='{$FromStation}' AND timediff('{$curtime}',pd_BeginStationTime)<='{$canceltimew}' 
		GROUP BY tml_NoOfRunsID";
	$queryNoOfRuns =$class_mysql_default->my_query($SelectNoOfRuns);
	if(!$queryNoOfRuns) {
			$retData = array('retVal' => 'FAIL', 'retString' => '查询票版和票价数据失败！', 'sql' => $SelectNoOfRuns);
			echo json_encode($retData);
			exit();
	}
	
	while($rowNoOfRuns=@mysqli_fetch_array($queryNoOfRuns)) { 
		$SeatI='';
		$FullNumber=0;
		$HalfNumber=0;
		$selectweb="SELECT GROUP_CONCAT(wst_SeatID) AS SeatID,wst_NoOfRunsID,wst_NoOfRunsdate,SUM(wst_FullNumber) AS FullNumber,SUM(wst_HalfNumber) AS HalfNumber 
			FROM tms_websell_WebSellTicket WHERE wst_NoOfRunsID='{$rowNoOfRuns[0]}' AND wst_NoOfRunsdate='{$currdate}' 
			AND wst_FromStation='{$FromStation}' AND wst_TicketState='2' GROUP BY wst_NoOfRunsID";	// 2-网售（网上支付未打票）
		$queryweb =$class_mysql_default->my_query($selectweb);
		if(!$queryweb) {
			$retData = array('retVal' => 'FAIL', 'retString' => '查询网售数据失败', 'sql' => $selectweb);
			echo json_encode($retData);
			exit();
		}
		$rowweb=@mysqli_fetch_array($queryweb);
		$SeatI=$rowweb['SeatID'];
		$FullNumber=$rowweb['FullNumber'];
		$HalfNumber=$rowweb['HalfNumber'];
		
		//这里需要锁表或锁记录
		$class_mysql_default->my_query("BEGIN");
		
		$selectmode="SELECT tml_SeatStatus,tml_LeaveSeats, tml_LeaveHalfSeats FROM tms_bd_TicketMode WHERE tml_NoOfRunsID='{$rowweb[1]}' AND tml_NoOfRunsdate='{$rowweb[2]}' FOR UPDATE";
		$querymode =$class_mysql_default->my_query($selectmode);
		if(!$querymode) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '查询票版数据失败！', 'sql' => $selectmode);
			echo json_encode($retData);
			exit();
		}
		
		$rowmode=@mysqli_fetch_array($querymode);
		foreach (explode(",",$SeatI) as $key =>$SeatID){
			$rowmode[1]=$rowmode[1]+1;
			$rowmode[0]=substr_replace($rowmode[0], '0',$SeatID-1,1);
		}
		$rowmode[2]=$rowmode[2]+$rowweb['HalfNumber'];
		
		$update="UPDATE tms_bd_TicketMode SET tml_SeatStatus='{$rowmode[0]}',tml_LeaveSeats='{$rowmode[1]}',tml_LeaveHalfSeats='{$rowmode[2]}' 
			WHERE  tml_NoOfRunsID='{$rowweb[1]}' AND tml_NoOfRunsdate='{$rowweb[2]}'";
		$queryupdate =$class_mysql_default->my_query($update);
		if(!$queryupdate) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新票版失败！', 'sql' => $update);
			echo json_encode($retData);
			exit();
		}
		
		$del="UPDATE tms_websell_WebSellTicket SET wst_TicketState='6' WHERE wst_NoOfRunsID='{$rowweb[1]}' AND   
			wst_NoOfRunsdate='{$currdate}' AND wst_FromStation='{$FromStation}' AND wst_TicketState='2'";  //6网上支付被取消
		$querydel =$class_mysql_default->my_query($del);
		if(!$querydel) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '取消网上购票失败！', 'sql' => $del);
			echo json_encode($retData);
			exit();
		}
		
		$class_mysql_default->my_query("COMMIT");
	}*/
	
	$SuData=array('success' => 'success' );
	echo json_encode($SuData);
	exit();
}
?>
