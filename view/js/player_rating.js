function init_rating_widgets() {
	
	init_rating_widget($(".player-rating-avg"));
	init_rating_widget($(".player-rating-user"));
	init_rating_widget($(".organizer-rating-avg"));
	init_rating_widget($(".organizer-rating-user"));
}

$(document).ready(init_rating_widgets);