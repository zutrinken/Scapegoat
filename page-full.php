<?php /* Template Name: Ohne Sidebar */ ?>

		<?php get_header(); ?>

		<div id="container">
			
			<div id="full">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php edit_post_link( __( 'Edit', 'scapegoat' ), '<span class="edit-link">', '</span>' ); ?>

				<header class="header">
					<h1 class="post-title"><?php the_title(); ?></h1>
				</header>

				<article class="article">
					<?php wp_link_pages('before=<nav class="pagination_post">'. __("Pages:","scapegoat") .'&after=</nav>'); ?>
					<?php the_content(); ?>
					<?php wp_link_pages('before=<nav class="pagination_post">'. __("Pages:","scapegoat") .'&after=</nav>'); ?>
				</article>
				
			</section>
			
			<?php endwhile; ?>
			
				<section id="replys">
					<?php comments_template(); ?>
				</section>
			
			<?php endif; ?>
			</div>

		</div>

		<?php get_footer(); ?>