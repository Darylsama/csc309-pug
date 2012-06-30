/**
 * click handler for selecting user into pick-up games
 */
function select_user() {

	$.each($(".select-player"), function(index, sbutton) {
		$(sbutton).click(function(event) {
			$("#uid-field").val($(this).attr("id"));
			$("#select-form").submit();
		});
	});
}

$(document).ready(select_user);

