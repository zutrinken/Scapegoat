		<?php get_header(); ?>

		<div id="container">
			
			<div id="content">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<section id="post-<?php the_ID(); ?>" <?php if (is_front_page()) { post_class('front-post'); } else { post_class(); } ?>>
				<?php edit_post_link( __( 'Edit', 'scapegoat' ), '<span class="edit-link">', '</span>' ); ?>
				<header class="header">
					<?php if(has_post_thumbnail() && ($options['custom-excerpt'] == TRUE)) : ?>
						<figure class="postimage">
							<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('featured'); ?>
							</a>
						</figure>
					<?php elseif((catch_that_image() != '') && ($options['custom-excerpt'] == TRUE)) : ?>
						<figure class="postimage">
							<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
								<?php echo catch_that_image(); ?>
							</a>
						</figure>
					<?php endif; ?>

					<h2 class="post-title">
						<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>
					<aside class="info meta">
						<span class="post-date"><?php the_time('j.m.y'); ?></span>
						<span class="post-author"><?php the_author_posts_link(); ?></span>
						<?php if(!has_post_format('status')) : ?>
							<span class="replys"><?php comments_popup_link(__('Leave a comment','scapegoat'),__('1 Comment','scapegoat'),__('% Comments','scapegoat'), 'comments-link',__('Comments closed','scapegoat'));?></span>
						<?php endif; ?>
					</aside>
				</header>
		
				<article class="article">
					<?php if($options['custom-excerpt'] == FALSE) : ?>
						<?php the_content(); ?>
					<?php elseif(has_post_format('status')) : ?>
						<?php the_content(); ?>
					<?php else : ?>
						<?php the_excerpt(); ?>
					<?php endif; ?>
				</article>
				
				
				<?php if(!has_post_format('status')) : ?>
					<footer class="footer meta">
						<aside class="categories"><?php _e('Posted in:','scapegoat'); ?><?php the_category(' '); ?></aside>
						<?php the_tags(__('<aside class="tags">Tagged with:','scapegoat'),'','</aside>'); ?>
					</footer>
				<?php endif; ?>
			</section>
			
			<?php endwhile; ?>
			
				<nav id="postnav">
					<?php if( function_exists('wp_pagination_navi') ) : ?>
						<?php wp_pagination_navi(); ?>
					<?php else : ?>
						<div class="alignleft"><?php previous_posts_link('&laquo; prev', 0); ?></div>
						<div class="alignright"><?php next_posts_link('next &raquo;', 0) ?></div>
					<?php endif; ?>
				</nav>

			<?php endif; ?>
			</div>
			
			<?php get_sidebar(); ?>

		</div>

		<?php get_footer(); ?>