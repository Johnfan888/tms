﻿<?php 
//添加车辆界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");
	//载入初始化文件
	global $BusNumber;
	require_once("../ui/inc/init.inc.php");
	$BusID = $_GET['reportBusID'];
	$BusNumber1 = $_GET['reportBusCard'];
	$NoOfRunsdate = $_GET['NoOfRunsdate'];//发车日期
	$NoOfRunsID = $_GET['NoOfRunsID'];//班次
	//echo $NoOfRunsID;
	$LineName = $_GET['LineName'];//线路
	$busmodel=$_GET['busmodel']; //售票车型
	$reportCheckWindow = $_GET['reportCheckWindow'];//检票口
	if(isset($_REQUEST['BusID'])){
	$BusNumber=$_POST['BusNumber'];
	}
	
?>
<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		 $('#AllowHalfSeats').keyup(function(){
			    var SeatS1 = document.getElementById('SeatS').value; //座位数
				var AllowHalfSeats1=$("#AllowHalfSeats").val(); //半票数
				if(isNaN(AllowHalfSeats1)){
					alert(AllowHalfSeats1+'不是数字');
					document.getElementById('AllowHalfSeats').value='';
					}
				if(SeatS1 == ""){
					var SeatS1 = 0;}
				if(AllowHalfSeats1 == ""){
					var AllowHalfSeats1 = 0;
					}
			    	var AllowHalfSeats1=parseInt(AllowHalfSeats1);
			    	var SeatS1 = parseInt(SeatS1);
			    	if(SeatS1 < AllowHalfSeats1){
				    	document.getElementById('allowhalf1').style.display='';
			    	}
			    else{
				    document.getElementById('allowhalf1').style.display='none';
			    }
		  });
		 $('#SeatS').keyup(function(){
			    var SeatS1 = document.getElementById('SeatS').value; //座位数
				var AllowHalfSeats1=$("#AllowHalfSeats").val(); //半票数
				if(isNaN(SeatS1)){
					alert(SeatS1+'不是一个数字');
					document.getElementById('SeatS').value='';
					}
				if(SeatS1 == ""){
					var SeatS1 = 0;
					}
				if(AllowHalfSeats1 == ""){
					var AllowHalfSeats1 = 0;
					}
			    	var AllowHalfSeats1=parseInt(AllowHalfSeats1);
			    	var SeatS1 = parseInt(SeatS1);
			    	if(SeatS1 < AllowHalfSeats1){
				    	document.getElementById('allowhalf1').style.display='';
			    	}
			   else{
				    document.getElementById('allowhalf1').style.display='none';
			    }
		 });
	});
	function SelectID(str,str1){
	 var dcard = document.getElementById(str).value;
	 document.getElementById(str1).value  = dcard;
	}
	$(document).ready(function(){ //匹配驾照信息
		$("#DriverID").keyup(function(){
			$("#dcard").empty();
			document.getElementById("dcard").style.display=""; 
			var dcard = $("#DriverID").val(); //驾照号
			jQuery.get(
				'../charterbus/tms_v1_basedata_getdata.php',
				{'op': 'getdriver1', 'dcard': dcard, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						document.getElementById("dcard").style.display="none";//支持在数据库中不存在的驾驶员信息录入
					}
					for (var i = 0; i < objData.length; i++) {
						$("<option value = " + objData[i].DriverCard +">" + objData[i].DriverCard +  "," + objData[i].DriverName + "</option>").appendTo($("#dcard"));
					}
					if(dcard==''){
						document.getElementById("dcard").style.display="none";
					}
			});
			jQuery.get( //获取姓名
					'../charterbus/tms_v1_basedata_getdata.php',
					{'op': 'drivername', 'dcard': dcard, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						//if(objData.retVal == "SUCC"){ 
						document.getElementById("Driver").value=objData.DriverName;
					//	}
				});
		});
		$("#Driver1ID").keyup(function(){
			$("#dcard1").empty();
			document.getElementById("dcard1").style.display=""; 
			var dcard = $("#Driver1ID").val();
			jQuery.get(
				'../charterbus/tms_v1_basedata_getdata.php',
				{'op': 'getdriver1', 'dcard': dcard, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						document.getElementById("dcard1").style.display="none";
					}
					for (var i = 0; i < objData.length; i++) {
						$("<option value = " + objData[i].DriverCard +">" + objData[i].DriverCard +  "," + objData[i].DriverName + "</option>").appendTo($("#dcard1"));
					}
					if(dcard==''){
						document.getElementById("dcard1").style.display="none";
					}
			});
			jQuery.get( //获取姓名
					'../charterbus/tms_v1_basedata_getdata.php',
					{'op': 'drivername', 'dcard': dcard, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						//if(objData.retVal == "SUCC"){ 
						document.getElementById("Driver1").value=objData.DriverName;
						//}
				});
		});
		$("#Driver2ID").keyup(function(){
			$("#dcard2").empty();
			document.getElementById("dcard2").style.display=""; 
			var dcard = $("#Driver2ID").val();
			jQuery.get(
				'../charterbus/tms_v1_basedata_getdata.php',
				{'op': 'getdriver1', 'dcard': dcard, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						document.getElementById("dcard2").style.display="none";
					}
					for (var i = 0; i < objData.length; i++) {
						$("<option value = " + objData[i].DriverCard +">" + objData[i].DriverCard +  "," + objData[i].DriverName + "</option>").appendTo($("#dcard2"));
					}
					if(dcard==''){
						document.getElementById("dcard2").style.display="none";
					}
			});
			jQuery.get( //获取姓名
					'../charterbus/tms_v1_basedata_getdata.php',
					{'op': 'drivername', 'dcard': dcard, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						//if(objData.retVal == "SUCC"){ 
						document.getElementById("Driver2").value=objData.DriverName;
						//}
				});
		});
	});
		$(document).ready(function(){ //选择驾照时获取驾驶员姓名信息
			$("#dcard").blur(function(){
				var dcard = $("#DriverID").val(); //驾照号	
				jQuery.get( //获取姓名
						'../charterbus/tms_v1_basedata_getdata.php',
						{'op': 'drivername', 'dcard': dcard, 'time': Math.random()},
						function(data){
							var objData = eval('(' + data + ')');
							//if(objData.retVal == "SUCC"){ 
							document.getElementById("Driver").value=objData.DriverName;
							//}
					});
			});	
			$("#dcard1").blur(function(){
				var dcard = $("#Driver1ID").val(); //驾照号	
				jQuery.get( //获取驾驶员1姓名
						'../charterbus/tms_v1_basedata_getdata.php',
						{'op': 'drivername', 'dcard': dcard, 'time': Math.random()},
						function(data){
							var objData = eval('(' + data + ')');
						//	if(objData.retVal == "SUCC"){ 
							document.getElementById("Driver1").value=objData.DriverName;
							//}
					});
			});
				$("#dcard2").blur(function(){
					var dcard = $("#Driver2ID").val(); //驾照号	
					jQuery.get( //获取驾驶员2姓名
							'../charterbus/tms_v1_basedata_getdata.php',
							{'op': 'drivername', 'dcard': dcard, 'time': Math.random()},
							function(data){
								var objData = eval('(' + data + ')');
								//if(objData.retVal == "SUCC"){ 
								document.getElementById("Driver2").value=objData.DriverName;
								//}
						});
			});			
		});
	$(document).ready(function(){
		$("#ManagementLine").keyup(function(){
			$("#LineNameselect").empty();
			document.getElementById("LineNameselect").style.display=""; 
			var LineName = $("#ManagementLine").val();	
			jQuery.get(
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'GETLINE', 'LineName': LineName,'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					for (var i = 0; i < objData.length; i++) {
						$("<option value = " + objData[i].LineName + ">" + objData[i].LineName + "</option>").appendTo($("#LineNameselect"));
					}
					if(LineName==''){
						document.getElementById("LineNameselect").style.display="none";
					}
			});
		});
	});
	function add(){
		var AllowHalfSeats = document.getElementById('AllowHalfSeats').value;
		var SeatS = document.getElementById('SeatS').value;
		if(SeatS == ""){
			var SeatS = 0;
			}
		if(AllowHalfSeats == ""){
			var AllowHalfSeats = 0;
			}
		var SeatS = parseInt(SeatS);
		var AllowHalfSeats = parseInt(AllowHalfSeats);
		if(document.getElementById("BusID").value == ""){
			alert("车辆编号不能为空!");
			document.getElementById("BusID").focus();
			return false; 
		}
		if(document.getElementById("RegDate").value== ""){
			alert("登记日期不能为空!");
			document.getElementById("RegDate").focus();
			return false; 
		}
		if(document.getElementById("BusNumber").value== ""){
			alert("车牌号不能为空!");
			document.getElementById("BusNumber").focus();
			return false; 
		}	
		if(document.getElementById("BusTypeID").value== ""){
			alert("车型不能为空!");
			document.getElementById("BusTypeID").focus();
			return false; 
		}
		if(document.getElementById("BusUnit").value== ""){ 
			alert("车属单位不能为空!");
			document.getElementById("BusUnit").focus();
			return false; 
		}
		if(document.getElementById("InStation").value== ""){
			alert("所属车站不能为空!");
			document.getElementById("InStation").focus();
			return false; 
		}
		if(AllowHalfSeats > SeatS){
			alert("允许半票数不能大于总座位数："+SeatS);
			return false;
			}
		 var code = document.getElementById("BusID").value;	
		 var carnum = document.getElementById("BusNumber").value;
		 jQuery.get( //查看车辆编号和车牌号是否唯一
					'tms_v1_bsaedata_dataProcess.php',
					{'op': 'addbus', 'code': code, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if( objData.sucess=='1'){
							alert('已存在相同的车辆编号,请注意查看');
							return false;
						}
				 		else{
				 			 jQuery.get(
				 					'tms_v1_bsaedata_dataProcess.php',
				 					{'op': 'addbusnum', 'carnum': carnum, 'time': Math.random()},
				 					function(data){
				 						var objData = eval('(' + data + ')');
				 						if( objData.sucess=='1'){
				 							alert('已存在此车牌号的车辆，请注意查看');
				 							return false;
				 						}
				 						else{
				 				 			document.addL.submit();}
				 				});
				 			}
				 		});			
	}
	function sear(){
		var busmodel = document.getElementById("busmodel").value; //售票车型
		var BusNumber = document.getElementById("BusNum").value; 
		var LineName = document.getElementById("LineName").value; //线路
		var NoOfRunsdate = document.getElementById("NoOfRunsdate").value; //发车日期
		var NoOfRunsID = document.getElementById("NoOfRunsID").value; //班次修改
		var reportCheckWindow = document.getElementById("reportCheckWindow").value; //检票口
		location.assign('../schedule/tms_v1_schedule_noofrunsreport.php?BusNumber='+BusNumber+'&NoOfRunsdate='+NoOfRunsdate+'&NoOfRunsID='+NoOfRunsID+'&reportCheckWindow='+reportCheckWindow+'&LineName='+LineName+'&busmodel='+busmodel);
	}
	function getidname(str){
		var st=str.split(',');
		document.getElementById("BusType").value=st[1];
		document.getElementById("BusTypeID").value=st[0];
		document.getElementById("BusTypeI").value=st[0];
	//	document.getElementById("SeatS").value=st[2];
	//	document.getElementById("Seat").value=st[2];
	//	document.getElementById("AddSeatS").value=st[3];
	//	document.getElementById("AddSeat").value=st[3];
	}
	function getstationidname(str){
		var st=str.split(',');
		document.getElementById("InStationID").value=st[0];
		document.getElementById("InStationI").value=st[0];
		document.getElementById("InStation").value=st[1];
	}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 车 辆  </span></td>
  </tr>
</table>
<?php
//连接数据库，获取班次信息
?>
<div>
<form name="addL" id="addL" action="" method="post" enctype="multipart/form-data">
<table width="80%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr><td colspan="4">基本信息</td></tr>
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆编号：</span></td>
        <td bgcolor="#FFFFFF"><input name="BusID" id="BusID" type="text" value="<?php echo $BusID?>"/><span style="color:red">*</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 登记日期：</span></td>
		<td bgcolor="#FFFFFF"><input name="RegDate" id="RegDate" type="text" class="Wdate" value="<?php print date('Y-m-d');?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/><span style="color:red">*</span></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input name="BusNumber" id="BusNumber" type="text" value="<?php echo $BusNumber1?>"/><span style="color:red">*</span>
    		<input name="BusNum" id="BusNum" type="hidden" value="<?php echo $BusNumber?>"/>
    	</td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型编号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="hidden" name="BusTypeID" id="BusTypeID" />
     	 	<input type="text"  name="BusTypeI" id="BusTypeI" disabled="disabled"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型名：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="BusTypeIDName" onchange="getidname(this.value)">
      			<option></option>
      			<?php
      				$sql="SELECT bm_ModelID,bm_ModelName,bm_Seating,bm_AddSeating FROM tms_bd_BusModel"; 
      				$query =$class_mysql_default->my_query($sql);
					while($result=mysqli_fetch_array($query)){
      			?>
      			<option value="<?php echo $result['bm_ModelID'].','.$result['bm_ModelName'].','.$result['bm_Seating'].','.$result['bm_AddSeating'];?>"><?php echo $result['bm_ModelName'];?></option>
      			<?php 
					}
      			?>
     	 	</select><input type="hidden" name="BusType" id="BusType"/><span style="color:red">*</span></td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 座位数：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="SeatS" id="SeatS" /></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 加座数：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="AddSeatS" id="AddSeatS" /></td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 允许半票数：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="text" name="AllowHalfSeats" id="AllowHalfSeats" /><br><span style="color:red" style="display:none" id="allowhalf1">允许半票数要小于座位数</span>
    	</td> 
    </tr>
    <tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 吨位：</span></td>
    	<td colspan="3" bgcolor="#FFFFFF"><input type="text" name="Tonnage" id="Tonnage"/>吨</td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="BusUnit">
    			<option></option>
    			<?php
    				$select="SELECT bu_UnitName FROM tms_bd_BusUnit";
    				$sel =$class_mysql_default->my_query($select);
					while($results=mysqli_fetch_array($sel)){ 
    			?>
    			<option value="<?php echo $results['bu_UnitName'];?>"><?php echo $results['bu_UnitName'];?></option>
    			<?php 
					}
    			?>
    		</select><span style="color:red">*</span></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 厂牌：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Sign" id="Sign"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发动机型号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="EngineType" id="EngineType"/></td> 
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发动机号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="EngineNumber" id="EngineNumber"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆识别号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="BusIdentify" id="BusIdentify"/></td> 
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆改型情况：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="BusChangeType" id="BusChangeType"/></td> 
	</tr>
	<tr> 
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站：</span></td>
    	<td bgcolor="#FFFFFF">
    	    <select name="InStationIDName" id="InStationIDName" onchange="getstationidname(this.value)">     			
				<?php 
				if($userStationName == "全部车站"){
					?><option></option><?php 
					$sql = "select sset_SiteID, sset_SiteName FROM tms_bd_SiteSet where sset_IsStation=1";
					$query = $class_mysql_default->my_query($sql);
					while($result=mysqli_fetch_array($query)){
			//			if($result['sset_SiteName']){
				?>	
					<option value="<?php echo $result['sset_SiteID'].','.$result['sset_SiteName'];?>"><?php echo $result['sset_SiteName'];?></option>
				<?php 
					//	}
					}
				}else{
				?>	
					<option value="<?php echo $userStationID.','.$userStationName;?>" selected="selected"><?php echo $userStationName;?></option>
				<?php 
				}
				?>			
      		</select><span style="color:red">*</span>
      		<?php if($userStationName == "全部车站"){
      			?><input type="hidden" name="InStation" id="InStation">
      			<?php 
      		}else{
      			?>
      			<input type="hidden" name="InStation" id="InStation" value="<?php echo $userStationName;?>">
      			<?php 
      		}?></td>
	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站编号：</span></td>
    	<td bgcolor="#FFFFFF">
    	<?php 
    		if($userStationName == "全部车站"){
        ?><input name="InStationID" id="InStationID" type="hidden"/><input name="InStationI" id="InStationI" disabled="disabled"/>
		<?php 
    		}else{
				?>
			<input name="InStationID" id="InStationID" type="hidden" value="<?php echo $userStationID;?>"/><input name="InStationI" id="InStationI" disabled="disabled" value="<?php echo $userStationID;?>"/>
		<?php }?>	
    		</td>
	</tr>
	<tr><td colspan="4">车主</td></tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车主姓名：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="OwnerName" id="OwnerName"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车主地址：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="OwnerAdd" id="OwnerAdd"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车主电话：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="OwnerTel" id="OwnerTel"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车主身份证：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="OwnerIdCard" id="OwnerIdCard"/></td> 
	</tr>
	<tr><td colspan="4">驾驶员</td></tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 正驾驶驾照号：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="text" name="DriverID" id="DriverID"/>
    		<br>
			<select id="dcard" name="dcard" class="helplay" multiple="multiple" style="display:none;height:90px;" size="30" onchange="SelectID('dcard','DriverID'); this.style.display='none';"></select>
    	</td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 正驾驶姓名：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Driver" id="Driver"/>
   <!--   		<input type="button" name="button1" value="读卡"/>
   -->
    	</td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员1驾照号：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="text" name="Driver1ID" id="Driver1ID"/>
    		<br>
			<select id="dcard1" name="dcard1" class="helplay" multiple="multiple" style="display:none;height:90px;" size="30" onchange="SelectID('dcard1','Driver1ID'); this.style.display='none';"></select>
    	</td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员1姓名：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Driver1" id="Driver1"/>
   <!--
   		<input type="button" name="button2" value="读卡"/>
   	 -->
    	</td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员2驾照号：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="text" name="Driver2ID" id="Driver2ID"/>
    		<br>
			<select id="dcard2" name="dcard2" class="helplay" multiple="multiple" style="display:none;height:90px;" size="30" onchange="SelectID('dcard2','Driver2ID'); this.style.display='none';"></select>
    	</td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员2姓名：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Driver2" id="Driver2"/>
  <!--  		<input type="button" name="button3" value="读卡"/>
  -->
    	</td> 
	</tr>
	<tr><td colspan="4">保险</td></tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保单号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="InsuranceNo" id="InsuranceNo"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 承保公司：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="InsuranceCompany" id="InsuranceCompany"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 建档日期：</span></td>
    	<td colspan="3"  bgcolor="#FFFFFF"><input type="text" name="InsuranceDate" id="InsuranceDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 交强险开始日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="TransportationBeginDate" id="TransportationBeginDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结束日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="TransportationEndDate" id="TransportationEndDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 商业险开始日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="TradeBeginDate" id="TradeBeginDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结束日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="TradeEndDate" id="TradeEndDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 承运人险开始日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="RenBeginDate" id="RenBeginDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结束日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="RenEndDate" id="RenEndDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr><td colspan="4">证照信息</td></tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 经营线路：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="text" name="ManagementLine" id="ManagementLine"/>
    		<br/>
	    	<select id="LineNameselect" name="LineNameselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" onchange="ManagementLine.value=options[selectedIndex].text; this.style.display='none';"></select>
    		</td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路牌号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="LineLicense" id="LineLicense"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路牌照附卡号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="LineLicenseAttached" id="LineLicenseAttached"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路牌照附卡有效期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="AttachedEndDate" id="AttachedEndDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 道路运输证号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="RoadTransport" id="RoadTransport"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 道路运输证有效期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="RoadTransportEndDate" id="RoadTransportEndDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆行驶证号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="VehicleDriving" id="VehicleDriving"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆行驶证有效期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="VehicleDrivingEndDate" id="VehicleDrivingEndDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 营运证号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Business" id="Business"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 春检完成日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="SpringCheckEndDate" id="SpringCheckEndDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 审验完成日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="ExaminationEndDate" id="ExaminationEndDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 二级维护完成日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="TwoEndDate" id="TwoEndDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 等级评定完成日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="RankEndDate" id="RankEndDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 行驶证检验完成日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="TravelEndDatete" id="TravelEndDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 月维护完成日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="MonthEndDate" id="MonthEndDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 液化气证完成日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="CNGEndDate" id="CNGEndDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 上传扫描件：</span></td>
    	<td colspan="3" bgcolor="#FFFFFF"><input name="scanfile" type="file" /></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 备注：</span></td>
    	<td colspan="3" bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"></textarea></td>
	</tr> 
   <tr>
    <td colspan="4" align="center" bgcolor="#FFFFFF"><input name="button1" type="button" value="添加" onclick="return add()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return sear()"></td>
  </tr>
  <?php
	if(isset($_REQUEST['BusID'])){
	$BusID=$_POST['BusID'];
	$RegDate=$_POST['RegDate'];
	$BusNumber=$_POST['BusNumber'];
	$BusTypeID=$_POST['BusTypeID'];
	$BusType=$_POST['BusType'];
	$SeatS=$_POST['SeatS'];
	$AddSeatS=$_POST['AddSeatS'];
	$AllowHalfSeats=$_POST['AllowHalfSeats'];
	$Tonnage=$_POST['Tonnage'];
	$BusUnit=$_POST['BusUnit'];
	$Sign=$_POST['Sign'];
	$EngineType=$_POST['EngineType'];
	$EngineNumber=$_POST['EngineNumber'];
	$BusIdentify=$_POST['BusIdentify'];
	$BusChangeType=$_POST['BusChangeType'];
	$InStationID=$_POST['InStationID'];
	$InStation=$_POST['InStation'];
	$OwnerName=$_POST['OwnerName'];
	$OwnerAdd=$_POST['OwnerAdd'];
	$OwnerTel=$_POST['OwnerTel'];
	$OwnerIdCard=$_POST['OwnerIdCard'];
	$DriverID=$_POST['DriverID'];
	$Driver=$_POST['Driver'];
	$Driver1ID=$_POST['Driver1ID'];
	$Driver1=$_POST['Driver1'];
	$Driver2ID=$_POST['Driver2ID'];
	$Driver2=$_POST['Driver2'];
	$InsuranceNo=$_POST['InsuranceNo'];
	$InsuranceCompany=$_POST['InsuranceCompany'];
	$InsuranceDate=$_POST['InsuranceDate'];
	$TransportationBeginDate=$_POST['TransportationBeginDate'];
	$TransportationEndDate=$_POST['TransportationEndDate'];
	$TradeBeginDate=$_POST['TradeBeginDate'];
	$TradeEndDate=$_POST['TradeEndDate'];
	$RenBeginDate=$_POST['RenBeginDate'];
	$RenEndDate=$_POST['RenEndDate'];
	$ManagementLine=$_POST['ManagementLine'];
	$LineLicense=$_POST['LineLicense'];
	$LineLicenseAttached=$_POST['LineLicenseAttached'];
	$AttachedEndDate=$_POST['AttachedEndDate'];
	$RoadTransport=$_POST['RoadTransport'];
	$RoadTransportEndDate=$_POST['RoadTransportEndDate'];
	$VehicleDriving=$_POST['VehicleDriving'];
	$VehicleDrivingEndDate=$_POST['VehicleDrivingEndDate'];
	$Business=$_POST['Business'];
	$SpringCheckEndDate=$_POST['SpringCheckEndDate'];
	$ExaminationEndDate=$_POST['ExaminationEndDate'];
	$TwoEndDate=$_POST['TwoEndDate'];
	$RankEndDate=$_POST['RankEndDate'];
	$TravelEndDatete=$_POST['TravelEndDatete'];
	$MonthEndDate=$_POST['MonthEndDate'];
	$CNGEndDate=$_POST['CNGEndDate'];
	$Remark=$_POST['Remark'];
	$CurTime=date('Y-m-d H:i:s');
	if($_FILES['scanfile']['name'] != '') {
		if($_FILES['scanfile']['error'] > 0) {
			switch($_FILES['scanfile']['error']) {
				case 1:
					echo "<script>alert('文件大小超过了配置文件中的限制！');history.back();</script>";
					break;
				case 2:
					echo "<script>alert('文件大小超过了浏览器限制！');history.back();</script>";
					break;
				case 3:
					echo "<script>alert('文件部分被上传！');history.back();</script>";
					break;
				case 4:
					echo "<script>alert('没有找到要上传的文件！');history.back();</script>";
					break;
				case 5:
					echo "<script>alert('服务器临时文件夹丢失，请重新上传！');history.back();</script>";
					break;
				case 6:
					echo "<script>alert('文件写入到临时文件夹出错！');history.back();</script>";
					break;
			}
		} else {
			if($_FILES['scanfile']['size'] < 2048000) {
				$fileName = $_FILES['scanfile']['name'];
				$extName = pathinfo($fileName, PATHINFO_EXTENSION);
				$saveFilePath = "scanFiles/busfile" . $BusID . ".$extName";
				move_uploaded_file($_FILES['scanfile']['tmp_name'], $saveFilePath);
			} else {
				echo "<script>alert('请上传小于2MB的附件');history.back();</script>";
			}
		}
	}

	$select="select * from tms_bd_BusInfo where bi_BusID='{$BusID}'";
	$sele=$class_mysql_default->my_query($select);
	$select="select * from tms_bd_BusInfo where bi_BusNumber='$BusNumber'";
	$sele1=$class_mysql_default->my_query($select);
	if(!mysqli_fetch_array($sele) && !mysqli_fetch_array($sele1)){
			$insert="insert into tms_bd_BusInfo (bi_BusID,bi_BusNumber,bi_BusUnit,bi_SeatS,bi_AddSeatS,bi_AllowHalfSeats,bi_DriverID,
				bi_Driver,bi_Driver1ID,bi_Driver1,bi_Driver2ID,bi_Driver2,bi_RegDate,bi_Tonnage,bi_OwnerName,bi_OwnerAdd,
				bi_OwnerTel,bi_OwnerIdCard,bi_BusTypeID,bi_BusType,bi_EngineType,bi_EngineNumber,bi_BusIdentify,bi_BusChangeType,
				bi_Remark,bi_InsuranceNo,bi_InsuranceCompany,bi_InsuranceDate,bi_TransportationBeginDate,bi_TransportationEndDate,
				bi_TradeBeginDate,bi_TradeEndDate,bi_RenBeginDate,bi_RenEndDate,bi_ManagementLine,bi_LineLicense,bi_LineLicenseAttached,
				bi_AttachedEndDate,bi_RoadTransport,bi_RoadTransportEndDate,bi_VehicleDriving,bi_VehicleDrivingEndDate,bi_Business,
				bi_SpringCheckEndDate,bi_ExaminationEndDate,bi_TwoEndDate,bi_RankEndDate,bi_TravelEndDate,
				bi_MonthEndDate,bi_CNGEndDate,bi_Sign,bi_InStationID,bi_InStation,bi_AdderID,bi_Adder,bi_AddTime,bi_fileName,bi_ScanPath) 
				values('{$BusID}','{$BusNumber}','{$BusUnit}','{$SeatS}','{$AddSeatS}','{$AllowHalfSeats}','{$DriverID}','{$Driver}','{$Driver1ID}','{$Driver1}','{$Driver2ID}','{$Driver2}','{$RegDate}','{$Tonnage}',
				'{$OwnerName}','{$OwnerAdd}','{$OwnerTel}','{$OwnerIdCard}','{$BusTypeID}','{$BusType}','{$EngineType}','{$EngineNumber}',
				'{$BusIdentify}','{$BusChangeType}','{$Remark}','{$InsuranceNo}','{$InsuranceCompany}','{$InsuranceDate}','{$TransportationBeginDate}',
				'{$TransportationEndDate}','{$TradeBeginDate}','{$TradeEndDate}','{$RenBeginDate}','{$RenEndDate}','{$ManagementLine}',
				'{$LineLicense}','{$LineLicenseAttached}','{$AttachedEndDate}','{$RoadTransport}','{$RoadTransportEndDate}','{$VehicleDriving}','{$VehicleDrivingEndDate}',
				'{$Business}','{$SpringCheckEndDate}','{$ExaminationEndDate}','{$TwoEndDate}','{$RankEndDate}','{$TravelEndDatete}','{$MonthEndDate}','{$CNGEndDate}','{$Sign}',
				'{$InStationID}','{$InStation}','{$userID}','{$userName}','{$CurTime}','{$fileName}','{$saveFilePath}')";
			$query = $class_mysql_default->my_query($insert);
		//	if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
			if($query){
				echo"<script>alert('恭喜您！添加成功!');</script>";
			}else{
				echo"<script>alert('添加失败');</script>";
			}
	}elseif(mysqli_fetch_array($sele) && !mysqli_fetch_array($sele1)){
			echo"<script>alert('车辆编号已存在，请重新输入！');</script>";
		}
	else{
			echo"<script>alert('已存在此车牌号的记录,请注意查看');</script>";
	}
	}
?>
</table>
	<input type="hidden" name="NoOfRunsdate" id="NoOfRunsdate" value="<?php echo $NoOfRunsdate;?>"/>
	<input type="hidden" name="NoOfRunsID" id="NoOfRunsID" value="<?php echo $NoOfRunsID;?>"/>
	<input type="hidden" name="LineName" id="LineName" value="<?php echo $LineName;?>"/>
	<input type="hidden" name="reportCheckWindow" id="reportCheckWindow" value="<?php echo $reportCheckWindow;?>"/>
	<input type="hidden" name="busmodel" id="busmodel" value="<?php echo $busmodel?>">
</form>
</div>
