<?php get_header(); ?>


	<?php $post_type = get_field('uu_options_post_types', 'option');  
		if ($post_type == 'news_agenda') { ?>
			<?php get_template_part( 'parts/page-header-1col'); ?> 
			<div class="home-blog home-news-agenda">
				<?php get_template_part( 'parts/index_news_agenda'); ?> 
			</div>
			<?php get_template_part( 'parts/page-footer-1col'); ?> 		
	<?php }

		elseif ($post_type == 'news') { ?>
			<?php get_template_part( 'parts/page-header-1col'); ?> 
			<div class="home-blog home-news">	
				<?php get_template_part( 'parts/index_news_only'); ?> 
			</div>
			<?php get_template_part( 'parts/page-footer-1col'); ?> 		
		<?php }

		elseif ($post_type == 'news2') { ?>
			<?php get_template_part( 'parts/page-header-2col'); ?> 
			<div class="home-blog">	
				<?php get_template_part( 'parts/index_news_only'); ?> 
			</div>
			<?php get_template_part( 'parts/page-footer-2col'); ?> 		
		<?php }

		elseif ($post_type == 'agenda') { ?>
			<?php get_template_part( 'parts/page-header-1col'); ?>
			<div class="home-blog home-agenda">	 
				<?php get_template_part( 'parts/index_agenda_only'); ?> 
			</div>
			<?php get_template_part( 'parts/page-footer-1col'); ?> 	
		<?php }

		elseif ($post_type == 'agenda2') { ?>
			<?php get_template_part( 'parts/page-header-2col'); ?>
			<div class="home-blog">	 
				<?php get_template_part( 'parts/index_agenda_only'); ?> 
			</div>
			<?php get_template_part( 'parts/page-footer-2col'); ?> 	
		<?php }

		elseif ($post_type == 'blog') { ?>
			<?php get_template_part( 'parts/page-header-1col'); ?>
			<div class="home-blog">	 
				<?php get_template_part( 'parts/index_blog'); ?> 
			</div>
			<?php get_template_part( 'parts/page-footer-1col'); ?> 	
		<?php }

		elseif ($post_type == 'blog2') { ?>
			<?php get_template_part( 'parts/page-header-2col'); ?>
			<div class="home-blog">	 
				<?php get_template_part( 'parts/index_blog2'); ?> 
			</div>
			<?php get_template_part( 'parts/page-footer-2col'); ?> 	
		<?php }

		elseif ($post_type == 'none') { ?>
			<?php get_template_part( 'parts/page-header-1col'); ?>
			<?php get_template_part( 'parts/page-footer-1col'); ?> 	
		<?php }

		else { ?>
			<div class="home-blog">
				<div class="col-sm-8 col-sm-offset-2">
					<h2><?php _e('News', 'uu2014') ?></h2>
					<?php 
						$args = array(
							'post_type' => 'post',
							'pagination'    => true,
							'ignore_sticky_posts'    => false,

						);

					
					if ( have_posts() ) {
							while ( have_posts() ) {
									the_post(); 
					
					get_template_part( 'parts/post-loop-frontpage'); ?> 
					
					<?php } } else { ?>

					<?php get_template_part('includes/template','error'); // WordPress template error message ?>

					<?php } ?>
				</div>
			</div>	
			<?php }
		?>
			



<?php get_footer();