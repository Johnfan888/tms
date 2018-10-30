<?php
//保 险 产 品 名 称 查 询界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
//	if(isset($_POST['INSUREPRODUCTNAME'])) {
		$RegionCode2=$_POST['RegionCode2'];
		$INSUREPRODUCTNAME=$_POST['INSUREPRODUCTNAME'];
		$sql = "SELECT * FROM `tms_bd_InsureType` where it_InsureProductName like '%{$INSUREPRODUCTNAME}%'";
		$query =$class_mysql_default->my_query($sql);
		$row =mysqli_fetch_array($query);
//	}
	  if($RegionCode2 == 'excel'){
		  $file_name = "searinsuretype.csv";
		  header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		  header("Content-Disposition: attachment; filename=$file_name");
		  header("Cache-Control: no-cache, must-revalidate");
		  $fp = fopen('php://output', 'w'); //打开php文件句柄
		  $out = array('', '', '', '', '',  '保险产品信息表', '', '', '', '', '', '', '', '');
		  fputcsv($fp, $out);
		  $head = array('保险产品名称 ','生效时间', '保险费', '保险代码', '承保机构代码', '保障方案代码', '代理机构代码 ','单证识别码', '前缀','意外伤保险', '意外医疗保险');
		  fputcsv($fp, $head);
		
		  $cnt = 0; //计数器
		  $limit = 100000; //每隔100000行，刷新输出buffer
		  $outputRow = "";
		  $queryString = "SELECT it_InsureProductName, it_EffectiveDate,it_Price,it_RiskCode,it_MakeCode,it_RationType,
				   		  it_AgentCode,it_VisaCode,it_Perfix,it_AInsuranceValue,it_BInsuranceValue
				   		  FROM `tms_bd_InsureType` where it_InsureProductName like '%{$INSUREPRODUCTNAME}%'";
		  $result = $class_mysql_default->my_query("$queryString");
		  while ($row = mysqli_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
				}
				
			$outputRow = array($row['it_InsureProductName'], $row['it_EffectiveDate'], $row['it_Price'], $row['it_RiskCode'], $row['it_MakeCode'], 
        		$row['it_RationType'], $row['it_AgentCode'],  $row['it_VisaCode'], $row['it_Perfix'], $row['it_AInsuranceValue'], $row['it_BInsuranceValue']); 
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
function addinsuretype(){
	window.location.href='tms_v1_basedata_addinsuretype.php';
}
function modinsuretype(){
	if (!document.getElementById("INSUREPRODUCTNAME1").value){
		alert('请选择保险产品名称！');
		return false;
	}else{
		window.location.href='tms_v1_basedata_modinsuretype.php?op=mod&clnumber='+document.getElementById("INSUREPRODUCTNAME1").value;
		}
}
$(document).ready(function(){
	$("#table1").tablesorter();
});
$(document).ready(function(){
	$("#read").click(function(){
		jQuery.get(
				'tms_v1_basedata_getinsuretypedata.php',
				{'op': 'read', 'time': Math.random()},
				function (data){
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){
						alert(objData.retString);
					}else{
						document.getElementById("COMCODE").value=objData.COMCODE;
						document.getElementById("HANDLERCODE").value=objData.HANDLERCODE;
						document.getElementById("HANDLER1CODE").value=objData.HANDLER1CODE;
						document.getElementById("OPERATORCODE").value=objData.OPERATORCODE;
						document.getElementById("APPORVERCODE").value=objData.APPORVERCODE;
					}
				});
	});
});

$(document).ready(function(){
	$("#write").click(function(){
	//	if (!$("#COMCODE").val() || !$("#HANDLERCODE").val() || !$("#HANDLER1CODE").val() ||  !$("#OPERATORCODE").val() || !$("#APPORVERCODE").val()){
			jQuery.get(
					'tms_v1_basedata_getinsuretypedata.php',
					{'op': 'write', 'COMCODE': $("#COMCODE").val(), 'HANDLERCODE': $("#HANDLERCODE").val(), 'HANDLER1CODE': $("#HANDLER1CODE").val(),
						'OPERATORCODE': $("#OPERATORCODE").val(), 'APPORVERCODE': $("#APPORVERCODE").val(), 'time': Math.random()},
					function (data){
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL"){
							alert(objData.retString);
						}else{
							alert(objData.retString);
						}
					});
	//	}
	});
});

$(document).ready(function(){
	$("#del").click(function(){
		delinsuretype()
	});
});
$(document).ready(function(){
	$("#dell").click(function(){
		delinsuretype()
	});
});
function delinsuretype(){
	if (!document.getElementById("INSUREPRODUCTNAME1").value){
		alert('请选择保险产品名称！')
		return false
	}else{
		if(!confirm("确定要删除该保险产品吗？")){
			return false;
		}else{
			var INSUREPRODUCTNAME = $("#INSUREPRODUCTNAME1").val();
			jQuery.get(
					'tms_v1_basedata_delinsuretype.php',
					{'op': 'del', 'INSUREPRODUCTNAME': INSUREPRODUCTNAME, 'time': Math.random()},
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

</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">保 险 产 品 名 称 查 询</span></td>
  </tr>
</table>
<div id="menu" style="display:none">   
	<ul>   
		<li><a href="tms_v1_basedata_addinsuretype.php">添加</a></li>   
        <li><a href="#" onclick="modinsuretype()">修改</a></li> 
        <li><a href="#" id="dell">删除</a></li>  
    </ul>   
</div>
<form method="post" name="form1" action="tms_v1_basedata_searinsuretype.php">

<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1" style="margin-top:-20px;">
 <tr >
 	<td colspan="4"><span class="form_title">通用变量设置：</span></td>
 </tr>	
 <tr>
    <td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />归属机构代码：</span></td>
    <td bgcolor="#FFFFFF"><input type="text" name="COMCODE" id="COMCODE"/></td>
    <td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />默认经办人代码：</span></td>
    <td bgcolor="#FFFFFF"><input type="text" name="HANDLERCODE" id="HANDLERCODE"/></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />默认归属经办人：</span></td>
    <td bgcolor="#FFFFFF"><input type="text" name="HANDLER1CODE" id="HANDLER1CODE"/></td>
    <td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />操作人员代码：</span></td>
    <td bgcolor="#FFFFFF"><input type="text" name="OPERATORCODE" id="OPERATORCODE"/></td>
  </tr>
   <tr>
    <td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />复核人员代码：</span></td>
    <td bgcolor="#FFFFFF"><input type="text" name="APPORVERCODE" id="APPORVERCODE"/></td>
    <td align="left"  colspan="2" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;<input name="read" id="read" type="button" value="读取" >
    	&nbsp;&nbsp;&nbsp;<input name="write" id="write" type="button" value="保存" >
    </td>
  </tr>
</table>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td width="13%" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />保险产品名称：</span></td>
    <td width="13%" bgcolor="#FFFFFF"><input type="text" name="INSUREPRODUCTNAME" value="<?php echo $INSUREPRODUCTNAME;?>"/></td>
    <td align="center"  colspan="4" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="查询" id="button1">
    	&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="添加" onclick="addinsuretype()">
    	&nbsp;&nbsp;&nbsp;<input name="button3" type="button" value="修改" onclick="modinsuretype()">
    	&nbsp;&nbsp;&nbsp;<input name="button4" id="del" type="button" value="删除" >
    	&nbsp;&nbsp;&nbsp;<input name="exceldoc" id="exceldoc" type="button" value="导出Excel">
    </td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
  <tr>
    <th nowrap="nowrap" align="center" bgcolor="#006699">保险产品名称</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">生效时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">保险费</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">保险代码</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">承保机构代码</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">保障方案代码</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">代理机构代码</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">单证识别码</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">前缀</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">意外伤保险</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">意外医疗保险</th>
  </tr>
    </thead> 
<tbody class="scrollContent">
	<?php
	//	if(isset($_POST['INSUREPRODUCTNAME'])) {
		if($RegionCode2 == ''){
			$INSUREPRODUCTNAME= $_POST['INSUREPRODUCTNAME'];
			$sql = "SELECT it_InsureProductName, it_EffectiveDate,it_Price,it_RiskCode,it_MakeCode,it_RationType,
				   it_AgentCode,it_VisaCode,it_Perfix,it_AInsuranceValue,it_BInsuranceValue
				   FROM `tms_bd_InsureType` where it_InsureProductName like '%{$INSUREPRODUCTNAME}%'";
			$query =$class_mysql_default->my_query($sql);
			if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
			while ($row = mysqli_fetch_array($query)) {
	?> 
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'INSUREPRODUCTNAME1')">
		<td align="center"><?php echo $row['it_InsureProductName'];?></td>
		<td align="center"><?php echo $row['it_EffectiveDate'];?></td>
		<td align="center"><?php echo $row['it_Price'];?></td>
		<td align="center"><?php echo $row['it_RiskCode'];?></td>
		<td align="center"><?php echo $row['it_MakeCode'];?></td>
		<td align="center"><?php echo $row['it_RationType'];?></td>
		<td align="center"><?php echo $row['it_AgentCode'];?></td>
		<td align="center"><?php echo $row['it_VisaCode'];?></td>
		<td align="center"><?php echo $row['it_Perfix'];?></td>
		<td align="center"><?php echo $row['it_AInsuranceValue'];?></td>
		<td align="center"><?php echo $row['it_BInsuranceValue'];?></td>
	</tr> 
	<?php 
			}
		}
	?> 
	<tr><td>
	<input type="hidden" id="INSUREPRODUCTNAME1" value=""/>
	<input type="hidden" id="RegionCode2" value="" name="RegionCode2"/>
	</td></tr>      
</tbody> 
</table>
</div>

</form>
