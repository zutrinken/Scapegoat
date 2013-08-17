<?php
/* ------------------ */
/* theme options page */
/* ------------------ */

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );


add_action('admin_init', 'scapegoat_add_init');
function scapegoat_add_init() {
	$file_dir = get_template_directory_uri();
	wp_enqueue_style('scapegoatCss', $file_dir.'/inc/theme-options.css', false, '1.0', 'all');
	wp_enqueue_script('scapegoatJs', $file_dir.'/inc/theme-options.js', false, '1.0', 'all');
}



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

	<div class="wrap" id="arrr">

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
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Touch Icon (URL)</th>
					<td>
						<input id="scapegoat_theme_options[icon]" class="regular-text" type="text" name="scapegoat_theme_options[icon]" value="<?php esc_attr_e( $options['icon'] ); ?>" />
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
					<th scope="row"><?php _e('Submenu','scapegoat'); ?></th>
					<td>
						<label for="scapegoat_theme_options[submenu-show]">
							<input id="scapegoat_theme_options[submenu-show]" type="checkbox" name="scapegoat_theme_options[submenu-show]" value="1" <?php checked( '1', $options['submenu-show'] ); ?> /> <?php _e('show','scapegoat'); ?> <span class="description"><?php _e('at the top of the sidebar','scapegoat'); ?></span></td>
						</label>
					</td>
				</tr>
			</table>

			<h3><?php _e('Appearance','scapegoat'); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e('Style','scapegoat'); ?></th>
					<td>
						<label for="show-default">
							<input id="show-default" type="radio" name="scapegoat_theme_options[style-option]" value="show-default" <?php checked( 'show-default' == $options['style-option'] ); ?> /> <?php _e('Default','scapegoat'); ?>
						</label>
						
						<br />
					
						<label for="show-special-1">
							<input id="show-special-1" type="radio" name="scapegoat_theme_options[style-option]" value="show-special-1" <?php checked( 'show-special-1' == $options['style-option'] ); ?> /> <?php _e('#BTW13 - Personal Blog','scapegoat'); ?> <span class="description"><?php _e('If activated the frontpage settings are useless','scapegoat'); ?></span>
						</label>
						
						<table class="widefat special-1">
							<tr valign="top">
								<th scope="row"><?php _e('Logo','scapegoat'); ?></th>
								<td><input id="scapegoat_theme_options[special-1-logo]" class="regular-text" type="text" name="scapegoat_theme_options[special-1-logo]" value="<?php esc_attr_e( $options['special-1-logo'] ); ?>" /> <span class="description"><?php _e("Optimal Pixel Size: 720x240",'scapegoat'); ?></span></td>
							</tr>
							<tr valign="top">
								<th scope="row"><?php _e('Portrait','scapegoat'); ?></th>
								<td><input id="scapegoat_theme_options[special-1-portrait]" class="regular-text" type="text" name="scapegoat_theme_options[special-1-portrait]" value="<?php esc_attr_e( $options['special-1-portrait'] ); ?>" /> <span class="description"><?php _e("Optimal Pixel Size: 640x960",'scapegoat'); ?></span></td>
							</tr>
							<tr valign="top">
								<th scope="row"><?php _e('Background','scapegoat'); ?></th>
								<td>
									<label for="special-1-bg-1">
										<input id="special-1-bg-1" type="radio" name="scapegoat_theme_options[special-1-bg-option]" value="special-1-bg-1" <?php checked( 'special-1-bg-1' == $options['special-1-bg-option'] ); ?> /> <?php _e('Blue','scapegoat'); ?> <span class="description"> <?php _e('Default','scapegoat'); ?></span>
									</label>
									<br />
									<label for="special-1-bg-2">
										<input id="special-1-bg-2" type="radio" name="scapegoat_theme_options[special-1-bg-option]" value="special-1-bg-2" <?php checked( 'special-1-bg-2' == $options['special-1-bg-option'] ); ?> /> <?php _e('Orange','scapegoat'); ?>
									</label>
							</tr>
						</table>
						
						<br />
						
						<label for="show-special-2">
							<input id="show-special-2" type="radio" name="scapegoat_theme_options[style-option]" value="show-special-2" <?php checked( 'show-special-2' == $options['style-option'] ); ?> /> <?php _e('#BTW13 - Organisation Blog','scapegoat'); ?>
						</label>
						
						<table class="widefat special-2">
							<tr valign="top">
								<th scope="row"><?php _e('Logo','scapegoat'); ?></th>
								<td><input id="scapegoat_theme_options[special-1-logo]" class="regular-text" type="text" name="scapegoat_theme_options[special-2-logo]" value="<?php esc_attr_e( $options['special-2-logo'] ); ?>" /> <span class="description"><?php _e("Optimal Pixel Size: 720x240",'scapegoat'); ?></span></td>
							</tr>
							<tr valign="top">
								<th scope="row"><?php _e('Background','scapegoat'); ?></th>
								<td>
									<label for="special-2-bg-1">
										<input id="special-2-bg-1" type="radio" name="scapegoat_theme_options[special-2-bg-option]" value="special-2-bg-1" <?php checked( 'special-2-bg-1' == $options['special-2-bg-option'] ); ?> /> <?php _e('Blue','scapegoat'); ?> <span class="description"> <?php _e('Default','scapegoat'); ?></span>
									</label>
									<br />
									<label for="special-2-bg-2">
										<input id="special-2-bg-2" type="radio" name="scapegoat_theme_options[special-2-bg-option]" value="special-2-bg-2" <?php checked( 'special-2-bg-2' == $options['special-2-bg-option'] ); ?> /> <?php _e('Orange','scapegoat'); ?>
									</label>
							</tr>
						</table>
						
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Frontpage','scapegoat'); ?></th>
					<td>
						<label for="show-slider">
							<input id="show-slider" type="radio" name="scapegoat_theme_options[header-option]" value="show-slider" <?php checked( 'show-slider' == $options['header-option'] ); ?> /> <?php _e('Slider','scapegoat'); ?>
						</label>

						<table class="widefat slider">
							<tr valign="top">
								<th scope="row"><?php _e('Category (ID)','scapegoat'); ?></th>
								<td><input id="scapegoat_theme_options[slider-cat]" class="small-text" type="text" name="scapegoat_theme_options[slider-cat]" value="<?php esc_attr_e( $options['slider-cat'] ); ?>" /> <span class="description"><?php _e('If empty all categories will shown','scapegoat'); ?></span></td>
							</tr>
							<tr valign="top">
								<th scope="row"><?php _e('Amount of slides','scapegoat'); ?></th>
								<td><input id="scapegoat_theme_options[slider-num]" class="small-text" type="text" name="scapegoat_theme_options[slider-num]" value="<?php esc_attr_e( $options['slider-num'] ); ?>" /> <span class="description"><?php _e('If empty 5 Slides will shown','scapegoat'); ?></span></td>
							</tr>
						</table>

						<table class="widefat slider">
							<tr valign="top">
								<th scope="row">Link 1</th>
								<td>
									<input id="scapegoat_theme_options[featured-link-1]" class="regular-text" type="text" name="scapegoat_theme_options[featured-link-1]" value="<?php esc_attr_e( $options['featured-link-1'] ); ?>" /> <span class="description">URL</span>
									<input id="scapegoat_theme_options[featured-link-title-1]" class="medium-text" type="text" name="scapegoat_theme_options[featured-link-title-1]" value="<?php esc_attr_e( $options['featured-link-title-1'] ); ?>" /> <span class="description"><?php _e('Title','scapegoat'); ?></span>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">Link 2</th>
								<td>
									<input id="scapegoat_theme_options[featured-link-2]" class="regular-text" type="text" name="scapegoat_theme_options[featured-link-2]" value="<?php esc_attr_e( $options['featured-link-2'] ); ?>" /> <span class="description">URL</span>
									<input id="scapegoat_theme_options[featured-link-title-2]" class="medium-text" type="text" name="scapegoat_theme_options[featured-link-title-2]" value="<?php esc_attr_e( $options['featured-link-title-2'] ); ?>" /> <span class="description"><?php _e('Title','scapegoat'); ?></span>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">Link 3</th>
								<td>
									<input id="scapegoat_theme_options[featured-link-3]" class="regular-text" type="text" name="scapegoat_theme_options[featured-link-3]" value="<?php esc_attr_e( $options['featured-link-3'] ); ?>" /> <span class="description">URL</span>
									<input id="scapegoat_theme_options[featured-link-title-3]" class="medium-text" type="text" name="scapegoat_theme_options[featured-link-title-3]" value="<?php esc_attr_e( $options['featured-link-title-3'] ); ?>" /> <span class="description"><?php _e('Title','scapegoat'); ?></span>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">Link 3</th>
								<td>
									<input id="scapegoat_theme_options[featured-link-4]" class="regular-text" type="text" name="scapegoat_theme_options[featured-link-4]" value="<?php esc_attr_e( $options['featured-link-4'] ); ?>" /> <span class="description">URL</span>
									<input id="scapegoat_theme_options[featured-link-title-4]" class="medium-text" type="text" name="scapegoat_theme_options[featured-link-title-4]" value="<?php esc_attr_e( $options['featured-link-title-4'] ); ?>" /> <span class="description"><?php _e('Title','scapegoat'); ?></span>
								</td>
							</tr>
						</table>

						<br />
						<label for="show-header">
							<input id="show-header" type="radio" name="scapegoat_theme_options[header-option]" value="show-header" <?php checked( 'show-header' == $options['header-option'] ); ?> /> <?php _e('Header','scapegoat'); ?> <span class="description"><?php _e('Default Wordpress Header Function','scapegoat'); ?></span>
						</label>
						<br />
						<label for="show-none">
							<input id="show-none" type="radio" name="scapegoat_theme_options[header-option]" value="show-none" <?php checked( 'show-none' == $options['header-option'] ); ?> /> <?php _e('Nothing','scapegoat'); ?>
						</label>
					</td>
				</tr>
			</table>

			<h3><?php _e('Social Networks','scapegoat'); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><span class="social-icon rss"></span> Feed</th>
					<td><input id="scapegoat_theme_options[rss]" class="regular-text" type="text" name="scapegoat_theme_options[rss]" value="<?php esc_attr_e( $options['rss'] ); ?>" /> <span class="description"> <?php _e('if this is empty, the default Wordpress-feed will set','scapegoat'); ?></span></td>
				</tr>
				<tr valign="top">
					<th scope="row"><span class="social-icon twitter"></span> Twitter</th>
					<td><input id="scapegoat_theme_options[twitter]" class="regular-text" type="text" name="scapegoat_theme_options[twitter]" value="<?php esc_attr_e( $options['twitter'] ); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><span class="social-icon appdotnet"></span> APP.net</th>
					<td><input id="scapegoat_theme_options[appdotnet]" class="regular-text" type="text" name="scapegoat_theme_options[appdotnet]" value="<?php esc_attr_e( $options['appdotnet'] ); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><span class="social-icon facebook"></span> Facebook</th>
					<td><input id="scapegoat_theme_options[facebook]" class="regular-text" type="text" name="scapegoat_theme_options[facebook]" value="<?php esc_attr_e( $options['facebook'] ); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><span class="social-icon google"></span> Google +</th>
					<td><input id="scapegoat_theme_options[google]" class="regular-text" type="text" name="scapegoat_theme_options[google]" value="<?php esc_attr_e( $options['google'] ); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><span class="social-icon youtube"></span> Youtube</th>
					<td><input id="scapegoat_theme_options[youtube]" class="regular-text" type="text" name="scapegoat_theme_options[youtube]" value="<?php esc_attr_e( $options['youtube'] ); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><span class="social-icon mail"></span> Newsletter</th>
					<td><input id="scapegoat_theme_options[mail]" class="regular-text" type="text" name="scapegoat_theme_options[mail]" value="<?php esc_attr_e( $options['mail'] ); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><span class="social-icon podcast"></span> Podcast</th>
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