<?php $options = get_option('scapegoat_theme_options'); ?>
<section id="sidebar">
	<?php if($options['header-option'] == 'show-none') : ?>
		<span id="sidebar-description"><?php bloginfo('description'); ?></span>
	<?php endif; ?>
	<?php if (function_exists('submenu') && $options['submenu-show']) { submenu(); } ?>
	<?php dynamic_sidebar('Main-Sidebar'); ?>
</section>