<?php
//define("AUTH", "TRUE");
//define("WEBAUTH", "TRUE");
//载入初始化文件
require_once("../ui/inc/init.inc.php");
//$UserRegisterName=$_GET['UserRegisterName'];
$WebSellID=$_GET['WebSellID'];
$selectweb="SELECT wst_SeatID,wst_NoOfRunsID,wst_NoOfRunsdate, wst_FullNumber,wst_HalfNumber FROM tms_websell_WebSellTicket WHERE wst_WebSellID='{$WebSellID}'";
$queryweb =$class_mysql_default->my_query($selectweb);
$rowweb=@mysqli_fetch_array($queryweb); 
//这里需要锁表或锁记录
$class_mysql_default->my_query("BEGIN");
$selectmode="SELECT tml_SeatStatus,tml_LeaveSeats,tml_LeaveHalfSeats FROM tms_bd_TicketMode WHERE tml_NoOfRunsID='{$rowweb[1]}' AND tml_NoOfRunsdate='{$rowweb[2]}'FOR UPDATE";
$querymode =$class_mysql_default->my_query($selectmode);
$rowmode=@mysqli_fetch_array($querymode);

foreach (explode(",",$rowweb[0]) as $key =>$SeatID){
	$rowmode[1]=$rowmode[1]+1;
	$rowmode[0]=substr_replace($rowmode[0], '0',$SeatID-1,1);
//	echo $SeatID.'-';
//	echo $rowmode[1].'-';
//	echo $rowmode[0].'-';
}
$rowmode[2]=$rowmode[2]+$rowweb['wst_HalfNumber'];
$update="UPDATE tms_bd_TicketMode SET tml_SeatStatus='{$rowmode[0]}',tml_LeaveSeats='{$rowmode[1]}',tml_LeaveHalfSeats='{$rowmode[2]}' WHERE  tml_NoOfRunsID='{$rowweb[1]}' AND tml_NoOfRunsdate='{$rowweb[2]}'";
$queryupdate =$class_mysql_default->my_query($update);
//echo $rowmode[0];
//echo $rowmode[1];
//if (!$queryupdate) echo "SQL错误：".$class_mysql_default->my_error();
$del="DELETE FROM tms_websell_WebSellTicket WHERE wst_WebSellID='{$WebSellID}'";
$querydel =$class_mysql_default->my_query($del);
if ($querymode && $querydel && $queryupdate) {
	$class_mysql_default->my_query("COMMIT");
	echo "<script>alert('取消成功！ 请返回。');location.assign('tms_v1_sell_sellreserve.php');</script>";
}else{
	$class_mysql_default->my_query("ROLLBACK");
	echo "<script>alert('取消失败！');location.assign('tms_v1_sell_searchreserve.php');</script>";
} 
$class_mysql_default->my_query("END TRANSACTION"); 
	
?>
