<?php
/*
 * 出站稽查页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>出站稽查</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../css/style_main.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<table width="100%" align="center" class="main_tableborder" border="0" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#4C4C4C"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 出 站 稽 查</span></td>
			</tr>
		</table>
		
		<form action="../safecheck/tms_v1_safecheck_VehicleInfo.php" method="post" name="form1" onsubmit="return checkInfo_1();">
		<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
  			<tr>
    			<td colspan="5" bgcolor="#0083B5"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 车辆信息</td>
  			</tr>
		</table>
		<table width="100%" align="center" class="main_tableborder" border="0" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆编号：</span><input type="text" name="busID" id="busID" value="" /></td>
				<td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span><input type="text" name="busCard" id="busCard" value="" /></td>
				<td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：</span><input type="text" name="NoOfRunsID" id="NoOfRunsID" value="" /></td>
				<td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 乘客数：</span><input type="text" name="personNum" id="personNum" value="" /></td>
				<td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 免票儿童数：</span><input type="text" name="freeSeats" id="freeSeats" value="" /></td>
				<td bgcolor="#FFFFFF">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="读取IC卡" onclick="readIC()" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="getBusInfo" value="车辆详细信息" />
				</td>
			</tr>
		</table>
		</form>

		<form action="tms_v1_outCheck_VehicleCheck_ResultProcess.php?userID=<?php echo $userID?>&userName=<?php echo $userName?>" method="post" name="form2" onsubmit="submitResult();">
		<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
  			<tr>
    			<td colspan="5" bgcolor="#0083B5"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 稽查信息</td>
  			</tr>
		</table>
		<table width="100%" align="center" class="tableborder" border="0" cellpadding="3" cellspacing="1">
			<tr>
				<td width="10%" align="center" bgcolor="#006699" style="color:white;">稽查项目</td>
				<td width="40%" align="center" bgcolor="#006699" style="color:white;">稽查要求</td>
				<td width="10%" align="center" bgcolor="#006699" style="color:white;">稽查结果</td>
				<td width="40%" align="center" bgcolor="#006699" style="color:white;">不合格原因</td>
			</tr>
			<?php
				$content = file("outCheckItems.txt");
				$itemNumber = floor((count($content)-1)/2);
				for ($index = 0; $index < $itemNumber; $index++) {
			?>
			<tr>
				<td width="10%" align="left" bgcolor="#CCCCCC"><?php echo $content[$index*2]?></td>
				<td width="40%" align="left" bgcolor="#CCCCCC"><?php echo $content[$index*2+1]?></td>
				<td width="10%" align="center" bgcolor="#CCCCCC"><input type="checkbox" name="pass<?php echo $index?>" id="pass<?php echo $index?>" value="item<?php echo $index?>" onclick="checkSingle(this)" />合格</td> 
				<td width="40%" align="center" bgcolor="#CCCCCC"><input type="text" name="item<?php echo $index?>" id="item<?php echo $index?>" size="80" /></td> 
			</tr>
			<?php
				}
			?>
			<tr>
				<td width="10%" align="left" bgcolor="#CCCCCC"></td>
				<td width="40%" align="left" bgcolor="#CCCCCC"></td>
				<td width="10%" align="center" bgcolor="#CCCCCC"><input type="checkbox" name="passAll" id="passAll" value="<?php echo $itemNumber?>" onclick="checkAll(this)" />全部合格</td> 
				<td width="40%" align="center" bgcolor="#CCCCCC"></td>
			</tr> 
		</table>
		<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
  			<tr>
    			<td colspan="5" bgcolor="#0083B5"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 稽查结果</td>
  			</tr>
		</table>
		<table width="100%" align="center" class="main_tableborder" border="0" cellpadding="3" cellspacing="1">
			<tr>
				<td width="40%" align="left" bgcolor="#FFFFFF" style="color:red;">
					<input type="radio" name="checkresult" value="稽查合格" checked="checked" />稽查合格&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="checkresult" value="稽查不合格" />稽查不合格
				</td>
				<td width="40%" align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />稽查站：</span>
					<select id="stationselect" name="stationselect" size="1">
		            <?php
		            	if($userStationID == "all") {
		            ?>
						<option value="none" selected="selected">请选择车站</option>
		            <?php 
		            		$queryString = "SELECT sset_SiteID,sset_SiteName FROM tms_bd_SiteSet WHERE sset_IsStation=1";
							$result = $class_mysql_default->my_query("$queryString");
					        while($res = mysqli_fetch_array($result)) {
			            		if($res['sset_SiteName']) {
					?>
						<option value="<?php echo $res['sset_SiteID'];?>"><?php echo $res['sset_SiteName'];?></option>
		            <?php 
								}
							}
		            	}
		            	else {
		            ?>
						<option value="<?php echo $userStationID;?>" selected="selected"><?php echo $userStationName;?></option>
					<?php
		            	}
					?>
					</select>
					<input type="hidden" id="stationname" value="" name="stationname"/>
					<input type="hidden" id="busidname" value="" name="busidname"/>
					<input type="hidden" id="buscardname" value="" name="buscardname"/>
					<input type="hidden" id="noOfRunsID" value="" name="noOfRunsID"/>
					<input type="hidden" id="personnum" value="" name="personnum"/>
					<input type="hidden" id="freeseats" value="" name="freeseats"/>
				</td>
				<td width="20%" align="left" bgcolor="#FFFFFF"><input type="submit" name="checksubmit" value="确定" onclick="return checkInfo_2()" /></td>
			</tr>
		</table>
		</form>

		<script type="text/javascript">
		function checkInfo_1()
		{
			if (document.form1.busID.value == "" && document.form1.busCard.value == ""){
				alert("请输入车辆编号或车牌号！");
				document.form1.busID.focus();
				return false;
			}
		}
		function readIC()
		{
			var busID=document.getElementById("busID");
			// 1. read local file to get IC info
			// 2. ask server to return IC info (need to store info on server first)
			busID.value="123456";
		}
		function checkSingle(tcb)
		{
			var currentItem = document.getElementById(tcb.value);
			if (tcb.checked){
				currentItem.value = "";
				// currentItem.disabled = "disabled";
			}
			else{
				// currentItem.disabled = "";
				document.getElementById("passAll").checked = false;
			}
		}
		function checkAll(tcb)
		{
			var checkboxName, textName;
			if (tcb.checked){
				for (var i = 0; i < tcb.value; i++) {
					checkboxName = "pass" + i;
					textName = "item" + i;
					document.getElementById(checkboxName).checked = true;		
					document.getElementById(textName).value = "";		
					// document.getElementById(textName).disabled = "disabled";
					document.getElementById(textName).value = "";
				}		
			}
			else{
				for (var i = 0; i < tcb.value; i++) {
					checkboxName = "pass" + i;
					textName = "item" + i;
					document.getElementById(checkboxName).checked = false;		
					// document.getElementById(textName).disabled = "";
				}
			}
		}
		function checkInfo_2()
		{
			if (document.form1.busID.value == "" && document.form1.busCard.value == ""){
				alert("请输入车辆编号或车牌号！");
				document.form1.busID.focus();
				return false;
			}
			if (document.form2.stationselect.value == "none") {
				alert("请选择车站！");
				document.form2.stationselect.focus();
				return false;
			}				
		}
		function submitResult()
		{
			var thisSelect = document.getElementById("stationselect");
			document.getElementById("stationname").value = thisSelect.options[thisSelect.selectedIndex].text;
			if (document.form1.busID.value == "") {
				document.form1.busID.value = document.form1.busCard.value;
			}
			if (document.form1.busCard.value == "") {
				document.form1.busCard.value = document.form1.busID.value;
			}
			document.form2.busidname.value = document.form1.busID.value;
			document.form2.buscardname.value = document.form1.busCard.value;
			document.form2.noOfRunsID.value = document.form1.NoOfRunsID.value;
			document.form2.personnum.value = document.form1.personNum.value;
			document.form2.freeseats.value = document.form1.freeSeats.value;
			document.getElementById("form2").submit();
		}
		</script>
	</body>
</html>