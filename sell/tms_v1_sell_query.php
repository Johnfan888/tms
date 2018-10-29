<?php	
/*
 * 
 * 可售班次查询页面
 * pd_IsPass: 1-可售;	2-检票;	3-发班
 * 
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

//if($userGroupID == "2")	require_once("../ui/user/topnoleft.inc.php");	//for seller

if (isset($_POST['FromStation'])) {
	$remainMoney = $_POST['remainMoney'];
	$selldate = $_POST['selldate'];
	$fromstation = $_POST['FromStation'];
	$reachstation = $_POST['ReachStation'];
	// 票价表中pd_BeginStationTime、pd_StopStationTime和pd_RunHours对应发车站时间、到达站时间和运行小时数；
	// 票版表中tml_RunHours对应起点站到终点站运行小时数
	$strsqlselet = "SELECT tml_NoOfRunsID, pd_BeginStation, pd_EndStation, pd_BeginStationTime, pd_StopStationTime, pd_FullPrice, tml_BusModel, tml_LeaveSeats, 
		tml_LeaveHalfSeats,	tml_BusID, tml_BusCard, pd_StintSell, pd_StintTime, pd_FromStation, pd_ReachStation, tml_NoOfRunsdate, tml_Allticket 
  		FROM tms_bd_PriceDetail	LEFT OUTER JOIN tms_bd_TicketMode ON tms_bd_PriceDetail.pd_NoOfRunsID = tms_bd_TicketMode.tml_NoOfRunsID 
  		WHERE pd_FromStation = '$fromstation' AND pd_ReachStation = '$reachstation' AND pd_NoOfRunsdate = '$selldate' 
  		AND tml_NoOfRunsdate = '$selldate' AND tml_AllowSell = '1' AND tml_LeaveSeats > 0 AND pd_IsPass='1' ORDER BY STR_TO_DATE(pd_BeginStationTime,'%H:%i') ASC";
	$resultselet = $class_mysql_default->my_query("$strsqlselet");
}
else {
	if (isset($_GET['op']) && $_GET['op'] == "mTicket") {
		$remainMoney = $_GET['remainMoney'];
	}
	else 
		$remainMoney = 0;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>可售班次查询</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../css/tms.css" rel="stylesheet" type="text/css" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
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
					//$("#sql").html(data);
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
				var beginstation = $("#" + currentStep).children().eq(1).text();
				var endstation = $("#" + currentStep).children().eq(2).text();
				var selldate = $("#" + currentStep).children().eq(3).text();
				var BeginStationTime = $("#" + currentStep).children().eq(4).text();
				var LeaveSeats = $("#" + currentStep).children().eq(8).text();
				var LeaveHalfSeats = $("#" + currentStep).children().eq(9).text();
				var fullPrice = $("#" + currentStep).children().eq(6).text();
				var busModel = $("#" + currentStep).children().eq(7).text();
				var isAllTicket = $("#" + currentStep).children().eq(10).text();
				var remainMoney = $("#" + currentStep).children().eq(11).text();
				var fromstation = $("#" + currentStep).children().eq(12).text();
				var reachstation = $("#" + currentStep).children().eq(13).text();
            	var url = "tms_v1_sell_sellview.php?i=" + NoOfRunsID + "&d=" + selldate + "&f=" + fromstation + "&r=" + reachstation + "&t=" + BeginStationTime + "&l=" + LeaveSeats + "&h=" + LeaveHalfSeats + "&p=" + fullPrice + "&m=" + busModel + "&a=" + isAllTicket + "&rm=" + remainMoney;
            	window.location.href = url;
            }
        };
	});

/*	
	function KeyDown(){ //屏蔽鼠标右键、Ctrl+n、shift+F10、F5刷新、退格键
		//alert("ASCII代码是："+event.keyCode);
		if ((window.event.altKey)&&
			((window.event.keyCode==37)|| //屏蔽 Alt+ 方向键 ←
			(window.event.keyCode==39))){ //屏蔽 Alt+ 方向键 →
			alert("不准你使用ALT+方向键前进或后退网页！");
			event.returnValue=false;
		} 
        if ((event.keyCode==8) || //屏蔽退格删除键
        	(event.keyCode==116)|| //屏蔽 F5 刷新键
        	(event.keyCode==112)|| //屏蔽 F1 刷新键
        	(event.ctrlKey && event.keyCode==82)){ //Ctrl + R
        	event.keyCode=0;
        	event.returnValue=false;
        } 
        if ((event.ctrlKey)&&(event.keyCode==78)) //屏蔽 Ctrl+n
            event.returnValue=false;
        if ((event.shiftKey)&&(event.keyCode==121)) //屏蔽 shift+F10
            event.returnValue=false;
        if (window.event.srcElement.tagName == "A" && window.event.shiftKey)
            window.event.returnValue = false; //屏蔽 shift 加鼠标左键新开一网页
        if ((window.event.altKey)&&(window.event.keyCode==115)){ //屏蔽Alt+F4
            window.showModelessDialog("about:blank","","dialogWidth:1px;dialogheight:1px");
            return false;
    	} 
	} 
*/
	document.onkeyup = function (event) {
		var e = event || window.event || arguments.callee.caller.arguments[0];
        if (e &&(e.altKey)) {
            switch (e.keyCode) {
            case 49:	//1
                location.assign("tms_v1_sell_return.php");
                break;
            case 50:	//2
                location.assign("tms_v1_websell_taketicket.php");
                break;
            case 51:	//3
                location.assign("tms_v1_sell_replacementquery");
                break;
            case 52:	//4
                location.assign("tms_v1_sell_privilegequery.php");
                break;
            case 53:	//5
                location.assign("tms_v1_sell_reprintticket.php");
                break;
            case 54:	//6
                location.assign("tms_v1_sell_error.php");
                break;
            case 55:	//7
                location.assign("tms_v1_sell_sellquery.php");
                break;
                default:
			}
       	}
        else {
            switch (e && e.keyCode) {
	        	case 113:	//F2
	            	location.assign("tms_v1_sell_return.php");
	            	break;
	        	case 114:	//F3
	            	location.assign("tms_v1_websell_taketicket.php");
	            	break;
	        	case 115:	//F4
	            	location.assign("tms_v1_sell_replacementquery");
	            	break;
	        	case 117:	//F6
	            	location.assign("tms_v1_sell_privilegequery.php");
	            	break;
	        	case 119:	//F8
	            	location.assign("tms_v1_sell_reprintticket.php");
	            	break;
	        	case 120:	//F9
	            	location.assign("tms_v1_sell_error.php");
	            	break;
	        	case 121:	//F10
	            	location.assign("tms_v1_sell_sellquery.php");
	            	break;
	            default:
       		}
        }
	};
	</script>
</head>
<body>
<!--<p id="sql"></p>-->
<form action="" method="post" name="form1">
<table width="100%" align="center" border="1" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="7" align="left" bgcolor="#FFFFFF">
			<input type="button" name="returnticket" id="returnticket" value="退票 (Alt+1)" onclick="location.assign('tms_v1_sell_return.php')"/>&nbsp;&nbsp;
			<input type="button" name="taketicket" id="taketicket" value="取票 (Alt+2)"  onclick="location.assign('tms_v1_websell_taketicket.php')"/>&nbsp;&nbsp;
			<input type="button" name="signticket" id="signticket" value="补票 (Alt+3)"  onclick="location.assign('tms_v1_sell_replacementquery')"/>&nbsp;&nbsp;
			<input type="button" name="alterticket" id="alterticket" value="特权补票 (Alt+4)"  onclick="location.assign('tms_v1_sell_privilegequery.php')"/>&nbsp;&nbsp;
			<input type="button" name="reserveticket" id="reserveticket" value="重打 (Alt+5)"  onclick="location.assign('tms_v1_sell_reprintticket.php')"/>&nbsp;&nbsp;
			<input type="button" name="reserveticket" id="reserveticket" value="废票 (Alt+6)"  onclick="location.assign('tms_v1_sell_error.php')"/>&nbsp;&nbsp;
			<input type="button" name="reserveticket" id="reserveticket" value="售票查询 (Alt+7)"  onclick="location.assign('tms_v1_sell_sellquery.php')"/>&nbsp;&nbsp;
		</td>
	</tr>
	<tr bgcolor="#CCCCCC">
		<td  nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 乘车日期：</span></td>
		<td ><input name="selldate" id="selldate" class="Wdate" value="<?php print date('Y-m-d');?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
    	<td  nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 乘车站：</span></td>
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
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="resultquery" id="resultquery" type="button" value="可售班次查询" />
			<input type="hidden" name="remainMoney" id="remainMoney" value="<?php echo $remainMoney?>" />
    	</td>
    </tr>
</table>
</form>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
	<tr bgcolor="#006699">
		<th nowrap="nowrap" align="center">班次</th>
		<th nowrap="nowrap" align="center">起点站</th>
		<th nowrap="nowrap" align="center">终点站</th>
		<th nowrap="nowrap" align="center">发车日期</th>
		<th nowrap="nowrap" align="center">发车时间</th>
		<th nowrap="nowrap" align="center">到达时间</th>
		<th nowrap="nowrap" align="center">全票价</th>
		<th nowrap="nowrap" align="center">车型</th>
		<th nowrap="nowrap" align="center">余座</th>
		<th nowrap="nowrap" align="center">余半票数</th>
		<th style="display:none"></th>
		<th style="display:none">上次余额</th>
		<th style="display:none">乘车站</th>
		<th style="display:none">到达站</th>
		<th nowrap="nowrap" align="center">通票</th>
		<th nowrap="nowrap" align="center">操作</th>
	</tr>
</thead> 
<tbody class="scrollContent"> 
<?php
if (isset($_POST['FromStation'])) {
	$lineNum = 0;
	while($rows = @mysqli_fetch_array($resultselet)) {
		$lineNum++;
?>
	<tr id="<?php echo $lineNum?>" bgcolor="#CCCCCC">
		<td align="center"><?php echo $rows['tml_NoOfRunsID']?></td>
		<td align="center"><?php echo $rows['pd_BeginStation']?></td>
		<td align="center"><?php echo $rows['pd_EndStation']?></td>
		<td align="center"><?php echo $selldate?></td>
		<td align="center"><?php echo $rows['pd_BeginStationTime']?></td>
		<td align="center"><?php echo $rows['pd_StopStationTime']?></td>
		<td align="center"><?php echo $rows['pd_FullPrice']?></td>
		<td align="center"><?php echo $rows['tml_BusModel']?></td>
		<td align="center"><?php echo $rows['tml_LeaveSeats']?></td>
		<td align="center"><?php echo $rows['tml_LeaveHalfSeats']?></td>
		<td style="display:none"><?php echo $rows['tml_Allticket']?></td>
		<td style="display:none"><?php echo $remainMoney?></td>
		<td style="display:none"><?php echo $fromstation?></td>
		<td style="display:none"><?php echo $reachstation?></td>
		<td align="center"><?php ($rows['tml_Allticket'] == "1")? print "是" : print "否";?></td>
		<td align="center">
	<!--	
			[<a href="tms_v1_sell_sellview_oldUI.php?i=<?php echo $rows['tml_NoOfRunsID']?>&d=<?php echo $selldate?>&f=<?php echo $fromstation?>&r=<?php echo $reachstation?>&t=<?php echo $rows['pd_BeginStationTime']?>&l=<?php echo $rows['tml_LeaveSeats']?>&h=<?php echo $rows['tml_LeaveHalfSeats']?>">开始售票</a>]
	-->
			[<a href="tms_v1_sell_sellview.php?i=<?php echo $rows['tml_NoOfRunsID']?>&d=<?php echo $selldate?>&f=<?php echo $fromstation?>&r=<?php echo $reachstation?>&t=<?php echo $rows['pd_BeginStationTime']?>&l=<?php echo $rows['tml_LeaveSeats']?>&h=<?php echo $rows['tml_LeaveHalfSeats']?>&p=<?php echo $rows['pd_FullPrice']?>&m=<?php echo $rows['tml_BusModel']?>&a=<?php echo $rows['tml_Allticket']?>&rm=<?php echo $remainMoney?>">开始售票</a>]
		</td>
	</tr>
<?php 
	}
}
?>
</tbody> 
</table> 
</div> 
</body> 
</html>
