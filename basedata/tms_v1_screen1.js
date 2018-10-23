
function selectRow(target,str){
	var sTable = document.getElementById("table1");
	for(var i=1;i<sTable.rows.length;i++){
		if (sTable.rows[i]!=target){
			sTable.rows[i].bgColor = "#CCCCCC";
			sTable.rows[i].onmouseover = resumeRowOver;
			sTable.rows[i].onmouseout = resumeRowOut;
		}else{
			sTable.rows[i].bgColor = "#FFCC00";
			sTable.rows[i].onmouseover = ""; 
			sTable.rows[i].onmouseout = "";
			document.getElementById(str).value=sTable.rows[i].cells[0].innerText;
		//	alert(document.getElementById(str).value);
		}
	}  
}
function selectRow1(target,str,str1,str2){//班次删除票价提醒车型取值
	var sTable = document.getElementById("table1");
	for(var i=1;i<sTable.rows.length;i++){
		if (sTable.rows[i]!=target){
			sTable.rows[i].bgColor = "#CCCCCC";
			sTable.rows[i].onmouseover = resumeRowOver;
			sTable.rows[i].onmouseout = resumeRowOut;
		}else{
			sTable.rows[i].bgColor = "#FFCC00";
			sTable.rows[i].onmouseover = ""; 
			sTable.rows[i].onmouseout = "";
			document.getElementById(str).value=sTable.rows[i].cells[0].innerText;
			document.getElementById(str1).value=sTable.rows[i].cells[9].innerText;
			document.getElementById(str2).value=sTable.rows[i].cells[10].innerText;
		//	alert(document.getElementById(str).value);
		}
	}  
}
function selectRow2(target,str,str1){//删除收费类型同时删除收费项目取值
	var sTable = document.getElementById("table1");
	for(var i=1;i<sTable.rows.length;i++){
		if (sTable.rows[i]!=target){
			sTable.rows[i].bgColor = "#CCCCCC";
			sTable.rows[i].onmouseover = resumeRowOver;
			sTable.rows[i].onmouseout = resumeRowOut;
		}else{
			sTable.rows[i].bgColor = "#FFCC00";
			sTable.rows[i].onmouseover = ""; 
			sTable.rows[i].onmouseout = "";
			document.getElementById(str).value=sTable.rows[i].cells[0].innerText;
			document.getElementById(str1).value=sTable.rows[i].cells[1].innerText;
		//	alert(document.getElementById(str).value);
		}
	}  
}


function rowOver(target){
	target.bgColor="#F1E6C2";
}

function rowOut(target){
	target.bgColor="#CCCCCC";
}

function resumeRowOver(){
	rowOver(this);
}

function resumeRowOut(){
	rowOut(this);
}

