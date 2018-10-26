<?php
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
//取得客票号
$strsqlselet = "SELECT `tp_CurrentTicket`,`tp_InceptTicketNum`,tp_EndTicket FROM `tms_bd_TicketProvide` WHERE `tp_InceptUserID` = '$userID'
	AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '客票' ORDER BY tp_ProvideData ASC";
$resultselet = $class_mysql_default->my_query("$strsqlselet");
$rowsticket = @mysqli_fetch_array($resultselet);

//取得保险票号
$strsqlselet = "SELECT `tp_CurrentTicket`,`tp_InceptTicketNum`,tp_EndTicket FROM `tms_bd_TicketProvide` WHERE `tp_InceptUserID` = '$userID'
	AND	`tp_InceptTicketNum` > 0 AND `tp_Type` = '保险票' ORDER BY tp_ProvideData ASC";
$resultselet = $class_mysql_default->my_query("$strsqlselet");
$rowssafe = @mysqli_fetch_array($resultselet);
	if (empty($rowsticket[0])&&!empty($rowssafe[0])) {
		echo "<script>if (!confirm('没有可用的客票票据！是否继续？')) location.assign('tms_v1_sell_query.php');</script>";
	}
	if (empty($rowssafe[0])&&!empty($rowsticket[0])) {
		echo "<script>if (!confirm('没有可用的保险票票据！是否继续？')) location.assign('tms_v1_sell_query.php');</script>";
	}
	if (empty($rowssafe[0])&&empty($rowsticket[0])) {
		echo "<script>alert('没有可用的客票和保险票票据！');location.assign('tms_v1_sell_query.php');</script>";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>重置客/保险票界面</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" >
		$(document).ready(function(){
			document.getElementById("resetticketno").focus();
			$("#resetticket").click(function(){
				testing();
			});
			document.getElementById("resetticketno").onkeydown = function (event){
				 var e = event || window.event || arguments.callee.caller.arguments[0];
		         if (e && e.keyCode == 13) {
					document.getElementById("resetsafeticketno").focus();
		         }
			};
			document.getElementById("resetsafeticketno").onkeydown = function (event){
				 var e = event || window.event || arguments.callee.caller.arguments[0];
		         if (e && e.keyCode == 13) {
					document.getElementById("resetreason").focus();
		         }
			};
			document.getElementById("resetreason").onkeydown = function (event){
				 var e = event || window.event || arguments.callee.caller.arguments[0];
		         if (e && e.keyCode == 13) {
					document.getElementById("resetticket").focus();
		         }
			};
			document.getElementById("resetticket").onkeydown = function (event){
				 var e = event || window.event || arguments.callee.caller.arguments[0];
		         if (e && e.keyCode == 13) {
		        	 testing();
		         }
			};
			document.onkeydown = function (event) {
		  		var e = event || window.event || arguments.callee.caller.arguments[0];
		     	if (e && e.keyCode == 16) {
		     		document.getElementById("cancel").focus();
		     	}
		   	};
		   	document.getElementById("cancel").onkeydown = function (event){
				 var e = event || window.event || arguments.callee.caller.arguments[0];
		         if (e && e.keyCode == 13) {
		        	 document.getElementById("resetticketno").value='';
		        	 document.getElementById("resetsafeticketno").value='';
		        	 document.getElementById("resetreason").value='';
		        	 document.getElementById("resetticketno").focus(); 
		         }
			};
		});
		function testing(){
			if(document.getElementById("resetticketno").value=='' && document.getElementById("resetsafeticketno").value==''){
				alert('请输入重置的客票号或保险票号！');
				document.getElementById("resetticketno").focus();
				return false;
			}
			if(document.getElementById("resetticketno").value!=''){
				if(document.getElementById("resetticketno").value.length!=document.getElementById("ticketno").value.length){
					alert("重置客票票号位数不对！");
					document.getElementById("resetticketno").focus();
					return false;
				}
				if(parseInt(document.getElementById("resetticketno").value)>parseInt(document.getElementById("endticketno").value)+1){
					alert("重置客票票号大于结束票号"+document.getElementById("endticketno").value);
					document.getElementById("resetticketno").value='';
					document.getElementById("resetticketno").focus();
					return false;
				}
				if(parseInt(document.getElementById("resetticketno").value)<=parseInt(document.getElementById("ticketno").value)){
					alert("重置客票票号不能小于等于当前客票号"+document.getElementById("ticketno").value);
					document.getElementById("resetticketno").value='';
					document.getElementById("resetticketno").focus();
					return false;
				}
			}
			if(document.getElementById("resetsafeticketno").value!=''){
				if(document.getElementById("resetsafeticketno").value.length!=document.getElementById("safeticketno").value.length){
					alert("重置保险票票号位数不对！");
					document.getElementById("resetsafeticketno").focus();
					return false;
				}
				if(parseInt(document.getElementById("resetsafeticketno").value)>parseInt(document.getElementById("endsafeticketno").value)+1){
					alert("重置保险票票号大于结束票号"+document.getElementById("endsafeticketno").value);
					document.getElementById("resetsafeticketno").value='';
					document.getElementById("resetsafeticketno").focus();
					return false;
				}
				if(parseInt(document.getElementById("resetsafeticketno").value)<=parseInt(document.getElementById("safeticketno").value)){
					alert("重置保险票票号不能小于等于当前保险票票号"+document.getElementById("safeticketno").value);
					document.getElementById("resetsafeticketno").value='';
					document.getElementById("resetsafeticketno").focus();
					return false;
				}
			}
			if(document.getElementById("resetreason").value==''){
				alert("重置票号原因不能为空！");
				document.getElementById("resetreason").focus();
				return false;
				}
			if(document.getElementById("resetticketno").value!=''&&document.getElementById("resetsafeticketno").value==''){
				if(!confirm("确认将当前客票号:"+document.getElementById("ticketno").value+" 重置到 "+document.getElementById("resetticketno").value+"？")){
					return false;
				}
			}
			if(document.getElementById("resetsafeticketno").value!=''&&document.getElementById("resetticketno").value==''){
				if(!confirm("确认将当前保险票号:"+document.getElementById("safeticketno").value+" 重置到 "+document.getElementById("resetsafeticketno").value+"？")){
					return false;
				}
			}
			if(document.getElementById("resetsafeticketno").value!=''&&document.getElementById("resetticketno").value!=''){
				if(!confirm("确认将当前客票号:"+document.getElementById("ticketno").value+" 重置到 "+document.getElementById("resetticketno").value
						+"，\r将当前保险票号:"+document.getElementById("safeticketno").value+" 重置到 "+document.getElementById("resetsafeticketno").value+"？")){
					return false;
				}
			}
			document.form1.submit();
		} 

		function AddOther(url) {                  
			window.open(url,'重置票号原因','width=600,height=500,location=no');
		}
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">重 置 客/保 险 票 界 面</span></td>
  </tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />当前客票号：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">
    	<input type="text" name="ticketno" id="ticketno" readonly="readonly" value="<?php echo $rowsticket['tp_CurrentTicket'];?>"/>
    	<input type="hidden" name="endticketno" id="endticketno" value="<?php echo $rowsticket['tp_EndTicket'];?>"/>
    </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />当前保险票号：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">
    	<input type="text" name="safeticketno" id="safeticketno" readonly="readonly" value="<?php echo $rowssafe['tp_CurrentTicket'];?>"/>
    	<input type="hidden" name="endsafeticketno" id="endsafeticketno" readonly="readonly" value="<?php echo $rowssafe['tp_EndTicket'];?>"/>
    </td>
  </tr>
  <tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />重置客票号：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="resetticketno" id="resetticketno"  value=""/></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />重置保险票号：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="resetsafeticketno" id="resetsafeticketno" value=""/></td>
  </tr>
  <tr >
    <td nowrap="nowrap" bgcolor="#FFFFFF" colspan="4" align="left"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />重置原因：</span>
	<input type="text" name="resetreason" id="resetreason" size="50"/>
    <input type="button" name="reasonbutton" value="..." style="background-color:#CCCCCC" onclick="AddOther('tms_v1_sell_resetreason.php')"/>
	<span style="color:red">*</span></td>
  </tr>
  <tr>
    <td align="center" colspan="4" bgcolor="#FFFFFF">
    	<input id="resetticket" name="resetticket" type="button" value="重置" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	<input id="cancel" name="cancel" type="reset" value="取消" />
    </td>
  </tr>
</table>
</form>
</body>
</html>
<?php 
	if(isset($_POST['resetticketno'])){
		$ticketno=$_POST['ticketno'];
		$safeticketno=$_POST['safeticketno'];
		$resetticketno=$_POST['resetticketno'];
		$resetsafeticketno=$_POST['resetsafeticketno'];
		$resetreason=$_POST['resetreason'];
		$endticket=$resetticketno-1;
		$ticketnum=$resetticketno-$ticketno;
		$endsafeticket=$resetsafeticketno-1;
		$safeticketnum=$resetsafeticketno-$safeticketno;
		$CurTime=date('Y-m-d');
		$class_mysql_default->my_query("START TRANSACTION");
		if($resetticketno!=''){
			$updateticket="UPDATE tms_bd_TicketProvide SET tp_CurrentTicket='{$resetticketno}', tp_InceptTicketNum=(tp_EndTicket+0)-('{$resetticketno}'+0)+1
				WHERE tp_CurrentTicket='{$ticketno}' AND tp_Type = '客票' AND tp_InceptUserID = '$userID'";
			$queryupdate= $class_mysql_default->my_query("$updateticket");
			
			$insert="INSERT INTO `tms_sell_ResetTicket` (`rt_ID`,`rt_ResetUserID`,`rt_ResetUser`,`rt_UserSation`,`rt_ResetDate`,`rt_BeginTicket`,`rt_CurrentTicket`,`rt_EndTicket`,`rt_InceptTicketNum`,`rt_Type`,`rt_Remark`) VALUES 
				('', '{$userID}','{$userName}','{$userStationName}','{$CurTime}','{$ticketno}','{$ticketno}','{$endticket}','{$ticketnum}','客票','{$resetreason}')";
			$query = $class_mysql_default->my_query($insert);
			if($queryupdate&&$query){
				$class_mysql_default->my_query("COMMIT");
				echo "<script>alert('客票重置成功！')</script>";
			}else{
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('客票重置失败！')</script>";
			}
		}
		if($resetsafeticketno!=''){
			$updateticket1="UPDATE tms_bd_TicketProvide SET tp_CurrentTicket='{$resetsafeticketno}', tp_InceptTicketNum=(tp_EndTicket+0)-('{$resetsafeticketno}'+0)+1
				WHERE tp_CurrentTicket='{$safeticketno}' AND tp_Type = '保险票' AND tp_InceptUserID = '$userID'";
			$queryupdate1= $class_mysql_default->my_query("$updateticket1");
			
			$insert1="INSERT INTO `tms_sell_ResetTicket` (`rt_ID`,`rt_ResetUserID`,`rt_ResetUser`,`rt_UserSation`,`rt_ResetDate`,`rt_BeginTicket`,`rt_CurrentTicket`,`rt_EndTicket`,`rt_InceptTicketNum`,`rt_Type`,`rt_Remark`) VALUES 
				('', '{$userID}','{$userName}','{$userStationName}','{$CurTime}','{$safeticketno}','{$safeticketno}','{$endsafeticket}','{$safeticketnum}','保险票','{$resetreason}')";
			$query1 = $class_mysql_default->my_query($insert1);
			if($queryupdate1&&$query1){
				$class_mysql_default->my_query("COMMIT");
				echo "<script>alert('保险票重置成功！')</script>";
			}else{
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('保险票重置失败！')</script>";
			}
		}
		$class_mysql_default->my_query("END TRANSACTION");
		echo "<script>location.assign('tms_v1_sell_resettingticket.php');</script>";
	}
?>