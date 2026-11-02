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
  echo get_bloginfo( 'name' );

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

<base href="<?php get_site_url(); ?>">

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



<meta name="msapplication-TileColor" content="#f01d4f">
<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/images/win8-tile-icon.png">

<link rel="profile" href="https://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<!-- Open Graph Meta Tags for Facebook and LinkedIn Sharing !-->
<?php
$og_title = '';
$og_desc = '';
$og_url = '';
$og_image_id = '';
$og_image_url = '';
$og_type = '';

if ( is_home() || is_front_page() ) { 
		$og_title = get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description', 'display' ); 
		if($site_description) {
			$og_desc = $site_description;
		} else {
			$og_desc = wp_trim_words( $post->post_content, 70 );
		}
		$og_url = get_home_url();
		$og_type = 'website';
		if(function_exists('get_field') && get_field('uu_options_site_share_image', 'options') ) {
			$og_image_id = get_field('uu_options_site_share_image', 'options');
			$og_image_url = wp_get_attachment_image_url($og_image_id, 'full');
		} else {
			$image = get_header_image();
			if ( $image ) {
				$og_image_url = esc_url( $image );
			}
		}

		
	} else { 
		if( is_singular() ) {
			$og_title = get_the_title(); 
			$og_type = 'article';
		} elseif ( is_archive() ) {
			$og_title = get_the_archive_title( '', false ); 
			$og_type = 'website';
		} else {
			$og_title = get_bloginfo( 'name' );
			$og_type = 'website';
		}
		$og_desc = wp_trim_words( $post->post_content, 70 );
		$og_url = get_the_permalink();

		if (has_post_thumbnail( $post->ID ) ) {
			$og_image_url = get_the_post_thumbnail_url($post->ID, 'full');
		} else {
			$image = get_header_image();
			if ( $image ) {
				$og_image_url = esc_url( $image );
			}
		}
		
	} ?>
<meta property="og:title" content="<?php echo $og_title; ?>"/>
<meta property="og:description" content="<?php echo $og_desc; ?>" />
<meta property="og:url" content="<?php echo $og_url; ?>" />
<meta property="og:image" content="<?php echo $og_image_url; ?>" />
<meta property="og:type" content="<?php echo $og_type; ?>" />
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