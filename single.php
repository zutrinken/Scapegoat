		<?php get_header(); ?>
		
		<!-- Mobiel Detect -->
		<?php $detect = new Mobile_Detect(); ?>

		<div id="container">
			<div id="content" role="main">
				<?php if(has_post_thumbnail()) : ?>
					<figure class="post-image">
						<?php $image_id = get_post_thumbnail_id();$image_url = wp_get_attachment_image_src($image_id,'full', true); ?>
						<a title="<?php the_title(); ?>" href="<?php echo $image_url[0]; ?>">
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
			
			<!-- Mobile Query -->
			<?php if(!$detect->isMobile() || $detect->isTablet()) : ?>
				<?php if(function_exists('breadcrumb')) : ?>
					<?php breadcrumb(); ?> 
				<?php endif; ?>
			<?php endif; ?>
			<!-- Mobile Query -->
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<!--<?php edit_post_link( __( 'Edit', 'scapegoat' ), '<span class="edit-link">', '</span>' ); ?>-->
					<header class="header">
						<h2 class="post-title"><?php the_title(); ?></h2>
					</header>
					<article class="article">
						<?php wp_link_pages('before=<nav class="pagination_post">'. __("Pages:","scapegoat") .'&after=</nav>'); ?>
						<?php the_content(); ?>
						<?php wp_link_pages('before=<nav class="pagination_post">'. __("Pages:","scapegoat") .'&after=</nav>'); ?>
					</article>
				</section><!-- .post -->
			<?php endwhile; ?>
				<section id="replys">
					<?php comments_template(); ?>
				</section>
			<?php endif; ?>
			</div><!-- #content -->
			
			<section id="sidebar" class="meta" role="complementary">
				<nav class="post-nav" role="navigation">
					<span class="post-nav-next"><?php next_post_link('%link', __('Next','scapegoat')); ?></span>
					<span class="post-nav-prev"><?php previous_post_link('%link', __('Last','scapegoat')); ?></span>
				</nav><!-- .post-nav -->
			
				<aside class="post-info">
					<span class="post-date">
						<?php the_time('j.m.y'); ?>
					</span>
					<aside class="categories">
						<?php _e('Posted in: ','scapegoat'); ?><?php the_category(', '); ?>
					</aside>
					<?php the_tags(__('<aside class="tags">Tagged with: ','scapegoat'),', ','</aside>'); ?>
				</aside><!-- .post-info -->
			
				<aside class="author-meta">
					<figure class="author_avatar">
						<?php if (function_exists('get_avatar')) { echo get_avatar(get_the_author_email(), 60); }?>
					</figure>
					<div class="author_info">
						<span class="author_meta_row author_meta_name">
							<?php the_author_posts_link(); ?>
							<span class="label"><?php _e('Author','scapegoat') ?></span>
						</span>

						<?php if(get_the_author_meta('twitter')) : ?>
						<span class="author_meta_row author_meta_twitter">
							<a target="_blank" href="https://twitter.com/<?php the_author_meta('twitter');?>">@<?php the_author_meta('twitter');?></a>
							<span class="label"><?php _e('Twitter','scapegoat') ?></span>
						</span>
						<?php endif; ?>

						<?php if(get_the_author_meta('wiki')) : ?>
						<span class="author_meta_row author_meta_twitter">
							<a target="_blank" href="https://wiki.piratenpartei.de/Benutzer:<?php the_author_meta('wiki');?>"><?php the_author_meta('wiki');?></a>
							<span class="label"><?php _e('Wiki','scapegoat') ?></span>
						</span>
						<?php endif; ?>

						<?php if(get_the_author_meta('user_url')) : ?>
						<span class="author_meta_row author_meta_website">
							<a target="_blank" href="<?php the_author_meta('user_url'); ?>"><?php the_author_meta('user_url'); ?></a>
							<span class="label"><?php _e('Website','scapegoat') ?></span>
						</span>
						<?php endif; ?>

						<?php if(get_the_author_meta('description')) : ?>
						<span class="author_meta_row author_meta_biografie">
							<?php the_author_meta('description'); ?>
							<span class="label"><?php _e('Biography','scapegoat') ?></span>
						</span>
						<?php endif; ?>
					</div>
				</aside><!-- .author-meta -->
			</section><!-- #sidebar -->
			<div class="clear"></div>
		</div><!-- container -->

		<?php get_footer(); ?>