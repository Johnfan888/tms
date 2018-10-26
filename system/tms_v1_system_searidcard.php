<?php 
	define("AUTH", "TRUE");
	require_once("../ui/inc/init.inc.php");
	$card=$_POST['card'];
    $busnumber=$_POST['busnumber'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>车辆卡信息</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../basedata/tms_v1_screen1.js"></script>
		<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script language="javascript">

function addcard(){
	window.location.href='tms_v1_system_addidcard.php';
}

function modcard(){
	if (!document.getElementById("idcard").value){
		alert('请选择区域！');
		return false;
	}else{
		window.location.href='tms_v1_system_modidcard.php?op=mod&clnumber='+document.getElementById("idcard").value;
		}
}
$(document).ready(function(){
	$("#del").click(function(){
		delidcard()
	});
});
$(document).ready(function(){
	$("#dell").click(function(){
		delregion()
	});
});
function delidcard(){
	if (!document.getElementById("idcard").value){
		alert('请选择区域！')
		return false
	}else{
		if(!confirm("确定删除该车辆卡信息吗？")){
			return false;
		}else{
			var idcard = $("#idcard").val();
			//alert('idcard');
			jQuery.get(
					'tms_v1_system_delidcard.php',
					{'op': 'del', 'idcard': idcard, 'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if( objData.sucess=='1'){
							alert('删除成功！');
							document.form.submit();
						}else{
							alert('删除失败！');
						}
				});
		}
	}
}
$(document).ready(function(){
	$("#card").focus();
	$("#card").keyup(function(e){
		if(e.keyCode == 13){
			//alert($("#busID").val());
			jQuery.get(
				'../ui/inc/manageIC.php',
				{'op': 'GETBUSINFO', 'busIC': $("#card").val(), 'time': Math.random()},
				function(data){
					//alert(data);
					var objData = eval('(' + data + ')');
					if(objData.bc_BusID == null || objData.bc_BusID == ""){ 
						alert("此卡车辆不存在！请检查。");
						$("#card").val("");
					}
					else{
						$("#card").val(e.value);
					}
			});
		}
		else {
			$("#card").val(e.value);
		}
	});
});
$(document).ready(function(){
	$("#busnumber").keyup(function(){
		$("#BusNumberselect").empty();
		document.getElementById("BusNumberselect").style.display=""; 
		var BusNumber = $("#busnumber").val();
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
		document.getElementById("busnumber").value=document.getElementById("BusNumberselect").value;
		document.getElementById("BusNumberselect").style.display="none";
	};
	});
</script>
	</head>
	<body>
		<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
		  <tr>
		    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
		    <span class="graytext" style="margin-left:8px;">车辆信息卡管理 </span></td>
		  </tr>
		</table>
	<div id="menu" style="display: none">   
		<ul>   
		<li><a href="tms_v1_system_addidcard.php">添加区域</a></li>   
        <li><a href="#" onclick="modcard()">修改区域</a></li>   
        <li><a href="#" id="dell">删除区域</a></li>     
   		 </ul>   
	</div> 
	<form method="post" name="form" action="">
	<table width="100%" align="center" border="1" cellpadding="3" cellspacing="1" style=”TABLE-LAYOUT:fixed”>
 		<tr>
    		<td nowrap="nowrap" bgcolor="#FFFFFF" width="20%"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />IC卡号：</span></td>
    		<td nowrap="nowrap" bgcolor="#FFFFFF" width="30%"><input type="text" id="card" name="card" /></td>
    		<td nowrap="nowrap" bgcolor="#FFFFFF" width="20%"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
   			<td bgcolor="#FFFFFF" nowrap="nowrap" width="30%"><input type="text" name="busnumber" id="busnumber" />
    		<br/>
			<select id="BusNumberselect" name="BusNumberselect" class="helplay" multiple="multiple" style="display:none;height:90px;" size="50" ></select>
			</td>
  		</tr>
  		<tr >
   			<td align="center" nowrap="nowrap" bgcolor="#FFFFFF"  colspan="3">
    	&nbsp;&nbsp;&nbsp;<input name="button1" type="button" value="车辆信息卡查询" onclick="document.form.submit()"/>
    	&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="添加车辆信息卡" onclick="addcard()" />
    	&nbsp;&nbsp;&nbsp;<input name="button3" type="button" value="修改车辆信息卡" onclick="modcard()" />
    	&nbsp;&nbsp;&nbsp;<input name="button4" id="del" type="button" value="删除车辆卡信息" />
    		</td>
    		<?php 
    		if($userStationID=="all"){
       		$sql1="select count(bc_CardID) as number from tms_bd_BusCard where bc_CardID like '%$card%' AND bc_BusNumber like '%$busnumber%'";
       		//echo $sql1;
  		}
  		else{
			$sql1="select count(*) from tms_bd_BusCard WHERE bc_CardID like '%$card%' AND bc_BusNumber like '%$busnumber%' AND bc_Station ='$userStationName'";
  		}
  			$result1=$class_mysql_default->my_query($sql1);
			$num=mysqli_fetch_row($result1);
	?>
    		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />总数：<?php  echo $num['0'] ?></span></td>
  </tr>
</table>
	

<div id="tableContainer" class="tableContainer" >
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader"> 
  <tr>
   	<th nowrap="nowrap" align="center" bgcolor="#006699">卡号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">注册日期</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">状态</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">所属车站编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">所属车站</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">添加者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">添加者</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">修改者编号</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">修改者</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">修改时间</th>
    <th nowrap="nowrap" align="center" bgcolor="#006699">备注</th>
  </tr>
  </thead> 
<tbody class="scrollContent">
<?php 
       	$card=$_POST['card'];
       	$busnumber=$_POST['busnumber'];
       	if($userStationID=="all"){
       		$sql = "SELECT * FROM tms_bd_BusCard WHERE bc_CardID like '%$card%' AND bc_BusNumber like '%$busnumber%'";
  		}
  		else{
			$sql = "SELECT * FROM tms_bd_BusCard WHERE bc_CardID like '%$card%' AND bc_BusNumber like '%$busnumber%' AND bc_Station ='$userStationName'";
  		}
			$query =$class_mysql_default->my_query($sql);
			while ($row = mysqli_fetch_array($query)) {
		
?>
	<tr  id="tr" bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'idcard')">
		<td align="center" nowrap="nowrap"><?php echo $row['bc_CardID'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['bc_BusID'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['bc_RegDate'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['bc_BusNumber'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['bc_state'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['bc_StationID'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['bc_Station'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['bc_adderID'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['bc_addpeople'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['bc_modderID'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['bc_modpeople'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['bc_moddate'];?></td>
		<td align="center" nowrap="nowrap"><?php echo $row['bc_Remark'];?></td>
	</tr> 
	<tr><td><input type="hidden" id="idcard" value=""/></td></tr>
	<?php 
			}
	//	}
	?> 
</tbody>
</table>
</div>
</form>
</body>
</html>
