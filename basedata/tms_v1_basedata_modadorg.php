<?php 
//修改机构界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber = $_GET['clnumber'];
	$sql = "select * FROM `tms_bd_AdOrg` WHERE ao_ID='{$clnumber}'";
	$query =$class_mysql_default->my_query($sql);
	$result=mysql_fetch_array($query);
?>
<script type="text/javascript">
function adddo(){
	if(document.addpro.OrgName.value == ""){
		alert("机构名称不能为空!");
		return false;
	}
	if(document.addpro.HelpCode.value == ""){
		alert("助记码不能为空!");
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
    <span class="graytext" style="margin-left:8px;">修 改 机 构  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<form id="addpro" name="addpro" method="post" action="">
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 机构编码:</span></td>
        <td bgcolor="#FFFFFF"><input name="ID" type="hidden" value="<?php echo $clnumber;?>" />
        		<input type="text" name="OrgCode" id="OrgCode" value="<?php echo $result['ao_OrgCode'];?>"/></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属机构名称：</span></td>
		<td bgcolor="#FFFFFF"><input type="hidden" name="OrgName1" id="OrgName1" value="<?php echo $result['ao_OrgName'];?>"/>
			<input type="text" name="OrgName" id="OrgName" value="<?php echo $result['ao_OrgName'];?>"/><span style="color:red">*</span></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 助记码 ：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="HelpCode" id="HelpCode" value="<?php echo $result['ao_HelpCode'];?>"/><span style="color:red">*</span></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"><?php echo $result['ao_Remark'];?></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center"bgcolor="#FFFFFF"><input name="submit1" type="submit" value="修改" onclick="return adddo();" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="search();">&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>
<?php 
if(isset($_POST['submit1'])){
	$ID=$_POST['ID'];
	$OrgCode = $_POST['OrgCode'];
	$OrgName1 = $_POST['OrgName1'];
	$OrgName = $_POST['OrgName'];
	$HelpCode=$_POST['HelpCode'];
	$Remark=$_POST['Remark'];
	$CurTime=date('Y-m-d H:i:s');
	$select="select * from tms_bd_AdOrg where ao_OrgCode='{$OrgCode}'";
	$sele= $class_mysql_default->my_query($select);
	$results=mysql_fetch_array($sele);
	if($results==false|| $ID==$results['ao_ID']){
		$update="update tms_bd_AdOrg set ao_OrgCode='{$OrgCode}', ao_OrgName='{$OrgName}', ao_HelpCode='{$HelpCode}', 
			ao_ModerID='{$userID}', ao_Moder='{$userName}', ao_ModTime='{$CurTime}', ao_Remark='{$Remark}' where ao_ID='{$ID}'";
		$query =$class_mysql_default->my_query($update);
		if($query){
			echo"<script>alert('修改成功！');window.location.href='tms_v1_basedata_modadorg.php?clnumber=$ID'</script>";
					}
		else{
			echo"<script>alert('修改失败！');window.location.href='tms_v1_basedata_modadorg.php?clnumber=$ID'</script>";
			}
					  }
	
	
}
?>


