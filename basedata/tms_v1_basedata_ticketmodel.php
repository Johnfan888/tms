<?php 
//生成票版界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$strs='';
	$strf='';
?>
<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" >
	function display(){
		if (document.getElementById("NoRunsSelect").checked){
			document.getElementById("LineNoRuns").style.display=""
		}else{
			document.getElementById("LineNoRuns").style.display="none"
		}
	}

	function displayruns(jia,NoRuns,images){
		if(document.getElementById(images).title=='+' ){
		    document.getElementById(NoRuns).style.display="";
		    document.getElementById(images).title= '-';
		    document.getElementById(images).src= '../ui/images/bg10.png';
		    return;
		   }
		if(document.getElementById(images).title=='-'){
		    document.getElementById(NoRuns).style.display= 'none';
		    document.getElementById(images).title= '+';
		    document.getElementById(images).src= '../ui/images//bg09.png';
		    return;
		   }	
	}

	function selectall(LineName,NoRunsID){
		var aa=document.getElementsByName(NoRunsID)
		for (var i=0;i<aa.length;i++){
			if (document.getElementById(LineName).checked){
				aa[i].checked=true
				if(document.addL.NoRunsIds.value.indexOf(aa[i].value)<0){
					document.addL.NoRunsIds.value=document.addL.NoRunsIds.value+aa[i].value+','
				}
			}
			else {
				aa[i].checked=false
				if(document.addL.NoRunsIds.value.indexOf(aa[i].value)>=0){
					document.addL.NoRunsIds.value=document.addL.NoRunsIds.value.replace(aa[i].value+',',"")
				}
			}
		}
	}

	function checkk(LineName,NoRunsID){
		var dd=document.getElementsByName(NoRunsID)
		var all=1
		for (var i=0;i<dd.length;i++){
			if(dd[i].checked){
				all=all*1
				if(document.addL.NoRunsIds.value.indexOf(dd[i].value)<0){
					document.addL.NoRunsIds.value=document.addL.NoRunsIds.value+dd[i].value+','
				}
			}else{
				all=all*0
				if(document.addL.NoRunsIds.value.indexOf(dd[i].value)>=0){
					document.addL.NoRunsIds.value=document.addL.NoRunsIds.value.replace(dd[i].value+',',"")
					}
				}
		}
		if(all==1){
			document.getElementById(LineName).checked=true
		}else{
			document.getElementById(LineName).checked=false
			}	

	}
	function Createmodel(){
		if(document.getElementById("BeginDate").value==''){
			alert('请输入开始日期！');
			return false;
		}
		if(document.getElementById("EndDate").value==''){
			alert('请输入结束日期！');
			return false;
		}
		if(document.getElementById("EndDate").value<document.getElementById("BeginDate").value){
			alert('结束日期不能小于开始日期！');
			return false;
		}
		if(document.getElementById("SelectNoRuns").checked){
			if(document.addL.NoRunsIds.value==''){
				alert('请选择班次！');
				return false;
			}
		}
		if(document.getElementById("allNoRunsline").checked){
			if(document.getElementById("CheckLineIds").value==''){
				alert('请选择线路！');
				return false;
			}
		}
		document.getElementById("Operation").value='Createmodel';
		document.addL.submit();
//		alert(document.getElementById("Operation").value);
	}
	function Delmodel(){
		if(document.getElementById("BeginDate").value==''){
			alert('请输入开始日期！');
			return false;
		}
		if(document.getElementById("EndDate").value==''){
			alert('请输入结束日期！');
			return false;
		}
		if(document.getElementById("EndDate").value<document.getElementById("BeginDate").value){
			alert('结束日期不能小于开始日期！');
			return false;
		}
		if(document.getElementById("SelectNoRuns").checked){
			if(document.addL.NoRunsIds.value==''){
				alert('请选择班次！');
				return false;
			}
		}
		if(document.getElementById("allNoRunsline").checked){
			if(document.getElementById("CheckLineIds").value==''){
				alert('请选择线路！');
				return false;
			}
		}
		document.getElementById("Operation").value='Delmodel';
		document.addL.submit();
	//	alert(document.getElementById("Operation").value);
	}
	function getradio(){
		if(document.getElementById("SelectNoRuns").checked){
			document.getElementById("LineNoRuns").style.display="";
			document.getElementById("Line").style.display="none";
			document.getElementById("CheckLineIds").value="";
			for(var i=0; i<document.getElementsByName("LineID").length; i++){
				document.getElementsByName("LineID")[i].checked=false;
			}
		}
		if(document.getElementById("allNoRunsline").checked){
			document.getElementById("Line").style.display="";
			document.getElementById("LineNoRuns").style.display="none";
			document.getElementById("NoRunsIds").value="";
			for(var i=0; i<document.getElementsByName("LineName").length; i++){
			//	alert(document.getElementsByName("NoRunsID"+document.getElementsByName("LineIDD")[i].value).length)
				document.getElementsByName("LineName")[i].checked=false;
				for(var j=0; j<document.getElementsByName("NoRunsID"+document.getElementsByName("LineIDD")[i].value).length; j++){
					document.getElementsByName("NoRunsID"+document.getElementsByName("LineIDD")[i].value)[j].checked=false;
				}
			}
		}
		if(document.getElementById("allNoRuns").checked){
			document.getElementById("Line").style.display="none";
			document.getElementById("LineNoRuns").style.display="none";
			document.getElementById("CheckLineIds").value="";
			document.getElementById("NoRunsIds").value="";
			for(var i=0; i<document.getElementsByName("LineID").length; i++){
				document.getElementsByName("LineID")[i].checked=false;
			}
			for(var i=0; i<document.getElementsByName("LineName").length; i++){
				document.getElementsByName("LineName")[i].checked=false;
				for(var j=0; j<document.getElementsByName("NoRunsID"+document.getElementsByName("LineIDD")[i].value).length; j++){
					document.getElementsByName("NoRunsID"+document.getElementsByName("LineIDD")[i].value)[j].checked=false;
				}
			}
		}
	}
	function checkline(ID,lineID){
	//	alert(document.getElementById("CheckLineIds").value);
		if (document.getElementById(ID).checked){
			document.getElementById("CheckLineIds").value=document.getElementById("CheckLineIds").value+lineID+',';
		}else{
			document.getElementById("CheckLineIds").value=document.getElementById("CheckLineIds").value.replace(lineID+',',"");
		}
	}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;"> 生 成 票 版  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<form name="addL" id="addL" action="" method="post">
<table width="60%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr><td colspan="2" width="30%" nowrap="nowrap" ><span class="form_title"> 选择日期：</span></td></tr>
	<tr>
    	<td width="50%" nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开始日期：</span></td>
        <td width="50%" bgcolor="#FFFFFF"><input name="BeginDate" id="BeginDate" type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></td>
	</tr>
	<tr> 	
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结束日期：</span></td>
		<td bgcolor="#FFFFFF"><input name="EndDate" id="EndDate" type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td>
	</tr>
<!--  	
	<tr>
		<td nowrap="nowrap" >
		<input type="checkbox" name="NoRunsSelect" id="NoRunsSelect" onclick="display()"/> &nbsp; 班次选择：</span>
		</td>
	</tr>
 --> 
	<tr>
		<td colspan="2" nowrap="nowrap" >
			<input type="hidden" name="Operation" id="Operation" value=""/>
			<input type="radio" name="NoRuns" id="allNoRuns" onclick="getradio()" checked="checked"/> &nbsp; 所有班次：&nbsp;&nbsp;&nbsp;
			<input type="radio" name="NoRuns" id="allNoRunsline" onclick="getradio()"/> &nbsp; 同线路所有班次：&nbsp;&nbsp;&nbsp;
			<input type="radio" name="NoRuns" id="SelectNoRuns" onclick="getradio()"/> &nbsp; 所选班次：
		</td>
	</tr>	
	<tr id="LineNoRuns" style="DISPLAY: none">
		<td colspan="2" nowrap="nowrap" bgcolor="#FFFFFF">
			<?php
				if($userStationID=='all'){
					$andlinestring='';
				}else{
					$andlinestring=" AND li_BeginSiteID='{$userStationID}'";
				}	 
				$sql = "select li_LineID,li_LineName FROM tms_bd_LineInfo WHERE li_Linestate='正常'".$andlinestring;
				$query = $class_mysql_default->my_query($sql);
				while($result=mysqli_fetch_array($query)){
					$LineID=$result['li_LineID'];	
			?>
					<div>
					<span id="jia<?php echo $result['li_LineID'];?>"  style="cursor:hand" onClick="displayruns('jia<?php echo $result['li_LineID'];?>','Noruns<?php echo $result['li_LineID'];?>','images<?php echo $result['li_LineID'];?>')"><img id="images<?php echo $result['li_LineID'];?>" title="+" src="../ui/images/bg09.png"/></span>
					<input type="checkbox" name="LineName" id="LineName<?php echo $result['li_LineID'];?>" value="<?php echo $result['li_LineID'];?>" onclick="selectall(this.id,'NoRunsID<?php echo $result['li_LineID'];?>')"/> <?php echo $result['li_LineID'].'：'.$result['li_LineName']."\n<br>";?>
					<input type="hidden" name="LineIDD" value="<?php echo $LineID;?>"/>
					</div>
					<div id="Noruns<?php echo $result['li_LineID'];?>" style="DISPLAY: none">	
				<?php 
						if($userStationID=='all'){
							$andrunstring='';
						}else{
							$andrunstring=" AND nri_BeginSiteID='{$userStationID}'";
						}	
						$sqls = "select nri_NoOfRunsID,nri_DepartureTime FROM tms_bd_NoRunsInfo WHERE nri_LineID='$LineID' AND nri_IsStopOrCreat='1' AND nri_AddNoRuns='0'".$andrunstring;
						$querys =$class_mysql_default->my_query($sqls);
						while($results=mysqli_fetch_array($querys)){	
				?>
						 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" name="NoRunsID<?php echo $result['li_LineID'];?>" id="NoRunsID<?php echo $result['li_LineID'];?>" value="<?php echo $results['nri_NoOfRunsID'];?>" onclick="checkk('LineName<?php echo $result['li_LineID'];?>',this.id)" /> <?php echo $results['nri_NoOfRunsID'].' 发车时间：'.$results['nri_DepartureTime']."\n<br>"; ?>
				<?php 
						}
				?>
					</div>
			<?php 
				}
			?>
			
		</td>	
	</tr>
	<tr id="Line" style="DISPLAY:none">
		<td colspan="2" nowrap="nowrap" bgcolor="#FFFFFF">
			<?php 
				if($userStationID=='all'){
					$andlinestring='';
				}else{
					$andlinestring=" AND li_BeginSiteID='{$userStationID}'";
				}	
			  	$selectline="SELECT li_LineID,li_LineName FROM tms_bd_LineInfo WHERE li_Linestate='正常'".$andlinestring;
			  	$queryline= $class_mysql_default->my_query($selectline);
			  	While($resultline=mysqli_fetch_array($queryline)){
			?>
				<input type="checkbox" name="LineID" id="LineID<?php echo $resultline['li_LineID'];?>" value="<?php echo $resultline['li_LineID'];?>" onclick="checkline(this.id,this.value)"/> <?php echo $resultline['li_LineID'].' ：'.$resultline['li_LineName']."\n<br>"; ?>
			<?php 
			  	}
			?>
		</td>
	</tr>			
	<tr> 	
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input name="NoRunsIds" id="NoRunsIds" type="hidden"></td>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><input type="hidden" name="CheckLineIds" id="CheckLineIds"></td>
	</tr>
	<tr> 
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="button1" type="button" value="生成票版" onclick="Createmodel()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="删除票版" onclick="Delmodel()"></td>
  </tr>
  <tr> 	
		<td nowrap="nowrap" colspan="2" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 成功信息：</span></td>
	</tr>
	<?php 
		if(isset($_POST['BeginDate'])) {
			$BeginDate=$_POST['BeginDate'];
			$date=strtotime($BeginDate);
			$EndDate=$_POST['EndDate'];
			$NoRunsIds=$_POST['NoRunsIds'];
			$Operation=$_POST['Operation'];
			$CheckLineIds=$_POST['CheckLineIds'];
			$strs='';
			$strf='';
			$StopRun=0;
			$User=$userName;
			$days=abs(strtotime($BeginDate) - strtotime($EndDate))/60/60/24;
			$queryprice=1;
			for($i=0;$i<=$days;$i++){
				$RunDate=date('Y-m-d',$date+$i*24*60*60);
				$strs=$strs." ".$RunDate;
				$strf=$strf." ".$RunDate;
				if($NoRunsIds!='' && $CheckLineIds==''){
					foreach (explode(",",$NoRunsIds) as $key =>$RunID){
						if($RunID!=''){
							$creatordel=Creatordelticketmodel($RunID,$RunDate,$User,$Operation,$class_mysql_default);
						//	if(Creatordelticketmodel($RunID,$RunDate,$User,$Operation,$class_mysql_default)==1){
							if($creatordel==1){
								$strs=$strs.' '.$RunID;
							}else{
							//	$strf=$strf.' '.$RunID.Creatordelticketmodel($RunID,$RunDate,$User,$Operation,$class_mysql_default);
								$strf=$strf.' '.$RunID.$creatordel;
							}	
						}
					}
				} 
				if($NoRunsIds=='' && $CheckLineIds!=''){
					foreach (explode(",",$CheckLineIds) as $key =>$LineIDs){
						if($LineIDs!=''){
							$selectnoofrunsinfor="SELECT nri_NoOfRunsID FROM tms_bd_NoRunsInfo WHERE nri_LineID='{$LineIDs}' AND nri_IsStopOrCreat='1' AND nri_AddNoRuns='0'";
							$querynoofrunsinfor=$class_mysql_default->my_query($selectnoofrunsinfor);
							if(!$querynoofrunsinfor){
								echo "<script>alert('查询班次数据失败！');</script>";
								break;
							}
							while($resultnoofrunsinfor=mysqli_fetch_array($querynoofrunsinfor)){
								$RunID=$resultnoofrunsinfor['nri_NoOfRunsID'];
							//	Creatordelticketmodel($RunID,$RunDate,$User,$Operation,$strs,$strf,$class_mysql_default);
								if($RunID!=''){
									$creatordel=Creatordelticketmodel($RunID,$RunDate,$User,$Operation,$class_mysql_default);
								//	if(Creatordelticketmodel($RunID,$RunDate,$User,$Operation,$class_mysql_default)==1){
									if($creatordel==1){
										$strs=$strs.' '.$RunID;
									}else{
									//	$strf=$strf.' '.$RunID.Creatordelticketmodel($RunID,$RunDate,$User,$Operation,$class_mysql_default);
										$strf=$strf.' '.$RunID.$creatordel;
									}		
								}
							}
						}
					}
				}  
				if($NoRunsIds=='' && $CheckLineIds==''){
					if($userStationID=='all'){
						$andrunstring='';
					}else{
						$andrunstring=" AND nri_BeginSiteID='{$userStationID}'";
					}	
					$selectnoofrunsinfor="SELECT nri_NoOfRunsID FROM tms_bd_NoRunsInfo LEFT OUTER JOIN tms_bd_LineInfo ON nri_LineID=li_LineID  
						WHERE nri_IsStopOrCreat='1' AND nri_AddNoRuns='0'".$andrunstring." AND li_Linestate='正常'";
					$querynoofrunsinfor=$class_mysql_default->my_query($selectnoofrunsinfor);
					if(!$querynoofrunsinfor){
						echo "<script>alert('查询班次数据失败！');window.location.href='tms_v1_basedata_ticketmodel.php'</script>";
						exit();
					}
					while($resultnoofrunsinfor=mysqli_fetch_array($querynoofrunsinfor)){
						$RunID=$resultnoofrunsinfor['nri_NoOfRunsID'];
					//	Creatordelticketmodel($RunID,$RunDate,$User,$Operation,$strs,$strf,$class_mysql_default);
						if($RunID!=''){
							$creatordel=Creatordelticketmodel($RunID,$RunDate,$User,$Operation,$class_mysql_default);
						//	if(Creatordelticketmodel($RunID,$RunDate,$User,$Operation,$class_mysql_default)==1){
							if($creatordel==1){
								$strs=$strs.' '.$RunID;
							}else{
							//	$strf=$strf.' '.$RunID.Creatordelticketmodel($RunID,$RunDate,$User,$Operation,$class_mysql_default);
								$strf=$strf.' '.$RunID.$creatordel;
							}	
						}
					}
				} 
				$strs=$strs."\n";
				$strf=$strf."\n";
			}
		}
	?>
	<tr> 	
		<td colspan="2"  bgcolor="#FFFFFF"><textarea name="DateRuns" cols="100" rows="10"><?php echo $strs;?></textarea></td>
	</tr>
	<tr>
		<td nowrap="nowrap" colspan="2" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 未成功信息：</span></td>
	</tr>
	<tr>	
		<td colspan="2" bgcolor="#FFFFFF"><textarea name="DateRunf" cols="100" rows="10"><?php echo $strf;?></textarea></td>
	</tr>
	<?php
			$selectmodle="SELECT MAX(tml_NoOfRunsdate) FROM tms_bd_TicketMode";
			$querymodle = $class_mysql_default->my_query($selectmodle);
			$resultmodel=mysqli_fetch_array($querymodle);
	?>
	<tr>
		<td nowrap="nowrap"  bgcolor="#FFFFFF"><span class="form_title" style="color:red"><img src="../ui/images/sj.gif" width="6" height="7" />已制作票版的日期：</span></td>
		<td nowrap="nowrap"  bgcolor="#FFFFFF"><span class="form_title" style="color:red"><?php echo $resultmodel[0];?></span></td>
	</tr>
</table>
</form>
<?php 
	function Creatordelticketmodel($RunID,$RunDate,$User,$Operation,$class_mysql_default){
		$strings='';
		$stringf='';
		$string='';
		if($Operation=='Createmodel'){
			$queryprice=1;
			//查线路表找出线路所属车站
			$selectline="SELECT li_StationID, li_Station FROM tms_bd_LineInfo WHERE li_LineID IN (SELECT nri_LineID FROM tms_bd_NoRunsInfo WHERE 
				nri_NoOfRunsID='{$RunID}')";
			$queryline=$class_mysql_default->my_query($selectline);
			if(!$queryline){
				$stringf=$stringf.'查询线路数据失败！';
				$string=$string.$RunID.$stringf.$class_mysql_default->my_error();
				writelog($string);
				return $stringf;
			}
			$rowline=mysqli_fetch_array($queryline);
			$StationID=$rowline['li_StationID'];
			$Station=$rowline['li_Station'];
			//查班次表
			$selectnoofruns="SELECT nri_BeginSiteID,nri_BeginSite,nri_EndSiteID,nri_EndSite,nri_DepartureTime,nri_CheckTicketWindow,nri_Allticket,nri_AllowSell,
				nri_LoopDate,nri_StartDay,nri_RunDay,nri_StopDay,nri_IsStopOrCreat,nri_LineID,nri_StationDeal,nri_RunRegion,nri_DealCategory,nri_DealStyle,nri_RunHours 
				FROM tms_bd_NoRunsInfo WHERE nri_NoOfRunsID='{$RunID}'";
			$querynoofruns=$class_mysql_default->my_query($selectnoofruns);
			if(!$querynoofruns){
				$stringf=$stringf.'查询班次数据失败！';
				$string=$string.$RunID.$stringf.$class_mysql_default->my_error();
				writelog($string);
				return $stringf;
			}
			$rownoofruns=mysqli_fetch_array($querynoofruns);
			$BeginSiteID=$rownoofruns['nri_BeginSiteID'];
			$BeginSite=$rownoofruns['nri_BeginSite'];
			$EndSiteID=$rownoofruns['nri_EndSiteID'];
			$EndSite=$rownoofruns['nri_EndSite'];
			$DepartureTime=$rownoofruns['nri_DepartureTime'];
			$CheckTicketWindow=$rownoofruns['nri_CheckTicketWindow'];
			$Allticket=$rownoofruns['nri_Allticket'];
			$AllowSell=$rownoofruns['nri_AllowSell'];
			$LoopDate=$rownoofruns['nri_LoopDate'];
			$StartDay=$rownoofruns['nri_StartDay'];
			$RunDay=$rownoofruns['nri_RunDay'];
			$StopDay=$rownoofruns['nri_StopDay'];
			$IsStopOrCreat=$rownoofruns['nri_IsStopOrCreat'];
			$LineID=$rownoofruns['nri_LineID'];
			$StationDeal=$rownoofruns['nri_StationDeal'];
			$RunRegion=$rownoofruns['nri_RunRegion'];
			$DealCategory=$rownoofruns['nri_DealCategory'];
			$DealStyle=$rownoofruns['nri_DealStyle'];
			$RunHours=$rownoofruns['nri_RunHours'];
			//该班次是否长停
			$selectlongcount="SELECT COUNT(*) AS longcount FROM tms_bd_ScheduleLong WHERE sl_NoOfRunsID='{$RunID}' AND sl_BeginDate<='{$RunDate}' AND sl_EndDate>='{$RunDate}'";
			$querylongcount=$class_mysql_default->my_query($selectlongcount);
			if(!$querylongcount){
				$stringf=$stringf.'查询班次长停数据失败！';
				$string=$string.$RunID.$stringf.$class_mysql_default->my_error();
				writelog($string);
				return $stringf;
			}
			$rowlongcount=mysqli_fetch_array($querylongcount);
			if($rowlongcount['longcount']>0){ 
				$IsStopOrCreat=0;
				$stringf=$stringf.'班次长停！';
				$string=$string.$RunID.$stringf;
				writelog($string);
				return $stringf;
			}
			else $IsStopOrCreat=1;
			//计算循环号
			$selectrotatecount="SELECT COUNT(*) AS rotatecount  FROM tms_bd_NoRunsLoop WHERE nrl_NoOfRunsID='{$RunID}'";
			$queryrotatecount=$class_mysql_default->my_query($selectrotatecount);
			if(!$queryrotatecount){
				$stringf=$stringf.'查询班次循环数失败！';
				$string=$string.$RunID.$stringf.$class_mysql_default->my_error();
				writelog($string);
				return $stringf;
			}
			$rowrotatecount=mysqli_fetch_array($queryrotatecount);
			if($rowrotatecount[rotatecount]=='0'){
				$stringf=$stringf.'没有输入循环车辆！';
				$string=$string.$RunID.$stringf;
				writelog($string);
				return $stringf;
			}
			if($StartDay=='' || $StartDay=='NULL') $StartDay=0;
			if($RunDay=='' || $RunDay=='NULL') $RunDay=0;
			if($StopDay=='' || $StopDay=='NULL') $StopDay=0;
			$DayCount=abs(strtotime($RunDate) - strtotime($LoopDate))/60/60/24-$StartDay;
			if($rowrotatecount['rotatecount']>0){
				if($RunDay==0 && $StopDay==0){
					$Orderno=$DayCount%$rowrotatecount['rotatecount']+1;
				}else{
					if($DayCount%($RunDay+$StopDay)<$RunDay){
						$IsStopOrCreat=1;
						$Orderno=((int)($DayCount/($RunDay+$StopDay))*$RunDay+$DayCount%($RunDay+$StopDay))%$rowrotatecount['rotatecount']+1;
					}else{
						$IsStopOrCreat=0;
						$stringf=$stringf.'班次循环为停班！';
						$string=$string.$RunID.$stringf;
						writelog($string);
						return $stringf;
					}
				}
			}
			//查班次循环表
			$selectnorunsloop="SELECT nrl_ModelID,nrl_ModelName,nrl_Seating,nrl_AddSeating,nrl_AllowHalfSeats,nrl_Loads,nrl_Unit FROM tms_bd_NoRunsLoop WHERE nrl_NoOfRunsID='{$RunID}' AND nrl_LoopID='{$Orderno}'";
			$querynorunsloop=$class_mysql_default->my_query($selectnorunsloop);
			if(!$querynorunsloop){
				$stringf=$stringf.'查询班次循环失败！';
				$string=$string.$RunID.$stringf.$class_mysql_default->my_error();
				writelog($string);
				return $stringf;
			}
			if(mysqli_num_rows($querynorunsloop) == 1){
				$rownorunsloop=mysqli_fetch_array($querynorunsloop);
				$ModelID=$rownorunsloop['nrl_ModelID'];
				$ModelName=$rownorunsloop['nrl_ModelName'];
				$Seating=$rownorunsloop['nrl_Seating'];
				$AddSeating=$rownorunsloop['nrl_AddSeating'];
				$AllowHalfSeats=$rownorunsloop['nrl_AllowHalfSeats'];
				$Loads=$rownorunsloop['nrl_Loads'];
				$Unit=$rownorunsloop['nrl_Unit'];
				if($Seating=='' || $Seating=='NULL') $Seating=0;
				if($AllowHalfSeats=='' || $AllowHalfSeats=='NULL') $AllowHalfSeats=0;
				$SeatStatus='';
				for($j=0;$j<$rownorunsloop['nrl_Seating'];$j++){
					$SeatStatus=$SeatStatus.'0';
				}
			}
			$Created=date('Y-m-d H:i:s');
			$Createdby=$User;
			$class_mysql_default->my_query("START TRANSACTION");
			if ($IsStopOrCreat==1){
				$insertticketmode="INSERT INTO tms_bd_TicketMode (tml_NoOfRunsID,tml_LineID,tml_NoOfRunsdate,tml_NoOfRunstime,tml_BeginstationID,tml_Beginstation,tml_EndstationID,tml_Endstation,tml_RunHours,tml_CheckTicketWindow,tml_Loads,tml_SeatStatus,tml_TotalSeats,
					tml_LeaveSeats,tml_HalfSeats,tml_LeaveHalfSeats,tml_ReserveSeats,tml_StopRun,tml_Allticket,tml_AllowSell,tml_Orderno,tml_StationID,tml_Station,tml_Created,tml_Createdby,tml_Updated,tml_Updatedby,tml_BusModelID,tml_BusModel,
					tml_BusID,tml_BusCard,tml_StationDeal,tml_RunRegion,tml_DealCategory,tml_DealStyle,tml_BusUnit) VALUES ('{$RunID}','{$LineID}','{$RunDate}','{$DepartureTime}','{$BeginSiteID}','{$BeginSite}','{$EndSiteID}',
					'{$EndSite}','{$RunHours}','{$CheckTicketWindow}','{$Loads}','{$SeatStatus}','{$Seating}','{$Seating}','0','{$AllowHalfSeats}','0','{$StopRun}','{$Allticket}','{$AllowSell}','{$Orderno}','{$StationID}','{$Station}','{$Created}','{$Createdby}',
					'{$Created}','{$Createdby}','{$ModelID}','{$ModelName}','######','######','{$StationDeal}','{$RunRegion}','{$DealCategory}','{$DealStyle}','{$Unit}')";
				$queryinsertticketmode=$class_mysql_default->my_query($insertticketmode);
				if(!$queryinsertticketmode){
					$stringf=$stringf.'插入票版失败！';
					$string=$string.$RunID.$stringf.$class_mysql_default->my_error();
					writelog($string);
					$class_mysql_default->my_query("ROLLBACK");
					return $stringf;
				}
				//插入临时停靠点
				$insertdoktemp="INSERT INTO tms_bd_NoRunsDockSiteTemp (ndst_NoOfRunsID,ndst_NoOfRunsdate,ndst_ID,ndst_SiteName,ndst_SiteID,ndst_IsDock,ndst_GetOnSite,
					ndst_CheckInSite,ndst_DepartureTime,ndst_RunHours,ndst_StintSell,ndst_StintTime) SELECT nds_NoOfRunsID,'$RunDate',nds_ID,nds_SiteName,nds_SiteID,
					nds_IsDock,nds_GetOnSite,nds_CheckInSite,nds_DepartureTime,nds_RunHours,nds_StintSell,nds_StintTime FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$RunID}'";
				$queryinsert=$class_mysql_default->my_query($insertdoktemp);
				if(!$queryinsert){
					$stringf=$stringf.'插入临时停靠点失败！'.$class_mysql_default->my_error();
					$string=$string.$RunID.$stringf.$class_mysql_default->my_error();
					writelog($string);
					$class_mysql_default->my_query("ROLLBACK");
					return $stringf;
				}
				//查询班次停靠点
				$selectnorunsdocksite="SELECT nds_ID,nds_SiteName,nds_SiteID,nds_IsDock,nds_GetOnSite,nds_CheckInSite,nds_DepartureTime,nds_RunHours,nds_CheckTicketWindow,nds_IsServiceFee,nds_ServiceFee,nds_otherFee1,nds_otherFee2,nds_otherFee3,nds_otherFee4,nds_otherFee5,
					nds_otherFee6,nds_StintSell,nds_StintTime FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID='{$RunID}' AND nds_GetOnSite=1";
				$querynorunsdocksite=$class_mysql_default->my_query($selectnorunsdocksite);
				if(!$querynorunsdocksite || mysqli_num_rows($querynorunsdocksite)==0){
					$stringf=$stringf.'查询班次停靠点失败！';
					$string=$string.$RunID.$stringf.$class_mysql_default->my_error();
					writelog($string);
					$class_mysql_default->my_query("ROLLBACK");
					return $stringf;
				}
				$found=false; //该变量最后验证票价表是否有一条记录
				$founddate=false;
				$noprice=false;
				$noprice1=false;
				$noprice2=false;
				$noprice3=false;
				while($rownorunsdocksite=mysqli_fetch_array($querynorunsdocksite)){
					$ID=$rownorunsdocksite['nds_ID'];
					$BeginStationTime=$rownorunsdocksite['nds_DepartureTime']; 
					$ndsRunHours1=$rownorunsdocksite['nds_RunHours'];
					$FromStationID=$rownorunsdocksite['nds_SiteID'];
					$FromStation=$rownorunsdocksite['nds_SiteName'];
					$CheckInSite=$rownorunsdocksite['nds_CheckInSite'];
					$ServiceFee=$rownorunsdocksite['nds_ServiceFee'];
					$otherFee1=$rownorunsdocksite['nds_otherFee1'];
					$otherFee2=$rownorunsdocksite['nds_otherFee2'];
					$otherFee3=$rownorunsdocksite['nds_otherFee3'];
					$otherFee4=$rownorunsdocksite['nds_otherFee4'];
					$otherFee5=$rownorunsdocksite['nds_otherFee5'];
					$otherFee6=$rownorunsdocksite['nds_otherFee6'];
					$StintSell=$rownorunsdocksite['nds_StintSell'];
					$StintTime=$rownorunsdocksite['nds_StintTime'];
					$IsPass=1;
					if($FromStationID==$BeginSiteID) $IsFromSite=1;
					else $IsFromSite=0;
					$Selectsectioninfor="SELECT si_Kilometer FROM tms_bd_SectionInfo WHERE si_SiteNameID='{$FromStationID}' AND si_LineID='{$LineID}'";
					$querysectioninfor=$class_mysql_default->my_query($Selectsectioninfor);
					if(!$querysectioninfor){
						$stringf=$stringf.'查询线路站点失败！';
						$string=$string.$RunID.$stringf.$class_mysql_default->my_error();
						writelog($string);
						$class_mysql_default->my_query("ROLLBACK");
						return $stringf;
					}
					$rowsectioninfor=mysqli_fetch_array($querysectioninfor);
					$FromStationKilometer=$rowsectioninfor['si_Kilometer'];
					//查询班次停靠点2
					$selectnorunsdocksite1="SELECT nds_ID,nds_SiteName,nds_SiteID,nds_DepartureTime,nds_RunHours FROM tms_bd_NoRunsDockSite WHERE nds_NoOfRunsID ='{$RunID}' AND nds_ID >'{$ID}' AND nds_IsDock = 1";
					$querynorunsdocksite1=$class_mysql_default->my_query($selectnorunsdocksite1);
					if(!$querynorunsdocksite1 || mysqli_num_rows($querynorunsdocksite1)==0){
						$stringf=$stringf.'查询班次停靠点1失败！';
						$string=$string.$RunID.$stringf.$class_mysql_default->my_error();
						writelog($string);
						$class_mysql_default->my_query("ROLLBACK");
						return $stringf;
					}
					while($rownorunsdocksite1=mysqli_fetch_array($querynorunsdocksite1)){
						$ReachStationID=$rownorunsdocksite1['nds_SiteID'];
						$ReachStation=$rownorunsdocksite1['nds_SiteName'];
						$StopStationTime=$rownorunsdocksite1['nds_DepartureTime'];
						$ndsRunHours2=$rownorunsdocksite1['nds_RunHours'];
						$FullPrice=0;
						$HalfPrice=0;
						$ReferPrice=0;
						$BalancePrice=0;
						//处理运行小时
						if($ID==1){
							$ndsRunHours1='0:0';
						}
						if($ndsRunHours1 && $ndsRunHours2){
							$RunHours1=explode(":", $ndsRunHours1);
							$RunHours2=explode(":", $ndsRunHours2);
							$allRunHours1=$RunHours1[0]*60+$RunHours1[1];
							$allRunHours2=$RunHours2[0]*60+$RunHours2[1];
							$allRunHours=$allRunHours2-$allRunHours1;
							$allhours=(int)($allRunHours/60);
							$allminutes=$allRunHours%60;
							$lastRunHours=$allhours.':'.$allminutes;
						}else{
							$lastRunHours='';
						}
						$Selectsectioninfor1="SELECT si_Kilometer FROM tms_bd_SectionInfo WHERE si_SiteNameID='{$ReachStationID}' AND si_LineID='{$LineID}'";
						$querysectioninfor1=$class_mysql_default->my_query($Selectsectioninfor1);
						if(!$querysectioninfor){
							$stringf=$stringf.'查询线路站点1失败！';
							$string=$string.$RunID.$stringf.$class_mysql_default->my_error();
							writelog($string);
							$class_mysql_default->my_query("ROLLBACK");
							return $stringf;
						}
						$rowsectioninfor1=mysqli_fetch_array($querysectioninfor1);
						$ToStationKilometer=$rowsectioninfor1['si_Kilometer'];
						$Distance=$ToStationKilometer-$FromStationKilometer;
						if($Distance<0) $Distance=0;
						//查询票价是否过期
						$selectpricedate1="SELECT nrap_BeginDate,nrap_EndDate FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$FromStationID}' AND nrap_GetToSiteID='{$ReachStationID}' AND nrap_NoRunsAdjust='{$RunID}' AND nrap_ModelID='{$ModelID}' AND 
							nrap_ISNoRunsAdjust=0 AND nrap_ISLineAdjust=0 AND nrap_Unit='{$Unit}'";
						$querypricedate1=$class_mysql_default->my_query($selectpricedate1);
						if(!$querypricedate1){
							$stringf=$stringf.'查询班次价格日期1失败！';
							$string=$string.$RunID.$stringf.$class_mysql_default->my_error();
							writelog($string);
							$class_mysql_default->my_query("ROLLBACK");
							return $stringf;
						}
						if(mysqli_num_rows($querypricedate1) > 0){
							while($rowpricedate1=mysqli_fetch_array($querypricedate1)){
								if($rowpricedate1['nrap_BeginDate']<=$RunDate && $rowpricedate1['nrap_EndDate']>=$RunDate){
									$founddate=true;
								}
							}
						}else{
							$noprice1=true;
						}
						$selectpricedate2="SELECT nrap_BeginDate,nrap_EndDate FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$FromStationID}' AND nrap_GetToSiteID='{$ReachStationID}' AND nrap_NoRunsAdjust='{$RunID}' AND nrap_ModelID='{$ModelID}' AND 
							nrap_ISNoRunsAdjust=1 AND nrap_ISLineAdjust=0";
						$querypricedate2=$class_mysql_default->my_query($selectpricedate2);
						if(!$querypricedate2){
							$stringf=$stringf.'查询班次价格日期2失败！';
							$string=$string.$RunID.$stringf.$class_mysql_default->my_error();
							writelog($string);
							$class_mysql_default->my_query("ROLLBACK");
							return $stringf;
						}
						if(mysqli_num_rows($querypricedate2) > 0){
							while($rowpricedate2=mysqli_fetch_array($querypricedate2)){
								if($rowpricedate2['nrap_BeginDate']<=$RunDate && $rowpricedate2['nrap_EndDate']>=$RunDate){
									$founddate=true;
								}
							}
						}else{
							$noprice2=true;
						}
						$selectpricedate3="SELECT nrap_BeginDate,nrap_EndDate FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$FromStationID}' AND nrap_GetToSiteID='{$ReachStationID}' AND nrap_LineAdjust='{$LineID}' AND nrap_ModelID='{$ModelID}' AND 
							nrap_ISNoRunsAdjust=0 AND nrap_ISLineAdjust=1";
						$querypricedate3=$class_mysql_default->my_query($selectpricedate3);
						if(!$querypricedate3){
							$stringf=$stringf.'查询班次价格日期3失败！';
							$string=$string.$RunID.$stringf.$class_mysql_default->my_error();
							writelog($string);
							$class_mysql_default->my_query("ROLLBACK");
							return $stringf;
						}
						if(mysqli_num_rows($querypricedate3) > 0){
							while($rowpricedate3=mysqli_fetch_array($querypricedate3)){
								if($rowpricedate3['nrap_BeginDate']<=$RunDate && $rowpricedate3['nrap_EndDate']>=$RunDate){
									$founddate=true;
								}
							}
						}else{
							$noprice3=true;
						} 
						$noprice=$noprice1 & $noprice2 & $noprice3;
					/*	if($foundate1==false && $foundate2==false ){
							$stringf=$stringf.'车型'.$ModelName.'没有输入票价！';
							$class_mysql_default->my_query("ROLLBACK");
							return $stringf;
						}
						if($founddate==false){
							$stringf=$stringf.'车型'.$ModelName.'输入的票价已过期！';
							$class_mysql_default->my_query("ROLLBACK");
							return $stringf;
						}    */
						//查询班次价格调整表
						$selectnorunsadjustPrice1="SELECT nrap_RunPrice,nrap_HalfPrice,nrap_ReferPrice,nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$FromStationID}' AND nrap_GetToSiteID='{$ReachStationID}' AND nrap_BeginDate<='{$RunDate}' AND 
							nrap_EndDate>='{$RunDate}' AND nrap_NoRunsAdjust='{$RunID}' AND nrap_ISUnitAdjust=1 AND nrap_ModelID='{$ModelID}' AND nrap_Unit='{$Unit}' AND DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))=(SELECT 
							MIN(DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))) FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$FromStationID}' AND nrap_GetToSiteID='{$ReachStationID}' AND nrap_BeginDate<='{$RunDate}' AND 
							nrap_EndDate>='{$RunDate}' AND nrap_NoRunsAdjust='{$RunID}' AND nrap_ISUnitAdjust=1 AND nrap_ModelID='{$ModelID}' AND nrap_Unit='{$Unit}' GROUP BY nrap_DepartureSiteID,nrap_GetToSiteID,nrap_NoRunsAdjust,nrap_ModelID,nrap_Unit,nrap_ISUnitAdjust)";
						$querynorunsadjustPrice1=$class_mysql_default->my_query($selectnorunsadjustPrice1);
						if(!$querynorunsadjustPrice1){
							$stringf=$stringf.'查询班次价格数据1失败！';
							$string=$string.$RunID.$stringf.$class_mysql_default->my_error();
							writelog($string);
							$class_mysql_default->my_query("ROLLBACK");
							return $stringf;
						}
						if(mysqli_num_rows($querynorunsadjustPrice1) == 1){
							$rownorunsadjustPrice1=mysqli_fetch_array($querynorunsadjustPrice1);
							$FullPrice=$rownorunsadjustPrice1['nrap_RunPrice'];
							$HalfPrice=$rownorunsadjustPrice1['nrap_HalfPrice'];
							$ReferPrice=$rownorunsadjustPrice1['nrap_ReferPrice'];
							$BalancePrice=$rownorunsadjustPrice1['nrap_BalancePrice'];
							if($FullPrice=='' || $FullPrice=='NULL') $FullPrice=0;
							if($HalfPrice=='' || $HalfPrice=='NULL') $HalfPrice=0;
							if($ReferPrice=='' || $ReferPrice=='NULL') $ReferPrice=0;
							if($BalancePrice=='' || $BalancePrice=='NULL') $BalancePrice=0;
						}else{
							$selectnorunsadjustPrice2="SELECT nrap_RunPrice,nrap_HalfPrice,nrap_ReferPrice,nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$FromStationID}' AND nrap_GetToSiteID='{$ReachStationID}' AND nrap_BeginDate<='{$RunDate}' AND 
								nrap_EndDate>='{$RunDate}' AND nrap_NoRunsAdjust='{$RunID}' AND nrap_ISNoRunsAdjust=1 AND nrap_ISLineAdjust=0 AND nrap_ModelID='{$ModelID}' AND DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))=(SELECT 
								MIN(DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))) FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$FromStationID}' AND nrap_GetToSiteID='{$ReachStationID}' AND nrap_BeginDate<='{$RunDate}' AND 
								nrap_EndDate>='{$RunDate}' AND nrap_NoRunsAdjust='{$RunID}' AND nrap_ISNoRunsAdjust=1 AND nrap_ModelID='{$ModelID}' GROUP BY nrap_DepartureSiteID,nrap_GetToSiteID,nrap_NoRunsAdjust,nrap_ModelID,nrap_ISNoRunsAdjust)";
							$querynorunsadjustPrice2=$class_mysql_default->my_query($selectnorunsadjustPrice2);
							if(!$querynorunsadjustPrice2){
								$stringf=$stringf.'查询班次价格数据2失败！';
								$string=$string.$RunID.$stringf.$class_mysql_default->my_error();
								writelog($string);
								$class_mysql_default->my_query("ROLLBACK");
								return $stringf;
							}
							if(mysqli_num_rows($querynorunsadjustPrice2) == 1){
								$rownorunsadjustPrice2=mysqli_fetch_array($querynorunsadjustPrice2);
								$FullPrice=$rownorunsadjustPrice2['nrap_RunPrice'];
								$HalfPrice=$rownorunsadjustPrice2['nrap_HalfPrice'];
								$ReferPrice=$rownorunsadjustPrice2['nrap_ReferPrice'];
								$BalancePrice=$rownorunsadjustPrice2['nrap_BalancePrice'];
								if($FullPrice=='' || $FullPrice=='NULL') $FullPrice=0;
								if($HalfPrice=='' || $HalfPrice=='NULL') $HalfPrice=0;
								if($ReferPrice=='' || $ReferPrice=='NULL') $ReferPrice=0;
								if($BalancePrice=='' || $BalancePrice=='NULL') $BalancePrice=0;
							}else{
								$selectnorunsadjustPrice3="SELECT nrap_RunPrice,nrap_HalfPrice,nrap_ReferPrice,nrap_BalancePrice FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$FromStationID}' AND nrap_GetToSiteID='{$ReachStationID}' AND nrap_BeginDate<='{$RunDate}' AND 
									nrap_EndDate>='{$RunDate}' AND nrap_ISNoRunsAdjust=0 AND nrap_ISLineAdjust=1 AND nrap_ModelID='{$ModelID}' AND nrap_LineAdjust='{$LineID}' AND DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))=(SELECT 
									MIN(DATEDIFF(STR_TO_DATE(nrap_EndDate,'%Y-%c-%d'),STR_TO_DATE(nrap_BeginDate,'%Y-%c-%d'))) FROM tms_bd_NoRunsAdjustPrice WHERE nrap_DepartureSiteID='{$FromStationID}' AND nrap_GetToSiteID='{$ReachStationID}' AND nrap_BeginDate<='{$RunDate}' AND 
									nrap_EndDate>='{$RunDate}' AND nrap_LineAdjust='{$LineID}' AND nrap_ISLineAdjust=1 AND nrap_ModelID='{$ModelID}' GROUP BY nrap_DepartureSiteID,nrap_GetToSiteID,nrap_NoRunsAdjust,nrap_ModelID,nrap_ISLineAdjust)";
								$querynorunsadjustPrice3=$class_mysql_default->my_query($selectnorunsadjustPrice3);
								if(!$querynorunsadjustPrice3){
									$stringf=$stringf.'查询班次价格数据3失败！';
									$string=$string.$RunID.$stringf.$class_mysql_default->my_error();
									writelog($string);
									$class_mysql_default->my_query("ROLLBACK");
									return $stringf;
								}
								if(mysqli_num_rows($querynorunsadjustPrice3) == 1){
									$rownorunsadjustPrice3=mysqli_fetch_array($querynorunsadjustPrice3);
									$FullPrice=$rownorunsadjustPrice3['nrap_RunPrice'];
									$HalfPrice=$rownorunsadjustPrice3['nrap_HalfPrice'];
									$ReferPrice=$rownorunsadjustPrice3['nrap_ReferPrice'];
									$BalancePrice=$rownorunsadjustPrice2['nrap_BalancePrice'];
									if($FullPrice=='' || $FullPrice=='NULL') $FullPrice=0;
									if($HalfPrice=='' || $HalfPrice=='NULL') $HalfPrice=0;
									if($ReferPrice=='' || $ReferPrice=='NULL') $ReferPrice=0;
									if($BalancePrice=='' || $BalancePrice=='NULL') $BalancePrice=0;
								}
							}
						}
				/*		if ($FullPrice==0 ||$FullPrice=='' || $HalfPrice==0 || $HalfPrice==''){
							$stringf=$stringf.'票价为0或没有输入票价！';
							if(!strstr($stringf,'票价为0或没有输入票价！')){
								$stringf=$stringf.'票价为0或没有输入票价！';
							} 
							$class_mysql_default->my_query("ROLLBACK");
							return $stringf;
						//	break;
						}else{ */
						if($FullPrice && $HalfPrice){
							$insertpricedetail="INSERT INTO tms_bd_PriceDetail (pd_NoOfRunsID,pd_LineID,pd_NoOfRunsdate,pd_BeginStationTime,pd_StopStationTime,pd_RunHours,pd_Distance,pd_BeginStationID,pd_BeginStation,pd_FromStationID,pd_FromStation,pd_ReachStationID,
								pd_ReachStation,pd_EndStationID,pd_EndStation,pd_FullPrice,pd_HalfPrice,pd_StandardPrice,pd_BalancePrice,pd_ServiceFee,pd_otherFee1,pd_otherFee2,pd_otherFee3,pd_otherFee4,pd_otherFee5,pd_otherFee6,pd_StationID,pd_Station,
								pd_Created,pd_CreatedBY,pd_Updated,pd_UpdatedBY,pd_IsPass,pd_CheckInSite,pd_IsFromSite,pd_StintSell,pd_StintTime) VALUES ('{$RunID}','{$LineID}','{$RunDate}','{$BeginStationTime}','{$StopStationTime}','{$lastRunHours}','{$Distance}','{$BeginSiteID}',
								'{$BeginSite}','{$FromStationID}','{$FromStation}','{$ReachStationID}','{$ReachStation}','{$EndSiteID}','{$EndSite}','{$FullPrice}','{$HalfPrice}','{$ReferPrice}','{$BalancePrice}','{$ServiceFee}','{$otherFee1}','{$otherFee2}','{$otherFee3}',
								'{$otherFee4}','{$otherFee5}','{$otherFee6}','{$StationID}','{$Station}','{$Created}','{$Createdby}','{$Created}','{$Createdby}','{$IsPass}','{$CheckInSite}','{$IsFromSite}','{$StintSell}','{$StintTime}')";
							$querypricedetail=$class_mysql_default->my_query($insertpricedetail);
							if(!$querypricedetail){
								$stringf=$stringf.'插入票价数据失败！';
								$string=$string.$RunID.$stringf.$class_mysql_default->my_error();
								writelog($string);
								$class_mysql_default->my_query("ROLLBACK");
								return $stringf;
							}else{
								$found=true;
							}
							$queryprice=$queryprice & $querypricedetail;
						}
					}
				}
				if($founddate==false && $noprice==false){
					$stringf=$stringf.'车型'.$ModelName.'输入的票价已过期！';
					$string=$string.$RunID.$stringf;
					writelog($string);
					$class_mysql_default->my_query("ROLLBACK");
					return $stringf;	
				}
				if($found==false){
					$stringf=$stringf.'车型'.$ModelName.'没输入票价！';
					$string=$string.$RunID.$stringf;
					writelog($string);
					$class_mysql_default->my_query("ROLLBACK");
					return $stringf;
				}
				if($queryinsertticketmode && $queryprice){
					$strings=1;
					$class_mysql_default->my_query("COMMIT");
					return $strings;
				}else{
				//	$stringf=0;
					$class_mysql_default->my_query("ROLLBACK");
					return $stringf;
				}
			}else{
			//	$stringf=0;
				return $stringf;
			}
		} 
		if($Operation=='Delmodel'){
			$select="SELECT tml_SeatStatus FROM tms_bd_TicketMode WHERE tml_NoOfRunsdate='{$RunDate}' AND tml_NoOfRunsID='{$RunID}'";
			$query3=$class_mysql_default->my_query($select);
			$row=mysqli_fetch_array($query3);
			if(!strstr($row[0],'1') && !strstr($row[0],'2') && !strstr($row[0],'3') && !strstr($row[0],'4') && !strstr($row[0],'5') && !strstr($row[0],'6')){
				$class_mysql_default->my_query("START TRANSACTION");
				$del1="DELETE FROM tms_bd_TicketMode WHERE tml_NoOfRunsdate='{$RunDate}' AND tml_NoOfRunsID='{$RunID}' ";
				$query1=$class_mysql_default->my_query($del1);
		//		if (!$query1) echo "SQL错误：".$class_mysql_default->my_error();
				$del2="DELETE FROM tms_bd_PriceDetail WHERE pd_NoOfRunsdate='{$RunDate}' AND pd_NoOfRunsID='{$RunID}' ";
				$query2=$class_mysql_default->my_query($del2);
				$del4="DELETE FROM tms_bd_NoRunsDockSiteTemp WHERE ndst_NoOfRunsID='{$RunID}' AND ndst_NoOfRunsdate='{$RunDate}'";
				$query4=$class_mysql_default->my_query($del4);
				if($query1 && $query2 && $query4){
					$class_mysql_default->my_query("COMMIT");
					$strings=1;
					return $strings;
				}else{
					$class_mysql_default->my_query("ROLLBACK");
					$stringf=$stringf.'删除票版表或票价表失败！';
					return $stringf;
				}
				$class_mysql_default->my_query("END TRANSACTION");
			}else{
				$stringf=$stringf.'已经售票，不能删除票版！';
				return $stringf;
			}
		}
	}
?>
