<?php
/*
 * 用户查询管理页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>用户查询管理</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../css/tms.css" rel="stylesheet" type="text/css" />
		<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../js/jquery.js"></script>		
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script>
		$(document).ready(function(){
			$("#adduser").click(function(){
				document.adduser.submit();
			});
			$("#moduser").click(function(){
				if(document.getElementById("ui_modUserID").value==""){
					alert('请选择用户信息');
					return false;
					}
				else{
					document.moduser.submit();
					}
			});
			$("#deluser").click(function(){
				if(document.getElementById("ui_delUserID").value==""){
					alert('请选择用户信息');
					return false;
					}
				else{
				document.deluser.submit();
				}
			});
			$("#table1").tablesorter();
			$("#table1 tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
			$("#table1 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$("#table1 tr").click(function(){
				$("#table1 tr:not(this)").css("background-color","#CCCCCC");
				$("#table1 tr:not(this)").mouseover(function(){$(this).css("background-color","#F1E6C2");});
				$("#table1 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
				$(this).css("background-color","#FFCC00");
				$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
				$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
				$("#ui_modUserID").val($(this).children().eq(0).text());
				$("#ui_delUserID").val($(this).children().eq(0).text());
			});
		});
		</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#F0F8FF">
					<img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 用 户 信 息 查 询</span>
				</td>
			</tr>
		</table>
		<form action="" method="post" name="form1">
		<table width="100%" align="center" border="1" cellpadding="3" cellspacing="1" style=”TABLE-LAYOUT:fixed”>
			<tr>
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站：</span>
					<select id="stationselect" name="stationselect" size="1">
					<?php
		            	if($userStationID == "all") {
		            ?>
						<option value="" selected="selected">请选择车站</option>
					<?php 
							$queryString = "SELECT sset_SiteID,sset_SiteName FROM tms_bd_SiteSet WHERE sset_IsStation=1";
							$result = $class_mysql_default->my_query("$queryString");
					        while($res = mysql_fetch_array($result)) {
			            		if($res['sset_SiteName']) {
					?>
		            	<option value="<?php echo $res['sset_SiteName'];?>"><?php echo $res['sset_SiteName'];?></option>
		            <?php 
								}
							}
		            	}
		            	else {
		            ?>
						<option value="<?php echo $userStationName;?>" selected="selected"><?php echo $userStationName;?></option>
					<?php
		            	}
					?>
					</select>
				</td>
				<td align="left" nowrap="nowrap" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 用户属组：</span>
					<select id="groupselect" name="groupselect" size="1">
						<option value="" selected="selected">请选择属组</option>
					<?php 
							$queryString = "SELECT DISTINCT ui_UserGroup FROM tms_sys_UsInfor WHERE ui_UserID != 'admin'";
							$result = $class_mysql_default->my_query("$queryString");
					        while($res = mysql_fetch_array($result)) {
			            		if($res['ui_UserGroup']) {
					?>
		            	<option value="<?php echo $res['ui_UserGroup'];?>"><?php echo $res['ui_UserGroup'];?></option>
		            <?php 
								}
							}
		            ?>
					</select>
				</td>
				<td nowrap="nowrap" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 用户ID：&nbsp;&nbsp;&nbsp;</span>
					<input type="text" name="queryUserID" id="queryUserID" value="" />
				</td>
			</tr>
			<tr>
				<td colspan="4" align="center" nowrap="nowrap" bgcolor="#FFFFFF">
				<input type="submit" name="resultquery" value="用户查询" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" id="adduser" name="adduser" value="用户添加"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" id="moduser" name="moduser" value="用户修改"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" id="deluser" name="deluser" value="用户删除"/>
				</td>
			</tr>
		</table>
		<div id="tableContainer" class="tableContainer"> 
		<table class="main_tableboder" id="table1" > 
		<thead class="fixedHeader"> 
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">用户ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">用户姓名</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">用户属组</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">属组ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">所属车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车站ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">操作员ID</th>
			</tr>
		</thead>
		<tbody class="scrollContent">
		<?php
			if(isset($_POST['resultquery']) || isset($_GET['ADDDONE']) || isset($_GET['MODDONE']) || isset($_GET['DELDONE'])) {
				if($userID=="admin"){
				if ($_POST['stationselect'] == ""){
					$queryStationName = "%";
				}
				else{
					$queryStationName=$_POST['stationselect'];
					}
				}
				else{
					$queryStationName=$userStationName;	
				}
				if (($queryGroup = $_POST['groupselect']) == "")
				
					$queryGroup = "%";
				if (($queryUserID = $_POST['queryUserID']) == "")
					$queryUserID = "%";
				//	echo $queryUserID;
					//echo $queryGroup;
					//echo $queryStationName;
				$queryString = "SELECT * FROM tms_sys_UsInfor WHERE ui_UserSation LIKE '{$queryStationName}' AND ui_UserGroup LIKE '%$queryGroup%' AND ui_UserID LIKE '{$queryUserID}'";
				//echo $queryString;
				$result = $class_mysql_default->my_query("$queryString");
				while ($row = mysql_fetch_array($result)) {
					if($row['ui_UserID'] != "admin") {
		?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row['ui_UserID'];?></td>
				<td nowrap="nowrap"><?php echo $row['ui_UserName'];?></td>
				<td nowrap="nowrap"><?php echo $row['ui_UserGroup'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['ui_UserGroupID'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['ui_UserSation'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['ui_UserSationID'];?></td>
				<td nowrap="nowrap"><?php echo $row['ui_Remark'];?></td>
				<td nowrap="nowrap"><?php echo $row['ui_opUserID'];?></td>
			</tr>
		<?php
					}
				}
			}
		?>   
		</tbody>
		</table>
		</div>
		</form>
		<form action="tms_v1_system_usermodify.php" method="post" name="moduser">
			<input type="hidden" id="ui_modUserID" value="" name="ui_modUserID" />
			<input type="hidden" id="ui_opUserID" value="<?php echo $userID;?>" name="ui_opUserID" />
			<input type="hidden" id="ui_opUserSation" value="<?php echo $userStationName;?>" name="ui_opUserSation" />
			<input type="hidden" id="ui_opUserSationID" value="<?php echo $userStationID;?>" name="ui_opUserSationID" />
		</form>
		<form action="tms_v1_system_userdel.php" method="post" name="deluser">
			<input type="hidden" id="ui_delUserID" value="" name="ui_delUserID" />
		</form>
		<form action="tms_v1_system_useradd.php" method="post" name="adduser">
			<input type="hidden" id="ui_opUserID" value="<?php echo $userID;?>" name="ui_opUserID" />
			<input type="hidden" id="ui_opUserSation" value="<?php echo $userStationName;?>" name="ui_opUserSation" />
			<input type="hidden" id="ui_opUserSationID" value="<?php echo $userStationID;?>" name="ui_opUserSationID" />
		</form>
	</body>
</html>
