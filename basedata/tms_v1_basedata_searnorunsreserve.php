<?php
//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber = $_GET['clnumber'];
?>
<script type="text/javascript" src="tms_v1_screen1.js"></script>
<script type="text/javascript" src="tms_v1_rightclick.js"></script>
<script type="text/javascript">
function retur(){
	window.location.href='tms_v1_basedata_searnoruns.php';	
}
function delnorunsreserve(){
	if (!document.getElementById("ModelID1").value){
		alert('请选择停靠点！')
		return false
	}else{
		if(!confirm("确定要删除该数据吗？")){
			return false;
		}else{
			window.location.href='tms_v1_basedata_delnorunsreserve.php?op=del&NoOfRunsID='+document.getElementById("NoOfRunsID1").value+'&noid='+document.getElementById("ModelID1").value
		}
	}
}
function modnorunsreserve(){
	if (!document.getElementById("ModelID1").value){
		alert('请选择车型！')
		return false
	}else{
		window.location.href='tms_v1_basedata_modnorunsreserve.php?op=mod&NoOfRunsID='+document.getElementById("NoOfRunsID1").value+'&noid='+document.getElementById("ModelID1").value
	}
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#4C4C4C"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">班 次 预 留  查 询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="tms_v1_basedata_addnorunsreserve.php?NoOfRunsID=<?php echo $clnumber;?>">添加</a></li>   
        <li><a href="#" onclick="modnorunsreserve()">修改</a></li>   
        <li><a href="#" id="dell" onclick="delnorunsreserve()">删除</a></li>
        <li><a href="#" onclick="retur()">返回</a></li>       
    </ul>   
</div> 
<?
//连接数据库，获取班次信息
?>
<form method="get" name="aaa" action="tms_v1_basedata_addnorunsreserve.php?">
<table width="100%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
 <tr>
	<td nowrap="nowrap" width="10%" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次编号：</span></td>
	<td width="10%" bgcolor="#FFFFFF">
		<input type="hidden" name="NoOfRunsID" value="<?php echo $clnumber;?>"/>
		<input type="text" name="NoOfRunsI" disabled="disabled" value="<?php echo $clnumber;?>"/>
	</td>
    <td bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;<input name="submit" type="submit" value="添加">
    	&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="修改" onclick="modnorunsreserve()">
    	&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="删除" onclick="delnorunsreserve()">
    	&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="retur()">
    </td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" id="ServiceTable" class="main_tableboder">
  <tr>
    <td nowrap="nowrap" align="center" bgcolor="#006699">车型编号</td>
    <td nowrap="nowrap" align="center" bgcolor="#006699">车型名</td>
    <td nowrap="nowrap" align="center" bgcolor="#006699">预留座位号</td>
    <td nowrap="nowrap" align="center" bgcolor="#006699">预留座位数</td>
    <td nowrap="nowrap" align="center" bgcolor="#006699">执行预留者编号</td>
    <td nowrap="nowrap" align="center" bgcolor="#006699">执行预留者姓名</td>
    <td nowrap="nowrap" align="center" bgcolor="#006699">备注</td>
  </tr>
  <?php 
		$sql = "select* FROM tms_bd_ScheduleReserve WHERE sr_NoOfRunsID='{$clnumber}'";
		$query =$class_mysql_default->my_query($sql);
	//	if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
		while($result=mysqli_fetch_array($query)){
	?>
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'ModelID1')">
		<td nowrap="nowrap" align="center"><?php echo $result['sr_ModelID'];?></td>
    	<td nowrap="nowrap" align="center"><?php echo $result['sr_ModelName'];?></td> 
    	<td nowrap="nowrap" align="center"><?php echo $result['sr_ReserveSeatNO'];?></td>
    	<td nowrap="nowrap" align="center"><?php echo $result['sr_ReserveSeatS'];?></td>
    	<td nowrap="nowrap" align="center"><?php echo $result['sr_SellerID'];?></td>
    	<td nowrap="nowrap" align="center"><?php echo $result['sr_Seller'];?></td>
    	<td nowrap="nowrap" align="center"><?php echo $result['sr_Remark'];?></td>
	</tr>
	<?php 
		}
  	?> 
  	<tr><td><input type="hidden" id="ModelID1" value=""/> <input type="hidden" id="NoOfRunsID1" value="<?php echo $clnumber;?>"/></td></tr>
</table>
</form>
