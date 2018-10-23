<?php 
//添 加 保 险 产 品 界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#INSUREPRODUCTNAME").keyup(function(){
		var INSUREPRODUCTNAME = document.getElementById("INSUREPRODUCTNAME").value;
		jQuery.get(
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'addinsuretype', 'INSUREPRODUCTNAME': INSUREPRODUCTNAME, 'time': Math.random()},
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
	if(document.addpro.INSUREPRODUCTNAME.value == ""){
		alert("保险产品名称不能为空!");
		return false;
	}
	if(document.addpro.PRICE.value == ""){
		alert("保险费不能为空!");
		return false;
	}
	var INSUREPRODUCTNAME = document.getElementById("INSUREPRODUCTNAME").value;
	jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'addinsuretype', 'INSUREPRODUCTNAME': INSUREPRODUCTNAME, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if( objData.sucess=='1'){
					alert('保险产品已存在，请重新输入！');
						return false;
				}
				else{
			 		document.addpro.submit();}
	});
}
function isnumber(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value='';
		return false;
		}
}
function search(){
	window.location.href='tms_v1_basedata_searinsuretype.php';
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 保 险 产 品  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<form id="addpro" name="addpro" method="post" action="" >
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保险产品名称：</span></td>
        <td bgcolor="#FFFFFF"><input type="text" name="INSUREPRODUCTNAME" id="INSUREPRODUCTNAME" /><span style="color:red">*</span><br><span style="color:red" style="display:none" id="code">&nbsp;保险产品已存在，请重新输入！</span></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 生效时间：</span></td>
		<td bgcolor="#FFFFFF"><input type="text" name="EFFECTIVEDATE" id="EFFECTIVEDATE"  class="Wdate" value="<?php print date('Y-m-d');?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
	</tr> 
 	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保险费：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="PRICE" id="PRICE" onkeyup="return isnumber(this.value,this.id)" />元<span style="color:red">*</span></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />保险代码：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="RISKCODE" id="RISKCODE" /></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />承保机构代码：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="MAKECODE" id="MAKECODE" /></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />保障方案代码：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="RATIONTYPE" id="RATIONTYPE" /></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />代理机构代码：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="AGENTCODE" id="AGENTCODE" /></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />单证识别码：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="VISACODE" id="VISACODE" /></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />前缀：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="PERFIX" id="PERFIX" /></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />意外伤保险：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="AINSURANCEVALUE" id="AINSURANCEVALUE" onkeyup="return isnumber(this.value,this.id)" />元</td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />意外医疗保险：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="BINSURANCEVALUE" id="BINSURANCEVALUE" onkeyup="return isnumber(this.value,this.id)" />元</td>
	</tr>
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="button1" type="button" value="添加" onclick="return adddo();" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="search();">&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>
<?php 
	if(isset($_POST['INSUREPRODUCTNAME'])){
		$INSUREPRODUCTNAME=$_POST['INSUREPRODUCTNAME'];
		$EFFECTIVEDATE=$_POST['EFFECTIVEDATE'];
		$PRICE=$_POST['PRICE'];
		$RISKCODE=$_POST['RISKCODE'];
		$MAKECODE=$_POST['MAKECODE'];
		$RATIONTYP=$_POST['RATIONTYPE'];
		$AGENTCODE=$_POST['AGENTCODE'];
		$VISACODE=$_POST['VISACODE'];
		$PERFIX=$_POST['PERFIX'];
		$AINSURANCEVALUE=$_POST['AINSURANCEVALUE'];
		$BINSURANCEVALUE=$_POST['BINSURANCEVALUE'];
		$select="select it_InsureProductName from tms_bd_InsureType  where it_InsureProductName='{$INSUREPRODUCTNAME}'";
		$sele=$class_mysql_default->my_query($select);
		if(!mysql_fetch_array($sele)){
			$insert="INSERT INTO `tms_bd_InsureType` (`it_InsureProductName`,`it_EffectiveDate`,`it_Price` ,`it_RiskCode`,`it_MakeCode`,
				`it_RationType`,`it_AgentCode`,`it_VisaCode`,`it_Perfix`,`it_AInsuranceValue`,`it_BInsuranceValue`) 
				VALUES ('{$INSUREPRODUCTNAME}', '{$EFFECTIVEDATE}','{$PRICE}','{$RISKCODE}','{$MAKECODE}','{$RATIONTYP}','{$AGENTCODE}',
				'{$VISACODE}','{$PERFIX}','{$AINSURANCEVALUE}','{$BINSURANCEVALUE}')";
			$query = $class_mysql_default->my_query($insert);
			if($query){
				echo"<script>alert('恭喜您！添加成功!');window.location.href='tms_v1_basedata_addinsuretype.php'</script>";
			}else{
				echo"<script>alert('添加失败');window.location.href='tms_v1_basedata_addinsuretype.php'</script>";
			}
		}else{
			echo"<script>alert('保险产品已存在，请重新输入！');window.location.href='tms_v1_basedata_addinsuretype.php'</script>";
		}
		
	}
?>
