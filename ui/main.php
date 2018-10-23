<?

/** 用户组基本类型：
 * 0: 管理员组
 * 1: 基础数据组
 * 2: 售票组
 * 3: 检票组
 * 4: 调度组
 * 5: 财务组
 * 6: 安检组
 * 7: 行包托运组
 * 8: 查询统计组
 * 9: 包车组
 * A: 客服中心组
 * B: 卫生组
 * C: 稽查组
 * D: 寄存组
 * E: 票据组
 */


//定义页面必须验证是否登录
define("AUTH", "TRUE");

require_once("inc/init.inc.php");

$groupid = $_GET["groupid"];
//if($groupid == "2")	header('Location:../sell/tms_v1_sell_query.php'); //售票窗口不要导航菜单
//else if($groupid == "3") header('Location:../checkin/tms_v1_checkin_checkticket.php'); //检票窗口不要导航菜单
//else if($groupid == "4") header('Location:../schedule/tms_v1_schedule_noofrun.php'); //调度窗口不要导航菜单
//else if($groupid == "6") header('Location:../safecheck/tms_v1_safecheck_VehicleCheck.php'); //安检窗口不要导航菜单
//else if($groupid == "A") header('Location:../sell/tms_v1_service_querynoofruns.php'); //客服窗口不要导航菜单
//if($groupid == "E") header('Location:../basedata/tms_v1_basedata_searticketadd.php'); //票据窗口不要导航菜单
//else {
	//$left = "left" . $groupid;
	$left = "left";
	$conf = "config" . $groupid;
	require_once("user/top.inc.php");
	$strsrcleft="user.php?conf=$conf&left=$left";
	$strsrcintro="user.php?main=intro";
//}
?>
<html>
<head>
<script type="text/javascript" src="../js/jquery.js"></script>
<style type="text/css">
.navPoint {COLOR: blue; CURSOR: hand; FONT-FAMILY: Webdings; FONT-SIZE: 9pt}
.navPoint1 {CURSOR: hand;}
.a2{BACKGROUND-COLOR: A4B6D7;}
.tableContainer{height:expression(document.body.clientHeight-document.getElementById("mytable").offsetTop);}
</style>
	<script>
	function switchSysBar(){
	if (switchPoint.innerText==3){
	switchPoint.innerText=4
	document.all("frmTitle").style.display="none"
	}else{
	switchPoint.innerText=3
	document.all("frmTitle").style.display=""
	}}

	// 使用方法
	//<iframe src="" scrolling="no" frameborder="0" height="100%" id="main" width="100%" onload='IFrameReSize("main");IFrameReSizeWidth("main");'></iframe>
	//iframe高度自适应
	function IFrameReSize(main) {
		var pTar = document.getElementById(main);
		if (pTar) {  //ff
			if (pTar.contentDocument && pTar.contentDocument.body.offsetHeight) {
				pTar.height = pTar.contentDocument.body.offsetHeight;
			} //ie
			else if (pTar.Document && pTar.Document.body.scrollHeight) {
				pTar.height = pTar.Document.body.scrollHeight;
			}
		}
	}
	//iframe宽度自适应
	function IFrameReSizeWidth(main) {
		var pTar = document.getElementById(main);
		if (pTar) {  //ff
			if (pTar.contentDocument && pTar.contentDocument.body.offsetWidth) {
				pTar.width = pTar.contentDocument.body.offsetWidth;
			}  //ie
			else if (pTar.Document && pTar.Document.body.scrollWidth) {
				pTar.width = pTar.Document.body.scrollWidth;
			}
		}
	}
	</script>
	
<script type="text/javascript" src="../js/tms_v1_close.js"></script>
</head>
<body style="overflow:hidden;">
<table class="tableContainer" width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;margin:0; padding:0" id="mytable">
    <tr style="width:100% height:100%">
        <td width="140" valign="top" id="frmTitle">
            <iframe id="carnoc" name="carnoc" width="200px" height="100%" style="VISIBILITY: inherit;" frameborder="1" scrolling="auto" src='<?=$strsrcleft?>'></iframe>
        </td>
        <td width="30" bgcolor="#ffffff" style="WIDTH: 5pt">
　　<table width="5" height="100%" border="0" cellpadding="0" cellspacing="0" >
　　　<tr>
　　　　<td style="HEIGHT: 100%" onClick="switchSysBar()" class="navPoint1" title="关闭/打开菜单栏" >
　　　　　　<font style="FONT-SIZE: 9pt; CURSOR: default; COLOR: #708EC7">
　　　　　　<span class="navPoint" id="switchPoint" title="关闭/打开菜单栏">3</span></font></td>
　　　</tr>
　　</table>
		</td>
		<td valign="top">
			<iframe id="main" name="main" width="100%" height="100%" frameborder="1" src="<?=$strsrcintro?>" style="padding-right:0px;"></iframe>
        </td>
    </tr>
</table>
</body>
</html>