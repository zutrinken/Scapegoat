$(document).ready(function(){
	/* Toggle Menu */
	$('.menu-toggle').smoothScroll().click(function () {
		$('#main-nav div').slideToggle('200');
	});
	
	$(window).resize(arrr);
	arrr();
	function arrr() {
		/* Navigation Font Size */
		var holo = 0.8 + ($('#main-nav').width() / 2000);
		$('#main-nav').css({'font-size': holo + 'em'});

		/* Description Height */
		var foo = $('#logo').height();
		$('#description').css({'height': foo + 'px'});
	}

	/* Extra Class for smarter comment structure */
	$('li.depth-1').has('ul.children').addClass('comment-group');

	/* Dynamic equal width in Footer-Menu */
	var n = 100 / ($('#footer_navigation ul li').length - $('#footer_navigation ul ul li').length);
	$('#footer_navigation ul li').css('width', n + '%');

	/* Responsive Youtube/Vimeo Videos */
	$('.article').fitVids();

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
});