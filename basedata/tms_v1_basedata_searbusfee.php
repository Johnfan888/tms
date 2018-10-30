<?php
//车辆收费项目查询界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
//	if(isset($_POST['BusID'])) {
		$RegionCode2=$_POST['RegionCode2'];
		$BusID = $_POST['BusID'];
		$BusNumber = $_POST['BusNumber'];
		$BusUnit = $_POST['BusUnit'];
		$sql1 = "SELECT COUNT(br_BusID) AS number FROM `tms_acct_BusRate` WHERE br_BusID like '$BusID%' AND 
			br_BusNumber like '$BusNumber%' AND br_BusUnit like '$BusUnit%'";
		$query1 = $class_mysql_default->my_query($sql1);
		$rows = mysqli_fetch_array($query1);
//	}
	  if($RegionCode2 == 'excel'){
	  	//获取收费类型
	  	global $FeeTypeName;
	  	global $i;
    	$i=0;
		  $file_name = "searbusfee.csv";
		  header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		  header("Content-Disposition: attachment; filename=$file_name");
		  header("Cache-Control: no-cache, must-revalidate");
		  $fp = fopen('php://output', 'w'); //打开php文件句柄
		  $out = array('', '', '', '', '', '','','', '车辆收费项目', '', '', '', '', '', '', '', '');
		  fputcsv($fp, $out);
		 // $head = array('车辆编号', '车牌号', '车型', '车属单位', '所属车站编号', '所属车站', '经营线路', $FeeTypeName , '添加者编号',  '添加者', '添加日期', '修改者编号', '修改者', '修改时间');
			$head = array('车辆编号', '车牌号', '车型', '车属单位', '所属车站编号', '所属车站', '经营线路');
		  $selected="SELECT ft_FeeTypeName,ft_FeeTypeComputer FROM tms_bd_FeeType";
		  global $z;
		  $z=7;
		  $queryed=$class_mysql_default->my_query($selected);
		  while($rowed=mysqli_fetch_array($queryed)){
			if($rowed['ft_FeeTypeComputer']=="按百分比收费"){
			   $FeeTypeName1 = $rowed['ft_FeeTypeName'].'(%)';	
    		$i=$i+1;
			}
			else if($rowed['ft_FeeTypeComputer']=="固定金额收费"){
			$FeeTypeName1 = $rowed['ft_FeeTypeName'].'(元)';
    		$i=$i+1;
			}
			else {
	 		$FeeTypeName1=$rowed['ft_FeeTypeName'];
    		$i=$i+1;
			}
			$z=$z+$i;
			$head[$z] = $FeeTypeName1;
		}	
			$head[$z+1] = '添加者编号';
			$head[$z+2] = '添加者';
			$head[$z+3] = '添加日期';
			$head[$z+4] = '修改者编号';
			$head[$z+5] = '修改者';
			$head[$z+6] = '修改时间';
		  fputcsv($fp, $head);
		  $cnt = 0; //计数器
		  $limit = 100000; //每隔100000行，刷新输出buffer
		  $outputRow = "";
		  $queryString = "SELECT * FROM `tms_acct_BusRate` WHERE br_BusID like '$BusID%' AND br_BusNumber like '$BusNumber%' AND 
						  br_BusUnit like '$BusUnit%'";
		  $result = $class_mysql_default->my_query("$queryString");
		  while ($row = mysqli_fetch_array($result)) {
		  	global $j;
		  	global $rate;
		  	$rate=7;
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			}
			$outputRow = array($row['br_BusID'], $row['br_BusNumber'], $row['br_BusType'], $row['br_BusUnit'], $row['br_InStationID'], 
        				       $row['br_InStation'], $row['br_LineName']);
        				
		   for($j=0;$j<=$i-1;$j++){
		   	   $rate=$rate+1;
               $rate1=$row[7+$j];
           	   $outputRow[$rate] = $rate1;
			}
			 $outputRow[$rate+1]= $row['br_AdderID'];
			 $outputRow[$rate+2]= $row['br_Adder'];
			 $outputRow[$rate+3]= $row['br_AddTime'];
			 $outputRow[$rate+4]= $row['br_ModerID'];
			 $outputRow[$rate+5]= $row['br_Moder'];
			 $outputRow[$rate+6]= $row['br_ModTime'];
		/*	$outputRow = array($row['br_BusID'], $row['br_BusNumber'], $row['br_BusType'], $row['br_BusUnit'], $row['br_InStationID'], 
        				       $row['br_InStation'], $row['br_LineName'], $rate, $row['br_AdderID'], $row['br_Adder'], $row['br_AddTime'], 
        				       $row['br_ModerID'], $row['br_Moder'], $row['br_ModTime']); */
        				       
				fputcsv($fp, $outputRow); 
		  		$rate = '';
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
function addregion(){
	window.location.href='tms_v1_basedata_addbusfee.php';
}
function modregion(){
	if (!document.getElementById("BusID1").value){
		alert('请选择车辆！');
		return false;
	}else{
		window.location.href='tms_v1_basedata_modbusfee.php?op=mod&clnumber='+document.getElementById("BusID1").value;
		}
}
$(document).ready(function(){
	$("#del").click(function(){
		delregion();
	});
});
$(document).ready(function(){
	$("#table1").tablesorter();
});
$(document).ready(function(){
	$("#dell").click(function(){
		delregion();
	});
});

function delregion(){
	if (!document.getElementById("BusID1").value){
		alert('请选择车辆！')
		return false
	}else{
		if(!confirm("确定要删除该车辆吗？")){
			return false;
		}else{
			var BusID = $("#BusID1").val();
			jQuery.get(
					'tms_v1_basedata_delbusfee.php',
					{'op': 'del', 'BusID': BusID, 'time': Math.random()},
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
    <span class="graytext" style="margin-left:8px;">车 辆 收 费 项 目  查 询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="tms_v1_basedata_addbusfee.php">添加</a></li>   
        <li><a href="#" onclick="modregion()">修改</a></li>   
        <li><a href="#" id="dell">删除</a></li>     
    </ul>   
</div>   
<form method="post" name="form1" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车辆编号：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="BusID" value="<?php echo $BusID;?>" /></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车牌号：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="BusNumber" value="<?php echo $BusNumber;?>" /></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车属单位：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">
        		<select name="BusUnit">
    			<option value="<?php echo $BusUnit;?>"><?php echo $BusUnit;?></option>
    			<option></option>
    			<?php
    				$select="SELECT bu_UnitName FROM tms_bd_BusUnit";
    				$sel =$class_mysql_default->my_query($select);
					while($results=mysqli_fetch_array($sel)){ 
							if($BusUnit!=$results['bu_UnitName']){
    			?>
    			<option value="<?php echo $results['bu_UnitName'];?>"><?php echo $results['bu_UnitName'];?></option>
    			<?php 
							}
					}
    			?>
    		</select></td>
  </tr>
  <tr>
  <td align="left" nowrap="nowrap" bgcolor="#FFFFFF" colspan="5">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="查询" id='button1'>
    	&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="添加" onclick="addregion()">
    	&nbsp;&nbsp;&nbsp;<input name="button3" type="button" value="修改" onclick="modregion()">
    	&nbsp;&nbsp;&nbsp;<input name="button4" id="del" type="button" value="删除" >
    	&nbsp;&nbsp;&nbsp;<input name="exceldoc" id="exceldoc" type="button" value="导出Excel">	
    </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">收费车辆总数：<?php if($rows['number']=='') echo '0'; else echo $rows['number'];?></td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
  <tr>
  	<th nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车型</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车属单位</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">所属车站编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">所属车站</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">经营线路</th>
    <?php 
    	$i=0;
		$selected="SELECT ft_FeeTypeName,ft_FeeTypeComputer FROM tms_bd_FeeType";
		$queryed=$class_mysql_default->my_query($selected);
		while($rowed=mysqli_fetch_array($queryed)){
			if($rowed['ft_FeeTypeComputer']=="按百分比收费"){
    ?>
    <th nowrap="nowrap" align="center" bgcolor="#006699"><?php echo $rowed['ft_FeeTypeName'].'(%)';?></th>
    <?php 
    		$i=$i+1;
			}
			else if($rowed['ft_FeeTypeComputer']=="固定金额收费"){
	?>
    <th nowrap="nowrap" align="center" bgcolor="#006699"><?php echo $rowed['ft_FeeTypeName'].'(元)';?></th>
    <?php 
    		$i=$i+1;
			}
			else {
	?>
    <th nowrap="nowrap" align="center" bgcolor="#006699"><?php echo $rowed['ft_FeeTypeName'];?></th>
    <?php 
    		$i=$i+1;
			}
		}
    ?>
 <!--  
    <td nowrap="nowrap" align="center" bgcolor="#006699">开始日期</td>
    <td nowrap="nowrap" align="center" bgcolor="#006699">结束日期</td>
-->
    <th nowrap="nowrap" align="center" bgcolor="#006699">添加者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">添加者</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">添加日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">修改者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">修改者</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">修改时间</th>
  </tr>
    </thead> 
<tbody class="scrollContent">
	<?php
		if($RegionCode2 == '') {
			$sql = "SELECT * FROM `tms_acct_BusRate` WHERE br_BusID like '$BusID%' AND br_BusNumber like '$BusNumber%' AND 
				br_BusUnit like '$BusUnit%'";
			$query =$class_mysql_default->my_query($sql);
			while ($row = mysqli_fetch_array($query)) {
	?> 
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'BusID1')">
		<td align="center" nowrap="nowrap"><?php echo $row['br_BusID'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['br_BusNumber'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['br_BusType'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['br_BusUnit'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['br_InStationID'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['br_InStation'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['br_LineName'];?></td>
		<?php
			for($j=0;$j<=$i-1;$j++){
			//	$s=7+$j; 
		?>
		<td align="center"><?php echo $row[7+$j];?></td>
		<?php 
			}
		?>
<!-- 
		<td align="center" nowrap="nowrap"><?php echo $row['br_BeginDate'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['br_EndDate'];?></td>
 -->
		<td align="center" nowrap="nowrap"><?php echo $row['br_AdderID'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['br_Adder'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['br_AddTime'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['br_ModerID'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['br_Moder'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['br_ModTime'];?></td>
	</tr> 
	<?php 
			}
		}
	?> 
	<tr>
		<td><input type="hidden" id="BusID1" value=""/></td>
		<td><input type="hidden" id="RegionCode2" value="" name="RegionCode2"/></td>
	</tr>      
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>
