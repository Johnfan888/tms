<?php
/*
 * 保险单查询页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$startdate=$_GET['CheckBeginDate'];
$enddate=$_GET['CheckEndDate'];
$selldate=$_GET['selldate'];
$sellerid=$_GET['sellerid'];
$StationName = "";
$checkerID = "";
$bh_BalanceNO = "";
$bh_BusID = "";
$bh_BusUnit = "";
$DataBeginDate1=date('Y-m-d');
$DataEndDate1=date('Y-m-d');

if($selldate!=""){
	$strDate="and st_SellDate ='{$selldate}' ";
}
else{
	$strDate="and st_SellDate >='{$startdate}' and st_SellDate <='{$enddate}'";
}
if(isset($_POST['resultquery']) || isset($_POST['exceldoc'])) {
	$DataBeginDate = $_POST['DataBeginDate'];
	$DataEndDate = $_POST['DataEndDate'];
	$DataBeginDate1 = $_POST['DataBeginDate'];
	$DataEndDate1 = $_POST['DataEndDate'];
	$checkerID1 = $_POST['checkerselect'];
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
	$errTicketID = $_POST['errTicketID'];		
if($startdate=="" || $enddate==""){
	if($_POST['errTicketID']==""){
		if($DataBeginDate == "" && $DataBeginDate == ""){
 			$strDate = '';
 		}
 		else{
		if ($DataBeginDate != "" && $DataEndDate == ""){ //发车日期处理
 			$strDate="AND st_SellDate >= '{$DataBeginDate}'";
 		}
 		if ($DataBeginDate == "" && $DataEndDate != ""){
 			$strDate="AND st_SellDate <= '{$DataEndDate}'";
 		}
 		if ($DataBeginDate != "" && $DataEndDate != ""){
 			$strDate="AND st_SellDate >= '{$DataBeginDate}' AND st_SellDate <= '{$DataEndDate}'";
 		}
	}
	}
else{
 			$strDate = '';
 	}
}
else{
		$checkdate1=$_POST['DataBeginDate'];
		$checkdate2=$_POST['DataEndDate'];
		if ($checkdate1 != "" && $checkdate2 == ""){ //发车日期处理
 			$strDate="and st_SellDate >='{$checkdate1}'";
 			
 		}
 		if ($checkdate1 == "" && $checkdate2 != ""){
 			$strDate="and st_SellDate <='{$checkdate2}'";
 		}
 		if ($checkdate1 != "" && $checkdate2 != ""){
 			$strDate="and st_SellDate >='{$checkdate1}' and st_SellDate <='{$checkdate2}'";
 		}
		else{
			$strDate = '';
		}
		//echo $strDate;
}
	if(isset($_POST['exceldoc'])) {
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");

		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '', '', '', '', '', '', '保险单查询信息表', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$DataBeginDate1" . "至" . "$DataEndDate1";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('同步编码', '发车日期', '班次', '票号', '座位号', '起始站', '票价', '票型', '客票状态','是否保险', '保险单号', '套餐信息',
			 '总保值', '保费', '保单类型', '保单状态', '售票日期', '售票人', '保单打印时间', '保险代码', '承保机构代码', '单证识别码', 
			 '归属机构代码5', '默认经办人代码', '默认归属经办人', '操作人员代码', '复核人员代码', '售票上传状态', '退票上传状态');
		fputcsv($fp, $head);
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = ""; 
		if($startdate!="" || $enddate!=""){
				$queryString = "SELECT tms_sell_InsureTicket.itt_SyncCode,tms_sell_InsureTicket.itt_TicketNo,tms_sell_InsureTicket.itt_SeatNo,
						tms_sell_InsureTicket.itt_ReachName,tms_sell_InsureTicket.itt_InsureTicketNo,tms_sell_InsureTicket.itt_AinsuranceValue,
						tms_sell_InsureTicket.itt_BinsuranceValue,tms_sell_InsureTicket.itt_Price,tms_sell_InsureTicket.itt_CreatedType,
						tms_sell_InsureTicket.itt_Status,tms_sell_InsureTicket.itt_SaleTime,tms_sell_InsureTicket.itt_Saler,tms_sell_InsureTicket.itt_RiskCode, 
						tms_sell_InsureTicket.itt_MakeCode,tms_sell_InsureTicket.itt_VisaCode,tms_sell_InsureTicket.itt_ComCode,tms_sell_InsureTicket.itt_HandlerCode, 
						tms_sell_InsureTicket.itt_Handler1Code,tms_sell_InsureTicket.itt_OperatorCode,tms_sell_InsureTicket.itt_ApporverCode,
						tms_sell_InsureTicket.itt_UploadStatus,tms_sell_InsureTicket.itt_ReturnUploadStatus,tms_sell_SellTicket.st_NoOfRunsdate,tms_sell_SellTicket.st_NoOfRunsID, 
						tms_sell_SellTicket.st_SellPrice,tms_sell_SellTicket.st_SellPriceType, tms_sell_SellTicket.st_TicketState, tms_sell_SellTicket.st_SellDate 
						FROM tms_sell_InsureTicket,tms_sell_SellTicket WHERE tms_sell_InsureTicket.itt_TicketNo=tms_sell_SellTicket.st_TicketID
						AND itt_InsureTicketNo LIKE '{$errTicketID}%' AND itt_ReserveName LIKE '{$userStationName}%' AND st_SellID = '{$sellerid}'".$strDate;
			}
			else{
				$queryString = "SELECT tms_sell_InsureTicket.itt_SyncCode,tms_sell_InsureTicket.itt_TicketNo,tms_sell_InsureTicket.itt_SeatNo,
						tms_sell_InsureTicket.itt_ReachName,tms_sell_InsureTicket.itt_InsureTicketNo,tms_sell_InsureTicket.itt_AinsuranceValue,
						tms_sell_InsureTicket.itt_BinsuranceValue,tms_sell_InsureTicket.itt_Price,tms_sell_InsureTicket.itt_CreatedType,
						tms_sell_InsureTicket.itt_Status,tms_sell_InsureTicket.itt_SaleTime,tms_sell_InsureTicket.itt_Saler,tms_sell_InsureTicket.itt_RiskCode, 
						tms_sell_InsureTicket.itt_MakeCode,tms_sell_InsureTicket.itt_VisaCode,tms_sell_InsureTicket.itt_ComCode,tms_sell_InsureTicket.itt_HandlerCode, 
						tms_sell_InsureTicket.itt_Handler1Code,tms_sell_InsureTicket.itt_OperatorCode,tms_sell_InsureTicket.itt_ApporverCode,
						tms_sell_InsureTicket.itt_UploadStatus,tms_sell_InsureTicket.itt_ReturnUploadStatus,tms_sell_SellTicket.st_NoOfRunsdate,tms_sell_SellTicket.st_NoOfRunsID, 
						tms_sell_SellTicket.st_SellPrice,tms_sell_SellTicket.st_SellPriceType, tms_sell_SellTicket.st_TicketState, tms_sell_SellTicket.st_SellDate 
						FROM tms_sell_InsureTicket,tms_sell_SellTicket WHERE tms_sell_InsureTicket.itt_TicketNo=tms_sell_SellTicket.st_TicketID
						AND itt_InsureTicketNo LIKE '{$errTicketID}%' AND itt_ReserveName LIKE '{$StationName}' AND st_SellID LIKE '{$checkerID}'".$strDate;
		//
			}
		//echo $queryString;
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysql_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			}
			$row['itt_InsureTicketNo']=$row['itt_InsureTicketNo']."\t";
			$row['bh_IsAccount'] ? $bh_IsAccount = "是" : $bh_IsAccount = "否";
			$outputRow = array($row['itt_SyncCode'], $row['st_NoOfRunsdate'], $row['st_NoOfRunsID'], $row['itt_TicketNo'], $row['itt_SeatNo'], 
				$row['itt_ReachName'], $row['st_SellPrice'], $row['st_SellPriceType'], $row['st_TicketState'], $row['itt_IsActive'], $row['itt_InsureTicketNo'], 
				$row['itt_AinsuranceValue'].'|'.$row['itt_BinsuranceValue'], $row['itt_AinsuranceValue'], $row['itt_Price'], $row['itt_CreatedType'], 
				$row['itt_Status'], $row['st_SellDate'], $row['itt_Saler'], $row['itt_SaleTime'], $row['itt_RiskCode'], $row['itt_MakeCode'], $row['itt_VisaCode'], 
				$row['itt_ComCode'], $row['itt_HandlerCode'], $row['itt_Handler1Code'], $row['itt_OperatorCode'], $row['itt_ApporverCode'],$row['itt_UploadStatus'],
				$row['itt_ReturnUploadStatus']); 
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
		<title>保险单查询</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>		
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script>
		function return1(){
			window.location.href='../sell/tms_v1_sell_sellquery.php';	
		}
		$(document).ready(function(){
			$("#table1").tablesorter();
			$("#stationselect").focus();
			$("#stationselect").blur(function(){
				var stationName = $("#stationselect").val();
				jQuery.get(
					'../accounting/tms_v1_accounting_dataProcess.php',
					{'op': 'getSellersData', 'stationName': stationName, 'time': Math.random()},
					function(data){
						$("#checkerselect option:gt(0)").remove();
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].sellerID + ">" + objData[i].sellerID + "</option>").appendTo($("#checkerselect"));
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
		</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 保  险 信 息 查 询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr bgcolor="#FFFFFF">
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 售保险票车站：</span></td>
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
					        while($res = mysql_fetch_array($result)) {
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
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 售保险票日期：</span></td>
				  <td colspan="2" nowrap="nowrap" bgcolor="#FFFFFF">
				  <?php if($startdate=="" && $enddate==""){ ?>
				  	<input type="text" name="DataBeginDate" id="DataBeginDate" class="Wdate" value="<?php if(isset($_POST['resultquery'])){if($_POST['errTicketID']==""){echo $DataBeginDate;}} else{ echo $DataBeginDate1;} ?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" />
		    		&nbsp;&nbsp;至&nbsp;&nbsp;
		    		<input type="text" name="DataEndDate" id="DataEndDate" class="Wdate" value="<?php if(isset($_POST['resultquery'])){if($_POST['errTicketID']==""){echo $DataEndDate;}} else{ echo $DataEndDate1;} ?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" />
		    	<?php } else { ?>
				<input type="text" name="DataBeginDate2" id="DataBeginDate2" class="Wdate" value="<?php if($selldate!=""){ echo $selldate; }else{ echo $startdate; }  ?>" disabled="disabled" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
				<input type="hidden" name="DataBeginDate" id="DataBeginDate" class="Wdate" value="<?php if($selldate!=""){ echo $selldate; }else{ echo $startdate; }   ?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    			至
    			<input type="text" name="DataEndDate2" id="DataEndDate2" class="Wdate" disabled="disabled" value="<?php if($selldate!=""){ echo $selldate; }else{ echo $enddate; }  ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    			<input type="hidden" name="DataEndDate" id="DataEndDate" class="Wdate" value="<?php if($selldate!=""){ echo $selldate; }else{ echo $enddate; } ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
				<?php } ?>
		    	</td>
		    	</tr>
		    	<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 售保险票员：</span>
				</td>
				<td>
				<?php if($startdate=="" && $enddate==""){ ?>
					<select id="checkerselect" name="checkerselect" size="1" style="width:131px;">
					<?php if($checkerID1=="") {?>
						<option value="" selected="selected">售保险票员</option>
						<?php } else {?>
						<option value="<?php echo $checkerID1?>" selected="selected"><?php echo $checkerID1?></option>
						<?php } ?>
					</select>
					<?php } else {?>
					<input type="hidden" name="sellerselect" id="sellerselect" value="<?php echo $userID; ?>"/>
					<input type="text" disabled="disabled" name="sellerselect1" id="sellerselect1" value="<?php echo $userID; ?>"/>
					<?php } ?>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保险单号：</span>
				<input type="text"  name="errTicketID" id="errTicketID" value="<?php  echo $errTicketID; ?>"/></td>
				<td align="center"  colspan="2">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" id="resultquery" value="查询" />
					<?php if($startdate!="" || $enddate!=""){  ?>
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="return" id="return" value="返回" onclick="return1()"/>
					<?php } ?>
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="exceldoc" id="exceldoc" value="导出Excel" />&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
			</tr>
		</table>
		<div id="tableContainer" class="tableContainer" > 
		<table class="main_tableboder" id="table1" > 
		<thead class="fixedHeader">
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">同步编码</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">票号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">座位号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">起始站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">票价</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">票型</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">客票状态</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">是否保险</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保险单号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">套餐信息</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">总保值</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保单类型</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保单状态</th>
		<!--  
				<th nowrap="nowrap" align="center" bgcolor="#006699">退保费</th>
		 -->
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票人</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保单打印时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保险代码</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">承保机构代码</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">单证识别码</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">归属机构代码</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">默认经办人代码</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">默认归属经办人</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">操作人员代码</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">复核人员代码</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票上传状态</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">退票上传状态</th>
			</tr>
		</thead>
			<tbody class="scrollContent">
			<?php
			if($startdate!="" || $enddate!=""){
				$queryString = "SELECT tms_sell_InsureTicket.itt_SyncCode,tms_sell_InsureTicket.itt_TicketNo,tms_sell_InsureTicket.itt_SeatNo,
						tms_sell_InsureTicket.itt_ReachName,tms_sell_InsureTicket.itt_InsureTicketNo,tms_sell_InsureTicket.itt_AinsuranceValue,
						tms_sell_InsureTicket.itt_BinsuranceValue,tms_sell_InsureTicket.itt_Price,tms_sell_InsureTicket.itt_CreatedType,
						tms_sell_InsureTicket.itt_Status,tms_sell_InsureTicket.itt_SaleTime,tms_sell_InsureTicket.itt_Saler,tms_sell_InsureTicket.itt_RiskCode, 
						tms_sell_InsureTicket.itt_MakeCode,tms_sell_InsureTicket.itt_VisaCode,tms_sell_InsureTicket.itt_ComCode,tms_sell_InsureTicket.itt_HandlerCode, 
						tms_sell_InsureTicket.itt_Handler1Code,tms_sell_InsureTicket.itt_OperatorCode,tms_sell_InsureTicket.itt_ApporverCode,
						tms_sell_InsureTicket.itt_UploadStatus,tms_sell_InsureTicket.itt_ReturnUploadStatus,tms_sell_SellTicket.st_NoOfRunsdate,tms_sell_SellTicket.st_NoOfRunsID, 
						tms_sell_SellTicket.st_SellPrice,tms_sell_SellTicket.st_SellPriceType, tms_sell_SellTicket.st_TicketState, tms_sell_SellTicket.st_SellDate 
						FROM tms_sell_InsureTicket,tms_sell_SellTicket WHERE tms_sell_InsureTicket.itt_TicketNo=tms_sell_SellTicket.st_TicketID
						AND itt_InsureTicketNo LIKE '{$errTicketID}%' AND itt_ReserveName LIKE '{$userStationName}%' AND st_SellID = '{$sellerid}'".$strDate;
			}
			else{
				if(isset($_POST['resultquery'])) {
					$queryString = "SELECT tms_sell_InsureTicket.itt_SyncCode,tms_sell_InsureTicket.itt_TicketNo,tms_sell_InsureTicket.itt_SeatNo,
						tms_sell_InsureTicket.itt_ReachName,tms_sell_InsureTicket.itt_InsureTicketNo,tms_sell_InsureTicket.itt_AinsuranceValue,
						tms_sell_InsureTicket.itt_BinsuranceValue,tms_sell_InsureTicket.itt_Price,tms_sell_InsureTicket.itt_CreatedType,
						tms_sell_InsureTicket.itt_Status,tms_sell_InsureTicket.itt_SaleTime,tms_sell_InsureTicket.itt_Saler,tms_sell_InsureTicket.itt_RiskCode, 
						tms_sell_InsureTicket.itt_MakeCode,tms_sell_InsureTicket.itt_VisaCode,tms_sell_InsureTicket.itt_ComCode,tms_sell_InsureTicket.itt_HandlerCode, 
						tms_sell_InsureTicket.itt_Handler1Code,tms_sell_InsureTicket.itt_OperatorCode,tms_sell_InsureTicket.itt_ApporverCode,
						tms_sell_InsureTicket.itt_UploadStatus,tms_sell_InsureTicket.itt_ReturnUploadStatus,tms_sell_SellTicket.st_NoOfRunsdate,tms_sell_SellTicket.st_NoOfRunsID, 
						tms_sell_SellTicket.st_SellPrice,tms_sell_SellTicket.st_SellPriceType, tms_sell_SellTicket.st_TicketState, tms_sell_SellTicket.st_SellDate 
						FROM tms_sell_InsureTicket,tms_sell_SellTicket WHERE tms_sell_InsureTicket.itt_TicketNo=tms_sell_SellTicket.st_TicketID
						AND itt_InsureTicketNo LIKE '{$errTicketID}%' AND itt_ReserveName LIKE '{$StationName}' AND st_SellID LIKE '{$checkerID}'".$strDate;
				}
			}
			//echo $strDate;
					$result = $class_mysql_default->my_query("$queryString");
					while ($row = mysql_fetch_array($result)) {
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row['itt_SyncCode'];?></td>
				<td nowrap="nowrap"><?php echo $row['st_NoOfRunsdate'];?></td>
				<td nowrap="nowrap"><?php echo $row['st_NoOfRunsID'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_TicketNo'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_SeatNo'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_ReachName'];?></td>
				<td nowrap="nowrap"><?php echo $row['st_SellPrice'];?></td>
				<td nowrap="nowrap"><?php echo $row['st_SellPriceType'];?></td>
				<td nowrap="nowrap"><?php echo $row['st_TicketState'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_IsActive'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_InsureTicketNo'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_AinsuranceValue'].'|'.$row['itt_BinsuranceValue'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_AinsuranceValue'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_Price'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_CreatedType'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_Status'];?></td>
		<!-- 
				<td nowrap="nowrap"><?php echo $row['bh_ServiceFee'];?></td>
		 -->
				<td nowrap="nowrap"><?php echo $row['st_SellDate'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_Saler'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_SaleTime'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_RiskCode'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_MakeCode'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_VisaCode'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_ComCode'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_HandlerCode'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_Handler1Code'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_OperatorCode'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_ApporverCode'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_UploadStatus'];?></td>
				<td nowrap="nowrap"><?php echo $row['itt_ReturnUploadStatus'];?></td>
			</tr>
			<?php 
					}
				
			?>
		</tbody>
		</table>
		</div>
		</form>
	</body>
</html>

