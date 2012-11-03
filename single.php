		<?php get_header(); ?>

		<div id="container">
			
			<div id="full">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<section id="post-<?php the_ID(); ?>" <?php post_class('single-post-view'); ?>>
				<!--<?php edit_post_link( __( 'Edit', 'scapegoat' ), '<span class="edit-link">', '</span>' ); ?>-->
				<!--<nav class="post-nav post-nav-top">
					<span class="post-nav-next"><?php next_post_link('%link', __('Next','scapegoat')); ?></span>
					<span class="post-nav-prev"><?php previous_post_link('%link', __('Last','scapegoat')); ?></span>
				</nav>-->

				<header class="header">
					<h1 class="post-title"><?php the_title(); ?></h1>
				</header>

				<article class="article">
					<?php wp_link_pages('before=<nav class="pagination_post">'. __("Pages:","scapegoat") .'&after=</nav>'); ?>
					<?php the_content(); ?>
					<?php wp_link_pages('before=<nav class="pagination_post">'. __("Pages:","scapegoat") .'&after=</nav>'); ?>
				</article>

				<nav class="post-nav post-nav-bottom">
					<span class="post-nav-next"><?php next_post_link('%link', __('Next','scapegoat')); ?></span>
					<span class="post-nav-prev"><?php previous_post_link('%link', __('Last','scapegoat')); ?></span>
				</nav>

			</section>
			<section id="sidebar" class="meta">
				<aside class="post-info">
					<?php if(has_post_thumbnail()) : ?>
					<?php $image_id = get_post_thumbnail_id();$image_url = wp_get_attachment_image_src($image_id,'full', true); ?>
						<figure class="meta-thumbnail">
							<a href="<?php echo $image_url[0]; ?>" title="<?php the_title(); ?>">
								<?php the_post_thumbnail('medium'); ?>
							</a>
							<?php if(get_post(get_post_thumbnail_id())->post_excerpt == TRUE) : ?>
								<span class="meta-thumbnail-caption">
									<?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?>
								</span>
							<?php endif; ?>
						</figure>
					<?php endif; ?>
					<span class="post-date"><?php the_time('j.m.y'); ?></span>
					<aside class="categories"><?php _e('Posted in:','scapegoat'); ?><?php the_category(' '); ?></aside>
					<?php the_tags(__('<aside class="tags">Tagged with:','scapegoat'),'','</aside>'); ?>
				</aside>
			
				<aside class="author-meta">
					<figure class="author_avatar">
						<?php if (function_exists('get_avatar')) { echo get_avatar(get_the_author_email(), 100); }?>
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
				</aside>
			</section>

			<?php endwhile; ?>

				<section id="replys">
					<?php comments_template(); ?>
				</section>
			
			<?php endif; ?>
			</div>

		</div>

		<?php get_footer(); ?>