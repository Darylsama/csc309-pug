
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