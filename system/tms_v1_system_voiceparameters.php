<?php
//define("AUTH", "TRUE");
require_once("../ui/inc/init.inc.php");
	if(isset($_POST['submit1'])){
		$str="SELECT * FROM tms_sch_PreviousTime WHERE pt_Code='2'";
		$result=mysql_query($str);
		$row=mysql_fetch_array($result);
	}
?>
<html>
	<head>
		<title>语音播报参数管理界面</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
		function modinfo(){
			window.open('tms_v1_system_modvoiceparameters.php','','width=800,height=450')
		}
		</script>
</head>
	<body>
		<table  width="100%" height="45" border="1" align="center" cellpadding="3" cellspacing="1" class="main_tableboder">
			<tr>
				<td height="43" bordercolor="#999999" bgcolor="#f0f8ff" align="center"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="15" height="19" />
				<span style="font-size:20px; width:auto" >参数管理界面</span>
				</td>
  			</tr>
		</table>
		<form id="addpro" name="addpro" method="post" action="" enctype="multipart/form-data">
		<table  border="0" align="center" cellpadding="3" cellspacing="1" width="70%" >
			<tr>
				<td align="center" >
				<input type="submit" name="submit1" value="查看参数" onMouseOver="this.style.color='blue'" onMouseOut= "this.style.color='black'" style="background-color:#CCCCCC  ; width:100px"> 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" name="button1" value="修改参数" onMouseOver="this.style.color='blue'" onMouseOut= "this.style.color='black'" style="background-color:#CCCCCC ; width:100px" onClick="modinfo()">
				</td>
			</tr>
		</table>
		<table  border="1" align="center" cellpadding="6" cellspacing="1" width="70%" class="main_tableboder">
          	<tr>
            	<td  bgcolor="#FFFFFF" align="left" colspan="4">
				<img src="../ui/images/sj.gif"/>&nbsp;&nbsp;
				<span style="font-size:16px ; color:#FF0000">提前时间（单位/分钟）</span> 
				</td>
         	</tr>
		  	<tr> 
            	<td align="center" bgcolor="#FFFFFF">停止检票</td>
				<td bgcolor="#FFFFFF"><input type="text"  value="<?php echo $row['pt_Stop'];?>"/></td>
			
            	<td align="center" bgcolor="#FFFFFF">正在检票</td>
				<td bgcolor="#FFFFFF"><input type="text"  value="<?php echo $row['pt_Current'];?>"/></td>
			</tr>
			<tr>
            	<td align="center" bgcolor="#FFFFFF">等待检票</td>
				<td bgcolor="#FFFFFF" colspan="3"><input type="text"  value="<?php echo $row['pt_Hasten'];?>"/></td>
				
			</tr>
			<tr>
            	<td align="left" bgcolor="#FFFFFF" colspan="4">
				<img src="../ui/images/sj.gif"/>&nbsp;&nbsp;
				<span style="font-size:16px ; color:#FF0000">重复播放次数</span>
				</td>
			</tr>
			<tr> 
            	<td align="center" bgcolor="#FFFFFF">停止检票</td>
				<td bgcolor="#FFFFFF"><input type="text"  value="<?php echo $row['pt_StopRepeat'];?>"/></td>
			
            	<td align="center" bgcolor="#FFFFFF">班次催票</td>
				<td bgcolor="#FFFFFF"><input type="text"  value="<?php echo $row['pt_HastenRepeat'];?>"/></td>
			</tr>
			<tr> 
            	<td align="center" bgcolor="#FFFFFF">正在检票</td>
				<td bgcolor="#FFFFFF"><input type="text"  value="<?php echo $row['pt_CurrentRepeat'];?>"/></td>
			
            	<td align="center" bgcolor="#FFFFFF">等待检票</td>
				<td bgcolor="#FFFFFF"><input type="text"  value="<?php echo $row['pt_WaitRepeat'];?>"/></td>
			</tr>
			<tr>
				<td colspan="4" bgcolor="#FFFFFF">
				<span style="font-size:16px ; color:#FF0000">ps:提前时间是指当前时间与发车时间的相对时间差</span>
				</td>
			</tr>
        </table>
		</form>
		
   </body>
		
</html>