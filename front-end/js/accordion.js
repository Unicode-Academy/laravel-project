$(document).ready(function () {
	$(".accordion-group .accordion-title").click(function () {
		if ($(this).hasClass("active")) {
			$(this).removeClass("active");
			$(this).siblings(".accordion-group .accordion-detail").slideUp();
		} else {
			$(".accordion-group .accordion-title").removeClass("active");
			$(this).addClass("active");
			$(".accordion-detail").slideUp();
			$(this).siblings(".accordion-detail").slideDown();
		}
	});
});
