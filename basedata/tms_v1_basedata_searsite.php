<?
//站点界面
	//定义页面必须验证是否登录
	//define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	 $StationAdOrg = "";
	 $RegionCode2=$_POST['RegionCode2'];
//	if(isset($_POST['SiteName'])) {
		$siten=$_POST['SiteName'];
		$SiteType=$_POST['SiteType'];
		$HelpCode=$_POST['HelpCode'];
		$StationAdOrg=$_POST['StationAdOrg'];
		$sqls = "SELECT COUNT(sset_SiteID) AS number FROM tms_bd_SiteSet
		 		where IFNULL(sset_SiteName, '') like '%{$siten}%' and IFNULL(sset_SiteType, '') like '{$SiteType}%'and IFNULL(sset_HelpCode, '') like '{$HelpCode}%' 
		 		AND IFNULL(sset_StationAdOrg, '') like '%{$StationAdOrg}%'";
		$querys =$class_mysql_default->my_query($sqls);
		$rows =mysqli_fetch_array($querys);
//	}
		if($RegionCode2 == 'excel'){
		  $file_name = "searsite.csv";
		  header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		  header("Content-Disposition: attachment; filename=$file_name");
		  header("Cache-Control: no-cache, must-revalidate");
		  $fp = fopen('php://output', 'w'); //打开php文件句柄
		  $out = array('', '', '', '', '', '','','', '站点管理信息表', '', '', '', '', '', '', '', '');
		  fputcsv($fp, $out);
		  $head = array('序号','站点编号','站点名', '站点类型', '站点级别', '助记码', '操作码', '所属区域', '是否车站', '所属机构名称', '添加者编号', '添加者', '添加时间', '修改者编号', '修改者', '修改时间', '备注');
		  fputcsv($fp, $head);
		
		  $cnt = 0; //计数器
		  $limit = 100000; //每隔100000行，刷新输出buffer
		  $outputRow = "";
		  $queryString = "SELECT  sset_SiteID,sset_SiteName,sset_SiteType,sset_SiteRank,sset_HelpCode,sset_OperateCode,sset_Region,sset_IsStation,
				sset_StationAdOrg,sset_AdderID,sset_Adder,sset_AddTime,sset_ModerID,sset_Moder,sset_ModTime,sset_Remark FROM tms_bd_SiteSet
		 		where IFNULL(sset_SiteName, '') like '%{$siten}%' and IFNULL(sset_SiteType, '') like '{$SiteType}%'and IFNULL(sset_HelpCode, '') like '{$HelpCode}%' 
		 		AND IFNULL(sset_StationAdOrg, '') like '%{$StationAdOrg}%'";
		  $result = $class_mysql_default->my_query("$queryString");
		  $i=0;
		  while ($row = mysqli_fetch_array($result)) {
		  	$i++;
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
				}
			 if($row['sset_IsStation'] == "0"){
			 	$row['sset_IsStation'] = "否";
			 	}
			 	else{
			 	$row['sset_IsStation'] = "是";	
			 	}	
			$outputRow = array($i,$row['sset_SiteID'], $row['sset_SiteName'], $row['sset_SiteType'], $row['sset_SiteRank'], $row['sset_HelpCode'], 
        		$row['sset_OperateCode'], $row['sset_Region'], $row['sset_IsStation'], $row['sset_StationAdOrg'], $row['sset_AdderID'], $row['sset_Adder'],$row['sset_AddTime'], $row['sset_ModerID'], $row['sset_Moder'], $row['sset_ModTime'], $row['sset_Remark']); 
				fputcsv($fp, $outputRow); 
		    }
		    fclose($fp);
			exit(); 
		}			
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head> 
<title>CSS控制表格表头固定</title> 
<script type="text/javascript" src="./tms_v1_screen2.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="./tms_v1_rightclick.js"></script>
<script language="javascript">
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
function addsite(){
	window.location.href='tms_v1_basedata_addsite.php';
}
function modsite(){
	if (!document.getElementById("SiteID1").value){
		alert('请选择站点！')
		return false
	}else{
		window.location.href='tms_v1_basedata_modsite.php?op=mod&clnumber='+document.getElementById("SiteID1").value
		}
}

$(document).ready(function(){
	$("#del").click(function(){
		delsite()
	});
});
$(document).ready(function(){
	$("#dell").click(function(){
		delsite()
	});
});

function delsite(){
	if (!document.getElementById("SiteID1").value){
		alert('请选择站点！')
		return false
	}else{
		if(!confirm("删除除该站点数据会对以后的系统操作有影响，确定要删除该站点数据吗？")){
			return false;
		}else{
			var SiteID = $("#SiteID1").val();
			jQuery.get(
					'tms_v1_basedata_delsite.php',
					{'op': 'del', 'SiteID': SiteID, 'time': Math.random()},
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


$(document).ready(function(){
	$("#table1").tablesorter();
	$("#SiteName").focus();
	$("#SiteName").keyup(function(){
		document.getElementById("SiteNam").style.display="none";
		$("#SiteNam").empty();
		document.getElementById("SiteNam").style.display="";
		var Site = $("#SiteName").val();
		jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'getsite', 'Site': Site, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				for (var i = 0; i < objData.length; i++) {
					$("<option value = " + objData[i].SiteName + ">" + objData[i].SiteName + "</option>").appendTo($("#SiteNam"));
				}
				if(Site==''){
					document.getElementById("SiteNam").style.display="none";
				}
		});	
	});
});

</script>
<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<link href="../css/tms.css" rel="stylesheet" type="text/css">
</head> 
<body> 
<table width="100%" align="center"  border="1" cellpadding="3" cellspacing="1" class="main_tableboder">
  <tr>
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">站 点 查 询</span></td>
  </tr>
</table>
<div  id="menu" style="display: none">   
	<ul>   
		<li><a href="#" onclick="addsite()">添加站点</a></li>   
        <li><a href="#" onclick="modsite()">修改站点</a></li>   
        <li><a href="#" id="dell">删除站点</a></li>     
    </ul>   
</div>   
<form method="post" name="form1" action="">
<table class="main_tableboder" width="100%" align="center" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td width="8%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点名：</span></td>
    <td width="8%"  nowrap="nowrap"  bgcolor="#FFFFFF">
    	<input type="text" id="SiteName" name="SiteName" value="<?php echo $siten;?>" />
    	 <br>
        <select id="SiteNam" name="SiteNam"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="form1.SiteName.value=this.value; this.style.display='none';"   >
		</select>
    </td>
    <td width="8%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点类型：</span></td>
    <td width="8%" bgcolor="#FFFFFF">
    	<select name="SiteType" >
    		<option value="<?php echo $SiteType;?>"><?php echo $SiteType;?></option>
    		<?php 
    			if($SiteType==''){
    				echo "<option value='普通站点'>普通站点</option>";
    				echo"<br>";
    				echo "<option value='车站'>车站</option>";
    			}
    			if ($SiteType=='普通站点'){
    				echo "<option></option>";
    				echo"<br>";
    				echo "<option value='车站'>车站</option>";
    			}
    			if ($SiteType=='车站'){
    				echo "<option></option>";
    				echo"<br>";
    				echo "<option value='普通站点'>普通站点</option>";
    			}
    		?>
      	</select>
     </td>
    <td width="8%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 助记码：</span></td>
    <td  width="8%" bgcolor="#FFFFFF"> <input type="text" name="HelpCode" value="<?php echo $HelpCode;?>"/></td>
    <td width="8%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属机构：</span></td>
    <td  width="8%" bgcolor="#FFFFFF"> 
    	<select name="StationAdOrg">
    			<?php 
    			if($StationAdOrg == ""){
    			?>
    			<option value="" selected="selected"> </option>
    			<?php 
    			
    			$select="SELECT ao_OrgName FROM tms_bd_AdOrg";
    				$query =$class_mysql_default->my_query($select);
					while ($row=mysqli_fetch_array($query)){
    			?>
    			<option value="<?php echo $row['ao_OrgName'];?>"><?php echo $row['ao_OrgName'];?></option>
    			<?php 
					}
    			}
					if($StationAdOrg != ""){
				?>
				<option value=""> </option>
				<?php 
				$select="SELECT ao_OrgName FROM tms_bd_AdOrg";
    				$query =$class_mysql_default->my_query($select);
					while ($row=mysqli_fetch_array($query)){
						if($StationAdOrg == $row['ao_OrgName']){
				?>
				<option value="<?php echo $row['ao_OrgName'];?>" selected="selected"><?php echo $row['ao_OrgName'];?></option>
				<?php 
					}
					if($StationAdOrg != $row['ao_OrgName']){	
				?>
				<option value="<?php echo $row['ao_OrgName'];?>"><?php echo $row['ao_OrgName'];?></option>
				<?php 
					}
				?>
    			<?php 
						}
					}
    			?>
     	</select>
    
   		</td>
  </tr>
  <tr>
    <td nowrap="nowrap"  colspan="7" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="站点查询" id="button1">
    	&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="添加站点" onclick="return addsite()">
    	&nbsp;&nbsp;&nbsp;<input name="button3" type="button" value="修改站点" onclick="return modsite()">
    	&nbsp;&nbsp;&nbsp;<input name="button4" id="del" type="button" value="删除站点" >
    	&nbsp;&nbsp;&nbsp;<input name="exceldoc" id="exceldoc" type="button" value="导出Excel" onclick="document.form1.submit()">	
    </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">站点总数：<?php if($rows['number']=='') echo '0'; else echo $rows['number'];?></td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader"> 
 
<tr> 
	<th nowrap="nowrap" align="center" bgcolor="#006699" >序号</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699" >站点编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699" >站点名</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699" >站点类型</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699" >站点级别</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699" >助记码</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699" >操作码</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699" >所属区域</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699" >是否车站</th> 
    <th nowrap="nowrap" align="center" bgcolor="#006699" >所属机构名称</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">添加者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699" >添加者</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699" >添加时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699" >修改者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699" >修改者</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699" >修改时间</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699" > 备注</th>
</tr> 
</thead> 
<tbody class="scrollContent"> 
<?php 
	if($RegionCode2 == '') {
		$i=0;
		$sql = "SELECT  sset_SiteID,sset_SiteName,sset_SiteType,sset_SiteRank,sset_OperateCode,sset_HelpCode,sset_IsStation,sset_Region,
				sset_StationAdOrg,sset_AdderID,sset_Adder,sset_AddTime,sset_ModerID,sset_Moder,sset_ModTime,sset_Remark FROM tms_bd_SiteSet
		 		where IFNULL(sset_SiteName, '') like '%{$siten}%' and IFNULL(sset_SiteType, '') like '{$SiteType}%'and IFNULL(sset_HelpCode, '') like '{$HelpCode}%' 
		 		AND IFNULL(sset_StationAdOrg, '') like '%{$StationAdOrg}%'";
		$query =$class_mysql_default->my_query($sql);
		while ($row =mysqli_fetch_array($query)) {	
			$i++;
	?>
			<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'SiteID1')">
				<td align="center" nowrap="nowrap" ><?php echo $i?></td>
				<td align="center" nowrap="nowrap" ><?php echo $row['sset_SiteID'];?></td>
				<td align="center" nowrap="nowrap" ><?php echo $row['sset_SiteName'];?></td>
				<td align="center" nowrap="nowrap" ><?php echo $row['sset_SiteType'];?></td>
				<td align="center" nowrap="nowrap" ><?php echo $row['sset_SiteRank'];?></td>
				<td align="center" nowrap="nowrap" ><?php echo $row['sset_HelpCode'];?></td>
				<td align="center" nowrap="nowrap" ><?php echo $row['sset_OperateCode'];?></td>
				<td align="center" nowrap="nowrap" ><?php echo $row['sset_Region'];?></td>
				<td align="center" nowrap="nowrap" ><?php if($row['sset_IsStation']==0)echo '否'; else echo '是';?></td>
<!-- 				
				<td align="center"><?php if($row['sset_IsTollSite']==0)echo '否'; else echo '是'; ?></td>
 -->
				<td align="center" nowrap="nowrap" ><?php echo $row['sset_StationAdOrg'];?></td>
				<td align="center" nowrap="nowrap" ><?php echo $row['sset_AdderID'];?></td>
				<td align="center" nowrap="nowrap" ><?php echo $row['sset_Adder'];?></td>
				<td align="center" nowrap="nowrap" ><?php echo $row['sset_AddTime'];?></td>
				<td align="center" nowrap="nowrap" ><?php echo $row['sset_ModerID'];?></td>
				<td align="center" nowrap="nowrap" ><?php echo $row['sset_Moder'];?></td>
				<td align="center" nowrap="nowrap" ><?php echo $row['sset_ModTime'];?></td>
				<td align="center" nowrap="nowrap" ><?php echo $row['sset_Remark'];?></td>
			</tr>
	<?php 
			}
		}
	
	?> 
	<tr>
		<td><input type="hidden" id="SiteID1" value=""/></td>
		<td><input type="hidden" id="RegionCode2" value="" name="RegionCode2"/></td>
	</tr>
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>