<? 
//线路站点详细
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber = $_GET['clnumber'];
	$sqls = "select li_LineID,li_LineName,li_BeginSite,li_EndSite FROM `tms_bd_LineInfo` WHERE li_LineID='{$clnumber}'";
	$querys =$class_mysql_default->my_query($sqls);
	$results=mysqli_fetch_array($querys);
	$sql1 = "select COUNT(si_SectionID) AS number FROM tms_bd_SectionInfo WHERE si_LineID='{$clnumber}'";
	$query1 =$class_mysql_default->my_query($sql1);
	$rows=mysqli_fetch_array($query1);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head> 
<title>CSS控制表格表头固定</title> 
<script type="text/javascript" src="./tms_v1_screen1.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="./tms_v1_rightclick.js"></script>
<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
<link href="./tms.css" rel="stylesheet" type="text/css">
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<script language="javascript">
function searchline(){
	window.location.href='tms_v1_basedata_searline.php';
}
function dellinesite(){
	if (!document.getElementById("SectionID1").value){
		alert('请选择站点！');
		return false;
	}else{
		if(document.getElementById("SectionID1").value=='1'){
			alert('起点站不能删除');
			return false;
		}
		if(document.getElementById("SectionID1").value==document.getElementById("i").value){
			alert('终点站不能删除');
			return false;
		}
		if(!confirm("确定要删除该站点吗？")){
			return false;
		}else{
			window.location.href='tms_v1_basedata_dellinesite.php?op=dellinesite&clnumber='+document.getElementById("LineID1").value+'&section='+document.getElementById("SectionID1").value;
		}
	}
}
function modlinesite(){
	if (!document.getElementById("SectionID1").value){
		alert('请选择站点！');
		return false;
	}
	else{
     	if(document.getElementById("SectionID1").value=='1' || document.getElementById("SectionID1").value==document.getElementById("i").value){
			window.location.href='tms_v1_basedata_modlinesite1.php?op=mod&LineID='+document.getElementById("LineID1").value+'&section='+document.getElementById("SectionID1").value;
		}
		else{
			window.location.href='tms_v1_basedata_modlinesite.php?op=mod&LineID='+document.getElementById("LineID1").value+'&section='+document.getElementById("SectionID1").value;
		}
	}			
}
</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">线 路 站 点  查 询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="tms_v1_basedata_addlinesite.php?LineID=<?php echo $results['li_LineID'];?>&LineName=<?php echo $results['li_LineName'];?>">添加站点</a></li>   
        <li><a href="#" onclick="modlinesite()">修改站点</a></li>   
        <li><a href="#" id="dell" onclick="dellinesite()">删除站点</a></li>
        <li><a href="#" onclick="searchline()">返回</a></li>       
    </ul>   
</div>  
<?

?>
<form method="get" name="aaa" action="tms_v1_basedata_addlinesite.php">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路编号：</span></td>
        <td width="10%" bgcolor="#FFFFFF">
        <input type="hidden" name="LineID" value="<?php echo $results['li_LineID']?>"/>
    	<input type="text" style="width:230px;" name="LineI" disabled="disabled" value="<?php echo $results['li_LineID']?>"/></td>
    <td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路名：</span></td>
    <td "width="10%" bgcolor="#FFFFFF">
    	<input type="hidden" name="LineName"  value="<?php echo $results['li_LineName']?>"/>
    	<input type="text" name="LineNam" disabled="disabled" value="<?php echo $results['li_LineName']?>"/></td>
    <td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 起点站：</span></td>
    <td "width="10%" bgcolor="#FFFFFF" colspan="5">
    	<input name="BiginSite" type="hidden"  value="<?php echo $results['li_BeginSite']?>"/>
    	<input name="BiginSit" type="text" disabled="disabled" value="<?php echo $results['li_BeginSite']?>"/></td>
    </tr>
    <tr>
    <td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 终点站：</span></td>
    <td "width="10%" bgcolor="#FFFFFF">
    	<input type="hidden" name="EndSite"  value="<?php echo $results['li_EndSite']?>"/>
    	<input type="text" name="EndSit" disabled="disabled" value="<?php echo $results['li_EndSite']?>"/></td>
    <td style="text-align:center;" colspan="4" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="sbumit" type="submit" value="添加站点"/>
    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="修改站点" onclick="return modlinesite()"/>
    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="删除站点" onclick="return dellinesite()"/>
   		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return searchline()"/>
   	</td>
   	 <td nowrap="nowrap" bgcolor="#FFFFFF">站点总数：<?php if($rows['number']=='') echo '0'; else echo $rows['number'];?></td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader"> 
  <tr>
    <th nowrap="nowrap" align="center" bgcolor="#006699">站点序号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">站点编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">站点名</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">里程</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">是否停靠点</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">是否上车点</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">是否检票点</th>
  <!-- 
    <td nowrap="nowrap" align="center" bgcolor="#006699">是否收费点</th>
  --> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">是否收站务费</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">站务费(元)</th>
<!--  
    <td nowrap="nowrap" align="center" bgcolor="#006699">微机费</th>
    <td nowrap="nowrap" align="center" bgcolor="#006699">发班费</td>
-->
    <th nowrap="nowrap" align="center" bgcolor="#006699">劳务费(%)</th>
<!--  
    <td nowrap="nowrap" align="center" bgcolor="#006699">其他费用4</td>
    <td nowrap="nowrap" align="center" bgcolor="#006699">其他费用5</td>
    <td nowrap="nowrap" align="center" bgcolor="#006699">其他费用6</td>
 -->
    <th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
  </tr>
    </thead> 
<tbody class="scrollContent"> 
  <?php 
		$i=0;
  		$sql = "select* FROM tms_bd_SectionInfo WHERE si_LineID='{$clnumber}'";
		$query =$class_mysql_default->my_query($sql);
		while($result=mysqli_fetch_array($query)){
	?>
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'SectionID1')">
    <td nowrap="nowrap" align="center"><?php echo $result['si_SectionID'];?></td>
    <td nowrap="nowrap" align="center"><?php echo $result['si_SiteNameID'];?></td>
    <td nowrap="nowrap" align="center"><?php echo $result['si_SiteName'];?></td>
    <td nowrap="nowrap" align="center"><?php echo $result['si_Kilometer'];?></td>
    
    <td nowrap="nowrap" align="center"><?php if($result['si_IsDock']!=0) echo "是";else echo"否";?></td>
    <td nowrap="nowrap" align="center"><?php if($result['si_IsGetOnSite']!=0) echo "是";else echo"否";?></td>
    <td nowrap="nowrap" align="center"><?php if($result['si_IsCheckInSite']!=0) echo "是";else echo"否";?></td>
<!--    
    <td nowrap="nowrap" align="center"><?php if($result['si_IsTollInSite']!=0) echo "是";else echo"否";?></td>
 -->   
    <td nowrap="nowrap" align="center"><?php if($result['si_IsServiceFee']!=0) echo "是";else echo"否";?></td>
    <td nowrap="nowrap" align="center"><?php echo $result['si_ServiceFee'];?></td>
<!--  
    <td nowrap="nowrap" align="center"><?php echo $result['si_otherFee1'];?></td>
    <td nowrap="nowrap" align="center"><?php echo $result['si_otherFee2'];?></td>
-->
    <td nowrap="nowrap" align="center"><?php echo $result['si_otherFee3']*100;?></td>
<!--  
    <td nowrap="nowrap" align="center"><?php echo $result['si_otherFee4'];?></td>
    <td nowrap="nowrap" align="center"><?php echo $result['si_otherFee5'];?></td>
    <td nowrap="nowrap" align="center"><?php echo $result['si_otherFee6'];?></td>
-->
    <td nowrap="nowrap" align="center"><?php echo $result['si_Remark'];?></td>
  </tr>
  	<?php
  		$i=$i+1; 
		}
  	?>
  	<tr><td><input type="hidden" id="SectionID1" value=""/> 
  			<input type="hidden" id="i" value="<?php echo $i;?>"/>
  			<input type="hidden" id="LineID1" value="<?php echo $results['li_LineID'];?>"/></td></tr>
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>

