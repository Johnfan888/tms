<?php 
//修改线路界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber = $_GET['clnumber'];
	$sqll="select * FROM tms_bd_LineInfo WHERE li_LineID='{$clnumber}'";
	$queryl =$class_mysql_default$class_mysql_default->my_query($sqll);
	$results=mysqli_fetch_array($queryl); 
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
function showSiteID(str,Site,SiteID,SiteI,HelpCode){ 
	var st=str.split(',')
	document.getElementById(Site).value=st[1]
	document.getElementById(SiteID).value=st[0]
	document.getElementById(SiteI).value=st[0]
	document.getElementById(HelpCode).value=st[2]
	document.getElementById("Region").style.display="none";
}
function showLineName(){ 
	if(!document.addL.BeginSite.value){
		alert('起点站名不能为空!!')
		return
	}
	if(!document.addL.EndSite.value){
		alert('终点站名不能为空!!')
		return
	}
	
	if(document.addL.BeginSite.value==document.addL.EndSite.value){
		alert('起点站与终点站名不能相同!!')
		return
	}
	document.getElementById("LineName").value=document.addL.BeginSite.value+"--"+document.addL.EndSite.value
	document.getElementById("LineNam").value=document.getElementById("LineName").value
}
function addline(){
	if(document.getElementById("LineID").value == ""){
		alert("线路编号不能为空!");
		return false; 
	}
	if(document.getElementById("LineName").value== ""){
		alert("线路名不能为空!");
		return false; 
	}
	if(document.getElementById("Statio").value== ""){
		alert("所属车站不能为空!");
		return false; 
	}	
	if(document.getElementById("Kilometer").value== ""){
		alert("里程数不能为空!");
		return false; 
	}	
}

function isnumber(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value= "";
		return false;
		}
}

function searline(){
	window.location.href='tms_v1_basedata_searline.php';
}
$(document).ready(function(){
	$("#BeginSite").focus();
	$("#BeginSite").keyup(function(){
		document.getElementById("EndSit").style.display="none";
		$("#BeginSit").empty();
		document.getElementById("BeginSit").style.display="";
		var Site = $("#BeginSite").val();
		jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'getsite', 'Site': Site, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				for (var i = 0; i < objData.length; i++) {
					$("<option value = "+ objData[i].SiteID +"," + objData[i].SiteName + ">" + objData[i].SiteName + "</option>").appendTo($("#BeginSit"));
				}
				if(Site==''){
					document.getElementById("BeginSit").style.display="none";
				}
			});	
	});
});
$(document).ready(function(){
	$("#EndSite").keyup(function(){
		document.getElementById("BeginSit").style.display="none";
		$("#EndSit").empty();
		document.getElementById("EndSit").style.display="";
		var Site = $("#EndSite").val();
		jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'getsite', 'Site': Site, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				for (var i = 0; i < objData.length; i++) {
					$("<option value = "+ objData[i].SiteID +"," + objData[i].SiteName + ">" + objData[i].SiteName + "</option>").appendTo($("#EndSit"));
				}
				if(Site==''){
					document.getElementById("EndSit").style.display="none";
				}
			});	
	});
});
//$(document).click(function(){
//	document.getElementById("BeginSit").style.display="none";
//	document.getElementById("EndSit").style.display="none";
//	document.getElementById("Region").style.display="none";
//});

$(document).ready(function(){
	$("#InRegion").keyup(function(){
		$("#Region").empty();
		document.getElementById("Region").style.display="";
		var SiteId = $("#InRegion").val();
		//alert(SiteId.length);
		jQuery.get(
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'getRegion', 'SiteId': SiteId, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						alert(objData.retString);
					}
					if(objData.retVal == "FAIL1"){
						//alert('h');
						document.getElementById("Region").style.display="none";
					}
					else{
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].RegionName + ">" + objData[i].RegionName + "</option>").appendTo($("#Region"));
						}
					}
				});
		});
});
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
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">修 改 线 路  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<div><form name="addL" id="addL" action="tms_v1_basedata_modlineok.php" method="post">
<table width="50%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />起点站名：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="hidden" name="BeginSite" id="BeginSite" value="<?php echo $results['li_BeginSite'];?>" >
    		<input type="text" name="BeginSit" id="BeginSit" value="<?php echo $results['li_BeginSite'];?>" disabled="disabled">
    		<span style="color:red">*</span>
    		 <!--  
    		 <br>
        	<select id="BeginSit" name="BeginSit"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="showSiteID(this.value,'BeginSite','BeginSiteID','BeginSiteI'); this.style.display='none';"   >
			</select>
			-->
    	</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 起点站编号：</span></td>
    	<td bgcolor="#FFFFFF">
			<input name="BeginSiteID" id="BeginSiteID" type="hidden" value="<?php echo $results['li_BeginSiteID'];?>"/>
    		<input name="BeginSiteI" id="BeginSiteI" disabled="disabled" value="<?php echo $results['li_BeginSiteID'];?>"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 终点站名：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="hidden" name="EndSite" id="EndSite" value="<?php echo $results['li_EndSite'];?>" >
    		<input type="text" name="EndSit" id="EndSit" value="<?php echo $results['li_EndSite'];?>" disabled="disabled">
    		<span style="color:red">*</span>
    		<!--  
    		<br>
    		<select id="EndSit" name="EndSit"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="showSiteID(this.value,'EndSite','EndSiteID','EndSiteI'); this.style.display='none';"   >
			</select>
			-->
    	</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 终点站编号：</span></td>
    	<td bgcolor="#FFFFFF">
			<input name="EndSiteID" id="EndSiteID" type="hidden" value="<?php echo $results['li_EndSiteID'];?>"/>
    		<input name="EndSiteI" id="EndSiteI" disabled="disabled" value="<?php echo $results['li_EndSiteID'];?>"/></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路名称：</span></td>
		<td bgcolor="#FFFFFF">
			<input name="LineName" id="LineName" type="hidden"  value="<?php echo $results['li_LineName'];?>" onclick="showLineName()"/>
			<input name="LineNam" id="LineNam" type="text" disabled="disabled" value="<?php echo $results['li_LineName'];?>" onclick="showLineName()"/>
			<span style="color:red">*</span>
		</td>
	</tr>
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路编号：</span></td>
        <td bgcolor="#FFFFFF">
        	<input name="LineIDI" style="width:230px;" id="LineIDI"  value="<?php echo $clnumber;?>" disabled="disabled"/>
        	<input name="LineID" id="LineID" type="hidden" value="<?php echo $clnumber;?>"  style="width:200px"/>
    		<input name="LineI" id="LineI"type="hidden" value="<?php echo $clnumber;?>"/><span style="color:red">*</span></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路等级：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="LineDegree">
    			<?php 
    			if($results['li_LineDegree'] == ""){
    			?>
    			<option selected="selected"></option>
      			<option value="一类">一类</option>
      			<option value="二类">二类</option>
      			<option value="三类">三类</option>
      			<option value="四类">四类</option>
    			<?php 
    			}
    			if($results['li_LineDegree'] == "一类"){
    			?>
    			<option></option>
      			<option value="一类" selected="selected">一类</option>
      			<option value="二类">二类</option>
      			<option value="三类">三类</option>
      			<option value="四类">四类</option>
    			<?php 
    			}
    			if($results['li_LineDegree'] == "二类"){
    			?>
    			<option></option>
      			<option value="一类">一类</option>
      			<option value="二类" selected="selected">二类</option>
      			<option value="三类">三类</option>
      			<option value="四类">四类</option>
    			<?php 
    			}
    			if($results['li_LineDegree'] == "三类"){
    			?>
    			<option></option>
      			<option value="一类">一类</option>
      			<option value="二类">二类</option>
      			<option value="三类" selected="selected">三类</option>
      			<option value="四类">四类</option>
    			<?php 
    			}
    			if($results['li_LineDegree'] == "四类"){
    			?>
    			<option></option>
      			<option value="一类">一类</option>
      			<option value="二类">二类</option>
      			<option value="三类">三类</option>
      			<option value="四类" selected="selected">四类</option>
    			<?php 
    			}
    			?>
    			</select></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />线路种类：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="LineKind">
      			<?php 
      			if($results['li_LineKind']==""){
      			?>
      			<option selected="selected"></option>
      			<option value="高速">高速</option>
      			<option value="普通">普通</option>
      			<option value="快巴">快巴</option>
      			<option value="信誉">信誉</option>
      			<option value="加班">加班</option>
      			<option value="其他">其他</option>
      			<?php 
      			}
      			if($results['li_LineKind']=="高速"){
      			?>
      			<option ></option>
      			<option value="高速" selected="selected">高速</option>
      			<option value="普通">普通</option>
      			<option value="快巴">快巴</option>
      			<option value="信誉">信誉</option>
      			<option value="加班">加班</option>
      			<option value="其他">其他</option>
      			<?php 
      			}
      			if($results['li_LineKind']=="普通"){
      			?>
      			<option ></option>
      			<option value="高速">高速</option>
      			<option value="普通" selected="selected">普通</option>
      			<option value="快巴">快巴</option>
      			<option value="信誉">信誉</option>
      			<option value="加班">加班</option>
      			<option value="其他">其他</option>
      			<?php 
      			}
      			if($results['li_LineKind']=="快巴"){
      			?>
      			<option></option>
      			<option value="高速">高速</option>
      			<option value="普通">普通</option>
      			<option value="快巴" selected="selected">快巴</option>
      			<option value="信誉">信誉</option>
      			<option value="加班">加班</option>
      			<option value="其他">其他</option>
      			<?php 
      			}
      			if($results['li_LineKind']=="信誉"){
      			?>
      			<option></option>
      			<option value="高速">高速</option>
      			<option value="普通">普通</option>
      			<option value="快巴">快巴</option>
      			<option value="信誉" selected="selected">信誉</option>
      			<option value="加班">加班</option>
      			<option value="其他">其他</option>
      			<?php 
      			}
      			if($results['li_LineKind']=="加班"){
      			?>
      			<option></option>
      			<option value="高速">高速</option>
      			<option value="普通">普通</option>
      			<option value="快巴">快巴</option>
      			<option value="信誉">信誉</option>
      			<option value="加班" selected="selected">加班</option>
      			<option value="其他">其他</option>
      			<?php 
      			}
      			if($results['li_LineKind']=="其他"){
      			?>
      			<option></option>
      			<option value="高速">高速</option>
      			<option value="普通">普通</option>
      			<option value="快巴">快巴</option>
      			<option value="信誉">信誉</option>
      			<option value="加班">加班</option>
      			<option value="其他" selected="selected">其他</option>      			
      			<?php 
      			}
      			?>
     	 	</select></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />线路类别：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="LineType">
      			<?php 
      			if($results['li_LineType']==""){
      			?>
      			<option selected="selected"></option>
      			<option value="国际">国际</option>
      			<option value="省际">省际</option>
      			<option value="市际">市际</option>
      			<option value="县际">县际</option>
      			<option value="县内">县内</option>
      			<option value="其他">其他</option>
      			<?php 
      			}
      			if($results['li_LineType']=="国际"){
				?>
				<option></option>
      			<option value="国际" selected="selected">国际</option>
      			<option value="省际">省际</option>
      			<option value="市际">市际</option>
      			<option value="县际">县际</option>
      			<option value="县内">县内</option>
      			<option value="其他">其他</option>
      			<?php 
      			}
      			if($results['li_LineType']=="省际"){
				?>
				<option></option>
      			<option value="国际">国际</option>
      			<option value="省际" selected="selected">省际</option>
      			<option value="市际">市际</option>
      			<option value="县际">县际</option>
      			<option value="县内">县内</option>
      			<option value="其他">其他</option>
      			<?php 
      			}
      			if($results['li_LineType']=="市际"){
				?>
				<option></option>
      			<option value="国际">国际</option>
      			<option value="省际">省际</option>
      			<option value="市际" selected="selected">市际</option>
      			<option value="县际">县际</option>
      			<option value="县内">县内</option>
      			<option value="其他">其他</option>
      			<?php 
      			}
      			if($results['li_LineType']=="县际"){
				?>
				<option></option>
      			<option value="国际">国际</option>
      			<option value="省际">省际</option>
      			<option value="市际">市际</option>
      			<option value="县际" selected="selected">县际</option>
      			<option value="县内">县内</option>
      			<option value="其他">其他</option>
      			<?php 
      			}
      			if($results['li_LineType']=="县内"){
				?>
				<option></option>
      			<option value="国际">国际</option>
      			<option value="省际">省际</option>
      			<option value="市际">市际</option>
      			<option value="县际">县际</option>
      			<option value="县内" selected="selected">县内</option>
      			<option value="其他">其他</option>
      			<?php 
      			}
      			if($results['li_LineType']=="其他"){
				?>
				<option></option>
      			<option value="国际">国际</option>
      			<option value="省际">省际</option>
      			<option value="市际">市际</option>
      			<option value="县际">县际</option>
      			<option value="县内">县内</option>
      			<option value="其他" selected="selected">其他</option>
      			<?php 
      			}
      			?>
      		</select></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路方向：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="Direction">
       			<?php 
				if($results['li_Direction']==""){
      			?>
      			<option selected="selected"></option>
      			<option value="东">东</option>
      			<option value="南">南</option>
      			<option value="西">西</option>
      			<option value="北">北</option>
      			<?php 
				}
      			if($results['li_Direction']=="东"){
      			?>
      			<option></option>
      			<option value="东" selected="selected">东</option>
      			<option value="南">南</option>
      			<option value="西">西</option>
      			<option value="北">北</option>
      			<?php 
				}
      			if($results['li_Direction']=="南"){
      			?>
      			<option></option>
      			<option value="东">东</option>
      			<option value="南" selected="selected">南</option>
      			<option value="西">西</option>
      			<option value="北">北</option>
      			<?php 
				}
      			if($results['li_Direction']=="西"){
      			?>
      			<option></option>
      			<option value="东">东</option>
      			<option value="南">南</option>
      			<option value="西" selected="selected">西</option>
      			<option value="北">北</option>
      			<?php 
				}
      			if($results['li_Direction']=="北"){
      			?>
      			<option></option>
      			<option value="东">东</option>
      			<option value="南">南</option>
      			<option value="西">西</option>
      			<option value="北" selected="selected">北</option>
      			<?php 
      			}
      			?>
      		</select></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />线路里程：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Kilometer" id="Kilometer" size="10" value="<?php echo $results['li_Kilometer'];?>" onkeyup="return isnumber(this.value,this.id)" />公里<span style="color:red">*</span></td>
	</tr>
	
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路状态：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="Linestate">
      			<?php 
	      		if($results['li_Linestate']==""){
      			?>
      			<option selected="selected"></option>
      			<option value="正常" >正常</option>
      			<option value="注销">注销</option>
      			<?php 
   				}
   				if($results['li_Linestate']=="正常"){
      			?>
      			<option></option>
      			<option value="正常" selected="selected">正常</option>
      			<option value="注销">注销</option>
      			<?php 
   				}
   				if($results['li_Linestate']=="注销"){
      			?>
      			<option></option>
      			<option value="正常">正常</option>
      			<option value="注销" selected="selected">注销</option>
      			<?php 
   				}
   				?>
      		<!--  
      			<option value="暂停">暂停</option>
      		-->
     		 </select></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站名：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="Statio" id="Statio" onchange="showSiteID(this.value,'Station','StationID','StationI','InRegion')">
    			<!--
     			<option selected="selected" value="<?php echo $results['li_StationID'].','.$results['li_Station'];?>"><?php echo $results['li_Station'];?></option>
      			-->
				<?php 
				if($userStationName == "全部车站"){
				?><option></option><?php 
					$sql = "select sset_SiteID,sset_SiteName,sset_Region FROM tms_bd_SiteSet where sset_IsStation=1";
					$query = $class_mysql_default$class_mysql_default->my_query($sql);
					//$result=mysqli_fetch_array($query);
					while($result=mysqli_fetch_array($query)){
						if($result['sset_SiteName']){
							if($result['sset_SiteName']==$results['li_Station']){
				?>	
								<option selected="selected" value="<?php echo $results['li_StationID'].','.$results['li_Station'].','.$result['sset_Region'];?>"><?php echo $results['li_Station'];?></option>
							<?php 
							}else{
							?>
								<option value="<?php echo $result['sset_SiteID'].','.$result['sset_SiteName'].','.$result['sset_Region'];?>"><?php echo $result['sset_SiteName'];?></option>
							<?php 
							}
						}
					}
				}else{
					$sql1="SELECT sset_Region FROM tms_bd_SiteSet WHERE sset_SiteID ='$userStationID' AND sset_SiteName ='$userStationName'";
					$query1=$class_mysql_default->my_query($sql1);
					$result1=mysqli_fetch_array($query1);
				?>	
					<option value="<?php echo $userStationID.','.$userStationName.','.$result1['sset_Region'];?>" selected="selected"><?php echo $userStationName;?></option>
				<?php 
				}
				?>			
      		</select><?php if($userStationName == "全部车站"){?>
      			<input type="hidden" name="Station" id="Station" value="<?php echo $results['li_Station'];?>">
      			<?php 
      				}else{
      			?>
      			<input type="hidden" name="Station" id="Station" value="<?php echo $userStationName;?>">
      			<?php 
      				}?><span style="color:red">*</span></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站编号：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input name="StationID" id="StationID" type="hidden" value="<?php echo $results['li_StationID'];?>"/>
    		<input name="StationI" id="StationI" disabled="disabled" value="<?php echo $results['li_StationID'];?>"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属区域：</span></td>
    	<td bgcolor="#FFFFFF"><input name="InRegion" id="InRegion" type="text" value="<?php echo $results['li_InRegion'];?>"/>
    		<br>
    		<select id="Region" name="Region"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="InRegion.value=options[selectedIndex].text; this.style.display='none';"   >
			</select>	
    	</td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"><?php echo $results['li_Remark'];?></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="submit" type="submit" value="修改" onclick="return addline()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return searline()"></td>
  </tr>
</table>
</form>
</div>


