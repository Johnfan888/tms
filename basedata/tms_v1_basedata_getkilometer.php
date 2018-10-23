<?php

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$op = $_REQUEST['op'];
switch ($op)
{
	case "getkilometer":
		 $SectionID=$_REQUEST['SectionID'];
		 $SectionID1=$SectionID+1;
		 $Kilometer=$_REQUEST['Kilometer'];
		 $LineID=$_REQUEST['LineID'];
		 $sql="select si_Kilometer from tms_bd_SectionInfo where si_SectionID='$SectionID' and si_LineID='$LineID';";
		 $query= $class_mysql_default->my_query($sql);
			if(!$query){
				$retData = array('retVal' => 'FAIL', 'retString' => '查询里程数据失败！');
				echo json_encode($retData);
				exit();
			}
			else{
				$row=mysql_fetch_array($query);
				$kilometer1=$row['si_Kilometer'];
				$sql1="select si_Kilometer from tms_bd_SectionInfo where si_SectionID='$SectionID1' and si_LineID='$LineID'";
				$query1= $class_mysql_default->my_query($sql1);
				$row1=mysql_fetch_array($query1);
				$maxkilometer=$row1['si_Kilometer'];
			//	$retData = array('retVal' => 'FAIL', 'retString' => '查询里程数据失败！'.$Kilometer.','.$kilometer1.','.$maxkilometer.','.$sql);
			//	echo json_encode($retData);
				//exit();
				if($Kilometer >= $maxkilometer || $Kilometer <= $kilometer1 ){
				   $retData = array('retVal' => 'FAIL', 'retString' => '所填里程数据有误，所填数据须介于'.$kilometer1.'公里与'.$maxkilometer.'公里之间');
						echo json_encode($retData);
						exit(); 
									}
				else{
				    $retData = array('retVal' => 'SUCC');
					echo json_encode($retData);
					}
			}
				break;
				
				
		 case "mod":
		 $preID=$_REQUEST['SectionID'];
		 $nextID=$preID+1;
		 $lastID=$preID-1;
		 $Kilometer=$_REQUEST['Kilometer'];
		 $Line=$_REQUEST['LineID'];
		 $sel="select si_Kilometer from tms_bd_SectionInfo where si_SectionID='$lastID' and si_LineID='$Line'";
		 $zxc= $class_mysql_default->my_query($sel);
			if(!$zxc){
				$retData = array('retVal' => 'FAIL', 'retString' => '查询里程数据失败！');
				echo json_encode($retData);
				exit();
			}
		$rows=mysql_fetch_array($zxc);
		$minkilometer=$rows['si_Kilometer'];
		$sql2="select si_Kilometer from tms_bd_SectionInfo where si_SectionID='$nextID' and si_LineID='$Line'";
		$query2= $class_mysql_default->my_query($sql2);
		if(!$query2){
				$retData = array('retVal' => 'FAIL', 'retString' => '查询里程数据失败！');
				echo json_encode($retData);
				exit();
			}
		$row2=mysql_fetch_array($query2);
		$maxkilometer=$row2['si_Kilometer'];
		if($Kilometer >= $maxkilometer || $Kilometer <= $minkilometer ){
		   $retData = array('retVal' => 'FAIL', 'retString' => '所填里程数据有误，所填数据须介于'.$minkilometer.'公里与'.$maxkilometer.'公里之间');
				echo json_encode($retData);
				exit(); 
							}
		else{
		    $retData = array('retVal' => 'SUCC');
			echo json_encode($retData);
			}
	
		 
				break;
}
?>