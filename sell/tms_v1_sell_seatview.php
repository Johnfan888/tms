<?php
//座位预览界面

define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$NoOfRunsID = $_GET['nrID'];
$NoOfRunsdate = $_GET['nrDate'];

if (!empty($NoOfRunsID)) {
	$strsqlselet = "SELECT `tml_TotalSeats`, `tml_SeatStatus` FROM `tms_bd_TicketMode` WHERE `tml_NoOfRunsID` = '$NoOfRunsID' AND `tml_NoOfRunsdate`='$NoOfRunsdate'";
	$resultselet = $class_mysql_default->my_query("$strsqlselet");
	if ($rows = mysql_fetch_array($resultselet)){
		$seatNum = $rows['tml_TotalSeats'];
		$seatStatus = substr($rows['tml_SeatStatus'], 0, 1);
		$seatNo = 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>座位预览</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
<style type="text/css">
ul,li{ padding:0; margin:0; overflow:hidden;}
li{ list-style:none;}
img{ border:0;}
.box{ width:100%;}
.box li{ float:left;}
p{margin: 0;text-align:center;} 
</style>
</head>
<body>
<ul style="padding:0px; margin-top:-25px;margin-left:0px; overflow:hidden;" class="box">
<?php
		while($seatNum != 0) {
			if ($seatNo < 9)
				$showSeatNo = "0" . ($seatNo + 1);  
			else
				$showSeatNo = $seatNo + 1;
			switch ($seatStatus){
				case '0':
?>
					<li style="float:left; width:60px; height:60px; margin-right:30px;"><img src="../ui/images/seat.png" width="30" height="30" /><p class="relative" style="font-size:15"><?echo $showSeatNo;?></p></li>
<?php
				break;
				case '1':
?>
					<li style="float:left; width:60px; height:60px; margin-right:30px;"><img src="../ui/images/seatlock.png" width="30" height="30" /><p style="font-size:15"><?echo $showSeatNo;?></p></li>
<?php
				break;
				case '2':
?>
					<li style="float:left; width:60px; height:60px; margin-right:30px;"><img src="../ui/images/seatreserve.png" width="30" height="30" /><p style="font-size:15"><?echo $showSeatNo;?></p></li>
<?php
				break;
				case '3':
?>
					<li style="float:left; width:60px; height:60px; margin-right:30px;"><img src="../ui/images/seatpeople.png" width="30" height="30" /><p style="font-size:15"><?echo $showSeatNo;?></p></li>
<?php
				break;
				case '4':
?>
					<li style="float:left; width:60px; height:60px; margin-right:30px;"><img src="../ui/images/seatpeoplecheck.png" width="30" height="30" /><p style="font-size:15"><?echo $showSeatNo;?></p></li>
<?php
				break;
				case '5':
?>
					<li style="float:left; width:60px; height:60px; margin-right:30px;"><img src="../ui/images/webseatreserve.png" width="30" height="30" /><p style="font-size:15"><?echo $showSeatNo;?></p></li>
<?php
				break;
				case '6':
?>
					<li style="float:left; width:60px; height:60px; margin-right:30px;"><img src="../ui/images/webseatpeople.png" width="30" height="30" /><p style="font-size:15"><?echo $showSeatNo;?></p></li>
<?php
				break;
				case '7':
?>
					<li style="float:left; width:60px; height:60px; margin-right:30px;"><img src="../ui/images/seatpeople.png" width="30" height="30" /><p style="font-size:15">并<?echo $showSeatNo;?></p></li>
<?php
				break;
				default:
			}		
			$seatNo = $seatNo + 1;
			$seatStatus = substr($rows['tml_SeatStatus'], $seatNo, 1);
			$seatNum = $seatNum - 1;
		}
?>
</ul>
</body>
</html>
<?php
	}
}
?>


	