<div class="col-sm-8">
	<?php if(get_field('uu_options_alternative_title_agenda', 'option')) { $agenda_title = get_field('uu_options_alternative_title_agenda', 'option'); } else { $agenda_title = __('Agenda', 'uu2014'); } ?>
	<h2><?php echo $agenda_title; ?></h2>
	<div class="agenda-archive">
		<?php 

		//add_filter( 'get_meta_sql', 'get_meta_sql_date' );
						$today = date('Ymd');
						$agendacats = get_field('uu_options_agenda_frontpage_cat', 'option');
						if ($agendacats) { 
							$agendaterms = implode(',', $agendacats);	
						} else {
							$agendaterms = 'agenda';
						}
					
						$agenda_amount = get_field('uu_options_agenda_amount', 'option');
						$todaydate = date('Ymd');
						$todaytime = date('H:i');
						$args = array(
							'post_type'		=> 'post',
							'cat' => $agendaterms,
							'posts_per_page'	=> $agenda_amount,
							'meta_key'		=> 'uu_agenda_start_date',
							'orderby'             => 'meta_value',
							'order'               => 'ASC',
							'meta_query' => array(
						        'eventdate' => array(
						        	'relation' => 'OR',
						        	array(
						        		'key' => 'uu_agenda_start_date',
						            	'value' => $todaydate,
						            	'compare' => '>=',	
						        	),
						        	array(
						        		'relation' => 'AND',
						        		array(
						        			'key' => 'uu_agenda_start_date',
							            	'value' => $todaydate,
							            	'compare' => '<',
						        		),
						        		array(
						        			'key' => 'uu_agenda_end_date',
							            	'value' => $todaydate,
							            	'compare' => '>=',
						        		),
						        			
						        	),
						            
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
						    // 'orderby'		=> array(
						    // 		'eventdate' => 'ASC',
						    // 		'eventtime' => 'ASC',
						    // ),
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