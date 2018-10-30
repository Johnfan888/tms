<?php 
//添加区域界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
?>
<script type="text/javascript">
function adddo(){
	if(document.addpro.RegionCode.value == ""){
		alert("区域编码不能为空!");
		return false;
	}
	if(document.addpro.RegionName.value == ""){
		alert("区域名称不能为空!");
		return false;
	}
	if(document.addpro.HelpCode.value == ""){
		alert("助记码不能为空!");
		return false;
	}
}
function search(){
	window.location.href='tms_v1_basedata_searregion.php';
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 区 域  </span></td>
  </tr>
</table>
<?php
//连接数据库，获取班次信息
?>
<form id="addpro" name="addpro" method="post" action="tms_v1_basedata_addregionok.php?op=add" >
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 区域编码：</span></td>
        <td bgcolor="#FFFFFF"><input type="text" name="RegionCode" id="RegionCode" /><span style="color:red">*</span></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 区域名称：</span></td>
		<td bgcolor="#FFFFFF"><input type="text" name="RegionName" id="RegionName" /><span style="color:red">*</span></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 区域全称：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="RegionFullName" id="RegionFullName" /></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 助记码：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="HelpCode" id="HelpCode" /><span style="color:red">*</span></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="submit" type="submit" value="添加" onclick="return adddo();" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="search();">&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>

