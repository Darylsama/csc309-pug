

function get_received_messages(){
	
	$.ajax({
		url: "get_received_messages.php";
		type: "GET";
		success: function(data){
			$("#main-part").html(data);
		}
		
	});
	
}

function get_send_messages(){
	$.ajax({
		url: "get_send_messages.php";
		type: "GET";
		success: function(data){
			$("#main-part").html(data);
		}
		
	});
}

$(document).ready(get_received_message);