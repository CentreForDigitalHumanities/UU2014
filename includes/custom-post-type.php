<?php
/**
 * Custom Post Type Example
 * This page walks you through creating
 * a custom post type and taxonomies.
 *
 * You should copy this to a new file to
 * create your custom type.
 *
 * Make sure to include it in functions.php
 */

// Registered handles for Custom Post Type and Custom Taxonomies
define( 'CUSTOM_POST_TYPE', 'custom_type' );
define( 'CUSTOM_TAXONOMY_CAT', 'custom_cat' );
define( 'CUSTOM_TAXONOMY_TAG', 'custom_tag' );


// let's create the function for the custom type
function uu2014dev_custom_post_example() {

	/**
	 * Register Custom Post Type (CPT)
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	
	register_post_type( CUSTOM_POST_TYPE,
	 	// let's now add all the options for this post type
		array(
			'labels' => array(
				'name'               => __( 'Custom Types', 'uu2014dev' ),                   // This is the Title of the Group
				'singular_name'      => __( 'Custom Post', 'uu2014dev' ),                    // This is the individual type
				'all_items'          => __( 'All Custom Posts', 'uu2014dev' ),               // the all items menu item
				'add_new'            => __( 'Add New', 'uu2014dev' ),                        // The add new menu item
				'add_new_item'       => __( 'Add New Custom Type', 'uu2014dev' ),            // Add New Display Title
				'edit'               => __( 'Edit', 'uu2014dev' ),                           // Edit Dialog
				'edit_item'          => __( 'Edit Post Types', 'uu2014dev' ),                // Edit Display Title
				'new_item'           => __( 'New Post Type', 'uu2014dev' ),                  // New Display Title
				'view_item'          => __( 'View Post Type', 'uu2014dev' ),                 // View Display Title
				'search_items'       => __( 'Search Post Type', 'uu2014dev' ),               // Search Custom Type Title
				'not_found'          => __( 'Nothing found in the Database.', 'uu2014dev' ), // This displays if there are no entries yet
				'not_found_in_trash' => __( 'Nothing found in Trash', 'uu2014dev' ),         // This displays if there is nothing in the trash
				'parent_item_colon'  => ''
			),
			'description'         => __( 'This is the example custom post type', 'uu2014dev' ), // Custom Type Description
			'public'              => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'menu_position'       => 8,                       // where CPT appars in primary admin menu
			'menu_icon'           => 'dashicons-portfolio',   // icon for CPT - use handle from http://melchoyce.github.io/dashicons/ - only 3.9+
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'has_archive'         => 'custom-type',           // you can rename the archive slug here
			'rewrite'	          => array(
				'slug' => __( 'custom-type', 'uu2014dev' ), // you can specify the url slug
				'with_front' => false
			),
			'query_var'           => true,

			// the next one is important, it tells what's enabled in the post editor
			'supports'            => array( 'title',  'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky' ),

			// register taxonomies for CPT, edit if new CT's defined above
			'taxonomies'          => array( 'category', 'post_tag', CUSTOM_TAXONOMY_CAT, CUSTOM_TAXONOMY_TAG )
	 	)
	); /* end of register post type */


	/**
	 * Register Custom Taxonomies
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */

	// now let's add custom categories (these act like categories)
	register_taxonomy( CUSTOM_TAXONOMY_CAT,
		array( CUSTOM_POST_TYPE ),  // CPT handle defined above
		array(
			'hierarchical' => true, // if this is true, it acts like categories
			'labels' => array(
				'name'              => __( 'Custom Categories', 'uu2014dev' ),        // name of the custom taxonomy
				'singular_name'     => __( 'Custom Category', 'uu2014dev' ),          // single taxonomy name
				'search_items'      => __( 'Search Custom Categories', 'uu2014dev' ), // search title for taxomony
				'all_items'         => __( 'All Custom Categories', 'uu2014dev' ),    // all title for taxonomies
				'parent_item'       => __( 'Parent Custom Category', 'uu2014dev' ),   // parent title for taxonomy
				'parent_item_colon' => __( 'Parent Custom Category:', 'uu2014dev' ),  // parent taxonomy title
				'edit_item'         => __( 'Edit Custom Category', 'uu2014dev' ),     // edit custom taxonomy title
				'update_item'       => __( 'Update Custom Category', 'uu2014dev' ),   // update title for taxonomy
				'add_new_item'      => __( 'Add New Custom Category', 'uu2014dev' ),  // add new title for taxonomy
				'new_item_name'     => __( 'New Custom Category Name', 'uu2014dev' )  // name title for taxonomy
			),
			'show_admin_column' => true,
			'show_ui'           => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => __( 'custom-category', 'uu2014dev' ) )
		)
	);

	// now let's add custom tags (these act like tags)
	register_taxonomy( CUSTOM_TAXONOMY_TAG,
		array( CUSTOM_POST_TYPE ),   // CPT handle defined above
		array(
			'hierarchical' => false, // if this is false, it acts like tags
			'labels' => array(
				'name'              => __( 'Custom Tags', 'uu2014dev' ),        // name of the custom taxonomy
				'singular_name'     => __( 'Custom Tag', 'uu2014dev' ),         // single taxonomy name
				'search_items'      => __( 'Search Custom Tags', 'uu2014dev' ), // search title for taxomony
				'all_items'         => __( 'All Custom Tags', 'uu2014dev' ),    // all title for taxonomies
				'parent_item'       => __( 'Parent Custom Tag', 'uu2014dev' ),  // parent title for taxonomy
				'parent_item_colon' => __( 'Parent Custom Tag:', 'uu2014dev' ), // parent taxonomy title
				'edit_item'         => __( 'Edit Custom Tag', 'uu2014dev' ),    // edit custom taxonomy title
				'update_item'       => __( 'Update Custom Tag', 'uu2014dev' ),  // update title for taxonomy
				'add_new_item'      => __( 'Add New Custom Tag', 'uu2014dev' ), // add new title for taxonomy
				'new_item_name'     => __( 'New Custom Tag Name', 'uu2014dev' ) // name title for taxonomy
			),
			'show_admin_column' => true,
			'show_ui'           => true,
			'query_var'         => true
		)
	);

	// For custom meta boxes, use the Advanced Custom Fields plugin from http://www.advancedcustomfields.com
}

// adding the function to the Wordpress init
add_action( 'init', 'uu2014dev_custom_post_example' );