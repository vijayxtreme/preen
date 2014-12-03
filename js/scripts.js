$(function(){

	$(".links").on('click', function(e){
		e.preventDefault();
		 $("html, body").animate({ scrollTop: 0 }, 600);
	});

	$(".close, #item-window").on('click', function() {
		$("#item-window").css("display", "none");
	});

	$(".shelf").on('click', function(){
		alert("The Menu, set me up!");
	});

});