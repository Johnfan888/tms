<?php
	$checkChartereConf=file("../conf/CheckInfoConf.жЄееМьбщ.ini");
	for ($i=0;$i<count($checkChartereConf);$i++){
		
		if(stristr($checkChartereConf[$i],'[INFO')){
			$checkinfor=substr($checkChartereConf[$i+3],strrpos($checkChartereConf[$i+3],'=')+1);
			$checkinfor=trim($checkinfor);
			switch ($checkinfor){
				case "Transportation":
					$Transportationx=trim(substr($checkChartereConf[$i+1],strrpos($checkChartereConf[$i+1],'=')+1));
					$Transportationy=trim(substr($checkChartereConf[$i+2],strrpos($checkChartereConf[$i+2],'=')+1));
				//	echo $Transportationx;
					break;
				case "Trade":
					$Tradex=trim(substr($checkChartereConf[$i+1],strrpos($checkChartereConf[$i+1],'=')+1));
					$Tradey=trim(substr($checkChartereConf[$i+2],strrpos($checkChartereConf[$i+2],'=')+1));
					break;
				case "Ren":
					$Renx=trim(substr($checkChartereConf[$i+1],strrpos($checkChartereConf[$i+1],'=')+1));
					$Reny=trim(substr($checkChartereConf[$i+2],strrpos($checkChartereConf[$i+2],'=')+1));
					break;
				case "Attached":
					$Attachedx=trim(substr($checkChartereConf[$i+1],strrpos($checkChartereConf[$i+1],'=')+1));
					$Attachedy=trim(substr($checkChartereConf[$i+2],strrpos($checkChartereConf[$i+2],'=')+1));
					break;
				case "SpringCheck":
					$SpringCheckx=trim(substr($checkChartereConf[$i+1],strrpos($checkChartereConf[$i+1],'=')+1));
					$SpringChecky=trim(substr($checkChartereConf[$i+2],strrpos($checkChartereConf[$i+2],'=')+1));
					break;
				case "Examination":
					$Examinationx=trim(substr($checkChartereConf[$i+1],strrpos($checkChartereConf[$i+1],'=')+1));
					$Examinationy=trim(substr($checkChartereConf[$i+2],strrpos($checkChartereConf[$i+2],'=')+1));
					break;
				case "Two":
					$Twox=trim(substr($checkChartereConf[$i+1],strrpos($checkChartereConf[$i+1],'=')+1));
					$Twoy=trim(substr($checkChartereConf[$i+2],strrpos($checkChartereConf[$i+2],'=')+1));
					break;
				case "Rank":
					$Rankx=trim(substr($checkChartereConf[$i+1],strrpos($checkChartereConf[$i+1],'=')+1));
					$Ranky=trim(substr($checkChartereConf[$i+2],strrpos($checkChartereConf[$i+2],'=')+1));
					break;
				case "Travel":
					$Travelx=trim(substr($checkChartereConf[$i+1],strrpos($checkChartereConf[$i+1],'=')+1));
					$Travely=trim(substr($checkChartereConf[$i+2],strrpos($checkChartereConf[$i+2],'=')+1));
					break;
				case "Month":
					$Monthx=trim(substr($checkChartereConf[$i+1],strrpos($checkChartereConf[$i+1],'=')+1));
					$Monthy=trim(substr($checkChartereConf[$i+2],strrpos($checkChartereConf[$i+2],'=')+1));
					break;
				case "CNG":
					$CNGx=trim(substr($checkChartereConf[$i+1],strrpos($checkChartereConf[$i+1],'=')+1));
					$CNGy=trim(substr($checkChartereConf[$i+2],strrpos($checkChartereConf[$i+2],'=')+1));
					break;
				case "RoadTransport":
					$RoadTransportx=trim(substr($checkChartereConf[$i+1],strrpos($checkChartereConf[$i+1],'=')+1));
					$RoadTransporty=trim(substr($checkChartereConf[$i+2],strrpos($checkChartereConf[$i+2],'=')+1));
					break;
				case "VehicleDriving":
					$VehicleDrivingx=trim(substr($checkChartereConf[$i+1],strrpos($checkChartereConf[$i+1],'=')+1));
					$VehicleDrivingy=trim(substr($checkChartereConf[$i+2],strrpos($checkChartereConf[$i+2],'=')+1));
					break;
				case "CYZGZCheck":
					$CYZGZCheckx=trim(substr($checkChartereConf[$i+1],strrpos($checkChartereConf[$i+1],'=')+1));
					$CYZGZChecky=trim(substr($checkChartereConf[$i+2],strrpos($checkChartereConf[$i+2],'=')+1));
					break;
				case "DriverCheck":
					$DriverCheckx=trim(substr($checkChartereConf[$i+1],strrpos($checkChartereConf[$i+1],'=')+1));
					$DriverChecky=trim(substr($checkChartereConf[$i+2],strrpos($checkChartereConf[$i+2],'=')+1));
					break;
				default:
			}
		}
	}
?>