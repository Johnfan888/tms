<?php
//票价因素情况查询界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber=$_GET['clnumber'];
	$sql="SELECT * FROM tms_bd_BusModel where bm_ModelID='{$clnumber}'";
	$query=$class_mysql_default->my_query($sql);
	$result=mysqli_fetch_array($query);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head> 
<script type="text/javascript" src="tms_v1_screen1.js"></script>
<script type="text/javascript" src="tms_v1_rightclick.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<link href="./tms.css" rel="stylesheet" type="text/css">
<script language="javascript">
<!--
function add(){
	str=document.getElementById("ModelID").value
	window.location.href='tms_v1_basedata_addticketpricefactor.php?clnumbe='+str;
}
function retur(){
	window.location.href='tms_v1_basedata_searbusmodel.php?';
}
function del(){
	if (!document.getElementById("PriceProject1").value){
		alert('请选择票价因素情况！')
		return false
	}else{
		if(!confirm("确定要删除该数据吗？")){
			return false;
		}else{
			window.location.href='tms_v1_basedata_delticketpricefactor.php?op=del&clnumber='+document.getElementById("ModelID1").value+'&pp='+document.getElementById("PriceProject1").value
		}
	}
}
function mod(){
	if (!document.getElementById("PriceProject1").value){
		alert('请选择票价因素情况！')
		return false
	}else{
		window.location.href='tms_v1_basedata_modticketpricefactor.php?op=mod&clnumber='+document.getElementById("ModelID1").value+'&pp='+document.getElementById("PriceProject1").value
	}
}
-->
</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">票 价 因 素 情 况 查 询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="#" onclick="add()">添加票价因素</a></li>   
        <li><a href="#" onclick="mod()">修改票价因素</a></li>   
        <li><a href="#" id="dell" onclick="del()">删除票价因素</a></li>
        <li><a href="#" onclick="retur()">返回</a></li>       
    </ul>   
</div> 

<form method="post" name="aaa" action="tms_v1_basedata_searticketpricefactor.php">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td width="16%" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型编号：</span></td>
    <td width="10%" bgcolor="#FFFFFF"><input type="hidden" id="ModelID" name="ModelID" value="<?php echo $result['bm_ModelID'];?>" />
        <input type="text"  name="ModelI" value="<?php echo $result['bm_ModelID'];?>" disabled="disabled" /></td>
     <td width="16%" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车型名：</span></td>
     <td width="16%" bgcolor="#FFFFFF"><input type="text" name="ModelName" value="<?php echo $result['bm_ModelName'];?>" disabled="disabled"/></td>        
    <td colspan="2" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="添加票价因素" onclick="add()">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="修改票价因素" onclick="mod()">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="删除票价因素" onclick="del()">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="返回" onclick="retur()">
    </td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
  <tr>
    <th nowrap="nowrap" align="center" bgcolor="#006699">票价项目</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">起始日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">终止日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">元/人公里</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
  </tr>
    </thead> 
<tbody class="scrollContent">
	<?php
		
		$sqls = "SELECT * FROM tms_bd_TicketPriceFactor where tpf_ModelID='{$clnumber}'";
		$querys =$class_mysql_default->my_query($sqls);
		//if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
		while ($row = mysqli_fetch_array($querys)) {
	?> 
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'PriceProject1')">
		<td align="center"><?php echo $row['tpf_PriceProject'];?></td>
		<td align="center"><?php echo $row['tpf_BeginDate'];?></td>
		<td align="center"><?php echo $row['tpf_EndDate'];?></td>
		<td align="center"><?php echo $row['tpf_MoneyRenKil'];?></td>
		<td align="center"><?php echo $row['tpf_Remark'];?></td>
	</tr> 
	<?php 
		}
	?>  
	<tr><td><input type="hidden" id="PriceProject1" value=""/> <input type="hidden" id="ModelID1" value="<?php echo $result['bm_ModelID'];?>"/></td></tr>       
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>
