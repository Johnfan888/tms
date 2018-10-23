<?php 
//添加班次界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	require_once("../ui/inc/auth.php");
	if($userStationName == "全部车站"){ //用户只能查看起点站属于本站的班次信息
		$str="";
		}	
		else{
		$str="AND  li_Station = '$userStationName'";
		}
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
<script type="text/javascript">
$(document).ready(function(){ //线路名按照终点站匹配
	$("#LineNam").keyup(function(){
		$("#LineNameselect").empty();
		document.getElementById("LineNameselect").style.display=""; 
		var LineName = $("#LineNam").val();
		var station = $("#stationselect").val();
		jQuery.get(
			'../schedule/tms_v1_schedule_dataops.php',
			{'op': 'GETLINEEND', 'LineName': LineName,'station':station ,'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				for (var i = 0; i < objData.length; i++) {
					$("<option value = " + objData[i].LineName + ',' + objData[i].LineID + ',' + objData[i].BeginSiteID +',' + objData[i].BeginSite +',' + objData[i].EndSiteID +',' + objData[i].EndSite + ">" + objData[i].LineName + "</option>").appendTo($("#LineNameselect"));
				}
				if(LineName==''){
					document.getElementById("LineNameselect").style.display="none";
				}
		});
	});
});
	
$(document).ready(function(){
	$('#DepartureTime').timepicker();

	/*$("#LineNam").blur(function(){
		//alert('h');
		var BeginSiteI=document.getElementById("BeginSiteI").value; //始发站编号
		var EndSiteI=document.getElementById("EndSiteI").value; //终点站编号
		jQuery.get(
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'getnorunsCode', 'BeginSiteI': BeginSiteI, 'EndSiteI': EndSiteI, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						alert(objData.retString);
					}
					else{
						
						var BeginSiteI=objData.BeginSiteI;
						var EndSiteI=objData. EndSiteI;
						var MaxCode=objData.MaxCode;
						var TRedionCode=BeginSiteI+EndSiteI+MaxCode;
						document.getElementById("NoOfRunsID").value=TRedionCode;
						document.getElementById("NoOfRunsIDI").value=TRedionCode;
					}
				});
		});*/
});
//<!--
function showsome(str){ //获取始发站，终点站，自动生成编码
	var st=str.split(',')
	document.getElementById("LineNam").value=st[0]//线路名
	document.getElementById("LineName").value=st[0] //线路名
	document.getElementById("LineID").value=st[1] //线路ID
	document.getElementById("LineI").value=st[1]
	document.getElementById("BeginSiteID").value=st[2]//起点站编号
	document.getElementById("BeginSiteI").value=st[2]
	document.getElementById("BeginSite").value=st[3] //起点站
	document.getElementById("BeginSit").value=st[3]
	document.getElementById("EndSiteID").value=st[4] //终点站编号
	document.getElementById("EndSiteI").value=st[4]
	document.getElementById("EndSite").value=st[5] //终点站
	document.getElementById("EndSit").value=st[5]
	var BeginSiteI=document.getElementById("BeginSiteI").value; //始发站编号
	var EndSiteI=document.getElementById("EndSiteI").value; //终点站编号
	jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'getnorunsCode', 'BeginSiteI': BeginSiteI, 'EndSiteI': EndSiteI, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if(objData.retVal == "FAIL"){ 
					alert(objData.retString);
				}
				else{
					var BeginSiteI=objData.BeginSiteI;
					var EndSiteI=objData. EndSiteI;
					var MaxCode=objData.MaxCode;
					var TRedionCode=BeginSiteI+EndSiteI+MaxCode;
					document.getElementById("NoOfRunsID").value=TRedionCode;
					document.getElementById("NoOfRunsIDI").value=TRedionCode;
				}
			});
}
function isnumber(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value='';
		return false;
		}
}
function getvalue(ID,str){
	if(document.getElementById(ID).checked){
		document.getElementById(str).value=1
	}else{
		document.getElementById(str).value=0
	}	
}
function addnoruns(){
	if(document.getElementById("NoOfRunsID").value==""){
		alert("班次编号不能为空!");
		return false; 
	}
//	if(document.getElementById("Allticket").value=='1'){
//		document.getElementById("AllowSell").value=0
//		}
	if(document.getElementById("LineName").value==""){
		alert("线路名不能为空!");
		return false; 
	}
} 
function sear(){
	window.location.href='tms_v1_basedata_searnoruns.php';
}
//-->
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#FOF8FF"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 班 次 </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<div><form action="tms_v1_basedata_addnorunsok.php" method="post">
<table width="60%" align="center"  border="1" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路名称：</span></td>
		<td bgcolor="#FFFFFF">
			<input type="text" name="LineNam" id="LineNam"><span style="color:red">*</span><br>
	    	<select id="LineNameselect" name="LineNameselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" onchange="showsome(this.value); this.style.display='none';"></select>
	    	<input type="hidden" name="LineName" id="LineName"/></td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路编号：</span></td>
        <td bgcolor="#FFFFFF"><input name="LineID" id="LineID"  type="hidden" />
     			<input name="LineI" id="LineI" disabled="disabled" type="text" style="width:230px;"/></td>
	</tr>
	<tr> 
	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 始发站：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input name="BeginSite" id="BeginSite"  type="hidden" />
     		<input name="BeginSit" id="BeginSit" disabled="disabled" type="text" /></td>
    	<td  nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 始发站编号：</span></td>
    	<td  bgcolor="#FFFFFF">
    		<input name="BeginSiteID"  id="BeginSiteID"  type="hidden" />
     		<input name="BeginSiteI"  id="BeginSiteI" disabled="disabled" type="text" style="width:100px;"/></td>
    	
	</tr> 
	<tr> 
	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 终点站：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input name="EndSite" id="Endsite"  type="hidden" />
     		<input name="EndSit" id="Endsit" disabled="disabled" type="text" /></td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 终点站编号：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input name="EndSiteID" id="EndSiteID"  type="hidden" />
     		<input name="EndSiteI" id="EndSiteI" disabled="disabled" type="text" style="width:100px;" /></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次编号：</span></td>
    	<td  bgcolor="#FFFFFF">
    		<input name="NoOfRunsIDI"  id="NoOfRunsIDI"  type="text" disabled="disabled"/>
    		<input name="NoOfRunsID"  id="NoOfRunsID"  type="hidden"/><span style="color:red">*</span>
    		</td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车时间：</span></td>
    	<td bgcolor="#FFFFFF"><input name="DepartureTime" id="DepartureTime" type="text" style="width:100px;"/></td>
    </tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 操作码：</span></td>
    	<td bgcolor="#FFFFFF"><input name="OperateCode" type="text" /></td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次类型：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="Type" id="Type">
     			<option></option>
     			<option value="四定">四定</option>
     			<option value="专线">专线</option>
     			<option value="其他">其他</option>
			</select>
    	
    	</td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 检票口：</span></td>
    	<td bgcolor="#FFFFFF"><input name="CheckTicketWindow" type="text" /></td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 运行时间：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input name="RunHours" id="RunHours" type="text" onkeyup="return isnumber(this.value,this.id)" style="width:50px;"/>小时&nbsp;&nbsp;&nbsp;
    		<input name="RunMinuts" id="RunMinuts" type="text" onkeyup="return isnumber(this.value,this.id)" style="width:50px;"/>分钟
    	</td>
	</tr> 
<!--  	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 营运类别：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="DealCategory">
    			<option></option>
    			<option value="单营">单营</option>
    			<option value="单营">共营</option>
    		</select></td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 营运方式：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="DealStyle">
    			<option></option>
    			<option value="直达">直达</option>
    			<option value="普快">普快</option>
    			<option value="普客">普客</option>
    		</select></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 服务费比率：</span></td>
    	<td bgcolor="#FFFFFF"><input name="SeverFeeRate" type="text" onkeyup="return isnumber(this.value)"/></td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 临时加班费：</span></td>
    	<td bgcolor="#FFFFFF"><input name="TempAddFee" type="text" onkeyup="return isnumber(this.value)"/></td>
	</tr> 

	<tr> 
    	
  	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结算模式：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="BalanceModel"> 
    			<option></option>
    			<option value="0">0:票价</option>
    			<option value="1">1:扣除站务费的结算价</option>
    			<option value="2">2:按人扣费的结算价</option>
    			<option value="3">3:结算里程</option>
    		</select></td>
 
	</tr>
  -->
  <tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 运行区域：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="RunRegion"> 
    			<option></option>
    			<option value="市内">市内</option>
    			<option value="跨市">跨市</option>
    			<option value="跨省">跨省</option>
    			<option value="其他">其他</option>
    		</select></td> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 循环日期：</span></td>
    	<td bgcolor="#FFFFFF"><input name="LoopDate" type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td>
	</tr> 
  <tr> 
    	<td bgcolor="#FFFFFF"><input name="Allticke" id="Allticke" type="checkbox" onclick="getvalue(this.id,'Allticket')" />是否通票</td>
    	<td bgcolor="#FFFFFF"><input name="IsSucceedLin" id="IsSucceedLin" type="checkbox" checked="checked" onclick="getvalue(this.id,'IsSucceedLine')"/>是否从线路继承路段表</td>
    	<td bgcolor="#FFFFFF"><input name="IsStopOrCrea" id="IsStopOrCrea" type="checkbox" checked="checked" onclick="getvalue(this.id,'IsStopOrCreat')"/>是否生成票版</td>
   		<td nowrap="nowrap" bgcolor="#FFFFFF" ><input name="AllowSel" id="AllowSel" type="checkbox" onclick="getvalue(this.id,'AllowSell')"/>是否允许售票</td>	
   </tr> 	
<!--    	
	 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="StationDeal" id="StationDeal" value="0"/></td>
    	<td bgcolor="#FFFFFF"><input name="StationDea" id="StationDea" type="checkbox" onclick="getvalue(this.id,'StationDeal')" />是否本站专营</td> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsNightAddition" id="IsNightAddition" value="0"/></td>
    	<td bgcolor="#FFFFFF"><input name="IsNightAdditio" id="IsNightAdditio" type="checkbox" onclick="getvalue(this.id,'IsNightAddition')" />是否夜间加成</td>
	</tr> 
 	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsThroughAddition" id="IsThroughAddition" value="0"/></td>
    	<td bgcolor="#FFFFFF"><input name="IsThroughAdditio" id="IsThroughAdditio" type="checkbox" onclick="getvalue(this.id,'IsThroughAddition')"/>是否直达加成</td>
	</tr> 
   <tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsExclusive" id="IsExclusive" value="0"/></td>
    	<td bgcolor="#FFFFFF"><input name="IsExclusiv" id="IsExclusiv" type="checkbox" onclick="getvalue(this.id,'IsExclusive')"/>是否专属</td>	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsReturn" id="IsReturn" value="0"/></td>
    	<td bgcolor="#FFFFFF"><input name="IsRetur" id="IsRetur" type="checkbox" onclick="getvalue(this.id,'IsReturn')"/>是否回程班次</td>
	</tr> 
   <tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="AllowSell" id="AllowSell" value="0"/></td>
    	<td bgcolor="#FFFFFF"><input name="AllowSel" id="AllowSel" type="checkbox" onclick="getvalue(this.id,'AllowSell')"/>是否允许售票</td>	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="AddNoRuns" id="AddNoRuns" value="0"/></td>
    	<td bgcolor="#FFFFFF"><input name="AddNoRun" id="AddNoRun" type="checkbox" onclick="getvalue(this.id,'AddNoRuns')"/>是否加班</td>
	</tr>
--> 
   <tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 备注：</span></td>
    	<td colspan="3" bgcolor="#FFFFFF"><textarea name="Remark" cols="100%" rows=""></textarea></td>	
    	
	</tr> 
   <tr>
    <td colspan="4" align="center" bgcolor="#FFFFFF"><input name="submit" type="submit" value="添加" onclick="return addnoruns()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return sear()"></td>
  </tr>
    <tr style="border:0px;bgcolor:#FFFFFF">
   		<td bgcolor="#FFFFFF" ><input type="hidden" name="AllowSell" id="AllowSell" value="0"/></td>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="IsSucceedLine" id="IsSucceedLine" value="1"/></td>
   		<td nowrap="nowrap" bgcolor="#FFFFFF"><input  type="hidden" name="Allticket" id="Allticket" value="0"/></td>
   		<td nowrap="nowrap" bgcolor="#FFFFFF"><input   type="hidden" name="IsStopOrCreat" id="IsStopOrCreat" value="1"/></td>
   </tr>
</table>
		<input style="border:0px;" type="hidden" name="stationselect" id="stationselect" value="<?php echo $str;?>">
</form>
</div>
