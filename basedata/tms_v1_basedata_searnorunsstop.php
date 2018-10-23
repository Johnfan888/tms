<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber = $_GET['clnumber'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head> 
<title></title>

<script type="text/javascript" src="./tms_v1_screen1.js"></script>
<script type="text/javascript" src="./tms_v1_rightclick.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<link href="../css/tms.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function retur(){
	window.location.href='tms_v1_basedata_searnoruns.php';	
}
function delnorunsstop(){
	if (!document.getElementById("ID1").value){
		alert('请选择序号！')
		return false
	}else{
		if(!confirm("确定要删除该班次吗？")){
			return false;
		}else{
			window.location.href='tms_v1_basedata_delnorunsstop.php?op=del&NoOfRunsID='+document.getElementById("NoOfRunsID1").value+'&noid='+document.getElementById("ID1").value
		}
	}
}
function modnorunsstop(){
	if (!document.getElementById("ID1").value){
		alert('请选择序号！')
		return false
	}else{
		window.location.href='tms_v1_basedata_modnorunsstop.php?op=mod&NoOfRunsID='+document.getElementById("NoOfRunsID1").value+'&noid='+document.getElementById("ID1").value
	}
}
</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">班 次 长 停  查  询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="tms_v1_basedata_addnorunsstop.php?NoOfRunsID=<?php echo $clnumber;?>">添加</a></li>   
        <li><a href="#" onclick="modnorunsstop()">修改</a></li>   
        <li><a href="#" id="dell" onclick="delnorunsstop()">删除</a></li>
        <li><a href="#" onclick="retur()">返回</a></li>       
    </ul>   
</div> 
<?
//连接数据库，获取班次信息
?>
<form method="get" name="aaa" action="tms_v1_basedata_addnorunsstop.php?">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
	<td nowrap="nowrap" width="10%" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次编号：</span></td>
	<td width="10%" bgcolor="#FFFFFF">
		<input type="hidden" name="NoOfRunsID" value="<?php echo $clnumber;?>"/>
		<input type="text" name="NoOfRunsI" disabled="disabled" value="<?php echo $clnumber;?>"/>
	</td>
    <td bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;<input name="submit" type="submit" value="添加">
    	&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="修改" onclick="modnorunsstop()">
    	&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="删除" onclick="delnorunsstop()">
    	&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="retur()">
    </td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer"> 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader"> 
  <tr>
    <th nowrap="nowrap" align="center" bgcolor="#006699" style="display:none">编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">长停开始日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">长停结束日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">长停原因</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
  </tr>
  	<?php 
		$sql = "select* FROM tms_bd_ScheduleLong WHERE sl_NoOfRunsID='{$clnumber}'";
		$query =$class_mysql_default->my_query($sql);
		while($result=mysql_fetch_array($query)){
	?>
	 </thead> 
<tbody class="scrollContent">
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'ID1')">
		<td nowrap="nowrap" align="center" style="display:none"><?php echo $result['sl_ID'];?></td>
    	<td nowrap="nowrap" align="center" ><?php echo $result['sl_BeginDate'];?></td> 
    	<td nowrap="nowrap" align="center" ><?php echo $result['sl_EndDate'];?></td>
    	<td nowrap="nowrap" align="center" ><?php echo $result['sl_StopCause'];?></td>
    	<td nowrap="nowrap" align="center" ><?php echo $result['sl_Remark'];?></td>
	</tr>
  	<?php 
		}
  	?> 
  	<tr><td><input type="hidden" id="ID1" value=""/> <input type="hidden" id="NoOfRunsID1" value="<?php echo $clnumber;?>"/></td></tr>
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>
