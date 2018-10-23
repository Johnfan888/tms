<?php
	if(file_exists("../conf/PrintInfoConf.售票.ini")) {
		$ChartereConf=file("../conf/PrintInfoConf.售票.ini");
	}
	else {
		echo "<script>alert('客票配置文件不存在！');history.back();</script>";
	}
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
				case "TicketIDL":
					$leftTicketIDL=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topTicketIDL=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "TicketIDR":
					$leftTicketIDR=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topTicketIDR=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "FromStationL":
					$leftFromStationL=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topFromStationL=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "ReachStationL":
					$leftReachStationL=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topReachStationL=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "FromStationR":
					$leftFromStationR=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topFromStationR=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "ReachStationR":
					$leftReachStationR=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topReachStationR=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "SellPriceL":
					$leftSellPriceL=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topSellPriceL=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "SeatIDL":
					$leftSeatIDL=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topSeatIDL=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "SellPriceR":
					$leftSellPriceR=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topSellPriceR=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "NoOfRunsIDL":
					$leftNoOfRunsIDL=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topNoOfRunsIDL=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "BeginStationTime":
					$leftBeginStationTime=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topBeginStationTime=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "NoOfRunsIDR":
					$leftNoOfRunsIDR=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topNoOfRunsIDR=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "NoOfRunsdateL":
					$leftNoOfRunsdateL=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topNoOfRunsdateL=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "NoOfRunsdateR":
					$leftNoOfRunsdateR=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topNoOfRunsdateR=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "SeatIDR":
					$leftSeatIDR=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topSeatIDR=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				case "SellerID":
					$leftSellerID=trim(substr($ChartereConf[$i+1],strrpos($ChartereConf[$i+1],'=')+1));
					$topSellerID=trim(substr($ChartereConf[$i+2],strrpos($ChartereConf[$i+2],'=')+1));
					break;
				default:
			}
		}
	}
?>
