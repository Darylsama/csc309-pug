

function init_select_sport() {
	
	$("#available-sports li:not(.nav-header)").click(function () {

		// remove this from the available games list
		$(this).remove();
		
		// add this to the selected games list
		$(this).appendTo("#user-sports ul");
		
		// re-attach event listener
		
		// add a hidden element in to the queue
		var sid = $(this).attr("data-sid");
		$("<input type='hidden' name='sports[]' value='" + sid +  "' />").appendTo("#sports-queue");
	});
}

$(document).ready(init_select_sport);