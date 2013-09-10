<?php $options = get_option('scapegoat_theme_options'); ?>
<section id="sidebar" class="sidebar" role="complementary">
	<h2 id="sidebar-title" class="visuallyhidden"><?php _e('Sidebar','scapegoat'); ?></h2>
	<?php dynamic_sidebar('Main-Sidebar'); ?>
	<div class="clear"></div>
</section>