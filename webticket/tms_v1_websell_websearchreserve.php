<?
//网上预定查询界面
/*
 * 票状态：0-网订（未支付）；1-网订取票（窗口支付并打票）；2-网售（网上支付未打票）；3-预留（电话订票）；4-预留取票（窗口支付并打票）；5-网售已打票（窗口或自动售票机）
 * 		 
 */
define("WEBAUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

//$CertificateType=$_GET['CertificateType'];
//$CertificateNumber=$_GET['CertificateNumber'];
//$UserRegisterName=$_GET['UserRegisterName'];

//$selectuser="SELECT wur_CertificateType,wur_CertificateNumber FROM tms_bd_WebUserRegister WHERE wur_UserRegisterName='{$UserRegisterName}'";
//$resultuser=$class_mysql_default->my_query("$selectuser");
//$rowsuser=@mysqli_fetch_array($resultuser);

//获取查询界面参数
if(isset($_POST['selldate'])){
	$FromStation=$_POST['FromStation']; 
	$ReachStation=$_POST['ReachStation'];
	$Selldate=$_POST['selldate'];
	$bookID=$_POST['bookID'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>预留查询</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<link href="../css/tms.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript">
	function websell(){
		window.location.href='tms_v1_websell_websell.php';
	}
	$(document).ready(function(){
		$("#FromStation").focus();
		$("#FromStation").focus();
		$("#FromStation").keyup(function(){
			document.getElementById("ReachStationselect").style.display="none";
			$("#FromStationselect").empty();
			document.getElementById("FromStationselect").style.display=""; 
			var fromstation = $("#FromStation").val();
			jQuery.get(
				'tms_v1_websell_getstation.php',
				{'op': 'getstation', 'fromstation': fromstation, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					for (var i = 0; i < objData.length; i++) {
						$("<option value = " + objData[i].from + ">" + objData[i].from + "</option>").appendTo($("#FromStationselect"));
					}
					if(fromstation==''){
						document.getElementById("FromStationselect").style.display="none";
					}
			});
		});
		$("#ReachStation").keyup(function(){
			document.getElementById("FromStationselect").style.display="none";
			$("#ReachStationselect").empty();
			document.getElementById("ReachStationselect").style.display=""; 
			var fromstation = $("#ReachStation").val();
			jQuery.get(
				'tms_v1_websell_getstation.php',
				{'op': 'getstation', 'fromstation': fromstation, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					for (var i = 0; i < objData.length; i++) {
						$("<option value = " + objData[i].from + ">" + objData[i].from + "</option>").appendTo($("#ReachStationselect"));
					}
					if(fromstation==''){
						document.getElementById("ReachStationselect").style.display="none";
					}
			});
		});
		document.getElementById("FromStationselect").onclick = function (event){
			document.getElementById("FromStation").value=document.getElementById("FromStationselect").value;
			document.getElementById("FromStationselect").style.display="none";
		};
		document.getElementById("ReachStationselect").onclick = function (event){
			document.getElementById("ReachStation").value=document.getElementById("ReachStationselect").value;
			document.getElementById("ReachStationselect").style.display="none";
		};
	});
	
	$(document).click(function(){
		document.getElementById("FromStationselect").style.display="none";
		document.getElementById("ReachStationselect").style.display="none";
	});
	</script>
</head>
<body style="scrolling:auto;overflow:auto;">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">网 上 预 定 查 询</span></td>
  </tr>
</table>
<form  method="post" name="form1" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 乘车日期：</span></td>
		<td nowrap="nowrap"><input name="selldate" id="selldate" class="Wdate" value="<?php print date('Y-m-d');?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
    	<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 乘车站：</span></td>
		<td nowrap="nowrap">
			<input type="text" name="FromStation" id="FromStation" value="" />
	    	<br/>
	    	<select id="FromStationselect" name="FromStationselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
		</td>
    	<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 到达站：</span></td>
		<td nowrap="nowrap">
			<input type="text" name="ReachStation" id="ReachStation" />
	    	<br/>
	    	<select id="ReachStationselect" name="ReachStationselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
		</td>
     	<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 订单号：</span></td>
		<td nowrap="nowrap">
			<input type="text" name="bookID" id="bookID" value="" />
		</td>
    	<td align="center">
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="resultquery" id="resultquery" type="submit" value="查询" />
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="button1" id="button1" type="button" value="返回" onclick="return websell()" />
    	</td>
    </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader"> 
  	<tr bgcolor="#006699" style="border:1px;">
  		<th align="center" nowrap="nowrap" ><span class="form_title">订单号</span></th>
    	<th align="center" nowrap="nowrap" ><span class="form_title">姓名</span></th>
   		<th align="center" nowrap="nowrap"><span class="form_title">证件类型</span></th>
    	<th align="center" nowrap="nowrap"><span class="form_title">证件号码</span></th>
    	<th align="center" nowrap="nowrap"><span class="form_title">线路名</span></th>
    	<th align="center" nowrap="nowrap"><span class="form_title">班次编号</span></th>
    	<th align="center" nowrap="nowrap"><span class="form_title">发车日期</span></th>
    	<th align="center" nowrap="nowrap"><span class="form_title">起点站</span></th>
    	<th align="center" nowrap="nowrap"><span class="form_title">到达站</span></th>
  		<th align="center" nowrap="nowrap"><span class="form_title">全票数</span></th>
  		<th align="center" nowrap="nowrap"><span class="form_title">半票数</span></th>
  		<th align="center" nowrap="nowrap"><span class="form_title">价格</span></th>
  		<th align="center" nowrap="nowrap"><span class="form_title">座位号</span></th>
  		<th align="center" nowrap="nowrap"><span class="form_title">支付交易号</span></th>
  		<th align="center" nowrap="nowrap"><span class="form_title">操作</span></th>
 	 </tr>
 	 </thead> 
<tbody class="scrollContent"> 
 	 <?php 
 	 	$select="SELECT wst_WebSellID,wst_UserName,wst_CertificateType,wst_CertificateNumber,wst_NoOfRunsID,wst_FromStation,
 			wst_ReachStation,wst_FullNumber,wst_HalfNumber,wst_SellPrice,wst_SeatID,wst_NoOfRunsdate,wst_BeginStationTime,
 			wst_StopStationTime,wst_TicketState,wst_PayTradeNo,nri_LineName FROM tms_websell_WebSellTicket LEFT OUTER JOIN tms_bd_NoRunsInfo ON wst_NoOfRunsID=nri_NoOfRunsID
 			WHERE wst_CertificateType='{$CertificateType}' 
 			AND wst_CertificateNumber='{$CertificateNumber}' AND wst_FromStation LIKE '{$FromStation}%' 
 			AND wst_ReachStation LIKE '{$ReachStation}%' AND wst_NoOfRunsdate LIKE '{$Selldate}%' AND wst_WebSellID LIKE '{$bookID}%'";
		$result=$class_mysql_default->my_query("$select");
		if (!$result) echo "SQL错误：".$class_mysql_default->my_error();
 	 	while($rows=mysqli_fetch_array($result)){
 	 ?>
 	 <tr>
 	 	<td align="center" nowrap="nowrap" ><span><?php echo $rows['wst_WebSellID'];?></span></td>
    	<td align="center" nowrap="nowrap" ><span ><?php echo $rows['wst_UserName'];?></span></td>
   		<td align="center" nowrap="nowrap" ><span ><?php echo $rows['wst_CertificateType'];?></span></td>
    	<td align="center" nowrap="nowrap" ><span><?php echo $rows['wst_CertificateNumber'];?></span></td>
    	<td align="center" nowrap="nowrap" ><span><?php echo $rows['nri_LineName'];?></span></td>
    	<td align="center" nowrap="nowrap" ><span><?php echo $rows['wst_NoOfRunsID'];?></span></td>
    	<td align="center" nowrap="nowrap" ><span><?php echo $rows['wst_NoOfRunsdate'];?></span></td>
    	<td align="center" nowrap="nowrap" ><span><?php echo $rows['wst_FromStation'].'('.$rows['wst_BeginStationTime'].')';?></span></td>
    	<td align="center" nowrap="nowrap" ><span><?php echo $rows['wst_ReachStation'].'('.$rows['wst_StopStationTime'].')';?></span></td>
    	<td align="center" nowrap="nowrap" ><span><?php echo $rows['wst_FullNumber'];?></span></td>
    	<td align="center" nowrap="nowrap" ><span><?php echo $rows['wst_HalfNumber'];?></span></td>
  		<td align="center" nowrap="nowrap" ><span><?php echo $rows['wst_SellPrice'];?> 元</span></td>
  	<?php 
  		$selectmode="SELECT tml_Allticket FROM tms_bd_TicketMode WHERE tml_NoOfRunsID ='{$rows['wst_NoOfRunsID']}' AND 
				tml_NoOfRunsdate ='{$rows['wst_NoOfRunsdate']}'";
		$querymode =$class_mysql_default->my_query($selectmode);
		$rowmode=mysqli_fetch_array($querymode);
		if($rowmode['tml_Allticket'] == '1') {	//通票班次
  	?>
  		<td align="center" nowrap="nowrap" ><span class="form_title"><?php echo "XX";?></span></td>
  	<?php } else {?>	
  		<td align="center" nowrap="nowrap" ><span class="form_title"><?php echo $rows['wst_SeatID'];?></span></td>
  	<?php }?>
  	<?php if($rows['wst_TicketState'] == '0'){?>
  		<td align="center" nowrap="nowrap" ><span class="form_title"><?php echo "";?></span></td>
  		<td align="center" nowrap="nowrap" >
			[<a href="tms_v1_websell_delwebreserve.php?WebSellID=<?=$rows['wst_WebSellID']?>">取消预定</a>]
		<!-- 
			[<a href="alipaydualfun/tms_v1_websell_onlinepay.php?bID=<?=$rows['wst_WebSellID']?>&d=<?=$rows['wst_NoOfRunsdate']?>&t=<?=$rows['wst_BeginStationTime']?>&f=<?=$rows['wst_FromStation']?>&r=<?=$rows['wst_ReachStation']?>&fNum=<?=$rows['wst_FullNumber']?>&hNum=<?=$rows['wst_HalfNumber']?>&price=<?=$rows['wst_SellPrice']?>">网上支付</a>]
		-->	
			[<a href="alipaydirect/tms_v1_websell_onlinepay.php?bID=<?=$rows['wst_WebSellID']?>&d=<?=$rows['wst_NoOfRunsdate']?>&t=<?=$rows['wst_BeginStationTime']?>&f=<?=$rows['wst_FromStation']?>&r=<?=$rows['wst_ReachStation']?>&fNum=<?=$rows['wst_FullNumber']?>&hNum=<?=$rows['wst_HalfNumber']?>&price=<?=$rows['wst_SellPrice']?>">网上支付</a>]
  		</td>
  	<?php } elseif($rows['wst_TicketState'] == '1'){?>
  		<td align="center" nowrap="nowrap" ><span class="form_title"><?php echo $rows['wst_PayTradeNo'];?></span></td>
  		<td align="center" nowrap="nowrap" ><span class="form_title">窗口已支付</span></td>
  	<?php } elseif ($rows['wst_TicketState'] == '2'){?>
  		<td align="center" nowrap="nowrap" ><span class="form_title"><?php echo $rows['wst_PayTradeNo'];?></span></td>
  		<td align="center" nowrap="nowrap" ><span class="form_title">网上已支付</span></td>
  	<?php } elseif ($rows['wst_TicketState'] == '3'){?>
  		<td align="center" nowrap="nowrap"><span class="form_title"><?php echo "";?></span></td>
  		<td align="center" nowrap="nowrap" ><span class="form_title">已预留</span></td>
  	<?php } elseif ($rows['wst_TicketState'] == '4'){?>
  		<td align="center" nowrap="nowrap" ><span class="form_title"><?php echo "";?></span></td>
  		<td align="center" nowrap="nowrap" ><span class="form_title">预留已支付</span></td>
  	<?php } elseif ($rows['wst_TicketState'] == '5'){?>
  		<td align="center" nowrap="nowrap" ><span class="form_title"><?php echo "";?></span></td>
  		<td align="center" nowrap="nowrap" ><span class="form_title">网售已打票</span></td>
  	<?php } else {}?>
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

