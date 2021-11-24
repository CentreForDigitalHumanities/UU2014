<?php
/**
 * The template for displaying the header.
 *
 * Contains the opening tag for the page structure
 */
?><!DOCTYPE html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
<meta charset="UTF-8">
<title><?php
  /*
   * Print the <title> tag based on what is being viewed.
   */
  global $post, $page, $paged;
   if( function_exists('get_field') && get_field('uu_siteoptions_description', 'options') ) { 
   		$site_description = get_field('uu_siteoptions_description', 'options');
   } else {
   		 $site_description = get_bloginfo( 'description', 'display' );
   }
 

  // Add the blog name.
  bloginfo( 'name' );

  // Add the blog description for the home/front page.
  
  if ( get_bloginfo( 'description', 'display' ) && ( is_home() || is_front_page() ) )
    echo " | " . get_bloginfo( 'description', 'display' );

  if (is_singular()) {
  	echo " | " . $post->post_title;
  }	
  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 )
    echo ' | ' . sprintf( __( 'Page %s', 'uu-template' ), max( $paged, $page ) );

  ?></title>

<base href="<?php echo get_site_url(); ?>">

<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1"/>




<?php // icons & favicons (for more: https://www.jonathantneal.com/blog/understand-the-favicon/) ?>
<?php if(function_exists('get_field') && get_field('uu_options_custom_favicon', 'options') )	{ 
	$favicon_image = get_field('uu_options_custom_favicon', 'options');
	$favicon = $favicon_image['url']; 
	$custom_icon = $favicon_image['url'];
} else {
	$favicon = get_template_directory_uri() . '/images/favicon.ico';
	$custom_icon = get_template_directory_uri() . '/images/apple-icon-touch.png';
} ?>
<link rel="icon" href="<?php echo $favicon; ?>">
<link rel="apple-touch-icon" href="<?php echo $custom_icon; ?>">


<!--[if IE]><link rel="shortcut icon" href="<?php echo $favicon; ?>">
<![endif]-->




<meta name="msapplication-TileColor" content="#f01d4f">
<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/images/win8-tile-icon.png">

<link rel="profile" href="https://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<!-- Open Graph Meta Tags for Facebook and LinkedIn Sharing !-->
<?php if ( is_home() || is_front_page() ) 
   { $og_title = get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description', 'display' ); } else { $og_title = get_the_title(); } ?>
<meta property="og:title" content="<?php echo $og_title; ?>"/>
<?php if ( $site_description && ( is_home() || is_front_page() ) )
   { $og_desc = $site_description; } else { $og_desc = apply_filters('get_the_excerpt', get_post_field('post_excerpt', $post->ID));  } 
   if ( $og_desc == '' ) {
    $og_desc = wp_trim_words( $post->post_content, 70 );
	}

   ?>
<meta property="og:description" content="<?php echo $og_desc; ?>" />
<?php if ( is_home() || is_front_page() ) 
   { $og_url = get_home_url(); } else { $og_url = get_the_permalink(); } ?>
<meta property="og:url" content="<?php echo $og_url; ?>" />
<?php 
if(function_exists('get_field') && get_field('uu_options_site_share_image', 'options') )	{ 
	$fb_image_id = get_field('uu_options_site_share_image', 'options');
	$fb_image_url = wp_get_attachment_image_url($fb_image_id, 'full');
?>
<meta property="og:image" content="<?php echo $fb_image_url; ?>" />
<?php } else { ?>
<meta property="og:image" content="<?php header_image(); ?>" />
<?php } ?>
<meta property="og:type" content="<?php
	if (is_single() || is_page()) { echo "article"; } else { echo "website";} ?>" />
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<!-- End Open Graph Meta Tags !-->



<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> data-spy="scroll" data-target="#sidebarnav">
     
	<div id="page">
		<?php if( get_field('uu_options_brandbar', 'option') ) { ?>
			
		<?php	} else {get_template_part( 'parts/brandbar');} ?> 
		<header id="masthead" class="header hidden-print">

			<div class="container">

				<?php // to use a image just replace the bloginfo('name') with <img> ?>
				<h1>

				<a href="<?php  echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo('name'); ?>">
					<?php bloginfo('name'); ?>
				</a>

			    </h1>

				<?php // if you'd like to use the site description you can un-comment it below
				// echo '<p class="site-description">'. bloginfo( "description" ) .'</p>' ?>

			</div>

		</header>

		<a class="skip-link sr-only" href="#content"><?php _e( 'Skip to content', 'uu2014' ); ?></a>

<?php uu_main_navigation(); ?>


 	
			
       

		
