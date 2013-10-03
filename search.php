		<?php get_header(); ?>
		
		<?php $detect = new Mobile_Detect(); /* Mobiel Detect */ ?>	
		<?php $options = get_option('scapegoat_theme_options'); /* load the Theme Options */ ?>

		<div id="title-outside">
			<div id="title-inside" class="inside">
				<div class="content<?php if (!is_active_sidebar('Main-Sidebar')) : ?> nosidebar<?php endif; ?>">
					<header class="title-header">
						<h2 class="post-title">
							<?php _e('Search','scapegoat'); ?> "<?php the_search_query(); ?>"		
						</h2>
					</header>
				</div>
				<div class="clear"></div>
			</div>			
		</div>

		<div id="wrapper-outside">
			<div id="wrapper-inside" class="inside">

		<div id="container">

			<div id="content" class="content<?php if (!is_active_sidebar('Main-Sidebar')) : ?> nosidebar<?php endif; ?>" role="main">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<section id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
				<header class="header">
					<h2 class="post-title">
						<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
						<?php edit_post_link(__('Edit','scapegoat'),'<span class="edit-link">','</span>'); ?>
					</h2>
					<aside class="info post-meta">
						<span class="post-date">
							<i class="icon-calendar"></i>
							<?php the_time('j.m.y'); ?>
						</span>
						<span class="post-categories">
							<i class="icon-folder-open"></i>
							<?php _e('Category: ','scapegoat'); ?>
							<?php the_category(', '); ?>
						</span>
					</aside>
					
					<?php if(get_post_meta($post->ID, 'video', true) && $options['custom-excerpt']) : ?>
						<figure class="post-video">
							<?php echo get_post_meta($post->ID, 'video', true); ?>
						</figure>
					<?php elseif(has_post_thumbnail()) : ?>
						<?php if(!$detect->isMobile() || $detect->isTablet()) : ?>
							<figure class="post-image">
								<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">								
									<?php the_post_thumbnail('featured-medium'); ?>
								</a>
								<?php if(get_post(get_post_thumbnail_id())->post_excerpt) : ?>
									<span class="post-image-caption">
										<?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?>
									</span>
								<?php endif; ?>
							</figure>
						<?php else : ?>
							<figure class="post-image post-image-mobile">
								<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">								
									<?php the_post_thumbnail('featured-small'); ?>
								</a>
								<?php if(get_post(get_post_thumbnail_id())->post_excerpt) : ?>
									<span class="post-image-caption">
										<?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?>
									</span>
								<?php endif; ?>
							</figure>
						<?php endif; ?>
					<?php endif; ?>
				</header>

				<article class="article">
					<?php if(!$options['custom-excerpt']) : ?>
						<?php the_content(); ?>
					<?php else : ?>
						<?php the_excerpt(); ?>
						<a href="<?php the_permalink(); ?>" class="post-more"><?php _e('more','scapegoat'); ?> &#x9b;</a>
					<?php endif; ?>
					<div class="clear"></div>
				</article>				

				<footer class="footer post-meta">
					<span class="post-tags">
						<?php the_tags(__('<i class="icon-tag"></i> Tags: ','scapegoat'),', ',''); ?>
					</span>
				</footer>
				
			</section>
			
			<?php endwhile; ?>
			
				<nav id="pagination">
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
			<div class="clear"></div>
		</div>
		
			</div><!-- wrapper-inside -->
		</div><!-- wrapper-outside -->

		<?php get_footer(); ?>