$(function() {

	function accordion() {
		$(this).toggleClass("active").next().slideToggle(300);
	}

	$(".switch .toggle").click(accordion);

});