<?php

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$op = $_REQUEST['op'];
switch ($op)
{
	case "getBusData":
		$busid = trim($_GET['busid']);
		getBusData($busid,$class_mysql_default);
		break;
	case "getBusModelData":
		$ModelID = trim($_GET['ModelID']);
		getBusModelData($ModelID,$class_mysql_default);
		break;
	case "getInceptUser":
		$InceptUserID = trim($_GET['InceptUserID']);
		getInceptUse($InceptUserID,$class_mysql_default);
		break;
	case "getRegion":
		$SiteId = trim($_GET['SiteId']); //获取站点ID号
		getRegion($SiteId,$class_mysql_default);
		break;
	case "getsite":
		$Site= trim($_GET['Site']);
		getSite($Site,$class_mysql_default);
		break;
	case "Station":
		$Site= trim($_GET['Site']);
		getStation($Site,$class_mysql_default);
		break;
	case "getstation":
		$fromstation=$_GET['fromstation'];
		if($fromstation!=""){
			$queryString="SELECT sset_SiteName FROM tms_bd_SiteSet WHERE sset_HelpCode LIKE '{$fromstation}%' OR 
					sset_SiteName LIKE '{$fromstation}%'";
			$result = $class_mysql_default->my_query("$queryString");
			while ($row = mysql_fetch_array($result)) {
				$retData[] = array(
					'from' => $row['sset_SiteName']);
			}
			echo json_encode($retData);
		}else{
			$retData[] = array(
					'from' => '');
			echo json_encode($retData);
		}
		break;
	case "backprovide":
		$ID= trim($_GET['ID']);
		backProvide($ID,$userName,$userID,$userStationName,$class_mysql_default);
		break;
	case "ticketwithdraw":
		$ID= trim($_GET['ID']);
		$update="UPDATE tms_bd_TicketAdd SET ta_Remark='注销' WHERE ta_ID='{$ID}'";
		$result = $class_mysql_default->my_query("$update");
		if(!$result) {
			$retData = array('sucess' => '0');
			echo json_encode($retData);
		}else{
			$retData = array('sucess' => '1');
			echo json_encode($retData);
		}
		break;
	case "getbusmodel";
		$ModelID=$_REQUEST['ModelID'];
		$ISUnitAdjust=$_REQUEST['ISUnitAdjust'];
		$Unit=$_REQUEST['Unit'];
		if($ISUnitAdjust=='1'){
			$selectbusmodel="SELECT DISTINCT bi_BusTypeID,bi_BusType FROM tms_bd_BusInfo WHERE bi_BusUnit='{$Unit}' AND bi_BusTypeID LIKE '{$ModelID}%' ";
			$querybusmodel=$class_mysql_default->my_query("$selectbusmodel");
			if(!$querybusmodel){
				$retData = array('retVal' => 'FAIL', 'retString' => '查询车型数据失败！'.$selectbusmodel.mysql_error(), 'sql' => $selectbusmodel);
				echo json_encode($retData);
				exit();
			}else{
				while($rowbusmodel=mysql_fetch_array($querybusmodel)){
					$retData[] = array('retVal' => 'SUCC','ModelID' => $rowbusmodel['bi_BusTypeID'], 'ModelName' => $rowbusmodel['bi_BusType']);
				}
				echo json_encode($retData);
			}
		}else{
			$selectbusmodel="SELECT DISTINCT bi_BusTypeID,bi_BusType FROM tms_bd_BusInfo WHERE bi_BusTypeID LIKE '{$ModelID}%'";
			$querybusmodel=$class_mysql_default->my_query("$selectbusmodel");
			if(!$querybusmodel){
				$retData = array('retVal' => 'FAIL', 'retString' => '查询车型数据失败！', 'sql' => $selectbusmodel);
				echo json_encode($retData);
				exit();
			}else{
				while($rowbusmodel=mysql_fetch_array($querybusmodel)){
					$retData[] = array('retVal' => 'SUCC','ModelID' => $rowbusmodel['bi_BusTypeID'], 'ModelName' => $rowbusmodel['bi_BusType']);
				}
				echo json_encode($retData);
			}
		}
		break;
	case "appendlineselect":
		$ISUnitAdjust=$_REQUEST['ISUnitAdjust'];
		$ISLineAdjust=$_REQUEST['ISLineAdjust'];
		$LineAdjust=$_REQUEST['LineAdjust'];
		$Unit=$_REQUEST['Unit'];
		if($ISUnitAdjust=='1'){
			$select="SELECT DISTINCT bi_BusTypeID,bi_BusType FROM tms_bd_BusInfo WHERE bi_BusUnit='$Unit'";
		}else{
			$select="SELECT DISTINCT bi_BusTypeID,bi_BusType FROM tms_bd_BusInfo";
		}
		$query=$class_mysql_default->my_query("$select");
		if(!$query){
			$retData = array('retVal' => 'FAIL', 'retString' => '查询车型数据失败！', 'sql' => $select);
			echo json_encode($retData);
			exit();
		}else{
			while($row=mysql_fetch_array($query)){
				$retData[] = array('retVal' => 'SUCC','ModelID' => $row['bi_BusTypeID'], 'ModelName' => $row['bi_BusType']);
			}
			echo json_encode($retData);
		}
		break;
	case "appendselect":
		$LineAdjust=$_REQUEST['LineAdjust'];
		$ISUnitAdjust=$_REQUEST['ISUnitAdjust'];
		$ISLineAdjust=$_REQUEST['ISNoRunsAdjust'];
		$Unit=$_REQUEST['Unit'];
		if($ISUnitAdjust=='0'){
			$Unit='';
		}
		$select="SELECT DISTINCT nrap_ModelID,nrap_ModelName FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ISUnitAdjust='{$ISUnitAdjust}' AND 
			nrap_ISLineAdjust='{$ISLineAdjust}' AND nrap_LineAdjust='{$LineAdjust}' AND nrap_Unit='{$Unit}' AND (nrap_NoRunsAdjust IS NULL)";
		$query=$class_mysql_default->my_query("$select");
		if(!$query){
			$retData = array('retVal' => 'FAIL', 'retString' => '查询班次票价车型数据失败！', 'sql' => $select);
			echo json_encode($retData);
			exit();
		}else{
			if(mysql_num_rows($query) == 0){
				$retData = array('retVal' => 'none', 'retString' => '请输入线路票价！', 'sql' => $select);
				echo json_encode($retData);
				exit();
			}else{
				while($row=mysql_fetch_array($query)){
					$retData[] = array('retVal' => 'SUCC','ModelID' => $row['nrap_ModelID'], 'ModelName' => $row['nrap_ModelName']);
				}
				echo json_encode($retData);
			}
		}
		break;
	case "appendselect1":
		$LineAdjust=$_REQUEST['LineAdjust'];
		$ISUnitAdjust=$_REQUEST['ISUnitAdjust'];
		$ISLineAdjust=$_REQUEST['ISNoRunsAdjust'];
		$Unit=$_REQUEST['Unit'];
		if($ISUnitAdjust=='0'){
			$Unit='';
		}
		$select="SELECT DISTINCT sfa_ModelID,sfa_ModelName FROM tms_bd_ServiceFeeAdjust WHERE sfa_ISUnitAdjust='{$ISUnitAdjust}' AND 
			sfa_ISLineAdjust='{$ISLineAdjust}' AND sfa_LineAdjust='{$LineAdjust}' AND sfa_Unit='{$Unit}' AND (sfa_NoRunsAdjust IS NULL)";
		$query=$class_mysql_default->my_query("$select");
		if(!$query){
			$retData = array('retVal' => 'FAIL', 'retString' => '查询班次站务费车型数据失败！'.mysql_error(), 'sql' => $select);
			echo json_encode($retData);
			exit();
		}else{
			while($row=mysql_fetch_array($query)){
				$retData[] = array('retVal' => 'SUCC','ModelID' => $row['sfa_ModelID'], 'ModelName' => $row['sfa_ModelName']);
			}
			echo json_encode($retData);
		}
		break;
	case "getRegionCode":
		$Region = trim($_GET['Region']);
		$Region1 = trim($_GET['Region1']);
		//获取最大四位自增变量
		$str="select max(substring(sset_SiteID,-4)) as MaxCode from tms_bd_SiteSet WHERE sset_Region='$Region1'";
		$query1 = $class_mysql_default->my_query("$str");
		$rows=mysql_fetch_array($query1);
		if($rows['MaxCode'] == null){
		   $rows['MaxCode'] = "0000";
		}
		else{
		   $rows['MaxCode'] = $rows['MaxCode']+1;
		   $rows['MaxCode'] = str_pad($rows['MaxCode'], 4, "0", STR_PAD_LEFT);
		}
		//获取区域编码
		$query="SELECT rs_RegionCode FROM tms_bd_RegionSet WHERE rs_RegionName='{$Region}'";
		$result1=$class_mysql_default->my_query("$query");
		if(!$result1) {
		$retData = array('retVal' => 'FAIL', 'retString' => '查询区域编号失败！', 'sql' => $queryString);
		echo json_encode($retData);
		exit();
		}
		else{
			$row=mysql_fetch_array($result1);
			$retData = array('retVal' => 'SUCC', 'RedionCode' => $row['rs_RegionCode'], 'MaxCode' => $rows['MaxCode']);
			echo json_encode($retData);
		}
		break;
		
		//获取班次编号信息
		case "getnorunsCode":
		$BeginSiteI = trim($_GET['BeginSiteI']);
		$EndSiteI = trim($_GET['EndSiteI']);
		//获取区域编码
		$query2="SELECT sset_HelpCode FROM tms_bd_SiteSet WHERE sset_SiteID='{$BeginSiteI}'";
		$result1=$class_mysql_default->my_query("$query2");
		$query3="SELECT sset_HelpCode FROM tms_bd_SiteSet WHERE sset_SiteID='{$EndSiteI}'";
		$result2=$class_mysql_default->my_query("$query3");
			$row=mysql_fetch_array($result1);
			$row1=mysql_fetch_array($result2);
			//获取最大四位自增变量
			$str2=$row['sset_HelpCode'].$row1['sset_HelpCode'];
			$str="select max(substring(nri_NoOfRunsID,-4)) as MaxCode from tms_bd_NoRunsInfo where nri_NoOfRunsID not like '%加%' AND nri_NoOfRunsID like '$str2%'";
			$query1 = $class_mysql_default->my_query("$str");
			$rows=mysql_fetch_array($query1);
			if($rows['MaxCode'] == null){
		   		$rows['MaxCode'] = "0000";
			}
			else{
		   	$rows['MaxCode'] = $rows['MaxCode']+1;
		   	$rows['MaxCode'] = str_pad($rows['MaxCode'], 4, "0", STR_PAD_LEFT);
			}
			$retData = array('retVal' => 'SUCC', 'BeginSiteI' => $row['sset_HelpCode'], 'EndSiteI' => $row1['sset_HelpCode'], 'MaxCode' => $rows['MaxCode']);
			echo json_encode($retData);
		break;
		
		case getmaxcode:
			$CodePart = trim($_GET['CodePart']);	
			$query="select max(substring(li_LineID,-4)) as MaxCode from tms_bd_LineInfo where  li_LineID like '$CodePart%'";
			$result=$class_mysql_default->my_query("$query");
			$row=mysql_fetch_array($result);
			if($row['MaxCode'] == null){
		   		$row['MaxCode'] = "0000";
			}
			else{
		   		$row['MaxCode'] = $row['MaxCode']+1;
		   		$row['MaxCode'] = str_pad($row['MaxCode'], 4, "0", STR_PAD_LEFT);
			}
			$retData = array('retVal' => 'SUCC', 'MaxCode' => $row['MaxCode']);
			echo json_encode($retData);
 		break;
 		
		case "GETLINE": //获取经营线路
			$LineName=$_REQUEST['LineName'];
			$selectlinename="SELECT li_LineName FROM tms_bd_LineInfo  WHERE li_LineID LIKE '$LineName%'";
			$resultlinename = $class_mysql_default->my_query("$selectlinename");
			while($rowlinename=mysql_fetch_array($resultlinename)){
			$retData[] = array(
				'LineName' => $rowlinename['li_LineName']);
		}
		echo json_encode($retData);
		break;	

		case "checkDriverCard"://判断驾照号唯一
			$DriverCard=trim($_GET['DriverCard']);
			$sql4="select di_DriverCard FROM tms_bd_DriverInfo WHERE di_DriverCard='{$DriverCard}'";
			$query4 =$class_mysql_default->my_query($sql4);
			$results=mysql_fetch_array($query4); 
			$driverCard=$results['di_DriverCard'];
			if ($driverCard) {
				$retData = array(
				'sucess' => '1');
				echo json_encode($retData);
			}else{
				$retData = array(
					'sucess' => '0');
				echo json_encode($retData);
			}
		break;
		case "addbus": //判断车辆编码唯一
		$Code=trim($_GET['code']);
		$str = "SELECT bi_BusNumber FROM tms_bd_BusInfo where bi_BusID='$Code'";
		$select = mysql_query($str);
		$rows = mysql_fetch_array($select);
		if ($rows['bi_BusNumber'] != null) {
			$retData = array(
				'sucess' => '1');
			echo json_encode($retData);
		}else{
			$retData = array(
				'sucess' => '0');
			echo json_encode($retData);
		  }
		break;	
		case "addbusnum": //判断车牌号唯一
		$carnum=trim($_GET['carnum']);
		$str = "SELECT bi_BusID FROM tms_bd_BusInfo where bi_BusNumber='$carnum'";
		$select = mysql_query($str);
		$rows = mysql_fetch_array($select);
		if ($rows['bi_BusID'] != null) {
			$retData = array(
				'sucess' => '1');
			echo json_encode($retData);
		}else{
			$retData = array(
				'sucess' => '0');
			echo json_encode($retData);
		  }
		break;	
		
		case "addbusmodel": //判断车型编号唯一
		$ModelID=trim($_GET['ModelID']);
		$str = "SELECT bm_ModelName FROM tms_bd_BusModel where bm_ModelID='$ModelID'";
		$select = mysql_query($str);
		$rows = mysql_fetch_array($select);
		if ($rows['bm_ModelName'] != null) {
			$retData = array(
				'sucess' => '1');
			echo json_encode($retData);
		}else{
			$retData = array(
				'sucess' => '0');
			echo json_encode($retData);
		  }
		break;	
		case "adddriver": //判断驾驶员编号唯一
		$DriverID=trim($_GET['DriverID']);
		$str = "SELECT di_Name FROM tms_bd_DriverInfo where di_DriverID='$DriverID'";
		$select = mysql_query($str);
		$rows = mysql_fetch_array($select);
		if ($rows['di_Name'] != null) {
			$retData = array(
				'sucess' => '1');
			echo json_encode($retData);
		}else{
			$retData = array(
				'sucess' => '0');
			echo json_encode($retData);
		  }
		break;	
		case "addbusunit": //车属单位
		$UnitName=trim($_GET['UnitName']);
		$str = "SELECT bu_UnitName FROM tms_bd_BusUnit where bu_UnitName='$UnitName'";
		$select = mysql_query($str);
		$rows = mysql_fetch_array($select);
		if ($rows['bu_UnitName'] != null) {
			$retData = array(
				'sucess' => '1');
			echo json_encode($retData);
		}else{
			$retData = array(
				'sucess' => '0');
			echo json_encode($retData);
		  }
		break;	
		case "addfeetype": //车辆收费类型
		$FeeTypeName=trim($_GET['FeeTypeName']);
		$str = "select ft_FeeTypeName from tms_bd_FeeType where ft_FeeTypeName='{$FeeTypeName}'";
		$select = mysql_query($str);
		$rows = mysql_fetch_array($select);
		if ($rows['ft_FeeTypeName'] != null) {
			$retData = array(
				'sucess' => '1');
			echo json_encode($retData);
		}else{
			$retData = array(
				'sucess' => '0');
			echo json_encode($retData);
		  }
		break;	
		case "addbusfee": //车辆收费项目
		$BusNumber=trim($_GET['BusNumber']);
		$str = "select br_BusNumber from tms_acct_BusRate where br_BusNumber='{$BusNumber}'";
		$select = mysql_query($str);
		$rows = mysql_fetch_array($select);
		if ($rows['br_BusNumber'] != null) {
			$retData = array(
				'sucess' => '1');
			echo json_encode($retData);
		}else{
			$retData = array(
				'sucess' => '0');
			echo json_encode($retData);
		  }
		break;	
		
		case "addtickettype": //票据类型
		$TypeName=trim($_GET['TypeName']);
		$str = "select tt_ID from tms_bd_TicketType where tt_TypeName='{$TypeName}'";
		$select = mysql_query($str);
		$rows = mysql_fetch_array($select);
		if ($rows['tt_ID'] != null) {
			$retData = array(
				'sucess' => '1');
			echo json_encode($retData);
		}else{
			$retData = array(
				'sucess' => '0');
			echo json_encode($retData);
		  }
		break;	
		
		case "addreturntickettype": 
		$ReturnType=trim($_GET['ReturnType']);
		$str = "select rte_ReturnType from tms_sell_ReturnType  where rte_ReturnType='{$ReturnType}'";
		$select = mysql_query($str);
		$rows = mysql_fetch_array($select);
		if ($rows['rte_ReturnType'] != null) {
			$retData = array(
				'sucess' => '1');
			echo json_encode($retData);
		}else{
			$retData = array(
				'sucess' => '0');
			echo json_encode($retData);
		  }
		break;	
		
		case "addinsuretype": 
		$INSUREPRODUCTNAME=trim($_GET['INSUREPRODUCTNAME']);
		$str = "select it_InsureProductName from tms_bd_InsureType  where it_InsureProductName='{$INSUREPRODUCTNAME}'";
		$select = mysql_query($str);
		$rows = mysql_fetch_array($select);
		if ($rows['it_InsureProductName'] != null) {
			$retData = array(
				'sucess' => '1');
			echo json_encode($retData);
		}else{
			$retData = array(
				'sucess' => '0');
			echo json_encode($retData);
		  }
		break;	
		
	case "getwindowvalue"://验证检票点是否是车站
		$SiteNam=trim($_GET['SiteNam']);
		$sql1 = "select sset_SiteName FROM tms_bd_SiteSet where sset_IsStation=1 and sset_SiteName='{$SiteNam}'";
		$query1 =$class_mysql_default->my_query($sql1);
		$results=mysql_fetch_array($query1); 
		$sset_SiteName=$results['sset_SiteName'];
		if ($sset_SiteName) {
		$retData = array(
				'sucess' => '1');
			echo json_encode($retData);
		}else{
			$retData = array(
				'sucess' => '0');
			echo json_encode($retData);
		}
		break;
		case "gettimes":
			$NoOfRunsID=$_REQUEST['NoOfRunsID'];
			$RunHours=$_REQUEST['RunHours'];
			$RunMinuts=$_REQUEST['RunMinuts'];
			$DepartureTime='';
			$opp=$_REQUEST['opp'];
			$ID=$_REQUEST['ID'];
			$IDD=$ID-1;
			if($opp=='mod'){
				$ID=$ID+1;
			}
			if($RunHours==''){
				$RunHourss=0;
			}else{
				$RunHourss=$RunHours;
			}
			if($RunMinuts==''){
				$RunMinutss=0;
			}else{
				$RunMinutss=$RunMinuts;
			}
			$allRunminutes=$RunHourss*60+$RunMinutss;
			$select1="SELECT nds_RunHours FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsID}' AND nds_ID>='{$ID}'";
			$query1= $class_mysql_default->my_query($select1);
			if(!$query1){
				$retData = array('retVal' => 'FAIL', 'retString' => '查询班次停靠点1数据失败！', 'sql' => $select1);
				echo json_encode($retData);
				exit();
			}
			while($row1=mysql_fetch_array($query1)){
				if($row1['nds_RunHours']){
					$Hours='';
		        	$Minutes='';
					$RunHours1=explode(":", $row1['nds_RunHours']);
					if($RunHours1[0]) $Hours=$RunHours1[0].'小时';
		        	if($RunHours1[1]) $Minutes=$RunHours1[1].'分钟'; 
					$allRunminutes1=$RunHours1[0]*60+$RunHours1[1];
					if($RunHours!='' || $RunMinuts!=''){
						if($allRunminutes1<=$allRunminutes){
							$retData = array('retVal' => 'FAIL', 'retString' => '输入运行时间不能大等于'.$Hours.$Minutes.'！');
							echo json_encode($retData);
							exit();
						}
					}
				}
			}
			$select2="SELECT nds_RunHours FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsID}' AND nds_ID<='{$IDD}'";
			$query2= $class_mysql_default->my_query($select2);
			if(!$query2){
				$retData = array('retVal' => 'FAIL', 'retString' => '查询班次停靠点2数据失败！', 'sql' => $select1);
				echo json_encode($retData);
				exit();
			}
			while($row2=mysql_fetch_array($query2)){
				if($row2['nds_RunHours']){
					$Hours='';
		        	$Minutes='';
					$RunHours2=explode(":", $row2['nds_RunHours']);
					if($RunHours2[0]) $Hours=$RunHours2[0].'小时';
		        	if($RunHours2[1]) $Minutes=$RunHours2[1].'分钟'; 
					$allRunminutes2=$RunHours2[0]*60+$RunHours2[1];
					if($RunHours!='' || $RunMinuts!=''){
						if($allRunminutes2>=$allRunminutes){
							$retData = array('retVal' => 'FAIL', 'retString' => '输入运行时间不能小等于'.$Hours.$Minutes.'！');
							echo json_encode($retData);
							exit();
						}
					}
				}
			} 
			$select3="SELECT nds_DepartureTime FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$NoOfRunsID}' AND nds_ID='1'";
			$query3=$class_mysql_default->my_query($select3);
			if(!$query3){
				$retData = array('retVal' => 'FAIL', 'retString' => '查询班次停靠点3数据失败！', 'sql' => $select3);
				echo json_encode($retData);
				exit();
			}
			$row3=mysql_fetch_array($query3);
			if($row3['nds_DepartureTime']){
				$DepartureTime=date('H:i', strtotime ('+'.$allRunminutes.' minute', strtotime($row3['nds_DepartureTime'])));
			}
			$retData = array('retVal' => 'SUCC', 'retString' => $DepartureTime);
			echo json_encode($retData);
			break;
		case "getsection":
			$NoOfRunsID=$_REQUEST['NoOfRunsID'];
			$ID=$_REQUEST['ID'];
			$SectionID=$_REQUEST['SectionID'];
			$SiteID=$_REQUEST['SiteID'];
			$SiteName=$_REQUEST['SiteName'];
			$select1="SELECT nds_SiteName,nds_ID,si_SectionID,nds_SiteID FROM tms_bd_NoRunsDockSite,tms_bd_SectionInfo WHERE nds_NoOfRunsID='{$NoOfRunsID}' AND 
				nds_ID<'{$ID}' AND nds_SiteID=si_SiteNameID AND si_LineID=(SELECT nri_LineID FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID='{$NoOfRunsID}')";
			$query1=$class_mysql_default->my_query($select1);
			if(!$query1){
				$retData = array('retVal' => 'FAIL', 'retString' => '查询班次停靠点1数据失败！', 'sql' => $select1);
				echo json_encode($retData);
				exit();
			}
			while($row1=mysql_fetch_array($query1)){
				if($row1['si_SectionID']>$SectionID){
					$retData = array('retVal' => 'FAIL', 'retString' => '前面站点'.$row1['nds_SiteName'].'的序号'.$row1['si_SectionID'].'大于站点'.$SiteName.'的序号'.$SectionID);
					echo json_encode($retData);
					exit();
				}
				if($row1['si_SectionID']==$SectionID && $row1['nds_SiteID']==$SiteID){
					$retData = array('retVal' => 'FAIL', 'retString' =>'站点'.$SiteName.'已添加');
					echo json_encode($retData);
					exit();
				}
			}
			$select2="SELECT nds_SiteName,nds_ID,si_SectionID,nds_SiteID FROM tms_bd_NoRunsDockSite,tms_bd_SectionInfo WHERE nds_NoOfRunsID='{$NoOfRunsID}' AND 
				nds_ID>='{$ID}' AND nds_SiteID=si_SiteNameID AND si_LineID=(SELECT nri_LineID FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID='{$NoOfRunsID}')";
			$query2=$class_mysql_default->my_query($select2);
			if(!$query2){
				$retData = array('retVal' => 'FAIL', 'retString' => '查询班次停靠点1数据失败！', 'sql' => $select2);
				echo json_encode($retData);
				exit();
			}
			while($row2=mysql_fetch_array($query2)){
				if($row2['si_SectionID']<$SectionID){
					$retData = array('retVal' => 'FAIL', 'retString' => '后面站点'.$row2['nds_SiteName'].'的序号'.$row2['si_SectionID'].'小于站点'.$SiteName.'的序号'.$SectionID);
					echo json_encode($retData);
					exit();
				}
				if($row2['si_SectionID']=$SectionID && $SiteID==$row2['nds_SiteID']){
					$retData = array('retVal' => 'FAIL', 'retString' =>'站点'.$SiteName.'已添加');
					echo json_encode($retData);
					exit();
				} 
			} 
			$retData = array('retVal' => 'SUCC');
			echo json_encode($retData);
			break;
		case "appendbusmodel":
			$BusUnit=$_REQUEST['BusUnit'];
			$NoOfRunsID=$_REQUEST['NoOfRunsID'];
			$select1="SELECT DISTINCT nrap_ModelID,nrap_ModelName FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ISUnitAdjust='1' AND nrap_Unit='{$BusUnit}' AND 
				nrap_NoRunsAdjust='{$NoOfRunsID}' AND nrap_ModelID IN (SELECT DISTINCT bi_BusTypeID FROM tms_bd_BusInfo WHERE bi_BusUnit='{$BusUnit}')";
			$query1=$class_mysql_default->my_query("$select1");
			if(!$query1){
				$retData = array('retVal' => 'FAIL', 'retString' => '查询班次调价1数据失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
			while($row1=mysql_fetch_array($query1)){
				$modle[]=array('ModelName'=>$row1['nrap_ModelName'],'ModelID'=>$row1['nrap_ModelID']);
			}
		//	echo json_encode($modle);
			$select2="SELECT DISTINCT nrap_ModelID,nrap_ModelName FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ISNoRunsAdjust='1' AND nrap_NoRunsAdjust='{$NoOfRunsID}'
				AND nrap_ModelID IN (SELECT DISTINCT bi_BusTypeID FROM tms_bd_BusInfo WHERE bi_BusUnit='{$BusUnit}') AND nrap_ModelID NOT IN (SELECT DISTINCT 
				nrap_ModelID FROM tms_bd_NoRunsAdjustPrice WHERE nrap_ISUnitAdjust='1' AND nrap_Unit='{$BusUnit}' AND nrap_NoRunsAdjust='{$NoOfRunsID}')";
			$query2=$class_mysql_default->my_query("$select2");
			if(!$query2){
				$retData = array('retVal' => 'FAIL', 'retString' => '查询班次调价2数据失败！', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
			while($row2=mysql_fetch_array($query2)){
				$modle[]=array('ModelName'=>$row2['nrap_ModelName'],'ModelID'=>$row2['nrap_ModelID']);
			} 
			$length=count($modle);
			if($length==0){
				$retData = array('retVal' => 'FAIL', 'retString' => '请添加班次价格！');
				echo json_encode($retData);
				exit();
			}
			echo json_encode($modle);
}

function getBusData($busid,$class_mysql_default)
{
//	$queryString = "SELECT bi_BusNumber,bi_BusTypeID,bi_BusType,bi_SeatS,bi_AddSeatS,bi_Tonnage,bi_InStationID,bi_InStation 
//		FROM tms_bd_BusInfo WHERE bi_BusID='{$busid}'";
	$queryString = "SELECT tms_bd_BusInfo.bi_BusNumber,tms_bd_BusInfo.bi_BusTypeID,tms_bd_BusInfo.bi_BusType,tms_bd_BusInfo.bi_SeatS,
			tms_bd_BusInfo.bi_AddSeatS,tms_bd_BusInfo.bi_InStationID,tms_bd_BusInfo.bi_InStation,tms_bd_BusInfo.bi_AllowHalfSeats,
			tms_bd_BusModel.bm_Weight FROM tms_bd_BusInfo,tms_bd_BusModel WHERE tms_bd_BusInfo.bi_BusTypeID=tms_bd_BusModel.bm_ModelID AND 
			tms_bd_BusInfo.bi_BusID='{$busid}'";
	$result = $class_mysql_default->my_query("$queryString");
	if(!$result) {
		$retData = array('retVal' => 'FAIL', 'retString' => '查询车辆数据失败！', 'sql' => $queryString);
		echo json_encode($retData);
		exit();
	}
	$row = mysql_fetch_array($result);
	$retData = array(
		'BusNumber' => $row['bi_BusNumber'],
		'BusTypeID' => $row['bi_BusTypeID'],
		'BusType' => $row['bi_BusType'],
		'SeatS'=> $row['bi_SeatS'],
		'AddSeatS' => $row['bi_AddSeatS'],
		'Weight'=> $row['bm_Weight'],
		'AllowHalfSeats' =>$row['bi_AllowHalfSeats'],
		'InStationID' => $row['bi_InStationID'],
		'InStation' => $row['bi_InStation']);
	echo json_encode($retData);
}

function getBusModelData($ModelID,$class_mysql_default)
{
	$queryString="SELECT bm_ModelName,bm_Seating,bm_AddSeating,bm_AllowHalfSeats,bm_Weight FROM tms_bd_BusModel WHERE bm_ModelID='{$ModelID}'";
	$result = $class_mysql_default->my_query("$queryString");
	if(!$result) {
		$retData = array('retVal' => 'FAIL', 'retString' => '查询车型数据失败！', 'sql' => $queryString);
		echo json_encode($retData);
		exit();
	}
	$row = mysql_fetch_array($result);
	$retData = array(
	//	'BusNumber' => $row['bi_BusNumber'],
	//	'BusTypeID' => $row['bi_BusTypeID'],
		'BusType' => $row['bm_ModelName'],
		'SeatS'=> $row['bm_Seating'],
		'AddSeatS' => $row['bm_AddSeating'],
		'Weight'=> $row['bm_Weight'],
		'AllowHalfSeats' =>$row['bm_AllowHalfSeats']);
	echo json_encode($retData);
}

function getInceptUse($InceptUserID,$class_mysql_default)
{
	$queryString = "SELECT ui_UserName,ui_UserSation FROM tms_sys_UsInfor WHERE ui_UserID='{$InceptUserID}'";
	$result = $class_mysql_default->my_query("$queryString");
	if(!$result) {
		$retData = array('retVal' => 'FAIL', 'retString' => '查询用户数据失败！', 'sql' => $queryString);
		echo json_encode($retData);
		exit();
	}
	$row = mysql_fetch_array($result);
	$retData = array(
		'InceptUser' => $row['ui_UserName'],
		'InceptUserSation' => $row['ui_UserSation']);
	echo json_encode($retData);
}
function getRegion($SiteId,$class_mysql_default)
{
	$SiteId=substr($SiteId,0,4);
	$queryString = "SELECT  rs_RegionName, rs_RegionCode FROM tms_bd_RegionSet WHERE rs_RegionCode LIKE '{$SiteId}%'";
	$result = $class_mysql_default->my_query("$queryString");
	if(!$result) {
		$retData = array('retVal' => 'FAIL', 'retString' => '查询用户数据失败！', 'sql' => $queryString);
		echo json_encode($retData);
		exit();
	}
	if(!mysql_num_rows($result)){
		$retData = array('retVal' => 'FAIL1');
		echo json_encode($retData);
		exit();
	}
	while ($row = mysql_fetch_array($result)) {
		$retData[] = array(
			'RegionName' => $row['rs_RegionName'],'RegionCode' => $row['rs_RegionCode']);
		
	}
	echo json_encode($retData);
}
function getSite($Site,$class_mysql_default){
	$queryString = "SELECT  sset_SiteID, sset_SiteName,sset_HelpCode  FROM tms_bd_SiteSet WHERE sset_HelpCode  LIKE '{$Site}%'";
	$result = $class_mysql_default->my_query("$queryString");
	if(!$result) {
		$retData = array('retVal' => 'FAIL', 'retString' => '查询用户数据失败！', 'sql' => $queryString);
		echo json_encode($retData);
		exit();
	}
	while ($row = mysql_fetch_array($result)) {
		$retData[] = array(
			'SiteID'=>$row['sset_SiteID'],
		    'HelpCode'=>$row['sset_HelpCode'],
			'SiteName' => $row['sset_SiteName']);
	}
	echo json_encode($retData);
}

function getStation($Site,$class_mysql_default){
	$queryString = "SELECT  sset_SiteName  FROM tms_bd_SiteSet WHERE sset_HelpCode  LIKE '{$Site}%' AND sset_IsStation='1'";
	$result = $class_mysql_default->my_query("$queryString");
	if(!$result) {
		$retData = array('retVal' => 'FAIL', 'retString' => '查询用户数据失败！', 'sql' => $queryString);
		echo json_encode($retData);
		exit();
	}
	while ($row = mysql_fetch_array($result)) {
		$retData[] = array(
			'SiteName' => $row['sset_SiteName']);
	}
	echo json_encode($retData);
}
function backProvide($ID, $userName,$userID,$userStationName, $class_mysql_default){
	$showtime=date("Y-m-d");
	$time=date("H:i:s");
	$select="SELECT tp_BeginTicket,tp_CurrentTicket,tp_EndTicket,tp_InceptTicketNum,tp_Type FROM tms_bd_TicketProvide WHERE
		tp_ID='{$ID}'";
	$query1=$class_mysql_default->my_query("$select");
	$rows=mysql_fetch_array($query1);
	$EndTicket=$rows['tp_CurrentTicket']-1;
	$class_mysql_default->my_query("START TRANSACTION");
	$insert="INSERT INTO tms_bd_TicketAdd (ta_Data,ta_Time,ta_BeginTicket,ta_EndTicket,ta_CurrentTicket,ta_AddNum,ta_LostNum,
		ta_Type,ta_UserID,ta_User,ta_UserSation,ta_Remark) VALUES ('{$showtime}','{$time}','{$rows['tp_CurrentTicket']}','{$rows['tp_EndTicket']}','{$rows['tp_CurrentTicket']}',
		'{$rows['tp_InceptTicketNum']}','{$rows['tp_InceptTicketNum']}','{$rows['tp_Type']}','$userID','$userName','$userStationName','退领')";
	$query2=$class_mysql_default->my_query("$insert");
	$update="UPDATE tms_bd_TicketProvide SET tp_EndTicket='{$EndTicket}',tp_InceptTicketNum='0',tp_UseState='退领' WHERE
		tp_ID='{$ID}'";
//	$update="UPDATE tms_bd_TicketProvide SET tp_UseState='退领' WHERE tp_ID='{$ID}'";
	$query3=$class_mysql_default->my_query("$update");
	if($query2 && $query3){
		$class_mysql_default->my_query("COMMIT");
		$retData = array('sucess' => '1');
		echo json_encode($retData);
	}else{
		$class_mysql_default->my_query("ROLLBACK");
		$retData = array('sucess' => '0');
		echo json_encode($retData);
	}
	$class_mysql_default->my_query("END TRANSACTION");
}

?>

