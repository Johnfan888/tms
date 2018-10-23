<?php
/*
 * 	应交票张数 = 退票张数 + 废票张数
 *  应交款金额 = 售票金额 - 废票金额 - 退还金额
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$CheckBeginDate = "";
$CheckEndDate = "";
$StationName = "";
$sellerID = "";
$checkdate3=date('Y-m-d');
$checkdate4=date('Y-m-d');
if(isset($_POST['resultquery']) || isset($_POST['exceldoc']) || isset($_POST['selldetial'])) {
//
	$checkdate1=$_POST['CheckBeginDate'];
	$checkdate3=$_POST['CheckBeginDate'];
	$checkdate2=$_POST['CheckEndDate'];
	$checkdate4=$checkdate2;
	$CheckBeginDate=$_POST['CheckBeginDate'];
	$CheckEndDate=$_POST['CheckEndDate'];
	//echo $CheckBeginDate;
	$StationName = $_POST['stationselect'];
	$sellerID =  $_POST['sellerselect'];
	if($checkdate1 == "" && $checkdate2 == ""){
 			$strDate = '';
 		}
 		else{
		$checkdate1=$_POST['CheckBeginDate'];
		$checkdate2=$_POST['CheckEndDate'];
		if ($checkdate1 != "" && $checkdate2 == ""){ //发车日期处理
 			$strDate="(and st_SellDate >='{$checkdate1}')";
 			
 		}
 		if ($checkdate1 == "" && $checkdate2 != ""){
 			$strDate="and (st_SellDate <='{$checkdate2}')";
 		}
 		if ($checkdate1 != "" && $checkdate2 != ""){
 			$strDate="and (st_SellDate >='{$checkdate1}') and (st_SellDate <='{$checkdate2}')";
 		}
	}		
	if(isset($_POST['exceldoc'])) {
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");
		
		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '', '', '售票应缴款信息表', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$CheckBeginDate" . "至" . "$CheckEndDate";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('售票日期','售票金额', '售票张数', '废票金额', '废票张数', '退还金额', 
					'退票张数', '退票手续费', '保险票金额', '保险票张数', '应交票张数', '应缴金额', '售票员所属车站');
		fputcsv($fp, $head);
		
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = "";
		$queryString = "SELECT st_SellDate AS sellDate, st_SellID AS sellerID, st_SellName AS sellerName, 
						MIN(st_TicketID) AS beginTicketID, MAX(st_TicketID) AS endTicketID, IFNULL(SUM(st_SellPrice),0) AS sellMoney, COUNT(st_TicketID) AS sellNumber, 
						IFNULL((SELECT SUM(et_SellPrice) FROM tms_sell_ErrTicket WHERE (et_ErrUserID = tms_sell_SellTicket.st_SellID) AND (et_ErrDate = tms_sell_SellTicket.st_SellDate) AND (et_IsBalance = 0)),0) AS errMoney, 
						(SELECT COUNT(et_TicketID) FROM tms_sell_ErrTicket WHERE (et_ErrUserID = tms_sell_SellTicket.st_SellID) AND (et_ErrDate = tms_sell_SellTicket.st_SellDate) AND (et_IsBalance = 0)) AS errNumber, 
						IFNULL((SELECT SUM(rtk_ReturnPrice) FROM tms_sell_ReturnTicket WHERE (rtk_ReturnUserID = tms_sell_SellTicket.st_SellID) AND (rtk_ReturnDate = tms_sell_SellTicket.st_SellDate) AND (rtk_IsBalance = 2)),0) AS returnMoney, 
						(SELECT COUNT(rtk_TicketID) FROM tms_sell_ReturnTicket WHERE (rtk_ReturnUserID = tms_sell_SellTicket.st_SellID) AND (rtk_ReturnDate = tms_sell_SellTicket.st_SellDate) AND (rtk_IsBalance = 2)) AS returnNumber, 
						IFNULL((SELECT SUM(rtk_SXPrice) FROM tms_sell_ReturnTicket WHERE (rtk_ReturnUserID = tms_sell_SellTicket.st_SellID) AND (rtk_ReturnDate = tms_sell_SellTicket.st_SellDate) AND (rtk_IsBalance = 2)),0) AS returnFees, 
						IFNULL(SUM(st_SafetyTicketMoney),0) AS insurMoney, IFNULL(SUM(st_SafetyTicketNumber),0) AS insurNumber, st_Station AS sellerStation	FROM tms_sell_SellTicket 
						WHERE (st_IsBalance = 0) AND (st_Station LIKE '{$StationName}') AND (st_SellID LIKE '{$sellerID}') $strDate 
						GROUP BY st_SellID, st_SellDate ORDER BY st_SellDate ASC, st_SellID ASC";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysql_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			$UpCount = $row['errNumber'] + $row['returnNumber'];
			$UpMoney = $row['sellMoney'] - $row['errMoney'] - $row['returnMoney']+$row['insurMoney'];
			$outputRow = array($row['sellDate'], $row['sellMoney'], $row['sellNumber'], $row['errMoney'], $row['errNumber'], $row['returnMoney'], $row['returnNumber'], 
				$row['returnFees'], $row['insurMoney'], $row['insurNumber'], $UpCount, $UpMoney, $row['sellerStation']); 
			fputcsv($fp, $outputRow); 
		}
		
		fclose($fp);
		exit();
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head> 
		<title>售票统计查询</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../css/tms.css" rel="stylesheet" type="text/css">
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
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
				$("#sellDate").val($(this).children().eq(0).text());
				$("#sellMoney").val($(this).children().eq(1).text());
				$("#sellNumber").val($(this).children().eq(2).text());
				$("#errMoney").val($(this).children().eq(3).text());
				$("#errNumber").val($(this).children().eq(4).text());
				$("#returnMoney").val($(this).children().eq(5).text());
				$("#returnNumber").val($(this).children().eq(6).text());
				$("#returnFees").val($(this).children().eq(7).text());
				$("#insurMoney").val($(this).children().eq(8).text());
				$("#insurNumber").val($(this).children().eq(9).text());
				$("#subNumber").val($(this).children().eq(10).text());
				$("#subMoney").val($(this).children().eq(11).text());
				$("#sellerStation").val($(this).children().eq(12).text());
			});
		});
		 function selldetial1(){
			var sellerid=document.getElementById("sellerselect").value;
			var selldate=document.getElementById("sellDate").value;
			var CheckBeginDate=document.getElementById("CheckBeginDate").value;
			var CheckEndDate=document.getElementById("CheckEndDate").value;
			window.location.href='../query/tms_v1_query_sellticketquery.php?CheckBeginDate='+CheckBeginDate+'&CheckEndDate='+CheckEndDate+'&selldate='+selldate+'&sellerid='+sellerid+'';
		 }
		 function returndetial1(){
			var sellerid=document.getElementById("sellerselect").value;
			var selldate=document.getElementById("sellDate").value;
			var CheckBeginDate=document.getElementById("CheckBeginDate").value;
		    var CheckEndDate=document.getElementById("CheckEndDate").value;
			window.location.href='../query/tms_v1_query_returnticketquery.php?CheckBeginDate='+CheckBeginDate+'&CheckEndDate='+CheckEndDate+'&selldate='+selldate+'&sellerid='+sellerid+'';
			 }
		 function errdetial1(){
			 var sellerid=document.getElementById("sellerselect").value;
			 var selldate=document.getElementById("sellDate").value;
			 var CheckBeginDate=document.getElementById("CheckBeginDate").value;
			 var CheckEndDate=document.getElementById("CheckEndDate").value;
			 window.location.href='../query/tms_v1_query_errticketquery.php?CheckBeginDate='+CheckBeginDate+'&CheckEndDate='+CheckEndDate+'&selldate='+selldate+'&sellerid='+sellerid+'';
				 }
		 function insuredetial1()
		 {
			 var sellerid=document.getElementById("sellerselect").value;
			 var selldate=document.getElementById("sellDate").value;
			 var CheckBeginDate=document.getElementById("CheckBeginDate").value;
			 var CheckEndDate=document.getElementById("CheckEndDate").value;
			 window.location.href='../query/tms_v1_query_insurequery.php?CheckBeginDate='+CheckBeginDate+'&CheckEndDate='+CheckEndDate+'&selldate='+selldate+'&sellerid='+sellerid+'';
				 }
		 function errinsuredetial1(){
			 var sellerid=document.getElementById("sellerselect").value;
			 var selldate=document.getElementById("sellDate").value;
			 var CheckBeginDate=document.getElementById("CheckBeginDate").value;
			 var CheckEndDate=document.getElementById("CheckEndDate").value;
			 window.location.href='../query/tms_v1_query_errinsureticket.php?CheckBeginDate='+CheckBeginDate+'&CheckEndDate='+CheckEndDate+'&selldate='+selldate+'&sellerid='+sellerid+'';
			 }
		</script>
	</head>
	<body style="scrolling:auto;overflow-x:hidden;">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;">售票统计查询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		<table width="100%" align="center"  border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车站：</span>
					<input type="hidden" id="stationselect" name="stationselect" size="12" value="<?php echo $userStationName; ?>" />
					<input type="text" disabled="disabled" id="stationselect1" name="stationselect1" size="12" value="<?php echo $userStationName; ?>" />
				</td>
				<td align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 日期：</span>
					<input type="text" name="CheckBeginDate" id="CheckBeginDate" class="Wdate" value="<?php if(isset($_POST['resultquery'])){echo $_POST['CheckBeginDate'];}  else{ echo $checkdate3;} ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    				至
    				<input type="text" name="CheckEndDate" id="CheckEndDate" class="Wdate" value="<?php if(isset($_POST['resultquery'])){echo $_POST['CheckEndDate'];} else{ echo $checkdate4;}?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
				</td>
				<td align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 售票员：</span>
					<input type="hidden" id="sellerselect" name="sellerselect" size="12" value="<?php echo $userID; ?>" />
					<input type="text" disabled="disabled" id="sellerselect1" name="sellerselect1" size="12" value="<?php echo $userID; ?>" />
				</td>
				</tr>
				<tr >
				<td bgcolor="#FFFFFF" colspan="3">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" value="查询" /><!--
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="selldetial" id="selldetial" value="售票明细查询" onclick="window.location.href='../query/tms_v1_query_sellticketquery.php?CheckBeginDate=<?php echo $CheckBeginDate;?>';"/>
					&nbsp;&nbsp;&nbsp;&nbsp;-->
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="selldetial" id="selldetial" value="售票明细查询" onclick="return selldetial1()"/>
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="returndetial" id="returndetial" value="退票明细查询" onclick="returndetial1()"/>
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="errdetial" id="errdetial" value="废票明细查询" onclick="errdetial1()"/>
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="insuredetial" id="insuredetial" value="保险票明细查询" onclick="insuredetial1()"/>
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="errinsuredetial" id="errinsuredetial" value="废保险票明细查询" onclick="errinsuredetial1()"/>
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="exceldoc" id="exceldoc" value="导出Excel" />
				</td>
			</tr>
		</table>
		</form>
		
<form action="tms_v1_accounting_sellSub.php" method="post" name="form2">
<div id="tableContainer" class="tableContainer" style="margin-top:-20px;"> 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
			<tr>
				
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票日期</th>
				<!--
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开始票号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结束票号</th>
				-->
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">废票金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">废票张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">退还金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">退票张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">退票手续费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保险票金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保险票张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">应交票张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">应缴款金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票员所属车站</th>
			</tr>
			</thead>
<tbody class="scrollContent">
			<?php
				if(isset($_POST['resultquery'])) {
					$queryString = "SELECT st_SellDate AS sellDate, st_SellID AS sellerID, st_SellName AS sellerName, 
						MIN(st_TicketID) AS beginTicketID, MAX(st_TicketID) AS endTicketID, IFNULL(SUM(st_SellPrice),0) AS sellMoney, COUNT(st_TicketID) AS sellNumber, 
						IFNULL((SELECT SUM(et_SellPrice) FROM tms_sell_ErrTicket WHERE (et_ErrUserID = tms_sell_SellTicket.st_SellID) AND (et_ErrDate = tms_sell_SellTicket.st_SellDate) AND (et_IsBalance = 0)),0) AS errMoney, 
						(SELECT COUNT(et_TicketID) FROM tms_sell_ErrTicket WHERE (et_ErrUserID = tms_sell_SellTicket.st_SellID) AND (et_ErrDate = tms_sell_SellTicket.st_SellDate) AND (et_IsBalance = 0)) AS errNumber, 
						IFNULL((SELECT SUM(rtk_ReturnPrice) FROM tms_sell_ReturnTicket WHERE (rtk_ReturnUserID = tms_sell_SellTicket.st_SellID) AND (rtk_ReturnDate = tms_sell_SellTicket.st_SellDate) AND (rtk_IsBalance = 2)),0) AS returnMoney, 
						(SELECT COUNT(rtk_TicketID) FROM tms_sell_ReturnTicket WHERE (rtk_ReturnUserID = tms_sell_SellTicket.st_SellID) AND (rtk_ReturnDate = tms_sell_SellTicket.st_SellDate) AND (rtk_IsBalance = 2)) AS returnNumber, 
						IFNULL((SELECT SUM(rtk_SXPrice) FROM tms_sell_ReturnTicket WHERE (rtk_ReturnUserID = tms_sell_SellTicket.st_SellID) AND (rtk_ReturnDate = tms_sell_SellTicket.st_SellDate) AND (rtk_IsBalance = 2)),0) AS returnFees, 
						IFNULL(SUM(st_SafetyTicketMoney),0) AS insurMoney, IFNULL(SUM(st_SafetyTicketNumber),0) AS insurNumber, st_Station AS sellerStation	FROM tms_sell_SellTicket 
						WHERE (st_IsBalance = 0) AND (st_Station LIKE '{$StationName}') AND (st_SellID LIKE '{$sellerID}') $strDate 
						GROUP BY st_SellID, st_SellDate ORDER BY st_SellDate ASC, st_SellID ASC";
					//echo $strDate;
					$result = $class_mysql_default->my_query("$queryString");
					while ($row = mysql_fetch_array($result)) {
			?>
			<tr bgcolor="#CCCCCC">
				
				<td nowrap="nowrap"><?php echo $row['sellDate'];?></td>
				<!--
				<td nowrap="nowrap"><?php echo $row['sellerID'];?></td>
				<td nowrap="nowrap"><?php echo $row['sellerName'];?></td>
				<td nowrap="nowrap"><?php echo $row['beginTicketID'];?></td>
				<td nowrap="nowrap"><?php echo $row['endTicketID'];?></td>
				-->
				<td nowrap="nowrap"><?php echo $row['sellMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['sellNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['errMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['errNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['returnMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['returnNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['returnFees'];?></td>
				<td nowrap="nowrap"><?php echo $row['insurMoney'];?></td><!-- 保险票金额 -->
				<td nowrap="nowrap"><?php echo $row['insurNumber'];?></td>
				<td nowrap="nowrap"><?php echo ($row['errNumber']+$row['returnNumber']);?></td>
				<td nowrap="nowrap"><?php echo ($row['sellMoney']-$row['errMoney']-$row['returnMoney'])+$row['insurMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['sellerStation'];?></td>
			</tr>
			<?php
					}
				}
			?>
			<tr>
				<td style="border:0px;">
					<input type="hidden" id="sellDate" value="" name="sellDate" />
					<input type="hidden" id="sellMoney" value="" name="sellMoney" />
					<input type="hidden" id="sellNumber" value="" name="sellNumber" />
					<input type="hidden" id="errMoney" value="" name="errMoney" />
					<input type="hidden" id="errNumber" value="" name="errNumber" />
					<input type="hidden" id="returnMoney" value="" name="returnMoney" />
					<input type="hidden" id="returnNumber" value="" name="returnNumber" />
					<input type="hidden" id="returnFees" value="" name="returnFees" />
					<input type="hidden" id="insurMoney" value="" name="insurMoney" />
					<input type="hidden" id="insurNumber" value="" name="insurNumber" />
					<input type="hidden" id="subNumber" value="" name="subNumber" />
					<input type="hidden" id="subMoney" value="" name="subMoney" />
					<input type="hidden" id="sellerStation" value="" name="sellerStation" />
					<input type="hidden" id="userID" value="<?php echo $userID?>" name="userID" />
					<input type="hidden" id="userName" value="<?php echo $userName?>" name="userName" />
				</td>
			</tr>
			</tbody>
		</table>
		</div>
		</form>
	</body>
</html>
