<?php 
//票证入库界面
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" >
	function computer(){
		computernum();
	} 
	function computernum(){
		if(document.getElementById("BeginTicket").value ==""){
			alert("开始号不能为空!");
			return false; 
		}
		if(document.getElementById("EndTicket").value==""){
			alert("结束票号不能为空!");
			return false;
		} 
	//	var begin=parseInt(document.getElementById("BeginTicket").value);
		var begin=document.getElementById("BeginTicket").value;
		var end=document.getElementById("EndTicket").value;
		if(begin.length!=end.length){
			alert('开始票号和结束票号长度不相等!');
			return false;
		}
		var begin=begin.replace(/\D/g, "");
		var end=end.replace(/\D/g, "");
	//	var end=parseInt(document.getElementById("EndTicket").value);
		if(begin>end){
			alert("开始票号不能大于结束票号!")
			return false;
		}
		document.getElementById("AddNum").value=end-begin+1;
	}	
	function sear(){
		window.location.href='tms_v1_basedata_searticketadd.php';
	}
	$(document).ready(function(){
		document.getElementById("BeginTicket").focus();
		$("#add").click(function(){
			/*if(document.getElementById("BeginTicket").value ==""){
				alert("开始号不能为空!");
				return false; 
			}
			if(document.getElementById("EndTicket").value==""){
				alert("结束票号不能为空!");
				return false;
			}
			if(document.getElementById("AddNum").value==""){
				if(!computernum()){
					return false;
					}
			}*/
			if(document.getElementById("BeginTicket").value ==""){
				alert("开始号不能为空!");
				return false; 
			}
			if(document.getElementById("EndTicket").value==""){
				alert("结束票号不能为空!");
				return false;
			} 
		//	var begin=parseInt(document.getElementById("BeginTicket").value);
			var begin=document.getElementById("BeginTicket").value;
			var end=document.getElementById("EndTicket").value;
			if(begin.length!=end.length){
				alert('开始票号和结束票号长度不相等!');
				return false;
			}
			var begin=begin.replace(/\D/g, "");
			var end=end.replace(/\D/g, "");
		//	var end=parseInt(document.getElementById("EndTicket").value);
			if(begin>end){
				alert("开始票号不能大于结束票号!")
				return false;
			}
			document.getElementById("AddNum").value=end-begin+1;
			if(document.getElementById("Type").value ==""){
				alert('请选择票据类型');
				return false;
			}
			var BeginTicket = document.getElementById("BeginTicket").value;
			var EndTicket = document.getElementById("EndTicket").value;
			var AddNum = document.getElementById("AddNum").value;
			var Type =  document.getElementById("Type").value;
			//if(confirm("票据入库信息确认：\r\r开始票号：  "+ BeginTicket + "\r结束票号：  " + EndTicket + "\r入库数量：  "+AddNum+"\r票据类型：  "+ Type)){
			jQuery.get(
					'tms_v1_basedata_ticketaddok.php',
					{'op': 'add', 'BeginTicket': $("#BeginTicket").val(), 'EndTicket': $("#EndTicket").val(), 
					'AddNum': $("#AddNum").val(), 'Type': $("#Type").val(), 'Remark':  $("#Remark").val(),
					'time': Math.random()},
					function(data){
						var objData = eval('(' + data + ')');
						if(objData.sucess=='2'){
							alert('票号出现重复，请重新输入！');
						}
						else{
							if(confirm("票据入库信息确认：\r\r开始票号：  "+ BeginTicket + "\r结束票号：  " + EndTicket + "\r入库数量：  "+AddNum+"\r票据类型：  "+ Type)){
								jQuery.get(
										'tms_v1_basedata_ticketaddok.php',
										{'op': 'add1', 'BeginTicket': $("#BeginTicket").val(), 'EndTicket': $("#EndTicket").val(), 
										'AddNum': $("#AddNum").val(), 'Type': $("#Type").val(), 'Remark':  $("#Remark").val(),
										'time': Math.random()},
										function(data){
										//	alert(data);
											var objData = eval('(' + data + ')');
											if( objData.sucess=='1'){
												alert('添加成功！');
												document.getElementById("BeginTicket").value="";
												document.getElementById("EndTicket").value="";
												document.getElementById("AddNum").value="";
												document.getElementById("Type").value="";
												document.getElementById("Remark").value="";
											}
											if(objData.sucess=='0'){
												alert('添加失败！');
											}
									});
							 }
						}
				});
			
		});
		document.getElementById("BeginTicket").onkeydown = function (event){
			 var e = event || window.event || arguments.callee.caller.arguments[0];
	         if (e && e.keyCode == 13) {
				document.getElementById("EndTicket").focus();
	         }
		};
		document.getElementById("EndTicket").onkeydown = function (event){
			 var e = event || window.event || arguments.callee.caller.arguments[0];
	         if (e && e.keyCode == 13) {
				document.getElementById("AddNum").focus();
	         }
		};
		document.getElementById("AddNum").onkeydown = function (event){
			 var e = event || window.event || arguments.callee.caller.arguments[0];
	         if (e && e.keyCode == 13) {
	        	computernum();
	     		document.getElementById("Type").focus();
	         }
		};
		document.getElementById("Type").onkeydown = function (event){
			 var e = event || window.event || arguments.callee.caller.arguments[0];
	         if (e && e.keyCode == 13) {
	        	computernum();
	     		document.getElementById("Remark").focus();
	         }
		};
		document.getElementById("Remark").onkeydown = function (event){
			 var e = event || window.event || arguments.callee.caller.arguments[0];
	         if (e && e.keyCode == 13) {
	        	computernum();
	     		document.getElementById("add").focus();
	         }
		};
	});
</script>
<link href="../ui/images/style_main.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#f0f8ff"><img src="../ui/images/tb.gif" style="top:3px; position:relative;" width="14" height="14" />
    <span class="graytext" style="margin-left:8px;">票 据 入 库  </span></td>
  </tr>
</table>
<?
//连接数据库，获取班次信息
?>
<div><form name="addL" id="addL" action="tms_v1_basedata_ticketaddok.php" method="post">
<table width="40%" align="center" class="main_tableboder" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td nowrap="nowrap" bgcolor="#FFFFFF" "><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 开始票号：</span></td>
        <td bgcolor="#FFFFFF"><input name="BeginTicket" id="BeginTicket" type="text" /><span style="color:red">*</span></td>
	</tr>
	<tr> 	
		<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 结束票号：</span></td>
		<td bgcolor="#FFFFFF"><input name="EndTicket" id="EndTicket" type="text"/><span style="color:red">*</span></td>
	</tr>
	<tr> 
    	<td nowrap="nowrap" bgcolor="#FFFFFF" ><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 入库数量：</span></td>
    	<td bgcolor="#FFFFFF"><input name="AddNum" id="AddNum" type="text" readonly="readonly" onclick="computer()"/><span style="color:red">*</span></td> 
    </tr>
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" /> 票据类型：</span></td>
    	<td bgcolor="#FFFFFF">
    		<select id="Type" name="Type" >
    			<option></option>
      			<option value="客票">客票</option>
      			<option value="保险票">保险票</option>
      			<option value="结算单">结算单</option>
      			<option value="包车单">包车单</option>
      			<option value="托运单">托运单</option>
      			<option value="安检单">安检单</option>
      	<!--  	
      			<option value=""></option>
      	-->
     		<?php 
       /*			$selects="SELECT tt_TypeName FROM tms_bd_TicketType";
      			$querys=$class_mysql_default->my_query($selects);
      		//	if(!$querys) echo "SQL错误：".mysql_error();
      			while($results=mysql_fetch_array($querys)){
      				if($results['tt_TypeName']!=$Type){    */
      		?>
      			<!-- 
      					<option value="<? //php echo $results['tt_TypeName'];?>"><? //php echo $results['tt_TypeName'];?></option>
      			-->
      		<?php
      		//		}
      		//	}
      		?> 
      		
     	 	</select><span style="color:red">*</span> </td>
     	 	
	</tr> 
	<tr> 	
    	<td nowrap="nowrap" bgcolor="#FFFFFF"><span class="form_title"><img src="../ui/images/sj.gif" width="6" height="7" />备注：</span></td>
    	<td bgcolor="#FFFFFF"><textarea id="Remark" name="Remark" cols="" rows="5"></textarea></td>
	</tr> 
   <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="button1" id="add" type="button" value="入库" onclick="return add()" />
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset1" type="reset" value="重置">
    	&nbsp;&nbsp;&nbsp;&nbsp;<input name="button2" type="button" value="返回" onclick="return sear()"></td>
  </tr>
</table>
</form>
</div>

