<?php
//线路调价查询界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber=$_GET['clnumber'];
	$selectnoruns="SELECT li_LineName,li_LineID FROM tms_bd_LineInfo WHERE li_LineID='{$clnumber}'";
	$querynoruns=$class_mysql_default->my_query($selectnoruns);
	$resultnoruns=mysql_fetch_array($querynoruns);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head> 
<title></title> 
<script type="text/javascript" src="./tms_v1_screen1.js"></script>
<script type="text/javascript" src="./tms_v1_rightclick.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
<link href="../css/tms.css" rel="stylesheet" type="text/css">
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function addlineadjustprice(){
	window.location.href='tms_v1_basedata_addlineadjustprice.php?clnumber='+document.getElementById("LineID").value;;	
}
function retur(){
	window.location.href='tms_v1_basedata_searline.php?'
}
function dellineadjustprice(){
	if (!document.getElementById("ID1").value){
		alert('请选择您要删除的线路调价信息！')
		return false
	}else{
		if(!confirm("确定要删除该调价信息吗？")){
			return false;
		}else{
			window.location.href='tms_v1_basedata_dellineadjustprice.php?op=del&clnumber='+document.getElementById("ID1").value+'&clnumber1='+document.getElementById("LineID1").value
		}
	}
}
function modlineadjustprice(){
	if (!document.getElementById("ID1").value){
		alert('请选择您要修改的线路调价信息！')
		return false
	}else{
		window.location.href='tms_v1_basedata_modlineadjustprice.php?op=mod&clnumber='+document.getElementById("ID1").value
	}
}
</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">线 路 调 价 查 询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="#" onclick="addlineadjustprice()">添加</a></li>   
        <li><a href="#" onclick="modlineadjustprice()">修改</a></li>   
        <li><a href="#" onclick="dellineadjustprice()">删除</a></li>
        <li><a href="#" onclick="retur()">返回</a></li>     
    </ul>   
</div> 
<?
//连接数据库，获取班次信息
?>
<form method="post" name="aaa" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路编号：</span></td>
    <td bgcolor="#FFFFFF"><input type="hidden" style="width:230px;" name="LineID" id="LineID" readonly="readonly" value="<?php echo $resultnoruns['li_LineID']?>"/>
    <input type="text" style="width:230px;" name="LineID1" id="LineID1" disabled="disabled" value="<?php echo $resultnoruns['li_LineID']?>"/>
    </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路名：</span></td>
    <td bgcolor="#FFFFFF">
    <input type="text" name="LineID1" id="LineID1" disabled="disabled" value="<?php echo $resultnoruns['li_LineName']?>"/>
    <input type="hidden" name="LineID" id="LineID"  value="<?php echo $resultnoruns['li_LineName']?>"/>
    </td>
    <td colspan="2" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="添加" onclick="addlineadjustprice()"/>
    	&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="修改" onclick="modlineadjustprice()"/>
    	&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="删除" onclick="dellineadjustprice()"/>
    	&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="retur()"/>
    </td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader"> 
  <tr>
    <th nowrap="nowrap" align="center" bgcolor="#006699" style="display:none">序号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">序号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">是否按协议调价</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">所调价单位</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">是否按线路调价</th>
<!--    <th nowrap="nowrap" align="center" bgcolor="#006699">所调价线路编号</th>-->
    <th nowrap="nowrap" align="center" bgcolor="#006699">发车站编号</th>
   	<th nowrap="nowrap" align="center" bgcolor="#006699">发车站</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">到达站编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">到达站</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车型编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车型名</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">开始日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">结束日期</th>
<!-- 
    <th nowrap="nowrap" align="center" bgcolor="#006699">开始时间</td>
    <th nowrap="nowrap" align="center" bgcolor="#006699">结束时间</td>    
    <th nowrap="nowrap" align="center" bgcolor="#006699">参考价格</td>
    <th nowrap="nowrap" align="center" bgcolor="#006699">上调百分比</td>
-->
	<th nowrap="nowrap" align="center" bgcolor="#006699">标准价</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">执行价</th> 
	<th nowrap="nowrap" align="center" bgcolor="#006699">半价</th> 
	<th nowrap="nowrap" align="center" bgcolor="#006699">结算价</th> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
  </tr>
      </thead> 
<tbody class="scrollContent"> 
  <?php	
  		$i=0;
		$sql="SELECT * FROM tms_bd_NoRunsAdjustPrice where  nrap_LineAdjust='{$clnumber}' and nrap_ISNoRunsAdjust='0' and (nrap_NoRunsAdjust is NULL) ";
		$query =$class_mysql_default->my_query($sql);
		//if (!$query) echo "SQL错误：".mysql_error();
		while ($row = mysql_fetch_array($query)){
			$i++;
	?>
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'ID1')">
        <td nowrap="nowrap" align="center" style="display:none"><?php echo $row['nrap_ID'];?></td>
        <td nowrap="nowrap" align="center"><?=$i?></td>
        <td nowrap="nowrap" align="center"><?php if($row['nrap_ISUnitAdjust']=='1') echo '是'; else echo '否';?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nrap_Unit'];?></td>
        <td nowrap="nowrap" align="center"><?php if($row['nrap_ISLineAdjust']=='1') echo '是'; else echo '否';?></td><!--
        <td nowrap="nowrap" align="center"><?php echo $row['nrap_LineAdjust'];?></td>
        --><td nowrap="nowrap" align="center"><?php echo $row['nrap_DepartureSiteID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nrap_DepartureSite'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nrap_GetToSiteID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nrap_GetToSite'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nrap_ModelID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nrap_ModelName'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nrap_BeginDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nrap_EndDate'];?></td>
<!--  
        <td nowrap="nowrap" align="center"><?php echo $row['nrap_BeginTime'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nrap_EndTime'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nrap_ReferPrice'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nrap_PriceUpPercent'];?></td>
-->
        <td nowrap="nowrap" align="center"><?php echo $row['nrap_ReferPrice'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nrap_RunPrice'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nrap_HalfPrice'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nrap_BalancePrice'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['nrap_Remark'];?></td>
         <td nowrap="nowrap" align="center"><?php echo $row['nrap_NoRunsAdjust'];?></td>
      </tr>
		<?php 
		 // echo 	$row['nrap_ID'];
		}
	
		?> 
		<tr><td><input type="hidden" id="ID1" value=""/> <input type="hidden" id="LineID1" value="<?php echo $resultnoruns['li_LineID'];?>"/></td></tr>  
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>