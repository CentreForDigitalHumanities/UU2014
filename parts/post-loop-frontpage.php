<article id="post-<?php the_ID(); ?>" class="row frontpage-news-item clearfix">
		<a href="<?php the_permalink(); ?>">
		<div class="col-sm-3">
			<div class="archive-thumbnail"><?php if ( has_post_thumbnail() ) { the_post_thumbnail('uu-thumbnail', array( 'class' => 'img-responsive' )); } ?></div>
		</div>

		<div class="col-sm-9">

			<div class="article-header">
				<?php if(get_field('uu_options_news_show_pubdate', 'option')) { ?>
				<div class="date"><?php echo get_the_date('d F Y'); ?></div>	
				<?php } ?>
				<h1 class="entry-header"><?php the_title(); ?></h1>

			</div>

			<div class="entry-content clearfix">
				<p><?php uu_excerpt('160'); ?></p>
			</div>
			<!-- <span class="button icon small hover"><?php _e('Read more', 'uu2014'); ?></span> -->
	
			</div>
			</a>
</article>