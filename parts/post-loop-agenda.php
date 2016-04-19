<article id="post-<?php the_ID(); ?>" class="home-agenda-item row" <?php post_class('clearfix'); ?> role="article">
	<a href="<?php the_permalink(); ?>">				
	<div class="home-agenda-date col-sm-3">
		<?php 

			if( get_field('uu_agenda_start_date') ) {
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
			if ($startyear == $endyear) {$sameyear=true;}

			
			// $date_format = get_option('date_format'); 
			?>

				<div class="home-agenda-date-day"><?php echo date_i18n('j', $start_date_timestamp); ?></div>
			 	<div class="home-agenda-date-month"><?php echo date_i18n('M', $start_date_timestamp); ?></div>

		<?php } ?>

	</div>

	<div class="home-agenda-content <?php if ( has_post_thumbnail() ) : ?>col-sm-6<?php else :?>col-sm-9<?php endif; ?>">
		<div class="home-agenda-date-full">
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
				
			} 
			if(get_field('uu_agenda_start_time')) {
				echo ', ' . get_field('uu_agenda_start_time');
				if(get_field('uu_agenda_end_time'))	{
					echo ' - ' . get_field('uu_agenda_end_time');
				}
			} else {
				echo ', ' . __('All day', 'uu2014');
			}
			?> 

		</div>
		<div class="home-agenda-title">
			<h1><?php the_title(); ?></h1>
		</div>
		<div class="home-agenda-excerpt">
			<?php uu_excerpt('160'); ?>
		</div>
		<!-- <span class="button icon small"><?php _e('Read more', 'uu2014'); ?></span> -->
	</div>
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="col-sm-3">
		<div class="home-agenda-thumbnail"><?php the_post_thumbnail('uu-thumbnail', array( 'class' => 'img-responsive' )); ?></div>	
	</div>
	<?php else : ?>
	
	<?php endif; ?>
					
			
</a>
</article>