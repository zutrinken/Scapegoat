<?php if($options['header-option'] == 'show-slider') : ?>
	<!-- customize slider by theme-options -->
	<?php if($options['slider-num']) : $num=$options['slider-num']; else : $num=6; endif; ?>
	<?php if($options['slider-cat']) : $cat=$options['slider-cat']; else : $cat=''; endif; ?>
	<!-- all parameters for the query -->
	<?php $args = array('posts_per_page'=>$num,'cat'=>$cat, 'post__not_in'=>get_option('sticky_posts')); ?>
	<?php query_posts($args); ?>
	<?php if(have_posts()) : ?>
	<section id="front-page-header-outside" role="complementary">
		<div id="front-page-header-inside" class="inside">
			<div id="toggling" class="toggling">
				<div id="slideshow">
					<div id="front-page-slider-control">
						<div id="front-page-slider-control-inside" class="inside"></div>
					</div>
					<div id="front-page-slider">
						<ul class="slides">
							<?php while (have_posts()) : the_post(); ?>
							<li>
								<section class="front-page-slide">
									<div class="slide-content inside">
										<header class="slide-text">
											<h2 class="slide-text-title">
												<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
													<?php the_title(); ?>
												</a>
											</h2>
											<article class="slide-text-article">
												<?php echo custom_excerpt(30); ?>
												<a href="<?php the_permalink(); ?>" class="slide-text-more"><?php _e('more','scapegoat'); ?> &#x9b;</a>
											</article>
										</header><!-- slide-text -->
									</div>
									<?php if(has_post_thumbnail()) : ?>
										<figure class="slide-image parallax">
											<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail('featured'); ?>
											</a>
											<?php if(get_post(get_post_thumbnail_id())->post_excerpt) : ?>
												<span class="meta-thumbnail-caption">
													<?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?>
												</span>
											<?php endif; ?>
										</figure><!-- slide-image -->
									<?php endif; ?>
								</section><!-- front-page-slide -->
								
							</li>
							<?php endwhile; ?>
						</ul>
					</div><!-- front-page-slider -->
				</div><!-- slideshow -->
				<div class="clear"></div>
			</div><!-- toggling -->
			<div class="clear"></div>
		</div><!-- front-page-header-inside -->
	</section><!-- front-page-header-outside -->
	<?php endif; wp_reset_query(); ?>
<?php elseif($options['header-option'] == 'show-header') : ?>
	<?php $header_image = get_header_image(); if($header_image) : ?>
		<section id="front-page-header-image-outside">
			<div id="front-page-header-image-inside" class="inside">
				<figure class="custom-header front-page-slide"></figure>
			</div><!-- front-page-header-image-inside -->
		</section><!-- front-page-header-image-outside --> 
	<?php endif; ?>
<?php endif; ?>
<?php if(($options['header-option'] == 'show-slider') || ($options['header-option'] == 'show-header')) : ?>
	<?php if($options['featured-link-1'] && $options['featured-link-2'] && $options['featured-link-3']) : ?>
		<div id="front-page-adverts-outside">
			<div id="front-page-adverts-inside">
				<div id="front-page-adverts">
					<aside id="featured-links">
						<ul>
							<?php if($options['featured-link-title-1']) : ?>
							<li>
								<a target="_blank" class="featured-link" href="<?php echo $options['featured-link-1']; ?>" title="<?php echo $options['featured-link-title-1']; ?>"><?php echo $options['featured-link-title-1']; ?></a>
							</li>
							<?php endif; ?>
							<?php if($options['featured-link-title-2']) : ?>
							<li>
								<a target="_blank" class="featured-link" href="<?php echo $options['featured-link-2']; ?>" title="<?php echo $options['featured-link-title-2']; ?>"><?php echo $options['featured-link-title-2']; ?></a>
							</li>
							<?php endif; ?>
							<?php if($options['featured-link-title-3']) : ?>
							<li>
								<a target="_blank" class="featured-link" href="<?php echo $options['featured-link-3']; ?>" title="<?php echo $options['featured-link-title-3']; ?>"><?php echo $options['featured-link-title-3']; ?></a>
							</li>
							<?php endif; ?>
							<?php if($options['featured-link-title-4']) : ?>
							<li>
								<a target="_blank" class="featured-link" href="<?php echo $options['featured-link-4']; ?>" title="<?php echo $options['featured-link-title-4']; ?>"><?php echo $options['featured-link-title-4']; ?></a>
							</li>
							<?php endif; ?>
							<?php if($options['featured-link-title-5']) : ?>
							<li>
								<a target="_blank" class="featured-link" href="<?php echo $options['featured-link-5']; ?>" title="<?php echo $options['featured-link-title-5']; ?>"><?php echo $options['featured-link-title-5']; ?></a>
							</li>
							<?php endif; ?>
						</ul>
					</aside><!-- featured-links -->
				</div><!-- front-page-adverts -->
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>
