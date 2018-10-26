<?
//销票界面
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$ticketid=$_POST['ticketnum'];
if(isset($_GET['tid']))
 {
 	 $ticketID=$_GET['tid'];
     $nowtime=date('H:i:s');
     $nowdate=date('Y-m-d');
     $errID=$userID;
     $errer=$userName;
     $errcause=$_GET['ecause'];
     
     $class_mysql_default->my_query("START TRANSACTION");
	 foreach (explode(",",$ticketID) as $key =>$ticketIDs){
	     $strsqlselet = "SELECT * FROM `tms_sell_SellTicket` WHERE `st_TicketID` = '$ticketIDs'";
	     $resultselet = $class_mysql_default ->my_query("$strsqlselet");
	 	 if(!$resultselet){
			$class_mysql_default->my_query("ROLLBACK");
		    echo "<script>alert('查询售票失败！');history.back();</script>";	
		    exit();
		 }
	     $rows = @mysqli_fetch_array($resultselet);
	     if(!empty($rows[0]))
	     {
//	         $strsqlselet = "INSERT INTO `tms_sell_ErrTicket` (`et_TicketID`, `et_NoOfRunsID`, `et_NoOfRunsdate`, `et_BeginStationTime`, 
//	         		`et_StopStationTime`, `et_SellPrice`, `et_SellPriceType`, `et_SellDate`, `et_SellTime`, `et_SeatID`, `et_FreeSeats`, 
//	         		`et_SafetyPrice`, `et_Cause`, `et_ErrTime`, `et_ErrDate`, `et_ErrUserID`, `et_ErrUser`, `et_BeginStationID`, `et_BeginStation`, 
//	         		`et_FromStationID`, `et_FromStation`, `et_ReachStationID`, `et_ReachStation`, `et_EndStationID`, `et_EndStation`, `et_StationID`, 
//	         		`et_Station`, `et_IsBalance`, `et_BalanceDateTime`) VALUES ('$ticketIDs', '$rows[1]', '$rows[3]', '$rows[4]' , '$rows[5]' , 
//	         		'$rows[15]' , '$rows[16]', '$rows[32]' , '$rows[33]' ,'$rows[36]' , NULL, NULL, '$errcause', '$nowtime', '$nowdate', '$errID', 
//	         		'$errer', '$rows[7]' , '$rows[8]' , '$rows[9]' , '$rows[10]' , '$rows[11]' , '$rows[12]', '$rows[13]' , '$rows[14]', '$rows[30]', 
//	         		'$rows[31]' ,'$rows[45]', '$rows[46]');";
//	         $resultselet = $class_mysql_default ->my_query("$strsqlselet");
//	     	 if(!$resultselet){
//		    	$class_mysql_default->my_query("ROLLBACK");
//		    	echo "<script>alert('插入销票失败！');history.back();</script>";	
//		     }
		    	echo "<script>alert('插入销票失败！');history.back();</script>";	
	     }else{
	     	$strsqlselet = "INSERT INTO `tms_sell_ErrTicket` (`et_TicketID`,`et_SellPrice`,`et_Cause`, `et_ErrTime`, `et_ErrDate`, `et_ErrUserID`, `et_ErrUser`,
	         		`et_StationID`,`et_Station`) VALUES ('$ticketIDs','0','$errcause', '$nowtime', '$nowdate', '$errID', '$errer','$userStationID','$userStationName')";
	         $resultselet = $class_mysql_default ->my_query("$strsqlselet");
	     	 if(!$resultselet){
		    	$class_mysql_default->my_query("ROLLBACK");
		    	echo "<script>alert('插入销票失败！');history.back();</script>";	
		     }	
	     }
	 }
	$class_mysql_default->my_query("COMMIT");
	echo "<script>alert('销票成功！')</script>";
	echo "<script>window.location.href ='tms_v1_sell_deleteticket.php';</script>";
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head>
	<title>销票界面</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css"/>
	<link href="../css/tms.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>		
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
		$("#table1 tr").mouseover(function(){$(this).css("background-color","#f1e6c2");});
		$("#table1 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
		$("#table1 tr").click(function(){
			$("#table1 tr:not(this)").css("background-color","#CCCCCC");
			$("#table1 tr:not(this)").mouseover(function(){$(this).css("background-color","#f1e6c2");});
			$("#table1 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$(this).css("background-color","#FFCC00");
			$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
			$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
		});
		$("#confirmError").click(function(){
			if (document.getElementById("IsContinuou").value=='1'){
				if (document.form1.ticketnum1.value == "") {
					alert("请输入客票号！");
					document.form1.ticketnum1.focus();
				}else {
					if(document.form1.tnum.value=="" || document.form1.tnum.value=='0'){
						document.form1.tnum.value=1;
					}
					verifyticket();
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
					        alert("重复票号：" + nticketID[i] +"将被删除");
					        document.getElementById("ticketnum").value=document.getElementById("ticketnum").value.replace(nticketID[i+1]+"\r\n",'');
					        document.form1.ticketnum.focus();
					        return;
					    }
					}
					verifyticket();
				}
			}
		});
	});
	function verifyticket(){
		jQuery.get(
			'tms_v1_sell_sell.php',
			{'op': 'GETDELETETICKETINFO', 'IsContinuou':$("#IsContinuou").val(),'ticketnum':$("#ticketnum").val(), 'st_TicketID': $("#ticketnum1").val(),
				'tnum': $("#tnum").val(), 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if(objData.signed != '票号：已签！'){
					alert(objData.signed);
				}
				else if(objData.checked != '票号：已检！'){
					alert(objData.checked);
				}
				else if(objData.unexist != '客票号：不存在或已售出！'){
					alert(objData.unexist);
				}
				else {
					document.getElementById("ticketnum").value = objData.selled;
					if(document.getElementById("ticketnum").value != ''){
						if (document.form1.errorcause.value == "") {
							alert("请输入销票原因！");
							document.form1.ticketnum.focus();
							return;
						}
						var ticketID = document.getElementById("ticketnum").value;
						var errorcause = document.getElementById("errorcause").value;
						var ticketID=ticketID.split("\r\n");
						var url = 'tms_v1_sell_deleteticket.php?'+'tid='+ticketID+'&ecause='+errorcause;
					    window.location.href = url;
					}
				}
		});
	}
//	$(document).ready(function(){
//		$("#confirmError").click(function(){
//			if (document.form1.ticketnum.value == "") {
//				alert("请输入客票号！");
//				document.form1.ticketnum.focus();
//				return;
//			}
//			if (document.form1.errorcause.value == "") {
//				alert("请输入销票原因！");
//				document.form1.ticketnum.focus();
//				return;
//			}
//			var ticketID = document.getElementById("ticketnum").value;
//			var errorcause = document.getElementById("errorcause").value;
//			var ticketID=ticketID.split("\r\n");
//			var url = 'tms_v1_sell_deleteticket.php?'+'tid='+ticketID+'&ecause='+errorcause;
//		    window.location.href = url;
//		});
//	});
//	$(document).ready(function(){
//		$("#table1").tablesorter();
//	});
	function AddOther(url) {                  
		window.open(url,'','width=450,height=400');
	}
	function isnumber(number,id){
		if(isNaN(number)){
			alert(number+"不是数字！");
			document.getElementById(id).value='';
			return false;
		}
		if(parseInt(number)!=number){
			alert("请输入整数")
			document.getElementById(id).value=""
			return false;
			}
	}
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">销 票 界 面</span></td>
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
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 销票原因：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">
    	<input type="text" name="errorcause" id="errorcause"/><input  type="button" name="button1" value="..." style="background-color:#CCCCCC" onClick="AddOther('tms_v1_sell_errorresult.php')">
    </td>
  </tr>
  <tr>
    <td align="center" colspan="5" bgcolor="#FFFFFF">
<!--    	<input id="getTicketInfo" name="getTicketInfo" type="button" value="客票信息确认" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
    	<input id="confirmError" name="confirmError" type="button" value="销票确认" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	<input type="button" name="back" id="back" value="返回"  onclick="location.assign('tms_v1_sell_query.php')"/>
    </td>
  </tr>
</table>
<!--<div id="tableContainer" class="tableContainer" style="height:495px"> 
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
<?
		$ticketid1=$_POST['ticketnum'];
  		$i=0;
		foreach (explode("\n",$ticketid1) as $key =>$ticketIDs){
			$i=$i+1;
			if($ticketIDs!=''){
				$ticketIDs=trim($ticketIDs);
				$strsqlselet="SELECT * FROM `tms_sell_SellTicket` WHERE `st_TicketID`='$ticketIDs'";
					$resultselet = $class_mysql_default ->my_query("$strsqlselet");
			}
 				    while($rows = @mysqli_fetch_array($resultselet))
  {
?>
  <tr align="center" bgcolor="#CCCCCC" id="table1">
    <td><?=$rows['st_TicketID']?></td>
    <td><?=$rows['st_NoOfRunsID']?></td>
    <td><?=$rows['st_NoOfRunsdate']?></td>
    <td><?=$rows['st_BeginStationTime']?></td>
    <td><?=$rows['st_FromStation']?></td>
    <td><?=$rows['st_ReachStation']?></td>
    <td><?=$rows['st_SellPrice']?></td>
    <td><?=$rows['st_SellPriceType']?></td>
    <td><?=$rows['st_SellDate']?></td>
    <td><?=$rows['st_SellTime']?></td>
    <td><?=$rows['st_SeatID']?></td>
  </tr>
  <?
  }
		}
  ?>
   
</tbody> 
</table> 
</div> 
--></form>
</body> 
</html>
