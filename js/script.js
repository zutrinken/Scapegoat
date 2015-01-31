(function ($, document, window) {
	$(document).ready(function () {

		/* Small OS Detection Function */
		var isMobile = {
		    Android: function() {
		        return navigator.userAgent.match(/Android/i);
		    },
		    BlackBerry: function() {
		        return navigator.userAgent.match(/BlackBerry/i);
		    },
		    iOS: function() {
		        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		    },
		    Opera: function() {
		        return navigator.userAgent.match(/Opera Mini/i);
		    },
		    Windows: function() {
		        return navigator.userAgent.match(/IEMobile/i);
		    },
		    any: function() {
		        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		    }
		};

		/* Parallax for header and slider images*/
		if(!isMobile.any()) {
			parallaxScroll();
			$(window).scroll(parallaxScroll);
		}
		function parallaxScroll() {
			/* Get scrolled distance */
			var scrolled = $(window).scrollTop();
			scrolled = Math.round(scrolled);
			
			/* Manipulate the header and slider images */
			var prlx = $('.parallax');
			if(prlx.length>0) {
				var parallaxOffset = prlx.offset().top;
				parallaxOffset = Math.round(parallaxOffset) + 10;

				if(scrolled >= parallaxOffset) {
					parallaxOffset = Math.round(0+((scrolled - parallaxOffset) * 0.75));
					var opacity = 1 - parallaxOffset / 500;

					prlx.find('img').css({
						'-webkit-transform' : 'translate3d(0px, ' + parallaxOffset + 'px, 0px)',
						'transform' : 'translate3d(0px, ' + parallaxOffset + 'px, 0px)',
						'opacity' : opacity
					});
				} else {
					prlx.find('img').css({
						'-webkit-transform' : 'translate3d(0px, 0px, 0px)',
						'transform' : 'translate3d(0px, 0px, 0px)',
						'opacity' : '1'
					});
				}
			}

			/* Manipulate the slider bakcground images */

			var frPaSl = $('.front-page-slide');
			if(frPaSl.length>0) {
				var frPaSlOffset = frPaSl.offset().top;
				frPaSlOffset = Math.round(frPaSlOffset) + 10;
				
				if(scrolled >= frPaSlOffset) {
					frPaSlOffset = Math.round(0+((scrolled - frPaSlOffset) * 0.75));
					var opacity = 1 - frPaSlOffset / 500;

					frPaSl.css({
						'background-position' : 'center ' + frPaSlOffset + 'px',
						'opacity' : opacity
					});
				} else {
					frPaSl.css({
						'background-position' : 'center 0',
						'opacity' : '1'
					});
				}
				
			}

		}

		function SameHeight() {
			var maxHeight1 = -1;
			var footerWidget = $('.footer-sidebar-inside');
			var heights1 = footerWidget.map(function () {
				return $(this).height();
			}).get(),
			maxHeight1 = Math.max.apply(null, heights1);
			footerWidget.each(function() {
				$(this).height('auto');
				$(this).height(maxHeight1);
			});

			var maxHeight2 = -1;
			var footerList = $('#footer_navigation li').not('#footer_navigation li li');
			var heights2 = footerList.map(function () {
				return $(this).height();
			}).get(),
			maxHeight2 = Math.max.apply(null, heights2);
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
				pauseText:			'<i class="fa fa-pause"></i>',
				playText:			'<i class="fa fa-play"></i>',
				prevText:			'<i class="fa fa-chevron-left"></i>',
				nextText:			'<i class="fa fa-chevron-right"></i>',
				controlsContainer:	'#front-page-slider-control-inside', 
				start:				function(slider) {
										$('body').removeClass('loading');	
									}
			});
		}
	});
}(jQuery, document, window))