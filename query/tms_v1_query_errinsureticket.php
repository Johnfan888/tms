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
	$errticket=$_POST['errTicketID'];
	$station=$_POST['stationselect'];
	$conducter=$_POST['sellerselect'];
	$checkdate3=date('Y-m-d');
	$checkdate4=date('Y-m-d');
	$StationName = "";
	$checkdate1=$_POST['startdate'];
	$checkdate2=$_POST['enddate'];
if($selldate!=""){
	$strDate="and eitt_ErrDate ='{$selldate}' ";
}
else{
	$strDate="and eitt_ErrDate >='{$startdate}' and eitt_ErrDate <='{$enddate}'";
}
if(isset($_POST['resultquery']) || isset($_POST['exceldoc'])) {
	if (($StationName = $_POST['stationselect']) == "")
		$StationName = "%";
	//echo $checkdate1;stationselect
	//echo $checkdate2;
if($startdate=="" || $enddate==""){
	if($_POST['errTicketID']==""){
		if($checkdate1 == "" && $checkdate2 == ""){
 			$strDate = '';
 		}
 		else{
		$checkdate1=$_POST['startdate'];
		$checkdate2=$_POST['enddate'];
		if ($checkdate1 != "" && $checkdate2 == ""){ //发车日期处理
 			$strDate="and eitt_ErrDate >='{$checkdate1}'";
 			
 		}
 		if ($checkdate1 == "" && $checkdate2 != ""){
 			$strDate="and eitt_ErrDate <='{$checkdate2}'";
 		}
 		if ($checkdate1 != "" && $checkdate2 != ""){
 			$strDate="and eitt_ErrDate >='{$checkdate1}' and eitt_ErrDate <='{$checkdate2}'";
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
 			$strDate="and eitt_ErrDate >='{$checkdate1}'";
 			
 		}
 		if ($checkdate1 == "" && $checkdate2 != ""){
 			$strDate="and eitt_ErrDate <='{$checkdate2}'";
 		}
 		if ($checkdate1 != "" && $checkdate2 != ""){
 			$strDate="and eitt_ErrDate >='{$checkdate1}' and eitt_ErrDate <='{$checkdate2}'";
 		}
		else{
			$strDate = '';
		}
 }
 		//导出EXCEL表格
 if(isset($_POST['exceldoc'])) {
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");

		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '', '','废保险票信息表', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$checkdate1" . "至" . "$checkdate2";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		fputcsv($fp, $out);
		$head = array('同步码', '保险票号', '客票号', '创建类型', '身份证号', '购票者姓名', '受益人', '保险价格', '套餐信息', '废票时间', '废票日期', '废票者编号', '废票者', '废票车站', '废票原因');
		fputcsv($fp, $head);
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = ""; 
		 $queryString="select 
		    eitt_SyncCode,
		    eitt_InsureTicketNo,
		    eitt_TicketNo,
		    eitt_CreatedType,
		    eitt_IdCard,
		    eitt_Name,
		    eitt_Beneficiary,
		    eitt_Price,
		    eitt_AinsuranceValue,
		    eitt_BinsuranceValue,
		    eitt_CinsuranceValue,
		    eitt_DinsuranceValue,
		    eitt_ErrTime,
		    eitt_ErrDate,
		    eitt_ErrUserID,
		    eitt_ErrUser,
		    eitt_StationName,
		    eitt_Cause
		    from tms_sell_ErrInsureTicket
		    where
		    eitt_InsureTicketNo like '$errticket%'
		    and eitt_ErrUserID like '%$conducter%'
		    and eitt_StationName like '$station%'
		    ".$strDate;
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysql_fetch_array($result)) {
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			}
			$row['eitt_InsureTicketNo']=$row['eitt_InsureTicketNo']."\t";
			$row['eitt_TicketNo']=$row['eitt_TicketNo']."\t";
			$outputRow = array($row['eitt_SyncCode'], $row['eitt_InsureTicketNo'], $row['eitt_TicketNo'], $row['eitt_CreatedType'], $row['eitt_IdCard'], 
				$row['eitt_Name'], $row['eitt_Beneficiary'], $row['eitt_Price'], $row['eitt_AinsuranceValue'].'|'.$row['eitt_BinsuranceValue'].'|'.$row['eitt_CinsuranceValue'].'|'.$row['eitt_DinsuranceValue'], 
				$row['eitt_ErrTime'], $row['eitt_ErrDate'], $row['eitt_ErrUserID'], $row['eitt_ErrUser'], $row['eitt_StationName'], 
				$row['eitt_Cause']); 
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
		<title>废保险票查询</title>
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
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 废保险票信息查询</span></td>
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
				<input type="text" name="startdate" id="startdate" class="Wdate" value="<?php if(isset($_POST['resultquery'])){if($_POST['errTicketID']==""){echo $_POST['startdate'];}} else{ echo $checkdate3;} ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    					至
    			<input type="text" name="enddate" id="enddate" class="Wdate" value="<?php if(isset($_POST['resultquery'])){if($_POST['errTicketID']==""){echo $_POST['enddate'];}} else{ echo $checkdate4;}?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
				<?php } else { ?>
				<input type="text" name="startdate2" id="startdate2" class="Wdate" value="<?php if($selldate!=""){ echo $selldate; }else{ echo $startdate; } ?>" disabled="disabled" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
				<input type="hidden" name="startdate" id="startdate" class="Wdate" value="<?php if($selldate!=""){ echo $selldate; }else{ echo $startdate; } ?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    			至
    			<input type="text" name="enddate2" id="enddate2" class="Wdate" disabled="disabled" value="<?php if($selldate!=""){ echo $selldate; }else{ echo $enddate; } ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    			<input type="hidden" name="enddate" id="enddate" class="Wdate" value="<?php if($selldate!=""){ echo $selldate; }else{ echo $enddate; }  ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
				<?php } ?>
				</td>
				</tr>
				<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 废票员：</span></td>
				
				<td>
					<?php if($startdate=="" && $enddate==""){ ?>
					<select id="sellerselect" name="sellerselect" size="1" style="width:131px;">
					<?php if($conducter=="") {?>
						<option value="" selected="selected">请选择废票员</option>
						<?php } else {?>
						<option value="<?php echo $conducter?>" selected="selected"><?php echo $conducter?></option>
						<?php } ?>
					</select>
					<?php } else {?>
					<input type="hidden" name="sellerselect" id="sellerselect" value="<?php echo $userID; ?>"/>
					<input type="text" disabled="disabled" name="sellerselect1" id="sellerselect1" value="<?php echo $userID; ?>"/>
					<?php } ?>
				</td>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />保险票号：&nbsp;&nbsp;&nbsp;</span></td>
				<td><input type="text" name="errTicketID" id="errTicketID" value="<?php echo $errticket ?>"/></td>
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
				<th nowrap="nowrap" align="center" bgcolor="#006699">同步码</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保险票号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">客票号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">创建类型</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">身份证号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">购票者姓名</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">受益人</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">保险价格</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">套餐信息</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">废票时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">废票日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">废票者编号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">废票者</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">废票车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">废票原因</th>
			</tr>
		</thead>
		<tbody class="scrollContent">
		<?php 
		if($startdate!="" || $enddate!=""){
			$sql="select 
		    eitt_SyncCode,
		    eitt_InsureTicketNo,
		    eitt_TicketNo,
		    eitt_CreatedType,
		    eitt_IdCard,
		    eitt_Name,
		    eitt_Beneficiary,
		    eitt_Price,
		    eitt_AinsuranceValue,
		    eitt_BinsuranceValue,
		    eitt_CinsuranceValue,
		    eitt_DinsuranceValue,
		    eitt_ErrTime,
		    eitt_ErrDate,
		    eitt_ErrUserID,
		    eitt_ErrUser,
		    eitt_StationName,
		    eitt_Cause
		    from tms_sell_ErrInsureTicket
		    where
		    eitt_InsureTicketNo like '$errticket%'
		    and eitt_ErrUserID like '%$sellerid%'
		    and eitt_StationName like '$userStationName%'
		    ".$strDate;
		}
		else{
			if(isset($_POST['resultquery'])) {
			//echo $errticket;
			//echo $conducter;
		    $sql="select 
		    eitt_SyncCode,
		    eitt_InsureTicketNo,
		    eitt_TicketNo,
		    eitt_CreatedType,
		    eitt_IdCard,
		    eitt_Name,
		    eitt_Beneficiary,
		    eitt_Price,
		    eitt_AinsuranceValue,
		    eitt_BinsuranceValue,
		    eitt_CinsuranceValue,
		    eitt_DinsuranceValue,
		    eitt_ErrTime,
		    eitt_ErrDate,
		    eitt_ErrUserID,
		    eitt_ErrUser,
		    eitt_StationName,
		    eitt_Cause
		    from tms_sell_ErrInsureTicket
		    where
		    eitt_InsureTicketNo like '$errticket%'
		    and eitt_ErrUserID like '%$conducter%'
		    and eitt_StationName like '$station%'
		    ".$strDate;
		 //  echo $sql;
			}
		}
		    	$result = $class_mysql_default->my_query("$sql");
				while ($row = mysql_fetch_array($result)) {
		?>
		<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row['eitt_SyncCode'];?></td>
				<td nowrap="nowrap"><?php echo $row['eitt_InsureTicketNo'];?></td>
				<td nowrap="nowrap"><?php echo $row['eitt_TicketNo'];?></td>
				<td nowrap="nowrap"><?php echo $row['eitt_CreatedType'];?></td>
				<td nowrap="nowrap"><?php echo $row['eitt_IdCard'];?></td>
				<td nowrap="nowrap"><?php echo $row['eitt_Name'];?></td>
				<td nowrap="nowrap"><?php echo $row['eitt_Beneficiary'];?></td>
				<td nowrap="nowrap"><?php echo $row['eitt_Price'];?></td>
				<td nowrap="nowrap"><?php echo $row['eitt_AinsuranceValue'].'|'.$row['eitt_BinsuranceValue'].'|'.$row['eitt_CinsuranceValue'].'|'.$row['eitt_DinsuranceValue'];?></td>
				<td nowrap="nowrap"><?php echo $row['eitt_ErrTime'];?></td>
				<td nowrap="nowrap"><?php echo $row['eitt_ErrDate'];?></td>
				<td nowrap="nowrap"><?php echo $row['eitt_ErrUserID'];?></td>
				<td nowrap="nowrap"><?php echo $row['eitt_ErrUser'];?></td>
				<td nowrap="nowrap"><?php echo $row['eitt_StationName'];?></td>
				<td nowrap="nowrap"><?php echo $row['eitt_Cause'];?></td>
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