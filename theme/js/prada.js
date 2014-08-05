(function stickyFooter($){

	function stickToBottom () {

		var $footer = $('.foot');

		// If the body is smaller than the window
		// stick the footer to the bottom

		if($(window).height()>$('body').height()) {

			$footer.css({
				'position':'fixed',
				'bottom': 0,
				'width': '100%'
			});
			
		} else {
			$footer.removeAttr('style');
		}
	}

	// On DOM Ready on pages without Envira Gallery
	if ($('.pd-dynamic-footer').length === 0) {
		stickToBottom();
		// On Resize
		$(window).resize(stickToBottom);
	}
})(jQuery);

(function animatedBgHomepage($){
	
	var $body = $('body');
	
	if($body.hasClass('home') && $body.width()>=1025) {

		var $background = $('<div id="homepageNavBg"></div>');
		$('#nav_menu-2, #text-7, #nav_menu-3').clone().appendTo($background);
		$background.prependTo($body);

		$('#text-2').waypoint(function(){
			$background.toggleClass('online');
		});
	}

})(jQuery);

(function moveSocialIcons($){

	var $rightMenu = $('#menu-right-menu-all, #menu-right-menu-home');
	var $icons = $('#simple-social-icons-2');

	if (!$('body').hasClass('home')) {
		$icons.addClass('not-home');
	}

	$icons.find('a').attr('target','_blank');

	$rightMenu.find('li').last()
		.clone()
		.addClass('simple-social-li')
		.appendTo($rightMenu)
		.empty()
		.append($icons);

})(jQuery);

(function sideMenu($){

	// Add mobile icon
	$('.site-header').find('.wrap').append('<a class="fa fa-bars" id="mobileNavOpen" href="Javascript:void(0);"></a>');

	// Create a hidden div that unites all navigation lnks
	var $hiddenNav = $('<ul id="hiddenNav" style="display:none;"></ul>');
	var $hiddenNavContent;

	if ($('body').hasClass('home')) {

		var $temp;

		$hiddenNavContent = $('#menu-left-menu-home').clone().detach();
		$hiddenNavContent.children('li').each(function(){
			var $this = $(this);
			$this.prependTo($this.parent());
		});

		$temp = $('#menu-right-menu-home').clone().detach();
		$hiddenNavContent.append($temp.children('li'));


	} else {
		$hiddenNavContent = $('#menu-left-menu-all, #menu-right-menu-all');
	}

	$hiddenNavContent.children('li').clone().appendTo($hiddenNav);

	$hiddenNav.appendTo($('body'));

	var jPM = $.jPanelMenu({
		menu: '#hiddenNav',
		trigger: '#mobileNavOpen',
		direction: 'right'
	});

	jPM.on();

})(jQuery);