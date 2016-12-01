<?php
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

	$slug = get_theme_mod( 'agenda_permalink' );
  	$slug = ( empty( $slug ) ) ? 'agenda' : $slug;


	$args = array(
		'label'               => __( 'agenda', 'uu-template' ),
		'description'         => __( 'post type for making events', 'uu-template' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'author', 'thumbnail', 'editor' ),
		'taxonomies'          => array( 'post_tag', 'category' ),
		'hierarchical'        => false,
		'rewrite'             => array( 'slug' => $slug ),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 30,
		'menu_icon'           => get_template_directory_uri() . '/images/calendar-16.png',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'agenda', $args );

}


// Hook into the 'init' action
add_action( 'init', 'custom_post_type_agenda', 0 );

// add admin columns

add_filter('manage_agenda_posts_columns', 'uu_agenda_table_head');

function uu_agenda_table_head( $defaults ) {
    $defaults['startdate']  = 'Agenda Date';
    // $defaults['ticket_status']    = 'Ticket Status';
    // $defaults['venue']   = 'Venue';
    // $defaults['author'] = 'Added By';
    return $defaults;
}

add_action( 'manage_agenda_posts_custom_column', 'uu_agenda_table_content', 10, 2 );

function uu_agenda_table_content( $column_name, $post_id ) {
    if ($column_name == 'startdate') {
    $start_date = get_post_meta( $post_id, 'uu2014_agenda_startdate', true );
    $date_format = get_option( 'date_format' );
      echo  date( _x( $date_format, 'Event date format', 'uu2014' ), strtotime( $start_date ) );
    }
    // if ($column_name == 'ticket_status') {
    // $status = get_post_meta( $post_id, '_bs_meta_event_ticket_status', true );
    // echo $status;
    // }

    // if ($column_name == 'venue') {
    // echo get_post_meta( $post_id, '_bs_meta_event_venue', true );
    // }

}


// make admin columns sortable

add_filter( 'manage_edit-agenda_sortable_columns', 'uu_agenda_table_sorting' );
function uu_agenda_table_sorting( $columns ) {
  $columns['startdate'] = 'startdate';
  // $columns['ticket_status'] = 'ticket_status';
  // $columns['venue'] = 'venue';
  return $columns;
}

add_filter( 'request', 'uu_agenda_date_column_orderby' );
function uu_agenda_date_column_orderby( $vars ) {
	/* Check if 'orderby' is set to 'startdate'. */
    if ( isset( $vars['orderby'] ) && 'startdate' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'uu2014_agenda_startdate',
            'orderby' => 'meta_value_num'
        ) );
    }

    return $vars;
}




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