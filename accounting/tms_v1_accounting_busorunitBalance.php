<?php
/*
 * 结算提交页面
 * 结算金额=营收金额-站务费；
 * 最终结算金额=结算金额+行包费-劳务费-按月扣除其他费用
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
if(isset($_POST['finalbalanceBalanceMoney'])){//去掉submit不用这里了；
	$BalanceStyle=$_POST['BalanceStyle'];
	$balanceBalanceNO=$_POST['balanceBalanceNO'];
	$ba_BalanceCount = $_POST['ba_BalanceCount'];
	$ba_CheckTotal = $_POST['ba_CheckTotal'];
	$ba_Income = $_POST['ba_Income'];
	$ba_Paid = $_POST['finalbalanceBalanceMoney'];
	$ba_ServiceFee = $_POST['ba_ServiceFee'];
	$ba_OtherFee1 = $_POST['ba_OtherFee1'];
	$ba_OtherFee2 = $_POST['ba_OtherFee2'];
	$ba_OtherFee3 = $_POST['ba_OtherFee3'];
	$ba_OtherFee4 = $_POST['ba_OtherFee4'];
	$ba_OtherFee5 = $_POST['ba_OtherFee5'];
	$ba_OtherFee6 = $_POST['ba_OtherFee6'];
	$ba_ConsignMoney = $_POST['ba_ConsignMoney'];
	$ba_DateTime = date('Y-m-d H:i:s');
	$ba_UserID = $userID;
	$ba_User = $userName;
	$ba_InStationID = $userStationID;
	$ba_InStation = $userStationName;
	$ba_Remark = $_POST['ba_Remark'];
//	$ba_begindate=$_POST['Begindate'];
//	$ba_enddate=$_POST['Enddate'];
//	$Allmm=$_POST['Allmm'];
	$numfee=$_POST['numfee'];
	$Rate=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
	$Ratefeetype=array('','','','','','','','','','','','','','','');
	for($num=0;$num<$numfee;$num++){
			$s='Rate'.($num+1);
			$Rate[$num]=$_POST[$s];
			$c='Ratefeetype'.($num+1);
			$Ratefeetype[$num]=$_POST[$c];
		}
//	$iii=0;
//	$jj=0;
//	$mm1[0]=0;
//	$mm2[0]=0;
//	$allmmd=0;	
	if($BalanceStyle=='0'){
//		$stated=0;
		$ba_BusID=$_POST['ba_BusID'];
		$ba_AccountID=$ba_BusID.time();
		$ba_BusNumber = $_POST['ba_BusNumber'];
		$ba_BusType = $_POST['ba_BusType'];
		$ba_BusUnit = $_POST['ba_BusUnit'];		
//		echo "车辆编号".$ba_BusID;		
//		$lock="LOCK TABLES tms_acct_BalanceInHand WRITE";
//		$lockresult = $class_mysql_default->my_query("$lock");
//		$lock="LOCK TABLES tms_acct_BalanceInHand WRITE,tms_acct_BalanceInHandTemp WRITE,tms_acct_BusAccount WRITE,tms_acct_BusRate WRITE";
//		$lockresult = $class_mysql_default->my_query("$lock");
//		$slectBusAccountd="SELECT bht_Date FROM tms_acct_BalanceInHand,tms_acct_BalanceInHandTemp
//			WHERE bh_BusID='{$ba_BusID}' AND tms_acct_BalanceInHand.bh_BusID=tms_acct_BalanceInHandTemp.bht_BusID AND bht_UserIDTemp='{$userID}' AND bht_Date>='{$ba_begindate}' AND  bht_Date<='{$ba_enddate}' order by bht_Date desc FOR UPDATE";
//		$queryBusAccountd=$class_mysql_default->my_query("$slectBusAccountd");
//		while($rowBusAccountd=mysql_fetch_array($queryBusAccountd)){
//			$stated=1;
//			$dd1=strtotime($rowBusAccountd['bht_Date']);
//			$mm1[$iii+1]=date('Y-m',$dd1);
//			if($mm1[$iii]!=$mm1[$iii+1]){
//				echo " 该车当前要结算的月份".$mm1[$iii+1];
//				$iii=$iii+1;
//			}			
//		}
//		$slectBusAccound="SELECT bh_Date FROM tms_acct_BalanceInHand,tms_acct_BalanceInHandTemp
//			WHERE bh_BusID='{$ba_BusID}' AND tms_acct_BalanceInHand.bh_BusID=tms_acct_BalanceInHandTemp.bht_BusID AND bht_UserIDTemp='{$userID}' AND bht_Date>='{$ba_begindate}' AND  bht_Date<='{$ba_enddate}' order by bh_Date desc";
//		$queryBusAccound=$class_mysql_default->my_query("$slectBusAccound");
//		while($rowBusAccound=mysql_fetch_array($queryBusAccound)){
//			$stated=1;
//			$dd2=strtotime($rowBusAccound['bh_Date']);
//			$mm2[$jj+1]=date('Y-m',$dd2);
//			if($mm2[$jj]!=$mm2[$jj+1]){
//				echo " 该车已结算的月份".$mm2[$jj+1];
//				$jj=$jj+1;
//			}		
//		}
//		echo " 要结算月数".$iii;
//		echo " 已结算月数".$jj;
//		for($i=1;$i<=$iii;$i++){//未结算过的月份，无重复
//			if($jj==0){
//				$allmmd=$allmmd+1;
//				echo " 确定收费月份".$mm1[$i];
//			}else{
//				$allmd=0;
//				for($j=1;$j<=$jj;$j++){//结算过的月份，无重复
//					if($mm1[$i]!=$mm2[$j]){
//					$allmd=$allmd+1;
//					}
//				}
//				if($allmd==$jj){
//					$allmmd=$allmmd+1;
//					echo " 确定收费月份：".$mm1[$i];
//				}
//			}
//		}
//		echo " 要结算月费的月数计算结果".$allmmd;
//		if($allmmd==0&&$stated==0){
//			$slectBusAccountnod="SELECT bht_Date FROM tms_acct_BalanceInHandTemp WHERE bht_BusID='{$ba_BusID}' AND bht_UserIDTemp='{$userID}' AND bht_Date>='{$ba_begindate}' AND  bht_Date<='{$ba_enddate}' order by bht_Date desc";
//			$queryBusAccountnod=$class_mysql_default->my_query("$slectBusAccountnod");
//			while($rowBusAccountnod=mysql_fetch_array($queryBusAccountnod)){
//				$dd=strtotime($rowBusAccountnod['bht_Date']);
//				$mm1[$iii+1]=date('Y-m',$dd);
//				if($mm1[$iii]!=$mm1[$iii+1]){
//					echo " 该车第一次来结算，月份".$mm1[$iii+1];
//					$iii=$iii+1;
//					$allmmd=$allmmd+1;
//				}			
//			}
//		}
//		echo " 要结算月费的月数计算结果".$allmmd;
//		if($allmmd!=$Allmm){
//			$returnmm=$Allmm-$allmmd;
//			echo $returnmm;
////			$pp=0;
////			for($i=1;$i<=$ii;$i++){//未结算过的月份，无重复
////				$p=0;
////				for($j=1;$j<=$iii;$j++){//结算过的月份，无重复
////					if($m1[$i]!=$mm1[$j]){
////					$p=$p+1;
////					}
////				}
////				if($p==$iii){
////					$month[$pp]=$m1[$i];
////					echo " 已收费月份：".$m1[$i];
////					$pp=$pp+1;
////					$allmmd=$allmmd-1;
////				}
////			}
//			$selectBusRated="SELECT br_BusID,br_BusNumber,br_BusType,br_BusUnit,br_InStationID,br_InStation,br_LineName,br_Rate1,br_Rate2,br_Rate3,br_Rate4,br_Rate5,br_Rate6,br_Rate7,br_Rate8,
//				br_Rate9,br_Rate10,br_Rate11,br_Rate12,br_Rate13,br_Rate14,br_Rate15 FROM tms_acct_BusRate WHERE br_BusID='{$ba_BusID}'";
//			$queryBusRated=$class_mysql_default->my_query("$selectBusRated");
//			$rowBusRated=mysql_fetch_array($queryBusRated);
//			$Ratefeenumd=0;
//			$selectFeeTyped="SELECT ft_FeeTypeName,ft_FeeTypeComputer,ft_FeePercent FROM tms_bd_FeeType";
//			$queryFeeTyped=$class_mysql_default->my_query("$selectFeeTyped");
//			while($rowFeeTyped=mysql_fetch_array($queryFeeTyped)){
//				if($rowFeeTyped['ft_FeeTypeComputer']=='固定金额收费'){
//					$Rate[$Ratefeenumd]=$rowBusRated[$Ratefeenumd+7]*$allmmd;
//					$ba_Paid=$ba_Paid+($rowBusRated[$Ratefeenumd+7]*$returnmm);
//				}
//				$Ratefeenumd=$Ratefeenumd+1;
//			}
//			echo $ba_Paid;
//			echo "<script>if(!confirm('有'+$returnmm+'个月的月费已被结算，最终结算金额：'+$ba_Paid +' ，确认结算?'))history.back();</script>";
//		}
//		echo "<script>if(!confirm('收费后点击确定确认结算！'))history.back();</script>";
//		echo "<script>alert('找零后确认结算！');history.back();</script>";
		$class_mysql_default->my_query("BEGIN");
		$insert="INSERT INTO tms_acct_BusAccount (ba_AccountID,ba_BusID,ba_BusNumber,ba_BusType,ba_BusUnit,ba_InStationID,ba_InStation,ba_BalanceCount,
			ba_CheckTotal,ba_Income,ba_Paid,ba_ServiceFee,ba_OtherFee1,ba_OtherFee2,ba_OtherFee3,ba_OtherFee4,ba_OtherFee5,ba_OtherFee6,
			ba_Money1,ba_Money2,ba_Money3,ba_Money4,ba_Money5,ba_Money6,ba_Money7,ba_Money8,ba_Money9,ba_Money10,ba_Money11,ba_Money12,
			ba_Money13,ba_Money14,ba_Money15,ba_Rate1,ba_Rate2,ba_Rate3,ba_Rate4,ba_Rate5,ba_Rate6,ba_Rate7,ba_Rate8,ba_Rate9,ba_Rate10,ba_Rate11,
			ba_Rate12,ba_Rate13,ba_Rate14,ba_Rate15,ba_DateTime,ba_UserID,ba_User,ba_Remark,ba_FeeTypeName1,ba_FeeTypeName2,ba_FeeTypeName3,ba_FeeTypeName4,
			ba_FeeTypeName5,ba_FeeTypeName6,ba_FeeTypeName7,ba_FeeTypeName8,ba_FeeTypeName9,ba_FeeTypeName10,ba_FeeTypeName11,ba_FeeTypeName12,
			ba_FeeTypeName13,ba_FeeTypeName14,ba_FeeTypeName15) VALUES ('{$ba_AccountID}','{$ba_BusID}','{$ba_BusNumber}','{$ba_BusType}','{$ba_BusUnit}',
			'{$ba_InStationID}','{$ba_InStation}','{$ba_BalanceCount}','{$ba_CheckTotal}','{$ba_Income}','{$ba_Paid}','{$ba_ServiceFee}','{$ba_OtherFee1}',
			'{$ba_OtherFee2}','{$ba_OtherFee3}','{$ba_OtherFee4}','{$ba_OtherFee5}','{$ba_OtherFee6}','{$ba_ConsignMoney}',NULL,NULL,NULL,NULL,NULL,NULL,
			NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'{$Rate[0]}','{$Rate[1]}','{$Rate[2]}','{$Rate[3]}','{$Rate[4]}','{$Rate[5]}','{$Rate[6]}','{$Rate[7]}',
			'{$Rate[8]}','{$Rate[9]}','{$Rate[10]}','{$Rate[11]}','{$Rate[12]}','{$Rate[13]}','{$Rate[14]}','{$ba_DateTime}','{$ba_UserID}','{$ba_User}',
			'{$ba_Remark}','{$Ratefeetype[0]}','{$Ratefeetype[1]}','{$Ratefeetype[2]}','{$Ratefeetype[3]}','{$Ratefeetype[4]}','{$Ratefeetype[5]}',
			'{$Ratefeetype[6]}','{$Ratefeetype[7]}','{$Ratefeetype[8]}','{$Ratefeetype[9]}','{$Ratefeetype[10]}','{$Ratefeetype[11]}','{$Ratefeetype[12]}',
			'{$Ratefeetype[13]}','{$Ratefeetype[14]}')";
		$result = $class_mysql_default->my_query("$insert");
		if(!$result){
			$class_mysql_default->my_query("ROLLBACK");
			echo "<script>alert('插入车辆结算表失败！');history.back();</script>";
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
				echo "<script>alert('插入结算表失败！');history.back();</script>";
				exit();
			}
			$delete= "DELETE FROM tms_acct_BalanceInHandTemp WHERE bht_BalanceNO='{$BalanceNO}'";
			$resultdelete = $class_mysql_default->my_query("$delete");
			if(!$resultdelete){
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('删除临时结算表失败！');history.back();</script>";
				exit();
			} 
		}
		$class_mysql_default->my_query("COMMIT");
		echo "<script>alert('结算信息提交成功!');location.assign('tms_v1_accounting_busorunitQuery.php');</script>";
	}else{
		$ba_BusUnit = $_POST['ba_BusUnit1'];
		$ba_AccountID = time();
//		$print="";
		$class_mysql_default->my_query("BEGIN"); 
		$insert="INSERT INTO tms_acct_BusAccount (ba_AccountID,ba_BusID,ba_BusNumber,ba_BusType,ba_BusUnit,ba_InStationID,ba_InStation,ba_BalanceCount,
			ba_CheckTotal,ba_Income,ba_Paid,ba_ServiceFee,ba_OtherFee1,ba_OtherFee2,ba_OtherFee3,ba_OtherFee4,ba_OtherFee5,ba_OtherFee6,
			ba_Money1,ba_Money2,ba_Money3,ba_Money4,ba_Money5,ba_Money6,ba_Money7,ba_Money8,ba_Money9,ba_Money10,ba_Money11,ba_Money12,
			ba_Money13,ba_Money14,ba_Money15,ba_Rate1,ba_Rate2,ba_Rate3,ba_Rate4,ba_Rate5,ba_Rate6,ba_Rate7,ba_Rate8,ba_Rate9,ba_Rate10,ba_Rate11,
			ba_Rate12,ba_Rate13,ba_Rate14,ba_Rate15,ba_DateTime,ba_UserID,ba_User,ba_Remark,ba_FeeTypeName1,ba_FeeTypeName2,ba_FeeTypeName3,ba_FeeTypeName4,
			ba_FeeTypeName5,ba_FeeTypeName6,ba_FeeTypeName7,ba_FeeTypeName8,ba_FeeTypeName9,ba_FeeTypeName10,ba_FeeTypeName11,ba_FeeTypeName12,
			ba_FeeTypeName13,ba_FeeTypeName14,ba_FeeTypeName15) VALUES ('{$ba_AccountID}',NULL,NULL,NULL,'{$ba_BusUnit}','{$ba_InStationID}',
			'{$ba_InStation}','{$ba_BalanceCount}','{$ba_CheckTotal}','{$ba_Income}','{$ba_Paid}','{$ba_ServiceFee}','{$ba_OtherFee1}','{$ba_OtherFee2}',
			'{$ba_OtherFee3}','{$ba_OtherFee4}','{$ba_OtherFee5}','{$ba_OtherFee6}','{$ba_ConsignMoney}',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,
			NULL,NULL,NULL,NULL,'{$Rate[0]}','{$Rate[1]}','{$Rate[2]}','{$Rate[3]}','{$Rate[4]}','{$Rate[5]}','{$Rate[6]}','{$Rate[7]}','{$Rate[8]}',
			'{$Rate[9]}','{$Rate[10]}','{$Rate[11]}','{$Rate[12]}','{$Rate[13]}','{$Rate[14]}','{$ba_DateTime}','{$ba_UserID}','{$ba_User}','{$ba_Remark}',
			'{$Ratefeetype[0]}','{$Ratefeetype[1]}','{$Ratefeetype[2]}','{$Ratefeetype[3]}','{$Ratefeetype[4]}','{$Ratefeetype[5]}','{$Ratefeetype[6]}',
			'{$Ratefeetype[7]}','{$Ratefeetype[8]}','{$Ratefeetype[9]}','{$Ratefeetype[10]}','{$Ratefeetype[11]}','{$Ratefeetype[12]}','{$Ratefeetype[13]}','{$Ratefeetype[14]}')";
		$result = $class_mysql_default->my_query("$insert");
		if(!$result){
			$class_mysql_default->my_query("ROLLBACK");
			echo "<script>alert('插入车辆结算表1失败！');history.back();</script>";
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
				echo "<script>alert('插入结算表1失败！');history.back();</script>";
				exit();
			}
			$delete= "DELETE FROM tms_acct_BalanceInHandTemp WHERE bht_BalanceNO='{$BalanceNO}'";
			$resultdelete = $class_mysql_default->my_query("$delete");
			if(!$resultdelete){
				$class_mysql_default->my_query("ROLLBACK");
				echo "<script>alert('删除临时结算表失败！');history.back();</script>";
				exit();
			} 
		}
		$class_mysql_default->my_query("COMMIT");
		echo "<script>alert('结算信息提交成功!');location.assign('tms_v1_accounting_busorunitQuery.php');</script>";
	}
//		$selectBalanceInHandTemp="SELECT IFNULL(SUM(bht_ServiceFee),0),IFNULL(SUM(bht_otherFee1),0),IFNULL(SUM(bht_otherFee2),0),bht_otherFee3,IFNULL(SUM(bht_otherFee4),0),IFNULL(SUM(bht_otherFee5),0),IFNULL(SUM(bht_otherFee6),0),
//				IFNULL(SUM(bht_PriceTotal),0),bht_BusID FROM tms_acct_BalanceInHandTemp,tms_bd_BusInfo WHERE bht_UserIDTemp='{$userID}' 
//				AND tms_acct_BalanceInHandTemp.bht_BusID=tms_bd_BusInfo.bi_BusID AND bi_BusUnit='{$ba_BusUnit}' AND bht_Date>='{$ba_begindate}' AND  bht_Date<='{$ba_enddate}' GROUP BY bht_BusID ";
//		$queryBalanceInHandTemp=$class_mysql_default->my_query("$selectBalanceInHandTemp");
//		while($rowBusBalanceInHandTemp=mysql_fetch_array($queryBalanceInHandTemp)){
//			$ii=0;
//			$jj=0;
//			$m1[0]=0;
//			$m2[0]=0;
//			$allmm=0;
//			$state=0;
//			echo "收费车辆".$rowBusBalanceInHandTemp['bht_BusID'];
//			$balance=$rowBusBalanceInHandTemp[7]-$rowBusBalanceInHandTemp[0]-($rowBusBalanceInHandTemp[7]-$rowBusBalanceInHandTemp[0])*$rowBusBalanceInHandTemp[3]-$rowBusBalanceInHandTemp[1]
//				-$rowBusBalanceInHandTemp[2]-$rowBusBalanceInHandTemp[4]-$rowBusBalanceInHandTemp[5]-$rowBusBalanceInHandTemp[6];
//	
//		$slectBusAccount="SELECT bht_Date FROM tms_acct_BalanceInHand,tms_acct_BalanceInHandTemp
//			WHERE bh_BusID='{$rowBusBalanceInHandTemp['bht_BusID']}' AND tms_acct_BalanceInHand.bh_BusID=tms_acct_BalanceInHandTemp.bht_BusID AND bht_UserIDTemp='{$userID}' AND bht_Date>='{$ba_begindate}' AND  bht_Date<='{$ba_enddate}' order by bht_Date desc";
//		$queryBusAccount=$class_mysql_default->my_query("$slectBusAccount");
//		while($rowBusAccount=mysql_fetch_array($queryBusAccount)){
//			$state=1;
//			$d1=strtotime($rowBusAccount['bht_Date']);
//			$m1[$ii+1]=date('Y-m',$d1);
//			if($m1[$ii]!=$m1[$ii+1]){
//				echo " 该车当前要结算的月份".$m1[$ii+1];
//				$ii=$ii+1;
//			}			
//		}
//		$slectBusAccoun="SELECT bh_Date FROM tms_acct_BalanceInHand,tms_acct_BalanceInHandTemp
//			WHERE bh_BusID='{$rowBusBalanceInHandTemp['bht_BusID']}' AND tms_acct_BalanceInHand.bh_BusID=tms_acct_BalanceInHandTemp.bht_BusID AND bht_UserIDTemp='{$userID}' AND bht_Date>='{$ba_begindate}' AND  bht_Date<='{$ba_enddate}' order by bh_Date desc";
//		$queryBusAccoun=$class_mysql_default->my_query("$slectBusAccoun");
//		while($rowBusAccoun=mysql_fetch_array($queryBusAccoun)){
//			$state=1;
//			$d2=strtotime($rowBusAccoun['bh_Date']);
//			$m2[$jj+1]=date('Y-m',$d2);
//			if($m2[$jj]!=$m2[$jj+1]){
//				echo " 该车已结算的月份".$m2[$jj+1];
//				$jj=$jj+1;
//			}		
//		}
//		echo " 要结算月数".$ii;
//		echo " 已结算月数".$jj;
//		for($i=1;$i<=$ii;$i++){//未结算过的月份，无重复
//			if($jj==0){
//				$allmm=$allmm+1;
//				echo " 确定收费月份".$m1[$i];
//			}else{
//				$allm=0;
//				for($j=1;$j<=$jj;$j++){//结算过的月份，无重复
//					if($m1[$i]!=$m2[$j]){
//					$allm=$allm+1;
//					}
//				}
//				if($allm==$jj){
//					$allmm=$allmm+1;
//					echo " 确定收费月份：".$m1[$i];
//				}
//			}
//		}
//		echo " 要结算月费的月数计算结果".$allmm;
//		if($allmm==0&&$state==0){
//			$slectBusAccountno="SELECT bht_Date FROM tms_acct_BalanceInHandTemp WHERE bht_BusID='{$rowBusBalanceInHandTemp['bht_BusID']}' AND bht_UserIDTemp='{$userID}' AND bht_Date>='{$ba_begindate}' AND  bht_Date<='{$ba_enddate}' order by bht_Date desc";
//			$queryBusAccountno=$class_mysql_default->my_query("$slectBusAccountno");
//			while($rowBusAccountno=mysql_fetch_array($queryBusAccountno)){
//				$d=strtotime($rowBusAccountno['bht_Date']);
//				$m1[$ii+1]=date('Y-m',$d);
//				if($m1[$ii]!=$m1[$ii+1]){
//					echo " 该车第一次来结算，月份".$m1[$ii+1];
//					$ii=$ii+1;
//					$allmm=$allmm+1;
//				}			
//			}
//		}
//		echo " 要结算月费的月数计算结果".$allmm."<br/>";
//		if($allmm!=$Allmm){
//			$returnmm=$Allmm-$allmm;
//			echo $returnmm;
//			
//		$selectBusRate="SELECT br_BusID,br_BusNumber,br_BusType,br_BusUnit,br_InStationID,br_InStation,br_LineName,br_Rate1,br_Rate2,br_Rate3,br_Rate4,br_Rate5,br_Rate6,br_Rate7,br_Rate8,
//			br_Rate9,br_Rate10,br_Rate11,br_Rate12,br_Rate13,br_Rate14,br_Rate15 FROM tms_acct_BusRate WHERE br_BusID='{$rowBusBalanceInHandTemp['bht_BusID']}'";
//		$queryBusRate=$class_mysql_default->my_query("$selectBusRate");
//		$rowBusRate=mysql_fetch_array($queryBusRate);
//		$Ratefeenum=0;
//		$selectFeeType="SELECT ft_FeeTypeName,ft_FeeTypeComputer,ft_FeePercent FROM tms_bd_FeeType";
//		$queryFeeType=$class_mysql_default->my_query("$selectFeeType");
//		while($rowFeeType=mysql_fetch_array($queryFeeType)){
//				if($rowFeeTyped['ft_FeeTypeComputer']=='固定金额收费'){
//					$Rate[$Ratefeenumd]=$Rate[$Ratefeenumd]-($rowBusRated[$Ratefeenumd+7]*$returnmm);
//					$ba_Paid=$ba_Paid+($rowBusRated[$Ratefeenumd+7]*$returnmm);
//				}				
//			$Ratefeenum=$Ratefeenum+1;
//		}
//		$bus=$rowBusBalanceInHandTemp['bht_BusID'];
//		$print=$print."车辆 ".$bus." 有 ".$returnmm."个月的月费已被结算\n";
//		echo "<script>if(!confirm('车辆 '+$bus+' 有 '+$returnmm+'个月的月费已被结算，最终结算金额：'+$ba_Paid +' ，确认结算?'))history.back();</script>";
//		}
//	}
//	if($print!=""){
//		echo "<script>if(!confirm(''+$print+'最终结算金额：'+$ba_Paid +' ，确认结算?'))history.back();</script>";
//	}
//	echo "<script>if(!confirm('确认结算?'))history.back();</script>";

}else{
	$balanceBalanceNO=$_POST['balanceBalanceNO'];
	$balanceCheckTotal=$_POST['balanceCheckTotal'];
	$balanceTicketTotal=$_POST['balanceTicketTotal'];
	$balancePriceTotal=$_POST['balancePriceTotal'];
	$balanceBalanceMoney=$_POST['balanceBalanceMoney'];
	$balanceServiceFee=$_POST['balanceServiceFee'];
	$balanceotherFee1=$_POST['balanceotherFee1'];
	$balanceotherFee2=$_POST['balanceotherFee2'];
	$balanceotherFee3=$_POST['balanceotherFee3'];
	$balanceotherFee4=$_POST['balanceotherFee4'];
	$balanceotherFee5=$_POST['balanceotherFee5'];
	$balanceotherFee6=$_POST['balanceotherFee6'];
	$balanceConsignMoney=$_POST['balanceConsignMoney'];
	$BusUnit=$_POST['BusUnit'];
	$BusType=$_POST['BusType'];
	$BusID=$_POST['BusID'];
	$BusIDs=$_POST['BusIDs'];
	$BusNumber=$_POST['BusNumber'];
	$balancenum=$_POST['balancenum'];
	$BalanceStyle=$_POST['BalanceStyle'];
	$begindate=$_POST['begindate'];
	$enddate=$_POST['enddate'];
	$Ratefee=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
	$ratefe="";
	$ratefeename="";
	$ii=0;
	$jj=0;
	$m1[0]=0;
	$m2[0]=0;
	$allmm=0;
	$state=0;
	if($BalanceStyle=='0'){
//		echo "车辆编号".$BusID;
		$selectBusRate="SELECT br_BusID,br_BusNumber,br_BusType,br_BusUnit,br_InStationID,br_InStation,br_LineName,br_Rate1,br_Rate2,br_Rate3,br_Rate4,br_Rate5,br_Rate6,br_Rate7,br_Rate8,
			br_Rate9,br_Rate10,br_Rate11,br_Rate12,br_Rate13,br_Rate14,br_Rate15 FROM tms_acct_BusRate WHERE br_BusID='{$BusID}'";
		$queryBusRate=$class_mysql_default->my_query("$selectBusRate");
		$rowBusRate=mysql_fetch_array($queryBusRate);
	//	$selectbusaccount="SELECT MAX(ba_DateTime) AS DateTime FORM tms_acct_BusAccount WHERE ba_BusID='{$BusID}'";
	//	$querybusaccount=$class_mysql_default->my_query("$selectbusaccount");
	//	$rowbusaccount=mysql_fetch_array($querybusaccount);
		$slectBusAccount="SELECT bht_Date FROM tms_acct_BalanceInHand,tms_acct_BalanceInHandTemp
			WHERE bh_BusID='{$BusID}' AND tms_acct_BalanceInHand.bh_BusID=tms_acct_BalanceInHandTemp.bht_BusID AND bht_UserIDTemp='{$userID}' AND bht_Date>='{$begindate}' AND  bht_Date<='{$enddate}' order by bht_Date desc";
		$queryBusAccount=$class_mysql_default->my_query("$slectBusAccount");
		while($rowBusAccount=mysql_fetch_array($queryBusAccount)){
			$state=1;
			$d1=strtotime($rowBusAccount['bht_Date']);
			$m1[$ii+1]=date('Y-m',$d1);
			if($m1[$ii]!=$m1[$ii+1]){
//				echo " 该车当前要结算的月份".$m1[$ii+1];
				$ii=$ii+1;
			}			
		}
		$slectBusAccoun="SELECT bh_Date FROM tms_acct_BalanceInHand,tms_acct_BalanceInHandTemp
			WHERE bh_BusID='{$BusID}' AND tms_acct_BalanceInHand.bh_BusID=tms_acct_BalanceInHandTemp.bht_BusID AND bht_UserIDTemp='{$userID}' AND bht_Date>='{$begindate}' AND  bht_Date<='{$enddate}' order by bh_Date desc";
		$queryBusAccoun=$class_mysql_default->my_query("$slectBusAccoun");
		while($rowBusAccoun=mysql_fetch_array($queryBusAccoun)){
			$state=1;
			$d2=strtotime($rowBusAccoun['bh_Date']);
			$m2[$jj+1]=date('Y-m',$d2);
			if($m2[$jj]!=$m2[$jj+1]){
//				echo " 该车已结算的月份".$m2[$jj+1];
				$jj=$jj+1;
			}		
		}
//		echo " 要结算月数".$ii;
//		echo " 已结算月数".$jj;
		for($i=1;$i<=$ii;$i++){//未结算过的月份，无重复
			if($jj==0){
				$allmm=$allmm+1;
//				echo " 确定收费月份".$m1[$i];
			}else{
				$allm=0;
				for($j=1;$j<=$jj;$j++){//结算过的月份，无重复
					if($m1[$i]!=$m2[$j]){
					$allm=$allm+1;
					}
				}
//				echo "结算月份对比".$allm;
//				echo "结算月份对比".$jj;
				if($allm==$jj){
					$allmm=$allmm+1;
//					echo " 确定收费月份：".$m1[$i];
				}
			}
		}
//		echo " 要结算月费的月数计算结果".$allmm;
		if($allmm==0&&$state==0){
			$slectBusAccountno="SELECT bht_Date FROM tms_acct_BalanceInHandTemp WHERE bht_BusID='{$BusID}' AND bht_UserIDTemp='{$userID}' AND bht_Date>='{$begindate}' AND  bht_Date<='{$enddate}' order by bht_Date desc";
			$queryBusAccountno=$class_mysql_default->my_query("$slectBusAccountno");
			while($rowBusAccountno=mysql_fetch_array($queryBusAccountno)){
				$d=strtotime($rowBusAccountno['bht_Date']);
				$m1[$ii+1]=date('Y-m',$d);
				if($m1[$ii]!=$m1[$ii+1]){
//					echo " 该车第一次来结算，月份".$m1[$ii+1];
					$ii=$ii+1;
					$allmm=$allmm+1;
				}			
			}
		}
//		echo " 要结算月费的月数计算结果".$allmm;
		$Ratefeenum=0;
		$selectFeeType="SELECT ft_FeeTypeName,ft_FeeTypeComputer,ft_FeePercent FROM tms_bd_FeeType";
		$queryFeeType=$class_mysql_default->my_query("$selectFeeType");
		while($rowFeeType=mysql_fetch_array($queryFeeType)){
			if($rowFeeType['ft_FeeTypeComputer']=='按百分比收费'){
//				if($allm==0&&$allmm!=0){
//					$Ratefee[$Ratefeenum]=0;
//				}else{
				$Ratefee[$Ratefeenum]=$rowBusRate[$Ratefeenum+7]*$balanceBalanceMoney/100;
//				}
			}else{
				$Ratefee[$Ratefeenum]=$rowBusRate[$Ratefeenum+7]*$allmm;
			}
//			echo $balanceBalanceMoney;
			$Ratefeenum=$Ratefeenum+1;
		}
//修改版本2
//		$slectBusAccount="SELECT MAX(bh_DateTime) AS DateTime FROM tms_acct_BalanceInHand,tms_acct_BalanceInHandTemp
//			WHERE bh_BusID='{$BusID}' AND tms_acct_BalanceInHand.bh_BusID=tms_acct_BalanceInHandTemp.bht_BusID ";
//		if($rowBusAccount['DateTime']){
//			$d=strtotime($rowBusAccount['DateTime']);
//			$yy=date('Y')-date('Y',$d);
//			$mm=date('m')-date('m',$d);
//			$allmm=$yy*12+$mm;
//			if($allmm==0){
//				for($i=1;$i<=15;$i++){
//					$rowBusRate['br_Rate'.$i]=0;
//				}
//			}
//		}else{
//			$slectBusAccount1="SELECT MIX(bht_DateTime) AS DateTime1 FROM tms_acct_BalanceInHandTemp WHERE bht_BusID='{$BusID}' AND bht_UserIDTemp='{$userID}' ";
//			$queryBusAccount1=$class_mysql_default->my_query("$slectBusAccount1");
//			$rowBusAccount1=mysql_fetch_array($queryBusAccount1);
//			if($rowBusAccount['DateTime']){
//				$d=strtotime($rowBusAccount['DateTime']);
//				$yy=date('Y')-date('Y',$d);
//				$mm=date('m')-date('m',$d);
//				$allmm=$yy*12+$mm;
//				if($allmm==0){
//					for($i=1;$i<=15;$i++){
//						$rowBusRate['br_Rate'.$i]=0;
//					}
//				}
//			}
//		}		
//修改版本1
//		$slectBusAccount="SELECT MAX(ba_DateTime) AS DateTime FROM tms_acct_BusAccount WHERE ba_BusID='{$BusID}'";
//		$queryBusAccount=$class_mysql_default->my_query("$slectBusAccount");
//		$rowBusAccount=mysql_fetch_array($queryBusAccount);
//		if($rowBusAccount['DateTime']){
//			$d=strtotime($rowBusAccount['DateTime']);
//			$yy=date('Y')-date('Y',$d);
//			$mm=date('m')-date('m',$d);
//			$allmm=$yy*12+$mm;
//		}else{
//			$allmm=1;
//		}
//		$Ratefeenum=0;
//		$selectFeeType="SELECT ft_FeeTypeName,ft_FeeTypeComputer,ft_FeePercent FROM tms_bd_FeeType";
//		$queryFeeType=$class_mysql_default->my_query("$selectFeeType");
//		while($rowFeeType=mysql_fetch_array($queryFeeType)){
//			if($rowFeeType['ft_FeeTypeComputer']=='按百分比收费'){
//				$Ratefee[$Ratefeenum]=$rowBusRate[$Ratefeenum+8]*$balanceBalanceMoney/100;
//			}else{
//				$Ratefee[$Ratefeenum]=$rowBusRate[$Ratefeenum+8]*$allmm;
//			}
//			echo $Ratefee[$Ratefeenum];
//			$Ratefeenum=$Ratefeenum+1;
//		}
	}else{		
//		$selectBalanceInHandTemp="SELECT IFNULL(SUM(bht_ServiceFee),0),IFNULL(SUM(bht_otherFee1),0),IFNULL(SUM(bht_otherFee2),0),bht_otherFee3,IFNULL(SUM(bht_otherFee4),0),IFNULL(SUM(bht_otherFee5),0),IFNULL(SUM(bht_otherFee6),0),
//				IFNULL(SUM(bht_PriceTotal),0),bht_BusID FROM tms_acct_BalanceInHandTemp,tms_bd_BusInfo WHERE bht_UserIDTemp='{$userID}' 
//				AND tms_acct_BalanceInHandTemp.bht_BusID=tms_bd_BusInfo.bi_BusID AND bi_BusUnit='{$BusUnit}' AND bht_Date>='{$begindate}' AND  bht_Date<='{$enddate}' GROUP BY bht_BusID ";
		$selectBalanceInHandTemp="SELECT bht_BusID,bht_BalanceMoney FROM tms_acct_BalanceInHandTemp,tms_bd_BusInfo WHERE bht_UserIDTemp='{$userID}' 
				AND tms_acct_BalanceInHandTemp.bht_BusID=tms_bd_BusInfo.bi_BusID AND bi_BusUnit='{$BusUnit}' AND bht_Date>='{$begindate}' AND  bht_Date<='{$enddate}' GROUP BY bht_BusID ";
		$queryBalanceInHandTemp=$class_mysql_default->my_query("$selectBalanceInHandTemp");
//		if(mysql_num_rows($queryBalanceInHandTemp) == 0){
//			$balance=0;
//		}else{
		$busallmm="";
		while($rowBusBalanceInHandTemp=mysql_fetch_array($queryBalanceInHandTemp)){
			$ii=0;
			$jj=0;
			$m1[0]=0;
			$m2[0]=0;
			$allmm=0;
			$state=0;
//			echo "收费车辆".$rowBusBalanceInHandTemp['bht_BusID'];
//			$balance=$rowBusBalanceInHandTemp[7]-$rowBusBalanceInHandTemp[0]-($rowBusBalanceInHandTemp[7]-$rowBusBalanceInHandTemp[0])*$rowBusBalanceInHandTemp[3]-$rowBusBalanceInHandTemp[1]
//				-$rowBusBalanceInHandTemp[2]-$rowBusBalanceInHandTemp[4]-$rowBusBalanceInHandTemp[5]-$rowBusBalanceInHandTemp[6];
//	echo $balance.'w';
			$balance=$rowBusBalanceInHandTemp['bht_BalanceMoney'];
		$selectBusRate="SELECT br_BusID,br_BusNumber,br_BusType,br_BusUnit,br_InStationID,br_InStation,br_LineName,br_Rate1,br_Rate2,br_Rate3,br_Rate4,br_Rate5,br_Rate6,br_Rate7,br_Rate8,
			br_Rate9,br_Rate10,br_Rate11,br_Rate12,br_Rate13,br_Rate14,br_Rate15 FROM tms_acct_BusRate WHERE br_BusID='{$rowBusBalanceInHandTemp['bht_BusID']}'";
		$queryBusRate=$class_mysql_default->my_query("$selectBusRate");
		$rowBusRate=mysql_fetch_array($queryBusRate);
	
		$slectBusAccount="SELECT bht_Date FROM tms_acct_BalanceInHand,tms_acct_BalanceInHandTemp
			WHERE bh_BusID='{$rowBusBalanceInHandTemp['bht_BusID']}' AND tms_acct_BalanceInHand.bh_BusID=tms_acct_BalanceInHandTemp.bht_BusID AND bht_UserIDTemp='{$userID}' AND bht_Date>='{$begindate}' AND  bht_Date<='{$enddate}' order by bht_Date desc";
		$queryBusAccount=$class_mysql_default->my_query("$slectBusAccount");
		while($rowBusAccount=mysql_fetch_array($queryBusAccount)){
			$state=1;
			$d1=strtotime($rowBusAccount['bht_Date']);
			$m1[$ii+1]=date('Y-m',$d1);
			if($m1[$ii]!=$m1[$ii+1]){
//				echo " 该车当前要结算的月份".$m1[$ii+1];
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
//				echo " 该车已结算的月份".$m2[$jj+1];
				$jj=$jj+1;
			}		
		}
//		echo " 要结算月数".$ii;
//		echo " 已结算月数".$jj;
		for($i=1;$i<=$ii;$i++){//未结算过的月份，无重复
			if($jj==0){
				$allmm=$allmm+1;
//				echo " 确定收费月份".$m1[$i];
			}else{
				$allm=0;
				for($j=1;$j<=$jj;$j++){//结算过的月份，无重复
					if($m1[$i]!=$m2[$j]){
					$allm=$allm+1;
					}
				}
//				echo "结算月份对比".$allm;
//				echo "结算月份对比".$jj;
				if($allm==$jj){
					$allmm=$allmm+1;
//					echo " 确定收费月份：".$m1[$i];
				}
			}
		}
//		echo " 要结算月费的月数计算结果".$allmm;
		if($allmm==0&&$state==0){
			$slectBusAccountno="SELECT bht_Date FROM tms_acct_BalanceInHandTemp WHERE bht_BusID='{$rowBusBalanceInHandTemp['bht_BusID']}' AND bht_UserIDTemp='{$userID}' AND bht_Date>='{$begindate}' AND  bht_Date<='{$enddate}' order by bht_Date desc";
			$queryBusAccountno=$class_mysql_default->my_query("$slectBusAccountno");
			while($rowBusAccountno=mysql_fetch_array($queryBusAccountno)){
				$d=strtotime($rowBusAccountno['bht_Date']);
				$m1[$ii+1]=date('Y-m',$d);
				if($m1[$ii]!=$m1[$ii+1]){
//					echo " 该车第一次来结算，月份".$m1[$ii+1];
					$ii=$ii+1;
					$allmm=$allmm+1;
				}			
			}
		}
//		echo " 要结算月费的月数计算结果".$allmm."<br/>";
		$Ratefeenum=0;
		$selectFeeType="SELECT ft_FeeTypeName,ft_FeeTypeComputer,ft_FeePercent FROM tms_bd_FeeType";
		$queryFeeType=$class_mysql_default->my_query("$selectFeeType");
		while($rowFeeType=mysql_fetch_array($queryFeeType)){
			if($rowFeeType['ft_FeeTypeComputer']=='按百分比收费'){
			//		echo 'sss';
				$Ratefee[$Ratefeenum]=$Ratefee[$Ratefeenum]+$rowBusRate[$Ratefeenum+7]*$balance/100;
				//	echo $rowBusRate[$Ratefeenum+7];
			}else{
				$Ratefee[$Ratefeenum]=$Ratefee[$Ratefeenum]+$rowBusRate[$Ratefeenum+7]*$allmm;
			}				
			$Ratefeenum=$Ratefeenum+1;
		}
//		$busallmm=$busallmm.",".$rowBusBalanceInHandTemp['bht_BusID'].$allmm;
		$busallmm=$busallmm.",".$allmm;
	}
}
//原版本
//		$slectBusAccount="SELECT MAX(ba_DateTime) AS DateTime FROM tms_acct_BusAccount WHERE ba_BusUnit='{$BusUnit}'";
//		$queryBusAccount=$class_mysql_default->my_query("$slectBusAccount");
//		$rowBusAccount=mysql_fetch_array($queryBusAccount);
//		$d=strtotime($rowBusAccount['DateTime']);
//		$yy=date('Y')-date('Y',$d);
//		$mm=date('m')-date('m',$d);
//		$allmm=$yy*12+$mm;
//		$selectbus="SELECT bi_BusID FROM tms_bd_BusInfo WHERE bi_BusUnit='{$BusUnit}'";
//		$querybus=$class_mysql_default->my_query("$selectbus");
//		while($rowbus=mysql_fetch_array($querybus)){
//			$selectBalanceInHandTemp="SELECT IFNULL(SUM(bht_ServiceFee),0),IFNULL(SUM(bht_otherFee1),0),IFNULL(SUM(bht_otherFee2),0),bht_otherFee3,IFNULL(SUM(bht_otherFee4),0),IFNULL(SUM(bht_otherFee5),0),IFNULL(SUM(bht_otherFee6),0),
//				IFNULL(SUM(bht_PriceTotal),0) FROM tms_acct_BalanceInHandTemp WHERE bht_BusID='{$rowbus['bi_BusID']}' AND bht_UserIDTemp='{$userID}' GROUP BY bht_BusID";
//			$queryBalanceInHandTemp=$class_mysql_default->my_query("$selectBalanceInHandTemp");
//			if(mysql_num_rows($queryBalanceInHandTemp) == 0){
//				$balance=0;
//			}else{
//				$rowBusBalanceInHandTemp=mysql_fetch_array($queryBalanceInHandTemp);
//				$balance=$rowBusBalanceInHandTemp[7]-$rowBusBalanceInHandTemp[0]-($rowBusBalanceInHandTemp[7]-$rowBusBalanceInHandTemp[0])*$rowBusBalanceInHandTemp[3]-$rowBusBalanceInHandTemp[1]
//					-$rowBusBalanceInHandTemp[2]-$rowBusBalanceInHandTemp[4]-$rowBusBalanceInHandTemp[5]-$rowBusBalanceInHandTemp[6];
//			}
		//	echo $balance.'w';
//			$selectBusRate="SELECT br_BusID,br_BusNumber,br_BusType,br_BusUnit,br_InStationID,br_InStation,br_LineName,br_Rate1,br_Rate2,br_Rate3,br_Rate4,br_Rate5,br_Rate6,br_Rate7,br_Rate8,
//				br_Rate9,br_Rate10,br_Rate11,br_Rate12,br_Rate13,br_Rate14,br_Rate15 FROM tms_acct_BusRate WHERE br_BusID='{$rowbus['bi_BusID']}'";
//			$queryBusRate=$class_mysql_default->my_query("$selectBusRate");
//			$rowBusRate=mysql_fetch_array($queryBusRate);
//			$selectBusRatehave="SELECT bh_BusID,ba_DateTime FROM tms_acct_BalanceInHand,tms_acct_BusAccountTemp,tms_acct_BusAccount
//					WHERE bh_BusID='{$rowbus['bi_BusID']}' AND tms_acct_BalanceInHand.bh_BusID=tms_acct_BusAccountTemp.bht_BusID AND bht_UserIDTemp='{$userID}' 
//					AND tms_acct_BalanceInHand.bh_AccountID=tms_acct_BusAccount.ba_AccountID ";
//			$queryBusRatehave=$class_mysql_default->my_query("$selectBusRatehave");
//			$rowBusRatehave=mysql_fetch_array($queryBusRatehave);
//			if($rowBusRatehave['ba_DateTime']){
//				$d=strtotime($rowBusRatehave['ba_DateTime']);
//				$yy=date('Y')-date('Y',$d);
//				$mm=date('m')-date('m',$d);
//				$allmm=$yy*12+$mm;
//				if($allmm==0){
//					for($i=1;$i<=15;$i++){
//						$rowBusRate['br_Rate'.$i]=0;
//					}
//				}
//			}else{
//				$allmm=1;
//			}
//			$Ratefeenum=0;
//			$selectFeeType="SELECT ft_FeeTypeName,ft_FeeTypeComputer,ft_FeePercent FROM tms_bd_FeeType";
//			$queryFeeType=$class_mysql_default->my_query("$selectFeeType");
//			while($rowFeeType=mysql_fetch_array($queryFeeType)){
//				if($rowFeeType['ft_FeeTypeComputer']=='按百分比收费'){
//			//		echo 'sss';
//					$Ratefee[$Ratefeenum]=$Ratefee[$Ratefeenum]+$rowBusRate[$Ratefeenum+8]*$balance/100;
//				//	echo $rowBusRate[$Ratefeenum+7];
//				}else{
//					$Ratefee[$Ratefeenum]=$Ratefee[$Ratefeenum]+$rowBusRate[$Ratefeenum+8]*$allmm;
//				}				
//				$Ratefeenum=$Ratefeenum+1;
//			}
//		}
	/*	foreach (explode(";",$BusIDs) as $key =>$eBusID){
			$selectBalanceInHandTemp="SELECT IFNULL(SUM(bht_ServiceFee),0),IFNULL(SUM(bht_otherFee1),0),IFNULL(SUM(bht_otherFee2),0),bht_otherFee3,IFNULL(SUM(bht_otherFee4),0),IFNULL(SUM(bht_otherFee5),0),IFNULL(SUM(bht_otherFee6),0),
				IFNULL(SUM(bht_PriceTotal),0) FROM tms_acct_BalanceInHandTemp WHERE bht_BusID='{$eBusID}' AND bht_UserIDTemp='{$userID}' GROUP BY bht_BusID";
			$queryBalanceInHandTemp=$class_mysql_default->my_query("$selectBalanceInHandTemp");
			$rowBusBalanceInHandTemp=mysql_fetch_array($queryBalanceInHandTemp);
			$balance=$rowBusBalanceInHandTemp[7]-$rowBusBalanceInHandTemp[0]-($rowBusBalanceInHandTemp[7]-$rowBusBalanceInHandTemp[0])*$rowBusBalanceInHandTemp[3]-$rowBusBalanceInHandTemp[1]
				-$rowBusBalanceInHandTemp[2]-$rowBusBalanceInHandTemp[4]-$rowBusBalanceInHandTemp[5]-$rowBusBalanceInHandTemp[6];
			$selectBusRate="SELECT br_BusID,br_BusNumber,br_BusType,br_BusUnit,br_InStationID,br_InStation,br_LineName,br_Rate1,br_Rate2,br_Rate3,br_Rate4,br_Rate5,br_Rate6,br_Rate7,br_Rate8,
				br_Rate9,br_Rate10,br_Rate11,br_Rate12,br_Rate13,br_Rate14,br_Rate15 FROM tms_acct_BusRate WHERE br_BusID='{$eBusID}'";
			$queryBusRate=$class_mysql_default->my_query("$selectBusRate");
			$rowBusRate=mysql_fetch_array($queryBusRate);
			$Ratefeenum=0;
			$selectFeeType="SELECT ft_FeeTypeName,ft_FeeTypeComputer,ft_FeePercent FROM tms_bd_FeeType";
			$queryFeeType=$class_mysql_default->my_query("$selectFeeType");
			while($rowFeeType=mysql_fetch_array($queryFeeType)){
				if($rowFeeType['ft_FeeTypeComputer']=='按百分比收费'){
					$Ratefee[$Ratefeenum]=$Ratefee[$Ratefeenum]+$rowBusRate[$Ratefeenum+7]*$balance/100;
				}else{
					$Ratefee[$Ratefeenum]=$Ratefee[$Ratefeenum]+$rowBusRate[$Ratefeenum+7];
				}
				
				$Ratefeenum=$Ratefeenum+1;
			}
		}*/
	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>车辆结算</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script >
		$(document).ready(function(){
			$("#cancelbalance").click(function(){
				jQuery.get(
	 					'tms_v1_accounting_dataProcess.php',
	 					{'op': 'cancelbalance', 'balanceBalanceNO': $("#balanceBalanceNO").val(),'time': Math.random()},
	 					function(data){
	 					//	alert(data);
	 						var objData = eval('(' + data + ')');
	 						if(objData.retVal == "FAIL"){ 
	 							alert(objData.retString);
	 						}
	 						else {
	 				//			alert(objData.retString);
	 							location.assign('tms_v1_accounting_busorunitQuery.php');
	 						}
	 				});
			});
			
			$("#subBalance").click(function(){
				if(!confirm("确认结算？提交后将无法修改！")){
					return false;
				}else{										
					var type=document.getElementById("BalanceStyle").value;
					jQuery.get(
	 					'tms_v1_accounting_dataProcess.php',
	 					{'op': 'subBalance','BalanceStyle': $("#BalanceStyle").val(),'BusID': $("#ba_BusID").val(),'ba_BusUnit': $("#ba_BusUnit").val(),'BusUnit': $("#ba_BusUnit1").val(),
		 					'Begindate': $("#Begindate").val(),'Enddate': $("#Enddate").val(),'Allmm': $("#Allmm").val(),'ratefe': $("#ratefe").val(),'ratefeename': $("#ratefeename").val(),
	 						'balanceBalanceNO':$("#balanceBalanceNO").val(),'finalbalanceBalanceMoney': $("#finalbalanceBalanceMoney").val(),'busallmm':$("#busallmm").val(),
	 						'ba_BalanceCount':$("#ba_BalanceCount").val(),'ba_CheckTotal':$("#ba_CheckTotal").val(),'ba_Income':$("#ba_Income").val(),'ba_ServiceFee':$("#ba_ServiceFee").val(),
	 						'ba_OtherFee1':$("#ba_OtherFee1").val(),'ba_OtherFee2':$("#ba_OtherFee2").val(),'ba_OtherFee3':$("#ba_OtherFee3").val(),'ba_OtherFee4':$("#ba_OtherFee4").val(),
	 						'ba_OtherFee5':$("#ba_OtherFee5").val(),'ba_OtherFee6':$("#ba_OtherFee6").val(),'ba_ConsignMoney':$("#ba_ConsignMoney").val(),'ba_Remark':$("#ba_Remark").val(),
	 						'ba_BusNumber':$("#ba_BusNumber").val(),'ba_BusType':$("#ba_BusType").val(),'time': Math.random()},
	 					function(data){
//	 						alert(data);
	 						var objData = eval('(' + data + ')');
	 						if(objData.retVal == "FAIL"){ 
	 							alert(objData.retString);
	 						}
	 						else{
		 						if(objData.retVal == "SUCC"){ 
		 							if(type=='0'){
	 									document.getElementById("finalbalanceBalanceMoney").value=objData.finalMoney;
	 									var sss=objData.printrate;
	 									var PrintRate=sss.split(",");
	 									for(var i=1;i<PrintRate.length;i++){
		 									if(PrintRate[i]!=""){
//			 									alert(i);
//			 									alert(PrintRate[i]);
			 									document.getElementById("Rate"+i).value=PrintRate[i];
			 									}
	 									}
//			 							var finalmoney='<span style="font-size:12px;color:red">'+objData.finalMoney +'</span>';
		 								alert('有'+objData.returnmm+'个月的月费刚已被结算，最终结算金额：'+objData.finalMoney +' 。');
			 						}else{
	 									document.getElementById("finalbalanceBalanceMoney").value=objData.finalMoney;
	 									var sss=objData.printrate;
	 									var PrintRate=sss.split(",");
	 									for(var i=1;i<PrintRate.length;i++){
		 									if(PrintRate[i]!=""){
			 									document.getElementById("Rate"+i).value=PrintRate[i];
			 									}
	 									}
//	 									var finalmoney='<span style="font-size:12px;color:red">'+objData.finalMoney +'</span>';
		 								alert(objData.print+'最终结算金额：'+objData.finalMoney +' 。');
				 					} 					
		 						}
								alert("结算成功！");
	 							location.assign('tms_v1_accounting_busorunitQuery.php');
	 						}
//	 						if(objData.retVal == "SUCC"){ 
//	 							if(type=='0'){
//	 								if(!confirm('有'+objData.returnmm+'个月的月费已被结算，最终结算金额：'+objData.finalMoney +'，确认结算？提交后将无法修改！')){
//	 									return false;
//	 								}else{
//	 									document.getElementById("finalbalanceBalanceMoney").value=objData.finalMoney;
//	 									var sss=objData.printrate;
//	 									var PrintRate=sss.split(",");
//	 									for(var i=1;i<PrintRate.length;i++){
//		 									if(PrintRate[i]!=""){
////			 									alert(i);
////			 									alert(PrintRate[i]);
//			 									document.getElementById("Rate"+i).value=PrintRate[i];
//			 									}
//	 									}
//	 									document.form1.submit();
//									}
////	 			 						if(!confirm("结算金额："+objData.finalMoney +"。确认结算？提交后将无法修改！")){
////		 									document.getElementById("finalbalanceBalanceMoney").value=document.getElementById("finalbalanceBalanceMone").value;
////		 									var num=document.getElementById("numfee").value;
////		 									for(var i=1;i<=num;i++){
////				 								document.getElementById("Rate"+i).value=document.getElementById("Rat"+i).value;
////		 									}		 			 						
////	 			 							return false;
////	 			 						}else{
////	 			 							document.form1.submit();
////	 			 						}
//		 						}else{
//	 								if(!confirm(objData.print+'最终结算金额：'+objData.finalMoney +'，确认结算？提交后将无法修改！')){
////	 									jQuery.get(
////	 						 					'tms_v1_accounting_dataProcess.php',
////	 						 					{'op': 'lockcancel','time': Math.random()},
////	 						 					);
//	 									return false;
//	 								}else{
//	 									document.getElementById("finalbalanceBalanceMoney").value=objData.finalMoney;
//	 									var sss=objData.printrate;
//	 									var PrintRate=sss.split(",");
//	 									for(var i=1;i<PrintRate.length;i++){
//		 									if(PrintRate[i]!=""){
//			 									document.getElementById("Rate"+i).value=PrintRate[i];
//			 									}
//	 									}
//	 			 						document.form1.submit();
//		 							}
//			 					}	 					
//	 						}else{
//		 						if(!confirm("确认结算？提交后将无法修改！")){
//		 							return false;
//		 						}else{
//		 							document.form1.submit();
//		 						}
//		 					}
	 				});
				}
			});
		});
		</script>
	</head>
	<body>
		<form action="" method="post" name="form1" id="form1">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 结 算 提 交</span></td>
			</tr>
		</table>
		<p></p>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
  			<tr <?php if($BalanceStyle!='0') echo "style='DISPLAY:none'";?>>
    			<td colspan="8" bgcolor="#d4d1d1" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 车 辆 信 息</td>
  			</tr>
			<tr <?php if($BalanceStyle!='0') echo "style='DISPLAY:none'";?>>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆编号：</span></td>
				<td><input type="text" name="ba_BusID" id="ba_BusID" value="<?php echo $BusID;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
				<td><input type="text" name="ba_BusNumber" id="ba_BusNumber" value="<?php echo $BusNumber;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型：</span></td>
				<td><input type="text" name="ba_BusType" id="ba_BusType" value="<?php echo $BusType;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位：</span></td>
				<td><input type="text" name="ba_BusUnit" id="ba_BusUnit" value="<?php echo $BusUnit;?>" readonly="readonly" /></td>
			</tr>
			<tr <?php if($BalanceStyle=='0') echo "style='DISPLAY:none'";?>>
    			<td colspan="8" bgcolor="#d4d1d1" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span>车 属 单 位 信 息</td>
  			</tr>
			<tr <?php if($BalanceStyle=='0') echo "style='DISPLAY:none'";?>>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位：</span></td>
				<td><input type="text" name="ba_BusUnit1" id="ba_BusUnit1" value="<?php echo $BusUnit;?>" readonly="readonly" /></td>
			</tr>
  			<tr>
    			<td colspan="8" bgcolor="#d4d1d1" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 结 算 信 息</td>
  			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 营收金额：</span></td>
				<td><input type="text" name="ba_Income" id="ba_Income" value="<?php echo $balancePriceTotal;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结算金额：</span></td>
				<td><input style="background-color:#F1E6C2" type="text" name="ba_Paid" id="ba_Paid" value="<?php echo $balanceBalanceMoney;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结算单数量：</span></td>
				<td ><input type="text" name="ba_BalanceCount" id="ba_BalanceCount" value="<?php echo $balancenum;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结算员ID：</span></td>
				<td><input type="text" name="ba_UserID" id="ba_UserID" value="<?php echo $userID;?>" readonly="readonly" /></td>
			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 行包金额：</span></td>
				<td  colspan="8" ><input style="background-color:#F1E6C2" type="text" name="ba_ConsignMoney" id="ba_ConsignMoney" value="<?php echo $balanceConsignMoney;?>" readonly="readonly" /></td>
  			</tr>
  			<tr>
    			<td colspan="8" bgcolor="#d4d1d1" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 扣 除 信 息</td>
  			</tr>
			<tr>
				<td style="DISPLAY: none" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站务费：</span></td>
				<td style="DISPLAY: none"><input type="text" name="ba_ServiceFee" id="ba_ServiceFee" value="<?php echo $balanceServiceFee;?>" readonly="readonly" /></td>
				<td style="DISPLAY: none" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 微机费：</span></td>
				<td style="DISPLAY: none"><input type="text" name="ba_OtherFee1" id="ba_OtherFee1" value="<?php echo $balanceotherFee1;?>" readonly="readonly" /></td>
				<td style="DISPLAY: none" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发班费：</span></td>
				<td style="DISPLAY: none"><input type="text" name="ba_OtherFee2" id="ba_OtherFee2" value="<?php echo $balanceotherFee2;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 劳务费：</span></td>
				<td colspan="5"><input type="text" name="ba_OtherFee3" id="ba_OtherFee3" value="<?php echo $balanceotherFee3;?>" readonly="readonly" /></td>
			</tr>
			<tr style="display:none">
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 费用4：</span></td>
				<td><input type="text" name="ba_OtherFee4" id="ba_OtherFee4" value="<?php echo $balanceotherFee4;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 费用5：</span></td>
				<td><input type="text" name="ba_OtherFee5" id="ba_OtherFee5" value="<?php echo $balanceotherFee5;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 费用6：</span></td>
				<td><input type="text" name="ba_OtherFee6" id="ba_OtherFee6" value="<?php echo $balanceotherFee6;?>" readonly="readonly" /></td>
				<td><input type="hidden" name="ba_CheckTotal" id="ba_CheckTotal" value="<?php echo $balanceCheckTotal;?>" readonly="readonly" /></td>
			</tr>
			<tr>
    			<td colspan="8" bgcolor="#d4d1d1" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 按 月 扣 除 信 息</td>
  			</tr>
				<?php
					$allfee=0;
					$i=0;
					$selectFeeType="SELECT ft_FeeTypeName,ft_FeeTypeComputer,ft_FeePercent FROM tms_bd_FeeType";
					$queryFeeType=$class_mysql_default->my_query("$selectFeeType");
					while($rowFeeType=mysql_fetch_array($queryFeeType)){
						if($i%4==0){
							$j=$i+1;
				?>
				<tr>
				<?php 
						} 
				?>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /><?php echo $rowFeeType['ft_FeeTypeName'];?>：</span>
				<input type="hidden" name="Ratefeetype<?php echo $i+1;?>" id="Ratefeetype<?php echo $i+1;?>" value="<?php echo $rowFeeType['ft_FeeTypeName'];?>" /></td>
				<td><input type="text" name="Rate<?php echo $i+1;?>" id="Rate<?php echo $i+1;?>" value="<?php echo $Ratefee[$i];?>" readonly="readonly" />
				<input type="hidden" name="Rat<?php echo $i+1;?>" id="Rat<?php echo $i+1;?>" value="<?php echo $Ratefee[$i];?>" /></td>
				<?php
					$ratefe=$ratefe.",".$Ratefee[$i];
					$ratefeename=$ratefeename.",,".$rowFeeType['ft_FeeTypeName'];
					$allfee=$allfee+$Ratefee[$i];
					$j=$j+1;
					if(($j-$i)==4){
				?>
				</tr>
				<?php 
						} 
					$i=$i+1;
					}
				?>
			<tr>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 最终结算金额：</span></td>
				<td >
					<input style="background-color:#F1E6C2" type="text" id="finalbalanceBalanceMoney" name="finalbalanceBalanceMoney" value="<?php echo $balanceBalanceMoney+$balanceConsignMoney-$balanceotherFee3-$allfee;?>" readonly="readonly" />
					<input type="hidden" id="finalbalanceBalanceMone" name="finalbalanceBalanceMone" value="<?php echo $balanceBalanceMoney+$balanceConsignMoney-$balanceotherFee3-$allfee;?>"/>
					<input type="hidden" id="BalanceStyle" name="BalanceStyle" value="<?php echo $BalanceStyle;?>"/>
					<input type="hidden" id="numfee" name="numfee" value="<?php echo $i;?>"/>
					<input type="hidden" id="balanceBalanceNO" name="balanceBalanceNO" value="<?php echo $balanceBalanceNO;?>"/>
				</td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 备注：</span></td>
				<td colspan='5'><input style="width:100%" type="text" name="ba_Remark" value="" size="90"/>
				<input type="hidden" id="Allmm" name="Allmm" value="<?php echo $allmm;?>"/>
				<input type="hidden" id="ratefe" name="ratefe" value="<?php echo $ratefe;?>"/>
				<input type="hidden" id="ratefeename" name="ratefeename" value="<?php echo $ratefeename;?>"/>
				<input type="hidden" id="Begindate" name="Begindate" value="<?php echo $begindate;?>"/>
				<input type="hidden" id="Enddate" name="Enddate" value="<?php echo $enddate;?>"/>
				<input type="hidden" id="busallmm" name="busallmm" value="<?php echo $busallmm;?>"/>
				</td>
			</tr>
 		</table> 
		<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
			<tr>
				<td align="center" bgcolor="#FFFFFF" nowrap="nowrap">
					<input type="button" name="subBalance" id="subBalance" value="确认结算" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" name="cancelbalance" id="cancelbalance" value="取消"/>
				</td>
			</tr>
		</table>
		</form>
	</body>
</html>
