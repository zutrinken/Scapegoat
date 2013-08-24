<?php

/* load theme options */
$options = get_option('scapegoat_theme_options');

/* Mobile Detect */
include 'inc/mobile_detect.php';

/*-----------------------------------------------------------------------------------*/
/* Load Scripts
/*-----------------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'enqueue_scripts');
function enqueue_scripts() {
	$template = get_template_directory_uri();
	wp_enqueue_script('modernizr', $template.'/js/libs/modernizr-2.6.2.min.js', array(), null, false);

	wp_register_script('jquery-custom', $template.'/js/libs/jquery.1.7.1.min.js', array(), null, false);
	wp_enqueue_script('jquery-custom');

	wp_enqueue_script('jquery.fitvids', $template.'/js/libs/jquery.fitvids.js', array(), null, false);
	wp_enqueue_script('jquery.smoothscroll', $template.'/js/libs/jquery.smoothscroll.js', array(), null, false);

	if(is_front_page()) {
		wp_enqueue_style('jquery.flexslider', $template.'/css/style-flexslider.css', array(), null, false);
		wp_enqueue_script('jquery.flexslider', $template.'/js/libs/jquery.flexslider-min.js', array(), null, false);
		wp_enqueue_script('jquery.easing', $template.'/js/libs/jquery.easing.min.js', array(), null, false);
	}
	wp_enqueue_script('custom-script', $template.'/js/script.js', array(), null, true);
}


function twentythirteen_fonts_url() {
	$fonts_url = '';
	$open_sans = _x( 'on', 'Open Sans: on or off', 'scapegoat' );

	if ('off' !== $open_sans) {
		$font_families = array();

		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Open Sans:400,700,400italic,700italic';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/* localization */
load_theme_textdomain('scapegoat', TEMPLATEPATH .'/languages');

/* add "editor-style.css" for the admin-interface */
add_editor_style('css/editor-style.css');

/* add a favicon for the admin area */
function favicon4admin() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . get_bloginfo('template_directory') . '/favicon.ico" />';
}
add_action( 'admin_head', 'favicon4admin' );

/* load "login.css" for the login */
function custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/css/login.css" />';
}
add_action('login_head', 'custom_login');

/* add custom theme-options */
require_once(get_stylesheet_directory().'/inc/theme-options.php');

/* add twitter and wiki profile */
function add_twitter_contactmethod( $contactmethods ) {
	/* Add Twitter */
	$contactmethods['twitter'] = __('Twitter (without @)','scapegoat');
	/* Add Wiki */
	$contactmethods['wiki'] = __('Wiki (Username)','scapegoat');
	return $contactmethods;
}
add_filter('user_contactmethods','add_twitter_contactmethod',10,1);

/* register post formats */
add_theme_support (
	'post-formats',
	array (
		'status'
	)
);

/* add custom image-sizes */
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support('post-thumbnails');
	add_image_size('featured', 1440, 486, true);
	add_image_size('featured-medium', 720, 243, true);
	add_image_size('featured-small', 480, 320, true);
}


/*-----------------------------------------------------------------------------------*/
/* Navigation
/*-----------------------------------------------------------------------------------*/

/* register all menus */
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus(
		array(
			'header' => __('Header','scapegoat'),
			'footer' => __('Footer','scapegoat')
		)
	);
}

function fallback_menu() {
    wp_page_menu(
    	array(
    		'show_home' => __('Start','scapegoat')
    	)
    );
}

/* add css class for li with submenu */
class My_Walker_Nav_Menu extends Walker_Nav_Menu {
	public function display_element($el, &$children, $max_depth, $depth = 0, $args, &$output) {
		$id = $this->db_fields['id'];
		if(isset($children[$el->$id])) $el->classes[] = 'has-children';
		parent::display_element($el, $children, $max_depth, $depth, $args, $output);
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
		$class_names = $value = '';
	
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
	
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
	
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
	
		$output .= $indent . '<li' . $id . $value . $class_names .'>';
	
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  		. esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' 		. esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' accesskey="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   		. esc_attr( $item->url        ) .'"' : '';
		
		// First applying the filters. After that, underline the accesskey in the title if present...
		$item_title = apply_filters( 'the_title', $item->title, $item->ID );
		if( ! empty( $item->xfn ) ) {
			$letterpos = strpos($item_title, esc_attr( $item->xfn ) );
			$item_title = substr($item_title, 0, $letterpos)."<u>".substr($item_title, $letterpos, 1)."</u>".substr($item_title, $letterpos+1);
		}
		
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $item_title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
	
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/*-----------------------------------------------------------------------------------*/
/* Sidebars
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'my_register_sidebars' );
function my_register_sidebars() {
	register_sidebar(
		array(
			'id'=>'main-sidebar',
			'name'=>__('Main-Sidebar','scapegoat'),
			'description' => __('The default sidebar.','scapegoat'),
			'before_widget' => '<aside id="%1$s" class="widget widget-sidebar %2$s" role="group"><div class="widget-inner">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'id'=>'footer-sidebar-1',
			'name'=>__('Footer-Sidebar-1','scapegoat'),
			'description' => __('Widgets for the Footer-section.','scapegoat'),
			'before_widget' => '<aside id="%1$s" class="widget widget-footer %2$s" role="group"><div class="widget-inner">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'id'=>'footer-sidebar-2',
			'name'=>__('Footer-Sidebar-2','scapegoat'),
			'description' => __('Widgets for the Footer-section.','scapegoat'),
			'before_widget' => '<aside id="%1$s" class="widget widget-footer %2$s" role="group"><div class="widget-inner">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'id'=>'footer-sidebar-3',
			'name'=>__('Footer-Sidebar-3','scapegoat'),
			'description' => __('Widgets for the Footer-section.','scapegoat'),
			'before_widget' => '<aside id="%1$s" class="widget widget-footer %2$s" role="group"><div class="widget-inner">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'id'=>'footer-sidebar-4',
			'name'=>__('Footer-Sidebar-4','scapegoat'),
			'description' => __('Widgets for the Footer-section.','scapegoat'),
			'before_widget' => '<aside id="%1$s" class="widget widget-footer %2$s" role="group"><div class="widget-inner">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
}

/* Add support for custom headers */

define('NO_HEADER_TEXT', true );
define('HEADER_IMAGE', '%s/images/default_header.jpg');
define('HEADER_IMAGE_WIDTH', 1440);
define('HEADER_IMAGE_HEIGHT', 486);

register_default_headers(array(
	'ruins' => array(
		'url' => '%s/images/default_header.jpg',
		'thumbnail_url' => '%s/images/default_header.jpg',
		'description' => __('Default', 'scapegoat')
	)
));

function header_style() {
	?><style type="text/css">
		.custom-header {
			background: url('<?php header_image(); ?>') scroll no-repeat;
			background-size: 100% auto;
		}
	</style><?php
}

function admin_header_style() {
    ?><style type="text/css">
        #headimg {
            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
            background: no-repeat;
        }
        .default-header label img {
			width: 360px;
        	height: auto;
        }
    </style><?php
}
add_custom_image_header('header_style', 'admin_header_style');



/*-----------------------------------------------------------------------------------*/
/* Shortcodes
/*-----------------------------------------------------------------------------------*/
/* Enable shortcodes in widget areas */
add_filter( 'widget_text', 'do_shortcode' );

/* Replace WP autop formatting */
if (!function_exists( "scapegoat_remove_wpautop")) {
	function scapegoat_remove_wpautop($content) { 
		$content = do_shortcode( shortcode_unautop( $content ) ); 
		$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content);
		return $content;
	}
}


/* Two Columns */
function scapegoat_shortcode_two_columns_one( $atts, $content = null ) {
   return '<div class="two-columns-one">' . scapegoat_remove_wpautop($content) . '</div>';
}
add_shortcode( 'two_columns_one', 'scapegoat_shortcode_two_columns_one' );

function scapegoat_shortcode_two_columns_one_last( $atts, $content = null ) {
   return '<div class="two-columns-one last">' . scapegoat_remove_wpautop($content) . '</div>';
}
add_shortcode( 'two_columns_one_last', 'scapegoat_shortcode_two_columns_one_last' );


/* Three Columns */
function scapegoat_shortcode_three_columns_one($atts, $content = null) {
   return '<div class="three-columns-one">' . scapegoat_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_one', 'scapegoat_shortcode_three_columns_one' );

function scapegoat_shortcode_three_columns_one_last($atts, $content = null) {
   return '<div class="three-columns-one last">' . scapegoat_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_one_last', 'scapegoat_shortcode_three_columns_one_last' );

function scapegoat_shortcode_three_columns_two($atts, $content = null) {
   return '<div class="three-columns-two">' . scapegoat_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_two', 'scapegoat_shortcode_three_columns_two' );

function scapegoat_shortcode_three_columns_two_last($atts, $content = null) {
   return '<div class="three-columns-two last">' . scapegoat_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_two_last', 'scapegoat_shortcode_three_columns_two_last' );


/* Four Columns */
function scapegoat_shortcode_four_columns_one($atts, $content = null) {
   return '<div class="four-columns-one">' . scapegoat_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_one', 'scapegoat_shortcode_four_columns_one' );

function scapegoat_shortcode_four_columns_one_last($atts, $content = null) {
   return '<div class="four-columns-one last">' . scapegoat_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_one_last', 'scapegoat_shortcode_four_columns_one_last' );

function scapegoat_shortcode_four_columns_two($atts, $content = null) {
   return '<div class="four-columns-two">' . scapegoat_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_two', 'scapegoat_shortcode_four_columns_two' );

function scapegoat_shortcode_four_columns_two_last($atts, $content = null) {
   return '<div class="four-columns-two last">' . scapegoat_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_two_last', 'scapegoat_shortcode_four_columns_two_last' );

function scapegoat_shortcode_four_columns_three($atts, $content = null) {
   return '<div class="four-columns-three">' . scapegoat_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_three', 'scapegoat_shortcode_four_columns_three' );

function scapegoat_shortcode_four_columns_three_last($atts, $content = null) {
   return '<div class="four-columns-three last">' . scapegoat_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_three_last', 'scapegoat_shortcode_four_columns_three_last' );

/* Divide Text Shortcode */
function scapegoat_shortcode_divider($atts, $content = null) {
   return '<div class="divider"></div>';
}
add_shortcode( 'divider', 'scapegoat_shortcode_divider' );



function scapegoat_button( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'link'	=> '#',
    'target' => '',
    'color'	=> '',
    'size'	=> '',
	 'form'	=> '',
	 'font'	=> '',
    ), $atts));

	$color = ($color) ? ' '.$color. '-btn' : '';
	$size = ($size) ? ' '.$size. '-btn' : '';
	$form = ($form) ? ' '.$form. '-btn' : '';
	$font = ($font) ? ' '.$font. '-btn' : '';
	$target = ($target == 'blank') ? ' target="_blank"' : '';

	$out = '<a' .$target. ' class="standard-btn' .$color.$size.$form.$font. '" href="' .$link. '"><span>' .do_shortcode($content). '</span></a>';

    return $out;
}
add_shortcode('button', 'scapegoat_button');


/* add custom caption-function */
function custom_caption($attr, $content = null) {
	/* New-style shortcode with the caption inside the shortcode with the link and image tags. */
	if ( ! isset( $attr['caption'] ) ) {
		if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
			$content = $matches[1];
			$attr['caption'] = trim( $matches[2] );
		}
	}
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<figure '. $id .'class="wp-caption '. $align .'" style="width: '. ($width) .'px">'. do_shortcode($content) .'<span class="wp-caption-text">'. $caption .'</span></figure>';
}

add_shortcode('wp_caption', 'custom_caption');
add_shortcode('caption', 'custom_caption');


/* catch the first image */
function catch_post_image($size = 'thumbnail') {
	global $post;

	$photos = get_children(
		array(
			'post_parent' => $post->ID,
			'post_status' => 'inherit',
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'order' => 'ASC',
			'orderby' => 'menu_order ID'
		)
	);
	
	if ($photos) {
		$photo = array_shift($photos);
		$catched = wp_get_attachment_image($photo->ID, $size);
		return '<figure class="post-image"><a title="' . get_the_title() . '" href="' . get_permalink() . '">' . $catched . '</a></figure>';
	}

	return false;
}



/*-----------------------------------------------------------------------------------*/
/* Custom Excerpt
/*-----------------------------------------------------------------------------------*/
function custom_wp_trim_excerpt($text) {
	$raw_excerpt = $text;
	if ( '' == $text ) {
		// Retrieve the post content
		$text = get_the_content('');
 
		// Delete all shortcode tags from the content
		$text = strip_shortcodes( $text );
 
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
 
 		// MODIFY THIS. Add the allowed HTML tags separated by a comma
		$allowed_tags = '<p>,<br>,<br />';
		$text = strip_tags($text, $allowed_tags);
 
 		// MODIFY THIS. change the excerpt word count to any integer you like
		$excerpt_word_count = 55;
		$excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);
 
 		// MODIFY THIS. change the excerpt endind to something else
		//$excerpt_end = '[...] <a href="'. get_permalink($post->ID) . '">' . __("more","scapegoat") .' &rarr;</a>';
		//$excerpt_end = '[...]';
		$excerpt_end = '<a href="'. get_permalink($post->ID) . '">[...]</a>';
		$excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);
 
		$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
		if ( count($words) > $excerpt_length ) {
			array_pop($words);
			$text = implode(' ', $words);
			$text = $text . $excerpt_more;
		} else {
			$text = implode(' ', $words);
		}
	}
	return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_wp_trim_excerpt');



function custom_excerpt($excerpt_length = 55, $id = false, $echo = true) {
	$text = '';
	
	if($id) {
		$the_post = & get_post( $my_id = $id );
		$text = ($the_post->post_excerpt) ? $the_post->post_excerpt : $the_post->post_content;
	} else {
		global $post;
		$text = ($post->post_excerpt) ? $post->post_excerpt : get_the_content('');
	}
	
	$text = strip_shortcodes( $text );
	$text = apply_filters('the_content', $text);
	$text = str_replace(']]>', ']]&gt;', $text);
	$text = strip_tags($text);
	
	$excerpt_more = ' ' . '<a href="'. get_permalink($post->ID) . '">[...]</a>';
	$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
	if ( count($words) > $excerpt_length ) {
		array_pop($words);
		$text = implode(' ', $words);
		$text = $text . $excerpt_more;
	} else {
		$text = implode(' ', $words);
	}
	if($echo)
	echo apply_filters('the_content', $text);
	else
	return $text;
}
	
function get_custom_excerpt($excerpt_length = 55, $id = false, $echo = false) {
	return custom_excerpt($excerpt_length, $id, $echo);
}


/*-----------------------------------------------------------------------------------*/
/* Current Page
/*-----------------------------------------------------------------------------------*/
function current_paged( $var = '' ) {
    if( empty( $var ) ) {
        global $wp_query;
        if( !isset( $wp_query->max_num_pages ) )
            return;
        $pages = $wp_query->max_num_pages;
    }
    else {
        global $$var;
            if( !is_a( $$var, 'WP_Query' ) )
                return;
        if( !isset( $$var->max_num_pages ) || !isset( $$var ) )
            return;
        $pages = absint( $$var->max_num_pages );
    }
    if( $pages < 1 )
        return;
    $page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
    echo __('Page ','scapegoat') . $page . __(' of ','scapegoat') . $pages;
}


/*-----------------------------------------------------------------------------------*/
/* Pagination
/*-----------------------------------------------------------------------------------*/
function wp_pagination_navi($num_page_links = 5, $min_max_offset = 2){
	global $wp_query;
	/* Do not show paging on single pages */
	if( !is_single() ){
		$current_page       = intval(get_query_var('paged'));
		$total_pages        = $wp_query->max_num_pages;
		$left_offset        = floor(($num_page_links - 1) / 2);
		$right_offset       = ceil(($num_page_links -1) / 2);
		if( empty($current_page) || $current_page ==  0 ) {
			$current_page = 1;
		}
		// More than one page -> render pagination
		if ( $total_pages > 1 ) {
			echo '<span class="pagination-info">';
			echo _e('Page ','scapegoat');
			echo $current_page; 
			echo _e(' of ','scapegoat');
			echo $total_pages;
			echo '</span>';
		
			echo '<nav class="pagination">';
           	if ( $current_page > 1 ) {
				echo '<a class="pagination-previous" href="' .get_pagenum_link($current_page-1) .'" title="previous">&laquo;</a>';
			} else {
				echo '<span class="pagination-previous" title="previous">&laquo;</span>';
			}
			for ( $i = 1; $i <= $total_pages; $i++) {
				if ( $i == $current_page ){
					// Current page
					echo '<a href="'.get_pagenum_link($current_page).'" class="pagination-current-page" title="page '.$i.'" >'.($current_page).'</a>';
				} else {
					// Pages before and after the current page
					if ( ($i >= ($current_page - $left_offset)) && ($i <= ($current_page + $right_offset)) ){
						echo '<a href="'.get_pagenum_link($i).'" title="page '.$i.'" >'.$i.'</a>';
					} elseif ( ($i <= $min_max_offset) || ($i > ($total_pages - $min_max_offset)) ) {
						// Start and end pages with min_max_offset
						echo '<a href="'.get_pagenum_link($i).'" title="page '.$i.'" >'.$i.'</a>';
					} elseif ( (($i == ($min_max_offset + 1)) && ($i < ($current_page - $left_offset + 1))) ||
								(($i == ($total_pages - $min_max_offset)) && ($i > ($current_page + $right_offset ))) ) {
						// Dots after/before min_max_offset
						echo '<span class="pagination-dots">...</span>';
					}
				}
			}
			if ( $current_page != $total_pages ) {
				echo '<a class="pagination-next" href="'.get_pagenum_link($current_page+1).'" title="next">&raquo;</a>';
			} else {
				echo '<span class="pagination-next" title="next">&raquo;</span>';
			}
			echo '</nav>'; //Close pagination
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Submenu
/*-----------------------------------------------------------------------------------*/
function submenu() {
	global $post;
	if(!is_home()) { 
		if ($post->post_parent)	{
			$ancestors=get_post_ancestors($post->ID);
			$root=count($ancestors)-1;
			$parent = $ancestors[$root];
		} else {
			$parent = $post->ID;
		}

		$children = wp_list_pages("title_li=&child_of=". $parent ."&echo=0");
		if ($children) { ?>
			<aside class="widget widget-sidebar widget_pages" role="navigation">
				<div class="widget-inner">
				<h3 class="widget-title"><?php _e('Submenu','scapegoat'); ?></h3>
				<ul id="subnavi">
					<?php echo $children; ?>
				</ul>
				</div>
			</aside>
		<?php } 
	}
}

/*-----------------------------------------------------------------------------------*/
/* Breadcrumb
/*-----------------------------------------------------------------------------------*/
function breadcrumb() {
	$delimiter = '<span class="breadcrumb-seperator">&raquo;</span>';
	$home = __('Start','scapegoat');
	$before = '<span class="breadcrumb-item">';
	$after = '</span>';

	if(!is_home() && !is_front_page() || is_paged()) {
		echo '<nav id="breadcrumb">';

		global $post;
		$homeLink = get_bloginfo('url');

		echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

		if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
			echo $before . single_cat_title('', false) . $after;

		} elseif ( is_day() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
			echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {
			echo $before . get_the_title() . $after;

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;

		} elseif ( is_search() ) {
			echo $before . __('Search','scapegoat') . ' "' . get_search_query() . '"' . $after;

		} elseif ( is_tag() ) {
			echo $before . __('Tag','scapegoat') . ' "' . single_tag_title('', false) . '"' . $after;

		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $before . __('Author','scapegoat') . ' "' . $userdata->display_name . '"' . $after;

		} elseif ( is_404() ) {
			echo $before . __('404','scapegoat') . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo __('Page','scapegoat') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</nav>';
	}
}


/*-----------------------------------------------------------------------------------*/
/* Image Widget
/*-----------------------------------------------------------------------------------*/
class banner extends WP_Widget {

	function banner() {
		parent::__construct(
			'banner',
			__('Banner','scapegoat'),
			array(
				'description' => __('A simple Widget for Images.','scapegoat')
			)
		);
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		echo $before_widget;
			if ($title)
				echo $before_title . $title . $after_title;
			
			if ($instance['picture'] && $instance['link']) { ?>
				<a href="<?php echo $instance['link']; ?>">
					<img style="width:100%;display:block;" src="<?php echo $instance['picture']; ?>">
				</a>
			<?php } elseif ($instance['picture']) { ?>
				<img style="width:100%;display:block;" src="<?php echo $instance['picture']; ?>">
			<?php }
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['picture'] = strip_tags($new_instance['picture']);
		$instance['link'] = strip_tags($new_instance['link']);
		return $instance;
	}

	function form($instance) {
		$title = esc_attr($instance['title']); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','scapegoat'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<?php $picture = attribute_escape($instance['picture']); ?>
		<p>
			<label for="<?php echo $this->get_field_id('picture'); ?>"><?php _e('Image url:','scapegoat') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('picture'); ?>" name="<?php echo $this->get_field_name('picture'); ?>" type="text" value="<?php echo $picture ?>" />
		</p>
		<?php $link = attribute_escape($instance['link']); ?>
		<p>
			<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link url:','scapegoat') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link ?>" />
		</p>
		<?php 
	}
}
add_action('widgets_init', create_function('', 'return register_widget("banner");'));

/*-----------------------------------------------------------------------------------*/
/* Custom Comments
/*-----------------------------------------------------------------------------------*/
function custom_comment($comment, $args, $depth) {
	global $comment_counter;
	if ($comment->comment_parent < 1) {
		$comment_counter ++;
	}
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<?php if ($comment->comment_parent < 1) {echo '<span class="comment-number">' . $comment_counter . '</span>';} ?>
		<div id="comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="comment-info">
				<div class="comment-author vcard">
					<!--<?php echo get_avatar( $comment->comment_author_email, 48 ); ?>-->
					<cite class="fn">
						<?php printf(__('%s','scapegoat'), get_comment_author_link()) ?>
					</cite>
				</div>
				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>">
						<?php printf(__('%1$s'), get_comment_date('d.m.Y')) ?>
					</a>
					<span class="reply">
						<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</span>
					<?php /* edit_comment_link(__('(Edit)'),'  ','') */ ?>
				</div>				
			</div><!--comment-info-->
			<div class="comment-text">
				<?php if ($comment->comment_approved == '0') : ?>
					<span class="unlock"><?php _e('Your comment will be public soon.','scapegoat') ?></span>
					<br />
				<?php endif; ?>
				<?php comment_text() ?>
			</div><!--comment-text-->
		</div><!--comment-body-->
		<?php
}
?>