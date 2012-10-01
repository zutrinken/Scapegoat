<?php
/* ------------------ */
/* theme options page */
/* ------------------ */

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

// Einstellungen registrieren (http://codex.wordpress.org/Function_Reference/register_setting)
function theme_options_init(){
	register_setting( 'scapegoat_options', 'scapegoat_theme_options', 'scapegoat_validate_options' );
}

// Seite in der Dashboard-Navigation erstellen
function theme_options_add_page() {
	// Seitentitel, Titel in der Navi, Berechtigung zum Editieren (http://codex.wordpress.org/Roles_and_Capabilities) , Slug, Funktion
	add_theme_page('Theme-Options', 'Theme-Options', 'edit_theme_options', 'theme-options', 'scapegoat_theme_options_page' );
}

// Optionen-Seite erstellen
function scapegoat_theme_options_page() {
	global $select_options, $radio_options;
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false; ?>

	<div class="wrap">

		<!-- Titel -->
		<?php screen_icon(); ?><h2><?php _e('Scapegoat Theme-Options','scapegoat'); ?></h2> 

		<!-- Message -->
		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade">
			<p><strong><?php _e('Settings saved!','scapegoat'); ?></strong></p>
		</div>
		<?php endif; ?>

		<!-- Settings -->
		<form method="post" action="options.php">
			<?php settings_fields( 'scapegoat_options' ); ?>
			<?php $options = get_option( 'scapegoat_theme_options' ); ?>

			<h3><?php _e('Graphics','scapegoat'); ?></h3>
			<p><?php printf(__('Choose an Image from your <a target="_blank" href="%s/wp-admin/upload.php">Library</a> or <a target="_blank" href="%s/wp-admin/media-new.php">upload</a> a new one.','scapegoat'), get_home_url(), get_home_url()); ?></p>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">Logo (Url)</th>
					<td>
						<input id="scapegoat_theme_options[logo]" class="regular-text" type="text" name="scapegoat_theme_options[logo]" value="<?php esc_attr_e( $options['logo'] ); ?>" />
						<?php if($options['logo'] == TRUE) : ?>
							<img style="max-width: 240px; vertical-align: top;margin: 0 0 0 20px;" src="<?php esc_attr_e( $options['logo'] ); ?>" alt="" />
						<?php endif; ?>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Touch Icon (URL)</th>
					<td>
						<input id="scapegoat_theme_options[icon]" class="regular-text" type="text" name="scapegoat_theme_options[icon]" value="<?php esc_attr_e( $options['icon'] ); ?>" />
						<?php if($options['icon'] == TRUE) : ?>
							<img style="max-width: 44px; vertical-align: top;margin: 0 0 0 20px;" src="<?php esc_attr_e( $options['icon'] ); ?>" alt="" />
						<?php endif; ?>
					</td>
				</tr>
			</table>
			<h3><?php _e('Articles','scapegoat'); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e('Excerpt','scapegoat'); ?></th>
					<td>
						<label for="scapegoat_theme_options[custom-excerpt]">
							<input id="scapegoat_theme_options[custom-excerpt]" type="checkbox" name="scapegoat_theme_options[custom-excerpt]" value="1" <?php checked( '1', $options['custom-excerpt'] ); ?> /> <?php _e('automatic excerpts','scapegoat'); ?> <span class="description"><?php _e("if this is checked, you don't need more-tags",'scapegoat'); ?></span>
						</label>
					</td>
				</tr>
			</table>
			<h3><?php _e('Navigation','scapegoat'); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e('Breadcrumb-Navigation','scapegoat'); ?></th>
					<td>
						<label for="scapegoat_theme_options[breadcrumb-show]">
							<input id="scapegoat_theme_options[breadcrumb-show]" type="checkbox" name="scapegoat_theme_options[breadcrumb-show]" value="1" <?php checked( '1', $options['breadcrumb-show'] ); ?> /> <?php _e('show','scapegoat'); ?>
						</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Submenu','scapegoat'); ?></th>
					<td>
						<label for="scapegoat_theme_options[submenu-show]">
							<input id="scapegoat_theme_options[submenu-show]" type="checkbox" name="scapegoat_theme_options[submenu-show]" value="1" <?php checked( '1', $options['submenu-show'] ); ?> /> <?php _e('show','scapegoat'); ?> <span class="description"><?php _e('at the top of the sidebar','scapegoat'); ?></span></td>
						</label>
					</td>
				</tr>
			</table>




			<h3><?php _e('Header','scapegoat'); ?></h3>
			<p><?php _e('Customize the Header on the Front-Page.','scapegoat'); ?></p>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e('What should be displayed?','scapegoat'); ?></th>
					<td>
						<label for="show-slider">
							<input id="show-slider" type="radio" name="scapegoat_theme_options[header-option]" value="show-slider" <?php checked( 'show-slider' == $options['header-option'] ); ?> /> <?php _e('Slider','scapegoat'); ?>
						</label>
						<br />
						<label for="show-header">
							<input id="show-header" type="radio" name="scapegoat_theme_options[header-option]" value="show-header" <?php checked( 'show-header' == $options['header-option'] ); ?> /> <?php _e('Header','scapegoat'); ?>
						</label>
						<br />
						<label for="show-none">
							<input id="show-none" type="radio" name="scapegoat_theme_options[header-option]" value="show-none" <?php checked( 'show-none' == $options['header-option'] ); ?> /> <?php _e('Nothing','scapegoat'); ?>
						</label>
					</td>
				</tr>
			</table>
				
			<h3><?php _e('Slider-settings','scapegoat'); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e('Category (ID)','scapegoat'); ?></th>
					<td><input id="scapegoat_theme_options[slider-cat]" class="small-text" type="text" name="scapegoat_theme_options[slider-cat]" value="<?php esc_attr_e( $options['slider-cat'] ); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Amount of slides','scapegoat'); ?></th>
					<td><input id="scapegoat_theme_options[slider-num]" class="small-text" type="text" name="scapegoat_theme_options[slider-num]" value="<?php esc_attr_e( $options['slider-num'] ); ?>" /> <span class="description"><?php _e('Slides','scapegoat'); ?></span></td>
				</tr>
			</table>



			<h3><?php _e('Featured Links','scapegoat'); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">Link 1</th>
					<td>
						<input id="scapegoat_theme_options[featured-link-1]" class="regular-text" type="text" name="scapegoat_theme_options[featured-link-1]" value="<?php esc_attr_e( $options['featured-link-1'] ); ?>" /> <span class="description">URL</span><br />
						<input id="scapegoat_theme_options[featured-link-title-1]" class="regular-text" type="text" name="scapegoat_theme_options[featured-link-title-1]" value="<?php esc_attr_e( $options['featured-link-title-1'] ); ?>" /> <span class="description"><?php _e('Title','scapegoat'); ?></span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Link 2</th>
					<td>
						<input id="scapegoat_theme_options[featured-link-2]" class="regular-text" type="text" name="scapegoat_theme_options[featured-link-2]" value="<?php esc_attr_e( $options['featured-link-2'] ); ?>" /> <span class="description">URL</span><br />
						<input id="scapegoat_theme_options[featured-link-title-2]" class="regular-text" type="text" name="scapegoat_theme_options[featured-link-title-2]" value="<?php esc_attr_e( $options['featured-link-title-2'] ); ?>" /> <span class="description"><?php _e('Title','scapegoat'); ?></span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Link 3</th>
					<td>
						<input id="scapegoat_theme_options[featured-link-3]" class="regular-text" type="text" name="scapegoat_theme_options[featured-link-3]" value="<?php esc_attr_e( $options['featured-link-3'] ); ?>" /> <span class="description">URL</span><br />
						<input id="scapegoat_theme_options[featured-link-title-3]" class="regular-text" type="text" name="scapegoat_theme_options[featured-link-title-3]" value="<?php esc_attr_e( $options['featured-link-title-3'] ); ?>" /> <span class="description"><?php _e('Title','scapegoat'); ?></span>
					</td>
				</tr>
			</table>
			<h3><?php _e('Social Networks','scapegoat'); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><img style="background: #ee9900;vertical-align: middle;padding: 2px;margin: 0 10px 0 0;" src="<?php bloginfo('template_directory') ?>/images/icon-rss.png" alt="" /> Feed (Url)</th>
					<td><input id="scapegoat_theme_options[rss]" class="regular-text" type="text" name="scapegoat_theme_options[rss]" value="<?php esc_attr_e( $options['rss'] ); ?>" /> <span class="description"> <?php _e('if this is empty, the default Wordpress-feed will set','scapegoat'); ?></span></td>
				</tr>
				<tr valign="top">
					<th scope="row"><img style="background: #3ea9dd;vertical-align: middle;padding: 2px;margin: 0 10px 0 0;" src="<?php bloginfo('template_directory') ?>/images/icon-twitter.png" alt="" /> Twitter (Url)</th>
					<td><input id="scapegoat_theme_options[twitter]" class="regular-text" type="text" name="scapegoat_theme_options[twitter]" value="<?php esc_attr_e( $options['twitter'] ); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><img style="background: #3c5a98;vertical-align: middle;padding: 2px;margin: 0 10px 0 0;" src="<?php bloginfo('template_directory') ?>/images/icon-facebook.png" alt="" /> Facebook (Url)</th>
					<td><input id="scapegoat_theme_options[facebook]" class="regular-text" type="text" name="scapegoat_theme_options[facebook]" value="<?php esc_attr_e( $options['facebook'] ); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><img style="background: #d14836;vertical-align: middle;padding: 2px;margin: 0 10px 0 0;" src="<?php bloginfo('template_directory') ?>/images/icon-plus.png" alt="" /> Google + (Url)</th>
					<td><input id="scapegoat_theme_options[google]" class="regular-text" type="text" name="scapegoat_theme_options[google]" value="<?php esc_attr_e( $options['google'] ); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><img style="background: #c6312b;vertical-align: middle;padding: 2px;margin: 0 10px 0 0;" src="<?php bloginfo('template_directory') ?>/images/icon-youtube.png" alt="" /> Youtube (Url)</th>
					<td><input id="scapegoat_theme_options[youtube]" class="regular-text" type="text" name="scapegoat_theme_options[youtube]" value="<?php esc_attr_e( $options['youtube'] ); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><img style="background: #829f0c;vertical-align: middle;padding: 2px;margin: 0 10px 0 0;" src="<?php bloginfo('template_directory') ?>/images/icon-mail.png" alt="" /> Newsletter (URL)</th>
					<td><input id="scapegoat_theme_options[mail]" class="regular-text" type="text" name="scapegoat_theme_options[mail]" value="<?php esc_attr_e( $options['mail'] ); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><img style="background: #408ad2;vertical-align: middle;padding: 2px;margin: 0 10px 0 0;" src="<?php bloginfo('template_directory') ?>/images/icon-podcast.png" alt="" /> Podcast (URL)</th>
					<td><input id="scapegoat_theme_options[podcast]" class="regular-text" type="text" name="scapegoat_theme_options[podcast]" value="<?php esc_attr_e( $options['podcast'] ); ?>" /></td>
				</tr>
			</table>
			<!-- Submit -->
			<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save','scapegoat'); ?>" /></p>
		</form>
	</div>
<?php }

function scapegoat_validate_options($input) {
	// $input['copyright'] = wp_filter_nohtml_kses( $input['copyright'] );
	return $input;
}

?>