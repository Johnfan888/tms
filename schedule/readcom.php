<?
require_once("../ui/inc/config.inc.php");
require_once("../ui/inc/config.db.php");
require_once('../ui/inc/fun.inc.php');
?>
<?
echo "test";
?>


<title>JavaScript MSCOMM32.OCX </title>

<SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript> 
//��д mscomm �ؼ���Ψһ�¼�������� 
function MSComm1_OnComm() 
{ 
var len=0;; 
if(MSComm1.CommEvent==1)//����Ƿ����¼� 
{ 
   window.alert("�������");//���������˵�����ͳɹ��� 
} 
else if(MSComm1.CommEvent==2)//����ǽ����¼� 
{ 
 //  window.alert(MSComm1.CommEvent);//�� ��
 //  window.alert(MSComm1.Input);
     document.form1.txtReceive.value=document.form1.txtReceive.value + MSComm1.Input;
} 
// return false; 
} 
</SCRIPT> 

<SCRIPT LANGUAGE=javascript FOR=MSComm1 EVENT=OnComm>  
// MSComm1�ؼ�ÿ���� OnComm �¼��͵��� MSComm1_OnComm()����
MSComm1_OnComm()
</SCRIPT> 


<script language="JavaScript" type="text/JavaScript"> 
//�򿪶˿ڲ������������ 
function OpenPort() 
{ 
if(MSComm1.PortOpen==false) 
{ 
MSComm1.PortOpen=true; 
MSComm1.Output="R";//��������
} 
else 
{ 
  window.alert ("�Ѿ���ʼ��������!"); 
} 
}  
</script> 

</head>
<OBJECT CLASSID="clsid:648A5600-2C6E-101B-82B6-000000000014" id=MSComm1 codebase="MSCOMM32.OCX" type="application/x-oleobject" 
style="LEFT: 54px; TOP: 14px" >
<PARAM NAME="CommPort" VALUE="1"> 
<PARAM NAME="DTREnable" VALUE="1"> 
<PARAM NAME="Handshaking" VALUE="0"> 
<PARAM NAME="InBufferSize" VALUE="1024"> 
<PARAM NAME="InputLen" VALUE="0"> 
<PARAM NAME="NullDiscard" VALUE="0"> 
<PARAM NAME="OutBufferSize" VALUE="512"> 
<PARAM NAME="ParityReplace" VALUE="?"> 
<PARAM NAME="RThreshold" VALUE="1"> 
<PARAM NAME="RTSEnable" VALUE="1"> 
<PARAM NAME="SThreshold" VALUE="2"> 
<PARAM NAME="EOFEnable" VALUE="0"> 
<PARAM NAME="InputMode" VALUE="0"> 

<PARAM NAME="DataBits" VALUE="8"> 
<PARAM NAME="StopBits" VALUE="1"> 
<PARAM NAME="BaudRate" VALUE="19200"> 
<PARAM NAME="Settings" VALUE="19200,N,8,1">
</OBJECT> 

<body>
<form name="form1"> 
<input type="submit" name="Submit" value="�ύ" onClick="OpenPort()">
<input type="text" name="txtReceive" size=50 value="">
</form> 
</body> 
</html> 