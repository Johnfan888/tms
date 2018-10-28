<?php
require_once("../ui/inc/init.inc.php");
$WebSellID=$_GET['WebSellID'];
$TicketID=$_GET['TicketID'];
$SafetyTicketNumber=$_GET['SafetyTicketNumber'];
$selectweb="SELECT * FROM tms_websell_WebSellTicket WHERE wst_WebSellID='{$WebSellID}'";
$queryweb =$class_mysql_default->my_query($selectweb); 
$rowweb=mysqli_fetch_array($queryweb);

$selectmode="SELECT tml_SeatStatus FROM tms_bd_TicketMode WHERE tml_NoOfRunsID='{$rowweb['wst_NoOfRunsID']}' AND tml_NoOfRunsdate='{$rowweb['wst_NoOfRunsdate']}'";
$querymode =$class_mysql_default->my_query($selectmode);
$rowmode=@mysqli_fetch_array($querymode);

$i=0;
$TicketI=$TicketID;
$queryinserts=1;

//echo $rowmode['tml_SeatStatus'];
foreach (explode(",",$rowweb['wst_SeatID']) as $key =>$SeatID){
	$rowmode['tml_SeatStatus']=substr_replace($rowmode['tml_SeatStatus'], '1',$SeatID-1,1);
	$i=$i+1;
//	echo $rowmode['tml_SeatStatus'];
	if($i<=$rowweb[19]){
		$insertselltemp="INSERT INTO tms_sell_SellTicketTemp (stt_TicketID,stt_SeatID,stt_NoOfRunsID,stt_LineID,stt_NoOfRunsdate,stt_BeginStationTime,
			stt_StopStationTime,stt_Distance,stt_BeginStationID,stt_BeginStation,stt_FromStationID,stt_FromStation,stt_ReachStationID,stt_ReachStation,
			stt_EndStationID,stt_EndStation,stt_SellPrice,stt_SellPriceType,stt_FullPrice,stt_HalfPrice,stt_StandardPrice,stt_BalancePrice,stt_ServiceFee,
			stt_otherFee1,stt_otherFee2,stt_otherFee3,stt_otherFee4,stt_otherFee5,stt_otherFee6,stt_SellerStationID,stt_SellerStation,stt_BusModelID,
			stt_BusModel,stt_BusID,stt_BusCard,stt_SellID,stt_SellName) VALUES ('{$TicketI}','{$SeatID}','{$rowweb['wst_NoOfRunsID']}','{$rowweb['wst_LineID']}',
			'{$rowweb['wst_NoOfRunsdate']}','{$rowweb['wst_BeginStationTime']}','{$rowweb['wst_StopStationTime']}','{$rowweb['wst_Distance']}',
			'{$rowweb['wst_BeginStationID']}','{$rowweb['wst_BeginStation']}','{$rowweb['wst_FromStationID']}','{$rowweb['wst_FromStation']}','
			{$rowweb['wst_ReachStationID']}','{$rowweb['wst_ReachStation']}','{$rowweb['wst_EndStationID']}','{$rowweb['wst_EndStation']}','{$rowweb['wst_FullPrice']}',
			'全价票','{$rowweb['wst_FullPrice']}','{$rowweb['wst_HalfPrice']}','{$rowweb['wst_StandardPrice']}','{$rowweb['wst_BalancePrice']}','{$rowweb['wst_ServiceFee']}',
			'{$rowweb['wst_otherFee1']}','{$rowweb['wst_otherFee2']}','{$rowweb['wst_otherFee3']}','{$rowweb['wst_otherFee4']}','{$rowweb['wst_otherFee5']}',
			'{$rowweb['wst_otherFee6']}','{$userStationID}','{$userStationName}','{$rowweb['wst_BusModelID']}','{$rowweb['wst_BusModel']}',NULL,NULL,'{$userID}','{$userName}')";
		$queryinsert=$class_mysql_default->my_query($insertselltemp);
		if (!$queryinsert) echo "SQL错误：".$class_mysql_default->my_error();
		$queryinserts=$queryinserts && $queryinsert;
	}else{
		$insertselltemp="INSERT INTO tms_sell_SellTicketTemp (stt_TicketID,stt_SeatID,stt_NoOfRunsID,stt_LineID,stt_NoOfRunsdate,stt_BeginStationTime,
			stt_StopStationTime,stt_Distance,stt_BeginStationID,stt_BeginStation,stt_FromStationID,stt_FromStation,stt_ReachStationID,stt_ReachStation,
			stt_EndStationID,stt_EndStation,stt_SellPrice,stt_SellPriceType,stt_FullPrice,stt_HalfPrice,stt_StandardPrice,stt_BalancePrice,stt_ServiceFee,
			stt_otherFee1,stt_otherFee2,stt_otherFee3,stt_otherFee4,stt_otherFee5,stt_otherFee6,stt_SellerStationID,stt_SellerStation,stt_BusModelID,
			stt_BusModel,stt_BusID,stt_BusCard,stt_SellID,stt_SellName) VALUES ('{$TicketI}','{$SeatID}','{$rowweb['wst_NoOfRunsID']}','{$rowweb['wst_LineID']}',
			'{$rowweb['wst_NoOfRunsdate']}','{$rowweb['wst_BeginStationTime']}','{$rowweb['wst_StopStationTime']}','{$rowweb['wst_Distance']}',
			'{$rowweb['wst_BeginStationID']}','{$rowweb['wst_BeginStation']}','{$rowweb['wst_FromStationID']}','{$rowweb['wst_FromStation']}','
			{$rowweb['wst_ReachStationID']}','{$rowweb['wst_ReachStation']}','{$rowweb['wst_EndStationID']}','{$rowweb['wst_EndStation']}','{$rowweb['wst_HalfPrice']}',
			'半价票','{$rowweb['wst_FullPrice']}','{$rowweb['wst_HalfPrice']}','{$rowweb['wst_StandardPrice']}','{$rowweb['wst_BalancePrice']}','{$rowweb['wst_ServiceFee']}',
			'{$rowweb['wst_otherFee1']}','{$rowweb['wst_otherFee2']}','{$rowweb['wst_otherFee3']}','{$rowweb['wst_otherFee4']}','{$rowweb['wst_otherFee5']}',
			'{$rowweb['wst_otherFee6']}','{$userStationID}','{$userStationName}','{$rowweb['wst_BusModelID']}','{$rowweb['wst_BusModel']}',NULL,NULL,'{$userID}','{$userName}')";
		$queryinsert=$class_mysql_default->my_query($insertselltemp);
		if (!$queryinsert) echo "SQL错误：".$class_mysql_default->my_error();
		$queryinserts=$queryinserts && $queryinsert;
	}
	$TicketI=$TicketI+1;  
}


$updatemode="UPDATE tms_bd_TicketMode SET tml_SeatStatus='{$rowmode['tml_SeatStatus']}' WHERE  tml_NoOfRunsID='{$rowweb['wst_NoOfRunsID']}' AND tml_NoOfRunsdate='{$rowweb['wst_NoOfRunsdate']}'";
$querymode =$class_mysql_default->my_query($updatemode);
if (!$querymode) echo "SQL错误：".$class_mysql_default->my_error();
$updateweb="UPDATE tms_websell_WebSellTicket SET wst_TicketState='1' WHERE wst_WebSellID='{$WebSellID}'";
$queryweb =$class_mysql_default->my_query($updateweb);
if (!$queryweb) echo "SQL错误：".$class_mysql_default->my_error();
if($queryinserts && $querymode && $queryweb){
	$class_mysql_default->my_query("COMMIT");
	echo"<script>alert('取票成功!')</script>";
}else{
	$class_mysql_default->my_query("ROLLBACK");
	echo"<script>alert('取票失败')</script>";
}

$class_mysql_default->my_query("END TRANSACTION"); 

/*
$insertsell="INSERT INTO tms_sell_SellTicket (st_TicketID,st_NoOfRunsID,st_LineID,st_NoOfRunsdate,st_BeginStationTime,st_StopStationTime,st_Distance,
	st_BeginStationID,st_BeginStation,st_FromStationID,st_FromStation,st_ReachStationID,st_ReachStation,st_EndStationID,st_EndStation,st_SellPrice,
	st_SellPriceType,st_ColleSellPriceType,st_TotalMan,st_FullPrice,st_HalfPrice,st_StandardPrice,st_ServiceFee,st_otherFee1,st_otherFee2,st_otherFee3,
	st_otherFee4,st_otherFee5,st_otherFee6,st_StationID,st_Station,st_SellDate,st_SellTime,st_BusModelID,st_BusModel,st_SeatID,st_SellID,st_SellName,
	st_FreeSeats,st_SafetyTicketNumber,st_SafetyTicketMoney,st_TicketState,st_IsBalance,st_BalanceDateTime,st_AlterTicket) VALUES ('{$TicketID}','{$rowweb[4]}',
	'{$rowweb[5]}','{$rowweb[6]}','{$rowweb[7]}','{$rowweb[8]}','{$rowweb[9]}','{$rowweb[10]}','{$rowweb[11]}','{$rowweb[12]}','{$rowweb[13]}','{$rowweb[14]}',
	'{$rowweb[15]}','{$rowweb[16]}','{$rowweb[17]}','{$rowweb[18]}','{$rowweb[22]}','{$rowweb[23]}','{$rowweb[21]}','{$rowweb[24]}','{$rowweb[25]}','{$rowweb[26]}',
	'{$rowweb[27]}','{$rowweb[28]}','{$rowweb[29]}','{$rowweb[30]}','{$rowweb[31]}','{$rowweb[32]}','{$rowweb[33]}','{$rowweb[34]}','{$userStationID}',
	'{$userStationName}','{$rowweb[37]}','{$rowweb[38]}','{$rowweb[39]}','{$userID}','{$userName}',NULL,'{$SafetyTicketNumber}','{$rowweb[21]}',NULL,
	NULL,NULL,NULL)"; */
?>