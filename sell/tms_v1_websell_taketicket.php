<?php

//取票界面

define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>取票界面</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<object id="CardReader1" codebase="FirstActivex.cab#version=1,0,3,1" classid="CLSID:F225795B-A882-4FBA-934C-805E1B2FBD1B">
		<param name="_Version" value="65536"/>
		<param name="_ExtentX" value="2646"/>
		<param name="_ExtentY" value="1323"/>
		<param name="_StockProps" value="0"/>
		<param name="port" value="USB"/>
		<param name="PhotoPath" value=""/>
		<param name="ActivityLFrom" value=""/>
		<param name="ActivityLTo" value="" />
	</object>
	<link href="../css/tms.css" rel="stylesheet" type="text/css" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript">
	function checkInfo()
	{
		if(document.getElementById("WebSellID").value=="" && document.getElementById("CertificateNumber").value==""){
			alert('请输入订单号或证件号码');
			$("#WebSellID").focus();
		}
		else
        	document.form1.submit();
	}
	function Init()
	{
		var obj = document.getElementById("CardReader1");
	//设置端口号，1表示串口1，2表示串口2，依此类推；1001表示USB，依此类推。
		obj.setPortNum(1001);
	}
	function readCard()
	{
		document.getElementById("CertificateNumber").focus();
 		var obj = document.getElementById("CardReader1");
	//读卡
		var rst = obj.ReadCard();
	//获取各项信息
		document.getElementById("CertificateNumber").value  = obj.CardNo();
		document.getElementById("CertificateUser").value  = obj.NameL();
		document.getElementById("CertificateUserAddress").value = obj.Address();
		checkInfo();
	}

	$(document).ready(function(){
		Init();
		$("#table1").tablesorter();
		$("#table1 tbody tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
		$("#table1 tbody tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
		$("#table1 tbody tr").click(function(){
			$("#table1 tbody tr:not(this)").css("background-color","#CCCCCC");
			$("#table1 tbody tr:not(this)").mouseover(function(){$(this).css("background-color","#F1E6C2");});
			$("#table1 tbody tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
			$(this).css("background-color","#F1E6C2");
			$(this).mouseout(function(){$(this).css("background-color","#CCCCCC");});
		});
		
		if($("#table1 tr:gt(0)").length == 0){
			$("#WebSellID").focus();
		}
		else{
			$("#table1 tr:eq(1)").focus();
			$("#table1 tr:eq(1)").css("background-color","#F1E6C2");
		}

		$("#WebSellID").keydown(function(){
		   	document.onkeydown = function (event) {
		  		var e = event || window.event || arguments.callee.caller.arguments[0];
		     	if (e && e.keyCode == 13)	
			     	checkInfo();
		   	};
		});
		
		$("#CertificateNumber").keydown(function(){
		   	document.onkeydown = function (event) {
		  		var e = event || window.event || arguments.callee.caller.arguments[0];
		     	if (e && e.keyCode == 13)	
			     	checkInfo();
		   	};
		});

		$("#resultquery").click(function(){
        	checkInfo();
		});
		
		var currentStep = 1;
		var max_line_num = $("#table1 tbody tr").length;
		document.onkeydown = function (event) {
	        var e = event || window.event || arguments.callee.caller.arguments[0];
	        if (e && e.keyCode == 38) {
		    	if(currentStep == 1) {
		    		$("#" + currentStep).css("background-color","#CCCCCC");
		    		currentStep = max_line_num;
		    		$("#" + currentStep).css("background-color","#F1E6C2");
		    	}
		    	else {
		    		$("#" + currentStep).css("background-color","#CCCCCC");
		    		currentStep--;
		    		$("#" + currentStep).css("background-color","#F1E6C2");
		    	}
	        }
	        if (e && e.keyCode == 40) {
		    	if(currentStep == max_line_num) {
		    		$("#" + currentStep).css("background-color","#CCCCCC");
		    		currentStep = 1;
		    		$("#" + currentStep).css("background-color","#F1E6C2");
		    	}
		    	else {
		    		$("#" + currentStep).css("background-color","#CCCCCC");
		    		currentStep++;
		    		$("#" + currentStep).css("background-color","#F1E6C2");
		    	}
	        }
	        if (e && e.keyCode == 33) {
				$("#" + currentStep).css("background-color","#CCCCCC");
				currentStep = 1;
				$("#" + currentStep).css("background-color","#F1E6C2");
	        }
	        if (e && e.keyCode == 34) {
				$("#" + currentStep).css("background-color","#CCCCCC");
				currentStep = max_line_num;
				$("#" + currentStep).css("background-color","#F1E6C2");
	        }
	        if (e && e.keyCode == 13) {
				var WebSellID = $("#" + currentStep).children().eq(0).text();
				var TicketState = $("#" + currentStep).children().eq(1).text();
				if(TicketState == 2) {
			        var url = "tms_v1_websell_printpaidticket.php?WebSellID=" + WebSellID + "&safeUser=" + $("#CertificateUser").val() + "&safeUserAddress=" + $("#CertificateUserAddress").val();
				}
				else {
			        var url = "tms_v1_websell_taketicketview.php?WebSellID=" + WebSellID;
				}   
		        window.location.href = url;
		    }
			if (e && e.keyCode == 27) {	//ESC
	        	document.location.href = "tms_v1_websell_taketicket.php";
	        }
		};
		document.onkeyup = function (event) {
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 27) {	//ESC
	        	document.location.href = "tms_v1_sell_query.php";
           		return false;
            }
		};
	});
	</script>
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">取 票</span></td>
  </tr>
</table>
<form method="post" name="form1" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
<tr>
    <td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 订单号：</span></td>
    <td bgcolor="#FFFFFF"><input name="WebSellID" id="WebSellID" type="text" /></td>
    <td bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />证件号码：</span></td>
    <td bgcolor="#FFFFFF">
    	<input type="text" name="CertificateNumber" id="CertificateNumber" />
    	<input type="button" name="readIDCard" id="readIDCard" style="font-size:13px;"value="读卡" onclick="readCard()" />
    	<input type="hidden" id="CertificateUser" name="CertificateUser" value="unknown" />
		<input type="hidden" id="CertificateUserAddress" name="CertificateUserAddress" value="unknown" />
   	</td>
    <td align="left" colspan="4" bgcolor="#FFFFFF">
    	<input type="button" name="resultquery" id="resultquery" value="订单查询" />&nbsp;&nbsp;&nbsp;
    	<input type="button" name="back" id="back" value="返回"  onclick="location.assign('tms_v1_sell_query.php')"/>
    </td>
</tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1"> 
<thead class="fixedHeader">
  	<tr bgcolor="#006699">
  		<th align="center" nowrap="nowrap">订单号</th>
  		<th style="display:none"></th>
    	<th align="center" nowrap="nowrap">姓名</th>
   		<th align="center" nowrap="nowrap">证件类型</th>
    	<th align="center" nowrap="nowrap">证件号码</th>
    	<th align="center" nowrap="nowrap">班次编号</th>
    	<th align="center" nowrap="nowrap">发车日期</th>
    	<th align="center" nowrap="nowrap">起点站</th>
    	<th align="center" nowrap="nowrap">到达站</th>
  		<th align="center" nowrap="nowrap">全票数</th>
  		<th align="center" nowrap="nowrap">半票数</th>
  		<th align="center" nowrap="nowrap">价格</th>
  		<th align="center" nowrap="nowrap">座位号</th>
  		<th align="center" nowrap="nowrap">操作</th>
  	 </tr>
</thead> 
<tbody class="scrollContent"> 
  <?php 
  	if(isset($_POST['WebSellID'])){
  		$WebSellID=$_POST['WebSellID'];
  		$CertificateNumber=$_POST['CertificateNumber'];
  		$CertificateUser=$_POST['CertificateUser'];
  		$CertificateUserAddress=$_POST['CertificateUserAddress'];
  		$select="SELECT wst_WebSellID,wst_UserName,wst_CertificateType,wst_CertificateNumber,wst_NoOfRunsID,wst_FromStation,
	 		wst_ReachStation,wst_FullNumber,wst_HalfNumber,wst_SellPrice,wst_SeatID,wst_NoOfRunsdate,wst_BeginStationTime,
	 		wst_StopStationTime,wst_TicketState,wst_PayTradeNo FROM tms_websell_WebSellTicket WHERE wst_WebSellID like '{$WebSellID}%' 
	 		AND wst_CertificateNumber like '{$CertificateNumber}%' AND (wst_TicketState='0' OR wst_TicketState='3' OR wst_TicketState='2')";
 		$result=$class_mysql_default->my_query($select);
  		$lineNum = 0;
  		while ($rows =mysqli_fetch_array($result)) {
  			$lineNum++;
  ?>
 	 <tr id="<?php echo $lineNum?>" bgcolor="#CCCCCC">
 	 	<td align="center" nowrap="nowrap"><?php echo $rows['wst_WebSellID'];?></td>
  		<td style="display:none"><?=$rows['wst_TicketState']?></td>
    	<td align="center" nowrap="nowrap"><?php echo $rows['wst_UserName'];?></td>
   		<td align="center" nowrap="nowrap"><?php echo $rows['wst_CertificateType'];?></td>
    	<td align="center" nowrap="nowrap"><?php echo $rows['wst_CertificateNumber'];?></td>
    	<td align="center" nowrap="nowrap"><?php echo $rows['wst_NoOfRunsID'];?></td>
    	<td align="center" nowrap="nowrap"><?php echo $rows['wst_NoOfRunsdate'];?></td>
    	<td align="center" nowrap="nowrap"><?php echo $rows['wst_FromStation'].'('.$rows['wst_BeginStationTime'].')';?></td>
    	<td align="center" nowrap="nowrap"><?php echo $rows['wst_ReachStation'].'('.$rows['wst_StopStationTime'].')';?></td>
    	<td align="center" nowrap="nowrap"><?php echo $rows['wst_FullNumber'];?></td>
    	<td align="center" nowrap="nowrap"><?php echo $rows['wst_HalfNumber'];?></td>
  		<td align="center" nowrap="nowrap"><?php echo $rows['wst_SellPrice'];?> 元</td>
  	<?php 
  		$selectmode="SELECT tml_Allticket FROM tms_bd_TicketMode WHERE tml_NoOfRunsID ='{$rows['wst_NoOfRunsID']}' AND 
				tml_NoOfRunsdate ='{$rows['wst_NoOfRunsdate']}'";
		$querymode =$class_mysql_default->my_query($selectmode);
		$rowmode=mysqli_fetch_array($querymode);
		if($rowmode['tml_Allticket'] == '1') {	//通票班次
  	?>
  		<td align="center" nowrap="nowrap"><?php echo "XX";?></td>
  	<?php } else {?>	
  		<td align="center" nowrap="nowrap"><?php echo $rows['wst_SeatID'];?></td>
  	<?php }?>
  	
  	<?php 
		if($rows['wst_TicketState'] == '2') {	//网上已支付，仅打票
  	?>
  		<td align="center" nowrap="nowrap" >[<a href="tms_v1_websell_printpaidticket.php?WebSellID=<?=$rows['wst_WebSellID']?>&safeUser=<?=$CertificateUser?>&safeUserAddress=<?=$CertificateUserAddress?>">打票</a>]</td>	
  	<?php } else {?>	
  		<td align="center" nowrap="nowrap" >[<a href="tms_v1_websell_taketicketview.php?WebSellID=<?=$rows['wst_WebSellID']?>">取票</a>]</td>	
  	<?php }?>
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
