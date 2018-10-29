<?php
	//班次循环界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber=$_GET['clnumber'];
	$sql="SELECT * FROM tms_bd_NoRunsInfo where nri_NoOfRunsID='{$clnumber}'";
	$query =$class_mysql_default->my_query($sql);
	$row=mysqli_fetch_array($query);
?>
<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
function checkw(str){
	var stri=str+',';
	if(document.aaa.week[str-1].checked){
		if(document.aaa.WeekLoop.value.indexOf(stri)<0){
			{document.aaa.WeekLoop.value=document.aaa.WeekLoop.value+stri;}
		}
	}
  //  if(!document.aaa.week[str-1].checked){
  else{
   		document.aaa.WeekLoop.value=document.aaa.WeekLoop.value.replace(stri,"");	
	}
}

function isnumber(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value='';
		return false;
		}
}
function checkm(str){
	var stt=str
	if (str<10){
		stt='0'+stt
		}
	stri=stt+',';
	if(document.aaa.month[str-1].checked){
		if(document.aaa.MonthLoop.value.indexOf(stri)<0){
			document.aaa.MonthLoop.value=document.aaa.MonthLoop.value+stri;
		}
	}
    if(!document.aaa.month[str-1].checked){
   		document.aaa.MonthLoop.value= document.aaa.MonthLoop.value.replace(stri,"");	
	}
}
function retur(){
	window.location.href='tms_v1_basedata_searnoruns.php'	
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">班 次 循 环 设 置 </span></td>
  </tr>
</table>
<?php
//连接数据库，获取班次信息
?>
<form method="post" name="aaa" action="tms_v1_basedata_norunsloopok.php">
<table width="67%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次编号：</span></td>
        <td bgcolor="#FFFFFF">
        	<input type="hidden" name="NoOfRunsID" value="<?php echo $clnumber;?>"/>
        	<input type="text" name="NoOfRunsI" disabled="disabled" value="<?php echo $clnumber;?>"/></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 循环日期：</span></td>
		<td bgcolor="#FFFFFF"><input type="text" name="LoopDate" value="<?php echo $row['nri_LoopDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开始天数：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="StartDay" id="StartDay" value="<?php echo $row['nri_StartDay'];?>" onkeyup="return isnumber(this.value,this.id)" /></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开班天数：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="RunDay" id="RunDay" value="<?php echo $row['nri_RunDay'];?>" onkeyup="return isnumber(this.value,this.id)" /></td>
	</tr> 
	 <tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 停班天数：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="StopDay" id="StopDay" value="<?php echo $row['nri_StopDay'];?>" onkeyup="return isnumber(this.value,this.id)" /></td>
	</tr> 
<!-- <tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 周循环：</span></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="week" value="1"   <?php if(strstr($row['nri_WeekLoop'],'1,')!=false) echo 'checked';?> onclick="checkw(this.value)"/>星期一
    		<input type="checkbox" name="week" value="2"  <?php if(strstr($row['nri_WeekLoop'],'2,')!=false) echo 'checked';?> onclick="checkw(this.value)"/>星期二
    		<input type="checkbox" name="week" value="3"  <?php if(strstr($row['nri_WeekLoop'],'3,')!=false ) echo 'checked';?> onclick="checkw(this.value)"/>星期三
    		<input type="checkbox" name="week" value="4"  <?php if(strstr($row['nri_WeekLoop'],'4,')!=false ) echo 'checked';?> onclick="checkw(this.value)"/>星期四
    		<input type="checkbox" name="week" value="5"  <?php if(strstr($row['nri_WeekLoop'],'5,')!=false ) echo 'checked';?> onclick="checkw(this.value)"/>星期五	
    		<input type="checkbox" name="week" value="6"  <?php if(strstr($row['nri_WeekLoop'],'6,')!=false ) echo 'checked';?> onclick="checkw(this.value)"/>星期六
    		<input type="checkbox" name="week" value="7"  <?php if(strstr($row['nri_WeekLoop'],'7,')!=false ) echo 'checked';?> onclick="checkw(this.value)"/>星期日
    		<input type="text" name="WeekLoop" value="<?php echo $row['nri_WeekLoop'];?>"/></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" onclick="check(month)"/> 月循环：</span></td>
    	<td bgcolor="#FFFFFF">
    	<?php 
    		for($i=1;$i<=31;$i++){
    	?>
    		<input type="checkbox" name="month" value="<?php echo $i;?>"<?php if($i<10) $i='0'.$i; if(strstr($row['nri_MonthLoop'],$i.',')!=false) echo 'checked';?> onclick="checkm(this.value)"/><?php echo $i;?>
    	<?php }?>
    		<br><input type="text" name="MonthLoop" value="<?php echo $row['nri_MonthLoop'];?>"/></td>
    		
    	
	</tr>
-->
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="submit" type="submit" value="设置" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="retur()"></td>
  </tr>
</table>
</form>


