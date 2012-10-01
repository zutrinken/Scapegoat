$(document).ready(function(){
	$('.menu-toggle').smoothScroll().click(function () {
		$('#main-nav div').slideToggle('200');
	});
	$('li.depth-1').has('ul.children').addClass('comment-group');
	/* Dynamic equal width in Footer-Menu */
	var n = 100 / ($('#footer_navigation ul li').length - $('#footer_navigation ul ul li').length);
	$('#footer_navigation ul li').css('width', n + '%');
	$('.article').fitVids();
	$('#front-page-slider').before('<a id="prev" class="toggling">&laquo;</a><a id="next" class="toggling">&raquo;</a>').cycle({
		activePagerClass	: 'activeSlide',
		speed				: 1000,
		timeout				: 6000,
		fx					: 'scrollHorz',
		easeIn				: 'easeInOutQuad',
		easeOut				: 'easeInOutQuad',
		prev				: '#prev',
		next				: '#next'
	});
	if($.cookie('keks') == 'true') {
		$('.toggling').hide();
	} else {
		$('.toggling').show();
	};
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