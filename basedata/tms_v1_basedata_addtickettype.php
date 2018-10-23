<?php 
//添加票据类型界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#TypeName").keyup(function(){
		var TypeName = document.getElementById("TypeName").value;
		jQuery.get(
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'addtickettype', 'TypeName': TypeName, 'time': Math.random()},
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
	if(document.addpro.TypeName.value == ""){
		alert("票据类型名不能为空!");
		return false;
	}
	var TypeName = document.getElementById("TypeName").value;
	jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'addtickettype', 'TypeName': TypeName, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if( objData.sucess=='1'){
					alert('票据类型名已存在，请重新输入！');
						return false;
				}
				else{
			 		document.addpro.submit();}
	});
}
function search(){
	window.location.href='tms_v1_basedata_seartickettype.php';
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 票 据 类 型  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<form id="addpro" name="addpro" method="post" action="" >
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 票据类型名：</span></td>
        <td bgcolor="#FFFFFF"><input type="text" name="TypeName" id="TypeName" /><span style="color:red">*</span><br><span style="color:red" style="display:none" id="code">票据类型名已存在，请重新输入！</span></td>
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
if(isset($_POST['TypeName'])) { 
	$TypeName=$_POST['TypeName'];
	$Remark=$_POST['Remark'];
	$CurTime=date('Y-m-d H:i:s');
	$select="select tt_ID from tms_bd_TicketType where tt_TypeName='{$TypeName}'";
	$sele=$class_mysql_default->my_query($select);
	if(!mysql_fetch_array($sele)){
		$insert="INSERT INTO `tms_bd_TicketType` (`tt_TypeName`,`tt_AdderID`,`tt_Adder`,`tt_AddTime`,`tt_Remark`) VALUES ('{$TypeName}', '{$userID}','{$userName}','{$CurTime}','{$Remark}')";
		$query = $class_mysql_default->my_query($insert);
	//	if (!$query) echo "SQL错误：".mysql_error();
		if($query){
			echo"<script>alert('添加成功!');window.location.href='tms_v1_basedata_addtickettype.php'</script>";
		}else{
			echo"<script>alert('添加失败');window.location.href='tms_v1_basedata_addtickettype.php'</script>";
		}
	}else{
		echo"<script>alert('票据类型名已存在，请重新输入！');window.location.href='tms_v1_basedata_addtickettype.php'</script>";
	}
}  
?>

