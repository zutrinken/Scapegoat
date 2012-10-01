		<?php get_header(); ?>

		<div id="container">

			<?php get_sidebar(); ?>
			
			<div id="content">
				<header class="heading">
					<h1 class="title"><?php _e('Search for','scapegoat'); ?> "<?php the_search_query(); ?>"</h1>
				</header>

			<?php if (have_posts()) : ?>

			<div id="categories">			

			<?php while (have_posts()) : the_post(); ?>
			<section class="post">

				<hgroup class="header">
					<h2 class="post-title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</hgroup>

				<article class="article">
					<?php the_excerpt(); ?>
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

			<?php else : ?>

			<section class="post">
			
			</section>

			<?php endif; ?>
			</div>

		</div>

		<?php get_footer(); ?>