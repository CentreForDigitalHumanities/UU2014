<?php 
/**
 * Template Name: Homepage blog
 * Description: A homepage template for news/blog items with featured item
 *
 */

get_header(); ?>


<?php get_template_part( 'parts/posts-header'); ?> 

	<div class="container frontpage-archive-container">
		<div class="row">



<?php 
				if (term_exists('slider', 'category') ) {
					$slider = get_category_by_slug( 'slider' );
					$slider_cat = $slider->term_id;
				}

$args = array (
	'category__not_in'     => $slider_cat,
	'offset'                 => '1',
	'posts_per_page'         => '1',
);


$featured_query = new WP_Query( $args );

if ( $featured_query->have_posts() ) {
	while ( $featured_query->have_posts() ) {
		$featured_query->the_post(); ?>

				<div class="col-md-6 col-sm-12 front-page-featured">
					
						<div class="front-page-post-featured-thumbnail"><?php the_post_thumbnail('large', array( 'class' => 'img-responsive' )); ?></div>
						<div class="front-page-post-featured-content">

							<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
							<span class="front-page-featured-date"><?php echo get_the_date(); ?></span>
							<p><?php the_excerpt(); ?></p>
							</div>
						
					
				</div>

<?php } 
}
?>

<?php 
$args2 = array (
	'category__not_in'     => $slider_cat,
	'offset'                 => '1',
);


$home_query = new WP_Query( $args2 );

if ( $home_query->have_posts() ) {
	while ( $home_query->have_posts() ) {
		$home_query->the_post(); ?>
				<div class="col-md-3 col-xs-6 front-page-post-item">
					<a href="<?php the_permalink(); ?>">
						<div class="front-page-post-item-thumbnail"><?php the_post_thumbnail('uu-thumbnail', array( 'class' => 'img-responsive' )); ?></div>
						<div class="front-page-post-item-title">
							<span class="front-page-post-item-date"><?php echo get_the_date(); ?></span>
							<h1><?php the_title(); ?></h1>
						</div>
					</a>
				</div>
<?php }
} else {
	// no posts found
} ?>


				
				

		<?php if ($posts = FALSE) : ?> 

				<?php get_template_part('includes/template','error'); // WordPress template error message ?>

			<?php endif; 

				wp_reset_postdata();	
			?>
		</div><!-- /row -->
</div> <!-- /container -->
<?php get_footer();