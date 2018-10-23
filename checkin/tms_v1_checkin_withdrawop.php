<?php
//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$BalanceNO=$_GET['BNO'];
$NoOfRunsID=$_GET['nrID'];
$NoOfRunsdate=$_GET['nrDate'];
$BusID=$_GET['bID'];
$curBalanceNo=$_GET['cBN'];
$ReportDateTime=$_GET['RDT'];
$Selectbus="SELECT bi_BusID,bi_BusNumber,bi_BusUnit FROM tms_bd_BusInfo WHERE bi_BusID='{$BusID}'";
$querybus=$class_mysql_default->my_query("$Selectbus");
$rowbus=mysql_fetch_array($querybus);
$selectbht="SELECT bht_BalanceNO,bht_BusID,bht_BusNumber,bht_BusUnit,bht_BusModelID,bht_BusModel,bht_NoOfRunsID,bht_NoOfRunsdate,bht_CheckTotal,bht_EndStation,li_LineName,
	tml_TotalSeats,tml_LeaveSeats,tml_NoOfRunstime,tml_Allticket FROM tms_acct_BalanceInHandTemp LEFT OUTER JOIN tms_bd_LineInfo ON bht_LineID=li_LineID 
	 LEFT OUTER JOIN tms_bd_TicketMode ON bht_NoOfRunsID=tml_NoOfRunsID AND tml_NoOfRunsdate=bht_NoOfRunsdate WHERE bht_BalanceNO='{$BalanceNO}'";
$querybht=$class_mysql_default->my_query("$selectbht");
$rowbht=mysql_fetch_array($querybht);
//$selectReport="SELECT "
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>客凭注销处理</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="./tms.css" rel="stylesheet" type="text/css" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
 	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#ticketID").focus();
		$("#ticketID").keyup(function(e){
			var RDT=document.getElementById("ReportDateTime").value;
			if(e.keyCode == 13){
				jQuery.get(
						'tms_v1_checkin_dataops.php',
						{'op': 'CONFIRMCHECKw','NoOfRunsID': $("#NoOfRunsID").val(), 'ticketID': $("#ticketID").val(),'NoOfRunsdate': $("#NoOfRunsdate").val(), 'BalanceNO': $("#BalanceNO").val(), 
							'BusID': $("#BusID").val(),'ReportDateTime':RDT,'time': Math.random()},
						function(data){
							//alert(data);
							var objData = eval('(' + data + ')');
							if(objData.retVal == "FAIL"){ 
								alert(objData.retString);
								document.getElementById("ticketID").value='';
								$("#ticketID").focus();
							}
							else{
								window.location.href='tms_v1_checkin_withdrawop.php?BNO='+document.getElementById("BalanceNO").value+'&nrID='+document.getElementById("NoOfRunsID").value+
									'&nrDate='+document.getElementById("NoOfRunsdate").value+'&bID='+document.getElementById("BusID").value+'&cBN='+document.getElementById("curBalanceNo").value+
									'&RDT='+RDT;;
							}
					});
				// do nothing at this moment
			}
		//	else {
		//		$("#ticketID").val(e.value);
		//	} 
		});
		$("#checkticketconfirm").click(function(){
			var RDT=document.getElementById("ReportDateTime").value;
			if (document.getElementById("ticketID").value == "") {
				alert("票号不能为空！");
				$("#ticketID").focus();
			}
			else {
				jQuery.get(
					'tms_v1_checkin_dataops.php',
					{'op': 'CONFIRMCHECKw','NoOfRunsID': $("#NoOfRunsID").val(),'ticketID': $("#ticketID").val(),'NoOfRunsdate': $("#NoOfRunsdate").val(), 'BalanceNO': $("#BalanceNO").val(), 
						'BusID': $("#BusID").val(),'ReportDateTime':RDT,'time': Math.random()},
					function(data){
						//alert(data);
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL"){ 
							alert(objData.retString);
							document.getElementById("ticketID").value='';
							$("#ticketID").focus();
						}
						else{
							window.location.href='tms_v1_checkin_withdrawop.php?BNO='+document.getElementById("BalanceNO").value+'&nrID='+document.getElementById("NoOfRunsID").value+
								'&nrDate='+document.getElementById("NoOfRunsdate").value+'&bID='+document.getElementById("BusID").value+'&cBN='+document.getElementById("curBalanceNo").value+
								'&RDT='+RDT;
						}
				});
			}
		});
		$("#back").click(function(){
			location.assign('tms_v1_checkin_querybalance.php');
		});
		$("#reprint").click(function(){
			var BalanceNO=document.getElementById("BalanceNO").value;
			var curBalanceNo=document.getElementById("curBalanceNo").value;
			var BusID=document.getElementById("BusID").value;
			var NoOfRunsID=document.getElementById("NoOfRunsID").value;
			var NoOfRunsdate=document.getElementById("NoOfRunsdate").value;
			var endstation=document.getElementById("endstation").value;
			var RDT=document.getElementById("ReportDateTime").value;
		//	alert(BalanceNO);
		//	alert(BalanceNO+','+curBalanceNo+','+BusID+','+NoOfRunsID+','+NoOfRunsdate+','+endstation);
			if(confirm('是否重打结算单？')){
				location.assign('tms_v1_checkin_printsheet.php?nrID='+NoOfRunsID+'&nrDate='+NoOfRunsdate+'&eStat='+endstation+'&cbNo='+curBalanceNo+'&BNO='+BalanceNO+'&bID='+BusID+'&RDT='+RDT+'&op=print');
			}else{
				return false;
			}
		});
		$("#newBusNumber").keyup(function(){
			$("#BusNumberselect").empty();  //选择车辆信息
			document.getElementById("BusNumberselect").style.display=""; 
			var BusNumber = $("#newBusNumber").val();
			jQuery.get(
				'../basedata/tms_v1_basedata_getbusdata.php',
				{'op': 'getbus1', 'BusNumber': BusNumber, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if(objData.retVal == "FAIL"){ 
						document.getElementById("BusNumberselect").style.display="none";
					}
					for (var i = 0; i < objData.length; i++) {
						$("<option value = " + objData[i].BusNumber + ',' + objData[i].BusID + ">" + objData[i].BusNumber + "</option>").appendTo($("#BusNumberselect"));
					}
					if(BusNumber==''){
						document.getElementById("BusNumberselect").style.display="none";
					}
			});
		});
		document.getElementById("BusNumberselect").onclick = function (event){
			var str=document.getElementById("BusNumberselect").value.split(',');
			document.getElementById("newBusNumber").value=str[0];
			document.getElementById("newBusID").value=str[1];
			var BusID=document.getElementById("BusID").value;
			if(BusID!=str[1]){
				jQuery.get(
					'tms_v1_checkin_dataops.php',
					{'op': 'changebus', 'newBusNumber': str[0],'newBusID':str[1],'BusID':BusID, 'BusNumber':$("#BusNumber").val(),
						'BalanceNO':$("#BalanceNO").val(),'NoOfRunsID':$("#NoOfRunsID").val(),'NoOfRunsdate':$("#NoOfRunsdate").val(),
						'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL"){ 
							alert(objData.retString);
						}else{
							alert(objData.retString);
							document.getElementById("BusNumber").value=objData.newBusNumber;
							document.getElementById("oldBusNumber").value=objData.newBusNumber;
							document.getElementById("BusID").value=objData.newBusID;
						}
				});
			}
			document.getElementById("BusNumberselect").style.display="none";
		};
	});
	function display(){
		if(document.getElementById("IsChangeBus").checked){
			document.getElementById("newBus").style.display='';
			document.getElementById("newBusNumber").style.display='';
			document.getElementById("newBusNumber").focus();
		}else{
			document.getElementById("newBus").style.display='none';
			document.getElementById("newBusNumber").style.display='none';
		}
	}	
	</script>
</head>
<body> 
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路：</span></td>
		<td nowrap="nowrap">
			<input type="hidden" name="ReportDateTime" id="ReportDateTime" value="<?php echo $ReportDateTime;?>"/>
			<input type="hidden" name="curBalanceNo" id="curBalanceNo" value="<?php echo $curBalanceNo;?>"/>
			<input type="hidden" name="BalanceNO" id="BalanceNO" value="<?php echo $rowbht['bht_BalanceNO'];?>"/>
			<input type="hidden" name="LineName" id="LineName" value="<?php echo  $rowbht['li_LineName'];?>"/>
			<input type="text" name="LineNam" id="LineNam" disabled="disabled" value="<?php echo  $rowbht['li_LineName'];?>"/>
		</td>
		<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：</span></td>
		<td>
			<input type="hidden" name="NoOfRunsID" id="NoOfRunsID" value="<?php echo $rowbht['bht_NoOfRunsID'];?>" />
			<input type="text" name="NoOfRunsIDD" id="NoOfRunsIDD" disabled="disabled" value="<?php  echo $rowbht['bht_NoOfRunsID'];?>"/>
		</td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />发车日期：</span></td>
		<td nowrap="nowrap">
			<input type="hidden" name="NoOfRunsdate" id="NoOfRunsdate" value="<?php echo $rowbht['bht_NoOfRunsdate'];?>"/>
			<input type="text" name="NoOfRunsdat" id="NoOfRunsdat"  disabled="disabled" value="<?php echo  $rowbht['bht_NoOfRunsdate'];?>"/>
		</td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />发车时间：</span></td>
		<td nowrap="nowrap">
			<input type="hidden" name="NoOfRunstime" id="NoOfRunstime" value="<?php echo $rowbht['tml_NoOfRunstime'];?>"/>
			<input type="text" name="NoOfRunstim" id="NoOfRunstim"  disabled="disabled" value="<?php echo  $rowbht['tml_NoOfRunstime'];?>"/>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 已售票数：</span></td>
		<td nowrap="nowrap">
			<input type="hidden" name="sellednums" id="sellednums" value="<?php echo $rowbht['tml_TotalSeats']-$rowbht['tml_LeaveSeats'];?>"/>
			<input type="text" name="sellednum" id="sellednum" disabled="disabled" value="<?php echo $rowbht['tml_TotalSeats']-$rowbht['tml_LeaveSeats'];?>"/>
		</td>
		<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />已检票数：</span></td>
		<td>
			<?php 
				$selectcheck="SELECT COUNT(ct_TicketID) AS number FROM tms_chk_CheckTicket WHERE ct_BalanceNO='{$rowbht['bht_BalanceNO']}'";
				$querycheck=$class_mysql_default->my_query("$selectcheck");
				$rowcheck=mysql_fetch_array($querycheck);
			?>
			<input type="hidden" name="checkednums" id="checkednums" value="<?php echo $rowcheck['number'];?>" />
			<input type="text" name="checkednum" id="checkednum" disabled="disabled" value="<?php  echo $rowcheck['number'];?>"/>
		</td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />是否通票：</span></td>
		<td nowrap="nowrap">
			<input type="hidden" name="allticket" id="allticket" value="<?php if($rowbht['tml_Allticket']=='1')echo '是'; else echo '否';?>"/>
			<input type="text" name="alltickets" id="alltickets"  disabled="disabled" value="<?php if($rowbht['tml_Allticket']=='1')echo '是'; else echo '否';?>"/>
		</td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />终点站：</span></td>
		<td nowrap="nowrap">
			<input type="hidden" name="endstation" id="endstation" value="<?php echo $rowbht['bht_EndStation'];?>"/>
			<input type="text" name="endstations" id="endstations"  disabled="disabled" value="<?php echo  $rowbht['bht_EndStation'];?>"/>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车牌号：</span></td>
		<td nowrap="nowrap">
			<input type="hidden" name="BusID" id="BusID" value="<?php echo $rowbus['bi_BusID'];?>"/>
			<input type="hidden" name="BusNumber" id="BusNumber" value="<?php echo $rowbus['bi_BusNumber'];?>"/>
			<input type="text" name="oldBusNumber" id="oldBusNumber"  disabled="disabled" value="<?php echo $rowbus['bi_BusNumber'];?>"/>
		</td>
		<td nowrap="nowrap"><input type="checkbox" name="IsChangeBus" id="IsChangeBus" onclick="return display()"/>是否更换车辆</td>
		<td nowrap="nowrap"><span id="newBus" style="display:none" class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />新车牌号：</span></td>
		<td nowrap="nowrap" colspan="4">
			<input type="hidden" name="newBusID" id="newBusID" />
			<input style="display:none" type="text" name="newBusNumber" id="newBusNumber" />
			<br/>
	    	<select id="BusNumberselect" name="BusNumberselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
		</td>
	</tr>
	<tr>
		<td colspan="8" align="center" nowrap="nowrap" bgcolor="#FFFFFF">
			<input type="button" name="reprint" id="reprint" value="重打结算单"/>
			<input type="button" name="back" id="back" value="返回"/>
		</td>
	</tr>
	<tr bgcolor="#CCCCCC">
			<td colspan="8">
		<?php if ($rowbht['tml_Allticket'] == "0") {?>
				<div id="<?=$rowbht['bht_NoOfRunsID']?>" style="display:">
					<iframe frameborder="1" id="heads" width="100%" src="tms_v1_checkin_seatview.php?nrID=<?=$rowbht['bht_NoOfRunsID']?>&nrDate=<?=$rowbht['bht_NoOfRunsdate']?>"></iframe>
				</div>
		<?php } else {?>
				<div id="<?=$rowbht['bht_NoOfRunsID']?>" style="display:none">
					<iframe frameborder="1" id="heads" width="100%" src="tms_v1_checkin_seatview.php?nrID=<?=$rowbht['bht_NoOfRunsID']?>&nrDate=<?=$rowbht['bht_NoOfRunsdate']?>"></iframe>
				</div>
		<?php }?>
			</td>
		</tr>
</table>
</form>
<div>
	<table width="100%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
		<tr bgcolor="#FFFFFF">
			<td>
				<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 票号：</span>&nbsp;&nbsp;
				<input type="text" name="ticketID" id="ticketID" value="" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="checkticketconfirm" id="checkticketconfirm" value="票号补检确认" /> 		
			</td>
		</tr>
	</table>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder" id="table3">
	<thead>
		<tr bgcolor="#006699">
			<th align="center" nowrap="nowrap">班次</th>
			<th align="center">票号</th>
			<th align="center">到站</th>
			<th align="center">售价</th>
			<th align="center">票型</th>
			<th align="center">座号</th>
			<th align="center">售票车站</th>
			<th align="center">检票时间</th>
			<th align="center">检票员</th>
		<!--  
			<th align="center">操作</th>
		-->
		</tr>
	</thead>
	<tbody>
	<?
		$strsqlselet = "SELECT ct_TicketID,ct_NoOfRunsID,ct_ReachStation,ct_SellPrice,ct_SellPriceType,ct_SeatID,ct_Checker,
					ct_NoOfRunsdate,ct_BusID,ct_CheckDate,ct_CheckTime,tms_sell_SellTicket.st_Station FROM tms_chk_CheckTicket,
					tms_sell_SellTicket WHERE tms_chk_CheckTicket.ct_TicketID=tms_sell_SellTicket.st_TicketID 
					AND ct_BalanceNO='{$rowbht['bht_BalanceNO']}'";
		$resultselet = $class_mysql_default ->my_query("$strsqlselet");
		while($rows2 = mysql_fetch_array($resultselet)) {		
	?>
		<tr align="center" bgcolor="#CCCCCC">
			<td nowrap="nowrap"><?=$rows2['ct_NoOfRunsID']?></td>
			<td nowrap="nowrap"><?=$rows2['ct_TicketID']?></td>
			<td nowrap="nowrap"><?=$rows2['ct_ReachStation']?></td>
			<td nowrap="nowrap"><?=$rows2['ct_SellPrice']?></td>
			<td nowrap="nowrap"><?=$rows2['ct_SellPriceType']?></td>
			<td nowrap="nowrap"><?($rowbht['tml_Allticket'] == "1")? print "XX" : print $rows2['ct_SeatID'];?></td>
			<td nowrap="nowrap"><?=$rows2['st_Station']?></td>
			<td nowrap="nowrap"><?=$rows2['ct_CheckDate']."  ".$rows2['ct_CheckTime']?></td>
			<td nowrap="nowrap"><?=$rows2['ct_Checker']?></td>
		<!--  
			<td align="center" nowrap="nowrap">[<a href="tms_v1_checkin_checkticket.php?nrID=<?=$rows2['ctt_NoOfRunsID']?>&nrDate=<?=$rows2['ctt_NoOfRunsdate']?>&tID=<?=$rows2['ctt_TicketID']?>&sID=<?=$rows2['ctt_SeatID']?>&allTkt=<?=$rows['ct_Allticket']?>&busID=<?=$rows2['ctt_BusID']?>&op=cancelcheck">退检</a>]</td>
		-->
		</tr>
	<?
		}
	?>
	</tbody>
	</table>
</div>
</body>
</html>
