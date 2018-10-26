<?
//驾驶员查询界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
//	if(isset($_POST['DriverID'])){
		$RegionCode2=$_POST['RegionCode2'];
		$DriverID=$_POST['DriverID'];
		$Name=$_POST['Name'];
		$DriverCard=$_POST['DriverCard'];
		$sql1="SELECT COUNT(di_DriverID) AS number FROM tms_bd_DriverInfo where  di_DriverID like '{$DriverID}%' and IFNULL(di_Name, '') like '{$Name}%' AND di_DriverCard like '$DriverCard%'";
		$query1 =$class_mysql_default->my_query($sql1);
		$rows = mysqli_fetch_array($query1);
//	}
	   if($RegionCode2 == 'excel'){
		  $file_name = "seardriver.csv";
		  header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		  header("Content-Disposition: attachment; filename=$file_name");
		  header("Cache-Control: no-cache, must-revalidate");
		  $fp = fopen('php://output', 'w'); //打开php文件句柄
		  $out = array('', '', '', '', '','','','','','',  '驾驶员管理信息表', '', '', '', '', '', '', '', '');
		  fputcsv($fp, $out);
		  $head = array('驾驶员编号', '姓名', '性别', '电话', '身份证号', '从业资格证号', '车牌号', '驾照号', '允许驾驶车型 ','驾照审验日期', '从业资格证审验期 ','上岗有效期', '驾驶员档案编号','驾驶员家庭住址', '添加者编号', '添加者', '添加时间', '修改者编号', '修改者', '修改时间', '备注');
		  fputcsv($fp, $head);
		  $cnt = 0; //计数器
		  $limit = 100000; //每隔100000行，刷新输出buffer
		  $outputRow = "";
		  $queryString = "SELECT di_DriverID, di_Name,di_Sex,di_Tel,di_IdCard,di_CYZGZNumber,di_BusNumber,di_DriverCard,di_AllowBusType,
			 			  di_DriverCheckDate,di_CYZGZCheckDate,di_WorkEndDate,di_FileID,di_Address,di_AdderID,di_Adder,di_AddTime,di_ModerID,di_Moder,di_ModTime,di_Remark
			 			  FROM tms_bd_DriverInfo where  di_DriverID like '{$DriverID}%' and IFNULL(di_Name, '') like '{$Name}%' AND di_DriverCard like '$DriverCard%'";
		  $result = $class_mysql_default->my_query("$queryString");
		  while ($row = mysqli_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
				}
				
			$outputRow = array($row['di_DriverID'], $row['di_Name'], $row['di_Sex'], $row['di_Tel'], $row['di_IdCard'], 
        					   $row['di_CYZGZNumber'], $row['di_BusNumber'], $row['di_DriverCard'], $row['di_AllowBusType'], $row['di_DriverCheckDate'],
        					   $row['di_CYZGZCheckDate'],$row['di_WorkEndDate'], $row['di_FileID'], $row['di_Address'], $row['di_AdderID'], $row['di_Adder'], 
        					   $row['di_AddTime'], $row['di_ModerID'], $row['di_Moder'], $row['di_ModTime'], $row['di_Remark']); 
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
	window.location.href='tms_v1_basedata_adddriver.php';
}
function mod(){
	if (!document.getElementById("DriverID1").value){
		alert('请选择驾驶员！')
		return false
	}else{
		window.location.href='tms_v1_basedata_moddriver.php?op=mod&clnumber='+document.getElementById("DriverID1").value
	}
}

$(document).ready(function(){
	$("#del").click(function(){
		deldriver()
	});
});
$(document).ready(function(){
	$("#table1").tablesorter();
});
$(document).ready(function(){
	$("#dell").click(function(){
		deldriver()
	});
});
function deldriver(){
	if (!document.getElementById("DriverID1").value){
		alert('请选择驾驶员！')
		return false
	}else{
		if(!confirm("确定要删除该驾驶员信息吗？")){
			return false;
		}else{
			var DriverID = $("#DriverID1").val();
			jQuery.get(
					'tms_v1_basedata_deldriver.php',
					{'op': 'del', 'DriverID': DriverID, 'time': Math.random()},
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
	$("#DriverCard").keyup(function(){
		$("#dcard").empty();
		document.getElementById("dcard").style.display=""; 
		var dcard = $("#DriverCard").val();
		jQuery.get(
			'../charterbus/tms_v1_basedata_getdata.php',
			{'op': 'getdriver1', 'dcard': dcard, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if(objData.retVal == "FAIL"){ 
					alert(objData.retString);
				}
				for (var i = 0; i < objData.length; i++) {
					$("<option value = " + objData[i].DriverCard +">"+ objData[i].DriverCard + ','+objData[i].DriverName+"</option>").appendTo($("#dcard"));
				}
				if(dcard==''){
					document.getElementById("dcard").style.display="none";
				}
		});
	});
});
</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">驾 驶 员 查 询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="#" onclick="add()">添加</a></li>   
        <li><a href="#" onclick="mod()">修改</a></li>   
        <li><a href="#" id="dell">删除</a></li>      
    </ul>   
</div> 
<?
//连接数据库，获取班次信息
?>
<form method="post" name="form1" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员编号：</span></td>
    <td bgcolor="#FFFFFF" width="25%"><input type="text" name="DriverID" value="<?php echo $DriverID;?>"/></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 姓名：</span></td>
    <td bgcolor="#FFFFFF" width="25%"><input type="text" name="Name" value="<?php echo $Name;?>"/></td>  
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾照号：</span></td>
    <td bgcolor="#FFFFFF" width="25%"><input type="text" name="DriverCard" id="DriverCard" value="<?php echo $DriverCard;?>"/>
    	<br>
		<select id="dcard" name="dcard" class="helplay" multiple="multiple" style="display:none;height:90px;" size="30" onchange="form1.DriverCard.value=this.value;this.style.display='none';"></select>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="查询" id="button1"/>
    	&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="添加" onclick="add()">
    	&nbsp;&nbsp;&nbsp;<input name="button3" type="button" value="修改" onclick="mod()">
    	&nbsp;&nbsp;&nbsp;<input name="button4" id="del" type="button" value="删除" onclick="del()">
    	&nbsp;&nbsp;&nbsp;<input name="exceldoc" id="exceldoc" type="button" value="导出Excel">
    </td>
     <td nowrap="nowrap" bgcolor="#FFFFFF">驾驶员总数：<?php if($rows['number']=='') echo '0'; else echo $rows['number'];?></td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer"> 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
  <tr>
    <th nowrap="nowrap" align="center" bgcolor="#006699">驾驶员编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">姓名</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">性别</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">电话</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">身份证号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">从业资格证号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">驾照号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">允许驾驶车型</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">驾照审验日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">从业资格证审验期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">上岗有效期</th>
   	<th nowrap="nowrap" align="center" bgcolor="#006699">所属单位</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">驾驶员档案编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">驾驶员家庭住址</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">扫描件</th>
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
		$sql="SELECT * FROM tms_bd_DriverInfo where  di_DriverID like '{$DriverID}%' and IFNULL(di_Name, '') like '{$Name}%' AND di_DriverCard like '$DriverCard%'";
		$query =$class_mysql_default->my_query($sql);
		//if (!$query) echo "SQL错误：".->my_error();
		while ($row = mysqli_fetch_array($query)){
	?>
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'DriverID1')">
        <td nowrap="nowrap" align="center"><?php echo $row['di_DriverID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['di_Name'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['di_Sex'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['di_Tel'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['di_IdCard'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['di_CYZGZNumber'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['di_DriverCard'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['di_AllowBusType'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['di_DriverCheckDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['di_CYZGZCheckDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['di_WorkEndDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['di_BusNumber'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['di_FileID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['di_Address'];?></td>
		<?php 
			if($row['di_ScanPath'] == NULL) {
		?>
        	<td nowrap="nowrap" align="center"><?php echo "未上传";?></td>
		<?php } else { 
		?>
        	<td nowrap="nowrap" align="center">[<a href="tms_v1_basedata_download.php?scanpath=<?=$row['di_ScanPath']?>&filename=<?=$row['di_fileName']?>">查看]</a></td>
		<?php 
		}
		?>
        <td nowrap="nowrap" align="center"><?php echo $row['di_AdderID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['di_Adder'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['di_AddTime'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['di_ModerID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['di_Moder'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['di_ModTime'];?></td>
         <td nowrap="nowrap" align="center"><?php echo $row['di_Remark'];?></td>
      </tr>
		<?php 
				}
			}
	
		?>
		<tr>
			<td><input type="hidden" id="DriverID1" value=""/></td>
			<td><input type="hidden" id="RegionCode2" value="" name="RegionCode2"/></td>
		</tr>    
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>


