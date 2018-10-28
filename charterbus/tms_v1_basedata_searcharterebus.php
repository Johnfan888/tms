<?
//包车界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$CharteredBusDate=date("Y-m-d");
	$CharteredBusDate1=date("Y-m-d");
	//if(isset($_POST['ChartereID'])){
		$ChartereID=$_POST['ChartereID'];
		$Customer=$_POST['Customer'];
		$BusID=$_POST['busCard'];
		$CharteredBusDate=$_POST['CharteredBusDate'];
		$CharteredBusDate1=$_POST['CharteredBusDate1'];
		
		//echo $CharteredBusDate;
		//echo $CharteredBusDate1;
		if($DataBeginDate == "" && $DataEndDate == ""){
 			$strDate = '';
 		}
		if ($CharteredBusDate != "" && $CharteredBusDate1 == ""){ //发车日期处理
 			$strDate="and cb_CharteredBusDate >='{$CharteredBusDate}'";
 			
 		}
 		if ($CharteredBusDate == "" && $CharteredBusDate1 != ""){
 			$strDate="and cb_CharteredBusDate <='{$CharteredBusDate1}'";
 		}
 		if ($CharteredBusDate != "" && $CharteredBusDate1 != ""){
 			$strDate="and cb_CharteredBusDate >='{$CharteredBusDate}' and cb_CharteredBusDate <='{$CharteredBusDate1}'";
 		}
 		if($userStationID=="all"){
 		$sql1="SELECT COUNT(*) AS number FROM tms_bd_CharteredBus where cb_ChartereID like '{$ChartereID}%'and cb_Customer like '{$Customer}%'
		and cb_BusNumber like '%$BusID%'".$strDate;
 							}
 		else{
 			$sql1="SELECT COUNT(cb_ChartereID) AS number FROM tms_bd_CharteredBus where  cb_ChartereID like '{$ChartereID}%'and cb_Customer like '{$Customer}%'
				and cb_BusNumber like '{$BusID}%' and cb_BillingStation='$userStationName'".$strDate;
 		}
		$query1 =$class_mysql_default->my_query($sql1);
		$rows = mysqli_fetch_array($query1);
		//echo $rows['number'];
	//}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head>
<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="../basedata/tms_v1_screen1.js"></script>
<script type="text/javascript" src="../basedata/tms_v1_rightclick.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
<script language="javascript">
function add(){
	window.location.href='tms_v1_basedata_addcharterebus.php';
}
function mod(){
	if (!document.getElementById("ChartereID1").value){
		alert('请选择订单！')
		return false
		}else{
			var str=document.getElementById("ChartereID1").value.split('-')
			if(str[1]!='0'){
				alert('不能修改该记录')
				return false
			}else{
				window.location.href='tms_v1_basedata_modcharterebus.php?op=mod&clnumber='+str[0]
			}
		}
}

function print(){
	if (!document.getElementById("ChartereID1").value){
		alert('请选择订单！')
		return false
		}else{
			var str=document.getElementById("ChartereID1").value.split('-')
			if (str[1]!='0'){
				alert('该记录已经打印')
				return false
			}else{
				window.location.href='tms_v1_basedata_printcharterebus.php?op=print&clnumber='+str[0]
			}
		}
}
$(document).ready(function(){
	$("#table1").tablesorter();
});
$(document).ready(function(){
	$("#del").click(function(){
		delchartered()
	});
});
$(document).ready(function(){
	$("#dell").click(function(){
		delchartered()
	});
});
function delchartered(){
	if (!document.getElementById("ChartereID1").value){
		alert('请选择订单！')
		return false
	}else{
		var str=document.getElementById("ChartereID1").value.split('-')
		if (str[1]!='0'){
			alert('不能删除该记录')
			return false
		}else{
			if(!confirm("确定要删除该订单吗？")){
				return false;
			}else{
				var ChartereID = str[0];
				jQuery.get(
					'tms_v1_basedata_delcharterebus.php',
					{'op': 'del', 'ChartereID': ChartereID, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if( objData.sucess=='1'){
							alert('删除成功！');
							document.form1.submit();
						}else{
							alert('删除失败！');
						}
				});
			}
		}
	}
}
$(document).ready(function(){
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
});
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<link href="../css/tms.css" rel="stylesheet" type="text/css">
</head>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">包 车 查 询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="#" onclick="add()">包车</a></li>   
        <li><a href="#" onclick="mod()">修改</a></li> 
        <li><a href="#" onclick="print()">打印</a></li>   
        <li><a href="#" id="dell">删除</a></li>       
    </ul>   
</div> 
<?
//连接数据库，获取班次信息
?>
<form method="post" name="form1" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />订单号：</span></td>
    <td bgcolor="#FFFFFF"><input type="text" name="ChartereID" value="<?php echo $ChartereID;?>"/></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 包车客户：</span></td>
    <td bgcolor="#FFFFFF"><input type="text" name="Customer" value="<?php echo $Customer;?>"/></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
    <td bgcolor="#FFFFFF"><input type="text" name="busCard" id="busCard" value="<?php echo $BusID ?>"/>
    <br>
	<select id="BusNumberselect" name="BusNumberselect" class="helplay" multiple="multiple" style="display:none;height:90px;" size="30" ></select>
	</td>
</tr>
<tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 包车日期：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="CharteredBusDate" class="Wdate" value="<?php echo $CharteredBusDate;?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    &nbsp;&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;<input type="text" name="CharteredBusDate1" class="Wdate" value="<?php echo $CharteredBusDate1;?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
    </td>
  	<td colspan="3" nowrap="nowrap" bgcolor="#FFFFFF">
  		&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="查询"  onclick="document.form1.submit()"/>
  		&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="包车" onclick="return add()">
  		&nbsp;&nbsp;&nbsp;<input name="button3" type="button" value="修改" onclick="return mod()"/> 
  		&nbsp;&nbsp;&nbsp;<input name="button4" type="button" value="打印" onclick="return print()"/>
  		&nbsp;&nbsp;&nbsp;<input name="button5" id="del" type="button" value="删除" />
  	<!--  
  		&nbsp;&nbsp;&nbsp;<input name="button6"  type="button" value="包车营收缴款" onclick="location.assign('tms_v1_basedata_charterebussellQuery.php');"/>
  		&nbsp;&nbsp;&nbsp;<input name="button6"  type="button" value="包车缴款查询" onclick="location.assign('tms_v1_basedata_charterebussubQuery.php');"/>	
  	-->
  	</td>
  	 <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 包车总数：<?php if($rows['number']=='') echo '0'; else echo $rows['number'];?></span></td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader"> 
  <tr>
  	<th nowrap="nowrap" align="center" bgcolor="#006699">订单号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">包车单号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">包车客户</th>
    <!--
    <th nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</th>
    -->
    <th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">驾照号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">驾驶员</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">包车日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">包车天数</th>
   	<th nowrap="nowrap" align="center" bgcolor="#006699">起屹地点</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">计费里程</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">核定座位数</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">实载人数</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">客运费</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">停滞费</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">开单日期</th> 
	<th nowrap="nowrap" align="center" bgcolor="#006699">开单车站</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">开票员编号</th>
	<th nowrap="nowrap" align="center" bgcolor="#006699">开票员</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">是否结算</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">结算时间</th>
  </tr>
  </thead> 
<tbody class="scrollContent">
  <?php
      // echo $strDate;
  		if($userStationID=="all"){
		$sql="SELECT * FROM tms_bd_CharteredBus where  cb_ChartereID like '%{$ChartereID}%' and cb_Customer like '%{$Customer}%' 
			 and cb_BusNumber like '%{$BusID}%'".$strDate;
		//echo $sql;
  		}
  		else{
  			$sql="SELECT * FROM tms_bd_CharteredBus where  cb_ChartereID like '%{$ChartereID}%' and cb_Customer like '%{$Customer}%' 
			 and cb_BusNumber like '%{$BusID}%' and cb_BillingStation='$userStationName'".$strDate;
  		}
  		//echo $sql;
		$query =$class_mysql_default->my_query($sql);
		//if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
		while ($row = mysqli_fetch_array($query)){
	?>
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'ChartereID1')">
        <td nowrap="nowrap" align="center"><?php echo $row['cb_ChartereID'].'-'.$row['cb_State'];?></td>
<!-- 
        <td><input type="hidden" name="State" id="State" value="<?php echo $row['cb_State'];?>"></td>
 -->
        <td nowrap="nowrap" align="center"><?php echo $row['cb_TicketID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['cb_Customer'];?></td>
        <!--
        <td nowrap="nowrap" align="center"><?php echo $row['cb_BusID'];?></td>
        -->
        <td nowrap="nowrap" align="center"><?php echo $row['cb_BusNumber'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['cb_DriverID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['cb_DriverName'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['cb_CharteredBusDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['cb_CharteredBusDays'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['cb_FromReach'];?></td>
		<td nowrap="nowrap" align="center"><?php echo $row['cb_Kilometers'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['cb_Seats'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['cb_Peoples'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['cb_CarriageFee'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['cb_StagnateFee'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['cb_BillingDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['cb_BillingStation'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['cb_BillingerID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['cb_BillingerName'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['cb_Remark'];?></td>
        <td nowrap="nowrap" align="center"><?php if($row['cb_IsBalance']=='1') echo '是'; else echo '否';?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['cb_BalanceDateTime'];?></td>
      </tr>
		<?php 
				}
			
	
		?>
	 <tr> <td> <input type="hidden" id=ChartereID1 value=""> </td> </tr>   
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>

