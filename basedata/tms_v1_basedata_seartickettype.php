<?
//票据类型查询界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
//	if(isset($_POST['TypeName'])) {
		$RegionCode2=$_POST['RegionCode2'];
		$TypeName= $_POST['TypeName'];
		$sql1 = "SELECT COUNT(tt_TypeName) AS number FROM `tms_bd_TicketType` WHERE 
				tt_TypeName LIKE '$TypeName%'";
		$query1 = $class_mysql_default->my_query($sql1);
		$rows = mysql_fetch_array($query1);
//	}
	 if($RegionCode2 == 'excel'){
		  $file_name = "seartickettype.csv";
		  header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		  header("Content-Disposition: attachment; filename=$file_name");
		  header("Cache-Control: no-cache, must-revalidate");
		  $fp = fopen('php://output', 'w'); //打开php文件句柄
		  $out = array('', '', '', '',   '票据类型管理信息表', '', '', '', '', '', '', '', '');
		  fputcsv($fp, $out);
		  $head = array('序号', '票据类型名',  '添加者编号', '添加者', '添加时间', '修改者编号', '修改者', '修改时间', '备注');
		  fputcsv($fp, $head);
		
		  $cnt = 0; //计数器
		  $limit = 100000; //每隔100000行，刷新输出buffer
		  $outputRow = "";
		  $queryString = "SELECT tt_ID,tt_TypeName,tt_AdderID,tt_Adder,tt_AddTime,tt_ModerID, tt_Moder,tt_ModTime,tt_Remark FROM `tms_bd_TicketType` WHERE tt_TypeName like'$TypeName%'";
		  $result = $class_mysql_default->my_query("$queryString");
		  $i=0;
		  while ($row = mysql_fetch_array($result)) {
		  	$i++;
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
				}
				
			$outputRow = array($i, $row['tt_TypeName'], $row['tt_AdderID'], $row['tt_Adder'], $row['tt_AddTime'], 
        		$row['tt_ModerID'], $row['tt_Moder'], $row['tt_ModTime'], $row['tt_Remark']); 
				fputcsv($fp, $outputRow); 
		    }
		    fclose($fp);
			exit(); 
		}	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head> 
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="./tms_v1_rightclick.js"></script>
<script type="text/javascript" src="./tms_v1_screen1.js"></script>
<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<link href="../css/tms.css" rel="stylesheet" type="text/css">
<script language="javascript">
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
function addregion(){
	window.location.href='tms_v1_basedata_addtickettype.php';
}
function modregion(){
	if (!document.getElementById("ID1").value){
		alert('请选择票据类型！')
		return false
	}else{
		window.location.href='tms_v1_basedata_modtickettype.php?op=mod&clnumber='+document.getElementById("ID1").value
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
		alert('请选择票据类型！')
		return false
	}else{
		if(!confirm("确定要删除该票据类型吗？")){
			return false;
		}else{
			var ID = $("#ID1").val();
			jQuery.get(
					'tms_v1_basedata_deltickettype.php',
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

</script>
</head>
<body>
<div id="menu" style="display:none">   
	<ul>   
		<li><a href="tms_v1_basedata_addtickettype.php">添加票据类型</a></li>   
        <li><a href="#" onclick="modregion()">修改票据类型</a></li>   
        <li><a href="#" id="dell">删除票据类型</a></li>     
    </ul>   
</div> 
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">票 据  类 型 查 询</span></td>
  </tr>
</table>
<form method="post" name="form1" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />票据类型：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="TypeName" value="<?php echo $TypeName;?>" /></td>
    <td align="left" nowrap="nowrap" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="查询" id="button1">
    	&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="添加" onclick="addregion()">
    	&nbsp;&nbsp;&nbsp;<input name="button3" type="button" value="修改" onclick="modregion()">
    	&nbsp;&nbsp;&nbsp;<input name="button4" id="del" type="button" value="删除" >
    	&nbsp;&nbsp;&nbsp;<input name="exceldoc" id="exceldoc" type="button" value="导出Excel">
    </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">票据类型总数：<?php if($rows['number']=='') echo '0'; else echo $rows['number'];?></td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
  <tr>
    <th nowrap="nowrap" align="center" bgcolor="#006699" style="display:none">序号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">序号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">票据类型名</th>
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
	//	if(isset($_POST['TypeName'])) {
			$i=0;
			$sql = "SELECT * FROM `tms_bd_TicketType` WHERE tt_TypeName like'$TypeName%'";
			$query =$class_mysql_default->my_query($sql);
			while ($row = mysql_fetch_array($query)) {
				$i++;
	?> 
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'ID1')">
		<td align="center" style="display:none"><?php echo $row['tt_ID'];?></td>
		<td align="center"><?=$i?></td>
		<td align="center"><?php echo $row['tt_TypeName'];?></td>
		<td align="center"><?php echo $row['tt_AdderID'];?></td>
		<td align="center"><?php echo $row['tt_Adder'];?></td>
		<td align="center"><?php echo $row['tt_AddTime'];?></td>
		<td align="center"><?php echo $row['tt_ModerID'];?></td>
		<td align="center"><?php echo $row['tt_Moder'];?></td>
		<td align="center"><?php echo $row['tt_ModTime'];?></td>
		<td align="center"><?php echo $row['tt_Remark'];?></td>
	</tr> 
	<?php 
		//echo $row['tt_ID'];	
			}
	//	}
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


