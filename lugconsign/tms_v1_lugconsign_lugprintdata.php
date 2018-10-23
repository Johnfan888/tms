<?php
	$ChartereConf=file("../conf/PrintInfoConf.行包.ini");
	for ($i=0;$i<count($ChartereConf);$i++){
	//	echo $ChartereConf[$i];
		if(stristr($ChartereConf[$i],'[FullINFO')){
			$width=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
			$height=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
			$left=trim(substr($ChartereConf[$i+3],strrpos($ChartereConf[$i+3],'=')+1));
			$top=trim(substr($ChartereConf[$i+4],strrpos($ChartereConf[$i+4],'=')+1));
			$fontsize=trim(substr($ChartereConf[$i+5],strrpos($ChartereConf[$i+5],'=')+1));
	//		echo $width;
	//		echo $height;
	//		echo $left;
	//		echo $top;
	//		echo $fontsize;
		}
		if(stristr($ChartereConf[$i],'[PRINTINFO')){
			$infor=substr($ChartereConf[$i+3],strrpos($ChartereConf[$i+3],'=')+1);
			$infor=trim($infor);
			switch ($infor){
				case "Station":
					$leftStation=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topStation=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "TicketNumber":
					$leftTicketNumber=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topTicketNumber=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "BusID":
					$leftBusID=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topBusID=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "Sicheng":
					$leftSicheng=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topSicheng=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "CargoName":
					$leftCargoName=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topCargoName=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "FromStation":
					$leftFromStation=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topFromStation=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "Destination":
					$leftDestination=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topDestination=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "DeliveryDate":
					$leftDeliveryDate=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topDeliveryDate=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "Weight":
					$leftWeight=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topWeight=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "Numbers":
					$leftNumbers=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topNumbers=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "PayStyle":
					$leftPayStyle=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topPayStyle=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "Isvalueinsure":
					$leftIsvalueinsure=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topIsvalueinsure=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "InsureMoney":
					$leftInsureMoney=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topInsureMoney=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "ConsignName":
					$leftConsignName=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topConsignName=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "UnloadName":
					$leftUnloadName=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topUnloadName=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "ConsignTel":
					$leftConsignTel=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topConsignTel=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "UnloadTel":
					$leftUnloadTel=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topUnloadTel=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "ConsignPapersID":
					$leftConsignPapersID=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topConsignPapersID=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "UnloadPapersID":
					$leftUnloadPapersID=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topUnloadPapersID=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "ConsignMoney":
					$leftConsignMoney=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topConsignMoney=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "PackingMoney":
					$leftPackingMoney=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topPackingMoney=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "LabelMoney":
					$leftLabelMoney=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topLabelMoney=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "InsureFee":
					$leftInsureFee=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topInsureFee=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "HandlingMoney":
					$leftHandlingMoney=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topHandlingMoney=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "getticketmoney":
					$leftgetticketmoney=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topgetticketmoney=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "DeliveryUserID":
					$leftDeliveryUserID=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topDeliveryUserID=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
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