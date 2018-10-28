<?
//班次查询界面

	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");

	if($userStationName == "全部车站"){ //用户只能查看起点站属于本站的班次信息
		$str="";
	}	
	else{
		$str="AND (nri_LineID) not in (SELECT li_LineID FROM tms_bd_LineInfo WHERE li_Station != '$userStationName')";
	}
	if($userStationName == "全部车站"){ //用户只能查看起点站属于本站的班次信息
		$str1="";
		}	
		else{
		$str1="AND  li_Station = '$userStationName'";
		}
//	if(isset($_POST['LineName'])){
		$RegionCode2=$_POST['RegionCode2'];
		$state=$_POST['state'];
		$strsta='';
  		if($state == "" || $state == "普通班次"){
  			$strsta=" AND nri_NoOfRunsID not like '%加%'";
  		}
  		if($state == "加班班次"){
  			$strsta=" AND nri_NoOfRunsID  like '%加%'";	
  		}
  		if($state == "全部班次"){
  			$strsta == '';	
  		}
  		//echo $strsta;
		$LineName=$_POST['LineName'];
		$BeginSite=$_POST['BeginSite'];
		$EndSite=$_POST['EndSite'];
		$NoOfRunsID=$_POST['NoOfRunsID'];
		$sql1="SELECT COUNT(nri_NoOfRunsID) AS number FROM tms_bd_NoRunsInfo where  nri_NoOfRunsID like '{$NoOfRunsID}%'and nri_LineName like '{$LineName}%'
			   and IFNULL(nri_BeginSite, '') like '{$BeginSite}%' and IFNULL(nri_EndSite, '') like'{$EndSite}%'".$strsta.$str;
		$query1 =$class_mysql_default->my_query($sql1);
		$rows = mysqli_fetch_array($query1);
//	}
	  if($RegionCode2 == 'excel'){
		  $file_name = "searnoruns.csv";
		  header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		  header("Content-Disposition: attachment; filename=$file_name");
		  header("Cache-Control: no-cache, must-revalidate");
		  $fp = fopen('php://output', 'w'); //打开php文件句柄
		  $out = array('', '', '', '', '', '','','','','','','','','','', '班次管理信息表', '', '', '', '', '', '', '', '');
		  fputcsv($fp, $out);
		  $head = array('序号','班次编号', '线路编号', '线路名',  '起点站',  '终点站 ','发车时间', '操作码', '班次类型', '班次状态', '运行小时数', '检票口', '运行区域', '循环日期',
						'开始天数', '开班天数', '停班天数', '是否生成票版', '是否从线路继承路段表', '是否通票', '是否允许售票', '是否加班','班次停靠点', '添加者编号', '添加者', '添加时间', '修改者编号', '修改者', '修改时间', '备注');
		  fputcsv($fp, $head);
		
		  $cnt = 0; //计数器
		  $limit = 100000; //每隔100000行，刷新输出buffer
		  $outputRow = "";
		  $queryString = "SELECT nri_NoOfRunsID,nri_LineID,nri_LineName,nri_BeginSiteID,nri_BeginSite,nri_EndSiteID,nri_EndSite,nri_DepartureTime,nri_OperateCode,
						  nri_Type,sl_ID,nri_RunHours,nri_CheckTicketWindow,nri_RunRegion,nri_LoopDate,nri_StartDay,nri_RunDay,nri_StopDay,nri_IsStopOrCreat,
						  nri_IsSucceedLine,nri_Allticket,nri_AllowSell,nri_AddNoRuns,nri_AdderID,nri_Adder,nri_AddTime,nri_ModerID,nri_Moder,nri_ModTime,nri_Remark
 						  FROM tms_bd_NoRunsInfo LEFT OUTER JOIN tms_bd_ScheduleLong ON sl_NoOfRunsID=nri_NoOfRunsID AND sl_BeginDate<='{$curdate}' AND sl_EndDate>='{$curdate}' 
						  WHERE  nri_NoOfRunsID LIKE '{$NoOfRunsID}%'AND nri_LineName LIKE '{$LineName}%'AND IFNULL(nri_BeginSite, '') LIKE '{$BeginSite}%' AND IFNULL(nri_EndSite, '') LIKE '{$EndSite}%'".$strsta.$str;
		  $result = $class_mysql_default->my_query("$queryString");
		  $i=0;
		  while ($row = mysqli_fetch_array($result)) {
		  	$i++;
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
				}
			$sql2="SELECT GROUP_CONCAT(DISTINCT nds_SiteName ORDER BY nds_ID) AS SiteName from tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID = '{$row['nri_NoOfRunsID']}' GROUP BY  nds_NoOfRunsID"; 
			$query2=$class_mysql_default->my_query($sql2);
			$row2=mysqli_fetch_array($query2);
			if($row['sl_ID']){
				$row['sl_ID'] = "长停";
			}
			else{
				$row['sl_ID'] = "正常";
			}
			if ($row['nri_IsStopOrCreat']==0){
				$row['nri_IsStopOrCreat'] = "否";
			}
		  	else{
				$row['nri_IsStopOrCreat'] = "是";
			}
			if ($row['nri_IsSucceedLine']==0){
				$row['nri_IsSucceedLine']= "否";
			}
		    else{
				$row['nri_IsSucceedLine'] = "是";
			}
			if($row['nri_Allticket']==0){
			   $row['nri_Allticket']= "否";
			}
		  	else{
				$row['nri_Allticket'] = "是";
			}
			if($row['nri_AllowSell']==0){
			   $row['nri_AllowSell']= "否";
			}
		  	else{
				$row['nri_AllowSell'] = "是";
			}
			if($row['nri_AddNoRuns']==0){
				$row['nri_AddNoRuns']= "否";
			}
		  	else{
				$row['nri_AddNoRuns'] = "是";
			}
			$outputRow = array($i,$row['nri_NoOfRunsID'], $row['nri_LineID'], $row['nri_LineName'],  $row['nri_BeginSite'], 
        					    $row['nri_EndSite'], $row['nri_DepartureTime'],$row['nri_OperateCode'], $row['nri_Type'], $row['sl_ID'], 
        					   $row['nri_RunHours'],$row['nri_CheckTicketWindow'], $row['nri_RunRegion'], $row['nri_LoopDate'], $row['nri_StartDay'], $row['nri_RunDay'],
        					   $row['nri_StopDay'], $row['nri_IsStopOrCreat'], $row['nri_IsSucceedLine'], $row['nri_Allticket'], $row['nri_AllowSell'], $row['nri_AddNoRuns'],
        					   $row2['SiteName'],$row['nri_AdderID'], $row['nri_Adder'], $row['nri_AddTime'], $row['nri_ModerID'], $row['nri_Moder'], $row['nri_ModTime'], $row['nri_Remark']); 
				fputcsv($fp, $outputRow); 
		    }
		    fclose($fp);
			exit(); 
		}		
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head> 
<title></title>
<script type="text/javascript" src="./tms_v1_screen2.js"></script>
<script type="text/javascript" src="./tms_v1_rightclick.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript">
$(document).ready(function(){
	$('#button1').click(function(){
		document.getElementById('RegionCode2').value='';
		document.form1.submit();
	});	
	$('#exceldoc').click(function(){
		document.getElementById('RegionCode2').value='excel';
		document.form1.submit();
		});
});
$(document).ready(function(){ //线路名按照终点站匹配
	$("#LineName").keyup(function(){
		$("#LineNameselect").empty();
		document.getElementById("LineNameselect").style.display=""; 
		var LineName = $("#LineName").val();
		var station = $("#stationselect").val();
		jQuery.get(
			'../schedule/tms_v1_schedule_dataops.php',
			{'op': 'GETLINEEND', 'LineName': LineName,'station':station ,'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				for (var i = 0; i < objData.length; i++) {
					$("<option value = " + objData[i].LineName + ',' + objData[i].LineID + ',' + objData[i].BeginSiteID +',' + objData[i].BeginSite +',' + objData[i].EndSiteID +',' + objData[i].EndSite + ">" + objData[i].LineName + "</option>").appendTo($("#LineNameselect"));
				}
				if(LineName==''){
					document.getElementById("LineNameselect").style.display="none";
				}
		});
	});
});
function showsome(str){ //获取始发站，终点站，自动生成编码
	var st=str.split(',')
	document.getElementById("LineName").value=st[0]//线路名
}
function addnoruns(){
	window.location.href='tms_v1_basedata_addnoruns.php';
}
function modnoruns(){
	if (!document.getElementById("NoOfRunsID1").value){
		alert('请选择班次！');
		return false;
		}else{
			window.location.href='tms_v1_basedata_modnoruns.php?op=mod&clnumber='+document.getElementById("NoOfRunsID1").value;
		}
}
function norunsdock(){
	if (!document.getElementById("NoOfRunsID1").value){
		alert('请选择班次！');
		return false;
		}else{
			window.location.href='tms_v1_basedata_searrunsdock.php?op=see&clnumber='+document.getElementById("NoOfRunsID1").value;
		}
}
function norunsloop(){
	if (!document.getElementById("NoOfRunsID1").value){
		alert('请选择班次！');
		return false;
		}else{
			window.location.href='tms_v1_basedata_norunsloop.php?op=see&clnumber='+document.getElementById("NoOfRunsID1").value;
		}
}
function  busloop(){
	if (!document.getElementById("NoOfRunsID1").value){
		alert('请选择班次！');
		return false;
		}else{
			window.location.href='tms_v1_basedata_searbusloop.php?op=see&clnumber='+document.getElementById("NoOfRunsID1").value;
		}
}
function norunsstop(){
	if (!document.getElementById("NoOfRunsID1").value){
		alert('请选择班次！');
		return false;
		}else{
			window.location.href='tms_v1_basedata_searnorunsstop.php?op=see&clnumber='+document.getElementById("NoOfRunsID1").value;
		}
}
function norunsreserve(){
	if (!document.getElementById("NoOfRunsID1").value){
		alert('请选择班次！');
		return false;
		}else{
			window.location.href='tms_v1_basedata_searnorunsreserve.php?op=see&clnumber='+document.getElementById("NoOfRunsID1").value;
		}
}
function norunsadjustprice(){
	if (!document.getElementById("NoOfRunsID1").value){
		alert('请选择班次！');
		return false;
		}else{
			window.location.href='tms_v1_basedata_searnorunsadjustprice.php?op=see&clnumber='+document.getElementById("NoOfRunsID1").value;
		}
}
function norunsservicefeeadjust(){
	if (!document.getElementById("NoOfRunsID1").value){
		alert('请选择班次！');
		return false;
		}else{
			window.location.href='tms_v1_basedata_searservicefeeadjust.php?op=see&clnumber='+document.getElementById("NoOfRunsID1").value;
		}
}

$(document).ready(function(){
	$("#del").click(function(){
		delnoruns();
	});
});
$(document).ready(function(){
	$("#dell").click(function(){
		delnoruns();
	});
});
function delnoruns(){
	if (!document.getElementById("NoOfRunsID1").value){
		alert('请选择班次！');
		return false;
	}else{
		if(!confirm("删除除该班次数据会对以后的系统操作有影响，确定要删除该班次数据吗？")){
			return false;
		}else{
			var NoOfRunsID = $("#NoOfRunsID1").val();
			jQuery.get(
					'tms_v1_basedata_delnoruns.php',
					{'op': 'del', 'NoOfRunsID': NoOfRunsID, 'time': Math.random()},
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

$(document).ready(function(){
	$("#table1").tablesorter();
	$("#BeginSite").keyup(function(){
		$("#BeginSit").empty();
		document.getElementById("BeginSit").style.display="";
		var Site = $("#BeginSite").val();
		jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'getsite', 'Site': Site, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				for (var i = 0; i < objData.length; i++) {
					$("<option value =" + objData[i].SiteName + ">" + objData[i].SiteName + "</option>").appendTo($("#BeginSit"));
				}
				if(Site==''){
					document.getElementById("BeginSit").style.display="none";
				}
			});	
	});
});
$(document).ready(function(){
	$("#EndSite").keyup(function(){
		$("#EndSit").empty();
		document.getElementById("EndSit").style.display="";
		var Site = $("#EndSite").val();
		jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'getsite', 'Site': Site, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				for (var i = 0; i < objData.length; i++) {
					$("<option value = " + objData[i].SiteName + ">" + objData[i].SiteName + "</option>").appendTo($("#EndSit"));
				}
				if(Site==''){
					document.getElementById("EndSit").style.display="none";
				}
			});	
	});
});

</script>
<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<link href="../css/tms.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">班 次 查 询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="#" onclick="addnoruns()">添加班次</a></li>   
        <li><a href="#" onclick="modnoruns()">修改班次</a></li>   
        <li><a href="#" id="dell">删除班次</a></li>
        <li><a href="#" onclick="norunsdock()">班次停靠点</a></li>
        <li><a href="#" onclick="norunsloop()">班次循环</a></li>
        <li><a href="#" onclick="busloop()">班次循环车辆</a></li>
        <li><a href="#" onclick="norunsstop()">班次长停</a></li>
   <!-- <li><a href="#" onclick="norunsreserve()">班次预留</a></li> -->
        <li><a href="#" onclick="norunsadjustprice()">班次票价</a></li>
        <li><a href="#" onclick="norunsservicefeeadjust()">班次站务费</a></li>      
    </ul>   
</div> 
<?
//连接数据库，获取班次信息
?>
<form method="post" name="form1" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路：</span></td>
    <td bgcolor="#FFFFFF">
    	<input type="text" name="LineName" id="LineName" value="<?php echo $LineName;?>"><br>
	    	<select id="LineNameselect" name="LineNameselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" onchange="showsome(this.value); this.style.display='none';"></select>
    	<!-- 
    	<input type="text" name="LineName" value="<?php echo $LineName;?>"/>
    	 -->
    </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：</span></td>
    <td bgcolor="#FFFFFF"><input type="text" name="NoOfRunsID" value="<?php echo $NoOfRunsID;?>" /></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 起点站：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">
    	<input type="text" id="BeginSite" name="BeginSite" value="<?php echo $BeginSite;?>"/>
    	 <br>
        <select id="BeginSit" name="BeginSit"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="form1.BeginSite.value=this.value; this.style.display='none';"   >
		</select>
    </td>
    
 </tr>
 <tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 终点站：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">
    	<input type="text" id="EndSite" name="EndSite" value="<?php echo $EndSite;?>"/>
    	<br>
    	<select id="EndSit" name="EndSit"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="form1.EndSite.value=this.value; this.style.display='none';"   >
		</select>
    </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次状态：</span></td>
 	<td bgcolor="#FFFFFF">
 		<select name="state" id="state">
 			<?php 
 			if($state == "普通班次"){
 			?>
 			<option value="普通班次" selected="selected">普通班次</option>
 			<option value="加班班次" >加班班次</option>
 			<option value="全部班次">全部班次</option>
 			<?php 
 			}
 			if($state == "加班班次"){
 			?>
 			<option value="普通班次">普通班次</option>
 			<option value="加班班次"  selected="selected">加班班次</option>
 			<option value="全部班次">全部班次</option>
 			<?php 
 			}
 			if($state == "全部班次"){
 			?>
 			<option value="普通班次">普通班次</option>
 			<option value="加班班次" >加班班次</option>
 			<option value="全部班次"  selected="selected">全部班次</option>
 			<?php 
 			}
 			if($state == ""){
 			?>
 			<option value="普通班次" selected="selected">普通班次</option>
 			<option value="加班班次" >加班班次</option>
 			<option value="全部班次">全部班次</option>
 			<?php 
 			}
 			?>
 		</select>
 	</td>
 	 <td nowrap="nowrap" bgcolor="#FFFFFF" colspan="2" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次总数：<?php if($rows['number']=='') echo '0'; else echo $rows['number'];?></span></td>
  </tr>
  <tr>
  	<td align="left" colspan="9" nowrap="nowrap" bgcolor="#FFFFFF">
  		&nbsp;&nbsp;<input name="button1" type="button" value="查询" id="button1"/>
  		&nbsp;&nbsp;<input name="button2" type="button" value="添加" onclick="return addnoruns()">
  		&nbsp;&nbsp;<input name="button3" type="button" value="修改" onclick="return modnoruns()"/> 
  		&nbsp;&nbsp;<input name="button4" type="button" id="del" value="删除"/>
  		&nbsp;&nbsp;<input name="exceldoc" id="exceldoc" type="button" value="导出Excel">
  		&nbsp;&nbsp;<input name="button5" type="button" value="班次停靠点" onclick="return norunsdock()"/>
  		&nbsp;&nbsp;<input name="button10" type="button" value="班次票价" onclick="return norunsadjustprice()"/>
  		&nbsp;&nbsp;<input name="button11" type="button" value="班次站务费" onclick="return norunsservicefeeadjust()"/>
  		&nbsp;&nbsp;<input name="button7" type="button" value="班次循环车辆" onclick="return busloop()"/>
  		&nbsp;&nbsp;<input name="button6" type="button" value="班次循环" onclick="return norunsloop()"/>
  		&nbsp;&nbsp;<input name="button8" type="button" value="班次长停" onclick="return norunsstop()"/>
  	<!-- &nbsp;<input name="button9" type="button" value="班次预留" onclick="return norunsreserve()"/> -->

  		
   </tr>
</table>
<div id="tableContainer" class="tableContainer"> 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader"> 
  <tr>
 	<th nowrap="nowrap" align="center" bgcolor="#006699">序号</th>
    <th nowrap="nowrap" align="left" bgcolor="#006699">班次编号</th>
<!--    <th nowrap="nowrap" align="center" bgcolor="#006699">线路编号</th>-->
    <th nowrap="nowrap" align="left" bgcolor="#006699">线路名</th>
    <!-- 
    <th nowrap="nowrap" align="center" bgcolor="#006699">起点站编号</th>
    -->
    <th nowrap="nowrap" align="center" bgcolor="#006699">起点站</th>
    <!-- 
   	<th nowrap="nowrap" align="center" bgcolor="#006699">终点站编号</th>
   	-->
    <th nowrap="nowrap" align="center" bgcolor="#006699">终点站</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">操作码</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">班次类型</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">班次状态</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">运行时间</th>
 <!-- <td nowrap="nowrap" align="center" bgcolor="#006699">营运类别</th>
    <td nowrap="nowrap" align="center" bgcolor="#006699">营运方式</th> 
    <td nowrap="nowrap" align="center" bgcolor="#006699">服务费比率</th>
    <td nowrap="nowrap" align="center" bgcolor="#006699">临时加班费</th>
    <td nowrap="nowrap" align="center" bgcolor="#006699">结算模式</th>
-->
    <th nowrap="nowrap" align="center" bgcolor="#006699">检票口</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">运行区域</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">循环日期</th> 
	<th nowrap="nowrap" align="center" bgcolor="#006699">开始天数</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">开班天数</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">停班天数</th>       
    <th nowrap="nowrap" align="center" bgcolor="#006699">是否生成票版</th> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">是否从线路继承路段表</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">是否通票</th> 
<!-- 
    <td nowrap="nowrap" align="center" bgcolor="#006699">是否本站专营</td> 
    <td nowrap="nowrap" align="center" bgcolor="#006699">周循环</td> 
    <td nowrap="nowrap" align="center" bgcolor="#006699">月循环</td>  
	<td nowrap="nowrap" align="center" bgcolor="#006699">是否夜间加成</td> 
    <td nowrap="nowrap" align="center" bgcolor="#006699">是否直达加成</td> 
    <td nowrap="nowrap" align="center" bgcolor="#006699">是否专属</td> 
    <td nowrap="nowrap" align="center" bgcolor="#006699">是否回程班次</td> 
-->
    <th nowrap="nowrap"align="center" bgcolor="#006699">是否允许售票</th> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">是否加班</th> 
    <th nowrap="nowrap" align="left" bgcolor="#006699">班次停靠点</th> 
	<th nowrap="nowrap" align="center" bgcolor="#006699">添加者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">添加者</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">添加时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">修改者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">修改者</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">修改时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
  </tr>
  </thead> 
<tbody class="scrollContent"> 
  <?php
 	if($RegionCode2 == ''){
  		$i=0;
  		$curdate=date('Y-m-d');
		$sql="SELECT * FROM tms_bd_NoRunsInfo LEFT OUTER JOIN tms_bd_ScheduleLong ON sl_NoOfRunsID=nri_NoOfRunsID AND sl_BeginDate<='{$curdate}' AND sl_EndDate>='{$curdate}' 
			  WHERE  nri_NoOfRunsID LIKE '{$NoOfRunsID}%'AND nri_LineName LIKE '{$LineName}%'AND IFNULL(nri_BeginSite, '') LIKE '{$BeginSite}%' AND IFNULL(nri_EndSite, '') LIKE '{$EndSite}%'".$strsta.$str."GROUP BY nri_NoOfRunsID";
  		$query =$class_mysql_default->my_query($sql);
		//if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
		while ($row = mysqli_fetch_array($query)){
			$i++;
		$sql2="SELECT GROUP_CONCAT(DISTINCT nds_SiteName ORDER BY nds_ID) AS SiteName from tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID = '{$row['nri_NoOfRunsID']}' GROUP BY  nds_NoOfRunsID"; 
		$query2=$class_mysql_default->my_query($sql2);
		$row2=mysqli_fetch_array($query2);
	?>
	<tr id="tr" bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'NoOfRunsID1')">
        <td nowrap="nowrap" align="center"><?=$i?></td>
        <td nowrap="nowrap" align="left"><?php echo $row['nri_NoOfRunsID'];?></td>
        <!--<td nowrap="nowrap" align="center"><?php echo $row['nri_LineID'];?></td>
        --><td nowrap="nowrap" align="left"><?php echo $row['nri_LineName'];?></td>
        <!--  
        <td nowrap="nowrap" align="center"><?php echo $row['nri_BeginSiteID'];?></td>
        -->
        <td nowrap="nowrap" align="center"><?php echo $row['nri_BeginSite'];?></td>
        <!--  
        <td nowrap="nowrap" align="center"><?php echo $row['nri_EndSiteID'];?></td>
        -->
        <td nowrap="nowrap" align="center"><?php echo $row['nri_EndSite'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_DepartureTime'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_OperateCode'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_Type'];?></td>
        <td nowrap="nowrap" align="center"><?php if($row['sl_ID']) echo '长停'; else echo '正常';?></td>
        <td nowrap="nowrap" align="center">
        	<?php 
        		$Hours='';
        		$Minutes='';
        		$RunHours=explode(":", $row['nri_RunHours']);
        		if($RunHours[0]) $Hours=$RunHours[0].'小时';
        		if($RunHours[1]) $Minutes=$RunHours[1].'分钟';
        		echo $Hours.$Minutes;
        	?>
        </td>
<!--    <td nowrap="nowrap" align="center"><?php echo $row['nri_DealCategory'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_DealStyle'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_SeverFeeRate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_TempAddFee'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_BalanceModel'];?></td>
 --> 
        <td nowrap="nowrap" align="center"><?php echo $row['nri_CheckTicketWindow'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_RunRegion'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_LoopDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_StartDay'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_RunDay'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_StopDay'];?></td>
        <td nowrap="nowrap" align="center"><?php if ($row['nri_IsStopOrCreat']==0)echo '否'; else echo '是';?></td>
        <td nowrap="nowrap" align="center"><?php if ($row['nri_IsSucceedLine']==0)echo '否'; else echo '是';?></td>
        <td nowrap="nowrap" align="center"><?php if($row['nri_Allticket']==0) echo '否'; else echo '是';?></td>
<!-- 
        <td nowrap="nowrap" align="center"><?php echo $row['nri_StationDeal'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_WeekLoop'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_MonthLoop'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_IsNightAddition'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_IsThroughAddition'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_IsExclusive'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_IsReturn'];?></td>
-->
        <td nowrap="nowrap" align="center"><?php if($row['nri_AllowSell']==0) echo '否'; else echo '是';?></td>
        <td nowrap="nowrap" align="center"><?php if($row['nri_AddNoRuns']==0) echo '否'; else echo '是';?></td>
        <td nowrap="nowrap" align="left"><?php echo $row2['SiteName'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_AdderID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_Adder'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_AddTime'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_ModerID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_Moder'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_ModTime'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nri_Remark'];?></td>
      </tr>
		<?php 
				}
			}
	
		?>
	 <tr> 
	 	<td> 
	 	<input type="hidden" id="NoOfRunsID1" value=""> 
	 	<input type="hidden" name="stationselect" id="stationselect" value="<?php echo $str1;?>">
	 	<input type="hidden" id="RegionCode2" value="" name="RegionCode2"/>
	 	</td> 
	 </tr>   
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>


