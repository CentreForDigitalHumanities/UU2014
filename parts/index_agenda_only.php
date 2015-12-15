<div class="col-sm-8">
	<?php if(get_field('uu_options_alternative_title_agenda', 'option')) { $agenda_title = get_field('uu_options_alternative_title_agenda', 'option'); } else { $agenda_title = __('Agenda', 'uu2014'); } ?>
	<h2><?php echo $agenda_title; ?></h2>
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

					<a class="uu-rss-link" href="/?feed=rss&cat=<?php echo $agendaterms; ?>"><span class="icononly rss"></span>RSS</a>		
							<?php if(get_field('uu_options_alternative_read_more_title_agenda', 'option')) { $agenda_readmore_title = get_field('uu_options_alternative_read_more_title_agenda', 'option'); } else { $agenda_readmore_title = __('Agenda', 'uu2014'); } ?>
							<?php if(get_field('uu_options_frontpage_read_more_links', 'option')) { ?>
								
								<a class="button icon frontpage-read-more" href="<?php if ( function_exists('icl_object_id') ) { echo icl_get_home_url(); } ?>?cat=<?php echo $agendaterms; ?>"><?php echo __('More', 'uu2014') . ' ' . $agenda_readmore_title; ?></a>		
								
							<?php } ?>	

			<?php else : ?>
			<div class="no-events">
				<?php _e('No upcoming events', 'uu2014') ?>
			</div>
			<?php endif; ?>
	</div>
</div>