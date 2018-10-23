<?php 
//添加车型界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	 $('#AllowHalfSeats').keyup(function(){
		    var SeatS1 = document.getElementById('Seating').value; //座位数
			var AllowHalfSeats1=$("#AllowHalfSeats").val(); //半票数
			if(isNaN(AllowHalfSeats1)){
				alert(AllowHalfSeats1+'不是数字');
				document.getElementById('AllowHalfSeats').value='';
				}
			if(SeatS1 == ""){
				var SeatS1 = 0;}
			if(AllowHalfSeats1 == ""){
				var AllowHalfSeats1 = 0;
				}
		    	var AllowHalfSeats1=parseInt(AllowHalfSeats1);
		    	var SeatS1 = parseInt(SeatS1);
		    	if(SeatS1 < AllowHalfSeats1){
			    	document.getElementById('allowhalf1').style.display='';
		    	}
		    else{
			    document.getElementById('allowhalf1').style.display='none';
		    }
	  });
	 $('#Seating').keyup(function(){
		    var SeatS1 = document.getElementById('Seating').value; //座位数
			var AllowHalfSeats1=$("#AllowHalfSeats").val(); //半票数
			if(isNaN(SeatS1)){
				alert(SeatS1+'不是一个数字');
				document.getElementById('Seating').value='';
				}
			if(SeatS1 == ""){
				var SeatS1 = 0;
				}
			if(AllowHalfSeats1 == ""){
				var AllowHalfSeats1 = 0;
				}
		    	var AllowHalfSeats1=parseInt(AllowHalfSeats1);
		    	var SeatS1 = parseInt(SeatS1);
		    	if(SeatS1 < AllowHalfSeats1){
			    	document.getElementById('allowhalf1').style.display='';
		    	}
		   else{
			    document.getElementById('allowhalf1').style.display='none';
		    }
	 });
});
$(document).ready(function(){
	$("#ModelID").keyup(function(){
		var ModelID = document.getElementById("ModelID").value;
		jQuery.get( //查看车型编号是否唯一
				'tms_v1_bsaedata_dataProcess.php',
				{'op': 'addbusmodel', 'ModelID': ModelID, 'time': Math.random()},
				function(data){
					var objData = eval('(' + data + ')');
					if( objData.sucess=='1'){
						document.getElementById('code').style.display="";
					}
					else{
						document.getElementById('code').style.display="none";
					}
		});
	});	
});
function addbusmodel(){
	var Seating = document.getElementById("Seating").value;//座位数
	var AllowHalfSeats = document.getElementById("AllowHalfSeats").value;//半票数
	if(Seating == ""){
		var Seating =0;
		}
	if(AllowHalfSeats == ""){
		var AllowHalfSeats =0;
		}
	var Seating = parseInt(Seating);
	var AllowHalfSeats = parseInt(AllowHalfSeats);
	if(document.getElementById("ModelID").value == ""){
		alert("车型编号不能为空!");
		return false;
	}
	if(document.getElementById("ModelName").value == ""){
		alert("车型名不能为空!");
		return false; 
	}
	if(AllowHalfSeats > Seating){
		alert('允许半票数不能大于座位数：'+Seating);
		return false;
		}
	var ModelID = document.getElementById("ModelID").value;
	jQuery.get( //查看车型编号是否唯一
			'tms_v1_bsaedata_dataProcess.php',
			{'op': 'addbusmodel', 'ModelID': ModelID, 'time': Math.random()},
			function(data){
				var objData = eval('(' + data + ')');
				if( objData.sucess=='1'){
					alert('已存在此车型编号，请注意查看');
						return false;
				}
				else{
			 		document.addL.submit();}
	});
}
function isnumber(number,id){
	if(isNaN(number)){
		alert(number+"不是数字！");
		document.getElementById(id).value ='';
		return false;
		}
}
function searbusmodel(){
	window.location.href='tms_v1_basedata_searbusmodel.php';
}
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">添 加 车 型  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<div><form name="addL" id="addL" action="tms_v1_basedata_addbusmodelok.php" method="post">
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />车型编号:</span></td>
        <td bgcolor="#FFFFFF"><input name="ModelID" id="ModelID" type="text"/><span style="color:red">*</span><br><span style="color:red" style="display:none" id="code">&nbsp;已存在相同的车型编码,请重新输入！</span></td>
	</tr>
	<tr>
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 车型名：</span></td>
		<td bgcolor="#FFFFFF"><input name="ModelName" id="ModelName" type="text"/><span style="color:red">*</span></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 等级：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="Rank">
      			<option></option>
      			<option value="高级">高级</option>
      			<option value="中级">中级</option>
      			<option value="低级">低级</option>
      		</select></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 分类：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select name="Category">
      			<option></option>
      			<option value="客车">客车</option>
      			<option value="卧铺">卧铺</option>
     	 	</select></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />座位数：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Seating" id="Seating" size="10"></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7"/>加座数：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="AddSeating" id="AddSeating" size="10"  onkeyup="return isnumber(this.value,this.id)"></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />允许半票数：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="AllowHalfSeats" id="AllowHalfSeats" size="10"><br><span style="color:red" style="display:none" id="allowhalf1">允许半票数要小于座位数</span></td>
	</tr> 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />载重：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Weight" id="Weight" size="10" onkeyup="return isnumber(this.value,this.id)" />吨</td>
	</tr>
<!-- 
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />内部结算率：</span></td>
    	<td bgcolor="#FFFFFF"><input type="text" name="Closing" size="10" onkeyup="return isnumber(this.value)" /></td>
	</tr>
 -->	 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea name="Remark" cols="" rows="5"></textarea></td>
	</tr> 
   <tr>
    <td  colspan="2" align="center" bgcolor="#FFFFFF"><input name="button1" type="button" value="添加" onclick="return addbusmodel()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="button" value="返回" onclick="return searbusmodel()"></td>
  </tr>
</table>
</form>
</div>

