/**
 * click handler for selecting user into pick-up games
 */
function select_user() {

	$.each($(".select-player"), function(index, sublink) {
		$(sublink).click(function(event) {
			$("#uid-field").val($(this).attr("id"));
			$("#select-form").submit();
			
			// has to return false to suppress link default action
			return false;
		});
	});
}

$(document).ready(select_user);

