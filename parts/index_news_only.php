<div class="col-sm-8">
	<h2><?php if(get_field('uu_options_alternative_title_news', 'option')) { the_field('uu_options_alternative_title_news', 'option'); } else { _e('News', 'uu2014'); } ?></h2>
	<?php 

		$newsamount = get_field('uu_options_news_amount', 'option');
		$newscats = get_field('uu_options_news_frontpage_cat', 'option');
		if ($newscats) { 
			$terms = implode(', ', $newscats);	
		} else {
			$terms='';
		}
	
		$args = array(
			'post_type' => 'post',
			'pagination'    => true,
			'posts_per_page' => $newsamount,
			'cat' => $terms,
			'ignore_sticky_posts'    => false,

		);

	$newsquery = new WP_Query( $args );
	if ( $newsquery->have_posts() ) {
			while ( $newsquery->have_posts() ) {
					$newsquery->the_post(); 
	
	get_template_part( 'parts/post-loop-frontpage'); ?> 
	

	<?php } } else { ?>

	<?php get_template_part('includes/template','error'); // WordPress template error message ?>

	<?php } ?>
</div>