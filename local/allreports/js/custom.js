function SelectCenter(){
	var center = $('#id_institution').val();
	$.ajax({
		url: M.cfg.wwwroot+"/local/allreports/ajax.php",       
		data: {center:center},     
		type: "POST",
		success:function(result){
			$("#id_batch").html(result);  
			  
		}
	});
}

function Get_Trainers(){
	var center = $('#id_institution').val();
	$.ajax({
		url: M.cfg.wwwroot+"/local/allreports/ajax.php",       
		data: {tcenter:center},     
		type: "POST",
		success:function(result){
			msg = $.parseJSON(result);
			$("#id_trainer").html(msg.first);
			$("#id_lab").html(msg.second);  
		}
	});
}