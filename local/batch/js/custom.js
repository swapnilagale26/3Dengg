function refreshPage(){
SelectBatch();
}

function trainer2_dropdown(){
	var selectedtrainer = $('#id_trainer1').val();
	$.ajax({
		url: M.cfg.wwwroot+"/local/batch/ajax.php",       
		data: {selectedtrainer:selectedtrainer},     
		type: "POST",
		success:function(result){
			$("#id_trainer2").html(result);  
		}
	});
}

// function trainer1_dropdown(){
// 	var selectedtrainer = $('#id_trainer2').val();
// 	$.ajax({
// 		url: M.cfg.wwwroot+"/local/batch/ajax.php",       
// 		data: {selectedtrainer:selectedtrainer},     
// 		type: "POST",
// 		success:function(result){
// 			$("#id_trainer1").html(result);  
// 		}
// 	});
// }

function SelectCenter(){
	var center = $('#id_center_name').val();
	$.ajax({
		url: M.cfg.wwwroot+"/local/batch/ajax.php",       
		data: {center:center},     
		type: "POST",
		success:function(result){
			$("#id_lab").html(result);  
		}
	});
}

function SelectBatch(){
	var bcenter = $('#id_center_name').val();
	var lab = $('#id_lab').val();
	var start1 = $('#id_start_date_day').val();
	var start2 = $('#id_start_date_month').val();
	var start3 = $('#id_start_date_year').val();
	var end1 = $('#id_end_date_day').val();
	var end2 = $('#id_end_date_month').val();
	var end3 = $('#id_end_date_year').val();

	var startdate = start3+'.'+start2+'.'+start1;

	var enddate = end3+'.'+end2+'.'+end1;

	var start = Math.floor(new Date(startdate).getTime() / 1000);

	var end = Math.floor(new Date(enddate).getTime() / 1000);

	$.ajax({
		url: M.cfg.wwwroot+"/local/batch/ajax.php",       
		data: {bcenter:bcenter,lab:lab,start:start,end:end},     
		type: "POST",
		success:function(result){
			msg = $.parseJSON(result);
			$("#id_course_name").html(msg.first);
			$("#labavailibility").html(msg.second);   
		}
	});

}

function StartDate(){
	var start = $('#startdate').val();
	var end = $('#enddate').val();
	var batch = $('#id_batch').val();
	$.ajax({
		url: M.cfg.wwwroot+"/local/batch/ajax.php",       
		data: {start:start,end:end,batch:batch},     
		type: "POST",
		success:function(result){
			$("#id_student").html(result);  
		}
	});
}

function EndDate(){
	var start = $('#startdate').val();
	var end = $('#enddate').val();
	var batch = $('#id_batch').val();
	$.ajax({
		url: M.cfg.wwwroot+"/local/batch/ajax.php",       
		data: {start:start,end:end,batch:batch},
		type: "POST",
		success:function(result){
			$("#id_student").html(result);  
		}
	});
}

$(document).ready(function(){
	countFunction();
});

function countFunction(){
	var count = $("#id_student :selected").length;
	var htmll = '<h4>Selected Users: '+ count +'</h4>';
	$("#selectedcount").html(htmll);
}


function SelectTrainer1(){
	var trainer1 = $('#id_trainer1').val();
	var start1 = $('#id_start_date_day').val();
	var start2 = $('#id_start_date_month').val();
	var start3 = $('#id_start_date_year').val();
	var end1 = $('#id_end_date_day').val();
	var end2 = $('#id_end_date_month').val();
	var end3 = $('#id_end_date_year').val();

	trainer2_dropdown();

	var startdate = start3+'.'+start2+'.'+start1;

	var enddate = end3+'.'+end2+'.'+end1;

	var start = Math.floor(new Date(startdate).getTime() / 1000);

	var end = Math.floor(new Date(enddate).getTime() / 1000);
	$.ajax({
		url: M.cfg.wwwroot+"/local/batch/ajax.php",       
		data: {trainer1:trainer1,start:start,end:end},
		type: "POST",
		success:function(result){
			$("#trainer1availibility").html(result);
		}
	});
}

function SelectTrainer2(){
	var trainer2 = $('#id_trainer2').val();
	var start1 = $('#id_start_date_day').val();
	var start2 = $('#id_start_date_month').val();
	var start3 = $('#id_start_date_year').val();
	var end1 = $('#id_end_date_day').val();
	var end2 = $('#id_end_date_month').val();
	var end3 = $('#id_end_date_year').val();


	var startdate = start3+'.'+start2+'.'+start1;

	var enddate = end3+'.'+end2+'.'+end1;

	var start = Math.floor(new Date(startdate).getTime() / 1000);

	var end = Math.floor(new Date(enddate).getTime() / 1000);
	$.ajax({
		url: M.cfg.wwwroot+"/local/batch/ajax.php",       
		data: {trainer2:trainer2,start:start,end:end},
		type: "POST",
		success:function(result){
			$("#trainer2availibility").html(result);
		}
	});
}