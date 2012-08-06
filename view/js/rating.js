/**
 * initialize a div into a rating widget
 * depending on the widget-style, various styles will be implemented
 */
function init_rating_widget(wrapper) {
	
	var ratee = $(wrapper).attr("data-ratee");
	var action = $(wrapper).attr("data-action");
	
	var str_value = parseFloat($(wrapper).attr("data-value")).toFixed(1);
	var value = Math.round(str_value);
	
	var comment = $(wrapper).attr("data-comment");
	var option = $(wrapper).attr("data-widget-style");
	
	if (option == 0) {
		// stars only
		
		var txt = [
"<form method='post'>", 
"  <ul class='rating-w-images'>", 
"    <li data-rateval='1'></li>", 
"    <li data-rateval='2'></li>", 
"    <li data-rateval='3'></li>", 
"    <li data-rateval='4'></li>", 
"    <li data-rateval='5'></li>", 
"  </ul>", 
"  <span class='rating-label'>" + str_value + " / 5.0 </span><br />",
"  <input name='value' type='hidden' value='" + value + "'>", 
"</form>"
		].join("\n");
		
		var rating_form = $(txt);
		var rating_widget = rating_form.children(".rating-w-images");
		set_rating(rating_widget, value);
		$(wrapper).append(rating_form);
		
	} else if (option == 1) {
		// stars with comment
		
		var txt = [
"<form method='post'>", 
"  <ul class='rating-w-images'>", 
"    <li data-rateval='1'></li>", 
"    <li data-rateval='2'></li>", 
"    <li data-rateval='3'></li>", 
"    <li data-rateval='4'></li>", 
"    <li data-rateval='5'></li>", 
"  </ul>", 
"  <span class='rating-label'>" + str_value + " / 5.0 </span><br />",
"  <input name='ratee' type='hidden' value='" + ratee + "'>",
"  <input name='value' type='hidden' value='" + value + "'>", 
"  <p>" + comment + "</p>", 
"</form>"
		].join("\n");
	
		var rating_form = $(txt);
		var rating_widget = rating_form.children(".rating-w-images");
		set_rating(rating_widget, value);
		$(wrapper).append(rating_form);
		
		
		
	} else if (option == 2) {
		// stars, comment with form
		
		var txt = [
"<form method='post' action='" + action + "'>", 
"  <ul class='rating-w-images'>", 
"    <li data-rateval='1'></li>", 
"    <li data-rateval='2'></li>", 
"    <li data-rateval='3'></li>", 
"    <li data-rateval='4'></li>", 
"    <li data-rateval='5'></li>", 
"  </ul>", 
"  <span class='rating-label'>" + str_value + " / 5.0 </span><br />",
"  <input name='ratee' type='hidden' value='" + ratee + "'>",
"  <input name='value' type='hidden' value='" + value + "'>", 
"  <textarea name='comment'>" + comment + "</textarea><br />", 
"  <input type='submit' class='btn btn-primary' value='Submit Comment'>", 
"</form>"
		].join("\n");
		
		var rating_form = $(txt);
		var rating_widget = rating_form.children(".rating-w-images");
		set_rating(rating_widget, value);
		add_rating_handler(rating_form);
		$(wrapper).append(rating_form);
	}
}


/**
 * enable user rating for the given widget. That is, enabling hover effects and clicking will save the value to the form
 */
function add_rating_handler(rate_form) {
	
	var widget = rate_form.children(".rating-w-images");
	
	var stars = widget.children();
	var size = stars.size(); // should be 5
	
	$.each($(stars), function(index, staritem) {

		// when mouse over change the appearance
		$(staritem).mouseenter(function(event) {
			// the number that tells the value of the rating, ranges from 1 ~ 5
			var rate_val = $(this).attr("data-rateval");
			set_rating(widget, rate_val);
		});
		
		// revert the rate value back to memo value
		$(staritem).mouseout(function() {
			set_rating(widget, rate_form.children("[name='value']").val());
		});
		
		$(staritem).click(function(event) {
			$(rate_form).children("[name=value]").val($(this).attr("data-rateval"));
		});
		
	});
}


/**
 * change the value for the rating star. use for hovering effect
 * @param widget, the ul widget for the rating starts
 * @param value, the value to be changed to
 */
function set_rating(widget, value) {
	
	var stars = widget.children();
	var size = stars.size(); // should be 5
	
	// change current and all stars to the left of the cursor rated
	for (var i = 0; i < value; i++) {
		$(stars[i]).addClass("rated");;
	}
	// change all stars to the right of the cursor unrated
	for (var i = value; i < size; i++) {
		$(stars[i]).removeClass("rated");
	}
}

