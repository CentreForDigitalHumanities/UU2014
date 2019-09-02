<?php
/*
Author: Hall Internet Marketing
URL: https://github.com/hallme/scaffolding

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/******************************************

TABLE OF CONTENTS

1. Include Files
2. Scripts & Enqueueing
3. Theme Support
4. Custom Page Headers
5. Thumbnail Size Options
6. Change Name of Post Types in Admin Backend
7. Menus & Navigation
8. Active Sidebars
9. Related Posts Function
10. Comment Layout
11. Search Functions
12. Add First and Last Classes to Menu & Sidebar
13. Add First and Last Classes to Posts
14. Custom Functions

******************************************/

//Set up the content width value based on the theme's design.
if ( ! isset( $content_width ) ) {
	$content_width = 740;
}

//Adjust content_width value for image attachment template.
function uu2014_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'uu2014_content_width' );

/*********************
1. INCLUDE FILES
*********************/
define('SCAFFOLDING_INCLUDE_PATH', dirname(__FILE__).'/includes/');
require_once(SCAFFOLDING_INCLUDE_PATH.'base-functions.php');

if ( file_exists( dirname( __FILE__ ) . '/includes/functions/widgets/widget-socialmedia-buttons.php' ) ) {
    require_once( dirname( __FILE__ ) . '/includes/functions/widgets/widget-socialmedia-buttons.php' );
}
if ( file_exists( dirname( __FILE__ ) . '/includes/functions/widgets/widget-upcoming-agenda.php' ) ) {
    require_once( dirname( __FILE__ ) . '/includes/functions/widgets/widget-upcoming-agenda.php' );
}
if ( file_exists( dirname( __FILE__ ) . '/includes/functions/widgets/widget-twitter-user-timeline.php' ) ) {
    require_once( dirname( __FILE__ ) . '/includes/functions/widgets/widget-twitter-user-timeline.php' );
}




/*********************
2. SCRIPTS & ENQUEUEING
*********************/

function uu2014_scripts_and_styles() {
	global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

	// modernizr (without media query polyfill)
	wp_enqueue_script( 'uu2014-modernizr', get_template_directory_uri() . '/js/modernizr.min.js', false, null );

	// respondjs
	wp_enqueue_script( 'uu2014-respondjs', get_template_directory_uri() . '/js/respond.min.js', false, null );

	// Boostrap CSS
	// wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');

	// register main stylesheet

	wp_enqueue_style( 'uu2014-stylesheet', get_template_directory_uri() . '/css/production/style.css', array(), '', 'screen' );	
	wp_enqueue_style( 'uu2014-print-stylesheet', get_template_directory_uri() . '/css/print.css', array(), '', 'print' );	
	// ie-only style sheet
	wp_enqueue_style( 'uu2014-ie-only', get_stylesheet_directory_uri() . '/css/ie.css', array(), '' );
	$wp_styles->add_data( 'uu2014-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

	// Bootstrap javascript
	wp_enqueue_script( 'bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );

	// Magnific Popup (LightBox)
	// wp_enqueue_script( 'uu2014-magnific-popup-js', '//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/0.9.9/jquery.magnific-popup.min.js', array( 'jquery' ), '0.9.9', true );

	// Font Awesome (icon set)
	//wp_enqueue_style( 'uu2014-font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css', array(), '4.0.3' );

	// ************************************************************************************
	// Uitgeschakeld omdat conditionele logica in Foridable Froms hierdoor niet meer werkt.
	// iCheck (better radio and checkbox inputs)
	// wp_enqueue_script( 'uu2014-icheck', '//cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.1/icheck.min.js', array( 'jquery' ), '1.0.1', true );

	//Chosen - https://harvesthq.github.io/chosen/
    wp_enqueue_script( 'chosen-js', get_template_directory_uri() . '/js/chosen.jquery.min.js', array( 'jquery' ), '1.1.0', true );
   

    // Pull Masonry from the core of WordPress
	wp_enqueue_script( 'masonry' );
	// comment reply script for threaded comments
	if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
		wp_enqueue_script( 'comment-reply' );
	}

	//adding scripts file in the footer
	wp_enqueue_script( 'uu2014-js', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0.1', true );
	
}


add_action('wp_enqueue_scripts', 'uu2014_scripts_and_styles', 20 );



if(get_current_blog_id() == 1) {
function datatables_bootstrap() {
	wp_enqueue_script('datatables-js-uu', get_stylesheet_directory_uri().'/js/datatables/jquery.dataTables.min.js', array( 'jquery' ) );
	wp_enqueue_script('datatables-bootstrap-js-uu', get_stylesheet_directory_uri().'/js/datatables/dataTables.bootstrap.min.js', array( 'jquery' ) );
	wp_enqueue_script('datatables-yadcf-js-uu', get_stylesheet_directory_uri().'/js/datatables/jquery.dataTables.yadcf.js', array( 'jquery' ) );
	}

	add_action( 'wp_enqueue_scripts', 'datatables_bootstrap' );
}

// ui-datepicker z-index bug
add_action('admin_head', 'my_custom_admin_css');

function my_custom_admin_css() {
  echo '<style>
    .ui-widget {
    	position: relative;
    	z-index: 2000 !important;
    }
  </style>';
}



/*********************
3. THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function uu2014_theme_support() {

	// Make theme available for translation
	load_theme_textdomain( 'uu2014', get_template_directory() . '/languages' );

	add_theme_support( 'post-thumbnails' ); // wp thumbnails (sizes handled in functions.php)

	set_post_thumbnail_size( 100, 100, true ); // default thumb size

	/*  Feature Currently Disabled
	// wp custom background (thx to @bransonwerner for update)
	add_theme_support( 'custom-background',
		array(
		'default-image' => '',  // background image default
		'default-color' => '', // background color default (dont add the #)
		'wp-head-callback' => '_custom_background_cb',
		'admin-head-callback' => '',
		'admin-preview-callback' => ''
		)
	);
	*/

	add_theme_support( 'automatic-feed-links' ); // rss thingy

	// to add header image support go here: https://themble.com/support/adding-header-background-image-support/
	//adding custome header suport

	require_once(SCAFFOLDING_INCLUDE_PATH.'custom-header.php');

	// add_theme_support( 'custom-header', array(
	// 	'default-image'=> '%s/images/headers/default.jpg',
	// 	'random-default'=> false,
	// 	'width'=> 1368,  // Make sure to set this
	// 	'height'=> 250, // Make sure to set this
	// 	'flex-height'=> true,
	// 	'flex-width'=> false,
	// 	'default-text-color'=> 'ffffff',
	// 	'header-text'=> false,
	// 	'uploads'=> true,
	// 	'wp-head-callback'=> 'uu2014_custom_headers_callback',
	// 	'admin-head-callback'=> '',
	// 	'admin-preview-callback'=> '',
	// 	)
	// );

/* Feature Currently Disabled
	// adding post format support
	add_theme_support( 'post-formats',
		array(
			'aside',			// title less blurb
			'gallery',			// gallery of images
			'link',			  	// quick link to other site
			'image',			// an image
			'quote',			// a quick quote
			'status',			// a Facebook like status update
			'video',			// video
			'audio',			// audio
			'chat'				// chat transcript
		)
	);
*/

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'Main Menu', 'uu2014' ),	// main nav in header
			'footer-nav' => __( 'Footer Menu', 'uu2014' ) // secondary nav in footer
		)
	);

	// https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	//add_theme_support( 'title-tag' );

} /* end scaffolding theme support */


/*********************
4. CUSTOM PAGE HEADERS
*********************/

register_default_headers( array(
	'default' => array(
		'url' => get_template_directory_uri().'/images/headers/default.jpg',
		'thumbnail_url' => get_template_directory_uri().'/images/headers/default.jpg',
		'description' => __( 'default', 'uu2014' )
	)
));

//Set header image as a BG
function uu2014_custom_headers_callback() {
	?>	<style type="text/css">#banner {
			background-image: url(<?php header_image(); ?>);
			/*-ms-behavior: url(<?php echo get_template_directory_uri() ?>/includes/backgroundsize.min.htc);*/
		}</style><?php
}


/*********************
5. THUMBNAIL SIZE OPTIONS
*********************/

// Thumbnail sizes

add_action( 'after_setup_theme', 'uu_2014_custom_thumb_size' );

function uu_2014_custom_thumb_size() {	
	add_image_size( 'uu-thumbnail', 100, 100, true );
	add_image_size( 'uu-header', 1600 );
	// change default wordpress image sizes

	if ( get_option('medium_size_w') != 278 ) { update_option('medium_size_w', 278); } 
	if ( get_option('large_size_w') != 740 ) { update_option('large_size_w', 740); } 
	
	// update_option('medium_size_w', 278);
	// update_option('large_size_w', 740);
}


add_filter( 'image_size_names_choose', 'my_custom_sizes' );

function my_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'uu-thumbnail' => __( 'Small Thumbnail' )
    ) );
}

/*********************
6. CHANGE NAME OF POSTS TYPE IN ADMIN BACKEND
*********************/

/* //Currently commented out. This is useful for improving UX in the WP backend
function uu2014_change_post_menu_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'News';
	$submenu['edit.php'][5][0] = 'All News Entries';
	$submenu['edit.php'][10][0] = 'Add News Entries';
	$submenu['edit.php'][15][0] = 'Categories'; // Change name for categories
	$submenu['edit.php'][16][0] = 'Tags'; // Change name for tags
	echo '';
}

function uu2014_change_post_object_label() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'News';
	$labels->singular_name = 'News';
	$labels->add_new = 'Add News Entry';
	$labels->add_new_item = 'Add News Entry';
	$labels->edit_item = 'Edit News Entry';
	$labels->new_item = 'News Entry';
	$labels->view_item = 'View Entry';
	$labels->search_items = 'Search News Entries';
	$labels->not_found = 'No News Entries found';
	$labels->not_found_in_trash = 'No News Entries found in Trash';
}
add_action( 'init', 'uu2014_change_post_object_label' );
add_action( 'admin_menu', 'uu2014_change_post_menu_label' );
*/


/*********************
7. MENUS & NAVIGATION
*********************/

function uu_main_navigation() {
    ?>

    <?php if( get_field('uu_options_brandbar', 'option') ) { ?>
			<button type="button" class="navbar-toggle hidden-print no-brandbar" style="float: none; padding-bottom: 13px;" data-toggle="collapse" data-target="#main-menu-collapse">
                    <span class="sr-only">Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
            </button>

		<?php	} ?> 
    <nav id="#access" class="navbar navbar-default navbar-inverse">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="container">
            <div class="navbar-header">
                
            </div>
        <?php
            echo  wp_nav_menu(
                array(
                    'theme_location'    => 'main-nav',
                    'depth'             => 2,
                    'container'         => 'div',
                    'container_class'   => 'collapse navbar-collapse',
                    'container_id'      => 'main-menu-collapse',
                    'menu_class'        => 'nav navbar-nav',
                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                    'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
    	</div>
    </nav> <!-- #access .navbar -->
    <?php
}


// the main menu
function uu2014_main_nav() {
	// display the wp3 menu if available
	wp_nav_menu(array(
		'container' => '',						 	 // remove nav container
		'container_class' => '',		 				 // class of container (should you choose to use it)
		'menu' => '',							 	 	 // nav name
		'menu_class' => 'menu main-menu wrap clearfix',  // adding custom nav class
		'theme_location' => 'main-nav',			 		 // where it's located in the theme
		'before' => '',								 	 // before the menu
		'after' => '',								 	 // after the menu
		'link_before' => '',						 	 // before each link
		'link_after' => '',							 	 // after each link
		'depth' => 0,								 	 // limit the depth of the nav
		'fallback_cb' => '',	 // fallback function
		'items_wrap' => '',
		'walker'=> new wp_bootstrap_navwalker
	));
} /* end scaffolding main nav */

// the footer menu (should you choose to use one)
function uu2014_footer_nav() {
	wp_nav_menu(array(
		'container' => '',
		'container_class' => '',
		'menu' => '',
		'menu_class' => 'menu footer-menu clearfix',
		'theme_location' => 'footer-nav',
		'before' => '',
		'after' => '',
		'link_before' => '',
		'link_after' => '',
		'depth' => 0,
		'fallback_cb' => '__return_false'
	));
} /* end scaffolding footer link */

// Register Custom Navigation Walker
require_once( dirname( __FILE__ ) . '/includes/wp_bootstrap_navwalker.php');


/*********************
8. ACTIVE SIDEBARS
*********************/

// Sidebars & Widgetizes Areas
function uu2014_register_sidebars() {
	register_sidebar(array(
		'id' => 'left-sidebar',
		'name' => __('Left Sidebar', 'uu2014'),
		'description' => __('The Left (primary) sidebar used for the interior menu.', 'uu2014'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'below-content',
		'name' => __('Below Content', 'uu2014'),
		'description' => __('Below Content used for the call to actions.', 'uu2014'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'banner-widget-area',
		'name' => __('Banner Widget Area', 'uu2014'),
		'description' => __('Banner widget area', 'uu2014'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	));
	register_sidebar(array(
		'id' => 'home-widget-area-0',
		'name' => __('Home Widget Area 0', 'uu2014'),
		'description' => __('Full-width area above home widget areas 1,2 and 3', 'uu2014'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'home-widget-area-1',
		'name' => __('Home Widget Area 1', 'uu2014'),
		'description' => __('First column in home widget area', 'uu2014'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'home-widget-area-2',
		'name' => __('Home Widget Area 2', 'uu2014'),
		'description' => __('Second column in home widget area', 'uu2014'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'home-widget-area-3',
		'name' => __('Home Widget Area 3', 'uu2014'),
		'description' => __('Last column in home widget area', 'uu2014'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'footer-widget-area-1',
		'name' => __('footer Widget Area 1', 'uu2014'),
		'description' => __('First column in footer widget area', 'uu2014'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'footer-widget-area-2',
		'name' => __('footer Widget Area 2', 'uu2014'),
		'description' => __('Second column in footer widget area', 'uu2014'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'footer-widget-area-3',
		'name' => __('footer Widget Area 3', 'uu2014'),
		'description' => __('Third column in footer widget area', 'uu2014'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'footer-widget-area-4',
		'name' => __('footer Widget Area 4', 'uu2014'),
		'description' => __('Last column in footer widget area', 'uu2014'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'colofon',
		'name' => __('Colofon Widget Area', 'uu2014'),
		'description' => __('Bottom area full width', 'uu2014'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));



} // don't remove this bracket!


/*********************
9. RELATED POSTS FUNCTION
*********************/

// Related Posts Function (call using uu2014_related_posts(); )
function uu2014_related_posts() {
	echo '<ul id="uu2014-related-posts">';
	global $post;
	$tags = wp_get_post_tags($post->ID);
	if($tags) {
		foreach($tags as $tag) {
			$tag_arr .= $tag->slug . ',';
		}
		$args = array(
			'tag' => $tag_arr,
			'numberposts' => 5, /* you can change this to show more */
			'post__not_in' => array($post->ID)
	 	);
		$related_posts = get_posts($args);
		if($related_posts) {
			foreach ($related_posts as $post) :
				setup_postdata($post); ?>
				<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php
			endforeach;
		}
		else {
			echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'uu2014' ) . '</li>';
		}
	}
	wp_reset_query();
	echo '</ul>';
} /* end scaffolding related posts function */


/*********************
10. COMMENT LAYOUT
*********************/

// Comment Layout
function uu2014_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<!-- custom gravatar call -->
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="https://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/images/nothing.gif" />
				<!-- end custom gravatar call -->
				<?php printf(__('<cite class="fn">%s</cite>', 'uu2014'), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__('F jS, Y', 'uu2014')); ?> </a></time>
				<?php edit_comment_link(__('(Edit)', 'uu2014'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
	   			<div class="alert info">
		  			<p><?php _e('Your comment is awaiting moderation.', 'uu2014') ?></p>
		  		</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!


/*********************
11. SEARCH FUNCTIONS
*********************/


// Search Form
function uu2014_wpsearch($form) {
	$form = '<form role="search" class="form-inline" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<div class="form-group"><label class="screen-reader-text" for="s">' . __('Search for:', 'uu2014') . '</label>
	<input type="text" class="form-control" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','uu2014').'" />
	<input type="submit" id="searchsubmit" class="button" value="'. esc_attr__('Search') .'" />
	</div></form>';
	return $form;
} // don't remove this bracket!

add_filter( 'get_search_form', 'uu2014_wpsearch' );

/*********************
12. ADD FIRST AND LAST CLASSES TO MENU & SIDEBAR
*********************/

function uu2014_add_first_and_last($output) {
	$output = preg_replace('/class="menu-item/', 'class="first-item menu-item', $output, 1);
	$last_pos = strripos($output, 'class="menu-item');
	if($last_pos !== false) {
		$output = substr_replace($output, 'class="last-item menu-item', $last_pos, 16 /* 16 = hardcoded strlen('class="menu-item') */);
	}
	return $output;
}
add_filter('wp_nav_menu', 'uu2014_add_first_and_last');

// Add "first" and "last" CSS classes to dynamic sidebar widgets. Also adds numeric index class for each widget (widget-1, widget-2, etc.)
function uu2014_widget_first_last_classes($params) {

	global $my_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets

	if(!$my_widget_num) {// If the counter array doesn't exist, create it
		$my_widget_num = array();
	}

	if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}

	if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id] ++;
	}
	else { // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;
	}

	$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options

	if($my_widget_num[$this_id] == 1) { // If this is the first widget
		$class .= 'first-widget ';
	}
	elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
		$class .= 'last-widget ';
	}

	$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"

	return $params;

}
add_filter( 'dynamic_sidebar_params', 'uu2014_widget_first_last_classes' );


/*********************
13. ADD FIRST AND LAST CLASSES TO POSTS
*********************/

function uu2014_post_classes( $classes ) {
	global $wp_query;
	if($wp_query->current_post == 0) {
		$classes[] = 'first-post';
	} elseif(($wp_query->current_post + 1) == $wp_query->post_count) {
		$classes[] = 'last-post';
	}

	return $classes;
}
add_filter( 'post_class', 'uu2014_post_classes' );


/*********************
14. CUSTOM FUNCTIONS
*********************/

//This removes the annoying […] to a Read More link and removes the Read More link entirely in de Slider
function uu2014_excerpt_more($more) {
	global $post;
	if ( in_category('slider') ) {
    return '';
  	} 
  	else 
  	{
	// edit here if you like
	return '...';
	}
}

function uu2014_custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'uu2014_custom_excerpt_length', 999 );

//This is a modified the_author_posts_link() which just returns the link.
//This is necessary to allow usage of the usual l10n process with printf().
function uu2014_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) ) {
		return false;
	}
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}
// add shortcodes to excerpt and widgets
add_filter('widget_text', 'do_shortcode');
add_filter('the_excerpt', 'do_shortcode');

//remove_filter('get_the_excerpt', 'wp_trim_excerpt');
// add_filter('get_the_excerpt', 'custom_wp_trim_excerpt');

// custom excerpt for homepage caroussel
function caroussel_excerpt() {    
    if( $post->post_excerpt ) {
        $content = get_the_excerpt();
    } else {
    	$lenght = "50";
        $content = "test";
        $content = get_the_content();
        $content = wp_trim_words( $content , $length );
    }
    return $excerpt;
}

function uu_excerpt($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}

		echo '...';
	} else {
		echo $excerpt;
	}
}

// WPML language selector

function icl_language_link(){
  $languages = icl_get_languages('skip_missing=1');
  if(1 < count($languages)){
    foreach($languages as $l){
      if(!$l['active']) $langs[] = '<span class="hidden-xs"><a href="'.$l['url'].'">'.$l['native_name'].'</a></span><span class="visible-xs"><a href="'.$l['url'].'">'.$l['language_code'].'</a></span>';
    }
    echo join(', ', $langs);
  }
}



// https://wordpress.stackexchange.com/questions/6731/if-is-custom-post-type
function is_custom_post_type( $post = NULL )
{
    $all_custom_post_types = get_post_types( array ( '_builtin' => FALSE ) );

    // there are no custom post types
    if ( empty ( $all_custom_post_types ) )
        return FALSE;

    $custom_types      = array_keys( $all_custom_post_types );
    $current_post_type = get_post_type( $post );

    // could not detect current type
    if ( ! $current_post_type )
        return FALSE;

    return in_array( $current_post_type, $custom_types );
}



// custom excerpt 

function uu2014_custom_excerpts($limit) {
    return wp_trim_words(get_the_excerpt(), $limit, '');
}

// Create Slider category
// function uu2014_create_slider_cat() {
// 	if(!term_exists('Slider', 'category')){
// 	  wp_insert_term('Slider', 'category');
// 	}
// }

// add_action( 'init', 'uu2014_create_slider_cat' );



/*  ACF Options page  */


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> __('UU Theme Options', 'uu2014'),
		'menu_slug' 	=> 'uu-theme-options',
		'parent_slug'	=> 'uu-options',
	));
	
}


if ( file_exists( dirname( __FILE__ ) . '/includes/acf-theme-options.php' ) ) {
    require_once( dirname( __FILE__ ) . '/includes/acf-theme-options.php' );
}

if ( file_exists( dirname( __FILE__ ) . '/includes/acf.php' ) ) {
    require_once( dirname( __FILE__ ) . '/includes/acf.php' );
}





function uu_metadata() {
	global $post;
	$metadata = get_field('uu_options_posts_metadata' , 'options' );
	if( !empty($metadata) ) {
		echo '<div class="metadata">' . __('Posted', 'uu2014') . ' ';
		if ( in_array( 'date', $metadata ) ) {
			echo __('on', 'uu2014') . ' ' . get_the_date() . ' ';
		}
		if ( in_array( 'author', $metadata ) ) {
			echo __('by', 'uu2014') . ' ' . get_the_author() . ' ';
		}
		if ( in_array( 'taxonomy', $metadata ) ) {
			echo __('<br />in: ', 'uu2014') . ' ';
			uu_display_all_taxonomies();
		}
		
		echo '</div>';
	}		
}

function uu_sharebuttons() {
	if(function_exists('get_field')) {
		$sharebuttons = get_field('uu_options_share_buttons_selection' , 'options' );
		$content = '';
		if( !empty($sharebuttons) ) {
			$shortURL = get_permalink();
			$siteTitle = get_bloginfo('name');
			$shortTitle = get_the_title();
			$twitterURL = 'https://twitter.com/intent/tweet?text='.$shortTitle.'&amp;url='.$shortURL.'&amp';
			$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$shortURL;
			$googleURL = 'https://plus.google.com/share?url='.$shortURL;
			$linkedinURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$shortURL.'&title='.$shortTitle.'&source='.$siteTitle;
			

			$content .= '<div class="sharebuttons"><h2>' . __('Share') . '</h2> ';
			if ( in_array( 'twitter', $sharebuttons ) ) {
				$content .= '<a class="button icononly sharebutton twitter" href="'. $twitterURL .'" target="_blank" title="Twitter"></a>';
			}
			if ( in_array( 'google', $sharebuttons ) ) {
				$content .= '<a class="button icononly sharebutton googleplus" href="'.$googleURL.'" target="_blank" title="Google+"></a>';
			}
			if ( in_array( 'linkedin', $sharebuttons ) ) {
				$content .= '<a class="button icononly sharebutton linkedin" href="'.$linkedinURL.'" target="_blank" title="LinkedIn"></a>';
			}
			if ( in_array( 'facebook', $sharebuttons ) ) {
				$content .= '<a class="button icononly sharebutton facebook" href="'.$facebookURL.'" target="_blank" title="Facebook"></a>';
			}
			$content .= '</div>';

			echo $content;
		}	

	}	
}

function uu_display_all_taxonomies() {
	global $post;
	$args=array('public'   => true); 
	the_taxonomies( $args );
}

// Fixes issue of agenda subcategories not loading category-agenda.php
// Use a parent category slug if it exists   https://wordpress.stackexchange.com/questions/4557/how-can-i-make-all-subcategories-use-the-template-of-its-category-parent
function child_force_category_template($template) {


    $cat = get_query_var('cat');
    $category = get_category($cat);
    
    if ( file_exists(STYLESHEETPATH . '/category-' . $category->cat_ID . '.php') ) {
        $cat_template = STYLESHEETPATH . '/category-' . $category ->cat_ID . '.php';
    } elseif ( file_exists(STYLESHEETPATH . '/category-' . $category->slug . '.php') ) {
        $cat_template = STYLESHEETPATH . '/category-' . $category ->slug . '.php';
    } elseif ( file_exists(STYLESHEETPATH . '/category-' . $category->category_parent . '.php') ) {
        $cat_template = STYLESHEETPATH . '/category-' . $category->category_parent . '.php';
    } elseif (!is_wp_error(get_category($category->category_parent))) {
    
        // Get Parent Slug
		$cat_parent = get_category($category->category_parent);

        if ( file_exists(STYLESHEETPATH . '/category-' . $cat_parent->slug . '.php') ) {
           $cat_template = STYLESHEETPATH . '/category-' . $cat_parent->slug . '.php';
        }
    } else {
    	$cat_template = $template;
    }

    return $cat_template;
}
add_action('category_template', 'child_force_category_template');

// fix email sender and address in multisite

add_filter( 'wp_mail_from_name', function( $name ) {
	$blog_title = get_bloginfo('name');
	return $blog_title;
});

add_filter( 'wp_mail_from', function( $email ) {
	$blog_email = get_bloginfo('admin_email');
	return $blog_email;
});

// Only load Masonry script when Masonry layout is used.

// add_action('wp_footer', 'uu_print_masonry_script');

// function uu_print_masonry_script() {
// 		if ( $uu_load_masonry_script = 1 ){
// 			wp_print_scripts('masonry');
// 		}
// 	}


// custom order for agenda posts
// https://wordpress.org/support/topic/order-posts-on-meta_query-with-relation?replies=2#post-5615286
function get_meta_sql_date( $pieces ) {
	global $wpdb;

	$query = " AND $wpdb->postmeta.meta_key = 'uu_agenda_start_date'
		AND (mt1.meta_key = 'uu_agenda_start_date' OR mt1.meta_key = 'uu_agenda_end_date')
		AND CAST(mt1.meta_value AS DATE) >= %s";

	$pieces['where'] = $wpdb->prepare( $query, date( 'Ymd' ) );

	return $pieces;
}

function uu_agenda_end_date_not_empty() {
	global $pagenow;
	if (( $pagenow == 'post.php' )) {

    	global $post;
		$end_date = '';
		if(get_field('uu_agenda_end_date', $post->ID)) {
			$end_date = get_field('uu_agenda_end_date', $post->ID);
		}
		if($end_date) {
			return;
		} else {
			$start_date = get_field('uu_agenda_start_date', $post->ID);
			update_field( 'uu_agenda_end_date', $start_date );
		}

    }
		
}

add_action( 'save_post', 'uu_agenda_end_date_not_empty' );


// https://formidablepro.com/help-desk/downloading-csv-file-that-can-be-directly-opened-by-excel/
add_action('frm_csv_headers', 'add_sep_to_frm_csv');

function add_sep_to_frm_csv($atts) {
  
    echo 'sep=,'."\n";
  
}

// Force use of category-agenda.php template on tag archive when category is agenda

function agenda_template_override($template) {
	
		global $wp_query;

		$category = get_query_var('category_name');

		if( $category == 'Agenda' ) {
			return locate_template('category-agenda.php');
		}

		return $template;

}
add_filter('template_include', 'agenda_template_override');


/* ACF Options enqueue custom CSS  */ 

function uu_enqueue_custom_styles() {
$css = get_field('uu_options_custom_css', 'option');  

	wp_enqueue_style(
			'custom-style',
			get_template_directory_uri() . '/css/custom.css'
	);

	if( !empty( $css ) ) {
	wp_add_inline_style( 'custom-style', $css );
	} 
}
add_action( 'wp_enqueue_scripts', 'uu_enqueue_custom_styles', 30 ); 


if(!function_exists('wpmu_get_mapped_domain_link')){

	function wpmu_get_mapped_domain_link($blog_id){
		global $wpdb;
		$table_name = $wpdb->prefix . 'domain_mapping';
		if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
			$data = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM '. $table_name .' WHERE blog_id = %d ', $blog_id ) );
		}
		if(!$data) return get_site_url( $blog_id );

		if($data->scheme == 1){
			$schem = 'https://';
		}else{
			$schem = 'http://';
		}
		return print_r($data);
 		//return $schem.$data->domain;
 	}
}

/* refresh transients after post save    */

function uu_delete_agenda_transients() {
	global $post;
	if( $post->post_type == 'post' ) {
		delete_transient( 'home_agenda_posts' );
	}
}
add_action( 'save_post', 'uu_delete_agenda_transients' );