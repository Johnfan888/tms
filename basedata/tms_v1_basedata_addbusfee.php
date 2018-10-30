<?php 
//添加车辆收费项目界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#BusNumberselect").blur(function(){
		var BusNumber = document.getElementById("BusNumber").value;
		jQuery.get( 
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'addbusfee', 'BusNumber': BusNumber, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if( objData.sucess=='1'){
						document.getElementById('code').style.display="";
					}
					else{
						document.getElementById('code').style.display="none";
					}
		});
	});	
	$("#BusNumber").keyup(function(){
		var BusNumber = document.getElementById("BusNumber").value;
		jQuery.get(
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'addbusfee', 'BusNumber': BusNumber, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if( objData.sucess=='1'){
						document.getElementById('code').style.display="";
					}
					else{
						document.getElementById('code').style.display="none";
					}
		});
	});	
});
function adddo(){
	if(document.addpro.BusID.value == ""){
		alert("车辆编号不能为空!");
		return false;
	}
	if(document.addpro.BusNumber.value == ""){
		alert("车牌号不能为空!");
		return false;
	}
	var BusNumber = document.getElementById("BusNumber").value;
	jQuery.get( //查看驾驶员编号是否唯一
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'addbusfee', 'BusNumber': BusNumber, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if( objData.sucess=='1'){
					alert('该车辆已存在，请重新输入！');
						return false;
				}
				else{
			 		document.addpro.submit();}
	});
}

function isnumber(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value='';
		return false;
		}
}

function search(){
	window.location.href='tms_v1_basedata_searbusfee.php';
}
$(document).ready(function(){
	$("#BusNumber").keyup(function(){
		$("#BusNumberselect").empty();
		document.getElementById("BusNumberselect").style.display=""; 
		var BusNumber = $("#BusNumber").val();
		jQuery.get(
			'tms_v1_basedata_getbusdata.php',
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
		document.getElementById("BusNumber").value=document.getElementById("BusNumberselect").value;
		document.getElementById("BusNumberselect").style.display="none";
		var BusNumber = $("#BusNumber").val();
		jQuery.get(
			'tms_v1_basedata_getbusdata.php',
			{'op': 'getbusdata', 'BusNumber': BusNumber, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if(objData.retVal == "FAIL"){ 
					alert(objData.retString);
				}else{
					document.getElementById("BusID").value=objData.BusID;
					document.getElementById("BusType").value=objData.BusType;
					document.getElementById("BusUnit").value=objData.BusUnit;
					document.getElementById("InStationID").value=objData.InStationID;
					document.getElementById("InStation").value=objData.InStation;
					document.getElementById("LineName").value=objData.ManagementLine;
				}
		});
	};
});
$(document).click(function(){
	document.getElementById("BusNumberselect").style.display="none";
});
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 车 辆 收 费 项 目  </span></td>
  </tr>
</table>
<?php
//连接数据库，获取班次信息
?>
<form id="addpro" name="addpro" method="post" action="" >
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
		<td bgcolor="#FFFFFF"><input type="text" name="BusNumber" id="BusNumber" /><span style="color:red">*</span><span style="color:red" style="display:none" id="code">该车牌号已存在,请重新输入！</span>
			<br/>
	    	<select id="BusNumberselect" name="BusNumberselect" class="helplay" multiple="multiple" style="display:none;height:90px" size="20" ></select>
	    </td>
	</tr> 
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车辆编号：</span></td>
        <td bgcolor="#FFFFFF"><input type="text" name="BusID" id="BusID" readonly="readonly"/></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="BusType" id="BusType" readonly="readonly"/></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="BusUnit" id="BusUnit" readonly="readonly"/></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站编号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="InStationID" id="InStationID" readonly="readonly"/></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="InStation" id="InStation" readonly="readonly"/></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />经营线路：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="LineName" id="LineName" readonly="readonly"/></td>
	</tr>
	<?php 
		$i=0;
		$selected="SELECT ft_FeeTypeName,ft_FeeTypeComputer,ft_FeePercent,ft_FeeFix FROM tms_bd_FeeType";
		$queryed=$class_mysql_default->my_query($selected);
		while($row=mysqli_fetch_array($queryed)){
	?> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /><?php echo $row['ft_FeeTypeName'];?>：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Rate<?php echo $i;?>" id="Rate<?php echo $i;?>" onkeyup="return isnumber(this.value,this.id)"
    	<?php if($row['ft_FeeTypeComputer']=='按百分比收费'){?> value="<?php echo $row['ft_FeePercent'];?>" 
    	<?php }if($row['ft_FeeTypeComputer']=='固定金额收费'){?> value="<?php echo $row['ft_FeeFix'];?>" <?php }?>/>
    	<span style="color:red"><?php if($row['ft_FeeTypeComputer']=='按百分比收费') echo '%'; else echo '元';?></span></td>
	</tr>
	<?php 
			$i=$i+1;
		}
	?>
<!--  
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />开始时间：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="BeginDate" id="BeginDate"  class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />结束时间：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="EndDate" id="EndDate"  class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td>
	</tr>
-->
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="button1" type="button" value="添加" onclick="return adddo();" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="search();">&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>
<?php
	if(isset($_POST['BusID'])){
		$Rate=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		$BusID = $_POST['BusID'];
		$BusNumber = $_POST['BusNumber'];
		$BusType=$_POST['BusType'];
		$BusUnit = $_POST['BusUnit'];
		$InStationID=$_POST['InStationID'];
		$InStation = $_POST['InStation'];
		$LineName=$_POST['LineName'];
		$BeginDate=$_POST['BeginDate'];
		$EndDate=$_POST['EndDate'];
		$CurTime=date('Y-m-d H:i:s');
		for($j=0;$j<$i;$j++){
			$s='Rate'.$j;
			$Rate[$j]=$_POST[$s];
		//	echo $Rate[$j];
		}
		$select="select br_BusID from tms_acct_BusRate where br_BusID='{$BusID}'";
		$sele=$class_mysql_default->my_query($select);
		if(!mysqli_fetch_array($sele)){
			$insert="INSERT INTO `tms_acct_BusRate` (br_BusID,br_BusNumber, br_BusType, br_BusUnit,br_InStationID,br_InStation,br_LineName,br_Rate1,
				br_Rate2,br_Rate3,br_Rate4,br_Rate5,br_Rate6,br_Rate7,br_Rate8,br_Rate9,br_Rate10,br_Rate11,br_Rate12,br_Rate13,br_Rate14,br_Rate15,
				br_BeginDate,br_EndDate,br_AdderID,br_Adder,br_AddTime) 
				VALUES ('{$BusID}', '{$BusNumber}','{$BusType}','{$BusUnit}','{$InStationID}','{$InStation}','{$LineName}','{$Rate[0]}','{$Rate[1]}',
				'{$Rate[2]}','{$Rate[3]}','{$Rate[4]}','{$Rate[5]}','{$Rate[6]}','{$Rate[7]}','{$Rate[8]}','{$Rate[9]}','{$Rate[10]}','{$Rate[11]}',
				'{$Rate[12]}','{$Rate[13]}','{$Rate[14]}','{$BeginDate}','{$EndDate}','{$userID}','{$userName}','{$CurTime}')";
			$query = $class_mysql_default->my_query($insert);
			if($query){
				echo"<script>alert('添加成功！')</script>";
			}else{
				echo $class_mysql_default->my_error();
				echo"<script>alert('添加失败！')</script>";
			}
		}else{
			echo"<script>alert('该车辆已存在，请重新输入！')</script>";
		}
	}
?>
