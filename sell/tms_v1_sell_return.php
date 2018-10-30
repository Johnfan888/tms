<?php
//退票界面
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$returnerID=$userID;
$returner=$userName;
$ticketid=$_POST['ticketnum'];
$tnum=$_POST['tnum'];
$ticketnum1=$_POST['ticketnum1'];
$IsContinuou=$_POST['IsContinuou'];
$returnmoney=$_POST['returnmoney'];
if(isset($_GET['tid']))
{
	$ticketID=$_GET['tid'];
//	$str=$_GET['rtt'];
//	$returntype = explode(",", $str);
//	$returnrate=$_GET['rtr'];
//	$returnSXprice=$_GET['sxp'];
//	$returnmoney=$_GET['rm'];
	$nowtime=date('H:i');
	$nowdate=date('Y-m-d');
	
	$class_mysql_default->my_query("BEGIN");
	foreach (explode(",",$ticketID) as $key => $ticketIDs){
	//	echo "<script>alert($ticketIDs)</script>";
		$strsqlselet = "SELECT st_NoOfRunsID, st_NoOfRunsdate, st_SellPrice, st_SellPriceType, st_SeatID, st_TicketState FROM `tms_sell_SellTicket` 
			WHERE `st_TicketID` = '$ticketIDs'";
		$resultselet = $class_mysql_default->my_query("$strsqlselet");
		if(!$resultselet){
			$class_mysql_default->my_query("ROLLBACK");
		    echo "<script>alert('查询售票失败！');history.back();</script>";	
		    exit();
		}
		$rows = mysqli_fetch_array($resultselet);
		$returnSXprice=$rows['st_SellPrice']-$rows['st_SellPrice']*$returnrate;
		$returnmoney=$rows['st_SellPrice']*$returnrate;
		if(!empty($rows[0]))
		{
			//写到退票的地方？
			$selectmodel1="SELECT tml_SeatStatus, tml_LeaveSeats,tml_LeaveHalfSeats FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '{$rows['st_NoOfRunsID']}') AND 
	         	(tml_NoOfRunsdate ='{$rows['st_NoOfRunsdate']}') FOR UPDATE";
	     	$resultmodel1 = $class_mysql_default->my_query("$selectmodel1");
	     	if(!$resultmodel1) {
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('锁定票版数据失败！');history.back();</script>";
				exit();
			}
	     	$rowsmodel1 = mysqli_fetch_array($resultmodel1);
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
				echo "<script>alert('更新票版数据失败！');history.back();</script>";
				exit();
	     	}
	     	//处理并班
	     	if($rows['st_TicketState']=='9'){
	     		$selectandrun="SELECT anr_AndNoOfRunsID, anr_AndNoOfRunsdate,anr_AndSeatID,anr_Seats,anr_HalfSeats FROM tms_sch_AndNoOfRuns WHERE anr_NoOfRunsID='{$rows['st_NoOfRunsID']}' AND 
	     			anr_NoOfRunsdate='{$rows['st_NoOfRunsdate']}'";
	     		$queryandrun=$class_mysql_default->my_query("$selectandrun");
	     		if(!$queryandrun){
	     			$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('查询并班数据失败！');history.back();</script>";
					exit();
	     		}
	     		$rowandrun=mysqli_fetch_array($queryandrun);
	     		$selectmodel2="SELECT tml_SeatStatus, tml_LeaveSeats,tml_LeaveHalfSeats FROM tms_bd_TicketMode WHERE tml_NoOfRunsID='{$rowandrun['anr_AndNoOfRunsID']}' AND 
	     			tml_NoOfRunsdate='{$rowandrun['anr_AndNoOfRunsdate']}' FOR UPDATE";
		     	$resultmodel2 = $class_mysql_default->my_query("$selectmodel2");
		     	if(!$resultmodel2) {
					$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('锁定票版数据失败2！');history.back();</script>";
					exit();
				}
				$rowsmodel2 = mysqli_fetch_array($resultmodel2);
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
			$strsqlselet="UPDATE tms_sell_ReturnTicket SET rtk_ReturnTime='{$nowtime}',rtk_ReturnDate='{$nowdate}', rtk_ReturnUserID='{$returnerID}',
	    		rtk_ReturnUser='{$returner}',rtk_IsBalance='2' WHERE rtk_TicketID='{$ticketIDs}'";
	   		$resultselet = $class_mysql_default->my_query("$strsqlselet");
			if(!$resultselet ){
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('退票失败！');history.back();</script>";
        	}
		}
	}
	
/*	$class_mysql_default->my_query("START TRANSACTION");
	foreach (explode(",",$ticketID) as $key =>$ticketIDs){
	//$strsqlselet = "SELECT * FROM `tms_sell_SellTicket` WHERE `st_TicketID` = '$ticketID'";
	//$resultselet = $class_mysql_default->my_query("$strsqlselet");
	//$rows = @mysqli_fetch_array($resultselet);
	//if(!empty($rows[0]))
	//{
	//	$strsqlselet = "INSERT INTO `tms_sell_ReturnTicket` (`rtk_TicketID` ,`rtk_ReturnTicketID` ,`rtk_ReturnType` ,`rtk_ReturnPrice` ,
	//    	`rtk_ReturnTime` ,`rtk_ReturnDate` ,`rtk_ReturnUserID` ,`rtk_ReturnUser` ,`rtk_ReturnRate` ,`rtk_SXPrice` ,
	//    	`rtk_NoOfRunsID` ,`rtk_NoOfRunsdate` ,`rtk_BeginStationTime` ,`rtk_StopStationTime` ,`rtk_SellPrice` ,`rtk_SellPriceType` ,
	//    	`rtk_SellDate` ,`rtk_SellTime` ,`rtk_SeatID` ,`rtk_FreeSeats` ,`rtk_SafetyTicketNumber` ,`rtk_BeginStationID` ,
	//    	`rtk_BeginStation` ,`rtk_FromStationID` ,`rtk_FromStation` ,`rtk_ReachStationID` ,`rtk_ReachStation` ,`rtk_EndStationID` ,
	//    	`rtk_EndStation` ,`rtk_StationID` ,`rtk_Station` ,`rtk_IsBalance` ,`rtk_BalanceDateTime` ) VALUES ('$ticketID', 
	//    	'$ticketID', '$returntype[1]','$returnmoney','$nowtime' , '$nowdate', '$returnerID' , '$returner' , '$returnrate' , 
	//    	$returnSXprice, '$rows[1]' ,'$rows[3]' , '$rows[4]' , '$rows[5]' , '$rows[15]' , '$rows[16]', '$rows[32]' , '$rows[33]' ,
	//    	'$rows[36]' , NULL ,'$rows[40]', '$rows[7]' , '$rows[8]' , '$rows[9]' , '$rows[10]' , '$rows[11]' , '$rows[12]', '$rows[13]', 
	//    	'$rows[14]', '$rows[30]', '$rows[31]' ,'$rows[45]', '$rows[46]')";
	//    $resultselet = $class_mysql_default->my_query("$strsqlselet");
	    $strsqlselet="UPDATE tms_sell_ReturnTicket SET rtk_ReturnTime='{$nowtime}',rtk_ReturnDate='{$nowdate}', rtk_ReturnUserID='{$returnerID}',
	    	rtk_ReturnUser='{$returner}',rtk_IsBalance='2' WHERE rtk_TicketID='{$ticketIDs}'";
	    $resultselet = $class_mysql_default->my_query("$strsqlselet");
		if(!$resultselet ){
			$class_mysql_default->my_query("ROLLBACK");
			echo "<script>alert('退票失败！');history.back();</script>";
        }
	} */
	$class_mysql_default->my_query("COMMIT");
	echo "<script>alert('退票成功！')</script>";
	echo "<script>window.location.href ='tms_v1_sell_return.php';</script>";
//	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>退票界面</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<link href="../css/tms.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>		
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script>
	$(document).ready(function(){
		if(document.getElementById("ticketnum").value!=""){
			document.getElementById("returnConfirm").disabled=false;
		}
		else{
			document.getElementById("returnConfirm").disabled=true;
		}
	});
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
		$("#table1 tr").mouseover(function(){$(this).css("background-color","#FFCC00");});
		$("#table1 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
		$("#table1 tr").click(function(){
			$("#table1 tr:not(this)").css("background-color","#CCCCCC");
			$("#table1 tr:not(this)").mouseover(function(){$(this).css("background-color","#FFCC00");});
			$("#table1 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$(this).css("background-color","#FFCC00");
			$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
			$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
		});
		$("#getTicketInfo").click(function(){
			getticketinfor();
		});
	});
	$(document).ready(function(){
		$("#returnConfirm").click(function(){
			if (document.form1.ticketnum1.value == "") {
				alert("请确认客票信息！");
				document.form1.ticketnum.focus();
				return;
			}
	/*		if (document.form1.returntickettype.value == "") {
				alert("请选择退票类型！");
				document.form1.returntickettype.focus();
				return;
			}
			if (document.form1.sellprice.value == "") {
				alert("票价为空！请确认客票信息。");
				document.form1.sellprice.focus();
				return;
			}
			if (document.form1.sxprice.value == "") {
				if (!confirm('手续费为空！是否继续？')) {
					document.form1.sxprice.focus();
					return;
				}
			} */
			var ticketID = document.getElementById("ticketnum").value;
			//alert(ticketID);
			var ticketID=ticketID.split("\r\n");
			var url = 'tms_v1_sell_return.php?'+'tid='+ticketID;
			window.location.href = url;
		//    var ticketprice = document.getElementById("sellprice").value;
		//    var returnrate = document.getElementById("returnticketrateI").value;
	/*	    var sxfee = document.getElementById("sxprice").value;
		    var returnmoney = ticketprice * returnrate - sxfee;
		    if(returnmoney >= 0)
		    {
				document.getElementById("returnmoney").value = returnmoney;
			    alert("退还票款后点击确定！");
			    var returntype = document.getElementById("returntickettype").value;
			    var ticketID = document.getElementById("ticketnum").value;
			    var url = 'tms_v1_sell_return.php?'+'tid='+ticketID+'&rtt='+returntype+'&rtr='+returnrate+'&sxp='+sxfee+'&rm='+returnmoney;
			    window.location.href = url;
		    }
		    else
		    {
		     	alert("收取退票款错误！");
		    } */
		});
		document.onkeydown = function (event) {
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 27) {	//ESC
        		document.location.href = "tms_v1_sell_query.php";
        	}
        };
	});
	function getticketinfor(){
		var strticket='';
		if (document.getElementById("IsContinuou").value=='1'){
			if (document.form1.ticketnum1.value == "") {
				alert("请输入客票号！");
			//	document.form1.ticketnum1.focus();
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
				     //   document.form1.ticketnum.focus();
				        return;
				    }
				}
			}
		}  
		jQuery.get(
			'tms_v1_sell_sell.php',
			{'op': 'GETRETURNTICKETINFO1','IsContinuou':$("#IsContinuou").val(),'ticketnum':$("#ticketnum").val(), 'st_TicketID': $("#ticketnum1").val(),
				'tnum': $("#tnum").val(), 'time': Math.random()},
			function(data){
				//alert(data);
				var objData = eval('(' + data + ')');
				if(objData.unsell!='票号：未售出！'){
					alert(objData.unsell);
				}
				if(objData.checked!='票号：已检！'){
					alert(objData.checked);
				}
				if(objData.errored!='票号：已废！'){
					alert(objData.errored);
				}
				if(objData.unsign!='票号：未签！'){
					alert(objData.unsign);
				}
				if(objData.returned!='票号：已退！'){
					alert(objData.returned);
				}
			//	document.getElementById("ticketnum").value=objData.returnticket;
				document.getElementById("returnmoney").value=objData.returnprice;
				if(objData.returnticket){
					document.getElementById("ticketnum").value=objData.returnticket;
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
				
		/*		if(objData.retVal == "FAIL"){ 
					alert(objData.retString);
					$("#ticketnum").val("");
				}
				else{
					$("#ticketnum").val(objData.TicketID);
					$("#sellprice").val(objData.SellPrice);
					$("#returntickettype").val(objData.ReturnType);
					$("#sxprice").val(objData.SXPrice);
					$("#returnticketrate").val(objData.ReturnRate);
					$("#returnmoney").val(objData.ReturnPrice);
					$("#SignDate").val(objData.SignDate);
					$("#SignTime").val(objData.SignTime);
					$("#SignUser").val(objData.SignUser);
				//	document.form1.submit();
				} */
		});
	}

	$(document).ready(function(){
		$("#ticketnum").keyup(function(){
			document.getElementById("returnConfirm").disabled=true;
		});
	});
	$(document).ready(function(){
		$("#ticketnum1").keyup(function(){
			document.getElementById("returnConfirm").disabled=true;
		});
		$("#tnum").keyup(function(){
			document.getElementById("returnConfirm").disabled=true;
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
    <span class="graytext" style="margin-left:8px;">退 票 界 面</span></td>
  </tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
  <!--  
    <td width="10%" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 票号：</span></td>
    <td width="10%" bgcolor="#FFFFFF"><textarea name="ticketnum" id="ticketnum" cols="" rows=""></textarea></td>
   -->
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
    	<input type="text" name="ticketnum1" id="ticketnum1" value="<?php echo $ticketnum1;?>"/><input type="text" name="tnum" id="tnum" value="<?php if($ticketnum1) echo $tnum;?>" style="width:50px;"onkeyup="return isnumber(this.value,this.id)"/>张
    </td>
    <td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 退还金额：</span></td>
    <td bgcolor="#FFFFFF"><input  type="text" name="returnmoney" id="returnmoney" readonly="readonly" value="<?php echo $returnmoney;?>"/>元</td>
  </tr>
  <tr>
    <td align="center" colspan="6" bgcolor="#FFFFFF">
    	<input id="getTicketInfo" name="getTicketInfo" type="button" value="客票信息确认" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	<input id="returnConfirm" name="returnConfirm" type="button" value="退票确认" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   	<input type="button" name="back" id="back" value="返回"  onclick="location.assign('tms_v1_sell_query.php')"/>
    </td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
  <tr>
    <th nowrap="nowrap" align="center" bgcolor="#006699">票号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">上车站</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">到达站</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">票价</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">票型</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">退票类型</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">退票手续费率</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">退票手续费</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">退还金额</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">售票日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">售票时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">座位号</th>
  </tr>
  	  </thead> 
<tbody class="scrollContent"> 
<?php
  	$i=0;
	foreach (explode("\n",$ticketid) as $key =>$ticketIDs){
		$i=$i+1;
		if($ticketIDs!=''){
			$ticketIDs=trim($ticketIDs);
			$strsqlselet="SELECT rtk_TicketID,rtk_NoOfRunsID,rtk_NoOfRunsdate,rtk_BeginStationTime,rtk_FromStation,rtk_ReachStation,rtk_SellPrice,
				rtk_SellPriceType,rtk_SellDate,rtk_SellTime,rtk_SeatID,rtk_ReturnType,rtk_ReturnPrice,rtk_ReturnRate,rtk_SXPrice FROM `tms_sell_ReturnTicket` 
				WHERE `rtk_TicketID`='$ticketIDs'";
			//echo $strsqlselet;
			$resultselet = $class_mysql_default->my_query("$strsqlselet");
		}
 		while($rows = @mysqli_fetch_array($resultselet)){
?>
  <tr align="center" bgcolor="#CCCCCC" id="table1">
    <td><?php echo $rows['rtk_TicketID']?></td>
    <td><?php echo $rows['rtk_NoOfRunsID']?></td>
    <td><?php echo $rows['rtk_NoOfRunsdate']?></td>
    <td><?php echo $rows['rtk_BeginStationTime']?></td>
    <td><?php echo $rows['rtk_FromStation']?></td>
    <td><?php echo $rows['rtk_ReachStation']?></td>
    <td><?php echo $rows['rtk_SellPrice']?></td>
    <td><?php echo $rows['rtk_SellPriceType']?></td>
    <td><?php echo $rows['rtk_ReturnType']?></td>
    <td><?php echo $rows['rtk_ReturnRate']?></td>
    <td><?php echo $rows['rtk_SXPrice']?></td>
    <td><?php echo $rows['rtk_ReturnPrice']?></td>
    <td><?php echo $rows['rtk_SellDate']?></td>
    <td><?php echo $rows['rtk_SellTime']?></td>
    <td><?php echo $rows['rtk_SeatID']?></td>
  </tr>
  <?php
  		}
	}
  ?>
   
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>