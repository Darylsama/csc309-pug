function RefreshTable(tableId, urlData) {
	
    //Retrieve the new data with $.getJSON. You could use it ajax too
    $.getJSON(urlData, null, function(json) {
    	
    	var table = $(tableId).dataTable();
    	table.fnClearTable(this);
    	
    	for (var row in json.aaData) {
    	    table.fnAddData(json.aaData[row]);
    	}
    	
    	table.fnDraw();
    });
}

function init_list_user_page() {
	
	$("#user_table").dataTable({
		"bProcessing": true,
		"sAjaxSource": 'json_all_users.php?user-class=all'
	});
	
	$("#all").click(function() {
		RefreshTable("#user_table", "json_all_users.php?user-class=all");
	});
	
	$("#friends").click(function() {
		RefreshTable("#user_table", "json_all_users.php?user-class=friends");
	});
	
}

$(document).ready(init_list_user_page);