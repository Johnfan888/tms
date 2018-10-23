<?php
/*
 * 票版信息查询页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");
//载入初始化文件
require_once("../ui/inc/init.inc.php");
$checkdate3=date('Y-m-d');
$checkdate4=date('Y-m-d');
if(isset($_REQUEST['resultquery']) || isset($_REQUEST['exceldoc'])){
$checkdate1=$_POST['startdate'];
$checkdate2=$_POST['enddate'];
$checkdate5=$_POST['startdate'];
$checkdate6=$_POST['enddate'];
$ticketID=$_POST['ticketID'];
		if($ticketID==""){
		if($checkdate1 == "" && $checkdate2 == ""){
 			$strDate = '';
 		}
 		else{
		if ($checkdate1 != "" && $checkdate2 == ""){ //发车日期处理
			$checkdate1=$_POST['startdate'].' 00:00:00';
 			$strDate="and at_AlterDateTime >='{$checkdate1}'";
 			
 		}
 		if ($checkdate1 == "" && $checkdate2 != ""){
			$checkdate2=$_POST['enddate'].' 23:59:59';
 			$strDate="and at_AlterDateTime <='{$checkdate2}'";
 		}
 		if ($checkdate1 != "" && $checkdate2 != ""){
 			$checkdate1=$_POST['startdate'].' 00:00:00';
			$checkdate2=$_POST['enddate'].' 23:59:59';
 			$strDate="and at_AlterDateTime >='{$checkdate1}' and at_AlterDateTime <='{$checkdate2}'";
 		}
	}
		}
		else{
			$strDate = '';
		}
}
	if(isset($_POST['exceldoc'])){
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");

		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '', '', '', '', '', '', '改签信息表', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$checkdate5" . "至" . "$checkdate6";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('票号', '原班次编号', '发车日期', '起点发车时间', '出发站', '到达站', '车型名', '座位编号', '售票价格', '改签日期', '服务费', '售票员编号', '改签员编号', '改签员姓名', 
						'改签后班次', '改签后发车日期', '改签后发车时间', '改签后座位号');
		fputcsv($fp, $head);
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = ""; 
			$queryString = "SELECT 
					at_TicketID,
					at_NoOfRunsID,
					at_NoOfRunsdate,
					at_BeginStationTime,
					at_BeginStation,
					at_FromStation,
					at_ReachStation,
					at_EndStation,
					at_BusModel,
					at_SeatID,
					at_SellPrice,
					at_AlterDateTime,
					at_ServiceFee,
					at_SellID,
					at_AlterSellID,
					at_AlterSellName
					FROM tms_sell_AlterTicket
					WHERE 
					at_TicketID like '$ticketID%'".$strDate;
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysql_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			}
			$queryString1 = "SELECT st_NoOfRunsID,st_NoOfRunsdate,st_BeginStationTime,st_SeatID FROM tms_sell_SellTicket WHERE st_TicketID = '{$row['at_TicketID']}'";
				$result1 = $class_mysql_default->my_query("$queryString1");
				$row1 = mysql_fetch_array($result1);
			//	if($ticketID==""){
			$row['at_TicketID']=$row['at_TicketID']."\t";
			$outputRow = array($row['at_TicketID'], $row['at_NoOfRunsID'], $row['at_NoOfRunsdate'], $row['at_BeginStationTime'],
				$row['at_FromStation'], $row['at_ReachStation'], $row['at_BusModel'], $row['at_SeatID'], $row['at_SellPrice'], $row['at_AlterDateTime'], 
				$row['at_ServiceFee'],  $row['at_SellID'], $row['at_AlterSellID'], $row['at_AlterSellName'], 
				$row1['st_NoOfRunsID'], $row1['st_NoOfRunsdate'], $row1['st_BeginStationTime'], $row1['st_SeatID']);
			
			fputcsv($fp, $outputRow); 
		}
		fclose($fp);
		exit();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>改签查询</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>	
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		
</head>
<body>
<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 改签信息查询</span></td>
			</tr>
		</table>
<form action="" method="post" name="form1">
		<table width="100%" align="center"  border="1" cellpadding="3" cellspacing="1">
			<tr bgcolor="#FFFFFF">
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 票号：</span></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><input type="text" name="ticketID" id="ticketID" value="<?php echo $ticketID; ?>"/></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />改签日期：</span></td>
				<td bgcolor="#FFFFFF">
					<input type="text" name="startdate" id="startdate" class="Wdate" value="<?php if(isset($_POST['resultquery'])){if($ticketID==""){echo $_POST['startdate'];}} else{ echo $checkdate3;} ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    				&nbsp;&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;<input type="text" name="enddate" id="enddate" class="Wdate" value="<?php if(isset($_POST['resultquery'])){if($ticketID==""){echo $_POST['enddate'];}} else{ echo $checkdate4;}?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
				</td>
				<td>
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="resultquery" id="resultquery" value="查询" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="exceldoc" id="exceldoc" value="导出Excel" />
				</td>
			</tr>
		</table>	
		<div id="tableContainer" class="tableContainer" > 
		<table class="main_tableboder" id="table1" > 
		<thead class="fixedHeader"> 
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">票号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">原班次编号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">起点发车时间</th>
<!--			<th nowrap="nowrap" align="center" bgcolor="#006699">起始站</th>-->
				<th nowrap="nowrap" align="center" bgcolor="#006699">出发站</th>
<!--			<th nowrap="nowrap" align="center" bgcolor="#006699">终点站</th>-->
				<th nowrap="nowrap" align="center" bgcolor="#006699">到达站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车型名</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">座位编号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票价格</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">改签日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">服务费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">售票员编号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">改签员编号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">改签员姓名</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">改签后班次</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">改签后发车日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">改签后发车时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">改签后座位号</th>
			</tr>
		</thead>
		<tbody class="scrollContent"> 
			<?php
				if(isset($_POST['resultquery'])) {
			 		//echo $ticketID;
			 	//	echo $startdate;
			 	//	echo $enddate;
					$queryString = "SELECT 
					at_TicketID,
					at_NoOfRunsID,
					at_NoOfRunsdate,
					at_BeginStationTime,
					at_BeginStation,
					at_FromStation,
					at_ReachStation,
					at_EndStation,
					at_BusModel,
					at_SeatID,
					at_SellPrice,
					at_AlterDateTime,
					at_ServiceFee,
					at_SellID,
					at_AlterSellID,
					at_AlterSellName
					FROM tms_sell_AlterTicket
					WHERE 
					at_TicketID like '$ticketID%'".$strDate;
					//echo $strDate;
					//echo $queryString;
					$result = $class_mysql_default->my_query("$queryString");
					while ($row1 = mysql_fetch_array($result)) {
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row1['at_TicketID'];?></td>
				<td nowrap="nowrap"><?php echo $row1['at_NoOfRunsID'];?></td>
				<td nowrap="nowrap"><?php echo $row1['at_NoOfRunsdate'];?></td>
				<td nowrap="nowrap"><?php echo $row1['at_BeginStationTime'];?></td>
				<!--<td nowrap="nowrap"><?php echo $row1['at_BeginStation'];?></td>
				--><td nowrap="nowrap"><?php echo $row1['at_FromStation'];?></td>
				<!--<td nowrap="nowrap"><?php echo $row1['at_EndStation'];?></td>-->
				<td nowrap="nowrap"><?php echo $row1['at_ReachStation'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['at_BusModel'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['at_SeatID'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['at_SellPrice'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['at_AlterDateTime'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['at_ServiceFee'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['at_SellID'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['at_AlterSellID'];?></td>
				<td nowrap="nowrap" align="center"><?php echo $row1['at_AlterSellName'];?></td>
				<?php 
				$queryString1 = "SELECT st_NoOfRunsID,st_NoOfRunsdate,st_BeginStationTime,st_SeatID FROM tms_sell_SellTicket WHERE st_TicketID = '{$row1['at_TicketID']}'";
				$result1 = $class_mysql_default->my_query("$queryString1");
				$row = mysql_fetch_array($result1);
				?>
				<td nowrap="nowrap"><?php echo $row['st_NoOfRunsID'];?></td>
				<td nowrap="nowrap"><?php echo $row['st_NoOfRunsdate'];?></td>
				<td nowrap="nowrap"><?php echo $row['st_BeginStationTime'];?></td>
				<td nowrap="nowrap"><?php echo $row['st_SeatID'];?></td>
				<?php 
						}
					}
				?>
		</tr>
		</tbody>
		</table>
		</div>	
</form>
</body>
</html>

		