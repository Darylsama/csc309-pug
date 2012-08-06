function init_view_game() {
	
	var game_start = $("#show-date");
	
	var start_date = new Date(game_start.attr("data-time") * 1000);
	
	// create date picker widget
	game_start.datepicker();
	
	// set the date for the widget
	game_start.datepicker("setDate", start_date);

}



$(document).ready(init_view_game);