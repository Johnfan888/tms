<?
//按键项目内容查询界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	
//	if(isset($_POST['CheckItem'])) {
		$CheckItem= $_POST['CheckItem'];
		if($CheckItem=='请选择安检项目') $CheckItem='';
		$sql1 = "SELECT COUNT(ci_CheckItem) AS number FROM `tms_sf_CheckItem` WHERE ci_CheckItem LIKE '$CheckItem%'";
		$query1 = $class_mysql_default->my_query($sql1);
		$rows = mysql_fetch_array($query1);
	//		echo $CheckItem;
//	}
	if(isset($_POST['exceldoc'])) { //添加导出报表
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");
		
		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '安检项目管理信息表', '', '', '', '');
		fputcsv($fp, $out);
		if($CheckItem == '请选择安检项目'){
			$CheckItem = '全部项目';
		}
		$qrydate = "安检项目:" . "$CheckItem";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('安检项目', '检验内容', '添加者编号', '添加者', '添加时间', '修改者编号', '修改者', '修改时间', '备注');
		fputcsv($fp, $head);
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = ""; 
		if($CheckItem == '全部项目'){
			$CheckItem = '';
		}
		$queryString = "SELECT ci_CheckItem,ci_CheckContent,ci_AdderID,ci_Adder,ci_Addertime,ci_ModerID,ci_Moder,ci_Modertime,
				ci_Remark FROM `tms_sf_CheckItem` WHERE ci_CheckItem LIKE '$CheckItem%'";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysql_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			$outputRow = array($row['ci_CheckItem'], $row['ci_CheckContent'], $row['ci_AdderID'], $row['ci_Adder'], $row['ci_Addertime'], $row['ci_ModerID'], 
					$row['ci_Moder'], $row['ci_Modertime'], $row['ci_Remark']); 
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
<script type="text/javascript" src="../basedata/tms_v1_rightclick.js"></script>
<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
<script language="javascript">
<!--
function addregion(){
	window.location.href='tms_v1_safecheck_addcheckitem.php';
}
function modregion(){
	if (!document.getElementById("CheckItem1").value){
		alert('请选择安检项目！');
		return false;
	}else{
		window.location.href='tms_v1_safecheck_modcheckitem.php?op=mod&clnumber1='+document.getElementById("CheckItem1").value+'&clnumber2='+document.getElementById("CheckContent1").value;
		}
}
$(document).ready(function(){
	$("#del").click(function(){
		delregion();
	});
});
$(document).ready(function(){
	$("#dell").click(function(){
		delregion();
	});
});

function delregion(){
	if (!document.getElementById("CheckItem1").value){
		alert('请选择安检项目！');
		return false
	}else{
		if(!confirm("确定要删除该数据吗？")){
			return false;
		}else{
		//	alert($("#CheckItem1").val());
		//	alert($("#CheckContent1").val());
			jQuery.get(
					'tms_v1_safecheck_delcheckitem.php',
					{'op': 'del', 'CheckItem': $("#CheckItem1").val(), 'CheckContent': $("#CheckContent1").val(),'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if( objData.sucess=='1'){
							alert('删除成功！');
							document.form1.submit();
						}else{
						//	alert(objData.error);
							alert('删除失败！');
						}
				});
		}
	}
}
$(document).ready(function(){
	$("#table1").tablesorter();
	$("#table1 tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
	$("#table1 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
	$("#table1 tr").click(function(){
		$("#table1 tr:not(this)").css("background-color","#CCCCCC");
		$("#table1 tr:not(this)").mouseover(function(){$(this).css("background-color","#F1E6C2");});
		$("#table1 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
		$(this).css("background-color","#FFCC00");
		$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
		$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
		$("#CheckItem1").val($(this).children().eq(0).text());
		$("#CheckContent1").val($(this).children().eq(1).text());
	});
});
-->
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<link href="../css/tms.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="tms_v1_safecheck_addcheckitem.php">添加安检项目</a></li>   
        <li><a href="#" onclick="modregion()">修改安检项目</a></li>   
        <li><a href="#" id="dell">删除安检项目</a></li>     
    </ul>   
</div> 
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">安 检 项 目 内 容 查 询</span></td>
  </tr>
</table>
<form method="post" name="form1" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1" style="margin-top:-20px;">
 <tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />安检项目：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">
    	<select name="CheckItem">
      			<?php 
      			if($CheckItem==""){
      			?>
      			<option value="" selected="selected">请选择安检项目</option>
      			<?php }else{
      			?>
      			<option value="<?php echo $CheckItem;?>" selected="selected"><?php echo $CheckItem;?></option>
      			<?php }
      			if($CheckItem != ""){
				?>
				<option value="" >请选择安检项目</option>
				<?php
					}
    			//	$i=0;
    			//	$Checkitem="";
					$selected="SELECT ci_CheckItem FROM tms_sf_CheckItem GROUP BY ci_CheckItem";
					$queryed=$class_mysql_default->my_query($selected);
					while($rowed=mysql_fetch_array($queryed)){
						if($Checkitem!=$rowed['ci_CheckItem']){
				?>
				<option value="<?php echo $rowed['ci_CheckItem'];?>"><?php echo $rowed['ci_CheckItem'];?></option><!--
   				 <th nowrap="nowrap" align="center" bgcolor="#006699"><?php echo $rowed['ci_CheckItem'];?></th>
    			--><?php 
						}
    			//	$Checkitem=$rowed['ci_CheckItem'];
    		//		$i=$i+1;
					}
    			?>
<!--      			<option value="转向">转向</option>-->
<!--      			<option value="制动">制动</option>-->
<!--      			<option value="传动">传动</option>-->
<!--      			<option value="灯光电器">灯光电器</option>-->
<!--      			<option value="轮胎">轮胎</option>-->
<!--      			<option value="悬挂">悬挂</option>-->
<!--      			<option value="车身">车身</option>-->
<!--      			<option value="安全设施">安全设施</option>-->
<!--      			<option value="GPS">GPS</option>-->
<!--      			<option value="其他设施">其他设施</option>-->
     	 	</select>
    </td>
    <td align="left" nowrap="nowrap" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="查询项目" onclick="document.form1.submit()">
    	&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="添加项目" onclick="addregion()">
    	&nbsp;&nbsp;&nbsp;<input name="button3" type="button" value="修改项目" onclick="modregion()">
    	&nbsp;&nbsp;&nbsp;<input name="button4" id="del" type="button" value="删除项目" >
    	&nbsp;&nbsp;&nbsp;<input type="submit" name="exceldoc" id="exceldoc" value="导出Excel" />
    </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">项目总数：<?php if($rows['number']=='') echo '0'; else echo $rows['number'];?></td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
  <tr>
    <th nowrap="nowrap" align="center" bgcolor="#006699">安检项目</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">检验内容</th>
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
//		if(isset($_POST['CheckItem'])) {
			$sql = "SELECT ci_CheckItem,ci_CheckContent,ci_AdderID,ci_Adder,ci_Addertime,ci_ModerID,ci_Moder,ci_Modertime,
				ci_Remark FROM `tms_sf_CheckItem` WHERE ci_CheckItem LIKE '$CheckItem%'";
			$query =$class_mysql_default->my_query($sql);
			while ($row = mysql_fetch_array($query)) {
	?> 
	<tr id="tr"  bgcolor="#CCCCCC">
		<td align="center" nowrap="nowrap"><?php echo $row['ci_CheckItem'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['ci_CheckContent'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['ci_AdderID'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['ci_Adder'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['ci_Addertime'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['ci_ModerID'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['ci_Moder'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['ci_Modertime'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['ci_Remark'];?></td>
	</tr> 
	<?php 
			}
//		}
	?> 
	<tr>
		<td>
			<input type="hidden" id="CheckItem1" value=""/>
			<input type="hidden" id="CheckContent1" value=""/>
		</td>
	</tr>      
			</tbody>
		</table>
		</div>
		</form>
	</body>
</html>
