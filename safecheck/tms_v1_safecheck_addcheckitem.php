<?php 
//添加安检项目内容
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
?>
<script type="text/javascript">
function adddo(){
	if(document.addpro.CheckItem.value == ""){
		alert("请选择安检项目!");
		return false;
	}
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
    <span class="graytext" style="margin-left:8px;">添 加 安 检 项 目 内 容 </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<form id="addpro" name="addpro" method="post" action="" >
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 安检项目：</span></td>
        <td bgcolor="#FFFFFF">
            	<select name="CheckItem">
      			<?php 
      			if($CheckItem==""){
      			?>
      			<option>请选择安检项目</option>
      			<?php }else{
      			?>
      			<option value="<?php echo $CheckItem;?>"><?php echo $CheckItem;?></option>
      			<?php }?>
      			<?php 
    				$Checkitem="";
					$selected="SELECT ci_CheckItem FROM tms_sf_CheckItem GROUP BY ci_CheckItem";
					$queryed=$class_mysql_default->my_query($selected);
					while($rowed=mysql_fetch_array($queryed)){
						if($Checkitem!=$rowed['ci_CheckItem']){
				?>
				<option value="<?php echo $rowed['ci_CheckItem'];?>"><?php echo $rowed['ci_CheckItem'];?></option>
				<?php 
						}
    				$Checkitem=$rowed['ci_CheckItem'];
					}
    			?>
     	 	</select><span style="color:red">*</span>
<!--        	<select name="CheckItem">-->
<!--      			<option>请选择安检项目</option>-->
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
<!--     	 	</select><span style="color:red">*</span>-->
     	 </td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 检验内容：</span></td>
		<td bgcolor="#FFFFFF"><input type="text" name="CheckContent" id="CheckContent" style="width:300"/><span style="color:red">*</span></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="40" rows="5"></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="additem" type="submit" value="添加" onclick="return adddo();" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="search();">&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>
<?php
	if(isset($_POST['additem'])){
		$CheckItem=$_POST['CheckItem'];
		$CheckContent=$_POST['CheckContent'];
		$Remark=$_POST['Remark'];
		$CurTime=date('Y-m-d H:i:s');
		$select="SELECT ci_CheckItem FROM tms_sf_CheckItem WHERE ci_CheckItem='{$CheckItem}' AND ci_CheckContent='{$CheckContent}'";
		$sele=$class_mysql_default->my_query($select);
		if(!mysql_fetch_array($sele)){
			$insert="INSERT INTO `tms_sf_CheckItem` (`ci_CheckItem`,`ci_CheckContent`,`ci_AdderID`,`ci_Adder`,`ci_Addertime`,`ci_Remark`) 
				VALUES ('{$CheckItem}', '{$CheckContent}','{$userID}','{$userName}','{$CurTime}','{$Remark}')";
			$query = $class_mysql_default->my_query($insert);
			if (!$query) echo "SQL错误：".mysql_error();
			if($query){
				echo"<script>alert('添加成功!')</script>";
			}else{
				echo"<script>alert('添加失败')</script>";
			}
		}else{
			echo"<script>alert('项目内容已存在，请重新输入！')</script>";
		} 
	} 

?>
