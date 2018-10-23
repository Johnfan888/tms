<?php
/*
 * 行包寄存页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$CheckBeginDate = "";
$CheckEndDate = "";
$StationName = "";
$Result = "";
$cardID = "";
$passengerName = "";
if(isset($_POST['resultquery']) || isset($_POST['exceldoc'])) {
	$CheckBeginDate = $_POST['date1Value'];
	$CheckEndDate = $_POST['date2Value'];
	$CheckBeginDatetime = $_POST['date1Value'] . " 00:00:00";
	$CheckEndDatetime = $_POST['date2Value'] . " 23:59:59";
	if (($StationName = $_POST['stationselect']) == "")
		$StationName = "%";
	if (($Result = $_POST['resultselect']) == "")
		$Result = "%";
	if (($cardID = $_POST['cardID']) == "")
		$cardID = "%";
	if (($passengerName = $_POST['passengerName']) == "")
		$passengerName = "%";
	
	if(isset($_POST['exceldoc'])) {
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");
		
		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '', '行李寄存信息表', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$CheckBeginDate" . "至" . "$CheckEndDate";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('序号', '保管牌号', '旅客姓名', '旅客电话', '行李件数', '保管费', '保管员ID', '保管员', '存放时间', '提取时间', '提取员ID', 
				'提取员', '行李状态', '存取车站', '备注');
		fputcsv($fp, $head);
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = ""; 
		$queryString = "SELECT * FROM tms_lug_CloakRoom WHERE cr_DepositTime >= '{$CheckBeginDatetime}' AND cr_DepositTime <= '{$CheckEndDatetime}' 
					AND cr_Station LIKE '{$StationName}' AND cr_Type LIKE '{$Result}' AND cr_CustodyID LIKE '{$cardID}' 
					AND cr_PasserName LIKE '{$passengerName}' ORDER BY cr_ID ASC";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysql_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			}
			$outputRow = array($row['cr_ID'], $row['cr_CustodyID'], $row['cr_PasserName'], $row['cr_PasserTel'], $row['cr_BaggageNo'], 
					$row['cr_KeepMoney'], $row['cr_KeepUserID'], $row['cr_KeepUser'], $row['cr_DepositTime'], $row['cr_ExtractionTime'], 
					$row['cr_ExtractionUserID'], $row['cr_ExtractionUser'], $row['cr_Type'], $row['cr_Station'], $row['cr_Remark']); 
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
		<title>行包寄存</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../css/style_main.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>		
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script>
		$(document).ready(function(){
			$("#deposit").click(function(){
				form3.cr_Station.value = form1.stationselect.value;
				form3.cr_StationID.value = "";
				document.form3.submit();
			});
			$("#extract").click(function(){
				document.form2.submit();
			});
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
				$("#cr_ID").val($(this).children().eq(0).text());
				$("#cr_CustodyID").val($(this).children().eq(1).text());
				$("#cr_PasserName").val($(this).children().eq(2).text());
				$("#cr_PasserTel").val($(this).children().eq(3).text());
				$("#cr_BaggageNo").val($(this).children().eq(4).text());
				$("#cr_KeepMoney").val($(this).children().eq(5).text());
				$("#cr_Type").val($(this).children().eq(12).text());
				$("#cr_Station").val($(this).children().eq(13).text());
				$("#cr_Remark").val($(this).children().eq(14).text());
			});
		});
		</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableborder" border="0" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#4C4C4C"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 寄 存 信 息 查 询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
  			<tr>
    			<td colspan="5" bgcolor="#0083B5"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 查询结果</td>
  			</tr>
		</table>
		<table width="100%" align="center" class="main_tableborder" border="0" cellpadding="3" cellspacing="1">
			<tr bgcolor="#FFFFFF">
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 寄存站：</span></td>
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
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 寄存日期：</span></td>
				<td>
					<input type="text" id="checkdate1" size="12" class="Wdate" value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>"  name="checkdate1" onclick="WdatePicker({onpicked:function(dp){$dp.$('date1Value').value=dp.cal.getDateStr();}});" />&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;
					<input type="text" id="checkdate2" size="12" class="Wdate" value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="checkdate2" onclick="WdatePicker({onpicked:function(dp){$dp.$('date2Value').value=dp.cal.getDateStr();}});" />
				</td>
				<td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保管牌号：</span></td>
				<td>
					&nbsp;&nbsp;&nbsp;<input type="text" name="cardID" id="cardID" value="<?php ($cardID == "" || $cardID == "%")? print "" : print $cardID;?>" />
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 旅客姓名：</span></td>
				<td>
					<input type="text" name="passengerName" id="passengerName" value="<?php ($passengerName == "" || $passengerName == "%")? print "" : print $passengerName;?>" />
				</td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 寄存状态：</span></td>
				<td>
					<select id="resultselect" name="resultselect" size="1">
						<option value="" selected="selected">请选择寄存状态</option>
						<option value="存放中">存放中</option>
						<option value="已提取">已提取</option>
					</select>
				</td>
				<td colspan="2" bgcolor="#FFFFFF">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" id="resultquery" value="查询" />
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
		<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableborder" id="table1">
		<thead>
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">序号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保管牌号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">旅客姓名</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">旅客电话</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">行李件数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保管费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保管员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保管员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">存放时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">提取时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">提取员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">提取员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">行李状态</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">存取车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if(isset($_POST['resultquery'])) {
					$queryString = "SELECT * FROM tms_lug_CloakRoom WHERE cr_DepositTime >= '{$CheckBeginDatetime}' AND cr_DepositTime <= '{$CheckEndDatetime}' 
								AND cr_Station LIKE '{$StationName}' AND cr_Type LIKE '{$Result}' AND cr_CustodyID LIKE '{$cardID}' 
								AND cr_PasserName LIKE '{$passengerName}' ORDER BY cr_ID ASC";
					$result = $class_mysql_default->my_query("$queryString");
					while ($row = mysql_fetch_array($result)) {
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row['cr_ID'];?></td>
				<td nowrap="nowrap"><?php echo $row['cr_CustodyID'];?></td>
				<td nowrap="nowrap"><?php echo $row['cr_PasserName'];?></td>
				<td nowrap="nowrap"><?php echo $row['cr_PasserTel'];?></td>
				<td nowrap="nowrap"><?php echo $row['cr_BaggageNo'];?></td>
				<td nowrap="nowrap"><?php echo $row['cr_KeepMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['cr_KeepUserID'];?></td>
				<td nowrap="nowrap"><?php echo $row['cr_KeepUser'];?></td>
				<td nowrap="nowrap"><?php echo $row['cr_DepositTime'];?></td>
				<td nowrap="nowrap"><?php echo $row['cr_ExtractionTime'];?></td>
				<td nowrap="nowrap"><?php echo $row['cr_ExtractionUserID'];?></td>
				<td nowrap="nowrap"><?php echo $row['cr_ExtractionUser'];?></td>
				<td nowrap="nowrap"><?php echo $row['cr_Type'];?></td>
				<td nowrap="nowrap"><?php echo $row['cr_Station'];?></td>
				<td nowrap="nowrap"><?php echo $row['cr_Remark'];?></td>
			</tr>
			<?php
					}
				}
			?>   
		</tbody>
		</table>
		</form>
		<form action="tms_v1_lugdeposit_extract.php" method="post" name="form2">
		<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
			<tr>
				<td align="center" bgcolor="#FFFFFF">
					<input type="button" id="deposit" name="deposit" value="寄存"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" id="extract" name="extract" value="提取"/>
				</td>
			</tr>
			<tr>
				<td>
					<input type="hidden" id="cr_ID" value="" name="cr_ID" />
					<input type="hidden" id="cr_CustodyID" value="" name="cr_CustodyID" />
					<input type="hidden" id="cr_PasserName" value="" name="cr_PasserName" />
					<input type="hidden" id="cr_PasserTel" value="" name="cr_PasserTel" />
					<input type="hidden" id="cr_BaggageNo" value="" name="cr_BaggageNo" />
					<input type="hidden" id="cr_KeepMoney" value="" name="cr_KeepMoney" />
					<input type="hidden" id="cr_Type" value="" name="cr_Type" />
					<input type="hidden" id="cr_Station" value="" name="cr_Station" />
					<input type="hidden" id="cr_Remark" value="" name="cr_Remark" />
					<input type="hidden" id="cr_ExtractionUserID" value="<?php echo $userID;?>" name="cr_ExtractionUserID" />
					<input type="hidden" id="cr_ExtractionUser" value="<?php echo $userName;?>" name="cr_ExtractionUser" />
				</td>
			</tr>
		</table>
		</form>
		<form action="tms_v1_lugdeposit_deposit.php" method="post" name="form3">
			<input type="hidden" id="cr_KeepUserID" value="<?php echo $userID;?>" name="cr_KeepUserID" />
			<input type="hidden" id="cr_KeepUser" value="<?php echo $userName;?>" name="cr_KeepUser" />
			<input type="hidden" id="cr_StationID" value="" name="cr_StationID" />
			<input type="hidden" id="cr_Station" value="" name="cr_Station" />
		</form>
	</body>
</html>
