<?php 
//添加区域界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	
?>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#CardID").focus();
	$("#CardID").keyup(function(e){
		if(e.keyCode == 13){
			//alert($("#busID").val());
			jQuery.get(
				'../ui/inc/manageIC.php',
				{'op': 'add', 'cardid': $("#CardID").val(), 'time': Math.random()},
				function(data){
					//alert(data);
					var objData = eval('(' + data + ')');
					if(objData.bc_BusID == null || objData.bc_BusID == ""){ 
						
						$("#CardID").val(e.value);
						document.getElementById('busCard').focus();
					}
					else{
						alert("此卡已绑定其他车辆，无法重复绑定，请检查。");
						$("#CardID").val("");
					}
			});
		}
		else {
			$("#CardID").val(e.value);
		}
	});
});
function sear(){
	window.location.href='tms_v1_system_searidcard.php';
}
function showSiteID(str,Site,SiteID,SiteI,HelpCode){ 
	var st=str.split(',')
	document.getElementById(Site).value=st[1]
	document.getElementById(SiteID).value=st[0]
	document.getElementById(SiteI).value=st[0]
	document.getElementById(HelpCode).value=st[2]
	
}
function adddo(){
	if(document.getElementById("CardID").value == ""){
		alert("卡号不能为空!");
		return false;
	}
	if(document.getElementById("BusI").value == ""){
		alert("车辆编号不能为空!");
		return false;
	}
	if(document.getElementById("busCard").value == ""){
		alert("车牌号不能为空!");
		return false;
	}
	if(document.getElementById("Statio").value == ""){
		alert("所属车站不能为空!");
		return false;
	}
	else{
		document.myform.submit();
		}
	
}
$(document).ready(function(){
	$("#busCard").keyup(function(){
		document.getElementById("BusI").value="";
	});
});
$(document).ready(function(){
	$("#BusI").keyup(function(){
		document.getElementById("busCard").value="";
	});
});
$(document).ready(function(){
	$("#busCard").keyup(function(){
		$("#BusNumberselect").empty();
		document.getElementById("BusNumberselect").style.display=""; 
		var BusNumber = $("#busCard").val();
		jQuery.get(
			'../basedata/tms_v1_basedata_getbusdata.php',
			{'op': 'getbus1', 'BusNumber': BusNumber, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				for (var i = 0; i < objData.length; i++) {
					$("<option value = " + objData[i].BusNumber +  "," + objData[i].BusID + ">" + objData[i].BusNumber + "</option>").appendTo($("#BusNumberselect"));
				}
				if(BusNumber==''){
					document.getElementById("BusNumberselect").style.display="none";
				}
		});
});
		document.getElementById("BusNumberselect").onclick = function (event){
		var sb=document.getElementById("BusNumberselect").value.split(',');
		document.getElementById("busCard").value=sb[0];
		document.getElementById("BusI").value=sb[1];
		document.getElementById("BusNumberselect").style.display="none";
	};
	});
</script>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添加车辆信息卡  </span></td>
  </tr>
</table>
<form id="myform" name="myform" method="post" action="tms_v1_system_addidcardok.php" >
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 卡号：</span></td>
        <td bgcolor="#FFFFFF"><input type="text" name="CardID" id="CardID" /><span style="color:red">*</span></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="busCard" id="busCard" /><span style="color:red">*</span>
    	<br>
		<select id="BusNumberselect" name="BusNumberselect" class="helplay" multiple="multiple" style="display:none;height:90px;" size="30" ></select>
		</td>
	</tr> 
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车辆编号：</span></td>
		<td bgcolor="#FFFFFF"><input type="text" name="BusI" id="BusI" /><span style="color:red">*</span></td>
	</tr> 
		<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站名：</span></td>
    	<td bgcolor="#FFFFFF">
    	<?php if($userStationID=="all"){  ?>
    		<select name="Statio" id="Statio" onchange="showSiteID(this.value,'Station','StationID','StationI')">
    		<option selected="selected"></option>
				<?php 
					$sql = "select sset_SiteID, sset_SiteName FROM tms_bd_SiteSet where sset_IsStation=1";
					$query = $class_mysql_default->my_query($sql);
					//$result=mysqli_fetch_array($query);
					while($result=mysqli_fetch_array($query)){
						if($result['sset_SiteName']){
			?>
			<option value="<?php echo $result['sset_SiteID'].','.$result['sset_SiteName'];?>"><?php echo $result['sset_SiteName'];?></option>
      		<?php }}?>
      		</select>
      		<?php } else{ ?>
      		<select name="Statio" id="Statio" >
      		<option value="<?php echo $userStationID.','.$userStationName;?>"><?php echo $userStationName;?></option>
      		</select>
      		<?php  }?>
      		<?php if($userStationID=="all"){ ?>
      		<input type="hidden" name="Station" id="Station"><span style="color:red">*</span>
      		<?php } else {?>
      		<input type="hidden" name="Station" id="Station" value="<?php echo $userStationName; ?>"><span style="color:red">*</span>
      		<?php  } ?>
      		</td>
	</tr>
		<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站编码：</span></td>
    	<td bgcolor="#FFFFFF">
    	<?php if($userStationID=="all"){ ?>
    	<input type="hidden" name="StationID" id="StationID" />
    	<input name="StationI" id="StationI" disabled="disabled"/><span style="color:red">*</span>
		<?php } else{ ?>
		<input type="hidden" name="StationID" id="StationID" value="<?php echo $userStationID; ?>"/>
    	<input name="StationI" id="StationI" disabled="disabled" value="<?php echo $userStationID; ?>"/><span style="color:red">*</span></td>
    	
		<?php }?>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="button1" type="button" value="添加" onclick="adddo();" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return sear()"">&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>

