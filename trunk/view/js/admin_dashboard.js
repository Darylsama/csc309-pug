
function get_manage_users() {
	$.ajax({ 
		url: 'admin_manage_users.php',
		type:'GET',
		datatype:'html',
		success: function(data){	
			$("#main-part").html(data);
		},
	});
	
}

function get_manage_sports() {
	$.ajax({ 
		url: 'admin_manage_sports.php',
		type:'GET',
		datatype:'html',
		success: function(data){	
			$("#main-part").html(data);
		},
	});
}

function get_manage_games() {
	$.ajax({ 
		url: 'admin_manage_games.php',
		type:'GET',
		datatype:'html',
		success: function(data){	
			$("#main-part").html(data);
		},
	});
}

function get_manage_system(){
	
	
}

function get_send_announcement(){
	
	
}
