		<?php $options = get_option('scapegoat_theme_options'); ?>
		<div id="footer-top-outside" role="complementary">
			<aside id="footer-top-inside" class="inside">
				<div id="footer-social-links">
					<?php if($options['rss']) : ?>
						<a target="_blank" class="social-icon rss" href="<?php echo $options['rss']; ?>" title="Feed">Feed</a>
					<?php else : ?>
						<a target="_blank" class="social-icon rss" href="<?php bloginfo('rss2_url'); ?>" title="Feed">Feed</a>
					<?php endif; ?>
					<?php if($options['twitter']) : ?><a target="_blank" class="social-icon twitter" href="<?php echo $options['twitter']; ?>" title="Twitter">Twitter</a><?php endif; ?>
					<?php if($options['appdotnet']) : ?><a target="_blank" class="social-icon appdotnet" href="<?php echo $options['appdotnet']; ?>" title="Twitter">App.net</a><?php endif; ?>
					<?php if($options['facebook']) : ?><a target="_blank" class="social-icon facebook" href="<?php echo $options['facebook']; ?>" title="Facebook">Facebook</a><?php endif; ?>
					<?php if($options['google']) : ?><a target="_blank" class="social-icon google" href="<?php echo $options['google']; ?>" title="Google +">Google +</a><?php endif; ?>
					<?php if($options['youtube']) : ?><a target="_blank" class="social-icon youtube" href="<?php echo $options['youtube']; ?>" title="Youtube">Youtube</a><?php endif; ?>
					<?php if($options['mail']) : ?><a target="_blank" class="social-icon mail" href="<?php echo $options['mail']; ?>" title="Mail">Mail</a><?php endif; ?>
					<?php if($options['podcast']) : ?><a target="_blank" class="social-icon podcast" href="<?php echo $options['podcast']; ?>" title="Podcast">Podcast</a><?php endif; ?>
				</div><!-- footer-top-social -->
				<div id="footer-search">
					<?php get_search_form(); ?>
				</div><!-- footer-top-search -->
				<div class="clear"></div>
			</aside><!-- footer-top-inside -->
		</div><!-- footer-top-outside -->

		<div id="footer-outside" role="complementary">
			<div id="footer-inside" class="inside">
				<footer id="footer-widgets" role="complementary">
					<?php if (is_active_sidebar('Footer-Sidebar-1')) : ?>
						<div class="footer-sidebar-outside">
							<aside id="footer-sidebar-1" class="footer-sidebar-inside">
								<?php dynamic_sidebar('Footer-Sidebar-1'); ?>
							</aside>
						</div>
					<?php endif; ?>
					<?php if (is_active_sidebar('Footer-Sidebar-2')) : ?>
						<div class="footer-sidebar-outside">
							<aside id="footer-sidebar-2" class="footer-sidebar-inside">
								<?php dynamic_sidebar('Footer-Sidebar-2'); ?>
							</aside>
						</div>
					<?php endif; ?>
					<?php if (is_active_sidebar('Footer-Sidebar-3')) : ?>
						<div class="footer-sidebar-outside">
							<aside id="footer-sidebar-3" class="footer-sidebar-inside">
								<?php dynamic_sidebar('Footer-Sidebar-3'); ?>
							</aside>
						</div>
					<?php endif; ?>
					<?php if (is_active_sidebar('Footer-Sidebar-4')) : ?>
						<div class="footer-sidebar-outside">
							<aside id="footer-sidebar-4" class="footer-sidebar-inside">
								<?php dynamic_sidebar('Footer-Sidebar-4'); ?>
							</aside>
						</div>
					<?php endif; ?>
					<div class="clear"></div>
				</footer><!-- footer-widgets -->
			</div><!-- footer-inside -->
		</div><!-- footer-outside -->

		<div id="footer-nav-outside">
			<div id="footer-nav-inside" class="inside">
				<nav id="footer_navigation" role="navigation">
					<?php wp_nav_menu(array('theme_location'=>'footer', 'fallback_cb'=>'FALSE')); ?>
					<div class="clear"></div>
				</nav><!-- main-nav -->
				<div class="clear"></div>
			</div><!-- main-nav-inside -->
		</div><!-- main-nav-outside -->

		<div id="end-outside" role="contentinfo">
			<div idend-inside class="inside">
				<aside id="end">
					<a target="_blank" href="http://zutrinken.com/">Amende</a>
				</aside><!-- end -->
			</div><!-- end-inside -->
		</div><!-- end-outside -->

	</div>
</div>

		<?php wp_footer(); ?>
		
		<script type="text/javascript">
			(function ($, document, window) {
				$(document).ready(function () {
					function openNav() {
						$('#main-inside').animate({ left: '87.5%' }, 100);
						$('#main-inside').addClass('aside');
						return false;
					}
					function closeNav() {
						$('#main-inside').animate({ left: '0' }, 100);
						$('#main-inside').removeClass('aside');
						return false;
					}
					$('#menu-open').click(openNav);
					$('#menu-close').click(closeNav);
				});
			}(jQuery, document, window))
		</script>
<!--              ▲              -->
<!--             ▲ ▲             -->
	</body>
</html>