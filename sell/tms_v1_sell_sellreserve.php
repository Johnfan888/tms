<?
//留票界面

define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>留票界面</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../css/tms.css" rel="stylesheet" type="text/css" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript">
	function searchreserve(){
		window.location.href='tms_v1_sell_searchreserve.php';
	}
	$(document).click(function(){
		$("#table1").tablesorter();
		document.getElementById("FromStationselect").style.display="none";
		document.getElementById("ReachStationselect").style.display="none";
	});
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
	       		document.getElementById("NoOfRunsQuery").focus();
	        } 
		};
		document.getElementById("ReachStationselect").onclick = function (event){
			document.getElementById("ReachStation").value=document.getElementById("ReachStationselect").value;
			document.getElementById("ReachStationselect").style.display="none";
		};
		$("#NoOfRunsQuery").keydown = function (event) {
	        var e = event || window.event || arguments.callee.caller.arguments[0];
	        if (e && e.keyCode == 13) {
				document.form1.submit();
	        } 
		};
	
		var currentStep = 1;
		var max_line_num = $("#table1 tbody tr").length;
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
				var url = "tms_v1_sell_sellreserveok.php?NoofrunsID=" + NoOfRunsID + "&Selldate=" + selldate + "&FromStation=" + fromstation + "&ReachStation=" + reachstation;
	        	window.location.href = url;
		    }
			if (e && e.keyCode == 27) {	//ESC
	        	document.location.href = "tms_v1_sell_sellreserve.php";
	        	return false;
	        }
		};
		document.onkeyup = function (event) {
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 27) {	//ESC
	        	document.location.href = "tms_v1_service_querynoofruns.php";
           		return false;
            }
		};
	});
	
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">留 票 查 询</span></td>
  </tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1" >
 <tr>
    <td width="10%" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 出发地：</span></td>
	<td nowrap="nowrap" width="10%">
		<input type="text" name="FromStation" id="FromStation" value="<?php echo $userStationName?>" />
    	<br/>
    	<select id="FromStationselect" name="FromStationselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
	</td>
    <td width="10%" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 目的地：</span></td>
	<td nowrap="nowrap" width="10%">
		<input type="text" name="ReachStation" id="ReachStation" />
    	<br/>
    	<select id="ReachStationselect" name="ReachStationselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
	</td>
	<td width="10%" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 乘车日期：</span></td>
	<td width="10%"><input name="selldate" id="selldate" class="Wdate" value="<?php print date('Y-m-d');?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
 </tr>
 <tr>
    <td colspan="6" align="center" bgcolor="#FFFFFF">
    	<input name="NoOfRunsQuery" id="NoOfRunsQuery" type="button" value="可售班次查询" onclick="document.form1.submit()" />&nbsp;&nbsp;&nbsp;&nbsp;
    	<input name="ReserveQuery" id="ReserveQuery" type="button" value="已预留查询" onclick="searchreserve()" />&nbsp;&nbsp;&nbsp;&nbsp;
    	<input type="button" name="back" id="back" value="返回"  onclick="location.assign('tms_v1_service_querynoofruns.php')"/>
    </td>
 </tr>
</table>
</form>
<div id="tableContainer" class="tableContainer" style="margin-top:-20px;"> 
<table class="main_tableboder" id="table1"> 
<thead class="fixedHeader">
  	<tr bgcolor="#006699">
	    <th nowrap="nowrap" align="center">班次</th>
	    <th nowrap="nowrap" align="center">发站</th>
	    <th nowrap="nowrap" align="center">到站</th>
	    <th nowrap="nowrap" align="center">发车日期</th>
	    <th nowrap="nowrap" align="center">发车时间</th>
	    <th nowrap="nowrap" align="center">到达时间</th>
	    <th nowrap="nowrap" align="center">票价</th>
	    <th nowrap="nowrap" align="center">车型</th>
	    <th nowrap="nowrap" align="center">余座</th>
	    <th nowrap="nowrap" align="center">余半票座</th>
	    <th nowrap="nowrap" align="center">通票</th>
	    <th nowrap="nowrap" align="center">操作</th>
	</tr>
</thead>
<tbody class="scrollContent"> 	
<?
	if(isset($_POST['selldate'])){
		$FromStation=$_POST['FromStation']; 
		$ReachStation=$_POST['ReachStation'];
		$Selldate=$_POST['selldate'];
		$sql="SELECT pd_NoOfRunsID,pd_FromStation,pd_ReachStation,pd_BeginStationTime,pd_StopStationTime,pd_FullPrice,tml_BusModel,
			tml_LeaveSeats,tml_LeaveHalfSeats,tml_BusID,tml_BusCard,tml_Allticket FROM tms_bd_PriceDetail LEFT OUTER JOIN tms_bd_TicketMode
			ON pd_NoOfRunsID=tml_NoOfRunsID	WHERE pd_FromStation='{$FromStation}' AND pd_ReachStation='{$ReachStation}' AND 
			pd_NoOfRunsdate='{$Selldate}' AND tml_NoOfRunsdate='{$Selldate}' AND tml_AllowSell='1' AND pd_IsPass='1' 
			ORDER BY STR_TO_DATE(pd_BeginStationTime,'%H:%i') ASC";  
		$resultsql = $class_mysql_default->my_query($sql); 
  		$lineNum = 0;
		while($rows = mysqli_fetch_array($resultsql)){
  			$lineNum++;
?>
  <tr id="<?php echo $lineNum?>" bgcolor="#CCCCCC">
    <td align="center"><?=$rows['pd_NoOfRunsID']?></td>
    <td align="center"><?=$rows['pd_FromStation']?></td>
    <td align="center"><?=$rows['pd_ReachStation']?></td>
    <td align="center"><?=$Selldate?></td>
    <td align="center"><?=$rows['pd_BeginStationTime']?></td>
    <td align="center"><?=$rows['pd_StopStationTime']?></td>
    <td align="center"><?=$rows['pd_FullPrice']?></td>
    <td align="center"><?=$rows['tml_BusModel']?></td>
    <td align="center"><?=$rows['tml_LeaveSeats']?></td>
    <td align="center"><?=$rows['tml_LeaveHalfSeats']?></td>
	<td align="center"><? if($rows['tml_Allticket']==0) echo '否'; else echo '是';?></td>
    <td align="center">[<a href="tms_v1_sell_sellreserveok.php?NoofrunsID=<?=$rows[0]?>&Selldate=<?=$Selldate?>&FromStation=<?=$FromStation?>&ReachStation=<?=$ReachStation?>"]>预定</a>]</td> 
  </tr>
<?
  		}
	} 
?>
</tbody>
</table>
</div>
</body>
</html>


