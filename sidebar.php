<?php $options = get_option('scapegoat_theme_options'); ?>
<section id="sidebar">
	<?php if (function_exists('submenu') && $options['submenu-show']) { submenu(); } ?>
	<aside id="sidebar-social-links" class="widget widget-sidebar">
					<?php if($options['rss'] == TRUE) : ?>
						<a target="_blank" class="social-icon rss" href="<?php echo $options['rss']; ?>" title="Feed">Feed</a>
					<?php else : ?>
						<a target="_blank" class="social-icon rss" href="<?php bloginfo('rss2_url'); ?>" title="Feed">Feed</a>
					<?php endif; ?>
					<?php if($options['twitter'] == TRUE) : ?><a target="_blank" class="social-icon twitter" href="<?php echo $options['twitter']; ?>" title="Twitter">Twitter</a><?php endif; ?>
					<?php if($options['facebook'] == TRUE) : ?><a target="_blank" class="social-icon facebook" href="<?php echo $options['facebook']; ?>" title="Facebook">Facebook</a><?php endif; ?>
					<?php if($options['google'] == TRUE) : ?><a target="_blank" class="social-icon google" href="<?php echo $options['google']; ?>" title="Google +">Google +</a><?php endif; ?>
					<?php if($options['youtube'] == TRUE) : ?><a target="_blank" class="social-icon youtube" href="<?php echo $options['youtube']; ?>" title="Youtube">Youtube</a><?php endif; ?>
					<?php if($options['mail'] == TRUE) : ?><a target="_blank" class="social-icon mail" href="<?php echo $options['mail']; ?>" title="Newsletter">Newsletter</a><?php endif; ?>
					<?php if($options['podcast'] == TRUE) : ?><a target="_blank" class="social-icon podcast" href="<?php echo $options['podcast']; ?>" title="Podcast">Podcast</a><?php endif; ?>
	</aside><!-- sidebar-social-links -->
	<?php dynamic_sidebar('Main-Sidebar'); ?>
</section>