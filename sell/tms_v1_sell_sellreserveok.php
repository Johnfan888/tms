<?
//留票界面

define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
//echo $userName;
//echo $userID;
//echo $userStationID;
//echo $userStationName;
if(isset($_POST['AllPrice'])) {
 	$ReserveSellID=$_POST['ReserveSellID'];
	$NoofrunsID=$_POST['NoofrunsID'];
	$NoOfRunsdate=$_POST['NoOfRunsdate'];
	$FromstationID=$_POST['FromstationID'];
	$Fromstation=$_POST['Fromstation'];
	$ReachstationID=$_POST['ReachstationID'];
	$Reachstation=$_POST['Reachstation'];
	$FullNumber=$_POST['FullNumber'];
	$HalfNumber=$_POST['HalfNumber'];
	$AllPrice=$_POST['AllPrice'];
//	$Phone=$_POST['Phone'];
	$IDCard=$_POST['IDCard'];
	$ReserveName=$_POST['ReserveName'];
	
	$seats=$FullNumber+$HalfNumber;
	$seatno='';
	
	$selectprice="SELECT * FROM tms_bd_PriceDetail WHERE pd_NoOfRunsID='{$NoofrunsID}' AND pd_NoOfRunsdate='{$NoOfRunsdate}' AND 
		pd_FromStation='{$Fromstation}' AND pd_ReachStation='{$Reachstation}'";
	$resultprice=$class_mysql_default->my_query("$selectprice");
	$rowsprice= @mysqli_fetch_array($resultprice);
	
	//还需要锁表或锁记录
	$class_mysql_default->my_query("BEGIN");

	$queryString="SELECT tml_SeatStatus,tml_LeaveSeats,tml_BusModelID,tml_BusModel,tml_LeaveHalfSeats FROM tms_bd_TicketMode WHERE tml_NoOfRunsID='{$NoofrunsID}'
		AND tml_NoOfRunsdate='{$NoOfRunsdate}' FOR UPDATE ";
	$resultquery = $class_mysql_default->my_query("$queryString");
	if(!$resultquery) {
		$class_mysql_default->my_query("ROLLBACK");
		echo "<script>alert('锁定票版失败！ 请返回。');location.assign('tms_v1_sell_sellreserve.php');</script>";	
	}
	
	$rows = mysqli_fetch_array($resultquery);
	$rows[1]=$rows[1]-$seats;
	$rows[4]=$rows[4]-$HalfNumber;

	//更新座位状态和取得座位号
	for($i=0; $i<$seats; $i++){
		$array[$i]=strpos($rows[0],'0');
		$rows[0]=substr_replace($rows[0], '2',$array[$i],1);
		if ($i==0){
			$seatno=$seatno.($array[$i]+1);
		}else{
			$seatno=$seatno.','.($array[$i]+1);
		}
	} 
	$update="UPDATE tms_bd_TicketMode SET tml_LeaveSeats='{$rows[1]}',tml_SeatStatus='{$rows[0]}',tml_LeaveHalfSeats='{$rows[4]}' WHERE 
		tml_NoOfRunsID='{$NoofrunsID}' AND tml_NoOfRunsdate='{$NoOfRunsdate}'";
	$queryupdate = $class_mysql_default->my_query("$update");
	if(!$queryupdate) {
		$class_mysql_default->my_query("ROLLBACK");
		echo "<script>alert('更新票版失败！ 请返回。');location.assign('tms_v1_sell_sellreserve.php');</script>";	
	}
	
	$insert="INSERT INTO tms_websell_WebSellTicket (wst_WebSellID,wst_UserName,wst_CertificateType,wst_CertificateNumber,wst_NoOfRunsID,
		wst_LineID,wst_NoOfRunsdate,wst_BeginStationTime,wst_StopStationTime,wst_Distance,wst_BeginStationID,wst_BeginStation,wst_FromStationID,
		wst_FromStation,wst_ReachStationID,wst_ReachStation,wst_EndStationID,wst_EndStation,wst_SellPrice,wst_FullNumber,wst_HalfNumber,
		wst_TotalMan,wst_FullPrice,wst_HalfPrice,wst_StandardPrice,wst_BalancePrice,wst_ServiceFee,wst_otherFee1,wst_otherFee2,wst_otherFee3,
		wst_otherFee4,wst_otherFee5,wst_otherFee6,wst_SellDate,wst_SellTime,wst_BusModelID,wst_BusModel,wst_SeatID,wst_TicketState,wst_StationID,wst_Station,wst_ReserveID,wst_ReserveName)
		VALUES ('{$ReserveSellID}','{$ReserveName}','{$CertificateType}','{$IDCard}','{$NoofrunsID}','{$rowsprice[1]}','{$NoOfRunsdate}',
		'{$rowsprice[3]}','{$rowsprice[4]}','{$rowsprice[5]}','{$rowsprice[6]}','{$rowsprice[7]}','{$rowsprice[8]}','{$rowsprice[9]}',
		'{$rowsprice[10]}','{$rowsprice[11]}','{$rowsprice[12]}','{$rowsprice[13]}','{$AllPrice}','{$FullNumber}','{$HalfNumber}','{$seats}',
		'{$rowsprice[14]}','{$rowsprice[15]}','{$rowsprice[16]}','{$rowsprice[17]}','{$rowsprice[18]}','{$rowsprice[19]}','{$rowsprice[20]}',
		'{$rowsprice[21]}','{$rowsprice[22]}','{$rowsprice[23]}','{$rowsprice[24]}',CURDATE(), CURTIME(),'{$rows[2]}','{$rows[3]}',
		'{$seatno}','3','$userStationID','$userStationName','$userID','$userName')";	//电话预订
	$queryinsert = $class_mysql_default->my_query("$insert"); 
	if(!$queryinsert) {
		$class_mysql_default->my_query("ROLLBACK");
		echo "<script>alert('插入留票表失败！ 请返回。');location.assign('tms_v1_sell_sellreserve.php');</script>";	
	}

	$class_mysql_default->my_query("COMMIT");
	echo "<script>alert('留票成功！');location.assign('tms_v1_sell_sellreserve.php');</script>";	
}
else { 
	$NoofrunsID=$_GET['NoofrunsID'];
	$Selldate=$_GET['Selldate'];
	$FromStation=$_GET['FromStation'];
	$ReachStation=$_GET['ReachStation'];
	$Select="SELECT pd_FromStationID,pd_ReachStationID,pd_BeginStationTime,pd_StopStationTime,pd_FullPrice,pd_HalfPrice,tml_LeaveSeats,tml_LeaveHalfSeats FROM 
		tms_bd_PriceDetail, tms_bd_TicketMode WHERE pd_NoOfRunsID=tml_NoOfRunsID AND pd_NoOfRunsdate=tml_NoOfRunsdate AND
		pd_NoOfRunsID='{$NoofrunsID}' AND pd_NoOfRunsdate='{$Selldate}' AND pd_FromStation='{$FromStation}' AND pd_ReachStation='{$ReachStation}'";
	$resultselect = $class_mysql_default->my_query("$Select"); 
	$rows = mysqli_fetch_array($resultselect);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>留票确认</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript">
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
		function checkcertificatenumber(certificatenumber){
			var str=certificatenumber;
			var Expression=/^(\d{18,18}|\d{15,15}|\d{17,17}[xX])$/;
			if(Expression.test(str)==true){
				return true;
			}else {
				return false;
			}
		}
		function computerprice(){
			var pp1=parseInt(document.getElementById("FullNumber").value);
			var pp2=parseInt(document.getElementById("HalfNumber").value);
			document.getElementById("AllPrice").value=pp1*parseFloat(document.getElementById("FullPrice").value)+pp2*parseFloat(document.getElementById("HalfPrice").value);
		}
		
		$(document).ready(function(){
			document.getElementById("FullNumber").value=0;
			document.getElementById("HalfNumber").value=0;
			$("#ReserveName").focus();
			$("#ReserveName").keydown(function(event) {
				var e = event || window.event || arguments.callee.caller.arguments[0];
		        if (e && e.keyCode == 13) {	//enter key
					if($("#ReserveName").val() == "") {
						alert("姓名不能为空！");
						$("#ReserveName").focus();
						return false;
					}
		    		document.getElementById("IDCard").focus();
		        }
		    });
			$("#IDCard").keydown(function(event) {
				var e = event || window.event || arguments.callee.caller.arguments[0];
		        if (e && e.keyCode == 13) {	//enter key
					if($("#IDCard").val() == "") {
						alert("身份证号不能为空！");
						$("#IDCard").focus();
						return false;
					}
					else if(!checkcertificatenumber($("#IDCard").val())) {
						alert("身份证号输入不对！");
						$("#IDCard").val("");
						$("#IDCard").focus();
						return false;
		            }
	 	    		document.getElementById("FullNumber").focus();
					document.getElementById("FullNumber").select();
		        }
		    });
			$("#FullNumber").keydown(function(event) {
				var e = event || window.event || arguments.callee.caller.arguments[0];
		        if (e && e.keyCode == 13) {	//enter key
					if($("#FullNumber").val() == "" || $("#FullNumber").val() == 0) {
						alert("全票张数不能为空或零！");
		 	    		document.getElementById("FullNumber").focus();
						document.getElementById("FullNumber").select();
						return false;
					}
		    		document.getElementById("HalfNumber").focus();
					document.getElementById("HalfNumber").select();
		        }
		    });
			$("#HalfNumber").keydown(function(event) {
				var e = event || window.event || arguments.callee.caller.arguments[0];
		        if (e && e.keyCode == 13) {	//enter key
					computerprice();
		    		document.getElementById("confirmreserve").focus();
		        }
		    });
			$("#confirmreserve").keyup = function (event) {
				if(document.getElementById("HalfNumber").value*1>document.getElementById("LeaveHalfSeats").value*1 ){
					alert('余半票数'+document.getElementById("LeaveHalfSeats").value+'不够！');
					document.getElementById("HalfNumber").focus();
					document.getElementById("HalfNumber").select();
				}else if(document.getElementById("FullNumber").value*1+document.getElementById("HalfNumber").value*1 > document.getElementById("LeaveSeats").value*1){
					alert('余票数'+document.getElementById("LeaveSeats").value+'不够！');
	 	    		document.getElementById("FullNumber").focus();
					document.getElementById("FullNumber").select();
				}else{
					computerprice();
					var infoTxt = "全票数:"+document.getElementById("FullNumber").value+"  半票数:"+document.getElementById("HalfNumber").value+"  总票价:"+document.getElementById("AllPrice").value+"元"+"   确认订票？";
					if(confirm(infoTxt))
						document.form1.submit();
					else {
						document.getElementById("FullNumber").focus();
						document.getElementById("FullNumber").select();
					}
				}
			};
			$("#confirmreserve").click(function(){
				if($("#ReserveName").val() == "") {
					alert("姓名不能为空！");
					$("#ReserveName").focus();
					return false;
				}
				if($("#IDCard").val() == "") {
					alert("身份证号不能为空！");
					$("#IDCard").focus();
					return false;
				}
				else if(!checkcertificatenumber($("#IDCard").val())) {
					alert("身份证号输入不对！");
					$("#IDCard").val("");
					$("#IDCard").focus();
					return false;
	            }
				if($("#FullNumber").val() == "" || $("#FullNumber").val() == 0) {
					alert("全票张数不能为空或零！");
	 	    		document.getElementById("FullNumber").focus();
					document.getElementById("FullNumber").select();
					return false;
				}
				
				if(document.getElementById("HalfNumber").value*1>document.getElementById("LeaveHalfSeats").value*1 ){
					alert('余半票数'+document.getElementById("LeaveHalfSeats").value+'不够！');
					document.getElementById("HalfNumber").focus();
					document.getElementById("HalfNumber").select();
				}else if(document.getElementById("FullNumber").value*1+document.getElementById("HalfNumber").value*1 > document.getElementById("LeaveSeats").value*1){
					alert('余票数'+document.getElementById("LeaveSeats").value+'不够！');
	 	    		document.getElementById("FullNumber").focus();
					document.getElementById("FullNumber").select();
				}else{
					computerprice();
					var infoTxt = "全票数:"+document.getElementById("FullNumber").value+"  半票数:"+document.getElementById("HalfNumber").value+"  总票价:"+document.getElementById("AllPrice").value+"元"+"   确认订票？";
					if(confirm(infoTxt))
						document.form1.submit();
					else {
						document.getElementById("FullNumber").focus();
						document.getElementById("FullNumber").select();
					}
				}
			});
		});
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">留 票</span></td>
  </tr>
</table>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr><td colspan="5">班次信息</td></tr>
  	<tr>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $Selldate;?></span></td>
   		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $NoofrunsID;?></span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $FromStation.'('.$rows[2].')';?></span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $ReachStation.'('.$rows[3].')';?></span></td>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $rows[4].'元';?></span></td>
 	 </tr>
</table>
<form  method="post" name="form1" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr><td colspan="6">订票信息</td></tr>
  	<tr>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">订单号</span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">姓名</span></td>
    <!--  
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">电话</span></td>
    -->
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">证件号码</span></td>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">全票数</span></td>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">半票数</span></td>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">总票价</span></td>
 	 </tr>
 	 <tr>
 	 	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo 'R'.time();?></span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="ReserveName" id="ReserveName" /><span style="color:red">*</span></td>
    <!-- 
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="Phone" id="Phone" ></td>
     -->
   		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="IDCard" id="IDCard" /><span style="color:red">*</span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF">
    		<input type="hidden" name="LeaveSeats" id="LeaveSeats" value="<?php echo $rows['tml_LeaveSeats'];?>" />
    		<input type="text" name="FullNumber" id="FullNumber" onkeyup="return isnumber(this.value,this.id)"/><span style="color:red">*</span>
    	</td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF">
    		<input type="hidden" name="LeaveHalfSeats" id="LeaveHalfSeats" value="<?php echo $rows['tml_LeaveHalfSeats'];?>"/>
    		<input type="text" name="HalfNumber" id="HalfNumber" onkeyup="return isnumber(this.value,this.id)"/>
    	</td>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF">
  			<input type="text" name="AllPrice" id="AllPrice" readonly="readonly"/>
  			<input type="hidden" name="FullPrice" id="FullPrice" value="<?php echo $rows[4];?>"/>
  			<input type="hidden" name="HalfPrice" id="HalfPrice" value="<?php echo $rows[5];?>"/>
  			<input type="hidden" name="NoOfRunsdate" id="NoOfRunsdate" value="<?php echo $Selldate;?>"/>
  			<input type="hidden" name="NoofrunsID" id="NoofrunsID" value="<?php echo $NoofrunsID;?>"/>
  			<input type="hidden" name="FromstationID" id="FromstationID" value="<?php echo $rows[0];?>"/>
  			<input type="hidden" name="Fromstation" id="Fromstation" value="<?php echo $FromStation;?>"/>
  			<input type="hidden" name="ReachstationID" id="ReachstationID" value="<?php echo $rows[1];?>"/>
  			<input type="hidden" name="Reachstation" id="Reachstation" value="<?php echo $ReachStation;?>"/>
  			<input type="hidden" name="ReserveSellID" id="ReserveSellID" value="<?php echo 'R'.time();?>"/>
  		<!--	
  			<input type="hidden" name="UserName" id="UserName" value="<?php echo $UserName;?>"/>
  			<input type="hidden" name="CertificateType" id="CertificateType" value="<?php echo $CertificateType;;?>"/>
  			<input type="hidden" name="CertificateNumber" id="CertificateNumber" value="<?php echo $CertificateNumber;?>"/>
  			<input type="hidden" name="UserRegisterName" id="UserRegisterName" value="<?php echo $UserRegisterName;?>"/>
  		  -->
  		</td>
 	 </tr>
 	 <tr>
 	 	<td align="center" colspan="7" bgcolor="#FFFFFF">
 	 		<input name="confirmreserve" id="confirmreserve" type="button" value="提交" />
    		&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="history.back();" />
    	</td>
 	 </tr>
</table>
</form>
</body>
</html>

