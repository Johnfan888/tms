<?php
//票据领用查询界面
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
  		$UseState=$_POST['UseState']; //使用状态
  		
  		if($UseState == "" || $UseState == "退领"){  //使用状态的处理
 			$str1="AND tp_UseState like '{$UseState}%'";
 		}
 		if($UseState == "当前"){
 			$str1="AND tp_UseState like '{$UseState}%' AND tp_InceptTicketNum != '0'";
 		}
 		if($UseState == "用完"){
 			$str1="AND tp_UseState='当前' AND tp_InceptTicketNum ='0'";
 		}
		$str='';
		$strsta='';
 		$curdate=date('Y-m-d');
		if ($DataBeginDate && !$DataEndDate){
 			$str="AND tp_ProvideData>='{$DataBeginDate}'";
 		}
 		if (!$DataBeginDate && $DataEndDate){
 			$str="AND tp_ProvideData<='{$DataEndDate}'";
 		}
 		if ($DataBeginDate && $DataEndDate){
 			$str="AND tp_ProvideData>='{$DataBeginDate}' AND tp_ProvideData<='{$DataEndDate}'";
 		}
 		if(isset($_POST['InceptUserID'])){
 			$strsta=" AND tp_UserSation LIKE '{$UserSation}%'";
 		}else{
 		//	$str="AND tp_ProvideData>='{$curdate}' AND tp_ProvideData<='{$curdate}'";
 			$strsta=" AND tp_UserSation LIKE '{$userStationName}%'";
 		}
  		$sql1="SELECT COUNT(tp_ID) AS number FROM tms_bd_TicketProvide WHERE tp_InceptUserID LIKE '{$InceptUserID}%'  
  			   AND tp_Type LIKE '{$Type}%'".$strsta.$str.$str1;
		$query1 =$class_mysql_default->my_query($sql1);
		$rows = mysqli_fetch_array($query1);
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
function retur(){
	window.location.href='tms_v1_basedata_searticketadd.php';
}
$(document).ready(function(){
	$("#table1").tablesorter();
});
$(document).ready(function(){
	$("#backprovide").click(function(){
		backp();
	});
});
$(document).ready(function(){
	$("#backprovid").click(function(){
		backp();
	});
});
function backp(){
	if (!document.getElementById("ID1").value){
		alert('请选择票据！');
		return false;
	}else{
		if(!confirm("确定要退领该票据吗？")){
			return false;
		}else{
			jQuery.get(
					'tms_v1_bsaedata_dataProcess.php',
					{'op': 'backprovide', 'ID': $("#ID1").val(), 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if( objData.sucess=='1'){
							alert('退领成功！');
							document.form1.submit();
						}else{
							alert('退领失败！');
						}
				});
		}
	}
}

</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<link href="../css/tms.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">票 据 领 用 查 询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="#" id="backprovid" >退领</a></li>   
        <li><a href="#" onclick="retur()">返回</a></li>         
    </ul>   
</div> 
<?php
//连接数据库，获取班次信息
?>
<form method="post" name="form1" action="">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 <tr>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />票据类型：</span></td>
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
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />接收者编号：</span></td>
    <td bgcolor="#FFFFFF"><input type="text" name="InceptUserID" value="<?php echo $InceptUserID;?>"/></td> 
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />接收者单位：</span></td>
    <td colspan="4" bgcolor="#FFFFFF"><input type="text" name="UserSation" <?php if($userStationName!="全部车站") echo 'readonly';?> value="<?php if(isset($_POST['InceptUserID'])) echo $UserSation; else echo $userStationName;?>"/></td>
 </tr>
 <tr>
 	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />使用状态：</span></td>
    <td bgcolor="#FFFFFF">
    	<select name="UseState" >
			<?php
				if($UseState=='') echo "<option selected=\"selected\"></option>";
				else echo "<option></option>";
				if($UseState=='当前') echo "<option selected=\"selected\" value=\"当前\">当前</option>";
				else echo "<option  value=\"当前\">当前</option>";
				if($UseState=='退领') echo "<option selected=\"selected\" value=\"退领\">退领</option>";
				else echo "<option  value=\"退领\">退领</option>";
				if($UseState=='用完') echo "<option selected=\"selected\" value=\"用完\">用完</option>";
				else echo "<option  value=\"用完\">用完</option>";
			?>
      	</select> 
    </td>    
    <?php 
    	$sql="SELECT * FROM tms_bd_TicketProvide where tp_InceptUserID like '{$InceptUserID}%' AND tp_Type LIKE '{$Type}%'".$strsta.$str.$str1;
		$query =$class_mysql_default->my_query($sql);
    	while ($row = mysqli_fetch_array($query)){
			if($row['tp_UseState']!='退领'){
				$allInceptTicketNum=$allInceptTicketNum+$row['tp_InceptTicketNum'];
			}
    	}
    ?>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />出库日期：</span></td>
    <td colspan="2" nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="DataBeginDate" id="DataBeginDate" class="Wdate" value="<?php echo $DataBeginDate;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" />
    		&nbsp;&nbsp;至&nbsp;&nbsp;<input type="text" name="DataEndDate" id="DataEndDate" class="Wdate" value="<?php echo $DataEndDate;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
 	 <td nowrap="nowrap" bgcolor="#FFFFFF">余票数量：<?php echo  $allInceptTicketNum;?></td>
 </tr>
 <tr>    
    <td colspan="5" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="查询" onclick="document.form1.submit()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button2" id="backprovide" type="button" value="退领" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button3" type="button" value="返回" onclick="retur()">
    </td>
     <td nowrap="nowrap" bgcolor="#FFFFFF">领用总条数：<?php if($rows['number']=='') echo '0'; else echo $rows['number'];?></td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
  <tr>
   	<th nowrap="nowrap" align="center" bgcolor="#006699" style="display:none;">序号</th>
   	<th nowrap="nowrap" align="center" bgcolor="#006699">序号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">接收者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">接收者</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">接收者单位</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">发放日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">发放时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">开始票号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">当前票号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">结束票号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">余票数量</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">使用状态</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">票据类型</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">发放者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">发放者</th>
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
 		}
 		if (!$DataBeginDate && $DataEndDate){
 			$str="AND tp_ProvideData<='{$DataEndDate}'";
 		}
 		if ($DataBeginDate && $DataEndDate){
 			$str="AND tp_ProvideData>='{$DataBeginDate}' AND tp_ProvideData<='{$DataEndDate}'";
 		}
 		if(isset($_POST['InceptUserID'])){
 			$strsta=" AND tp_UserSation LIKE '{$UserSation}%'";
 		}else{
 		//	$str="AND tp_ProvideData>='{$curdate}' AND tp_ProvideData<='{$curdate}'";
 			$strsta=" AND tp_UserSation LIKE '{$userStationName}%'";
 		}
 	
		$sql="SELECT * FROM tms_bd_TicketProvide where tp_InceptUserID like '{$InceptUserID}%' AND tp_Type LIKE '{$Type}%'".$strsta.$str.$str1;
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
        <td nowrap="nowrap" align="center"><?php echo $row['tp_ProvideTime'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['tp_BeginTicket'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['tp_CurrentTicket'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['tp_EndTicket'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['tp_InceptTicketNum'];?></td>
        <td nowrap="nowrap" align="center"><?php if($row['tp_UseState'] == "当前" && $row['tp_InceptTicketNum'] == 0){echo "用完";} else{echo $row['tp_UseState'];}?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['tp_Type'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['tp_ProvideUserID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['tp_ProvideUser'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['tp_Remark'];?></td>
     </tr>
		<?php 
				}
	//		}
	
		?><!--
	<tr bgcolor="#CCCCCC">
		<td nowrap="nowrap" align="center">总计</td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"><?php echo $allInceptTicketNum;?></td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"></td>
     </tr>
		--><tr><td style="border:0px;"><input type="hidden" id="ID1" value=""/></td></tr>          
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>


