<div class="col-sm-8">
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