<?php 
//添加车属单位界面
	//定义页面必须验证是否登录
//	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#UnitName").keyup(function(){
		var UnitName = document.getElementById("UnitName").value;
		jQuery.get( 
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'addbusunit', 'UnitName': UnitName, 'time': Math.random()},
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
	if(document.addunit.UnitName.value == ""){
		alert("车属单位名称不能为空!");
		return false;
	}
	var UnitName = document.getElementById("UnitName").value;
	jQuery.get( //查看驾驶员编号是否唯一
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'addbusunit', 'UnitName': UnitName, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if( objData.sucess=='1'){
					alert('车属单位已存在，请重新输入');
						return false;
				}
				else{
			 		document.addunit.submit();}
	});
}
function search(){
	window.location.href='tms_v1_basedata_searbusunit.php';
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 车 属 单 位  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<form id="addunit" name="addunit" method="post" action="" >
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车属单位名称：</span></td>
		<td bgcolor="#FFFFFF"><input type="text" name="UnitName" id="UnitName" /><span style="color:red">*</span><br><span style="color:red" style="display:none" id="code">&nbsp;车属单位已存在,请重新输入！</span></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />单位性质：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="UnitProperty" id="UnitProperty" /></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />联系人：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="UnitContacts" id="UnitContacts" /></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />联系电话：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="UnitPhone" id="UnitPhone" /></td>
	</tr>  
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />单位地址：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="UnitAdress" id="UnitAdress" style="width:200px;"/></td>
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
<?php 
	if(isset($_POST['UnitName'])){
		$UnitName=$_POST['UnitName'];
		$UnitProperty=$_POST['UnitProperty'];
		$UnitContacts=$_POST['UnitContacts'];
		$UnitPhone=$_POST['UnitPhone'];
		$UnitAdress=$_POST['UnitAdress'];
		$Remark=$_POST['Remark'];
		$select="select bu_UnitName from tms_bd_BusUnit where bu_UnitName='{$UnitName}'";
		$sele=$class_mysql_default->my_query($select);
		if(!mysqli_fetch_array($sele)){
			$insert="INSERT INTO `tms_bd_BusUnit` (`bu_UnitName`,`bu_UnitProperty`,`bu_UnitContacts`,`bu_UnitPhone`,`bu_UnitAdress`,
				`bu_Remark` ) VALUES ('{$UnitName}', '{$UnitProperty}', '{$UnitContacts}','{$UnitPhone}','{$UnitAdress}','{$Remark}');";
			$query = $class_mysql_default->my_query($insert);
			if($query){
				echo"<script>alert('恭喜您！添加成功!');</script>";
			}else{
				echo"<script>alert('添加失败');</script>";
			}
		}else{
			echo"<script>alert('车属单位已存在，请重新输入！');</script>";
		}
	}
?>
