$(document).ready(function(){
	/* Cut the first image of the category description and set it as a featured image */
	/* This method is realy crappy, but I don't want more horrible php/mysql in this theme or a need of plugins */
	if($('.category-description').find('img') && $('.category-description').length>0) {
		$('#content').prepend('<figure class="page-image"></figure>');
		$('.category-description').find('img').first().appendTo('.page-image');
		$('.category-description').find('.meta-thumbnail-caption').appendTo('.page-image');
	}

	/* Toggle Menu */
	$('.menu-toggle').smoothScroll().click(function () {
		$('#main-nav div').slideToggle('200');
	});
	function arrr() {
		/* Navigation Font Size */
		var holo = 0.75 + ($('#main-nav').width() / 2000);
		$('#main-nav').css({'font-size': holo + 'em'});
	}
	arrr();
	$(window).resize(arrr);
	
	/* Extra Class for smarter comment structure */
	$('li.depth-1').has('ul.children').addClass('comment-group');

	/* Dynamic equal width in Footer-Menu */
	var n = 100 / ($('#footer_navigation ul li').length - $('#footer_navigation ul ul li').length);
	$('#footer_navigation ul li').css('width', n + '%');

	/* Responsive Youtube/Vimeo Videos */
	$('.article').fitVids();

	/* Check if Slider exists */
	if($('#front-page-slider').length>0) {
		/* Slider on Frontpage */
		$('#front-page-slider').before('<a id="prev" class="toggling">&laquo;</a><a id="next" class="toggling">&raquo;</a>').after('<nav id="slide-pager"></nav>').cycle({
			activePagerClass	: 'activeSlide',
			speed				: 1000,
			timeout				: 6000,
			fx					: 'scrollHorz',
			easeIn				: 'easeInOutQuad',
			easeOut				: 'easeInOutQuad',
			prev				: '#prev',
			next				: '#next',
			pager				: '#slide-pager'
		});

		/* Cookie if Slider is hidden */
		if($.cookie('keks') == 'true') {
			$('.toggling').hide();
		} else {
			$('.toggling').show();
		};

		/* Toggle the Slider */
		$('#front-page-slider-toggle').click(function() {
			if($('.toggling').css('display') == 'block') {
				$.cookie('keks','true');
				$('.toggling').slideUp(500, function() {});
			} else {
				$.cookie('keks','false');
				$('.toggling').slideDown(500, function() {});
			}
		});
	}
});