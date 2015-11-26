<?php 

$term = term_exists('slider', 'category');

if ($term !== 0 && $term !== null) : ?>

<div id="uu2014carousel" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<?php
	$category = get_category_by_slug('slider');
	$count = $category->category_count;
	?>
	<div class="carousel-controls">
		<div class="carousel-buttons">
			<a class="carousel-play-btn icononly play" style="color:#fff;" href="#" id="carousel-play"></a>
			<a class="carousel-pause-btn icononly pause" style="color:#fff;" href="#" id="carousel-pause"></a>
		</div>
		<ol class="carousel-indicators" >
		<li data-target="#uu2014carousel" data-slide-to="0" class="active"></li>
		<?php
		if( $count > 1 ) { ?>
	    	<li data-target="#uu2014carousel" data-slide-to="1"></li>
		<?php } 
		?>
		<?php
		if( $count > 2 ) { ?>
	    	<li data-target="#uu2014carousel" data-slide-to="2"></li>
		<?php } 
		?>
		<?php
		if( $count > 3 ) { ?>
	    	<li data-target="#uu2014carousel" data-slide-to="3"></li>
		<?php } 
		?>
		<?php
		if( $count > 4 ) { ?>
	    	<li data-target="#uu2014carousel" data-slide-to="4"></li>
		<?php } 
		?>
	    </ol>
	</div>
	<div class="carousel-inner" role="listbox">
		<?php 
		$the_query = new WP_Query(array(
		'post_type'     => 'post',
		'category_name' => 'slider', 
		'posts_per_page' => 1 
		)); 
		while ( $the_query->have_posts() ) : 
		$the_query->the_post();
		?>
		<div class="item active">
			<?php the_post_thumbnail('full', array('class' => 'img-responsive'));?>
			<div class="carousel-caption">
				<div class="carousel-caption-text">
					<h4><?php the_title();?></h4>
					<!-- <?php $excerpt = get_the_excerpt() ?>
					<p><?php echo $excerpt ?></p> -->
				</div>
				<div class="carousel-caption-link">
					<a class="button icon" href="<?php the_permalink(); ?>"><?php _e('Read more', 'uu2014'); ?></a>
				</div>	
			</div>
			<!-- <div class="carousel-image-caption">
				<?php the_post_thumbnail();
				      echo get_post(get_post_thumbnail_id())->post_content; ?>
			</div> -->
		</div><!-- item active -->
		<?php 
		endwhile; 
		wp_reset_postdata();
		?>
		<?php 
		$the_query = new WP_Query(array(
		'post_type'     => 'post',	
		'category_name' => 'slider', 
		'posts_per_page' => 4, 
		'offset' => 1 
		)); 
		while ( $the_query->have_posts() ) : 
		$the_query->the_post();
		?>
		<div class="item">
			<?php the_post_thumbnail('full', array('class' => 'img-responsive'));?>
			<div class="carousel-caption">
				<div class="carousel-caption-text">
					<h4><?php the_title();?></h4>
					<!-- <?php $excerpt = get_the_excerpt() ?>
					<p><?php echo $excerpt ?></p> -->
				</div>
				<div class="carousel-caption-link">
					<a class="button icon" href="<?php the_permalink(); ?>"><?php _e('Read more', 'uu2014'); ?></a>
				</div>	
			</div>
			<!-- <div class="carousel-image-caption">
				<?php the_post_thumbnail();
				      echo get_post(get_post_thumbnail_id())->post_content; ?>
			</div> -->
		</div><!-- item -->
		<?php 
		endwhile; 
		wp_reset_postdata();
		?>

	

	</div><!-- carousel-inner -->
	<a class="left carousel-control" title="<?php _e('Previous slide', 'uu2014'); ?>" href="#uu2014carousel" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only"><?php _e('Previous slide', 'uu2014'); ?></span></a>
    <a class="right carousel-control" title="<?php _e('Next slide', 'uu2014'); ?>" href="#uu2014carousel" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only"><?php _e('Next slide', 'uu2014'); ?></span></a>
</div><!-- #uu2014carousel -->
<?php endif; ?>
<!-- <a class="btn btn-large btn-primary" href="#" id="btnPause">Pause</a>
<a class="btn btn-large btn-primary" href="#" id="btnPlay">Play</a>
 -->

