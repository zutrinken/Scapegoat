<?php $options = get_option('scapegoat_theme_options'); ?>
<section id="sidebar">
	<span id="sidebar-description"><?php bloginfo('description'); ?></span>
	<?php if (function_exists('submenu') && $options['submenu-show']) { submenu(); } ?>
	<?php dynamic_sidebar('Main-Sidebar'); ?>
</section>