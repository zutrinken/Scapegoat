		<?php get_header(); ?>

		<div id="container">
			
			<div id="content">

				<?php if(function_exists('breadcrumb')) : ?>
					<?php breadcrumb(); ?> 
				<?php endif; ?>
				
				<header class="heading">
					<p><?php get_search_form(); ?></p>
				</header>


			<?php if (have_posts()) : ?>

			<div id="archive">			

			<?php while (have_posts()) : the_post(); ?>
						<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<!--<?php edit_post_link( __( 'Edit', 'scapegoat' ), '<span class="edit-link">', '</span>' ); ?>-->
							<?php if($options['custom-excerpt']) : ?>
								<?php if(has_post_thumbnail()) : ?>
									<figure class="post-archiv-image">
										<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('medium'); ?>
										</a>
										<?php if(get_post(get_post_thumbnail_id())->post_excerpt) : ?>
											<span class="meta-thumbnail-caption">
												<?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?>
											</span>
										<?php endif; ?>
									</figure>
								<?php endif; ?>
							<?php endif; ?>
							<header class="header">
								<h2 class="post-title">
									<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</h2>
								<aside class="meta">
									<span class="post-date"><?php the_time('j.m.y'); ?></span>
									<span class="post-author"><?php the_author_posts_link(); ?></span>
								</aside>
							</header>
							<article class="article">
								<?php the_excerpt(); ?>
							</article>
						</section><!-- .post -->
			<?php endwhile; ?>

			</div>
			
				<nav id="pagination">
					<?php if( function_exists('wp_pagination_navi') ) : ?>
						<?php wp_pagination_navi(); ?>
					<?php else : ?>
						<div class="alignleft"><?php previous_posts_link('&laquo; prev', 0); ?></div>
						<div class="alignright"><?php next_posts_link('next &raquo;', 0) ?></div>
					<?php endif; ?>
				</nav>

			<?php else : ?>

			<?php endif; ?>
			</div><!-- content -->
			
			<?php get_sidebar(); ?>

			<div class="clear"></div>
		</div><!-- container -->

		<?php get_footer(); ?>