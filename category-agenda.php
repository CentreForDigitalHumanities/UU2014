<?php
/**
 * The template for displaying Agenda Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php get_template_part( 'parts/page-header-2col'); ?> 


<div class="upcoming-events clearfix">
	<h3><?php _e('Upcoming events', 'uu2014') ?></h3>
		<?php 
	$current_catid = get_query_var('cat');	
	$todaydate = date('Ymd');
	$todaytime = date('H:i');

	$args = array(
		'post_type'		=> 'post',
		'category__in' => $current_catid,
		'posts_per_page'	=> 50,
		'meta_key'		=> 'uu_agenda_start_date',
		'meta_query' => array(
	        'eventdate' => array(
	            'key' => 'uu_agenda_start_date',
	            'value' => $todaydate,
	            'compare' => '>=',
	        ),
	        'eventtime' => array(
	        	'relation' => 'OR',
	        	array(
	        		'key' => 'uu_agenda_start_time',	
	        		),
	            array(
	        		'key' => 'uu_agenda_start_time',
	        		'value' => date('H:i'),
	        		'compare' => 'NOT EXISTS',	
	        		),
	        ),
	    ),
	    'orderby'		=> array(
	    		'eventdate' => 'ASC',
	    		'eventtime' => 'ASC',
	    ),
	    
	);


	$agenda_query = new WP_Query( $args );

		if ( $agenda_query->have_posts() ) : ?>

			<?php while ($agenda_query->have_posts()) : $agenda_query->the_post(); ?>

				<?php get_template_part( 'parts/post-loop-agenda'); ?> 

			<?php endwhile; ?>

				<?php //get_template_part('includes/template','pager'); //wordpress template pager/pagination ?>

		<?php else : ?>
		<div class="no-events">
			<?php _e('No upcoming events', 'uu2014') ?>
		</div>
		<?php endif; ?>
</div>

<div class="previous-events clearfix">
	<h3><?php _e('Previous events', 'uu2014') ?></h3>
	<?php
	$current_catid = get_query_var('cat');
	$args2 = array(
		'post_type'		=> 'post',
		'category__in' => $current_catid,
		'posts_per_page'	=> 20,
		'meta_key'		=> 'uu_agenda_start_date',
		'meta_query' => array(
	        array(
	            'key' => 'uu_agenda_start_date',
	            'value' => $todaydate,
	            'compare' => '<'
	        )
	    ),
		'orderby'		=> 'meta_value_num',
		'order'			=> 'DESC',
	);

	$agenda_past_query = new WP_Query( $args2 );

	if ( $agenda_past_query->have_posts() ) : ?>

			<?php while ($agenda_past_query->have_posts()) : $agenda_past_query->the_post(); ?>

				<?php get_template_part( 'parts/post-loop-agenda-previous'); ?> 

			<?php endwhile; ?>

				<?php //get_template_part('includes/template','pager'); //wordpress template pager/pagination ?>

		<?php else : ?>
		<div class="no-events">
			<?php _e('No previous events', 'uu2014') ?>
		</div>
		<?php endif; ?>
</div>


<?php get_template_part( 'parts/page-footer-2col'); ?> 

<?php get_footer();