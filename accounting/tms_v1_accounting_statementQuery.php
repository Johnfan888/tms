<?php
/*
 * 车辆结算页面
 * 用车辆编号查询检票表，如果有结算单号，则表明此班次已打单，可以结算。
 * 不一定要打印结算单才能结算，如有需要可以补打结算单。
 * 代理费 =（营收金额-站务费）* 代理费比率（ct_otherFee3）
 * 或          =（营收金额-站务费-微机费-发班费）* 代理费比率（ct_otherFee3）
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$statFileName = "data" . $userID;
if(file_exists("$statFileName")) unlink("$statFileName");

$CheckBeginDate = "";
$CheckEndDate = "";
$busID = "";
if(isset($_POST['resultquery']) || isset($_POST['exceldoc'])) {
	$CheckBeginDate = $_POST['date1Value'];
	$CheckEndDate = $_POST['date2Value'];
	$BalanceStyle=$_POST['BalanceStyle'];
	$BusUnit=$_POST['BusUnit'];
	if (($busID = $_POST['busID']) == "")
		$busID = "%";
	
	if(isset($_POST['exceldoc'])) {
		$file_name = "info.xls";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");
		
		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '', '', '', '', '', '车辆结算信息表', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$CheckBeginDate" . "至" . "$CheckEndDate";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('结算单号', '车辆编号', '车牌号', '开单员ID', '开单员', '车站ID', '车站', '开单时间', '班次', '线路编号', '发车日期', 
				'始发站', '终点站', '人数', '张数', '营收金额', '结算金额', '站务费', '微机费', '发班费', '代理费', '费用4', '费用5', '费用6','车属单位');
		fputcsv($fp, $head);

		$cnt = 0; 
		$limit = 100000; 
		$outputRow = "";
		if($BalanceStyle=='0'){
			$queryString = "SELECT ct_BalanceNO, ct_BusID, ct_BusNumber, ct_CheckerID, ct_Checker, ct_StationID, ct_Station, 
				ct_CheckDate, ct_NoOfRunsID, ct_LineID,	ct_NoOfRunsdate, ct_BeginStation, ct_EndStation, 
				IFNULL(SUM(ct_TotalMan),0) AS ct_sumPerson, COUNT(ct_TicketID) AS ct_sumTicket,	
				IFNULL(SUM(ct_SellPrice),0) AS ct_sumMoney, IFNULL(SUM(ct_BalancePrice),0) AS ct_sumBalancePrice, 
				IFNULL(SUM(ct_ServiceFee),0) AS ct_sumServiceFee, IFNULL(SUM(ct_otherFee1),0) AS ct_sumOtherFee1, 
				IFNULL(SUM(ct_otherFee2),0) AS ct_sumOtherFee2, ct_otherFee3, IFNULL(SUM(ct_otherFee4),0) AS ct_sumOtherFee4, 
				IFNULL(SUM(ct_otherFee5),0) AS ct_sumOtherFee5, IFNULL(SUM(ct_otherFee6),0) AS ct_sumOtherFee6, bi_BusUnit 
				FROM tms_chk_CheckTicket,tms_bd_BusInfo WHERE (ct_CheckDate >= '{$CheckBeginDate}') AND (ct_CheckDate <= '{$CheckEndDate}') 
				AND (ct_IsBalance = 0) AND (ct_BusID LIKE '{$busID}')  AND (ct_BusID=bi_BusID) GROUP BY ct_BalanceNO ORDER BY ct_BalanceNO ASC";
		}else{
			$queryString = "SELECT ct_BalanceNO, ct_BusID, ct_BusNumber, ct_CheckerID, ct_Checker, ct_StationID, ct_Station, 
				ct_CheckDate, ct_NoOfRunsID, ct_LineID,	ct_NoOfRunsdate, ct_BeginStation, ct_EndStation, 
				IFNULL(SUM(ct_TotalMan),0) AS ct_sumPerson, COUNT(ct_TicketID) AS ct_sumTicket,	
				IFNULL(SUM(ct_SellPrice),0) AS ct_sumMoney, IFNULL(SUM(ct_BalancePrice),0) AS ct_sumBalancePrice, 
				IFNULL(SUM(ct_ServiceFee),0) AS ct_sumServiceFee, IFNULL(SUM(ct_otherFee1),0) AS ct_sumOtherFee1, 
				IFNULL(SUM(ct_otherFee2),0) AS ct_sumOtherFee2, ct_otherFee3, IFNULL(SUM(ct_otherFee4),0) AS ct_sumOtherFee4, 
				IFNULL(SUM(ct_otherFee5),0) AS ct_sumOtherFee5, IFNULL(SUM(ct_otherFee6),0) AS ct_sumOtherFee6, bi_BusUnit 
				FROM tms_chk_CheckTicket,tms_bd_BusInfo WHERE (ct_CheckDate >= '{$CheckBeginDate}') AND (ct_CheckDate <= '{$CheckEndDate}') 
				AND (ct_IsBalance = 0) AND (bi_BusUnit='{$BusUnit}') AND (ct_BusID=bi_BusID)  GROUP BY ct_BalanceNO ORDER BY ct_BalanceNO ASC";
		}
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysql_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			
			$ct_otherFee3 = ($row['ct_sumMoney']-$row['ct_sumServiceFee'])*$row['ct_otherFee3'];
			
			//取得结算金额 （结算价是否区分半价和全价车票？如果区分，这里需要根据结算单号取出每条记录，单独处理）
			if($row['ct_sumBalancePrice'] == 0) 
				$BalanceMoney = $row['ct_sumMoney'] - $row['ct_sumServiceFee'] - $row['ct_sumOtherFee1'] - $row['ct_sumOtherFee2']
							- $ct_otherFee3 - $row['ct_sumOtherFee4'] - $row['ct_sumOtherFee5'] - $row['ct_sumOtherFee6'];
			else
				$BalanceMoney = $row['ct_sumBalancePrice'];
			
			$outputRow = array($row['ct_BalanceNO'], $row['ct_BusID'], $row['ct_BusNumber'], $row['ct_CheckerID'], $row['ct_Checker'], 
				$row['ct_StationID'], $row['ct_Station'], $row['ct_CheckDate'], $row['ct_NoOfRunsID'], $row['ct_LineID'], $row['ct_NoOfRunsdate'], 
				$row['ct_BeginStation'], $row['ct_EndStation'], $row['ct_sumPerson'], $row['ct_sumTicket'], $row['ct_sumMoney'], 
				$BalanceMoney, $row['ct_sumServiceFee'], $row['ct_sumOtherFee1'], $row['ct_sumOtherFee2'], $ct_otherFee3, 
				$row['ct_sumOtherFee4'], $row['ct_sumOtherFee5'], $row['ct_sumOtherFee6'],$row['bi_BusUnit']); 
			fputcsv($fp, $outputRow); 
		}

		fclose($fp);
		exit();
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>车辆结算</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../css/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script>
		$(document).ready(function(){
			$("#table1").tablesorter();
			$("#table1 tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
			$("#table1 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$("#table1 tr").click(function(){
				$("#table1 tr:not(this)").css("background-color","#CCCCCC");
				$("#table1 tr:not(this)").mouseover(function(){$(this).css("background-color","#F1E6C2");});
				$("#table1 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
				$(this).css("background-color","#FFCC00");
				$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
				$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
			});
		});
		
		$(document).ready(function(){
			balancedis();
			$("#BalanceStyle").change(function(){
				balancedis();
			});
		});

		function balancedis(){
			if(document.getElementById("BalanceStyle").value=='0'){
				document.getElementById("DisbusID").style.display="";
				document.getElementById("DisBusUnit").style.display="none";
				document.getElementById("BusUnit").value="";
				
			}else {
				document.getElementById("DisBusUnit").style.display="";
				document.getElementById("busID").value="";
				document.getElementById("DisbusID").style.display="none";
			}
		}
		
		$(document).ready(function(){
			$("#statbalance").click(function(){
				if ($("#BalanceStyle").val() == '0'){
					if($("#busID").val() == "") {
						alert("请输入车辆编号，查询后再提交结算！");
						$("#busID").focus();
						return false;
					}
				}
				// 如果数据量超过POST限制，可以只存储ct_BalanceNO，在结算页面重新查询
				var trs = $("#table1 tr:gt(0)");
				if(trs.length == 0) {
					alert("提交数据为空！请重新查询后再提交结算。");
					$("#busID").focus();
					return false;
				}
				var statData = "[";
				$.each(trs, function(i,v){
					var tr = trs.eq(i);
					statData = statData + "{" + 
						"\"ct_BalanceNO\":\"" + tr.children().eq(0).text() + "\"," +
						"\"ct_BusID\":\"" + tr.children().eq(1).text() + "\"," + 
						"\"ct_BusNumber\":\"" + tr.children().eq(2).text() + "\"," +
						"\"ct_CheckerID\":\"" + tr.children().eq(3).text() + "\"," +
						"\"ct_Checker\":\"" + tr.children().eq(4).text() + "\"," +
						"\"ct_StationID\":\"" + tr.children().eq(5).text() + "\"," +
						"\"ct_Station\":\"" + tr.children().eq(6).text() + "\"," +
						"\"ct_CheckDate\":\"" + tr.children().eq(7).text() + "\"," +
						"\"ct_NoOfRunsID\":\"" + tr.children().eq(8).text() + "\"," +
						"\"ct_LineID\":\"" + tr.children().eq(9).text() + "\"," +
						"\"ct_NoOfRunsdate\":\"" + tr.children().eq(10).text() + "\"," +
						"\"ct_BeginStation\":\"" + tr.children().eq(11).text() + "\"," +
						"\"ct_EndStation\":\"" + tr.children().eq(12).text() + "\"," +
						"\"ct_sumPerson\":\"" + tr.children().eq(13).text() + "\"," +
						"\"ct_sumTicket\":\"" + tr.children().eq(14).text() + "\"," +
						"\"ct_sumMoney\":\"" + tr.children().eq(15).text() + "\"," +
						"\"ct_sumBalancePrice\":\"" + tr.children().eq(16).text() + "\"," +
						"\"ct_sumServiceFee\":\"" + tr.children().eq(17).text() + "\"," +
						"\"ct_sumOtherFee1\":\"" + tr.children().eq(18).text() + "\"," +
						"\"ct_sumOtherFee2\":\"" + tr.children().eq(19).text() + "\"," +
						"\"ct_sumOtherFee3\":\"" + tr.children().eq(20).text() + "\"," +
						"\"ct_sumOtherFee4\":\"" + tr.children().eq(21).text() + "\"," +
						"\"ct_sumOtherFee5\":\"" + tr.children().eq(22).text() + "\"," +
						"\"ct_sumOtherFee6\":\"" + tr.children().eq(23).text() + "\"," +
						"\"bi_BusUnit\":\"" + tr.children().eq(24).text() + "\"" +
						"},";
				});
				statData = statData.substring(0, statData.length - 1);
				statData = statData + "]";
				jQuery.post(
					'tms_v1_accounting_dataProcess.php',
					{'op': 'setStatData', 'statfile': form2.statfile.value, 'statdata': statData},
					function(data){
						//alert(data);
						var objData = eval('(' + data + ')');
						if(objData.retVal == "FAIL"){ 
							alert(objData.retString);
						}
						else {
							document.form2.submit();
						}
				});
			});
		});
/*		function checkInfo()
		{
		//	if(document.getElementById("BalanceStyle").value=='0')
				if (document.form1.busID.value == "") {
					if(!confirm("您未输入车辆编号，查询所有车辆可能花费较长时间，确认继续?")) {
						document.form1.busID.focus();
						return false;
					}
				}
		//	}
		} */

		function checkInfo(){
			if(document.getElementById("BalanceStyle").value=='0'){
				if (document.form1.busID.value == "") {
					if(!confirm("您未输入车辆编号，查询所有车辆可能花费较长时间，确认继续?")) {
						document.form1.busID.focus();
						return false;
					}
				}
			}else{
				if(document.getElementById("BusUnit").value==''){
					alert('请选择车属单位！');
					document.form1.BusUnit.focus();
					return false;
				}
			}
		}
		</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 车 辆 结 算</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		<table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
  			<tr>
    			<td colspan="5" bgcolor="#0083B5"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 结算单查询</td>
  			</tr>
		</table>
		<table width="100%" align="center" class="main_tableborder" border="0" cellpadding="3" cellspacing="1">
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 日期：</span>
					<input type="text" id="checkdate1" size="12" class="Wdate" value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>"  name="checkdate1" onclick="WdatePicker({onpicked:function(dp){$dp.$('date1Value').value=dp.cal.getDateStr();}});" />&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;
					<input type="text" id="checkdate2" size="12" class="Wdate" value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="checkdate2" onclick="WdatePicker({onpicked:function(dp){$dp.$('date2Value').value=dp.cal.getDateStr();}});" />
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 请选择结算方式：</span>
					<select name="BalanceStyle" id="BalanceStyle" >
						<option value="<?php if($BalanceStyle=='1') echo '1'; else{$BalanceStyle='0';  echo '0';}?>"><?php if($BalanceStyle=='1')  echo '按车属单位结算'; else echo '按车辆结算';?></option>
		      			<?php
		      				switch ($BalanceStyle){
    							case "0":
    								echo "<option value='1'>按车属单位结算</option>";
    								echo"<br>";
    								break; 
    							case "1":
    								echo "<option value='0'>按车辆结算</option>";
    								echo"<br>";
    								break;
		      				}    
		      			?>
		     	 	</select>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<div id="DisbusID" >
						<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆编号：</span>
						<input type="text" id="busID" name="busID" value="<?php ($busID == "" || $busID == "%")? print "" : print $busID;?>" />
					</div>
					<div id="DisBusUnit" style="DISPLAY: none">
						<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位：</span>
							<select name="BusUnit" id="BusUnit" >
								<option value="<?php echo $BusUnit;?>"><?php if($BusUnit=='') echo '请选择车属单位'; else echo $BusUnit; ?></option>
				      				<?php
				      					if($BusUnit!=''){
					      					echo "<option value=''>请选择车属单位</option>";
	    									echo"<br>";	
				      					}
	    								$select="SELECT bu_UnitName FROM tms_bd_BusUnit";
	    								$sel =$class_mysql_default->my_query($select);
										while($results=mysql_fetch_array($sel)){ 
											if($BusUnit!=$results['bu_UnitName']){
	    							?>
	    						<option value="<?php echo $results['bu_UnitName'];?>"><?php echo $results['bu_UnitName'];?></option>
	    							<?php
											} 
										}
	    							?>
				     	 	</select>
				     </div>
				</td>
				<td nowrap="nowrap" bgcolor="#FFFFFF">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" value="查询" onclick="return checkInfo();" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="statbalance" value="结算" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="exceldoc" id="exceldoc" value="导出Excel" />
				</td>
			</tr>
			<tr>
				<td>
					<input type="hidden" id="date1Value" value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>" name="date1Value" />
					<input type="hidden" id="date2Value" value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="date2Value" />
				</td>
			</tr>
		</table>
		</form>
		
		<form action="tms_v1_accounting_statementBalance.php" method="post" name="form2">
		<div id="tableContainer" class="tableContainer" > 
			<table class="main_tableboder" id="table1" > 
			<thead class="fixedHeader">
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算单号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开单员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开单员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车站ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开单时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">线路编号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">始发站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">终点站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">人数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">营收金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">站务费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">微机费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发班费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">代理费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">费用4</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">费用5</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">费用6</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车属单位</th>
			</tr>
			</thead>
			<tbody class="scrollContent">
			<?php
				if(isset($_POST['resultquery'])) {
					if($BalanceStyle=='0'){
						$queryString = "SELECT ct_BalanceNO, ct_BusID, ct_BusNumber, ct_CheckerID, ct_Checker, ct_StationID, ct_Station, 
							ct_CheckDate, ct_NoOfRunsID, ct_LineID,	ct_NoOfRunsdate, ct_BeginStation, ct_EndStation, 
							IFNULL(SUM(ct_TotalMan),0) AS ct_sumPerson, COUNT(ct_TicketID) AS ct_sumTicket,	
							IFNULL(SUM(ct_SellPrice),0) AS ct_sumMoney, IFNULL(SUM(ct_BalancePrice),0) AS ct_sumBalancePrice, 
							IFNULL(SUM(ct_ServiceFee),0) AS ct_sumServiceFee, IFNULL(SUM(ct_otherFee1),0) AS ct_sumOtherFee1, 
							IFNULL(SUM(ct_otherFee2),0) AS ct_sumOtherFee2, ct_otherFee3, IFNULL(SUM(ct_otherFee4),0) AS ct_sumOtherFee4, 
							IFNULL(SUM(ct_otherFee5),0) AS ct_sumOtherFee5, IFNULL(SUM(ct_otherFee6),0) AS ct_sumOtherFee6, bi_BusUnit 
							FROM tms_chk_CheckTicket,tms_bd_BusInfo WHERE (ct_CheckDate >= '{$CheckBeginDate}') AND (ct_CheckDate <= '{$CheckEndDate}') 
							AND (ct_IsBalance = 0) AND (ct_BusID LIKE '{$busID}')  AND (ct_BusID=bi_BusID) GROUP BY ct_BalanceNO ORDER BY ct_BalanceNO ASC";
					}else{
						$queryString = "SELECT ct_BalanceNO, ct_BusID, ct_BusNumber, ct_CheckerID, ct_Checker, ct_StationID, ct_Station, 
							ct_CheckDate, ct_NoOfRunsID, ct_LineID,	ct_NoOfRunsdate, ct_BeginStation, ct_EndStation, 
							IFNULL(SUM(ct_TotalMan),0) AS ct_sumPerson, COUNT(ct_TicketID) AS ct_sumTicket,	
							IFNULL(SUM(ct_SellPrice),0) AS ct_sumMoney, IFNULL(SUM(ct_BalancePrice),0) AS ct_sumBalancePrice, 
							IFNULL(SUM(ct_ServiceFee),0) AS ct_sumServiceFee, IFNULL(SUM(ct_otherFee1),0) AS ct_sumOtherFee1, 
							IFNULL(SUM(ct_otherFee2),0) AS ct_sumOtherFee2, ct_otherFee3, IFNULL(SUM(ct_otherFee4),0) AS ct_sumOtherFee4, 
							IFNULL(SUM(ct_otherFee5),0) AS ct_sumOtherFee5, IFNULL(SUM(ct_otherFee6),0) AS ct_sumOtherFee6, bi_BusUnit 
							FROM tms_chk_CheckTicket,tms_bd_BusInfo WHERE (ct_CheckDate >= '{$CheckBeginDate}') AND (ct_CheckDate <= '{$CheckEndDate}') 
							AND (ct_IsBalance = 0) AND (bi_BusUnit='{$BusUnit}') AND (ct_BusID=bi_BusID)  GROUP BY ct_BalanceNO ORDER BY ct_BalanceNO ASC";
					}
					$result = $class_mysql_default->my_query("$queryString");
					while ($row = mysql_fetch_array($result)) {
						$ct_otherFee3 = ($row['ct_sumMoney']-$row['ct_sumServiceFee'])*$row['ct_otherFee3'];

						//取得结算金额 （结算价是否区分半价和全价车票？如果区分，这里需要根据结算单号取出每条记录，单独处理）
						if($row['ct_sumBalancePrice'] == 0) 
							$BalanceMoney = $row['ct_sumMoney'] - $row['ct_sumServiceFee'] - $row['ct_sumOtherFee1'] - $row['ct_sumOtherFee2']
								- $ct_otherFee3 - $row['ct_sumOtherFee4'] - $row['ct_sumOtherFee5'] - $row['ct_sumOtherFee6'];
						else
							$BalanceMoney = $row['ct_sumBalancePrice'];
						
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row['ct_BalanceNO'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_BusID'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_BusNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_CheckerID'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_Checker'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_StationID'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_Station'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_CheckDate'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_NoOfRunsID'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_LineID'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_NoOfRunsdate'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_BeginStation'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_EndStation'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumPerson'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumTicket'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumMoney'];?></td>
				<td nowrap="nowrap"><?php echo $BalanceMoney;?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumServiceFee'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumOtherFee1'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumOtherFee2'];?></td>
				<td nowrap="nowrap"><?php echo $ct_otherFee3;?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumOtherFee4'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumOtherFee5'];?></td>
				<td nowrap="nowrap"><?php echo $row['ct_sumOtherFee6'];?></td>
				<td nowrap="nowrap"><?php echo $row['bi_BusUnit'];?></td>
			</tr>
			<?php
					}
				}
			?>
			</tbody>
		</table>
		<input type="hidden" id="statfile" value="<?php echo $statFileName;?>" name="statfile" />
		</div>
		</form>
	</body>
</html>
