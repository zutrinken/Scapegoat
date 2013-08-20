		<?php get_header(); ?>

		<div id="title-outside">
			<div id="title-inside" class="inside">
				<header class="title-header">
					<h2 class="post-title">
						<?php if (is_category()) : ?>
							<i class="icon-folder-open"></i>
							<span class="label"><?php _e('Category','scapegoat'); ?></span>
							<span class="value"><?php single_cat_title(); ?></span>
						<?php elseif (is_tag()) : ?>
							<i class="icon-tag"></i>
							<span class="label"><?php _e('Tag','scapegoat'); ?></span>
							<span class="value"><?php single_tag_title(); ?></span>
						<?php elseif (is_author()) : ?>
							<i class="icon-user"></i>
							<span class="label"><?php _e('Author','scapegoat'); ?></span>
							<span class="value"><?php
								$userInfo = get_user_by('slug', get_query_var('author_name'));
								echo $userInfo->display_name;
							?></span>
						<?php elseif (is_day()) : ?>
							<i class="icon-calendar"></i>
							<span class="label"><?php _e('Day','scapegoat'); ?></span>
							<span class="value"><?php the_time('j. F Y'); ?></span>
						<?php elseif (is_month()) : ?>
							<i class="icon-calendar"></i>
							<span class="label"><?php _e('Month','scapegoat'); ?></span>
							<span class="value"><?php the_time('F Y'); ?></span>
						<?php elseif (is_year()) : ?>
							<i class="icon-calendar"></i>
							<span class="label"><?php _e('Year','scapegoat'); ?></span>
							<span class="value"><?php the_time('Y'); ?></span>
						<?php else : ?>
							<span class="value"><?php _e('Archive','scapegoat'); ?></span>
						<?php endif; ?>
					</h2>
					<?php if (is_category() && category_description()) : ?>
						<aside class="post-description">
							<?php echo category_description(); ?>
						</aside>
					<?php endif; ?>
				</header>
			</div>			
		</div>
		
		<div id="wrapper-outside">
			<div id="wrapper-inside" class="inside">

		<div id="container">
			<?php if (is_author()) : ?>
				
				<section id="author-meta-archive" class="post-meta sidebar" role="complementary">
					<?php $userInfo = get_user_by('slug', get_query_var('author_name')); ?>
					<figure class="author-avatar">
						<?php if (function_exists('get_avatar')) { echo get_avatar($userInfo->user_email, 96); } ?>
					</figure>
					<?php if($userInfo->twitter) : ?>
					<span class="author-twitter">
						<span class="label">
							<i class="icon-twitter"></i>
							<?php _e('Twitter: ','scapegoat') ?>
						</span>
						<span class="value">
							<a target="_blank" href="https://twitter.com/<?php echo $userInfo->twitter; ?>">@<?php echo $userInfo->twitter; ?></a>
						</span>
					</span>
					<?php endif; ?>

					<?php if($userInfo->wiki) : ?>
					<span class="author-wiki">
						<span class="label">
							<i class="icon-book"></i>
							<?php _e('Wiki: ','scapegoat') ?>
						</span>
						<span class="value">
							<a target="_blank" href="https://wiki.piratenpartei.de/Benutzer:<?php echo $userInfo->wiki; ?>"><?php echo $userInfo->wiki; ?></a>
						</span>
					</span>
					<?php endif; ?>
					
					<?php if($userInfo->user_url) : ?>
					<span class="author-website">
						<span class="label">
							<i class="icon-globe"></i>
							<?php _e('Website: ','scapegoat') ?>
						</span>
						<span class="value">
							<a target="_blank" href="<?php echo $userInfo->user_url; ?>"><?php echo $userInfo->user_url; ?></a>
						</span>
					</span>
					<?php endif; ?>

					<?php if($userInfo->description) : ?>
					<span class="author-biography">
						<!--<span class="label">
							<?php _e('Biography: ','scapegoat') ?>
						</span>-->
						<span class="value">
							<?php echo $userInfo->description; ?>
						</span>
					</span>
					<?php endif; ?>
					<div class="clear"></div>
				</section>				
			<?php endif; ?>

			<div id="content" class="content" role="main">
			
			<?php breadcrumb(); ?>
			
			<?php if (have_posts()) : ?>

			<?php while (have_posts()) : the_post(); ?>
			<section id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

				<header class="header">
					<h2 class="post-title">
						<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
						<?php edit_post_link(__('Edit','scapegoat'),'<span class="edit-link">','</span>'); ?>
					</h2>
				</header>
				
				<?php if(has_post_thumbnail()) : ?>
					<figure class="post-image">
						<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('featured-small'); ?>
						</a>
					</figure>
				<?php else : ?>
					<?php echo catch_post_image(); ?>
				<?php endif; ?>

				<article class="article">
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>" class="post-more"><?php _e('more','scapegoat'); ?> &#x9b;</a>
				</article>
				
				<?php if(!has_post_format('status')) : ?>
					<footer class="footer post-meta">
						<span class="post-date">
							<i class="icon-calendar"></i>
							<?php the_time('j.m.y'); ?>
						</span>
						<span class="post-categories">
							<i class="icon-folder-open"></i>
							<?php _e('Category: ','scapegoat'); ?>
							<?php the_category(', '); ?>
						</span>
					</footer>
				<?php endif; ?>
				
				<div class="clear"></div>
				
			</section>
			
			<?php endwhile; ?>
			
				<nav id="pagination">
					<h2 id="pagination-title" class="visuallyhidden"><?php _e('Article Navigation','scapegoat'); ?></h2>
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