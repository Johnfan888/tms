<?php 
	define("AUTH", "TRUE");
	require_once("../ui/inc/init.inc.php");
	if($userStationName  == '全部车站'){
	   $userStationName == '';
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>语音播报窗口</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" /> 
		<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
		<script type="text/javascript" src="../js/tms_v1_tts.js"></script>
		</head>
	<body>
		<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	 		<tr>
	    		<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
	    		<span class="graytext" style="margin-left:8px;">语音自动播报</span></td>
	  		</tr>
		</table>
		<form action="" method="post" name="form1"> 
			<table width="90%" align="center" class="main_tableboder" border="1" cellpadding="0" cellspacing="1">
				<tr>
					<td bgcolor="#FFFFFF" align="right">播报内容</td>
					<td bgcolor="#FFFFFF" align="center">
					 <textarea name="info" id="info" cols="60" rows="6" ></textarea>
					</td>
				</tr>
				<tr>
					<td bgcolor="#FFFFFF" colspan="2" align="center">
						<input type="button" id="button1" name="button1" value="暂停播放" style="background-color:#CCCCCC" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'"></input>
    					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    					<input type="button" name="button2" id="button2"  value="恢复播放" style="background-color:#CCCCCC" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'"></input>
    					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</td>
				</tr>
			</table>
			<input type="hidden" name="info1" id="info1" value=""></input>
		</form>
		<script type="text/javascript">
		SetVoice();
		SetAudioOutput();
		$(document).ready(function(){
			$.ajaxSetup({ 
				  async: false
				  });
			while(1){
			var info1=document.getElementById("info1").value;
			if(info1 == ""){
				jQuery.get(
				'tms_v1_servicecenter_info.php',
				{'op': 'GETPASSENGERINFO', 'time': Math.random()},	
				function(data){
					var objData = eval('(' + data + ')');
					if(objData[0].retVal == "SUCC1"){
						document.getElementById("info1").value="";
						for(var i = 0; i < objData.length; i++){
							var str1='旅客朋友们，请注意，将在';
							var str2='开往';
							var str3='方向的';
							var str4='班次正在';
							var str5='号检票口进行检票，';
							var str6='班次已经停止检票';
							var str7='班次在过';
							var str8='分钟就要开始检票了'; 
							var str9='请乘坐此班次的旅客朋友，抓紧时间进行检票';
							var CheckState = objData[i].CheckState;//检票状态
							var StopStationTime=objData[i].StopStationTime;//发车时间
				  			var Endstation=objData[i].Endstation; //终点站
				  			var NoOfRunsID=objData[i].NoOfRunsID.split("");//班次
				  			var Check=objData[i].Check;//检票口
				  			var PreviousTime=objData[i].PreviousTime;//提前时间
				  			var repeat=objData[i].repeat;	
				  		//	alert(repeat);
				  			for(var j=0; j<repeat; j++){
			  				if(CheckState == '正在检票')
				  				var str=str1+StopStationTime+str2+Endstation+str3+NoOfRunsID+str4+Check+str5+str9;
			  					document.getElementById("info").value=str;
								BeginSpeakText(str);
			  				}
							if(CheckState == '停止检票'){
								var str=str1+StopStationTime+str2+Endstation+str3+NoOfRunsID+str6;
								document.getElementById("info").value=str;
								BeginSpeakText(str);
							}
							if(CheckState == '等待检票'){
								var str=str1+StopStationTime+str2+Endstation+str3+NoOfRunsID+str7+PreviousTime+str8;
								document.getElementById("info").value=str;
								BeginSpeakText(str);
							}
						}
						
					}
					if(objData[0].retVal == "SUCC"){
					//	var broadcast=false;
						var HastenRepeat = objData[0].HastenRepeat;
						for(var j=0; j<HastenRepeat; j++){ //循环播放次数
						for(var i = 0; i < objData.length; i++){ //播放内容
							var str = objData[i].ri_info;
							document.getElementById("info").value=str;
							BeginSpeakText(str); 
							}
						}
					}
				});
				}
			}
				$("#button1").click(function(){
					StopSpeakText();
					document.getElementById("info1").value="stop";
				});
				
				$("#button2").click(function(){
					document.getElementById("info1").value="";
					location.reload();
				});
				
		});
		</script>
	</body>
</html>	