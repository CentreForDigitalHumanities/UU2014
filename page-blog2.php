<?php
/**
 * Template Name: Blog Page large items
 * Description: Display blog posts, for options see "UU Options"
 *
 */
get_header(); ?>

			
	
<?php get_template_part( 'parts/page-header-2col'); ?> 
		
<?php get_template_part( 'parts/index_blog2'); ?> 

<?php // include(locate_template('parts/index_blog')); ?>

<?php get_template_part( 'parts/page-footer-2col'); ?> 

<?php get_footer();