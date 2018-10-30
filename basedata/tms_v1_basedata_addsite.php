<?php 
//添加站点界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript">
function addok(){
	if(document.addsite.SiteId.value == ""){
		alert("站点编号不能为空!");
		return false;
	}
	if(document.addsite.SiteName.value == ""){
		alert("站点名不能为空!");
		return false;
	}
	if(document.addsite.HelpCode.value == ""){
		alert("助记码不能为空!");
		return false;
	}

	if(document.addsite.SiteType.value == ""){
		alert("站点类型不能为空!");
		return false;
	}   

	if(document.addsite.Region.value == ""){
		alert("所属区域不能为空!");
		return false;
	}  
	if(!confirm("添加站点后不能修改站点名和站点编号，\r确定要添加该数据？")){
		return false;
	}   
}
function getvalue(){
	if(document.addsite.checkbox[0].checked){
		document.addsite.IsStation.value=1;
	}else{
		document.addsite.IsStation.value=0;
	}
	if(document.addsite.checkbox[1].checked){
		document.addsite.IsTollSite.value=1;
	}else{
		document.addsite.IsTollSite.value=0;
	}
}
function selectcheck(str){
	if (str=='车站'){
		document.addsite.checkbox1.checked=true;
		document.addsite.IsStation.value=1;
	}else{
		document.addsite.checkbox1.checked=false;
		document.addsite.IsStation.value=0;
	}
}

function search(){
	window.location.href='tms_v1_basedata_searsite.php';
}
		
$(document).ready(function(){
	$("#Region").keyup(function(){ //按键被松开时执行此函数
		$("#InRegion").empty(); //将ID为Region的元素内容清空
		document.getElementById("InRegion").style.display="";
		var SiteId = $("#Region").val();
		var SiteIdI = $("#Region").val(); 
		 //获取区域编码的编号变量
		//alert(SiteId.length);
		jQuery.get(
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'getRegion', 'SiteId': SiteId, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						alert(objData.retString);
					}
					else{
						for (var i = 0; i < objData.length; i++) {
							var RegionCode= objData[i].RegionCode;
							var RegionName=objData[i].RegionName;
							var Region = RegionName + ';' + RegionCode;
							$("<option value = " + Region + ">" + RegionName + "</option>").appendTo($("#InRegion"));
						}
					}
				});
		});
	//自动生成编码
	$("#InRegion").blur(function(){
		var Region1=document.getElementById("Region").value;
		var Region=document.getElementById("InRegion").value;
		var RedionCode = Region.split(";");
		//alert(RedionCode[1]);
		jQuery.get(
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'getRegionCode', 'Region': Region, 'Region1': Region1, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						alert(objData.retString);
					}
					else{
						var MaxCode=objData.MaxCode;
						var TRedionCode=RedionCode[1]+MaxCode;
						document.getElementById("SiteId").value=TRedionCode;
						document.getElementById("SiteIdI").value=TRedionCode;
					}
				});
		});
});
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#F0F8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 站 点</span></td>
  </tr>
</table>
<?php
//连接数据库，获取班次信息
?>
<form id="addsite" name="addsite" action="tms_v1_basedata_addsiteok.php" method="post">
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点名：</span></td>
		<td bgcolor="#FFFFFF"><input type="text" name="SiteName" id="SiteName" /><span style="color:red">*</span></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点类型：</span></td>
    	<td bgcolor="#FFFFFF">
    			<select name="SiteType" id="SiteType" onchange="selectcheck(this.value)">
    				<option></option>
      				<option value="普通站点">普通站点</option>
      				<option value="车站">车站</option>
      			</select>
      			<span style="color:red">*</span>
      			</td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />站点级别：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="SiteRank" id="SiteRank" /></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />操作码：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="OperateCode" id="OperateCode" /></td>
	</tr>  
	 <tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />助记码：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="HelpCode" id="HelpCode" /><span style="color:red">*</span></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />所属区域：</span></td>
    	<td bgcolor="#FFFFFF">
    	<input name="Region" id="Region" type="text"/>
    	<span style="color:red">*</span>
    		<br>
    		<select id="InRegion" name="InRegion"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="Region.value=options[selectedIndex].text; this.style.display='none';">
			</select>	
    	<!--  
			<select name="Region" id="Region">
      		</select>
      	-->	
		</td>
	</tr> 
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点编号</span></td>
        <td bgcolor="#FFFFFF">
            <input type="text" name="SiteIdI" id="SiteIdI" disabled="disabled"/><span style="color:red">*</span>
        	<input type="hidden" name="SiteId" id="SiteId"/>
        </td>
	</tr>  
  	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><input type="hidden" name="IsStation" /></span></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="checkbox1"  onclick="()" disabled="disabled"/>是否车站</td>
	</tr> 
<!--  	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><input type="hidden" name="IsTollSite" /></span></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="checkbox2"  onclick="getvalue()" />是否收费点</td>
	</tr> 
 --> 
  	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />所属机构名称：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="StationAdOrg">
    			<option>请选择所属机构</option>
    			<?php 
    				$select="SELECT ao_OrgName FROM tms_bd_AdOrg";
    				$query =$class_mysql_default->my_query($select);
					while ($row=mysqli_fetch_array($query)){
    			?>
      				<option value="<?php echo $row['ao_OrgName'];?>"><?php echo $row['ao_OrgName'];?></option>
      			<?php 
					}
      			?>
      			</select></td>
	</tr> 
   <tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="submit" type="submit" value="添加" onclick="return addok();" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="search();">&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>




