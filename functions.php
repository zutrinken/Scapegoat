<?php
/* localization */
load_theme_textdomain('scapegoat', TEMPLATEPATH .'/languages');

/* load theme options */
$options = get_option('scapegoat_theme_options');

/* add "editor-style.css" for the admin-interface */
add_editor_style();

/* add a favicon for the admin area */
function favicon4admin() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . get_bloginfo('template_directory') . '/favicon.ico" />';
}
add_action( 'admin_head', 'favicon4admin' );

/* load "login.css" for the login */
function custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/login.css" />';
}
add_action('login_head', 'custom_login');

/* add custom theme-options */
require_once ( get_stylesheet_directory() . '/theme-options.php' );

/* add twitter and wiki profile */
function add_twitter_contactmethod( $contactmethods ) {
	/* Add Twitter */
	$contactmethods['twitter'] = __('Twitter (without @)','scapegoat');
	/* Add Wiki */
	$contactmethods['wiki'] = __('Wiki (Username)','scapegoat');
	return $contactmethods;
}
add_filter('user_contactmethods','add_twitter_contactmethod',10,1);

/* Allowing Html in user-description */
remove_filter('pre_user_description', 'wp_filter_kses');
add_filter( 'pre_user_description', 'wp_filter_post_kses' );

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
	add_image_size('featured', 620, 320, true);
}

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
}

/* register sidebars */

add_action( 'widgets_init', 'my_register_sidebars' );
function my_register_sidebars() {
	register_sidebar(
		array(
			'id'=>'main-sidebar',
			'name'=>__('Main-Sidebar','scapegoat'),
			'description' => __('The default sidebar.','scapegoat'),
			'before_widget' => '<aside id="%1$s" class="widget widget-sidebar %2$s"><div class="widget-inner">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'id'=>'footer-sidebar',
			'name'=>__('Footer-Sidebar','scapegoat'),
			'description' => __('Widgets for the Footer-section.','scapegoat'),
			'before_widget' => '<aside id="%1$s" class="widget widget-footer %2$s"><div class="widget-inner">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);

}

/* Add support for custom headers */

define('NO_HEADER_TEXT', true );
define('HEADER_IMAGE', '%s/images/default_header.jpg');
define('HEADER_IMAGE_WIDTH', 1140);
define('HEADER_IMAGE_HEIGHT', 320);

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
			background: url(<?php header_image(); ?>) center top;
			background-size: auto 100%;
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


/* add custom caption-function */
function custom_caption($attr, $content = null) {
	// New-style shortcode with the caption inside the shortcode with the link and image tags.
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


/* catch the first image of a post, if the author is to stupid to select a featured image */
function catch_that_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches [1] [0];
	if(!empty($first_img)) {
		return '<img src="' . $first_img . '" alt="" />';
	}
}

/* custom background */
add_custom_background('new_custom_background_cb');

function new_custom_background_cb() {
	$background = get_background_image();
	$color = get_background_color();
	if ( ! $background && ! $color )
	return;

	$style = $color ? "background-color: #$color;" : 'background: #$color;';

	if ( $background ) {
		$image = "background-image: url(' " . $background . "');";

		$repeat = get_theme_mod( 'background_repeat', 'repeat' );
		if (!in_array($repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ))) {
			$repeat = 'repeat';
		}
		$repeatout = "background-repeat: " . $repeat . ";";

		$position = get_theme_mod( 'background_position_x', 'left' );
		if (!in_array($position, array( 'center', 'right', 'left' ))) {
			$position = 'left';
		}
		$positionout = "background-position: " . $position . " top;";

		$attachment = get_theme_mod( 'background_attachment', 'scroll' );
		if (!in_array($attachment, array( 'fixed', 'scroll' ))) {
			$attachment = 'scroll';
		}
		$attachmentout = "background-attachment: ". $attachment . ";";

		$style .= $positionout . $repeatout . $attachmentout . $image;
	}

	?>
	<style type="text/css">
		body {<?php echo trim($style); ?>}
		#front-page-header-image-outside {background: #000;}
		#front-page-header-outside {background: url('images/bg-pattern-1.png') 0 0 repeat scroll;}
		#wrapper-inside {padding: 20px;background: #fff;-webkit-box-shadow: 0 0 1px rgba(0,0,0,0.2);-moz-box-shadow: 0 0 1px rgba(0,0,0,0.2);box-shadow: 0 0 1px rgba(0,0,0,0.2);}
		@media only screen and (max-width: 640px) {#wrapper-outside {padding: 20px;}}
	</style>
	<?php
}

/* custom excerpt */
function custom_wp_trim_excerpt($text) {
	$raw_excerpt = $text;
	if ( '' == $text ) {
		/* Retrieve the post content */
		$text = get_the_content('');
 
		/* Delete all shortcode tags from the content */
		$text = strip_shortcodes( $text );
 
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
 
 		/* MODIFY THIS. Add the allowed HTML tags separated by a comma */
		$allowed_tags = '<p>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<blockquote>,<pre>,<code>,<hr />,<br>,<br />';
		$text = strip_tags($text, $allowed_tags);
 
 		/* MODIFY THIS. change the excerpt word count to any integer you like */
		$excerpt_word_count = 60;
		$excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);
 
 		/* MODIFY THIS. change the excerpt endind to something else */
		$excerpt_end = '... <a href="'. get_permalink($post->ID) . '">' . __("more","scapegoat") .' &rarr;</a>';
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


/* pagination */
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
			echo '<nav class="pagination_navi">';
           	if ( $current_page > 1 ) {
				echo '<a href="' .get_pagenum_link($current_page-1) .'" title="previous">&laquo;</a>';
			}
			for ( $i = 1; $i <= $total_pages; $i++) {
				if ( $i == $current_page ){
					// Current page
					echo '<a href="'.get_pagenum_link($current_page).'" class="current-page" title="page '.$i.'" >'.($current_page).'</a>';
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
						echo '<span class="dots">...</span>';
					}
				}
			}
			if ( $current_page != $total_pages ) {
				echo '<a href="'.get_pagenum_link($current_page+1).'" title="next">&raquo;</a>';
			}
			echo '</nav>'; //Close pagination
		}
	}
}

/* submenu */
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
			<aside class="widget widget-sidebar widget_pages">
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

/* breadcrumb */
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


/* widget specially for images */
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

/* custom comment-list */
function custom_comment($comment, $args, $depth) {
	global $comment_counter;
	if ($comment->comment_parent<1) {
		$comment_counter ++;
	}
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<?php if ($comment->comment_parent<1) {echo '<span class="comment-number">' . $comment_counter . '</span>';} ?>
		<div id="comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="comment-info">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment->comment_author_email, 48 ); ?>
					<cite class="fn"><?php printf(__('%s','scapegoat'), get_comment_author_link()) ?></cite>
				</div>
				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s &bull; %2$s'), get_comment_date('d.m.Y'),  get_comment_time()) ?></a>
					<?php edit_comment_link(__('(Edit)'),'  ','') ?>
				</div>
				<div class="reply">
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
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