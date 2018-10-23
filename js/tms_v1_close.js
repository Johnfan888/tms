
window.onbeforeunload  = onbeforeunload_handler;
function onbeforeunload_handler(){	
	
	var n=window.event.screenX-window.screenLeft;
	var b=n>document.documentElement.scrollWidth-20;
	if(b&&event.clientY<0||event.altKey)
	{
		//alert('chacha');		
		jQuery.get(
				'../system/tms_v1_close.php',
				function(data){
					//alert(data);
					var objData = eval('(' + data + ')');
					if( objData.sucess=='1'){
						//alert('用户下线成功！');						
					}else{
						//alert('用户下线失败！');
					}
			});					
	}
	else if(event.clientY > document.body.clientHeight ||event.altkey)
		{
		//alert('chacha');		
		jQuery.get(
				'../system/tms_v1_close.php',
				function(data){
					//alert(data);
					var objData = eval('(' + data + ')');
					if( objData.sucess=='1'){
						//alert('用户下线成功！');						
					}else{
						//alert('用户下线失败！');
					}
			});	
		
		
		}
	/*
	if(event.clientX>document.body.clientWidth&&event.clientY<0||event.altKey)
	{
		jQuery.get(
				'../system/tms_v1_close.php',
				function(data){
					alert(data);
					var objData = eval('(' + data + ')');
					if( objData.sucess=='1'){
						alert('用户下线成功！');						
					}else{
						alert('用户下线失败！');
					}
			});
	}*/
}


function DateTime()
{
	var date = new Date();
	this.year = date.getFullYear();
	this.month = date.getMonth() + 1;
	this.date = date.getDate();
	
	this.hour = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
	this.minute = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
	this.second = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
	
	this.toString = function() {
	return "" + this.year + "-" + this.month + "-" + this.date + "  " + this.hour + ":" + this.minute + ":" + this.second + " " + this.day; 
	};	
}


