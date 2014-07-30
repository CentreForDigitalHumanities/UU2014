<div id="uu2014carousel" class="carousel slide">
	<!-- Indicators -->
	<?php
	$category = get_category(189);
	$count = $category->category_count;
	?>
	<ol class="carousel-indicators">
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
	<div class="carousel-inner">
		<?php 
		$the_query = new WP_Query(array(
		'category_name' => 'Slider', 
		'posts_per_page' => 1 
		)); 
		while ( $the_query->have_posts() ) : 
		$the_query->the_post();
		?>
		<div class="item active">
			<?php the_post_thumbnail('full', array('class' => 'img-responsive'));?>
			<div class="carousel-caption">
			 <h4><?php the_title();?></h4>
			 <?php the_excerpt();?>
			</div>
		</div><!-- item active -->
		<?php 
		endwhile; 
		wp_reset_postdata();
		?>
		<?php 
		$the_query = new WP_Query(array(
		'category_name' => 'Slider', 
		'posts_per_page' => 5, 
		'offset' => 1 
		)); 
		while ( $the_query->have_posts() ) : 
		$the_query->the_post();
		?>
		<div class="item">
			<?php the_post_thumbnail('full', array('class' => 'img-responsive'));?>
			<div class="carousel-caption">
			<h4><?php the_title();?></h4>
			<?php the_excerpt();?>
			</div>
		</div><!-- item -->
		<?php 
		endwhile; 
		wp_reset_postdata();
		?>
	</div><!-- carousel-inner -->
	<a class="left carousel-control" href="#uu2014carousel" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="#uu2014carousel" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div><!-- #uu2014carousel -->
