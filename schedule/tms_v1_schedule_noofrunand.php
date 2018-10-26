<?
//定义页面必须验证是否登录	
define("AUTH", "TRUE");

//载入初始化文件
require_once("../ui/inc/init.inc.php");

$nowdate=date("Y-m-d");
//$nowdate='2013-09-05';
$noofrunsID=$_GET['on'];
$oldtime=$_GET['op'];
if(!empty($_POST['submitm']))
{
    $andnoofrunsID=$_POST['andnoofrusnID'];
    //echo $andnoofrunsID;
    if($noofrunsID!=$andnoofrunsID)
    {
        // $strsqlselet="call AND_noofruns($$noofrunsID,$andnoofrunsID);";
        $strsqlselet="UPDATE tms_bd_TicketMode SET tml_StopRun='0' WHERE tml_NoOfRunsID= '$andnoofrunsID' AND tml_NoOfRunsdate='$nowdate';";
        //echo $strsqlselet;
        $resultselet = $class_mysql_default ->my_query("$strsqlselet");
    }
    echo "<script>location.href='tms_v1_schedule_noofrun.php?op=&on=&oo=an';</script>"; 
}
?>
<script type="text/javascript">
var xmlHttp;

function startRequest(m)
{
    
    var str=document.getElementById(m).value;
    //alert(str);
    xmlHttp=GetXmlHttpObject();
    if (xmlHttp==null){
       alert ("浏览器不支持 HTTP 请求！");
       return;
    }
    var url="tms_v1_schedule_getandnoofrun.php";
    url=url+"?q="+str;
    url=url+"&sid="+Math.random();
    //alert("tms_v1_schedule_getandnoofrun.php?q="+str);
    xmlHttp.open("GET", url, true); 
    xmlHttp.send(null);
    xmlHttp.onreadystatechange=function stateChanged() { 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 
 		var result = xmlHttp.responseText;
                //alert(result);
                var json = eval("("+result+")");
                //alert(json.noofrunsdate);
                document.getElementById("sendanddate").value=json.noofrunsdate;
                document.getElementById("sendandtime").value=json.noofrunstime;
                document.getElementById("sendandend").value=json.endstation;
                document.getElementById("andbustype").value=json.busmodel;
                document.getElementById("sendandseat").value=json.totalseats;
 	} 
   }
}

function GetXmlHttpObject(){
    var xmlHttp=null;
    try{
          // Firefox, Opera 8.0+, Safari
 	  xmlHttp=new XMLHttpRequest();
 	}
    catch (e){
 	  //Internet Explorer
 	  try{
  	       xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
 	     }
 	   catch (e){
  	       xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  	   }
     }
     return xmlHttp;
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">合并班次</span></td>
  </tr>
</table>
<?
$strsqlselet = "SELECT `tml_NoOfRunsdate`,`tml_NoOfRunsID`,`tml_NoOfRunstime`,`tml_Endstation`,`tml_BusModel`,`tml_TotalSeats`,`tml_SeatStatus`  FROM `tms_bd_TicketMode` WHERE `tml_NoOfRunsID`='$noofrunsID';";
$resultselet = $class_mysql_default ->my_query("$strsqlselet");
$rowsA = @mysqli_fetch_array($resultselet);
?>
<form id="addpro" name="addpro" method="post" action="">
<table id="addpro" width="100%" border="1" align="center" cellpadding="1" cellspacing="1">

    <tr>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 班次:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="noofrunsID" id="noofrunsID" value="<?=$rowsA[1]?>" /></td>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 合并班次:</span></td>      
        <td width="10%" bgcolor="#FFFFFF"><select name="andnoofrusnID" id="andnoofrusnID" onchange="startRequest('andnoofrusnID');">
            <?php
                     $strsqlselet ="SELECT `tml_NoOfRunsID` FROM `tms_bd_TicketMode` WHERE tml_NoOfRunsdate='$nowdate';";
                     $resultselet = $class_mysql_default ->my_query("$strsqlselet");
                     while($rows = @mysqli_fetch_array($resultselet)){
                         if($andnoofrusnID==$rows[0])
                         {
                             echo "<option selected=\"selected\" value=\"{$rows[0]}\">{$rows[0]}</option>";
                         }
                         else
                         {
                             echo "<option value=\"{$rows[0]}\">{$rows[0]}</option>";   
                         }
                    }
	    ?>
	    </select>
	 </td>
    </tr>
    <tr>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 发车日期:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="senddate" id="senddate" value="<?=$rowsA[0]?>" /></td>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 合并发车日期:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="sendanddate" id="sendanddate" /></td>
    </tr>
    <tr>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 发车时间:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="sendtime" id="sendtime" value="<?=$rowsA[2]?>"  /></td>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 合并发车时间:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="sendandtime" id="sendandtime" /></td>
    </tr>
    <tr>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 终点站:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="sendend" id="sendend" value="<?=$rowsA[3]?>" /></td>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 合并终点站:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="sendandend" id="sendandend" /></td>
    </tr>
    <tr>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 售票车型:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="bustype" id="bustype" value="<?=$rowsA[4]?>" /></td>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 合并售票车型:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="andbustype" id="andbustype" /></td>
    </tr>
    <tr>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 座位数:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="sendseat" id="sendseat" value="<?=$rowsA[5]?>" /></td>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 合并座位数:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="sendandseat" id="sendandseat" /></td>
    </tr>
    <tr>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 已售:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="sendsell" id="sendsell" /></td>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 合并已售:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="sendandsell" id="sendandsell" /></td>
    </tr>
    <tr>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 余票:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="restticket" id="restticket" /></td>
        <td width="10%" bgcolor="#FFFFFF"><span><img src="../ui/images/sj.gif" width="6" height="7" /> 合并余票:</span></td>
        <td width="10%" bgcolor="#FFFFFF"><input type="text" name="restandticket" id="restandticket" /></td>
    </tr>
    <tr>
        <td colspan="2" align="center"><input name="submitm" type="submit" value="合并确认"></td>
        <td colspan="2" align="center"><input name="buttonex" type="button" value="取消退出" onclick="window.location.href='tms_v1_schedule_noofrun.php?op=&on=&oo=';"></td>
    </tr>
  </table> 
</form>
