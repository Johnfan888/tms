<?
//销票管理查询界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
//	if(isset($_POST['InceptUserID'])){
		$InceptUserID=$_POST['InceptUserID'];
  		$Type=$_POST['Type'];
  		$UserSation=$_POST['UserSation'];
  		$DataBeginDate=$_POST['DataBeginDate'];
  		$DataEndDate=$_POST['DataEndDate'];
  		
		$str='';
		$strsta='';
 		$curdate=date('Y-m-d');
//		if ($DataBeginDate && !$DataEndDate){
// 			$str="AND tp_ProvideData>='{$DataBeginDate}'";
// 		}
// 		if (!$DataBeginDate && $DataEndDate){
// 			$str="AND tp_ProvideData<='{$DataEndDate}'";
// 		}
// 		if ($DataBeginDate && $DataEndDate){
// 			$str="AND tp_ProvideData>='{$DataBeginDate}' AND tp_ProvideData<='{$DataEndDate}'";
// 		}
// 		if(isset($_POST['InceptUserID'])){
// 			$strsta=" AND tp_UserSation LIKE '{$UserSation}%'";
// 		}else{
// 		//	$str="AND tp_ProvideData>='{$curdate}' AND tp_ProvideData<='{$curdate}'";
// 			$strsta=" AND tp_UserSation LIKE '{$userStationName}%'";
// 		}
 		if ($DataBeginDate && !$DataEndDate){
 			$str="AND tp_ProvideData>='{$DataBeginDate}'";
 			$resetstr="AND rt_ResetDate>='{$DataBeginDate}'";
 		}
 		if (!$DataBeginDate && $DataEndDate){
 			$str="AND tp_ProvideData<='{$DataEndDate}'";
 			$resetstr="AND rt_ResetDate<='{$DataEndDate}'";
 		}
 		if ($DataBeginDate && $DataEndDate){
 			$str="AND tp_ProvideData>='{$DataBeginDate}' AND tp_ProvideData<='{$DataEndDate}'";
 			$resetstr="AND rt_ResetDate>='{$DataBeginDate}' AND rt_ResetDate<='{$DataEndDate}'";
 		}
 		if(isset($_POST['InceptUserID'])){
 			$strsta=" AND tp_UserSation LIKE '{$UserSation}%'";
 			$resetstrsta=" AND rt_UserSation LIKE '{$UserSation}%'";
 		}else{
 		//	$str="AND tp_ProvideData>='{$curdate}' AND tp_ProvideData<='{$curdate}'";
 			$strsta=" AND tp_UserSation LIKE '{$userStationName}%'";
 			$resetstrsta=" AND rt_UserSation LIKE '{$userStationName}%'";
 		} 	
  		$sql1="SELECT COUNT(tp_ID) AS number FROM tms_bd_TicketProvide WHERE tp_InceptUserID LIKE '{$InceptUserID}%'  
  			   AND tp_Type LIKE '{$Type}%' AND tp_UseState='当前' AND tp_InceptTicketNum !='0'".$strsta.$str;
		$query1 =$class_mysql_default->my_query($sql1);
		$rows = mysqli_fetch_array($query1);
		if($rows['number']=='') $num1=0; else $num1=$rows['number'];
		$resetsql="SELECT COUNT(rt_ID) AS number FROM tms_sell_ResetTicket where rt_ResetUserID like '{$InceptUserID}%' AND rt_Type LIKE '{$Type}%' AND rt_InceptTicketNum !='0'".$resetstrsta.$resetstr;
		$resetquery =$class_mysql_default->my_query($resetsql);
		$resetrow1 = mysqli_fetch_array($resetquery);
		if($resetrow1['number']=='') $num2=0; else $num2=$resetrow1['number'];
		$num=$num1+$num2;
//	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head> 
<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="tms_v1_screen1.js"></script>
<script type="text/javascript" src="tms_v1_rightclick.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
<script type="text/javascript">
function seardelticket(){
	window.location.href='tms_v1_basedata_seardelticket.php';
}
function delticket(){
	if (!document.getElementById("ID1").value&&!document.getElementById("ID2").value){
		alert('请选择票据！');
		return false;
	}
	if(document.getElementById("ID1").value!=""){
		window.location.href='tms_v1_basedata_adddelticket.php?op=mod&clnumber='+document.getElementById("ID1").value;	
	}
	if(document.getElementById("ID2").value!=""){
		window.location.href='tms_v1_basedata_adddelticket1.php?op=mod&clnumber='+document.getElementById("ID2").value;	
	}
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
    <span class="graytext" style="margin-left:8px;">销 票 管 理</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="#" id="delticket" onclick="return delticket()">销票</a></li>   
        <li><a href="#" onclick="seardelticket()">销票查询</a></li>         
    </ul>   
</div> 
<?
//连接数据库，获取班次信息
?>
<form method="post" name="form1" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
 	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 领用者单位：</span></td>
    <td bgcolor="#FFFFFF"><input type="text" name="UserSation" <?php if($userStationName!="全部车站") echo 'readonly';?> value="<?php if(isset($_POST['InceptUserID'])) echo $UserSation; else echo $userStationName;?>"/></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 领用者编号：</span></td>
    <td bgcolor="#FFFFFF"><input type="text" name="InceptUserID" value="<?php echo $InceptUserID;?>"/></td> 
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
 </tr>
 <tr> 
   <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />领用日期：</span></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="DataBeginDate" id="DataBeginDate" class="Wdate" value="<?php echo $DataBeginDate;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" />
    		&nbsp;&nbsp;至&nbsp;&nbsp;<input type="text" name="DataEndDate" id="DataEndDate" class="Wdate" value="<?php echo $DataEndDate;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>   
    <td colspan="2" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="查询" onclick="document.form1.submit()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="delticket1" id="delticket1" type="button" value="销票" onclick="return delticket()"/>
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="seardel" id="seardel" type="button" value="销票查询" onclick="seardelticket()">
    </td>
     <td nowrap="nowrap" colspan="2" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />总计：<?php if($num=='') echo '0'; else echo $num;?></span></td>
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
    <th nowrap="nowrap" align="center" bgcolor="#006699">当前票号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">结束票号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">余票数量</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">票据类型</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
  </tr>
    </thead>
 <tbody class="scrollContent">
  <?php
  //	if(isset($_POST['InceptUserID'])){
  		$allInceptTicketNum=0;
  		$str='';
  		$strsta='';
  		$curdate=date('Y-m-d');
 		if ($DataBeginDate && !$DataEndDate){
 			$str="AND tp_ProvideData>='{$DataBeginDate}'";
 			$resetstr="AND rt_ResetDate>='{$DataBeginDate}'";
 		}
 		if (!$DataBeginDate && $DataEndDate){
 			$str="AND tp_ProvideData<='{$DataEndDate}'";
 			$resetstr="AND rt_ResetDate<='{$DataEndDate}'";
 		}
 		if ($DataBeginDate && $DataEndDate){
 			$str="AND tp_ProvideData>='{$DataBeginDate}' AND tp_ProvideData<='{$DataEndDate}'";
 			$resetstr="AND rt_ResetDate>='{$DataBeginDate}' AND rt_ResetDate<='{$DataEndDate}'";
 		}
 		if(isset($_POST['InceptUserID'])){
 			$strsta=" AND tp_UserSation LIKE '{$UserSation}%'";
 			$resetstrsta=" AND rt_UserSation LIKE '{$UserSation}%'";
 		}else{
 		//	$str="AND tp_ProvideData>='{$curdate}' AND tp_ProvideData<='{$curdate}'";
 			$strsta=" AND tp_UserSation LIKE '{$userStationName}%'";
 			$resetstrsta=" AND rt_UserSation LIKE '{$userStationName}%'";
 		} 	
		$sql="SELECT * FROM tms_bd_TicketProvide where tp_InceptUserID like '{$InceptUserID}%' AND tp_Type LIKE '{$Type}%' AND tp_UseState='当前' AND tp_InceptTicketNum !='0'".$strsta.$str;
//			AND tp_ProvideData>='{$DataBeginDate}' AND tp_ProvideData<='{$DataEndDate}'";
		$query =$class_mysql_default->my_query($sql);
	//	if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
	    $i=0;
		while ($row = mysqli_fetch_array($query)){
			$i++;
	?>
	<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'ID1')">
        <td nowrap="nowrap" align="center" style="display:none;"><?php echo $row['tp_ID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $i ?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['tp_InceptUserID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['tp_InceptUser'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['tp_UserSation'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['tp_ProvideData'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['tp_BeginTicket'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['tp_CurrentTicket'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['tp_EndTicket'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['tp_InceptTicketNum'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['tp_Type'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['tp_Remark'];?></td>
     </tr>
		<?php 
				}
	//		}
		$resetsql="SELECT * FROM tms_sell_ResetTicket where rt_ResetUserID like '{$InceptUserID}%' AND rt_Type LIKE '{$Type}%' AND rt_InceptTicketNum !='0'".$resetstrsta.$resetstr;
		$resetquery =$class_mysql_default->my_query($resetsql);
	//	if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
		while ($resetrow = mysqli_fetch_array($resetquery)){
			$i++;
	?>
	<tr id="tr1"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'ID2')">
        <td nowrap="nowrap" align="center" style="display:none;"><?php echo $resetrow['rt_ID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $i ?></td>
        <td nowrap="nowrap" align="center"><?php echo $resetrow['rt_ResetUserID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $resetrow['rt_ResetUser'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $resetrow['rt_UserSation'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $resetrow['rt_ResetDate'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $resetrow['rt_BeginTicket'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $resetrow['rt_CurrentTicket'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $resetrow['rt_EndTicket'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $resetrow['rt_InceptTicketNum'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $resetrow['rt_Type'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $resetrow['rt_Remark'];?></td>
     </tr>
		<?php 
				}
		?><tr><td style="border:0px;"><input type="hidden" id="ID1" value=""/>
		<input type="hidden" id="ID2" value=""/></td></tr>          
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>


