<?php get_header(); ?>

			

<?php get_template_part( 'parts/page-header-2col'); ?> 

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
			<?php if ( has_post_thumbnail() ) { ?>
			<?php //the_post_thumbnail('large', array( 'class' => 'img-responsive' )); ?>
			<?php } ?>


			<section class="entry-content clearfix" itemprop="articleBody">
				<?php if( function_exists('get_field') && get_field('uu_agenda_start_date') ) { ?>
				<div class="agenda-date">	
					
					<?php 

					
					$start_date_timestamp = strtotime(get_field('uu_agenda_start_date')); 
					$end_date_timestamp = strtotime(get_field('uu_agenda_end_date'));
					$startday = date_i18n('j', $start_date_timestamp);
					$endday = date_i18n('j', $end_date_timestamp);
					$startmonth = date_i18n('m', $start_date_timestamp);
					$endmonth = date_i18n('m', $end_date_timestamp);
					$startyear = date_i18n('Y', $start_date_timestamp);
					$endyear = date_i18n('Y', $end_date_timestamp);
					$sameday = false;
					$samemonth = false;
					$sameyear = false;
					if ($startday == $endday) {$sameday=true;} 
					if ($startmonth == $endmonth) {$samemonth=true;}
					if ($startyear == $endyear) {$sameyear=true;} ?>
					
					

					<div class="agenda-item">
						<label class="agenda-item-label"><?php _e('Date', 'uu2014') ?>: </label>
						<?php 
						if( get_field('uu_agenda_start_date') ) {
						 	
						 	if( get_field('uu_agenda_end_date') ) { 
						 		if (!$sameyear || !$samemonth) {
						 			echo date_i18n('j M Y', $start_date_timestamp). ' - ' . date_i18n('j M Y', $end_date_timestamp);
						 		}
						 		elseif(!$sameday) {
						 			echo date_i18n('j', $start_date_timestamp). ' - ' . date_i18n('j F Y', $end_date_timestamp);
						 		} else {	
								echo date_i18n('j F Y', $start_date_timestamp);
								}

							 } else {
							 	echo date_i18n('j F Y', $start_date_timestamp);	
							 } 
							
						} ?>
					
					</div>
					<?php if( get_field('uu_agenda_start_time') ) { ?>
						<div class="agenda-item">
							<label class="agenda-item-label"><?php _e('Time', 'uu2014') ?>: </label>
							<?php echo get_field('uu_agenda_start_time'); ?><?php if( get_field('uu_agenda_end_time') ) { ?> - <?php echo get_field('uu_agenda_end_time'); } ?>

						</div>
					<?php 	} ?>
				
					<?php if( get_field('uu_agenda_location') ) { ?>
						<div class="agenda-item">
							<label class="agenda-item-label"><?php _e('Location', 'uu2014') ?>: </label>
							<?php echo get_field('uu_agenda_location'); ?>
						</div>
					<?php 	} 
					if( get_field('uu_agenda_url') ) { ?>
						<div class="agenda-item">
							<label class="agenda-item-label"><?php _e('Url', 'uu2014') ?>: </label>
							<a href="<?php echo get_field('uu_agenda_url'); ?>"><?php echo get_field('uu_agenda_url'); ?></a>
						</div>
					<?php 	} ?>	
				</div>
				
				<?php 	} else { 
					$metadata = get_field('uu_options_posts_metadata' , 'options' );
					if( !empty($metadata) ) {
						
						if ( in_array( 'date', $metadata ) ) {
							uu_metadata();
						}

			 		}  
			 	} ?>
				<h1><?php the_title(); ?></h1>	
				<?php the_content(); ?>

				<?php uu_sharebuttons(); ?>


				<?php wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'uu2014' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) ); ?>
			</section><?php // end article section ?>

			<footer class="article-footer">
					
				

			</footer><?php // end article footer ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		</article><?php // end article ?>
	
	<?php endwhile; ?>

	<?php else : ?>

		<?php get_template_part('includes/template','error'); // WordPress template error message ?>

	<?php endif; ?>

<?php get_template_part( 'parts/page-footer-2col'); ?> 

<?php get_footer();