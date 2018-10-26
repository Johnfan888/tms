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
	<title>语音播报</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" /> 
	<meta http-equiv="refresh" content="<?php echo '60'?>;url=tms_v1_servicecenter_broadcastcenter.php" />
	<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery_tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="../js/tms_v1_tts.js"></script>
	<script type="text/javascript">
		SetVoice();
		SetAudioOutput();
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		/*jQuery.get(
		'tms_v1_servicecenter_info.php',
		{'op': 'GETPASSENGERINFO', 'time': Math.random()},	
		function(data){
			var objData = eval('(' + data + ')');
			if(objData.retVal == "FAIL"){ 
				alert('不存在播报信息');
			}
			if(objData[0].retVal == "SUCC1"){
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
	  					BeginSpeakText(str);
					}
					if(CheckState == '停止检票'){
						var str=str1+StopStationTime+str2+Endstation+str3+NoOfRunsID+str6;
						BeginSpeakText(str);
					}
					if(CheckState == '等待检票'){
						var str=str1+StopStationTime+str2+Endstation+str3+NoOfRunsID+str7+PreviousTime+str8;
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
					BeginSpeakText(str); 
					}
				}

				jQuery.get(  //删除播放完成的数据
						'tms_v1_servicecenter_info.php',
						{'op': 'DELETEPASSENGERINFO', 'time': Math.random()},
						function(data){
							var objData = eval('(' + data + ')');
						});	
					//	location.reload();
			}
		});*/

		
	/*	$("#button1").click(function(){
			StopSpeakText();
			
		});
		
		$("#button2").click(function(){
			location.reload();
		});*/
		$("#button3").click(function(){
			window.location.href('tms_v1_servicecenter_noticemange.php');
			
		});
		$('#button4').click(function(){
	        window.open('tms_v1_servicecenter_startbroadcast.php','','width=700,height=250');
			});
	});

	
	</script>	
	</head>
	<body>
	<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
 		<tr>
    		<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    		<span class="graytext" style="margin-left:8px;">语音自动播报系统</span></td>
  		</tr>
	</table>
	<form action="" method="post" name="form1">
    <table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
    	
 		<tr>
 			<td bgcolor="#FFFFFF" align="center">
    		<input type="button" id="button3" name="button3" value="公告信息" style="background-color:#CCCCCC" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'"></input>
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    		<!--  
    	    <input type="button" id="button1" name="button1" value="暂停播放" style="background-color:#CCCCCC" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'"></input>
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    		<input type="button" name="button2" id="button2"  value="恢复播放" style="background-color:#CCCCCC" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'"></input>
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    		-->
    		<input type="button" name="button4" id="button4"  value="开始播放" style="background-color:#CCCCCC" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'"></input>
    		</td>
    	</tr>
    </table>
    <table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1" id="table1">
    	<tr>
    		<td bgcolor="#006699" align="center" nowrap="nowrap"><font color="white" >序号</font></td>
    		<td bgcolor="#006699" align="center" nowrap="nowrap"><font color="white" >发班时间</font></td>
    		<td bgcolor="#006699" align="center" nowrap="nowrap"><font color="white" >起点站</font></td>
    		<td bgcolor="#006699" align="center" nowrap="nowrap"><font color="white" >终点站</font></td>
    		<td bgcolor="#006699" align="center" nowrap="nowrap"><font color="white" >班次</font></td>
    		<td bgcolor="#006699" align="center" nowrap="nowrap"><font color="white" >检票口</font></td>
    		<td bgcolor="#006699" align="center" nowrap="nowrap"><font color="white" >提前时间</font></td>
    		<td bgcolor="#006699" align="center" nowrap="nowrap"><font color="white" >状态</font></td>
    	</tr>
  	 	<?php
  	 	$nowdate = date('Y-m-d'); 
  	 	$str4="DELETE FROM tms_sch_SpeechNoOfRunsAttemp WHERE sa_NoOfRunsdate < '$nowdate'";
  	 	$result2=$class_mysql_default->my_query($str4);
  	 	$query="DELETE FROM tms_sch_SpeechNoOfRunsID WHERE sn_FromStation='$userStationName'";
		$result=$class_mysql_default->my_query($query);
		/*$str5="SELECT * FROM tms_sch_SpeechNoOfRunsAttemp";
		$query5=$class_mysql_default->my_query($str5);
		while($rows5=mysqli_fetch_array($query5)){
			echo $rows5['sa_PreviousTime'];
			$PreviousTime=$rows5['sa_PreviousTime']-1;
			$str6="UPDATE tms_sch_SpeechNoOfRunsID SET sa_PreviousTime='$PreviousTime' WHERE sa_StopStationTime='{$rows5['sa_StopStationTime']}' AND sa_Endstation='{$rows5['sa_Endstation']}' AND sa_NoOfRunsID='{$rows5['sa_NoOfRunsID']}' AND sa_Check='{$rows5['sa_Check']}' AND sa_CheckState='{$rows5['sa_CheckState']}' AND sa_FromStation='{$rows5['sa_FromStation']}' AND sa_FromStationID='{$rows5['sa_FromStationID']}'";
			$query6=$class_mysql_default->my_query($str6);
		}*/
    	$str='停止检票'; //状态信息 0
    	$str1='正在检票';//1
    	$str2='等待检票';//2
		$nowtime = date('H:i');
		$sec=date('H:i',strtotime("$nowtime+20 min"));
		$nowtime1=strtotime("$nowtime");
		$query="SELECT pt_Stop,pt_Current,pt_Hasten,pt_StopRepeat, pt_CurrentRepeat, pt_WaitRepeat FROM tms_sch_PreviousTime WHERE pt_Code='2'";
		$result=$class_mysql_default->my_query($query);
		$rows=mysqli_fetch_array($result);
		$stop=$rows['pt_Stop'];
		$Current=$rows['pt_Current'];
		$Hasten=$rows['pt_Hasten'];
		$query1="SELECT tml_Beginstation, tml_NoOfRunsID,tml_NoOfRunstime,tml_Endstation, tml_CheckTicketWindow ,pd_FromStation,pd_FromStationID,pd_BeginStationTime     
				 FROM tms_bd_TicketMode
				 LEFT OUTER JOIN tms_sch_Report ON tml_NoOfRunsID=rt_NoOfRunsID AND tml_NoOfRunsdate=rt_NoOfRunsdate
 				 LEFT OUTER JOIN tms_bd_PriceDetail ON tml_NoOfRunsID=pd_NoOfRunsID AND tml_NoOfRunsdate=pd_NoOfRunsdate
 				 WHERE tml_NoOfRunsdate='$nowdate'  AND   (tml_StopRun,tml_AllowSell) not in  (SELECT tml_StopRun,tml_AllowSell FROM tms_bd_TicketMode where tml_StopRun='0' AND tml_AllowSell = '0') 
 				 and (tml_StopRun) not in  (SELECT tml_StopRun FROM tms_bd_TicketMode where tml_StopRun='3') AND pd_FromStation='$userStationName'
  				 AND (rt_Register !='已发车' OR rt_Register IS NULL) GROUP BY pd_NoOfRunsdate, pd_NoOfRunsID, pd_FromStation";
		$result1=$class_mysql_default->my_query($query1);
	 	while($rows1=mysqli_fetch_array($result1)){
			$runstime=$rows1['pd_BeginStationTime']; //发班时间
			$Beginstation=$rows1['tml_Beginstation'];
			$Endstation=$rows1['tml_Endstation'];
			$NoOfRunsID=$rows1['tml_NoOfRunsID'];
			$CheckTicketWindow=$rows1['tml_CheckTicketWindow'];
			$FromStation=$rows1['pd_FromStation']; //调度站
			$FromStationID=$rows1['pd_FromStationID'];//调度站ID
			$pretime1=strtotime("$runstime")-strtotime("$nowtime");
			$pretime2=$pretime1/60; //发车时间相对现在提前时间
			//有系统设置时间计算相应状态
			$prestop=strtotime("$runstime-$stop min");
			$pre2stop=strtotime("$runstime-$stop min+2 min");
			$precurrent=strtotime("$runstime-$Current min");
			$prehasten=strtotime("$runstime-$Hasten min");
		if($runstime != null){
		    if($nowtime1 >= $prestop && $nowtime1 < $pre2stop){ //停止检票
		    	$query3="SELECT * FROM tms_sch_SpeechNoOfRunsAttemp WHERE sa_StopStationTime='$runstime' AND sa_Endstation='$Endstation' AND sa_NoOfRunsID='$NoOfRunsID' AND sa_Check='$CheckTicketWindow' AND sa_CheckState='$str' AND sa_FromStation='$FromStation' AND sa_FromStationID='$FromStationID'";
		    	$result3 = $class_mysql_default$class_mysql_default->my_query("$query3");
	  			if(mysqli_num_rows($result3) == 0) {
				$query="INSERT INTo tms_sch_SpeechNoOfRunsID(sn_StopStationTime,sn_Beginstation,sn_Endstation,sn_NoOfRunsID,sn_Check,sn_PreviousTime,sn_CheckState,sn_NoOfRunsdate,sn_FromStation,sn_FromStationID)
						values('$runstime','$Beginstation','$Endstation','$NoOfRunsID','$CheckTicketWindow','$pretime2','$str','$nowdate','$FromStation','$FromStationID')";
				//echo h.$runstime;
				$result=$class_mysql_default->my_query($query);
	  			}
	  			//更新临时表中数据
	  			else{
	  				$row=mysqli_fetch_array($result3);
	  				if($row['sa_PreviousTime'] !=0){
	  					$PreviousTime=$row['sa_PreviousTime']-1;
	  					$query4="UPDATE tms_sch_SpeechNoOfRunsAttemp SET sa_PreviousTime='$PreviousTime' WHERE sa_StopStationTime='$runstime' AND sa_NoOfRunsID='$NoOfRunsID'";
	  					$result4=$class_mysql_default$class_mysql_default->my_query("$query4");
	  				}
	  				else{
	  					$query4="DELETE FROM tms_sch_SpeechNoOfRunsAttemp  WHERE sa_StopStationTime='$runstime' AND sa_NoOfRunsID='$NoOfRunsID'";
	  					$result4=$class_mysql_default$class_mysql_default->my_query("$query4");
	  				}	
	  			}
			}
			if($nowtime1 >= $precurrent && $nowtime1 < $prestop){ //正在检票
				$query3="SELECT * FROM tms_sch_SpeechNoOfRunsAttemp WHERE sa_StopStationTime='$runstime' AND sa_Endstation='$Endstation' AND sa_NoOfRunsID='$NoOfRunsID' AND sa_Check='$CheckTicketWindow' AND sa_CheckState='$str1' AND sa_FromStation='$FromStation' AND sa_FromStationID='$FromStationID'";
		    	$result3 = $class_mysql_default$class_mysql_default->my_query("$query3");
	  			if(mysqli_num_rows($result3) == 0) {
	  				
				$query="INSERT INTo tms_sch_SpeechNoOfRunsID(sn_StopStationTime,sn_Beginstation,sn_Endstation,sn_NoOfRunsID,sn_Check,sn_PreviousTime,sn_CheckState,sn_NoOfRunsdate,sn_FromStation,sn_FromStationID)
						values('$runstime','$Beginstation','$Endstation','$NoOfRunsID','$CheckTicketWindow','$pretime2','$str1','$nowdate','$FromStation','$FromStationID')";
				//echo h.$runstime;
				$result=$class_mysql_default->my_query($query);
	  			}
				else{
						$row=mysqli_fetch_array($result3);
		  				$PreviousTime=$row['sa_PreviousTime']-1;
		  				if($PreviousTime <= $Current && $PreviousTime > $stop){
		  					//测试
		  					/*echo 'hello';
		  					echo $NoOfRunsID;
		  					echo $runstime;*/
		  					$query4="UPDATE tms_sch_SpeechNoOfRunsAttemp SET sa_PreviousTime='$PreviousTime' WHERE sa_StopStationTime='$runstime' AND sa_NoOfRunsID='$NoOfRunsID'";
		  					$result4=$class_mysql_default$class_mysql_default->my_query("$query4");
		  				}
		  				else{
		  					//echo "h";
		  					$query4="DELETE FROM tms_sch_SpeechNoOfRunsAttemp  WHERE sa_StopStationTime='$runstime' AND sa_NoOfRunsID='$NoOfRunsID'";
		  					$result4=$class_mysql_default$class_mysql_default->my_query("$query4");
		  				}	
		  			}
			}
			
			if($nowtime1 >= $prehasten && $nowtime1 < $precurrent){ //等待检票
				$query3="SELECT * FROM tms_sch_SpeechNoOfRunsAttemp WHERE sa_StopStationTime='$runstime' AND sa_Endstation='$Endstation' AND sa_NoOfRunsID='$NoOfRunsID' AND sa_Check='$CheckTicketWindow' AND sa_CheckState='$str2' AND sa_FromStation='$FromStation' AND sa_FromStationID='$FromStationID'";
		    	$result3 = $class_mysql_default$class_mysql_default->my_query("$query3");
	  			if(mysqli_num_rows($result3) == 0) {
				$query="INSERT INTo tms_sch_SpeechNoOfRunsID(sn_StopStationTime,sn_Beginstation,sn_Endstation,sn_NoOfRunsID,sn_Check,sn_PreviousTime,sn_CheckState,sn_NoOfRunsdate,sn_FromStation,sn_FromStationID)
						values('$runstime','$Beginstation','$Endstation','$NoOfRunsID','$CheckTicketWindow','$pretime2','$str2','$nowdate','$FromStation','$FromStationID')";
				//echo h.$runstime;
				$result=$class_mysql_default->my_query($query);
	  			}
				else{
			  				$row=mysqli_fetch_array($result3);
			  				$PreviousTime=$row['sa_PreviousTime']-1;
			  				if($PreviousTime <= $Hasten && $PreviousTime > $Current){
			  					$query4="UPDATE tms_sch_SpeechNoOfRunsAttemp SET sa_PreviousTime='$PreviousTime' WHERE sa_StopStationTime='$runstime' AND sa_NoOfRunsID='$NoOfRunsID'";
			  					$result4=$class_mysql_default$class_mysql_default->my_query("$query4");
			  				}
			  				else{
			  					$query4="DELETE FROM tms_sch_SpeechNoOfRunsAttemp  WHERE sa_StopStationTime='$runstime' AND sa_NoOfRunsID='$NoOfRunsID'";
			  					$result4=$class_mysql_default$class_mysql_default->my_query("$query4");
			  				}	
			  			}
			}
		}
	}
			$str="select count(*) as amount from tms_sch_SpeechNoOfRunsID where sn_FromStation='$userStationName'";
			$query=$class_mysql_default->my_query($str);
			$row=mysqli_fetch_array($query);
			$amount = $row[0];
			$str3="select count(*) as amount1 from tms_sch_ReportInfo where ri_FromStation='$userStationName'";
			$query2=$class_mysql_default->my_query($str3);
			$row1=mysqli_fetch_array($query2);
			$amount1 = $row1[0];
			$amount2=$amount+$amount1;
			$query="SELECT sn_StopStationTime,sn_Beginstation,sn_Endstation,sn_NoOfRunsID,sn_Check,sn_PreviousTime,sn_CheckState FROM tms_sch_SpeechNoOfRunsID where sn_FromStation='$userStationName' order by sn_PreviousTime";
			$result=$class_mysql_default->my_query($query);
				$i=0;
			while($rows=mysqli_fetch_array($result)){
				$i++;
    	?>
    	<tr bgcolor="#CCCCCC">
    		<td align="center" nowrap="nowrap"><?=$i?></td>
    		<td align="center" nowrap="nowrap"> <?=$rows['sn_StopStationTime']?></td>
    		<td align="center" nowrap="nowrap"><?=$rows['sn_Beginstation']?></td>
    		<td align="center" nowrap="nowrap"><?=$rows['sn_Endstation']?></td>
    		<td align="center" nowrap="nowrap"><?=$rows['sn_NoOfRunsID']?></td>
    		<td align="center" nowrap="nowrap"><?=$rows['sn_Check']?></td>
    		<td align="center" nowrap="nowrap"><?=$rows['sn_PreviousTime']?></td>
    		<td align="center" nowrap="nowrap"><?=$rows['sn_CheckState']?></td>
    	</tr>
    	
 	  	<?php 
			}
    	?>
    	<tr>
    		<td bgcolor="#FFFFFF" align="center" colspan="8"><span style="color:#FF0000">共有<?=$amount2?>条待播信息:&nbsp;&nbsp;&nbsp;&nbsp;其中有<?=$amount1?>条催客信息</span>
    		</td>
    	</tr>
    </table>
    </form>
	</body>
</html>