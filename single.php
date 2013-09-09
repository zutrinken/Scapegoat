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
				</figure><!-- slide-image -->
				<div id="title-outside">
					<div id="title-inside" class="inside">
						<div class="content">
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
					<div class="content">
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
			
			<div id="content" class="content" role="main">
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<section id="post-<?php the_ID(); ?>" <?php post_class('single-post-view'); ?> role="article">
					<article class="article">
						<?php wp_link_pages('before=<nav class="pagination_post">'. __("Pages:","scapegoat") .'&after=</nav>'); ?>
						<?php the_content(); ?>
						<?php wp_link_pages('before=<nav class="pagination_post">'. __("Pages:","scapegoat") .'&after=</nav>'); ?>
						<div class="clear"></div>
					</article>
	
				</section>
	
				<?php endwhile; ?>
	
					<section id="replys">
						<?php comments_template(); ?>
					</section>
				
				<?php endif; ?>
				<div class="clear"></div>
			</div>

			<nav id="post-nav" class="post-nav sidebar">
				<h2 id="pagination-title" class="visuallyhidden"><?php _e('Article Navigation','scapegoat'); ?></h2>
				<span class="post-nav-link post-nav-prev">
					<span class="post-nav-inner">
						<?php previous_post_link('%link', __('Prev','scapegoat')); ?>
					</span>
				</span>

				<span class="post-nav-link post-nav-back">
					<span class="post-nav-inner">
						<a href="<?php bloginfo('url') ?>" rel="<?php _e('Back','scapegoat'); ?>">
							<?php _e('All Projects','goat'); ?>
						</a>
					</span>
				</span>

				<span class="post-nav-link post-nav-next">
					<span class="post-nav-inner">
						<?php next_post_link('%link', __('Next','scapegoat')); ?>
					</span>
				</span>
			</nav>

			<section id="post-meta" class="sidebar" role="complementary">
				<aside class="widget widget-sidebar post-meta">
				<span class="post-date">
					<span class="label">
						<i class="icon-calendar"></i>
						<?php _e('Date: ','scapegoat'); ?>
					</span>
					<span class="value">
						<?php $archive_year  = get_the_time('Y'); ?>
						<?php $archive_month = get_the_time('m'); ?>
						<a href="<?php echo get_month_link($archive_year, $archive_month); ?>">
							<?php the_time('j.m.y'); ?>
						</a>
					</span>
				</span>
				<span class="post-author">
					<span class="label">
						<i class="icon-user"></i>
						<?php _e('Author: ','scapegoat'); ?>
					</span>
					<span class="value">
						<?php the_author_posts_link(); ?>
					</span>
				</span>
				<span class="post-categories">
					<span class="label">
						<i class="icon-folder-open"></i>
						<?php _e('Category: ','scapegoat'); ?>
					</span>
					<span class="value">
						<?php the_category(', '); ?>
					</span>
				</span>
				<?php the_tags(__('<span class="post-tags"><span class="label"><i class="icon-tag"></i> Tags:</span> <span class="value">','scapegoat'),', ','</span></span>'); ?>
				<span class="post-comments">
					<span class="label">
						<i class="icon-comments"></i>
						<?php _e('Comments: ','scapegoat'); ?>
					</span>
					<span class="value">
						<?php comments_popup_link(
							__('0','scapegoat'),
							__('1','scapegoat'),
							__('%','scapegoat'),
							'comments-link',
							__('closed','scapegoat')
						); ?>
					</span>
				</span>
				</aside>

				<aside class="widget widget-sidebar post-meta">
				<figure class="author-avatar">
					<?php if (function_exists('get_avatar')) { echo get_avatar(get_the_author_email(), 96); }?>
				</figure>
				<?php if(get_the_author_meta('twitter')) : ?>
				<span class="author-twitter">
					<span class="label">
						<i class="icon-twitter"></i>
						<?php _e('Twitter: ','scapegoat') ?>
					</span>
					<span class="value">
						<a target="_blank" href="https://twitter.com/<?php the_author_meta('twitter');?>">@<?php the_author_meta('twitter');?></a>
					</span>
				</span>
				<?php endif; ?>
				
				<?php if(get_the_author_meta('wiki')) : ?>
				<span class="author-wiki">
					<span class="label">
						<i class="icon-book"></i>
						<?php _e('Wiki: ','scapegoat') ?>
					</span>
					<span class="value">
						<a target="_blank" href="https://wiki.piratenpartei.de/Benutzer:<?php the_author_meta('wiki');?>"><?php the_author_meta('wiki');?></a>
					</span>
				</span>
				<?php endif; ?>
				
				<?php if(get_the_author_meta('user_url')) : ?>
				<span class="author-website">
					<span class="label">
						<i class="icon-globe"></i>
						<?php _e('Website: ','scapegoat') ?>
					</span>
					<span class="value">
						<a target="_blank" href="<?php the_author_meta('user_url'); ?>"><?php the_author_meta('user_url'); ?></a>
					</span>
				</span>
				<?php endif; ?>
				<?php if(get_the_author_meta('description')) : ?>
				<span class="author-biography">
					<!--<span class="label">
						<?php _e('Biography: ','scapegoat') ?>
					</span>-->
					<span class="value">
						<?php the_author_meta('description'); ?>
					</span>
				</span>
				<?php endif; ?>
				<div class="clear"></div>
				</aside>
			</section>
			
			<?php get_sidebar(); ?>
			<div class="clear"></div>
		</div>

			</div><!-- wrapper-inside -->
		</div><!-- wrapper-outside -->

		<?php get_footer(); ?>