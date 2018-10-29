<?php 
define("AUTH", "TRUE");
require_once("../ui/inc/init.inc.php");

?>
<html>
	<head>
	<title>查询</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="../basedata/tms_v1_screen1.js"></script>
	<link href="../css/tms.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
	function doubleclick(target,str){  //双击事件
		var sTable = document.getElementById("table1");
		for(var i=1;i<sTable.rows.length;i++){
			if (sTable.rows[i]==target){
				document.getElementById(str).value=sTable.rows[i].cells[0].innerText;
				opener.document.getElementById("delreason").value=document.getElementById("RegionCode1").value;
				window.close();
			}
		}  
	}
	function delresult(){ //删除记录
		if (!document.getElementById("RegionCode1").value){
			alert('请选择删除的记录！')
			return false
		}else{
			if(!confirm("确定要删除此记录吗？")){
				return false;
			}else{
				var result = $("#RegionCode1").val();
				jQuery.get(
						'tms_v1_basedata_deleteresult.php',
						{'op': 'del', 'result': result, 'time': Math.random()},
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
		function addresult(){
			if (!document.getElementById("RegionCode1").value){
				alert('请选择原因！')
				return false;}
			else{
				opener.document.getElementById("delreason").value=document.getElementById("RegionCode1").value;
				window.close();}
		}
		function cancle(){
			window.close();}

		function AddInfo(url){
			window.open(url,'查询','width=500,height=400,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no');
//			width=screen.width;
//			height=screen.height;
//			proc.moveTo((width-400)/2,(height-70)/2);
		}
	</script>
	</head>
    <body>
    	<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
			<tr >
				<td bgcolor="#f0f8ff">
				<img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14"/>
				<span class="graytext" style="margin-left:8px;">销票原因  </span>
				</td>
			</tr>
		</table >
		<form action="" method="post" name="form1" id="from1">
		<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />助记码：</span></td>	
				<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text" name="Name"></td>
				<td align="center" nowrap="nowrap" bgcolor="#FFFFFF">
					<input type="submit"  name="submit2" value="查找">&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="submit" name="submit1" value="增加" onClick="AddInfo('tms_v1_basedata_adderrorresult.php')">&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" name="button1" value="删除" onClick="delresult()">
				</td>
			</tr>
		</table>
		</form>
		<div id="tableContainer" class="tableContainer"> 
			<table class="main_tableboder" id="table1" > 
				<thead class="fixedHeader"> 
    				<tr bgcolor="#006699">
      					<th align="center" nowrap="nowrap">字典名称</th>
      					<th align="center" nowrap="nowrap">助记码</th>
      				</tr>
      			</thead> 
				<tbody class="scrollContent"> 
      	   <?php 
      	  // if(!isset($_REQUEST['submit2'])){
      	   $name=$_REQUEST['Name'];
      	   $str="SELECT * FROM tms_ticket_DelResult WHERE dr_mncode like '%$name%'";
      	   $result=$class_mysql_default->my_query($str);
      	   while($row=mysqli_fetch_array($result)){
      	   ?>
      	   <tr  bgcolor="#CCCCCC" onMouseOver="rowOver(this)" onMouseOut="rowOut(this)" onClick="selectRow(this,'RegionCode1')" onDblClick="doubleclick(this,'RegionCode1')">
      	  	 <td  align="center" id="select" nowrap="nowrap"><?php echo $row['dr_Desp']?></td>
      	  	 <td  align="center" id="select" nowrap="nowrap"><?php echo $row['dr_mncode']?></td>
      	  </tr>
      	  </tbody>
      	  <?php 
      	   		}
      	  ?>
      	   </table>
      	   <table width="100%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
      	      <tr bgcolor="#FFFFFF">
      	   		<td align="center" colspan="2">
				<input type="button" name="select" value="选择" onClick="addresult()" >&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" name="cancle" value="取消" onClick="cancle()" >
				<input type="hidden" id="RegionCode1" value = "" name="RegionCode1"/></td></tr>
      	</table>
      </div>
    </body>
</html>