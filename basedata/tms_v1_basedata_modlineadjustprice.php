<?php 
//修改线路调价界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber=$_GET['clnumber'];
	$sqls = "select* FROM tms_bd_NoRunsAdjustPrice where nrap_ID='{$clnumber}'";
	$querys =$class_mysql_default->my_query($sqls);
	//if (!$query) echo "SQL错误：".mysql_error();
	$results=mysql_fetch_array($querys);	
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
function isnumber(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value='';
		return false;
		}
}
function sear(){
	window.location.href='tms_v1_basedata_searlineadjustprice.php?clnumber='+document.getElementById("LineAdjust").value;
}
$(document).ready(function(){
	$("#RunPrice").keyup(function(){
		if(document.getElementById("RunPrice").value==''){
			document.getElementById("HalfPrice").value='';
		}else{
		     var num = document.getElementById("RunPrice").value/2;
		     if(parseInt(num)==num)
			     {document.getElementById("HalfPrice").value=document.getElementById("RunPrice").value/2;}
		     else {
		    		 var num1=Math.ceil(num);
		    	 	document.getElementById("HalfPrice").value=num1;
			     }
		}
	});
	$("#mod").click(function(){
		if(document.getElementById("BeginDate").value==''){
			alert('请选择开始日期！');
			return false;
		}
		if(document.getElementById("EndDate").value==''){
			alert('请选择结束日期！');
			return false;
		}
		if(document.getElementById("EndDate").value<document.getElementById("BeginDate").value){
			alert('结束日期不能小于开始日期！');
			document.getElementById("BeginDate").value='';
			document.getElementById("EndDate").value='';
			return false;
		}
		if(document.getElementById("ReferPrice").value==''){
			alert('请输入标准价！');
			return false;
		}
		if(document.getElementById("RunPrice").value==''){
			alert('请输入执行价！');
			return false;
		}
		jQuery.get(
			'tms_v1_basedata_modlineadjustpriceok.php',
			{'op': 'modlineprice', 'LineAdjust':$("#LineAdjust").val(), 'ISUnitAdjust':$("#ISUnitAdjust").val(),'ISLineAdjust':$("#ISLineAdjust").val(),
				'Unit':$("#Unit").val(),'DepartureSite':$("#DepartureSite").val(),'DepartureSiteID':$("#DepartureSiteID").val(),'GetToSite':$("#GetToSite").val(),
				'GetToSiteID':$("#GetToSiteID").val(),'ModelID':$("#ModelID").val(),'Model':$("#Model").val(),'BeginDate':$("#BeginDate").val(),
				'EndDate':$("#EndDate").val(),'ReferPrice':$("#ReferPrice").val(),'RunPrice':$("#RunPrice").val(),'HalfPrice':$("#HalfPrice").val(),
				'BalancePrice':$("#BalancePrice").val(),'Remark':$("#Remark").val(),'ID':$("#ID").val(),'time': Math.random()},
			function(data){
			//	alert(data);
				var objData = eval('(' + data + ')');
				if(objData.retVal=='FAIL'){
					alert(objData.retString);
				}else{
					if(objData.retVal=='FAIL1'){
						alert(objData.retString);
						document.getElementById("BeginDate").value='';
						document.getElementById("EndDate").value=''
					}else{
						alert(objData.retString);
						window.location.href='tms_v1_basedata_modlineadjustprice.php?clnumber='+document.getElementById("ID").value;
					}
				}
		}); 
	});
});
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">修 改 线 路 调 价 </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<div><form name="addL" id="addL" action="" method="post">
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />调价线路编号：</span></td>
		<td bgcolor="#FFFFFF"><input type="hidden" name="LineAdjust" id="LineAdjust"  value="<?php echo $results['nrap_LineAdjust'];?>"/>
		<input type="text" name="LineAdjust1" style="width:230px;" id="LineAdjust1" disabled="disabled" value="<?php echo $results['nrap_LineAdjust'];?>" />
			<input type="hidden" name="ID" id="ID" value="<?php echo $results['nrap_ID'];?>"/></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />调价方式：</span></td>
		<td bgcolor="#FFFFFF"><input type="radio" name="radio1" id="ISUnit" <?php if($results['nrap_ISUnitAdjust']==1) echo 'checked';?> disabled="disabled">按协议调价
    		<input type="radio" name="radio1" id="ISLine" <?php if($results['nrap_ISLineAdjust']==1) echo 'checked';?> disabled="disabled">按线路调价
    		<input type="hidden" name="ISUnitAdjust" id="ISUnitAdjust" value="<?php echo $results['nrap_ISUnitAdjust'];?>"/>
    		<input type="hidden" name="ISLineAdjust" id="ISLineAdjust" value="<?php echo $results['nrap_ISLineAdjust'];?>"/></td>
	</tr>
	<tr style="display: <?php if($results['nrap_ISUnitAdjust']==0) echo 'none';?>">
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />调价协议单位：</span></td>
		<td bgcolor="#FFFFFF"><input name="Unit" id="Unit" value="<?php echo $results['nrap_Unit'];?>" readonly="readonly"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />发车站编号：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="hidden" name="DepartureSiteID" id="DepartureSiteID" value="<?php echo $results['nrap_DepartureSiteID'];?>"/>
    		<input  type="text" name="DepartureSiteI" id="DepartureSiteI" disabled="disabled" value="<?php echo $results['nrap_DepartureSiteID'];?>"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />发车站名：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="text" name="DepartureSite" id="DepartureSite" value="<?php echo $results['nrap_DepartureSite'];?>" readonly="readonly"/>
    	</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />到达站编号：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="hidden" name="GetToSiteID" id="GetToSiteID" value="<?php echo $results['nrap_GetToSiteID'];?>"/>
    		<input  type="text" name="GetToSiteI" id="GetToSiteI" disabled="disabled" value="<?php echo $results['nrap_GetToSiteID'];?>"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />到达站名：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="text" name="GetToSite" id="GetToSite" value="<?php echo $results['nrap_GetToSite'];?>" readonly="readonly"/>
    	</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车型编号：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="hidden" name="ModelID" id="ModelID" value="<?php echo $results['nrap_ModelID']?>" />
    		<input  type="text" name="ModelI" id="ModelI" disabled="disabled" value="<?php echo $results['nrap_ModelID']?>"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车型名：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="text" name="Model" id="Model" value="<?php echo $results['nrap_ModelName']?>" readonly="readonly"/>
    	</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />开始日期：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="text" name="BeginDate" id="BeginDate" value="<?php echo $results['nrap_BeginDate']?>"  class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    		<span style="color:red">*</span>
    	</td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />结束日期：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="text" name="EndDate" id="EndDate" value="<?php echo $results['nrap_EndDate']?>"  class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    		<span style="color:red">*</span>
    	</td>
	</tr>
<!--  
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />开始时间：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="BeginTime" value="<?php echo $results['nrap_BeginTime']?>"/></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />结束时间：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="EndTime" value="<?php echo $results['nrap_EndTime']?>"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />参考票价：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="ReferPrice" value="<?php echo $results['nrap_ReferPrice'];?>" onkeyup="return isnumber(this.value)"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />上调百分比：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="PriceUpPercent" value="<?php echo $results['nrap_PriceUpPercent'];?>" onkeyup="return isnumber(this.value)"/></td>
	</tr>
 --> 
 	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />标准价：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="text" name="ReferPrice" id="ReferPrice" value="<?php echo $results['nrap_ReferPrice'];?>" onkeyup="return isnumber(this.value,this.id)"/>
    		<span style="color:red">*</span>
    	</td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />执行价：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="text" name="RunPrice"  id="RunPrice" value="<?php echo $results['nrap_RunPrice'];?>" onkeyup="return isnumber(this.value,this.id)"/>
    		<span style="color:red">*</span>
    	</td>
	</tr> 
	<tr> 
    	<td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />半价：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="HalfPrice" id="HalfPrice" value="<?php echo $results['nrap_HalfPrice'];?>" readonly="readonly" onkeyup="return isnumber(this.value,this.id)"/></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />结算价：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="BalancePrice" id="BalancePrice" value="<?php echo $results['nrap_BalancePrice'];?>" onkeyup="return isnumber(this.value,this.id)"/></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" id="Remark" cols="" rows="5"><?php echo $results['nrap_Remark'];?></textarea></td>
	</tr> 
	 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="mod" id="mod" type="button" value="提交"  />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return sear()"></td>
  </tr>
</table>
</form>
</div>

