(function ($, document, window) {
	$(document).ready(function () {
		/* Cut the first image of the category description and set it as a featured image */
		/* This method is realy crappy, but I don't want more horrible php/mysql in this theme or a need of plugins */
		var $categoryDescription = $('.category-description');

		if ($categoryDescription.find('img') && $categoryDescription.length > 0) {
			$('#content').prepend('<figure class="post-image" id="category-image"></figure>');
			$categoryDescription.find('img').first().appendTo('#category-image');
			$categoryDescription.find('.meta-thumbnail-caption').appendTo('#category-image');
		}

		/* Toggle Menu */
		$('.menu-toggle').smoothScroll().click(function () {
			$('#main-nav div').slideToggle('200');
		});

		var $mainNav = $('#main-nav');
		function arrr() {
			/* Navigation Font Size */
			var holo = 0.666 + ($mainNav.width() / 2000);
			$mainNav.css({'font-size':holo + 'em'});
		}

		arrr();
		$(window).resize(arrr);

		/* Dynamic equal width in Footer-Menu */

		var $footerNavigationUlLi = $('#footer_navigation ul li');

		var n = 100 / ($footerNavigationUlLi .length - $('#footer_navigation ul ul li').length);
		$footerNavigationUlLi.css('width', n + '%');

		/* Responsive Youtube/Vimeo Videos */
		$('.article').fitVids();

		/* Check if Slider exists */
		var $frontPageSlider = $('#front-page-slider');

		if ($frontPageSlider.length > 0) {
			/* Slider on Frontpage */
			$frontPageSlider.before('<a id="prev" class="toggling">&laquo;</a><a id="next" class="toggling">&raquo;</a>').after('<nav id="slide-pager"></nav>').cycle({
				activePagerClass:'activeSlide',
				speed:1000,
				timeout:6000,
				fx:'scrollHorz',
				easeIn:'easeInOutQuad',
				easeOut:'easeInOutQuad',
				prev:'#prev',
				next:'#next',
				pager:'#slide-pager'
			});

			/* Cookie if Slider is hidden */

			var $toggling = $('.toggling');

			if ($.cookie('keks') == 'true') {
				$toggling.hide();
			} else {
				$toggling.show();
			}

			/* Toggle the Slider */
			$('#front-page-slider-toggle').click(function () {
				if ($toggling.css('display') == 'block') {
					$.cookie('keks', 'true');
					$toggling.slideUp(500, function () {
					});
				} else {
					$.cookie('keks', 'false');
					$toggling.slideDown(500, function () {
					});
				}
			});
		}
	});
}(jQuery, document, window))
