﻿<?php 
//添加班次调价界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber1=$_GET['clnumber1'];
	$clnumber2=$_GET['clnumber2'];
?>

<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" >
/*function getid(){
	if(!document.getElementById("Mode").value){
		document.getElementById("Model").value='';
		document.getElementById("ModelID").value='';
		document.getElementById("ModelI").value='';
	}else{
		var str=document.getElementById("Mode").value.split(',')
		document.getElementById("Model").value=str[0]
		document.getElementById("ModelID").value=str[1]
		document.getElementById("ModelI").value=str[1]
	}
} */
function selectadjust(){
	if(document.getElementById("ISUnit").checked){
		document.getElementById("ISUnitAdjust").value='1';
		document.getElementById("adjustunit").style.display='';
		document.getElementById("Unit").value=document.getElementById("Units").value;
		document.getElementById("Unitt").value=document.getElementById("Units").value;
	}else{
		document.getElementById("ISUnitAdjust").value='0';
		document.getElementById("adjustunit").style.display='none';
		document.getElementById("Unit").value='';
		document.getElementById("Unitt").value='';
	}
	if(document.getElementById("ISNoRuns").checked){
		document.getElementById("ISNoRunsAdjust").value='1';
		document.getElementById("adjustunit").style.display='none';
		document.getElementById("Unit").value='';
		document.getElementById("Unitt").value='';
	}else{
		document.getElementById("ISNoRunsAdjust").value='0';
		document.getElementById("adjustunit").style.display='';
		document.getElementById("Unit").value=document.getElementById("Units").value;
		document.getElementById("Unitt").value=document.getElementById("Units").value;
	}
}
/*function getvalue(){
	if(document.getElementById("IsSucceedLineprice").checked){
		document.getElementById("Fees").style.display='none';
		document.getElementById("IsSucceedprice").value=1;
	}else{
		document.getElementById("Fees").style.display='';
		document.getElementById("IsSucceedprice").value=0;
		document.getElementById("DepartureSiteID").value='';
		document.getElementById("DepartureSiteI").value='';
		document.getElementById("DepartureSit").value='';
		document.getElementById("DepartureSite").value='';
		document.getElementById("GetToSiteID").value='';
		document.getElementById("GetToSiteI").value='';
		document.getElementById("GetToSit").value='';
		document.getElementById("GetToSite").value='';
		document.getElementById("BeginDate").value='';
		document.getElementById("EndDate").value='';
		document.getElementById("ReferPrice").value='';
		document.getElementById("RunPrice").value='';
		document.getElementById("HalfPrice").value='';
		document.getElementById("BalancePrice").value='';	
	}
} */
function isnumber(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value='';
		return false;
		}
}

function sear(){
	window.location.href='tms_v1_schedule_modprice.php?clnumber='+document.getElementById("NoRunsAdjust").value;
}
function getdepartureid(){
	if(document.getElementById("DepartureSit").value==''){
		document.getElementById("DepartureSite").value='';
		document.getElementById("DepartureSiteID").value='';
		document.getElementById("DepartureSiteI").value='';
		document.getElementById("DepartureSectionID").value='';
	}else{
		var str=document.getElementById("DepartureSit").value.split(',');
		document.getElementById("DepartureSite").value=str[0];
		document.getElementById("DepartureSiteID").value=str[1];
		document.getElementById("DepartureSiteI").value=str[1];
		document.getElementById("DepartureSectionID").value=str[2];
		if(document.getElementById("GetToSectionID").value!=''){
			if(document.getElementById("DepartureSectionID").value>=document.getElementById("GetToSectionID").value){
				alert('发车站不能在到达站之后！');
				document.getElementById("DepartureSit").value='';
				document.getElementById("DepartureSite").value='';
				document.getElementById("DepartureSiteID").value=''
				document.getElementById("DepartureSiteI").value=''
				document.getElementById("DepartureSectionID").value='';
				return false;
			}
		}
	}
}
function getgettositid(){
	if(document.getElementById("GetToSit").value==''){
		document.getElementById("GetToSite").value='';
		document.getElementById("GetToSiteID").value='';
		document.getElementById("GetToSiteI").value='';
		document.getElementById("GetToSectionID").value='';
	}else{
		var str=document.getElementById("GetToSit").value.split(',');
		document.getElementById("GetToSite").value=str[0];
		document.getElementById("GetToSiteID").value=str[1];
		document.getElementById("GetToSiteI").value=str[1];
		document.getElementById("GetToSectionID").value=str[2];
		if(document.getElementById("DepartureSectionID").value!=''){
			if(document.getElementById("DepartureSectionID").value>=document.getElementById("GetToSectionID").value){
				alert('发车站不能在到达站之后！');
				document.getElementById("GetToSit").value='';
				document.getElementById("GetToSite").value='';
				document.getElementById("GetToSiteID").value=''
				document.getElementById("GetToSiteI").value=''
				document.getElementById("GetToSectionID").value='';
				return false;
			}
		}
	}
}
$(document).ready(function(){
/*	$("#ISUnit").click(function(){
		$("#Mode").empty();
		append();
	});
	$("#ISNoRuns").click(function(){
		$("#Mode").empty();
		append();
	}); */
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
	$("#add").click(function(){
	/*	if(document.getElementById("ISUnitAdjust").value=='1'){
			if(document.getElementById("Unit").value==''){
				alert('请选择协议单位！');
				return false;
			}
		}
		if(document.getElementById("Mode").value==''){
			alert('请选择车型！');
			return false;
		} */
		
	//	if(document.getElementById("IsSucceedprice").value=='0'){
			if(document.getElementById("DepartureSit").value==''){
				alert('请选择发车站！');
				return false;
			}
			if(document.getElementById("GetToSit").value==''){
				alert('请选择到达站！');
				return false;
			}
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
	//	}
		jQuery.get(
			'tms_v1_schedule_addnorunsadjustpriceok.php',
			{'op': 'addrunprice', 'LineAdjust':$("#LineAdjust").val(), 'NoRunsAdjust':$("#NoRunsAdjust").val(),'ISUnitAdjust':$("#ISUnitAdjust").val(),
				'ISNoRunsAdjust':$("#ISNoRunsAdjust").val(),'IsSucceedprice':$("#IsSucceedprice").val(),
				'Unit':$("#Unit").val(),'DepartureSite':$("#DepartureSite").val(),'DepartureSiteID':$("#DepartureSiteID").val(),'GetToSite':$("#GetToSite").val(),
				'GetToSiteID':$("#GetToSiteID").val(),'ModelID':$("#ModelID").val(),'Model':$("#Model").val(),'BeginDate':$("#BeginDate").val(),
				'EndDate':$("#EndDate").val(),'ReferPrice':$("#ReferPrice").val(),'RunPrice':$("#RunPrice").val(),'HalfPrice':$("#HalfPrice").val(),
				'BalancePrice':$("#BalancePrice").val(),'Remark':$("#Remark").val(),'time': Math.random()},
			function(data){
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
						window.location.href='tms_v1_schedule_addnorunsadjustprice.php?clnumber1='+document.getElementById("NoRunsAdjust").value+'&clnumber2='+document.getElementById("LineAdjust").value;
					}
				}
		}); 
	});
});
/*function getbusmodels(){
	$("#Mode").empty();
	append();
}
function append(){
	jQuery.get(
		'../basedata/tms_v1_bsaedata_dataProcess.php',
		{'op': 'appendselect', 'ISUnitAdjust':$("#ISUnitAdjust").val(),'ISNoRunsAdjust':$("#ISNoRunsAdjust").val(),
			'LineAdjust':$("#LineAdjust").val(),'Unit':$("#Unit").val(),'time': Math.random()},
		function(data){
			var objData = eval('(' + data + ')');
			if(objData.retVal=='FAIL'){
				alert(objData.retString);
			}else{
				$("<option></option>").appendTo($("#Mode"));
				for (var i = 0; i < objData.length; i++) {
					$("<option value = " + objData[i].ModelName + "," + objData[i].ModelID + ">" + objData[i].ModelName + "</option>").appendTo($("#Mode"));
				}
			}
	});
} */
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 班 次 调 价 </span></td>
  </tr>
</table>
<?php
//连接数据库，获取班次信息
?>
<div><form name="addL" id="addL" action="" method="post">
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />调价线路编号：</span></td>
		<td bgcolor="#FFFFFF"><input type="hidden" name="LineAdjust" id="LineAdjust"  value="<?php echo $clnumber2;?>"/>
		<input type="text" name="LineAdjust1" style="width:230px" id="LineAdjust1" disabled="disabled" value="<?php echo $clnumber2;?>"/>
		</td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />调价班次编号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="hidden" name="NoRunsAdjust" id="NoRunsAdjust" readonly="readonly" value="<?php echo $clnumber1;?>"/>
    	<input type="text" name="NoRunsAdjust1"  id="NoRunsAdjust1" disabled="disabled" value="<?php echo $clnumber1;?>"/></td>
	</tr> 
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"></td>
		<td bgcolor="#FFFFFF"><input type="radio" name="radio1" id="ISUnit" checked="checked" onclick="selectadjust()">按协议调价
    		<input type="radio" name="radio1" id="ISNoRuns" onclick="selectadjust()">按班次调价
    		<input type="hidden" name="ISUnitAdjust" id="ISUnitAdjust" value="1"/>
    		<input type="hidden" name="ISNoRunsAdjust" id="ISNoRunsAdjust"  value="0"/>
    	</td>
	</tr>
	<tr id="adjustunit" style="display:">
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />调价协议单位：</span></td>
		<td bgcolor="#FFFFFF">
			<?php
				$select="SELECT nrl_Unit,nrl_ModelID,nrl_ModelName FROM tms_bd_NoRunsLoop WHERE nrl_NoOfRunsID='{$clnumber1}' AND nrl_LoopID='1'";
				$querysql=$class_mysql_default->my_query($select);
				$row=mysqli_fetch_array($querysql);
			?>
			<input type="hidden" name="Units" id="Units" value="<?php echo $row['nrl_Unit'];?>"/>
			<input type="hidden" name="Unit" id="Unit" value="<?php echo $row['nrl_Unit'];?>"/>
			<input type="text" name="Unitt" id="Unitt" disabled="disabled" value="<?php echo $row['nrl_Unit'];?>"/>
			<span style="color:red">*</span> 
		</td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车型名：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="hidden" name="Model" id="Model" value="<?php echo $row['nrl_ModelName'];?>"/>
    		<input type="text" name="Modell" id="Modell" disabled="disabled" value="<?php echo $row['nrl_ModelName'];?>"/>
      		<span style="color:red">*</span>
      	</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车型编号：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="hidden" name="ModelID" id="ModelID" value="<?php echo $row['nrl_ModelID'];?>"/>
    		<input  type="text" name="ModelI" id="ModelI" disabled="disabled" value="<?php echo $row['nrl_ModelID'];?>"/></td>
	</tr>
<!--  
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsSucceedprice" id="IsSucceedprice" value="1"/></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="checkbox" name="IsSucceedLineprice" id="IsSucceedLineprice" checked="checked" onclick="getvalue()" />是否从线路继承票价 </td>
	</tr>	
	<tbody id="Fees" style="DISPLAY: none">
--> 
		<tr> 
	    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />发车站名 ：</span></td>
	    	<td bgcolor="#FFFFFF">
	    		<select name="DepartureSit" id="DepartureSit" onchange="getdepartureid()">
	      			<option></option>
	      			<?php 
	      				$sqls = "SELECT nds_SiteName,nds_SiteID,nds_ID FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$clnumber1}' and nds_GetOnSite='1'";
						$querys = $class_mysql_default->my_query($sqls);
						//$result=mysqli_fetch_array($query);
						while($results=mysqli_fetch_array($querys)){
					?>	
					<option value="<?php echo $results['nds_SiteName'].','.$results['nds_SiteID'].','.$results['nds_ID'];?>"><?php echo $results['nds_SiteName'];?></option>
					<?php 
						}
					?>			
	      		</select> 
				<input type="hidden" name="DepartureSite" id="DepartureSite" />
	      		<input type="hidden" name="DepartureSectionID" id="DepartureSectionID" />
	      		<span style="color:red">*</span>
	      	</td>
		</tr>
		<tr> 
	    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />发车站编号：</span></td>
	    	<td bgcolor="#FFFFFF">
	    		<input type="hidden" name="DepartureSiteID" id="DepartureSiteID" />
	    		<input  type="text" name="DepartureSiteI" id="DepartureSiteI" disabled="disabled"/></td>
		</tr>  
		<tr> 
	    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />到达站名：</span></td>
	    	<td bgcolor="#FFFFFF">
	    		<select name="GetToSit" id="GetToSit" onchange="getgettositid()">
	      			<option></option>
	      			<?php 
	      				$sqlss = "SELECT nds_SiteName,nds_SiteID,nds_ID FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$clnumber1}' and nds_IsDock='1'";
						$queryss =$class_mysql_default->my_query($sqlss);
						//$result=mysqli_fetch_array($query);
						while($resultss=mysqli_fetch_array($queryss)){
					?>	
					<option value="<?php echo $resultss['nds_SiteName'].','.$resultss['nds_SiteID'].','.$resultss['nds_ID'];?>"><?php echo $resultss['nds_SiteName'];?></option>
					<?php 
						}
					?>		
	      		</select>
				<input type="hidden" name="GetToSite" id="GetToSite" />
	      		<input type="hidden" name="GetToSectionID" id="GetToSectionID" />
	      		<span style="color:red">*</span>
	      	</td>
		</tr>
		<tr> 
	    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />到达站编号：</span></td>
	    	<td bgcolor="#FFFFFF">
	    		<input type="hidden" name="GetToSiteID" id="GetToSiteID" />
	    		<input  type="text" name="GetToSiteI" id="GetToSiteI" disabled="disabled"/></td>
		</tr>  
		<tr> 
	    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />开始日期：</span></td>
	    	<td bgcolor="#FFFFFF">
	    		<input type="text" name="BeginDate" id="BeginDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
	    		<span style="color:red">*</span>
	    	</td>
		</tr>
		<tr> 
	    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />结束日期：</span></td>
	    	<td bgcolor="#FFFFFF">
	    		<input type="text" name="EndDate" id="EndDate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
	    		<span style="color:red">*</span>
	    	</td>
		</tr>
	<!--
		<tr> 
	    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />开始时间：</span></td>
	    	<td bgcolor="#FFFFFF"><input type="text" name="BeginTime"/></td>
		</tr>
		<tr> 
	    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />结束时间：</span></td>
	    	<td bgcolor="#FFFFFF"><input type="text" name="EndTime"/></td>
		</tr> 
	 	<tr> 
	    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />参考票价：</span></td>
	    	<td bgcolor="#FFFFFF"><input type="text" name="ReferPrice" onkeyup="return isnumber(this.value)"/></td>
		</tr> 
		<tr> 
	    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />上调百分比：</span></td>
	    	<td bgcolor="#FFFFFF"><input type="text" name="PriceUpPercent" onkeyup="return isnumber(this.value)"/></td>
		</tr>
	 --> 
	 	<tr> 
	    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />标准价：</span></td>
	    	<td bgcolor="#FFFFFF">
	    		<input type="text" name="ReferPrice" id="ReferPrice" onkeyup="return isnumber(this.value,this.id)"/>
	    		<span style="color:red">*</span>
	    	</td>
		</tr> 
		<tr> 
	    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />执行价：</span></td>
	    	<td bgcolor="#FFFFFF">
	    		<input type="text" name="RunPrice" id="RunPrice" onkeyup="return isnumber(this.value,this.id)"/>
	    		<span style="color:red">*</span>
	    	</td>
		</tr> 
		<tr> 
	    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />半价：</span></td>
	    	<td bgcolor="#FFFFFF"><input type="text" name="HalfPrice" id="HalfPrice" readonly="readonly"/></td>
		</tr>
		<tr> 
	    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />结算价：</span></td>
	    	<td bgcolor="#FFFFFF"><input type="text" name="BalancePrice" id="BalancePrice" onkeyup="return isnumber(this.value,this.id)"/></td>
		</tr>
<!--
	</tbody>
  --> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" id="Remark" cols="" rows="5"></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="add" id="add" type="button" value="添加"  />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return sear()"></td>
  </tr>
</table>
</form>
</div>