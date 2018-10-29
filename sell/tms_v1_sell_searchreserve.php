<?
//网上预定查询界面

define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

//$CertificateType=$_GET['CertificateType'];
//$CertificateNumber=$_GET['CertificateNumber'];
//$UserRegisterName=$_GET['UserRegisterName'];

//$selectuser="SELECT wur_CertificateType,wur_CertificateNumber FROM tms_bd_WebUserRegister WHERE wur_UserRegisterName='{$UserRegisterName}'";
//$resultuser=$class_mysql_default->my_query("$selectuser");
//$rowsuser=@mysqli_fetch_array($resultuser);

//获取查询界面参数
if($userStationName=='全部车站'){
	$userStationName='';
}
if(isset($_POST['selldate'])){
	$FromStation=$_POST['FromStation']; 
	$ReachStation=$_POST['ReachStation'];
	$Selldate=$_POST['selldate'];
	$IDNum=$_POST['IDNum'];
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
		window.location.href='tms_v1_sell_sellreserve.php';
	}
	$(document).ready(function(){
		$("#FromStation").focus();
		$("#FromStation").keyup(function(){
			document.getElementById("ReachStationselect").style.display="none";
			$("#FromStationselect").empty();
			document.getElementById("FromStationselect").style.display=""; 
			var fromstation = $("#FromStation").val();
			jQuery.get(
				'tms_v1_sell_sell.php',
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
				'tms_v1_sell_sell.php',
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
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;"> 预 留 查 询</span></td>
  </tr>
</table>
<form  method="post" name="form1" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr bgcolor="#FFFFFF">
		<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 乘车日期：</span></td>
		<td nowrap="nowrap"><input name="selldate" id="selldate" class="Wdate" value="<?php if(isset($_POST['resultquery'])){ echo $Selldate;} else{} ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
    	<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 起点站：</span></td>
		<td nowrap="nowrap">
			<input type="text" name="FromStation" id="FromStation" value="<?php echo $FromStation?>" />
	    	<br/>
	    	<select id="FromStationselect" name="FromStationselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
		</td>
    	<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 到达站：</span></td>
		<td nowrap="nowrap">
			<input type="text" name="ReachStation" id="ReachStation" value="<?php echo $ReachStation;?>" />
	    	<br/>
	    	<select id="ReachStationselect" name="ReachStationselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
     	<td nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 证件号：</span></td>
		<td nowrap="nowrap">
			<input type="text" name="IDNum" id="IDNum" value="<?php echo $IDNum; ?>" />
		</td>
    	<td colspan="4" align="center">
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="resultquery" id="resultquery" type="submit" value="查询" />
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="button1" id="button1" type="button" value="返回" onclick="return websell()" />
    	</td>
    </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1"> 
<thead class="fixedHeader">
 	<tr bgcolor="#006699">
  		<th align="center" nowrap="nowrap" >订单号</th>
    	<th align="center" nowrap="nowrap">姓名</th>
   		<th align="center" nowrap="nowrap">证件类型</th>
    	<th align="center" nowrap="nowrap">证件号码</th>
    	<th align="center" nowrap="nowrap">班次编号</th>
    	<th align="center" nowrap="nowrap">发车日期</th>
    	<th align="center" nowrap="nowrap">起点站</th>
    	<th align="center" nowrap="nowrap">到达站</th>
  		<th align="center" nowrap="nowrap">全票数</th>
  		<th align="center" nowrap="nowrap">半票数</th>
  		<th align="center" nowrap="nowrap"">留票车站</th>
  		<th align="center" nowrap="nowrap"">留票员ID</th>
  		<th align="center" nowrap="nowrap"">留票员</th>
  		<th align="center" nowrap="nowrap">价格</th>
  		<th align="center" nowrap="nowrap"">座位号</th>
  		<th align="center" nowrap="nowrap">操作</th>
 	 </tr>
 	 </thead>
 	 <tbody class="scrollContent"> 
 	 <?php 
 	 	$select="SELECT wst_WebSellID,wst_UserName,wst_CertificateType,wst_CertificateNumber,wst_NoOfRunsID,wst_FromStation,
 			wst_ReachStation,wst_FullNumber,wst_HalfNumber,wst_SellPrice,wst_SeatID,wst_NoOfRunsdate,wst_BeginStationTime,
 			wst_StopStationTime,wst_TicketState,wst_PayTradeNo,wst_Station,wst_ReserveID,wst_ReserveName 
 			FROM tms_websell_WebSellTicket 
 			WHERE wst_WebSellID LIKE 'R%' 
 			AND	wst_FromStation LIKE '{$FromStation}%' 
 			AND wst_ReachStation LIKE '{$ReachStation}%' 
 			AND wst_NoOfRunsdate LIKE '{$Selldate}%' 
 			AND wst_CertificateNumber LIKE '{$IDNum}%'
 	 		AND wst_Station LIKE '%{$userStationName}%'";
 	 	//echo $select;
		$result=$class_mysql_default->my_query("$select");
		if (!$result) echo "SQL错误：".$class_mysql_default->my_error();
 	 	while($rows=mysqli_fetch_array($result)){
 	 
 	 ?>
 	 <tr onmouseover ="this.style.backgroundColor='#F1E6C2'" onmouseout ="this.style.backgroundColor='#FFFFFF'" bgcolor="#FFFFFF">
 	 	<td align="center" nowrap="nowrap" bgcolor="#cccccc"><?php echo $rows['wst_WebSellID'];?></td>
    	<td align="center" nowrap="nowrap" bgcolor="#cccccc"><?php echo $rows['wst_UserName'];?></td>
   		<td align="center" nowrap="nowrap" bgcolor="#cccccc"><?php echo $rows['wst_CertificateType'];?></td>
    	<td align="center" nowrap="nowrap" bgcolor="#cccccc"><?php echo $rows['wst_CertificateNumber'];?></td>
    	<td align="center" nowrap="nowrap" bgcolor="#cccccc"><?php echo $rows['wst_NoOfRunsID'];?></td>
    	<td align="center" nowrap="nowrap" bgcolor="#cccccc"><?php echo $rows['wst_NoOfRunsdate'];?></td>
    	<td align="center" nowrap="nowrap" bgcolor="#cccccc"><?php echo $rows['wst_FromStation'].'('.$rows['wst_BeginStationTime'].')';?></td>
    	<td align="center" nowrap="nowrap" bgcolor="#cccccc"><?php echo $rows['wst_ReachStation'].'('.$rows['wst_StopStationTime'].')';?></td>
    	<td align="center" nowrap="nowrap" bgcolor="#cccccc"><?php echo $rows['wst_FullNumber'];?></td>
    	<td align="center" nowrap="nowrap" bgcolor="#cccccc"><?php echo $rows['wst_HalfNumber'];?></td>
    	<td align="center" nowrap="nowrap" bgcolor="#cccccc"><?php echo $rows['wst_Station'];?></td>
  		<td align="center" nowrap="nowrap" bgcolor="#cccccc"><?php echo $rows['wst_ReserveID'];?></td>
  		<td align="center" nowrap="nowrap" bgcolor="#cccccc"><?php echo $rows['wst_ReserveName'];?></td>
  		<td align="center" nowrap="nowrap" bgcolor="#cccccc"><?php echo $rows['wst_SellPrice'];?> 元</td>
  	<?php 
  		$selectmode="SELECT tml_Allticket FROM tms_bd_TicketMode WHERE tml_NoOfRunsID ='{$rows['wst_NoOfRunsID']}' AND 
				tml_NoOfRunsdate ='{$rows['wst_NoOfRunsdate']}'";
		$querymode =$class_mysql_default->my_query($selectmode);
		$rowmode=mysqli_fetch_array($querymode);
		if($rowmode['tml_Allticket'] == '1') {	//通票班次
  	?>
  		<td align="center" nowrap="nowrap" bgcolor="#cccccc"><?php echo "XX";?></td>
  	<?php } else {?>	
  		<td align="center" nowrap="nowrap" bgcolor="#cccccc"><?php echo $rows['wst_SeatID'];?></td>
  	<?php }?>
  	<?php if($rows['wst_TicketState'] == '3'){?>
  		<td align="center" nowrap="nowrap" bgcolor="#cccccc">
			[<a href="tms_v1_sell_delreserve.php?WebSellID=<?php echo $rows['wst_WebSellID']?>" style="bgcolor:#cccccc">取消订票</a>]
  		</td>
  	<?php } elseif ($rows['wst_TicketState'] == '4'){?>
  		<td align="center" nowrap="nowrap" bgcolor="#cccccc">已取票</td>
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
