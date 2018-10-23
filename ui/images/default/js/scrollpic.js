/*
var speed=30  
  center2.innerHTML=center1.innerHTML //克隆center1为center2  
  function Marquee(){  
//当滚动至center1与center2交界时  
if(center2.offsetTop-center.scrollTop<=0)   
center.scrollTop+=center1.offsetHeight //center跳到最顶端  
else{  
center.scrollTop-- 
  }  
  }  
  var MyMar=setInterval(Marquee,speed)//设置定时器  
//鼠标移上时清除定时器达到滚动停止的目的  
  center.onmouseover=function() {clearInterval(MyMar)}  
//鼠标移开时重设定时器  
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
	
	/*    以下是从右往左的滚动代码      */
var speed3=10//速度数值越大速度越慢
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

