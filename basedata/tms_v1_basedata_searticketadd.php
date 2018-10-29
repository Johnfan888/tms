<?
//票据库存查询界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	
	if($userGroupID == "E")	require_once("../ui/user/topnoleft.inc.php");
	
//	if(isset($_POST['Type'])){
		$RegionCode2=$_POST['RegionCode2'];
		$Type=$_POST['Type'];
		$UserID1=$_POST['UserID'];
		$UserSation1=$_POST['UserSation'];
		$DataBeginDate=$_POST['DataBeginDate'];
		$DataEndDate=$_POST['DataEndDate'];
		
		$str='';
		$strsta='';
 		$curdate=date('Y-m-d');
 		$alladdmun=0;
 		$alllostnum=0;
 		if ($DataBeginDate && !$DataEndDate){
 			$str="AND ta_Data>='{$DataBeginDate}'";
 		}
 		if (!$DataBeginDate && $DataEndDate){
 			$str="AND ta_Data<='{$DataEndDate}'";
 		}
 		if ($DataBeginDate && $DataEndDate){
 			$str="AND ta_Data>='{$DataBeginDate}' AND ta_Data<='{$DataEndDate}'";
 		}
 		if(isset($_POST['Type'])){
 			$strsta=" AND ta_UserSation LIKE '{$UserSation1}%'";
 		}else{
 		//	$str="AND ta_Data>='{$curdate}' AND ta_Data<='{$curdate}'";
 			$strsta=" AND ta_UserSation LIKE '{$userStationName}%'";
 		}
 		
		$sql1="SELECT COUNT(ta_ID) AS number FROM tms_bd_TicketAdd WHERE ta_Type LIKE '{$Type}%' AND ta_UserID LIKE '{$UserID1}%'".$strsta.$str;
		$query1 =$class_mysql_default->my_query($sql1);
		$rows = mysqli_fetch_array($query1);
//	}
	if($RegionCode2 == 'excel'){
		  $file_name = "searticketadd.csv";
		  header("Content-Type: application/vnd.ms-excel; charset=$DefaultLang");
		  header("Content-Disposition: attachment; filename=$file_name");
		  header("Cache-Control: no-cache, must-revalidate");
		  $fp = fopen('php://output', 'w'); //打开php文件句柄
		  $out = array('', '', '', '', '',  '票据库存管理信息表', '', '', '', '', '', '', '', '');
		  fputcsv($fp, $out);
		  $head = array('序号', '入库日期', '入库时间', '开始票号', '结束票号', '当前票号', '入库量', '库存量', '票据类型', '入库者编号', '入库者', '入库者单位', '备注');
		  fputcsv($fp, $head);
		
		  $cnt = 0; //计数器
		  $limit = 100000; //每隔100000行，刷新输出buffer
		  $outputRow = "";
		  $queryString = "SELECT ta_ID,ta_Data,ta_Time,ta_BeginTicket,ta_EndTicket,ta_CurrentTicket,
		  				  ta_AddNum,ta_LostNum,ta_Type,ta_UserID,ta_User,ta_UserSation,ta_Remark FROM tms_bd_TicketAdd WHERE  ta_Type LIKE '{$Type}%' AND ta_UserID LIKE '{$UserID1}%'".$strsta.$str;
		  $result = $class_mysql_default->my_query("$queryString");
		  $i=0;
		  while ($row = mysqli_fetch_array($result)) {
		  	$i++;
			$cnt++; 
			if ($limit == $cnt) { //刷新输出buffer
				ob_flush(); 
				flush(); 
				$cnt = 0; 
				}
				
			$outputRow = array($i, $row['ta_Data'], $row['ta_Time'], $row['ta_BeginTicket'], $row['ta_EndTicket'], 
        		$row['ta_CurrentTicket'], $row['ta_AddNum'], $row['ta_LostNum'], $row['ta_Type'], $row['ta_UserID'],$row['ta_User'], $row['ta_UserSation'],$row['ta_Remark']); 
				fputcsv($fp, $outputRow); 
		    }
		    fclose($fp);
			exit(); 
		}	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" > 
<html> 
<head> 
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="tms_v1_rightclick.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#button1').click(function(){
		document.getElementById('RegionCode2').value='';
		document.form1.submit();
	});	
	$('#exceldoc').click(function(){
		document.getElementById('RegionCode2').value='excel';
		document.form1.submit();
		document.getElementById('RegionCode2').value='';
		});
});
$(document).ready(function(){
	$("#table1").tablesorter();
	$("#table1 tr").mouseover(function(){$(this).css("background-color","#F1E6C2");});
	$("#table1 tr").mouseout(function(){$(this).css("background-color","#CCCCCC");});
	$("#table1 tr").click(function(){
		var menu=document.getElementById("menu");   
		menu.style.display="none"; 
		$("#table1 tr:not(this)").css("background-color","#CCCCCC");
		$("#table1 tr:not(this)").mouseover(function(){$(this).css("background-color","#F1E6C2");});
		$("#table1 tr:not(this)").mouseout(function(){$(this).css("background-color","#CCCCCC");});
		$(this).css("background-color","#FFCC00");
		$(this).mouseover(function(){$(this).css("background-color","#FFCC00");});
		$(this).mouseout(function(){$(this).css("background-color","#FFCC00");});
		$("#ID1").val($(this).children().eq(0).text());
		$("#UserID2").val($(this).children().eq(10).text());
		$("#UserSation").val($(this).children().eq(12).text());
		$("#remark").val($(this).children().eq(13).text());
		$("#LostNum1").val($(this).children().eq(8).text());
	});
});
function add(){
	window.location.href='tms_v1_basedata_ticketadd.php';
}
function searticketprovide(){
	window.location.href='tms_v1_basedata_searticketprovide.php';
}
function ticketprovide(){
	if (document.getElementById("ID1").value=="" || document.getElementById("ID1").value=="总计" ){
		alert('请选择票据！');
		return false;
	}
	if(document.getElementById("remark").value=="注销"){
		alert('该票据已注销！');
		return false;
	}
	if(document.getElementById("LostNum1").value==0){
		alert('库存量为0，无法领用。请重新选择！');
		return false;
	}
	window.location.href='tms_v1_basedata_ticketprovide.php?op=provide&clnumber='+document.getElementById("ID1").value;
}
function ticketwithdraw(){
	if (document.getElementById("ID1").value=="" || document.getElementById("ID1").value=="总计"){
		alert('请选择票据！');
		return false;
	}
	if(document.getElementById("remark").value=="注销"){
		alert('该票据已注销！');
		return false;
	}
	if(!confirm("确定要注销该票据吗？")){
		return false;
	}
	jQuery.get(
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'ticketwithdraw', 'ID': $("#ID1").val(),'time': Math.random()},
			function(data){
			//	alert(data);
				var objData = eval('(' + data + ')');
				if( objData.sucess=='1'){
					alert('注销成功！');
					document.form1.submit();
				}else{
					alert('注销失败！');
				}
		});
}
function del(){
	if(!confirm("确定要删除该数据吗？")){
		return false;
	}
}
function back(){
	if(!confirm("确定要退回该票吗？")){
		return false;
	}
}
function stationtake(){
	if (!document.getElementById("ID1").value){
		alert('请选择票据！');
		return false;
	}
	if(document.getElementById("UserSation").value!='全部车站'){
		alert('该票据已被车站领用！');
		return false;
	}
	window.location.href='tms_v1_basedata_stationtaketicket.php?op=provide&clnumber='+document.getElementById("ID1").value;
	
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<link href="../css/tms.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">票 据 库 存 查 询</span></td>
  </tr>
</table>
<div id="menu" style="display: none">   
	<ul>   
		<li><a href="#" onclick="add()">票据入库</a></li>
<!--
		<li><a href="#" onclick="stationtake()">车站领用</a></li>
-->
		<li><a href="#" onclick="ticketwithdraw()">票据注销</a></li>     
        <li><a href="#" onclick="ticketprovide()">票据领用</a></li>   
        <li><a href="#" onclick="searticketprovide()">票据领用查询</a></li>       
    </ul>   
</div> 
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
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />入库者编号：</span></td>
    <td bgcolor="#FFFFFF"><input type="text" name="UserID" id="UserID" value="<?php echo $UserID1;?>" /></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />入库者单位：</span></td>
    <td colspan="3" bgcolor="#FFFFFF"><input type="text" name="UserSation" id="UserSation" <?php if($userStationName!="全部车站") echo 'readonly';?>  value="<?php if(isset($_POST['Type'])) echo  $UserSation1; else echo $userStationName;?>" /></td>
 </tr>
 <?php 
 $sql="SELECT * FROM tms_bd_TicketAdd WHERE  ta_Type LIKE '{$Type}%' AND ta_UserID LIKE '{$UserID1}%'".$strsta.$str;
		$query =$class_mysql_default->my_query($sql);
		while ($row = mysqli_fetch_array($query)){
				$alladdmun=$alladdmun+$row['ta_AddNum'];
				$alllostnum=$alllostnum+$row['ta_LostNum'];
			}
 ?>
 <tr>   
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />入库日期：</span></td>
    <td colspan="3" nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="DataBeginDate" id="DataBeginDate" class="Wdate" value="<?php echo $DataBeginDate;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" />
    		&nbsp;&nbsp;至&nbsp;&nbsp;<input type="text" name="DataEndDate" id="DataEndDate" class="Wdate" value="<?php echo $DataEndDate;?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />入库量：<?php echo $alladdmun;?></span></td>
     <td nowrap="nowrap"  colspan="3" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />库存量：<?php echo $alllostnum;?></span></td>
 </tr>
 <tr> 
    <td colspan="4" nowrap="nowrap" bgcolor="#FFFFFF">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="票据库查询" id="button1"/>
    	&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="票据入库" onclick="add()">
    	&nbsp;&nbsp;&nbsp;<input name="button5" type="button" value="票据注销" onclick="ticketwithdraw()">
    <!--  
    	&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="车站领用" onclick="stationtake()">
    -->
    	&nbsp;&nbsp;&nbsp;<input name="button3" type="button" value="票据领用" onclick="ticketprovide()">
    	&nbsp;&nbsp;&nbsp;<input name="button4" type="button" value="票据领用查询" onclick="searticketprovide()">
    	&nbsp;&nbsp;&nbsp;<input name="exceldoc" id="exceldoc" type="button" value="导出Excel">
    </td>
     <td nowrap="nowrap" bgcolor="#FFFFFF" colspan="5"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />票据总条数：<?php if($rows['number']=='') echo '0'; else echo $rows['number'];?></span></td>
  </tr>
</table>
<div id="tableContainer" class="tableContainer" > 
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">
  <tr>
  	<th nowrap="nowrap" align="center" bgcolor="#006699" style="display:none;">序号</th>
  	<th nowrap="nowrap" align="center" bgcolor="#006699">序号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">入库日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">入库时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">开始票号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">结束票号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">当前票号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">入库量</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">库存量</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">票据类型</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">入库者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">入库者</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">入库者单位</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
<!--  
    <td nowrap="nowrap" align="center" bgcolor="#006699">操作</td>
-->
  </tr>
  </thead>
 <tbody class="scrollContent">
  <?php
 	if($RegionCode2 == ''){
  		$i=0;
		$sql="SELECT * FROM tms_bd_TicketAdd WHERE  ta_Type LIKE '{$Type}%' AND ta_UserID LIKE '{$UserID1}%'".$strsta.$str;
		$query =$class_mysql_default->my_query($sql);
		//if (!$query) echo "SQL错误：".$class_mysql_default->my_error();
		while ($row = mysqli_fetch_array($query)){
				$i++;
			if($row['ta_Remark']!='注销'){
			}
	?>
	<tr bgcolor="#CCCCCC">
        <td nowrap="nowrap" align="center" style="display:none;"><?php echo $row['ta_ID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $i?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['ta_Data'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['ta_Time'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['ta_BeginTicket'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['ta_EndTicket'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['ta_CurrentTicket'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['ta_AddNum'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['ta_LostNum'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['ta_Type'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['ta_UserID'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['ta_User'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['ta_UserSation'];?></td>
        <td nowrap="nowrap" align="center"><?php echo $row['ta_Remark'];?></td>
<!-- 
        <td nowrap="nowrap" align="center">
        	<a href=tms_v1_basedata_delticketadd.php?op=del&clnumber=<?php echo $row['ta_ID'];?>  onclick='return back();'>[删除]</a>
 -->
        <!-- 
        	<a <?php if($row['ta_UserSation']=='全部车站') echo "href=tms_v1_basedata_delticketadd.php?op=del&clnumber=".$row['ta_ID']." onclick='return del();'"; else if($userStationName=='全部车站') echo "href=tms_v1_basedata_backstationticket.php?op=back&clnumber=".$row['ta_ID']." onclick='return back();'";?>><?php if($row['ta_UserSation']=='全部车站') echo '[删除]'; else if($userStationName=='全部车站') echo '[退领]'; ?></a>
         -->
        <!--
        	<a href=tms_v1_basedata_backstationticket.php?op=back&clnumber=<?php echo $row['ta_ID'];?>  onclick='return back();'>[退领]</a>
         -->
<!--  
        </td>
-->
      </tr>
		<?php 
				}
			}
		?><!-- 
		<tr  bgcolor="#CCCCCC">
		<td nowrap="nowrap" align="center" style="display:none;"></td>
        <td nowrap="nowrap" align="center">总计</td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"><?php echo $alladdmun;?></td>
        <td nowrap="nowrap" align="center"><?php echo $alllostnum;?></td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"></td>
        <td nowrap="nowrap" align="center"></td>
 --><!-- 
        <td nowrap="nowrap" align="center"></td>
  -->
 	    <tr>
			<td>
				<input type="hidden" id="ID1" value=""/>
				<input type="hidden" id="UserID2" value=""/>
				<input type="hidden" id="UserSation" value=""/>
				<input type="hidden" id="remark" value=""/>
				<input type="hidden" id="LostNum1" value=""/>
				<input type="hidden" id="RegionCode2" value="" name="RegionCode2"/>
			</td>
		</tr> 
</tbody> 
</table> 
</div> 
</form>
</body> 
</html>

