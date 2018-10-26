<?php 
define("AUTH", "TRUE");
require_once("../ui/inc/init.inc.php");
?>
<html>
	<head>
	<title>添加原因</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript">
	function cancle(){
		window.close();
	}

	function text(){
		var Name=document.form1.Name.value;
		if(Name == ""){
			alert("字典名称不能为空");
			return false;}
	}
	</script>
	</head>
	<body>
	<table width="100%" border="1"> 
			<tr bgcolor="#f0f8ff">
				<td bgcolor="#f0f8ff">
				<img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14"/>&nbsp;&nbsp;添加原因：
				</td>
			</tr>
	</table >
	<form action="" method="post" name="form1" id="form1" enctype="multipart/form-data">
   	 	<table width="80%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
		<tr bgcolor="#ffffff">
			<td >字典名称：</td>
			<td align="center"><input type="text" name="Name"></td> 
		</tr>
		<tr bgcolor="#ffffff">
			<td>助记码：</td>
			<td align="center"><input type="text" name="mncode"></td> 
		</tr>
		
		<tr bgcolor="#ffffff"  align="center">
			<td colspan="2" align="center">
			<input type="submit" name="submit1" value="保存" onClick="return text()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button" name="button1" value="关闭" onClick="cancle()">
			</td>
			<?php 
			if(isset($_REQUEST['Name'])){
			$Name=$_REQUEST['Name'];
			$mncode=$_REQUEST['mncode'];
			$query="SELECT * FROM tms_ticket_ErrDelResult WHERE er_Desp='$Name'";
			$result=$class_mysql_default->my_query($query);
			$rows=mysqli_fetch_array($result);
			if($rows['er_Desp'] != null){
				echo "<script>";
    			echo "alert('已经存在此原因！！')";
    			echo "</script>";
			}
			else{
			$str="INSERT INTO tms_ticket_ErrDelResult(er_Desp,er_mncode) values('$Name','$mncode')";
			$result=$class_mysql_default->my_query($str);
				if($result){
    			 	echo "<script>";
    			 	echo "alert('操作成功')";
    			 	echo "</script>"; }
    			else{
    			    echo "<script>";
    			 	echo "alert('操作失败')";
    			   	echo "</script>"; }
				}
			}
			?>
		</tr>
		</table>
	  </form>

	</body>
</html>
