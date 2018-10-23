<?php
/*
 * 用户信息修改页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$ui_UserID = $_POST['ui_modUserID'];
$queryString3 = "SELECT ui_UserGroupID FROM tms_sys_UsInfor WHERE ui_UserID = '{$ui_UserID}'";
$result3 = $class_mysql_default->my_query("$queryString3");
$row3 = mysql_fetch_array($result3);
if(isset($_POST['sureMod'])) {
	function creatNewConfigFile($ugid) {
		$menuType = '$menu_type = array(';
		$menuItem = '$menu_item = array(';
		$menuHref = '$menu_href = array(';
		$menuTitle = '$menu_title = array(';
		$menuSrc = '$menu_src = array(';
		$dstFile = "../ui/user/config";
		$gids = array();
		foreach(explode("|", trim($ugid, "|")) as $gid) {
			$srcFile = "../ui/user/config" . $gid . ".tpl.txt";
			$contentSrc = file($srcFile);
			$menuType = $menuType . trim($contentSrc[0]) . ",";
			$menuItem = $menuItem . trim($contentSrc[1]) . ",";
			$menuHref = $menuHref . trim($contentSrc[2]) . ",";
			$menuTitle = $menuTitle . trim($contentSrc[3]) . ",";
			$menuSrc = $menuSrc . trim($contentSrc[4]) . ",";
			$dstFile = $dstFile . $gid;
		}
		$menuType = trim($menuType, ",") . ");";
		$menuItem = trim($menuItem, ",") . ");";
		$menuHref = trim($menuHref, ",") . ");";
		$menuTitle = trim($menuTitle, ",") . ");";
		$menuSrc = trim($menuSrc, ",") . ");";
		$contentDst = "<?php" . "\n$menuType\n" . "$menuItem\n" . "$menuHref\n" . "$menuTitle\n" . "$menuSrc\n" . "?>";
		$dstFile = $dstFile . ".inc.php";
		file_put_contents($dstFile, mb_convert_encoding ($contentDst,'UTF-8','GBK'));
	}

	$ui_oldUserID = $_POST['ui_oldUserID'];
	$ui_UserID = $_POST['ui_UserID'];
	$ui_oldPass = $_POST['ui_oldPass'];
	$ui_newPass = $_POST['ui_UserPassword'];
	if($ui_newPass == $ui_oldPass) {
		$ui_UserPassword = $ui_oldPass;
	}
	else {
		$ui_UserPassword = md5($ui_newPass);
	}
	$ui_UserName = $_POST['ui_UserName'];
	$ui_UserGroup = $_POST['ui_UserGroup'];
	$ugid = $_POST['ui_UserGroupID'];
	$ui_UserGroupID = "";
	foreach(explode("|", trim($ugid, "|")) as $gid) {
		$ui_UserGroupID = $ui_UserGroupID . $gid;
	}
	$ui_UserSation = $_POST['ui_UserSation'];
	$ui_UserSationID = $_POST['stationselect'];
	$ui_Remark = $_POST['ui_Remark'];
	$ui_opUserID = $_POST['ui_opUserID'];
	
	$queryString2 = "SELECT ui_UserGroup,ui_UserGroupID FROM tms_sys_UsInfor WHERE ui_UserID = '{$ui_UserID}'";
	$result2 = $class_mysql_default->my_query("$queryString2");
	$row2 = mysql_fetch_array($result2);
	
	
	$queryString = "UPDATE tms_sys_UsInfor SET ui_UserID = '{$ui_UserID}', ui_UserName = '{$ui_UserName}', 
				ui_UserGroup = '{$ui_UserGroup}', ui_UserGroupID = '{$ui_UserGroupID}', ui_UserSation = '{$ui_UserSation}', 
				ui_UserSationID = '{$ui_UserSationID}', ui_Remark = '{$ui_Remark}', ui_opUserID = '{$ui_opUserID}' WHERE ui_UserID = '{$ui_oldUserID}'"; 
	
	if($class_mysql_default->my_query("$queryString")) {
		$configFile = "../ui/user/config" . $ui_UserGroupID . ".inc.php";
		if(!file_exists($configFile)) creatNewConfigFile($ugid);
		echo "<script>alert('用户信息修改成功!');window.location.href='tms_v1_system_userquery.php?MODDONE=1';</script>";
	}
	else {
		echo "<script>alert('用户信息修改失败!请重试。');location.assign('tms_v1_system_userquery.php?MODDONE=1');</script>";
	}
}
else {
	$ui_UserID = $_POST['ui_modUserID'];
	$ui_opUserID = $_POST['ui_opUserID'];
	$stationID = $_POST['ui_opUserSationID'];
	$stationName = $_POST['ui_opUserSation'];
	$queryString = "SELECT ui_UserPassword,ui_UserName,ui_Remark,ui_UserSation FROM tms_sys_UsInfor WHERE ui_UserID = '{$ui_UserID}'";
	$result = $class_mysql_default->my_query("$queryString");
	$row = mysql_fetch_array($result);
	$ui_UserPassword = $row['ui_UserPassword'];
	$ui_UserName = $row['ui_UserName'];
	$ui_Remark = $row['ui_Remark'];
	$ui_UserSation = $row['ui_UserSation'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>用户信息修改</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../css/style_main.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>	
		<script>
	$(document).ready(function(){
			$("#ui_UserPassword").keyup(function(){
				document.getElementById("passwordok").value="";
			});
		});
	$(document).ready(function(){
		//	var arrValue = new Array();
			var groupid=document.getElementById("groupid").value;
		//	var arrValue[arrValue.length] = document.getElementById("groupselect").options;
			var o = document.form1.groupselect;
			var op=document.getElementById("groupselect");
			s="";
			var ss=groupid.split("");
			for(i=0;i<ss.length;i++){
				for(j=0;j<o.options.length;j++){
				if(o.options[j].value == ss[i]){
				op.options[j].selected=true;
					}
				}
		}
			
		});
		</script>
	</head>
	<body>
		<form action="" method="post" name="form1" onsubmit="return submitResult();">
		<table width="50%" border="1" align="center" cellpadding="4" cellspacing="1" >
  			<tr>
    			<td bgcolor="#0083B5" nowrap="nowrap" colspan="2"><span class="form_title" style="color:white;"><img src="../ui/images/sj.gif" width="6" height="7" /> 修 改 用 户 信 息</span></td>
  			</tr>
			<tr>
				<td style="width:20%" nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 用户ID：</span></td>
				<td nowrap="nowrap" ><input style="width:100%" type="text" id="ui_UserID" name="ui_UserID" value="<?php echo $ui_UserID;?>" /></td>
			</tr>
			<!--<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 用户密码：</span></td>
				<td><input style="width:100%" type="password" id="ui_UserPassword" name="ui_UserPassword" value="<?php echo $ui_UserPassword;?>" /></td>
			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 确认密码：</span></td>
				<td><input style="width:100%" type="password" id="passwordok" name="passwordok" value="<?php echo $ui_UserPassword;?>" /></td>
			</tr>
			-->
			<tr>
				<td align="left" nowrap="nowrap"  bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 用户姓名：</span></td>
				<td nowrap="nowrap" ><input style="width:100%" type="text" id="ui_UserName" name="ui_UserName" value="<?php echo $ui_UserName;?>" /></td>
			</tr>
			<tr>
				<td align="left" nowrap="nowrap"  bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 用户属组：</span></td>
				<td nowrap="nowrap" >
					<select id="groupselect" name="groupselect" style="height:160px" size="10" multiple="multiple">
						<option value="0" >管理员组</option>
		            	<option value="1" >基础数据组</option>
		            	<option value="2">售票组</option>
		            	<option value="3">检票组</option>
		            	<option value="4">调度组</option>
		            	<option value="5">财务组</option>
		            	<option value="6">安检组</option>
		            	<option value="7">行包组</option>
		            	<option value="8">查询统计组</option>
		            	<option value="9">包车组</option>
		            	<option value="A">客服组</option>
					<!-- <option value="B">卫生组</option>  -->
		            <!-- <option value="C">稽查组</option>  -->
		            <!-- <option value="D">寄存组</option>  -->
			            <option value="E">票据组</option>
					</select>
					<input type="hidden" id=groupid value="<?php echo $row3['ui_UserGroupID']?>" />
				<span style="color:red;">*长按crtl键可选择多组用户</span></td>
			</tr>
			<tr>
				<td align="left" nowrap="nowrap"  bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站：</span></td>
				<td nowrap="nowrap" >
					<select id="stationselect" name="stationselect" size="1">
					<?php
		            	if($stationID == "all") {
		            ?>
					<?php 
							$queryString = "SELECT sset_SiteID,sset_SiteName FROM tms_bd_SiteSet WHERE sset_IsStation=1";
							$result = $class_mysql_default->my_query("$queryString");
					        while($res = mysql_fetch_array($result)) {
							if($ui_UserSation==$res['sset_SiteName']){
					      ?>
		            	<option value="<?php echo $res['sset_SiteID'];?>" selected="selected" ><?php echo $res['sset_SiteName'];?></option>
					<?php 
							}
							else{
								?>
								<option value="<?php echo $res['sset_SiteID'];?>"><?php echo $res['sset_SiteName'];?></option>
								<?php 
							}
					        }
					?>
						<!-- <option value="all">全部车站</option> not used at this moment -->
					<?php
		            	}
		            	else {
		            ?>
						<option value="<?php echo $stationID;?>" selected="selected"><?php echo $stationName;?></option>
					<?php
		            	}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="left" nowrap="nowrap"  bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 备注：</span></td>
				<td nowrap="nowrap" ><input style="width:100%" type="text" id="ui_Remark" name="ui_Remark" value="<?php echo $ui_Remark;?>" /></td>
			</tr>
			<tr>
				<td colspan='2' align="center" nowrap="nowrap"  bgcolor="#FFFFFF">
					<input type="submit" name="sureMod" value="确认修改" onclick="return checkInfo()" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" value="取消" onclick="location.assign('tms_v1_system_userquery.php?MODDONE=1');" />
				</td>
			</tr>
			<tr style="border:0px;" bgcolor="#ffffff">
				<td colspan="2" nowrap="nowrap"  style="border:0px;">
					<input type="hidden" id="ui_UserGroupID" value="" name="ui_UserGroupID" />
					<input type="hidden" id="ui_UserGroup" value="" name="ui_UserGroup" />
					<input type="hidden" id="ui_UserSation" value="" name="ui_UserSation" />
					<input type="hidden" id="ui_opUserID" value="<?php echo $ui_opUserID;?>" name="ui_opUserID" />
					<input type="hidden" id="ui_oldUserID" value="<?php echo $ui_UserID;?>" name="ui_oldUserID" />
					<input type="hidden" id="ui_oldPass" value="<?php echo $ui_UserPassword;?>" name="ui_oldPass" />
				</td>
			</tr>
		</table>
		</form>
		<script>
		
		function checkInfo()
		{
			if (document.form1.ui_UserID.value == ""){
				alert("请输入用户ID!");
				document.form1.ui_UserID.focus();
				return false;
			}
			if (document.form1.ui_UserPassword.value == ""){
				alert("请输入用户密码!");
				document.form1.ui_UserPassword.focus();
				return false;
			}
			if(document.getElementById("ui_UserPassword").value!=document.getElementById("passwordok").value){
				alert("输入密码不一致!");
				return false;
				}
			if (document.form1.ui_UserName.value == ""){
				alert("请输入用户姓名！");
				document.form1.ui_UserName.focus();
				return false;
			}
						
			if (document.form1.stationselect.value == "") {
				alert("请选择所属车站！");
				document.form1.stationselect.focus();
				return false;
			}				
		}
		function submitResult()
		{
			var thisSelect = document.getElementById("stationselect");
			document.getElementById("ui_UserSation").value = thisSelect.options[thisSelect.selectedIndex].text;
			thisSelect = document.getElementById("groupselect");
			var groupIDs="",groupNames="";
			for(var i = 0; i < thisSelect.options.length; i++)
			{ 
				if(thisSelect.options[i].selected)
				{
					groupIDs = groupIDs + thisSelect.options[i].value + "|";
					groupNames = groupNames + thisSelect.options[i].text + "|";
					if(i == 0) break;
				}
			}
			document.getElementById("ui_UserGroupID").value = groupIDs;
			document.getElementById("ui_UserGroup").value = groupNames;
		}
		</script>
	</body>
</html>
