window.onload = function(){
	function mousePosition(ev) {	//获取鼠标点击事件时鼠标所在的位置
		if(ev.pageX || ev.pageY) {	//非IE
			return {x:ev.pageX, y:ev.pageY};
		} else {	//IE
			return {
				x:ev.clientX + document.body.scrollLeft - document.body.clientLeft,
				y:ev.clientY + document.body.scrollTop - document.body.clientTop
			};
		}
	}   
                           
	function ContextMenu(ev){
/*		ev = ev || window.event;
		var mousePos = mousePosition(ev);
		var menu = document.getElementById("menu");
		menu.style.display = "block";	//设置菜单可见
		menu.style.top = mousePos.y-10 + "px";	//设置菜单位置为鼠标右击的位置
		menu.style.left = mousePos.x-7 + "px";*/
		return false;
	}
	
	document.oncontextmenu = ContextMenu;	//绑定菜单事件   
	
	$("#table1 tbody tr").mousedown(function(event){
		if(event.button == 2) {
			var mousePos = mousePosition(event);
			var menu = document.getElementById("menu");
			menu.style.display = "block";	//设置菜单可见
			menu.style.top = mousePos.y-10 + "px";	//设置菜单位置为鼠标右击的位置
			menu.style.left = mousePos.x-7 + "px";
		} 
	});
	                                   
	document.onclick = function() {	//右击清除弹出菜单
		var menu = document.getElementById("menu");   
	    menu.style.display = "none";
	};
};

