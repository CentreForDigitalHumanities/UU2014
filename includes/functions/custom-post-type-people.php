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
		'menu_icon'           => get_template_directory_uri() . '/images/people-icon.png',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'people', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type_personen', 0 );





?>