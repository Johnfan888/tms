<?
//区域查询界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	
//if(isset($_POST['RegionCode'])) {
		$RegionCode2=$_POST['RegionCode2'];
		$regi= $_POST['RegionCode'];
		$HelpCode=$_POST['HelpCode'];
		$sql1 = "SELECT COUNT(rs_RegionCode) AS number FROM `tms_bd_RegionSet` where 
				rs_RegionCode like'$regi%' and rs_HelpCode like '$HelpCode%'";
		$query1 = $class_mysql_default->my_query($sql1);
		$rows = mysqli_fetch_array($query1);
	//}
		if($RegionCode2 == 'excel'){
		  $file_name = "searregion.csv";
		  header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		  header("Content-Disposition: attachment; filename=$file_name");
		  header("Cache-Control: no-cache, must-revalidate");
		  $fp = fopen('php://output', 'w'); //打开php文件句柄
		  $out = array('', '', '', '', '',  '区域管理信息表', '', '', '', '', '', '', '', '');
		  fputcsv($fp, $out);
		  $head = array('序号','区域编码', '区域名称',  '区域全称', '助记码', '添加者编号', '添加者', '添加时间', '修改者编号', '修改者', '修改时间', '备注');
		  fputcsv($fp, $head);
		
		  $cnt = 0; //计数器
		  $limit = 100000; //每隔100000行，刷新输出buffer
		  $outputRow = "";
		  $queryString = "SELECT rs_RegionCode,rs_RegionName,rs_RegionFullName,rs_HelpCode,rs_AdderID,rs_Adder,rs_AddTime,rs_ModerID,
				rs_Moder,rs_ModTime,rs_Remark FROM `tms_bd_RegionSet` WHERE rs_RegionCode like'$regi%' AND rs_HelpCode like '$HelpCode%'";
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
				
			$outputRow = array($i,$row['rs_RegionCode'], $row['rs_RegionName'], $row['rs_RegionFullName'], $row['rs_HelpCode'], $row['rs_AdderID'], 
        		$row['rs_Adder'], $row['rs_AddTime'], $row['rs_ModerID'], $row['rs_Moder'], $row['rs_ModTime'], $row['rs_Remark']); 
				fputcsv($fp, $outputRow); 
		    }
		    fclose($fp);
			exit(); 
		}	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head> 
<title>CSS控制表格表头固定</title> 
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="./tms_v1_screen2.js"></script>
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

function addregion(){
	window.location.href='tms_v1_basedata_addregion.php';
}
function modregion(){
	if (!document.getElementById("RegionCode1").value){
		alert('请选择区域！')
		return false
	}else{
		window.location.href='tms_v1_basedata_modregion.php?op=mod&clnumber='+document.getElementById("RegionCode1").value
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
	if (!document.getElementById("RegionCode1").value){
		alert('请选择区域！')
		return false
	}else{
		if(!confirm("删除该区域数据会对以后的系统操作有影响，确定要删该区域数据吗？")){
			return false;
		}else{
			var RegionCode = $("#RegionCode1").val();
			jQuery.get(
					'tms_v1_basedata_delregion.php',
					{'op': 'del', 'RegionCode': RegionCode, 'time': Math.random()},
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

<link href="../css/tms.css" rel="stylesheet" type="text/css">
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">区 域 查 询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="tms_v1_basedata_addregion.php">添加区域</a></li>   
        <li><a href="#" onclick="modregion()">修改区域</a></li>   
        <li><a href="#" id="dell">删除区域</a></li>     
    </ul>   
</div>   
<form method="post" name="form1" action="">
<table width="100%" align="center" border="1" cellpadding="3" cellspacing="1" style=”TABLE-LAYOUT:fixed”>
 <tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF" width="25%"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />区域编码：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF" width="25%"><input type="text" name="RegionCode" value="<?php echo $regi;?>" /></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF" width="25%"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />助记码：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF" width="25%"><input type="text" name="HelpCode" value="<?php echo $HelpCode;?>" /></td>
    
  </tr>
  <tr >
    <td align="center" nowrap="nowrap" bgcolor="#FFFFFF"  colspan="3">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="区域查询" id="button1">
    	&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="添加区域" onclick="addregion()">
    	&nbsp;&nbsp;&nbsp;<input name="button3" type="button" value="修改区域" onclick="modregion()">
    	&nbsp;&nbsp;&nbsp;<input name="button4" id="del" type="button" value="删除区域">
    	&nbsp;&nbsp;&nbsp;<input name="exceldoc" id="exceldoc" type="button" value="导出Excel">
    </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">区域总数：<?php if($rows['number']=='') echo '0'; else echo $rows['number'];?></td>
  </tr>
</table>

<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader"> 
  <tr>
   	<th nowrap="nowrap" align="center" bgcolor="#006699">序号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699"><font color="#ffffff">区域编码</font></th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">区域名称</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">区域全称</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">助记码</th>
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
		if($RegionCode2 == '') {
			$i=0;
			$sql = "SELECT rs_RegionCode,rs_RegionName,rs_RegionFullName,rs_HelpCode,rs_AdderID,rs_Adder,rs_AddTime,rs_ModerID,
				rs_Moder,rs_ModTime,rs_Remark FROM `tms_bd_RegionSet` WHERE rs_RegionCode like'$regi%' AND rs_HelpCode like '$HelpCode%'";
			$query =$class_mysql_default->my_query($sql);
			while ($row = mysqli_fetch_array($query)) {
				$i++;
	?> 
	<tr  id="tr" bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'RegionCode1')">
		<td align="center" nowrap="nowrap" ><?php echo $i?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['rs_RegionCode'];?></td>
		<td align="center" nowrap="nowrap" > <?php echo $row['rs_RegionName'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['rs_RegionFullName'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['rs_HelpCode'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['rs_AdderID'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['rs_Adder'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['rs_AddTime'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['rs_ModerID'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['rs_Moder'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['rs_ModTime'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['rs_Remark'];?></td>
	</tr> 
	<?php 
			}
		}
	?> 
	<tr>
		<td><input type="hidden" id="RegionCode1" value=""/></td>
		<td><input type="hidden" id="RegionCode2" value="" name="RegionCode2"/></td>
	</tr> 
	     
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>
