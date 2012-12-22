		<?php get_header(); ?>
		
		<!-- Mobiel Detect -->
		<?php $detect = new Mobile_Detect(); ?>
		
		<div id="container">
			<div id="content">
			
				<?php if(function_exists('breadcrumb')) : ?>
					<?php breadcrumb(); ?> 
				<?php endif; ?>
			
				<header class="heading">
					<?php if (is_category()) : ?>
						<?php echo category_description(); ?>
					<?php elseif (is_author()) : ?>
						<?php global $author; $userdata = get_userdata($author); ?>
						<?php $userInfo = get_user_by('slug', get_query_var('author_name')); ?>
						<?php if (function_exists('get_avatar')) { echo get_avatar($userInfo->user_email, 48); } ?>
						<div class="sub-title-links">
						<?php if($userdata->twitter) : ?>
							<span class="sub-title-link sub-title-twitter">
								<a target="_blank" href="https://twitter.com/<?php echo $userdata->twitter; ?>">
									@<?php echo $userdata->twitter; ?>
								</a>
								<span class="label">// <?php _e('Twitter','scapegoat') ?></span>
							</span>
						<?php endif; ?>
						<?php if($userdata->wiki) : ?>
							<span class="sub-title-link sub-title-wiki">
								<a target="_blank" href="https://wiki.piratenpartei.de/Benutzer:<?php echo $userdata->wiki; ?>">
									<?php echo $userdata->wiki; ?>
								</a>
								<span class="label">// <?php _e('Wiki','scapegoat') ?></span>
							</span>
						<?php endif; ?>
						<?php if($userdata->user_url) : ?>
							<span class="sub-title-link sub-title-website">
								<a target="_blank" href="<?php echo $userdata->user_url; ?>">
									<?php echo $userdata->user_url; ?>
								</a>
								<span class="label">// <?php _e('Website','scapegoat') ?></span>
							</span>
						<?php endif; ?>
						</div>
						<?php if($userdata->description) : ?>
							<div class="sub-title-description">
								<?php echo $userdata->description; ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>
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
					</div><!-- #archive -->
					<nav id="pagination">
						<?php if( function_exists('wp_pagination_navi') ) : ?>
							<?php wp_pagination_navi(); ?>
						<?php else : ?>
							<div class="alignleft"><?php previous_posts_link('&laquo; prev', 0); ?></div>
							<div class="alignright"><?php next_posts_link('next &raquo;', 0) ?></div>
						<?php endif; ?>
					</nav>
				<?php endif; ?>
			</div><!-- content -->
			
			<?php get_sidebar(); ?>

			<div class="clear"></div>
		</div><!-- container -->
		<?php get_footer(); ?>