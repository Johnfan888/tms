window.onload = function(){
	function mousePosition(ev) {	//��ȡ������¼�ʱ������ڵ�λ��
		if(ev.pageX || ev.pageY) {	//��IE
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
		menu.style.display = "block";	//���ò˵��ɼ�
		menu.style.top = mousePos.y-10 + "px";	//���ò˵�λ��Ϊ����һ���λ��
		menu.style.left = mousePos.x-7 + "px";*/
		return false;
	}
	
	document.oncontextmenu = ContextMenu;	//�󶨲˵��¼�   
	
	$("#table1 tbody tr").mousedown(function(event){
		if(event.button == 2) {
			var mousePos = mousePosition(event);
			var menu = document.getElementById("menu");
			menu.style.display = "block";	//���ò˵��ɼ�
			menu.style.top = mousePos.y-10 + "px";	//���ò˵�λ��Ϊ����һ���λ��
			menu.style.left = mousePos.x-7 + "px";
		} 
	});
	                                   
	document.onclick = function() {	//�һ���������˵�
		var menu = document.getElementById("menu");   
	    menu.style.display = "none";
	};
};

