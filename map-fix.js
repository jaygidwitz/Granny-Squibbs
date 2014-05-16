(function fixMapDisplay($){

	var checker = setInterval(function(){

		var $mapCanvas = $('#map_canvas');
		
		if ($mapCanvas.find('.gm-style').length > 0) {

			$mapCanvas.addClass('animated fade-up-in');

			clearInterval(checker);
		}

	}, 1000);

})(jQuery);