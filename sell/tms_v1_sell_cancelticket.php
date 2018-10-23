<?php
$canceltickettime=file("../conf/cancelticket.ini");
	for ($i=0;$i<count($canceltickettime);$i++){
		if(stristr($canceltickettime[$i],'[FullINFO')){
			$canceltime=substr($canceltickettime[$i+3],strrpos($canceltickettime[$i+3],'=')+1);
			$canceltime=trim($canceltime);
			switch ($canceltime){
				case "delwebandreserve":
					$canclehourwr=trim(substr($canceltickettime[$i+1],strrpos($canceltickettime[$i+1],'=')+1));
					$cancleminutewr=trim(substr($canceltickettime[$i+2],strrpos($canceltickettime[$i+2],'=')+1));
					break;
				case "delpayweb":
					$canclehourw=trim(substr($canceltickettime[$i+1],strrpos($canceltickettime[$i+1],'=')+1));
					$cancleminutew=trim(substr($canceltickettime[$i+2],strrpos($canceltickettime[$i+2],'=')+1));
					break;
				default:
			}
		}
	}
?>