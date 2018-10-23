<?
//改签界面
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
if (isset($_POST['ticketnum'])) {
	$ticketid=$_POST['ticketnum'];
	$ticketid1=$_POST['ticketnum1'];
	$alertdate=$_POST['alertdate'];
	$tnum = $_POST['tnum'];
}
if(isset($_GET['tid']))
  {
 //	 $ticketID=$_POST['ticketID'];
  	 $ticketID=$_GET['tid'];
  	 $alertdate=$_GET['ald'];
  	 $NoOfRunsID=$_GET['nid'];
//  	 $alertdate=$_POST['alertdate'];
     $nowtime=date('Y-m-d H:m:s');
     $nowdate=date('Y-m-d');
     $alterID=$userID;
     $alterer=$userName;
     
     $alterremark=$_GET['alr'];
//  $alterremark=$_POST['alterremark'];
     $altersite=$userStationName;
     $altersiteID=$userStationID;
 
     $class_mysql_default->my_query("START TRANSACTION");
     foreach (explode(",",$ticketID) as $key =>$ticketIDs){
     
	     $strsqlselet = "SELECT * FROM `tms_sell_SellTicket` WHERE `st_TicketID` = '$ticketIDs'";
	     $resultselet = $class_mysql_default ->my_query("$strsqlselet");
		 if(!$resultselet) {
			$class_mysql_default->my_query("ROLLBACK");
		    echo "<script>alert('查询售票失败！');history.back();</script>";	
		 //	echo "<script>alert('查询售票数据失败！');history.back();</script>";
			exit();
		 }
		 $rows = @mysql_fetch_array($resultselet);
	     $selectprice="SELECT tml_NoOfRunsID,pd_LineID,pd_BeginStation,pd_EndStation,pd_FromStation,pd_ReachStation,pd_FullPrice,pd_HalfPrice,pd_BeginStationTime,pd_StopStationTime,
	     	pd_Distance,tml_BusModel,tml_LeaveSeats,tml_LeaveHalfSeats,nri_LineName,nri_Allticket FROM tms_bd_PriceDetail LEFT OUTER JOIN tms_bd_TicketMode ON 
	     	tms_bd_PriceDetail.pd_NoOfRunsID = tms_bd_TicketMode.tml_NoOfRunsID AND tms_bd_PriceDetail.pd_NoOfRunsdate = tms_bd_TicketMode.tml_NoOfRunsdate LEFT OUTER JOIN tms_bd_NoRunsInfo 
	     	ON tms_bd_PriceDetail.pd_NoOfRunsID=tms_bd_NoRunsInfo.nri_NoOfRunsID WHERE pd_FromStation='{$rows['st_FromStation']}' AND  pd_ReachStation='{$rows['st_ReachStation']}' AND 
	     	pd_NoOfRunsdate = '{$alertdate}' AND tml_NoOfRunsID = '{$NoOfRunsID}'";
	     $resultprice = $class_mysql_default ->my_query("$selectprice");
	  	 if(!$resultprice) {
			$class_mysql_default->my_query("ROLLBACK");
	  	 	echo "<script>alert('查询票价数据失败！');history.back();</script>";
			exit();
		  }
	     $rowsprice = @mysql_fetch_array($resultprice);
	     if(!empty($rows[0]))
	     {
	         //写改签票表
	      //  $class_mysql_default->my_query("START TRANSACTION");
	        $selectmodel1="SELECT tml_SeatStatus, tml_LeaveSeats,tml_LeaveHalfSeats FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '{$rows['st_NoOfRunsID']}') AND 
	         	(tml_NoOfRunsdate ='{$rows['st_NoOfRunsdate']}') FOR UPDATE";
	     	$resultmodel1 = $class_mysql_default->my_query("$selectmodel1");
	     	if(!$resultmodel1) {
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('锁定票版1数据失败！');history.back();</script>";
				exit();
			}
	     	$rowsmodel1 = @mysql_fetch_array($resultmodel1);
	     	$seatStatus1 = $rowsmodel1['tml_SeatStatus'];
	     	$seatStatus1 = substr_replace($seatStatus1, '0', $rows['st_SeatID']-1, 1);
	     	if ($rows['st_SellPriceType']=='半票'){
	     		$rowsmodel1['tml_LeaveHalfSeats']=$rowsmodel1['tml_LeaveHalfSeats']+1;
	     	}
	     	$rowsmodel1['tml_LeaveSeats']=$rowsmodel1['tml_LeaveSeats']+1;
	     	$updatemodel1="UPDATE tms_bd_TicketMode SET tml_SeatStatus='{$seatStatus1}',tml_LeaveSeats='{$rowsmodel1['tml_LeaveSeats']}',tml_LeaveHalfSeats='{$rowsmodel1['tml_LeaveHalfSeats']}' 
	     		WHERE (tml_NoOfRunsID = '{$rows['st_NoOfRunsID']}') AND (tml_NoOfRunsdate ='{$rows['st_NoOfRunsdate']}')";
	     	$querymodel1= $class_mysql_default->my_query("$updatemodel1");
	     	if(!$querymodel1) {
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('更新票版1数据失败！');history.back();</script>";
				exit();
			}
			$selectmodel2="SELECT tml_SeatStatus, tml_LeaveSeats,tml_LeaveHalfSeats FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '{$NoOfRunsID}') AND 
	         	(tml_NoOfRunsdate ='{$alertdate}') FOR UPDATE";
	     	$resultmodel2 = $class_mysql_default->my_query("$selectmodel2");
	     	if(!$resultmodel2) {
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('锁定票版2数据失败！');history.back();</script>";
				exit();
			}
	     	$rowsmodel2 = @mysql_fetch_array($resultmodel2);
	     	$seatStatus2 = $rowsmodel2['tml_SeatStatus'];
	     	if(strpos($seatStatus2,'0')===false){
	     		$class_mysql_default->my_query("ROLLBACK");
	     		echo "<script>alert('锁定票版2数据失败！');history.back();</script>";
				exit();
	     	}else{
	     		$seatID=strpos($seatStatus2,'0')+1;
	     	}
	     	$seatStatus2 = substr_replace($seatStatus2, '3', strpos($seatStatus2,'0'), 1); //这里需要修改
	     	if ($rows['st_SellPriceType']=='半票'){
	     		$rowsmodel2['tml_LeaveHalfSeats']=$rowsmodel2['tml_LeaveHalfSeats']-1;
	     	}
	     	$rowsmodel2['tml_LeaveSeats']=$rowsmodel2['tml_LeaveSeats']-1;
	     	$updatemodel2="UPDATE tms_bd_TicketMode SET tml_SeatStatus='{$seatStatus2}',tml_LeaveSeats='{$rowsmodel2['tml_LeaveSeats']}',tml_LeaveHalfSeats='{$rowsmodel2['tml_LeaveHalfSeats']}' 
	     		WHERE (tml_NoOfRunsID = '{$NoOfRunsID}') AND (tml_NoOfRunsdate ='{$alertdate}')";
	     	$querymodel2= $class_mysql_default->my_query("$updatemodel2");
	     	if(!$querymodel2) {
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('更新票版2数据失败！');history.back();</script>";
				exit();
			}
	        $strsqlselet1 = "INSERT INTO `tms_sell_AlterTicket` (`at_TicketID`, `at_NoOfRunsID`, `at_LineID`, `at_NoOfRunsdate`, `at_BeginStationTime`, 
		         	`at_StopStationTime`, `at_Distance`, `at_BeginStationID`, `at_BeginStation`, `at_FromStationID`, `at_FromStation`, 
		         	`at_ReachStationID`, `at_ReachStation`, `at_EndStationID`, `at_EndStation`, `at_SellPrice`, `at_SellPriceType`, 
		         	`at_ColleSellPriceType`, `at_TotalMan`, `at_FullPrice`, `at_HalfPrice`, `at_StandardPrice`, `at_BalancePrice`, 
		         	`at_ServiceFee`, `at_otherFee1`, `at_otherFee2`, `at_otherFee3`, `at_otherFee4`, `at_otherFee5`, `at_otherFee6`, 
		         	`at_AlterStationID`, `at_AlterStation`, `at_SellDate`, `at_SellTime`, `at_BusModelID`, `at_BusModel`, `at_SeatID`, 
		         	`at_SellID`, `at_SellName`, `at_FreeSeats`, `at_SafetyTicketNumber`, `at_SafetyTicketMoney`, `at_AlterDateTime`, 
		         	`at_AlterSellID`, `at_AlterSellName`, `at_Remark`) VALUES ('$ticketIDs', '{$rows['st_NoOfRunsID']}', '{$rows['st_LineID']}', '{$rows['st_NoOfRunsdate']}', 
		         	'{$rows['st_BeginStationTime']}', '{$rows['st_StopStationTime']}', '{$rows['st_Distance']}', '{$rows['st_BeginStationID']}', '{$rows['st_BeginStation']}', 
		         	'{$rows['st_FromStationID']}', '{$rows['st_FromStation']}', '{$rows['st_ReachStationID']}', '{$rows['st_ReachStation']}', '{$rows['st_EndStationID']}', 
		         	'{$rows['st_EndStation']}', '{$rows['st_SellPrice']}', '{$rows['st_SellPriceType']}', '{$rows['st_ColleSellPriceType']}', '{$rows['st_TotalMan']}', 
		         	'{$rows['st_FullPrice']}', '{$rows['st_HalfPrice']}', '{$rows['st_StandardPrice']}', '{$rows['st_BalancePrice']}', '{$rows['st_ServiceFee']}', '{$rows['st_otherFee1']}', 
		         	'{$rows['st_otherFee2']}', '{$rows['st_otherFee3']}', '{$rows['st_otherFee4']}', '{$rows['st_otherFee5']}', '{$rows['st_otherFee6']}', '{$altersiteID}', '{$altersite}', 
		         	'{$rows['st_SellDate']}', '{$rows['st_SellTime']}', '{$rows['st_BusModelID']}', '{$rows['st_BusModel']}', '{$rows['st_SeatID']}', '{$rows['st_SellID']}', 
		         	'{$rows['st_SellName']}', '{$rows['st_FreeSeats']}', '{$rows['st_SafetyTicketNumber']}','{$rows['st_SafetyTicketMoney']}', '$nowtime', '$alterID', '$alterer', '$alterremark');";
	        $resultselet1 = $class_mysql_default ->my_query("$strsqlselet1");
	     	if(!$resultselet1) {
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('插入改签数据失败！');history.back();</script>";
				exit();
			}
	     //处理并班
	     	if($rows['st_TicketState']=='9'){
	     		$selectandrun="SELECT anr_AndNoOfRunsID, anr_AndNoOfRunsdate,anr_AndSeatID,anr_Seats,anr_HalfSeats FROM tms_sch_AndNoOfRuns WHERE anr_NoOfRunsID='{$rows['st_NoOfRunsID']}' AND 
	     			anr_NoOfRunsdate='{$rows['st_NoOfRunsdate']}'";
	     		$queryandrun=$class_mysql_default ->my_query("$selectandrun");
	     		if(!$queryandrun){
	     			$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('查询并班数据失败！');history.back();</script>";
					exit();
	     		}
	     		$rowandrun=mysql_fetch_array($queryandrun);
	     		$selectmodel2="SELECT tml_SeatStatus, tml_LeaveSeats,tml_LeaveHalfSeats FROM tms_bd_TicketMode WHERE tml_NoOfRunsID='{$rowandrun['anr_AndNoOfRunsID']}' AND 
	     			tml_NoOfRunsdate='{$rowandrun['anr_AndNoOfRunsdate']}' FOR UPDATE";
		     	$resultmodel2 = $class_mysql_default->my_query("$selectmodel2");
		     	if(!$resultmodel2) {
					$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('锁定票版数据失败2！');history.back();</script>";
					exit();
				}
				$rowsmodel2 = mysql_fetch_array($resultmodel2);
				$seatStatus2 = $rowsmodel2['tml_SeatStatus'];
	     		$seatStatus2 = substr_replace($seatStatus2, '0', stripos($seatStatus2, '7'), 1);
	     		$rowandrun['anr_Seats']=$rowandrun['anr_Seats']-1;
	     		if ($rows['st_SellPriceType']=='半票'){
	     			$rowsmodel2['tml_LeaveHalfSeats']=$rowsmodel2['tml_LeaveHalfSeats']+1;
	     			$rowandrun['anr_HalfSeats']=$rowandrun['anr_HalfSeats']-1;
	     		}
	     		$SeatID=$rowandrun['anr_AndSeatID'];
	     		$SeatID=substr($SeatID,stripos($SeatID, ',')+1);
	     		$rowsmodel2['tml_LeaveSeats']=$rowsmodel2['tml_LeaveSeats']+1;
		     	$updatemodel2="UPDATE tms_bd_TicketMode SET tml_SeatStatus='{$seatStatus2}',tml_LeaveSeats='{$rowsmodel2['tml_LeaveSeats']}',tml_LeaveHalfSeats='{$rowsmodel2['tml_LeaveHalfSeats']}' 
		     		WHERE (tml_NoOfRunsID = '{$rowandrun['anr_AndNoOfRunsID']}') AND (tml_NoOfRunsdate ='{$rowandrun['anr_AndNoOfRunsdate']}')";
		     	$querymodel2= $class_mysql_default->my_query("$updatemodel2");
		     	if(!$querymodel2) {
					$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('更新票版数据失败2！');history.back();</script>";
					exit();
		     	}
		     	$updateandrun="UPDATE tms_sch_AndNoOfRuns SET anr_Seats='{$rowandrun['anr_Seats']}',anr_HalfSeats='{$rowandrun['anr_HalfSeats']}',anr_AndSeatID='{$SeatID}' 
		     		WHERE anr_NoOfRunsID='{$rows['st_NoOfRunsID']}' AND anr_NoOfRunsdate='{$rows['st_NoOfRunsdate']}'";
		     	$queryandrun1=$class_mysql_default->my_query("$updateandrun");
		     	if(!$queryandrun1){
		     		$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('更新并班数据失败！');history.back();</script>";
					exit();
		     	}
	     	}
	      //更新原票是否改签状态
	        $strsqlselet2 = "UPDATE tms_sell_SellTicket SET st_AlterTicket = '1',st_LineID='{$rowsprice['pd_LineID']}',st_NoOfRunsID='{$NoOfRunsID}', st_NoOfRunsdate='{$alertdate}',
	        	st_BeginStationTime='{$rowsprice['pd_BeginStationTime']}',st_StopStationTime='{$rowsprice['pd_StopStationTime']}',st_Distance='{$rowsprice['pd_Distance']}',
	        	st_SeatID='{$seatID}',st_TicketState='0' WHERE st_TicketID = '$ticketIDs';";
	     //   $strsqlselet = "UPDATE `tms_sell_SellTicket` SET `st_AlterTicket` = '1' WHERE `st_TicketID` = '$ticketID';";
	        $resultselet2 = $class_mysql_default ->my_query("$strsqlselet2");
	     	if(!$resultselet2) {
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('更新原票数据失败！');history.back();</script>";
				exit();
			}  
		}
     }	
	 $class_mysql_default->my_query("COMMIT");
	 echo "<script>alert('改签成功！')</script>";
	 echo "<script>window.location.href ='tms_v1_sell_alter.php';</script>";
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>改签界面</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="../js/jquery.js"></script>		
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script>
	function changecontinous(){
		if(document.getElementById("IsContinuous").checked){
			document.getElementById("IsContinuou").value='1';
			document.getElementById("Continuousname").style.display='';
			document.getElementById("Continuous").style.display='';
			document.getElementById("Uncontinuousname").style.display='none';
			document.getElementById("Uncontinuous").style.display='none';
		}else{
			document.getElementById("IsContinuou").value='0';
			document.getElementById("Continuousname").style.display='none';
			document.getElementById("Continuous").style.display='none';
			document.getElementById("Uncontinuousname").style.display='';
			document.getElementById("Uncontinuous").style.display='';
		}
	}
	$(document).ready(function(){
		$("#table2 tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
		$("#table2 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
		$("#table2 tr").click(function(){
			$("#table2 tr:not(this)").css("background-color","#CCCCCC");
			$("#table2 tr:not(this)").mouseover(function(){$(this).css("background-color","#F1E6C2");});
			$("#table2 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$(this).css("background-color","#FFCC00");
			$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
			$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
			$("#NoOfRunsID").val($(this).children().eq(10).text());
		});
	
		$("#getTicketInfo").click(function(){
			// var table1=document.getElementById("table1");
		//	 var table2=document.getElementById("table2");
		//	 table1.style.display=(table1.style.display=="none"?"":"none");
		//	 table2.style.display=(table2.style.display=="none"?"":"none");
			 getticketinfor();

		}); 
		$("#confirmAlter").click(function(){
			var NoOfRunsID1 =document.getElementById("NoOfRunsID1").value;
			var alertdate1 =document.getElementById("alertdate1").value;
			//alert(NoOfRunsID1)
			if (document.form1.ticketnum.value == "") {
				alert("请输入客票号！");
				document.form1.ticketnum.focus();
				return;
			}
			if (document.form1.NoOfRunsID.value == "") {
				alert("请选择班次！");
				return;
			}
		
			if (document.form1.alertdate.value == alertdate1 ) {
				if (document.form1.NoOfRunsID.value == NoOfRunsID1 ) {
					alert("无法改签当天相同班次，请选择其他班次！");
					return;
				}
			}
			var ticketID = document.getElementById("ticketnum").value;
			var norunsID = document.getElementById("NoOfRunsID").value;
			var alertdate = document.getElementById("alertdate").value;
			var alterremark = document.getElementById("alterremark").value;
			var ticketID=ticketID.split("\r\n");
			var url = 'tms_v1_sell_alter.php?'+'tid='+ticketID+'&ald='+alertdate+'&nid='+norunsID+'&alr='+alterremark;
		    window.location.href = url;
		});
	});
	function getticketinfor(){
		var strticket='';
		if (document.getElementById("IsContinuou").value=='1'){
			if (document.form1.ticketnum1.value == "") {
				alert("请输入客票号！");
				document.form1.ticketnum1.focus();
			}else {
				if(document.form1.tnum.value=="" || document.form1.tnum.value=='0'){
					document.form1.tnum.value=1;
				}
				if(document.getElementById("IsContinuou").value==1 && document.getElementById("ticketnum1").value!=''){
					for(var i=0; i<document.getElementById("tnum").value;i++){
			            var newstr='';
						var newvalue=document.getElementById("ticketnum1").value*1+i;
						for(var j=0;j<document.getElementById("ticketnum1").value.length-String(newvalue).lenght;j++){
							 newstr=newstr+'0';
						}
						newstr=newstr+String(newvalue);
						strticket=strticket+newstr+'\r\n';
					}
					document.getElementById("ticketnum").value=strticket;
				//	alert(document.getElementById("ticketnum").value);
				}
			}
		}else{
			if (document.form1.ticketnum.value == "") {
				alert("请输入客票号！");
				document.form1.ticketnum.focus();
			}else{ 
				var ticketID=document.form1.ticketnum.value.split("\r\n");
				var nticketID = ticketID.sort();
				for(var i = 0; i < nticketID.length - 1; i++){
				    if (nticketID[i] == nticketID[i+1]){
				        alert("重复票号：" + nticketID[i] + "将被删除");
				        document.getElementById("ticketnum").value=document.getElementById("ticketnum").value.replace(nticketID[i+1]+"\r\n",'');
				   //    document.form1.ticketnum.focus();
				        return;
				    }
				}
			}
		}
		jQuery.get(
			'tms_v1_sell_sell.php',
			{'op': 'GETRETURNTICKETINFO', 'IsContinuou':$("#IsContinuou").val(),'ticketnum':$("#ticketnum").val(), 'st_TicketID': $("#ticketnum1").val(),
				'tnum': $("#tnum").val(), 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');

				if(objData.signed!='票号：已签！'){
					alert(objData.signed);
				}
				if(objData.checked!='票号：已检！'){
					alert(objData.checked);
				}
				if(objData.errored!='票号：已废！'){
					alert(objData.errored);
				}
				if(objData.unsell!='票号：未售出！'){
					alert(objData.unsell);
				}
			//	alert(objData.selled);
			//	document.getElementById("ticketnum").value=objData.selled;
				if(objData.selled){
					document.getElementById("ticketnum").value=objData.selled;
				}else{
					document.getElementById("ticketnum").value='';
				}
				document.getElementById("tnum").value=objData.num;
				if(document.getElementById("tnum").value==0){
					document.getElementById("tnum").value='';
				}
				if(document.getElementById("IsContinuou").value==1){
					var str=document.getElementById("ticketnum").value.split("\r\n");
					document.getElementById("ticketnum1").value=str[0];
				}
				if(document.getElementById("ticketnum").value!=''){
					document.form1.submit();
				}
		});
	}
	function openShutManager(oSourceObj,oTargetObj,shutAble,oOpenTip,oShutTip)
	{
		var sourceObj = typeof oSourceObj == "string" ? document.getElementById(oSourceObj) : oSourceObj;
		var targetObj = typeof oTargetObj == "string" ? document.getElementById(oTargetObj) : oTargetObj;
		var openTip = oOpenTip || "";
		var shutTip = oShutTip || "";
		if(targetObj.style.display != "none") {
			if(shutAble) return;
			targetObj.style.display = "none";
			if(openTip  &&  shutTip){
				sourceObj.innerHTML = shutTip;
			}
		} else {
			targetObj.style.display="block";
			if(openTip && shutTip){
				sourceObj.innerHTML = openTip;
			}
		}
	}


	
	$(document).ready(function(){
		if(document.getElementById("ticketnum").value!=""){
			document.getElementById("confirmAlter").disabled=false;
		}
		else{
			document.getElementById("confirmAlter").disabled=true;
		}
	});

	$(document).ready(function(){
		$("#ticketnum").keyup(function(){
			document.getElementById("confirmAlter").disabled=true;
		});
	});
	$(document).ready(function(){
		$("#ticketnum1").keyup(function(){
			document.getElementById("confirmAlter").disabled=true;
		});
		$("#tnum").keyup(function(){
			document.getElementById("confirmAlter").disabled=true;
		});
	});

	function isnumber(number,id){
		if(isNaN(number)){
			alert(number+"不是数字！");
			document.getElementById(id).value='';
			return false;
		}
		if(document.getElementById(id).value!=""){
			if(parseInt(number)!=number){
				alert("请输入整数")
				document.getElementById(id).value=""
				}
			return false;
			}
	}
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">改 签 界 面</span></td>
  </tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
  	 <td nowrap="nowrap" bgcolor="#FFFFFF">
    	<input type="hidden" name="IsContinuou" id="IsContinuou" value="<?php if($IsContinuou==1 || $IsContinuou=='') echo '1'; else echo '0';?>"/>
    	<input type="checkbox" name="IsContinuous" id="IsContinuous" <?php if($IsContinuou==1 || $IsContinuou=='') echo 'checked';?> onclick="changecontinous()"/>是否连续票号
    </td>	     
  	<td nowrap="nowrap" id="Uncontinuousname" style="display:<?php if($IsContinuou==1 || $IsContinuou=='') echo 'none'; else echo '';?>" bgcolor="#FFFFFF">
  		<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 票号：</span>
  	</td>
	<td nowrap="nowrap" id="Uncontinuous" style="display:<?php if($IsContinuou==1 || $IsContinuou=='') echo 'none'; else echo '';?>" bgcolor="#FFFFFF">
		<textarea name="ticketnum" id="ticketnum" cols="" rows=""><?php echo $ticketid ?></textarea>
	</td>
    <td nowrap="nowrap" id="Continuousname" bgcolor="#FFFFFF" style="display:<?php if($IsContinuou==1 || $IsContinuou=='') echo ''; else echo 'none';?>">
    	<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />开始票号：</span>
    </td>
    <td nowrap="nowrap" id="Continuous" bgcolor="#FFFFFF" style="display:<?php if($IsContinuou==1 || $IsContinuou=='') echo ''; else echo 'none';?>">
    	<input type="text" name="ticketnum1" id="ticketnum1" value="<?php echo $ticketid1;?>"/><input type="text" name="tnum" id="tnum" value="<?php echo $tnum; ?>" style="width:50px;" onkeyup="return isnumber(this.value,this.id)"/>张
    	<input type="hidden" name="NoOfRunsID" id="NoOfRunsID" />
    </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 改签日期：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="alertdate" id="alertdate" class="Wdate" value="<?php if ($alertdate!='') echo $alertdate; else print date('Y-m-d');?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 备注：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="alterremark" id="alterremark"/></td>
  </tr>
  <tr>
    <td align="center" colspan="7" bgcolor="#FFFFFF">
    	<input id="getTicketInfo" name="getTicketInfo" type="button" value="客票信息确认" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	<input id="confirmAlter" name="confirmAlter" type="button" value="改签确认" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	<input type="button" name="back" id="back" value="返回"  onclick="location.assign('tms_v1_service_querynoofruns.php')"/>
   	</td>
  </tr>
</table>
<p style="text-align:left;font-size:17;margin:0px;">客票信息</p>
<table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableboder" id="table1">
	<thead>
	<tr>
		<th nowrap="nowrap" align="center" bgcolor="#006699">票号</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">出发站</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">到达站</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">票型</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">座位号</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">张数</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">票价</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">车型</th>
	<!--
		<td width="5%" align="center">座位号</td>
		<td width="15%" align="center">操作</td> 
	-->
	</tr>
	</thead>
	<tbody>
<?
//	if (isset($_POST['ticketnum'])) {
	//	$TicketID=$_POST['ticketnum'];
	//	$alertdate=$_POST['alertdate'];
//	echo "<script>alert($TicketID)</script>";
	foreach (explode("\n",$ticketid) as $key =>$ticketIDs){
		$i=$i+1;
		if($ticketIDs!=''){
			$ticketIDs=trim($ticketIDs);
			$selectticket="SELECT st_NoOfRunsID,st_NoOfRunsdate,st_FromStation, st_ReachStation,st_BeginStationTime,st_SellPrice,st_SellPriceType,st_TotalMan,
				st_BusModel,st_SeatID,nri_Allticket FROM tms_sell_SellTicket LEFT OUTER JOIN tms_bd_NoRunsInfo ON st_NoOfRunsID=nri_NoOfRunsID WHERE st_TicketID='{$ticketIDs}'";
			$resultticket = $class_mysql_default ->my_query("$selectticket");
			if(!$resultticket) echo mysql_error();
			$rowsticket = @mysql_fetch_array($resultticket);
?>
	<tr bgcolor="#CCCCCC">
		<td align="center"><?=$ticketIDs?></td>
		<td align="center"><?=$rowsticket['st_NoOfRunsdate']?></td>
		<td align="center"><?=$rowsticket['st_BeginStationTime']?></td>
		<td align="center"><?=$rowsticket['st_FromStation']?></td>
		<td align="center"><?=$rowsticket['st_ReachStation']?></td>
		<td align="center"><?=$rowsticket['st_NoOfRunsID']?></td>
		<td align="center"><?=$rowsticket['st_SellPriceType']?></td>
		<td align="center"><?=$rowsticket['st_SeatID']?></td>
		<td align="center"><?=$rowsticket['st_TotalMan']?></td>
		<td align="center"><?=$rowsticket['st_SellPrice']?></td>
		<td align="center"><?=$rowsticket['st_BusModel']?></td>
	<!--
		<td align="center">&nbsp;</td>
		<td align="center">[<a href=""]">修改座号</a>]</td> 
	-->	
	</tr>
		<tr>
	   <td style="border:0px;">
	   <input type="hidden" name="NoOfRunsID1" id="NoOfRunsID1" value="<?php echo $rowsticket['st_NoOfRunsID']; ?>"/>
	   <input type="hidden" name="alertdate1" id="alertdate1" value="<?php echo $rowsticket['st_NoOfRunsdate']; ?>"/>
	   </td>
	   	</tr>
<? 
		}
	}
?>	
</tbody>
</table>
 
<?php //if ($rowsticket['nri_Allticket'] == "0") {?>
<!--<iframe frameborder="1" id="heads" width="100%" scrolling="auto" src="tms_v1_sell_seatview.php?nrID=<?=$rowsticket['st_NoOfRunsID']?>&nrDate=<?=$rowsticket['st_NoOfRunsdate']?>"></iframe>
--><?php //}?>

<br/>
<p style="text-align:left;font-size:17;margin:0px">改签班次信息</p>
<table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableboder" id="table2">
<thead>
  <tr>
    <th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">出发站</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">到达站</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">全票价</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">半票价</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车型</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">余座</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">余半票</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">线路</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">操作</th>
  </tr>
  </thead>
  <tbody>
<?
	$selectnoruns="SELECT tml_NoOfRunsID,pd_BeginStation,pd_EndStation,pd_FromStation,pd_ReachStation,pd_FullPrice,pd_HalfPrice,pd_BeginStationTime,tml_BusModel,tml_LeaveSeats,
		tml_LeaveHalfSeats,nri_LineName,nri_Allticket FROM tms_bd_PriceDetail LEFT OUTER JOIN tms_bd_TicketMode ON tms_bd_PriceDetail.pd_NoOfRunsID = tms_bd_TicketMode.tml_NoOfRunsID 
		AND tms_bd_PriceDetail.pd_NoOfRunsdate = tms_bd_TicketMode.tml_NoOfRunsdate LEFT OUTER JOIN tms_bd_NoRunsInfo ON tms_bd_PriceDetail.pd_NoOfRunsID=tms_bd_NoRunsInfo.nri_NoOfRunsID
		LEFT OUTER JOIN tms_sch_Report ON pd_NoOfRunsID=rt_NoOfRunsID AND pd_NoOfRunsdate=rt_NoOfRunsdate AND pd_FromStationID=rt_FromStationID AND rt_Register!='已发车'
		WHERE pd_FromStation='{$rowsticket['st_FromStation']}' AND  pd_ReachStation='{$rowsticket['st_ReachStation']}' AND pd_NoOfRunsdate = '{$alertdate}' AND tml_AllowSell = '1' 
		AND tml_LeaveSeats > 0 ORDER BY STR_TO_DATE(pd_BeginStationTime,'%H:%i') ASC";
  $resultnoruns = $class_mysql_default ->my_query("$selectnoruns");
  while($rowsnoruns = @mysql_fetch_array($resultnoruns))
  {
?>
  <tr align="center" bgcolor="#CCCCCC">
    <td nowrap="nowrap" ><?=$alertdate?></td>
    <td nowrap="nowrap" ><?=$rowsnoruns['pd_BeginStationTime']?></td>
    <td nowrap="nowrap" ><?=$rowsnoruns['pd_FromStation']?></td>
    <td nowrap="nowrap" ><?=$rowsnoruns['pd_ReachStation']?></td>
    <td nowrap="nowrap" ><?=$rowsnoruns['pd_FullPrice']?></td>
    <td nowrap="nowrap" ><?=$rowsnoruns['pd_HalfPrice']?></td>
    <td nowrap="nowrap" ><?=$rowsnoruns['tml_BusModel']?></td>
    <td nowrap="nowrap" ><?=$rowsnoruns['tml_LeaveSeats']?></td>
    <td nowrap="nowrap" ><?=$rowsnoruns['tml_LeaveHalfSeats']?></td>
    <td nowrap="nowrap" ><?=$rowsnoruns['nri_LineName']?></td>
    <td nowrap="nowrap" ><?=$rowsnoruns['tml_NoOfRunsID']?></td>
    <td nowrap="nowrap" >
    	<?
			$frameID = $rowsnoruns['tml_NoOfRunsID'];
			if ($rowsnoruns['nri_Allticket'] == "0"){
		?>
				[<a href="#" onclick="openShutManager(this,'<?=$frameID?>',false,'座位预览关闭','座位预览展开')"]">座位预览展开</a>]
		<?}?>
    </td>
  </tr>
  <tr bgcolor="#CCCCCC">
			<td colspan="13">
				<div id="<?=$frameID?>" style="display:none">
					<iframe frameborder="1" id="heads" width="100% "src="../sell/tms_v1_sell_seatview.php?nrID=<?=$rowsnoruns['tml_NoOfRunsID']?>&nrDate=<?=$alertdate?>"></iframe>
				</div>
			</td>
		</tr>
  <?
  }
  ?>
  </tbody>
</table>

<br/>
</form>
</body>
</html>
