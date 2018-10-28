<?
//退票类型查询界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$ReturnType= $_POST['ReturnType'];
	if(isset($_POST['exceldoc'])){
		  $file_name = "searreturntickettype.csv";
		  header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		  header("Content-Disposition: attachment; filename=$file_name");
		  header("Cache-Control: no-cache, must-revalidate");
		  $fp = fopen('php://output', 'w'); //打开php文件句柄
		  $out = array('', '', '退票类型管理信息表', '', );
		  fputcsv($fp, $out);
		  $head = array('退票类型', '退票手续费',  '退票时间开始', '退票时间结束');
		  fputcsv($fp, $head);
		
		  $cnt = 0; //计数器
		  $limit = 100000; //每隔100000行，刷新输出buffer
		  $outputRow = "";
		  $queryString = "SELECT rte_ReturnType,rte_ReturnRate,rte_ReturnTimeBegin,rte_ReturnTimeEnd FROM `tms_sell_ReturnType` where rte_ReturnType like'$ReturnType%'";
		  $result = $class_mysql_default->my_query("$queryString");
		  while ($row = mysqli_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
				}
				
			$outputRow = array($row['rte_ReturnType'], $row['rte_ReturnRate'], $row['rte_ReturnTimeBegin'], $row['rte_ReturnTimeEnd']); 
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
function delreturntickettype(){
	if (!document.getElementById("ReturnType1").value){
		alert('请选择退票类型！')
		return false
	}else{
		if(!confirm("确定要删除该类型吗？")){
			return false;
		}else{
			window.location.href='tms_v1_basedata_delreturntickettype.php?op=del&clnumber='+document.getElementById("ReturnType1").value
		}
	}
}
function addreturntickettype(){
	window.location.href='tms_v1_basedata_addreturntickettype.php';
}
function modreturntickettype(){
	if (!document.getElementById("ReturnType1").value){
		alert('请选择退票类型！')
		return false
	}else{
		window.location.href='tms_v1_basedata_modreturntickettype.php?op=mod&clnumber='+document.getElementById("ReturnType1").value
		}
}
-->
</script>
</head>
<body>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="tms_v1_basedata_addreturntickettype.php">添加退票类型</a></li>   
        <li><a href="#" onclick="modreturntickettype()">修改退票类型</a></li>   
        <li><a href="#" id="dell" onclick="delreturntickettype()">删除退票类型</a></li>
             
    </ul>   
</div>  
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">退 票 类 型 查 询</span></td>
  </tr>
</table>

<form method="post" name="aaa" action="tms_v1_basedata_searreturntickettype.php">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td width="13%" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />退票类型：</span></td>
    <td width="13%" bgcolor="#FFFFFF"><input type="text" name="ReturnType" /></td>
    <td align="left"  colspan="4" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;<input name="submit1" type="submit" value="退票类型查询">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="添加退票类型" onclick="addreturntickettype()">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="修改退票类型" onclick="modreturntickettype()">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="删除退票类型" onclick="delreturntickettype()">
    	&nbsp;&nbsp;&nbsp;<input name="exceldoc" id="exceldoc" type="submit" value="导出Excel">
    </td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
  <tr>
    <th nowrap="nowrap" align="center" bgcolor="#006699">退票类型</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">退票手续费率</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">退票时间开始</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">退票时间结束</th>
  </tr>
    </thead> 
<tbody class="scrollContent">
	<?php
		//if(isset($_POST['submit1'])) {
		//if($_POST['Submit']!=""){
			$ReturnType= $_POST['ReturnType'];
			$sql = "SELECT rte_ReturnType,rte_ReturnRate,rte_ReturnTimeBegin,rte_ReturnTimeEnd FROM `tms_sell_ReturnType` where rte_ReturnType like'$ReturnType%'";
			$query =$class_mysql_default->my_query($sql);
			if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
			while ($row = mysqli_fetch_array($query)) {
	?> 
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'ReturnType1')">
		<td align="center"><?php echo $row['rte_ReturnType'];?></td>
		<td align="center"><?php echo $row['rte_ReturnRate'];?></td>
		<td align="center"><?php echo $row['rte_ReturnTimeBegin'];?></td>
		<td align="center"><?php echo $row['rte_ReturnTimeEnd'];?></td>
	</tr> 
	<?php 
			}
	//	}
	?> 
	<tr><td><input type="hidden" id="ReturnType1" value=""/></td></tr>      
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>
