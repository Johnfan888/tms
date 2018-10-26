<?php 
//票证领用库界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber=$_GET['clnumber'];
	$sql="SELECT * FROM tms_bd_TicketAdd where  ta_ID='{$clnumber}'";
	$query = $class_mysql_default->my_query($sql);
	$row = mysqli_fetch_array($query);
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" >
	function Provide(){
		if(document.getElementById("InceptUserID").value ==""){
			alert("接收用户编号不能为空!");
			return false;
		}
		if(document.getElementById("InceptUser").value =="" || document.getElementById("InceptUser").value =="null"){
	//	if(document.getElementById("InceptUser").value =="null"){
			getuserinfor();
		//	alert("接收用户姓名不能为空!");
		//	return false;
		} 
		if(document.getElementById("InceptTicketNum").value==""){
			alert("领用数量不能为空!");
			document.getElementById("InceptTicketNum").focus();
			return false; 
		}
		if(!computernum()){
			return false;
		}
		document.addL.submit();
	}
	function isnumber(number){
		if(document.getElementById("InceptTicketNum").value!=''){
			if(isNaN(number)){
				alert(number+"不是数字！");
				document.getElementById("InceptTicketNum").value='';
				document.getElementById("InceptTicketNum").focus();
				return false;
			}
			if(number!= parseInt(number)){
				alert(number+'不是整数！');
				document.getElementById("InceptTicketNum").value='';
				document.getElementById("InceptTicketNum").focus();
				return false;
			}
		}
	}
	function computer(){
		computernum();
	}
	function computernum(){
		if(document.getElementById("InceptTicketNum").value==""){
			alert("领用数量不能为空!");
			document.getElementById("InceptTicketNum").focus();
			return false;
		} 
		if(parseInt(document.getElementById("InceptTicketNum").value)>parseInt(document.getElementById("LostNum").value)){
			document.getElementById("EndTicket").value="";
			document.getElementById("InceptTicketNum").value="";
			alert("目前该票还剩余"+document.getElementById("LostNum").value+"张，领用数不能超出!");
			document.getElementById("InceptTicketNum").focus();
			return false;
		}
		var begin=parseInt(document.getElementById("CurrentTicket").value);
		var strlength=document.getElementById("CurrentTicket").value.length;
//		alert(begin);
//		alert(strlength);
//		document.getElementById("EndTicket").value=parseInt(begin)+parseInt(document.getElementById("InceptTicketNum").value*1-1);
		document.getElementById("EndTicket").value=document.getElementById("CurrentTicket").value*1+document.getElementById("InceptTicketNum").value*1-1;
//		alert(document.getElementById("EndTicket").value);
		if (document.getElementById("EndTicket").value.length<strlength){
				var addstring='';
				for(var i=0;i<strlength-document.getElementById("EndTicket").value.length; i++){
					var addstring=addstring+'0';
				}
				document.getElementById("EndTicket").value=addstring+document.getElementById("EndTicket").value;
		} 
		return true;
		//document.getElementById("EndTicke").value=document.getElementById("EndTicket").value;
	//	document.getElementById("ACurrentTicket").value=parseInt(begin)+parseInt(document.getElementById("InceptTicketNum").value);
	//	document.getElementById("LostNum").value=document.getElementById("LostNum").value-document.getElementById("InceptTicketNum").value;
	//	alert(document.getElementById("LostNum").value);  
	}	 
	function sear(){
		window.location.href='tms_v1_basedata_searticketadd.php';
	}
	function getuserinfor(){
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
								if(document.getElementById("InceptUser").value=="null"){
									alert("用户编号错误！");
									document.getElementById("InceptUserID").value='';
									document.getElementById("InceptUser").value='';
									document.getElementById("InceptUserSation").value='';
									document.getElementById("InceptUserID").focus();
								}
							}
					});
		}	
	}
	$(document).ready(function(){
		document.getElementById("InceptUserID").focus();
		$("#InceptUser").click(function(){
			getuserinfor();
		});
		document.getElementById("InceptUserID").onkeydown = function (event){
			 var e = event || window.event || arguments.callee.caller.arguments[0];
	         if (e && e.keyCode == 13) {
				document.getElementById("InceptUser").focus();
	         }
		};
		document.getElementById("InceptUser").onkeydown = function (event){
			 var e = event || window.event || arguments.callee.caller.arguments[0];
	         if (e && e.keyCode == 13) {
	        	 getuserinfor();
				document.getElementById("InceptTicketNum").focus();
	         }
		};
		document.getElementById("InceptTicketNum").onkeydown = function (event){
			 var e = event || window.event || arguments.callee.caller.arguments[0];
	         if (e && e.keyCode == 13) {
	        	computernum();
	        	if(document.getElementById("InceptTicketNum").value==""){
	        		document.getElementById("InceptTicketNum").focus();
		        }else{
					document.getElementById("Remark").focus();
		        }
	         }
		};
		document.getElementById("Remark").onkeydown = function (event){
			 var e = event || window.event || arguments.callee.caller.arguments[0];
	         if (e && e.keyCode == 13) {
	        //	computernum();
				document.getElementById("button1").focus();
	         }
		};
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
<div><form name="addL" id="addL" action="tms_v1_basedata_ticketprovideok.php" method="post">
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
    	<td bgcolor="#FFFFFF"><input name="InceptTicketNum" id="InceptTicketNum" type="text" onfocus="getuserinfor()" onkeyup="return isnumber(this.value)"/><span style="color:red">*</span></td> 
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
    	<td bgcolor="#FFFFFF"><textarea name="Remark" id="Remark" cols="" rows="5"></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="button1" id="button1" type="button" value="领用" onclick="return Provide()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return sear()"></td>
  </tr>
</table>
</form>
</div>

