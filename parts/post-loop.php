<article id="post-<?php the_ID(); ?>" class="row" <?php post_class('clearfix'); ?> role="article">
		
		<div class="col-sm-3">
			<div class="archive-thumbnail"><?php if ( has_post_thumbnail() ) { the_post_thumbnail('uu-thumbnail', array( 'class' => 'img-responsive' )); } else {
			?><img src="<?php echo get_template_directory_uri(); ?>/images/default-thumb.jpg" class="img-responsive default-image" title="<?php _e('no image','uu2014'); ?>" /><?php }?></div>
		</div>

		<div class="col-sm-9">

						<header class="article-header">

							<h1 class="entry-header"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

						</header>

						<section class="entry-content clearfix">
							<?php the_excerpt(); ?>
							<?php echo '<a href="' . get_permalink($post->ID) . '" title="'. __('Read', 'uu2014') . get_the_title($post->ID).'" class="button icon" >'. __('Read more', 'uu2014') .'</a>'; ?>
							<?php wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'uu2014' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							) ); ?>
						</section>

						<footer class="article-footer">
						<?php
							$metadata = get_field('uu_options_posts_metadata' , 'options' );
							if( !empty($metadata) ) {
									uu_metadata();
								}

					 		?>

						</footer>

						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() ) :
								comments_template();
							endif;
						?>
			</div>
</article>