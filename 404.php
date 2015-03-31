<?php
/**
 * The template for displaying 404 pages (Not Found).
 */

get_header(); ?>
	<div class="page-content">
			<section class="container error-404 not-found">
				<div class="col-md-4">
					<span class="fourofour">404</span>
				</div>
				<div class="col-md-8">
					<header>
					
						<h1><?php _e( 'That page can&rsquo;t be found.', 'uu2014' ); ?></h1>
					</header><!-- .page-header -->

					
						
						<p><?php _e( 'It looks like nothing was found at this location. This may be due to the page being moved, renamed or deleted.<ul><li>Check the URL in the address bar above</li><li>Look for the page in the main navigation above or on the <a href="/site-map/" title="Site Map Page">Site Map</a> page</li><li>Try using the Search below.</li></ul>'); ?></p>

						<?php get_search_form(); ?>

					</div>
				</div>
			</section>
		</div>
<?php get_footer();
