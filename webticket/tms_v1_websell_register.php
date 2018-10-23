<?php
//定义页面必须验证是否登录
//define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
	function checkemail(email){
		var str=email;
		var Expression=/^([a-zA-Z0-9]+[_|-|.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|-|.]?)*[a-zA-Z0-9]+.[a-zA-Z]{2,3}$/gi;
	//	var objExp=new RegExp(Expression);
		if(Expression.test(str)==true){
			return true;
		}else {
			return false;
		}
	} 

	function checkcertificatenumber(certificatenumber){
		var str=certificatenumber;
		var Expression=/^(\d{18,18}|\d{15,15}|\d{17,17}x|\d{17,17}X)$/;
		if(Expression.test(str)==true){
			return true;
		}else {
			return false;
		}
	}
	$(document).ready(function(){
		//$("#UserRegisterName").focus();
		$("#query").click(function(){
			if (document.getElementById("UserRegisterName").value==""){
				alert('请输入用户名！');
				document.getElementById("UserRegisterName").focus();
				return false;
			}
			if (document.getElementById("Password1").value==""){
				alert('请输入密码！');
				document.getElementById("Password1").focus();
				return false;
			}
			if (document.getElementById("Password2").value==""){
				alert('请输入确认密码！');
				document.getElementById("Password2").focus();
				return false;
			} 
			if(document.getElementById("Password1").value!=document.getElementById("Password2").value){
				alert('两次输入的密码不一致！');
				$("#Password1").val("");
				$("#Password2").val("");
				document.getElementById("Password1").focus();
				return false;
			}
			if (document.getElementById("UserName").value==""){
				alert('请输入真实姓名！');
				document.getElementById("UserName").focus();
				return false;
			}
			if (document.getElementById("CertificateNumber").value==""){
				alert('请输入证件号码！');
				document.getElementById("CertificateNumber").focus();
				return false;
			}
			if(document.getElementById("CertificateType").value=="身份证"){
				if (document.getElementById("CertificateNumber").value==""){
					alert('请输入身份证号码！');
					document.getElementById("CertificateNumber").focus();
					return false;
				}
				if (!checkcertificatenumber(document.getElementById("CertificateNumber").value)){
					alert('您输入的身份证号码不正确！');
					document.getElementById("CertificateNumber").focus();
					return false;
				} 
			}
			if(document.getElementById("Emaile").value!=""){
				if (!checkemail(document.getElementById("Emaile").value)){
					alert('您输入的email地址不正确！');
					document.getElementById("Emaile").focus();
					return false;
				}
			} 
			jQuery.get(
				'tms_v1_websell_CheckInfo.php',
				{'op': 'REGISTERCHK', 'UserRegisterName': $("#UserRegisterName").val(),'CertificateNumber': $("#CertificateNumber").val(), 'time': Math.random()},
				function(data){
					//	alert(data);
						var objData = eval('(' + data + ')');
					//	alert(objData);
						if(objData.retVal == "FAIL1"){ 
							alert("该用户名已经被注册过！");
							$("#UserRegisterName").val("");
						//	$("#userpass").val("");
							document.userregister.UserRegisterName.focus();
							return false;
						}
						if(objData.retVal == "FAIL2"){ 
							alert("该证件号码已经被注册过！");
							$("#CertificateNumber").val("");
						//	$("#userpass").val("");
							document.userregister.CertificateNumber.focus();
							return false;
						}
						document.userregister.submit();
					//	else{
						//	alert('vvvvv');
					//		window.location.href='tms_v1_websell_websell.php';
					//	}
				});
		});	
	}); 

</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">用 户 注 册  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<div>
<!-- 
<form name="userregister" id="userregister" action="tms_v1_websell_registerok.php" method="post">
 -->
<form name="userregister" id="userregister" action="tms_v1_websell_registerok.php" method="post">
<table width="50%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 注册名：</span></td>
        <td bgcolor="#FFFFFF"><input type="text" name="UserRegisterName" id="UserRegisterName" /><span style="color:red">*</span></td>
	</tr>
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />密码：</span></td>
    	<td  bgcolor="#FFFFFF"><input  type="password" name="Password1" id="Password1" /><span style="color:red">*</span></td>
	</tr>
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />确认密码：</span></td>
    	<td  bgcolor="#FFFFFF"><input type="password" name="Password2" id="Password2" /><span style="color:red">*</span></td>
	</tr>
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />姓名：</span></td>
    	<td  bgcolor="#FFFFFF"><input type="text" name="UserName" id="UserName" /><span style="color:red">*</span></td>
	</tr>
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />证件类别：</span></td>
    	<td  bgcolor="#FFFFFF">
    		<select name="CertificateType" id="CertificateType">
      			<option value="身份证">身份证</option>
      			<option value="港澳通行证">港澳通行证</option>
      			<option value="台湾通行证">台湾通行证</option>
      			<option value="护照">护照</option>
     	 	</select><span style="color:red">*</span></td>
	</tr>
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />证件号码：</span></td>
    	<td  bgcolor="#FFFFFF"><input type="text" name="CertificateNumber" id="CertificateNumber"  /><span style="color:red">*</span></td>
	</tr>
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />电子信箱：</span></td>
    	<td  bgcolor="#FFFFFF"><input type="text" name="Emaile" id="Emaile" /></td>
	</tr>
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />电话号码：</span></td>
    	<td  bgcolor="#FFFFFF"><input type="text" name="Phone" id="Phone" /></td>
	</tr>
   <tr>
    <td  colspan="2" align="center" bgcolor="#FFFFFF"><input name="query" id="query" type="button" value="确定" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置"></td>
  </tr>
</table>
</form>
</div>