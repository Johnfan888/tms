<?php	
/*
 * 保险票上传
 * 	
 * 1）参数 className 值为固定值“TicketPolicy”；
 * 2）提交批量保单数据保存请求时，action 参数值为固定值“SavePolicys”；
 * 3）datas 是需要电子商务系统处理的数据，必须满足电子商务系统定义的XML 数据格式。具体如下：
	以<PolicyInfos>节点为根节点，包含一个<MainInfo>节点，可以包含1 至 100个<Policy>节点， <MainInfo>节点和<Policy>节点下有第三级节点，格式如下：
		<?xml version="1.0" encoding="GB2312" standalone="yes"?>
		<PolicyInfos>
			<Policy>
				<PolicyNo>保单号</PolicyNo>
				<VisaCode>单证识别码</VisaCode>
				<PrintNo>保单凭证流水号</PrintNo>
				<Car_ShipNo>车船号</Car_ShipNo> 
				<SeatNo>座位号</SeatNo>
				<OperateDate>售出保险时间</OperateDate>
				<StartDate>起保日期</StartDate>
				<StartHour>起保时间（小时）</StartHour>
				<EndDate>终保日期</EndDate>
				<EndHour>终保时间（小时）</EndHour>
				<SumAmount>保单总保险金额</SumAmount>
				<SumPremium>保单总保险费</SumPremium>
				<RationType>保障方案代码</RationType>
				<AppliName>投保人姓名</AppliName>
				<AppliIdType>投保人证件类型</AppliIdType>
				<AppliIdNo>投保人证件号</AppliIdNo>
				<AppliAddress>投保人住址</AppliAddress>
				<InsuredName>被保险人姓名</InsuredName>
				<InsuredIdType>被保险人证件类型</InsuredIdType>
				<InsuredIdNo>被保险人证件号</InsuredIdNo>
				<InsuredAddress>被保险人住址</InsuredAddress>
				<BenefitName>受益人姓名</BenefitName>
				<BenefitIdType>受益人证件类型</BenefitIdType>
				<BenefitIdNo>受益人证件号</BenefitIdNo>
				<ArbitBoardName>仲裁机构名称</ArbitBoardName>
				<MakeCom>出单机构代码</MakeCom>
				<HandlerCode>默认经办人代码</HandlerCode>
				<Handler1Code>默认归属经办人代码</Handler1Code>
				<OperatorCode>默认操作员代码</OperatorCode>
				<ApproverCode>复核人员代码</ApproverCode>
			</Policy>
			<Policy>
				……
				……
			</Policy>
			<MainInfo>
				<RiskCode>险种代码</RiskCode>
				<ComCode>归属机构代码</ComCode>
				<AgentCode>代理机构代码</AgentCode>
				<Md5Value>数据加密校验字符串</Md5Value>
			</MainInfo>
		</PolicyInfos>
 */

require_once("../../ui/inc/init.inc.php");

/*
try {
	$client = new SoapClient("http://www.e-picc.com.cn/EbsWebServices/services/JWSFactory?wsdl",array('encoding'=>'UTF-8'));
	var_dump($client->__getFunctions());
	var_dump($client->__getTypes());
} catch (SOAPFault $e) {
	print $e->getMessage();
}*/

function create_item($doc, $parent, $item, $data)
{
	$node = $doc->createElement($item);
	$node->appendChild($doc->createTextNode($data));
	$parent->appendChild($node);
}

//  创建一个XML文档并设置XML版本和编码
$doc = new DOMDocument('1.0', 'UTF-8');
//$doc = new DOMDocument('1.0', 'GB2312');
$doc->formatOutput = true;

//  创建根节点
$PolicyInfos = $doc->createElement('PolicyInfos');
$doc->appendchild($PolicyInfos);

$cnt = 0; 
$limit = 1;	//1 至 100个<Policy>节点 
$queryString = "SELECT itt_SyncCode,itt_TicketNo,itt_SeatNo,itt_ReachName,itt_InsureTicketNo,itt_AinsuranceValue,itt_BinsuranceValue,
	itt_Price,itt_CreatedType,itt_Status,itt_IdCard,itt_Name,itt_Beneficiary,itt_SaleTime,itt_Saler,itt_RiskCode,itt_MakeCode,itt_VisaCode,itt_ComCode,itt_HandlerCode,
	itt_Handler1Code,itt_OperatorCode,itt_ApporverCode,itt_UploadStatus,itt_ReturnUploadStatus,st_NoOfRunsdate,st_NoOfRunsID,
	st_SellPrice,st_SellPriceType, st_TicketState, st_SellDate FROM tms_sell_InsureTicket,tms_sell_SellTicket 
	WHERE tms_sell_InsureTicket.itt_TicketNo=tms_sell_SellTicket.st_TicketID ORDER BY st_SellDate DESC";
$result = $class_mysql_default->my_query("$queryString");
while ($row = mysql_fetch_array($result)) {
	$Policy = $doc->createElement('Policy');
	$PolicyNo = "PEDA201443100301Z00001";
	create_item($doc,$Policy,"PolicyNo",$PolicyNo);
	create_item($doc,$Policy,"VisaCode","AEEDAA2013ZJP");
	create_item($doc,$Policy,"PrintNo",$row['itt_InsureTicketNo']);
	create_item($doc,$Policy,"Car_ShipNo",$row['st_NoOfRunsID']);
	create_item($doc,$Policy,"SeatNo",$row['itt_SeatNo']);
	create_item($doc,$Policy,"OperateDate",substr($row['itt_SaleTime'], 0, 16));
	create_item($doc,$Policy,"StartDate",$row['st_NoOfRunsdate']);
	create_item($doc,$Policy,"StartHour","0");
	create_item($doc,$Policy,"EndDate",$row['st_NoOfRunsdate']);
	create_item($doc,$Policy,"EndHour","24");
	create_item($doc,$Policy,"SumAmount",intval($row['itt_AinsuranceValue']));
	create_item($doc,$Policy,"SumPremium",intval($row['itt_Price']));
	create_item($doc,$Policy,"RationType","4310A");
	create_item($doc,$Policy,"AppliName",$row['itt_Name']);
	create_item($doc,$Policy,"AppliIdType","01");
	create_item($doc,$Policy,"AppliIdNo",$row['itt_IdCard']);
	create_item($doc,$Policy,"AppliAddress","");
	create_item($doc,$Policy,"InsuredName",$row['itt_Name']);
	create_item($doc,$Policy,"InsuredIdType","01");
	create_item($doc,$Policy,"InsuredIdNo",$row['itt_IdCard']);
	create_item($doc,$Policy,"InsuredAddress","");
	create_item($doc,$Policy,"BenefitName",$row['itt_Beneficiary']);
	create_item($doc,$Policy,"BenefitIdType","");
	create_item($doc,$Policy,"BenefitIdNo","");
	create_item($doc,$Policy,"ArbitBoardName","");
	create_item($doc,$Policy,"MakeCom","43100301");
	create_item($doc,$Policy,"HandlerCode","4310035041");
	create_item($doc,$Policy,"Handler1Code","84302893");
	create_item($doc,$Policy,"OperatorCode","4310035048");
	create_item($doc,$Policy,"ApproverCode","4310035057");
	$PolicyInfos->appendchild($Policy);

	$cnt++; 
	if ($limit == $cnt) {
		//  创建 共同元素和元素值
		$MainInfo = $doc->createElement('MainInfo');
		create_item($doc,$MainInfo,"RiskCode","EDA");
		create_item($doc,$MainInfo,"ComCode","43100300");
		create_item($doc,$MainInfo,"AgentCode","43003F300025");
		$string1 = $PolicyNo.intval($row['itt_Price']);
		echo $string1;
		//$string2 = substr(md5($string1),8,16);	// 16位MD5加密
		$string2 = trim(md5(trim($string1)));	// 32位MD5加密
		create_item($doc,$MainInfo,"Md5Value",$string2);
		//create_item($doc,$MainInfo,"Md5Value","PiccSh85ou56pi36");
		$PolicyInfos->appendchild($MainInfo);
		$datas = $doc->saveXML();
		$param = array('className'=>'TicketPolicy', 'action'=>'SavePolicys', 'datas'=>$datas);
		echo $datas;
		try {
            $options = array( 
                'soap_version' => SOAP_1_2, 
                'exceptions' => true, 
                'trace' => 1, 
                'cache_wsdl' => WSDL_CACHE_NONE, 
				'encoding' => 'UTF-8'
            ); 
            $client = new SoapClient('http://www.e-picc.com.cn/EbsWebServices/services/JWSFactory?wsdl', $options);
			var_dump($client->__getFunctions()); 
            var_dump($client->__getTypes()); 
        } catch (Exception $e) { 
            echo "Exception Error!"; 
            echo $e->getMessage(); 
        }
        
        echo "running invoke method:\n";                                      
		try { 
			$retXML = $client->__call("invoke",$param);
			print_r($retXML);
			
		    $xml_doc = new DOMDocument();  
		    $xml_doc->loadXML($retXML);
		    $results = $xml_doc->getElementsByTagName('Exception');
		    foreach($results as $result ) {  
		        $ErrorCode = $result->getElementsByTagName('ErrorCode');  
		        $retData = $ErrorCode->item(0)->nodeValue;
		        //05:MD5校验错误，非法的数据请求。
		        //可能是与服务供应商的MD5编码算法不一致，需要与服务供应商联系确认
		        echo "\nErrorCode:" . $retData . "\n";
		        exit();
		    }		   
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n"; 
		} 
		$cnt = 0; 
	}
}

if ($cnt > 0) {
	//  创建 共同元素和元素值
	$MainInfo = $doc->createElement('MainInfo');
	create_item($doc,$MainInfo,"RiskCode","EDA");
	create_item($doc,$MainInfo,"ComCode","43100300");
	create_item($doc,$MainInfo,"AgentCode","43003F300025");
	create_item($doc,$MainInfo,"Md5Value","43103F300001");
	$PolicyInfos->appendchild($MainInfo);
	$datas = $doc->saveXML();
	echo $datas;
}
?>
