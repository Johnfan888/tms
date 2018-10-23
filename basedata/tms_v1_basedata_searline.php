<?
//线路界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");
	
	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	require_once("../ui/inc/auth.php");
	//进入正常变量控制
	$RegionCode2=$_POST['RegionCode2'];
	global $Linestate1;
	$Linestate1 = 'test';
	global $Linestate;
	$Linestate = '正常';
	if(isset($_POST['BeginSite'])) {
		$Linestate=$_POST['Linestate'];
		$Linestate1 = '';
	}	
		if($userStationName != "全部车站"){
		$Station=$userStationName;
		}	
		else{
		$Station=$_POST['Station'];
		}
		//$LineName=$_POST['LineName'];
		$BeginStite=$_POST['BeginSite'];
		$EndSite=$_POST['EndSite'];
		$Region=$_POST['Region1'];
		$sql1 = "SELECT COUNT(li_LineName) AS number FROM tms_bd_LineInfo where IFNULL(li_Station, '') like '{$Station}%' and 
					li_BeginSite like '{$BeginStite}%' and li_EndSite like '{$EndSite}%' and IFNULL(li_Linestate, '') like'{$Linestate}%' 
					and IFNULL(li_InRegion, '') like '%{$Region}%'";		
		$query1 = $class_mysql_default->my_query($sql1);
		$rows = mysql_fetch_array($query1);
//	}
	   if($RegionCode2 == 'excel'){
		  $file_name = "searline.csv";
		  header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		  header("Content-Disposition: attachment; filename=$file_name");
		  header("Cache-Control: no-cache, must-revalidate");
		  $fp = fopen('php://output', 'w'); //打开php文件句柄
		  $out = array('', '', '', '', '', '','','','','', '线路管理信息表', '', '', '', '', '', '', '', '');
		  fputcsv($fp, $out);
		  $head = array('序号','线路编号', '线路名', '种类', '等级', '类别 ','方向 ','里程', '起点站',  '终点站', '线路状态', '所属车站编号', '所属车站', '所属区域', '添加者编号', '添加者', '添加时间', '修改者编号', '修改者', '修改时间',  '途径站','备注');
		  fputcsv($fp, $head);
		
		  $cnt = 0; //计数器
		  $limit = 100000; //每隔100000行，刷新输出buffer
		  $outputRow = "";
		  $queryString = "SELECT li_LineID, li_LineName,li_LineKind,li_LineDegree,li_LineType,li_Direction,li_Kilometer,li_BeginSite,li_BeginSiteID,li_EndSite,
						 li_EndSiteID,li_Linestate,li_StationID,li_Station,li_InRegion,li_AdderID,li_Adder,li_AddTime,li_ModerID,li_Moder,li_ModTime,li_Remark
						 FROM tms_bd_LineInfo where IFNULL(li_Station, '') like '{$Station}%' and 
						 li_BeginSite like '{$BeginStite}%' and li_EndSite like '{$EndSite}%' and IFNULL(li_Linestate, '') like'{$Linestate}%' 
						 and IFNULL(li_InRegion, '') like '%{$Region}%'";
		  $result = $class_mysql_default->my_query("$queryString");
		  $i=0;
		  while ($row = mysql_fetch_array($result)) {
		  	$sql2="SELECT GROUP_CONCAT(DISTINCT si_SiteName ORDER BY si_SectionID) AS SiteName from tms_bd_SectionInfo WHERE si_LineID = '{$row['li_LineID']}' GROUP BY  si_LineID"; 
			$query2=mysql_query($sql2);
			$row2=mysql_fetch_array($query2);
			$i++;
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
				}
			$outputRow = array($i,$row['li_LineID'], $row['li_LineName'], $row['li_LineKind'], $row['li_LineDegree'], $row['li_LineType'], 
        		$row['li_Direction'], $row['li_Kilometer'], $row['li_BeginSite'], $row['li_EndSite'],  
        		$row['li_Linestate'],$row['li_StationID'], $row['li_Station'], $row['li_InRegion'], $row['li_AdderID'], $row['li_Adder'],
        		$row['li_AddTime'], $row['li_ModerID'], $row['li_Moder'], $row['li_ModTime'],$row2['SiteName'], $row['li_Remark']); 
				fputcsv($fp, $outputRow); 
		    }
		    fclose($fp);
			exit(); 
		}			
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head> 
<title>线路查询</title> 
<link href="../css/tms.css" rel="stylesheet" type="text/css" />
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="./tms_v1_rightclick.js"></script>
<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
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
$(document).ready(function(){  //匹配区域
$("#table1").tablesorter();
	$("#Region1").keyup(function(){ //按键被松开时执行此函数
		//alert('h');
		$("#InRegion").empty(); //将ID为Region的元素内容清空
		document.getElementById("InRegion").style.display="";
		var SiteId = $("#Region1").val();
		var SiteIdI = $("#Region1").val(); 
		 //获取区域编码的编号变量
		//alert(SiteId.length);
		if(SiteId == ""){
			document.getElementById('InRegion').style.display='none';
			}
		else{
		jQuery.get(
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'getRegion', 'SiteId': SiteId, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						alert(objData.retString);
					}
					if(objData.retVal == "FAIL1"){
						document.getElementById('InRegion').style.display='none';
						}
					else{
						for (var i = 0; i < objData.length; i++) {
							//alert(objData.length);
							var RegionCode= objData[i].RegionCode;
							var RegionName=objData[i].RegionName;
							var Region = RegionName + ';' + RegionCode;
							$("<option value = " + Region + ">" + RegionName + "</option>").appendTo($("#InRegion"));
						}
					}
				});
		}
		});
});

function addline(){
	window.location.href='tms_v1_basedata_addline.php';
}
function modline(){
	if (!document.getElementById("LineID1").value){
		alert('请选择线路！');
		return false;
	}else{
		window.location.href='tms_v1_basedata_modline.php?op=mod&clnumber='+document.getElementById("LineID1").value;
		}
}
function linesite(){
	if (!document.getElementById("LineID1").value){
		alert('请选择线路！');
		return false;
	}else{
		window.location.href='tms_v1_basedata_linesite.php?op=see&clnumber='+document.getElementById("LineID1").value;
		}
}
function lineservefee(){
	if (!document.getElementById("LineID1").value){
		alert('请选择线路！');
		return false;
	}else{
		window.location.href='tms_v1_basedata_searlineservicefeeadjust.php?op=adjust&clnumber='+document.getElementById("LineID1").value;
		}		
}
function lineadjustprice(){
	if (!document.getElementById("LineID1").value){
		alert('请选择线路！');
		return false;
	}else{
		window.location.href='tms_v1_basedata_searlineadjustprice.php?op=adjust&clnumber='+document.getElementById("LineID1").value;
		}		
}

$(document).ready(function(){
	$("#del").click(function(){
		delline();
	});
});
$(document).ready(function(){
	$("#dell").click(function(){
		delline();
	});
});
function delline(){
	if (!document.getElementById("LineID1").value){
		alert('请选择线路！');
		return false;
	}else{
		if(document.getElementById("Linestate1").value=='注销'){
			var stri='恢复';	
		}else{
			var stri='注销';	
		}
		if(!confirm("确定要"+stri+"该线路吗？")){
			return false;
		}else{
			jQuery.get(
					'tms_v1_basedata_delline.php',
					{'op': 'del', 'LineID': $("#LineID1").val(), 'Linestate': $("#Linestate1").val(), 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if( objData.sucess=='1'){
							alert(stri+'成功！');
							document.form1.submit();
						}else{
							alert(stri+'失败！');
						}
				});
		}
	}
}

$(document).click(function(){
	if(document.getElementById("Region"))	document.getElementById("Region").style.display="none";
	if(document.getElementById("Sit"))	document.getElementById("Sit").style.display="none";
	document.getElementById("BeginSit").style.display="none";
	document.getElementById("EndSit").style.display="none";
});
$(document).ready(function(){
	$("#Station").focus();
	$("#Station").keyup(function(){
		$("#Sit").empty();
		document.getElementById("Sit").style.display="";
		var Site = $("#Station").val();
		jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'Station', 'Site': Site, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				for (var i = 0; i < objData.length; i++) {
					$("<option value = " + objData[i].SiteName + ">" + objData[i].SiteName + "</option>").appendTo($("#Sit"));
				}
				if(Site==''){
					document.getElementById("Sit").style.display="none";
				}
			});	
	});
});
$(document).ready(function(){
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

$(document).ready(function(){
	
	$("#table1 tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
	$("#table1 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
	$("#table1 tr").click(function(){
		$("#table1 tr:not(this)").css("background-color","#CCCCCC");
		$("#table1 tr:not(this)").mouseover(function(){$(this).css("background-color","#F1E6C2");});
		$("#table1 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
		$(this).css("background-color","#FFCC00");
		$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
		$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
		$("#LineID1").val($(this).children().eq(1).text());
		$("#Linestate1").val($(this).children().eq(10).text());
		if(document.getElementById("Linestate1").value=='注销'){
			document.getElementById("del").value='恢复线路';
			document.getElementById("dell").innerText='恢复线路';
		}else{
			document.getElementById("del").value='注销线路';
			document.getElementById("dell").innerText='注销线路';
		}
	});
});
</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">线 路 查 询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="tms_v1_basedata_addline.php">添加线路</a></li>   
        <li><a href="#" onclick="modline()">修改线路</a></li>   
        <li><a href="#" id="dell">注销线路</a></li>
        <li><a href="#" onclick="linesite()">线路停靠点</a></li>
        <li><a href="#" onclick="lineadjustprice()">线路票价调整</a></li>
        <li><a href="#" onclick="lineservefee()">线路站务费调整</a></li>     
    </ul>   
</div>   
<?
//连接数据库，获取班次信息
?>
<form method="post" name="form1" action="">
<table width="100%" align="center"  class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td nowrap="nowrap"  bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />所属车站：</span></td>
     <td nowrap="nowrap"  bgcolor="#FFFFFF">
     	<?php 
     	if($userStationName == "全部车站"){
     	?>
        <input type="text" name="Station" id="Station" value="<?php echo $Station;?>">
        <br>
    	<select id="Sit" name="Sit"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20" onchange="form1.Station.value=this.value; this.style.display='none';">
		</select>
		<?php 
     	}
     	else{
		?>
		<input type="text" name="Station" id="Station" value="<?php echo $userStationName;?>" readonly="readonly">
		<?php 
     	}
		?>	
	 </td>
	 <!--  
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路名：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"> <input type="text" name="LineName" id="LineName" value="<?php echo $LineName;?>"/></td>
    -->
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />起点站：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">
    	<input type="text" name="BeginSite" id="BeginSite" value="<?php echo $BeginStite;?>"/>
    	 <br>
        <select id="BeginSit" name="BeginSit"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="form1.BeginSite.value=this.value; this.style.display='none';"   >
		</select>
    </td>
     <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />线路状态：</span></td>
    <td bgcolor="#FFFFFF">
    		<select name="Linestate">
    			<?php 
    			if($Linestate1 == 'test'){
    				//echo 'h';
    			?>
    			<option></option>
    			<option value='正常' selected="selected">正常</option>
    			<option value='注销'>注销</option>
    			<?php 
    			}
    			if($Linestate1 == ''){
    			?>
    			<option value="<?php echo $Linestate;?>"><?php echo $Linestate;?></option>
    			<?php 
    				switch ($Linestate){
    					case "":
    						echo "<option value='正常'>正常</option>";
    						//echo"<br>";
    						echo "<option value='注销'>注销</option>";
    						//echo"<br>";
    					//	echo "<option value='暂停'>暂停</option>";
    						break; 
    					case "正常":
    						echo "<option></option>";
    					//	echo"<br>";
    						echo "<option value='注销'>注销</option>";
    					//	echo"<br>";
    					//	echo "<option value='暂停'>暂停</option>";
    						break; 
    					case "注销":
    						echo "<option></option>";
    					//	echo"<br>";
    						echo "<option value='正常'>正常</option>";
    					//	echo"<br>";
    				//		echo "<option value='暂停'>暂停</option>";
    						break; 
    			//		case "暂停":
    			//			echo "<option></option>";
    			//			echo"<br>";
    			//			echo "<option value='正常'>正常</option>";
    			//			echo"<br>";
    			//			echo "<option value='注销'>注销</option>";
    			//			break; 
    				}
    			}
    			?>
     		 </select></td>
    </tr>
    <tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />终点站：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"> 
    	<input type="text" name="EndSite" id="EndSite" value="<?php echo $EndSite;?>"/>
    	<br>
    	<select id="EndSit" name="EndSit"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="form1.EndSite.value=this.value; this.style.display='none';"   >
		</select>
    </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />所属区域：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">
   	 <input name="Region1" id="Region1" type="text" value="<?php echo $Region;?>"/>
    		<br>
    		<select id="InRegion" name="InRegion"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="Region1.value=options[selectedIndex].text; this.style.display='none';">
			</select>
		<!--  
    	<input type="text" id="Region1" name="Region1" value="<?php echo $Region;?>"/>
    	<br>
    	<select id="Region" name="Region"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="form1.Region1.value=this.value; this.style.display='none';"   >
		</select>
		-->
    </td>
   <td nowrap="nowrap" bgcolor="#FFFFFF" colspan="2" align="left"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />线路总数：<?php if($rows['number']=='') echo '0'; else echo $rows['number'];?></span></td>
 </tr>
 <tr>
    <td nowrap="nowrap" align="center" colspan="6" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;<input name="button1" type="button" value="线路查询" id="button1">
    	&nbsp;&nbsp;<input name="button2" type="button" value="添加线路" onclick="return addline()">
    	&nbsp;&nbsp;<input name="button3" type="button" value="修改线路" onclick="return modline()">
    	&nbsp;&nbsp;<input name="button4" id="del" type="button" value="注销线路" >
    	&nbsp;&nbsp;<input name="button5" type="button" value="线路停靠点" onclick="return linesite()">
    	&nbsp;&nbsp;<input name="button6" type="button" value="线路票价调整" onclick="return lineadjustprice()">
    	&nbsp;&nbsp;<input name="button7" type="button" value="线路站务费调整" onclick="return lineservefee()">
    	&nbsp;&nbsp;&nbsp;<input name="exceldoc" id="exceldoc" type="button" value="导出Excel">
    </td>
     
  </tr>
</table>
<div id="tableContainer" class="tableContainer"> 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader"> 
  <tr>
   	<th nowrap="nowrap" align="center" bgcolor="#006699">序号</th>
    <th nowrap="nowrap" align="left" bgcolor="#006699">线路编号</th>
    <th nowrap="nowrap" align="left" bgcolor="#006699">线路名</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">种类</th>
    <th nowrap="nowrap"" align="center" bgcolor="#006699">等级</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">类别</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">方向</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">里程</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">起点站</th>
    <!-- 
    <th nowrap="nowrap" align="center" bgcolor="#006699">起点站编号</th>
     -->
    <th nowrap="nowrap" align="center" bgcolor="#006699">终点站</th>
    <!-- 
    <th nowrap="nowrap" align="center" bgcolor="#006699">终点站编号</th>
     -->
    <th nowrap="nowrap" align="center" bgcolor="#006699">线路状态</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">所属车站编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">所属车站</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">所属区域</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">添加者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">添加者</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">添加时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">修改者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">修改者</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">修改时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">途经站</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">备 注</th>
  </tr>
  </thead> 
<tbody class="scrollContent"> 
	<?php
 		if($RegionCode2 == '') {	
  			$i=0;	
			$sql = "SELECT * FROM tms_bd_LineInfo where IFNULL(li_Station, '') like '{$Station}%' and 
					li_BeginSite like '{$BeginStite}%' and li_EndSite like '{$EndSite}%' and IFNULL(li_Linestate, '') like'{$Linestate}%' 
					and IFNULL(li_InRegion, '') like '%{$Region}%'";		
			$query = $class_mysql_default->my_query($sql);
			while ($row = mysql_fetch_array($query)) {
				$i++;
			$sql2="SELECT GROUP_CONCAT(DISTINCT si_SiteName ORDER BY si_SectionID) AS SiteName from tms_bd_SectionInfo WHERE si_LineID = '{$row['li_LineID']}' GROUP BY  si_LineID"; 
			$query2=mysql_query($sql2);
			$row2=mysql_fetch_array($query2);
	?>
	<tr bgcolor="#CCCCCC">
        <td nowrap="nowrap" align="center"><?=$i?></td>
        <td nowrap="nowrap" align="left"><?php echo $row['li_LineID'];?></td>
        <td nowrap="nowrap" align="left"><?php echo $row['li_LineName'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['li_LineKind'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['li_LineDegree'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['li_LineType'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['li_Direction'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['li_Kilometer'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['li_BeginSite'];?></td>
        <!--
        <td nowrap="nowrap" align="center"><?php echo $row['li_BeginSiteID'];?></td>
        -->
        <td nowrap="nowrap" align="center"><?php echo $row['li_EndSite'];?></td>
        <!-- 
        <td nowrap="nowrap" align="center"><?php echo $row['li_EndSiteID'];?></td>
         -->
        <td nowrap="nowrap" align="center"><?php echo $row['li_Linestate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['li_StationID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['li_Station'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['li_InRegion'];li_Station?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['li_AdderID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['li_Adder'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['li_AddTime'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['li_ModerID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['li_Moder'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['li_ModTime'];?></td>
        <td nowrap="nowrap" align="left"><?php echo $row2['SiteName'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['li_Remark'];?></td>
      </tr>
		<?php 
				}
			}
	
		?> 
		<tr><td><input type="hidden" id="LineID1" value=""/></td>
			<td><input type="hidden" id="Linestate1" value=""/></td>
			<td><input type="hidden" id="RegionCode2" value="" name="RegionCode2"/></td>
		</tr>   
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>
