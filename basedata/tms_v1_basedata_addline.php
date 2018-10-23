<?php 
//添加线路界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
function showSiteID(str,Site,SiteID,SiteI,HelpCode){ 
	var st=str.split(',')
	document.getElementById(Site).value=st[1];
	document.getElementById(SiteID).value=st[0];
	document.getElementById(SiteI).value=st[0];
	document.getElementById(HelpCode).value=st[2];
	document.getElementById("Region").style.display="none";
}
/*function showLineName(){ 
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
}*/
function addline(){
	if(document.getElementById("LineID").value == ""){
		alert("线路编号不能为空!");
		return false; 
	}
	if(!document.addL.BeginSite.value){
		alert('起点站名不能为空!!')
		return false;
	}
	if(!document.addL.EndSite.value){
		alert('终点站名不能为空!!')
		return false;
	}
	if(document.addL.BeginSite.value==document.addL.EndSite.value){
		alert('起点站与终点站名不能相同!!')
		return false;
	}
	if(document.getElementById("LineName").value== ""){
		alert("线路名不能为空!");
		return false; 
	}	
	if(document.getElementById("Kilometer").value== ""){
		alert("里程数不能为空!");
		return false; 
	}	
	if(document.getElementById("Statio").value== ""){
		alert("所属车站不能为空!");
		return false; 
	}
	if(!confirm("添加线路后不能修改起点和终点，\r确定要添加该数据？")){
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
	$("#BeginSite").keyup(function(){  //起点站
		document.getElementById("EndSitINH").style.display="none";
		$("#BeginSitINH").empty();
		document.getElementById("BeginSitINH").style.display="";
		var Site = $("#BeginSite").val();
		jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'getsite', 'Site': Site, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				for (var i = 0; i < objData.length; i++) {
					$("<option value = "+ objData[i].SiteID +"," + objData[i].SiteName + ","+objData[i].HelpCode+ ">" + objData[i].SiteName + "</option>").appendTo($("#BeginSitINH"));
				}
				if(Site==''){
					document.getElementById("BeginSitINH").style.display="none";
				}
			});	
	});
});
$(document).ready(function(){  //终点站
	$("#EndSite").keyup(function(){ 
		document.getElementById("BeginSitINH").style.display="none";
		$("#EndSitINH").empty();
		document.getElementById("EndSitINH").style.display="";
		var Site = $("#EndSite").val();
		jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'getsite', 'Site': Site, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				for (var i = 0; i < objData.length; i++) {
					$("<option value = "+ objData[i].SiteID +"," + objData[i].SiteName + ","+objData[i].HelpCode+ ">" + objData[i].SiteName + "</option>").appendTo($("#EndSitINH"));
				}
				if(Site==''){
					document.getElementById("EndSitINH").style.display="none";
				}
			});	
	});
});
$(document).ready(function(){  //终点自动添加编码判读
	$("#EndSitINH").blur(function(){	
		var BeginSite=document.getElementById("BeginSite").value;
		var EndSite=document.getElementById("EndSite").value;
		if(BeginSite != "" && EndSite != ""){
			var BeginSiteID=document.getElementById("BeginSiteID").value;
			var EndSiteID=document.getElementById("EndSiteID").value;
			var BeginHelpCode=document.getElementById("BeginHelpCode").value;
			var EndHelpCode=document.getElementById("EndHelpCode").value;
			var CodePart=BeginHelpCode+EndHelpCode+BeginSiteID+EndSiteID;
			jQuery.get(
					'tms_v1_bsaedata_dataProcess.php',
					{'op': 'getmaxcode', 'CodePart': CodePart, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL"){ 
							alert(objData.retString);
						}
						else{
							var MaxCode=objData.MaxCode;
							var Code=CodePart+MaxCode;
							document.getElementById("LineID").value=Code;
							document.getElementById("LineIDI").value=Code;
					   }
			});
			document.getElementById("LineName").value=document.addL.BeginSite.value+"--"+document.addL.EndSite.value;
			document.getElementById("LineNameN").value=document.addL.BeginSite.value+"--"+document.addL.EndSite.value;
			document.getElementById("LineNam").value=document.getElementById("LineName").value;
		}
	});	
});

$(document).ready(function(){  //起点自动添加编码判读
	$("#BeginSitINH").blur(function(){	
		var BeginSite=document.getElementById("BeginSite").value;
		var EndSite=document.getElementById("EndSite").value;
		if(BeginSite != "" && EndSite != ""){
			var BeginSiteID=document.getElementById("BeginSiteID").value;
			var EndSiteID=document.getElementById("EndSiteID").value;
			var BeginHelpCode=document.getElementById("BeginHelpCode").value;
			var EndHelpCode=document.getElementById("EndHelpCode").value;
			var CodePart=BeginHelpCode+EndHelpCode+BeginSiteID+EndSiteID;
			jQuery.get(
					'tms_v1_bsaedata_dataProcess.php',
					{'op': 'getmaxcode', 'CodePart': CodePart, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL"){ 
							alert(objData.retString);
						}
						else{
							var MaxCode=objData.MaxCode;
							var Code=CodePart+MaxCode;
							document.getElementById("LineID").value=Code;
							document.getElementById("LineIDI").value=Code;
					   }
			});
			document.getElementById("LineName").value=document.addL.BeginSite.value+"--"+document.addL.EndSite.value;
			document.getElementById("LineNameN").value=document.addL.BeginSite.value+"--"+document.addL.EndSite.value;
			document.getElementById("LineNam").value=document.getElementById("LineName").value;
		}
	});	
});

$(document).click(function(){
	document.getElementById("BeginSit").style.display="none";
	document.getElementById("EndSit").style.display="none";
	document.getElementById("Region").style.display="none";
});

$(document).ready(function(){
	$("#InRegion").keyup(function(){ //按键被松开时执行此函数
		$("#Region").empty(); //将ID为Region的元素内容清空
		document.getElementById("Region").style.display="";
		var SiteId = $("#InRegion").val(); //获取区域编码的编号变量
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

<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 线 路  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<div><form name="addL" id="addL" action="tms_v1_basedata_addlineok.php" method="post">
<table width="50%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />起点站名：</span></td>
    	<td  bgcolor="#FFFFFF"><input type="text" name="BeginSite" id="BeginSite"><span style="color:red">*</span>
    		 <br>
        	<select id="BeginSitINH" name="BeginSitINH"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="showSiteID(this.value,'BeginSite','BeginSiteID','BeginSiteI','BeginHelpCode'); this.style.display='none';"   >
			</select>
      	</td>
	</tr> 
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 起点站编号：</span></td>
    	<td  bgcolor="#FFFFFF">
    	    <input name="BeginSiteID" id="BeginSiteID" type="hidden"/>
    		<input name="BeginHelpCode" id="BeginHelpCode" type="hidden"/>
    		<input name="BeginSiteI" id="BeginSiteI" disabled="disabled"/></td>
	</tr> 
	<tr> 
    	<td "width="25%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 终点站名：</span></td>
    	<td "width="75%" bgcolor="#FFFFFF"><input type="text" name="EndSite" id="EndSite"><span style="color:red">*</span>
			<br>
    		<select id="EndSitINH" name="EndSitINH"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="showSiteID(this.value,'EndSite','EndSiteID','EndSiteI','EndHelpCode'); this.style.display='none';">
			</select>
      	</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 终点站编号：</span></td>
    	<td bgcolor="#FFFFFF">
    	    <input name="EndSiteID" id="EndSiteID" type="hidden"/>
    		<input name="EndHelpCode" id="EndHelpCode" type="hidden"/>
    		<input name="EndSiteI" id="EndSiteI" disabled="disabled"/></td>
	</tr>
	
	<tr>
		<td  nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路名称：</span></td>
		<td  bgcolor="#FFFFFF">
		<input name="LineNameN" id="LineNameN" type="text" disabled="disabled"/><span style="color:red">*</span>
		<input name="LineName" id="LineName" type="hidden"/>
		</td>
	</tr>
	<tr>
    	<td  nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路编号：</span></td>
        <td bgcolor="#FFFFFF">
        	<input name="LineIDI" id="LineIDI" type="text" disabled="disabled" style="width:200px"/><span style="color:red">*</span>
        	<input name="LineID" id="LineID" type="hidden"  style="width:200px"/>
        </td>
	</tr>
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />线路等级：</span></td>
    	<td  bgcolor="#FFFFFF">
    		<select name="LineDegree">
      			<option></option>
      			<option value="一类">一类</option>
      			<option value="二类">二类</option>
      			<option value="三类">三类</option>
      			<option value="四类">四类</option>
      		</select></td>
	</tr> 
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路种类：</span></td>
    	<td  bgcolor="#FFFFFF">
    		<select name="LineKind">
      			<option></option>
      			<option value="高速">高速</option>
      			<option value="普通">普通</option>
      			<option value="快巴">快巴</option>
      			<option value="信誉">信誉</option>
      			<option value="加班">加班</option>
      			<option value="其他">其他</option>
     	 	</select></td>
	</tr> 
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />线路类别：</span></td>
    	<td  bgcolor="#FFFFFF">
    		<select name="LineType">
      			<option></option>
      			<option value="国际">国际</option>
      			<option value="省际">省际</option>
      			<option value="市际">市际</option>
      			<option value="县际">县际</option>
      			<option value="县内">县内</option>
      			<option value="其他">其他</option>
      		</select></td>
	</tr> 
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路方向：</span></td>
    	<td  bgcolor="#FFFFFF">
    		<select name="Direction">
      			<option></option>
      			<option value="东">东</option>
      			<option value="南">南</option>
      			<option value="西">西</option>
      			<option value="北">北</option>
      		</select></td>
	</tr> 
	<tr> 
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />线路里程：</span></td>
    	<td  bgcolor="#FFFFFF"><input type="text" name="Kilometer" id="Kilometer" size="10" onkeyup="return isnumber(this.value,this.id)" /> 公里<span style="color:red">*</span></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路状态：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="Linestate">
      			<option value="正常">正常</option>
      			<option value="注销">注销</option>
      		<!-- 
      			<option value="暂停">暂停</option>
      		 -->
     		 </select></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站名：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="Statio" id="Statio" onchange="showSiteID(this.value,'Station','StationID','StationI','InRegion')">     			
				<?php 
				if($userStationName == "全部车站"){
					?><option></option><?php 
					$sql = "select sset_SiteID, sset_SiteName, sset_Region FROM tms_bd_SiteSet where sset_IsStation=1";
					$query = $class_mysql_default->my_query($sql);
					//$result=mysql_fetch_array($query);
					while($result=mysql_fetch_array($query)){
						if($result['sset_SiteName']){
				?>	
					<option value="<?php echo $result['sset_SiteID'].','.$result['sset_SiteName'].','.$result['sset_Region'];?>"><?php echo $result['sset_SiteName'];?></option>
				<?php 
						}
					}
				}
				else{
					$sql1="SELECT sset_Region FROM tms_bd_SiteSet WHERE sset_SiteID ='$userStationID' AND sset_SiteName ='$userStationName'";
					$query1=mysql_query($sql1);
					$result1=mysql_fetch_array($query1);
				?>	
					<option value="<?php echo $userStationID.','.$userStationName.','.$result1['sset_Region'];?>" selected="selected"><?php echo $userStationName;?></option>
				<?php 
				}
				?>			
      		</select>
      		<?php if($userStationName == "全部车站"){
      		?>
      		<input type="hidden" name="Station" id="Station">
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
    	<?php 
    		if($userStationName == "全部车站"){
    	?><input name="StationID" id="StationID" type="hidden"/><input name="StationI" id="StationI" disabled="disabled"/>
		<?php 
    		}else{
				?>
			<input name="StationID" id="StationID" type="hidden" value="<?php echo $userStationID;?>"/><input name="StationI" id="StationI" disabled="disabled" value="<?php echo $userStationID;?>"/>
		<?php }?>			
	</td></tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属区域：</span></td>
    	<td bgcolor="#FFFFFF">
    		<?php 
				if($userStationName != "全部车站"){
					$query2="SELECT sset_Region FROM tms_bd_SiteSet WHERE  sset_SiteID='$userStationID'";
					$result=mysql_query("$query2");
					$row=mysql_fetch_array($result);
			?>
    		<input name="InRegion" id="InRegion" type="text" value="<?php echo $row['sset_Region']?>"/>
    		<?php 
    		}
    		else{
    		?>
    		<input name="InRegion" id="InRegion" type="text"/>
    		<?php 
    		}
    		?>
    		<br>
    		<select id="Region" name="Region"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="InRegion.value=options[selectedIndex].text; this.style.display='none';"   >
			</select>	
    	</td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"></textarea></td>
	</tr> 
   <tr>
    <td  colspan="2" align="center" bgcolor="#FFFFFF"><input name="submit" type="submit" value="添加" onclick="return addline()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return searline()"></td>
  </tr>
</table>
</form>
</div>
