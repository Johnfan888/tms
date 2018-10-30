<?php 
//添加车辆收费项目界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber=$_GET['clnumber'];
	$selects="SELECT * FROM tms_acct_BusRate WHERE br_BusID='{$clnumber}'";
	$querys=$class_mysql_default->my_query($selects);
	$rows=mysqli_fetch_array($querys);
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
function adddo(){
	if(document.addpro.BusID.value == ""){
		alert("车辆编号不能为空!");
		return false;
	}
	if(document.addpro.BusNumber.value == ""){
		alert("车牌号不能为空!");
		return false;
	}
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
		<td bgcolor="#FFFFFF">
		<input type="text" name="BusNumber" id="BusNumber" value="<?php echo $rows['br_BusNumber'];?>" readonly="readonly"/><span style="color:red">*</span></td>
	</tr> 
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车辆编号：</span></td>
        <td bgcolor="#FFFFFF"><input type="text" name="BusID" id="BusID" value="<?php echo $clnumber;?>" readonly="readonly"/></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="BusType" id="BusType" value="<?php echo $rows['br_BusType'];?>" readonly="readonly"/></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="BusUnit" id="BusUnit" value="<?php echo $rows['br_BusUnit'];?>" readonly="readonly"/></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站编号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="InStationID" id="InStationID" value="<?php echo $rows['br_InStationID'];?>" readonly="readonly"/></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属车站：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="InStation" id="InStation" value="<?php echo $rows['br_InStation'];?>" readonly="readonly"/></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />经营线路：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="LineName" id="LineName" value="<?php echo $rows['br_LineName'];?>" readonly="readonly"/></td>
	</tr>
	<?php 
		$i=0;
		$selected="SELECT ft_FeeTypeName,ft_FeeTypeComputer FROM tms_bd_FeeType";
		$queryed=$class_mysql_default->my_query($selected);
		while($row=mysqli_fetch_array($queryed)){
	?> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /><?php echo $row['ft_FeeTypeName'];?>：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Rate<?php echo $i;?>" id="Rate<?php echo $i;?>" value="<?php echo $rows[7+$i];?>" onkeyup="return isnumber(this.value,this.id)"/><span style="color:red"><?php if($row['ft_FeeTypeComputer']=='按百分比收费') echo '%'; else echo '元';?></span></td>
	</tr>
	<?php 
			$i=$i+1;
		}
	?>
<!--  
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />开始时间：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="BeginDate" id="BeginDate"  value="<?php echo $rows['br_BeginDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td>
	</tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />结束时间：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="EndDate" id="EndDate"  value="<?php echo $rows['br_EndDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td>
	</tr>
-->
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="submit1" type="submit" value="修改" onclick="return adddo();" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="search();">&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>
<?php
	if(isset($_POST['submit1'])){
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
		$update="UPDATE tms_acct_BusRate SET br_Rate1='{$Rate[0]}',br_Rate2='{$Rate[1]}',br_Rate3='{$Rate[2]}',br_Rate4='{$Rate[3]}',br_Rate5='{$Rate[4]}',
			br_Rate6='{$Rate[5]}',br_Rate7='{$Rate[6]}',br_Rate8='{$Rate[7]}',br_Rate9='{$Rate[8]}',br_Rate10='{$Rate[9]}',br_Rate11='{$Rate[10]}',
			br_Rate12='{$Rate[11]}',br_Rate13='{$Rate[12]}',br_Rate14='{$Rate[13]}',br_Rate15='{$Rate[14]}', br_BeginDate='{$BeginDate}',br_EndDate='{$EndDate}',
			br_ModerID='{$userID}',br_Moder='{$userName}',br_ModTime='{$CurTime}' WHERE br_BusID='{$BusID}'";
		$query = $class_mysql_default->my_query($update);
		if($query){
				echo"<script>alert('修改成功！');window.location.href='tms_v1_basedata_modbusfee.php?op=mod&clnumber=$clnumber'</script>";
			}else{
				echo $class_mysql_default->my_error();
				echo"<script>alert('修改失败！');window.location.href='tms_v1_basedata_modbusfee.php?op=mod&clnumber=$clnumber'</script>";
			}
	}
?>
