<?php
/*
 * 结算单查询页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$CheckBeginDate = "";
$CheckEndDate = "";
$StationName = "";
$checkerID = "";
$bh_BalanceNO = "";
$bh_BusID = "";
$bh_BusUnit = "";
$conducter=$_POST['checkerselect'];
$checkdate3=date('Y-m-d');
$checkdate4=date('Y-m-d');
if(isset($_POST['resultquery']) || isset($_POST['exceldoc'])) {
	$checkdate1=$_POST['startdate'];
	$checkdate2=$_POST['enddate'];
	if (($StationName = $_POST['stationselect']) == "")
		$StationName = "%";
	if (($checkerID = $_POST['checkerselect']) == "")
		$checkerID = "%";
	if (($bh_BalanceNO = $_POST['bh_BalanceNO']) == "")
		$bh_BalanceNO = "%";
	if (($bh_BusID = $_POST['bh_BusID']) == "")
		$bh_BusID = "%";
	if (($bh_BusUnit = $_POST['busUnitSelect']) == "")
		$bh_BusUnit = "%";	
	if($_POST['bh_BalanceNO']==""){
		if($checkdate1 == "" && $checkdate2 == ""){
 			$strDate = '';
 		}
 		else{
		$checkdate1=$_POST['startdate'];
		$checkdate2=$_POST['enddate'];
		if ($checkdate1 != "" && $checkdate2 == ""){ //发车日期处理
 			$strDate=" AND bh_Date >='{$checkdate1}'";
 			
 		}
 		if ($checkdate1 == "" && $checkdate2 != ""){
 			$strDate=" AND bh_Date <='{$checkdate2}'";
 		}
 		if ($checkdate1 != "" && $checkdate2 != ""){
 			$strDate=" AND bh_Date >='{$checkdate1}' and bh_Date <='{$checkdate2}'";
 		}
	}
		}
		else{
			$strDate = '';
		}				
	if(isset($_POST['exceldoc'])) {
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");

		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '', '', '', '', '', '', '车辆单结算信息表', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$checkdate1" . "至" . "$checkdate2";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
//		$head = array('结算单号', '车辆编号', '车牌号', '车型', '车属单位', '开单员ID', '开单员', '开单日期', '开单车站', '班次', '发车日期',
//			 '始发站', '终点站', '人数', '张数', '营收金额', '站务费', '微机费', '发班费', '代理费', '费用4', '费用5', '费用6', '是否结账', '结账单号');
		$head = array('结算单号', '车辆编号', '车牌号', '车型', '车属单位', '开单员ID', '开单员', '开单日期', '开单车站', '班次', '发车日期',
			 '始发站', '终点站', '人数', '张数', '营收金额', '站务费', '劳务费', '行包托运费','是否结账','结账日期', '结账单号');
		fputcsv($fp, $head);
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = ""; 
		$queryString = "SELECT * 
						FROM 
						tms_acct_BalanceInHand 
						WHERE 
						bh_Station LIKE '{$StationName}' 
						AND bh_UserID LIKE '{$checkerID}' 
						AND bh_BalanceNO LIKE '{$bh_BalanceNO}' 
						AND bh_BusNumber LIKE '{$bh_BusID}' 
						AND bh_BusUnit LIKE '{$bh_BusUnit}' $strDate
						ORDER BY bh_BalanceNO ASC";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysqli_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			}
			$row['bh_IsAccount'] ? $bh_IsAccount = "是" : $bh_IsAccount = "否";
			$row['bh_BalanceNO']=$row['bh_BalanceNO']."\t";
			$row['bh_AccountID']=$row['bh_AccountID']."\t";
			$row['bh_BusModelID']=$row['bh_BusModelID']."\t";
			$outputRow = array($row['bh_BalanceNO'], $row['bh_BusID'], $row['bh_BusNumber'], $row['bh_BusModelID'], $row['bh_BusUnit'], 
				$row['bh_UserID'], $row['bh_User'], $row['bh_Date'], $row['bh_Station'], $row['bh_NoOfRunsID'], $row['bh_NoOfRunsdate'], 
				$row['bh_BeginStation'], $row['bh_EndStation'], $row['bh_CheckTotal'], $row['bh_TicketTotal'], $row['bh_PriceTotal'], 
				$row['bh_ServiceFee'], ($row['bh_PriceTotal'] - $row['bh_ServiceFee']) * $row['bh_otherFee3'] ,$row['bh_ConsignMoney'], $bh_IsAccount,$row['bh_Date'], $row['bh_AccountID']); 
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
		<title>结算单查询</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>		
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script>
		$(document).ready(function(){
			$("#table1").tablesorter();
			$("#stationselect").focus();
			$("#stationselect").blur(function(){
				var stationName = $("#stationselect").val();
				jQuery.get(
					'../accounting/tms_v1_accounting_dataProcess.php',
					{'op': 'getCheckersData', 'stationName': stationName, 'time': Math.random()},
					function(data){
						$("#checkerselect option:gt(0)").remove();
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].checkerID + ">" + objData[i].checkerID + "</option>").appendTo($("#checkerselect"));
						}
				});
			});
		});
		$(document).ready(function(){
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
			$("#bh_BusID").keyup(function(){
				$("#BusNumberselect").empty();
				document.getElementById("BusNumberselect").style.display=""; 
				var BusNumber = $("#bh_BusID").val();
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
				document.getElementById("bh_BusID").value=document.getElementById("BusNumberselect").value;
				document.getElementById("BusNumberselect").style.display="none";
			};
			});
		</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 结 算 单 信 息 查 询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr bgcolor="#FFFFFF">
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开单车站：</span></td>
				<td>
					<select id="stationselect" name="stationselect" size="1">
		            <?php
		            	if($userStationID == "all") {
		            ?>
						<?php if ($StationName == "" || $StationName == "%") { ?>
							<option value="" selected="selected">请选择车站</option>
						<?php } else { ?>
							<option value="<?php echo $StationName?>" selected="selected"><?php echo $StationName?></option>
						<?php } ?>
					<?php 
							$queryString = "SELECT DISTINCT sset_SiteName FROM tms_bd_SiteSet WHERE sset_IsStation=1";
							$result = $class_mysql_default->my_query("$queryString");
					        while($res = mysqli_fetch_array($result)) {
			            		if($res['sset_SiteName'] != $StationName) {
					?>
		            		<option value="<?php echo $res['sset_SiteName'];?>"><?php echo $res['sset_SiteName'];?></option>
		            <?php 
								}
							}
		            	}
		            	else {
		            ?>
						<option value="<?php echo $userStationName;?>" selected="selected"><?php echo $userStationName;?></option>
					<?php
		            	}
					?>
					</select>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开单日期：</span></td>
				<td bgcolor="#FFFFFF" colspan="3">
				<input type="text" name="startdate" id="startdate" class="Wdate" value="<?php if(isset($_POST['resultquery'])){if($_POST['bh_BalanceNO']==""){echo $_POST['startdate'];}} else{ echo $checkdate3;} ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    			 				至
    			<input type="text" name="enddate" id="enddate" class="Wdate" value="<?php if(isset($_POST['resultquery'])){if($_POST['bh_BalanceNO']==""){echo $_POST['enddate'];}} else{ echo $checkdate4;}?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
				</td>
				</tr>
				<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开单员：</span></td>
				<td >
					<select id="checkerselect" name="checkerselect" size="1" style="width:131px;">
					<?php if($conducter=="") {?>
						<option value="" selected="selected">请选择开单员</option>
						<?php } else {?>
						<option></option>
						<option value="<?php echo $conducter?>" selected="selected"><?php echo $conducter?></option>
						<?php } ?>
					</select>
				</td>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结算单号：&nbsp;&nbsp;&nbsp;</span></td>
				<td colspan="3"><input type="text" name="bh_BalanceNO" id="bh_BalanceNO" value="<?php ($bh_BalanceNO == "" || $bh_BalanceNO == "%")? print "" : print $bh_BalanceNO;?>"/></td>
				</tr>
				<tr>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：&nbsp;&nbsp;&nbsp;</span></td>
				<td><input type="text" name="bh_BusID" id="bh_BusID" value="<?php ($bh_BusID == "" || $bh_BusID == "%")? print "" : print $bh_BusID;?>"/>
					<br />
					<select id="BusNumberselect" name="BusNumberselect" class="helplay" multiple="multiple" style="display:none;height:90px;" size="30" ></select>
				</td>
				
				
				
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位：&nbsp;&nbsp;&nbsp;</span></td>
				<td >
					<select id="busUnitSelect" name="busUnitSelect" size="1" style="width:131px;">
					<?php if ($bh_BusUnit == "" || $bh_BusUnit == "%") { ?>
						<option value="" selected="selected">请选择车属单位</option>
					<?php } else { ?>
						<option></option>
						<option value="<?php echo $bh_BusUnit?>" selected="selected"><?php echo $bh_BusUnit?></option>
					<?php } ?>					
					<?php 
						$queryString = "SELECT DISTINCT bi_BusUnit FROM tms_bd_BusInfo";
						$result = $class_mysql_default->my_query("$queryString");
				        while($res = mysqli_fetch_array($result)) {
		            		if($res['bi_BusUnit'] != $bh_BusUnit) {
					?>
		            	<option value="<?php echo $res['bi_BusUnit'];?>"><?php echo $res['bi_BusUnit'];?></option>
		            <?php 
							}
						}
		            ?>
					</select>
					</td>
					<td>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" id="resultquery" value="查询" />&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="submit" name="exceldoc" id="exceldoc" value="导出Excel" />&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
			</tr>
		</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算单号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车型</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车属单位</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开单员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开单员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开单日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开单车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">始发站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">终点站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">人数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">营收金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">站务费</th>
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">微机费</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">发班费</th>-->
				<th nowrap="nowrap" align="center" bgcolor="#006699">劳务费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">行包托运费</th>
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">费用4</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">费用5</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">费用6</th>-->
				<th nowrap="nowrap" align="center" bgcolor="#006699">是否结账</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结账日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结账单号</th>
			</tr>
		</thead>
		<tbody class="scrollContent">
			<?php
				if(isset($_POST['resultquery'])) {
					$queryString = "SELECT * 
									FROM 
									tms_acct_BalanceInHand 
									WHERE 
									bh_Station LIKE '{$StationName}' 
									AND bh_UserID LIKE '{$checkerID}' 
									AND bh_BalanceNO LIKE '{$bh_BalanceNO}' 
									AND bh_BusNumber LIKE '{$bh_BusID}' 
									AND bh_BusUnit LIKE '{$bh_BusUnit}' $strDate
									ORDER BY bh_BalanceNO ASC";
					$result = $class_mysql_default->my_query("$queryString");
					while ($row = mysqli_fetch_array($result)) {
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row['bh_BalanceNO'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_BusID'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_BusNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_BusModelID'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_BusUnit'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_UserID'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_User'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_Date'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_Station'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_NoOfRunsID'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_NoOfRunsdate'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_BeginStation'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_EndStation'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_CheckTotal'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_TicketTotal'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_PriceTotal'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_ServiceFee'];?></td><!--
				<td nowrap="nowrap"><?php echo $row['bh_otherFee1'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_otherFee2'];?></td>
				--><td nowrap="nowrap"><?php echo ($row['bh_PriceTotal'] - $row['bh_ServiceFee']) * $row['bh_otherFee3'];?></td><!--
				<td nowrap="nowrap"><?php echo $row['bh_otherFee4'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_otherFee5'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_otherFee6'];?></td>
				-->
				<td nowrap="nowrap"><?php echo $row['bh_ConsignMoney'];?></td>
				<td nowrap="nowrap"><?php if ($row['bh_IsAccount']) echo "是"; else echo "否";?></td>
				<td nowrap="nowrap"><?php echo $row['bh_Date'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_AccountID'];?></td>
			</tr>
			<?php 
					}
				}
			?>
		</tbody>
		</table>
		</div>
		</form>
	</body>
</html>
