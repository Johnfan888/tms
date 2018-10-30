<?php 
//修改票据类型界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber = $_GET['clnumber'];
	$sql = "select* FROM `tms_bd_TicketType` WHERE tt_ID='{$clnumber}'";
	$query =$class_mysql_default->my_query($sql);
	$result=mysqli_fetch_array($query);
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#TypeName").keyup(function(){
		var TypeName = document.getElementById("TypeName").value;
		var TypeNam = document.getElementById("TypeNam").value;
		if(TypeName != TypeNam){
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
		}
		else{
			document.getElementById('code').style.display="none"}
	});	
});
function adddo(){
	if(document.addpro.TypeName.value == ""){
		alert("票据类型名不能为空!");
		return false;
	}
	var TypeName = document.getElementById("TypeName").value;
	var TypeNam = document.getElementById("TypeNam").value;
	if(TypeName != TypeNam){
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
	else{
		document.addpro.submit();}
}
function search(){
	window.location.href='tms_v1_basedata_seartickettype.php';
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">修 改 票 据 类 型  </span></td>
  </tr>
</table>
<?php
//连接数据库，获取班次信息
?>
<form id="addpro" name="addpro" method="post" action="" >
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 票据类型名：</span></td>
        <td bgcolor="#FFFFFF"><input type="hidden" name="ID" id="ID" value="<?php echo $result['tt_ID'];?>" />
        	<input type="text" name="TypeName" id="TypeName" value="<?php echo $result['tt_TypeName'];?>" /><span style="color:red">*</span><br><span style="color:red" style="display:none" id="code">票据类型名已存在，请重新输入！</span>
			<input type="hidden" name="TypeNam" id="TypeNam" value="<?php echo $result['tt_TypeName'];?>" /></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"><?php echo $result['tt_Remark'];?></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="button1" type="button" value="修改" onclick="return adddo();" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="search();">&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>
<?php
if(isset($_POST['TypeName'])) { 
	$ID=$_POST['ID'];
	$TypeName=$_POST['TypeName'];
	$Remark=$_POST['Remark'];
	$CurTime=date('Y-m-d H:i:s');
	$select="select tt_ID from tms_bd_TicketType where tt_TypeName='{$TypeName}'";
	$sele= $class_mysql_default->my_query($select);
	$results=mysqli_fetch_array($sele);
	if($results==false ||$ID==$results['tt_ID']){
		$update="UPDATE tms_bd_TicketType SET tt_TypeName='{$TypeName}', tt_ModerID='{$userID}', tt_Moder='{$userName}', 
				tt_ModTime='{$CurTime}', tt_Remark='{$Remark}' WHERE tt_ID='{$ID}'";
		$query =$class_mysql_default->my_query($update);
		if($query){
			echo"<script>alert('修改成功!');window.location.href='tms_v1_basedata_seartickettype.php'</script>";
		}else{
		//	echo "SQL错误：".$class_mysql_default->my_error();
			echo"<script>alert('修改失败');window.location.href='tms_v1_basedata_seartickettype.php'</script>";
			}
	}else{
		echo"<script>alert('票据类型存在，请重新输入！');window.location.href='tms_v1_basedata_modtickettype.php?clnumber=$ID'</script>";
	}
}  
?>

