<?
//机构查询界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
//	if(isset($_POST['OrgCode'])) {
		$RegionCode2=$_POST['RegionCode2'];
		$OrgCode= $_POST['OrgCode'];
		$OrgName=$_POST['OrgName'];
		$helpcode=$_POST['helpcode'];
		$sql1 = "SELECT COUNT(ao_ID) AS number FROM `tms_bd_AdOrg` WHERE ao_OrgCode like'$OrgCode%' AND ao_OrgName like '$OrgName%' AND ao_HelpCode like '$helpcode%'";
		$query1 = $class_mysql_default->my_query($sql1);
		$rows = mysql_fetch_array($query1);
//	}
	   if($RegionCode2 == 'excel'){
		  $file_name = "searadorg.csv";
		  header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		  header("Content-Disposition: attachment; filename=$file_name");
		  header("Cache-Control: no-cache, must-revalidate");
		  $fp = fopen('php://output', 'w'); //打开php文件句柄
		  $out = array('', '', '', '', '',  '组织机构管理信息表', '', '', '', '', '', '', '', '');
		  fputcsv($fp, $out);
		  $head = array('序号', '机构编码', '机构名称', '助记码', '添加者编号', '添加者', '添加时间', '修改者编号', '修改者', '修改时间', '备注');
		  fputcsv($fp, $head);
		
		  $cnt = 0; //计数器
		  $limit = 100000; //每隔100000行，刷新输出buffer
		  $outputRow = "";
		  $queryString = "SELECT ao_ID, ao_OrgCode,ao_OrgName,ao_HelpCode,ao_AdderID,ao_Adder,ao_AddTime,
		  				  ao_ModerID,ao_Moder,ao_ModTime,ao_Remark FROM `tms_bd_AdOrg` WHERE ao_OrgCode like'$OrgCode%' AND ao_OrgName like '$OrgName%'";
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
				
			$outputRow = array($i, $row['ao_OrgCode'], $row['ao_OrgName'], $row['ao_HelpCode'], $row['ao_AdderID'], 
        		$row['ao_Adder'], $row['ao_AddTime'], $row['ao_ModerID'], $row['ao_Moder'], $row['ao_ModTime'], $row['ao_Remark']); 
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
<script type="text/javascript" src="./tms_v1_screen1.js"></script>
<script type="text/javascript" src="./tms_v1_rightclick.js"></script>
<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<link href="../css/tms.css" rel="stylesheet" type="text/css">
<script language="javascript">
<!--
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
	window.location.href='tms_v1_basedata_addadorg.php';
}
function modregion(){
	if (!document.getElementById("ID1").value){
		alert('请选择机构！')
		return false
	}else{
		window.location.href='tms_v1_basedata_modadorg.php?op=mod&clnumber='+document.getElementById("ID1").value
		}
}
$(document).ready(function(){
	$("#del").click(function(){
		delregion()
	});
});
$(document).ready(function(){
	$("#dell").click(function(){
		delregion()
	});
});

$(document).ready(function(){
	$("#table1").tablesorter();
});
function delregion(){
	if (!document.getElementById("ID1").value){
		alert('请选择机构！')
		return false
	}else{
		if(!confirm("确定要删除该机构吗？")){
			return false;
		}else{
			var ID = $("#ID1").val();
			jQuery.get(
					'tms_v1_basedata_deladorg.php',
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
-->
</script>

</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">机 构 查 询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="tms_v1_basedata_addadorg.php">添加机构</a></li>   
        <li><a href="#" onclick="modregion()">修改机构</a></li>   
        <li><a href="#" id="dell">删除机构</a></li>     
    </ul>   
</div>   
<form method="post" name="form1" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />机构编码：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="OrgCode" value="<?php echo $OrgCode;?>" /></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />机构名称：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="OrgName" value="<?php echo $OrgName;?>" /></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />助记码：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="helpcode" /></td>
   </tr>
 <tr>  
    <td align="center" nowrap="nowrap" bgcolor="#FFFFFF" colspan=5 >
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="机构查询" id="button1">
    	&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="添加机构" onclick="addregion()">
    	&nbsp;&nbsp;&nbsp;<input name="button3" type="button" value="修改机构" onclick="modregion()">
    	&nbsp;&nbsp;&nbsp;<input name="button4" id="del" type="button" value="删除机构" >
    	&nbsp;&nbsp;&nbsp;<input name="exceldoc" id="exceldoc" type="button" value="导出Excel">
    </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">机构总数：<?php if($rows['number']=='') echo '0'; else echo $rows['number'];?></td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
  <tr>
  	<th nowrap="nowrap" align="center" bgcolor="#006699" style="display:none;">序号</th>
  	<th nowrap="nowrap" align="center" bgcolor="#006699" >序号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">机构编码</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">机构名称</th>
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
			$sql = "SELECT * FROM `tms_bd_AdOrg` WHERE ao_OrgCode like'$OrgCode%' AND ao_OrgName like '$OrgName%' AND ao_HelpCode like '$helpcode%'";
			$query =$class_mysql_default->my_query($sql);
			while ($row = mysql_fetch_array($query)) {
				$i++;
	?> 
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'ID1')">
		<td align="center" style="display:none;"><?php echo $row['ao_ID'];?></td>
		<td align="center"><?=$i?></td>
		<td align="center"><?php echo $row['ao_OrgCode'];?></td>
		<td align="center"><?php echo $row['ao_OrgName'];?></td>
		<td align="center"><?php echo $row['ao_HelpCode'];?></td>
		<td align="center"><?php echo $row['ao_AdderID'];?></td>
		<td align="center"><?php echo $row['ao_Adder'];?></td>
		<td align="center"><?php echo $row['ao_AddTime'];?></td>
		<td align="center"><?php echo $row['ao_ModerID'];?></td>
		<td align="center"><?php echo $row['ao_Moder'];?></td>
		<td align="center"><?php echo $row['ao_ModTime'];?></td>
		<td align="center"><?php echo $row['ao_Remark'];?></td>
	</tr> 
	<?php 
			}
		}
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
