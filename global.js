(function stickyFooter($){

	var stickyClass = 'sticky-bottom';

	function stickToBottom () {

		var $siteFooter   = $('.site-footer');
		var $beforeFooter = $('.before-footer');
		var $both         = $siteFooter.add($beforeFooter);

		if($(window).height()>$('body').height()) {

			if(!$both.hasClass(stickyClass)) {
				$both.addClass(stickyClass);
			}
			
			$beforeFooter.css('bottom', $siteFooter.outerHeight());
			$siteFooter.css('bottom', 0);

		} else {

			$both.css('bottom','');
			$both.removeClass(stickyClass);

		}

	}

	// On DOM Ready
	stickToBottom();
	
	// On Resize
	$(window).resize(stickToBottom);


})(jQuery);