<?php $options = get_option('scapegoat_theme_options'); ?>
<section id="sidebar">
	<?php if (function_exists('submenu') && $options['submenu-show']) { submenu(); } ?>
	<?php dynamic_sidebar('Main-Sidebar'); ?>
	<div class="clear"></div>
</section>