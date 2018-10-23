var currentStep = 1;
var max_line_num = $("#table1 tr:gt(0)").length;

function up_line(max_line_num){
	if(currentStep == 1) {
		$("#table1 tr:eq(currentStep)").css("background-color","#006699");
		currentStep = max_line_num;
		$("#table1 tr:eq(currentStep)").css("background-color","#FFCC00");
	}
	else {
		$("#table1 tr:eq(currentStep)").css("background-color","#006699");
		currentStep--;
		$("#table1 tr:eq(currentStep)").css("background-color","#FFCC00");
	}
}
	
function down_line(max_line_num){
	if(currentStep == max_line_num) {
		$("#table1 tr:eq(currentStep)").css("background-color","#006699");
		currentStep = 1;
		$("#table1 tr:eq(currentStep)").css("background-color","#FFCC00");
	}
	else {
		$("#table1 tr:eq(currentStep)").css("background-color","#006699");
		currentStep++;
		$("#table1 tr:eq(currentStep)").css("background-color","#FFCC00");
	}
}
