<div class="col-sm-6">
					<?php if(get_field('uu_options_alternative_title_news', 'option')) { $news_title = get_field('uu_options_alternative_title_news', 'option'); } else { $news_title = __('News', 'uu2014'); } ?>

					<h2><?php echo $news_title; ?></h2>
					<?php 
						$args_sticky = array(
							'post_type' => 'post',
							'post__in'  => get_option( 'sticky_posts' ),
							'ignore_sticky_posts' => 1

						);
						$newsquery_sticky = new WP_Query( $args_sticky );



						$newsamount = get_field('uu_options_news_amount', 'option');
						$newscats = get_field('uu_options_news_frontpage_cat', 'option');
						if ($newscats) { 
							$terms = implode(',', $newscats);	
						} else {
							$terms='news';
						}
					
						$args = array(
							'post_type' => 'post',
							'pagination'    => true,
							'posts_per_page' => $newsamount,
							'cat' => $terms,
							'post__not_in'  => get_option( 'sticky_posts' ),

						);
the_field('uu_options_alternative_title_news');
					$newsquery = new WP_Query( $args );
					if ( $newsquery_sticky->have_posts() ) {
							while ( $newsquery_sticky->have_posts() ) {
									$newsquery_sticky->the_post(); 
					
									get_template_part( 'parts/post-loop-frontpage');
					

				 			} 
				 	}

					if ( $newsquery->have_posts() ) {
							while ( $newsquery->have_posts() ) {
									$newsquery->the_post(); 
					
									get_template_part( 'parts/post-loop-frontpage');
					

				 			} ?>
						<a class="uu-rss-link" href="/?feed=rss&cat=<?php echo $terms; ?>"><span class="icononly rss"></span>RSS</a>
					<?php if(get_field('uu_options_alternative_read_more_title_news', 'option')) { $news_readmore_title = get_field('uu_options_alternative_read_more_title_news', 'option'); } else { $news_readmore_title = __('News', 'uu2014'); } ?>	
					<?php if(get_field('uu_options_frontpage_read_more_links', 'option')) { ?>
						<a class="button icon frontpage-read-more" href="<?php if ( function_exists('icl_object_id') ) { echo icl_get_home_url(); } ?>?cat=<?php echo $terms; ?>"><?php echo __('More', 'uu2014') . ' ' . $news_readmore_title; ?></a>		
					<?php 
							}

					} else { ?>

					<?php get_template_part('includes/template','error'); // WordPress template error message ?>

					<?php } ?>
					
</div>

				<div class="col-sm-6">
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
						$args2 = array(
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


						$agenda_query = new WP_Query( $args2 );

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