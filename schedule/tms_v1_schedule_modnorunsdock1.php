<?php 
//修改班次停靠点界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$NoOfRunsID=$_GET['NoOfRunsID'];
	$noid=$_GET['noid'];
	$sql = "select* FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsID}'and nds_ID='{$noid}'";
	$query = $class_mysql_default->my_query($sql);
	$result=mysqli_fetch_array($query);
?>

<script type="text/javascript" >
function isnumber(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value='';
		return false;
	}
}
function searrunsdock(){
	var str=document.getElementById("NoOfRunsID").value;
	window.location.href='tms_v1_schedule_moddock.php?op=see&clnumber='+str;	
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
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">修 改 班 次 停 靠 点 </span></td>
  </tr>
</table>
<?php
//连接数据库，获取班次信息
?>
<div id="addlinesite">
<form action="tms_v1_schedule_modnorunsdockok.php" method="post">
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次编号:</span></td>
        <td bgcolor="#FFFFFF">
        	<input type="hidden" id="NoOfRunsID" name="NoOfRunsID" value="<?php echo $result['nds_NoOfRunsID'];?>"/>
			<input type="text" name="NoOfRunsI" disabled="disabled" value="<?php echo $result['nds_NoOfRunsID'];?>"/>
			<input name="ID" type="hidden" value="<?php echo $result['nds_ID'];?>"/>
		</td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点名：</span></td>
    	<td bgcolor="#FFFFFF"> <input type="hidden" name="SiteName" id="SiteName" value="<?php echo $result['nds_SiteName'];?>">
				<input name="SiteNam" id="SiteNam" type="text" disabled="disabled" value="<?php echo $result['nds_SiteName'];?>"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点编号：</span></td>
    	<td bgcolor="#FFFFFF"><input name="SiteID" id="SiteID" type="hidden" value="<?php echo $result['nds_SiteID'];?>"/>
    			<input name="SiteIDD" id="SiteIDD" type="hidden" value="<?php echo $result['nds_SiteID'];?>"/>
    			<input name="SiteI" id="SiteI" type="text" disabled="disabled" value="<?php echo $result['nds_SiteID'];?>"/></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />运行时间：</span></td>
    	<td bgcolor="#FFFFFF">
    		<?php 
    			if($result['nds_RunHours']!='') $RunHours=explode(":", $result['nds_RunHours']);
    		?>
    		<input type="hidden" name="RunHours" id="RunHours" value="<?php if($RunHours[0]) echo $RunHours[0]; ?>"/>
    		<input type="text" name="RunHour" id="RunHour" disabled="disabled" value="<?php if($RunHours[0]) echo $RunHours[0]; ?>" style="width:50px;"/>小时
    		<input type="hidden" name="RunMinuts" id="RunMinuts" value="<?php if($RunHours[1]) echo $RunHours[1];?>"/>
    		<input type="text" name="RunMinut" id="RunMinut" disabled="disabled" value="<?php if($RunHours[1]) echo $RunHours[1];?>" style="width:50px;"/>分钟
    		<br><span style="color:red">（注：该时间为起点到本站时间）</span></td>
	</tr>  
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车时间：</span></td>
    	<td bgcolor="#FFFFFF"><input name="DepartureTime" type="hidden" value="<?php echo $result['nds_DepartureTime'];?>" />
    			<input name="DepartureTim" type="text" disabled="disabled" value="<?php echo $result['nds_DepartureTime'];?>" /></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 检票口：</span></td>
    	<td bgcolor="#FFFFFF"><input name="CheckTicketWindow" type="hidden" value="<?php echo $result['nds_CheckTicketWindow'];?>"/>
    			<input name="CheckTicketWindo" type="text" disabled="disabled" value="<?php echo $result['nds_CheckTicketWindow'];?>"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsDock" id="IsDock" value="<?php echo $result['nds_IsDock'];?>"/></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="IsDoc" id="IsDoc" <?php if($result['nds_IsDock']!=0)echo "checked"; ?> disabled="disabled" onclick="getvalue(this.id,'IsDock')"/>是否停靠点 </td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="GetOnSite" id="GetOnSite" value="<?php echo $result['nds_GetOnSite'];?>"/> </td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="IsGetOnSit" id="IsGetOnSit" <?php if($result['nds_GetOnSite']!=0)echo "checked";?> disabled="disabled" onclick="getvalue(this.id,'GetOnSite')"/>是否上车点</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="CheckInSite" id="CheckInSite" value="<?php echo $result['nds_CheckInSite'];?>"/></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="CheckInSit" id="CheckInSit" <?php if($result['nds_CheckInSite']!=0)echo "checked";?> disabled="disabled" onclick="getvalue(this.id,'CheckInSite')"/>是否检票点</td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsServiceFee" id="IsServiceFee" value="<?php echo $result['nds_IsServiceFee'];?>"/></td>
    	<td bgcolor="#FFFFFF"> <input type="checkbox" name="IsServiceFe" id="IsServiceFe" value="checkbox" <?php if($result['nds_IsServiceFee']!=0)echo "checked";?> onclick="getvalueanddis(this.id,'IsServiceFee')"/> 是否收站务费</td>
	</tr> 
	<tbody id="Fees" style="DISPLAY: <?php if ($result['nds_IsServiceFee']) echo ''; else echo 'none';?>"> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站务费：</span></td>
    	<td bgcolor="#FFFFFF"><input name="ServiceFee" id="ServiceFee" type="text"  size="10" value="<?php echo $result['nds_ServiceFee'];?>" onkeyup="return isnumber(this.value,this.id)"/>元</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 劳务费:</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee3" id="otherFee3" type="text"  size="10" value="<?php echo $result['nds_otherFee3']*100;?>" onkeyup="return isnumber(this.value,this.id)"/>%
	</tr> 
<!-- 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 微机费:</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee1" id="otherFee1" type="text"  size="10" value="<?php echo $result['nds_otherFee1'];?>"  onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发班费:</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee2" id="otherFee2" type="text"  size="10" value="<?php echo $result['nds_otherFee2'];?>" onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 其他费用4:</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee4" id="otherFee4" type="text"  size="10" value="<?php echo $result['nds_otherFee4'];?>" onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 其他费用5:</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee5" id="otherFee5" type="text"  size="10" value="<?php echo $result['nds_otherFee5'];?>" onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 其他费用6:</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee6" id="otherFee6" type="text"  size="10" value="<?php echo $result['nds_otherFee6'];?>" onkeyup="return isnumber(this.value)" />元</td>
	</tr>
 -->
 	</tbody>
<!--   
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />限制售票数：</span></td>
    	<td bgcolor="#FFFFFF"><input name="StintSell" type="text"  value="<?php echo $result['nds_StintSell'];?>"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />限制售票时间：</span></td>
    	<td bgcolor="#FFFFFF"><input name="StintTime" type="text" value="<?php echo $result['nds_StintTime'];?>" /></td>
	</tr> 
-->
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"><?php echo $result['nds_Remark'];?></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="submit" type="submit" value="提交" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回"  onclick="return searrunsdock()"></td>
  </tr>
</table>
</form>
</div>

