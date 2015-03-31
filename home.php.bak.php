<?php get_header(); ?>

<?php get_template_part( 'parts/posts-header'); ?> 

	<div class="container frontpage-archive-container">
		<div class="row">
			<?php 
				if (term_exists('slider', 'category') ) {
					$slider = get_category_by_slug( 'slider' );
					$slider_cat = $slider->term_id;
				}
			$args = array (
						'posts_per_page' => '1',
						'ignore_sticky_posts'    => false,
						'category__not_in' => $slider_cat
			);
					
			$featured_query = new WP_Query( $args );
				while ( $featured_query->have_posts() ) : $featured_query->the_post();
				$do_not_duplicate = $post->ID; ?>
				<div class="col-md-6 col-sm-12 front-page-featured">
					
						<div class="front-page-post-featured-thumbnail"><?php the_post_thumbnail('large', array( 'class' => 'img-responsive' )); ?></div>
						<div class="front-page-post-featured-content">

							<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
							<span class="front-page-featured-date"><?php echo get_the_date(); ?></span>
							<p><?php the_excerpt(); ?></p>
							</div>
						
					
				</div>
			<?php endwhile; ?>
				
			<?php 
			 wp_reset_postdata();
			 global $post;
			if (term_exists('slider', 'category') ) {
					
					$slider = get_category_by_slug( 'slider' );
					$slider_cat = $slider->term_id;
					

					$args2 = array (
						    'category__not_in' => $slider_cat
					);		
				}


			$home_query = new WP_Query( array( $args2 ) );	
			if ( $home_query->have_posts() ) : while ( $home_query->have_posts() ) : the_post(); 
			if ( $post->ID == $do_not_duplicate ) continue; ?>
				<div class="col-md-3 col-xs-6 front-page-post-item">
					<a href="<?php the_permalink(); ?>">
						<div class="front-page-post-item-thumbnail"><?php the_post_thumbnail('uu-thumbnail', array( 'class' => 'img-responsive' )); ?></div>
						<div class="front-page-post-item-title">
							<span class="front-page-post-item-date"><?php echo get_the_date(); ?></span>
							<h1><?php the_title(); ?></h1>
						</div>
					</a>
				</div>
				

			<?php endwhile; else : ?>

				<?php get_template_part('includes/template','error'); // WordPress template error message ?>

			<?php endif; ?>
		</div><!-- /row -->
</div> <!-- /container -->
<?php get_footer();