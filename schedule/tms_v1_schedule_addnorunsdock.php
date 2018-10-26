<?php 
//添加班次停靠点界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$NoOfRunsID=$_GET['NoOfRunsID'];
	$LineID=$_GET['LineID'];
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
		if (!document.getElementById("RunHours").value.match(/^[1-9]+[0-9]*$/)){
			alert("请输入整数！");
			document.getElementById("RunHours").value='';
			return false;
		}
	//	gettimes();
	});
	$('#RunMinuts').keyup(function(){
		if (!document.getElementById("RunMinuts").value.match(/^[1-9]+[0-9]*$/)){
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
	$('#add').click(function(){
		gettimes();
	});
})
function gettimes(){
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
			'../basedata/tms_v1_bsaedata_dataProcess.php',
			{'op': 'gettimes','NoOfRunsID': $('#NoOfRunsID').val(),'RunHours':$('#RunHours').val(),'ID':$('#ID').val(),
				 'RunMinuts':$('#RunMinuts').val(),'opp':'add','time': Math.random()},
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
function addlinesite(){
	if(!document.getElementById("NoOfRunsID").value){
		alert("班次编号不能为空!");
		return false; 
	}
	if(!document.getElementById("PreviousSite").value){
		alert("前站点名不能为空!");
		return false; 
	}
	if(!document.getElementById("SiteNam").value){
		alert("站点名不能为空!");
		return false; 
	}
	if(document.getElementById("CheckInSit").checked && document.getElementById("CheckTicketWindow").value==""){
		alert("请输入该检票点的检票口信息!");
		return false; 
		}
}
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
function showsiteID(str){
	if(document.getElementById("PreviousSite").value==''){
		alert('请选择前站点！');
		document.getElementById("PreviousSite").value='';
		document.getElementById("SiteNam").value='';
		document.getElementById("SiteName").value='';
		document.getElementById("SiteID").value='';
		document.getElementById("SiteI").value='';
		document.getElementById("ID").value='';
		return false;
	}
	var st=str.split(',');
	jQuery.get(
		'../basedata/tms_v1_bsaedata_dataProcess.php',
		{'op': 'getsection','NoOfRunsID': $('#NoOfRunsID').val(),'ID':$('#ID').val(),
			'SectionID': st[2],'SiteID':st[1],'SiteName':st[0],'time': Math.random()},
		function(data){
			var objData = eval('(' + data + ')');
			if( objData.retVal=='FAIL'){
				alert(objData.retString);
				document.getElementById("PreviousSite").value='';
				document.getElementById("SiteNam").value='';
				document.getElementById("SiteName").value='';
				document.getElementById("SiteID").value='';
				document.getElementById("SiteI").value='';
				document.getElementById("ID").value='';
			}else{
				document.getElementById("SiteName").value=st[0];
				document.getElementById("SiteID").value=st[1];
				document.getElementById("SiteI").value=st[1];
			}
	});
}
function showSectionID(str){
	var st=str.split(',');
	document.getElementById("ID").value=parseInt(st[1])+1;
	document.getElementById("SiteNam").value='';
	document.getElementById("SiteName").value='';
	document.getElementById("SiteID").value='';
	document.getElementById("SiteI").value='';
}
function getvalue(ID,str){
	if(document.getElementById(ID).checked){
		document.getElementById(str).value=1;
	}else{
		document.getElementById(str).value=0;
	}	
}
//function getvalueanddis(){
//	if (document.getElementById("IsServiceFe").checked){
//		document.getElementById("IsServiceFee").value=1;
//		document.getElementById("Fees").style.display="";
//	}else{
//		document.getElementById("IsServiceFee").value=0;
//		document.getElementById("ServiceFee").value=0;
//	//	document.getElementById("otherFee1").value=0;
//	//	document.getElementById("otherFee2").value=0;
//		document.getElementById("otherFee3").value=0;
//	//	document.getElementById("otherFee4").value=0;
//	//	document.getElementById("otherFee5").value=0;
//	//	document.getElementById("otherFee6").value=0;
//		document.getElementById("Fees").style.display="none";
//	}	
//}
function getvalueanddis(){
	if (document.getElementById("IsServiceFe").checked){
		var SiteNam = $("#SiteName").val();
		jQuery.get(
				'../basedata/tms_v1_bsaedata_dataProcess.php',
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
						}
			});
	}else{
		document.getElementById("IsServiceFee").value=0
		document.getElementById("ServiceFee").value=0
		document.getElementById("otherFee3").value=0
		document.getElementById("Fees").style.display="none"
	}	
}
function getwindowvalue(){
	if (document.getElementById("CheckInSit").checked){
		var SiteNam = $("#SiteName").val();
		jQuery.get(
				'../basedata/tms_v1_bsaedata_dataProcess.php',
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
						}
			});
	}else{
		document.getElementById("CheckInSite").value=0;		
		document.getElementById("CheckTicketWindow").value="";
		document.getElementById("checkticketwindows").style.display="none";
	}	
}

</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 班 次 停 靠 点 </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<div id="addlinesite">
<form name="form1" action="tms_v1_schedule_addnorunsdockok.php" method="post">
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次编号：</span></td>
        <td bgcolor="#FFFFFF">
        	<input type="hidden" id="LineID" name="LineID" value="<?php echo $LineID;?>"/>
        	<input type="hidden" id="NoOfRunsID" name="NoOfRunsID" value="<?php echo $NoOfRunsID;?>"/>
			<input type="text" name="NoOfRunsI" disabled="disabled" value="<?php echo $NoOfRunsID;?>"/><span style="color:red">*</span></td>
	</tr>
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 前站点名：</span></td>
    	<td  bgcolor="#FFFFFF">
    		<select name="PreviousSite" id="PreviousSite" onchange="showSectionID(this.value)">
     			<option selected="selected"></option>
				<?php 
					$sqls = "SELECT nds_SiteName,nds_ID,si_SectionID FROM tms_bd_NoRunsDockSite,tms_bd_SectionInfo WHERE nds_NoOfRunsID='$NoOfRunsID' AND 
						si_SiteNameID=nds_SiteID AND si_LineID=(SELECT nri_LineID FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID='{$NoOfRunsID}') AND 
						nds_ID<(SELECT MAX(nds_ID) FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='$NoOfRunsID')";
					$querys = $class_mysql_default->my_query($sqls);
					while($results=mysqli_fetch_array($querys)){
						if($results['nds_SiteName']){	
				?>
				<option value="<?php echo $results['nds_SiteName'].','.$results['nds_ID'].','.$results['si_SectionID'];?>"><?php echo $results['nds_SiteName'];?></option>
				<?php 
						}
					}
				?>	
        	</select><input type="hidden" name="ID" id="ID"><span style="color:red">*</span></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点名：</span></td>
    	<td bgcolor="#FFFFFF"> 
    		<select name="SiteNam" id="SiteNam" onchange="showsiteID(this.value)">
     			 <option selected="selected"></option>
				<?php 
					$sql = "select si_SiteNameID, si_SiteName,si_SectionID FROM tms_bd_SectionInfo WHERE si_LineID='{$LineID}' AND si_SectionID>1 AND 
						si_SectionID<(SELECT MAX(si_SectionID) FROM tms_bd_SectionInfo WHERE si_LineID='$LineID')";
					$query = $class_mysql_default->my_query($sql);
					while($result=mysqli_fetch_array($query)){
						if($result['si_SiteName']){	
				?>
				<option value="<?php echo $result['si_SiteName'].','.$result['si_SiteNameID'].','.$result['si_SectionID'];?>"><?php echo $result['si_SiteName'];?></option>
				<?php 
						}
					}
				?>	
       		</select><input type="hidden" name="SiteName" id="SiteName"><span style="color:red">*</span></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点编号：</span></td>
    	<td bgcolor="#FFFFFF"><input name="SiteID" id="SiteID" type="hidden"/>
    			<input type="text" name="SiteI" id="SiteI" disabled="disabled"></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />运行时间：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="text" name="RunHours" id="RunHours" style="width:50px;"/>小时
    		<input type="text" name="RunMinuts" id="RunMinuts" style="width:50px;"/>分钟
    		<br><span style="color:red">（注：该时间为起点到本站时间）</span></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车时间：</span></td>
    	<td bgcolor="#FFFFFF"><input name="DepartureTime" type="text" id="DepartureTime" readonly="readonly"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsDock" id="IsDock" value="1"/></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="IsDoc" id="IsDoc" checked="checked" onclick="getvalue(this.id,'IsDock')" />是否停靠点 </td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="GetOnSite" id="GetOnSite" value="1"/></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="GetOnSit"id="GetOnSit" checked="checked" onclick="getvalue(this.id,'GetOnSite')"/>是否上车点</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="CheckInSite" id="CheckInSite" value="0"/></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="CheckInSit" id="CheckInSit" onclick="getwindowvalue()"/>是否检票点</td>
	</tr>
	<tbody id="checkticketwindows" style="DISPLAY: none">
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 检票口：</span></td>
    	<td bgcolor="#FFFFFF"><input name="CheckTicketWindow" id="CheckTicketWindow" type="text" /></td>
	</tr> 
	</tbody>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsServiceFee" id="IsServiceFee" value="0"/></td>
    	<td bgcolor="#FFFFFF"> <input type="checkbox" name="IsServiceFe" id="IsServiceFe" onclick="getvalueanddis()"/>是否收站务费</td>
	</tr> 
	<tbody id="Fees" style="DISPLAY: none">
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站务费：</span></td>
    	<td bgcolor="#FFFFFF"><input name="ServiceFee" id="ServiceFee" type="text"  size="10" onkeyup="return isnumber(this.value,this.id)" />元</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 劳务费：</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee3" id="otherFee3" type="text"  size="10" onkeyup="return isnumber(this.value,this.id)" />%
	</tr> 
<!-- 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 微机费：</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee1" id="otherFee1" type="text"  size="10" onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发班费：</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee2" id="otherFee2" type="text"  size="10" onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 其他费用4：</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee4" id="otherFee4" type="text"  size="10" onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 其他费用5：</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee5" id="otherFee5" type="text"  size="10" onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 其他费用6：</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee6" id="otherFee6" type="text"  size="10" onkeyup="return isnumber(this.value)" />元</td>
	</tr>
--> 
	</tbody>
<!-- <tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />限制售票数：</span></td>
    	<td bgcolor="#FFFFFF"><input name="StintSell" type="text" /></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />限制售票时间：</span></td>
    	<td bgcolor="#FFFFFF"><input name="StintTime" type="text" /></td>
	</tr> 
 -->	
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="add" id="add" type="button" value="添加" onclick="return addlinesite()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return searrunsdock()"></td>
  </tr>
</table>
</form>
</div>
