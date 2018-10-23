<?php
/*
 * 查询售票员页面
 */
//st_StationBalance 8站间结算
//lc_StationBalance 8站间结算
//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$op = $_REQUEST['op'];
switch ($op)
{
	case "getSellersData":
		$stationName = trim($_GET['stationName']);
		getSellersData($stationName,$class_mysql_default);
		break;
	case "getCheckersData":
		$stationName = trim($_GET['stationName']);
		getCheckersData($stationName,$class_mysql_default);
		break;
	case "setStatData":
		$statFileName = $_POST['statfile'];
		$statData = trim($_POST['statdata']);
		if (file_put_contents("$statFileName",$statData) == false) {
			$retData = array('retVal' => 'FAIL', 'retString' => '写数据文件失败！');
			echo json_encode($retData);
		}
		else {
			$retData = array('retVal' => 'SUCC', 'retString' => '写数据文件成功！');
			echo json_encode($retData);
		}
		break;
	case "balance":
		$BalanceNo=$_REQUEST['BalanceNo'];
		$BalanceStyle=$_REQUEST['BalanceStyle'];
		$busCard=$_REQUEST['busCard'];
		$BusUnit=$_REQUEST['BusUnit'];
		$checkdate1=$_REQUEST['checkdate1'];
		$checkdate2=$_REQUEST['checkdate2'];
		$curdate=date('Y-m-d');
		$curtime=date('H:i:s');
		$queryBalanceInHandTemp="SELECT bht_BusNumber,bht_BusUnit,bht_FromStationID,bht_State,bht_Date FROM tms_acct_BalanceInHandTemp WHERE bht_BalanceNO='{$BalanceNo}'";
		$resultBalanceInHandTemp=$class_mysql_default->my_query("$queryBalanceInHandTemp");
		if(!$resultBalanceInHandTemp){
			$retData = array('retVal' => 'FAIL', 'retString' => '查询结算数据失败！', 'sql' => $queryBalanceInHandTemp);
			echo json_encode($retData);
			exit();
		}
		if(mysql_num_rows($resultBalanceInHandTemp) == 0){
			$retData = array('retVal' => 'FAIL', 'retString' => '该结算单不存在或已经结算！', 'sql' => $queryBalanceInHandTemp);
			echo json_encode($retData);
			exit();
		}
		$rowresultBalanceInHandTemp=mysql_fetch_array($resultBalanceInHandTemp);
		if($rowresultBalanceInHandTemp['bht_FromStationID']!=$userStationID && $userStationID!='all'){
			$retData = array('retVal' => 'FAIL', 'retString' => '该结算单不是本站结算单！');
			echo json_encode($retData);
			exit();
		}
		if($rowresultBalanceInHandTemp['bht_State']!='正常'){
			$retData = array('retVal' => 'FAIL', 'retString' => '该结算单已被注销或作废！');
			echo json_encode($retData);
			exit();
		}
		if($rowresultBalanceInHandTemp['bht_Date']<$checkdate1||$rowresultBalanceInHandTemp['bht_Date']>$checkdate2){
			$retData = array('retVal' => 'FAIL', 'retString' => '该结算单不在该日期范围内！');
			echo json_encode($retData);
			exit();
		}
		if($BalanceStyle=='0'){
			if($rowresultBalanceInHandTemp['bht_BusNumber']!=$busCard){
				$retData = array('retVal' => 'FAIL', 'retString' => '该结算单不是本车辆的结算单！', 'sql' => $queryBalanceInHandTemp);
				echo json_encode($retData);
				exit();
			}	
		}else{
			if($rowresultBalanceInHandTemp['bht_BusUnit']!=$BusUnit){
				$retData = array('retVal' => 'FAIL', 'retString' => '该结算单不是本单位的结算单！', 'sql' => $queryBalanceInHandTemp);
				echo json_encode($retData);
				exit();
			}	
		}
		$retData = array('retVal' => 'SUCC');
		echo json_encode($retData);
		break;
	case "cancelbalance":
		$balanceBalanceNO=trim($_REQUEST['balanceBalanceNO']);
		$class_mysql_default->my_query("BEGIN");
		foreach (explode(";",$balanceBalanceNO) as $key =>$BalanceNO){
			$BalanceNO=trim($BalanceNO);
			$update="UPDATE tms_acct_BalanceInHandTemp SET bht_UserIDTemp=NULL,bht_UserTemp=NULL WHERE bht_BalanceNO='{$BalanceNO}'";
			$queryupdate=$class_mysql_default->my_query("$update");
			if(!$queryupdate){
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '更新结算数据失败！', 'sql' => $update);
				echo json_encode($retData);
				exit();
			}  
		}
		$class_mysql_default->my_query("COMMIT");
		$retData = array('retVal' => 'SUCCESS', 'retString' => '更新结算数据成功！', 'sql' => $update);
		echo json_encode($retData);
		break;
	case "subBalance":
		$BalanceStyle=$_REQUEST['BalanceStyle'];
		$BusID=$_REQUEST['BusID'];
		$BusUnit=$_REQUEST['BusUnit'];
		$ba_BusUnit=$_REQUEST['ba_BusUnit'];
		$balanceBalanceNO=$_REQUEST['balanceBalanceNO'];
		$ba_BalanceCount = $_REQUEST['ba_BalanceCount'];
		$ba_CheckTotal = $_REQUEST['ba_CheckTotal'];
		$ba_Income = $_REQUEST['ba_Income'];
		$ba_ServiceFee = $_REQUEST['ba_ServiceFee'];
		$ba_OtherFee1 = $_REQUEST['ba_OtherFee1'];
		$ba_OtherFee2 = $_REQUEST['ba_OtherFee2'];
		$ba_OtherFee3 = $_REQUEST['ba_OtherFee3'];
		$ba_OtherFee4 = $_REQUEST['ba_OtherFee4'];
		$ba_OtherFee5 = $_REQUEST['ba_OtherFee5'];
		$ba_OtherFee6 = $_REQUEST['ba_OtherFee6'];
		$ba_ConsignMoney = $_REQUEST['ba_ConsignMoney'];
		$ba_DateTime = date('Y-m-d H:i:s');
		$ba_UserID = $userID;
		$ba_User = $userName;
		$ba_InStationID = $userStationID;
		$ba_InStation = $userStationName;
		$ba_Remark = $_REQUEST['ba_Remark'];
		$busratefe=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		$Ratefeetype=array('','','','','','','','','','','','','','','');
		$begindate=$_REQUEST['Begindate'];
		$enddate=$_REQUEST['Enddate'];
		$Allmm=$_REQUEST['Allmm'];
		$busallmm=$_REQUEST['busallmm'];
		$finalMoney=$_REQUEST['finalbalanceBalanceMoney'];
		$ratefe=$_REQUEST['ratefe'];
		$busratefe=explode(",",$ratefe);
		$ratefeename=$_REQUEST['ratefeename'];
		$Ratefeetype=explode(",,",$ratefeename);
		
		$lock="LOCK TABLES tms_acct_BalanceInHand WRITE,tms_acct_BalanceInHandTemp READ,tms_bd_BusInfo READ,tms_acct_BusRate READ,tms_acct_BusAccount READ,tms_bd_FeeType READ";
		$lockresult = $class_mysql_default->my_query("$lock");
//		sleep(10);
		if($BalanceStyle=='0'){
			$iii=0;
			$jj=0;
			$mm1[0]=0;
			$mm2[0]=0;
			$allmmd=0;	
			$stated=0;
			$prints="";
			$Rate=array('','','','','','','','','','','','','','','');
			$ba_AccountID=$BusID.time();
			$ba_BusNumber = $_REQUEST['ba_BusNumber'];
			$ba_BusType = $_REQUEST['ba_BusType'];
			$slectBusAccountd="SELECT bht_Date FROM tms_acct_BalanceInHand,tms_acct_BalanceInHandTemp
				WHERE bh_BusID='{$BusID}' AND tms_acct_BalanceInHand.bh_BusID=tms_acct_BalanceInHandTemp.bht_BusID AND bht_UserIDTemp='{$userID}' AND bht_Date>='{$begindate}' AND  bht_Date<='{$enddate}' order by bht_Date desc";
			$queryBusAccountd=$class_mysql_default->my_query("$slectBusAccountd");
			while($rowBusAccountd=mysql_fetch_array($queryBusAccountd)){
				$stated=1;
				$dd1=strtotime($rowBusAccountd['bht_Date']);
				$mm1[$iii+1]=date('Y-m',$dd1);
				if($mm1[$iii]!=$mm1[$iii+1]){
//					echo " 该车当前要结算的月份".$mm1[$iii+1];
					$iii=$iii+1;
				}			
			}
			$slectBusAccound="SELECT bh_Date FROM tms_acct_BalanceInHand,tms_acct_BalanceInHandTemp
				WHERE bh_BusID='{$BusID}' AND tms_acct_BalanceInHand.bh_BusID=tms_acct_BalanceInHandTemp.bht_BusID AND bht_UserIDTemp='{$userID}' AND bht_Date>='{$begindate}' AND  bht_Date<='{$enddate}' order by bh_Date desc";
			$queryBusAccound=$class_mysql_default->my_query("$slectBusAccound");
			while($rowBusAccound=mysql_fetch_array($queryBusAccound)){
				$stated=1;
				$dd2=strtotime($rowBusAccound['bh_Date']);
				$mm2[$jj+1]=date('Y-m',$dd2);
				if($mm2[$jj]!=$mm2[$jj+1]){
//					echo " 该车已结算的月份".$mm2[$jj+1];
					$jj=$jj+1;
				}		
			}
//			echo " 要结算月数".$iii;
//			echo " 已结算月数".$jj;
			for($i=1;$i<=$iii;$i++){//未结算过的月份，无重复
				if($jj==0){
					$allmmd=$allmmd+1;
//					echo " 确定收费月份".$mm1[$i];
				}else{
					$allmd=0;
					for($j=1;$j<=$jj;$j++){//结算过的月份，无重复
						if($mm1[$i]!=$mm2[$j]){
						$allmd=$allmd+1;
						}
					}
					if($allmd==$jj){
						$allmmd=$allmmd+1;
//						echo " 确定收费月份：".$mm1[$i];
					}
				}
			}
//			echo " 要结算月费的月数计算结果".$allmmd;
			if($allmmd==0&&$stated==0){
				$slectBusAccountnod="SELECT bht_Date FROM tms_acct_BalanceInHandTemp WHERE bht_BusID='{$BusID}' AND bht_UserIDTemp='{$userID}' AND bht_Date>='{$begindate}' AND  bht_Date<='{$enddate}' order by bht_Date desc";
				$queryBusAccountnod=$class_mysql_default->my_query("$slectBusAccountnod");
				while($rowBusAccountnod=mysql_fetch_array($queryBusAccountnod)){
					$dd=strtotime($rowBusAccountnod['bht_Date']);
					$mm1[$iii+1]=date('Y-m',$dd);
					if($mm1[$iii]!=$mm1[$iii+1]){
//						echo " 该车第一次来结算，月份".$mm1[$iii+1];
						$iii=$iii+1;
						$allmmd=$allmmd+1;
					}			
				}
			}
//			echo " 要结算月费的月数计算结果".$allmmd;
			if($allmmd!=$Allmm){
				$returnmm=$Allmm-$allmmd;
				$selectBusRated="SELECT br_BusID,br_BusNumber,br_BusType,br_BusUnit,br_InStationID,br_InStation,br_LineName,br_Rate1,br_Rate2,br_Rate3,br_Rate4,br_Rate5,br_Rate6,br_Rate7,br_Rate8,
					br_Rate9,br_Rate10,br_Rate11,br_Rate12,br_Rate13,br_Rate14,br_Rate15 FROM tms_acct_BusRate WHERE br_BusID='{$BusID}'";
				$queryBusRated=$class_mysql_default->my_query("$selectBusRated");
				$rowBusRated=mysql_fetch_array($queryBusRated);
				$Ratefeenumd=0;
				$selectFeeTyped="SELECT ft_FeeTypeName,ft_FeeTypeComputer,ft_FeePercent FROM tms_bd_FeeType";
				$queryFeeTyped=$class_mysql_default->my_query("$selectFeeTyped");
				while($rowFeeTyped=mysql_fetch_array($queryFeeTyped)){
					if($rowFeeTyped['ft_FeeTypeComputer']=='固定金额收费'){
						$Rate[$Ratefeenumd]=$busratefe[$Ratefeenumd+1]-($rowBusRated[$Ratefeenumd+7]*$returnmm);
						$busratefe[$Ratefeenumd+1]=$busratefe[$Ratefeenumd+1]-($rowBusRated[$Ratefeenumd+7]*$returnmm);
						$finalMoney=$finalMoney+($rowBusRated[$Ratefeenumd+7]*$returnmm);
					}
					$prints=$prints.",".$Rate[$Ratefeenumd];
					$Ratefeenumd=$Ratefeenumd+1;
				}
//				echo "<script>if(!confirm('有'+$returnmm+'个月的月费已被结算，最终结算金额：'+$ba_Paid +' ，确认结算?'))history.back();</script>";
//				$retData = array('retVal' => 'SUCC','returnmm' => $returnmm,'finalMoney'=> $finalMoney,'Rate1'=>$Rate[0],'Rate2'=>$Rate[1],'Rate3'=>$Rate[2],'Rate4'=>$Rate[3],'Rate5'=>$Rate[4],'Rate6'=>$Rate[5],
//							'Rate7'=>$Rate[6],'Rate8'=>$Rate[7],'Rate9'=>$Rate[8],'Rate10'=>$Rate[9],'Rate11'=>$Rate[10],'Rate12'=>$Rate[11],'Rate13'=>$Rate[12],'Rate14'=>$Rate[13],'Rate15'=>$Rate[14]);
				$printData = array('retVal' => 'SUCC','returnmm' => $returnmm,'finalMoney'=> $finalMoney,'printrate'=>$prints);
			}else{
				$printData = array('retVal' => 'SUCC1', 'retString' => '结算无冲突！');
			}
			
			$class_mysql_default->my_query("BEGIN");
			$insert="INSERT INTO tms_acct_BusAccount (ba_AccountID,ba_BusID,ba_BusNumber,ba_BusType,ba_BusUnit,ba_InStationID,ba_InStation,ba_BalanceCount,
				ba_CheckTotal,ba_Income,ba_Paid,ba_ServiceFee,ba_OtherFee1,ba_OtherFee2,ba_OtherFee3,ba_OtherFee4,ba_OtherFee5,ba_OtherFee6,
				ba_Money1,ba_Money2,ba_Money3,ba_Money4,ba_Money5,ba_Money6,ba_Money7,ba_Money8,ba_Money9,ba_Money10,ba_Money11,ba_Money12,
				ba_Money13,ba_Money14,ba_Money15,ba_Rate1,ba_Rate2,ba_Rate3,ba_Rate4,ba_Rate5,ba_Rate6,ba_Rate7,ba_Rate8,ba_Rate9,ba_Rate10,ba_Rate11,
				ba_Rate12,ba_Rate13,ba_Rate14,ba_Rate15,ba_DateTime,ba_UserID,ba_User,ba_Remark,ba_FeeTypeName1,ba_FeeTypeName2,ba_FeeTypeName3,ba_FeeTypeName4,
				ba_FeeTypeName5,ba_FeeTypeName6,ba_FeeTypeName7,ba_FeeTypeName8,ba_FeeTypeName9,ba_FeeTypeName10,ba_FeeTypeName11,ba_FeeTypeName12,
				ba_FeeTypeName13,ba_FeeTypeName14,ba_FeeTypeName15) VALUES ('{$ba_AccountID}','{$BusID}','{$ba_BusNumber}','{$ba_BusType}','{$ba_BusUnit}',
				'{$ba_InStationID}','{$ba_InStation}','{$ba_BalanceCount}','{$ba_CheckTotal}','{$ba_Income}','{$finalMoney}','{$ba_ServiceFee}','{$ba_OtherFee1}',
				'{$ba_OtherFee2}','{$ba_OtherFee3}','{$ba_OtherFee4}','{$ba_OtherFee5}','{$ba_OtherFee6}','{$ba_ConsignMoney}',NULL,NULL,NULL,NULL,NULL,NULL,
				NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'{$busratefe[1]}','{$busratefe[2]}','{$busratefe[3]}','{$busratefe[4]}','{$busratefe[5]}','{$busratefe[6]}','{$busratefe[7]}',
				'{$busratefe[8]}','{$busratefe[9]}','{$busratefe[10]}','{$busratefe[11]}','{$busratefe[12]}','{$busratefe[13]}','{$busratefe[14]}','{$busratefe[15]}',
				'{$ba_DateTime}','{$ba_UserID}','{$ba_User}','{$ba_Remark}','{$Ratefeetype[1]}','{$Ratefeetype[2]}','{$Ratefeetype[3]}','{$Ratefeetype[4]}','{$Ratefeetype[5]}',
				'{$Ratefeetype[6]}','{$Ratefeetype[7]}','{$Ratefeetype[8]}','{$Ratefeetype[9]}','{$Ratefeetype[10]}','{$Ratefeetype[11]}','{$Ratefeetype[12]}',
				'{$Ratefeetype[13]}','{$Ratefeetype[14]}','{$Ratefeetype[15]}')";
			$result = $class_mysql_default->my_query("$insert");
			if(!$result){
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '插入车辆结算表失败！', 'sql' => $insert);
				echo json_encode($retData);
				exit();
			}
			foreach (explode(";",$balanceBalanceNO) as $key =>$BalanceNO){
				$insertbalance="INSERT INTO tms_acct_BalanceInHand (bh_BalanceNO,bh_BusID,bh_BusNumber,bh_BusUnit,bh_BusModelID,bh_BusModel,bh_NoOfRunsID,
					bh_LineID,bh_NoOfRunsdate,bh_BeginStationTime,bh_StopStationTime,bh_BeginStationID,bh_BeginStation,bh_FromStationID,bh_FromStation,
					bh_EndStationID,bh_EndStation,bh_ServiceFee,bh_otherFee1,bh_otherFee2,bh_otherFee3,bh_otherFee4,bh_otherFee5,bh_otherFee6,bh_CheckTotal,
					bh_TicketTotal,bh_PriceTotal,bh_ConsignMoney,bh_SupTicketRen,bh_SupTicketMoney,bh_StationID,bh_Station,bh_UserID,bh_User,bh_Date,bh_Time,bh_State,bh_Type,
					bh_AccountID,bh_IsAccount) SELECT bht_BalanceNO,bht_BusID,bht_BusNumber,bht_BusUnit,bht_BusModelID,bht_BusModel,bht_NoOfRunsID,bht_LineID,
					bht_NoOfRunsdate,bht_BeginStationTime,bht_StopStationTime,bht_BeginStationID,bht_BeginStation,bht_FromStationID,bht_FromStation,bht_EndStationID,
					bht_EndStation,bht_ServiceFee,bht_otherFee1,bht_otherFee2,bht_otherFee3,bht_otherFee4,bht_otherFee5,bht_otherFee6,bht_CheckTotal,bht_TicketTotal,
					bht_PriceTotal,bht_ConsignMoney,bht_SupTicketRen,NULL,bht_StationID,bht_Station,bht_UserID,bht_User,bht_Date,bht_Time,bht_State,bht_Type,'{$ba_AccountID}','1' FROM 
					tms_acct_BalanceInHandTemp WHERE bht_BalanceNO='{$BalanceNO}'";
				$resultbalance = $class_mysql_default->my_query("$insertbalance");
				if(!$resultbalance){
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '插入结算表失败！', 'sql' => $insertbalance);
					echo json_encode($retData);
					exit();
				}
				$delete= "DELETE FROM tms_acct_BalanceInHandTemp WHERE bht_BalanceNO='{$BalanceNO}'";
				$resultdelete = $class_mysql_default->my_query("$delete");
				if(!$resultdelete){
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '删除临时结算表失败！', 'sql' => $delete);
					echo json_encode($retData);
					exit();
				} 
			}
			$class_mysql_default->my_query("COMMIT");
			echo json_encode($printData);
			exit();			
		}else{
			$ba_AccountID = time();
			$busallm=explode(",",$busallmm);
			$print="";
			$printrate="";
			$p=1;
			$Rate=array('','','','','','','','','','','','','','','');
			$selectBalanceInHandTemp="SELECT bht_BusID,bi_BusNumber FROM tms_acct_BalanceInHandTemp,tms_bd_BusInfo WHERE bht_UserIDTemp='{$userID}' 
				AND tms_acct_BalanceInHandTemp.bht_BusID=tms_bd_BusInfo.bi_BusID AND bi_BusUnit='{$BusUnit}' AND bht_Date>='{$begindate}' AND  bht_Date<='{$enddate}' GROUP BY bht_BusID ";
			$queryBalanceInHandTemp=$class_mysql_default->my_query("$selectBalanceInHandTemp");
			while($rowBusBalanceInHandTemp=mysql_fetch_array($queryBalanceInHandTemp)){
				$ii=0;
				$jj=0;
				$m1[0]=0;
				$m2[0]=0;
				$allmm=0;
				$state=0;
//				echo "收费车辆".$rowBusBalanceInHandTemp['bht_BusID'];
//				$balance=$rowBusBalanceInHandTemp[7]-$rowBusBalanceInHandTemp[0]-($rowBusBalanceInHandTemp[7]-$rowBusBalanceInHandTemp[0])*$rowBusBalanceInHandTemp[3]-$rowBusBalanceInHandTemp[1]
//					-$rowBusBalanceInHandTemp[2]-$rowBusBalanceInHandTemp[4]-$rowBusBalanceInHandTemp[5]-$rowBusBalanceInHandTemp[6];
				$bus=$rowBusBalanceInHandTemp['bi_BusNumber'];
				$slectBusAccount="SELECT bht_Date FROM tms_acct_BalanceInHand,tms_acct_BalanceInHandTemp
					WHERE bh_BusID='{$rowBusBalanceInHandTemp['bht_BusID']}' AND tms_acct_BalanceInHand.bh_BusID=tms_acct_BalanceInHandTemp.bht_BusID AND bht_UserIDTemp='{$userID}' AND bht_Date>='{$begindate}' AND  bht_Date<='{$enddate}' order by bht_Date desc";
				$queryBusAccount=$class_mysql_default->my_query("$slectBusAccount");
				while($rowBusAccount=mysql_fetch_array($queryBusAccount)){
					$state=1;
					$d1=strtotime($rowBusAccount['bht_Date']);
					$m1[$ii+1]=date('Y-m',$d1);
					if($m1[$ii]!=$m1[$ii+1]){
//						echo " 该车当前要结算的月份".$m1[$ii+1];
						$ii=$ii+1;
					}			
				}
				$slectBusAccoun="SELECT bh_Date FROM tms_acct_BalanceInHand,tms_acct_BalanceInHandTemp
					WHERE bh_BusID='{$rowBusBalanceInHandTemp['bht_BusID']}' AND tms_acct_BalanceInHand.bh_BusID=tms_acct_BalanceInHandTemp.bht_BusID AND bht_UserIDTemp='{$userID}' AND bht_Date>='{$begindate}' AND  bht_Date<='{$enddate}' order by bh_Date desc";
				$queryBusAccoun=$class_mysql_default->my_query("$slectBusAccoun");
				while($rowBusAccoun=mysql_fetch_array($queryBusAccoun)){
					$state=1;
					$d2=strtotime($rowBusAccoun['bh_Date']);
					$m2[$jj+1]=date('Y-m',$d2);
					if($m2[$jj]!=$m2[$jj+1]){
//						echo " 该车已结算的月份".$m2[$jj+1];
						$jj=$jj+1;
					}		
				}
//				echo " 要结算月数".$ii;
//				echo " 已结算月数".$jj;
				for($i=1;$i<=$ii;$i++){//未结算过的月份，无重复
					if($jj==0){
						$allmm=$allmm+1;
//						echo " 确定收费月份".$m1[$i];
					}else{
						$allm=0;
						for($j=1;$j<=$jj;$j++){//结算过的月份，无重复
							if($m1[$i]!=$m2[$j]){
							$allm=$allm+1;
							}
						}
						if($allm==$jj){
							$allmm=$allmm+1;
//							echo " 确定收费月份：".$m1[$i];
						}
					}
				}
//				echo " 要结算月费的月数计算结果".$allmm;
				if($allmm==0&&$state==0){
					$slectBusAccountno="SELECT bht_Date FROM tms_acct_BalanceInHandTemp WHERE bht_BusID='{$rowBusBalanceInHandTemp['bht_BusID']}' AND bht_UserIDTemp='{$userID}' AND bht_Date>='{$begindate}' AND  bht_Date<='{$enddate}' order by bht_Date desc";
					$queryBusAccountno=$class_mysql_default->my_query("$slectBusAccountno");
					while($rowBusAccountno=mysql_fetch_array($queryBusAccountno)){
						$d=strtotime($rowBusAccountno['bht_Date']);
						$m1[$ii+1]=date('Y-m',$d);
						if($m1[$ii]!=$m1[$ii+1]){
//							echo " 该车第一次来结算，月份".$m1[$ii+1];
							$ii=$ii+1;
							$allmm=$allmm+1;
						}			
					}
				}
//				echo " 要结算月费的月数计算结果".$allmm."<br/>";
				if($allmm!=$busallm[$p]){
					$returnmm=$busallm[$p]-$allmm;		
					$selectBusRate="SELECT br_BusID,br_BusNumber,br_BusType,br_BusUnit,br_InStationID,br_InStation,br_LineName,br_Rate1,br_Rate2,br_Rate3,br_Rate4,br_Rate5,br_Rate6,br_Rate7,br_Rate8,
						br_Rate9,br_Rate10,br_Rate11,br_Rate12,br_Rate13,br_Rate14,br_Rate15 FROM tms_acct_BusRate WHERE br_BusID='{$rowBusBalanceInHandTemp['bht_BusID']}'";
					$queryBusRate=$class_mysql_default->my_query("$selectBusRate");
					$rowBusRate=mysql_fetch_array($queryBusRate);
					$Ratefeenum=0;
					$selectFeeType="SELECT ft_FeeTypeName,ft_FeeTypeComputer,ft_FeePercent FROM tms_bd_FeeType";
					$queryFeeType=$class_mysql_default->my_query("$selectFeeType");
					while($rowFeeType=mysql_fetch_array($queryFeeType)){
						if($rowFeeType['ft_FeeTypeComputer']=='固定金额收费'){
							$Rate[$Ratefeenum]=$busratefe[$Ratefeenum+1]-($rowBusRate[$Ratefeenum+7]*$returnmm);
							$busratefe[$Ratefeenum+1]=$busratefe[$Ratefeenum+1]-($rowBusRate[$Ratefeenum+7]*$returnmm);
							$finalMoney=$finalMoney+$rowBusRate[$Ratefeenum+7]*$returnmm;
						}				
						$Ratefeenum=$Ratefeenum+1;
					}
					$print=$print."车辆 ".$bus." 有 ".$returnmm." 个月的月费刚已被结算，\r";
				}
				$p=$p+1;
			}
			for($i=0;$i<15;$i++){
				$printrate=$printrate.",".$Rate[$i];
			}
			if($print!=""){
//				echo "<script>if(!confirm(''+$print+'最终结算金额：'+$ba_Paid +' ，确认结算?'))history.back();</script>";
//				$retData = array('retVal' => 'SUCC','finalMoney'=> $finalMoney,'print'=>$print,'Rate1'=>$Rate[0],'Rate2'=>$Rate[1],'Rate3'=>$Rate[2],'Rate4'=>$Rate[3],'Rate5'=>$Rate[4],'Rate6'=>$Rate[5],
//						'Rate7'=>$Rate[6],'Rate8'=>$Rate[7],'Rate9'=>$Rate[8],'Rate10'=>$Rate[9],'Rate11'=>$Rate[10],'Rate12'=>$Rate[11],'Rate13'=>$Rate[12],'Rate14'=>$Rate[13],'Rate15'=>$Rate[14]);
				$printData=array('retVal' => 'SUCC','finalMoney'=> $finalMoney,'print'=>$print,'printrate'=>$printrate);
			}else{
				$printData = array('retVal' => 'SUCC1', 'retString' => '结算无冲突！');
			}
			
			$class_mysql_default->my_query("BEGIN"); 
			$insert="INSERT INTO tms_acct_BusAccount (ba_AccountID,ba_BusID,ba_BusNumber,ba_BusType,ba_BusUnit,ba_InStationID,ba_InStation,ba_BalanceCount,
				ba_CheckTotal,ba_Income,ba_Paid,ba_ServiceFee,ba_OtherFee1,ba_OtherFee2,ba_OtherFee3,ba_OtherFee4,ba_OtherFee5,ba_OtherFee6,
				ba_Money1,ba_Money2,ba_Money3,ba_Money4,ba_Money5,ba_Money6,ba_Money7,ba_Money8,ba_Money9,ba_Money10,ba_Money11,ba_Money12,
				ba_Money13,ba_Money14,ba_Money15,ba_Rate1,ba_Rate2,ba_Rate3,ba_Rate4,ba_Rate5,ba_Rate6,ba_Rate7,ba_Rate8,ba_Rate9,ba_Rate10,ba_Rate11,
				ba_Rate12,ba_Rate13,ba_Rate14,ba_Rate15,ba_DateTime,ba_UserID,ba_User,ba_Remark,ba_FeeTypeName1,ba_FeeTypeName2,ba_FeeTypeName3,ba_FeeTypeName4,
				ba_FeeTypeName5,ba_FeeTypeName6,ba_FeeTypeName7,ba_FeeTypeName8,ba_FeeTypeName9,ba_FeeTypeName10,ba_FeeTypeName11,ba_FeeTypeName12,
				ba_FeeTypeName13,ba_FeeTypeName14,ba_FeeTypeName15) VALUES ('{$ba_AccountID}',NULL,NULL,NULL,'{$BusUnit}','{$ba_InStationID}',
				'{$ba_InStation}','{$ba_BalanceCount}','{$ba_CheckTotal}','{$ba_Income}','{$finalMoney}','{$ba_ServiceFee}','{$ba_OtherFee1}','{$ba_OtherFee2}',
				'{$ba_OtherFee3}','{$ba_OtherFee4}','{$ba_OtherFee5}','{$ba_OtherFee6}','{$ba_ConsignMoney}',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,
				'{$busratefe[1]}','{$busratefe[2]}','{$busratefe[3]}','{$busratefe[4]}','{$busratefe[5]}','{$busratefe[6]}','{$busratefe[7]}','{$busratefe[8]}','{$busratefe[9]}',
				'{$busratefe[10]}','{$busratefe[11]}','{$busratefe[12]}','{$busratefe[13]}','{$busratefe[14]}','{$busratefe[15]}','{$ba_DateTime}','{$ba_UserID}','{$ba_User}',
				'{$ba_Remark}','{$Ratefeetype[1]}','{$Ratefeetype[2]}','{$Ratefeetype[3]}','{$Ratefeetype[4]}','{$Ratefeetype[5]}','{$Ratefeetype[6]}','{$Ratefeetype[7]}',
				'{$Ratefeetype[8]}','{$Ratefeetype[9]}','{$Ratefeetype[10]}','{$Ratefeetype[11]}','{$Ratefeetype[12]}','{$Ratefeetype[13]}','{$Ratefeetype[14]}','{$Ratefeetype[15]}')";
			$result = $class_mysql_default->my_query("$insert");
			if(!$result){
				$class_mysql_default->my_query("ROLLBACK");
				$retData = array('retVal' => 'FAIL', 'retString' => '插入车辆结算表1失败！', 'sql' => $insert);
				echo json_encode($retData);
				exit();
			}
			foreach (explode(";",$balanceBalanceNO) as $key =>$BalanceNO){
				$insertbalance="INSERT INTO tms_acct_BalanceInHand (bh_BalanceNO,bh_BusID,bh_BusNumber,bh_BusUnit,bh_BusModelID,bh_BusModel,bh_NoOfRunsID,
					bh_LineID,bh_NoOfRunsdate,bh_BeginStationTime,bh_StopStationTime,bh_BeginStationID,bh_BeginStation,bh_FromStationID,bh_FromStation,
					bh_EndStationID,bh_EndStation,bh_ServiceFee,bh_otherFee1,bh_otherFee2,bh_otherFee3,bh_otherFee4,bh_otherFee5,bh_otherFee6,bh_CheckTotal,
					bh_TicketTotal,bh_PriceTotal,bh_ConsignMoney,bh_SupTicketRen,bh_SupTicketMoney,bh_StationID,bh_Station,bh_UserID,bh_User,bh_Date,bh_Time,bh_State,bh_Type,
					bh_AccountID,bh_IsAccount) SELECT bht_BalanceNO,bht_BusID,bht_BusNumber,bht_BusUnit,bht_BusModelID,bht_BusModel,bht_NoOfRunsID,bht_LineID,
					bht_NoOfRunsdate,bht_BeginStationTime,bht_StopStationTime,bht_BeginStationID,bht_BeginStation,bht_FromStationID,bht_FromStation,bht_EndStationID,
					bht_EndStation,bht_ServiceFee,bht_otherFee1,bht_otherFee2,bht_otherFee3,bht_otherFee4,bht_otherFee5,bht_otherFee6,bht_CheckTotal,bht_TicketTotal,
					bht_PriceTotal,bht_ConsignMoney,bht_SupTicketRen,NULL,bht_StationID,bht_Station,bht_UserID,bht_User,bht_Date,bht_Time,bht_State,bht_Type,'{$ba_AccountID}','1' FROM 
					tms_acct_BalanceInHandTemp WHERE bht_BalanceNO='{$BalanceNO}'";
				$resultbalance = $class_mysql_default->my_query("$insertbalance");
				if(!$resultbalance){
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '插入结算表1失败！', 'sql' => $insertbalance);
					echo json_encode($retData);
					exit();
				}
				$delete= "DELETE FROM tms_acct_BalanceInHandTemp WHERE bht_BalanceNO='{$BalanceNO}'";
				$resultdelete = $class_mysql_default->my_query("$delete");
				if(!$resultdelete){
					$class_mysql_default->my_query("ROLLBACK");
					$retData = array('retVal' => 'FAIL', 'retString' => '删除临时结算表失败！', 'sql' => $delete);
					echo json_encode($retData);
					exit();
				} 
			}
			$class_mysql_default->my_query("COMMIT");
			echo json_encode($printData);
			exit();
		}
		break;
	case "getstationandid":
		$fromstation=$_GET['fromstation'];
		if($fromstation!=""){
			$queryString="SELECT sset_SiteName,sset_SiteID FROM tms_bd_SiteSet WHERE (sset_HelpCode LIKE '{$fromstation}%' OR 
					sset_SiteName LIKE '{$fromstation}%') AND sset_IsStation='1'";
			$result = $class_mysql_default->my_query("$queryString");
			while ($row = mysql_fetch_array($result)) {
				$retData[] = array(
					'from' => $row['sset_SiteName'],
					'fromID' =>$row['sset_SiteID']);
			}
			echo json_encode($retData);
		}else{
			$retData[] = array(
					'from' => '',
					'fromID' => '');
			echo json_encode($retData);
		}
		break;
	case "stationbalance":
		$FromStationID=$_REQUEST['FromStationID'];
		$FromStation=$_REQUEST['FromStation'];
		$ReachStationID=$_REQUEST['ReachStationID2'];
		$ReachStation=$_REQUEST['ReachStation2'];
		$CheckBeginDate=$_REQUEST['CheckBeginDate'];
		$CheckEndDate=$_REQUEST['CheckEndDate'];
		$ticketnumber1=$_REQUEST['ticketnumber1'];
		$allticketprice1=$_REQUEST['allticketprice1'];
		$luggagenumber1=$_REQUEST['luggagenumber1'];
		$allluggageprice1=$_REQUEST['allluggageprice1'];
		$ticketnumber2=$_REQUEST['ticketnumber2'];
		$allticketprice2=$_REQUEST['allticketprice2'];
		$luggagenumber2=$_REQUEST['luggagenumber2'];
		$allluggageprice2=$_REQUEST['allluggageprice2'];
		$balancemoney=$_REQUEST['balancemoney'];
		$curdate=date('Y-m-d');
		$curtime=date('H:i');
		$class_mysql_default->my_query("BEGIN");
		$update1="UPDATE tms_sell_SellTicket SET st_StationBalance='8' WHERE st_FromStationID='{$ReachStationID}' AND st_StationID='{$FromStationID}' 
			AND st_SellDate>='{$CheckBeginDate}' AND st_SellDate<='{$CheckEndDate}' AND st_StationBalance!='8'";
		$query1= $class_mysql_default->my_query("$update1");
		if(!$query1){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新售票数据1失败！', 'sql' => $queryBalanceInHandTemp);
			echo json_encode($retData);
			exit();
		}
		$update2="UPDATE tms_sell_SellTicket SET st_StationBalance='8' WHERE st_FromStationID='{$FromStationID}' AND st_StationID='{$ReachStationID}' 
			AND st_SellDate>='{$CheckBeginDate}' AND st_SellDate<='{$CheckEndDate}' AND st_StationBalance!='8'";
		$query2= $class_mysql_default->my_query("$update2");
		if(!$query2){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新售票数据2失败！', 'sql' => $queryBalanceInHandTemp);
			echo json_encode($retData);
			exit();
		}
		$updateLuggageCons1="UPDATE tms_lug_LuggageCons SET lc_StationBalance='8' WHERE lc_DestinationID='{$FromStationID}' AND lc_StationID='{$ReachStationID}' 
			AND lc_DeliveryDate>='{$CheckBeginDate}' AND lc_DeliveryDate<='{$CheckEndDate}' AND lc_StationBalance!='8'";
		$queryLuggageCons1= $class_mysql_default->my_query("$updateLuggageCons1");
		if(!$queryLuggageCons1){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新行包数据1失败！', 'sql' => $updateLuggageCons1);
			echo json_encode($retData);
			exit();
		}
		$updateLuggageCons2="UPDATE tms_lug_LuggageCons SET lc_StationBalance='8' WHERE lc_DestinationID='{$ReachStationID}' AND lc_StationID='{$FromStationID}' 
			AND lc_DeliveryDate>='{$CheckBeginDate}' AND lc_DeliveryDate<='{$CheckEndDate}' AND lc_StationBalance!='8'";
		$queryLuggageCons2= $class_mysql_default->my_query("$updateLuggageCons2");
		if(!$queryLuggageCons2){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '更新行包数据2失败！'.mysql_error(), 'sql' => $updateLuggageCons1);
			echo json_encode($retData);
			exit();
		}
		$insert="INSERT INTO tms_acct_StationBalance (sb_FStationID,sb_FStation,sb_FTicketNum,sb_FTicketMoney,sb_FLuggageNum,sb_FLuggageMoney,sb_SStationID,
			sb_SStation,sb_STicketNum,sb_STicketMoney,sb_SLuggageNum,sb_SLuggageMoney,sb_BeginDate,sb_EndDate,sb_Money,sb_BalanceID,sb_Balancer,sb_BalanceDate,
			sb_BalanceTime) VALUES ('$FromStationID','$FromStation','$ticketnumber1','$allticketprice1','$luggagenumber1','$allluggageprice1','$ReachStationID',
			'$ReachStation','$ticketnumber2','$allticketprice2','$luggagenumber2','$allluggageprice2','$CheckBeginDate','$CheckEndDate','$balancemoney',
			'$userID','$userName','$curdate','$curtime')";
		$queryinsert=$class_mysql_default->my_query("$insert");
		if(!$queryinsert){
			$class_mysql_default->my_query("ROLLBACK");
			$retData = array('retVal' => 'FAIL', 'retString' => '插入站间结算数据失败！', 'sql' => $updateLuggageCons1);
			echo json_encode($retData);
			exit();
		}
		$class_mysql_default->my_query("COMMIT");
		$retData = array('retVal' => 'SUCCESS','retString' => '结算成功！',);
		echo json_encode($retData);
		break;
	default:
}

function getSellersData($stationName,$class_mysql_default)
{
	if ($stationName == "")
		$stationName = "%";
	$queryString = "SELECT * FROM tms_sys_UsInfor WHERE ui_UserSation LIKE '{$stationName}' AND ui_UserGroup like '%售票组%'";
	$result = $class_mysql_default->my_query("$queryString");
	while ($row = mysql_fetch_array($result)) {
		$retData[] = array(
			'sellerID' => $row['ui_UserID']);
	}
//	echo "{\"sellers\":" . json_encode($retData) . "}";
	echo json_encode($retData);
}

function getCheckersData($stationName,$class_mysql_default)
{
	if ($stationName == "")
		$stationName = "%";
	$queryString = "SELECT * FROM tms_sys_UsInfor WHERE ui_UserSation LIKE '{$stationName}' AND ui_UserGroup like '%检票组%'";
	$result = $class_mysql_default->my_query("$queryString");
	while ($row = mysql_fetch_array($result)) {
		$retData[] = array(
			'checkerID' => $row['ui_UserID']);
	}
//	echo "{\"checkers\":" . json_encode($retData) . "}";
	echo json_encode($retData);
}
?>
