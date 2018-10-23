<?php
	$filedata = file("../conf/PrinterNameInfo.ini");
	for ($i = 0; $i < count($filedata); $i++){
		if(stristr($filedata[$i], '[PrinterInfo')){
			$seqID = trim(substr($filedata[$i+4], strrpos($filedata[$i+4],'=')+1));
			switch($seqID){
				case "1":
					$kpBeginX = trim(substr($filedata[$i+1], strrpos($filedata[$i+1],'=')+1));
					$kpBeginY = trim(substr($filedata[$i+2], strrpos($filedata[$i+2],'=')+1));
					$kpName = trim(substr($filedata[$i+3], strrpos($filedata[$i+3],'=')+1));
					break;
				case "2":
					$bxBeginX = trim(substr($filedata[$i+1], strrpos($filedata[$i+1],'=')+1));
					$bxBeginY = trim(substr($filedata[$i+2], strrpos($filedata[$i+2],'=')+1));
					$bxName = trim(substr($filedata[$i+3], strrpos($filedata[$i+3],'=')+1));
					break;
				case "3":
					$qdBeginX = trim(substr($filedata[$i+1], strrpos($filedata[$i+1],'=')+1));
					$qdBeginY = trim(substr($filedata[$i+2], strrpos($filedata[$i+2],'=')+1));
					$qdName = trim(substr($filedata[$i+3], strrpos($filedata[$i+3],'=')+1));
					break;
				case "4":
					$ajBeginX = trim(substr($filedata[$i+1], strrpos($filedata[$i+1],'=')+1));
					$ajBeginY = trim(substr($filedata[$i+2], strrpos($filedata[$i+2],'=')+1));
					$ajName = trim(substr($filedata[$i+3], strrpos($filedata[$i+3],'=')+1));
					break;
				case "5":
					$xbBeginX = trim(substr($filedata[$i+1], strrpos($filedata[$i+1],'=')+1));
					$xbBeginY = trim(substr($filedata[$i+2], strrpos($filedata[$i+2],'=')+1));
					$xbName = trim(substr($filedata[$i+3], strrpos($filedata[$i+3],'=')+1));
					break;
				case "6":
					$bcBeginX = trim(substr($filedata[$i+1], strrpos($filedata[$i+1],'=')+1));
					$bcBeginY = trim(substr($filedata[$i+2], strrpos($filedata[$i+2],'=')+1));
					$bcName = trim(substr($filedata[$i+3], strrpos($filedata[$i+3],'=')+1));
					break;
				default:
			}
		}
	}
?>
