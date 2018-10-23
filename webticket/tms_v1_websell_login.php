<?
/*
 * 网上售票登录页面
 */

require_once("../ui/inc/init.inc.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>用户登录</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="css/style_main.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script>
	$(document).ready(function(){
		$("#username").focus();
		$("#login").click(function(){
			if (document.form1.username.value == "" || document.form1.userpass.value == ""){
				alert("用户名和密码不能为空！");
				document.form1.username.focus();
			}
			jQuery.get(
				'tms_v1_websell_CheckInfo.php',
				{'op': 'LOGINCHK', 'UserName': $("#username").val(), 'UserPass': $("#userpass").val(), 'time': Math.random()},
				function(data){
				//	alert(data);
					var objData = eval('(' + data + ')');
				//	alert(objData);
					if(objData.retVal == "FAIL"){ 
						alert("用户或密码不对！");
						$("#username").val("");
						$("#userpass").val("");
						document.form1.username.focus();
					}
					else{
					//	alert('vvvvv');
						window.location.href='tms_v1_websell_group.php?action=login&UserRegisterName='+document.getElementById("username").value;
					}
			});
		});
		$("#register").click(function(){
			window.location.href='tms_v1_websell_register.php';
		});
	});
	</script>
</head>
<body style="background:#1075b1; overflow:hidden;">
<form name="form1" action="" method="post" style="margin:0px auto; text-align:center; padding:0px;">
<table width="837" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
	    <td>
		    <div style="width:100%; height:155px; margin:0px;background:url(images/login_04_01.png); padding:0px;"></div>
		    <div style="width:100%;background:url(images/login_04_02_web.png); height:105px; margin:0px; padding:0px;"></div>
		    <div style="width:100%; height:143px; background:url(images/login_04_03.png); margin:0px; padding:0px;">
		     <!-------------*****************************----->
		     <div style="margin-left:253px; height:135px;">
		    	<div style="width:240px; height:110px; margin-top:20px; float:left;">
		        	<div style="margin-top:20px; margin-left:15px; color:#C4C4c4;">用 户：
		        		<input type="text" name="username" id="username" style="width:140px; height:17px; background-color:#87adbf; border:solid 1px #153966; font-size:12px; color:#283439;" />
		        	</div>
		        	<div style="margin-top:20px; margin-left:15px; color:#C4C4c4;">密 码：
		        		<input type="password" name="userpass" id="userpass" style="width:140px; height:17px; background-color:#87adbf; border:solid 1px #153966; font-size:12px; color:#283439;" />
		        	</div>
		        </div>
		        <!-------------*****************************----->
		        <div style="width:80px; height:80px; float:left;margin-left:28px; margin-top:33px;">
		        	<div style="margin-left:10px; margin-top:15px;"><input type="button" style="width:57px; height:20px; padding:0px; background:url(images/reg.gif); margin:0px; border:0px; cursor:pointer;" value="" name="register" id="register" /></div>
		            <div style="margin-left:10px; margin-top:10px;"><input type="button" style="width:57px; height:20px; padding:0px; background:url(images/login.gif); margin:0px; border:0px; cursor:pointer;" value="" name="login" id="login" /></div>
		        </div>
		      </div>
		      <!-------------*****************************----->
		    </div>
		    <div style="width:100%; height:173px; background:url(images/login_04_04.png); margin:0px; padding:60px 0px 00px 0px;"></div>
	    </td>
	</tr>
</table>
</form>
</body>
</html>