<?php
//调度界面

//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
if(isset($_POST['Busnumber'])){
	$noofrunStatus = $_REQUEST['statusselect'];
	$busnumber=$_POST['Busnumber'];
	$DataBeginDate=$_POST['DataBeginDate'];
	$DataEndDate=$_POST['DataEndDate'];
	$state = $_REQUEST['state'];	//班次类别
	$schStation = $_POST['stationselect']; //发车站
	if($schStation == '请选择车站'){
		$schStation = '';
	}
	//$noofrun=$_POST['noofrun']; //班次
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head> 
	<title>车辆报班查询</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<meta http-equiv="refresh" content="<?php echo $refreshInterval?>;url=tms_v1_schedule_noofrun.php" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<link href="../css/tms.css" rel="stylesheet" type="text/css">
 	<script type="text/javascript" src="../js/jquery-1.8.2.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#table1").tablesorter();
		$("#table1 tr").mouseover(function(){$(this).css("background-color","#f1e6c2");});
		$("#table1 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
		$("#table1 tr").click(function(){
			$("#table1 tr:not(this)").css("background-color","#CCCCCC");
			$("#table1 tr:not(this)").mouseover(function(){$(this).css("background-color","#f1e6c2");});
			$("#table1 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$(this).css("background-color","#FFCC00");
			$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
			$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
		});
		$("#Busnumber").keyup(function(){
			$("#Busnumberselect").empty();
			document.getElementById("Busnumberselect").style.display=""; 
			var BusNumber = $("#Busnumber").val();
			jQuery.get(
				'../basedata/tms_v1_basedata_getbusdata.php',
				{'op': 'getbus', 'BusNumber': BusNumber, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					for (var i = 0; i < objData.length; i++) {
						$("<option value = " + objData[i].BusNumber + ">" + objData[i].BusNumber + "</option>").appendTo($("#Busnumberselect"));
					}
					if(BusNumber==''){
						document.getElementById("Busnumberselect").style.display="none";
					}
			});
		});
		document.getElementById("Busnumberselect").onclick = function (event){
			document.getElementById("Busnumber").value=document.getElementById("Busnumberselect").value;
			document.getElementById("Busnumberselect").style.display="none";
		};
	});
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
		<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
		<span class="graytext" style="margin-left:8px;">报班查询</span></td>
	</tr>
</table>
<form action="" method="post" name="form1">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr bgcolor="#FFFFFF">
		<!-- 
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：</span></td>
		<td nowrap="nowrap">
			<input type="text" name="noofrun" id="noofrun" value="<?php echo $noofrun;?>">
		</td>
		 -->
		 <td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发车站：</span></td>
		<td nowrap="nowrap">
			<select id="stationselect" name="stationselect" size="1">
            <?php
            	if($userStationID == "all") {
            ?>
				<?php if ($schStation == "" || $schStation == "%") { ?>
					<option value="" selected="selected">请选择车站</option>
				<?php } else { ?>
					<option value="<?php echo $schStation?>" selected="selected"><?php echo $schStation?></option>
				<?php } ?>
			<?php 
					$queryString = "SELECT DISTINCT sset_SiteName FROM tms_bd_SiteSet WHERE sset_IsStation=1";
					$result = $class_mysql_default->my_query("$queryString");
			        while($res = mysqli_fetch_array($result)) {
	            		if($res['sset_SiteName'] != $schStation) {
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
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次类型：</span></td>
		<td nowrap="nowrap">
			 <select name="state" id="state" style="width:100px">
			 	<?php 
	 			if($state == "1"){
	 			?>
	 			<option value="1" selected="selected">通票班次</option>
	 			<option value="0" >非通票班次</option>
	 			<option value="">全部班次</option>
	 			<?php 
	 			}
	 			if($state == "0"){
	 			?>
	 			<option value="1">通票班次</option>
	 			<option value="0"  selected="selected">非通票班次</option>
	 			<option value="">全部班次</option>
	 			<?php 
	 			}
	 			if($state == ""){
	 			?>
	 			<option value="1">通票班次</option>
	 			<option value="0">非通票班次</option>
	 			<option value=""   selected="selected">全部班次</option>
	 			<?php 
	 			}
	 			?>
		 		</select>
		</td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />班次状态</span></td>
		<td nowrap="nowrap">
			<select name="statusselect" id="statusselect" style="width:100px">
				<?php
				if ($noofrunStatus == "1")	echo "<option selected=\"selected\" value=\"1\">全部</option>";
				else						echo "<option  value=\"1\">全部</option>";
				if ($noofrunStatus == "2")	echo "<option selected=\"selected\" value=\"2\">在售</option>";
				else						echo "<option  value=\"2\">在售</option>";
				if ($noofrunStatus == "3")	echo "<option selected=\"selected\" value=\"3\">暂停</option>";
				else						echo "<option  value=\"3\">暂停</option>";
				if ($noofrunStatus == "4")	echo "<option selected=\"selected\" value=\"4\">发班</option>";
				else						echo "<option  value=\"4\">发班</option>";
				if ($noofrunStatus == "5")	echo "<option selected=\"selected\" value=\"5\">检票</option>";
				else						echo "<option  value=\"5\">检票</option>";
				if ($noofrunStatus == "6")	echo "<option selected=\"selected\" value=\"6\">并班</option>";
				else						echo "<option  value=\"6\">并班</option>";
			?>
			</select>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
		<td nowrap="nowrap"><input name="Busnumber" id="Busnumber" value="<?php echo $busnumber;?>"/>
			<br/>
	    	<select id="Busnumberselect" name="Busnumberselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
		</td>
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />日期：</span></td>
		<td nowrap="nowrap" colspan='2'><input type="text" name="DataBeginDate" id="DataBeginDate" class="Wdate" value="<?php  ($DataBeginDate == "")? print date('Y-m-d') : print $DataBeginDate;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" />
    		&nbsp;&nbsp;至&nbsp;&nbsp;<input type="text" name="DataEndDate" id="DataEndDate" class="Wdate" value="<?php ($DataEndDate == "")? print date('Y-m-d') : print $DataEndDate;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
    	<td nowrap="nowrap">
    		<input type="submit" name="queryandnoruns" id="queryandnoruns" value="查询" />
    		<input type="button" name="back" id="back" value="返回"  onclick="location.assign('tms_v1_schedule_noofrun.php')"/>
    	</td>
	</tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
	<tr>
		<th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">线路</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">报班时间</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">通票</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">班次状态</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">总人数</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">总票价</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">结算价</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">结算单号</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">调度站</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">调度站编号</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">调度员</th>
		<th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
	</tr>
	</thead>

<?php
if(isset($_POST['Busnumber'])){
	$allSupTicketRen=0;
	$allPriceTotal=0;
	$allbalance=0;
	$allbalancenum=0;
	$reportnum=0;
	if($DataBeginDate=='' && $DataEndDate==''){
		$strdate="";
	}
	if($DataBeginDate!='' && $DataEndDate==''){
		$strdate=" AND rt_NoOfRunsdate>='{$DataBeginDate}'";
	}
	if($DataBeginDate=='' && $DataEndDate!=''){
	 $strdate=" AND rt_NoOfRunsdate<='{$DataEndDate}'";
	} 
	if($DataBeginDate!='' && $DataEndDate!=''){
	 $strdate=" AND rt_NoOfRunsdate>='{$DataBeginDate}' AND rt_NoOfRunsdate<='{$DataEndDate}'";
	} 
		$strStatus = "";
		if($noofrunStatus=='1'){ //班次状态的判断,全部
			$strStatus="";
		}
		if($noofrunStatus=='2'){ //在售
			$strStatus=" AND ct_Flag = '0' AND (tml_StopRun,tml_AllowSell) not in  (SELECT tml_StopRun,tml_AllowSell FROM tms_bd_TicketMode where tml_StopRun='0' AND tml_AllowSell = '0') and (tml_StopRun) not in  (SELECT tml_StopRun FROM tms_bd_TicketMode where tml_StopRun='3')";
		}
		if($noofrunStatus=='3'){//暂停
			$strStatus=" AND tml_AllowSell='0' AND tml_StopRun='0' AND ct_Flag = '0'";
		}
		if($noofrunStatus=='4'){//发班
			$strStatus=" AND (ct_Flag ='3' OR ct_Flag ='2')";
		}
		if($noofrunStatus=='5'){//检票
			$strStatus=" AND ct_Flag ='1'";
		}
		if($noofrunStatus=='6'){//并班
			$strStatus=" AND tml_StopRun='3' AND ct_Flag = '0'";
		}
	/*	if($noofrunStatus == ""){
			$strStatus == "";
		}
		if($noofrunStatus == '0'){
			$strStatus=" AND ct_Flag = '0'";
		}
		if($noofrunStatus == '1'){
			$strStatus=" AND ct_Flag ='1'";
		}
		if($noofrunStatus == '2'){
			$strStatus="AND ct_Flag ='2' OR ct_Flag ='3'";	
		}*/
		
/*	if($userStationName == "全部车站")
	$strsqlselet = "SELECT tml_AllowSell,tml_StopRun, rt_Allticket,ct_Flag,rt_NoOfRunsID,rt_BusCard,rt_NoOfRunsdate,rt_ReportDateTime,rt_Remark,li_LineName,bht_SupTicketRen,bht_PriceTotal,bht_ServiceFee,bht_otherFee1,bht_otherFee2,bht_otherFee3,bht_otherFee4,rt_ReportUser,rt_AttemperStation,rt_AttemperStationID,
		bht_otherFee5,bht_otherFee6,bht_BalanceNO,bh_BalanceNO,bh_SupTicketRen,bh_PriceTotal,bh_ServiceFee,bh_otherFee1,bh_otherFee2,bh_otherFee3,bh_otherFee4,bh_otherFee5,bh_otherFee6 
		FROM tms_sch_Report LEFT OUTER JOIN tms_acct_BalanceInHandTemp ON bht_BusNumber=rt_BusCard AND bht_NoOfRunsID=rt_NoOfRunsID AND bht_NoOfRunsdate=rt_NoOfRunsdate AND bht_State='正常' 
		LEFT OUTER JOIN tms_acct_BalanceInHand ON bh_BusNumber=rt_BusCard AND bh_NoOfRunsID=rt_NoOfRunsID AND bh_NoOfRunsdate=rt_NoOfRunsdate 
		LEFT OUTER JOIN tms_bd_LineInfo ON li_LineID=rt_LineID 
		LEFT OUTER JOIN tms_chk_CheckTemp on ct_NoOfRunsID=rt_NoOfRunsID AND ct_NoOfRunsdate=rt_NoOfRunsdate AND ct_BusNumber=rt_BusCard AND AND ct_ReportDateTime=rt_ReportDateTime
		LEFT OUTER JOIN tms_bd_TicketMode ON tml_NoOfRunsID = rt_NoOfRunsID AND tml_NoOfRunsdate = rt_NoOfRunsdate
		LEFT OUTER JOIN tms_bd_PriceDetail ON rt_NoOfRunsID=pd_NoOfRunsID AND rt_NoOfRunsdate=pd_NoOfRunsdate 
		WHERE rt_AttemperStation like '{$schStation}%' AND pd_FromStation LIKE '{$schStation}%' rt_BusCard LIKE '{$busnumber}%'  AND rt_Allticket like '$state%'".$strdate.$strStatus."ORDER BY ct_Flag";*/
	//else {
	/*$strsqlselet = "SELECT tml_AllowSell,tml_StopRun, rt_Allticket,ct_Flag,rt_NoOfRunsID,rt_BusCard,rt_NoOfRunsdate,rt_ReportDateTime,rt_Remark,li_LineName,bht_SupTicketRen,bht_PriceTotal,bht_ServiceFee,bht_otherFee1,bht_otherFee2,bht_otherFee3,bht_otherFee4,rt_ReportUser,rt_AttemperStation,rt_AttemperStationID,
		bht_otherFee5,bht_otherFee6,bht_BalanceNO,bh_BalanceNO,bh_SupTicketRen,bh_PriceTotal,bh_ServiceFee,bh_otherFee1,bh_otherFee2,bh_otherFee3,bh_otherFee4,bh_otherFee5,bh_otherFee6 
		FROM tms_sch_Report 
		LEFT OUTER JOIN tms_acct_BalanceInHandTemp ON bht_BusNumber=rt_BusCard AND bht_NoOfRunsID=rt_NoOfRunsID AND bht_NoOfRunsdate=rt_NoOfRunsdate AND bht_State='正常' 
		LEFT OUTER JOIN tms_acct_BalanceInHand ON bh_BusNumber=rt_BusCard AND bh_NoOfRunsID=rt_NoOfRunsID AND bh_NoOfRunsdate=rt_NoOfRunsdate 
		LEFT OUTER JOIN tms_bd_LineInfo ON li_LineID=rt_LineID 
		LEFT OUTER JOIN tms_chk_CheckTemp on ct_NoOfRunsID=rt_NoOfRunsID AND ct_NoOfRunsdate=rt_NoOfRunsdate AND ct_BusNumber=rt_BusCard AND ct_ReportDateTime=rt_ReportDateTime
		LEFT OUTER JOIN tms_bd_TicketMode ON tml_NoOfRunsID = rt_NoOfRunsID AND tml_NoOfRunsdate = rt_NoOfRunsdate
		LEFT OUTER JOIN tms_bd_PriceDetail ON rt_NoOfRunsID=pd_NoOfRunsID AND rt_NoOfRunsdate=pd_NoOfRunsdate 
		WHERE rt_AttemperStation = '{$schStation}' AND pd_FromStation = '{$schStation}' AND rt_BusCard LIKE '{$busnumber}%' AND rt_Allticket like '$state%'".$strdate.$strStatus."  ORDER BY rt_ReportDateTime";*/
	//}	
	$strsqlselet="SELECT tml_AllowSell,tml_StopRun, rt_Allticket,ct_Flag,rt_NoOfRunsID,rt_BusCard,rt_NoOfRunsdate,rt_ReportDateTime,rt_Remark,li_LineName,bht_SupTicketRen,bht_PriceTotal,bht_ServiceFee,bht_otherFee1,bht_otherFee2,bht_otherFee3,bht_otherFee4,rt_ReportUser,rt_AttemperStation,rt_AttemperStationID,
		bht_otherFee5,bht_otherFee6,bht_BalanceNO,bh_BalanceNO,bh_SupTicketRen,bh_PriceTotal,bh_ServiceFee,bh_otherFee1,bh_otherFee2,bh_otherFee3,bh_otherFee4,bh_otherFee5,bh_otherFee6 
		FROM tms_sch_Report 
		LEFT OUTER JOIN tms_acct_BalanceInHandTemp ON bht_BusNumber=rt_BusCard AND bht_NoOfRunsID=rt_NoOfRunsID AND bht_NoOfRunsdate=rt_NoOfRunsdate AND bht_State='正常' 
		LEFT OUTER JOIN tms_acct_BalanceInHand ON bh_BusNumber=rt_BusCard AND bh_NoOfRunsID=rt_NoOfRunsID AND bh_NoOfRunsdate=rt_NoOfRunsdate LEFT OUTER JOIN tms_bd_LineInfo ON li_LineID=rt_LineID 
		LEFT OUTER JOIN tms_chk_CheckTemp on ct_NoOfRunsID=rt_NoOfRunsID AND ct_NoOfRunsdate=rt_NoOfRunsdate AND ct_BusNumber=rt_BusCard AND ct_ReportDateTime=rt_ReportDateTime
		LEFT OUTER JOIN tms_bd_TicketMode ON tml_NoOfRunsID = rt_NoOfRunsID AND tml_NoOfRunsdate = rt_NoOfRunsdate
		LEFT OUTER JOIN tms_bd_PriceDetail ON rt_NoOfRunsID=pd_NoOfRunsID AND rt_NoOfRunsdate=pd_NoOfRunsdate 
		WHERE rt_AttemperStation  like '{$schStation}%'  AND pd_FromStation like '{$schStation}%' AND rt_BusCard LIKE '{$busnumber}%' AND rt_Allticket like '$state%'".$strdate.$strStatus." GROUP BY rt_NoOfRunsID,rt_NoOfRunsdate,rt_ReportDateTime ORDER BY rt_ReportDateTime";
	$resultselet = $class_mysql_default->my_query("$strsqlselet");
	if(!$resultselet) echo $class_mysql_default->my_error();
	while($rows = @mysqli_fetch_array($resultselet))	{
		$reportnum=$reportnum+1;
		if($rows['bht_BalanceNO']!='' || $rows['bh_BalanceNO']!=''){
			$allbalancenum=$allbalancenum+1;
		}
	if($rows['ct_Flag'] == '0'){
		if($rows['ct_Flag'] == '0' && $rows['tml_AllowSell']==0 && $rows['tml_StopRun']==0) $curStatus='暂停';
		elseif($rows['ct_Flag'] == '0' && $rows['tml_StopRun']==3){
			$curStatus='并班';
		}
		else{
		 $curStatus='在售';
		}
	}
	else{
		if($rows['ct_Flag'] == '1') $curStatus='检票'; 
		if($rows['ct_Flag'] == '2' || $rows['ct_Flag'] == '3') $curStatus='发班'; 
	}
	
?>
<tbody class="scrollContent"> 
	<tr align="center" bgcolor="#CCCCCC">
		<td nowrap="nowrap"><?php echo $rows['rt_BusCard']?></td>
		<td nowrap="nowrap"><?php echo $rows['rt_NoOfRunsID']?></td>
		<td nowrap="nowrap"><?php echo $rows['li_LineName']?></td>
		<td nowrap="nowrap"><?php echo $rows['rt_NoOfRunsdate']?></td>
		<td nowrap="nowrap"><?php echo $rows['rt_ReportDateTime']?></td>
		<td nowrap="nowrap"> <?php if($rows['rt_Allticket'] == 0) echo "否";else echo "是"?></td>
		<?php 
		if($curStatus == '暂停'){  //蓝色
		?>
		<td nowrap="nowrap"><span style="color:#0000FF"><?php echo $curStatus?></span></td>
		<?php 
		}
		if($curStatus == '在售'){  //绿色
		?>
		<td nowrap="nowrap"><span style="color:#009900"><?php echo $curStatus?></span></td>
		<?php 
		}
		if($curStatus == '发班'){  //红色
		?>
		<td nowrap="nowrap"><span style="color:#FF0000"><?php echo $curStatus?></span></td>
		<?php 
		}
		if($curStatus == '检票'){  //黄色
		?>
		<td nowrap="nowrap"><span style="color:#FFFF00"><?php echo $curStatus?></span></td>
		<?php 
		}
		if($curStatus == '并班'){  //紫色
		?>
		<td nowrap="nowrap"><span style="color:#6633FF"><?php echo $curStatus?></span></td>
		<?php 
		}
		?>

		<td nowrap="nowrap">
			<?php
				if ($rows['bht_BalanceNO']===''){
					$allSupTicketRen=$allSupTicketRen+$rows['bh_SupTicketRen'];
					echo $rows['bh_SupTicketRen'];
				}else{
					$allSupTicketRen=$allSupTicketRen+$rows['bht_SupTicketRen'];
					echo $rows['bht_SupTicketRen'];
				} 
			?>
		</td>
		<td nowrap="nowrap">
			<?php
				if ($rows['bht_BalanceNO']===''){
					$allPriceTotal=$allPriceTotal+$rows['bh_PriceTotal'];
					echo $rows['bh_PriceTotal'];
				}else{
					$allPriceTotal=$allPriceTotal+$rows['bht_PriceTotal'];
					echo $rows['bht_PriceTotal'];
				} 
			?>
		</td>
		<td nowrap="nowrap">
			<?php
				if ($rows['bht_BalanceNO']===''){
					$allbalance=$allbalance+$rows['bh_PriceTotal']-$rows['bh_ServiceFee']-$rows['bh_otherFee1']-$rows['bh_otherFee2']-($rows['bh_PriceTotal']-$rows['bh_ServiceFee'])*$rows['bh_otherFee3']-$rows['bh_otherFee4']-$rows['bh_otherFee5']-$rows['bh_otherFee6'];
					echo $rows['bh_PriceTotal']-$rows['bh_ServiceFee']-$rows['bh_otherFee1']-$rows['bh_otherFee2']-($rows['bh_PriceTotal']-$rows['bh_ServiceFee'])*$rows['bh_otherFee3']-$rows['bh_otherFee4']-$rows['bh_otherFee5']-$rows['bh_otherFee6'];
				}else{
					$allbalance=$allbalance+$rows['bht_PriceTotal']-$rows['bht_ServiceFee']-$rows['bht_otherFee1']-$rows['bht_otherFee2']-($rows['bht_PriceTotal']-$rows['bht_ServiceFee'])*$rows['bht_otherFee3']-$rows['bht_otherFee4']-$rows['bht_otherFee5']-$rows['bht_otherFee6'];
					echo $rows['bht_PriceTotal']-$rows['bht_ServiceFee']-$rows['bht_otherFee1']-$rows['bht_otherFee2']-($rows['bht_PriceTotal']-$rows['bht_ServiceFee'])*$rows['bht_otherFee3']-$rows['bht_otherFee4']-$rows['bht_otherFee5']-$rows['bht_otherFee6'];
				} 
			?>
		</td>
		<td nowrap="nowrap">
			<?php
				if ($rows['bht_BalanceNO']===''){
					echo $rows['bht_BalanceNO'];
				}else{
					echo $rows['bht_BalanceNO'];
				} 
			?>
		</td>
		 <td nowrap="nowrap"><?php echo $rows['rt_AttemperStation']?></td>  <!-- 调度车站 -->
		 <td nowrap="nowrap"><?php echo $rows['rt_AttemperStationID']?></td>  <!-- 调度站编号 -->
		 <td nowrap="nowrap"><?php echo $rows['rt_ReportUser']?></td>  <!-- 调度员 -->
		<td nowrap="nowrap"><?php echo $rows['rt_Remark']?></td>
	</tr>
	<?php
	}
}
?>
	<tr  bgcolor="#CCCCCC">
		<td nowrap="nowrap">总计</td>
		<td nowrap="nowrap" align="center"><?php echo $reportnum?></td>
		<td nowrap="nowrap"></td>
		<td nowrap="nowrap"></td>
		<td nowrap="nowrap"></td>
		<td nowrap="nowrap"></td>
		<td nowrap="nowrap"></td>
		<td nowrap="nowrap" align="center"><?php echo $allSupTicketRen?></td>
		<td nowrap="nowrap" align="center"><?php echo $allPriceTotal?></td>
		<td nowrap="nowrap" align="center"><?php echo $allbalance?></td>
		<td nowrap="nowrap" align="center"><?php echo $allbalancenum?></td>
		<td ></td>
		<td ></td>
		<td ></td>
		<td ></td>
		<td ></td>
	</tr>
	</tbody>
</table>
</div>
</form>
</body>
</html>
