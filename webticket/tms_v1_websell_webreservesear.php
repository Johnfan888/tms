<?
//网上预定成功查询界面
//define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");
$UserRegisterName=$_GET['UserRegisterName'];
$WebSellID=$_GET['WebSellID'];
$select="SELECT wst_WebSellID,wst_UserName,wst_CertificateType,wst_CertificateNumber,wst_FullNumber,wst_HalfNumber,
	wst_SellPrice,wst_SeatID,wst_NoOfRunsdate,wst_NoOfRunsID,wst_FromStation,wst_ReachStation,wst_SellPrice,wst_BeginStationTime,
	wst_StopStationTime FROM tms_websell_WebSellTicket WHERE wst_WebSellID='{$WebSellID}'";
$result=$class_mysql_default ->my_query("$select");
$rows=@mysqli_fetch_array($result);


//获取查询初始化界面参数
?>
<script type="text/javascript">
<!--
function websell(){
	window.location.href='tms_v1_websell_websell.php?UserRegisterName='+document.getElementById("UserRegisterName").value;
}
//-->
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#4C4C4C"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">网 上 预 定  成 功 浏 览</span></td>
  </tr>
</table>
<table width="100%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
	<tr><td>班次信息</td></tr>
  	<tr>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $rows['wst_NoOfRunsdate'];?></span></td>
   		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $rows['wst_NoOfRunsID'];?></span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $rows['wst_FromStation'].'('.$rows['wst_BeginStationTime'].')';?></span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $rows['wst_ReachStation'].'('.$rows['wst_StopStationTime'].')';?></span></td>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">全价 ：<?php echo $rows['wst_SellPrice'].'元';?></span></td>
 	 </tr>
</table>
<form  method="post" name="aaa" action="tms_v1_websell_webreserveok.php">
<table width="100%" align="center" class="main_tableboder" border="0" cellpadding="3" cellspacing="1">
	<tr><td>订票信息</td></tr>
  	<tr>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">订单号</span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">姓名</span></td>
   		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">证件类型</span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">证件号码</span></td>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">全票数</span></td>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">半票数</span></td>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">价格</span></td>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">座位号</span></td>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title">操作</span></td>
 	 </tr>
 	 <tr>
 	 	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $rows['wst_WebSellID'];?></span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $rows['wst_UserName'];?></span></td>
   		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $rows['wst_CertificateType'];?></span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $rows['wst_CertificateNumber'];?></span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $rows['wst_FullNumber'];?></span></td>
    	<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $rows['wst_HalfNumber'];?></span></td>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $rows['wst_SellPrice'];?> 元</span></td>
  		<td width="10%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><?php echo $rows['wst_SeatID'];?></span></td>
  		<td  nowrap="nowrap"  bgcolor="#FFFFFF" align="center">[<a href="tms_v1_websell_delwebreserve.php?UserRegisterName=<?=$UserRegisterName?>&WebSellID=<?=$rows['wst_WebSellID']?>"]>取消预定</a>]</td>	
 	 </tr>
 	 <tr>
 	 	<td align="center" colspan="9" bgcolor="#FFFFFF"><input name="button" type="button" value="确定" onclick="return websell()">
    		<input type="hidden" name="UserRegisterName" id="UserRegisterName" value="<?php echo $UserRegisterName;?>"/>
    	</td>
 	 </tr>
</table>
</form>
