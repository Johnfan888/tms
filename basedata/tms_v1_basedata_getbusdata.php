<?php 
//����ҳ�������֤�Ƿ��¼
define("AUTH", "TRUE");

//�����ʼ���ļ�
require_once("../ui/inc/init.inc.php");

$op = $_REQUEST['op'];
switch ($op)
{
	case "getbus":
		$BusNumber = trim($_GET['BusNumber']);
		if($BusNumber!=""){
			$queryString="SELECT bi_BusNumber,bi_SeatS FROM tms_bd_BusInfo WHERE bi_BusNumber LIKE '%$BusNumber%'";
			$result = $class_mysql_default->my_query("$queryString");
			if(!mysqli_num_rows($result)) {
				$retData = array('retVal' => 'FAIL', 'retString' => '��ѯ��ʻԱ����ʧ�ܣ�'.->my_error(), 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
			else{
			while ($row = mysqli_fetch_array($result)) {
				$retData[] = array('retVal' => 'SUCC',
					'BusNumber' => $row['bi_BusNumber'],'Seats' => $row['bi_SeatS']);
			}
			echo json_encode($retData);
			}
		}
		else{
			$retData[] = array(
					'BusNumber' => '','Seats' => '');
			echo json_encode($retData);
		}
		break;
	case "getbus1":
		$BusNumber = trim($_GET['BusNumber']);
		if($BusNumber!=""){
			$queryString="SELECT bi_BusNumber,bi_BusID FROM tms_bd_BusInfo WHERE bi_BusNumber LIKE '%$BusNumber%'";
			$result = $class_mysql_default->my_query("$queryString");
			while ($row = mysqli_fetch_array($result)) {
				$retData[] = array(
					'BusNumber' => $row['bi_BusNumber'],'BusID' => $row['bi_BusID']);
			}
			echo json_encode($retData);
		}else{
			$retData[] = array(
					'BusNumber' => '','BusID' => '');
			echo json_encode($retData);
		}
		break;
	case "getbusdata":
		$BusNumber = trim($_GET['BusNumber']);
		if($BusNumber!=""){
			$queryString="SELECT bi_BusID,bi_BusType,bi_BusUnit,bi_InStationID,bi_InStation,bi_ManagementLine FROM tms_bd_BusInfo WHERE bi_BusNumber='{$BusNumber}'";
			$result = $class_mysql_default->my_query("$queryString");
			if(!$result) {
				$retData = array('retVal' => 'FAIL', 'retString' => '��ѯ��������ʧ�ܣ�', 'sql' => $queryString);
				echo json_encode($retData);
				exit();
			}
			$row = mysqli_fetch_array($result);
			$retData = array(
				'BusID' => $row['bi_BusID'],
				'BusType' => $row['bi_BusType'],
				'BusUnit'=> $row['bi_BusUnit'],
				'InStationID' => $row['bi_InStationID'],
				'InStation'=> $row['bi_InStation'],
				'ManagementLine' =>$row['bi_ManagementLine']);
			echo json_encode($retData);
		}
		break;
	default:
}

?>