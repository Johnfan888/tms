<?php
	$insureChartereConf=file("../conf/PrintInfoConf.保险.ini");
	for ($i=0;$i<count($insureChartereConf);$i++){
		if(stristr($insureChartereConf[$i],'[FullINFO')){
			$insurewidth=trim(substr($insureChartereConf[$i+1],strrpos($insureChartereConf[$i+1],'=')+1));
			$insureheight=trim(substr($insureChartereConf[$i+2],strrpos($insureChartereConf[$i+2],'=')+1));
			$insureleft=trim(substr($insureChartereConf[$i+3],strrpos($insureChartereConf[$i+3],'=')+1));
			$insuretop=trim(substr($insureChartereConf[$i+4],strrpos($insureChartereConf[$i+4],'=')+1));
			$insurefontsize=trim(substr($insureChartereConf[$i+5],strrpos($insureChartereConf[$i+5],'=')+1));
		}
		if(stristr($insureChartereConf[$i],'[PRINTINFO')){
			$insureinfor=substr($insureChartereConf[$i+3],strrpos($insureChartereConf[$i+3],'=')+1);
			$insureinfor=trim($insureinfor);
			switch ($insureinfor){
				case "SyncCode":
					$leftSyncCode=trim(substr($insureChartereConf[$i+1],strrpos($insureChartereConf[$i+1],'=')+1));
					$topSyncCode=trim(substr($insureChartereConf[$i+2],strrpos($insureChartereConf[$i+2],'=')+1));
					break;
				case "insureSpace1":
					$leftinsureSpace1=trim(substr($insureChartereConf[$i+1],strrpos($insureChartereConf[$i+1],'=')+1));
					$topinsureSpace1=trim(substr($insureChartereConf[$i+2],strrpos($insureChartereConf[$i+2],'=')+1));
					break;
				case "Name":
					$leftName=trim(substr($insureChartereConf[$i+1],strrpos($insureChartereConf[$i+1],'=')+1));
					$topName=trim(substr($insureChartereConf[$i+2],strrpos($insureChartereConf[$i+2],'=')+1));
					break;
				case "insureSpace2":
					$leftinsureSpace2=trim(substr($insureChartereConf[$i+1],strrpos($insureChartereConf[$i+1],'=')+1));
					$topinsureSpace2=trim(substr($insureChartereConf[$i+2],strrpos($insureChartereConf[$i+2],'=')+1));
					break;
				case "IdCard":
					$leftIdCard=trim(substr($insureChartereConf[$i+1],strrpos($insureChartereConf[$i+1],'=')+1));
					$topIdCard=trim(substr($insureChartereConf[$i+2],strrpos($insureChartereConf[$i+2],'=')+1));
					break;
				case "Beneficiary":
					$leftBeneficiary=trim(substr($insureChartereConf[$i+1],strrpos($insureChartereConf[$i+1],'=')+1));
					$topBeneficiary=trim(substr($insureChartereConf[$i+2],strrpos($insureChartereConf[$i+2],'=')+1));
					break;
				case "AinsuranceValue":
					$leftAinsuranceValue=trim(substr($insureChartereConf[$i+1],strrpos($insureChartereConf[$i+1],'=')+1));
					$topAinsuranceValue=trim(substr($insureChartereConf[$i+2],strrpos($insureChartereConf[$i+2],'=')+1));
					break;
				case "insureSpace3":
					$leftinsureSpace3=trim(substr($insureChartereConf[$i+1],strrpos($insureChartereConf[$i+1],'=')+1));
					$topinsureSpace3=trim(substr($insureChartereConf[$i+2],strrpos($insureChartereConf[$i+2],'=')+1));
					break;
				case "BinsuranceValue":
					$leftBinsuranceValue=trim(substr($insureChartereConf[$i+1],strrpos($insureChartereConf[$i+1],'=')+1));
					$topBinsuranceValue=trim(substr($insureChartereConf[$i+2],strrpos($insureChartereConf[$i+2],'=')+1));
					break;
				case "Price":
					$leftPrice=trim(substr($insureChartereConf[$i+1],strrpos($insureChartereConf[$i+1],'=')+1));
					$topPrice=trim(substr($insureChartereConf[$i+2],strrpos($insureChartereConf[$i+2],'=')+1));
					break;
				case "NoOfRunsID":
					$leftNoOfRunsID=trim(substr($insureChartereConf[$i+1],strrpos($insureChartereConf[$i+1],'=')+1));
					$topNoOfRunsID=trim(substr($insureChartereConf[$i+2],strrpos($insureChartereConf[$i+2],'=')+1));
					break;
				case "NoOfRunsdate":
					$leftNoOfRunsdate=trim(substr($insureChartereConf[$i+1],strrpos($insureChartereConf[$i+1],'=')+1));
					$topNoOfRunsdate=trim(substr($insureChartereConf[$i+2],strrpos($insureChartereConf[$i+2],'=')+1));
					break;
				case "SaleTime":
					$leftSaleTime=trim(substr($insureChartereConf[$i+1],strrpos($insureChartereConf[$i+1],'=')+1));
					$topSaleTime=trim(substr($insureChartereConf[$i+2],strrpos($insureChartereConf[$i+2],'=')+1));
					break;
				case "AgentCode":
					$leftAgentCode=trim(substr($insureChartereConf[$i+1],strrpos($insureChartereConf[$i+1],'=')+1));
					$topAgentCode=trim(substr($insureChartereConf[$i+2],strrpos($insureChartereConf[$i+2],'=')+1));
					break;
				case "HandlerCode":
					$leftHandlerCode=trim(substr($insureChartereConf[$i+1],strrpos($insureChartereConf[$i+1],'=')+1));
					$topHandlerCode=trim(substr($insureChartereConf[$i+2],strrpos($insureChartereConf[$i+2],'=')+1));
					break;
				default:
			}
		}
	}
?>

