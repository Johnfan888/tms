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
	<script type="text/javascript" src="../js/jquery.js"></script>
	<link href="../js/ui/jquery-ui.css" rel="stylesheet" type="text/css" />
 	<script type="text/javascript" src="../js/jquery-1.8.2.js"></script>
	<script type="text/javascript" src="../js/ui/jquery-ui.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="../js/jQuery-Timepicker/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="../js/jQuery-Timepicker/jquery-ui-sliderAccess.js"></script>
	<script type="text/javascript" src="../js/jQuery-Timepicker/i18n/jquery-ui-timepicker-zh-CN.js"></script>
<script type="text/javascript" >
/*$(document).ready(function(){
	$('#DepartureTime').timepicker();
}); */
$(document).ready(function(){
	$('#RunHours').keyup(function(){
		if (!document.getElementById("RunHours").value.match(/^[0-9]*$/)){
			alert("请输入整数！");
			document.getElementById("RunHours").value='';
			return false;
		}
	//	gettimes();
	});
	$('#RunMinuts').keyup(function(){
		if (!document.getElementById("RunMinuts").value.match(/^[0-9]*$/)){
			alert("请输入整数！");
			document.getElementById("RunMinuts").value='';
			return false;
		}
		if(document.getElementById("RunMinuts").value*1>59){
			alert("该数字不能大于59！");
			document.getElementById("RunMinuts").value='';
			return false;
		}
	//	gettimes();
	});
	$('#mod').click(function(){
		gettimes();
	});
})
function gettimes(){
	if(!document.getElementById("NoOfRunsID").value){
		alert("班次编号不能为空!");
		document.getElementById("NoOfRunsID").focus();
		return false; 
	}
	if(!document.getElementById("PreviousSite").value){
		alert("前站点名不能为空!");
		document.getElementById("PreviousSite").focus();
		return false; 
	}
	if(document.getElementById("SiteNam").value==",undefined"){
		alert("站点名不能为空!");
		document.getElementById("SiteNam").focus();
		return false; 
	}	
	if((document.getElementById("CheckInSit").checked)&&(document.getElementById("CheckTicketWindow").value=="")){
		alert("请输入该检票点的检票口信息!");
		document.getElementById("CheckInSit").focus();
		return false; 
		}
	if(document.getElementById("otherFee3").value && document.getElementById("otherFee3").value > 100){
		alert("劳务费不应超过100%!");
		document.getElementById("otherFee3").value='';
		document.getElementById("otherFee3").focus();
		return false; 
	}
	if(document.getElementById("PreviousSite").value==''){
		alert('请选择前站点！');
		document.getElementById("RunHours").value='';
		document.getElementById("RunMinuts").value='';
		document.getElementById("DepartureTime").value='';
		return false;
	}
	if(document.getElementById("SiteNam").value==''){
		alert('请选择站点！');
		document.getElementById("RunHours").value='';
		document.getElementById("RunMinuts").value='';
		document.getElementById("DepartureTime").value='';
		return false;
	}
	if(document.getElementById("RunMinuts").value!='' ||document.getElementById("RunHours").value){
		jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'gettimes','NoOfRunsID': $('#NoOfRunsID').val(),'RunHours':$('#RunHours').val(),'ID':$('#ID').val(),
				 'RunMinuts':$('#RunMinuts').val(),'opp':'mod','time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if( objData.retVal=='FAIL'){
					alert(objData.retString);
					document.getElementById("RunHours").value='';
					document.getElementById("RunMinuts").value='';
					document.getElementById("DepartureTime").value='';
				}else{
					if(document.getElementById("RunHours").value=='' && document.getElementById("RunMinuts").value==''){
						document.getElementById("DepartureTime").value='';
					}else {
						document.getElementById("DepartureTime").value=objData.retString;
						document.form1.submit();
					}
				}
		});
	}else{
		document.getElementById("DepartureTime").value='';
		document.form1.submit();
	}
}

function isnumber(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value='';
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
function searrunsdock(){
	var str=document.getElementById("NoOfRunsID").value;
	window.location.href='tms_v1_basedata_searrunsdock.php?op=see&clnumber='+str;	
}
function showsiteID(str){
	var st=str.split(',')
	document.getElementById("SiteName").value=st[0]
	document.getElementById("SiteID").value=st[1]
	document.getElementById("SiteI").value=st[1]
}
function getvalue(ID,str){
	if(document.getElementById(ID).checked){
		document.getElementById(str).value=1
	}else{
		document.getElementById(str).value=0
	}	
}	
function getvalueup(ID,str){
	if(document.getElementById(ID).checked){
		document.getElementById(str).value=1;
	}else{
		document.getElementById(str).value=0;
		document.getElementById("CheckInSite").value=0;
		document.getElementById("CheckTicketWindow").value="";
		document.getElementById("checkticketwindows").style.display="none";
		document.getElementById("CheckInSit").checked=false;
		document.getElementById("IsServiceFee").value=0;
		document.getElementById("ServiceFee").value=0;
		document.getElementById("otherFee3").value=0;
		document.getElementById("Fees").style.display="none";
		document.getElementById("IsServiceFe").checked=false;		
	}	
}
//function getvalueanddis(){
//	if (document.getElementById("IsServiceFe").checked){
//		document.getElementById("IsServiceFee").value=1
//		document.getElementById("Fees").style.display=""
//	}else{
//		document.getElementById("IsServiceFee").value=0
//		document.getElementById("ServiceFee").value=0
//	//	document.getElementById("otherFee1").value=0
//	//	document.getElementById("otherFee2").value=0
//		document.getElementById("otherFee3").value=0
//	//	document.getElementById("otherFee4").value=0
//	//	document.getElementById("otherFee5").value=0
//	//	document.getElementById("otherFee6").value=0
//		document.getElementById("Fees").style.display="none"
//	}	
//}
function getwindowvalue(){
	if (document.getElementById("CheckInSit").checked){
		var SiteNam = $("#SiteName").val();
		jQuery.get(
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'getwindowvalue', 'SiteNam': SiteNam, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if( objData.sucess=='0'){
						alert('该站点不是车站，不能检票！');
						document.getElementById("CheckInSite").value=0;		
						document.getElementById("CheckTicketWindow").value="";
						document.getElementById("checkticketwindows").style.display="none";
						document.getElementById("CheckInSit").checked=false;
					}
					else{
						document.getElementById("CheckInSite").value=1;
						document.getElementById("checkticketwindows").style.display="";		
						document.getElementById("IsGetOnSit").checked=true;	
						document.getElementById("GetOnSite").value=1;			
						}
			});
	}else{
		document.getElementById("CheckInSite").value=0;		
		document.getElementById("CheckTicketWindow").value="";
		document.getElementById("checkticketwindows").style.display="none";
	}	
}
function getvalueanddis(){
	if (document.getElementById("IsServiceFe").checked){
		var SiteNam = $("#SiteName").val();
		jQuery.get(
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'getwindowvalue', 'SiteNam': SiteNam, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if( objData.sucess=='0'){
						alert('该站点不是车站，不能收站务费！');
						document.getElementById("IsServiceFee").value=0;
						document.getElementById("ServiceFee").value=0;
						document.getElementById("otherFee3").value=0;
						document.getElementById("Fees").style.display="none";
						document.getElementById("IsServiceFe").checked=false;
					}
					else{
						document.getElementById("IsServiceFee").value=1
						document.getElementById("Fees").style.display=""	
						document.getElementById("IsGetOnSit").checked=true;	
						document.getElementById("GetOnSite").value=1;		
						}
			});
	}else{
		document.getElementById("IsServiceFee").value=0
		document.getElementById("ServiceFee").value=0
		document.getElementById("otherFee3").value=0
		document.getElementById("Fees").style.display="none"
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
<?
//连接数据库，获取班次信息
?>
<div id="addlinesite">
<form name="form1" action="tms_v1_basedata_modnorunsdockok.php" method="post">
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次编号:</span></td>
        <td bgcolor="#FFFFFF">
        	<input type="hidden" id="NoOfRunsID" name="NoOfRunsID" value="<?php echo $result['nds_NoOfRunsID'];?>"/>
			<input type="text" name="NoOfRunsI" disabled="disabled" value="<?php echo $result['nds_NoOfRunsID'];?>"/>
			<input name="ID" id="ID" type="hidden" value="<?php echo $result['nds_ID'];?>"/><span style="color:red">*</span>
		</td>
	</tr>
	<?php 
		$sqlss= "select nds_SiteName FROM `tms_bd_NoRunsDockSite` WHERE nds_NoOfRunsID='{$NoOfRunsID}' and nds_ID=$noid-1";
		$queryss =$class_mysql_default->my_query($sqlss);
		$resultss=mysqli_fetch_array($queryss);
	?>
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 前站点名：</span></td>
    	<td  bgcolor="#FFFFFF">
    		<input name="PreviousSite" id="PreviousSite" type="hidden" value="<?php echo $resultss['nds_SiteName'];?>" />
    		<input name="PreviousSit" id="PreviousSit" type="text" value="<?php echo $resultss['nds_SiteName'];?>" disabled="disabled"/>
    		<span style="color:red">*</span>
    	</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点名：</span></td>
    	<td bgcolor="#FFFFFF"> 
    		<select name="SiteNam" id="SiteNam" onchange="showsiteID(this.value)">
     			 <option selected="selected" value="<?php echo $result['nds_SiteName'].','.$result['nds_SiteID'];?>"><?php echo $result['nds_SiteName'];?></option>
     			 <option ></option>
				<?php 
					$sqls = "select si_SiteNameID, si_SiteName FROM tms_bd_SectionInfo WHERE si_LineID=(SELECT nri_LineID FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID=$NoOfRunsID) AND si_SectionID>1 AND si_SectionID<(SELECT MAX(si_SectionID) FROM tms_bd_SectionInfo WHERE si_LineID=(SELECT nri_LineID FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID=$NoOfRunsID))";
					$querys= $class_mysql_default->my_query($sqls);
					while($results=mysqli_fetch_array($querys)){
						if($results['si_SiteName']){	
				?>
				<option value="<?php echo $results['si_SiteName'].','.$results['si_SiteNameID'];?>"><?php echo $results['si_SiteName'];?></option>
				<?php 
						}
					}
				?>	
       		</select><input type="hidden" name="SiteName" id="SiteName" value="<?php echo $result['nds_SiteName'];?>"><span style="color:red">*</span></td>
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
    		<input type="text" name="RunHours" id="RunHours" style="width:50px;" value="<?php if($RunHours[0]) echo $RunHours[0]; ?>" onkeyup="return isnumber(this.value,this.id)"/>小时
    		<input type="text" name="RunMinuts" id="RunMinuts" style="width:50px;" value="<?php if($RunHours[1]) echo $RunHours[1];?>" onkeyup="return isnumber(this.value,this.id)"/>分钟
    		<br />
    		<span style="color:red">（注：该时间为起点到本站时间）</span></td>
	</tr>   
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车时间：</span></td>
    	<td bgcolor="#FFFFFF"><input name="DepartureTime" id="DepartureTime" readonly="readonly" type="text" value="<?php echo $result['nds_DepartureTime'];?>" /></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsDock" id="IsDock" value="<?php echo $result['nds_IsDock'];?>"/></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="IsDoc" id="IsDoc" <?php if($result['nds_IsDock']!=0)echo "checked"; ?> onclick="getvalue(this.id,'IsDock')"/>是否停靠点 </td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="GetOnSite" id="GetOnSite" value="<?php echo $result['nds_GetOnSite'];?>"/> </td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="IsGetOnSit" id="IsGetOnSit" <?php if($result['nds_GetOnSite']!=0)echo "checked";?> onclick="getvalueup(this.id,'GetOnSite')"/>是否上车点</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="CheckInSite" id="CheckInSite" value="<?php echo $result['nds_CheckInSite'];?>"/></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="CheckInSit" id="CheckInSit" value="checkbox" <?php if($result['nds_CheckInSite']!=0)echo "checked";?> onclick="getwindowvalue()"/>是否检票点</td>
	</tr>
	<tbody id="checkticketwindows" style="DISPLAY: <?php if ($result['nds_CheckInSite']) echo ''; else echo 'none';?>"> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 检票口：</span></td>
    	<td bgcolor="#FFFFFF"><input name="CheckTicketWindow" id="CheckTicketWindow" type="text" value="<?php echo $result['nds_CheckTicketWindow'];?>"/></td>
	</tr> 
	</tbody>
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
    	<td bgcolor="#FFFFFF"><input name="otherFee3"  id="otherFee3" type="text"  size="10" value="<?php echo $result['nds_otherFee3']*100;?>" onkeyup="return isnum(this.value,this.id)"/>%
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
    	<td bgcolor="#FFFFFF"><input name="otherFee5"  id="otherFee5" type="text"  size="10" value="<?php echo $result['nds_otherFee5'];?>" onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 其他费用6:</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee6"  id="otherFee6" type="text"  size="10" value="<?php echo $result['nds_otherFee6'];?>" onkeyup="return isnumber(this.value)" />元</td>
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
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="mod" id="mod" type="button" value="提交" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回"  onclick="return searrunsdock()"></td>
  </tr>
</table>
</form>
</div>

