		<?php get_header(); ?>

		<div id="container">

			<?php /* get_sidebar(); */ ?>
			
			<div id="full">

			<section class="post">
				<hgroup class="header">
						<h1 class="post-title"><?php _e('404','scapegoat'); ?></h1>
				</hgroup>
				<a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/404.jpg" alt="" /></a>
				
			</section>
			

			</div><!-- full -->

			<div class="clear"></div>
		</div><!-- container -->

		<?php get_footer(); ?>