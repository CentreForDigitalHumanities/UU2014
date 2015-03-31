<?php



// Little function to return a custom field value
function uu2014_people_get_custom_field( $value ) {
	global $post;

    $custom_field = get_post_meta( $post->ID, $value, true );
    if ( !empty( $custom_field ) )
	    return is_array( $custom_field ) ? stripslashes_deep( $custom_field ) : stripslashes( wp_kses_decode_entities( $custom_field ) );

    return false;
}

// Register the Metabox
function uu2014_people_add_custom_meta_box() {
	add_meta_box( 'uu2014_people-meta-box', __( 'Personalia', 'uu2014' ), 'uu2014_people_meta_box_output', 'people', 'normal', 'high' );
	//add_meta_box( 'uu2014_people-meta-box', __( 'people details', 'uu2014' ), 'uu2014_people_meta_box_output', 'page', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'uu2014_people_add_custom_meta_box' );

// Output the Metabox
function uu2014_people_meta_box_output( $post ) {
	// create a nonce field
	wp_nonce_field( 'my_uu2014_people_meta_box_nonce', 'uu2014_people_meta_box_nonce' );
	
	?>

<div class="personalia-admin">
	<div class="personalia-photo">
            <img id="uu2014-people-photo" name="uu2014-people-photo" src="<?php echo uu2014_people_get_custom_field( 'uu2014-people-photo_url' ); ?>" height="100" width="100"/>
     </div>  	
	<div class="personalia-content">
		
		<p>
	        <label for="uu2014-people-photo_url">Photo:</label>      
	        <input id="uu2014-people-photo_url" type="text" name="uu2014-people-photo_url" size="50" value="<?php echo uu2014_people_get_custom_field( 'uu2014-people-photo_url' ); ?>">
	        <input class="button" type="button" id="photo_upload" value="<?php _e( 'Choose or Upload an Image', 'uu2014' )?>" />
		
		</p>
	
		<p>
			<label for="uu2014_people_title"><?php _e( 'Title / short description', 'uu2014' ); ?>:</label>
			<input type="text" size="50" name="uu2014_people_title" id="uu2014_people_title" value="<?php echo uu2014_people_get_custom_field( 'uu2014_people_title' ); ?>" />
	    </p>

	    <p>
			<label for="uu2014_people_institution"><?php _e( 'Institution', 'uu2014' ); ?>:</label>
			<input type="text" size="50" name="uu2014_people_institution" id="uu2014_people_institution" value="<?php echo uu2014_people_get_custom_field( 'uu2014_people_institution' ); ?>" />
	    </p>
	    
	    <p>
			<label for="uu2014_people_bio"><?php _e( 'Biography / about', 'uu2014' ); ?>:</label>
			<textarea rows="4" cols="50" name="uu2014_people_bio" id="uu2014_people_bio" value="<?php echo uu2014_people_get_custom_field( 'uu2014_people_bio' ); ?>" /></textarea>
	    </p>
		
		<p>
			<label for="uu2014_people_url"><?php _e( 'Website', 'uu2014' ); ?>:</label>
			<input type="text" size="50" name="uu2014_people_url" id="uu2014_people_url" value="<?php echo uu2014_people_get_custom_field( 'uu2014_people_url' ); ?>" />
	    </p>
	</div>
</div> 
	<?php
}

/**
 * Loads the image management javascript
 */
function prfx_image_enqueue() {
    global $typenow;
    if( $typenow == 'people' ) {
        wp_enqueue_media();
 
        // Registers and enqueues the required javascript.
        wp_register_script( 'meta-box-image', get_template_directory_uri() . '/js/metabox-image-upload.js', array( 'jquery' ) );
        wp_localize_script( 'meta-box-image', 'meta_image',
            array(
                'title' => __( 'Choose or Upload an Image', 'prfx-textdomain' ),
                'button' => __( 'Use this image', 'prfx-textdomain' ),
            )
        );
        wp_enqueue_script( 'meta-box-image' );
    }
}
add_action( 'admin_enqueue_scripts', 'prfx_image_enqueue' );

// Save the Metabox values
function uu2014_people_meta_box_save( $post_id ) {
	// Stop the script when doing autosave
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// Verify the nonce. If insn't there, stop the script
	if( !isset( $_POST['uu2014_people_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['uu2014_people_meta_box_nonce'], 'my_uu2014_people_meta_box_nonce' ) ) return;

	// Stop the script if the user does not have edit permissions
	if( !current_user_can( 'edit_post' ) ) return;

    // Save the fields

	if( isset( $_POST['uu2014-people-photo_url'] ) )
		update_post_meta( $post_id, 'uu2014-people-photo_url', esc_attr( $_POST['uu2014-people-photo_url'] ) );

	if( isset( $_POST['uu2014_people_title'] ) )
		update_post_meta( $post_id, 'uu2014_people_title', esc_attr( $_POST['uu2014_people_title'] ) );
	if( isset( $_POST['uu2014_people_institution'] ) )
		update_post_meta( $post_id, 'uu2014_people_institution', esc_attr( $_POST['uu2014_people_institution'] ) );
	if( isset( $_POST['uu2014_people_bio'] ) )
		update_post_meta( $post_id, 'uu2014_people_bio', esc_attr( $_POST['uu2014_people_bio'] ) );
	if( isset( $_POST['uu2014_people_url'] ) )
		update_post_meta( $post_id, 'uu2014_people_url', esc_attr( $_POST['uu2014_people_url'] ) );

 
}
add_action( 'save_post', 'uu2014_people_meta_box_save' );

// load css

add_action('admin_enqueue_scripts', 'people_admin_style');

function people_admin_style($hook) {
    global $page_handle;
    if ( ($hook == 'post.php') || ($hook == 'post-new.php') || ($_GET['page'] == $page_handle) ) {
        wp_enqueue_style( 'people-admin-style', (get_stylesheet_directory_uri() . '/css/people-admin.css'), false, '1.0.0' );
    }
}
