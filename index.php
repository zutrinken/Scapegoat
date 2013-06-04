		<?php get_header(); ?>
		
		<!-- Mobiel Detect -->
		<?php $detect = new Mobile_Detect(); ?>

		<div id="container">
			<div id="content" role="main">			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<section id="post-<?php the_ID(); ?>" <?php if (is_front_page()) { post_class('front-post'); } else { post_class(); } ?>>
					<?php if(has_post_thumbnail()) : ?>
						<figure class="post-image">
							<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
								<!-- Mobile Query -->
								<?php if($detect->isMobile() && !$detect->isTablet()) : ?>
									<?php the_post_thumbnail('medium'); ?>
								<?php else : ?>							
									<?php the_post_thumbnail('teaser'); ?>
								<?php endif; ?>
							</a>
							<?php if(get_post(get_post_thumbnail_id())->post_excerpt) : ?>
								<span class="meta-thumbnail-caption">
									<?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?>
								</span>
							<?php endif; ?>
						</figure>
					<?php endif; ?>
					<header class="header">
						<h2 class="post-title">
							<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h2><!-- .post-title -->
						<aside class="info meta">
							<span class="post-date"><?php the_time('j.m.y'); ?></span>
							<span class="post-author"><?php the_author_posts_link(); ?></span>
							<?php if(!has_post_format('status')) : ?>
								<span class="replys"><?php comments_popup_link(__('Leave a comment','scapegoat'),__('1 Comment','scapegoat'),__('% Comments','scapegoat'), 'comments-link',__('Comments closed','scapegoat'));?></span>
							<?php endif; ?>
						</aside><!-- .info -->
					</header><!-- .header -->
			
					<article class="article">
						<?php if(!$options['custom-excerpt']) : ?>
							<?php the_content(); ?>
						<?php elseif(has_post_format('status')) : ?>
							<?php the_content(); ?>
						<?php else : ?>
							<?php the_excerpt(); ?>
						<?php endif; ?>
					</article><!-- .article -->
					
					
					<?php if(!has_post_format('status')) : ?>
						<footer class="footer meta">
							<aside class="categories"><?php _e('Posted in: ','scapegoat'); ?><?php the_category(', '); ?></aside>
							<?php the_tags(__('<aside class="tags">Tagged with: ','scapegoat'),', ','</aside>'); ?>
						</footer><!-- .footer -->
					<?php endif; ?>
				</section><!-- .post -->
				
				<?php endwhile; ?>
				
					<nav id="pagination" role="navigation">
						<?php if( function_exists('wp_pagination_navi') ) : ?>
							<?php wp_pagination_navi(); ?>
						<?php else : ?>
							<div class="alignleft"><?php previous_posts_link('&laquo; prev', 0); ?></div>
							<div class="alignright"><?php next_posts_link('next &raquo;', 0) ?></div>
						<?php endif; ?>
					</nav><!-- #pagination -->
	
				<?php endif; ?>
			</div><!-- #content -->

			<?php get_sidebar(); ?>

			<div class="clear"></div>
		</div><!-- #container -->

		<?php get_footer(); ?>