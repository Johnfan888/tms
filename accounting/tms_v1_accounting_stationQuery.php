<?php
/*
 * 站间结算页面
 * st_StationBalance 8为已进行站间结算
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

require_once("../ui/inc/init.inc.php");
if(isset($_POST['resultquery'])){
	$CheckBeginDate = $_POST['date1Value'];
	$CheckEndDate = $_POST['date2Value'];
	$FromStation=$_POST['FromStation'];
	$FromStationID=$_POST['FromStationID'];
	$ReachStation=$_POST['ReachStation'];
	$ReachStationID=$_POST['ReachStationID'];
}	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>站间结算</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script>
		$(document).ready(function(){
			$("#FromStation").keyup(function(){
				document.getElementById("ReachStationselect").style.display="none";
				$("#ReachStationselect").empty();
				document.getElementById("FromStationselect").style.display=""; 
				jQuery.get(
					'tms_v1_accounting_dataProcess.php',
					{'op': 'getstationandid', 'fromstation': $("#FromStation").val(), 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].from +";"+ objData[i].fromID +">" + objData[i].from + "</option>").appendTo($("#FromStationselect"));
											}
						if($("#FromStation").val() == ''){
							document.getElementById("FromStationselect").style.display="none";
						}
				});
			   	document.onkeydown = function (event) {
			  		var e = event || window.event || arguments.callee.caller.arguments[0];
			     	if (e && e.keyCode == 13) {
			     		$("#FromStationselect").focus();
			     		$("#FromStationselect option:eq(0)").attr({selected:"selected"});
			     	}
			   	};
			});
			document.getElementById("FromStationselect").onkeydown = function (event) {
	            var e = event || window.event || arguments.callee.caller.arguments[0];
	            if (e && e.keyCode == 13) {
		            var stringsplit=document.getElementById("FromStationselect").value.split(';');
	            	document.getElementById("FromStation").value=stringsplit[0];
	            	document.getElementById("FromStationID").value=stringsplit[1];
	           		document.getElementById("FromStationselect").style.display="none";
	           		document.getElementById("ReachStation").focus();
	            } 
			};
			document.getElementById("FromStationselect").onclick = function (event){
				var stringsplit=document.getElementById("FromStationselect").value.split(';');
	            document.getElementById("FromStation").value=stringsplit[0];
	            document.getElementById("FromStationID").value=stringsplit[1];
				document.getElementById("FromStationselect").style.display="none";
			};
			$("#ReachStation").keyup(function(){
				document.getElementById("FromStationselect").style.display="none";
				$("#ReachStationselect").empty();
				document.getElementById("ReachStationselect").style.display=""; 
				jQuery.get(
					'tms_v1_accounting_dataProcess.php',
					{'op': 'getstationandid', 'fromstation': $("#ReachStation").val(), 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].from  +";"+ objData[i].fromID+ ">" + objData[i].from + "</option>").appendTo($("#ReachStationselect"));
											}
						if($("#ReachStation").val() == ''){
							document.getElementById("ReachStationselect").style.display="none";
						}
				});
			   	document.onkeydown = function (event) {
			  		var e = event || window.event || arguments.callee.caller.arguments[0];
			     	if (e && e.keyCode == 13) {
			     		$("#ReachStationselect").focus();
			     		$("#ReachStationselect option:eq(0)").attr({selected:"selected"});
			     	}
			   	};
			});
			document.getElementById("ReachStationselect").onkeydown = function (event) {
	            var e = event || window.event || arguments.callee.caller.arguments[0];
	            if (e && e.keyCode == 13) {
	            	var stringsplit=document.getElementById("ReachStationselect").value.split(';');
	            	document.getElementById("ReachStation").value=stringsplit[0];
	            	document.getElementById("ReachStationID").value=stringsplit[1];
	           		document.getElementById("ReachStationselect").style.display="none";
	           		document.getElementById("resultquery").focus();
	            } 
			};
			document.getElementById("ReachStationselect").onclick = function (event){
				var stringsplit=document.getElementById("ReachStationselect").value.split(';');
            	document.getElementById("ReachStation").value=stringsplit[0];
            	document.getElementById("ReachStationID").value=stringsplit[1];
				document.getElementById("ReachStationselect").style.display="none";
			};
			$("#Balance").click(function(){
				jQuery.get(
						'tms_v1_accounting_dataProcess.php',
						{'op': 'stationbalance', 'FromStationID': $("#FromStationID").val(),'FromStation': $("#FromStation").val(),
							'ReachStationID2': $("#ReachStationID2").val(),'ReachStation2': $("#ReachStation2").val(),
							'CheckBeginDate': $("#checkdate1").val(),'CheckEndDate': $("#checkdate2").val(),'ticketnumber1':$("#ticketnumber1").val(),
							'allticketprice1':$("#allticketprice1").val(),'luggagenumber1':$("#luggagenumber1").val(),'allluggageprice1':$("#allluggageprice1").val(),
							'ticketnumber2':$("#ticketnumber2").val(),'allticketprice2':$("#allticketprice2").val(),'luggagenumber2':$("#luggagenumber2").val(),
							'allluggageprice2':$("#allluggageprice2").val(),'balancemoney':$("#balancemoney").val(),'time': Math.random()},
						function(data){
							var objData = eval('(' + data + ')');
							if(objData.retVal == "FAIL"){ 
	 							alert(objData.retString);
	 						}
	 						else {
	 							alert(objData.retString);
	 							location.assign('tms_v1_accounting_stationQuery.php')
	 						}
					});
			});
		});
		$(document).ready(function(){
			if(document.getElementById("ReachStation").value!=""){
				document.getElementById("Balance").disabled=false;
			}
			else{
				document.getElementById("Balance").disabled=true;
			}
		});
		function checkInfo(){
			if(document.getElementById("ReachStation").value==""){
				alert('请输入结算车站2！');
				return false;
			}
		}	
		</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 站 间 结 算</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		<table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
  			<tr>
    			<td colspan="5" bgcolor="#f0f8ff"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 站 间 结 算 查 询</td>
  			</tr>
		</table>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 日期：</span>
					<input type="text" name="date1Value" id="checkdate1" size="12" class="Wdate" value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>"  name="checkdate1" onclick="WdatePicker({onpicked:function(dp){$dp.$('date1Value').value=dp.cal.getDateStr();}});" />&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;
					<input type="text" name="date2Value" id="checkdate2" size="12" class="Wdate" value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="checkdate2" onclick="WdatePicker({onpicked:function(dp){$dp.$('date2Value').value=dp.cal.getDateStr();}});" />
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结算车站1：</span>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<input type="text" name="FromStation1" id="FromStation1" disabled="disabled" value="<?php echo $userStationName;?>"/>
					<input type="hidden" name="FromStation" id="FromStation" value="<?php echo $userStationName;?>"/>
					<input type="hidden" name="FromStationID" id="FromStationID" value="<?php echo $userStationID;?>"/>
				<!-- 
					<input type="hidden" name="FromStation" id="FromStation" value="<?php if(!$FromStation) echo $userStationName; else echo $FromStation;?>"/>
					<input type="hidden" name="FromStationID" id="FromStationID" value="<?php if(!$FromStation) echo $userStationID; else echo $FromStationID;?>"/>
				 -->
					<br/>
	    			<select id="FromStationselect" name="FromStationselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结算车站2：</span>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<input type="text" name="ReachStation" id="ReachStation" value="<?php echo $ReachStation;?>"/>
					<input type="hidden" name="ReachStationID" id="ReachStationID" value="<?php echo $ReachStationID;?>"/>
					<input type="hidden" name="ReachStation2" id="ReachStation2" value="<?php echo $ReachStation;?>"/>
					<input type="hidden" name="ReachStationID2" id="ReachStationID2" value="<?php echo $ReachStationID;?>"/>
					<br/>
	    			<select id="ReachStationselect" name="ReachStationselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
				</td>
			</tr>
			<tr>
				<td colspan="5" nowrap="nowrap" align="center" bgcolor="#FFFFFF">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" value="查询" onclick="return checkInfo();" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="Balance" name="Balance" value="结算"/>
				</td>
			</tr>
		</table>
		<?php 
			$select1="SELECT COUNT(st_TicketID)AS number, IFNULL(SUM(st_SellPrice),0) AS allprice FROM tms_sell_SellTicket WHERE st_FromStationID='{$ReachStationID}' 
				AND st_StationID='{$FromStationID}' AND st_SellDate>='{$CheckBeginDate}' AND st_SellDate<='{$CheckEndDate}' AND st_StationBalance!='8' AND st_TicketState!='5' 
				AND st_StationBalance!='8' AND st_TicketID NOT IN (SELECT rtk_TicketID FROM tms_sell_ReturnTicket WHERE rtk_FromStationID='{$ReachStationID}' AND 
				rtk_StationID='{$FromStationID}' AND rtk_SellDate>='{$CheckBeginDate}' AND rtk_SellDate<='{$CheckEndDate}') AND st_TicketID NOT IN (SELECT et_TicketID 
				FROM tms_sell_ErrTicket WHERE et_FromStationID='{$ReachStationID}' AND et_StationID='{$FromStationID}' AND et_SellDate>='{$CheckBeginDate}' AND 
				et_SellDate<='{$CheckEndDate}')";
			$query1=$class_mysql_default ->my_query("$select1");
			$row1=mysql_fetch_array($query1);
			$selectLuggageCons1="SELECT COUNT(lc_TicketNumber)AS number,IFNULL(SUM(lc_ConsignMoney),0) AS ConsignMoney,IFNULL(SUM(lc_PackingMoney),0) AS PackingMoney,IFNULL(SUM(lc_LabelMoney),0) AS LabelMoney,
				IFNULL(SUM(lc_HandlingMoney),0) AS HandlingMoney,IFNULL(SUM(lc_InsureFee),0) AS InsureFee FROM tms_lug_LuggageCons WHERE lc_DestinationID='{$FromStationID}' AND lc_StationID='{$ReachStationID}' AND 
				lc_PayStyle='收货人付款' AND lc_DeliveryDate>='{$CheckBeginDate}' AND lc_DeliveryDate<='{$CheckEndDate}' AND lc_StationBalance!='8'";
			$queryLuggageCons1=$class_mysql_default ->my_query("$selectLuggageCons1");
			if(!$queryLuggageCons1) echo mysql_error();
			$rowLuggageCons1=mysql_fetch_array($queryLuggageCons1);
			$allLuggagemoney1=$rowLuggageCons1['ConsignMoney']+$rowLuggageCons1['PackingMoney']+$rowLuggageCons1['LabelMoney']+$rowLuggageCons1['HandlingMoney']+$rowLuggageCons1['InsureFee'];
			$select2="SELECT COUNT(st_TicketID)AS number, IFNULL(SUM(st_SellPrice),0) AS allprice FROM tms_sell_SellTicket WHERE st_FromStationID='{$FromStationID}' 
				AND st_StationID='{$ReachStationID}' AND st_SellDate>='{$CheckBeginDate}' AND st_SellDate<='{$CheckEndDate}'AND st_StationBalance!='8' AND st_TicketState!='5' 
				AND st_StationBalance!='8' AND st_TicketID NOT IN (SELECT rtk_TicketID FROM tms_sell_ReturnTicket WHERE rtk_FromStationID='{$FromStationID}' AND 
				rtk_StationID='{$ReachStationID}' AND rtk_SellDate>='{$CheckBeginDate}' AND rtk_SellDate<='{$CheckEndDate}') AND st_TicketID NOT IN (SELECT et_TicketID 
				FROM tms_sell_ErrTicket WHERE et_FromStationID='{$FromStationID}' AND et_StationID='{$ReachStationID}' AND et_SellDate>='{$CheckBeginDate}' AND  
				et_SellDate<='{$CheckEndDate}')";
			$query2=$class_mysql_default ->my_query("$select2");
			$row2=mysql_fetch_array($query2);
			$selectLuggageCons2="SELECT COUNT(lc_TicketNumber)AS number,IFNULL(SUM(lc_ConsignMoney),0) AS ConsignMoney,IFNULL(SUM(lc_PackingMoney),0) AS PackingMoney,IFNULL(SUM(lc_LabelMoney),0) AS LabelMoney,
				IFNULL(SUM(lc_HandlingMoney),0) AS HandlingMoney,IFNULL(SUM(lc_InsureFee),0) AS InsureFee FROM tms_lug_LuggageCons WHERE lc_DestinationID='{$ReachStationID}' AND lc_StationID='{$FromStationID}' AND 
				lc_PayStyle='收货人付款' AND lc_DeliveryDate>='{$CheckBeginDate}' AND lc_DeliveryDate<='{$CheckEndDate}' AND lc_StationBalance!='8'";
			$queryLuggageCons2=$class_mysql_default ->my_query("$selectLuggageCons2");
			if(!$queryLuggageCons2) echo mysql_error();
			$rowLuggageCons2=mysql_fetch_array($queryLuggageCons2);
			$allLuggagemoney2=$rowLuggageCons2['ConsignMoney']+$rowLuggageCons2['PackingMoney']+$rowLuggageCons2['LabelMoney']+$rowLuggageCons2['HandlingMoney']+$rowLuggageCons2['InsureFee'];
			?>		
		</form>
		<div <?php if(!$ReachStation) echo "style='DISPLAY:none'"; ?>>
		<form action="" method="post" name="form2">
		<table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableborder" id="table1">  	
			<tr><td colspan="4" bgcolor="#cccccc"><?php echo $FromStation.'售'.$ReachStation;?></td></tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />售票数量：</span>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<input type="text" name="ticketnumber1" id="ticketnumber1" readonly="readonly" value="<?php echo $row1['number'];?>"/>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />售票金额：</span>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<input type="text" name="allticketprice1" id="allticketprice1" style="background-color:#F1E6C2" readonly="readonly" value="<?php echo $row1['allprice'];?>"/>
				</td>
			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />行包单数量：</span>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<input type="text" name="luggagenumber1" id="luggagenumber1" readonly="readonly" value="<?php echo $rowLuggageCons1['number'];?>"/>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />行包金额：</span>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<input type="text" name="allluggageprice1" id="allluggageprice1" style="background-color:#F1E6C2" readonly="readonly" value="<?php echo $allLuggagemoney1;?>"/>
				</td>
			</tr>
			<tr><td colspan="4" bgcolor="#cccccc"><?php echo $ReachStation.'售'.$FromStation;?></td></tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />售票数量：</span>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<input type="text" name="ticketnumber2" id="ticketnumber2" readonly="readonly" value="<?php echo $row2['number'];?>"/>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />售票金额：</span>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<input type="text" name="allticketprice2" id="allticketprice2" style="background-color:#F1E6C2" readonly="readonly" value="<?php echo $row2['allprice'];?>"/>
				</td>
			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />行包单数量：</span>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<input type="text" name="luggagenumber2" id="luggagenumber2" readonly="readonly" value="<?php echo $rowLuggageCons2['number'];?>"/>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />行包金额：</span>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<input type="text" name="allluggageprice2" id="allluggageprice2" style="background-color:#F1E6C2" readonly="readonly" value="<?php echo $allLuggagemoney2;?>"/>
				</td>
			</tr>	
			<tr><td colspan="4" bgcolor="#cccccc"><?php echo $FromStation.'付'.$ReachStation.'金额';?></td></tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />付款金额：</span>
				</td>
				<td colspan="3" nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<input type="text" name="balancemoney" id="balancemoney" style="background-color:#F1E6C2" readonly="readonly" value="<?php echo $row1['allprice']+$allLuggagemoney1-$row2['allprice']-$allLuggagemoney2;?>"/>
				</td>
			</tr>
		</table>
		</form>
		</div>
	</body>
</html>