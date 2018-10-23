<?
//网上预定界面

define("WEBAUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$WebSellID=$_POST['WebSellID'];
$NoofrunsID=$_POST['NoofrunsID'];
$NoOfRunsdate=$_POST['NoOfRunsdate'];
$FromstationID=$_POST['FromstationID'];
$Fromstation=$_POST['Fromstation'];
$ReachstationID=$_POST['ReachstationID'];
$Reachstation=$_POST['Reachstation'];
$FullNumber=$_POST['FullNumber'];
$HalfNumber=$_POST['HalfNumber'];
$AllPrice=$_POST['AllPrice'];
//$UserName=$_POST['UserName'];
//$CertificateType=$_POST['CertificateType'];
//$CertificateNumber=$_POST['CertificateNumber'];
$seats=$FullNumber+$HalfNumber;
$seatno='';
//$UserRegisterName=$_POST['UserRegisterName'];

$selectprice="SELECT * FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID='{$NoofrunsID}' AND pd_NoOfRunsdate='{$NoOfRunsdate}' AND 
	pd_FromStation='{$Fromstation}' AND pd_ReachStation='{$Reachstation}'";
$resultprice=$class_mysql_default->my_query("$selectprice");
$rowsprice= @mysql_fetch_array($resultprice);

/*$selectmodel="SELECT tml_BusModelID,tml_BusModel FROM tms_bd_TicketMode WHERE tml_NoOfRunsID='{$NoofrunsID}' AND 
	tml_NoOfRunsdate='{$NoOfRunsdate}'";
$resultmodel=$class_mysql_default ->my_query("$selectmodel");
$rowsmodle=@mysql_fetch_array($resultmodel); */

//还需要锁表或锁记录
$class_mysql_default->my_query("BEGIN");

$queryString="SELECT tml_SeatStatus,tml_LeaveSeats,tml_BusModelID,tml_BusModel FROM tms_bd_TicketMode WHERE tml_NoOfRunsID='{$NoofrunsID}'
	AND tml_NoOfRunsdate='{$NoOfRunsdate}' FOR UPDATE";
$resultquery = $class_mysql_default->my_query("$queryString"); 
//if (!$resultselect) echo "SQL错误：".mysql_error();
$rows = @mysql_fetch_array($resultquery);
$rows[1]=$rows[1]-$seats;

//更新座位状态和取得座位号
for($i=0; $i<$seats; $i++){
	$array[$i]=strpos($rows[0],'0');
//	$array[$i]=$array[$i]+1;
	$rows[0]=substr_replace($rows[0],'5',$array[$i],1);
	if ($i==0){
		$seatno=$seatno.($array[$i]+1);
	}else{
		$seatno=$seatno.','.($array[$i]+1);
	}
}

$update="UPDATE tms_bd_TicketMode SET tml_LeaveSeats='{$rows[1]}',tml_SeatStatus='{$rows[0]}' WHERE tml_NoOfRunsID='{$NoofrunsID}'
	AND tml_NoOfRunsdate='{$NoOfRunsdate}'";
$queryupdate = $class_mysql_default ->my_query("$update");

$insert="INSERT INTO tms_websell_WebSellTicket (wst_WebSellID,wst_UserName,wst_CertificateType,wst_CertificateNumber,wst_NoOfRunsID,
	wst_LineID,wst_NoOfRunsdate,wst_BeginStationTime,wst_StopStationTime,wst_Distance,wst_BeginStationID,wst_BeginStation,wst_FromStationID,
	wst_FromStation,wst_ReachStationID,wst_ReachStation,wst_EndStationID,wst_EndStation,wst_SellPrice,wst_FullNumber,wst_HalfNumber,
	wst_TotalMan,wst_FullPrice,wst_HalfPrice,wst_StandardPrice,wst_BalancePrice,wst_ServiceFee,wst_otherFee1,wst_otherFee2,wst_otherFee3,
	wst_otherFee4,wst_otherFee5,wst_otherFee6,wst_SellDate,wst_SellTime,wst_BusModelID,wst_BusModel,wst_SeatID,wst_TicketState)
	VALUES ('{$WebSellID}','{$UserName}','{$CertificateType}','{$CertificateNumber}','{$NoofrunsID}','{$rowsprice[1]}','{$NoOfRunsdate}',
	'{$rowsprice[3]}','{$rowsprice[4]}','{$rowsprice[5]}','{$rowsprice[6]}','{$rowsprice[7]}','{$rowsprice[8]}','{$rowsprice[9]}',
	'{$rowsprice[10]}','{$rowsprice[11]}','{$rowsprice[12]}','{$rowsprice[13]}','{$AllPrice}','{$FullNumber}','{$HalfNumber}','{$seats}',
	'{$rowsprice[14]}','{$rowsprice[15]}','{$rowsprice[16]}','{$rowsprice[17]}','{$rowsprice[18]}','{$rowsprice[19]}','{$rowsprice[20]}',
	'{$rowsprice[21]}','{$rowsprice[22]}','{$rowsprice[23]}','{$rowsprice[24]}',CURDATE(), CURTIME(),'{$rows[2]}','{$rows[3]}',
	'{$seatno}','0')";
$queryinsert = $class_mysql_default->my_query("$insert"); 
//if (!$queryinsert) echo "SQL错误：".mysql_error();
if($resultquery && $queryupdate && $queryinsert){
//if($queryupdate ){
	$class_mysql_default->my_query("COMMIT");
	echo "<script>alert('订票成功！');location.assign('tms_v1_websell_websearchreserve.php');</script>";	
}else{
	$class_mysql_default->my_query("ROLLBACK");
	echo "<script>alert('订票失败！ 请返回。');location.assign('tms_v1_websell_webreserve.php?NoofrunsID=$NoofrunsID&Selldate=$NoOfRunsdate&FromStation=$Fromstation&ReachStation=$Reachstation');</script>";	
}  
$class_mysql_default->my_query("END TRANSACTION"); 
?>
