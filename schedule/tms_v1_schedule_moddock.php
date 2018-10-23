<?php
//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber = $_GET['clnumber'];
	$sqls = "select nri_NoOfRunsID,nri_LineID,nri_LineName,nri_BeginSite,nri_EndSite FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID='{$clnumber}'";
	$querys =$class_mysql_default->my_query($sqls);
	$results=mysql_fetch_array($querys);
	$select="SELECT count(nds_ID) FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$clnumber}'";
  	$query1 =$class_mysql_default->my_query($select); 
  	$row=mysql_fetch_array($query1);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head> 
<title>班次停靠点查询</title>

<script type="text/javascript" src="../basedata/tms_v1_screen1.js"></script>
<script type="text/javascript" src="../basedata/tms_v1_rightclick.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<link href="../basedata/tms.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function retur(){
	window.close();	
}
function delnorunsdock(){
	if (!document.getElementById("ID1").value){
		alert('请选择停靠点！')
		return false
	}else{
		if(document.getElementById("ID1").value=='1'){
			alert('起点站不能删除')
			return false
		}
		if(document.getElementById("ID1").value==document.getElementById("number").value){
			alert('终点站不能删除')
			return false
		}
		if(!confirm("确定要删除该停靠点吗？")){
			return false;
		}else{
			window.location.href='tms_v1_schedule_delnorunsdock.php?op=del&NoOfRunsID='+document.getElementById("NoOfRunsID1").value+'&noid='+document.getElementById("ID1").value
		}
	}
}
function modnorunsdock(){
	if (!document.getElementById("ID1").value){
		alert('请选择站点！')
		return false
	}else{
		if(document.getElementById("ID1").value=='1' || document.getElementById("ID1").value==document.getElementById("number").value){
			window.location.href='tms_v1_schedule_modnorunsdock1.php?op=mod&NoOfRunsID='+document.getElementById("NoOfRunsID1").value+'&noid='+document.getElementById("ID1").value+'&time'+Math.random();
		}else{
			window.location.href='tms_v1_schedule_modnorunsdock.php?op=mod&NoOfRunsID='+document.getElementById("NoOfRunsID1").value+'&noid='+document.getElementById("ID1").value+'&time'+Math.random();
		}
	}
} 
</script>
</head>
<body style="overflow-x:hidden;">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">班 次 停 靠 点 查 询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="tms_v1_schedule_addnorunsdock.php?NoOfRunsID=<?php echo $results['nri_NoOfRunsID'];?>&LineID=<?php echo $results['nri_LineID'];?>">添加停靠点</a></li>   
        <li><a href="#" onclick="modnorunsdock()">修改停靠点</a></li>   
        <li><a href="#" id="dell" onclick="delnorunsdock()">删除停靠点</a></li>
        <li><a href="#" onclick="retur()">关闭</a></li>       
    </ul>   
</div> 
<?
//连接数据库，获取班次信息
?>
<form method="get" name="aaa" action="tms_v1_schedule_addnorunsdock.php?">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次编号：</span></td>
	<td nowrap="nowrap" bgcolor="#FFFFFF">
		<input type="hidden" name="NoOfRunsID" value="<?php echo $results['nri_NoOfRunsID']?>"/>
		<input type="text" name="NoOfRunsI" disabled="disabled" value="<?php echo $results['nri_NoOfRunsID']?>"/>
	</td>
	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路：</span></td>
    <td width="10%" bgcolor="#FFFFFF">
    	<input type="hidden" name="LineID" value="<?php echo $results['nri_LineID']?>"/>
    	<input type="hidden" name="LineName" value="<?php echo $results['nri_LineName']?>"/>
		<input type="text" name="LineNam" disabled="disabled" value="<?php echo $results['nri_LineName']?>"/>
    </td>
     <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 起点站：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">
    	<input type="hidden" name="BeginSite" value="<?php echo $results['nri_BeginSite']?>"/>
		<input type="text" name="BeginSit" disabled="disabled" value="<?php echo $results['nri_BeginSite']?>"/>
    </td>  
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 终点站：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">
    	<input type="hidden" name="EndSite" value="<?php echo $results['nri_EndSite']?>"/>
		<input type="text" name="EndSit" disabled="disabled" value="<?php echo $results['nri_EndSite']?>"/>
    </td>
 </tr>
 <tr>   
    <td colspan="7" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;<input name="submit" type="submit" value="添加停靠点">
    	&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="修改停靠点" onclick="modnorunsdock()">
    	&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="删除停靠点" onclick="delnorunsdock()">
    	&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="关闭" onclick="retur()">
    </td>
     <td nowrap="nowrap" bgcolor="#FFFFFF">停靠点总数：<?php if($row[0]=='') echo '0'; else echo $row[0];?></td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer"> 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader"> 
  <tr>
    <th nowrap="nowrap" align="center" bgcolor="#006699">站点序号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">站点名</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">站点编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">是否停靠点</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">是否上车点</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">是否检票点</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">运行时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">检票口</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">是否收站务费</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">站务费</th>
<!-- 
    <td nowrap="nowrap" align="center" bgcolor="#006699">微机费</td>
    <td nowrap="nowrap" align="center" bgcolor="#006699">发班费</td>
 -->
    <th nowrap="nowrap" align="center" bgcolor="#006699">劳务费(%)</th>
<!--  
    <td nowrap="nowrap" align="center" bgcolor="#006699">其他费用4</td>
    <td nowrap="nowrap" align="center" bgcolor="#006699">其他费用5</td>
    <td nowrap="nowrap" align="center" bgcolor="#006699">其他费用6</td>
	<td nowrap="nowrap" align="center" bgcolor="#006699">限制售票数</td>
    <td nowrap="nowrap" align="center" bgcolor="#006699">限制售票时间</td>
-->
    <th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
  </tr>
    </thead> 
<tbody class="scrollContent"> 
  	<?php
		$sql = "select* FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$clnumber}'";
		$query =$class_mysql_default->my_query($sql);
		while($result=mysql_fetch_array($query)){
	?>
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'ID1')">
		<td nowrap="nowrap" align="center"><?php echo $result['nds_ID'];?></td>
    	<td nowrap="nowrap" align="center"><?php echo $result['nds_SiteName'];?></td>
    	<td nowrap="nowrap" align="center"><?php echo $result['nds_SiteID'];?></td>
    	<td nowrap="nowrap" align="center"><?php if($result['nds_IsDock']!=0)echo "是";else echo"否";?></td>
    	<td nowrap="nowrap" align="center"><?php if($result['nds_GetOnSite']!=0) echo "是";else echo"否";?></td>
    	<td nowrap="nowrap" align="center"><?php if($result['nds_CheckInSite']!=0) echo "是";else echo"否";?></td>
    	<td nowrap="nowrap" align="center"><?php echo $result['nds_DepartureTime'];?></td>
    	<td nowrap="nowrap" align="center">
    		<?php 
	        	$Hours='';
	        	$Minutes=''; 
	        	$RunHours=explode(":", $result['nds_RunHours']);
	        	if($RunHours[0]) $Hours=$RunHours[0].'小时';
	        	if($RunHours[1]) $Minutes=$RunHours[1].'分钟';    
	        	echo $Hours.$Minutes;
    		?>
    	</td>
    	<td nowrap="nowrap" align="center"><?php echo $result['nds_CheckTicketWindow'];?></td>
    	<td nowrap="nowrap" align="center"><?php if($result['nds_IsServiceFee']!=0) echo "是";else echo"否";?></td>
    	<td nowrap="nowrap" align="center"><?php echo $result['nds_ServiceFee'];?></td>
 <!--  
    	<td nowrap="nowrap" align="center"><?php echo $result['nds_otherFee1'];?></td>
    	<td nowrap="nowrap" align="center"><?php echo $result['nds_otherFee2'];?></td>
-->
    	<td nowrap="nowrap" align="center"><?php echo ($result['nds_otherFee3']*100).'%';?></td>
<!--  
    	<td nowrap="nowrap" align="center"><?php echo $result['nds_otherFee4'];?></td>
    	<td nowrap="nowrap" align="center"><?php echo $result['nds_otherFee5'];?></td>
    	<td nowrap="nowrap" align="center"><?php echo $result['nds_otherFee6'];?></td>
    	<td nowrap="nowrap" align="center"><?php echo $result['nds_StintSell'];?></td>
    	<td nowrap="nowrap" align="center"><?php echo $result['nds_StintTime'];?></td>
 --> 
    	<td nowrap="nowrap" align="center"><?php echo $result['nds_Remark'];?></td>
	</tr>
  	<?php 
		}
  	?>
  	<tr><td><input type="hidden" id="ID1" value=""/>
  			<input type="hidden" id="number" value="<?php echo $row[0];?>"/>
  			<input type="hidden" id="NoOfRunsID1" value="<?php echo $results['nri_NoOfRunsID'];?>"/>
  	</td></tr>
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>
