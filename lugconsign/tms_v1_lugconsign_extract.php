<?php
/*
 * 托运提取页面
 */

//定义页面必须验证是否登录
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

if(isset($_POST['sureExtract'])) {
	$lc_TicketNumber = $_POST['lc_TicketNumber'];
	//$lc_ExtractionUserID = $_POST['lc_ExtractionUserID'];
	//$lc_ExtractionUser = $_POST['lc_ExtractionUser'];
	$lc_ExtractionUserID = $userID;
	$lc_ExtractionUser = $userName;
	$lc_Remark = $_POST['lc_Remark'];
	$lc_Status = "已提取";
	$lc_ExtractionTime = date('Y-m-d H:i:s');
	
	$queryString = "UPDATE tms_lug_LuggageCons SET lc_ExtractionUserID='{$lc_ExtractionUserID}', lc_ExtractionUser='{$lc_ExtractionUser}', 
			lc_Status='{$lc_Status}', lc_ExtractionTime='{$lc_ExtractionTime}', lc_Remark='{$lc_Remark}' WHERE lc_TicketNumber='{$lc_TicketNumber}'";
	$result = $class_mysql_default->my_query("$queryString"); 
	if($result) {
		echo "<script>alert('托运货物提取成功!');location.assign('tms_v1_lugconsign_query.php?EXDONE=1');;</script>";
	}
	else {
		echo "<script>alert('托运货物提取失败!请重试。');location.assign('tms_v1_lugconsign_query.php?EXDONE=1');</script>";
	}
}
else {
	if($_POST['lc_TicketNumber'] == "") {
		echo "<script>alert('没有选择要提取的行包！');location.assign('tms_v1_lugconsign_query.php?EXDONE=1');;</script>";
	}
	if($_POST['lc_Status'] == "已提取") {
		echo "<script>alert('该行包已经提取！');location.assign('tms_v1_lugconsign_query.php?EXDONE=1');;</script>";
	}
	$lc_TicketNumber = $_POST['lc_TicketNumber'];
	$lc_Destination = $_POST['lc_Destination'];
	$lc_BusID = $_POST['lc_BusID'];
	$lc_BusNumber = $_POST['lc_BusNumber'];
	$lc_NoOfRunsID = $_POST['lc_NoOfRunsID'];
	$lc_CargoName = $_POST['lc_CargoName'];
	$lc_Numbers=$_POST['lc_Numbers'];
	$lc_Weight=$_POST['lc_Weight'];
	$lc_CargoDescription = $_POST['lc_CargoDescription'];
	$lc_ConsignName = $_POST['lc_ConsignName'];
	$lc_ConsignTel = $_POST['lc_ConsignTel'];
	$lc_ConsignPaperID = $_POST['lc_ConsignPaperID'];
	$lc_ConsignAdd = $_POST['lc_ConsignAdd'];
	$lc_ConsignMoney = $_POST['lc_ConsignMoney'];
	$lc_PackingMoney=$_POST['lc_PackingMoney'];
	$lc_LabelMoney=$_POST['lc_LabelMoney'];
	$lc_HandlingMoney=$_POST['lc_HandlingMoney'];
	$lc_UnloadName = $_POST['lc_UnloadName'];
	$lc_UnloadTel = $_POST['lc_UnloadTel'];
	$lc_UnloadAdd = $_POST['lc_UnloadAdd'];
	$lc_UnloadPaperID = $_POST['lc_UnloadPaperID'];
	$lc_Remark = $_POST['lc_Remark'];
	$lc_DeliveryDate = $_POST['lc_DeliveryDate'];
	$lc_ExtractionUserID = $_POST['lc_ExtractionUserID'];
	$lc_ExtractionUser = $_POST['lc_ExtractionUser'];
	$lc_Station = $_POST['lc_Station'];
	$lc_Isvalueinsure=$_POST['lc_Isvalueinsure'];
	$lc_InsureMoney=$_POST['lc_InsureMoney'];
	$lc_InsureFee=$_POST['lc_InsureFee'];
	$lc_PayStyle=$_POST['lc_PayStyle'];
	$lc_Allmoney=$_POST['lc_Allmoney'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>托运货物提取</title>
		<meta http-equiv="Content-Type" content="text/html; charset=$DefaultLang" />
		<link href="../css/style_main.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript">
		function SureExtract(){
			if(document.getElementById("lc_PayStyle").value=='收货人付款'){
				if(document.getElementById("realticketmoney").value-document.getElementById("getticketmoney").value<0){
					alert('实收款金额不足！')
					document.getElementById("realticketmoney").value=''
					document.getElementById("realticketmoney").focus()
					return false
				}else{
					document.getElementById("reticketmoney").value = document.getElementById("realticketmoney").value - document.getElementById("getticketmoney").value
					document.getElementById("reticketmoney").focus()
					alert("找零后点击确定确认提取！");
				}
			}
		}
			
		</script>
	</head>
	<body>
		<form action="" method="post" name="form1" onsubmit="return confirm('提交后将无法修改！确认提交?');">
		<table width="100%" align="center" class="main_tableborder" border="1" cellpadding="3" cellspacing="1">
			<tr>
				<td colspan="5" bgcolor="#f0f8ff"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 托 运 货 物 提 取 信 息</td>
			</tr>
		</table>
		<table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" class="main_tableborder">
  			<tr>
    			<td colspan="8" bgcolor="#d4d1d1"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 车 辆 信 息</td>
  			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 目的地：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_Destination" value="<?php echo $lc_Destination;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车辆编号：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_BusID" value="<?php echo $lc_BusID;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车牌号：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_BusNumber" value="<?php echo $lc_BusNumber;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 班次：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_NoOfRunsID" value="<?php echo $lc_NoOfRunsID;?>" readonly="readonly" /></td>
			</tr>
  			<tr>
    			<td colspan="8" bgcolor="#d4d1d1"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 发 货 信 息</td>
  			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 货物名称：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_CargoName" value="<?php echo $lc_CargoName;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 货物件数：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_Numbers" value="<?php echo $lc_Numbers;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 货物重量：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_Weight" value="<?php echo $lc_Weight;?>" readonly="readonly" /></td>
				<td  bgcolor="#FFFFFF" colspan='2'></td>
			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 货物描述：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_CargoDescription" value="<?php echo $lc_CargoDescription;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 发货日期：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_DeliveryDate" value="<?php echo $lc_DeliveryDate;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收件车站：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_Station" value="<?php echo $lc_Station;?>" readonly="readonly" /></td>
				<td  bgcolor="#FFFFFF" colspan='2'></td>
			</tr>
 			<tr>
    			<td colspan="8" bgcolor="#d4d1d1"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 托 运 人 信 息</td>
  			</tr>
			<tr>	
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 托运人姓名：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_ConsignName" value="<?php echo $lc_ConsignName;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 托运人电话：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_ConsignTel" value="<?php echo $lc_ConsignTel;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 托运人证件号码：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_UnloadPaperID" value="<?php echo $lc_ConsignPaperID;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 托运人地址：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_ConsignAdd" value="<?php echo $lc_ConsignAdd;?>" readonly="readonly" /></td>
			</tr>
  			<tr>
    			<td colspan="8" bgcolor="#d4d1d1"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 收 货 人 信 息</td>
  			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收货人姓名：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_UnloadName" value="<?php echo $lc_UnloadName;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收货人电话：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_UnloadTel" value="<?php echo $lc_UnloadTel;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收货人证件号码：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_UnloadPaperID" value="<?php echo $lc_UnloadPaperID;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 收货人地址：</span></td>
				<td bgcolor="#FFFFFF"><input type="text" name="lc_UnloadAdd" value="<?php echo $lc_UnloadAdd;?>" readonly="readonly" /></td>
			</tr>
			<tr>
    			<td colspan="8" bgcolor="#d4d1d1"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 保 价 信 息</td>
  			</tr>
  			<tr>
  				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保价金额：</span></td>
				<td  bgcolor="#FFFFFF"><input  type="text" name="lc_InsureMoney" id="lc_InsureMoney" value="<?php echo $lc_InsureMoney;?>" readonly="readonly"/></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 保价费用：</span></td>
				<td  bgcolor="#FFFFFF"><input  type="text" name="lc_InsureFee" id="lc_InsureFee" value="<?php echo $lc_InsureFee;?>" readonly="readonly"/></td>
				<td  bgcolor="#FFFFFF" colspan='4'></td>
			</tr>
			<tr>
    			<td colspan="8" bgcolor="#d4d1d1"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /></span> 收 费 信 息</td>
  			</tr>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 托运费：</span></td>
				<td  bgcolor="#FFFFFF"><input  type="text" name="lc_ConsignMoney" id="lc_ConsignMoney" value="<?php echo $lc_ConsignMoney;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 包装费：</span></td>
				<td  bgcolor="#FFFFFF"><input  type="text" name="lc_PackingMoney" id="lc_PackingMoney" value="<?php echo $lc_PackingMoney;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 标签费：</span></td>
				<td  bgcolor="#FFFFFF"><input  type="text" name="lc_LabelMoney" id="lc_LabelMoney" value="<?php echo $lc_LabelMoney;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 装卸费：</span></td>
				<td  bgcolor="#FFFFFF"><input  type="text" name="lc_HandlingMoney" id="lc_HandlingMoney" value="<?php echo $lc_HandlingMoney;?>" readonly="readonly" />
					 <input type="hidden" name="lc_PayStyle" id="lc_PayStyle" value="<?php echo $lc_PayStyle;?>"/>
				</td>
			</tr>
		<tbody id="Fees" style="DISPLAY: <?php if ($lc_PayStyle!='收货人付款') echo 'none';?>">
			<tr>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 应收款：</span></td>
				<td  bgcolor="#FFFFFF">
						<input type="text" name="getticketmoney1" id="getticketmoney1" value="<?php $lc_Allmoney = $lc_ConsignMoney + $lc_PackingMoney+ $lc_LabelMoney+$lc_HandlingMoney; echo $lc_Allmoney;?>" disabled="disabled"/>
						<input type="hidden" name="getticketmoney" id="getticketmoney" value="<?php $lc_Allmoney = $lc_ConsignMoney + $lc_PackingMoney+ $lc_LabelMoney+$lc_HandlingMoney; echo $lc_Allmoney;?>"/>
				</td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 实收款：</span></td>
				<td  bgcolor="#FFFFFF"><input  type="text" name="realticketmoney" id="realticketmoney" value="" /></td>
				<td align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 找零：</span></td>
				<td  bgcolor="#FFFFFF"><input  type="text" name="reticketmoney" id="reticketmoney" value="" /></td>
				<td  bgcolor="#FFFFFF" colspan='2'></td>
			</tr>
		</tbody>
			<tr>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 托运单号：</span></td>				
				<td bgcolor="#FFFFFF"><input type="text" name="lc_TicketNumber" value="<?php echo $lc_TicketNumber;?>" readonly="readonly" /></td>
				<td nowrap="nowrap" align="left" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 备注：</span></td>
				<td colspan='5'  bgcolor="#FFFFFF"><input style="width:100%" type="text" name="lc_Remark" value="<?php echo $lc_Remark;?>" /></td>
			</tr>
			<tr>
				<td colspan='8' align="center" bgcolor="#FFFFFF">
					<input type="submit" name="sureExtract" value="确认提取" onclick="return SureExtract()"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" value="取消" onclick="location.assign('tms_v1_lugconsign_query.php?EXDONE=1');" />
				</td>
			</tr>
			
		</table>
		<input type="hidden" id="lc_ExtractionUserID" value="<?php echo $lc_ExtractionUserID?>" name="lc_ExtractionUserID" />
		<input type="hidden" id="lc_ExtractionUser" value="<?php echo $lc_ExtractionUser?>" name="lc_ExtractionUser" />
		</form>
	</body>
</html>
