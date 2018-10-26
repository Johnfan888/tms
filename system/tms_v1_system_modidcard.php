<?php 
//修改班次界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber = $_GET['clnumber'];
	$sql="SELECT * FROM tms_bd_BusCard where bc_CardID='{$clnumber}'";
	//echo $sql;
	$query=$class_mysql_default->my_query($sql);
	$row=mysqli_fetch_array($query);
?>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#CardID1").focus();
	$("#CardID1").keyup(function(e){
		if(e.keyCode == 13){
			//alert($("#busID").val());
			jQuery.get(
				'../ui/inc/manageIC.php',
				{'op': 'mod', 'cardid': $("#CardID1").val(), 'time': Math.random()},
				function(data){
					//alert(data);
					var objData = eval('(' + data + ')');
					if(objData.bc_BusID == null || objData.bc_BusID == ""){ 
						$("#CardID1").val(e.value);
					}
					else{
						alert("此卡已绑定其他车辆！请检查。");
						$("#CardID1").val("");
					}
			});
		}
		else {
			$("#CardID1").val(e.value);
		}
	});
});
function showSiteID(str,Site,SiteID,SiteI){ 
	var st=str.split(',')
	document.getElementById(Site).value=st[1]
	document.getElementById(SiteID).value=st[0]
	document.getElementById(SiteI).value=st[0]
}

function mod1(){
	if(document.getElementById("CardID").value == ""){
		alert("卡号不能为空!");
		return false;
	}
	if(document.getElementById("StationID").value == ""){
		alert("车站编号不能为空!");
		return false;
	}
	if(document.getElementById("Station").value == ""){
		alert("车站名不能为空!");
		return false;
	}
	else{
		document.myform1.submit();
		}
}
</script>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">修改车辆信息卡  </span></td>
  </tr>
</table>
<form id="myform1" name="myform1" method="post" action="tms_v1_system_modidcardok.php" >
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 原卡号：</span></td>
        <td bgcolor="#FFFFFF"><input name="CardID" id="CardID" type="hidden" value="<?php echo $row['bc_CardID']?>" />
        <input type="text" name="CardID2" id="CardID2" disabled="disabled" value="<?php echo $row['bc_CardID']?>"/><span style="color:red">*</span></td>
	</tr>
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 新卡号：</span></td>
        <td bgcolor="#FFFFFF"><input name="CardID1" id="CardID1" type="text" />
       	</td>
	</tr>
	
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车辆编号：</span></td>
		<td bgcolor="#FFFFFF"><input type="hidden" name="BusI1" id="BusI1" value="<?php echo $row['bc_BusID']?>"  />
		<input type="text" name="BusI" id="BusI" value="<?php echo $row['bc_BusID']?>"  disabled="disabled" /><span style="color:red">*</span></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="hidden" name="BusNumber1" id="BusNumber1" value="<?php echo $row['bc_BusNumber']?>" />
    	<input type="text" name="BusNumber" id="BusNumber" value="<?php echo $row['bc_BusNumber']?>" disabled="disabled" /></td>
	</tr> 
	<!--<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站名称：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Station" id="Station" value="<?php echo $row['bc_Station']?>"/><span style="color:red">*</span></td>
	</tr> 
	-->
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站名：</span></td>
    	<td bgcolor="#FFFFFF">
    	<?php if($userStationID=="all"){ ?>
    		<select name="Statio" id="Statio" onchange="showSiteID(this.value,'Station','StationID','StationI')">
    	<?php 
					$sql = "select sset_SiteID,sset_SiteName FROM tms_bd_SiteSet where sset_IsStation=1";
					$query = $class_mysql_default->my_query($sql);
					//$result=mysqli_fetch_array($query);
					while($result=mysqli_fetch_array($query)){
						if($result['sset_SiteName']){
							if($result['sset_SiteName']==$row['bc_Station']){
				?>	
						<option selected="selected" value="<?php echo $row['bc_StationID'].','.$row['bc_Station'];?>"><?php echo $row['bc_Station'];?></option>
				<?php 
							}else{
							?>
						<option value="<?php echo $result['sset_SiteID'].','.$result['sset_SiteName'];?>"><?php echo $result['sset_SiteName'];?></option>
				<?php 
							}
						}
					}
				?>			
      		</select>
      		<?php } else{ ?>
      		<input type="text" name="Statio" disabled="disabled" id="Statio" value="<?php echo $userStationName;?>">
      		<?php }?>
      		<input type="hidden" name="Station" id="Station" value="<?php echo $row['bc_Station'];?>"><span style="color:red">*</span></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站编码：</span></td>
    	<td bgcolor="#FFFFFF"><input name="StationI" id="StationI" disabled="disabled" value="<?php echo $row['bc_StationID'];?>"/>
    	<input type="hidden" name="StationID" id="StationID" value="<?php echo $row['bc_StationID']?>"/><span style="color:red">*</span></td>
	</tr>
	
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 状态：</span></td>
		<td bgcolor="#FFFFFF"><select name="state" id="state">
  				<option value ="注册">注册</option>
  				<option value ="注销">注销</option>
							</select>
		</td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="button2" type="button" value="修改" onclick="return mod1();" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="返回" onclick="history.back();">&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>