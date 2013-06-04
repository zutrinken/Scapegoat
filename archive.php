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
						<div class="category-description">
							<?php echo category_description(); ?>
						</div>
					<?php elseif (is_author()) : ?>
						<p>
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
						</p>
					<?php endif; ?>
				</header>
				<?php if (have_posts()) : ?>
					<div id="archive">
					<?php while (have_posts()) : the_post(); ?>
					
						<?php if($options['custom-excerpt']) : ?>
						
							<section id="post-<?php the_ID(); ?>" <?php post_class('archive-post'); ?>>

								<!-- Mobile Query -->
								<?php if(!$detect->isMobile() || $detect->isTablet()) : ?>
									<?php if(has_post_thumbnail()) : ?>
										<figure class="post-image">
											<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail('thumbnail'); ?>
											</a>
										</figure>
									<?php else : ?>
									
										<?php echo catch_post_image(); ?>
									
									<?php endif; ?>									
								<?php endif; ?>
								<header class="header">
									<h2 class="post-title">
										<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a>
									</h2>
									<!--
									<aside class="meta">
										<span class="post-date"><?php the_time('j.m.y'); ?></span>
										<span class="post-author"><?php the_author_posts_link(); ?></span>
										<aside class="categories"><?php _e('Posted in: ','scapegoat'); ?><?php the_category(', '); ?></aside>
										<?php the_tags(__('<aside class="tags">Tagged with: ','scapegoat'),', ','</aside>'); ?>
									</aside>
									-->
								</header>
								
								<article class="article">
									<?php the_excerpt(); ?>
								</article><!-- .article -->

								<div class="clear"></div>
							</section><!-- .post -->
						<?php else : ?>
							<section id="post-<?php the_ID(); ?>" <?php post_class('front-post'); ?>>
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
									<?php the_content(); ?>
								</article><!-- .article -->
								<footer class="footer meta">
									<aside class="categories"><?php _e('Posted in: ','scapegoat'); ?><?php the_category(', '); ?></aside>
									<?php the_tags(__('<aside class="tags">Tagged with: ','scapegoat'),', ','</aside>'); ?>
								</footer><!-- .footer -->
								<div class="clear"></div>
							</section><!-- .post -->
						<?php endif; ?>

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