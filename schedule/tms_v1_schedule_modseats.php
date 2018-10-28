<?php
//修改座位数
//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$NoOfRunsID = $_GET['nrID'];
$NoOfRunsdate = $_REQUEST['nrDate'];
$reportBusCard = $_REQUEST['busn'];
$selectticketmode="SELECT li_LineName,tml_NoOfRunstime,tml_TotalSeats, tml_LeaveSeats,tml_HalfSeats,tml_ReserveSeats,tml_LeaveHalfSeats,tml_SeatStatus FROM tms_bd_TicketMode  LEFT OUTER JOIN tms_bd_LineInfo 
	ON tml_LineID = li_LineID WHERE tml_NoOfRunsID = '$NoOfRunsID' AND tml_NoOfRunsdate = '$NoOfRunsdate'";
$queryticketmode = $class_mysql_default->my_query($selectticketmode);
$rowticketmode = mysqli_fetch_array($queryticketmode);
$selectbus="SELECT bi_SeatS,bi_AllowHalfSeats FROM tms_bd_BusInfo WHERE bi_BusNumber='{$reportBusCard}'";
$querybus = $class_mysql_default->my_query($selectbus);
$rowbus = mysqli_fetch_array($querybus);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>修改座位数</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	 $('#HalfSeatnum1').keyup(function(){
		    var SeatS1 = document.getElementById('Seatnum1').value; //座位数
			var AllowHalfSeats1=$("#HalfSeatnum1").val(); //半票数
			if(isNaN(AllowHalfSeats1)){
				alert(AllowHalfSeats1+"不是数字！");
				document.getElementById('HalfSeatnum1').value='';
				return false;
				}
			if(SeatS1 == ""){
				var SeatS1 = 0;}
			if(AllowHalfSeats1 == ""){
				var AllowHalfSeats1 = 0;
				}
		    	var AllowHalfSeats1=parseInt(AllowHalfSeats1);
		    	var SeatS1 = parseInt(SeatS1);
		    	if(SeatS1 < AllowHalfSeats1){
			    	document.getElementById('allowhalf1').style.display='';
		    	}
		    else{
			    document.getElementById('allowhalf1').style.display='none';
		    }
	  });
	 $('#Seatnum1').keyup(function(){
		    var SeatS1 = document.getElementById('Seatnum1').value; //座位数
			var AllowHalfSeats1=$("#HalfSeatnum1").val(); //半票数
			if(isNaN(SeatS1)){
				alert(SeatS1+'不是数字');
				document.getElementById('Seatnum1').value='';
				return false;
				}
			if(SeatS1 == ""){
				var SeatS1 = 0;
				}
			if(AllowHalfSeats1 == ""){
				var AllowHalfSeats1 = 0;
				}
		    	var AllowHalfSeats1=parseInt(AllowHalfSeats1);
		    	var SeatS1 = parseInt(SeatS1);
		    	if(SeatS1 < AllowHalfSeats1){
			    	document.getElementById('allowhalf1').style.display='';
		    	}
		   else{
			    document.getElementById('allowhalf1').style.display='none';
		    }
	 });
});
	function isnumber(number,id){
		if(isNaN(number)){
			alert(number+"不是数字！");
			document.getElementById(id).value='';
			return false;
			}
	}

	function state(){
		var Seatnum1=document.getElementById("Seatnum1").value; //报到车总座位数
		var Seatnum=document.getElementById("Seatnum").value; //原总座位数
		var HalfSeatnum=document.getElementById("HalfSeatnum").value; //原半票总座位数
		var HalfSeatnum1=document.getElementById("HalfSeatnum1").value;//现半票总座位数
		if(Seatnum1 == ""){
			var Seatnum1 = 0;
			}
		if(Seatnum == ""){
			var Seatnum = 0;
			}
		if(HalfSeatnum == ""){
			var HalfSeatnum =0;
			}
		if(HalfSeatnum1 == ""){
			var HalfSeatnum1 = 0;
			}
		var Seatnum1 = parseInt(Seatnum1);
		var Seatnum = parseInt(Seatnum);
		var HalfSeatnum = parseInt(HalfSeatnum);
		var HalfSeatnum1 = parseInt(HalfSeatnum1);
		
		//alert(Seatnum1+Seatnum+HalfSeatnum+HalfSeatnum1);
		if(Seatnum1 < HalfSeatnum1){
			alert('修改后的半票座位数不能大于总座位数：'+Seatnum1);
			return false;
		}
		if(Seatnum1 < Seatnum && HalfSeatnum1 >= HalfSeatnum){
			if(!confirm('现总座位数['+Seatnum1+']小于原总座位数['+Seatnum+'],是否要修改座位数？')){
			return false;}
			else{
				document.form1.submit();
			}
		}
		if(Seatnum1 >= Seatnum && HalfSeatnum1 < HalfSeatnum){
			if(!confirm('现半票座位数['+HalfSeatnum1+']小于原半票座位数['+HalfSeatnum+'],是否要修改座位数？')){
			return false;}
			else{
				document.form1.submit();
			}
		}
		if(Seatnum1 < Seatnum && HalfSeatnum1 < HalfSeatnum){
			if(!confirm('现车辆总座位数['+Seatnum1+']小于原总座位数['+Seatnum+'];\r报到车辆半票座位数['+HalfSeatnum1+']小于原半票座位数['+HalfSeatnum+'],\r是否要修改座位数？')){
			return false;}
			else{
				document.form1.submit();
			}
		}
		if(Seatnum1 >= Seatnum && HalfSeatnum1 >= HalfSeatnum){
			document.form1.submit();
			}
		
}
</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
		<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
		<span class="graytext" style="margin-left:8px;">修改座位数</span></td>
	</tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr><td colspan="2">班次信息</td></tr>
	<tr bgcolor="#FFFFFF">
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路：</span></td>
		<td><input type="text" id="Linename" name="Linename" readonly="readonly" value="<?php echo $rowticketmode['li_LineName'];?>"/></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车时间：</span></td>
		<td><input type="text" id="NoOfRunstime" name="NoOfRunstime" readonly="readonly" value="<?php echo $rowticketmode['tml_NoOfRunstime'];?>"/></td>
	</tr>
	<tr><td colspan="2">原座位信息</td></tr>
	<tr bgcolor="#FFFFFF">
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />总共座位数：</span></td>
		<td><input type="text" id="Seatnum" name="Seatnum" readonly="readonly" value="<?php echo $rowticketmode['tml_TotalSeats'];?>"/></td>
	</tr>
	<tr bgcolor="#FFFFFF">	
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />半票座位数：</span></td>
		<td><input type="text" id="HalfSeatnum" name="HalfSeatnum" readonly="readonly" value="<?php echo $rowticketmode['tml_HalfSeats'];?>"/></td>
	</tr>
	<tr><td colspan="2">报到车座位信息</td></tr>
	<tr bgcolor="#FFFFFF">
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />总共座位数：</span></td>
		<td><input type="text" id="Seatnum1" name="Seatnum1"  value="<?php echo $rowbus['bi_SeatS'];?>" /></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />半票座位数：</span></td>
		<td>
			<input type="text" id="HalfSeatnum1" name="HalfSeatnum1"  value="<?php echo $rowbus['bi_AllowHalfSeats'];?>"/>
			<br>
			<span style="color:red" style="display:none" id="allowhalf1">允许半票数要小于座位数</span>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center" bgcolor="#FFFFFF">
			<input type="button" name="modseat" id="modseat" value="修改" onclick="state()"/>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button" name="back" id="back" value="返回" onclick="window.history.go(-1)"/>&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?php 
	if(isset($_POST['Seatnum1'])){
		$Seatnum1=$_POST['Seatnum1'];//报到车总座位数
		$Seatnum=$_POST['Seatnum'];//原总座位数
		$HalfSeatnum =$_POST['HalfSeatnum']; //原半票总座位数
		$HalfSeatnum1 = $_POST['HalfSeatnum1']; //现半票总座位数
		$diffseats=$Seatnum1-$Seatnum;
	//	$diffseats=$rowbus['bi_SeatS']-$rowticketmode['tml_TotalSeats'];
		
	//	$LeaveHalfSeats=$rowbus['bi_AllowHalfSeats']-$rowticketmode['tml_HalfSeats'];
		$LeaveSeats=$Seatnum1-$rowticketmode['tml_TotalSeats']+$rowticketmode['tml_LeaveSeats'];
	//	$LeaveSeats=$rowbus['bi_SeatS']-$rowticketmode['tml_TotalSeats']+$rowticketmode['tml_LeaveSeats'];
		$SeatStatus=$rowticketmode['tml_SeatStatus'];
		if($HalfSeatnum1 !=null){
			$LeaveHalfSeats=$HalfSeatnum1-$rowticketmode['tml_HalfSeats']+$rowticketmode['tml_LeaveHalfSeats'];
			if ($LeaveHalfSeats<0) $LeaveHalfSeats=0;
		}else{
			$LeaveHalfSeats=$rowticketmode['tml_LeaveHalfSeats'];
		}
	//	echo $diffseats.',';
	//	echo $LeaveHalfSeats.',';
	//	echo $LeaveSeats.',';
	//	echo $SeatStatus.',';
	//	echo strlen($SeatStatus).',';
		if ($diffseats>=0){
			for ($i=1;$i<=$diffseats;$i++){
				$SeatStatus=$SeatStatus.'0';
			}
		}else{
			for($i=1;$i<=abs($diffseats);$i++){
				$SeatStatus=substr($SeatStatus,0,strlen($SeatStatus)-1);	
			}
		}
	//	echo $SeatStatus.',';
	//	echo strlen($SeatStatus);
		$queryString = "SELECT tml_Allticket, tml_TotalSeats, tml_LeaveSeats,tml_HalfSeats,tml_ReserveSeats,tml_LeaveHalfSeats,tml_SeatStatus, tml_LineID, tml_EndstationID, tml_Endstation, 
	  		tml_BusModelID, tml_BusModel, tml_BeginstationID, tml_Beginstation FROM tms_bd_TicketMode WHERE (tml_NoOfRunsID = '$NoOfRunsID') AND (tml_NoOfRunsdate = '$NoOfRunsdate') FOR UPDATE";
	  	$result = $class_mysql_default->my_query("$queryString");
		if(!$result) echo $class_mysql_default->my_error()."锁定票版失败"; 
		else{
			$queryupdate="UPDATE tms_bd_TicketMode SET tml_TotalSeats='{$Seatnum1}',tml_LeaveSeats='{$LeaveSeats}',tml_LeaveHalfSeats='{$LeaveHalfSeats}',tml_SeatStatus='{$SeatStatus}',tml_HalfSeats='$HalfSeatnum1',
				tml_Updated='{$reportDatatime}', tml_Updatedby='{$userName}' WHERE tml_NoOfRunsID='{$NoOfRunsID}' AND tml_NoOfRunsdate='{$NoOfRunsdate}'";
			$resultupdate = $class_mysql_default->my_query("$queryupdate");
			if($resultupdate) {
				echo "<script>alert('修改座位成功!');window.location.href='tms_v1_schedule_noofrun.php?op=none'</script>";
			}else{
				echo "<script>alert('修改座位失败!');window.location.href='tms_v1_schedule_noofrun.php?op=none'</script>";
			}
		} 
	}
?>