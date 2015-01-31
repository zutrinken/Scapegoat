		<?php get_header(); ?>

		<?php $detect = new Mobile_Detect(); ?>

				<div id="title-outside">
					<div id="title-inside" class="inside">
						<div class="content nosidebar">
							<header class="title-header">
								<h2 class="post-title">
									<?php _e('404','scapegoat'); ?></h2>
							</header>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			
				<div id="wrapper-outside">
					<div id="wrapper-inside" class="inside">
		
						<div id="container">
				
							<div id="content" class="full" role="main">
								
								<section id="post-404" class="post-404 post type-post status-publish format-standard hentry" role="article">

									<article class="article">
										<p><?php _e('This is not the page you’re looking for!','scapegoat'); ?></p>
									</article>
									
								</section>
								
								<div class="clear"></div>
							</div>
							<div class="clear"></div>
						</div>
		
					</div><!-- wrapper-inside -->
				</div><!-- wrapper-outside -->

			<div class="clear"></div>
		</div><!-- container -->

		<?php get_footer(); ?>