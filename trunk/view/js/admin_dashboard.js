
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

function add_sport_page(){
	var data = '<hr/> <br/><div>sport name<br/><form><input id="name" type="text" /><br/>description<br/><textarea id="description" style="width: 632px; height: 50px;"></textarea><br/></form><button class="btn btn-primary" onClick="add_sport()">add sport</button><button class="btn btn-success" onClick="get_manage_sports()">cancel</button></div>'
	$("#main-part").html(data);
}



function add_sport(){
	var name = $('#name').val();
	var description = $('#description').val();
	$.ajax({
		url: 'admin_add_sport.php',
		type: 'POST',
		data: {'name':name, 'description':description},
		success: function(data){
			$('#main-part').html(data);
		}
	})
}

function delete_sport(sid){
	$.ajax({
		url: 'admin_delete_sport.php',
		type: 'POST',
		data:{'sid':sid},
		success: function(data){
			$('#main-part').html(data);
		}
		
	})
}

function delete_user(uid){
	if (confirm("Are you sure that you want to delete this user?")){
		$.ajax({
		url: 'admin_delete_user.php',
		type: 'POST',
		data: {'uid': uid},
		success: function(data){
			$("#main-part").html(data);
		}
	})}
}



function delete_game(gid){
	
	$.ajax({
		url: 'admin_delete_game.php',
		type: "POST",
		data: {'gid': gid },
		success: function(data){
			$("#main-part").html(data);
		}
	
	})
}

function update_sport(sid){
	var name = $('#name').val();
	var description = $('#description').val();
	$.ajax({
		url: 'admin_update_sport.php',
		type: 'POST',
		data: {'sid':sid, 'name':name, 'description':description},
		success:function(data){
			$("#main-part").html(data);
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
	$.ajax({
		url: 'admin_manage_system.php',
		type: 'GET',
		datatype:"html",
		success: function(data){
			$("#main-part").html(data);
		}
		
	});
}


function get_send_announcement(){
	
	
	
}

$(document).ready(get_manage_users);





