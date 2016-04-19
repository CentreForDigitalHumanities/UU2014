<div>
	
	<?php 

		//$newsamount = get_field('uu_options_news_amount', 'option');
		$blogcats = get_field('uu_options_blog_frontpage_cat', 'option');
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
	
<article id="post-<?php the_ID(); ?>" role="article" class="blog-item row">
	<div class="author-aside col-sm-3 col-md-2 col-xs-12">
        	<?php get_template_part( 'parts/author_badge'); ?> 
        	<?php if(get_field('uu_options_news_show_pubdate', 'option')) { ?>

				<div class="date"><?php _e('on', 'uu2014'); ?><br /><?php the_date('d M Y'); ?></div>	
			<?php } ?>
    </div>

	<div class="blog-item-image col-sm-9 col-md-10 col-xs-12">
		<?php if (has_post_thumbnail()) { ?>      
            <figure class="article-preview-image"> 
                <?php the_post_thumbnail('large'); ?>    
            </figure>
        <?php } ?>
        
        <a class="blog-link" href="<?php the_permalink(); ?>">
			<h1><?php the_title(); ?></h1>
			<?php the_excerpt(); ?>
		</a>
	</div>	
		
	
</article>
		

	<?php } } else { ?>

	<?php get_template_part('includes/template','error'); // WordPress template error message ?>

	<?php } ?>
</div>