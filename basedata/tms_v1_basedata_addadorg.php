<?php 
//添加所属机构界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
?>
<script type="text/javascript">
function adddo(){
	if(document.addpro.OrgName.value == ""){
		alert("所属机构名称不能为空!");
		return false;
	}
	if(document.addpro.OrgCode.value == ""){
		alert("机构编码名称不能为空!");
		return false;
		}
}
function search(){
	window.location.href='tms_v1_basedata_searadorg.php';
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 所 属 机 构  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<form id="addpro" name="addpro" method="post" action="" >
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />所属机构编码：</span></td>
        <td bgcolor="#FFFFFF"><input type="text" name="OrgCode" id="OrgCode" /><span style="color:red">*</span></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属机构名称：</span></td>
		<td bgcolor="#FFFFFF"><input type="text" name="OrgName" id="OrgName" /><span style="color:red">*</span></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 助记码：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="HelpCode" id="HelpCode" /></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="submit1" type="submit" value="添加" onclick="return adddo();" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="search();">&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>
<?php
	if(isset($_POST['submit1'])){
		$OrgCode = $_POST['OrgCode'];
		$OrgName = $_POST['OrgName'];
		$HelpCode=$_POST['HelpCode'];
		$Remark=$_POST['Remark'];
		$CurTime=date('Y-m-d H:i:s');
		$select="select ao_OrgName from tms_bd_AdOrg where ao_OrgName='{$OrgName}'";
		$sele=$class_mysql_default->my_query($select);
		if(!mysqli_fetch_array($sele)){
			$insert="INSERT INTO `tms_bd_AdOrg` (`ao_OrgCode`,`ao_OrgName`,`ao_AdderID`,`ao_Adder`,`ao_AddTime`,`ao_HelpCode`,`ao_Remark`) VALUES 
				('{$OrgCode}', '{$OrgName}','{$userID}','{$userName}','{$CurTime}','{$HelpCode}','{$Remark}');";
			$query = $class_mysql_default->my_query($insert);
			if($query){
				echo"<script>alert('添加成功！')</script>";
			}else{
				echo"<script>alert('添加失败！')</script>";
			}
		}else{
			echo"<script>alert('机构已存在，请重新输入！')</script>";
		}
	}
?>

