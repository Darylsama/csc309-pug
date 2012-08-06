function init_profile() {
	
	init_rating_widget($(".player-rating-avg"));
	init_rating_widget($(".organizer-rating-avg"));
	
	init_rating_widget($(".player-rating"));
	init_rating_widget($(".organizer-rating"));
}

$(document).ready(init_profile);