		<?php get_header(); ?>

		<div id="title-outside">
			<div id="title-inside" class="inside">
				<header class="title-header">
					<h2 class="post-title">
						<?php the_title(); ?>
						<?php edit_post_link(__('Edit','farewell'),'<span class="edit-link">','</span>'); ?>
					</h2>
				</header>
			</div>			
		</div>

		<div id="wrapper-outside">
			<div id="wrapper-inside" class="inside">

		<div id="container">

			<div id="content" class="content" role="main">
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<section id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
					<header class="header">
						<?php breadcrumb(); ?>
						<!--<h1 class="post-title">
							<?php the_title(); ?>
							<?php edit_post_link(__('Edit','farewell'),'<span class="edit-link">','</span>'); ?>
						</h1>-->
					</header>
	
					<article class="article">
						<?php wp_link_pages('before=<nav class="pagination_post">'. __("Pages:","farewell") .'&after=</nav>'); ?>
						<?php the_content(); ?>
						<?php wp_link_pages('before=<nav class="pagination_post">'. __("Pages:","farewell") .'&after=</nav>'); ?>
					</article>
					
				</section>
				
				<?php endwhile; ?>
				
					<section id="replys">
						<?php comments_template(); ?>
					</section>
				
				<?php endif; ?>
				<div class="clear"></div>
			</div>

			<?php get_sidebar(); ?>
			<div class="clear"></div>
		</div>

			</div><!-- wrapper-inside -->
		</div><!-- wrapper-outside -->

		<?php get_footer(); ?>