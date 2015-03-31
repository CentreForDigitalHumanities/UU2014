<?php

// Enqueue Datepicker + jQuery UI CSS

function uu_agenda_enqueue() {
    global $typenow;
    if(is_admin()) {
    	wp_register_script( 'agenda-datepicker', get_template_directory_uri() . '/js/field_date.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker' ) );
        wp_enqueue_script( 'agenda-datepicker' );
        wp_enqueue_style( 'jquery-ui-datepicker' );
    }
}

add_action('admin_head','add_agenda_datepicker');
function add_agenda_datepicker() {
    global $custom_meta_fields, $post;
     
    $output = '<script type="text/javascript">
                jQuery(function() {';
                 
    foreach ($custom_meta_fields as $field) { // loop through the fields looking for certain types
        if($field['type'] == 'date')
            $output .= 'jQuery(".datepicker").datepicker();';
    }
     
    $output .= '});
        </script>';
         
    echo $output;
}



// Little function to return a custom field value
function uu2014_agenda_get_custom_field( $value ) {
	global $post;

    $custom_field = get_post_meta( $post->ID, $value, true );
    if ( !empty( $custom_field ) )
	    return is_array( $custom_field ) ? stripslashes_deep( $custom_field ) : stripslashes( wp_kses_decode_entities( $custom_field ) );

    return false;
}

// Register the Metabox
function uu2014_agenda_add_custom_meta_box() {
	add_meta_box( 'uu2014_agenda-meta-box', __( 'Agenda details', 'uu2014' ), 'uu2014_agenda_meta_box_output', 'agenda', 'normal', 'high' );
	//add_meta_box( 'uu2014_agenda-meta-box', __( 'Agenda details', 'uu2014' ), 'uu2014_agenda_meta_box_output', 'page', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'uu2014_agenda_add_custom_meta_box' );

// Output the Metabox
function uu2014_agenda_meta_box_output( $post ) {
	// create a nonce field
	wp_nonce_field( 'my_uu2014_agenda_meta_box_nonce', 'uu2014_agenda_meta_box_nonce' ); ?>
	<p><strong><?php _e( 'Date', 'uu2014' ); ?></strong></p>
	<p>	
		<label for="uu2014_agenda_startdate"><?php _e( 'From', 'uu2014' ); ?>:</label>
		<input type="date" size="13" class="datepicker-field" name="uu2014_agenda_startdate" id="uu2014_agenda_startdate" value="<?php echo uu2014_agenda_get_custom_field( 'uu2014_agenda_startdate' ); ?>" size="50" />
    	<label for="uu2014_agenda_enddate"><?php _e( 'till', 'uu2014' ); ?>:</label>
		<input type="date" size="13" class="datepicker-field" name="uu2014_agenda_enddate" id="uu2014_agenda_enddate" value="<?php echo uu2014_agenda_get_custom_field( 'uu2014_agenda_enddate' ); ?>" size="50" />
    </p>
    <p><strong><?php _e( 'Time', 'uu2014' ); ?></strong></p>
	<p>	
		<label for="uu2014_agenda_starttime"><?php _e( 'From', 'uu2014' ); ?>:</label>
		<input type="text" size="13" class="timepicker-field" name="uu2014_agenda_starttime" id="uu2014_agenda_starttime" value="<?php echo uu2014_agenda_get_custom_field( 'uu2014_agenda_starttime' ); ?>" size="50" />
    	<label for="uu2014_agenda_endtime"><?php _e( 'till', 'uu2014' ); ?>:</label>
		<input type="text" size="13" class="timepicker-field" name="uu2014_agenda_endtime" id="uu2014_agenda_endtime" value="<?php echo uu2014_agenda_get_custom_field( 'uu2014_agenda_endtime' ); ?>" size="50" />
    </p>
	
	<p>
		<label for="uu2014_agenda_url"><?php _e( 'Url', 'uu2014' ); ?>:</label>
		<input type="text" size="50" name="uu2014_agenda_url" id="uu2014_agenda_url" value="<?php echo uu2014_agenda_get_custom_field( 'uu2014_agenda_url' ); ?>" size="50" />
    </p>
    
	<?php
}

// Save the Metabox values
function uu2014_agenda_meta_box_save( $post_id ) {
	// Stop the script when doing autosave
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// Verify the nonce. If insn't there, stop the script
	if( !isset( $_POST['uu2014_agenda_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['uu2014_agenda_meta_box_nonce'], 'my_uu2014_agenda_meta_box_nonce' ) ) return;

	// Stop the script if the user does not have edit permissions
	if( !current_user_can( 'edit_post' ) ) return;

    // Save the fields
	if( isset( $_POST['uu2014_agenda_startdate'] ) )
		update_post_meta( $post_id, 'uu2014_agenda_startdate', esc_attr( $_POST['uu2014_agenda_startdate'] ) );

	if( isset( $_POST['uu2014_agenda_enddate'] ) )
		update_post_meta( $post_id, 'uu2014_agenda_enddate', esc_attr( $_POST['uu2014_agenda_enddate'] ) );

	if( isset( $_POST['uu2014_agenda_starttime'] ) )
		update_post_meta( $post_id, 'uu2014_agenda_starttime', esc_attr( $_POST['uu2014_agenda_starttime'] ) );

	if( isset( $_POST['uu2014_agenda_endtime'] ) )
		update_post_meta( $post_id, 'uu2014_agenda_endtime', esc_attr( $_POST['uu2014_agenda_endtime'] ) );

	if( isset( $_POST['uu2014_agenda_url'] ) )
		update_post_meta( $post_id, 'uu2014_agenda_url', esc_attr( $_POST['uu2014_agenda_url'] ) );

 
}
add_action( 'save_post', 'uu2014_agenda_meta_box_save' );


// Place the metabox in the post edit page below the editor before other metaboxes (like the Excerpt)
// add_meta_box( 'uu2014_agenda-meta-box', __( 'Metabox Example', 'uu2014' ), 'uu2014_agenda_meta_box_output', 'post', 'normal', 'high' );
// Place the metabox in the post edit page below the editor at the end of other metaboxes
// add_meta_box( 'uu2014_agenda-meta-box', __( 'Metabox Example', 'uu2014' ), 'uu2014_agenda_meta_box_output', 'post', 'normal', '' );
// Place the metabox in the post edit page in the right column before other metaboxes (like the Publish)
// add_meta_box( 'uu2014_agenda-meta-box', __( 'Metabox Example', 'uu2014' ), 'uu2014_agenda_meta_box_output', 'post', 'side', 'high' );
// Place the metabox in the post edit page in the right column at the end of other metaboxes
// add_meta_box( 'uu2014_agenda-meta-box', __( 'Metabox Example', 'uu2014' ), 'uu2014_agenda_meta_box_output', 'post', 'side', '' );
