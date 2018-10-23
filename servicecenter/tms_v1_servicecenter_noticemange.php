<?php 
define("AUTH", "TRUE");
require_once("../ui/inc/init.inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>公告管理</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="tms_v1_screen1.js"></script>
	<script type="text/javascript">
		SetVoice();
		SetAudioOutput();
	</script>	
	<script type="text/javascript">
	var VoiceObj = new ActiveXObject("Sapi.SpVoice");
	function BeginSpeakText(WhatToSpeak) {
		try
		{
			VoiceObj.Speak( WhatToSpeak, 1 );
			//VoiceObj.Speak( document.getElementById("idTextBox").value, 1 );
		}
		catch(exception)
		{
			alert("语音播报错误！");
		}
	}
	function StopSpeakText() {
		try
		{
			VoiceObj.Speak( "", 2 );
		}
		catch(exception)
		{
			alert("语音播报停止错误！");
		}
	}
				
	function delregion(){
		if (!document.getElementById("RegionCode1").value){
			alert('请选择要删除记录！')
					return false;}
				else{
					if(!confirm("确定要删除该数据吗？")){
						return false;}
					else{
						var RegionCode = $("#RegionCode1").val();
						jQuery.get(
								'tms_v1_servicecenter_delete.php',
							{'op': 'delnotice', 'RegionCode': RegionCode,'time': Math.random()},
								function(data){
									var objData = eval('(' + data + ')');
									if( objData.sucess=='1'){
										alert('删除成功！');
										document.form1.submit();
										}
									else{
										alert('删除失败！');}
					  });
					}
				}
			}
		 
	  function returegion(){
			window.location.href('tms_v1_servicecenter_broadcastcenter.php');
		  }
	  function start(){
		  var sTable = document.getElementById("table1");
		  	for(var i=1;i<sTable.rows.length-1;i++){
			  	alert(sTable.rows.length-1);
			  if (document.getElementById(i).checked){
				  document.getElementById(i).checked = true;
				  var str=sTable.rows[i].cells[1].innerText;
				  alert(str);
				  BeginSpeakText(str); 
			  } 
		  }
	 }

	  function returegion(){
			window.location.href('tms_v1_servicecenter_broadcastcenter.php');
		  }

	 function selectedrow(){
		 var sTable = document.getElementById("table1");
		 var checked = false;
		 for(var j=0;j<3;j++){
		  	for(var i=1;i<sTable.rows.length-1;i++){
			  if (document.getElementById(i).checked){
				  checked = true;
				//  document.getElementById(i).checked = true;
				  var str=sTable.rows[i].cells[2].innerText;
				  BeginSpeakText(str); 
				 // document.getElementById(i).checked = false;
					 continue;
			  	} 
		   	 } 
		  	if(!checked){
		  		alert("请选择要播放的项目");
		  		break;
		  	}
		 }
		/* if(!checked){
			 alert("请选择要播放的项目");
		 }*/
	}

	 function cancelrow(){
		 StopSpeakText();
		 var sTable = document.getElementById("table1");
		  	for(var i=1;i<sTable.rows.length-1;i++){
			  	
			  if (document.getElementById(i).checked){
				  document.getElementById(i).checked = true;
			  } 
		  }	 
	 }
  		
	</script>
</head>
	<body>
	<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 		<tr>
    		<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    		<span class="graytext" style="margin-left:8px;">公告管理</span></td>
  		</tr>
	</table>
	<form action="" method="post" name="form1"> 
	<table width="95%" align="center" class="main_tableboder" border="1" cellpadding="0" cellspacing="1">
		<tr>
			<td bgcolor="#FFFFFF" align="right">公告管理内容</td>
			<td bgcolor="#FFFFFF" align="center">
			<!-- 
			<input type="text"  style="width:500px; height:100px" name="info" id="info"/>
			 -->
			 <textarea name="info" id="info" cols="85" rows="10" ></textarea>
			</td>
			<td bgcolor="#FFFFFF" align="center">
				<input type="submit" name="add" value="增加"style="width:80px; background-color:#CCCCCC"/><p></p>
			  	<input type="submit" name="mod" value="修改"  style="width:80px; background-color:#CCCCCC"/><p></p>
			  	<input type="button" name="del" value="删除"  style="width:80px; background-color:#CCCCCC" onclick="delregion()"/><p></p>
				<input type="button" name="clo" value="返回" style="width:80px; background-color:#CCCCCC" onclick="returegion()"/>
			</td>
		</tr>
		<tr>
		  <td bgcolor="#FFFFFF" align="center" colspan="3">
			<input type="button" name="start1" value="开始播放" style="width:90px" onclick="selectedrow()"/>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button" name="stop1" value="停止播放"  style="width:90px" onclick="cancelrow()"/>
		  </td>
		</tr>
			
	</table>
	
	<br>
	</br>
	<table width="95%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1" id="table1">
		<tr>
			<td align="center" bgcolor="#006699"><font color="white" >编号</font></td>
			<td align="center" bgcolor="#006699" style="display:none"></td>
			<td align="center" bgcolor="#006699"><font color="white" >内容</font></td>
			<td align="center" bgcolor="#006699"><font color="white" >播放标识</font></td>
		</tr>
		<?php 
		$query="SELECT * FROM tms_sch_NoticeInfo";
		$result1=mysql_query($query);
			$i=0;
		while($rows=mysql_fetch_array($result1)){
			$i++;
		?>
		<tr id="tr"  bgcolor="#CCCCCC" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="selectRow(this,'RegionCode1','info')">
			<td align="center"><?=$i?></td>
			<td align="center" style="display:none"><?=$rows['ni_id']?></td>
			<td align="center"><?=$rows['ni_info']?></td>
			<td align="center">
			<?php 
			echo "<input type=checkbox name='$i' value='$i'  id='$i'></input>";
			//}
			?>
			</td>
		</tr>
		<?php 
		}
		if(isset($_POST['add'])){
			$info=$_REQUEST['info'];
			echo $info;
		    if($info == null){
				echo "<script> alert('请输入要添加的内容');</script>";
			}
			else{
				$query1="SELECT MAX(ni_id) AS ni_id FROM tms_sch_NoticeInfo";
				$result1=mysql_query($query1);
				$row=mysql_fetch_array($result1);
				if($row['ni_id'] ==null){
					$id=1;
				}
				else{
					$id=$row['ni_id']+1;
				}
				$query="INSERT INTO tms_sch_NoticeInfo(ni_id,ni_info) VALUES('$id','$info')";
				$result=mysql_query($query);
				if($result){
    				echo "<script> alert('添加成功');window.location.href('tms_v1_servicecenter_noticemange.php');</script>";
				}
    			else{
    			 	echo "<script> alert('添加失败'); </script>";
    			}
			} 
		}
		if(isset($_POST['mod'])){
			$RegionCode1=$_REQUEST['RegionCode1'];
			$info=$_REQUEST['info'];
			if($RegionCode1 == null){
			echo "<script> alert('请选择要修改的记录');</script>";	
			}
			else{
				$query="UPDATE tms_sch_NoticeInfo SET ni_info='$info' WHERE ni_id='$RegionCode1'";
				$result=mysql_query($query);
				if($result){
    				echo "<script> alert('修改成功');window.location.href('tms_v1_servicecenter_noticemange.php');</script>";
				}
    			else{
    			 	echo "<script> alert('修改失败'); </script>";
    			}
			}
		}
		?>
		<tr><td><input type="hidden" id="RegionCode1" name="RegionCode1" value = ""/></td></tr>
		</table>
		
	</form>
	</body>
</html>	