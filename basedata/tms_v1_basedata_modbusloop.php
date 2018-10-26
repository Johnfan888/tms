<?php 
	//车辆循环修改界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$NoOfRunsID=$_GET['NoOfRunsID'];
	$noid=$_GET['noid'];
	$sql = "SELECT nrl_LoopID,nrl_ModelID,nrl_ModelName,nrl_Seating,nrl_AddSeating,nrl_AllowHalfSeats,nrl_Loads,nrl_Unit,
		nrl_Remark,nri_LineID FROM tms_bd_NoRunsLoop,tms_bd_NoRunsInfo WHERE nrl_NoOfRunsID='{$NoOfRunsID}'AND nrl_LoopID='{$noid}' 
		AND nri_NoOfRunsID='{$NoOfRunsID}'";
	$query =$class_mysql_default->my_query($sql);
	$result=mysqli_fetch_array($query);
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
<!--
function retur(){
	window.location.href='tms_v1_basedata_searbusloop.php?clnumber='+document.getElementById("NoOfRunsID").value;
}

/*$(document).ready(function(){
	$("#ModelID").focus();
	$("#ModelID").blur(function(){
		var ModelID = $("#ModelID").val();
		jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'getBusModelData', 'ModelID': ModelID, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if(objData.retVal == "FAIL"){ 
					alert(objData.retString);
				//	document.getElementById("BusCard").value='';
					document.getElementById("ModelID").value='';
					document.getElementById("ModelName").value='';
					document.getElementById("Seating").value='';
					document.getElementById("AddSeating").value='';
					document.getElementById("AllowHalfSeats").value='';
					document.getElementById("Loads").value='';
			//		document.getElementById("StationID").value='';
			//		document.getElementById("Station").value='';
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
	$("#mod").click(function(){
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
			'tms_v1_basedata_modbusloopok.php',
			{'op': 'modbusloop', 'NoOfRunsID': $("#NoOfRunsID").val(), 'LoopID': $("#LoopID").val(), 'BusUnit': $("#BusUnit").val(), 'ModelName': $("#ModelName").val(), 
				'ModelID': $("#ModelID").val(), 'Seating': $("#Seating").val(), 'AddSeating': $("#AddSeating").val(), 'AllowHalfSeats': $("#AllowHalfSeats").val(), 
				'Loads': $("#Loads").val(), 'Remark': $("#Remark").val(),'LoopI':$("#LoopI").val(),'time': Math.random()},
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
						window.location.href='tms_v1_basedata_modbusloop.php?NoOfRunsID='+document.getElementById("NoOfRunsID").value+'&noid='+document.getElementById("LoopID").value;
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
		alert('ss');
	}
}
function getbusmodels(){
	$("#Model").empty();
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
    <span class="graytext" style="margin-left:8px;">修 改 车 辆 循 环  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<form method="post" name="aaa" action="">
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次编号：</span></td>
        <td bgcolor="#FFFFFF">
        	<input type="hidden" name="LineID" id="LineID" value="<?php echo $result['nri_LineID'];?>"/>
        	<input type="hidden" name="NoOfRunsID" id="NoOfRunsID" value="<?php echo $NoOfRunsID;?>"/>
        	<input type="text" name="NoOfRunsI" disabled="disabled" value="<?php echo $NoOfRunsID;?>"/></td>
	</tr>  	
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆循环号：</span></td>
		<td bgcolor="#FFFFFF"><input type="hidden" name="LoopI" id="LoopI" value="<?php echo $result['nrl_LoopID']?>"/>
			<input type="text" name="LoopID" id="LoopID" value="<?php echo $result['nrl_LoopID']?>"/><span style="color:red">*</span></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车属单位：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="BusUnit" id="BusUnit" onchange="getbusmodels()">
    			<option value="<?php echo $result['nrl_Unit']?>"><?php echo $result['nrl_Unit']?></option>
    			<?php 
    				if ($result['nrl_Unit']!=''){
    			?>
    			<option></option>
    			<?php 
    				} 
    		/*		$selectunit="SELECT DISTINCT nrap_Unit FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ISUnitAdjust='1' AND nrap_LineAdjust='{$result['nri_LineID']}' 
    					AND (!nrap_NoRunsAdjust)";
    				$selunit =$class_mysql_default->my_query($selectunit);
    				if(!$selunit) echo ->my_error();
					while($resultunit=mysqli_fetch_array($selunit)){
						if($resultunit['nrap_Unit']) {
							if($result['nrl_Unit']!=$resultunit['nrap_Unit']){ */
					$selectbusunit="SELECT DISTINCT bi_BusUnit FROM tms_bd_BusInfo";
    				$querybusunit=$class_mysql_default->my_query($selectbusunit);
    				while($rowbusunit=mysqli_fetch_array($querybusunit)){
    					if($result['nrl_Unit']!=$rowbusunit['bi_BusUnit']){
    			?>
    			<option value="<?php echo $rowbusunit['bi_BusUnit'];?>"><?php echo  $rowbusunit['bi_BusUnit'];?></option>
    			<?php
						}
					}
    			?>
    		</select><span style="color:red">*</span></td> 
	</tr>
<!--
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车辆编号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="BusID" id="BusID" value="<?php echo $result['nrl_BusID']?>"/><span style="color:red">*</span></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车牌号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="BusCard" id="BusCard" readonly="readonly" value="<?php echo $result['nrl_BusCard']?>"/></td>
	</tr>
-->  
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型名：</span></td>
		<td bgcolor="#FFFFFF">
    		<select name="Model" id="Model" onchange="getmodeldata()">
    			<option value="<?php echo $result['nrl_ModelName'].','.$result['nrl_ModelID']?>"><?php echo $result['nrl_ModelName'];?></option>
    			<?php 
    				if($result['nrl_ModelName']!=''){
    			?>
    					<option></option>
    			<?php 
    				}
		    		$select1="SELECT DISTINCT nrap_ModelID,nrap_ModelName FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ISUnitAdjust='1' AND nrap_Unit='{$rowbusunit['bi_BusUnit']}' AND 
						nrap_NoRunsAdjust='{$NoOfRunsID}' AND nrap_ModelID IN (SELECT DISTINCT bi_BusTypeID FROM tms_bd_BusInfo WHERE bi_BusUnit='{$rowbusunit['bi_BusUnit']}')";
					$query1=$class_mysql_default->my_query("$select1");
					while($row1=mysqli_fetch_array($query1)){
						if($result['nrl_ModelID']!=$row1['nrap_ModelID']){
				?>
						<option value="<?php echo $row1['nrap_ModelName'].','.$row1['nrap_ModelID'];?>"><?php echo $row1['nrap_ModelName'];?></option>
				<?php
						} 
					}
					$select2="SELECT DISTINCT nrap_ModelID,nrap_ModelName FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ISNoRunsAdjust='1' AND nrap_NoRunsAdjust='{$NoOfRunsID}'
						AND nrap_ModelID IN (SELECT DISTINCT bi_BusTypeID FROM tms_bd_BusInfo WHERE bi_BusUnit='{$rowbusunit['bi_BusUnit']}') AND 
						nrap_ModelID NOT IN (SELECT DISTINCT nrap_ModelID FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ISUnitAdjust='1' AND nrap_Unit='{$rowbusunit['bi_BusUnit']}' AND 
						nrap_NoRunsAdjust='{$NoOfRunsID}')";
					$query2=$class_mysql_default->my_query("$select2");
					while($row2=mysqli_fetch_array($query2)){
						if($result['nrl_ModelID']!=$row2['nrap_ModelID']){
				?>
							<option value="<?php echo $row2['nrap_ModelName'].','.$row2['nrap_ModelID'];?>"><?php echo $row2['nrap_ModelName'];?></option>
				<?php
						}
					} 
				?>
    		</select>
    		<input type="hidden" name="ModelName" id="ModelName" value="<?php echo $result['nrl_ModelName'];?>"/>
    		<span style="color:red">*</span>
    	</td>
	</tr>  
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型编号：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="hidden" name="ModelID" id="ModelID"  value="<?php echo $result['nrl_ModelID']?>"/>
    		<input type="text" name="ModelIDs" id="ModelIDs" disabled="disabled" value="<?php echo $result['nrl_ModelID']?>"/>
    	</td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />座位数：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="hidden" name="Seating" id="Seating" value="<?php echo $result['nrl_Seating']?>"/>
    		<input type="text" name="Seatings" id="Seatings" disabled="disabled" value="<?php echo $result['nrl_Seating']?>"/>
    	</td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />加座数：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="hidden" name="AddSeating" id="AddSeating" value="<?php echo $result['nrl_AddSeating']?>"/>
    		<input type="text" name="AddSeatings" id="AddSeatings" disabled="disabled" value="<?php echo $result['nrl_AddSeating']?>"/>
    	</td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />允许半票数：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="hidden" name="AllowHalfSeats" id="AllowHalfSeats" value="<?php echo $result['nrl_AllowHalfSeats']?>"/>
    		<input type="text" name="AllowHalfSeatss" id="AllowHalfSeatss" disabled="disabled" value="<?php echo $result['nrl_AllowHalfSeats']?>"/>
    	</td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />载重：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="hidden" name="Loads" id="Loads" value="<?php echo $result['nrl_Loads']?>"/>
    		<input type="text" name="Loadss" id="Loadss" disabled="disabled" value="<?php echo $result['nrl_Loads']?>"/>
    	</td>
	</tr> 
<!--  
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />所属车站编号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="StationID" id="StationID" readonly="readonly" value="<?php echo $result['nrl_StationID']?>"/></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />所属车站名：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Station" id="Station"  readonly="readonly" value="<?php echo $result['nrl_Station']?>" /></td>
	</tr>
--> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows=""><?php echo $result['nrl_Remark']?></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="mod" id="mod" type="button" value="修改"/>
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="retur()"></td>
  </tr>
</table>
</form>

