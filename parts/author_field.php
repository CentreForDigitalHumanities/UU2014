<div class="author_badge">
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
</div> 


