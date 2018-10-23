<?php
//define("AUTH", "TRUE");
require_once("../ui/inc/init.inc.php");
?>
<html>
	<head>
		<title>参数设置</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			function cancle(){
             window.close();
     		}
		</script>
</head>
	<body>
	<table  width="100%" height="45" border="1" align="center" cellpadding="3" cellspacing="1" class="main_tableboder">
			<tr>
				<td height="43" bordercolor="#999999" bgcolor="#f0f8ff" align="center"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="15" height="19" />
				<span style="font-size:20px; width:auto" >参数设置</span>
				</td>
  			</tr>
	</table>
		<form method="post" action="" name="form1">
		  <table  border="1" align="center" cellpadding="6" cellspacing="1" width="70%" class="main_tableboder">
          	<tr>
            	<td  bgcolor="#FFFFFF" align="left" colspan="4">
				<img src="../ui/images/sj.gif"/>&nbsp;&nbsp;
				<span style="font-size:16px ; color:#FF0000">提前时间（单位/分钟）</span> 
				</td>
         	</tr>
		  	<tr> 
            	<td align="center" bgcolor="#FFFFFF">停止检票</td>
				<td bgcolor="#FFFFFF"><input type="text"  name="Stop"/></td>
			
            	<td align="center" bgcolor="#FFFFFF">正在检票</td>
				<td bgcolor="#FFFFFF"><input type="text"  name="Current"/></td>
			</tr>
			<tr>
            	<td align="center" bgcolor="#FFFFFF">等待检票</td>
				<td bgcolor="#FFFFFF" colspan="3"><input type="text"  name="Hasten"/></td>
				
			</tr>
			<tr>
            	<td align="left" bgcolor="#FFFFFF" colspan="4">
				<img src="../ui/images/sj.gif"/>&nbsp;&nbsp;
				<span style="font-size:16px ; color:#FF0000">重复播放次数</span>
				</td>
			</tr>
			<tr> 
            	<td align="center" bgcolor="#FFFFFF">停止检票</td>
				<td bgcolor="#FFFFFF"><input type="text"  name="StopRepeat"/></td>
			
            	<td align="center" bgcolor="#FFFFFF">班次催票</td>
				<td bgcolor="#FFFFFF"><input type="text"  name="HastenRepeat"/></td>
			</tr>
			<tr> 
            	<td align="center" bgcolor="#FFFFFF">正在检票</td>
				<td bgcolor="#FFFFFF"><input type="text"  name="CurrentRepeat"/></td>
			
            	<td align="center" bgcolor="#FFFFFF">等待检票</td>
				<td bgcolor="#FFFFFF"><input type="text"  name="WaitRepeat"/></td>
			</tr>
			<tr>
				<td colspan="4" bgcolor="#FFFFFF">
				<span style="font-size:16px ; color:#FF0000">ps:提前时间是指当前时间与发车时间的相对时间差</span>
				</td>
			</tr>
            <tr>
              <td colspan="4" align="center" bgcolor="#FFFFFF"><input type="submit" name="decide" value="确定" onMouseOver="this.style.color='blue'" onMouseOut="this.style.color='black'" style="background-color:#CCCCCC  ; width:100px">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="reset" name="reset1" value="重置" onMouseOver="this.style.color='blue'" onMouseOut="this.style.color='black'"  style="background-color:#CCCCCC  ; width:100px">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" name="button1" value="关闭" onMouseOver="this.style.color='blue'" onMouseOut="this.style.color='black'" onClick="cancle()" style="background-color:#CCCCCC  ; width:100px">
              </td>
              <?php 
				if(isset($_REQUEST['decide'])){
					$Stop = $_REQUEST['Stop'];
					$Current = $_REQUEST['Current'];
					$Hasten = $_REQUEST['Hasten'];
					$StopRepeat = $_REQUEST['StopRepeat'];
					$HastenRepeat = $_REQUEST['HastenRepeat'];
					$CurrentRepeat=$_REQUEST['CurrentRepeat'];
					$WaitRepeat=$_REQUEST['WaitRepeat'];
					$str ="SELECT * FROM tms_sch_PreviousTime WHERE pt_code='2'";
					$selectstr=mysql_query($str) ;
					$rows=mysql_fetch_array($selectstr);
			        if($Stop == null){
					 $Stop=$rows['pt_Stop'];
			          }
					if($Current == null){
					 $Current=$rows['pt_Current'];
					}
					if($Hasten == null){
					 $Hasten=$rows['pt_Hasten'];
					}
					if($StopRepeat == null){
					 $StopRepeat=$rows['pt_StopRepeat'];
					}
					if($HastenRepeat == null){
					 $HastenRepeat=$rows['pt_HastenRepeat'];
					}
					if($CurrentRepeat == null){
					 $CurrentRepeat=$rows['pt_CurrentRepeat'];
					}
					if($WaitRepeat == null){
					 $WaitRepeat=$rows['pt_WaitRepeat'];
					}
					//echo $carcheck,$secdmaint,$insure,$licencheck,$contime,$spareleave;
						$update = "UPDATE tms_sch_PreviousTime SET pt_Stop='$Stop' , pt_Current='$Current' , pt_Hasten = '$Hasten' , pt_StopRepeat='$StopRepeat' , pt_HastenRepeat='$HastenRepeat',pt_CurrentRepeat='$CurrentRepeat', pt_WaitRepeat='$WaitRepeat' WHERE pt_Code='2'";
		   				$result = mysql_query($update);
		   				if($result){
		   					echo "<script>";
		   					echo "alert('修改成功')";
		   					echo "</script>";
		   					}
		   	   			else{
		   	   	    		echo "<script>";
		   					echo "alert('修改失败')";
		   					echo "</script>";
		   	   			}
				}
				
				?>
            </tr>
          </table>
		</form>	
	</body>
</html>
	