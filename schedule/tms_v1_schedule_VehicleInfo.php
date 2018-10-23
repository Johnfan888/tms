<?
//报班车辆信息页面

//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../safecheck/tms_v1_safcheck_papercheckdata.php");
require_once("../ui/inc/init.inc.php");

$reportBusID = $_POST['reportBusID']; //获取车辆编号
$strsqlselet="SELECT * FROM tms_bd_BusInfo WHERE bi_BusID = '{$reportBusID}'";
$result = $class_mysql_default->my_query("$strsqlselet");
$row = mysql_fetch_array($result);
$selectdriver="SELECT di_CYZGZNumber,di_DriverCard,di_DriverCheckDate,di_CYZGZCheckDate,di_DriverID FROM tms_bd_DriverInfo WHERE di_DriverCard='{$row['bi_DriverID']}'";
$resultdriver=$class_mysql_default->my_query("$selectdriver");;
$rowdriver = mysql_fetch_array($resultdriver);
$selectdriver1="SELECT di_CYZGZNumber,di_DriverCard,di_DriverCheckDate,di_CYZGZCheckDate,di_DriverID FROM tms_bd_DriverInfo WHERE di_DriverCard='{$row['bi_Driver1ID']}'";
$resultdriver1=$class_mysql_default->my_query("$selectdriver1");
$rowdriver1 = mysql_fetch_array($resultdriver1);
$selectdriver2="SELECT di_CYZGZNumber,di_DriverCard,di_DriverCheckDate,di_CYZGZCheckDate,di_DriverID FROM tms_bd_DriverInfo WHERE di_DriverCard='{$row['bi_Driver2ID']}'";
$resultdriver2=$class_mysql_default->my_query("$selectdriver2");
$rowdriver2 = mysql_fetch_array($resultdriver2);
/*
// 主驾驶员信息
$driver = $rows['bi_DriverID'];
$strsqlselet="SELECT di_Name,di_Sex,di_Tel,di_DriverCard,di_DriverCheckDate,di_AllowBusType,di_CYZGZNumber,di_CYZGZCheckDate 
			FROM tms_bd_DriverInfo WHERE di_DriverID='$driver'";
$resultselet = $class_mysql_default ->my_query("$strsqlselet");
$rowsd = @mysql_fetch_array($resultselet);

// 副驾驶员信息
$driver = $rows['bi_Driver1ID'];
$strsqlselet="SELECT di_Name,di_Sex,di_Tel,di_DriverCard,di_DriverCheckDate,di_AllowBusType,di_CYZGZNumber,di_CYZGZCheckDate 
			FROM tms_bd_DriverInfo WHERE di_DriverID='$driver'";
$resultselet = $class_mysql_default ->my_query("$strsqlselet");
$rowsd1 = @mysql_fetch_array($resultselet);  */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>报班车辆信息</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<link href="../css/tms.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script>
		$(document).ready(function(){
			var DriverCard=document.getElementById("DriverCard").value;
			var Driver1Card=document.getElementById("Driver1Card").value;
			var Driver2Card=document.getElementById("Driver2Card").value;
			var DriverCheckD=document.getElementById("DriverCheckD").value;
			var Driver1CheckD=document.getElementById("Driver1CheckD").value;
			var Driver2CheckD=document.getElementById("Driver2CheckD").value;
			var DriverCheckx=document.getElementById("DriverCheckx").value;
			var CYZGZNumber=document.getElementById("CYZGZNumber").value;
			var CYZGZNumber1=document.getElementById("CYZGZNumber1").value;
			var CYZGZNumber2=document.getElementById("CYZGZNumber2").value;
			var CYZGZCheckD=document.getElementById("CYZGZCheckD").value;
			var CYZGZCheckD1=document.getElementById("CYZGZCheckD1").value;
			var CYZGZCheckD2=document.getElementById("CYZGZCheckD2").value;
			var CYZGZCheckx=document.getElementById("CYZGZCheckx").value;
			var i=0;
/*			if(document.getElementById("TransportationEnd").value*1<document.getElementById("Transportationx").value && document.getElementById("TransportationEnd").value*1>-5000){
				alert('交强险还有'+document.getElementById("TransportationEnd").value+'天到期！');
			}
			 if(document.getElementById("TradeEnd").value*1<document.getElementById("Tradex").value  && document.getElementById("TradeEnd").value*1>-5000){
				alert('商业险还有'+document.getElementById("TradeEnd").value+'天到期！');
			}
			 if(document.getElementById("RenEnd").value*1<document.getElementById("Renx").value && document.getElementById("RenEnd").value*1>-5000){
				alert('承运人险还有'+document.getElementById("RenEnd").value+'天到期！');
			}
			if(document.getElementById("SpringCheckEnd").value*1<document.getElementById("SpringCheckx").value && document.getElementById("SpringCheckEnd").value*1>-5000){
				alert('春检还有'+document.getElementById("SpringCheckEnd").value+'天到期！');
			}
			if(document.getElementById("ExaminationEnd").value*1<document.getElementById("Examinationx").value && document.getElementById("ExaminationEnd").value*1>-5000){
				alert('审验还有'+document.getElementById("ExaminationEnd").value+'天到期！');
			}
			if(document.getElementById("TwoEnd").value*1<document.getElementById("Twox").value && document.getElementById("TwoEnd").value*1>-5000){
				alert('二级维护还有'+document.getElementById("TwoEnd").value+'天到期！');
			}
			if(document.getElementById("RankEnd").value*1<document.getElementById("Rankx").value && document.getElementById("RankEnd").value*1>-5000){
				alert('等级评定还有'+document.getElementById("RankEnd").value+'天到期！');
			}
			if(document.getElementById("TravelEnd").value*1<document.getElementById("Travelx").value && document.getElementById("TravelEnd").value*1>-5000){
				alert('行驶证检验还有'+document.getElementById("TravelEnd").value+'天到期！');
			}
			if(document.getElementById("MonthEnd").value*1<document.getElementById("Monthx").value && document.getElementById("MonthEnd").value*1>-5000){
				alert('月维护还有'+document.getElementById("MonthEnd").value+'天到期！');
			}
			if(document.getElementById("CNGEnd").value*1<document.getElementById("CNGx").value && document.getElementById("CNGEnd").value*1>-5000){
				alert('液化气证还有'+document.getElementById("CNGEnd").value+'天到期！');
			}
*/		
			if(document.getElementById("LineLicense").value==''){
				if(!confirm("该车辆缺少线路牌，可以报班吗？")){
					location.assign('tms_v1_schedule_noofrun.php?op=none');
					return;
				}
			}else{
				if(document.getElementById("AttachedEnd").value*1<document.getElementById("Attachedx").value && document.getElementById("AttachedEnd").value*1>=0){
					alert('线路牌照附卡还有'+document.getElementById("AttachedEnd").value+'天到期！');
				}else{
					if(document.getElementById("AttachedEnd").value*1<0){
						if(!confirm("该车辆线路牌照附卡过期，可以报班吗？")){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
				}
			}
			if(document.getElementById("RoadTransport").value==''){
				if(!confirm("该车辆缺少道路运输证，可以报班吗？")){
					location.assign('tms_v1_schedule_noofrun.php?op=none');
					return;
				}
			}else{
				if(document.getElementById("RoadTransportEnd").value*1<document.getElementById("RoadTransportx").value && document.getElementById("RoadTransportEnd").value*1>=0){
					alert('道路运输证还有'+document.getElementById("RoadTransportEnd").value+'天到期！');
				}else{
					if( document.getElementById("RoadTransportEnd").value*1<0){
						if(!confirm("该车辆道路运输证过期，可以报班吗？")){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
				}
			}
			if(document.getElementById("VehicleDriving").value==''){
				if(!confirm("该车辆缺少车辆行驶证，可以报班吗？")){
					location.assign('tms_v1_schedule_noofrun.php?op=none');
					return;
				}
			}else{
				if(document.getElementById("VehicleDrivingEnd").value*1<document.getElementById("VehicleDrivingx").value && document.getElementById("VehicleDrivingEnd").value*1>=0){
					alert('车辆行驶证还有'+document.getElementById("VehicleDrivingEnd").value+'天到期！');
				}else{
					if( document.getElementById("VehicleDrivingEnd").value*1<0){
						if(!confirm("该车辆车辆行驶证过期，可以报班吗？")){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
				}
			}
			if(document.getElementById("DriverCard").value==''){
				if(!confirm("该车辆缺少驾驶员驾照，可以报班吗？")){
					location.assign('tms_v1_schedule_noofrun.php?op=none');
					return;
				}
			}else{
				if(document.getElementById("DriverCheckD").value*1<document.getElementById("DriverCheckx").value && document.getElementById("DriverCheckD").value*1>=0){
					alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+document.getElementById("DriverCheckD").value+'天到期！');
				}else{
					if( document.getElementById("DriverCheckD").value*1<0){
						if(!confirm('驾驶员'+document.getElementById("Driver").value+'驾照过期，可以报班吗？')){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
				}
			}
			if(document.getElementById("CYZGZNumber").value==''){
				if(!confirm("该车辆缺少驾驶员驾从业资格证，可以报班吗？")){
					location.assign('tms_v1_schedule_noofrun.php?op=none');
					return;
				}
			}else{
				if(document.getElementById("CYZGZCheckD").value*1<document.getElementById("CYZGZCheckx").value && document.getElementById("CYZGZCheckD").value*1>=0){
					alert('驾驶员'+document.getElementById("Driver").value+'从业资格证还有'+document.getElementById("CYZGZCheckD").value+'天到期！');
				}else{
					if( document.getElementById("CYZGZCheckD").value*1<0){
						if(!confirm('驾驶员'+document.getElementById("Driver").value+'从业资格证过期，可以报班吗？')){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
				}
			}
/*			if(DriverCard=='' && Driver1Card==''&& Driver2Card==''){
				if(!confirm("该车辆缺少驾驶员驾照，可以报班吗？")){
					location.assign('tms_v1_schedule_noofrun.php?op=none');
					return;
				}
			}else{
				var i=1;
				if(DriverCard!='' && Driver1Card==''&& Driver2Card==''){
					if(DriverCheckD*1<DriverCheckx && DriverCheckD*1>=0){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+DriverCheckD+'天到期！');
					}
					if(DriverCheckD*1<0){
						if(!confirm('驾驶员'+document.getElementById("Driver").value+'驾照过期，可以报班吗？')){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
					if(CYZGZNumber!=''){
						if(CYZGZCheckD*1<CYZGZCheckx && CYZGZCheckD*1>=0){
							alert('驾驶员'+document.getElementById("Driver").value+'从业资格证还有'+CYZGZCheckD+'天到期！');
						}
						if(CYZGZCheckD*1<0){
							if(!confirm('驾驶员'+document.getElementById("Driver").value+'从业资格证过期，可以报班吗？')){
								location.assign('tms_v1_schedule_noofrun.php?op=none');
								return;
							}
						}
					}else{
						if(!confirm('驾驶员'+document.getElementById("Driver").value+'缺少驾驶员驾从业资格证，可以报班吗？')){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
				}
				if(DriverCard=='' && Driver1Card!=''&& Driver2Card==''){
					if(Driver1CheckD*1<DriverCheckx && Driver1CheckD*1>=0){
						alert('驾驶员'+document.getElementById("Driver1").value+'驾照还有'+Driver1CheckD+'天到期！');
					}
					if(Driver1CheckD*1<0){
						if(!confirm('驾驶员'+document.getElementById("Driver1").value+'驾照过期，可以报班吗？')){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
					if(CYZGZNumber1!=''){
						if(CYZGZCheckD1*1<CYZGZCheckx && CYZGZCheckD1*1>=0){
							alert('驾驶员'+document.getElementById("Driver1").value+'从业资格证还有'+CYZGZCheckD1+'天到期！');
						}
						if(CYZGZCheckD1*1<0){
							if(!confirm('驾驶员'+document.getElementById("Driver1").value+'从业资格证过期，可以报班吗？')){
								location.assign('tms_v1_schedule_noofrun.php?op=none');
								return;
							}
						}
					}else{
						if(!confirm('驾驶员'+document.getElementById("Driver1").value+'缺少驾驶员驾从业资格证，可以报班吗？')){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
				}
				if(DriverCard=='' && Driver1Card==''&& Driver2Card!=''){
					if(Driver2CheckD*1<DriverCheckx && Driver2CheckD*1>=0){
						alert('驾驶员'+document.getElementById("Driver2").value+'驾照还有'+Driver2CheckD+'天到期！');
					}
					if(Driver2CheckD*1<0){
						if(!confirm('驾驶员'+document.getElementById("Driver2").value+'驾照过期，可以报班吗？')){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
					if(CYZGZNumber2!=''){
						if(CYZGZCheckD2*1<CYZGZCheckx && CYZGZCheckD2*1>=0){
							alert('驾驶员'+document.getElementById("Driver2").value+'从业资格证还有'+CYZGZCheckD2+'天到期！');
						}
						if(CYZGZCheckD2*1<0){
							if(!confirm('驾驶员'+document.getElementById("Driver2").value+'从业资格证过期，可以报班吗？')){
								location.assign('tms_v1_schedule_noofrun.php?op=none');
								return;
							}
						}
					}else{
						if(!confirm('驾驶员'+document.getElementById("Driver2").value+'缺少驾驶员驾从业资格证，可以报班吗？')){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
				}
				if(DriverCard!='' && Driver1Card!=''&& Driver2Card==''){
					if((DriverCheckD*1<DriverCheckx && DriverCheckD*1>=0) && (Driver1CheckD*1<DriverCheckx && Driver1CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+DriverCheckD+'天到期；驾驶员'+document.getElementById("Driver1").value+'驾照还有'+Driver1CheckD+'天到期！');
					}
					if((DriverCheckD*1<DriverCheckx && DriverCheckD*1>=0) && (Driver1CheckD*1<0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+DriverCheckD+'天到期；驾驶员'+document.getElementById("Driver1").value+'驾照过期！');
					}
					if((DriverCheckD*1<=0) && (Driver1CheckD*1<DriverCheckx && Driver1CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照过期；驾驶员'+document.getElementById("Driver1").value+'驾照还有'+Driver1CheckD+'天到期！');
					}
					if(DriverCheckD*1<0 && Driver1CheckD*1<0){
						if(!confirm('驾驶员'+document.getElementById("Driver").value+'和驾驶员'+document.getElementById("Driver1").value+'驾照过期，可以报班吗？')){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
					
				}
				if(DriverCard!='' && Driver1Card==''&& Driver2Card!=''){
					if((DriverCheckD*1<DriverCheckx && DriverCheckD*1>=0) && (Driver2CheckD*1<DriverCheckx && Driver2CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+DriverCheckD+'天到期；驾驶员'+document.getElementById("Driver2").value+'驾照还有'+Driver2CheckD+'天到期！');
					}
					if((DriverCheckD*1<DriverCheckx && DriverCheckD*1>=0) && (Driver2CheckD*1<0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+DriverCheckD+'天到期；驾驶员'+document.getElementById("Driver2").value+'驾照过期！');
					}
					if((DriverCheckD*1<=0) && (Driver2CheckD*1<DriverCheckx && Driver2CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照过期；驾驶员'+document.getElementById("Driver2").value+'驾照还有'+Driver2CheckD+'天到期！');
					}
					if(DriverCheckD*1<0 && Driver2CheckD*1<0){
						if(!confirm('驾驶员'+document.getElementById("Driver").value+'和驾驶员'+document.getElementById("Driver2").value+'驾照过期，可以报班吗？')){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
				}
				if(DriverCard=='' && Driver1Card!=''&& Driver2Card!=''){
					if((Driver1CheckD*1<DriverCheckx && Driver1CheckD*1>=0) && (Driver2CheckD*1<DriverCheckx && Driver2CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver1").value+'驾照还有'+Driver1CheckD+'天到期；驾驶员'+document.getElementById("Driver2").value+'驾照还有'+Driver2CheckD+'天到期！');
					}
					if((Driver1CheckD*1<DriverCheckx && Driver1CheckD*1>=0) && (Driver2CheckD*1<0)){
						alert('驾驶员'+document.getElementById("Driver1").value+'驾照还有'+Driver1CheckD+'天到期；驾驶员'+document.getElementById("Driver2").value+'驾照过期！');
					}
					if((Driver1CheckD*1<0) && (Driver2CheckD*1<DriverCheckx && Driver2CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver1").value+'驾照过期；驾驶员'+document.getElementById("Driver2").value+'驾照还有'+Driver2CheckD+'天到期！');
					}
					if(DriverCheckD*1<0 && Driver2CheckD*1<0){
						if(!confirm('驾驶员'+document.getElementById("Driver1").value+'和驾驶员'+document.getElementById("Driver2").value+'驾照过期，可以报班吗？')){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
				}
				if(DriverCard!='' && Driver1Card!=''&& Driver2Card!=''){
					if((DriverCheckD*1<DriverCheckx && DriverCheckD*1>=0) && (Driver1CheckD*1<DriverCheckx && Driver1CheckD*1>=0) && (Driver2CheckD*1<DriverCheckx && Driver2CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+DriverCheckD+'天到期；驾驶员'+document.getElementById("Driver1").value+'驾照还有'+Driver1CheckD+'天到期；驾驶员'+document.getElementById("Driver2").value+'驾照还有'+Driver2CheckD+'天到期！');
					}
					if((DriverCheckD*1<0) && (Driver1CheckD*1<DriverCheckx && Driver1CheckD*1>=0) && (Driver2CheckD*1<DriverCheckx && Driver2CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照过期；驾驶员'+document.getElementById("Driver1").value+'驾照还有'+Driver1CheckD+'天到期；驾驶员'+document.getElementById("Driver2").value+'驾照还有'+Driver2CheckD+'天到期！');
					}
					if((DriverCheckD*1<DriverCheckx && DriverCheckD*1>=0) && (Driver1CheckD*1<0) && (Driver2CheckD*1<DriverCheckx && Driver2CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+DriverCheckD+'天到期；驾驶员'+document.getElementById("Driver1").value+'驾照过期；驾驶员'+document.getElementById("Driver2").value+'驾照还有'+Driver2CheckD+'天到期！');
					}
					if((DriverCheckD*1<DriverCheckx && DriverCheckD*1>=0) && (Driver1CheckD*1<DriverCheckx && Driver1CheckD*1>=0) && (Driver2CheckD*1<0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+DriverCheckD+'天到期；驾驶员'+document.getElementById("Driver1").value+'驾照还有'+Driver1CheckD+'天到期；驾驶员'+document.getElementById("Driver2").value+'驾照过期！');
					}
					if((DriverCheckD*1<0) && (Driver1CheckD*1<0) && (Driver2CheckD*1<DriverCheckx && Driver2CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照过期；驾驶员'+document.getElementById("Driver1").value+'驾照过期；驾驶员'+document.getElementById("Driver2").value+'驾照还有'+Driver2CheckD+'天到期！');
					}
					if((DriverCheckD*1<0) && (Driver1CheckD*1<DriverCheckx && Driver1CheckD*1>=0) && (Driver2CheckD*1<0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照过期；驾驶员'+document.getElementById("Driver1").value+'驾照还有'+Driver1CheckD+'天到期；驾驶员'+document.getElementById("Driver2").value+'驾照过期！');
					}
					if((DriverCheckD*1<DriverCheckx && DriverCheckD*1>=0) && (Driver1CheckD*1<0) && (Driver2CheckD*1<0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+DriverCheckD+'天到期；驾驶员'+document.getElementById("Driver1").value+'驾照过期；驾驶员'+document.getElementById("Driver2").value+'驾照过期！');
					}
					if(DriverCheckD*1<0 && DriverCheckD*1<0 && Driver2CheckD*1<0){
						if(!confirm('驾驶员'+document.getElementById("Driver").value+'、驾驶员'+document.getElementById("Driver1").value+'和驾驶员'+document.getElementById("Driver2").value+'驾照过期，可以报班吗？')){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
				}
			} */
/*			if(DriverCard=='' && Driver1Card==''&& Driver2Card==''){
				if(!confirm("该车辆缺少驾驶员驾照，可以报班吗？")){
					location.assign('tms_v1_schedule_noofrun.php?op=none');
					return;
				}
			}else{
				if(DriverCard!='' && Driver1Card==''&& Driver2Card==''){
					if(DriverCheckD*1<DriverCheckx && DriverCheckD*1>=0){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+DriverCheckD+'天到期！');
					}else{
						if(DriverCheckD*1<0){
							if(!confirm('驾驶员'+document.getElementById("Driver").value+'驾照过期，可以报班吗？')){
								location.assign('tms_v1_schedule_noofrun.php?op=none');
								return;
							}
						}
					}
				}
				if(DriverCard=='' && Driver1Card!=''&& Driver2Card==''){
					if(Driver1CheckD*1<DriverCheckx && Driver1CheckD*1>=0){
						alert('驾驶员'+document.getElementById("Driver1").value+'驾照还有'+Driver1CheckD+'天到期！');
					}else{
						if(Driver1CheckD*1<0){
							if(!confirm('驾驶员'+document.getElementById("Driver1").value+'驾照过期，可以报班吗？')){
								location.assign('tms_v1_schedule_noofrun.php?op=none');
								return;
							}
						}
					}
				}
				if(DriverCard=='' && Driver1Card==''&& Driver2Card!=''){
					if(Driver2CheckD*1<DriverCheckx && Driver2CheckD*1>=0){
						alert('驾驶员'+document.getElementById("Driver2").value+'驾照还有'+Driver2CheckD+'天到期！');
					}else{
						if(Driver2CheckD*1<0){
							if(!confirm('驾驶员'+document.getElementById("Driver2").value+'驾照过期，可以报班吗？')){
								location.assign('tms_v1_schedule_noofrun.php?op=none');
								return;
							}
						}
					}
				}
				if(DriverCard!='' && Driver1Card!=''&& Driver2Card==''){
					if((DriverCheckD*1<DriverCheckx && DriverCheckD*1>=0) && (Driver1CheckD*1<DriverCheckx && Driver1CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+DriverCheckD+'天到期；驾驶员'+document.getElementById("Driver1").value+'驾照还有'+Driver1CheckD+'天到期！');
					}
					if((DriverCheckD*1<DriverCheckx && DriverCheckD*1>=0) && (Driver1CheckD*1<0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+DriverCheckD+'天到期；驾驶员'+document.getElementById("Driver1").value+'驾照过期！');
					}
					if((DriverCheckD*1<=0) && (Driver1CheckD*1<DriverCheckx && Driver1CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照过期；驾驶员'+document.getElementById("Driver1").value+'驾照还有'+Driver1CheckD+'天到期！');
					}
					if(DriverCheckD*1<0 && Driver1CheckD*1<0){
						if(!confirm('驾驶员'+document.getElementById("Driver").value+'和驾驶员'+document.getElementById("Driver1").value+'驾照过期，可以报班吗？')){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
				}
				if(DriverCard!='' && Driver1Card==''&& Driver2Card!=''){
					if((DriverCheckD*1<DriverCheckx && DriverCheckD*1>=0) && (Driver2CheckD*1<DriverCheckx && Driver2CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+DriverCheckD+'天到期；驾驶员'+document.getElementById("Driver2").value+'驾照还有'+Driver2CheckD+'天到期！');
					}
					if((DriverCheckD*1<DriverCheckx && DriverCheckD*1>=0) && (Driver2CheckD*1<0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+DriverCheckD+'天到期；驾驶员'+document.getElementById("Driver2").value+'驾照过期！');
					}
					if((DriverCheckD*1<=0) && (Driver2CheckD*1<DriverCheckx && Driver2CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照过期；驾驶员'+document.getElementById("Driver2").value+'驾照还有'+Driver2CheckD+'天到期！');
					}
					if(DriverCheckD*1<0 && Driver2CheckD*1<0){
						if(!confirm('驾驶员'+document.getElementById("Driver").value+'和驾驶员'+document.getElementById("Driver2").value+'驾照过期，可以报班吗？')){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
				}
				if(DriverCard=='' && Driver1Card!=''&& Driver2Card!=''){
					if((Driver1CheckD*1<DriverCheckx && Driver1CheckD*1>=0) && (Driver2CheckD*1<DriverCheckx && Driver2CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver1").value+'驾照还有'+Driver1CheckD+'天到期；驾驶员'+document.getElementById("Driver2").value+'驾照还有'+Driver2CheckD+'天到期！');
					}
					if((Driver1CheckD*1<DriverCheckx && Driver1CheckD*1>=0) && (Driver2CheckD*1<0)){
						alert('驾驶员'+document.getElementById("Driver1").value+'驾照还有'+Driver1CheckD+'天到期；驾驶员'+document.getElementById("Driver2").value+'驾照过期！');
					}
					if((Driver1CheckD*1<0) && (Driver2CheckD*1<DriverCheckx && Driver2CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver1").value+'驾照过期；驾驶员'+document.getElementById("Driver2").value+'驾照还有'+Driver2CheckD+'天到期！');
					}
					if(DriverCheckD*1<0 && Driver2CheckD*1<0){
						if(!confirm('驾驶员'+document.getElementById("Driver1").value+'和驾驶员'+document.getElementById("Driver2").value+'驾照过期，可以报班吗？')){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
				}
				if(DriverCard!='' && Driver1Card!=''&& Driver2Card!=''){
					if((DriverCheckD*1<DriverCheckx && DriverCheckD*1>=0) && (Driver1CheckD*1<DriverCheckx && Driver1CheckD*1>=0) && (Driver2CheckD*1<DriverCheckx && Driver2CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+DriverCheckD+'天到期；驾驶员'+document.getElementById("Driver1").value+'驾照还有'+Driver1CheckD+'天到期；驾驶员'+document.getElementById("Driver2").value+'驾照还有'+Driver2CheckD+'天到期！');
					}
					if((DriverCheckD*1<0) && (Driver1CheckD*1<DriverCheckx && Driver1CheckD*1>=0) && (Driver2CheckD*1<DriverCheckx && Driver2CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照过期；驾驶员'+document.getElementById("Driver1").value+'驾照还有'+Driver1CheckD+'天到期；驾驶员'+document.getElementById("Driver2").value+'驾照还有'+Driver2CheckD+'天到期！');
					}
					if((DriverCheckD*1<DriverCheckx && DriverCheckD*1>=0) && (Driver1CheckD*1<0) && (Driver2CheckD*1<DriverCheckx && Driver2CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+DriverCheckD+'天到期；驾驶员'+document.getElementById("Driver1").value+'驾照过期；驾驶员'+document.getElementById("Driver2").value+'驾照还有'+Driver2CheckD+'天到期！');
					}
					if((DriverCheckD*1<DriverCheckx && DriverCheckD*1>=0) && (Driver1CheckD*1<DriverCheckx && Driver1CheckD*1>=0) && (Driver2CheckD*1<0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+DriverCheckD+'天到期；驾驶员'+document.getElementById("Driver1").value+'驾照还有'+Driver1CheckD+'天到期；驾驶员'+document.getElementById("Driver2").value+'驾照过期！');
					}
					if((DriverCheckD*1<0) && (Driver1CheckD*1<0) && (Driver2CheckD*1<DriverCheckx && Driver2CheckD*1>=0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照过期；驾驶员'+document.getElementById("Driver1").value+'驾照过期；驾驶员'+document.getElementById("Driver2").value+'驾照还有'+Driver2CheckD+'天到期！');
					}
					if((DriverCheckD*1<0) && (Driver1CheckD*1<DriverCheckx && Driver1CheckD*1>=0) && (Driver2CheckD*1<0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照过期；驾驶员'+document.getElementById("Driver1").value+'驾照还有'+Driver1CheckD+'天到期；驾驶员'+document.getElementById("Driver2").value+'驾照过期！');
					}
					if((DriverCheckD*1<DriverCheckx && DriverCheckD*1>=0) && (Driver1CheckD*1<0) && (Driver2CheckD*1<0)){
						alert('驾驶员'+document.getElementById("Driver").value+'驾照还有'+DriverCheckD+'天到期；驾驶员'+document.getElementById("Driver1").value+'驾照过期；驾驶员'+document.getElementById("Driver2").value+'驾照过期！');
					}
					if(DriverCheckD*1<0 && DriverCheckD*1<0 && Driver2CheckD*1<0){
						if(!confirm('驾驶员'+document.getElementById("Driver").value+'、驾驶员'+document.getElementById("Driver1").value+'和驾驶员'+document.getElementById("Driver2").value+'驾照过期，可以报班吗？')){
							location.assign('tms_v1_schedule_noofrun.php?op=none');
							return;
						}
					}
				}
			} 
			if(i==0){
				if(CYZGZNumber=='' && CYZGZNumber1==''&& CYZGZNumber2==''){
					if(!confirm("该车辆缺少驾驶员驾从业资格证，可以报班吗？")){
						location.assign('tms_v1_schedule_noofrun.php?op=none');
						return;
					}
				}else{
					if(CYZGZNumber!='' && CYZGZNumber1==''&& CYZGZNumber2==''){
						if(CYZGZCheckD*1<CYZGZCheckx && CYZGZCheckD*1>=0){
							alert('驾驶员'+document.getElementById("Driver").value+'从业资格证还有'+CYZGZCheckD+'天到期！');
						}else{
							if(CYZGZCheckD*1<0){
								if(!confirm('驾驶员'+document.getElementById("Driver").value+'从业资格证过期，可以报班吗？')){
									location.assign('tms_v1_schedule_noofrun.php?op=none');
									return;
								}
							}
						}
					}
					if(CYZGZNumber=='' && CYZGZNumber1!=''&& CYZGZNumber2==''){
						if(CYZGZCheckD1*1<CYZGZCheckx && CYZGZCheckD1*1>=0){
							alert('驾驶员'+document.getElementById("Driver1").value+'从业资格证还有'+CYZGZCheckD1+'天到期！');
						}else{
							if(CYZGZCheckD1*1<0){
								if(!confirm('驾驶员'+document.getElementById("Driver1").value+'从业资格证过期，可以报班吗？')){
									location.assign('tms_v1_schedule_noofrun.php?op=none');
									return;
								}
							}
						}
					}
					if(CYZGZNumber=='' && CYZGZNumber1==''&& CYZGZNumber2!=''){
						if(CYZGZCheckD2*1<CYZGZCheckx && CYZGZCheckD2*1>=0){
							alert('驾驶员'+document.getElementById("Driver2").value+'从业资格证还有'+CYZGZCheckD2+'天到期！');
						}else{
							if(CYZGZCheckD2*1<0){
								if(!confirm('驾驶员'+document.getElementById("Driver2").value+'从业资格证过期，可以报班吗？')){
									location.assign('tms_v1_schedule_noofrun.php?op=none');
									return;
								}
							}
						}
					}
					if(CYZGZNumber!='' && CYZGZNumber1!=''&& CYZGZNumber2==''){
						if((CYZGZCheckD*1<CYZGZCheckx && CYZGZCheckD*1>=0) && (CYZGZCheckD1*1<CYZGZCheckx && CYZGZCheckD1*1>=0)){
							alert('驾驶员'+document.getElementById("Driver").value+'从业资格证还有'+CYZGZCheckD+'天到期；驾驶员'+document.getElementById("Driver1").value+'从业资格证还有'+CYZGZCheckD1+'天到期！');
						}
						if((CYZGZCheckD*1<0) && (CYZGZCheckD1*1<CYZGZCheckx && CYZGZCheckD1*1>=0)){
							alert('驾驶员'+document.getElementById("Driver").value+'从业资格证过期；驾驶员'+document.getElementById("Driver1").value+'从业资格证还有'+CYZGZCheckD1+'天到期！');
						}
						if((CYZGZCheckD*1<CYZGZCheckx && CYZGZCheckD*1>=0) && (CYZGZCheckD1*1<0)){
							alert('驾驶员'+document.getElementById("Driver").value+'从业资格证还有'+CYZGZCheckD+'天到期；驾驶员'+document.getElementById("Driver1").value+'从业资格证过期！');
						}
						if(CYZGZCheckD*1<0 && CYZGZCheckD1*1<0){
							if(!confirm('驾驶员'+document.getElementById("Driver").value+'和驾驶员'+document.getElementById("Driver1").value+'从业资格证过期，可以报班吗？')){
								location.assign('tms_v1_schedule_noofrun.php?op=none');
								return;
							}
						}
					}
					if(CYZGZNumber!='' && CYZGZNumber1==''&& CYZGZNumber2!=''){
						if((CYZGZCheckD*1<CYZGZCheckx && CYZGZCheckD*1>=0) && (CYZGZCheckD2*1<CYZGZCheckx && CYZGZCheckD2*1>=0)){
							alert('驾驶员'+document.getElementById("Driver").value+'从业资格证还有'+CYZGZCheckD+'天到期；驾驶员'+document.getElementById("Driver2").value+'从业资格证还有'+CYZGZCheckD2+'天到期！');
						}
						if((CYZGZCheckD*1<0) && (CYZGZCheckD2*1<CYZGZCheckx && CYZGZCheckD2*1>=0)){
							alert('驾驶员'+document.getElementById("Driver").value+'从业资格证过期；驾驶员'+document.getElementById("Driver2").value+'从业资格证还有'+CYZGZCheckD2+'天到期！');
						}
						if((CYZGZCheckD*1<CYZGZCheckx && CYZGZCheckD*1>=0) && (CYZGZCheckD2*1<0)){
							alert('驾驶员'+document.getElementById("Driver").value+'从业资格证还有'+CYZGZCheckD+'天到期；驾驶员'+document.getElementById("Driver2").value+'从业资格证过期！');
						}
						if(CYZGZCheckD*1<0 && CYZGZCheckD2*1<0){
							if(!confirm('驾驶员'+document.getElementById("Driver").value+'和驾驶员'+document.getElementById("Driver2").value+'从业资格证过期，可以报班吗？')){
								location.assign('tms_v1_schedule_noofrun.php?op=none');
								return;
							}
						}
					}
					if(CYZGZNumber=='' && CYZGZNumber1!=''&& CYZGZNumber2!=''){
						if((CYZGZCheckD1*1<CYZGZCheckx && CYZGZCheckD1*1>=0) && (CYZGZCheckD2*1<CYZGZCheckx && CYZGZCheckD2*1>=0)){
							alert('驾驶员'+document.getElementById("Driver1").value+'从业资格证还有'+CYZGZCheckD1+'天到期；驾驶员'+document.getElementById("Driver2").value+'从业资格证还有'+CYZGZCheckD2+'天到期！');
						}
						if((CYZGZCheckD1*1<0) && (CYZGZCheckD2*1<CYZGZCheckx && CYZGZCheckD2*1>=0)){
							alert('驾驶员'+document.getElementById("Driver1").value+'从业资格证过期；驾驶员'+document.getElementById("Driver2").value+'从业资格证还有'+CYZGZCheckD2+'天到期！');
						}
						if((CYZGZCheckD1*1<CYZGZCheckx && CYZGZCheckD1*1>=0) && (CYZGZCheckD2*1<0)){
							alert('驾驶员'+document.getElementById("Driver1").value+'从业资格证还有'+CYZGZCheckD1+'天到期；驾驶员'+document.getElementById("Driver2").value+'从业资格证过期！');
						}
						if(CYZGZCheckD1*1<0 && CYZGZCheckD2*1<0){
							if(!confirm('驾驶员'+document.getElementById("Driver1").value+'和驾驶员'+document.getElementById("Driver2").value+'从业资格证过期，可以报班吗？')){
								location.assign('tms_v1_schedule_noofrun.php?op=none');
								return;
							}
						}
					}
					if(CYZGZNumber!='' && CYZGZNumber1!=''&& CYZGZNumber2!=''){
						if((CYZGZCheckD*1<CYZGZCheckx && CYZGZCheckD*1>=0) && (CYZGZCheckD1*1<CYZGZCheckx && CYZGZCheckD1*1>=0) && (CYZGZCheckD2*1<CYZGZCheckx && CYZGZCheckD2*1>=0)){
							alert('驾驶员'+document.getElementById("Driver").value+'从业资格证还有'+CYZGZCheckD+'天到期；驾驶员'+document.getElementById("Driver1").value+'从业资格证还有'+CYZGZCheckD1+'天到期；驾驶员'+document.getElementById("Driver2").value+'从业资格证还有'+CYZGZCheckD2+'天到期！');
						}
						if((CYZGZCheckD*1<0) && (CYZGZCheckD1*1<CYZGZCheckx && CYZGZCheckD1*1>=0) && (CYZGZCheckD2*1<CYZGZCheckx && CYZGZCheckD2*1>=0)){
							alert('驾驶员'+document.getElementById("Driver").value+'从业资格证过期；驾驶员'+document.getElementById("Driver1").value+'从业资格证还有'+CYZGZCheckD1+'天到期；驾驶员'+document.getElementById("Driver2").value+'从业资格证还有'+CYZGZCheckD2+'天到期！');
						}
						if((CYZGZCheckD*1<CYZGZCheckx && CYZGZCheckD*1>=0) && (CYZGZCheckD1*1<0) && (CYZGZCheckD2*1<CYZGZCheckx && CYZGZCheckD2*1>=0)){
							alert('驾驶员'+document.getElementById("Driver").value+'从业资格证还有'+CYZGZCheckD+'天到期；驾驶员'+document.getElementById("Driver1").value+'从业资格证过期；驾驶员'+document.getElementById("Driver2").value+'从业资格证还有'+CYZGZCheckD2+'天到期！');
						}
						if((CYZGZCheckD*1<CYZGZCheckx && CYZGZCheckD*1>=0) && (CYZGZCheckD1*1<CYZGZCheckx && CYZGZCheckD1*1>=0) && (CYZGZCheckD2*1<0)){
							alert('驾驶员'+document.getElementById("Driver").value+'从业资格证还有'+CYZGZCheckD+'天到期；驾驶员'+document.getElementById("Driver1").value+'从业资格证还有'+CYZGZCheckD1+'天到期；驾驶员'+document.getElementById("Driver2").value+'从业资格证过期！');
						}
						if((CYZGZCheckD*1<0) && (CYZGZCheckD1*1<0) && (CYZGZCheckD2*1<CYZGZCheckx && CYZGZCheckD2*1>=0)){
							alert('驾驶员'+document.getElementById("Driver").value+'从业资格证过期；驾驶员'+document.getElementById("Driver1").value+'从业资格证过期；驾驶员'+document.getElementById("Driver2").value+'从业资格证还有'+CYZGZCheckD2+'天到期！');
						}
						if((CYZGZCheckD*1<0) && (CYZGZCheckD1*1<CYZGZCheckx && CYZGZCheckD1*1>=0) && (CYZGZCheckD2*1<0)){
							alert('驾驶员'+document.getElementById("Driver").value+'从业资格证过期；驾驶员'+document.getElementById("Driver1").value+'从业资格证还有'+CYZGZCheckD1+'天到期；驾驶员'+document.getElementById("Driver2").value+'从业资格证过期！');
						}
						if((CYZGZCheckD*1<CYZGZCheckx && CYZGZCheckD*1>=0) && (CYZGZCheckD1*1<0) && (CYZGZCheckD2*1<0)){
							alert('驾驶员'+document.getElementById("Driver").value+'从业资格证还有'+CYZGZCheckD+'天到期；驾驶员'+document.getElementById("Driver1").value+'从业资格证过期；驾驶员'+document.getElementById("Driver2").value+'从业资格证过期！');
						}
						if(CYZGZCheckD*1<0 && CYZGZCheckD1*1<0 && CYZGZCheckD2*1<0){
							if(!confirm('驾驶员'+document.getElementById("Driver").value+'、驾驶员'+document.getElementById("Driver1").value+'和驾驶员'+document.getElementById("Driver2").value+'从业资格证过期，可以报班吗？')){
								location.assign('tms_v1_schedule_noofrun.php?op=none');
								return;
							}
						}
					}
				}
			}	*/
		});
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
		<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
		<span class="graytext" style="margin-left:8px;">报班车辆信息</span></td>
	</tr>
</table>
<form action="" method="post" name="form1">
		<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
			<tr bgcolor="#d4d1d1">
    			<td colspan="4"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />基本信息</span> </td>
			</tr>
			<tr>
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆编号：</span></td>
		        <td bgcolor="#FFFFFF"><input name="BusID" id="BusID" type="text" value="<?php echo $row['bi_BusID'];?>" disabled="disabled"/></td>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7"/> 登记日期：</span></td>
				<td bgcolor="#FFFFFF"><input name="RegDate" id="RegDate" type="text" value="<?php echo $row['bi_RegDate'];?>" disabled="disabled"/></td>
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
		    	<td bgcolor="#FFFFFF"><input name="BusNumber" id="BusNumber" type="text" value="<?php echo $row['bi_BusNumber'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7"/> 车型编号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text"  name="BusTypeI" id="BusTypeI" value="<?php echo $row['bi_BusTypeID'];?>" disabled="disabled"/></td>
			</tr> 
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型名 ：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="BusType" id="BusType" value="<?php echo $row['bi_BusType'];?>" disabled="disabled"/></td>
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 座位数：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="Seat" id="Seat" value="<?php echo $row['bi_SeatS'];?>" disabled="disabled"/></td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 加座数：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="AddSeat" id="AddSeat" value="<?php echo $row['bi_AddSeatS'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 吨位：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="Tonnage" id="Tonnage" value="<?php echo $row['bi_Tonnage'];?>" disabled="disabled"/>吨</td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="BusUnit" id="BusUnit" value="<?php echo $row['bi_BusUnit'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 厂牌：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="Sign" id="Sign"  value="<?php echo $row['bi_Sign'];?>" disabled="disabled"/></td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发动机型号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="EngineType" id="EngineType" value="<?php echo $row['bi_EngineType'];?>" disabled="disabled"/></td> 
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发动机号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="EngineNumber" id="EngineNumber" value="<?php echo $row['bi_EngineNumber'];?>" disabled="disabled"/></td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆识别号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="BusIdentify" id="BusIdentify" value="<?php echo $row['bi_BusIdentify'];?>" disabled="disabled"/></td> 
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆改型情况：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="BusChangeType" id="BusChangeType" value="<?php echo $row['bi_BusChangeType'];?>" disabled="disabled"/></td> 
			</tr>
			<tr> 
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="InStation" id="InStation" value="<?php echo $row['bi_InStation'];?>" disabled="disabled"/></td>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站编号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="InStationI" id="InStationI" disabled="disabled" value="<?php echo $row['bi_InStationID'];?>" disabled="disabled"/></td>
			</tr>
			<tr bgcolor="#d4d1d1">
    			<td colspan="4"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 车主信息</td>
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车主姓名：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="OwnerName" id="OwnerName"  value="<?php echo $row['bi_OwnerName'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车主地址：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="OwnerAdd" id="OwnerAdd" value="<?php echo $row['bi_OwnerAdd'];?>" disabled="disabled"/></td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车主电话：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="OwnerTel" id="OwnerTel" value="<?php echo $row['bi_OwnerTel'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车主身份证：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="OwnerIdCard" id="OwnerIdCard" value="<?php echo $row['bi_OwnerIdCard'];?>" disabled="disabled"/></td> 
			</tr>
			<tr bgcolor="#d4d1d1">
    			<td colspan="4"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 驾驶员信息</td>
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 正驾驶编号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="DriverID" id="DriverID" value="<?php echo $rowdriver['di_DriverID'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 正驾驶姓名：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="Driver" id="Driver" value="<?php echo $row['bi_Driver'];?>" disabled="disabled"/></td> 	
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员驾照编号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="DriverCard" id="DriverCard" value="<?php echo $rowdriver['di_DriverCard'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员驾照有效期：</span></td>
		    	<td bgcolor="#FFFFFF">
		    						<input type="text" name="DriverCheckDate" id="DriverCheckDate" value="<?php echo $rowdriver['di_DriverCheckDate'];?>" disabled="disabled"/>
		    						<input type="hidden" name="DriverCheckx" id="DriverCheckx" value="<?php echo $DriverCheckx;?>"/>
		    						<input type="hidden" name="DriverCheckD" id="DriverCheckD" value="<?php echo (strtotime( $rowdriver['di_DriverCheckDate'])-strtotime(date('Y-m-d')))/3600/24;?>" />
		    	</td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员从业资格证号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="CYZGZNumber" id="CYZGZNumber" value="<?php echo $rowdriver['di_CYZGZNumber'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员从业资格有效期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="CYZGZCheckDate" id="CYZGZCheckDate" value="<?php echo $rowdriver['di_CYZGZCheckDate'];?>" disabled="disabled"/>
		    						<input type="hidden" name="CYZGZCheckx" id="CYZGZCheckx" value="<?php echo $CYZGZCheckx;?>" />
		    						<input type="hidden" name="CYZGZCheckD" id="CYZGZCheckD" value="<?php echo (strtotime( $rowdriver['di_CYZGZCheckDate'])-strtotime(date('Y-m-d')))/3600/24;?>" />
		    	</td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员1编号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="Driver1ID" id="Driver1ID" value="<?php echo $rowdriver1['di_DriverID'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员1姓名：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="Driver1" id="Driver1" value="<?php echo $row['bi_Driver1'];?>" disabled="disabled"/></td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员1驾照编号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="Driver1Card" id="Driver1Card" value="<?php echo $rowdriver1['di_DriverCard'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员1驾照有效期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="Driver1CheckDate" id="Driver1CheckDate" value="<?php echo $rowdriver1['di_DriverCheckDate'];?>" disabled="disabled"/>
		    						<input type="hidden" name="Driver1CheckD" id="Driver1CheckD" value="<?php echo (strtotime( $rowdriver1['di_DriverCheckDate'])-strtotime(date('Y-m-d')))/3600/24;?>" />
		    	</td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员1从业资格证号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="CYZGZNumber1" id="CYZGZNumber1" value="<?php echo $rowdriver1['di_CYZGZNumber'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />驾驶员 1从业资格有效期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="CYZGZCheckDate1" id="CYZGZCheckDate1" value="<?php echo $rowdriver1['di_CYZGZCheckDate'];?>" disabled="disabled"/>
		    						<input type="hidden" name="CYZGZCheckD1" id="CYZGZCheckD1" value="<?php echo (strtotime( $rowdriver1['di_CYZGZCheckDate'])-strtotime(date('Y-m-d')))/3600/24;?>" />
		    	</td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员2编号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="Driver2ID" id="Driver2ID" value="<?php echo $rowdriver2['di_DriverID'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员2姓名：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="Driver2" id="Driver2" value="<?php echo $row['bi_Driver2'];?>" disabled="disabled"/></td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员2驾照编号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="Driver2Card" id="Driver2Card" value="<?php echo $rowdriver2['di_DriverCard'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员2驾照有效期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="Driver2CheckDate" id="Driver2CheckDate" value="<?php echo $rowdriver2['di_DriverCheckDate'];?>" disabled="disabled"/>
		    						<input type="hidden" name="Driver2CheckD" id="Driver2CheckD" value="<?php echo (strtotime( $rowdriver2['di_DriverCheckDate'])-strtotime(date('Y-m-d')))/3600/24;?>" />
		    	</td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员2从业资格证号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="CYZGZNumber2" id="CYZGZNumber2" value="<?php echo $rowdriver2['di_CYZGZNumber'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />驾驶员 2从业资格有效期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="CYZGZCheckDate2" id="CYZGZCheckDate2" value="<?php echo $rowdriver2['di_CYZGZCheckDate'];?>" disabled="disabled"/>
		    						<input type="hidden" name="CYZGZCheckD2" id="CYZGZCheckD2" value="<?php echo (strtotime( $rowdriver2['di_CYZGZCheckDate'])-strtotime(date('Y-m-d')))/3600/24;?>" />
		    	</td> 
			</tr>
			<tr bgcolor="#d4d1d1">
    			<td colspan="4"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 保险信息</td>
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保单号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="InsuranceNo" id="InsuranceNo" value="<?php echo $row['bi_InsuranceNo'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 承保公司：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="InsuranceCompany" id="InsuranceCompany" value="<?php echo $row['bi_InsuranceCompany'];?>" disabled="disabled"/></td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 建档日期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="InsuranceDate" id="InsuranceDate" value="<?php echo $row['bi_InsuranceDate'];?>" disabled="disabled"/></td>
		    	<td bgcolor="#FFFFFF"></td>
		    	<td bgcolor="#FFFFFF"></td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 交强险开始日期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="TransportationBeginDate" id="TransportationBeginDate" value="<?php echo $row['bi_TransportationBeginDate'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结束日期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="TransportationEndDate" id="TransportationEndDate" value="<?php $row['bi_TransportationEndDate']?>" disabled="disabled"/>
		    						<input type="hidden" name="TransportationEnd" id="TransportationEnd" value="<?php echo (strtotime($row['bi_TransportationEndDate'])-strtotime(date('Y-m-d')))/3600/24;?>" />
		    						<input type="hidden" name="Transportationx" id="Transportationx" value="<?php echo $Transportationx;?>" />
		    	</td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 商业险开始日期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="TradeBeginDate" id="TradeBeginDate" value="<?php echo $row['bi_TradeBeginDate'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7"/> 结束日期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="TradeEndDate" id="TradeEndDate" value="<?php echo $row['bi_TradeEndDate'];?>" disabled="disabled"/>
		    						<input type="hidden" name="TradeEnd" id="TradeEnd" value="<?php echo (strtotime($row['bi_TradeEndDate'])-strtotime(date('Y-m-d')))/3600/24;?>" />
		    						<input type="hidden" name="Tradex" id="Tradex" value="<?php echo $Tradex;?>" />
		    	</td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 承运人险开始日期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="RenBeginDate" id="RenBeginDate" value="<?php echo $row['bi_RenBeginDate'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结束日期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="RenEndDate" id="RenEndDate" value="<?php echo $row['bi_RenEndDate'];?>" disabled="disabled"/>
		    						<input type="hidden" name="RenEnd" id="RenEnd" value="<?php echo (strtotime($row['bi_RenEndDate'])-strtotime(date('Y-m-d')))/3600/24;?>" />
		    						<input type="hidden" name="Renx" id="Renx" value="<?php echo $Renx;?>" />
		    	</td> 
			</tr>
			<tr bgcolor="#d4d1d1">
    			<td colspan="4"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 证照信息</td>
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 经营线路：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="ManagementLine" id="ManagementLine" value="<?php echo $row['bi_ManagementLine'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路牌号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="LineLicense" id="LineLicense" value="<?php echo $row['bi_LineLicense'];?>" disabled="disabled"/></td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路牌照附卡号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="LineLicenseAttached" id="LineLicenseAttached" value="<?php echo $row['bi_LineLicenseAttached'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路牌照附卡有效期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="AttachedEndDate" id="AttachedEndDate" value="<?php echo $row['bi_AttachedEndDate'];?>" disabled="disabled"/>
		    						<input type="hidden" name="AttachedEnd" id="AttachedEnd" value="<?php echo (strtotime($row['bi_AttachedEndDate'])-strtotime(date('Y-m-d')))/3600/24;?>" />
		    						<input type="hidden" name="Attachedx" id="Attachedx" value="<?php echo $Attachedx;?>" />
		    						<input type="hidden" name="Attachedy" id="Attachedy" value="<?php echo $Attachedy;?>" />
		    	
		    	</td> 
			</tr>
			<tr> 
    			<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 道路运输证号：</span></td>
    			<td bgcolor="#FFFFFF"><input type="text" name="RoadTransport" id="RoadTransport" value="<?php echo $row['bi_RoadTransport'];?>" disabled="disabled"/></td> 
    			<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 道路运输证有效期：</span></td>
    			<td bgcolor="#FFFFFF"><input type="text" name="RoadTransportEndDate" id="RoadTransportEndDate" value="<?php echo $row['bi_RoadTransportEndDate'];?>" disabled="disabled"/>
    								<input type="hidden" name="RoadTransportx" id="RoadTransportx" value="<?php echo $RoadTransportx;?>" />
		    						<input type="hidden" name="RoadTransportEnd" id="RoadTransportEnd" value="<?php echo (strtotime($row['bi_RoadTransportEndDate'])-strtotime(date('Y-m-d')))/3600/24;?>" />
    			</td> 
			</tr>
			<tr> 
    			<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车辆行驶证号：</span></td>
    			<td bgcolor="#FFFFFF"><input type="text" name="VehicleDriving" id="VehicleDriving" value="<?php echo $row['bi_VehicleDriving'];?>" disabled="disabled"/></td> 
    			<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆行驶证有效期：</span></td>
    			<td bgcolor="#FFFFFF"><input type="text" name="VehicleDrivingEndDate" id="VehicleDrivingEndDate" value="<?php echo $row['bi_VehicleDrivingEndDate'];?>" disabled="disabled"/>
    								<input type="hidden" name="VehicleDrivingx" id="VehicleDrivingx" value="<?php echo $VehicleDrivingx;?>" />
		    						<input type="hidden" name="VehicleDrivingEnd" id="VehicleDrivingEnd" value="<?php echo (strtotime($row['bi_VehicleDrivingEndDate'])-strtotime(date('Y-m-d')))/3600/24;?>" />
    			</td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 营运证号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="Business" id="Business" value="<?php echo $row['bi_Business'];?>" disabled="disabled"/></td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 春检完成日期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="SpringCheckEndDate" id="SpringCheckEndDate" value="<?php echo $row['bi_SpringCheckEndDate'];?>" disabled="disabled"/>
		    						<input type="hidden" name="SpringCheckx" id="SpringCheckx" value="<?php echo $SpringCheckx;?>" />
		    						<input type="hidden" name="SpringCheckEnd" id="SpringCheckEnd" value="<?php echo (strtotime(date('Y-m-d',strtotime('+'.$SpringChecky.' year')))-strtotime(date('Y-m-d')))/3600/24;?>" />
		    	
		    	</td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 审验完成日期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="ExaminationEndDate" id="ExaminationEndDate" value="<?php echo $row['bi_ExaminationEndDate'];?>" disabled="disabled"/>
		    						<input type="hidden" name="Examinationx" id="Examinationx" value="<?php echo $Examinationx;?>"/>
		    						<input type="hidden" name="ExaminationEnd" id="ExaminationEnd" value="<?php echo (strtotime(date('Y-m-d',strtotime('+'.$Examinationy.' year')))-strtotime(date('Y-m-d')))/3600/24;?>"/>
		    	</td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 二级维护完成日期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="TwoEndDate" id="TwoEndDate" value="<?php echo $row['bi_TwoEndDate'];?>" disabled="disabled"/>
		    						<input type="hidden" name="Twox" id="Twox" value="<?php echo $Twox;?>" />
		    						<input type="hidden" name="TwoEnd" id="TwoEnd" value="<?php echo (strtotime(date('Y-m-d',strtotime('+'.$Twoy.' year')))-strtotime(date('Y-m-d')))/3600/24;?>" />
		    	</td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 等级评定完成日期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="RankEndDate" id="RankEndDate" value="<?php echo $row['bi_RankEndDate'];?>" disabled="disabled"/>
		    						<input type="hidden" name="Rankx" id="Rankx" value="<?php echo $Rankx;?>" />
		    						<input type="hidden" name="RankEnd" id="RankEnd" value="<?php echo (strtotime(date('Y-m-d',strtotime('+'.$Ranky.' year')))-strtotime(date('Y-m-d')))/3600/24;?>" />
		    	
		    	</td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 行驶证检验完成日期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="TravelEndDatete" id="TravelEndDate" value="<?php echo $row['bi_TravelEndDate'];?>" disabled="disabled"/>
		    						<input type="hidden" name="Travelx" id="Travelx" value="<?php echo $Travelx;?>" />
		    						<input type="hidden" name="TravelEnd" id="TravelEnd" value="<?php echo (strtotime(date('Y-m-d',strtotime('+'.$Travely.' year')))-strtotime(date('Y-m-d')))/3600/24;?>" />
		    	
		    	</td> 
			</tr>
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 月维护完成日期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="MonthEndDate" id="MonthEndDate" value="<?php echo $row['bi_MonthEndDate'];?>" disabled="disabled"/>
		    						<input type="hidden" name="Monthx" id="Monthx" value="<?php echo $Monthx;?>" />
		    						<input type="hidden" name="MonthEnd" id="MonthEnd" value="<?php echo (strtotime(date('Y-m-d',strtotime('+'.$Monthy.' year')))-strtotime(date('Y-m-d')))/3600/24;?>" />
		    	
		    	</td> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 液化气证完成日期：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="text" name="CNGEndDate" id="CNGEndDate" value="<?php echo $row['bi_CNGEndDate'];?>" disabled="disabled"/>
		    						<input type="hidden" name="CNGx" id="CNGx" value="<?php echo $CNGx;?>" />
		    						<input type="hidden" name="CNGEnd" id="CNGEnd" value="<?php echo (strtotime(date('Y-m-d',strtotime('+'.$CNGy.' year')))-strtotime(date('Y-m-d')))/3600/24;?>" />
		    	</td> 
			</tr>
			<tr> 	
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
		    	<td colspan="3" bgcolor="#FFFFFF"><textarea style="width:100%;" name="Remark" cols="" rows="5" disabled="disabled"><?php echo $row['bi_Remark'];?></textarea></td>
			</tr> 
		   <tr>
		    <td colspan="4" align="center" bgcolor="#FFFFFF">
		    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="history.back()" />
		    </td>
		  </tr>
		</table>
		</form>
</body>
</html>
