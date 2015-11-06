<div class="category-description"><?php 
$blogcats = get_field('uu_options_blog_frontpage_cat', 'option');
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
			<p><?php uu_excerpt('160'); ?></p>
			<?php
				$author_options = get_field('uu_options_blog_author_options' , 'options' );
				$author_id = get_the_author_meta('ID');
				$author_badge = get_field('author_image', 'user_'. $author_id );
				$size = '';
			 
				$size = 'thumbnail';
				$attr = array(
					'class'	=> "author_badge"
				);
			

			if( !empty($author_options) ) {	
				
				if ( in_array( 'link', $author_options ) ) { ?>
					<a href="<?php echo get_author_posts_url( $author_id ); ?>">
		  	<?php } ?>

		  	<?php if ( in_array( 'photo', $author_options ) ) { ?>
					<?php echo wp_get_attachment_image( $author_badge, $size, FALSE, $attr ); ?>
		    <?php } ?>
			<?php if ( in_array( 'name', $author_options ) ) { ?>
					<div class="author-by"><?php _e('by', 'uu2014'); ?></div>
					<div class="author-name"><?php echo get_the_author_meta('display_name'); ?></div>
			<?php } ?>
			<?php if ( in_array( 'link', $author_options ) ) { ?>
					</a>
				<?php } 
			} ?>	
				
			</section>

		</div>
	</a>
</article>
		

	<?php } } else { ?>

	<?php get_template_part('includes/template','error'); // WordPress template error message ?>

	<?php } ?>
</div>