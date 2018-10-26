<?php
/*
 * 结算查询页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$ba_BusUnit = "";
$CheckBeginDate = "";
$CheckEndDate = "";
$ba_BusNumber = "";
$ba_AccountID = "";
if(isset($_POST['whichButton'])) {
	$CheckBeginDate = $_POST['date1Value'];
	$CheckEndDate = $_POST['date2Value'];
	$CheckBeginDatetime = $_POST['date1Value'] . " 00:00:00";
	$CheckEndDatetime = $_POST['date2Value'] . " 23:59:59";
	$ba_BusNumber = $_POST['busCard'];
	$ba_BusUnit = $_POST['BusUnit'];
	$ba_AccountID = $_POST['accountID'];
	
	if($ba_BusNumber == "")
//		$queryString = "SELECT * FROM tms_acct_BusAccount LEFT OUTER JOIN tms_acct_BusRate ON ba_BusNumber = br_BusNumber WHERE (ba_DateTime >= '{$CheckBeginDatetime}') AND (ba_DateTime <= '{$CheckEndDatetime}') 
//			AND (ba_BusNumber IS NULL or ba_BusNumber LIKE '{$ba_BusNumber}%') AND (ba_BusUnit LIKE '{$ba_BusUnit}%') AND (ba_AccountID LIKE '{$ba_AccountID}%') 
//			ORDER BY ba_AccountID ASC";
		$queryString = "SELECT * FROM tms_acct_BusAccount WHERE (ba_DateTime >= '{$CheckBeginDatetime}') AND (ba_DateTime <= '{$CheckEndDatetime}') 
			AND (ba_BusNumber IS NULL or ba_BusNumber LIKE '{$ba_BusNumber}%') AND (ba_BusUnit LIKE '{$ba_BusUnit}%') AND (ba_AccountID LIKE '{$ba_AccountID}%') 
			ORDER BY ba_AccountID ASC";
	else
//		$queryString = "SELECT * FROM tms_acct_BusAccount LEFT OUTER JOIN tms_acct_BusRate ON ba_BusNumber = br_BusNumber WHERE (ba_DateTime >= '{$CheckBeginDatetime}') AND (ba_DateTime <= '{$CheckEndDatetime}') 
//			AND (ba_BusNumber LIKE '{$ba_BusNumber}%') AND (ba_BusUnit LIKE '{$ba_BusUnit}%') AND (ba_AccountID LIKE '{$ba_AccountID}%') 
//			ORDER BY ba_AccountID ASC";
		$queryString = "SELECT * FROM tms_acct_BusAccount WHERE (ba_DateTime >= '{$CheckBeginDatetime}') AND (ba_DateTime <= '{$CheckEndDatetime}') 
			AND (ba_BusNumber LIKE '{$ba_BusNumber}%') AND (ba_BusUnit LIKE '{$ba_BusUnit}%') AND (ba_AccountID LIKE '{$ba_AccountID}%') 
			ORDER BY ba_AccountID ASC";
	
	if($_POST['whichButton'] == "exceldoc") {
//		global $FeeTypeName;
	  	global $FeeTypeNum;
    	$FeeTypeNum=11;
    	global $ii;
    	$ii=0;
		$file_name = "info.csv";
		header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Cache-Control: no-cache, must-revalidate");
		
		$fp = fopen('php://output', 'w');
		$out = array('', '', '', '', '', '', '', '', '', '', '车辆结账信息表', '', '', '', '', '', '', '', '', '', '','');
		fputcsv($fp, $out);
		$qrydate = "日期:" . "$CheckBeginDate" . "至" . "$CheckEndDate";
		$out = array($qrydate, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '','');
		fputcsv($fp, $out);
//		$head = array('结账单号', '车辆编号', '车牌号', '车型', '车属单位', '结算单数', '人数', '营收金额', '结算金额', '站务费', '劳务费', '行包托运费');
//		$selected="SELECT ft_FeeTypeName,ft_FeeTypeComputer FROM tms_bd_FeeType";
//		$queryed=$class_mysql_default->my_query($selected);
//		while($rowed=mysqli_fetch_array($queryed)){
//	 		$FeeTypeName1=$rowed['ft_FeeTypeName'];
//    		$FeeTypeNum=$FeeTypeNum+1;
//    		$ii = $ii+1;
//    		$head[$FeeTypeNum] = $FeeTypeName1;
//		}
//			$head[$FeeTypeNum+1] = '结算时间';
//			$head[$FeeTypeNum+2] = '结算员ID';
//			$head[$FeeTypeNum+3] = '结算员';
//			$head[$FeeTypeNum+4] = '备注';
		$head = array('结账单号', '车辆编号', '车牌号', '车型', '车属单位', '结算单数', '人数', '营收金额', '结算金额', '站务费', '劳务费', '行包托运费','按月扣除费用总和','结算时间','结算员ID','结算员','备注');
		fputcsv($fp, $head);
		$cnt = 0; 
		$limit = 100000; 
		$outputRow = "";
		$result = $class_mysql_default->my_query("$queryString");
		while ($row = mysqli_fetch_array($result)) {
			$cnt++; 
//			global $jj;
//		  	global $rate;
//		  	$rate = 11;
			$ba_rate=0;
			for($j=1;$j<=15;$j++){ 
				$ba_rate=$ba_rate+$row['ba_Rate'.$j];
			}
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
			} 
			$outputRow = array($row['ba_AccountID'], $row['ba_BusID'], $row['ba_BusNumber'], $row['ba_BusType'], $row['ba_BusUnit'], 
				$row['ba_BalanceCount'], $row['ba_CheckTotal'], $row['ba_Income'], $row['ba_Paid'], $row['ba_ServiceFee'], $row['ba_OtherFee3'], $row['ba_Money1'],
				$ba_rate,$row['ba_DateTime'],$row['ba_UserID'],$row['ba_User'],$row['ba_Remark']);
//			for($jj=1;$jj<=$ii;$jj++){
//	               $rate1=$row['ba_Rate'.$jj];
//	               $rate=$rate+1;
//	               $outputRow[$rate]=$rate1;
//			}
//				$outputRow[$rate+1]=$row['ba_DateTime'];
//				$outputRow[$rate+2]=$row['ba_UserID'];
//				$outputRow[$rate+3]=$row['ba_User'];
//				$outputRow[$rate+4]=$row['ba_Remark'];
		/*	$outputRow = array($row['ba_AccountID'], $row['ba_BusID'], $row['ba_BusNumber'], $row['ba_BusType'], $row['ba_BusUnit'], 
				$row['ba_BalanceCount'], $row['ba_CheckTotal'], $row['ba_Income'], $row['ba_Paid'], $row['ba_ServiceFee'], 
				$row['ba_OtherFee3'], $row['ba_DateTime'], 
				$row['ba_UserID'], $row['ba_User'], $row['ba_Remark']); */
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
		<title>结算查询</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet"></link>
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script>
		$(document).ready(function(){
			$("#table1").tablesorter();
				});
		$(document).ready(function(){
			$("#busCard").focus();
			$("#table1 tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
			$("#table1 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$("#table1 tr").click(function(){
				$("#table1 tr:not(this)").css("background-color","#CCCCCC");
				$("#table1 tr:not(this)").mouseover(function(){$(this).css("background-color","#F1E6C2");});
				$("#table1 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
				$(this).css("background-color","#FFCC00");
				$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
				$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
				$("#ba_AccountID").val($(this).children().eq(0).text());
				$("#ba_BusID").val($(this).children().eq(1).text());
				$("#ba_BusNumber").val($(this).children().eq(2).text());
				$("#ba_BusType").val($(this).children().eq(3).text());
				$("#ba_BusUnit").val($(this).children().eq(4).text());
				$("#ba_BalanceCount").val($(this).children().eq(5).text());
				$("#ba_CheckTotal").val($(this).children().eq(6).text());
				$("#ba_Income").val($(this).children().eq(7).text());
				$("#ba_Paid").val($(this).children().eq(8).text());
				$("#ba_ServiceFee").val($(this).children().eq(9).text());
//				$("#ba_OtherFee1").val($(this).children().eq(10).text());
//				$("#ba_OtherFee2").val($(this).children().eq(11).text());
				$("#ba_OtherFee3").val($(this).children().eq(10).text());
				$("#ba_Money1").val($(this).children().eq(11).text());
//				$("#ba_OtherFee4").val($(this).children().eq(13).text());
//				$("#ba_OtherFee5").val($(this).children().eq(14).text());
//				$("#ba_OtherFee6").val($(this).children().eq(15).text());
//				for(var num=1;num<=document.getElementById("ba_RateNum").value;num++){
//					document.getElementById("ba_Rate"+num).value=$(this).children().eq(11*1+num*1).text();
//					}
				$("#ba_DateTime").val($(this).children().eq(13).text());
				$("#ba_UserID").val($(this).children().eq(14).text());
				$("#ba_User").val($(this).children().eq(15).text());
				$("#ba_Remark").val($(this).children().eq(16).text());
			});
		
			$("#busCard").keyup(function(){
				$("#BusNumberselect").empty();
				document.getElementById("BusNumberselect").style.display=""; 
				var BusNumber = $("#busCard").val();
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
				document.getElementById("busCard").value=document.getElementById("BusNumberselect").value;
				document.getElementById("BusNumberselect").style.display="none";
			};
			document.getElementById("busCard").onkeydown = function (event) {
	            var e = event || window.event || arguments.callee.caller.arguments[0];
	            if (e && e.keyCode == 13) {
	           		document.getElementById("BusNumberselect").focus();
	           		$("#BusNumberselect option:eq(0)").attr({selected:"selected"});
	            } 
			};
			document.getElementById("BusNumberselect").onkeydown = function (event) {
	            var e = event || window.event || arguments.callee.caller.arguments[0];
	            if (e && e.keyCode == 13) {
	            	document.getElementById("busCard").value=document.getElementById("BusNumberselect").value;
					document.getElementById("BusNumberselect").style.display="none";
	            } 
			};
			$("#resultquery").click(function(){
				if (document.form1.busCard.value == "" && document.form1.BusUnit.value == "" && document.form1.accountID.value == "") {
					if(!confirm("您未输入车辆卡号或车属单位或结账单号，查询所有记录可能花费较长时间，确认继续?")) {
						$("#busCard").focus();
						return false;
					}
				}
				$("#whichButton").val("resultquery");					
				document.form1.submit();
			});
			$("#exceldoc").click(function(){
				if (document.form1.busCard.value == "" && document.form1.BusUnit.value == "" && document.form1.accountID.value == "") {
					if(!confirm("您未输入车辆卡号或车属单位或结账单号，查询所有记录可能花费较长时间，确认继续?")) {
						$("#busCard").focus();
						return false;
					}
				}
				$("#whichButton").val("exceldoc");					
				document.form1.submit();
			});
		});

		function detail(){
			if (!document.getElementById("ba_AccountID").value){
				alert('请选择结账单！');
				return false;
			}
			document.form2.submit();
		}
		</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 结 算 查 询</span></td>
			</tr>
		</table>

		<form action="" method="post" name="form1">
<!--		<table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">-->
<!--  			<tr>-->
<!--    			<td colspan="5" bgcolor="#f0f8ff"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 结 账 单 查 询</td>-->
<!--  			</tr>-->
<!--		</table>-->
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结账单号：</span></td>
				<td nowrap="nowrap">
					<input type="text" id="accountID" name="accountID" value="<?php ($ba_AccountID == "" || $ba_AccountID == "%")? print "" : print $ba_AccountID;?>" />
				</td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
				<td nowrap="nowrap">
					<input  type="text" name="busCard" id="busCard"  value="<?php ($ba_BusNumber == "" || $ba_BusNumber == "%")? print "" : print $ba_BusNumber?>"/>
					<br/>
    				<select id="BusNumberselect" name="BusNumberselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF" nowrap="nowrap">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位：</span></td>
					<td nowrap="nowrap"><select name="BusUnit" id="BusUnit" >
						<option value="<?php echo $ba_BusUnit;?>"><?php if($ba_BusUnit=='') echo '请选择车属单位'; else echo $ba_BusUnit; ?></option>
		      				<?php
		      					if($ba_BusUnit!=''){
			      					echo "<option value=''>请选择车属单位</option>";
    								echo"<br>";	
		      					}
    							$select="SELECT bu_UnitName FROM tms_bd_BusUnit";
    							$sel =$class_mysql_default->my_query($select);
								while($results=mysqli_fetch_array($sel)){ 
									if($ba_BusUnit!=$results['bu_UnitName']){
    						?>
    					<option value="<?php echo $results['bu_UnitName'];?>"><?php echo $results['bu_UnitName'];?></option>
    						<?php
									} 
								}
    						?>
		     	 	</select>
				</td>
			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 日期：</span></td>
				<td nowrap="nowrap" colspan="2"> 
					<input type="text" id="checkdate1" size="12" class="Wdate" value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>"  name="checkdate1" onclick="WdatePicker({onpicked:function(dp){$dp.$('date1Value').value=dp.cal.getDateStr();}});" />&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;
					<input type="text" id="checkdate2" size="12" class="Wdate" value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="checkdate2" onclick="WdatePicker({onpicked:function(dp){$dp.$('date2Value').value=dp.cal.getDateStr();}});" />
				</td>
				<td colspan="4" bgcolor="#FFFFFF" nowrap="nowrap">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="resultquery" id="resultquery" value="结账单查询" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="accountdetail" id="accountdetail" value="结账单明细" onclick="return detail();" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="exceldoc" id="exceldoc" value="导出Excel" />
					<input type="hidden" id="date1Value" value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>" name="date1Value" />
					<input type="hidden" id="date2Value" value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="date2Value" />
					<input type="hidden" name="whichButton" id="whichButton" value="" />
				</td>
			</tr>
		</table>
		</form>
		
		<form action="tms_v1_accounting_accountDetail.php" method="post" name="form2">
		<div id="tableContainer" class="tableContainer" style="margin-top:-20px;"> 
		<table class="main_tableboder" id="table1" > 
		<thead class="fixedHeader">
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结账单号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车型</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车属单位</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算单数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">人数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">营收金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">站务费</th>
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">微机费</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">发班费</th>-->
				<th nowrap="nowrap" align="center" bgcolor="#006699">劳务费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">行包托运费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">按月扣除费用总和</th>
<!--
				<?php 
    			$i=0;
				$selected="SELECT ft_FeeTypeName,ft_FeeTypeComputer FROM tms_bd_FeeType";
				$queryed=$class_mysql_default->my_query($selected);
				while($rowed=mysqli_fetch_array($queryed)){
				?>
    			<th nowrap="nowrap" align="center" bgcolor="#006699"><?php echo $rowed['ft_FeeTypeName'];?></th>
   		 		<?php 
    				$i=$i+1;
				}
    			?>
					<th nowrap="nowrap" align="center" bgcolor="#006699">费用4</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">费用5</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">费用6</th>-->
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
			</tr>
			</thead>
			<tbody class="scrollContent">
			<?php
				if(isset($_POST['whichButton']) && $_POST['whichButton'] == "resultquery") {
					$result = $class_mysql_default->my_query("$queryString");
					while ($row = mysqli_fetch_array($result)) {
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row['ba_AccountID'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_BusID'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_BusNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_BusType'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_BusUnit'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_BalanceCount'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_CheckTotal'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_Income'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_Paid'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_ServiceFee'];?></td>
				<!--
				<td nowrap="nowrap"><?php echo $row['ba_OtherFee1'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_OtherFee2'];?></td>
				-->
				<td nowrap="nowrap"><?php echo $row['ba_OtherFee3'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_Money1'];?></td>
				<!--
				<td nowrap="nowrap"><?php echo $row['ba_OtherFee4'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_OtherFee5'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_OtherFee6'];?></td>
				-->
				<?php
					$ba_rate=0;
					for($j=1;$j<=15;$j++){ 
						$ba_rate=$ba_rate+$row['ba_Rate'.$j];
					}
				?>
				<td nowrap="nowrap"><?php echo $ba_rate;?></td>
				<td nowrap="nowrap"><?php echo $row['ba_DateTime'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_UserID'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_User'];?></td>
				<td nowrap="nowrap"><?php echo $row['ba_Remark'];?></td>
			</tr>
			<?php
					}
				}
			?>
			<tr>
				<td style="border:0px;">
					<input type="hidden" id="ba_AccountID" value="" name="ba_AccountID" />
					<input type="hidden" id="ba_BusID" value="" name="ba_BusID" />
					<input type="hidden" id="ba_BusNumber" value="" name="ba_BusNumber" />
					<input type="hidden" id="ba_BusType" value="" name="ba_BusType" />
					<input type="hidden" id="ba_BusUnit" value="" name="ba_BusUnit" />
					<input type="hidden" id="ba_BalanceCount" value="" name="ba_BalanceCount" />
					<input type="hidden" id="ba_CheckTotal" value="" name="ba_CheckTotal" />
					<input type="hidden" id="ba_Income" value="" name="ba_Income" />
					<input type="hidden" id="ba_Paid" value="" name="ba_Paid" />
					<input type="hidden" id="ba_ServiceFee" value="" name="ba_ServiceFee" />
<!--					<input type="hidden" id="ba_OtherFee1" value="" name="ba_OtherFee1" />-->
<!--					<input type="hidden" id="ba_OtherFee2" value="" name="ba_OtherFee2" />-->
					<input type="hidden" id="ba_RateNum" value="<?php echo $i;?>" name="ba_RateNum" />
					<input type="hidden" id="ba_OtherFee3" value="" name="ba_OtherFee3" />
					<input type="hidden" id="ba_Money1" value="" name="ba_Money1" /><!--
					<?php
						for($j=1;$j<=$i;$j++){ 
					?>
							<input type="hidden" id="ba_Rate<?php echo $j;?>" value="" name="ba_Rate<?php echo $j;?>" />
					<?php 
						}
					?>
--><!--					<input type="hidden" id="ba_OtherFee4" value="" name="ba_OtherFee4" />-->
<!--					<input type="hidden" id="ba_OtherFee5" value="" name="ba_OtherFee5" />-->
<!--					<input type="hidden" id="ba_OtherFee6" value="" name="ba_OtherFee6" />-->
					<input type="hidden" id="ba_DateTime" value="" name="ba_DateTime" />
					<input type="hidden" id="ba_UserID" value="" name="ba_UserID" />
					<input type="hidden" id="ba_User" value="" name="ba_User" />
					<input type="hidden" id="ba_Remark" value="" name="ba_Remark" />
				</td>
			</tr>
			</tbody>
		</table>
		</div>
		</form>
	</body>
</html>
