<?php

/*
| -------------------------------------------------------------------
| Custom header support
| -------------------------------------------------------------------
|
| */

$defaults = array(
  'default-image'=> '%s/images/headers/default.jpg',
  'random-default'=> false,
  'width'=> 1368,  // Make sure to set this
  'height'=> 250, // Make sure to set this
  'flex-height'=> true,
  'flex-width'=> false,
  'default-text-color'=> 'ffffff',
  'header-text'=> false,
  'uploads'=> true,
  'wp-head-callback'=> 'uu2014_custom_headers_callback',
  'admin-head-callback'=> '',
  'admin-preview-callback'=> '',
);
add_theme_support( 'custom-header', $defaults );



    // We'll be using post thumbnails for custom header images on posts and pages.
    // We want them to be 1368 pixels wide by 250 pixels tall.
    // Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.

// set_post_thumbnail_size( $custom_header_support['width'], $custom_header_support['height'], true );


function uu2014_header_image() {
        global $post;
        // Check to see if the header image has been removed
        $header_image = get_header_image();
        if ( $header_image ) :
          // Compatibility with versions of WordPress prior to 3.4.
          if ( function_exists( 'get_custom_header' ) ) {
            // We need to figure out what the minimum width should be for our featured image.
            // This result would be the suggested width if the theme were to implement flexible widths.
            $header_image_width = get_theme_support( 'custom-header', 'width' );
          } else {
            $header_image_width = HEADER_IMAGE_WIDTH;
          }
          
          // The header image
          // Check if this is a post or page, if it has a thumbnail, and if it's a big one
          if ( is_singular() && has_post_thumbnail( $post->ID ) &&
              ( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $header_image_width, $header_image_width ) ) ) &&
              $image[1] >= $header_image_width ) :
            // Houston, we have a new header image!
            echo get_the_post_thumbnail( $post->ID, 'uu-header' );
          else :
            // Compatibility with versions of WordPress prior to 3.4.
            if ( function_exists( 'get_custom_header' ) ) {
              $header_image_width  = get_custom_header()->width;
              $header_image_height = get_custom_header()->height;
            } else {
              $header_image_width  = HEADER_IMAGE_WIDTH;
              $header_image_height = HEADER_IMAGE_HEIGHT;
            }
            ?>
          <img src="<?php header_image(); ?>" width="<?php echo $header_image_width; ?>" height="<?php echo $header_image_height; ?>" alt="" /> <?php
        endif; // end check for featured image or standard header

  endif; // end check for removed header image
}

?>