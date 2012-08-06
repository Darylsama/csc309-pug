function init_datepicker() {

	var tomorrow = new Date();
	tomorrow.setDate(tomorrow.getDate() + 1);

	$("#startdate-input").datepicker({minDate: tomorrow});
}


$(document).ready(init_datepicker);

