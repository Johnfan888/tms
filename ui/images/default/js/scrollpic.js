/*
var speed=30  
  center2.innerHTML=center1.innerHTML //��¡center1Ϊcenter2  
  function Marquee(){  
//��������center1��center2����ʱ  
if(center2.offsetTop-center.scrollTop<=0)   
center.scrollTop+=center1.offsetHeight //center�������  
else{  
center.scrollTop-- 
  }  
  }  
  var MyMar=setInterval(Marquee,speed)//���ö�ʱ��  
//�������ʱ�����ʱ���ﵽ����ֹͣ��Ŀ��  
  center.onmouseover=function() {clearInterval(MyMar)}  
//����ƿ�ʱ���趨ʱ��  
  center.onmouseout=function(){MyMar=setInterval(Marquee,speed)}  
  */
  
 /*
    var speed=30  
    center2.innerHTML=center1.innerHTML  
    center.scrollTop=center.scrollHeight  
    function Marquee(){  
    if(center1.offsetTop-center.scrollTop>=0)  
    center.scrollTop+=center2.offsetHeight  
    else{  
    center.scrollTop--  
    }  
    }  
    var MyMar=setInterval(Marquee,speed)  
    center.onmouseover=function() {clearInterval(MyMar)}  
    center.onmouseout=function() {MyMar=setInterval(Marquee,speed)} 
	
	/*    �����Ǵ�������Ĺ�������      */
var speed3=10//�ٶ���ֵԽ���ٶ�Խ��
scrollpic2.innerHTML=scrollpic1.innerHTML
function Marquee(){
if(scrollpic2.offsetWidth-scrollpic.scrollLeft<=0)
scrollpic.scrollLeft-=scrollpic1.offsetWidth
else{
scrollpic.scrollLeft++
}
}
var MyMar=setInterval(Marquee,speed3)
scrollpic.onmouseover=function() {clearInterval(MyMar)}
scrollpic.onmouseout=function() {MyMar=setInterval(Marquee,speed3)}

