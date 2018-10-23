<?php 
//修改车属单位界面
	//定义页面必须验证是否登录
//	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber = $_GET['clnumber'];
	$sql = "select* FROM tms_bd_BusUnit WHERE bu_ID='{$clnumber}'";
	$query =$class_mysql_default->my_query($sql);
	$result=mysql_fetch_array($query);
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#UnitName").keyup(function(){
		var UnitName = document.getElementById("UnitName").value;
		var UnitNam = document.getElementById("UnitNam").value;
		if(UnitName != UnitNam){
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
		}
		else{
			document.getElementById('code').style.display="none";
			}
	});	
});
function adddo(){
	if(document.addunit.UnitName.value == ""){
		alert("车属单位名称不能为空!");
		return false;
	}
	var UnitName = document.getElementById("UnitName").value;
	var UnitNam = document.getElementById("UnitNam").value;
	if(UnitName != UnitNam){
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
	else{
		document.addunit.submit();}
}
function search(){
	window.location.href='tms_v1_basedata_searbusunit.php';
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">修 改 车 属 单 位  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<form id="addunit" name="addunit" method="post" action="" >
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车属单位名称：</span></td>
		<td bgcolor="#FFFFFF"><input type="hidden" name="ID" id="ID" value="<?php echo $clnumber;?>"/>
		<input type="hidden" name="UnitNam" id="UnitNam" value="<?php echo $result['bu_UnitName'];?>"/>
		<input type="text" name="UnitName" id="UnitName" value="<?php echo $result['bu_UnitName'];?>"/><span style="color:red">*</span><br><span style="color:red" style="display:none" id="code">&nbsp;车属单位已存在,请重新输入！</span></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />单位性质：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="UnitProperty" id="UnitProperty" value="<?php echo $result['bu_UnitProperty'];?>"/></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />联系人：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="UnitContacts" id="UnitContacts" value="<?php echo $result['bu_UnitContacts'];?>"/></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />联系电话：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="UnitPhone" id="UnitPhone" value="<?php echo $result['bu_UnitPhone'];?>"/></td>
	</tr>  
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />单位地址：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="UnitAdress" id="UnitAdress" value="<?php echo $result['bu_UnitAdress'];?>" style="width:200px;"/></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"><?php echo $result['bu_Remark'];?></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="button1" type="button" value="修改" onclick="return adddo();" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="search();">&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>
<?php 
	if(isset($_POST['UnitName'])){
		$ID=$_POST['ID'];
		$UnitName=$_POST['UnitName'];
		$UnitProperty=$_POST['UnitProperty'];
		$UnitContacts=$_POST['UnitContacts'];
		$UnitPhone=$_POST['UnitPhone'];
		$UnitAdress=$_POST['UnitAdress'];
		$Remark=$_POST['Remark'];
		$select="select bu_ID, bu_UnitName from tms_bd_BusUnit where bu_UnitName='{$UnitName}'";
		$sele=$class_mysql_default->my_query($select);
		$results=mysql_fetch_array($sele);
	//	echo $ID;
	//	echo $results['bu_ID'];
		if(!$results || $ID==$results['bu_ID']){
			$update="update tms_bd_BusUnit set bu_UnitName='{$UnitName}', bu_UnitProperty='{$UnitProperty}', bu_UnitContacts='{$UnitContacts}', 
				bu_UnitPhone='{$UnitPhone}', bu_UnitAdress='{$UnitAdress}',bu_Remark='{$Remark}' where bu_ID='{$ID}'";
			$query =$class_mysql_default->my_query($update);
			if($query){
				echo"<script>alert('恭喜您！修改成功!');window.location.href='tms_v1_basedata_modbusunit.php?clnumber=$ID'</script>";
			}else{
				echo"<script>alert('添加失败');window.location.href='tms_v1_basedata_modbusunit.php?clnumber=$ID'</script>";
			}
		}else{
			echo"<script>alert('车属单位已存在，请重新输入！');window.location.href='tms_v1_basedata_modbusunit.php?clnumber=$ID'</script>";
		}
	}
?>
