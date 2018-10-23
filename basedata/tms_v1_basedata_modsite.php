<?php 
//修改站点界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber = $_GET['clnumber'];
	$sql = "select* FROM `tms_bd_SiteSet` WHERE sset_SiteID='{$clnumber}'";
	$query = $class_mysql_default->my_query($sql);
	$result=mysql_fetch_array($query);
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript">
function modok(){
	if(document.modsite.SiteId.value == ""){
		alert("站点编号不能为空!");
		return false;
	}
	if(document.modsite.SiteName.value == ""){
		alert("站点名不能为空!");
		return false;
	}
	if(document.modsite.HelpCode.value == ""){
		alert("助记码不能为空!");
		return false;
	}
	if(document.modsite.SiteType.value == ""){
		alert("站点类型不能为空!");
		return false;
	}   

	if(document.modsite.Region.value == ""){
		alert("所属区域不能为空!");
		return false;
	}     
}
function getvalue(){
	if(document.modsite.checkbox[0].checked){
		document.modsite.IsStation.value=1;
	}else{
		document.modsite.IsStation.value=0;
	}
	if(document.modsite.checkbox[1].checked){
		document.modsite.IsTollSite.value=1;
	}else{
		document.modsite.IsTollSite.value=0;
	}
}
function selectcheck(str){
	if (str=='车站'){
		document.modsite.checkbox1.checked=true;
		document.modsite.IsStation.value=1;
	}else{
		document.modsite.checkbox1.checked=false;
		document.modsite.IsStation.value=0;
	}
}
function search(){
	window.location.href='tms_v1_basedata_searsite.php';
}
$(document).ready(function(){
	$("#SiteId").blur(function(){
		//alert('ss');
		var SiteId = $("#SiteId").val();
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
						$("#Region option:gt(0)").remove();		
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
    <span class="graytext" style="margin-left:8px;">修 改 站 点</span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<form id="modsite" name="modsite" action="tms_v1_basedata_modsiteok.php" method="post">
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点编号:</span></td>

        <td bgcolor="#FFFFFF">
            <input type="text" name="SiteIdI" id="SiteIdI" value="<?php echo $result['sset_SiteID'];?>" disabled="disabled"/><span style="color:red">*</span>
        	<input name="SiteI" type="hidden" value="<?php echo $clnumber;?>" />
            <input type="hidden" name="SiteId" id="SiteId" value="<?php echo $result['sset_SiteID'];?>"/>
            </td>

	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点名：</span></td>
		<td bgcolor="#FFFFFF">
			<input type="text" name="SiteNameI" id="SiteNameI"  value="<?php echo $result['sset_SiteName'];?>" disabled="disabled"/>
			<input type="hidden" name="SiteName" id="SiteName"  value="<?php echo $result['sset_SiteName'];?>" /><span style="color:red">*</span></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站点类型：</span></td>
    	<td bgcolor="#FFFFFF">
    			<select name="SiteType" onchange="selectcheck(this.value)">
    				<?php 
    				if($result['sset_SiteType'] == ""){
    				?>
    				<option selected="selected"></option>
      				<option value="普通站点">普通站点</option>
      				<option value="车站">车站</option>
    				<?php 
    				}
    				if($result['sset_SiteType'] == "普通站点"){
    				?>
    				<option ></option>
      				<option value="普通站点" selected="selected">普通站点</option>
      				<option value="车站">车站</option>
    				<?php 
    				}
    				if($result['sset_SiteType'] == "车站"){
    				?>
      				<option ></option>
      				<option value="普通站点">普通站点</option>
      				<option value="车站"  selected="selected">车站</option>
      				<?php 
    				}
      				?>
      			</select>
      			<span style="color:red">*</span>
      		</td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />站点级别：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="SiteRank" id="SiteRank" value="<?php echo $result['sset_SiteRank'];?>"/></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />操作码：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="OperateCode" id="OperateCode" value="<?php echo $result['sset_OperateCode'];?>"/></td>
	</tr>
	 <tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />助记码：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="HelpCode" id="HelpCode"  value="<?php echo $result['sset_HelpCode'];?>"/><span style="color:red">*</span></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />所属区域：</span></td>
    	<td bgcolor="#FFFFFF">
			<select name="Region" id="Region">
        		<option value="<?php echo $result['sset_Region'];?>"><?php echo $result['sset_Region'];?></option>
        		
      		</select>
      		<span style="color:red">*</span>
		</td>
	</tr>   
  	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><input type="hidden" name="IsStation" value="<?php echo$result['sset_IsStation'];?>"/></span></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="checkbox1"  <?php if($result['sset_SiteType'] == "车站") echo "checked"; ?> disabled="disabled"/>是否车站</td>
	</tr> 
<!--  	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><input type="hidden" name="IsTollSite" value="<?php echo$result['sset_IsTollSite'];?>" /></span></td>
    	<td bgcolor="#FFFFFF"><input type="checkbox" name="checkbox2" onclick="getvalue()" <?php if($result['sset_IsTollSite']==1) echo "checked"; ?>  />是否收费点</td>
	</tr>
 -->  
  	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />所属机构名称：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="StationAdOrg" id="StationAdOrg">
    			<option value="<?php echo $result['sset_StationAdOrg'];?>"><?php echo $result['sset_StationAdOrg'];?></option>
    			<?php 
    				$select="SELECT ao_OrgName FROM tms_bd_AdOrg";
    				$query =$class_mysql_default->my_query($select);
					while ($row=mysql_fetch_array($query)){
						if($row['ao_OrgName']!=$result['sset_StationAdOrg']){
    			?>
      				<option value="<?php echo $row['ao_OrgName'];?>"><?php echo $row['ao_OrgName'];?></option>
      			<?php
						} 
					}
      			?>
      			</select></td>
	</tr> 
   <tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"><?php echo $result['sset_Remark'];?></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="submit" type="submit" value="修改" onclick="return modok();" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="search();">&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>



