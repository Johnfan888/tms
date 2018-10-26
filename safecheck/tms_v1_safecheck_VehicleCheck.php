<?php
/*
 * 车辆检验页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

//if($userGroupID == "6")	require_once("../ui/user/topnoleft.inc.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>车辆检验</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../css/style_main.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript">
		function checkSingle(index,id,str){
			if (document.getElementById(id).checked){
				document.getElementById('item'+index).value=document.getElementById('item'+index).value+str+'；';	
			}
			else{
				document.getElementById('item'+index).value=document.getElementById('item'+index).value.replace(str+'；','');
			}
		}
		function qualify(indexed){
			var index=indexed.replace('pass','');
			for(var i=0; i<document.getElementById('notpass'+index).value; i++){
				document.getElementById('notpass'+index+i).checked=false;
			}
			document.getElementById('dis'+index).style.display='none';
			document.getElementById('item'+index).value='';
			for(var i=0; i<document.getElementById('number').value*1; i++){
				if(index*1!=i*1){
					document.getElementById('dis'+i).style.display='none';
				}
			}
		}
		function notqualify(indexed){
			var index=indexed.replace('pass','');
			var index=index.replace('1','');
			document.getElementById("checkresult3").checked=true;
			document.getElementById("passAll").checked=false;
			document.getElementById('dis'+index).style.display='';
			for(var i=0; i<document.getElementById('number').value*1; i++){
				if(index*1!=i*1){
					document.getElementById('dis'+i).style.display='none';
				}
			}
		}
		function checkAll(tcb)
		{
			var checkboxName, textName;
			if (tcb.checked){
				document.getElementById("checkresult1").checked=true;
				document.getElementById("passAll").checked=true;
				for (var i = 0; i < document.getElementById('number').value*1; i++){
					checkboxName = "pass" + i;
					textName = "item" + i;
					document.getElementById(checkboxName).checked = true;		
					document.getElementById(textName).value = "";
					document.getElementById('dis'+i).style.display='none';
					for(var j=0;j<document.getElementById('notpass'+i).value;j++){	
						document.getElementById('notpass'+i+j).checked = false;	
					}
				}		
			}
		}
		function checkAll2(tcb)
		{
			var checkboxName, textName;
			if (tcb.checked){
				document.getElementById("passAll").checked=true;
				for (var i = 0; i < document.getElementById('number').value*1; i++){
					checkboxName = "pass" + i;
					textName = "item" + i;
					document.getElementById(checkboxName).checked = true;		
					document.getElementById(textName).value = "";
					document.getElementById('dis'+i).style.display='none';
					for(var j=0;j<document.getElementById('notpass'+i).value;j++){	
						document.getElementById('notpass'+i+j).checked = false;	
					}
				}		
			}
		}

		$(document).ready(function(){
			if((document.getElementById("busID").value!="")&&(document.getElementById("busCard").value!="")&&(document.getElementById("busType").value!="")&&(document.getElementById("busCard").value==document.getElementById("busCardI").value)&&(document.getElementById("busIC").value==document.getElementById("busICI").value)){
				document.getElementById("checksubmit").disabled=false;
				document.getElementById("getBusInfo").disabled=true;
			}
			else{
				document.getElementById("checksubmit").disabled=true;
				document.getElementById("getBusInfo").disabled=false;
			}
		});
		
		function gray(){
			document.getElementById("checksubmit").disabled=true;
			document.getElementById("getBusInfo").disabled=false;
			}
		function gray2(){
			if((document.getElementById("busID").value!="")&&(document.getElementById("busCard").value!="")&&(document.getElementById("busType").value!="")&&(document.getElementById("busCard").value==document.getElementById("busCardI").value)&&(document.getElementById("busIC").value==document.getElementById("busICI").value)){
				document.getElementById("checksubmit").disabled=false;
				document.getElementById("getBusInfo").disabled=true;
			}
			else{
				document.getElementById("checksubmit").disabled=true;
				document.getElementById("getBusInfo").disabled=false;
			}
		}
		$(document).ready(function(){
			$("#busIC").focus();
			$("#busIC").keyup(function(e){
				document.getElementById("BusNumberselect").style.display="none";
				if((document.getElementById("busID").value!="")&&(document.getElementById("busCard").value!="")&&(document.getElementById("busType").value!="")&&(document.getElementById("busCard").value==document.getElementById("busCardI").value)&&(document.getElementById("busIC").value==document.getElementById("busICI").value)){
					document.getElementById("checksubmit").disabled=false;
					document.getElementById("getBusInfo").disabled=true;
				}
				else{
					document.getElementById("checksubmit").disabled=true;
					document.getElementById("getBusInfo").disabled=false;
				}
				if(e.keyCode == 13){
					//alert($("#busID").val());
					jQuery.get(
						'../ui/inc/manageIC.php',
						{'op': 'GETBUSINFO', 'busIC': $("#busIC").val(), 'time': Math.random()},
						function(data){
							//alert(data);
							var objData = eval('(' + data + ')');
							if(objData.bc_BusID == null || objData.bc_BusID == ""){ 
								alert("此卡车辆不存在！请检查。");
								$("#busIC").val("");
							}
							else{
								$("#busID").val(objData.bc_BusID);
								if(objData.bc_BusNumber != null || objData.bc_BusNumber != "") $("#busCard").val(objData.bc_BusNumber);
							}
					});
				}
				else {
					$("#busIC").val(e.value);
				}
			});
			$("#getBusInfo").click(function(){
				document.getElementById("BusNumberselect").style.display="none";
				if (document.form1.busIC.value == "" && document.form1.busCard.value == "") {
					alert("请输入车辆卡号或车牌号！");
					document.form1.busIC.focus();
				}
				else if (document.form1.busIC.value != "") {
					jQuery.get(
						'tms_v1_safecheck_VehicleInfo.php',
						{'op': 'GETBUSINFOBYBUSIC', 'busIC': $("#busIC").val(), 'time': Math.random()},
						function(data){
							//alert(data);
							var objData = eval('(' + data + ')');
							if(objData.bi_BusIC == null || objData.bi_BusIC == ""){ 
								alert("此卡号的车不存在！请检查。");
								$("#busIC").val("");
								$("#busID").val("");
								$("#busCard").val("");
								$("#busType").val("");
								$("#busICI").val("");
								$("#busCardI").val("");
							}
							else{
								$("#busIC").val(objData.bi_BusIC);
								$("#busID").val(objData.bi_BusID);
								if(objData.bi_BusNumber != null || objData.bi_BusNumber != "") $("#busCard").val(objData.bi_BusNumber);
								if(objData.bi_BusType != null || objData.bi_BusType != "") $("#busType").val(objData.bi_BusType);
								document.getElementById("busICI").value = document.getElementById("busIC").value;  //车辆编号
								document.getElementById("busCardI").value = document.getElementById("busCard").value; //车牌号
								document.form1.submit();
							}
					});
				}
				else {
					jQuery.get(
						'tms_v1_safecheck_VehicleInfo.php',
						{'op': 'GETBUSINFOBYBUSNUMBER', 'bi_BusNumber': $("#busCard").val(), 'time': Math.random()},
						function(data){
							//alert(data);
							var objData = eval('(' + data + ')');
							if(objData.bi_BusID == null || objData.bi_BusID == ""){ 
								alert("此车牌号的车不存在！请检查。");
								$("#busIC").val("");
								$("#busID").val("");
								$("#busCard").val("");
								$("#busType").val("");
								$("#busICI").val("");
								$("#busCardI").val("");
							}
							else{
								$("#busIC").val(objData.bi_BusIC);
								$("#busID").val(objData.bi_BusID);
								if(objData.bi_BusNumber != null || objData.bi_BusNumber != "") $("#busCard").val(objData.bi_BusNumber);
								if(objData.bi_BusType != null || objData.bi_BusType != "") $("#busType").val(objData.bi_BusType);
								document.getElementById("busICI").value = document.getElementById("busIC").value;  //车辆编号
								document.getElementById("busCardI").value = document.getElementById("busCard").value; //车牌号
								document.form1.submit();
							}
					});
				}
			});
			$("#checksubmit").click(function(){
				document.getElementById("BusNumberselect").style.display="none";
				if (document.form1.busID.value == "" || document.form1.busCard.value == ""){
					alert("车辆卡号和车牌号不能为空！");
					document.form1.busID.focus();
				}
				else if (document.form2.stationselect.value == "none") {
					alert("请选择车站！");
					document.form2.stationselect.focus();
				}				
				else {
					if(document.getElementById("checkresult3").checked){
						for(var i=0; i<document.getElementById('number').value*1; i++){
							if(document.getElementById("pass"+i+"1").checked && document.getElementById("item"+i).value==""){
									
									alert("请选择"+ document.getElementById("itemname"+i).value+"不合格原因！");
									return;
								}
						}
					}
						j=0;
						for (var i = 0; i < document.getElementById('number').value*1; i++){
							if(document.getElementById("item" + i).value == ""){
								j=j+1;
								}
							}
						if((document.getElementById("passAll").checked!=document.getElementById("checkresult1").checked)&&(document.getElementById("passAll").checked!=document.getElementById("checkresult2").checked)){
							alert("所选项目与检验结果不符！请检查。");
							return false;
						}
						else if(i==j&&document.getElementById("checkresult3").checked){
							alert("所选项目与检验结果不符！请检查。");
							return false;
							}		
					var thisSelect = document.getElementById("stationselect");
					document.getElementById("stationname").value = thisSelect.options[thisSelect.selectedIndex].text;
					document.form2.busidname.value = document.form1.busID.value;
					document.form2.buscardname.value = document.form1.busCard.value;
					document.form2.bustypename.value = document.form1.busType.value;
					document.form2.submit();
				}
			});
			$("#busCard").keyup(function(){
				if((document.getElementById("busID").value!="")&&(document.getElementById("busCard").value!="")&&(document.getElementById("busType").value!="")&&(document.getElementById("busCard").value==document.getElementById("busCardI").value)&&(document.getElementById("busIC").value==document.getElementById("busICI").value)){
					document.getElementById("checksubmit").disabled=false;
					document.getElementById("getBusInfo").disabled=true;
				}
				else{
					document.getElementById("checksubmit").disabled=true;
					document.getElementById("getBusInfo").disabled=false;
				}
				$("#BusNumberselect").empty();
				document.getElementById("BusNumberselect").style.display=""; 
				var BusNumber = $("#busCard").val();
				jQuery.get(
					'../basedata/tms_v1_basedata_getbusdata.php',
					{'op': 'getbus', 'BusNumber': BusNumber, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL"){ 
							document.getElementById("BusNumberselect").style.display="none";
						}
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].BusNumber + ">" + objData[i].BusNumber + "</option>").appendTo($("#BusNumberselect"));
						}
						if(BusNumber==''){
							document.getElementById("BusNumberselect").style.display="none";
						}
				}); 
			});
			document.getElementById("BusNumberselect").onclick = function (event){
				document.getElementById("busCard").value=document.getElementById("BusNumberselect").value;
				document.getElementById("BusNumberselect").style.display="none";
			};
		});
		</script>
	</head>
	<body>	
	<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span  style="margin-left:8px;"> 车  辆  安  检</span></td>
			</tr>
		</table>
		<form action="tms_v1_safecheck_VehicleInfo.php" method="post" name="form1">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1" style="margin-top:-20px;">
			<tr>
				<td  nowrap="nowrap" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆卡号：</span></td>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><input style="background-color:#F1E6C2" type="text" name="busIC" id="busIC" onchange="gray()"/>
					<input style="background-color:#F1E6C2" type="hidden" name="busID" id="busID" />
					<input type="hidden" name="busICI" id="busICI" />
				</td>
				<td nowrap="nowrap" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><input style="background-color:#F1E6C2" type="text" name="busCard" id="busCard" onchange="gray()"/>
					<br/>
	    			<select id="BusNumberselect" name="BusNumberselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" onchange="gray2()"></select>
	    			<input  type="hidden" name="busCardI" id="busCardI" value=""/>
				</td>
				<td nowrap="nowrap" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型：</span></td>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="busType" id="busType" disabled="disabled" size="10"/>
				</td>
				<td nowrap="nowrap" bgcolor="#FFFFFF">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="getBusInfo" id="getBusInfo" value="信息确认" />
				</td>
			</tr>
		</table>
		</form>
		<form action="tms_v1_safecheck_VehicleCheck_ResultProcess.php?userID=<?php echo $userID?>&userName=<?php echo $userName?>" method="post" name="form2">
		<table width="100%" align="center" class="tableborder" border="1" cellpadding="3" cellspacing="1" style="margin-top:-20px;">
			<tr>
				<td width="10%" align="center" bgcolor="#006699" style="color:white;">检验项目</td>
				<td width="10%" align="center" bgcolor="#006699" style="color:white;">检验结果</td>
				<td width="40%" align="center" bgcolor="#006699" style="color:white;">不合格原因</td>
			</tr>
			<?php
			//	$content = file("VehicleCheckItems.txt");
			//	$itemNumber = floor((count($content)-1)/2);
			//	for ($index = 0; $index < $itemNumber; $index++) {
				$index=0;
			 	$select="SELECT ci_CheckItem, GROUP_CONCAT( ci_CheckContent ) AS CheckContent FROM tms_sf_CheckItem GROUP BY ci_CheckItem";
			 	$query=$class_mysql_default->my_query("$select");
			 	while($rows = mysqli_fetch_array($query)) {
			?>
			<tr>
			 	<td align="center" bgcolor="#CCCCCC"><?php echo $rows['ci_CheckItem'];?><input type="hidden" name="itemname<?php echo $index?>" id="itemname<?php echo $index?>" value="<?php echo $rows['ci_CheckItem'];?>"/></td>
			  	<td align="center" bgcolor="#CCCCCC"><input type="radio" name="pass<?php echo $index?>"  id="pass<?php echo $index?>" value="合格" checked="checked" onclick="qualify(this.id)"/>合格&nbsp;&nbsp;&nbsp;&nbsp;
			  		 <input type="radio" name="pass<?php echo $index?>"  id="pass<?php echo $index?>1" value="不合格"  onclick="notqualify(this.id)"/>不合格&nbsp;</td>
			 	<td align="center" bgcolor="#CCCCCC"><input type="text" name="item<?php echo $index?>" id="item<?php echo $index?>" size="80"  onblur="reason(this)"/></td> 
			</tr>
	   		<tr id="dis<?php echo $index?>" style="display:none">
	   			<td  colspan="3" align="center" bgcolor="#CCCCCC">
				<?php
					$id=0;
					foreach (explode(",",$rows['CheckContent']) as $key =>$Content){ 
				?>
				<input type="checkbox" name="notpass<?php echo $index.$id?>" id="notpass<?php echo $index.$id?>" value="<?php echo $Content;?>" onclick="checkSingle(<?php echo $index;?>,this.id,this.value)" />&nbsp;&nbsp;
						<?php echo $Content;?>&nbsp;&nbsp;&nbsp;&nbsp;
				<?php
						$id=$id+1;
					}
				?><input type="hidden" name="notpass<?php echo $index;?>" id="notpass<?php echo $index;?>" value="<?php echo $id;?>"/>
				</td>
			</tr>
			<?php
					$index=$index+1;
				}
			?>
			<tr>
				<td align="left" bgcolor="#CCCCCC"><input type="hidden" name="number" id="number" value="<?php echo $index;?>"/></td>
				<td align="center" bgcolor="#CCCCCC">
					<input type="checkbox" name="passAll" id="passAll" value="<?php echo $itemNumber?>" checked="checked" onclick="checkAll(this)" />全部合格
				</td> 
				<td align="center" bgcolor="#CCCCCC"></td>
			</tr> 
		</table>
		<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
  			<tr>
    			<td colspan="5" bgcolor="#006699"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 检验结果</td>
  			</tr>
		</table>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td align="left" bgcolor="#FFFFFF" style="color:red;">
					<input type="radio" name="checkresult" id="checkresult1" value="检验合格" checked="checked" onclick="checkAll(this)"/>检验合格&nbsp;
					<input type="radio" name="checkresult" id="checkresult2" value="复检合格" onclick="checkAll2(this)"/>复检合格&nbsp;
					<input type="radio" name="checkresult" id="checkresult3" value="检验不合格" onclick="unqualified()"/>检验不合格
				</td>
				<td align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />安检站：</span>
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
					<input type="hidden" id="bustypename" value="" name="bustypename"/>
				</td>
				<td align="left" bgcolor="#FFFFFF">
					<input type="button" name="checksubmit" id="checksubmit" value="安检确认" />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="toquery" id="toquery" value="已检信息查询" onclick="location.assign('tms_v1_safecheck_VehicleCheck_Query.php')" />
				</td>
			</tr>
		</table>
		</form>
	</body>
</html>