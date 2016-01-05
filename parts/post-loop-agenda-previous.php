
				
	<div class="home-agenda-previous-content row">
		<div class="col-sm-3">
			<?php 
			if( get_field('uu_agenda_start_date') ) {

				$start_date = DateTime::createFromFormat('Ymd', get_field('uu_agenda_start_date')); 
				$end_date = DateTime::createFromFormat('Ymd', get_field('uu_agenda_end_date')); 
				$date_format = get_option('date_format'); ?>
				
					
					<?php echo $start_date->format($date_format);
				 } ?>
				
				<?php if( get_field('uu_agenda_end_date') && $start_date!=$end_date) { ?>
				- <br /><?php echo $end_date->format($date_format);
			} ?>
		</div>
		<div class="col-sm-9">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>
	</div>	
