<?php get_header(); ?>

<?php get_template_part( 'parts/page-header-2col'); ?> 

 <div class="fourofour">404</div>
	<header>
		<h1><?php _e( 'That page can&rsquo;t be found.', 'uu2014' ); ?></h1>
	</header><!-- .page-header -->

					
						
	<p><?php _e( 'It looks like nothing was found at this location. This may be due to the page being moved, renamed or deleted.<ul><li>Check the URL in the address bar above</li><li>Look for the page in the main navigation above or on the <a href="/site-map/" title="Site Map Page">Site Map</a> page</li><li>Try using the Search below.</li></ul>'); ?></p>

	<?php get_search_form(); ?>

<?php get_template_part( 'parts/page-footer-2col'); ?> 

<?php 

global $wp_rewrite;
$wp_rewrite->init(); //important...
$wp_rewrite->flush_rules();

get_footer();
