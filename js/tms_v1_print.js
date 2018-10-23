function printPageSetup(Wsh) {
	var HKEY_Root,HKEY_Path,HKEY_Key;
	HKEY_Root="HKEY_CURRENT_USER\\";
	HKEY_Path="Software\\Microsoft\\Internet Explorer\\PageSetup\\";
	HKEY_Key = "header";
	//Wsh.RegRead(HKEY_Root+HKEY_Path+HKEY_Key);
	Wsh.RegWrite(HKEY_Root+HKEY_Path+HKEY_Key,"");
	HKEY_Key = "footer";
	Wsh.RegWrite(HKEY_Root+HKEY_Path+HKEY_Key,"");
	HKEY_Key = "margin_top";
	Wsh.RegWrite(HKEY_Root+HKEY_Path+HKEY_Key,"0");
	HKEY_Key = "margin_right";
	Wsh.RegWrite(HKEY_Root+HKEY_Path+HKEY_Key,"0");
	HKEY_Key = "margin_bottom";
	Wsh.RegWrite(HKEY_Root+HKEY_Path+HKEY_Key,"0");
	HKEY_Key = "margin_left";
	Wsh.RegWrite(HKEY_Root+HKEY_Path+HKEY_Key,"0");
	HKEY_Key = "font";
	Wsh.RegWrite(HKEY_Root+HKEY_Path+HKEY_Key,"font-family: 宋体; font-size: 13pt; color: rgb(0,0,0);");
	HKEY_Key = "Shrink_To_Fit";
	Wsh.RegWrite(HKEY_Root+HKEY_Path+HKEY_Key,"no");
}

function printSheet(printWin,printData) {
	printWin.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n');
	printWin.document.write('<html xmlns="http://www.w3.org/1999/xhtml">\n<head>\n');
	printWin.document.write('<title>单据打印</title>\n');
	printWin.document.write('<style media="print" type="text/css">\n');
	printWin.document.write('.Noprint{display:none;}\n');
	printWin.document.write('.PageNext{page-break-after:always;}\n');
	printWin.document.write('</style>\n');
	printWin.document.write('<object id="printWB" width=0 height=0 classid="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></object>\n');
	printWin.document.write('<script>\n');
//	printWin.document.write('window.onbeforeprint = function() {alert("Before printing KP");};\n');
//	printWin.document.write('window.onafterprint = function() {alert("After printing KP");};\n');
	printWin.document.write('\<\/script>\n</head>\n');
	printWin.document.write('<body>\n');
	printWin.document.write(printData);
	printWin.document.write('\n<script>\n');
	printWin.document.write('printWB.ExecWB(6,2);');
	printWin.document.write('\n\<\/script>');
	printWin.document.write('\n</body>\n</html>');
	printWin.close();
}

//window.print = printFrame;

//helpers for printFrame
function printIsNativeSupport() {
	var agent = window.navigator.userAgent;
	var i = agent.indexOf("MSIE ")+5;
	return parseInt(agent.substr(i)) >= 5 && agent.indexOf("5.0b1") < 0;
}
function printGetEventScope(frame) {
	var frameset = frame.document.all.tags("FRAMESET");
	if ( frameset.length ) return frameset[0];
	return frame.document.body;
}
function printFireEvent(frame, obj, name) {
	var handler = obj[name];
	switch ( typeof(handler) ) {
		case "string": frame.execScript(handler); break;
		case "function": handler();
	}
}

function printFrame(frame, onfinish) {
	if ( !frame ) frame = window;

	function execOnFinish() {
		switch ( typeof(onfinish) ) {
			case "string":
				// window.execScript 方法不是所有浏览器都支持， 需谨慎使用。
				// 若需要在其他不支持 window.execScript方法的浏览器中达到类似的效果，可以使用 window.eval 方法
				/*if (frame.execScript) {
					frame.execScript(onfinish, "VBScript");
				}
				else {
					frame.eval(onfinish);
				}*/
				execScript(onfinish); 
				break;
			case "function": onfinish();
		}
		if ( focused && !focused.disabled ) focused.focus();
	}
	
	if (( frame.document.readyState != "complete") &&( !frame.document.confirm("The document to print is not downloaded yet! Continue with printing?") ))
	{
		execOnFinish();
		return;
	}
	
	var eventScope = printGetEventScope(frame);
	var focused = document.activeElement;

	window.printHelper = function() {
		execScript("on error resume next: printWB.ExecWB 6, 1", "VBScript");
		printFireEvent(frame, eventScope, "onafterprint");
		printWB.outerHTML = "";
		execOnFinish();
		window.printHelper = null;
	};
	
	document.body.insertAdjacentHTML("beforeEnd","<object id=\"printWB\" width=0 height=0 classid=\"clsid:8856F961-340A-11D0-A96B-00C04FD705A2\">");
	printFireEvent(frame, eventScope, "onbeforeprint");
	frame.focus();
	//window.printHelper = printHelper;
	setTimeout("window.printHelper()", 0);
}

function onprintHiddenFrame() {
	function onfinish() {
		printHiddenFrame.outerHTML = "";
		if ( window.onprintcomplete ) window.onprintcomplete();
	}
	printFrame(printHiddenFrame.printMe, onfinish);
}

function printHidden(url) {
	document.body.insertAdjacentHTML("beforeEnd","<iframe name=printHiddenFrame width=0 height=0></iframe>");
	var doc = printHiddenFrame.document;
	doc.open();
	doc.write("<body onload=\"parent.onprintHiddenFrame()\">");
	doc.write("<iframe name=printMe width=0 height=0 src=\"" + url + "\"></iframe>");
	doc.write("</body>");
	doc.close();
}

function printHiddenHtml(htmlData) {
	document.body.insertAdjacentHTML("beforeEnd","<iframe name=printHiddenFrame width=0 height=0></iframe>");
	var doc = printHiddenFrame.document;
	doc.open();
	doc.write("<body onload=\"parent.onprintHiddenFrame()\">");
	doc.write("<iframe name=printMe width=0 height=0></iframe>");
	var printMedoc = printHiddenFrame.printMe.document.open("text/html","replace");
	printMedoc.write(htmlData);
	printMedoc.close();
	doc.write("</body>");
	doc.close();
}

function onprintHiddenFrameWithFrameName(frameName) {
	function onfinish() {
		printHiddenFrameWithFrameName.outerHTML = "";
		if ( window.onprintcomplete ) window.onprintcomplete();
	}
	printFrame(frameName, onfinish);
}

function printHiddenHtmlWithFrameName(frameName,htmlData) {
	document.body.insertAdjacentHTML("beforeEnd","<iframe name=printHiddenFrameWithFrameName width=0 height=0></iframe>");
	var doc = printHiddenFrameWithFrameName.document;
	doc.open();
	doc.write("<body onload=\"parent.onprintHiddenFrameWithFrameName(" + frameName + ")\">");
	doc.write("<iframe name=" + frameName + " id=" + frameName +  " width=0 height=0></iframe>");
	var printMedoc = doc.getElementById(frameName).contentWindow.document.open("text/html","replace");
	printMedoc.write(htmlData);
	printMedoc.close();
	doc.write("</body>");
	doc.close();
}

function onprintHiddenFrameKPBX(kpFrame,bxFrame) {
	function onfinish() {
		printHiddenFrameKPBX.outerHTML = "";
		if ( window.onprintcomplete ) window.onprintcomplete();
	}
	function execOnFinish() {
		switch ( typeof(onfinish) ) {
			case "string":
				execScript(onfinish); 
				break;
			case "function": onfinish();
		}
		if ( focused && !focused.disabled ) focused.focus();
	}
	
	var focused = document.activeElement;

	window.printHelperKP = function() {
		kpFrame.execScript("on error resume next: printWB.ExecWB 6, 1", "VBScript");
		printFireEvent(kpFrame, kpFrame.document.body, "onafterprint");
		kpFrame.printWB.outerHTML = "";
		//execOnFinish();
		window.printHelperKP = null;
	};

	window.printHelperBX = function() {
		bxFrame.execScript("on error resume next: printWB.ExecWB 6, 1", "VBScript");
		printFireEvent(bxFrame, bxFrame.document.body, "onafterprint");
		bxFrame.printWB.outerHTML = "";
		execOnFinish();
		window.printHelperBX = null;
	};

	//document.body.insertAdjacentHTML("beforeEnd","<object id=\"printWB\" width=0 height=0 classid=\"clsid:8856F961-340A-11D0-A96B-00C04FD705A2\">");
	printFireEvent(kpFrame, kpFrame.document.body, "onbeforeprint");
	kpFrame.focus();
	window.printHelperKP = printHelperKP;
	setTimeout("window.printHelperKP()", 0);
	
	printFireEvent(bxFrame, bxFrame.document.body, "onbeforeprint");
	bxFrame.focus();
	window.printHelperBX = printHelperBX;
	setTimeout("window.printHelperBX()", 1000);
//	printFrame(parent.kpFrame, onfinish);
//	printFrame(parent.bxFrame, onfinish);
}

function printHiddenHtmlKPBX(KPData,BXData) {
	document.body.insertAdjacentHTML("beforeEnd","<iframe name=printHiddenFrameKPBX width=100% height=60%</iframe>");
	var doc = printHiddenFrameKPBX.document;
	doc.open();
	doc.write("<body onload=\"parent.onprintHiddenFrameKPBX(kpFrame,bxFrame)\">");
	doc.write("<iframe name=kpFrame id=kpFrame width=100% height=50%></iframe>");
	var printMedoc = printHiddenFrameKPBX.kpFrame.document.open("text/html","replace");
	printMedoc.write(KPData);
	printMedoc.write('<object id="printWB" width=0 height=0 classid="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></object>\n');
	printMedoc.close();
	doc.write("<iframe name=bxFrame id=bxFrame width=100% height=50%></iframe>");
	var printMedoc = printHiddenFrameKPBX.bxFrame.document.open("text/html","replace");
	printMedoc.write(BXData);
	printMedoc.write('<object id="printWB" width=0 height=0 classid="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></object>\n');
	printMedoc.close();
	doc.write("</body>");
	doc.close();
}

function onprintHiddenFrameKP() {
	function onfinish() {
	/*	printHiddenFrameKP.outerHTML = "";
		if ( window.onprintcomplete ) window.onprintcomplete();*/
	}
	printFrame(printHiddenFrameKP.kpFrame, onfinish);
}

function onprintHiddenFrameBX() {
	function onfinish() {
	/*	printHiddenFrameBX.outerHTML = "";
		if ( window.onprintcomplete ) window.onprintcomplete();*/
	}
	printFrame(printHiddenFrameBX.bxFrame, onfinish);
}

function printHiddenHtmlKP(KPData) {
	document.body.insertAdjacentHTML("beforeEnd","<iframe name=printHiddenFrameKP width=100% height=30%</iframe>");
	var doc = printHiddenFrameKP.document;
	doc.open();
	doc.write("<body onload=\"parent.onprintHiddenFrameKP(kpFrame)\">");
	doc.write("<iframe name=kpFrame id=kpFrame width=100% height=100%></iframe>");
	var printMedoc = printHiddenFrameKP.kpFrame.document.open("text/html","replace");
	printMedoc.write(KPData);
	printMedoc.close();
	doc.write("</body>");
	doc.close();
}

function printHiddenHtmlBX(BXData) {
	document.body.insertAdjacentHTML("beforeEnd","<iframe name=printHiddenFrameBX width=100% height=30%</iframe>");
	var doc = printHiddenFrameBX.document;
	doc.open();
	doc.write("<body onload=\"parent.onprintHiddenFrameBX(bxFrame)\">");
	doc.write("<iframe name=bxFrame id=bxFrame width=100% height=100%></iframe>");
	var printMedoc = printHiddenFrameBX.bxFrame.document.open("text/html","replace");
	printMedoc.write(BXData);
	printMedoc.close();
	doc.write("</body>");
	doc.close();
}
