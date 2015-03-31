				<!-- Page Load Error -->
				<article id="post-not-found" class="hentry clearfix">

					<header class="article-header">
						<p><?php _e("No items found", "uu2014"); ?></p>
					</header>

					<section class="entry-content">

					<?php if ( is_search() ) : //error if the search does not return any post for the loop ?>
						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'scaffoldingtheme' ); ?></p>
						<?php get_search_form(); ?>
					<?php else : //error if there are no post for the loop  ?>
						
					<?php endif; ?>

					</section>

					<footer class="article-footer">
					</footer>

				</article>