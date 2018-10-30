<?php
//车辆界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
//	if(isset($_POST['BusID'])){
		if($userStationName != "全部车站"){
		$Station=$userStationName;
		}	
		else{
		$Station=$_POST['Station'];
		}
		$RegionCode2=$_POST['RegionCode2'];
		$BusID=$_POST['BusID'];
		$BusNumber=$_POST['BusNumber'];
		$BusTypeID=$_POST['BusTypeID'];
		$ManagementLine=$_POST['ManagementLine'];
		$sql1="SELECT COUNT(bi_BusID) AS number FROM tms_bd_BusInfo where IFNULL(bi_InStation, '') like '{$Station}%' and bi_BusID like '{$BusID}%' and IFNULL(bi_BusNumber, '') like '%{$BusNumber}%'
			and IFNULL(bi_BusTypeID, '') like '{$BusTypeID}%' and IFNULL(bi_ManagementLine, '') like'{$ManagementLine}%'";
		$query1 =$class_mysql_default->my_query($sql1);
		$rows = mysqli_fetch_array($query1);
//	}
	  if($RegionCode2 == 'excel'){
		  $file_name = "searbus.csv";
		  header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		  header("Content-Disposition: attachment; filename=$file_name");
		  header("Cache-Control: no-cache, must-revalidate");
		  $fp = fopen('php://output', 'w'); //打开php文件句柄
		  $out = array('', '', '', '', '',  '车辆管理信息表', '', '', '', '', '', '', '', '');
		  fputcsv($fp, $out);
		  $head = array('车辆编号', '登记日期', '车牌号', '车型编号', '车型名', '座位数', '加座数', '允许半票数', '吨位', '车属单位', '厂牌','车辆卡号', '发动机型号','发动机号', '车辆识别号', '车辆改型情况', '所属车站',
						'所属车站编号', '车主姓名', '车主地址', '车主电话', '车主身份证', '正驾驶编号', '正驾驶姓名', '驾驶员1编号', '驾驶员1姓名', '驾驶员2编号', '驾驶员2姓名', '保单号', '承保公司',
						'建档日期 ','交强险开始日期', '结束日期', '商业险开始日期 ','结束日期', '承运人险开始日期', '结束日期', '经营线路', '线路牌号', '线路牌照附卡号', '线路牌照附卡有效期', 
						'道路运输证号', '道路运输证有效期', '车辆行驶证号', '车辆行驶证有效期', '营运证号', '春检完成日期', '审验完成日期', '二级维护完成日期 ','等级评定完成日期', 
						'行驶证检验完成日期', '月维护完成日期', '液化气证完成日期', '添加者编号', '添加者', '添加时间', '修改者编号', '修改者', '修改时间', '备注');
		  fputcsv($fp, $head);
		
		  $cnt = 0; //计数器
		  $limit = 100000; //每隔100000行，刷新输出buffer
		  $outputRow = "";
		  $queryString = "SELECT bi_BusID,bi_RegDate,bi_BusNumber, bi_BusTypeID,bi_BusType,bi_SeatS,bi_AddSeatS,bi_AllowHalfSeats,bi_Tonnage,bi_BusUnit,bi_Sign,
			  			 bi_EngineType,bi_EngineNumber,bi_BusIdentify,bi_BusChangeType,bi_InStation,bi_InStationID,bi_OwnerName,bi_OwnerAdd,bi_OwnerTel,
			  			 bi_OwnerIdCard,bi_DriverID,bi_Driver,bi_Driver1ID,bi_Driver1,bi_Driver2ID,bi_Driver2,bi_InsuranceNo,bi_InsuranceCompany,bi_InsuranceDate,
			 			 bi_TransportationBeginDate,bi_TransportationEndDate,bi_TradeBeginDate,bi_TradeEndDate,bi_RenBeginDate,bi_RenEndDate,bi_ManagementLine,
              			 bi_LineLicense,bi_LineLicenseAttached,bi_AttachedEndDate,bi_RoadTransport,bi_RoadTransportEndDate,
               			 bi_VehicleDriving,bi_VehicleDrivingEndDate,bi_Business,bi_SpringCheckEndDate,bi_ExaminationEndDate,bi_TwoEndDate,bi_RankEndDate,bi_TravelEndDate,bi_MonthEndDate,bi_CNGEndDate,bi_AdderID,
			   			 bi_Adder,bi_AddTime,bi_ModerID,bi_Moder,bi_ModTime,bi_Remark FROM tms_bd_BusInfo where IFNULL(bi_InStation, '') like '{$Station}%' and bi_BusID like '{$BusID}%' and IFNULL(bi_BusNumber, '') like '%{$BusNumber}%'
			   			 and IFNULL(bi_BusTypeID, '') like '{$BusTypeID}%' and IFNULL(bi_ManagementLine, '') like'{$ManagementLine}%'";
		  $result = $class_mysql_default->my_query("$queryString");
		  while ($row = mysqli_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
				}
			$row['bi_BusTypeID']=$row['bi_BusTypeID']."\t";
			$queryString2 = "select bc_CardID from tms_bd_BusCard where bc_BusID='{$row['bi_BusID']}'";
			$result2 = $class_mysql_default->my_query("$queryString2");
			$row2 = mysqli_fetch_array($result2);
			$outputRow = array($row['bi_BusID'], $row['bi_RegDate'], $row['bi_BusNumber'], $row['bi_BusTypeID'], $row['bi_BusType'], 
        					   $row['bi_SeatS'], $row['bi_AddSeatS'], $row['bi_AllowHalfSeats'], $row['bi_Tonnage'], $row['bi_BusUnit'], $row['bi_Sign'],$row2['bc_CardID'],
        					   $row['bi_EngineType'], $row['bi_EngineNumber'], $row['bi_BusIdentify'], $row['bi_BusChangeType'], $row['bi_InStation'], 
        					   $row['bi_InStationID'], $row['bi_OwnerName'], $row['bi_OwnerAdd'], $row['bi_OwnerTel'], $row['bi_OwnerIdCard'], $row['bi_DriverID'],
        					   $row['bi_Driver'], $row['bi_Driver1ID'], $row['bi_Driver1'], $row['bi_Driver2ID'], $row['bi_Driver2'], 
        					   $row['bi_InsuranceNo'], $row['bi_InsuranceCompany'], $row['bi_InsuranceDate'], $row['bi_TransportationBeginDate'], $row['bi_TransportationEndDate'], $row['bi_TradeBeginDate'],
        					   $row['bi_TradeEndDate'], $row['bi_RenBeginDate'], $row['bi_RenEndDate'], $row['bi_ManagementLine'], $row['bi_LineLicense'], 
        					   $row['bi_LineLicenseAttached'], $row['bi_AttachedEndDate'], $row['bi_RoadTransport'], $row['bi_RoadTransportEndDate'], $row['bi_VehicleDriving'], $row['bi_VehicleDrivingEndDate'],
        					   $row['bi_Business'], $row['bi_SpringCheckEndDate'],$row['bi_ExaminationEndDate'],$row['bi_TwoEndDate'], $row['bi_RankEndDate'], $row['bi_TravelEndDate'], $row['bi_MonthEndDate'], 
        					   $row['bi_CNGEndDate'], $row['bi_AdderID'], $row['bi_Adder'], $row['bi_AddTime'], $row['bi_ModerID'], $row['bi_Moder'],
        					   $row['bi_ModTime'], $row['bi_Remark']); 
				fputcsv($fp, $outputRow); 
		    }
		    fclose($fp);
			exit(); 
		}	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head> 
<script type="text/javascript" src="tms_v1_screen1.js"></script>
<script type="text/javascript" src="tms_v1_rightclick.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<link href="../css/tms.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
$(document).ready(function(){
	$('#button1').click(function(){
		document.getElementById('RegionCode2').value='';
		document.form1.submit();
	});	
	$('#exceldoc').click(function(){
		document.getElementById('RegionCode2').value='excel';
		document.form1.submit();
		document.getElementById('RegionCode2').value='';
		});
});
function add(){
	window.location.href='tms_v1_basedata_addbus.php';
}
function mod(){
	//alert(document.getElementById("BusID1").value)
	if (!document.getElementById("BusID1").value){
		alert('请选择车辆！');
		return false;
	}else{
		window.location.href='tms_v1_basedata_modbus.php?op=mod&clnumber='+document.getElementById("BusID1").value;
		}
}
function addbuscard(){
	if (!document.getElementById("BusID1").value){
		alert('请选择车辆！');
		return false;
	}else{
		window.location.href='tms_v1_basedata_addbuscard.php?op=mod&clnumber='+document.getElementById("BusID1").value;
		}
}
$(document).ready(function(){ //经营线路
	$("#ManagementLine").keyup(function(){
		//alert('h');
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
$(document).ready(function(){
	$("#del").click(function(){
		delbus();
	});
});
$(document).ready(function(){
	$("#dell").click(function(){
		delbus();
	});
});
$(document).ready(function(){
	$("#table1").tablesorter();
});
function delbus(){
	if (!document.getElementById("BusID1").value){
		alert('请选择车辆 ！');
		return false;
	}else{
		if(!confirm("删除该车辆数据会对以后的结算有影响，确定要删除该车辆数据吗？")){
			return false;
		}else{
			var BusID = $("#BusID1").val();
			jQuery.get(
					'tms_v1_basedata_delbus.php',
					{'op': 'del', 'BusID': BusID, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if( objData.sucess=='1'){
							alert('删除成功！');
							document.form1.submit();
						}else{
							alert('删除失败！');
						}
				});
		}
	}
}
</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">车 辆 查 询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="#" onclick="add()">添加车辆</a></li>   
        <li><a href="#" onclick="mod()">修改车辆</a></li>   
        <li><a href="#" id="dell">删除车辆</a></li>
        <!--<li><a href="#" onclick="addbuscard()">车辆卡信息</a></li>       
    --></ul>   
</div> 
<?php
//连接数据库，获取班次信息
?>
<form method="post" name="form1" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆编号：</span></td>
    <td bgcolor="#FFFFFF"><input type="text" name="BusID" value="<?php echo $BusID;?>"/></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
    <td bgcolor="#FFFFFF" colspan="5"><input type="text" name="BusNumber" value="<?php echo $BusNumber;?>"/></td>
 </tr>
 <tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型编号：</span></td>
    <td bgcolor="#FFFFFF"><input type="text" name="BusTypeID" value="<?php echo $BusTypeID;?>"/></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 经营线路：</span></td>
    <td bgcolor="#FFFFFF" nowrap="nowrap" colspan="5">
    	<input type="text" name="ManagementLine" id="ManagementLine" value="<?php echo $ManagementLine;?>"/>
    	<br/>
	    <select id="LineNameselect" name="LineNameselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" onchange="ManagementLine.value=options[selectedIndex].text; this.style.display='none';"></select>
    </td>
  </tr>
  <tr> 
    <td colspan="3" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="查询车辆" id='button1'/>
    	&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="添加车辆" onclick="add()">
    	&nbsp;&nbsp;&nbsp;<input name="button3" type="button" value="修改车辆" onclick="mod()">
    	&nbsp;&nbsp;&nbsp;<input name="button4" id="del" type="button" value="删除车辆" ><!--
    	&nbsp;&nbsp;&nbsp;<input name="button5" type="button" value="车辆卡信息" onclick="addbuscard()">
    	-->
    	&nbsp;&nbsp;&nbsp;<input name="exceldoc" id="exceldoc" type="button" value="导出Excel">
    </td>
     <td nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车辆总数：<?php if($rows['number']=='') echo '0'; else echo $rows['number'];?></span></td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
  <tr>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">登记日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车型编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车型名</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">座位数</th>
   	<th nowrap="nowrap" align="center" bgcolor="#006699">加座数</th>
   	<th nowrap="nowrap" align="center" bgcolor="#006699">允许半票数</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">吨位</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车属单位</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">厂牌</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车辆卡号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">发动机型号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">发动机号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车辆识别号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车辆改型情况</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">所属车站</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">所属车站编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车主姓名</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">车主地址</th> 
	<th nowrap="nowrap" align="center" bgcolor="#006699">车主电话</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车主身份证</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">正驾驶驾照号</th>       
    <th nowrap="nowrap" align="center" bgcolor="#006699">正驾驶姓名</th> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">驾驶员1驾照号</th> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">驾驶员1姓名</th> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">驾驶员2驾照号</th> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">驾驶员2姓名</th> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">保单号</th> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">承保公司</th> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">建档日期</th> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">交强险开始日期</th> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">结束日期</th> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">商业险开始日期</th> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">结束日期</th> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">承运人险开始日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">结束日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">经营线路</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">线路牌号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">线路牌照附卡号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">线路牌照附卡有效期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">道路运输证号</th> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">道路运输证有效期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车辆行驶证号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车辆行驶证有效期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">营运证号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">春检完成日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">审验完成日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">二级维护完成日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">等级评定完成日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">行驶证检验完成日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">月维护完成日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">液化气证完成日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">添加者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">添加者</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">添加时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">修改者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">修改者</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">修改时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">扫描件</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
  </tr>
    </thead> 
<tbody class="scrollContent">
  <?php
  	if($RegionCode2 == ''){
		$sql="SELECT * FROM tms_bd_BusInfo where  IFNULL(bi_InStation, '') like '{$Station}%' and bi_BusID like '{$BusID}%' and IFNULL(bi_BusNumber, '') like '%{$BusNumber}%'
			and IFNULL(bi_BusTypeID, '') like '{$BusTypeID}%' and IFNULL(bi_ManagementLine, '') like'{$ManagementLine}%'";
		$query =$class_mysql_default->my_query($sql);
		//if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
		while ($row = mysqli_fetch_array($query)){
	?>
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'BusID1')">
        <td nowrap="nowrap" align="center"><?php echo $row['bi_BusID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_RegDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_BusNumber'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_BusTypeID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_BusType'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_SeatS'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_AddSeatS'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_AllowHalfSeats'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_Tonnage'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_BusUnit'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_Sign'];?></td>
        <?php 
        	$sql2="select bc_CardID from tms_bd_BusCard where bc_BusID='{$row['bi_BusID']}'";
        	$query2 =$class_mysql_default->my_query($sql2);
        	$row2 = mysqli_fetch_array($query2);	
        ?>
         <td nowrap="nowrap" align="center"><?php echo $row2['bc_CardID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_EngineType'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_EngineNumber'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_BusIdentify'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_BusChangeType'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_InStation'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_InStationID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_OwnerName'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_OwnerAdd'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_OwnerTel'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_OwnerIdCard'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_DriverID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_Driver'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_Driver1ID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_Driver1'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_Driver2ID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_Driver2'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_InsuranceNo'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_InsuranceCompany'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_InsuranceDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_TransportationBeginDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_TransportationEndDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_TradeBeginDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_TradeEndDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_RenBeginDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_RenEndDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_ManagementLine'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_LineLicense'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_LineLicenseAttached'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_AttachedEndDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_RoadTransport'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_RoadTransportEndDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_VehicleDriving'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_VehicleDrivingEndDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_Business'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_SpringCheckEndDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_ExaminationEndDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_TwoEndDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_RankEndDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_TravelEndDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_MonthEndDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_CNGEndDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_AdderID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_Adder'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_AddTime'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_ModerID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_Moder'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_ModTime'];?></td>
		<?php 
			if($row['bi_ScanPath'] == NULL) {
		?>
        	<td nowrap="nowrap" align="center"><?php echo "未上传";?></td>
		<?php } else { 
		?>
        	<td nowrap="nowrap" align="center">[<a href="tms_v1_basedata_download.php?scanpath=<?php echo $row['bi_ScanPath']?>&filename=<?php echo $row['bi_fileName']?>">查看]</a></td>
		<?php 
		}
		?>
        <td nowrap="nowrap" align="center"><?php echo $row['bi_Remark'];?></td>
      </tr>
	<?php 
		}
	}
	?>
	<tr>
		<td><input type="hidden" id="BusID1" value=""/></td>
		<td><input type="hidden" id="RegionCode2" value="" name="RegionCode2"/></td>
	</tr>    
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>


