<?php get_header(); ?>

			

<?php get_template_part( 'parts/page-header-2col'); ?> 

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="https://schema.org/BlogPosting">
			<?php if ( has_post_thumbnail() ) { ?>
			<?php the_post_thumbnail('large', array( 'class' => 'img-responsive' )); ?>
			<?php } ?>
			
			<header class="article-header">


				<p class="byline vcard"><?php printf(__('Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&amp;</span> filed under %4$s.', 'uu2014'), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), uu2014_get_the_author_posts_link(), get_the_category_list(', ')); ?></p>

			</header><?php // end article header ?>

			<section class="entry-content clearfix" itemprop="articleBody">
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


				<?php the_content(); ?>
				<?php wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'uu2014' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) ); ?>
			</section><?php // end article section ?>

			<footer class="article-footer">

				<?php the_tags('<p class="tags"><span class="tags-title">Tags:</span> ', ', ', '</p>'); ?>

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