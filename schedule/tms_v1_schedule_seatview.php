<?
//座位预览界面

define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$NoOfRunsID = $_GET['nrID'];
$NoOfRunsdate = $_GET['nrDate'];
$seat=$seatNo+1;
$selectSellTicket="SELECT st_SellID,st_Station,st_FromStation FROM tms_sell_SellTicket WHERE st_NoOfRunsID='{$NoOfRunsID}' AND 
	st_NoOfRunsdate='{$NoOfRunsdate}' AND st_SeatID='{$seat}'";
$querySellTicket=$class_mysql_default->my_query("$selectSellTicket");
$rowSellTicket = @mysqli_fetch_array($querySellTicket);
if(!empty($NoOfRunsID)) {
	$strsqlselet = "SELECT `tml_TotalSeats`, `tml_SeatStatus` FROM `tms_bd_TicketMode` WHERE 
			`tml_NoOfRunsID` = '$NoOfRunsID' AND `tml_NoOfRunsdate`='$NoOfRunsdate'";
	$resultselet = $class_mysql_default->my_query("$strsqlselet");
	if ($rows = @mysqli_fetch_array($resultselet)){
		$seatNum = $rows['tml_TotalSeats'];
		$seatStatus = substr($rows['tml_SeatStatus'], 0, 1);
		$seatNo = 0;
		
			//if ($seatNo % 15 == 0 && $seatNo != 0){
?>	
<style type="text/css">
.box{ width:100%;}
p{margin:0;text-align: center;} 
</style>
</head>
<body>			

<ul style="padding:0px; margin-top:-25px;margin-left:0px; overflow:hidden;" class="box">
<?php		
		//	}
			while($seatNum != 0) {
			if ($seatNo < 9)	$showSeatNo = "0" . ($seatNo + 1);  
			else	$showSeatNo = $seatNo + 1;
			switch ($seatStatus){
				case '0':
?>
					<li style="float:left; width:60px; height:100px; margin-right:50px;"><img src="../ui/images/seat.png" width="30" height="30" /><p style="font-size:15"><?echo $showSeatNo;?></p></li>
<?php
				break;
				case '1':
?>
					<li style="float:left; width:60px; height:100px; margin-right:50px;"><img src="../ui/images/seatlock.png" width="30" height="30" /><p style="font-size:15"><?echo $showSeatNo;?></p></li>
<?php
				break;
				case '2':
?>
				<li style="float:left; width:60px; height:100px; margin-right:50px;"><p style="text-align:center"><img src="../ui/images/seatreserve.png" width="30" height="30" /></p>
				<?php
						$seat=$seatNo+1;
						$ReserveTicket="SELECT wst_Station,wst_FromStation FROM tms_websell_WebSellTicket WHERE wst_NoOfRunsID='$NoOfRunsID' AND 
							wst_NoOfRunsdate='$NoOfRunsdate'";
						$queryReserveTicket=$class_mysql_default->my_query("$ReserveTicket");
						$rowReserveTicket = @mysqli_fetch_array($queryReserveTicket);
						
?>
				<p style="font-size:15"><?echo $showSeatNo;?></p><p style="font-size:13"><?php echo $rowReserveTicket['wst_FromStation']; ?></p></li>
<?php
				break;
				case '3':
?>	
				<li style="float:left; width:60px; height:100px; margin-right:50px;"><p style="text-align:center"><img src="../ui/images/seatpeople.png" width="30" height="30"/></p>
<?php 
					$seat=$seatNo+1;
					$selectSellTicket="SELECT st_SellID,st_Station,st_FromStation FROM tms_sell_SellTicket WHERE st_NoOfRunsID='{$NoOfRunsID}' AND 
						st_NoOfRunsdate='{$NoOfRunsdate}' AND st_SeatID='{$seat}'";
					$querySellTicket=$class_mysql_default->my_query("$selectSellTicket");
					$rowSellTicket = @mysqli_fetch_array($querySellTicket);
?>
				<p style="font-size:15"><? echo $showSeatNo ?></p><p style="font-size:13"><?php echo $rowSellTicket['st_FromStation'];?></p></li>

<?php
				break;
				case '4':
?>
					<li style="float:left; width:60px; height:100px; margin-right:50px;"><p style="text-align:center"><img src="../ui/images/seatpeoplecheck.png" width="30" height="30" /></p>
					<?php
						$seat=$seatNo+1;
						$selectSellTicket="SELECT st_SellID,st_Station,st_FromStation FROM tms_sell_SellTicket WHERE st_NoOfRunsID='{$NoOfRunsID}' AND 
							st_NoOfRunsdate='{$NoOfRunsdate}' AND st_SeatID='{$seat}'";
						$querySellTicket=$class_mysql_default->my_query("$selectSellTicket");
						$rowSellTicket = @mysqli_fetch_array($querySellTicket);
					?>
					<p style="font-size:15"><?php echo $showSeatNo ?></p><p style="font-size:13"><?php echo $rowSellTicket['st_FromStation']?></p> </li>
<?php
				break;
				case '5':
?>
				<li style="float:left; width:60px; height:100px; margin-right:50px;"><img src="../ui/images/webseatreserve.png" width="40" height="30" /><p style="font-size:15"><?echo $showSeatNo;?></p></li>
<?php
				break;
				case '6':
?>
				<li style="float:left; width:60px; height:100px; margin-right:50px;"><img src="../ui/images/webseatpeople.png" width="30" height="30" /><p style="font-size:15"><?echo $showSeatNo;?></p></li>
<?php
				break;
				case '7':
?>
					<li style="float:left; width:60px; height:100px; margin-right:50px;"><img src="../ui/images/seatpeople.png" width="30" height="30" /><p style="font-size:15">并<?echo $showSeatNo;?></p></li>
				
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
</ul>

