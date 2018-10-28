<?
//座位预览界面

define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$NoOfRunsID = $_GET['nrID'];
$NoOfRunsdate = $_GET['nrDate'];

if(!empty($NoOfRunsID)) {
	$strsqlselet = "SELECT `tml_TotalSeats`, `tml_SeatStatus` FROM `tms_bd_TicketMode` WHERE 
			`tml_NoOfRunsID` = '$NoOfRunsID' AND `tml_NoOfRunsdate`='$NoOfRunsdate'";
	$resultselet = $class_mysql_default->my_query("$strsqlselet");
	if ($rows = @mysqli_fetch_array($resultselet)){
		$seatNum = $rows['tml_TotalSeats'];
		$seatStatus = substr($rows['tml_SeatStatus'], 0, 1);
		$seatNo = 0;
		while($seatNum != 0) {
			if ($seatNo % 10 == 0 && $seatNo != 0){
?>				
				<br></br>
<?php		
			}
			if ($seatNo < 9)	$showSeatNo = "0" . ($seatNo + 1);  
			else	$showSeatNo = $seatNo + 1;
			switch ($seatStatus){
				case '0':
?>
					<img src="../ui/images/seat.png" width="18" height="18" /><?echo $showSeatNo;?>&nbsp;&nbsp;&nbsp;
<?php
				break;
				case '1':
?>
					<img src="../ui/images/seatlock.png" width="20" height="20" /><?echo $showSeatNo;?>&nbsp;&nbsp;&nbsp;
<?php
				break;
				case '2':
?>
					<img src="../ui/images/seatreserve.png" width="24" height="24" /><?echo $showSeatNo;?>&nbsp;&nbsp;&nbsp;
<?php
				break;
				case '3':
?>
					<img src="../ui/images/seatpeople.png" width="24" height="24" /><?echo $showSeatNo;?>&nbsp;&nbsp;&nbsp;
<?php
				break;
				case '4':
?>
					<img src="../ui/images/seatpeoplecheck.png" width="20" height="20" /><?echo $showSeatNo;?>&nbsp;&nbsp;&nbsp;
<?php
				break;
				case '5':
?>
					<img src="../ui/images/webseatreserve.png" width="28" height="28" /><?echo $showSeatNo;?>&nbsp;&nbsp;&nbsp;
<?php
				break;
				case '6':
?>
					<img src="../ui/images/webseatpeople.png" width="24" height="24" /><?echo $showSeatNo;?>&nbsp;&nbsp;&nbsp;
<?php
				break;
				default:
			}		
			$seatNo = $seatNo + 1;
			$seatStatus = substr($rows['tml_SeatStatus'], $seatNo, 1);
			$seatNum = $seatNum - 1;
		}
	}
}
?>