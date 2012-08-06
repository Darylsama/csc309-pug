function init_profile() {
	init_rating_widget($(".player-rating-avg"));
	init_rating_widget($(".organizer-rating-avg"));
}

$(document).ready(init_profile);