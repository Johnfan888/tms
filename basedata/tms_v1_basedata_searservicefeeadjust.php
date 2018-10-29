<?php
//班次站务费查询界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber=$_GET['clnumber'];
	$selectnoruns="SELECT * FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID='{$clnumber}'";
	$querynoruns=$class_mysql_default->my_query($selectnoruns);
	$resultnoruns=mysqli_fetch_array($querynoruns);
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
<link href="./tms.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function addservicefeeadjust(){
	window.location.href='tms_v1_basedata_addservicefeeadjust.php?clnumber1='+document.getElementById("NoOfRunsID").value+'&clnumber2='+document.getElementById("LineID").value;	
}
function retur(){
	window.location.href='tms_v1_basedata_searnoruns.php?'
}
function delservicefeeadjust(){
	if (!document.getElementById("ID1").value){
		alert('请选择您要删除的所调站务费班次信息！')
		return false
	}else{
		if(!confirm("确定要删除该班次数据吗？")){
			return false;
		}else{
			window.location.href='tms_v1_basedata_delservicefeeadjust.php?op=del&clnumber='+document.getElementById("ID1").value+'&clnumber1='+document.getElementById("NoOfRunsID1").value
		}
	}
}
function modservicefeeadjust(){
	if (!document.getElementById("ID1").value){
		alert('请选择您要删除的所调站务费班次信息！')
		return false
	}else{
		window.location.href='tms_v1_basedata_modservicefeeadjust.php?op=mod&clnumber='+document.getElementById("ID1").value
	}
}
</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">班 次 站 务 费 查 询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="#" onclick="addservicefeeadjust()">添加</a></li>   
        <li><a href="#" onclick="modservicefeeadjust()">修改</a></li>   
        <li><a href="#" id="dell" onclick="delservicefeeadjust()">删除</a></li>
        <li><a href="#" onclick="retur()">返回</a></li>       
    </ul>   
</div> 
<?
//连接数据库，获取班次信息
?>
<form method="post" name="aaa" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路名：</span></td>
    <td bgcolor="#FFFFFF"><input type="hidden" name="LineID" id="LineID" readonly="readonly" value="<?php echo $resultnoruns['nri_LineID']?>"/>
    <input type="text" name="LineNmae" id="LineNmae" disabled="disabled" value="<?php echo $resultnoruns['nri_LineName']?>"/>
    </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次编号：</span></td>
    <td bgcolor="#FFFFFF"><input type="hidden" name="NoOfRunsID" id="NoOfRunsID"  value="<?php echo $resultnoruns['nri_NoOfRunsID']?>"/>
    <input type="text" name="NoOfRunsID1" id="NoOfRunsID1" disabled="disabled" value="<?php echo $resultnoruns['nri_NoOfRunsID']?>"/>
    </td>
    <td colspan="2" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="添加" onclick="addservicefeeadjust()"/>
    	&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="修改" onclick="modservicefeeadjust()"/>
    	&nbsp;&nbsp;&nbsp;<input name="button3" type="button" value="删除" onclick="delservicefeeadjust()"/>
    	&nbsp;&nbsp;&nbsp;<input name="button4" type="button" value="返回" onclick="retur()"/>
    </td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer"> 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader"> 
  <tr>
    <th nowrap="nowrap" align="center" bgcolor="#006699" style="display:none">序号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">序号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">是否按协议调价</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">所调价单位</th>
<!--    <th nowrap="nowrap" align="center" bgcolor="#006699">所调价线路编号</th>-->
    <th nowrap="nowrap" align="center" bgcolor="#006699">是否按班次调价</th>
<!--    <th nowrap="nowrap" align="center" bgcolor="#006699">所调价班次编号</th>-->
    <th nowrap="nowrap" align="center" bgcolor="#006699">发车站编号</th>
   	<th nowrap="nowrap" align="center" bgcolor="#006699">发车站</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">到达站编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">到达站</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车型编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车型名</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">开始日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">结束日期</th>
<!--  
    <td nowrap="nowrap" align="center" bgcolor="#006699">开始时间</td>
    <td nowrap="nowrap" align="center" bgcolor="#006699">结束时间</td>
-->
	<th nowrap="nowrap" align="center" bgcolor="#006699">执行价格</th> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
  </tr>
      </thead> 
<tbody class="scrollContent">
  <?php
  	$i=0;
	$sql="SELECT * FROM tms_bd_ServiceFeeAdjust where  sfa_NoRunsAdjust='{$clnumber}'";
	$query =$class_mysql_default->my_query($sql);
//	if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
	while ($row = mysqli_fetch_array($query)){
		$i++;
	?>
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'ID1')">
        <td nowrap="nowrap" align="center" style="display:none"><?php echo $row['sfa_ID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $i?></td>
        <td nowrap="nowrap" align="center"><?php if($row['sfa_ISUnitAdjust']=='0') echo '否'; else echo '是';?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['sfa_Unit'];?></td>
        <!--<td nowrap="nowrap" align="center"><?php echo $row['sfa_LineAdjust'];?></td>
        --><td nowrap="nowrap" align="center"><?php if($row['sfa_ISNoRunsAdjust']=='0') echo '否'; else echo '是';?></td>
        <!--<td nowrap="nowrap" align="center"><?php echo $row['sfa_NoRunsAdjust'];?></td>
        --><td nowrap="nowrap" align="center"><?php echo $row['sfa_DepartureSiteID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['sfa_DepartureSite'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['sfa_GetToSiteID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['sfa_GetToSite'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['sfa_ModelID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['sfa_ModelName'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['sfa_BeginDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['sfa_EndDate'];?></td>
 <!-- 
        <td nowrap="nowrap" align="center"><?php echo $row['sfa_BeginTime'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['sfa_EndTime'];?></td>
  -->
        <td nowrap="nowrap" align="center"><?php echo $row['sfa_RunPrice'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['sfa_Remark'];?></td>
      </tr>
		<?php 
	//	echo $row['sfa_ID'];
			}
	
		?>  
		<tr><td><input type="hidden" id="ID1" value=""/> <input type="hidden" id="NoOfRunsID1" value="<?php echo $resultnoruns['nri_NoOfRunsID'];?>"/></td></tr>   
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>