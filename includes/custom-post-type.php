<?php



// Register Custom Post Type
function custom_post_type_personen() {

	$labels = array(
		'name'                => _x( 'People', 'Post Type General Name', 'uu-template' ),
		'singular_name'       => _x( 'Person', 'Post Type Singular Name', 'uu-template' ),
		'menu_name'           => __( 'People', 'uu-template' ),
		'parent_item_colon'   => __( 'Parent:', 'uu-template' ),
		'all_items'           => __( 'All people', 'uu-template' ),
		'view_item'           => __( 'View Person', 'uu-template' ),
		'add_new_item'        => __( 'Add New Person', 'uu-template' ),
		'add_new'             => __( 'New Person', 'uu-template' ),
		'edit_item'           => __( 'Edit Person', 'uu-template' ),
		'update_item'         => __( 'Update Person', 'uu-template' ),
		'search_items'        => __( 'Search persons', 'uu-template' ),
		'not_found'           => __( 'No persons found', 'uu-template' ),
		'not_found_in_trash'  => __( 'No persons found in Trash', 'uu-template' ),
	);
	$args = array(
		'label'               => __( 'people', 'uu-template' ),
		'description'         => __( 'post type for making people listing pages', 'uu-template' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'author', 'thumbnail', ),
		'taxonomies'          => array( 'post_tag', 'category' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 31,
		'menu_icon'           => get_template_directory_uri() . '/img/people-icon.png',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'person', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type_personen', 0 );





// Register Custom Post Type
function custom_post_type_agenda() {

	$labels = array(
		'name'                => _x( 'Agenda', 'Post Type General Name', 'uu-template' ),
		'singular_name'       => _x( 'Agenda', 'Post Type Singular Name', 'uu-template' ),
		'menu_name'           => __( 'Agenda', 'uu-template' ),
		'parent_item_colon'   => __( 'Parent:', 'uu-template' ),
		'all_items'           => __( 'All Agenda items', 'uu-template' ),
		'view_item'           => __( 'View Agenda item', 'uu-template' ),
		'add_new_item'        => __( 'Add New Agenda item', 'uu-template' ),
		'add_new'             => __( 'New Agenda item', 'uu-template' ),
		'edit_item'           => __( 'Edit Agenda item', 'uu-template' ),
		'update_item'         => __( 'Update Agenda item', 'uu-template' ),
		'search_items'        => __( 'Search Agenda', 'uu-template' ),
		'not_found'           => __( 'Nothing found', 'uu-template' ),
		'not_found_in_trash'  => __( 'Nothing found in Trash', 'uu-template' ),
	);
	$args = array(
		'label'               => __( 'agenda', 'uu-template' ),
		'description'         => __( 'post type for making events', 'uu-template' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'author', 'thumbnail', 'editor' ),
		'taxonomies'          => array( 'post_tag', 'category' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 30,
		'menu_icon'           => get_template_directory_uri() . '/img/calendar-16.png',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'agenda', $args );

	// $set = get_option('post_type_rules_agenda');
	// 	if ($set !== true){
 //   flush_rewrite_rules(false);
 //   update_option('post_type_rules_agenda',true);
}

// activate upcoming agenda items widget

//include TEMPLATEPATH . '/includes/functions/widgets/upcoming_agenda.php';


// Hook into the 'init' action
add_action( 'init', 'custom_post_type_agenda', 0 );

// add menu classes to this custom post type, 
add_action('nav_menu_css_class', 'add_current_nav_class', 10, 2 );


function add_current_nav_class($classes, $item) {
// Getting the current post details
global $post;
// Getting the post type of the current post
$current_post_type = get_post_type_object(get_post_type($post->ID));
$current_post_type_slug = $current_post_type->rewrite[slug];
// Getting the URL of the menu item
$menu_slug = strtolower(trim($item->url));
// If the menu item URL contains the current post types slug add the current-menu-item class
if (strpos($menu_slug,$current_post_type_slug) !== false) {
$classes[] = 'current-menu-item';
}
// Return the corrected set of classes to be added to the menu item
return $classes;
}

?>