<?
//废票界面
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

//$viewenable = "";
//$subcancelenable = "disabled";
if(isset($_POST['ticketnum'])){
//	$viewenable = "disabled";
//	$subcancelenable = "";
	$ticketid=$_POST['ticketnum'];
	$tnum=$_POST['tnum'];
	$ticketnum1=$_POST['ticketnum1'];
	$IsContinuou=$_POST['IsContinuou'];
	$errorcause=$_POST['errorcause'];
	$IsInsureContinuou=$_POST['IsInsureContinuou'];
	$insureticketnum=$_POST['insureticketnum'];
	$snum=$_POST['snum'];
	$insureticketnum1=$_POST['insureticketnum1'];
}

if(isset($_GET['tid']))
 {
 	 $ticketID=$_GET['tid'];
     $nowtime=date('H:i:s');
     $nowdate=date('Y-m-d');
     $errID=$userID;
     $errer=$userName;
     $errcause=$_GET['ecause'];
     $safeticketID=$_GET['iid'];
     $class_mysql_default->my_query("START TRANSACTION");
     if($ticketID){
		 foreach (explode(",",$ticketID) as $key =>$ticketIDs){
		     $strsqlselet = "SELECT * FROM `tms_sell_SellTicket` WHERE `st_TicketID` = '$ticketIDs'";
		     $resultselet = $class_mysql_default ->my_query("$strsqlselet");
		 	 if(!$resultselet){
				$class_mysql_default->my_query("ROLLBACK");
			    echo "<script>alert('查询售票失败！');history.back();</script>";	
			    exit();
			 }
		     $rows = @mysql_fetch_array($resultselet);
		     if(!empty($rows[0]))
		     {
		         $strsqlselet = "INSERT INTO `tms_sell_ErrTicket` (`et_TicketID`, `et_NoOfRunsID`, `et_NoOfRunsdate`, `et_BeginStationTime`, 
		         		`et_StopStationTime`, `et_SellPrice`, `et_SellPriceType`, `et_SellDate`, `et_SellTime`, `et_SeatID`, `et_FreeSeats`, 
		         		`et_SafetyPrice`, `et_Cause`, `et_ErrTime`, `et_ErrDate`, `et_ErrUserID`, `et_ErrUser`, `et_BeginStationID`, `et_BeginStation`, 
		         		`et_FromStationID`, `et_FromStation`, `et_ReachStationID`, `et_ReachStation`, `et_EndStationID`, `et_EndStation`, `et_StationID`, 
		         		`et_Station`, `et_IsBalance`, `et_BalanceDateTime`) VALUES ('$ticketIDs', '$rows[1]', '$rows[3]', '$rows[4]' , '$rows[5]' , 
		         		'$rows[15]' , '$rows[16]', '$rows[32]' , '$rows[33]' ,'$rows[36]' , NULL, NULL, '$errcause', '$nowtime', '$nowdate', '$errID', 
		         		'$errer', '$rows[7]' , '$rows[8]' , '$rows[9]' , '$rows[10]' , '$rows[11]' , '$rows[12]', '$rows[13]' , '$rows[14]', '$rows[30]', 
		         		'$rows[31]' ,'$rows[45]', '$rows[46]');";
		         $resultselet = $class_mysql_default ->my_query("$strsqlselet");
		     	 if(!$resultselet){
			    	$class_mysql_default->my_query("ROLLBACK");
			    	echo mysql_error();
			    	echo "<script>alert('插入废票失败！');history.back();</script>";	
			     }
		     }else{
	//	     	$strsqlselet = "INSERT INTO `tms_sell_ErrTicket` (`et_TicketID`,`et_SellPrice`,`et_Cause`, `et_ErrTime`, `et_ErrDate`, `et_ErrUserID`, `et_ErrUser`,
	//	         		`et_StationID`,`et_Station`) VALUES ('$ticketIDs','0','$errcause', '$nowtime', '$nowdate', '$errID', '$errer','$userStationID','$userStationName')";
	//	         $resultselet = $class_mysql_default ->my_query("$strsqlselet");
	//	     	 if(!$resultselet){
	//		    	$class_mysql_default->my_query("ROLLBACK");
	//		    	echo "<script>alert('插入废票失败！');history.back();</script>";	
	//		     }	
					$class_mysql_default->my_query("ROLLBACK");
			    	echo "<script>alert('插入废票失败！');history.back();</script>";	
		     }
		 }
  }
  if($safeticketID){
	  foreach (explode(",",$safeticketID) as $key =>$safeticketIDs){
		     $strsqlselet = "SELECT itt_SyncCode,itt_InsureTicketNo,itt_TicketNo,itt_CreatedType,itt_IdCard,itt_Name,itt_Beneficiary,itt_Price,
		     	itt_AinsuranceValue,itt_BinsuranceValue,itt_CinsuranceValue,itt_DinsuranceValue FROM `tms_sell_InsureTicket` WHERE 
		     	`itt_InsureTicketNo` = '$safeticketIDs'";
		     $resultselet = $class_mysql_default ->my_query("$strsqlselet");
		 	 if(!$resultselet){
				$class_mysql_default->my_query("ROLLBACK");
			    echo "<script>alert('查询保险票失败！');history.back();</script>";	
			    exit();
			 }
		     $rows = @mysql_fetch_array($resultselet);
		     if(!empty($rows[0]))
		     {
		         $strsqlselet = "INSERT INTO `tms_sell_ErrInsureTicket` (`eitt_SyncCode`, `eitt_InsureTicketNo`, `eitt_TicketNo`, `eitt_CreatedType`, 
		         		`eitt_IdCard`, `eitt_Name`, `eitt_Beneficiary`, `eitt_Price`,`eitt_AinsuranceValue`, `eitt_BinsuranceValue`, `eitt_CinsuranceValue`,
		         		 `eitt_DinsuranceValue`,`eitt_Cause`,`eitt_ErrTime`,`eitt_ErrDate`,`eitt_ErrUserID`,`eitt_ErrUser`,`eitt_StationName`) VALUES ('{$rows['itt_SyncCode']}',
		         		  '{$rows['itt_InsureTicketNo']}', '{$rows['itt_TicketNo']}', '{$rows['itt_CreatedType']}' , '{$rows['itt_IdCard']}' , 
		         		'{$rows['itt_Name']}' , '{$rows['itt_Beneficiary']}', '{$rows['itt_Price']}' , '{$rows['itt_AinsuranceValue']}' ,'{$rows['itt_BinsuranceValue']}', 
		         		'{$rows['itt_CinsuranceValue']}','{$rows['itt_DinsuranceValue']}','$errcause', '$nowtime', '$nowdate', '$errID', '$errer','$userStationName');";
		         $resultselet = $class_mysql_default ->my_query("$strsqlselet");
		     	 if(!$resultselet){
		     	 	echo mysql_error();
			    	$class_mysql_default->my_query("ROLLBACK");
			    	echo "<script>alert('插入废保险票失败！');history.back();</script>";	
			     }
		     }else{	
		     		$class_mysql_default->my_query("ROLLBACK");
			    	echo "<script>alert('插入废保险票失败！');history.back();</script>";	
		     }
		 }
  }
	$class_mysql_default->my_query("COMMIT");
	echo "<script>alert('废票成功！')</script>";
	echo "<script>window.location.href ='tms_v1_sell_error.php';</script>";
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head>
	<title>废票界面</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css"/>
	<link href="../css/tms.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../js/jquery.js"></script>		
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
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
	function changeinsurecontinous(){
		if(document.getElementById("IsInsureContinuous").checked){
			document.getElementById("IsInsureContinuou").value='1';
			document.getElementById("ContinuousInsurename").style.display='';
			document.getElementById("ContinuousInsure").style.display='';
			document.getElementById("UncontinuousInsurename").style.display='none';
			document.getElementById("UncontinuousInsure").style.display='none';
		}else{
			document.getElementById("IsInsureContinuou").value='0';
			document.getElementById("ContinuousInsurename").style.display='none';
			document.getElementById("ContinuousInsure").style.display='none';
			document.getElementById("UncontinuousInsurename").style.display='';
			document.getElementById("UncontinuousInsure").style.display='';
		}
	}
	$(document).ready(function(){
		$("#table1").tablesorter();
	});
	$(document).ready(function(){
//		$("#table1 tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
//		$("#table1 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
//		$("#table1 tr").click(function(){
//			$("#table1 tr:not(this)").css("background-color","#CCCCCC");
//			$("#table1 tr:not(this)").mouseover(function(){$(this).css("background-color","#F1E6C2");});
//			$("#table1 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
//			$(this).css("background-color","#FFCC00");
//			$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
//			$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
//		});
		$("#getTicketInfo").click(function(){
			getticketinfor();
		});
	});

	$(document).ready(function(){
		$("#confirmError").click(function(){
			if (document.form1.ticketnum.value == "" && document.form1.insureticketnum.value == "") {
				alert("请输入客票号或保险！");
			//	document.form1.ticketnum.focus();
				return;
			}
			if (document.form1.errorcause.value == "") {
				alert("请输入废票原因！");
				document.form1.ticketnum.focus();
				return;
			}
			var ticketID = document.getElementById("ticketnum").value;
			var insureticketID = document.getElementById("insureticketnum").value;
			var errorcause = document.getElementById("errorcause").value;
			var ticketID=ticketID.split("\r\n");
			var insureticketID=insureticketID.split("\r\n");
	//		alert(ticketID);
	//		alert(insureticketID);
			var url = 'tms_v1_sell_error.php?'+'tid='+ticketID+'&iid='+insureticketID+'&ecause='+errorcause;
			window.location.href = url;
		});
	});
	function AddOther(url) {                  
		window.open(url,'','width=500,height=400');
	}
	function getticketinfor(){
		var strticket='';
		var strinsure='';
		if (document.getElementById("ticketnum").value=='' && document.getElementById("ticketnum1").value=='' && 
				document.getElementById("insureticketnum").value=='' && document.getElementById("insureticketnum1").value==''){
			alert("请输入客票号或保险票号！");
			return false;	
		}else{
			if(document.getElementById("ticketnum1").value!='' && (document.getElementById("tnum").value=="" || document.getElementById("tnum").value=='0')){
				document.getElementById("tnum").value=1;
			}
			if(document.getElementById("insureticketnum1").value!='' && (document.getElementById("snum").value=="" || document.getElementById("snum").value=='0')){
				document.getElementById("snum").value=1;
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
			if(document.getElementById("IsInsureContinuou").value==1 && document.getElementById("insureticketnum1").value!=''){
				for(var i=0; i<document.getElementById("snum").value;i++){
		            var newstr='';
					var newvalue=document.getElementById("insureticketnum1").value*1+i;
					for(var j=0;j<document.getElementById("insureticketnum1").value.length-String(newvalue).lenght;j++){
						 newstr=newstr+'0';
					}
					newstr=newstr+String(newvalue);
					strinsure=strinsure+newstr+'\r\n';
				}
				document.getElementById("insureticketnum").value=strinsure;
				//alert(document.getElementById("insureticketnum").value);
			}
			var ticketID=document.form1.ticketnum.value.split("\r\n");
			var safeticketID=document.form1.insureticketnum.value.split("\r\n");
			var nticketID = ticketID.sort();
			var nsafeticketID=safeticketID.sort();
			for(var i = 0; i < nticketID.length - 1; i++){
			    if (nticketID[i] == nticketID[i+1]){
			        alert("重复票号：" + nticketID[i] + "将被删除");
			        document.getElementById("ticketnum").value=document.getElementById("ticketnum").value.replace(nticketID[i+1]+"\r\n",'');
			   //    document.form1.ticketnum.focus();
			        return;
			    }
			}
			for(var i = 0; i < nsafeticketID.length - 1; i++){
			    if (nsafeticketID[i] == nsafeticketID[i+1]){
			        alert("重复保险票号：" + nsafeticketID[i] + "将被删除");
			        document.getElementById("insureticketnum").value=document.getElementById("insureticketnum").value.replace(nsafeticketID[i+1]+"\r\n",'');
			   //   document.form1.safeticketnum.focus();
			        return;
			    }
			} 
			jQuery.get(
				'tms_v1_sell_sell.php',
				{'op': 'GETERRORTICKETINFO', 'ticketnum': $("#ticketnum").val(),'safeticketnum':$("#insureticketnum").val(),'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if(objData.signed != '票号：已签！'){
						alert(objData.signed);
					}
					else if(objData.checked != '票号：已检！'){
						alert(objData.checked);
					}
					if(objData.errored!='票号：已废！'){
						alert(objData.errored);
					}
					else if(objData.unexist != '客票号：不存在或未售出！'){
						alert(objData.unexist);
					}
					if(objData.unselledsafe!='保险票号：未售出！'){
						alert(objData.unselledsafe);
					}
					if(objData.erroredsafe!='保险票号：已废！'){
						alert(objData.erroredsafe);
					}
					document.getElementById("ticketnum").value=objData.selled;
					if(document.getElementById("IsContinuou").value==1){
						if(document.getElementById("ticketnum1").value){
							var str=document.getElementById("ticketnum").value.split("\r\n");
							document.getElementById("ticketnum1").value=str[0];
							if(document.getElementById("ticketnum").value==''){
								document.getElementById("tnum").value='';
							}else{
								document.getElementById("tnum").value=str.length;
							}
						}
					}
					document.getElementById("insureticketnum").value=objData.selledsafe;
					if(document.getElementById("IsInsureContinuou").value==1){
						if(document.getElementById("insureticketnum1").value){
							var str=document.getElementById("insureticketnum").value.split("\r\n");
							document.getElementById("insureticketnum1").value=str[0];
							if(document.getElementById("insureticketnum").value==''){
								document.getElementById("snum").value='';
							}else{
								document.getElementById("snum").value=str.length;
							}
						}
					}
					if(document.getElementById("ticketnum").value!='' || document.getElementById("insureticketnum").value!=''){
						document.form1.submit();
					}
			});  
		}  
	} 
	$(document).ready(function(){
		$("#ticketnum").keyup(function(){
			document.getElementById("confirmError").disabled=true;
		});
	});
	$(document).ready(function(){
		$("#ticketnum1").keyup(function(){
			document.getElementById("confirmError").disabled=true;
		});
		$("#tnum").keyup(function(){
			document.getElementById("confirmError").disabled=true;
		});
		$("#insureticketnum1").keyup(function(){
			document.getElementById("confirmError").disabled=true;
		});
		$("#snum").keyup(function(){
			document.getElementById("confirmError").disabled=true;
		});
		$("#insureticketnum").keyup(function(){
			document.getElementById("confirmError").disabled=true;
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
    <span class="graytext" style="margin-left:8px;">废 票 界 面</span></td>
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
    	<input type="text" name="ticketnum1" id="ticketnum1" value="<?php echo $ticketnum1;?>"/><input type="text" name="tnum" id="tnum" style="width:50px;" value="<?php if($ticketnum1) echo $tnum;?>" onkeyup="return isnumber(this.value,this.id)"/>张
    </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">
    	<input type="hidden" name="IsInsureContinuou" id="IsInsureContinuou" value="<?php if($IsInsureContinuou==1 || $IsInsureContinuou=='') echo '1'; else echo '0';?>"/>
    	<input type="checkbox" name="IsInsureContinuous" id="IsInsureContinuous" <?php if($IsInsureContinuou==1 || $IsInsureContinuou=='') echo 'checked';?> onclick="changeinsurecontinous()"/>是否连续保险票号
    </td>	     
  	<td nowrap="nowrap" id="UncontinuousInsurename" style="display:<?php if($IsInsureContinuou==1 || $IsInsureContinuou=='') echo 'none'; else echo '';?>" bgcolor="#FFFFFF">
  		<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保险票号：</span>
  	</td>
	<td nowrap="nowrap" id="UncontinuousInsure" style="display:<?php if($IsInsureContinuou==1 || $IsInsureContinuou=='') echo 'none'; else echo '';?>" bgcolor="#FFFFFF">
		<textarea name="insureticketnum" id="insureticketnum" cols="" rows=""><?php echo $insureticketnum ?></textarea>
	</td>
    <td nowrap="nowrap" id="ContinuousInsurename" bgcolor="#FFFFFF" style="display:<?php if($IsInsureContinuou==1 || $IsInsureContinuou=='') echo ''; else echo 'none';?>">
    	<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />开始保险票号：</span>
    </td>
    <td nowrap="nowrap" id="ContinuousInsure" bgcolor="#FFFFFF" style="display:<?php if($IsInsureContinuou==1 || $IsInsureContinuou=='') echo ''; else echo 'none';?>">
    	<input type="text" name="insureticketnum1" id="insureticketnum1" value="<?php echo $insureticketnum1;?>"/><input type="text" name="snum" id="snum" style="width:50px;" value="<?php if($insureticketnum1) echo $snum;?>" onkeyup="return isnumber(this.value,this.id)"/>张
    </td>
  </tr>
  <tr>  
    <td colspan="6"  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 废票原因：</span>
    	<input type="text" size="50" name="errorcause" id="errorcause" value="<?php echo $errorcause;?>"/>
    	<input  type="button" name="button1" value="..." style="background-color:#CCCCCC" onClick="AddOther('tms_v1_sell_errorresult.php')">
    </td>
  </tr>
  <tr>
    <td align="center" colspan="6" bgcolor="#FFFFFF">
    	<input id="getTicketInfo" name="getTicketInfo" type="button" value="客票/保险票信息确认" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	<input id="confirmError" name="confirmError" type="button" value="废票确认"  />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	<input type="button" name="back" id="back" value="返回"  onclick="location.assign('tms_v1_sell_query.php')"/>
    </td>
  </tr>
</table>
  <?php
	if(isset($_POST['ticketnum1'])){ 
		if($ticketid){
	?>
			<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder">
				<tr>
					<td colspan="11" bgcolor="#FFFFFF" style="font-size:11pt;font-family:黑体;"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 客票信息：</td>
				</tr>
			</table>
			<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder">
			  <tr>
			   	<th nowrap="nowrap" align="center" bgcolor="#006699">票号</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
			    <th nowrap="nowrap"" align="center" bgcolor="#006699">上车站</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">到达站</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">票价</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">票型</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">座位号</th>
			  </tr>
	<?php 
			foreach (explode("\n",$ticketid) as $key =>$ticketIDs){
				if($ticketIDs!=''){
					$ticketIDs=trim($ticketIDs);
					$strsqlselet="SELECT `st_TicketID`, `st_NoOfRunsID`, `st_LineID`, `st_NoOfRunsdate`, 
						`st_BeginStationTime`, `st_StopStationTime`, `st_Distance`, `st_BeginStationID`, `st_BeginStation`, `st_FromStationID`, 
						`st_FromStation`, `st_ReachStationID`, `st_ReachStation`, `st_EndStationID`, `st_EndStation`, `st_SellPrice`, `st_SellPriceType`, 
						`st_ColleSellPriceType`, `st_TotalMan`, `st_FullPrice`, `st_HalfPrice`, `st_StandardPrice`, `st_BalancePrice`, `st_ServiceFee`, 
						`st_otherFee1`, `st_otherFee2`, `st_otherFee3`, `st_otherFee4`, `st_otherFee5`, `st_otherFee6`, `st_StationID`, `st_Station`, 
						`st_SellDate`, `st_SellTime`, `st_BusModelID`, `st_BusModel`, `st_SeatID`, `st_SellID`, `st_SellName`, `st_FreeSeats`, 
						`st_SafetyTicketID`, `st_SafetyTicketNumber`, `st_SafetyTicketMoney`, `st_SafetyTicketPassengerID`, `st_TicketState`, `st_IsBalance`, 
						`st_BalanceDateTime`, `st_AlterTicket` FROM `tms_sell_SellTicket` WHERE `st_TicketID`='$ticketIDs'";
					$resultselet = $class_mysql_default ->my_query("$strsqlselet");
					$rows = @mysql_fetch_array($resultselet);
	?>
			<tr>
				<td nowrap="nowrap" align="center"><?php echo $rows['st_TicketID'];?></td>
		        <td nowrap="nowrap" align="center"><?php echo $rows['st_NoOfRunsID'];?></td>
		        <td nowrap="nowrap" align="center"><?php echo $rows['st_NoOfRunsdate'];?></td>
		        <td nowrap="nowrap" align="center"><?php echo $rows['st_BeginStationTime'];?></td>
		        <td nowrap="nowrap" align="center"><?php echo $rows['st_FromStation'];?></td>
		        <td nowrap="nowrap" align="center"><?php echo $rows['st_ReachStation'];?></td>
		        <td nowrap="nowrap" align="center"><?php echo $rows['st_SellPrice'];?></td>
		        <td nowrap="nowrap" align="center"><?php echo $rows['st_SellPriceType'];?></td>
		        <td nowrap="nowrap" align="center"><?php echo $rows['st_SeatID'];?></td>
		   </tr>
    <?php
				}
			}
	?>
		</table>
	<?php 
		}
		if($insureticketnum){
	?>
			<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder">
				<tr>
					<td colspan="11" bgcolor="#FFFFFF" style="font-size:11pt;font-family:黑体;"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 保险票信息：</td>
				</tr>
			</table>
			<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder">
			  <tr>
			   	<th nowrap="nowrap" align="center" bgcolor="#006699">保险票号</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">同步编码</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">保险费</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">投保人</th>
			    <th nowrap="nowrap"" align="center" bgcolor="#006699">投保人身份证号</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
			    <th nowrap="nowrap" align="center" bgcolor="#006699">客票票号</th>
			  </tr>
	<?php 
			foreach (explode("\n",$insureticketnum) as $key =>$safeticketID){
				$j=$j+1;
				if($safeticketID!=''){
					$safeticketID=trim($safeticketID);
					$strsqlselet="SELECT `itt_SyncCode`, `itt_InsureTicketNo`, `itt_Name`, `itt_IdCard`, `itt_TicketNo`,
						`itt_Beneficiary`, `itt_AinsuranceValue`, `itt_BinsuranceValue`, `itt_Price`, `itt_SaleTime`, `itt_AgentCode`, 
						`itt_HandlerCode`, `st_NoOfRunsID`, `st_NoOfRunsdate`, `st_BeginStationTime` FROM `tms_sell_InsureTicket` LEFT OUTER JOIN 
						tms_sell_SellTicket ON st_TicketID=itt_TicketNo WHERE `itt_InsureTicketNo`='$safeticketID'";
					$resultselet = $class_mysql_default ->my_query("$strsqlselet");
					$rows1 = @mysql_fetch_array($resultselet);
	?>
	<tr>
		<td nowrap="nowrap" align="center"><?php echo $rows1['itt_InsureTicketNo'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $rows1['itt_SyncCode'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $rows1['itt_Price'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $rows1['itt_Name'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $rows1['itt_IdCard'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $rows1['st_NoOfRunsID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $rows1['st_NoOfRunsdate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $rows1['st_BeginStationTime'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $rows1['itt_TicketNo'];?></td>
   </tr>
    <?php
				}
			}
	?>
		</table>
	<?php 
		}
	}
    ?>
</form>
</body> 
</html>