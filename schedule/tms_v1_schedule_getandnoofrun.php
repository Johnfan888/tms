<?php
//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$andnoofrunsID=$_GET['q'];
//echo $andnoofrunsID;
$strsqlselet = "SELECT `tml_NoOfRunsdate`,`tml_NoOfRunsID`,`tml_NoOfRunstime`,`tml_Endstation`,`tml_BusModel`,`tml_TotalSeats`,`tml_SeatStatus`  FROM `tms_bd_TicketMode` WHERE `tml_NoOfRunsID`='$andnoofrunsID';";
$resultselet = $class_mysql_default ->my_query("$strsqlselet");
$obj = @mysqli_fetch_object($resultselet);
$rows[0]=$obj->tml_NoOfRunsdate;
$rows[1]=$obj->tml_NoOfRunsID;
$rows[2]=$obj->tml_NoOfRunstime;
$rows[3]=$obj->tml_Endstation;
$rows[4]=$obj->tml_BusModel;
$rows[5]=$obj->tml_TotalSeats;
$rows[6]=$obj->tml_SeatStatus;
//返回字符串

echo "{";
echo "'noofrunsdate':'".$rows[0]."',";
echo "'noofrusnID':'".$rows[1]."',";
echo "'noofrunstime':'".$rows[2]."',";
echo "'endstation':'".$rows[3]."',";
echo "'busmodel':'".$rows[4]."',";
echo "'totalseats':'".$rows[5]."',";
echo "'seatstatus':'".$rows[6]."'";
echo "}";

?>
	
