<?php
/**
 * The template for displaying Agenda Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php get_template_part( 'parts/page-header-2col'); 


?> 
<div class="upcoming-events clearfix">

<?php
  global $post, $EM_Category, $wp_query;
     $EM_Cat = em_get_category($wp_query->queried_object->term_id); ?>
      
       <p><?php echo $EM_Cat->output('#_CATEGORYNOTES'); ?></p>
     <?php echo $EM_Cat->output('#_CATEGORYNEXTEVENTS'); ?>
    

</div>



<?php get_template_part( 'parts/page-footer-2col'); ?> 

<?php get_footer();