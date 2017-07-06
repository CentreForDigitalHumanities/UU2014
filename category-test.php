<?php
/**
 * The template for displaying Agenda Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php get_template_part( 'parts/page-header-2col'); ?> 
	<?php echo do_shortcode( '[uu-follow-category]' ); ?>
	<?php if ( have_posts() ) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<?php get_template_part( 'parts/post-loop'); ?> 

		<?php endwhile; ?>
			
			<?php get_template_part('includes/template','pager'); //wordpress template pager/pagination ?>

	<?php else : ?>

		<?php get_template_part('includes/template','error'); //wordpress template error message ?>

	<?php endif; ?>

<?php get_template_part( 'parts/page-footer-2col'); ?> 

<?php get_footer();