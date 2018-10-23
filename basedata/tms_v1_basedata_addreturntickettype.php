<?php 
//添加退票类型界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#ReturnType").keyup(function(){
		var ReturnType = document.getElementById("ReturnType").value;
		//alert(ReturnType);
		jQuery.get(
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'addreturntickettype', 'ReturnType': ReturnType, 'time': Math.random()},
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
function addd(){
	if(document.addpro.ReturnType.value == ""){
		alert("退票类型不能为空!");
		return false;
	}
	var ReturnType = document.getElementById("ReturnType").value;
	jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'addreturntickettype', 'ReturnType': ReturnType, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if( objData.sucess=='1'){
					alert('退票类型已存在，请重新输入！');
						return false;
				}
				else{
			 		document.addpro.submit();}
	});
}
function isnumber(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value='';
		return false;
		}
	if(document.getElementById(id).value*1>1.0){
		alert("退票手续费率不能大于1！请重新输入。");
		document.getElementById(id).value='';
		return false;
		}
}
function search(){
	window.location.href='tms_v1_basedata_searreturntickettype.php';
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 退 票 类 型  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<form id="addpro" name="addpro" method="post" action="tms_v1_basedata_addreturntickettypeok.php?op=add" >
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 退票类型：</span></td>
        <td bgcolor="#FFFFFF"><input type="text" name="ReturnType" id="ReturnType" /><br><span style="color:red" style="display:none" id="code">退票类型已存在，请重新输入！</span></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 退票手续费率：</span></td>
		<td bgcolor="#FFFFFF"><input type="text" name="ReturnRate" id="ReturnRate" onkeyup="return isnumber(this.value,this.id)"/><span style="color:red"><br>*退票手续费率为小数</span></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 退票时间开始：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="ReturnTimeBegin" id="ReturnTimeBegin" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 退票时间结束：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="ReturnTimeEnd" id="ReturnTimeEnd" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="button1" type="button" value="添加" onclick="return addd();" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="search();">&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>
