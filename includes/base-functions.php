<?php
/*
Author: Hall Internet Marketing
URL: https://github.com/hallme/scaffolding

All stock functions used on every scaffolding site live here.
Custom functions go in functions.php to facilitate future updates if necessary.
*/

/******************************************

TABLE OF CONTENTS

1. Initiating Scaffolding
2. Cleaning Up wp_head
3. Page Navi
4. Client UX Functions
5. Dashboard Widgets
6. Visitor UX Function
7. Recommended/Required Plugin Activation

******************************************/

/*********************
INITIATING SCAFFOLDING
*********************/
add_action( 'after_setup_theme', 'uu2014_build', 16 );

function uu2014_build() {

	add_action('init', 'uu2014_head_cleanup');										// launching operation cleanup
	add_filter('the_generator', 'uu2014_rss_version');								// remove WP version from RSS
	add_filter( 'wp_head', 'uu2014_remove_wp_widget_recent_comments_style', 1 );	// remove pesky injected css for recent comments widget
	add_action('wp_head', 'uu2014_remove_recent_comments_style', 1);				// clean up comment styles in the head
	add_filter('gallery_style', 'uu2014_gallery_style');							// clean up gallery output in wp
	add_action('wp_enqueue_scripts', 'uu2014_scripts_and_styles', 999);			// enqueue base scripts and styles

	uu2014_theme_support();														// launching this stuff after theme setup
	add_action( 'widgets_init', 'uu2014_register_sidebars' );						// adding sidebars to Wordpress (these are created in functions.php)
	add_filter( 'get_search_form', 'uu2014_wpsearch' ); 							// adding the scaffolding search form (created in functions.php)
	add_filter('the_content', 'uu2014_filter_ptags_on_images'); 					// cleaning up random code around images
	add_filter('excerpt_more', 'uu2014_excerpt_more');								// cleaning up excerpt
}

/*********************
CLEANING UP WP_HEAD
*********************/

function uu2014_head_cleanup() {

	// remove_action( 'wp_head', 'feed_links_extra', 3 );						// category feeds
	// remove_action( 'wp_head', 'feed_links', 2 );								// post and comment feeds
	remove_action( 'wp_head', 'rsd_link' );										// EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' );								// windows live writer
	remove_action( 'wp_head', 'index_rel_link' );								// index link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );					// previous link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );					// start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );		// links for adjacent posts
	remove_action( 'wp_head', 'wp_generator' );									// WP version
	add_filter( 'style_loader_src', 'uu2014_remove_wp_ver_css_js', 9999 );	// remove WP version from css
	add_filter( 'script_loader_src', 'uu2014_remove_wp_ver_css_js', 9999 );// remove WP version from scripts
}

// remove WP version from RSS
function uu2014_rss_version() { return ''; }

// remove WP version from scripts
function uu2014_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// remove injected CSS for recent comments widget
function uu2014_remove_wp_widget_recent_comments_style() {
	if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
		remove_filter('wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function uu2014_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
	}
}

// remove injected CSS from gallery
function uu2014_gallery_style($css) {
	return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)
function uu2014_page_navi($before = '', $after = '') {
	global $wpdb, $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}
	echo $before.'<nav class="page-navigation"><ul class="uu2014_page_navi clearfix">'."";
	if ($start_page >= 2 && $pages_to_show < $max_page) {
		$first_page_text = __( "First", 'uu2014' );
		echo '<li class="bpn-first-page-link"><a rel="prev" href="'.get_pagenum_link().'" title="'.$first_page_text.'">'.$first_page_text.'</a></li>';
	}
	echo '<li>';
	previous_posts_link('<span class="pager back"><svg version="1.1" class="arrow-left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="7.777px" height="12.727px" viewBox="0 0 7.777 12.727" fill="#ffffff" enable-background="new 0 0 7.777 12.727" xml:space="preserve">
<polygon points="1.414,4.949 6.363,0 7.778,1.414 2.827,6.365 7.778,11.313 6.363,12.727 1.414,7.778 0,6.365 "/>
</svg></span>');
	echo '</li>';
	for($i = $start_page; $i  <= $end_page; $i++) {
		if( $i == $paged ) {
			echo '<li><span class="pager active">'.$i.'</span></li>';
		}
		elseif( $i == ($paged - 1) ) {
			echo '<li><a rel="prev" href="'.get_pagenum_link($i).'"  class="pager" title="View Page '.$i.'">'.$i.'</a></li>';
		}
		elseif( $i == ($paged + 1) ) {
			echo '<li><a rel="next" href="'.get_pagenum_link($i).'"  class="pager" title="View Page '.$i.'">'.$i.'</a></li>';
		}
		else {
			echo '<li><a href="'.get_pagenum_link($i).'"  class="pager" title="View Page '.$i.'">'.$i.'</a></li>';
		}
	}
	echo '<li>';
	next_posts_link('<span class="pager next"><svg version="1.1" class="arrow-right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="7.778px" height="12.727px" viewBox="0 0 7.778 12.727" fill="#ffffff" enable-background="new 0 0 7.778 12.727" xml:space="preserve">
<polygon fill-rule="evenodd" clip-rule="evenodd" points="6.364,7.778 1.415,12.727 0,11.313 4.95,6.363 0,1.414 1.415,0 
	6.364,4.949 7.778,6.363 6.364,7.778 "/>
</svg></span>');
	echo '</li>';
	if ($end_page < $max_page) {
		$last_page_text = __( "Last", 'uu2014' );
		echo '<li class="pager black"><a rel="next" href="'.get_pagenum_link($max_page).'" title="'.$last_page_text.'">'.$last_page_text.'</a></li>';
	}
	echo '</ul></nav>'.$after."";
} /* end page navi */

//add rel and title attribute to next pagination link
function uu2014_get_next_posts_link_attributes($attr){
	$attr = 'rel="next" title="View the Next Page"';
	return $attr;
}
add_filter('next_posts_link_attributes', 'uu2014_get_next_posts_link_attributes');

//add rel and title attribute to prev pagination link
function uu2014_get_previous_posts_link_attributes($attr){
	$attr = 'rel="prev" title="View the Previous Page"';
	return $attr;
}
add_filter('previous_posts_link_attributes', 'uu2014_get_previous_posts_link_attributes');

/*********************
CLIENT UX FUNCTIONS
*********************/
//Extend permisitons for the 'editor' role (used for client accounts)
// function uu2014_increase_editor_permissions(){
// 	$role = get_role('editor');
// 	$role->add_cap('gform_full_access'); // Gives editors access to Gravity Forms
// 	$role->add_cap('edit_theme_options'); // Gives editors access to widgets & menus
// }
// add_action('admin_init','uu2014_increase_editor_permissions');

// Removes the Powered By WPEngine widget
wp_unregister_sidebar_widget( 'wpe_widget_powered_by' );

//Remove some of the admin bar links to keep from confusing client admins
function uu2014_remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo'); // Remove Wordpress Logo From Admin Bar
	$wp_admin_bar->remove_menu('wpseo-menu'); // Remove SEO from Admin Bar
}
add_action( 'wp_before_admin_bar_render', 'uu2014_remove_admin_bar_links' );

// Custom Backend Footer
function uu2014_custom_admin_footer() {
	echo '<span id="footer-thankyou">Developed by <a href="https://www.uu.nl/ictenmedia" target="_blank">ICT&Media</a></span>. For questions mail: <a href="mailto:ictenmedia@uu.nl">ictenmedia@uu.nl</a>';
}
add_filter('admin_footer_text', 'uu2014_custom_admin_footer');

// CUSTOM LOGIN PAGE
// calling your own login css so you can style it
function uu2014_login_css() {
	/* I couldn't get wp_enqueue_style to work :( */
	echo '<link rel="stylesheet" href="' . get_stylesheet_directory_uri() . '/css/login.css">';
}

// changing the logo link from wordpress.org to your site
function uu2014_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function uu2014_login_title() { return get_option('blogname'); }

// calling it only on the login page
add_action('login_head', 'uu2014_login_css');
add_filter('login_headerurl', 'uu2014_login_url');
add_filter('login_headertitle', 'uu2014_login_title');

//Add page title attribute to a tags
function uu2014_wp_list_pages_filter($output) {
	$output = preg_replace('/<a(.*)href="([^"]*)"(.*)>(.*)<\/a>/','<a$1 title="$4" href="$2"$3>$4</a>',$output);
	return $output;
}
add_filter('wp_list_pages', 'uu2014_wp_list_pages_filter');

//return the search results page even if the query is empty - http://vinayp.com.np/how-to-show-blank-search-on-wordpress/
function uu2014_make_blank_search ($query){
	global $wp_query;
	if (isset($_GET['s']) && $_GET['s']==''){  //if search parameter is blank, do not return false
		$wp_query->set('s',' ');
		$wp_query->is_search=true;
	}
	return $query;
}
add_action('pre_get_posts','uu2014_make_blank_search');

/*********************
DASHBOARD WIDGETS
*********************/
// disable default dashboard widgets
function uu2014_disable_default_dashboard_widgets() {
	//remove_meta_box('dashboard_right_now', 'dashboard', 'core');// Right Now Widget
	//remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');// Comments Widget
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');// Incoming Links Widget
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');// Plugins Widget
	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');// Quick Press Widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');// Recent Drafts Widget
	//remove_meta_box('dashboard_primary', 'dashboard', 'core');//1st blog feed
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');//2nd blog feed
	// removing plugin dashboard boxes
	//remove_meta_box('yoast_db_widget', 'dashboard', 'normal');		 // Yoast's SEO Plugin Widget
}
// removing the dashboard widgets
add_action('admin_menu', 'uu2014_disable_default_dashboard_widgets');

/*********************
VISITOR/USER UX FUNCTIONS
*********************/
//Apply styles to the visual editor
function uu2014_mcekit_editor_style($url) {
	if ( !empty($url) ) {
		$url .= ',';
	}
	// Retrieves the plugin directory URL and adds editor stylesheet
	// Change the path here if using different directories
	$url .= trailingslashit( get_template_directory_uri() ) . 'css/editor-styles.css';
	return $url;
}
add_filter('mce_css', 'uu2014_mcekit_editor_style');

//Filter out hard-coded width, height attributes on all images in WordPress. - https://gist.github.com/4557917 - for more information
function uu2014_remove_img_dimensions($html) {
	// Loop through all <img> tags
	if (preg_match('/<img[^>]+>/ims', $html, $matches)) {
		foreach ($matches as $match) {
			// Replace all occurences of width/height
			$clean = preg_replace('/(width|height)=["\'\d%\s]+/ims', "", $match);
			// Replace with result within html
			$html = str_replace($match, $clean, $html);
		}
	}
	return $html;
}
add_filter('post_thumbnail_html', 'uu2014_remove_img_dimensions', 10);
//add_filter('the_content', 'uu2014_remove_img_dimensions', 10); //Options - This has been removed from the content filter so that clients can still edit image sizes in the editor
add_filter('get_avatar','uu2014_remove_img_dimensions', 10);

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function uu2014_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// Fix Gravity Form Tabindex Conflicts - http://gravitywiz.com/2013/01/28/fix-gravity-form-tabindex-conflicts/
function uu2014_gform_tabindexer() {
	$starting_index = 1000; // if you need a higher tabindex, update this number
	return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
}
add_filter("gform_tabindex", "uu2014_gform_tabindexer");

// Filter out hard-coded width, height attributes on all captions (wp-caption class)
add_shortcode('wp_caption', 'uu2014_fixed_img_caption_shortcode');
add_shortcode('caption', 'uu2014_fixed_img_caption_shortcode');
function fixed_img_caption_shortcode($attr, $content = null) {
	if ( ! isset( $attr['caption'] ) ) {
		if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
			$content = $matches[1];
			$attr['caption'] = trim( $matches[2] );
		}
	}
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' ) return $output;
	extract(shortcode_atts(array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	), $attr));
	if ( 1 > (int) $width || empty($caption) ) return $content;
	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" >'
	. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

