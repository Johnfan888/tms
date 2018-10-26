<?php
/* 
 * 缴款收款页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$ba_AccountID = $_POST['ba_AccountID']; 
$ba_BusID = $_POST['ba_BusID'];
$ba_BusNumber = $_POST['ba_BusNumber'];
$ba_BusType = $_POST['ba_BusType'];
$ba_BusUnit = $_POST['ba_BusUnit'];
$ba_BalanceCount = $_POST['ba_BalanceCount'];
$ba_CheckTotal = $_POST['ba_CheckTotal'];
$ba_Income = $_POST['ba_Income'];
$ba_Paid = $_POST['ba_Paid'];
$ba_ServiceFee = $_POST['ba_ServiceFee'];
//$ba_OtherFee1 = $_POST['ba_OtherFee1'];
//$ba_OtherFee2 = $_POST['ba_OtherFee2'];
$ba_OtherFee3 = $_POST['ba_OtherFee3'];
$ba_Money1 = $_POST['ba_Money1'];
//$ba_OtherFee4 = $_POST['ba_OtherFee4'];
//$ba_OtherFee5 = $_POST['ba_OtherFee5'];
//$ba_OtherFee6 = $_POST['ba_OtherFee6'];
$ba_RateNum = $_POST['ba_RateNum'];
//for($j=1;$j<=$ba_RateNum;$j++){
//	$ba_Rate[$j]=$_POST['ba_Rate'.$j];
//}
$ba_DateTime = $_POST['ba_DateTime'];
$ba_UserID = $_POST['ba_UserID'];
$ba_User = $_POST['ba_User'];
$ba_Remark = $_POST['ba_Remark'];

$selectType="SELECT ba_FeeTypeName1,ba_FeeTypeName2,ba_FeeTypeName3,ba_FeeTypeName4,ba_FeeTypeName5,ba_FeeTypeName6,ba_FeeTypeName7,
			ba_FeeTypeName8,ba_FeeTypeName9,ba_FeeTypeName10,ba_FeeTypeName11,ba_FeeTypeName12,ba_FeeTypeName13,ba_FeeTypeName14,
			ba_FeeTypeName15 FROM tms_acct_BusAccount where ba_AccountID='{$ba_AccountID}'";
$queryType=$class_mysql_default->my_query("$selectType");
$rowType=mysqli_fetch_array($queryType);
for($z=1;$z<=15;$z++){
	if($rowType['ba_FeeTypeName'.$z]=='')
	break;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>结账单明细</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../ui/images/style_main.css" type="text/css" rel="stylesheet" />
		<link href="../css/tms.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<form action="" method="post" name="form1">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td bgcolor="#f0f8ff" width="90%"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 结 账 单 明 细</span></td>
				<td bgcolor="#f0f8ff">
					&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="返回" onclick="javascript:history.back();" />
				</td>					
			</tr>
		</table>
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
  			<tr>
    			<td colspan="8" bgcolor="#d4d1d1" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 车 辆 信 息</td>
  			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆编号：</span></td>
				<td bgcolor="#FFFFFF" nowrap="nowrap"><input type="text" name="ba_BusID" value="<?php echo $ba_BusID;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
				<td bgcolor="#FFFFFF" nowrap="nowrap"><input type="text" name="ba_BusNumber" value="<?php echo $ba_BusNumber;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型：</span></td>
				<td bgcolor="#FFFFFF" nowrap="nowrap"><input type="text" name="ba_BusType" value="<?php echo $ba_BusType;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车属单位：</span></td>
				<td bgcolor="#FFFFFF" nowrap="nowrap"><input type="text" name="ba_BusUnit" value="<?php echo $ba_BusUnit;?>" readonly="readonly" /></td>
			</tr>
  			<tr>
    			<td colspan="8" bgcolor="#d4d1d1" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 结 算 信 息</td>
  			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结账单号：</span></td>
				<td bgcolor="#FFFFFF" nowrap="nowrap"><input type="text" name="ba_AccountID" value="<?php echo $ba_AccountID;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 营收金额：</span></td>
				<td bgcolor="#FFFFFF" nowrap="nowrap"><input type="text" name="ba_Income" value="<?php echo $ba_Income;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结算金额：</span></td>
				<td bgcolor="#FFFFFF" nowrap="nowrap"><input type="text" name="ba_Paid" value="<?php echo $ba_Paid;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结算单数量：</span></td>
				<td bgcolor="#FFFFFF" nowrap="nowrap"><input type="text" name="ba_BalanceCount" value="<?php echo $ba_BalanceCount;?>" readonly="readonly" /></td>
			</tr>
			<tr>	
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 行包金额：</span></td>
				<td bgcolor="#FFFFFF" nowrap="nowrap"><input type="text" name="ba_Money1" value="<?php echo $ba_Money1;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 人数：</span></td>
				<td bgcolor="#FFFFFF" nowrap="nowrap"><input type="text" name="ba_CheckTotal" value="<?php echo $ba_CheckTotal;?>" readonly="readonly" /></td>
<!--				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结算员ID：</span></td>-->
<!--				<td bgcolor="#FFFFFF"><input type="text" name="ba_UserID" value="<?php echo $ba_UserID;?>" readonly="readonly" /></td>-->
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结算员：</span></td>
				<td bgcolor="#FFFFFF" nowrap="nowrap"><input type="text" name="ba_User" value="<?php echo $ba_User;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结算时间：</span></td>
				<td bgcolor="#FFFFFF" nowrap="nowrap"><input type="text" name="ba_DateTime" value="<?php echo $ba_DateTime;?>" readonly="readonly" /></td>
			</tr>
  			<tr>
    			<td colspan="8" bgcolor="#d4d1d1"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 扣 除 信 息</td>
  			</tr>
			<tr>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 站务费：</span></td>
				<td bgcolor="#FFFFFF" nowrap="nowrap"><input type="text" name="ba_ServiceFee" value="<?php echo $ba_ServiceFee;?>" readonly="readonly" /></td>
				<td style="DISPLAY: none" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 微机费：</span></td>
				<td style="DISPLAY: none" bgcolor="#FFFFFF"><input type="text" name="ba_OtherFee1" value="<?php echo $ba_OtherFee1;?>" readonly="readonly" /></td>
				<td style="DISPLAY: none" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发班费：</span></td>
				<td style="DISPLAY: none" bgcolor="#FFFFFF"><input type="text" name="ba_OtherFee2" value="<?php echo $ba_OtherFee2;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 劳务费：</span></td>
				<td bgcolor="#FFFFFF" colspan="5" nowrap="nowrap"><input type="text" name="ba_OtherFee3" value="<?php echo $ba_OtherFee3;?>" readonly="readonly" /></td>
			</tr>
			<tr style="DISPLAY: none">
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 费用4：</span></td>
				<td bgcolor="#FFFFFF" nowrap="nowrap"><input type="text" name="ba_OtherFee4" value="<?php echo $ba_OtherFee4;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 费用5：</span></td>
				<td bgcolor="#FFFFFF" nowrap="nowrap"><input type="text" name="ba_OtherFee5" value="<?php echo $ba_OtherFee5;?>" readonly="readonly" /></td>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 费用6：</span></td>
				<td bgcolor="#FFFFFF" nowrap="nowrap"><input type="text" name="ba_OtherFee6" value="<?php echo $ba_OtherFee6;?>" readonly="readonly" /></td>
			</tr>
			<tr>
    			<td colspan="8" bgcolor="#d4d1d1"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 按 月 扣 除 信 息</td>
  			</tr>
				<?php
					$allfee=0;
					$i=0;
					$selectFeeType="SELECT ba_Rate1,ba_Rate2,ba_Rate3,ba_Rate4,ba_Rate5,ba_Rate6,ba_Rate7,ba_Rate8,ba_Rate9,ba_Rate10,ba_Rate11,
							ba_Rate12,ba_Rate13,ba_Rate14,ba_Rate15,ba_FeeTypeName1,ba_FeeTypeName2,ba_FeeTypeName3,ba_FeeTypeName4,ba_FeeTypeName5,
							ba_FeeTypeName6,ba_FeeTypeName7,ba_FeeTypeName8,ba_FeeTypeName9,ba_FeeTypeName10,ba_FeeTypeName11,ba_FeeTypeName12,
							ba_FeeTypeName13,ba_FeeTypeName14,ba_FeeTypeName15 FROM tms_acct_BusAccount where ba_AccountID='{$ba_AccountID}'";
					$queryFeeType=$class_mysql_default->my_query("$selectFeeType");
					$rowFeeType=mysqli_fetch_array($queryFeeType);
					while($i+1<$z){
						$n=$i+1;
						if($i%4==0){
							$j=$i+1;
				?>
				<tr>
				<?php 
						} 
				?>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /><?php echo $rowFeeType['ba_FeeTypeName'.$n];?>：</span></td>
				<td nowrap="nowrap"><input type="text" name="Rate<?php echo $i+1;?>" id="Rate<?php echo $i+1;?>" value="<?php echo $rowFeeType['ba_Rate'.$n];?>" readonly="readonly" /></td>
				<?php
					$allfee=$allfee+$Ratefee[$i];
					$j=$j+1;
					if(($j-$i)==4){
				?>
				</tr>
				<?php 
						} 
					$i=$i+1;
					}
				?>
			<tr>
				<td align="left" bgcolor="#FFFFFF" nowrap="nowrap"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 备注：</span></td>
				<td colspan='7' bgcolor="#FFFFFF" nowrap="nowrap"><input style="width:50%" type="text" name="ba_Remark" value="<?php echo $ba_Remark;?>" readonly="readonly" /></td>
			</tr>
 		</table> 	  
 		<p></p>		
<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
		<tr>
			<td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;"> 结 算 单 信 息</span></td>
		</tr>
</table>
<div id="tableContainer" class="tableContainer" style="height:150px;">
<table class="main_tableboder" id="table1" > 
<thead class="fixedHeader">		
			<tr>
				<th nowrap="nowrap" align="center" bgcolor="#006699">结算单号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车辆编号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车牌号</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车型</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车属单位</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开单员ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开单员</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车站ID</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">车站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">开单时间</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">班次</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">线路名</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">发车日期</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">始发站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">终点站</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">人数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">张数</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">营收金额</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">站务费</th>
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">微机费</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">发班费</th>-->
				<th nowrap="nowrap" align="center" bgcolor="#006699">劳务费</th>
				<th nowrap="nowrap" align="center" bgcolor="#006699">行包托运费</th>
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">费用4</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">费用5</th>-->
<!--				<th nowrap="nowrap" align="center" bgcolor="#006699">费用6</th>-->
				<th nowrap="nowrap" align="center" bgcolor="#006699">结账单号</th>
			</tr>
			</thead>
		<tbody class="scrollContent">
		<?php
			$queryString = "SELECT bh_BalanceNO, bh_BusID,bh_BusNumber,bh_BusModelID,bh_BusUnit,bh_UserID,bh_User,bh_StationID,bh_Station,bh_Date,bh_NoOfRunsID,bh_LineID,
							bh_NoOfRunsdate,bh_BeginStation,bh_EndStation,bh_CheckTotal,bh_TicketTotal,bh_PriceTotal,bh_ServiceFee,bh_otherFee3,bh_AccountID,nri_LineName,bh_ConsignMoney
							FROM tms_acct_BalanceInHand LEFT OUTER JOIN tms_bd_NoRunsInfo ON bh_NoOfRunsID=nri_NoOfRunsID WHERE (bh_IsAccount = 1) AND (bh_AccountID = '{$ba_AccountID}')";
			$result = $class_mysql_default->my_query("$queryString");
			while ($row = mysqli_fetch_array($result)) {
		?>
			<tr bgcolor="#CCCCCC">
				<td nowrap="nowrap"><?php echo $row['bh_BalanceNO'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_BusID'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_BusNumber'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_BusModelID'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_BusUnit'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_UserID'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_User'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_StationID'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_Station'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_Date'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_NoOfRunsID'];?></td>
				<td nowrap="nowrap"><?php echo $row['nri_LineName'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_NoOfRunsdate'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_BeginStation'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_EndStation'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_CheckTotal'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_TicketTotal'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_PriceTotal'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_ServiceFee'];?></td><!--
				<td nowrap="nowrap"><?php echo $row['bh_otherFee1'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_otherFee2'];?></td>
				--><td nowrap="nowrap"><?php echo ($row['bh_PriceTotal'] - $row['bh_ServiceFee']) * $row['bh_otherFee3'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_ConsignMoney'];?></td><!--
				<td nowrap="nowrap"><?php echo $row['bh_otherFee4'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_otherFee5'];?></td>
				<td nowrap="nowrap"><?php echo $row['bh_otherFee6'];?></td>
				--><td nowrap="nowrap"><?php echo $row['bh_AccountID'];?></td>
			</tr>
		<?php
			}
		?>
			</tbody>
		</table>
		</div>
<!--		<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">-->
<!--			<tr>-->
<!--				<td align="center" bgcolor="#FFFFFF">-->
<!--					<input type="button" value="返回" onclick="javascript:history.back();" />-->
<!--				</td>-->
<!--			</tr>-->
<!--		</table>-->		
		</form>
	</body>
</html>
