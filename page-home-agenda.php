<?php 
/**
 * Template Name: Homepage agenda
 * Description: A homepage template for primarily displaying agenda items
 *
 */

get_header(); ?>


<?php get_template_part( 'parts/page-header-1col'); ?> 
		

	<div class="container frontpage-archive-container agenda">
		<div class="row">	

			<div class="col-sm-4 col-md-6">
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						<section class="entry-content">
							<?php the_content(); ?>
						</section>
					</article>

				<?php endwhile; ?>

			<?php else : ?>

			<?php get_template_part('includes/template','error'); // WordPress template error message ?>

			<?php endif; ?>
				
			</div>

			<div class="col-sm-8 col-md-6">
				<h2><?php _e('Agenda', 'uu2014') ?></h2>
<div class="agenda-archive">
	<?php 

	$today = date('Ymd');

	$args = array(
		'post_type'		=> 'post',
		'posts_per_page'	=> 3,
		'meta_key'		=> 'uu_agenda_start_date',
		'meta_query' => array(
	        array(
	            'key' => 'uu_agenda_start_date',
	            'value' => $today,
	            'compare' => '>='
	        )
	    ),
		'orderby'		=> 'meta_value_num',
		'order'			=> 'ASC',
	);


	$agenda_query = new WP_Query( $args );

		if ( $agenda_query->have_posts() ) : ?>

			<?php while ($agenda_query->have_posts()) : $agenda_query->the_post(); ?>

				<?php get_template_part( 'parts/post-loop-agenda'); ?> 

			<?php endwhile; ?>

				<?php get_template_part('includes/template','pager'); //wordpress template pager/pagination ?>

		<?php else : ?>
		<div class="no-events">
			<?php _e('No upcoming events', 'uu2014') ?>
		</div>
		<?php endif; ?>
</div>


			<?php  wp_reset_postdata();	?>
			
			</div> <!-- /col-md-8 -->

		</div><!-- /row -->
</div> <!-- /container -->

<?php get_template_part( 'parts/page-footer-1col'); ?> 

<?php get_footer();