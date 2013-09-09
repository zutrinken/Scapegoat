		<?php get_header(); ?>

		<?php get_header(); ?>
		<?php $detect = new Mobile_Detect(); ?>
		
			<div id="title-outside">
				<div id="title-inside" class="inside">
					<header class="title-header">
						<h2 class="post-title">
							<?php the_title(); ?>
							<?php edit_post_link(__('Edit','scapegoat'),'<span class="edit-link">','</span>'); ?>
						</h2>
					</header>
				</div>
			</div>
		
		<div id="wrapper-outside">
			<div id="wrapper-inside" class="inside">

		<div id="container">
			
			<div id="content" class="full" role="main">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<article class="article">
					<?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "full"); ?>
						<img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>" alt="<?php $post->post_excerpt; ?>" />
					<?php else : ?>
						<a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo wp_specialchars( get_the_title($post->ID), 1 ) ?>" rel="attachment">
						<?php echo basename($post->guid) ?>
					<?php endif; ?>
				</article>
			</section>
			<?php endwhile; endif; ?>
			</div><!-- full -->

			<div class="clear"></div>
		</div><!-- container -->
		
			</div><!-- wrapper-inside -->
		</div><!-- wrapper-outside -->

		<?php get_footer(); ?>