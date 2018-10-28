<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$BusID=$_POST['BusID'];
	$BusI=$_POST['BusI'];
	$RegDate=$_POST['RegDate'];
	$BusNumber=$_POST['BusNumber'];
	$BusTypeID=$_POST['BusTypeID'];
	$BusType=$_POST['BusType'];
	$SeatS=$_POST['SeatS'];
	$AddSeatS=$_POST['AddSeatS'];
	$AllowHalfSeats=$_POST['AllowHalfSeats'];
	$Tonnage=$_POST['Tonnage'];
	$BusUnit=$_POST['BusUnit'];
	$Sign=$_POST['Sign'];
	$EngineType=$_POST['EngineType'];
	$EngineNumber=$_POST['EngineNumber'];
	$BusIdentify=$_POST['BusIdentify'];
	$BusChangeType=$_POST['BusChangeType'];
	$InStationID=$_POST['InStationID'];
	$InStation=$_POST['InStation'];
	$OwnerName=$_POST['OwnerName'];
	$OwnerAdd=$_POST['OwnerAdd'];
	$OwnerTel=$_POST['OwnerTel'];
	$OwnerIdCard=$_POST['OwnerIdCard'];
	$DriverID=$_POST['DriverID'];
	$Driver=$_POST['Driver'];
	$Driver1ID=$_POST['Driver1ID'];
	$Driver1=$_POST['Driver1'];
	$Driver2ID=$_POST['Driver2ID'];
	$Driver2=$_POST['Driver2'];
	$InsuranceNo=$_POST['InsuranceNo'];
	$InsuranceCompany=$_POST['InsuranceCompany'];
	$InsuranceDate=$_POST['InsuranceDate'];
	$TransportationBeginDate=$_POST['TransportationBeginDate'];
	$TransportationEndDate=$_POST['TransportationEndDate'];
	$TradeBeginDate=$_POST['TradeBeginDate'];
	$TradeEndDate=$_POST['TradeEndDate'];
	$RenBeginDate=$_POST['RenBeginDate'];
	$RenEndDate=$_POST['RenEndDate'];
	$ManagementLine=$_POST['ManagementLine'];
	$LineLicense=$_POST['LineLicense'];
	$LineLicenseAttached=$_POST['LineLicenseAttached'];
	$AttachedEndDate=$_POST['AttachedEndDate'];
	$RoadTransport=$_POST['RoadTransport'];
	$RoadTransportEndDate=$_POST['RoadTransportEndDate'];
	$VehicleDriving=$_POST['VehicleDriving'];
	$VehicleDrivingEndDate=$_POST['VehicleDrivingEndDate'];
	$Business=$_POST['Business'];
	$SpringCheckEndDate=$_POST['SpringCheckEndDate'];
	$ExaminationEndDate=$_POST['ExaminationEndDate'];
	$TwoEndDate=$_POST['TwoEndDate'];
	$RankEndDate=$_POST['RankEndDate'];
	$TravelEndDatete=$_POST['TravelEndDatete'];
	$MonthEndDate=$_POST['MonthEndDate'];
	$CNGEndDate=$_POST['CNGEndDate'];
	$Remark=$_POST['Remark'];
	$CurTime=date('Y-m-d H:i:s');
	if($_FILES['scanfile']['name'] != '') {
		if($_FILES['scanfile']['error'] > 0) {
			switch($_FILES['scanfile']['error']) {
				case 1:
					echo "<script>alert('文件大小超过了配置文件中的限制！');history.back();</script>";
					break;
				case 2:
					echo "<script>alert('文件大小超过了浏览器限制！');history.back();</script>";
					break;
				case 3:
					echo "<script>alert('文件部分被上传！');history.back();</script>";
					break;
				case 4:
					echo "<script>alert('没有找到要上传的文件！');history.back();</script>";
					break;
				case 5:
					echo "<script>alert('服务器临时文件夹丢失，请重新上传！');history.back();</script>";
					break;
				case 6:
					echo "<script>alert('文件写入到临时文件夹出错！');history.back();</script>";
					break;
			}
		} else {
			if($_FILES['scanfile']['size'] < 2048000) {
				$fileName = $_FILES['scanfile']['name'];
				$extName = pathinfo($fileName, PATHINFO_EXTENSION);
				$saveFilePath = "scanFiles/busfile" . $BusID . ".$extName";
				move_uploaded_file($_FILES['scanfile']['tmp_name'], $saveFilePath);
			} else {
				echo "<script>alert('请上传小于2MB的附件');history.back();</script>";
			}
		}
	}
	
	$select="select * from tms_bd_BusInfo where bi_BusID='{$BusID}'";
	$sele= $class_mysql_default->my_query($select);
	if(!mysqli_fetch_array($sele) || $BusID==$BusI){
		$class_mysql_default->my_query("START TRANSACTION");
		$update1="UPDATE tms_bd_BusInfo SET bi_BusID='{$BusID}', bi_BusNumber='{$BusNumber}',bi_BusUnit='{$BusUnit}',bi_SeatS='{$SeatS}',
			bi_AddSeatS='{$AddSeatS}',bi_AllowHalfSeats='{$AllowHalfSeats}',bi_DriverID='{$DriverID}',bi_Driver='{$Driver}',bi_Driver1ID='{$Driver1ID}',bi_Driver1='{$Driver1}',
			bi_Driver2ID='{$Driver2ID}',bi_Driver2='{$Driver2}',bi_RegDate='{$RegDate}',bi_Tonnage='{$Tonnage}',bi_OwnerName='{$OwnerName}',
			bi_OwnerAdd='{$OwnerAdd}',bi_OwnerTel='{$OwnerTel}',bi_OwnerIdCard='{$OwnerIdCard}',bi_BusTypeID='{$BusTypeID}',bi_BusType='{$BusType}',
			bi_EngineType='{$EngineType}',bi_EngineNumber='{$EngineNumber}',bi_BusIdentify='{$BusIdentify}',bi_BusChangeType='{$BusChangeType}',
			bi_Remark='{$Remark}',bi_InsuranceNo='{$InsuranceNo}',bi_InsuranceCompany='{$InsuranceCompany}',bi_InsuranceDate='{$InsuranceDate}',
			bi_TransportationBeginDate='{$TransportationBeginDate}',bi_TransportationEndDate='{$TransportationEndDate}',bi_TradeBeginDate='{$TradeBeginDate}',
			bi_TradeEndDate='{$TradeEndDate}',bi_RenBeginDate='{$RenBeginDate}',bi_RenEndDate='{$RenEndDate}',bi_ManagementLine='{$ManagementLine}',
			bi_LineLicense='{$LineLicense}',bi_LineLicenseAttached='{$LineLicenseAttached}',bi_AttachedEndDate='{$AttachedEndDate}',bi_RoadTransport='{$RoadTransport}',
			bi_RoadTransportEndDate='{$RoadTransportEndDate}',bi_VehicleDriving='{$VehicleDriving}',bi_VehicleDrivingEndDate='{$VehicleDrivingEndDate}',bi_Business='{$Business}',
			bi_SpringCheckEndDate='{$SpringCheckEndDate}',bi_ExaminationEndDate='{$ExaminationEndDate}',bi_TwoEndDate='{$TwoEndDate}',
			bi_RankEndDate='{$RankEndDate}',bi_TravelEndDate='{$TravelEndDatete}',bi_MonthEndDate='{$MonthEndDate}',bi_CNGEndDate='{$CNGEndDate}',
			bi_Sign='{$Sign}',bi_InStationID='{$InStationID}',bi_InStation='{$InStation}',bi_ModerID='{$userID}',bi_Moder='{$userName}',bi_ModTime='{$CurTime}',
			bi_fileName='{$fileName}',bi_ScanPath='{$saveFilePath}' WHERE bi_BusID='{$BusI}'";	
		$query1 =$class_mysql_default->my_query($update1);
		if (!$query1) echo "SQL错误：".$class_mysql_default->my_error();
		$update2="UPDATE tms_bd_BusCard SET bc_BusID='{$BusID}', bc_BusNumber='{$BusNumber}',bc_StationID='{$InStationID}',bc_Station='{$InStation}' WHERE bc_BusID='{$BusI}'";
		$query2 =$class_mysql_default->my_query($update2);
		if($query1 && $query2){
			$class_mysql_default->my_query("COMMIT");
			echo"<script>alert('恭喜您！修改成功!');window.location.href='tms_v1_basedata_searbus.php'</script>";
		}else{
			$class_mysql_default->my_query("ROLLBACK");
			echo"<script>alert('修改失败');window.location.href='tms_v1_basedata_searbus.php'</script>";
		}
		$class_mysql_default->my_query("END TRANSACTION");
	}else{
			echo"<script>alert('车辆编号已存在，请重新输入！');window.location.href='tms_v1_basedata_modbus.php?clnumber=$BusI'</script>";
		}
?>
