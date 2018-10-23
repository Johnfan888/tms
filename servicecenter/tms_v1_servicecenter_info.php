<?php
define("AUTH", "TRUE");
require_once("../ui/inc/init.inc.php");
   //获取语音播放参数
   if($userStationName  == '全部车站'){
	   $userStationName == '';
	}
	$str="SELECT * FROM tms_sch_PreviousTime WHERE pt_Code='2'";
	$query=mysql_query($str);
	$rowsp=mysql_fetch_array($query);
	$Stop=$rowsp['pt_Stop'];
	$Current=$rowsp['pt_Current'];
	$Hasten=$rowsp['pt_Hasten'];
	$StopRepeat=$rowsp['pt_StopRepeat'];
	$HastenRepeat=$rowsp['pt_HastenRepeat'];
	$CurrentRepeat=$rowsp['pt_CurrentRepeat'];
	$WaitRepeat=$rowsp['pt_WaitRepeat'];
	$op = $_REQUEST['op'];
	if($op="GETPASSENGERINFO"){
		$query="SELECT * FROM tms_sch_ReportInfo where ri_FromStation='$userStationName' limit 1";
		$result = $class_mysql_default->my_query("$query");
	  	if(mysql_num_rows($result) == 0) {
	  		$query1="SELECT sn_StopStationTime,sn_Beginstation,sn_Endstation,sn_NoOfRunsID,sn_Check,sn_PreviousTime,sn_CheckState,sn_FromStation,sn_FromStationID FROM tms_sch_SpeechNoOfRunsID where sn_FromStation='$userStationName' order by sn_PreviousTime limit 1 FOR UPDATE";
			$result1 = mysql_query($query1);
	 /* 	if(!$result1) {
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '锁定票版数据失败！', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}*/
			if(!$result1){
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' =>'FAIL1','retString' => '锁定数据失败！', 'sql' => $query);
				echo json_encode($retData);
				exit();
			}
	  		if(mysql_num_rows($result1) == 0) {
	  			//临时表中查询
	  			$query3="SELECT * FROM tms_sch_SpeechNoOfRunsAttemp where sa_FromStation='$userStationName' order by sa_PreviousTime limit 1";
				$result3 = mysql_query($query3);
				if(!$result3){
					$retData = array('retVal' =>'FAIL1','retString' => '查询失败！', 'sql' => $query);
					echo json_encode($retData);
					exit();
				}
				if(mysql_num_rows($result3) == 0) {
					$retData = array('retVal' => 'FAIL',  'sql' => $query); 
					echo json_encode($retData);
					exit();	
				}
				while($rows1 = mysql_fetch_array($result3)){
					$repeat="";
		  			$FromStation=$rows1['sa_FromStation'];//途经站
		  			$FromStationID=$rows1['sa_FromStationID'];//途经站ID
		  			$StopStationTime=$rows1['sa_StopStationTime'];//发车时间
		  			$Endstation=$rows1['sa_EndStation']; //终点站
		  			$NoOfRunsID=$rows1['sa_NoOfRunsID'];//班次
		  			$Check=$rows1['sa_Check'];//检票口
		  			$PreviousTime=$rows1['sa_PreviousTime'];//提前时间
		  			$CheckState=$rows1['sa_CheckState'];//检票状态
		  			$date=date('Y-m-d');
		  			$str="DELETE FROM tms_sch_SpeechNoOfRunsAttemp WHERE sa_StopStationTime='$StopStationTime' AND sa_Endstation='$Endstation' AND sa_NoOfRunsID='$NoOfRunsID' AND sa_Check='$Check' AND sa_PreviousTime='$PreviousTime' AND sa_CheckState='$CheckState' AND sa_FromStation='$FromStation' AND sa_FromStationID='$FromStationID'";
	  				$result2 = mysql_query($str);
		  			if($PreviousTime >= ($Stop-2) && $PreviousTime <= $Stop){
		  				$repeat=$StopRepeat;  //停止检票重复次数
		  			}
		  			if($PreviousTime > $Stop && $PreviousTime <= $Current){ //正在检票重复次数
		  				$repeat=$CurrentRepeat;
		  			}
		  			if($PreviousTime > $Current && $PreviousTime <= $Hasten){ //等待检票重复次数
		  				$repeat=$WaitRepeat;
		  				$PreviousTime = $PreviousTime-$Current;
		  			}
		  			$retData[] = array('retVal' => 'SUCC1', 'CheckState' => $CheckState, 'StopStationTime' => $StopStationTime, 'Endstation' => $Endstation, 'NoOfRunsID' => $NoOfRunsID, 'Check' => $Check, 'PreviousTime' => $PreviousTime, 'repeat' => $repeat);
		  			}
						echo json_encode($retData);
						$class_mysql_default->my_query("COMMIT");
						exit();
	  		
	  	}
	  		else{
	  		while($rows1 = mysql_fetch_array($result1)) {
	  			$repeat="";
	  			$FromStation=$rows1['sn_FromStation'];//途经站
	  			$FromStationID=$rows1['sn_FromStationID'];//途经站ID
	  			$StopStationTime=$rows1['sn_StopStationTime'];//发车时间
	  			$Endstation=$rows1['sn_Endstation']; //终点站
	  			$NoOfRunsID=$rows1['sn_NoOfRunsID'];//班次
	  			$Check=$rows1['sn_Check'];//检票口
	  			$PreviousTime=$rows1['sn_PreviousTime'];//提前时间
	  			$CheckState=$rows1['sn_CheckState'];//检票状态
	  			$date=date('Y-m-d');
	  			$str="DELETE FROM tms_sch_SpeechNoOfRunsID WHERE sn_StopStationTime='$StopStationTime' AND sn_Endstation='$Endstation' AND sn_NoOfRunsID='$NoOfRunsID' AND sn_Check='$Check' AND sn_PreviousTime='$PreviousTime' AND sn_CheckState='$CheckState' AND sn_FromStation='$FromStation' AND sn_FromStationID='$FromStationID'";
	  			$result2 = mysql_query($str);
	  			if(!$result2){
	  				$class_mysql_default->my_query("ROLLBACK");
	  				$retData = array('retVal' => 'FAIL','retString' => '写入数据失败！', 'sql' => $str);
	  				echo json_encode($retData);
	  				exit();
	  			}
	  			$str="INSERT INTO tms_sch_SpeechNoOfRunsAttemp(sa_StopStationTime,sa_Endstation,sa_NoOfRunsID,sa_Check,sa_PreviousTime,sa_CheckState,sa_NoOfRunsdate,sa_FromStation,sa_FromStationID) values('$StopStationTime','$Endstation','$NoOfRunsID','$Check','$PreviousTime','$CheckState','$date','$FromStation','$FromStationID')";
	  			$result2 = mysql_query($str);
	  			if(!$result2){
	  				$class_mysql_default->my_query("ROLLBACK");
	  				$retData = array('retVal' => 'FAIL','retString' => '写入数据失败！', 'sql' => $str);
	  				echo json_encode($retData);
	  				exit();
	  			}
	  			if($PreviousTime >= ($Stop-2) && $PreviousTime <= $Stop){
	  				$repeat=$StopRepeat;  //停止检票重复次数
	  			}
	  			if($PreviousTime > $Stop && $PreviousTime <= $Current){ //正在检票重复次数
	  				$repeat=$CurrentRepeat;
	  			}
	  			if($PreviousTime > $Current && $PreviousTime <= $Hasten){ //等待检票重复次数
	  				$repeat=$WaitRepeat;
	  				$PreviousTime = $PreviousTime-$Current;
	  			}
	  			
	  			$retData[] = array('retVal' => 'SUCC1', 'CheckState' => $CheckState, 'StopStationTime' => $StopStationTime, 'Endstation' => $Endstation, 'NoOfRunsID' => $NoOfRunsID, 'Check' => $Check, 'PreviousTime' => $PreviousTime, 'repeat' => $repeat);
	  			}
					echo json_encode($retData);
					$class_mysql_default->my_query("COMMIT");
					exit();
		  }
	  	}
		else{
			while($rows = mysql_fetch_array($result)) {
				$ri_info=$rows['ri_info'];
				$queryu="UPDATE tms_sch_ReportInfo SET ri_state='2' where ri_info='$ri_info' AND ri_FromStation='$userStationName'";
				$resultu=mysql_query($queryu);
				$query2="DELETE FROM tms_sch_ReportInfo WHERE ri_state='2' AND ri_info='$ri_info' AND ri_FromStation='$userStationName'";
				$result2=mysql_query($query2);
				$retData[] = array('retVal' => 'SUCC', 'ri_info' => $ri_info, 'HastenRepeat' => $HastenRepeat);
			}
			echo json_encode($retData);
		}
	}

	/*if($op="DELETEPASSENGERINFO"){
		$query="DELETE FROM tms_sch_ReportInfo WHERE ri_state='2' AND ri_FromStation='$userStationName'";
		$result=mysql_query($query);
	}*/
	
?>