<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php get_template_part( 'parts/page-header-2col'); ?> 

<div class="author_bio clearfix">
	<?php get_template_part( 'parts/author_badge'); ?> 	
	<div class="author_page_url"><a href="<?php the_author_meta('user_url'); ?>" target="_blank">Website</a></div>
	 <?php the_author_meta('user_description'); ?> 
</div>

<div class="author_posts">
	<?php if ( have_posts() ) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<?php get_template_part( 'parts/post-loop'); ?> 

		<?php endwhile; ?>

			<?php get_template_part('includes/template','pager'); //wordpress template pager/pagination ?>

	<?php else : ?>

		<?php get_template_part('includes/template','error'); //wordpress template error message ?>

	<?php endif; ?>
</div>
<?php get_template_part( 'parts/page-footer-2col'); ?> 

<?php get_footer();