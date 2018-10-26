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
	$results=mysqli_fetch_array($querys);
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
function showSiteID(str){ 
	var st=str.split(',');
	document.getElementById("SiteName").value=st[0];
	document.getElementById("SiteID").value=st[1];
	document.getElementById("SiteI").value=st[1];
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
function modlinesite(){
	if(!document.getElementById("LineID").value){
		alert("线路编号不能为空!");
		document.getElementById("LineID").focus();
		return false; 
	}
	if(document.getElementById("SectionID").value==""){
		alert("站点序号不能为空!");
		document.getElementById("SectionID").focus();
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
	
	var a =document.getElementById('SectionID').value;
	var SectionID=parseFloat(a);
	var Kilometer=document.getElementById('Kilometer').value;
	var LineID=document.getElementById('LineID').value;
	jQuery.get(
			'tms_v1_basedata_getkilometer.php',
			{'op':'mod','LineID':LineID,'SectionID':SectionID,'Kilometer':Kilometer,'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if(objData.retVal=='FAIL')
				{alert(objData.retString);
	  				return fales;
				}
				else
				{
					//alert('1')
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
<form action="tms_v1_basedata_modlinesiteok.php" method="post" name="form1" >
<table width="50%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路编号:</span></td>
        <td bgcolor="#FFFFFF">
        	<input name="LineID" id="LineID" type="hidden" value="<?php echo $results['si_LineID'];?>"/>
    		<input name="LineI" id="LineI" style="width:230px;" type="text" disabled="disabled" value="<?php echo $results['si_LineID'];?>"/></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路名称：</span></td>
		<td bgcolor="#FFFFFF">
			<input name="LineName" type="hidden"  value="<?php echo $results['si_LineName'];?>" />
    		<input name="LineNam" type="text" disabled="disabled" value="<?php echo $results['si_LineName'];?>" /></td>
	</tr>
	<?php 
		$sqlss= "select si_SiteName FROM `tms_bd_SectionInfo` WHERE si_LineID='{$LineID}' and si_SectionID=$section-1";
		$queryss =$class_mysql_default->my_query($sqlss);
		$resultss=mysqli_fetch_array($queryss);
	?>
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 前站点名：</span></td>
    	<td  bgcolor="#FFFFFF">
				<input name="PreviousSite" id="PreviousSite" type="text" value="<?php echo $resultss['si_SiteName'];?>" disabled="disabled"/>
				<input name="SectionID" id="SectionID" type="hidden" value="<?php echo $results['si_SectionID'];?>"/><span style="color:red">*</span></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点名：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="SiteName" id="SiteName" value="<?php echo $results['si_SiteName'];?>"><span style="color:red">*</span>
    		 <br>
        	<select id="SiteNam" name="SiteNam"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="showSiteID(this.value); this.style.display='none';"   >
			</select>
		</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点编号：</span></td>
    	<td bgcolor="#FFFFFF"><input name="SiteID" id="SiteID" type="hidden" value="<?php echo $results['si_SiteNameID'];?>"/>
    		<input name="SiteIDD" id="SiteIDD" type="hidden" value="<?php echo $results['si_SiteNameID'];?>"/>
    		<input name="SiteI" id="SiteI" type="text" disabled="disabled" value="<?php echo $results['si_SiteNameID'];?>"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路里程 ：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Kilometer" id="Kilometer" size="10" value="<?php echo $results['si_Kilometer'];?>" onkeyup="return isnumber(this.value,this.id)" />公里<span style="color:red">*</span></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsDock" id="IsDock" value="<?php echo $results['si_IsDock'];?>"/></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="IsDoc" id="IsDoc" <?php if($results['si_IsDock']!=0)echo "checked"; ?> onclick="getvalue(this.id,'IsDock')"/>是否停靠点 </td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsGetOnSite" id="IsGetOnSite" value="<?php echo $results['si_IsGetOnSite'];?>"/></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="IsGetOnSit" id="IsGetOnSit"  <?php if($results['si_IsGetOnSite']!=0)echo "checked"; ?> onclick="getvalueup(this.id,'IsGetOnSite')"/>是否上车点</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsCheckInSite" id="IsCheckInSite" value="<?php echo $results['si_IsCheckInSite'];?>"/></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="IsCheckInSit" id="IsCheckInSit" <?php if($results['si_IsCheckInSite']!=0)echo "checked"; ?> onclick="getwindowvalue()" />是否检票点</td>
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
    	<td bgcolor="#FFFFFF"><input name="otherFee3" id="otherFee3" type="text"  size="10"  value="<?php echo $results['si_otherFee3']*100;?>" onkeyup="return isnum(this.value,this.id)" /><span style="color:red">%</span></td>
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
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="button1" type="button" value="修改" onclick="return modlinesite()"/>
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return linesite()"></td>
  </tr>
</table>
</form>

