<div class="col-sm-8">
<?php if(get_field('uu_options_alternative_title_news', 'option')) { $news_title = get_field('uu_options_alternative_title_news', 'option'); } else { $news_title = __('News', 'uu2014'); } ?>

	<h2><?php echo $news_title; ?></h2>
	<?php 
						

						$newsamount = get_field('uu_options_news_amount', 'option');
						$newscats = get_field('uu_options_news_frontpage_cat', 'option');
						if ($newscats) { 
							$terms = implode(',', $newscats);	
						} else {
							$terms='news';
						}
						$sticky = get_option( 'sticky_posts' );	
						$args_sticky = array(
							'post_type' => 'post',
							'post__in'  => $sticky,
							'ignore_sticky_posts' => 1,
							'cat' => $terms,

						);
						$newsquery_sticky = new WP_Query( $args_sticky );



						
					
						$args = array(
							'post_type' => 'post',
							'posts_per_page' => $newsamount,
							'cat' => $terms,
							'post__not_in'  => get_option( 'sticky_posts' ),

						);

					
					 
					if ( $newsquery_sticky->have_posts() ) {
							while ( $newsquery_sticky->have_posts() ) {
									$newsquery_sticky->the_post(); 
								if ( isset($sticky[0]) ) {
									get_template_part( 'parts/post-loop-frontpage');
								}

				 			} 
				 	}
				 	wp_reset_query();
$newsquery = new WP_Query( $args );
					if ( $newsquery->have_posts() ) {
							while ( $newsquery->have_posts() ) {
									$newsquery->the_post(); 
					
									get_template_part( 'parts/post-loop-frontpage');
					

				 			} ?>
		<a class="uu-rss-link" href="/?feed=rss&cat=<?php echo $terms; ?>"><span class="icononly rss"></span>RSS</a>		
		<?php if(get_field('uu_options_frontpage_read_more_links', 'option')) { ?>
		<a class="button icon frontpage-read-more" href="<?php if ( function_exists('icl_object_id') ) { echo icl_get_home_url(); } ?>?cat=<?php echo $terms; ?>"><?php echo __('More', 'uu2014') . ' ' . $news_title; ?></a>		
		<?php } ?>	
	<?php } else { ?>

	<?php get_template_part('includes/template','error'); // WordPress template error message ?>

	<?php } ?>
</div>