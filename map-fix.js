(function fixMapDisplay($){

	function checkAndFadeIn (selector, childSelector) {
		var checker = setInterval(function(){

			var $selector = $(selector);

			if ($selector.find(childSelector).length > 0) {

				$selector.addClass('animated fade-up-in');
				clearInterval(checker);
			}

		}, 1000);
	}

	checkAndFadeIn('#map_canvas','.gm-style');
	checkAndFadeIn('#wpseo-storelocator-results','.wpseo-result');
	
})(jQuery);