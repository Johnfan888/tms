<?php 
//添加线路站点界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$LineID=$_GET['LineID'];
	$LineName=$_GET['LineName'];
	//$a=2;
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
function showSiteID(str){ 
	var st=str.split(',');
	document.getElementById("SiteName").value=st[0];
	document.getElementById("SiteID").value=st[1];
	document.getElementById("SiteI").value=st[1];
}
function showSectionID(str){
	var st=str.split(',');
	document.getElementById("SectionID").value=parseInt(st[1])+1;
}
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
function getvalue(ID,str){
	if(document.getElementById(ID).checked){
		document.getElementById(str).value=1;
	}else{
		document.getElementById(str).value=0;
	}	
}
function getvalueup(ID,str){
	if(document.getElementById(ID).checked){
		document.getElementById(str).value=1;
	}else{
		document.getElementById(str).value=0;
		document.getElementById("IsCheckInSit").checked=false;
		document.getElementById("IsCheckInSite").value=0;
		document.getElementById("IsServiceFe").checked=false;
		document.getElementById("IsServiceFee").value=0;
		document.getElementById("ServiceFee").value=0;
		document.getElementById("otherFee3").value=0;
		document.getElementById("Fees").style.display="none";
	}	
}
function addlinesite(){
	if(!document.getElementById("LineID").value){
		alert("线路编号不能为空!");
		document.getElementById("LineID").focus();
		return false; 
	}
	if(!document.getElementById("PreviousSite").value){
		alert("前站点名不能为空!");
		document.getElementById("PreviousSite").focus();
		return false; 
	}
	if(!document.getElementById("SiteName").value){
		alert("站点名不能为空!");
		document.getElementById("SiteName").focus();
		return false; 
	}
	if(!document.getElementById("Kilometer").value){
		alert("公里数不能为空!");
		document.getElementById("Kilometer").focus();
		return false; 
	}
	if(document.getElementById("otherFee3").value && document.getElementById("otherFee3").value > 100){
		alert("劳务费不应超过100%!");
		document.getElementById("otherFee3").value='';
		document.getElementById("otherFee3").focus();
		return false; 
	}

	var a =document.getElementById('PreviousSite').value;
	var b=a.split(",");
	var SectionID=parseFloat(b[1]);
	var Kilometer=document.getElementById('Kilometer').value;
	var LineID=document.getElementById('LineID').value;
	jQuery.get(
		'tms_v1_basedata_getkilometer.php',
		{'op':'getkilometer','LineID':LineID,'SectionID': SectionID,'Kilometer':Kilometer,'time': Math.random()},
		function(data){
			var objData = eval('(' + data + ')');
			if(objData.retVal=='FAIL')
			{
				alert(objData.retString);
  				return fales;
			}
			else
			{
  		//	alert('添加成功')
  			document.form1.submit();
  			}
		}
	);
}
function linesite(){
	window.location.href='tms_v1_basedata_linesite.php?op=see&clnumber='+document.getElementById("LineID").value;
}
$(document).ready(function(){
	$("#SiteName").keyup(function(){
		//alert('ss');
		document.getElementById("SiteNam").style.display="none";
		$("#SiteNam").empty();
		document.getElementById("SiteNam").style.display="";
		var Site = $("#SiteName").val();
		jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'getsite', 'Site': Site, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				for (var i = 0; i < objData.length; i++) {
					$("<option value = "+ objData[i].SiteName +"," + objData[i].SiteID + ">" + objData[i].SiteName + "</option>").appendTo($("#SiteNam"));
				}
				if(Site==''){
					document.getElementById("SiteNam").style.display="none";
				}
			});	
	});
});
$(document).click(function(){
	document.getElementById("SiteNam").style.display="none";
});
function getwindowvalue(){
	if (document.getElementById("IsCheckInSit").checked){
		var SiteNam = $("#SiteName").val();
		jQuery.get(
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'getwindowvalue', 'SiteNam': SiteNam, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if( objData.sucess=='0'){
						alert('该站点不是车站，不能检票！');
						document.getElementById("IsCheckInSit").checked=false;
						document.getElementById("IsCheckInSite").value=0;
					}
					else{
						document.getElementById("IsCheckInSite").value=1;
						document.getElementById("IsGetOnSit").checked=true;	
						document.getElementById("IsGetOnSite").value=1;				
						}
			});
	}else{
		document.getElementById("IsCheckInSite").value=0;		
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
						document.getElementById("IsServiceFee").value=1;
						document.getElementById("Fees").style.display="";	
						document.getElementById("IsGetOnSit").checked=true;	
						document.getElementById("IsGetOnSite").value=1;		
					}
			});
	}else{
		document.getElementById("IsServiceFee").value=0;
		document.getElementById("ServiceFee").value=0;
		document.getElementById("otherFee3").value=0;
		document.getElementById("Fees").style.display="none";
	}	
}
</script>
<style type="text/css"> 
.helplay { 
z-index: 3; 
position: absolute; 
border: 1px solid #FFC30E; 
padding: 5px; 
background-color: #FFFBB8; 
text-align: left; 
color: blue; 
width: 134px; 
font-size: 10px; 
font-family: arial, sans-serif; 
} 
</style> 
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 线 路 站 点  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<form name="form1" action="tms_v1_basedata_addlinesiteok.php" method="post">
<table width="50%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路编号:</span></td>
        <td bgcolor="#FFFFFF">
        	<input name="LineID" id="LineID" type="hidden"  value="<?php echo $LineID;?>"/>
    		<input name="LineI" id="LineI" type="text" style="width:230px;" disabled="disabled" value="<?php echo $LineID;?>"/></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路名称：</span></td>
		<td bgcolor="#FFFFFF">
			<input name="LineName" type="hidden" value="<?php echo $LineName;?>" />
    		<input name="LineNam" type="text" disabled="disabled" value="<?php echo $LineName;?>" /></td>
	</tr>
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 前站点名：</span></td>
    	<td  bgcolor="#FFFFFF">
    		<select name="PreviousSite" id="PreviousSite" onchange="showSectionID(this.value)">
     			<option selected="selected"></option>
				<?php 
					$sqls = "select si_SectionID, si_SiteName FROM tms_bd_SectionInfo WHERE si_LineID='$LineID' and si_SectionID<(SELECT MAX(si_SectionID) FROM tms_bd_SectionInfo WHERE si_LineID='$LineID')";
					$querys = $class_mysql_default->my_query($sqls);
					while($results=mysqli_fetch_array($querys)){
						if($results['si_SiteName']){	
				?>
				<option value="<?php echo $results['si_SiteName'].','.$results['si_SectionID'];?>"><?php echo $results['si_SiteName'];?></option>
				<?php 
						}
					}
				?>	
        	</select><input type="hidden" name="SectionID" id="SectionID"> <span style="color:red">*</span></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点名：</span></td>
    	<td  bgcolor="#FFFFFF"><input type="text" name="SiteName" id="SiteName"><span style="color:red">*</span>
    		 <br>
        	<select id="SiteNam" name="SiteNam"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="showSiteID(this.value); this.style.display='none';"   >
			</select>
    	</td>
	</tr>  
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点编号：</span></td>
    	<td bgcolor="#FFFFFF"><input name="SiteID" id="SiteID" type="hidden"/>
    		<input name="SiteI" id="SiteI" type="text" disabled="disabled"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 里程：</span></td>
    	<td bgcolor="#FFFFFF"><input name="Kilometer" id="Kilometer" type="text" size="10" onkeyup="return isnumber(this.value,this.id)" />公里<span style="color:red">*</span></td>
	
	</tr> 
 	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsDock" id="IsDock" value="1"/></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="IsDoc" id="IsDoc" checked="checked" onclick="getvalue(this.id,'IsDock')" />是否停靠点 </td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsGetOnSite" id="IsGetOnSite" value="0"/></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="IsGetOnSit" id="IsGetOnSit" onclick="getvalueup(this.id,'IsGetOnSite')" />是否上车点</td>	     
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsCheckInSite" id="IsCheckInSite" value="0"/></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="IsCheckInSit" id="IsCheckInSit" onclick="getwindowvalue()" />是否检票点</td>
	</tr>
<!-- 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsTollInSite" id="IsTollInSite" value="0"/></td>
    	<td bgcolor="#FFFFFF"> <input type="checkbox" name="IsTollInSit" id="IsTollInSit" onclick="getvalue(this.id,'IsTollInSite')" />是否收费点</td>
	</tr> 
-->
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsServiceFee" id="IsServiceFee" value="0"/></td>
    	<td bgcolor="#FFFFFF"> <input type="checkbox" name="IsServiceFe" id="IsServiceFe" onclick="getvalueanddis(this.id,'IsServiceFee')" />是否收站务费</td>
	</tr> 
	<tbody id="Fees" style="DISPLAY: none">
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站务费：</span></td>
    	<td bgcolor="#FFFFFF"><input name="ServiceFee" id="ServiceFee" type="text"  size="10" onkeyup="return isnumber(this.value,this.id)" />元</td>
	</tr> 
<!--  
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />微机费:</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee1" id="otherFee1" type="text"  size="10" onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />发班费:</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee2" id="otherFee2" type="text"  size="10" onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
-->
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 劳务费：</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee3" id="otherFee3" type="text" size="10" onkeyup="return isnum(this.value,this.id)" /><span style="color:red">%</span></td>
	</tr> 
<!--  
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />其他费用4:</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee4" id="otherFee4" type="text"  size="10" onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />其他费用5:</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee5" id="otherFee5" type="text"  size="10" onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />其他费用6:</span></td>
    	<td bgcolor="#FFFFFF"><input name="otherFee6" id="otherFee6" type="text"  size="10" onkeyup="return isnumber(this.value)" />元</td>
	</tr> 
-->
	</tbody>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"></textarea></td>
	</tr>
 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="add" type="button" value="添加" onclick="return addlinesite()" />
     	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return linesite()"></td>
  </tr>
</table>
</form>


