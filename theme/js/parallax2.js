jQuery(function( $ ){

	// Enable parallax and fade effects on homepage sections
	$(window).scroll(function(){

		scrolltop = $(window).scrollTop()
		scrollwindow = scrolltop + $(window).height();

		if ( $("#text-15").length ) {
		
			textfifteenoffset = $("#text-15").offset().top;		  

			if( scrollwindow > textfifteenoffset ) {

				// Enable parallax effect
				backgroundscroll = scrollwindow - textfifteenoffset;
				$("#text-15").css("backgroundPosition", "0px " + -(backgroundscroll/6) + "px");

			}
		
		}

	});

});