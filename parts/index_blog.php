<div class="category-description"><?php 
$blogcats = get_field('uu_options_blog_frontpage_cat', 'option');
// $uu_load_masonry_script = 1;
echo category_description($blogcats); ?></div>

<div id="masonry"  data-masonry-options="{ 'itemSelector': '.masonry-item', 'columWidth': '.masonry-item' }">
	
	<?php 

		//$newsamount = get_field('uu_options_news_amount', 'option');
		
		if ($blogcats) { 
			$terms = implode(', ', $blogcats);	
		} else {
			$terms='';
		}
	
		$args = array(
			'post_type' => 'post',
			'pagination'    => true,
			//'posts_per_page' => $newsamount,
			'cat' => $terms,
			'ignore_sticky_posts'    => false,

		);

	$blogquery = new WP_Query( $args );
	if ( $blogquery->have_posts() ) {
			while ( $blogquery->have_posts() ) {
					$blogquery->the_post(); ?>
	
<article id="post-<?php the_ID(); ?>" class="masonry-item col-lg-3 col-md-4 col-sm-6 col-xs-12" role="article">
	<a href="<?php the_permalink(); ?>">
		<?php if (has_post_thumbnail()) { ?>      
            <figure class="article-preview-image"> 
                <?php the_post_thumbnail('large'); ?>    
            </figure>
        <?php } ?>
	

		<div class="article-content">

			<header class="article-header">
				<?php if(get_field('uu_options_news_show_pubdate', 'option')) { ?>
				<div class="date"><?php the_date('d F Y'); ?></div>	
				<?php } ?>
				<h1 class="entry-header"><?php the_title(); ?></h1>

			</header>

			<section class="entry-content clearfix">
				<div>
					<p><?php uu_excerpt('160'); ?></p>
					<?php get_template_part( 'parts/author_badge'); ?> 
				</div>
			</section>

		</div>
	</a>
</article>
		

	<?php } } else { ?>

	<?php get_template_part('includes/template','error'); // WordPress template error message ?>

	<?php } ?>
</div>