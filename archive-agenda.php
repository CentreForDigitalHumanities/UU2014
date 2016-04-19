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
	// add_filter( 'get_meta_sql', 'get_meta_sql_date' );

	$args = array(
		'post_type'			=> 'agenda',
		'posts_per_page'	=> 50,
		'meta_key'			=> 'unix_start',
		'orderby'           => 'meta_value',
		'order'             => 'ASC',
		'meta_query' 		=> array(
			                      array(
			                        'key' => 'uu_agenda_end_date',
			                        'value' => $todaydate,
			                        'compare' => '>=',  
			                      ),
		                		),
	);


	$agenda_query = new WP_Query( $args );

	echo '<pre>';
	echo $agenda_query->request;
	echo '</pre>';

		if ( $agenda_query->have_posts() ) : ?>

			<?php while ($agenda_query->have_posts()) : $agenda_query->the_post(); ?>

				<?php get_template_part( 'parts/post-loop-agenda'); ?>

				<?php
					$acf_start_date = get_field('uu_agenda_start_date');
					$acf_start_time = get_field('uu_agenda_start_time');
					$acf_start_date_time = $acf_start_date . ' ' . $acf_start_time;
					$uts_start = strtotime($acf_start_date_time);
					$acf_uts_start = date('m/d/y H:i', $uts_start);
					$field_key = "field_56b46fd3a2868";
					$value = $acf_uts_start;
					update_field( $field_key, $value );
				?>

			<?php endwhile; ?>

				<?php //get_template_part('includes/template','pager'); //wordpress template pager/pagination ?>

		<?php else : ?>
		<div class="no-events">
			<?php _e('No upcoming events', 'uu2014') ?>
		</div>
		<?php endif; ?>
</div>

<?php // remove_filter( 'get_meta_sql', 'get_meta_sql_date' ); ?>

	<?php
	$current_catid = get_query_var('cat');
	$args2 = array(
		'post_type'		=> 'post',
		'category__in' => $current_catid,
		'posts_per_page'	=> 20,
		'meta_key'		=> 'uu_agenda_start_date',
		'meta_query' => array(
	        array(
	        	'relation' => 'AND',
	        	array(
	        		'key' => 'uu_agenda_start_date',
		            'value' => $todaydate,
		            'compare' => '<'
	        	),
	            array(
	        		'key' => 'uu_agenda_end_date',
		            'value' => $todaydate,
		            'compare' => '<'
	        	),
	        )
	    ),
		'orderby'		=> 'meta_value_num',
		'order'			=> 'DESC',
	);

	$agenda_past_query = new WP_Query( $args2 );

	if ( $agenda_past_query->have_posts() ) : ?>
<div class="previous-events clearfix">
	<h3><?php _e('Previous events', 'uu2014') ?></h3>
			<?php while ($agenda_past_query->have_posts()) : $agenda_past_query->the_post(); ?>

				<?php get_template_part( 'parts/post-loop-agenda-previous'); ?> 

			<?php endwhile; ?>

				<?php //get_template_part('includes/template','pager'); //wordpress template pager/pagination ?>

</div>		
		<?php endif; ?>



<?php get_template_part( 'parts/page-footer-2col'); ?> 

<?php get_footer();