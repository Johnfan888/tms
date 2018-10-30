<?php 
//添加票价因素界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumbe=$_GET['clnumbe'];
	$sql="SELECT * FROM tms_bd_BusModel where bm_ModelID='{$clnumbe}'";
	$query=$class_mysql_default->my_query($sql);
	$result=mysqli_fetch_array($query);
?>
<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
function add(){
	if(document.getElementById("PriceProject").value == ""){
		alert("票价项目不能为空!");
		return false; 
	}
}
function isnumber(number){
	if(isNaN(number)){
		alert(number+"不是数字！");
		return false;
		}
}
function search(){
	window.location.href='tms_v1_basedata_searticketpricefactor.php?clnumber='+document.getElementById("ModelID").value;
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 票 价 因 素  </span></td>
  </tr>
</table>
<?php
//连接数据库，获取班次信息
?>
<div><form name="addL" id="addL" action="tms_v1_basedata_addticketpricefactorok.php" method="post">
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车型编号:</span></td>
        <td bgcolor="#FFFFFF"><input type="hidden" id="ModelID" name="ModelID" value="<?php echo $result['bm_ModelID'];?>" />
        	<input type="text"  name="ModelI" value="<?php echo $result['bm_ModelID'];?>" disabled="disabled" /></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车型名：</span></td>
		<td bgcolor="#FFFFFF"><input type="hidden" id="ModelName" name="ModelName" value="<?php echo $result['bm_ModelName'];?>" />
			<input name="ModelNam" id="ModelNam" type="text" value="<?php echo $result['bm_ModelName'];?>" disabled="disabled"/></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />票价项目：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="PriceProject" id="PriceProject"/><span style="color:red">*</span></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />起始日期 ：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="BeginDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />终止日期 ：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="EndDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />元/人公里：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="MoneyRenKil"  onkeyup="return isnumber(this.value)" /></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="submit" type="submit" value="添加" onclick="return add()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return search()"></td>
  </tr>
</table>
</form>
</div>

