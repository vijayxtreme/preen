//JQuery Plugin for 2 functions on toggle
(function($) {
    $.fn.clickToggle = function(func1, func2) {
        var funcs = [func1, func2];
        this.data('toggleclicked', 0);
        this.click(function() {
            var data = $(this).data();
            var tc = data.toggleclicked;
            $.proxy(funcs[tc], this)();
            data.toggleclicked = (tc + 1) % 2;
        });
        return this;
    };
}(jQuery));


$(function(){
	var h = $(document).height();
	var w = $(document).width();

	if(w>667){
		var photoH = w * 3/4;
		$(".photos").css({
			"height":photoH
		})
	}
	var cssObj = {
		"height": h
	};

	$("#mobile_nav").css(cssObj);

	$(".shelf").clickToggle(function(){
			$("#mobile_nav").show();
			$("#mobile_nav").css({
				"width":"30%"
			});
			$("#main_body").css({
				"width":"70%"
			});
		}, function (){
			$("#mobile_nav").hide();

			$("#mobile_nav").css({
				"width":"0%"
			});
			$("#main_body").css({
				"width":"100%"
			});
		});

	$(".links").on('click', function(e){
		e.preventDefault();
		 $("html, body").animate({ scrollTop: 0 }, 600);
		 $(".white_overlay").height(h);
	});

	//Allows for touch to close the window too.
	$("#photo").on('click', function() {
		$("#item-window").css("display", "none");
	});

	//Upload Page
	$("#client-list").on('click', function(){
		$("#input-area").toggle();
		$("#tags-area").hide();
	});
	$("#tags-list").on('click', function(){
		$("#tags-area").toggle();
		$("#input-area").hide();
	});
	
	//Remove Hardcoded WP Table Style
	$("#press table div").attr('style',"");


	//Press Mouseover & Click
	$(function(){
		$("#press p").hide();

		var idx=$("#press a:first");
		var text = $(idx).siblings();
		//console.log(text);
		var txt = "";
		text.each(function(k, v){
			if(v.innerHTML=="&nbsp;"){
				//
			}else{
				txt += v.outerHTML;
			}

		});
		
		var pressPanel = $("#press-panel");
		pressPanel.html(txt);
		var link = $(idx).attr('href');
		var linked = "<a target='_blank' href='"+link+"'>"+link+"</a>";
		$("#press-panel").append(linked);
		$("#press-panel p").show();

	
		$("#press a").mouseover(function(){
		
			var idx=$(this);
			var text = $(this).siblings();
			//console.log(text);
			var txt = "";
			text.each(function(k, v){
				if(v.innerHTML=="&nbsp;"){
					//
				}else{
					txt += v.outerHTML;
				}

			});
			//console.log(txt);
			var pressPanel = document.getElementById('press-panel');
			pressPanel.innerHTML = txt;
			var link = $(this).attr('href');
			var linked = "<a target='_blank' href='"+link+"'>"+link+"</a>";
			$("#press-panel").append(linked);
			$("#press-panel p").show();
		});


		$("#press a").click(function(e){
			e.preventDefault();
			 $("html, body").animate({ scrollTop: 0 }, "slow");
			var idx=$(this);
			var text = $(this).siblings();
			//console.log(text);
			var txt = "";
			text.each(function(k, v){
				if(v.innerHTML=="&nbsp;"){
					//
				}else{
					txt += v.outerHTML;
				}

			});
			
			//console.log(txt);
			
			pressPanel.innerHTML = txt;
			var link = $(this).attr('href');
			var linked = "<a target='_blank' href='"+link+"'>"+link+"</a>";
			$("#press-panel").append(linked);

			$("#press-panel p").show();

		});
	});

	
});