<?php
//���Ȳ�������

//����ҳ�������֤�Ƿ��¼	
define("AUTH", "TRUE");

//�����ʼ���ļ�
require_once("../ui/inc/init.inc.php");

$op = $_REQUEST['op'];
switch ($op)
{
	case "upticket";
		$ticketID=$_REQUEST['ticketID'];
		$CticketID=$_REQUEST['ticketID'];
		$tickettype=$_REQUEST['tickettype'];
		$userID=$_REQUEST['userID'];
		$length=strlen($ticketID);
	//	$ticketID=$ticketID+1;
		$ticketID=(int)$ticketID;
		$ticketID=$ticketID+1;
		if(strlen($ticketID)<strlen($CticketID)){
			$str='';
			for($i=0;$i<strlen($CticketID)-strlen($ticketID);$i++){
				$str=$str.'0';
			}
			$ticketID=$str.$ticketID;
		}
		$update="Update tms_bd_TicketProvide SET tp_CurrentTicket = '{$ticketID}', 
	  				tp_InceptTicketNum = tp_InceptTicketNum-1 WHERE tp_InceptUserID = '{$userID}' 
	  				AND tp_Type = '{$tickettype}' AND tp_InceptTicketNum > 0 AND tp_CurrentTicket = '{$CticketID}'";
		$result = $class_mysql_default->my_query("$update");
		if(!$result) {
			$retData = array('retVal' => 'FAIL', 'retString' => '���°��쵥Ʊ�ݱ�ʧ�ܣ�', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}else{
			$retData = array('retVal' => 'SUCC', 'retString' => '���°��쵥Ʊ�ݱ�ɹ���', 'sql' => $queryString);
			echo json_encode($retData);
			exit();
		}
		break;
}	
?>