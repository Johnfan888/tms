<?
//销票查询界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
//	if(isset($_POST['InceptUserID'])){
		$DeletorID=$_POST['DeletorID'];
  		$Type=$_POST['Type'];
  		$UserSation=$_POST['UserSation'];
  		$DataBeginDate=$_POST['DataBeginDate'];
  		$DataEndDate=$_POST['DataEndDate'];
  		$DataBeginDate1=$DataBeginDate.' 00:00:00';
  		$DataEndDate1=$DataEndDate.' 23:59:59';
  		
		$str='';
		$strsta='';
		if ($DataBeginDate && !$DataEndDate){
 			$str="AND dt_DeleteTime>='{$DataBeginDate1}'";
 		}
 		if (!$DataBeginDate && $DataEndDate){
 			$str="AND dt_DeleteTime<='{$DataEndDate1}'";
 		}
 		if ($DataBeginDate && $DataEndDate){
 			$str="AND dt_DeleteTime>='{$DataBeginDate1}' AND dt_DeleteTime<='{$DataEndDate1}'";
 		}
 		if(isset($_POST['DeletorID'])){
 			$strsta=" AND dt_DeletorSation LIKE '{$UserSation}%'";
 		}else{
 			$strsta=" AND dt_DeletorSation LIKE '{$userStationName}%'";
 		}
  		$sql1="SELECT COUNT(dt_ID) AS number FROM tms_bd_DelTicket WHERE dt_DeletorID LIKE '{$DeletorID}%'  
  			   AND dt_Type LIKE '{$Type}%'".$strsta.$str;
		$query1 =$class_mysql_default->my_query($sql1);
		$rows = mysqli_fetch_array($query1);
//	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head> 
<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="tms_v1_screen1.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
<script type="text/javascript">
function retur(){
	window.location.href='tms_v1_basedata_delticket.php';
}
$(document).ready(function(){
	$("#table1").tablesorter();
});
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<link href="../css/tms.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">销 票 查 询</span></td>
  </tr>
</table>
<!--<div id="menu" style="display: none">   -->
<!--	<ul>   -->
<!--		<li><a href="#" id="backprovid" >退领</a></li>   -->
<!--        <li><a href="#" onclick="retur()">返回</a></li>         -->
<!--    </ul>   -->
<!--</div> -->
<?
//连接数据库，获取班次信息
?>
<form method="post" name="form1" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 票据类型：</span></td>
    <td bgcolor="#FFFFFF">
    	<select name="Type" >
			<?php
				if($Type=='') echo "<option selected=\"selected\"></option>";
				else echo "<option></option>";
				if($Type=='客票') echo "<option selected=\"selected\" value=\"客票\">客票</option>";
				else echo "<option  value=\"客票\">客票</option>";
				if($Type=='保险票') echo "<option selected=\"selected\" value=\"保险票\">保险票</option>";
				else echo "<option  value=\"保险票\">保险票</option>";
				if($Type=='结算单') echo "<option selected=\"selected\" value=\"结算单\">结算单</option>";
				else echo "<option  value=\"结算单\">结算单</option>";
				if($Type=='包车单') echo "<option selected=\"selected\" value=\"包车单\">包车单</option>";
				else echo "<option  value=\"包车单\">包车单</option>";
				if($Type=='托运单') echo "<option selected=\"selected\" value=\"托运单\">托运单</option>";
				else echo "<option  value=\"托运单\">托运单</option>";
				if($Type=='安检单') echo "<option selected=\"selected\" value=\"安检单\">安检单</option>";
				else echo "<option  value=\"安检单\">安检单</option>";
			?>
      	</select> 
    </td> 
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 销票者编号：</span></td>
    <td bgcolor="#FFFFFF"><input type="text" name="DeletorID" value="<?php echo $DeletorID;?>"/></td> 
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />销票日期：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="DataBeginDate" id="DataBeginDate" class="Wdate" value="<?php echo $DataBeginDate;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" />
    		&nbsp;&nbsp;至&nbsp;&nbsp;<input type="text" name="DataEndDate" id="DataEndDate" class="Wdate" value="<?php echo $DataEndDate;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
    </tr>
    <tr>		
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 销票者单位：</span></td>
    <td bgcolor="#FFFFFF"><input type="text" name="UserSation" <?php if($userStationName!="全部车站") echo 'readonly';?> value="<?php if(isset($_POST['DeletorID'])) echo $UserSation; else echo $userStationName;?>"/></td>
 
     <?php 
		$sql="SELECT * FROM tms_bd_DelTicket where dt_DeletorID like '{$DeletorID}%' AND dt_Type LIKE '{$Type}%'".$strsta.$str;
		$query =$class_mysql_default->my_query($sql);
    	while ($row = mysqli_fetch_array($query)){
			$allInceptTicketNum=$allInceptTicketNum+$row['dt_DelTicketNum'];
    	}
    ?>
    
    <td colspan="3" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="查询" onclick="document.form1.submit()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="button3" type="button" value="返回" onclick="retur()">
    </td>
     <td nowrap="nowrap" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;销票次数：<?php if($rows['number']=='') echo '0'; else echo $rows['number'];?>
     &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;销票总张数：<?php echo $allInceptTicketNum;?></td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
  <tr>
   	<th nowrap="nowrap" align="center" bgcolor="#006699" style="display:none;">序号</th>
   	<th nowrap="nowrap" align="center" bgcolor="#006699">序号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">领用者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">领用者</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">领用者单位</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">领用日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">开始票号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">结束票号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">销票张数</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">票据类型</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">销票时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">销票者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">销票者</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">销票单位</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">销票原因</th>
  </tr>
    </thead>
 <tbody class="scrollContent">
  <?php
  //	if(isset($_POST['InceptUserID'])){
  		$allInceptTicketNum=0;
 		$str='';
		$strsta='';
		if ($DataBeginDate && !$DataEndDate){
 			$str="AND dt_DeleteTime>='{$DataBeginDate1}'";
 		}
 		if (!$DataBeginDate && $DataEndDate){
 			$str="AND dt_DeleteTime<='{$DataEndDate1}'";
 		}
 		if ($DataBeginDate && $DataEndDate){
 			$str="AND dt_DeleteTime>='{$DataBeginDate1}' AND dt_DeleteTime<='{$DataEndDate1}'";
 		}
 		if(isset($_POST['DeletorID'])){
 			$strsta=" AND dt_DeletorSation LIKE '{$UserSation}%'";
 		}else{
 			$strsta=" AND dt_DeletorSation LIKE '{$userStationName}%'";
 		}
		$sql="SELECT * FROM tms_bd_DelTicket where dt_DeletorID like '{$DeletorID}%' AND dt_Type LIKE '{$Type}%'".$strsta.$str."ORDER BY dt_DeleteTime desc";
		$query =$class_mysql_default->my_query($sql);
	    $i=0;
		while ($row = mysqli_fetch_array($query)){
			$i++;
	?>
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'ID1')">
        <td nowrap="nowrap" align="center" style="display:none;"><?php echo $row['dt_ID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $i ?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['dt_InceptUserID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['dt_InceptUser'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['dt_UserSation'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['dt_ProvideDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['dt_BeginTicket'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['dt_EndTicket'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['dt_DelTicketNum'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['dt_Type'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['dt_DeleteTime'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['dt_DeletorID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['dt_DeletorName'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['dt_DeletorSation'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['dt_DelReason'];?></td>
     </tr>
		<?php 
				}
	//		}
	
		?><tr><td style="border:0px;"><input type="hidden" id="ID1" value=""/></td></tr>          
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>


