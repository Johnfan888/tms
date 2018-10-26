<?php 
//修改班次界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");
	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber = $_GET['clnumber'];
	$sql="SELECT * FROM tms_bd_NoRunsInfo where  nri_NoOfRunsID='{$clnumber}'";
	$query=$class_mysql_default->my_query($sql);
	$row=mysqli_fetch_array($query);
?>
<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js">
</script>
<link href="../js/ui/jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.8.2.js"></script>
<script type="text/javascript" src="../js/ui/jquery-ui.js"></script>
<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="../js/jQuery-Timepicker/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="../js/jQuery-Timepicker/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript" src="../js/jQuery-Timepicker/i18n/jquery-ui-timepicker-zh-CN.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
	$('#DepartureTime').timepicker();
});
function isnumber(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value='';
		return false;
		}
}
function getvalue(ID,str){ //判读是否从线路处继承
	if(document.getElementById(ID).checked){
		document.getElementById(str).value=1
	}else{
		document.getElementById(str).value=0
	}	
}
function modnoruns(){
	if(document.getElementById("NoOfRunsID").value==""){
		alert("班次编号不能为空!");
		return false; 
	}
//	if(document.getElementById("Allticket").value=='1'){
//		document.getElementById("AllowSell").value=0
//		}
} 
function sear(){
	window.location.href='tms_v1_basedata_searnoruns.php';
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">修 改 班 次 </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<div><form  action="tms_v1_basedata_modnorunsok.php" method="post">
<table width="60%" align="center"  border="1" cellpadding="3" cellspacing="1">
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路名称：</span></td>
		<td bgcolor="#FFFFFF"><input type="hidden" name="LineName" id="LineName" value="<?php echo $row['nri_LineName'];?>"/>
				<input type="text" name="LineNam" id="LineNam" disabled="disabled" value="<?php echo $row['nri_LineName'];?>"/><span style="color:red">*</span></td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路编号：</span></td>
        <td bgcolor="#FFFFFF">
        	<input name="LineID" id="LineID"  type="hidden" value="<?php echo $row['nri_LineID'];?>"/>
     		<input name="LineI" id="LineI" disabled="disabled" type="text" value="<?php echo $row['nri_LineID'];?>" style="width:230px;"/></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />班次编码：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input name="NoOfRunsIDI"  id="NoOfRunsIDI"  type="text" value="<?php echo $row['nri_NoOfRunsID'];?>" disabled="disabled"/>
    		<input name="NoOfRunsI"  id="NoOfRunsI"  type="hidden" value="<?php echo $row['nri_NoOfRunsID'];?>" />
     		<input name="NoOfRunsID"  id="NoOfRunsID"  type="hidden" value="<?php echo $row['nri_NoOfRunsID'];?>"/><span style="color:red">*</span></td>
     	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />发车时间：</span></td>
    	<td bgcolor="#FFFFFF"><input name="DepartureTime" id="DepartureTime" type="text"  value="<?php echo $row['nri_DepartureTime'];?>"/></td>
	</tr>

	<tr> 
	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />始发站：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input name="BeginSite" id="BeginSite"  type="hidden" value="<?php echo $row['nri_BeginSite'];?>"/>
     		<input name="BeginSit" id="BeginSit" disabled="disabled" type="text" value="<?php echo $row['nri_BeginSite'];?>" /></td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />始发站编号：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input name="BeginSiteID"  id="BeginSiteID"  type="hidden" value="<?php echo $row['nri_BeginSiteID'];?>"/>
     		<input name="BeginSiteI"  id="BeginSiteI" disabled="disabled" type="text" value="<?php echo $row['nri_BeginSiteID'];?>"/></td>
	</tr> 
	<tr> 
		<td nowrap="nowrap" bgcolor="#FFFFFF" onclick="show('EndSite','EndSit')"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />终点站：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input name="EndSite" id="Endsite"  type="hidden" value="<?php echo $row['nri_EndSite'];?>"/>
     		<input name="EndSit" id="Endsit" disabled="disabled" type="text" value="<?php echo $row['nri_EndSite'];?>" /></td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 终点站编号：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input name="EndSiteID" id="EndSiteID"  type="hidden" value="<?php echo $row['nri_EndSiteID'];?>"/>
     		<input name="EndSiteI" id="EndSiteI" disabled="disabled" type="text" value="<?php echo $row['nri_EndSiteID'];?>"/></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 操作码：</span></td>
    	<td bgcolor="#FFFFFF"><input name="OperateCode" type="text" value="<?php echo $row['nri_OperateCode'];?>"/></td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次类型：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="Type" id="Type">
    			<option value="<?php echo $row['nri_Type'];?>"><?php echo $row['nri_Type'];?></option>
     			<option></option>
     			<option value="四定">四定</option>
     			<option value="专线">专线</option>
     			<option value="其他">其他</option>
			</select>
    	
    	</td>
	</tr>  
	<tr> 
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />检票口：</span></td>
    	<td bgcolor="#FFFFFF"><input name="CheckTicketWindow" type="text"  value="<?php echo $row['nri_CheckTicketWindow'];?>"/></td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />运行时间：</span></td>
    	<td bgcolor="#FFFFFF">
    		<?php 
    			if($row['nri_RunHours']!='') $RunHours=explode(":", $row['nri_RunHours']);
    		?>
    		<input name="RunHours" id="RunHours" type="text" value="<?php echo $RunHours[0];?>" onkeyup="return isnumber(this.value,this.id)" style="width:50px;"/>小时
    		<input name="RunMinuts" id="RunMinuts" type="text" value="<?php echo $RunHours[1];?>" onkeyup="return isnumber(this.value,this.id)" style="width:50px;"/>分钟
    	</td>
    	
	</tr> 
<!--	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 营运类别：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="DealCategory">
    			<option value="<?php echo $row['nri_DealCategory'];?>"><?php echo $row['nri_DealCategory'];?></option>
    			<option></option>
    			<option value="单营">单营</option>
    			<option value="单营">共营</option>
    		</select></td> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 营运方式：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="DealStyle">
    			<option value="<?php echo $row['nri_DealStyle'];?>"><?php echo $row['nri_DealStyle'];?></option>
    			<option></option>
    			<option value="直达">直达</option>
    			<option value="普快">普快</option>
    			<option value="普客">普客</option>
    		</select></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 服务费比率：</span></td>
    	<td bgcolor="#FFFFFF"><input name="SeverFeeRate" type="text" value="<?php echo $row['nri_SeverFeeRate'];?>"/></td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />临时加班费：</span></td>
    	<td bgcolor="#FFFFFF"><input name="TempAddFee" type="text" value="<?php echo $row['nri_TempAddFee'];?>" /></td>
	</tr> 

	<tr> 
    	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />结算模式：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="BalanceModel">
    			<option value="<?php echo $row['nri_BalanceModel'];?>"><?php echo $row['nri_BalanceModel'];?></option>
    			<option></option>
    			<option value="0">0:票价</option>
    			<option value="1">1:扣除站务费的结算价</option>
    			<option value="2">2:按人扣费的结算价</option>
    			<option value="3">3:结算里程</option>
    		</select></td>
	</tr> 
-->
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />运行区域：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="RunRegion">
    			<?php 
    			if($row['nri_RunRegion'] == ""){
    			?>
    			<option selected="selected"></option>
    			<option value="市内">市内</option>
    			<option value="跨市">跨市</option>
    			<option value="跨省">跨省</option>
    			<option value="其他">其他</option>
    			<?php 
    			}
    			if($row['nri_RunRegion'] == "市内"){
    			?>
    			<option></option>
    			<option value="市内" selected="selected">市内</option>
    			<option value="跨市">跨市</option>
    			<option value="跨省">跨省</option>
    			<option value="其他">其他</option>
    			<?php 
    			}
    			if($row['nri_RunRegion'] == "跨市"){
    			?>
    			<option></option>
    			<option value="市内">市内</option>
    			<option value="跨市" selected="selected">跨市</option>
    			<option value="跨省">跨省</option>
    			<option value="其他">其他</option>
    			<?php 
    			}
    			if($row['nri_RunRegion'] == "跨省"){
    			?>
    			<option></option>
    			<option value="市内">市内</option>
    			<option value="跨市">跨市</option>
    			<option value="跨省" selected="selected">跨省</option>
    			<option value="其他">其他</option>
    			<?php 
    			}
    			if($row['nri_RunRegion'] == "其他"){
    			?>
    			<option selected="selected"></option>
    			<option value="市内">市内</option>
    			<option value="跨市">跨市</option>
    			<option value="跨省">跨省</option>
    			<option value="其他" selected="selected">其他</option>
    			<?php 
    			}
    			?>
    			
    			<!--  
    			<option value="<?php echo $row['nri_RunRegion'];?>"><?php echo $row['nri_RunRegion'];?></option>
    			<option></option>
    			<option value="市内">市内</option>
    			<option value="跨市">跨市</option>
    			<option value="跨省">跨省</option>
    			<option value="其他">其他</option>
    			-->
    		</select></td> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />循环日期：</span></td>
    	<td bgcolor="#FFFFFF"><input name="LoopDate" type="text" value="<?php echo $row['nri_LoopDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td>
	</tr> 
  <tr> <td bgcolor="#FFFFFF"><input name="Allticke" id="Allticke" type="checkbox" <?php if($row['nri_Allticket']!=0)echo "checked";?> onclick="getvalue(this.id,'Allticket')" />是否通票</td>
    	
    	<!--  
    	<td bgcolor="#FFFFFF"><input name="IsSucceedLin" id="IsSucceedLin" type="checkbox" <?php if($row['nri_IsSucceedLine']!=0)echo "checked";?> onclick="getvalue(this.id,'IsSucceedLine')"/>是否从线路继承路段表</td>	 	
    	-->
    	<td bgcolor="#FFFFFF"><input name="IsSucceedLin" id="IsSucceedLin" type="checkbox"  onclick="getvalue(this.id,'IsSucceedLine')"/>是否从线路继承路段表</td>	 	
    	<td bgcolor="#FFFFFF"><input name="IsStopOrCrea" id="IsStopOrCrea" type="checkbox" <?php if($row['nri_IsStopOrCreat']!=0)echo "checked";?> onclick="getvalue(this.id,'IsStopOrCreat')" />是否生成票版</td>
    	<td bgcolor="#FFFFFF"><input name="AllowSel" id="AllowSel" type="checkbox" <?php if($row['nri_AllowSell']!=0)echo "checked";?> onclick="getvalue(this.id,'AllowSell')"/>是否允许售票</td>	
	</tr>
<!-- <tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="StationDeal" id="StationDeal" value="<?php echo $row['nri_StationDeal'];?>"/></td>
    	<td bgcolor="#FFFFFF"><input name="StationDea" id="StationDea" type="checkbox" <?php if($row['nri_StationDeal']!=0)echo "checked";?> onclick="getvalue(this.id,'StationDeal')" />是否本站专营</td> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsNightAddition" id="IsNightAddition" value="<?php echo $row['nri_IsNightAddition'];?>"/></td>
    	<td bgcolor="#FFFFFF"><input name="IsNightAdditio" id="IsNightAdditio" type="checkbox"  <?php if($row['nri_IsNightAddition']!=0)echo "checked";?> onclick="getvalue(this.id,'IsNightAddition')"/>是否夜间加成</td>
	</tr> 
 	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="Allticket" id="Allticket" value="<?php echo $row['nri_Allticket'];?>"/></td>
    	<td bgcolor="#FFFFFF"><input name="Allticke" id="Allticke" type="checkbox" <?php if($row['nri_Allticket']!=0)echo "checked";?> onclick="getvalue(this.id,'Allticket')" />是否通票</td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsThroughAddition" id="IsThroughAddition" value="<?php echo $row['nri_IsThroughAddition'];?>"/></td>
    	<td bgcolor="#FFFFFF"><input name="IsThroughAdditio" id="IsThroughAdditio" type="checkbox" <?php if($row['nri_IsThroughAddition']!=0)echo "checked";?> onclick="getvalue(this.id,'IsThroughAddition')"/>是否直达加成</td>
	</tr> 
   <tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsExclusive" id="IsExclusive" value="<?php echo $row['nri_IsExclusive'];?>"/></td>
    	<td bgcolor="#FFFFFF"><input name="IsExclusiv" id="IsExclusiv" type="checkbox" <?php if($row['nri_IsExclusive']!=0)echo "checked";?> onclick="getvalue(this.id,'IsExclusive')"/>是否专属</td>	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsReturn" id="IsReturn" value="<?php echo $row['nri_IsReturn'];?>"/></td>
    	<td bgcolor="#FFFFFF"><input name="IsRetur" id="IsRetur" type="checkbox" <?php if($row['nri_IsReturn']!=0)echo "checked";?> onclick="getvalue(this.id,'IsReturn')"/>是否回程班次</td>
	</tr> 
   <tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="AllowSell" id="AllowSell" value="<?php echo $row['nri_AllowSell'];?>"/></td>
    	<td bgcolor="#FFFFFF"><input name="AllowSel" id="AllowSel" type="checkbox" <?php if($row['nri_AllowSell']!=0)echo "checked";?> onclick="getvalue(this.id,'AllowSell')"/>是否允许售票</td>	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="AddNoRuns" id="AddNoRuns" value="<?php echo $row['nri_AddNoRuns'];?>"/></td>
    	<td bgcolor="#FFFFFF"><input name="AddNoRun" id="AddNoRun" type="checkbox" <?php if($row['nri_AddNoRuns']!=0)echo "checked";?> onclick="getvalue(this.id,'AddNoRuns')"/>是否加班</td>
	</tr> 
 -->
   <tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td colspan="3" bgcolor="#FFFFFF"><textarea name="Remark" cols="100%" rows=""><?php echo $row['nri_Remark'];?></textarea></td>	
    	
	</tr> 
   <tr>
    <td colspan="4" align="center" bgcolor="#FFFFFF"><input name="submit" type="submit" value="修改" onclick="return modnoruns()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return sear()"></td>
  </tr>
  <tr style="border:0px;">
		<td nowrap="nowrap" bgcolor="#FFFFFF" style="border:0px;"><input type="hidden" name="IsStopOrCreat" id="IsStopOrCreat" value="<?php echo $row['nri_IsStopOrCreat'];?>"/></td>
	   <td nowrap="nowrap" bgcolor="#FFFFFF" style="border:0px;">
    		<input type="hidden" name="IsSucceedLine" id="IsSucceedLine" value="0" style="border:0px;"/>
			<input type="hidden" name="IsSucceedLine1" id="IsSucceedLine1" value="<?php echo $row['nri_IsSucceedLine'];?>" style="border:0px;"/>
	   </td>
	   <td nowrap="nowrap" bgcolor="#FFFFFF" style="border:0px;"><input type="hidden" name="Allticket" id="Allticket" value="<?php echo $row['nri_Allticket'];?>"/></td>
	   <td nowrap="nowrap" bgcolor="#FFFFFF" style="border:0px;"><input type="hidden" name="AllowSell" id="AllowSell" value="<?php echo $row['nri_AllowSell'];?>"/></td>
	</tr>
</table>
</form>
</div>

