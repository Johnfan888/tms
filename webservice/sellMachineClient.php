<?php
 $soap = new SoapClient(null, array('location'=>'http://61.187.190.148:27777/tms/webservice/sellMachine.php','uri' =>'http://192.168.100.200/tms/webservice/'));     
 echo urldecode($soap->GetSysTime());
 echo urldecode($soap->GetTicketNo('admin'));
// echo urldecode($soap->GetNode('10001'));
 //echo urldecode($soap->GetSchema('10001','10002','2014-04-20')); 
// echo $soap->TicketLock('10001','10002','1011021','2014-04-22','1','1','10000462','admin');
// echo $soap->TicketUnlock('1398178559'); 
//echo $soap->TicketUpdate('1398179793','10000462');
//	echo $soap->Ticketconfirm('10000462');
//	echo $soap->TicketList('订单号','D1404231398182424');
//	echo $soap->TicketPrint('D1404231398182424','1398183581D3','10000463') 
?>
