(function ($, document, window) {
	$(document).ready(function () {
		
		/* Parallax for header and slider images*/
		$(window).scroll(parallaxScroll);
		function parallaxScroll() {

			/* Get scrolled distance */
			var scrolled = $(window).scrollTop();
			scrolled = Math.round(scrolled);

			/* Manipulate the header and slider images */
			var prlx = $('.parallax')
			var parallaxOffset = prlx.offset().top;
			parallaxOffset = Math.round(parallaxOffset);

			if(scrolled >= parallaxOffset) {
				prlx.find('img').css({
					'top' : (0+((scrolled - parallaxOffset) * 0.75))+'px'
				});
			} else {
				prlx.find('img').css({		
					'top' : 0
				});
			}

			/* Manipulate the slider bakcground images */
			var frPaSl = $('.front-page-slide');
			var frPaSlOffset = frPaSl.offset().top;
			frPaSlOffset = Math.round(frPaSlOffset);
			
			if(scrolled >= frPaSlOffset) {
				frPaSl.css({
					'background-position' : 'center ' + (0+((scrolled - frPaSlOffset) * 0.75))+'px'
				});
			} else {
				frPaSl.css({
					'background-position' : 'center ' + 0
				});
			}
		}
		function SameHeight() {
			var maxHeight1 = -1;
			var footerWidget = $('.footer-sidebar-inside');
			maxHeight1 = maxHeight1 > footerWidget.height() ? maxHeight1 : footerWidget.height();
			footerWidget.each(function() {
				$(this).height('auto');
				$(this).height(maxHeight1);
			});
			
			var maxHeight2 = -1;
			var footerList = $('#footer_navigation li').not('#footer_navigation li li');
			maxHeight2 = maxHeight2 > footerList.height() ? maxHeight2 : footerList.height();
			footerList.each(function() {
				$(this).height('auto');
				$(this).height(maxHeight2);
			});
			/* Dynamic equal width in Footer-Menu */
			var c = footerList.length;
			var n = 100 / c;
			if(($(window).width() < 960) && ($(window).width() > 640)) {
				switch(c) {
					case (c = 4 || 8):
						footerList.css('width', '25%');
						break;
					case (c = 6 || 9):
						footerList.css('width', '33.333%');
						break;
					default:
						footerList.css('width', n + '%');
				}
			} else {
				switch(c) {
					case (c == 4 || 8):
						footerList.css('width', '25%');
						break;
					case (c == 12):
						footerList.css('width', '16.666%');
						break;
					case (c == 5 || 10 || 15):
						footerList.css('width', '20%');
						break;
					default:
						footerList.css('width', n + '%');
				}
			}
		}
		SameHeight();
		$(window).resize(SameHeight);

		/* Dynamic equal width for Featured Links */
		var feLi = $('#featured-links li');
		var feLiCn = 100 / (feLi.length);
		feLi.css('width', feLiCn + '%');

		/* Responsive Youtube/Vimeo Videos */
		$('.article').fitVids();
		$('.post-video').fitVids();

		/* Check if Slider exists */
		var frPaSl = $('#front-page-slider')
		if(frPaSl.length>0) {
			/* Slider on Frontpage */
			frPaSl.flexslider({
				slideshow:			true,
				useCSS:				false,
				animation:			'slide',
				direction:			'horizontal',
				animationSpeed:		750,
				easing:				'easeOutExpo',
				reverse:			false,
				touch:				true,
				keyboard:			true,
				pauseOnAction:		false,
				pauseOnHover:		false,
				pausePlay:			true,
				controlsContainer:	'#front-page-slider-control-inside', 
				start:				function(slider) {
										$('body').removeClass('loading');	
									}
			});
		}
	});
}(jQuery, document, window))