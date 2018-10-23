<?php 
//票证领用库界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber=$_GET['clnumber'];
	$sql="SELECT * FROM tms_bd_TicketAdd where  ta_ID='{$clnumber}'";
	$query = $class_mysql_default->my_query($sql);
	$row = mysql_fetch_array($query);
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" >
	function Provide(){
		if(document.getElementById("InceptUserID").value ==""){
			alert("接收用户编号不能为空!");
			return false;
		} 
		if(document.getElementById("InceptUser").value =="" || document.getElementById("InceptUser").value =="null"){
			alert("接收用户姓名不能为空!");
			return false;
		} 
		if(document.getElementById("InceptTicketNum").value==""){
			alert("领用数量不能为空!");
			return false; 
		}	
		if(document.getElementById("EndTicket").value==""){
			alert("结束票号不能为空!");
			return false; 
		}
	}
	function computer(){
		if(document.getElementById("InceptTicketNum").value==""){
			alert("领用数量不能为空!");
			return false;
		} 
		if(parseInt(document.getElementById("InceptTicketNum").value)>parseInt(document.getElementById("LostNum").value)){
			alert("目前该票还剩余"+document.getElementById("LostNum").value+"张，领用数不能超出!")
			return false;
		}
		var begin=parseInt(document.getElementById("CurrentTicket").value);
		document.getElementById("EndTicket").value=parseInt(begin)+parseInt(document.getElementById("InceptTicketNum").value-1);
		//document.getElementById("EndTicke").value=document.getElementById("EndTicket").value;
		document.getElementById("ACurrentTicket").value=parseInt(begin)+parseInt(document.getElementById("InceptTicketNum").value);
		document.getElementById("LostNum").value=document.getElementById("LostNum").value-document.getElementById("InceptTicketNum").value;
	//	alert(document.getElementById("LostNum").value);
	}	
	function sear(){
		window.location.href='tms_v1_basedata_searticketadd.php';
	}
	$(document).ready(function(){
		$("#InceptUser").click(function(){
			if (document.getElementById("InceptUserID").value=="") {
				alert("接收用户编号不能为空！");
				document.getElementById("InceptUserID").focus();
			}else {
				jQuery.get(
						'tms_v1_bsaedata_dataProcess.php',
						{'op': 'getInceptUser', 'InceptUserID': $("#InceptUserID").val(), 'time': Math.random()},
						 function(data){
								var objData = eval('(' + data + ')');
								if(objData.retVal == "FAIL"){ 
									alert(objData.retString);
								}
								else{
									document.getElementById("InceptUser").value=objData.InceptUser;
									document.getElementById("InceptUserSation").value=objData.InceptUserSation;
								}
						});
			}	
		});
	});
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">票 据 领 用  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<div><form name="addL" id="addL" action="" method="post">
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF" "><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 接收者编号：</span></td>
        <td bgcolor="#FFFFFF"><input name="InceptUserID" id="InceptUserID" type="text" /><span style="color:red">*</span></td>
	</tr>
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF" "><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 接收者：</span></td>
        <td bgcolor="#FFFFFF"><input name="InceptUser" id="InceptUser" type="text" readonly="readonly"/><span style="color:red">*</span></td>
	</tr>
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF" "><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 接收者单位：</span></td>
        <td bgcolor="#FFFFFF"><input name="InceptUserSation" id="InceptUserSation" type="text" readonly="readonly"/><span style="color:red">*</span></td>
	</tr>
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF" "><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开始票号：</span></td>
        <td bgcolor="#FFFFFF"><input name="BeginTicket" id="BeginTicket" type="hidden" value="<?php echo $row['ta_CurrentTicket'];?>"/>
        		<input name="ID" id="ID" type="hidden" value="<?php echo $row['ta_ID'];?>"/>
        		<input name="CurrentTicket" id="CurrentTicket" type="hidden" value="<?php echo $row['ta_CurrentTicket'];?>"/>
        		<input name="ACurrentTicket" id="ACurrentTicket" type="hidden" />
        		<input name="LostNum" id="LostNum" type="hidden" value="<?php echo $row['ta_LostNum'];?>"/>
        		<input name="BeginTicke" id="BeginTicke" type="text" disabled="disabled" value="<?php echo $row['ta_CurrentTicket'];?>"/></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 领用数量：</span></td>
    	<td bgcolor="#FFFFFF"><input name="InceptTicketNum" id="InceptTicketNum" type="text"/><span style="color:red">*</span></td> 
    </tr>
	<tr> 	
		<td nowrap="nowrap" bgcolor="#FFFFFF" onclick="computer()"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结束票号：</span></td>
		<td bgcolor="#FFFFFF"><input name="EndTicket" id="EndTicket" type="text" readonly="readonly" onclick="computer()"/><span style="color:red">*</span></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 票据类型：</span></td>
    	<td bgcolor="#FFFFFF"><input name="Type" id="Type" type="hidden" value="<?php echo $row['ta_Type'];?>"/>
    			<input name="Typ" id="Typ" type="text" disabled="disabled" value="<?php echo $row['ta_Type'];?>"/></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="submit" type="submit" value="领用" onclick="return Provide()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return sear()"></td>
  </tr>
</table>
</form>
</div>
<?php 
if(isset($_POST['submit'])){
	$ID=$_POST['ID'];
	$InceptUserID=$_POST['InceptUserID'];
	$InceptUser=$_POST['InceptUser'];
	$InceptUserSation=$_POST['InceptUserSation'];
	$InceptTicketNum=$_POST['InceptTicketNum'];
	$showtime=date("Y-m-d");
	$Curtime=date("H:i");
	$BeginTicket=$_POST['BeginTicket'];
	$EndTicket=$_POST['EndTicket'];
	$CurrentTicket=$_POST['CurrentTicket'];
	$ACurrentTicket=$_POST['ACurrentTicket'];
	$LostNum=$_POST['LostNum'];
	$Type=$_POST['Type'];
	$Remark=$_POST['Remark'];
	$showtime=date("Y-m-d");
	$Curtime=date("H:i");
	$ProvideUser=$userName;
	$UseState='当前';
	
	$class_mysql_default->my_query("START TRANSACTION");
	$update="UPDATE tms_bd_TicketAdd SET ta_CurrentTicket='{$ACurrentTicket}',ta_LostNum='{$LostNum}' WHERE ta_ID='{$ID}'";
	$query1 =$class_mysql_default->my_query($update);
	$insert="insert into tms_bd_TicketAdd (ta_Data,ta_Time,ta_BeginTicket,ta_EndTicket,ta_CurrentTicket,ta_AddNum,ta_LostNum,
		ta_Type,ta_UserID,ta_User,ta_UserSation,ta_Remark) values ('{$showtime}','{$Curtime}','{$BeginTicket}',
		'{$EndTicket}','{$BeginTicket}','{$InceptTicketNum}','{$InceptTicketNum}','{$Type}',
		'{$InceptUserID}','{$InceptUser}','{$InceptUserSation}','{$Remark}')";
	$query2 =$class_mysql_default->my_query($insert); 
	if($query1 && $query2){
		$class_mysql_default->my_query("COMMIT");
		echo"<script>alert('车站领用成功!');window.location.href='tms_v1_basedata_searticketadd.php?'</script>";
	}else{
		$class_mysql_default->my_query("ROLLBACK");
		echo"<script>alert('车站领用失败');window.location.href='tms_v1_basedata_searticketadd.php?'</script>";
	}
	$class_mysql_default->my_query("END TRANSACTION");
}
?>
