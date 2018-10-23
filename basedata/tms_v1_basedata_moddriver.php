<?php 
//修改驾驶员界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	$clnumber=$_GET['clnumber'];
	$sqll="select * FROM tms_bd_DriverInfo WHERE di_DriverID='{$clnumber}'";
	$queryl =$class_mysql_default->my_query($sqll);
	$results=mysql_fetch_array($queryl); 
?>
<script language="javascript" type="text/javascript" src="../js/My97DatePickerBeta/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" >
$(document).ready(function(){
	$("#DriverID").keyup(function(){
		var DriverID = document.getElementById("DriverID").value;
		var DriverI = document.getElementById("DriverI").value;
		if(DriverID != DriverI){
		jQuery.get( //查看驾驶员编号是否唯一
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'adddriver', 'DriverID': DriverID, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if( objData.sucess=='1'){
						document.getElementById('code').style.display="";
					}
					else{
						document.getElementById('code').style.display="none";
					}
		});
		}
		else{
			document.getElementById('code').style.display="none";
		}
	});	
	
});
	function add(){
		if(document.getElementById("DriverID").value == ""){
			alert("驾驶员编号不能为空!");
			return false; 
		}
		if(document.getElementById("Name").value== ""){
			alert("驾驶员姓名不能为空!");
			return false;
		} 
		if (!document.getElementById("DriverCard").value){
			alert('驾照号不能为空！')
			return false
		}	
		if (document.getElementById("DriverCar").value==1){
			alert('该驾照号码已存在！')
			return false
		}
		if (!document.getElementById("IdCard").value){
			alert('身份证号不能为空！')
			return false
		}
		if (document.getElementById("IdCar").value==1){
			alert('身份证号码不正确！')
			return false
		}
		if(document.getElementById("scanfile").value!=""){
			if(getFileSize(document.getElementById("scanfile").value)==false){
				return false;
			}
		}
		if(document.getElementById("photo").value!=""){
			if(getFileSize(document.getElementById("photo").value)==false){
				return false;
			}
		}
		var DriverID = document.getElementById("DriverID").value;
		var DriverI = document.getElementById("DriverI").value;
		if(DriverID != DriverI){
		jQuery.get( //查看驾驶员编号是否唯一
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'adddriver', 'DriverID': DriverID, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if( objData.sucess=='1'){
						alert('已存在相同的驾驶员编号，请注意查看');
							return false;
					}
					else{
				 		document.addL.submit();}
			});
		}
		else{
			document.addL.submit();}
	}
	function sear(){
		window.location.href='tms_v1_basedata_seardriver.php';
	}
	function selectadjust(){
		if(document.getElementById("male").checked){
			document.getElementById("Sex").value='男';
		}
		if(document.getElementById("female").checked){
			document.getElementById("Sex").value='女';
		}
	}
	function isnumber(number,id){
		if(isNaN(number)){
			alert(number+"不是数字！");
			document.getElementById(id).value='';
			return false;
			}
	}
	$(document).ready(function(){
		$("#DriverCard").blur(function(){
			var DriverCard = $("#DriverCard").val();
			jQuery.get(
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'checkDriverCard', 'DriverCard': DriverCard, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if( objData.sucess=='1'){
						alert('该驾照号码已存在！');
						document.getElementById("DriverCar").value=1;
						return false
					}else{
						document.getElementById("DriverCar").value=0;
					}
			});
		});
	});
	function isidcard(IDcard){
		if(IDcard.search(/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/)!=-1){
			document.getElementById("IdCar").value=0;
			return true;
		}else{
			alert("您输入的身份证号码不正确！");
			document.getElementById("IdCar").value=1;
			return false;
		}
	}
	function getFileSize(filePath){ 
		var fso = new ActiveXObject("Scripting.FileSystemObject"); 
//		alert("文件大小为："+fso.GetFile(filePath).size); 
		if(fso.GetFile(filePath).size>2*1024*1024){
				alert("请上传小于2MB的附件");
//				document.getElementById("scanfile").value='';
				return false;
			}
	} 
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">修 改 驾 驶 员  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<div>
<form name="addL" id="addL" action="tms_v1_basedata_moddriverok.php" method="post" enctype="multipart/form-data">
<table width="50%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF" "><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员编号：</span></td>
        <td bgcolor="#FFFFFF"><input name="DriverI" id="DriverI" type="hidden"  value="<?php echo $results['di_DriverID'];?>"/>
        	<input name="DriverID" id="DriverID" type="text"  value="<?php echo $results['di_DriverID'];?>"/><span style="color:red">*</span><br><span style="color:red" style="display:none" id="code">&nbsp;已存在相同的驾驶员编号,请重新输入！</span></td>
         <td align="center" rowspan="9" bgcolor="#FFFFFF" width="20%"><img src="<?php echo $results['di_Photo'];?>" width="148" height="205" /><br><br>
        	<input type="file" name="photo" id="photo" onchange="getFileSize(this.value)"/><br><span style="color:red"> 所传照片大小不超过2M</span></td>
	</tr>
	<tr> 	
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 姓名：</span></td>
		<td bgcolor="#FFFFFF"><input name="Name" id="Name" type="text" value="<?php echo $results['di_Name'];?>"/><span style="color:red">*</span></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 性别：</span></td>
    	<td bgcolor="#FFFFFF">
    		<input type="radio" name="radio1" id="male" <?php if($results['di_Sex']=='男') echo 'checked';?> onclick="selectadjust()">男
    		<input type="radio" name="radio1" id="female" <?php if($results['di_Sex']=='女') echo 'checked';?> onclick="selectadjust()">女
    		<input type="hidden" name="Sex" id="Sex" value="<?php echo $results['di_Sex'];?>"/></td>  
    </tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 电话：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text"  name="Tel" id="Tel" value="<?php echo $results['di_Tel'];?>" onkeyup="return isnumber(this.value,this.id)"/></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 身份证号 ：</span></td>
    	<td bgcolor="#FFFFFF"><input type="hidden" name="IdCar" id="IdCar" />
    	<input type="text" name="IdCard" id="IdCard"  value="<?php echo $results['di_IdCard'];?>" onblur="isidcard(this.value)"/><span style="color:red">*</span></td>
    </tr>
    <tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 家庭住址：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Address" id="Address" value="<?php echo $results['di_Address'];?>" style= "width:200px;"/></td>
    </tr>
    <tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 所属单位：</span></td>
    	<td bgcolor="#FFFFFF"><select name="BusNumber" id="BusNumber" style="width:131">
    			<option></option>
    			<?php
    				$select="SELECT bu_UnitName FROM tms_bd_BusUnit";
    				$sel =$class_mysql_default->my_query($select);
					while($result=mysql_fetch_array($sel)){ 
						if($result['bu_UnitName']==$results['di_BusNumber']){
				?>
							<option selected="selected" value="<?php echo $result['bu_UnitName'];?>"><?php echo $result['bu_UnitName'];?></option>	
				<?php 
						}else{
    			?>
    					<option value="<?php echo $result['bu_UnitName'];?>"><?php echo $result['bu_UnitName'];?></option>
    			<?php 
						}
					}
    			?>
    		</select></td> 
    </tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 从业资格证号：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="CYZGZNumber" id="CYZGZNumber" value="<?php echo $results['di_CYZGZNumber'];?>"/></td> 
	</tr>
	<tr>  
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾照号码：</span></td>
    	<td bgcolor="#FFFFFF"><input type="hidden" name="DriverCar" id="DriverCar"/>
    	<input type="text" name="DriverCard" id="DriverCard" value="<?php echo $results['di_DriverCard'];?>"/><span style="color:red">*</span></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 允许驾驶的车型：</span></td>
    	<td colspan="2" bgcolor="#FFFFFF"><input type="text" name="AllowBusType" id="AllowBusType" value="<?php echo $results['di_AllowBusType'];?>"/></td> 
    </tr>
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾照审验日期：</span></td>
    	<td colspan="2" bgcolor="#FFFFFF"><input type="text" name="DriverCheckDate" id="DriverCheckDate" value="<?php echo $results['di_DriverCheckDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 从业资格证审验期：</span></td>
    	<td colspan="2" bgcolor="#FFFFFF"><input type="text" name="CYZGZCheckDate" id="CYZGZCheckDate" value="<?php echo $results['di_CYZGZCheckDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 上岗有效期：</span></td>
    	<td colspan="2" bgcolor="#FFFFFF"><input type="text" name="WorkEndDate" id="WorkEndDate" value="<?php echo $results['di_WorkEndDate'];?>" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/></td> 
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 驾驶员档案编号：</span></td>
    	<td colspan="2" bgcolor="#FFFFFF"><input type="text" name="FileID" id="FileID" value="<?php echo $results['di_FileID'];?>"/></td> 
	</tr>
<!--	<tr> 	-->
<!--    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 上传照片：</span></td>-->
<!--    	<td bgcolor="#FFFFFF"><input name="photo" type="file" /></td>-->
<!--	</tr>-->
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 修改扫描件：</span></td>
    	<td colspan="2" bgcolor="#FFFFFF"><input name="scanfile" id="scanfile" type="file" onchange="getFileSize(this.value)"/>
    	<br><span style="color:red"> 所传文件大小不超过2M</span></td>
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td colspan="2" bgcolor="#FFFFFF"><textarea name="Remark" cols="30" rows="5"><?php echo $results['di_Remark'];?></textarea></td>
	</tr> 
   <tr>
    <td colspan="3" align="center" bgcolor="#FFFFFF"><input name="button1" type="button" value="修改" onclick="return add()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return sear()"></td>
  </tr>
</table>
</form>
</div>

