		<?php get_header(); ?>

		<div id="container">

			<?php get_sidebar(); ?>
			
			<div id="content">

				<?php if(function_exists('breadcrumb')) : ?>
					<?php breadcrumb(); ?> 
				<?php endif; ?>


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
			
				<nav id="pagination">
					<?php if( function_exists('wp_pagination_navi') ) : ?>
						<?php wp_pagination_navi(); ?>
					<?php else : ?>
						<div class="alignleft"><?php previous_posts_link('&laquo; prev', 0); ?></div>
						<div class="alignright"><?php next_posts_link('next &raquo;', 0) ?></div>
					<?php endif; ?>
				</nav>

			<?php else : ?>

			<?php endif; ?>
			</div><!-- content -->
			

			<div class="clear"></div>
		</div><!-- container -->

		<?php get_footer(); ?>