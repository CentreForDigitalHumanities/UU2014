<div class="col-sm-8">
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
</div>