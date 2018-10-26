<?php
/*
 * 车辆结算页面
 * 用车辆编号查询检票表，如果有结算单号，则表明此班次已打单，可以结算。
 * 不一定要打印结算单才能结算，如有需要可以补打结算单。
 * 代理费 =（营收金额-站务费）* 代理费比率（ct_otherFee3）
 * 或          =（营收金额-站务费-微机费-发班费）* 代理费比率（ct_otherFee3）
 * “代理费”更名为“劳务费”
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
if(isset($_POST['BalanceNo'])){
	$CheckBeginDate = $_POST['date1Value'];
	$CheckEndDate = $_POST['date2Value'];
	$BalanceStyle=$_POST['BalanceStyle'];
	$BusUnit=$_POST['BusUnit'];
	$busCard=$_POST['busCard'];
	$BalanceNo=$_POST['BalanceNo'];
	$select="SELECT bht_UserIDTemp,bht_UserTemp FROM tms_acct_BalanceInHandTemp WHERE bht_BalanceNO='{$BalanceNo}'";
	$query=$class_mysql_default->my_query("$select");
	if(!$query){
		echo "<script>alert( '查询结算数据失败！');history.back();</script>";
		exit();
	}
	$result=mysqli_fetch_array($query);
	if($result['bht_UserIDTemp']!=$userID){
		$update="UPDATE tms_acct_BalanceInHandTemp SET bht_UserIDTemp='{$userID}',bht_UserTemp='{$userName}' WHERE bht_BalanceNO='{$BalanceNo}'";
		$queryupdate=$class_mysql_default->my_query("$update");
		if(!$queryupdate){
			echo "<script>alert( '更新结算数据失败！');history.back();</script>";
			exit();
		}  
	}else{
		$update="UPDATE tms_acct_BalanceInHandTemp SET bht_UserIDTemp=NULL,bht_UserTemp=NULL WHERE bht_BalanceNO='{$BalanceNo}'";
		$queryupdate=$class_mysql_default->my_query("$update");
		if(!$queryupdate){
			echo "<script>alert( '更新结算数据失败！');history.back();</script>";
			exit();
		}  
	}
/*	if(mysqli_num_rows($query) == 1){
	//	$result=mysqli_fetch_array($query);
		echo $select;
		echo $result['bht_UserIDTemp'];
		echo $BalanceNo;
		echo $userID;
		if($result['bht_UserIDTemp']==$userID){
			echo 'ss';
			$update="UPDATE tms_acct_BalanceInHandTemp SET bht_UserIDTemp=NULL,bht_UserTemp=NULL WHERE bht_BalanceNO='{$BalanceNo}'";
			$queryupdate=$class_mysql_default->my_query("$update");
			if(!$queryupdate){
				echo "<script>alert( '更新结算数据失败！');history.back();</script>";
				exit();
			}  
		}else{
			echo 'st';
			$update="UPDATE tms_acct_BalanceInHandTemp SET bht_UserIDTemp='{$userID}',bht_UserTemp='{$userName}' WHERE bht_BalanceNO='{$BalanceNo}'";
			$queryupdate=$class_mysql_default->my_query("$update");
			if(!$queryupdate){
				echo "<script>alert( '更新结算数据失败！');history.back();</script>";
				exit();
			}  
		}
	} */
	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>车辆结算</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script>
		$(document).ready(function(){
			$("#table1").tablesorter();
		/*	$("#table1 tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
			$("#table1 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$("#table1 tr").click(function(){
				$("#table1 tr:not(this)").css("background-color","#CCCCCC");
				$("#table1 tr:not(this)").mouseover(function(){$(this).css("background-color","#F1E6C2");});
				$("#table1 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
				$(this).css("background-color","#FFCC00");
				$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
				$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
			}); */
		});
		$(document).ready(function(){
			$("#BalanceNo").focus();
			document.getElementById("BalanceNo").onkeydown = function (event){
				 var e = event || window.event || arguments.callee.caller.arguments[0];
		         if (e && e.keyCode == 13) {
			         if($("#BalanceNo").val()==''){
			        	 $("#BalanceNo").focus();
						 return;
				      }
		//		      if($("#allBalanceNO").val().indexOf($("#BalanceNo").val())<0){
		//			      alert('该车辆或单位无该结算单号！');
		//			      return;
		//			  }
		        	 jQuery.get(
		 					'tms_v1_accounting_dataProcess.php',
		 					{'op': 'balance', 'BalanceNo': $("#BalanceNo").val(),'BalanceStyle':$("#BalanceStyle").val(),'busCard':$("#busCard").val(),
			 					'BusUnit':$("#BusUnit").val(),'checkdate1':$("#checkdate1").val(),'checkdate2':$("#checkdate2").val(),'time': Math.random()},
		 					function(data){
		 					//	alert(data);
		 						var objData = eval('(' + data + ')');
		 						if(objData.retVal == "FAIL"){ 
		 							alert(objData.retString);
		 							document.getElementById("BalanceNo").value="";
		 						}
		 						else {
		 							document.form1.submit();
		 						}
		 				});
		         }
			};
			$("#Balance").click(function(){
				if(document.getElementById("BusIDs").value==''&&document.getElementById("BusID").value==''){
					alert('请选择结算单！');
					return false;
				} 
				document.form2.submit();
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
				document.getElementById("DisbusID1").style.display="";
				document.getElementById("DisBusUnit").style.display="none";
				document.getElementById("DisBusUnit1").style.display="none";
				document.getElementById("BusUnit").value="";
				
			}else {
				document.getElementById("DisBusUnit").style.display="";
				document.getElementById("DisBusUnit1").style.display="";
				document.getElementById("busCard").value="";
				document.getElementById("DisbusID").style.display="none";
				document.getElementById("DisbusID1").style.display="none";
			}
		}
		function checkInfo(){
			if(document.getElementById("BalanceStyle").value=='0'){
				if (document.form1.busCard.value == "") {
					alert('请输入车牌号！');
					document.form1.busID.focus();
					return false;
				}
			}else{
				if(document.getElementById("BusUnit").value==''){
					alert('请选择车属单位！');
					document.form1.BusUnit.focus();
					return false;
				}
			}
			document.form1.submit();
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
    			<td colspan="5" bgcolor="#f0f8ff"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 结算单查询</td>
  			</tr>
		</table>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结算单号：</span></td>
					<td><input type="text" id="BalanceNo" name="BalanceNo" />
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 请选择结算方式：</span></td>
					<td><select name="BalanceStyle" id="BalanceStyle" >
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
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF" id="DisbusID">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF" id="DisbusID1">
					<input  type="text" name="busCard" id="busCard"  value="<?php ($busCard == "" || $busCard == "%")? print "" : print $busCard;?>"/>
					<br/>
    				<select id="BusNumberselect" name="BusNumberselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF" id="DisBusUnit" style="DISPLAY: none">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位：</span>
				</td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF" id="DisBusUnit1" style="DISPLAY: none">
					<select name="BusUnit" id="BusUnit" >
						<option value="<?php echo $BusUnit;?>"><?php if($BusUnit=='') echo '请选择车属单位'; else echo $BusUnit; ?></option>
		      				<?php
		      					if($BusUnit!=''){
			      					echo "<option value=''>请选择车属单位</option>";
    								echo"<br>";	
		      					}
    							$select="SELECT bu_UnitName FROM tms_bd_BusUnit";
    							$sel =$class_mysql_default->my_query($select);
								while($results=mysqli_fetch_array($sel)){ 
									if($BusUnit!=$results['bu_UnitName']){
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
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					<span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开单时间：</span></td>
					<td nowrap="nowrap" colspan="2"> <input type="text" name="date1Value" id="checkdate1" size="12" class="Wdate" value="<?php ($CheckBeginDate == "")? print date('Y-m-d') : print $CheckBeginDate;?>"  name="checkdate1" onclick="WdatePicker({onpicked:function(dp){$dp.$('date1Value').value=dp.cal.getDateStr();}});" />&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;
					<input type="text" name="date2Value" id="checkdate2" size="12" class="Wdate" value="<?php ($CheckEndDate == "")? print date('Y-m-d') : print $CheckEndDate;?>" name="checkdate2" onclick="WdatePicker({onpicked:function(dp){$dp.$('date2Value').value=dp.cal.getDateStr();}});" />
				</td>
				<td colspan="3" nowrap="nowrap" align="left" bgcolor="#FFFFFF">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="resultquery" value="查询" onclick="return checkInfo();" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="Balance" name="Balance" value="结算"/>
				</td>
			</tr>
		</table>		
		</form>
		
		<form action="tms_v1_accounting_busorunitBalance.php" method="post" name="form2">
		<div id="tableContainer" class="tableContainer" style="margin-top:-20px;"> 
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
<!--  
				<th nowrap="nowrap" align="center" bgcolor="#006699">微机费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发班费</th>
-->
				<th nowrap="nowrap" align="center" bgcolor="#006699">劳务费</th>
<!--
				<th nowrap="nowrap" align="center" bgcolor="#006699">费用4</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">费用5</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">费用6</th>
  -->
				<th nowrap="nowrap" align="center" bgcolor="#006699">行包托运费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车属单位</th>
			</tr>
			</thead>
			<tbody class="scrollContent">
			<?php
		//		if(isset($_POST['BalanceNo'])) {
					$i=0;
					$j=0;
					$allBalanceNO='';
					$balanceBalanceNO='';
					$allCheckTotal=0;
					$allTicketTotal=0;
					$allPriceTotal=0;
					$allServiceFee=0;
					$allotherFee1=0;
					$allotherFee2=0;
					$allotherFee4=0;
					$allotherFee5=0;
					$allotherFee6=0;
					$BalanceMoney=0;
					$allBalanceMoney=0;
					$allConsignMoney=0;
					$balanceCheckTotal=0;
					$balanceTicketTotal=0;
					$balancePriceTotal=0;
					$balanceServiceFee=0;
					$balanceotherFee1=0;
					$balanceotherFee2=0;
					$balanceotherFee3=0;
					$balanceotherFee4=0;
					$balanceotherFee5=0;
					$balanceotherFee6=0;
					$balanceBalanceMoney=0;
					$balanceConsignMoney=0;
					$balanceBusID='';
					$balanceBusNumber='';
					$balanceBusType='';
					$balanceBusUnit='';
					$balanceBusIDs='';
				if($BalanceStyle=='0'){
					$select="SELECT bht_BalanceNO,bht_BusID,bht_BusNumber,bht_BusUnit,bht_BusModelID,bht_BusModel,bht_NoOfRunsID,bht_LineID,bht_NoOfRunsdate,bht_BeginStationTime,
						bht_StopStationTime,bht_BeginStationID,bht_BeginStation,bht_FromStationID,bht_FromStation,bht_EndStationID,bht_EndStation,bht_ServiceFee,bht_otherFee1,bht_otherFee2,
						bht_otherFee3,bht_otherFee4,bht_otherFee5,bht_otherFee6,bht_CheckTotal,bht_TicketTotal,bht_PriceTotal,bht_BalanceMoney,bht_SupTicketRen,bht_StationID,
						bht_Station,bht_UserID,bht_User,bht_Date,bht_Time,bht_State,bht_Type,bht_UserIDTemp,bht_ConsignMoney FROM tms_acct_BalanceInHandTemp
						WHERE bht_Date>='{$CheckBeginDate}' AND  bht_Date<='{$CheckEndDate}' AND bht_BusNumber='{$busCard}' AND bht_State='正常' AND bht_StationID='{$userStationID}' ";
				// LEFT OUTER JOIN tms_lug_LuggageCons ON lc_NoOfRunsID=bht_NoOfRunsID AND lc_BusID=bht_BusID AND lc_DeliveryDate=bht_NoOfRunsdate  	
				//	 GROUP BY bht_NoOfRunsID,bht_BusID,bht_NoOfRunsdate 
				//	,IFNULL(SUM(lc_ConsignMoney),0)
				}else{
					$select="SELECT bht_BalanceNO,bht_BusID,bht_BusNumber,bht_BusUnit,bht_BusModelID,bht_BusModel,bht_NoOfRunsID,bht_LineID,bht_NoOfRunsdate,bht_BeginStationTime,
						bht_StopStationTime,bht_BeginStationID,bht_BeginStation,bht_FromStationID,bht_FromStation,bht_EndStationID,bht_EndStation,bht_ServiceFee,bht_otherFee1,bht_otherFee2,
						bht_otherFee3,bht_otherFee4,bht_otherFee5,bht_otherFee6,bht_CheckTotal,bht_TicketTotal,bht_PriceTotal,bht_BalanceMoney,bht_SupTicketRen,bht_StationID,
						bht_Station,bht_UserID,bht_User,bht_Date,bht_Time,bht_State,bht_Type,bht_UserIDTemp,bht_ConsignMoney FROM tms_acct_BalanceInHandTemp 
						WHERE bht_Date>='{$CheckBeginDate}' AND  bht_Date<='{$CheckEndDate}' AND bht_BusUnit='{$BusUnit}' AND bht_State='正常' AND bht_StationID='{$userStationID}' ";
				}
					$query=$class_mysql_default->my_query("$select");
					while($row=mysqli_fetch_array($query)){
						$i=$i+1;
					/*	$selectLuggageCons="SELECT IFNULL(SUM(lc_ConsignMoney),0) AS sumConsignMoney FROM tms_lug_LuggageCons WHERE lc_NoOfRunsID='{$row['bht_NoOfRunsID']}' AND 
							lc_BusNumber='{$row['bht_BusNumber']}' AND lc_DeliveryDate='{$row['bht_NoOfRunsdate']}' GROUP BY lc_NoOfRunsID,lc_BusNumber,lc_DeliveryDate";
						$queryLuggageCons=$class_mysql_default->my_query("$selectLuggageCons");
						$rowLuggageCons=mysqli_fetch_array($queryLuggageCons);
						if($rowLuggageCons['sumConsignMoney']=='') $rowLuggageCons['sumConsignMoney']=0;
						$allConsignMoney=$allConsignMoney+$rowLuggageCons['sumConsignMoney'];  */
						if($row['bht_ConsignMoney']=='') $row['bht_ConsignMoney']=0;
						$allConsignMoney=$allConsignMoney+$row['bht_ConsignMoney'];
						if($allBalanceNO==''){
							$allBalanceNO=$allBalanceNO.$row['bht_BalanceNO'];
						}else{
							$allBalanceNO=$allBalanceNO.';'.$row['bht_BalanceNO'];
						}
						$allCheckTotal=$allCheckTotal+$row['bht_CheckTotal'];
						$allTicketTotal=$allTicketTotal+$row['bht_TicketTotal'];
						$allPriceTotal=$allPriceTotal+$row['bht_PriceTotal'];
						$allServiceFee=$allServiceFee+$row['bht_ServiceFee'];
						$allotherFee1=$allotherFee1+$row['bht_otherFee1'];
						$allotherFee2=$allotherFee2+$row['bht_otherFee2'];
						$allotherFee4=$allotherFee4+$row['bht_otherFee4'];
						$allotherFee5=$allotherFee5+$row['bht_otherFee5'];
						$allotherFee6=$allotherFee6+$row['bht_otherFee6'];
						$allotherFee3=$allotherFee3+($row['bht_PriceTotal'] - $row['bht_ServiceFee']) * $row['bht_otherFee3'];
					//	$BalanceMoney=$row['bht_PriceTotal'] - $row['bht_ServiceFee'] - $row['bht_otherFee1'] - $row['bht_otherFee2']
					//		- ($row['bht_PriceTotal'] - $row['bht_ServiceFee']) * $row['bht_otherFee3'] - $row['bht_otherFee4'] - $row['bht_otherFee5'] - $row['bht_otherFee6'];
						$allBalanceMoney=$allBalanceMoney+$row['bht_BalanceMoney'];
						if($row['bht_UserIDTemp']==$userID){
							if($balanceBalanceNO==''){
								$balanceBalanceNO=$balanceBalanceNO.$row['bht_BalanceNO'];
							}else{
								$balanceBalanceNO=$balanceBalanceNO.';'.$row['bht_BalanceNO'];
							}
							$j=$j+1;
							$balanceCheckTotal=$balanceCheckTotal+$row['bht_CheckTotal'];
							$balanceTicketTotal=$balanceTicketTotal+$row['bht_TicketTotal'];
							$balancePriceTotal=$balancePriceTotal+$row['bht_PriceTotal'];
							$balanceServiceFee=$balanceServiceFee+$row['bht_ServiceFee'];
							$balanceotherFee1=$balanceotherFee1+$row['bht_otherFee1'];
							$balanceotherFee2=$balanceotherFee2+$row['bht_otherFee2'];
							$balanceotherFee3=$balanceotherFee3+($row['bht_PriceTotal'] - $row['bht_ServiceFee']) * $row['bht_otherFee3'];
							$balanceotherFee4=$balanceotherFee4+$row['bht_otherFee4'];
							$balanceotherFee5=$balanceotherFee5+$row['bht_otherFee5'];
							$balanceotherFee6=$balanceotherFee6+$row['bht_otherFee6'];
							$balanceBalanceMoney=$balanceBalanceMoney+$row['bht_BalanceMoney'];
							$balanceBusUnit=$row['bht_BusUnit'];
							$balanceConsignMoney=$balanceConsignMoney+$row['bht_ConsignMoney'];
							if($BalanceStyle=='0'){
								$balanceBusID=$row['bht_BusID'];
								$balanceBusNumber=$row['bht_BusNumber'];
								$balanceBusType=$row['bht_BusModel'];
							}else{
								if($balanceBusIDs==''){
									$balanceBusIDs=$balanceBusIDs.$row['bht_BusID'];
								}else{
									if(!strstr($balanceBusIDs,$row['bht_BusID'])){
										$balanceBusIDs=$balanceBusIDs.';'.$row['bht_BusID'];
									}
								}
							}
						}
						
			?>
			<tr <?php if($row['bht_UserIDTemp']==$userID) echo "bgcolor='#F1E6C2'"; else echo "bgcolor='#CCCCCC'";?>>
				<td nowrap="nowrap"><?php echo $row['bht_BalanceNO'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_BusID'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_BusNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_UserID'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_User'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_StationID'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_Station'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_Date']." ".$row['bht_Time'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_NoOfRunsID'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_LineID'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_NoOfRunsdate'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_BeginStation'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_EndStation'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_CheckTotal'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_TicketTotal'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_PriceTotal'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_BalanceMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_ServiceFee'];?></td>
<!--  
				<td nowrap="nowrap"><?php echo $row['bht_otherFee1'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_otherFee2'];?></td>
-->
				<td nowrap="nowrap"><?php echo ($row['bht_PriceTotal'] - $row['bht_ServiceFee']) * $row['bht_otherFee3'];?></td>
<!--  
				<td nowrap="nowrap"><?php echo $row['bht_otherFee4'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_otherFee5'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_otherFee6'];?></td>
-->
				<td nowrap="nowrap"><?php echo $row['bht_ConsignMoney'];?></td>
				<td nowrap="nowrap"><?php echo $row['bht_BusUnit'];?></td>
			</tr>
			<?php
					}
		//		}
			?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap">总计</td>
				<td nowrap="nowrap"><?php echo $i;?></td>
				<td nowrap="nowrap"></td>
				<td nowrap="nowrap"></td>
				<td nowrap="nowrap"></td>
				<td nowrap="nowrap"></td>
				<td nowrap="nowrap"></td>
				<td nowrap="nowrap"></td>
				<td nowrap="nowrap"></td>
				<td nowrap="nowrap"></td>
				<td nowrap="nowrap"></td>
				<td nowrap="nowrap"></td>
				<td nowrap="nowrap"></td>
				<td nowrap="nowrap"><?php echo $allCheckTotal;?></td>
				<td nowrap="nowrap"><?php echo $allTicketTotal;?></td>
				<td nowrap="nowrap"><?php echo $allPriceTotal;?></td>
				<td nowrap="nowrap"><?php echo $allBalanceMoney;?></td>
				<td nowrap="nowrap"><?php echo $allServiceFee;?></td>
<!--  
				<td nowrap="nowrap"><?php echo $allotherFee1;?></td>
				<td nowrap="nowrap"><?php echo $allotherFee2;?></td>
-->
				<td nowrap="nowrap"><?php echo $allotherFee3;?></td>
<!--  
				<td nowrap="nowrap"><?php echo $allotherFee4;?></td>
				<td nowrap="nowrap"><?php echo $allotherFee5;?></td>
				<td nowrap="nowrap"><?php echo $allotherFee6;?></td>
-->
				<td nowrap="nowrap"><?php echo $allConsignMoney;?></td>
				<td nowrap="nowrap"></td>
			</tr>
			</tbody>
		</table>
		</div>
			<input type="hidden"  name="num" id="num" value="<?php echo $i;?>"/>
			<input type="hidden"  name="BusID" id="BusID" value="<?php if($BalanceStyle=='0') echo $balanceBusID;?>"/>
			<input type="hidden"  name="BusIDs" id="BusIDs" value="<?php if($BalanceStyle!='0') echo $balanceBusIDs;?>"/>
			<input type="hidden"  name="BusNumber" id="BusNumber" value="<?php if($BalanceStyle=='0') echo $balanceBusNumber;?>"/>
			<input type="hidden"  name="BusType" id="BusType" value="<?php if($BalanceStyle=='0') echo $balanceBusType;?>"/>
			<input type="hidden"  name="BusUnit" id="BusUnit" value="<?php echo $balanceBusUnit;?>"/>
			<input type="hidden"  name="allBalanceNO" id="allBalanceNO" value="<?php echo $allBalanceNO;?>"/>
			<input type="hidden"  name="allCheckTotal" id="allCheckTotal" value="<?php echo $allCheckTotal;?>"/>
			<input type="hidden"  name="allTicketTotal" id="allTicketTotal" value="<?php echo $allTicketTotal;?>"/>
			<input type="hidden"  name="allPriceTotal" id="allPriceTotal" value="<?php echo $allPriceTotal;?>"/>
			<input type="hidden"  name="allBalanceMoney" id="allBalanceMoney" value="<?php echo $allBalanceMoney;?>"/>
			<input type="hidden"  name="allServiceFee" id="allServiceFee" value="<?php echo $allServiceFee;?>"/>
			<input type="hidden"  name="allotherFee1" id="allotherFee1" value="<?php echo $allotherFee1;?>"/>
			<input type="hidden"  name="allotherFee2" id="allotherFee2" value="<?php echo $allotherFee2;?>"/>
			<input type="hidden"  name="allotherFee3" id="allotherFee3" value="<?php echo $allotherFee3;?>"/>
			<input type="hidden"  name="allotherFee4" id="allotherFee4" value="<?php echo $allotherFee4;?>"/>
			<input type="hidden"  name="allotherFee5" id="allotherFee5" value="<?php echo $allotherFee5;?>"/>
			<input type="hidden"  name="allotherFee6" id="allotherFee6" value="<?php echo $allotherFee6;?>"/>
			<input type="hidden"  name="allConsignMoney" id="allConsignMoney" value="<?php echo $allConsignMoney;?>"/>
			<input type="hidden"  name="balancenum" id="balancenum" value="<?php echo $j;?>"/>
			<input type="hidden"  name="BalanceStyle" id="BalanceStyle" value="<?php echo $BalanceStyle;?>"/>
			<input type="hidden"  name="balanceBalanceNO" id="balanceBalanceNO" value="<?php echo $balanceBalanceNO;?>"/>
			<input type="hidden"  name="balanceCheckTotal" id="balanceCheckTotal" value="<?php echo $balanceCheckTotal;?>"/>
			<input type="hidden"  name="balanceTicketTotal" id="balanceTicketTotal" value="<?php echo $balanceTicketTotal;?>"/>
			<input type="hidden"  name="balancePriceTotal" id="balancePriceTotal" value="<?php echo $balancePriceTotal;?>"/>
			<input type="hidden"  name="balanceBalanceMoney" id="balanceBalanceMoney" value="<?php echo $balanceBalanceMoney;?>"/>
			<input type="hidden"  name="balanceServiceFee" id="balanceServiceFee" value="<?php echo $balanceServiceFee;?>"/>
			<input type="hidden"  name="balanceotherFee1" id="balanceotherFee1" value="<?php echo $balanceotherFee1;?>"/>
			<input type="hidden"  name="balanceotherFee2" id="balanceotherFee2" value="<?php echo $balanceotherFee2;?>"/>
			<input type="hidden"  name="balanceotherFee3" id="balanceotherFee3" value="<?php echo $balanceotherFee3;?>"/>
			<input type="hidden"  name="balanceotherFee4" id="balanceotherFee4" value="<?php echo $balanceotherFee4;?>"/>
			<input type="hidden"  name="balanceotherFee5" id="balanceotherFee5" value="<?php echo $balanceotherFee5;?>"/>
			<input type="hidden"  name="balanceotherFee6" id="balanceotherFee6" value="<?php echo $balanceotherFee6;?>"/>
			<input type="hidden"  name="balanceConsignMoney" id="balanceConsignMoney" value="<?php echo $balanceConsignMoney;?>"/>
			<input type="hidden"  name="begindate" id="begindate" value="<?php echo $CheckBeginDate;?>"/>
			<input type="hidden"  name="enddate" id="enddate" value="<?php echo $CheckEndDate;?>"/>
		</form>
	</body>
</html>
