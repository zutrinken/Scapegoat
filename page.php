		<?php get_header(); ?>
		<?php $detect = new Mobile_Detect(); ?>
		
		<?php if(has_post_thumbnail() && (!$detect->isMobile() || $detect->isTablet())) : ?>
			<div id="title-images-wrapper">
				<figure class="title-image parallax">
					<?php the_post_thumbnail('featured'); ?>
					<?php if(get_post(get_post_thumbnail_id())->post_excerpt) : ?>
						<span class="meta-thumbnail-caption">
							<?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?>
						</span>
					<?php endif; ?>
				</figure>
				<div id="title-outside">
					<div id="title-inside" class="inside">
						<div class="content<?php if (!is_active_sidebar('Main-Sidebar')) : ?> nosidebar<?php endif; ?>">
							<header class="title-header">
								<h2 class="post-title">
									<?php the_title(); ?>
									<?php edit_post_link(__('Edit','scapegoat'),'<span class="edit-link">','</span>'); ?>
								</h2>
							</header>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		<?php else : ?>
			<div id="title-outside">
				<div id="title-inside" class="inside">
					<div class="content<?php if (!is_active_sidebar('Main-Sidebar')) : ?> nosidebar<?php endif; ?>">
						<header class="title-header">
							<h2 class="post-title">
								<?php the_title(); ?>
								<?php edit_post_link(__('Edit','scapegoat'),'<span class="edit-link">','</span>'); ?>
							</h2>
						</header>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		<?php endif; ?>

		<div id="wrapper-outside">
			<div id="wrapper-inside" class="inside">

		<div id="container">

			<div id="content" class="content<?php if (!is_active_sidebar('Main-Sidebar')) : ?> nosidebar<?php endif; ?>" role="main">
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<section id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

					<article class="article">
						<?php wp_link_pages('before=<nav class="pagination_post">'. __("Pages:","farewell") .'&after=</nav>'); ?>
						<?php the_content(); ?>
						<?php wp_link_pages('before=<nav class="pagination_post">'. __("Pages:","farewell") .'&after=</nav>'); ?>
					</article>
					
				</section>
				
				<?php endwhile; ?>
				
					<section id="replys">
						<?php comments_template(); ?>
					</section>
				
				<?php endif; ?>
				<div class="clear"></div>
			</div>

			<?php get_sidebar(); ?>
			<div class="clear"></div>
		</div>

			</div><!-- wrapper-inside -->
		</div><!-- wrapper-outside -->

		<?php get_footer(); ?>