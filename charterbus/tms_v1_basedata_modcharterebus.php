<?php 
//修改包车界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber=$_GET['clnumber'];
	$select="SELECT * FROM tms_bd_CharteredBus WHERE cb_ChartereID='{$clnumber}'";
	$query =$class_mysql_default->my_query($select);
	$result=mysqli_fetch_array($query);
	$string=explode('-',$result['cb_FromReach']);
	
?>
<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(document).ready(function(){
		$("#busCard").keyup(function(){
			document.getElementById("Seats").value="";
			document.getElementById("Seats1").value="";
		});
	});


	$(document).ready(function(){
		$("#DriverID").keyup(function(){
			document.getElementById("DriverName1").value="";
			document.getElementById("DriverName").value="";
		});
	});
});
function isnumber(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value='';
		return false;
		}
}
function add(){
	if(document.getElementById("Customer").value==""){
		alert("包车客户不能为空!");
		return false; 
	}
	if(document.getElementById("busCard").value==""){
		alert("车牌号不能为空");
		return false; 
	}	
	if(document.getElementById("Seats").value==""){
		alert("车辆不存在");
		return false; 
	}	
	if(document.getElementById("DriverID").value==""){
		alert("驾驶员不能为空");
		return false; 
	}	
	if(document.getElementById("DriverName").value==""){
		alert("驾驶员不存在");
		return false; 
	}		
	
}
function sear(){
	window.location.href='tms_v1_basedata_searcharterebus.php';
}



$(document).ready(function(){
	$("#DriverName").click(function(){
		var driverid = $("#DriverID").val();
		jQuery.get(
			'tms_v1_basedata_getdata.php',
			{'op': 'getdriver', 'driverid': driverid, 'time': Math.random()},
			function (data){
				var objData = eval('(' + data + ')');
				if(objData.retVal == "FAIL"){ 
					alert(objData.retString);
				}else{
					document.getElementById("DriverName").value=objData.DriverName;
				}
		});
	});
});
$(document).ready(function(){
	$("#DriverID").keyup(function(){
		$("#dcard").empty();
		document.getElementById("dcard").style.display=""; 
		var dcard = $("#DriverID").val();
		jQuery.get(
			'tms_v1_basedata_getdata.php',
			{'op': 'getdriver1', 'dcard': dcard, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if(objData.retVal == "FAIL"){ 
					document.getElementById("dcard").style.display="none";
				}
				for (var i = 0; i < objData.length; i++) {
					$("<option value = " + objData[i].DriverCard + "," + objData[i].DriverName + ">" + objData[i].DriverCard + "," + objData[i].DriverName + " </option>").appendTo($("#dcard"));
				}
				if(dcard==''){
					document.getElementById("dcard").style.display="none";
				}
		});
	});
	document.getElementById("dcard").onclick = function (event){
		var ss=document.getElementById("dcard").value.split(',');
		document.getElementById("DriverID").value=ss[0];
		document.getElementById("DriverName").value=ss[1];
		document.getElementById("DriverName1").value=ss[1];
		document.getElementById("dcard").style.display="none";
	};
});
$(document).ready(function(){
	$("#busCard").keyup(function(){
		
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
					$("<option value = " + objData[i].BusNumber +  "," + objData[i].Seats + ">" + objData[i].BusNumber + "</option>").appendTo($("#BusNumberselect"));
				}
				if(BusNumber==''){
					document.getElementById("BusNumberselect").style.display="none";
				}
		});
	});
		document.getElementById("BusNumberselect").onclick = function (event){
		var sb=document.getElementById("BusNumberselect").value.split(',');
		document.getElementById("busCard").value=sb[0];
		if(document.getElementById("busCard").value != ""){
		document.getElementById("Seats1").value=sb[1];
		document.getElementById("Seats").value=sb[1];
		}
		else{
		document.getElementById("Seats1").value='';
			}
		document.getElementById("BusNumberselect").style.display="none";
	};
	});
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">修 改 包 车 </span></td>
  </tr>
</table>
<?php
//连接数据库，获取班次信息
?>
<form action="tms_v1_basedata_modcharterebusok.php" method="post">
<table width="50%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 订单号:</span></td>
        <td bgcolor="#FFFFFF">
        	<input name="ChartereID" id="ChartereID" type="hidden"  value="<?php echo $result['cb_ChartereID'];?>"/>
    		<input name="ChartereI" id="ChartereI" type="text" disabled="disabled" value="<?php echo $result['cb_ChartereID'];?>"/></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />包车客户：</span></td>
		<td bgcolor="#FFFFFF"><input name="Customer" id="Customer" type="text" value="<?php echo $result['cb_Customer'];?>"/><span style="color:red">*</span></td>
	</tr>
	<!--
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车辆编号：</span></td>
    	<td  bgcolor="#FFFFFF"><input type="text" name="BusID" id="BusID" value="<?php echo $result['cb_BusID'];?>">
    	
	</tr> 
	-->
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车牌号：</span></td>
    	<td bgcolor="#FFFFFF"><input name="busCard" id="busCard" type="text" value="<?php echo $result['cb_BusNumber'];?>"/><span style="color:red">*</span>
		<br>
		<select id="BusNumberselect" name="BusNumberselect" class="helplay" multiple="multiple" style="display:none;height:90px;" size="30" ></select>
		</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />驾照号：</span></td>
    	<td bgcolor="#FFFFFF"><input name="DriverID" id="DriverID" type="text" value="<?php echo $result['cb_DriverID'];?>"/><span style="color:red">*</span>
    	<br>
		<select id="dcard" name="dcard" class="helplay" multiple="multiple" style="display:none;height:90px;" size="30" ></select>
		</td>
	</tr> 
	
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />驾驶员：</span></td>
    	<td  bgcolor="#FFFFFF"><input type="hidden" name="DriverName" id="DriverName" value="<?php echo $result['cb_DriverName'];?>">
    	<input type="text" name="DriverName1" id="DriverName1" disabled="disabled" value="<?php echo $result['cb_DriverName'];?>">
    	</td>
	</tr> 
	
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />包车日期：</span></td>
    	<td bgcolor="#FFFFFF"><input name="CharteredBusDate" id="CharteredBusDate" type="text" value="<?php echo $result['cb_CharteredBusDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />包车天数：</span></td>
    	<td bgcolor="#FFFFFF"><input name="CharteredBusDays" id="CharteredBusDays" type="text" value="<?php echo $result['cb_CharteredBusDays'];?>" onkeyup="return isnumber(this.value,this.id)"/></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />起屹地点：</span></td>
    	<td bgcolor="#FFFFFF"><input name="From" id="From" type="text" value="<?php echo $string[0];?>" />到<input name="Reach" id="Reach" type="text" value="<?php echo $string[1];?>" /></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />计费里程：</span></td>
    	<td bgcolor="#FFFFFF"><input name="Kilometers" id="Kilometers" type="text" value="<?php echo $result['cb_Kilometers'];?>"  onkeyup="return isnumber(this.value,this.id)"/>公里</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />核定座位数：</span></td>
    	<td bgcolor="#FFFFFF"><input name="Seats" id="Seats" type="hidden" value="<?php echo $result['cb_Seats'];?>" onkeyup="return isnumber(this.value,this.id)"/>
    	<input name="Seats1" id="Seats1" type="text"  disabled="disabled" value="<?php echo $result['cb_Seats'];?>" />
    	</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />实载人数：</span></td>
    	<td bgcolor="#FFFFFF"><input name="Peoples" id="Peoples" type="text" value="<?php echo $result['cb_Peoples'];?>"  onkeyup="return isnumber(this.value,this.id)"/></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />客运费：</span></td>
    	<td bgcolor="#FFFFFF"><input name="CarriageFee" id="CarriageFee" type="text" value="<?php echo $result['cb_CarriageFee'];?>"  onkeyup="return isnumber(this.value,this.id)"/></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />停滞费：</span></td>
    	<td bgcolor="#FFFFFF"><input name="StagnateFee" id="StagnateFee" type="text" value="<?php echo $result['cb_StagnateFee'];?>" onkeyup="return isnumber(this.value,this.id)"/></td>
	</tr>
<!-- 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />开单日期：</span></td>
    	<td bgcolor="#FFFFFF"><input name="BillingDate" id="BillingDate" type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td>
	</tr>
 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />开单车站：</span></td>
    	<td bgcolor="#FFFFFF"><input name="BillingStation" id="BillingStation" type="text" /></td>
	</tr>
 -->
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="30" rows="5"><?php echo $result['cb_Remark'];?></textarea></td>
	</tr>
 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="submit" type="submit" value="确认" onclick="return add()" />
     	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return sear()"></td>
  </tr>
</table>
</form>