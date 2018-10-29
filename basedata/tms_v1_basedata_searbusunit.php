<?
//车属单位查询界面
	//定义页面必须验证是否登录
//	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
//	if(isset($_POST['UnitName'])) {
		$RegionCode2=$_POST['RegionCode2'];
		$UnitName= $_POST['UnitName'];
		$UnitProperty=$_POST['UnitProperty'];
		$UnitContacts=$_POST['UnitContacts'];
		$sql1 = "SELECT COUNT(bu_UnitName) AS number FROM tms_bd_BusUnit where 
				bu_UnitName like'$UnitName%' and bu_UnitProperty like '$UnitProperty%' and bu_UnitContacts like '$UnitContacts%'";
		$query1 = $class_mysql_default->my_query($sql1);
		$rows = mysqli_fetch_array($query1);
//	}
	  if($RegionCode2 == 'excel'){
		  $file_name = "searbusunit.csv";
		  header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		  header("Content-Disposition: attachment; filename=$file_name");
		  header("Cache-Control: no-cache, must-revalidate");
		  $fp = fopen('php://output', 'w'); //打开php文件句柄
		  $out = array('', '', '',  '车属单位管理信息表', '', '', '');
		  fputcsv($fp, $out);
		  $head = array('序号', '车属单位名称', '单位性质','联系人', '联系电话', '单位地址', '备注');
		  fputcsv($fp, $head);
		
		  $cnt = 0; //计数器
		  $limit = 100000; //每隔100000行，刷新输出buffer
		  $outputRow = "";
		  $queryString ="SELECT bu_ID,bu_UnitName,bu_UnitProperty,bu_UnitContacts,bu_UnitPhone,bu_UnitAdress,bu_Remark FROM tms_bd_BusUnit where 
				bu_UnitName like'$UnitName%' and bu_UnitProperty like '$UnitProperty%' and bu_UnitContacts like '$UnitContacts%'";
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
				
			$outputRow = array($i, $row['bu_UnitName'], $row['bu_UnitProperty'], $row['bu_UnitContacts'], $row['bu_UnitPhone'], 
        		$row['bu_UnitAdress'], $row['bu_Remark']); 
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
<script language="javascript">
<!--
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
function addunit(){
	window.location.href='tms_v1_basedata_addbusunit.php';
}
function modunit(){
	if (!document.getElementById("ID1").value){
		alert('请选择车属单位！')
		return false
	}else{
		window.location.href='tms_v1_basedata_modbusunit.php?op=mod&clnumber='+document.getElementById("ID1").value
		}
}
$(document).ready(function(){
	$("#del").click(function(){
		delregion()
	});
});
$(document).ready(function(){
	$("#table1").tablesorter();
});
$(document).ready(function(){
	$("#dell").click(function(){
		delregion()
	});
});

function delregion(){
	if (!document.getElementById("ID1").value){
		alert('请选择车属单位！')
		return false
	}else{
		if(!confirm("删除除该车属单位数据会对以后的系统操作有影响，确定要删除该车属单位数据吗？")){
			return false;
		}else{
			var ID = $("#ID1").val();
			jQuery.get(
					'tms_v1_basedata_delbusunit.php',
					{'op': 'del', 'ID': ID, 'time': Math.random()},
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
-->
</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext;" style="margin-left:8px;" >车 属 单 位 查 询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="tms_v1_basedata_addbusunit.php">添加车属单位</a></li>   
        <li><a href="#" onclick="modunit()">修改车属单位</a></li>   
        <li><a href="#" id="dell">删除车属单位</a></li>     
    </ul>   
</div>   
<form method="post" name="form1" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td width="13%" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车属单位名称：</span></td>
    <td width="13%" bgcolor="#FFFFFF"><input type="text" name="UnitName" id="UnitName" value="<?php echo $UnitName;?>" /></td>
    <td width="13%" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />单位性质：</span></td>
    <td width="13%" bgcolor="#FFFFFF"><input type="text" name="UnitProperty" value="<?php echo $UnitProperty;?>" /></td>
    <td width="13%" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />联系人：</span></td>
    <td width="13%" bgcolor="#FFFFFF"><input type="text" name="UnitContacts" value="<?php echo $UnitContacts;?>" /></td>
  </tr>
  <tr>
    <td align="left"  colspan="5" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="车属单位查询" id="button1">
    	&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="添加车属单位" onclick="addunit()">
    	&nbsp;&nbsp;&nbsp;<input name="button3" type="button" value="修改车属单位" onclick="modunit()">
    	&nbsp;&nbsp;&nbsp;<input name="button4" id="del" type="button" value="删除车属单位" >
    	&nbsp;&nbsp;&nbsp;<input name="exceldoc" id="exceldoc" type="button" value="导出Excel">
    </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">车属单位总数：<?php if($rows['number']=='') echo '0'; else echo $rows['number'];?></td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
  <tr>
   	<th nowrap="nowrap" align="center" bgcolor="#006699" style="display:none">序号</th> 
   	<th nowrap="nowrap" align="center" bgcolor="#006699" >序号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车属单位名称</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">单位性质</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">联系人</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">联系电话</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">单位地址</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
  </tr>
    </thead> 
<tbody class="scrollContent">
	<?php
	if($RegionCode2 == '') {
			$i=0;
			$sql = "SELECT bu_ID,bu_UnitName,bu_UnitProperty,bu_UnitContacts,bu_UnitPhone,bu_UnitAdress,bu_Remark FROM tms_bd_BusUnit where 
				bu_UnitName like'$UnitName%' and bu_UnitProperty like '$UnitProperty%' and bu_UnitContacts like '$UnitContacts%'";
			$query =$class_mysql_default->my_query($sql);
			while ($row = mysqli_fetch_array($query)) {
			   $i++;
	?> 
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'ID1')">
		<td align="center" style="display:none"><?php echo $row['bu_ID'];?></td>
		<td align="center"><?php echo $i?></td>
		<td align="center"><?php echo $row['bu_UnitName'];?></td>
		<td align="center"><?php echo $row['bu_UnitProperty'];?></td>
		<td align="center"><?php echo $row['bu_UnitContacts'];?></td>
		<td align="center"><?php echo $row['bu_UnitPhone'];?></td>
		<td align="center"><?php echo $row['bu_UnitAdress'];?></td>
		<td align="center"><?php echo $row['bu_Remark'];?></td>
	</tr> 
	<?php 
			}
		}
	?> 
	<tr>
		<td><input type="hidden" id="ID1" value=""/></td>
		<td><input type="hidden" id="RegionCode2" value="" name="RegionCode2"/></td>
	</tr>      
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>

