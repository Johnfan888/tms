<?php
/*
 * 用户查询管理页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$UserState=$_POST['UserState'];
$groupselect=$_POST['groupselect'];
$stationselect=$_POST['stationselect'];
$queryUserID=$_POST['queryUserID'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>在线用户查询</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>		
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/tms_v1_close.js"></script>
		<script>
		$(document).ready(function(){
			$("#adduser").click(function(){
				document.adduser.submit();
			});
			$("#moduser").click(function(){
				document.moduser.submit();
			});
			$("#deluser").click(function(){
				document.deluser.submit();
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
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">			
			<tr>
				<td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span  style="margin-left:8px;"> 在 线 用 户 查 询</span>	</td>
			</tr>
		</table>
					
		<form action="" method="post" name="form1">
		<table width="100%" align="center" border="1" cellpadding="3" cellspacing="1" style=”TABLE-LAYOUT:fixed”>
			<tr>
				<td align="left" nowrap="nowrap"  bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站：</span>
					<select id="stationselect" name="stationselect" size="1">
					<?php
		            	if($userStationID == "all") {
		            		if($stationselect==''){
		            ?>
						<option value="" selected="selected">请选择车站</option>
					<?php 
		            		}else{
		            ?>
		            	<option value="<?php echo $stationselect;?>" selected="selected"><?php echo $stationselect;?></option>
		            	<option value="">请选择车站</option>
		            <?php 			
		            		}
							$queryString = "SELECT sset_SiteID,sset_SiteName FROM tms_bd_SiteSet WHERE sset_IsStation=1";
							$result = $class_mysql_default->my_query("$queryString");
					        while($res = mysql_fetch_array($result)) {					                
			            		if($res['sset_SiteName']!=$stationselect) {
			            		        
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
				<td align="left" nowrap="nowrap"  bgcolor="#FFFFFF" colspan="2">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 用户属组：</span>
					<select id="groupselect" name="groupselect" size="1">
						<?php if($groupselect==''){?>
							<option value="" selected="selected">请选择属组</option>
						<?php 
							}else{
						?>
							<option value="<?php echo $groupselect;?>" selected="selected"><?php echo $groupselect;?></option>
							<option value="" >请选择属组</option>
						
					<?php 	
							}				        
							$queryString = "SELECT DISTINCT ui_UserGroup FROM tms_sys_UsInfor WHERE ui_UserID != 'admin'";
							$result = $class_mysql_default->my_query("$queryString");
					        while($res = mysql_fetch_array($result)) {$userGroup = $res['ui_UserGroup'];
			            		if($res['ui_UserGroup']!=$groupselect) {
					?>
		            	<option value="<?php echo $res['ui_UserGroup'];?>"><?php echo $res['ui_UserGroup'];?></option>
		            <?php 
								}
							}
		            ?>
					</select>
				</td>
			</tr>
			<tr>
				<td nowrap="nowrap" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 用户状态：&nbsp;&nbsp;&nbsp;</span>
					<select id="UserState" name="UserState" size="1">
						<?php
							if($UserState=='') echo "<option selected=\"selected\" value=\"\">请选择用户状态</option>";
							else echo "<option value=\"\">请选择用户状态</option>";
							if($UserState=='在线') echo "<option selected=\"selected\" value=\"在线\">在线</option>";
							else echo "<option  value=\"在线\">在线</option>";
							if($UserState=='下线') echo "<option selected=\"selected\" value=\"下线\">下线</option>";
							else echo "<option  value=\"下线\">下线</option>";
						?>
					</select>
				</td>
				<td nowrap="nowrap" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 用户ID：&nbsp;&nbsp;&nbsp;</span>
					<input type="text" name="queryUserID" id="queryUserID" value="<?php echo $queryUserID;?>" />
				</td>
				<td nowrap="nowrap"  bgcolor="#FFFFFF"><input type="submit" name="resultquery" value="查询" /></td>
			</tr>
	
		</table>
		
	
	<div id="tableContainer" class="tableContainer" >
		<table class="main_tableboder" id="table1" > 
			<thead class="fixedHeader"> 
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">用户ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">用户姓名</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">用户属组</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">属组ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">所属车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车站ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">用户状态</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">本次上线时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">上次下线时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">用户IP地址</th>
			</tr>
		</thead>
		<tbody class="scrollContent">
			<?php
				if(isset($_POST['resultquery']) || isset($_GET['ADDDONE']) || isset($_GET['MODDONE']) || isset($_GET['DELDONE'])) {
			    if (($queryStationName = $_POST['stationselect']) == "")
					$queryStationName = "%";
				if (($queryGroup = $_POST['groupselect']) == "")
					$queryGroup = "%";
				if (($queryUserID = $_POST['queryUserID']) == "")
					$queryUserID = "%";
			    $queryString = "SELECT * FROM tms_sys_OnlineUser WHERE ui_UserSation LIKE '{$queryStationName}' AND ui_UserGroup LIKE '{$queryGroup}' AND ui_UserID LIKE '{$queryUserID}'
			    	AND ui_UserState LIKE '{$UserState}%'";
				$result = $class_mysql_default->my_query("$queryString");
				while ($row = mysql_fetch_array($result)) {
				    // if($row['ui_UserID'] != "admin") {			
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap" align="center"><?php echo $row['ui_UserID'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['ui_UserName'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['ui_UserGroup'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['ui_UserGroupID'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['ui_UserSation'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['ui_UserSationID'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['ui_UserState'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['ui_LoginTime'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['ui_LogoutTime'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row['ui_UserIP'];?></td>				
			</tr>
			<?php
				     //}
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
			<input type="hidden" id="ui_closeUserID" value="<?php echo $userID;?>" name="ui_closeUserID" />
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
