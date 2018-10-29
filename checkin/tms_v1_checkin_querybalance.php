<?php
//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
$i=0;
require_once("../ui/inc/init.inc.php");
$selectTicketProvide="SELECT tp_CurrentTicket FROM tms_bd_TicketProvide WHERE tp_InceptUserID='{$userID}' AND tp_InceptTicketNum>0 AND tp_Type='结算单' ORDER BY tp_ProvideData ASC";
$queryTicketProvide=$class_mysql_default->my_query("$selectTicketProvide");
if(!$queryTicketProvide) echo $class_mysql_default->my_error();
$rowTicketProvide=mysqli_fetch_array($queryTicketProvide);
if($userStationName != "全部车站"){
	$Station=$userStationName;
}else{
	$Station=$_POST['stationselect'];
}

if(isset($_POST['LineName']))
{	$i=$_POST['num']+1;
	$LineName =$_POST['LineName'];
	$Begindate = $_POST['Begindate'];
	$Enddate = $_POST['Enddate'];
	$Busnumber=$_POST['Busnumber'];
	$station=$_POST['Station'];
	$checkinerID=$_POST['checkinerID'];
	$BalanceNO=$_POST['BalanceNO'];
}else{
	$LineName ='';
	$Begindate = '';
	$Enddate ='';
	$Busnumber='';
	$BalanceNO='';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>客凭查询</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../css/tms.css" rel="stylesheet" type="text/css" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
 	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="../basedata/tms_v1_rightclick.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#table1").tablesorter();
		$("#table1 tbody tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
		$("#table1 tbody tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
		$("#table1 tbody tr").click(function(){
			$("#table1 tbody tr:not(this)").css("background-color","#CCCCCC");
			$("#table1 tbody tr:not(this)").mouseover(function(){$(this).css("background-color","#F1E6C2");});
			$("#table1 tbody tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$(this).css("background-color","#FFCC00");
			$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
			$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
			$("#BalanceNO1").val($(this).children().eq(0).text());
			$("#NoOfRunsID").val($(this).children().eq(4).text());
			$("#NoOfRunsdate").val($(this).children().eq(6).text());
			$("#EndStation").val($(this).children().eq(9).text());
			$("#State").val($(this).children().eq(17).text());
			$("#BusID").val($(this).children().eq(18).text());
			$("#ReportDateTime").val($(this).children().eq(19).text());
		});
	});
		$(document).ready(function(){
			$("#LineName").keyup(function(){
				$("#LineNameselect").empty();
				document.getElementById("BusNumberselect").style.display="none";
				document.getElementById("LineNameselect").style.display=""; 
				var LineName = $("#LineName").val();
				var station = $("#stationselect").val();
				var start=$("#Begindate").val();
				var end=$("#Enddate").val();
				var checkinerID=$("#checkinerID").val();
				jQuery.get(
					'../schedule/tms_v1_schedule_dataops.php',
					{'op': 'GETLINE2', 'LineName': LineName,'station':station ,'start':start,'end':end,'checkinerID':checkinerID,'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].LineName + ">" + objData[i].LineName + "</option>").appendTo($("#LineNameselect"));
						}
						if(LineName==''){
							document.getElementById("LineNameselect").style.display="none";
						}
				});
			});
				document.getElementById("LineNameselect").onclick = function (event){
				document.getElementById("LineName").value=document.getElementById("LineNameselect").value;
				document.getElementById("LineNameselect").style.display="none";
			};
			$("#Busnumber").keyup(function(){
				$("#BusNumberselect").empty();
				document.getElementById("LineNameselect").style.display="none";
				document.getElementById("BusNumberselect").style.display=""; 
				var BusNumber = $("#Busnumber").val();
				jQuery.get(
					'../basedata/tms_v1_basedata_getbusdata.php',
					{'op': 'getbus', 'BusNumber': BusNumber, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].BusNumber + ">" + objData[i].BusNumber + "</option>").appendTo($("#BusNumberselect"));
						}
						if(BusNumber==''){
							document.getElementById("BusNumberselect").style.display="none";
						}
				});
			});
				document.getElementById("BusNumberselect").onclick = function (event){
				document.getElementById("Busnumber").value=document.getElementById("BusNumberselect").value;
				document.getElementById("BusNumberselect").style.display="none";
			};
		});
		$(document).ready(function(){
			$("#withdraw1").click(function(){
				withdraw();
			});
			$("#withdraw").click(function(){
				withdraw();
			});
			$("#nullify1").click(function(){
				nullify();
			});
			$("#nullify").click(function(){
				nullify();
			});
			$("#reprint1").click(function(){
				reprint();
			});
			$("#reprint").click(function(){
				reprint();
			});
			$("#resetting1").click(function(){
				resetting();
			});
			$("#resetting").click(function(){
				resetting();
			});
		});
		function withdraw(){
			var noofrun=document.getElementById("NoOfRunsID").value;
			var noofrundate=document.getElementById("NoOfRunsdate").value;
			var BusID=document.getElementById("BusID").value;
			var BNO1=document.getElementById("BalanceNO1").value;
			var curBN=document.getElementById("curBalanceNo").value;
			var RDT=document.getElementById("ReportDateTime").value;
			if (document.getElementById("BalanceNO1").value=='' || document.getElementById("BalanceNO1").value=='总计'){
				alert('请选择要注销的结算单！');
				return false;
			}else{
				//if(document.getElementById("State").value=='注销' || document.getElementById("State").value=='作废'){
				if(encodeURI(document.getElementById("State").value.substr(0,2))==encodeURI('注销') || encodeURI(document.getElementById("State").value.substr(0,2))==encodeURI('作废')){
					alert('该结算单已注销或作废！');
					return false;
				}else{
					if(!confirm("确定要注销该结算单吗？")){
						return false;
					}else{
						if(curBN==''){
							alert('没有可用的结算单！');
							return false;
						}
						jQuery.get(
								'tms_v1_checkin_dataops.php',
								{'op': 'withdraw', 'BalanceNO': $("#BalanceNO1").val(),'NoOfRunsID':$("#NoOfRunsID").val(),
									'NoOfRunsdate': $("#NoOfRunsdate").val(),'BusID': $("#BusID").val(),'time': Math.random()},
								function(data){
									var objData = eval('(' + data + ')');
									if( objData.retVal== "FAIL"){
										alert(objData.retString);
									}else{
										alert(objData.retString);
										location.assign('tms_v1_checkin_withdrawop.php?BNO='+BNO1+'&nrID='+noofrun+'&nrDate='+noofrundate+'&bID='+BusID+'&RDT='+RDT+'&cBN='+curBN);
									}
							});
					}
				}
			}
		}
		function nullify(){
			if (document.getElementById("BalanceNO1").value=='' || document.getElementById("BalanceNO1").value=='总计'){
				alert('请选择要作废的结算单！');
				return false;
			}else{
			//	if(document.getElementById("State").value=='注销' || document.getElementById("State").value=='作废'){
				if(encodeURI(document.getElementById("State").value.substr(0,2))==encodeURI('注销') || encodeURI(document.getElementById("State").value.substr(0,2))==encodeURI('作废')){
					alert('该结算单已注销或作废！');
					return false;
				}else{
					if(!confirm("确定要作废该结算单吗？")){
						return false;
					}else{
						jQuery.get(
								'tms_v1_checkin_dataops.php',
								{'op': 'nullify',  'BalanceNO': $("#BalanceNO1").val(),'NoOfRunsID':$("#NoOfRunsID").val(),
									'NoOfRunsdate': $("#NoOfRunsdate").val(),'BusID': $("#BusID").val(), 'time': Math.random()},
								function(data){
									var objData = eval('(' + data + ')');
									if( objData.retVal== "FAIL"){
										alert(objData.retString);
									}else{
										alert(objData.retString);
										document.form1.submit();
									}
							});
					}
				}
			}
		}
		function reprint(){
			var noofrun=document.getElementById("NoOfRunsID").value;
			var noofrundate=document.getElementById("NoOfRunsdate").value;
			var BusID=document.getElementById("BusID").value;
			var EndStation=document.getElementById("EndStation").value;
			var curBN=document.getElementById("curBalanceNo").value;
			var BNO1=document.getElementById("BalanceNO1").value;
			var RDT=document.getElementById("ReportDateTime").value;
		//	alert(document.getElementById("State").value);
			if (document.getElementById("BalanceNO1").value=='' || document.getElementById("BalanceNO1").value=='总计'){
				alert('请选择要重打的结算单！');
				return false;
			}else{
			//	if(document.getElementById("State").value=='正常'){
				if(encodeURI(document.getElementById("State").value.substr(0,2))==encodeURI('正常')){
					if(!confirm('确定重打结算单：'+document.getElementById("BalanceNO1").value+'吗？')){
						return false;
					}
					location.assign('tms_v1_checkin_printsheet.php?BNO='+BNO1+'&cbNo=nonumber'+'&RDT='+RDT+'&op=reprint');
				}else{
				//	alert(document.getElementById("BalanceNO1").value);
					if(curBN==''){
						alert('没有可用的结算单！');
						return false;
					}
					if(encodeURI(document.getElementById("State").value.substr(0,5))==encodeURI('注销未重打')){
						location.assign('tms_v1_checkin_withdrawop.php?BNO='+BNO1+'&nrID='+noofrun+'&nrDate='+noofrundate+'&bID='+BusID+'&RDT='+RDT+'&cBN='+curBN);
					}
					if(encodeURI(document.getElementById("State").value.substr(0,5))==encodeURI('作废未重打')){
						location.assign('tms_v1_checkin_printsheet.php?BNO='+BNO1+'&cbNo='+curBN+'&RDT='+RDT+'&op=reprint');
					}
					if(encodeURI(document.getElementById("State").value.substr(0,5))==encodeURI('作废已重打') ||encodeURI(document.getElementById("State").value.substr(0,5))==encodeURI('注销已重打')){
						alert('该结算单已重打！');
						return false;
					} 
			/*		if(document.getElementById("State").value=='注销'){
						alert('该客凭为注销客凭！');
						return false;
					} */
			/*		jQuery.get(
							'tms_v1_checkin_dataops.php',
							{'op': 'reprinte', 'BalanceNO': $("#BalanceNO1").val(), 'time': Math.random()},
							function(data){
								var objData = eval('(' + data + ')');
								if( objData.retVal== "FAIL"){
									alert(objData.retString);
									return false;
								}else{
								//	if(document.getElementById("State").value=='注销'){
									if(encodeURI(document.getElementById("State").value.substr(0,2))==encodeURI('注销')){
										location.assign('tms_v1_checkin_withdrawop.php?BNO='+BNO1+'&nrID='+noofrun+'&nrDate='+noofrundate+'&bID='+BusID+'&RDT='+RDT+'&cBN='+curBN);
									}else{
										location.assign('tms_v1_checkin_printsheet.php?BNO='+BNO1+'&cbNo='+curBN+'&RDT='+RDT+'&op=reprint');
									}
								}
						}); */
				}
			}
		}
		function resetting() {
			location.assign('tms_v1_checkin_resetingticket.php');
		}
		$(document).ready(function(){
			$("#stationselect").focus();
			$("#stationselect").keyup(function(){
				$("#Sit").empty();
				document.getElementById("Sit").style.display="";
				var Site = $("#stationselect").val();
				jQuery.get(
					'../basedata/tms_v1_bsaedata_dataProcess.php',
					{'op': 'Station', 'Site': Site, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].SiteName + ">" + objData[i].SiteName + "</option>").appendTo($("#Sit"));
						}
						if(Site==''){
							document.getElementById("Sit").style.display="none";
						}
					});	
			});
		});
	</script>
</head>
<body> 
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="#" id="withdraw1">注销客凭</a></li>   
        <li><a href="#" id="nullify1">作废客凭</a></li> 
        <li><a href="#" id="reprint1">重打客凭</a></li>  
        <li><a href="#" id="resetting1">重置客凭</a></li>  
        <li><a href="#" onclick="location.assign('tms_v1_checkin_checkticket.php');">返回</a></li> 
    </ul>   
</div>    
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr bgcolor="#FFFFFF">
		<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开单日期：</span></td>
		<td>
			<input type="text" name="Begindate" id="Begindate" size="12" class="Wdate" value="<?php ($Begindate == "")? print date('Y-m-d') : print $Begindate;?>" onclick="WdatePicker({onpicked:function(dp){$dp.$('date1Value').value=dp.cal.getDateStr();}});" />&nbsp;&nbsp;至&nbsp;&nbsp;
			<input type="text" name="Enddate" id="Enddate" size="12" class="Wdate" value="<?php ($Enddate == "")? print date('Y-m-d') : print $Enddate;?>" onclick="WdatePicker({onpicked:function(dp){$dp.$('date2Value').value=dp.cal.getDateStr();}});" />
		</td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车牌号：</span></td>
		<td nowrap="nowrap"><input name="Busnumber" id="Busnumber" value="<?php echo $Busnumber;?>"/>
			<br/>
	    	<select id="BusNumberselect" name="BusNumberselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
		</td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 线路：</span></td>
		<td nowrap="nowrap"><input name="LineName" id="LineName" value="<?php echo $LineName;?>"/>
			<br/>
	    	<select id="LineNameselect" name="LineNameselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站：</span></td>
		<td>
				<?php 
			     	if($userStationName == "全部车站"){
		     	?>
				        <input type="text" name="stationselect" id="stationselect" value="<?php echo $Station;?>" />
				        <br></br>
				    	<select id="Sit" name="Sit"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="form1.stationselect.value=this.value; this.style.display='none';"  >
						</select>
				<?php 
			     	}else{
				?>
						<input type="text" name="stationselect" id="stationselect" value="<?php echo $userStationName;?>" readonly="readonly" />
				<?php 
 			    	}
				?>
		</td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />检票员工号：</span></td>
		<td nowrap="nowrap"  ><input name="checkinerID" id="checkinerID" value="<?php echo $userID;?>"/></td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />结算单号：</span></td>
		<td nowrap="nowrap"><input name="BalanceNO" id="BalanceNO" value="<?php echo $BalanceNO;?>"/></td>
	</tr>
	<tr>
		<td colspan="6" align="center" nowrap="nowrap" bgcolor="#FFFFFF">
			<input type="button" name="resultquery" id="resultquery" value="查询客凭" onclick="document.form1.submit()"/>
			<input type="button" name="withdraw" id="withdraw" value="注销客凭" />
			<input type="button" name="nullify" id="nullify" value="作废客凭" />
			<input type="button" name="reprint" id="reprint" value="重打客凭"/>
			<input type="button" name="resetting" id="resetting" value="重置客凭"/>
			<input type="button" name="back" id="back" value="返回" onclick="location.assign('tms_v1_checkin_checkticket.php');"/>
		</td>
	</tr>
</table>
<div id="tableContainer" class="tableContainer">
<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableboder" id="table1">
<thead class="fixedHeader">
<tr bgcolor="#006699">
		<th nowrap="nowrap" align="center">结算单号</th>
		<th nowrap="nowrap" align="center">车牌号</th>
		<th nowrap="nowrap" align="center">车属单位</th>
		<th nowrap="nowrap" align="center">车型</th>
		<th nowrap="nowrap" align="center">班次编号</th>
		<th nowrap="nowrap" align="center">线路</th>
		<th nowrap="nowrap" align="center">发车日期</th>
		<th nowrap="nowrap" align="center">发车时间</th>
		<th nowrap="nowrap" align="center">始发站</th>
		<th nowrap="nowrap" align="center">终点站</th>
		<th nowrap="nowrap" align="center">站务费</th>
	<!--  
		<th nowrap="nowrap" align="center">劳务费(%)</th>
	-->
		<th nowrap="nowrap" align="center">行包费</th>
		<th nowrap="nowrap" align="center">总人数</th>
		<th nowrap="nowrap" align="center">总票价</th>
		<th nowrap="nowrap" align="center">结算价</th>
		<th nowrap="nowrap" align="center">开单日期</th>
		<th nowrap="nowrap" align="center">开单时间</th>
		<th nowrap="nowrap" align="center">结算单状态</th>
		<th nowrap="nowrap" align="center" style="display: none">车辆编号</th>
		<th nowrap="nowrap" align="center" style="display: none">报班时间</th>
	</tr>
</thead>
<tbody class="scrollContent">
<?php
	$number=0;
	$allServiceFee=0;
	$allPriceTotal=0;
	$allCheckTotal=0;
	$allotherFee3=0;
	$allbanlence=0;
//	if($station=='全部车站' || $station==''){
//		$stationstring="";
//	}else{
//		$stationstring=" AND bht_Station LIKE '{$station}'";
//	}
	if($checkinerID==''){
		$checkinerIDstring="";
	}else{
		$checkinerIDstring=" AND bht_UserID='{$userID}'";
	}
	if($BalanceNO==''){
		$BalanceNOstring="";
	}else{
		$BalanceNOstring=" AND bht_BalanceNO='{$BalanceNO}'";
	}
/*	$strsqlselet = "SELECT bht_BalanceNO, bht_BusNumber,bht_BusUnit,bht_BusModel,bht_NoOfRunsID,bht_NoOfRunsdate, bht_BeginStationTime,bht_BeginStation,bht_EndStation,bht_ServiceFee,
		bht_otherFee1,bht_otherFee2,bht_otherFee3,bht_otherFee4,bht_otherFee5,bht_otherFee6,bht_CheckTotal, 
		bht_PriceTotal, bht_Date, bht_Time, bht_State,bht_BusID,li_LineName FROM tms_acct_BalanceInHandTemp LEFT OUTER JOIN tms_bd_LineInfo ON li_LineID=bht_LineID WHERE (bht_Date >= '{$Begindate}') AND (bht_Date <= '{$Enddate}') 
		AND (bht_UserID='{$userID}') AND bht_BusNumber LIKE '{$Busnumber}%' AND li_LineName LIKE '{$LineName}%'";  */
	$strsqlselet = "SELECT bht_BalanceNO, bht_BusNumber,bht_BusUnit,bht_BusModel,bht_NoOfRunsID,bht_NoOfRunsdate,bht_ReportDateTime,bht_BeginStationTime,bht_BeginStation,bht_EndStation,bht_ServiceFee,
		bht_otherFee1,bht_otherFee2,bht_otherFee3,bht_otherFee4,bht_otherFee5,bht_otherFee6,bht_CheckTotal,bht_BalanceMoney,bht_ConsignMoney, 
		bht_PriceTotal, bht_Date, bht_Time, bht_State,bht_BusID,li_LineName FROM tms_acct_BalanceInHandTemp LEFT OUTER JOIN tms_bd_LineInfo ON li_LineID=bht_LineID WHERE (bht_Date >= '{$Begindate}') AND (bht_Date <= '{$Enddate}') 
		AND bht_BusNumber LIKE '{$Busnumber}%' AND li_LineName LIKE '{$LineName}%' AND IFNULL(bht_Station, '') like '{$Station}%'".$checkinerIDstring.$BalanceNOstring;
//	echo $strsqlselet;
	$resultselet = $class_mysql_default->my_query("$strsqlselet");
	if(!$resultselet) echo $class_mysql_default->my_error();
	while($rows = @mysqli_fetch_array($resultselet))	{
		$number=$number+1;
		if($rows['bht_State']=='正常'){
			$allServiceFee=$allServiceFee+$rows['bht_ServiceFee'];
			$allPriceTotal=$allPriceTotal+$rows['bht_PriceTotal'];
			$allCheckTotal=$allCheckTotal+$rows['bht_CheckTotal'];
			$allotherFee3=$allotherFee3+($rows['bht_PriceTotal']-$rows['bht_ServiceFee'])*$rows['bht_otherFee3'];
			$allbanlence=$allbanlence+$rows['bht_BalanceMoney'];
			$allConsignMoney=$allConsignMoney+$rows['bht_ConsignMoney'];
		}
	/*	else{
			$select="SELECT ct_BalanceNO FROM tms_chk_CheckTicket WHERE ct_BalanceNO='{$rows['bht_BalanceNO']}'";
			$query = $class_mysql_default->my_query("$select");
			if(mysqli_num_rows($query) == 0){
				$finded=0;
			}else{
				$finded=1;
			}
		}  */
?>
	<tr align="center" bgcolor="#CCCCCC">
		<td nowrap="nowrap"><?php echo $rows['bht_BalanceNO']?></td>
		<td nowrap="nowrap"><?php echo $rows['bht_BusNumber']?></td>
		<td nowrap="nowrap"><?php echo $rows['bht_BusUnit']?></td>
		<td nowrap="nowrap"><?php echo $rows['bht_BusModel']?></td>
		<td nowrap="nowrap"><?php echo $rows['bht_NoOfRunsID']?></td>
		<td nowrap="nowrap"><?php echo $rows['li_LineName']?></td>
		<td nowrap="nowrap"><?php echo $rows['bht_NoOfRunsdate']?></td>
		<td nowrap="nowrap"><?php echo $rows['bht_BeginStationTime']?></td>
		<td nowrap="nowrap"><?php echo $rows['bht_BeginStation']?></td>
		<td nowrap="nowrap"><?php echo $rows['bht_EndStation']?></td>
		<td nowrap="nowrap"><?php echo $rows['bht_ServiceFee']?></td>
	<!--  
		<td nowrap="nowrap"><?php echo $rows['bht_otherFee3']*100?></td>
	-->
		<td nowrap="nowrap"><?php echo $rows['bht_ConsignMoney']?></td>
		<td nowrap="nowrap"><?php echo $rows['bht_CheckTotal']?></td>
		<td nowrap="nowrap"><?php echo $rows['bht_PriceTotal']?></td>
		<td nowrap="nowrap"><?php echo $rows['bht_BalanceMoney']?></td>
		<td nowrap="nowrap"><?php echo $rows['bht_Date']?></td>
		<td nowrap="nowrap"><?php echo $rows['bht_Time']?></td>
	<!-- 
		<td nowrap="nowrap"><?php echo $rows['bht_State']?></td>
	 -->	
		<td nowrap="nowrap">
			<?php  echo $rows['bht_State'];
			/* 	if($rows['bht_State']=='正常'){
			 		echo $rows['bht_State'];
			 	}else{
			 		if($finded==0){
			 			echo $rows['bht_State'].'已重打';
			 		}else{
			 			echo $rows['bht_State'].'未重打';
			 		}
			 	} */
			?>
		</td>
		<td nowrap="nowrap" style="display: none"><?php echo $rows['bht_BusID']?></td>
		<td nowrap="nowrap" style="display: none"><?php echo $rows['bht_ReportDateTime']?></td>
	</tr>
	<?php
	}
	?>
	<tr align="center" bgcolor="#CCCCCC">
		<td nowrap="nowrap">总计</td>
		<td nowrap="nowrap"><?php echo $number?></td>
		<td nowrap="nowrap"></td>
		<td nowrap="nowrap"></td>
		<td nowrap="nowrap"></td>
		<td nowrap="nowrap"></td>
		<td nowrap="nowrap"></td>
		<td nowrap="nowrap"></td>
		<td nowrap="nowrap"></td>
		<td nowrap="nowrap"></td>
		<td nowrap="nowrap"><?php echo $allServiceFee?></td>
	<!--  
		<td nowrap="nowrap"><?php echo $allotherFee3?></td>
	-->
		<td nowrap="nowrap"><?php echo $allConsignMoney?></td>
		<td nowrap="nowrap"><?php echo $allCheckTotal?></td>
		<td nowrap="nowrap"><?php echo $allPriceTotal?></td>
		<td nowrap="nowrap"><?php echo $allbanlence?></td>
		<td nowrap="nowrap"></td>
		<td nowrap="nowrap"></td>
		<td nowrap="nowrap"></td>
		<td nowrap="nowrap" style="display: none"></td>
	</tr>
</tbody>
</table>
</div>
	<input type="hidden" id="num" name="num" value="<?php echo $i;?>"/>
	<input type="hidden" id="BalanceNO1" name="BalanceNO1" value="" />
	<input type="hidden" id="NoOfRunsID" name="NoOfRunsID" value="" />
	<input type="hidden" id="NoOfRunsdate" name="NoOfRunsdate" value="" />
	<input type="hidden" id="BusID" name="BusID" value=""/>
	<input type="hidden" id="ReportDateTime" name="ReportDateTime" value=""/>
	<input type="hidden" id="EndStation" name="EndStation" value="" />
	<input type="hidden" id="curBalanceNo" name="curBalanceNo" value="<?php echo $rowTicketProvide['tp_CurrentTicket'];?>" />
	<input type="hidden" id="State" name="State" value="" />
</form>
</body>
</html>