<?php 
//车辆循环添加界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$NoOfRunsID=$_GET['NoOfRunsID'];
?>
<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
<!--
function add(){
	if(document.getElementById("BeginDate").value==""){
		alert("开始时间不能为空!");
		return false; 
	}
	if(document.getElementById("EndDate").value==""){
		alert("结束时间不能为空!");
		return false; 
	}	
	if(document.getElementById("BeginDate").value>document.getElementById("EndDate").value){
		alert('开始日期不能大于结束日期');
		document.getElementById("EndDate").value="";
		document.getElementById("EndDate").focus();
		return false;
	}
}
function retur(){
	window.location.href='tms_v1_basedata_searnorunsstop.php?clnumber='+document.getElementById("NoOfRunsID").value;
}
//-->
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 班 次 长 停  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<form method="post" name="aaa" action="tms_v1_basedata_addnorunsstopok.php">
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次编号：</span></td>
        <td bgcolor="#FFFFFF">
        	<input type="hidden" name="NoOfRunsID" id="NoOfRunsID" value="<?php echo $NoOfRunsID;?>"/>
        	<input type="text" name="NoOfRunsI" disabled="disabled" value="<?php echo $NoOfRunsID;?>"/></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 长停开始时间：</span></td>
		<td bgcolor="#FFFFFF">
			<input type="text" name="BeginDate" id="BeginDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>&nbsp;<span style="color:red">*</span>
		</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 长停结束时间 ：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="text" name="EndDate" id="EndDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>&nbsp;<span style="color:red">*</span>
    	</td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 长停原因 ：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="StopCause"/></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows=""></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="submit" type="submit" value="添加" onclick="return add()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="retur()"></td>
  </tr>
</table>
</form>


