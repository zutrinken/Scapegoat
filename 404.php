		<?php get_header(); ?>

		<div id="container">
			<div id="full">
				<figure class="page-image full-image">
					<a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/404.jpg" alt="" /></a>
				</figure>
				<section id="post-404">
					<hgroup class="header">
						<h1 class="post-title"><?php _e('404','scapegoat'); ?></h1>
					</hgroup>
				
				</section>
			</div><!-- full -->

			<div class="clear"></div>
		</div><!-- container -->

		<?php get_footer(); ?>