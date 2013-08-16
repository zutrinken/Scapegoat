		<?php get_header(); ?>

		<div id="title-outside">
			<div id="title-inside" class="inside">
				<header class="title-header">
					<h2 class="post-title">
						<?php _e('Search','scapegoat'); ?> "<?php the_search_query(); ?>"		
					</h2>
				</header>
			</div>			
		</div>

		<div id="wrapper-outside">
			<div id="wrapper-inside" class="inside">

		<div id="container">

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
				
				<div class="clear"></div>
				
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