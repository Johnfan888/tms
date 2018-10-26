<?php 
//车辆循环添加界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$NoOfRunsID=$_GET['NoOfRunsID'];
?>
<script type="text/javascript">
function add(){
	if(document.getElementById("ModelID").value == ""){
		alert("车型编号不能为空!");
		return false; 
	}	
}
function retur(){
	str=document.aaa.NoOfRunsID.value;
	window.location.href='tms_v1_basedata_searnorunsreserve.php?op=see&clnumber='+str;	
}
function getidname(str){
	var st=str.split(',')
	document.getElementById("ModelName").value=st[1]
	document.getElementById("ModelID").value=st[0]
	document.getElementById("ModelI").value=st[0]
}
function getnumbers(){
	document.getElementById("ReserveSeatS").value=document.getElementById("ReserveSeatNO").value.replace(/[^,]/g,'').length
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#4C4C4C"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 班 次 预 留  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<form method="post" name="aaa" action="tms_v1_basedata_addnorunsreserveok.php">
<table width="40%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />班次编号：</span></td>
        <td bgcolor="#FFFFFF">
        	<input type="hidden" name="NoOfRunsID" value="<?php echo $NoOfRunsID;?>"/>
        	<input type="text" name="NoOfRunsI" disabled="disabled" value="<?php echo $NoOfRunsID;?>"/></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车型编号：</span></td>
		<td bgcolor="#FFFFFF"><input type="hidden" name="ModelID" id="ModelID"/>
				<input type="text" name="ModelI" id="ModelI" disabled="disabled" /></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车型名：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="BusTypeIDName" onchange="getidname(this.value)">
      			<option></option>
      			<?php
      				$sql="SELECT * FROM tms_bd_BusModel"; 
      				$query =$class_mysql_default->my_query($sql);
					while($result=mysqli_fetch_array($query)){
      			?>
      			<option value="<?php echo $result['bm_ModelID'].','.$result['bm_ModelName'];?>"><?php echo $result['bm_ModelName'];?></option>
      			<?php 
					}
      			?>
     	 	</select><input type="hidden" name="ModelName" id="ModelName"/><span style="color:red">*</span></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 预留座位号 ：</span></td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="ReserveSeatNO" id="ReserveSeatNO"/><span style="color:red">*座位号之间必须用逗号隔开，最后一个座位号后必须有逗号*</span></td>
	</tr> 
	 <tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />预留座位数：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="ReserveSeatS" id="ReserveSeatS" readonly="readonly" onclick="getnumbers()"/></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows=""></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="submit" type="submit" value="添加" onclick="add()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="retur()"></td>
  </tr>
</table>
</form>
