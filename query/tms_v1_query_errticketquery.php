<?php
/*
 * 废票查询页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$startdate=$_GET['CheckBeginDate'];
$enddate=$_GET['CheckEndDate'];
$selldate=$_GET['selldate'];
$sellerid=$_GET['sellerid'];
$CheckBeginDate = "";
$CheckEndDate = "";
$StationName = "";
$sellerID = "";
$et_TicketID = "";
$sellerID=$_POST['sellerselect'];
$sellerID1=$_POST['sellerselect'];
$checkdate3=date('Y-m-d');
$checkdate4=date('Y-m-d');
if($selldate!=""){
	$strDate="and et_ErrDate ='{$selldate}' ";
}
else{
	$strDate="and et_ErrDate >='{$startdate}' and et_ErrDate <='{$enddate}'";
}
if(isset($_POST['resultquery']) || isset($_POST['exceldoc'])) {
	$checkdate1=$_POST['startdate'];
	$checkdate2=$_POST['enddate'];
	if (($StationName = $_POST['stationselect']) == "")
		$StationName = "%";
	if ($sellerID  == "")
		$sellerID = "%";
	if (($et_TicketID = $_POST['et_TicketID']) == "")
		$et_TicketID = "%";
 if($startdate=="" || $enddate==""){
	if($_POST['et_TicketID']==""){
		if($checkdate1 == "" && $checkdate2 == ""){
 			$strDate = '';
 		}
 		else{
		$checkdate1=$_POST['startdate'];
		$checkdate2=$_POST['enddate'];
		if ($checkdate1 != "" && $checkdate2 == ""){ //发车日期处理
 			$strDate="and et_ErrDate >='{$checkdate1}'";
 			
 		}
 		if ($checkdate1 == "" && $checkdate2 != ""){
 			$strDate="and et_ErrDate <='{$checkdate2}'";
 		}
 		if ($checkdate1 != "" && $checkdate2 != ""){
 			$strDate="and et_ErrDate >='{$checkdate1}' and et_ErrDate <='{$checkdate2}'";
 		}
	}
		}
		else{
			$strDate = '';
		}
 }
 else{
		$checkdate1=$_POST['startdate'];
		$checkdate2=$_POST['enddate'];
		if ($checkdate1 != "" && $checkdate2 == ""){ //发车日期处理
 			$strDate="and et_ErrDate >='{$checkdate1}'";
 			
 		}
 		if ($checkdate1 == "" && $checkdate2 != ""){
 			$strDate="and et_ErrDate <='{$checkdate2}'";
 		}
 		if ($checkdate1 != "" && $checkdate2 != ""){
 			$strDate="and et_ErrDate >='{$checkdate1}' and et_ErrDate <='{$checkdate2}'";
 		}
		else{
			$strDate = '';
		}
}		
	if(isset($_POST['exceldoc'])) {
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");

		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '退票信息表', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$checkdate1" . "至" . "$checkdate2";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('票号', '废票日期', '废票时间', '废票员ID', '废票员', '废票车站', '废票原因', '班次', '发车日期', '发车时间', '始发站', 
			'上车站', '到达站', '终点站', '售价', '票型', '座位号', '售票日期',	'售票时间', '是否缴款', '缴款时间', 
			'原班次', '原发车日期', '原票价', '原座号', '改签时间', '改签车站', '改签员ID', '改签员', '改签备注');
		fputcsv($fp, $head);

		$cnt = 0; 
		$limit = 100000; 
		$outputRow = ""; 
			$queryString1 = "SELECT * FROM 
							tms_sell_ErrTicket 
							WHERE 
							et_Station LIKE '{$StationName}' 
							AND et_ErrUserID LIKE '{$sellerID}' 
							AND et_TicketID LIKE '{$et_TicketID}%'".$strDate;
		$result1 = $class_mysql_default->my_query("$queryString1");
		while ($row1 = mysql_fetch_array($result1)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			$row1['et_IsBalance'] ? $et_IsBalance = "是" : $bh_IsAccount = "否";
			$queryString2 = "SELECT at_NoOfRunsID, at_NoOfRunsdate, at_SellPrice, at_SeatID, at_AlterDateTime, 
									at_AlterStation, at_AlterSellID, at_AlterSellName, at_Remark FROM tms_sell_AlterTicket 
									WHERE at_TicketID like '{$row1['et_TicketID']}%'";
			$result2 = $class_mysql_default->my_query("$queryString2");
			$row2 = mysql_fetch_array($result2);						
			$outputRow = array($row1['et_TicketID'], $row1['et_ErrDate'], $row1['et_ErrTime'], $row1['et_ErrUserID'],
				$row1['et_ErrUser'], $row1['et_Station'], $row1['et_Cause'], $row1['et_NoOfRunsID'], $row1['et_NoOfRunsdate'], 
				$row1['et_BeginStationTime'], $row1['et_BeginStation'], $row1['et_FromStation'], $row1['et_ReachStation'], 
				$row1['et_EndStation'],	$row1['et_SellPrice'], $row1['et_SellPriceType'], $row1['et_SeatID'], $row1['et_SellDate'], 
				$row1['et_SellTime'],	$et_IsBalance, $row1['et_BalanceDateTime'], $row2['at_NoOfRunsdate'], $row2['at_SellPrice'], 
				$row2['at_SeatID'], $row2['at_AlterDateTime'], $row2['at_AlterStation'], $row2['at_AlterSellID'], $row2['at_AlterSellName'], 
				$row2['at_Remark']); 
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
		<title>废票查询</title>
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
						$("#sellerselect option:gt(0)").remove();
						var objData = eval('(' + data + ')');
						for (var i = 0; i < objData.length; i++) {
							$("<option value = " + objData[i].sellerID + ">" + objData[i].sellerID + "</option>").appendTo($("#sellerselect"));
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
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 废  票  信 息 查 询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr bgcolor="#FFFFFF">
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 废票车站：</span></td>
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
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 废票日期：</span></td>
				<td colspan="2" bgcolor="#FFFFFF">
				<?php if($startdate=="" && $enddate==""){ ?>
				<input type="text" name="startdate" id="startdate" class="Wdate" value="<?php if(isset($_POST['resultquery'])){if($_POST['et_TicketID']==""){echo $_POST['startdate'];}} else{ echo $checkdate3;} ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    					至
    			<input type="text" name="enddate" id="enddate" class="Wdate" value="<?php if(isset($_POST['resultquery'])){if($_POST['et_TicketID']==""){echo $_POST['enddate'];}} else{ echo $checkdate4;}?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
				<?php } else { ?>
				<input type="text" name="startdate2" id="startdate2" class="Wdate" value="<?php if($selldate!=""){ echo $selldate; }else{ echo $startdate; }    ?>" disabled="disabled" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
				<input type="hidden" name="startdate" id="startdate" class="Wdate" value="<?php if($selldate!=""){ echo $selldate; }else{ echo $startdate; }   ?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    			至
    			<input type="text" name="enddate2" id="enddate2" class="Wdate" disabled="disabled" value="<?php if($selldate!=""){ echo $selldate; }else{ echo $enddate; }   ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    			<input type="hidden" name="enddate" id="enddate" class="Wdate" value="<?php if($selldate!=""){ echo $selldate; }else{ echo $enddate; } ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
				<?php } ?>
				</td>
				</tr>
				<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 废票员：</span></td>
				<td>
				<?php if($startdate=="" && $enddate==""){ ?>
					<select id="sellerselect" name="sellerselect" size="1" style="width:131px;">
					<?php if($sellerID1=="") {?>
						<option value="" selected="selected">请选择废票员</option>
						<?php } else {?>
						<option value="<?php echo $sellerID1?>" selected="selected"><?php echo $sellerID1?></option>
						<?php } ?>
					</select>
					<?php } else {?>
					<input type="hidden" name="sellerselect" id="sellerselect" value="<?php echo $userID; ?>"/>
					<input type="text" disabled="disabled" name="sellerselect1" id="sellerselect1" value="<?php echo $userID; ?>"/>
					<?php } ?>
				</td>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 票号：&nbsp;&nbsp;&nbsp;</span></td>
				<td><input type="text" name="et_TicketID" id="et_TicketID" value="<?php ($et_TicketID == "" || $et_TicketID == "%")? print "" : print $et_TicketID;?>"/></td>
				<td>
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" id="resultquery" value="查询" />
					<?php if($startdate!="" || $enddate!=""){  ?>
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="return" id="return" value="返回" onclick="return1()"/>
					<?php } ?>
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="exceldoc" id="exceldoc" value="导出Excel" />
				</td>
			</tr>
		</table>
		<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">票号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">废票日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">废票时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">废票员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">废票员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">废票车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">废票原因</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发车时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">始发站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">上车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">到达站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">终点站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售价</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">票型</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">座位号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">是否缴款</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">缴款时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">原班次</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">原发车日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">原票价</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">原座号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">改签时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">改签车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">改签员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">改签员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">改签备注</th>
			</tr>
		</thead>
		<tbody class="scrollContent">
			<?php
				if($startdate!="" || $enddate!=""){
				$queryString1 = "SELECT * FROM 
							tms_sell_ErrTicket 
							WHERE 
							et_Station LIKE '{$userStationName}%' 
							AND et_ErrUserID LIKE '{$sellerid}%' 
							AND et_TicketID LIKE '{$et_TicketID}%'".$strDate;
			//	echo $queryString1;
				}
				else{
				if(isset($_POST['resultquery'])) {
					$queryString1 = "SELECT * FROM 
									tms_sell_ErrTicket 
									WHERE 
									et_Station LIKE '{$StationName}' 
									AND et_ErrUserID LIKE '{$sellerID}' 
									AND et_TicketID LIKE '{$et_TicketID}%'".$strDate;
					//echo  $queryString1;
				}
				}
					$result1 = $class_mysql_default->my_query("$queryString1");
					while ($row1 = mysql_fetch_array($result1)) {
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row1['et_TicketID'];?></td>
				<td nowrap="nowrap"><?php echo $row1['et_ErrDate'];?></td>
				<td nowrap="nowrap"><?php echo $row1['et_ErrTime'];?></td>
				<td nowrap="nowrap"><?php echo $row1['et_ErrUserID'];?></td>
				<td nowrap="nowrap"><?php echo $row1['et_ErrUser'];?></td>
				<td nowrap="nowrap"><?php echo $row1['et_Station'];?></td>
				<td nowrap="nowrap"><?php echo $row1['et_Cause'];?></td>
				<td nowrap="nowrap"><?php echo $row1['et_NoOfRunsID'];?></td>
				<td nowrap="nowrap"><?php echo $row1['et_NoOfRunsdate'];?></td>
				<td nowrap="nowrap"><?php echo $row1['et_BeginStationTime'];?></td>
				<td nowrap="nowrap"><?php echo $row1['et_BeginStation'];?></td>
				<td nowrap="nowrap"><?php echo $row1['et_FromStation'];?></td>
				<td nowrap="nowrap"><?php echo $row1['et_ReachStation'];?></td>
				<td nowrap="nowrap"><?php echo $row1['et_EndStation'];?></td>
				<td nowrap="nowrap"><?php echo $row1['et_SellPrice'];?></td>
				<td nowrap="nowrap"><?php echo $row1['et_SellPriceType'];?></td>
				<td nowrap="nowrap"><?php echo $row1['et_SeatID'];?></td>
				<td nowrap="nowrap"><?php echo $row1['et_SellDate'];?></td>
				<td nowrap="nowrap"><?php echo $row1['et_SellTime'];?></td>
				<td nowrap="nowrap"><?php if ($row1['et_IsBalance']) echo "是"; else echo "否";?></td>
				<td nowrap="nowrap"><?php echo $row1['et_BalanceDateTime'];?></td>
			<?php 
						$queryString2 = "SELECT at_NoOfRunsID, at_NoOfRunsdate, at_SellPrice, at_SeatID, at_AlterDateTime, 
									at_AlterStation, at_AlterSellID, at_AlterSellName, at_Remark FROM tms_sell_AlterTicket 
									WHERE at_TicketID like '{$row1['et_TicketID']}%'";
						$result2 = $class_mysql_default->my_query("$queryString2");
						$row2 = mysql_fetch_array($result2);						
			?>	
				<td nowrap="nowrap"><?php echo $row2['at_NoOfRunsID'];?></td>
				<td nowrap="nowrap"><?php echo $row2['at_NoOfRunsdate'];?></td>
				<td nowrap="nowrap"><?php echo $row2['at_SellPrice'];?></td>
				<td nowrap="nowrap"><?php echo $row2['at_SeatID'];?></td>
				<td nowrap="nowrap"><?php echo $row2['at_AlterDateTime'];?></td>
				<td nowrap="nowrap"><?php echo $row2['at_AlterStation'];?></td>
				<td nowrap="nowrap"><?php echo $row2['at_AlterSellID'];?></td>
				<td nowrap="nowrap"><?php echo $row2['at_AlterSellName'];?></td>
				<td nowrap="nowrap"><?php echo $row2['at_Remark'];?></td>
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
