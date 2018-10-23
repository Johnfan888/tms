<?php
	$ChartereConf=file("../conf/PrintInfoConf.结算.ini");
	for ($i=0;$i<count($ChartereConf);$i++){
		if(stristr($ChartereConf[$i],'[FullINFO')){
			$width=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
			$height=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
			$left=trim(substr($ChartereConf[$i+3],strrpos($ChartereConf[$i+3],'=')+1));
			$top=trim(substr($ChartereConf[$i+4],strrpos($ChartereConf[$i+4],'=')+1));
			$fontsize=trim(substr($ChartereConf[$i+5],strrpos($ChartereConf[$i+5],'=')+1));
		}
		if(stristr($ChartereConf[$i],'[PRINTINFO')){
			$infor=substr($ChartereConf[$i+3],strrpos($ChartereConf[$i+3],'=')+1);
			$infor=trim($infor);
			switch ($infor){
				case "stationName":
					$leftstationName=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topstationName=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "Space1":
					$leftSpace1=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topSpace1=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "Space2":
					$leftSpace2=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topSpace2=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "Space3":
					$leftSpace3=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topSpace3=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "NoOfRunsdate":
					$leftNoOfRunsdate=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topNoOfRunsdate=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "BalanceNo":
					$leftBalanceNo=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topBalanceNo=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "BusUnit":
					$leftBusUnit=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topBusUnit=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "BusNumber":
					$leftBusNumber=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topBusNumber=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "NoOfRunsID":
					$leftNoOfRunsID=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topNoOfRunsID=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "ReachStationL":
					$leftReachStationL=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topReachStationL=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "Distance":
					$leftDistance=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topDistance=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "FullNumbers":
					$leftFullNumbers=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topFullNumbers=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "HalfNumbers":
					$leftHalfNumbers=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topHalfNumbers=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "FullPrice":
					$leftFullPrice=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topFullPrice=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "AllPrice":
					$leftAllPrice=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topAllPrice=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "ReachStationR":
					$leftReachStationR=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topReachStationR=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "passengerNum":
					$leftpassengerNum=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$toppassengerNum=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "PeopleDistance":
					$leftPeopleDistance=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topPeopleDistance=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "BalanceMoney":
					$leftBalanceMoney=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topBalanceMoney=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "ConsignMoney":
					$leftConsignMoney=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topConsignMoney=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "BalanceMoneyB":
					$leftBalanceMoneyB=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topBalanceMoneyB=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "nowtime":
					$leftnowtime=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topnowtime=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "Balancer":
					$leftBalancer=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topBalancer=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				default:
			}
		}
	}
?>