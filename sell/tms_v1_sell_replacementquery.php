<?	
/*
 * 补票可售班次查询页面
 * 	
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head>
	<title>补票可售班次查询</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<link href="../css/tms.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#table1 tbody tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
		$("#table1 tbody tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
		$("#table1 tbody tr").click(function(){
			$("#table1 tbody tr:not(this)").css("background-color","#CCCCCC");
			$("#table1 tbody tr:not(this)").mouseover(function(){$(this).css("background-color","#F1E6C2");});
			$("#table1 tbody tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$(this).css("background-color","#F1E6C2");
			$(this).mouseout(function(){$(this).css("background-color","#CCCCCC");});
		});
	});
	$(document).ready(function(){
		if($("#table1 tr:gt(0)").length == 0){
			$("#ReachStation").focus();
		}
		else{
			$("#table1 tr:eq(1)").focus();
			$("#table1 tr:eq(1)").css("background-color","#F1E6C2");
		}
		 
		$("#FromStation").keyup(function(){
			document.getElementById("ReachStationselect").style.display="none";
			$("#FromStationselect").empty();
			document.getElementById("FromStationselect").style.display=""; 
			jQuery.get(
				'tms_v1_sell_sell.php',
				{'op': 'getstation', 'fromstation': $("#FromStation").val(), 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					for (var i = 0; i < objData.length; i++) {
						$("<option value = " + objData[i].from + ">" + objData[i].from + "</option>").appendTo($("#FromStationselect"));
					}
					if($("#FromStation").val() == ''){
						document.getElementById("FromStationselect").style.display="none";
					}
			});
		    document.onkeydown = function (event){
		  		var e = event || window.event || arguments.callee.caller.arguments[0];
		    	if (e && e.keyCode == 13) {
		     		$("#FromStationselect").focus();
		     		$("#FromStationselect option:eq(0)").attr({selected:"selected"});
		        }
		   };
		});
		$("#ReachStation").keyup(function(){
			document.getElementById("FromStationselect").style.display="none";
			$("#ReachStationselect").empty();
			document.getElementById("ReachStationselect").style.display=""; 
			jQuery.get(
				'tms_v1_sell_sell.php',
				{'op': 'getstation', 'fromstation': $("#ReachStation").val(), 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					for (var i = 0; i < objData.length; i++) {
						$("<option value = " + objData[i].from + ">" + objData[i].from + "</option>").appendTo($("#ReachStationselect"));
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
	});

	$(document).click(function(){
		document.getElementById("FromStationselect").style.display="none";
		document.getElementById("ReachStationselect").style.display="none";
	});
	
	function openShutManager(oSourceObj,oTargetObj,shutAble,oOpenTip,oShutTip)
	{
		var sourceObj = typeof oSourceObj == "string" ? document.getElementById(oSourceObj) : oSourceObj;
		var targetObj = typeof oTargetObj == "string" ? document.getElementById(oTargetObj) : oTargetObj;
		var openTip = oOpenTip || "";
		var shutTip = oShutTip || "";
		if(targetObj.style.display != "none") {
			if(shutAble) return;
			targetObj.style.display = "none";
			if(openTip  &&  shutTip){
				sourceObj.innerHTML = shutTip;
			}
		} else {
			targetObj.style.display="block";
			if(openTip && shutTip){
				sourceObj.innerHTML = openTip;
			}
		}
	}

	$(document).ready(function(){
		document.getElementById("FromStationselect").onkeydown = function (event) {
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 13) {
            	document.getElementById("FromStation").value=document.getElementById("FromStationselect").value;
           		document.getElementById("FromStationselect").style.display="none";
           		document.getElementById("ReachStation").focus();
            } 
		};
		document.getElementById("FromStationselect").onclick = function (event){
			document.getElementById("FromStation").value=document.getElementById("FromStationselect").value;
			document.getElementById("FromStationselect").style.display="none";
		};
		document.getElementById("ReachStationselect").onkeydown = function (event) {
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 13) {
            	document.getElementById("ReachStation").value=document.getElementById("ReachStationselect").value;
           		document.getElementById("ReachStationselect").style.display="none";
           		document.getElementById("resultquery").focus();
            } 
		};
		document.getElementById("ReachStationselect").onclick = function (event){
			document.getElementById("ReachStation").value=document.getElementById("ReachStationselect").value;
			document.getElementById("ReachStationselect").style.display="none";
		};
		$("#resultquery").keydown = function (event) {
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 13) {
    			jQuery.get(
    					'tms_v1_sell_delwebandreserve.php',
    					{'op': 'dellticket', 'FromStation': $("#FromStation").val(), 'time': Math.random()},
    					function(data){
    						var objData = eval('(' + data + ')');
    						if(objData.retVal == "FAIL"){
    							alert(objData.retString);
    						}else{
    							document.form1.submit();
    						}
    				});	
           } 
		};
		$("#resultquery").click(function(){
			jQuery.get(
					'tms_v1_sell_delwebandreserve.php',
					{'op': 'dellticket', 'FromStation': $("#FromStation").val(), 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL"){
							alert(objData.retString);
						}else{
							document.form1.submit();
						}
				});	
		});

		var currentStep = 1;
		var max_line_num = $("#table1 tr:gt(0)").length;
		document.onkeydown = function (event) {
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 38) {
    			if(currentStep == 1) {
    				$("#" + currentStep).css("background-color","#CCCCCC");
    				currentStep = max_line_num;
    				$("#" + currentStep).css("background-color","#F1E6C2");
    			}
    			else {
    				$("#" + currentStep).css("background-color","#CCCCCC");
    				currentStep--;
    				$("#" + currentStep).css("background-color","#F1E6C2");
    			}
            }
            if (e && e.keyCode == 40) {
    			if(currentStep == max_line_num) {
    				$("#" + currentStep).css("background-color","#CCCCCC");
    				currentStep = 1;
    				$("#" + currentStep).css("background-color","#F1E6C2");
    			}
    			else {
    				$("#" + currentStep).css("background-color","#CCCCCC");
    				currentStep++;
    				$("#" + currentStep).css("background-color","#F1E6C2");
    			}
            }
            if (e && e.keyCode == 33) {
				$("#" + currentStep).css("background-color","#CCCCCC");
				currentStep = 1;
				$("#" + currentStep).css("background-color","#F1E6C2");
            }
            if (e && e.keyCode == 34) {
				$("#" + currentStep).css("background-color","#CCCCCC");
				currentStep = max_line_num;
				$("#" + currentStep).css("background-color","#F1E6C2");
            }
            if (e && e.keyCode == 13) {
				var NoOfRunsID = $("#" + currentStep).children().eq(0).text();
				var fromstation = $("#" + currentStep).children().eq(1).text();
				var reachstation = $("#" + currentStep).children().eq(2).text();
				var selldate = $("#" + currentStep).children().eq(3).text();
				var BeginStationTime = $("#" + currentStep).children().eq(4).text();
				var LeaveSeats = $("#" + currentStep).children().eq(7).text();
				var LeaveHalfSeats = $("#" + currentStep).children().eq(8).text();
				var fullPrice = $("#" + currentStep).children().eq(5).text();
				var busModel = $("#" + currentStep).children().eq(6).text();
				var isAllTicket = $("#" + currentStep).children().eq(9).text();
            	var url = "tms_v1_sell_sellview.php?i=" + NoOfRunsID + "&d=" + selldate + "&f=" + fromstation + "&r=" + reachstation + "&t=" + BeginStationTime + "&l=" + LeaveSeats + "&h=" + LeaveHalfSeats + "&p=" + fullPrice + "&m=" + busModel + "&a=" + isAllTicket;
            	window.location.href = url;
            }
            if (e && e.keyCode == 27) {	//ESC
        		document.location.href = "tms_v1_sell_query.php";
        	}
        };
	});
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">补 票 界 面</span></td>
  </tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" align="center" border="1" cellpadding="0" cellspacing="0">
	<tr bgcolor="#CCCCCC">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 乘车日期：</span></td>
		<td><input name="selldate" id="selldate" class="Wdate" value="<?php print date('Y-m-d');?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
    	<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 乘车站：</span></td>
		<td nowrap="nowrap">
			<input type="text" name="FromStation" id="FromStation" value="<?php echo $userStationName?>" />
	    	<br/>
	    	<select id="FromStationselect" name="FromStationselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
		</td>
    	<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 到达站：</span></td>
		<td nowrap="nowrap">
			<input type="text" name="ReachStation" id="ReachStation" />
	    	<br/>
	    	<select id="ReachStationselect" name="ReachStationselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
		</td>
    	<td align="center">
    		<input name="resultquery" id="resultquery" type="button" value="可售班次查询" />
 		   	&nbsp;&nbsp;<input type="button" name="back" id="back" value="返回"  onclick="location.assign('tms_v1_sell_query.php')" />
    	</td>
    </tr>
</table>
</form>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
	<tr >
		<th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">起点站</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">终点站</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">全票价</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">车型</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">余座</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">余半票数</th>
		<th style="display:none"></th>
	<!--
		<td nowrap="nowrap" align="center">通票</td>
	-->
		<th nowrap="nowrap" align="center" bgcolor="#006699">操作</th>
	</tr>
		  </thead> 
<tbody class="scrollContent"> 
	<?
	if (isset($_REQUEST['FromStation'])) {
		$selldate = $_REQUEST['selldate'];
		$fromstation = $_REQUEST['FromStation'];
		$reachstation = $_REQUEST['ReachStation'];
	/*	$strsqlselet = "SELECT tml_NoOfRunsID, pd_BeginStation, pd_EndStation, pd_BeginStationTime, pd_FullPrice, tml_BusModel, tml_LeaveSeats, 
			tml_LeaveHalfSeats,	tml_BusID, tml_BusCard, pd_StintSell, pd_StintTime, pd_FromStation, pd_ReachStation, tml_NoOfRunsdate, tml_Allticket 
  			FROM tms_bd_PriceDetail	LEFT OUTER JOIN tms_bd_TicketMode ON tms_bd_PriceDetail.pd_NoOfRunsID = tms_bd_TicketMode.tml_NoOfRunsID 
  			WHERE pd_FromStation = '$fromstation' AND pd_ReachStation = '$reachstation' AND pd_NoOfRunsdate = '$selldate' 
  			AND tml_NoOfRunsdate = '$selldate' AND tml_StopRun = '2' AND tml_LeaveSeats > 0 ORDER BY STR_TO_DATE(pd_BeginStationTime,'%H:%i') DESC"; */
		$strsqlselet = "SELECT tml_NoOfRunsID, pd_BeginStation, pd_EndStation, pd_BeginStationTime, pd_FullPrice, tml_BusModel, tml_LeaveSeats, 
			tml_LeaveHalfSeats,	tml_BusID, tml_BusCard, pd_StintSell, pd_StintTime, pd_FromStation, pd_ReachStation, tml_NoOfRunsdate, tml_Allticket 
  			FROM tms_bd_PriceDetail	LEFT OUTER JOIN tms_bd_TicketMode ON tms_bd_PriceDetail.pd_NoOfRunsID = tms_bd_TicketMode.tml_NoOfRunsID 
  			WHERE pd_FromStation = '$fromstation' AND pd_ReachStation = '$reachstation' AND pd_NoOfRunsdate = '$selldate' 
  			AND tml_NoOfRunsdate = '$selldate' AND  tml_AllowSell = '1' AND tml_LeaveSeats > 0 AND pd_IsPass='2' ORDER BY STR_TO_DATE(pd_BeginStationTime,'%H:%i') DESC";
		$resultselet = $class_mysql_default ->my_query("$strsqlselet");
		$lineNum = 0;
		while($rows = @mysqli_fetch_array($resultselet)) {
			$lineNum++;
	?>
	<tr id="<?php echo $lineNum?>" bgcolor="#CCCCCC">
		<td align="center"><?=$rows['tml_NoOfRunsID']?></td>
		<td align="center"><?=$rows['pd_BeginStation']?></td>
		<td align="center"><?=$rows['pd_EndStation']?></td>
		<td align="center"><?=$selldate?></td>
		<td align="center"><?=$rows['pd_BeginStationTime']?></td>
		<td align="center"><?=$rows['pd_FullPrice']?></td>
		<td align="center"><?=$rows['tml_BusModel']?></td>
		<td align="center"><?=$rows['tml_LeaveSeats']?></td>
		<td align="center"><?=$rows['tml_LeaveHalfSeats']?></td>
		<td style="display:none"><?=$rows['tml_Allticket']?></td>
	<!--
		<td align="center"><?($rows['tml_Allticket'] == "1")? print "是" : print "否";?></td>
	-->
		<td align="center">
	<!--	
			[<a href="tms_v1_sell_sellview_oldUI.php?i=<?=$rows['tml_NoOfRunsID']?>&d=<?=$selldate?>&f=<?=$fromstation?>&r=<?=$reachstation?>&t=<?=$rows['pd_BeginStationTime']?>&l=<?=$rows['tml_LeaveSeats']?>&h=<?=$rows['tml_LeaveHalfSeats']?>"]">开始售票</a>]
	-->
			[<a href="tms_v1_sell_sellview.php?i=<?=$rows['tml_NoOfRunsID']?>&d=<?=$selldate?>&f=<?=$fromstation?>&r=<?=$reachstation?>&t=<?=$rows['pd_BeginStationTime']?>&l=<?=$rows['tml_LeaveSeats']?>&h=<?=$rows['tml_LeaveHalfSeats']?>&p=<?=$rows['pd_FullPrice']?>&m=<?=$rows['tml_BusModel']?>&a=<?=$rows['tml_Allticket']?>">开始售票</a>]
		</td>
	</tr>
<?php 
		}
	}	
?>
 
</table> 
</div> 
</body> 
</html>

