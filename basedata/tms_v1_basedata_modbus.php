﻿<?php 
//修改车辆界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber=$_GET['clnumber'];
	$select="select * from tms_bd_BusInfo where bi_BusID='{$clnumber}'";
	$sele=$class_mysql_default->my_query($select);
	$row=mysqli_fetch_array($sele);
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
					document.getElementById("dcard").style.display="none";
				}
				for (var i = 0; i < objData.length; i++) {
					$("<option value = " + objData[i].DriverCard +">" + objData[i].DriverCard + ','+objData[i].DriverName+"</option>").appendTo($("#dcard"));
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
					if(objData.retVal == "FAIL"){ 
					}
					else{
					document.getElementById("Driver").value=objData.DriverName;
					}
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
					$("<option value = " + objData[i].DriverCard + ">" + objData[i].DriverCard + ','+objData[i].DriverName+"</option>").appendTo($("#dcard1"));
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
					if(objData.retVal == "FAIL"){ 
					}
					else{
					document.getElementById("Driver1").value=objData.DriverName;
					}
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
					$("<option value = " + objData[i].DriverCard +">" + objData[i].DriverCard + ','+objData[i].DriverName+ "</option>").appendTo($("#dcard2"));
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
					if(objData.retVal == "FAIL"){ 
					}
					else{
					document.getElementById("Driver2").value=objData.DriverName;
					}
			});
	});
});
	$(document).ready(function(){ //选择驾照时获取驾驶员姓名信息
		$("#dcard").blur(function(){
			//alert('h');
			var dcard = $("#DriverID").val(); //驾照号	
			jQuery.get( //获取姓名
					'../charterbus/tms_v1_basedata_getdata.php',
					{'op': 'drivername', 'dcard': dcard, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL"){ 
						}
						document.getElementById("Driver").value=objData.DriverName;
				});
		});	
		$("#dcard1").blur(function(){
			var dcard = $("#Driver1ID").val(); //驾照号	
			jQuery.get( //获取驾驶员1姓名
					'../charterbus/tms_v1_basedata_getdata.php',
					{'op': 'drivername', 'dcard': dcard, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL"){ 
						}
						document.getElementById("Driver1").value=objData.DriverName;
				});
		});
			$("#dcard2").blur(function(){
				var dcard = $("#Driver2ID").val(); //驾照号	
				jQuery.get( //获取驾驶员2姓名
						'../charterbus/tms_v1_basedata_getdata.php',
						{'op': 'drivername', 'dcard': dcard, 'time': Math.random()},
						function(data){
							var objData = eval('(' + data + ')');
							if(objData.retVal == "FAIL"){ 
							}
							document.getElementById("Driver2").value=objData.DriverName;
					});
		});			
	});
	
	$(document).ready(function(){ //经营线路
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
		$("#BusID").keyup(function(){
			var code = document.getElementById("BusID").value;
			var code1= document.getElementById("BusI").value;
			if(code != code1){
			jQuery.get( //查看车辆编号和车牌号是否唯一
						'tms_v1_bsaedata_dataProcess.php',
						{'op': 'addbus', 'code': code, 'time': Math.random()},
						function(data){
							var objData = eval('(' + data + ')');
							if( objData.sucess=='1'){
								document.getElementById('code').style.display="";
							}
							else{
								document.getElementById('code').style.display='none';	
							}
			});
			}
			else{
				document.getElementById('code').style.display='none';	
			}
		});
		
		$("#BusNumber").keyup(function(){
			var carnum = document.getElementById("BusNumber").value;
			var carnum1 = document.getElementById("BusNum").value;
			if(carnum != carnum1){
			jQuery.get( //查看车牌号是否唯一
 					'tms_v1_bsaedata_dataProcess.php',
 					{'op': 'addbusnum', 'carnum': carnum, 'time': Math.random()},
 					function(data){
 						var objData = eval('(' + data + ')');
 						if( objData.sucess=='1'){ 
 							document.getElementById('carnum').style.display="";
 						}
 						else{
							document.getElementById('carnum').style.display='none';	
						}
			});
			}
			else{
				document.getElementById('carnum').style.display='none';
			}
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
			alert("车辆编号编号不能为空!");
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
		if(document.getElementById("scanfile").value!=""){
			if(getFileSize(document.getElementById("scanfile").value)==false){
				return false;
			}
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
		 var code1= document.getElementById("BusI").value;
		 var carnum = document.getElementById("BusNumber").value;
		 var carnum1 = document.getElementById("BusNum").value;
		 if(code != code1 && carnum != carnum1){
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
		 if(code != code1 && carnum == carnum1){
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
						 		document.addL.submit();}
			 });
		 }
		 if(code == code1 && carnum != carnum1){
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
		 if(code == code1 && carnum == carnum1){
			 document.addL.submit();
		 }
				 					
	}
	function sear(){
		window.location.href='tms_v1_basedata_searbus.php';
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
	function getFileSize(filePath){ 
		var fso = new ActiveXObject("Scripting.FileSystemObject"); 
//		alert("文件大小为："+fso.GetFile(filePath).size); 
		if(fso.GetFile(filePath).size>2*1024*1024){
				alert("请上传小于2MB的附件");
//				document.getElementById("scanfile").value='';
				return false;
			}
	} 
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">修 改 车 辆  </span></td>
  </tr>
</table>
<?php
//连接数据库，获取班次信息
?>
<div>
<form name="addL" id="addL" action="tms_v1_basedata_modbusok.php" method="post" enctype="multipart/form-data">
<table width="80%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr><td colspan="4">基本信息</td></tr>
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆编号：</span></td>
        <td bgcolor="#FFFFFF">
        		<input name="BusID1" id="BusID1" type="text" disabled="disabled" value="<?php echo $row['bi_BusID'];?>"/>
        		<input name="BusID" id="BusID" type="hidden" value="<?php echo $row['bi_BusID'];?>"/>
        		<input name="BusI" id="BusI" type="hidden" value="<?php echo $row['bi_BusID'];?>"/><span style="color:red">*</span><br><span style="color:red" style="display:none" id="code">&nbsp;已存在相同的车辆编码</span></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 登记日期：</span></td>
		<td bgcolor="#FFFFFF"><input name="RegDate" id="RegDate" type="text" value="<?php echo $row['bi_RegDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /><span style="color:red">*</span></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input name="BusNumbers" id="BusNumbers" type="text" disabled="disabled" value="<?php echo $row['bi_BusNumber'];?>"/>
    		<input name="BusNumber" id="BusNumber" type="hidden" value="<?php echo $row['bi_BusNumber'];?>"/><span style="color:red">*</span><br><span style="color:red" style="display:none" id="carnum">&nbsp;已存在相同车牌号的车辆记录</span>
    		<input name="BusNum" id="BusNum" type="hidden" value="<?php echo $row['bi_BusNumber'];?>"/>
    		</td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型编号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="hidden" name="BusTypeID" id="BusTypeID"  value="<?php echo $row['bi_BusTypeID'];?>"/>
     	 	<input type="text"  name="BusTypeI" id="BusTypeI" disabled="disabled" value="<?php echo $row['bi_BusTypeID'];?>"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型名 ：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="hidden" name="BusType" id="BusType"  value="<?php echo $row['bi_BusType'];?>"/>
    		<input type="text" name="BusTypes" id="BusTypes" disabled="disabled" value="<?php echo $row['bi_BusType'];?>"/>
    		<span style="color:red">*</span>
    	</td>
    	<!--  
    		<select name="BusTypeIDName" onchange="getidname(this.value)">
      			<option value="<?php echo $row['bi_BusTypeID'].','.$row['bi_BusType'].','.$row['bi_SeatS'].','.$row['bi_AddSeatS'];?>"><?php echo $row['bi_BusType'];?></option>
      			<option></option>
      			<?php
      				$sql="SELECT bm_ModelID,bm_ModelName,bm_Seating,bm_AddSeating FROM tms_db_BusModel"; 
      				$query =$class_mysql_default->my_query($sql);
					while($result=mysqli_fetch_array($query)){
      			?>
      			<option value="<?php echo $result['bm_ModelID'].','.$result['bm_ModelName'].','.$result['bm_Seating'].','.$result['bm_AddSeating'];?>"><?php echo $result['bm_ModelName'];?></option>
      			<?php 
					}
      			?>
     	 	</select><input type="hidden" name="BusType" id="BusType" value="<?php echo $row['bi_BusType'];?>"/><span style="color:red">*</span></td>
     	 -->
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 座位数：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="SeatS" id="SeatS" value="<?php echo $row['bi_SeatS'];?>"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 加座数：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="AddSeatS" id="AddSeatS" value="<?php echo $row['bi_AddSeatS'];?>"/></td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 允许半票数：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="AllowHalfSeats" id="AllowHalfSeats" value="<?php echo $row['bi_AllowHalfSeats'];?>"/><br><span style="color:red" style="display:none" id="allowhalf1">允许半票数要小于座位数</span></td> 
    </tr>
    <tr>  
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 吨位：</span></td>
    	<td bgcolor="#FFFFFF"  colspan="3"><input type="text" name="Tonnage" id="Tonnage" value="<?php echo $row['bi_Tonnage'];?>"/>吨</td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input name="BusUnits" id="BusUnits" type="text" disabled="disabled" value="<?php echo $row['bi_BusUnit'];?>"/>
    		<input name="BusUnit" id="BusUnit" type="hidden" value="<?php echo $row['bi_BusUnit'];?>"/>
    	<!--  	
    		<select name="BusUnit">
    			<option></option>
    			<?php
    				$select="SELECT bu_UnitName FROM tms_bd_BusUnit";
    				$sel =$class_mysql_default->my_query($select);
					while($results=mysqli_fetch_array($sel)){ 
						if($results['bu_UnitName']==$row['bi_BusUnit']){
    			?>
    						<option selected="selected" value="<?php echo $row['bi_BusUnit'];?>"><?php echo $row['bi_BusUnit'];?></option>
    			<?php 
						}
						else{
				?>
							<option value="<?php echo $results['bu_UnitName'];?>"><?php echo $results['bu_UnitName'];?></option>
				<?php 
						}
					}
    			?>
    		</select>
    	-->
    		<span style="color:red">*</span></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 厂牌：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Sign" id="Sign"  value="<?php echo $row['bi_Sign'];?>"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发动机型号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="EngineType" id="EngineType" value="<?php echo $row['bi_EngineType'];?>"/></td> 
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发动机号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="EngineNumber" id="EngineNumber" value="<?php echo $row['bi_EngineNumber'];?>"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆识别号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="BusIdentify" id="BusIdentify" value="<?php echo $row['bi_BusIdentify'];?>"/></td> 
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆改型情况：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="BusChangeType" id="BusChangeType" value="<?php echo $row['bi_BusChangeType'];?>"/></td> 
	</tr>
	<tr> 
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站：</span></td>
    	<td bgcolor="#FFFFFF"><select name="InStationIDName" id="InStationIDName" onchange="getstationidname(this.value)">
				<?php 
				if($userStationName == "全部车站"){
				?><option></option><?php 
					$sql = "select sset_SiteID,sset_SiteName FROM tms_bd_SiteSet where sset_IsStation=1";
					$query = $class_mysql_default->my_query($sql);
					while($result=mysqli_fetch_array($query)){
						if($result['sset_SiteName']){
							if($result['sset_SiteName']==$row['bi_InStation']){
				?>				<option selected="selected" value="<?php echo $row['bi_InStation'].','.$row['bi_InStationID'];?>"><?php echo $row['bi_InStation'];?></option>
							<?php 
							}else{
							?>
								<option value="<?php echo $result['sset_SiteID'].','.$result['sset_SiteName'];?>"><?php echo $result['sset_SiteName'];?></option>
							<?php 
							}
						}
					}
				}else{
				?>	
					<option value="<?php echo $row['bi_InStation'].','.$row['bi_InStationID'];?>" selected="selected"><?php echo $row['bi_InStation'];?></option>
				<?php 
				}
				?>			
      		</select><span style="color:red">*</span>
      		<?php if($userStationName == "全部车站"){?>
      			<input type="hidden" name="InStation" id="InStation" value="<?php echo $row['bi_InStation'];?>">
      			<?php 
      				}else{
      			?>
      			<input type="hidden" name="InStation" id="InStation" value="<?php echo $userStationName;?>">
      			<?php 
      				}?></td>
	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站编号：</span></td>
    <td bgcolor="#FFFFFF"><input type="hidden" name="InStationID" id="InStationID" value="<?php echo $row['bi_InStationID'];?>"/>
    		<input type="text" name="InStationI" id="InStationI" disabled="disabled" value="<?php echo $row['bi_InStationID'];?>"/></td>
	</tr>
	<tr><td colspan="4">车主</td></tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车主姓名：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="OwnerName" id="OwnerName"  value="<?php echo $row['bi_OwnerName'];?>"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车主地址：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="OwnerAdd" id="OwnerAdd" value="<?php echo $row['bi_OwnerAdd'];?>"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车主电话：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="OwnerTel" id="OwnerTel" value="<?php echo $row['bi_OwnerTel'];?>"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车主身份证：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="OwnerIdCard" id="OwnerIdCard" value="<?php echo $row['bi_OwnerIdCard'];?>"/></td> 
	</tr>
	<tr><td colspan="4">驾驶员</td></tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 正驾驶驾照号：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="text" name="DriverID" id="DriverID" value="<?php echo $row['bi_DriverID'];?>"/>
    		<br>
			<select id="dcard" name="dcard" class="helplay" multiple="multiple" style="display:none;height:90px;" size="30" onchange="SelectID('dcard','DriverID'); this.style.display='none';"></select>
    		</td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 正驾驶姓名：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Driver" id="Driver" value="<?php echo $row['bi_Driver'];?>"/>
  <!--  		<input type="button" name="button1" value="读卡"/>
   --> 
    	</td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员1驾照号：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="text" name="Driver1ID" id="Driver1ID" value="<?php echo $row['bi_Driver1ID'];?>"/>
    		<br>
			<select id="dcard1" name="dcard1" class="helplay" multiple="multiple" style="display:none;height:90px;" size="30" onchange="SelectID('dcard1','Driver1ID'); this.style.display='none';"></select>
    		</td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员1姓名：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Driver1" id="Driver1" value="<?php echo $row['bi_Driver1'];?>"/>
    <!-- 		<input type="button" name="button2" value="读卡"/>
    -->
    	</td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员2驾照号：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="text" name="Driver2ID" id="Driver2ID" value="<?php echo $row['bi_Driver2ID'];?>"/>
    		<br>
			<select id="dcard2" name="dcard2" class="helplay" multiple="multiple" style="display:none;height:90px;" size="30" onchange="SelectID('dcard2','Driver2ID'); this.style.display='none';"></select>
    	</td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员2姓名：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Driver2" id="Driver2" value="<?php echo $row['bi_Driver2'];?>"/>
    <!--		<input type="button" name="button3" value="读卡"/>
    -->
    	</td> 
	</tr>
	<tr><td colspan="4">保险</td></tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保单号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="InsuranceNo" id="InsuranceNo" value="<?php echo $row['bi_InsuranceNo'];?>"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 承保公司：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="InsuranceCompany" id="InsuranceCompany" value="<?php echo $row['bi_InsuranceCompany'];?>"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 建档日期：</span></td>
    	<td bgcolor="#FFFFFF" colspan="3"><input type="text" name="InsuranceDate" id="InsuranceDate" value="<?php echo $row['bi_InsuranceDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 交强险开始日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="TransportationBeginDate" id="TransportationBeginDate" value="<?php echo $row['bi_TransportationBeginDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结束日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="TransportationEndDate" id="TransportationEndDate" value="<?php echo $row['bi_TransportationEndDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 商业险开始日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="TradeBeginDate" id="TradeBeginDate" value="<?php echo $row['bi_TradeBeginDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结束日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="TradeEndDate" id="TradeEndDate" value="<?php echo $row['bi_TradeEndDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 承运人险开始日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="RenBeginDate" id="RenBeginDate" value="<?php echo $row['bi_RenBeginDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结束日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="RenEndDate" id="RenEndDate" value="<?php echo $row['bi_RenEndDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr><td colspan="4">证照信息</td></tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 经营线路：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="text" name="ManagementLine" id="ManagementLine" value="<?php echo $row['bi_ManagementLine'];?>"/>
    		<br/>
	    	<select id="LineNameselect" name="LineNameselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" onchange="ManagementLine.value=options[selectedIndex].text; this.style.display='none';"></select>
    		</td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路牌号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="LineLicense" id="LineLicense" value="<?php echo $row['bi_LineLicense'];?>"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路牌照附卡号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="LineLicenseAttached" id="LineLicenseAttached" value="<?php echo $row['bi_LineLicenseAttached'];?>"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路牌照附卡有效期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="AttachedEndDate" id="AttachedEndDate" value="<?php echo $row['bi_AttachedEndDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 道路运输证号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="RoadTransport" id="RoadTransport" value="<?php echo $row['bi_RoadTransport'];?>"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 道路运输证有效期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="RoadTransportEndDate" id="RoadTransportEndDate" value="<?php echo $row['bi_RoadTransportEndDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车辆行驶证号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="VehicleDriving" id="VehicleDriving" value="<?php echo $row['bi_VehicleDriving'];?>"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆行驶证有效期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="VehicleDrivingEndDate" id="VehicleDrivingEndDate" value="<?php echo $row['bi_VehicleDrivingEndDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 营运证号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Business" id="Business" value="<?php echo $row['bi_Business'];?>"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 春检完成日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="SpringCheckEndDate" id="SpringCheckEndDate" value="<?php echo $row['bi_SpringCheckEndDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 审验完成日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="ExaminationEndDate" id="ExaminationEndDate"  value="<?php echo $row['bi_ExaminationEndDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 二级维护完成日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="TwoEndDate" id="TwoEndDate" value="<?php echo $row['bi_TwoEndDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 等级评定完成日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="RankEndDate" id="RankEndDate" value="<?php echo $row['bi_RankEndDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 行驶证检验完成日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="TravelEndDatete" id="TravelEndDate" value="<?php echo $row['bi_TravelEndDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 月维护完成日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="MonthEndDate" id="MonthEndDate" value="<?php echo $row['bi_MonthEndDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 液化气证完成日期：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="CNGEndDate" id="CNGEndDate" value="<?php echo $row['bi_CNGEndDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 上传扫描件：</span></td>
    	<td colspan="3" bgcolor="#FFFFFF"><input name="scanfile" id="scanfile" type="file" onchange="getFileSize(this.value)"/><span style="color:red"> 上传文件大小不得大于2MB</span></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td colspan="3" bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5" style="width:90%;" ><?php echo $row['bi_Remark'];?></textarea></td>
	</tr> 
   <tr>
    <td colspan="4" align="center" bgcolor="#FFFFFF"><input name="button1" type="button" value="修改" onclick="return add()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return sear()"></td>
  </tr>
</table>
</form>
</div>

