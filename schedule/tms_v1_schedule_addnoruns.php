<?php
//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
if(isset($_POST['NoOfRunsID'])){
	$NoOfRunsID=$_POST['NoOfRunsID'];
	$LineName=$_POST['LineName'];
	$BusUnit=$_POST['BusUnit'];
	$BeginDate=$_POST['BeginDate'];
	$EndDate=$_POST['EndDate'];
	$BusModelID=$_POST['ModelID'];
	$BusModel=$_POST['ModelName'];
	$DepartureTime=$_POST['DepartureTime'];
	$Laborfee=$_POST['Laborfee'];
	$LineID=$_POST['LineID'];
}
else if(isset($_GET['op'])) {
//	$LineID = $_GET['LineID'];
	$LineName = $_GET['line'];
	$NoOfRunsID=$_GET['nrID'];
	$NoOfRunsdate=$_GET['nrDate'];
//	$BusUnit=$_GET['bUnit'];
	$selectmode="SELECT tml_BusModelID,tml_BusModel,tml_BusUnit,tml_LineID FROM tms_bd_TicketMode WHERE tml_NoOfRunsID='{$NoOfRunsID}' AND 
		tml_NoOfRunsdate='{$NoOfRunsdate}'";
	$querymode=$class_mysql_default ->my_query($selectmode);
	$rowmode=mysql_fetch_array($querymode);
	$BusUnit=$rowmode['tml_BusUnit'];
	$BusModel=$rowmode['tml_BusModel'];
	$BusModelID=$rowmode['tml_BusModelID'];
	$LineID=$rowmode['tml_LineID'];
}
else {
	// do nothing
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>临时加班</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<link href="../css/tms.css" rel="stylesheet" type="text/css" />
	<link href="../js/ui/jquery-ui.css" rel="stylesheet" type="text/css" />
	<link href="../js/jQuery-Timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css" />
 	<script type="text/javascript" src="../js/jquery-1.8.2.js"></script>
	<script type="text/javascript" src="../js/ui/jquery-ui.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="../js/jQuery-Timepicker/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="../js/jQuery-Timepicker/jquery-ui-sliderAccess.js"></script>
	<script type="text/javascript" src="../js/jQuery-Timepicker/i18n/jquery-ui-timepicker-zh-CN.js"></script>
	<script type="text/javascript" src="../basedata/tms_v1_rightclick.js"></script>
	<script type="text/javascript">
	function isnumber(number,id){
		if(isNaN(number)){
			alert(number+"不是数字！");
			document.getElementById(id).value= "";
			return false;
		}
	}
	function addrun(){
		if(document.getElementById("BusUnit").value==''){
			alert('请选择车属单位！');
			return false;
		}
		if(document.getElementById("BeginDate").value==''){
			alert('请选择加班开始日期！');
			return false;
		}
		if(document.getElementById("EndDate").value==''){
			alert('请选择加班截止日期！');
			return false;
		}
		if(document.getElementById("DepartureTime").value==''){
			alert('请输入发车时间！');
			return false;
		}
		if(document.getElementById("Model").value==''){
			alert('请选择车型！');
			return false;
		}
		if(document.getElementById("Laborfee").value==''){
			alert('请输入加班劳务费！');
			return false;
		}
		jQuery.get(
			'tms_v1_schedule_dataops.php',
			{'op': 'ADDRUN', 'NoOfRunsID': $("#NoOfRunsID").val(),'BeginDate': $("#BeginDate").val(), 
				'EndDate': $("#EndDate").val(), 'DepartureTime': $("#DepartureTime").val(), 'ModelID': $("#ModelID").val(), 
				'BusModel': $("#ModelName").val(),'BusUnit': $("#BusUnit").val(), 'Laborfee': $("#Laborfee").val(),'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if(objData.retVal == "FAIL"){ 
					alert(objData.retString);
				}else{
					alert(objData.retString);
					document.form1.submit();
				}
		}); 
	}
	function makemodel(){
		if(document.getElementById("AddRuns").value==''){
			alert('请选择班次！');
			return false;
		}
		if(document.getElementById("BeginDate").value==''){
			alert('请选择加班开始日期！');
			return false;
		}
		if(document.getElementById("EndDate").value==''){
			alert('请选择加班截止日期！');
			return false;
		}
		jQuery.get(
			'tms_v1_schedule_dataops.php',
			{'op': 'MAKEMODEL', 'NoOfRunsID': $("#AddRuns").val(), 'BeginDate':$("#BeginDate").val(), 'EndDate':$("#EndDate").val(),
				'DepartureTime': $("#DepartureTime").val(),'LineID':$("#LineID").val(),'Laborfee': $("#Laborfee").val(),'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if(objData.retVal == "SUCC"){
					if(objData.retStrings=='' && objData.retStringf!=''){
						alert('票版失败信息：'+'\r\n'+objData.retStringf);
					}
					if(objData.retStrings!='' && objData.retStringf==''){
						alert('票版成功信息：'+'\r\n'+objData.retStrings);
					}
					if(objData.retStrings!='' && objData.retStringf!=''){
						alert('票版成功信息：'+'\r\n'+objData.retStrings+'\r\n'+'票版失败信息：'+'\r\n'+objData.retStringf);
					} 
				//	alert('票版成功信息：'+objData.retStrings+'\r\n'+'票版失败信息：'+objData.retStringf);
					document.form1.submit();
				}
			/*	var objData = eval('(' + data + ')');
				if(objData.retVal == "FAIL"){ 
					alert(objData.retString);
				}else{
					alert(objData.retString);
					document.form1.submit();
				} */
		});
	}
	function deladd(){
		if(document.getElementById("AddRuns").value=='' ){
			alert('请选择班次！');
			return false;
		}
		if(document.getElementById("IsModel").value=='是' ){
			alert('该班次已经生成票版不能删除！');
			return false;
		} 
		if(!confirm("确定要删除该数据吗？")){
			return false;
		}   
		jQuery.get(
			'tms_v1_schedule_dataops.php',
			{'op': 'DELRUN', 'AddRuns': $("#AddRuns").val(), 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if(objData.retVal == "FAIL"){ 
					alert(objData.retString);
				}else{
					alert(objData.retString);
					document.form1.submit();
				}
			}); 
	}
	function delticketmodel(){
		if(document.getElementById("AddRuns").value==''){
			alert('请选择班次！');
			return false;
		}
		if(document.getElementById("BeginDate").value==''){
			alert('请选择删除开始日期！');
			return false;
		}
		if(document.getElementById("EndDate").value==''){
			alert('请选择删除截止日期！');
			return false;
		}
		if(confirm("确定要删除班次："+document.getElementById("AddRuns").value+"，从"+document.getElementById("BeginDate").value+"到"+document.getElementById("EndDate").value+"票版吗？")){
			jQuery.get(
				'tms_v1_schedule_dataops.php',
				{'op': 'DELMODEL', 'NoOfRunsID': $("#AddRuns").val(), 'BeginDate':$("#BeginDate").val(), 'EndDate':$("#EndDate").val(),'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if(objData.retVal == "SUCC"){ 
						if(objData.retStrings=='' && objData.retStringf!=''){
							alert('删除失败信息：'+'\r\n'+objData.retStringf);
						}
						if(objData.retStrings!='' && objData.retStringf==''){
							alert('删除成功信息：'+'\r\n'+objData.retStrings);
						}
						if(objData.retStrings!='' && objData.retStringf!=''){
							alert('删除成功信息：'+'\r\n'+objData.retStrings+'\r\n'+'删除失败信息：'+'\r\n'+objData.retStringf);
						}
					//	alert('删除成功信息：'+objData.retStrings+'\r\n'+'删除失败信息：'+objData.retStringf);
						document.form1.submit();
					}
			});
		}
	}
	$(document).ready(function(){
		$("#DepartureTime").timepicker();
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
			$("#AddRuns").val($(this).children().eq(0).text());
			$("#IsModel").val($(this).children().eq(10).text());
		});
		
		$("#addnoruns").click(function(){
			addrun();
		});
		$("#addnoruns1").click(function(){
			addrun();
		});
		$("#maketicketmodel").click(function(){
			makemodel();
		});
		$("#maketicketmodel1").click(function(){
			makemodel();
		});
		$("#deladdnoruns").click(function(){
			deladd();
		});
		$("#delladdnoruns").click(function(){
			deladd();
		});
		$("#moddock").click(function(){
			moddock();
		});
		$("#moddock1").click(function(){
			moddock();
		});
		$("#modprice1").click(function(){
			modprice();
		});
		$("#modprice").click(function(){
			modprice();
		});
		$("#modservicefee").click(function(){
			modservicefee();
		});
		$("#modservicefee1").click(function(){
			modservicefee();
		});
		$("#delticketmodel").click(function(){
			delticketmodel();
		});
		$("#delticketmodel1").click(function(){
			delticketmodel();
		});
		$("#searticketmodel").click(function(){
			searticketmodel();
		});
		$("#searticketmodel1").click(function(){
			searticketmodel();
		});
	});
	function getbusmodels(){
		$("#Model").empty();
		if(document.getElementById("BusUnit").value!=''){
			append();
		}
	}
	function append(){
		jQuery.get(
			'../basedata/tms_v1_bsaedata_dataProcess.php',
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
	function getbusmodel(){
		var str=document.getElementById("Model").value.split(',');
		document.getElementById("ModelName").value=str[0];
		document.getElementById("ModelID").value=str[1];
	}
	function moddock() {
		if(document.getElementById("AddRuns").value=='' ){
			alert('请选择加班班次！');
			return false;
		}
		var noofrun=document.getElementById("AddRuns").value;
		url='tms_v1_schedule_moddock.php?clnumber='+noofrun+'&time'+Math.random();                  
		window.open(url,'','width=900,height=520,top=0,left=0,toolbar=no,menubar=no,scrollbars=1, resizable=yes,location=no,status=yes');
	}
	function modprice(){
		if(document.getElementById("AddRuns").value=='' ){
			alert('请选择加班班次！');
			return false;
		}
		var noofrun=document.getElementById("AddRuns").value;
		url='tms_v1_schedule_modprice.php?clnumber='+noofrun+'&time'+Math.random();
		window.open(url,'','width=900,height=520,top=100,left=100,toolbar=no,menubar=no,scrollbars=1, resizable=yes,location=no,status=yes');
	}
	function modservicefee(){
		if(document.getElementById("AddRuns").value=='' ){
			alert('请选择加班班次！');
			return false;
		}
		var noofrun=document.getElementById("AddRuns").value;
		url='tms_v1_schedule_modservicefee.php?clnumber='+noofrun+'&time'+Math.random();
		window.open(url,'','width=900,height=520,top=100,left=100,toolbar=no,menubar=no,scrollbars=yes, resizable=yes,location=no,status=no');
	}
	function searticketmodel(){
		if(document.getElementById("AddRuns").value=='' ){
			alert('请选择加班班次！');
			return false;
		}
		var noofrun=document.getElementById("AddRuns").value;
		url='tms_v1_schedule_searaddrunmodel.php?op=sear&clnumber='+noofrun+'&time'+Math.random();
		window.open(url,'','width=900,height=520,top=100,left=100,toolbar=no,menubar=no,scrollbars=yes, resizable=yes,location=no,status=no');
	}
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
		<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
		<span class="graytext" style="margin-left:8px;">临时加班</span></td>
	</tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="#" id="addnoruns1">加班</a></li>   
        <li><a href="#" id="delladdnoruns">删除加班</a></li> 
        <li><a href="#" id="moddock1">修改停靠点</a></li>
        <li><a href="#" id="modprice1">修改票价</a></li>
    <!--  
        <li><a href="#" id="modservicefee1">修改站务费</a></li>
    -->    
        <li><a href="#" id="maketicketmodel1">做票版</a></li> 
         <li><a href="#" id="searticketmodel1">查询票版信息</a></li> 
        <li><a href="#" id="delticketmodel1">删除票版</a></li>
        <li><a href="#" onclick="location.assign('tms_v1_schedule_noofrun.php')">返回</a></li>      
    </ul>   
</div>   
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：</span></td>
		<td>
			<input type="hidden" name="NoOfRunsID" id="NoOfRunsID" value="<?php echo $NoOfRunsID;?>"/>
			<input type="text" name="NoOfRunsI" id="NoOfRunsI" disabled="disabled" value="<?php echo $NoOfRunsID;?>"/>
		</td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路：</span></td>
		<td>
			<input type="hidden" name="LineID" id="LineID" value="<?php echo $LineID;?>"/>
			<input type="hidden" name="LineName" id="LineName" value="<?php echo $LineName;?>"/>
			<input type="text" name="LineNam" id="LineNam"  disabled="disabled" value="<?php echo $LineName;?>"/>
		</td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位：</span></td>
		<td>
			<select name="BusUnit" id="BusUnit" onchange="getbusmodels()">
				<option value="<?php echo $BusUnit;?>"><?php echo $BusUnit;?></option>
				<?php
					if($BusUnit!=''){ 
				?>
				<option></option>
				<?php 
					}
					$selectbusunit="SELECT DISTINCT bi_BusUnit FROM tms_bd_BusInfo";
    				$querybusunit=$class_mysql_default->my_query($selectbusunit);
    				while($rowbusunit=mysql_fetch_array($querybusunit)){
						if($BusUnit!=$rowbusunit['bi_BusUnit']){
				?>
					<option value="<?php echo $rowbusunit['bi_BusUnit'];?>"><?php echo $rowbusunit['bi_BusUnit'];?></option>
				<?php
						} 
					}
				?>
			</select><span style="color:red">*</span>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开始日期：</span></td>
		<td>
			<input name="BeginDate" id="BeginDate" class="Wdate" value="<?php ($BeginDate == "")? print date('Y-m-d') : print $BeginDate;?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" />
			<span style="color:red">*</span>
		</td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 截止日期：</span></td>
		<td>
			<input name="EndDate" id="EndDate" class="Wdate" value="<?php echo $EndDate;?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" />
			<span style="color:red">*</span>
		</td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型：</span></td>
		<td>
			<select name="Model" id="Model" onchange="getbusmodel()">
				<option value="<?php echo $BusModel.','.$BusModelID;?>"><?php echo $BusModel;?></option>
				<?php
					if($BusModel!=''){ 
				?>
						<option></option>
				<?php 
					}
					$select1="SELECT DISTINCT nrap_ModelID,nrap_ModelName FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ISUnitAdjust='1' AND nrap_Unit='{$BusUnit}' AND 
						nrap_NoRunsAdjust='{$NoOfRunsID}' AND nrap_ModelID IN (SELECT DISTINCT bi_BusTypeID FROM tms_bd_BusInfo WHERE bi_BusUnit='{$BusUnit}')";
					$query1=$class_mysql_default->my_query("$select1");
					while($row1=mysql_fetch_array($query1)){
						if($BusModelID!=$row1['nrap_ModelID']){
				?>
						<option value="<?php echo $row1['nrap_ModelName'].','.$row1['nrap_ModelID'];?>"><?php echo $row1['nrap_ModelName'];?></option>
				<?php
						} 
					}
					$select2="SELECT DISTINCT nrap_ModelID,nrap_ModelName FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ISNoRunsAdjust='1' AND nrap_NoRunsAdjust='{$NoOfRunsID}'
						AND nrap_ModelID IN (SELECT DISTINCT bi_BusTypeID FROM tms_bd_BusInfo WHERE bi_BusUnit='{$BusUnit}') AND 
						nrap_ModelID NOT IN (SELECT DISTINCT nrap_ModelID FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ISUnitAdjust='1' AND nrap_Unit='{$BusUnit}' AND 
						nrap_NoRunsAdjust='{$NoOfRunsID}')";
					$query2=$class_mysql_default->my_query("$select2");
					while($row2=mysql_fetch_array($query2)){
						if($BusModelID!=$row2['nrap_ModelID']){
				?>
							<option value="<?php echo $row2['nrap_ModelName'].','.$row2['nrap_ModelID'];?>"><?php echo $row2['nrap_ModelName'];?></option>
				<?php
						}
					} 
				?>
			</select>
			<input type="hidden" name="ModelID" id="ModelID" value="<?php echo $BusModelID;?>"/>
			<input type="hidden" name="ModelName" id="ModelName" value="<?php echo $BusModel;?>"/>
			<span style="color:red">*</span>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车时间：</span></td>
		<td>
			<input type="text" name="DepartureTime" id="DepartureTime" value="<?php echo $DepartureTime;?>"/>
			<span style="color:red">*</span>
		</td>
		
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 加班劳务费：</span></td>
		<td colspan="3">
			<input type="text" name="Laborfee" id="Laborfee"  value="<?php echo $Laborfee;?>" onkeyup="isnumber(this.value,this.id)"/>%
			<span style="color:red">*</span>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td colspan="8" align="center" bgcolor="#FFFFFF">
			<input type="button" name="addnoruns" id="addnoruns" value="加班" />
			<input type="button" name="deladdnoruns" id="deladdnoruns" value="删除加班" />
			<input type="button" name="moddock" id="moddock" value="修改停靠点" />
			<input type="button" name="modprice" id="modprice" value="修改票价" />
		<!--  
			<input type="button" name="modservicefee" id="modservicefee" value="修改站务费" />
		--> 
			<input type="button" name="maketicketmodel" id="maketicketmodel" value="做票版" />
			<input type="button" name="searticketmodel" id="searticketmodel" value="查询票版信息" />
			<input type="button" name="delticketmodel" id="delticketmodel" value="删除票版" />
			<input type="button" name="back" id="back" value="返回" onclick="location.assign('tms_v1_schedule_noofrun.php')"/>
		</td>
	</tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader"> 
 	<tr>
	 	<th nowrap="nowrap" align="center" bgcolor="#006699">班次编码</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">线路名称</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">开始日期</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">始发站</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">终点站</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">车型</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">座位数</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">允许半票数</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">加班劳务费(%)</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">是否已做票版</th>
	</tr>
</thead> 
<tbody class="scrollContent"> 
	<?php 
		if(isset($_POST['NoOfRunsID']) || isset($_GET['op'])){
			$Curdate=date('Y-m-d');
			$NoOfRunsID1=$NoOfRunsID.'加';
			$selectadd="SELECT nri_NoOfRunsID, nri_DepartureTime, nri_LoopDate,nri_DepartureTime,nri_BeginSite,nri_EndSite,nrl_ModelName,
				nrl_Seating, nrl_AllowHalfSeats,nds_otherFee3 FROM tms_bd_NoRunsInfo LEFT OUTER JOIN tms_bd_NoRunsLoop ON nri_NoOfRunsID=nrl_NoOfRunsID 
				AND nrl_LoopID='1' LEFT OUTER JOIN tms_bd_NoRunsDockSite ON nri_NoOfRunsID=nds_NoOfRunsID AND nds_ID=1 
				WHERE nri_NoOfRunsID LIKE '{$NoOfRunsID1}%' ORDER BY STR_TO_DATE(nri_LoopDate,'%Y-%m-%d') DESC";
			$queryadd=$class_mysql_default ->my_query($selectadd);
			while($rowadd=mysql_fetch_array($queryadd)){
				$selectmode1="SELECT tml_NoOfRunsID FROM tms_bd_TicketMode WHERE tml_NoOfRunsID='{$rowadd['nri_NoOfRunsID']}' AND tml_NoOfRunsdate='{$Curdate}'";
				$querymode1=$class_mysql_default ->my_query($selectmode1);
	?>

	<tr align="center" bgcolor="#CCCCCC">
		<td nowrap="nowrap"><?php echo $rowadd['nri_NoOfRunsID'];?></td>
		<td nowrap="nowrap"><?php echo $LineName;?></td>
		<td nowrap="nowrap"><?php echo $rowadd['nri_DepartureTime'];?></td>
		<td nowrap="nowrap"><?php echo $rowadd['nri_LoopDate'];?></td>
		<td nowrap="nowrap"><?php echo $rowadd['nri_BeginSite'];?></td>
		<td nowrap="nowrap"><?php echo $rowadd['nri_EndSite'];?></td>
		<td nowrap="nowrap"><?php echo $rowadd['nrl_ModelName'];?></td>
		<td nowrap="nowrap"><?php echo $rowadd['nrl_Seating'];?></td>
		<td nowrap="nowrap"><?php echo $rowadd['nrl_AllowHalfSeats'];?></td>
		<td nowrap="nowrap"><?php echo ($rowadd['nds_otherFee3']*100).'%';?></td>
		<td nowrap="nowrap"><?php if(mysql_num_rows($querymode1) == 0)echo '否'; else echo '是';?></td>
	</tr>
	<?php
			}
		}
	?>
</tbody>
</table>
</div> 
	<input type="hidden" name="IsModel" id="IsModel"/>
	<input type="hidden" name="AddRuns" id="AddRuns"/>
</form>
</body> 
</html>