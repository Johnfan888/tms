<?
//网上预定界面

define("WEBAUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

//$UserRegisterName=$_GET['UserRegisterName'];
//echo $UserRegisterName;

$NoofrunsID=$_GET['NoofrunsID'];
$Selldate=$_GET['Selldate'];
$FromStation=$_GET['FromStation'];
$ReachStation=$_GET['ReachStation'];

$Select="SELECT pd_FromStationID,pd_ReachStationID,pd_BeginStationTime,pd_StopStationTime,pd_FullPrice,pd_HalfPrice,tml_LeaveSeats,tml_LeaveHalfSeats FROM 
	tms_bd_PriceDetail,tms_bd_TicketMode WHERE pd_NoOfRunsID=tml_NoOfRunsID AND pd_NoOfRunsdate=tml_NoOfRunsdate AND
	pd_NoOfRunsID='{$NoofrunsID}' AND pd_NoOfRunsdate='{$Selldate}' AND pd_FromStation='{$FromStation}' AND pd_ReachStation='{$ReachStation}'";

/*$Select="SELECT pd_FromStation,pd_ReachStation,pd_BeginStationTime,pd_StopStationTime,pd_FullPrice,pd_HalfPrice FROM tms_bd_PriceDetail WHERE 
	pd_NoOfRunsID='{$NoofrunsID}' AND pd_NoOfRunsdate='{$Selldate}' AND pd_FromStation='{$FromStation}' AND pd_ReachStation='{$ReachStation}'";*/
$resultselect = $class_mysql_default ->my_query("$Select"); 
$rows = @mysql_fetch_array($resultselect);

//$selectuser="SELECT wur_UserName,wur_CertificateType,wur_CertificateNumber FROM tms_bd_WebUserRegister WHERE wur_UserRegisterName='{$UserRegisterName}'";
//$resultuser = $class_mysql_default ->my_query("$selectuser"); 
//$rowsuser=@mysql_fetch_array($resultuser);
//获取查询初始化界面参数
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>网上预订</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
	function isnumber(number,id){
		if(isNaN(number)){
			alert(number+"不是数字！");
			document.getElementById(id).value='';
			return false;
		}
		if(document.getElementById(id).value!=""){
		if(parseInt(number)!=number){
			alert(number+"不是整数！")
			document.getElementById(id).value=""
			return false;
			}
		}
	}
	function checkFullNumber() {
		if(document.getElementById("FullNumber").value*1+document.getElementById("HalfNumber").value*1 > document.getElementById("LeaveSeats").value*1){
			alert('余票数'+document.getElementById("LeaveSeats").value+'不够！');
			document.getElementById("FullNumber").value = "";
			document.getElementById("FullNumber").focus();
			return false;
		}
		return true;
	}
	function checkHalfNumber() {
		if(document.getElementById("HalfNumber").value*1>document.getElementById("LeaveHalfSeats").value*1 ){
			alert('余票数'+document.getElementById("LeaveHalfSeats").value+'不够！');
			document.getElementById("HalfNumber").value = "";
			document.getElementById("HalfNumber").focus();
			return false;
		}
		return true;
	}
	function computerprice(){
		if(document.getElementById("FullNumber").value==""){
			document.getElementById("FullNumber").value=0;
		}
		if(document.getElementById("HalfNumber").value==""){
			document.getElementById("HalfNumber").value=0;
		} 
		var pp1=parseInt(document.getElementById("FullNumber").value);
		var pp2=parseInt(document.getElementById("HalfNumber").value);
		document.getElementById("AllPrice").value=pp1*parseFloat(document.getElementById("FullPrice").value)+pp2*parseFloat(document.getElementById("HalfPrice").value);
	}
	function bookSub() {
		if(document.getElementById("FullNumber").value==""||document.getElementById("FullNumber").value==0){
			alert('全票张数不能为空或零！！');
			document.getElementById("FullNumber").value = "";
			document.getElementById("FullNumber").focus();
			return false;
		}
		if(checkFullNumber()) {
			if(checkHalfNumber()){
				computerprice();
				var infoTxt = "全票数:"+document.getElementById("FullNumber").value+"  半票数:"+document.getElementById("HalfNumber").value+"  总票价:"+document.getElementById("AllPrice").value+"元"+"   确认订票？";
				if(confirm(infoTxt))
					document.form1.submit();
				else 
					document.getElementById("FullNumber").focus();
			}				
		}
		return false;
	}
	function back(){
		window.location.href='tms_v1_websell_websell.php?';
	}
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">网 上 预 定</span></td>
  </tr>
</table>
<table width="100%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
	<tr><td>班次信息</td></tr>
  	<tr>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $Selldate;?></span></td>
   		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $NoofrunsID;?></span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $FromStation.'('.$rows[2].')';?></span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $ReachStation.'('.$rows[3].')';?></span></td>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $rows[4].'元';?></span></td>
 	 </tr>
</table>
<form method="post" name="form1" action="tms_v1_websell_webreserveok.php">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr><td colspan="7">订票信息</td></tr>
  	<tr>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">订单号</span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">姓名</span></td>
   		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">证件类型</span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">证件号码</span></td>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">全票数</span></td>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">半票数</span></td>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">价格</span></td>
 	 </tr>
 	 <tr>
 	 <!-- <td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo 'D'.substr(md5(uniqid(rand())),0,19);?></span></td> -->	
 	 	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo 'D'.date("ymd").time();?></span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $UserName;?></span></td>
   		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $CertificateType;?></span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $CertificateNumber;?></span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF">
    		<input type="text" name="FullNumber" id="FullNumber" onkeyup="return isnumber(this.value,this.id)" onblur="checkFullNumber()"/><span style="color:red">*</span>
    		<input type="hidden" name="LeaveSeats" id="LeaveSeats" value="<?php echo $rows['tml_LeaveSeats'];?>"/>
    	</td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF">
    		<input type="text" name="HalfNumber" id="HalfNumber" onkeyup="return isnumber(this.value,this.id)" onblur="checkHalfNumber()"/>
    		<input type="hidden" name="LeaveHalfSeats" id="LeaveHalfSeats" value="<?php echo $rows['tml_LeaveHalfSeats'];?>"/>
    	</td>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF">
  			<input type="text" name="AllPrice" id="AllPrice" readonly="readonly" onclick="computerprice()"/>
  			<input type="hidden" name="FullPrice" id="FullPrice" value="<?php echo $rows['pd_FullPrice'];?>"/>
  			<input type="hidden" name="HalfPrice" id="HalfPrice" value="<?php echo $rows['pd_HalfPrice'];?>"/>
  			<input type="hidden" name="NoOfRunsdate" id="NoOfRunsdate" value="<?php echo $Selldate;?>"/>
  			<input type="hidden" name="NoofrunsID" id="NoofrunsID" value="<?php echo $NoofrunsID;?>"/>
  			<input type="hidden" name="FromstationID" id="FromstationID" value="<?php echo $rows['pd_FromStationID'];?>"/>
  			<input type="hidden" name="Fromstation" id="Fromstation" value="<?php echo $FromStation;?>"/>
  			<input type="hidden" name="ReachstationID" id="ReachstationID" value="<?php echo $rows['pd_ReachStationID'];;?>"/>
  			<input type="hidden" name="Reachstation" id="Reachstation" value="<?php echo $ReachStation;?>"/>
  		<!-- <input type="hidden" name="WebSellID" id="WebSellID" value="<?php echo 'D'.substr(md5(uniqid(rand())),0,19);?>"/> -->
  			<input type="hidden" name="WebSellID" id="WebSellID" value="<?php echo 'D'.date("ymd").time();?>"/>
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
			<input name="button1" type="button" value="提交" onclick="return bookSub();"/>
    		&nbsp;&nbsp;&nbsp;<input name="reset2" type="reset" value="重置"/>
    		&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="返回" onclick="return back();"/>
    	</td>
 	 </tr>
</table>
</form>
</body>
</html>
