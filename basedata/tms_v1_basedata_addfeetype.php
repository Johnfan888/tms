<?php 
//添加收费类型界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber = $_GET['clnumber'];
	$num = $_GET['num'];
	if($clnumber==''){
		$clnumber=1;
	}
	else{
		$clnumber=$clnumber+1;
	}
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#FeeTypeName").keyup(function(){
		var FeeTypeName = document.getElementById("FeeTypeName").value;
		jQuery.get( 
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'addfeetype', 'FeeTypeName': FeeTypeName, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if( objData.sucess=='1'){
						document.getElementById('code').style.display="";
					}
					else{
						document.getElementById('code').style.display="none";
					}
		});
	});	
});
function adddo(){
	if(document.addpro.FeeTypeName.value == ""){
		alert("收费类型名称不能为空!");
		return false;
	}
	if(document.addpro.FeeTypeComputer.value == ""){
		alert("收费类型计算方式不能为空!");
		return false;
	}
	var FeeTypeName = document.getElementById("FeeTypeName").value;
			jQuery.get( 
					'tms_v1_bsaedata_dataProcess.php',
					{'op': 'addfeetype', 'FeeTypeName': FeeTypeName, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if( objData.sucess=='1'){
							alert('收费类型已存在，请重新输入！');
								return false;
						}
						else{
					 		document.addpro.submit();}
			});
}
function search(){
	window.location.href='tms_v1_basedata_searfeetype.php';
}
function selectFeeType(str){
	if(str=='按百分比收费'){
		document.getElementById("percent").style.display='';
	}else{
		document.getElementById("percent").style.display='none';
		document.getElementById("Feepercent").value='';
	}
	if(str=='固定金额收费'){
		document.getElementById("fix").style.display='';
	}else{
		document.getElementById("fix").style.display='none';
		document.getElementById("Feefix").value='';
	}
}
function isnum(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value="";
		return false;
		}
	if(number>100){
		alert("收费百分比不能超过100%");
		document.getElementById(id).value="";
		return false;
		}
}
function isnumber(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value="";
		return false;
		}
}
function getvalue(ID,str){
	if(document.getElementById(ID).checked){
		document.getElementById(str).value=1;
	}else{
		document.getElementById(str).value=0;
	}	
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 收 费 类 型  </span></td>
  </tr>
</table>
<?php
//连接数据库，获取班次信息
?>
<form id="addpro" name="addpro" method="post" action="tms_v1_basedata_addfeetypeok.php" >
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />收费类型名称：</span></td>
        <td bgcolor="#FFFFFF"><input type="hidden" name="num" id="num" value="<?php if($num=='') echo $clnumber; else echo $num;?>"/>
        <input type="text" name="FeeTypeName" id="FeeTypeName" /><span style="color:red">*</span><br><span style="color:red" style="display:none" id="code">收费类型已存在，请重新输入！</span></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收费类型计算方式：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="FeeTypeComputer" id="FeeTypeComputer" onchange="selectFeeType(this.value)">
    			<option></option>
    			<option value="按百分比收费">按百分比收费</option>
    			<option value="固定金额收费">固定金额收费</option>
    		</select>
		<span style="color:red">*</span></td>
	</tr>
	<tbody id="fix" style="DISPLAY: none">
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收费金额：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Feefix" id="Feefix" onkeyup="return isnumber(this.value,this.id)"/><span style="color:red">元</span></td>
	</tr>  
	<tr>
	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsDock0" id="IsDock0" value="1"/></td>
	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="checkbox" name="IsDoc0" id="IsDoc0" checked="checked" onclick="getvalue(this.id,'IsDock0')"/>是否同步将此费用添加到车辆收费项目</td>
	</tr>
	</tbody>
	<tbody id="percent" style="DISPLAY: none">
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收费百分比：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Feepercent" id="Feepercent" onkeyup="return isnum(this.value,this.id)"/><span style="color:red">%</span></td>
	</tr>  
	<tr>
	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsDock" id="IsDock" value="1"/></td>
	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="checkbox" name="IsDoc" id="IsDoc" checked="checked" onclick="getvalue(this.id,'IsDock')"/>是否同步将此费用添加到车辆收费项目</td>
	</tr>
	</tbody>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 助记码：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="HelpCode" id="HelpCode" /></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="button1" type="button" value="添加" onclick="return adddo();" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="search();">&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>


