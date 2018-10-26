<?php 
	//添加区域界面

	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");

	$clnumber=$_GET['clnumber'];
	$select="SELECT bi_BusID, bi_BusNumber,bi_RegDate,bi_InStationID,bi_InStation FROM tms_bd_BusInfo  WHERE bi_BusID='{$clnumber}'";
	$query=$class_mysql_default->my_query($select);
	$result=mysqli_fetch_array($query);
	$select1="SELECT bc_CardID,bc_RegDate,bc_Remark FROM tms_bd_BusCard WHERE bc_BusID='{$clnumber}'";
	$query1=$class_mysql_default->my_query($select1);
	$result1=mysqli_fetch_array($query1);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>车辆检验</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../css/style_main.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			$("#CardID").focus();
			$("#CardID").keyup(function(e){
				if(e.keyCode == 13){
					// do nothing at this moment
				}
				else {
					$("#CardID").val(e.value);
				}
			});
			$("#resultsubmit").click(function(){
				if(document.addpro.CardID.value == ""){
					alert("卡号不能为空!");
					document.addpro.CardID.focus();
				}
				else {
					document.addpro.submit();
				}
			});
		});
		</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
		  <tr>
		    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
		    <span class="graytext" style="margin-left:8px;">添 加 车 辆 卡 </span></td>
		  </tr>
		</table>
		<?
		//连接数据库，获取班次信息
		?>
		<form id="addpro" name="addpro" method="post" action="tms_v1_basedata_addbuscardok.php?op=add" >
		<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
			<tr>
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />卡号：</span></td>
		        <td bgcolor="#FFFFFF"><input type="hidden" name="CardI" id="CardI" value="<?php echo $result1['bc_CardID'];?>"/>
		        	<input type="text" name="CardID" id="CardID" value="<?php echo $result1['bc_CardID'];?>"/><span style="color:red">*</span></td>
			</tr>
			<tr>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆编号：</span></td>
				<td bgcolor="#FFFFFF"><input type="hidden" name="BusID" id="BusID" value="<?php echo $result['bi_BusID'];?>"/>
						<input type="text" name="BusI" id="BusI" disabled="disabled" value="<?php echo $result['bi_BusID'];?>"/></td>
			</tr> 
			<tr> 
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="hidden" name="BusNumber" id="BusNumber" value="<?php echo $result['bi_BusNumber'];?>"/>
		    			<input type="text" name="BusNumbe" id="BusNumbe" disabled="disabled" value="<?php echo $result['bi_BusNumber'];?>"/></td>
			</tr> 
			<tr> 	
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 注册日期：</span></td>
		    	<td bgcolor="#FFFFFF"><input name="RegDate" id="RegDate" type="text" class="Wdate" value="<?php echo $result1['bc_RegDate'];?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td>
			</tr> 
			<tr> 	
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站编号：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="hidden" name="StationID" id="StationID" value="<?php echo $result['bi_InStationID'];?>" />
		    			<input type="text" name="StationI" id="StationI" disabled="disabled" value="<?php echo $result['bi_InStationID'];?>" /></td>
			</tr> 
			<tr> 	
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站：</span></td>
		    	<td bgcolor="#FFFFFF"><input type="hidden" name="Station" id="Station" value="<?php echo $result['bi_InStation'];?>" />
		    			<input type="text" name="Statio" id="Statio" disabled="disabled" value="<?php echo $result['bi_InStation'];?>" /></td>
			</tr> 
			<tr> 	
		    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
		    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"><?php echo $result1['bc_Remark'];?></textarea></td>
			</tr> 
		   <tr>
		    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="resultsubmit" id="resultsubmit" type="button" value="提交" />
		    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置" />
		    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="history.back();" />&nbsp;&nbsp;&nbsp;&nbsp;</td>
		  </tr>
		</table>
		</form>
	</body>
</html>
