		<?php get_header(); ?>

		<div id="container">
			
			<div id="content">
			
				<header class="heading">
					<h1 class="title">
					<?php if (is_tag()) : ?>
						<h1 class="title">
							<?php _e('Tag','scapegoat'); ?> "<?php single_tag_title(); ?>"
						</h1
					<?php elseif (is_category()) : ?>
						<h1 class="title">
							<?php _e('Category','scapegoat'); ?> "<?php single_cat_title(); ?>"
						</h1>
					<?php elseif (is_author()) : ?>
						<?php global $author; $userdata = get_userdata($author); ?>
						<h1 class="title"><?php _e('Author','scapegoat'); ?> "<?php echo $userdata->display_name; ?>"</h1>
					<?php elseif (is_day()) : ?>
						<h1 class="title">
							<?php _e('Date','scapegoat'); ?> "<?php the_time('j. F Y'); ?>"
						</h1>	
					<?php elseif (is_month()) : ?>
						<h1 class="title">
							<?php _e('Month','scapegoat'); ?> "<?php the_time('F Y'); ?>"
						</h1>
					<?php elseif (is_year()) : ?>
						<h1 class="title">
							<?php _e('Year','scapegoat'); ?> "<?php the_time('Y'); ?>"
						</h1>
					<?php else : ?>
						<h1 class="title">
							<?php _e('Archive','scapegoat'); ?>
						</h1>
					<?php endif; ?>
					</h1>
					<aside class="sub-title">
						<?php if (is_category()) : ?>

							<?php echo category_description(); ?>

						<?php elseif (is_author()) : ?>
						
							<?php $userInfo = get_user_by('slug', get_query_var('author_name')); ?>
							<?php if (function_exists('get_avatar')) { echo get_avatar($userInfo->user_email, 48); } ?>

							<div class="sub-title-links">
							<?php if($userdata->twitter == TRUE) : ?>
								<span class="sub-title-link sub-title-twitter">
									<a target="_blank" href="https://twitter.com/<?php echo $userdata->twitter; ?>">@<?php echo $userdata->twitter; ?></a>
									<span class="label">// <?php _e('Twitter','scapegoat') ?></span>
								</span>
							<?php endif; ?>
						
							<?php if($userdata->wiki == TRUE) : ?>
								<span class="sub-title-link sub-title-wiki">
									<a target="_blank" href="https://wiki.piratenpartei.de/Benutzer:<?php echo $userdata->wiki; ?>"><?php echo $userdata->wiki; ?></a>
									<span class="label">// <?php _e('Wiki','scapegoat') ?></span>
								</span>
							<?php endif; ?>

							<?php if($userdata->user_url == TRUE) : ?>
								<span class="sub-title-link sub-title-website">
									<a target="_blank" href="<?php echo $userdata->user_url; ?>"><?php echo $userdata->user_url; ?></a>
									<span class="label">// <?php _e('Website','scapegoat') ?></span>
								</span>
							<?php endif; ?>
							</div>

							<?php if($userdata->description == TRUE) : ?>
								<div class="sub-title-description">
									<?php echo $userdata->description; ?>
								</div>
							<?php endif; ?>
							
						<?php endif; ?>
					</aside>
				</header>

			<?php if (have_posts()) : ?>

			<?php if($options['custom-excerpt'] == TRUE) : ?>
				<div id="archive">
			<?php else : ?>
				<div id="archive-full">
			<?php endif; ?>


			<?php while (have_posts()) : the_post(); ?>
			<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php edit_post_link( __( 'Edit', 'scapegoat' ), '<span class="edit-link">', '</span>' ); ?>

					<?php if($options['custom-excerpt'] == TRUE) : ?>
						<?php if(has_post_thumbnail()) : ?>
							<figure class="post-archiv-image">
								<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('medium'); ?>
								</a>
							</figure>
						<?php endif; ?>
					<?php endif; ?>

				<header class="header">
					<h2 class="post-title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<aside class="meta">
						<span class="post-date"><?php the_time('j.m.y'); ?></span>
						<span class="post-author"><?php the_author_posts_link(); ?></span>
					</aside>
				</header>

				<article class="article">
					<?php if($options['custom-excerpt'] == TRUE) : ?>
						<?php the_excerpt(); ?>
					<?php else : ?>
						<?php the_content(); ?>
					<?php endif; ?>
				</article>
				
			</section>
			
			<?php endwhile; ?>

			</div>
			
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