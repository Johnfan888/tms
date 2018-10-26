<?php
/*
 * 登录页面
 */

require_once("inc/init.inc.php");
require_once("inc/templates.lang.php");
require_once("inc/fun.inc.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>用户登录</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../css/style_main.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script>
	$(document).ready(function(){
		$("#username").focus();
		$("#username").keydown(function(){
		   	document.onkeydown = function (event) {
		  		var e = event || window.event || arguments.callee.caller.arguments[0];
		     	if (e && e.keyCode == 13) {	
		    		if($("#username").val() == ""){
		    			alert('用户名不能为空！');
		    			$("#username").focus();
		    		}
		    		else
			    		$("#pass").focus();
		     	}
		   	};
		});
		$("#pass").keydown(function(){
		   	document.onkeydown = function (event) {
		  		var e = event || window.event || arguments.callee.caller.arguments[0];
		     	if (e && e.keyCode == 13) {	
		    		if($("#pass").val() == ""){
		    			alert('密码不能为空！');
		    			$("#pass").focus();
		    		}
		    		else
		    			document.form1.submit();
		     	}
		   	};
		});
		$("#login").click(function(){
    		if($("#username").val() == ""){
    			alert('用户名不能为空！');
    			$("#username").focus();
    		}
    		else if($("#pass").val() == ""){
    			alert('密码不能为空！');
    			$("#pass").focus();
    		}
    		else
    			document.form1.submit();
		});
	});
	</script>
</head>
<?php
$action = $_GET["action"];
if($action == "login")
{
?>
<body style="background:#CCCCCC; overflow:hidden;">
<form name="form1" action="group.php?action=login" method="post" style="margin:80px auto; text-align:center; padding:0px;">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
	    <td align="center">
		    <div style="width:100%; height:10%; margin:0px;background:url(images/login_04_01.png); padding:0px;"></div>
		    <div style="width:100%;background:url(images/login_04_02.png); height:105px; margin:0px; padding:0px;"></div>
		    <div style="width:100%; height:10%; background:url(images/login_04_03.png); margin:0px; padding:0px;">
		     <!-------------*****************************----->
		     <div style="margin-left:253px; height:135px;">
		    	<div style="width:240px; height:110px; margin-top:20px; float:left;">
		        	<div style="margin-top:20px; margin-left:15px; color:#C4C4c4;">用 户：
		        		<input type="text" name="username" id="username" style="width:140px; height:17px; background-color:#87adbf; border:solid 1px #153966; font-size:12px; color:#283439;" />
		        	</div>
		        	<div style="margin-top:20px; margin-left:15px; color:#C4C4c4;">密 码：
		        		<input type="password" name="pass" id="pass" style="width:140px; height:17px; background-color:#87adbf; border:solid 1px #153966; font-size:12px; color:#283439;" />
		        	</div>
		        </div>
		        <!-------------*****************************----->
		        <div style="width:80px; height:10%; float:left;margin-left:28px; margin-top:33px;">
		        	<div style="margin-left:10px; margin-top:15px;"><input type="reset" style="width:57px; height:20px; padding:0px; background:url(images/cz.gif); margin:0px; border:0px; cursor:pointer;" value="" name="clear" id="clear" /></div>
		            <div style="margin-left:10px; margin-top:10px;"><input type="button" style="width:57px; height:20px; padding:0px; background:url(images/dl.gif); margin:0px; border:0px; cursor:pointer;" value="" name="login" id="login" /></div>
		        </div>
		      </div>
		      <!-------------*****************************----->
		    </div>
		    <div style="width:100%; height:173px; background:url(images/login_04_04.png); margin:0px; padding:60px 0px 00px 0px;">
		    	<!-- 
		    	<div style="width:200px; height:50px; margin-left:290px; ">
		    		<div style="text-align:center; height:30px; width:300px; margin:0 auto; margin-top:10px;">
						<div style="width:100px; height:20px; float:left; margin-top:9px; font-family:黑体; font-weight:bold; color:#c4c4c4">Powered by</div>
				
					<div style="float:left; margin-left:5px;"><a href="http://www.chd.edu.cn" target="_blank"><img src="images/default/logo.png" alt="程序：长安大学" border="0" /></a></div>
					</div>
		 		</div>
				-->	
		    </div>
	    </td>
	</tr>
</table>
</form>
</body>
</html>
<?php
}
else 
{
	funmessage("login2.php?action=login", $templang['grouperror'], $backtime);
	exit();
}
?>