<?
//rtk_IsBalance：0-已签票；1-已结算；2-已退票；
//退票界面
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$signuserID=$userID;
$signuser=$userName;
$ticketid=$_POST['ticketnum'];
$sellprice = $_POST['sellprice'];
$returnmoney= $_POST['returnmoney'];
$ticketnum1=$_POST['ticketnum1'];
$tnum=$_POST['tnum'];
$IsContinuou=$_POST['IsContinuou'];
$sxprice = $_POST['sxprice'];
$returntype1=$_POST['returntype'];
$returntickettype1=$_POST['returntickettype'];
if(isset($_GET['tid']))
{
	$ticketID=$_GET['tid'];
	$str=$_GET['rtt'];
	$returntype = explode(",", $str);
	$returnrate=$_GET['rtr'];
	$returnSXprice=$_GET['sxp'];
	$returnmoney=$_GET['rm'];
	$nowtime=date('H:i');
	$nowdate=date('Y-m-d');
	
	$class_mysql_default->my_query("BEGIN");
	foreach (explode(",",$ticketID) as $key =>$ticketIDs){
	//	echo "<script>alert($ticketIDs)</script>";
		$strsqlselet = "SELECT * FROM `tms_sell_SellTicket` WHERE `st_TicketID` = '$ticketIDs'";
		$resultselet = $class_mysql_default->my_query("$strsqlselet");
		if(!$resultselet){
			$class_mysql_default->my_query("ROLLBACK");
		    echo "<script>alert('查询售票失败！');history.back();</script>";	
		    exit();
		}
		$rows = @mysqli_fetch_array($resultselet);
//		$returnSXprice=$rows['st_SellPrice']-$rows['st_SellPrice']*$returnrate;
//		$returnmoney=$rows['st_SellPrice']*$returnrate;
		$returnmoney=$rows['st_SellPrice']-$rows['st_SellPrice']*$returnrate;
		$returnSXprice=$rows['st_SellPrice']*$returnrate;
		if(!empty($rows[0]))
		{
			//写到退票的地方？答：是写到退票的地方
//			$selectmodel1="SELECT tml_SeatStatus, tml_LeaveSeats,tml_LeaveHalfSeats FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '{$rows['st_NoOfRunsID']}') AND 
//	         	(tml_NoOfRunsdate ='{$rows['st_NoOfRunsdate']}') FOR UPDATE";
//	     	$resultmodel1 = $class_mysql_default->my_query("$selectmodel1");
//	     	if(!$resultmodel1) {
//				$class_mysql_default->my_query("ROLLBACK");
//				echo "<script>alert('锁定票版1数据失败！');history.back();</script>";
//				exit();
//			}
//	     	$rowsmodel1 = @mysqli_fetch_array($resultmodel1);
//	     	$seatStatus1 = $rowsmodel1['tml_SeatStatus'];
//	     	$seatStatus1 = substr_replace($seatStatus1, '0', $rows['st_SeatID']-1, 1);
//	     	if ($rows['st_SellPriceType']=='半票'){
//	     		$rowsmodel1['tml_LeaveHalfSeats']=$rowsmodel1['tml_LeaveHalfSeats']+1;
//	     	}
//	     	$rowsmodel1['tml_LeaveSeats']=$rowsmodel1['tml_LeaveSeats']+1;
//	     	$updatemodel1="UPDATE tms_bd_TicketMode SET tml_SeatStatus='{$seatStatus1}',tml_LeaveSeats='{$rowsmodel1['tml_LeaveSeats']}',tml_LeaveHalfSeats='{$rowsmodel1['tml_LeaveHalfSeats']}' 
//	     		WHERE (tml_NoOfRunsID = '{$rows['st_NoOfRunsID']}') AND (tml_NoOfRunsdate ='{$rows['st_NoOfRunsdate']}')";
//	     	$querymodel1= $class_mysql_default->my_query("$updatemodel1");
//	     	if(!$querymodel1) {
//				$class_mysql_default->my_query("ROLLBACK");
//				echo "<script>alert('更新票版1数据失败！');history.back();</script>";
//				exit();
//	     	}
			$strsqlselet = "INSERT INTO `tms_sell_ReturnTicket` (`rtk_TicketID` ,`rtk_ReturnTicketID` ,`rtk_ReturnType` ,`rtk_ReturnPrice` ,
		    	`rtk_SignTime` ,`rtk_SignDate` ,`rtk_SignUserID` ,`rtk_SignUser` ,`rtk_ReturnRate` ,`rtk_SXPrice` ,
		    	`rtk_NoOfRunsID` ,`rtk_NoOfRunsdate` ,`rtk_BeginStationTime` ,`rtk_StopStationTime` ,`rtk_SellPrice` ,`rtk_SellPriceType` ,
		    	`rtk_SellDate` ,`rtk_SellTime` ,`rtk_SeatID` ,`rtk_FreeSeats` ,`rtk_SafetyTicketNumber` ,`rtk_BeginStationID` ,
		    	`rtk_BeginStation` ,`rtk_FromStationID` ,`rtk_FromStation` ,`rtk_ReachStationID` ,`rtk_ReachStation` ,`rtk_EndStationID` ,
		    	`rtk_EndStation` ,`rtk_StationID` ,`rtk_Station` ,`rtk_IsBalance`) VALUES ('$ticketIDs', 
		    	'$ticketIDs', '$returntype[1]','$returnmoney','$nowtime' , '$nowdate', '$signuserID' , '$signuser' , '$returnrate' , 
		    	'$returnSXprice', '$rows[1]' ,'$rows[3]' , '$rows[4]' , '$rows[5]' , '$rows[15]' , '$rows[16]', '$rows[32]' , '$rows[33]' ,
		    	'$rows[36]' , NULL ,'$rows[40]', '$rows[7]' , '$rows[8]' , '$rows[9]' , '$rows[10]' , '$rows[11]' , '$rows[12]', '$rows[13]', 
		    	'$rows[14]', '$rows[30]', '$rows[31]' ,'0')";
		    $resultselet = $class_mysql_default->my_query("$strsqlselet");
		    if(!$resultselet){
		    	$class_mysql_default->my_query("ROLLBACK");
		    	echo "<script>alert('签票失败！');history.back();</script>";	
		    }
		}
	}
	$class_mysql_default->my_query("COMMIT");
	echo "<script>alert('签票成功！')</script>";
	echo "<script>window.location.href ='tms_v1_sell_sign.php';</script>";
/*	$strsqlselet = "SELECT * FROM `tms_sell_SellTicket` WHERE `st_TicketID` = '$ticketID'";
	$resultselet = $class_mysql_default->my_query("$strsqlselet");
	$rows = @mysqli_fetch_array($resultselet);
	if(!empty($rows[0]))
	{
		$strsqlselet = "INSERT INTO `tms_sell_ReturnTicket` (`rtk_TicketID` ,`rtk_ReturnTicketID` ,`rtk_ReturnType` ,`rtk_ReturnPrice` ,
	    	`rtk_SignTime` ,`rtk_SignDate` ,`rtk_SignUserID` ,`rtk_SignUser` ,`rtk_ReturnRate` ,`rtk_SXPrice` ,
	    	`rtk_NoOfRunsID` ,`rtk_NoOfRunsdate` ,`rtk_BeginStationTime` ,`rtk_StopStationTime` ,`rtk_SellPrice` ,`rtk_SellPriceType` ,
	    	`rtk_SellDate` ,`rtk_SellTime` ,`rtk_SeatID` ,`rtk_FreeSeats` ,`rtk_SafetyTicketNumber` ,`rtk_BeginStationID` ,
	    	`rtk_BeginStation` ,`rtk_FromStationID` ,`rtk_FromStation` ,`rtk_ReachStationID` ,`rtk_ReachStation` ,`rtk_EndStationID` ,
	    	`rtk_EndStation` ,`rtk_StationID` ,`rtk_Station` ,`rtk_IsBalance`) VALUES ('$ticketID', 
	    	'$ticketID', '$returntype[1]','$returnmoney','$nowtime' , '$nowdate', '$signuserID' , '$signuser' , '$returnrate' , 
	    	'$returnSXprice', '$rows[1]' ,'$rows[3]' , '$rows[4]' , '$rows[5]' , '$rows[15]' , '$rows[16]', '$rows[32]' , '$rows[33]' ,
	    	'$rows[36]' , NULL ,'$rows[40]', '$rows[7]' , '$rows[8]' , '$rows[9]' , '$rows[10]' , '$rows[11]' , '$rows[12]', '$rows[13]', 
	    	'$rows[14]', '$rows[30]', '$rows[31]' ,'0')";
	    $resultselet = $class_mysql_default->my_query("$strsqlselet");
		if($resultselet ){
        	echo "<script>alert('签票成功！')</script>";
        }else{
       		echo "<script>alert('签票失败！');history.back();</script>";
        }
	} */
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>签票界面</title>
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
	function getreturnrate(str){
	    var st=str.split(',');
	    document.getElementById("returnticketrate").value=st[0];
	    document.getElementById("returnticketrateI").value=st[0];
	    document.getElementById("returntype").value=st[1];
	    document.getElementById("returnConfirm").disabled=true;
	}
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
		var str=document.getElementById("returntickettype").value;
		var  st=str.split(',');
	    document.getElementById("returnticketrate").value=st[0];
	    document.getElementById("returnticketrateI").value=st[0];
	    document.getElementById("returntype").value=st[1];
		
	/*	$("#getTicketInfo").click(function(){
			if (document.form1.ticketnum.value == "") {
				alert("请输入客票号！");
				document.form1.ticketnum.focus();
			}
			else {
				jQuery.get(
					'tms_v1_sell_sell.php',
					{'op': 'GETRETURNTICKETINFO', 'st_TicketID': $("#ticketnum").val(), 'time': Math.random()},
					function(data){
						//alert(data);
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL"){ 
							alert(objData.retString);
							$("#ticketnum").val("");
						}
						else{
							$("#ticketnum").val(objData.st_TicketID);
							$("#sellprice").val(objData.st_SellPrice);
							document.getElementById("sxprice").value=document.getElementById("sellprice").value*1-document.getElementById("sellprice").value*document.getElementById("returnticketrate").value;
							document.getElementById("returnmoney").value=document.getElementById("sellprice").value*document.getElementById("returnticketrate").value;
							//	$("#sxprice").val()=$("#sellprice").val()-$("#sellprice").val()*$("#returnticketrate").val();
						//	$("#returnmoney").val()=$("#sellprice").val()*$("#returnticketrate").val();
							document.form1.submit();
						}
				});
			}
		}); */
		$("#getTicketInfo").click(function(){
			getticketinfor();
		});
		$("#returnConfirm").click(function(){
			if (document.form1.ticketnum.value == "") {
				alert("请确认客票信息！");
				document.form1.ticketnum.focus();
				return;
			}
			if (document.form1.returntickettype.value == "") {
				alert("请选择退票类型！");
				document.form1.returntickettype.focus();
				return;
			}
		/*	if (document.form1.sellprice.value == "") {
				alert("票价为空！请确认客票信息。");
				document.form1.sellprice.focus();
				return;
			} */
			if (document.form1.sxprice.value == "") {
				if (!confirm('手续费为空！是否继续？')) {
					document.form1.sxprice.focus();
					return;
				}
			}
	//    var ticketprice = document.getElementById("sellprice").value;
		    var returnrate = document.getElementById("returnticketrate").value;
		    var sxfee = document.getElementById("sxprice").value;
		    var returnmoney=document.getElementById("returnmoney").value;
		    var returntype = document.getElementById("returntickettype").value;
		    var ticketID = document.getElementById("ticketnum").value;
		    var ticketID=ticketID.split("\r\n");
//		    var ticketprice=ticketprice.split("\r\n");
		    var url = 'tms_v1_sell_sign.php?'+'tid='+ticketID+'&rtt='+returntype+'&rtr='+returnrate+'&sxp='+sxfee+'&rm='+returnmoney;
		    window.location.href = url;
		//  var returnmoney = ticketprice * returnrate - sxfee;
	/*	    if(returnmoney >= 0)
		    {
				document.getElementById("returnmoney").value = returnmoney;
			    alert("退还票款后点击确定！");
			    var returntype = document.getElementById("returntickettype").value;
			    var ticketID = document.getElementById("ticketnum").value;
			    var url = 'tms_v1_sell_sign.php?'+'tid='+ticketID+'&rtt='+returntype+'&rtr='+returnrate+'&sxp='+sxfee+'&rm='+returnmoney;
			    window.location.href = url;
		    }
		    else
		    {
		     	alert("收取退票款错误！");
		    } */
		});
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
				        alert("重复票号：" + nticketID[i] +"已被删除");
				        document.getElementById("ticketnum").value=document.getElementById("ticketnum").value.replace(nticketID[i+1]+"\r\n",'');
				     //   document.form1.ticketnum.focus();
				        return;
				    }
				}
			}
		}  
		jQuery.get(
				'tms_v1_sell_sell.php',
				{'op': 'GETRETURNTICKETINFO','IsContinuou':$("#IsContinuou").val(),'ticketnum':$("#ticketnum").val(), 'st_TicketID': $("#ticketnum1").val(),
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
					if(objData.selled){
						document.getElementById("ticketnum").value=objData.selled;
					}else{
						document.getElementById("ticketnum").value='';
					}
					document.getElementById("tnum").value=objData.num;
					if(document.getElementById("tnum").value==0){
						document.getElementById("tnum").value='';
					}
			//		document.getElementById("sellprice").value=objData.price;
//					document.getElementById("sxprice").value=(objData.allprice-objData.allprice*$("#returnticketrate").val()).toFixed(1);
//					document.getElementById("returnmoney").value=objData.allprice*$("#returnticketrate").val();
					document.getElementById("returnmoney").value=(objData.allprice-objData.allprice*$("#returnticketrate").val()).toFixed(2);
					document.getElementById("sxprice").value=(objData.allprice*$("#returnticketrate").val()).toFixed(2);
					if(document.getElementById("IsContinuou").value==1){
						var str=document.getElementById("ticketnum").value.split("\r\n");
						document.getElementById("ticketnum1").value=str[0];
					}
					if(document.getElementById("ticketnum").value!=''){
						document.form1.submit();
					}
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
	$(document).ready(function(){
		$("#ticketnum").keyup(function(){
			document.getElementById("returnConfirm").disabled=true;
		});
		$("#ticketnum1").keyup(function(){
			document.getElementById("returnConfirm").disabled=true;
		});
		$("#tnum").keyup(function(){
			document.getElementById("returnConfirm").disabled=true;
		});
	});
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">签 票 界 面</span></td>
  </tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
  	<td nowrap="nowrap" bgcolor="#FFFFFF" colspan="2"><input style="border:0px;" type="hidden" name="IsContinuou" id="IsContinuou" value="<?php if($IsContinuou==1 || $IsContinuou=='') echo '1'; else echo '0';?>"/>
    <input type="checkbox" name="IsContinuous" id="IsContinuous" <?php if($IsContinuou==1 || $IsContinuou=='') echo 'checked';?> onclick="changecontinous()"/>是否连续票号</td>	     
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 退票类型：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">
    	<select name="returntickettype" id="returntickettype" onchange="getreturnrate(this.value)">
	<?php
		if($returntickettype1){
			$str=explode(",",$returntickettype1);
	?>
		<option value="<?php echo $returntickettype1;?>"><?php echo $str[1];?></option>
	<?php 		
		}
		$now=date('Y-m-d');
        $strsqlselet = "SELECT `rte_ReturnType`,`rte_ReturnRate` FROM `tms_sell_ReturnType` WHERE rte_ReturnTimeBegin<='{$now}' AND rte_ReturnTimeEnd>='{$now}'";
        $resultselet = $class_mysql_default->my_query("$strsqlselet");
        while($rows = @mysqli_fetch_array($resultselet)){
        	if( $rows['rte_ReturnRate'].','.$rows['rte_ReturnType']!=$returntickettype1){
   // 	$statArray = array(0 => array(	"rte_ReturnType" => "发车前48-2小时","rte_ReturnRate" => 0.5), 
   // 					1 => array(	"rte_ReturnType" => "发车前2-0小时","rte_ReturnRate" => 0.25),
   // 					2 => array(	"rte_ReturnType" => "发车后2小时以内","rte_ReturnRate" => 0.1),
   // 					3 => array(	"rte_ReturnType" => "发车2小时以后","rte_ReturnRate" => 0));
	//	foreach($statArray as $rows) {
	?>
			<option value="<?php echo $rows['rte_ReturnRate'].','.$rows['rte_ReturnType'];?>"><?php echo $rows['rte_ReturnType'];?></option>
	<?php 
        	}
		}
	?>
    	</select>
    	<input type="hidden" name="returntype" id="returntype" value="<?php echo $returntype1;?>"/>
    </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 退票手续费率：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">
    	<input type="hidden" name="returnticketrate" id="returnticketrate"/>
        <input type="text" name="returnticketrateI" id="returnticketrateI" disabled="disabled"/>
    </td>
  </tr>
  <tr>
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
    	<input type="text" name="ticketnum1" id="ticketnum1" value="<?php echo $ticketnum1;?>"/><input type="text" name="tnum" id="tnum" style="width:50px;" value="<?php if($ticketnum1) echo $tnum;?>" onkeyup="return isnumber(this.value,this.id)"/>张
    </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 手续费：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="sxprice" id="sxprice" value="<?php echo $sxprice ?>" />元</td>
 <!--  
    <td width="10%" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 票价：</span></td>
    <td width="10%" bgcolor="#FFFFFF"><textarea name="sellprice" id="sellprice" cols="" rows=""><?php echo $sellprice ?></textarea>元</td>
 -->
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 退还金额：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="returnmoney" id="returnmoney" value="<?php echo $returnmoney ?>" />元</td>
  </tr>
  <tr>
    <td nowrap="nowrap" align="center" colspan="6" bgcolor="#FFFFFF">
    	<input id="getTicketInfo" name="getTicketInfo" type="button" value="客票信息确认" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	<input id="returnConfirm" name="returnConfirm" type="button" value="签票确认" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	<input type="button" name="back" id="back" value="返回"  onclick="location.assign('tms_v1_service_querynoofruns.php')"/>
    </td>
  </tr>
</table>
<!--<div> 
<table class="main_tableboder"> 
<thead>
<tr>
	<th nowrap="nowrap" align="center" bgcolor="#006699">票号</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">退还金额</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">退票类型</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">退票手续费率</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">手续费</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">签票日期</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">签票时间</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">签票员ID</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">签票员</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">签票车站</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">始发站</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">上车站</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">到达站</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">终点站</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">售价</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">票型</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">座位号</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">售票日期</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">售票时间</th>
</tr>
  </thead> 
<tbody> 
<?
 // $strsqlselet = "SELECT * FROM `tms_sell_ReturnTicket` WHERE rtk_SignUserID LIKE '{$signuserID}' AND rtk_IsBalance='0'";
 // $resultselet = $class_mysql_default->my_query("$strsqlselet");
 // while($rows = @mysqli_fetch_array($resultselet))
 // {
?>
	  <tr bgcolor="#CCCCCC">
		<td nowrap="nowrap"><?php echo $rows['rtk_TicketID'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_ReturnPrice'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_ReturnType'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_ReturnRate'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_SXPrice'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_SignDate'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_SignTime'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_SignUserID'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_SignUser'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_Station'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_NoOfRunsID'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_NoOfRunsdate'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_BeginStationTime'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_BeginStation'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_FromStation'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_ReachStation'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_EndStation'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_SellPrice'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_SellPriceType'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_SeatID'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_SellDate'];?></td>
		<td nowrap="nowrap"><?php echo $rows['rtk_SellTime'];?></td>
	  </tr>
<?
 // }
?>
</tbody>
</table>
</div>
--><div id="tableContainer" class="tableContainer" > 
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
    <th nowrap="nowrap" align="center" bgcolor="#006699">售票日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">售票时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">座位号</th>
  </tr>
  </thead> 
<tbody class="scrollContent"> 
<?php
		//if($_POST[]){
  		$i=0;
		foreach (explode("\n",$ticketid) as $key =>$ticketIDs){
			$i=$i+1;
			if($ticketIDs!=''){
				$ticketIDs=trim($ticketIDs);
				$strsqlselet="SELECT st_TicketID,st_NoOfRunsID,st_NoOfRunsdate,st_BeginStationTime,st_FromStation,st_ReachStation,st_SellPrice,
				 	st_SellPriceType,st_SellDate,st_SellTime,st_SeatID FROM `tms_sell_SellTicket` WHERE `st_TicketID`='$ticketIDs'";
				//echo $strsqlselet;
				$resultselet = $class_mysql_default->my_query("$strsqlselet");
			}
 			while($rows = @mysqli_fetch_array($resultselet)){
?>
  <tr align="center" bgcolor="#CCCCCC" id="table1">
    <td><?php echo $rows['st_TicketID']?></td>
    <td><?php echo $rows['st_NoOfRunsID']?></td>
    <td><?php echo $rows['st_NoOfRunsdate']?></td>
    <td><?php echo $rows['st_BeginStationTime']?></td>
    <td><?php echo $rows['st_FromStation']?></td>
    <td><?php echo $rows['st_ReachStation']?></td>
    <td><?php echo $rows['st_SellPrice']?></td>
    <td><?php echo $rows['st_SellPriceType']?></td>
    <td><?php echo $rows['st_SellDate']?></td>
    <td><?php echo $rows['st_SellTime']?></td>
    <td><?php echo $rows['st_SeatID']?></td>
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
