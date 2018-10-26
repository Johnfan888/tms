<?php 
//车辆循环添加界面
//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$NoOfRunsID=$_GET['NoOfRunsID'];
$select="SELECT COUNT(nrl_LoopID) FROM tms_bd_NoRunsLoop WHERE nrl_NoOfRunsID='{$NoOfRunsID}' GROUP BY nrl_NoOfRunsID";
$querys =$class_mysql_default->my_query($select);
$results=mysqli_fetch_array($querys);
$select1="SELECT nri_LineID FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID='{$NoOfRunsID}'";
$querys1 =$class_mysql_default->my_query($select1);
$results1=mysqli_fetch_array($querys1);
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
//<!--
function retur(){
	window.location.href='tms_v1_basedata_searbusloop.php?clnumber='+document.getElementById("NoOfRunsID").value;
}
/*$(document).ready(function(){
	$("#ModelID").focus();
	$("#ModelName").focus(function(){
		var ModelID = $("#ModelID").val();
		if(ModelID==''){
			alert("车型编号不能为空!");
			return false; 
		}
		jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'getBusModelData', 'ModelID': ModelID, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if(objData.retVal == "FAIL"){ 
					alert(objData.retString);
				}else{
			//		document.getElementById("BusCard").value=objData.BusNumber;
			//		document.getElementById("ModelID").value=objData.BusTypeID;
					document.getElementById("ModelName").value=objData.BusType;
					document.getElementById("Seating").value=objData.SeatS;
					document.getElementById("AddSeating").value=objData.AddSeatS;
					document.getElementById("Loads").value=objData.Weight;
					document.getElementById("AllowHalfSeats").value=objData.AllowHalfSeats;
			//		document.getElementById("StationID").value=objData.InStationID;
			//		document.getElementById("Station").value=objData.InStation;
				}
		});
	});
}); */
$(document).ready(function(){
	$("#add").click(function(){
		if(document.getElementById("LoopID").value == ""){
			alert("车辆循环号不能为空!");
			return false; 
		}
		if(document.getElementById("BusUnit").value == ""){
			alert("车属单位不能为空!");
			return false; 
		}
		if(document.getElementById("ModelID").value== ""){
			alert("车型编号不能为空!");
			return false; 
		}
		jQuery.get(
			'tms_v1_basedata_addbusloopok.php',
			{'op': 'addbusloop', 'NoOfRunsID': $("#NoOfRunsID").val(), 'LoopID': $("#LoopID").val(), 'BusUnit': $("#BusUnit").val(), 'ModelName': $("#ModelName").val(), 
				'ModelID': $("#ModelID").val(), 'Seating': $("#Seating").val(), 'AddSeating': $("#AddSeating").val(), 'AllowHalfSeats': $("#AllowHalfSeats").val(), 
				'Loads': $("#Loads").val(), 'Remark': $("#Remark").val(),'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				switch(objData.retVal){
					case "FAIL":
						alert(objData.retString);
						break;
					case "FAIL1":
						alert(objData.retString);
						document.getElementById("LoopID").value='';
						break;
					case "SUCC1":
						alert(objData.retString);
						window.location.href='tms_v1_basedata_addnorunsadjustprice.php?clnumber1='+document.getElementById("NoOfRunsID").value+'&clnumber2='+document.getElementById("LineID").value;
						break;
					case "SUCC2":
						alert(objData.retString);
						window.location.href='tms_v1_basedata_addbusloop.php?NoOfRunsID='+document.getElementById("NoOfRunsID").value;
						break;
					default:
				}
		});
	});
});
function getmodeldata(){
	if(document.getElementById("Model").value!=''){
		var str=document.getElementById("Model").value.split(',');
		jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'getBusModelData', 'ModelID': str[1], 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if(objData.retVal == "FAIL"){ 
					alert(objData.retString);
				}else{
					document.getElementById("ModelName").value=str[0];
					document.getElementById("ModelID").value=str[1];
					document.getElementById("ModelIDs").value=str[1];
					document.getElementById("Seating").value=objData.SeatS;
					document.getElementById("Seatings").value=objData.SeatS;
					document.getElementById("AddSeating").value=objData.AddSeatS;
					document.getElementById("AddSeatings").value=objData.AddSeatS;
					document.getElementById("Loads").value=objData.Weight;
					document.getElementById("Loadss").value=objData.Weight;
					document.getElementById("AllowHalfSeats").value=objData.AllowHalfSeats;
					document.getElementById("AllowHalfSeatss").value=objData.AllowHalfSeats;
				}
		});
	}else{
		document.getElementById("ModelName").value='';
		document.getElementById("ModelID").value='';
		document.getElementById("ModelIDs").value='';
		document.getElementById("Seating").value='';
		document.getElementById("Seatings").value='';
		document.getElementById("AddSeating").value='';
		document.getElementById("AddSeatings").value='';
		document.getElementById("AllowHalfSeats").value='';
		document.getElementById("AllowHalfSeatss").value='';
		document.getElementById("Loads").value='';
		document.getElementById("Loadss").value='';
	}
}
function getbusmodels(){
	$("#Model").empty();
	if(document.getElementById("BusUnit").value!=''){
		append();
	}
}
function append(){
	jQuery.get(
		'tms_v1_bsaedata_dataProcess.php',
		{'op': 'appendbusmodel', 'BusUnit':$("#BusUnit").val(),'NoOfRunsID':$("#NoOfRunsID").val(),'time': Math.random()},
		function(data){
			var objData = eval('(' + data + ')');
			if(objData.retVal=='FAIL'){
				alert(objData.retString);
				if(objData.retString=='请添加班次价格！'){
					window.location.href='tms_v1_basedata_addnorunsadjustprice.php?clnumber1='+document.getElementById("NoOfRunsID").value+'&clnumber2='+document.getElementById("LineID").value;
				}
			}else{
				$("<option></option>").appendTo($("#Model"));
				for (var i = 0; i < objData.length; i++) {
					$("<option value = " + objData[i].ModelName + "," + objData[i].ModelID + ">" + objData[i].ModelName + "</option>").appendTo($("#Model"));
				}
			}
	});
}
//-->
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 车 辆 循 环  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<form method="post" name="aaa" action="tms_v1_basedata_addbusloopok.php">
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次编号：</span></td>
        <td bgcolor="#FFFFFF">
        	<input type="hidden" name="NoOfRunsID" id="NoOfRunsID" value="<?php echo $NoOfRunsID;?>"/>
        	<input type="hidden" name="LineID" id="LineID" value="<?php echo $results1['nri_LineID'];?>"/>
        	<input type="text" name="NoOfRunsI" disabled="disabled" value="<?php echo $NoOfRunsID;?>"/></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆循环号：</span></td>
		<td bgcolor="#FFFFFF"><input type="text" name="LoopID" id="LoopID"  value="<?php echo $results[0]+1;?>"/><span style="color:red">*</span></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车属单位：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="BusUnit" id="BusUnit" onchange="getbusmodels()">
    			<option></option>
    			<?php
    				
    	/*			$selectunit="SELECT DISTINCT nrap_Unit FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ISUnitAdjust='1' AND nrap_LineAdjust='{$results1['nri_LineID']}' 
    					AND (!nrap_NoRunsAdjust)";
    				$selunit =$class_mysql_default->my_query($selectunit);
    				if(!$selunit) echo ->my_error();
					while($resultunit=mysqli_fetch_array($selunit)){
						if($resultunit['nrap_Unit']) { */
    				$selectbusunit="SELECT DISTINCT bi_BusUnit FROM tms_bd_BusInfo";
    				$querybusunit=$class_mysql_default->my_query($selectbusunit);
    				while($rowbusunit=mysqli_fetch_array($querybusunit)){
    			?>
    			<option value="<?php echo $rowbusunit['bi_BusUnit'];?>"><?php echo  $rowbusunit['bi_BusUnit'];?></option>
    			<?php
					//	}
					}
    			?>
    		</select><span style="color:red">*</span>
    	</td> 
	</tr>
<!--  
	 <tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车辆编号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="BusID" id="BusID"/><span style="color:red">*</span></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车牌号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="BusCard" id="BusCard" readonly="readonly" /></td>
	</tr>
-->	
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型名：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="Model" id="Model" onchange="getmodeldata()">
    			<option></option>
    		</select>
    		<input type="hidden" name="ModelName" id="ModelName"/>
    		<span style="color:red">*</span>
    	</td>
	</tr>    
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型编号：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="hidden" name="ModelID" id="ModelID" />
    		<input type="text" name="ModelIDs" id="ModelIDs" disabled="disabled"/>
    	</td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />座位数：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="hidden" name="Seating" id="Seating"  >
    		<input type="text" name="Seatings" id="Seatings"  disabled="disabled">
    	</td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />加座数：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="hidden" name="AddSeating" id="AddSeating" />
    		<input type="text" name="AddSeatings" id="AddSeatings" disabled="disabled"/>
    	</td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />允许半票数：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="hidden" name="AllowHalfSeats" id="AllowHalfSeats" />
    		<input type="text" name="AllowHalfSeatss" id="AllowHalfSeatss" disabled="disabled"/>
    	</td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />载重：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="hidden" name="Loads" id="Loads" />
    		<input type="text" name="Loadss" id="Loadss" disabled="disabled"/>
    	</td>
	</tr> 
<!--  	 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />所属车站编号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="StationID" id="StationID" readonly="readonly"/></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />所属车站名：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Station" id="Station" readonly="readonly"/></td>
	</tr> 
-->
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" id="Remark" cols="" rows=""></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="add" id="add" type="button" value="添加"/>
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置"/>
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="retur()"/></td>
  </tr>
</table>
</form>

