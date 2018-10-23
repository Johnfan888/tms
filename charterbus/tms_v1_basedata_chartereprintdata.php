<?php
	$ChartereConf=file("../conf/PrintInfoConf.包车.ini");
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
				case "Station":
					$leftStation=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topStation=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "TicketID":
					$leftTicketID=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topTicketID=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "Customer":
					$leftCustomer=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topCustomer=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "BusNumber":
					$leftBusNumber=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topBusNumber=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "DriverName":
					$leftDriverName=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topDriverName=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "CharteredBusDate":
					$leftCharteredBusDate=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topCharteredBusDate=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "From":
					$leftFrom=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topFrom=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "Reach":
					$leftReach=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topReach=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "CarriageFee":
					$leftCarriageFee=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topCarriageFee=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "Kilometers":
					$leftKilometers=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topKilometers=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "StagnateFee":
					$leftStagnateFee=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topStagnateFee=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "Seats":
					$leftSeats=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topSeats=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "realticketmoney":
					$leftrealticketmoney=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$toprealticketmoney=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "Peoples":
					$leftPeoples=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topPeoples=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "BillingDate":
					$leftBillingDate=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topBillingDate=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "realticketmoney1":
					$leftrealticketmoney1=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$toprealticketmoney1=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "BillingerID":
					$leftBillingerID=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topBillingerID=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "blank1":
					$leftblank1=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topblank1=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "blank2":
					$leftblank2=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topblank2=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				default:
			}
		}
	}
?>