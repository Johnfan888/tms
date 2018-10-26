<?
//网上售票界面

define("WEBAUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

//获取查询初始化界面参数
//$UserRegisterName=$_GET['UserRegisterName'];
//echo $UserRegisterName;
//echo $Password;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>网上售票</title>
<link href="../css/tms.css" rel="stylesheet" type="text/css" /> 
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">


function searchreserve(){
	window.location.href='tms_v1_websell_websearchreserve.php'
}

$(document).ready(function(){
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
});

$(document).click(function(){
	document.getElementById("FromStationselect").style.display="none";
	document.getElementById("ReachStationselect").style.display="none";
});
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css"></link>
</head>
<body style="scrolling:auto;overflow:auto;">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">网 上 售 票 查 询</span></td>
  </tr>
</table>
<form action="" method="post" name="aaa">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	
  <tr>
    <td nowrap="nowrap" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 出发地：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="FromStation" id="FromStation" />
       <br />
        <select id="FromStationselect" name="FromStationselect"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="FromStation.value=options[selectedIndex].text; this.style.display='none';"   >
		</select>
	 	<input name="FromStationID" id="FromStationID" type="hidden"/>
    </td>
    <td nowrap="nowrap" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 目的地：</span></td>
    <td nowrap="nowrap"  bgcolor="#FFFFFF"><input type="text" name="ReachStation" id="ReachStation" />
        <br /> 
        <select id="ReachStationselect" name="ReachStationselect"  class="helplay"  multiple="multiple" style="display:none; height:90px" size="20" onchange="ReachStation.value=options[selectedIndex].text;this.style.display='none';" >
		</select>
        <input name="ReachStationID" id="ReachStationID" type="hidden"/>
     </td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 出发日期：</span></td>
    <td bgcolor="#FFFFFF"><input name="Selldate" id="Selldate" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
    <td colspan="2" bgcolor="#FFFFFF" align="center">
    	<input name="submit" type="submit" class="submit" value="可售班次查询" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button1" type="button" class="button" value="已订票查询" onclick="searchreserve()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset2" type="reset" value="重置" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="exitsys" type="button" value="退出" onclick="window.location.href='tms_v1_websell_group.php?action=exit'" />
    </td>
  </tr>
  <tr>
  <!--  
   	<td></td>
  	<td><select id="FromStationselect" name="FromStationselect"  class="helplay" multiple="multiple" style="display:none;height:90px" size="20"  onchange="FromStation.value=options[selectedIndex].text; this.style.display='none';">
		</select>
	 </td>

 
	 <td></td>
	 <td><select id="ReachStationselect" name="ReachStationselect"  class="helplay"  multiple="multiple" style="display:none; height:90px" size="20" onchange="ReachStation.value=options[selectedIndex].text;this.style.display='none';">
		</select>
	 </td>
-->
  </tr>
 </table>
<div id="tableContainer" class="tableContainer"> 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader"> 
  <tr>
    <th align="center" bgcolor="#006699" nowrap="nowrap">班次</th>
    <th align="center" bgcolor="#006699" nowrap="nowrap">线路</th>
    <th align="center" bgcolor="#006699" nowrap="nowrap">发站</th>
    <th align="center" bgcolor="#006699" nowrap="nowrap">到站</th>
    <th align="center" bgcolor="#006699" nowrap="nowrap">发车日期</th>
    <th align="center" bgcolor="#006699" nowrap="nowrap">发车时间</th>
    <th align="center" bgcolor="#006699" nowrap="nowrap">到达时间</th>
    <th align="center" bgcolor="#006699" nowrap="nowrap">票价</th>
    <th align="center" bgcolor="#006699" nowrap="nowrap">车型</th>
    <th align="center" bgcolor="#006699" nowrap="nowrap">余座</th>
    <th align="center" bgcolor="#006699" nowrap="nowrap">通票</th>
<!-- 
  	<td align="center">车辆编号</td>
    <td align="center">车牌号</td>
-->  
    <th align="center" bgcolor="#006699">操作</th>
  </tr>
    </thead> 
<tbody class="scrollContent"> 
<?
	if(isset($_POST['submit'])){
		$FromStation=$_POST['FromStation']; 
		$FromStationID=$_POST['FromStationID'];
		$ReachStationID=$_POST['ReachStationID'];
		$ReachStation=$_POST['ReachStation'];
		$Selldate=$_POST['Selldate'];
		$FromStationID=trim($FromStationID);
		$sql="SELECT pd_NoOfRunsID,pd_FromStation,pd_ReachStation,pd_BeginStationTime,pd_StopStationTime,pd_FullPrice,tml_BusModel,tml_LeaveSeats,
			tml_BusID,tml_BusCard,tml_Allticket,nri_LineName FROM tms_bd_PriceDetail LEFT OUTER JOIN tms_bd_TicketMode ON pd_NoOfRunsID=tml_NoOfRunsID
			AND tml_NoOfRunsdate=pd_NoOfRunsdate LEFT OUTER JOIN tms_bd_NoRunsInfo ON tml_NoOfRunsID=nri_NoOfRunsID
			WHERE pd_FromStation='{$FromStation}' AND pd_ReachStation='{$ReachStation}' AND pd_NoOfRunsdate='{$Selldate}' AND 
			tml_NoOfRunsdate='{$Selldate}' AND tml_AllowSell='1' AND pd_IsPass='1' ORDER BY STR_TO_DATE(pd_BeginStationTime,'%H:%i') ASC";  
		$resultsql = $class_mysql_default ->my_query($sql); 
	//	if (!$resultsql) echo "SQL错误：".->my_error();
 	 	while($rows = mysqli_fetch_array($resultsql)){
   	?>
  <tr align="center" onmouseover ="this.style.backgroundColor='#F1E6C2'" onmouseout ="this.style.backgroundColor='#FFFFFF'" bgcolor="#FFFFFF">
    <td nowrap="nowrap" bgcolor="#cccccc"><?=$rows[0]?></td>
    <td nowrap="nowrap" bgcolor="#cccccc"><?=$rows['nri_LineName']?></td>
    <td nowrap="nowrap" bgcolor="#cccccc"><?=$rows[1]?></td>
    <td nowrap="nowrap" bgcolor="#cccccc"><?=$rows[2]?></td>
    <td nowrap="nowrap" bgcolor="#cccccc"><?=$Selldate?></td>
    <td nowrap="nowrap" bgcolor="#cccccc"><?=$rows[3]?></td>
    <td nowrap="nowrap" bgcolor="#cccccc"><?=$rows[4]?></td>
    <td nowrap="nowrap" bgcolor="#cccccc"><?=$rows[5]?></td>
    <td nowrap="nowrap" bgcolor="#cccccc"><?=$rows[6]?></td>
  	<td nowrap="nowrap" bgcolor="#cccccc"><?=$rows[7]?></td>
	<td nowrap="nowrap" bgcolor="#cccccc"><? if($rows['tml_Allticket']==0) echo '否'; else echo '是';?></td>
<!-- 
	<td ><?=$rows[8]?></td>
    <td><?=$rows[9]?></td>
-->    
    <td align="center" nowrap="nowrap" bgcolor="#cccccc">[<a href="tms_v1_websell_webreserve.php?NoofrunsID=<?=$rows[0]?>&Selldate=<?=$Selldate?>&FromStation=<?=$FromStation?>&ReachStation=<?=$ReachStation?>">预定</a>]</td>
  </tr>
  <?
  		}
	} 
  ?>
</tbody>
</table>
</div> 
</form>
</body>
</html>
