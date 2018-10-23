<?php 
//修改线路站点界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$LineID = $_GET['LineID'];
	$section=$_GET['section'];
	$sqls = "select* FROM `tms_bd_SectionInfo` WHERE si_LineID='{$LineID}' and si_SectionID='{$section}'";
	$querys =$class_mysql_default->my_query($sqls);
	$results=mysql_fetch_array($querys);
?>
<script type="text/javascript">
function isnumber(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value="";
		return false;
		}
}
function isnum(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value="";
		return false;
		}
	if(number>100){
		alert("劳务费不能超过100%");
		document.getElementById(id).value="";
		return false;
		}
}
function checkInfo() {
	if(document.getElementById("otherFee3").value && document.getElementById("otherFee3").value > 100){
		alert("劳务费不应超过100%!");
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
function getvalueanddis(){
	if (document.getElementById("IsServiceFe").checked){
		document.getElementById("IsServiceFee").value=1;
		document.getElementById("Fees").style.display="";
	}else{
		document.getElementById("IsServiceFee").value=0;
		document.getElementById("ServiceFee").value=0;
	//	document.getElementById("otherFee1").value=0;
	//	document.getElementById("otherFee2").value=0;
		document.getElementById("otherFee3").value=0;
	//	document.getElementById("otherFee4").value=0;
	//	document.getElementById("otherFee5").value=0;
	//	document.getElementById("otherFee6").value=0;
		document.getElementById("Fees").style.display="none";
	}	
}
function linesite(){
	window.location.href='tms_v1_basedata_linesite.php?op=see&clnumber='+document.getElementById("LineID").value;
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">修 改  线 路 站 点  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<form action="tms_v1_basedata_modlinesiteok.php" method="post">
<table width="50%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路编号:</span></td>
        <td bgcolor="#FFFFFF">
        	<input name="SectionID" id="SectionID" type="hidden" value="<?php echo $results['si_SectionID'];?>"/>
        	<input name="LineID" id="LineID" type="hidden" value="<?php echo $results['si_LineID'];?>"/>
    		<input name="LineI" id="LineI" style="width:230px;" type="text" disabled="disabled" value="<?php echo $results['si_LineID'];?>"/></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路名称：</span></td>
		<td bgcolor="#FFFFFF">
			<input name="LineName" type="hidden"  value="<?php echo $results['si_LineName'];?>" />
    		<input name="LineNam" type="text" disabled="disabled" value="<?php echo $results['si_LineName'];?>" /></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点编号：</span></td>
    	<td bgcolor="#FFFFFF"><input name="SiteID" id="SiteID" type="hidden" value="<?php echo $results['si_SiteNameID'];?>"/>
    		<input name="SiteIDD" id="SiteIDD" type="hidden" value="<?php echo $results['si_SiteNameID'];?>"/>
    		<input name="SiteI" id="SiteI" type="text" disabled="disabled" value="<?php echo $results['si_SiteNameID'];?>"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点名：</span></td>
    	<td bgcolor="#FFFFFF"><input type="hidden" name="SiteName" id="SiteName" value="<?php echo $results['si_SiteName'];?>">
    		<input type="text" name="SiteNam" id="SiteNam" disabled="disabled" value="<?php echo $results['si_SiteName'];?>"></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路里程 ：</span></td>
    	<td bgcolor="#FFFFFF"><input type="hidden" name="Kilometer" size="10" value="<?php echo $results['si_Kilometer'];?>" onkeyup="return isnumber(this.value,this.id)" />
    	<input type="text" name="Kilometer1" disabled="disabled" size="10" value="<?php echo $results['si_Kilometer'];?>" />公里</td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsDock" id="IsDock" value="<?php echo $results['si_IsDock'];?>"/></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="IsDoc" id="IsDoc" <?php if($results['si_IsDock']!=0)echo "checked"; ?> disabled="disabled" onclick="getvalue(this.id,'IsDock')"/>是否停靠点 </td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsGetOnSite" id="IsGetOnSite" value="<?php echo $results['si_IsGetOnSite'];?>"/></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="IsGetOnSit" id="IsGetOnSit"  <?php if($results['si_IsGetOnSite']!=0)echo "checked"; ?> disabled="disabled" onclick="getvalue(this.id,'IsGetOnSite')"/>是否上车点</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsCheckInSite" id="IsCheckInSite" value="<?php echo $results['si_IsCheckInSite'];?>"/></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="IsCheckInSit" id="IsCheckInSit" <?php if($results['si_IsCheckInSite']!=0)echo "checked"; ?> disabled="disabled" onclick="getvalue(this.id,'IsCheckInSite')" />是否检票点</td>
	</tr>
<!-- 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsTollInSite" id="IsTollInSite" value="<?php echo $results['si_IsTollInSite'];?>"/></td>
    	<td bgcolor="#FFFFFF"> <input type="checkbox" name="IsTollInSit" id="IsTollInSit" <?php if($results['si_IsTollInSite']!=0)echo "checked";?> onclick="getvalue(this.id,'IsTollInSite')"/>是否收费点</td>
	</tr> 
--> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsServiceFee" id="IsServiceFee" value="<?php echo $results['si_IsServiceFee'];?>"/></td>
    	<td bgcolor="#FFFFFF"> <input type="checkbox" name="IsServiceFe" id="IsServiceFe" <?php if($results['si_IsServiceFee']!=0)echo "checked";?> onclick="getvalueanddis(this.id,'IsServiceFee')"/>是否收站务费</td>
	</tr>
	<tbody id="Fees" style="DISPLAY: <?php if ($results['si_IsServiceFee']) echo ''; else echo 'none';?>"> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站务费：</span></td>
    	<td bgcolor="#FFFFFF"><input name="ServiceFee" id="ServiceFee" type="text"  size="10" value="<?php echo $results['si_ServiceFee'];?>" onkeyup="return isnumber(this.value,this.id)" />元</td>
	</tr> 
<!--  
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 微机费:</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee1" id="otherFee1" type="text"  size="10"  value="<?php echo $results['si_otherFee1'];?>" onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发班费:</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee2" id="otherFee2" type="text"  size="10"  value="<?php echo $results['si_otherFee2'];?>" onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
-->
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 劳务费：</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee3" id="otherFee3" type="text"  size="10" value="<?php echo $results['si_otherFee3']*100;?>" onkeyup="return isnum(this.value,this.id)" /><span style="color:red">%</span></td>
	</tr> 
<!--  
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 其他费用4:</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee4" id="otherFee4" type="text"  size="10"   value="<?php echo $results['si_otherFee4'];?>" onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 其他费用5:</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee5" id="otherFee5" type="text"  size="10"  value="<?php echo $results['si_otherFee5'];?>" onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 其他费用6:</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee6" id="otherFee6" type="text"  size="10"  value="<?php echo $results['si_otherFee6'];?>" onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
-->
	</tbody>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"><?php echo $results['si_Remark'];?></textarea></td>
	</tr>
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="submit" type="submit" value="修改" onclick="return checkInfo();"/>
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return linesite()"></td>
  </tr>
</table>
</form>
