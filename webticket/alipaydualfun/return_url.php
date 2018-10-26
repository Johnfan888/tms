<?php
/* * 
 * 功能：支付宝页面跳转同步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyReturn
 */

define("WEBAUTH", "TRUE");

//载入初始化文件
require_once("../../ui/inc/init.inc.php");

require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码
	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

	//商户订单号	
	$out_trade_no = $_GET['out_trade_no'];

	//支付宝交易号	
	$trade_no = $_GET['trade_no'];

	//交易状态
	$trade_status = $_GET['trade_status'];


    if($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
    }
	else if($_GET['trade_status'] == 'TRADE_FINISHED') {
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
    	$queryString = "SELECT wst_WebSellID,wst_TicketState,wst_BeginStationTime,wst_NoOfRunsdate,wst_FromStation,wst_ReachStation,
    			wst_TotalMan,wst_SellPrice,wst_FullNumber,wst_HalfNumber,wst_NoOfRunsID,wst_SeatID,wst_CertificateNumber 
    			FROM tms_websell_WebSellTicket WHERE wst_WebSellID = '$out_trade_no'";
    	$result = $class_mysql_default->my_query("$queryString");
		if(mysqli_num_rows($result) == 1) {
			$rows = mysqli_fetch_array($result);
			if($rows['wst_TicketState'] == '1') {
				echo "<script>alert('此订单已在窗口完成支付！');location.assign('../tms_v1_websell_websearchreserve.php');</script>";
			}
			elseif($rows['wst_TicketState'] == '2') {
				echo "<script>alert('此订单已完成网上支付！');location.assign('../tms_v1_websell_websearchreserve.php');</script>";
			}
			else {
				$seatnum = $rows['wst_FullNumber'] + $rows['wst_HalfNumber'];
				$seatnos = $rows['wst_SeatID'];			
				
				$class_mysql_default->my_query("BEGIN");
		
				$queryString = "UPDATE tms_websell_WebSellTicket SET wst_PayTradeNo = '$trade_no', wst_TicketState = '2' WHERE wst_WebSellID='{$out_trade_no}'";
			   	$result = $class_mysql_default->my_query("$queryString");
				if(!$result) {
					$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('更新售票数据失败！');location.assign('../tms_v1_websell_websearchreserve.php');</script>";
				}
				
				//锁定票版数据
			  	$queryString = "SELECT tml_SeatStatus,tml_NoOfRunsID,tml_NoOfRunsdate FROM tms_bd_TicketMode 
			  			WHERE tml_NoOfRunsID = '{$rows['wst_NoOfRunsID']}' AND tml_NoOfRunsdate = '{$rows['wst_NoOfRunsdate']}' FOR UPDATE";
			  	$result = $class_mysql_default->my_query("$queryString");
				if(!$result) {
					$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('锁定票版数据失败！');location.assign('../tms_v1_websell_websearchreserve.php');</script>";
				}
				$rows = mysqli_fetch_array($result);
				$seatStatus = $rows['tml_SeatStatus'];
	  			$seatArray = explode(",", trim($seatnos));
				
				//更新座位状态
				for($i = 0; $i < $seatnum; $i++){
					$SeatID = $seatArray[$i];
					$seatStatus = substr_replace($seatStatus, '6', $SeatID - 1, 1);
				}
				
				//更新票版数据
	  			$queryString = "UPDATE tms_bd_TicketMode SET tml_SeatStatus = '$seatStatus' WHERE (tml_NoOfRunsID = '{$rows['tml_NoOfRunsID']}') 
	  					AND (tml_NoOfRunsdate = '{$rows['tml_NoOfRunsdate']}')";	  	
	  			$result = $class_mysql_default->my_query("$queryString");
				if(!$result) {
					$class_mysql_default->my_query("ROLLBACK");
					echo "<script>alert('更新票版数据表失败！');location.assign('../tms_v1_websell_websearchreserve.php');</script>";
				}		

				$class_mysql_default->my_query("COMMIT");
				echo "<script>alert('网上支付成功！');location.assign('../tms_v1_websell_websearchreserve.php');</script>";
			}
		}
		else {
			echo "<script>alert('返回支付订单不存在！');location.assign('../tms_v1_websell_websearchreserve.php');</script>";
		}
    }
    else {
      echo "trade_status=".$trade_status;
    }
		
	echo "验证成功<br />";
		
	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的verifyReturn函数
    echo "验证失败";
}
?>
        <title>支付宝标准双接口</title>
	</head>
    <body>
   </body>
</html>