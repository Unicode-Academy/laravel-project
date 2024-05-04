$(".nav p").on("click", function () {
	$([$(".nav p")[$(this).index()], $(".group .title")[$(this).index()]])
		.addClass("active")
		.siblings()
		.removeClass("active");
});
