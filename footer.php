			</div><!-- wrapper-inside -->
		</div><!-- wrapper-outside -->
		<?php $options = get_option('scapegoat_theme_options'); ?>
		<div id="footer-top-outside">
			<aside id="footer-top-inside" class="inside">
				<div id="footer-social-links">
					<?php if($options['rss']) : ?>
						<a target="_blank" class="social-icon rss" href="<?php echo $options['rss']; ?>" title="Feed">Feed</a>
					<?php else : ?>
						<a target="_blank" class="social-icon rss" href="<?php bloginfo('rss2_url'); ?>" title="Feed">Feed</a>
					<?php endif; ?>
					<?php if($options['twitter']) : ?><a target="_blank" class="social-icon twitter" href="<?php echo $options['twitter']; ?>" title="Twitter">Twitter</a><?php endif; ?>
					<?php if($options['facebook']) : ?><a target="_blank" class="social-icon facebook" href="<?php echo $options['facebook']; ?>" title="Facebook">Facebook</a><?php endif; ?>
					<?php if($options['google']) : ?><a target="_blank" class="social-icon google" href="<?php echo $options['google']; ?>" title="Google +">Google +</a><?php endif; ?>
					<?php if($options['youtube']) : ?><a target="_blank" class="social-icon youtube" href="<?php echo $options['youtube']; ?>" title="Youtube">Youtube</a><?php endif; ?>
					<?php if($options['mail']) : ?><a target="_blank" class="social-icon mail" href="<?php echo $options['mail']; ?>" title="Newsletter">Newsletter</a><?php endif; ?>
					<?php if($options['podcast']) : ?><a target="_blank" class="social-icon podcast" href="<?php echo $options['podcast']; ?>" title="Podcast">Podcast</a><?php endif; ?>
				</div><!-- footer-top-social -->
				<div id="footer-search">
					<?php get_search_form(); ?>
				</div><!-- footer-top-search -->
				<div class="clear"></div>
			</aside><!-- footer-top-inside -->
		</div><!-- footer-top-outside -->

		<div id="footer-outside">
			<footer id="footer-inside" class="inside">
				<?php if (is_active_sidebar('Footer-Sidebar')) : ?>
					<aside id="footer-widgets">
						<?php dynamic_sidebar('Footer-Sidebar'); ?>
					</aside><!-- footer-widgets -->
				<?php endif; ?>
				<nav id="footer_navigation">
					<?php wp_nav_menu(array('theme_location'=>'footer', 'fallback_cb'=>'FALSE')); ?>
					<div class="clear"></div>
				</nav><!-- footer_navigation -->
			</footer><!-- footer-inside -->
		</div><!-- footer-outside -->
		
		<div id="end-outside">
			<div idend-inside class="inside">
				<aside id="end">
					<!-- I dont't always delete a backlink, but when I do, I swear I'll drink a beer with Peter Amende. -->
					Theme by <a target="_blank" title="Peter Amende" href="http://zutrinken.com/">Peter Amende</a>
				</aside><!-- end -->
			</div><!-- end-inside -->
		</div><!-- end-outside -->

		<?php wp_footer(); ?>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/script.js"></script>
<!-- The only constant is change. -->
<!--  -->
<!--              ▲              -->
<!--             ▲ ▲             -->
<!--  -->
<!-- ALL CREDITS GOES TO @krasse_herde -->
<!-- @Lotterleben --> 
<!-- @fRANDOM74 -->
<!-- @mirgehtsganzgut -->

	</body>
</html>