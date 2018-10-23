<?
//车型查询界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
//	if(isset($_POST['ModelID'])) {
		$RegionCode2=$_POST['RegionCode2'];
		$ModelID=$_POST['ModelID'];
		$Rank=$_POST['Rank'];
		$Category=$_POST['Category'];
		$sql1 = "SELECT COUNT(bm_ModelID) AS number FROM tms_bd_BusModel where bm_ModelID like '{$ModelID}%'and IFNULL(bm_Rank, '') like '{$Rank}%' and IFNULL(bm_Category, '') like '{$Category}%' ";
		$query1 =$class_mysql_default->my_query($sql1);
		$rows = mysql_fetch_array($query1);	
//	}
	  if($RegionCode2 == 'excel'){
		  $file_name = "searbusmodel.csv";
		  header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		  header("Content-Disposition: attachment; filename=$file_name");
		  header("Cache-Control: no-cache, must-revalidate");
		  $fp = fopen('php://output', 'w'); //打开php文件句柄
		  $out = array('', '', '', '', '','','',  '车型管理信息表', '', '', '', '', '', '', '', '');
		  fputcsv($fp, $out);
		  $head = array('车型编号', '车型名', '等级', '分类', '座位数', '加座数', '允许半票数', '载重','添加者编号', '添加者', '添加时间', '修改者编号', '修改者', '修改时间', '备注');
		  fputcsv($fp, $head);
		
		  $cnt = 0; //计数器
		  $limit = 100000; //每隔100000行，刷新输出buffer
		  $outputRow = "";
		  $queryString = "SELECT bm_ModelID,bm_ModelName,bm_Rank,bm_Category,bm_Seating,bm_AddSeating,bm_AllowHalfSeats,
						  bm_Weight,bm_AdderID,bm_Adder,bm_AddTime,bm_ModerID,bm_Moder,bm_ModTime,bm_Remark
			 	    	  FROM tms_bd_BusModel where bm_ModelID like '{$ModelID}%'and IFNULL(bm_Rank, '') like '{$Rank}%' and IFNULL(bm_Category, '') like '{$Category}%' ";
		  $result = $class_mysql_default->my_query("$queryString");
		  while ($row = mysql_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
				}
			$row['bm_ModelID']=$row['bm_ModelID']."\t";	
			$outputRow = array($row['bm_ModelID'], $row['bm_ModelName'], $row['bm_Rank'], $row['bm_Category'], $row['bm_Seating'], 
        					   $row['bm_AddSeating'], $row['bm_AllowHalfSeats'], $row['bm_Weight'], $row['bm_AdderID'], $row['bm_Adder'], $row['bm_AddTime'],
        					   $row['bm_ModerID'], $row['bm_Moder'], $row['bm_ModTime'], $row['bm_Remark']); 
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
function add(){
	window.location.href='tms_v1_basedata_addbusmodel.php';
}
/*function del(){
	if (!document.getElementById("ModelID1").value){
		alert('请选择车型！')
		return false
	}else{
		if(!confirm("确定要删除该数据吗？")){
			return false;
		}else{
			window.location.href='tms_v1_basedata_delbusmodel.php?op=del&clnumber='+document.getElementById("ModelID1").value
		}
	}
} */
function mod(){
	if (!document.getElementById("ModelID1").value){
		alert('请选择车型！')
		return false
	}else{
		window.location.href='tms_v1_basedata_modbusmodel.php?op=mod&clnumber='+document.getElementById("ModelID1").value
		}
}
function searticketpricefactor(){
	if (!document.getElementById("ModelID1").value){
		alert('请选择车型！')
		return false
	}else{
		window.location.href='tms_v1_basedata_searticketpricefactor.php?op=sea&clnumber='+document.getElementById("ModelID1").value
		}
}

$(document).ready(function(){
	$("#del").click(function(){
		delbusmodel()
	});
});
$(document).ready(function(){
	$("#dell").click(function(){
		delbusmodel()
	});
});
$(document).ready(function(){
	$("#table1").tablesorter();
});
function delbusmodel(){
	if (!document.getElementById("ModelID1").value){
		alert('请选择车型！')
		return false
	}else{
		if(!confirm("删除该车型数据会对以后的结算有影响，确定要删除该车型数据吗？")){
			return false;
		}else{
			var ModelID = $("#ModelID1").val();
			jQuery.get(
					'tms_v1_basedata_delbusmodel.php',
					{'op': 'del', 'ModelID': ModelID, 'time': Math.random()},
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
    <span class="graytext" style="margin-left:8px;">车 型 查 询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="#" onclick="add()">添加车型</a></li>   
        <li><a href="#" onclick="mod()">修改车型</a></li>   
        <li><a href="#" id="dell">删除车型</a></li>
    </ul>   
</div> 

<form method="post" name="form1" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型编号：</span></td>
    <td bgcolor="#FFFFFF"><input type="text" name="ModelID" value="<?php echo $ModelID;?>"/></td>
    <td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车型级别：</span></td>
    <td bgcolor="#FFFFFF">
			<select name="Rank" style="width:100px;">
				<option value="<?php echo $Rank;?>"><?php echo $Rank;?></option>
				<?php
					 switch ($Rank){
    					case "":
    						echo "<option value='高级'>高级</option>";
    						echo"<br>";
    						echo "<option value='中级'>中级</option>";
    						echo"<br>";
    						echo "<option value='低级'>低级</option>";
    						break; 
    					case "高级":
    						echo "<option></option>";
    						echo"<br>";
    						echo "<option value='中级'>中级</option>";
    						echo"<br>";
    						echo "<option value='低级'>低级</option>";
    						break; 
    					case "中级":
    						echo "<option></option>";
    						echo"<br>";
    						echo "<option value='高级'>高级</option>";
    						echo"<br>";
    						echo "<option value='低级'>低级</option>";
    						break; 
    					case "低级":
    						echo "<option></option>";
    						echo"<br>";
    						echo "<option value='高级'>高级</option>";
    						echo"<br>";
    						echo "<option value='中级'>中级</option>";
    						break; 
    				} 
				?>
      		</select></td> 
     <td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车型类别：</span></td>
     <td bgcolor="#FFFFFF">
			<select name="Category" style="width:100px;">
      			<option value="<?php echo $Category;?>"><?php echo $Category;?></option>
      			<?php
					 switch ($Category){
    					case "":
    						echo "<option value='客车'>客车</option>";
    						echo"<br>";
    						echo "<option value='卧铺'>卧铺</option>";
    						break; 
    					case "客车":
    						echo "<option></option>";
    						echo"<br>";
    						echo "<option value='卧铺'>卧铺</option>";
    						break;
    					case "卧铺":
    						echo "<option></option>";
    						echo"<br>";
    						echo "<option value='客车'>客车</option>";
    						break; 
    				} 
				?>
     	 	</select></td>      
  </tr>
  <tr>
    <td align="left" colspan="5" bgcolor="#FFFFFF" >
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="车型查询" id="button1">
    	&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="添加车型" onclick="add()">
    	&nbsp;&nbsp;&nbsp;<input name="button3" type="button" value="修改车型" onclick="mod()">
    	&nbsp;&nbsp;&nbsp;<input name="button4" id="del" type="button" value="删除车型" onclick="del()">
    	&nbsp;&nbsp;&nbsp;<input name="exceldoc" id="exceldoc" type="button" value="导出Excel">
    	<!--  &nbsp;&nbsp;&nbsp;<input name="button5" type="button" value="票价因素情况" onclick="searticketpricefactor()"> -->
    </td>
     <td nowrap="nowrap" bgcolor="#FFFFFF">车型总数：<?php if($rows['number']=='') echo '0'; else echo $rows['number'];?></td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
  <tr>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车型编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车型名</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">等级</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">分类</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">座位数</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">加座数</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">允许半票数</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">载重</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">添加者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">添加者</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">添加时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">修改者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">修改者</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">修改时间</th>
<!--   
    <td nowrap="nowrap" align="center" bgcolor="#006699">内部结算率</th>
 --> 
    <th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
  </tr>
  </thead> 
<tbody class="scrollContent">
	<?php
		if($RegionCode2 == '') {
			$sql = "SELECT bm_ModelID,bm_ModelName,bm_Rank,bm_Category,bm_Seating,bm_AddSeating,bm_AllowHalfSeats,
					bm_Weight,bm_AdderID,bm_Adder,bm_AddTime,bm_ModerID,bm_Moder,bm_ModTime,bm_Remark
			 	    FROM tms_bd_BusModel where bm_ModelID like '{$ModelID}%'and IFNULL(bm_Rank, '') like '{$Rank}%' and IFNULL(bm_Category, '') like '{$Category}%' ";
			$query =$class_mysql_default->my_query($sql);
			//if (!$query) echo "SQL错误：".mysql_error();
			while ($row = mysql_fetch_array($query)) {
	?> 
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'ModelID1')">
		<td align="center" nowrap="nowrap" ><?php echo $row['bm_ModelID'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['bm_ModelName'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['bm_Rank'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['bm_Category'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['bm_Seating'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['bm_AddSeating'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['bm_AllowHalfSeats'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['bm_Weight'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['bm_AdderID'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['bm_Adder'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['bm_AddTime'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['bm_ModerID'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['bm_Moder'];?></td>
		<td align="center" nowrap="nowrap" ><?php echo $row['bm_ModTime'];?></td>
<!--  		
		<td align="center"><?php echo $row['bm_Closing'];?></td>
-->
		<td align="center"><?php echo $row['bm_Remark'];?></td>
	</tr> 
	<?php 
			}
		}
	?>
	<tr>
		<td><input type="hidden" id="ModelID1" value=""/></td>
		<td><input type="hidden" id="RegionCode2" value="" name="RegionCode2"/></td>
	</tr>        
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>
