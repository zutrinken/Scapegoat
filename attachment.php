		<?php get_header(); ?>

		<!-- Mobiel Detect -->
		<?php $detect = new Mobile_Detect(); ?>

		<div id="container">
			
			<div id="full">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="header">
					<h1 class="post-title"><?php the_title(); ?></h1>
				</header>

				<article class="article">
					<?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "full"); ?>
                        <p class="attachment">
                        	<a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment">
                        		<img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>"  class="attachment-medium" alt="<?php $post->post_excerpt; ?>" />
                        	</a>
                        </p>
					<?php else : ?>
                        <a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo wp_specialchars( get_the_title($post->ID), 1 ) ?>" rel="attachment">
                        	<?php echo basename($post->guid) ?>
                        </a>
					<?php endif; ?>
				</article>

			</section>
			
			<?php endwhile; endif; ?>
			</div><!-- full -->

			<div class="clear"></div>
		</div><!-- container -->

		<?php get_footer(); ?>