
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

function edit_sport(sid){
	$.post(
		'admin_edit_sport.php',
		{'sid': sid},
		function(data){
			$("#main-part").html(data);
		}
	);	
	
}

function delete_sport(){
	$.ajax({
		url: 'admin_delete_sport.php',
		type: 'POST',
		success:function(data){
			if (data == ''){
				
			}
			else{
				$("#main-part").html(data);
			}
			
		}
	})
	
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


