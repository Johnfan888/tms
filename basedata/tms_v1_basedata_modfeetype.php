<?php 
//修改收费类型界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber = $_GET['clnumber'];
	$clnumber1 = $_GET['clnumber1'];
	$sql = "select * FROM `tms_bd_FeeType` WHERE ft_ID='{$clnumber}'";
	$query =$class_mysql_default->my_query($sql);
	$result=mysqli_fetch_array($query);
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#FeeTypeName").keyup(function(){
		var FeeTypeName = document.getElementById("FeeTypeName").value;
		var FeeTypeName1 = document.getElementById("FeeTypeName1").value;
		if(FeeTypeName != FeeTypeName1){
		jQuery.get( 
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'addfeetype', 'FeeTypeName': FeeTypeName, 'time': Math.random()},
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
			document.getElementById('code').style.display="none";}
	});	
});
function adddo(){
	if(document.addpro.FeeTypeName.value == ""){
		alert("收费类型名称不能为空!");
		return false;
	}
	if(document.addpro.FeeTypeComputer.value == ""){
		alert("收费类型计算方式不能为空!");
		return false;
	}
	var FeeTypeName = document.getElementById("FeeTypeName").value;
	var FeeTypeName1 = document.getElementById("FeeTypeName1").value;
	if(FeeTypeName != FeeTypeName1){
	jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'addfeetype', 'FeeTypeName': FeeTypeName, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if( objData.sucess=='1'){
					alert('收费类型已存在，请重新输入！');
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
	window.location.href='tms_v1_basedata_searfeetype.php';
}
function selectFeeType(str){
	if(str=='按百分比收费'){
		document.getElementById("percent").style.display='';
	}else{
		document.getElementById("percent").style.display='none';
		document.getElementById("Feepercent").value='';
	}
	if(str=='固定金额收费'){
		document.getElementById("fix").style.display='';
	}else{
		document.getElementById("fix").style.display='none';
		document.getElementById("Feefix").value='';
	}
}
function isnum(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value="";
		return false;
		}
	if(number>100){
		alert("收费百分比不能超过100%");
		document.getElementById(id).value="";
		return false;
		}
}
function isnumber(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value="";
		return false;
		}
}
function getvalue(ID,str){
	if(document.getElementById(ID).checked){
		document.getElementById(str).value=1;
	}else{
		document.getElementById(str).value=0;
	}	
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">修 改 收 费 类 型  </span></td>
  </tr>
</table>
<?php
//连接数据库，获取班次信息
?>
<form id="addpro" name="addpro" method="post" action="">
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收费类型名称:</span></td>
        <td bgcolor="#FFFFFF"><input name="ID" type="hidden" value="<?php echo $clnumber;?>" />
        		<input type="hidden" name="FeeTypeName1" id="FeeTypeName1" value="<?php echo $result['ft_FeeTypeName'];?>"/>
        		<input type="text" name="FeeTypeName" id="FeeTypeName" value="<?php echo $result['ft_FeeTypeName'];?>"/><span style="color:red">*</span><br><span style="color:red" style="display:none" id="code">收费类型已存在，请重新输入！</span></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收费类型计算方式：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="FeeTypeComputer" id="FeeTypeComputer" onchange="selectFeeType(this.value)">
    			<?php 
					if ($result['ft_FeeTypeComputer'] == "")	echo "<option selected=\"selected\" value=\"\"></option>";
					else						echo "<option  value=\"\"></option>";
					if ($result['ft_FeeTypeComputer'] == "按百分比收费")	echo "<option selected=\"selected\" value=\"按百分比收费\">按百分比收费</option>";
					else						echo "<option  value=\"按百分比收费\">按百分比收费</option>";
					if ($result['ft_FeeTypeComputer'] == "固定金额收费")	echo "<option selected=\"selected\" value=\"固定金额收费\">固定金额收费</option>";
					else						echo "<option  value=\"固定金额收费\">固定金额收费</option>";
				?>
    		</select><span style="color:red">*</span>
		</td>
	</tr> 
	<tbody id="percent" <?php if($result['ft_FeeTypeComputer']=='按百分比收费') echo "style='display:'"; else echo "style='display: none'" ?>>
	<tr > 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收费百分比：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Feepercent" id="Feepercent" value="<?php echo $result['ft_FeePercent'];?>" onkeyup="return isnum(this.value,this.id)"/><span style="color:red">%</span></td>
	</tr>  
	<tr>
	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsDock" id="IsDock" value="0"/></td>
	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="checkbox" name="IsDoc" id="IsDoc" onclick="getvalue(this.id,'IsDock')"/>是否将此费用同步修改到车辆收费项目</td>
	</tr>
	</tbody>
	<tbody id="fix" <?php if($result['ft_FeeTypeComputer']=='固定金额收费') echo "style='display:'"; else echo "style='display: none'" ?>>
	<tr > 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收费金额：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Feefix" id="Feefix" value="<?php echo $result['ft_FeeFix'];?>" onkeyup="return isnumber(this.value,this.id)"/><span style="color:red">元</span></td>
	</tr>  
	<tr>
	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsDock0" id="IsDock0" value="0"/></td>
	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="checkbox" name="IsDoc0" id="IsDoc0" onclick="getvalue(this.id,'IsDock0')"/>是否将此费用同步修改到车辆收费项目</td>
	</tr>
	</tbody>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 助记码 ：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="HelpCode" id="HelpCode" value="<?php echo $result['ft_HelpCode'];?>"/></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"><?php echo $result['ft_Remark'];?></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center"bgcolor="#FFFFFF"><input name="button1" type="button" value="修改" onclick="return adddo();" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="search();">&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>
<?php 
if(isset($_POST['FeeTypeName'])){
	$ID=$_POST['ID'];
	$FeeTypeName = $_POST['FeeTypeName'];
	$FeeTypeName1 = $_POST['FeeTypeName1'];
	$FeeTypeComputer=$_POST['FeeTypeComputer'];
	$Feepercent=$_POST['Feepercent'];
	$Feefix=$_POST['Feefix'];
	$HelpCode=$_POST['HelpCode'];
	$Remark=$_POST['Remark'];
	$CurTime=date('Y-m-d H:i:s');
	$IsDock=$_POST['IsDock'];
	$IsDock0=$_POST['IsDock0'];
	$state=0;
	$class_mysql_default->my_query("START TRANSACTION");
		if($FeeTypeComputer=="按百分比收费"&&$Feepercent!=''&&$IsDock==1){
			$state=1;
			$update1="UPDATE tms_acct_BusRate SET br_Rate".$clnumber1."='{$Feepercent}' where br_BusID!='' ";
			$query1 =  $class_mysql_default->my_query($update1);
		}
		if($FeeTypeComputer=="固定金额收费"&&$Feefix!=''&&$IsDock0==1){
			$state=1;
			$update1="UPDATE tms_acct_BusRate SET br_Rate".$clnumber1."='{$Feefix}' where br_BusID!='' ";
			$query1 =  $class_mysql_default->my_query($update1);
		}
	$select="select ft_FeeTypeName from tms_bd_FeeType where ft_FeeTypeName='{$FeeTypeName}'";
	$sele= $class_mysql_default->my_query($select);
	$result=mysqli_fetch_array($sele);
	if($result==false ||$FeeTypeName==$FeeTypeName1){
		$update="update tms_bd_FeeType set ft_FeeTypeName='{$FeeTypeName}', ft_FeeTypeComputer='{$FeeTypeComputer}',ft_FeePercent='{$Feepercent}',ft_FeeFix='{$Feefix}',
			ft_HelpCode='{$HelpCode}', ft_ModerID='{$userID}', ft_Moder='{$userName}', ft_ModTime='{$CurTime}', ft_Remark='{$Remark}' where ft_ID='{$ID}'";
		$query =$class_mysql_default->my_query($update);
		if($state==0){
			if($query){
				$class_mysql_default->my_query("COMMIT");
			echo"<script>alert('修改成功！');window.location.href='tms_v1_basedata_modfeetype.php?clnumber=$ID&clnumber1=$clnumber1'</script>";
		}else{
			$class_mysql_default->my_query("ROLLBACK");
			echo"<script>alert('修改失败！');window.location.href='tms_v1_basedata_modfeetype.php?clnumber=$ID&clnumber1=$clnumber1'</script>";
		}
		}else{
		if($query&&$query1){
			$class_mysql_default->my_query("COMMIT");
			echo"<script>alert('修改成功！');window.location.href='tms_v1_basedata_modfeetype.php?clnumber=$ID&clnumber1=$clnumber1'</script>";
		}else{
			$class_mysql_default->my_query("ROLLBACK");
			echo"<script>alert('修改失败！');window.location.href='tms_v1_basedata_modfeetype.php?clnumber=$ID&clnumber1=$clnumber1'</script>";
		}
		}
	}
	/*else{
		echo"<script>alert('收费类型已存在，请重新输入！');window.location.href='tms_v1_basedata_modfeetype.php?clnumber=$ID&clnumber1=$clnumber1'</script>";
	}*/
	$class_mysql_default->my_query("END TRANSACTION");
}
?>
