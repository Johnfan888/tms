<?php 
//修改安检项目内容
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber1=$_GET['clnumber1'];
	$clnumber2=$_GET['clnumber2'];
	$selects="SELECT ci_CheckItem, ci_CheckContent,ci_Remark FROM tms_sf_CheckItem WHERE ci_CheckItem='{$clnumber1}' AND ci_CheckContent='{$clnumber2}'";
	$querys=$class_mysql_default->my_query($selects);
	$rows=mysqli_fetch_array($querys);
?>
<script type="text/javascript">
function adddo(){
	if(document.addpro.CheckContent.value == ""){
		alert("检验内容不能为空!");
		return false;
	}
}
function search(){
	window.location.href='tms_v1_safecheck_searcheckitem.php';
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">修 改 安 检 项 目 内 容 </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<form id="addpro" name="addpro" method="post" action="" >
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 安检项目：</span></td>
        <td bgcolor="#FFFFFF"> <input type="text" name="CheckItem" id="CheckItem" readonly="readonly" value="<?php echo $rows['ci_CheckItem'];?>"/></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 检验内容：</span></td>
		<td bgcolor="#FFFFFF"><input type="hidden" name="CheckContent1" id="CheckContent1" value="<?php echo $rows['ci_CheckContent'];?>"/>
			<input type="text" name="CheckContent" id="CheckContent" value="<?php echo $rows['ci_CheckContent'];?>" style="width:300"/><span style="color:red">*</span></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="40" rows="5"><?php echo $rows['ci_Remark'];?></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="additem" type="submit" value="修改" onclick="return adddo();" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="search();">&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>
<?php
	if(isset($_POST['additem'])){
		$CheckItem=$_POST['CheckItem'];
		$CheckContent=$_POST['CheckContent'];
		$CheckContent1=$_POST['CheckContent1'];
		$Remark=$_POST['Remark'];
		$CurTime=date('Y-m-d H:i:s');
		$select="SELECT ci_CheckItem,ci_CheckContent FROM tms_sf_CheckItem WHERE ci_CheckItem='{$CheckItem}' AND ci_CheckContent='{$CheckContent}'";
		$sele=$class_mysql_default->my_query($select);
		$result=mysqli_fetch_array($sele);
		if($result==false || $CheckContent==$CheckContent1){
			$insert="UPDATE `tms_sf_CheckItem` SET  ci_CheckContent='{$CheckItem}',ci_CheckContent='{$CheckContent}',ci_ModerID='{$userID}',ci_Moder='{$userName}', 
				ci_Modertime='{$CurTime}',ci_Remark='{$Remark}' WHERE ci_CheckItem='{$CheckItem}' AND ci_CheckContent='{$CheckContent1}'";
			$query = $class_mysql_default->my_query($insert);
			if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
			if($query){
				echo"<script>alert('修改成功！'); window.location.href='tms_v1_safecheck_modcheckitem.php?op=mod&clnumber1=$CheckItem&clnumber2=$CheckContent'</script>";
			}else{
				echo"<script>alert('修改失败！'); window.location.href='tms_v1_safecheck_modcheckitem.php?op=mod&clnumber1=$CheckItem&clnumber2=$CheckContent1'</script>";
			}
		}else{
			echo"<script>alert('项目内容已存在，请重新输入！'); window.location.href='tms_v1_safecheck_modcheckitem.php?op=mod&clnumber1=$CheckItem&clnumber2=$CheckContent1'</script>";
		} 
	} 

?>

