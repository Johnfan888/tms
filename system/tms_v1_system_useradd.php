<?php
/*
 * 用户添加页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

//phpinfo();

if(isset($_POST['sureAdd'])) {
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
		file_put_contents($dstFile, mb_convert_encoding($contentDst,'UTF-8','GBK'));
	}
	
	$ui_UserID = $_POST['ui_UserID'];
	$ui_UserPassword = md5($_POST['ui_UserPassword']);
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
	$stationID = $_POST['ui_opUserSationID'];
	$stationName = $_POST['ui_opUserSation'];
	$queryString = "INSERT INTO tms_sys_UsInfor (ui_UserID, ui_UserPassword, ui_UserName, ui_UserGroup, ui_UserGroupID, ui_UserSation, 
				ui_UserSationID, ui_Remark, ui_opUserID) VALUES ('{$ui_UserID}', '{$ui_UserPassword}', '{$ui_UserName}', '{$ui_UserGroup}',
				'{$ui_UserGroupID}', '{$ui_UserSation}', '{$ui_UserSationID}', '{$ui_Remark}', '{$ui_opUserID}')"; 
	if($class_mysql_default->my_query("$queryString")) {
		$configFile = "../ui/user/config" . $ui_UserGroupID . ".inc.php";
		if(!file_exists($configFile)) creatNewConfigFile($ugid);
		//echo "<script>alert('用户添加成功!');location.assign('tms_v1_system_userquery.php');</script>";
		echo "<script>alert('用户添加成功!');</script>";
	}
	else {
		// die('Error: ' . mysql_error());
		echo "<script>alert('用户添加失败!');location.assign('tms_v1_system_userquery.php?ADDDONE=1');</script>";
	}
}
else {
	$ui_opUserID = $_POST['ui_opUserID'];
	$stationID = $_POST['ui_opUserSationID'];
	$stationName = $_POST['ui_opUserSation'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>添加用户</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../css/style_main.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<form action="" method="post" name="form1" onsubmit="return submitResult();">
		<table width="50%" border="1" align="center" cellpadding="4" cellspacing="1" >
  			<tr>
    			<td bgcolor="#0083B5" colspan="2" nowrap="nowrap"><span class="form_title" style="color:white;" ><img src="../ui/images/sj.gif" width="6" height="7" /> 添 加 用 户 信 息</span></td>
  			</tr>
			<tr bgcolor="#FFFFFF">
				<td style="width:20%" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 用户ID：</span></td>
				<td nowrap="nowrap"><input style="width:100%" type="text" id="ui_UserID" name="ui_UserID" value="" /></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 用户密码：</span></td>
				<td nowrap="nowrap"><input style="width:100%" type="password" id="ui_UserPassword" name="ui_UserPassword" value="" /></td>
			</tr>
			<tr bgcolor="#FFFFFF" >
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 确认密码：</span></td>
				<td nowrap="nowrap"> <input style="width:100%" type="password" id="passwordok" name="passwordok" value="" /></td>
			</tr>
			<tr bgcolor="#FFFFFF" >
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 用户姓名：</span></td>
				<td nowrap="nowrap"><input style="width:100%" type="text" id="ui_UserName" name="ui_UserName" value="" /></td>
			</tr>
			<tr bgcolor="#FFFFFF" >
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 用户属组：</span>
				</td>
				<td nowrap="nowrap" >
					<select id="groupselect" name="groupselect" style="height:160px" size="10" multiple="multiple">
				<!-- 	<option value="" selected="selected">请选择属组</option> -->
						<option value="0">管理员组</option>
		            	<option value="1">基础数据组</option>
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
				<span style="color:red;">*长按crtl键可选择多组用户</span></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td align="left"  nowrap="nowrap" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站：</span>
				</td>
				<td nowrap="nowrap" >
					<select id="stationselect" name="stationselect" size="1">
					<?php
		            	if($stationID == "all") {
		            ?>
						<option value="" selected="selected">请选择车站</option>
					<?php 
							$queryString = "SELECT sset_SiteID,sset_SiteName FROM tms_bd_SiteSet WHERE sset_IsStation=1";
							$result = $class_mysql_default->my_query("$queryString");
					        while($res = mysql_fetch_array($result)) {
					?>
		            	<option value="<?php echo $res['sset_SiteID'];?>"><?php echo $res['sset_SiteName'];?></option>
					<?php 
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
			<tr bgcolor="#FFFFFF">
				<td align="left"  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 备注：</span></td>
				<td nowrap="nowrap" ><input style="width:100%" type="text" id="ui_Remark" name="ui_Remark" value="" /></td>
			</tr>
			<tr>
				<td colspan='2' align="center" nowrap="nowrap" bgcolor="#FFFFFF">
					<input type="submit" name="sureAdd" value="确认添加" onclick="return checkInfo()" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" value="取消" onclick="location.assign('tms_v1_system_userquery.php?ADDDONE=1');" />
				</td>
			</tr>
			<tr style="border:0px;" bgcolor="#ffffff">
				<td nowrap="nowrap" style="border:0px;" bgcolor="#ffffff">
					<input type="hidden" id="ui_UserGroupID" value="" name="ui_UserGroupID" />
					<input type="hidden" id="ui_UserGroup" value="" name="ui_UserGroup" />
					<input type="hidden" id="ui_UserSation" value="" name="ui_UserSation" />
					<input type="hidden" id="ui_opUserID" value="<?php echo $ui_opUserID;?>" name="ui_opUserID" />
					<input type="hidden" id="ui_opUserSationID" value="<?php echo $stationID;?>" name="ui_opUserSationID" />
					<input type="hidden" id="ui_opUserSation" value="<?php echo $stationName;?>" name="ui_opUserSation" />
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
			if (document.form1.groupselect.value == "") {
				alert("请选择用户属组！");
				document.form1.groupselect.focus();
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
			var groupIDs = "", groupNames = "";
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
