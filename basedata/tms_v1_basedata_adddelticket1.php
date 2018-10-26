<?php 
//重置票号销票界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber=$_GET['clnumber'];
	$sql="SELECT * FROM tms_sell_ResetTicket where rt_ID='{$clnumber}'";
	$query = $class_mysql_default->my_query($sql);
	$row = mysqli_fetch_array($query);
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" >
	function delticket(){
		if(document.getElementById("InceptTicketNum").value==""){
			alert("销票数量不能为空!");
			document.getElementById("InceptTicketNum").focus();
			return false; 
		}
		if(document.getElementById("EndTicket").value==""){
			alert("结束票号不能为空!");
			document.getElementById("EndTicket").focus();
			return false; 
		}
		if(document.getElementById("delreason").value==""){
			alert("销票原因不能为空!");
			document.getElementById("delreason").focus();
			return false; 
		}		
		if(document.getElementById("BeginTicket").value.length!=document.getElementById("EndTicket").value.length){
			alert('开始票号和结束票号长度不相等!');
			return false;
		}
		var begin=document.getElementById("BeginTicket").value.replace(/\D/g, "");
		var end=document.getElementById("EndTicket").value.replace(/\D/g, "");
//		alert(parseInt(begin));
//		alert(parseInt(end));
//		if(parseInt(begin)>parseInt(end)){
		if(begin>end){
			alert("开始票号不能大于结束票号!")
			return false;
		}
		if(document.getElementById("EndTicket").value!=document.getElementById("InceptTicketNum").value*1+document.getElementById("BeginTicket").value*1-1*1){
			alert('信息输入出错!请检查!');
			return false;
		}
		document.getElementById("ACurrentTicket").value=document.getElementById("EndTicket").value*1+1;
		var strlength1=document.getElementById("EndTicket").value.length;
//		alert(strlength1);
			if (document.getElementById("ACurrentTicket").value.length<strlength1){
//				alert(2);
				var addstring1='';
				for(var i=0;i<strlength1-document.getElementById("ACurrentTicket").value.length; i++){
					var addstring1=addstring1+'0';
				}
				document.getElementById("ACurrentTicket").value=addstring1+document.getElementById("ACurrentTicket").value;
			}
//			alert(document.getElementById("ACurrentTicket").value);
		if(!confirm("销票确认：\r\r开始票号：  "+ document.getElementById("BeginTicket").value
				 + "\r结束票号：  " + document.getElementById("EndTicket").value 
				 + "\r销票数量：  "+document.getElementById("InceptTicketNum").value
				 +"\r票据类型：  "+ document.getElementById("Type").value)){
			return false;
		}
		document.addL.submit();
	}
	function sear(){
		window.location.href='tms_v1_basedata_delticket.php';
	}
	function isnumber(number){
		if(document.getElementById("InceptTicketNum").value!=''){
			if(isNaN(number)){
				alert(number+"不是数字！");
				document.getElementById("InceptTicketNum").value='';
				document.getElementById("InceptTicketNum").value="";
				document.getElementById("InceptTicketNum").focus();
				return false;
			}
			if(number!= parseInt(number)){
				alert(number+'不是整数！');
				document.getElementById("InceptTicketNum").value='';
				document.getElementById("InceptTicketNum").value="";
				document.getElementById("InceptTicketNum").focus();
				return false;
			}
		}
	}
	function showend(){
		if(document.getElementById("EndTicket").value!=""){
			document.getElementById("InceptTicketNum").value=document.getElementById("EndTicket").value*1+1*1-document.getElementById("BeginTicket").value*1;
			}
		}
	function shownum(){
		if(document.getElementById("InceptTicketNum").value!=""){
			document.getElementById("EndTicket").value=document.getElementById("InceptTicketNum").value*1+document.getElementById("BeginTicket").value*1-1*1;
			}
		}
	$(document).ready(function(){	
		$("#InceptTicketNum").keyup(function(){
			if(document.getElementById("InceptTicketNum").value!=''){
				if(parseInt(document.getElementById("InceptTicketNum").value)>parseInt(document.getElementById("LostNum").value)){
					document.getElementById("EndTicket").value="";
					document.getElementById("InceptTicketNum").value="";
					alert("目前该票还剩余"+document.getElementById("LostNum").value+"张，销票数不能超出!");
					document.getElementById("InceptTicketNum").focus();
					return false;
				}
			document.getElementById("EndTicket").value=document.getElementById("InceptTicketNum").value*1+document.getElementById("BeginTicket").value*1-1*1;
			document.getElementById("ACurrentTicket").value=document.getElementById("InceptTicketNum").value*1+document.getElementById("BeginTicket").value*1;
//			var begin=parseInt(document.getElementById("BeginTicket").value);
			var strlength=document.getElementById("BeginTicket").value.length;
//			alert(begin);
//			alert(strlength);
//			document.getElementById("EndTicket").value=parseInt(begin)+parseInt(document.getElementById("InceptTicketNum").value*1-1);
//			document.getElementById("EndTicket").value=document.getElementById("BeginTicket").value*1+document.getElementById("InceptTicketNum").value*1-1;
//			alert(document.getElementById("EndTicket").value);
				if (document.getElementById("EndTicket").value.length<strlength){
					var addstring='';
					for(var i=0;i<strlength-document.getElementById("EndTicket").value.length; i++){
						var addstring=addstring+'0';
					}
					document.getElementById("EndTicket").value=addstring+document.getElementById("EndTicket").value;
					document.getElementById("ACurrentTicket").value=addstring+document.getElementById("ACurrentTicket").value;
				}
			}
		});
	});
	$(document).ready(function(){	
		$("#EndTicket").keyup(function(){
			document.getElementById("InceptTicketNum").value=document.getElementById("EndTicket").value*1+1*1-document.getElementById("BeginTicket").value*1;
			if(parseInt(document.getElementById("InceptTicketNum").value)>parseInt(document.getElementById("LostNum").value)){
				document.getElementById("EndTicket").value="";
				document.getElementById("InceptTicketNum").value="";
				alert("目前该票还剩余"+document.getElementById("LostNum").value+"张，销票数不能超出!");
				document.getElementById("EndTicket").focus();
				return false;
			}
		});
	});
	function AddOther(url) {                  
		window.open(url,'销票原因','width=600,height=500');
	}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">销 票  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<div><form name="addL" id="addL" action="" method="post">
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开始票号：</span></td>
        <td bgcolor="#FFFFFF"><input name="BeginTicket" id="BeginTicket" type="hidden" value="<?php echo $row['rt_CurrentTicket'];?>"/>
        		<input name="ID" id="ID" type="hidden" value="<?php echo $row['rt_ID'];?>"/>
        		<input name="InceptUserID" id="InceptUserID" type="hidden" value="<?php echo $row['rt_ResetUserID'];?>"/>
        		<input name="InceptUser" id="InceptUser" type="hidden" value="<?php echo $row['rt_ResetUser'];?>"/>
        		<input name="UserSation" id="UserSation" type="hidden" value="<?php echo $row['rt_UserSation'];?>"/>
        		<input name="ProvideData" id="ProvideData" type="hidden" value="<?php echo $row['rt_ResetDate'];?>"/>
        		<input name="LostNum" id="LostNum" type="hidden" value="<?php echo $row['rt_InceptTicketNum'];?>"/>
        		<input name="ACurrentTicket" id="ACurrentTicket" type="hidden" />
        		<input name="BeginTicke" id="BeginTicke" type="text" disabled="disabled" value="<?php echo $row['rt_CurrentTicket'];?>"/></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 销票张数：</span></td>
    	<td bgcolor="#FFFFFF"><input name="InceptTicketNum" id="InceptTicketNum" type="text" onkeyup="return isnumber(this.value)" onclick="showend()"/><span style="color:red">*</span></td> 
    </tr>
	<tr> 	
		<td nowrap="nowrap" bgcolor="#FFFFFF" onclick="computer()"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结束票号：</span></td>
		<td bgcolor="#FFFFFF"><input name="EndTicket" id="EndTicket" type="text" onclick="shownum()"/><span style="color:red">*</span></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 票据类型：</span></td>
    	<td bgcolor="#FFFFFF"><input name="Type" id="Type" type="hidden" value="<?php echo $row['rt_Type'];?>"/>
    			<input name="Typ" id="Typ" type="text" disabled="disabled" value="<?php echo $row['rt_Type'];?>"/></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />销票原因：</span></td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="delreason" id="delreason" style="width:180" value="<?php echo $row['rt_Remark'].'，重置票号';?>"/>
    	<input type="button" name="reasonbutton" value="..." style="background-color:#CCCCCC" onClick="AddOther('tms_v1_basedata_delticketreason.php')">
		<span style="color:red">*</span></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="button1" id="button1" type="button" value="销票" onclick="return delticket()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return sear()"></td>
  </tr>
</table>
</form>
</div>
<?php
if(isset($_REQUEST['ID'])){
	$ID=$_POST['ID'];
	$InceptUserID=$_POST['InceptUserID'];
	$InceptUser=$_POST['InceptUser'];
	$UserSation=$_POST['UserSation'];
	$InceptTicketNum=$_POST['InceptTicketNum'];
	$showtime=date("Y-m-d h:m:s");
	$BeginTicket=$_POST['BeginTicket'];
	$EndTicket=$_POST['EndTicket'];
	$ProvideData=$_POST['ProvideData'];
	$LostNum=$_POST['LostNum'];
	$Type=$_POST['Type'];
	$delreason=$_POST['delreason'];
	$ACurrentTicket=$_POST['ACurrentTicket'];
	$LostNum=$LostNum-$InceptTicketNum;

	$class_mysql_default->my_query("START TRANSACTION");
	$update="UPDATE tms_sell_ResetTicket SET rt_CurrentTicket='{$ACurrentTicket}',rt_InceptTicketNum='{$LostNum}' WHERE rt_ID='{$ID}'";
	$query1 =$class_mysql_default->my_query($update);
	$insert="insert into tms_bd_DelTicket(dt_ID,dt_InceptUserID,dt_InceptUser,dt_UserSation,dt_ProvideDate,dt_BeginTicket,
		dt_EndTicket,dt_DelTicketNum,dt_Type,dt_DeleteTime,dt_DeletorID,dt_DeletorName,dt_DeletorSation,dt_DeletorSationID,dt_DelReason)
		 values('','{$InceptUserID}','{$InceptUser}','{$UserSation}','{$ProvideData}','{$BeginTicket}',
		'{$EndTicket}','{$InceptTicketNum}','{$Type}','{$showtime}','{$userID}','{$userName}','{$userStationName}','{$userStationID}','{$delreason}')";
	$query2 =$class_mysql_default->my_query($insert); 
	if($query1 && $query2){
		$class_mysql_default->my_query("COMMIT");
		echo"<script>alert('销票成功!');window.location.href='tms_v1_basedata_seardelticket.php'</script>";
	}else{
		$class_mysql_default->my_query("ROLLBACK");
		echo"<script>alert('销票失败');history.back();</script>";
	}
	$class_mysql_default->my_query("END TRANSACTION");
}
?>
